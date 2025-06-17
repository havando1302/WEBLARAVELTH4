<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product; 
use App\Models\ProductVariant; // Đảm bảo dòng này đúng
use Illuminate\Http\Request;
use App\Notifications\OrderCancelled;
use Illuminate\Support\Facades\Log;

class OrderController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('admin')->except(['checkout', 'success', 'cancel']); 
    }

    public function checkout(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $request->validate([
            'payment_method' => 'required|in:cod,bank_transfer,momo',
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string|max:255',
            'note' => 'nullable|string|max:1000',
        ]);

        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = $cartItems->sum(function ($item) {
            return ($item->product->price ?? 0) * $item->quantity;
        });

        $order = Order::create([
            'user_id' => $user->id,
            'name' => $request->name,
            'phone' => $request->phone,
            'address' => $request->address,
            'note' => $request->note,
            'payment_method' => $request->payment_method,
            'total' => $total,
            'status' => 'pending',
            'cancellation_reason' => null,
        ]);

        foreach ($cartItems as $item) {
            if (!$item->product) continue;

            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price ?? 0,
                'size_id' => $item->size_id,
                'color_id' => $item->color_id,
            ]);
            
            $product = $item->product;
            if ($item->size_id && $item->color_id) {
                $productVariant = ProductVariant::where('product_id', $item->product_id)
                                    ->where('size_id', $item->size_id)
                                    ->where('color_id', $item->color_id)
                                    ->first();
                if ($productVariant && $productVariant->stock >= $item->quantity) {
                    $productVariant->stock -= $item->quantity;
                    $productVariant->save();
                } else {
                    Log::warning("Not enough stock or variant not found for Product ID: {$item->product_id}, Size: {$item->size_id}, Color: {$item->color_id} during checkout.");
                }
            } else {
                if ($product->stock >= $item->quantity) {
                    $product->stock -= $item->quantity;
                    $product->save();
                } else {
                    Log::warning("Not enough stock for Product ID: {$item->product_id} during checkout.");
                }
            }
        }

        Cart::where('user_id', $user->id)->delete();

        return redirect()->route('checkout.success')->with('message', 'Đặt hàng thành công!');
    }

    public function success()
    {
        return view('checkout.success');
    }

    public function index()
    {
        // Đã sửa đổi truy vấn để loại trừ các đơn hàng có trạng thái 'cancelled'
        $orders = Order::with(['user', 'items.size', 'items.color', 'items.product'])
                        ->where('status', '!=', 'cancelled') // Thêm điều kiện này
                        ->latest()
                        ->get();
        return view('admin.orders.index', compact('orders'));
    }

    public function edit($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    public function update(Request $request, Order $order)
    {
        $validated = $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|string|max:20',
            'address' => 'required|string',
            'payment_method' => 'required|string|in:cod,bank_transfer,momo',
            'note' => 'nullable|string',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:pending,processing,shipped,completed,cancelled',
            'cancellation_reason' => 'nullable|string|max:1000', 
        ]);

        $oldStatus = $order->status;

        $order->update($validated);

        if ($order->status === 'cancelled' && $oldStatus !== 'cancelled') {
            foreach ($order->items as $item) {
                $product = $item->product;
                if ($product) {
                    if ($item->size_id && $item->color_id) {
                        $productVariant = ProductVariant::where('product_id', $item->product_id)
                                            ->where('size_id', $item->size_id)
                                            ->where('color_id', $item->color_id)
                                            ->first();
                        if ($productVariant) {
                            $productVariant->stock += $item->quantity;
                            $productVariant->save();
                        }
                    } else {
                        $product->stock += $item->quantity;
                        $product->save();
                    }
                }
            }
        }

        if ($order->status !== $oldStatus && $order->user) {
            $order->user->notify(new OrderCancelled($order)); 
        }

        return redirect()->route('admin.orders.index')->with('success', 'Đơn hàng đã được cập tạo.');
    }

    public function cancel(Request $request, Order $order)
    {
        if ($order->user_id !== auth()->id()) {
            return redirect()->back()->with('error', 'Bạn không có quyền hủy đơn hàng này.');
        }

        if ($order->status !== 'pending') {
            return redirect()->back()->with('error', 'Đơn hàng không thể hủy vì trạng thái hiện tại là: ' . $order->status);
        }

        $cancellationReason = $request->input('cancellation_reason', 'Không có lý do cụ thể.'); 

        foreach ($order->items as $item) {
            $product = $item->product; 
            
            if ($product) {
                if ($item->size_id && $item->color_id) {
                    $productVariant = ProductVariant::where('product_id', $item->product_id)
                                        ->where('size_id', $item->size_id)
                                        ->where('color_id', $item->color_id)
                                        ->first();
                    if ($productVariant) {
                        $productVariant->stock += $item->quantity;
                        $productVariant->save();
                    } else {
                        Log::warning("Variant not found for OrderItem ID: {$item->id} (Product ID: {$item->product_id}, Color ID: {$item->color_id}, Size ID: {$item->size_id}). Stock not returned for this item.");
                    }
                } else {
                    $product->stock += $item->quantity;
                    $product->save();
                }
            } else {
                Log::warning("Product not found for OrderItem ID: {$item->id}. Stock could not be returned.");
            }
        }

        $order->update([
            'status' => 'cancelled',
            'cancellation_reason' => $cancellationReason, 
        ]);
        
        if ($order->user) {
            $order->user->notify(new OrderCancelled($order));
        }

        return redirect()->back()->with('success', 'Đơn hàng đã được hủy thành công.');
    }
}
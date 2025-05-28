<?php

namespace App\Http\Controllers;

use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use Illuminate\Http\Request;
use App\Notifications\OrderCancelled;

class OrderController extends Controller
{
    public function __construct()
    {
        // Middleware chỉ cho phép admin truy cập các phương thức quản lý đơn hàng, ngoại trừ checkout cho user
        $this->middleware('admin')->except(['checkout']);
    }

    /**
     * Xử lý đặt hàng khi user gửi form thanh toán
     */
    public function checkout(Request $request)
    {
        if (!auth()->check()) {
            return redirect('/login')->with('error', 'Vui lòng đăng nhập để thanh toán.');
        }

        $request->validate([
            'payment_method' => 'required|in:cod,bank_transfer,momo',
        ]);

        $user = auth()->user();
        $cartItems = Cart::where('user_id', $user->id)->with('product')->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Giỏ hàng của bạn đang trống.');
        }

        $total = $cartItems->sum(function ($item) {
            return $item->product->price * $item->quantity;
        });

        // Tạo đơn hàng
        $order = Order::create([
            'user_id' => $user->id,
            'total' => $total,
            'status' => 'Chờ xử lý',
            'payment_method' => $request->payment_method,
        ]);

        // Tạo chi tiết đơn hàng
        foreach ($cartItems as $item) {
            OrderItem::create([
                'order_id' => $order->id,
                'product_id' => $item->product_id,
                'quantity' => $item->quantity,
                'price' => $item->product->price,
            ]);
        }

        // Xóa giỏ hàng
        Cart::where('user_id', $user->id)->delete();

        // Redirect đến trang thanh toán thành công
        return redirect()->route('checkout.success')->with('message', 'Đặt hàng thành công!');
    }

    /**
     * Danh sách đơn hàng (chỉ admin)
     */
    public function index()
    {
        $orders = Order::with('user')->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * Trang chỉnh sửa đơn hàng (chỉ admin)
     */
    public function edit($id)
    {
        $order = Order::with(['user', 'items.product'])->findOrFail($id);
        return view('admin.orders.edit', compact('order'));
    }

    /**
     * Cập nhật đơn hàng (chỉ admin)
     */
    public function update(Request $request, $id)
    {
        $order = Order::findOrFail($id);
    
        $request->validate([
            'user_id' => 'required|exists:users,id',
            'total' => 'required|numeric|min:0',
            'status' => 'required|in:Đang chờ,Hoàn thành,Hủy',
        ]);
    
        $order->update([
            'user_id' => $request->user_id,
            'total' => $request->total,
            'status' => $request->status,
        ]);
    
        // Gửi thông báo cho user tùy trạng thái
        $order->user->notify(new OrderCancelled($order));
    
        return redirect()->route('admin.orders.index')->with('message', 'Đơn hàng đã được cập nhật thành công!');
    }
}
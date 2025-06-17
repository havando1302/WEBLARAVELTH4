<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends Controller
{
    public function index()
    {
        return view('checkout.index'); 
    }

    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'phone' => 'required|regex:/^[0-9]{10,11}$/',
            'address' => 'required|string',
            'payment_method' => 'required|string',
            'note' => 'nullable|string',
        ]);
    
        DB::beginTransaction();
    
        try {
            $userId = Auth::id();
    
            // Lấy tất cả sản phẩm trong giỏ hàng của user hiện tại
            $cartItems = \App\Models\Cart::where('user_id', $userId)->with('product')->get();
    
            if ($cartItems->isEmpty()) {
                return back()->with('error', 'Giỏ hàng của bạn đang trống.');
            }
    
            // Tính tổng giá trị đơn hàng
            $total = $cartItems->sum(function ($item) {
                return ($item->product->price ?? 0) * $item->quantity;
            });
    
            // Tạo order
            $order = Order::create([
                'user_id' => $userId,
                'name' => $request->name,
                'phone' => $request->phone,
                'address' => $request->address,
                'payment_method' => $request->payment_method,
                'note' => $request->note,
                'total' => $total,
                'status' => 'processing', // hoặc 'Chờ xử lý' tùy enum hoặc string bạn dùng
            ]);
    
            // Tạo từng order item
            foreach ($cartItems as $item) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $item->product_id,
                    'quantity' => $item->quantity,
                    'price' => $item->product->price ?? 0,
                    'color_id' => $item->color_id ?? null,
                    'size_id' => $item->size_id ?? null,
                ]);
            }
            
    
            // Xóa giỏ hàng của user sau khi đặt hàng thành công
            \App\Models\Cart::where('user_id', $userId)->delete();
    
            DB::commit();
    
            return redirect()->route('checkout.success')->with('success', 'Đặt hàng thành công! Giỏ hàng của bạn đã được làm trống.');
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->with('error', 'Có lỗi xảy ra khi đặt hàng: ' . $e->getMessage());
        }
    }
    
    public function success()
    {
        return view('checkout.success');
    }
}

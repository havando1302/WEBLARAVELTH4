<?php

namespace App\Http\Controllers;

use App\Models\Cart;
use App\Models\Product;
use App\Models\Order;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class CartController extends Controller
{
    
    public function index()
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        $userId = Auth::id();
        $cartItems = Cart::with(['product', 'color', 'size', 'productVariant'])
            ->where('user_id', $userId)
            ->get();
        $popularProducts = Product::latest()->take(6)->get();

        $orders = Order::where('user_id', $userId)->with('items.product')->get();

        return view('cart', compact('cartItems', 'popularProducts', 'orders'));
    }

    public function add(Request $request, Product $product)
    {
        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để thêm sản phẩm vào giỏ hàng.');
        }

        $validated = $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id' => 'required|exists:sizes,id',
            'product_variant_id' => 'nullable|exists:product_variants,id',
            'quantity' => 'nullable|integer|min:1',
        ]);

        $userId = Auth::id();
        $quantity = $validated['quantity'] ?? 1;

        $existingItem = Cart::where('user_id', $userId)
            ->where('product_id', $product->id)
            ->where('color_id', $validated['color_id'])
            ->where('size_id', $validated['size_id'])
            ->where('product_variant_id', $validated['product_variant_id'] ?? null)
            ->first();

        if ($existingItem) {
            $existingItem->quantity += $quantity;
            $existingItem->save();
        } else {
            Cart::create([
                'user_id' => $userId,
                'product_id' => $product->id,
                'color_id' => $validated['color_id'],
                'size_id' => $validated['size_id'],
                'product_variant_id' => $validated['product_variant_id'] ?? null,
                'quantity' => $quantity,
            ]);
        }

        return redirect()->back()->with('success', 'Đã thêm vào giỏ hàng.');
    }

    public function remove($id)
    {
        $userId = Auth::id();

        $cartItem = Cart::where('id', $id)->where('user_id', $userId)->first();

        if (!$cartItem) {
            return redirect()->back()->with('error', 'Không tìm thấy sản phẩm trong giỏ hàng.');
        }

        $cartItem->delete();

        return redirect()->back()->with('success', 'Đã xóa sản phẩm khỏi giỏ hàng.');
    }
}

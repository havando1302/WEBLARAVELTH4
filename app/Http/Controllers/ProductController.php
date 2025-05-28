<?php

namespace App\Http\Controllers;

use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;

class ProductController extends Controller
{
    public function __construct()
    {
        // Middleware chỉ cho phép admin mới được truy cập các method này
        $this->middleware('admin')->only(['create', 'store', 'edit', 'update', 'destroy']);
    }

    /**
     * Trang danh sách sản phẩm chung cho user và admin
     * Tự động phân biệt role để hiển thị view phù hợp
     */
    public function index()
    {
        $user = Auth::user();
        $products = Product::all();

        if ($user && $user->role === 'admin') {
            // Hiển thị giao diện quản lý sản phẩm cho admin
            return view('admin.products.index', compact('products'));
        }

        // Hiển thị giao diện sản phẩm cho user thường hoặc khách
        return view('index', compact('products'));
    }

    /**
     * Trang chi tiết sản phẩm, cũng phân biệt admin và user
     */
    public function show($id)
    {
        $product = Product::findOrFail($id);
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return view('admin.products.show', compact('product'));
        }

        return view('products.show', compact('product'));
    }

    /**
     * Form thêm sản phẩm mới (chỉ admin)
     */
    public function create()
    {
        return view('admin.products.create');
    }

    /**
     * Lưu sản phẩm mới (chỉ admin)
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product = new Product($request->except('image_url'));

        if ($request->hasFile('image_url')) {
            $path = $request->file('image_url')->store('products', 'public');
            $product->image_url = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được thêm.');
    }

    /**
     * Form sửa sản phẩm (chỉ admin)
     */
    public function edit(Product $product)
    {
        return view('admin.products.edit', compact('product'));
    }

    /**
     * Cập nhật sản phẩm (chỉ admin)
     */
    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required',
            'price' => 'required|numeric|min:0',
            'stock' => 'required|integer|min:0',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $product->fill($request->except('image_url'));

        if ($request->hasFile('image_url')) {
            if ($product->image_url) {
                Storage::disk('public')->delete($product->image_url);
            }

            $path = $request->file('image_url')->store('products', 'public');
            $product->image_url = $path;
        }

        $product->save();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã được cập nhật.');
    }

    /**
     * Xóa sản phẩm (chỉ admin)
     */
    public function destroy(Product $product)
    {
        if ($product->image_url) {
            Storage::disk('public')->delete($product->image_url);
        }

        $product->delete();

        return redirect()->route('products.index')->with('success', 'Sản phẩm đã bị xóa.');
    }
}

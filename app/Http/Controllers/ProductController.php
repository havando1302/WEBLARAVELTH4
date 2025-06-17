<?php

namespace App\Http\Controllers;

use App\Models\Product;
use App\Models\ProductVariant;
use App\Models\Category;
use App\Models\Color;
use App\Models\Size;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
class ProductController extends Controller
{
    public function __construct()
    {
        $this->middleware('admin')->only([
            'create', 'store', 'edit', 'update', 'destroy',
            'createVariant', 'storeVariant', 'editVariant', 'updateVariant', 'destroyVariant'
        ]);
    }

    public function index(Request $request)
    {
        $categoryId = $request->query('category_id');
        $query = Product::with('variants');

        if ($categoryId) {
            $query->where('category_id', $categoryId);
        }

        $products = $query->paginate(12)->withQueryString();
        $categories = Category::whereNotNull('parent_id')->get();
        $user = Auth::user();

        if ($user && $user->role === 'admin') {
            return view('admin.products.index', compact('products', 'categories', 'categoryId'));
        }

        return view('products.index', compact('products', 'categories', 'categoryId'));
    }

        /**
         * Hiển thị trang chi tiết sản phẩm.
         *
         * @param  int  $id
         * @return \Illuminate\View\View
         */
        public function show($id)
        {
           
            $product = Product::with('variants.color', 'variants.size')->findOrFail($id);
    
            $colors = $product->variants
                ->map(fn($variant) => $variant->color)
                ->filter()
                ->unique('id')
                ->values();
    
           
            $sizes = $product->variants
                ->map(fn($variant) => $variant->size)
                ->filter()
                ->unique('id')
                ->values();
    
            $variants = $product->variants;
            
           
            $user = Auth::user();
            $viewName = ($user && $user->role === 'admin') ? 'admin.products.show' : 'products.show';
    
         
            
            return view($viewName, compact('product', 'colors', 'sizes', 'variants'));
        }
    


    
    
    



    public function create()
    {
        $categories = Category::whereNotNull('parent_id')->get();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.create', compact('categories', 'colors', 'sizes'));
    }

    
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.color_name' => 'required|string|max:100',
            'variants.*.size_name' => 'required|string|max:100',
            'variants.*.stock' => 'required|integer|min:0',
        ]);
    
        DB::beginTransaction();
        try {
            // Upload image
            $imagePath = $request->file('image_url')->store('products', 'public');
    
            // Create product
            $product = Product::create([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'image_url' => $imagePath,
            ]);
    
            // Handle variants
            foreach ($request->variants as $variant) {
                $color = Color::firstOrCreate(['name' => trim($variant['color_name'])]);
                $size = Size::firstOrCreate(['name' => trim($variant['size_name'])]);
    
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                    'color_name' => $color->name,
                    'size_name' => $size->name,
                    'stock' => $variant['stock'],
                ]);
            }
    
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được thêm thành công.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
    }
    
    public function edit($id)
    {
        $product = Product::with('variants')->findOrFail($id);
        $categories = Category::whereNotNull('parent_id')->get();
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.edit', compact('product', 'categories', 'colors', 'sizes'));
    }

  

    public function update(Request $request, Product $product)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'description' => 'required|string',
            'price' => 'required|numeric|min:0',
            'category_id' => 'required|exists:categories,id',
            'image_url' => 'nullable|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'variants' => 'required|array|min:1',
            'variants.*.color_name' => 'required|string|max:100',
            'variants.*.size_name' => 'required|string|max:100',
            'variants.*.stock' => 'required|integer|min:0',
        ]);
    
        DB::beginTransaction();
        try {
            // Nếu có ảnh mới, thì xoá ảnh cũ và lưu ảnh mới
            if ($request->hasFile('image_url')) {
                if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
                    Storage::disk('public')->delete($product->image_url);
                }
                $imagePath = $request->file('image_url')->store('products', 'public');
                $product->image_url = $imagePath;
            }
    
            // Cập nhật sản phẩm
            $product->update([
                'name' => $request->name,
                'description' => $request->description,
                'price' => $request->price,
                'category_id' => $request->category_id,
                'image_url' => $product->image_url, // nếu có thay ảnh thì đã được cập nhật ở trên
            ]);
    
            // Xoá tất cả biến thể cũ
            $product->variants()->delete();
    
            // Lưu biến thể mới
            foreach ($request->variants as $variant) {
                $color = Color::firstOrCreate(['name' => trim($variant['color_name'])]);
                $size = Size::firstOrCreate(['name' => trim($variant['size_name'])]);
    
                ProductVariant::create([
                    'product_id' => $product->id,
                    'color_id' => $color->id,
                    'size_id' => $size->id,
                    'color_name' => $color->name,
                    'size_name' => $size->name,
                    'stock' => $variant['stock'],
                ]);
            }
    
            DB::commit();
            return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã được cập nhật thành công.');
    
        } catch (\Exception $e) {
            DB::rollBack();
            return back()->withErrors(['error' => 'Đã xảy ra lỗi: ' . $e->getMessage()]);
        }
    }
    

        public function destroy($id)
    {
        $product = Product::findOrFail($id);

        // Xóa ảnh
        if ($product->image_url && Storage::disk('public')->exists($product->image_url)) {
            Storage::disk('public')->delete($product->image_url);
        }

        // Xóa biến thể
        $product->variants()->delete();

        // Xóa sản phẩm
        $product->delete();

        return redirect()->route('admin.products.index')->with('success', 'Sản phẩm đã bị xóa.');
    }

    // ==========================
    // Quản lý biến thể sản phẩm
    // ==========================

    public function createVariant($productId)
    {
        $product = Product::findOrFail($productId);
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.variants.create', compact('product', 'colors', 'sizes'));
    }

    public function storeVariant(Request $request, $productId)
    {
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id'  => 'required|exists:sizes,id',
            'stock'    => 'required|integer|min:0',
        ]);

        $product = Product::findOrFail($productId);

        $product->variants()->create([
            'color_id' => $request->color_id,
            'size_id'  => $request->size_id,
            'stock'    => $request->stock,
        ]);

        return redirect()->route('admin.products.edit', $productId)->with('success', 'Biến thể đã được thêm.');
    }

    public function editVariant($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $colors = Color::all();
        $sizes = Size::all();

        return view('admin.products.variants.edit', compact('variant', 'colors', 'sizes'));
    }

    public function updateVariant(Request $request, $id)
    {
        $request->validate([
            'color_id' => 'required|exists:colors,id',
            'size_id'  => 'required|exists:sizes,id',
            'stock'    => 'required|integer|min:0',
        ]);

        $variant = ProductVariant::findOrFail($id);
        $variant->update([
            'color_id' => $request->color_id,
            'size_id'  => $request->size_id,
            'stock'    => $request->stock,
        ]);

        return redirect()->route('admin.products.edit', $variant->product_id)->with('success', 'Biến thể đã được cập nhật.');
    }

    public function destroyVariant($id)
    {
        $variant = ProductVariant::findOrFail($id);
        $productId = $variant->product_id;
        $variant->delete();

        return redirect()->route('admin.products.edit', $productId)->with('success', 'Biến thể đã bị xóa.');
    }
}

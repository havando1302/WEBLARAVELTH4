<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Category;
use Illuminate\Support\Str;

class CategoryController extends Controller
{
    
    public function index()
    {
        $mainCategory = Category::where('slug', 'san-pham')->with('children')->first();

        if (!$mainCategory) {
            abort(404, 'Danh mục "Sản phẩm" không tồn tại trong hệ thống.');
        }

        return view('admin.categories.index', compact('mainCategory'));
    }

    /**
     * Hiển thị form tạo danh mục mới.
     */
    public function create()
    {
        $potentialParents = Category::whereNull('parent_id')
                                    ->orWhere('slug', 'san-pham')
                                    ->orderBy('name')
                                    ->get();
    
        $mainProductCategoryID = Category::where('slug', 'san-pham')->value('id');
    
        return view('admin.categories.create', [
            'categories' => $potentialParents,
            'mainProductCategoryID' => $mainProductCategoryID, 
        ]);
    }
    
    /**
     * Lưu danh mục mới vào database.
     */
    public function store(Request $request)
    {
        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id',
        ]);

        $parentId = $request->input('parent_id');

        if (!$parentId) {
            $root = Category::where('slug', 'san-pham')->first();
            if (!$root) {
                return redirect()->back()->withErrors(['parent_id' => 'Danh mục "Sản phẩm" không tồn tại.']);
            }
            $parentId = $root->id;
        }

        Category::create([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $parentId,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Đã tạo danh mục mới thành công!');
    }

    /**
     * Hiển thị form chỉnh sửa danh mục.
     */
    public function edit($id)
    {
        $category = Category::findOrFail($id);

        // Lấy các danh mục có thể làm cha, trừ chính nó để tránh lặp vô hạn
        $potentialParents = Category::whereNull('parent_id')
                                    ->orWhere('slug', 'san-pham')
                                    ->where('id', '!=', $category->id)
                                    ->orderBy('name')
                                    ->get();

        return view('admin.categories.edit', compact('category', 'potentialParents'));
    }

    /**
     * Cập nhật danh mục.
     */
    public function update(Request $request, $id)
    {
        $category = Category::findOrFail($id);

        $request->validate([
            'name' => 'required|string|max:255',
            'parent_id' => 'nullable|exists:categories,id|not_in:'.$category->id,
        ]);

        $parentId = $request->input('parent_id');

        if (!$parentId) {
            $root = Category::where('slug', 'san-pham')->first();
            if (!$root) {
                return redirect()->back()->withErrors(['parent_id' => 'Danh mục "Sản phẩm" không tồn tại.']);
            }
            $parentId = $root->id;
        }

        $category->update([
            'name' => $request->name,
            'slug' => Str::slug($request->name),
            'parent_id' => $parentId,
        ]);

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã được cập nhật thành công!');
    }

    /**
     * Xóa danh mục.
     */
    public function destroy($id)
    {
        $category = Category::findOrFail($id);

        // Có thể bạn muốn kiểm tra xem danh mục có con hay không trước khi xóa
        if ($category->children()->count() > 0) {
            return redirect()->route('admin.categories.index')->withErrors('Danh mục đang có danh mục con, không thể xóa.');
        }

        $category->delete();

        return redirect()->route('admin.categories.index')->with('success', 'Danh mục đã bị xóa thành công!');
    }
}

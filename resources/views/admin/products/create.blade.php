@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Thêm sản phẩm mới</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.store') }}" method="POST" enctype="multipart/form-data">
        @csrf

        {{-- Tên sản phẩm --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
            <input type="text" name="name" id="name" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        {{-- Mô tả chi tiết --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả chi tiết</label>
            <textarea name="description" id="description" rows="5" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required></textarea>
        </div>

        {{-- Giá --}}
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
            <input type="number" name="price" id="price" step="1000" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>

        {{-- Danh mục con --}}
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục con</label>
            <select name="category_id" id="category_id" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}">{{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Hình ảnh --}}
        <div class="mb-4">
            <label for="image_url" class="block text-sm font-medium text-gray-700">Hình ảnh</label>
            <input type="file" name="image_url" id="image_url" class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
        </div>
        {{-- Biến thể sản phẩm --}}
<div class="mb-4">
    <label class="block text-lg font-bold text-gray-800 mb-2">Biến thể sản phẩm</label>
    <div id="variant-container">
        @foreach(old('variants', [[]]) as $i => $variant)
            <div class="variant-group grid grid-cols-4 gap-4 mb-2 items-end" data-index="{{ $i }}">
                <input type="hidden" name="variants[{{ $i }}][id]" value="{{ $variant['id'] ?? '' }}">
                <div>
                    <label>Màu (nhập tên màu)</label>
                    <input type="text" name="variants[{{ $i }}][color_name]" class="w-full border rounded" required value="{{ $variant['color_name'] ?? '' }}">
                </div>
                <div>
                    <label>Size (nhập tên size)</label>
                    <input type="text" name="variants[{{ $i }}][size_name]" class="w-full border rounded" required value="{{ $variant['size_name'] ?? '' }}">
                </div>
                <div>
                    <label>Số lượng</label>
                    <input type="number" name="variants[{{ $i }}][stock]" class="w-full border rounded" min="0" required value="{{ $variant['stock'] ?? 0 }}">
                </div>
                <div>
                    <button type="button" class="remove-variant-button bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Xóa</button>
                </div>
            </div>
        @endforeach
    </div>
    <button type="button" id="add-variant-button" class="mt-2 text-blue-600 hover:underline">+ Thêm biến thể</button>
</div>

<div class="mt-6">
    <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">
        Tạo sản phẩm
    </button>
</div>

<script>
    let variantIndex = {{ count(old('variants', [[]])) }};

    function createVariantGroup(index, data = {}) {
        return `
            <div class="variant-group grid grid-cols-4 gap-4 mb-2 items-end" data-index="${index}">
                <input type="hidden" name="variants[${index}][id]" value="${data.id ?? ''}">
                
                <div>
                    <label>Màu (nhập tên màu)</label>
                    <input type="text" name="variants[${index}][color_name]" class="w-full border rounded" required value="${data.color_name ?? ''}">
                </div>

                <div>
                    <label>Size (nhập tên size)</label>
                    <input type="text" name="variants[${index}][size_name]" class="w-full border rounded" required value="${data.size_name ?? ''}">
                </div>

                <div>
                    <label>Số lượng</label>
                    <input type="number" name="variants[${index}][stock]" class="w-full border rounded" min="0" required value="${data.stock ?? 0}">
                </div>

                <div>
                    <button type="button" class="remove-variant-button bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Xóa</button>
                </div>
            </div>
        `;
    }

    document.getElementById('add-variant-button').addEventListener('click', () => {
        const container = document.getElementById('variant-container');
        container.insertAdjacentHTML('beforeend', createVariantGroup(variantIndex));
        variantIndex++;
    });

    document.getElementById('variant-container').addEventListener('click', function(e) {
        if (e.target.classList.contains('remove-variant-button')) {
            e.target.closest('.variant-group').remove();
        }
    });
</script>


@endsection

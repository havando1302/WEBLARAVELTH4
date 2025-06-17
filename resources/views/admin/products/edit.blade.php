@extends('layouts.app')

@section('content')
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Chỉnh sửa sản phẩm: {{ $product->name }}</h1>

    @if ($errors->any())
        <div class="mb-4 text-red-600">
            <ul>
                @foreach ($errors->all() as $error)
                    <li>- {{ $error }}</li>
                @endforeach
            </ul>
        </div>
    @endif

    <form action="{{ route('admin.products.update', $product) }}" method="POST" enctype="multipart/form-data">
        @csrf
        @method('PUT')

        {{-- Tên sản phẩm --}}
        <div class="mb-4">
            <label for="name" class="block text-sm font-medium text-gray-700">Tên sản phẩm</label>
            <input type="text" name="name" id="name"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                value="{{ old('name', $product->name) }}" required>
        </div>
        {{-- Mô tả chi tiết --}}
        <div class="mb-4">
            <label for="description" class="block text-sm font-medium text-gray-700">Mô tả chi tiết</label>
            <textarea name="description" id="description" rows="5"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                required>{{ old('description', $product->description) }}</textarea>
        </div>

        {{-- Giá --}}
        <div class="mb-4">
            <label for="price" class="block text-sm font-medium text-gray-700">Giá</label>
            <input type="number" name="price" id="price" step="1000"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm"
                value="{{ old('price', $product->price) }}" required>
        </div>

        {{-- Danh mục con --}}
        <div class="mb-4">
            <label for="category_id" class="block text-sm font-medium text-gray-700">Danh mục con</label>
            <select name="category_id" id="category_id"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm" required>
                <option value="">-- Chọn danh mục --</option>
                @foreach ($categories as $category)
                    <option value="{{ $category->id }}"
                        {{ old('category_id', $product->category_id) == $category->id ? 'selected' : '' }}>
                        {{ $category->name }}</option>
                @endforeach
            </select>
        </div>

        {{-- Hình ảnh --}}
        <div class="mb-4">
            <label for="image_url" class="block text-sm font-medium text-gray-700">Hình ảnh</label>

            @if ($product->image_url)
                <div class="mb-2">
                    <img src="{{ Storage::url($product->image_url) }}" alt="{{ $product->name }}"
                        class="w-40 h-auto rounded-md object-cover">
                </div>
            @endif

            <input type="file" name="image_url" id="image_url"
                class="mt-1 block w-full border-gray-300 rounded-md shadow-sm">
            <p class="text-sm text-gray-500 mt-1">Nếu bạn muốn thay đổi ảnh, chọn file mới. Nếu không, để trống.</p>
        </div>

        {{-- Biến thể sản phẩm --}}
        <div class="mb-4">
            <label class="block text-lg font-bold text-gray-800 mb-2">Biến thể sản phẩm</label>
            <div id="variant-container">
                @php
                    // Lấy old variants nếu có lỗi validation, ưu tiên old data
                    $oldVariants = old('variants', []);
                @endphp

                @if (count($oldVariants) > 0)
                    @foreach ($oldVariants as $index => $variant)
                        <div class="variant-group grid grid-cols-4 gap-4 mb-2 items-end" data-index="{{ $index }}">
                            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant['id'] ?? '' }}">
                            <div>
                                <label>Màu (nhập tên màu)</label>
                                <input type="text" name="variants[{{ $index }}][color_name]" class="w-full border rounded"
                                    required value="{{ $variant['color_name'] }}">
                            </div>

                            <div>
                                <label>Size (nhập tên size)</label>
                                <input type="text" name="variants[{{ $index }}][size_name]" class="w-full border rounded"
                                    required value="{{ $variant['size_name'] }}">
                            </div>

                            <div>
                                <label>Số lượng</label>
                                <input type="number" name="variants[{{ $index }}][stock]" class="w-full border rounded"
                                    min="0" required value="{{ $variant['stock'] }}">
                            </div>

                            <div>
                                <button type="button" class="remove-variant-button bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Xóa</button>
                            </div>
                        </div>
                    @endforeach
                @else
                    @foreach ($product->variants as $index => $variant)
                        <div class="variant-group grid grid-cols-4 gap-4 mb-2 items-end" data-index="{{ $index }}">
                            <input type="hidden" name="variants[{{ $index }}][id]" value="{{ $variant->id }}">
                            <div>
                                <label>Màu (nhập tên màu)</label>
                                <input type="text" name="variants[{{ $index }}][color_name]" class="w-full border rounded"
                                    required value="{{ old('variants.'.$index.'.color_name', $variant->color_name) }}">
                            </div>

                            <div>
                                <label>Size (nhập tên size)</label>
                                <input type="text" name="variants[{{ $index }}][size_name]" class="w-full border rounded"
                                    required value="{{ old('variants.'.$index.'.size_name', $variant->size_name) }}">
                            </div>

                            <div>
                                <label>Số lượng</label>
                                <input type="number" name="variants[{{ $index }}][stock]" class="w-full border rounded"
                                    min="0" required value="{{ old('variants.'.$index.'.stock', $variant->stock) }}">
                            </div>

                            <div>
                                <button type="button" class="remove-variant-button bg-red-500 hover:bg-red-600 text-white px-3 py-1 rounded">Xóa</button>
                            </div>
                        </div>
                    @endforeach
                @endif
            </div>

            <button type="button" id="add-variant-button" class="mt-2 text-blue-600 hover:underline">+ Thêm biến thể</button>
        </div>

        <button type="submit" class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded">Cập nhật sản phẩm</button>
    </form>
</div>

<script>
    let variantIndex = {{ count(old('variants', $product->variants)) }};

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

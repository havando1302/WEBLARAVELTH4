@extends('layouts.app')

@section('content')
<style>
    .variant-label {
    display: inline-block;
    padding: 5px 12px;
    border-radius: 9999px;
    background-color: #e0e7ff; /* xanh nhẹ */
    color: #1e3a8a; /* xanh đậm */
    font-size: 0.875rem;
    font-weight: 500;
    user-select: none;
    box-shadow: 0 1px 3px rgba(30, 58, 138, 0.2);
    transition: background-color 0.3s ease, color 0.3s ease;
}

/* Nhãn kích cỡ có style khác */
.variant-label.size {
    background-color: #bfdbfe; /* xanh nhạt hơn */
    color: #1e40af;
    font-weight: 600;
}

/* Hover hiệu ứng cho cả hai */
.variant-label:hover {
    background-color: #3b82f6;
    color: #ffffff;
    cursor: default;
    box-shadow: 0 2px 8px rgba(59, 130, 246, 0.7);
}
</style>
<div class="container mx-auto p-6">
    <h1 class="text-3xl font-bold mb-6 text-gray-800">Danh sách sản phẩm</h1>

    <a href="{{ route('admin.products.create') }}"
       class="bg-blue-500 hover:bg-blue-600 text-white px-4 py-2 rounded mb-4 inline-block">
        + Thêm sản phẩm mới
    </a>

    <div class="grid grid-cols-1 md:grid-cols-2 lg:grid-cols-3 gap-6">
        @foreach($products as $product)
            <div class="bg-white rounded-lg shadow-lg p-4 flex flex-col">
                {{-- Ảnh sản phẩm chính --}}
    <img 
        src="{{ $product->image_url
            ? (Str::startsWith($product->image_url, 'assets/') 
                ? asset($product->image_url) 
                : asset('storage/' . $product->image_url)) 
            : 'https://via.placeholder.com/150' 
        }}" 
        alt="{{ $product->name }}"
        class="w-full h-40 object-cover rounded-md mb-4"
    >

    {{-- Tên và giá --}}
    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
    <p class="text-gray-600">{{ number_format($product->price) }} VNĐ</p>
                @if($product->variants->count())
                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700">Màu sắc:</p>
                        <div class="flex flex-wrap">
                            {{-- Lấy danh sách color_name duy nhất --}}
                            @foreach($product->variants->pluck('color_name')->unique() as $color)
                                <span class="variant-label">{{ $color }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-4">
                        <p class="text-sm font-medium text-gray-700">Kích cỡ:</p>
                        <div class="flex flex-wrap">
                            {{-- Lấy danh sách size_name duy nhất --}}
                            @foreach($product->variants->pluck('size_name')->unique() as $size)
                                <span class="variant-label size">{{ $size }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                {{-- Nút sửa/xóa --}}
                <div class="mt-4 flex space-x-2">
                    <a href="{{ route('admin.products.edit', $product) }}"
                       class="bg-yellow-500 hover:bg-yellow-600 text-black px-3 py-1 rounded">
                        Sửa
                    </a>
                    <form action="{{ route('admin.products.destroy', $product) }}" method="POST" class="inline">
                        @csrf
                        @method('DELETE')
                        <button type="submit"
                                class="bg-red-500 hover:bg-red-600 text-black px-3 py-1 rounded"
                                onclick="return confirm('Bạn có chắc muốn xóa?')">
                            Xóa
                        </button>
                    </form>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

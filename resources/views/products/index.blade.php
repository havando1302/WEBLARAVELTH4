@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;

    // Đường dẫn ảnh mặc định nếu ảnh lỗi
    $defaultImageUrl = asset('assets/img/default.jpg');
@endphp

<style>
    @import url('https://fonts.googleapis.com/css2?family=Baloo+2&display=swap');

    body {
        font-family: 'Baloo 2', cursive;
        background: linear-gradient(135deg, #f0f4ff, #ffffff);
    }

    h1.page-title {
        background: linear-gradient(to right, #4f46e5, #3b82f6);
        -webkit-background-clip: text;
        -webkit-text-fill-color: transparent;
    }

    .product-card {
        transition: transform 0.3s ease, box-shadow 0.3s ease;
        border: 2px solid transparent;
        background: linear-gradient(to bottom right, #ffffff, #f0f8ff);
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        border-radius: 0.5rem;
        padding: 1rem;
        box-shadow: 0 1px 3px rgba(0,0,0,0.1);
    }

    .product-card:hover {
        transform: scale(1.03);
        box-shadow: 0 10px 25px rgba(0, 0, 0, 0.1);
        border-color: #60a5fa;
    }

    .product-image-container {
        width: 100%;
        height: 12rem;
        overflow: hidden;
        border-radius: 0.375rem;
        margin-bottom: 1rem;
    }

    .product-image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        display: block;
    }

    .btn-add-to-cart {
        background: linear-gradient(to right, #60a5fa, #3b82f6);
        color: white;
        font-weight: 600;
        transition: background 0.3s ease, transform 0.2s;
        width: 100%;
        padding: 0.5rem 0;
        border-radius: 0.375rem;
        border: none;
        cursor: pointer;
    }

    .btn-add-to-cart:hover {
        background: linear-gradient(to right, #3b82f6, #2563eb);
        transform: scale(1.02);
    }

    .btn-login {
        background: linear-gradient(to right, #a78bfa, #6366f1);
        color: white;
        font-weight: 600;
        transition: background 0.3s ease;
        display: block;
        width: 100%;
        padding: 0.5rem 0;
        text-align: center;
        border-radius: 0.375rem;
        text-decoration: none;
    }

    .btn-login:hover {
        background: linear-gradient(to right, #7c3aed, #4338ca);
    }

    .variant-label {
        display: inline-block;
        padding: 2px 8px;
        border-radius: 0.25rem;
        background-color: #e0e7ff;
        color: #1e3a8a;
        font-size: 0.875rem;
        margin-right: 6px;
        margin-top: 4px;
        user-select: none;
    }

    .variant-label.size {
        background-color: #bfdbfe;
        color: #1e40af;
    }
</style>

<div class="container mx-auto p-6">
    <h1 class="page-title text-3xl font-baloo mb-6 text-center text-gray-800">Mặc đẹp – Sống chất – Đậm dấu ấn riêng</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
            @php
                $imageUrl = $product->image_url;

                // Nếu ảnh bắt đầu bằng 'assets/', dùng trực tiếp
                if (Str::startsWith($imageUrl, 'assets/')) {
                    $imagePath = asset($imageUrl);
                } else {
                    $imagePath = asset('storage/' . $imageUrl);
                }

                $totalStock = $product->variants->sum('stock');
            @endphp

            <div class="product-card">
                <a href="{{ route('products.show', $product->id) }}" class="block hover:underline">
                    <div class="product-image-container">
                        <img src="{{ $imagePath }}" alt="{{ $product->name }}"
                             onerror="this.onerror=null; this.src='{{ $defaultImageUrl }}';">
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                </a>

                <p class="text-gray-600">{{ number_format($product->price) }} VNĐ</p>
                <p class="text-sm text-gray-500">Còn {{ $totalStock }} sản phẩm</p>

                @if($product->variants->count())
                    <div class="mt-2">
                        <p class="text-sm font-medium text-gray-700">Màu sắc:</p>
                        <div class="flex flex-wrap">
                            @foreach($product->variants->pluck('color_name')->unique() as $color)
                                <span class="variant-label">{{ $color }}</span>
                            @endforeach
                        </div>
                    </div>

                    <div class="mt-2">
                        <p class="text-sm font-medium text-gray-700">Kích cỡ:</p>
                        <div class="flex flex-wrap">
                            @foreach($product->variants->pluck('size_name')->unique() as $size)
                                <span class="variant-label size">{{ $size }}</span>
                            @endforeach
                        </div>
                    </div>
                @endif

                <div class="mt-4">
                    @auth
                        <a href="{{ route('products.show', $product->id) }}" class="btn-add-to-cart text-center block mt-2">
                            Thêm vào giỏ hàng
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="btn-login mt-2">
                            Đăng nhập để mua hàng
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <p class="col-span-full text-center text-gray-500">Không có sản phẩm nào để hiển thị.</p>
        @endforelse
    </div>
</div>
@endsection

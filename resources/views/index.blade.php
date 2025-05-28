@extends('layouts.app')

@section('content')
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
    }

    .btn-add-to-cart {
        background: linear-gradient(to right, #60a5fa, #3b82f6);
        color: white;
        font-weight: 600;
        transition: background 0.3s ease, transform 0.2s;
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
    }

    .btn-login:hover {
        background: linear-gradient(to right, #7c3aed, #4338ca);
    }
</style>

<div class="container mx-auto p-6">
    <h1 class="page-title text-3xl font-baloo mb-6 text-center text-gray-800">Thời trang mới Đồ áo xinh</h1>

    <div class="grid grid-cols-1 sm:grid-cols-2 md:grid-cols-3 lg:grid-cols-3 gap-6">
        @forelse($products as $product)
        <div class="product-card rounded-lg shadow-lg p-4 hover:shadow-xl transition-shadow">
            <div>
                @php
                    $defaultImageUrl = asset('images/default-product.png');
                @endphp

                {{-- Bọc phần ảnh và tên sản phẩm trong thẻ <a> để click được --}}
                <a href="{{ route('products.show', $product->id) }}" class="block hover:underline">
                    <div class="product-image-container">
                        @if(!empty($product->image_url) && Storage::disk('public')->exists($product->image_url))
                            <img
                                src="{{ asset('storage/' . $product->image_url) }}"
                                alt="{{ $product->name }}"
                                onerror="this.onerror=null; this.src='{{ $defaultImageUrl }}';">
                        @else
                            <img
                                src="{{ $defaultImageUrl }}"
                                alt="{{ $product->name }}">
                        @endif
                    </div>

                    <h3 class="text-lg font-semibold text-gray-800">{{ $product->name }}</h3>
                </a>

                <p class="text-gray-600">{{ number_format($product->price) }} VNĐ</p>
                <p class="text-sm text-gray-500">Còn {{ $product->stock }} sản phẩm</p>
            </div>

            <div class="mt-4">
                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST" class="mt-2">
                        @csrf
                        <button type="submit" class="btn-add-to-cart px-4 py-2 rounded w-full">
                            Thêm vào giỏ hàng
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="btn-login px-4 py-2 rounded w-full text-center block mt-2">
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

@extends('layouts.app')

@section('content')
<style>
    .featured-page {
        padding: 40px 0 80px;
    }

    .featured-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .featured-header-label {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        font-size: 0.82rem;
        font-weight: 600;
        color: #C8956C;
        text-transform: uppercase;
        letter-spacing: 1.5px;
        margin-bottom: 10px;
    }

    .featured-header-title {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 8px;
    }

    .featured-header-subtitle {
        color: #9CA3AF;
        font-size: 0.95rem;
    }

    .featured-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 28px;
    }

    /* Reuse p-card styles from products/index */
    .f-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #F3F4F6;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
    }

    .f-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border-color: rgba(200, 149, 108, 0.3);
    }

    .f-card-img {
        width: 100%;
        height: 260px;
        overflow: hidden;
        position: relative;
    }

    .f-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .f-card:hover .f-card-img img {
        transform: scale(1.08);
    }

    .f-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .f-card-name {
        font-family: 'Inter', sans-serif;
        font-size: 1rem;
        font-weight: 600;
        color: #1A1A1A;
        margin-bottom: 8px;
        text-decoration: none;
        display: -webkit-box;
        -webkit-line-clamp: 2;
        -webkit-box-orient: vertical;
        overflow: hidden;
        transition: color 0.2s;
    }

    .f-card-name:hover {
        color: #C8956C;
    }

    .f-card-price {
        font-size: 1.15rem;
        font-weight: 700;
        color: #DC2626;
        margin-bottom: 4px;
    }

    .f-card-stock {
        font-size: 0.82rem;
        color: #9CA3AF;
        margin-bottom: 16px;
    }

    .f-card-cta {
        display: block;
        width: 100%;
        padding: 12px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
        margin-top: auto;
    }

    .f-card-cta-primary {
        background: linear-gradient(135deg, #C8956C, #A67548);
        color: white;
    }

    .f-card-cta-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(200, 149, 108, 0.4);
        color: white;
    }

    .f-card-cta-login {
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
    }

    .f-card-cta-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(27, 42, 74, 0.3);
        color: white;
    }

    .featured-empty {
        text-align: center;
        padding: 60px 20px;
        grid-column: 1 / -1;
        color: #9CA3AF;
    }

    @media (max-width: 768px) {
        .featured-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }
    }
</style>

<div class="featured-page">
    <div class="featured-header">
        <span class="featured-header-label">
            <i class="fa-solid fa-fire"></i> Hot Trend
        </span>
        <h1 class="featured-header-title">Thời Trang Mới Đồ Áo Xinh</h1>
        <div class="section-divider"></div>
        <p class="featured-header-subtitle">Những sản phẩm được yêu thích nhất tại DOHAFASHION</p>
    </div>

    <div class="featured-grid">
        @forelse($products as $product)
        <div class="f-card">
            @php
                $defaultImageUrl = asset('images/default-product.png');
            @endphp

            <a href="{{ route('products.show', $product->id) }}">
                <div class="f-card-img">
                    @if(!empty($product->image_url) && Storage::disk('public')->exists($product->image_url))
                        <img src="{{ asset('storage/' . $product->image_url) }}" alt="{{ $product->name }}"
                             onerror="this.onerror=null; this.src='{{ $defaultImageUrl }}';">
                    @else
                        <img src="{{ $defaultImageUrl }}" alt="{{ $product->name }}">
                    @endif
                </div>
            </a>

            <div class="f-card-body">
                <a href="{{ route('products.show', $product->id) }}" class="f-card-name">{{ $product->name }}</a>
                <p class="f-card-price">{{ number_format($product->price) }} VNĐ</p>
                <p class="f-card-stock"><i class="fa-solid fa-box" style="margin-right: 4px;"></i> Còn {{ $product->stock }} sản phẩm</p>

                @auth
                    <form action="{{ route('cart.add', $product) }}" method="POST">
                        @csrf
                        <button type="submit" class="f-card-cta f-card-cta-primary">
                            <i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng
                        </button>
                    </form>
                @else
                    <a href="{{ route('login') }}" class="f-card-cta f-card-cta-login">
                        <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập để mua
                    </a>
                @endauth
            </div>
        </div>
        @empty
            <div class="featured-empty">
                <i class="fa-solid fa-shirt" style="font-size: 2.5rem; margin-bottom: 12px; display: block; color: #D1D5DB;"></i>
                <p>Không có sản phẩm nào để hiển thị.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

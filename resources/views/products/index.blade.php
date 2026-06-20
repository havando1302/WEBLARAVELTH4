@extends('layouts.app')

@section('content')
@php
    use Illuminate\Support\Str;
    $defaultImageUrl = asset('assets/img/default.jpg');
@endphp

<style>
    .products-page {
        padding: 40px 0 80px;
    }

    /* ---- Page header ---- */
    .products-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .products-header-label {
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

    .products-header-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 8px;
    }

    .products-header-subtitle {
        color: #9CA3AF;
        font-size: 0.95rem;
    }

    /* ---- Product Grid ---- */
    .products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 28px;
    }

    /* ---- Product Card ---- */
    .p-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #F3F4F6;
        overflow: hidden;
        transition: all 0.4s cubic-bezier(0.4, 0, 0.2, 1);
        display: flex;
        flex-direction: column;
        position: relative;
    }

    .p-card:hover {
        transform: translateY(-8px);
        box-shadow: 0 20px 50px rgba(0, 0, 0, 0.1);
        border-color: rgba(200, 149, 108, 0.3);
    }

    /* Image */
    .p-card-img {
        position: relative;
        width: 100%;
        height: 280px;
        overflow: hidden;
    }

    .p-card-img img {
        width: 100%;
        height: 100%;
        object-fit: cover;
        transition: transform 0.6s cubic-bezier(0.4, 0, 0.2, 1);
    }

    .p-card:hover .p-card-img img {
        transform: scale(1.08);
    }

    .p-card-img-overlay {
        position: absolute;
        inset: 0;
        background: linear-gradient(to top, rgba(27, 42, 74, 0.5), transparent 60%);
        opacity: 0;
        transition: opacity 0.4s ease;
    }

    .p-card:hover .p-card-img-overlay {
        opacity: 1;
    }

    .p-card-quick-view {
        position: absolute;
        bottom: 16px;
        left: 50%;
        transform: translateX(-50%) translateY(20px);
        padding: 10px 24px;
        background: rgba(255, 255, 255, 0.95);
        color: #1B2A4A;
        font-weight: 600;
        font-size: 0.85rem;
        border-radius: 8px;
        text-decoration: none;
        opacity: 0;
        transition: all 0.3s ease;
        white-space: nowrap;
    }

    .p-card:hover .p-card-quick-view {
        opacity: 1;
        transform: translateX(-50%) translateY(0);
    }

    .p-card-quick-view:hover {
        background: #C8956C;
        color: white;
    }

    /* Body */
    .p-card-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .p-card-name {
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

    .p-card-name:hover {
        color: #C8956C;
    }

    .p-card-price-row {
        display: flex;
        align-items: center;
        gap: 8px;
        margin-bottom: 6px;
    }

    .p-card-price {
        font-size: 1.15rem;
        font-weight: 700;
        color: #DC2626;
    }

    .p-card-stock {
        font-size: 0.82rem;
        color: #9CA3AF;
        margin-bottom: 14px;
    }

    /* Variants */
    .p-card-variants {
        margin-top: auto;
        padding-top: 14px;
        border-top: 1px solid #F3F4F6;
    }

    .p-card-variant-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 6px;
    }

    .p-card-variant-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }

    .v-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        transition: all 0.2s ease;
    }

    .v-pill-color {
        background: #FDF8F3;
        color: #A67548;
        border: 1px solid #E8C5A8;
    }

    .v-pill-size {
        background: #E8EDF5;
        color: #2D4A7A;
        border: 1px solid #C7D2E4;
    }

    /* CTA */
    .p-card-cta {
        display: block;
        width: 100%;
        padding: 12px;
        margin-top: 16px;
        text-align: center;
        font-weight: 600;
        font-size: 0.9rem;
        border-radius: 10px;
        text-decoration: none;
        transition: all 0.3s ease;
        cursor: pointer;
        border: none;
    }

    .p-card-cta-primary {
        background: linear-gradient(135deg, #C8956C, #A67548);
        color: white;
    }

    .p-card-cta-primary:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(200, 149, 108, 0.4);
        color: white;
    }

    .p-card-cta-login {
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
    }

    .p-card-cta-login:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(27, 42, 74, 0.3);
        color: white;
    }

    /* Empty state */
    .products-empty {
        text-align: center;
        padding: 80px 20px;
        grid-column: 1 / -1;
    }

    .products-empty-icon {
        font-size: 3rem;
        color: #D1D5DB;
        margin-bottom: 16px;
    }

    .products-empty-text {
        color: #9CA3AF;
        font-size: 1.05rem;
    }

    @media (max-width: 768px) {
        .products-grid {
            grid-template-columns: repeat(auto-fill, minmax(250px, 1fr));
            gap: 16px;
        }

        .p-card-img {
            height: 220px;
        }

        .products-header-title {
            font-size: 1.8rem;
        }
    }

    @media (max-width: 480px) {
        .products-grid {
            grid-template-columns: 1fr;
        }
    }
</style>

<div class="products-page">
    <div class="products-header">
        <span class="products-header-label">
            <i class="fa-solid fa-sparkles"></i> Bộ sưu tập
        </span>
        <h1 class="products-header-title">Mặc Đẹp – Sống Chất – Đậm Dấu Ấn</h1>
        <div class="section-divider"></div>
        <p class="products-header-subtitle">Khám phá những thiết kế mới nhất từ DOHAFASHION</p>
    </div>

    <div class="products-grid">
        @forelse($products as $product)
            @php
                $imageUrl = $product->image_url;
                if (Str::startsWith($imageUrl, 'assets/')) {
                    $imagePath = asset($imageUrl);
                } else {
                    $imagePath = asset('storage/' . $imageUrl);
                }
                $totalStock = $product->variants->sum('stock');
            @endphp

            <div class="p-card">
                <a href="{{ route('products.show', $product->id) }}">
                    <div class="p-card-img">
                        <img src="{{ $imagePath }}" alt="{{ $product->name }}"
                             onerror="this.onerror=null; this.src='{{ $defaultImageUrl }}';">
                        <div class="p-card-img-overlay"></div>
                        <span class="p-card-quick-view">
                            <i class="fa-solid fa-eye"></i> Xem chi tiết
                        </span>
                    </div>
                </a>

                <div class="p-card-body">
                    <a href="{{ route('products.show', $product->id) }}" class="p-card-name">{{ $product->name }}</a>

                    <div class="p-card-price-row">
                        <span class="p-card-price">{{ number_format($product->price) }} VNĐ</span>
                    </div>
                    <p class="p-card-stock">
                        <i class="fa-solid fa-box" style="margin-right: 4px;"></i> Còn {{ $totalStock }} sản phẩm
                    </p>

                    @if($product->variants->count())
                        <div class="p-card-variants">
                            <p class="p-card-variant-label">Màu sắc</p>
                            <div class="p-card-variant-pills">
                                @foreach($product->variants->pluck('color_name')->unique() as $color)
                                    <span class="v-pill v-pill-color">{{ $color }}</span>
                                @endforeach
                            </div>
                            <p class="p-card-variant-label" style="margin-top: 8px;">Kích cỡ</p>
                            <div class="p-card-variant-pills">
                                @foreach($product->variants->pluck('size_name')->unique() as $size)
                                    <span class="v-pill v-pill-size">{{ $size }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    @auth
                        <a href="{{ route('products.show', $product->id) }}" class="p-card-cta p-card-cta-primary">
                            <i class="fa-solid fa-bag-shopping"></i> Thêm vào giỏ hàng
                        </a>
                    @else
                        <a href="{{ route('login') }}" class="p-card-cta p-card-cta-login">
                            <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập để mua
                        </a>
                    @endauth
                </div>
            </div>
        @empty
            <div class="products-empty">
                <div class="products-empty-icon"><i class="fa-solid fa-shirt"></i></div>
                <p class="products-empty-text">Không có sản phẩm nào để hiển thị.</p>
            </div>
        @endforelse
    </div>
</div>
@endsection

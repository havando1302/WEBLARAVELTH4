@extends('layouts.app')

@section('content')
<style>
    .admin-products-page {
        padding: 30px 0 80px;
    }

    .admin-products-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .admin-products-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1B2A4A;
    }

    .admin-add-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 24px;
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.9rem;
        transition: all 0.3s;
    }

    .admin-add-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(27, 42, 74, 0.3);
        color: white;
    }

    .admin-products-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(300px, 1fr));
        gap: 24px;
    }

    .admin-product-card {
        background: white;
        border-radius: 16px;
        border: 1px solid #F3F4F6;
        overflow: hidden;
        transition: all 0.3s ease;
        display: flex;
        flex-direction: column;
    }

    .admin-product-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .admin-product-img {
        width: 100%;
        height: 200px;
        object-fit: cover;
    }

    .admin-product-body {
        padding: 20px;
        flex: 1;
        display: flex;
        flex-direction: column;
    }

    .admin-product-name {
        font-weight: 600;
        font-size: 1rem;
        color: #1A1A1A;
        margin-bottom: 6px;
    }

    .admin-product-price {
        font-weight: 700;
        color: #DC2626;
        font-size: 1.05rem;
        margin-bottom: 16px;
    }

    .admin-variant-section {
        margin-bottom: 12px;
    }

    .admin-variant-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 6px;
    }

    .admin-variant-pills {
        display: flex;
        flex-wrap: wrap;
        gap: 4px;
    }

    .av-pill {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.75rem;
        font-weight: 500;
        transition: all 0.2s;
    }

    .av-pill-color {
        background: #FDF8F3;
        color: #A67548;
        border: 1px solid #E8C5A8;
    }

    .av-pill-size {
        background: #E8EDF5;
        color: #2D4A7A;
        border: 1px solid #C7D2E4;
    }

    .av-pill:hover {
        transform: scale(1.05);
    }

    .admin-product-actions {
        display: flex;
        gap: 8px;
        margin-top: auto;
        padding-top: 16px;
        border-top: 1px solid #F3F4F6;
    }

    .admin-btn-edit {
        flex: 1;
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px;
        background: #FEF3C7;
        color: #92400E;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        transition: all 0.2s;
    }

    .admin-btn-edit:hover {
        background: #F59E0B;
        color: white;
    }

    .admin-btn-delete {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        gap: 6px;
        padding: 10px 16px;
        background: #FEE2E2;
        color: #DC2626;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.85rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .admin-btn-delete:hover {
        background: #DC2626;
        color: white;
    }
</style>

<div class="admin-products-page">
    <div class="admin-products-header">
        <h1><i class="fa-solid fa-shirt" style="color: #C8956C; margin-right: 8px;"></i> Danh Sách Sản Phẩm</h1>
        <a href="{{ route('admin.products.create') }}" class="admin-add-btn">
            <i class="fa-solid fa-plus"></i> Thêm sản phẩm
        </a>
    </div>

    <div class="admin-products-grid">
        @foreach($products as $product)
            <div class="admin-product-card">
                <img
                    src="{{ $product->image_url
                        ? (Str::startsWith($product->image_url, 'assets/')
                            ? asset($product->image_url)
                            : asset('storage/' . $product->image_url))
                        : 'https://via.placeholder.com/150' }}"
                    alt="{{ $product->name }}"
                    class="admin-product-img">

                <div class="admin-product-body">
                    <h3 class="admin-product-name">{{ $product->name }}</h3>
                    <p class="admin-product-price">{{ number_format($product->price) }} VNĐ</p>

                    @if($product->variants->count())
                        <div class="admin-variant-section">
                            <p class="admin-variant-label">Màu sắc</p>
                            <div class="admin-variant-pills">
                                @foreach($product->variants->pluck('color_name')->unique() as $color)
                                    <span class="av-pill av-pill-color">{{ $color }}</span>
                                @endforeach
                            </div>
                        </div>
                        <div class="admin-variant-section">
                            <p class="admin-variant-label">Kích cỡ</p>
                            <div class="admin-variant-pills">
                                @foreach($product->variants->pluck('size_name')->unique() as $size)
                                    <span class="av-pill av-pill-size">{{ $size }}</span>
                                @endforeach
                            </div>
                        </div>
                    @endif

                    <div class="admin-product-actions">
                        <a href="{{ route('admin.products.edit', $product) }}" class="admin-btn-edit">
                            <i class="fa-solid fa-pen"></i> Sửa
                        </a>
                        <form action="{{ route('admin.products.destroy', $product) }}" method="POST" style="display:inline">
                            @csrf
                            @method('DELETE')
                            <button type="submit" class="admin-btn-delete" onclick="return confirm('Bạn có chắc muốn xóa?')">
                                <i class="fa-solid fa-trash"></i> Xóa
                            </button>
                        </form>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
</div>
@endsection

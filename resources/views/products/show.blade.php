@extends('layouts.app')

@section('title', "Chi tiết sản phẩm - {$product->name} | DOHAFASHION")

@section('content')

<style>
    .detail-page {
        padding: 30px 0 80px;
    }

    /* ---- Alert ---- */
    .alert-custom {
        background: linear-gradient(135deg, #D1FAE5, #A7F3D0);
        color: #065F46;
        padding: 16px 24px;
        border-radius: 12px;
        margin-bottom: 24px;
        font-weight: 600;
        text-align: center;
        animation: fadeInDown 0.4s ease;
        border: 1px solid #6EE7B7;
    }

    /* ---- Breadcrumb ---- */
    .breadcrumb-custom {
        display: flex;
        align-items: center;
        gap: 8px;
        font-size: 0.88rem;
        color: #9CA3AF;
        margin-bottom: 30px;
        flex-wrap: wrap;
    }

    .breadcrumb-custom a {
        color: #6B7280;
        text-decoration: none;
        transition: color 0.2s;
        font-weight: 500;
    }

    .breadcrumb-custom a:hover {
        color: #C8956C;
    }

    .breadcrumb-custom .bc-separator {
        color: #D1D5DB;
    }

    .breadcrumb-custom .bc-current {
        color: #C8956C;
        font-weight: 600;
    }

    /* ---- Product Layout ---- */
    .detail-wrapper {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 50px;
        align-items: start;
    }

    /* ---- Image ---- */
    .detail-image-wrap {
        position: relative;
        border-radius: 16px;
        overflow: hidden;
        background: #F9FAFB;
    }

    .detail-image-wrap img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .detail-image-wrap:hover img {
        transform: scale(1.05);
    }

    .detail-discount-badge {
        position: absolute;
        top: 16px;
        left: 16px;
        background: linear-gradient(135deg, #DC2626, #EF4444);
        color: white;
        padding: 6px 14px;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 700;
    }

    /* ---- Info ---- */
    .detail-info {
        display: flex;
        flex-direction: column;
    }

    .detail-name {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 8px;
        line-height: 1.3;
    }

    .detail-admin-actions {
        display: flex;
        gap: 10px;
        margin-bottom: 16px;
    }

    .detail-divider {
        height: 1px;
        background: linear-gradient(90deg, #E5E7EB, transparent);
        margin: 16px 0;
    }

    /* Price */
    .detail-price-row {
        display: flex;
        align-items: baseline;
        gap: 12px;
        margin-bottom: 8px;
        flex-wrap: wrap;
    }

    .detail-price {
        font-size: 2rem;
        font-weight: 800;
        color: #DC2626;
    }

    .detail-price-original {
        text-decoration: line-through;
        color: #9CA3AF;
        font-size: 1.1rem;
    }

    .detail-price-discount {
        background: linear-gradient(135deg, #DC2626, #EF4444);
        color: white;
        padding: 4px 12px;
        border-radius: 6px;
        font-size: 0.82rem;
        font-weight: 700;
    }

    .detail-sold {
        font-size: 0.92rem;
        color: #6B7280;
        margin-bottom: 16px;
    }

    .detail-sold span {
        font-weight: 700;
        color: #1B2A4A;
    }

    .detail-short-desc {
        font-size: 0.95rem;
        color: #6B7280;
        line-height: 1.8;
        margin-bottom: 24px;
    }

    /* Selectors */
    .detail-selector-group {
        margin-bottom: 20px;
    }

    .detail-selector-label {
        font-size: 0.92rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 10px;
    }

    .detail-select {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #E5E7EB;
        border-radius: 10px;
        font-size: 0.95rem;
        font-family: 'Inter', sans-serif;
        color: #374151;
        background: white;
        appearance: auto;
        transition: all 0.3s ease;
        outline: none;
        cursor: pointer;
    }

    .detail-select:focus {
        border-color: #C8956C;
        box-shadow: 0 0 0 3px rgba(200, 149, 108, 0.15);
    }

    /* Stock info */
    .detail-stock-info {
        font-size: 0.9rem;
        font-weight: 600;
        min-height: 24px;
        margin-bottom: 12px;
        padding: 6px 0;
    }

    .stock-available {
        color: #059669;
    }

    .stock-empty {
        color: #DC2626;
    }

    /* Quantity */
    .detail-qty-row {
        display: flex;
        align-items: center;
        gap: 4px;
        margin-bottom: 24px;
    }

    .detail-qty-btn {
        width: 42px;
        height: 42px;
        border: 1.5px solid #E5E7EB;
        border-radius: 10px;
        background: white;
        font-size: 1.2rem;
        font-weight: 600;
        color: #374151;
        cursor: pointer;
        transition: all 0.2s ease;
        display: flex;
        align-items: center;
        justify-content: center;
    }

    .detail-qty-btn:hover:not(:disabled) {
        border-color: #C8956C;
        color: #C8956C;
        background: #FDF8F3;
    }

    .detail-qty-btn:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    .detail-qty-input {
        width: 64px;
        height: 42px;
        text-align: center;
        border: 1.5px solid #E5E7EB;
        border-radius: 10px;
        font-size: 1rem;
        font-weight: 600;
        font-family: 'Inter', sans-serif;
        outline: none;
        transition: border-color 0.2s;
    }

    .detail-qty-input:focus {
        border-color: #C8956C;
    }

    .detail-qty-input:disabled {
        opacity: 0.4;
        cursor: not-allowed;
    }

    /* Add to cart */
    .detail-add-cart {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
        border: none;
        border-radius: 12px;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        letter-spacing: 0.5px;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
    }

    .detail-add-cart:hover:not(:disabled) {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(27, 42, 74, 0.3);
    }

    .detail-add-cart:disabled {
        opacity: 0.5;
        cursor: not-allowed;
    }

    /* Share */
    .detail-share {
        margin-top: 32px;
        padding-top: 24px;
        border-top: 1px solid #F3F4F6;
    }

    .detail-share-title {
        font-size: 0.9rem;
        font-weight: 600;
        color: #6B7280;
        margin-bottom: 12px;
    }

    .detail-share-links {
        display: flex;
        gap: 10px;
    }

    .detail-share-link {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 42px;
        height: 42px;
        border-radius: 10px;
        background: #F3F4F6;
        color: #6B7280;
        font-size: 1.1rem;
        text-decoration: none;
        transition: all 0.3s ease;
    }

    .detail-share-link:hover {
        transform: translateY(-3px);
    }

    .share-facebook:hover { background: #1877F2; color: white; }
    .share-twitter:hover { background: #1DA1F2; color: white; }
    .share-whatsapp:hover { background: #25D366; color: white; }
    .share-linkedin:hover { background: #0A66C2; color: white; }

    /* ---- Description ---- */
    .detail-description {
        margin-top: 60px;
        padding-top: 40px;
        border-top: 1px solid #E5E7EB;
    }

    .detail-desc-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 24px;
        position: relative;
        display: inline-block;
    }

    .detail-desc-title::after {
        content: '';
        position: absolute;
        bottom: -6px;
        left: 0;
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #C8956C, #D4A76A);
        border-radius: 2px;
    }

    .detail-desc-content {
        font-size: 0.95rem;
        color: #4B5563;
        line-height: 1.9;
    }

    /* Responsive */
    @media (max-width: 768px) {
        .detail-wrapper {
            grid-template-columns: 1fr;
            gap: 30px;
        }

        .detail-name {
            font-size: 1.5rem;
        }

        .detail-price {
            font-size: 1.6rem;
        }
    }
</style>

<div class="detail-page">
    @if (session('success'))
        <div class="alert-custom">
            <i class="fa-solid fa-circle-check" style="margin-right: 8px;"></i>
            {{ session('success') }}
        </div>
    @endif

    <!-- Breadcrumb -->
    <nav class="breadcrumb-custom">
        <a href="{{ url('/') }}"><i class="fa-solid fa-house" style="margin-right: 4px;"></i> Trang chủ</a>
        <span class="bc-separator"><i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i></span>
        <a href="{{ route('products.index') }}">Sản phẩm</a>
        <span class="bc-separator"><i class="fa-solid fa-chevron-right" style="font-size: 0.65rem;"></i></span>
        <span class="bc-current">{{ $product->name }}</span>
    </nav>

    <!-- Product Detail -->
    <div class="detail-wrapper">
        <!-- Image -->
        <div class="detail-image-wrap">
            <img
                src="{{ Str::startsWith($product->image_url, 'assets/') ? asset($product->image_url) : asset('storage/' . $product->image_url) }}"
                alt="{{ $product->name }}">
            <span class="detail-discount-badge">-15%</span>
        </div>

        <!-- Info -->
        <div class="detail-info">
            <h1 class="detail-name">{{ $product->name }}</h1>

            @can('update', $product)
            <div class="detail-admin-actions">
                <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning" style="border-radius: 8px; font-size: 0.85rem;">
                    <i class="fa-solid fa-pen"></i> Sửa
                </a>
                <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                    @csrf
                    @method('DELETE')
                    <button type="submit" class="btn btn-danger" style="border-radius: 8px; font-size: 0.85rem;">
                        <i class="fa-solid fa-trash"></i> Xóa
                    </button>
                </form>
            </div>
            @endcan

            <div class="detail-divider"></div>

            @php
                $currentPrice = $product->price;
                $originalPrice = $currentPrice / (1 - 0.15);
                $soldQuantity = 120;
            @endphp

            <div class="detail-price-row">
                <span class="detail-price">{{ number_format($currentPrice, 0, ',', '.') }}₫</span>
                <span class="detail-price-original">{{ number_format($originalPrice, 0, ',', '.') }}₫</span>
                <span class="detail-price-discount">-15%</span>
            </div>

            <p class="detail-sold">
                <i class="fa-solid fa-fire" style="color: #F59E0B; margin-right: 4px;"></i>
                Đã bán: <span>{{ $soldQuantity }}</span>
            </p>

            <p class="detail-short-desc">{{ $product->short_description }}</p>

            <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" id="addToCartForm">
                @csrf

                @if($colors->count())
                <div class="detail-selector-group">
                    <label class="detail-selector-label" for="color_id">
                        <i class="fa-solid fa-palette" style="color: #C8956C; margin-right: 6px;"></i> Chọn màu sắc
                    </label>
                    <select name="color_id" id="color_id" class="detail-select" required>
                        <option value="" disabled selected>-- Chọn màu --</option>
                        @foreach($colors as $color)
                        <option value="{{ $color->id }}">{{ $color->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                @if($sizes->count())
                <div class="detail-selector-group">
                    <label class="detail-selector-label" for="size_id">
                        <i class="fa-solid fa-ruler" style="color: #C8956C; margin-right: 6px;"></i> Chọn kích thước
                    </label>
                    <select name="size_id" id="size_id" class="detail-select" required>
                        <option value="" disabled selected>-- Chọn size --</option>
                        @foreach($sizes as $size)
                        <option value="{{ $size->id }}">{{ $size->name }}</option>
                        @endforeach
                    </select>
                </div>
                @endif

                <div id="stock-info" class="detail-stock-info"></div>

                <div class="detail-qty-row">
                    <button type="button" class="detail-qty-btn" id="quantity-minus" disabled>−</button>
                    <input type="number" name="quantity" id="quantity-input" class="detail-qty-input" value="1" min="1" required disabled>
                    <button type="button" class="detail-qty-btn" id="quantity-plus" disabled>+</button>
                </div>

                <button type="submit" id="add-to-cart-btn" class="detail-add-cart" disabled>
                    <i class="fa-solid fa-bag-shopping"></i> THÊM VÀO GIỎ HÀNG
                </button>
            </form>

            <!-- Share -->
            <div class="detail-share">
                <p class="detail-share-title">Chia sẻ sản phẩm</p>
                <div class="detail-share-links">
                    <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" class="detail-share-link share-facebook" title="Facebook">
                        <i class="fa-brands fa-facebook-f"></i>
                    </a>
                    <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($product->name) }}" target="_blank" class="detail-share-link share-twitter" title="X">
                        <i class="fa-brands fa-x-twitter"></i>
                    </a>
                    <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' ' . request()->fullUrl()) }}" target="_blank" class="detail-share-link share-whatsapp" title="WhatsApp">
                        <i class="fa-brands fa-whatsapp"></i>
                    </a>
                    <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($product->name) }}" target="_blank" class="detail-share-link share-linkedin" title="LinkedIn">
                        <i class="fa-brands fa-linkedin-in"></i>
                    </a>
                </div>
            </div>
        </div>
    </div>

    <!-- Description -->
    <div class="detail-description">
        <h3 class="detail-desc-title">Mô tả chi tiết</h3>
        <div class="detail-desc-content">
            {!! nl2br(e($product->description)) !!}
        </div>
    </div>
</div>

<script>
    const productVariants = @json($variants);

    document.addEventListener('DOMContentLoaded', function() {
        const colorSelect = document.getElementById('color_id');
        const sizeSelect = document.getElementById('size_id');
        const stockInfo = document.getElementById('stock-info');
        const quantityInput = document.getElementById('quantity-input');
        const minusBtn = document.getElementById('quantity-minus');
        const plusBtn = document.getElementById('quantity-plus');
        const addToCartBtn = document.getElementById('add-to-cart-btn');
        const addToCartForm = document.getElementById('addToCartForm');

        let currentStock = 0;

        function updateStockStatus() {
            const selectedColorId = colorSelect.value;
            const selectedSizeId = sizeSelect.value;

            if (selectedColorId && selectedSizeId) {
                const variant = productVariants.find(v =>
                    v.color_id == selectedColorId && v.size_id == selectedSizeId
                );

                if (variant) {
                    currentStock = variant.stock;
                    quantityInput.max = currentStock;

                    if (currentStock > 0) {
                        stockInfo.innerHTML = `<i class="fa-solid fa-circle-check" style="margin-right: 6px;"></i> Còn ${currentStock} sản phẩm`;
                        stockInfo.className = 'detail-stock-info stock-available';
                        addToCartBtn.disabled = false;
                        quantityInput.disabled = false;
                        minusBtn.disabled = false;
                        plusBtn.disabled = false;

                        if (parseInt(quantityInput.value) > currentStock) {
                            quantityInput.value = currentStock;
                        }
                    } else {
                        stockInfo.innerHTML = `<i class="fa-solid fa-circle-xmark" style="margin-right: 6px;"></i> Hết hàng`;
                        stockInfo.className = 'detail-stock-info stock-empty';
                        addToCartBtn.disabled = true;
                        quantityInput.disabled = true;
                        minusBtn.disabled = true;
                        plusBtn.disabled = true;
                    }
                } else {
                    stockInfo.innerHTML = `<i class="fa-solid fa-circle-xmark" style="margin-right: 6px;"></i> Lựa chọn không có sẵn`;
                    stockInfo.className = 'detail-stock-info stock-empty';
                    currentStock = 0;
                    addToCartBtn.disabled = true;
                    quantityInput.disabled = true;
                    minusBtn.disabled = true;
                    plusBtn.disabled = true;
                }
            } else {
                stockInfo.textContent = '';
                currentStock = 0;
                addToCartBtn.disabled = true;
                quantityInput.disabled = true;
                minusBtn.disabled = true;
                plusBtn.disabled = true;
            }
        }

        colorSelect.addEventListener('change', updateStockStatus);
        sizeSelect.addEventListener('change', updateStockStatus);

        minusBtn.addEventListener('click', () => {
            let currentVal = parseInt(quantityInput.value);
            if (currentVal > 1) {
                quantityInput.value = currentVal - 1;
            }
        });

        plusBtn.addEventListener('click', () => {
            let currentVal = parseInt(quantityInput.value);
            if (currentVal < currentStock) {
                quantityInput.value = currentVal + 1;
            } else {
                alert('Số lượng đã đạt giới hạn tồn kho!');
            }
        });

        quantityInput.addEventListener('input', () => {
            let val = parseInt(quantityInput.value);
            if (isNaN(val) || val < 1) {
                quantityInput.value = 1;
            } else if (val > currentStock) {
                alert('Số lượng vượt quá tồn kho!');
                quantityInput.value = currentStock;
            }
        });

        addToCartForm.addEventListener('submit', function(event) {
            const quantity = parseInt(quantityInput.value);
            if (quantity > currentStock) {
                event.preventDefault();
                alert(`Xin lỗi, chúng tôi chỉ còn ${currentStock} sản phẩm. Vui lòng giảm số lượng.`);
            }
            if (currentStock <= 0) {
                event.preventDefault();
                alert('Sản phẩm này đã hết hàng, bạn không thể thêm vào giỏ.');
            }
        });
    });
</script>
@endsection
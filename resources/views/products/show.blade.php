@extends('layouts.app')

@section('title', "Chi tiết sản phẩm - {$product->name} | Teddy Paradise")

@section('content')
@if (session('success'))
    <div class="alert alert-success" style="
        background-color: #d4edda; 
        color: #155724; 
        border: 1px solid #c3e6cb; 
        padding: 15px; 
        margin-bottom: 20px; 
        border-radius: 5px;
        text-align: center;
        font-weight: bold;
    ">
        {{ session('success') }}
    </div>
@endif

<style>
    .grid { max-width: 1200px; margin: 0 auto; padding: 20px; }
    .product_page { display: flex; flex-wrap: wrap; gap: 40px; margin-top: 30px; }
    .product_page-introduce { flex: 2; display: flex; gap: 20px; flex-wrap: wrap; }
    .product_page-intro-item { flex: 1; min-width: 300px; }
    .product_page-intro-img { width: 100%; border-radius: 10px; object-fit: cover; }
    .product_page-intro-subtitle { font-size: 1.2rem; color: #555; margin-bottom: 10px; }
    .product_page-intro-subtitle a { color: #555; text-decoration: none; font-weight: 600; }
    .subdivider { margin: 0 5px; }
    .product_page-intro-header { font-size: 2rem; font-weight: 700; margin-bottom: 10px; }
    .intro_line { border-bottom: 1px solid #ddd; margin: 15px 0; }
    .product_page-intro-text { font-size: 1.2rem; color: #333; margin-bottom: 25px; }
    select { font-size: 1.2rem; padding: 8px 12px; border-radius: 6px; border: 1px solid #ccc; width: 100%; }
    .product_intro-count { display: flex; align-items: center; gap: 10px; }
    .product_intro-count-btn { font-size: 1.5rem; background-color: #e63946; color: white; border: none; width: 35px; height: 35px; border-radius: 6px; cursor: pointer; user-select: none; }
    .product_intro-count-value { width: 60px; font-size: 1.2rem; text-align: center; padding: 5px; border: 1px solid #ccc; border-radius: 6px; }
    .product_intro-count-btn:disabled, input[type="number"]:disabled { background-color: #ccc; cursor: not-allowed; }
    .product_btn-addtocart { margin-top: 20px; background-color: #1d3557; color: white; padding: 12px; font-size: 1.2rem; font-weight: 700; border: none; border-radius: 8px; width: 100%; cursor: pointer; transition: background-color 0.3s; }
    .product_btn-addtocart:hover { background-color: #457b9d; }
    .product_btn-addtocart:disabled { background-color: #a9a9a9; cursor: not-allowed; }
    .product_intro-share { margin-top: 40px; }
    .product_intro-share-header { font-weight: 700; margin-bottom: 10px; }
    .product_intro-share-link { display: flex; gap: 15px; font-size: 1.8rem; }
    .product_intro-share-icon { color: #1d3557; text-decoration: none; transition: color 0.3s; }
    .product_intro-share-icon:hover { color: #e63946; }
    .product_page-description { flex-basis: 100%; margin-top: 40px; }
    .product_page-description h3 { font-size: 1.8rem; margin-bottom: 20px; font-weight: 700; }
    .product_page-description-item { margin-bottom: 30px; font-size: 1.2rem; color: #444; }
    .product_page-description-item p { margin-bottom: 10px; line-height: 1.5; }
    .product_page-description-item ul { padding-left: 20px; }
    .product_page-description-item ul li { margin-bottom: 8px; }

    .price-container {
        display: flex;
        align-items: baseline;
        margin-bottom: 15px;
    }

    .current-price {
        font-size: 1.8rem;
        font-weight: 700;
        color: #e63946;
        margin-right: 10px;
    }

    .original-price-strike {
        text-decoration: line-through;
        color: #999;
        font-size: 1.2rem;
        margin-right: 10px;
    }

    .discount-percentage {
        background-color: #e63946;
        color: white;
        padding: 3px 8px;
        border-radius: 4px;
        font-size: 0.9rem;
        font-weight: bold;
    }

    .sold-quantity {
        font-size: 1.1rem;
        color: #555;
        margin-bottom: 15px;
    }

    .sold-quantity span {
        font-weight: bold;
        color: #1d3557;
    }

    @media (max-width: 768px) {
        .product_page, .product_page-introduce { flex-direction: column; }
        .product_page-intro-item { min-width: 100%; }
    }
</style>

<div class="grid">
    <div class="product_page">

    <div class="product_page-intro-item">
    <img 
        src="{{ Str::startsWith($product->image_url, 'assets/') ? asset($product->image_url) : asset('storage/' . $product->image_url) }}" 
        alt="{{ $product->name }}" 
        class="product_page-intro-img">
</div>


            <div class="product_page-intro-item" style="flex: 1;">
                <div class="product_page-intro-subtitle">
                    <a href="{{ url('/') }}" class="product_subtitle-trangchu">TRANG CHỦ</a>
                    <span class="subdivider">/</span>
                    <a href="{{ route('products.index') }}" class="product_page-subtitle-sanpham">SẢN PHẨM</a>
                    <span class="subdivider">/</span>
                    <span>{{ $product->name }}</span>
                </div>

                <h2 class="product_page-intro-header">{{ $product->name }}</h2>

                @can('update', $product)
                <div style="margin-bottom: 15px;">
                    <a href="{{ route('admin.products.edit', $product->id) }}" class="btn btn-warning">Sửa</a>
                    <form action="{{ route('admin.products.destroy', $product->id) }}" method="POST" style="display:inline-block" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?');">
                        @csrf
                        @method('DELETE')
                        <button type="submit" class="btn btn-danger">Xóa</button>
                    </form>
                </div>
                @endcan

                <div class="intro_line"></div>
                
                @php
                    $currentPrice = $product->price;
                    $originalPrice = $currentPrice / (1 - 0.15);
                    $soldQuantity = 120;
                @endphp

                <div class="price-container">
                    <span class="current-price">{{ number_format($currentPrice, 0, ',', '.') }}₫</span>
                    <span class="original-price-strike">{{ number_format($originalPrice, 0, ',', '.') }}₫</span>
                    <span class="discount-percentage">-15%</span>
                </div>

                <p class="sold-quantity">Đã bán: <span>{{ $soldQuantity }}</span></p>

                <p class="product_page-intro-text">{{ $product->short_description }}</p>

                <form action="{{ route('cart.add', ['product' => $product->id]) }}" method="POST" id="addToCartForm">
                    @csrf

                    @if($colors->count())
                    <div style="margin-top: 15px;">
                        <label for="color_id" style="font-size: 1.4rem; font-weight: bold;">Chọn màu sắc:</label>
                        <select name="color_id" id="color_id" required>
                            <option value="" disabled selected>-- Chọn màu --</option>
                            @foreach($colors as $color)
                            <option value="{{ $color->id }}">{{ $color->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    @if($sizes->count())
                    <div style="margin-top: 15px;">
                        <label for="size_id" style="font-size: 1.4rem; font-weight: bold;">Chọn kích thước:</label>
                        <select name="size_id" id="size_id" required>
                            <option value="" disabled selected>-- Chọn size --</option>
                            @foreach($sizes as $size)
                            <option value="{{ $size->id }}">{{ $size->name }}</option>
                            @endforeach
                        </select>
                    </div>
                    @endif

                    <div id="stock-info" style="margin-top: 10px; font-size: 1.2rem; color: #e63946; font-weight: bold; min-height: 22px;"></div>

                    <div class="product_intro-count" style="margin-top: 15px;">
                        <button type="button" class="product_intro-count-btn" id="quantity-minus" disabled>-</button>
                        <input type="number" name="quantity" id="quantity-input" class="product_intro-count-value" value="1" min="1" required disabled>
                        <button type="button" class="product_intro-count-btn" id="quantity-plus" disabled>+</button>
                    </div>

                    <button type="submit" id="add-to-cart-btn" class="product_btn-addtocart" disabled>THÊM VÀO GIỎ HÀNG</button>
                </form>

                <div class="product_intro-share">
                    <p class="product_intro-share-header">Chia sẻ cho bạn bè</p>
                    <div class="product_intro-share-link">
                        <a href="https://www.facebook.com/sharer/sharer.php?u={{ urlencode(request()->fullUrl()) }}" target="_blank" title="Chia sẻ qua Facebook" class="product_intro-share-icon"><i class="fa-brands fa-facebook-f"></i></a>
                        <a href="https://twitter.com/intent/tweet?url={{ urlencode(request()->fullUrl()) }}&text={{ urlencode($product->name) }}" target="_blank" title="Chia sẻ qua X" class="product_intro-share-icon"><i class="fa-brands fa-x-twitter"></i></a>
                        <a href="https://api.whatsapp.com/send?text={{ urlencode($product->name . ' ' . request()->fullUrl()) }}" target="_blank" title="Chia sẻ qua WhatsApp" class="product_intro-share-icon"><i class="fa-brands fa-whatsapp"></i></a>
                        <a href="https://www.linkedin.com/shareArticle?mini=true&url={{ urlencode(request()->fullUrl()) }}&title={{ urlencode($product->name) }}" target="_blank" title="Chia sẻ qua LinkedIn" class="product_intro-share-icon"><i class="fa-brands fa-linkedin-in"></i></a>
                    </div>
                </div>

            </div>
        </div>

        <div class="product_page-description">
            <h3>Mô tả chi tiết</h3>
            <div class="product_page-description-item">
                {!! nl2br(e($product->description)) !!}
            </div>
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
                        stockInfo.textContent = `Số lượng còn: ${currentStock}`;
                        stockInfo.style.color = '#1d3557';
                        addToCartBtn.disabled = false;
                        quantityInput.disabled = false;
                        minusBtn.disabled = false;
                        plusBtn.disabled = false;
                        
                        if (parseInt(quantityInput.value) > currentStock) {
                            quantityInput.value = currentStock;
                        }
                    } else {
                        stockInfo.textContent = 'Hết hàng';
                        stockInfo.style.color = '#e63946';
                        addToCartBtn.disabled = true;
                        quantityInput.disabled = true;
                        minusBtn.disabled = true;
                        plusBtn.disabled = true;
                    }
                } else {
                    stockInfo.textContent = 'Lựa chọn không có sẵn';
                    stockInfo.style.color = '#e63946';
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
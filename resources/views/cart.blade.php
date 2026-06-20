@extends('layouts.app')

@section('content')
<style>
    .cart-page {
        padding: 40px 0 80px;
    }

    .cart-header {
        margin-bottom: 32px;
    }

    .cart-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 2rem;
        font-weight: 700;
        color: #1B2A4A;
    }

    .cart-header p {
        color: #9CA3AF;
        font-size: 0.92rem;
        margin-top: 4px;
    }

    /* ---- Tabs ---- */
    .cart-tabs {
        display: flex;
        gap: 4px;
        margin-bottom: 32px;
        background: #F3F4F6;
        border-radius: 12px;
        padding: 4px;
        width: fit-content;
    }

    .cart-tab {
        padding: 10px 24px;
        border: none;
        background: transparent;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 600;
        color: #6B7280;
        border-radius: 10px;
        cursor: pointer;
        transition: all 0.3s ease;
    }

    .cart-tab.active {
        background: white;
        color: #1B2A4A;
        box-shadow: 0 2px 8px rgba(0,0,0,0.08);
    }

    .cart-tab:hover:not(.active) {
        color: #C8956C;
    }

    /* ---- Empty state ---- */
    .cart-empty {
        text-align: center;
        padding: 60px 20px;
        background: white;
        border-radius: 16px;
        border: 1px solid #F3F4F6;
    }

    .cart-empty-icon {
        font-size: 3.5rem;
        color: #D1D5DB;
        margin-bottom: 16px;
    }

    .cart-empty h3 {
        font-family: 'Playfair Display', serif;
        color: #1B2A4A;
        font-size: 1.3rem;
        margin-bottom: 8px;
    }

    .cart-empty p {
        color: #9CA3AF;
        margin-bottom: 24px;
    }

    .cart-empty-btn {
        display: inline-flex;
        align-items: center;
        gap: 8px;
        padding: 12px 28px;
        background: linear-gradient(135deg, #C8956C, #A67548);
        color: white;
        text-decoration: none;
        border-radius: 10px;
        font-weight: 600;
        transition: all 0.3s;
    }

    .cart-empty-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(200, 149, 108, 0.4);
        color: white;
    }

    /* ---- Cart table ---- */
    .cart-table-wrap {
        background: white;
        border-radius: 16px;
        border: 1px solid #F3F4F6;
        overflow: hidden;
        box-shadow: 0 1px 3px rgba(0,0,0,0.04);
    }

    .cart-table {
        width: 100%;
        border-collapse: collapse;
    }

    .cart-table thead {
        background: linear-gradient(135deg, #FAFAF8, #F3F4F6);
    }

    .cart-table thead th {
        padding: 16px 20px;
        font-size: 0.78rem;
        font-weight: 700;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        text-align: left;
    }

    .cart-table tbody td {
        padding: 16px 20px;
        border-top: 1px solid #F3F4F6;
        vertical-align: middle;
    }

    .cart-table tbody tr {
        transition: background 0.2s;
    }

    .cart-table tbody tr:hover {
        background: #FAFAF8;
    }

    /* Product cell */
    .cart-product-cell {
        display: flex;
        align-items: center;
        gap: 14px;
    }

    .cart-product-img {
        width: 64px;
        height: 64px;
        object-fit: cover;
        border-radius: 10px;
        border: 1px solid #F3F4F6;
    }

    .cart-product-name {
        font-weight: 600;
        font-size: 0.92rem;
        color: #1A1A1A;
    }

    .cart-price {
        font-weight: 600;
        color: #374151;
    }

    .cart-variant-tag {
        display: inline-block;
        padding: 3px 10px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 500;
    }

    .cart-variant-color {
        background: #FDF8F3;
        color: #A67548;
    }

    .cart-variant-size {
        background: #E8EDF5;
        color: #2D4A7A;
    }

    .cart-total-cell {
        font-weight: 700;
        color: #DC2626;
        font-size: 0.95rem;
    }

    .cart-remove-btn {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 6px 14px;
        background: #FEE2E2;
        color: #DC2626;
        border: none;
        border-radius: 8px;
        font-size: 0.82rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .cart-remove-btn:hover {
        background: #DC2626;
        color: white;
    }

    /* ---- Summary ---- */
    .cart-summary {
        background: linear-gradient(135deg, #FAFAF8, #FDF8F3);
        padding: 24px;
        border-top: 2px solid #E8C5A8;
    }

    .cart-summary-row {
        display: flex;
        justify-content: space-between;
        align-items: center;
        margin-bottom: 16px;
    }

    .cart-summary-label {
        font-size: 1.05rem;
        font-weight: 600;
        color: #374151;
    }

    .cart-summary-value {
        font-size: 1.5rem;
        font-weight: 800;
        color: #DC2626;
    }

    .cart-checkout-btn {
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 8px;
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        text-decoration: none;
        border-radius: 12px;
        font-weight: 700;
        font-size: 1rem;
        transition: all 0.3s;
        letter-spacing: 0.3px;
    }

    .cart-checkout-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 6px 20px rgba(5, 150, 105, 0.3);
        color: white;
    }

    .cart-continue-link {
        display: block;
        text-align: center;
        margin-top: 16px;
        color: #C8956C;
        font-weight: 600;
        font-size: 0.9rem;
        text-decoration: none;
        transition: color 0.2s;
    }

    .cart-continue-link:hover {
        color: #A67548;
    }

    /* ---- Orders tab ---- */
    .orders-section h2 {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        color: #1B2A4A;
        margin-bottom: 24px;
    }

    .order-card {
        background: white;
        border: 1px solid #F3F4F6;
        border-radius: 16px;
        padding: 24px;
        margin-bottom: 20px;
        transition: all 0.3s;
    }

    .order-card:hover {
        box-shadow: 0 4px 15px rgba(0,0,0,0.06);
    }

    .order-info-row {
        display: flex;
        gap: 24px;
        flex-wrap: wrap;
        margin-bottom: 12px;
    }

    .order-info-item {
        font-size: 0.88rem;
        color: #6B7280;
    }

    .order-info-item strong {
        color: #374151;
    }

    .order-toggle-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        background: #E8EDF5;
        color: #2D4A7A;
        border: none;
        border-radius: 8px;
        font-size: 0.85rem;
        font-weight: 600;
        cursor: pointer;
        transition: all 0.2s;
    }

    .order-toggle-btn:hover {
        background: #2D4A7A;
        color: white;
    }

    .order-detail-section {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #F3F4F6;
    }

    .order-detail-item {
        font-size: 0.88rem;
        color: #4B5563;
        padding: 6px 0;
    }

    .order-total {
        text-align: right;
        font-size: 1.1rem;
        font-weight: 700;
        color: #DC2626;
        margin-top: 16px;
        padding-top: 12px;
        border-top: 1px solid #F3F4F6;
    }

    .order-cancel-form {
        margin-top: 16px;
        padding-top: 16px;
        border-top: 1px solid #F3F4F6;
    }

    .order-cancel-textarea {
        width: 100%;
        padding: 12px 16px;
        border: 1.5px solid #E5E7EB;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        resize: vertical;
        outline: none;
        transition: border-color 0.2s;
    }

    .order-cancel-textarea:focus {
        border-color: #DC2626;
    }

    .order-cancel-btn {
        margin-top: 10px;
        padding: 10px 20px;
        background: linear-gradient(135deg, #DC2626, #EF4444);
        color: white;
        border: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.2s;
    }

    .order-cancel-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
    }

    /* Status badges */
    .status-pill {
        display: inline-flex;
        align-items: center;
        gap: 4px;
        padding: 4px 12px;
        border-radius: 20px;
        font-size: 0.78rem;
        font-weight: 600;
    }

    .status-completed { background: #D1FAE5; color: #059669; }
    .status-shipped { background: #DBEAFE; color: #2563EB; }
    .status-processing { background: #FEF3C7; color: #D97706; }
    .status-cancelled { background: #FEE2E2; color: #DC2626; }
    .status-pending { background: #F3F4F6; color: #6B7280; }

    .order-empty {
        color: #9CA3AF;
        font-style: italic;
    }

    @media (max-width: 768px) {
        .cart-table thead { display: none; }
        .cart-table tbody td {
            display: block;
            padding: 8px 20px;
            border: none;
        }
        .cart-table tbody td:first-child {
            padding-top: 16px;
        }
        .cart-table tbody td:last-child {
            padding-bottom: 16px;
            border-bottom: 1px solid #F3F4F6;
        }
    }
</style>

<div class="cart-page">
    <div class="cart-header">
        <h1><i class="fa-solid fa-bag-shopping" style="color: #C8956C; margin-right: 8px;"></i> Giỏ Hàng</h1>
        <p>Xin chào quý khách! Quản lý đơn hàng và giỏ hàng của bạn tại đây.</p>
    </div>

    <!-- Tabs -->
    <div class="cart-tabs">
        <button id="tab-cart-btn" class="cart-tab active">
            <i class="fa-solid fa-cart-shopping" style="margin-right: 6px;"></i> Giỏ hàng
        </button>
        <button id="tab-orders-btn" class="cart-tab">
            <i class="fa-solid fa-box" style="margin-right: 6px;"></i> Đơn hàng
        </button>
    </div>

    <!-- Tab Cart -->
    <div id="tab-cart">
        @if ($cartItems->isEmpty())
            <div class="cart-empty">
                <div class="cart-empty-icon"><i class="fa-solid fa-cart-shopping"></i></div>
                <h3>Giỏ hàng đang trống</h3>
                <p>Hãy thêm sản phẩm vào giỏ hàng để bắt đầu mua sắm nhé!</p>
                <a href="{{ route('products.index') }}" class="cart-empty-btn">
                    <i class="fa-solid fa-bag-shopping"></i> Mua sắm ngay
                </a>
            </div>
        @else
            <div class="cart-table-wrap">
                <div style="overflow-x: auto;">
                    <table class="cart-table">
                        <thead>
                            <tr>
                                <th>Sản phẩm</th>
                                <th>Giá</th>
                                <th>SL</th>
                                <th>Màu</th>
                                <th>Size</th>
                                <th>Tổng</th>
                                <th style="text-align: center;">Xóa</th>
                            </tr>
                        </thead>
                        <tbody>
                            @foreach($cartItems as $item)
                                <tr>
                                    <td>
                                        <div class="cart-product-cell">
                                            <img src="{{ Str::startsWith($item->product->image_url ?? '', 'assets/')
                                                ? asset($item->product->image_url)
                                                : asset('storage/' . ($item->product->image_url ?? '')) }}"
                                                alt="{{ $item->product->name ?? 'Sản phẩm' }}"
                                                class="cart-product-img">
                                            <span class="cart-product-name">{{ $item->product->name ?? 'Sản phẩm không có tên' }}</span>
                                        </div>
                                    </td>
                                    <td class="cart-price">{{ number_format($item->product->price ?? 0) }} VNĐ</td>
                                    <td>{{ $item->quantity }}</td>
                                    <td>
                                        @if($item->color)
                                            <span class="cart-variant-tag cart-variant-color">{{ $item->color->name }}</span>
                                        @else —
                                        @endif
                                    </td>
                                    <td>
                                        @if($item->size)
                                            <span class="cart-variant-tag cart-variant-size">{{ $item->size->name }}</span>
                                        @else —
                                        @endif
                                    </td>
                                    <td class="cart-total-cell">{{ number_format(($item->product->price ?? 0) * $item->quantity) }} VNĐ</td>
                                    <td style="text-align: center;">
                                        <form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa?')">
                                            @csrf
                                            @method('DELETE')
                                            <button type="submit" class="cart-remove-btn">
                                                <i class="fa-solid fa-trash"></i> Xóa
                                            </button>
                                        </form>
                                    </td>
                                </tr>
                            @endforeach
                        </tbody>
                    </table>
                </div>

                <div class="cart-summary">
                    <div class="cart-summary-row">
                        <span class="cart-summary-label">Tổng thanh toán:</span>
                        <span class="cart-summary-value">
                            {{ number_format($cartItems->sum(fn($item) => ($item->product->price ?? 0) * $item->quantity)) }} VNĐ
                        </span>
                    </div>
                    <a href="{{ route('checkout') }}" class="cart-checkout-btn">
                        <i class="fa-solid fa-shield-check"></i> Xác nhận đặt hàng
                    </a>
                    <a href="{{ route('home') }}" class="cart-continue-link">
                        <i class="fa-solid fa-arrow-left" style="margin-right: 4px;"></i> Tiếp tục mua sắm
                    </a>
                </div>
            </div>
        @endif
    </div>

    <!-- Tab Orders -->
    <div id="tab-orders" style="display: none;">
        <div class="orders-section">
            <h2><i class="fa-solid fa-box" style="color: #C8956C; margin-right: 8px;"></i> Đơn hàng của bạn</h2>
            @forelse ($orders as $order)
                <div class="order-card">
                    <div class="order-info-row">
                        <span class="order-info-item"><strong>Khách hàng:</strong> {{ $order->name }}</span>
                        <span class="order-info-item"><strong>SĐT:</strong> {{ $order->phone }}</span>
                        <span class="order-info-item"><strong>Địa chỉ:</strong> {{ $order->address }}</span>
                    </div>
                    <div style="margin-bottom: 12px;">
                        <strong style="font-size: 0.88rem; color: #374151;">Trạng thái:</strong>
                        <span class="status-pill {{ $order->status === 'completed' ? 'status-completed' : ($order->status === 'shipped' ? 'status-shipped' : ($order->status === 'processing' ? 'status-processing' : ($order->status === 'cancelled' ? 'status-cancelled' : 'status-pending'))) }}">
                            {{ $order->statusText }}
                        </span>
                    </div>

                    <button class="order-toggle-btn" onclick="document.getElementById('order-details-{{ $order->id }}').classList.toggle('hidden')">
                        <i class="fa-solid fa-eye"></i> Xem chi tiết
                    </button>

                    <div id="order-details-{{ $order->id }}" class="hidden order-detail-section">
                        @foreach ($order->items as $item)
                            <div class="order-detail-item">
                                <strong>{{ $item->product ? $item->product->name : 'Sản phẩm không tồn tại' }}</strong>
                                — Size: {{ $item->size ? $item->size->name : 'N/A' }}
                                — Màu: {{ $item->color ? $item->color->name : 'N/A' }}
                                — SL: {{ $item->quantity }}
                                — <span style="color: #DC2626; font-weight: 600;">{{ number_format($item->price) }} VNĐ</span>
                            </div>
                        @endforeach
                    </div>

                    <p class="order-total">
                        Tổng: {{ number_format($order->items->sum(fn($item) => $item->price * $item->quantity)) }} VNĐ
                    </p>

                    @if ($order->status === 'pending')
                        <form action="{{ route('orders.cancel', $order->id) }}" method="POST" class="order-cancel-form">
                            @csrf
                            @method('PATCH')
                            <textarea name="cancellation_reason" placeholder="Nhập lý do hủy đơn..." required class="order-cancel-textarea"></textarea>
                            <button type="submit" class="order-cancel-btn">
                                <i class="fa-solid fa-ban" style="margin-right: 4px;"></i> Hủy đơn hàng
                            </button>
                        </form>
                    @elseif($order->status !== 'cancelled')
                        <p style="margin-top: 12px; color: #9CA3AF; font-size: 0.85rem;">Đơn hàng không thể hủy.</p>
                    @endif
                </div>
            @empty
                <p class="order-empty">Bạn chưa có đơn hàng nào.</p>
            @endforelse
        </div>
    </div>
</div>

<script>
    const tabCartBtn = document.getElementById('tab-cart-btn');
    const tabOrdersBtn = document.getElementById('tab-orders-btn');
    const tabCart = document.getElementById('tab-cart');
    const tabOrders = document.getElementById('tab-orders');

    tabCartBtn.addEventListener('click', () => {
        tabCart.style.display = 'block';
        tabOrders.style.display = 'none';
        tabCartBtn.classList.add('active');
        tabOrdersBtn.classList.remove('active');
    });

    tabOrdersBtn.addEventListener('click', () => {
        tabOrders.style.display = 'block';
        tabCart.style.display = 'none';
        tabOrdersBtn.classList.add('active');
        tabCartBtn.classList.remove('active');
    });
</script>
@endsection
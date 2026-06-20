@extends('layouts.app')

@section('content')
<style>
    .checkout-page {
        padding: 40px 0 80px;
        max-width: 700px;
        margin: 0 auto;
    }

    .checkout-card {
        background: white;
        border-radius: 20px;
        border: 1px solid #F3F4F6;
        padding: 40px;
        box-shadow: 0 4px 20px rgba(0,0,0,0.04);
    }

    .checkout-header {
        margin-bottom: 32px;
    }

    .checkout-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1B2A4A;
    }

    .checkout-subtitle {
        color: #9CA3AF;
        font-size: 0.92rem;
        margin-top: 4px;
    }

    .checkout-group {
        margin-bottom: 24px;
    }

    .checkout-label {
        display: block;
        font-size: 0.88rem;
        font-weight: 600;
        color: #374151;
        margin-bottom: 8px;
    }

    .checkout-label i {
        color: #C8956C;
        margin-right: 6px;
    }

    .checkout-input,
    .checkout-textarea {
        width: 100%;
        padding: 14px 16px;
        border: 1.5px solid #E5E7EB;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-size: 0.95rem;
        color: #1A1A1A;
        background: #FAFAF8;
        transition: all 0.3s ease;
        outline: none;
    }

    .checkout-textarea {
        resize: vertical;
        min-height: 80px;
    }

    .checkout-input:focus,
    .checkout-textarea:focus {
        border-color: #C8956C;
        box-shadow: 0 0 0 3px rgba(200, 149, 108, 0.15);
        background: white;
    }

    /* Payment methods */
    .payment-section {
        margin-bottom: 28px;
    }

    .payment-options {
        display: flex;
        flex-direction: column;
        gap: 10px;
    }

    .payment-option {
        display: flex;
        align-items: center;
        gap: 12px;
        padding: 16px;
        border: 1.5px solid #E5E7EB;
        border-radius: 12px;
        cursor: pointer;
        transition: all 0.3s ease;
        background: white;
    }

    .payment-option:hover {
        border-color: #C8956C;
        background: #FDF8F3;
    }

    .payment-option input[type="radio"] {
        accent-color: #C8956C;
        width: 18px;
        height: 18px;
    }

    .payment-option input[type="radio"]:checked + .payment-option-content {
        color: #A67548;
    }

    .payment-option:has(input:checked) {
        border-color: #C8956C;
        background: #FDF8F3;
    }

    .payment-option-icon {
        width: 36px;
        height: 36px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: #F3F4F6;
        border-radius: 8px;
        color: #6B7280;
        font-size: 1rem;
    }

    .payment-option-content {
        font-weight: 500;
        color: #374151;
        font-size: 0.92rem;
    }

    /* Submit */
    .checkout-submit {
        width: 100%;
        padding: 16px;
        background: linear-gradient(135deg, #059669, #047857);
        color: white;
        border: none;
        border-radius: 12px;
        font-family: 'Inter', sans-serif;
        font-size: 1.05rem;
        font-weight: 700;
        cursor: pointer;
        transition: all 0.3s ease;
        display: flex;
        align-items: center;
        justify-content: center;
        gap: 10px;
        letter-spacing: 0.3px;
    }

    .checkout-submit:hover {
        transform: translateY(-3px);
        box-shadow: 0 8px 25px rgba(5, 150, 105, 0.3);
    }

    @media (max-width: 576px) {
        .checkout-card {
            padding: 24px 20px;
        }
    }
</style>

<div class="checkout-page">
    <div class="checkout-card">
        <div class="checkout-header">
            <h1 class="checkout-title">
                <i class="fa-solid fa-clipboard-check" style="color: #C8956C; margin-right: 8px;"></i>
                Đặt hàng
            </h1>
            <p class="checkout-subtitle">Vui lòng điền thông tin giao hàng của bạn</p>
            <div class="section-divider section-divider-left" style="margin-top: 16px;"></div>
        </div>

        <form action="{{ route('checkout') }}" method="POST">
            @csrf

            <div class="checkout-group">
                <label class="checkout-label" for="name">
                    <i class="fa-solid fa-user"></i> Tên khách hàng
                </label>
                <input type="text" name="name" id="name" required class="checkout-input" placeholder="Nhập họ tên đầy đủ">
            </div>

            <div class="checkout-group">
                <label class="checkout-label" for="phone">
                    <i class="fa-solid fa-phone"></i> Số điện thoại
                </label>
                <input type="text" name="phone" id="phone" required pattern="[0-9]{10,11}" class="checkout-input" placeholder="VD: 0901234567">
            </div>

            <div class="checkout-group">
                <label class="checkout-label" for="address">
                    <i class="fa-solid fa-location-dot"></i> Địa chỉ nhận hàng
                </label>
                <textarea name="address" id="address" rows="3" required class="checkout-textarea" placeholder="Số nhà, phường, quận, thành phố..."></textarea>
            </div>

            <div class="payment-section">
                <label class="checkout-label">
                    <i class="fa-solid fa-credit-card"></i> Phương thức thanh toán
                </label>
                <div class="payment-options">
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="cod" checked>
                        <div class="payment-option-icon"><i class="fa-solid fa-truck"></i></div>
                        <span class="payment-option-content">Thanh toán khi nhận hàng (COD)</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="bank_transfer">
                        <div class="payment-option-icon"><i class="fa-solid fa-building-columns"></i></div>
                        <span class="payment-option-content">Chuyển khoản ngân hàng</span>
                    </label>
                    <label class="payment-option">
                        <input type="radio" name="payment_method" value="momo">
                        <div class="payment-option-icon"><i class="fa-solid fa-wallet"></i></div>
                        <span class="payment-option-content">Ví MoMo</span>
                    </label>
                </div>
            </div>

            <div class="checkout-group">
                <label class="checkout-label" for="note">
                    <i class="fa-solid fa-message"></i> Ghi chú (tuỳ chọn)
                </label>
                <textarea name="note" id="note" rows="2" class="checkout-textarea" placeholder="VD: Giao trong giờ hành chính, gọi trước khi giao..."></textarea>
            </div>

            <button type="submit" class="checkout-submit">
                <i class="fa-solid fa-shield-check"></i> Xác nhận đặt hàng
            </button>
        </form>
    </div>
</div>
@endsection

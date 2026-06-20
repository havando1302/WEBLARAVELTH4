@extends('layouts.app')

@section('content')
<style>
    .contact-page {
        padding: 50px 0 80px;
    }

    .contact-page-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .contact-page-label {
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

    .contact-page-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.2rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 8px;
    }

    .contact-page-subtitle {
        color: #9CA3AF;
        font-size: 0.95rem;
    }

    .contact-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 32px;
        max-width: 1000px;
        margin: 0 auto;
    }

    .contact-card {
        background: white;
        border-radius: 20px;
        padding: 40px 32px;
        border: 1px solid #F3F4F6;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
        transition: all 0.3s ease;
    }

    .contact-card:hover {
        box-shadow: 0 8px 30px rgba(0,0,0,0.06);
        transform: translateY(-4px);
    }

    .contact-card-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 8px;
    }

    .contact-card-divider {
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #C8956C, #D4A76A);
        border-radius: 2px;
        margin-bottom: 24px;
    }

    .contact-item {
        display: flex;
        align-items: flex-start;
        gap: 14px;
        margin-bottom: 20px;
    }

    .contact-item-icon {
        width: 42px;
        height: 42px;
        display: flex;
        align-items: center;
        justify-content: center;
        background: linear-gradient(135deg, #FDF8F3, #F5E6D0);
        border-radius: 10px;
        color: #C8956C;
        font-size: 1rem;
        flex-shrink: 0;
    }

    .contact-item-content {
        flex: 1;
    }

    .contact-item-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #9CA3AF;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 4px;
    }

    .contact-item-value {
        font-size: 0.95rem;
        color: #374151;
        font-weight: 500;
    }

    /* Map */
    .contact-map-card {
        background: white;
        border-radius: 20px;
        overflow: hidden;
        border: 1px solid #F3F4F6;
        box-shadow: 0 4px 15px rgba(0,0,0,0.03);
    }

    .contact-map-header {
        padding: 24px 32px 16px;
    }

    .contact-map-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.3rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 4px;
    }

    .contact-map-divider {
        width: 50px;
        height: 3px;
        background: linear-gradient(90deg, #C8956C, #D4A76A);
        border-radius: 2px;
    }

    .contact-map-frame {
        width: 100%;
        height: 300px;
    }

    .contact-map-frame iframe {
        width: 100%;
        height: 100%;
        border: 0;
    }

    @media (max-width: 768px) {
        .contact-grid {
            grid-template-columns: 1fr;
        }

        .contact-page-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="contact-page">
    <div class="contact-page-header">
        <span class="contact-page-label">
            <i class="fa-solid fa-headset"></i> Liên hệ
        </span>
        <h1 class="contact-page-title">Chúng Tôi Luôn Sẵn Sàng Hỗ Trợ Bạn</h1>
        <div class="section-divider"></div>
        <p class="contact-page-subtitle">Mọi thắc mắc, góp ý xin vui lòng liên hệ qua các kênh dưới đây</p>
    </div>

    <div class="contact-grid">
        <!-- Contact Info -->
        <div class="contact-card">
            <h2 class="contact-card-title">Thông Tin Liên Hệ</h2>
            <div class="contact-card-divider"></div>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-solid fa-phone"></i></div>
                <div class="contact-item-content">
                    <p class="contact-item-label">Hotline</p>
                    <p class="contact-item-value">0337 950 933</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-solid fa-envelope"></i></div>
                <div class="contact-item-content">
                    <p class="contact-item-label">Email</p>
                    <p class="contact-item-value">Dohafashion@gmail.com</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-brands fa-facebook-f"></i></div>
                <div class="contact-item-content">
                    <p class="contact-item-label">Facebook</p>
                    <p class="contact-item-value">DOHAFASHION</p>
                </div>
            </div>

            <div class="contact-item">
                <div class="contact-item-icon"><i class="fa-solid fa-location-dot"></i></div>
                <div class="contact-item-content">
                    <p class="contact-item-label">Địa chỉ</p>
                    <p class="contact-item-value">15A, Quốc lộ 1, Nghệ An</p>
                </div>
            </div>
        </div>

        <!-- Map -->
        <div class="contact-map-card">
            <div class="contact-map-header">
                <h2 class="contact-map-title">Vị Trí Cửa Hàng</h2>
                <div class="contact-map-divider"></div>
            </div>
            <div class="contact-map-frame">
                <iframe
                    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d26955.408061199683!2d105.39104775664859!3d18.825260689394778!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x3139e0c445dbb1f1%3A0x4a5dcdccf1a525af!2zTmjDom4gU8ahbiwgxJDDtCBMxrDGoW5nLCBOZ2jhu4cgQW4sIFZp4buHdCBOYW0!5e0!3m2!1svi!2s!4v1750174301836!5m2!1svi!2s"
                    allowfullscreen=""
                    loading="lazy"
                    referrerpolicy="no-referrer-when-downgrade">
                </iframe>
            </div>
        </div>
    </div>
</div>
@endsection

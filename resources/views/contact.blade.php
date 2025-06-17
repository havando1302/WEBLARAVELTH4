@extends('layouts.app')

@section('content')
    <style>
        .contact-section {
            margin-top: 150px;
            font-family: 'Roboto', sans-serif;
        }

        .contact-wrapper {
            display: flex;
            flex-wrap: wrap;
            justify-content: center;
            gap: 40px;
            padding-bottom: 80px;
            border-bottom: 3px solid #e6e6e6;
        }

        .contact-card {
            background-color: #fff;
            padding: 30px 25px;
            border-radius: 12px;
            box-shadow: 0 4px 12px rgba(0, 0, 0, 0.06);
            max-width: 700px;
            width: 100%;
        }

        .contact-title {
            font-size: 24px;
            font-weight: 700;
            color: #e08a58;
            text-align: center;
            margin-bottom: 25px;
        }

        .contact-subtitle {
            font-size: 16px;
            font-weight: 500;
            color: #444;
            text-align: center;
            margin-bottom: 20px;
        }

        .contact-info {
            display: flex;
            flex-direction: column;
            gap: 15px;
        }

        .contact-item {
            display: flex;
            align-items: flex-start;
            gap: 10px;
        }

        .contact-label {
            font-weight: 600;
            color: #333;
            min-width: 100px;
        }

        .contact-value {
            color: #555;
        }

        .map-container {
            width: 100%;
            height: 250px;
        }

        iframe {
            width: 100%;
            height: 100%;
            border: 0;
        }

        @media screen and (max-width: 768px) {
            .contact-card {
                max-width: 100%;
            }
        }
    </style>

    <div class="grid">
        <div class="contact-section">
            <div class="contact-wrapper">

                <!-- Thông tin liên hệ -->
                <div class="contact-card">
                    <h2 class="contact-title">LIÊN HỆ HỖ TRỢ</h2>
                    <p class="contact-subtitle">Mọi thông tin liên lạc, quý khách vui lòng liên hệ qua:</p>

                    <div class="contact-info">
                        <div class="contact-item">
                            <p class="contact-label">📞 Hotline:</p>
                            <p class="contact-value">0337 950 933</p>
                        </div>
                        <div class="contact-item">
                            <p class="contact-label">📧 Email:</p>
                            <p class="contact-value">Dohafashion@gmail.com</p>
                        </div>
                        <div class="contact-item">
                            <p class="contact-label">📘 Facebook:</p>
                            <p class="contact-value">DOHAFASHION</p>
                        </div>
                        <div class="contact-item">
                            <p class="contact-label">📍 Địa chỉ:</p>
                            <p class="contact-value">15A, Quốc lộ 1, Nghệ An</p>
                        </div>
                    </div>
                </div>

                <!-- Google Map -->
                <div class="contact-card">
                    <h2 class="contact-title">VỊ TRÍ CỬA HÀNG</h2>
                    <div class="map-container">
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
    </div>
@endsection

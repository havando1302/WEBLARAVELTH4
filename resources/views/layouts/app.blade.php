<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <title>{{ config('app.name', 'DOHAFASHION') }}</title>

  <!-- Fonts -->
  @yield('styles')
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet" />
  <!-- Bootstrap CSS -->
<link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">


  <!-- Scripts -->
  @vite(['resources/css/app.css', 'resources/js/app.js'])

  <style>
    html, body {
      height: 100%;
      margin: 0;
      padding: 0;
      display: flex;
      flex-direction: column;
    }

    .page-wrapper {
      flex: 1;
      display: flex;
      flex-direction: column;
    }

    main {
      flex: 1;
    }

    .grid {
      width: 100%;
      max-width: 1280px;
      margin: 0 auto;
      padding: 0 20px;
    }

    .footer {
      background-color: #e2a57c;
      color: #fff;
      padding: 40px 20px;
    }

    .footer_info {
      display: flex;
      flex-wrap: wrap;
      justify-content: space-between;
      gap: 30px;
    }

    .footer_info-content {
      flex: 1;
      min-width: 220px;
    }

    .footer_info-logo {
      max-width: 140px;
      margin-bottom: 15px;
    }

    .footer_info-logo2 {
      max-width: 50px;
      margin-bottom: 10px;
    }
    .footer_info-heading {
      font-weight: 700;
      margin-bottom: 10px;
    }

    .footer_info-line {
      width: 20px;
      height: 1px;
      background-color: #fff;
      margin-top: 5px;
      margin-bottom: 10px;
      display: flex;
    }

    .footer_info-text {
      font-size: 14px;
      margin-bottom: 6px;
    }

    .footer_info-policy {
      color: #fff;
      text-decoration: none;
    }
    .footer_payment-app
    {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
    }
  </style>

</head>

<body class="font-sans antialiased">

    @include('layouts.navigation')

    <main class="grid main-content">

      @yield('content')
    </main>

    <!-- Footer -->
    <footer class="footer">
      <div class="grid max-w-7xl mx-auto px-5">
        <div class="footer_info flex flex-wrap justify-between gap-8">
          <div class="footer_info-content">
             <img src="{{ asset('assets/img/LoGo.png') }}"
              alt="Logo" class="footer_info-logo">
          </div>

          <div class="footer_info-content">
            <h4 class="footer_info-heading">THÔNG TIN LIÊN HỆ</h4>
            <div class="footer_info-line"></div>
            <p class="footer_info-text">Số hotline được trực trong khung giờ từ 9h-17h mỗi T2 – T7 hàng tuần</p>
            <p class="footer_info-text">Đường dây nóng: +84 337 950 933</p>
            <p class="footer_info-text">15A, Quốc lộ 1, Nghệ An</p>
          </div>

          <div class="footer_info-content">
            <h4 class="footer_info-heading">CHÍNH SÁCH</h4>
            <div class="footer_info-line"></div>
            <a href="#" class="footer_info-policy block mb-1.5 hover:underline">Chính sách bảo hành</a>
            <a href="#" class="footer_info-policy block mb-1.5 hover:underline">Chính sách đổi trả</a>
            <a href="#" class="footer_info-policy block mb-1.5 hover:underline">Chính sách vận chuyển</a>
            <a href="#" class="footer_info-policy block mb-1.5 hover:underline">Chính sách bảo mật</a>
            <a href="#" class="footer_info-policy block mb-1.5 hover:underline">Câu hỏi thường gặp</a>
          </div>

          <div class="footer_info-content">
            <h4 class="footer_info-heading">KẾT NỐI VỚI CHÚNG TÔI</h4>
            <div class="footer_info-line"></div>
            <div style="display: flex; gap: 10px; align-items: center;">
             <a href="https://www.facebook.com/profile.php?id=61576996803922" target="_blank">
             <img src="{{ asset('assets/img/F_Logo.png') }}" alt="Facebook" class="footer_info-logo2">
              </a>
            <a href="https://zalo.me/0337950933" target="_blank">
            <img src="{{ asset('assets/img/Z_Logo.webp') }}" alt="Zalo" class="footer_info-logo2">
            </a>
          </div>

          </div>
        </div>

        <div class="footer_payment mt-8 border-t border-white/30 pt-5 text-center">
          <div class="footer_payment-wrapper inline-flex gap-5">
            <div class="footer_payment-app">
              <i class="fa-brands fa-cc-visa text-2xl text-white"></i>
            </div>
            <div class="footer_payment-app">
              <i class="fa-brands fa-cc-paypal text-2xl text-white"></i>
            </div>
            <div class="footer_payment-app">
              <i class="fa-brands fa-stripe text-2xl text-white"></i>
            </div>
            <div class="footer_payment-app">
              <i class="fa-brands fa-cc-mastercard text-2xl text-white"></i>
            </div>
          </div>
        </div>
      </div>
    </footer>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>

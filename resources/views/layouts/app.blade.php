<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <meta name="description" content="DOHAFASHION - Thời trang hiện đại, thanh lịch và cá tính. Mua sắm online quần áo, phụ kiện thời trang chất lượng cao.">
  <title>{{ config('app.name', 'DOHAFASHION') }}</title>

  <!-- Fonts -->
  @yield('styles')
  <link rel="preconnect" href="https://fonts.googleapis.com" />
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin />
  <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700;800&family=Playfair+Display:wght@400;500;600;700;800&display=swap" rel="stylesheet" />
  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
  <!-- Font Awesome -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

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
      padding: 0 24px;
    }

    /* ============ FOOTER ============ */
    .footer {
      background: linear-gradient(135deg, #1B2A4A 0%, #2D4A7A 50%, #1B2A4A 100%);
      color: #fff;
      padding: 0;
      position: relative;
      overflow: hidden;
    }

    .footer::before {
      content: '';
      position: absolute;
      top: -60%;
      right: -20%;
      width: 500px;
      height: 500px;
      background: radial-gradient(circle, rgba(200, 149, 108, 0.12), transparent 70%);
      pointer-events: none;
    }

    .footer::after {
      content: '';
      position: absolute;
      bottom: -40%;
      left: -10%;
      width: 400px;
      height: 400px;
      background: radial-gradient(circle, rgba(212, 167, 106, 0.08), transparent 70%);
      pointer-events: none;
    }

    .footer-top {
      padding: 60px 0 40px;
      position: relative;
      z-index: 1;
    }

    .footer_info {
      display: grid;
      grid-template-columns: 1.5fr 1fr 1fr 1fr;
      gap: 40px;
    }

    @media (max-width: 992px) {
      .footer_info {
        grid-template-columns: 1fr 1fr;
      }
    }

    @media (max-width: 576px) {
      .footer_info {
        grid-template-columns: 1fr;
      }
    }

    .footer_info-content {
      min-width: 0;
    }

    .footer_info-logo {
      max-width: 140px;
      margin-bottom: 16px;
      filter: brightness(1.1);
      transition: transform 0.3s ease;
    }

    .footer_info-logo:hover {
      transform: scale(1.05);
    }

    .footer_brand-desc {
      font-size: 0.88rem;
      line-height: 1.7;
      color: rgba(255, 255, 255, 0.7);
      margin-top: 8px;
    }

    .footer_info-heading {
      font-family: 'Inter', sans-serif;
      font-weight: 700;
      font-size: 0.85rem;
      letter-spacing: 1.5px;
      text-transform: uppercase;
      margin-bottom: 20px;
      color: #D4A76A;
    }

    .footer_info-text {
      font-size: 0.88rem;
      margin-bottom: 10px;
      color: rgba(255, 255, 255, 0.75);
      display: flex;
      align-items: center;
      gap: 8px;
    }

    .footer_info-text i {
      color: #C8956C;
      width: 16px;
      text-align: center;
    }

    .footer_info-policy {
      color: rgba(255, 255, 255, 0.75);
      text-decoration: none;
      font-size: 0.88rem;
      display: block;
      padding: 6px 0;
      transition: all 0.2s ease;
    }

    .footer_info-policy:hover {
      color: #D4A76A;
      padding-left: 6px;
    }

    .footer-social-links {
      display: flex;
      gap: 12px;
      margin-top: 4px;
    }

    .footer-social-link {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 40px;
      height: 40px;
      border-radius: 10px;
      background: rgba(255, 255, 255, 0.1);
      color: white;
      font-size: 1.1rem;
      text-decoration: none;
      transition: all 0.3s ease;
      border: 1px solid rgba(255, 255, 255, 0.1);
    }

    .footer-social-link:hover {
      background: #C8956C;
      color: white;
      transform: translateY(-3px);
      box-shadow: 0 6px 20px rgba(200, 149, 108, 0.3);
    }

    .footer-bottom {
      border-top: 1px solid rgba(255, 255, 255, 0.1);
      padding: 20px 0;
      position: relative;
      z-index: 1;
    }

    .footer-bottom-inner {
      display: flex;
      align-items: center;
      justify-content: space-between;
      flex-wrap: wrap;
      gap: 16px;
    }

    .footer-copyright {
      font-size: 0.82rem;
      color: rgba(255, 255, 255, 0.5);
    }

    .footer-payment-icons {
      display: flex;
      gap: 12px;
      align-items: center;
    }

    .footer-payment-icon {
      display: flex;
      align-items: center;
      justify-content: center;
      width: 44px;
      height: 30px;
      background: rgba(255, 255, 255, 0.1);
      border-radius: 6px;
      color: rgba(255, 255, 255, 0.7);
      font-size: 1.2rem;
      transition: all 0.2s ease;
    }

    .footer-payment-icon:hover {
      background: rgba(255, 255, 255, 0.2);
      color: white;
    }

    /* ============ BACK TO TOP ============ */
    .back-to-top {
      position: fixed;
      bottom: 30px;
      right: 30px;
      width: 46px;
      height: 46px;
      border-radius: 50%;
      background: linear-gradient(135deg, #C8956C, #A67548);
      color: white;
      border: none;
      cursor: pointer;
      display: flex;
      align-items: center;
      justify-content: center;
      font-size: 1.1rem;
      box-shadow: 0 4px 15px rgba(200, 149, 108, 0.4);
      opacity: 0;
      visibility: hidden;
      transform: translateY(20px);
      transition: all 0.3s ease;
      z-index: 999;
    }

    .back-to-top.visible {
      opacity: 1;
      visibility: visible;
      transform: translateY(0);
    }

    .back-to-top:hover {
      transform: translateY(-3px);
      box-shadow: 0 6px 25px rgba(200, 149, 108, 0.5);
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
      <div class="footer-top">
        <div class="grid">
          <div class="footer_info">
            <!-- Brand -->
            <div class="footer_info-content">
              <img src="{{ asset('assets/img/LoGo.png') }}" alt="DOHAFASHION Logo" class="footer_info-logo">
              <p class="footer_brand-desc">
                Thương hiệu thời trang trẻ trung, hiện đại. Mang đến cho bạn phong cách sống đẳng cấp qua từng sản phẩm.
              </p>
            </div>

            <!-- Contact Info -->
            <div class="footer_info-content">
              <h4 class="footer_info-heading">Liên hệ</h4>
              <p class="footer_info-text"><i class="fa-solid fa-phone"></i> +84 337 950 933</p>
              <p class="footer_info-text"><i class="fa-solid fa-envelope"></i> Dohafashion@gmail.com</p>
              <p class="footer_info-text"><i class="fa-solid fa-location-dot"></i> 15A, Quốc lộ 1, Nghệ An</p>
              <p class="footer_info-text"><i class="fa-regular fa-clock"></i> 9h - 17h (T2 – T7)</p>
            </div>

            <!-- Policies -->
            <div class="footer_info-content">
              <h4 class="footer_info-heading">Chính sách</h4>
              <a href="#" class="footer_info-policy">Chính sách bảo hành</a>
              <a href="#" class="footer_info-policy">Chính sách đổi trả</a>
              <a href="#" class="footer_info-policy">Chính sách vận chuyển</a>
              <a href="#" class="footer_info-policy">Chính sách bảo mật</a>
              <a href="#" class="footer_info-policy">Câu hỏi thường gặp</a>
            </div>

            <!-- Social -->
            <div class="footer_info-content">
              <h4 class="footer_info-heading">Kết nối</h4>
              <div class="footer-social-links">
                <a href="https://www.facebook.com/profile.php?id=61576996803922" target="_blank" class="footer-social-link" title="Facebook">
                  <i class="fa-brands fa-facebook-f"></i>
                </a>
                <a href="https://zalo.me/0337950933" target="_blank" class="footer-social-link" title="Zalo">
                  <i class="fa-solid fa-comment-dots"></i>
                </a>
                <a href="#" class="footer-social-link" title="Instagram">
                  <i class="fa-brands fa-instagram"></i>
                </a>
                <a href="#" class="footer-social-link" title="TikTok">
                  <i class="fa-brands fa-tiktok"></i>
                </a>
              </div>
            </div>
          </div>
        </div>
      </div>

      <div class="footer-bottom">
        <div class="grid">
          <div class="footer-bottom-inner">
            <p class="footer-copyright">© {{ date('Y') }} DOHAFASHION. All rights reserved.</p>
            <div class="footer-payment-icons">
              <div class="footer-payment-icon"><i class="fa-brands fa-cc-visa"></i></div>
              <div class="footer-payment-icon"><i class="fa-brands fa-cc-mastercard"></i></div>
              <div class="footer-payment-icon"><i class="fa-brands fa-cc-paypal"></i></div>
              <div class="footer-payment-icon"><i class="fa-brands fa-stripe-s"></i></div>
            </div>
          </div>
        </div>
      </div>
    </footer>

    <!-- Back to top button -->
    <button class="back-to-top" id="backToTop" title="Về đầu trang">
      <i class="fa-solid fa-chevron-up"></i>
    </button>

<!-- Bootstrap Bundle with Popper -->
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>

<script>
  // Back to top
  const backToTop = document.getElementById('backToTop');
  window.addEventListener('scroll', () => {
    if (window.scrollY > 400) {
      backToTop.classList.add('visible');
    } else {
      backToTop.classList.remove('visible');
    }
  });
  backToTop.addEventListener('click', () => {
    window.scrollTo({ top: 0, behavior: 'smooth' });
  });
</script>
</body>
</html>

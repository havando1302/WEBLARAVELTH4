@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
<style>
  /* ============ HERO CAROUSEL ============ */
  .hero-section {
    position: relative;
    margin: -0px -24px 0;
    overflow: hidden;
  }

  .hero-section .carousel-inner {
    border-radius: 0;
  }

  .hero-section .carousel-item {
    position: relative;
  }

  .hero-section .carousel-item img {
    width: 100%;
    height: 500px;
    object-fit: cover;
    filter: brightness(0.7);
  }

  .hero-overlay {
    position: absolute;
    inset: 0;
    background: linear-gradient(to right, rgba(27, 42, 74, 0.75), rgba(27, 42, 74, 0.2));
    display: flex;
    align-items: center;
    padding: 0 60px;
  }

  .hero-content {
    max-width: 550px;
    color: white;
    animation: fadeInUp 0.8s ease both;
  }

  .hero-badge {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    background: rgba(200, 149, 108, 0.3);
    backdrop-filter: blur(8px);
    padding: 6px 16px;
    border-radius: 30px;
    font-size: 0.82rem;
    font-weight: 600;
    color: #D4A76A;
    margin-bottom: 16px;
    letter-spacing: 0.5px;
  }

  .hero-title {
    font-family: 'Playfair Display', serif;
    font-size: 3rem;
    font-weight: 700;
    line-height: 1.2;
    margin-bottom: 16px;
    color: white;
  }

  .hero-subtitle {
    font-size: 1.05rem;
    color: rgba(255, 255, 255, 0.85);
    margin-bottom: 28px;
    line-height: 1.7;
  }

  .hero-btns {
    display: flex;
    gap: 12px;
    flex-wrap: wrap;
  }

  .hero-btn-primary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    background: linear-gradient(135deg, #C8956C, #A67548);
    color: white;
    text-decoration: none;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
  }

  .hero-btn-primary:hover {
    transform: translateY(-3px);
    box-shadow: 0 8px 25px rgba(200, 149, 108, 0.4);
    color: white;
  }

  .hero-btn-secondary {
    display: inline-flex;
    align-items: center;
    gap: 8px;
    padding: 14px 32px;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    border: 1.5px solid rgba(255, 255, 255, 0.3);
    color: white;
    text-decoration: none;
    font-weight: 600;
    border-radius: 10px;
    transition: all 0.3s ease;
    font-size: 0.95rem;
  }

  .hero-btn-secondary:hover {
    background: rgba(255, 255, 255, 0.25);
    color: white;
    transform: translateY(-3px);
  }

  /* Carousel controls */
  .hero-section .carousel-control-prev,
  .hero-section .carousel-control-next {
    width: 50px;
    height: 50px;
    top: 50%;
    transform: translateY(-50%);
    bottom: auto;
    background: rgba(255, 255, 255, 0.15);
    backdrop-filter: blur(8px);
    border-radius: 12px;
    margin: 0 20px;
    transition: all 0.3s ease;
    opacity: 0.7;
  }

  .hero-section .carousel-control-prev:hover,
  .hero-section .carousel-control-next:hover {
    background: rgba(200, 149, 108, 0.5);
    opacity: 1;
  }

  /* Carousel indicators */
  .hero-indicators {
    position: absolute;
    bottom: 24px;
    left: 50%;
    transform: translateX(-50%);
    display: flex;
    gap: 8px;
    z-index: 5;
  }

  .hero-indicator {
    width: 30px;
    height: 4px;
    border-radius: 2px;
    background: rgba(255, 255, 255, 0.4);
    border: none;
    cursor: pointer;
    transition: all 0.3s ease;
  }

  .hero-indicator.active {
    width: 50px;
    background: #C8956C;
  }

  /* ============ INTRO SECTION ============ */
  .intro-section {
    padding: 80px 0 60px;
  }

  .intro-wrapper {
    display: flex;
    align-items: center;
    gap: 60px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .intro-logo-wrap {
    flex-shrink: 0;
    position: relative;
  }

  .intro-logo-wrap::before {
    content: '';
    position: absolute;
    inset: -20px;
    background: linear-gradient(135deg, rgba(200, 149, 108, 0.1), rgba(212, 167, 106, 0.05));
    border-radius: 50%;
    z-index: -1;
  }

  .intro-logo-img {
    max-width: 200px;
    height: auto;
    animation: float 3s ease-in-out infinite;
  }

  @keyframes float {
    0%, 100% { transform: translateY(0); }
    50% { transform: translateY(-10px); }
  }

  .intro-text-wrap {
    flex: 1;
  }

  .intro-text-label {
    display: inline-flex;
    align-items: center;
    gap: 6px;
    font-size: 0.82rem;
    font-weight: 600;
    color: #C8956C;
    text-transform: uppercase;
    letter-spacing: 1.5px;
    margin-bottom: 12px;
  }

  .intro-text-heading {
    font-family: 'Playfair Display', serif;
    font-size: 2rem;
    font-weight: 700;
    color: #1B2A4A;
    margin-bottom: 20px;
    line-height: 1.3;
  }

  .intro-paragraph {
    font-size: 0.95rem;
    color: #6B7280;
    line-height: 1.8;
    margin-bottom: 14px;
  }

  /* ============ BENEFITS SECTION ============ */
  .benefits-section {
    padding: 60px 0 80px;
    background: linear-gradient(180deg, var(--surface) 0%, var(--surface-warm) 100%);
  }

  .benefits-header {
    text-align: center;
    margin-bottom: 50px;
  }

  .benefits-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #1B2A4A;
    margin-bottom: 8px;
  }

  .benefits-subtitle {
    color: #9CA3AF;
    font-size: 0.95rem;
  }

  .benefits-grid {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 24px;
    max-width: 1100px;
    margin: 0 auto;
  }

  .benefit-card {
    background: white;
    border-radius: 16px;
    padding: 36px 24px;
    text-align: center;
    transition: all 0.4s cubic-bezier(0.34, 1.56, 0.64, 1);
    border: 1px solid #F3F4F6;
    position: relative;
    overflow: hidden;
  }

  .benefit-card::before {
    content: '';
    position: absolute;
    top: 0;
    left: 0;
    right: 0;
    height: 4px;
    background: linear-gradient(90deg, #C8956C, #D4A76A);
    transform: scaleX(0);
    transition: transform 0.4s ease;
  }

  .benefit-card:hover {
    transform: translateY(-10px);
    box-shadow: 0 20px 50px rgba(0, 0, 0, 0.08);
  }

  .benefit-card:hover::before {
    transform: scaleX(1);
  }

  .benefit-icon-wrap {
    width: 80px;
    height: 80px;
    margin: 0 auto 20px;
    border-radius: 50%;
    overflow: hidden;
    border: 3px solid #F3F4F6;
    transition: border-color 0.3s ease;
  }

  .benefit-card:hover .benefit-icon-wrap {
    border-color: #C8956C;
  }

  .benefit-icon-wrap img {
    width: 100%;
    height: 100%;
    object-fit: cover;
  }

  .benefit-title {
    font-family: 'Inter', sans-serif;
    font-size: 0.92rem;
    font-weight: 700;
    color: #1B2A4A;
    margin-bottom: 8px;
    letter-spacing: 0.3px;
  }

  .benefit-desc {
    font-size: 0.82rem;
    color: #9CA3AF;
    line-height: 1.6;
  }

  /* ============ RESPONSIVE ============ */
  @media (max-width: 992px) {
    .hero-section .carousel-item img {
      height: 400px;
    }

    .hero-title {
      font-size: 2.2rem;
    }

    .intro-wrapper {
      flex-direction: column;
      text-align: center;
      gap: 40px;
    }

    .benefits-grid {
      grid-template-columns: repeat(2, 1fr);
    }
  }

  @media (max-width: 576px) {
    .hero-section .carousel-item img {
      height: 300px;
    }

    .hero-overlay {
      padding: 0 24px;
    }

    .hero-title {
      font-size: 1.8rem;
    }

    .hero-subtitle {
      font-size: 0.9rem;
    }

    .benefits-grid {
      grid-template-columns: 1fr;
      max-width: 360px;
    }

    .intro-text-heading {
      font-size: 1.6rem;
    }
  }
</style>

<!-- ============ HERO CAROUSEL ============ -->
<div class="hero-section">
  <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel" data-bs-interval="5000">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/img/DALL.webp') }}" alt="Banner 1">
        <div class="hero-overlay">
          <div class="hero-content">
            <span class="hero-badge"><i class="fa-solid fa-sparkles"></i> New Collection 2025</span>
            <h1 class="hero-title">Phong Cách Của Bạn, Dấu Ấn Của Riêng Bạn</h1>
            <p class="hero-subtitle">Khám phá bộ sưu tập mới nhất với thiết kế độc đáo, chất liệu cao cấp và giá cả hợp lý.</p>
            <div class="hero-btns">
              <a href="{{ route('products.index') }}" class="hero-btn-primary">
                <i class="fa-solid fa-bag-shopping"></i> Mua sắm ngay
              </a>
              <a href="{{ url('/introduce') }}" class="hero-btn-secondary">
                <i class="fa-solid fa-play"></i> Về chúng tôi
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/img/DALL2.jpg') }}" alt="Banner 2">
        <div class="hero-overlay">
          <div class="hero-content">
            <span class="hero-badge"><i class="fa-solid fa-fire"></i> Hot Trend</span>
            <h1 class="hero-title">Thời Trang Cho Mọi Khoảnh Khắc</h1>
            <p class="hero-subtitle">Cập nhật xu hướng thời trang mới nhất – Đẹp mỗi ngày, tự tin mỗi bước.</p>
            <div class="hero-btns">
              <a href="{{ route('products.index') }}" class="hero-btn-primary">
                <i class="fa-solid fa-bag-shopping"></i> Khám phá ngay
              </a>
            </div>
          </div>
        </div>
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/img/DALL1.jpg') }}" alt="Banner 3">
        <div class="hero-overlay">
          <div class="hero-content">
            <span class="hero-badge"><i class="fa-solid fa-percent"></i> Sale Season</span>
            <h1 class="hero-title">Ưu Đãi Lớn Cuối Mùa</h1>
            <p class="hero-subtitle">Giảm giá lên đến 50% cho hàng nghìn sản phẩm thời trang nam & nữ.</p>
            <div class="hero-btns">
              <a href="{{ route('products.index') }}" class="hero-btn-primary">
                <i class="fa-solid fa-tag"></i> Xem khuyến mãi
              </a>
            </div>
          </div>
        </div>
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
    </button>
  </div>
</div>

<!-- ============ INTRO SECTION ============ -->
<div class="intro-section">
  <div class="intro-wrapper">
    <div class="intro-logo-wrap">
      <img src="{{ asset('assets/img/LoGo.png') }}" alt="DOHAFASHION Logo" class="intro-logo-img">
    </div>
    <div class="intro-text-wrap">
      <span class="intro-text-label">
        <i class="fa-solid fa-star"></i> Về DOHAFASHION
      </span>
      <h2 class="intro-text-heading">Phong Cách – Chất Lượng – Tận Tâm</h2>
      <p class="intro-paragraph">
        DOHAFASHION là điểm đến lý tưởng dành cho những tín đồ yêu thích thời trang hiện đại, thanh lịch và cá tính. Với sứ mệnh mang đến cho người tiêu dùng Việt Nam những sản phẩm thời trang chất lượng cao, hợp xu hướng và đầy phong cách.
      </p>
      <p class="intro-paragraph">
        Khách hàng là trung tâm của mọi hoạt động tại DOHAFASHION. Mỗi sản phẩm không chỉ là một món đồ thời trang, mà còn là tuyên ngôn cá nhân, là sự thể hiện cá tính và gu thẩm mỹ riêng.
      </p>
    </div>
  </div>
</div>

<!-- ============ BENEFITS SECTION ============ -->
<div class="benefits-section">
  <div class="container-custom">
    <div class="benefits-header">
      <h2 class="benefits-title">Tại Sao Chọn DOHAFASHION?</h2>
      <div class="section-divider"></div>
      <p class="benefits-subtitle">Cam kết mang đến trải nghiệm mua sắm tuyệt vời nhất cho bạn</p>
    </div>

    <div class="benefits-grid">
      <div class="benefit-card">
        <div class="benefit-icon-wrap">
          <img src="{{ asset('assets/img/HT.jpg') }}" alt="Giao hàng hỏa tốc">
        </div>
        <h3 class="benefit-title">GIAO HÀNG HỎA TỐC</h3>
        <p class="benefit-desc">Giao hàng nhanh chóng, đúng hẹn trên toàn quốc</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon-wrap">
          <img src="{{ asset('assets/img/CK.png') }}" alt="Chăm sóc khách hàng">
        </div>
        <h3 class="benefit-title">HỖ TRỢ 24/7</h3>
        <p class="benefit-desc">Đội ngũ chăm sóc khách hàng luôn sẵn sàng hỗ trợ</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon-wrap">
          <img src="{{ asset('assets/img/DT.jpg') }}" alt="Đổi trả dễ dàng">
        </div>
        <h3 class="benefit-title">ĐỔI TRẢ DỄ DÀNG</h3>
        <p class="benefit-desc">1 đổi 1 trong vòng 3 ngày nếu hàng lỗi</p>
      </div>

      <div class="benefit-card">
        <div class="benefit-icon-wrap">
          <img src="{{ asset('assets/img/TT.jpg') }}" alt="Thanh toán an toàn">
        </div>
        <h3 class="benefit-title">THANH TOÁN AN TOÀN</h3>
        <p class="benefit-desc">Bảo mật thông tin & đa dạng phương thức thanh toán</p>
      </div>
    </div>
  </div>
</div>
@endsection
@extends('layouts.app')

@section('content')
<style>
    .intro-page {
        padding: 50px 0 80px;
    }

    /* ---- Hero ---- */
    .intro-hero {
        text-align: center;
        margin-bottom: 60px;
    }

    .intro-hero-label {
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

    .intro-hero-title {
        font-family: 'Playfair Display', serif;
        font-size: 2.4rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 8px;
    }

    .intro-hero-subtitle {
        color: #9CA3AF;
        font-size: 0.95rem;
        max-width: 600px;
        margin: 0 auto;
    }

    /* ---- About Section ---- */
    .intro-about {
        display: flex;
        align-items: center;
        gap: 60px;
        margin-bottom: 80px;
    }

    .intro-about-logo {
        flex-shrink: 0;
        position: relative;
    }

    .intro-about-logo::before {
        content: '';
        position: absolute;
        inset: -24px;
        background: linear-gradient(135deg, rgba(200, 149, 108, 0.1), rgba(212, 167, 106, 0.05));
        border-radius: 50%;
        z-index: -1;
    }

    .intro-about-logo img {
        max-width: 200px;
        height: auto;
        animation: float 3s ease-in-out infinite;
    }

    @keyframes float {
        0%, 100% { transform: translateY(0); }
        50% { transform: translateY(-10px); }
    }

    .intro-about-text {
        flex: 1;
    }

    .intro-about-text h3 {
        font-family: 'Playfair Display', serif;
        font-size: 1.6rem;
        color: #1B2A4A;
        margin-bottom: 16px;
    }

    .intro-about-text h3::after {
        content: '';
        display: block;
        width: 60px;
        height: 3px;
        background: linear-gradient(90deg, #C8956C, #D4A76A);
        border-radius: 2px;
        margin-top: 10px;
    }

    .intro-about-paragraph {
        font-size: 0.95rem;
        color: #6B7280;
        line-height: 1.9;
        margin-bottom: 14px;
    }

    /* ---- Values Section ---- */
    .intro-values {
        margin-bottom: 60px;
    }

    .intro-values-header {
        text-align: center;
        margin-bottom: 48px;
    }

    .intro-values-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1B2A4A;
    }

    .intro-values-grid {
        display: grid;
        grid-template-columns: 1fr 1fr;
        gap: 40px;
        align-items: center;
    }

    .intro-values-content h3 {
        font-family: 'Inter', sans-serif;
        font-size: 1.1rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 12px;
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .intro-values-content h3 i {
        color: #C8956C;
        font-size: 1rem;
    }

    .intro-values-content p {
        font-size: 0.95rem;
        color: #6B7280;
        line-height: 1.8;
        margin-bottom: 24px;
    }

    .intro-values-img {
        border-radius: 20px;
        overflow: hidden;
        box-shadow: 0 10px 40px rgba(0,0,0,0.08);
    }

    .intro-values-img img {
        width: 100%;
        height: auto;
        display: block;
        transition: transform 0.5s ease;
    }

    .intro-values-img:hover img {
        transform: scale(1.05);
    }

    /* ---- Timeline ---- */
    .intro-timeline {
        background: linear-gradient(135deg, #FDF8F3, #FAFAF8);
        border-radius: 20px;
        padding: 48px 40px;
        margin-bottom: 60px;
    }

    .intro-timeline-title {
        font-family: 'Playfair Display', serif;
        font-size: 1.5rem;
        font-weight: 700;
        color: #1B2A4A;
        text-align: center;
        margin-bottom: 36px;
    }

    .timeline-items {
        display: grid;
        grid-template-columns: repeat(3, 1fr);
        gap: 32px;
    }

    .timeline-item {
        text-align: center;
        position: relative;
    }

    .timeline-year {
        display: inline-flex;
        align-items: center;
        justify-content: center;
        width: 56px;
        height: 56px;
        border-radius: 50%;
        background: linear-gradient(135deg, #C8956C, #A67548);
        color: white;
        font-weight: 800;
        font-size: 0.85rem;
        margin-bottom: 16px;
        box-shadow: 0 4px 15px rgba(200, 149, 108, 0.3);
    }

    .timeline-title {
        font-weight: 700;
        color: #1B2A4A;
        font-size: 0.95rem;
        margin-bottom: 8px;
    }

    .timeline-desc {
        font-size: 0.85rem;
        color: #9CA3AF;
        line-height: 1.6;
    }

    @media (max-width: 768px) {
        .intro-about {
            flex-direction: column;
            text-align: center;
            gap: 40px;
        }

        .intro-values-grid {
            grid-template-columns: 1fr;
        }

        .timeline-items {
            grid-template-columns: 1fr;
            gap: 24px;
        }

        .intro-hero-title {
            font-size: 1.8rem;
        }
    }
</style>

<div class="intro-page">
    <!-- Hero -->
    <div class="intro-hero">
        <span class="intro-hero-label">
            <i class="fa-solid fa-star"></i> Về chúng tôi
        </span>
        <h1 class="intro-hero-title">Câu Chuyện DOHAFASHION</h1>
        <div class="section-divider"></div>
        <p class="intro-hero-subtitle">Hành trình mang đến phong cách và cảm hứng sống tích cực qua từng thiết kế thời trang</p>
    </div>

    <!-- About -->
    <div class="intro-about">
        <div class="intro-about-logo">
            <img src="{{ asset('assets/img/LoGo.png') }}" alt="DOHAFASHION Logo">
        </div>
        <div class="intro-about-text">
            <h3>Về DOHAFASHION</h3>
            <p class="intro-about-paragraph">
                DOHAFASHION là thương hiệu thời trang trẻ trung, ra đời vào ngày 12/10/2008 với mục tiêu mang đến cho khách hàng Việt Nam những sản phẩm thời trang hiện đại, phong cách và chất lượng cao.
            </p>
            <p class="intro-about-paragraph">
                Với phương châm "Tinh tế trong từng đường kim, nổi bật với từng phong cách", DOHAFASHION không ngừng đổi mới và cập nhật xu hướng thời trang mới nhất để đáp ứng mọi nhu cầu của khách hàng.
            </p>
            <p class="intro-about-paragraph">
                Chúng tôi cam kết cung cấp các sản phẩm thời trang đa dạng, phù hợp với mọi độ tuổi và phong cách, luôn đặt chất lượng và trải nghiệm khách hàng lên hàng đầu.
            </p>
        </div>
    </div>

    <!-- Timeline -->
    <div class="intro-timeline">
        <h2 class="intro-timeline-title">Hành Trình Phát Triển</h2>
        <div class="section-divider" style="margin-bottom: 36px;"></div>
        <div class="timeline-items">
            <div class="timeline-item">
                <div class="timeline-year">2008</div>
                <h4 class="timeline-title">Thành lập</h4>
                <p class="timeline-desc">Ra đời với niềm đam mê thời trang và ước mơ tạo nên thương hiệu Việt</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2018</div>
                <h4 class="timeline-title">Mở rộng</h4>
                <p class="timeline-desc">Phát triển hệ thống bán hàng online, phục vụ khách hàng toàn quốc</p>
            </div>
            <div class="timeline-item">
                <div class="timeline-year">2025</div>
                <h4 class="timeline-title">Đổi mới</h4>
                <p class="timeline-desc">Cập nhật công nghệ, nâng tầm trải nghiệm mua sắm thời trang</p>
            </div>
        </div>
    </div>

    <!-- Values -->
    <div class="intro-values">
        <div class="intro-values-header">
            <h2 class="intro-values-title">Tầm Nhìn & Giá Trị Cốt Lõi</h2>
            <div class="section-divider"></div>
        </div>

        <div class="intro-values-grid">
            <div class="intro-values-content">
                <h3><i class="fa-solid fa-eye"></i> Tầm nhìn</h3>
                <p>
                    DOHAFASHION hướng tới trở thành thương hiệu thời trang hàng đầu tại Việt Nam, được yêu thích bởi sự tinh tế, sáng tạo và khác biệt.
                </p>
                <p>
                    Sứ mệnh của chúng tôi là giúp mọi người tự tin thể hiện phong cách riêng thông qua những bộ trang phục hiện đại, thời thượng và bền đẹp.
                </p>

                <h3><i class="fa-solid fa-gem"></i> Giá trị</h3>
                <p>
                    <strong>Chất lượng – Sáng tạo – Trách nhiệm – Thân thiện</strong> là những giá trị cốt lõi mà DOHAFASHION luôn hướng đến trong từng sản phẩm và dịch vụ.
                </p>
                <p>
                    Mỗi thiết kế đều được chăm chút tỉ mỉ, từ chất liệu cho đến kiểu dáng, nhằm mang đến trải nghiệm tốt nhất cho khách hàng.
                </p>
            </div>

            <div class="intro-values-img">
                <img src="{{ asset('assets/img/DALL.webp') }}" alt="Banner thời trang DOHAFASHION">
            </div>
        </div>
    </div>
</div>
@endsection

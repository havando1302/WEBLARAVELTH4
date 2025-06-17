@extends('layouts.app')

@section('title', 'Trang Chủ')

@section('content')
<style>
  * {
    margin: 0;
    padding: 0;
    box-sizing: border-box;
  }

  body {
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
    color: #333;
    background-color: #fff;
    line-height: 1.6;
  }

  .grid {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .content_banner img {
    width: 100%;
    height: auto;
    display: block;
    margin-bottom: 40px;
  }

  .content_introduce {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 30px;
    margin-bottom: 60px;
    padding-top:20px;
  }

  .content_logo-image {
    max-width: 240px;
    height: auto;
  }

  .content_intro-text {
    max-width: 600px;
  }

  .content_intro-text-paragraph {
    margin-bottom: 12px;
    font-size: 16px;
  }

  .content_section {
    text-align: center;
    margin-bottom: 60px;
  }

  .content_section-heading {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 40px;
  }

  .content_section-benefit {
    display: inline-block;
    width: 240px;
    margin: 0 10px 30px;
    vertical-align: top;
  }

  .content_section-benefit-background {
    width: 100px;
    height: 100px;
    margin: 0 auto 15px;
  }

  .content_section-benefit-image {
    width: 100%;
    height: auto;
    border-radius: 50%;
  }

  .content_section-benefit-text-heading {
    font-weight: 700;
    font-size: 16px;
    margin-bottom: 6px;
  }

  .content_section-benefit-text-paragraph {
    font-size: 14px;
    color: #666;
  }
</style>

<div class="grid">
  <div id="bannerCarousel" class="carousel slide" data-bs-ride="carousel">
    <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="{{ asset('assets/img/DALL.webp') }}" class="d-block w-100" alt="Banner 1">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/img/DALL2.jpg') }}" class="d-block w-100" alt="Banner 2">
      </div>
      <div class="carousel-item">
        <img src="{{ asset('assets/img/DALL1.jpg') }}" class="d-block w-100" alt="Banner 3">
      </div>
    </div>
    <button class="carousel-control-prev" type="button" data-bs-target="#bannerCarousel" data-bs-slide="prev">
      <span class="carousel-control-prev-icon"></span>
      <span class="visually-hidden">Previous</span>
    </button>
    <button class="carousel-control-next" type="button" data-bs-target="#bannerCarousel" data-bs-slide="next">
      <span class="carousel-control-next-icon"></span>
      <span class="visually-hidden">Next</span>
    </button>
  </div>
</div>

  <div class="content_introduce">
    <div class="content_logo">
    <img src="{{ asset('assets/img/LoGo.png') }}" alt="Logo" class="content_logo-image">
    </div>
    <div class="content_intro-text">
  <p class="content_intro-text-paragraph">
    **DOHAFASHION là điểm đến lý tưởng dành cho những tín đồ yêu thích thời trang hiện đại, thanh lịch và cá tính. Với sứ mệnh mang đến cho người tiêu dùng Việt Nam những sản phẩm thời trang chất lượng cao, hợp xu hướng và đầy phong cách, chúng tôi không chỉ cung cấp quần áo đẹp mà còn truyền tải sự tự tin và cảm hứng sống tích cực qua từng thiết kế.
  </p>
  <p class="content_intro-text-paragraph">
    Với phương châm “Phong Cách – Chất Lượng – Tận Tâm”, DOHAFASHION luôn nỗ lực đổi mới và hoàn thiện để đáp ứng mọi nhu cầu thời trang của khách hàng. Chúng tôi cam kết mang đến trải nghiệm mua sắm đáng nhớ với các sản phẩm được tuyển chọn kỹ lưỡng và dịch vụ tận tình.
  </p>
  <p class="content_intro-text-paragraph">
    Khách hàng là trung tâm của mọi hoạt động tại DOHAFASHION. Mỗi sản phẩm không chỉ là một món đồ thời trang, mà còn là tuyên ngôn cá nhân, là sự thể hiện cá tính và gu thẩm mỹ riêng. Với các chất liệu cao cấp, đường may tỉ mỉ và thiết kế đa dạng, chúng tôi tự hào là lựa chọn đáng tin cậy của những người yêu thời trang Việt.
  </p>
</div>

  </div>

  <div class="content_section">
    <h2 class="content_section-heading">LÝ DO BẠN NÊN MUA SẢN PHẨM CỦA CHÚNG TÔI</h2>

    <div class="content_section-benefit">
      <div class="content_section-benefit-background">
        <img src="assets/img/HT.jpg" alt="Lợi ích 1" class="content_section-benefit-image">
      </div>
      <div class="content_section-benefit-text">
        <h3 class="content_section-benefit-text-heading">GIAO HÀNG HỎA TỐC</h3>
        <p class="content_section-benefit-text-paragraph">THỜI GIAN GIAO HÀNG NHANH CHÓNG</p>
      </div>
    </div>

    <div class="content_section-benefit">
      <div class="content_section-benefit-background">
        <img src="assets/img/CK.png" alt="Lợi ích 2" class="content_section-benefit-image">
      </div>
      <div class="content_section-benefit-text">
        <h3 class="content_section-benefit-text-heading">CHĂM SÓC KHÁCH HÀNG</h3>
        <p class="content_section-benefit-text-paragraph">CHĂM SÓC KHÁCH HÀNG 24/7</p>
      </div>
    </div>

    <div class="content_section-benefit">
      <div class="content_section-benefit-background">
        <img src="assets/img/DT.jpg" alt="Lợi ích 3" class="content_section-benefit-image">
      </div>
      <div class="content_section-benefit-text">
        <h3 class="content_section-benefit-text-heading">CHÍNH SÁCH ĐỔI TRẢ</h3>
        <p class="content_section-benefit-text-paragraph">1 ĐỔI 1 TRONG VÒNG 3 NGÀY NẾU HÀNG LỖI</p>
      </div>
    </div>

    <div class="content_section-benefit">
      <div class="content_section-benefit-background">
        <img src="assets/img/TT.jpg" alt="Lợi ích 4" class="content_section-benefit-image">
      </div>
      <div class="content_section-benefit-text">
        <h3 class="content_section-benefit-text-heading">THANH TOÁN AN TOÀN</h3>
        <p class="content_section-benefit-text-paragraph">BẢO MẬT THÔNG TIN KHÁCH HÀNG</p>
      </div>
    </div>
  </div>
</div>
@endsection
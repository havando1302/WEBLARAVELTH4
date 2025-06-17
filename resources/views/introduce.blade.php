@extends('layouts.app')

@section('content')

<!-- Google Font -->
<link href="https://fonts.googleapis.com/css2?family=Roboto:wght@100;300;400;500;700&display=swap" rel="stylesheet">

<!-- Page CSS -->
<style>
  .grid {
    width: 100%;
    max-width: 1280px;
    margin: 0 auto;
    padding: 0 20px;
  }

  .intro_container {
    margin-bottom: 30px;
  }
  .intro_content {
    padding-top: 20px;
  }
  .intro_content-header {
    font-size: 24px;
    font-weight: 700;
    margin-bottom: 20px;
  }

  .content_introduce {
    display: flex;
    flex-wrap: wrap;
    align-items: center;
    justify-content: center;
    gap: 30px;
  }

  .content_logo-image {
    max-width: 240px;
    height: auto;
  }

  .content_intro-text-paragraph {
    margin-bottom: 12px;
    font-size: 16px;
  }

  .intro_content-container {
    display: flex;
    flex-wrap: wrap;
    gap: 20px;
  }

  .intro_content-container-half {
    flex: 1;
    min-width: 300px;
  }

  .intro_content-container-img {
    width: 100%;
    height: auto;
    margin-top: 10px;
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

  .footer_info-heading {
    font-weight: 700;
    margin-bottom: 10px;
  }

  .footer_info-line {
    width: 40px;
    height: 2px;
    background-color: #fff;
    margin-bottom: 10px;
  }

  .footer_info-text {
    font-size: 14px;
    margin-bottom: 6px;
  }

  .footer_info-policy {
    color: #fff;
    text-decoration: none;
  }
</style>

<!-- Content -->
<div class="grid">

  <!-- Giới thiệu -->
  <div class="intro_container">
    <div class="intro_content">
      <h2 class="intro_content-header">Về DOHAFASHION</h2>

      <div class="content_introduce">
        <div class="content_logo">
          <img
            src="{{ asset('assets/img/LoGo.png') }}"
            alt="Logo DOHAFASHION"
            class="content_logo-image"
          >
        </div>

        <div class="content_intro-text">
          <p class="content_intro-text-paragraph">
            DOHAFASHION là thương hiệu thời trang trẻ trung, ra đời vào ngày 12/10/2008 với mục tiêu mang đến cho khách hàng Việt Nam những sản phẩm thời trang hiện đại, phong cách và chất lượng cao.
          </p>
          <p class="content_intro-text-paragraph">
            Với phương châm “Tinh tế trong từng đường kim, nổi bật với từng phong cách”, DOHAFASHION không ngừng đổi mới và cập nhật xu hướng thời trang mới nhất để đáp ứng mọi nhu cầu của khách hàng.
          </p>
          <p class="content_intro-text-paragraph">
            Chúng tôi cam kết cung cấp các sản phẩm thời trang đa dạng, phù hợp với mọi độ tuổi và phong cách, luôn đặt chất lượng và trải nghiệm khách hàng lên hàng đầu.
          </p>
        </div>
      </div>
    </div>

    <!-- Tầm nhìn & Giá trị -->
    <div class="intro_content">
      <h2 class="intro_content-header">Tầm nhìn - Giá trị cốt lõi</h2>

      <div class="intro_content-container">
        <div class="intro_content-container-half">
        <h3 style="margin-top: 0;"><b>Tầm nhìn:</b></h3>
          <p>
            DOHAFASHION hướng tới trở thành thương hiệu thời trang hàng đầu tại Việt Nam, được yêu thích bởi sự tinh tế, sáng tạo và khác biệt.
          </p>
          <p>
            Sứ mệnh của chúng tôi là giúp mọi người tự tin thể hiện phong cách riêng thông qua những bộ trang phục hiện đại, thời thượng và bền đẹp.
          </p>

          <h3 style="margin-top: 0;"><b>Giá trị:</b></h3>
          <p>
            Chất lượng – Sáng tạo – Trách nhiệm – Thân thiện là những giá trị cốt lõi mà DOHAFASHION luôn hướng đến trong từng sản phẩm và dịch vụ.
          </p>
          <p>
            Mỗi thiết kế đều được chăm chút tỉ mỉ, từ chất liệu cho đến kiểu dáng, nhằm mang đến trải nghiệm tốt nhất cho khách hàng.
          </p>
        </div>

        <div class="intro_content-container-half">
          <img
            src="{{ asset('assets/img/DALL.webp') }}"
            alt="Banner thời trang"
            class="intro_content-container-img"
          >
        </div>
      </div>
    </div>
  </div>

</div>
@endsection

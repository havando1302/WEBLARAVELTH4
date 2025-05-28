@extends('layouts.app')

@section('content')
<section class="welcome-section">
    <h1 class="welcome-title">
        Chào mừng đến với <span class="highlight">DOHAFASHION</span>!
    </h1>

    <p class="welcome-subtitle">
        Shop thời trang uy tín – giá rẻ, đồng hành cùng phong cách của bạn!
    </p>

    <div class="welcome-features">
        <p>✨ Thời trang là phong cách – DOHAFASHION là lựa chọn!</p>
        <p>👗 Đẹp hơn mỗi ngày cùng DOHAFASHION!</p>
        <p>🛍️ Đa dạng – Chất lượng – Giá cả hợp lý!</p>
        <p>🚚 Giao hàng nhanh chóng –</p>
    </div>

    <div class="welcome-description">
        <p>
            <strong>DOHAFASHION</strong> là một shop thời trang uy tín và giá rẻ, được thành lập vào ngày <strong>20/05/2020</strong>.
            Chúng tôi chuyên cung cấp các sản phẩm thời trang chất lượng, phù hợp với nhiều phong cách khác nhau từ trẻ trung, năng động
            đến thanh lịch, sang trọng. Với phương châm <em>“Khách hàng là trung tâm”</em>, chúng tôi luôn nỗ lực đem đến trải nghiệm mua sắm tốt nhất
            cho bạn.
        </p>
    </div>
</section>
@endsection

@push('styles')
<style>
    .welcome-section {
        text-align: center;
        padding: 3rem 1rem;
        background-color: aqua;
        display: flex;
        flex-direction: column;
        align-items: center;
        justify-content: center;
    }

    .welcome-title {
        font-size: 2.25rem;
        font-weight: 700;
        color: #1f2937;
        margin-bottom: 1rem;
    }

    .highlight {
        color: #db2777;
    }

    .welcome-subtitle {
        font-size: 1.125rem;
        color: #4b5563;
        margin-bottom: 1.5rem;
    }

    .welcome-features {
        max-width: 42rem;
        width: 100%;
    }

    .welcome-features p {
        font-size: 1.25rem;
        color: #374151;
        font-weight: 600;
        margin-bottom: 0.5rem;
    }

    .welcome-description {
        margin-top: 2.5rem;
        font-size: 1rem;
        color: #4b5563;
        max-width: 42rem;
    }
</style>
@endpush

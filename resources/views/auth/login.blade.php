@extends('layouts.app')

@section('title', 'Đăng nhập')

<link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">
<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/normalize/8.0.1/normalize.min.css">
<link rel="stylesheet" href="{{ asset('assets/fonts/fontawesome-free-6.6.0/css/all.min.css') }}">
<style>
.main-content {
    position: relative;
    z-index: 1;
}

.main-content::before {
    content: "";
    position: absolute;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background-image: url('{{ asset('assets/img/DALL.webp') }}');
    background-repeat: no-repeat;
    background-position: center center;
    background-size: cover; /* Hoặc 'contain' nếu muốn vừa khung mà không cắt ảnh */
    opacity: 0.2; /* Làm mờ ảnh */
    z-index: -1; /* Ảnh nằm dưới nội dung */
    pointer-events: none; /* Không chặn thao tác chuột */
}

</style>


@section('content')
<div class="modal js_modal" style="display: flex; position: relative;">
    <div class="modal_body" style="margin: auto; max-width: 500px;">
        <!-- Login Form -->
        <form method="POST" action="{{ route('login') }}" class="auth_form js_login-form" style="display: block;">
            @csrf
            <div class="auth_form-header">
                <h3 class="auth_form-heading">ĐĂNG NHẬP</h3>
                <a href="{{ route('register') }}" class="auth_form-switch">ĐĂNG KÝ</a>
            </div>

            <div class="auth_form-form">
                <div class="auth_form-group">
                    <input type="text" name="email" class="auth_form-input" placeholder="Tên đăng nhập hoặc Email" value="{{ old('email') }}" required autofocus>
                    @error('email')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
                <div class="auth_form-group">
                    <input type="password" name="password" class="auth_form-input" placeholder="Mật khẩu" required>
                    @error('password')
                        <span style="color: red;">{{ $message }}</span>
                    @enderror
                </div>
            </div>

            <div class="auth_form-remember">
                <label>
                    <input type="checkbox" name="remember" class="auth_form-check" {{ old('remember') ? 'checked' : '' }}>
                    <span class="auth_form-remember-text">Ghi nhớ mật khẩu</span>
                </label>
            </div>

            <div class="auth_form-controls">
                <a href="{{ url()->previous() }}" class="btn btn_back">TRỞ LẠI</a>
                <button type="submit" class="btn btn_login btn_login-register">ĐĂNG NHẬP</button>
            </div>

            <div class="auth_form-forget">
                <a href="{{ route('password.request') }}">Quên mật khẩu?</a>
            </div>
        </form>
    </div>
</div>
@endsection 
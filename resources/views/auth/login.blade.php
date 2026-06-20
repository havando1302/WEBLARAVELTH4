@extends('layouts.app')

@section('title', 'Đăng nhập')

<link rel="stylesheet" href="{{ asset('assets/css/base.css') }}">

<style>
.auth-page {
    display: flex;
    align-items: center;
    justify-content: center;
    min-height: 70vh;
    padding: 40px 20px;
    position: relative;
}

.auth-page::before {
    content: '';
    position: absolute;
    top: -50%;
    right: -20%;
    width: 600px;
    height: 600px;
    background: radial-gradient(circle, rgba(200, 149, 108, 0.08), transparent 70%);
    pointer-events: none;
}

.auth-page::after {
    content: '';
    position: absolute;
    bottom: -30%;
    left: -10%;
    width: 400px;
    height: 400px;
    background: radial-gradient(circle, rgba(27, 42, 74, 0.05), transparent 70%);
    pointer-events: none;
}

.auth-card {
    background: white;
    border-radius: 20px;
    box-shadow: 0 20px 60px rgba(0, 0, 0, 0.08);
    width: 100%;
    max-width: 460px;
    padding: 44px 40px;
    position: relative;
    z-index: 1;
    border: 1px solid #F3F4F6;
    animation: fadeInUp 0.5s cubic-bezier(0.34, 1.56, 0.64, 1) both;
}

@keyframes fadeInUp {
    from { opacity: 0; transform: translateY(30px); }
    to { opacity: 1; transform: translateY(0); }
}

.auth-card-header {
    display: flex;
    align-items: center;
    justify-content: space-between;
    margin-bottom: 32px;
}

.auth-card-title {
    font-family: 'Playfair Display', serif;
    font-size: 1.8rem;
    font-weight: 700;
    color: #1B2A4A;
}

.auth-card-switch {
    font-size: 0.88rem;
    font-weight: 600;
    color: #C8956C;
    text-decoration: none;
    padding: 8px 18px;
    border: 2px solid #C8956C;
    border-radius: 8px;
    transition: all 0.3s ease;
}

.auth-card-switch:hover {
    background: #C8956C;
    color: white;
}

.auth-input-group {
    margin-bottom: 20px;
    position: relative;
}

.auth-input-icon {
    position: absolute;
    left: 16px;
    top: 50%;
    transform: translateY(-50%);
    color: #9CA3AF;
    font-size: 0.9rem;
}

.auth-input {
    width: 100%;
    height: 50px;
    padding: 0 16px 0 44px;
    border: 1.5px solid #E5E7EB;
    border-radius: 12px;
    font-family: 'Inter', sans-serif;
    font-size: 0.95rem;
    color: #1A1A1A;
    background: #FAFAF8;
    transition: all 0.3s ease;
    outline: none;
}

.auth-input:focus {
    border-color: #C8956C;
    box-shadow: 0 0 0 3px rgba(200, 149, 108, 0.15);
    background: white;
}

.auth-input::placeholder {
    color: #9CA3AF;
}

.auth-error {
    display: block;
    color: #DC2626;
    font-size: 0.82rem;
    margin-top: 6px;
    padding-left: 4px;
}

.auth-remember {
    display: flex;
    align-items: center;
    gap: 8px;
    margin-bottom: 24px;
}

.auth-remember input[type="checkbox"] {
    accent-color: #C8956C;
    width: 18px;
    height: 18px;
}

.auth-remember-text {
    font-size: 0.88rem;
    color: #6B7280;
    font-weight: 500;
}

.auth-actions {
    display: flex;
    gap: 12px;
}

.auth-btn-back {
    flex: 1;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 14px;
    background: white;
    color: #6B7280;
    border: 1.5px solid #E5E7EB;
    border-radius: 12px;
    font-weight: 600;
    font-size: 0.92rem;
    text-decoration: none;
    transition: all 0.3s;
    cursor: pointer;
}

.auth-btn-back:hover {
    background: #F3F4F6;
    color: #374151;
}

.auth-btn-submit {
    flex: 2;
    display: flex;
    align-items: center;
    justify-content: center;
    gap: 6px;
    padding: 14px;
    background: linear-gradient(135deg, #C8956C, #A67548);
    color: white;
    border: none;
    border-radius: 12px;
    font-weight: 700;
    font-size: 0.95rem;
    cursor: pointer;
    transition: all 0.3s;
    letter-spacing: 0.3px;
}

.auth-btn-submit:hover {
    transform: translateY(-2px);
    box-shadow: 0 6px 20px rgba(200, 149, 108, 0.4);
}

.auth-footer-link {
    display: block;
    text-align: center;
    margin-top: 24px;
    color: #C8956C;
    font-weight: 500;
    font-size: 0.88rem;
    text-decoration: none;
    transition: color 0.2s;
}

.auth-footer-link:hover {
    color: #A67548;
    text-decoration: underline;
}

.auth-divider {
    display: flex;
    align-items: center;
    gap: 16px;
    margin: 24px 0;
    color: #D1D5DB;
    font-size: 0.82rem;
}

.auth-divider::before,
.auth-divider::after {
    content: '';
    flex: 1;
    height: 1px;
    background: #E5E7EB;
}
</style>

@section('content')
<div class="auth-page">
    <div class="auth-card">
        <div class="auth-card-header">
            <h2 class="auth-card-title">Đăng Nhập</h2>
            <a href="{{ route('register') }}" class="auth-card-switch">Đăng ký</a>
        </div>

        <form method="POST" action="{{ route('login') }}">
            @csrf

            <div class="auth-input-group">
                <i class="fa-solid fa-envelope auth-input-icon"></i>
                <input type="text" name="email" class="auth-input" placeholder="Email hoặc tên đăng nhập" value="{{ old('email') }}" required autofocus>
                @error('email')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-input-group">
                <i class="fa-solid fa-lock auth-input-icon"></i>
                <input type="password" name="password" class="auth-input" placeholder="Mật khẩu" required>
                @error('password')
                    <span class="auth-error">{{ $message }}</span>
                @enderror
            </div>

            <div class="auth-remember">
                <input type="checkbox" name="remember" id="remember" {{ old('remember') ? 'checked' : '' }}>
                <label for="remember" class="auth-remember-text">Ghi nhớ đăng nhập</label>
            </div>

            <div class="auth-actions">
                <a href="{{ url()->previous() }}" class="auth-btn-back">
                    <i class="fa-solid fa-arrow-left"></i> Trở lại
                </a>
                <button type="submit" class="auth-btn-submit">
                    <i class="fa-solid fa-right-to-bracket"></i> ĐĂNG NHẬP
                </button>
            </div>

            <a href="{{ route('password.request') }}" class="auth-footer-link">
                Quên mật khẩu?
            </a>
        </form>
    </div>
</div>
@endsection
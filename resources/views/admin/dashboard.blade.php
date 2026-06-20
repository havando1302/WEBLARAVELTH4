@extends('layouts.app')

@section('content')
<style>
    .admin-page {
        padding: 30px 0 80px;
    }

    .admin-header {
        display: flex;
        align-items: center;
        justify-content: space-between;
        margin-bottom: 32px;
        flex-wrap: wrap;
        gap: 16px;
    }

    .admin-header h1 {
        font-family: 'Playfair Display', serif;
        font-size: 1.8rem;
        font-weight: 700;
        color: #1B2A4A;
    }

    /* ---- Filter ---- */
    .admin-filter {
        display: flex;
        align-items: end;
        gap: 16px;
        flex-wrap: wrap;
        background: white;
        padding: 20px 24px;
        border-radius: 14px;
        border: 1px solid #F3F4F6;
        margin-bottom: 32px;
        box-shadow: 0 1px 3px rgba(0,0,0,0.03);
    }

    .admin-filter-group {
        display: flex;
        flex-direction: column;
        gap: 6px;
    }

    .admin-filter-label {
        font-size: 0.78rem;
        font-weight: 600;
        color: #6B7280;
        text-transform: uppercase;
        letter-spacing: 0.5px;
    }

    .admin-filter-input {
        padding: 10px 14px;
        border: 1.5px solid #E5E7EB;
        border-radius: 10px;
        font-family: 'Inter', sans-serif;
        font-size: 0.88rem;
        color: #374151;
        outline: none;
        transition: border-color 0.2s;
    }

    .admin-filter-input:focus {
        border-color: #C8956C;
    }

    .admin-filter-btn {
        padding: 10px 24px;
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
        border: none;
        border-radius: 10px;
        font-weight: 600;
        font-size: 0.88rem;
        cursor: pointer;
        transition: all 0.3s;
    }

    .admin-filter-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 12px rgba(27, 42, 74, 0.3);
    }

    /* ---- Stat Cards ---- */
    .stat-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(220px, 1fr));
        gap: 20px;
        margin-bottom: 48px;
    }

    .stat-card {
        background: white;
        border-radius: 16px;
        padding: 24px;
        border: 1px solid #F3F4F6;
        transition: all 0.3s ease;
        position: relative;
        overflow: hidden;
    }

    .stat-card::before {
        content: '';
        position: absolute;
        top: 0;
        left: 0;
        right: 0;
        height: 4px;
        transition: background 0.3s;
    }

    .stat-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
    }

    .stat-card-icon {
        font-size: 1.8rem;
        margin-bottom: 12px;
    }

    .stat-card-label {
        font-size: 0.82rem;
        font-weight: 600;
        color: #9CA3AF;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        margin-bottom: 6px;
    }

    .stat-card-value {
        font-size: 1.6rem;
        font-weight: 800;
        color: #1B2A4A;
    }

    .stat-revenue::before { background: linear-gradient(90deg, #059669, #34D399); }
    .stat-revenue .stat-card-value { color: #059669; }

    .stat-orders::before { background: linear-gradient(90deg, #2563EB, #60A5FA); }
    .stat-orders .stat-card-icon { color: #2563EB; }

    .stat-customers::before { background: linear-gradient(90deg, #7C3AED, #A78BFA); }
    .stat-customers .stat-card-icon { color: #7C3AED; }

    .stat-products::before { background: linear-gradient(90deg, #C8956C, #D4A76A); }
    .stat-products .stat-card-icon { color: #C8956C; }

    .stat-new::before { background: linear-gradient(90deg, #0891B2, #67E8F9); }
    .stat-new .stat-card-value { color: #0891B2; }
    .stat-new .stat-card-icon { color: #0891B2; }

    /* ---- Management Cards ---- */
    .mgmt-header {
        font-family: 'Playfair Display', serif;
        font-size: 1.4rem;
        font-weight: 700;
        color: #1B2A4A;
        margin-bottom: 20px;
    }

    .mgmt-grid {
        display: grid;
        grid-template-columns: repeat(auto-fill, minmax(260px, 1fr));
        gap: 20px;
    }

    .mgmt-card {
        display: flex;
        align-items: center;
        gap: 16px;
        padding: 24px;
        background: white;
        border-radius: 14px;
        border: 1px solid #F3F4F6;
        text-decoration: none;
        color: #1B2A4A;
        transition: all 0.3s ease;
    }

    .mgmt-card:hover {
        transform: translateY(-4px);
        box-shadow: 0 10px 30px rgba(0,0,0,0.06);
        border-color: #C8956C;
        color: #1B2A4A;
    }

    .mgmt-card-icon {
        width: 50px;
        height: 50px;
        display: flex;
        align-items: center;
        justify-content: center;
        border-radius: 12px;
        font-size: 1.2rem;
        flex-shrink: 0;
    }

    .mgmt-card-icon.green { background: #D1FAE5; color: #059669; }
    .mgmt-card-icon.blue { background: #DBEAFE; color: #2563EB; }
    .mgmt-card-icon.purple { background: #E8EDF5; color: #1B2A4A; }

    .mgmt-card-text {
        font-weight: 600;
        font-size: 1rem;
    }

    .mgmt-card-desc {
        font-size: 0.82rem;
        color: #9CA3AF;
        margin-top: 4px;
    }

    @media (max-width: 576px) {
        .stat-grid {
            grid-template-columns: 1fr 1fr;
        }
    }
</style>

<div class="admin-page">
    <div class="admin-header">
        <h1><i class="fa-solid fa-chart-line" style="color: #C8956C; margin-right: 8px;"></i> Tổng Quan Hệ Thống</h1>
    </div>

    <!-- Filter -->
    <form action="{{ route('admin.dashboard') }}" method="GET" class="admin-filter">
        <div class="admin-filter-group">
            <label class="admin-filter-label" for="from">Từ ngày</label>
            <input type="date" name="from" id="from" value="{{ request('from') }}" class="admin-filter-input">
        </div>
        <div class="admin-filter-group">
            <label class="admin-filter-label" for="to">Đến ngày</label>
            <input type="date" name="to" id="to" value="{{ request('to') }}" class="admin-filter-input">
        </div>
        <div class="admin-filter-group">
            <label class="admin-filter-label" for="quick">Nhanh</label>
            <select name="quick" id="quick" class="admin-filter-input" onchange="this.form.submit()">
                <option value="">-- Chọn --</option>
                <option value="today" {{ request('quick') == 'today' ? 'selected' : '' }}>Hôm nay</option>
                <option value="yesterday" {{ request('quick') == 'yesterday' ? 'selected' : '' }}>Hôm qua</option>
                <option value="last_7_days" {{ request('quick') == 'last_7_days' ? 'selected' : '' }}>7 ngày qua</option>
                <option value="last_month" {{ request('quick') == 'last_month' ? 'selected' : '' }}>Tháng trước</option>
            </select>
        </div>
        <button type="submit" class="admin-filter-btn">
            <i class="fa-solid fa-filter" style="margin-right: 6px;"></i> Lọc
        </button>
    </form>

    <!-- Stats -->
    <div class="stat-grid">
        <div class="stat-card stat-revenue">
            <div class="stat-card-icon">💰</div>
            <p class="stat-card-label">Tổng doanh thu</p>
            <p class="stat-card-value">{{ number_format($totalRevenue) }} VNĐ</p>
        </div>
        <div class="stat-card stat-orders">
            <div class="stat-card-icon">📦</div>
            <p class="stat-card-label">Đơn hàng</p>
            <p class="stat-card-value">{{ $totalOrders }}</p>
        </div>
        <div class="stat-card stat-customers">
            <div class="stat-card-icon">👥</div>
            <p class="stat-card-label">Khách hàng</p>
            <p class="stat-card-value">{{ $totalCustomers }}</p>
        </div>
        <div class="stat-card stat-products">
            <div class="stat-card-icon">🛒</div>
            <p class="stat-card-label">Sản phẩm</p>
            <p class="stat-card-value">{{ $totalProducts }}</p>
        </div>
        <div class="stat-card stat-new">
            <div class="stat-card-icon">🆕</div>
            <p class="stat-card-label">Đơn mới</p>
            <p class="stat-card-value">{{ $newOrders }}</p>
        </div>
        <div class="stat-card stat-new">
            <div class="stat-card-icon">👤</div>
            <p class="stat-card-label">KH mới</p>
            <p class="stat-card-value">{{ $newCustomers }}</p>
        </div>
        <div class="stat-card stat-new">
            <div class="stat-card-icon">🆕</div>
            <p class="stat-card-label">SP mới</p>
            <p class="stat-card-value">{{ $newProducts }}</p>
        </div>
    </div>

    <!-- Management -->
    <h2 class="mgmt-header"><i class="fa-solid fa-gear" style="color: #C8956C; margin-right: 8px;"></i> Quản Lý Hệ Thống</h2>
    <div class="mgmt-grid">
        <a href="{{ route('admin.products.index') }}" class="mgmt-card">
            <div class="mgmt-card-icon green"><i class="fa-solid fa-shirt"></i></div>
            <div>
                <div class="mgmt-card-text">Quản lý sản phẩm</div>
                <div class="mgmt-card-desc">Thêm, sửa, xóa sản phẩm</div>
            </div>
        </a>
        <a href="{{ route('admin.orders.index') }}" class="mgmt-card">
            <div class="mgmt-card-icon blue"><i class="fa-solid fa-box"></i></div>
            <div>
                <div class="mgmt-card-text">Quản lý đơn hàng</div>
                <div class="mgmt-card-desc">Xem, cập nhật đơn hàng</div>
            </div>
        </a>
        <a href="{{ route('admin.categories.index') }}" class="mgmt-card">
            <div class="mgmt-card-icon purple"><i class="fa-solid fa-tags"></i></div>
            <div>
                <div class="mgmt-card-text">Quản lý danh mục</div>
                <div class="mgmt-card-desc">Quản lý danh mục sản phẩm</div>
            </div>
        </a>
    </div>
</div>
@endsection

<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Admin Dashboard - {{ config('app.name', 'Laravel') }}</title>

    <!-- Google Fonts -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@300;400;500;600;700&display=swap" rel="stylesheet">
    
    <!-- Bootstrap CSS -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
    
    <!-- Font Awesome -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />

    <!-- Chart.js -->
    <script src="https://cdn.jsdelivr.net/npm/chart.js"></script>

    <style>
        :root {
            --admin-bg: #f9fafb;
            --sidebar-bg: #ffffff;
            --sidebar-width: 260px;
            --header-height: 70px;
            --text-primary: #374151;
            --text-secondary: #6b7280;
            --primary-color: #3b82f6; /* Blue like Adminator */
            --primary-hover: #2563eb;
            --border-color: #e5e7eb;
        }

        body {
            font-family: 'Inter', sans-serif;
            background-color: var(--admin-bg);
            color: var(--text-primary);
            overflow-x: hidden;
            margin: 0;
            padding: 0;
        }

        /* Sidebar Styles */
        .admin-sidebar {
            width: var(--sidebar-width);
            background: var(--sidebar-bg);
            border-right: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            left: 0;
            height: 100vh;
            overflow-y: auto;
            transition: all 0.3s;
            z-index: 1000;
        }

        .sidebar-header {
            height: var(--header-height);
            display: flex;
            align-items: center;
            padding: 0 24px;
            border-bottom: 1px solid var(--border-color);
        }

        .sidebar-brand {
            font-size: 1.25rem;
            font-weight: 700;
            color: var(--text-primary);
            text-decoration: none;
            display: flex;
            align-items: center;
            gap: 10px;
        }

        .sidebar-brand i {
            color: var(--primary-color);
            font-size: 1.5rem;
        }

        .sidebar-menu {
            padding: 20px 0;
            list-style: none;
            margin: 0;
        }

        .sidebar-item {
            padding: 4px 20px;
        }

        .sidebar-link {
            display: flex;
            align-items: center;
            gap: 15px;
            color: var(--text-secondary);
            text-decoration: none;
            padding: 10px 15px;
            border-radius: 8px;
            font-weight: 500;
            transition: all 0.2s;
        }

        .sidebar-link:hover, .sidebar-link.active {
            background-color: #f3f4f6;
            color: var(--primary-color);
        }

        .sidebar-link i {
            width: 20px;
            text-align: center;
            font-size: 1.1rem;
        }

        /* Top Header Styles */
        .admin-header {
            height: var(--header-height);
            background: #ffffff;
            border-bottom: 1px solid var(--border-color);
            position: fixed;
            top: 0;
            right: 0;
            left: var(--sidebar-width);
            display: flex;
            align-items: center;
            justify-content: space-between;
            padding: 0 24px;
            z-index: 999;
            transition: all 0.3s;
        }

        .header-left {
            display: flex;
            align-items: center;
            gap: 20px;
        }

        .sidebar-toggle {
            background: none;
            border: none;
            color: var(--text-secondary);
            font-size: 1.25rem;
            cursor: pointer;
            padding: 0;
        }

        .search-bar {
            position: relative;
        }

        .search-bar i {
            position: absolute;
            left: 12px;
            top: 50%;
            transform: translateY(-50%);
            color: var(--text-secondary);
        }

        .search-bar input {
            border: none;
            background: none;
            padding-left: 35px;
            outline: none;
            font-family: inherit;
            color: var(--text-primary);
            width: 250px;
        }

        .search-bar input::placeholder {
            color: #9ca3af;
        }

        .header-right {
            display: flex;
            align-items: center;
            gap: 24px;
        }

        .header-icon {
            position: relative;
            color: var(--text-secondary);
            text-decoration: none;
            font-size: 1.25rem;
        }

        .header-icon .badge {
            position: absolute;
            top: -6px;
            right: -6px;
            background: #ef4444;
            color: white;
            font-size: 0.65rem;
            width: 16px;
            height: 16px;
            display: flex;
            align-items: center;
            justify-content: center;
            border-radius: 50%;
            padding: 0;
        }

        .user-profile {
            display: flex;
            align-items: center;
            gap: 10px;
            cursor: pointer;
            text-decoration: none;
            color: var(--text-primary);
        }

        .user-avatar {
            width: 36px;
            height: 36px;
            border-radius: 50%;
            object-fit: cover;
        }

        .user-name {
            font-weight: 500;
            font-size: 0.9rem;
        }

        /* Main Content */
        .admin-main {
            margin-left: var(--sidebar-width);
            margin-top: var(--header-height);
            padding: 30px;
            min-height: calc(100vh - var(--header-height));
            transition: all 0.3s;
        }

        /* Layout modifications when sidebar is hidden */
        .sidebar-hidden .admin-sidebar {
            transform: translateX(-100%);
        }
        .sidebar-hidden .admin-header {
            left: 0;
        }
        .sidebar-hidden .admin-main {
            margin-left: 0;
        }

        /* Utilities */
        .card-custom {
            background: #ffffff;
            border-radius: 12px;
            border: 1px solid var(--border-color);
            box-shadow: 0 1px 3px rgba(0,0,0,0.04);
            padding: 24px;
        }

        .page-title {
            font-size: 1.5rem;
            font-weight: 600;
            margin-bottom: 24px;
            color: #111827;
        }
        
        @media (max-width: 992px) {
            .admin-sidebar {
                transform: translateX(-100%);
            }
            .admin-header {
                left: 0;
            }
            .admin-main {
                margin-left: 0;
            }
            .sidebar-open .admin-sidebar {
                transform: translateX(0);
            }
            .sidebar-open .admin-header {
                left: var(--sidebar-width);
            }
        }
    </style>
    @yield('styles')
</head>
<body>

    <!-- Sidebar -->
    <aside class="admin-sidebar">
        <div class="sidebar-header">
            <a href="{{ route('admin.dashboard') }}" class="sidebar-brand">
                <i class="fa-solid fa-bolt"></i> Adminator
            </a>
        </div>
        <ul class="sidebar-menu">
            <li class="sidebar-item">
                <a href="{{ route('admin.dashboard') }}" class="sidebar-link {{ request()->routeIs('admin.dashboard') ? 'active' : '' }}">
                    <i class="fa-solid fa-house"></i>
                    <span>Dashboard</span>
                </a>
            </li>
            
            <li class="sidebar-item mt-3 mb-1 px-4">
                <span style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase;">Quản Lý Kho</span>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.products.index') }}" class="sidebar-link {{ request()->routeIs('admin.products.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-box-open"></i>
                    <span>Sản phẩm</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.categories.index') }}" class="sidebar-link {{ request()->routeIs('admin.categories.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-tags"></i>
                    <span>Danh mục</span>
                </a>
            </li>

            <li class="sidebar-item mt-3 mb-1 px-4">
                <span style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase;">Kinh Doanh</span>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.orders.index') }}" class="sidebar-link {{ request()->routeIs('admin.orders.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-cart-shopping"></i>
                    <span>Đơn hàng</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.promotions.index') }}" class="sidebar-link {{ request()->routeIs('admin.promotions.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-ticket"></i>
                    <span>Khuyến mãi</span>
                </a>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.reports.index') }}" class="sidebar-link {{ request()->routeIs('admin.reports.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-chart-pie"></i>
                    <span>Báo cáo bán hàng</span>
                </a>
            </li>

            <li class="sidebar-item mt-3 mb-1 px-4">
                <span style="font-size: 0.75rem; font-weight: 700; color: #9ca3af; text-transform: uppercase;">Hệ Thống</span>
            </li>
            <li class="sidebar-item">
                <a href="{{ route('admin.users.index') }}" class="sidebar-link {{ request()->routeIs('admin.users.*') ? 'active' : '' }}">
                    <i class="fa-solid fa-users"></i>
                    <span>Tài khoản</span>
                </a>
            </li>
        </ul>
    </aside>

    <!-- Header -->
    <header class="admin-header">
        <div class="header-left">
            <button class="sidebar-toggle" id="sidebarToggle">
                <i class="fa-solid fa-bars"></i>
            </button>
            <div class="search-bar d-none d-md-block">
                <i class="fa-solid fa-magnifying-glass"></i>
                <input type="text" placeholder="Search...">
            </div>
        </div>
        <div class="header-right">
            <a href="#" class="header-icon">
                <i class="fa-regular fa-bell"></i>
                <span class="badge">3</span>
            </a>
            <a href="#" class="header-icon">
                <i class="fa-regular fa-envelope"></i>
                <span class="badge">5</span>
            </a>
            <div class="dropdown">
                <a href="#" class="user-profile dropdown-toggle" data-bs-toggle="dropdown" aria-expanded="false">
                    <img src="https://ui-avatars.com/api/?name={{ urlencode(auth()->user()->name ?? 'Admin') }}&background=random" alt="User" class="user-avatar">
                    <span class="user-name d-none d-sm-inline">{{ auth()->user()->name ?? 'Admin' }}</span>
                </a>
                <ul class="dropdown-menu dropdown-menu-end shadow-sm border-0 mt-2">
                    <li><a class="dropdown-item" href="{{ route('home') }}"><i class="fa-solid fa-globe me-2"></i>Xem trang web</a></li>
                    <li><hr class="dropdown-divider"></li>
                    <li>
                        <form method="POST" action="{{ route('logout') }}">
                            @csrf
                            <button type="submit" class="dropdown-item text-danger">
                                <i class="fa-solid fa-arrow-right-from-bracket me-2"></i> Đăng xuất
                            </button>
                        </form>
                    </li>
                </ul>
            </div>
        </div>
    </header>

    <!-- Main Content -->
    <main class="admin-main">
        @if(session('success'))
            <div class="alert alert-success alert-dismissible fade show" role="alert">
                {{ session('success') }}
                <button type="button" class="btn-close" data-bs-dismiss="alert" aria-label="Close"></button>
            </div>
        @endif

        @yield('content')
    </main>

    <!-- Bootstrap JS -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/js/bootstrap.bundle.min.js"></script>
    
    <!-- Sidebar Toggle Script -->
    <script>
        document.getElementById('sidebarToggle').addEventListener('click', function() {
            if(window.innerWidth <= 992) {
                document.body.classList.toggle('sidebar-open');
            } else {
                document.body.classList.toggle('sidebar-hidden');
            }
        });
    </script>

    @yield('scripts')
</body>
</html>

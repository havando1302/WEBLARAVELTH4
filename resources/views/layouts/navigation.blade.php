<!DOCTYPE html>
<html lang="vi">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1" />
    <title>DOHAFASHION</title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.0/css/all.min.css" />
    <style>
    * {
        margin: 0;
        padding: 0;
        box-sizing: border-box;
    }

    body {
        font-family: 'Roboto', sans-serif;
    }

    .header {
        background-color: white;
        border-bottom: 1px solid #ccc;
    }

    .header_intro {
        display: flex;
        justify-content: space-between;
        padding: 5px 40px;
        background-color:  #e2a57c;
        font-size: 14px;
        color: #333;
    }

    .header_intro-list {
        display: flex;
        list-style: none;
    }

    .header_intro-item {
        margin-right: 20px;
        position: relative;
    }

    .header_intro-icon {
        margin-right: 5px;
        color: #333;
    }

    .tooltip .subintro {
        display: none;
        position: absolute;
        background: #333;
        color: #fff;
        padding: 3px 8px;
        border-radius: 4px;
        top: 25px;
        left: 0;
        font-size: 12px;
        white-space: nowrap;
    }

    .tooltip:hover .subintro {
        display: block;
    }

    .header_navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 15px 40px;
        background-color: white;
        position: relative;
    }

    .header_navbar-logo img {
        height: 100px;
        width: auto;
        
    }

    .header_navbar-list {
        display: flex;
        list-style: none;
        gap: 50px;
    }

    .header_navbar-item {
        margin: 0 15px;
        font-weight: 500;
        position: relative;
    }

    .header_navbar-item a {
        text-decoration: none;
        color: #333;
        transition: color 0.2s;
        display: inline-flex;
        align-items: center;
        gap: 6px;
    }

    .header_navbar-item a:hover {
        color: #ff5e57;
    }

    .header_navbar-btn {
        display: flex;
        align-items: center;
    }

    .header_navbar-btn-item {
        margin-left: 15px;
        position: relative;
        cursor: pointer;
    }

    .separator {
        width: 1px;
        height: 20px;
        background-color: #ccc;
        margin: 0 8px;
    }

    .header_navbar-search {
        position: absolute;
        top: 100%;
        right: 0;
        background: white;
        padding: 8px;
        border: 1px solid #ccc;
        border-radius: 6px;
        display: none;
        z-index: 999;
    }

    .header_navbar-search input {
        width: 180px;
        padding: 6px;
        font-size: 14px;
        border: 1px solid #ccc;
        border-radius: 4px;
    }

    .header_navbar-btn-item i {
        font-size: 18px;
        color: #333;
    }

    .notification-icon {
        position: relative;
    }

    .notification-count {
        position: absolute;
        top: -6px;
        right: -6px;
        background-color: red;
        color: white;
        font-size: 11px;
        font-weight: bold;
        padding: 2px 6px;
        border-radius: 50%;
        line-height: 1;
    }

    .header_navbar-submenu {
        display: none;
        position: absolute;
        top: 100%;
        left: 0;
        background: white;
        border: 1px solid #ddd;
        border-radius: 6px;
        list-style: none;
        padding: 10px 0;
        min-width: 180px;
        z-index: 1000;
        box-shadow: 0 2px 8px rgb(0 0 0 / 0.1);
    }

    .header_navbar-submenu li {
        padding: 8px 20px;
    }

    .header_navbar-submenu li a {
        color: #333;
        font-weight: 400;
    }

    .header_navbar-submenu li a:hover {
        color: #ff5e57;
    }

    .dropdown-icon {
        font-weight: bold;
        cursor: pointer;
        user-select: none;
        font-size: 16px;
        line-height: 1;
    }

    .header_navbar-dropdown > a {
        cursor: pointer;
    }
</style>

</head>
<body>
<header class="header">
    <div class="header_intro">
        <ul class="header_intro-list">
            <li class="header_intro-item" style="font-weight: bold;">Mặc đẹp – Sống chất – Dẫn đầu xu hướng</li>
        </ul>
        <ul class="header_intro-list">
        <li class="header_intro-item" style="font-weight: bold;">
                <i class="header_intro-icon fa-regular fa-clock"></i> 08:00 - 17:00
            </li>
            <li class="header_intro-item" style="font-weight: bold;">
                <i class="header_intro-icon fa-solid fa-phone"></i> +84 337950933
            </li>
        </ul>
    </div>

    <nav class="header_navbar">
        <a href="/" class="header_navbar-logo">
           <img src="{{ asset('assets/img/LoGo.png') }}">
        </a>

        <ul class="header_navbar-list">
            @auth
                @if(auth()->user()->is_admin)
                    <li class="header_navbar-item"><a href="{{ route('admin.dashboard') }}">Trang chủ</a></li>
                    <li class="header_navbar-item"><a href="{{ route('admin.products.index') }}">Sản phẩm</a></li>
                @else
                    <li class="header_navbar-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                    <li class="header_navbar-item header_navbar-dropdown">
                        <a href="{{ route('products.index') }}">Sản phẩm <span class="dropdown-icon">&#9776;</span></a>
                        @if(!empty($childCategories) && $childCategories->count())
                            <ul class="header_navbar-submenu">
                                @foreach($childCategories as $child)
                                    <li>
                                        <a href="{{ route('products.index', ['category_id' => $child->id]) }}">
                                            {{ $child->name }}
                                        </a>
                                    </li>
                                @endforeach
                            </ul>
                        @endif
                    </li>
                @endif
            @else
            <li class="header_navbar-item"><a href="{{ route('home') }}">Trang chủ</a></li>
                <li class="header_navbar-item header_navbar-dropdown">
                    <a href="{{ route('products.index') }}">Sản phẩm <span class="dropdown-icon">&#9776;</span></a>
                    @if(!empty($childCategories) && $childCategories->count())
                        <ul class="header_navbar-submenu">
                            @foreach($childCategories as $child)
                                <li>
                                    <a href="{{ route('products.index', ['category_id' => $child->id]) }}">
                                        {{ $child->name }}
                                    </a>
                                </li>
                            @endforeach
                        </ul>
                    @endif
                </li>
            @endauth

            <li class="header_navbar-item"><a href="{{ url('/introduce') }}">Giới thiệu</a></li>

            
            @auth
                @if(auth()->user()->is_admin)
                <li class="header_navbar-item"><a href="{{ route('admin.contacts.index') }}">Liên hệ</a></li>
                @else
                    <li class="header_navbar-item"><a href="{{ route('contact.index') }}">Liên hệ</a></li>
                @endif
            @else
                <li class="header_navbar-item"><a href="{{ route('contact.index') }}">Liên hệ</a></li>
            @endauth
        </ul>

        <div class="header_navbar-btn">
            <div class="header_navbar-btn-item" id="searchBtn" title="Tìm kiếm" tabindex="0" role="button" aria-label="Mở tìm kiếm">
                <i class="fas fa-search"></i>
            </div>
            <div class="header_navbar-search" id="searchBox" aria-hidden="true">
                <form action="{{ route('products.index') }}" method="GET" role="search">
                    <input type="search" name="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Tìm kiếm sản phẩm" />
                </form>
            </div>
            <div class="separator"></div>

            @auth
                <div class="header_navbar-btn-item notification-icon">
                    <a href="{{ route('notifications.index') }}" aria-label="Thông báo">
                        <i class="fa-solid fa-bell"></i>
                        @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                        @if($unreadCount > 0)
                            <span class="notification-count" aria-live="polite">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>
                <div class="separator"></div>
                <div class="header_navbar-btn-item">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" aria-haspopup="true" aria-expanded="false" aria-controls="user-menu">{{ Auth::user()->name }} <i class="fa-solid fa-chevron-down"></i></button>
                        </x-slot>
                        <x-slot name="content" id="user-menu" role="menu" aria-label="Menu người dùng">
                            <x-dropdown-link :href="route('profile.edit')" role="menuitem">Tài khoản</x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();" role="menuitem">
                                    Đăng xuất
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>
                <div class="separator"></div>
                <div class="header_navbar-btn-item">
                    <a href="{{ route('cart.index') }}" aria-label="Giỏ hàng">
                        Giỏ hàng <i class="fa-solid fa-cart-shopping"></i>
                    </a>
                </div>
            @else
                <a class="header_navbar-btn-item" href="{{ route('login') }}">Đăng nhập</a>
                <a class="header_navbar-btn-item" href="{{ route('register') }}">Đăng ký</a>
                <div class="separator"></div>
                <div class="header_navbar-btn-item">
                    <a href="{{ route('login') }}" aria-label="Giỏ hàng">Giỏ hàng <i class="fa-solid fa-cart-shopping"></i></a>
                </div>
            @endauth
        </div>
    </nav>
</header>

<script>
    const searchBtn = document.getElementById('searchBtn');
    const searchBox = document.getElementById('searchBox');

    document.addEventListener('click', function (event) {
        if (searchBtn.contains(event.target)) {
            if (searchBox.style.display === 'block') {
                searchBox.style.display = 'none';
                searchBox.setAttribute('aria-hidden', 'true');
            } else {
                searchBox.style.display = 'block';
                searchBox.setAttribute('aria-hidden', 'false');
                searchBox.querySelector('input').focus();
            }
        } else if (!searchBox.contains(event.target)) {
            searchBox.style.display = 'none';
            searchBox.setAttribute('aria-hidden', 'true');
        }
    });

    document.querySelectorAll('.dropdown-icon').forEach(icon => {
        icon.addEventListener('click', function (e) {
            e.preventDefault();
            e.stopPropagation();
            const parentLi = this.closest('.header_navbar-dropdown');
            const submenu = parentLi.querySelector('.header_navbar-submenu');

            document.querySelectorAll('.header_navbar-submenu').forEach(menu => {
                if (menu !== submenu) {
                    menu.style.display = 'none';
                }
            });

            submenu.style.display = (submenu.style.display === 'block') ? 'none' : 'block';
        });
    });

    document.addEventListener('click', function () {
        document.querySelectorAll('.header_navbar-submenu').forEach(menu => {
            menu.style.display = 'none';
        });
    });
</script>
</body>
</html>

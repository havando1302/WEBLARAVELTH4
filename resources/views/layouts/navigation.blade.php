<header class="header" id="mainHeader">
    <!-- Top bar -->
    <div class="header_intro">
        <div class="header_intro-inner">
            <span class="header_intro-slogan">
                <i class="fa-solid fa-gem"></i> Mặc đẹp – Sống chất – Dẫn đầu xu hướng
            </span>
            <div class="header_intro-contact">
                <span class="header_intro-item">
                    <i class="fa-regular fa-clock"></i> 08:00 - 17:00
                </span>
                <span class="header_intro-divider">|</span>
                <span class="header_intro-item">
                    <i class="fa-solid fa-phone"></i> +84 337 950 933
                </span>
            </div>
        </div>
    </div>

    <!-- Main navbar -->
    <nav class="header_navbar" id="navbar">
        <a href="/" class="header_navbar-logo">
           <img src="{{ asset('assets/img/LoGo.png') }}" alt="DOHAFASHION">
        </a>

        <ul class="header_navbar-list">
            @auth
                @if(auth()->user()->is_admin)
                    <li class="header_navbar-item"><a href="{{ route('admin.dashboard') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                    <li class="header_navbar-item"><a href="{{ route('admin.products.index') }}"><i class="fa-solid fa-shirt"></i> Sản phẩm</a></li>
                @else
                    <li class="header_navbar-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                    <li class="header_navbar-item header_navbar-dropdown">
                        <a href="{{ route('products.index') }}">
                            <i class="fa-solid fa-shirt"></i> Sản phẩm
                            <i class="fa-solid fa-chevron-down dropdown-icon-chevron"></i>
                        </a>
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
                <li class="header_navbar-item"><a href="{{ route('home') }}"><i class="fa-solid fa-house"></i> Trang chủ</a></li>
                <li class="header_navbar-item header_navbar-dropdown">
                    <a href="{{ route('products.index') }}">
                        <i class="fa-solid fa-shirt"></i> Sản phẩm
                        <i class="fa-solid fa-chevron-down dropdown-icon-chevron"></i>
                    </a>
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

            <li class="header_navbar-item"><a href="{{ url('/introduce') }}"><i class="fa-solid fa-building"></i> Giới thiệu</a></li>

            @auth
                @if(auth()->user()->is_admin)
                    <li class="header_navbar-item"><a href="{{ route('admin.contacts.index') }}"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
                @else
                    <li class="header_navbar-item"><a href="{{ route('contact.index') }}"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
                @endif
            @else
                <li class="header_navbar-item"><a href="{{ route('contact.index') }}"><i class="fa-solid fa-headset"></i> Liên hệ</a></li>
            @endauth
        </ul>

        <div class="header_navbar-btn">
            <!-- Search -->
            <div class="header_navbar-btn-item" id="searchBtn" title="Tìm kiếm" tabindex="0" role="button" aria-label="Mở tìm kiếm">
                <i class="fas fa-search"></i>
            </div>
            <div class="header_navbar-search" id="searchBox" aria-hidden="true">
                <form action="{{ route('products.index') }}" method="GET" role="search">
                    <div class="search-input-wrapper">
                        <i class="fas fa-search search-icon"></i>
                        <input type="search" name="search" placeholder="Tìm kiếm sản phẩm..." aria-label="Tìm kiếm sản phẩm" />
                    </div>
                </form>
            </div>

            @auth
                <!-- Notifications -->
                <div class="header_navbar-btn-item notification-icon">
                    <a href="{{ route('notifications.index') }}" aria-label="Thông báo">
                        <i class="fa-solid fa-bell"></i>
                        @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                        @if($unreadCount > 0)
                            <span class="notification-count" aria-live="polite">{{ $unreadCount }}</span>
                        @endif
                    </a>
                </div>

                <!-- User dropdown -->
                <div class="header_navbar-btn-item">
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button type="button" class="user-trigger-btn" aria-haspopup="true" aria-expanded="false">
                                <span class="user-avatar">{{ strtoupper(substr(Auth::user()->name, 0, 1)) }}</span>
                                {{ Auth::user()->name }}
                                <i class="fa-solid fa-chevron-down" style="font-size: 0.7rem; margin-left: 4px;"></i>
                            </button>
                        </x-slot>
                        <x-slot name="content" id="user-menu" role="menu" aria-label="Menu người dùng">
                            <x-dropdown-link :href="route('profile.edit')" role="menuitem">
                                <i class="fa-solid fa-user" style="margin-right: 8px;"></i> Tài khoản
                            </x-dropdown-link>
                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();" role="menuitem">
                                    <i class="fa-solid fa-right-from-bracket" style="margin-right: 8px;"></i> Đăng xuất
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                </div>

                <!-- Cart -->
                <a href="{{ route('cart.index') }}" class="header_cart-btn" aria-label="Giỏ hàng">
                    <i class="fa-solid fa-bag-shopping"></i>
                    <span>Giỏ hàng</span>
                </a>
            @else
                <a class="header_auth-btn" href="{{ route('login') }}">
                    <i class="fa-solid fa-right-to-bracket"></i> Đăng nhập
                </a>
                <a class="header_auth-btn header_auth-btn--register" href="{{ route('register') }}">
                    <i class="fa-solid fa-user-plus"></i> Đăng ký
                </a>
                <a href="{{ route('login') }}" class="header_cart-btn" aria-label="Giỏ hàng">
                    <i class="fa-solid fa-bag-shopping"></i>
                </a>
            @endauth
        </div>

        <!-- Mobile menu toggle -->
        <button class="header_mobile-toggle" id="mobileToggle" aria-label="Mở menu">
            <span></span><span></span><span></span>
        </button>
    </nav>
</header>

<style>
    /* ============ TOP BAR ============ */
    .header {
        background-color: white;
        position: sticky;
        top: 0;
        z-index: 1000;
        transition: box-shadow 0.3s ease;
    }

    .header.scrolled {
        box-shadow: 0 2px 20px rgba(0, 0, 0, 0.08);
    }

    .header_intro {
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        padding: 0;
    }

    .header_intro-inner {
        max-width: 1280px;
        margin: 0 auto;
        padding: 8px 24px;
        display: flex;
        justify-content: space-between;
        align-items: center;
        font-size: 0.82rem;
        color: rgba(255, 255, 255, 0.9);
    }

    .header_intro-slogan {
        font-weight: 500;
        letter-spacing: 0.3px;
    }

    .header_intro-slogan i {
        color: #D4A76A;
        margin-right: 6px;
    }

    .header_intro-contact {
        display: flex;
        align-items: center;
        gap: 4px;
    }

    .header_intro-item {
        font-weight: 500;
    }

    .header_intro-item i {
        color: #D4A76A;
        margin-right: 4px;
    }

    .header_intro-divider {
        color: rgba(255, 255, 255, 0.3);
        margin: 0 8px;
    }

    /* ============ NAVBAR ============ */
    .header_navbar {
        display: flex;
        align-items: center;
        justify-content: space-between;
        padding: 12px 40px;
        max-width: 1360px;
        margin: 0 auto;
        background-color: white;
        position: relative;
    }

    .header_navbar-logo img {
        height: 70px;
        width: auto;
        transition: transform 0.3s ease;
    }

    .header_navbar-logo:hover img {
        transform: scale(1.05);
    }

    /* ============ NAV LINKS ============ */
    .header_navbar-list {
        display: flex;
        list-style: none;
        gap: 8px;
        margin: 0;
        padding: 0;
    }

    .header_navbar-item {
        position: relative;
    }

    .header_navbar-item > a {
        text-decoration: none;
        color: #1B2A4A;
        font-weight: 500;
        font-size: 0.92rem;
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        border-radius: 8px;
        transition: all 0.25s ease;
        position: relative;
        letter-spacing: 0.2px;
    }

    .header_navbar-item > a i:first-child {
        font-size: 0.85rem;
        color: #C8956C;
    }

    .header_navbar-item > a:hover {
        color: #C8956C;
        background: rgba(200, 149, 108, 0.08);
    }

    .dropdown-icon-chevron {
        font-size: 0.65rem !important;
        color: #9CA3AF !important;
        transition: transform 0.3s ease;
    }

    .header_navbar-dropdown:hover .dropdown-icon-chevron {
        transform: rotate(180deg);
    }

    /* ============ DROPDOWN SUBMENU ============ */
    .header_navbar-submenu {
        display: none;
        position: absolute;
        top: calc(100% + 8px);
        left: 0;
        background: white;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        list-style: none;
        padding: 8px;
        min-width: 200px;
        z-index: 1000;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        animation: fadeInDown 0.2s ease;
    }

    @keyframes fadeInDown {
        from {
            opacity: 0;
            transform: translateY(-8px);
        }
        to {
            opacity: 1;
            transform: translateY(0);
        }
    }

    .header_navbar-submenu li a {
        display: block;
        padding: 10px 16px;
        color: #374151;
        text-decoration: none;
        font-weight: 400;
        font-size: 0.9rem;
        border-radius: 8px;
        transition: all 0.2s ease;
    }

    .header_navbar-submenu li a:hover {
        color: #C8956C;
        background: rgba(200, 149, 108, 0.08);
        padding-left: 20px;
    }

    /* ============ NAV BUTTONS ============ */
    .header_navbar-btn {
        display: flex;
        align-items: center;
        gap: 8px;
    }

    .header_navbar-btn-item {
        position: relative;
        cursor: pointer;
        padding: 8px;
        border-radius: 8px;
        transition: all 0.2s ease;
        color: #374151;
    }

    .header_navbar-btn-item:hover {
        background: rgba(200, 149, 108, 0.08);
        color: #C8956C;
    }

    .header_navbar-btn-item i {
        font-size: 1.1rem;
    }

    /* Search box */
    .header_navbar-search {
        position: absolute;
        top: calc(100% + 8px);
        right: 0;
        background: white;
        padding: 8px;
        border: 1px solid #E5E7EB;
        border-radius: 12px;
        display: none;
        z-index: 999;
        box-shadow: 0 10px 40px rgba(0, 0, 0, 0.1);
        animation: fadeInDown 0.2s ease;
    }

    .search-input-wrapper {
        display: flex;
        align-items: center;
        gap: 8px;
        padding: 4px 12px;
        background: #F9FAFB;
        border-radius: 8px;
        border: 1.5px solid #E5E7EB;
        transition: border-color 0.2s;
    }

    .search-input-wrapper:focus-within {
        border-color: #C8956C;
    }

    .search-icon {
        color: #9CA3AF;
        font-size: 0.85rem;
    }

    .header_navbar-search input {
        width: 220px;
        padding: 8px 4px;
        font-size: 0.9rem;
        border: none;
        outline: none;
        background: transparent;
        font-family: 'Inter', sans-serif;
    }

    /* Notification badge */
    .notification-icon {
        position: relative;
    }

    .notification-icon a {
        color: inherit;
        text-decoration: none;
    }

    .notification-count {
        position: absolute;
        top: 2px;
        right: 2px;
        background: linear-gradient(135deg, #EF4444, #DC2626);
        color: white;
        font-size: 0.68rem;
        font-weight: 700;
        padding: 2px 6px;
        border-radius: 20px;
        line-height: 1;
        min-width: 18px;
        text-align: center;
        animation: pulse 2s infinite;
    }

    @keyframes pulse {
        0%, 100% { transform: scale(1); }
        50% { transform: scale(1.1); }
    }

    /* User avatar */
    .user-trigger-btn {
        display: flex;
        align-items: center;
        gap: 8px;
        background: none;
        border: none;
        cursor: pointer;
        font-family: 'Inter', sans-serif;
        font-size: 0.9rem;
        font-weight: 500;
        color: #374151;
        padding: 4px 8px;
        border-radius: 8px;
        transition: all 0.2s;
    }

    .user-trigger-btn:hover {
        background: rgba(200, 149, 108, 0.08);
        color: #C8956C;
    }

    .user-avatar {
        display: flex;
        align-items: center;
        justify-content: center;
        width: 32px;
        height: 32px;
        border-radius: 50%;
        background: linear-gradient(135deg, #C8956C, #A67548);
        color: white;
        font-weight: 700;
        font-size: 0.8rem;
    }

    /* Cart button */
    .header_cart-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 18px;
        background: linear-gradient(135deg, #C8956C, #A67548);
        color: white;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 600;
        font-size: 0.88rem;
        transition: all 0.3s ease;
    }

    .header_cart-btn:hover {
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(200, 149, 108, 0.4);
        color: white;
    }

    /* Auth buttons */
    .header_auth-btn {
        display: inline-flex;
        align-items: center;
        gap: 6px;
        padding: 8px 16px;
        text-decoration: none;
        border-radius: 8px;
        font-weight: 500;
        font-size: 0.88rem;
        color: #374151;
        transition: all 0.2s ease;
    }

    .header_auth-btn:hover {
        background: rgba(200, 149, 108, 0.08);
        color: #C8956C;
    }

    .header_auth-btn--register {
        background: linear-gradient(135deg, #1B2A4A, #2D4A7A);
        color: white;
    }

    .header_auth-btn--register:hover {
        background: linear-gradient(135deg, #2D4A7A, #3B5998);
        color: white;
        transform: translateY(-2px);
        box-shadow: 0 4px 15px rgba(27, 42, 74, 0.3);
    }

    /* Mobile toggle */
    .header_mobile-toggle {
        display: none;
        flex-direction: column;
        gap: 5px;
        background: none;
        border: none;
        cursor: pointer;
        padding: 8px;
    }

    .header_mobile-toggle span {
        display: block;
        width: 24px;
        height: 2px;
        background: #1B2A4A;
        border-radius: 2px;
        transition: all 0.3s ease;
    }

    /* ============ RESPONSIVE ============ */
    @media (max-width: 1024px) {
        .header_navbar {
            padding: 12px 20px;
        }

        .header_navbar-list {
            gap: 4px;
        }

        .header_navbar-item > a {
            padding: 8px 10px;
            font-size: 0.85rem;
        }
    }

    @media (max-width: 768px) {
        .header_intro-inner {
            flex-direction: column;
            gap: 4px;
            padding: 6px 16px;
            text-align: center;
        }

        .header_mobile-toggle {
            display: flex;
        }

        .header_navbar-list {
            display: none;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            flex-direction: column;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
            border-top: 1px solid #E5E7EB;
            gap: 0;
        }

        .header_navbar-list.active {
            display: flex;
        }

        .header_navbar-item > a {
            padding: 12px 16px;
            width: 100%;
        }

        .header_navbar-submenu {
            position: static;
            box-shadow: none;
            border: none;
            padding-left: 16px;
        }

        .header_navbar-btn {
            display: none;
        }

        .header_navbar-btn.active {
            display: flex;
            flex-wrap: wrap;
            position: absolute;
            top: 100%;
            left: 0;
            right: 0;
            background: white;
            padding: 16px;
            box-shadow: 0 10px 30px rgba(0, 0, 0, 0.1);
        }
    }
</style>

<script>
    // Sticky header shadow
    window.addEventListener('scroll', function() {
        const header = document.getElementById('mainHeader');
        if (window.scrollY > 10) {
            header.classList.add('scrolled');
        } else {
            header.classList.remove('scrolled');
        }
    });

    // Search toggle
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

    // Dropdown toggle
    document.querySelectorAll('.dropdown-icon-chevron').forEach(icon => {
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

    // Hover dropdown for desktop
    document.querySelectorAll('.header_navbar-dropdown').forEach(item => {
        item.addEventListener('mouseenter', function() {
            if (window.innerWidth > 768) {
                const submenu = this.querySelector('.header_navbar-submenu');
                if (submenu) submenu.style.display = 'block';
            }
        });
        item.addEventListener('mouseleave', function() {
            if (window.innerWidth > 768) {
                const submenu = this.querySelector('.header_navbar-submenu');
                if (submenu) submenu.style.display = 'none';
            }
        });
    });

    document.addEventListener('click', function () {
        document.querySelectorAll('.header_navbar-submenu').forEach(menu => {
            menu.style.display = 'none';
        });
    });

    // Mobile toggle
    const mobileToggle = document.getElementById('mobileToggle');
    if (mobileToggle) {
        mobileToggle.addEventListener('click', function() {
            const navList = document.querySelector('.header_navbar-list');
            navList.classList.toggle('active');
        });
    }
</script>

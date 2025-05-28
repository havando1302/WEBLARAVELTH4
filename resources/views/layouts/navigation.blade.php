<style>
/* CSS cho navigation.blade.php */

/* Reset cơ bản */
* {
    box-sizing: border-box;
    margin: 0;
    padding: 0;
}

/* Navbar nền trắng, border dưới */
nav {
    background-color: #ffffff;
    border-bottom: 1px solid #e5e7eb; /* gray-100 */
    font-family: 'Segoe UI', Tahoma, Geneva, Verdana, sans-serif;
}

/* Container trong nav */
nav > div.max-w-7xl {
    max-width: 1120px;
    margin: 0 auto;
    padding: 0 1rem;
}

/* Flex căn giữa, giữa trục dọc */
nav .flex {
    display: flex;
    justify-content: space-between;
    align-items: center;
    height: 4rem; /* 64px */
}

/* Logo */
nav .flex > div:first-child .text-2xl {
    font-weight: 700;
    color: #111827; /* gray-900 */
    letter-spacing: 0.05em;
    cursor: default;
    user-select: none;
}

/* Menu chính (desktop) */
nav .menu-links {
    display: flex;
    gap: 25px;
    align-items: center;
}

/* Xác định link trong nav */
nav x-nav-link {
    font-weight: 600;
    color: #4b5563; /* gray-600 */
    text-decoration: none;
    padding: 0.375rem 0.75rem;
    border-radius: 0.375rem; /* 6px */
    transition: background-color 0.3s ease, color 0.3s ease;
    cursor: pointer;
    display: inline-flex;
    align-items: center;
    font-size: 1rem;
}

/* Link active */
nav x-nav-link[active="true"],
nav x-nav-link:hover {
    background-color: #2563eb; /* blue-600 */
    color: white;
}

/* Địa chỉ & số điện thoại */
nav .text-sm.text-gray-500 {
    color: #6b7280; /* gray-500 */
    font-size: 0.875rem;
    margin-left: 2rem;
    white-space: nowrap;
}

/* Khu vực tài khoản (dropdown) */
nav .account-area {
    display: flex;
    align-items: center;
    gap: 1.5rem;
    margin-left: auto;
}

/* Nút thông báo */
nav .account-area .notification {
    position: relative;
    font-size: 1.25rem;
    color: #4b5563;
    transition: color 0.3s ease;
    cursor: pointer;
}

nav .account-area .notification:hover {
    color: #111827;
}

/* Badge số thông báo */
nav .account-area .notification span {
    position: absolute;
    top: -4px;
    right: -8px;
    background-color: #ef4444; /* red-500 */
    color: white;
    font-size: 0.65rem;
    padding: 0 5px;
    border-radius: 9999px;
    font-weight: 700;
    line-height: 1rem;
}

/* Dropdown trigger button */
nav x-dropdown button {
    display: inline-flex;
    align-items: center;
    padding: 0.375rem 0.75rem;
    border: 1px solid transparent;
    font-size: 0.875rem;
    font-weight: 500;
    border-radius: 0.375rem;
    background-color: #ffffff;
    color: #4b5563;
    cursor: pointer;
    transition: color 0.3s ease, background-color 0.3s ease;
}

nav x-dropdown button:hover {
    color: #111827;
}

/* Dropdown icon */
nav x-dropdown svg {
    margin-left: 0.25rem;
    width: 1rem;
    height: 1rem;
    fill: currentColor;
}

/* Dropdown content */
x-dropdown-link {
    display: block;
    padding: 0.5rem 1rem;
    color: #4b5563;
    text-decoration: none;
    font-size: 0.875rem;
    transition: background-color 0.3s ease;
}

x-dropdown-link:hover {
    background-color: #f3f4f6; /* gray-100 */
    color: #111827;
}

/* Form nút logout */
form > x-dropdown-link {
    cursor: pointer;
}

/* Các link khi chưa đăng nhập */
nav .flex.space-x-6 > x-nav-link {
    font-weight: 600;
    color: #2563eb; /* blue-600 */
    text-decoration: none;
    font-size: 1rem;
}

nav .flex.space-x-6 > x-nav-link:hover {
    text-decoration: underline;
}

/* Ẩn nút menu mobile hoàn toàn */
nav .mobile-menu-button {
    display: none !important;
}
</style>

<nav x-data="{ open: false }" class="bg-white border-b border-gray-100">
    <div class="max-w-7xl mx-auto px-4 sm:px-6 lg:px-8">
        <div class="flex justify-between h-16 items-center">

            <!-- Logo + Menu links -->
            <div class="flex items-center space-x-8">
                <!-- Logo -->
                <div class="text-2xl font-bold text-gray-900">DOHAFANSHION</div>

                <!-- Menu chính -->
                <div class="menu-links">
                    @auth
                        @if(auth()->user()->is_admin)
                            <x-nav-link :href="route('admin.dashboard')" :active="request()->routeIs('admin.dashboard')">
                                {{ __('Trang chủ') }}
                            </x-nav-link>

                            <x-nav-link :href="route('admin.products.index')" :active="request()->routeIs('admin.products.*')">
                                {{ __('Sản phẩm') }}
                            </x-nav-link>
                        @else
                            <x-nav-link :href="route('home')" :active="request()->routeIs('home')">
                                {{ __('Trang chủ') }}
                            </x-nav-link>

                            <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                                {{ __('Sản phẩm') }}
                            </x-nav-link>

                            <x-nav-link :href="route('cart.index')" :active="request()->routeIs('cart.index')">
                                🛒 {{ __('Giỏ hàng') }}
                            </x-nav-link>
                        @endif
                    @else
                        <x-nav-link :href="route('products.indexPublic')" :active="request()->routeIs('products.indexPublic')">
                            {{ __('Trang chủ') }}
                        </x-nav-link>

                        <x-nav-link :href="route('products.index')" :active="request()->routeIs('products.index')">
                            {{ __('Sản phẩm') }}
                        </x-nav-link>

                        <x-nav-link :href="route('login')">
                            🛒 {{ __('Giỏ hàng') }}
                        </x-nav-link>
                    @endauth
                </div>
            </div>

            <!-- Địa chỉ & SĐT -->
            <div class="hidden sm:flex text-sm text-gray-500">
                15A Đô Lương, Nghệ An | 0987 654 321
            </div>

            <!-- Tài khoản đẩy sát cuối -->
            <div class="account-area hidden sm:flex sm:items-center">
                @auth
                    <!-- Nút thông báo -->
                    <div class="notification">
                        <a href="{{ route('notifications.index') }}" class="text-gray-600 hover:text-gray-800" title="Thông báo">
                            🔔
                            @php $unreadCount = auth()->user()->unreadNotifications->count(); @endphp
                            @if($unreadCount > 0)
                                <span>
                                    {{ $unreadCount }}
                                </span>
                            @endif
                        </a>
                    </div>

                    <!-- Dropdown người dùng -->
                    <x-dropdown align="right" width="48">
                        <x-slot name="trigger">
                            <button class="inline-flex items-center px-3 py-2 border border-transparent text-sm leading-4 font-medium rounded-md text-gray-600 bg-white hover:text-gray-800 focus:outline-none transition">
                                <div>{{ Auth::user()->name }}</div>
                                <div class="ms-1">
                                    <svg class="fill-current h-4 w-4" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 20 20">
                                        <path fill-rule="evenodd" d="M5.293 7.293a1 1 0 011.414 0L10 10.586l3.293-3.293a1 1 0 111.414 1.414l-4 4a1 1 0 01-1.414 0l-4-4a1 1 0 010-1.414z" clip-rule="evenodd" />
                                    </svg>
                                </div>
                            </button>
                        </x-slot>

                        <x-slot name="content">
                            <x-dropdown-link :href="route('profile.edit')">
                                {{ __('Tài khoản') }}
                            </x-dropdown-link>

                            <form method="POST" action="{{ route('logout') }}">
                                @csrf
                                <x-dropdown-link href="#" onclick="event.preventDefault(); this.closest('form').submit();">
                                    {{ __('Đăng xuất') }}
                                </x-dropdown-link>
                            </form>
                        </x-slot>
                    </x-dropdown>
                @else
                    <div class="flex space-x-6">
                        <x-nav-link :href="route('login')" :active="request()->routeIs('login')">
                            {{ __('Đăng nhập') }}
                        </x-nav-link>
                        <x-nav-link :href="route('register')" :active="request()->routeIs('register')">
                            {{ __('Đăng ký') }}
                        </x-nav-link>
                    </div>
                @endauth
            </div>

            <!-- Bỏ phần mobile menu button hoàn toàn -->
        </div>
    </div>
</nav>

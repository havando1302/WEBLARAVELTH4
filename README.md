# DOHAFANSHION- Laravel Project

> Website bán đồ thời trang được xây dựng bằng Laravel.

## 🌟 Giới thiệu

Đây là một website bán đồ thời trang bao gồm giao diện người dùng (User) và quản trị viên (Admin). Người dùng có thể duyệt sản phẩm, xem chi tiết và thêm vào giỏ hàng. Quản trị viên có thể quản lý sản phẩm, đơn hàng và người dùng.

## 🚀 Tính năng

### Người dùng (User)
- Xem danh sách sản phẩm thời trang
- Xem chi tiết sản phẩm
- Tìm kiếm sản phẩm
- Lọc sản phẩm theo danh mục
- Thêm sản phẩm vào giỏ hàng
- Đặt hàng (Checkout)
- Đăng ký / Đăng nhập

### Quản trị viên (Admin)
- Đăng nhập trang quản trị
- Quản lý sản phẩm (Thêm / Sửa / Xóa)
- Quản lý đơn hàng
- Quản lý người dùng
- Quản lý danh mục sản phẩm
- Quản lý ảnh sản phẩm

## ⚙️ Công nghệ sử dụng

- [Laravel 10.x](https://laravel.com/)
- PHP 8.x
- MySQL / MariaDB
- Blade Template
- Bootstrap / Tailwind CSS (tùy chọn)
- Laravel Breeze hoặc Jetstream (xác thực)

## 🛠️ Cài đặt

### Yêu cầu hệ thống
- PHP >= 8.1
- Composer
- MySQL hoặc MariaDB
- Node.js & npm (nếu dùng frontend asset compile)

### Bước cài đặt

```bash
# Clone repository
git clone https://github.com/your-username/fashion-store.git
cd fashion-store

# Cài đặt các thư viện PHP
composer install

# Cài đặt các gói frontend (nếu dùng)
npm install && npm run dev

# Tạo file môi trường
cp .env.example .env

# Thiết lập thông tin kết nối database trong file .env

# Generate application key
php artisan key:generate

# Tạo bảng trong database
php artisan migrate --seed

# Chạy ứng dụng
php artisan serve

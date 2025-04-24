📚 BookStore - Trang Web Bán Sách Online 

BookStore là một trang web thương mại điện tử giúp người dùng dễ dàng tìm kiếm, mua và đánh giá các loại sách. Website được phát triển bằng Laravel - Framework PHP mạnh mẽ, bảo mật và dễ mở rộng.

🚀 Tính Năng Chính

Tìm kiếm sách theo tên, tác giả, thể loại

Xem chi tiết sách, đánh giá và bình luận sách

Thêm sách vào giỏ hàng, đặt hàng và thanh toán

Đăng ký, đăng nhập, quản lý thông tin cá nhân

Quản lý sách, đơn hàng và người dùng (dành cho Admin)

Giao diện thân thiện, hiển thị tốt trên cả desktop và mobile

🛠️ Công Nghệ Sử Dụng

Framework: Laravel 10.x (PHP 8.x)

Database: MySQL / MariaDB

Frontend: Blade Template, Bootstrap 5, jQuery

Authentication: Laravel Breeze / Laravel Jetstream

Quản lý gói: Composer, npm

🎬 Hướng Dẫn Cài Đặt

Clone dự án về máy:

bash

Copier

git clone https://github.com/yourusername/bookstore-laravel.git

cd bookstore-laravel

Cài đặt các package bằng Composer:

bash

Copier

composer install

Cài đặt frontend dependencies:

bash

Copier

npm install && npm run dev

Tạo file cấu hình môi trường:

bash

Copier

cp .env.example .env

Sau đó chỉnh sửa thông tin kết nối database trong file .env:


Copier

DB_DATABASE=ten_database

DB_USERNAME=ten_user

DB_PASSWORD=mat_khau

Sinh key ứng dụng:

bash

Copier

php artisan key:generate

Chạy migrate và seed dữ liệu mẫu (nếu có):

bash

Copier

php artisan migrate --seed

Khởi động server:

bash

Copier

php artisan serve

Truy cập tại: http://localhost:8000

📷 Demo

<img src="demo-screenshot.png" alt="Demo giao diện BookStore" width="600">

💡 Một Số Tài Khoản Mẫu

Admin:

Email: admin@example.com

Mật khẩu: password

Khách hàng:

Email: user@example.com

Mật khẩu: password

📄 License

Dự án phục vụ mục đích học tập và phi lợi nhuận. Vui lòng xem chi tiết trong file LICENSE.

✨ Đóng Góp

Mọi ý kiến đóng góp, sửa lỗi hoặc tính năng mới đều rất hoan nghênh. Vui lòng mở Issues hoặc Pull Request để cùng phát triển dự án.


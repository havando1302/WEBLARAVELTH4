
# 👗 WEB BÁN THỜI TRANG - DOHAFASHION

## 👤 Sinh Viên Thực Hiện
- **Họ và tên:** Hà Văn Đô  
- **Mã sinh viên:** 23010406  
- **Lớp:** Thiết kế web nâng cao - 1-3-24 (COUR01.TH4)
- **Link github:** [Link github](https://github.com/havando1302/WEBLARAVELTH4)
- **Link Demo:** 
---

## 📄 Mô Tả Dự Án

**DOHAFASHION** là một nền tảng thương mại điện tử được phát triển bằng framework **Laravel**, nhằm cung cấp trải nghiệm mua sắm thời trang trực tuyến hiện đại và tiện lợi.

Trang web cho phép người dùng:
- Tìm kiếm, lọc và đặt mua các sản phẩm như: quần áo, giày dép, phụ kiện,...
- Chọn theo nhiều tiêu chí như **danh mục**, **màu sắc**, **kích thước**,...
- Quản lý đơn hàng, xem giỏ hàng và theo dõi trạng thái giao hàng.

Hệ thống hỗ trợ **phân quyền người dùng**, bao gồm:
- **Admin**: quản lý toàn bộ dữ liệu hệ thống.
- **Khách hàng**: đăng ký, đăng nhập và trải nghiệm mua sắm.

Trang web có **giao diện thân thiện**, hình ảnh sản phẩm **đẹp mắt**, bố cục rõ ràng, đồng thời hỗ trợ quản trị viên cập nhật sản phẩm, theo dõi đơn hàng và quản lý kho hiệu quả.

---

## 👥 Đối Tượng Sử Dụng
- **Người dùng (User)**: mua hàng, theo dõi đơn hàng, chỉnh sửa thông tin cá nhân.
- **Quản trị viên (Admin)**: quản lý sản phẩm, danh mục, đơn hàng, liên hệ.

---

## 🛠️ Công Nghệ Sử Dụng

- **Ngôn ngữ lập trình:**
  - HTML
  - CSS
  - JavaScript
  - PHP (Laravel Framework)
  - Blade Template Engine

- **Cơ sở dữ liệu:**
  - MySQL

---
## Yêu cầu Security 
# 1.CSRF
php
```
<form action="{{ route('cart.remove', $item->id) }}" method="POST" onsubmit="return confirm('Bạn có chắc muốn xóa sản phẩm này?')">
  @csrf
@method('DELETE')
<button type="submit" class="text-red-600 hover:text-red-800 font-medium">Xóa</button>
 </form>
```
# 2. XSS 
php
```
 <div class="ml-4 text-sm font-medium text-gray-900">
   {{ $item->product->name ?? 'Sản phẩm không có tên' }}
</div>
```
## 🔑 Các Chức Năng Chính

### 📦 Chức năng cho người dùng:
- 🔍 Xem danh sách sản phẩm
- 🔎 Tìm kiếm và lọc theo danh mục, màu sắc, kích thước
- 🛒 Thêm sản phẩm vào giỏ hàng
- 💳 Thanh toán và tạo đơn hàng
- 👤 Đăng ký / Đăng nhập
- 📦 Theo dõi đơn hàng đã đặt

### 🛠️ Chức năng cho quản trị viên:
- ✅ Quản lý sản phẩm (Thêm / Sửa / Xóa)
- 📁 Quản lý danh mục sản phẩm
- 📦 Quản lý đơn hàng (Cập nhật trạng thái, xem chi tiết)
- 📊 Quản lý tồn kho sản phẩm

---
## Sơ đồ UML && cơ sở dữ liệu
- Sơ đồ cơ sở dữ liệu
  
  ![c04817ea-8195-4c3c-bc18-b8060b5101d9](https://github.com/user-attachments/assets/7b9eb300-0a2b-451b-9a32-f3f8a80ef486)
## UML & lưu đồ dự án
- Lưu đồ thêm sản phẩm

  ![themsanpham](https://github.com/user-attachments/assets/5b744b09-1cd7-46e9-bd70-c850d6c867a4)
- Lưu đồ sửa sản phẩm

  ![suasanpham](https://github.com/user-attachments/assets/8f440e35-2180-4148-8714-f64d0f8fd9d6)
- Lưu đồ xóa sản phẩm

  ![xoa](https://github.com/user-attachments/assets/9fe9c7cc-e038-447c-8756-cef7ff8ac3ab)
- Checkout làm việc với giỏ hàng

  ![checkuot](https://github.com/user-attachments/assets/22492071-ce93-4af0-b5d1-801ddfba04d9)

- lưu đồ giỏ hàng & thanh toán
  
![z6690930366255_c301dd2bfd56f00487f65ff91d983219](https://github.com/user-attachments/assets/b1fa4125-e771-42e0-9360-f5db3f83da05)
- lưu đồ quản trị viên(admin)

![z6690991897745_3890bec6ec4416941441c60ae693a6b1](https://github.com/user-attachments/assets/83c91ebe-a079-44ca-827a-6710426c6c76)
- lưu đồ đăng nhập tài khoản

  ![Screenshot 2025-06-18 163013](https://github.com/user-attachments/assets/21f85634-bf52-4ab5-8120-7884f1e2d5b1)

## Giao diện web
### Giao diện user
-Trang chủ:

![Trangchuuser](https://github.com/user-attachments/assets/9f8754f0-f7a4-4d1c-b10a-5e0e7f00c09f)
-Product:

![productuser](https://github.com/user-attachments/assets/741712bd-5344-45ca-bae0-32d4e63d6fac)
-Giới thiệu:

![gioithieu](https://github.com/user-attachments/assets/cd07cb48-8fc4-455c-8c5a-0d6eacf33da2)
- Liên hệ:

![lienhe](https://github.com/user-attachments/assets/de387cf1-bb7a-4a59-9ca3-95da95df98e2)
-Giỏ hàng:

![giỏ hàng](https://github.com/user-attachments/assets/cc20b5d1-d3e7-4d60-8afa-b2df739c0988)
### Giao diện ADMIN
- Trang chủ:
  
  ![admin](https://github.com/user-attachments/assets/123613c4-0f69-4bc6-ab42-addf4da15608)
- Quản lý sản phẩm:
  
  ![sanpham](https://github.com/user-attachments/assets/e34c950c-3014-4ec5-854c-4a40d5e5ec14)
- Quản lý danh mục sản phẩm:
  
  ![danhmuc](https://github.com/user-attachments/assets/e51c1a36-53fc-42cd-a169-475ef6ad0211)
- Quản lý đơn hàng:

  ![donhang](https://github.com/user-attachments/assets/d64ae7c9-9fc2-49db-a57d-9f6bd6ccf1c6)
  
## 🔍 Phân Tích Một Số Code Chính

### 📂 `app/Http/Controllers/CartController.php`
Controllers này xử lý logic cho khu vực giỏ hàng đã đăng nhập
#### `index()`: xử lý giỏ hàng
#### Mô tả:
- Kiểm tra đăng nhập: Nếu chưa đăng nhập → chuyển hướng đến trang login.
- Lấy giỏ hàng: Lấy các mục trong giỏ hàng của người dùng, kèm thông tin sản phẩm, màu, size, biến thể.
- Đơn hàng: Lấy tất cả đơn hàng của người dùng kèm sản phẩm trong đơn.
#### Trả về view:
- Gửi dữ liệu sang view `cart.blade.php` để hiển thị.

```php
 public function index()
    {

        if (!Auth::check()) {
            return redirect()->route('login')->with('error', 'Vui lòng đăng nhập để xem giỏ hàng.');
        }

        $userId = Auth::id();
        $cartItems = Cart::with(['product', 'color', 'size', 'productVariant'])
            ->where('user_id', $userId)
            ->get();
        $popularProducts = Product::latest()->take(6)->get();

        $orders = Order::where('user_id', $userId)->with('items.product')->get();

        return view('cart', compact('cartItems', 'popularProducts', 'orders'));
    }
```
### 📂 `app/Models/Cart.php`
Model này đại diện cho bảng giỏ hàng (cart) trong cơ sở dữ liệu, dùng để lưu thông tin các sản phẩm mà người dùng đã thêm vào giỏ hàng.
### 🔧 `$fillable`: Khai báo các trường được phép gán dữ liệu hàng loạt
- Cho phép Laravel gán dữ liệu tự động vào các cột trên khi tạo hoặc cập nhật giỏ hàng.
```php
protected $fillable = [
    'user_id',
    'product_id',
    'product_variant_id',
    'quantity',
    'color_id',
    'size_id',
];
```
### Các mối quan hệ
- `product()`: Liên kết đến sản phẩm
```php
public function product()
{
    return $this->belongsTo(Product::class);
}
```
- `productVariant()`:  Liên kết đến biến thể sản phẩm
```php
public function productVariant()
{
    return $this->belongsTo(ProductVariant::class, 'product_variant_id');
}
```
- `size()`:Liên kết đến kích thước sản phẩm
```php
public function size()
{
    return $this->belongsTo(Size::class, 'size_id');
}
```
- `color()`: Liên kết đến màu sắc sản phẩm
```php
public function color()
{
    return $this->belongsTo(Color::class, 'color_id');
}
```
## 🔧 Hướng Dẫn Cài Đặt Nhanh


# 1. Clone dự án
```bash
git clone [repository-url]
```
# 2. Cài đặt các gói phụ thuộc
```bash
composer install
npm install
```
# 3. Cấu hình môi trường
```bash
cp .env.example .env
php artisan key:generate
```
# 4. Cập nhật thông tin cơ sở dữ liệu trong file .env
 Khi chạy database cần sửa lại cổng DB_PORT phù hợp với cấu hình máy 
```bash
DB_CONNECTION=mysql
DB_HOST=127.0.0.1
DB_PORT=3366
DB_DATABASE=project_c_db
DB_USERNAME=root
DB_PASSWORD=
```
# 5. Tạo cấu trúc bảng và dữ liệu mẫu
```bash
php artisan migrate --seed
```
# 6. Biên dịch frontend
```bash
npm run build
```
# 7. Khởi động server
```bash
php artisan serve
```
Ứng dụng sẽ chạy tại: `http://127.0.0.1:8000`

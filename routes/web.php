<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;

// Route public cho trang chủ, có tên products.indexPublic (giữ liên kết cũ)
Route::get('/', [ProductController::class, 'index'])->name('products.indexPublic');

// Các route public (không yêu cầu đăng nhập)
// Chỉ định nghĩa index và show cho products public/user
Route::resource('products', ProductController::class)->only(['index', 'show']);

// Các route yêu cầu đăng nhập
Route::middleware('auth')->group(function () {

    // Thông báo
    Route::get('/notifications', [NotificationController::class, 'index'])->name('notifications.index');
    Route::patch('/notifications/{id}/read', function ($id) {
        $notification = auth()->user()->notifications()->findOrFail($id);
        $notification->markAsRead();
        return redirect()->route('notifications.index');
    })->name('notifications.markAsRead');

    // Giỏ hàng
    Route::post('/cart/add/{product}', [CartController::class, 'add'])->name('cart.add');
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
    Route::delete('/cart/remove/{productId}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

    // Thanh toán
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.index');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [CheckoutController::class, 'success'])->name('checkout.success');

    // Route dành cho user đã đăng nhập (non-admin)
    Route::get('/home', [HomeController::class, 'userHome'])->name('home');

    // Nhóm route dành riêng cho admin
    Route::prefix('admin')->middleware('admin')->name('admin.')->group(function () {
        Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

        // Định nghĩa đầy đủ resource route cho products của admin
        Route::resource('products', ProductController::class);

        // Resource route cho orders của admin
        Route::resource('orders', OrderController::class);
    });
});

// Các route xác thực (login, register, v.v...)
require __DIR__.'/auth.php';

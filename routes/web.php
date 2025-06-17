<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\CheckoutController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\NotificationController;
use App\Http\Controllers\Admin\CategoryController;

/*
|--------------------------------------------------------------------------
| Public Routes - Không cần đăng nhập
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'userHome'])->name('home');
Route::resource('products', ProductController::class)->only(['index', 'show']);
Route::view('/introduce', 'introduce')->name('introduce');
Route::view('/contact', 'contact')->name('contact.index');


/*
|--------------------------------------------------------------------------
| Routes yêu cầu đăng nhập
|--------------------------------------------------------------------------
*/
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
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
    Route::post('/cart/update/{productId}', [CartController::class, 'update'])->name('cart.update');

    // Đặt hàng
    Route::get('/checkout', [CheckoutController::class, 'index'])->name('checkout.form');
    Route::post('/checkout', [OrderController::class, 'checkout'])->name('checkout');
    Route::get('/checkout/success', [OrderController::class, 'success'])->name('checkout.success');

    // Hủy đơn hàng
    Route::patch('/orders/{order}/cancel', [OrderController::class, 'cancel'])->name('orders.cancel');

    /*
    |--------------------------------------------------------------------------
    | Admin Routes (Yêu cầu đăng nhập và có role admin)
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->middleware(['auth', 'admin'])
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');
            Route::resource('products', ProductController::class);
            Route::resource('categories', CategoryController::class);
            Route::resource('orders', OrderController::class);
        });
});

/*
|--------------------------------------------------------------------------
| Authentication Routes
|--------------------------------------------------------------------------
*/
require __DIR__.'/auth.php';
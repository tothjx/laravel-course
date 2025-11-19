<?php

use App\Http\Controllers\Admin\AdminController;
use App\Http\Controllers\Admin\AuthController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\OrderController;
use App\Http\Controllers\ShopController;
use Illuminate\Support\Facades\Route;

// Public routes
Route::get('/', [ShopController::class, 'index'])->name('shop.index');
Route::get('/category/{slug}', [ShopController::class, 'category'])->name('shop.category');

Route::get('/cart', [CartController::class, 'index'])->name('cart.index');
Route::post('/cart/add/{id}', [CartController::class, 'add'])->name('cart.add');
Route::post('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');

Route::get('/checkout', [OrderController::class, 'checkout'])->name('order.checkout');
Route::post('/order', [OrderController::class, 'store'])->name('order.store');
Route::get('/order/success/{id}', [OrderController::class, 'success'])->name('order.success');

// Admin authentication routes
Route::get('/admin/login', [AuthController::class, 'showLogin'])->name('admin.login');
Route::post('/admin/login', [AuthController::class, 'login']);
Route::post('/admin/logout', [AuthController::class, 'logout'])->name('admin.logout');

// Admin protected routes
Route::middleware('auth')->prefix('admin')->name('admin.')->group(function () {
    Route::get('/dashboard', [AdminController::class, 'dashboard'])->name('dashboard');

    Route::get('/profile', [AdminController::class, 'profile'])->name('profile');
    Route::put('/profile', [AdminController::class, 'updateProfile'])->name('profile.update');

    Route::get('/password', [AdminController::class, 'password'])->name('password');
    Route::put('/password', [AdminController::class, 'updatePassword'])->name('password.update');

    Route::get('/notifications', [AdminController::class, 'notifications'])->name('notifications');
    Route::post('/notifications/{id}/read', [AdminController::class, 'markNotificationRead'])->name('notifications.read');

    Route::get('/orders', [AdminController::class, 'orders'])->name('orders');
});

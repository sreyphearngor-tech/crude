<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

// ១. PUBLIC ROUTES
Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show_detail');
Route::get('/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('category.products');
Route::get('/search', [ProductController::class, 'search'])->name('search');

// ២. GUEST ROUTES
Route::middleware(['guest'])->group(function () {
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');
    Route::get('/login', [RegisterController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [RegisterController::class, 'login'])->name('login');
});

// ៣. AUTHENTICATED ROUTES
Route::middleware(['auth'])->group(function () {
    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

    // A. ADMIN ROUTES
    Route::middleware(['role:admin']) // ប្រាកដថាមាន Middleware នេះ
        ->prefix('admin')
        ->name('admin.')
        ->group(function () {
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');
            Route::resource('product', ProductController::class);
            Route::resource('category', CategoryController::class);
            Route::resource('users', UserController::class);
            Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');
    });

    // B. CLIENT ROUTES
    Route::middleware(['role:client'])->group(function () {
        Route::controller(CartController::class)->group(function () {
            Route::get('/cart', 'index')->name('cart.index');
            Route::post('/cart/add', 'addToCart')->name('cart.store');
            Route::post('/cart/update', 'update')->name('cart.update');
            Route::post('/cart/remove', 'remove')->name('cart.remove');
            Route::post('/cart/coupon', 'applyCoupon')->name('cart.coupon');
            Route::post('/checkout', 'checkout')->name('cart.checkout');
        });
        Route::get('/my-orders', [RegisterController::class, 'orders'])->name('client.orders');
    });
});

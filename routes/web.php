<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
*/

Route::get('/', [HomeController::class, 'index'])->name('home');

Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show_detail');

Route::get('/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('category.products');

Route::get('/search', [ProductController::class, 'search'])->name('search');


/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('guest')->group(function () {

    Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/login', [RegisterController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [RegisterController::class, 'login'])->name('login');
});


/*
|--------------------------------------------------------------------------
| 3. AUTH ROUTES
|--------------------------------------------------------------------------
*/

Route::middleware('auth')->group(function () {

    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');


    /*
    |--------------------------------------------------------------------------
    | ADMIN ROUTES
    |--------------------------------------------------------------------------
    */

    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {

            // Dashboard
            Route::get('/dashboard', [AdminController::class, 'index'])
                ->name('dashboard');

            // CRUD
            Route::resource('product', ProductController::class);
            Route::resource('category', CategoryController::class);
            Route::resource('users', UserController::class);

            // Orders
            Route::get('/orders', [AdminController::class, 'orders'])
                ->name('orders.index');

            // AJAX (IMPORTANT FOR DASHBOARD)
            Route::get('/products/ajax', [ProductController::class, 'ajaxIndex'])
                ->name('products.ajax');

            Route::get('/users/ajax', [UserController::class, 'ajaxIndex'])
                ->name('users.ajax');
        });


    /*
    |--------------------------------------------------------------------------
    | CLIENT ROUTES
    |--------------------------------------------------------------------------
    */

    Route::middleware('role:client')->group(function () {

        Route::controller(CartController::class)->group(function () {

            Route::get('/cart', 'index')->name('cart.index');

            Route::post('/cart/add', 'addToCart')->name('cart.store');

            Route::patch('/cart/update', 'update')->name('cart.update');

            Route::post('/cart/remove', 'remove')->name('cart.remove');

            Route::post('/cart/coupon', 'applyCoupon')->name('cart.coupon');

            Route::post('/checkout', 'checkout')->name('cart.checkout');
        });

        Route::get('/my-orders', [RegisterController::class, 'orders'])
            ->name('client.orders');
    });

});

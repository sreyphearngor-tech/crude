<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\CartController;
use App\Http\Controllers\CategoryController;
use App\Http\Controllers\AdminController;
use App\Http\Controllers\HomeController;
use App\Http\Controllers\UserController;
use App\Http\Controllers\Auth\AuthController;

/*
|--------------------------------------------------------------------------
| 1. PUBLIC ROUTES
|--------------------------------------------------------------------------
| Open to everyone visiting your store.
*/

Route::get('/', [HomeController::class, 'index'])->name('home');
Route::get('/product/{id}', [ProductController::class, 'show'])->name('product.show_detail');
Route::get('/category/{categoryId}', [ProductController::class, 'getByCategory'])->name('category.products');
Route::get('/search', [ProductController::class, 'search'])->name('search');


/*
|--------------------------------------------------------------------------
| 2. GUEST ROUTES
|--------------------------------------------------------------------------
| Accessible only by users who are NOT logged in yet.
*/
Route::middleware('guest')->group(function () {
    Route::get('/register', [RegisterController::class, 'registerForm'])->name('registerForm');
    Route::post('/register', [RegisterController::class, 'register'])->name('register');

    Route::get('/login', [RegisterController::class, 'loginForm'])->name('loginForm');
    Route::post('/login', [RegisterController::class, 'login'])->name('login');
});


/*
|--------------------------------------------------------------------------
| 3. AUTH PROTECTED ROUTES
|--------------------------------------------------------------------------
| Requires user to be fully logged in.
*/
Route::middleware('auth')->group(function () {

    Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

    // Password Updates (Safely wrapped inside auth middleware)
    Route::get('/change-password', [RegisterController::class, 'showChangePasswordForm'])->name('change-password.form');
    Route::post('/change-password', [RegisterController::class, 'update'])->name('change-password.update');

    /*
    |--------------------------------------------------------------------------
    | A. ADMIN PANEL RESOURCE MANIPULATION
    |--------------------------------------------------------------------------
    */
    Route::prefix('admin')
        ->name('admin.')
        ->middleware('role:admin')
        ->group(function () {

            // Dashboard Index
            Route::get('/dashboard', [AdminController::class, 'index'])->name('dashboard');

            // CRUD Resource Definitions (Handles store, index, create, update, destroy, show, edit)
            Route::resource('categories', CategoryController::class);
            Route::resource('product', ProductController::class);
            Route::resource('users', UserController::class);

            // Orders List Panel
            Route::get('/orders', [AdminController::class, 'orders'])->name('orders.index');

            // Live Dashboard AJAX Search Endpoints
            Route::get('/products/ajax', [ProductController::class, 'ajaxIndex'])->name('products.ajax');
            Route::get('/users/ajax', [UserController::class, 'ajaxIndex'])->name('users.ajax');
        });

    /*
    |--------------------------------------------------------------------------
    | B. CLIENT SPECIFIC ACTIONS
    |--------------------------------------------------------------------------
    */
    Route::middleware('role:client')->group(function () {

        // --- Shopping Cart & Checkout Process Handling ---
        Route::controller(CartController::class)->group(function () {
            // ផ្នែកគ្រប់គ្រងកន្ត្រកទំនិញ (Cart)
            Route::get('/cart', 'index')->name('cart.index');
            Route::post('/cart/add', 'addToCart')->name('cart.store');
            Route::patch('/cart/update', 'update')->name('cart.update');
            Route::post('/cart/remove', 'remove')->name('cart.remove');
            Route::post('/cart/coupon', 'applyCoupon')->name('cart.coupon'); // សម្រាប់បញ្ចុះតម្លៃ Coupon

            // ជំហានទី ១៖ ព័ត៌មានដឹកជញ្ជូន (Screen-1: Shipping)
            Route::get('/checkout/shipping', 'showShipping')->name('checkout.shipping');
            Route::post('/checkout/shipping', 'saveShipping')->name('checkout.shipping.save');

            // ជំហានទី ២៖ វិធីសាស្ត្របង់ប្រាក់ (Screen-2: Payment)
            Route::get('/checkout/payment', 'showPayment')->name('checkout.payment');
            Route::post('/checkout/payment', 'savePayment')->name('checkout.payment.save');

            // ជំហានទី ៣៖ ពិនិត្យទំនិញឡើងវិញ (Screen-3: Review Order)
            Route::get('/checkout/review', 'showReview')->name('checkout.review');

            // បញ្ជាក់ការបញ្ជាទិញចុងក្រោយ និងកាត់ស្តុក (ចុច Confirm Order នៅ Screen-3)
            Route::post('/checkout/confirm', 'processCheckout')->name('checkout.confirm');

            // ជំហានទី ៤៖ ទំព័រជោគជ័យ (Screen-4: Success Page)
            Route::get('/checkout/success', 'success')->name('checkout.success');
        });
        // Client Personal Order Summary Panel
        Route::get('/my-orders', [RegisterController::class, 'orders'])->name('client.orders');
    });
});

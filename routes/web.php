<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;
use App\Http\Controllers\RegisterController;
use App\Http\Controllers\CartController;
/*
|--------------------------------------------------------------------------
| Public Routes
|--------------------------------------------------------------------------
*/

// Homepage (accessible to everyone)
Route::get('/', [ProductController::class, 'home'])->name('home');

// Authentication Routes
Route::get('/login', [RegisterController::class, 'loginForm'])->name('login.form');
Route::post('/login', [RegisterController::class, 'login'])->name('login');

Route::get('/register', [RegisterController::class, 'registerForm'])->name('register.form');
Route::post('/register', [RegisterController::class, 'register'])->name('register');

Route::post('/logout', [RegisterController::class, 'logout'])->name('logout');

/*
|--------------------------------------------------------------------------
| Client Routes (role: client)
|--------------------------------------------------------------------------
*/
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/home', function () {
        return view('clients.home');
    })->name('client.home');
});

/*
|--------------------------------------------------------------------------
| Admin Routes (role: admin) – No prefix
|--------------------------------------------------------------------------
*/
Route::middleware(['auth','role:admin'])->group(function(){

    Route::get('/admin/dashboard', function(){
        return redirect()->route('product.index');
    })->name('admin.dashboard');

   // Route::resource('product', ProductController::class);

//cartcontroller

    // Product CRUD
    Route::get('/products', [ProductController::class, 'index'])->name('product.index');
    Route::get('/products/create', [ProductController::class, 'create'])->name('product.create');
    Route::post('/products', [ProductController::class, 'store'])->name('product.store');
    Route::get('/products/{product}', [ProductController::class, 'show'])->name('product.show');
    Route::get('/products/{product}/edit', [ProductController::class, 'edit'])->name('product.edit');
    Route::put('/products/{product}', [ProductController::class, 'update'])->name('product.update');
    Route::delete('/products/{product}', [ProductController::class, 'destroy'])->name('product.destroy');
});
Route::get('/product/{id}', [ProductController::class, 'show2'])->name('product.show2');
Route::get('/prodhome', [ProductController::class, 'home'])->name('products.home');
Route::middleware(['auth'])->group(function () {
    // ទុកតែ Route ណាដែលចាំបាច់ត្រូវ Login ដូចជា Add to Cart ឬ Checkout
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
});


Route::middleware(['auth'])->group(function () {
    // View Cart
    Route::get('/cart', [CartController::class, 'index'])->name('cart.index');

    // Add Item (from Product Grid)
    Route::post('/cart/add', [CartController::class, 'add'])->name('cart.add');
Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
Route::patch('/cart/update/{id}', [CartController::class, 'update'])->name('cart.update');

    // Remove Item (from Cart Page)
    Route::delete('/cart/remove/{id}', [CartController::class, 'remove'])->name('cart.remove');
});

<?php

use Illuminate\Support\Facades\Route;
use App\Http\Controllers\ProductController;

// Homepage (public view)
Route::get('/', [ProductController::class, 'home'])->name('home');

// Product admin routes
Route::prefix('product')->name('product.')->controller(ProductController::class)->group(function(){
    Route::get('/','index')->name('index');
    Route::get('/create','create')->name('create');
    Route::post('/','store')->name('store');
    Route::get('/{product}','show')->name('show');
    Route::get('/{product}/edit','edit')->name('edit');
    Route::put('/{product}','update')->name('update');
    Route::delete('/{product}','destroy')->name('destroy'); 
});
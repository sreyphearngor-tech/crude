<?php

use App\Http\Controllers\AuthController;
use Illuminate\Support\Facades\Route;

// ---------------- AUTH ----------------
Route::get('/login', [AuthController::class, 'loginForm'])->name('loginForm');
Route::post('/login', [AuthController::class, 'login'])->name('login');

Route::get('/register', [AuthController::class, 'registerForm'])->name('registerForm');
Route::post('/register', [AuthController::class, 'register'])->name('register');

Route::post('/logout', [AuthController::class, 'logout'])->name('logout');

// ---------------- CLIENT ROUTES ----------------
Route::middleware(['auth', 'role:client'])->group(function () {
    Route::get('/client/Home', function () {
        return view('clients.Home');
    })->name('client.Home');
});

// ---------------- ADMIN ROUTES ----------------
Route::middleware(['auth', 'role:admin'])->group(function () {
    Route::get('/admin/dashboard', function () {
        return view('admin.dashboard');
    })->name('admin.dashboard');
});

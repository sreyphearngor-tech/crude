<?php

use GuzzleHttp\Middleware;
use Illuminate\Http\Request;
use App\Http\Controllers\Api\AuthController;
use Illuminate\Support\Facades\Route;
use App\Http\Middleware\CheckRole;
use App\Http\Middleware\AuthMiddleware;
Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);
Route::middleware('auth:sanctum',)->group(function () {
    Route::middleware('role:admin')->group(function () {
        Route::get('/admin', function () {
            return "Welcome, admin!";
        });
    });
    Route::middleware('role:user')->group(function () {
        Route::get('/user', function () {
            return " Welcome, user!";
        });
    });
});

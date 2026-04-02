<?php

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Route;
use App\Http\Controllers\Auth\AuthController;
use GuzzleHttp\Middleware;

/*
|--------------------------------------------------------------------------
| API Routes
|--------------------------------------------------------------------------
|
| Here is where you can register API routes for your application. These
| routes are loaded by the RouteServiceProvider and all of them will
| be assigned to the "api" middleware group. Make something great!
|
*/

Route::post('/register', [AuthController::class, 'register']);
Route::post('/login', [AuthController::class, 'login']);

Route::post('/logout', [AuthController::class, 'logout']);

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

<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use Illuminate\Support\Facades\View;
use Illuminate\Support\Facades\Schema;
use Illuminate\Pagination\Paginator;
use Illuminate\Support\ServiceProvider;

class AppServiceProvider extends ServiceProvider
{
    /**
     * Register any application services.
     */
    public function register(): void
    {
        //
    }

    /**
     * Bootstrap any application services.
     */
    public function boot(): void
    {

      Paginator::useTailwind();
        // ចែករំលែកទិន្នន័យ Dashboard ទៅកាន់គ្រប់ View ទាំងអស់ដែលប្រើ Layout Admin
        // វិធីនេះនឹងបំបាត់ Error "Undefined variable" នៅគ្រប់ទំព័រ
        View::composer('*', function ($view) {
            $view->with('totalProducts', Product::count());
            $view->with('totalUsers', User::where('role', 'client')->count());
            $view->with('outOfStock', Product::where('qty', '<=', 0)->count());
            $view->with('newOrders', Order::where('status', 'pending')->count());
        });
    }
}

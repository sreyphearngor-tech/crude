<?php

namespace App\Providers;

use App\Models\Product;
use App\Models\User;
use App\Models\Order;
use App\Models\Category; // ១. កុំភ្លេច Import Category Model នៅទីនេះ
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
        // 1. បង្ហាញប្រវែង String លំនាំដើមសម្រាប់ស្ទាក់ Error 1071
        Schema::defaultStringLength(191);

        Paginator::useTailwind();

        // 2. ផ្លាស់ប្តូរពី '*' ទៅជាឈ្មោះ Layout របស់ Admin ជាក់លាក់ (ឧទាហរណ៍: 'layouts.admin')
        View::composer('layouts.admin', function ($view) {
            $view->with('totalProducts', Product::count());
            $view->with('totalUsers', User::where('role', 'client')->count());
            $view->with('outOfStock', Product::where('qty', '<=', 0)->count());
            $view->with('newOrders', Order::where('status', 'pending')->count());
        });

        // ៣. បន្ថែម View Composer សម្រាប់ Layout របស់ User (layouts.app)
        // វានឹងដំណើរការ Query តែនៅពេលណាដែល layouts.app ត្រូវបានហៅមកប្រើប្រាស់ប៉ុណ្ណោះ
        View::composer('layouts.app', function ($view) {
            // បោះទិន្នន័យ Category ទាំងអស់ទៅឱ្យ Search Form
            $view->with('categories', Category::all());

            // បោះបញ្ជីពណ៌ប្លែកៗ (Unique Colors) ពី Table Products ទៅឱ្យ Search Form
        });
    }
}

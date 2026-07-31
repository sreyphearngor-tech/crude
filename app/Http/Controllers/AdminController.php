<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Models\Product;
use App\Models\User;
use App\Models\Category;
use Illuminate\Http\Request;

class AdminController extends AuthController
{
    public function index(Request $request)
    {
        // 1. Calculate Stats
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $outOfStock = Product::where('qty', '<=', 0)->count();

        // 2. Build Query
        $query = Product::with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products = $query->latest()->paginate(10);
        $categories = Category::all();

        // 3. Handle AJAX Requests securely
        if ($request->ajax()) {
            // Note: If your table view is at resources/views/admin/product/table.blade.php, update this path.
            return view('products.table', compact('products', 'totalProducts', 'totalUsers', 'outOfStock'))->render();
        }

        // 4. Full Page Load
        return view('admin.dashboard', compact(
            'products',
            'categories',
            'totalProducts',
            'totalUsers',
            'outOfStock'
        ));
    }

    public function orders()
    {
        return view('admin.orders.index');
    }
}

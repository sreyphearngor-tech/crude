<?php

// app/Http/Controllers/HomeController.php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Models\Product; // កុំភ្លេច Import Model
use App\Models\Category;
use Illuminate\Http\Request;

class HomeController extends AuthController
{
  // កែក្នុង HomeController.php
// app/Http/Controllers/HomeController.php

public function index()
{
    $categories = Category::all();
    $products = Product::latest()->take(8)->get(); // សម្រាប់ Flash Sales
    $bestSellingProducts = Product::latest()->take(4)->get(); // ត្រូវប្រាកដថាឈ្មោះនេះដូចក្នុង Blade

    return view('home', compact('categories', 'products', 'bestSellingProducts'));
}
public function show($id)
{
    $product = Product::findOrFail($id);
    // ទាញយកផលិតផលដែលពាក់ព័ន្ធ (Related Products)
    $relatedProducts = Product::where('category_id', $product->category_id)
                                ->where('id', '!=', $id)
                                ->take(4)
                                ->get();

    return view('product.show', compact('product', 'relatedProducts'));
}
}

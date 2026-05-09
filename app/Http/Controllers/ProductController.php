<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Models\Product;
use App\Models\Category;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends AuthController
{
    // --- ផ្នែកសម្រាប់ ADMIN ---

    public function index(Request $request)
    {
        $query = Product::query()->with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->latest()->paginate(10);
        $categories = Category::all();

        if ($request->ajax()) {
            return view('admin.products.table', compact('products'))->render();
        }

        return view('admin.product.index', compact('products', 'categories'));
    }
// Method សម្រាប់បង្ហាញ Form បញ្ចូលផលិតផល
    public function create()
    {
        $categories = Category::all(); // ទាញយកប្រភេទដើម្បីឱ្យ User រើសក្នុង Form
        return view('admin.product.create', compact('categories'));
    }


    public function store(Request $request)
    {
        $validated = $request->validate([
            'name'        => 'required|string|max:255',
            'category_id' => 'required|exists:categories,id',
            'price'       => 'required|numeric|min:0',
            'qty'         => 'required|integer|min:0',
            'description' => 'nullable|string',
            'size'        => 'nullable|string',
            'image'       => 'nullable|image|max:2048',
            'image2'      => 'nullable|image|max:2048',
            'image3'      => 'nullable|image|max:2048',
            'image4'      => 'nullable|image|max:2048',
        ]);

        foreach (['image', 'image2', 'image3', 'image4'] as $field) {
            if ($request->hasFile($field)) {
                $validated[$field] = $request->file($field)->store('products', 'public');
            }
        }

        Product::create($validated);
        return redirect()->route('admin.product.index')->with('success', 'Product saved successfully!');
    }

    // --- ផ្នែកសម្រាប់ FRONTEND (USER) ---

    public function home()
    {
        $categories = Category::take(8)->get(); // សម្រាប់ Sidebar
        $products = Product::latest()->take(8)->get(); // សម្រាប់ Flash Sales
        $bestSellingProducts = Product::latest()->take(4)->get(); // សម្រាប់ Best Selling

        return view('home', compact('products', 'categories', 'bestSellingProducts'));
    }

    public function show($id)
    {
        $product = Product::findOrFail($id);
        // ទាញយកផលិតផលពាក់ព័ន្ធ
        $relatedProducts = Product::where('category_id', $product->category_id)
                                    ->where('id', '!=', $id)
                                    ->take(4)->get();

        return view('product_detail', compact('product', 'relatedProducts'));
    }


// app/Http/Controllers/ProductController.php

// app/Http/Controllers/ProductController.php

public function getByCategory($categoryId)
{
    $categories = Category::all();
    $products = Product::where('category_id', $categoryId)->latest()->paginate(12);

    // បន្ថែមបន្ទាត់នេះ ដើម្បីឱ្យទំព័រ Home ស្គាល់ Variable ពេល Select Category
    $bestSellingProducts = Product::latest()->take(4)->get();

    return view('home', compact('products', 'categories', 'bestSellingProducts'));
}


// app/Http/Controllers/ProductController.php

public function search(Request $request)
{
    $query = $request->input('query');
    $categories = Category::all();

    // ស្វែងរកផលិតផលតាមឈ្មោះផលិតផល ឬ តាមឈ្មោះ Category
    $products = Product::where('name', 'LIKE', "%{$query}%")
        ->orWhereHas('category', function($q) use ($query) {
            $q->where('name', 'LIKE', "%{$query}%");
        })
        ->latest()
        ->get();

    // បោះទិន្នន័យចាំបាច់ទៅឱ្យ home.blade.php
    $bestSellingProducts = Product::latest()->take(4)->get();

    return view('home', compact('products', 'categories', 'query', 'bestSellingProducts'));
}
// 1. Method សម្រាប់បង្ហាញ Form កែប្រែ (Edit Form)
public function edit($id)
{
    $product = Product::findOrFail($id);
    $categories = Category::all();
    return view('admin.product.edit', compact('product', 'categories'));
}

// 2. Method សម្រាប់ Update ទិន្នន័យចូល Database
public function update(Request $request, $id)
{
    $product = Product::findOrFail($id);

    $validated = $request->validate([
        'name'        => 'required|string|max:255',
        'category_id' => 'required|exists:categories,id',
        'price'       => 'required|numeric|min:0',
        'qty'         => 'required|integer|min:0',
        'description' => 'nullable|string',
        'size'        => 'nullable|string',
        'image'       => 'nullable|image|max:2048',
        'image2'      => 'nullable|image|max:2048',
        'image3'      => 'nullable|image|max:2048',
        'image4'      => 'nullable|image|max:2048',
    ]);

    // បង្កើត Array សម្រាប់រក្សាទុកទិន្នន័យដែលត្រូវ Update
    // យើងដក Files ចេញពី $validated សិន ដើម្បីកុំឱ្យវាជាន់គ្នាពេល Update
    $updateData = $validated;

    // ចាត់ចែងការ Update រូបភាព
    foreach (['image', 'image2', 'image3', 'image4'] as $field) {
        if ($request->hasFile($field)) {
            // ១. លុបរូបចាស់ចេញពី Storage បើមានរូបថ្មីមកជំនួស
            if ($product->$field && Storage::disk('public')->exists($product->$field)) {
                Storage::disk('public')->delete($product->$field);
            }

            // ២. រក្សាទុករូបថ្មី និងដាក់ឈ្មោះផ្លូវ (Path) ចូលក្នុង Array
            $updateData[$field] = $request->file($field)->store('products', 'public');
        } else {
            // បើគ្មានការ Upload រូបថ្មីទេ ត្រូវរក្សារូបចាស់ដដែល (កុំឱ្យវាបាត់)
            $updateData[$field] = $product->$field;
        }
    }

    // Update ទៅក្នុង Database តែម្តង
    $product->update($updateData);

    return redirect()->route('admin.product.index')->with('success', 'កែប្រែផលិតផលបានជោគជ័យ!');
}

// 3. Method សម្រាប់លុបផលិតផល (Destroy)
public function destroy($id)
{
    $product = Product::findOrFail($id);

    // លុបរូបភាពចេញពី Storage
    foreach (['image', 'image2', 'image3', 'image4'] as $field) {
        if ($product->$field) {
            Storage::disk('public')->delete($product->$field);
        }
    }

    $product->delete();
    return redirect()->route('admin.product.index')->with('success', 'Product deleted successfully!');
}
}

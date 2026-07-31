<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Product;
use App\Models\Category;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;

class ProductController extends AuthController
{
    // --- ផ្នែកសម្រាប់ ADMIN ---

    public function index(Request $request)
    {
        // 1. Calculate dashboard aggregate statistics for layouts counters
        $totalProducts = Product::count();
        $totalUsers = User::count();
        $outOfStock = Product::where('qty', '<=', 0)->count();

        // 2. Build inventory products query lookup
        $query = Product::query()->with('category');

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        if ($request->filled('category')) {
            $query->where('category_id', $request->category);
        }

        $products   = $query->latest()->paginate(10);
        $categories = Category::all();

        // 3. Handle live AJAX lookups securely
        if ($request->ajax()) {
            return view('admin.products.table', compact('products', 'totalProducts', 'totalUsers', 'outOfStock'))->render();
        }

        // 4. Return standard structural full page frame load out
        return view('admin.product.index', compact('products', 'categories', 'totalProducts', 'totalUsers', 'outOfStock'));
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

    public function getByCategory($categoryId)
    {
        $categories = Category::all();
        $products = Product::where('category_id', $categoryId)->latest()->paginate(12);

        // បន្ថែមបន្ទាត់នេះ ដើម្បីឱ្យទំព័រ Home ស្គាល់ Variable ពេល Select Category
        $bestSellingProducts = Product::latest()->take(4)->get();

        return view('home', compact('products', 'categories', 'bestSellingProducts'));
    }
    public function search(Request $request)
    {
        $query = $request->input('query');

        // ១. បើគ្មានការវាយអក្សរសោះ ឱ្យចេញទិន្នន័យទទេ
        if (blank($query)) {
            $products = collect();
        } else {
            // ២. ស្វែងរកផលិតផលតាមឈ្មោះ ឬតាម Category
            $products = Product::with('category') // ទាញយក category មកជាមួយដើម្បីបង្ហាញលើ UI
                ->where('name', 'LIKE', "%{$query}%")
                ->orWhere('description', 'LIKE', "%{$query}%")
                ->orWhereHas('category', function ($q) use ($query) {
                    $q->where('name', 'LIKE', "%{$query}%");
                })
                ->latest()
                ->take(8) // កម្រិតយកត្រឹម ៨ ទំនិញបានហើយ ដើម្បីកុំឱ្យវែងពេកនៅលើ dropdown
                ->get();
        }

        // ៣. បើជា AJAX Request ត្រូវបោះជា JSON ទៅឱ្យ JavaScript វិញភ្លាម
        if ($request->ajax()) {
            return response()->json($products);
        }

        // សម្រាប់ករណីចូលទៅកាន់ទំព័រ search ធម្មតា (Fallback)
        $categories = Category::all();
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

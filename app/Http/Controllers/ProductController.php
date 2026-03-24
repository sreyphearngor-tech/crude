<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Exception;

class ProductController extends Controller
{
    // Home Page / Frontend (optional)
    public function home(Request $request)
    {
        $query = Product::query();

        if ($request->filled('search')) {
            $query->where('name', 'like', '%' . $request->search . '%');
        }

        $products = $query->orderBy('id', 'desc')->paginate(12);

        if ($request->ajax()) {
            return view('partials.products', compact('products'))->render();
        }

        return view('home', compact('products'));
    }

    // Show Products + Search
    public function index(Request $request)
    {
        try {
            $query = Product::query();

            if ($request->filled('search')) {
                $query->where('name', 'like', '%' . $request->search . '%');
            }

            $products = $query->orderBy('id', 'desc')->paginate(5);

            if ($request->ajax()) {
                return view('products.table', compact('products'))->render();
            }

            return view('products.index', compact('products'));
        } catch (Exception $e) {
            return back()->with('error', 'Something went wrong.');
        }
    }

    // Show Create Form
    public function create()
    {
        return view('products.create');
    }

    // Store Product
    public function store(Request $request)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required|numeric|min:0',
                'qty' => 'required|integer|min:0',
                'image' => 'required|image|max:2048',
            ]);

            $data = $request->all();

            if ($request->hasFile('image')) {
                // Save image to storage/app/public/uploads
                $data['image'] = $request->file('image')->store('uploads', 'public');
            }

            Product::create($data);

            return redirect()->route('product.index')
                             ->with('success', 'Product created successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to create product.');
        }
    }

    // Show Edit Form
    public function edit(Product $product)
    {
        return view('products.edit', compact('product'));
    }

    // Update Product
    public function update(Request $request, Product $product)
    {
        try {
            $request->validate([
                'name' => 'required',
                'price' => 'required|numeric|min:0',
                'qty' => 'required|integer|min:0',
                'image' => 'nullable|image|max:2048',
            ]);

            $data = $request->all();

            if ($request->hasFile('image')) {
                // Delete old image
                if ($product->image) {
                    Storage::disk('public')->delete($product->image);
                }

                // Store new image
                $data['image'] = $request->file('image')->store('uploads', 'public');
            }

            $product->update($data);

            return redirect()->route('product.index')
                             ->with('success', 'Product updated successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to update product.');
        }
    }

    // Delete Product
    public function destroy(Product $product)
    {
        try {
            if ($product->image) {
                Storage::disk('public')->delete($product->image);
            }

            $product->delete();

            return redirect()->route('product.index')
                             ->with('success', 'Product deleted successfully');
        } catch (Exception $e) {
            return back()->with('error', 'Failed to delete product.');
        }
    }

    // Show Product Detail
    public function show(Product $product)
    {
        return view('products.show', compact('product'));
    }
public function dashboard()
{
    $products = Product::latest()->paginate(5);

    return view('admin.dashboard', compact('products'));
}
}

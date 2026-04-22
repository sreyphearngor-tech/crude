<?php



namespace App\Http\Controllers;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use App\Models\Product;
use Illuminate\Support\Facades\Storage;
use Exception;
use App\Models\Cart;
use App\Models\CartItem;
use Illuminate\Support\Facades\Auth;
class ProductController extends AuthController
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
                'image' => 'required|image|mimes:jpg,jpeg,png|max:2048',
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

  public function update(Request $request, Product $product)
{
    $request->validate([
        'name' => 'required|string|max:255',
        'price' => 'required|numeric|min:0',
        'qty' => 'required|integer|min:0',
        'image' => 'nullable|image|mimes:jpg,jpeg,png|max:2048',
    ]);

    // Update basic fields
    $product->name = $request->name;
    $product->price = $request->price;
    $product->qty = $request->qty;

    // Handle image upload
    if ($request->hasFile('image')) {
        // Delete old image if exists
        if ($product->image && Storage::disk('public')->exists($product->image)) {
            Storage::disk('public')->delete($product->image);
        }

        // Store new image in 'storage/app/public/uploads'
        $product->image = $request->file('image')->store('uploads', 'public');
    }

    $product->save();

    return redirect()->route('product.index')
                     ->with('success', 'Product updated successfully');
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

// Show specific product detail
public function show2($id)
    {
        // Find the product or return a 404 error if it doesn't exist
        $product = Product::findOrFail($id);

        // Pass the product data to your detail blade file
        return view('products.show2', compact('product'));
    }
public function add(Request $request)
{
    // 1. Ensure the user is logged in
    if (!Auth::check()) {
        return redirect()->route('login')->with('error', 'Please login first!');
    }

    $user = Auth::user();

    // 2. Get the user's cart or create one if they don't have it
    $cart = $user->cart ?: $user->cart()->create();

    // 3. Find if the product is already in the cart
    $cartItem = $cart->items()->where('product_id', $request->product_id)->first();

    if ($cartItem) {
        // Increment quantity if it exists
        $cartItem->increment('quantity');
    } else {
        // Create new item if it doesn't
        $cart->items()->create([
            'product_id' => $request->product_id,
            'quantity' => 1
        ]);
    }

    return back()->with('success', 'Product added to cart!');
}
}

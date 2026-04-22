<?php

namespace App\Http\Controllers;

namespace App\Http\Controllers;
use App\Http\Controllers\API\AuthController;
use Illuminate\Http\Request;
use App\Models\Cart;
use App\Models\CartItem;
use App\Models\Product;
use Illuminate\Support\Facades\Auth;

class CartController extends AuthController
{
    /**
     * Display the shopping cart items.
     */
    public function index()
    {
        // Eager load the cart items and their associated products
        // This prevents the "N+1" query problem in your Blade view
        $cart = Auth::user()->cart()->with('items.product')->first();

        return view('cart.index', compact('cart'));
    }
public function update(Request $request, $id)
{
    $cartItem = CartItem::findOrFail($id);

    // Security check
    if ($cartItem->cart->user_id !== auth()->id()) {
        return back();
    }

    $action = $request->input('action');

    if ($action === 'increase') {
        $cartItem->increment('quantity');
    } elseif ($action === 'decrease') {
        if ($cartItem->quantity > 1) {
            $cartItem->decrement('quantity');
        } else {
            $cartItem->delete(); // Remove if quantity becomes 0
            return back()->with('success', 'Item removed.');
        }
    }

    return back();
}
    /**
     * Add a product to the cart.
     */
    public function add(Request $request)
    {
        // 1. Validate the incoming request
        $request->validate([
            'product_id' => 'required|exists:products,id',
        ]);

        // 2. Get the authenticated user
        $user = Auth::user();

        // 3. Find the user's cart or create a new one if it doesn't exist
        // This uses the hasOne relationship you defined in the User model
        $cart = $user->cart ?: $user->cart()->create();

        // 4. Check if this product is already in the cart
        $cartItem = $cart->items()->where('product_id', $request->product_id)->first();

        if ($cartItem) {
            // If it exists, just increase the quantity
            $cartItem->increment('quantity');
        } else {
            // If it's new, create a new CartItem record
            $cart->items()->create([
                'product_id' => $request->product_id,
                'quantity' => 1,
            ]);
        }

        return redirect()->back()->with('success', 'Product added to cart successfully!');
    }

    /**
     * Remove an item from the cart.
     */
    public function remove($id)
    {
        $cartItem = CartItem::findOrFail($id);

        // Ensure the user owns the cart this item belongs to
        if ($cartItem->cart->user_id === Auth::id()) {
            $cartItem->delete();
        }

        return redirect()->back()->with('success', 'Item removed from cart.');
    }
}

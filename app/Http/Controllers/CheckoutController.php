<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use App\Models\Cart;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class CheckoutController extends AuthController
{
    /**
     * បង្ហាញទំព័រ Checkout
     */
    public function index()
    {
        $cartItems = Cart::with('product')->where('user_id', Auth::id())->get();

        if ($cartItems->isEmpty()) {
            return redirect()->route('cart.index')->with('error', 'Your cart is empty!');
        }

        $total = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        return view('frontend.checkout', compact('cartItems', 'total'));
    }

    /**
     * ដំណើរការរក្សាទុកការបញ្ជាទិញ (Process Checkout)
     */
   public function process(Request $request)
{
    // ១. Validate ទិន្នន័យ (កែសម្រួលឱ្យស្របតាម Form `image_1cc2e1.png`)
    $request->validate([
        'first_name' => 'required|string|max:255',
        'address'    => 'required|string|max:255',
        'city'       => 'required|string|max:255',
        'phone'      => 'required|string|max:20',
        'email'      => 'required|email|max:255',
        'payment_method' => 'required|in:bank,cod',
    ]);

    // ទាញយក Item ក្នុង Cart របស់ User ដែលកំពុង Login
    $cartItems = Cart::where('user_id', Auth::id())->get();

    if ($cartItems->isEmpty()) {
        return redirect()->route('cart.index')->with('error', 'Cart is empty.');
    }

    // ២. ប្រើប្រាស់ Transaction ដើម្បីធានាសុវត្ថិភាពទិន្នន័យ
    DB::transaction(function () use ($request, $cartItems) {

        // គណនាតម្លៃសរុប
        $totalPrice = $cartItems->sum(function($item) {
            return $item->product->price * $item->quantity;
        });

        // ៣. បង្កើត Order (រក្សាទុកក្នុងតារាង `orders`)
        $order = Order::create([
            'user_id'        => Auth::id(),
            'total_price'    => $totalPrice,
            'status'         => 'pending', // ស្ថានភាពដំបូង
            'first_name'     => $request->first_name,
            'company_name'   => $request->company_name,
            'address'        => $request->address,
            'apartment'      => $request->apartment,
            'city'           => $request->city,
            'phone'          => $request->phone,
            'email'          => $request->email,
            'payment_method' => $request->payment_method,
            'save_info'      => $request->has('save_info'), // true បើ check, false បើអត់
        ]);

        // ៤. បង្កើត Order Items (រក្សាទុកក្នុងតារាង `order_items`)
        foreach ($cartItems as $cartItem) {
            OrderItem::create([
                'order_id'   => $order->id, // យក ID ចេញពី Order ដែលទើបបង្កើត
                'product_id' => $cartItem->product_id,
                'quantity'   => $cartItem->quantity,
                'price'      => $cartItem->product->price, // រក្សាទុកតម្លៃនៅពេលទិញ
            ]);
        }

        // ៥. លុប Cart ចោលបន្ទាប់ពីទិញរួច
        Cart::where('user_id', Auth::id())->delete();
    });

    // ៦. Redirect ទៅទំព័រជោគជ័យ ឬទំព័រដើម
    return redirect()->route('home')->with('success', 'Order placed successfully! Thank you.');
}
}

<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Api\AuthController;
use Illuminate\Http\Request;
use App\Models\Product;
use App\Models\Order;
use App\Models\OrderItem;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class CartController extends AuthController
{
    /**
     * បង្ហាញទំព័រកន្ត្រកទំនិញ
     */
    public function index()
    {
        $cart = session()->get('cart', []);
        return view('cart.index', compact('cart'));
    }

    /**
     * បន្ថែមទំនិញទៅក្នុងកន្ត្រក (Session)
     */
 public function addToCart(Request $request)
{
    // ១. Validation: ធានាថាមាន ID និង Size (បើផលិតផលតម្រូវឱ្យមាន size)
    $request->validate([
        'id' => 'required|exists:products,id',
        'size' => 'nullable|string'
    ]);

    $id = $request->id;
    $size = $request->size;
    $product = Product::findOrFail($id);

    // ២. បង្កើត Unique Key (ឧទាហរណ៍: "1-M" ឬ "1-XL")
    // បើគ្មាន size ទេ key គឺនៅតែ "1" ដដែល
    $cartKey = $id . ($size ? '-' . $size : '');

    $cart = session()->get('cart', []);

    // ៣. ឆែកចំនួនដែលមានក្នុង Cart រួចហើយ
    $currentQtyInCart = isset($cart[$cartKey]) ? $cart[$cartKey]['quantity'] : 0;

    // ៤. ឆែកស្តុកផលិតផលក្នុង Database
    if ($product->qty <= $currentQtyInCart) {
        return redirect()->back()->with('error', 'សោកស្តាយ! ទំនិញទំហំ ' . ($size ?? '') . ' នេះអស់ពីស្តុកហើយ។');
    }

    // ៥. បន្ថែម ឬ បង្កើនចំនួន
    if(isset($cart[$cartKey])) {
        $cart[$cartKey]['quantity']++;
    } else {
        $cart[$cartKey] = [
            "id"       => $product->id,
            "name"     => $product->name,
            "quantity" => 1,
            "price"    => $product->price,
            "size"     => $size,
            "image"    => $product->image
        ];
    }

    session()->put('cart', $cart);

    // បញ្ជូនសារទៅកាន់ View
    return redirect()->back()->with('success', 'បានបន្ថែម ' . $product->name . ' (' . ($size ?? 'Default') . ') ទៅក្នុងកន្ត្រក!');
}
    /**
     * ធ្វើបច្ចុប្បន្នភាពចំនួនទំនិញក្នុងកន្ត្រក (AJAX)
     */
 // នៅក្នុង CartController.php// ក្នុង CartController.php

public function update(Request $request)
{
    // បន្ថែមការ Validate quantity ឱ្យធំជាង ឬស្មើ ១
    if($request->id && $request->quantity && $request->quantity >= 1) {
        $cart = session()->get('cart');

        if(isset($cart[$request->id])) {
            $cart[$request->id]["quantity"] = $request->quantity;
            session()->put('cart', $cart);

            $rowSubtotal = $cart[$request->id]['price'] * $request->quantity;
            $total = $this->calculateTotal($cart); // ប្រើ function ដែលមានស្រាប់

            return response()->json([
                'success' => true,
                'rowSubtotal' => number_format($rowSubtotal, 2),
                'newTotal' => number_format($total, 2)
            ]);
        }
    }
    return response()->json(['success' => false], 400);
}

public function checkout(Request $request)
{
    $cart = session()->get('cart');
    if (!$cart) {
        return redirect()->back()->with('error', 'កន្ត្រកទំនិញរបស់អ្នកនៅទទេ!');
    }

    return DB::transaction(function () use ($cart) { // ប្រើ syntax ខ្លីជាង
        try {
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $this->calculateTotal($cart),
                'status' => 'pending',
            ]);

            foreach ($cart as $id => $details) {
                // ប្រើ lockForUpdate ដើម្បីការពារការកាត់ស្តុកជាន់គ្នា
                $product = Product::where('id', $id)->lockForUpdate()->first();

                if (!$product || $product->qty < $details['quantity']) {
                    throw new \Exception("ផលិតផល " . ($product->name ?? 'មិនស្គាល់') . " មិនគ្រប់គ្រាន់ក្នុងស្តុកទេ!");
                }

                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                $product->decrement('qty', $details['quantity']);
            }

            session()->forget('cart');
            return redirect()->route('home')->with('checkout_success', 'ការបញ្ជាទិញជោគជ័យ!');

        } catch (\Exception $e) {
            return redirect()->back()->with('error', 'មានបញ្ហា៖ ' . $e->getMessage());
        }
    });
}
    /**
     * លុបទំនិញចេញពីកន្ត្រក
     */
    public function remove(Request $request)
    {
        if($request->id) {
            $cart = session()->get('cart');
            if(isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'បានលុបទំនិញចេញពីកន្ត្រក!');
        }
    }

    /**
     * ដំណើរការការបញ្ជាទិញ (Checkout)
     */

    /**
     * មុខងារជំនួយសម្រាប់គណនាតម្លៃសរុប
     */
private function calculateTotal($cart)
{
    $total = 0;
    foreach($cart as $item) {
        $total += $item['price'] * $item['quantity'];
    }
    return $total;
}
}

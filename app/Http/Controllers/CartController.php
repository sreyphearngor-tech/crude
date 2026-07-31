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
        if (isset($cart[$cartKey])) {
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
        if ($request->id && $request->quantity && $request->quantity >= 1) {
            $cart = session()->get('cart');

            if (isset($cart[$request->id])) {
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
        if ($request->id) {
            $cart = session()->get('cart');
            if (isset($cart[$request->id])) {
                unset($cart[$request->id]);
                session()->put('cart', $cart);
            }
            return redirect()->back()->with('success', 'បានលុបទំនិញចេញពីកន្ត្រក!');
        }
    }
    // ជំហានទី ១៖ បង្ហាញទំព័រ Shipping Details (Screen-1)
    public function showShipping()
    {
        // បើគ្មានទំនិញក្នុងកន្ត្រកទេ មិនឱ្យទៅមុខឡើយ
        if (!session()->has('cart') || empty(session()->get('cart'))) {
            return redirect()->route('cart.index')->with('error', 'កន្ត្រកទំនិញរបស់អ្នកនៅទទេឡើយ!');
        }
        return view('checkout.shipping');
    }

    // រក្សាទុកព័ត៌មាន Shipping ចូល Session រួចរុញទៅជំហានបន្ទាប់
    public function saveShipping(Request $request)
    {
        $validated = $request->validate([
            'full_name'      => 'required|string|max:255',
            'phone_number'   => 'required|string|max:20',
            'province'       => 'required|string',
            'city'           => 'required|string',
            'street_address' => 'required|string',
            'postal_code'    => 'required|string',
        ]);

        // រក្សាទុកក្នុង Session បណ្ដោះអាសន្ន
        session()->put('checkout_shipping', $validated);

        return redirect()->route('checkout.payment');
    }

    // ជំហានទី ២៖ បង្ហាញជម្រើសបង់ប្រាក់ (Screen-2)
    public function showPayment()
    {
        if (!session()->has('checkout_shipping')) {
            return redirect()->route('checkout.shipping');
        }
        return view('checkout.payment');
    }

    // រក្សាទុកព័ត៌មាន Payment ចូល Session រួចរុញទៅជំហានពិនិត្យឡើងវិញ
    public function savePayment(Request $request)
    {
        $validated = $request->validate([
            'payment_method'    => 'required|string',
            'card_holder_name'  => 'nullable|string',
            'card_number'       => 'nullable|string',
            'expiry_date'       => 'nullable|string',
            'cvv'               => 'nullable|string',
        ]);

        session()->put('checkout_payment', $validated);

        return redirect()->route('checkout.review');
    }

    // ជំហានទី ៣៖ ពិនិត្យទំនិញ និងគណនាតម្លៃសរុប (Screen-3)
    public function showReview()
    {
        $cart = session()->get('cart', []);
        $shipping = session()->get('checkout_shipping');
        $payment = session()->get('checkout_payment');

        if (empty($cart) || !$shipping || !$payment) {
            return redirect()->route('cart.index');
        }

        // គណនាតម្លៃ
        $subtotal = $this->calculateTotal($cart);
        $shippingFee = 10.00; // ថ្លៃដឹកជញ្ជូនថេរដូចក្នុង UI
        $total = $subtotal + $shippingFee;

        return view('checkout.review', compact('cart', 'subtotal', 'shippingFee', 'total'));
    }

    // ជំហានកាត់ស្តុក បង្កើត Order ចូល Database ពិតប្រាកដ (ពេលចុច Confirm Order លើ Screen-3)
    public function processCheckout(Request $request)
    {
        $cart = session()->get('cart');
        $shipping = session()->get('checkout_shipping');
        $payment = session()->get('checkout_payment');

        if (!$cart || !$shipping || !$payment) {
            return redirect()->route('cart.index')->with('error', 'ព័ត៌មានមិនត្រឹមត្រូវ!');
        }

        return DB::transaction(function () use ($cart, $shipping, $payment) {
            try {
                $subtotal = $this->calculateTotal($cart);
                $shippingFee = 10.00;
                $totalAmount = $subtotal + $shippingFee;

                // ១. បង្កើតទិន្នន័យក្នុង Table orders (មាន Column ថ្មីៗដែលបានកែរួច)
                $order = Order::create([
                    'user_id'          => Auth::id(),
                    'total_amount'     => $totalAmount,
                    'status'           => 'pending',
                    'shipping_name'    => $shipping['full_name'],
                    'shipping_phone'   => $shipping['phone_number'],
                    'shipping_address' => $shipping['street_address'] . ', ' . $shipping['city'] . ', ' . $shipping['province'],
                    'payment_method'   => $payment['payment_method'],
                ]);

                // ២. រុករកទំនិញក្នុងកន្ត្រកដើម្បីកាត់ស្តុក និងបង្កើត OrderItem
                foreach ($cart as $details) {
                    $product = Product::where('id', $details['id'])->lockForUpdate()->first();

                    if (!$product || $product->qty < $details['quantity']) {
                        throw new \Exception("ផលិតផល " . ($product->name ?? 'មិនស្គាល់') . " មិនគ្រប់គ្រាន់ក្នុងស្តុកទេ!");
                    }

                    OrderItem::create([
                        'order_id'   => $order->id,
                        'product_id' => $product->id,
                        'quantity'   => $details['quantity'],
                        'price'      => $details['price'],
                        'size'       => $details['size'] ?? null,
                    ]);

                    // កាត់ស្តុកចេញពី Table products
                    $product->decrement('qty', $details['quantity']);
                }

                // ៣. សម្អាត Sessions ទាំងអស់ក្រោយទិញជោគជ័យ
                session()->forget(['cart', 'checkout_shipping', 'checkout_payment']);

                // ផ្ញើ ID ទៅកាន់ទំព័រ Success តាមរយៈ flash session
                return redirect()->route('checkout.success')->with('success_order_id', $order->id);
            } catch (\Exception $e) {
                return redirect()->route('checkout.review')->with('error', 'មានបញ្ហា៖ ' . $e->getMessage());
            }
        });
    }

    // ជំហានទី ៤៖ បង្ហាញផ្ទាំងជោគជ័យ (Screen-4)
    public function success()
    {
        $orderId = session('success_order_id');

        if (!$orderId) {
            return redirect()->route('home'); // ការពារកុំឱ្យ User ចូលមកទំព័រនេះត្រង់ៗ
        }

        $order = Order::findOrFail($orderId);

        return view('checkout.success', compact('order'));
    }

    // Helper Method សម្រាប់គណនាតម្លៃសរុបក្នុងកន្ត្រក
    private function calculateTotal($cart)
    {
        $total = 0;
        foreach ($cart as $item) {
            $total += $item['price'] * $item['quantity'];
        }
        return $total;
    }
}

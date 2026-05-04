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
        // ទទួលយក ID ពី input 'id' ដែលផ្ញើមកពី Form
        $id = $request->id;
        $product = Product::findOrFail($id);

        $cart = session()->get('cart', []);

        // ប្រសិនបើមានទំនិញនេះក្នុងកន្ត្រករួចហើយ បូកបន្ថែមចំនួន (Quantity)
        if(isset($cart[$id])) {
            $cart[$id]['quantity']++;
        } else {
            // ប្រសិនបើមិនទាន់មាន បង្កើត Item ថ្មីក្នុង Session
            $cart[$id] = [
                "name" => $product->name,
                "quantity" => 1,
                "price" => $product->price,
                "image" => $product->image
            ];
        }

        session()->put('cart', $cart);
        return redirect()->back()->with('success', 'បានបន្ថែមទៅក្នុងកន្ត្រកជោគជ័យ!');
    }

    /**
     * កែសម្រួលចំនួនទំនិញក្នុងកន្ត្រក (AJAX ឬ Form)
     */
    public function update(Request $request)
    {
        if($request->id && $request->quantity) {
            $cart = session()->get('cart');

            if(isset($cart[$request->id])) {
                $cart[$request->id]["quantity"] = $request->quantity;
                session()->put('cart', $cart);
                return response()->json(['success' => true]);
            }
        }

        return response()->json(['success' => false], 400);
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
    public function checkout(Request $request)
    {
        $cart = session()->get('cart');

        if (!$cart) {
            return redirect()->back()->with('error', 'កន្ត្រកទំនិញរបស់អ្នកនៅទទេ!');
        }

        // ប្រើ Transaction ដើម្បីធានាថាទិន្នន័យចូលទាំង Order និង OrderItem
        DB::beginTransaction();
        try {
            // ១. បង្កើតទិន្នន័យ Order
            $order = Order::create([
                'user_id' => Auth::id(),
                'total_amount' => $this->calculateTotal($cart),
                'status' => 'pending',
            ]);

            // ២. បញ្ចូលទំនិញនីមួយៗទៅក្នុង OrderItem និងកាត់ស្តុក
            foreach ($cart as $id => $details) {
                OrderItem::create([
                    'order_id' => $order->id,
                    'product_id' => $id,
                    'quantity' => $details['quantity'],
                    'price' => $details['price'],
                ]);

                // កាត់ស្តុកផលិតផល
                $product = Product::find($id);
                if ($product) {
                    if($product->qty < $details['quantity']) {
                        throw new \Exception("ផលិតផល {$product->name} មិនគ្រប់គ្រាន់ក្នុងស្តុកទេ!");
                    }
                    $product->decrement('qty', $details['quantity']);
                }
            }

            DB::commit();

            // លុប Cart ចេញពី Session ក្រោយទិញរួច
            session()->forget('cart');

            return redirect()->route('home')->with('success', 'ការបញ្ជាទិញរបស់អ្នកត្រូវបានទទួលយក!');

        } catch (\Exception $e) {
            DB::rollBack();
            return redirect()->back()->with('error', 'មានបញ្ហា៖ ' . $e->getMessage());
        }
    }

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

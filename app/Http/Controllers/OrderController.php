<?php

namespace App\Http\Controllers;

// ប្តូរមកប្រើ Base Controller របស់ Laravel វិញ

use App\Http\Controllers\Api\AuthController;
use App\Http\Controllers\Controller;
use App\Models\Order;
use App\Models\OrderItem;
use App\Models\Cart;
use App\Models\Product;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

class OrderController extends AuthController
{
    /**
     * បង្ហាញបញ្ជីប្រវត្តិបញ្ជាទិញ (Order History)
     */
  public function index()
    {
        // ទាញយក Order ទាំងអស់ រួមទាំងព័ត៌មាន User (ប្រើ pagination ដើម្បីឱ្យស្រួលមើល)
        $orders = Order::with('user')->latest()->paginate(10);
        return view('admin.orders.index', compact('orders'));
    }
    /**
     * បង្ហាញព័ត៌មានលម្អិតនៃវិក្កយបត្រនីមួយៗ (Order Details)
     */

public function show($id)
    {
        // ទាញយក Order រួមជាមួយ Items និង ផលិតផលនៅក្នុង Item នីមួយៗ
        $order = Order::with(['orderItems.product', 'user'])->findOrFail($id);
        return view('admin.orders.show', compact('order'));
    }
    /**
     * មុខងារបញ្ចប់ការបញ្ជាទិញ (Checkout Process)
     */
public function checkout(Request $request)
{
    // Validate ទិន្នន័យដែលផ្ញើមកពី Form
    $request->validate([
        'address' => 'required|string|min:5',
        'phone'   => 'required|string|min:9',
    ]);

    $user = Auth::user();
    $cart = Cart::where('user_id', $user->id)->with('items.product')->first();

    if (!$cart || $cart->items->isEmpty()) {
        return redirect()->back()->with('error', 'កន្ត្រកទំនិញរបស់អ្នកទទេ!');
    }

    DB::beginTransaction();
    try {
        $totalAmount = $cart->items->sum(function($item) {
            return $item->price * $item->quantity;
        });

        // បង្កើត Order ថ្មីចូល Table orders
        $order = Order::create([
            'user_id'      => $user->id,
            'total_amount' => $totalAmount,
            'status'       => 'pending',
            'address'      => $request->address,
            'phone'        => $request->phone, // ប្រាកដថាមាន field នេះក្នុង migration & model
        ]);

        // រុញទំនិញនីមួយៗចូល Table order_items
        foreach ($cart->items as $cartItem) {
            OrderItem::create([
                'order_id'   => $order->id,
                'product_id' => $cartItem->product_id,
                'quantity'   => $cartItem->quantity,
                'price'      => $cartItem->price,
            ]);

            // កាត់ស្តុកផលិតផល
            $cartItem->product->decrement('qty', $cartItem->quantity);
        }

        // លុបកន្ត្រកទំនិញក្រោយទិញរួច
        $cart->items()->delete();
        $cart->delete();

        DB::commit();
        return redirect()->route('orders.index')->with('success', 'ការបញ្ជាទិញទទួលបានជោគជ័យ!');

    } catch (\Exception $e) {
        DB::rollBack();
        return redirect()->back()->with('error', 'មានបញ្ហា៖ ' . $e->getMessage());
    }
}   /**
     * សម្រាប់ Admin មើលការបញ្ជាទិញទាំងអស់
     */
    public function adminIndex()
    {
        $orders = Order::with(['user', 'items.product'])->latest()->get();
        return view('admin.orders.index', compact('orders'));
    }

    /**
     * សម្រាប់ Admin ប្តូរស្ថានភាពវិក្កយបត្រ
     */
   public function updateStatus(Request $request, $id)
    {
        $request->validate([
            'status' => 'required|in:pending,processing,shipped,delivered,cancelled'
        ]);

        $order = Order::findOrFail($id);
        $order->update(['status' => $request->status]);

        return redirect()->back()->with('success', 'Order status updated successfully!');
    }
}

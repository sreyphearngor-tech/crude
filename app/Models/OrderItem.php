<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class OrderItem extends Model
{
    use HasFactory;

    protected $fillable = ['order_id', 'product_id', 'quantity', 'price'];

    // ទំនាក់ទំនងត្រឡប់ទៅកាន់ Order វិញ
    public function order()
    {
        return $this->belongsTo(Order::class);
    }

    // ទំនាក់ទំនងទៅកាន់ Product ដើម្បីដឹងថាជាទំនិញអ្វី
    public function product()
    {
        return $this->belongsTo(Product::class);
    }
}

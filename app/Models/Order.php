<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Order extends Model
{
    use HasFactory;

    // បន្ថែម Field ថ្មីៗចូលទៅទីនេះ
    protected $fillable = [
        'user_id',
        'total_amount',
        'status',
        'shipping_name',
        'shipping_phone',
        'shipping_address',
        'payment_method'
    ];

    // ទំនាក់ទំនងទៅកាន់ User (អ្នកទិញ)
    public function user()
    {
        return $this->belongsTo(User::class);
    }

    // ទំនាក់ទំនងទៅកាន់ OrderItems (មុខទំនិញច្រើនក្នុង Order តែមួយ)
    public function items()
    {
        return $this->hasMany(OrderItem::class);
    }
}

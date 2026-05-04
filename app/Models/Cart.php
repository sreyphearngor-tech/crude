<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{
    protected $fillable = ['user_id', 'product_id', 'quantity'];

    // ទំនាក់ទំនងទៅកាន់ផលិតផល
    public function product()
    {
        return $this->belongsTo(Product::class);
    }

    // ទំនាក់ទំនងទៅកាន់អ្នកប្រើប្រាស់
    public function user()
    {
        return $this->belongsTo(User::class);
    }
}

?>

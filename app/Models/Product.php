<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    use HasFactory;

    /**
     * កំណត់ឈ្មោះ Field ដែលអនុញ្ញាតឱ្យបញ្ចូលទិន្នន័យបាន (Mass Assignment)
     * រួមបញ្ចូលទាំង Field សម្រាប់រូបភាពទាំង ៤ សន្លឹកដែលអ្នកបានប្រើក្នុង Controller
     */
    protected $fillable = [
        'category_id',
        'name',
        'price',
        'qty',
        'description',
        'image',
        'image2',
        'image3',
        'image4',
    ];

    /**
     * ទំនាក់ទំនងទៅកាន់ Category (Many-to-One)
     * ផលិតផលនីមួយៗ ស្ថិតក្នុងប្រភេទ (Category) តែមួយគត់
     */
    public function category()
    {
        return $this->belongsTo(Category::class);
    }

    /**
     * ទំនាក់ទំនងទៅកាន់ OrderItem (One-to-Many)
     * ផលិតផលមួយ អាចមាននៅក្នុងការកុម្ម៉ង់ច្រើនដង (Order Items)
     */
    public function orderItems()
    {
        return $this->hasMany(OrderItem::class);
    }

    /**
     * Scope សម្រាប់ឆែកផលិតផលដែលអស់ពីស្តុក (ប្រើក្នុង Dashboard)
     */
    public function scopeOutOfStock($query)
    {
        return $query->where('qty', '<=', 0);
    }
}

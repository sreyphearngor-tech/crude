<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Category extends Model
{
    use HasFactory;

    protected $fillable = ['name', 'slug', 'image']; // ប្តូរពី icon មក image

    public function products()
    {
        return $this->hasMany(Product::class);
    }
}

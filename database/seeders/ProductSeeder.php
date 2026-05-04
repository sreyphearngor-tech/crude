<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
  public function run(): void
{
    \App\Models\Product::create([
        'name' => 'HAVIT HV-G92 Gamepad',
        'price' => 160,
        'sale_price' => 120,
        'discount_percent' => 40,
        'image' => 'images/gamepad.png',
        'reviews' => 88
    ]);
    // បន្ថែមផលិតផលផ្សេងទៀតតាមរូបភាព...
}
}

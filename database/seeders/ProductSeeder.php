<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class ProductSeeder extends Seeder
{
    public function run(): void
    {
        DB::table('products')->insert([
            [
                'name' => 'Laptop',
                'price' => 800.00,
                'qty' => 10,
                'image' => '',
       
            ],
            [
                'name' => 'Phone',
                'price' => 500.00,
                'qty' => 20,
                'image' => '',
              
            ]
        ]);
    }
}
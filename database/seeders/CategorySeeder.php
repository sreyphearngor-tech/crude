<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Category; // កុំភ្លេច use Model ផង

class CategorySeeder extends Seeder
{
    public function run(): void
    {
        $categories = [
            ['name' => 'Women', 'slug' => 'women'],
            ['name' => 'Men', 'slug' => 'men'],
            ['name' => 'Kids', 'slug' => 'kids'],
        ];

        foreach ($categories as $category) {
            Category::create($category);
        }
    }
}

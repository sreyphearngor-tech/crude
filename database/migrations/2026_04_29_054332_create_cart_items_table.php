<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
public function up(): void
{
    Schema::create('cart_items', function (Blueprint $table) {
        $table->id();
        // ភ្ជាប់ទៅកាន់ table carts
        $table->foreignId('cart_id')->constrained()->onDelete('cascade');
        // ភ្ជាប់ទៅកាន់ table products
        $table->foreignId('product_id')->constrained()->onDelete('cascade');

        $table->integer('quantity')->default(1);
        $table->decimal('price', 10, 2); // រក្សាតម្លៃទុកការពារពេល product ប្តូរតម្លៃ
        $table->timestamps();
    });
}
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('cart_items');
    }
};

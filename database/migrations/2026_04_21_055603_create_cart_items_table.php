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
        // Links to the 'carts' table
        $table->foreignId('cart_id')->constrained()->onDelete('cascade');
        // Links to your 'products' table
        $table->foreignId('product_id')->constrained()->onDelete('cascade');
        // Stores how many of the product are in the cart
        $table->integer('quantity')->default(1);
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

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
   public function up()
{
    Schema::create('order_items', function (Blueprint $table) {
        $table->id();
        // ភ្ជាប់ទៅកាន់ Order មេ
        $table->foreignId('order_id')->constrained()->onDelete('cascade');

        // ភ្ជាប់ទៅកាន់ផលិតផល
        $table->foreignId('product_id')->constrained()->onDelete('cascade');

        $table->integer('quantity'); // ចំនួនដែលបានទិញ
        $table->decimal('price', 10, 2); // តម្លៃផលិតផលនៅពេលទិញ (ការពារករណីផលិតផលឡើងថ្លៃថ្ងៃក្រោយ)

        $table->timestamps();
    });
}
    public function down(): void
    {
        Schema::dropIfExists('order_items');
    }
};

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
    Schema::create('carts', function (Blueprint $table) {
        $table->id();
        // foreignId creates the user_id column
        // constrained() links it to the 'id' on 'users' table
        // cascade on delete means if a user is deleted, their cart is too
        $table->foreignId('user_id')->constrained()->onDelete('cascade');
        $table->timestamps();
    });
}

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('carts');
    }
};

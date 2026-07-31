<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('categories', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique(); // ឈ្មោះប្រភេទផលិតផល (ឧទាហរណ៍៖ កាបូប, ស្បែកជើង)
            $table->string('slug')->nullable(); // សម្រាប់ប្រើក្នុង URL (Optional)
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('categories');
    }
};

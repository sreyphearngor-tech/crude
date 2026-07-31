<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up()
    {
        Schema::create('orders', function (Blueprint $table) {
            $table->id();
            // ភ្ជាប់ទៅកាន់ User (អ្នកទិញ)
            $table->foreignId('user_id')->constrained()->onDelete('cascade');

            // តម្លៃសរុប (ឧទាហរណ៍៖ 999,999.99)
            $table->decimal('total_amount', 10, 2);

            // ស្ថានភាពនៃការបញ្ជាទិញ
            $table->string('status')->default('pending'); // pending, completed, cancelled

            // --- បន្ថែមព័ត៌មានដឹកជញ្ជូន និងការទូទាត់ប្រាក់ (លំហូរថ្មី) ---
            $table->string('shipping_name')->nullable();
            $table->string('shipping_phone')->nullable();
            $table->text('shipping_address')->nullable();
            $table->string('payment_method')->nullable();

            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('orders');
    }
};

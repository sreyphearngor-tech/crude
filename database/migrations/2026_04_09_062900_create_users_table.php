<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('users', function (Blueprint $table) {
            $table->id(); // Primary key
            $table->string('name', 100);
            $table->string('email', 191)->unique(); // safe for utf8mb4
            $table->string('password');
          $table->enum('role', ['admin', 'client', 'user'])->default('user');// fixed role
            $table->rememberToken(); // for login sessions
            $table->timestamps(); // created_at & updated_at
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('users');
    }
};

<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
   public function up()
{
    Schema::table('products', function (Blueprint $table) {
        $table->boolean('is_best_selling')->default(false); // បន្ថែម Column នេះ
    });
}

public function down()
{
    Schema::table('products', function (Blueprint $table) {
        $table->dropColumn('is_best_selling');
    });
}
};

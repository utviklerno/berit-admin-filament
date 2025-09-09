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
        Schema::create('user_items', function (Blueprint $table) {
            $table->id();
            $table->integer('id_user');
            $table->integer('id_product_type');
            $table->integer('id_product_type_item');
            $table->integer('id_user_location');
            $table->integer('pri');

            $table->string('name');
            $table->string('description')->nullable();
            $table->integer('active');
            $table->integer('price');
            $table->string('price_interval_type'); // hour,day,week,month,year
            $table->integer('price_interval_count'); // 1 - hour .. 2 - day ..
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('user_items');
    }
};

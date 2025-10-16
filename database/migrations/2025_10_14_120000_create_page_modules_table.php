<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('page_modules', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained()->cascadeOnDelete();
            $table->string('title')->nullable();
            $table->string('type');
            $table->unsignedInteger('priority')->default(0);
            $table->longText('html')->nullable();
            $table->json('json')->nullable();
            $table->timestamps();

            $table->index(['page_id', 'priority']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('page_modules');
    }
};

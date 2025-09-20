<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('pages', function (Blueprint $table) {
            $table->id();
            $table->string('pagename')->unique();

            // Default meta fields (fallbacks for all languages)
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('meta_image')->nullable(); // path or URL to sharing image

            $table->timestamps();

            $table->index('pagename');
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('pages');
    }
};


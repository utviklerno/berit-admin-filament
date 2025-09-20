<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('subpages', function (Blueprint $table) {
            $table->id();
            $table->foreignId('page_id')->constrained('pages')->cascadeOnDelete();

            // Hierarchy within a page
            $table->unsignedBigInteger('pid')->nullable(); // Parent Subpage ID
            $table->foreign('pid')->references('id')->on('subpages')->nullOnDelete();

            // Language of this subpage entry
            $table->foreignId('language_id')->constrained('languages')->cascadeOnDelete();

            // Content
            $table->string('title');
            $table->text('description')->nullable();

            // Optional meta fields (fallback to page defaults if null)
            $table->string('meta_title')->nullable();
            $table->text('meta_description')->nullable();
            $table->json('meta_keywords')->nullable();
            $table->string('meta_image')->nullable();

            $table->timestamps();

            $table->index(['page_id', 'language_id']);
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('subpages');
    }
};


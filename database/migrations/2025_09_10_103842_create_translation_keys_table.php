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
        Schema::create('translation_keys', function (Blueprint $table) {
            $table->id();
            
            // Core Key Information
            $table->foreignId('category_id')->constrained('translation_categories')->cascadeOnDelete();
            $table->string('key', 200); // parking, long_term_parking, first_name, etc.
            $table->string('full_key', 300)->unique(); // categories.parking, navigation.back, etc.
            $table->text('description')->nullable(); // What this key represents
            $table->string('type', 20)->default('text'); // text, html, markdown, json, number
            
            // Context & Usage
            $table->string('context', 100)->nullable(); // Where it's used: forms, buttons, menus
            $table->text('example_usage')->nullable(); // Example of how it's used
            $table->string('placeholder_text')->nullable(); // Placeholder for translators
            $table->integer('character_limit')->nullable(); // Max characters for UI constraints
            
            // Organization
            $table->integer('sort_order')->default(0);
            $table->boolean('is_required')->default(true); // Must have translations
            $table->boolean('is_system')->default(false); // System keys that can't be deleted
            $table->boolean('is_active')->default(true);
            $table->boolean('is_deprecated')->default(false); // Old keys marked for removal
            
            // Translation Status
            $table->integer('translation_count')->default(0); // Cache count of translations
            $table->float('completion_percentage', 5, 2)->default(0.00); // Translation completion %
            $table->timestamp('last_translated_at')->nullable(); // Last translation update
            
            // References & Dependencies
            $table->json('related_keys')->nullable(); // Related translation keys
            $table->json('variables')->nullable(); // Variables used in this key (e.g., :name, :count)
            $table->string('fallback_key', 200)->nullable(); // Fallback if this key is missing
            
            // Management
            $table->unsignedBigInteger('created_by')->nullable();
            $table->unsignedBigInteger('updated_by')->nullable();
            $table->text('notes')->nullable(); // Notes for translators
            $table->json('metadata')->nullable(); // Additional flexible data
            
            $table->timestamps();
            
            // Indexes
            $table->index(['category_id', 'sort_order']);
            $table->index(['is_active', 'is_required']);
            $table->index('completion_percentage');
            $table->index('full_key');
            $table->unique(['category_id', 'key']); // Unique within category
            
            // Foreign keys
            $table->foreign('created_by')->references('id')->on('admin_users')->nullOnDelete();
            $table->foreign('updated_by')->references('id')->on('admin_users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('translation_keys');
    }
};

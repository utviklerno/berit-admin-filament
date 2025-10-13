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
        Schema::create('translation_categories', function (Blueprint $table) {
            $table->id();
            
            // Basic Information
            $table->string('key', 100)->unique(); // categories, navigation, profile_menu, etc.
            $table->string('name', 150); // Human readable name: "Categories", "Navigation"
            $table->text('description')->nullable(); // Description of what this category contains
            $table->string('icon', 50)->nullable(); // Icon for UI display
            $table->string('color', 20)->nullable(); // Color for UI categorization
            
            // Organization
            $table->string('group', 50)->nullable(); // Group related categories: UI, Content, System
            $table->integer('sort_order')->default(0);
            $table->boolean('is_system')->default(false); // System categories that can't be deleted
            $table->boolean('is_active')->default(true);
            
            // Translation Management
            $table->integer('total_keys')->default(0); // Cache count of keys in this category
            $table->float('completion_percentage', 5, 2)->default(0.00); // Overall completion %
            $table->timestamp('last_updated_at')->nullable(); // Last time any key was updated
            $table->unsignedBigInteger('created_by')->nullable(); // Admin who created this
            $table->unsignedBigInteger('updated_by')->nullable(); // Admin who last updated
            
            // Metadata
            $table->json('settings')->nullable(); // Category-specific settings
            $table->text('notes')->nullable(); // Admin notes
            
            $table->timestamps();
            
            // Indexes
            $table->index(['is_active', 'sort_order']);
            $table->index('group');
            $table->index('completion_percentage');
            
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
        Schema::dropIfExists('translation_categories');
    }
};

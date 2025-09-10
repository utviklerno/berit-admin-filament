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
        Schema::create('languages', function (Blueprint $table) {
            $table->id();
            
            // Core Language Information
            $table->string('name', 100); // English, Norwegian, etc.
            $table->string('native_name', 100); // English, Norsk, etc.
            $table->string('code', 5)->unique(); // en, no, sv, etc.
            $table->string('iso_code', 3)->nullable(); // ISO 639-1 standard
            $table->string('flag_emoji', 10)->nullable(); // 🇳🇴, 🇺🇸, etc.
            $table->string('flag_icon', 50)->nullable(); // Path to flag image
            
            // Status & Behavior
            $table->boolean('is_active')->default(true);
            $table->boolean('is_default')->default(false);
            $table->boolean('is_rtl')->default(false); // Right-to-left text direction
            $table->boolean('is_fallback')->default(false); // Fallback when translation missing
            $table->integer('sort_order')->default(0);
            $table->float('completion_percentage', 5, 2)->default(0.00); // Translation completion %
            
            // Regional & Cultural Settings
            $table->string('region', 50)->nullable(); // Nordic, Europe, North America
            $table->string('country_code', 2)->nullable(); // NO, US, SE, etc.
            $table->string('timezone', 50)->default('UTC'); // Europe/Oslo, America/New_York
            $table->integer('first_day_of_week')->default(1); // 0=Sunday, 1=Monday
            
            // Currency & Financial
            $table->string('currency_code', 3)->nullable(); // NOK, USD, EUR, SEK
            $table->string('currency_symbol', 10)->nullable(); // kr, $, €
            $table->string('currency_position', 10)->default('after'); // before, after
            $table->boolean('currency_space')->default(true); // Space between number and symbol
            $table->integer('currency_decimals')->default(2); // Decimal places for currency
            
            // Number & Date Formatting
            $table->string('decimal_separator', 5)->default('.'); // . or ,
            $table->string('thousands_separator', 5)->default(','); // , or space or .
            $table->string('date_format', 20)->default('Y-m-d'); // PHP date format
            $table->string('time_format', 20)->default('H:i'); // PHP time format
            $table->string('datetime_format', 30)->default('Y-m-d H:i'); // Combined format
            
            // Advanced Locale Settings
            $table->string('locale_code', 10)->nullable(); // en_US, nb_NO, etc.
            $table->string('collation', 50)->nullable(); // utf8mb4_norwegian_ci, etc.
            $table->json('plural_rules')->nullable(); // Complex plural rules for different languages
            $table->json('date_names')->nullable(); // Month/day names in native language
            
            // Translation Management
            $table->timestamp('last_updated_at')->nullable(); // Last translation update
            $table->unsignedBigInteger('updated_by')->nullable(); // User who last updated
            $table->text('notes')->nullable(); // Admin notes about this language
            $table->json('metadata')->nullable(); // Additional flexible data storage
            
            $table->timestamps();
            
            // Indexes for performance
            $table->index(['is_active', 'sort_order']);
            $table->index('is_default');
            $table->index('code');
            $table->index('completion_percentage');
            
            // Foreign key for updated_by (assuming admin_users table)
            $table->foreign('updated_by')->references('id')->on('admin_users')->nullOnDelete();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('languages');
    }
};

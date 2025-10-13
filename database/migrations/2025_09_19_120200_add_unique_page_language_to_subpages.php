<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::table('subpages', function (Blueprint $table) {
            $table->unique(['page_id', 'language_id'], 'subpages_page_language_unique');
        });
    }

    public function down(): void
    {
        Schema::table('subpages', function (Blueprint $table) {
            $table->dropUnique('subpages_page_language_unique');
        });
    }
};


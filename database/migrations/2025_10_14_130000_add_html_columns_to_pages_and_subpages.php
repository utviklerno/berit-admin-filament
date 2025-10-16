<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration {
    public function up(): void
    {
        Schema::table('pages', function (Blueprint $table) {
            $table->longText('html')->nullable()->after('meta_image');
        });

        Schema::table('subpages', function (Blueprint $table) {
            $table->longText('html')->nullable()->after('description');
        });
    }

    public function down(): void
    {
        Schema::table('subpages', function (Blueprint $table) {
            $table->dropColumn('html');
        });

        Schema::table('pages', function (Blueprint $table) {
            $table->dropColumn('html');
        });
    }
};

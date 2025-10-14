<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Str;

return new class extends Migration {
    public function up(): void
    {
        Schema::create('menu_item_slugs', function (Blueprint $table) {
            $table->id();
            $table->foreignId('menu_item_id')->constrained()->cascadeOnDelete();
            $table->foreignId('language_id')->constrained()->cascadeOnDelete();
            $table->string('slug');
            $table->timestamps();

            $table->unique(['menu_item_id', 'language_id']);
            $table->index('slug');
        });

        $defaultLanguageId = DB::table('languages')
            ->where('is_default', true)
            ->value('id');

        if (! $defaultLanguageId) {
            return;
        }

        $now = now();

        $existingSlugs = DB::table('menu_items')
            ->select('id', 'slug')
            ->whereNotNull('slug')
            ->get()
            ->map(fn ($item) => [
                'menu_item_id' => $item->id,
                'language_id' => $defaultLanguageId,
                'slug' => Str::slug($item->slug),
                'created_at' => $now,
                'updated_at' => $now,
            ])
            ->all();

        if (! empty($existingSlugs)) {
            DB::table('menu_item_slugs')->insert($existingSlugs);
        }
    }

    public function down(): void
    {
        Schema::dropIfExists('menu_item_slugs');
    }
};

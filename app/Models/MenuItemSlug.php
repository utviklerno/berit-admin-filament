<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Casts\Attribute;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Str;

class MenuItemSlug extends Model
{
    protected $fillable = [
        'menu_item_id',
        'language_id',
        'slug',
    ];

    public function menuItem(): BelongsTo
    {
        return $this->belongsTo(MenuItem::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    protected function slug(): Attribute
    {
        return Attribute::make(
            set: fn ($value) => filled($value) ? Str::slug($value) : $value,
        );
    }
}

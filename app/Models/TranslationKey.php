<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TranslationKey extends Model
{
    protected $fillable = [
        'category_id', 'key', 'full_key', 'description', 'type', 'context',
        'example_usage', 'placeholder_text', 'character_limit', 'sort_order',
        'is_required', 'is_system', 'is_active', 'is_deprecated', 'translation_count',
        'completion_percentage', 'last_translated_at', 'related_keys', 'variables',
        'fallback_key', 'created_by', 'updated_by', 'notes', 'metadata'
    ];

    protected $casts = [
        'is_required' => 'boolean',
        'is_system' => 'boolean',
        'is_active' => 'boolean',
        'is_deprecated' => 'boolean',
        'completion_percentage' => 'float',
        'last_translated_at' => 'datetime',
        'related_keys' => 'array',
        'variables' => 'array',
        'metadata' => 'array',
    ];

    public function category(): BelongsTo
    {
        return $this->belongsTo(TranslationCategory::class, 'category_id');
    }

    public function translationValues(): HasMany
    {
        return $this->hasMany(TranslationValue::class);
    }
}

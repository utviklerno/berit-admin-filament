<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class TranslationCategory extends Model
{
    protected $fillable = [
        'key', 'name', 'description', 'icon', 'color', 'group', 'sort_order',
        'is_system', 'is_active', 'total_keys', 'completion_percentage',
        'last_updated_at', 'created_by', 'updated_by', 'settings', 'notes'
    ];

    protected $casts = [
        'is_system' => 'boolean',
        'is_active' => 'boolean',
        'completion_percentage' => 'float',
        'last_updated_at' => 'datetime',
        'settings' => 'array'
    ];

    public function translationKeys(): HasMany
    {
        return $this->hasMany(TranslationKey::class, 'category_id');
    }

    public function activeKeys(): HasMany
    {
        return $this->translationKeys()->where('is_active', true);
    }
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Subpage extends Model
{
    protected $fillable = [
        'page_id',
        'pid',
        'language_id',
        'title',
        'description',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
        'html',
    ];

    protected $casts = [
        'meta_keywords' => 'array',
    ];

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }

    public function parent(): BelongsTo
    {
        return $this->belongsTo(Subpage::class, 'pid');
    }

    public function children(): HasMany
    {
        return $this->hasMany(Subpage::class, 'pid');
    }

    // Fallback accessors to page defaults when subpage meta fields are null
    public function getEffectiveMetaTitleAttribute(): ?string
    {
        return $this->meta_title ?: $this->page?->meta_title;
    }

    public function getEffectiveMetaDescriptionAttribute(): ?string
    {
        return $this->meta_description ?: $this->page?->meta_description;
    }

    public function getEffectiveMetaKeywordsAttribute(): ?array
    {
        return $this->meta_keywords ?: $this->page?->meta_keywords;
    }

    public function getEffectiveMetaImageAttribute(): ?string
    {
        return $this->meta_image ?: $this->page?->meta_image;
    }
}


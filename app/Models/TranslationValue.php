<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;

class TranslationValue extends Model
{
    protected $fillable = [
        'translation_key_id', 'language_id', 'value', 'value_html', 'plural_forms',
        'status', 'is_verified', 'is_ai_generated', 'needs_review', 'quality_score',
        'context_note', 'usage_example', 'screenshot_url', 'version', 'change_reason',
        'revision_history', 'character_count', 'word_count', 'exceeds_limit',
        'translator_name', 'translator_email', 'translated_at', 'reviewed_at', 'approved_at',
        'created_by', 'updated_by', 'reviewed_by', 'approved_by', 'variables_used', 'notes', 'metadata'
    ];

    protected $casts = [
        'plural_forms' => 'array',
        'is_verified' => 'boolean',
        'is_ai_generated' => 'boolean',
        'needs_review' => 'boolean',
        'exceeds_limit' => 'boolean',
        'revision_history' => 'array',
        'variables_used' => 'array',
        'metadata' => 'array',
        'translated_at' => 'datetime',
        'reviewed_at' => 'datetime',
        'approved_at' => 'datetime',
    ];

    public function translationKey(): BelongsTo
    {
        return $this->belongsTo(TranslationKey::class);
    }

    public function language(): BelongsTo
    {
        return $this->belongsTo(Language::class);
    }
}

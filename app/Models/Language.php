<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Database\Eloquent\Builder;

class Language extends Model
{
    protected $fillable = [
        'name', 'native_name', 'code', 'iso_code', 'flag_emoji', 'flag_icon',
        'is_active', 'is_default', 'is_rtl', 'is_fallback', 'sort_order', 'completion_percentage',
        'region', 'country_code', 'timezone', 'first_day_of_week',
        'currency_code', 'currency_symbol', 'currency_position', 'currency_space', 'currency_decimals',
        'decimal_separator', 'thousands_separator', 'date_format', 'time_format', 'datetime_format',
        'locale_code', 'collation', 'plural_rules', 'date_names',
        'last_updated_at', 'updated_by', 'notes', 'metadata'
    ];

    protected $casts = [
        'is_active' => 'boolean',
        'is_default' => 'boolean',
        'is_rtl' => 'boolean',
        'is_fallback' => 'boolean',
        'completion_percentage' => 'float',
        'first_day_of_week' => 'integer',
        'currency_space' => 'boolean',
        'currency_decimals' => 'integer',
        'sort_order' => 'integer',
        'plural_rules' => 'array',
        'date_names' => 'array',
        'metadata' => 'array',
        'last_updated_at' => 'datetime',
    ];

    // Relationships
    public function translationValues(): HasMany
    {
        return $this->hasMany(TranslationValue::class);
    }

    public function menuItemSlugs(): HasMany
    {
        return $this->hasMany(MenuItemSlug::class);
    }

    public function updatedByUser(): BelongsTo
    {
        return $this->belongsTo(AdminUser::class, 'updated_by');
    }

    // Scopes
    public function scopeActive(Builder $query): Builder
    {
        return $query->where('is_active', true);
    }

    public function scopeDefault(Builder $query): Builder
    {
        return $query->where('is_default', true);
    }

    public function scopeOrdered(Builder $query): Builder
    {
        return $query->orderBy('sort_order')->orderBy('name');
    }

    // Accessors
    public function getDisplayNameAttribute(): string
    {
        $display = $this->native_name ?: $this->name;
        if ($this->flag_emoji) {
            return $this->flag_emoji . ' ' . $display;
        }
        return $display;
    }

    public function getFullDisplayAttribute(): string
    {
        return $this->display_name . ' (' . $this->code . ')';
    }

    public function getCurrencyDisplayAttribute(): string
    {
        if (!$this->currency_code) return '';
        
        $symbol = $this->currency_symbol ?: $this->currency_code;
        return $this->currency_code . ' (' . $symbol . ')';
    }

    // Methods
    public function canBeDeleted(): bool
    {
        if ($this->is_default || $this->is_fallback) {
            return false;
        }

        // Check if language has translations
        if ($this->translationValues()->count() > 0) {
            return false;
        }

        return true;
    }

    public function makeDefault(): void
    {
        // Remove default from other languages
        static::where('is_default', true)->update(['is_default' => false]);
        
        // Set this language as default
        $this->update([
            'is_default' => true, 
            'is_active' => true,
            'last_updated_at' => now()
        ]);
    }

    public function updateCompletionPercentage(): void
    {
        $totalKeys = TranslationKey::where('is_active', true)->count();
        if ($totalKeys === 0) {
            $this->completion_percentage = 0;
        } else {
            $completedKeys = $this->translationValues()
                ->whereHas('translationKey', fn($q) => $q->where('is_active', true))
                ->where('status', 'published')
                ->count();
            $this->completion_percentage = ($completedKeys / $totalKeys) * 100;
        }
        $this->save();
    }

    public function formatCurrency(float $amount): string
    {
        $formatted = number_format(
            $amount, 
            $this->currency_decimals, 
            $this->decimal_separator, 
            $this->thousands_separator
        );

        $symbol = $this->currency_symbol ?: $this->currency_code;
        $space = $this->currency_space ? ' ' : '';

        return $this->currency_position === 'before' 
            ? $symbol . $space . $formatted
            : $formatted . $space . $symbol;
    }

    public function formatDate($date, string $format = null): string
    {
        $format = $format ?: $this->date_format;
        return $date->format($format);
    }

    // Boot method
    protected static function boot()
    {
        parent::boot();

        // Ensure only one default language
        static::saving(function ($language) {
            if ($language->is_default) {
                static::where('id', '!=', $language->id)
                    ->where('is_default', true)
                    ->update(['is_default' => false]);
            }
        });

        // Prevent deletion of default language
        static::deleting(function ($language) {
            if ($language->is_default) {
                throw new \Exception('Cannot delete the default language. Please set another language as default first.');
            }
            if (!$language->canBeDeleted()) {
                throw new \Exception('Cannot delete this language. It has existing translations.');
            }
        });
    }
}

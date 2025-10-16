<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\BelongsTo;
use Illuminate\Support\Arr;

class PageModule extends Model
{
    protected $fillable = [
        'page_id',
        'title',
        'type',
        'priority',
        'html',
        'json',
    ];

    protected $casts = [
        'json' => 'array',
    ];

    public const TYPE_RICH_TEXT = 'rich_text';
    public const TYPE_HEADER = 'header';

    public static function availableTypes(): array
    {
        return [
            self::TYPE_RICH_TEXT => 'Rich text',
            self::TYPE_HEADER => 'Header',
        ];
    }

    public function page(): BelongsTo
    {
        return $this->belongsTo(Page::class);
    }

    protected static function booted(): void
    {
        static::saving(function (PageModule $module): void {
            $module->syncDerivedFields();
        });
    }

    public function syncDerivedFields(): void
    {
        if ($this->type === self::TYPE_HEADER) {
            $headerText = trim((string) Arr::get($this->json, 'header_text'));
            $this->html = $headerText !== '' ? sprintf('<h2>%s</h2>', e($headerText)) : null;
        }
    }

    public function toRenderableArray(): array
    {
        return [
            'id' => $this->id,
            'title' => $this->title,
            'type' => $this->type,
            'priority' => $this->priority,
            'html' => $this->html,
            'data' => $this->json ?? [],
        ];
    }
}

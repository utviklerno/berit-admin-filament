<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Page extends Model
{
    protected $fillable = [
        'pagename',
        'meta_title',
        'meta_description',
        'meta_keywords',
        'meta_image',
        'html',
    ];

    protected $casts = [
        'meta_keywords' => 'array',
    ];

    public function subpages(): HasMany
    {
        return $this->hasMany(Subpage::class);
    }

    public function menuItems(): HasMany
    {
        return $this->hasMany(MenuItem::class);
    }
}


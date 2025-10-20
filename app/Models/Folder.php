<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\Relations\HasMany;

class Folder extends Model
{
    protected $fillable = [
        'title',
        'description',
    ];

    public function files(): HasMany
    {
        return $this->hasMany(File::class);
    }
}

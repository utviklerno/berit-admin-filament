<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserItemImage extends Model
{
    protected $fillable = [
        'user_item_id',
        'image',
        'description',
    ];

    public function userItem()
    {
        return $this->belongsTo(UserItem::class);
    }
}

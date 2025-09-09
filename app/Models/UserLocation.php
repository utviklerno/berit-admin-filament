<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    protected $fillable = [
        'user_id',
        'primary_location',
        'name',
        'street_address',
        'unit_number',
        'city',
        'state',
        'postal_code',
        'country',
        'phone',
        'is_primary',
        'delivery_instructions',
        'latitude',
        'longitude',
    ];

    protected $casts = [
        'is_primary' => 'boolean',
        'latitude' => 'decimal:8',
        'longitude' => 'decimal:8',
    ];

    public function user()
    {
        return $this->belongsTo(User::class);
    }

    public function items()
    {
        return $this->hasMany(UserItem::class, 'id_user_location');
    }
}

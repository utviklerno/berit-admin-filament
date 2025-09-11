<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserItem extends Model
{
    protected $fillable = [
        'id_user',
        'id_product_type',
        'id_product_type_item',
        'id_user_location',
        'pri',
        'name',
        'description',
        'active',
        'price',
        'price_interval_type',
        'price_interval_count',
        'images',
    ];

    protected $casts = [
        'active' => 'boolean',
        'images' => 'json',
    ];

    public function user()
    {
        return $this->belongsTo(User::class, 'id_user');
    }

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'id_product_type');
    }

    public function productTypeItem()
    {
        return $this->belongsTo(ProductTypeItem::class, 'id_product_type_item');
    }

    public function location()
    {
        return $this->belongsTo(UserLocation::class, 'id_user_location');
    }

    public function images()
    {
        return $this->hasMany(UserItemImage::class);
    }
}

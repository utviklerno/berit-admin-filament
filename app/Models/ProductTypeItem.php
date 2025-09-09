<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeItem extends Model
{
    protected $fillable = [
        'product_id',
        'type_id',
        'name',
        'description',
        'price'
    ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'type_id');
    }

    public function userItems()
    {
        return $this->hasMany(UserItem::class, 'id_product_type_item');
    }
}

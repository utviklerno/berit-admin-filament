<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    protected $fillable = [
        'name',
        'price'
    ];

    public function items()
    {
        return $this->hasMany(ProductTypeItem::class, 'type_id');
    }

    public function userItems()
    {
        return $this->hasMany(UserItem::class, 'id_product_type');
    }
}

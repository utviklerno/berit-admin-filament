<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductTypeItem extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'product_type_id',
        'name',
        'description',
        'pri',
        'price'
    ];

    public function productType()
    {
        return $this->belongsTo(ProductType::class, 'product_type_id');
    }

    public function userItems()
    {
        return $this->hasMany(UserItem::class, 'id_product_type_item');
    }
}

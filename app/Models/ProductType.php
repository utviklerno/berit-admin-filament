<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ProductType extends Model
{
    public $timestamps = false;
    
    protected $fillable = [
        'name',
        'pri',
        'description'
    ];

    public function items()
    {
        return $this->hasMany(ProductTypeItem::class, 'product_type_id');
    }

    public function userItems()
    {
        return $this->hasMany(UserItem::class, 'id_product_type');
    }
}

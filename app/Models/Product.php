<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Product extends Model
{
    protected $fillable = [
        'product_name',
        'price',
        'unit',
        'img_url',
        'user_id',
        'category_id'
    ];
    public function saleItems(){
        return $this->hasMany(SaleItem::class);
    }
}

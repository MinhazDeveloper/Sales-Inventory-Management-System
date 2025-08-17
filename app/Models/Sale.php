<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Sale extends Model
{
    protected $fillable = [
        'customer_name',
        'total_amount',
        'sale_date',
        'user_id',
    ];
    public function items(){
        return $this->hasMany(SaleItem::class);
    }
}

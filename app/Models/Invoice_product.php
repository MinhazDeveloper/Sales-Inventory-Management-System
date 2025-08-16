<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Invoice_product extends Model
{
    protected $fillable = [
        'quantity',
        'sale_price',
        'invoice_id',
        'product_id',
        'user_id',
    ];
}

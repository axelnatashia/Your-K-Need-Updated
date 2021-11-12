<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class CheckoutDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'checkout_id',
        'note',
        'seller_product_id',
        'qty',
        'price',
        'total_price',
        'status',
    ];

    public function seller_product(){
        return $this->belongsTo('App\Models\SellerProduct');
    }

    public function checkout(){
        return $this->belongsTo('App\Models\Checkout');
    }
}

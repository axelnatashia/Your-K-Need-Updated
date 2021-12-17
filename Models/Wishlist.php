<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Wishlist extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'seller_product_id',
    ];

    public function buyer(){
        return $this->belongsTo('App\Models\Buyer');
    }

    public function seller_product(){
        return $this->belongsTo('App\Models\SellerProduct');
    }
}

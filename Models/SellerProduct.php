<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class SellerProduct extends Model
{
    use HasFactory;
    protected $fillable = [
        'name',
        'description',
        'price',
        'total',
        // 'serial_number',
        'image',
        'seller_id',
    ];

    public function seller() {
        return $this->belongsTo('App\Models\Seller');
    }

    public function wishlist() {
        return $this->hasMany('App\Models\Wishlist');
    }

    public function cart() {
        return $this->hasMany('App\Models\Cart');
    }

    public function checkout_detail() {
        return $this->hasMany('App\Models\CheckoutDetail');
    }

}

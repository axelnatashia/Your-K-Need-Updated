<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Checkout extends Model
{
    use HasFactory;
    protected $fillable = [
        'code',
        'status',
        'total_payment',
        'already_paid',
        // 'note',
        'arrival_date',
        'payment_method_id',
        'buyer_id',
    ];

    public function buyer(){
        return $this->belongsTo('App\Models\Buyer');
    }

    public function payment_method(){
        return $this->belongsTo('App\Models\PaymentMethod');
    }

    public function seller_product(){
        return $this->belongsTo('App\Models\SellerProduct');
    }

    public function checkout_detail(){
        return $this->hasMany('App\Models\CheckoutDetail');
    }
}

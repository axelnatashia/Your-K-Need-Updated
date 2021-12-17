<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Paylater extends Model
{
    use HasFactory;
    protected $fillable = [
        'buyer_id',
        'balance',
        'status',
        'identity_number',
        'identity_card_img',
        'selfie',
    ];

    public function buyer(){
        return $this->belongsTo('App\Models\Buyer');
    }
}

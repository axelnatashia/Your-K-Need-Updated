<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{
    use HasFactory;
    protected $fillable = [
        'admin_id',
        'buyer_id',
        'seller_id',
    ];

    public function chat_detail() {
        return $this->hasMany('App\Models\ChatDetail');
    }

    public function admin() {
        return $this->belongsTo('App\Models\Admin');
    }

    public function seller() {
        return $this->belongsTo('App\Models\Seller');
    }

    public function buyer() {
        return $this->belongsTo('App\Models\Buyer');
    }
}

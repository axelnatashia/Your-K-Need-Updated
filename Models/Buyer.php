<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;
use Illuminate\Foundation\Auth\User as Authenticatable;

class Buyer extends Authenticatable
{
    use HasFactory;
    protected $fillable = [
        'name',
        'phone_number',
        'address',
        'province',
        'avatar',
        'email',
        'username',
        'password',
    ];

    // mutator for password field
    public function setPasswordAttribute($pass){
        $this->attributes['password'] = Hash::make($pass);
    }
    public function getAuthPassword() {
        return $this->password;
    }
    public function wishlist() {
        return $this->hasMany('App\Models\Wishlist');
    }
    public function paylater() {
        return $this->hasOne('App\Models\Paylater');
    }
    public function checkout() {
        return $this->hasMany('App\Models\Checkout');
    }
}

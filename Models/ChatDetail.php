<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class ChatDetail extends Model
{
    use HasFactory;
    protected $fillable = [
        'chat_id',
        'img',
        'text',
        'from_logged',
    ];

    public function chat() {
        return $this->belongsTo('App\Models\Chat');
    }
}

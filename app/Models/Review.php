<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class review extends Model
{
    use HasFactory;

    protected $fillable=[
        'content',
        'image',
        'user_id',
        'place_id',
    ];

    public function user(){
        return $this->belongsTo(User::class);
    }

    public function place(){
        return $this->belongsTo(Place::class);
    }

}

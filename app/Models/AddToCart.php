<?php

namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class AddToCart extends Model
{
    protected $fillable=[
        'user_id',
        'product_id',
        'quiz_id',
    ];

    public function products(){
        return $this->belongsTo(Product::class,'product_id');
    }

    public function users(){
        return $this->belongsTo(User::class,'user_id');
    }
}

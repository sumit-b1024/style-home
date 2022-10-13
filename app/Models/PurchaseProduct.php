<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PurchaseProduct extends Model
{
    protected $fillable=[
        'user_id',
        'paypal_id',
        'product_id',
        'quiz_id',
    ];

    public function payments()
    {
        return $this->belongsTo(Payment::class,'payment_id');
    }

    public function products()
    {
        return $this->belongsTo(Product::class,'product_id');
    }
}

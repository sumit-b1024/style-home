<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Payment extends Model
{

    protected $fillable=[
        'purchase_id',
        'transaction_id',
        'amount',
        'payment_status',
        'currency_code',
        'token',
        'transaction_data'
    ];

    public function purchase_products()
    {
        return $this->hasMany(PurchaseProduct::class,'payment_id');
    }

}

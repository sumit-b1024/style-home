<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Subscription extends Model
{
    
    protected $fillable=[
        'title',
        'fee_amount',
        'duration',
        'size',
        'facilities',
        'image'
    ];

    public function getSubscriptionImage() 
    {
        return asset("public/uploads/{$this->image}");
        
    }
}

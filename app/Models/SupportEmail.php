<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class SupportEmail extends Model
{
    
    protected $fillable=[
        'user_id',
        'email',
        'message'
    ];

}

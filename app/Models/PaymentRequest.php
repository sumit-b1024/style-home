<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User;

class PaymentRequest extends Model
{

    protected $fillable=[
        'user_id',
        'project_detail_id',
        'title',
        'message'
    ];

    public function users() {
        return $this->belongsTo( User::class, 'user_id' );
    }

    public function project_details() {
        return $this->belongsTo( ProjectDetail::class, 'project_detail_id' );
    }
}

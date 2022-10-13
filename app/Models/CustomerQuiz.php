<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class CustomerQuiz extends Model
{

    protected $fillable=[
        'user_id',
		'preferred_bedroom',
        'diningroom',
        'coffee_table',
		'home_feel',
        'home_area',
    ];

    public function users()
    {
        return $this->belongsTo(User::class,'user_id');
    }
}

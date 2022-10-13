<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizTemp extends Model
{

    protected $fillable=[
        'user_id',
		'preferred_bedroom',
        'diningroom',
        'coffee_table',
		'home_feel',
        'home_area',
    ];

    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DetailFormRoom extends Model
{
    protected $fillable=[
        'detail_form_id',
		'form_answer_id',
		'qty',
    ];
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyFormOption extends Model
{	
	
    protected $fillable=[
        'apply_form_id',
        'option_value',
    ];
}

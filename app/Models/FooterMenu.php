<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class FooterMenu extends Model
{

    protected $fillable=[
        'parent_id',
        'menu_name',
        'menu_slug',
        'status'
    ];
	
}

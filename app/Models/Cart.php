<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Cart extends Model
{

    public $table = 'enquiries';

    protected $fillable = [

        'user_id',
        'product_id',
        'quantity'
    ];
}

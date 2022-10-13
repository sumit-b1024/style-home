<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Enquiry extends Model
{

    public $table = 'enquiries';

    protected $fillable = [

        'name',
        'email',
        'subject',
        'message'
    ];
}

<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\User ; 
use App\Models\Subscription;
class DetailForm extends Model
{

    protected $fillable=[
        'user_id',
		'quiz_id',
        'project_duration',
        'country',
		'space',
		'designer',
		'subscription',
        'room',
        'amount',
        'addons_amout',
        'discount_amount',
        'discount_percentage',
        'promocode_amount',
        'grand_total',
    ];


    public function designerUser() 
    {
        return $this->belongsTo( User::class, 'designer' );
    }

            public function getSubscription()
    {
        return $this->hasOne(Subscription::class, 'id','subscription');
    }






}

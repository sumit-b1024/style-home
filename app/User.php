<?php

namespace App;

use App\Models\AddToCart;
use App\Models\Designer;
use App\Models\ProjectDetail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
    
class User extends Authenticatable
{
    const ROLE_ADMIN=1 ;
	const ROLE_CUSTOMER=2 ;
	const ROLE_DESIGNER=3 ;
    use Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'full_name',
         'email',
          'password',
          'job_location',
          'total_experiance','applied_position','nationality','age','gender','address','phone_number'
    ];

    /**
     * The attributes that should be hidden for arrays.
     *
     * @var array
     */
    protected $hidden = [
        'password', 'remember_token',
    ];

    /**
     * The attributes that should be cast to native types.
     *
     * @var array
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];


    public function getProfileImage()
    {
        return asset("public/uploads/{$this->profile_path}");

    }

    public static function getQualifications()
    {
    }


    public function getFullName() 
    {
        return $this->first_name." ".$this->last_name ; 
    }
    public function payment_requests() {
        return $this->hasMany( PaymentRequest::class, 'user_id' );
    }

    public function project_detail() {
        return $this->hasMany( ProjectDetail::class, 'user_id' );
    }

    public function designers() {
        return $this->hasMany( Designer::class, 'user_id' );
    }

    public function designer() {
        return $this->hasOne( Designer::class, 'user_id' );
    }




    public function addtocarts(){
        return $this->hasMany(AddToCart::class,'user_id');
    }

    public function cutomer_quizs(){
        return $this->hasMany(CustomerQuiz::class,'user_id');
    }


}

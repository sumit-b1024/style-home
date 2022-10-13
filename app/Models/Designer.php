<?php
namespace App\Models;

use App\User;
use Illuminate\Database\Eloquent\Model;

class Designer extends Model
{
    const TYPE_MALE=1;
    const TYPE_FEMALE=2;
    const TYPE_DECLINE=3;

	const TYPE_YES=1;
    const TYPE_NO=2;
    const TYPE_DONOT_WISH=3;

    public static function getGenders()
    {
        return [
            self::TYPE_MALE=>__('Male'),
            self::TYPE_FEMALE=>__('Female'),
            self::TYPE_DECLINE=>__('Decline To Self Identify')
        ];
    }


    public function getGender()
    {
        $list=self::getGenders();
        return isset($list[$this->gender])?$list[$this->gender]:'NA';
    }

	public static function getDisabilityStatus()
    {
        return [
            self::TYPE_YES=>__('Yes, I have a disability, or have a history/record of having a disability'),
            self::TYPE_NO=>__('No, I do not have a disability, or a history/record of having a disability'),
            self::TYPE_DONOT_WISH=>__('I do not wish to answer')
        ];
    }


    public function getDisabilityStatu()
    {
        $list=self::getDisabilityStatus();
        return isset($list[$this->disability_status])?$list[$this->disability_status]:'NA';
    }

    protected $fillable=[
        'user_id',
        'job_id',
        'apply_id',
        'first_name',
        'last_name',
        'email',
        'phone_number',
		'cv',
        'cover_letter',
        'linkedin_profile',
		'sponsorship',
		'relocation',
		'career_opportunity',
		'gender',
		'hispanic_ethnicity',
		'profile_image',
		'veteran_status',
        'disability_status',
    ];

    public function getCv()
    {
        return asset("public/uploads/cv/{$this->cv}");

    }
	public function getCoverLetter()
    {
        return asset("public/uploads/cover_letter/{$this->cover_letter}");

    }

	public function getProfileImage()
    {
        return asset("public/uploads/{$this->profile_image}");

    }

    public function users() {
        return $this->belongsTo( User::class, 'user_id' );
    }
}

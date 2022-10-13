<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Job extends Model
{
    const TYPE_ENGINEERING=1; 
    const TYPE_DESIGNER=2;
    const TYPE_CUSTOMER_EXPERIENCE=3;
    public static function getCategories() 
    {
        return [
            self::TYPE_ENGINEERING=>__('Engineering'),
            self::TYPE_DESIGNER=>__('Designer'),
            self::TYPE_CUSTOMER_EXPERIENCE=>__('Customer Experience')
        ];
    }


    public function getCategory()
    {
        $list=self::getCategories(); 
        return isset($list[$this->job_category])?$list[$this->job_category]:'NA';
    }

    protected $fillable=[
        'name',
		'slug',
        'job_category',
        'location',
		'image',
        'description',
    ];

    public function getJobImage() 
    {
        return asset("public/uploads/job/{$this->image}");
        
    }
}

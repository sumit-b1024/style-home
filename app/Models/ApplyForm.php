<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ApplyForm extends Model
{
    const TYPE_TEXT=1; 
    const TYPE_DROPDOWN=2;

	
    public static function getInputTypes() 
    {
        return [
            self::TYPE_TEXT=>__('Text Field'),
            self::TYPE_DROPDOWN=>__('Drop Down')
        ];
    }


    public function getInputType()
    {
        $list=self::getInputTypes(); 
        return isset($list[$this->type])?$list[$this->type]:'NA';
    }
	
	
    protected $fillable=[
        'name',
        'label',
        'type',
        'value',
        
    ];
}

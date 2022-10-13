<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class PageTitle extends BaseModel
{

	const TYPE_CAREER=1;
    const TYPE_APPLY_JOB=2;
    const TYPE_DESIGNER_BIO=3;
    const TYPE_DEATIL_FORM=4;
    const TYPE_PROJECT_DETAIL=5;
    const TYPE_CONTACT_US=9;
    const TYPE_FAQ=10;
    const TYPE_PROJECT_VIEW=6;
    const TYPE_PROJECT_UPDATE=7;
    const TYPE_CHAT=8;



    public static function getTypes()
    {
        return [
            self::TYPE_CAREER=>__('Career'),
            self::TYPE_APPLY_JOB=>__('Apply Job'),
            self::TYPE_DESIGNER_BIO=>__('Designer Bio'),
            self::TYPE_DEATIL_FORM=>__('Detail Form'),
            self::TYPE_PROJECT_DETAIL=>__('Project Detail'),
            self::TYPE_CONTACT_US=>__('Contact Us'),
            self::TYPE_FAQ=>__('Faq'),
            self::TYPE_PROJECT_VIEW=>__('Project View'),
            self::TYPE_PROJECT_UPDATE=>__('Project Updates'),
            self::TYPE_CHAT=>__('Chat')

        ];
    }


    public function getType()
    {
        $list=self::getTypes();
        return isset($list[$this->type])?$list[$this->type]:'NA';
    }

	protected $fillable=[
        'title',
        'type',
    ];
}

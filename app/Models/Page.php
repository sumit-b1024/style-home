<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Page extends Model
{

    const TYPE_HOMEPAGE = 0;

    const TYPE_FAQ = 1;
    
    const TYPE_CAREER =2 ;
    
    const TYPE_DESIGN_CAREER =3;
    
    const TYPE_OUR_BOOK=4;
    
    const TYPE_FINANCING=5;
    
    const TYPE_STORIES=6;
    const TYPE_PRIVACY_POLICY=7;
	const TYPE_TERMS_CONDITIONS=8;
	const TYPE_GIFT_CARD=9;
	const TYPE_REFER_EARN=10;
	const TYPE_HELP_CENTER=11;
	const TYPE_CURRENT_PROMOTION=12;
	const TYPE_REVIEW=13;
	const TYPE_PROJECT=14;
	const TYPE_HOW_IT_WORK=15;


    const SECTION_INDEX_NONE=0;
    const SECTION_INDEX_ONE = 1;

    const SECTION_INDEX_TWO = 2;

    const SECTION_INDEX_THREE = 3;

    const SECTION_INDEX_FOUR = 4;


    public function getMetaData()
    {
        return @json_decode($this->meta_data, true);
    }
}

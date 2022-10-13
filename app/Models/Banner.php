<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;
use App\BaseModel;

class Banner extends BaseModel
{
    

    
    
    public static function getTypes()
    {
        return [
            Page::TYPE_HOMEPAGE=>__('Homepage'),
            Page::TYPE_PROJECT=>__('Project'),
            /*Page::TYPE_FAQ=>__('Faq'),
            Page::TYPE_CAREER=>__('Career'),
            Page::TYPE_DESIGN_CAREER=>__('Design Career'),
            Page::TYPE_OUR_BOOK=>__('Our Book'),
            Page::TYPE_PRIVACY_POLICY=>__('Privacy Policy'),
            Page::TYPE_TERMS_CONDITIONS=>__('Terms Conditions'),
            Page::TYPE_FINANCING=>__('Financing'),
            Page::TYPE_STORIES=>__('Stories'),
            Page::TYPE_GIFT_CARD=>__('Gift Card'),
            Page::TYPE_REFER_EARN=>__('Refer & Earn'),
            Page::TYPE_HELP_CENTER=>__('Help Center'),
            Page::TYPE_CURRENT_PROMOTION=>__('Current Promotion'),
            Page::TYPE_REVIEW=>__('Review'),*/
        ];
    }
    
    public function getType() 
    {
        $types=self::getTypes();
        return isset($types[$this->type_id])?$types[$this->type_id]:'Not Defined';
    }
    
    public function getBannerUrl() 
    {
        return asset("public/uploads/{$this->path}");
        
    }
}

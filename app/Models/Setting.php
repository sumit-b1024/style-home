<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Setting extends Model
{
    protected $fillable=[
        'office_address',
        'contact_number' ,
        'fax_number' ,
        'contact_email' ,
        'admin_email' ,
        'tax',
        'facebook_page_link',
        'linkedin_page_link',
        'instagram_page_link',
        'youtube_page_link',
        'twitter_page_link',
        'pinterest_page_link',
        'site_logo' ,
        'site_footer_logo' ,
        'footer_copyright_text',
        'gmap_iframe_link'
        
    ];
    
    public function getLogoUrl()
    {
        return asset("public/uploads/site/{$this->site_logo}");
        
    }
    public function getLogoUrl2()
    {
        return asset("public/uploads/site/{$this->site_footer_logo}");
        
    }
    
}

<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class DesignerImage extends Model
{
    
    protected $fillable=[
        'user_id',
        'title',
        'filename'
    ];
	
	public function getDesignerImage() 
    {
        return asset("public/uploads/{$this->filename}");
        
    }

}

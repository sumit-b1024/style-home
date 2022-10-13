<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Testimonial extends Model
{
    
    protected $fillable=[
        'title',
        'position',
        'star',
        'image',
        'description'
    ];

    public function getTesttimonialImage() 
    {
        return asset("public/uploads/{$this->image}");
        
    }
}

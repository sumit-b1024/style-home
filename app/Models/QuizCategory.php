<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizCategory extends Model
{

    protected $fillable=[
        'title',
        'image',
        'description'
    ];

    public function getQuizCategoryImage()
    {
        return asset("public/uploads/category/{$this->image}");
    }

}

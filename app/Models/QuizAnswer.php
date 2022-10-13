<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizAnswer extends Model
{

    protected $fillable=[
        'question_id',
        'title',
        'image'
    ];
	
	public function getQuizAnswerImage() 
    {
        return asset("public/uploads/answer/{$this->image}");
        
    }
}

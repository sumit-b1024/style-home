<?php
namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class QuizResult extends Model
{
	const TYPE_QUIZ_RESULT = 1;

    protected $fillable=[
        'type_id',
        'question',
        'description',
        'image'
    ];
	
	public function getQuizResultImage() 
    {
        return asset("public/uploads/result/{$this->image}");
        
    }
}

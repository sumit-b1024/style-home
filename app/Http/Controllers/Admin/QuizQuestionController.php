<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizQuestion;
use App\Models\QuizAnswer;
use App\Models\QuizResult;
use App\User;
use File;

class QuizQuestionController extends Controller
{
    public function index() 
    {
        $models=QuizQuestion::paginate(15); 
        return view('admin.quiz-question.index')->with('models',$models) ;
    }

    public function add() 
    {
        return view('admin.quiz-question.add');
    }
    
    public function update(QuizQuestion $model) 
    {
        return view('admin.quiz-question.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,QuizQuestion $model) 
    {
        $data=$request->validate($this->getValidation());
		if(QuizQuestion::where(['title'=>$request->title])->where('id','!=',$model->id)->count())
		{
			return redirect()->back()->withError(__('Quiz Question Title already exists'));
		}
		$model->title=$request->title;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Quiz Question Updated Successfuly'));
    
    }

    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
		if(QuizQuestion::where(['title'=>$request->title])->count())
		{
			return redirect()->back()->withError(__('Quiz Question Title already exists'));
		}
        $model=new QuizQuestion() ;
        $model->fill($data);
        $model->save() ;
        
        return redirect()->back()->withSuccess(__('Quiz Question Added Successfuly'));

    }
    
    public function delete(QuizQuestion $model)
    {
        $model->delete() ;
		$question_answers = QuizAnswer::where(['question_id'=>$model])->get();
		if(count($question_answers)>0){
			foreach($question_answers as $question_answer){
				$question_answer->delete();
			}
		}
		return redirect()->back()->withSuccess(__('Quiz Answer Deleted Successfuly'));
    }
    
    public function quiz_result_update(Request $request)
    {
		$data=$request->validate($this->getValidation2());
        $model = QuizResult::where([
            'type_id' => QuizResult::TYPE_QUIZ_RESULT
        ])->first();
        
        if(empty($model))
        {
            $model = new QuizResult();
            $model->type_id = QuizResult::TYPE_QUIZ_RESULT;
            
        }
		if ($request->hasFile('image')) {
            $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads/result'), $imageName);
            $model->image=$imageName;
        }
        $model->question = $request->question;
        $model->description=$request->description;
        $model->save();
        
        return redirect()->back()->withSuccess("Quiz Result Updated Successfuly!!!");
    }
    
    public function quiz_result()
    {
        $quiz_result=QuizResult::where(['type_id'=>QuizResult::TYPE_QUIZ_RESULT])->first();
        return view('admin.quiz-question.quiz_result')->with(compact('quiz_result'));
    }
	
    protected function getValidation2() 
    {
        return [
            'question'=>'required',
            'description'=>'required'
        ] ;

    }
    
    protected function getValidation() 
    {
        return [
            'title'=>'required'
        ] ;

    }
	
}

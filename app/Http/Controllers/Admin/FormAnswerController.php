<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormAnswer;
use App\Models\FormQuestion;
use App\User;
use File;

class FormAnswerController extends Controller
{
    public function index($question_id) 
    {
        $models=FormAnswer::where('question_id',$question_id)->paginate(15); 
		//print_r($models);
		//die();
        return view('admin.form-answer.index')->with('models',$models)->with('question_id',$question_id) ;
    }

    public function add($question_id) 
    {
		$model=FormAnswer::paginate();
		$quiz_questions=FormQuestion::where('status',1)->pluck('title','id')->all() ;
        return view('admin.form-answer.add')->with('question_id',$question_id)->with('model',$model)->with('quiz_questions',$quiz_questions);
    }
    
    public function update(FormAnswer $model) 
    {
		$quiz_questions=FormQuestion::where('status',1)->pluck('title','id')->all() ;
        return view('admin.form-answer.update',['model'=>$model,'question_id'=>$model->question_id,'quiz_questions'=>$quiz_questions]);
    }

    public function doUpdate(Request $request,FormAnswer $model) 
    {
        $data=$request->validate($this->getValidation());
		if(FormAnswer::where(['title'=>$request->title,'question_id'=>$model->question_id])->where('id','!=',$model->id)->count())
		{
			return redirect()->back()->withError(__('Form Answer Title already exists'));
		}
        $model->fill($data);
		$model->title=$request->title;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Form Answer Updated Successfuly'));
    
    }

    public function store(Request $request,$question_id) 
    {
        $data=$request->validate($this->getValidation());
		if(FormAnswer::where(['title'=>$request->title,'question_id'=>$question_id])->count())
		{
			return redirect()->back()->withError(__('Form Answer Title already exists'));
		}
        $model=new FormAnswer() ;
        $model->fill($data);
		$model->title=$request->title;
		$model->question_id=$question_id;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Form Answer Added Successfuly'));
    }

    public function delete(FormAnswer $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Form Answer Deleted Successfuly'));
    }

    protected function getValidation() 
    {
        return [
            'title'=>'required'
        ] ;

    }
	
}

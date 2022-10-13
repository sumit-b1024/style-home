<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\FormQuestion;
use App\User;
use File;

class FormQuestionController extends Controller
{
    public function index() 
    {
        $models=FormQuestion::paginate(15); 
        return view('admin.form-question.index')->with('models',$models) ;
    }

    public function add() 
    {
        return view('admin.form-question.add');
    }
    
    public function update(FormQuestion $model) 
    {
        return view('admin.form-question.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,FormQuestion $model) 
    {
        $data=$request->validate($this->getValidation());
		if(FormQuestion::where(['title'=>$request->title])->where('id','!=',$model->id)->count())
		{
			return redirect()->back()->withError(__('Form Question Title already exists'));
		}
		$model->title=$request->title;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Form Question Updated Successfuly'));
    
    }

    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
		if(FormQuestion::where(['title'=>$request->title])->count())
		{
			return redirect()->back()->withError(__('Form Question Title already exists'));
		}
        $model=new FormQuestion() ;
        $model->fill($data);
        $model->save() ;
        
        return redirect()->back()->withSuccess(__('Form Question Added Successfuly'));

    }

    protected function getValidation() 
    {
        return [
            'title'=>'required'
        ] ;

    }
	
}

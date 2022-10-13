<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\EmailTemplate;

class EmailTemplateController extends Controller
{
    public function index() 
    {
        $models=EmailTemplate::paginate(10);
        return view('admin.email-template.index')->with('models',$models) ;
    }
	
    public function add() 
    {
	     return view('admin.email-template.add');
    }
    
    public function update(EmailTemplate $model) 
    {
        return view('admin.email-template.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,EmailTemplate $model) 
    {
        //$data=$request->validate($this->getValidation());
		$request->validate([
			'salutation'=>'required',
            'message'=>'required',
			'type'=>"required|unique:email_templates,type,$model->id,id"
        ]);
		$model->salutation=$request->salutation;
		$model->message=$request->message;
		$model->type=$request->type;
        $model->save() ;
		
        return redirect()->back()->withSuccess(__('Email Template Updated Successfuly'));
    }

    public function store(Request $request) 
    {
        //$data=$request->validate($this->getValidation());
		$request->validate([
			'salutation'=>'required',
            'message'=>'required',
            'type'=>'required|unique:email_templates'
        ]);
		$model=new EmailTemplate() ;
		$model->salutation=$request->salutation;
		$model->message=$request->message;
		$model->type=$request->type;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Email Template Added Successfuly'));
    }
	
    public function delete(EmailTemplate $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Email Template Deleted Successfuly'));
    }
	
    protected function getValidation() 
    {
        return [
            'salutation'=>'required',
            'message'=>'required',
            'type'=>'required'
        ] ;
    }
}

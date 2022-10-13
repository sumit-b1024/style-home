<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Faq;
use App\Models\DesignerFaq;
use Session;
use Mail;

class FaqController extends Controller
{
    public function index() 
    {
        $models=Faq::paginate(10);
        return view('admin.faq.index')->with('models',$models) ;
    }
    
    public function designer_index() 
    {
        $models=DesignerFaq::paginate(10);
        return view('admin.designer-faq.index')->with('models',$models) ;
    }

    public function add() 
    {
	     return view('admin.faq.add');

    }
    
    public function designer_add() 
    {
	     return view('admin.designer-faq.add');
    }
    
    public function update(Faq $model) 
    {
        return view('admin.faq.update',['model'=>$model]);
    }
    
    public function designer_update(DesignerFaq $model) 
    {
        return view('admin.designer-faq.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,Faq $model) 
    {
        $data=$request->validate($this->getValidation());
        $model->fill($data);
		$model->question=$request->question;
		$model->answer=$request->answer;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Faq Updated Successfuly'));
    }
    
    public function designer_doUpdate(Request $request,DesignerFaq $model) 
    {
        $data=$request->validate($this->getValidation());
        $model->fill($data);
		$model->question=$request->question;
		$model->answer=$request->answer;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Designer Faq Updated Successfuly'));
    }

    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
        $model=new Faq() ;
        $model->fill($data);
		$model->question=$request->question;
		$model->answer=$request->answer;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Faq Added Successfuly'));
    }
    
    public function designer_store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
        $model=new DesignerFaq() ;
        $model->fill($data);
		$model->question=$request->question;
		$model->answer=$request->answer;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Designer Faq Added Successfuly'));
    }

    public function delete(Faq $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Faq Deleted Successfuly'));
    }
    
    public function designer_delete(DesignerFaq $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Designer Faq Deleted Successfuly'));
    }

    protected function getValidation() 
    {
        return [
            'answer'=>'required',
            'question'=>'required'
        ] ;
    }
}

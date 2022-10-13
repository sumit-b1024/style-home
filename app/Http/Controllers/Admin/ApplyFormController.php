<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ApplyForm;
use App\Models\ApplyFormOption;

class ApplyFormController extends Controller
{
    public function index() 
    {
        $models=ApplyForm::paginate(10);
        return view('admin.apply-form.index')->with('models',$models) ;
    }
	
    public function add() 
    {
	     return view('admin.apply-form.add');
    }
    
    public function update(ApplyForm $model) 
    {
		$options=ApplyFormOption::where('status',1)->where('apply_form_id',$model->id)->get();
        return view('admin.apply-form.update',['model'=>$model,'options'=>$options]);
    }

    public function doUpdate(Request $request,ApplyForm $model) 
    {
        $data=$request->validate($this->getValidation());
        $model->fill($data);
		if($request->type==2){
		$options = array_filter($request->options);
		
        $model->fill($data);
		$model->label=$request->label;
		$model->type=$request->type;
        $model->save() ;
		$apply_form_id = $model->id;
		
		if(!empty($options)){
			
			foreach($options as  $option){
            
			$model1=new ApplyFormOption();
			$model1->option_value=$option;
			$model1->apply_form_id=$apply_form_id;
			$model1->save() ;
			}
		}
		}
		else{
        $model->fill($data);
		$model->label=$request->label;
		$model->type=$request->type;
        $model->save() ;
		}
        return redirect()->back()->withSuccess(__('Apply Form Updated Successfuly'));
    }

    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
		if($request->type==2){
		$options = array_filter($request->options);
		if(empty($options)){
			return redirect()->back()->withError(__('Please Add Options for Drop Down'));
		}
        $model=new ApplyForm() ;
        $model->fill($data);
		$model->label=$request->label;
		$model->type=$request->type;
        $model->save() ;
		$apply_form_id = $model->id;
		
			
			foreach($options as  $option){
            
			$model1=new ApplyFormOption();
			$model1->option_value=$option;
			$model1->apply_form_id=$apply_form_id;
			$model1->save() ;
			}
		}
		else{
		$model=new ApplyForm() ;
        $model->fill($data);
		$model->label=$request->label;
		$model->type=$request->type;
        $model->save() ;
		}
        return redirect()->back()->withSuccess(__('Apply Form Added Successfuly'));
    }
	
    public function delete(ApplyForm $model)
    {
        $model->delete() ;
		$options1 = ApplyFormOption::where(['apply_form_id'=>$model->id])->get();
		if(count($options1)>0){
			foreach($options1 as $option1){
				$option1->delete();
			}
		}
        return redirect()->back()->withSuccess(__('Apply Form Deleted Successfuly'));
    }
	
	public function delete_option(ApplyFormOption $model){
		$model->delete() ;
        return redirect()->back()->withSuccess(__('Apply Form Option Deleted Successfuly'));
	}
	
    protected function getValidation() 
    {
        return [
            'label'=>'required',
            'type'=>'required'
        ] ;
    }
}

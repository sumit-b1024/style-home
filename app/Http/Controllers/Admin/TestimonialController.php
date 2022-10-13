<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Testimonial;

class TestimonialController extends Controller
{
    public function index() 
    {
        $models=Testimonial::paginate();
        $user=auth()->user();
        return view('admin.testimonial.index')->with(['models'=>$models,'user'=>$user]);
    }

    public function add() 
    {
        $user=auth()->user();
        return view('admin.testimonial.add')->with(['user'=>$user]);

    }
    
    public function update(Testimonial $model) 
    {
        $user=auth()->user();
        return view('admin.testimonial.update',['model'=>$model,'user'=>$user]);
    }

    public function doUpdate(Request $request,Testimonial $model) 
    {
		
       $data=$request->validate($this->getValidation()+[ 'image' =>'image|mimes:jpeg,png,jpg,gif',]);
        
        $model->fill($data);
        if ($request->hasFile('image')) {
            $imageName = time() . '.' . $request->image->getClientOriginalExtension();
            
            $request->image->move(public_path('uploads'), $imageName);
            $model->image=$imageName;
        }
        $model->description=$request->description;
        $model->position=$request->position;
        $model->star=$request->star;
		$model->title=$request->title;
		$model->status=$request->status;
        $model->save();
        return redirect()->back()->withSuccess(__('Testimonial Updated Successfuly'));
    
    }

    public function store(Request $request) 
    {
		
        $data=$request->validate($this->getValidation()+[ 'image' =>'image|mimes:jpeg,png,jpg,gif']);
		if ($request->hasFile('image')) {
		$imageName = time() . '.' . $request->image->getClientOriginalExtension();
        $request->image->move(public_path('uploads'), $imageName);
		}
		else{
		$imageName = "";
		}
        $model=new Testimonial() ;
        $model->fill($data);
        $model->image=$imageName;
        $model->description=$request->description;
        $model->position=$request->position;
        $model->star=$request->star;
		$model->title=$request->title;;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Testimonial Added Successfuly'));

    }


    public function delete(Testimonial $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Testimonial Deleted Successfuly'));
    }

    protected function getValidation() 
    {
        return [
            'title'=>'required',
            'position'=>'required',
            'description'=>'required',
            'star'=>'integer'
        ] ;

    }
    
    protected function getValidation2() 
    {
        return [
            'title_arabic'=>'required'
        ] ;

    }
    
}

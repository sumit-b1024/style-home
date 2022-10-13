<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Subscription;
use App\Models\SubscriptionAddon;
class SubscriptionController extends Controller
{
    public function index() 
    {
        $models=Subscription::paginate()  ; 
        return view('admin.subscription.index')->with('models',$models) ;
    }

    public function add() 
    {
        return view('admin.subscription.add');

    }
    
    public function update(Subscription $model) 
    {
        return view('admin.subscription.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,Subscription $model) 
    {
        $data=$request->validate($this->getValidation());
        $model->fill($data);
        
        $model->fee_amount=$request->fee_amount;
        $model->size=$request->size;
        $model->facilities=$request->facilities;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Subscription Updated Successfuly'));
    
    }

    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
        $model=new Subscription() ;
        $model->fill($data);
        $model->fee_amount=$request->fee_amount;
        $model->size=$request->size;
        $model->facilities=$request->facilities;
        $model->save() ;
        
        return redirect()->back()->withSuccess(__('Subscription Added Successfuly'));

    }


    public function delete(Subscription $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Subscription Deleted Successfuly'));
    }
    
    public function addons($subscription_id){
		$models=SubscriptionAddon::where('subscription_id',$subscription_id)->paginate(15); 
        return view('admin.subscription.addons')->with('models',$models)->with('subscription_id',$subscription_id) ;
	}
	
	public function addons_add($subscription_id){
		$model=SubscriptionAddon::paginate();
        return view('admin.subscription.addons_add')->with('subscription_id',$subscription_id)->with('model',$model);
	}
	
	public function addons_store(Request $request,$subscription_id){
		$data=$request->validate($this->getValidation2());
        $model=new SubscriptionAddon() ;
        $model->fill($data);
		$model->title=$request->title;
		$model->price=$request->price;
		$model->subscription_id=$subscription_id;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Subscription Addon Added Successfuly'));
	}
	
	public function addons_update(SubscriptionAddon $model){
        return view('admin.subscription.addons_update',['model'=>$model,'subscription_id'=>$model->subscription_id]);
	}
	
	public function addons_doUpdate(Request $request,SubscriptionAddon $model){
		$data=$request->validate($this->getValidation2());
        $model->fill($data);
		$model->title=$request->title;
		$model->price=$request->price;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Subscription Addon Updated Successfuly'));
	}
	
	public function addons_delete(SubscriptionAddon $model){
		$model->delete() ;
        return redirect()->back()->withSuccess(__('Subscription Addon Deleted Successfuly'));
	}
	
    protected function getValidation() 
    {
        return [
            'title'=>'required',
            'size'=>'required',
            'fee_amount'=>'required|numeric',
            'facilities'=>'required'
        ] ;

    }
    
    protected function getValidation2() 
    {
        return [
            'title'=>'required',
            'price'=>'required|numeric',
        ] ;

    }
	
}

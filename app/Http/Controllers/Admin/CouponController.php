<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Coupon;

class CouponController extends Controller
{
    public function index()
    {
        $models=Coupon::paginate();
        $user=auth()->user();
        return view('admin.coupon.index')->with(['models'=>$models,'user'=>$user]);
    }

    public function add()
    {
        $user=auth()->user();
        return view('admin.coupon.add')->with(['user'=>$user]);

    }

    public function update(Coupon $model)
    {
        $user=auth()->user();
        return view('admin.coupon.update',['model'=>$model,'user'=>$user]);
    }

    public function doUpdate(Request $request,Coupon $model)
    {

       $data=$request->validate($this->getValidation());

        $model->fill($data);
        $model->coupon_code=$request->coupon_code;
        $model->percentage=$request->percentage;
        $model->save();
        return redirect()->back()->withSuccess(__('Coupon Updated Successfuly'));

    }

    public function store(Request $request)
    {

        $data=$request->validate($this->getValidation());
        $model=new Coupon() ;
        $model->fill($data);
        $model->coupon_code=$request->coupon_code;
        $model->percentage=$request->percentage;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Coupon Added Successfuly'));

    }


    public function delete(Coupon $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Coupon Deleted Successfuly'));
    }

    protected function getValidation()
    {
        return [
            'coupon_code'=>'required',
            'percentage'=>'required',
        ] ;

    }

    protected function getValidation2()
    {
        return [
            'title_arabic'=>'required'
        ] ;

    }
}

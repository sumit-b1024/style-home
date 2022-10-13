<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\HeaderMenu;
use App\Models\FooterMenu;
use Session;
use Mail;

class MenuController extends Controller
{
    public function index() 
    {
        $models=FooterMenu::paginate(10);
        return view('admin.menu.index')->with('models',$models) ;
    }

    public function add() 
    {
	     return view('admin.menu.add');
    }
	
	
    public function update(FooterMenu $model) 
    {
        return view('admin.menu.update',['model'=>$model]);
    }
	
    public function doUpdate(Request $request,FooterMenu $model) 
    {
        $data=$request->validate($this->getValidation());
        $model->fill($data);
		$str=$request->menu_name;
		$str2=strtolower($str);
	    $str3=preg_replace('/[^A-Za-z0-9\-]/', ' ', $str2);
        $slug1 = str_replace(' ', '-', $str3);
	    $slug2 = preg_replace('/-+/', '-', $slug1);
	    $slug = trim(preg_replace("![^a-z0-9]+!i", "-", $slug2), '-');
		$model->menu_slug=$slug;
		$model->menu_name=$request->menu_name;
		$model->status=$request->status;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Footer Menu Updated Successfuly'));
    }
	
    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation());
        $model=new FooterMenu() ;
        $model->fill($data);
		$str=$request->menu_name;
		$str2=strtolower($str);
	    $str3=preg_replace('/[^A-Za-z0-9\-]/', ' ', $str2);
        $slug1 = str_replace(' ', '-', $str3);
	    $slug2 = preg_replace('/-+/', '-', $slug1);
	    $slug = trim(preg_replace("![^a-z0-9]+!i", "-", $slug2), '-');
		$model->menu_slug=$slug;
		$model->menu_name=$request->menu_name;
		$model->save() ;
        return redirect()->back()->withSuccess(__('Footer Menu Added Successfuly'));
    }

    public function delete(FooterMenu $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('FooterMenu Deleted Successfuly'));
    }
	
	public function header_menu(){
		$headermenus=HeaderMenu::all();
		return view('admin.menu.header_menu',['headermenus'=>$headermenus]);
	}
	
	public function menu_inactive(HeaderMenu $model)
    {
        $model->status=0;
		$model->save();
        return redirect()->back()->withSuccess(__('HeaderMenu Unactivated Successfuly'));
    }
	public function menu_active(HeaderMenu $model)
    {
        $model->status=1;
		$model->save();
        return redirect()->back()->withSuccess(__('Header Menu Activated Successfuly'));
    }
	
	public function menu_description($model){
		$description = FooterMenu::where(['id' => $model])->first();
		return view('admin.menu.description', ['model' => $model,'description'=>$description]);
	}
	
	public function store_menu_description(Request $request){
		$data=$request->validate($this->getValidation2());
		$model = FooterMenu::where(['id' => $request->menu_id])->first();
        $model->html=$request->get("html");
        $model->save();
        return redirect()->back()->withSuccess("Footer menu  Description Updated Successfuly!!!");
	}

    protected function getValidation() 
    {
        return [
            'menu_name'=>'required',
        ] ;
    }
	
	protected function getValidation2() 
    {
        return [
            'html'=>'required'
        ] ;

    }
}

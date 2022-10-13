<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PageTitle;
use Illuminate\Support\Facades\Auth;
use File;
class PageTitleController extends Controller
{

    public function storeBanner(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type'=>'required|unique:page_titles'
        ]);

        $page_title = new PageTitle();
        $page_title->title = $request->get('title');
        $page_title->type=$request->get("type");
        $page_title->save();
        return redirect()->route('admin.page.title')->withSuccess("Page Title Added Successfuly");
    }
    
    public function doUpdateBanner(PageTitle $model,Request $request)
    {
        $request->validate([
            'title' => 'required',
            'type'=>"required|unique:page_titles,type,$model->id,id"
        ]);
		
        $model->title = $request->get('title');
        $model->type=$request->get("type");
        $model->save() ;  
        return redirect()->route('admin.page.title')->withSuccess("Banner Updated Successfuly");
        
        
    }
    
    public function index()
    {
        $models = PageTitle::paginate();
        return view('admin.page-title.index', ['models' => $models]); 
    }
    
    public function updateBanner(PageTitle $model)
    {
        return view('admin.page-title.update', ['model' => $model]);
    }
}

<?php
namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Banner;
use Illuminate\Support\Facades\Auth;
use File;
class BannerController extends Controller
{

    public function storeBanner(Request $request)
    {
        $request->validate([

            'banner_image' => 'required|image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'type_id'=>'required|unique:banners'
        ]);

		$filenamewithextension = $request->file('banner_image')->getClientOriginalName();
		//get filename without extension
		$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
		//get file extension
		$extension = $request->file('banner_image')->getClientOriginalExtension();
		//filename to store
		$imageName = $filename.'_'.time().'.'.$extension;
        $request->banner_image->move(public_path('uploads/banner'), $imageName);

        $banner = new Banner();
        $banner->title = $request->get('title');
        $banner->description = $request->get('description');
        $banner->path = $imageName;
        $banner->type_id=$request->get("type_id");
        $banner->created_by=Auth::user()->id;
        $banner->save();
		//Compress Image Code Here
		if ($request->hasFile('banner_image')) {
			$filepath = public_path('uploads/banner/'.$imageName);
			$mime = mime_content_type($filepath);
			$output = new \CURLFile($filepath, $mime, $imageName);
			$data = ["files" => $output];
			 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://api.resmush.it/?qlty=70');
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				$result = curl_error($ch);
			}
			curl_close ($ch);
			 
			$arr_result = json_decode($result);
			$ch = curl_init($arr_result->dest);
			$fp = fopen($filepath, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
		}
		//Compress Image Code Here
        return redirect()->route('admin.banner')->withSuccess("Banner Added Successfuly");
    }
    
    public function doUpdateBanner(Banner $model,Request $request)
    {
        $request->validate([
            
            'banner_image' => 'image|mimes:jpeg,png,jpg,gif,svg|max:2048',
            'title' => 'required',
            'type_id'=>"required|unique:banners,type_id,$model->id,id"
        ]);
		$banner = $model->path;
        if ($request->hasFile('banner_image')) {
            $filenamewithextension = $request->file('banner_image')->getClientOriginalName();
			//get filename without extension
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			//get file extension
			$extension = $request->file('banner_image')->getClientOriginalExtension();
			//filename to store
			$imageName = $filename.'_'.time().'.'.$extension;
            $request->banner_image->move(public_path('uploads/banner'), $imageName);
            $model->path=$imageName;
        }
        if (($request->hasFile('banner_image')) && ($banner)) {
			$image_path = public_path('uploads/banner/'.$banner);
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
		}
		if ($request->hasFile('banner_image')) {
			$filepath = public_path('uploads/banner/'.$imageName);
			$mime = mime_content_type($filepath);
			$output = new \CURLFile($filepath, $mime, $imageName);
			$data = ["files" => $output];
			 
			$ch = curl_init();
			curl_setopt($ch, CURLOPT_URL, 'http://api.resmush.it/?qlty=70');
			curl_setopt($ch, CURLOPT_POST,1);
			curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
			curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
			curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
			$result = curl_exec($ch);
			if (curl_errno($ch)) {
				$result = curl_error($ch);
			}
			curl_close ($ch);
			 
			$arr_result = json_decode($result);
			$ch = curl_init($arr_result->dest);
			$fp = fopen($filepath, 'wb');
			curl_setopt($ch, CURLOPT_FILE, $fp);
			curl_setopt($ch, CURLOPT_HEADER, 0);
			curl_exec($ch);
			curl_close($ch);
			fclose($fp);
		}
		//Compress Image Code Here
        $model->title = $request->get('title');
        $model->description = $request->get('description');
        $model->type_id=$request->get("type_id");
        $model->save() ;  
        return redirect()->route('admin.banner')->withSuccess("Banner Updated Successfuly");
        
        
    }
    
    public function banner()
    {
        $models = Banner::paginate();
        
        return view('admin.banner.index', ['models' => $models]);
        
        
        
    }
    
    public function updateBanner(Banner $model)
    {
        return view('admin.banner.update', ['model' => $model]);
    }
}

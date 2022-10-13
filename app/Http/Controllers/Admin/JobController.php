<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Job;
use App\User;
use File;

class JobController extends Controller
{
    public function index() 
    {
        $models=Job::paginate(15); 
        return view('admin.job.index')->with('models',$models) ;
    }

    public function add() 
    {
        return view('admin.job.add');
    }
    
    public function update(Job $model) 
    {
        return view('admin.job.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,Job $model) 
    {
        $data=$request->validate($this->getValidation()+[ 'image' =>'image|mimes:jpeg,png,jpg,gif|max:2048',]);
		if(Job::where(['name'=>$request->name])->where('id','!=',$model->id)->count())
		{
			return redirect()->back()->withError(__('Job name already exists'));
		}
        $image = $model->image;
        $model->fill($data);
        if ($request->hasFile('image')) {
           $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads/job'), $imageName);
            $model->image=$imageName;
        }
		if (($request->hasFile('image')) && ($image)) {
			$image_path = public_path('uploads/job/'.$image);
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
		}
		if ($request->hasFile('image')) {
			$filepath = public_path('uploads/job/'.$imageName);
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
		$str=$request->name;
		$str2=strtolower($str);
	    $str3=preg_replace('/[^A-Za-z0-9\-]/', ' ', $str2);
        $slug1 = str_replace(' ', '-', $str3);
	    $slug2 = preg_replace('/-+/', '-', $slug1);
	    $slug = trim(preg_replace("![^a-z0-9]+!i", "-", $slug2), '-');
		$model->slug=$slug;
		$model->name=$request->name;
		$model->job_category=$request->job_category;
		$model->location=$request->location;
		$model->description=$request->description;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Job Updated Successfuly'));
    
    }

    public function store(Request $request) 
    {
        $data=$request->validate($this->getValidation()+[ 'image' =>'image|mimes:jpeg,png,jpg,gif|max:2048']);
		if(Job::where(['name'=>$request->name])->count())
		{
			return redirect()->back()->withError(__('Job Name already exists'));
		}
        
        $model=new Job() ;
		if ($request->hasFile('image')) {
           $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads/job'), $imageName);
            $model->image=$imageName;
        }
		
		//Compress Image Code Here
		if ($request->hasFile('image')) {
			$filepath = public_path('uploads/job/'.$imageName);
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
        $model->fill($data);
		$str=$request->name;
		$str2=strtolower($str);
	    $str3=preg_replace('/[^A-Za-z0-9\-]/', ' ', $str2);
        $slug1 = str_replace(' ', '-', $str3);
	    $slug2 = preg_replace('/-+/', '-', $slug1);
	    $slug = trim(preg_replace("![^a-z0-9]+!i", "-", $slug2), '-');
		$model->slug=$slug;
		$model->name=$request->name;
		$model->job_category=$request->job_category;
		$model->location=$request->location;
		$model->description=$request->description;
        $model->save() ;
        
        return redirect()->back()->withSuccess(__('Project Added Successfuly'));

    }

    public function delete(Job $model)
    {
        $model->delete() ;

         return redirect()->back()->withSuccess(__('Job Deleted Successfuly'));
    }

    protected function getValidation() 
    {
        return [
            'name'=>'required',
            'job_category'=>'required',
            'location'=>'required',
			'description'=>'required'
        ] ;

    }
	
}

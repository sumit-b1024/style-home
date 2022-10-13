<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectUpdate;
use App\Models\DetailForm;
use App\Models\ProjectDetail;
use App\User;
use File;

class ProjectController extends Controller
{
    public function index($project_id)
    {
        $models=ProjectUpdate::where('project_id',$project_id)->paginate(15);
		//print_r($models);
		//die();
		$model = ProjectDetail::where('view_status', 0)->where('id', $project_id)->first();
         if(!empty($model)){
        $model->view_status = 1;
        $model->save();
        }
        return view('admin.project-update.index')->with('models',$models)->with('project_id',$project_id) ;
    }

    public function add($project_id)
    {
		$model=ProjectUpdate::paginate();
        return view('admin.project-update.add')->with('project_id',$project_id)->with('model',$model);
    }

    public function update(ProjectUpdate $model)
    {
        return view('admin.project-update.update',['model'=>$model,'project_id'=>$model->project_id]);
    }

    public function doUpdate(Request $request,ProjectUpdate $model)
    {
        $data=$request->validate($this->getValidation()+[ 'image' =>'image|mimes:jpeg,png,jpg,gif|max:2048',]);
        $projects = ProjectDetail::where('id',$model->project_id)->first();
        if(isset($projects)){
            if($request->project_status == "Complete"){
                $projects->status = 0;
            }
            else{
                $projects->status = 1;
            }
            $projects->save();
        }
        $image = $model->image;
        $model->fill($data);
        if ($request->hasFile('image')) {
           $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads'), $imageName);
            $model->image=$imageName;
        }
		if (($request->hasFile('image')) && ($image)) {
			$image_path = public_path('uploads/'.$image);
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
		}
		if ($request->hasFile('image')) {
			$filepath = public_path('uploads/'.$imageName);
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
        // dd($request->project_status);
		//Compress Image Code Here
		$model->date=$request->date;
		$model->description=$request->description;
		$model->project_status=$request->project_status;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Project Update Updated Successfuly'));

    }

    public function store(Request $request,$project_id)
    {
        $data=$request->validate($this->getValidation()+[ 'image' =>'sometimes|image|mimes:jpeg,png,jpg,gif|max:2048']);
        $user=auth()->user();
        $project_detail = ProjectDetail::where('id', $project_id)->first();

        if(isset($project_detail)){
            if($request->project_status == "Complete"){
                $project_detail->status = 0;
            }
            else{
                $project_detail->status = 1;
            }
            $project_detail->save();
        }

        $model=new ProjectUpdate() ;
		if ($request->hasFile('image')) {
           $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads'), $imageName);
            $model->image=$imageName;
        }

		//Compress Image Code Here
		if ($request->hasFile('image')) {
			$filepath = public_path('uploads/'.$imageName);
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
		$model->date=$request->date;
		$model->description=$request->description;
		$model->project_status=$request->project_status;
		$model->project_id=$project_id;
		$model->user_id=$user->id;
		$model->customer_id=$project_detail->user_id;
        $model->save() ;

        return redirect()->back()->withSuccess(__('Project Update Added Successfuly'));

    }

    public function delete(ProjectUpdate $model)
    {
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Project Update Deleted Successfuly'));
    }

    protected function getValidation()
    {
        return [
            'date'=>'required',
            'project_status'=>'required'
        ] ;

    }

}

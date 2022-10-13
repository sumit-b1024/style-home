<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizCategory;
use App\User;
use File;

class QuizCategoryController extends Controller
{
    public function index()
    {
        $models=QuizCategory::paginate(15);
        return view('admin.quiz-category.index')->with('models',$models) ;
    }

    public function add()
    {
        return view('admin.quiz-category.add');
    }

    public function update(QuizCategory $model)
    {
        return view('admin.quiz-category.update',['model'=>$model]);
    }

    public function doUpdate(Request $request,QuizCategory $model)
    {
        $data=$request->validate($this->getValidation()+[ 'image' =>'image|mimes:jpeg,png,jpg,gif|max:5120',]);
		if(QuizCategory::where(['title'=>$request->title])->where('id','!=',$model->id)->count())
		{
			return redirect()->back()->withError(__('Quiz Category Title already exists'));
		}
		$image = $model->image;
		if ($request->hasFile('image')) {
           $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads/category'), $imageName);
            $model->image=$imageName;
        }
		if (($request->hasFile('image')) && ($image)) {
			$image_path = public_path('uploads/category/'.$image);
			if(File::exists($image_path)) {
				File::delete($image_path);
			}
		}
		if ($request->hasFile('image')) {
			$filepath = public_path('uploads/category/'.$imageName);
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
		$model->title=$request->title;
		$model->description=$request->description;
        $model->save() ;
        return redirect()->back()->withSuccess(__('Quiz Category Updated Successfuly'));

    }

    public function store(Request $request)
    {
        $data=$request->validate($this->getValidation()+[ 'image' =>'required|image|mimes:jpeg,png,jpg,gif|max:5120']);
		if(QuizCategory::where(['title'=>$request->title])->count())
		{
			return redirect()->back()->withError(__('Quiz Category Title already exists'));
		}
        $model=new QuizCategory() ;
        if ($request->hasFile('image')) {
           $filenamewithextension = $request->file('image')->getClientOriginalName();
			$filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
			$extension = $request->file('image')->getClientOriginalExtension();
			$imageName = $filename.'_'.time().'.'.$extension;
			$request->image->move(public_path('uploads/category'), $imageName);
            $model->image=$imageName;
        }

		//Compress Image Code Here
		if ($request->hasFile('image')) {
			$filepath = public_path('uploads/category/'.$imageName);
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
		$model->title=$request->title;
		$model->description=$request->description;
        $model->save() ;

        return redirect()->back()->withSuccess(__('Quiz Category Added Successfuly'));

    }

    protected function getValidation()
    {
        return [
            'title'=>'required',
            'description'=>'required'
        ] ;

    }

    public function delete(QuizCategory $model)
    {
        $model->delete() ;
		return redirect()->back()->withSuccess(__('Quiz Answer Deleted Successfuly'));
    }
}

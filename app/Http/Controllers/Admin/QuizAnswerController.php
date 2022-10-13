<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\QuizAnswer;
use App\Models\QuizQuestion;
use App\Models\QuizCategory;
use App\User;
use File;
use phpDocumentor\Reflection\Types\Null_;

class QuizAnswerController extends Controller
{
    public function index($question_id)
    {
        $models = QuizAnswer::where('question_id', $question_id)->paginate(15);
        //print_r($models);
        //die();
        return view('admin.quiz-answer.index')->with('models', $models)->with('question_id', $question_id);
    }

    public function add($question_id)
    {
        $model = QuizAnswer::paginate();
        $quiz_questions = QuizQuestion::where('status', 1)->pluck('title', 'id')->all();
        $quiz_categories = QuizCategory::where('status', 1)->pluck('title', 'id')->all();
        return view('admin.quiz-answer.add')->with('question_id', $question_id)->with('model', $model)->with('quiz_questions', $quiz_questions)->with('quiz_categories', $quiz_categories);
    }

    public function update(QuizAnswer $model)
    {
        $quiz_questions = QuizQuestion::where('status', 1)->pluck('title', 'id')->all();
        $quiz_categories = QuizCategory::where('status', 1)->pluck('title', 'id')->all();
        return view('admin.quiz-answer.update', ['model' => $model, 'question_id' => $model->question_id, 'quiz_questions' => $quiz_questions, 'quiz_categories' => $quiz_categories]);
    }

    public function doUpdate(Request $request, QuizAnswer $model)
    {
        $data = $request->validate($this->getValidation() + ['image' => 'image|mimes:jpeg,png,jpg,gif|max:2048',]);
        if (QuizAnswer::where(['title' => $request->title, 'question_id' => $model->question_id])->where('id', '!=', $model->id)->count()) {
            return redirect()->back()->withError(__('Quiz Answer Title already exists'));
        }
        $image = $model->image;
        $model->fill($data);
        if ($request->hasFile('image')) {
            $filenamewithextension = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $filename . '_' . time() . '.' . $extension;
            $request->image->move(public_path('uploads/answer'), $imageName);
            $model->image = $imageName;
        }
        if (($request->hasFile('image')) && ($image)) {
            $image_path = public_path('uploads/answer/' . $image);
            if (File::exists($image_path)) {
                File::delete($image_path);
            }
        }
        if ($request->hasFile('image')) {
            $filepath = public_path('uploads/answer/' . $imageName);
            $mime = mime_content_type($filepath);
            $output = new \CURLFile($filepath, $mime, $imageName);
            $data = ["files" => $output];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://api.resmush.it/?qlty=70');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $result = curl_error($ch);
            }
            curl_close($ch);

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
        $model->title = $request->title;
        $model->category_id = $request->category_id ? implode(",", $request->category_id) : null;
        $model->save();
        return redirect()->back()->withSuccess(__('Quiz Answer Updated Successfuly'));
    }

    public function store(Request $request, $question_id)
    {
        $data = $request->validate($this->getValidation() + ['image' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
        if (QuizAnswer::where(['title' => $request->title, 'question_id' => $question_id])->count()) {
            return redirect()->back()->withError(__('Quiz Answer Title already exists'));
        }


        $image = "";
        if ($request->hasFile('image')) {
            $filenamewithextension = $request->file('image')->getClientOriginalName();
            $filename = pathinfo($filenamewithextension, PATHINFO_FILENAME);
            $extension = $request->file('image')->getClientOriginalExtension();
            $imageName = $filename . '_' . time() . '.' . $extension;
            $request->image->move(public_path('uploads/answer'), $imageName);
            $image = $imageName;
        }

        //Compress Image Code Here
        if ($request->hasFile('image')) {
            $filepath = public_path('uploads/answer/' . $imageName);
            $mime = mime_content_type($filepath);
            $output = new \CURLFile($filepath, $mime, $imageName);
            $data = ["files" => $output];

            $ch = curl_init();
            curl_setopt($ch, CURLOPT_URL, 'http://api.resmush.it/?qlty=70');
            curl_setopt($ch, CURLOPT_POST, 1);
            curl_setopt($ch, CURLOPT_RETURNTRANSFER, 1);
            curl_setopt($ch, CURLOPT_CONNECTTIMEOUT, 5);
            curl_setopt($ch, CURLOPT_POSTFIELDS, $data);
            $result = curl_exec($ch);
            if (curl_errno($ch)) {
                $result = curl_error($ch);
            }
            curl_close($ch);

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
        if (isset($request->category_id)) {
            foreach ($request->category_id as $cat_id) {
                $model = new QuizAnswer();
                $model->fill($data);

                $model->image = $image;
                $model->title = $request->title;
                $model->question_id = $question_id;
                $model->category_id = $cat_id;
                $model->save();
            }
        } else {
            $model = new QuizAnswer();
            $model->fill($data);

            $model->image = $image;
            $model->title = $request->title;
            $model->question_id = $question_id;
            $model->category_id = null;
            $model->save();
        }
        return redirect()->back()->withSuccess(__('Quiz Answer Added Successfuly'));
    }

    public function delete(QuizAnswer $model)
    {
        $model->delete();

        return redirect()->back()->withSuccess(__('Quiz Answer Deleted Successfuly'));
    }

    protected function getValidation()
    {
        return [
            'title' => 'required',
            // 'category_id' => 'required'
        ];
    }
}

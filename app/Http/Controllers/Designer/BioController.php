<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Models\Designer;
use App\Models\ProjectDetail;
use App\Models\DesignerFaq;
use App\Models\SupportEmail;
use App\Models\Page;
use App\Models\QuizCategory;
use App\Models\FormQuestion;
use App\User;
use App\Models\DesignerImage;
use App\Models\Setting;
use App\Models\EmailTemplate;
use Mail;

class BioController extends Controller
{

    public function morder()
    {
        $user=auth()->user();
        $model = Designer::where('user_id', $user->id)->first();
        $designer_images = DesignerImage::where('user_id', $user->id)->get();
        $quiz_categoryies = QuizCategory::where('status', 1)->get();
        return view('admin.enquiry.morder',compact(['model','quiz_categoryies','designer_images']));
    }

	public function project_list()
    {
        $user=auth()->user();
        $projects = ProjectDetail::select('detail_forms.project_duration','detail_forms.designer', 'customer_quizzes.preferred_bedroom',  'users.first_name','users.last_name','users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')->join('users', 'users.id', 'project_details.user_id')
            ->where("detail_forms.designer", $user->id)->where("project_details.status",1)->get();
        return view('admin.enquiry.project_list',compact(['projects']));
    }

	public function project_view($project_id){
	    $user=auth()->user();
        /*$project = ProjectDetail::select('detail_forms.project_duration','detail_forms.designer', 'customer_quizzes.preferred_bedroom',  'users.first_name','users.last_name','users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')->join('users', 'users.id', 'project_details.user_id')
            ->where("detail_forms.designer", $user->id)->where("project_details.id",$project_id)->where("project_details.status",1)->first();*/
        $project = ProjectDetail::select('detail_forms.project_duration','detail_forms.designer','subscriptions.title as subscription_title','detail_forms.amount as subscription_amount','detail_forms.addons','customer_quizzes.answers','countries.name as country_name','customer_quizzes.questions','quiz_categories.title as category_title','customer_quizzes.id as quizId', 'customer_quizzes.preferred_bedroom','form_answers.title as form_answer','detail_forms.room',  'users.first_name','users.last_name','users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users', 'users.id', 'detail_forms.designer')->leftjoin('quiz_categories', 'quiz_categories.id', 'customer_quizzes.answer_category')->leftjoin('subscriptions', 'subscriptions.id', 'detail_forms.subscription')->leftjoin('countries', 'countries.id', 'detail_forms.country')->leftjoin('form_answers', 'form_answers.id', 'detail_forms.space')
            ->where("project_details.id", $project_id)->where("project_details.status",1)->where("detail_forms.designer", $user->id)->first();
            $form_questions = FormQuestion::where('status',1)->get()->toArray();
        if(!empty($project)){
        $model = ProjectDetail::where('view_status', 0)->where('id', $project_id)->first();
         if(!empty($model)){
        $model->view_status = 1;
        $model->save();
        }
        return view('admin.enquiry.project_view',compact(['project','form_questions']));
        }
        else{
            abort(404);
        }
	}

	public function payment_list()
    {
        return view('admin.enquiry.payment_list');
    }

	public function term_condition()
    {
        $section2=Page::where('type_id',Page::TYPE_TERMS_CONDITIONS)->where('section_index',Page::SECTION_INDEX_TWO)->first();
        return view('admin.enquiry.term_condition',compact(['section2']));
    }

	public function profile()
    {
        $user1=auth()->user();
        $user = Designer::where('user_id', $user1->id)->first();
        return view('admin.enquiry.profile',compact(['user']));
    }

	public function support_email()
    {
        $setting = Setting::where('created_by', 1)->first();
        return view('admin.enquiry.support_email',compact(['setting']));
    }

	public function faq()
    {
        $designer_faqs = DesignerFaq::where('status',1)->get();
        return view('admin.enquiry.faq',compact(['designer_faqs']));
    }

    public function bio_post(Request $request){
        $data= $request->validate($this->getValidation()) ;
		$user=auth()->user();
		$model = Designer::where('user_id', $user->id)->first();
		$model->bio_type = implode(",",$request->bio_type);
		$model->description = $request->description;
		$model->save();

		if ($request->hasFile('filename')) {
		    @$title = $request->title;
			foreach($request->file('filename') as $x => $image){
            $imageName = $image->getClientOriginalName();

            $image->move(public_path('uploads'), $imageName);
            $data[]=$imageName;
			$model=new DesignerImage();
			if(@$title){
				$model->title=@$title[$x];
			}
			$model->filename=$imageName;
			$model->user_id=$user->id;
			$model->save() ;
			}

        }
		return redirect()->back()->withSuccess(__('Designer Bio Updated Successfully'));
    }

    public function profile_post(Request $request){
        $user=auth()->user();
        $data= $request->validate($this->getValidation2($user->id)) ;
        if(User::where(['email'=>$request->email,'role_id'=>3])->where('id','!=',$user->id)->count())
		{
			return redirect()->back()->withError(__('This email already exists'));
		}
		$model = Designer::where('user_id', $user->id)->first();
		if ($request->hasFile('profile_image')) {
            $imageName = $request->profile_image->getClientOriginalName();
            $request->profile_image->move(public_path('uploads'), $imageName);
            $model->profile_image = $imageName;
            $user->profile_image = $imageName;
		}


		$model->first_name = $request->first_name;
		$model->last_name = $request->last_name;
		$model->email = $request->email;
		$model->phone_number = $request->phone_number;
		$model->city = $request->city;
		$model->address = $request->address;
		$model->language = $request->language;
		$model->location = $request->location;
		$model->account_number = $request->account_number;
		$model->ifsc_code = $request->ifsc_code;
		$model->bank_name = $request->bank_name;
		$model->branch = $request->branch;
		$model->save();


		$user->first_name = $request->first_name;
		$user->last_name = $request->last_name;
		$user->email = $request->email;
		$user->phone_number = $request->phone_number;
		$user->city = $request->city;
		$user->address = $request->address;
		$user->save();
		return redirect()->back()->withSuccess(__('Designer Profile Updated Successfully'));
    }

    public function customer(){
        $user1=auth()->user();
        $customers=DB::select("SELECT * FROM `tbl_users` where id IN (SELECT DISTINCT user_id FROM `tbl_detail_forms` WHERE designer=$user1->id)");
    //print_r($customers);
    //die();
        return view('admin.enquiry.customer',compact(['customers']));
    }

    public function support_email_post(Request $request){
        $request->validate([
            'email' => 'required|email',
            'message' => 'required'
        ]);
        $setting = Setting::where('created_by', 1)->first();
        $user=auth()->user();
        $model=new SupportEmail();
        $model->user_id = $user->id;
        $model->email = $setting->admin_email;
		$model->message = $request->message;
		$model->save();

		$email_template=EmailTemplate::where(['type'=>EmailTemplate::TYPE_SUPPORT_EMAIL])->first();
		$name = $user->first_name." ".$user->last_name;
		Mail::send('emails.support_email', ['model'=>$model,'name'=>$name], function ($m) use ($model){
            $m->from('styleahome01@gmail.com', env('APP_NAME'));
            $m->to([$model->email])->subject(__('Support Email'));
            });

            if(!empty($email_template)){
            Mail::send('emails.thank_message2', ['model'=>$model,'email_template'=>$email_template], function ($m) use ($user){
            $m->from('styleahome01@gmail.com', env('APP_NAME'));
            $m->to($user->email, $user->first_name)->subject(__('Support Email'));
            });
            }
		return redirect()->back()->withSuccess(__('Email Send Successfully'));
    }

    public function delete_designer_image(DesignerImage $model){
        $model->delete() ;
        return redirect()->back()->withSuccess(__('Designer Image Deleted Successfuly'));
    }

    protected function getValidation2($userId)
    {
        return [
            'first_name'=>'required',

            'phone_number'=>'required|numeric',
            'email'=>'required'
        ];
    }

    protected function getValidation()
    {
        return [
            'bio_type.*'=>'required|min:1',
            'bio_type' => 'required|array',
            'description'=>'required'
        ];
    }

}

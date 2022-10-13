<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Facades\DB;
use App\Models\Page;
use App\Models\Banner;
use App\Models\Job;
use App\Models\Faq;
use App\Models\Enquiry;
use App\Models\HearAbout;
use App\Models\ApplyJob;
use App\Models\ProjectDetail;
use App\Models\QuizQuestion;
use App\Models\Country;
use App\Models\FormQuestion;
use App\Models\Designer;
use App\Models\Subscription;
use App\Models\DetailForm;
use App\Models\CustomerQuiz;
use App\Models\Testimonial;
use App\Models\ProjectUpdate;
use App\User;
use App\Models\DesignerImage;
use App\Models\FooterMenu;
use App\Models\ApplyForm;
use App\Models\Setting;
use App\Models\EmailTemplate;
use App\Models\PageTitle;
use App\Models\AddToCart;
use App\Models\Payment;
use Session;
use Mail;

class HomeController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $section1 = Page::where('type_id', Page::TYPE_HOMEPAGE)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        $section2 = Page::where('type_id', Page::TYPE_HOMEPAGE)->where('section_index', Page::SECTION_INDEX_TWO)->first();
        $section3 = Page::where('type_id', Page::TYPE_HOMEPAGE)->where('section_index', Page::SECTION_INDEX_THREE)->first();
        $section4 = Page::where('type_id', Page::TYPE_HOMEPAGE)->where('section_index', Page::SECTION_INDEX_FOUR)->first();
        $banner = Banner::where('type_id', Page::TYPE_HOMEPAGE)->orderBy('id', 'desc')->first();
        //$quiz_questions=QuizQuestion::where('status',1)->get()->toArray();
        $testimonials = Testimonial::where('status', 1)->get();
        //print_r($testimonials);
        //die();
        $addcarts = [];
        if (isset($user)) {
            $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
        }
        $quiz_questions = DB::select("SELECT * FROM `tbl_quiz_questions` WHERE tbl_quiz_questions.status=1 and tbl_quiz_questions.id IN(SELECT DISTINCT(question_id) FROM `tbl_quiz_answers` WHERE tbl_quiz_answers.status=1)");
        if (isset($user)) {
            $subscriptions = Subscription::where('status', 1)->get();
            $customer_temp5 = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            // $designers = Designer::select('quiz_categories.title as ctaegory_title', 'designers.*')->join('quiz_categories', 'quiz_categories.id', 'designers.bio_type')->where('designers.bio_type', 'like', '%' . $customer_temp5->answer_category . '%')->where("designers.status", 1)->get();
        } else {
            $subscriptions = Subscription::where('status', 1)->get();
            $customer_temp5 = null;
        }
        $countries = Country::all();
        if (!empty($detail_form2)) {
            $customer_temp5 = $detail_form2;
        } else {
            $customer_temp5 = $customer_temp5;
        }
        return view("frontend.home", compact(['section1', 'section2', 'section3', 'section4', 'banner', 'quiz_questions', 'testimonials', 'subscriptions', 'customer_temp5', 'addcarts']));
    }

    public function project()
    {
        $user = auth()->user();
        if (empty($user)) {
            $userId = 0;
        } else {
            $userId = $user->id;
        }
        /*if(empty($user)){
			return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
		}
		else if($user->role_id!=2){
			return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
		}
		else if($user->role_id==2){*/
        //$quiz_questions=QuizQuestion::where('status',1)->get()->toArray();
        //$quiz_questions=QuizQuestion::where('status',1)->get();
        $quiz_questions = DB::select("SELECT * FROM `tbl_quiz_questions` WHERE tbl_quiz_questions.status=1 and tbl_quiz_questions.id IN(SELECT DISTINCT(question_id) FROM `tbl_quiz_answers` WHERE tbl_quiz_answers.status=1)");
        //print_r($quiz_questions);
        //die();
        $banner = Banner::where('type_id', Page::TYPE_PROJECT)->orderBy('id', 'desc')->first();
        $allprojects = ProjectDetail::select('detail_forms.project_duration', 'detail_forms.designer', 'customer_quizzes.preferred_bedroom',  'users.first_name', 'users.last_name', 'users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users', 'users.id', 'detail_forms.designer')
            ->where("project_details.user_id", $userId)->whereIn("project_details.status", [0, 1])->get();
        $projects = ProjectDetail::select('detail_forms.project_duration', 'detail_forms.designer', 'customer_quizzes.preferred_bedroom',  'users.first_name', 'users.last_name', 'users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users', 'users.id', 'detail_forms.designer')
            ->where("project_details.user_id", $userId)->where("project_details.status", 1)->get();
        $complete_projects = ProjectDetail::select('detail_forms.project_duration', 'detail_forms.designer', 'customer_quizzes.preferred_bedroom',  'users.first_name', 'users.last_name', 'users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users', 'users.id', 'detail_forms.designer')
            ->where("project_details.user_id", $userId)->where("project_details.status", 0)->get();
        $project_detail = ProjectDetail::where('user_id', $userId)->where('status', 1)->first();
        if (isset($user)) {
            $subscriptions = Subscription::where('status', 1)->get();
            $customer_temp5 = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            // $designers = Designer::select('quiz_categories.title as ctaegory_title', 'designers.*')->join('quiz_categories', 'quiz_categories.id', 'designers.bio_type')->where('designers.bio_type', 'like', '%' . $customer_temp5->answer_category . '%')->where("designers.status", 1)->get();
        } else {
            $subscriptions = [];
            $customer_temp5 = null;
        }
        $addcarts = [];
        if (isset($user)) {
            $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
        }
        if (!empty($project_detail)) {
            return view("frontend.project", compact(['projects', 'allprojects', 'complete_projects', 'quiz_questions', 'banner', 'customer_temp5', 'subscriptions', 'addcarts']));
        } else {
            return redirect()->route('frontend.home');
        }
        //return view("frontend.project",compact(['projects','complete_projects','quiz_questions','banner']));
        //}
    }

    public function detail_form()
    {
        $user = auth()->user();
        $page_title = PageTitle::where('type', PageTitle::TYPE_DEATIL_FORM)->first();
        $quiz_questions = DB::select("SELECT * FROM `tbl_quiz_questions` WHERE tbl_quiz_questions.status=1 and tbl_quiz_questions.id IN(SELECT DISTINCT(question_id) FROM `tbl_quiz_answers` WHERE tbl_quiz_answers.status=1)");
        if (empty($user)) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        } else if ($user->role_id != 2) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        } else if ($user->role_id == 2) {
            $detail_form = DetailForm::where('user_id', $user->id)->first();
            $customer_temp2 = CustomerQuiz::where('user_id', $user->id)->first();
            if ((empty($detail_form)) && (empty($customer_temp2))) {
                return redirect()->route('frontend.project')->withError(__('First complete quiz form, then fill detail form!'));
            } else {
                $customer_temp = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
                if (empty($customer_temp)) {
                    return redirect()->route('frontend.project')->withError(__('First complete quiz form, then fill detail form!'));
                } else {
                    $detail_form2 = DetailForm::where('user_id', $user->id)->where('quiz_id', $customer_temp->id)->orderBy('id', 'desc')->first();
                    /*if(!empty($detail_form2)){
				return redirect()->route('frontend.project')->withError(__('First complete quiz form, then fill detail form!'));
			}
			else{*/
                    $form_questions = FormQuestion::where('status', 1)->get()->toArray();
                    //$designers = Designer::where('status',1)->get();

                    $customer_temp5 = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
                    $designers = Designer::select('quiz_categories.title as ctaegory_title', 'designers.*')->join('quiz_categories', 'quiz_categories.id', 'designers.bio_type')->where('designers.bio_type', 'like', '%' . $customer_temp5->answer_category . '%')->where("designers.status", 1)->get();
                    $subscriptions = Subscription::where('status', 1)->get();
                    $countries = Country::all();
                    if (!empty($detail_form2)) {
                        $customer_temp5 = $detail_form2;
                    } else {
                        $customer_temp5 = $customer_temp5;
                    }
                    $addcarts = [];
                    if (isset($user)) {
                        $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
                    }
                    return view("frontend.detail_form", compact(['form_questions', 'countries', 'designers', 'subscriptions', 'customer_temp5', 'quiz_questions', 'page_title', 'addcarts']));
                    //}
                }
            }
            //return view("frontend.detail_form");
        }
    }

    public function project_detail()
    {

        $user = auth()->user();
        // $check_payment  = Payment::where('user_id', $user->id)->count();
        // $check_project = ProjectDetail::where('user_id', $user->id)->count();
        // dd($check_project);
        $page_title = PageTitle::where('type', PageTitle::TYPE_PROJECT_DETAIL)->first();
        //return view("frontend.project_detail",compact(['page_title']));
        if (empty($user)) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        } else if ($user->role_id != 2) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        } else if ($user->role_id == 2) {
            //return view("frontend.project_detail");
            $project_detail = ProjectDetail::where('user_id', $user->id)->first();
            $detail_form2 = DetailForm::where('user_id', $user->id)->first();
            if ((empty($project_detail)) && (empty($detail_form2))) {
                return redirect()->route('frontend.detail.form')->withError(__('First complete Detail form, then fill detail form!'));
            } else {
                $detail_form = DetailForm::where('user_id', $user->id)->orderBy('id', 'desc')->first();
                if (empty($detail_form)) {
                    return redirect()->route('frontend.detail.form')->withError(__('First complete detail form, then fill detail form!'));
                } else {
                    $project_detail2 = ProjectDetail::where('user_id', $user->id)->where('detail_form_id', $detail_form->id)->first();
                    if (!empty($project_detail2)) {
                        return redirect()->route('frontend.detail.form')->withError(__('First complete detail form, then fill detail form!'));
                    } else {
                        $addcarts = [];
                        if (isset($user)) {
                            $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
                        }
                        return view("frontend.project_detail", compact(['page_title', 'addcarts']));
                    }
                }
            }
        }
    }

    public function designer()
    {
        return view("frontend.designer");
    }

    public function career()
    {
        $jobs = Job::where('status', 1)->get();
        $section1 = Page::where('type_id', Page::TYPE_CAREER)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        $page_title = PageTitle::where('type', PageTitle::TYPE_CAREER)->first();
        $quiz_questions = DB::select("SELECT * FROM `tbl_quiz_questions` WHERE tbl_quiz_questions.status=1 and tbl_quiz_questions.id IN(SELECT DISTINCT(question_id) FROM `tbl_quiz_answers` WHERE tbl_quiz_answers.status=1)");
        return view("frontend.career", compact(['jobs', 'section1', 'quiz_questions', 'page_title']));
    }
    public function contact()
    {
        $page_title = PageTitle::where('type', PageTitle::TYPE_CONTACT_US)->first();
        return view("frontend.contact", compact(['page_title']));
    }
    public function faq()
    {
        $faqs = Faq::where('status', 1)->get();
        $page_title = PageTitle::where('type', PageTitle::TYPE_FAQ)->first();
        return view("frontend.faq", compact(['faqs', 'page_title']));
    }
    public function privacy_policy()
    {
        $section1 = Page::where('type_id', Page::TYPE_PRIVACY_POLICY)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.privacy_policy", compact(['section1']));
    }
    public function term_condition()
    {
        $section1 = Page::where('type_id', Page::TYPE_TERMS_CONDITIONS)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.term_condition", compact(['section1']));
    }

    public function signup()
    {
        $user = auth()->user();
        $hear_abouts = HearAbout::where('status', 1)->get();
        $addcarts = [];
        if (isset($user)) {
            $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
        }
        return view("frontend.signup", compact(['hear_abouts', 'addcarts']));
    }

    public function login()
    {
        $addcarts = [];
        return view("frontend.login", compact('addcarts'));
    }

    public function design_career()
    {
        $section1 = Page::where('type_id', Page::TYPE_DESIGN_CAREER)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.design_career", compact(['section1']));
    }

    public function our_book()
    {
        $section1 = Page::where('type_id', Page::TYPE_OUR_BOOK)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.our_book", compact(['section1']));
    }

    public function financing()
    {
        $section1 = Page::where('type_id', Page::TYPE_FINANCING)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.financing", compact(['section1']));
    }

    public function stories()
    {
        $section1 = Page::where('type_id', Page::TYPE_STORIES)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.stories", compact(['section1']));
    }

    public function gift_card()
    {
        $section1 = Page::where('type_id', Page::TYPE_GIFT_CARD)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.gift_card", compact(['section1']));
    }

    public function refer_earn()
    {
        $section1 = Page::where('type_id', Page::TYPE_REFER_EARN)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.refer_earn", compact(['section1']));
    }

    public function help_center()
    {
        $section1 = Page::where('type_id', Page::TYPE_HELP_CENTER)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.help_center", compact(['section1']));
    }

    public function current_promotion()
    {
        $section1 = Page::where('type_id', Page::TYPE_CURRENT_PROMOTION)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.current_promotion", compact(['section1']));
    }

    public function review()
    {
        $section1 = Page::where('type_id', Page::TYPE_REVIEW)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        return view("frontend.review", compact(['section1']));
    }

    public function designer_login()
    {
        return view("frontend.designer_login");
    }

    public function storeEnquiry(Request $request)
    {
        $data = $request->validate($this->getValidation3());
        $model = new Enquiry();
        $model->fill($data);
        $model->subject = $request->subject;
        $model->message = $request->message;
        $model->save();
        $setting = Setting::where('created_by', 1)->first();
        $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY_ADMIN])->first();
        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY])->first();

        if ((!empty($setting)) && (!empty($email_template_admin))) {
            Mail::send('emails.enquiry', ['model' => $model, 'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to([$setting->admin_email])->subject(__('Contact Query'));
            });
        }
        if (!empty($email_template)) {
            Mail::send('emails.thank_message5', ['model' => $model, 'email_template' => $email_template], function ($m) use ($model) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($model->email, $model->name)->subject(__('Contact Query'));
            });
        }
        return redirect()->back()->withSuccess(__('Enquiry Submitted Successfuly'));
    }

    public function apply_job($slug)
    {
        if (Job::where(['slug' => $slug, 'status' => 1])->count() == 0) {
            abort(404);
        }
        $job_detail = Job::where('status', 1)->where('slug', $slug)->first();
        $apply_forms = ApplyForm::where('status', 1)->get();
        $page_title = PageTitle::where('type', PageTitle::TYPE_APPLY_JOB)->first();
        return view("frontend.apply_job", compact(['job_detail', 'apply_forms', 'page_title']));
    }

    public function apply_job_post(Request $request)
    {
        $data = $request->validate($this->getValidation4($request), [
            'form_answers.*.required' => 'The portfolio link field is required.',
        ]);
        $apply_job = ApplyJob::where(['status' => 1, 'job_id' => $request->job_id, 'email' => $request->email])->first();
        if (!empty($apply_job)) {
            return redirect()->back()->withError(__('You already applied for this role'));
        }
        $model = new ApplyJob();
        if ($request->hasFile('cv')) {
            $cvName = $request->cv->getClientOriginalName();

            $request->cv->move(public_path('uploads/cv'), $cvName);
            $model->cv = $cvName;
        }
        if ($request->hasFile('cover_letter')) {
            $cover_letterName = $request->cover_letter->getClientOriginalName();

            $request->cover_letter->move(public_path('uploads/cover_letter'), $cover_letterName);
            $model->cover_letter = $cover_letterName;
        }
        /*if ($request->hasFile('profile_image')) {
            $profile_imageName =$request->profile_image->getClientOriginalName();

            $request->profile_image->move(public_path('uploads'), $profile_imageName);
            $model->profile_image=$profile_imageName;
			}*/
        if ($request->form_questions) {
            $form_questions = implode(",", $request->form_questions);
        } else {
            $form_questions = "";
        }
        if ($request->form_answers) {
            $form_answers = json_encode($request->form_answers);
        } else {
            $form_answers = "";
        }
        $model->fill($data);
        //$model->cover_letter=$cover_letterName;
        $model->cv = $cvName;
        //$model->profile_image=$profile_imageName;
        $model->job_id = $request->job_id;
        //$model->hispanic_ethnicity=$request->hispanic_ethnicity;
        $model->form_questions = $form_questions;
        $model->form_answers = $form_answers;
        $model->save();

        $job_detail = Job::where('status', 1)->where('id', $request->job_id)->first();

        $setting = Setting::where('created_by', 1)->first();
        $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_APPLY_JOB_ADMIN])->first();
        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_APPLY_JOB])->first();

        if ((!empty($setting)) && (!empty($email_template_admin))) {
            Mail::send('emails.apply_job', ['model' => $model, 'job_detail' => $job_detail, 'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to([$setting->admin_email])->subject(__('Apply Job'));
            });
        }
        if (!empty($email_template)) {
            Mail::send('emails.thank_message6', ['model' => $model, 'job_detail' => $job_detail, 'email_template' => $email_template], function ($m) use ($model) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($model->email, $model->first_name)->subject(__('Apply Job'));
            });
        }
        return redirect()->back()->withSuccess(__('Application Sent'));
    }

    public function how_it_work()
    {
        $section1 = Page::where('type_id', Page::TYPE_HOW_IT_WORK)->where('section_index', Page::SECTION_INDEX_ONE)->first();
        $subscriptions = Subscription::where('status', 1)->get();
        $quiz_questions = DB::select("SELECT * FROM `tbl_quiz_questions` WHERE tbl_quiz_questions.status=1 and tbl_quiz_questions.id IN(SELECT DISTINCT(question_id) FROM `tbl_quiz_answers` WHERE tbl_quiz_answers.status=1)");
        return view("frontend.how_it_work", compact(['subscriptions', 'quiz_questions', 'section1']));
    }


    public function reset_password()
    {
        return view("frontend.reset_password");
    }

    public function designer_reset_password()
    {
        return view("frontend.designer_reset_password");
    }

    public function reset_password_post(Request $request)
    {
        $request->validate(['username' => 'required',]);
        $model = User::where('email', $request->get('username'))
            ->where('role_id', 2)
            ->first();
        if (empty($model)) {
            return redirect()->back()
                ->with("emailError", __("Invalid Username or Email!!!"));
        }
        if ($model->status == 0) {
            return redirect()
                ->back()
                ->with("accountError", __("Your account deactivated, please contact admin!"));
        }
        $email = $model->email;
        $token = md5($email);
        $model->email_verify = 0;
        $model->email_token = $token;
        $model->save();

        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_RESET_PASSWORD])->first();
        if (!empty($email_template)) {
            Mail::send('emails.reset_password', ['model' => $model, 'email_template' => $email_template], function ($m) use ($model) {
                $m->from('raju.smarttechnica@gmail.com', env('APP_NAME'));
                $m->to($model->email)
                    ->subject(__('Reset Password'));
            });
        }

        return redirect()->route('frontend.login')->withSuccess(__('A reset password link has been sent to your email'));
    }

    public function designer_reset_password_post(Request $request)
    {
        $request->validate(['username' => 'required',]);
        $model = User::where('email', $request->get('username'))
            ->where('role_id', 3)
            ->first();
        if (empty($model)) {
            return redirect()->back()
                ->with("emailError", __("Invalid Username or Email!!!"));
        }
        if ($model->status == 0) {
            return redirect()
                ->back()
                ->with("accountError", __("Your account deactivated, please contact admin!"));
        }
        $email = $model->email;
        $token = md5($email);
        $model->email_verify = 0;
        $model->email_token = $token;
        $model->save();

        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_RESET_PASSWORD])->first();
        if (!empty($email_template)) {
            Mail::send('emails.designer_reset_password', ['model' => $model, 'email_template' => $email_template], function ($m) use ($model) {
                $m->from('raju.smarttechnica@gmail.com', env('APP_NAME'));
                $m->to($model->email)
                    ->subject(__('Reset Password'));
            });
        }

        return redirect()->route('frontend.designer.login')->withSuccess(__('A reset password link has been sent to your email'));
    }

    public function reset_password_new($token)
    {
        $model = User::where('email_token', $token)->first();
        if (empty($model)) {
            abort(404);
        }
        $userId = $model->id;
        return view("frontend.reset_password_new", compact(['userId']));
    }

    public function designer_reset_password_new($token)
    {
        $model = User::where('email_token', $token)->first();
        if (empty($model)) {
            abort(404);
        }
        $userId = $model->id;
        return view("frontend.designer_reset_password_new", compact(['userId']));
    }

    public function reset_password_new_post(Request $request)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);
        $model = User::where('id', $request->get('user_id'))
            ->first();
        $pass = $request->password;
        if (!empty($model)) {
            $model->password = bcrypt($request->password);
            $model->save();

            $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_NEW_PASSWORD])->first();
            if (!empty($email_template)) {
                Mail::send('emails.reset_password1', ['model' => $model, 'password' => $pass, 'email_template' => $email_template], function ($m) use ($model) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to($model->email)
                        ->subject(__('Reset New Password'));
                });
            }
            return redirect()
                ->route('frontend.login')
                ->withSuccess(__('Your New Password Updated Successfuly'));
        }
    }

    public function designer_reset_password_new_post(Request $request)
    {
        $request->validate(['password' => 'required|min:6|confirmed']);
        $model = User::where('id', $request->get('user_id'))
            ->first();
        $pass = $request->password;
        if (!empty($model)) {
            $model->password = bcrypt($request->password);
            $model->save();

            $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_NEW_PASSWORD])->first();
            if (!empty($email_template)) {
                Mail::send('emails.reset_password1', ['model' => $model, 'password' => $pass, 'email_template' => $email_template], function ($m) use ($model) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to($model->email)
                        ->subject(__('Reset New Password'));
                });
            }
            return redirect()
                ->route('frontend.designer.login')
                ->withSuccess(__('Your New Password Updated Successfuly'));
        }
    }

    public function explore()
    {
        return view("frontend.explore");
    }

    public function project_view($project_id)
    {
        $user = auth()->user();
        $project = ProjectDetail::select('detail_forms.project_duration', 'detail_forms.designer', 'subscriptions.title as subscription_title', 'detail_forms.amount as subscription_amount', 'detail_forms.addons', 'customer_quizzes.answers', 'countries.name as country_name', 'customer_quizzes.questions', 'quiz_categories.title as category_title', 'customer_quizzes.id as quizId', 'customer_quizzes.preferred_bedroom', 'form_answers.title as form_answer', 'detail_forms.room',  'users.first_name', 'users.last_name', 'users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users', 'users.id', 'detail_forms.designer')->leftjoin('quiz_categories', 'quiz_categories.id', 'customer_quizzes.answer_category')->leftjoin('subscriptions', 'subscriptions.id', 'detail_forms.subscription')->leftjoin('countries', 'countries.id', 'detail_forms.country')->leftjoin('form_answers', 'form_answers.id', 'detail_forms.space')
            ->where("project_details.id", $project_id)->where("project_details.status", 1)->first();
        $form_questions = FormQuestion::where('status', 1)->get()->toArray();
        if (!empty($project)) {
            $page_title = PageTitle::where('type', PageTitle::TYPE_PROJECT_VIEW)->first();
            return view('frontend.project_view', compact(['project', 'form_questions', 'page_title']));
        } else {
            abort(404);
        }
    }

    public function designer_bio($model)
    {
        $designer = Designer::where('status', 1)->where('user_id', $model)->first();
        if (!empty($designer)) {
            $page_title = PageTitle::where('type', PageTitle::TYPE_DESIGNER_BIO)->first();
            $designer_images = DesignerImage::where('status', 1)->where('user_id', $model)->get();
            return view('frontend.designer_bio', compact(['designer', 'designer_images', 'page_title']));
        } else {
            abort(404);
        }
    }

    public function project_updates($project_id)
    {
        $page_title = PageTitle::where('type', PageTitle::TYPE_PROJECT_UPDATE)->first();
        $models = ProjectUpdate::where('project_id', $project_id)->paginate(15);
        return view('frontend.project_updates')->with('models', $models)->with('page_title', $page_title);
    }

    public function footer_menu($slug)
    {
        if (FooterMenu::where(['menu_slug' => $slug, 'status' => 1])->count() == 0) {
            abort(404);
        }
        $footer_menu = FooterMenu::where('status', 1)->where('menu_slug', $slug)->first();
        return view("frontend.footer_menu", compact(['footer_menu']));
    }

    protected function getValidation3()
    {
        return [
            'name' => 'required',
            'email' => 'required'
        ];
    }

    protected function getValidation4($request)
    {
        $validationarray = [
            'first_name' => 'required',
            'last_name' => 'required',
            'email' => 'required|email',
            'phone_number' => 'required',
            //'linkedin_profile'=>'required',
            'cv' => 'required|mimes:doc,docx,pdf|max:10240',
            'cover_letter' => 'mimes:doc,docx,pdf|max:10240',
            'profile_image' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            // 'form_answers' => 'required|array|min:1',
            // 'form_answers.0' => 'required'
            //'gender'=>'required',
            /*'sponsorship'=>'required',
            'relocation'=>'required',
            'career_opportunity'=>'required',
            'veteran_status'=>'required',
			'disability_status'=>'required'*/
        ];
        if ($request->job_id == 3) {
            $validationarray['form_answers'] = 'required|array|min:1';
            $validationarray['form_answers.0'] = 'required';
        }
        return $validationarray;
    }
}

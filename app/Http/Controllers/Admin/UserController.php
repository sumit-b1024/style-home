<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\Designer;
use App\Models\PaymentRequest;
use App\Models\Setting;
use App\Models\EmailTemplate;
use Mail;

class UserController extends Controller
{

    public function chat(User $model)
    {
        return view('admin.user.chat', ['model' => $model]);
    }

    public function designer_registration(Request $request)
    {
        $apply_id = $request->apply_id;
        $job_id = $request->job_id;
        $applied_designer = ApplyJob::where("apply_jobs.status", 1)->where("apply_jobs.id", $apply_id)->first();
        if (empty($applied_designer)) {
            return redirect()->back()->withError(__('This Applied job not valid!'));
        }
        $pass = 123456;
        $model = new User();
        $model->role_id = 3;
        $model->first_name = $applied_designer->first_name;
        $model->last_name = $applied_designer->last_name;
        $model->email = $applied_designer->email;
        $model->phone_number = $applied_designer->phone_number;
        $model->job_id = $job_id;
        $model->apply_id = $apply_id;
        $model->password = bcrypt($pass);
        $model->save();
        $user_id = $model->id;
        if ($user_id) {

            $designer = new Designer();
            $designer->user_id = $user_id;
            $designer->first_name = $applied_designer->first_name;
            $designer->last_name = $applied_designer->last_name;
            $designer->email = $applied_designer->email;
            $designer->phone_number = $applied_designer->phone_number;
            $designer->job_id = $job_id;
            $designer->apply_id = $apply_id;
            $designer->cv = $applied_designer->cv;
            $designer->cover_letter = $applied_designer->cover_letter;
            $designer->profile_image = $applied_designer->profile_image;
            $designer->linkedin_profile = $applied_designer->linkedin_profile;
            $designer->sponsorship = $applied_designer->sponsorship;
            $designer->relocation = $applied_designer->relocation;
            $designer->career_opportunity = $applied_designer->career_opportunity;
            $designer->gender = $applied_designer->gender;
            $designer->hispanic_ethnicity = $applied_designer->hispanic_ethnicity;
            $designer->veteran_status = $applied_designer->veteran_status;
            $designer->disability_status = $applied_designer->disability_status;
            $designer->save();
            $setting = Setting::where('created_by', 1)->first();
            $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_SIGNUP_DESIGNER_ADMIN])->first();
            $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_SIGNUP_DESIGNER])->first();
            if ($designer->job_id == 3) {
                if ((!empty($setting)) && (!empty($email_template_admin))) {
                    Mail::send('emails.signupSuccess', ['model' => $model, 'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                        $m->from('styleahome01@gmail.com', env('APP_NAME'));
                        $m->to([$setting->admin_email])->subject(__('Signup'));
                    });
                }
            }
            if ($designer->job_id == 3) {
                if (!empty($email_template)) {
                    Mail::send('emails.thank_message', ['model' => $model, 'password' => $pass, 'email_template' => $email_template], function ($m) use ($model) {
                        $m->from('styleahome01@gmail.com', env('APP_NAME'));
                        $m->to($model->email, $model->first_name)->subject(__('Signup'));
                    });
                }
            }
            return redirect()->back()->withSuccess(__('Designer Account Created Successfuly'));
        } else {
            return redirect()->back()->withError(__('Something went wrong, please try again'));
        }
    }

    public function index()
    {
        $models = User::where("role_id", User::ROLE_CUSTOMER)->paginate();
        return view('admin.user.index')->with('models', $models);
    }

    public function designer_user()
    {
        $models = User::where("role_id", User::ROLE_DESIGNER)->paginate();
        return view('admin.user.designer_user')->with('models', $models);
    }

    public function user_inactive(User $model)
    {
        //print_r($model);
        $model->status = 0;
        $model->save();
        return redirect()->back()->withSuccess(__('User Unactivated Successfuly'));
    }
    public function user_active(User $model)
    {
        $model->status = 1;
        $model->save();
        return redirect()->back()->withSuccess(__('User Activated Successfuly'));
    }

    public function update(User $model)
    {
        return view('admin.user.update', ['model' => $model]);
    }

    public function doUpdate(Request $request, User $model)
    {
        $data = $request->validate($this->getValidation() + ['company_logo' => 'image|mimes:jpeg,png,jpg,gif|max:2048',]);

        $model->fill($data);
        if ($request->hasFile('company_logo')) {
            $imageName = time() . '.' . $request->company_logo->getClientOriginalExtension();

            $request->company_logo->move(public_path('uploads'), $imageName);
            $model->company_logo = $imageName;
        }
        $model->save();
        return redirect()->back()->withSuccess(__('Job Updated Successfuly'));
    }

    public function store(Request $request)
    {

        $data = $request->validate($this->getValidation() + ['company_logo' => 'required|image|mimes:jpeg,png,jpg,gif|max:2048']);
        // dd($data);
        $imageName = time() . '.' . $request->company_logo->getClientOriginalExtension();

        $request->company_logo->move(public_path('uploads'), $imageName);

        $model = new Job();
        $model->fill($data);
        $model->company_logo = $imageName;
        $model->save();

        return redirect()->back()->withSuccess(__('Job Added Successfuly'));
    }

    public function chat_communication()
    {
        $designers = Designer::where('status', 1)->get();
        return view('admin.enquiry.chat')->with('designers', $designers);
    }

    public function delete(Job $model)
    {
        $model->delete();

        return redirect()->back()->withSuccess(__('User Deleted Successfuly'));
    }

    public function designer_payment()
    {
        $payment_requests = PaymentRequest::where('status', 1)->orderBy('id', 'desc')->with(['users', 'project_details.users'])->get();
        return view('admin.enquiry.designer_payment')->with('payment_requests', $payment_requests);
    }

    public function designer_payment_post(Request $request, $model)
    {
        $payment_request = PaymentRequest::where('status', 1)->where('id', $model)->first();
        $user = User::where('status', 1)->where('id', $request->user_id)->first();
        $payment_request->request_status = $request->request_status;
        $payment_request->save();
        $setting = Setting::where('created_by', 1)->first();
        if (!empty($setting)) {
            Mail::send('emails.request_status', ['model' => $payment_request], function ($m) use ($setting) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to([$setting->admin_email])->subject(__('Payment Request Status'));
            });
        }
        Mail::send('emails.thank_message4', ['model' => $payment_request], function ($m) use ($user) {
            $m->from('styleahome01@gmail.com', env('APP_NAME'));
            $m->to($user->email, $user->first_name)->subject(__('Payment Request Status'));
        });
        return redirect()->back()->withSuccess(__('Payment Request Status Changed Successfuly'));
    }

    protected function getValidation()
    {
        return [
            'title' => 'required',
            'type_id' => 'required',
            'contact_number' => 'required',
            'company_name' => 'required',
            'job_rating' => 'required|numeric',
            'skype_username' => 'required',
            'address' => 'required',
            'desc' => 'required',
            'required_knowledge_desc' => 'required',
            'education_desc' => 'required',
            'company_overview' => 'required',
            'experiance' => 'required|numeric',
            'salary_from' => 'required|numeric',
            'salary_to' => 'required|numeric',
            'qualification' => 'required',
            'contact_email' => 'required|email',
            'short_desc' => 'required'
        ];
    }
}

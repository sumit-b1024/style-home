<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\PaymentRequest;
use App\Models\Setting;
use App\Models\EmailTemplate;
use App\Models\ProjectDetail;
use Session;
use Mail;

class PaymentRequestController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $models = PaymentRequest::where('user_id', $user->id)->orderBy('id', 'desc')->paginate(10);
        return view('admin.payment-request.index')->with('models', $models);
    }

    public function add()
    {
        $project_ids = PaymentRequest::select(['project_detail_id'])->get();
        $project_details = ProjectDetail::whereNotIn('id', $project_ids->pluck('project_detail_id'))->select(['id', 'title'])->get();
        return view('admin.payment-request.add', compact('project_details'));
    }

    public function update(PaymentRequest $model)
    {
        $project_ids = PaymentRequest::select(['project_detail_id'])->get();
        $project_details = ProjectDetail::select(['id', 'title'])->get();
        return view('admin.payment-request.update', ['model' => $model,'project_details' => $project_details]);
    }

    public function doUpdate(Request $request, PaymentRequest $model)
    {
        $data = $request->validate($this->getValidation());
        $model->fill($data);
        $model->title = $request->title;
        $model->message = $request->message;
        $model->save();
        $user = auth()->user();
        $name = $user->first_name . " " . $user->last_name;

        $setting = Setting::where('created_by', 1)->first();
        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_PAYMENT_REQUEST])->first();
        if (!empty($setting)) {
            Mail::send('emails.payment_request', ['model' => $model, 'name' => $name], function ($m) use ($setting) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to([$setting->admin_email])->subject(__('Payment Request'));
            });
        }
        if (!empty($email_template)) {
            Mail::send('emails.thank_message3', ['model' => $model, 'email_template_admin' => $email_template], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email, $user->first_name)->subject(__('Payment Request'));
            });
        }
        return redirect()->back()->withSuccess(__('Payment Request Successfuly'));
    }

    public function store(Request $request)
    {
        $user = auth()->user();
        $data = $request->validate($this->getValidation());
        $model = new PaymentRequest();
        $model->fill($data);
        $model->project_detail_id = $request->project_id;
        $model->user_id = $user->id;
        $model->title = $request->title;
        $model->message = $request->message;
        $model->save();
        $name = $user->first_name . " " . $user->last_name;
        $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY_ADMIN])->first();
        // $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY])->first();
        Mail::send('emails.payment_request', ['model' => $model, 'name' => $name], function ($m) use ($model) {
            $m->from('styleahome01@gmail.com', env('APP_NAME'));
            $m->to(['styleahome01@gmail.com'])->subject(__('Payment Request'));
        });
        if ((!empty($email_template_admin))) {
            Mail::send('emails.thank_message3', ['model' => $model, 'email_template_admin' => $email_template_admin], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email, $user->first_name)->subject(__('Payment Request'));
            });
        }
        return redirect()->back()->withSuccess(__('Payment Request Send Successfuly'));
    }

    public function delete(PaymentRequest $model)
    {
        $model->delete();
        return redirect()->back()->withSuccess(__('Faq Deleted Successfuly'));
    }

    protected function getValidation()
    {
        return [
            'project_id' => 'required',
            'title' => 'required',
            'message' => 'required'
        ];
    }
}

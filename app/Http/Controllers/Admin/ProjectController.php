<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\ProjectDetail;
use App\Models\DetailForm;
use App\Models\CustomerQuiz;
use App\Models\FormQuestion;
use App\Models\ProjectUpdate;
use App\Models\PurchaseProduct;
use App\User;
use Session;
use Mail;

class ProjectController extends Controller
{
    public function customer_project()
    {
        $projects = ProjectDetail::select('detail_forms.project_duration','detail_forms.created_at as Designer_date','detail_forms.designer', 'customer_quizzes.preferred_bedroom','cust_users.email as cust_email', 'cust_users.first_name as cust_firstname','cust_users.last_name as cust_lastname',  'desi_users.first_name','desi_users.last_name','desi_users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users as desi_users', 'desi_users.id', 'detail_forms.designer')
            ->join('users as cust_users', 'cust_users.id', 'detail_forms.user_id')
            ->where("project_details.status",1)->paginate(15);

        return view('admin.project-update.customer_project')->with('projects',$projects) ;
    }


    public function reassign(ProjectDetail $projectDetail) 
    {
         $designers = User::where("role_id", User::ROLE_DESIGNER)->where("status","1")->with('designer')->paginate();
     
return view('admin.project-update.reassign')->with('designers',$designers)->with('projectDetail',$projectDetail);
    }


        public function reassignConfirm(ProjectDetail $projectDetail,User $user) 
    {
          $projectDetail->detailForm->designer=$user->id ; 
            $projectDetail->detailForm->save();

              \Mail::send('emails.reapplied_notify', ['user' => $user, 'projectDetail' => $projectDetail  ], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email, $user->first_name)->subject(__('New project (reassigned)'));
            });


     return redirect()->back()->withSuccess(__('Designer '.$user->getFullName().' assigned Successfuly'));


    }


	public function customer_project_view($project_id)
    {
        $project = ProjectDetail::select('detail_forms.project_duration','detail_forms.designer','subscriptions.title as subscription_title','detail_forms.amount as subscription_amount','detail_forms.addons','customer_quizzes.answers','countries.name as country_name','customer_quizzes.questions','quiz_categories.title as category_title','customer_quizzes.id as quizId', 'customer_quizzes.preferred_bedroom','form_answers.title as form_answer','detail_forms.room',  'users.first_name','users.last_name','users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('customer_quizzes', 'customer_quizzes.id', 'detail_forms.quiz_id')
            ->join('users', 'users.id', 'detail_forms.designer')->leftjoin('quiz_categories', 'quiz_categories.id', 'customer_quizzes.answer_category')->leftjoin('subscriptions', 'subscriptions.id', 'detail_forms.subscription')->leftjoin('countries', 'countries.id', 'detail_forms.country')->leftjoin('form_answers', 'form_answers.id', 'detail_forms.space')
            ->where("project_details.id", $project_id)->where("project_details.status",1)->first();
                $purchaseProducts= PurchaseProduct::where('quiz_id',$project->quizId)->get();
                 
            $form_questions = FormQuestion::where('status',1)->get()->toArray();
        if(!empty($project)){
        return view('admin.project-update.customer_project_view')->with('project',$project)->with('form_questions',$form_questions) ;
        }
        else{
            abort(404);
        }
    }

    public function customer_project_update($project_id){
        $models=ProjectUpdate::where('project_id',$project_id)->paginate(15);
        return view('admin.project-update.customer_project_update')->with('models',$models);
    }

}

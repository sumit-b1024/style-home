<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Enquiry;
use App\Models\ApplyJob;
use App\Models\Job;

class EnquiryController extends Controller
{

    public function index()
    {

        $models = Enquiry::orderBy('id', 'desc')->paginate(15);

        return view('admin.enquiry.index', ['models' => $models]);
    }

    public function applied_designer(){
		$applied_designers=ApplyJob::select('jobs.name as job_title','apply_jobs.*')->join('jobs','jobs.id','apply_jobs.job_id')->where("apply_jobs.status",1)->paginate();
        return view('admin.enquiry.applied_designer', ['applied_designers' => $applied_designers]);
	}

	public function view_applied_designer($model){
		$applied_designer=ApplyJob::select('jobs.name as job_title','apply_jobs.*')->join('jobs','jobs.id','apply_jobs.job_id')->where("apply_jobs.status",1)->where("apply_jobs.id",$model)->first();
        return view('admin.enquiry.view_applied_designer', ['applied_designer' => $applied_designer]);
	}

}

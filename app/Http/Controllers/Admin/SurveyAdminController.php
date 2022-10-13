<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\DetailForm;
use App\Models\CustomerQuiz;

class SurveyAdminController extends Controller
{
    public function index()
    {
        $user = auth()->user();
        $detail_forms = DetailForm::select(['quiz_id'])->get();
        $customer_quizs = CustomerQuiz::whereNotIn('id', $detail_forms->pluck('quiz_id'))
            ->select(['id', 'user_id', 'created_at'])
            ->with(['users' => function ($q) {
                $q->select(['id','first_name','last_name','email']);
            }])->limit(1)->paginate(15);
        return view('admin.survey.index', compact('customer_quizs'));
    }
}

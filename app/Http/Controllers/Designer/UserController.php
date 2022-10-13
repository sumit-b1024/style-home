<?php

namespace App\Http\Controllers\Designer;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\User;
use App\Models\ApplyJob;
use App\Models\Job;
use App\Models\ProjectDetail;
use App\Models\Message;
class UserController extends Controller
{
    public function customer() 
    {
        $models=User::where("role_id",User::ROLE_CUSTOMER)->paginate()  ; 
        return view('admin.enquiry.customer')->with('models',$models) ;
    }
	public function customer_chat($model) 
    {
        $user_id = auth()->user()->id;
		$chats = Message::where("to_id",$user_id)->where("project_id",$model)->get()  ;
		if(count($chats)>0){
			foreach($chats as $chat){
				$chat->view_status=1;
				$chat->save();
			}
		}
		$project = ProjectDetail::select('detail_forms.designer', 'users.first_name','users.last_name','users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')->join('users', 'users.id', 'project_details.user_id')->where("detail_forms.designer", $user_id)->where("project_details.id",$model)->where("project_details.status",1)->first();
        return view('admin.enquiry.customer_chat',['model'=>$project]);
    }
    
}

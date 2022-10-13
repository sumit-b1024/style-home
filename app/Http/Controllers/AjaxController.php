<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Mail;
use Validator;
use Illuminate\Http\JsonResponse;
use File;
use Illuminate\Validation\ValidationException;
use Auth;
use Illuminate\Support\Facades\DB;
use App\Models\Message;
class AjaxController extends Controller
{
   public function getcustomers(Request $request){
        $designer = $request->input('designer');
        $customers=DB::select("SELECT * FROM `tbl_users` where id IN (SELECT DISTINCT user_id FROM `tbl_detail_forms` WHERE designer='$designer')");
        if (count($customers)>0) {
            $option = "<option value=''>Select Customer</option>";
            foreach ($customers as $item) {
                $name= $item->first_name.' '.$item->last_name;
                $option .= "<option value='" . $item->id . "'>" . $name . "</option>";
            }
            return response()->json(array(
                'status' => 'success',
                'customers' => $option
            ));
        } else {
            return response()->json(array(
                'status' => 'error',
                'msg' => 'Currently No Customer found'
            ));
        }
   }
   
   public function get_admin_chat(Request $request) 
    {
        $currentUserId=Auth()->user()->id;
        $designer = $request->input('designer');
        $customer = $request->input('customer');
        $id=(int)$request->get("message_id");
        $models=Message::where("id",">",$id)->where(function($query) use ($currentUserId){
            $query->where("from_id",$currentUserId)->orWhere("to_id",$currentUserId);
        })->orderBy("id","ASC");

        if(Auth()->user()->role_id==User::ROLE_ADMIN)
        {
            $models=Message::where("id",">",$id)->where(function($query) use ($designer,$customer){
                /*$query->where("from_id",$request->get("user_id"))->orWhere("to_id",$request->get("user_id"));
            })->orderBy("id","ASC");*/
            
            $query->where("from_id",$designer)->where("to_id",$customer)->orWhere("from_id",$customer)->where("to_id",$designer);
            })->orderBy("id","ASC");

        }
        $models=$models->get();
        $response=[];
        $data=[];
        $max_id=($models->max('id'));
        if(count($models)>0){
        foreach($models as $model)
        {
             
            $time=$model->created_at->format("h:i A");
            $timeStampLabel=$model->created_at->format("F d");
    
                if(date("Y-m-d")==$model->created_at->format('Y-m-d'))                
                {
                    $timeStampLabel="Today";
                }
                else
                if(date("Y-m-d",strtotime("- 1 day",strtotime(date("Y-m-d"))))==$model->created_at->subDays(1)->format('Y-m-d') )
                {
                    $timeStampLabel="Yesterday";
                }
             
        
            $timestamp="$time $timeStampLabel";
            $msgStatus=($model->to_id==$customer)?'recieved':'sent';
            if($model->type_id===Message::TYPE_ATTACHMENT)
            {
                $model->message="<a target='_blank' href='".$model->getAttachmentUrl()."'>".$model->message." <i class='fa fa-download'></i></a>";
            }
            $data[]=['message'=>$model->message,'id'=>$model->id,'timestamp'=>$timestamp,'msg_status'=>$msgStatus];
        }
    
        $response['max_id']=$max_id;
        $response['data']=$data;
        $response['status']='OK';
        }
        else{
            $response['status']='NOK';
        }
        return $response ; 
    }
    
}

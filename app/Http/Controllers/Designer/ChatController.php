<?php

namespace App\Http\Controllers\Designer;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\Message;
use Validator; 
use App\User;
use App\Models\Banner;
use App\Models\Page;
use App\Models\File;
use Mail;
class ChatController extends Controller
{
    public function index() 
    {
        if(!(auth()->user() && auth()->user()->role_id==User::ROLE_CUSTOMER))
        {
            return redirect()->route('frontend.home');
        }
        $banner=Banner::where('type_id',Page::TYPE_CHAT)->first();
        return view('frontend.chat.index')->with('banner',$banner); 
    }

    public function upload(Request $request,$user_id=null)
    {
        $response=[];
        $response['status']='NOK';
        $response['message']="Something went Wrong !!!";
        $validator = Validator::make($request->all(),[ 'attachment' => 'required|mimes:pdf,doc,docx,jpeg,png,jpg,gif|max:10000',] );

        if (!$validator->passes()) {


             $response['message']=($validator->errors()->first());
             return $response;

        }
        if($request->hasFile('attachment')) 
        {
            $imageName = time()."_".uniqid() . '.' . $request->attachment->getClientOriginalExtension();
            $originalName=$request->attachment->getClientOriginalName();
            $request->attachment->move(public_path('uploads'), $imageName);
            $model= new Message() ;
            $user_id=$request->get('user_id');
            $project_id=$request->get('project_id');
            $model->from_id=auth()->user()->id; 
            $model->to_id=( auth()->user()->role_id==User::ROLE_CUSTOMER )?1:$user_id;
            $model->message=$originalName;
            $model->project_id=$project_id;
            $model->type_id=Message::TYPE_ATTACHMENT;
            $model->save(); 

            $file=new File ; 
            $file->title=$originalName;
            $file->path=$imageName;
            $file->model_type=get_class($model);
            $file->model_id=$model->id;
            $file->save();
            $response['status']='OK';
            
            $email=auth()->user()->email;
            $name=auth()->user()->first_name;
    		$user1 = User::where('id', $request->get('user_id'))->first();
    		if(!empty($user1)){
    		    $name1= $user1->first_name;
    		Mail::send('emails.new_message', ['file'=>$file,'email'=>$email,'name'=>$name,'name1'=>$name1], function ($m) use ($user1)
    		{
    			$m->from('styleahome01@gmail.com', env('APP_NAME'));
    			$m->to($user1->email)
    				->subject(__('New Message'));
    		});
    		}
        }


        return $response; 
    }

    public function sendMessage(Request $request) 
    {
        $response=[];
        $response['status']='NOK';
        $validator = Validator::make($request->all(), $this->getValidation());
        $toUser=1;
        $project_id=0;
        if(auth()->user()->role_id==User::ROLE_DESIGNER)
        {
            $toUser=$request->get('user_id');
            $project_id=$request->get('project_id');
        }
        if (!$validator->passes()) {


			return response()->json($response);
        }
        $model= new Message() ;
        $model->from_id=auth()->user()->id; 
        $model->to_id=$toUser;
        $model->message=$request->get('message');
        $model->project_id=$project_id;
        $model->type_id=Message::TYPE_NORMAL;
        $model->save(); 
        $response['status']='OK';
        
        $email=auth()->user()->email;
        $name=auth()->user()->first_name;
		$user1 = User::where('id', $request->get('user_id'))->first();
		if(!empty($user1)){
		    $name1= $user1->first_name;
		Mail::send('emails.new_message1', ['model'=>$model,'email'=>$email,'name'=>$name,'name1'=>$name1], function ($m) use ($user1)
		{
			$m->from('styleahome01@gmail.com', env('APP_NAME'));
			$m->to($user1->email)
				->subject(__('New Message'));
		});
		}
        return response()->json($response);

    }

    public function getMessages(Request $request) 
    {
        $currentUserId=Auth()->user()->id;
        $id=(int)$request->get("message_id");
        $project_id=(int)$request->get("project_id");
        $models=Message::where("id",">",$id)->where('project_id',$project_id)->where(function($query) use ($currentUserId){
            $query->where("from_id",$currentUserId)->orWhere("to_id",$currentUserId);
        })->orderBy("id","ASC");

        if(Auth()->user()->role_id==User::ROLE_DESIGNER)
        {
            $models=Message::where("id",">",$id)->where('project_id',$project_id)->where(function($query) use ($currentUserId,$request){
                /*$query->where("from_id",$request->get("user_id"))->orWhere("to_id",$request->get("user_id"));
            })->orderBy("id","ASC");*/
            
            $query->where("from_id",$currentUserId)->where("to_id",$request->get("user_id"))->orWhere("from_id",$request->get("user_id"))->where("to_id",$currentUserId);
            })->orderBy("id","ASC");

        }
        $models=$models->get();
        $response=[];
        $data=[];
        $max_id=($models->max('id'));
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
            $msgStatus=($model->to_id==$currentUserId)?'recieved':'sent';
            if($model->type_id===Message::TYPE_ATTACHMENT)
            {
                $model->message="<a target='_blank' href='".$model->getAttachmentUrl()."' style='color:#fff;'>".$model->message." <i class='fa fa-download'></i></a>";
            }
            $data[]=['message'=>$model->message,'id'=>$model->id,'timestamp'=>$timestamp,'msg_status'=>$msgStatus];
        }
        $response['max_id']=$max_id;
        $response['data']=$data;
        return $response ; 
    }

    protected function getValidation()
    {
        return ['message'=>'required'];
    }
}

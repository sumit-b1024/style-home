<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use Illuminate\Support\Str;
use Mail;
use Hash;
use Validator;
use Illuminate\Validation\ValidationException;
use Auth;
use App\Models\Message;
use App\Models\QuizTemp;
use App\Models\CustomerQuiz;
use App\Models\DetailForm;
use App\Models\ProjectDetail;
use App\Models\QuizCategory;
use App\Models\QuizAnswer;
use App\Models\Designer;
use App\Models\Setting;
use App\Models\EmailTemplate;
use App\Models\PageTitle;
use App\Models\DetailFormRoom;
use App\Models\Coupon;
use App\Models\AddToCart;

class UserController extends Controller
{
    public function login(Request $request)
    {
        $request->validate([
            'username' => 'required',
            'password' => 'required'
        ]);
        $model = User::where('email', $request->get('username'))->where('role_id', 2)->first();
        if (empty($model)) {
            return redirect()->back()->with("emailError", __("No Customer found with this email.  Please register with us in order to proceed"));
        }
        if ($model->status == 0) {
            return redirect()->back()->with("accountError", __("Email ID has been deactivated. Please contact the customer support team."));
        }

        if (!Hash::check($request->get('password'), $model->password)) {
            return redirect()->back()->with("passwordError", __("Wrong Password"));
        }
        Auth::login($model);
        if ($model->role_id == 2) {
            $project_detail = ProjectDetail::where('user_id', $model->id)->where('status', 1)->first();
            if (!empty($project_detail)) {
                return redirect()->route('frontend.project');
            } else {
                return redirect()->route('frontend.home');
            }
            //return redirect()->route('frontend.project');
        } else {
            return redirect()->back()->with("emailError", __("Something went wrong, please try again!"));
        }
    }

    public function designer_login(Request $request)
    {
        $request->validate([
            'email' => 'required',
            'password' => 'required'
        ]);
        $model = User::where('email', $request->get('email'))->where('role_id', 3)->first();
        if (empty($model)) {
            return redirect()->back()->with("emailError", __("Invalid Email!!!"));
        }
        if ($model->status == 0) {
            return redirect()->back()->with("accountError", __("Your Account Deactivated, Please Contact Admin!"));
        }

        if (!Hash::check($request->get('password'), $model->password)) {
            return redirect()->back()->with("passwordError", __("Password Not Match"));
        }
        Auth::login($model);
        if ($model->role_id == 3) {
            return redirect()->route('admin.designer.dashboard');
        } else {
            return redirect()->back()->with("emailError", __("Something went wrong, please try again!"));
        }
    }

    public function registerPost(Request $request)
    {
        $data = $request->validate($this->getValidation());
        $model = new User($data);
        $pass = $request->password;
        $model->role_id = 2;
        $model->password = bcrypt($request->password);
        $model->first_name = $request->first_name;
        $model->email = $request->email;
        $model->last_name = $request->last_name;
        $model->save();

        $setting = Setting::where('created_by', 1)->first();
        $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_SIGNUP_CUSTOMER_ADMIN])->first();
        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_SIGNUP_CUSTOMER])->first();
        if ((!empty($setting)) && (!empty($email_template_admin))) {
            Mail::send('emails.signupSuccess1', ['model' => $model, 'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to([$setting->admin_email])->subject(__('Signup'));
            });
        }
        if (!empty($email_template)) {
            Mail::send('emails.thank_message1', ['model' => $model, 'password' => $pass, 'email_template' => $email_template], function ($m) use ($model) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($model->email, $model->first_name)->subject(__('Signup'));
            });
        }
        return redirect()->route('frontend.login')->withSuccess(__('Your Account Created Successfuly, Please Login Now'));
    }

    /*public function preferred_bedroom(Request $request){
		$response = [];
        $response['status']='NOK';
        $validator = Validator::make($request->all(), [
            'preferred_bedroom' => 'required',
        ]);
        if ($validator->passes()) {
			$user=auth()->user();
            $response['status']='OK';
            $model=new QuizTemp();
            //$model->fill($request->all());
			$model->user_id = $user->id;
			$model->preferred_bedroom = $request->preferred_bedroom;
            $model->save();
            $response['status']='OK';

            return $response;
        }
        return response()->json(array(
    			        'status' => 'NOK',
    			        'errors' => $validator->getMessageBag()->toArray()

    			    ), 201);
	}*/

    public function preferred_bedroom(Request $request)
    {
        /*$answer2 =array();
		$i=6;
		 $aa = "answers_".$i;
		 $xx = ($request->$aa);
		print_r($xx);
		print_r($request->answers_2);
		print_r($request->answers_6);
		print_r($request->questions);

		$question1 = $request->questions;
		 count($question1);
			for($i=2;$i<count($question1)+2;$i++){
				$aa = "answers_".$i;
				$xx = ($request->$aa);
				$xx1 = implode(",",$xx);
					array_push($answer2,$xx1);
				}
				print_r($answer2);
		die();*/
        $user = auth()->user();
        if ((empty($user)) || $user->role_id != 2) {
            if ($request->login_type == 'signup') {
                $response = [];
                $response['status'] = 'NOK';
                $validator = Validator::make($request->all(), [
                    'email' => 'required|email',
                    //'email'=>'required|email|unique:users',
                    'name' => 'required',
                ]);
                $answer2 = [];
                $quiz_category_Ids = [];
                if ($validator->passes()) {
                    $check_email = User::where('email', $request->email)->where('role_id', 2)->first();
                    if (!empty($check_email)) {
                        return response()->json(array(
                            'status' => 'NOK1',
                            'msg' => "This email address is already registered with us"

                        ), 201);
                    }
                    //Login
                    $user = new User();
                    $pass = 123456;
                    $user->first_name = $request->name;
                    $user->email = $request->email;
                    $user->role_id = 2;
                    $user->password = bcrypt($pass);
                    $user->save();
                    $question1 = $request->questions;
                    for ($i = 2; $i < count($question1) + 2; $i++) {
                        $aa = "answers_" . $i;
                        $xx = ($request->$aa);
                        $xx1 = implode(",", $xx);
                        array_push($answer2, $xx1);
                        $xx2 = (int)$xx1;
                        $quiz_categoryId = QuizAnswer::where('id', $xx2)->first();
                        $quiz_category_Ids[] = $quiz_categoryId->category_id;
                    }
                    $values = array_count_values($quiz_category_Ids);
                    arsort($values);
                    $popular = array_slice(array_keys($values), 0, 1, true);
                    $xx3 = (int)implode(",", $popular);
                    $quiz_category = QuizCategory::where('id', $xx3)->first();
                    $category = $quiz_category->title;
                    if ($quiz_category->image) {
                        $category_image = $quiz_category->getQuizCategoryImage();
                    } else {
                        $category_image = "";
                    }
                    $category_description = $quiz_category->description;
                    //$user=auth()->user();
                    $response['status'] = 'OK';
                    $model = new CustomerQuiz();
                    //$model->fill($request->all());
                    $model->user_id = $user->id;
                    $model->questions = implode(",", $request->questions);
                    $model->answers = implode(",", $answer2);
                    $model->categories = implode(",", $quiz_category_Ids);
                    $model->answer_category = $xx3;
                    $model->name = $request->name;
                    $model->email = $request->email;
                    $model->subscription = $request->subscription;
                    $model->amount = $request->subscription_ammount;
                    $model->addons = $request->addons;
                    $model->save();
                    $response['status'] = 'OK';
                    $response['category'] = $category;
                    $response['category_image'] = $category_image;
                    $response['category_description'] = $category_description;
                    $model2 = User::where('email', $request->email)->where('role_id', 2)->first();
                    Auth::login($model2);

                    $setting = Setting::where('created_by', 1)->first();
                    $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY_ADMIN])->first();
                    $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY])->first();
                    if ((!empty($setting)) && (!empty($email_template_admin))) {
                        Mail::send('emails.signupSuccess1', ['model' => $user, 'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                            $m->from('styleahome01@gmail.com', env('APP_NAME'));
                            $m->to([$setting->admin_email])->subject(__('Signup'));
                        });
                    }
                    if (!empty($email_template)) {
                        Mail::send('emails.thank_message1', ['model' => $user, 'password' => $pass, 'email_template' => $email_template], function ($m) use ($user) {
                            $m->from('styleahome01@gmail.com', env('APP_NAME'));
                            $m->to($user->email, $user->first_name)->subject(__('Signup'));
                        });
                    }
                    return $response;
                }
                return response()->json(array(
                    'status' => 'NOK',
                    'errors' => $validator->getMessageBag()->toArray()

                ), 201);
            } else {
                $response = [];
                $response['status'] = 'NOK2';
                $validator = Validator::make($request->all(), [
                    'username' => 'required',
                    'password' => 'required',
                ]);
                $answer2 = [];
                $quiz_category_Ids = [];
                if ($validator->passes()) {
                    $check_user = User::where('email', $request->username)->where('role_id', 2)->first();
                    if (empty($check_user)) {
                        return response()->json(array(
                            'status' => 'NOK3',
                            'msg' => "No Customer found with this Username or Email id, Please create an account by Signup."

                        ), 201);
                    }
                    if ($check_user->status == 0) {
                        return response()->json(array(
                            'status' => 'NOK3',
                            'msg' => "Your Account Deactivated, Please Contact Admin!"

                        ), 201);
                    }
                    if (!Hash::check($request->password, $check_user->password)) {
                        return response()->json(array(
                            'status' => 'NOK3',
                            'msg' => "Wrong Password"

                        ), 201);
                    }
                    Auth::login($check_user);
                    $question1 = $request->questions;
                    for ($i = 2; $i < count($question1) + 2; $i++) {
                        $aa = "answers_" . $i;
                        $xx = ($request->$aa);
                        $xx1 = implode(",", $xx);
                        array_push($answer2, $xx1);
                        $xx2 = (int)$xx1;
                        $quiz_categoryId = QuizAnswer::where('id', $xx2)->first();
                        $quiz_category_Ids[] = $quiz_categoryId->category_id;
                    }
                    $values = array_count_values($quiz_category_Ids);
                    arsort($values);
                    $popular = array_slice(array_keys($values), 0, 1, true);
                    $xx3 = (int)implode(",", $popular);
                    $quiz_category = QuizCategory::where('id', $xx3)->first();
                    $category = $quiz_category->title;
                    if ($quiz_category->image) {
                        $category_image = $quiz_category->getQuizCategoryImage();
                    } else {
                        $category_image = "";
                    }
                    $category_description = $quiz_category->description;
                    //$user=auth()->user();
                    $response['status'] = 'OK';
                    $model = new CustomerQuiz();
                    //$model->fill($request->all());
                    $model->user_id = $check_user->id;
                    $model->questions = implode(",", $request->questions);
                    $model->answers = implode(",", $answer2);
                    $model->categories = implode(",", $quiz_category_Ids);
                    $model->answer_category = $xx3;
                    //$model->name = $request->name;
                    //$model->email = $request->email;
                    $model->subscription = $request->subscription;
                    $model->amount = $request->subscription_ammount;
                    $model->addons = $request->addons;
                    $model->save();
                    $response['status'] = 'OK';
                    $response['category'] = $category;
                    $response['category_image'] = $category_image;
                    $response['category_description'] = $category_description;
                    //$model2 = User::where('email', $request->email)->where('role_id', 2)->first();
                    //Auth::login($model2);

                    /*$setting = Setting::where('created_by', 1)->first();
			$email_template_admin=EmailTemplate::where(['type'=>EmailTemplate::TYPE_ENQUIRY_ADMIN])->first();
			$email_template=EmailTemplate::where(['type'=>EmailTemplate::TYPE_ENQUIRY])->first();
			if((!empty($setting)) && (!empty($email_template_admin))){
			Mail::send('emails.signupSuccess1', ['model'=>$user,'email_template_admin'=>$email_template_admin], function ($m) use ($setting){
            $m->from('styleahome01@gmail.com', env('APP_NAME'));
            $m->to([$setting->admin_email])->subject(__('Signup'));
            });
			}
            if(!empty($email_template)){
            Mail::send('emails.thank_message1', ['model'=>$user,'password'=>$pass,'email_template'=>$email_template], function ($m) use ($user){
            $m->from('styleahome01@gmail.com', env('APP_NAME'));
            $m->to($user->email, $user->first_name)->subject(__('Signup'));
            });
            }*/
                    return $response;
                }
                return response()->json(array(
                    'status' => 'NOK2',
                    'errors' => $validator->getMessageBag()->toArray()

                ), 201);
            }
        } else {
            $response = [];
            $response['status'] = 'NOK';

            $answer2 = [];
            $quiz_category_Ids = [];

            $question1 = $request->questions;
            for ($i = 2; $i < count($question1) + 2; $i++) {
                $aa = "answers_" . $i;
                $xx = ($request->$aa);
                $xx1 = implode(",", $xx);
                array_push($answer2, $xx1);
                $xx2 = (int)$xx1;
                $quiz_categoryId = QuizAnswer::where('id', $xx2)->first();
                if(isset($quiz_categoryId->category_id)){
                    $quiz_category_Ids[] = $quiz_categoryId->category_id;
                }
                else{
                    $quiz_category_Ids[] = 0;
                }
            }
            // dd(count(array_unique($quiz_category_Ids)));
            if(sizeof($quiz_category_Ids) > 0){
                $values = array_count_values($quiz_category_Ids);
            }
            else{
                $values = [];
            }
            // dump($quiz_category_Ids);
            // dump($values);
            arsort($values);
            // dump($values);
            $lastkey = array_key_last($values);
            $firstKey = array_key_first($values);
            // dd(end($values));
            if (count(array_unique($values)) === 1 ) {
                $xx3 = $lastkey;
            } else {
                if ($values[$firstKey] > 1) {
                    $popular = array_slice(array_keys($values), 0, 1, true);
                    $xx3 = (int)implode(",", $popular);
                } else {
                    $xx3 = $lastkey;
                }
            }
            $quiz_category = QuizCategory::where('id', $xx3)->first();
            if(isset($quiz_category)){
                $category = $quiz_category->title;
            }else{
                $category = "";
            }
            if (isset($quiz_category->image)) {
                $category_image = $quiz_category->getQuizCategoryImage();
            } else {
                $category_image = "";
            }
            if(isset($quiz_category->description)){
                $category_description = $quiz_category->description;
            }
            else{
                $category_description = '';
            }
            $user = auth()->user();
            $response['status'] = 'OK';
            $model = new CustomerQuiz();
            //$model->fill($request->all());
            $model->user_id = $user->id;
            $model->questions = implode(",", $request->questions);
            $model->answers = implode(",", $answer2);
            $model->categories = implode(",", $quiz_category_Ids);
            $model->answer_category = $xx3;
            $model->name = $request->name;
            $model->email = $request->email;
            $model->subscription = $request->subscription;
            $model->amount = $request->subscription_ammount;
            $model->addons = $request->addons;
            $model->save();
            $response['status'] = 'OK';
            $response['category'] = $category;
            $response['category_image'] = $category_image;
            $response['category_description'] = $category_description;
            //Login
            /*$user=auth()->user();
			$pass = 123456;
			$user->first_name = $request->name;
			$user->email = $request->email;
			$user->role_id = 2;
			$user->password=bcrypt($pass);
            $user->save();*/
            return $response;
        }
    }

    public function dining_room(Request $request)
    {
        $response = [];
        $response['status'] = 'NOK';
        $validator = Validator::make($request->all(), [
            'diningroom' => 'required',
        ]);
        if ($validator->passes()) {
            $response['status'] = 'OK';
            $user = auth()->user();
            $model = QuizTemp::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            /*$model=new Enquiry();
            $model->fill($request->all());*/
            $model->diningroom = $request->diningroom;
            $model->save();
            $response['status'] = 'OK';

            return $response;
        }
        return response()->json(array(
            'status' => 'NOK',
            'errors' => $validator->getMessageBag()->toArray()

        ), 201);
    }

    public function coffee_table(Request $request)
    {
        $response = [];
        $response['status'] = 'NOK';
        $validator = Validator::make($request->all(), [
            'coffee_table' => 'required',
        ]);
        if ($validator->passes()) {
            $response['status'] = 'OK';
            $user = auth()->user();
            $model = QuizTemp::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $model->coffee_table = $request->coffee_table;
            $model->save();
            $response['status'] = 'OK';
            return $response;
        }
        return response()->json(array(
            'status' => 'NOK',
            'errors' => $validator->getMessageBag()->toArray()

        ), 201);
    }

    public function home_feel(Request $request)
    {
        $response = [];
        $response['status'] = 'NOK';
        $validator = Validator::make($request->all(), [
            'home_feel' => 'required',
        ]);
        if ($validator->passes()) {
            $response['status'] = 'OK';
            $user = auth()->user();
            $model = QuizTemp::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $model->home_feel = $request->home_feel;
            $model->save();
            $response['status'] = 'OK';
            return $response;
        }
        return response()->json(array(
            'status' => 'NOK',
            'errors' => $validator->getMessageBag()->toArray()

        ), 201);
    }

    public function home_area(Request $request)
    {
        $response = [];
        $response['status'] = 'NOK';
        $validator = Validator::make($request->all(), [
            'home_area' => 'required',
        ]);
        if ($validator->passes()) {
            $response['status'] = 'OK';
            $user = auth()->user();
            $model = QuizTemp::where('user_id', $user->id)->orderBy('id', 'desc')->first();
            $model->home_area = $request->home_area;
            $model->save();
            $response['status'] = 'OK';
            return $response;
        }
        return response()->json(array(
            'status' => 'NOK',
            'errors' => $validator->getMessageBag()->toArray()

        ), 201);
    }

    public function start_project(Request $request)
    {
        $response = [];
        $response['status'] = 'NOK';
        $user = auth()->user();
        $quiz_temp = QuizTemp::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (!empty($quiz_temp)) {
            $model = new CustomerQuiz();
            $model->user_id = $user->id;
            $model->preferred_bedroom = $quiz_temp->preferred_bedroom;
            $model->diningroom = $quiz_temp->diningroom;
            $model->coffee_table = $quiz_temp->coffee_table;
            $model->home_feel = $quiz_temp->home_feel;
            $model->home_area = $quiz_temp->home_area;
            $model->temp_id = $quiz_temp->id;
            $model->save();
            $aa = url('/detail-form');
            $response['status'] = 'OK';
            $response['url'] = $aa;
            return $response;
        }
        return $response;
    }

    public function detail_form_post(Request $request)
    {
        $data = $request->validate($this->getValidation2());
        $user = auth()->user();
        $customer_temp = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (empty($customer_temp)) {
            return redirect()->back()->withError(__('Please complete quiz first!'));
        }
        $subscription_addons = "";
        $i = $request->subscription;
        $aa = "amount" . $i;
        $bb = "addon_ids" . $i;
        $subscription_amount = $request->$aa;
        $subscription_addons = $request->$bb;
        $model = new DetailForm();
        $model->user_id = $user->id;
        $model->quiz_id = $customer_temp->id;
        $model->project_duration = $request->project_duration;
        $model->country = $request->country;
        $model->space = $request->space;
        $model->subscription = $request->subscription;
        $model->addons = $subscription_addons;
        $model->amount = $subscription_amount;
        $model->designer = $request->designer;
        $model->room = $request->room;
        $model->save();
        if ($model) {
            $data = [];
            foreach (json_decode($request->room) as $val) {
                $obj['detail_form_id'] = $model->id;
                $obj['form_answer_id'] = $val->id;
                $obj['qty'] = $val->count;
                $obj['created_at'] = now();
                $obj['updated_at'] = now();
                $data[] = $obj;
            }
            DetailFormRoom::insert($data);
        }
        //return redirect()->route('frontend.project.detail')->withSuccess(__('Detail Form Submitted Successfully'));
        return redirect()->route('frontend.subscription.checkout')->withSuccess(__('Detail Form Submitted Successfully'));
    }

    public function checkout()
    {
        $user = auth()->user();
        if (empty($user)) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        } else if ($user->role_id != 2) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        }
        $addcarts = [];
        if (isset($user)) {
            $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
        }
        $detail_form_latest = DetailForm::select('subscriptions.title as subscription_title', 'subscriptions.fee_amount', 'detail_forms.*')->join('subscriptions', 'subscriptions.id', 'detail_forms.subscription')->where('detail_forms.user_id', $user->id)->orderBy('detail_forms.id', 'desc')->first();
        if ((!empty($detail_form_latest)) && ($detail_form_latest->payment_status == 'Pending')) {
            $detail_form_rooms_count = DetailFormRoom::where('detail_form_id', $detail_form_latest->id)->get()->sum('qty');
            return view("frontend.checkout", compact(['detail_form_latest', 'detail_form_rooms_count', 'addcarts']));
        } else {
            return redirect()->route('frontend.project')->withError(__('Please Complete Quiz First'));
        }
    }

    public function productCheckout()
    {
        $user = auth()->user();
        if (empty($user)) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        } else if ($user->role_id != 2) {
            return redirect()->route('frontend.login')->withError(__('Please Login as Customer to Access This Page!'));
        }
        $user_id = $user->id;
        $addcarts = AddToCart::where('user_id', $user->id)->with('products')->get();
        if (sizeof($addcarts) > 0) {
            return view("frontend.product_checkout", compact('addcarts', 'user_id'));
        } else {
            return redirect()->route('frontend.project')->withError(__('Please Complete Quiz First'));
        }
    }

    public function project_detail_post(Request $request)
    {
        $data = $request->validate($this->getValidation3());
        $user = auth()->user();
        $detail_form = DetailForm::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (empty($detail_form)) {
            return redirect()->back()->withError(__('Please complete detail form first!'));
        }
        $model = new ProjectDetail();
        if ($request->hasFile('room_picture')) {
            foreach ($request->file('room_picture') as $image) {
                $imageName = $image->getClientOriginalName();

                $image->move(public_path('uploads'), $imageName);
                $data1[] = $imageName;
            }
            $data1 = implode(",", $data1);
        } else {
            $data = "";
        }
        if ($request->hasFile('room_item_keep_picture')) {
            foreach ($request->file('room_item_keep_picture') as $image) {
                $imageName2 = $image->getClientOriginalName();

                $image->move(public_path('uploads'), $imageName2);
                $data2[] = $imageName2;
            }
            $data2 = implode(",", $data2);
        } else {
            $data2 = "";
        }
        if ($request->hasFile('inspiration_image')) {
            foreach ($request->file('inspiration_image') as $image) {
                $imageName3 = $image->getClientOriginalName();

                $image->move(public_path('uploads'), $imageName3);
                $data3[] = $imageName3;
            }
            $data3 = implode(",", $data3);
        } else {
            $data3 = "";
        }
        $model->user_id = $user->id;
        $model->detail_form_id = $detail_form->id;
        $model->title = $request->title;
        $model->about_room = $request->about_room;
        $model->room_dimension = $request->room_dimension;
        $model->room_item_keep = $request->room_item_keep;
        $model->room_vision = $request->room_vision;
        $model->specific_area = $request->specific_area;
        $model->pinterest_board = $request->pinterest_board;
        $model->color_schemes = $request->color_schemes;
        $model->specific_item = $request->specific_item;
        $model->budget = $request->budget;
        $model->room_picture = $data1;
        $model->room_item_keep_picture = $data2;
        $model->inspiration_image = $data3;
        $model->other_consideration = $request->other_consideration;
        $model->save();

        $designer = Designer::where('user_id', $detail_form->designer)->first();
        if (!empty($designer)) {
            $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_NEW_PROJECT])->first();
            if (!empty($email_template)) {
                Mail::send('emails.new_project', ['model' => $model, 'email_template' => $email_template], function ($m) use ($designer) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to($designer->email)
                        ->subject(__('New Project'));
                });
            }
            Mail::send('emails.thank_message11', ['name' => $user->first_name], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email)->subject(__('Project Detail Form'));
            });
        }
        return redirect()->route('frontend.project')->withSuccess(__('Thank you for sharing all the details with us. One of our design specialists will reach out to you within the next 48 hours with the next steps!'));
    }

    public function designer_chat($model)
    {
        if (!(auth()->user() && auth()->user()->role_id == User::ROLE_CUSTOMER)) {
            return redirect()->route('frontend.login')->withError(__('Please login as customer'));;
        }
        $user_id = auth()->user()->id;
        $chats = Message::where("to_id", $user_id)->where("project_id", $model)->get();
        if (count($chats) > 0) {
            foreach ($chats as $chat) {
                $chat->view_status = 1;
                $chat->save();
            }
        }
        $project = ProjectDetail::select('detail_forms.designer', 'users.first_name', 'users.last_name', 'users.id as userId', 'project_details.*')->join('detail_forms', 'detail_forms.id', 'project_details.detail_form_id')
            ->join('users', 'users.id', 'detail_forms.designer')
            ->where("project_details.user_id", $user_id)->where("project_details.id", $model)->where("project_details.status", 1)->first();
        $page_title = PageTitle::where('type', PageTitle::TYPE_CHAT)->first();
        return view('frontend.chat', ['model' => $project, 'page_title' => $page_title]);
    }

    protected function getValidation()
    {
        return [
            'first_name' => 'required',
            //'sector'=>'required',
            'email' => 'required|email|unique:users',
            //'phone_number'=>'required|numeric',
            'password' => 'required|min:6|confirmed'
        ];
    }

    protected function getValidation2()
    {
        return [
            //'project_duration'=>'required',
            'country' => 'required',
            'space' => 'required',
            'designer' => 'required',
            'subscription' => 'required',
            'room' => 'required'

        ];
    }

    protected function getValidation3()
    {
        return [
            'title' => 'required',
            //'about_room'=>'required',
            //'room_picture'=>'required',
            //'room_dimension'=>'required',
            //'room_item_keep'=>'required',
            //'room_vision'=>'required',
            //'specific_area'=>'required',
            //'pinterest_board'=>'required',
            //'room_picture'=>'image|mimes:jpeg,png,jpg,gif,mp4,ogx,oga,ogv,ogg,webm',
            //'room_item_keep_picture'=>'image|mimes:jpeg,png,jpg,gif',
            //'inspiration_image'=>'image|mimes:jpeg,png,jpg,gif',
            'room_picture' => 'required',
            'room_picture.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'room_item_keep_picture.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240',
            'inspiration_image.*' => 'image|mimes:jpeg,png,jpg,gif|max:10240'

        ];
    }

    public function checkPromocode(Request $request)
    {
        $coupons = Coupon::where('coupon_code', $request->promocode)->first();
        if (isset($coupons)) {
            $per = ($request->grand_total * $coupons->percentage) / 100;
            $result = $request->grand_total - $per;
            $detail_form = DetailForm::where('id', $request->detail_form_id)->first();
            $detail_form->grand_total = $result;
            $detail_form->save();
            return response()->json(['result' => $result]);
        } else {
            return response()->json(['message' => 'Coupon code is not valid']);
        }
    }
}

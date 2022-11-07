<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use Illuminate\Http\Request;
use Validator;
use URL;
use Session;
use Redirect;
use Input;
use PayPal\Rest\ApiContext;
use PayPal\Auth\OAuthTokenCredential;
use PayPal\Api\Amount;
use PayPal\Api\Details;
use PayPal\Api\Item;
use PayPal\Api\ItemList;
use PayPal\Api\Payer;
use PayPal\Api\Payment;
use PayPal\Api\RedirectUrls;
use PayPal\Api\ExecutePayment;
use PayPal\Api\PaymentExecution;
use PayPal\Api\Transaction;
use App\Models\CustomerQuiz;
use App\Models\DetailForm;
use App\Models\DetailFormRoom;
use App\Models\Setting;
use App\Models\SubscriptionAddon;
use App\Models\AddToCart;
use App\Models\Product;
use App\Models\EmailTemplate;
use App\Models\PurchaseProduct;
use Mail;

class PaypalController extends Controller
{
    private $_api_context;

    public function __construct()
    {

        $paypal_configuration = \Config::get('paypal');
        $this->_api_context = new ApiContext(new OAuthTokenCredential($paypal_configuration['client_id'], $paypal_configuration['secret']));
        $this->_api_context->setConfig($paypal_configuration['settings']);
    }

    public function payWithPaypal()
    {
        return view('paywithpaypal');
    }
 
 


 public function postPaymentWithstripe(Request $request)
    { 
        $user = auth()->user();
         
        $customer_temp = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (empty($customer_temp)) {
            return redirect()->route('frontend.subscription.checkout')->withError(__('Please complete quiz first!'));
        }
 
      $paymentMethod = $request->input('payment_method');
        $detail_form2 = DetailForm::where('user_id', $user->id)->where('id', $request->get('detail_form_id'))->orderBy('id', 'desc')->first();
       
        if (empty($detail_form2)) {
            return redirect()->route('frontend.subscription.checkout')->withError(__('Please complete Detail Form First!'));
        }
      
        //dd($detail_form2->amount);
        $detail_form2->subscription;
        if (round($detail_form2->amount) <= 0) {
            return redirect()->back()->withError(__('Amount must be greater than or equal to 1 AED!'));
        }
        $setting = Setting::where('created_by', 1)->first();
        if ($setting->tax) {
            $tax = $setting->tax;
            $tax_amount = round(($detail_form2->amount * $setting->tax) / 100);
        } else {
            $tax_amount = 0;
        }
        
        $subscription_amount = $detail_form2->grand_total;

        //Currency Conversion
        $currency_from = 'AED';
        $from_amount = $subscription_amount;
        //dd($from_amount);
        $currency_to = 'USD';
        // $url = file_get_contents('https://free.currconv.com/api/v7/convert?q=' . $currency_from . '_' . $currency_to . '&compact=ultra&apiKey=e304c129830b004b92d1');

        // $json = json_decode($url, true);
        // $rate = implode(" ",$json);
        $rate = "0.272259";
        $total = $rate * $from_amount;
        //$total1 = round($total);
        $total1 = $total;
   $detail_form_rooms_count = DetailFormRoom::where('detail_form_id',  $request->detail_form_id,)->get()->sum('qty');
     $fee_amount =$detail_form2->getSubscription->fee_amount * $detail_form_rooms_count;
 $dis10 = ($fee_amount * 10) / 100;
  $finalTotal=   round($fee_amount + @$tax_amount) + ($detail_form2->amount - $detail_form2->getSubscription->fee_amount) - $dis10;
 
 
    try 
    {
  $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $response= $user->charge($finalTotal*100, $paymentMethod);   
        $transactionId=($response->id);    

    }
    catch(\Exception $e)
    {
             return \Redirect::route('frontend.subscription.checkout')->withError( $e->getMessage());
    }
        

 
        $form_data2 = array(

            'detail_form_id' => $request->detail_form_id,
            'addons' => $detail_form2->addons,
            'amount' => $finalTotal,
            'subscription' => $detail_form2->subscription,
            'amount_aed' => $detail_form2->amount + $tax_amount,

        );
        
 
        
   ;

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

         
   








          $payment_id = $transactionId ; 
       
  
        // if ($result->getState() == 'approved') {
        if ($user) {
            $detail_form_id = $form_data2['detail_form_id'];
            $detail_form = DetailForm::select('subscriptions.title as subscription_title', 'detail_forms.*')->join('subscriptions', 'subscriptions.id', 'detail_forms.subscription')->where('detail_forms.user_id', $user->id)->where('detail_forms.id', $detail_form_id)->first();
          
            $detail_form->payment_status = 'approved';
            $detail_form->save();
            $purchase_id = $detail_form->id;
            //$purchase_id = $model->id;
            if ($purchase_id) {
                $amount = $form_data2['amount_aed'];
                $paymentModel = new \App\Models\Payment();
                $paymentModel->currency_code = 'AED';
                $paymentModel->payment_status = 'approved';
                $paymentModel->amount = $form_data2['amount'];
                $paymentModel->transaction_id = $payment_id;
                $paymentModel->purchase_id = $purchase_id;
                $paymentModel->subscription = $form_data2['subscription'];
                $paymentModel->addons = $form_data2['addons'];
                $paymentModel->user_id = $user->id;
                $paymentModel->save();
            }
            $setting = Setting::where('created_by', 1)->first();
            $addons_list = [];
            if ($form_data2['addons']) {
                $addons2 = explode(',', $form_data2['addons']);
                $addons_list = SubscriptionAddon::where('status', 1)->whereIn('id', $addons2)->get();
            }
            if (!empty($setting)) {
                Mail::send('emails.subscription_payment', ['model' => $detail_form, 'name' => $user->first_name, 'amount' => $amount, 'addons_list' => $addons_list], function ($m) use ($setting) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to([$setting->admin_email])->subject(__('Subscription Plan Payment'));
                });
            }

            Mail::send('emails.thank_message9', ['model' => $detail_form, 'name' => $user->first_name, 'amount' => $amount, 'addons_list' => $addons_list], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email)->subject(__('Subscription Plan Payment'));
            });
            //\Session::put('success','Payment success !!');
            //return Redirect::route('paywithpaypal');
            return \Redirect::route('frontend.project.detail')->withSuccess(__('Payment success !!'));
        }
       
    }



    public function postPaymentWithpaypal(Request $request)
    {
        //$data= $request->validate($this->getValidation()) ;
        $user = auth()->user();
        // dd($request->all());
        $customer_temp = CustomerQuiz::where('user_id', $user->id)->orderBy('id', 'desc')->first();
        if (empty($customer_temp)) {
            return redirect()->back()->withError(__('Please complete quiz first!'));
        }
        $detail_form2 = DetailForm::where('user_id', $user->id)->where('id', $request->detail_form_id)->orderBy('id', 'desc')->first();
        if (empty($detail_form2)) {
            return redirect()->back()->withError(__('Please complete Detail Form First!'));
        }
 
        //dd($detail_form2->amount);
        $detail_form2->subscription;
        if (round($detail_form2->amount) <= 0) {
            return redirect()->back()->withError(__('Amount must be greater than or equal to 1 AED!'));
        }
        $setting = Setting::where('created_by', 1)->first();
        if ($setting->tax) {
            $tax = $setting->tax;
            $tax_amount = round(($detail_form2->amount * $setting->tax) / 100);
        } else {
            $tax_amount = 0;
        }
        
        $subscription_amount = $detail_form2->grand_total;

        //Currency Conversion
        $currency_from = 'AED';
        $from_amount = $subscription_amount;
        //dd($from_amount);
        $currency_to = 'USD';
        // $url = file_get_contents('https://free.currconv.com/api/v7/convert?q=' . $currency_from . '_' . $currency_to . '&compact=ultra&apiKey=e304c129830b004b92d1');

        // $json = json_decode($url, true);
        // $rate = implode(" ",$json);
        $rate = "0.272259";
        $total = $rate * $from_amount;
        //$total1 = round($total);
        $total1 = $total;
 
        $form_data2 = array(

            'detail_form_id' => $request->detail_form_id,
            'addons' => $detail_form2->addons,
            'amount' => $detail_form2->grand_total + $tax_amount,
            'subscription' => $detail_form2->subscription,
            'amount_aed' => $detail_form2->amount + $tax_amount,

        );
         
        Session::put('paypal_payment_id', '12345');
        //Session::put('form_data', $form_data);
        Session::put('form_data2', $form_data2);

        if (isset($redirect_url)) {
            return Redirect::away($redirect_url);
        }

        //\Session::put('error','Unknown error occurred');
        //return Redirect::route('paywithpaypal');
        return \Redirect::route('paypal')->withSuccess(__('success'));
        // return \Redirect::route('frontend.subscription.checkout')->withError(__('Unknown error occurred'));
    }

    public function getPaymentStatus(Request $request)
    {
        $payment_id = Session::get('paypal_payment_id');
        $form_data2 = Session::get('form_data2');
        Session::forget('paypal_payment_id');
        Session::forget('form_data2');
       
        $user = auth()->user();
        // if ($result->getState() == 'approved') {
        if ($user) {
            $detail_form_id = $form_data2['detail_form_id'];
            $detail_form = DetailForm::select('subscriptions.title as subscription_title', 'detail_forms.*')->join('subscriptions', 'subscriptions.id', 'detail_forms.subscription')->where('detail_forms.user_id', $user->id)->where('detail_forms.id', $detail_form_id)->first();
          
            $detail_form->payment_status = 'approved';
            $detail_form->save();
            $purchase_id = $detail_form->id;
            //$purchase_id = $model->id;
            if ($purchase_id) {
                $amount = $form_data2['amount_aed'];
                $paymentModel = new \App\Models\Payment();
                $paymentModel->currency_code = 'AED';
                $paymentModel->payment_status = 'approved';
                $paymentModel->amount = $form_data2['amount'];
                $paymentModel->transaction_id = $payment_id;
                $paymentModel->purchase_id = $purchase_id;
                $paymentModel->subscription = $form_data2['subscription'];
                $paymentModel->addons = $form_data2['addons'];
                $paymentModel->user_id = $user->id;
                $paymentModel->save();
            }
            $setting = Setting::where('created_by', 1)->first();
            $addons_list = [];
            if ($form_data2['addons']) {
                $addons2 = explode(',', $form_data2['addons']);
                $addons_list = SubscriptionAddon::where('status', 1)->whereIn('id', $addons2)->get();
            }
            if (!empty($setting)) {
                Mail::send('emails.subscription_payment', ['model' => $detail_form, 'name' => $user->first_name, 'amount' => $amount, 'addons_list' => $addons_list], function ($m) use ($setting) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to([$setting->admin_email])->subject(__('Subscription Plan Payment'));
                });
            }

            Mail::send('emails.thank_message9', ['model' => $detail_form, 'name' => $user->first_name, 'amount' => $amount, 'addons_list' => $addons_list], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email)->subject(__('Subscription Plan Payment'));
            });
            //\Session::put('success','Payment success !!');
            //return Redirect::route('paywithpaypal');
            return \Redirect::route('frontend.project.detail')->withSuccess(__('Payment success !!'));
        }

        //\Session::put('error','Payment failed !!');
        //return Redirect::route('paywithpaypal');
        return \Redirect::route('frontend.subscription.checkout')->withError(__('Payment failed !!'));;
    }

    protected function getValidation()
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


    public function postPaymentWithStripeProduct(Request $request){
      $addcart = AddToCart::currentCart()->get()  ; 
      $user = auth()->user();



      $paymentMethod = $request->input('payment_method');

      $total_price=0;

      if (sizeof($addcart) > 0) {
       $producs_ids = $addcart->pluck('product_id');
       $total = Product::whereIn('id', $producs_ids)->sum('price');
       try {

        $user->createOrGetStripeCustomer();
        $user->updateDefaultPaymentMethod($paymentMethod);
        $response= $user->charge( $total*100, $paymentMethod);   
        $transactionId=($response->id);      
    } catch (\Exception $e) {

        return back()->withError($e->getMessage());
    }



    $paymentModel = new \App\Models\Payment();
    $paymentModel->currency_code = 'AED';
    $paymentModel->payment_status = 'approved';
    $paymentModel->amount = $total;
    $paymentModel->transaction_id = $transactionId;
    $paymentModel->subscription = 1;
    $paymentModel->user_id = $user->id;
    $paymentModel->save();
    $data = [];
    foreach ($addcart as $prd) {
        $obj['user_id'] = $user->id;
        $obj['payment_id'] = $paymentModel->id;
        $obj['product_id'] = $prd->product_id;
        $obj['quiz_id'] = $prd->quiz_id;
        $obj['created_at'] = now();
        $data[] = $obj;
    }
    PurchaseProduct::insert($data);
    AddToCart::where('user_id', $user->id)->delete();
    $purchase_data = PurchaseProduct::where('payment_id', $paymentModel->id)->get();
    $setting = Setting::where('created_by', 1)->first();
    $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY_ADMIN])->first();
    $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY])->first();
    if (sizeof($purchase_data) > 0) {
        if ((!empty($setting)) && (!empty($email_template_admin))) {
            Mail::send('emails.products_payment', ['purchase_data' => $purchase_data, 'name' => $user->first_name,'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to([$setting->admin_email])->subject(__('Subscription Plan Payment'));
            });
        }
        if (!empty($email_template)) {
            Mail::send('emails.thank_message10', ['purchase_data' => $purchase_data, 'name' => $user->first_name,'email_template' => $email_template], function ($m) use ($user) {
                $m->from('styleahome01@gmail.com', env('APP_NAME'));
                $m->to($user->email)->subject(__('Subscription Plan Payment'));
            });
        }
    }

    return \Redirect::route('frontend.product.downloads')->withSuccess(__('Payment success !!'));
}



 return back()->withError(__('Something went wrong '));



}
public function postPaymentWithpaypalProduct(Request $request)
{
    $addcart = AddToCart::where('user_id', $request->user_id)->get();
    $user = auth()->user();
    if (sizeof($addcart) > 0) {
        $producs_ids = $addcart->pluck('product_id');
        $total = Product::whereIn('id', $producs_ids)->sum('price');
        $paymentModel = new \App\Models\Payment();
        $paymentModel->currency_code = 'AED';
        $paymentModel->payment_status = 'approved';
        $paymentModel->amount = $total;
        $paymentModel->transaction_id = "1111";
        $paymentModel->subscription = 1;
        $paymentModel->user_id = $request->user_id;
        $paymentModel->save();
        $data = [];
        foreach ($addcart as $prd) {
            $obj['user_id'] = $request->user_id;
            $obj['payment_id'] = $paymentModel->id;
            $obj['product_id'] = $prd->product_id;
            $obj['quiz_id'] = $prd->quiz_id;
            $obj['created_at'] = now();
            $data[] = $obj;
        }
        PurchaseProduct::insert($data);
        AddToCart::where('user_id', $request->user_id)->delete();
        $purchase_data = PurchaseProduct::where('payment_id', $paymentModel->id)->get();
        $setting = Setting::where('created_by', 1)->first();
        $email_template_admin = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY_ADMIN])->first();
        $email_template = EmailTemplate::where(['type' => EmailTemplate::TYPE_ENQUIRY])->first();
        if (sizeof($purchase_data) > 0) {
            if ((!empty($setting)) && (!empty($email_template_admin))) {
                Mail::send('emails.products_payment', ['purchase_data' => $purchase_data, 'name' => $user->first_name,'email_template_admin' => $email_template_admin], function ($m) use ($setting) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to([$setting->admin_email])->subject(__('Subscription Plan Payment'));
                });
            }
            if (!empty($email_template)) {
                Mail::send('emails.thank_message10', ['purchase_data' => $purchase_data, 'name' => $user->first_name,'email_template' => $email_template], function ($m) use ($user) {
                    $m->from('styleahome01@gmail.com', env('APP_NAME'));
                    $m->to($user->email)->subject(__('Subscription Plan Payment'));
                });
            }
        }
        
        return \Redirect::route('frontend.product.downloads')->withSuccess(__('Payment success !!'));
    }
    return \Redirect::route('frontend.product.checkout')->withError(__('Payment failed !!'));
}
}

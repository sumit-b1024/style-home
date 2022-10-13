<?php
namespace App\Http\Controllers\Admin;

use App\User;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Auth;
use Session;

class AuthController extends Controller
{

    public function login(Request $request)
    {
      

        $request->validate([
            'email' => 'required|email',
            'password' => 'required'
        ]);
        $model = User::where('email', $request->get('email'))->where([
            'role_id' => User::ROLE_ADMIN
        ])->first();

        if (empty($model)) {
            return redirect()->back()
                ->withError("Invalid Email")
                ->withInput();
        }

        if (! Hash::check($request->get('password'), $model->password)) {
            return redirect()->back()
                ->withError("Password Not matching")
                ->withInput();
        }
         
            Auth::login($model);
            return redirect()->route('admin.dashboard');
       
        
    }
	
	public function logout()
    {
        Session::flush();
        return redirect('/admin/login')->with('success', 'You are logged out.');
    }
    
    public function designer_logout()
    {
        Session::flush();
        return redirect('/designer-login')->with('success', 'You are logged out.');
    }
    
    public function customer_logout()
    {
        Session::flush();
        return redirect('/login')->with('success', 'You are logged out.');
    }
    
}

<?php

namespace App\Http\Middleware;

use Closure;
use App\Http\Controllers\Admin\AuthController;
use Illuminate\Support\Facades\Auth;
use App\User;

class DesignerAdmin
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @return mixed
     */
    public function handle($request, Closure $next)
    {
        if(!Auth::user()){
			return redirect()->route('frontend.designer.login');
		}
        if (!Auth::guest())
        {
            if( Auth::user()->role_id==User::ROLE_DESIGNER)
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('frontend.designer.login');
            }
        }
        else
        {
            return redirect()->route('admin.designer.login')->withError(__('app/messsages.please_login_to_access_page')); 
        }
            
        
    }
}

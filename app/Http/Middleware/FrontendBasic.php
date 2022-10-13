<?php

namespace App\Http\Middleware;

use Closure;
use App\Models\Setting;
class FrontendBasic
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
        
        \View::share('setting', Setting::first());
        
        return $next($request);
    }
}

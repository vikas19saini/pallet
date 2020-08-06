<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class RedirectIfEmailNotVerified
{
    /**
     * Handle an incoming request.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \Closure  $next
     * @param  string|null  $guard
     * @return mixed
     */
    public function handle($request, Closure $next, $guard = null)
    {
        if (Auth::guard($guard)->check()) {
            if(Auth::guard($guard)->user()->email_verified == 0) 
            {
                // dd(Auth::guard($guard)->user()); 
                Auth::logout(); 
                return redirect('/login')->with('message','Email Not Verified');
            }   
        }

        return $next($request);
    }
}

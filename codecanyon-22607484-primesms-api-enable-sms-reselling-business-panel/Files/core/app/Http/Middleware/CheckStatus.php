<?php

namespace App\Http\Middleware;

use Closure;
use Illuminate\Support\Facades\Auth;

class CheckStatus
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
        if (Auth::check()) {
            if(Auth()->user()->status == 1 && Auth()->user()->email_verify == 1 && Auth()->user()->sms_verify == 1  && Auth::user()->two_step_verification == 1)
            {
                return $next($request);
            }
            else
            {
                return redirect()->route('user.authorization');
            }
        }
    }
}

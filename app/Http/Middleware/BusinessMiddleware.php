<?php

namespace App\Http\Middleware;

use Closure;
use Auth;
class BusinessMiddleware
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
        if(Auth::user() && Auth::user()->userType == 3){
            return $next($request);
        }
        return redirect(url()->previous())->with('Errors','You are not authorised to move');
    }
}

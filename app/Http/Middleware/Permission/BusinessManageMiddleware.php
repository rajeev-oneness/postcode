<?php

namespace App\Http\Middleware\Permission;

use Closure;

class BusinessManageMiddleware
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
        if(Auth::user() && (Auth::user()->userType == 1)){
            return $next($request);
        }elseif(Auth::user() && (Auth::user()->userType == 4)){
            $route = explode('/',url()->current());
            $permission = false;
            if(in_array('manage',$route)){
                return $next($request);
            }elseif(in_array('create',$route) || in_array('store',$route)){
                $permission = \App\User::permission(2,'add',Auth::id());
            }elseif(in_array('edit',$route) || in_array('update',$route)){
                $permission = \App\User::permission(2,'edit',Auth::id());
            }elseif(in_array('delete',$route)){
                $permission = \App\User::permission(2,'delete',Auth::id());
            }
            if($permission){
                return $next($request);
            }
        }
        return redirect()->route('admin.dashboard')->with('Errors','You are not authorised to Perform this Task');
    }
}

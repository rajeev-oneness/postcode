<?php

namespace App\Http\Middleware\Permission;

use Closure;
use Auth,Route;

class PermissionMiddleware
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

            if(in_array('business_categories',$route)) {
                $permission_id = 1; 
            } elseif(in_array('business',$route)) {
                $permission_id = 2; 
            } elseif(in_array('business',$route)) {
                $permission_id = 2; 
            } elseif(in_array('customer',$route)) {
                $permission_id = 3; 
            } elseif(in_array('faq',$route)) {
                $permission_id = 4; 
            } elseif(in_array('product_categories',$route)) {
                $permission_id = 5; 
            } elseif(in_array('product_subcategories',$route)) {
                $permission_id = 6; 
            } elseif(in_array('product',$route)) {
                $permission_id = 7; 
            } elseif(in_array('community',$route)) {
                $permission_id = 8; 
            } elseif(in_array('event_categories',$route)) {
                $permission_id = 9; 
            } elseif(in_array('event',$route)) {
                $permission_id = 10; 
            } elseif(in_array('offer',$route)) {
                $permission_id = 11; 
            } elseif(in_array('services',$route)) {
                $permission_id = 12; 
            }

            if(in_array('manage',$route)){
                return $next($request);
            }elseif(in_array('create',$route) || in_array('store',$route)){
                $permission = \App\User::permission($permission_id,'add',Auth::id());
            }elseif(in_array('edit',$route) || in_array('update',$route)){
                $permission = \App\User::permission($permission_id,'edit',Auth::id());
            }elseif(in_array('delete',$route)){
                $permission = \App\User::permission($permission_id,'delete',Auth::id());
            }
            if($permission){
                return $next($request);
            }
        }
        return redirect()->route('admin.dashboard')->with('Errors','You are not authorised to Perform this Task');
    }
}

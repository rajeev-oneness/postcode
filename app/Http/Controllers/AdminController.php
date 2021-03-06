<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\Controller;
use App\Model\User;

use App\Model\UserType;

use Illuminate\Http\Request;


class AdminController extends Controller
{

    public function Login(Request $request) {  
       if(!Auth::user()) {
        return view('portal.login');
       }
       else {
        switch (Auth::user()->userType) {
            case 1:
                 return redirect()->route('admin.dashboard');break;
            case 2:
                return redirect()->route('user.dashboard');break;
            default:
                return view('home');break;
        }  
       }         
    }

     /**
     *Backend User Login
     *
     * @param  Request $request
     * @return \Illuminate\Contracts\Validation\Validator,Exception $e,jsonArray
     */
    public function loginGet(Request $request){
        $statusCode=200;
        $response = [];
        $this->validate($request, [
            'email' => 'required|Min:5|string',
            'password' => 'required',
            ], [
            'email.required' => 'Email is Required',
            'password.required' => 'Password is Required',
            ]
        );
       
        try{
            $credential = ['email' => $request->email, 'password' => $request->password];
            
            $checkAuth = auth();
            if ($checkAuth->attempt($credential) == 1) {
              
                $response = array(
                    'status' => 1,
                    'message'=>"Successfully Entered credentials."
                );
            } else {
                $response = array(
                    'status' => 0,
                    'message' => "Credential Missmatch."
                );
            }
        }catch(Exception $e){
            $response = array(
                'exception' => true,
                'exception_message' => $e->getMessage(),
            );
            $statusCode = 400;
        }finally{            
           return response()->json($response, $statusCode);  
        }
    }

    public function logout(Request $request)
    {
        \Auth::logout();
        return redirect('/');
    }
}

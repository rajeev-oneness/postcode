<?php

namespace App\Http\Controllers;
namespace App\Http\Controllers\Auth;
namespace App\Http\Controllers;
use Auth;
use App\Http\Controllers\Controller;
use App\Rules\MatchOldPassword;
use Illuminate\Support\Facades\Hash;
use App\User;

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

    /**
     * Go to  Business Profile.
     *
     * @return view
     */
    public function changePassword()
    {
        return view('/auth.passwords.change_password');
    }
       /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function updatePassword(Request $request)
    {
        $request->validate([
            'old_pass' => ['required', new MatchOldPassword],
            'new_pass' => ['required'],
            'conf_pass' => ['same:new_pass'],
        ]);
   
        $updatedpassdata = User::find(auth()->user()->id)->update(['password'=> Hash::make($request->new_pass)]);
        // dd('Password change successfully.');
        return redirect()->route('admin.logout');
    }
}

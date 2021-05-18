<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Auth;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        // switch (Auth::user()->userType) {
        //     case 1:
        //         return redirect('admin/dashboard');break;
        //     case 2:
        //         return redirect('user/dashboard');break;
        //     default:
        //         return view('home');break;
        // }
        switch (Auth::user()->userType) {
            case 1:
                return redirect('admin.dashboard');break;
            case 2:
                return redirect('user.dashboard');break;
            case 3:
                return redirect('business.dashboard');break;
            case 4:
                return redirect('admin.dashboard');break;
            default:
                return view('home');break;
        }
        
    }
}

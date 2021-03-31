<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Model\User;
use App\Model\Business;
use App\Model\Event;
use App\Model\Rating;
use Auth;
use Illuminate\Support\Facades\DB;

class FrontController extends Controller
{
    public function directory() {
        $ratings = Rating::all();
        $businesses = Business::orderBy('created_at', 'DESC')->get();
        return view('front.directory', compact('businesses','ratings'));
    }
}

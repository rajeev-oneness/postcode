<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;

class CommunityController extends Controller
{
    public function index(Request $req)
    {
    	return view('admin.community.index');
    }

    public function manage(Request $req)
    {
    	
    }
}

<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Community;

class CommunityController extends Controller
{
    public function createCommunity(Request $req)
    {
    	return view('admin.community.create');
    }

    public function manageCommunity(Request $req)
    {
    	$community = Community::get();
    	return view('admin.community.index',compact('community'));
    }
}

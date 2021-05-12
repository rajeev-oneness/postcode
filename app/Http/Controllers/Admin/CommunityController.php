<?php

namespace App\Http\Controllers\Admin;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Community;

class CommunityController extends Controller
{
    public function manageCommunity(Request $req)
    {
    	$community = Community::get();
    	return view('portal.community.index',compact('community'));
    }

    public function createCommunity(Request $req)
    {
    	return view('portal.community.create');
    }

    public function storeCommunity(Request $req)
    {
    	$req->validate([
    		'image' => 'required',
    		'title' => 'required|max:255|string',
    		'description' => 'required',
    	]);
    	$community = new Community();
    	if($req->hasFile('image')){
    		$random = randomGenerator();
            $image = $req->file('image');
            $image->move('uploads/community/',$random.'.'.$image->getClientOriginalExtension());
            $imageurl = url('uploads/community/'.$random.'.'.$image->getClientOriginalExtension());
            $community->image = $imageurl;
        }
    	$community->title = $req->title;
    	$community->description = $req->description;
    	$community->save();
    	return redirect(route('admin.community.manage'))->with('Success','Community Added Success');
    }

    public function editCommunity(Request $req,$editId)
    {
    	$id = base64_decode($editId);
    	$community = Community::where('id',$id)->first();
    	return view('portal.community.edit',compact('community'));
    }

    public function updateCommunity(Request $req,$updateId)
    {
    	$req->validate([
    		'id' => 'required|min:1|numeric',
    		'title' => 'required|max:255|string',
    		'description' => 'required',
    	]);
    	$community = Community::where('id',$req->id)->first();
    	if($req->hasFile('image')){
    		$random = randomGenerator();
            $image = $req->file('image');
            $image->move('uploads/community/',$random.'.'.$image->getClientOriginalExtension());
            $imageurl = url('uploads/community/'.$random.'.'.$image->getClientOriginalExtension());
            $community->image = $imageurl;
        }
    	$community->title = $req->title;
    	$community->description = $req->description;
    	$community->save();
    	return redirect(route('admin.community.manage'))->with('Success','Community Updated Success');
    }

    public function deleteCommunity(Request $req,$id)
    {
    	Community::where('id',$id)->delete();
    	return redirect(route('admin.community.manage'))->with('Success','Community Deleted Success');
    }
}

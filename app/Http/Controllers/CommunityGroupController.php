<?php

namespace App\Http\Controllers;

use App\Model\Community;
use App\Model\CommunityGroup;
use App\Model\CommunityGroupDetail;
use App\Model\CommunityGroupDiscussion;
use Illuminate\Http\Request;

class CommunityGroupController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function showMyGroups()
    {
        $community_groups = CommunityGroup::where('created_by', auth()->id())->orderBy('created_at', 'DESC')->get();
        // dd($community_groups);
    	return view('front.home.community.my-groups',compact('community_groups'));
    }

    public function showAllGroups()
    {
        $community_all_groups = CommunityGroup::orderBy('created_at', 'DESC')->get();
        // dd($community_all_groups);
    	return view('front.home.community.community-groups',compact('community_all_groups'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCommunityGroups()
    {
        return view('front.home.community.add-groups');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function storeCommunityGroups(Request $request)
    {
        $request->validate([
    		'name' => 'required|max:255|string'
    	]);
    	$community_group = new CommunityGroup();
    	$community_group->name = $request->name;
    	$community_group->created_by = auth()->id();
    	$community_group->save();
        return redirect(route('community.my.groups'))->with('Success','Community Group Added Success');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function showDetailCommunityGroup($id)
    {
        $id = base64_decode($id);
    	$community_group = CommunityGroup::where('id',$id)->first();
        $discussions = CommunityGroupDiscussion::where('group_id', $id)->get();
        // dd($discussions);
        // $communities = CommunityGroupDetail::where('group_id', $id)->get();
        // dd($community_group);
    	// $liked = CommunityLike::where('communityId', $community_group->id)->where('liked_by',auth()->id())->first();
        return view('front.home.community.community-group-details',compact('community_group', 'discussions'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function editCommunityGroups($id)
    {
        $id = base64_decode($id);
    	$community_group = CommunityGroup::where('id',$id)->first();
        return view('front.home.community.edit-groups',compact('community_group'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function updateCommunityGroups(Request $request, $id)
    {
        $request->validate([
    		'name' => 'required|max:255|string'
    	]);
        $community_group = CommunityGroup::where('id',$id)->first();
    	$community_group->name = $request->name;
    	$community_group->save();
        return redirect(route('community.my.groups'))->with('Success','Community Group Name Updated Success');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function deleteCommunityGroups($id)
    {
        CommunityGroup::where('id',$id)->delete();
        return redirect(route('community.my.groups'))->with('Success','Community Group Deleted Success');
    }

    //discussion functions
    public function addDiscussion(Request $req)
    {
        // dd($req);
        $req->validate([
    		'group_id' => 'required|min:1|numeric',
    		'message' => 'required',
    	]);
        $discussion = new CommunityGroupDiscussion();
    	$discussion->group_id = $req->group_id;
    	$discussion->message = $req->message;
    	$discussion->user_id = auth()->id();
    	$discussion->save();
        return redirect()->back()->with('Success','Message added successfully');
    }
    public function editDiscussion($discussionId,$groupId)
    {
        $discussion = CommunityGroupDiscussion::find($discussionId);
        return view('front.home.community.edit-discussion-message',compact('discussion', 'groupId'));
    }
    public function updateDiscussion(Request $req, $id)
    {
        $req->validate([
    		'message' => 'required',
    	]);
        $discussion = CommunityGroupDiscussion::find($id);
    	$discussion->message = $req->message;
    	$discussion->save();
        return redirect()->route('community.group.detail',base64_encode($req->$id))->with('Success','Comment edited successfully');
    }
    public function deleteDiscussion($id)
    {
        CommunityGroupDiscussion::where('id',$id)->delete();
        return redirect()->back()->with('Success','Message deleted successfully');
    }
}

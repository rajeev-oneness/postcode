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

    public function manageCommunityGroups()
    {
    	$community_groups = CommunityGroup::get();
    	return view('portal.community-groups.index',compact('community_groups'));
    }


    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function createCommunityGroups()
    {
        // $communities = CommunityGroup::where('id',1)->with('communities')->get();
        $communities = Community::all();
        // dd($communities);
        if(auth()->user()->userType != 1) {
            return view('front.home.community.add-groups',compact('communities'));
        } else {
            return view('portal.community-groups.create',compact('communities'));
        }
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
    		'name' => 'required|max:255|string',
            'image' => 'required',
    		'description' => 'required',
    	]);
        $community_group = new CommunityGroup();
        if($request->hasFile('image')){
    		$random = randomGenerator();
            $image = $request->file('image');
            $image->move('uploads/community-groups/',$random.'.'.$image->getClientOriginalExtension());
            $imageurl = url('uploads/community-groups/'.$random.'.'.$image->getClientOriginalExtension());
            $community_group->image = $imageurl;
        }
    	$community_group->name = $request->name;
    	$community_group->postcode = $request->postcode;
    	$community_group->description = $request->description;
    	$community_group->created_by = auth()->id();
    	$community_group->save();
        foreach($request->communities as $community){
            $communities_group_details = new CommunityGroupDetail();
            $communities_group_details->group_id = $community_group->id;
            $communities_group_details->community_id = $community;
            $communities_group_details->save();
        }

        if(auth()->user()->userType != 1) {
    	    return redirect(route('community.my.groups'))->with('Success','Community Group Added Success');
        } else {
            return redirect(route('admin.community-groups.manage'))->with('Success','Community Group Added Success');
        }
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
        $communities = Community::all();
        $communities_group_details = CommunityGroupDetail::where('group_id', $community_group->id)->get();
        $community_id = [];
        foreach($communities_group_details as $community_group_detail){
            $community_id[] = $community_group_detail->community_id;
        }
        // dd($discussions);
        // $communities = CommunityGroupDetail::where('group_id', $id)->get();
        // dd($community_group);
    	// $liked = CommunityLike::where('communityId', $community_group->id)->where('liked_by',auth()->id())->first();
        return view('front.home.community.community-group-details',compact('community_group', 'discussions','community_id','communities'));
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
        $communities = Community::all();
        $communities_group_details = CommunityGroupDetail::where('group_id', $community_group->id)->get();
        $community_id = [];
        foreach($communities_group_details as $community_group_detail){
            $community_id[] = $community_group_detail->community_id;
        }
        if(auth()->user()->userType != 1) {
            return view('front.home.community.edit-groups',compact('community_group', 'communities','community_id'));
        } else {
    	    return view('portal.community-groups.edit',compact('community_group', 'communities', 'community_id'));
        }
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
    		'name' => 'required|max:255|string',
            'id' => 'required|min:1|numeric',
    		'name' => 'required|max:255|string',
    		'description' => 'required',
    	]);
        $community_group = CommunityGroup::where('id',$id)->first();
        if($request->hasFile('image')){
    		$random = randomGenerator();
            $image = $request->file('image');
            $image->move('uploads/community-groups/',$random.'.'.$image->getClientOriginalExtension());
            $imageurl = url('uploads/community-groups/'.$random.'.'.$image->getClientOriginalExtension());
            $community_group->image = $imageurl;
        }
    	$community_group->name = $request->name;
    	$community_group->postcode = $request->postcode;
        $community_group->description = $request->description;
    	$community_group->save();
        CommunityGroupDetail::where('group_id',$request->id)->delete();
        foreach($request->communities as $community_id){
            CommunityGroupDetail::create([
                'group_id' => $request->id,
                'community_id' =>$community_id
            ]);
        }
        if(auth()->user()->userType != 1) {
    	    return redirect(route('community.my.groups'))->with('Success','Community Group Updated Success');
        } else {
            return redirect(route('admin.community-groups.manage'))->with('Success','Community Group Updated Success');
        }
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
        CommunityGroupDetail::where('group_id', $id)->delete();
        if(auth()->user()->userType != 1) {
    	    return redirect(route('community.my.post'))->with('Success','Community Group Deleted Success');
        } else {
            return redirect(route('admin.community-groups.manage'))->with('Success','Community Group Deleted Success');
        }
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
    public function updateDiscussion(Request $req)
    {
        // dd($req);
        $req->validate([
    		'message' => 'required',
    	]);
        $discussion = CommunityGroupDiscussion::find($req->id);
    	$discussion->message = $req->message;
    	$discussion->save();
        return redirect()->route('community.group.detail',base64_encode($req->id))->with('Success','Message edited successfully');
    }
    // public function updateComment(Request $req)
    // {
    //     $req->validate([
    // 		'comment_id' => 'required|min:1|numeric',
    // 		'comment' => 'required',
    // 	]);
    //     $comment = CommunityComment::find($req->comment_id);
    // 	$comment->comment = $req->comment;
    // 	$comment->save();
    //     return redirect()->route('community.post.detail',base64_encode($req->community_id))->with('Success','Comment edited successfully');
    // }
    public function deleteDiscussion($id)
    {
        CommunityGroupDiscussion::where('id',$id)->delete();
        return redirect()->back()->with('Success','Message deleted successfully');
    }
}

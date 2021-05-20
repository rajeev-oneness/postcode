<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Model\Community;
use App\Model\CommunityCategory;
use App\Model\CommunityComment;
use App\Model\CommunityLike;

class CommunityController extends Controller
{
    public function manageCommunity(Request $req)
    {
    	$community = Community::get();
    	return view('portal.community.index',compact('community'));
    }

    public function createCommunity(Request $req)
    {
        $category = CommunityCategory::get();
        if(auth()->user()->userType != 1) {
            return view('front.home.community.add',compact('category'));
        } else {
            return view('portal.community.create',compact('category'));
        }
    }

    public function storeCommunity(Request $req)
    {
    	$req->validate([
    		'image' => 'required',
            'category' => 'required|min:1|numeric|exists:community_categories,id',
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
        $community->communityCategoryId = $req->category;
    	$community->title = $req->title;
    	$community->description = $req->description;
    	$community->created_by = auth()->id();
    	$community->save();
        if(auth()->user()->userType != 1) {
    	    return redirect(route('community.my.post'))->with('Success','Community Added!');
        } else {
            return redirect(route('admin.community.manage'))->with('Success','Community Added!');
        }
    	
    }

    public function editCommunity(Request $req,$editId)
    {
    	$id = base64_decode($editId);
    	$community = Community::where('id',$id)->first();
        $category = CommunityCategory::get();
        if(auth()->user()->userType != 1) {
            return view('front.home.community.edit',compact('community','category'));
        } else {
    	    return view('portal.community.edit',compact('community','category'));
        }
    }

    public function updateCommunity(Request $req,$updateId)
    {
    	$req->validate([
    		'id' => 'required|min:1|numeric',
            'category' => 'required|min:1|numeric|exists:community_categories,id',
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
        $community->communityCategoryId = $req->category;
    	$community->title = $req->title;
    	$community->description = $req->description;
    	$community->save();
        if(auth()->user()->userType != 1) {
    	    return redirect(route('community.my.post'))->with('Success','Community Updated!');
        } else {
            return redirect(route('admin.community.manage'))->with('Success','Community Updated!');
        }
    }

    public function deleteCommunity(Request $req,$id)
    {
    	Community::where('id',$id)->delete();
        if(auth()->user()->userType != 1) {
    	    return redirect(route('community.my.post'))->with('Success','Community Deleted!');
        } else {
            return redirect(route('admin.community.manage'))->with('Success','Community Deleted!');
        }
    }

    public function showCommunity()
    {
        $community = Community::orderBy('created_at', 'DESC')->get();
    	return view('front.home.community.index',compact('community'));
    }
    public function showCatgoryWiseCommunity($id)
    {
        $community = Community::where('communityCategoryId', $id)->orderBy('created_at', 'DESC')->get();
    	return view('front.home.community.index',compact('community'));
    }
    public function showMyPosts()
    {
        $community = Community::where('created_by', auth()->id())->orderBy('created_at', 'DESC')->get();
    	return view('front.home.community.my-posts',compact('community'));
    }
    public function showDetailCommunity($id)
    {
        $edit_id = base64_decode($id);
    	$community = Community::where('id',$edit_id)->first();
    	$liked = CommunityLike::where('communityId', $community->id)->where('liked_by',auth()->id())->first();
        return view('front.home.community.community-details',compact('community', 'liked'));
    }

    //comment functions
    public function addComment(Request $req)
    {
        $req->validate([
    		'communityId' => 'required|min:1|numeric',
    		'comment' => 'required',
    	]);
        $comment = new CommunityComment;
    	$comment->communityId = $req->communityId;
    	$comment->comment = $req->comment;
    	$comment->commented_by = auth()->id();
    	$comment->save();
        return redirect()->back()->with('Success','Comment added!');
    }
    public function editComment($commentId,$communityId)
    {
        $comment = CommunityComment::find($commentId);
        return view('front.home.community.edit-comment',compact('comment', 'communityId'));
    }
    public function updateComment(Request $req)
    {
        $req->validate([
    		'comment_id' => 'required|min:1|numeric',
    		'comment' => 'required',
    	]);
        $comment = CommunityComment::find($req->comment_id);
    	$comment->comment = $req->comment;
    	$comment->save();
        return redirect()->route('community.post.detail',base64_encode($req->community_id))->with('Success','Comment edited successfully');
    }
    public function deleteComment($id)
    {
        CommunityComment::where('id',$id)->delete();
        return redirect()->back()->with('Success','Comment deleted!');
    }

    //like function
    public function addLike(Request $req)
    {
        $like = new CommunityLike;
        $like->communityId = $req->community_id;
        $like->liked_by = auth()->id();
        $like->save();
        return response()->json(['error'=>false, 'message'=>'You have liked this post!']);
    }
    public function removeLike(Request $req)
    {
        $like = CommunityLike::find($req->like_id);
        $like->delete();
        return response()->json(['error'=>false, 'message'=>'You have removed your like from this post!']);
    }
}

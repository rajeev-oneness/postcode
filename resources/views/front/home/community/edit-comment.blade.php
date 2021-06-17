@extends('front.home.community.community')

@section('com-title')
    Post Details
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Edit Comment</a>
@endsection

@section('community-details')

<div class="reply-part mt-5 mb-5 ml-5">
    <h4>Edit Comment</h4>
    @auth
    <p>Your Email Address Will Not Be Published. Required Fields Are Marked</p>
    <form class="needs-validation" method="post" action="{{route('community.update.comment')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="comment_id" value="{{$comment->id}}">
        <input type="hidden" name="community_id" value="{{$communityId}}">
        <textarea placeholder="Comment" name="comment" rows="5">{{$comment->comment}}</textarea>
        @error('comment')<span class="text-danger">{{$message}}</span>@enderror
        <input class="leave-comments" type="submit" value="Update comment">
    </form>
    @endauth
    @guest
    <p>Login/Register to edit</p>
    @endguest
</div>
@endsection

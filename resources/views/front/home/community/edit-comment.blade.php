@extends('front.home.community.community')

@section('com-title')
    Post Details
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Edit Comment</a>
@endsection

@section('community')
<div class="row p-3">
    <ul class="search_list_items search_list_items-mod">
        @auth
        <li>
            <div class="col-12">
                <h4 class="place_title bebasnew">Edit Comment</h4>
                <form class="needs-validation" method="post" action="{{route('community.update.comment')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="comment_id" value="{{$comment->id}}">
                    <input type="hidden" name="community_id" value="{{$communityId}}">
                    <div class="form-row">
                      <div class="col-md-12 mb-3">
                        @error('description')<span class="text-danger">{{$message}}</span>@enderror
                        <textarea name="comment" id="description" class="form-control ckeditor" required>{{$comment->comment}}</textarea>
                      </div>
                    </div>
                
                  <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Update Comment</button>
                </form>
            </div>
        </li>
        @endauth
        @guest
        <li>
            <div class="col-12">
                <h4 class="place_title bebasnew">Login/Register to add response!</h4>
            </div>
        </li>
        @endguest
    </ul>
</div>
@endsection
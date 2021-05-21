@extends('front.home.community.community')

@section('com-title')
    Post Details
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Post Details</a>
@endsection

@section('community')
<div class="row p-3">
    <ul class="search_list_items search_list_items-mod">
        <li>
            <div class="location_img_wrap">
                <img src="{{asset($community->image)}}" width="250px">
            </div>
            <div class="list_content_wrap">
                <ul class="rating_coments">
                    <li>
                        <h5><span>{{$community->community_category->name}}</span></h5>
                    </li>
                </ul>
                <h4 class="place_title bebasnew">{{$community->title}}</h4>
                
                <div class="location_details">
                    <p class="location">
                        <i class="fas fa-thumbs-up text-primary"></i> {{count($community->get_likes)}} Likes
                    </p>
                    <p class="phone_call">
                        <i class="fas fa-comment text-warning"></i> {{count($community->comments)}} Comments                        
                    </p>
                    @auth
                    <p class="phone_call">
                        <input type="hidden" id="community_id_like" value="{{$community->id}}">
                        @if ($liked)
                        <input type="hidden" id="like_id" value="{{$liked->id}}">
                        <button id="remove_like_button" class="btn btn-primary"><i class="fas fa-times"></i> Remove Like</button> 
                        @else
                        <button id="like_button" class="btn btn-primary"><i class="fas fa-thumbs-up"></i> Like</button> 
                        @endif              
                    </p>
                    @endauth
                    <p class="text-muted">(On {{date('d M,y', strtotime($community->created_at))}}. By {{$community->user->name}})</p>
                </div>
                <p class="history_details">{!! $community->description !!}</p>
            </div>
        </li>
        @forelse ($community->comments as $comment)
        <li>
            <div class="col-12">
                @auth
                    @if (auth()->id() == $comment->commented_by)
                    <p>
                        <a href="{{route('community.edit.comment', ['commentId'=>$comment->id, 'communityId'=>$community->id])}}"><i class="fas fa-edit text-success"></i></a>&nbsp;&nbsp;&nbsp;
                        <a onclick="return confirm('Are you sure?')" href="{{route('community.delete.comment', $comment->id)}}"><i class="fas fa-trash text-danger"></i></a>
                    </p>
                    @endif
                @endauth
                <h4 class="place_title bebasnew">{{$comment->user->name}}</h4>
                <p class="text-muted">(On {{date('d M,y', strtotime($comment->created_at))}})</p>
                <p class="history_details">{!! $comment->comment !!}</p>
            </div>
        </li>
        @empty
        <li>
            <div class="col-12">
                <h4 class="place_title bebasnew">No Comment!</h4>
            </div>
        </li>
        @endforelse
        @auth
        <li>
            <div class="col-12">
                <h4 class="place_title bebasnew">Add Comment</h4>
                <form class="needs-validation" method="post" action="{{route('community.add.comment')}}" enctype="multipart/form-data">
                    {{csrf_field()}}
                    <input type="hidden" name="communityId" value="{{$community->id}}">
                    <div class="form-row">
                      <div class="col-md-12 mb-3">
                        @error('description')<span class="text-danger">{{$message}}</span>@enderror
                        <textarea name="comment" id="description" class="form-control ckeditor" required>{{old('comment')}}</textarea>
                      </div>
                    </div>
                
                  <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Add Comment</button>
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

@section('community-scripts')
    
<script>
    $("#like_button").click(function() {
        var community_id = $("#community_id_like").val();
        $.ajax({
            url: "{{route('community.add.like')}}",
            method: "POST",
            data: {'_token': '{{csrf_token()}}', 'community_id': community_id},
            success: function(data) {
                console.log(data);
                $('#like_button').empty();
                $('#like_button').append("<i class='fas fa-times'></i> Remove Like"); 
                $('#like_button').attr('id','remove_like_button');
                location.reload();
            },
            error: function() {
                console.error('Can not like');
            }
        })
    });
    $("#remove_like_button").click(function() {
        var like_id = $("#like_id").val();
        $.ajax({
            url: "{{route('community.remove.like')}}",
            method: "POST",
            data: {'_token': '{{csrf_token()}}', 'like_id': like_id},
            success: function(data) {
                console.log(data);
                $('#remove_like_button').empty();
                $('#remove_like_button').append("<i class='fas fa-thumbs-up'></i> Like"); 
                $('#remove_like_button').attr('id','like_button');
                location.reload();
            },
            error: function() {
                console.error('Can not like');
            }
        })
    });
</script>

@endsection
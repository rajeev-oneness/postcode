
@extends('front.home.community.community')

@section('com-title')
    Group Details
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Group Details</a>
@endsection

@section('community-details')
<div class="details-community">
    <h2 class="heading-content">{{$community_group->name}}</h2>
    {!! $community_group->description !!}
    
    <div class="mt-5 mb-5">
      <img class="comm-pic" src="{{asset($community_group->image)}}" width="700px">
    </div>
    {{-- @foreach($communities as $community)
        @if(in_array($community->id, $community_id))
            <p class="location">
                <i class="fas fa-users text-primary"></i> {{$community->title}}
            </p>
        @endif
    @endforeach --}}
    <div class="comments-area">
      <h3>Discussions</h3>

      @forelse ($discussions as $discussion)
      <div class="cover-comments">
        <div class="client-image">
          <img src="{{asset('homepage_assets/images/comments-clients.png')}}">
        </div>
        <div class="details-client">
          <div class="client-details">
            <h4>{{$discussion->user->name}}</h4>
            <p class="date"><span><img src="{{asset('homepage_assets/images/calender.png')}}"></span>{{date('d . m . Y', strtotime($discussion->created_at))}}</p>
            <p class="time"><span><img src="{{asset('homepage_assets/images/clock.png')}}"></span>{{date('h : ia', strtotime($discussion->created_at))}}</p>
            @auth
                @if (auth()->id() == $discussion->user->id)
                <p class="time">
                    <a href="{{route('community.edit.discussion', ['discussionId'=>$discussion->id, 'groupId'=>$community_group->id])}}"><i class="fas fa-edit text-success"></i></a>&nbsp;&nbsp;&nbsp;
                    <a onclick="return confirm('Are you sure?')" href="{{route('community.delete.discussion', $discussion->id)}}"><i class="fas fa-trash text-danger"></i></a>
                </p>
                @endif
            @endauth
          </div>
          <p>{!! $discussion->message !!}</p>
        </div>
      </div>
      @empty
      <div class="cover-comments">
        oops! no discussions
      </div>
      @endforelse

    </div>


    <div class="reply-part mt-5 mb-5">
      <h4>Leave A Message</h4>
      @auth
      <p>Your Email Address Will Not Be Published. Required Fields Are Marked</p>
      <form class="needs-validation" method="post" action="{{route('community.add.discussion')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <input type="hidden" name="group_id" value="{{$community_group->id}}">
        <textarea placeholder="Message" name="message" rows="3">{{old('message')}}</textarea>
        @error('description')<span class="text-danger">{{$message}}</span>@enderror
        <input class="leave-comments" type="submit" value="Leave a message">
      </form>
      @endauth
      @guest
      <p>Login/Register to perticipate in discussion</p>
      @endguest
    </div>


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

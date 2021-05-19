@extends('front.home.community.community')

@section('com-title')
    Edit Group
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Edit</a></li>
@endsection

@section('community')

<div class="p-4">
    <h4>Edit Group</h4>
    <hr>
    <form class="needs-validation" method="post" name="community_group" action="{{route('community.update.group',$community_group->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
          <input type="hidden" name="id" value="{{$community_group->id}}">
        </div>
        <div class="form-row">


          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Update Name</label>
            <input type="text" name="name" required class="form-control @error('name'){{('is-invalid')}}@enderror" placeholder="Community group name" value="@if(old('name')){{old('name')}}@else{{$community_group->name}}@endif">
            @error('name')<span class="text-danger">{{$message}}</span>@enderror
          </div>



        </div>

      <button class="btn btn-primary" id="submit_community_group" name="submit_community_group" type="submit">Update Community Group Name</button>
    </form>
</div>

@endsection

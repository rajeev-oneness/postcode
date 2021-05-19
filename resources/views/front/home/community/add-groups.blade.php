@extends('front.home.community.community')

@section('com-title')
    Add Community Group
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Add Community Group</a></li>
@endsection

@section('community')

<div class="p-4">
    <h4>Add Community Group</h4>
    <hr>
    <form class="needs-validation" method="post" name="community" action="{{route('community.store.group')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">


          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Name</label>
            <input type="text" name="name" required class="form-control @error('name'){{('is-invalid')}}@enderror" placeholder="Community Group name" value="{{old('name')}}">
            @error('name')<span class="text-danger">{{$message}}</span>@enderror
          </div>
        </div>

      <button class="btn btn-primary" id="submit_community_group" name="submit_community_group" type="submit">Add Community Group</button>
    </form>
</div>

@endsection

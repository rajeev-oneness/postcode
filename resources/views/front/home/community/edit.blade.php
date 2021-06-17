@extends('front.home.community.community')

@section('com-title')
    Edit Post
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Edit</a></li>
@endsection

@section('community-details')

<div class="p-4">
    <h4>Edit Post</h4>
    <hr>
    <form class="needs-validation" method="post" name="community" action="{{route('community.update.post',$community->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
          <input type="hidden" name="id" value="{{$community->id}}">
          <div class="col-md-6 mb-3">
            <img src="{{asset($community->image)}}" height="100" width="100">
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Title</label>
            <input type="text" name="title" required class="form-control @error('title'){{('is-invalid')}}@enderror" placeholder="Community Title" value="@if(old('title')){{old('title')}}@else{{$community->title}}@endif">
            @error('title')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Category</label>
            <select name="category" class="form-control" required="">
                <option value="" selected="" hidden="">Select Category</option>
                @foreach($category as $cat)
                  <option value="{{$cat->id}}" @if(old('category')==$cat->id){{('selected')}}@elseif($community->communityCategoryId == $cat->id){{('selected')}}@endif>{{$cat->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="col-md-12 mb-3">
            <label for="validationCustom05">Description</label>
            @error('description')<span class="text-danger">{{$message}}</span>@enderror
            <textarea name="description" id="description" class="form-control ckeditor" required>@if(old('description')){{old('description')}}@else{{$community->description}}@endif</textarea>
          </div>
        </div>

      <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Update Community</button>
    </form>
</div>

@endsection
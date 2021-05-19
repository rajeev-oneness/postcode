@extends('front.home.community.community')

@section('com-title')
    Add Post
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Add Post</a></li>
@endsection

@section('community')

<div class="p-4">
    <h4>Add Post</h4>
    <hr>
    <form class="needs-validation" method="post" name="community" action="{{route('community.store.post')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Image</label>
            <input type="file" name="image" required class="form-control">
            @error('image')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Title</label>
            <input type="text" name="title" required class="form-control @error('title'){{('is-invalid')}}@enderror" placeholder="Community Title" value="{{old('title')}}">
            @error('title')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom03">Category</label>
            <select name="category" class="form-control" required="">
                <option value="" selected="" hidden="">Select Category</option>
                @foreach($category as $cat)
                  <option value="{{$cat->id}}" @if(old('category')==$cat->id){{('selected')}}@endif>{{$cat->name}}</option>
                @endforeach
            </select>
          </div>

          <div class="col-md-12 mb-3">
            <label for="validationCustom05">Description</label>
            @error('description')<span class="text-danger">{{$message}}</span>@enderror
            <textarea name="description" id="description" class="form-control ckeditor" required>{{old('description')}}</textarea>
          </div>
        </div>

      <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Add Community</button>
    </form>
</div>

@endsection

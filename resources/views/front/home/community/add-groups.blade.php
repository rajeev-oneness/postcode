@extends('front.home.community.community')

@section('com-title')
Add Community Group
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Add Community Group</a></li>
@endsection

@section('community-details')

<div class="p-4">
    <h4>Add Community Group</h4>
    <hr>
    <form class="needs-validation" method="post" name="community_group" action="{{route('community.store.group')}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Image</label>
            <input type="file" name="image" required class="form-control">
            @error('image')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Group Name</label>
            <input type="text" name="name" required class="form-control @error('name'){{('is-invalid')}}@enderror" placeholder="Group name" value="{{old('name')}}">
            @error('name')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Choose Communities</label>
            <select name="communities[]" multiple="multiple" placeholder="Search Communities" class="search-box form-control">
                <option disabled >Select Communities</option>
                @foreach($communities as $community)
                  <option value="{{$community->id}}" @if(old('community')==$community->id){{('selected')}}@endif>{{$community->title}}</option>
                @endforeach
             </select>
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Postcode</label>
            <input type="number" name="postcode" required class="form-control @error('postcode'){{('is-invalid')}}@enderror" placeholder="Postcode" value="{{old('postcode')}}">
            @error('postcode')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-12 mb-3">
            <label for="validationCustom05">Description</label>
            @error('description')<span class="text-danger">{{$message}}</span>@enderror
            <textarea name="description" id="description" class="form-control ckeditor" required>{{old('description')}}</textarea>
          </div>
        </div>

      <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Add Community Group</button>
    </form>
</div>

@endsection

@section('script')
<script type="text/javascript">
    $(document).ready(function () {
        window.Search = $('.search-box').SumoSelect({ csvDispCount: 3, search: true, searchText:'Enter here.' });
    });
</script>
@endsection

@extends('front.home.community.community')

@section('com-title')
    Edit Group
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Edit Group</a></li>
@endsection

@section('community')

<div class="p-4">
    <h4>Edit Group</h4>
    <hr>
    <form class="needs-validation" method="post" name="community_group" action="{{route('community.update.group',$community_group->id)}}" enctype="multipart/form-data">
        {{csrf_field()}}
        <div class="form-row">
          <input type="hidden" name="id" value="{{$community_group->id}}">
          <div class="col-md-6 mb-3">
            <img src="{{asset($community_group->image)}}" height="100" width="100">
          </div>
        </div>
        <div class="form-row">
          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Image</label>
            <input type="file" name="image" class="form-control">
            @error('image')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <label for="validationCustom05">Update Name</label>
            <input type="text" name="name" required class="form-control @error('name'){{('is-invalid')}}@enderror" placeholder="Group name" value="@if(old('name')){{old('name')}}@else{{$community_group->name}}@endif">
            @error('name')<span class="text-danger">{{$message}}</span>@enderror
          </div>

          <div class="col-md-6 mb-3">
            <select name="communities[]" multiple="multiple" placeholder="Search Communities" class="search-box form-control">
                <option disabled >Select Communities</option>
                @foreach($communities as $community)
                  {{-- <option value="{{$community->id}}" @if(old('community')==$community->id){{('selected')}}@endif>{{$community->title}}</option> --}}
                  {{-- <option value="{{$community->id}}" @if(old('community')==$community->id){{('selected')}}@elseif($community_group->id == $communities_group_details->group_id){{('selected')}}@endif>{{$community->title}}</option> --}}
                    @if(in_array($community->id, $community_id))
                        <option value="{{ $community->id }}" selected>{{ $community->title }}</option>
                    @else
                        <option value="{{ $community->id }}">{{ $community->title }}</option>
                    @endif
                @endforeach
             </select>
          </div>

          <div class="col-md-12 mb-3">
            <label for="validationCustom05">Description</label>
            @error('description')<span class="text-danger">{{$message}}</span>@enderror
            <textarea name="description" id="description" class="form-control ckeditor" required>@if(old('description')){{old('description')}}@else{{$community_group->description}}@endif</textarea>
          </div>
        </div>

      <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Update Group</button>
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

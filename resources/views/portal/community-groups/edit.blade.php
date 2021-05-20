<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin | Edit Community Group</title>
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
  @extends('portal.layouts.master')
  @section('content')
  <!-- Page Body Start-->
  <div class="page-body-wrapper">
    <div class="page-body">
      <div class="container-fluid flowid">
        <div class="page-header">
          <div class="row">
            <div class="col">
              <div class="page-header-left">
                <h3>Edit Community Group</h3>

              </div>
            </div>

          </div>
        </div>
      </div>
      <!-- Container-fluid starts-->
      <div class="container-fluid flowid">
        <div class="row">
          <div class="col-sm-12">
            <div class="card">
              @if ($errors->any())
                  <div class="alert alert-danger">
                      <ul>
                          @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                          @endforeach
                      </ul>
                  </div>
              @endif
              <div class="card-body">
                <form class="needs-validation" method="post" name="community" action="{{route('admin.community-groups.update',$community_group->id)}}" enctype="multipart/form-data">
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
                      <label for="validationCustom05">Group Name</label>
                      <input type="text" name="name" required class="form-control @error('name'){{('is-invalid')}}@enderror" placeholder="Group name" value="@if(old('name')){{old('name')}}@else{{$community_group->name}}@endif">
                      @error('name')<span class="text-danger">{{$message}}</span>@enderror
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
            </div>


          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>


    @endsection

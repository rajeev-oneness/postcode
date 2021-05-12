<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="utf-8" />
  <title>Admin | Edit Community</title>
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
                <h3>Edit Community</h3>

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
                <form class="needs-validation" method="post" name="community" action="{{route('admin.community.update',$community->id)}}" enctype="multipart/form-data">
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

                    <div class="col-md-12 mb-3">
                      <label for="validationCustom05">Description</label>
                      @error('description')<span class="text-danger">{{$message}}</span>@enderror
                      <textarea name="description" id="description" class="form-control ckeditor" required>@if(old('description')){{old('description')}}@else{{$community->description}}@endif</textarea>
                    </div>
                  </div>

                <button class="btn btn-primary" id="submit_Community" name="submit_Community" type="submit">Add Community</button>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>


    @endsection
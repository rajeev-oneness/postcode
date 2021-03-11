<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Business Profile</title>

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
                <h3>Add Business Details</h3>

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

              <div class="card-body">
              <div class="alert alert-warning" id="error-msg" style="display:none;">
                          <a href="#" class="close" data-dismiss="alert" aria-label="close">&times;</a>
  <div id="error-message"></div>
                    </div>
                <form class="needs-validation" method="post" action="{{route('admin.add_businessprofile')}}" enctype="multipart/form-data" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="formrow-inputState">Business Category</label>
                        <select id="business_categoryId" name="business_categoryId" class="form-control" required="">
                          <option value="{{ old('business_categoryId') }}">Select</option>
                          @foreach($businessData as $businessName)
                          <option value="{{$businessName->id}}">{{$businessName->name}}</option>
                          @endforeach
                        </select>
                        @error('business_categoryId')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Business Name</label>
                      <input class="form-control" id="name" name="name" value="{{ old('name') }}" type="text" placeholder="Business Name" required="">
                      @error('name')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustomUsername">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                          <img src="/uploads/blank_img1.jpg" alt="people" class="busiprofimg" width="56" id="img-upload">

                          <input class="form-control offrimg" type="file" id="image" value="{{old('image')}}" name="image" required="">
                          @error('business_categoryId')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                        </div>
                      </div>
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Address</label>
                      <input class="form-control" id="address" value="{{ old('address') }}" name="address" type="text" placeholder="Enter Address" required="">
                      @error('address')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Mobile</label>
                      <input class="form-control" id="mobile" value="{{ old('mobile') }}" name="mobile" type="text" placeholder="Mobile" required="">
                      @error('mobile')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Opening Hour</label>
                      <input class="form-control" id="open_hour" value="{{ old('open_hour') }}" name="open_hour" type="text" placeholder="Opening Hour" required="">
                      @error('open_hour')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Closing Hour</label>
                      <input class="form-control" id="closing_hour" value="{{ old('closing_hour') }}" name="closing_hour" type="text" placeholder="Closing Hour" required="">
                      @error('closing_hour')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Description</label>
                      <input class="form-control" id="description" value="{{ old('description') }}" name="description" type="text" placeholder="Description" required="">
                      @error('description')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="formrow-inputState">Product</label>
                        <select id="products" name="products" class="form-control" required="">
                          <option value="{{ old('products') }}">Select</option>
                          @foreach($producData as $produData)
                          <option value="{{$produData->id}}">{{$produData->name}}</option>
                          @endforeach
                        </select>
                        @error('products')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>

                  </div>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">Service</label>
                        <select id="services" name="services" class="form-control" required="">
                          <option value="{{ old('services') }}">Select</option>
                          @foreach($servicData as $servName)
                          <option value="{{$servName->id}}">{{$servName->name}}</option>
                          @endforeach
                        </select>
                        @error('services')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Facebook link</label>
                      <input class="form-control" id="facebook_link" value="{{ old('facebook_link') }}" name="facebook_link" type="text" placeholder="Facebook link" required="">
                      @error('facebook_link')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Instagram link</label>
                      <input class="form-control" id="instagram_link" value="{{ old('instagram_link') }}" name="instagram_link" type="text" placeholder="Instagram link" required="">
                      @error('instagram_link')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                  </div>

                  <div class="form-row">

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Twitter link</label>
                      <input class="form-control" id="twitter_link" value="{{ old('twitter_link') }}" name="twitter_link" type="text" placeholder="Twitter link" required="">
                      @error('twitter_link')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Youtube link</label>
                      <input class="form-control" id="youtube_link" value="{{ old('youtube_link') }}" name="youtube_link" type="text" placeholder="Youtube link" required="">
                      @error('youtube_link')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Linkedin link</label>
                      <input class="form-control" id="linkedin_link" value="{{ old('linkedin_link') }}" name="linkedin_link" type="text" placeholder="Linkedin link" required="">
                      @error('linkedin_link')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">State Name</label>
                        <select id="state_id" name="state_id" class="form-control" required="">
                          <option value="{{ old('state_id') }}">Select</option>
                          @foreach($stateData as $stateName)
                          <option value="{{$stateName->id}}">{{$stateName->name}}</option>
                          @endforeach
                        </select>
                        @error('state_id')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Pin Code</label>
                      <input class="form-control" id="pin_code" value="{{ old('pin_code') }}" name="pin_code" type="text" placeholder="Enter Pin Code" required="">
                      @error('facebook_link')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                 
                  </div>

                  <button class="btn btn-primary" id="submit_business" name="submit_business" type="submit">Submit</button>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>

    <script>
     

      function readURL(input) {
        if (input.files && input.files[0]) {
          var reader = new FileReader();

          reader.onload = function(e) {
            $('#img-upload').attr('src', e.target.result);
          }

          reader.readAsDataURL(input.files[0]);
        }
      }

      $("#image").change(function() {
        readURL(this);
      });
    </script>

    @endsection
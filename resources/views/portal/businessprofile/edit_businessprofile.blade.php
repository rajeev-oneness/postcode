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
                    <form class="needs-validation" method="post" action="{{route('admin.update_businessprofiles')}}" enctype="multipart/form-data" novalidate="">
                    <input type="hidden" id="hid_id" name="hid_id" value="{{ $businessprofile_data->id }}">
                    <input type="hidden" id="hid_img" name="hid_img" value="">
                    {{csrf_field()}}
                      <div class="form-row">
                        <div class="col-md-4 mb-3">
                        <div class="form-group">
                                                <label for="formrow-inputState">Business Category</label>
                                                <select id="business_categoryId" name="business_categoryId" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($businessCatData as $businessprofName)
                                                <option value="{{$businessprofName->id}}" <?php echo $businessprofile_data->business_categoryId ==  $businessprofName->id ? "selected" : ""; ?>>{{$businessprofName->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Business Name</label>
                          <input class="form-control" id="name" name="name" type="text" value="{{ $businessprofile_data->name }}" placeholder="Business Name" required="">
                         
                        </div>
                       
                        <div class="col-md-4 mb-3">
                      <label for="validationCustomUsername">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                        <img src="\{{$businessprofile_data->image}}" alt="people" class="offrlck" width="56" id="img-upload">
                          <input class="form-control offimgbuis" type="file" id="image" value="" name="image" required="">
                          @error('image')
                          {{$message}}
                          @enderror
                        </div>
                      </div>
                    </div>
                        
                      </div>
                   
                      <div class="form-row">
                      <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Address</label>
                          <input class="form-control" id="address" name="address" value="{{ $businessprofile_data->address }}" type="text" placeholder="Enter Address" required="">
                         
                        </div>
                     
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Mobile</label>
                          <input class="form-control" id="mobile" name="mobile" type="text" value="{{ $businessprofile_data->mobile }}" placeholder="Mobile" required="">
                         
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Opening Hour</label>
                          <input class="form-control" id="open_hour" name="open_hour" type="text" value="{{ $businessprofile_data->open_hour }}" placeholder="Opening Hour" required="">
                         
                        </div>
                     
                      </div>

                      <div class="form-row">
                      <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Closing Hour</label>
                          <input class="form-control" id="closing_hour" name="closing_hour" value="{{ $businessprofile_data->closing_hour }}" type="text" placeholder="Closing Hour" required="">
                         
                        </div>
                      
                      <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Description</label>
                          <input class="form-control" id="description" name="description" value="{{ $businessprofile_data->description }}" type="text" placeholder="Description" required="">
                         
                        </div>
                        <div class="col-md-4 mb-3">
                        <div class="form-group">
                                                <label for="formrow-inputState">Product</label>
                                                <select id="products" name="products" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($productsData as $produData)
                                                <option value="{{$produData->id}}" <?php echo $businessprofile_data->products ==  $produData->id ? "selected" : ""; ?>>{{$produData->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                        </div>
                        
                      </div>
                      <div class="form-row">
                      <div class="col-md-4 mb-3">
                        <div class="form-group">
                                                <label for="formrow-inputState">Service</label>
                                                <select id="services" name="services" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($servicessData as $servName)
                                                <option value="{{$servName->id}}" <?php echo $businessprofile_data->services ==  $servName->id ? "selected" : ""; ?>>{{$servName->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Facebook link</label>
                          <input class="form-control" id="facebook_link" name="facebook_link" value="{{ $businessprofile_data->facebook_link }}" type="text" placeholder="Facebook link" required="">
                         
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Instagram link</label>
                          <input class="form-control" id="instagram_link" name="instagram_link" value="{{ $businessprofile_data->instagram_link }}" type="text" placeholder="Instagram link" required="">
                         
                        </div>
                      </div>

                      <div class="form-row">
                      
                      <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Twitter link</label>
                          <input class="form-control" id="twitter_link" value="{{ $businessprofile_data->twitter_link }}" name="twitter_link" type="text" placeholder="Twitter link" required="">
                         
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Youtube link</label>
                          <input class="form-control" id="youtube_link" value="{{ $businessprofile_data->youtube_link }}" name="youtube_link" type="text" placeholder="Youtube link" required="">
                         
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Linkedin link</label>
                          <input class="form-control" id="linkedin_link" value="{{ $businessprofile_data->linkedin_link }}" name="linkedin_link" type="text" placeholder="Linkedin link" required="">
                         
                        </div>
                       
                      </div>

                      <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">State Name</label>
                        <select id="state_id" name="state_id" class="form-control" required="">
                          <option value="{{ old('state_id') }}">Select</option>
                          @foreach($stateData as $stateName)
                          <option value="{{$stateName->id}}" <?php echo $businessprofile_data->state_id ==  $stateName->id ? "selected" : ""; ?>>{{$stateName->name}}</option>
                          @endforeach
                        </select>
                        @error('state_id')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Pin Code</label>
                      <input class="form-control" id="pin_code" value="{{ $businessprofile_data->pin_code }}" name="pin_code" type="text" placeholder="Enter Pin Code" required="">
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
$(document).ready(function (){


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
      $('.file-upload').file_upload();
    });
     </script>
    
        @endsection
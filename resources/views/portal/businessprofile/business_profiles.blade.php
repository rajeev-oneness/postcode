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
                <form class="needs-validation" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="formrow-inputState">Business Category</label>
                        <select id="business_categoryId" name="business_categoryId" class="form-control">
                          <option value="">Select</option>
                          @foreach($businessData as $businessName)
                          <option value="{{$businessName->id}}">{{$businessName->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Business Name</label>
                      <input class="form-control" id="name" name="name" type="text" placeholder="Business Name" required="">

                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustomUsername">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                          <img src="/uploads/blank_img1.jpg" alt="people" class="busiprofimg" width="56" id="img-upload">

                          <input type="file" id="image" value="{{old('image')}}" name="image">
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
                      <input class="form-control" id="address" name="address" type="text" placeholder="Enter Address" required="">

                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Mobile</label>
                      <input class="form-control" id="mobile" name="mobile" type="text" placeholder="Mobile" required="">

                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Opening Hour</label>
                      <input class="form-control" id="open_hour" name="open_hour" type="text" placeholder="Opening Hour" required="">

                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Closing Hour</label>
                      <input class="form-control" id="closing_hour" name="closing_hour" type="text" placeholder="Closing Hour" required="">

                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Description</label>
                      <input class="form-control" id="description" name="description" type="text" placeholder="Description" required="">

                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="formrow-inputState">Product</label>
                        <select id="products" name="products" class="form-control">
                          <option value="">Select</option>
                          @foreach($producData as $produData)
                          <option value="{{$produData->id}}">{{$produData->name}}</option>
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
                          @foreach($servicData as $servName)
                          <option value="{{$servName->id}}">{{$servName->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Facebook link</label>
                      <input class="form-control" id="facebook_link" name="facebook_link" type="text" placeholder="Facebook link" required="">

                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Instagram link</label>
                      <input class="form-control" id="instagram_link" name="instagram_link" type="text" placeholder="Instagram link" required="">

                    </div>
                  </div>

                  <div class="form-row">

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Twitter link</label>
                      <input class="form-control" id="twitter_link" name="twitter_link" type="text" placeholder="Twitter link" required="">

                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Youtube link</label>
                      <input class="form-control" id="youtube_link" name="youtube_link" type="text" placeholder="Youtube link" required="">

                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Linkedin link</label>
                      <input class="form-control" id="linkedin_link" name="linkedin_link" type="text" placeholder="Linkedin link" required="">

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
      $(document).ready(function() {

        $('#submit_business').click(function(e) {
          e.preventDefault();

          var formElement = document.querySelector("form");
          var formData = new FormData(formElement); //append data

          $.ajax({
            type: "post",
            url: "{{route('admin.add_business')}}",
            cache: false,
            processData: false,
            contentType: false,
            data: formData,
            dataType: "json",
            success: function(response) {

              if (response.status == 1) {
                window.location.href = "{{route('admin.dashboard')}}";
              } else {
                $("#error-msg").show();
                           
                           $("#error-message").html(response.message);
              }
            },
            error: function(jqXHR, textStatus, errorThrown) {
              // $('#submit_subject').html("Login");
              // $('#submit_subject').attr("disabled", false);
              var msg = "";
              if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
              } else {
                if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                  msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                } else {
                  msg += "<strong><ul style='list-style:none;'>";
                  $.each(jqXHR.responseJSON.errors, function(key, value) {
                    msg += "<li style='margin-left:0px;'>" + value + "</li>";
                  });
                  msg += "</ul></strong>";
                }
              }
              $("#error-msg").show();
                           
$("#error-message").html(msg);

            }
          });
        });
      });

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
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Service</title>

    @extends('business-portal.layouts.master')
    @section('content')

      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <div class="page-body"> 
          <div class="container-fluid flowid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Add Service Details</h3>
                   
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
                    <form class="needs-validation" method="post" action="{{route('business-admin.add_services')}}" enctype="multipart/form-data">
                    <input type="hidden" id="hid_id" name="hid_id">
                    {{csrf_field()}}
                      <div class="form-row">
                        
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Service Name</label>
                          <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter Product Name" maxlength="255" required="">
                          @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                        </div>
                       
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Details</label>
                          <input class="form-control" id="details" name="details" value="{{ old('details') }}" type="text" placeholder="Enter Product Details" maxlength="255" required="">
                         
                      @error('details')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                        </div>
                        
                      </div>
                   
                      <div class="form-row">
                      <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Price</label>
                          <input class="form-control" id="price" name="price" value="{{ old('price') }}" type="text" placeholder="Enter Price" onkeypress="return inputPrice(event)" required="">
                         
                      @error('price')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                        </div>
                     
                        <div class="col-md-4 mb-3">
                      <label for="validationCustomUsername" style="margin-left:13%;">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                          <img src="/uploads/blank_img1.jpg" alt="people" class="offrlckimg" width="56" id="img-upload">

                          <input class="form-control offrimg" type="file" id="image" name="image" value="{{ old('image') }}" required="">
                          @error('image')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
                    </div>
                     
                      </div>

                      <button class="btn btn-primary" id="submit_product" name="submit_product" type="submit">Submit</button>
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
        <script>
          function inputPrice(event) {
            if(event.charCode >= 48 && event.charCode <= 57) {
              return true;
            }
            return false;
          }
  
            $("form").submit(function() {
                $(this).submit(function() {
                    return false;
                });
                return true;
            });
        </script>
        @endsection
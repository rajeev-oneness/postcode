<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Business-Admin | Add Product</title>
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


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
                <h3>Add Product Details</h3>

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
                <form class="needs-validation" method="post" name="offr" action="{{route('business-admin.add_products')}}" enctype="multipart/form-data">
                  <input type="hidden" id="hid_id" name="hid_id">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">Business Category</label>
                        <select id="businessId" name="businessId" class="form-control" required="">
                          <option value="{{ old('businessId') }}">Select</option>
                          @foreach($businessData as $businessName)
                          <option value="{{$businessName->id}}">{{$businessName->name}}</option>
                          @endforeach
                        </select>
                        @error('businessId')
					                <span class="text-danger">{{ $message }}</span>
					              @enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">Product Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter Product Name" maxlength="255" required="">
                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">Product Details</label>
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
                      <label for="validationCustomUsername" class="prolabimg">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                        <img src="{{asset('/uploads/blank_img1.jpg')}}" alt="people" class="offrlckimg" width="56" id="img-upload">
                          <input class="form-control offrimg" type="file" id="image" value="{{old('image')}}" name="image" required="">
                          @error('image')
                          <span class="text-danger">{{ $message }}</span>
                          @enderror
                        </div>
                      </div>
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
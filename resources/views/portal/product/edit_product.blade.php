<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Edit Product</title>
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
                <h3>Edit Product Details</h3>

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
                <form class="needs-validation" method="post" name="offr" action="{{route('admin.update_products')}}" enctype="multipart/form-data" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id" value="{{$edited_data->id}}">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">Business Category</label>
                        <select id="businessId" name="businessId" class="form-control" required="">
                          <option value="">Select</option>
                          @foreach($businessData as $businessName)
                          <option value="{{$businessName->id}}" <?php echo $edited_data->businessId ==  $businessName->id ? "selected" : ""; ?>>{{$businessName->name}}</option>
                          @endforeach
                        </select>
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">Product Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{$edited_data->name}}" placeholder="Enter Product Name" required="">

                    </div>


                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">Product Details</label>
                      <input class="form-control" id="details" name="details" value="{{$edited_data->details}}" type="text" placeholder="Enter Product Details" required="">

                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">Price</label>
                      <input class="form-control" id="price" name="price" value="{{$edited_data->price}}" type="text" placeholder="Enter Price" required="">

                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustomUsername" class="prolabimg">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                        <img src="{{url($edited_data->image)}}" alt="people" class="offrlckimg" width="56" id="img-upload">
                          <input class="form-control offrimg" type="file" id="image" value="" name="image" required="">
                      
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
      

    @endsection
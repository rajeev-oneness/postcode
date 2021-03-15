<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Add State</title>
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
                <h3>Add State Details</h3>

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
                <form class="needs-validation" method="post" action="{{route('admin.add_states')}}" enctype="multipart/form-data" novalidate="">
                  {{csrf_field()}}
                  <div class="form-row">
                   
                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">State Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter State Name" required="">

                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>


                    <div class="col-md-4 mb-3">
                    <label for="validationCustom05">State Code</label>
                      <input class="form-control" id="code" name="code" value="{{ old('code') }}" type="text" placeholder="Enter State Code" required="">

                      @error('code')
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
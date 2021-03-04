<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Business Categories</title>

  @extends('portal.layouts.master')
  @section('content')

  <style>
    .flowid {
      width: 99%;
      padding-right: 15px;
      padding-left: 21%;
    }
  </style>
  <style>
    .switch {
      position: relative;
      display: inline-block;
      width: 26px;
      height: 15px;
      margin-bottom: -3px;
    }

    .switch input {
      opacity: 0;
      width: 0;
      height: 0;
    }

    .slider {
      position: absolute;
      cursor: pointer;
      top: 0;
      left: 0;
      right: 0;
      bottom: 0;
      background-color: #ccc;
      -webkit-transition: .4s;
      transition: .4s;
    }

    .slider:before {
      position: absolute;
      content: "";
      height: 10px;
      width: 10px;
      left: 4px;
      bottom: 3px;
      background-color: white;
      -webkit-transition: .4s;
      transition: .4s;
    }

    input:checked+.slider {
      background-color: #2196F3;
    }

    input:focus+.slider {
      box-shadow: 0 0 1px #2196F3;
    }

    input:checked+.slider:before {
      -webkit-transform: translateX(9px);
      -ms-transform: translateX(9px);
      transform: translateX(9px);
    }

    /* Rounded sliders */
    .slider.round {
      border-radius: 34px;
    }

    .slider.round:before {
      border-radius: 50%;
    }

    .toggel-block {
      display: block !important;
    }

    .toggel-none {
      display: none;
    }
  </style>
  <!-- Page Body Start-->
  <div class="page-body-wrapper">
    <div class="page-body">
      <div class="container-fluid flowid">
        <div class="page-header">
          <div class="row">
            <div class="col">
              <div class="page-header-left">
                <h3>Add Buisiness Categories</h3>

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
                <form class="needs-validation" method="post" action="{{route('admin.add_business_categories')}}" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id" value="">
                  <input type="hidden" id="hid_img" name="hid_img" value="">

                  {{csrf_field()}}
                  <div class="form-row">
                    
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Business Category Name</label>
                      <input class="form-control" id="name" name="name" value="{{old('name')}}" type="text" placeholder="Enter Business Category Name" required="">
                      @error('name')
                    {{$message}}
                @enderror
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


    @endsection
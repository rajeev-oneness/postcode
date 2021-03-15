<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Event Categories</title>

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
                <h3>Add Event Categories</h3>

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
                <form class="needs-validation" method="post" action="{{route('admin.event_categories')}}" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id" value="">
                  <input type="hidden" id="hid_img" name="hid_img" value="">

                  {{csrf_field()}}
                  <div class="form-row">
                    
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Event Name</label>
                      <input class="form-control" id="name" name="name" value="{{old('name')}}" type="text" placeholder="Enter Event Name" required="">
                      @error('name')
                          <span class="text-danger">{{ $message }}</span>
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
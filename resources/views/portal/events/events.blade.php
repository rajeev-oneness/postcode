<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Add Events</title>

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
                <h3>Add Events Details</h3>

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
                <form class="needs-validation" method="post" name="event" action="{{route('admin.add_events')}}" enctype="multipart/form-data" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">Business Category</label>
                        <select id="business_categoryId" name="business_categoryId" class="form-control" required="">
                          <option value="{{old('business_categoryId')}}">Select</option>
                          @foreach($busCateData as $businessName)
                          <option value="{{$businessName->id}}">{{$businessName->name}}</option>
                          @endforeach
                        </select>
                        @error('business_categoryId')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Event Name</label>
                      <input class="form-control" id="name" name="name" value="{{old('name')}}" type="text" placeholder="Business Name" required="">
                      @error('name')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>


                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Contact Details</label>
                      <input class="form-control" id="contact_details" value="{{old('contact_details')}}" name="contact_details" type="text" placeholder="Contact Details" required="">
                      @error('contact_details')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Details</label>
                      <input class="form-control" id="details" name="details" value="{{old('details')}}" type="text" placeholder="Enter Details" required="">
                      @error('details')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Address</label>
                      <input class="form-control" id="address" name="address" value="{{old('address')}}" type="text" placeholder="Kindly Enter" required="">
                      @error('address')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Start Date</label>
                      <div class="input-group">
                              <input class="datepicker-here form-control digits" id="start" name="start" value="{{old('start')}}" type="text" placeholder="Kindly Enter" required="" data-language="en">
                            </div>
                      <!-- <input class="form-control" id="start" name="start" value="{{old('start')}}" type="text" placeholder="Starting Hour" required=""> -->
                      @error('start')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">End Date</label>
                      <div class="input-group">
                              <input class="datepicker-here form-control digits" id="end" name="end" value="{{old('end')}}" placeholder="Closing Hour" required="" type="text" data-language="en">
                            </div>
                            @error('end')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Frequency</label>
                      <input class="form-control" id="frequency" value="{{old('frequency')}}" name="frequency" type="text" placeholder="Enter Frequency" required="">
                      @error('frequency')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom06">Event Category</label>
                        <select id="event_category_id" name="event_category_id" class="form-control" required="">
                          <option value="{{old('event_category_id')}}">Select</option>
                          @foreach($eventCatData as $produData)
                          <option value="{{$produData->id}}">{{$produData->name}}</option>
                          @endforeach
                        </select>
                        @error('event_category_id')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                      </div>
                    </div>

                  </div>
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Booking Details</label>
                      <input class="form-control" id="booking_details" value="{{old('booking_details')}}" name="booking_details" type="text" placeholder="Booking Details" required="">
                      @error('booking_details')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Age Group</label>
                      <input class="form-control" id="age_group" value="{{old('age_group')}}" name="age_group" type="text" placeholder="Provide Age Group" required="">
                      @error('age_group')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Price</label>
                      <input class="form-control" id="price" value="{{old('price')}}" name="price" type="text" placeholder="Enter Price" required="">
                      @error('price')
					<span class="text-danger">{{ $message }}</span>
					@enderror
                    </div>
                  </div>

                  <div class="form-row">


                    <div class="col-md-4 mb-3">
                      <label for="validationCustomUsername">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                        <img src="/uploads/blank_img1.jpg" alt="people" class="evenblck" width="56" id="img-upload">

                        <input class="form-control eventimg"  type="file" id="image" value="" name="image" required="">
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
            $(document).ready(function() {
          // It has the name attribute "registration"
  // $("form[name='event']").validate({
  //   // Specify validation rules
  //   rules: {
  //     // The key name on the left side is the name attribute
  //     // of an input field. Validation rules are defined
  //     // on the right side
  //     event_category_id: "required"

  //   },
  //   // Specify validation error messages
  //   messages: {
  //     event_category_id: "Please enter your firstname"
  //   },
  //   // Make sure the form is submitted to the destination defined
  //   // in the "action" attribute of the form when valid
  //   submitHandler: function(form) {
  //     form.submit();
  //   }
  // });
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
<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Add Offers</title>
  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>


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
                <h3>Add Offers Details</h3>

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
                <form class="needs-validation" method="post" name="offr" action="{{route('admin.add_offers')}}" enctype="multipart/form-data" novalidate="">
                  <input type="hidden" id="hid_id" name="hid_id">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <div class="form-group">
                        <label for="validationCustom05">Business Category</label>
                        <select id="business_categoryId" name="business_categoryId" class="form-control" required="">
                          <option value="{{old('business_categoryId')}}">Select Category</option>
                          @foreach($busCategData as $businessName)
                          <option value="{{$businessName->id}}">{{$businessName->name}}</option>
                          @endforeach
                        </select>
                        @error('business_categoryId')
                        {{$message}}
                        @enderror
                      </div>
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Title</label>
                      <input class="form-control" id="title" name="title" value="{{old('title')}}" type="text" placeholder="Title Required" required="">
                      @error('name')
                      {{$message}}
                      @enderror
                    </div>


                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Short Description</label>
                      <input class="form-control" id="short_description" value="{{old('short_description')}}" name="short_description" type="text" placeholder="Short Description" required="">
                      @error('contact_details')
                      {{$message}}
                      @enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Description</label>
                      <input class="form-control" id="description" name="description" value="{{old('description')}}" type="text" placeholder="Description" required="">
                      @error('details')
                      {{$message}}
                      @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Promo Code</label>
                      <input class="form-control" id="promo_code" name="promo_code" value="{{old('promo_code')}}" type="text" placeholder="Promo Code" required="">
                      @error('address')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Price</label>
                      <div class="input-group">
                      <input class="form-control" id="price" name="price" value="{{old('price')}}" type="text" placeholder="Enter Promo Code" required="">
                            </div>
                      @error('start')
                      {{$message}}
                      @enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="validationCustom05">Expire Date</label>
                      <div class="input-group">
                              <input class="datepicker-here form-control digits" id="expire_date" name="expire_date" value="{{old('expire_date')}}" placeholder="Expire Date" required="" type="text" data-language="en">
                            </div>                 
                      @error('expire_date')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationCustomUsername">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                        <img src="/uploads/blank_img1.jpg" alt="people" class="offrlck" width="56" id="img-upload">
                          <input class="form-control offrimg" type="file" id="image" value="{{old('image')}}" name="image" required="">
                          @error('image')
                          {{$message}}
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom05">How to Redeem</label>
                      <textarea class="form-control editor" name="content" required=""></textarea>
                       @error('howcanredeem')
                      {{$message}}
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

      var editor1 = CKEDITOR.replace('content', {
      extraAllowedContent: 'div(*);h3(*);img(*);h1(*);button(*);h2(*);h4(*);ul(*);a(*);section(*);li(*);span(*);p(*)',
      height: 400,
      filebrowserUploadUrl: "{{route('ckeditor.upload', ['_token' => csrf_token() ])}}",
      filebrowserUploadMethod: 'form'
    
    });
    editor1.on('instanceReady', function() {
      // Output self-closing tags the HTML4 way, like <br>.
      this.dataProcessor.writer.selfClosingEnd = '>';

      // Use line breaks for block elements, tables, and lists.
      var dtd = CKEDITOR.dtd;
      for (var e in CKEDITOR.tools.extend({}, dtd.$nonBodyContent, dtd.$block, dtd.$listItem, dtd.$tableContent)) {
        this.dataProcessor.writer.setRules(e, {
          indent: true,
          breakBeforeOpen: true,
          breakAfterOpen: true,
          breakBeforeClose: true,
          breakAfterClose: true
        });
      }
      // Start in source mode.
      //this.setMode('source');
    });
      
        </script>
      

    @endsection
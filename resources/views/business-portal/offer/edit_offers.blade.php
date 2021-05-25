<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Business-Admin | Edit Offers</title>
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
                <h3>Edit Offers Details</h3>

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
                <form class="needs-validation" method="post" name="offr" action="{{route('business-admin.update_offers')}}" enctype="multipart/form-data">
                  <input type="hidden" id="hid_id" name="hid_id" value="{{$editedoffers_data->id}}">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Title</label>
                      <input class="form-control" id="title" name="title" value="{{$editedoffers_data->title}}" type="text" placeholder="Title Required" required="">
                      @error('title')
                      {{$message}}
                      @enderror
                    </div>


                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Short Description</label>
                      <input class="form-control" id="short_description" value="{{$editedoffers_data->short_description}}" name="short_description" type="text" placeholder="Short Description" required="">
                      @error('short_description')
                      {{$message}}
                      @enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Description</label>
                      <input class="form-control" id="description" name="description" value="{{$editedoffers_data->description}}" type="text" placeholder="Description" required="">
                      @error('description')
                      {{$message}}
                      @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Promo Code</label>
                      <input class="form-control" id="promo_code" name="promo_code" value="{{$editedoffers_data->promo_code}}" type="text" placeholder="Promo Code" required="">
                      @error('promo_code')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Price</label>
                      <div class="input-group">
                      <input class="form-control" id="price" name="price" value="{{$editedoffers_data->price}}" type="price" onkeypress="return inputNumeric(event)" placeholder="Enter Price" required="">
                            </div>
                      @error('price')
                      {{$message}}
                      @enderror
                    </div>

                  </div>

                  <div class="form-row">
                    <div class="col-md-3 mb-3">
                      <label for="validationCustom05">Expire Date</label>
                      <div class="input-group">
                              <input class="datepicker-here form-control digits" id="expire_date" name="expire_date" value="{{$editedoffers_data->expire_date}}" placeholder="Expire Date" required="" type="text" onkeypress="return false;" data-language="en">
                            </div>                 
                      @error('expire_date')
                      {{$message}}
                      @enderror
                    </div>
                    <div class="col-md-3 mb-3">
                      <label for="validationCustomUsername">Image</label>
                      <div class="d-flex justify-content-center">
                        <div class="btn btn-mdb-color btn-rounded">
                        <img src="{{url($editedoffers_data->image)}}" alt="people" class="offrlck" width="56" id="img-upload">
                          <input class="form-control offrimg" type="file" id="image" value="" name="image">
                          @error('image')
                          {{$message}}
                          @enderror
                        </div>
                      </div>
                    </div>
                    <div class="col-md-6 mb-3">
                      <label for="validationCustom05">How to Redeem</label>
                      <textarea class="form-control editor" name="content" value="{{$editedoffers_data->howcanredeem}}" required=""></textarea>
                       @error('content')
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
      <script>
        function inputNumeric(event) {
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
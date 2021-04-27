<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Business-Admin | Edit Response</title>
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
                <h3>Reply
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
                <form class="needs-validation" method="post" action="{{route('store-response')}}">
                  
                  {{csrf_field()}}

                  <input type="hidden" name="rating_id" value="{{$rating->id}}">
                  <input type="hidden" name="business_id" value="{{$rating->business_id}}">
                  <input type="hidden" name="user_id" value="{{$rating->userId}}">

                  <div class="form-row">
                    
                    <div class="col-md-12 mb-3">
                      <label for="validationCustom05">Rating</label>
                      <textarea name="rating" class="form-control" cols="30" rows="10">{{$rating->description}}</textarea>
                    </div>

                    <div class="col-md-12 mb-3">
                        <label for="validationCustom05">Your Response</label>
                        <textarea name="response" class="form-control" cols="30" rows="10">{{(!empty($response)) ? $response[0]['response'] : ''}}</textarea>
                    </div>

                  </div>

                  <button class="btn btn-primary" id="submit_business" type="submit">Submit</button>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>

      <script>
        // function inputNumeric(event) {
        //   if(event.charCode >= 48 && event.charCode <= 57) {
        //     return true;
        //   }
        //   return false;
        // }
  
          $("form").submit(function() {
              $(this).submit(function() {
                  return false;
              });
              return true;
          });
      </script>

    @endsection
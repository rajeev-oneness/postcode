<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Add Moderator</title>
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
                <h3>Add Moderator Details</h3>

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
                <form class="needs-validation" method="post" name="offr" action="{{route('admin.moderator.store')}}">
                  {{csrf_field()}}
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{ old('name') }}" placeholder="Enter Name" maxlength="255" required>
                      @error('name')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Email</label>
                      <input class="form-control" id="email" name="email" type="email" value="{{ old('email') }}" placeholder="Enter Email" maxlength="255" required>
                      @error('email')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>

                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Password</label>
                      <input class="form-control" id="password" name="password" type="password" placeholder="Enter password" required>
                      @error('password')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Confirm Password</label>
                      <input class="form-control" id="password_confirmation" name="password_confirmation" type="password" placeholder="Confirm password" required>
                      @error('password_confirmation')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
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
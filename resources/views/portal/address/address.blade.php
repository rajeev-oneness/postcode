<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Manage Address</title>
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
                <h3>Manage Address Details</h3>

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
                <form class="needs-validation" method="post" action="{{route('admin.update.address')}}" enctype="multipart/form-data" novalidate="">

                    @csrf
                    <input type="hidden" name="contact_id" value="{{encrypt($address[0]->id)}}">
                  <div class="form-row">
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{$address[0]->name}}" placeholder="Company Name" required>
                      @error('name')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Email</label>
                      <input class="form-control" id="email" name="email" type="email" value="{{$address[0]->email}}" placeholder="Company Email" required>
                      @error('email')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-4 mb-3">
                      <label for="validationCustom05">Mobile</label>
                      <input class="form-control" id="mobile" name="mobile" type="number" value="{{$address[0]->mobile}}" placeholder="Company Mobile" required>
                      @error('mobile')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                    <div class="col-md-8 mb-3">
                      <label for="validationCustom05">Address</label>
                      <textarea name="address" class="form-control" id="address" cols="30" rows="2" placeholder="Company Address" required>{{$address[0]->address}}</textarea>
                      @error('address')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                  </div>

                  <button class="btn btn-primary" id="submit_business" name="submit_business" type="submit">Change</button>
                </form>
              </div>
            </div>


          </div>
        </div>
      </div>
      <!-- Container-fluid Ends-->
    </div>
      

    @endsection
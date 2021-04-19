<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Manage About us</title>
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
                <h3>Manage About Us</h3>

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
                <form class="needs-validation" method="post" action="{{route('admin.update.about-us')}}" enctype="multipart/form-data" novalidate="">

                    @csrf
                    <input type="hidden" name="about_id" value="{{encrypt($data->id)}}">
                  <div class="form-row">
                    
                    <div class="col-md-12 mb-3">
                      <label for="validationCustom05">Short Description</label>
                      <textarea name="short_description" class="form-control" id="short_description" cols="30" rows="5" placeholder="Short Description..." required>{{$data->short_description}}</textarea>
                      @error('short_description')
                        <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>

                    <div class="col-md-12 mb-3">
                      <label for="validationCustom05">Description</label>
                      <textarea name="description" class="form-control" id="description" cols="30" rows="7" placeholder="About Us..." required>{{$data->description}}</textarea>
                      @error('description')
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
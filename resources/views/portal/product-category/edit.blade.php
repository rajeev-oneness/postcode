<!DOCTYPE html>
<html lang="en">


<head>

  <meta charset="utf-8" />
  <title>Admin | Add Product Category</title>
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
                <h3>Add Product Category</h3>

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
                <form class="needs-validation" method="post" name="offr" action="{{route('product.category.update')}}">
                  {{csrf_field()}}
                  <input type="hidden" name="category_id" value="{{encrypt($category->id)}}">
                  <div class="form-row">
                    <div class="col-md-6 mb-3">
                    <label for="validationCustom05">Category Name</label>
                      <input class="form-control" id="name" name="name" type="text" value="{{$category->name}}" placeholder="Enter Product Category Name" required>
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


    @endsection
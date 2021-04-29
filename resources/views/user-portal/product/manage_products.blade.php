<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | Manage Products</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
               <!-- start page title -->
               <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Manage Products</h4>
                        </div>
                    </div>
                </div>
                <!-- end page title -->
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <!-- Zero Configuration  Starts-->
              <div class="col-sm-12">
                <div class="card">
                {{csrf_field()}}
                  <div class="card-body">
                    <div class="float-right mb-2"><a class="btn btn-primary" href="{{route('user.marketplace.product')}}"><i class="fas fa-plus"></i>Add Product</a></div>
                    <div class="table-responsive">
                      <table class="table table-hover" id="subject_manage">
                        <thead>
                          <tr>
                            <th>Sl. </th>
                            <th>Name</th>
                            <th>Category</th>
                            <th>Subcategory</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th width="40px;">Image</th>                       
                            <th>Action</th>
                          </tr>
                        </thead>            
                        <tbody>
                          @php
                              $i = 1
                          @endphp
                          @foreach ($products as $product)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$product->name}}</td>
                              <td>{{$product->category->name}}</td>
                              <td>{{$product->subcategory->name}}</td>
                              <td>{{$product->details}}</td>
                              <td>{{$product->price}}</td>
                              <td><img src='{{url($product->image)}}' style='width: 40%;'></td>
                              <td>
                                <a class="edit_product" href="{{route('user.marketplace.edit_product', ['id' => encrypt($product->id)])}}"><i class="fa fa-edit"></i></a>
                                <a class="delete_app" onclick="return confirm('Are you sure?')" href="{{route('user.marketplace.delete_product', ['id' => encrypt($product->id)])}}"><i class="fa fa-trash"></i></a>
                              </td>
                            </tr>
                          @endforeach
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
              
          <!-- Container-fluid Ends-->
        </div>

        @endsection
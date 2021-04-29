<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Product sub-categories</title>

    @extends('portal.layouts.master')
    @section('content')
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
               <!-- start page title -->
               <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Manage Product Sub-categories</h4>
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
                    <div class="table-responsive">
                      <table class="app_table" id="subject_manage">
                        <thead>
                          <tr>
                            <th width="163px;">Sl.</th>
                            <th>Category</th>
                            <th>Sub Category</th>                     
                            <th>Action</th>
                          </tr>
                        </thead>            
                        <tbody>
                          @php
                              $i = 1
                          @endphp
                          @foreach ($subcategories as $subcategory)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$subcategory->category->name}}</td>
                              <td>{{$subcategory->name}}</td>
                              <td>
                                <a class="edit_product" href="{{route('product.subcategory.edit', encrypt($subcategory->id))}}" id="}}"><i class="fa fa-edit"></i></a>
                                <a class="delete_app" onclick="return confirm('Are you sure?')" href="{{route('product.subcategory.delete', ['id' => encrypt($subcategory->id)])}}"><i class="fa fa-trash"></i></a>
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
        <script>
          $(document).ready(function (){
            $('.app_table').DataTable({
              'order':[]
            });
          });
        </script>

        @endsection
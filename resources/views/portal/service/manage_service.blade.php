<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Services</title>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/1.10.23/css/jquery.dataTables.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
<script type="text/javascript" charset="utf8" src="https://cdn.datatables.net/1.10.23/js/jquery.dataTables.js"></script>


    @extends('portal.layouts.master')
    @section('content')
    <style>
    .fa-trash {
        margin-left: 25px;
    }
    </style>
    <!-- Right sidebar Ends-->
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Manage Services</h4>
                            <!-- <div class="page-title-right">
                                <a href="/admin/add_subjects" <button type="button" id="submit_product" name="submit_product" class="btn btn-primary w-md">Add Subjects</button></a>
                            </div> -->
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
                            <table class="app_table">
                                    <thead>
                                        <tr>
                                           
                                            <th>Name</th>
                                            <th>Details</th>
                                            <th>Price</th>
                                            <th>Image</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
  @foreach ($service_manage as $service_manage_dt)
    <tr>
    
    <td>{{$service_manage_dt->name}}</td>
    <td>{{$service_manage_dt->details}}</td>
    <td>{{$service_manage_dt->price}}</td>
<td><img src='/{{ $service_manage_dt->image }}' style='width: 40%;'></td>
<td><a class="edit_app" id="{{$service_manage_dt->id}}"><i class="fa fa-edit"></i></a><a class="delete_app" id="{{$service_manage_dt->id}}"><i class="fa fa-trash"></i></a></td>
  </tr>
@endforeach
</tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- Zero Configuration  Ends-->


            </div>
           
            <script>
               $(document).ready(function (){
                $('.app_table').DataTable({
      'order':[]
    });
    $(".edit_app").click(function(){
        alert('hi');
var app_id=this.id;
       var fd = {'app_id': app_id,'_token':$('input[name="_token"]').val()};
			redirectPost('edit_services', fd);
    });
    $(".delete_app").click(function(){
       
var appdel_id=this.id;
       var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
			redirectPost('delete_services', fd);
    });
               });
               var redirectPost = function (url, data = null, method = 'post') {
                    var form = document.createElement('form');
                    form.method = method;
                    form.action = url;
                    for (var name in data) {
                        var input = document.createElement('input');
                        input.type = 'hidden';
                        input.name = name;
                        input.value = data[name];
                        form.appendChild(input);
                    }
                    $('body').append(form);
                    form.submit();
                }
            </script>



            @endsection
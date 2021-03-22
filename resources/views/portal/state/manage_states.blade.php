<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage State</title>
    

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
                            <h4 class="mb-0 font-size-18">Manage State</h4>
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
                                            <th>State Name</th>                                         
                                            <th>State Code</th>                       
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
  @foreach ($categories as $statecategories)
    <tr>
    <td>{{$statecategories->name}}</td>
    <td>{{$statecategories->code}}</td>
  

<td><a class="edit_states" href="{{route('edit_states', encrypt($statecategories->id))}}" id=""><i class="fa fa-edit"></i></a><a class="delete_states" id="{{$statecategories->id}}"><i class="fa fa-trash"></i></a></td>
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
//     $(".edit_states").click(function(){
        
// var app_id=this.id;
//        var fd = {'app_id': app_id,'_token':$('input[name="_token"]').val()};
// 			redirectPost('edit_states', fd);
//     });
    $(".delete_states").click(function(){
       
var appdel_id=this.id;
       var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
			redirectPost('delete_states', fd);
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
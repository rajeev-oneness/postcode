<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Events</title>
    

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
                            <h4 class="mb-0 font-size-18">Manage Events</h4>
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
                                            <th>Sl.</th>
                                            <th>Name</th>
                                            <th>Event Category</th>
                                            <th width="1px;">Image</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($categories1 as $key => $categories2)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$categories2->name}}</td>
                                                <td>{{$categories2->eventcattype->name}}</td>
                                                
                                            
                                                <td><img src='{{url($categories2->image)}}' style='width: 40%;'></td>
                                                <td>
                                                    <a class="edit_event" href="{{route('admin.edit_event', encrypt($categories2->id))}}"  id=""><i class="fa fa-edit"></i></a>
                                                    <a class="delete_app" id="{{$categories2->id}}"><i class="fa fa-trash"></i></a>
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


            </div>
           
            <script>
                $(document).ready(function (){
                    $('.app_table').DataTable({
                        'order':[]
                    });
                    $(".delete_app").click(function(){
                        if(confirm('Are you sure?')){
                            var appdel_id=this.id;
                            var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
                            redirectPost("{{route('admin.delete_events')}}", fd);
                        }
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
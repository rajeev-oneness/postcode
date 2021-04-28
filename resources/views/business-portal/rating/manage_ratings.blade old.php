<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Manage Ratings</title>
    

    @extends('business-portal.layouts.master')
    @section('content')
   
    <!-- Right sidebar Ends-->
    <div class="page-body">
        <div class="container-fluid">
            <div class="page-header">
                <!-- start page title -->
                <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Manage Ratings</h4>
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
                            <table class="table table-hover">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th style="max-width: 65%;">Review</th>
                                            <th>User Name</th>
                                            <th>Stars</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @php
                                            $i = 1;
                                        @endphp
                                    @foreach ($ratings as $rating)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$rating->description}} <br><strong> Reply : </strong><br>
                                                @if (!empty($rating->response))
                                                    {{$rating->response->response}}
                                                @endif
                                            </td>
                                            <td>{{$rating->user->name}}</td>
                                            <td>{{$rating->rating}} stars</td>
                                        
                                            <td><a class="edit_event" title="Reply to rating" href="{{route('add-response', ['id' => encrypt($rating->id)])}}" id=""><i class="fa fa-comment"></i></a><a class="delete_app ml-2" title="Delete rating" id="{{$rating->id}}"><i class="fa fa-trash"></i></a></td>
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
                
                $(".delete_app").click(function(){
                    if(confirm('Are you sure?')) {
                        var appdel_id=this.id;
                        var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
                        redirectPost('delete_ratings', fd);
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
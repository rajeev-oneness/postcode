<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Communities</title>

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
                            <h4 class="mb-0 font-size-18">Manage Communities</h4>
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
                      <table class="app_table" id="subject_manage">
                        <thead>
                          <tr>
                            <th>Sl.</th>
                            <th>Question</th>
                            <th>Answer</th>                       
                            <th>Action</th>
                          </tr>
                        </thead>            
                        <tbody>
                          @php
                              $i = 1;
                          @endphp
                          @foreach ($community as $com)
                            <tr>
                              <td>{{$i++}}</td>
                              <td>{{$com->question}}</td>
                              <td>{{$com->answer}}</td>
                              <td>
                                <a class="edit_product" href="#" id=""><i class="fa fa-edit"></i></a>
                                <a class="delete_app" id="#" onclick="return confirm('Are you sure?')" href="#"><i class="fa fa-trash"></i></a>
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
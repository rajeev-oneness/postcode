<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Business Profiles</title>

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
                            <h4 class="mb-0 font-size-18">Manage Businesses</h4>
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
                                <table class="app_table" id="businessprofile_mnanage">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Business Category</th>
                                            <th width="160px">Name</th>
                                            <th width="90px;">Address</th>
                                            <th>Email</th>
                                            <th>Mobile</th>
                                            <th>ABN</th>
                                            <th>Action</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        @foreach ($businesses as $key => $item)
                                            <tr>
                                                <td>{{$key+1}}</td>
                                                <td>{{$item->businesstype->name}}</td>
                                                <td>{{$item->name}}</td>
                                                <td>{{$item->address}}</td>
                                                <td>{{$item->email}}</td>
                                                <td>{{$item->mobile}}</td>
                                                <td>{{$item->abn}}</td>
                                                <td>
                                                    <a class="edit_product" href="{{route('admin.edit_businessprofile',encrypt($item->id))}}"><i class="fa fa-edit"></i></a>
                                                    <a class="delete_app" onclick="return confirm('Are you sure?')" href="{{route('admin.delete_businessprofiles',encrypt($item->id))}}"><i class="fa fa-trash"></i></a>
                                                </td>
                                            </tr>
                                        @endforeach
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>

            <script>
                $(document).ready(function (){
                  $('.app_table').DataTable({
                    'order':[]
                  });
                });
            </script>
    @endsection

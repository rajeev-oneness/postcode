<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Manage Products</title>

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
                            <h4 class="mb-0 font-size-18">Manage Products</h4>
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
                    <div class="float-right mb-2"><a class="btn btn-primary" href="{{route('business-admin.product')}}"><i class="fas fa-plus"></i>Add Product</a></div>
                    <div class="table-responsive">
                      <table class="table table-hover" id="subject_manage">
                        <thead>
                          <tr>
                            <th width="163px;">Business Category</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th width="40px;">Image</th>                       
                            <th>Action</th>
                          </tr>
                        </thead>            
                        <tbody>
                          @foreach ($categories as $offercategories)
                            <tr>
                              <td>{{$offercategories->businesscategory->name}}</td>
                              <td>{{$offercategories->name}}</td>
                              <td>{{$offercategories->details}}</td>
                              <td>{{$offercategories->price}}</td>
                              <td><img src='{{url($offercategories->image)}}' style='width: 40%;'></td>
                              <td>
                                <a class="edit_product" href="{{route('edit_product', encrypt($offercategories->id))}}" id="}}"><i class="fa fa-edit"></i></a>
                                <a class="delete_app ml-2" onclick="return confirm('Are you sure?')" href="{{route('admin.delete_product', ['id' => encrypt($offercategories->id)])}}"><i class="fa fa-trash"></i></a>
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
//     $(".edit_product").click(function(){
        
// var app_id=this.id;
//        var fd = {'app_id': app_id,'_token':$('input[name="_token"]').val()};
// 			redirectPost('edit_product', fd);
//     });
    // function deleteProduct() {
    //   alert('delete');
    // }
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
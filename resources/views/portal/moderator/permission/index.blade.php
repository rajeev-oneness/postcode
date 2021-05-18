<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Permissions</title>

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
                            <h4 class="mb-0 font-size-18">Manage Permissions</h4>
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
                    <form action="{{route('admin.moderator.grant.permission')}}" method="post">
                        @csrf
                        <input type="hidden" name="userId" value="{{$userId}}">
                        <div class="table-responsive">
                            <table class="table table-hover">
                                <thead>
                                    <tr>
                                        <th scope="col">#</th>
                                        <th scope="col">Permission</th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                        <th scope="col"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    @foreach ($permissions as $key => $permission)
                                    <input type="hidden" name="permissionId[]" value="{{$permission->id}}">
                                    <tr>
                                        <th scope="row">{{$key+1}}</th>
                                        <td>{{$permission->permission_details->name}}</td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="defaultCheck1" {{($permission->add == 1)? 'checked' : ''}}>
                                                <input type="hidden" name="{{$permission->permission_details->id}}_add[]" class="hiddenvalue" value="{{$permission->add}}">
                                                <label class="form-check-label" for="defaultCheck1">
                                                  Add
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="defaultCheck2" {{($permission->edit == 1)? 'checked' : ''}}>
                                                <input type="hidden" name="{{$permission->permission_details->id}}_edit[]" class="hiddenvalue" value="{{$permission->edit}}">
                                                <label class="form-check-label" for="defaultCheck2">
                                                  Edit
                                                </label>
                                            </div>
                                        </td>
                                        <td>
                                            <div class="form-check">
                                                <input class="form-check-input" type="checkbox"  id="defaultCheck3" {{($permission->delete == 1)? 'checked' : ''}}>
                                                <input type="hidden" name="{{$permission->permission_details->id}}_delete[]" class="hiddenvalue" value="{{$permission->delete}}">
                                                <label class="form-check-label" for="defaultCheck3">
                                                  Delete
                                                </label>
                                            </div>
                                        </td>
                                    </tr>
                                    @endforeach
                                    <tr>
                                        <td colspan="5" class="text-right">
                                            <button type="submit" class="btn btn-primary">Update Permission</button>
                                        </td>
                                    </tr>
                                </tbody>
                            </table>
                        </div>
                    </form>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
              
          <!-- Container-fluid Ends-->
        </div>
        <script>
            $(document).on('click','.form-check-input',function(){
                var thisCheckbox = $(this);
                var inputValue = 0;
                if (thisCheckbox.prop('checked')==true){
                    inputValue = 1;
                }
                thisCheckbox.closest('td').find('.hiddenvalue').val(inputValue);
            });
        </script>
        @endsection
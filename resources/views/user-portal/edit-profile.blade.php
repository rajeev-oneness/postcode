<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | Settings</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Settings</h3>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-8 xl-100">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div>
                            <div class="row border border-secondary rounded m-2">
                                <div class="p-3 col-8">
                                    <form action="{{route('user.update')}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <label for="name">Name</label>
                                            <input type="text" class="form-control" name="name" id="name" value="{{$user->name}}">
                                        </div>
                                        <div class="form-group">
                                            <label for="address">Address</label>
                                            <textarea name="address" class="form-control" id="address" cols="30" rows="3">{{$user->address}}</textarea>
                                        </div>
                                        <div class="form-group">
                                            <label for="postcode">Post Code</label>
                                            <input type="number" class="form-control" name="postcode" id="postcode" value="{{$user->postcode}}" max="9999">
                                        </div>
                                        <button type="submit" class="btn btn-primary">Update Profile</button>
                                    </form>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
             </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection
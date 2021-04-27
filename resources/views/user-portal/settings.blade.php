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
              <div class="col-xl-12 xl-100">
                <div class="row">
                    <div class="col-12 mt-5">
                        <div>
                            <div class="row border border-secondary rounded m-2">
                                <div class="p-3 col-8">
                                    <h5>{{$user->name}}</h5>
                                    <p><strong>Email : </strong>{{$user->email}}</p>
                                    <p><strong>Address : </strong>{{$user->address}}</p>
                                    <p><strong>Postcode : </strong>{{$user->postcode}}</p>
                                </div>
                                <div class="p-3 col-4">
                                    <a href="{{route('user.edit')}}" class="btn btn-primary">Edit Profile</a>
                                </div>
                            </div>
                        </div>

                        <div class="mt-5 col-6">
                            <h4>Account privacy</h4>
                            <hr>
                            <form action="{{route('update.privacy')}}" method="post">
                                @csrf
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="is_private" id="flexRadioDefault1" value="0" {{($user->is_private == 0)? 'checked' : ''}}>
                                  <label class="form-check-label" for="flexRadioDefault1">
                                    Public
                                  </label>
                                </div>
                                <div class="form-check">
                                  <input class="form-check-input" type="radio" name="is_private" id="flexRadioDefault2" value="1" {{($user->is_private == 1)? 'checked' : ''}}>
                                  <label class="form-check-label" for="flexRadioDefault2">
                                    Private
                                  </label>
                                </div>
                                <br>
                                <button type="submit" class="btn btn-primary">Update Privacy</button>
                            </form>
                        </div>
                    </div>
                </div>
             </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection
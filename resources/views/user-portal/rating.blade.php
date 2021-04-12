<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | Rating</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Rating</h3>
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
                        <h4>Your ratings</h4>
                        <hr>
                        <div class="mt-3">
                          @foreach ($ratings as $rating)
                              <div class="border border-secondary rounded m-2">
                                <div class="p-3">
                                  <p>{{$rating['description']}}</p>
                                  <strong>To - <a href="{{route('details',['name' => 'business', 'id' => $rating['business'][0]['id']])}}">{{$rating['business'][0]['name']}}</a></strong>
                                </div>
                              </div>
                          @endforeach
                        </div>
                    </div>
                </div>
              </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection
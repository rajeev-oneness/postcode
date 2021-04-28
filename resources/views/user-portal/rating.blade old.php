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
              <div class="col-xl-12 xl-100">
                <div class="row">
                    <div class="col-12 mt-5">
                        <h4>Your ratings</h4>
                        <hr>
                        <div class="mt-3">
                          @foreach ($ratings as $rating)
                              <div class="row border border-secondary rounded m-2">
                                <div class="col-9 p-3">
                                  <strong>{{$rating['rating']}} stars</strong>
                                  <p>{{$rating['description']}}</p>
                                  <strong>To - <a href="{{route('details',['name' => 'business', 'id' => $rating['business'][0]['id']])}}">{{$rating['business'][0]['name']}}</a></strong><br>
                                  @if (!empty($rating['response']))
                                  <strong>Reply : </strong> {{$rating['response']['response']}}
                                  @else
                                  <strong>No Reply.</strong>
                                  @endif
                                </div>
                                <div class="col-3 p-3">
                                  <a href="{{route('user.rating.edit', ['id' => encrypt($rating['id'])])}}" class="btn btn-primary"> <i class="fa fa-pencil"></i> Edit </a>
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
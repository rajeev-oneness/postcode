<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | Messaging</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Messagings</h3>
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
                    <div class="col-12">
                        <button class="btn btn-primary" data-toggle="modal" data-target="#exampleModalCenter">Send Private Message</button>
                        <hr>
                        <div class="mt-3">
                            <h4>Sent Messages</h4>
                          @foreach ($messages as $message)
                              <div class="border border-secondary rounded m-2">
                                <div class="p-3">
                                  Subject - {{$message['subject']}}
                                  <p>{{$message['message']}}</p>
                                  <strong>To - <a href="{{route('details',['name' => 'business', 'id' => $message['business']['id']])}}">{{$message['business']['name']}}</a></strong>
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
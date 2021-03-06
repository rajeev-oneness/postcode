<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Manage Events</title>
    

@extends('business-portal.layouts.master')

@section('modal')
<!-- Modal -->
<div class="modal fade" id="eventModal" tabindex="-1" role="dialog" aria-labelledby="eventModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
      <div class="modal-content">
          <div class="modal-header">
              <h5 class="modal-title" id="eventModalLabel">CSV Upload</h5>
              <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                  <span aria-hidden="true">&times;</span>
              </button>
          </div>
          <div class="modal-body">
            <form class="needs-validation" method="post" action="{{route('business-admin.event.store.csv')}}" enctype="multipart/form-data">
              <input type="hidden" id="hid_id" name="hid_id">
              {{csrf_field()}}
              <div class="form-row">
                <div class="mb-3">
                  <a href="{{route('download.csv', 'event')}}" class="btn btn-primary" ><i class="fas fa-file-csv"></i> Download Sample CSV</a>
                  <a href="{{route('download.event.category.csv')}}" class="btn btn-primary" ><i class="fas fa-file-csv"></i> Download Event Category List</a>
                </div>
                <div class="mb-3">
                  <label for="validationCustomUsername">Upload CSV</label>
                  <div class="d-flex justify-content-center">
                    <div class="btn btn-mdb-color btn-rounded">
                      <input class="form-control offrimg" type="file" id="event_csv" name="event_csv" required="">
                      @error('event_csv')
                      <span class="text-danger">{{ $message }}</span>
                      @enderror
                    </div>
                  </div>
                </div>

              </div>
            
          </div>
          <div class="modal-footer">
              <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
              <button type="submit" class="btn btn-primary">Upload</button>
            </form>
          </div>
      </div>
  </div>
</div>    
@endsection

@section('content')
<div class="row m-1">
    <div class="mb-3"><a class="btn btn-primary" href="{{route('business-admin.events')}}"><i class="fas fa-plus"></i>Add Event</a></div>
    <div class="mb-3 ml-3"><a class="btn btn-primary" role="button" href="javascript:void(0);" data-toggle="modal" data-target="#eventModal"><i class="fas fa-file-csv"></i> Upload CSV</a></div>
</div>
<div class="row m-0">
    @if (count($categories1) == 0)
        <div class="col-12">
            <h1 class="text-center">No Events</h1>
        </div>
    @else
    @foreach ($categories1 as $categories2)
    <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3 pl-md-0">
        <div class="card">
        {{csrf_field()}}
          <div class="position-relative">
            <img src="{{url($categories2->image)}}" class="card-img-top" alt="Events">
            <div class="img-retting">
              <ul>
                <li><img src="{{asset('business_user_asset/images/event-star.png')}}"> <span>4.5</span> (60 reviews)</li>
                <li>|</li>
                <li><i class="far fa-comment-dots"></i> 40 Comments</li>
              </ul>
            </div>
          </div>
          <div class="card-body event-body">
            <div class="row m-0 col-12 p-0">
              <div class="col-8 col-md-8 p-0">
                <h5 class="card-title">{{$categories2->name}}
                  <span class="d-block" style="white-space: pre-line;"><i class="fas fa-map-marker-alt"></i> {{$categories2->address}}</span>
                  <span class="d-block"><i class="fas fa-calendar-alt"></i> {{date("d M'y", strtotime($categories2->start))}} - {{date("d M'y", strtotime($categories2->end))}} </span>
                </h5>
                <div class="card-border"></div>
              </div>
              <div class="col-4 col-md-4 p-0 categ-text">
                <div class="bg-orange text-center">
                  <img src="{{asset('business_user_asset/images/cat-gov.png')}}" class="pt-2">
                  <p>{{$categories2->eventcattype->name}}</p>
                </div>
              </div>
            </div>
            <p class="card-text">{{$categories2->short_description}}</p>
            <a class="edit_event" href="{{route('edit_event', encrypt($categories2->id))}}"  id=""><i class="fa fa-edit"></i></a>
            <a class="delete_app ml-2" id="{{$categories2->id}}"><i class="fa fa-trash"></i></a>
            <a href="{{route('details',['name' => 'event', 'id' => $categories2->id])}}" class="float-right text-dark"><i class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </div>
    @endforeach
    @endif
</div>
<div class="row m-0">
    <nav aria-label="Page navigation example">
      {{$categories1->links()}}
    </nav>
</div>

<script>
$(document).ready(function (){
    $(".delete_app").click(function(){
        if(confirm('Are you sure?')){
        var appdel_id=this.id;
        var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
        redirectPost('delete_events', fd);
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
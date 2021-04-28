<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Manage Ratings</title>
    

@extends('business-portal.layouts.master')
@section('content')
<div class="row m-0">
    @if (count($ratings) == 0)
        <div class="col-12">
            <h1 class="text-center">No Reviews</h1>
        </div>
    @else
    @foreach ($ratings as $rating)
    <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3 pl-md-0">
        <div class="card review-card active">
          <div class="card-body event-body">
            <div class="row m-0 col-12 p-0 ">
              <div class="col-4 col-md-3 p-0 text-center">
                <div  class="user-pic-rev">
                  <img src="{{asset('business_user_asset/images/rev-pic.png')}}">
                </div>
              </div>
              <div class="col-8 col-md-9 p-0">
                <h5 class="card-title text-white">{{$rating->user->name}}</h5>
                <h6 class="card-subtitle mb-2 star-color">
                    @for ($i = 0; $i < $rating->rating; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </h6>
              </div>
            </div>
            <p class="card-text text-white">
                {{$rating->description}} <br><br>
                @if (!empty($rating->response))
                    <strong>Reply:</strong> {{$rating->response->response}}
                @else
                    <strong>No Reply!</strong>
                @endif
            </p>
            <div class="row m-0">
                <div class="col-6 text-left">
                    <a class="edit_event" title="Reply to rating" href="{{route('add-response', ['id' => encrypt($rating->id)])}}" id=""><i class="fa fa-comment text-white"></i></a>
                    <a class="delete_app ml-2" title="Delete rating" id="{{$rating->id}}"><i class="fa fa-trash text-white"></i></a>
                </div>
                <div class="col-6 text-right">
                    <img src="{{asset('business_user_asset/images/quote-rev.png')}}">
                </div>
            </div>
          </div>
        </div>
      </div>
    @endforeach
    @endif
</div>
<script>
    $(document).ready(function (){
        
        $(".delete_app").click(function(){
            if(confirm('Are you sure?')) {
                var appdel_id=this.id;
                var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
                redirectPost('delete_ratings', fd);
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
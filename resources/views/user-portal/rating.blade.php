<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | Rating</title>

    @extends('user-portal.layouts.master')
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
            <div class="row m-0 p-0 ">
              <div class="col-4 col-md-3 p-0 text-center">
                <div  class="user-pic-rev">
                  <img src="{{asset('business_user_asset/images/rev-pic.png')}}">
                </div>
              </div>
              <div class="col-8 col-md-9 p-0">
                <h5 class="card-title text-white">{{auth()->user()->name}}</h5>
                <h6 class="card-subtitle mb-2 star-color">
                    @for ($i = 0; $i < $rating['rating']; $i++)
                        <i class="fas fa-star"></i>
                    @endfor
                </h6>
              </div>
            </div>
            <p class="card-text text-white">
                {{$rating['description']}} <br><br>
                <strong>To - <a href="{{route('details',['name' => 'business', 'id' => $rating['business'][0]['id']])}}">{{$rating['business'][0]['name']}}</a></strong><br><br>
                @if (!empty($rating['response']))
                    <strong>Reply:</strong> {{$rating['response']['response']}}
                @else
                    <strong>No Reply!</strong>
                @endif
            </p>
            <div class="row m-0">
                <div class="col-6 text-left">
                    <a href="{{route('user.rating.edit', ['id' => encrypt($rating['id'])])}}" class="btn btn-primary"> <i class="fa fa-pencil"></i> Edit </a>
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
@endsection
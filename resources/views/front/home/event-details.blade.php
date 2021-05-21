@extends('front.home.details-master')

@section('brd_name')
<li><a href="{{route('events')}}">Events</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Event Detail</a></li>
@endsection

@section('details-content')
<div class="row">
    <h2 class="bebasnew">Event Details</h2>
    <ul class="search_list_items search_list_items-mod">
        <li>
            <div class="location_img_wrap">
                <img src="{{asset($data->image)}}">
            </div>
            <div class="list_content_wrap">
                <ul class="rating_coments">
                    <li>
                        <h5>&dollar;{{$data->price}}</h5>
                    </li>
                    <li>
                        <h5><span>Age Group: <b>{{$data->agegroup->group}}</b></span></h5>
                    </li>
                </ul>
                <h4 class="place_title bebasnew">{{$data->name}}</h4>
                <p><a href="{{route('details',['name' => 'business', 'id' =>$data->business->id ])}}">{{$data->business->name}}</a></p>
                
                <div class="location_details">
                    <p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$data->address}}</p>
                    <p class="phone_call"><strong>Contact Dertails: </strong> {{$data->contact_details}}</p>
                    <p class="phone_call"><strong>Duration: </strong> {{Date('d M,y', strtotime($data->start))}} - {{Date('d M,y', strtotime($data->end))}}</p>
                </div>
                <p class="history_details">{{$data->booking_details}}</p>
                <div class="text-right float-right">
                    <a href="{{route('user.event.book',['id' => encrypt($data->id)])}}" class="orange-btm load_btn text-center">Book Event</a>
                </div>
                
            </div>
        </li>
    </ul>
</div>
@endsection
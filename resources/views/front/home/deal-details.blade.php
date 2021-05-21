@extends('front.home.details-master')

@section('brd_name')
<li><a href="{{route('deals')}}">Deals</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Deal Detail</a></li>
@endsection

@section('details-content')
<div class="row">
    <h2 class="bebasnew">Deal Details</h2>
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
                        <h5><span><b>{{$data->promo_code}}</b></span></h5>
                    </li>
                </ul>
                <h4 class="place_title bebasnew">{{$data->title}}</h4>
                <p><a href="{{route('details',['name' => 'business', 'id' =>$data->business->id ])}}">{{$data->business->name}}</a></p>
                
                <div class="location_details">
                    <p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$data->address}}</p>
                    <p class="phone_call"><strong>Reedem Before: </strong> {{Date('d M,y', strtotime($data->expire_date))}}</p>
                </div>
                <p class="history_details">{{$data->description}}</p>
            </div>
        </li>
    </ul>
</div>
@endsection
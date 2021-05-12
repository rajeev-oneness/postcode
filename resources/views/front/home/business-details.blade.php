@extends('front.home.details-master')

@section('brd_name')
<li><a href="{{route('directory')}}">Directory</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Business Detail</a></li>
@endsection

@section('details-content')
<div class="row">
        <h2 class="bebasnew">Business Details</h2>
        <ul class="search_list_items search_list_items-mod">
            <li>
                <div class="location_img_wrap">
                    <img src="{{asset($data[0]['image'])}}">
                </div>
                <div class="list_content_wrap">
                    <ul class="rating_coments">
                        <li>
                            <h5>Category: {{$data[0]['businesstype']['name']}}</h5>
                        </li>
                    </ul>
                    <h4 class="place_title bebasnew">{{$data[0]['name']}}</h4>
                    
                    <div class="location_details">
                        <p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$data[0]['address']}}</p>
                        <p class="phone_call"><img src="{{asset('homepage_assets/images/phone-call.png')}}">{{$data[0]['mobile']}}</p>
                        <p class="phone_call"><strong>ABN: </strong> {{$data[0]['abn']}}</p>
                        <p class="phone_call"><strong>Working Hours: </strong> {{$data[0]['open_hour']}} - {{$data[0]['closing_hour']}}</p>
                    </div>
                    <p class="history_details">{{$data[0]['description']}}</p>
                </div>
            </li>
        </ul>
</div>

<ul class="history_list">
    <h2 class="bebasnew">Services</h2>
    @foreach ($data[0]['services'] as $item)
        <li>
            <h4 class="place_title bebasnew">{{$item['name']}}</h4>
            <p class="location">Price: $ {{$item['price']}}</p>
            <p class="history_details">{{$item['details']}}</p>
        </li>
    @endforeach
</ul>
<ul class="history_list">
    <h2 class="bebasnew">Deals</h2>
    @foreach ($data[0]['offers'] as $item)
        <li>
            <h4 class="place_title bebasnew">{{$item['title']}}</h4>
            <p class="location">Price: $ {{$item['price']}}</p>
            <p class="history_details">{{$item['promo_code']}}</p>
        </li>
    @endforeach
</ul>
<ul class="history_list">
    <h2 class="bebasnew">Events</h2>
    @foreach ($data[0]['events'] as $item)
        <li>
            <h4 class="place_title bebasnew">{{$item['name']}}</h4>
            <p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">Price: $ {{$item['address']}}</p>
            <p class="location">Price: $ {{$item['price']}}</p>
        </li>
    @endforeach
</ul>
<ul class="history_list">
    <h2 class="bebasnew">Reviews</h2><a href="{{route('rating.add', ['businessId'=>$data[0]['id']])}}" class="orange-btm load_btn">Add Review</a>
    @foreach ($ratings as $item)
        <li>
            <h4 class="place_title bebasnew">Comment By - {{$item->user->name}}</h4>
            <p class="rating">
                @for ($i = 0; $i < $item->rating; $i++)
                <i class="fas fa-star text-warning"></i>
                @endfor
            </p>
            <p class="location">{{$item->description}}</p>
        </li>
    @endforeach
</ul>
@endsection
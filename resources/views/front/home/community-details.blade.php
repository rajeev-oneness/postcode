@extends('front.home.details-master')

@section('brd_name')
<li>Community Detail</li>
@endsection

@section('details-content')
<div class="row">
    <h2 class="bebasnew">Community Details</h2>
    <ul class="search_list_items search_list_items-mod">
        <li>
            <div class="location_img_wrap">
                <img src="{{asset($data->image)}}">
            </div>
            <div class="list_content_wrap">
                <ul class="rating_coments">
                    <li>
                        <h5>{{$data->community_category->name}}</h5>
                    </li>
                </ul>
                <h4 class="place_title bebasnew">{{$data->title}}</h4>
                <p class="history_details">{{$data->description}}</p>
            </div>
        </li>
    </ul>
</div>
@endsection
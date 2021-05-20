@extends('front.home.details-master')

@section('brd_name')
<li><a href="{{route('marketplace')}}">Marketplace</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Product details</a></li>
@endsection

@section('details-content')
<h2 class="bebasnew">Product Details</h2>

<div class="row">
    <ul class="search_list_items search_list_items-mod">
        <li>
            <div class="location_img_wrap">
                <img src="{{asset($data[0]->image)}}">
            </div>
            <div class="list_content_wrap">
                <ul class="rating_coments">
                    <li>
                        <h5>{{$data[0]->category->name}}</h5>
                    </li>
                    <li>
                        <h5>{{$data[0]->subcategory->name}}</h5>
                    </li>
                </ul>
                <h4 class="place_title bebasnew">{{$data[0]->name}}</h4>
                <h4 class="place_title bebasnew">${{$data[0]->price}}</h4>
                <p class="history_details">{{$data[0]->details}}</p>
                @php
                    $product_ids = [$data[0]->id];
                @endphp
                <a href="{{route('book_now.product',['id' => encrypt($product_ids)])}}" class="orange-btm load_btn text-center">Buy Now</a>
            </div>
        </li>
    </ul>
</div>
@endsection
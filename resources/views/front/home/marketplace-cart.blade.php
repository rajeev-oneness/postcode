@extends('front.home.details-master')

@section('brd_name')
<li><a href="{{route('marketplace')}}">Marketplace</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>My Cart</a></li>
@endsection

@section('details-content')
<div class="row">
    <div class="col-sm-7 mr-5 border">
        <ul class="history_list">
            <h2 class="bebasnew">Cart Items</h2>
            @php
                $product_ids = [];
            @endphp
            @foreach ($cart as $item)
                {{array_push($product_ids, $item->product->id)}}
                <li>
                    <h4 class="place_title bebasnew">{{$item->product->name}}</h4>
                    <p class="location">Price: $ {{$item->product->price}}</p>
                    <p class="history_details">Quantity: {{$item->amount}}</p>
                </li>
            @endforeach
        </ul>
    </div>
    <div class="col-sm-4 border">
        <ul class="history_list">
            <h2 class="bebasnew">Checkout Section</h2>
            <p class="location">Name: {{auth()->user()->name}}</p>
            <p class="history_details">Address: {{auth()->user()->address}}</p>
            <p class="history_details">Email: {{auth()->user()->email}}</p>
            <a href="{{route('book_now.product',['id' => encrypt($product_ids)])}}" class="orange-btm load_btn text-center">Checkout</a>
        </ul>
    </div>
</div>
@endsection
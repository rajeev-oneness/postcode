@extends('front.home.details-master')

@section('details-content')
<div class="row">
    <div class="col-6">
        <h2 class="bebasnew">Product Details</h2>
        <hr>
        <h4>{{$data[0]->name}}</h4>
        <p>Price: $ {{$data[0]->price}}</p>
        <p>Details: {{$data[0]->details}}</p>
        <p>Category: {{$data[0]->category->name}}/-</p>
        <p>Sub-Caregory: {{$data[0]->subcategory->name}}</p>

    </div>
    <div class="col-6">
        <img src="{{asset($data[0]->image)}}" alt="" width="500">
    </div>
</div>

<div class="row mt-5">
    <a href="{{route('book_now.product',['id' => encrypt($data[0]->id)])}}" class="orange-btm load_btn">Buy Now</a>
</div>
@endsection
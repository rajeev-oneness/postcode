@extends('front.home.details-master')

@section('details-content')
<div class="row">
    <div class="col-6">
        <h2 class="bebasnew">Event Details</h2>
        <hr>
        <h4>{{$data[0]->title}}</h4><span class="bg-warning p-2">{{$data[0]->promo_code}}</span>
        <p>Description: {{$data[0]->description}}</p>
        <p>Reedeem Before: {{Date('d M,y', strtotime($data[0]->expire_date))}}</p>
        <p>Price: Rs.{{$data[0]->price}}/-</p>
    </div>
    <div class="col-6">
        <img src="{{asset($data[0]->image)}}" alt="" width="500">
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Deal By</h2>
        <hr>
        <a href="{{route('details',['name' => 'business', 'id' =>$data[0]->business->id ])}}"><h4>{{$data[0]->business->name}}</h4></a>
    </div>
</div>
@endsection
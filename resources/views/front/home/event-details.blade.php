@extends('front.home.details-master')

@section('details-content')
<div class="row">
    <div class="col-6">
        <h2 class="bebasnew">Event Details</h2>
        <hr>
        <h4>{{$data[0]->name}}</h4>
        <p>Address: {{$data[0]->address}}</p>
        <p>Description: {{$data[0]->description}}</p>
        <p>Duration: {{Date('d M,y', strtotime($data[0]->strat))}} - {{Date('d M,y', strtotime($data[0]->end))}}</p>
        <p>Price: Rs.{{$data[0]->price}}/-</p>
        <p>Age Group: {{$data[0]->agegroup->group}}</p>
        <p>Booking Details: {{$data[0]->booking_details}}</p>

    </div>
    <div class="col-6">
        <img src="{{asset($data[0]->image)}}" alt="" width="500">
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Organised By</h2>
        <hr>
        <a href="{{route('details',['name' => 'business', 'id' =>$data[0]->business->id ])}}"><h4>{{$data[0]->business->name}}</h4></a>
    </div>
</div>
@endsection
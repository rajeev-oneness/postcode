@extends('front.home.details-master')

@section('details-content')
<div class="row">
    <div class="col-6">
        <h4 class="footer-heading">User Details</h4>
            <div class="form-group">
                <label for="name">Name</label>
                <input type="text" onkeypress="return false" class="form-control" value="{{auth()->user()->name}}">
            </div>
            <div class="form-group">
                <label>Email</label>
                <input type="text" class="form-control" onkeypress="return false" value="{{auth()->user()->email}}">
            </div>
            <div class="form-group">
                <label>Postcode</label>
                <input type="text" class="form-control" onkeypress="return false" value="{{auth()->user()->postcode}}">
            </div>
            <div class="form-group">
                <label>Postcode</label>
                <textarea cols="30" rows="3" onkeypress="return false" class="form-control">{{auth()->user()->address}}</textarea>
            </div>

    </div>
    <div class="col-6">
        <h4 class="footer-heading">Event Details</h4>
        <h4>{{$event->name}}</h4> 
        <img src="{{asset($event->image)}}" alt="" width="200">
        <br><br>
        <h4>Price : Rs.{{$event->price}}/-</h4>
        <form action="{{route('complete.booking')}}" method="POST">
            @csrf
            <input type="hidden" name="user_id" value="{{encrypt(auth()->id())}}">
            <input type="hidden" name="event_id" value="{{encrypt($event->id)}}">
            {{-- <input type="hidden" name="price" value="{{$event->price}}"> --}}

            <button type="submit" class="btn p-3" style="width: 100%; background:#f25d23; color: #ffffff">Book This Event</button>
        </form>
    </div>
</div>

@endsection
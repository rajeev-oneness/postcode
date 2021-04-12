@extends('front.home.master')

@section('content')
    <div class="container">
        <h4 class="footer-heading">{{$user[0]['name']}}</h4>
        <strong>Email </strong>{{$user[0]['email']}} <br>
        <strong>Address </strong>{{$user[0]['address']}} <br>
        <strong>Country </strong>{{$user[0]['usercountry']['name']}} <br>
        <strong>State </strong>{{$user[0]['userstate']['name']}} <br>
        <strong>Post Code </strong>{{$user[0]['postcode']}} <br>


    </div>
@endsection
@extends('front.home.master')

@section('title')
    About Us
@endsection


@section('content')
    <div class="container">
        <div class="col-md-12 text-center p-5">
            <h4 class="footer-heading">About Us</h4>
            {{$data->short_description}} <br><br>
            {{$data->description}} <br><br>
        </div>
    </div>
@endsection


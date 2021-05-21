@extends('front.home.master')

@section('title')
    About Us
@endsection


@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{{route('default.homepage')}}">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					<li>About Us</li>
				</ul>
			</div>
		</div>
	</div>
</section>
    <div class="container">
        <div class="col-md-12 text-left p-5">
            <h4 class="footer-heading">About Us</h4>
            {{$data->short_description}} <br><br>
            {{$data->description}} <br><br>
        </div>
    </div>
@endsection


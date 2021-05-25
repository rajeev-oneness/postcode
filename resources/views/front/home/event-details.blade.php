@extends('front.home.details-master')

@section('brd_name')
<li><a href="{{route('events')}}">Events</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Event Detail</a></li>
@endsection

@section('details-content')
<div class="row">
    <h2 class="bebasnew">Event Details</h2>
    <!--<ul class="search_list_items search_list_items-mod">
        <li>
            <div class="location_img_wrap">
                <img src="{{asset($data->image)}}">
            </div>
            <div class="list_content_wrap">
                <ul class="rating_coments">
                    <li>
                        <h5>&dollar;{{$data->price}}</h5>
                    </li>
                    <li>
                        <h5><span>Age Group: <b>{{$data->agegroup->group}}</b></span></h5>
                    </li>
                </ul>
                <h4 class="place_title bebasnew">{{$data->name}}</h4>
                <p><a href="{{route('details',['name' => 'business', 'id' =>$data->business->id ])}}">{{$data->business->name}}</a></p>
                
                <div class="location_details">
                    <p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$data->address}}</p>
                    <p class="phone_call"><strong>Contact Dertails: </strong> {{$data->contact_details}}</p>
                    <p class="phone_call"><strong>Duration: </strong> {{Date('d M,y', strtotime($data->start))}} - {{Date('d M,y', strtotime($data->end))}}</p>
                </div>
                <p class="history_details">{{$data->booking_details}}</p>
                <div class="text-right float-right">
                    <a href="{{route('user.event.book',['id' => encrypt($data->id)])}}" class="orange-btm load_btn text-center">Book Event</a>
                </div>
                
            </div>
        </li>
    </ul>-->
</div>

<div class="row m-0 mt-5 mb-5">
	<div class="col-12 col-md-6 bg-bipblue p-4">
		<ul class="detail-evtext">
			<li>
				<p class="w-100 catagoris_ev">
					<span><img src="{{asset('homepage_assets/images/cat-gov.png')}}" class="mr-2"> {{$data->business->name}}</span>
					<span class="float-right w-142">
						<small class="d-block">START : {{$data->start}} </small>
						<small>END : {{$data->end}} </small>
					</span>
				</p>
				<a href="javascript:void(0);"><h1>{{$data->name}}</h1></a>
				<h6>Description</h6>
				<p class="text-white">
					{{$data->short_description}}
				</p>
			<li>
		</ul>
	</div>
	<div class="col-12 col-md-6 p-0 image-part" style="background:url({{asset($data->image)}});">
		<a href="javascript:void(0);" class="all_pic shadow-lg">View All 3 Images</a>
	</div>
</div> <!--upper Row-->

<div class="row m-0 mt-4 mb-5">
	<div class="col-md-8 pl-2 pl-md-0 details_left">
		<div class="card position-relative">
			<div class="price-deat">
				<h1>&dollar;{{$data->price}}<span>Inc. of all taxes<span></h1>
			</div>
			<ul class="nav nav-tabs" role="tablist">
				<li class="nav-item">
					<a class="nav-link active" data-toggle="tab" href="#deals" role="tab">Deals</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#about" role="tab">About</a>
				</li>
				<li class="nav-item">
					<a class="nav-link" data-toggle="tab" href="#photos" role="tab">Photos</a>
				</li>
			</ul><!-- Tab panes -->
			<div class="tab-content">
				<div class="tab-pane active" id="deals" role="tabpanel">
					<h5>Lorem Ipsum is simply dummy</h5>
					<ul class="deals-contant">
						<li>Valid for : 1 Person</li>
						<li>|</li>
						<li>Valid on : All Days</li>
						<li>|</li>
						<li>Timings : 10:30 AM - 2:00 PM</li>
					</ul>
				</div>
				<div class="tab-pane" id="about" role="tabpanel">
					<p class="mb-0">
						{{$data->description}}
					</p>
					<p class="mb-0">
						<h1 class="footer-heading mb-0 mt-2">Booking details</h1>
						{{$data->booking_details}}
					</p>
					<p class="mb-0">
						<h1 class="footer-heading mb-0 mt-2">Age Group</h1>
						{{$data->agegroup->group}}
					</p>
				</div>
				<div class="tab-pane" id="photos" role="tabpanel">
					<ul class="photo_tab">
						<li><img src="{{asset($data->image)}}"></li>
						<li><img src="{{asset($data->image)}}"></li>
						<li><img src="{{asset($data->image)}}"></li>
						<li><img src="{{asset($data->image)}}"></li>
						<li><img src="{{asset($data->image)}}"></li>
						<li><img src="{{asset($data->image)}}"></li>
					</ul>
				</div>
			</div>
			<div class="mt-4 text-right">
				<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">DETAILS</a>
				<a href="javascript:void(0);" class="blue-btn load_btn" id="load-more2">+ Add</a>
			</div>
		</div>
	</div>
	<div class="col-md-4 p-0 details_right">
		<div class="card position-relative">
			<div class="card-header text-center border-0 bg-bipblue text-white">
				<h4>Your Bookings</h4>
			</div>
			<div class="card-body p-0">
				<div class="bg-light p-3 text-center">
					<h5>Please add an option <span class="d-block">Your order is empty</span></h5>
				</div>
				<div class="p-3">
					<h4><span>Total</span> : $0</h4>
				</div>
			</div>
			<div class="card-footer border-0 p-0">
				<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">BOOK NOW</a>
			</div>
		</div>
	</div>
</div>

@endsection
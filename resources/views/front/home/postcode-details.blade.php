@extends('front.home.master')

@section('title')
	Postcode Details
@endsection

@section('head-script')
<script>
    function initMap() {
		const map = new google.maps.Map(document.getElementById("map"), {
			zoom: 4,
			center: { lat: -28.024, lng: 140.887 },
		});
		const labels = "ABCDEFGHIJKLMNOPQRSTUVWXYZ";
		const markers = locations.map((location, i) => {
			return new google.maps.Marker({
			position: location,
			label: labels[i % labels.length],
			});
		});
		new MarkerClusterer(map, markers, {
			imagePath:
			"https://developers.google.com/maps/documentation/javascript/examples/markerclusterer/m",
		});
	}
	let locations = [];
</script>
<style>
	.review-card{
		background: #0e3c7d;
		transition: all 0.5s ease-out;
		cursor: pointer;
	}
	.review-card:hover, .review-card .active{
		background: #f25d23;
	}
	.review-card .active{
		background: #f25d23;
	}
	.star-color{
		font-size: 14px;
		color:#f7bc00;
	}
	.user-pic-rev{
		width: 70px;
		height: 70px;
		border-radius: 50%;
		background: #fff;
	}
	.user-pic-rev img{
		width: 70px;
		height: 70px;
		border-radius: 50%;
	}
	#map {
	  height: 400px;
	  width: 100%;
	}
</style>
@endsection

@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{{route('default.homepage')}}">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					<li>Postcode</li>
				</ul>
			</div>
		</div>
	</div>
</section>
<div class="container">
	<div class="row">
		<div class="col-12">
			<div class="tab-content" id="myTabContent">
				<div class="row m-0 mt-5 mb-5">
					<div class="col-12 col-md-5 bg-bipblue p-2">
						<ul class="detail-evtext p-4">
							<li>
								<a href="javascript:void(0);"><h1>POST CODE: {{$postcode->postcode}}</h1></a>
								<input type="hidden" id="postcode" value="{{$postcode->postcode}}">
								<input type="hidden" id="business_category" value="{{$category}}">
								<h4 class="text-white">{{$postcode->state->name}}</h4>
								<h6>Description</h6>
								<p class="text-white">
									{{$postcode->description}}
								</p>
							</li>
						</ul>
					</div>
					<div class="col-12 col-md-7 p-0 image-part" style="background:url({{asset($postcode->image)}});"></div>
				</div>
			</div>
		</div>
	</div>
</div>
<section class="gray-section">
	<div class="container">
		<h2 class="main-heading text-center">your business area</h2>
		<div class="row align-items-center justify-content-between">
			<div id="map"></div>
		</div>
	</div>
</section>
<section class="white-section">
	<div class="history_grid_body grid-view">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
						<div class="tab-pane fade show active" id="gird" role="tabpanel" aria-labelledby="gird-tab">
							<div class="text-center relative-heading">
								<h2 class="main-heading">Events</h2>
							</div>
							<ul class="history_list">
								@forelse ($events as $event)
								<li>
									<div class="location_img_wrap">
										<img src="{{url($event->image)}}">
										<p>
											<span><img src="{{url('homepage_assets/images/star.png')}}"> <b>4.5</b> <small>({{count($event->ratings)}} reviews)</small></span> |  <span><small><img src="{{url('homepage_assets/images/chat.png')}}"> {{count($event->ratings)}} Comments</small></span>
										</p>
									</div>
									<a href ="{{route('details', ['name' => 'event', 'id' => $event->id])}}" class="evgrid-padding">
										<h4 class="place_title bebasnew">{{$event->name}}</h4>
									</a>
									<div class="tupe-grid">
										<p>
											<img src="{{url('homepage_assets/images/cat-gov.png')}}" class="d-block">{{$event->eventcattype->name}}
										</p>
									</div>
									<p class="phone_call gred-p">
										<strong>Organiser: <a href="{{route('details', ['name' => 'business', 'id' => $event->business->id])}}">{{$event->business->name}}</a></strong>
									</p>
									<p class="location gred-p">
										<img src="{{url('homepage_assets/images/place.png')}}">{{$event->address}}
									</p>
									<p class="phone_call gred-p">
										<img src="{{url('homepage_assets/images/phone-call.png')}}">{{$event->business->mobile}}
									</p>
									<div class="card-border mt-0 mb-3"></div>
									<p class="history_details pl-3 pb-0 mb-0">
										{{substr($event->description, 0, 35) . '...'}}
									</p>
									<div class="view-det1">
										<a href ="{{route('details', ['name' => 'event', 'id' => $event->id])}}" class="d-block"><img src="{{url('homepage_assets/images/right-arrow.png')}}" class="d-block"></a>
									</div>
								</li>
								@empty
									<h3>Oops! No events</h3>
								@endforelse
							</ul>
							@if (count($events) > 0)
							<a href="{{route('events', ['menu'=>'events', 'search'=> $postcode->postcode])}}" class="primery-button orange-btm mt-4">More Events</a>
							@else
							<a href="{{route('events')}}" class="primery-button orange-btm mt-4">More Events</a>
							@endif
							
						</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>
<section class="gray-section">
	<div class="container">
		<h2 class="main-heading">View Offers in your Local Area</h2>

		<ul class="offers-list">
			@forelse ($offers as $offer)
			<li>
				<div class="inner-box" style="background:url({{asset('').$offer->image}}) no-repeat center center; background-size: cover;">
					<div class="grid-content">
						<a href="{{route('details',['name' => 'deal', 'id' => $offer->id])}}" class="shop-heading">{{$offer->title}}</a>
						<a href="#" class="place"><span><img src="{{asset('homepage_assets/images/place-icon.png')}}"></span> {{$offer->address}}</a>
						<hr>
						<ul class="comment-list">
							<li><span><img src="{{asset('homepage_assets/images/star.png')}}"></span> 4.5 <a href="#" class="review-link">({{count($offer->ratings)}} reviews)</a></li>
						</ul>
					</div>
					
				</div>
			</li>
			@empty
				<div class="col-12">
					<h3 class="text-center">Oops! No offers</h3>
				</div>
			@endforelse
		</ul>
		@if (count($offers) > 0)
		<a href="{{route('deals',['menu'=>'deals', 'search'=> $postcode->postcode])}}" class="primery-button orange-btm mt-4">More Offers</a>
		@else
		<a href="{{route('deals')}}" class="primery-button orange-btm mt-4">More Offers</a>
		@endif
		
	</div>
</section>
<section class="white-section">
	<div class="container">
		<h2 class="main-heading">Reviews</h2>

		<div class="row m-0">
			@for ($i = 0; $i < 3; $i++)
			<div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3 pl-md-0 text-left">
				<div class="card review-card active">
					<div class="card-body event-body">
						<div class="row m-0 col-12 p-0 ">
							<div class="col-4 col-md-3 p-0 text-center">
								<div class="user-pic-rev">
								<img src="{{asset('business_user_asset/images/rev-pic.png')}}">
								</div>
							</div>
							<div class="col-8 col-md-9 p-0">
								<h5 class="card-title text-white">SAMUAL WILLIAM</h5>
								<h6 class="card-subtitle mb-2 star-color">
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star"></i>
								<i class="fas fa-star-half-alt"></i>
								</h6>
							</div>
						</div>
						<p class="card-text text-white">
						It is a long established fact that a reader will point of using Lorem Ipsum is that it has a more-or-less normal distribution of letters, as opposed to using 'Content here, content here', making it look like readable English. Many desktop publishing packag and web page editors
						</p>
						<p class="text-right">
							<img src="{{asset('business_user_asset/images/quote-rev.png')}}">
						</p>
					</div>
				</div>
			</div>
			@endfor
		</div>
	</div>
</section>

{{-- <section class="counter-section" style="background: url({{asset('homepage_assets/images/counter-bg.jpg')}}) no-repeat center center; background: cover;">
	<div class="container">
		<ul class="counter-list">
			<li>
				<figure data-count="500">0</figure>
				<figcaption>New Visiters Every Week</figcaption>
			</li>
			<li>
				<figure data-count="600">0</figure>
				<figcaption>Happy customers every year</figcaption>
			</li>
			<li>
				<figure data-count="78">0</figure>
				<figcaption>New Listing Every Week</figcaption>
			</li>
		</ul>
	</div>
</section> --}}

{{-- <section class="gray-section">
	<h2 class="main-heading">Find a local business</h2>
	<ul class="business-list">
		@forelse ($categories as $category)
		<li>
			<div class="inner-box" style="background: url({{asset('').$category->image}}) no-repeat center center; background-size: cover;">
				<div class="grid-content">
					<form action="{{route('directory')}}" method="get">
						<input type="hidden" name="category" value="{{$category->id}}">
						<button class="primery-button orange-btm" style="border-style: none;">{{$category->name}}</button>
					</form>
				</div>
			</div>
		</li>
		@empty
			
		@endforelse
		
	</ul>
</section> --}}
<section class="gray-section">
	<div class="container">
		<h2 class="main-heading">View Events in your Area</h2>
		<ul class="event-list">
			<li>
				<div class="inner-box" style="background:url({{asset('homepage_assets/images/ev1.jpg')}}) no-repeat center center; background-size: cover;">
					<div class="caption-area">
						<h3 class="grid-heading"><a href="{{route('events')}}">North NT</a></h3>
						<a href="{{route('events')}}" class="events-tag">See events</a>
					</div>
				</div>
			</li>
			<li>
				<div class="inner-box" style="background:url({{asset('homepage_assets/images/ev2.jpg')}}) no-repeat center center; background-size: cover;">
					<div class="caption-area">
						<h3 class="grid-heading"><a href="{{route('events')}}">Darwin City NT</a></h3>
						<a href="{{route('events')}}" class="events-tag">See events</a>
					</div>
				</div>
			</li>
			<li>
				<div class="inner-box" style="background:url({{asset('homepage_assets/images/ev3.jpg')}}) no-repeat center center; background-size: cover;">
					<div class="caption-area">
						<h3 class="grid-heading"><a href="{{route('events')}}">QLD Central NT</a></h3>
						<a href="{{route('events')}}" class="events-tag">See events</a>
					</div>
				</div>
			</li>
		</ul>
		<a href="{{route('events')}}" class="primery-button orange-btm">More Events</a>
	</div>
</section>

<section class="white-section">
	<div class="container">
		<h2 class="main-heading">Connect with your Community</h2>

		<ul class="community-list">
			@forelse ($communities as $community)
			<li>
				<div class="inner-box">
					<figure style="background:url({{asset($community->image)}}) no-repeat center center; background-size: cover;"></figure>
					<figcaption>
						<h4>
							{!! $community->description !!}
						</h4>
						<a href="{{route('community.post.detail',base64_encode($community->id))}}" class="text-button">View More <i class="fas fa-long-arrow-alt-right"></i> </a>
					</figcaption>
				</div>
			</li>
			@empty
				<li>No Data!</li>
			@endforelse
			
		</ul>

		<a href="{{route('community.show')}}" class="primery-button orange-btm">More Community</a>


	</div>
</section>

@section('script')

<script type="text/javascript">

$(document).ready(function() {
	$.ajax({
		type:'POST',
		url:'{{route('getLatLng')}}',
		data : {
			'_token': "{{csrf_token()}}",
			'postcode': $("#postcode").val(),
			'category': $("#business_category").val(),
		},
		success:function(data) {
			console.log(data.data);
			if(data.error == false) {
				if(data.data.length > 0) {
					$.each(data.data, function( index, value ) {
						// map view
						let lat = Number(value.latitude);
						let lng = Number(value.longitude);
						if(lat != 0 && lng != 0){
							locations.push({ lat : lat, lng : lng });
							initMap();
						}
					})
				}
			}
		}
	});
})

$("#category-search").click(function() {
	alert('hi')
});

function numericKey(event) {
	if(event.charCode >= 48 && event.charCode <= 57) {
		return true;
	}
	return false;
}

//community slider
$('.community-list').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});

//business slider
$('.business-list').slick({
  dots: true,
  //infinite: false,
  speed: 300,
  centerMode: true,
  centerPadding: '60px',
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});


// counter
var a = 0;
$(window).scroll(function() {

  var oTop = $('.counter-list').offset().top - window.innerHeight;
  if (a == 0 && $(window).scrollTop() > oTop) {
    $('.counter-list li figure').each(function() {
      var $this = $(this),
        countTo = $this.attr('data-count');
      $({
        countNum: $this.text()
      }).animate({
          countNum: countTo
        },

        {

          duration: 1000,
          easing: 'swing',
          step: function() {
            $this.text(Math.floor(this.countNum));
          },
          complete: function() {
            $this.text(this.countNum);
            //alert('finished');
          }

        });
    });
    a = 1;
  }

});



$(document).ready(function(){
	$('.ham').click(function(e){
		e.stopPropagation();
		$('.navigation').toggleClass('slide');
	});

	$(document).click(function(){
		$('.navigation').removeClass('slide');
	});

	$('.navigation').click(function(e){
		e.stopPropagation();
	});

});


</script>

@endsection
@endsection
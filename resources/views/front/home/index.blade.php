@extends('front.home.master')

@section('title')
	Homepage
@endsection

@section('content')
<section class="banner" style="background: url({{asset('homepage_assets/images/banner-image.jpg')}}) no-repeat center center; background-size:cover;">
	<div class="banner-inner">
		<h1 class="banner-heading bebasnew">Discover thousands of local businesses</h1>
		<div class="search-area">
			<form action="{{route('postcode.deatils')}}" method="get">
			{{-- <form action="{{route('directory')}}" method="get"> --}}
			<ul class="search-list">
				{{-- <li class="keyword">
					<input type="text" list="businesses" id="keyword" name="keyword" placeholder="Search by Keyword">
					<datalist id="businesses">
						@foreach ($businesses as $business)
						<option value="{{$business->name}}">
						@endforeach
					</datalist>
					<span><img src="{{asset('homepage_assets/images/magnify.png')}}"></span>
				</li> --}}
				<li class="postcode">
					<input type="text" list="postcodes" id="postcode" name="postcode" placeholder="Search by Postcode" onkeypress="return numericKey(event)">
					<datalist id="postcodes">
						@foreach ($postcodes as $postcode)
						<option value="{{$postcode->postcode}}">
						@endforeach
					  </datalist>
					<span><img src="{{asset('homepage_assets/images/place.png')}}"></span>
				</li>
				<li class="category">
					<select name="category">
						<option value="">Search by category</option>
						@foreach ($categories as $category)
						<option value="{{$category->id}}"> {{$category->name}} </option>
						@endforeach
					</select>
					<span><img src="{{asset('homepage_assets/images/category.png')}}"></span>
				</li>
				<li class="button">
					<input type="submit" value="Search">
				</li>
			</ul>
			</form>
		</div>
		@if (Session::has('noData'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>{{session('noData')}}</strong>
		  </div>
		@endif
	</div>
	<div class="category-place">
		<div class="container">
			<ul class="cat-list">
				@forelse ($categories as $category)
				<li>
					<a href="{{route('directory', ['category'=>$category->id])}}">
						<figure><img src="{{asset('').$category->icon}}"></figure>
						{{$category->name}}
					</a>
				</li>
				@empty
				<li>No Data!</li>
				@endforelse
				{{-- <li>
					<a href="#">
						<figure><img src="{{asset('homepage_assets/images/cat-list.png')}}"></figure>
						See all
					</a>
				</li> --}}
			</ul>
		</div>
	</div>
</section>
<section class="add-section">
	<div class="container">
		<div class="row align-items-center justify-content-between">
			<div class="col-md-4 mb-md-0 mb-sm-4 ">
				<h2 class="main-heading">Advertise your Business</h2>
				<p>
					It is a long established fact that a reader will be distracted by the readable content of a page when looking at its layout. The point of using Lorem Ipsum is that it has a more-or-less normal 
				</p>
				<a href="{{route('user.welcome')}}" class="text-button">Ad your business here <i class="fas fa-long-arrow-alt-right"></i> </a>
			</div>
			<div class="col-md-6 text-center">
				<img src="{{asset('homepage_assets/images/mobile-image.png')}}" class="img-fluid">
			</div>
		</div>
	</div>
</section>
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
<section class="gray-section">
	<div class="container">
		<h2 class="main-heading">Top rated Local Businesses</h2>

		<ul class="top-list">
			@forelse ($threebusinesses as $business)
			<li class="mt-2">
				<div class="inner-box" style="background: url({{asset('').$business->image}}) no-repeat center center; background-size: cover;">
					<div class="grid-content">
						<a href="{{route('details',['name' => 'business', 'id' => $business->id])}}" class="shop-heading">{{$business->name}}</a>
						<a href="#" class="place"><span><img src="{{asset('homepage_assets/images/place-icon.png')}}"></span> {{$business->address}}</a>
						<hr>
						<ul class="comment-list">
							<li><span><img src="{{asset('homepage_assets/images/star.png')}}"></span> {!!(count($business->ratings) > 0)? '4.5': '0'!!} <a href="#" class="review-link">({{count($business->ratings)}} reviews)</a></li>
							{{-- <li><span><img src="{{asset('homepage_assets/images/comment-icon.png')}}"></span> <a href="#" class="comment-link">40 Comments</a></li> --}}
						</ul>
					</div>
					<span class="rating"><img src="{{asset('homepage_assets/images/rating-icon.png')}}"></span>
				</div>
			</li>
			@empty
				<li>No Data!</li>
			@endforelse
		</ul>
		<a href="{{route('directory')}}" class="primery-button orange-btm mt-4">More Businesses</a>
	</div>
</section>
<section class="counter-section" style="background: url({{asset('homepage_assets/images/counter-bg.jpg')}}) no-repeat center center; background: cover;">
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
</section>
<section class="white-section">
	<div class="container">
		<h2 class="main-heading">View Offers in your Local Area</h2>

		<ul class="offers-list">
			@forelse ($offers as $offer)
			<li>
				<div class="inner-box" style="background:url({{asset('').$offer->image}}) no-repeat center center; background-size: cover;">
					<div class="grid-content p-3">
						<a href="{{route('details',['name' => 'deal', 'id' => $offer->id])}}" class="shop-heading">{{$offer->title}}</a>
						<a href="#" class="place"><span><img src="{{asset('homepage_assets/images/place-icon.png')}}"></span> {{$offer->address}}</a>
						{{-- <hr>
						<ul class="comment-list">
							<li><span><img src="{{asset('homepage_assets/images/star.png')}}"></span> 4.5 <a href="#" class="review-link">(60 reviews)</a></li>
						</ul> --}}
					</div>
					
				</div>
			</li>
			@empty
				<li>No Data!</li>
			@endforelse
		</ul>
		<a href="{{route('deals')}}" class="primery-button orange-btm mt-4">More Offers</a>
	</div>
</section>
<section class="gray-section">
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
</section>


@section('script')

<script type="text/javascript">

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
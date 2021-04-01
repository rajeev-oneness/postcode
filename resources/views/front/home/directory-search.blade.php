@extends('front.home.master')

@section('title')
	Directory-grid
@endsection

@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="index.html">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					<li>Search in Australia</li>
				</ul>
			</div>
		</div>
	</div>
</section>

{{-- grid-view --}}

<section class="search_history_wrap">
	<div class="history_grid_header">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="list-tab" onclick="listView()"><img class="display-none" src="{{asset('homepage_assets/images/list-2.png')}}"></a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="gird-tab" onclick="gridView()"><img class="display-none" src="{{asset('homepage_assets/images/grid.png')}}"></a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="map-tab"><img class="display-none" src="{{asset('homepage_assets/images/map.png')}}"></a>
					  </li>
					</ul>
				</div>
			</div>
		</div>
	</div>
	<div class="history_grid_body grid-view">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="gird" role="tabpanel" aria-labelledby="gird-tab">
					  		<h5 class="result_tab_title">{{count($businesses)}} results found in <a href="#">Australia</a></h5>
					  		<ul class="history_list">
								@foreach ($businesses as $business)
									<li>
										<h4 class="place_title bebasnew">{{$business->name}}</h4>
										<p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$business->address}}</p>
										<p class="rating"><img src="{{asset('homepage_assets/images/rating.png')}}">300 reviews</p>
										<p class="phone_call"><img src="{{asset('homepage_assets/images/phone-call.png')}}">{{$business->mobile}}</p>
										<p class="history_details">{{$business->description}}</p>
									</li>
								@endforeach
					  		</ul>
					  		<a href="#" class="orange-btm load_btn">Load More</a>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>

	{{-- list view --}}

	<div class="history_grid_body history_grid_body-mod list-view">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
					  		<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">{{count($businesses)}} results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>
					  		<ul class="search_list_items search_list_items-mod">
								@foreach($businesses as $business)
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="{{asset($business->image)}}">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="{{asset('homepage_assets/images/star.png')}}">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="{{asset('homepage_assets/images/chat.png')}}">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">{{$business->name}}</h4>
					  					<div class="location_details">
					  						<p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$business->address}}</p>
						  					<p class="phone_call"><img src="{{asset('homepage_assets/images/phone-call.png')}}">{{$business->mobile}}</p>
					  					</div>
						  				<p class="history_details">{{$business->description}}</p>
						  				<a href="#"><img src="{{asset('homepage_assets/images/right-arrow.png')}}"></a>
					  				</div>
					  			</li>
					  			@endforeach
					  		</ul>
					  		<a href="#" class="orange-btm load_btn">View All</a>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('script')
<script>
	$(document).ready(function() {
		$(".list-view").hide();
	});
	function listView() {
		$(".grid-view").hide();
		$(".list-view").show();
	}
	function gridView() {
		$(".list-view").hide();
		$(".grid-view").show();
	}
</script>

{{-- <script type="text/javascript">
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
</script> --}}

@endsection

@endsection
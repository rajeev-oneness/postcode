@extends('front.home.master')

@section('title')
	Events
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
  <style type="text/css">
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
					<li>Events</li>
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
				<div class="col-8">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
						<li class="nav-item" role="presentation">
					    	<a class="nav-link active" id="gird-tab" data-toggle="tab" href="#gird" role="tab" aria-controls="gird" aria-selected="false" onclick="gridView()"><img class="display-none" src="{{asset('homepage_assets/images/grid.png')}}"><img class="display-block" src="{{asset('homepage_assets/images/active-grid.png')}}"></a>
					  	</li>
						<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true" onclick="listView()"><img class="display-none" src="{{asset('homepage_assets/images/list-2.png')}}"><img class="display-block" src="{{asset('homepage_assets/images/list-active.png')}}"></a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="false" onclick="mapView()"><img class="display-none" src="{{asset('homepage_assets/images/map.png')}}"><img class="display-block" src="{{asset('homepage_assets/images/map-active.png')}}"></a>
					  	</li>
					</ul>
				</div>
				<div class="search_form_wrap">
					<form action="{{route('events')}}">
						@csrf
						<input type="hidden" name="menu" value="events">
						<input type="text" name="search" placeholder="Seatch  by postcode">
						<button><img src="{{asset('homepage_assets/images/magnify.png')}}"></button>
					</form>
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
					  		<!--<h5 class="result_tab_title"> <span id="data-count"></span> results found in <a href="#">Australia</a></h5>-->
							<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">{{count($event)}} results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>
					  		<ul class="history_list">
								{{-- grid data rendered here --}}
					  		</ul>
							<div class="text-center">
								<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more1">Load More</a>
							</div>
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
					  		<!-- <div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title"> <span id="data-count"></span> results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>-->
							<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">{{count($event)}} results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>
					  		<ul class="search_list_items search_list_items-mod" id="list-data">
								{{-- list data rendered here --}}
					  		</ul>
							<div class="text-center">
								<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">Load More</a>
							</div>
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
		
	{{-- map view --}}
	<div id="map"></div>

</section>


@section('script')
<script>
	$(document).ready(function() {
		$(".list-view").hide();
		$("#map").hide();
	});
	function listView() {
		$(".grid-view").hide();
		$("#map").hide();
		$(".list-view").show();
	}
	function gridView() {
		$(".list-view").hide();
		$("#map").hide();
		$(".grid-view").show();
	}
	function mapView() {
		$(".list-view").hide();
		$(".grid-view").hide();
		$("#map").show();
	}

</script>

<script>
	console.log('{{Route::current()->getName()}}');
	let page = 0;
	$('#load-more1, #load-more2').click(function() {
		page += 1;
		ajaxCall();
	});
	ajaxCall();
	function ajaxCall() {
		let params = {_token:'{{csrf_token()}}',page:page,menu:'{{Route::current()->getName()}}'};
		@foreach($request as $key => $req)
			params['{{$key}}'] = '{{$req}}';
		@endforeach
		// console.log(params);
		$.ajax({
			type:'POST',
			url:'{{route('event.deal.ajax')}}',
			data:params,
			success:function(data) {
				grid_view = '';
				list_view = '';
				if(data.error == false){
					if(data.data.length > 0) {
						console.log(data.data.length);
						$.each(data.data, function(index, value){
							// map view
							let lat = Number(value.business.latitude);
							let lng = Number(value.business.longitude);
							if(lat != 0 && lng != 0){
								locations.push({ lat : lat, lng : lng });
								initMap();
							}


							// grid view
							eventHref = "{{route('details',['name' => 'event', 'id' => 'eventId'])}}";
							eventHref = eventHref.replace('eventId', value.id);

							businessHref = "{{route('details',['name' => 'business', 'id' => 'businessId'])}}";
							businessHref = businessHref.replace('businessId', value.business.id);

							grid_view += "<li>";
							grid_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"><p><span><img src="{{url('')}}/'+'homepage_assets/images/star.png'+'"> <b>4.5</b> <small>(60 reviews)</small></span> |  <span><small><img src="{{url('')}}/'+'homepage_assets/images/chat.png'+'"> 40 Comments</small></span></p></div>';
							grid_view += '<a href ="'+eventHref+'" class="evgrid-padding"><h4 class="place_title bebasnew">'+value.name+'</h4></a>';
							// grid_view += '<div class="tupe-grid"><p><img src="{{url('')}}/'+'homepage_assets/images/cat-gov.png'+'" class="d-block">Government</p></div>';
							//grid_view += '<p class="phone_call"><strong>Event organiser: <a href="'+businessHref+'">'+value.business.name+'</a></strong></p>';
							grid_view += '<p class="location gred-p"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p>';
							//grid_view += '<p class="location"><strong>Date: '+value.start+' to '+value.end+'</strong></p>';
							// grid_view += '<p class="rating"><img src="{{url('')}}/'+'homepage_assets/images/rating.png'+'">300 reviews</p>';
							grid_view += '<p class="phone_call gred-p"><img src="{{url('')}}/'+'homepage_assets/images/phone-call.png'+'">'+value.business.mobile+'</p>';
							grid_view += '<div class="card-border mt-0 mb-3"></div>';
							grid_view += '<p class="history_details pl-3 pb-0 mb-0">'+value.description+'</p>';
							grid_view += '<div class="view-det"><a href ="'+eventHref+'" class="d-block"><img src="{{url('')}}/'+'homepage_assets/images/right-arrow.png'+'" class="d-block"></a></div>';
							grid_view += "</li>";

							// list view
							list_view += "<li>";
							list_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"></div>';
							list_view += '<div class="list_content_wrap">';
							// list_view += '<div class="tupe-grid"><p><img src="{{url('')}}/'+'homepage_assets/images/cat-gov.png'+'" class="d-block">Government</p></div>';
							list_view += '<ul class="rating_coments"><li><img src="{{url('')}}/'+'homepage_assets/images/star.png'+'"><h5>4.5 <span>(60 reviews)</span></h5></li><li><img src="{{url('')}}/'+'homepage_assets/images/chat.png'+'"><h5><span>40 Comments</span></h5></li></ul>';
							list_view += '<a href ="'+eventHref+'" class="list-title"><h4 class="place_title bebasnew">'+value.name+'</h4></a>';
							list_view += '<div class="location_details"><p class="location list-location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p><p class="phone_call"><img src="{{url('')}}/'+'homepage_assets/images/phone-call.png'+'">'+value.business.mobile+'</p></div>';
							//list_view += '<p class="location"><strong>Event organiser: <a href="'+businessHref+'">'+value.business.name+'</a></strong></p>';
							//list_view += '<p class="location"><strong>Date: '+value.start+' to '+value.end+'</strong></p>';
							list_view += '<p class="history_details">'+value.description+'</p>';
							list_view += '<div class="view-det"><a href ="'+eventHref+'" class="d-block"><img src="{{url('')}}/'+'homepage_assets/images/right-arrow.png'+'" class="d-block"></a></div>';
							list_view += "</div>"	
							list_view += "</li>";
						});
						$(".history_list").append(grid_view);
						$("#list-data").append(list_view);
					} else {
						$('#load-more1').html('No more data!');
						$('#load-more2').html('No more data!');
					}
				} else {
					//here goes the error
					$('#load-more1').html('No more data!');
					$('#load-more2').html('No more data!');
				}
				// $('#load-more').hide();
				console.log(data);
			}
		})
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
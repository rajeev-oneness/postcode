@extends('front.home.master')

@section('title')
	Directory
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
					<li>Directory</li>
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
					<form action="{{route('directory')}}">
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
					  		<h5 class="result_tab_title"> </h5>
					  		<ul class="history_list">
								{{-- load by ajax --}}
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
					  		<div class="result_tab_title_wrap">
								<h5 class="result_tab_title"></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>
					  		<ul class="search_list_items search_list_items-mod" id="list-data">
								{{-- load by ajax --}}
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
	$(document).ready(function() {
		var page = 0;
		$('#load-more1, #load-more2').click(function() {
			page += 1;
			getBusiness();
		});

		getBusiness();
		function getBusiness(){
			// getting parameters
			let params = {_token:'{{csrf_token()}}',page:page};
			@foreach($request as $key => $req)
				params['{{$key}}'] = '{{$req}}';
			@endforeach
			// console.log(params);
			// getting Data as per the parameters
			$.ajax({
				type:'POST',
            	url:'{{route('getBusinessByState')}}',
				data : params,
				success:function(data) {
					grid_view = '';
					list_view = '';
					//total data count
					count = data.total+' results found in <a href="javascript:void(0);">Australia</a>';
					$(".result_tab_title").html(count);
					
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
		
								// grid view
								let href = "{{route('details',['name' => 'business', 'id' => 'businessId'])}}";
								href = href.replace('businessId', value.id);
								grid_view += "<li>";
								grid_view += '<a href="'+href+'"><h4 class="place_title bebasnew">'+value.name+'</h4></a>'; 	
								grid_view += '<p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p>';
								grid_view += '';
								grid_view += '';
								grid_view += '<p class="rating"><img src="{{url('')}}/'+'homepage_assets/images/rating.png'+'">'+value.ratings.length+' reviews</p>';
								grid_view += '<p class="phone_call"><img src="{{url('')}}/'+'homepage_assets/images/phone-call.png'+'">'+value.mobile+'</p>';
								grid_view += '<p class="history_details">'+value.description+'</p>';
								grid_view += "</li>";

								//list view
								list_view += "<li>";
								list_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"></div>';
								list_view += '<div class="list_content_wrap">';
								list_view += '<ul class="rating_coments"><li><img src="{{url('')}}/'+'homepage_assets/images/star.png'+'"><h5>4.5 <span>('+value.ratings.length+' reviews)</span></h5></li><li><img src="{{url('')}}/'+'homepage_assets/images/chat.png'+'"><h5><span>'+value.ratings.length+' Comments</span></h5></li></ul>';
								list_view += '<h4 class="place_title bebasnew">'+value.name+'</h4>';
								list_view += '<div class="location_details"><p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p><p class="phone_call"><img src="{{url('')}}/'+'homepage_assets/images/phone-call.png'+'">'+value.mobile+'</p></div>';
								list_view += '<p class="history_details">'+value.description+'</p>';
								list_view += '<a href="'+href+'"><img src="{{url('')}}/'+'homepage_assets/images/right-arrow.png"></a>';
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
						// error handling
					}
				}
			});
		}
	});
</script>


@endsection

@endsection
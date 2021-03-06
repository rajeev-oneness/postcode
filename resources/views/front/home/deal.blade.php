@extends('front.home.master')

@section('title')
	Deals
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
					<li>Deals</li>
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
					<form action="{{route('deals')}}">
						<input type="hidden" name="menu" value="deals">
						<input type="text" name="search" placeholder="Search  by postcode">
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
								{{-- list goes here --}}
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
				//total data count
				count = data.total+' results found ';
				$(".result_tab_title").html(count);

				if(data.error == false){
					if(data.data.length > 0) {
						$.each(data.data, function(index, value){
							//offer expire date calculation
							const expDate1 = new Date(value.expire_date);
							const expDate2 = new Date();
							const expDiffTime = Math.abs(expDate2 - expDate1);
							const expDiffDays = Math.ceil(expDiffTime / (1000 * 60 * 60 * 24)); 
							
							//offer creating date calculation
							const creationDate1 = new Date(value.created_at);
							const creationDate2 = new Date();
							const creationDiffTime = Math.abs(creationDate2 - creationDate1);
							const creationDiffDays = Math.ceil(creationDiffTime / (1000 * 60 * 60 * 24));


							// map view
							let lat = Number(value.business.latitude);
							let lng = Number(value.business.longitude);
							if(lat != 0 && lng != 0){
								locations.push({ lat : lat, lng : lng });
								initMap();
							}

							// grid view
							dealHref = "{{route('details',['name' => 'deal', 'id' => 'dealId'])}}";
							dealHref = dealHref.replace('dealId', value.id);

							businessHref = "{{route('details',['name' => 'business', 'id' => 'businessId'])}}";
							businessHref = businessHref.replace('businessId', value.business.id);
							
							// grid view
							grid_view += "<li>";
							if(expDiffDays <= 7){
								grid_view += '<p class="float-right" style="margin-right: 10px;margin-top: 10px;"><span class="badge badge-danger">Expiring soon!</span></p><br>';
							}
							if(value.popular == 1){
								grid_view += '<p class="float-right" style="margin-right: 5px;margin-top: 10px;"><span class="badge badge-warning">Popular!</span></p><br>';
							}
							if(expDiffDays >= 7 && creationDiffDays<=7){
								grid_view += '<p class="float-right" style="margin-right: 5px;margin-top: 10px;"><span class="badge badge-success">Recent!</span></p><br>';
							}
							grid_view += '<a href ="'+dealHref+'"><h4 class="place_title bebasnew">'+value.title+'</h4></a>';
							grid_view += '<h5 class="phone_call font-weight-bold">'+value.promo_code+'</h5>';
							grid_view += '<p class="phone_call"><strong>Deal organiser: <a href="'+businessHref+'">'+value.business.name+'</a></strong></p>';
							grid_view += '<p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p>';
							grid_view += '<p class="location"><strong>Reedeem before '+value.expire_date+'</strong></p>';
							
							grid_view += '<p class="history_details">'+value.description+'</p>';
							grid_view += "</li>";

							// list view
							list_view += "<li>";
							list_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"></div>';
							list_view += '<div class="list_content_wrap">';
							list_view += '<ul class="rating_coments"><li><h5><span><b>'+value.promo_code+'</b></span></h5></li>';
							if(expDiffDays <= 7){
								list_view += '<li><h5><span class="badge badge-danger text-white">Expiring soon!</span></h5></li>';
							}
							if(value.popular == 1){
								list_view += '<li><h5><span class="badge badge-warning">Popular!</span></h5></li>';
							}
							if(expDiffDays >= 7 && creationDiffDays<=7){
								list_view += '<li><h5><span class="badge badge-success">Recent!</span></h5></li>';
							}
							list_view += '</ul>';
							list_view += '<a href ="'+dealHref+'"><h4 class="place_title bebasnew">'+value.title+'</h4></a>';
							list_view += '<div class="location_details"><p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p></div>';
							list_view += '<p class="location"><strong>Deal organiser: <a href="'+businessHref+'">'+value.business.name+'</a></strong></p>';
							list_view += '<p class="location"><strong>Reedeem before '+value.expire_date+'</strong></p>';
							list_view += '<p class="history_details">'+value.description+'</p>';
							// list_view += '<a href="#"><img src=""></a>';
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
			}
		})
	}
</script>




@endsection

@endsection
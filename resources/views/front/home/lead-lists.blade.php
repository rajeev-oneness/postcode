@extends('front.home.master')

@section('title')
	Leads
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
					<li>Leads</li>
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
					  			<button class="orange-btm load_btn" id="modal" data-toggle="modal" data-target="#contact-modal">Get Quote</button>
							</div>
                            <div id="contact-modal" class="modal fade" role="dialog">
                                <div class="modal-dialog">
                                    <div class="modal-content">
                                        <div class="modal-header">
                                            <a class="close" data-dismiss="modal">×</a>
                                            <h3>Get Quote</h3>
                                        </div>
                                        <form id="contactForm">
                                            <div class="modal-body">
                                                <div class="form-group">
                                                    <label for="name">Selected Quotes</label>
                                                    <div id="quote_list">
                                                        {{-- load by ajax --}}
                                                    </div>
                                                    <div id="quote_name"></div>
                                                    <input type="hidden" name="postcodeId" id="postcodeId" value ="{{ $postcode->id }}">
                                                </div>
                                                <div class="form-group">
                                                    <label for="name">Name</label>
                                                    <input type="text" name="name" class="form-control" id="name" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="email">Email</label>
                                                    <input type="email" name="email" class="form-control" id="email" required>
                                                </div>
                                                <div class="form-group">
                                                    <label for="mobile">Phone</label>
                                                    <input type="mobile" name="mobile" class="form-control" id="mobile" required>
                                                </div>
                                                {{-- <div class="form-group">
                                                    <label for="message">Select</label>
                                                    <select class="browser-default custom-select">
                                                        <option selected>Open this select menu</option>
                                                        <option value="1">One</option>
                                                        <option value="2">Two</option>
                                                        <option value="3">Three</option>
                                                    </select>
                                                </div> --}}
                                            </div>
                                            <div class="modal-footer">
                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                <input type="submit" class="btn btn-success" id="submit">
                                            </div>
                                        </form>
                                    </div>
                                </div>
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

                            <div id="contact"><button type="button" class="btn btn-info btn" data-toggle="modal" data-target="#contact-modal">Show Contact Form</button></div>


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
$(document).ready(function(){
	$("#contactForm").submit(function(event){
        event.preventDefault();
		let params = {
            _token:'{{csrf_token()}}',
            name: $("#name").val(),
            email: $("#email").val(),
            mobile: $("#mobile").val(),
            businessId: $("#businessId").val(),
            postcodeId: $("#postcodeId").val(),
            };
        $.ajax({
            type: "POST",
            url: "{{route('getQuotes')}}",
            data: params,
            success: function(response){
                $("#contact-modal").modal('hide');
                alert("Success");
                $("#contactForm")[0].reset();
                $("#business_id").prop('checked',false);
            },
            error: function(){
                alert("Error");
            }
        });
	});
});


$("#modal").click(function(){
    var selectedQuoteId = new Array();
    var selectedQuoteName = new Array();
    $('input[name="business_id"]:checked').each(function() {
        selectedQuoteId.push(this.value);
        selectedQuoteName.push(this.getAttribute("data-name"));
    });
    // console.log(selectedQuoteName);
    quotes = "<input type='hidden' name='quote_id[]' id='businessId' value='"+selectedQuoteId+"'>";
    quoteName = "<textarea name='quote_names[]'>"+selectedQuoteName+"</textarea>";
    if(selectedQuoteId.length > 0 && selectedQuoteName.length > 0) {
        $("#quote_list").append(quotes);
        $("#quote_name").append(quoteName);
    }
});
</script>




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
								grid_view += '<p class="quote_details"><input type="checkbox" id="business_id" name="business_id" value="'+value.id+'" data-name="'+value.name+'"> Add to Quote</p>';
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

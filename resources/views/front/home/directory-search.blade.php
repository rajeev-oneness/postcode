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
				<div class="col-8">
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
					  		{{-- <h5 class="result_tab_title"> <span id="data-count"></span> results found in <a href="#">Australia</a></h5> --}}
					  		<ul class="history_list">
								{{-- load by ajax --}}
					  		</ul>
					  		<a href="#" class="orange-btm load_btn" id="load-more1">Load More</a>
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
					  			{{-- <h5 class="result_tab_title"> <span id="data-count"></span> results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p> --}}
					  		</div>
					  		<ul class="search_list_items search_list_items-mod" id="list-data">
								{{-- load by ajax --}}
					  		</ul>
					  		<a href="#" class="orange-btm load_btn" id="load-more2">Load More</a>
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
			console.log(params);
			// getting Data as per the parameters
			$.ajax({
				type:'POST',
            	url:'{{route('getBusinessByState')}}',
				data : params,
				success:function(data){
					console.log(data);
					if(data.error == false){
						if(data.data.length > 0){
							grid_view = '';
							list_view = '';
							$.each(data.data, function( index, value ) {
								// grid view
								let href = "{{route('directory',['name'=> 'business','id' => 'businessId'])}}";
								href = href.replace('businessId', value.id);
								grid_view += "<li>";
								// grid_view += '';
								grid_view += '<a href="'+href+'"><h4 class="place_title bebasnew">'+value.name+'</h4></a>'; 	
								// grid_view += "";
								grid_view += '<p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p>';
								grid_view += '';
								grid_view += '';
								grid_view += '<p class="rating"><img src="{{url('')}}/'+'homepage_assets/images/rating.png'+'">300 reviews</p>';
								grid_view += '<p class="phone_call"><img src="{{url('')}}/'+'homepage_assets/images/phone-call.png'+'">'+value.mobile+'</p>';
								grid_view += '<p class="history_details">'+value.description+'</p>';
								grid_view += "</li>";

								//list view
								list_view += "<li>";
								list_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"></div>';
								list_view += '<div class="list_content_wrap">';
								list_view += '<ul class="rating_coments"><li><img src="{{url('')}}/'+'homepage_assets/images/star.png'+'"><h5>4.5 <span>(60 reviews)</span></h5></li><li><img src="{{url('')}}/'+'homepage_assets/images/chat.png'+'"><h5><span>40 Comments</span></h5></li></ul>';
								list_view += '<h4 class="place_title bebasnew">'+value.name+'</h4>';
								list_view += '<div class="location_details"><p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p><p class="phone_call"><img src="{{url('')}}/'+'homepage_assets/images/phone-call.png'+'">'+value.mobile+'</p></div>';
								list_view += '<p class="history_details">'+value.description+'</p>';
								list_view += '<a href="'+href+'"><img src="{{url('')}}/'+'homepage_assets/images/right-arrow.png"></a>';
								list_view += "</div>"	
								list_view += "<li>";
							});
							$(".history_list").append(grid_view);
							$("#list-data").append(list_view);
							// $('#load-more1').show();
							// $('#load-more2').show();
						}else{
							$('#load-more1').html('No more data!');
							$('#load-more2').html('No more data!');
						}
					}else{
						// error handling
					}
				}
			});
		}
	});
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
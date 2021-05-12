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
					    	<a class="nav-link" id="list-tab" onclick="listView()"><img class="display-none" src="{{asset('homepage_assets/images/list-2.png')}}"></a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="gird-tab" onclick="gridView()"><img class="display-none" src="{{asset('homepage_assets/images/grid.png')}}"></a>
					  	</li>
					  	{{-- <li class="nav-item" role="presentation">
					    	<a class="nav-link" id="map-tab"><img class="display-none" src="{{asset('homepage_assets/images/map.png')}}"></a>
					  </li> --}}
					</ul>
				</div>
				<div class="search_form_wrap">
					<form action="{{route('deals')}}">
						@csrf
						<input type="hidden" name="menu" value="deals">
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
								{{-- @foreach ($deals as $deal)
									<li>
										<h4 class="place_title bebasnew">{{$deal->title}}</h4>
										<h5>{{$deal->promo_code}}</h5>
										<p class="phone_call"><strong>deal organiser: <a href="#">{{$deal->business->name}}</a></strong></p>
                                        <p class="location"><img src="{{asset('homepage_assets/images/place.png')}}">{{$deal->business->address}}</p>
										<p class="location">
                                            <strong>
                                                Expied on: {{date("d'M,y", strtotime($deal->expire_date))}} 
                                            </strong>
                                        </p>
										<p class="history_details">{{$deal->description}}</p>
									</li>
								@endforeach --}}
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
					  			{{-- <h5 class="result_tab_title"> <span id="data-count"></span> results found in <a href="#">Australia</a></h5> --}}
					  			{{-- <p>Lorem Ipsum is simply dummy text of the printing and typesetting</p> --}}
					  		</div>
					  		<ul class="search_list_items search_list_items-mod" id="list-data">
								{{-- list goes here --}}
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
						// console.log(data.data.length);
						$.each(data.data, function(index, value){
							
							dealHref = "{{route('details',['name' => 'deal', 'id' => 'dealId'])}}";
							dealHref = dealHref.replace('dealId', value.id);

							businessHref = "{{route('details',['name' => 'business', 'id' => 'businessId'])}}";
							businessHref = businessHref.replace('businessId', value.business.id);
							
							// grid view
							grid_view += "<li>";
							grid_view += '<a href ="'+dealHref+'"><h4 class="place_title bebasnew">'+value.title+'</h4></a>';
							grid_view += '<h5>'+value.promo_code+'</h5>';
							grid_view += '<p class="phone_call"><strong>Deal organiser: <a href="'+businessHref+'">'+value.business.name+'</a></strong></p>';
							grid_view += '<p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p>';
							grid_view += '<p class="location"><strong>Reedeem before '+'{{date("d M,y", strtotime('+value.expire_date+'))}}'+'</strong></p>';
							// grid_view += '<p class="rating"><img src="{{url('')}}/'+'homepage_assets/images/rating.png'+'">300 reviews</p>';
							grid_view += '<p class="history_details">'+value.description+'</p>';
							grid_view += "</li>";

							// list view
							list_view += "<li>";
							list_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"></div>';
							list_view += '<div class="list_content_wrap">';
							list_view += '<ul class="rating_coments"><h5>'+value.promo_code+'</h5></ul>';
							list_view += '<a href ="'+dealHref+'"><h4 class="place_title bebasnew">'+value.title+'</h4></a>';
							list_view += '<div class="location_details"><p class="location"><img src="{{url('')}}/'+'homepage_assets/images/place.png'+'">'+value.address+'</p></div>';
							list_view += '<p class=""><strong>Deal organiser: <a href="'+businessHref+'">'+value.business.name+'</a></strong></p>';
							list_view += '<p class="location"><strong>Reedeem before '+'{{date("d M,y", strtotime('+value.expire_date+'))}}'+'</strong></p>';
							list_view += '<p class="history_details">'+value.description+'</p>';
							list_view += '<a href="#"><img src=""></a>';
							list_view += "</div>"	
							list_view += "<li>";
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
@extends('front.home.master')

@section('title')
	Directory-list
@endsection

@section('content')

<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="index.html">Home</a></li>
					<li><img src="images/down-arrow.png"></li>
					<li><a href="index.html">Directory</a></li>
					<li><img src="images/down-arrow.png"></li>
					<li>Search Result</li>
				</ul>
			</div>
		</div>
	</div>
</section>

<section class="search_history_wrap">
	<div class="history_grid_header history_grid_header-mod">
		<div class="container">
			<div class="row">
				<div class="col-12 d-flex flex-column flex-md-row align-items-center justify-content-between">
					<ul class="nav nav-tabs" id="myTab" role="tablist">
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link active" id="list-tab" data-toggle="tab" href="#list" role="tab" aria-controls="list" aria-selected="true"><img class="display-none" src="images/list-2.png"><img class="display-block" src="images/list-active.png"></a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="gird-tab" data-toggle="tab" href="#gird" role="tab" aria-controls="gird" aria-selected="false"><img class="display-none" src="images/grid.png"><img class="display-block" src="images/active-grid.png"></a>
					  	</li>
					  	<li class="nav-item" role="presentation">
					    	<a class="nav-link" id="map-tab" data-toggle="tab" href="#map" role="tab" aria-controls="map" aria-selected="false"><img class="display-none" src="images/map.png"><img class="display-block" src="images/map-active.png"></a>
					  </li>
					</ul>
					<div class="search_form_wrap">
						<form>
							<input type="text" name="" placeholder="Seatch  by postcode">
							<button><img src="images/magnify.png"></button>
						</form>
					</div>
				</div>
			</div>
		</div>
	</div>
	<div class="history_grid_body history_grid_body-mod">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
					  	<div class="tab-pane fade show active" id="list" role="tabpanel" aria-labelledby="list-tab">
					  		<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">153 results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>
					  		<ul class="search_list_items search_list_items-mod">
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/14306.png">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">Fallon Solutions</h4>
					  					<div class="location_details">
					  						<p class="location"><img src="images/place.png">40 Journal Square Plaza, NJ</p>
						  					<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
					  					</div>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/gWzsG3.png">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">LALI’S BEAUTY & LASER </h4>
						  				<div class="location_details">
					  						<p class="location"><img src="images/place.png">40 Journal Square Plaza, NJ</p>
						  					<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
					  					</div>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/air-purifier-interior.png">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">BLOOMEX AUSTRALIA</h4>
						  				<div class="location_details">
					  						<p class="location"><img src="images/place.png">40 Journal Square Plaza, NJ</p>
						  					<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
					  					</div>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/adult-bowl-cute-daylight-1153370.png">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">NATUREL FOOD & VEG</h4>
						  				<div class="location_details">
					  						<p class="location"><img src="images/place.png">40 Journal Square Plaza, NJ</p>
						  					<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
					  					</div>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/3788840.png">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">TOTAL CARE</h4>
						  				<div class="location_details">
					  						<p class="location"><img src="images/place.png">40 Journal Square Plaza, NJ</p>
						  					<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
					  					</div>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/cards-1066386_1920.png">
					  				</div>
					  				<div class="list_content_wrap">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  					<h4 class="place_title bebasnew">CASSINO & ROMMY</h4>
						  				<div class="location_details">
					  						<p class="location"><img src="images/place.png">40 Journal Square Plaza, NJ</p>
						  					<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
					  					</div>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer took a galley of type and scrambled.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  		</ul>
					  		<a href="#" class="orange-btm load_btn">View All</a>
					  	</div>
					  	<div class="tab-pane fade" id="gird" role="tabpanel" aria-labelledby="gird-tab">
					  		<div class="result_tab_title_wrap">
					  			<h5 class="result_tab_title">153 results found in <a href="#">Australia</a></h5>
					  			<p>Lorem Ipsum is simply dummy text of the printing and typesetting</p>
					  		</div>
					  		<ul class="search_list_items">
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/14306.png">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  				</div>
					  				<div class="list_content_wrap">
					  					<h4 class="place_title bebasnew">Fallon Solutions</h4>
						  				<p class="location"><img src="images/place.png">41 Devlan St, Mansfield, QLD, 4122</p>
						  				<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/gWzsG3.png">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  				</div>
					  				<div class="list_content_wrap">
					  					<h4 class="place_title bebasnew">LALI’S BEAUTY & LASER </h4>
						  				<p class="location"><img src="images/place.png">41 Devlan St, Mansfield, QLD, 4122</p>
						  				<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/air-purifier-interior.png">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  				</div>
					  				<div class="list_content_wrap">
					  					<h4 class="place_title bebasnew">BLOOMEX AUSTRALIA</h4>
						  				<p class="location"><img src="images/place.png">41 Devlan St, Mansfield, QLD, 4122</p>
						  				<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/adult-bowl-cute-daylight-1153370.png">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  				</div>
					  				<div class="list_content_wrap">
					  					<h4 class="place_title bebasnew">NATUREL FOOD & VEG</h4>
						  				<p class="location"><img src="images/place.png">41 Devlan St, Mansfield, QLD, 4122</p>
						  				<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/3788840.png">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  				</div>
					  				<div class="list_content_wrap">
					  					<h4 class="place_title bebasnew">TOTAL CARE</h4>
						  				<p class="location"><img src="images/place.png">41 Devlan St, Mansfield, QLD, 4122</p>
						  				<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  			<li>
					  				<div class="location_img_wrap">
					  					<img src="images/cards-1066386_1920.png">
					  					<ul class="rating_coments">
					  						<li>
					  							<img src="images/star.png">
					  							<h5>4.5 <span>(60 reviews)</span></h5>
					  						</li>
					  						<li>
					  							<img src="images/chat.png">
					  							<h5><span>40 Comments</span></h5>
					  						</li>
					  					</ul>
					  				</div>
					  				<div class="list_content_wrap">
					  					<h4 class="place_title bebasnew">CASSINO & ROMMY</h4>
						  				<p class="location"><img src="images/place.png">41 Devlan St, Mansfield, QLD, 4122</p>
						  				<p class="phone_call"><img src="images/phone-call.png">(07) 3029 6321</p>
						  				<p class="history_details">Lorem Ipsum is simply dummy text of the printing and typesetting industry.</p>
						  				<a href="#"><img src="images/right-arrow.png"></a>
					  				</div>
					  			</li>
					  		</ul>
					  		<a href="#" class="orange-btm load_btn">View All</a>
					  	</div>
					  	<div class="tab-pane fade" id="map" role="tabpanel" aria-labelledby="map-tab">
					  		
					  	</div>
					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('script')

<script type="text/javascript">
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
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
					<li>Marketplace</li>
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
					    	<a class="nav-link" id="cart-tab" style="color: #000000;" title="Cart" href="{{route('product.view-cart')}}"><i class="fas fa-shopping-cart" style="font-size: 27px;"></i></a>
					  </li>
					</ul>
				</div>
				<div class="search_form_wrap">
					<form action="{{route('marketplace')}}">
						@csrf
						<input type="hidden" name="menu" value="marketplace">
						<input type="text" name="search" placeholder="Search by product name">
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
					  		</ul>
					  		<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more1">Load More</a>
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
					  		{{-- <div class="result_tab_title_wrap">
					  		</div> --}}
					  		<ul class="search_list_items search_list_items-mod" id="list-data">
					  		</ul>
					  		<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">Load More</a>
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
			url:'{{route('getmarketplace')}}',
			data:params,
			success:function(data) {
                console.log(data);
				grid_view = '';
				list_view = '';
				if(data.error == false){
					if(data.data.length > 0) {
						console.log(data.data.length);
						$.each(data.data, function(index, value){
							
							productHref = "{{route('details',['name' => 'marketplace', 'id' => 'productId'])}}";
							productHref = productHref.replace('productId', value.id);

							addToCart = "{{route('book_now.product',['id' => encrypt('productId')])}}";
							addToCart = addToCart.replace('productId', value.id);
							
							// grid view
							grid_view += "<li>";
							grid_view += '<a href ="'+productHref+'"><h4 class="place_title bebasnew">'+value.name+'</h4></a>';
							grid_view += '<h5 class="phone_call font-weight-bold" style="font-size: 1.3rem;">$'+value.price+'</h5>';
							// grid_view += '<p class="phone_call"><strong>Deal organiser: <a href=""></a></strong></p>';
							grid_view += '<p class="location"><strong>Category: </strong>'+value.category.name+'</p>';
                            grid_view += '<p class="location"><strong>Sub-category: </strong>'+value.subcategory.name+'</p>';
							grid_view += '<p class="history_details">'+value.details+'</p>';
							grid_view += '<p class="history_details"><button class="orange-btm load_btn text-center add-to-cart-btn" data-id="'+value.id+'" price="'+value.price+'" style="border-style: none;">Add To Cart</button></p>';
							grid_view += "</li>";

							// list view
							list_view += "<li>";
							list_view += '<div class="location_img_wrap"><img src="{{url('')}}/'+value.image+'"></div>';
							list_view += '<div class="list_content_wrap">';
							list_view += '<ul class="rating_coments"><h5>$ '+value.price+'</h5></ul>';
							list_view += '<a href ="'+productHref+'"><h4 class="place_title bebasnew">'+value.name+'</h4></a>';
							list_view += '<p class="location"><strong>Category: '+value.category.name+'</strong></p>';
							list_view += '<p class="location"><strong>Sub-Category: '+value.subcategory.name+'</strong></p>';
							list_view += '<p class="history_details">'+value.details+'</p>';
							list_view += '<a href="#"><img src=""></a>';
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

	$(document).on('click','.add-to-cart-btn',function(){
		var productId = $(this).attr('data-id');
		var price = $(this).attr('price');
		$.ajax({
			url: "{{route('product.add-to-cart')}}",
			method: "POST",
			data: {'_token': '{{csrf_token()}}', 'product_id': productId, 'price': price},
			success: function(data) {
				swal("Product Added!", "This product successfully added to your cart", "success");
			},
			error: function() {
				swal("Can not added to cart!", "Login/Register to use this featue", "error");
			}
		})
	});
	function addToCart() {
		alert("hi");
	}
</script>


@endsection

@endsection
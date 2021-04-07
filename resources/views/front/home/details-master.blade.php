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
	{{-- <div class="history_grid_header history_grid_header-mod">
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
	</div> --}}
	<div class="history_grid_body history_grid_body-mod">
		<div class="container">
			<div class="row">
				<div class="col-12">
					<div class="tab-content" id="myTabContent">
					  	
						@yield('details-content')

					</div>
				</div>
			</div>
		</div>
	</div>
</section>

@section('script')



@endsection

@endsection
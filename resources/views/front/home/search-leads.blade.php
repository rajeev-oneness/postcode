@extends('front.home.master')

@section('title')
	Local Leads
@endsection

@section('content')
<section class="banner" style="background: url({{asset('homepage_assets/images/banner-image.jpg')}}) no-repeat center center; background-size:cover;">
	<div class="banner-inner">
		<h1 class="banner-heading bebasnew">Discover thousands of local businesses</h1>
		<div class="search-area">
			<form action="{{route('lead.lists')}}" method="get">
			<ul class="search-list">
				<li class="postcode">
					<input type="text" list="postcodes" id="postcode" name="postcode" placeholder="Search by Postcode" onkeypress="return numericKey(event)" required>
					<datalist id="postcodes">
						@foreach ($postcodes as $postcode)
						<option value="{{$postcode->postcode}}"> {{$postcode->state->name}} </option>
						@endforeach
					  </datalist>
					<span><img src="{{asset('homepage_assets/images/place.png')}}"></span>
				</li>
                <li class="category">
					<select name="category" required>
						<option value="">Search by category</option>
						@foreach ($categories as $category)
						<option value="{{$category->id}}"> {{$category->name}} </option>
						@endforeach
					</select>
					<span><img src="{{asset('homepage_assets/images/category.png')}}"></span>
				</li>
				<li class="button">
					<input type="submit" value="Search">
				</li>
			</ul>
			</form>
		</div>
		@if (Session::has('noData'))
		<div class="alert alert-danger alert-dismissible fade show" role="alert">
			<strong>{{session('noData')}}</strong>
		  </div>
		@endif
	</div>
</section>


@section('script')

<script type="text/javascript">

function numericKey(event) {
	if(event.charCode >= 48 && event.charCode <= 57) {
		return true;
	}
	return false;
}


</script>

@endsection
@endsection

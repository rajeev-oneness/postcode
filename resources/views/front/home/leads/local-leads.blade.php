@extends('front.home.master')

@section('title')
    Local Leads
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
    <div class="container">
        <div class="col-md-12 text-center p-5">
            <section class="banner" style="background: url({{asset('homepage_assets/images/banner-image.jpg')}}) no-repeat center center; background-size:cover; height: 300px;">
                <div class="banner-inner">
                    <h1 class="banner-heading bebasnew">Search Local Leads</h1>
                    <div class="search-area">
                        <form action="{{route('lead.search.list')}}" method="get">
                        <ul class="search-list">
                            <li class="postcode">
                                <input type="text" list="postcodes" id="postcode" name="postcode" placeholder="Search by Postcode" onkeypress="return numericKey(event)">
                                <datalist id="postcodes">
                                    @foreach ($postcodes as $postcode)
                                    <option value="{{$postcode->postcode}}">
                                    @endforeach
                                  </datalist>
                                <span><img src="{{asset('homepage_assets/images/place.png')}}"></span>
                            </li>
                            <li class="category">
                                <select name="category">
                                    <option value="">Search by category</option>
                                    @foreach ($businessCategories as $category)
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
        </div>
    </div>
@endsection


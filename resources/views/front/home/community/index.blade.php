@extends('front.home.community.master')

@section('com-title')
    View
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
{{-- <li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Deal Detail</a></li> --}}
@endsection

@section('community')
{{--
<table class="table table-striped community_table table-sm">
    <thead>
      <tr>
        <!--<th scope="col">#</th>-->
        <th class="w-150 mb-1">Title</th>
        <th class="w-200 mb-1">Author</th>
        <th class="bg-transparent"></th>
      </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
      @forelse ($community as $item)
          <tr>
              <!--<td>{{$i++}}</td>-->
              <td class="border-right"><a href="{{route('community.post.detail',base64_encode($item->id))}}">{{$item->title}}</a></td>
              <td class="border-right">
                  <strong>{{$item->user->name}}</strong>
                  <span class="text-muted">(On {{date('d M,y', strtotime($item->created_at))}})</span>
              </td>
              <td class="pl-5">
                  <i class="fas fa-thumbs-up text-primary"></i> {{count($item->get_likes)}} likes &nbsp;&nbsp;
                  <i class="fas fa-comment text-warning"></i> {{count($item->comments)}} comments
              </td>
          </tr>
      @empty
          <tr class="text-center">No Data!</tr>
      @endforelse
    </tbody>
  </table>  
</div>
--}}
<section class="banner" style="background: url({{asset('homepage_assets/images/community-banner-new.jpg')}}) no-repeat center center; background-size:cover;">
	<div class="banner-inner">
		<h1 class="banner-heading bebasnew">Community</h1>
		<div class="search-area">
			<form action="{{route('search.community')}}" method="get">
			<ul class="search-list">
				<li class="postcode">
					<input type="text" id="community" name="community" placeholder="Search by Keyword">
					</datalist>
					<span><img src="{{asset('homepage_assets/images/magnify.png')}}"></span>
				</li>
				<li class="category">
					<select name="category">
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
	<div class="category-place">
		<div class="container">
			<ul class="cat-list">
				@forelse ($categories as $category)
				<li>
					<a href="{{route('community.category.show', $category->id)}}">
						{{-- <figure><img src="{{asset('').$category->icon}}"></figure> --}}
						{{$category->name}}
					</a>
				</li>
				@empty
				<li>No Data!</li>
				@endforelse
				
			</ul>
		</div>
	</div>
</section>
{{-- <li>
	<a href="#">
		<figure><img src="{{asset('homepage_assets/images/cat-list.png')}}"></figure>
		See all
	</a>
</li> --}}
<section class="white-section">
	<div class="container">
		<h2 class="main-heading">Latest Posts</h2>

		<ul class="community-list">
			@forelse ($communities as $community)
			<li>
				<div class="inner-box">
					<figure style="background:url({{asset($community->image)}}) no-repeat center center; background-size: cover;"></figure>
					<figcaption>
						<h4>
							{!! substr($community->title, 0, 100) . '...' !!}
						</h4>
						<a href="{{route('community.post.detail',base64_encode($community->id))}}" class="text-button">View More <i class="fas fa-long-arrow-alt-right"></i> </a>
					</figcaption>
				</div>
			</li>
			@empty
				<li>No Data!</li>
			@endforelse
			
		</ul>

		<a href="{{route('community.show')}}" class="primery-button orange-btm">More Community</a>


	</div>
</section>
    
@endsection

@section('community-scripts')
    
<script>
//community slider
$('.community-list').slick({
  dots: true,
  infinite: false,
  speed: 300,
  slidesToShow: 3,
  slidesToScroll: 1,
  responsive: [
    {
      breakpoint: 1024,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1,
        infinite: true,
        dots: true
      }
    },
    {
      breakpoint: 600,
      settings: {
        slidesToShow: 2,
        slidesToScroll: 1
      }
    },
    {
      breakpoint: 481,
      settings: {
        slidesToShow: 1,
        slidesToScroll: 1
      }
    }

  ]
});
</script>

@endsection
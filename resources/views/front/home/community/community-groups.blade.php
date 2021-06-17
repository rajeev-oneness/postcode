@extends('front.home.community.master')

@section('com-title')
Community Groups
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Community Groups</a></li>
@endsection

@section('community')
<section class="white-section">
	<div class="container">
		<h2 class="main-heading">Community Groups</h2>

		<ul class="community-list">
			@forelse ($community_all_groups as $item)
			<li>
				<div class="inner-box">
					<figure style="background:url({{$item->image}}) no-repeat center center; background-size: cover;"></figure>
					<figcaption>
						<h4>
							{!! substr($item->name, 0, 100) . '...' !!}
						</h4>
						<a href="{{route('community.group.detail',base64_encode($item->id))}}" class="text-button">View More <i class="fas fa-long-arrow-alt-right"></i> </a>
					</figcaption>
				</div>
			</li>
			@empty
				<li>No Data!</li>
			@endforelse
			
		</ul>

		<a href="{{route('community.add.post')}}" class="primery-button orange-btm m-3">Add Posts</a>


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
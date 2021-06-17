@extends('front.home.community.master')

@section('com-title')
My Posts
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>My Posts</a></li>
@endsection

@section('community')
<section class="white-section">
	<div class="container">
		<h2 class="main-heading">My Posts</h2>

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
                        <br>
                        @auth
                        <a href="{{route('community.edit.post',base64_encode($community->id))}}" title="Edit Post"><i class="fas fa-edit text-success"></i></a> &nbsp;&nbsp;
                        <a onclick="return confirm('Are you sure?')" href="{{route('community.delete.post',$community->id)}}" title="Delete Post"><i class="fas fa-trash text-danger"></i></a>
                        @endauth
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
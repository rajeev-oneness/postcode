@extends('front.home.master')

@section('title')
    Community-@yield('com-title')
@endsection

@section('head-script')
  <style>
    .search_list_items-mod > li .location_img_wrap > img {
      width: 390px;
    }
    .search_list_items-mod > li .list_content_wrap {
        width: calc(100% - 390px);
    }
  </style>

  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection


@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{{route('default.homepage')}}">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					@yield('brd_name')
				</ul>
			</div>
		</div>
	</div>
</section>

<!-- <div class="container">
    <h2 class="mt-5 main-heading"> <a href="{{route('community.show')}}" style="color:black;">Community board</a></h2>
    @auth
    <a href="{{route('community.my.post')}}" class="primery-button orange-btm mr-auto">My Posts</a>
    <a href="{{route('community.add.post')}}" class="primery-button orange-btm m-3">Add Posts</a>
    <a href="{{route('community.my.groups')}}" class="primery-button orange-btm m-3">My Groups</a>
    @endauth
    @guest
		<a href="{{route('adminlogin')}}" class="primery-button orange-btm mr-auto">Login</a>
    @endguest
		<a href="{{route('community.all.groups')}}" class="primery-button orange-btm m-3">Community Groups</a>
    <div class="row my-5">
      <div class="col-sm-2">
        <div class="list-group">
          <a href="{{route('community.category.show', 1)}}" class="list-group-item list-group-item-action">Tips</a>
          <a href="{{route('community.category.show', 2)}}" class="list-group-item list-group-item-action">Ideas</a>
          <a href="{{route('community.category.show', 3)}}" class="list-group-item list-group-item-action">Category 3</a>
          <a href="{{route('community.category.show', 4)}}" class="list-group-item list-group-item-action">Category 4</a>
          <a href="{{route('community.category.show', 5)}}" class="list-group-item list-group-item-action">Category 5</a>
          <a href="{{route('community.category.show', 6)}}" class="list-group-item list-group-item-action">Other Topics</a>
        </div>
      </div>
      <div class="col-sm-10 border border-dark">
        @yield('community')
      </div>
    </div>
</div> -->


<div class="community-banner" style="background:url('{{asset('homepage_assets/images/community-banner.jpg')}}')">
  <div class="text-center">
    <img src="{{asset('homepage_assets/images/community-logo.png')}}">
    <h1 class="comm-heading">OUR POSTCODE COMMUNITY</h1>
  </div>
</div>

<section class="community-details">
  <div class="left-community">
    <ul>
      <li><a href="#">Accommodation</a></li>
      <li><a href="#">Food & Beverages</a></li>
      <li><a href="#">Religion</a></li>
      <li><a href="#">Government</a></li>
      <li><a href="#">Adult</a></li>
      <li><a href="#">Restaurants</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Government</a></li>
      <li><a href="#">Adult</a></li>
      <li><a href="#">Restaurants</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Government</a></li>
      <li><a href="#">Adult</a></li>
      <li><a href="#">Restaurants</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Automotive</a></li>
      <li><a href="#">Automotive</a></li>
    </ul>
  </div>
  <div class="details-community">
    <h2 class="heading-content">Connect with your Community</h2>
    <p>Aenean sollicitudin, lorem quis bibendum auctor, nisi elit consequat ipsum, nec sagittis sem nibh id elit. Duis sed odio sit amet nibh vulputate cursus a sit amet mauris. Morbi accumsan ipsum velit. Nam nec tellus a odio tincidunt auctor a ornare odio. Sed non  mauris vitae erat consequat auctor eu in elit. Class aptent taciti sociosqu ad litora torquent per conubia nostra, per inceptos himenaeos. Mauris in erat justo. Nullam ac urna eu felis dapibus condimentum sit amet a augue. Sed non neque elit. Sed ut imperdiet nisi. Proin condimentum fermentum nunc. Etiam pharetra, erat sed fermentum feugiat, velit mauris egestas quam, ut aliquam massa nisl quis neque. Suspendisse in orci enim.</p>
    
    <div class="mt-5 mb-5">
      <img class="comm-pic" src="{{asset('homepage_assets/images/com-detailsimage.jpg')}}">
    </div>

    <div class="comments-area">
      <h3>Comments</h3>

      <div class="cover-comments">
        <div class="client-image">
          <img src="{{asset('homepage_assets/images/comments-clients.png')}}">
        </div>
        <div class="details-client">
          <div class="client-details">
            <h4>JOHN DOE</h4>
            <p class="date"><span><img src="{{asset('homepage_assets/images/calender.png')}}"></span>18 . 10 . 2020</p>
            <p class="time"><span><img src="{{asset('homepage_assets/images/clock.png')}}"></span>12 : 30 PM</p>
          </div>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
        </div>
      </div>


      <div class="cover-comments">
        <div class="client-image">
          <img src="{{asset('homepage_assets/images/comments-clients.png')}}">
        </div>
        <div class="details-client">
          <div class="client-details">
            <h4>JOHN DOE</h4>
            <p class="date"><span><img src="{{asset('homepage_assets/images/calender.png')}}"></span>18 . 10 . 2020</p>
            <p class="time"><span><img src="{{asset('homepage_assets/images/clock.png')}}"></span>12 : 30 PM</p>
          </div>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
        </div>
      </div>

      <div class="cover-comments">
        <div class="client-image">
          <img src="{{asset('homepage_assets/images/comments-clients.png')}}">
        </div>
        <div class="details-client">
          <div class="client-details">
            <h4>JOHN DOE</h4>
            <p class="date"><span><img src="{{asset('homepage_assets/images/calender.png')}}"></span>18 . 10 . 2020</p>
            <p class="time"><span><img src="{{asset('homepage_assets/images/clock.png')}}"></span>12 : 30 PM</p>
          </div>
          <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's.</p>
        </div>
      </div>


    </div>


    <div class="reply-part mt-5 mb-5">
      <h4>Leave A Reply</h4>
      <p>Your Email Address Will Not Be Published. Required Fields Are Marked</p>
      <textarea placeholder="Comment" rows="3"></textarea>
      <input class="leave-comments" type="submit" value="Leave a comment">
    </div>


  </div>
</section>


@endsection

@section('script')
@yield('community-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    @if(Session::has('Success'))
        swal('Success','{{Session::get('Success')}}', 'success');
    @elseif(Session::has('Errors'))
        swal('Error','{{Session::get('Errors')}}', 'error');
    @endif
</script>
@endsection


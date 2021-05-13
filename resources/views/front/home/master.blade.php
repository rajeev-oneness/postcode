<!DOCTYPE html>
<html lang="en">
<head>
  <title>Our postcode | @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <meta name="csrf-token" content="{{ csrf_token() }}">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="icon" href="{{asset('homepage_assets/images/logo.png')}}" sizes="16x16">
  <link rel="stylesheet" href="{{asset('homepage_assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('homepage_assets/css/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('homepage_assets/css/slick-theme.css')}}"/>
  <link rel="stylesheet" href="{{asset('homepage_assets/css/style.css')}}">
	<style>
		a {
			margin-left: 0px !important;
		}
	</style>
	<script src="https://unpkg.com/@googlemaps/markerclustererplus/dist/index.min.js"></script>

	@yield('head-script')
</head>
<body>
<header>
	<a href="{{route('default.homepage')}}" class="logo">
		<img src="{{asset('homepage_assets/images/logo.png')}}">
	</a>
	<div class="left-header">
		<div class="navigation">
			<ul class="menu">
				<li><a href="{{route('default.homepage')}}">Home</a></li>
				<li><a href="#">Postcodes <span><i class="fas fa-chevron-down"></i></span> </a>
					<ul>
						<li><a href="{{route('directory', ['stateId' => 1])}}">Queensland</a></li>
						<li><a href="{{route('directory', ['stateId' => 2])}}">Victoria</a></li>
						<li><a href="{{route('directory', ['stateId' => 3])}}">New South Wales</a></li>
						<li><a href="{{route('directory', ['stateId' => 4])}}">Tasmania</a></li>
						<li><a href="{{route('directory', ['stateId' => 5])}}">South Australia</a></li>
						<li><a href="{{route('directory', ['stateId' => 6])}}">Western Australia</a></li>
						<li><a href="{{route('directory', ['stateId' => 7])}}">Northern Territory</a></li>
						<li><a href="{{route('directory', ['stateId' => 8])}}">Australian Capital Territory </a></li>
					</ul>
				</li>
				<li><a href="{{route('directory')}}">Directory</a></li>
				<li><a href="{{route('events')}}">Events </a></li>
				<li><a href="{{route('marketplace')}}">Marketplace</a></li>
				<li><a href="{{route('deals')}}">Deals </a></li>
				<li><a href="{{route('community.show')}}">Community </a></li>
				{{-- <li><a href="#">Local Leads</a></li>
				<li><a href="#">Resources</a></li> --}}
				<li><a href="{{route('about-us')}}">About Us <span><i class="fas fa-chevron-down"></i></span> </a>
					<ul>
						<li><a href="{{route('faq')}}">FAQs</a></li>
					</ul>

				</li>
				<li><a href="{{route('contact-us')}}">Contact Us</a></li>
			</ul>
		</div>
		<ul class="button-list">
			@if (auth()->check())	
				@if (auth()->user()->userType == 2)
					<li>
						<a href="{{route('user.newsfeed')}}">
							<span><img src="{{asset('user_assets/image/log-icon.png')}}"></span>
							User Profile
						</a>
					</li>
				@elseif (auth()->user()->userType == 3)
					<li>
						<a href="{{route('business.dashboard')}}">
							<span><img src="{{asset('user_assets/image/log-icon.png')}}"></span>
							Business Admin
						</a>
					</li>
				@endif
			@endif

			@auth
			<li>
				<a href="{{route('logout')}}">
					<span><img src="{{asset('homepage_assets/images/login-icon.png')}}"></span>
					Logout
				</a>
			</li>	
			@else
			<li>
				<a href="{{route('adminlogin')}}">
					<span><img src="{{asset('homepage_assets/images/login-icon.png')}}"></span>
					Login
				</a>
			</li>
			<li>
				<a href="{{route('user.welcome')}}">
					<span><img src="{{asset('homepage_assets/images/listing-icon.png')}}"></span>
					Sign Up
				</a>
			</li>
			@endauth
		</ul>
		<div class="ham">
			<span></span>
			<span></span>
			<span></span>
		</div>
	</div>

</header>

@yield('content')


<section class="newsletter-section">
	<div class="container">
        <div class="row align-items-center">
            <div class="col-md-6">
                <h2 class="main-heading">Subscribe For a Newsletter</h2>
                <p>Whant to be notified about new locations ? Just sign up.</p>
            </div>
            <div class="col-md-6">
                @if (Session::has('newsletter'))
                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                        <strong>{{session('newsletter')}}</strong>
                        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
                        <span aria-hidden="true">&times;</span>
                        </button>
                    </div>
                @endif
                <form method="post" action="{{route('newsletter')}}" class="news">
                    @csrf
                    <input type="text" name="email" value="{{old('email')}}" id="usr" placeholder="Enter your email" required>
                    {{-- <input type="submit" class="submt_form" value="Send"> --}}
					<input type="submit" id="43t" value="Send">
                    
                </form>
            </div>
			@error('email')
				<div class="col-md-6"></div>
                <div class="alert alert-danger alert-dismissible fade show mt-1 col-md-6" role="alert">
                    <strong>{{$message}}</strong>
                </div>
            @enderror
        </div>
    </div>
</section>
<footer>
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-md-4">
				<a href="{{route('default.homepage')}}" class="footer-logo">
					<img src="{{asset('homepage_assets/images/logo.png')}}">
				</a>
				<p>
					Award-winning, in-store coffee roastery, coffee bean boutique and sydney cbd cafe. VELLA NERO is a one stop shop for all thing coffee.
				</p>
			</div>
			<div class="col-md-2">
				<h3 class="footer-heading">State</h3>
				<ul class="footer-list">
					<li><a href="{{route('directory', ['stateId' => 1])}}">Queensland</a></li>
					<li><a href="{{route('directory', ['stateId' => 2])}}">Victoria</a></li>
					<li><a href="{{route('directory', ['stateId' => 3])}}">New South Wales</a></li>
					<li><a href="{{route('directory', ['stateId' => 4])}}">Tasmania</a></li>
					<li><a href="{{route('directory', ['stateId' => 5])}}">South Australia</a></li>
					<li><a href="{{route('directory', ['stateId' => 6])}}">Western Australia</a></li>
					<li><a href="{{route('directory', ['stateId' => 7])}}">Northern Territory</a></li>
					<li><a href="{{route('directory', ['stateId' => 8])}}">Australian Capital Territory </a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<h3 class="footer-heading">Products</h3>
				<ul class="footer-list">
					<li><a href="{{route('events')}}">Events</a></li>
					<li><a href="{{route('directory')}}">Directory</a></li>
					<li><a href="{{route('marketplace')}}">Marketplace</a></li>
					{{-- <li><a href="#">Leads</a></li> --}}
					<li><a href="{{route('deals')}}">Deals</a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<h3 class="footer-heading">Other</h3>
				<ul class="footer-list">
					{{-- <li><a href="#">Resources</a></li> --}}
					<li><a href="{{route('about-us')}}">About Us</a></li>
					<li><a href="{{route('contact-us')}}">Contact Us</a></li>
					{{-- <li><a href="#">Social Media</a></li> --}}
					<li><a href="{{route('default.homepage')}}">Advertise</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="copyright">© 2021 Our Postcode. All Rights Reserved.</div>
</footer>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script
 src="https://maps.googleapis.com/maps/api/js?key=AIzaSyDPuZ9AcP4PHUBgbUsT6PdCRUUkyczJ66I&callback=initMap&libraries=&v=weekly"
      async
    ></script>
{{-- <script src="js/jquery.min.js"></script> --}}
<script src="{{asset('homepage_assets/js/popper.min.js')}}"></script>
<script src="{{asset('homepage_assets/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('homepage_assets/js/slick.min.js')}}"></script>

@yield('script')

</body>
</html>
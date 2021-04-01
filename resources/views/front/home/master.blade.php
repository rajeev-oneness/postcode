<!DOCTYPE html>
<html lang="en">
<head>
  <title>Our postcode | @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{asset('homepage_assets/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('homepage_assets/css/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('homepage_assets/css/slick-theme.css')}}"/>
  <link rel="stylesheet" href="{{asset('homepage_assets/css/style.css')}}">

</head>
<body>
<header>
	<a href="#" class="logo">
		<img src="{{asset('homepage_assets/images/logo.png')}}">
	</a>
	<div class="left-header">
		<div class="navigation">
			<ul class="menu">
				<li><a href="{{route('default.homepage')}}">Home</a></li>
				<li><a href="#">Postcodes <span><i class="fas fa-chevron-down"></i></span> </a>
					<ul>
						<li><a href="{{route('state.postcodes.menu', 1)}}">Queensland</a></li>
						<li><a href="{{route('state.postcodes.menu', 2)}}">Victoria</a></li>
						<li><a href="{{route('state.postcodes.menu', 3)}}">New South Wales</a></li>
						<li><a href="{{route('state.postcodes.menu', 4)}}">Tasmania</a></li>
						<li><a href="{{route('state.postcodes.menu', 5)}}">South Australia</a></li>
						<li><a href="{{route('state.postcodes.menu', 6)}}">Western Australia</a></li>
						<li><a href="{{route('state.postcodes.menu', 7)}}">Northern Territory</a></li>
						<li><a href="{{route('state.postcodes.menu', 8)}}">Australian Capital Territory </a></li>
					</ul>
				</li>
				<li><a href="#">Directory</a></li>
				<li><a href="#">Events </a></li>
				<li><a href="#">Marketplace</a></li>
				<li><a href="#">Deals </a></li>
				<li><a href="#">Local Leads</a></li>
				<li><a href="#">Resources</a></li>
				<li><a href="#">About Us <span><i class="fas fa-chevron-down"></i></span> </a>
					<ul>
						<li><a href="#">FAQs</a></li>
					</ul>

				</li>
				<li><a href="#">Contact Us</a></li>
			</ul>
		</div>
		<ul class="button-list">
			<li>
				<a href="{{route('login')}}">
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
				<form id="" action="" class="news">
					<input type="text" id="usr" placeholder="Enter your email">
					<input type="submit" id="43t" value="Send">
				</form>
			</div>
		</div>
	</div>
</section>
<footer>
	<div class="container">
		<div class="row justify-content-between">
			<div class="col-md-4">
				<a href="#" class="footer-logo">
					<img src="{{asset('homepage_assets/images/logo.png')}}">
				</a>
				<p>
					Award-winning, in-store coffee roastery, coffee bean boutique and sydney cbd cafe. VELLA NERO is a one stop shop for all thing coffee.
				</p>
			</div>
			<div class="col-md-2">
				<h3 class="footer-heading">State</h3>
				<ul class="footer-list">
					<li><a href="{{route('state.postcodes.menu', 1)}}">Queensland</a></li>
					<li><a href="{{route('state.postcodes.menu', 2)}}">Victoria</a></li>
					<li><a href="{{route('state.postcodes.menu', 3)}}">New South Wales</a></li>
					<li><a href="{{route('state.postcodes.menu', 4)}}">Tasmania</a></li>
					<li><a href="{{route('state.postcodes.menu', 5)}}">South Australia</a></li>
					<li><a href="{{route('state.postcodes.menu', 6)}}">Western Australia</a></li>
					<li><a href="{{route('state.postcodes.menu', 7)}}">Northern Territory</a></li>
					<li><a href="{{route('state.postcodes.menu', 8)}}">Australian Capital Territory </a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<h3 class="footer-heading">Products</h3>
				<ul class="footer-list">
					<li><a href="#">Events</a></li>
					<li><a href="#">Directory</a></li>
					<li><a href="#">Marketplace</a></li>
					<li><a href="#">Leads</a></li>
					<li><a href="#">Deals</a></li>
				</ul>
			</div>
			<div class="col-md-2">
				<h3 class="footer-heading">Other</h3>
				<ul class="footer-list">
					<li><a href="#">Resources</a></li>
					<li><a href="#">About Us</a></li>
					<li><a href="#">Contact Us</a></li>
					<li><a href="#">Social Media</a></li>
					<li><a href="#">Advertise</a></li>
				</ul>
			</div>
		</div>
	</div>
	<div class="copyright">© 2021 Our Postcode. All Rights Reserved.</div>
</footer>



<script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
<script src="js/jquery.min.js"></script>
<script src="js/popper.min.js"></script>
<script src="js/bootstrap.min.js"></script>
<script type="text/javascript" src="js/slick.min.js"></script>

@yield('script')

</body>
</html>
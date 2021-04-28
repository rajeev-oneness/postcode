<!DOCTYPE html>
<html lang="en">
<head>
  <title>Our postcode | @yield('title')</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{asset('business_user_asset/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('business_user_asset/css/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('business_user_asset/css/slick-theme.css')}}"/>
  <link rel="stylesheet" href="{{asset('business_user_asset/css/style.css')}}">
<script src="{{asset('business_user_asset/js/jquery.min.js')}}"></script>

</head>
<body class="bg-lightgray">

<header>
  <nav class="mnb navbar navbar-default fixed-top topnav">
    <div class="container-fluid">
      <div class="navbar-header">
        <!-- <button type="button" class="navbar-toggle collapsed" data-toggle="collapse" data-target="#navbar" aria-expanded="false" aria-controls="navbar">
          <span class="sr-only">Toggle navigation</span>
          <i class="ic fa fa-bars"></i>
        </button> -->
        <div>
           <a href="#" id="msbo" class="menuIcon"><i class="ic fa fa-bars"></i></a>
           <a href="#" class="admin-brand"><img src="{{asset('business_user_asset/images/admin-logo.png')}}" class="img-fluid"></a>
        </div>
      </div>
      <div id="navbar" class="top-rightmenu">
        <ul class="navbar-nav ml-aoto">
          <li>
            <a href="#"><i class="far fa-bell"></i></a>
            <span class="count-noti">
              50
            </span>
          </li>
          <li><a href="#"><i class="fas fa-cog"></i></a></li>
        </ul>
      </div>
    </div>
  </nav>
  <!--msb: main sidebar-->
  <div class="msb" id="msb">
      <nav class="navbar navbar-default" role="navigation">
        <!-- Brand and toggle get grouped for better mobile display -->
        <div class="navbar-header">
          <div class="brand-wrapper">
            <!-- Brand -->
            <div class="brand-name-wrapper">
              <div class="user-profile-pic">
                <img src="{{asset('business_user_asset/images/c2.jpg')}}">
              </div>
              <h6>{{auth()->user()->name}}</h6>
              <ul class="left-menuadd">
                {{-- style="white-space: normal;" --}}
                <li><i class="fas fa-map-marker-alt"></i> {{auth()->user()->address}}</li>
                <li><i class="far fa-envelope"></i> {{auth()->user()->email}}</li>
                {{-- <li><i class="fas fa-phone-alt"></i> 80-600-800</li> --}}
              </ul>
              <div class="social-div text-center">
                <ul>
                  <li><a href=""><i class="fab fa-facebook-f"></i></a></li>
                  <li><a href=""><i class="fab fa-twitter"></i></a></li>
                  <li><a href=""><i class="fab fa-instagram"></i></a></li>
                  <li><a href=""><i class="fab fa-youtube"></i></a></li>
                </ul>
                <div>
                    <div class="mb-2"><a href="{{route('user.settings')}}" class="pro-edit"><i class="fas fa-cog"></i> Settings</a></div>
                    <div><a href="{{route('logout')}}" class="pro-edit"><i class="fas fa-sign-out-alt"></i> LOGOUT</a></div>
                </div>
              </div>
            </div>
  
          </div>
  
        </div>
  
        <!-- Main Menu -->
        <div class="side-menu-container">
          <ul class="nav navbar-nav">
            <li><a href="{{route('default.homepage')}}"><i class="fas fa-home"></i>Homepage</a></li>
            <li class="active"><a href="{{route('user.newsfeed')}}"><i class="far fa-newspaper"></i>Nesfeed</a></li>
            <li><a href="{{route('user.message.portal')}}"><i class="far fa-comment-dots"></i> Messaging</a></li>
            <li><a href="{{route('user.rating')}}"><i class="far fa-star"></i>Reviews</a></li>
            <li><a href="{{route('user.deal')}}"><i class="fas fa-percent"></i>Deals</a></li>
            {{-- <li><a href=""><i class="fas fa-calendar-alt"></i>Market place</a></li> --}}
            <li><a href="{{route('user.calender')}}"><i class="fas fa-calendar-alt"></i>Event Calendar</a></li>
          </ul>
        </div><!-- /.navbar-collapse -->
      </nav>  
  </div>
  
  <!--main content wrapper-->
  <div class="mcw">
    <div class="container-fluid pl-4">
        <div class="row m-0">
            <div class="col-12">
              <div class="card border-0">
                <div class="card-body p-0">
                  @yield('tab-link')
                  <div class="tab-content p-4" id="myTabContent">
                    @yield('content')
                  </div>
                </div>
              </div>
            </div>
        </div>
    </div>
  </div><!--end-main content wrapper-->

  @include('user-portal.message')
</header>

<!--Script-->

<script src="{{asset('business_user_asset/js/jquery.min.js')}}"></script>
<script src="{{asset('business_user_asset/js/popper.min.js')}}"></script>
<script src="{{asset('business_user_asset/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('business_user_asset/js/slick.min.js')}}"></script>
<script src="{{asset('business_user_asset/js/custom.js')}}"></script>

@yield('script')



</body>
</html>
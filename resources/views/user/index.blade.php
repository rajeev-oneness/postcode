<!doctype html>
<html lang="en">
  <head>
    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">

    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="{{asset('user_assets/css/bootstrap.min.css')}}">
    <link rel="stylesheet" href="{{asset('user_assets/css/style.css')}}">
    <link rel="stylesheet" href="https://use.fontawesome.com/releases/v5.7.2/css/all.css">
    <link rel="stylesheet" type="text/css" href="{{asset('user_assets/css/slick.css')}}"/>
    <link rel="stylesheet" type="text/css" href="{{asset('user_assets/css/slick-theme.css')}}"/>

    

    <title>Our Postcode</title>
  </head>
  <body>

    <section class="banner_wraper">
        <div class="container">
            <div class="menu_wrap">
                <a href="{{route('user.welcome')}}" class="logo_icon"><img src="{{asset('user_assets/image/logo.png')}}"></a>
                <ul class="menu_icon">
                    <li>
                        <a href="{{route('default.homepage')}}">
                            {{-- <img src="{{asset('user_assets/image/log-icon.png')}}"> --}}
                            Homepage
                        </a>
                    </li>
                    @if (auth()->check())
                    <li>
                        <a href="{{route('logout')}}">
                            {{-- <img src="{{asset('user_assets/image/log-icon.png')}}"> --}}
                            Logout
                        </a>
                    </li>
                        @if (auth()->user()->userType == 2)
                            <li>
                                <a href="{{route('user.newsfeed')}}">
                                    {{-- <img src="{{asset('user_assets/image/log-icon.png')}}"> --}}
                                    User Profile
                                </a>
                            </li>
                            {{-- <li>
                                <a href="{{route('business.manage')}}">
                                    Business
                                </a>
                            </li> --}}
                            
                        @endif
                        @if (auth()->user()->userType == 1)
                            <li>
                                <a href="{{route('admin.dashboard')}}">
                                    {{-- <img src="{{asset('user_assets/image/log-icon.png')}}"> --}}
                                    Admin Dashboard
                                </a>
                            </li>
                        @endif
                    @else
                        <li>
                            <a href="{{route('adminlogin')}}">
                                {{-- <img src="{{asset('user_assets/image/log-icon.png')}}"> --}}
                                Log in
                            </a>
                        </li>
                    @endif  
                </ul>
            </div>
            <div class="col-12">
                <div class="banner_inner">
                    <h1 class="banner_title font-bebas text-center text-white">OUR POSTCODE</h1>
                    <h2 class="banner_title2 text-center text-white">Where Local Matters</h2>
                    <p class="banner_content text-center text-white">Australia’s Newest Website to Help Local Businesses Promote <br>Achieve Marketing Success</p>
                    <div class="btn_grp text-center">
                    <a href="{{route('adminsignup')}}" id="sign_mannually" class="orange_btn">SIGN UP MANUALLY</a>
                        <a href="{{route('GMBsignup')}}" class="blue_btn"><img src="{{asset('user_assets/image/Google-mybusiness-1.png')}}"> SIGN UP VIA GOOGLE MY BUSINESS</a>
                    
                        <!-- <a href="{{route('adminsignup')}}" id="sign_mannually" class="orange_btn">SIGN UP MANUALLY</a>
                        <a href="{{route('adminsignup')}}" class="blue_btn"><img src="{{asset('user_assets/image/Google-mybusiness-1.png')}}"> SIGN UP VIA GOOGLE MY BUSINESS</a> -->
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature_wrapper">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-12 col-md-8 text-center">
                    <h2 class="section_title text-center">TOP features</h2>
                    <p class="section_content">Donec orci nisl, porttitor vel consequat vitae, aliquet vel sapien. Sed et posuere libero, in vulputate nibh sed ut ornare dolor liquam nisi enim.</p>
                </div>
                <div class="col-12">
                    <ul class="feature_list">
                        <li>
                            <img src="{{asset('user_assets/image/online-ads-concept-illustration_114360-5188.png')}}">
                            <h5>ADVERTISE YOUR BUSINESS</h5>
                            <p>When designing a new business website, there are certain things you have to keep in mind. Style, layout and accessibility all have their roles to play in helping it look slick, so let’s take a look at them now. Time to get your business online and looking fine!</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                        <li>
                            <img src="{{asset('user_assets/image/colleagues-working-together-workflow-organization-effective-task-planning.png')}}">
                            <h5>VIEW EVENTS IN YOUR AREA</h5>
                            <p>When designing a new business web-site, there are certain...</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                        <li>
                            <img src="{{asset('user_assets/image/employees-giving-hands-helping.png')}}">
                            <h5>CONNECT WITH YOUR COMMUNITY</h5>
                            <p>When designing a new business web-site, there are certain things....</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                        <li>
                            <img src="{{asset('user_assets/image/feedback-isometric-illustration-customers.png')}}">
                            <h5>REVIEW LOCAL BUSINESS</h5>
                            <p>When designing a new business website, there are certain things you have to keep in mind. Style, layout and accessibility all have their roles to play in helping it look slick, so let’s take a look at them now. Time to get your business online and looking fine!</p>
                            <a href="#" class="orange_text_link">LEARN MORE</a>
                        </li>
                    </ul>
                </div>
                <div class="col-12 text-center">
                    <a href="#" class="orange_btn text-capitalize">More Features</a>
                </div>
            </div>
        </div>
    </section>

    <section class="newsletter_wraper">
        @include('user.newsletter')
    </section>



<script>

 

  

</script>


    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <!-- latest jquery-->
    <script src="{{asset('user_assets/js/jquery-3.2.1.min.js')}}"></script>
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="{{asset('user_assets/js/bootstrap.min.js')}}"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{asset('user_assets/js/slick.min.js')}}"></script>
  </body>
</html>
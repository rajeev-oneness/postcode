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
                        <a href="{{route('adminsignup')}}">
                            <img src="{{asset('user_assets/image/log-icon.png')}}">
                            Sign up
                        </a>
                    </li>
                    <li>
                        <a href="#">
                            <img src="{{asset('user_assets/image/save-icon.png')}}">
                            Saved Details
                        </a>
                    </li>
                </ul>
            </div>
            <div class="row">
                <div class="col-12 col-md-6">
                    <div class="banner_inner">
                        <h2 class="banner_title font-bebas text-white">OUR POSTCODE</h2>
                        <h2 class="banner_title2 text-white">Where Local Matters</h2>
                        <p class="banner_content text-white">Australia’s Newest Website to Help Local Businesses Promote Achieve Marketing Success</p>
                    </div>
                </div>
                <div class="col-12 col-md-6">
                    <div class="form_wrapper">
                        <img src="{{asset('user_assets/image/form-border.png')}}" class="form_bg">
                        <form>
                            <div class="search_wrap">
                                <input type="search" name="" placeholder="Search business via keyword...">
                                <button class="search_btn"><img src="{{asset('user_assets/image/search.png')}}"></button>
                            </div>
                        </form>
                            <a href="#" class="buisness_signup"><img src="{{asset('user_assets/image/Google-mybusiness-1.png')}}">sign up via google my business</a>
                           
                            <form class="needs-validation" method="post" name="" action="{{route('admin.add_userbusiness')}}" enctype="multipart/form-data" novalidate>
                                {{csrf_field()}}
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/Science-Business-icon.png')}}">
                                <label>BUSINESS NAME</label>
                                <input type="text" name="name" id="name"  class="textbox">
                               
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/abn.png')}}">
                                <label>ABN</label>
                                <input type="text" name="abn" id="abn"  class="textbox">
                                
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/team.png')}}">
                                <label>COMPANY WEBSITE</label>
                                <input type="text" name="company_website" id="company_website" class="textbox">
                             
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/email-icon.png')}}">
                                <label>EMAIL ADDRESS</label>
                                <input type="email" name="email" id="email"  class="textbox">
                              
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/Science-Business-icon.png')}}">
                                <label>PHONE NO.</label>
                                <input type="text" name="mobile" id="mobile"  class="textbox">
                               
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/upload.png')}}">
                                <label>UPLOAD AN IMAGE</label>
                                <input type="file" name="image" id="image"  class="textbox">
                              
                                <button class="img_upload">BROWSE</button>
                            </div>
                            <div class="sign_in_form">
                                <img src="{{asset('user_assets/image/clock.png')}}">
                                <label>opening hours</label>
                                <input type="text" name="open_hour"  id="open_hour" class="textbox">
                                
                            </div>
                            <div class="form_btn-grp">
                                <a href="{{route('user.welcome')}}" class="back_btn">back</a>
                                <input type="submit" class="form_submit" name="" value="SUBMIT">
                            </div>
                        </form>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <section class="feature_wrapper feature_wrapper-mod">
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
        <div class="container">
            <div class="row">
                <div class="col-12 col-md-6">
                    <h3 class="newswrap_title">Subscribe For a Newsletter</h3>
                    <p class="newswrap_content">Whant to be notified about new locations ? Just sign up.</p>
                </div>
                <div class="col-12 col-md-6">
                    <form class="newsletter_form">
                        <input type="email" name="" placeholder="Enter your email">
                        <input type="submit" class="submt_form" value="Send">
                    </form>
                </div>
            </div>
        </div>
    </section>

    <!-- Optional JavaScript -->
    <!-- jQuery first, then Popper.js, then Bootstrap JS -->
    <script src="https://code.jquery.com/jquery-3.5.1.slim.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"></script>
    <script src="js/bootstrap.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-1.11.0.min.js"></script>
    <script type="text/javascript" src="https://code.jquery.com/jquery-migrate-1.2.1.min.js"></script>
    <script type="text/javascript" src="{{asset('user_assets/js/slick.min.js')}}"></script>
    <script>
        $('.textbox').on('keyup keydown keypress change paste', function() {   
            if ($(this).val() == '') { 
                $(this).parent().removeClass('label_up'); 
            } else {
                $(this).parent().addClass('label_up'); 
            }
        });
    </script>
  </body>
</html>
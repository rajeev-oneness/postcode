
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('admin_assets/images/favicon.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('admin_assets/images/favicon.png')}}" type="image/x-icon">
    
    <!-- Google font-->
    <link href="https://fonts.googleapis.com/css?family=Work+Sans:100,200,300,400,500,600,700,800,900" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Nunito:200,200i,300,300i,400,400i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css?family=Poppins:100,100i,200,200i,300,300i,400,400i,500,500i,600,600i,700,700i,800,800i,900,900i" rel="stylesheet">
    <!-- Font Awesome-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/fontawesome.css')}}">
    <!-- ico-font-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/icofont.css')}}">
    <!-- Themify icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/themify.css')}}">
    <!-- Flag icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/flag-icon.css')}}">
    <!-- Feather icon-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/feather-icon.css')}}">
    <!-- Plugins css start-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/chartist.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/prism.css')}}">
    <!-- Plugins css Ends-->
     <!-- Plugins css start-->
     <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/datatables.css')}}">
     <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/daterange-picker.css')}}">
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('admin_assets/css/light-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/responsive.css')}}">
<!-- Font Awesome CDN-->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">

    <!-- latest jquery-->
    <script src="{{asset('admin_assets/js/jquery-3.2.1.min.js')}}"></script>
  </head>
  <body>
    <!-- Loader starts-->
    <div class="loader-wrapper">
      <div class="loader bg-white">
        <div class="whirly-loader"> </div>
      </div>
    </div>
    <!-- Loader ends-->
    <!-- page-wrapper Start-->
    <div class="page-wrapper">
      <!-- Page Header Start-->
      <div class="page-main-header">
        <div class="main-header-right row">
          <div class="main-header-left d-lg-none">
            <div class="logo-wrapper"><a href="index.html"><img src="{{asset('admin_assets/images/endless-logo.png')}}" alt=""></a></div>
          </div>
          <div class="mobile-sidebar d-block">
            <div class="media-body text-right switch-sm">
              <label class="switch"><a href="#"><i id="sidebar-toggle" data-feather="align-left"></i></a></label>
            </div>
          </div>
          <div class="nav-right col p-0">
            <ul class="nav-menus">
              
              <li><a class="text-dark" href="#!" onclick="javascript:toggleFullScreen()"><i data-feather="maximize"></i></a></li>
            
             
              <li class="onhover-dropdown">
                <div class="media align-items-center"><img class="align-self-center pull-right img-50 rounded-circle" src="{{asset('admin_assets/images/dashboard/user.png')}}" alt="header-user">
                  <div class="dotted-animation"><span class="animate-circle"></span><span class="main-circle"></span></div>
                </div>
                <ul class="profile-dropdown onhover-show-div p-20">
                  <li><a href="#"><i data-feather="log-out"></i>Logout</a></li>
                </ul>
              </li>
            </ul>
            <div class="d-lg-none mobile-toggle pull-right"><i data-feather="more-horizontal"></i></div>
          </div>
          <script id="result-template" type="text/x-handlebars-template">
            <div class="ProfileCard u-cf">                        
            <div class="ProfileCard-avatar"><svg xmlns="http://www.w3.org/2000/svg" width="24" height="24" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round" class="feather feather-airplay m-0"><path d="M5 17H4a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h16a2 2 0 0 1 2 2v10a2 2 0 0 1-2 2h-1"></path><polygon points="12 15 17 21 7 21 12 15"></polygon></svg></div>
            <div class="ProfileCard-details">
            <div class="ProfileCard-realName"></div>
            </div>
            </div>
          </script>
          <script id="empty-template" type="text/x-handlebars-template">
            <div class="EmptyMessage">Your search turned up 0 results. This most likely means the backend is down, yikes!</div>
            
          </script>
        </div>
      </div>
      <!-- Page Header Ends                              -->
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <!-- Page Sidebar Start-->
        <div class="page-sidebar">
          <div class="main-header-left d-none d-lg-block">
            <div class="logo-wrapper"><a href="index.html"><img src="{{asset('admin_assets/images/endless-logo.png')}}" alt=""></a></div>
          </div>
          <div class="sidebar custom-scrollbar">
            <div class="sidebar-user text-center">
              <div><img class="img-60 rounded-circle" src="{{asset('admin_assets/images/user/1.jpg')}}" alt="#">
                <div class="profile-edit"><a href="edit-profile.html" ><i data-feather="edit"></i></a></div>
              </div>
              <h6 class="mt-3 f-14"></h6>
              <h3>{{\Auth::user()->name}}</h3>
              <!-- <p>general manager.</p> -->
            </div>
            <ul class="sidebar-menu">
              <li><a class="sidebar-header" href="/dashboard"><i data-feather="home"></i><span>Dashboard</span><span class="badge badge-pill badge-primary"></span></a>
                
              </li>
<!--              
              <li><a class="sidebar-header" href="/manage_employee"><i data-feather="server"></i><span>Manage Examination</span></a></li>
              <li><a class="sidebar-header" href="/manage_subjects" ><i data-feather="server"></i><span> Manage Subjects</span></a></li>
              <li><a class="sidebar-header" href="/add_question" ><i data-feather="server"></i><span> Questions</span></a></li>
            -->
            </ul>
          </div>
        </div>

        @yield('content')



         <!-- footer start-->
         <footer class="footer">
          <div class="container-fluid">
            <div class="row">
              <div class="col-md-6 footer-copyright">
                <p class="mb-0">Copyright 2021 © All rights reserved.</p>
              </div>
              <div class="col-md-6">
                <!-- <p class="pull-right mb-0">Hand crafted & made with<i class="fa fa-heart"></i></p> -->
              </div>
            </div>
          </div>
        </footer>
      </div>
    </div>
    
    <!-- Bootstrap js-->
    <script src="{{asset('admin_assets/js/bootstrap/popper.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/bootstrap/bootstrap.js')}}"></script>
    <!-- feather icon js-->
    <script src="{{asset('admin_assets/js/icons/feather-icon/feather.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/icons/feather-icon/feather-icon.js')}}"></script>
    <!-- Sidebar jquery-->
    <script src="{{asset('admin_assets/js/sidebar-menu.js')}}"></script>
    <script src="{{asset('admin_assets/js/config.js')}}"></script>

    
      
    <!-- Plugins JS start-->
    <script src="{{asset('admin_assets/js/datatable/datatables/jquery.dataTables.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/datatable/datatables/datatable.custom.js')}}"></script>
    <script src="{{asset('admin_assets/js/datepicker/daterange-picker/moment.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/datepicker/daterange-picker/daterangepicker.js')}}"></script>
    <script src="{{asset('admin_assets/js/datepicker/daterange-picker/daterange-picker.custom.js')}}"></script>
    <script src="{{asset('admin_assets/js/chart/chartist/chartist.js')}}"></script>
    <script src="{{asset('admin_assets/js/chart/knob/knob.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/chart/knob/knob-chart.js')}}"></script>
    <script src="{{asset('admin_assets/js/prism/prism.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/clipboard/clipboard.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/counter/jquery.waypoints.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/counter/jquery.counterup.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/counter/counter-custom.js')}}"></script>
    <script src="{{asset('admin_assets/js/custom-card/custom-card.js')}}"></script>
    <script src="{{asset('admin_assets/js/notify/bootstrap-notify.min.js')}}"></script>
    <script src="{{asset('admin_assets/js/dashboard/default.js')}}"></script>
    <script src="{{asset('admin_assets/js/notify/index.js')}}"></script>
    <script src="{{asset('admin_assets/js/typeahead/handlebars.js')}}"></script>
    <script src="{{asset('admin_assets/js/typeahead/typeahead.bundle.js')}}"></script>
    <script src="{{asset('admin_assets/js/typeahead/typeahead.custom.js')}}"></script> 
    <script src="{{asset('admin_assets/js/chat-menu.js')}}"></script>
    <script src="{{asset('admin_assets/js/form-validation-custom.js')}}"></script>
    <script src="{{asset('admin_assets/js/height-equal.js')}}"></script>
    <script src="{{asset('admin_assets/js/tooltip-init.js')}}"></script>
     <script src="{{asset('admin_assets/js/typeahead-search/handlebars.js')}}"></script> 
    <script src="{{asset('admin_assets/js/typeahead-search/typeahead-custom.js')}}"></script>
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('admin_assets/js/script.js')}}"></script>
    <!-- <script src="admin_assets/js/theme-customizer/customizer.js"></script> -->
    <!-- Plugin used-->
  </body>
</html>
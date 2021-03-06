<!DOCTYPE html>
<html lang="en">
  
<!-- Mirrored from admin.pixelstrap.com/endless/ltr/login-video.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Feb 2021 09:55:45 GMT -->
<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="description" content="endless admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, endless admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="pixelstrap">
    <link rel="icon" href="{{asset('admin_assets/images/postcode.png')}}" type="image/x-icon">
    <link rel="shortcut icon" href="{{asset('admin_assets/images/favicon.png')}}" type="image/x-icon">
    <title>Login</title>
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
    <!-- Plugins css Ends-->
    <!-- Bootstrap css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/bootstrap.css')}}">
    <!-- App css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/style.css')}}">
    <link id="color" rel="stylesheet" href="{{asset('admin_assets/css/light-1.css')}}" media="screen">
    <!-- Responsive css-->
    <link rel="stylesheet" type="text/css" href="{{asset('admin_assets/css/responsive.css')}}">

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
      <div class="container-fluid p-0">
        <!-- login page with video background start-->
        <div class="auth-bg-video">
          <video id="bgvid" poster="admin_assets/images/other-images/coming-soon-bg.jpg" playsinline="" autoplay="" muted="" loop="">
            <source src="http://admin.pixelstrap.com/endless/assets/video/auth-bg.mp4" type="video/mp4">
          </video>
          <div class="authentication-box">
            <div class="text-center"><img src="{{asset('admin_assets/images/postcode.png')}}" class="logimg" alt=""></div>
            <div class="card mt-4">
              <div class="card-body">
                <div class="text-center">
                  <h4>LOGIN</h4>
                  <h6>Enter your Credentials </h6>
                </div>
                <div id="failur" class="alert alert-danger" style="display: none;">
                </div>
                <form class="form-horizontal theme-form" action="" method="post">
                {{csrf_field()}}
                  <div class="form-group">
                    <label class="col-form-label pt-0">Email</label>
                    <input class="form-control" id="email" value="{{old('email')}}" name="email" type="text" required="">
                    @error('email')
                        {{$message}}
                        @enderror
                  </div>
                  <div class="form-group">
                    <label class="col-form-label">Password</label>
                    <input class="form-control" id="password" value="{{old('password')}}" name="password" type="password" required="">
                    @error('password')
                        {{$message}}
                        @enderror
                  </div>
                  <!-- <div class="checkbox p-0">
                    <input id="checkbox1" type="checkbox">
                    <label for="checkbox1">Remember me</label>
                  </div> -->
                  <div class="form-group form-row mt-3 mb-0">
                    <button class="btn btn-primary btn-block" id="admin_signup" name="admin_signup" type="button">Login</button>
                  </div>
                
                </form>
              </div>
            </div>
          </div>
        </div>
        <!-- login page with video background end-->
      </div>
    </div>

    <script>
        $(document).ready(function() {
            
            $('#admin_signup').click(function(e) {
               
                e.preventDefault();
                var email = $("#email").val();
                var password = $("#password").val();
                var token = $('input[name="_token"]').val();

                var formData = new FormData(); //append data
                formData.append('email', email);
                formData.append('password', password);
                formData.append('_token', token);

                $.ajax({
                    type: 'post',
                    url: '{{ route("admin.login") }}',
                    cache: false, 
                    processData: false,
                    contentType: false,
                    data: formData,
                    dataType: "json",
                    success: function(response) {
                 
                        if (response.status == 1) {
                            window.location.href = '{{ route("admin.dashboard") }}';
                        } else {
                            $('#failur').show();
                        $('#failur').html(response.message);
                        }
                    },
                    error: function(jqXHR, textStatus, errorThrown) {
                        $('.login').html("Login");
                        $('.login').attr("disabled", false);
                        var msg = "";
                        if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                            msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                        } else {
                            if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                            } else {
                                msg += "<strong><ul style='list-style:none;'>";
                                $.each(jqXHR.responseJSON.errors, function(key, value) {
                                    msg += "<li style='margin-left:0px;'>" + value + "</li>";
                                });
                                msg += "</ul></strong>";
                            }
                        }
                        toastr.warning(msg, 'Error!', {
                            "progressBar": true,
                            positionClass: 'toast-top-right',
                            containerId: 'toast-top-right'
                        });

                    }
                });
            });
        });
    </script>
  
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
    <!-- Plugins JS Ends-->
    <!-- Theme js-->
    <script src="{{asset('admin_assets/js/script.js')}}"></script>
    <!-- Plugin used-->

    
  </body>

<!-- Mirrored from admin.pixelstrap.com/endless/ltr/login-video.html by HTTrack Website Copier/3.x [XR&CO'2014], Fri, 19 Feb 2021 09:55:45 GMT -->
</html>
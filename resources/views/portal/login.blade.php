
<!DOCTYPE html>
<html lang="en">
<head>
  <title>Our postcode</title>
  <meta charset="utf-8">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  <meta name="description" content="">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.2/css/all.min.css" integrity="sha512-HK5fgLBL+xu6dm/Ii3z4xhlSUyZgTT9tuc/hSrtw6uzJOvgRr2a9jyxxT1ely+B+xFAmJKVSTbpM/CuL7qxO8w==" crossorigin="anonymous" />
  <link rel="stylesheet" href="{{asset('business_user_asset/css/bootstrap.min.css')}}">
  <link rel="stylesheet" type="text/css" href="{{asset('business_user_asset/css/slick.css')}}"/>
  <link rel="stylesheet" type="text/css" href="{{asset('business_user_asset/css/slick-theme.css')}}"/>
  <link rel="stylesheet" href="{{asset('business_user_asset/css/style.css')}}">

</head>
<body class="login-body">

<!-- Navbar-->
<div class="container pt-5">
  <div class="card card0 border-0 col-12 col-md-9 m-auto">
      <div class="row d-flex">
          <div class="col-lg-5">
              <div class="card1 pb-5">
                  <div class="row"> <img src="{{asset('business_user_asset/images/logo.png')}}" class="logo"></div>
                  <div class="row px-3 justify-content-center mt-4 mb-5 border-line"> <img src="{{asset('business_user_asset/images/login-bg.png')}}" class="image"> </div>
              </div>
          </div>
          <div class="col-lg-7 ">
            
              {{-- <div id="login-form"> --}}
                <div class="card2 card border-0 px-2 px-md-4 py-3 py-md-5">
                        
                    <span class="text-dark p-1 text-center">Select a user type first</span>
                    <div id="user-type">
                        <div class="form-group">
                          <select class="form-control" id="user-type-selected">
                            {{-- <option value="">-Select user type-</option> --}}
                            <option value="User" selected>User</option>
                            <option value="Business">Business</option>
                            <option value="Admin">Admin</option>
                          </select>
                        </div>
                    </div>
                    <div id="login-form">
                        <div id="social-login" style="display: none;">
                          <div class="row mb-4 px-3">
                              <h6 class="mb-0 mr-4 mt-2 text-dark">Sign in with</h6>
                              {{-- <div class="facebook text-center mr-3">
                                  <a href="{{route('socialite.login', 'facebook')}}"><div class="fab fa-facebook-f"></div></a>
                              </div> --}}
                              <div class="twitter text-center mr-3">
                                <a href="{{route('socialite.login', 'google')}}"><div class="fab fa-google"></div></a>
                              </div>
                          </div>
                          <div class="row px-3 mb-4">
                              <div class="line"></div> <small class="or text-center text-muted">Or</small>
                              <div class="line"></div>
                          </div>
                        </div>
                        
                        <div id="failur" class="alert alert-danger" style="display: none;"></div>
                        
                        <form>
                          {{csrf_field()}}
                          <div class="row px-3"> 
                              <label class="mb-1">
                                  <h6 class="mb-0 text-sm text-dark">Email Address</h6>
                              </label> 
                              {{-- <input class="mb-4" type="text" name="email" placeholder="Enter a valid email address">  --}}
                              <input class="mb-4" id="email" value="{{old('email')}}" name="email" type="text" required placeholder="Enter a valid email address">
                              
                              @error('email')
                                {{$message}}
                              @enderror
                          </div>
                          <div class="row px-3"> 
                              <label class="mb-1">
                                  <h6 class="mb-0 text-sm text-dark">Password</h6>
                              </label> 
                              {{-- <input type="password" name="password" placeholder="Enter password"> --}}
                              <input id="password" value="{{old('password')}}" name="password" type="password" required placeholder="Enter password">
                              
                              @error('password')
                                {{$message}}
                              @enderror 
                          </div>
                          <div class="row px-3 mb-4">
                              <div class="custom-control custom-checkbox custom-control-inline"> <input id="chk1" type="checkbox" name="chk" class="custom-control-input"> <label for="chk1" class="custom-control-label text-sm text-dark">Remember me</label> </div> <a href="#" class="ml-auto mb-0 text-sm text-primary">Forgot Password?</a>
                          </div>
                          <div class="row mb-3 px-3"> 
                              <button type="submit" id="admin_signup" class="btn btn-blue text-center">Login</button>
                              <a  href="{{ route('register') }}" style="display: none; margin-left: auto;" id="register" class="btn btn-blue text-center">Register</a> 
                            </div>
                        </form>
                    </div>
                </div>
              {{-- </div> --}}
          </div>
      </div>
  </div>
</div>


<!--Script-->
<script src="{{asset('business_user_asset/js/jquery.min.js')}}"></script>

<script>
    $(document).ready( function() {
        // $('#login-form').hide();
        $('#login-form').show();
        $("#register").css('display', 'block');
              $("#social-login").css('display', 'block');
            
        $('#user-type-selected').change(function() {
          var user = $('#user-type-selected').val();
          if(user) {
            $('#lognin-as').html(user);
            $('#login-form').show();
            if(user == 'User') {
              $("#register").css('display', 'block');
              $("#social-login").css('display', 'block');
            } else {
              $("#register").css('display', 'none');
              $("#social-login").css('display', 'none');
            }
          }
          else {
            $('#login-form').hide();
          }
        });

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
                }
            });
        });
    });
</script>

<script src="{{asset('business_user_asset/js/jquery.min.js')}}"></script>
<script src="{{asset('business_user_asset/js/popper.min.js')}}"></script>
<script src="{{asset('business_user_asset/js/bootstrap.min.js')}}"></script>
<script type="text/javascript" src="{{asset('business_user_asset/js/slick.min.js')}}"></script>
<script src="{{asset('business_user_asset/js/custom.js')}}"></script>




</body>
</html>
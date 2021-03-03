<!DOCTYPE html>
<html>
    <head>
        <title>Sign up</title>
        <meta charset="utf-8">
        <meta name="viewport" content="width=device-width, initial-scale=1">
        <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/css/bootstrap.min.css">
      
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
        <link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>

        <link rel="stylesheet" href="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.2/css/bootstrapValidator.min.css"/>
		<link rel="stylesheet" href="/model/css/style.css"/>
      
        <link rel="stylesheet" type="text/css" href="{{asset('css/sty.css')}}">
		  <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.4.1/jquery.min.js"></script>
        <script src="https://maxcdn.bootstrapcdn.com/bootstrap/3.4.0/js/bootstrap.min.js"></script>
		  <script type="text/javascript" src="//cdn.jsdelivr.net/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
		        <script type="text/javascript" src="//cdnjs.cloudflare.com/ajax/libs/jquery.bootstrapvalidator/0.5.2/js/bootstrapValidator.min.js"></script>
   </head>
    
    <body>
        <div class="header">
            <img class="" src="{{asset('images/ask.jpg')}}" width="20px" height="20px">
            <div class="header-right" style="float:right;">              
                <a href="#" class="active">Home</a>
                <a href="#" class="abt">About</a>
                <a href="#" class="cont">Contact</a>
                <a href="#" class="port">Portfolio</a>
            </div>
        </div>
        <form action="#" style="border:1px solid #ccc" id="user_signup" name="user_signup">
            <div class="container">
                <div id="suman" class="alert alert-success" style="display: none;">
                </div>
                {{csrf_field()}}
                <h1>Sign Up</h1>
                
                <p>Please fill in this form to create an account.</p>
                <button id="color_change" class="btn btn-link" type="button" name="color_change">Color Change</button>
                <p id="demo"></p>
                <p id="info"></p>
                <hr>
    {{\Auth::user()->id}}
                <div class="form-group col-md-6">
                    <label for="username">First Name:</label>
                    <input type="text" class="form-control"  name="f_name" id='f_name' placeholder="Enter First name" autocomplete="off">
                </div>
                 <div class="form-group col-md-6">
                    <label for="username">Last Name</label>
                    <input type="text" class="form-control"  name="l_name" id='l_name' placeholder="Enter Last name" autocomplete="off">
                </div>
                 <div class="form-group col-md-6">
                    <label for="username">Email</label>
                    <input type="text" class="form-control"  name="username" id='username' placeholder="Enter Email" autocomplete="off">
                </div>
                 <div class="form-group col-md-6">
                    <label for="username">Phone No:</label>
                    <input type="text" class="form-control"  name="user_phone" id='user_phone' placeholder="Enter Phone no" autocomplete="off">
                </div>
                 <div class="form-group col-md-6">
                    <label for="username">Password</label>
                    
                    <input type="password" class="form-control" name="password" id='password' placeholder="Enter pasword" autocomplete="off">
                </div>
                 <div class="form-group col-md-6">
                    <label for="username">Repeat Password</label>
                    <input type="text" class="form-control"  name="psw_repeat" id='psw_repeat' placeholder="Enter confirm password" autocomplete="off">
                </div>
             

                <p>By creating an account you agree to our Terms & Privacy.</p>

              
                    
        </form>
    <div class="footer">
                    <button type="button"  class="btn btn-danger">Cancel</button>
                    <button type="submit" id="save_signup" name="save_signup" class="signupbtn">Sign Up</button>
                    <button class="btn btn-primary" type="button" href="javascript:" id="print_now">Print Now</button>
                    <button class="btn btn-success" type="button" name="time" id="time">Date & Time</button>
                    <button type="button" id="hid_info" value="hid_info" class="btn btn-info">Hidden Info</button>
                    <button type="button" class="btn btn-warning"></button>
                    <button id="magic" class="btn btn-link" type="button" name="magic">Click Here</button>
                    
                     
            </div>
        </div>
 <div id="exitpop_mode_all">
                <div class="modal-overlay"></div>
                {{csrf_field()}}
                <div class="modal-query">
                    <div class="bg-img">
                        <div class="exit_pop">
                            Need Help to Choose?<br> Request Assistance Call Back
                            <p>Our Learning Consultant will Call You and Help you Choose the Right Career Path...</p>
                        </div>

                        <img src="/model/bg.png" alt="callback">
                    </div>
                    <div class="modal-form">
                        <span aria-hidden="true" style="float: right;margin: 0px 0px;cursor: pointer;" id="close_query">&times;</span>
                        <div class="form-title">
                            <img src="//static.webdrills.net/images/icon/diploma_crt.svg" alt="webdrills-callback" class=""><span>Request A Call Back</span>
                        </div>
                        <input type="hidden" id="token_new" value="{{ csrf_token() }}">
                        <input type="text" class="md-from-control" name="q_name" id="q_name" placeholder="Your Name" autocomplete="off"><span id="nm_err" style="color: red;padding-left: 5px;font-size: 12px;"></span>
                        <input type="text" class="md-from-control" autocomplete="off" name="q_mob" id="q_mob" maxlength="10" placeholder="Your Mobile" autocomplete="off"><span id="mob_err" style="color: red;padding-left: 5px;font-size: 12px;"></span>
                        <input type="text" class="md-from-control" name="q_email" id="q_email" placeholder="Your Email" autocomplete="off"><span id="email_err" style="color: red;padding-left: 5px;font-size: 12px;"></span>
                        <!-- <input type="text" class="md-from-control" name="remark" id="remark" placeholder="Your Remark"><span id="rem_err" style="color: red;padding-left: 5px;font-size: 12px;"></span> -->
                        <input class="modal-btn" type="button" id="send_query" value="Submit" style="margin-top: 30px;margin-left: -5px;cursor: pointer;">
                    </div>
                </div>
            </div>

        <script>
    $(document).ready(function () {
     
      
        $('#user_signup').bootstrapValidator({
            message: 'This value is not valid',
            feedbackIcons: {
                valid: 'glyphicon glyphicon-ok',
                invalid: 'glyphicon glyphicon-remove',
                validating: 'glyphicon glyphicon-refresh'
            },
            fields: {
                f_name: {
                    validators: {
                        notEmpty: {
                            message: 'First name is required and it cannot be left empty'
                        }
                    }
                },
                l_name: {
                    validators: {
                        notEmpty: {
                            message: 'Last name is required and it cannot be left empty'
                        }
                    }
                },
                username: {
                    validators: {
                        notEmpty: {
                            message: 'Email is required it cannot be left empty'
                        }
                    }
                },
                user_phone: {
                    validators: {
                        notEmpty: {
                            message: 'Phone no is required it cannot be left empty'
                        },
                        stringLength: {
                            max: 10,
                            message: 'Phone no must be of 10 character'
                        }
                    }
                },
                password: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required it cannot be left empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 15,
                            message: 'Password Year must be between 6 to 15 character'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9@_]+$/,
                            message: 'Password can contain Alphanumeric value with @ or _ only'
                        },
                        idenrical: {
                            field: 'psw_repeat',
                        message: 'The password and its confirm are not the same'
                        }
                    }
                },
                psw_repeat: {
                    validators: {
                        notEmpty: {
                            message: 'Password is required it cannot be left empty'
                        },
                        stringLength: {
                            min: 6,
                            max: 15,
                            message: 'Password Year must be between 6 to 15 character'
                        },
                        regexp: {
                            regexp: /^[a-zA-Z0-9@_]+$/,
                            message: 'Password can contain Alphanumeric value with @ or _ only'
                        },
                        identical: {
                            field: 'password',
                            message: 'Password and its confirm password are not same'
                        }
                    }
                }
            }
        }).on('success.form.bv', function (e) {
            e.preventDefault();
//            alert('hi');
            get_signup();
        });
    });
    function get_signup() {
        var f_name = $('#f_name').val();
        var l_name = $('#l_name').val();
        var username = $('#username').val();
        var user_phone = $('#user_phone').val();
        var password = $('#password').val();
        var psw_repeat = $('#psw_repeat').val();
        var token = $("input[name='_token']").val();

        var formdata = new FormData();
        formdata.append('f_name', f_name);
        formdata.append('l_name', l_name);
        formdata.append('username', username);
        formdata.append('user_phone', user_phone);
        formdata.append('password', password);
        formdata.append('psw_repeat', psw_repeat);
        formdata.append('_token', token);
        $.ajax({
            type: 'post',
            url: '/signup_get',
            cache: false,
            processData: false,
            contentType: false,
            data: formdata,
            dataType: "json",
            success: function (response) {
                        $('#suman').show();
                        $('#suman').html(response.message);
                if (response.status == 1) {
                   window.location.href = '/';
                } else {
                    $.confirm({
                        title: 'Error!',
                        content: response.message,
                        type: 'red',
                        typeAnimated: true,
                        icon: 'fa fa-success',
                        buttons: {
                            close: function () {
                            }
                        }
                    });
                }
            },
        });
    }

    
        </script>
		<script>
		 $(document).ready(function () {
			
			  $("#send_query").click(function() {
				   alert('hi');
                        var q_name = $("#q_name").val();
                        var q_email = $("#q_email").val();
                        var q_mob = $("#q_mob").val();
						 var token = $("input[name='_token']").val();
                        // var remark = $("#remark").val();
                  
                        $.ajax({
                            url: "/send_query",
                            type: "post",
                            data: {
                                'q_name': q_name,
                                'q_email': q_email,
                                'q_mob': q_mob,
                                '_token': token
                            },
							 dataType: "json",
                            success: function(response) {
                               
                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                               
                            }
                        });
                    });
					
		 });
		</script>
		
    </body>
</html>
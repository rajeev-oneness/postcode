@extends('front.home.master')

@section('title')
    Contact Us
@endsection

@section('head-script')
<script>
function initMap() {
    var mapProp= {
      center:new google.maps.LatLng(-28.024, 140.887),
      zoom:4,
    };
    var map = new google.maps.Map(document.getElementById("googleMap"),mapProp);
}
</script>
@endsection

@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{{route('default.homepage')}}">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					<li>Contact Us</li>
				</ul>
			</div>
		</div>
	</div>
</section>
    <div class="container">
		<div class="row m-0 mt-5 mb-5">
			<div class="col-md-6 text-left con_left-bg">
				<h4 class="footer-heading text-white">Quick find us</h4>
				<h4 class="text-white">{{$address->name}}</h4>
				{{$address->address}} <br>
				<strong class="text-white">Email : </strong>{{$address->email}} <br>
				<strong class="text-white">Contact No : </strong>{{$address->mobile}} <br><br>
				<!--<h4 class="footer-heading" class="mt-1">Location</h4>-->
				<div id="googleMap" style="width:100%;height:280px;"></div>
			</div>
			<div class="col-md-6 con-right">
				<h4 class="footer-heading pl-0 pl-md-3">Get in touch</h4>
				<form class="row m-0">
					<div class="form-group col-12 col-md-6">
						<input type="text" name="name" id="name" class="form-control" placeholder="Your Name" required>
					</div>
					<div class="form-group col-12 col-md-6">
						<input type="email" name="email" id="email" class="form-control" placeholder="Your email" required>
					</div>
					<div class="form-group col-12 col-md-6">
						<input type="number" name="mobile" id="mobile" class="form-control" placeholder="Your mobile" required>
					</div>
					<div class="form-group col-12 col-md-6">
						<input type="text" name="subject" id="subject" class="form-control" placeholder="Message Subject" required>
					</div>
					<div class="form-group col-12">
						<textarea name="message" id="message" cols="30" rows="5" placeholder="Message..." class="form-control" required></textarea>
					</div>
					<div class="text-left pl-0 pl-md-3">
						<button type="submit" id="send-button" class="orange-btm load_btn" style="outline: none; border:none;">Send</button>
					</div>
					<div id="msg" class="mt-3"></div>
					
				</form>
			</div>
		</div>
	</div>
@endsection

@section('script')

<script>
    $("form").submit(function(evt) {
        evt.preventDefault();
        $("#send-button").html('Sending...');
        $.ajax({
            url: "{{route('send.contact-us')}}",
            type: 'POST',
            data: {
                _token: '{{csrf_token()}}',
                name: $("#name").val(), 
                email: $("#email").val(), 
                mobile: $("#mobile").val(), 
                subject: $("#subject").val(),
                message: $("#message").val()
            },
            success:function() {
                $("form").trigger("reset");
                $("#send-button").html('Send');
                $("#msg").append(
                    '<div class="alert alert-success alert-dismissible fade show" role="alert"><strong>Message Sent!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                setTimeout(function() {
                    $("#msg").fadeOut()
                }, 2000);
            },
            error:function() {
                $("#send-button").html('Send');
                $("#msg").append(
                    '<div class="alert alert-danger alert-dismissible fade show" role="alert"><strong>Message Sending Failed!</strong><button type="button" class="close" data-dismiss="alert" aria-label="Close"><span aria-hidden="true">&times;</span></button></div>'
                );
                setTimeout(function() {
                    $("#msg").fadeOut()
                }, 2000);
            } 
        })
    })
</script>
    
@endsection

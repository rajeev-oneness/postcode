@extends('front.home.master')

@section('title')
    Community-@yield('com-title')
@endsection

@section('head-script')
  <style>
    .search_list_items-mod > li .location_img_wrap > img {
      width: 390px;
    }
    .search_list_items-mod > li .list_content_wrap {
        width: calc(100% - 390px);
    }
  </style>

  <script src="https://cdn.ckeditor.com/4.16.0/standard/ckeditor.js"></script>
@endsection


@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{{route('default.homepage')}}">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					@yield('brd_name')
				</ul>
			</div>
		</div>
	</div>
</section>

@yield('community')

@endsection

@section('script')
@yield('community-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    @if(Session::has('Success'))
        swal('Success','{{Session::get('Success')}}', 'success');
    @elseif(Session::has('Errors'))
        swal('Error','{{Session::get('Errors')}}', 'error');
    @endif
</script>
@endsection


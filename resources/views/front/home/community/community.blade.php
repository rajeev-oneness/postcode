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
<div class="container">
    <h2 class="mt-5 main-heading"> <a href="{{route('community.show')}}" style="color:black;">Community board</a></h2>
    @auth
    <a href="{{route('community.my.post')}}" class="primery-button orange-btm mr-auto">My Posts</a>
    <a href="{{route('community.add.post')}}" class="primery-button orange-btm m-3">Add Posts</a>
    <a href="{{route('community.add.post')}}" class="primery-button orange-btm m-3">My Groups</a>
    @endauth
    @guest
		<a href="{{route('adminlogin')}}" class="primery-button orange-btm mr-auto">Login</a>
    @endguest
		<a href="{{route('adminlogin')}}" class="primery-button orange-btm m-3">Community Groups</a>
    <div class="row my-5">
      <div class="col-sm-2">
        <div class="list-group">
          <a href="{{route('community.category.show', 1)}}" class="list-group-item list-group-item-action">Tips</a>
          <a href="{{route('community.category.show', 2)}}" class="list-group-item list-group-item-action">Ideas</a>
          <a href="{{route('community.category.show', 3)}}" class="list-group-item list-group-item-action">Category 3</a>
          <a href="{{route('community.category.show', 4)}}" class="list-group-item list-group-item-action">Category 4</a>
          <a href="{{route('community.category.show', 5)}}" class="list-group-item list-group-item-action">Category 5</a>
          <a href="{{route('community.category.show', 6)}}" class="list-group-item list-group-item-action">Other Topics</a>
        </div>
      </div>
      <div class="col-sm-10 border border-dark">
        @yield('community')
      </div>
    </div>
</div>
@endsection

@section('script')
@yield('community-scripts')
<script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
<script type="text/javascript">
    @if(Session::has('Success'))
        swal('Success','{{Session::get('Success')}}');
    @elseif(Session::has('Errors'))
        swal('Error','{{Session::get('Errors')}}');
    @endif
</script>
@endsection


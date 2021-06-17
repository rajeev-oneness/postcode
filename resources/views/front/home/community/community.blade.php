@extends('front.home.community.master')

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


@section('community')


<!-- <div class="container">
    <h2 class="mt-5 main-heading"> <a href="{{route('community.show')}}" style="color:black;">Community board</a></h2>
    @auth
    <a href="{{route('community.my.post')}}" class="primery-button orange-btm mr-auto">My Posts</a>
    <a href="{{route('community.add.post')}}" class="primery-button orange-btm m-3">Add Posts</a>
    <a href="{{route('community.my.groups')}}" class="primery-button orange-btm m-3">My Groups</a>
    @endauth
    @guest
		<a href="{{route('adminlogin')}}" class="primery-button orange-btm mr-auto">Login</a>
    @endguest
		<a href="{{route('community.all.groups')}}" class="primery-button orange-btm m-3">Community Groups</a>
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
        
      </div>
    </div>
</div> -->

<div class="community-banner" style="background:url('{{asset('homepage_assets/images/community-banner-new.jpg')}}');">
  <div class="text-center">
    <img src="{{asset('homepage_assets/images/community-logo.png')}}">
    <h1 class="comm-heading">OUR POSTCODE COMMUNITY</h1>
  </div>
</div>

<section class="community-details">
  <div class="left-community">
    <ul id="category-section">
      {{-- categories rendered here --}}
    </ul>
  </div>

  @yield('community-details')

</section>

@endsection

@section('script')
@yield('community-scripts')
<script type="text/javascript">
    $.ajax({
      url: "{{route('get.community.categories')}}",
      type: "POST",
      data: { _token: "{{csrf_token()}}" },
      success:function(data){
        console.log(data.data);
        $("#category-section").empty();
        var category = "";
        $.each(data.data, function(i, val) {
          category += "<li>"; 
          category += "<a href='{{route('community.category.show'," + val.id + ")}'>"+ val.name +"</a>"; 
          category += "</li>"; 
        })
        $("#category-section").append(category);
      }
    })
</script>
@endsection


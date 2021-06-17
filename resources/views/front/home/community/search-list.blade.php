@extends('front.home.community.master')

@section('com-title')
    View
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Search Result</a></li>
@endsection

@section('community')

<div class="searchresult mt-5 mb-5">
	<div class="container">
	    <div class="row">
	        <div class="col-12">
		        <ul class="search_list_items search_list_items-mod" id="list-data"> 
		            {{-- <li>
		              <div class="location_img_wrap">
		                <img src="{{asset('homepage_assets/images/search-result-1.jpg')}}">
		              </div>
		              <div class="list_content_wrap"> 
		                <div class="government-part text-center">
		                  <img src="{{asset('homepage_assets/images/government-icon.png')}}">
		                  <p>Government</p>
		                </div>
		                <h4 class="place_title bebasnew">lorem ipsum dolor</h4>
		                <p>Lorem Ipsum is simply dummy text of the printing and typesetting industry. Lorem Ipsum has been the industry's standard dummy text ever since the 1500s, when an unknown printer.</p>
		                <div class="location_details">
							<p class="location"><img src="{{asset('homepage_assets/images/location.png')}}">40 Journal Square Plaza, NJ</p> 
							<p class="search-date"><img src="{{asset('homepage_assets/images/calender.png')}}">17 - 02 - 2021 . Wednesday</p>
						</div> 
		              </div>
		            </li> --}}
		        </ul>
		        <div class="text-center">
		         	<a href="javascript:void(0);" class="orange-btm load_btn" id="load-more2">Load More</a>
		        </div>
			</div>
		</div>
	</div>
</div>
    
@endsection

@section('community-scripts')
    
<script>
	// console.log('{{Route::current()->getName()}}');
	let page = 0;
	$('#load-more2').click(function() {
		page += 1;
		ajaxCall();
	});
	ajaxCall();
	function ajaxCall() {
		let params = {_token:'{{csrf_token()}}',page:page,menu:'{{Route::current()->getName()}}'};
		@foreach($request as $key => $req)
				params['{{$key}}'] = '{{$req}}';
		@endforeach
		// console.log(params);
		$.ajax({
			type:'POST',
			url:'{{route('get.search.result')}}',
			data:params,
			success:function(data) {
				list_view = '';
				//total data count
				// count = data.total+' results found ';
				// $(".result_tab_title").html(count);

				if(data.error == false){
					if(data.data.length > 0) {
						$.each(data.data, function(index, value){
							// grid view
							communityHref = "{{route('community.post.detail', 'postId')}}";
							communityHref = communityHref.replace('postId', btoa(value.id));
							
							// list view
							list_view += "<li id='"+value.id+"'>",
							list_view += "<div class='location_img_wrap'><img src='"+value.image+"'></div>",
							list_view += "<div class='list_content_wrap'>",
							list_view += "<div class='government-part text-center'><p>"+value.community_category.name+"</p></div>",
							list_view += "<a href='"+communityHref+"'><h4 class='place_title bebasnew'>"+value.title+"</h4></a>",
							list_view += "<p>"+value.description+"</p>",
							list_view += "<div class='location_details'><p class='location'><img src='{{asset('homepage_assets/images-new/comments.png')}}'>"+value.comments.length+" Comments</p> <p class='search-date'><img src='{{asset('homepage_assets/images/calender.png')}}'>17 - 02 - 2021 . Wednesday</p></div>",
							list_view += "</div>",
							list_view += "</li>"
						});
						$("#list-data").append(list_view);
					} else {
						$('#load-more2').html('No more data!');
					}
				} else {
					//here goes the error
					$('#load-more2').html('No more data!');
				}
			}
		})
	}
</script>

@endsection
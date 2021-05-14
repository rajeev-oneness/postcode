@extends('front.home.master')

@section('title')
    FAQs
@endsection


@section('content')
<section class="breadcumb_wrap">
	<div class="container">
		<div class="row">
			<div class="col-12">
				<ul class="breadcumb_list">
					<li><a href="{{route('default.homepage')}}">Home</a></li>
					<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
					<li>FAQs</li>
				</ul>
			</div>
		</div>
	</div>
</section>
    <div class="container">
        <div class="col-md-12 text-center p-5">
            <h4 class="footer-heading">FAQs</h4>
            @php
                $i = 1;
            @endphp
            @foreach ($faqs as $faq)
                <h4 class="text-primary">{{$i++}}. {{$faq->question}}</h4>
                {{$faq->answer}}
            @endforeach
        </div>
    </div>
@endsection


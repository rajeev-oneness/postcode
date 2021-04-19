@extends('front.home.master')

@section('title')
    FAQs
@endsection


@section('content')
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


@extends('front.master')

@section('title')
    Directory - Home Page
@endsection

@section('content')
    @foreach ($businesses as $business)
    <div class="bg-light mt-5" style="display: flex; justify-content:center; align-items:center;">
        <section class="mx-5 bg-white border border-2 rounded-3 p-4" style="width: 1000px;">
            <div class="container-fluid">
                <div class="row">
                    <div class="col-md-6">
                        <h2 class="custom-color-1">
                            <a href="#">{{$business->name}}</a>
                        </h2>
                        <p class="custom-color-1"><i class="fal fa-map-marker-alt"></i>  {{$business->address}}</p>
                    </div>
                    <div class="col-md-6">
                        <a href="{{route('rating.add', ['businessId' => encrypt($business->id)])}}">
                            <div>
                                @php
                                    $i = 0
                                @endphp
                                @foreach ($ratings as $rating)
                                    @if ($business->id == $rating->business_id)
                                        @php
                                            $i = $i+1;
                                        @endphp     
                                    @endif
                                @endforeach
                                <span class="fa fa-star {{($i>0)?'reviewed':''}}"></span>
                                <span class="fa fa-star {{($i>0)?'reviewed':''}}"></span>
                                <span class="fa fa-star {{($i>0)?'reviewed':''}}"></span>
                                <span class="fa fa-star {{($i>0)?'reviewed':''}}"></span>
                                <span class="fa fa-star"></span>
                                <span class="reviewed">({{$i}} reviews)</span>
                                
                            </div>
                        </a>
                        <div class="pt-2">
                            <i class="fal fa-globe custom-color-2"></i> <a href="{{$business->company_website}}" target="_blank">Official Website</a>
                            <span class="m-1"></span>
                            <i class="fal fa-phone-alt custom-color-2"></i> <a href="tel: {{$business->mobile}}" target="_blank">{{$business->mobile}}</a>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-3">
                        <img src="{{asset($business->image)}}" alt="Business Logo" class="img-fluid img-thumbnail rounded custom-image">
                    </div>
                    <div class="col-md-9">
                        <h4>Description</h4>
                        {{$business->description}}
                    </div>
                </div>
            </div>
        </section>
    </div>
    @endforeach
    
    <style>
        .custom-image {
            width: 180px;
        }
        .reviewed {
            color: orange;
        }
        .custom-color-1 {
            color: #f25d23;
        }
        .custom-color-2 {
            color: #012d6a;
        }
        a{
            text-decoration: none;
            color: #012d6a;
        }
    </style>
@endsection
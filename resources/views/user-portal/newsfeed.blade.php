<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | News Feed</title>

@extends('user-portal.layouts.master')

@section('tab-link')
<ul class="nav nav-tabs" id="myTab" role="tablist">
    <li class="nav-item" role="presentation">
      <a class="nav-link active" id="offers-tab" data-toggle="tab" href="#offers" role="tab" aria-controls="offers" aria-selected="false">Offers</a>
    </li>
    <li class="nav-item" role="presentation">
      <a class="nav-link" id="events-tab" data-toggle="tab" href="#events" role="tab" aria-controls="events" aria-selected="false">Events</a>
    </li>
    {{-- <li class="nav-item" role="presentation">
      <a class="nav-link border-0" id="section-tab" data-toggle="tab" href="#section" role="tab" aria-controls="section" aria-selected="false">Statistics section</a>
    </li> --}}
</ul>
@endsection

@section('content')
<div class="tab-content p-4" id="myTabContent">
    <div class="tab-pane fade active show" id="offers" role="tabpanel" aria-labelledby="offers-tab">
      <div class="row m-0">
        @if (count($allOffers) == 0)
            <div class="col-12">
                <h1 class="text-center">No Offers</h1>
            </div>
        @else
        @foreach ($allOffers as $offer)
        <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3 pl-md-0">
          <div class="card">
            <div class="position-relative">
              <img src="{{url($offer->image)}}" class="card-img-top" alt="Events">
              <div class="img-retting">
                <ul>
                  <li><img src="{{asset('business_user_asset/images/event-star.png')}}"> <span>4.5</span> (60 reviews)</li>
                  <li>|</li>
                  <li><i class="far fa-comment-dots"></i> 40 Comments</li>
                </ul>
              </div>
            </div>
            <div class="card-body event-body">
              <div class="row m-0 col-12 p-0">
                <div class="col-8 col-md-8 p-0">
                  <h5 class="card-title">{{$offer->title}}
                    <span class="d-block"> {{$offer->promo_code}}</span>
                    <span class="d-block"><i class="fas fa-map-marker-alt"></i> Reedem before {{date("d M'y", strtotime($offer->expire_date))}}</span>
                  </h5>
                  <div class="card-border"></div>
                </div>
                <div class="col-4 col-md-4 p-0 categ-text">
                  <div class="bg-orange offer-price">
                    <p>PRICE
                      <span>${{$offer->price}}</span>
                    </p>
                  </div>
                </div>
              </div>
              <p class="card-text">{{$offer->short_description}}</p>
              <a href="{{route('details',['name' => 'deal', 'id' => $offer->id])}}" class="float-right text-dark"><i class="fas fa-long-arrow-alt-right"></i></a>
            </div>
          </div>
        </div>
        @endforeach
        @endif
      </div>
      <div class="row m-0">
        <nav aria-label="Page navigation example">
          {{$allOffers->links()}}
        </nav>
      </div>
      
    </div>
    
    
    <div class="tab-pane fade" id="events" role="tabpanel" aria-labelledby="events-tab">
        <div class="row m-0">
            @if (count($postcodeEvents) == 0)
                <div class="col-12">
                    <h1 class="text-center">No Events</h1>
                </div>
            @else
            @foreach ($postcodeEvents as $stateEvent)
            <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3 pl-md-0">
                <div class="card">
                {{csrf_field()}}
                  <div class="position-relative">
                    <img src="{{url($stateEvent->image)}}" class="card-img-top" alt="Events">
                    <div class="img-retting">
                      <ul>
                        <li><img src="{{asset('business_user_asset/images/event-star.png')}}"> <span>4.5</span> (60 reviews)</li>
                        <li>|</li>
                        <li><i class="far fa-comment-dots"></i> 40 Comments</li>
                      </ul>
                    </div>
                  </div>
                  <div class="card-body event-body">
                    <div class="row m-0 col-12 p-0">
                      <div class="col-8 col-md-8 p-0">
                        <h5 class="card-title">{{$stateEvent->name}}
                          <span class="d-block" style="white-space: pre-line;"><i class="fas fa-map-marker-alt"></i> {{$stateEvent->address}}</span>
                          <span class="d-block"><i class="fas fa-calendar-alt"></i> {{date("d M'y", strtotime($stateEvent->start))}} - {{date("d M'y", strtotime($stateEvent->end))}} </span>
                        </h5>
                        <div class="card-border"></div>
                      </div>
                      <div class="col-4 col-md-4 p-0 categ-text">
                        <div class="bg-orange text-center">
                          <img src="{{asset('business_user_asset/images/cat-gov.png')}}" class="pt-2">
                          <p>{{$stateEvent->eventcattype->name}}</p>
                        </div>
                      </div>
                    </div>
                    <p class="card-text">{{$stateEvent->short_description}}</p>
                    <a href="{{route('details',['name' => 'event', 'id' => $stateEvent->id])}}" class="float-right text-dark"><i class="fas fa-long-arrow-alt-right"></i></a>
                  </div>
                </div>
              </div>
            @endforeach
            @endif
        </div>
        <div class="row m-0">
            <nav aria-label="Page navigation example">
              {{$postcodeEvents->links()}}
            </nav>
        </div>
    </div>
    
    {{-- <div class="tab-pane fade" id="section" role="tabpanel" aria-labelledby="section-tab">Section</div> --}}
  </div>
@endsection
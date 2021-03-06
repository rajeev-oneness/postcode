<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | News Feed</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>News Feed</h3>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-12 xl-100">
                <div class="row">
                  <div class="col-12">
                    <h4>Recently Added Events</h4>
                    <hr>
                    <div class="mt-3">
                      <h5>Events in your state</h5>
                      @foreach ($stateEvents as $event)
                          <div class="border border-secondary rounded m-2">
                            <div class="p-3">
                              <h5><a href="{{route('details',['name' => 'event', 'id' => $event['id']])}}">{{$event['name']}}</a></h5>
                              <strong>Arranged by - <a href="{{route('details',['name' => 'business', 'id' => $event['business']['id']])}}">{{$event['business']['name']}}</a></strong>
                            </div>
                          </div>
                      @endforeach
                    </div>
                    <div class="mt-3">
                      <h5>Events in your postcode</h5>
                      @foreach ($postcodeEvents as $event)
                          <div class="border border-secondary rounded m-2">
                            <div class="p-3">
                              <h5><a href="{{route('details',['name' => 'event', 'id' => $event['id']])}}">{{$event['name']}}</a></h5>
                              <strong>Arranged by - <a href="{{route('details',['name' => 'business', 'id' => $event['business']['id']])}}">{{$event['business']['name']}}</a></strong>
                            </div>
                          </div>
                      @endforeach
                    </div>
                  </div>

                  {{-- <div class="col-12 mt-5">
                    <h4>Recently Added Offers</h4>
                    <hr>
                    <div class="mt-3">
                      <h5>Offers in your postcode</h5>
                      @foreach ($postcodeOffers as $offer)
                          <div class="border border-secondary rounded m-2">
                            <div class="p-3">
                              <h5><a href="{{route('details',['name' => 'deal', 'id' => $offer['id']])}}">{{$offer['title']}}</a></h5>
                              <strong>Arranged by - <a href="{{route('details',['name' => 'business', 'id' => $offer['business']['id']])}}">{{$offer['business']['name']}}</a></strong>
                            </div>
                          </div>
                      @endforeach
                    </div>
                  </div> --}}

                  <div class="col-12 mt-5">
                    <h4>All Events</h4>
                    <hr>
                    <div class="mt-3">
                      <h5>Events in your area</h5>
                      @foreach ($allEvents as $event)
                          <div class="border border-secondary rounded m-2">
                            <div class="p-3">
                              <h5><a href="{{route('details',['name' => 'event', 'id' => $event['id']])}}">{{$event['name']}}</a></h5>
                              <strong>Arranged by - <a href="{{route('details',['name' => 'business', 'id' => $event['business']['id']])}}">{{$event['business']['name']}}</a></strong>
                            </div>
                          </div>
                      @endforeach
                    </div>
                  </div>

                  <div class="col-12 mt-5">
                    <h4>All Offers</h4>
                    <hr>
                    <div class="mt-3">
                      <h5>Offers in your area</h5>
                      @foreach ($allOffers as $offer)
                          <div class="border border-secondary rounded m-2">
                            <div class="p-3">
                              <h5><a href="{{route('details',['name' => 'deal', 'id' => $offer['id']])}}">{{$offer['title']}}</a></h5>
                              <strong>Arranged by - <a href="{{route('details',['name' => 'business', 'id' => $offer['business']['id']])}}">{{$offer['business']['name']}}</a></strong>
                            </div>
                          </div>
                      @endforeach
                    </div>
                  </div>
                </div>
              </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Manage Offers</title>
    

@extends('business-portal.layouts.master')
    
@section('content')
<div class="row m-1">
    <div class="mb-3"><a class="btn btn-primary" href="{{route('business-admin.offers')}}"><i class="fas fa-plus"></i>Add Offer</a></div>
</div>
<div class="row m-0">
    @if (empty($categories))
      <div class="col-12">
          <h1 class="text-center">No Offers</h1>
      </div>
    @else
    @foreach ($categories as $offercategories)
    <div class="col-12 col-md-4 col-lg-4 col-sm-4 mb-3 pl-md-0">
        <div class="card">
        {{csrf_field()}}
          <div class="position-relative">
            <img src="{{url($offercategories->image)}}" class="card-img-top" alt="Events">
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
                <h5 class="card-title">{{$offercategories->title}}
                  <span class="d-block"> {{$offercategories->promo_code}}</span>
                  <span class="d-block"><i class="fas fa-calendar-alt"></i> Reedem before {{date("d M'y", strtotime($offercategories->expire_date))}}</span>
                </h5>
                <div class="card-border"></div>
              </div>
              <div class="col-4 col-md-4 p-0 categ-text">
                <div class="bg-orange offer-price">
                  <p>PRICE
                    <span>${{$offercategories->price}}</span>
                  </p>
                </div>
              </div>
            </div>
            <p class="card-text">{{$offercategories->short_description}}</p>
            <a class="edit_event" href="{{route('edit_offer', encrypt($offercategories->id))}}" id=""><i class="fa fa-edit"></i></a>
            <a class="delete_app ml-2" id="{{$offercategories->id}}"><i class="fa fa-trash"></i></a>
            <a href="{{route('details',['name' => 'deal', 'id' => $offercategories->id])}}" class="float-right text-dark"><i class="fas fa-long-arrow-alt-right"></i></a>
          </div>
        </div>
      </div>
    @endforeach
</div>
<div class="row m-0">
    <nav aria-label="Page navigation example">
      {{$categories->links()}}
    </nav>
</div>
@endif

<script>
$(document).ready(function (){
    $(".delete_app").click(function(){
        if(confirm('Are you sure?')) {
            var appdel_id=this.id;
            var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
            redirectPost('delete_offers', fd);
        }
    });
});
var redirectPost = function (url, data = null, method = 'post') {
    var form = document.createElement('form');
    form.method = method;
    form.action = url;
    for (var name in data) {
        var input = document.createElement('input');
        input.type = 'hidden';
        input.name = name;
        input.value = data[name];
        form.appendChild(input);
    }
    $('body').append(form);
    form.submit();
}
</script>
@endsection
@extends('front.home.details-master')

@section('details-content')
<div class="row">
    <div class="col-6">
        <h2 class="bebasnew">Business Details</h2>
        <hr>
        <h4>{{$data[0]['name']}}</h4>
        <p>Address: {{$data[0]['address']}}</p>
        <p>Category: {{$data[0]['businesstype']['name']}}</p>
        <p>Contact: {{$data[0]['mobile']}}</p>
        <p>ABN: {{$data[0]['abn']}}</p>
        <p>Description: {{$data[0]['description']}}</p>

    </div>
    <div class="col-6">
        <img src="{{asset($data[0]['image'])}}" alt="" width="500">
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Services</h2>
        <hr>
        <ol>
        @foreach ($data[0]['services'] as $item)
            <?php
                echo '<li>'.$item['name'] . ' - Rs.' . $item['price'] . '/-'.'</li>';
            ?>
        @endforeach
        </ol>
    </div>
</div>
{{-- <div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Products</h2>
        <hr>
        <ol>
        @foreach ($data[0]['products'] as $item)
            <?php
                // echo '<li>'.$item['name'] . ' - Rs.' . $item['price'] . '/-'.'</li>';
            ?>
        @endforeach
    </ol>
    </div>
</div> --}}
<div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Deals</h2>
        <hr>
        <ol>
            @foreach ($data[0]['offers'] as $item)
                <?php
                    echo '<li>'.$item['title'] . ' - Rs.' . $item['price'] . '/-'.'<br>';
                    echo 'Promo Code: '.$item['promo_code'].'</li>';
                ?>
            @endforeach
        </ol>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Events</h2>
        <hr>
        <ol>
        @foreach ($data[0]['events'] as $item)
            <?php
                echo '<li>'.$item['name'].'</li>' ;
            ?>
        @endforeach
        </ol>
    </div>
</div>
<div class="row mt-5">
    <div class="col-12">
        <h2 class="bebasnew">Reviews</h2>
        <hr>
        <ol>
            @foreach ($ratings as $item)
                <li>{{$item->description}} <span> - by {{$item->user->name}} </span></li>
            @endforeach
        </ol>
        <a href="{{route('rating.add', ['businessId'=>$data[0]['id']])}}" class="orange-btm load_btn">Add Comment</a>
    </div>
</div>
@endsection
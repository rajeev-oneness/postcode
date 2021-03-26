@extends('front.master')

@section('title')
    Directory - Home Page
@endsection

@section('content')
<form action="{{route('rating.store')}}" method="post">
    @csrf
    <input type="hidden" name="businessId" value="{{$id}}">
    <div class="custom-review">
        Your experience with us out of 5
        <div class="rating">
            <input type="radio" name="rating" value="5" id="5"><label for="5">☆</label> 
            <input type="radio" name="rating" value="4" id="4"><label for="4">☆</label>
            <input type="radio" name="rating" value="3" id="3"><label for="3">☆</label> 
            <input type="radio" name="rating" value="2" id="2"><label for="2">☆</label> 
            <input type="radio" name="rating" value="1" id="1"><label for="1">☆</label>
        </div>
        
        <div class="mb-3">
            <textarea name="description" id="description" class="form-control" placeholder="Write something about your experience..." cols="10" rows="5"></textarea>
        </div>
        <button type="submit" class="btn btn-success">Add Review</button>
        
    </div>
</form>
@endsection
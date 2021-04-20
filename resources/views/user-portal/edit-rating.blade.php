<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>User | Edit Rating</title>

    @extends('user-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Edit Rating</h3>
                  </div>
                </div>
               
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
            <div class="row">
              <div class="col-xl-8 xl-100">
                <div class="row">
                    <div class="col-12 mt-5">
                      <form action="{{route('user.rating.update')}}" method="POST">
                        @csrf
                        <input type="hidden" name="rating_id" value="{{encrypt($rating->id)}}">
                        <div class="container">    
                        <fieldset class="rating">
                            <legend>Edit rating:</legend>
                            @for ($i = 5; $i >= 1; --$i)
                              @if ($rating->rating == $i)
                                <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" checked /><label for="star{{$i}}">{{$i}} stars</label>    
                              @else
                                <input type="radio" id="star{{$i}}" name="rating" value="{{$i}}" /><label for="star{{$i}}">{{$i}} stars</label>    
                              @endif
                            @endfor
                        </fieldset>
                        
                        <textarea name="description" class="form-control" cols="30" rows="5" placeholder="Write your review...">{{$rating->description}}</textarea>
                        
                        <button type="submit" class="btn btn-success mt-3">Update Review</button>
                        </div>
                    </form>
                    <style>
                        .rating {
                        float:left;
                    }
                    
                    /* :not(:checked) is a filter, so that browsers that don’t support :checked don’t 
                       follow these rules. Every browser that supports :checked also supports :not(), so
                       it doesn’t make the test unnecessarily selective */
                    .rating:not(:checked) > input {
                        position:absolute;
                        top:-9999px;
                        clip:rect(0,0,0,0);
                    }
                    
                    .rating:not(:checked) > label {
                        float:right;
                        width:1em;
                        padding:0 .1em;
                        overflow:hidden;
                        white-space:nowrap;
                        cursor:pointer;
                        font-size:200%;
                        line-height:1.2;
                        color:#ddd;
                        text-shadow:1px 1px #bbb, 2px 2px #666, .1em .1em .2em rgba(0,0,0,.5);
                    }
                    
                    .rating:not(:checked) > label:before {
                        content: '★ ';
                    }
                    
                    .rating > input:checked ~ label {
                        color: #f70;
                        text-shadow:1px 1px #c60, 2px 2px #940, .1em .1em .2em rgba(0,0,0,.5);
                    }
                    
                    .rating:not(:checked) > label:hover,
                    .rating:not(:checked) > label:hover ~ label {
                        color: gold;
                        text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
                    }
                    
                    .rating > input:checked + label:hover,
                    .rating > input:checked + label:hover ~ label,
                    .rating > input:checked ~ label:hover,
                    .rating > input:checked ~ label:hover ~ label,
                    .rating > label:hover ~ input:checked ~ label {
                        color: #ea0;
                        text-shadow:1px 1px goldenrod, 2px 2px #B57340, .1em .1em .2em rgba(0,0,0,.5);
                    }
                    
                    .rating > label:active {
                        position:relative;
                        top:2px;
                        left:2px;
                    }
                    </style>
                    </div>
                </div>
              </div>
            
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection
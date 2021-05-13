@extends('front.home.community.community')

@section('com-title')
    View
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Category</a></li>
@endsection

@section('community')
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="40%">Title</th>
        <th scope="col">Author</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
      @forelse ($community as $item)
          <tr>
              <td>{{$i++}}</td>
              <td><a href="{{route('community.post.detail',base64_encode($item->id))}}">{{$item->title}}</a></td>
              <td>
                  <strong>{{$item->user->name}}</strong>
                  <span class="text-muted">(On {{date('d M,y', strtotime($item->created_at))}})</span>
              </td>
              <td>
                  <i class="fas fa-thumbs-up text-primary"></i> {{count($item->get_likes)}} likes &nbsp;&nbsp;
                  <i class="fas fa-comment text-warning"></i> {{count($item->comments)}} comments
              </td>
          </tr>
      @empty
          <tr class="text-center">No Data!</tr>
      @endforelse
    </tbody>
  </table>  
</div>

    
@endsection
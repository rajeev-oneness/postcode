@extends('front.home.community.community')

@section('com-title')
    Community Groups
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>Community Groups</a></li>
@endsection

@section('community')

<table class="table table-striped community_table table-sm">
    <thead>
      <tr>
        <!--<th scope="col">#</th>-->
        <th class="w-200">Name</th>
        <th>Created By</th>
      </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
      @forelse ($community_all_groups as $item)
          <tr>
              <!--<td>{{$i++}}</td>-->
              <td class="border-right"><a href="{{route('community.group.detail',base64_encode($item->id))}}">{{$item->name}}</a></td>
              <td>
                  <strong>{{$item->user->name}}</strong>
                  <span class="text-muted">(On {{date('d M,y', strtotime($item->created_at))}})</span>
              </td>

          </tr>
      @empty
          <tr class="text-center">No Data!</tr>
      @endforelse
    </tbody>
  </table>
</div>


@endsection

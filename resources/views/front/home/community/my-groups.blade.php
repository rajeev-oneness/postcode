@extends('front.home.community.community')

@section('com-title')
    My Groups
@endsection

@section('brd_name')
<li><a href="{{route('community.show')}}">Community</a></li>
<li><img src="{{asset('homepage_assets/images/down-arrow.png')}}"></li>
<li>My Groups</a></li>
@endsection

@section('community')
<table class="table table-hover">
    <thead>
      <tr>
        <th scope="col">#</th>
        <th scope="col" width="40%">Name</th>
        <th scope="col">Created By</th>
        <th scope="col">Action</th>
      </tr>
    </thead>
    <tbody>
        @php
            $i = 1;
        @endphp
      @forelse ($community_groups as $item)
          <tr>
              <td>{{$i++}}</td>
              <td><a href="{{route('community.group.detail',base64_encode($item->id))}}">{{$item->name}}</a></td>
              <td>
                  <strong>{{$item->user->name}}</strong>
                  <span class="text-muted">(On {{date('d M,y', strtotime($item->created_at))}})</span>
              </td>
              <td>
                  <a href="{{route('community.edit.group',base64_encode($item->id))}}" title="Edit Group"><i class="fas fa-edit text-success"></i></a> &nbsp;&nbsp;
                  <a onclick="return confirm('Are you sure?')" href="{{route('community.delete.group',$item->id)}}" title="Delete Post"><i class="fas fa-trash text-danger"></i></a>
              </td>
          </tr>
      @empty
          <tr class="text-center">No Data!</tr>
      @endforelse
    </tbody>
    <tfoot class="">
        <a href="{{route('community.add.groups')}}" class="primery-button orange-btm m-3">Add Group</a>
    </tfoot>
  </table>
</div>


@endsection

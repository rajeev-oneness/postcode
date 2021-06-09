<!DOCTYPE html>
<html lang="en">

    
<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Manage Leads</title>
    

@extends('business-portal.layouts.master')
@section('content')

<div class="row m-0">
    <h3>Requested Leads</h3>
    <div class="table-responsive">
        <table class="table table-hover">
            <thead>
                <tr>
                    <th>SL.</th>
                    <th>Name</th>
                    <th>Email</th>
                    <th>Phone</th>
                    <th>Importance</th>
                    {{-- <th>Action</th> --}}
                </tr>
            </thead>
            <tbody>
                @forelse ($leads as $key => $lead)
                    <tr>
                        <td>{{$key+1}}</td>
                        <td>{{$lead->name}}</td>
                        <td>{{$lead->email}}</td>
                        <td>{{$lead->phone}}</td>
                        <td>
                            @if($lead->importance == 1) 
                            I want to purchase immediately
                            @elseif ($lead->importance == 2) 
                            I just want a quote
                            @elseif ($lead->importance == 3)
                            I'm not ready to purchase but have an interest
                            @endif
                        </td>
                        {{-- <td><a class="delete_app ml-2" title="Delete Lead" id="{{$lead->id}}"><i class="fa fa-trash text-danger"></i></a></td> --}}
                    </tr>
                @empty
                <tr>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    <td>N/A</td>
                    {{-- <td>N/A</td> --}}
                </tr>
                @endforelse
            </tbody>
        </table>
    </div>
</div>
{{-- <script>
    $(document).ready(function (){
        
        $(".delete_app").click(function(){
            if(confirm('Are you sure?')) {
                var appdel_id=this.id;
                var fd = {'appdel_id': appdel_id,'_token':$('input[name="_token"]').val()};
                redirectPost('delete_ratings', fd);
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
</script> --}}
@endsection
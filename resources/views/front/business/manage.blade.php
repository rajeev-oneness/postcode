@extends('front.master')

@section('title')
    Manage Business
@endsection

@section('content')

<div class="page-body">
    <div class="container-fluid">
        <div class="page-header">
            <!-- start page title -->
            <div class="row">
                <div class="col-12">
                    <div class="page-title-box d-flex align-items-center justify-content-between p-5">
                        <h4 class="mb-0 font-size-18">Manage Businesses</h4>
                        <div class="page-title-right">
                            <a href="{{route('business.add')}}"> <button type="button" id="submit_product" name="submit_product" class="btn btn-primary w-md">Add Business</button></a>
                        </div>
                    </div>
                </div>
            </div>
            <!-- end page title -->
        </div>
    </div>
    <!-- Container-fluid starts-->
    <div class="container-fluid">
        <div class="row">
            <!-- Zero Configuration  Starts-->
            <div class="col-sm-12">
                <div class="card">
                    {{csrf_field()}}
                    <div class="card-body">
                        <div class="table-responsive">
                            <table class="table table-striped" id="businessprofile_mnanage">
                                <thead>
                                    <tr>
                                        <th width="46px;">Sl No.</th>
                                        <th>Name</th>
                                        <th width="90px;">Address</th>
                                        <th width="197px;">Action</th>

                                    </tr>
                                </thead>
                                <tbody>
                                    @php
                                        $i = 1
                                    @endphp
                                    @foreach ($businessDatas as $businessData)
                                        <tr>
                                            <td>{{$i++}}</td>
                                            <td>{{$businessData->name}}</td>
                                            <td>{{$businessData->address}}</td>
                                            <td>
                                                <a href="{{route('business.edit', ['id' => $businessData->id])}}"><i class="fal fa-pencil"></i></a>
                                                <a href="#" onclick="myFunc(this.id)" id="{{$businessData->id}}" class="m-2"><i class="fal fa-trash"></i></a>
                                            </td>
                                        </tr>
                                    @endforeach
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <!-- Zero Configuration  Ends-->


        </div>
        <script>
            function myFunc(businessId) {
                if(confirm('Are you sure?')) {
                    $.ajax({
                        type:'POST',
                        url: '{{route('business.delete')}}',
                        data:{_token : '{{csrf_token()}}', id : businessId},
                        success:function(data) {
                            alert('Deleted successfully!');
                            location.reload(true);
                        }
                    });
                }
            }
        </script>
@endsection
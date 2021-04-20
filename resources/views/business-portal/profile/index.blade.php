<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Business-Admin | Profile</title>

    @extends('business-portal.layouts.master')
    @section('content')
        <!-- Page Sidebar Ends-->
       
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Profile View</h3>
                  </div>
                </div>
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid">
              <h3>{{$business[0]->name}}</h3>
              <p><strong>Address : </strong>{{$business[0]->business->address}} </p>
              <p><strong>Postcode : </strong>{{$business[0]->business->pin_code}} </p>
              <p><strong>Phone : </strong>{{$business[0]->business->mobile}} </p>
              <p><strong>Email : </strong>{{$business[0]->business->email}} </p>
              <p><strong>ABN : </strong>{{$business[0]->business->abn}} </p>
              <p><strong>Website : </strong>{{$business[0]->business->company_website}} </p>
              <div class="mt-3">
                <a href="{{route('my.business.profile.edit')}}" class="btn btn-primary"> <i class="fa fa-pencil"></i> Edit Profile </a>
              </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>
       

@endsection
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Service</title>

    @extends('portal.layouts.master')
    @section('content')

    <style>
    .flowid {
        width: 99%;
    padding-right: 15px;
    padding-left: 21%;
    }
    </style>
    <style>
      .switch {
        position: relative;
        display: inline-block;
        width: 26px;
    height: 15px;
    margin-bottom: -3px;
      }
      
      .switch input { 
        opacity: 0;
        width: 0;
        height: 0;
      }
      
      .slider {
        position: absolute;
        cursor: pointer;
        top: 0;
        left: 0;
        right: 0;
        bottom: 0;
        background-color: #ccc;
        -webkit-transition: .4s;
        transition: .4s;
      }
      
      .slider:before {
        position: absolute;
        content: "";
        height: 10px;
    width: 10px;
    left: 4px;
    bottom: 3px;
        background-color: white;
        -webkit-transition: .4s;
        transition: .4s;
      }
      
      input:checked + .slider {
        background-color: #2196F3;
      }
      
      input:focus + .slider {
        box-shadow: 0 0 1px #2196F3;
      }
      
      input:checked + .slider:before {
        -webkit-transform: translateX(9px);
        -ms-transform: translateX(9px);
        transform: translateX(9px);
      }
      
      /* Rounded sliders */
      .slider.round {
        border-radius: 34px;
      }
      
      .slider.round:before {
        border-radius: 50%;
      }
      .toggel-block{
        display:block !important;
      }
      .toggel-none{
        display:none;
      }
      </style>
      <!-- Page Body Start-->
      <div class="page-body-wrapper">
        <div class="page-body"> 
          <div class="container-fluid flowid">
            <div class="page-header">
              <div class="row">
                <div class="col">
                  <div class="page-header-left">
                    <h3>Add Service Details</h3>
                   
                  </div>
                </div>
             
              </div>
            </div>
          </div>
          <!-- Container-fluid starts-->
          <div class="container-fluid flowid">
            <div class="row">
              <div class="col-sm-12">
                <div class="card">
                 
                  <div class="card-body">
                    <form class="needs-validation" novalidate="">
                    <input type="hidden" id="hid_id" name="hid_id">
                    {{csrf_field()}}
                      <div class="form-row">
                        <div class="col-md-4 mb-3">
                        <div class="form-group">
                                                <label for="formrow-inputState">Business Category</label>
                                                <select id="business_categoryId" name="business_categoryId" class="form-control">
                                                <option value="">Select</option>
                                                @foreach($servicesData as $servicesName)
                                                <option value="{{$servicesName->id}}">{{$servicesName->name}}</option>
                                                @endforeach
                                                </select>
                                            </div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Service Name</label>
                          <input class="form-control" id="name" name="name" type="text" placeholder="Enter Product Name" required="">
                         
                        </div>
                       
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Product Details</label>
                          <input class="form-control" id="details" name="details" type="text" placeholder="Enter Product Details" required="">
                         
                        </div>
                        
                      </div>
                   
                      <div class="form-row">
                      <div class="col-md-4 mb-3">
                          <label for="validationCustom05">Price</label>
                          <input class="form-control" id="price" name="price" type="text" placeholder="Enter Price" required="">
                         
                        </div>
                     
                        <div class="col-md-4 mb-3">
                          <label for="validationCustomUsername" style="margin-left:7%;">Image</label>
                          <div class="d-flex justify-content-center">
              <div class="btn btn-mdb-color btn-rounded">
               
                <input type="file" id="image" name="image">
              </div>
            </div>
                        </div>
                     
                      </div>

                      <button class="btn btn-primary" id="submit_product" name="submit_product" type="submit">Submit</button>
                    </form>
                  </div>
                </div>
               
              
              </div>
            </div>
          </div>
          <!-- Container-fluid Ends-->
        </div>

        <script>
            $(document).ready(function() {
         
           $("#toggle-ansa").change(function(){
            var check_stat=$(this).prop('checked');
            if(check_stat==true){
              $(".toggle3").toggleClass("toggel-none");
              $(".toggle4").toggleClass("toggel-block");
            }else{
              $(".toggle3").toggleClass("toggel-none");
              $(".toggle4").toggleClass("toggel-block");
            }
           });
           $("#toggle-ansb").change(function(){
            var check_stat=$(this).prop('checked');
            if(check_stat==true){
              $(".toggle5").toggleClass("toggel-none");
              $(".toggle6").toggleClass("toggel-block");
            }else{
              $(".toggle5").toggleClass("toggel-none");
              $(".toggle6").toggleClass("toggel-block");
            }
           });
           $("#toggle-ansc").change(function(){
            var check_stat=$(this).prop('checked');
            if(check_stat==true){
              $(".toggle7").toggleClass("toggel-none");
              $(".toggle8").toggleClass("toggel-block");
            }else{
              $(".toggle7").toggleClass("toggel-none");
              $(".toggle8").toggleClass("toggel-block");
            }
           });
           $("#toggle-ansd").change(function(){
            var check_stat=$(this).prop('checked');
            if(check_stat==true){
              $(".toggle9").toggleClass("toggel-none");
              $(".toggle10").toggleClass("toggel-block");
            }else{
              $(".toggle9").toggleClass("toggel-none");
              $(".toggle10").toggleClass("toggel-block");
            }
           });
              
                $('#submit_product').click(function(e) {
                   
                    e.preventDefault();
                    // var hid_id=$("#hid_id").val();
                  
                    // var token = $('input[name="_token"]').val();
                    var formElement = document.querySelector("form");
                    var formData = new FormData(formElement); //append data
                    // formData.append('hid_id',hid_id);
                

                    $.ajax({
                        type: "post",
                        url: "{{route('admin.add_services')}}",
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: "json",
                        success: function(response) {

                            if (response.status == 1) {
                                window.location.href = "{{route('admin.dashboard')}}";
                            } else {
                                $('#err_msg').show();
                        $('#err_msg').html(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // $('#submit_subject').html("Login");
                            // $('#submit_subject').attr("disabled", false);
                            var msg = "";
                            if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                                msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                            } else {
                                if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                    msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                                } else {
                                    msg += "<strong><ul style='list-style:none;'>";
                                    $.each(jqXHR.responseJSON.errors, function(key, value) {
                                        msg += "<li style='margin-left:0px;'>" + value + "</li>";
                                    });
                                    msg += "</ul></strong>";
                                }
                            }
                            toastr.warning(msg, 'Error!', {
                                "progressBar": true,
                                positionClass: 'toast-top-right',
                                containerId: 'toast-top-right'
                            });

                        }
                    });
                });

              
                
            });

         
        </script>
      
        @endsection
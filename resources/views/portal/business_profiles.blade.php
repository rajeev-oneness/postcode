<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Add Examination</title>

    @extends('portal.layouts.master')
    @section('content')

    <style>
    .flowid {
        width: 99%;
    padding-right: 15px;
    padding-left: 21%;
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
                    <h3>Business Details</h3>
                   
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
                          <label for="validationCustom01">Name</label>
                          <input class="form-control" id="name" name="name" type="text" placeholder="Name" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustom02">Address</label>
                          <input class="form-control" id="address" name="address" type="text" placeholder="Address" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-4 mb-3">
                          <label for="validationCustomUsername">Mobile</label>
                          <div class="input-group">                          
                            <input class="form-control" id="mobile" name="mobile" type="text" placeholder="Mobile" aria-describedby="inputGroupPrepend" required="">
                            <div class="valid-feedback">Looks good!</div>
                          </div>
                        </div>
                      </div>
                      <div class="form-row">
                        
                        <div class="col-md-4 mb-4">
                          <label for="validationCustomUsername">Image
                            <label class="switch">
                              <input type="checkbox" id="toggle-qust" name="toggle-qust">
                              <span class="slider round"></span>
                            </label>
                          </label>
                          <div class="input-group">                     
                            <input class="form-control toggle1" id="qdesc" name="qdesc" type="hidden" placeholder="Description" aria-describedby="inputGroupPrepend" required="">
                           <input class="form-control toggle2 toggel-none" type="file" id="qdesc1" name="qdesc1" >
                          </div>
                        </div>
                        <div class="col-md-4 mb-4">
                          <label for="validationCustom04">Exam Description</label>
                          <input class="form-control" id="exam_desc" name="exam_desc" type="text" placeholder="Exam Description" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-4 mb-4">
                          <label for="validationCustom05">Exam Negative Marking Flag</label>
                          <input class="form-control" id="exam_negative_marking_flag" name="exam_negative_marking_flag" type="text" placeholder="Exam Negative Marking Flag" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                      </div>
                      <div class="form-row">
                      <div class="col-md-3 mb-3">
                          <label for="validationCustom05">Original Paper Flag</label>
                          <input class="form-control" id="original_paper_flag" name="original_paper_flag" type="text" placeholder="Original Paper Flag" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                      <div class="col-md-3 mb-3">
                          <label for="validationCustom05">Exam Year</label>
                          <input class="form-control" id="exam_year" name="exam_year" type="text" placeholder="Exam Year" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom05">Exam Month</label>
                          <input class="form-control" id="exam_month" name="exam_month" type="text" placeholder="Exam Month" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                        <div class="col-md-3 mb-3">
                          <label for="validationCustom05">Exam Date</label>
                          <input class="form-control" id="exam_date" name="exam_date" type="text" placeholder="Exam Date" required="">
                          <div class="valid-feedback">Looks good!</div>
                        </div>
                       
                      </div>
                      <div class="form-group">
                        <div class="form-check">
                          <div class="checkbox p-0">
                            <input class="form-check-input" id="invalidCheck" type="checkbox" required="">
                            <label class="form-check-label" for="invalidCheck">Agree to terms and conditions</label>
                          </div>
                          <div class="invalid-feedback">You must agree before submitting.</div>
                        </div>
                      </div>
                      <button class="btn btn-primary" id="submit_examination" name="submit_examination" type="submit">Submit form</button>
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

              $("#toggle-qust").change(function(){
            var check_stat=$(this).prop('checked');
            if(check_stat==true){
              $(".toggle1").toggleClass("toggel-none");
              $(".toggle2").toggleClass("toggel-block");
            }else{
              $(".toggle1").toggleClass("toggel-none");
              $(".toggle2").toggleClass("toggel-block");
            }
           });  
                
              
                $('#submit_examination').click(function(e) {
                   
                    e.preventDefault();
                    var hid_id=$("#hid_id").val();
                  
                    var exam_name = $("#exam_name").val();
                    var exam_Duration = $("#exam_Duration").val();
                    var exam_Total_Marks = $("#exam_Total_Marks").val();
                    var exam_cut_off = $("#exam_cut_off").val();
                    var exam_desc = $("#exam_desc").val();
                    var exam_negative_marking_flag = $("#exam_negative_marking_flag").val();
                    var original_paper_flag = $("#original_paper_flag").val();
                    var exam_year = $("#exam_year").val();
                    var exam_month = $("#exam_month").val();
                    var exam_date = $("#exam_date").val();
                    var token = $('input[name="_token"]').val();
                   
                    var formData = new FormData(); //append data
                    formData.append('hid_id',hid_id);
                    formData.append('exam_name', exam_name);
                    formData.append('exam_Duration', exam_Duration);
                    formData.append('exam_Total_Marks', exam_Total_Marks);
                    formData.append('exam_cut_off', exam_cut_off);
                    formData.append('exam_desc', exam_desc);
                    formData.append('exam_negative_marking_flag', exam_negative_marking_flag);
                    formData.append('original_paper_flag', original_paper_flag);
                    formData.append('exam_year', exam_year);
                    formData.append('exam_month', exam_month);
                    formData.append('exam_date', exam_date);

                    formData.append('_token', token);
                    if(hid_id==''){
            var save_url="/adding-business";
         }else{
            var save_url="/update_exam_details";
         }

                    $.ajax({
                        type: "post",
                        url: save_url,
                        cache: false,
                        processData: false,
                        contentType: false,
                        data: formData,
                        dataType: "json",
                        success: function(response) {

                            if (response.status == 1) {
                                window.location.href = "/manage_employee";
                            } else {
                                $('#err_msg').show();
                        $('#err_msg').html(response.message);
                            }
                        },
                        error: function(jqXHR, textStatus, errorThrown) {
                            // $('#submit_examination').html("Login");
                            // $('#submit_examination').attr("disabled", false);
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

                <?php
          if(isset($data)) {          
          ?>
                  $('#hid_id').val('<?php echo $data->id; ?>');
          
           $('#exam_name').val('<?php echo $data->exam_name; ?>');
          $('#exam_Duration').val('<?php echo $data->exam_Duration; ?>');
          $('#exam_Total_Marks').val('<?php echo $data->exam_Total_Marks; ?>');
          $('#exam_cut_off').val('<?php echo $data->exam_cut_off; ?>');
          $('#exam_negative_marking_flag').val('<?php echo $data->exam_negative_marking_flag; ?>');
          $('#original_paper_flag').val('<?php echo $data->original_paper_flag; ?>');
          $('#exam_year').val('<?php echo $data->exam_year; ?>');
          $('#exam_month').val('<?php echo $data->exam_month; ?>');
          $('#exam_date').val('<?php echo $data->exam_date; ?>');
        
          <?php }  ?>
                
            });

         
        </script>
        @endsection
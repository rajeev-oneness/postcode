<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Employee</title>

    @extends('portal.layouts.master')
    @section('content')
        <!-- Right sidebar Ends-->
        <div class="page-body">
          <div class="container-fluid">
            <div class="page-header">
               <!-- start page title -->
               <div class="row">
                    <div class="col-12">
                        <div class="page-title-box d-flex align-items-center justify-content-between">
                            <h4 class="mb-0 font-size-18">Manage Products</h4>
                            <!-- <div class="page-title-right">
                                <a href="/admin/add_subjects" <button type="button" id="submit_product" name="submit_product" class="btn btn-primary w-md">Add Subjects</button></a>
                            </div> -->
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
                      <table class="display" id="subject_manage">
                        <thead>
                          <tr>
                          <th>Sl No.</th>
                            <th>Business Category</th>
                            <th>Name</th>
                            <th>Details</th>
                            <th>Price</th>
                            <th>Image</th>                       
                            <th>Action</th>
                            
                          </tr>
                        </thead>
                        <tbody>                   
                         
                        </tbody>
                      </table>
                    </div>
                  </div>
                </div>
              </div>
              <!-- Zero Configuration  Ends-->
             
            
            
              
          <!-- Container-fluid Ends-->
        </div>


        <script>
            $(document).ready(function() {
                create_table();
                var table1 = $('#subject_manage').DataTable();
                table1.on('draw.dt', function() {
                    $(".edit_subject").click(function() {
                        var lead_call_id = this.id;
                        var fd = {
                            'lead_edit_id': lead_call_id,
                            '_token': $('input[name="_token"]').val()
                        };

                        redirectPost('edit_subject', fd);
                    });
                    $(".delete_subjects").click(function() {
                        var lead_call_id = this.id;
                        var token = $("input[name='_token']").val();
                        $(".se-pre-con").fadeIn("slow");
                        $.ajax({
                            url: "delete_subjects_details",
                            type: "post",
                            data: {
                                '_token': token,
                                'lead_call_id': lead_call_id
                            },
                            success: function(response) {
                                $(".se-pre-con").fadeOut("slow");
                                if (response.status == 1) {
                                    $.confirm({
                                        title: 'Success!',
                                        content: response.message,
                                        type: 'green',
                                        typeAnimated: true,
                                        icon: 'fa fa-check',

                                    });
                                } else {
                                    $.confirm({
                                        title: 'Error!',
                                        content: response.message,
                                        type: 'red',
                                        typeAnimated: true,
                                        icon: 'fa fa-exclamation-triangle',
                                    });
                                }

                            },
                            error: function(jqXHR, textStatus, errorThrown) {
                                $(".se-pre-con").fadeOut("slow");
                                var msg = "";
                                if (jqXHR.status !== 422 && jqXHR.status !== 400) {
                                    msg += "<strong>" + jqXHR.status + ": " + errorThrown + "</strong>";
                                } else {
                                    if (jqXHR.responseJSON.hasOwnProperty('exception')) {
                                        msg += "Exception: <strong>" + jqXHR.responseJSON.exception_message + "</strong>";
                                    } else {
                                        msg += "Error(s):<strong><ul>";
                                        $.each(jqXHR.responseJSON, function(key, value) {
                                            msg += "<li>" + value + "</li>";
                                        });
                                        msg += "</ul></strong>";
                                    }
                                }
                                $.alert({
                                    title: 'Error!!',
                                    type: 'red',
                                    icon: 'fa fa-warning',
                                    content: msg,
                                });
                            }


                        });
                        create_table();
                    });

                });
            });

            var redirectPost = function(url, data = null, method = 'post') {
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
            };

            function create_table() {
                var table = "";
                var token = $('input[name="_token"]').val();


                $("#subject_manage").dataTable().fnDestroy()
                table = $('#subject_manage').DataTable({
                    "processing": true,
                    "serverSide": true,
                    "ajax": {
                        url: "/admin/ajax_product_details",
                        type: "post",
                        data: {
                            '_token': $('input[name="_token"]').val()
                        },
                        dataSrc: "product_details"
                    },
                    "dataType": 'json',
                    "columnDefs": [{
                            className: "table-text",
                            "targets": "_all"
                        },
                        {
                            "targets": 0,
                            "data": "id",
                            "defaultContent": "",
                        },
                        {
                            "targets": 1,
                            "data": "name",
                        },
                        {
                            "targets": 2,
                            "data": "name",
                        },
                        {
                            "targets": 3,
                            "data": "details",
                        },
                        {
                            "targets": 4,
                            "data": "price",
                        },
                        {
                            "targets": 5,
                            "data": "image",
                            "render": function(data, type, full, meta) {
                                var str_btns = "<img src='/uploads" + data +"' style='width: 40%;'>";
                                return str_btns;
                            }
                        },
                       
                        {
                            "targets": -1,
                            "data": 'action',
                            "searchable": false,
                            "sortable": false,
                            "render": function(data, type, full, meta) {
                                var str_btns = "<div class='form-inline'>";
                                str_btns += "<a href='javascript:' class='edit_subject btn btn-mini' id='" + data.e + "' title='Click To Edit' style='cursor:pointer'><i class='fa fa-edit' aria-hidden='true'></i></a>&nbsp&nbsp";

                                str_btns += "<a href='javascript:' class='delete_subjects btn btn-mini' id='" + data.e + "' title='Click To Delete' style='cursor:pointer'><i class='fa fa-trash' aria-hidden='true'></i></a>";



                                str_btns += "</div>";
                                return str_btns;
                            }
                        }
                    ],

                    "order": [
                        [0, 'desc']
                    ]
                });
                table.on('order.dt search.dt draw.dt', function() {
                    $('[data-toggle="tooltip"]').tooltip();
                    table.column(0, {
                        search: 'applied',
                        order: 'applied'
                    }).nodes().each(function(cell, i) {
                        cell.innerHTML = table.page() * table.page.len() + (i + 1);
                    });
                });

                // table.columns( [-4,-3,-2,-1] ).visible( false );
            }
        </script>



        @endsection
<!DOCTYPE html>
<html lang="en">


<head>

    <meta charset="utf-8" />
    <title>Admin | Manage Business Profiles</title>

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
                            <h4 class="mb-0 font-size-18">Manage Business Profiles</h4>
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
                                <table class="display" id="businessprofile_mnanage">
                                    <thead>
                                        <tr>
                                            <th>Sl No.</th>
                                            <th>Business Category</th>
                                            <th>Name</th>
                                            <th>Address</th>
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


            </div>

            <script>
                $(document).ready(function() {
                    create_table();
                    var table1 = $('#businessprofile_mnanage').DataTable();
                    table1.on('draw.dt', function() {
                        $(".edit_businessprofiles").click(function() {
                            var lead_call_id = this.id;
                            var fd = {
                                'lead_edit_id': lead_call_id,
                                '_token': $('input[name="_token"]').val()
                            };

                            redirectPost('edit_businessprofile', fd);
                        });
                        $(".delete_businessprofiles").click(function() {
                            var lead_call_id = this.id;
                            var fd = {
                                'lead_delete_id': lead_call_id,
                                '_token': $('input[name="_token"]').val()
                            };

                            redirectPost('delete_businessprofiles', fd);
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


                    $("#businessprofile_mnanage").dataTable().fnDestroy()
                    table = $('#businessprofile_mnanage').DataTable({
                        "processing": true,
                        "serverSide": true,
                        "ajax": {
                            url: "{{route('admin.business_profile_details')}}",
                            type: "post",
                            data: {
                                '_token': $('input[name="_token"]').val()
                            },
                            dataSrc: "businessprofile_details"
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
                            "data": "businessId",
                        },
                            {
                            "targets": 3,
                            "data": "address",
                        },
                       
                        {
                            "targets": 2,
                            "data": "name",
                        },
                      
                        {
                            "targets": 4,
                            "data": "image",
                            "render": function(data, type, full, meta) {
                                var str_btns = "<img src='/" + data +"' style='width: 40%;'>";
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
                                    str_btns += "<a href='javascript:' class='edit_businessprofiles btn btn-mini' id='" + data.e + "' title='Click To Edit' style='cursor:pointer'><i class='fa fa-edit' aria-hidden='true'></i></a>&nbsp&nbsp";

                                    str_btns += "<a href='javascript:' class='delete_businessprofiles btn btn-mini' id='" + data.e + "' title='Click To Delete' style='cursor:pointer'><i class='fa fa-trash' aria-hidden='true'></i></a>";



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
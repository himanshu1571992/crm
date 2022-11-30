<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <?php echo form_open($this->uri->uri_string(), array('id' => 'department_form', 'class' => 'department-form')); ?>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div> 
                                    <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div>   
                                </div>
                            </div>
                            <div class="row">
                                <br>
                                <div class="col-md-12">  <div class="table-responsive">                                                    
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Employee Name</th>
                                                    <th>Email Id</th>
                                                    <th>Contact Number</th>
                                                    <th>Registration Date</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($employee_list)) {
                                                    foreach ($employee_list as $key => $value) {

                                                        $id = '';
                                                        if ($value->approval_status == 0) {
                                                            $status = 'Send for Approval';
                                                            $cls = 'btn-warning';
                                                            $id = 'reg_employee';
                                                            $datatarget = 'send_apporal';
                                                        } elseif ($value->approval_status == 1) {
                                                            $status = 'Approved';
                                                            $cls = 'btn-success';
                                                            $datatarget = 'approve';
                                                        } elseif ($value->approval_status == 2) {
                                                            $status = 'Rejected';
                                                            $cls = 'btn-danger';
                                                            $datatarget = 'reject';
                                                            //$status='status1';
                                                        } elseif ($value->approval_status == 3) {
                                                            $status = 'Pending';
                                                            $cls = 'btn-warning';
                                                            $datatarget = 'approval';
                                                        }
                                                        ?>

                                                        <tr>
                                                            <td>
                                                                <?php echo ++$key; ?>
                                                                
                                                            </td>                                                
                                                            <td>
                                                                <?php echo get_creator_info($value->added_by, $value->created_at); ?>
                                                                <?php echo cc($value->employee_name); ?>
                                                            </td>
                                                            <td><?php echo $value->email; ?></td>
                                                            <td><?php echo $value->contact_no; ?></td>
                                                            <td><?php echo _d($value->created_at); ?></td>
                                                            <td>
                                                                <?php
                                                                    if ($value->approval_status == 1) {
                                                                        echo '<button type="button" class="' . $cls . ' btn-sm approve" id="' . $id . '" value="' . $value->staffid . '" data-toggle="modal" data-target="#' . $datatarget . '">' . $status . '</button>';
                                                                    } elseif ($value->approval_status == 2) {
                                                                        echo '<button type="button" class="' . $cls . ' btn-sm reject" id="' . $id . '" value="' . $value->staffid . '" data-toggle="modal" data-target="#' . $datatarget . '">' . $status . '</button>';
                                                                    } elseif ($value->approval_status == 4) {
                                                                        echo '<a href="' . admin_url() . 'staff/registered_employee_process/' . $value->staffid . '" target="_blank" class="btn-info btn-sm" >Form Pending</a>';
                                                                    } else {
                                                                        if (!empty($value->employee_name) && $value->designation_id > 0 && $value->branch_id > 0 && !empty($value->net_salary) && $value->superior_id > 0 && !empty($value->joining_date)){
                                                                            echo '<button type="button" class="' . $cls . ' btn-sm status" id="' . $id . '" value="' . $value->staffid . '" data-toggle="modal" data-target="#' . $datatarget . '">' . $status . '</button>';
                                                                        }else{
                                                                            echo '<a href="javascript:void(0);" class="btn-sm btn-info">Updated Company Details</a>';
                                                                        }
                                                                    }
                                                                ?>
                                                            </td> 
                                                            <td class="text-center">

                                                                <?php if ($value->approval_status != 4) { ?>
                                                                    <a href="<?php echo site_url('staff/employee_pdf/' . $value->staffid); ?>" target="_blank" class="btn-sm btn-info">PDF</a>
                                                                <?php } ?>
                                                                <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" <?php echo ($value->approval_status == 4) ? 'disabled' : "" ?> data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                        <li>
                                                                            <a href="<?php echo site_url('staff/employee_print/' . $value->staffid); ?>" target="_blank" title="PRINT">PRINT</a>                                                  
                                                                            <a href="<?php echo admin_url('staff/employee_view/' . $value->staffid); ?>"  target="_blank" title="VIEW"></i>VIEW</a>
                                                                            <?php
                                                                                $chk_emp = $this->db->query("SELECT `staffid` FROM tblstaff WHERE reg_id=" . $value->staffid . "")->row();
                                                                                if ($value->approval_status == 1 && empty($chk_emp)) {
                                                                            ?>
                                                                                <a href="<?php echo admin_url('letters_format/generate_offer_letter/' . $value->staffid); ?>" target="_blank" title="generate offer letter">GENERATE OFFER LETTER</a>                                                  
                                                                                <a href="<?php echo admin_url('staff/convert_to_employee/' . $value->staffid); ?>" target="_blank" title="Convert To Employee">CONVERT TO EMPLOYEE</a>                                                  
                                                                            <?php } ?>
                                                                        </li>
                                                                    </ul>
                                                                </div>
                                                            </td>
                                                        </tr>
                                                <?php
                                                        }
                                                    }
                                                ?>
                                            </tbody>

                                        </table>

                                    </div>

                                </div>



                            </div>



                    </div>
                    <?php echo form_close(); ?>

                </div>

            </div>      

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

</div> 

<!-- Email Modal -->

<div id="emailModal" class="modal fade" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Send Registration link to employee via email</h4>

            </div>

            <div class="modal-body">

                <form  action="<?php echo admin_url('staff/registration_email'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <div class="row">

                        <div class="form-group col-md-12">

                            <label for="email" class="control-label">Employee Email <span style="color: red;">*</span></label>

                            <input type="text" id="email" name="email" class="form-control" required="" value="">

                        </div>

                        <div class="form-group col-md-12">

                            <label for="subject" class="control-label">Subject <span style="color: red;">*</span></label>

                            <input type="text" id="subject" name="subject" class="form-control" required="" value="Employee Registration">

                        </div>



                        <div class="form-group col-md-12">

                            <label for="name" class="control-label">Email Body <span style="color: red;">*</span></label>

                            <textarea class="form-control tinymce " required="" name="message" id="message">

                        <h3>Welcome to SCHACH ENGINEERS PVT. LTD.</h3>

                        <p>Click On below link to register yourself as a Employee of SCHACH ENGINEERS PVT. LTD. </p>

                        <p><a href="#link#">Click for Registration</a></p>

                            </textarea>

                        </div>



                        <div class="form-group col-md-12">

                            <button class="btn btn-info" type="submit">Send Email</button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>



    </div>

</div>

<!-- whatsapp Modal -->

<div id="whatsappModal" class="modal fade" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Send Registration link to employee via Whatsapp</h4>

            </div>

            <div class="modal-body">

                <form  action="<?php echo admin_url('staff/registered_whatsapp'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <div class="row">

                        <div class="form-group col-md-12">

                            <label for="phone" class="control-label">Employee Mobile No. <span style="color: red;">*</span></label>

                            <input type="text" id="phone" name="phone" class="form-control" required="" value="+91">

                        </div>



                        <div class="form-group col-md-12">

                            <label for="name" class="control-label">Message Body <span style="color: red;">*</span></label>

                            <textarea class="form-control tinymce " required="" name="message" id="message">

                        Welcome to SCHACH ENGINEERS PVT. LTD.

                        Click On below link to register yourself as a Employee of SCHACH ENGINEERS PVT. LTD.

                       Click for Registration -

                            </textarea>

                        </div>



                        <div class="form-group col-md-12">

                            <button class="btn btn-info" type="submit">Send Whatsapp</button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>



    </div>

</div>



<div id="send_apporal" class="modal fade" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content  for send approval staff-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Send Approval</h4>

            </div>

            <div class="modal-body">

                <form  action="<?php echo admin_url('staff/employee_approval'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">

                    <div class="row">


                        <div class="col-md-12" style="margin-bottom:2%;">

                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>

                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">

<?php
if (isset($allStaffdata) && count($allStaffdata) > 0) {

    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
        ?>

                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                        <?php
                                        foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                            ?>

                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                            if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {

                                                echo'selected';
                                            }
                                            ?>>       <?php echo $singstaff['firstname'] ?></option>

                                            <?php }
                                            ?>

                                        </optgroup>

                                            <?php
                                        }
                                    }
                                    ?>

                            </select>



                        </div>

                        <div class="form-group col-md-12">

                            <label for="name" class="control-label">Remark <span style="color: red;">*</span></label>

                            <textarea class="form-control " required="" name="remark" id="remark"></textarea>

                        </div>

                        <input type="hidden" id="employee_id" name="employee_id">

                        <div class="form-group col-md-12">

                            <button class="btn btn-info" type="submit">Send</button>

                        </div>

                    </div>

                </form>

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>



    </div>

</div>

<!-- Modal for list staff apporval  -->
<div id="approval" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register Employee Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal for list staff reject  -->
<div id="reject" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register Employee Status</h4>
            </div>
            <div class="modal-body" id="approval_html1">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<!-- Modal for list staff approve  -->
<div id="approve" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Register Employee Status</h4>
            </div>
            <div class="modal-body" id="approval_html2">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

<?php init_tail(); ?>





<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 

<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>



<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>

<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>
<script>



                    $(document).ready(function () {

                        $('#newtable').DataTable({
                            "iDisplayLength": 15,
                            dom: 'Bfrtip',
                            lengthMenu: [
                                [10, 25, 50, -1],
                                ['10 rows', '25 rows', '50 rows', 'Show all']

                            ],
                            buttons: [
                                'pageLength',
                                {
                                    extend: 'excel',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                                    }

                                },
                                {
                                    extend: 'pdf',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                                    }

                                },
                                {
                                    extend: 'print',
                                    exportOptions: {
                                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                                    }

                                },
                                'colvis',
                            ]

                        });

                    });

                    $(document).on('click', '#reg_employee', function () {

                        var employee_id = $(this).val();

                        $('#employee_id').val(employee_id);



                    });

</script>
<script type="text/javascript">
    $('.status').click(function () {
        var id = $(this).val();
        //alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/staff/get_employee_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script> 

<script type="text/javascript">
    $('.reject').click(function () {
        var id = $(this).val();
        //alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/staff/get_employee_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html1").html(response);
                }
            }
        })
    });
</script> 

<script type="text/javascript">
    $('.approve').click(function () {
        var id = $(this).val();
        // alert(id);
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/staff/get_employee_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html2").html(response);
                }
            }
        })
    });
</script> 

</body>

</html>




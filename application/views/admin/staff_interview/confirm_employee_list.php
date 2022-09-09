
<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'department_form', 'class' => 'department-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> <?php echo (!empty($designation_id)) ? " <span class='text-danger'>( ".value_by_id_empty("tbldesignation", $designation_id, "designation")." )</span>" : ""; ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
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
                                <div class="col-md-3">
                                    <div class="form-group">
                                        <label for="interview_round" class="control-label">Interview Round </label>
                                        <select class="form-control selectpicker" id="interview_round" name="interview_round" data-live-search="true">
                                            <option value="" ></option>
                                            <option value="1" <?php echo (!empty($interview_round) && $interview_round == 1) ? "selected='selected'" : ""; ?>>Screening Round</option>
                                            <option value="2" <?php echo (!empty($interview_round) && $interview_round == 2) ? "selected='selected'" : ""; ?>>1st Round</option>
                                            <option value="3" <?php echo (!empty($interview_round) && $interview_round == 3) ? "selected='selected'" : ""; ?>>Final Round</option>
                                        </select>
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

                        <div class="">
                            <div class="col-md-12">
                                <div class="table-responsive">
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Candidate Name</th>
                                                    <th>Designation</th>
                                                    <th>Interview Date</th>
                                                    <th>Interviewer Name</th>
                                                    <th>Round</th>
                                                    <th>Confirm By</th>
                                                    <th>Confirm Date</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($candidate_list)) {

                                                    foreach ($candidate_list as $key => $value) {

                                                        $designation_name = value_by_id("tbldesignation", $value->designation_id, "designation");
                                                        if($value->interview_round == 1){
                                                            $interview_round = "Screening Round";
                                                        }elseif ($value->interview_round == 2) {
                                                            $interview_round = "1st Round";
                                                        }elseif ($value->interview_round == 3) {
                                                            $interview_round = "Final Round";
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo ++$key; ?></td>
                                                            <td><?php echo cc($value->candidate_name); ?></td>
                                                            <td><?php echo cc($designation_name); ?></td>
                                                            <td><?php echo _d($value->date); ?></td>
                                                            <td><?php echo cc($value->interviewer_name); ?></td>
                                                            <td><?php echo $interview_round; ?></td>
                                                            <td><?php echo get_staff_full_name($value->confirm_by); ?></td>
                                                            <td><?php echo (!empty($value->confirm_date)) ? _d($value->confirm_date) : "--"; ?></td>
                                                            <td class="text-center">
                                                                
                                                                <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                        <li>
                                                                            <a target="_blank" href="<?php echo admin_url('staff_interview/view_interview_details/' . $value->id); ?>" data-status="1">View</a>
                                                                        </li>
                                                                        <li>
                                                                            <a target="_blank" href="<?php echo site_url("uploads/interview_resume/".$value->resume);?>">Resume View</a>
                                                                        </li>
                                                                        <?php if(!empty($value->generate_ctc)){?>
                                                                            <li>
                                                                                <a target="_blank" href="<?php echo site_url("uploads/interview_resume/assign_ctc/".$value->generate_ctc);?>">View CTC</a>
                                                                            </li>
                                                                            <?php
                                                                            if (!empty($value->signed_ctc)) {
                                                                                ?>
                                                                                <li>
                                                                                    <a target="_blank" href="<?php echo site_url("uploads/interview_resume/signed_ctc/" . $value->signed_ctc); ?>">View Signed CTC</a>
                                                                                </li>
                                                                                <?php
                                                                                    if($value->staffregistration_id == 0){
                                                                                        echo '<li><a href="javascript:void(0);" class="register_email" value="'.$value->id.'" data-toggle="modal" data-target="#emailModal"> Employee Registration </a></li>';
                                                                                    }
                                                                                ?>
                                                                            <?php } else { ?>
                                                                                <li>
                                                                                    <a class="upload" value="<?php echo $value->id; ?>" data-toggle="modal" data-target="#myModal1" href="javascript:void(0);">Upload Signed CTC</a>
                                                                                </li>
                                                                                <?php
                                                                            }
                                                                            ?>
                                                                        <?php }else{ ?>
                                                                            <li>
                                                                                <a target="_blank" href="<?php echo admin_url("salary/employee_ctc/".$value->id."/SI");?>">Assign CTC Structure</a>
                                                                            </li>
                                                                        <?php } ?>

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
                    </div>
                </div>

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
    <div id="myModal1" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <?php echo form_open_multipart(admin_url("staff_interview/upload_signed_ctc"), array('id' => 'signed_ctc', 'class' => 'signed-ctc')); ?>
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Upload Signed CTC </h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <label for="upload" class="control-label">Signed CTC </label>
                            <div class="form-group">
                                <input type="file" id="files" class="form-control" required="true" name="files" style="width: 100%;">
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" id="candidate_id" name="candidate_id" value="">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button type="submit" class="btn btn-info">Upload</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <!-- Email Modal -->

    <div id="emailModal" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Registration link to employee</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="active" >
                                    <a href="#employee_registration" class="employee_registration" aria-controls="employee_registration" role="tab" data-toggle="tab" aria-expanded="true">via Email</a>
                                </li>
                                <li role="presentation">
                                    <a href="#whatsapp_registration" class="whatsapp_registration" aria-controls="whatsapp_registration" role="tab" data-toggle="tab" aria-expanded="false">via Whatsapp</a>
                                </li>
                                <li role="presentation">
                                    <a href="#fill_registration" class="fill_registration" aria-controls="fill_registration" role="tab" data-toggle="tab" aria-expanded="false">Fill Employee Registration</a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane active" id="employee_registration">
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
                                                <input type="hidden" name="candidate_id" class="candidate-id">
                                                <button class="btn btn-info" type="submit">Send Email</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="whatsapp_registration">
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
                                                <input type="hidden" name="candidate_id" class="candidateid">
                                                <button class="btn btn-info" type="submit">Send Whatsapp</button>
                                            </div>
                                        </div>
                                    </form>
                                </div>
                                <div role="tabpanel" class="tab-pane" id="fill_registration">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <h4> Please click below link for fill registration form : </h4>
                                                <div class="registration-link" >
                                                    <a href="#" class="btn btn-info" style="margin: 10% 10% 10% 20%;"> Click To Fill Employee Registration From </a>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>


                    </div>
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

$(document).ready(function() {
    $('#newtable').DataTable( {

        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [
            'pageLength',
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3]
                }
            },
            'colvis',
        ]
    } );
} );

$('.upload').click(function(){
    var candidate_id = $(this).attr("value");
    $("#candidate_id").val(candidate_id);
});
$('.register_email').click(function(){
    var candidate_id = $(this).attr("value");
    $(".candidate-id").val(candidate_id);
    $(".candidateid").val(candidate_id);
    var reg_link = '<a target="_blank" href="<?php echo base_url(); ?>staff/staff_form?branch_id=<?php echo get_login_branch(); ?>&candidate_id='+candidate_id+'" class="btn btn-info" style="margin: 10% 10% 10% 20%"> Click To Fill Employee Registration From </a>';
    $(".registration-link").html(reg_link);
});
</script>

</body>
</html>


<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'department_form', 'class' => 'department-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?>  </h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation" class="control-label">Designation </label>
                                        <select class="form-control selectpicker" id="designation_id" name="designation_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if($designation_list){
                                                    foreach ($designation_list as $value) {
                                                        $selected = (!empty($designation_id) && $value->id == $designation_id) ? "selected='selected'":"";
                                                        echo '<option value="'.$value->id.'" '.$selected.'>'.$value->designation.'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation" class="control-label">Department </label>
                                        <select class="form-control selectpicker" id="department_id" name="department_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if($department_list){
                                                    foreach ($department_list as $value) {
                                                        $selected = (!empty($department_id) && $value->id == $department_id) ? "selected='selected'":"";
                                                        echo '<option value="'.$value->id.'" '.$selected.'>'.cc($value->name).'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="branch_id" class="control-label">Branch</label>
                                        <select class="form-control selectpicker" id="branch_id" name="branch_id" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                                if($branch_list){
                                                    foreach ($branch_list as $value) {
                                                        $selected = (!empty($branch_id) && $value->id == $branch_id) ? "selected='selected'":"";
                                                        echo '<option value="'.$value->id.'" '.$selected.'>'.cc($value->comp_branch_name).'</option>';
                                                    }
                                                }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                            
                            <div class="row">
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="f_date" class="control-label">From Date</label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="t_date" class="control-label">To Date</label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="designation" class="control-label">Status </label>
                                        <select class="form-control selectpicker" id="hr_status" name="hr_status"  data-live-search="true">
                                            <option value=""></option>
                                            <option value="0" <?php echo (strlen($hr_status) > 0 && $hr_status == 0) ? "selected": ""; ?>>Pending</option>
                                            <option value="1" <?php echo (isset($hr_status) && $hr_status == 1) ? "selected": ""; ?>>Completed</option>
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
                                <hr>
                                <div class="table-responsive">                                                    
                                        <table class="table" id="newtable">
                                            <thead>
                                                <tr>
                                                    <th>S.No</th>
                                                    <th>Branch</th>
                                                    <th>Added By</th>
                                                    <th>Department</th>
                                                    <th>Designation</th>
                                                    <th>Deadline Date</th>
                                                    <th align="center">No of Candidate Requirement</th>
                                                    <th>Status</th>
                                                    <th class="text-center">Action</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($requirements_list)) {

                                                    foreach ($requirements_list as $key => $value) {
                                                        
                                                        
                                                        ?>
                                                        <tr>
                                                            <td><?php echo ++$key; ?></td>
                                                            <td><?php echo ($value->branch_id > 0) ? value_by_id("tblcompanybranch", $value->branch_id, "comp_branch_name") : "--"; ?></td>
                                                            <td><?php echo ($value->added_by > 0) ? get_employee_name($value->added_by) : "--"; ?></td>
                                                            <td><span class="label label-info"><?php echo ($value->department_id > 0) ? value_by_id("tbldepartmentsmaster", $value->department_id, "name") : "--"; ?></span></td>
                                                            <td><span class="label label-success"><?php echo ($value->designation_id > 0) ? value_by_id("tbldesignation", $value->designation_id, "designation") : "--"; ?></span></td>
                                                            <td><?php echo _d($value->deadline_date); ?></td>
                                                            <td align="center"><span class="label label-info"><?php echo (!empty($value->candidate_number)) ? $value->candidate_number : "--"; ?></span></td>
                                                            <td><?php if ($value->hr_status == 1){ ?>
                                                                <a href="<?php echo admin_url('staff_interview/change_status/'.$value->id); ?>" title="convert to pending" class='btn-sm btn-success _delete'>Complete</a>
                                                                <?php }else{ ?>
                                                                    <a href="<?php echo admin_url('staff_interview/change_status/'.$value->id); ?>" title="convert to complete" class='btn-sm btn-warning _delete'>Pending</a>
                                                                <?php } ?>    
                                                            </td>
                                                            <td class="text-center">
                                                                <a href="javascript:void(0);" class="requirement_details btn-sm btn-info" data-id="<?php echo $value->id; ?>">View Details</a>
                                                                <a target="_blank" class="btn-sm btn-success" href="<?php echo admin_url('follow_up/candidate_requirement_activity/' . $value->id); ?>" title="Candidate Requirement Activity">Activity</a>   
<!--                                                                <div class="btn-group pull-right">
                                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                    </button>
                                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                        <li>
                                                                            
                                                                        </li>
                                                                    </ul>
                                                                </div>-->
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
<div id="candidaterequirement" class="modal fade" role="dialog">
    <div class="modal-dialog">

        Candidate Requirement
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Staff Requirement Details</h4>
            </div>
            <div class="modal-body" id="requirement_div">
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


</script>
<script type="text/javascript">
    $('.requirement_details').click(function () {
        
        $('#candidaterequirement').modal('show'); 
        var requirement_id = $(this).data("id");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/staff_interview/get_requirement_html'); ?>",
            data: {'requirement_id': requirement_id},
            success: function (response) {
                if (response != '') {
                    $("#requirement_div").html(response);
                }
            }
        })
    });
</script>
</body>
</html>

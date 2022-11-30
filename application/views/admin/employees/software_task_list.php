<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>
<div id="wrapper">
    <div class="content accounting-template">
		<div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('employees/software_task_list'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; ?></h4>
                                </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <?php if(check_permission_page(444,'create')){ ?> 
                                    <a href="<?php echo admin_url('employees/add_software_task'); ?>" type="submit" class="btn btn-info">Add Software Task</a> <?php } ?>
                                </div>
                            </div>
                            <hr class="hr-panel-heading">
                            <div class="row">			
                                <div class="form-group col-md-2">
                                    <label for="vendor_id" class="control-label">Select Employee</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="staff_id" name="staff_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($employee_list) && count($employee_list) > 0) {
                                            foreach ($employee_list as $employee_value) {
                                                ?>
                                                <option value="<?php echo $employee_value['staffid']; ?>" <?php
                                                if (!empty($staff_id) && $staff_id == $employee_value['staffid']) {
                                                    echo 'selected';
                                                }
                                                ?>><?php echo cc($employee_value['firstname']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="vendor_id" class="control-label">Select Status</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="status" name="status">
                                        <option value=""></option>
                                        <?php
                                        if (isset($status_list) && count($status_list) > 0) {
                                            foreach ($status_list as $status_value) {
                                                ?>
                                                <option value="<?php echo $status_value['id']; ?>" <?php
                                                if (!empty($status) && $status == $status_value['id']) {
                                                    echo 'selected';
                                                }
                                                ?>><?php echo cc($status_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">Priority</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="priority">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($priority) && $priority == 1) ? 'selected' : ''; ?>>Low</option>
                                        <option value="2" <?php echo (isset($priority) && $priority == 2) ? 'selected' : ''; ?>>Medium</option>
                                        <option value="3" <?php echo (isset($priority) && $priority == 3) ? 'selected' : ''; ?>>High</option>
                                        <option value="4" <?php echo (isset($priority) && $priority == 4) ? 'selected' : ''; ?>>Urgent</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                                <div class="col-md-12">
                                    <hr>
                                <?php
                                    if (isset($status_list) && count($status_list) > 0) {
                                        foreach ($status_list as $status_value) {
                                            $status_class = 'primary';
                                            if($status_value['id'] == 1){
                                                $status_class = 'success';
                                            }elseif($status_value['id'] == 2){
                                                $status_class = 'warning';
                                            }          
                                            $counts = $this->db->query("SELECT COUNT(*) as ttl_count FROM `tblsoftwaretask` WHERE `status`='".$status_value['id']."' ")->row()->ttl_count;
                                            echo '<a href="javascript:void(0);" val="'.$status_value['id'].'" style="margin:2px;" class="task_status btn btn-'.$status_class.'">'.cc($status_value['name']).'
                                                    <span class="badge badge-danger badge-pill" style="background-color:red;color:#fff;">'.$counts.'</span>
                                                </a>&nbsp;';
                                        }
                                    }
                                ?>                
                                </div>
                                <div class="col-md-12">	
                                    <hr>
                                    <div class="table-responsive"> 															
                                        <table class="table" id="newtable">
                                            <thead>
                                            <tr>
                                                <th style="width: 2%;">S.No.</th>
                                                <th style="width: 12%;">Created By</th>
                                                <th style="width: 5%;">Date</th>
                                                <th style="width: 10%;">Priority</th>
                                                <th style="width: 15%;">Module</th>
                                                <th style="width: 30%;">Description</th>
                                                <th>Status</th>
                                                
                                            </tr>
                                            </thead>
                                            <tbody>
                                            <?php
                                            if(!empty($task_list)){
                                                $z=1;
                                                foreach($task_list as $row){
                                                        $priority = '';											
                                                        if($row->priority == 1){
                                                            $priority = '<span class="label label-warning">Low</span>';
                                                        }elseif($row->priority == 2){
                                                            $priority = '<span class="label label-success">Medium</span>';
                                                        }elseif($row->priority == 3){
                                                            $priority = '<span class="label label-info">High</span>';
                                                        }elseif($row->priority == 4){
                                                            $priority = '<span class="label label-danger">Urgent</span>';
                                                        }

                                                        //<button type="button" class="btn btn-primary">Primary <span class="badge">7</span></button>

                                                        $status_class = 'primary';
                                                        if($row->status == 1){
                                                            $status_class = 'success';
                                                        }elseif($row->status == 2){
                                                            $status_class = 'warning';
                                                        }
                                                    ?>																						
                                                    <tr>
                                                        <td><?php echo $z++;?></td>
                                                        <td><?php echo get_employee_name($row->added_by); ?></td>
                                                        <td><?php echo _d($row->date); ?></td>
                                                        <td><?php echo $priority; ?></td>
                                                        <td><?php echo $row->module; ?></td>
                                                        <td><?php echo $row->description; ?></td>												
                                                        <td><button type="button" value="<?php echo $row->id; ?>" data-toggle="modal" data-target="#taskDetails" class="btn-sm btn-<?php echo $status_class; ?> details"><?php echo value_by_id("tblsoftwaretask_status", $row->status, "name"); ?></button>
                                                        
                                                            <?php 
                                                            if(check_permission_page(444,'edit') && $row->added_by == get_staff_user_id() && $row->status == 2){

                                                            echo '<button type="button" data-toggle="modal" data-target="#edit_modal" class="btn-sm btn-info edit" title="Edit" value="'.$row->id.'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></button>';
                                                            }

                                                            if((check_permission_page(444,'delete')) && $row->added_by == get_staff_user_id() && $row->status == 2){
                                                            ?>	
                                                            <a class="btn-sm btn-danger _delete" href="<?php echo admin_url('employees/delete_task/'.$row->id);?>" data-status="1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                            <?php
                                                            }
                                                            ?>
                                                            
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
                            <div class="btn-bottom-toolbar text-right"></div>
                        </div>
                    </div>
                </div>
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<div id="taskDetails" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Software Task Details</h4>
      </div>
      <div class="modal-body" id="task_detail_div">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="edit_modal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo admin_url("employees/update_software_task"); ?>" method="post" enctype="multipart/form-data">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Update Task </h4>
            </div>
            <div class="modal-body" id="edit_task_div">
                

            </div>

            <div class="modal-footer">
                <button type="submit" autocomplete="off" class="btn btn-info confirm-btn">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        </form>
    </div>
</div>



<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 25,
        "dom": 'lBfrtip',
        "pageLength": 25,
    } );

    $(".task_status").on("click", function(){
        var status = $(this).attr('val');
        $('#status option[value="'+status+'"]').attr("selected", "selected");
        $('.selectpicker').selectpicker('refresh');
        $("#salary_form").submit();
    });
} );
</script>

<script type="text/javascript">
    $(document).on('click', '.edit', function () {

        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/employees/get_edit_task_html'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#edit_task_div').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    });
    $(document).on('click', '.details', function () {

        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/employees/task_details_html'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#task_detail_div').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    });
</script>

<script type="text/javascript">
    $(".myselect").select2();

    
</script>

</body>
</html>

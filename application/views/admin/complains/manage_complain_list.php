<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('complains/manage_complains'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>
                            </div>	                   

                            <hr class="hr-panel-heading">

                            <div class="row">

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
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">Status</label>
                                    <select class="form-control selectpicker" id="status" name="status">
                                    <option value="" disabled selected >--Select One-</option>
                                          <option value="1"<?php echo (isset($status) && $status == 1) ? 'selected' : "" ?>>Running</option>
                                          <option value="2"<?php echo (isset($status) && $status == 2) ? 'selected' : "" ?>>Closed</option>
                                   </select>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">Complain Type</label>
                                    <select class="form-control selectpicker" name="complain_type" id="complain_type" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($complain_type_data) && count($complain_type_data) > 0) {
                                            foreach ($complain_type_data as $val) {
                                                ?>
                                                <option value="<?php echo $val->id ?>" <?php echo (isset($complain_type) && $complain_type == $val->id) ? "selected" : "" ?>><?php echo cc($val->title); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>


                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Complain ID</th>
                                                <th>Complain Date</th>
                                                <th>Resolve Till</th>
                                                <th>Customer Name</th>
                                                <th>Complain Type</th>
                                                <th>Action Planner</th>
                                                <th>Action Planner Document's</th>
                                                <th>Delayed At</th>
                                                <th>Status</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($complains_list)) {
                                                foreach ($complains_list as $k => $row) {
                                                    $client_info = $this->db->query("SELECT `company` FROM tblclients WHERE userid ='".$row->client_id."'")->row();
                                                    
                                                    if ($row->status == 1) {
                                                        $status = 'Running';
                                                        $cls = 'btn-info btn-xs';
                                                    } elseif ($row->status == 2) {
                                                        $status = 'Closed';
                                                        $cls = 'btn-success btn-xs';
                                                    }
                                                    if ($row->action_plan_status == 0) {
                                                        $astatus = '<span class="btn-warning btn-xs">Pending</span>';
                                                    } elseif ($row->action_plan_status == 1) {
                                                        $astatus = '<button type="button" class="btn-success btn-xs listactionplan" data-id="' . $row->id . '" data-status="' . $row->status . '" data-toggle="modal" data-target="#actionplanlistModal">View Plan</button>';
                                                    }

                                                    $overdue_day = '--';
                                                    if ($row->status == 2 && !empty($row->resolve_till)){
                                                        if (strtotime($row->actual_complete_date) > strtotime($row->resolve_till)){
                                                            $diff_date = (strtotime($row->actual_complete_date)-strtotime($row->resolve_till));
                                                            $overdue_day = '<a href="javascript:void(0);" data-toggle="popover" title="Delayed Remark" data-content="'.$row->delayed_remark.'" class="btn-sm btn-info">'.round($diff_date / 86400).'</a>';
                                                        }else{
                                                            $overdue_day = '<span class="text-success">No Due</span>';
                                                        }
                                                    }
                                                    ?>
                                                    
                                                    <tr>
                                                        <td><?php echo ++$k; ?></td>
                                                        <td><?php echo "Comp-".$row->id; ?></td>
                                                        <td><?php echo _d($row->complain_date); ?></td>
                                                        <td><?php echo (!empty($row->resolve_till)) ? _d($row->resolve_till) : 'N/a'; ?></td>
                                                        <td><?php echo $client_info->company; ?></td>
                                                        <td><?php echo value_by_id("tblcomplainstypes", $row->complain_type_id, "title"); ?></td>
                                                        <td>
                                                            <?php
                                                                if($row->action_planner_id == 0){
                                                                    echo '<a href="javascript:void(0);" class="action_planner" data-id="' . $row->id . '" data-toggle="modal" data-target="#actionplannerModal"><i class="fa fa-plus-circle"></i> Assign Plan</button>';
                                                                }else{
                                                                    echo '<span class="badge badge-pill badge-info">'.get_employee_name($row->action_planner_id).'</span>';
                                                                }
                                                            ?>
                                                        </td>
                                                        <td><?php echo $astatus; ?></td>
                                                        <td><?php echo $overdue_day; ?></td>
                                                        <td><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                        <td class="text-center">
                                                            <div class="btn-group">
                                                                <a href="<?php echo admin_url('complains/view/' . $row->id); ?>" class="btn-sm btn-primary" target="_blank" title="View Complains Details"><i class="fa fa-eye"></i></a>
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



                            <div class="btn-bottom-toolbar text-right">

                            </div>

                            <!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->



                        </div>

                    </div>
                </div>

            </form>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="actionplannerModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <?php
            $attributes = array('id' => 'assignplan_form');
            echo form_open_multipart(admin_url("complains/add_assign_planner"), $attributes);
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Add Action Planner</h4>
            </div>
            <div class="modal-body" id="assignplan_html">
                <div class="row">
                    <input type="hidden" name="complains_id" class="complains_id" value="">
                    <div class="form-group col-md-12" app-field-wrapper="date">
                        <label for="t_date" class="control-label">Action Planner</label>
                        <select class="form-control selectpicker" data-live-search="true" id="assign_plan" required="" name="assign_plan">
                            <option></option>
                            <?php
                            $staff_list = $this->db->query("SELECT * FROM `tblstaff` where active = 1 order by firstname asc")->result();
                            if ($staff_list) {
                                foreach ($staff_list as $val) {
                                    echo '<option value="' . $val->staffid . '">' . $val->firstname . '</option>';
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>
                
            </div>
            <div class="modal-footer">
                <button type="submit" class="btn btn-primary">Send</button>
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="actionplanlistModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <?php
            $attributes = array('id' => 'actionplan_form');
            echo form_open_multipart(admin_url("complains/actionplan"), $attributes);
        ?>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">View Action Plan</h4>
            </div>
            <input type="hidden" name="complains_id" class="comp_id" value="">
            <div class="modal-body" id="actionplanlist_html">
                
                
            </div>
            <div class="modal-footer action-plan-btn">
                <button type="submit" name="action" value="1" class="btn btn-primary">Re-send</button>
                <button type="submit" name="action" value="2" class="btn btn-success">Complete</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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
                                                });
                                            });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script> 

<script type="text/javascript">
    $(document).on('click', '.action_planner', function () {
        var complain_id = $(this).data("id");
        $(".complains_id").val(complain_id);
    });
</script> 
<script type="text/javascript">
    $(document).on('click', '.listactionplan', function () {
        var complain_id = $(this).data("id");
        var complain_status = $(this).data("status");
        
        $(".action-plan-btn").show();
        if (complain_status == 2){
            $(".action-plan-btn").hide();
        }
        $(".comp_id").val(complain_id);
        $.ajax({
                type    : "POST",
                url     : "<?php echo base_url('admin/complains/get_actionplan'); ?>",
                data    : {'complain_id' : complain_id},
                success : function(response){
                        if(response != ''){
                                $("#actionplanlist_html").html(response);
                        }
                }
        })
    });
</script> 
<script type="text/javascript">
    $('.status').click(function(){
        var id = $(this).val();  
        $.ajax({
                type    : "POST",
                url     : "<?php echo base_url('admin/complains/get_status'); ?>",
                data    : {'id' : id},
                success : function(response){
                        if(response != ''){
                                $("#approval_html").html(response);
                        }
                }
        })
    });
</script>

</body>
</html>

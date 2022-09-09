<?php init_head(); ?>




<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                            <div class="row">
                                <div class="form-group col-md-4" id="employee_div">
                                    <label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> *</label>
                                    <select required="" class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($staff_list)){
                                            foreach($staff_list as $staff){
                                                ?>
                                                <option value="<?php echo $staff->staffid;?>" <?php echo (isset($s_staffid) && $s_staffid ==$staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3" id="employee_div">
                                    <label for="branch_id" class="control-label"><?php echo 'Year'; ?> *</label>
                                    <select required="" class="form-control selectpicker" id="year" name="year">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        $j = date('Y');
                                        for($i=$j; $i>=2021; $i--){
                                            ?>
                                            <option value="<?php echo $i;?>" <?php if(!empty($s_year) && $s_year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
                                            <?php
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3" id="employee_div">
                                    <label for="month" class="control-label">Month *</label>
                                    <select required="" class="form-control selectpicker" id="month" name="month">
                                        <option value="" disabled selected >--Select One-</option>
                                        <?php
                                        if(!empty($month_list)){
                                            foreach($month_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id; ?>" <?php echo (!empty($s_month) && $s_month == $row->id) ? 'selected' : "" ?>><?php echo $row->month_name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                                
                            </div>
                        <?php echo form_close(); ?>
                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <hr>
                                <table class="table" id="newtable">
                                    <thead>
                                            <tr>
                                                <th><b>S.No</b></th>
                                                <th><b>Date</b></th>
                                                <th><b>Days</b></th>
                                                <th><b>Status</b></th>
                                            </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($attendance_dates)){
                                            $i=1;
                                            foreach($attendance_dates as $date){
                                                $attendance_info = $this->db->query("SELECT `status` FROM `tblstaffattendance` where staff_id = '".$s_staffid."' and date = '".$date."'")->row();
                                        ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo _d($date); ?></td>
                                                <td><?php echo date('l',strtotime($date)); ?></td>
                                                <td>
                                                    <?php if (strtotime($date) <= strtotime(date("Y-m-d"))){ ?>
                                                        <select class="form-control status" name="attendance[<?php echo $i; ?>][status]">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($attendance_info->status) && $attendance_info->status == 1) ? 'selected' : "" ?>>Present</option>
                                                            <option value="2" <?php echo (isset($attendance_info->status) && $attendance_info->status == 2) ? 'selected' : "" ?>>Leave</option>
                                                            <option value="3" <?php echo (isset($attendance_info->status) && $attendance_info->status == 3) ? 'selected' : "" ?>>Off</option>
                                                            <option value="4" <?php echo (isset($attendance_info->status) && $attendance_info->status == 4) ? 'selected' : "" ?>>Half Day</option>
                                                            <option value="5" <?php echo (isset($attendance_info->status) && $attendance_info->status == 5) ? 'selected' : "" ?>>Over Time</option>
                                                            <option value="6" <?php echo (isset($attendance_info->status) && $attendance_info->status == 6) ? 'selected' : "" ?>>Paid leave</option>
                                                        </select>
                                                    <?php }else{
                                                        echo "--";
                                                    } ?>
                                                    <input type="hidden" name="attendance[<?php echo $i; ?>][date]" value="<?php echo $date; ?>">
                                                    <input type="hidden" name="attendance[<?php echo $i; ?>][staff_id]" value="<?php echo $s_staffid; ?>">
                                                </td>
                                            </tr>
                                        <?php     
                                                $i++;   
                                            }    
                                        }else{
                                            echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                                        }
                                        ?>

                                    </tbody>
                                </table>
                            </div>
                        </div>
                        <?php if(!empty($attendance_dates)){ ?>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" value="1" name="mark" type="submit">
                                    <?php echo _l('submit'); ?>
                                </button>
                            </div> 
                        <?php } ?>         
                    </div>
                </div>
            </div>
		</div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="leave-details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title leave-heading">Leave Details </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <label class="col-md-6 control-label" style="color:red;">Leave Category :</label>
                        <p class="col-md-6 leave-category"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6 control-label" style="color:red;">Leave Type :</label>
                        <p class="col-md-6 leave-type"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6 control-label" style="color:red;">Leave Reason :</label>
                        <p class="col-md-6 leave-reason"></p>
                    </div>
                    <div class="col-md-12">
                        <label class="col-md-6 control-label" style="color:red;">Approved By :</label>
                        <p class="col-md-6 approved_parson"></p>
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
        "iDisplayLength": 40,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: ':visible'
                }
            },
            'colvis'
        ]
    } );
} );
</script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){
		$("#attendance_form").submit();
	});

	$(document).on('change', '#date', function(){
		$("#attendance_form").submit();
	});
</script>

<script type="text/javascript">
	$(document).on('change', '.status', function(){
		var staff_id = $(this).attr('title');
		var status = $(this).val();

		if(status == 5){

			$("#working_to_"+staff_id).prop("disabled", false);
		}else{
			$("#working_to_"+staff_id).prop("disabled", true);
		}


		//$("#attendance_form").submit();
	});

  $(document).on("click", ".leaveinfo-model", function(){
     var id = $(this).data("lid");
     var ltitle = $(".ltitle"+id).val();
     var lcategory = $(".lcategory"+id).val();
     var ltype = $(".ltype"+id).val();
     var lreason = $(".lreason"+id).val();
     var lapprove_by = $(".lapprove_by"+id).val();
     $(".leave-heading").html(ltitle);
     $(".leave-category").html(lcategory);
     $(".leave-type").html(ltype);
     $(".leave-reason").html(lreason);
     $(".approved_parson").html(lapprove_by);
  });
</script>

</body>
</html>

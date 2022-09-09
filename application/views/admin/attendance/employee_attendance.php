<?php init_head(); ?>




<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin"><?php echo $title; ?></h4>
					<hr class="hr-panel-heading">

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
                                for($i=2018; $i<=$j; $i++){
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


						<div class="col-md-1">
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>

					</div>

                        <div class="row">


                            <div class="col-md-12 table-responsive">
                								<table class="table" id="newtable">
                  									<thead>
                    									  <tr>
                                                            <th><b>S.No</b></th>
                                                            <th><b>Date</b></th>
                                                            <th><b>Days</b></th>
                                                            <th><b>Marked By</b></th>
                                                            <th><b>Marking Time</b></th>
                                                            <th><b>Approved by</b></th>
                                                            <th><b>Status</b></th>
                    									  </tr>
                  									</thead>
                									<tbody>
                    									<?php
                      									if(!empty($attendance_info)){
                      										$i=1;
                      										foreach($attendance_info as $row){
                      												$status = 'Absent';
                      												$color = '#FF8C00';
                                              $lcategory = $ltitle = $ltype = $lreason = $approve_by = "--";
                      											if($row->status == 1){
                      												$status = 'Present';
                      												$color = 'green';
                      											}elseif($row->status == 2){
                                              $status = 'Leave';

                                              $chk_leave = $this->db->query("SELECT * FROM `tblleaves` WHERE `from_date` <= '".db_date($row->date)."' AND `to_date` >= '".db_date($row->date)."' AND `addedfrom` = ".$row->staff_id." ")->row();
                                              // $chk_leave = $this->db->query("SELECT `title` FROM `tblleaves` WHERE `addedfrom` = ".$row->staff_id." AND `from_date` <='".db_date($row->date)."' AND `to_date` >= '".db_date($row->date)."' ")->row();
                                              if (!empty($chk_leave)){
                                                $lcategory = value_by_id("tblleavescategories", $chk_leave->category, "name");
                                                $ltitle = "Leave Details";
                                                $ltype = "Unpaid Leave";
                                                $lreason = $chk_leave->reason;
                                                $leaveinfo = $this->db->query("SELECT `staff_id` FROM `tblleaveapproval` WHERE `leave_id` = '".$chk_leave->id."' AND `approve_status` = '1' ")->row();
                                                if (!empty($leaveinfo)){
                                                   $approve_by = get_staff_info($leaveinfo->staff_id)->firstname;
                                                }

                                                $status = "<a href='javascript:void(0)' data-lid='".$row->id."' data-toggle='modal' data-target='#leave-details' class='btn-sm btn-danger leaveinfo-model'>Leave</a>";
                                              }

                      												$color = 'red';
                      											}elseif($row->status == 3){
                                              $chk_holiday = $this->db->query("SELECT `title` FROM `tblholidays` WHERE `date` ='".date('Y-m-d', strtotime($row->date))."' ")->row();
                                              $status =(!empty($chk_holiday) && !empty($chk_holiday->title)) ? CC($chk_holiday->title) : 'off';
                      												$color = 'blue';
                      											}elseif($row->status == 4){
                      												$status = 'Halfday';
                      												$color = 'green';
                      											}elseif($row->status == 5){
                      												$status = 'Overtime';
                      												$color = 'green';
                      											}elseif($row->status == 6){
                      												$status = 'Paid leave ';
                                              $chk_leave = $this->db->query("SELECT * FROM `tblleaves` WHERE `from_date` <= '".db_date($row->date)."' AND `to_date` >= '".db_date($row->date)."' AND `addedfrom` = ".$row->staff_id." ")->row();
                                              // $chk_leave = $this->db->query("SELECT `title` FROM `tblleaves` WHERE `addedfrom` = ".$row->staff_id." AND `from_date` <='".db_date($row->date)."' AND `to_date` >= '".db_date($row->date)."' ")->row();
                                              if (!empty($chk_leave)){
                                                  $lcategory = value_by_id("tblleavescategories", $chk_leave->category, "name");
                                                  $ltitle = "Leave Details";
                                                  $ltype = "Paid Leave";
                                                  $lreason = $chk_leave->reason;
                                                  $leaveinfo = $this->db->query("SELECT `staff_id` FROM `tblleaveapproval` WHERE `leave_id` = '".$chk_leave->id."' AND `approve_status` = '1' ")->row();
                                                  if (!empty($leaveinfo)){
                                                     $approve_by = get_staff_info($leaveinfo->staff_id)->firstname;
                                                  }
                                                  $status = "<a href='javascript:void(0)' data-lid='".$row->id."' data-toggle='modal' data-target='#leave-details' class='btn-sm btn-danger leaveinfo-model'>Paid Leave</a>";
                                              }
                      												$color = 'orange';
                      											}
                                            if (date("Y-m-d") >= $row->date){
                      											?>

                      											<tr>
                        												<td><?php echo $i++;?>
                                                    <input type="hidden" name="ltitle" class="ltitle<?php echo $row->id; ?>" value="<?php echo $ltitle; ?>">
                                                    <input type="hidden" name="lcategory" class="lcategory<?php echo $row->id; ?>" value="<?php echo $lcategory; ?>">
                                                    <input type="hidden" name="ltype" class="ltype<?php echo $row->id; ?>" value="<?php echo $ltype; ?>">
                                                    <input type="hidden" name="lreason" class="lreason<?php echo $row->id; ?>" value="<?php echo $lreason; ?>">
                                                    <input type="hidden" name="lapprove_by" class="lapprove_by<?php echo $row->id; ?>" value="<?php echo $approve_by; ?>">
                                                </td>
                        												<td><?php echo date('d/m/Y',strtotime($row->date));?></td>
                                                <td><?php echo date('l',strtotime($row->date));?></td>
                                                <td><?php echo ($row->by_biomax == 1) ? "Biomax" : "App";?></td>
                                                <td><?php echo (!empty($row->marked_at) && $row->marked_at != '0000-00-00 00:00:00') ? _d($row->marked_at) : "--";?></td>
                                                <td><?php echo ($row->approved_by > 0) ? '<span style="background-color: #2196f3;" class="badge badge-pill">'. get_staff_info($row->approved_by)->firstname. '</span>' : "--";?></td>
                        												<td style="color: <?php echo $color; ?>;"><?php echo $status;?></td>
                      											</tr>
                      											<?php
                                            }
                      										}
                      									}else{
                      										echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
                      									}
                    									?>

                									</tbody>
                								  </table>
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

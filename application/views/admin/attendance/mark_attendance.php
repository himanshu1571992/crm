<?php init_head(); ?>

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

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Mark Attendance <a class="actionBtn pull-right" style="margin-top:-6px;" href="<?php echo admin_url('attendance/live_location');?>">Live Locations</a> <a class="actionBtn pull-right" style="margin-top:-6px;" href="<?php echo admin_url('attendance/location_map');?>">Locations Map</a></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
						<div class="form-group col-md-4" id="employee_div">
							<label for="branch_id" class="control-label"><?php echo 'Branch Name'; ?> *</label>
							<select class="form-control selectpicker" id="branch_id" name="branch_id">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($branch_info)){
									foreach($branch_info as $branch){
										?>
										<option value="<?php echo $branch->id;?>" <?php echo (isset($s_branch) && $s_branch ==$branch->id) ? 'selected' : "" ?>><?php echo $branch->comp_branch_name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="date" class="control-label"><?php echo 'Date'; ?></label>
							<div class="input-group date">
								<input id="date" required name="date" class="form-control datepicker" value="<?php echo (isset($s_date) && $s_date != "") ? $s_date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
												
					</div>
					
                        <div class="row">
						
							
                            <div class="col-md-12">																
								<table class="table ui-table">
									<thead>
									  <tr>
										<th>S.No</th>
										<th>Employee Name</th>
										<th>Start Hour</th>
										<th>End Hour</th>
										<th>Action</th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($staff_list)){
										$i=1;
										foreach($staff_list as $staff){
											$record = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$att_date), '');

											$staff_info = $this->home_model->get_row('tblstaff', array('staffid'=>$staff->staffid), '');		
											?>
											<input type="hidden" name="staff_id[]" value="<?php echo $staff->staffid;?>">
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php echo $staff->firstname;?></td>
												
												<td>
													<select class="form-control" disabled required="" id="working_from_<?php echo $staff->staffid; ?>" name="working_from_<?php echo $staff->staffid; ?>" data-live-search="true">
														<option value="" disabled selected>--Select One--</option>
														<?php
														for($hours=0; $hours<24; $hours++){
															for($mins=0; $mins<60; $mins+=30){
																$value = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
																?>
																<option value="<?php echo $value ?>" <?php echo (isset($staff_info->working_from) && $staff_info->working_from == $value) ? 'selected' : "" ?>><?php echo $value ?></option>
																<?php
															}
														} 
															
														?>
													</select>
												</td>
												
												<td>
													<select class="form-control" disabled required="" id="working_to_<?php echo $staff->staffid; ?>" name="working_to_<?php echo $staff->staffid; ?>"  data-live-search="true">
														<option value="" disabled selected>--Select One--</option>
														<?php
														for($hours=0; $hours<24; $hours++){
															for($mins=0; $mins<60; $mins+=30){
																$value = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
																?>
																<option value="<?php echo $value ?>" <?php echo (isset($staff_info->working_to) && $staff_info->working_to == $value) ? 'selected' : "" ?>  <?php if(!empty($record->working_to) && $record->working_to == $value){ echo 'selected';}?>><?php echo $value ?></option>
																<?php
															}
														} 
															
														?>
													</select>
												</td>
												<td> 
												<select class="form-control status" title="<?php echo $staff->staffid; ?>" name="status_<?php echo $staff->staffid; ?>" required="">
													<option value=""></option>
													<option value="1" selected>Present</option>
													<option value="2" <?php echo (isset($record->status) && $record->status == 2) ? 'selected' : "" ?>>Leave</option>
													<option value="4" <?php echo (isset($record->status) && $record->status == 4) ? 'selected' : "" ?>>Half Day</option>
													<option value="5" <?php echo (isset($record->status) && $record->status == 5) ? 'selected' : "" ?>>Over Time</option>
													<option value="3" <?php echo (isset($record->status) && $record->status == 3) ? 'selected' : "" ?>>Off</option>
												</select>
												</td>
											  </tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>
						
						

                               
                            </div>
							 <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>


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
</script> 

</body>
</html>

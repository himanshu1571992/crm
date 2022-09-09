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
					<h4 class="no-margin">Live Location</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
						<div class="form-group col-md-4" id="employee_div">
							<label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> *</label>
							<select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($staff_list)){
									foreach($staff_list as $staff){
										?>
										<option value="<?php echo $staff->staffid;?>" <?php echo (!empty($s_staff_id) && $s_staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="from_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="from_date" required name="from_date" class="form-control datepicker" value="<?php echo (isset($s_fromdate) && $s_fromdate != "") ? $s_fromdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="to_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="to_date" required name="to_date" class="form-control datepicker" value="<?php echo (isset($s_todate) && $s_todate != "") ? $s_todate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">							
							<div class="input-group date">
								<button style="margin-top: 27px;" class="btn btn-info" value="1" name="mark" type="submit">Search</button>
							</div>
						</div>
												
					</div>
					
                        <div class="row">
							
							<?php
							if(!empty($location_info)){
								echo '<a class="btn btn-success pull-right" href="'.admin_url('attendance/download_pdf?staff_id='.$s_staff_id.'&from_date='.$s_fromdate.'&to_date='.$s_todate).'">Download PDF</a>';
							}
							?>
							
							
                            <div class="col-md-12">		



								<table class="table ui-table">
									<thead>
									  <tr>
										<th><b>S.No</b></th>
										<th><b>Title</b></th>
										<th><b>Location Name</b></th>										
										<th><b>Date</b></th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($location_info)){
										$i=1;
										foreach($location_info as $row){
													
											?>
											
											<tr>
												<td><?php echo $i++;?></td>
												<td><?php if(!empty($row->title)){ echo $row->title; }else{ echo '--';};?></td>
												<td><?php echo $row->location;?></td>
												<td><?php echo date('d/m/Y',strtotime($row->updated_at));?></td>
												
											  </tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
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

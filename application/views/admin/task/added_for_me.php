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


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('Task/added_for_me'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Task Assigned To Me</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						
						<div class="form-group col-md-3">
							<label for="related_to" class="control-label">Related To </label>
							<select class="form-control" id="related_to" name="related_to">
								<option value="" selected >--Select One-</option>
								<?php
								if(!empty($task_for)){
									foreach($task_for as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if($s_related_to == $row->id){ echo 'selected'; } ?> ><?php echo $row->name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>


						<div class="form-group col-md-3">
							<label for="status" class="control-label">Task Status </label>
							<select class="form-control" id="status" required="" name="status">
								<option value="" selected >--Select One-</option>
								<option value="0" <?php if($s_status == 0){ echo 'selected'; } ?> >Pending</option>
								<option value="1" <?php if($s_status == 1){ echo 'selected'; } ?> >Completed</option>
								<option value="2" <?php if($s_status == 2){ echo 'selected'; } ?> >Rejected</option>								
							</select>
						</div> 
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="from_date" class="form-control datepicker" value="<?php if(!empty($s_from_date)){ echo $s_from_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="to_date" class="form-control datepicker" value="<?php if(!empty($s_to_date)){ echo $s_to_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" value="print" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a class="btn btn-danger" href="">Reset</a>
                        </div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
						<div class="row">
						
							
	                            <div class="col-md-12 table-responsive">																
									<table class="table ui-table">
										<thead>
										  <tr>
											<th>S.No</th>
											<th>Task Title</th>
											<th>Repeat</th>
											<th>Start / Due Date</th>
											<th>Related To</th>
											<th>Priority</th>
											<th>Action</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											if(!empty($task_info)){
												foreach ($task_info as $key => $value) {

													$priority = '--';
													if($value->priority == 1){
														$priority = 'Low';
													}elseif($value->priority == 2){
														$priority = 'Medium';
													}elseif($value->priority == 3){
														$priority = 'High';
													}elseif($value->priority == 4){
														$priority = 'Urgent';
													}

													
													?>
													<tr>
														<td>
															<?php echo ++$key; ?>
															<?php echo get_creator_info($value->added_by, $value->created_at); ?>
														</td>
														<td><?php echo $value->title; ?></td>
														<td><?php echo ($value->is_repeat == 1) ? 'Yes' : 'No'; ?></td>
														<td><?php if($value->is_repeat == 1){ echo ($value->repeat_type == 1) ? 'Weekly' : 'Monthly'; }else{ echo $value->start_date.' to '.$value->due_date; }  ?></td>
														<td><?php echo value_by_id('tbltaskfor',$value->related_to,'name'); ?></td>
														<td><?php echo $priority; ?></td>
														<td>
															<a class="btn-info btn-sm" href="<?php echo admin_url('Task/task_details/'.$value->id); ?>">View</a>

															<a class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('Task/activity_log/'.$value->id); ?>">Activity</a>

															<a class="btn-info btn-sm" target="_blank" href="<?php  echo admin_url('reminder/add/0/3'); ?>">Set Reminder</a>

														</td>
													</tr>
													<?php
												}
											}else{
												?>
												<tr><td colspan="7" class="text-center">Taks Not Found!</td></tr>
												<?php
											}
											?>
												
										</tbody>

									</table>
	                           
	                        </div>
                        </div>		


							
						<div class="btn-bottom-toolbar text-right">
                           
                        </div>
                        </div>
                       
                    </div>
                </div>
             
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();	
		}
		
		
		
	});	
</script> 

<script type="text/javascript">
      $(".myselect").select2();
</script>

</body>
</html>

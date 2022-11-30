<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('Task/added_by_me'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Task Assigned By Me</h4>
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
							<label for="staff_id" class="control-label">Select Employee</label>
							<select class="form-control" id="staff_id" name="staff_id">
								<option value="" selected >--Select One-</option>
								<?php
								if(!empty($employee_info)){
									foreach($employee_info as $row){
										?>
										<option value="<?php echo $row->staffid;?>" <?php if($s_staff_id == $row->staffid){ echo 'selected'; } ?> ><?php echo $row->firstname; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="from_date" class="form-control datepicker" required="" value="<?php if(!empty($s_from_date)){ echo $s_from_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="to_date" class="form-control datepicker" required="" value="<?php if(!empty($s_to_date)){ echo $s_to_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
						<div class="row">
						
							
	                            <div class="col-md-12 table-responsive">																
									<table class="table" id="example">
										<thead>
										  <tr>
											<th>S.No</th>
											<th>Task Title</th>
											<th>Employees</th>
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

													$assignee_info = $this->db->query("SELECT count(id) as staff_count from `tbltaskassignees` where task_id = '".$value->id."' ")->row();

													$assignee_ids = $this->db->query("SELECT `staff_id` from `tbltaskassignees` where task_id = '".$value->id."' ")->result();
													$assign_name = '';
													if(!empty($assignee_ids)){
														foreach ($assignee_ids as $j => $staff_id) {
															if($j == 0){
																$assign_name = get_employee_name($staff_id->staff_id);
															}else{
																$assign_name .= ', '.get_employee_name($staff_id->staff_id);
															}
															
														}

													}else{
														$assign_name = '--';
													}

													?>
													<tr>
														<td>
															<?php echo ++$key; ?>
															
														</td>
														<td>
															<?php echo get_creator_info($value->added_by, $value->created_at); ?>
															<?php echo $value->title; ?>
														</td>
														<td><?php echo $assign_name; ?></td>
														<td><?php echo ($value->is_repeat == 1) ? 'Yes' : 'No'; ?></td>
														<td><?php if($value->is_repeat == 1){ echo ($value->repeat_type == 1) ? 'Weekly' : 'Monthly'; }else{ echo $value->start_date.' to '.$value->due_date; }  ?></td>
														<td><?php echo value_by_id('tbltaskfor',$value->related_to,'name'); ?></td>
														<td><?php echo $priority; ?></td>
														<td>
															<a class="btn-success btn" href="<?php echo admin_url('Task/task_details/'.$value->id); ?>">View</a>

															<a class="btn-info btn" href="<?php echo admin_url('Task/add/'.$value->id); ?>"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>

															<a class="btn-info btn" target="_blank" href="<?php echo admin_url('Task/activity_log/'.$value->id); ?>">Activity</a>

															<a class="btn-warning btn" target="_blank" href="<?php  echo admin_url('reminder/add/0/3'); ?>">Set Reminder</a>

															<button type="button" value="<?php echo $value->id; ?>" class="btn-info btn assignees" data-toggle="modal" data-target="#myModal">Assignees (<?php echo $assignee_info->staff_count; ?>)</button>

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
                        </div>
                       
                    </div>
                </div>
             
            </form>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Task Assignee List</h4>
      </div>
      <div class="modal-body">
        <div id="assig_div"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>
<script>

$(document).ready(function() {
    $('#example').DataTable();
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



<script type="text/javascript">
	$(document).on('click', '.assignees', function() { 	
	var id = $(this).val();

	if(id != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_assignee_list'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ' '){
					$("#assig_div").html(response);
				}
			}
		})
	}
		
	});
</script> 

</body>
</html>

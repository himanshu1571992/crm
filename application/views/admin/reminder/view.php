<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('reminder'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin"><?php echo $title; ?>   <?php if(check_permission_page(155,'create')){ ?><span style="padding-left: 72%;"><a href="<?php  echo admin_url('reminder/add'); ?>" class="btn btn-info"><i class="fa fa-bell-o" aria-hidden="true"></i> Set New Reminder</a></span> <?php } ?></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-3">
                            <label for="reminder_for" class="control-label">Reminder For</label>
                            <select class="form-control selectpicker" data-live-search="true" name="reminder_for">
                                <option value=""></option>
                                <option value="1" <?php if(!empty($s_reminder) && $s_reminder == 1){ echo 'selected'; } ?>>Payment Followup</option>
                                <option value="2" <?php if(!empty($s_reminder) && $s_reminder == 2){ echo 'selected'; } ?>>Lead Followup</option>
                                <option value="3" <?php if(!empty($s_reminder) && $s_reminder == 3){ echo 'selected'; } ?>>Task</option>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="completed" class="control-label">Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="completed">
                                <option value=""></option>
                                <option value="1" <?php if(!empty($s_status) && $s_status == 1){ echo 'selected'; } ?>>Completed</option>
                                <option value="2" <?php if(!empty($s_status) && $s_status == 2){ echo 'selected'; } ?>>Pending</option>
                                
                            </select>
                        </div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">
							<button style="margin-top: 24px;" class="btn btn-info" type="submit" value="print">Search</button>
						</div>
						<div class="col-md-1">
							<a style="margin-top: 24px;" class="btn btn-danger" href="<?php echo admin_url('reminder');?>">Reset</a>
						</div>





						<div class="col-md-12 table-responsive">																
								<table class="table">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Reminder For</th>
										<th>Reminder date</th>
										<th>Remark</th>
										<th>Status</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($reminder_list)){
										$z=1;
										foreach($reminder_list as $row){											
											if($row->reminder_for == 1){
												$reminder_for = 'Payment Followup';
											}elseif($row->reminder_for == 2){
												$reminder_for = 'Lead Followup';
											}elseif($row->reminder_for == 3){
												$reminder_for = 'Task';
											}


											if($row->completed == 1){
												$status = '<p class="text-success">Completed</p>';
											}else{
												$status = '<p class="text-warning">Pending</p>';
											}
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo cc($reminder_for);?></td>
												<td><?php echo date('d/m/Y h:i A',strtotime($row->reminder_date)); ?></td>
												<td><?php echo cc($row->remark); ?></td>
												<td><?php echo $status; ?></td>
												<td>
													<a class="btn btn-info" href="<?php  echo admin_url('reminder/details/'.$row->id); ?>">View</a>

													<?php 

													if($row->completed == 0){

														if(check_permission_page(155,'edit')){ ?>
														<a class="btn btn-info" href="<?php  echo admin_url('reminder/add/'.$row->id); ?>"><i class="fa fa-pencil" aria-hidden="true"></i></a>
														<?php
														}
														if(check_permission_page(155,'delete')){
														?>
														<a class="btn btn-danger" onclick="return confirm('Are you sure you want to Delete?');" href="<?php  echo admin_url('reminder/delete/'.$row->id); ?>"><i class="fa fa-trash" aria-hidden="true"></i></a>
														<?php	
														}
													}
													?>

													
												</td>
												
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>


													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
							
							
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

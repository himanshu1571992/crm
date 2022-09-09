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

           <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'salary-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Manage Salary <a href="<?php echo admin_url('salary/export_afterpay/'.$year.'/'.$month); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Export Unpaid Report</a></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
					
					
						<div class="form-group col-md-4">
							<label for="year" class="control-label"><?php echo 'Year'; ?> *</label>
							<select class="form-control" id="year" name="year">
								<option value="" disabled selected >--Select One-</option>
								<?php
								$j = date('Y');
								for($i=2017; $i<=$j; $i++){
									?>
									<option value="<?php echo $i;?>" <?php if(!empty($year) && $year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>
									<?php
								}
								?>
							</select>
						</div>
					
						<div class="form-group col-md-4">
							<label for="month" class="control-label"><?php echo 'Month'; ?> *</label>
							<select class="form-control" id="month" name="month">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($month_info)){
									foreach($month_info as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if(!empty($month) && $month == $row->id){ echo 'selected';} ?>  ><?php echo $row->month_name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
					
						
						<?php
						/*
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
						*/
						?>									
					</div>
					 <?php echo form_close(); ?>
					  <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('salary/pay_all'); ?>">
                        <div class="row">
						
							
                            <div class="col-md-12">																
								<table class="table ui-table">
									<thead>
									  <tr>
										<th>S.No</th>
										<th>Employee Name</th>
										<th>Paid Salary</th>
										<th>Action</th>
										<th>Paid At</th>
										<th class="text-center">Pay All <input type="checkbox" id="ckbCheckAll" /></th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($staff_list)){
										$z=1;
										
										//$year = date('Y');
										$c_day = date('d');
										$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
										foreach($staff_list as $staff){
											
											
											for($i=1;$i<=$day;$i++)
											{			
												$c_date = $year.'-'.$month.'-'.$i;
												$f_date = date('Y-m-d', strtotime($c_date));
												
												$att_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$f_date,'status'=>0), ''  );
												
												if(!empty($att_info)){
													//if($i < $c_day)
													if($f_date < date('Y-m-d'))
													{
														
														
														//joining date must be smaller
														$join_date = get_employee_joindate($staff->staffid);
														if($join_date <= $f_date){
															$dy = date('D', strtotime($f_date));
															if($dy == 'Sun'){
																$at = 3;
															}else{
																$at = 1;
															}
														}else{
															$at = 2;
														}



														
														
														$up_data = array(
															'status'=>$at,
															'created_at'=>date('Y-m-d H:i:s')
														);
														$this->home_model->update('tblstaffattendance',$up_data,array('id'=>$att_info->id));										
													}
												}


												$exist_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$f_date), ''  );
											
											
											if(empty($exist_info)){
													
												//if($i < $c_day)
												if($f_date < date('Y-m-d'))	
												{
													$dy = date('D', strtotime($f_date));
													if($dy == 'Sun'){
														$at = 3;
													}else{
														$at = 1;
													}

													//joining date logic
													$join_date = get_employee_joindate($staff->staffid);
													if($join_date > $f_date){
														$at = 2;
													}

													
													$in_data = array(
														'staff_id'=>$staff->staffid,
														'date'=>$f_date,
														'status'=>$at
													);
													$this->home_model->insert('tblstaffattendance',$in_data);	
													
												}else{
													$cd_data = array(
														'staff_id'=>$staff->staffid,
														'date'=>$f_date,
														'status'=>0
													);
													$this->home_model->insert('tblstaffattendance',$cd_data);	
																										
												}
											}
											
											
											//Checking Paid Leave
											$paidleave_info = $this->home_model->get_result('tblleaves', array('approved_status'=>1,'is_paid_leave'=>1,'addedfrom'=>$staff->staffid,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
											
											if(!empty($paidleave_info)){
												foreach($paidleave_info as $leave){
													$begin = new DateTime($leave->from_date);
													$end = new DateTime($leave->to_date);
													$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

													foreach($daterange as $dt){
														$dat = $dt->format("Y-m-d");
														if($dat == $f_date){
															
															$up_data = array(
																			'staff_id'=>$staff->staffid,
																			'date' => $f_date				
																			);
															
															$update = $this->home_model->update('tblstaffattendance',array('status'=>6),$up_data);
														}
													}
													if($f_date == $leave->to_date){
														
														$up_data = array(
																			'staff_id'=>$staff->staffid,
																			'date' => $f_date									
																			);
															
														$update = $this->home_model->update('tblstaffattendance',array('status'=>6),$up_data);
													}
												}
											}
											
											
											//Checking UnPaid Leave
											$leave_info = $this->home_model->get_result('tblleaves', array('approved_status'=>1,'is_paid_leave'=>0,'addedfrom'=>$staff->staffid,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
											
											if(!empty($leave_info)){
												foreach($leave_info as $leave){
													$begin = new DateTime($leave->from_date);
													$end = new DateTime($leave->to_date);
													$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

													foreach($daterange as $dt){
														$dat = $dt->format("Y-m-d");
														if($dat == $f_date){
															
															$up_data = array(
																			'staff_id'=>$staff->staffid,
																			'date' => $f_date				
																			);
															
															$update = $this->home_model->update('tblstaffattendance',array('status'=>2),$up_data);
														}
													}
													if($f_date == $leave->to_date){
														
														$up_data = array(
																			'staff_id'=>$staff->staffid,
																			'date' => $f_date									
																			);
															
														$update = $this->home_model->update('tblstaffattendance',array('status'=>2),$up_data);
													}
												}
											}
											
											
											//Checking Holydays
											$holyday_info = $this->home_model->get_result('tblcompanyevents', array('status'=>1,'from_date <='=>$f_date,'to_date >='=>$f_date), ''  );
											
											if(!empty($holyday_info)){
												foreach($holyday_info as $holyday){
													$begin = new DateTime($holyday->from_date);
													$end = new DateTime($holyday->to_date);
													$daterange = new DatePeriod($begin, new DateInterval('P1D'), $end);

													foreach($daterange as $dt){
														$dat = $dt->format("Y-m-d");
														if($dat == $f_date){
															
															$up_data = array(
																			'staff_id'=>$staff->staffid,
																			'date' => $f_date				
																			);
															
															$update = $this->home_model->update('tblstaffattendance',array('status'=>3),$up_data);
														}
													}
													if($f_date == $holyday->to_date){
														
														$up_data = array(
																			'staff_id'=>$staff->staffid,
																			'date' => $f_date									
																			);
															
														$update = $this->home_model->update('tblstaffattendance',array('status'=>3),$up_data);
													}
												}
											}

											//Checking Sunday Leave
											//if($i < $c_day)
											if($f_date < date('Y-m-d'))	
												{
													$dy = date('D', strtotime($f_date));
													if($dy == 'Sun'){
														if($i != 1){
															
															
															//last_date
															$j = ($i-1);
															$d_date = $year.'-'.$month.'-'.$j;
															$g_date = date('Y-m-d', strtotime($d_date));
															
															//next_date
															$k = ($i+1);
															$e_date = $year.'-'.$month.'-'.$k;
															$h_date = date('Y-m-d', strtotime($e_date));
															
															$last_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$g_date,'status'=>2), ''  );
															
															$next_info = $this->home_model->get_row('tblstaffattendance', array('staff_id'=>$staff->staffid,'date'=>$h_date,'status'=>2), ''  );
															
															if(!empty($last_info) && !empty($next_info)){
																$up_data = array(
																	'status'=>2,
																	'created_at'=>date('Y-m-d H:i:s')
																);
																$this->home_model->update('tblstaffattendance',$up_data,array('staff_id'=>$staff->staffid,'date'=>$f_date));
															}
														}
														
															
														
													}
													
																							
												}		
											}
										
											$salary_info = $this->home_model->get_row('tblsalarypaidlog', array('staff_id'=>$staff->staffid,'month'=>$month,'year'=>$year,'status'=>1), '');
											?>
																						
											<input type="hidden" name="staff_id[]" value="<?php echo $staff->staffid;?>">
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo $staff->firstname;?></td>
												
												
												<td><?php if(!empty($salary_info)){ echo $salary_info->net_salary; }else{ echo '--'; }?></td>
												<td>
												<?php
												if(!empty($salary_info)){
													echo '<a target="_blank" href="'. admin_url('salary/salary_print/'.$salary_info->id).'" class="actionBtn"><i class="fa fa-print" aria-hidden="true"></i> Print</a>';
												}else{
													echo '<a target="_blank" href="'. admin_url('salary/salary_details/'.$staff->staffid.'/'.$month.'/'.$year).'" class="actionBtn"><i class="fa fa-money" aria-hidden="true"></i> View</a>';
												}
												
												?>
												</td>
												<td><?php if(!empty($salary_info)){ echo date('d/m/Y',strtotime($salary_info->create_at)); }else{ echo '--'; }?></td>
												
												<td class="text-center"><?php if(empty($salary_info)){ 
												?>
												<input class="form-control pay_box checkBoxClass" type="checkbox" name="staffid[]" value="<?php echo $staff->staffid; ?>">	
												<?php
												}else{ echo '<b>Paid</b>'; } ?></td>
												
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
						
							<input type="hidden" name="month" value="<?php echo $month; ?>">	
							<input type="hidden" name="year" value="<?php echo $year; ?>">	
							<div class="text-right">
								<button class="actionBtn pay_all" type="button">Pay To All</button>
							</div>
                               
                            </div>
							
							
							
							</form>
							 <div class="btn-bottom-toolbar text-right">
                           
                        </div>
                        </div>
                       
                    </div>
                </div>
                         
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
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
	
		var retVal = confirm("Do you want to continue ?");
		if( retVal == true ){
		  if (! $("input[name='staffid[]']").is(":checked")){
			   alert('Please Check Any Checkbox First!');
			   return false;
			}else{
				$("#salary_form").submit();	
			}
	   }
               
		
		
		
		
		
	});	
</script> 

<script>
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
        }
    });
});
</script>

</body>
</html>

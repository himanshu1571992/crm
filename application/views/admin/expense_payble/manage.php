<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

           <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'salary-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Expense Payable Report</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-4">
							<label for="year" class="control-label">Year *</label>
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
							<label for="month" class="control-label">Month *</label>
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


                        <div class="form-group col-md-4" app-field-wrapper="date">
							<label for="paid_date" class="control-label">Paid Date</label>
							<div class="input-group date">
								<input id="paid_date" name="paid_date" required class="form-control datepicker" value="<?php echo date('d/m/Y');?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>		
						</div>	
													
					</div>
					 <?php echo form_close(); ?>

					  <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('expense_payble/pay_all'); ?>">
                        <div class="row">

                        	<div class="col-md-12 text-right" style="margin-top: 15px;">
								<a target="_blank" href="<?php  echo admin_url('expense_payble/print_payble_report/'.$year.'/'.$month); ?>" class="btn btn-info">Print Expense Payble Report</a>
								<a target="_blank" href="<?php  echo admin_url('expense_payble/print_extra_report/'.$year.'/'.$month); ?>" class="btn btn-info">Print Expense Paid Report</a>
							</div>

							<?php
							$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
							$date_1 = $year.'-'.$month.'-01';
							$date_2 = $year.'-'.$month.'-'.$day;

							$from_date = date('Y-m-d',strtotime($date_1));
							$to_date = date('Y-m-d',strtotime($date_2));
							?>						
                            <div class="col-md-12 table-responsive">																
								<table class="table">
									<thead>
									  <tr>
										<th>S.No</th>
										<th>Employee Name</th>
										<th>Amount</th>
										<th>Paid At</th>
										<th class="text-center">Pay All <input type="checkbox" id="ckbCheckAll" /></th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($staff_list)){
										$z=1;
										foreach($staff_list as $staff){
											
										
											$paid_info = $this->home_model->get_row('tblexpensepayble', array('staff_id'=>$staff->staffid,'month'=>$month,'year'=>$year,'status'=>1), '');
											$wallet_amount = wallet_amount($staff->staffid,$from_date,$to_date);

											?>
																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo $staff->firstname;?></td>								
												
												<td><?php echo $wallet_amount; ?></td>
												
												<td><?php if(!empty($paid_info)){ echo date('d/m/Y',strtotime($paid_info->paid_date)); }else{ echo '--'; }?></td>
												
												<td class="text-center"><?php if(empty($paid_info)){ 
												?>
												<input class="form-control pay_box checkBoxClass" type="checkbox" name="staffid[]" value="<?php echo $staff->staffid; ?>">	
												<?php
												}else{ echo '<b>Paid</b>'; } ?></td>
												
											</tr>
											<input type="hidden" name="amount_<?php echo $staff->staffid; ?>" value="<?php echo $wallet_amount; ?>">
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>
						
							<input type="hidden" name="month" value="<?php echo $month; ?>">	
							<input type="hidden" name="year" value="<?php echo $year; ?>">	
							
                               
                            </div>
							
							<div class="text-right foot-btn">
								<button class="btn btn-info pay_all" type="button">Pay To All</button>
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

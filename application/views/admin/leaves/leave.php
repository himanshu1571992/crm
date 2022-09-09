<?php init_head(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
   <div class="content">
      <div class="row">
       
         <?php //echo form_open_multipart($this->uri->uri_string(),array('id'=>'expense-form','class'=>'dropzone dropzone-manual')) ;?>
		 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'leave_form', 'class' => 'proposal-form')); ?>
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
                 
                  <h4 class="no-margin"><?php  if(!empty($request) && ($request->approved_status > 0)){ echo 'Leave Details'; }else{ echo $title; } ?></h4>
                  <hr class="hr-panel-heading" />
                 
                 				  
				 <?php
				 /*
				 if(is_admin() == 1){
				 $employees = get_branch_employees();
				 ?>
				 
					<div class="form-group">
					<label for="addedfrom" class="control-label">For Self</label> 
						<input type="checkbox" id="for_self" class="form-control" style="display: inline-block; width: auto; height: auto; margin-left:15px;">
					</div>
				 
				   <div class="form-group" id="employee_div">
						<label for="addedfrom" class="control-label"><?php echo _l('expenses_employee'); ?> *</label>
						<select class="form-control selectpicker" id="addedfrom" name="addedfrom">
							<option value="" disabled selected >--Select One-</option>
							<?php
							if(!empty($employees)){
								foreach($employees as $employee){
									?>
									<option value="<?php echo $employee->staffid;?>" <?php echo (isset($expense->addedfrom) && $expense->addedfrom ==$employee->staffid) ? 'selected' : "" ?>><?php echo $employee->firstname; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					
					<input type="hidden" value="1" name="by_admin">
				<?php
				}
				*/
				?>
				
    
					<?php
					if(!empty($request) && ($request->approved_status > 0)){
						$category_info = $this->home_model->get_row('tblleavescategories', array('id'=>$request->category), '');	
						?>
						<div class="form-group">
							<label class="control-label"><?php echo 'Leave Type'; ?></label>
							<input type="text"  class="form-control" disabled value="<?php echo $category_info->name; ?>">
						</div>
						
						<input type="hidden" id="category" name="category" value="<?php echo $request->category; ?>">
						<?php
					}else{
					?>
					<div class="form-group">
						<label for="category" class="control-label"><?php echo 'Leave Type'; ?> *</label>
						<select class="form-control" id="category" name="category" required>
							<option value="" disabled selected >--Select One-</option>
							<?php
							if(!empty($categories)){
								foreach($categories as $category){
									?>
									<option value="<?php echo $category['id'];?>" <?php echo (isset($request->category) && $request->category == $category['id']) ? 'selected' : "" ?>><?php echo $category['name']; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					<?php
					}
					?>		
				  
				  
					<div class="form-group">
						<label for="reason" class="control-label"><?php echo'Reason'; ?></label>
						<input type="text" id="reason" name="reason" class="form-control" value="<?php echo (isset($request->reason) && $request->reason != "") ? $request->reason : "" ?>" <?php if(!empty($request) && ($request->approved_status > 0)){ echo 'readonly'; }?>>
					</div>
				  
					<div class="row">
					
					 <div class="form-group col-md-6" app-field-wrapper="date">
						<label for="from_date" class="control-label"><?php echo 'From Date' ?></label>
							<div class="input-group date">
								<input id="from_date" name="from_date" required class="form-control leavedate" value="<?php echo (isset($request->from_date) && $request->from_date != "") ? date('d/m/Y',strtotime($request->from_date)) : "" ?>" aria-invalid="false" type="text" <?php if(!empty($request) && ($request->approved_status > 0)){ echo 'readonly'; }?>><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>		
						</div>
						
					<div class="form-group col-md-6" app-field-wrapper="date">
						<label for="to_date" class="control-label"><?php echo 'To Date' ?></label>
							<div class="input-group date">
								<input id="to_date" name="to_date" required class="form-control leavedate" value="<?php echo (isset($request->to_date) && $request->to_date != "") ? date('d/m/Y',strtotime($request->to_date)) : "" ?>" aria-invalid="false" type="text" <?php if(!empty($request) && ($request->approved_status > 0)){ echo 'readonly'; }?>><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>		
						</div>	
					
					</div>
					
					<div class="form-group">
						<label for="total_days" class="control-label"><?php echo'Total Days'; ?></label>
						<input type="text" id="total_days" name="total_days" class="form-control" value="<?php echo (isset($request->total_days) && $request->total_days != "") ? $request->total_days : "" ?>" readonly>
					</div>
					
					 <?php 
					 if(!empty($request) && ($request->approved_status > 0)){ 
					 	
					 }else{
						?>
						<div class="form-group">
							<label for="leave_file" class="control-label"><?php echo 'Attachment File'; ?></label>
							<input type="file" id="leave_file" name="leave_file" style="width: 100%;">
						</div>
						<?php	
					 }					 
					 ?>
					
					
				    
                  <hr class="hr-panel-heading" />
                 
				 
					
                  
				
                   <div class="btn-bottom-toolbar text-right">
					
					 <?php
				   if(empty($request)){
					   echo '<button type="button" id="submit_leave" class="btn btn-info">Submit</button>';
				   }else{
					   
				   if(!empty($request) && $request->approved_status == 0){
					   echo '<a href="'.admin_url('leaves/cancel_leave/'.$request->id).'" onclick="return confirm(\'Are you sure you want to Cancel Leave?\');" class="btn btn-danger">Cancel Request</a>&nbsp;';
					   
				   }
				   
					   
					   if(!empty($request) && ($request->approved_status > 0)){ 
					   
					   }else{
						   echo '<button type="submit"  class="btn btn-info">Submit</button>'; 
					   }
					  
				   }
				   ?>
					
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
                  <h4 class="no-margin"><?php echo 'Send Approval'; ?></h4>
                  <hr class="hr-panel-heading" />
                 
                 
                  <div class="clearfix mtop15"></div>
                  <div class="row">
                    
                 <div id="other_action">   
					<?php
					if(empty($request)){
						if(!empty($allStaffdata))
						{
						foreach($allStaffdata as $singlegroup)
						{
							?>
							<h4><?php echo $singlegroup['name'];?></h4>
							<div class="activity-feed">
							<?php
								foreach($singlegroup['staffs'] as $singlestaff)
								{
							?>
								<div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
									<input type="checkbox" name="staffid[]" value="<?php echo $singlestaff['staffid'];?>" id="contact_primary<?php echo $singlestaff['staffid'];?>">
									<label style="width:100%;" for="contact_primary<?php echo $singlestaff['staffid'];?>"><span style="font-size:14px;"><?php echo $singlestaff['firstname'].' - '.$singlestaff['email'];?></span></label>
								</div>
							<?php
								}
							?>			
							</div>
					<?php
						}
						}
					}
					else{
						if(is_admin() == 1){
							$checkproposal=$this->db->query("SELECT * FROM `tblleaves` WHERE `id`='".$request->id."'")->result_array();
						}else{
							$checkproposal=$this->db->query("SELECT * FROM `tblleaves` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$request->id."'")->result_array();
						}
						
						$proposalapproval=$this->db->query("SELECT * FROM `tblleaveapproval` WHERE `leave_id`='".$request->id."'")->row_array();
						if(count($checkproposal)>0 && count($proposalapproval)==0)
						{
						if(!empty($allStaffdata))
						{	
						foreach($allStaffdata as $singlegroup)
						{?>
							<h4><?php echo $singlegroup['name'];?></h4>
							<div class="activity-feed">
							<?php
							foreach($singlegroup['staffs'] as $singlestaff)
							{?>
								<div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
									<input type="checkbox" name="staffid[]" value="<?php echo $singlestaff['staffid'];?>" id="contact_primary<?php echo $singlestaff['staffid'];?>">
									<label style="width:100%;" for="contact_primary<?php echo $singlestaff['staffid'];?>"><span style="font-size:14px;"><?php echo $singlestaff['firstname'].' - '.$singlestaff['email'];?></span></label>
								</div>
						<?php
							}?>			
							</div>
						<?php
						}
						}
						?>
							<div class="col-md-12">
							   <div class="text-right">
								  <button id="expense_approval" class="btn btn-info expense_approval"  value="<?php echo $request->id;?>">Submit</button>
							   </div>
							</div>
							<?php
						}
						else if(count($checkproposal)==0)
						{
							
							$propdetails=$this->db->query("SELECT * FROM `tblleaves` WHERE `id`='".$request->id."'")->row_array();
								if(count($proposalapproval)>0 && $proposalapproval['approve_status']==0)
								{?>
									<div class="panel_s no-shadow leadsdv">
										<div class="activity-feed">
										  <div class="col-md-12">
											<h4>Would you like to accept this Expense?</h4>
											<div class="text-right">
												<input type="hidden" id="addedfrom" value="<?php echo $propdetails['addedfrom']; ?>">
												<div class="form-group">
													<textarea id="proposal_desc" placeholder="Enter Reason"class="form-control proposal_desc" rows="4" enabled="enabled"></textarea>
												</div>
												<button val="<?php echo $request->id;?>"class="btn btn-success approval" value="1"><?php echo 'Accept'; ?></button>
												<button val="<?php echo $request->id;?>" class="btn btn-info approval" value="2"><?php echo 'Decline'; ?></button>
											</div>
										  </div>
										</div>
									</div>
									<div class="leadaccept" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Leave is Accept Successfully.</div>
									<div class="leaddecline" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Leave is Decline Successfully.</div>
					<?php
								}
								else
								{									
									
									$staffapprov=$this->db->query(" SELECT * FROM `tblleaveapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`leave_id`='".$request->id."' GROUP BY aps.staff_id")->result_array();
									foreach($staffapprov as $singleapprovstaff)
									{?>
									<div class="activity-feed">
										<div style="margin-bottom: 14px;" class="">
											<label style="width:100%;" for="contact_primary2">
												<span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' - '.$singleapprovstaff['email']; if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;">Approval Sent</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Approval Accepted</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span> </h5>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Approval Decline</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5></span>';}	?></span>
											</label>
										</div>
									</div>
									<?php
									}
								}
												
						}
						else
						{
							$staffapprov=$this->db->query(" SELECT * FROM `tblleaveapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`leave_id`='".$request->id."' GROUP BY aps.staff_id")->result_array();
							foreach($staffapprov as $singleapprovstaff)
							{?>
							<div class="activity-feed">
								<div style="margin-bottom: 14px;" class="">
									<label style="width:100%;" for="contact_primary2">
										<span style="font-size:14px;"> <?php echo $singleapprovstaff['firstname'].' - '.$singleapprovstaff['email']; if($singleapprovstaff['approve_status']==0){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #FFC107;">Approval Sent</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['created_at'])).'</span></h5>';}else if($singleapprovstaff['approve_status']==1){echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #4CAF50;">Approval Accepted</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5>';}else{echo'<span style="margin-left: 6%;color: #fff;border-radius: 9px;padding: 8px;background: #F44336;">Approval Decline</span> <span>'.date('d/m/Y H:i a',strtotime($singleapprovstaff['updated_at'])).'</span></h5></span>';}	?></span>
									</label>
								</div>
							</div>
							<?php
							}
						}
					}						
					?>
					
				</div>	
				
					 

					 
                  </div>
									
					 
               </div>
            </div>
         </div>
		 <input type="hidden" value="3" name="currency">		 
		 <input type="hidden" id="is_paid_leave" value="1" name="is_paid_leave">		 
         <?php echo form_close(); ?>
      </div>
      <div class="btn-bottom-pusher"></div>
   </div>
</div>

<?php init_tail(); ?>

</body>
</html>


<script type="text/javascript">
$('#for_self').click(function(){
if($("#for_self").is(':checked'))
    $("#employee_div").hide();  // checked
else
    $("#employee_div").show();  // unchecked

});	
</script> 


<script type="text/javascript">
	$('#to_date').change(function(){
	var to_date = $(this).val();
	var from_date = $('#from_date').val();
	
	if(to_date != '' && from_date != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/leaves/get_total_days'); ?>",
			data    : {'to_date' : to_date, 'from_date' : from_date,},
			success : function(response){
				if(response != ''){
					$("#total_days").val(response);
				}
			}
		})
	}
		
	});
</script> 	


<script type="text/javascript">
	$('#from_date').change(function(){
	var from_date = $(this).val();
	var category = $('#category').val();
	
	if(category != '' && from_date != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/leaves/user_leave_validate'); ?>",
			data    : {'category' : category, 'from_date' : from_date,},
			success : function(response){
				if(response == 1){
					alert('This Will Not a Paid Leave');
					$("#is_paid_leave").val('0');
				}else{
					$("#is_paid_leave").val('1');
				}
			}
		})
	}
		
	});
</script> 


<script type="text/javascript">
	$('#category').change(function(){
	var category = $(this).val();
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/leaves/check_pending_leave'); ?>",
			data    : {'category' : category},
			success : function(response){
				if(response == '1'){
					alert('Your Leave is Already in Process, Can\'t Apply New Leave!');
					$('#category').val('');
					$('#submit_leave').prop('disabled', true);
				}else{
					 $('#submit_leave').prop('disabled', false);
				}
			}
		})
	});
</script> 


<script type="text/javascript">
var $submit = $('#submit_leave');
var count = 0;

$submit.click(function(){
    $('input[type=checkbox]').each(function(){
    if (this.checked === true) {
        count=count + 1;
    }
    console.log(count); //simply here to make sure it's working
    });
	
	var category = $('#category').val();
	
	if (count === 0) {       
			alert("Please make sure at least one Person has been selected.");
		}else{
			$("#leave_form").submit();
		}
    
});


</script>


<script>
$('.leavedate').datepicker({
  
     dateFormat: 'dd/mm/yy',
	 minDate:new Date()
	  
});
</script>
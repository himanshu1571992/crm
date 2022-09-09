<?php init_head(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
   <div class="content">
      <div class="row">
<?php
if(!empty($request)){
	$person_info = branch_employee($request->branch,get_staff_user_id());
}
?>        
         <?php //echo form_open_multipart($this->uri->uri_string(),array('id'=>'expense-form','class'=>'dropzone dropzone-manual')) ;?>
		 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'request_form', 'class' => 'proposal-form')); ?>
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
                 
                  <h4 class="no-margin"><?php echo $title; ?></h4>
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
						$category_info = $this->home_model->get_row('tblrequestscategories', array('id'=>$request->category), '');	
						?>
						<div class="form-group">
							<label class="control-label"><?php echo 'Request Category'; ?></label>
							<input type="text"  class="form-control" disabled value="<?php echo $category_info->name; ?>">
						</div>
						
						<input type="hidden" id="category" name="category" value="<?php echo $request->category; ?>">
						<?php
					}else{
					?>
					<div class="form-group">
						<label for="category" class="control-label"><?php echo _l('requiest_category'); ?> *</label>
						<select class="form-control" id="category" name="category" required="">
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
						<label for="amount" class="control-label"><?php echo 'Amount'; ?></label>
						<input id="amount" name="amount" class="form-control" value="<?php echo (isset($request->amount) && $request->amount != "") ? $request->amount : "" ?>" type="number" required <?php if(!empty($request) && ($request->approved_status > 0)){ echo 'readonly'; }?>>
					</div>
					
				  <div id="loan_div">
				  
				  <?php
				  if(!empty($request) && ($request->approved_status > 0)){
					  $tenure_info = $this->home_model->get_row('tblloantenues', array('id'=>$request->tenure), '');	
						?>
						<div class="form-group">
							<label class="control-label"><?php echo 'Loan Tenure'; ?></label>
							<input type="text"  class="form-control" disabled value="<?php if(!empty($tenure_info)){ echo $tenure_info->name; } ?>">
						</div>
						
						<input type="hidden" id="tenure" name="tenure" value="<?php echo $request->tenure; ?>">
						<?php
				  }else{
					 ?>
					<div class="form-group">
						<label for="tenure" class="control-label"><?php echo 'Loan Tenure'; ?></label>
						<select class="form-control selectpicker" id="tenure" name="tenure">
							<option value="" disabled selected >--Select One-</option>
							<?php
							if(!empty($loan_tenues)){
								foreach($loan_tenues as $tenure){
									?>
									<option value="<?php echo $tenure['id'];?>" <?php echo (isset($request->tenure) && $request->tenure == $tenure['id']) ? 'selected' : "" ?>><?php echo $tenure['name']; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					<?php	
				  }
				  ?>
				  
				  
				 </div>


				 <div id="paymet_mode_div">
				 
				 
				 <?php
				 if(!empty($request) && ($request->approved_status > 0)){
					 $payment_info = $this->home_model->get_row('tblpaymentmode', array('id'=>$request->payment_mode), '');	
						?>
						<div class="form-group">
							<label class="control-label"><?php echo 'Payment Mode'; ?></label>
							<input type="text"  class="form-control" disabled value="<?php if(!empty($payment_info)){ echo $payment_info->name; } ?>">
						</div>
						
						<input type="hidden" id="payment_mode" name="payment_mode" value="<?php echo $request->payment_mode; ?>">
						<?php
				 }else{
				 ?>
					<div class="form-group">
							<label for="payment_mode" class="control-label"><?php echo 'Payment Mode'; ?></label>
							<select class="form-control selectpicker" id="payment_mode" name="payment_mode">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($payment_mode_info)){
									foreach($payment_mode_info as $payment_mode){
										?>
										<option value="<?php echo $payment_mode->id;?>" <?php echo (isset($request->payment_mode) && $request->payment_mode == $payment_mode->id) ? 'selected' : "" ?>><?php echo $payment_mode->name; ?></option>
										<?php
									}
								}
								?>
						</select>
					</div>
				 <?php	
				 }
				 ?>
				  
				 </div>	
				    
                  <hr class="hr-panel-heading" />
                 
				  <div id="reason_div">
					  <div class="form-group">
							<label for="reason" class="control-label"><?php echo'Reason'; ?></label>
							<input type="text" id="reason" name="reason" class="form-control" value="<?php echo (isset($request->reason) && $request->reason != "") ? $request->reason : "" ?>" <?php if(!empty($request) && ($request->approved_status > 0)){ echo 'readonly'; }?>>
						</div>
					</div>
				  
				  <div class="form-group">
						<label for="newlead_company" class="control-label"><?php echo 'Description'; ?></label>
						<textarea id="description" name="description" class="form-control" <?php if(!empty($request) && ($request->approved_status > 0)){ echo 'readonly'; }?> rows="3"><?php echo (isset($request->description) && $request->description != "") ? $request->description : "" ?></textarea>
				 </div>
                  
				
                   <div class="btn-bottom-toolbar text-right">
				   
				   <?php
				   if(!empty($request) && $request->approved_status == 0){
					   echo '<a href="'.admin_url('requests/cancel_request/'.$request->id).'" onclick="return confirm(\'Are you sure you want to Cancel Request?\');" class="btn btn-danger">Cancel Request</a>';
				   }
				   ?>
				   
				   <?php
				   if(empty($request)){
					   echo '<button type="button" id="submit_request" class="btn btn-info">Submit</button>';
				   }else{
					   echo '<button type="submit" class="btn btn-info">Submit</button>';  
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
							$checkproposal=$this->db->query("SELECT * FROM `tblrequests` WHERE `id`='".$request->id."'")->result_array();
						}else{
							$checkproposal=$this->db->query("SELECT * FROM `tblrequests` WHERE `addedfrom`='".get_staff_user_id()."' AND `id`='".$request->id."'")->result_array();
						}
						
						$proposalapproval=$this->db->query("SELECT * FROM `tblrequestapproval` WHERE `request_id`='".$request->id."'")->row_array();
						if(count($checkproposal)>0 && count($proposalapproval)==0)
						{
							
						if(!empty($allStaffdata)){	
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
						}?>
							<div class="col-md-12">
							   <div class="text-right">
								  <button id="expense_approval" class="btn btn-info expense_approval"  value="<?php echo $request->id;?>">Submit</button>
							   </div>
							</div>
							<?php
						}
						}
						else if(count($checkproposal)==0)
						{
							
							$propdetails=$this->db->query("SELECT * FROM `tblrequests` WHERE `id`='".$request->id."'")->row_array();
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
									<div class="leadaccept" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Expense is Accept Successfully.</div>
									<div class="leaddecline" style="color:green;display:none;    text-align: center;font-size: 19px;color: green;padding: 7px;font-weight: 500;">Expense is Decline Successfully.</div>
					<?php
								}
								else
								{									
									
									$staffapprov=$this->db->query(" SELECT * FROM `tblrequestapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`request_id`='".$request->id."' GROUP BY aps.staff_id")->result_array();
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
							$staffapprov=$this->db->query(" SELECT * FROM `tblrequestapproval` aps LEFT JOIN `tblstaff` ts on aps.`staff_id`=ts.staffid WHERE aps.`request_id`='".$request->id."' GROUP BY aps.staff_id")->result_array();
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
				
				<div id="transfer_action" hidden>
					
					 <div class="form-group">
						<label for="branch" class="control-label"><?php echo 'Branch Name'; ?> *</label>
						<select class="form-control selectpicker" id="branch" name="branch">
							<option value="" disabled selected >--Select Branch-</option>
							<?php
							if(!empty($branch_info)){
								foreach($branch_info as $branch){
									?>
									<option value="<?php echo $branch->id;?>" <?php echo (isset($request->branch) && $request->branch == $branch->id) ? 'selected' : "" ?>><?php echo $branch->comp_branch_name; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					
					
					<div class="form-group">
						<label for="person_id" class="control-label"><?php echo 'Person Name'; ?> *</label>
						<select class="form-control" id="person_id" name="person_id">
							<option value="" disabled selected >--Select Person-</option>
							<?php
							if(!empty($person_info)){
								foreach($person_info as $person){
									?>
									<option value="<?php echo $person->staffid;?>" <?php echo (isset($request->person_id) && $request->person_id == $person->staffid) ? 'selected' : "" ?>><?php echo $person->firstname.' ['.$person->email.']'; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					
				
				</div>
					 

					 
                  </div>
									
					 
               </div>
            </div>
         </div>
		 <input type="hidden" value="3" name="currency">		 
         <?php echo form_close(); ?>
      </div>
      <div class="btn-bottom-pusher"></div>
   </div>
</div>

<?php init_tail(); ?>

</body>
</html>



<script type="text/javascript">
	$('#category').change(function(){
	var category = $(this).val();
			 if(category == 3){
					$('#loan_div').show(); 
					$('#reason_div').hide(); 				 
					$('#paymet_mode_div').hide();
					$('#transfer_action').hide(); 
					$('#other_action').show();
				 
			 }else if(category == 4){
					$('#loan_div').hide(); 
					$('#reason_div').show();				 
					$('#paymet_mode_div').show();
					$('#transfer_action').show(); 
					$('#other_action').hide();
			 }else{
					$('#loan_div').hide(); 
					$('#reason_div').show(); 				 
					$('#paymet_mode_div').hide();
					$('#transfer_action').hide(); 
					$('#other_action').show(); 
			 }
			 			 
			 
		});
</script> 


<script type="text/javascript">
$( document ).ready(function() {
	var category = $('#category').val();
			  if(category == 3){
					$('#loan_div').show(); 
					$('#reason_div').hide(); 				 
					$('#paymet_mode_div').hide();
					$('#transfer_action').hide(); 
					$('#other_action').show();
				 
			 }else if(category == 4){
					$('#loan_div').hide(); 
					$('#reason_div').hide();				 
					$('#paymet_mode_div').show();
					$('#transfer_action').show(); 
					$('#other_action').hide();
			 }else{
					$('#loan_div').hide(); 
					$('#reason_div').show(); 				 
					$('#paymet_mode_div').hide();
					$('#transfer_action').hide(); 
					$('#other_action').show(); 
			 }
			 
			 
		});
</script> 


<script type="text/javascript">
$('#for_self').click(function(){
if($("#for_self").is(':checked'))
    $("#employee_div").hide();  // checked
else
    $("#employee_div").show();  // unchecked

});	
</script> 


<script type="text/javascript">
	$('#branch').change(function(){
	var branch_id = $(this).val();
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/requests/get_branch_person'); ?>",
			data    : {'branch_id' : branch_id},
			success : function(response){
				if(response != ''){
					$("#person_id").html(response);
				}
			}
		})
	});
</script> 	


<script type="text/javascript">
	$('#category').change(function(){
	var category = $(this).val();
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/requests/check_existing_request'); ?>",
			data    : {'category' : category},
			success : function(response){
				if(response == '1'){
					alert('Your request is already in process with this Category');
					$('#category').val('');
				}
			}
		})
	});
</script> 

<script type="text/javascript">
var $submit = $('#submit_request');
var count = 0;

$submit.click(function(){
    $('input[type=checkbox]').each(function(){
    if (this.checked === true) {
        count=count + 1;
    }
    console.log(count); //simply here to make sure it's working
    });
	
	var category = $('#category').val();
	
	if(category != 4){
		if (count === 0) {       
			alert("Please make sure at least one Person has been selected.");
		}else{
			$("#request_form").submit();
		}
	}else{
		$("#request_form").submit();
	}
    
});


</script> 	

<script type="text/javascript">
	$('#category').change(function(){
	var category = $(this).val();
	var amount = $('#amount').val();
	if(amount != '' && category == 4){
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/requests/check_wallet_amount'); ?>",
			data    : {'amount' : amount},
			success : function(response){
				
				if(response == '1'){
					alert('Your Wallet Amount is Not Enough for this Request');
					$('#amount').val('');
				}
			}
		})
	}
		 
	});
</script> 

<script type="text/javascript">
	$('#amount').change(function(){
	var amount = $(this).val();
	var category = $('#category').val();
	if(amount != '' && category == 4){
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/requests/check_wallet_amount'); ?>",
			data    : {'amount' : amount},
			success : function(response){
				if(response == '1'){
					alert('Your Wallet Amount is Not Enough for this Request');
					$('#amount').val('');
				}
			}
		})
	}
		 
	});
</script> 

<?php init_head(); ?>
<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
	.text-content{
		margin-left: 12px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
   	<div class="content">
      	<div class="row">
		 	<?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form', "onsubmit" => "return confirm('Do you really want to take action ?');")); ?>
			<div class="col-md-8">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="no-margin"><?php echo $title; ?></h4>
						<hr class="hr-panel-heading" />
						<?php 
							$number = 'REQ-PTC-'.number_series($request_info["id"]);
						?>	
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Id :</label> <span class="text-content"><?php echo $number; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Date :</label> <span class="text-content"><?php echo $request_info["date"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Requested Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["request_amount"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Approved Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["approved_amount"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">From Name :</label> <span class="text-content"><?php echo $request_info["approved_by"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Group Name :</label> <span class="text-content"><?php echo $request_info["group_name"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Reason :</label> <span class="col-md-6"><?php echo cc($request_info["reason"]); ?></span>
						</div>
						<div class="btn-bottom-toolbar text-right">
							<?php if ($request_info["confirmed_by_user"] == 0){ ?>
								<button type="submit" class="btn btn-info"><?php echo 'Submit'; ?></button>
							<?php }else if ($request_info["approved_status"] == 2) { ?>
								<h3 class="text-danger text-center">Rejected</h3>
							<?php }else if ($request_info["approved_status"] == 3 || $request_info["cancel_status"] == "true"){ ?>   
								<h3 class="text-danger text-center">Cancelled</h3> 
							<?php }else if ($request_info["confirmed_by_user"] == 1 && $request_info["approved_status"] == 1){ ?>   
								<h3 class="text-success text-center">Completed</h3> 
							<?php }else if ($request_info["approved_status"] == 1){ ?>   
								<h3 class="text-success text-center">Approved</h3> 
							<?php } ?>
						</div>	
					</div>
				</div>
				<?php if ($request_info["confirmed_by_user"] == 0){ ?>
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin"><?php echo 'Request Action'; ?></h4>
							<hr class="hr-panel-heading" />
							<div class="clearfix mtop15"></div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="receive_status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
											<select class="form-control selectpicker" id="receive_status" name="receive_status" required="">
												<option value=""></option>
												<option value="1" <?php echo (isset($request_info["confirmed_by_user"]) && $request_info["confirmed_by_user"] == 1) ? 'selected' : "" ?>>Received</option>
												<option value="2" <?php echo (isset($request_info["confirmed_by_user"]) && $request_info["confirmed_by_user"] == 2) ? 'selected' : "" ?>>Not Received</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 confirmation_payment_mode_div">
										<div class="form-group">
											<label for="confirmation_payment_mode" class="control-label"><?php echo 'Payment Mode'; ?> *</label>
											<select class="form-control selectpicker confirmation_payment_mode" id="confirmation_payment_mode" name="confirmation_payment_mode" required="">
												<option value="" disabled selected >--Select One-</option>
												<?php
												if(!empty($payment_mode_info)){
													foreach($payment_mode_info as $row){
														?>
														<option value="<?php echo $row->id;?>" <?php echo (isset($request->confirmation_payment_mode) && $request->confirmation_payment_mode == $row->id) ? 'selected' : "" ?>><?php echo $row->name; ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="newlead_company" class="control-label"><?php echo 'Confirmation Remark'; ?></label>
											<textarea id="user_confirmation_remark" name="user_confirmation_remark" required class="form-control" rows="3"><?php echo (isset($request->user_confirmation_remark) && $request->user_confirmation_remark != "") ? $request->user_confirmation_remark : "" ?></textarea>
										</div>
									</div>
								</div>
							</div>									
						</div>
					</div>
				<?php } ?>
			</div>
			<div class="col-md-4">
				<div class="panel_s">
					<div class="panel-body">
						<?php 
							if ($request_info["approved_status"] > 0){
								if ($request_info["approved_status"] == 2){
									$status = "Rejected";
									$status_cls = "label label-danger";
								}else if ($request_info["approved_status"] == 3 || $request_info["cancel_status"] == "true"){
									$status = "Cancelled";
									$status_cls = "label label-danger";
								}else if ($request_info["confirmed_by_user"] == 1 && $request_info["approved_status"] == 1){
									$status = "Completed";
									$status_cls = "label label-success";
								}else if ($request_info["approved_status"] == 1){
									$status = "Approved";
									$status_cls = "label label-success";
								}
						?>
							<div class="col-md-12">
								<label for="Status" class="title-panel">Status :</label> <span class="<?php echo $status_cls; ?>"><?php echo $status; ?></span>
							</div>
						<?php } ?>
						<div class="col-md-12">
							<label for="approved_by" class="control-label title-panel">Approved / Rejected By :</label> <span class="text-content"><?php echo $request_info["approved_by"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="approved_date" class="control-label title-panel">Approved / Rejected Date :</label> <span class="text-content"><?php echo $request_info["approved_date"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="approved_remark" class="control-label title-panel">Approved / Rejected Remark :</label> <span class="text-content"><?php echo $request_info["remark"]; ?></span>
						</div>
						<?php if ($request_info["confirmed_by_user"] > 0){ ?>
							<div class="col-md-12">
								<label for="confirmation_status" class="control-label title-panel">Confirmation Status :</label> <span class="text-content"><?php echo ($request_info["confirmed_by_user"] == 1) ? "Received":"Not Received"; ?></span>
							</div>
							<div class="col-md-12">
								<label for="confirmation_date" class="control-label title-panel">Confirmation Date :</label> <span class="text-content"><?php echo $request_info["confirmed_date"]; ?></span>
							</div>
						<?php } ?>	
					</div>	
				</div>
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="no-margin"><?php echo 'Read By Details'; ?></h4>
						<hr class="hr-panel-heading" />
						<div class="col-md-12">
							<?php 
								if (!empty($read_by_user)){
									foreach ($read_by_user as $staff) {
							?>
										<div class="total-column panel_s">
											<div class="panel-body">
												<label for="id" class="col-md-4 title-panel">Read By : </label>
												<span><?php echo $staff["name"]; ?>&nbsp;<span class="text-danger">(<?php echo $staff["read_date"]; ?>)</span></span>
											</div>	
										</div>
							<?php            
									}
								}
							?>
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
	$(document).on("change", "#receive_status", function(){
		var status_val = $(this).val();
		if(status_val == 1){
			$('#user_confirmation_remark').val('Yes, Received with Thanks.');
			$(".confirmation_payment_mode_div").show();
			$("#confirmation_payment_mode").attr("required", "");
		}else{
			$('#user_confirmation_remark').val('Not, Received yet');
			$(".confirmation_payment_mode_div").hide();
			$("#confirmation_payment_mode").removeAttr("required", "");
		}
	});											

</script> 
</body>
</html>


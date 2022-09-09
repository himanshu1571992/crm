
<?php init_head(); ?>
<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
	.text-content{
		margin-left: 12px;
	}
	.badge-danger{
		background-color: red;
	}
	.badge-success{
		background-color: yellowgreen;
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
						<div class="col-md-12">
							<?php
								$cash_received = ($request_info["cash_received"] == 1) ? ' <span class="badge badge-danger"> Cash Received</span>' : '';
							?>
							<label for="id" class="control-label title-panel col-md-6">Id :</label> <span class="text-content"><?php echo "REQ-PTC-".number_series($request_info["id"]); ?></span><?php echo $cash_received; ?>
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
							<label for="id" class="control-label title-panel col-md-6">Petty Cash Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["pettycash_balance"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">From Name :</label> <span class="text-content"><?php echo (!empty($pettycashrequest_data) && $pettycashrequest_data->addedfrom != "") ? get_employee_fullname($pettycashrequest_data->addedfrom): '--'; ?></span>
						</div>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Wallet Amount :</label> <span class="text-content">&#8377; <?php echo (!empty($pettycashrequest_data) && $pettycashrequest_data->addedfrom != "") ? wallet_amount($pettycashrequest_data->addedfrom,'','') : '0.00'; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Category :</label> <span class="text-content"><?php echo 'Petty Cash Manager'; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Reason :</label> <span class="col-md-6"><?php echo cc($request_info["reason"]); ?></span>
						</div>

						<div class="btn-bottom-toolbar text-right">
							<?php if ($request_info["approved_status"] == 0){ ?>
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
				<?php if ($request_info["approved_status"] == 0){ ?>
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin"><?php echo 'Request Action'; ?></h4>
							<hr class="hr-panel-heading" />
							<div class="clearfix mtop15"></div>
							<div class="row">
								<div class="col-md-12">
									<div class="col-md-3">
										<div class="form-group">
											<label for="approve_status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
											<select class="form-control selectpicker" id="approve_status" name="approve_status" required="">
												<option value=""></option>
												<option value="1">Approved</option>
												<option value="2">Reject</option>
											</select>
										</div>
									</div>
									<div class="col-md-3 amount_div">
										<div class="form-group">
											<label for="approved_amount" class="control-label"><?php echo 'Approved Amount'; ?></label>
											<input id="approved_amount" min="0" step="any" required name="approved_amount" class="form-control" value="" type="number">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="remark" required class="control-label"><?php echo 'Remark'; ?></label>
											<textarea id="remark" name="remark" class="form-control" rows="3"></textarea>
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
	var request_amount = '<?php echo $request_info["request_amount"]; ?>';
	$(document).on("change", "#approve_status", function(){
		var status_val = $(this).val();
		$("#approved_amount").val("");
		if (status_val == 1){
			$("#approved_amount").val(request_amount);
		}
	});											

</script> 
</body>
</html>


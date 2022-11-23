
<?php init_head(); ?>
<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
	.text-content{
		margin-left: 12px;
	}
	@media (max-width: 500px){
		.btn-bottom-toolbar {
			width: 100%
		}
	}    
	@media (max-width: 768px){
		.btn-bottom-toolbar {
			width: 100%
		}
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
								$number = "--";
								if ($request_info["category_id"] == 1){
									$number = "REQ-SAL-".number_series($request_info["id"]);
								}else if ($request_info["category_id"] == 2){
									$number = "REQ-ADV-".number_series($request_info["id"]);
								}else if ($request_info["category_id"] == 3){
									$number = "REQ-LOA-".number_series($request_info["id"]);
								}else if ($request_info["category_id"] == 4){
									$number = "REQ-TRA-".number_series($request_info["id"]);
								}
							?>
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
							<?php 
								$addedfrom_id = value_by_id_empty("tblpettycashrequest", $request_info["id"], "addedfrom");
								$from_name = (!empty($addedfrom_id)) ? get_employee_fullname($addedfrom_id) : '--';
								$wallet_amt = (!empty($addedfrom_id)) ? wallet_amount($addedfrom_id,'','') : '--';
							?>
							<label for="id" class="control-label title-panel col-md-6">From Name :</label> <span class="text-content"><?php echo $request_info["approved_by"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Pay To :</label> <span class="text-content"><?php echo $request_info["pay_to_staff"]; ?></span>
						</div>
						<?php if (!empty($request_info["on_behalf_name"])){ ?>
							<div class="col-md-12">
								<label for="id" class="control-label title-panel col-md-6">On Behalf Of :</label> <span class="text-content"><?php echo $request_info["on_behalf_name"]; ?></span>
							</div>
						<?php } ?>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Wallet Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["wallet_amount"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Pending Expense :</label> <span class="text-content">&#8377; <?php echo $request_info["expense_amt"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Advance Salary Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["advance_amt"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Loan Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["loan_amt"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Loan Tenure :</label> <span class="text-content"> <?php echo $request_info["tenure_name"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Category :</label> <span class="text-content"><?php echo get_request_category($request_info["category_id"]); ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Reason :</label> <span class="col-md-6" style="overflow-wrap: break-word;"><?php echo cc($request_info["reason"]); ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Description :</label> <span class="col-md-6" style="overflow-wrap: break-word;"><?php echo cc($request_info["description"]); ?></span>
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
											</select>
										</div>
									</div>
									<div class="col-md-3 amount_div">
										<div class="form-group">
											<label for="approved_amount" class="control-label"><?php echo 'Approved Amount'; ?></label>
											<input id="approved_amount" min="0" step="any" required name="approved_amount" class="form-control" value="" type="number" readonly="">
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="remark"  class="control-label"><?php echo 'Remark'; ?></label>
											<textarea id="remark" required name="remark" class="form-control" rows="3" ></textarea>
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
												<span><?php echo $staff["name"]; ?>&nbsp;<br><span class="text-danger">(<?php echo $staff["read_date"]; ?>)</span></span>
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


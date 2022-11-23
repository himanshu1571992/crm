
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
			<div class="col-md-6">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="no-margin"><?php echo $title; ?></h4>
						<hr class="hr-panel-heading" />
						<div class="col-md-12">
							<?php 
								$number = '--';
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
							<label for="id" class="control-label title-panel col-md-6">From Name :</label> <span class="text-content"><?php echo ($request_info["addedfrom"] != "") ? get_employee_fullname($request_info["addedfrom"]): '--'; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Transfer To :</label> <span class="text-content"><?php echo $request_info["transfer_to"]; ?></span>
						</div>
						<div class="col-md-12">
							<?php 
								$transfer_type = "--";
								if ($request_info["transfer_type"] == 1){
									$transfer_type = "Wallet To Wallet";
								}else if ($request_info["transfer_type"] == 2){
									$transfer_type = "Wallet To Petty Cash";
								}else if ($request_info["transfer_type"] == 3){
									$transfer_type = "Petty Cash To Petty Cash";
								}
							?>
							<label for="id" class="control-label title-panel col-md-6">Transfer Type :</label> <span class="text-content"><?php echo $transfer_type; ?></span>
						</div>
						<?php if (!empty($request_info["on_behalf_name"])){ ?>
							<div class="col-md-12">
								<label for="id" class="control-label title-panel col-md-6">On Behalf Of :</label> <span class="text-content text-danger"><?php echo $request_info["on_behalf_name"]; ?></span>
							</div>
							<div class="col-md-12">
								<label for="id" class="control-label title-panel col-md-6">Added By :</label> <span class="text-content text-danger"><?php echo $request_info["addedby_name"]; ?></span>
							</div>
						<?php } ?>
						<div class="col-md-12">
							<label for="wallet_amount" class="control-label title-panel col-md-6">Wallet Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["wallet_amount"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Pending Expense :</label> <span class="text-content">&#8377; <?php echo $request_info["expense_amt"]; ?></span>
						</div>
						<?php if ($request_info["category_id"] == 1){ ?>
							<div class="col-md-12">
								<label for="current_salary" class="control-label title-panel col-md-6">Current Salary :</label> <span class="text-content">&#8377; <?php echo $request_info["current_salary"]; ?></span>
							</div>
						<?php } ?>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Advance Salary Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["advance_amt"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">EMI Amount :</label> <span class="text-content">&#8377; <?php echo $request_info["loan_amt"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Loan Balance :</label> <span class="text-content">&#8377; <?php echo $request_info["loan_balance"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Loan Tenure :</label> <span class="text-content"><?php echo $request_info["tenure_name"]; ?></span>
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
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Request Route :</label> <span class="text-content"><?php echo $request_info["approved_via"]; ?></span>
						</div>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Route To :</label> <span class="text-content"><?php echo $request_info["petty_route_to"]; ?></span>
						</div>
						<?php if ($request_info["trip_no"] != "") { ?>
							<div class="col-md-12">
								<label for="id" class="control-label title-panel col-md-6">Trip No. :</label> <span class="text-content"><?php echo $request_info["trip_no"]; ?></span>
							</div>
						<?php } ?>
						<?php if ($request_info["approved_status"] == 0){ ?>
							<div class="btn-bottom-toolbar text-right">
								<button type="submit" class="btn btn-info"><?php echo 'Submit'; ?></button>
							</div>
						<?php } ?>
					</div>
				</div>
				<?php if (!empty($request_info["expense_arr"])){ ?>
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin">Linked Expenses</h4>
							<hr class="hr-panel-heading" />
							<div class="col-md-12">
								<div class="card" >
									<ul class="list-group list-group-flush">
										<?php 
											foreach ($request_info["expense_arr"] as $expense) {
										?>
												<li class="list-group-item">
													<label for="id" class="title-panel"><?php echo $expense["expense_no"]; ?> &nbsp;&nbsp;</label>
													<span class="pull-right">&#8377; <?php echo $expense["amount"]; ?></span>
												</li>
										<?php            
											}
										?>
									</ul>
								</div>	
							</div>	
						</div>	
					</div>
				<?php } ?>
				
			</div>
			<div class="col-md-6">
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
								}else if ($request_info["approved_status"] == 1 && $request_info["confirmed_by_user"] == 1){
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
						<?php
							if ($request_info["payment_status"] != 0){
								
								if ($request_info["payment_status"] == 1){
									$paymenttype = "Accepted";
								}else if ($request_info["payment_status"] == 2){
									$paymenttype = "Payment Done";
								}
						?>
								<div class="col-md-12">
									<label for="payment_type" class="control-label title-panel">Payment Type :</label> <span class="text-content"><?php echo $paymenttype; ?></span>
								</div>
						<?php		
							}
						?>		

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
												<label for="id" class="col-md-3 title-panel">Read By : </label>
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
			<?php if ($request_info["approved_status"] == 0){ ?>
				<div class="col-md-6">
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin"><?php echo 'Request Action'; ?></h4>
							<hr class="hr-panel-heading" />
							<div class="clearfix mtop15"></div>
							<div class="row">
								<div class="col-md-12">
									<?php
										if ($request_info["category_id"] == 3){
									?>	
										<div class="col-md-12">
											<div class="form-group">
												<label for="tenure" class="control-label"><?php echo 'Loan Tenure'; ?></label>
												<select class="form-control selectpicker" id="tenure_id" name="tenure_id">
													<option value="" disabled selected >--Select One-</option>
													<?php
													if(!empty($loan_tenues)){
														foreach($loan_tenues as $tenure){
															?>
															<option value="<?php echo $tenure['id'];?>" <?php echo (isset($request_info["tenure_id"]) && $request_info["tenure_id"] == $tenure['id']) ? 'selected' : "" ?>><?php echo $tenure['name']; ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>
									<?php
										}
									?>
									<div class="col-md-12">
										<div class="form-group">
											<label for="approve_status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
											<select class="form-control selectpicker" id="approve_status" name="approve_status" required="">
												<option value=""></option>
												<option value="1">Approved</option>
												<option value="2">Reject</option>
												<?php if ($request_info["category_id"] != 4){ ?>
													<option value="3">By Petty Cash</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="col-md-12 pay_mode_div">
										<div class="form-group">
											<label for="payment_type" class="control-label"><?php echo 'Payment Type'; ?></label>
											<select class="form-control selectpicker payment_type" id="payment_type" name="payment_type">
												<option value="" disabled selected >--Select One-</option>
												<option value="1">In Account</option>
												<option value="2">By Cash</option>
											</select>
										</div>
									</div>
									<div class="col-md-12 petty_cash_div">
										<div class="form-group">
											<label for="petty_cash" class="control-label">Petty Cash</label>
											<select class="form-control selectpicker petty_cash_id" id="petty_cash_id" name="petty_cash_id" >
												<option value="" disabled selected >--Select One-</option>
												<?php 
													if (!empty($pettycash_list)){
														foreach ($pettycash_list as $value) {
															$pettycashval = cc($value->department_name).' / '.get_employee_name($value->staff_id).' / '.$value->amount;
															echo '<option value="'.$value->id.'">'.$pettycashval.'</option>';
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-12 amount_div">
										<div class="form-group">
											<?php 
												$amountcls = "";
												if ($request_info["category_id"] == 4 || !empty($request_info["expense_arr"]) || $request_info["trip_id"] != "0"){
													$amountcls = "readonly=''";
												}
											?>
											<label for="approved_amount" class="control-label"><?php echo 'Approved Amount'; ?></label>
											<input id="approved_amount" min="0" step="any" required name="approved_amount" class="form-control approved_amount" value="" type="number" <?php echo $amountcls; ?>>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="remark"  class="control-label"><?php echo 'Remark'; ?></label>
											<textarea id="remark" required name="remark" class="form-control" rows="3"></textarea>
										</div>
									</div>
								</div>
							</div>									
						</div>
					</div>
				</div>
			<?php } ?>	
         <?php echo form_close(); ?>
      </div>
      <div class="btn-bottom-pusher"></div>
   </div>
</div>
<?php init_tail(); ?>
</body>
</html>
<script type="text/javascript">
	var category_id = '<?php echo $request_info["category_id"]; ?>';
	var request_amount = '<?php echo $request_info["request_amount"]; ?>';
	$(".petty_cash_div").hide();
	$(".pay_mode_div").hide();
	$(".payment_type").removeAttr("required", "");
	$(".petty_cash_id").removeAttr("required", "");
	$(document).on("change", "#approve_status", function(){
		var status_val = $(this).val();
		$("#approved_amount").val("");
		$(".amount_div").show();
		if (status_val == 2){
			$(".amount_div").hide();
		}
		$(".approved_amount").attr("required", "");
		if (status_val == 1){
			$("#approved_amount").val(request_amount);
			$(".pay_mode_div").show();
			$(".payment_type").attr("required", "");
		}else{
			$("#payment_type").val("");
			$('.selectpicker').selectpicker('refresh');
			$(".payment_type").removeAttr("required", "");
			$(".approved_amount").removeAttr("required", "");
			$(".pay_mode_div").hide();
		}
		if (status_val == 3){
			$("#approved_amount").val(request_amount);
			$(".petty_cash_div").show();
			$(".petty_cash_id").attr("required", "");
		}else{
			$(".petty_cash_id").removeAttr("required", "");
			$(".petty_cash_id").val("");
			$('.selectpicker').selectpicker('refresh');
			$(".petty_cash_div").hide();
		}
		
	});											

</script> 

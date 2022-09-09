<?php init_head(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<?php echo form_open($this->uri->uri_string(), array('id' => 'request_form', 'class' => 'proposal-form', 'onsubmit' => "return check_condition();")); ?>
				<div class="col-md-12">
					<div class="panel_s">
						<div class="panel-body">
							<h4 class="no-margin"><?php echo $title; ?></h4>
							<hr class="hr-panel-heading" />
							<div class="col-md-8">
								<div class="row">
									<div class="col-md-6" style="margin-bottom: -7px;">
										<div class="form-group">
											<label for="amount" class="control-label">Amount</label>
											<input id="amount" step="any" name="amount" class="form-control" type="number" required>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="loantenure" class="control-label">Payment Mode</label>
											<select class="form-control selectpicker" id="payment_mode" required="required" name="payment_mode" data-live-search="true">
												<option value=""></option>
												<?php 
													if (!empty($payment_mode_list)){
														foreach ($payment_mode_list as $value) {
												?>
															<option value="<?php echo $value->id; ?>"><?php echo cc($value->name); ?></option>
												<?php			
														}
													}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="reason" class="control-label">Reason</label>
											<input type="text" id="reason" name="reason" class="form-control">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="newlead_company" class="control-label"><?php echo 'Description'; ?></label>
											<textarea id="description" name="description" class="form-control" rows="7"></textarea>
										</div>
									</div>
								</div>
							</div>
							<div class="col-md-4">
								<div class="row">
									<div class="col-md-12">
										<div class="form-group">
											<label for="loantenure" class="control-label">Transfer To</label>
											<select class="form-control selectpicker" id="transfer_type" required="required" name="transfer_type" data-live-search="true">
												<option value=""></option>
												<option value="1">Transfer To Staff</option>
												<option value="2">Return To Company</option>
												<?php if ($pettycash_manager == 1){ ?>
													<option value="3">Transfer To Petty Cash</option>
												<?php } ?>
											</select>
										</div>
									</div>
									<div class="staff_div" style="display:none;">
										<div class="col-md-12">
											<div class="form-group">
												<label for="branch_id" class="control-label">Branch Name</label>
												<select class="form-control selectpicker branch_id" id="branch_id" name="branch_id" data-live-search="true">
													<option value=""></option>
													<?php 
														if (!empty($branch_list)){
															foreach ($branch_list as $value) {
													?>
																<option value="<?php echo $value->id; ?>"><?php echo cc($value->comp_branch_name); ?></option>
													<?php			
															}
														}
													?>
												</select>
											</div>
										</div>
										<div class="col-md-12">
											<div class="form-group">
												<label for="person_id" class="control-label">Person Name</label>
												<select class="form-control selectpicker person_id" id="person_id" name="person_id" data-live-search="true">
													<option value=""></option>
												</select>
											</div>
										</div>		
									</div>
									<div class="pattycash_div" style="display:none;">
										<div class="col-md-12">
											<div class="form-group">
												<label for="pettycash_id" class="control-label">Petty Cash Department</label>
												<select class="form-control selectpicker pettycash_id" id="pettycash_id" name="pettycash_id" data-live-search="true">
													<option value=""></option>
													<?php 
														if (!empty($pettycash_list)){
															foreach ($pettycash_list as $value) {
																$pettycash_name = cc($value->department_name).' / '.get_employee_name($value->staff_id).' / '.$value->amount;
													?>
																<option value="<?php echo $value->id; ?>"><?php echo $pettycash_name; ?></option>
													<?php			
															}
														}
													?>
												</select>
											</div>
										</div>		
									</div>
									<div class="col-md-12">
										<label for="approve_by" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
										<select onchange="staffdropdown()" required="required" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">
											<?php
												if (isset($allStaffdata) && count($allStaffdata) > 0) {
													foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
											?>
													<optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
														<option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
														<?php
															foreach ($Staffgroup_value['staffs'] as $singstaff) {
														?>
															<option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php echo (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) ? 'selected' : '';?>><?php echo $singstaff['firstname'] ?></option>
														<?php } ?>
													</optgroup>
											<?php   }
												}
											?>
										</select>
									</div>
								</div>
							</div>
							<div class="btn-bottom-toolbar text-right">
								<button type="submit" id="submit_request" class="btn btn-info">Submit</button>
							</div>
						</div>
					</div>	 
				</div>
			
			<?php echo form_close(); ?>
			<div class="btn-bottom-pusher"></div>
		</div>
	</div>

<?php init_tail(); ?>

</body>
</html> 
<script type="text/javascript">
	$('#branch_id').change(function(){

		var branch_id = $(this).val();
		if (branch_id != ''){
			$.ajax({
				type    : "POST",
				url     : "<?php echo base_url('admin/requests_new/get_branch_person'); ?>",
				data    : {'branch_id' : branch_id},
				success : function(response){
					if(response != ''){
						$("#person_id").html(response);
						$(".person_id").attr("required", "");
						$('.selectpicker').selectpicker('refresh');
					}
				}
			});
		}else{
			$(".person_id").removeAttr("required", "");
			$("#person_id").html("");
			$('.selectpicker').selectpicker('refresh');
		}
	});

	$('#transfer_type').change(function(){

		$(".branch_id").removeAttr("required", "");
		$(".pettycash_id").removeAttr("required", "");
		
		var type = $(this).val();
		if (type == '1'){
			$(".staff_div").show();
			$(".pattycash_div").hide();
			$(".branch_id").attr("required", "");
		}else{
			$(".staff_div").hide();
			$(".pattycash_div").show();
			$(".pettycash_id").attr("required", "");
		}
	});

	function staffdropdown()
    {
        $.each($("#assign option:selected"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().attr('selected', 'selected');
        });
        $('.selectpicker').selectpicker('refresh');
        $.each($("#assign option:not(:selected)"), function () {
            var select = $(this).val();
            $("optgroup." + select).children().removeAttr('selected');
        });
        $('.selectpicker').selectpicker('refresh');
    }

	function check_condition(){
		var amount = document.getElementById("amount").value;
		var wallet_amount = '<?php echo $wallet_amount; ?>';
		var condition = true;
		if (parseFloat(amount) > parseFloat(wallet_amount)){
			alert("Can't transfer amount greater then wallet amount."); 
            condition = false;
            return false;
		}
		if(condition){
            // condition =  confirm('Do you want to submit the form?');
            return true;
        }
	}
</script>
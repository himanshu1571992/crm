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
							<div class="col-md-12">
								<div class="row">
									<div class="col-md-3">
										<div class="form-group" id="category_id">
											<label for="bank_id" class="control-label">Bank <span style="color:red">*</span></label>
											<select class="form-control selectpicker" data-live-search="true" required="" id="bank_id" name="bank_id">
												<option value="" selected=" disabled ">--Select One--</option>
												<?php
												if (!empty($bank_list)) {
													foreach ($bank_list as $key => $value) {
														$selected = (!empty($entries_info) && $entries_info->bank_id == $value->id) ? 'selected' : "";
														?>                                               
														<option value="<?php echo $value->id; ?>" <?php echo $selected; ?>  ><?php echo cc($value->name); ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									<div class="col-md-3" style="margin-bottom: -7px;">
										<div class="form-group">
											<label for="date" class="control-label">Date <span style="color:red">*</span></label>
											<div class="input-group date">
                                                <input id="date" name="date" required='' class="form-control datepicker" value="<?php echo (!empty($entries_info)) ? _d($entries_info->date) : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group" id="category_id">
											<label for="bank_id" class="control-label">Type <span style="color:red">*</span></label>
											<select class="form-control selectpicker" data-live-search="true" required="" id="type" name="type">
												<option value="" selected=" disabled ">--Select One--</option>
												<option value="1" <?php echo (!empty($entries_info) && $entries_info->type == 1) ? 'selected' : ""; ?>>Debit</option>
												<option value="2" <?php echo (!empty($entries_info) && $entries_info->type == 2) ? 'selected' : ""; ?>>Credit</option>
											</select>
										</div>
									</div>
									<div class="col-md-3">
										<div class="form-group">
											<label for="utr_no" class="control-label">UTR No <span style="color:red">*</span></label>
											<?php echo $utr_no = (!empty($entries_info)) ? $entries_info->utr_no: ''; ?>
											<input id="text" name="utr_no" class="form-control" value="<?php echo $utr_no; ?>" required>
										</div>
									</div>
									
									<div class="col-md-3">
										<div class="form-group">
											<label for="amount" class="control-label">Amount <span style="color:red">*</span></label>
											<input type="number" id="amount" step="any" name="amount" class="form-control" value="<?php echo (!empty($entries_info)) ? $entries_info->amount : ''; ?>" required>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label for="remark" class="control-label"><?php echo 'Description'; ?></label>
											<?php $remark = (!empty($entries_info)) ? $entries_info->description: ''; ?>
											<textarea id="remark" name="remark" class="form-control" rows="7"><?php echo $remark; ?></textarea>
										</div>
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

<?php if(isset($vendor)){ ?>
<?php echo form_open($this->uri->uri_string(), array('id' => 'bankdetails-form', 'class' => 'bankdetails-form')); ?>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo _l('bank_details'); ?> </h4>
		<hr />
		<?php 
		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $bank_data= $this->db->get('tblvendorbank')->row();
		   $bank_data = (array) $bank_data;
		}?>
		<div class="col-md-6">
			<div class="form-group">
				<input type="hidden" id="bankdetails" name="bankdetails" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
				<label for="name" class="control-label"><?php echo _l('bank_name'); ?> *</label>
				<input type="text" id="name" name="name" class="form-control" required="" value="<?php echo (isset($bank_data['name']) && $bank_data['name'] != "") ? $bank_data['name'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="phone_no" class="control-label"><?php echo _l('bank_phone'); ?> *</label>
				<input type="text" id="phone_no" name="phone_no" class="form-control" required="" value="<?php echo (isset($bank_data['phone_no']) && $bank_data['phone_no'] != "") ? $bank_data['phone_no'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="account_no" class="control-label"><?php echo _l('bank_account_no'); ?> *</label>
				<input type="text" id="account_no" name="account_no" class="form-control" required="" value="<?php echo (isset($bank_data['account_no']) && $bank_data['account_no'] != "") ? $bank_data['account_no'] : "" ?>">
			</div>
			
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="branch" class="control-label"><?php echo _l('bank_branch'); ?> *</label>
				<input type="text" id="branch" name="branch" class="form-control" required="" value="<?php echo (isset($bank_data['branch']) && $bank_data['branch'] != "") ? $bank_data['branch'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="email_id" class="control-label"><?php echo _l('bank_mail'); ?> *</label>
				<input type="text" id="email_id" name="email_id" class="form-control" required="" value="<?php echo (isset($bank_data['email_id']) && $bank_data['email_id'] != "") ? $bank_data['email_id'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="ifsc_code" class="control-label"><?php echo _l('bank_ifsc_code'); ?> *</label>
				<input type="text" id="ifsc_code" name="ifsc_code" class="form-control" required="" value="<?php echo (isset($bank_data['ifsc_code']) && $bank_data['ifsc_code'] != "") ? $bank_data['ifsc_code'] : "" ?>">
			</div>
			
		</div>
		
		
	</div>
	<div class="text-right">
		<button class="btn btn-info save-and-add-contact customer-form-submiter save_bank">
				<?php echo _l('save_bank_details'); ?>
		</button>
	</div>
	</div>
	<?php echo form_close(); ?>
<?php } ?>

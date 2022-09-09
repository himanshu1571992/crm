<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo _l('bank'); ?> </h4>
		<hr />
		<?php 
                $list_paymenttypes = $this->db->query("SELECT * FROM `tblpaymenttypes` ORDER BY id ASC")->result();
		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $bank_data= $this->db->get('tblbankmaster')->row();
		   $bank_data = (array) $bank_data;
                   
                   
		}?>
		<div class="col-md-6">
			<div class="form-group">
				<?php if(isset($_GET['id']))?> <input type="hidden" id="bankid" name="bankid" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
				<label for="name" class="control-label"><?php echo _l('bank_name'); ?> *</label>
				<input type="text" id="name" name="bank[name]" class="form-control" required="" value="<?php echo (isset($bank_data['name']) && $bank_data['name'] != "") ? $bank_data['name'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="branch" class="control-label"><?php echo _l('bank_branch'); ?> *</label>
				<input type="text" id="branch" name="bank[branch]" class="form-control" required="" value="<?php echo (isset($bank_data['branch']) && $bank_data['branch'] != "") ? $bank_data['branch'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="account_no" class="control-label"><?php echo _l('bank_account_no'); ?> *</label>
				<input type="text" id="account_no" name="bank[account_no]" class="form-control" required="" value="<?php echo (isset($bank_data['account_no']) && $bank_data['account_no'] != "") ? $bank_data['account_no'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="phone_no" class="control-label"><?php echo _l('bank_phone'); ?> *</label>
				<input type="text" id="phone_no" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="10" maxlength="10" name="bank[phone_no]" class="form-control" required="" value="<?php echo (isset($bank_data['phone_no']) && $bank_data['phone_no'] != "") ? $bank_data['phone_no'] : "" ?>">
			</div>
			<?php if(isset($_GET['id']))
			{ ?>
             <div class="form-group">
				<label for="balance" class="control-label">status</label>
				<select name="bank[status]" class="form-control">
					<option <?php if(isset($bank_data['status']) && $bank_data['status']=="1") {?> selected="selected"<?php } ?> value="1">Active</option>
					<option <?php if(isset($bank_data['status']) && $bank_data['status']=="0") {?> selected="selected"<?php } ?> value="0">Inactive</option>
				</select>
			</div>
			<?php 
             }
            ?>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="bank_code" class="control-label">Bank Code *</label>
				<input type="text" id="bank_code" name="bank[bank_code]" class="form-control" required="" value="<?php echo (isset($bank_data['bank_code']) && $bank_data['bank_code'] != "") ? $bank_data['bank_code'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="ifsc_code" class="control-label"><?php echo _l('bank_ifsc_code'); ?> *</label>
				<input type="text" id="ifsc_code" name="bank[ifsc_code]" class="form-control" required="" value="<?php echo (isset($bank_data['ifsc_code']) && $bank_data['ifsc_code'] != "") ? $bank_data['ifsc_code'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="balance" class="control-label"><?php echo _l('bank_balance'); ?> *</label>
				<input type="text" id="balance" name="bank[balance]" class="form-control" required="" value="<?php echo (isset($bank_data['balance']) && $bank_data['balance'] != "") ? $bank_data['balance'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="paymenttype" class="control-label">Payment Types*</label>
				<select class="form-control selectpicker" required="" id="payment_type" name="bank[payment_type]"  data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($list_paymenttypes) && count($list_paymenttypes) > 0) {
						foreach ($list_paymenttypes as $payment_key => $payment_value) 
						{?>
							<option value="<?php echo $payment_value->id ?>" <?php echo (isset($bank_data['payment_type']) && $bank_data['payment_type'] == $payment_value->id) ? 'selected' : "" ?>><?php echo cc($payment_value->name); ?></option>
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

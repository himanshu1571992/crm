<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo _l('receipt'); ?> </h4>
		<hr />
		<?php 
		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $receipt_data= $this->db->get('tblreceiptmaster')->row();
		   $receipt_data = (array) $receipt_data;
		}?>
		<div class="col-md-6">
			<div class="form-group">
				<?php if(isset($_GET['id']))?> <input type="hidden" id="receiptid" name="receiptid" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
				<label for="name" class="control-label"><?php echo _l('receipt_name'); ?> *</label>
				<input type="text" id="name" name="receipt[name]" class="form-control" required="" value="<?php echo (isset($receipt_data['name']) && $receipt_data['name'] != "") ? $receipt_data['name'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="account_no" class="control-label"><?php echo _l('receipt_account_no'); ?> *</label>
				<input type="text" id="account_no" name="receipt[account_no]" class="form-control" required="" value="<?php echo (isset($receipt_data['account_no']) && $receipt_data['account_no'] != "") ? $receipt_data['account_no'] : "" ?>">
			</div>
			<?php if(isset($_GET['id']))
			{ ?>
             <div class="form-group">
				<label for="balance" class="control-label">status</label>
				<select name="receipt[status]" class="form-control">
					<option <?php if(isset($receipt_data['status']) && $receipt_data['status']=="1") {?> selected="selected"<?php } ?> value="1">Active</option>
					<option <?php if(isset($receipt_data['status']) && $receipt_data['status']=="0") {?> selected="selected"<?php } ?> value="0">Inactive</option>
				</select>
			</div>
			<?php 
             }
            ?>
		</div>
		<div class="col-md-6">
			<div class="form-group">
				<label for="bank_name" class="control-label"><?php echo _l('receipt_bank_name'); ?> *</label>
				<input type="text" id="bank_name" name="receipt[bank_name]" class="form-control" required="" value="<?php echo (isset($receipt_data['bank_name']) && $receipt_data['bank_name'] != "") ? $receipt_data['bank_name'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="ifsc_code" class="control-label"><?php echo _l('receipt_ifsc_code'); ?> *</label>
				<input type="text" id="ifsc_code" name="receipt[ifsc_code]" class="form-control" required="" value="<?php echo (isset($receipt_data['ifsc_code']) && $receipt_data['ifsc_code'] != "") ? $receipt_data['ifsc_code'] : "" ?>">
			</div>
			
		</div>
	</div>
		
	</div>
	
</div>

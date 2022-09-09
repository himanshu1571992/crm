<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo "Payment Type"; ?> </h4>
		<hr />
		<?php 
		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $paytype_data= $this->db->get('tblpaymenttypes')->row();
		   $paytype_data = (array) $paytype_data;
		}?>
		<div class="col-md-6">
			<div class="form-group">
				<?php if(isset($_GET['id']))?> <input type="hidden" id="paymenttypeid" name="paymenttypeid" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
				<label for="name" class="control-label"><?php echo "Name"; ?> *</label>
				<input type="text" id="name" name="paytype[name]" class="form-control" required="" value="<?php echo (isset($paytype_data['name']) && $paytype_data['name'] != "") ? $paytype_data['name'] : "" ?>">
			</div>
		</div>
	</div>
		
	</div>
	
</div>

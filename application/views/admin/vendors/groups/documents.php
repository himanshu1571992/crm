<?php if(isset($vendor)){ ?>
<?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo _l('document'); ?> </h4>
		<hr />
		<?php 
		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $doc_data= $this->db->get('tblvendordocument')->row();
		   $doc_data = (array) $doc_data;
		}?>
		<div class="col-md-12">
			<div class="form-group">
			<input type="hidden" id="documents" name="documents" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
				<label for="pancard" class="control-label"><?php echo _l('pan_card'); ?></label>
				<input type="file" id="pancard" name="pancard">
			</div>
			
			<?php
			if (isset($doc_data['pancard']) && $doc_data['pancard'] != "") {
				?>
				<div class="form-group proimg">
					<label class="control-label"></label>
					<img src="<?php echo base_url('uploads/document/pancard') . "/" . $doc_data['id'] . "/" . $doc_data['pancard'] ?>" style="width: 150px; height: 150px;">
					<a class="removeimg" value="<?php echo $doc_data['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>
				</div>
				<?php
			}
			?>
			
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="cancelcheque" class="control-label"><?php echo _l('cancel_cheque'); ?> *</label>
				<input type="file" id="cancelcheque" name="cancelcheque">
			</div>
			<?php
			if (isset($doc_data['cancel_cheque']) && $doc_data['cancel_cheque'] != "") {
				?>
				<div class="form-group proimg">
					<label class="control-label"></label>
					<img src="<?php echo base_url('uploads/document/cancel_cheque') . "/" . $doc_data['id'] . "/" . $doc_data['cancel_cheque'] ?>" style="width: 150px; height: 150px;">
					<a class="removeimg" value="<?php echo $doc_data['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>
				</div>
				<?php
			}
			?>
			
		</div>
		<div class="col-md-12">
			<div class="form-group">
				<label for="gstregdoc" class="control-label"><?php echo _l('gst_reg_doc'); ?> *</label>
				<input type="file" id="gstregdoc" name="gstregdoc">
			</div>
			<?php
			if (isset($doc_data['gst_reg_doc']) && $doc_data['gst_reg_doc'] != "") {
				?>
				<div class="form-group proimg">
					<label class="control-label"></label>
					<img src="<?php echo base_url('uploads/document/gst_doc') . "/" . $doc_data['id'] . "/" . $doc_data['gst_reg_doc'] ?>" style="width: 150px; height: 150px;">
					<a class="removeimg" value="<?php echo $doc_data['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>
				</div>
				<?php
			}
			?>
			
		</div>
		
		
	</div>
	<div class="text-right">
		<button class="btn btn-info save-and-add-contact customer-form-submiter save_bank">
				<?php echo _l('save_document'); ?>
		</button>
	</div>
	</div>
	<?php echo form_close(); ?>
<?php } ?>

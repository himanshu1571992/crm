<?php init_head(); ?>
<style>
    .title-panel {
        font-size: 15px;
        color:#03a9f4;
    }
	.text-content{
		margin-left: 12px;
	}
</style>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
   <div class="content">
      <div class="row">
        <?php //echo form_open_multipart($this->uri->uri_string(),array('id'=>'expense-form','class'=>'dropzone dropzone-manual')) ;?>
		 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'proposal-form')); ?>
         <div class="col-md-6">
            <div class="panel_s">
				<div class="panel-body">
					<h4 class="no-margin"><?php echo $title; ?></h4>
					<hr class="hr-panel-heading" />
					<div class="col-md-12">
						<?php 
							$number = "LEA-".number_series($request_info["id"]);
						?>	
						<label for="id" class="control-label title-panel col-md-6">Id :</label> <span class="text-content"><?php echo $number; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">Leave Type :</label> <span class="text-content"><?php echo $request_info["category_name"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">On Behalf Of :</label> <span class="text-content"><?php echo $request_info["on_behalf"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">Added By :</label> <span class="text-content"><?php echo $request_info["added_by"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">From Date :</label> <span class="text-content"><?php echo $request_info["from_date"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">To Date :</label> <span class="text-content"><?php echo $request_info["to_date"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">Reason :</label> <span class="text-content"><?php echo $request_info["reason"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="id" class="control-label title-panel col-md-6">Total Days :</label> <span class="text-content"><?php echo $request_info["total_days"]; ?></span>
					</div>
					<?php if(!empty($request->leave_file)){ ?>
						<div class="col-md-12">
							<label for="id" class="control-label title-panel col-md-6">Attachment :</label> 
							<span class="text-content">
								<?php echo '<a download href="'.base_url('uploads/leaves_request/'.$request->leave_file).'">Download Attachment File <i class="fa fa-download" aria-hidden="true"></i></a>';?>
							</span>
						</div>
					<?php } ?>
					<?php if ($request_info["approved_status"] == 0){ ?>
						<div class="btn-bottom-toolbar text-right">
							<button type="submit" class="btn btn-info"><?php echo 'Submit'; ?></button>
						</div>
					<?php } ?>
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
         <div class="col-md-6">
			<div class="panel_s">
				<div class="panel-body">
					<?php if ($request_info["approved_status"] > 0){ ?>
						<div class="col-md-12">
							<label for="Status" class="title-panel">Status :</label> <span <?php echo ($request_info["approved_status"] == '1') ? 'class="label label-success"': 'class="label label-danger"'; ?>><?php echo ($request_info["approved_status"] == '1') ? 'Approved': 'Rejected'; ?></span>
						</div>
					<?php } ?>
					<div class="col-md-12">
						<label for="approved_by" class="control-label title-panel">Approved / Rejected By :</label> <span class="text-content"><?php echo $request_info["approved_by"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="approved_date" class="control-label title-panel">Approved / Rejected Date :</label> <span class="text-content"><?php echo $request_info["approved_date"]; ?></span>
					</div>
					<div class="col-md-12">
						<label for="approved_remark" class="control-label title-panel">Approved / Rejected Remark :</label> <span class="text-content"><?php echo $request_info["approved_remark"]; ?></span>
					</div>
				</div>	
			</div>
            <div class="panel_s">
                <div class="panel-body">
                  	<h4 class="no-margin"><?php echo 'Leave Action'; ?></h4>
                  	<hr class="hr-panel-heading" />
                  	<div class="clearfix mtop15"></div>
					<div class="col-md-12">
						<div class="form-group">
							<label for="approve_status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
							<select class="form-control selectpicker" name="approve_status" required="">
								<option value=""></option>
								<option value="1" <?php echo (isset($request_info["approved_status"]) && $request_info["approved_status"] == 1) ? 'selected' : "" ?>>Approved</option>
								<option value="2" <?php echo (isset($request_info["approved_status"]) && $request_info["approved_status"] == 2) ? 'selected' : "" ?>>Reject</option>
							</select>
						</div>
						<div class="form-group">
							<label for="remark" required class="control-label"><?php echo 'Remark'; ?></label>
							<textarea id="remark" name="remark" class="form-control" rows="3"><?php if(!empty($request_info["approved_remark"])){ echo $request_info["approved_remark"]; }?></textarea>
						</div>
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

</body>
</html>




<script type="text/javascript">
$( document ).ready(function() {
	var category = $('#category').val();
			  if(category == 3){
					$('#loan_div').show(); 
					$('#reason_div').hide(); 				 
					$('#paymet_mode_div').hide();
					$('#transfer_action').hide(); 
					$('#other_action').show();
				 
			 }else if(category == 4){
					$('#loan_div').hide(); 
					$('#reason_div').hide();				 
					$('#paymet_mode_div').show();
					$('#transfer_action').show(); 
					$('#other_action').hide();
			 }else{
					$('#loan_div').hide(); 
					$('#reason_div').show(); 				 
					$('#paymet_mode_div').hide();
					$('#transfer_action').hide(); 
					$('#other_action').show(); 
			 }
			 
			 
		});
</script> 

<script type="text/javascript">
$('#for_self').click(function(){
if($("#for_self").is(':checked'))
    $("#employee_div").hide();  // checked
else
    $("#employee_div").show();  // unchecked

});	
</script> 
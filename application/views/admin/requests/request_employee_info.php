<?php init_head(); ?>
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
                    <?php
					$designation_info = $this->home_model->get_row('tbldesignation', array('id'=>$user_info->designation_id), '');
					
					$state_info = $this->home_model->get_row('tblstates', array('id'=>$user_info->permenent_state), '');
					$city_info = $this->home_model->get_row('tblcities', array('id'=>$user_info->permenent_city), '');
					
					//getting branch
					$branch_name = '';
					$branch_id = explode(',',$user_info->branch_id);
					if(!empty($branch_id)){
						foreach($branch_id as $b_id){
							$bran_info = $this->home_model->get_row('tblcompanybranch', array('id'=>$b_id), '');
							if(!empty($bran_info)){
								$branch_name .= $bran_info->comp_branch_name.' ,';
							}
						}
					}
					
					$branch_name = rtrim($branch_name,",");
					?>    
						
					<div class="form-group">
						<label class="control-label"><?php echo 'Employee Name'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php echo $user_info->firstname; ?>">
					</div>
					
					
					<div class="form-group">
						<label class="control-label"><?php echo 'Branch Name'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php echo $branch_name; ?>">
					</div>
					
					
					<div class="form-group">
						<label class="control-label"><?php echo 'Designation'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php if(!empty($designation_info)){ echo $designation_info->designation; } ?>">
					</div>
					
					<div class="form-group">
						<label class="control-label"><?php echo 'Email'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php echo $user_info->email; ?>">
					</div>
					
					
					<div class="form-group">
						<label class="control-label"><?php echo 'Contact No'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php echo $user_info->firstname; ?>">
					</div>
					
					<div class="form-group">
						<label class="control-label"><?php echo 'Pan Card No'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php echo $user_info->pan_card_no; ?>">
					</div>
					
					<div class="form-group">
						<label class="control-label"><?php echo 'Adhaar Card No'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php echo $user_info->adhar_no; ?>">
					</div>
					
				
                  
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
                  <h4 class="no-margin"><?php echo 'Address Details'; ?></h4>
                  <hr class="hr-panel-heading" />
                 
                 
                  <div class="clearfix mtop15"></div>
                  <div class="row">
                   
					
					<div class="form-group">
						<label for="remark" required class="control-label"><?php echo 'Permenant Address'; ?></label>
							<textarea class="form-control" disabled rows="2"><?php if(!empty($user_info)){ echo $user_info->permenent_address; }?></textarea>
					 </div>
					
					 <div class="form-group">
						<label for="remark" required class="control-label"><?php echo 'Residential Address'; ?></label>
							<textarea class="form-control" disabled rows="2"><?php if(!empty($user_info)){ echo $user_info->residential_address; }?></textarea>
					 </div>
					 
					 <div class="form-group">
						<label class="control-label"><?php echo 'State'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php if(!empty($state_info)){ echo $state_info->name; }  ?>">
					</div>
					
					<div class="form-group">
						<label class="control-label"><?php echo 'City'; ?></label>
						<input type="text"  class="form-control" disabled value="<?php if(!empty($city_info)){ echo $city_info->name; }  ?>">
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
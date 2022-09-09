<?php init_head();
$settings = $this->expenses_model->get_settings(1);
$day = $settings->last_expense_date_limit;
?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&libraries=places&key=AIzaSyCN_pDdu4H40ws0JZ1H6iH6WN41IdAVKCE"></script>
<div id="wrapper">
   <div class="content">
      <div class="row">
         <?php
            if(isset($expense)){
             echo form_hidden('is_edit','true');
            }
            ?>
         <?php echo form_open_multipart($this->uri->uri_string(),array('id'=>'expense-form','class'=>'dropzone dropzone-manual')) ;?>
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
                  <?php
                    if(isset($expense) && $expense->recurring_from != NULL){
                      $recurring_expense = $this->expenses_model->get($expense->recurring_from);
                      echo '<div class="alert alert-info">'._l('expense_recurring_from','<a href="'.admin_url('expenses/list_expenses/'.$expense->recurring_from).'" target="_blank">'.$recurring_expense->category_name.(!empty($recurring_expense->expense_name) ? ' ('.$recurring_expense->expense_name.')' : '').'</a></div>');
                    }
                  ?>
                  <h4 class="no-margin"><?php echo $title; ?></h4>
                  <hr class="hr-panel-heading" />
                  <?php if(isset($expense) && $expense->attachment !== ''){ ?>
                  <div class="row">
                     <div class="col-md-10">
                        <i class="<?php echo get_mime_class($expense->filetype); ?>"></i> <a href="<?php echo site_url('download/file/expense/'.$expense->expenseid); ?>"><?php echo $expense->attachment; ?></a>
                     </div>
                     <?php if($expense->attachment_added_from == get_staff_user_id() || is_admin()){ ?>
                     <div class="col-md-2 text-right">
                        <a href="<?php echo admin_url('expenses/delete_expense_attachment/'.$expense->expenseid); ?>" class="text-danger _delete"><i class="fa fa fa-times"></i></a>
                     </div>
                     <?php } ?>
                  </div>
                  <?php } ?>
                  <?php if(!isset($expense) || (isset($expense) && $expense->attachment == '')){ ?>
				  
				 <?php
				 if(is_admin() == 1){
				 $employees = get_branch_employees();
				 ?>
				 
					<div class="form-group">
					<label for="addedfrom" class="control-label">For Self</label> 
						<input type="checkbox" id="for_self" class="form-control" style="display: inline-block; width: auto; height: auto; margin-left:15px;">
					</div>
				 
				   <div class="form-group" id="employee_div">
						<label for="addedfrom" class="control-label"><?php echo _l('expenses_employee'); ?> *</label>
						<select class="form-control selectpicker" id="addedfrom" name="addedfrom">
							<option value="" disabled selected >--Select One-</option>
							<?php
							if(!empty($employees)){
								foreach($employees as $employee){
									?>
									<option value="<?php echo $employee->staffid;?>" <?php echo (isset($expense->addedfrom) && $expense->addedfrom ==$employee->staffid) ? 'selected' : "" ?>><?php echo $employee->firstname; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					
					<input type="hidden" value="1" name="by_admin">
				<?php
				}
				?>


				  <div class="form-group">
						<label for="category" class="control-label"><?php echo _l('expense_category'); ?> *</label>
						<select class="form-control selectpicker" id="category" name="category" required="">
							<option value="" disabled selected >--Select One-</option>
							<?php
							if(!empty($categories)){
								foreach($categories as $category){
									?>
									<option value="<?php echo $category['id'];?>" <?php echo (isset($expense->category) && $expense->category == $category['id']) ? 'selected' : "" ?>><?php echo $category['name']; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					
					
					
				   
				   <div class="form-group">
						<label for="related_to" class="control-label"><?php echo _l('expenses_related'); ?> *</label>
						<select class="form-control selectpicker" id="related_to" name="related_to" required="">
							<option value="" disabled selected >--Select One-</option>
							<option value="1" <?php echo (isset($expense->related_to) && $expense->related_to == 1) ? 'selected' : "" ?>>Customers</option>
							<option value="2" <?php echo (isset($expense->related_to) && $expense->related_to == 2) ? 'selected' : "" ?>>Leads</option>
							<option value="3" <?php echo (isset($expense->related_to) && $expense->related_to == 3) ? 'selected' : "" ?>>New Leads</option>
							<option value="4" <?php echo (isset($expense->related_to) && $expense->related_to == 4) ? 'selected' : "" ?>>Others</option>
						</select>
					</div>
					
					
					<div id="customer_div" hidden>
					   <div class="form-group select-placeholder">
						 <label for="clientid" class="control-label"><?php echo _l('expense_add_edit_customer'); ?></label>
						 <select id="clientid" name="clientid" data-live-search="true" data-width="100%" class="ajax-search" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
						 <?php /*$selected = (isset($expense) ? $expense->clientid : '');
							if($selected == ''){
							  $selected = (isset($customer_id) ? $customer_id: '');
							}
							if($selected != ''){
							 $rel_data = get_relation_data('customer',$selected);
							 $rel_val = get_relation_values($rel_data,'customer');
							 echo '<option value="'.$rel_val['id'].'" selected>'.$rel_val['name'].'</option>';
							}*/?>
						 </select>
					  </div>
				  </div>
				  
				  <div id="lead_div" hidden>
					   <div class="form-group select-placeholder">
						 <label for="leadid" class="control-label"><?php echo _l('expense_lead'); ?></label>
						 <select id="clientid" name="leadid" data-live-search="true" data-width="100%" class="ajax-search" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
						 <?php /*$selected = (isset($expense) ? $expense->clientid : '');
							if($selected == ''){
							  $selected = (isset($customer_id) ? $customer_id: '');
							}
							if($selected != ''){
							 $rel_data = get_relation_data('customer',$selected);
							 $rel_val = get_relation_values($rel_data,'customer');
							 echo '<option value="'.$rel_val['id'].'" selected>'.$rel_val['name'].'</option>';
							} */ ?>
						 </select>
					  </div>
				  </div>
				  
				  <div id="newlead_div" hidden>
					  
					   <div class="form-group">
							<label for="newlead_company" class="control-label"><?php echo _l('newlead_company'); ?></label>
							<input type="text" id="newlead_company" name="newlead_company" class="form-control" value="<?php echo (isset($expense->newlead_company) && $expense->newlead_company != "") ? $expense->newlead_company : "" ?>">
						</div>
						
						 <div class="form-group">
							<label for="newlead_name" class="control-label"><?php echo _l('newlead_name'); ?></label>
							<input type="text" id="newlead_name" name="newlead_name" class="form-control" value="<?php echo (isset($expense->newlead_name) && $expense->newlead_name != "") ? $expense->newlead_name : "" ?>">
						</div>
					
					 <div class="form-group">
						<label for="newlead_mobile" class="control-label"><?php echo _l('newlead_mobile'); ?></label>
						<input type="text" id="newlead_mobile" name="newlead_mobile" class="form-control" value="<?php echo (isset($expense->newlead_mobile) && $expense->newlead_mobile != "") ? $expense->newlead_mobile : "" ?>">
					</div>
					
					 <div class="form-group">
						<label for="newlead_email" class="control-label"><?php echo _l('newlead_email'); ?></label>
						<input type="text" id="newlead_email" name="newlead_email" class="form-control" value="<?php echo (isset($expense->newlead_email) && $expense->newlead_email != "") ? $expense->newlead_email : "" ?>">
					</div>
					  
				  </div>
				  
				  <div id="other_div" hidden>
				  
					  <div class="form-group">
						<label for="expense_other" class="control-label"><?php echo _l('expense_other'); ?></label>
						<input type="text" id="expense_other" name="expense_other" class="form-control" value="<?php echo (isset($expense->expense_other) && $expense->expense_other != "") ? $expense->expense_other : "" ?>">
					</div>
					
				  </div>
				  
				  <div class="form-group">
						<label for="purpose" class="control-label"><?php echo _l('expenses_purpose'); ?> *</label>
						<select class="form-control selectpicker" id="purpose" name="purpose" required="">
							<option value="" disabled selected >--Select One-</option>
							<?php
							if(!empty($purpose_list)){
								foreach($purpose_list as $purpose){
									?>
									<option value="<?php echo $purpose['id'];?>" <?php echo (isset($expense->purpose) && $expense->purpose == $purpose['id']) ? 'selected' : "" ?>><?php echo $purpose['name']; ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
					
					 <div class="form-group" id="purpose_div">
						<label for="other_purpose" class="control-label"><?php echo _l('expenses_other_purpose'); ?></label>
						<input type="text" id="other_purpose" name="other_purpose" class="form-control" value="<?php echo (isset($expense->other_purpose) && $expense->other_purpose != "") ? $expense->other_purpose : "" ?>">
					</div>
					
					
				   <div id="travel_div" hidden>
				   
				   
						<div class="form-group">
							<label for="form_destination" class="control-label"><?php echo _l('form_destination'); ?></label>
							<input type="text" id="form_destination" name="form_destination" class="form-control location" value="<?php echo (isset($expense->form_destination) && $expense->form_destination != "") ? $expense->form_destination : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="to_destination" class="control-label"><?php echo _l('to_destination'); ?></label>
							<input type="text" id="to_destination" name="to_destination" class="form-control location" value="<?php echo (isset($expense->to_destination) && $expense->to_destination != "") ? $expense->to_destination : "" ?>">
						</div>
						
						 <div class="form-group">
							<label for="travel_mode" class="control-label"><?php echo _l('travel_mode'); ?> </label>
							<select class="form-control selectpicker" id="travel_mode" name="travel_mode" >
								<option value="" disabled selected >--Select Travel Mode-</option>
								<?php
								if(!empty($travel_mode)){
									foreach($travel_mode as $row){
										?>
										<option value="<?php echo $row['id'];?>" <?php echo (isset($expense->travel_mode) && $expense->category == $row['id']) ? 'selected' : "" ?>><?php echo $row['name']; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="kilometer_limit" class="control-label"><?php echo _l('kilometer_limit'); ?></label> <button type="button" class="btn btn-info get_travel_distance">Get Distance</button>
							<input type="text" id="kilometer_limit" name="kilometer_limit" class="form-control" value="<?php echo (isset($expense->kilometer_limit) && $expense->kilometer_limit != "") ? $expense->kilometer_limit : "" ?>">
						</div>	
				   			   
						
				   </div>
				   
				   
				   <div id="tempo_div" hidden>
				   
						<?php
						/*
						<div class="form-group">
							<label for="tempo_name" class="control-label"><?php echo _l('tempo_name'); ?></label>
							<input type="text" id="tempo_name" name="tempo_name" class="form-control" value="<?php echo (isset($expense->tempo_name) && $expense->tempo_name != "") ? $expense->tempo_name : "" ?>">
						</div>
						*/
						?>
						
						<div class="form-group">
							<label for="tempo_name" class="control-label"><?php echo _l('tempo_name'); ?> </label>
							<select class="form-control selectpicker" id="tempo_name" name="tempo_name" >
								<option value="" disabled selected >--Select Temp Name-</option>
								<?php
								if(!empty($tempo_info)){
									foreach($tempo_info as $row){
										?>
										<option value="<?php echo $row->name; ?>" <?php echo (isset($expense->tempo_name) && $expense->tempo_name == $row->name) ? 'selected' : "" ?>><?php echo $row->name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						<div class="form-group">
							<label for="tempo_number" class="control-label"><?php echo _l('tempo_number'); ?></label>
							<input type="text" id="tempo_number" name="tempo_number" class="form-control" value="<?php echo (isset($expense->tempo_number) && $expense->tempo_number != "") ? $expense->tempo_number : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="tempo_driver_name" class="control-label"><?php echo _l('tempo_driver_name'); ?></label>
							<input type="text" id="tempo_driver_name" name="tempo_driver_name" class="form-control" value="<?php echo (isset($expense->tempo_driver_name) && $expense->tempo_driver_name != "") ? $expense->tempo_driver_name : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="tempo_driver_number" class="control-label"><?php echo _l('tempo_driver_number'); ?></label>
							<input type="text" id="tempo_driver_number" name="tempo_driver_number" class="form-control" value="<?php echo (isset($expense->tempo_driver_number) && $expense->tempo_driver_number != "") ? $expense->tempo_driver_number : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="tempo_owner" class="control-label"><?php echo _l('tempo_owner'); ?></label>
							<input type="text" id="tempo_owner" name="tempo_owner" class="form-control" value="<?php echo (isset($expense->tempo_owner) && $expense->tempo_owner != "") ? $expense->tempo_owner : "" ?>">
						</div>
						
				   
						<div class="form-group">
							<label for="trmpo_form_destination" class="control-label"><?php echo _l('form_destination'); ?></label>
							<input type="text" id="trmpo_form_destination" name="trmpo_form_destination" class="form-control location" value="<?php echo (isset($expense->trmpo_form_destination) && $expense->trmpo_form_destination != "") ? $expense->trmpo_form_destination : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="trmpo_to_destination" class="control-label"><?php echo _l('to_destination'); ?></label>
							<input type="text" id="trmpo_to_destination" name="trmpo_to_destination" class="form-control location" value="<?php echo (isset($expense->trmpo_to_destination) && $expense->trmpo_to_destination != "") ? $expense->trmpo_to_destination : "" ?>">
						</div>
					<?php
					/*	
					<div class="form-group">
						<label for="tempo_paid_by" class="control-label"><?php echo _l('paid_by'); ?> </label>
						<select class="form-control selectpicker" id="tempo_paid_by" name="tempo_paid_by" >
							<option value="" disabled selected >--Select Type-</option>
							<option value="1" <?php echo (isset($expense->tempo_paid_by) && $expense->tempo_paid_by == 1) ? 'selected' : "" ?>>Self</option>
							<option value="2" <?php echo (isset($expense->tempo_paid_by) && $expense->tempo_paid_by == 2) ? 'selected' : "" ?>>Employee</option>
							<option value="3" <?php echo (isset($expense->tempo_paid_by) && $expense->tempo_paid_by == 3) ? 'selected' : "" ?>>Others</option>
						</select>
					</div>
					*/
					?>
					
					<div class="form-group">
							<label for="tempo_bill_type" class="control-label">Bill Status</label>
							<select class="form-control selectpicker" id="tempo_bill_type" name="tempo_bill_type" >
								<option value="" disabled selected >--Select Type-</option>
								<option value="1" <?php echo (isset($expense->tempo_bill_type) && $expense->tempo_bill_type == 1) ? 'selected' : "" ?>>With Bill</option>
								<option value="2" <?php echo (isset($expense->tempo_bill_type) && $expense->tempo_bill_type == 2) ? 'selected' : "" ?>>Without Bill</option>
							</select>
						</div>
					
					<div class="form-group">
							<label for="tempo_paid_by" class="control-label"><?php echo _l('paid_by'); ?> </label>
							<select class="form-control selectpicker paid_by" id="tempo_paid_by" name="tempo_paid_by" >
								<option value="" disabled selected >--Select Type-</option>
								<?php
								if(!empty($paid_by)){
									foreach($paid_by as $row){
										?>
										<option value="<?php echo $row['id'];?>" <?php echo (isset($expense->tempo_paid_by) && $expense->tempo_paid_by == $row['id']) ? 'selected' : "" ?>><?php echo $row['name']; ?></option>
										<?php
									}
								}
								?>								
							</select>
						</div>
						
						
						
				   </div>
				   
				   <div id="eating_div" hidden>
				   
					   <div class="form-group">
							<label for="meal_type" class="control-label"><?php echo _l('meal_type'); ?> </label>
							<select class="form-control selectpicker" id="meal_type" name="meal_type" >
								<option value="" disabled selected >--Select Meal-</option>
								<option value="1" <?php echo (isset($expense->meal_type) && $expense->meal_type == 1) ? 'selected' : "" ?>>Breakfast</option>
								<option value="2" <?php echo (isset($expense->meal_type) && $expense->meal_type == 2) ? 'selected' : "" ?>>Lunch</option>
								<option value="3" <?php echo (isset($expense->meal_type) && $expense->meal_type == 3) ? 'selected' : "" ?>>Dinner</option>
                <option value="4" <?php echo (isset($expense->meal_type) && $expense->meal_type == 4) ? 'selected' : "" ?>>Breakfast + Lunch</option>
								<option value="5" <?php echo (isset($expense->meal_type) && $expense->meal_type == 5) ? 'selected' : "" ?>>Lunch + Dinner</option>
								<option value="6" <?php echo (isset($expense->meal_type) && $expense->meal_type == 6) ? 'selected' : "" ?>>Breakfast + Lunch + Dinner</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="pay_for_person" class="control-label"><?php echo _l('pay_for_person'); ?></label>
							<input type="text" id="pay_for_person" name="pay_for_person" class="form-control" value="<?php echo (isset($expense->pay_for_person) && $expense->pay_for_person != "") ? $expense->pay_for_person : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="food_bill_type" class="control-label">Bill Status</label>
							<select class="form-control selectpicker" id="food_bill_type" name="food_bill_type" >
								<option value="" disabled selected >--Select Type-</option>
								<option value="1" <?php echo (isset($expense->food_bill_type) && $expense->food_bill_type == 1) ? 'selected' : "" ?>>With Bill</option>
								<option value="2" <?php echo (isset($expense->food_bill_type) && $expense->food_bill_type == 2) ? 'selected' : "" ?>>Without Bill</option>
							</select>
						</div>
						
				   </div>
				   
				    <div id="hotel_div" hidden>
						<div class="form-group">
							<label for="hotel_name" class="control-label"><?php echo _l('hotel_name'); ?></label>
							<input type="text" id="hotel_name" name="hotel_name" class="form-control" value="<?php echo (isset($expense->hotel_name) && $expense->hotel_name != "") ? $expense->hotel_name : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="hotel_address" class="control-label"><?php echo _l('hotel_address'); ?></label>
							<input type="text" id="hotel_address" name="hotel_address" class="form-control" value="<?php echo (isset($expense->hotel_address) && $expense->hotel_address != "") ? $expense->hotel_address : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="hotel_no" class="control-label"><?php echo _l('hotel_no'); ?></label>
							<input type="text" id="hotel_no" name="hotel_no" class="form-control" value="<?php echo (isset($expense->hotel_no) && $expense->hotel_no != "") ? $expense->hotel_no : "" ?>">
						</div>
						
												
						<div class="form-group" app-field-wrapper="date">
						<label for="stay_from" class="control-label"><?php echo _l('stay_from'); ?></label>
							<div class="input-group date">
								<input id="stay_from" name="stay_from" class="form-control datetimepicker" value="<?php echo (isset($expense->stay_from) && $expense->stay_from != "") ? $expense->stay_from : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group" app-field-wrapper="date">
						<label for="stay_to" class="control-label"><?php echo _l('stay_to'); ?></label>
							<div class="input-group date">
								<input id="stay_to" name="stay_to" class="form-control datetimepicker" value="<?php echo (isset($expense->stay_to) && $expense->stay_to != "") ? $expense->stay_to : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
				   
						
						<div class="form-group">
							<label for="stay_day" class="control-label"><?php echo _l('stay_day'); ?> </label>
							<select class="form-control selectpicker" id="stay_day" name="stay_day" >
								<option value="" disabled selected >--Select Type-</option>
								<option value="1" <?php echo (isset($expense->stay_day) && $expense->stay_day == 1) ? 'selected' : "" ?>>Morning</option>
								<option value="2" <?php echo (isset($expense->stay_day) && $expense->stay_day == 2) ? 'selected' : "" ?>>Afternoon</option>
								<option value="3" <?php echo (isset($expense->stay_day) && $expense->stay_day == 3) ? 'selected' : "" ?>>Evening</option>
								<option value="4" <?php echo (isset($expense->stay_day) && $expense->stay_day == 4) ? 'selected' : "" ?>>Night</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="person_no" class="control-label"><?php echo _l('person_no'); ?></label>
							<input type="text" id="person_no" name="person_no" class="form-control" value="<?php echo (isset($expense->person_no) && $expense->person_no != "") ? $expense->person_no : "" ?>">
						</div>
						
						
						
						<div class="form-group" app-field-wrapper="date">
						<label for="pay_date" class="control-label"><?php echo _l('pay_date'); ?></label>
							<div class="input-group date">
								<input id="pay_date" name="pay_date" class="form-control datepicker" value="<?php echo (isset($expense->pay_date) && $expense->pay_date != "") ? $expense->pay_date : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group">
							<label for="hotel_bill_type" class="control-label">Bill Status</label>
							<select class="form-control selectpicker" id="hotel_bill_type" name="hotel_bill_type" >
								<option value="" disabled selected >--Select Type-</option>
								<option value="1" <?php echo (isset($expense->hotel_bill_type) && $expense->hotel_bill_type == 1) ? 'selected' : "" ?>>With Bill</option>
								<option value="2" <?php echo (isset($expense->hotel_bill_type) && $expense->hotel_bill_type == 2) ? 'selected' : "" ?>>Without Bill</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="hotel_paid_by" class="control-label"><?php echo _l('paid_by'); ?> </label>
							<select class="form-control selectpicker paid_by" id="hotel_paid_by" name="hotel_paid_by" >
								<option value="" disabled selected >--Select Type-</option>
								<?php
								if(!empty($paid_by)){
									foreach($paid_by as $row){
										?>
										<option value="<?php echo $row['id'];?>" <?php echo (isset($expense->hotel_paid_by) && $expense->hotel_paid_by == $row['id']) ? 'selected' : "" ?>><?php echo $row['name']; ?></option>
										<?php
									}
								}
								?>								
							</select>
						</div>
						
						
					</div>
				   
				   <div id="extra_div" hidden>
				   
						<div class="form-group">
							<label for="bill_type" class="control-label"><?php echo _l('bill_type'); ?> </label>
							<select class="form-control selectpicker" id="bill_type" name="bill_type">
								<option value="" disabled selected >--Select Type-</option>
								<?php
								if(!empty($bill_type)){
									foreach($bill_type as $row){
										?>
										<option value="<?php echo $row['id'];?>" <?php echo (isset($expense->bill_type) && $expense->bill_type == $row['id']) ? 'selected' : "" ?>><?php echo $row['name']; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						
						<div class="form-group">
							<label for="extra_bill_type" class="control-label">Bill Status</label>
							<select class="form-control selectpicker" id="extra_bill_type" name="extra_bill_type" >
								<option value="" disabled selected >--Select Type-</option>
								<option value="1" <?php echo (isset($expense->extra_bill_type) && $expense->extra_bill_type == 1) ? 'selected' : "" ?>>With Bill</option>
								<option value="2" <?php echo (isset($expense->extra_bill_type) && $expense->extra_bill_type == 2) ? 'selected' : "" ?>>Without Bill</option>
							</select>
						</div>
						
						<div class="form-group">
							<label for="extra_paid_by" class="control-label"><?php echo _l('paid_by'); ?> </label>
							<select class="form-control selectpicker paid_by" id="extra_paid_by" name="extra_paid_by" >
								<option value="" disabled selected >--Select Type-</option>
								<?php
								if(!empty($paid_by)){
									foreach($paid_by as $row){
										?>
										<option value="<?php echo $row['id'];?>" <?php echo (isset($expense->extra_paid_by) && $expense->extra_paid_by == $row['id']) ? 'selected' : "" ?>><?php echo $row['name']; ?></option>
										<?php
									}
								}
								?>								
							</select>
						</div>
						
						
					
				   </div>
				   
				   <div id="logistic_div" hidden>
				   
				   
				    
                  <?php $value = (isset($expense) ? $expense->expense_name : ''); ?>
                  <?php echo render_input('expense_name','Logistic Name',$value); ?>
						
						<?php
						/*
						<div class="form-group">
							<label for="booked_address" class="control-label"><?php echo _l('booked_address'); ?></label>
							<input type="text" id="booked_address" name="booked_address" class="form-control" value="<?php echo (isset($expense->booked_address) && $expense->booked_address != "") ? $expense->booked_address : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="contact_person_name" class="control-label"><?php echo _l('contact_person_name'); ?></label>
							<input type="text" id="contact_person_name" name="contact_person_name" class="form-control" value="<?php echo (isset($expense->contact_person_name) && $expense->contact_person_name != "") ? $expense->contact_person_name : "" ?>">
						</div>
						
						<div class="form-group">
							<label for="contact_mobile_no" class="control-label"><?php echo _l('contact_mobile_no'); ?></label>
							<input type="text" id="contact_mobile_no" name="contact_mobile_no" class="form-control" value="<?php echo (isset($expense->contact_mobile_no) && $expense->contact_mobile_no != "") ? $expense->contact_mobile_no : "" ?>">
						</div>
						*/
						?>
						
						<div class="form-group">
							<label for="logistic_paid_by" class="control-label"><?php echo _l('paid_by'); ?> </label>
							<select class="form-control selectpicker paid_by" id="logistic_paid_by" name="logistic_paid_by" >
								<option value="" disabled selected >--Select Type-</option>
								<?php
								if(!empty($paid_by)){
									foreach($paid_by as $row){
										?>
										<option value="<?php echo $row['id'];?>" <?php echo (isset($expense->logistic_paid_by) && $expense->logistic_paid_by == $row['id']) ? 'selected' : "" ?>><?php echo $row['name']; ?></option>
										<?php
									}
								}
								?>								
							</select>
						</div>
						
						
						<hr class="hr-panel-heading" />
						<label class="control-label"><b><?php echo 'LOGISTIC FROM'; ?></b></label>
						<hr class="hr-panel-heading" />
						
						
						<div class="row">
						<div class="form-group col-md-6">
							<label for="logistic_from_person_name" class="control-label"><?php echo _l('contact_person_name'); ?></label>
							<input type="text" id="logistic_from_person_name" name="logistic_from_person_name" class="form-control" value="<?php echo (isset($expense->logistic_from_person_name) && $expense->logistic_from_person_name != "") ? $expense->logistic_from_person_name : "" ?>">
						</div>
						
						<div class="form-group col-md-6">
							<label for="logistic_from_person_no" class="control-label"><?php echo 'Contact Person No.'; ?></label>
							<input type="text" id="logistic_from_person_no" name="logistic_from_person_no" class="form-control" value="<?php echo (isset($expense->logistic_from_person_no) && $expense->logistic_from_person_no != "") ? $expense->logistic_from_person_no : "" ?>">
						</div>
						
						<div class="form-group col-md-6">
							<label for="logistic_from_address" class="control-label"><?php echo 'Address'; ?></label>
							<input type="text" id="logistic_from_address" name="logistic_from_address" class="form-control location" value="<?php echo (isset($expense->logistic_from_address) && $expense->logistic_from_address != "") ? $expense->logistic_from_address : "" ?>">
						</div>
						
						<?php
						/*
						<div class="form-group col-md-6">
							<label for="logistic_from_state" class="control-label"><?php echo 'State'; ?></label>
							<input type="text" id="logistic_from_state" name="logistic_from_state" class="form-control" value="<?php echo (isset($expense->logistic_from_state) && $expense->logistic_from_state != "") ? $expense->logistic_from_state : "" ?>">
						</div>
						<div class="form-group col-md-6">
							<label for="logistic_from_city" class="control-label"><?php echo 'City'; ?></label>
							<input type="text" id="logistic_from_city" name="logistic_from_city" class="form-control" value="<?php echo (isset($expense->logistic_from_city) && $expense->logistic_from_city != "") ? $expense->logistic_from_city : "" ?>">
						</div>
						*/
						?>
						
						<div class="form-group col-md-6">
							<label for="logistic_from_state" class="control-label"><?php echo 'State'; ?> </label>
							<select class="form-control" id="logistic_from_state" name="logistic_from_state" >
								<option value="" disabled selected >--Select State-</option>
								<?php
								if(!empty($state_info)){
									foreach($state_info as $row){
										?>
										<option value="<?php echo $row->name;?>" <?php echo (isset($expense->logistic_from_state) && $expense->logistic_from_state == $row->name) ? 'selected' : "" ?>><?php echo $row->name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						<div class="form-group col-md-6">
							<label for="logistic_from_city" class="control-label"><?php echo 'City'; ?> </label>
							<select class="form-control" id="logistic_from_city" name="logistic_from_city" >
								<option value="" disabled selected >--Select City-</option>
								
							</select>
						</div>
						
						
						
						<div class="form-group col-md-6">
							<label for="logistic_from_pin" class="control-label"><?php echo 'Pin Code'; ?></label>
							<input type="text" id="logistic_from_pin" name="logistic_from_pin" class="form-control" value="<?php echo (isset($expense->logistic_from_pin) && $expense->logistic_from_pin != "") ? $expense->logistic_from_pin : "" ?>">
						</div>
						
						</div>
						
						
						
						
						
						<hr class="hr-panel-heading" />
						<label class="control-label"><b><?php echo 'LOGISTIC TO'; ?></b></label>
						<hr class="hr-panel-heading" />
						
						<div class="row">
						<div class="form-group col-md-6">
							<label for="logistic_to_person_name" class="control-label"><?php echo _l('contact_person_name'); ?></label>
							<input type="text" id="logistic_to_person_name" name="logistic_to_person_name" class="form-control" value="<?php echo (isset($expense->logistic_to_person_name) && $expense->logistic_to_person_name != "") ? $expense->logistic_to_person_name : "" ?>">
						</div>
						
						
						<div class="form-group col-md-6">
							<label for="logistic_to_person_no" class="control-label"><?php echo 'Contact Person No.'; ?></label>
							<input type="text" id="logistic_to_person_no" name="logistic_to_person_no" class="form-control" value="<?php echo (isset($expense->logistic_to_person_no) && $expense->logistic_to_person_no != "") ? $expense->logistic_to_person_no : "" ?>">
						</div>
						
						<div class="form-group col-md-6">
							<label for="logistic_to_address" class="control-label"><?php echo 'Address'; ?></label>
							<input type="text" id="logistic_to_address" name="logistic_to_address" class="form-control location" value="<?php echo (isset($expense->logistic_to_address) && $expense->logistic_to_address != "") ? $expense->logistic_to_address : "" ?>">
						</div>
						
						
						<?php
						/*
						<div class="form-group col-md-6">
							<label for="logistic_to_state" class="control-label"><?php echo 'State'; ?></label>
							<input type="text" id="logistic_to_state" name="logistic_to_state" class="form-control" value="<?php echo (isset($expense->logistic_to_state) && $expense->logistic_to_state != "") ? $expense->logistic_to_state : "" ?>">
						</div>
						
						<div class="form-group col-md-6">
							<label for="logistic_to_city" class="control-label"><?php echo 'City'; ?></label>
							<input type="text" id="logistic_to_city" name="logistic_to_city" class="form-control" value="<?php echo (isset($expense->logistic_to_city) && $expense->logistic_to_city != "") ? $expense->logistic_to_city : "" ?>">
						</div>
						*/
						?>
						
						
						<div class="form-group col-md-6">
							<label for="logistic_to_state" class="control-label"><?php echo 'State'; ?> </label>
							<select class="form-control" id="logistic_to_state" name="logistic_to_state" >
								<option value="" disabled selected >--Select State-</option>
								<?php
								if(!empty($state_info)){
									foreach($state_info as $row){
										?>
										<option value="<?php echo $row->name;?>" <?php echo (isset($expense->logistic_to_state) && $expense->logistic_to_state == $row->name) ? 'selected' : "" ?>><?php echo $row->name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						
						<div class="form-group col-md-6">
							<label for="logistic_to_city" class="control-label"><?php echo 'City'; ?> </label>
							<select class="form-control" id="logistic_to_city" name="logistic_to_city" >
								<option value="" disabled selected >--Select City-</option>
								
							</select>
						</div>
						
						<div class="form-group col-md-6">
							<label for="logistic_to_pin" class="control-label"><?php echo 'Pin Code'; ?></label>
							<input type="text" id="logistic_to_pin" name="logistic_to_pin" class="form-control" value="<?php echo (isset($expense->logistic_to_pin) && $expense->logistic_to_pin != "") ? $expense->logistic_to_pin : "" ?>">
						</div>
						
						</div>
						 
						
				   </div>
				   
				   <div id="paidby_div" hidden>
						 <div class="form-group">
							<label for="branch_id" class="control-label">Branch Name</label>
							<select class="form-control selectpicker" id="branch_id" name="branch_id" >
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($branch_info)){
									foreach($branch_info as $branch){
										?>
										<option value="<?php echo $branch->id;?>" <?php echo (isset($expense->branch_id) && $expense->branch_id == $branch->id) ? 'selected' : "" ?>><?php echo $branch->comp_branch_name; ?></option>
										<?php
									}
								}
								?>								
							</select>
						</div>	
						
						<div class="form-group">
							<label for="paidby_employee" class="control-label">Select Employee</label>
							<select class="form-control" id="paidby_employee" name="paidby_employee" >
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($paid_employee_info)){
									foreach($paid_employee_info as $branch){
										?>
										<option value="<?php echo $branch->id;?>" <?php echo (isset($expense->branch_id) && $expense->branch_id == $branch->id) ? 'selected' : "" ?>><?php echo $branch->comp_branch_name; ?></option>
										<?php
									}
								}
								?>								
							</select>
						</div>	
				   </div>
				  
				                     
                  <?php } ?>
                  <hr class="hr-panel-heading" />
                 
                 
                  <!-- Note Field -->
                  <i class="fa fa-question-circle pull-left" data-toggle="tooltip" data-title="<?php echo _l('expense_field_billable_help',_l('expense_add_edit_note')); ?>"></i>
                  <?php $value = (isset($expense) ? $expense->note : ''); ?>
                  <?php echo render_textarea('note','Remark',$value,array('rows'=>4),array()); ?>
                  
				  <button id="repeat_div" hidden name="repeat" value="1" type="submit" class="btn btn-info"><?php echo _l('expenses_repeat'); ?></button>
                  
                  <?php
				  /*
				  <div class="checkbox checkbox-primary billable <?php echo $hide_billable_options; ?>">
                     <input type="checkbox" id="billable" <?php if(isset($expense) && $expense->invoiceid !== NULL){echo 'disabled'; } ?> name="billable" <?php if(isset($expense)){if($expense->billable == 1){echo 'checked';}}; ?>>
                     <label for="billable" <?php if(isset($expense) && $expense->invoiceid !== NULL){echo 'data-toggle="tooltip" title="'._l('expense_already_invoiced').'"'; } ?>><?php echo _l('expense_add_edit_billable'); ?></label>
                  </div>
				  */
				  ?>
				  
				  				  
                  <?php $hide_project_selector = ' hide';
                     // Show selector only if expense is already added and there is no client linked to the expense or isset customer id
                     if((isset($expense) && $expense->clientid != 0) || isset($customer_id)){
                     $hide_project_selector = '';
                     }
                     ?>
                  <div class="form-group projects-wrapper<?php echo $hide_project_selector; ?>">
                     <label for="project_id"><?php echo _l('project'); ?></label>
                    <div id="project_ajax_search_wrapper">
                     <select name="project_id" id="project_id" class="projects ajax-search" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                      <?php if(isset($expense) && $expense->project_id != 0){
                        echo '<option value="'.$expense->project_id.'" selected>'.get_project_name_by_id($expense->project_id).'</option>';
                      }
                      ?>
                     </select>
                     </div>
                  </div>
                  <?php /*$rel_id = (isset($expense) ? $expense->expenseid : false); ?>
                  <?php echo render_custom_fields('expenses',$rel_id);*/ ?>
				  <div id="category_fields_div">
				 
				  </div>
                   <div class="btn-bottom-toolbar text-right">
					<button type="submit" class="btn btn-info"><?php echo _l('send_for_approval'); ?></button>
					
					
					
                  </div>
               </div>
            </div>
         </div>
         <div class="col-md-6">
            <div class="panel_s">
               <div class="panel-body">
                  <h4 class="no-margin"><?php echo _l('advanced_options'); ?></h4>
                  <hr class="hr-panel-heading" />
                  <?php
                     $s_attrs = array('disabled'=>true,'data-show-subtext'=>true);
                     $s_attrs = do_action('expense_currency_disabled',$s_attrs);
                     foreach($currencies as $currency){
                      if($currency['isdefault'] == 1){
                        $s_attrs['data-base'] = $currency['id'];
                      }
                      if(isset($expense)){
                        if($currency['id'] == $expense->currency){
                          $selected = $currency['id'];
                        }
                        if($expense->billable == 0){
                          if($expense->clientid != 0){
                            $c = $this->clients_model->get_customer_default_currency($expense->clientid);
                            if($c != 0){
                              $customer_currency = $c;
                            }
                          }
                        }
                      } else {
                        if(isset($customer_id)){
                          $c = $this->clients_model->get_customer_default_currency($customer_id);
                          if($c != 0){
                            $customer_currency = $c;
                          }
                        }
                        if($currency['isdefault'] == 1){
                          $selected = $currency['id'];
                        }
                      }
                     }
                     ?>
                
                 
                  <div class="clearfix mtop15"></div>
                  <div class="row">
                    
                     <div class="col-md-6">
                    <?php $value = (isset($expense) ? $expense->reference_no : ''); ?>
                    <?php echo render_input('reference_no','expense_add_edit_reference_no',$value); ?>
                     </div>
					 
					 <div class="col-md-6">
					  <?php $value = (isset($expense) ? _d($expense->date) : _d(date('Y-m-d')));
						$date_attrs = array();
						if(isset($expense) && $expense->recurring > 0 && $expense->last_recurring_date != null) {
						  $date_attrs['disabled'] = true;
						}
					   ?>
					  <?php echo render_input('date','expense_add_edit_date',$value,$date_attrs);
					  $value = (isset($expense) ? $expense->amount : ''); ?>
					</div>

					 
                  </div>
				
					<?php echo render_input('amount','expense_add_edit_amount',$value,'number');
                     $hide_billable_options = 'hide';

                     if((isset($expense) && ($expense->billable == 1 || $expense->clientid != 0)) || isset($customer_id)){
                          $hide_billable_options = '';
                     }
                     ?>
					 
					 <!-- file uploader -->
					 <div id="dropzoneDragArea" class="dz-default dz-message">
						 <span><?php echo _l('expense_add_edit_attach_receipt'); ?></span>
					  </div>
					  <div class="dropzone-previews"></div>
                
                  <div>
                    <?php
                      $hide_invoice_recurring_options = 'hide';
                      if(isset($expense) && $expense->billable == 1) {
                        $hide_invoice_recurring_options = '';
                      }
                    ?>
                     <div class="checkbox checkbox-primary billable_recurring_options <?php echo $hide_invoice_recurring_options; ?>">
                        <input type="checkbox" id="create_invoice_billable" name="create_invoice_billable" <?php if(isset($expense)){if($expense->create_invoice_billable == 1){echo 'checked';}}; ?>>
                        <label for="create_invoice_billable"><i class="fa fa-question-circle" data-toggle="tooltip" title="<?php echo _l('expense_recurring_autocreate_invoice_tooltip'); ?>"></i> <?php echo _l('expense_recurring_auto_create_invoice'); ?></label>
                     </div>
                  </div>
                  <div class="checkbox checkbox-primary billable_recurring_options <?php echo $hide_invoice_recurring_options; ?>">
                     <input type="checkbox" name="send_invoice_to_customer" id="send_invoice_to_customer" <?php if(isset($expense)){if($expense->send_invoice_to_customer == 1){echo 'checked';}}; ?>>
                     <label for="send_invoice_to_customer"><?php echo _l('expense_recurring_send_custom_on_renew'); ?></label>
                  </div>
               </div>
            </div>
         </div>
		 <input type="hidden" value="3" name="currency">		 
         <?php echo form_close(); ?>
      </div>
      <div class="btn-bottom-pusher"></div>
   </div>
</div>
<?php $this->load->view('admin/expenses/expense_category'); ?>
<?php init_tail(); ?>
<script>
   var customer_currency = '';
   Dropzone.options.expenseForm = false;
   var expenseDropzone;
   init_ajax_project_search_by_customer_id();
   var selectCurrency = $('select[name="currency"]');
   <?php if(isset($customer_currency)){ ?>
     var customer_currency = '<?php echo $customer_currency; ?>';
   <?php } ?>
     $(function(){

     if($('#dropzoneDragArea').length > 0){
        expenseDropzone = new Dropzone("#expense-form",  $.extend({},_dropzone_defaults(),{
          autoProcessQueue: false,
          clickable: '#dropzoneDragArea',
          previewsContainer: '.dropzone-previews',
          addRemoveLinks: true,
          maxFiles: 10,
          success:function(file,response){
           response = JSON.parse(response);
           if (this.getUploadingFiles().length === 0 && this.getQueuedFiles().length === 0) {
             window.location.assign(response.url);
           }
         },
       }));
     }

     _validate_form($('#expense-form'),{category:'required',date:'required',amount:'required',currency:'required'},expenseSubmitHandler);

     $('input[name="billable"]').on('change',function(){
       do_billable_checkbox();
     });

      $('#repeat_every').on('change',function(){
         if($(this).selectpicker('val') != '' && $('input[name="billable"]').prop('checked') == true){
            $('.billable_recurring_options').removeClass('hide');
          } else {
            $('.billable_recurring_options').addClass('hide');
          }
     });

     // hide invoice recurring options on page load
     $('#repeat_every').trigger('change');

      $('select[name="clientid"]').on('change',function(){
       customer_init();
       do_billable_checkbox();
       $('input[name="billable"]').trigger('change');
     });
    });
     function customer_init(){
        var customer_id = $('select[name="clientid"]').val();
        var projectAjax = $('select[name="project_id"]');
        var clonedProjectsAjaxSearchSelect = projectAjax.html('').clone();
        var projectsWrapper = $('.projects-wrapper');
        projectAjax.selectpicker('destroy').remove();
        projectAjax = clonedProjectsAjaxSearchSelect;
        $('#project_ajax_search_wrapper').append(clonedProjectsAjaxSearchSelect);
        init_ajax_project_search_by_customer_id();
        if(!customer_id){
           set_base_currency();
           projectsWrapper.addClass('hide');
         }
       $.get(admin_url + 'expenses/get_customer_change_data/'+customer_id,function(response){
         if(customer_id && response.customer_has_projects){
           projectsWrapper.removeClass('hide');
         } else {
           projectsWrapper.addClass('hide');
         }
         client_currency = parseInt(response.client_currency);
         if (client_currency != 0) {
           customer_currency = client_currency;
           do_billable_checkbox();
         } else {
           customer_currency = '';
           set_base_currency();
         }
       },'json');
     }
     function expenseSubmitHandler(form){

      selectCurrency.prop('disabled',false);

      $('select[name="tax2"]').prop('disabled',false);
      $('input[name="billable"]').prop('disabled',false);
      $('input[name="date"]').prop('disabled',false);

      $.post(form.action, $(form).serialize()).done(function(response) {
        response = JSON.parse(response);
        if (response.expenseid) {
         if(typeof(expenseDropzone) !== 'undefined'){
          if (expenseDropzone.getQueuedFiles().length > 0) {
            expenseDropzone.options.url = admin_url + 'expenses/add_expense_attachment/' + response.expenseid;
            expenseDropzone.processQueue();
          } else {
            window.location.assign(response.url);
          }
        } else {
          window.location.assign(response.url);
        }
      } else {
        window.location.assign(response.url);
      }
    });
      return false;
    }
    function do_billable_checkbox(){
      var val = $('select[name="clientid"]').val();
      if(val != ''){
        $('.billable').removeClass('hide');
        if ($('input[name="billable"]').prop('checked') == true) {
          if($('#repeat_every').selectpicker('val') != ''){
            $('.billable_recurring_options').removeClass('hide');
          } else {
            $('.billable_recurring_options').addClass('hide');
          }
          if(customer_currency != ''){
            selectCurrency.val(customer_currency);
            selectCurrency.selectpicker('refresh');
          } else {
           set_base_currency();
         }
       } else {
        $('.billable_recurring_options').addClass('hide');
        set_base_currency();
      }
    } else {
      set_base_currency();
      $('.billable').addClass('hide');
      $('.billable_recurring_options').addClass('hide');
    }
   }
   function set_base_currency(){
    selectCurrency.val(selectCurrency.data('base'));
    selectCurrency.selectpicker('refresh');
   }
</script>
</body>
</html>


<script type="text/javascript">
	$('#category').change(function(){
	var category_id = $(this).val();
	
	if(category_id == 1 || category_id == 2 || category_id == 5){
		 $('#repeat_div').show(); 
	}else{
		$('#repeat_div').hide(); 
	}
		 
		 if(category_id == 1){
			$('#travel_div').show(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 2){
			$('#travel_div').hide(); 
			$('#tempo_div').show(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 3){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').show(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
			
		 }else if(category_id == 4){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').show(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 6){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').show(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 5){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').show(); 
		 }
				 
		 $.ajax({
			type    : "POST",
			url     : "<?php echo site_url('admin/expenses/get_expenses_custom_fields'); ?>",
			data    : {'category_id' : category_id},
			success : function(response){
				if(response != ''){
					
					$("#category_fields_div").html(response);
				}else{
					$("#category_fields_div").html('');
				}
			}
		})
	});
</script> 


<script type="text/javascript">
	$('#related_to').change(function(){
	var related_id = $(this).val();
			 if(related_id == 1){
				 $('#customer_div').show(); 
				 $('#lead_div').hide(); 
				 $('#newlead_div').hide(); 
				 $('#other_div').hide(); 
			 }else if(related_id == 2){
				 $('#customer_div').hide(); 
				 $('#lead_div').show(); 
				 $('#newlead_div').hide(); 
				 $('#other_div').hide(); 
			 }else if(related_id == 3){
				  $('#customer_div').hide(); 
				 $('#lead_div').hide(); 
				 $('#newlead_div').show(); 
				 $('#other_div').hide(); 
			 }else if(related_id == 4){
				  $('#customer_div').hide(); 
				 $('#lead_div').hide(); 
				 $('#newlead_div').hide(); 
				 $('#other_div').show(); 
			 }
		});
</script> 


<script type="text/javascript">
$( document ).ready(function() {
	var related_id = $('#related_to').val();
			 if(related_id == 1){
				 $('#customer_div').show(); 
				 $('#lead_div').hide(); 
				 $('#newlead_div').hide(); 
				 $('#other_div').hide(); 
			 }else if(related_id == 2){
				 $('#customer_div').hide(); 
				 $('#lead_div').show(); 
				 $('#newlead_div').hide(); 
				 $('#other_div').hide(); 
			 }else if(related_id == 3){
				  $('#customer_div').hide(); 
				 $('#lead_div').hide(); 
				 $('#newlead_div').show(); 
				 $('#other_div').hide(); 
			 }else if(related_id == 4){
				  $('#customer_div').hide(); 
				 $('#lead_div').hide(); 
				 $('#newlead_div').hide(); 
				 $('#other_div').show(); 
			 }
		});
</script> 

<script type="text/javascript">
	$( document ).ready(function() {
	var category_id = $('#category').val();
	
	if(category_id == 1 || category_id == 2 || category_id == 5){
		 $('#repeat_div').show(); 
	}else{
		$('#repeat_div').hide(); 
	}
		 
		 if(category_id == 1){
			$('#travel_div').show(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 2){
			$('#travel_div').hide(); 
			$('#tempo_div').show(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 3){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').show(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
			
		 }else if(category_id == 4){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').show(); 
			$('#extra_div').hide(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 6){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').show(); 
			$('#logistic_div').hide(); 
		 }else if(category_id == 5){
			$('#travel_div').hide(); 
			$('#tempo_div').hide(); 
			$('#eating_div').hide(); 
			$('#hotel_div').hide(); 
			$('#extra_div').hide(); 
			$('#logistic_div').show(); 
		 }
				 
		 $.ajax({
			type    : "POST",
			url     : "<?php echo site_url('admin/expenses/get_expenses_custom_fields'); ?>",
			data    : {'category_id' : category_id},
			success : function(response){
				if(response != ''){
					
					$("#category_fields_div").html(response);
				}else{
					$("#category_fields_div").html('');
				}
			}
		})
	});
</script> 

 <script>
var inputs = document.getElementsByClassName('location');

var options = {
 // types: ['(cities)'],
  componentRestrictions: {country: 'In'}
};

var autocompletes = [];

for (var i = 0; i < inputs.length; i++) {
  var autocomplete = new google.maps.places.Autocomplete(inputs[i], options);
  autocomplete.inputId = inputs[i].id;
  autocomplete.addListener('place_changed', fillIn);
  autocompletes.push(autocomplete);
}

function fillIn() {
  console.log(this.inputId);
  var place = this.getPlace();
  console.log(place. address_components[0].long_name);
}
 </script>
 
 

<script type="text/javascript">
$('.get_travel_distance').click(function(){
var form_location = $('#form_destination').val();
var to_location = $('#to_destination').val();

	if(form_location != '' && to_location != ''){
		 $.ajax({
				type    : "POST",
				url     : "<?php echo site_url('admin/expenses/get_distance'); ?>",
				data    : {'form_location' : form_location,'to_location' : to_location},
				success : function(response){
					if(response != ''){
						
						$("#kilometer_limit").val(response);
					}
				}
			})
	}
});	
</script> 

 
 <script type="text/javascript">
	$('#purpose').change(function(){
	
	var purpose = $( "#purpose option:selected" ).text();
		 
		if(purpose == 'Other'){
			$('#purpose_div').show(); 
		}else{
			$('#purpose_div').hide(); 
		}
		
		
	});
	
	$( document ).ready(function() {
		var purpose = $( "#purpose option:selected" ).text();
		 
		if(purpose == 'Other'){
			$('#purpose_div').show(); 
		}else{
			$('#purpose_div').hide(); 
		}
	});	
</script>



<script type="text/javascript">
/*$('#date').change(function(){
var date = $(this).val();


		 $.ajax({
				type    : "POST",
				url     : "<?php echo site_url('admin/expenses/validate_date'); ?>",
				data    : {'date' : date},
				success : function(response){
					if(response != ''){
						alert(response);
						$('#date').val(''); 		
					}
				}
			})
	
});	
*/
</script> 

<script type="text/javascript">
$('#for_self').click(function(){
if($("#for_self").is(':checked'))
    $("#employee_div").hide();  // checked
else
    $("#employee_div").show();  // unchecked

});	
</script> 


<script type="text/javascript">
$('.paid_by').change(function(){
var paid_by = $(this).val();

	if(paid_by == 2){
		$("#paidby_div").show();  // checked
	}else{
		 $("#paidby_div").hide();  // unchecked
	}

		
});	
</script> 


<script type="text/javascript">
$('#branch_id').change(function(){
var branch_id = $(this).val();
	 $.ajax({
				type    : "POST",
				url     : "<?php echo site_url('admin/expenses/get_employee_by_branch'); ?>",
				data    : {'branch_id' : branch_id},
				success : function(response){
					if(response != ''){						
						$('#paidby_employee').html(response); 		
					}
				}
			})

		
	
});	
</script> 

<script type="text/javascript">
$('#logistic_from_state').change(function(){
var state= $(this).val();
	 $.ajax({
			type    : "POST",
			url     : "<?php echo site_url('admin/expenses/get_cites'); ?>",
			data    : {'state' : state},
			success : function(response){
				if(response != ''){						
					$('#logistic_from_city').html(response); 		
				}
			}
		})

});	
$('#logistic_to_state').change(function(){
var state= $(this).val();
	 $.ajax({
			type    : "POST",
			url     : "<?php echo site_url('admin/expenses/get_cites'); ?>",
			data    : {'state' : state},
			success : function(response){
				if(response != ''){						
					$('#logistic_to_city').html(response); 		
				}
			}
		})

});	
</script>


<script>
$('[name="date"]').datepicker({  
    dateFormat: 'dd/mm/yy',
	minDate: -<?php echo $day;?>,
	maxDate: 0
});
</script> 


<script type="text/javascript">
	$('#category').change(function(){
	var category_id = $(this).val();
		 
		 if(category_id == 2){
			$('#tempo_paid_by').prop("required", true);
			$('#hotel_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);
		 }else if(category_id == 4){
			$('#hotel_paid_by').prop("required", true);
			$('#tempo_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);
		 }else if(category_id == 5){
			$('#logistic_paid_by').prop("required", true);
			$('#tempo_paid_by').prop("required", false);
			$('#hotel_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);			
		 }else if(category_id == 6){
			$('#extra_paid_by').prop("required", true);
			$('#tempo_paid_by').prop("required", false);
			$('#hotel_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
		 }else{
			$('#tempo_paid_by').prop("required", false);
			$('#hotel_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);
		 }
				 
	});
</script> 

<script type="text/javascript">
$( document ).ready(function() {
	var category_id = $('#category').val();
		if(category_id == 2){
			$('#tempo_paid_by').prop("required", true);
			$('#hotel_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);
		 }else if(category_id == 4){
			$('#hotel_paid_by').prop("required", true);
			$('#tempo_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);
		 }else if(category_id == 5){
			$('#logistic_paid_by').prop("required", true);
			$('#tempo_paid_by').prop("required", false);
			$('#hotel_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);			
		 }else if(category_id == 6){
			$('#extra_paid_by').prop("required", true);
			$('#tempo_paid_by').prop("required", false);
			$('#hotel_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
		 }else{
			$('#tempo_paid_by').prop("required", false);
			$('#hotel_paid_by').prop("required", false);
			$('#logistic_paid_by').prop("required", false);
			$('#extra_paid_by').prop("required", false);
		 }
	});
</script> 
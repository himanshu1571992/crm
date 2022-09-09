<?php init_head(); ?>
<script src="https://maps.googleapis.com/maps/api/js?v=3.exp&sensor=false&libraries=places"></script>
<div id="wrapper">
   <div class="content">
      <div class="row">
       
		 <?php // echo form_open_multipart($this->uri->uri_string(), array('id' => 'leave_form', 'class' => 'proposal-form')); ?>
		 <form action="<?php if(!empty($task_info)){ echo admin_url('Task/edit'); }else{ echo admin_url('Task/add'); }?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
         <div class="col-md-12">
            <div class="panel_s">
               <div class="panel-body">
                 	<h4 class="no-margin"><?php echo 'Add New Task'; ?></h4>	
                  <hr class="hr-panel-heading" />
                 
				  	<!-- <div style="margin-bottom: 14px;" class="checkbox checkbox-primary">
		                    <input type="checkbox" name="repeat" id="repeat" value="1" <?php echo (!empty($task_info) && $task_info->is_repeat == 1) ? 'checked' : '' ; ?> id="repeat">
		                    <label style="width:100%;" for="repeat"><span style="font-size:14px;">Repeat Task</span></label>
						</div>  -->
					<div class="row">

					


					<div id="no_repeat_div" <?php echo (!empty($task_info) && $task_info->is_repeat == 1) ? 'hidden' : '' ; ?> >

						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="start_date" class="control-label"><?php echo 'Start Date' ?></label>
							<div class="input-group date">
                                                            <input id="start_date" required="" name="start_date" class="form-control task_date" value="<?php echo (isset($task_info) && $task_info->start_date != "") ? date('d/m/Y',strtotime($task_info->start_date)) : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>		
						</div>
								
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="due_date" class="control-label"><?php echo 'Due Date' ?></label>
							<div class="input-group date">
								<input id="due_date" required="" name="due_date" class="form-control task_date" value="<?php echo (isset($task_info) && $task_info->due_date != "") ? date('d/m/Y',strtotime($task_info->due_date)) : "" ?>" aria-invalid="false" type="text" ><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>		
						</div>	

						
					</div>	
                                            
                                            <?php if (!empty($task_info) && $task_info->is_repeat == 1) { ?>
                                            <input id="start_date" required="" name="start_date" class="form-control task_date" value="<?php echo (isset($task_info) && $task_info->start_date != "") ? date('d/m/Y',strtotime($task_info->start_date)) : "" ?>" aria-invalid="false" type="hidden">
                                            <?php
                                                }
                                            ?>

    <!--					<div id="repeat_div" <?php echo (!empty($task_info) && $task_info->is_repeat == 1) ? '' : 'hidden' ; ?> >

                                                    <div class="form-group col-md-4">
                                                            <label for="repeat_type" class="control-label">Repeat Type *</label>
                                                            <select class="form-control" id="repeat_type" name="repeat_type">
                                                                    <option value="" disabled selected >--Select One-</option>								
                                                                    <option value="1" <?php if(!empty($task_info) && $task_info->repeat_type == 1){ echo 'selected'; }?>>Weekly</option>
                                                                    <option value="2" <?php if(!empty($task_info) && $task_info->repeat_type == 2){ echo 'selected'; }?>>Monthly</option>

                                                            </select>
                                                    </div>				

                                                    <div class="form-group col-md-4">
                                                            <label for="repeat_every" class="control-label">Repeat every *</label>
                                                            <select class="form-control selectpicker" multiple data-live-search="true" id="repeat_every" name="repeat_every[]">	
                                                                    <?php
                                                                    if(!empty($task_info)){
                                                                            $r_aar = explode(',', $task_info->repeat_every);	
                                                                            if($repeat_type == 1){    			
                                                                            if(!empty($days_info)){
                                                                                    foreach ($days_info as $key => $value) {
                                                                                            ?>
                                                                                                    <option <?php echo (in_array($value->id, $r_aar)) ? 'selected' : '' ; ?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
                                                                                            <?php
                                                                                    }
                                                                            }	
                                                                    }else{
                                                                            for($i=1; $i <= 31 ; $i++) { 
                                                                                    ?>
                                                                                            <option <?php echo (in_array($i, $r_aar)) ? 'selected' : '' ; ?> value="<?php echo $i; ?>"><?php echo $i; ?></option>
                                                                                    <?php
                                                                            }
                                                                    }

                                                                    }								
                                                                    ?>
                                                            </select>
                                                    </div>

                                            </div>-->


					<!-- <div class="form-group col-md-4" app-field-wrapper="date">
						<label for="reminder_date" class="control-label"><?php echo 'Reminder Date' ?></label>
						<div class="input-group date">
							<input id="reminder_date" name="reminder_date" required class="form-control datepicker" value="<?php echo (isset($task_info) && $task_info->reminder_date != "") ? date('d/m/Y',strtotime($task_info->reminder_date)) : "" ?>" aria-invalid="false" type="text" ><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
						</div>		
					</div> -->	


					<div class="form-group col-md-4">
                            <label for="staff_id" class="control-label">Staff Can View</label>
                            <select class="form-control selectpicker" multiple data-live-search="true" id="user_ids" name="user_ids[]">
                                <option value=""></option>
                                <?php
                                $employee_arr = array();
                                if(!empty($task_info)){
                                	$employee_arr = explode(',', $task_info->user_ids);
                                }

	                               if(!empty($employee_info)){
		                               	foreach ($employee_info as $value) {
		                               		?>
		                               		<option <?php if(in_array($value->staffid, $employee_arr)){ echo 'selected'; }?> value="<?php echo $value->staffid; ?>"><?php echo $value->firstname; ?></option>
		                               		<?php
		                               	}
	                               }
                                ?>
                            </select>
                    </div>

					

					
					 <div class="form-group col-md-6">
						<label for="title" class="control-label">Title</label>
						<input type="text" id="title" name="title" class="form-control" value="<?php echo (isset($task_info->title) && $task_info->title != "") ? $task_info->title : "" ?>" >
					</div>

					<div class="form-group col-md-6">
						<label for="description" class="control-label">Task Description*</label>
						<textarea id="description" name="description" required="" class="form-control"><?php echo (isset($task_info->description) && $task_info->description != "") ? $task_info->description : "" ?></textarea>
					</div>	
	
                                        <div class="row">
                                            <div class="col-md-12">
                                                <div class="form-group col-md-4">
                                                    <label for="priority" class="control-label">Priority *</label>
                                                    <select class="form-control" id="priority" name="priority" required>
                                                            <option value="" disabled selected >--Select One-</option>								
                                                            <option value="1" <?php if(!empty($task_info) && $task_info->priority == 1){ echo 'selected'; }?> >Low</option>
                                                            <option value="2" <?php if(!empty($task_info) && $task_info->priority == 2){ echo 'selected'; }?>>Medium</option>
                                                            <option value="3" <?php if(!empty($task_info) && $task_info->priority == 3){ echo 'selected'; }?>>High</option>
                                                            <option value="4" <?php if(!empty($task_info) && $task_info->priority == 4){ echo 'selected'; }?>>Urgent</option>

                                                    </select>
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="task_for" class="control-label">Task For *</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="task_for" name="task_for" required>
                                                            <option value="" disabled selected >--Select One-</option>								
                                                            <option value="1" <?php if(!empty($task_info) && $task_info->task_for == 1){ echo 'selected'; }?>>Self</option>
                                                            <option value="2" <?php if(!empty($task_info) && $task_info->task_for == 2){ echo 'selected'; }?>>Company</option>

                                                    </select>
                                                </div>
                                                <div <?php if(!empty($task_info) && $task_info->task_for == 2){ }else{ echo 'hidden'; } ?> id="employee_div">
                                                    <div class="form-group col-md-4">
                                                        <label for="staff_id" class="control-label"><?php echo _l('staff'); ?></label>
                                                        <select class="form-control selectpicker" multiple data-live-search="true" id="staff_id" name="staff_id[]">
                                                            <option value=""></option>
                                                            <?php
                                                            $employee_arr = array();
                                                            if(!empty($task_info)){
                                                                    $employee_arr = explode(',', $task_info->assigned_to);
                                                            }

                                                                   if(!empty($employee_info)){
                                                                            foreach ($employee_info as $value) {
                                                                                    ?>
                                                                                    <option <?php if(in_array($value->staffid, $employee_arr)){ echo 'selected'; }?> value="<?php echo $value->staffid; ?>"><?php echo $value->firstname; ?></option>
                                                                                    <?php
                                                                            }
                                                                   }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group col-md-4">
                                            <label for="file" class="control-label"><?php echo 'Attachment File'; ?></label>
                                            <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="Repeat Every" class="control-label">Repeat Every </label>
                                            <select class="form-control selectpicker" data-live-search="true" id="repeat_type" name="repeat_type">
                                                    <option value="" >--Select One-</option>								
                                                    <option value="1" <?php echo (!empty($task_info) && $task_info->repeat_type == 1) ? 'selected' : "";?> >Week</option>
                                                    <option value="2" <?php echo (!empty($task_info) && $task_info->repeat_type == 2) ? 'selected' : "";?>>1 Months</option>
                                                    <option value="3" <?php echo (!empty($task_info) && $task_info->repeat_type == 3) ? 'selected' : "";?>>2 Months</option>
                                                    <option value="4" <?php echo (!empty($task_info) && $task_info->repeat_type == 4) ? 'selected' : "";?>>3 Months</option>
                                                    <option value="5" <?php echo (!empty($task_info) && $task_info->repeat_type == 5) ? 'selected' : "";?>>6 Months</option>
                                                    <option value="6" <?php echo (!empty($task_info) && $task_info->repeat_type == 6) ? 'selected' : "";?>>1 Year</option>

                                            </select>
                                        </div>
                                        <div class="form-group col-md-4 repeat_every" >
                                            <label for="Total Cycles" class="control-label">Total Cycles </label>
                                            <input type="number" id="repeat_every" class="form-control repeat_every_box" name="repeat_every" value="<?php echo (!empty($task_info) && $task_info->repeat_every > 0) ? $task_info->repeat_every : "";?>" min="1">
                                        </div>
                                        <div class="form-group col-md-4">
                                            <label for="related_to" class="control-label">Related To: *</label>
                                            <select class="form-control" id="related_to" name="related_to" required>
                                                <option value="" disabled selected >--Select One-</option>	
                                                <?php
                                                if (!empty($task_for)) {
                                                    foreach ($task_for as $value) {
                                                        ?>
                                                        <option value="<?php echo $value->id; ?>" <?php echo (!empty($task_info) && $task_info->related_to == $value->id) ? 'selected' : ''; ?> ><?php echo $value->name; ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>


					<div <?php if(!empty($task_info) && ($task_info->related_to == 2 || $task_info->related_to == 3 || $task_info->related_to == 4 || $task_info->related_to == 5 || $task_info->related_to == 6)){ }else{ echo 'hidden'; } ?> id="date_div">
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="from_date" class="control-label"><?php echo 'From Date' ?></label>
								<div class="input-group date">
									<input id="from_date" value="<?php echo (isset($task_info) && $task_info->from_date != "") ? date('d/m/Y',strtotime($task_info->from_date)) : "" ?>" name="from_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>		
							</div>
							
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="to_date" class="control-label"><?php echo 'To Date' ?></label>
								<div class="input-group date">
									<input id="to_date" value="<?php echo (isset($task_info) && $task_info->to_date != "") ? date('d/m/Y',strtotime($task_info->to_date)) : "" ?>" name="to_date" class="form-control datepicker" value="" aria-invalid="false" type="text" ><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>		
							</div>	
							
						<div class="form-group col-md-3">	
							<button type="button" id="search" class="btn btn-info">Search</button>
						</div>

					</div>


					<div id="main_data">

						<?php 
						if(!empty($task_info)){
							
							if($task_info->related_to == 1){

								$client_arr = explode(',', $task_info->clients);

								$client_info = $this->home_model->get_result('tblclients', array('active'=>1), '');
						    	?>
						    	<div class="form-group col-md-6">
						            <label for="ids" class="control-label">Clients</label>
						            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
						                <option value=""></option>
						                <?php
						                   if(!empty($client_info)){
						                       	foreach ($client_info as $value) {
						                       		?>
						                       		<option <?php if(in_array($value->userid, $client_arr)){ echo 'selected'; }?> value="<?php echo $value->userid; ?>"><?php echo $value->company; ?></option>
						                       		<?php
						                       	}
						                   }
						                ?>
						            </select>
						        </div>
						    	<?php


							}elseif($task_info->related_to == 2 || $task_info->related_to == 8 || $task_info->related_to == 9){

								$challan_arr = explode(',', $task_info->challans);

							$f_date = $task_info->from_date.' 00:00:00';

							$to_date = $task_info->to_date.' 23:59:59';


							$challan_info = $this->db->query("SELECT * FROM tblchalanmst WHERE datecreated >= '".$f_date."' and datecreated <= '".$to_date."' and status = '1'")->result();
			
				?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Challan</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($challan_info)){
			                       	foreach ($challan_info as $value) {

			                       		$client_info = $this->db->query("SELECT company FROM `tblclients`  where userid = '".$value->clientid."'")->row();

			                       		?>
			                       			<option <?php if(in_array($value->id, $challan_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $value->chalanno.' - '.$client_info->company; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>

				<?php

			}elseif($task_info->related_to == 3){
				$expense_arr = explode(',', $task_info->expenses);
				
				$expense_info = $this->db->query("SELECT e.id,c.name as category_name FROM tblexpenses as e INNER JOIN tblexpensescategories as c ON e.category = c.id  WHERE e.date between '".$task_info->from_date."' and '".$task_info->to_date."' and e.status = '1' and e.approved_status = 1")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Expense</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($expense_info)){
			                       	foreach ($expense_info as $value) {

			                       		$exp = 'EXP-'.get_short($value->category_name).'-'.number_series($value->id);

			                       		?>
			                       			<option <?php if(in_array($value->id, $expense_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $exp; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($task_info->related_to == 4){
				$invoice_arr = explode(',', $task_info->invoices);
				
				$invoice_info = $this->db->query("SELECT * FROM tblinvoices  WHERE date between '".$task_info->from_date."' and '".$task_info->to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Invoice</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($invoice_info)){
			                       	foreach ($invoice_info as $value) {

			                       		
			                       		$client_info = $this->db->query("SELECT company FROM `tblclients`  where userid = '".$value->clientid."'")->row();

			                       		$invoice = format_invoice_number($value->id);

			                       		?>
			                       			<option <?php if(in_array($value->id, $invoice_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $invoice.' - '.$client_info->company; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($task_info->related_to == 5){
				$lead_arr = explode(',', $task_info->leads);

			
				$lead_info = $this->db->query("SELECT * FROM tblleads  WHERE enquiry_date between '".$task_info->from_date."' and '".$task_info->to_date."' ")->result();

				?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Leads</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($lead_info)){
			                       	foreach ($lead_info as $value) {

			                       		?>
			                       			<option <?php if(in_array($value->id, $lead_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $value->leadno; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($task_info->related_to == 6){
				$pinv_arr = explode(',', $task_info->perfoma_invoices);
			
				$estimates_info = $this->db->query("SELECT * FROM tblestimates  WHERE date between '".$task_info->from_date."' and '".$task_info->to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Proforma Invoice</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($estimates_info)){
			                       	foreach ($estimates_info as $value) {
			                       			$estimate = format_estimate_number($value->id);
			                       		?>
			                       			<option <?php if(in_array($value->id, $pinv_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $estimate; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($task_info->related_to == 7){
				
				$product_arr = array();
				$pj_array = json_decode($task_info->product_data);
				

				if(!empty($pj_array)){
					foreach ($pj_array as $r) {
						$product_arr[] = $r->p_id;
					}
				}

			
				$product_info = $this->db->query("SELECT * FROM tblproducts  WHERE status = 1 ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="p_ids" class="control-label">Select Products</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="p_ids" name="p_ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($product_info)){
			                       	foreach ($product_info as $value) {
			                       		?>
			                       			<option <?php if(in_array($value->id, $product_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $value->name; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>

			        <div class="form-group col-md-3">
			        	<button type="button" id="add_qty" class="btn btn-info">Add Qty</button>
			        </div>





				<?php

			}elseif($task_info->related_to == 10){
				$pinv_arr = explode(',', $task_info->quotation);
			
				$quotation_info = $this->db->query("SELECT * FROM tblproposals  WHERE date between '".$task_info->from_date."' and '".$task_info->to_date."' ")->result();

					?>
					<div class="form-group col-md-6">
			            <label for="ids" class="control-label">Select Quotation</label>
			            <select class="form-control selectpicker" multiple data-live-search="true" id="ids" name="ids[]">
			                <option value=""></option>
			                <?php
			                   if(!empty($quotation_info)){
			                       	foreach ($quotation_info as $value) {
			                       			$quotation = format_proposal_number($value->id);
			                       		?>
			                       			<option <?php if(in_array($value->id, $pinv_arr)){ echo 'selected'; }?> value="<?php echo $value->id; ?>"><?php echo $quotation; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
				<?php

			}elseif($task_info->related_to == 11){
				$client_info = $this->home_model->get_result('tblclients', array('active'=>1), '');
    			$state_info = $this->home_model->get_result('tblstates', array('status'=>1), '');
    			$city_info = $this->db->query("SELECT * from `tblcities` where state_id = '".$task_info->state_id."' and status = 1 ")->result();
				?>
				<div class=" col-md-12">    		
    	
			    	<div class="form-group col-md-6" id="client_name_div" <?php if(empty($task_info->client_name)) { echo 'hidden'; } ?> >
						<label for="client_name" class="control-label">Client Name</label>
						<input type="text" id="client_name" name="client_name" class="form-control" value="<?php echo $task_info->client_name; ?>" >
					</div>


			    	<div class="form-group col-md-6" id="client_id_div" <?php if(empty($task_info->client_id)) { echo 'hidden'; } ?>>
			            <label for="ids" class="control-label">Clients</label>
			            <select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id">
			                <option value=""></option>
			                <?php
			                   if(!empty($client_info)){
			                       	foreach ($client_info as $value) {
			                       		?>
			                       		<option value="<?php echo $value->userid; ?>" <?php if(!empty($task_info) && $task_info->client_id == $value->userid){ echo 'selected'; }?>><?php echo $value->company; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>

			        <div class="form-group col-md-6" app-field-wrapper="existing_client">
			            <label for="existing_client" class="control-label">Existing Client </label>
			            <input type="checkbox" name="existing_client" id="existing_client" <?php if(!empty($task_info->client_id)) { echo 'checked'; } ?>>
			        </div>

		        </div>

		        <div class="col-md-12">  

			        <div class="form-group col-md-3" >
			            <label for="ids" class="control-label">Service Type</label>
			            <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
			                <option value=""></option>
			                <option value="1" <?php if(!empty($task_info) && $task_info->service_type == 1){ echo 'selected'; }?> >Rent</option>
			                <option value="2" <?php if(!empty($task_info) && $task_info->service_type == 2){ echo 'selected'; }?> >Sales</option>
			            </select>
			        </div>

			        <div class="form-group col-md-9">
						<label for="product_details" class="control-label">Product Details</label>
						<input type="text" id="product_details" name="product_details" class="form-control" value="<?php echo $task_info->product_details; ?>" >
					</div>

				</div>

				<div class="col-md-12"> 

					<div class="form-group col-md-4" app-field-wrapper="date">
						<label for="start_date" class="control-label">Date</label>
						<div class="input-group date">
							<input id="other_date" name="other_date" class="form-control task_date" value="<?php echo _d($task_info->other_date); ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
						</div>		
					</div>

					<div class="form-group col-md-4">
			            <label class="control-label">Select State</label>
			            <select class="form-control selectpicker" data-live-search="true" id="state_id" name="state_id">
			                <option value=""></option>
			                <?php
			                   if(!empty($state_info)){
			                       	foreach ($state_info as $value) {
			                       		?>
			                       		<option value="<?php echo $value->id; ?>" <?php if(!empty($task_info) && $task_info->state_id == $value->id){ echo 'selected'; }?>><?php echo $value->name; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>

			        <div class="form-group col-md-4">
			            <label class="control-label">Select City</label>
			            <select class="form-control selectpicker" data-live-search="true" id="city_id" name="city_id">
			                <option value=""></option>
			                <?php
			                   if(!empty($city_info)){
			                       	foreach ($city_info as $value) {
			                       		?>
			                       		<option value="<?php echo $value->id; ?>" <?php if(!empty($task_info) && $task_info->city_id == $value->id){ echo 'selected'; }?>><?php echo $value->name; ?></option>
			                       		<?php
			                       	}
			                   }
			                ?>
			            </select>
			        </div>
			    </div>
				<?php				

			}
						}
						?>
						  	

					</div>


					<div id="product_table">
						  <?php
						  if(!empty($task_info) && $task_info->related_to == 7){
						  	$pj_array = json_decode($task_info->product_data);
						  	?>
				    		<div class="table-responsive s_table proddv" style="margin-top:19%;" >
				                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
				                    <thead>
				                        <tr>
				                            <th align="left">S.No.</th>
				                            <th align="left">Product Name</th>
				                            <th align="left">View</th>
				                            <th align="left">Quantity</th>
				                        </tr>
				                    </thead>
				                    <tbody class="ui-sortable">
				                        <?php
				                        if(!empty($pj_array)){
				                        	$i = 1;
				                        	foreach ($pj_array as $p_info) {
				                        		?>
				                        		<tr class="main" id="tr0">
					                                <td><?php echo $i++; ?></td>									
													<td><?php echo value_by_id('tblproducts',$p_info->p_id,'name'); ?></td>
													<td><a target="_blank" href="<?php echo base_url('admin/product_new/View/'.$p_info->p_id);?>">View</a></td>
					                                <td>
					                                    <div class="form-group">
					                                        <input type="number" value="<?php echo $p_info->p_qty; ?>" id="qty" name="productqty_<?php echo $p_info->p_id; ?>" class="form-control" >
					                                    </div>
					                                </td>	                                
					                            </tr>
				                        		<?php
				                        	}
				                        }

				                        ?>
				                            
				                        
				                    </tbody>
				                </table>
				        
				            </div>
				    		<?php
						  }
						  ?>

					</div>

					<div id="address_table">
						<?php
							if(!empty($task_info) && ($task_info->related_to == 8 || $task_info->related_to == 9)){
									$challan_arr = explode(',', $task_info->challans);
									echo get_challan_address($challan_arr);
							}
						?>
				    </div>


					</div>
					
					
				    
                  <hr class="hr-panel-heading" />
                 
				 
					<?php
					if(!empty($task_info)){
						?>	
						<input type="hidden" value="<?php echo $task_info->id;  ?>" name="id">
						<?php
					}

					?>
                  
				
                  <div class="btn-bottom-toolbar text-right">					
					<button type="submit"  class="btn btn-info">Add Task</button>					
                  </div>
               </div>
            </div>
         </div>
        
		 <input type="hidden" value="3" name="currency">		 
		 <input type="hidden" id="is_paid_leave" value="1" name="is_paid_leave">		 
         <?php echo form_close(); ?>
      </div>
      <div class="btn-bottom-pusher"></div>
   </div>
</div>

<?php init_tail(); ?>

</body>
</html>


<script type="text/javascript">
$('#task_for').change(function(){

	var task_for = $(this).val();
	if(task_for == 1){
		$("#employee_div").hide(); 
	}else{
		$("#employee_div").show(); 
	}

});	
</script> 

<script type="text/javascript">
	$(document).on('click', '#existing_client', function() { 
		if($('#existing_client').is(':checked')){
			$("#client_name_div").hide(); 
			$("#client_id_div").show(); 
		}else{
			$("#client_name_div").show(); 
			$("#client_id_div").hide();
		}
		
	});
</script> 

<script type="text/javascript">
	$('#related_to').change(function(){
	var related_to = $(this).val();
		if(related_to == 1){

			$.ajax({
				type    : "POST",
				url     : "<?php echo base_url('admin/task/get_clients'); ?>",
				data    : {'related_to' : related_to},
				success : function(response){
					if(response != ' '){
						$("#main_data").html(response);
						$('.selectpicker').selectpicker('refresh');
					}
				}
			})	

			$("#date_div").hide(); 

		}else if(related_to == 7){
			$("#date_div").hide(); 
			$("#main_data").html(' ');

			 $.ajax({
				type    : "POST",
				url     : "<?php echo base_url('admin/task/get_data'); ?>",
				data    : {'related_to' : related_to},
				success : function(response){
					if(response != ' '){
						$("#main_data").html(response);
						$('.selectpicker').selectpicker('refresh');
					}
				}
			})

		}else if(related_to == 11){
			$("#date_div").hide(); 
			$("#main_data").html(' ');

			 $.ajax({
				type    : "POST",
				url     : "<?php echo base_url('admin/task/getOtherDeliveryPickupData'); ?>",
				data    : {'related_to' : related_to},
				success : function(response){
					if(response != ' '){
						$("#main_data").html(response);
						$('.selectpicker').selectpicker('refresh');

						$('.task_date').datepicker({
  
						     dateFormat: 'dd/mm/yy',
							 minDate:new Date()
							  
						});
					}
				}
			})

		}else if(related_to == 2 || related_to == 3 || related_to == 4 || related_to == 5 || related_to == 6 || related_to == 8 || related_to == 9 || related_to == 10){
			$("#date_div").show(); 
			$("#main_data").html(' ');
		}else{
			$("#date_div").hide(); 
			$("#main_data").html(' ');
		}	
		
	});
</script> 	


<script type="text/javascript">
	$('#search').click(function(){
	var from_date = $('#from_date').val();
	var to_date = $('#to_date').val();
	var related_to = $('#related_to').val();
	
	if(to_date != '' && from_date != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_data'); ?>",
			data    : {'to_date' : to_date, 'from_date' : from_date, 'related_to' : related_to},
			success : function(response){
				if(response != ' '){
					$("#main_data").html(response);
					$('.selectpicker').selectpicker('refresh');
					$("#product_table").html(' ');
				}
			}
		})
	}
		
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '#add_qty', function() { 
	var p_ids = $('#p_ids').val();
	
	if(p_ids != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_product_table'); ?>",
			data    : {'p_ids' : p_ids},
			success : function(response){
				if(response != ' '){
					$("#product_table").html(response);
					
				}
			}
		})
	}
		
	});
</script> 

<script type="text/javascript">
	$(document).on('click', '#repeat', function() { 
	if ($(this).prop('checked')) {
	   $("#repeat_div").show(); 
	   $("#no_repeat_div").hide(); 
	}else{
		$("#no_repeat_div").show(); 
		$("#repeat_div").hide(); 
	}
		
	});
</script> 

<script type="text/javascript">
	$(document).on('change', '#repeat_type', function() { 
	var repeat_type = $(this).val();
	
	if(repeat_type != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_repeat_every'); ?>",
			data    : {'repeat_type' : repeat_type},
			success : function(response){
				if(response != ' '){
					$("#repeat_every").html(response);
					$('.selectpicker').selectpicker('refresh');
					
				}
			}
		})
	}
		
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '#get_address', function() { 	
	var ids = $('#ids').val();
	
	if(ids != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_address'); ?>",
			data    : {'ids' : ids},
			success : function(response){
				if(response != ' '){
					$("#address_table").html(response);
				}
			}
		})
	}
		
	});
</script> 


<script type="text/javascript">
	$(document).on('change', '#state_id', function() { 
	var state_id = $(this).val();
	
	if(state_id != ''){
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/task/get_city'); ?>",
			data    : {'state_id' : state_id},
			success : function(response){
				if(response != ' '){
					$("#city_id").html(response);
					$('.selectpicker').selectpicker('refresh');
					
				}
			}
		})
	}
		
	});
</script> 

<script>
$('.task_date').datepicker({
  
     dateFormat: 'dd/mm/yy',
	 minDate:new Date()
	  
});
var repeat_check = '<?php echo (!empty($task_info) && $task_info->repeat_every > 0) ? 1 : 0;?>';
if (repeat_check == 1){
    $(".repeat_every").show();
    $(".repeat_every_box").attr("required", "");
}else{
    $(".repeat_every").hide();
}

$(document).on("change", "#repeat_type", function(){
    $(".repeat_every").show();
    $(".repeat_every_box").attr("required", "");
});
</script>

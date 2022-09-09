<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo _l('company_branch'); ?> </h4>
		<hr />
		<?php 
		$designationdata = $this->db->get('tbldesignation')->result_array();
		$bank_data = $this->db->get('tblbankmaster')->result_array();
		$companybranch_data = $this->db->get('tblwarehouse')->result_array();

		$employee_info = $this->db->query("SELECT * FROM `tblstaff` WHERE active = 1 ")->result_array();

		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $companybranchdata= $this->db->get('tblcompanybranch')->row();
		   $companybranch = (array) $companybranchdata;
		   $this->db->where('comp_branch_id', $_GET['id']);
           $companybranchpersondata= $this->db->get('tblcompanybranchperson')->result_array();
		   $comp_branch=explode(',',$companybranch['warehouse_id']);
		   $companybranchperson = (array) $companybranchpersondata;
		}?>
		<div class="col-md-6">
			<div class="form-group">
				<label for="comp_branch_name" class="control-label"><?php echo _l('company_branch_name'); ?>*</label>
				<input type="text" id="comp_branch_name" name="companybranch[comp_branch_name]" required="" class="form-control" value="<?php echo (isset($companybranch['comp_branch_name']) && $companybranch['comp_branch_name'] != "") ? $companybranch['comp_branch_name'] : "" ?>">
			</div>		
			<!--<div class="form-group">
				<label for="comp_name" class="control-label"><?php echo _l('company_namee'); ?>*</label>
				
				<input type="text" id="comp_name" name="companybranch[comp_name]" required="" class="form-control" value="<?php echo (isset($companybranch['comp_name']) && $companybranch['comp_name'] != "") ? $companybranch['comp_name'] : "" ?>">
			</div>-->
			<?php if(isset($_GET['id']))?> <input type="hidden" id="compbranchid" name="compbranchid" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
			<div class="form-group">
				<label for="warehouse_id" class="control-label"><?php echo _l('company_branch_warehouse'); ?>*</label>
				<select class="form-control selectpicker" required="" id="warehouse_id" name="warehouse_id[]" multiple data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($companybranch_data) && count($companybranch_data) > 0) {
						foreach ($companybranch_data as $companybranch_key => $companybranch_value) 
						{?>
							<option value="<?php echo $companybranch_value['id'] ?>" <?php echo (isset($companybranch['warehouse_id']) && in_array( $companybranch_value['id'],$comp_branch)) ? 'selected' : "" ?>><?php echo cc($companybranch_value['name']); ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="contact_person" class="control-label">Contact Person*</label>
				<input type="text" id="contact_person" name="companybranch[contact_person]"  required=""class="form-control" value="<?php echo (isset($companybranch['contact_person']) && $companybranch['contact_person'] != "") ? $companybranch['contact_person'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="phone_no_1" class="control-label"><?php echo _l('company_branch_cont_1'); ?>*</label>
				<input type="text" id="phone_no_1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="10" maxlength="10" name="companybranch[phone_no_1]"  required=""class="form-control" value="<?php echo (isset($companybranch['phone_no_1']) && $companybranch['phone_no_1'] != "") ? $companybranch['phone_no_1'] : "" ?>">
			</div>

			<div class="form-group">
				<label for="bank_id" class="control-label">Select Branch Manage*</label>
				<select class="form-control selectpicker" required="" id="branch_manage_id" name="companybranch[branch_manage_id]" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($employee_info) && count($employee_info) > 0) {
						foreach ($employee_info as $value) 
						{?>
							<option value="<?php echo $value['staffid'] ?>" <?php echo (isset($companybranch['branch_manage_id']) && $companybranch['branch_manage_id'] == $value['staffid']) ? 'selected' : "" ?>><?php echo cc($value['firstname']); ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
			
			<div class="form-group">
				<label for="gst_no" class="control-label"><?php echo _l('company_branch_gst_no'); ?>*</label>
				<input type="text" id="gst_no" required="" name="companybranch[gst_no]" class="form-control" value="<?php echo (isset($companybranch['gst_no']) && $companybranch['gst_no'] != "") ? $companybranch['gst_no'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="cin_no" class="control-label"><?php echo _l('company_branch_cin_no'); ?>*</label>
				<input type="text" id="cin_no" required="" name="companybranch[cin_no]" class="form-control" value="<?php echo (isset($companybranch['cin_no']) && $companybranch['cin_no'] != "") ? $companybranch['cin_no'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="state_id" class="control-label"><?php echo _l('company_branch_state'); ?>*</label>
				<select class="form-control selectpicker" required="" id="state" name="companybranch[state]" onchange="get_city_by_state(this.value)" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($state_data) && count($state_data) > 0) {
						foreach ($state_data as $state_key => $state_value) 
						{?>
							<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($companybranch['state']) && $companybranch['state'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="pincode" class="control-label"><?php echo _l('company_branch_pin_code'); ?> *</label>
				<input type="text" id="pincode" name="companybranch[pincode]" required="" class="form-control" value="<?php echo (isset($companybranch['pincode']) && $companybranch['pincode'] != "") ? $companybranch['pincode'] : "" ?>">
			</div>

			<div class="form-group">
				<label for="landmark" class="control-label"><?php echo _l('company_branch_landmark'); ?>*</label>
				<input type="text" id="landmark" required="" name="companybranch[landmark]" class="form-control" value="<?php echo (isset($companybranch['landmark']) && $companybranch['landmark'] != "") ? $companybranch['landmark'] : "" ?>">
			</div>
		</div>
		<div class="col-md-6">	
			<div class="form-group">
				<label for="email_id" class="control-label"><?php echo _l('company_branch_mail_id'); ?>*</label>
				<input type="text" id="email_id" name="companybranch[email_id]" required="" class="form-control" value="<?php echo (isset($companybranch['email_id']) && $companybranch['email_id'] != "") ? $companybranch['email_id'] : "" ?>">
			</div>
			 <div class="form-group">
				<label for="password" class="control-label"><?php echo _l('company_branch_password'); ?>*</label>
				<input type="password" id="password" required="" name="companybranch[password]" class="form-control" value="<?php echo (isset($companybranch['password']) && $companybranch['password'] != "") ? $companybranch['password'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="bank_id" class="control-label"><?php echo _l('company_branch_bank_name'); ?>*</label>
				<select class="form-control selectpicker" required="" id="bank_id" name="companybranch[bank_id]" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($bank_data) && count($bank_data) > 0) {
						foreach ($bank_data as $bank_key => $bank_value) 
						{?>
							<option value="<?php echo $bank_value['id'] ?>" <?php echo (isset($companybranch['bank_id']) && $companybranch['bank_id'] == $bank_value['id']) ? 'selected' : "" ?>><?php echo cc($bank_value['name']); ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="phone_no_2" class="control-label"><?php echo _l('company_branch_cont_2'); ?></label>
				<input type="text" id="phone_no_2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="10" maxlength="10" name="companybranch[phone_no_2]" class="form-control" value="<?php echo (isset($companybranch['phone_no_2']) && $companybranch['phone_no_2'] != "") ? $companybranch['phone_no_2'] : "" ?>">
			</div>

			<div class="form-group">
				<label for="bank_id" class="control-label">Select Challan Manage*</label>
				<select class="form-control selectpicker" required="" id="challan_manage_id" name="companybranch[challan_manage_id]" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($employee_info) && count($employee_info) > 0) {
						foreach ($employee_info as $value) 
						{?>
							<option value="<?php echo $value['staffid'] ?>" <?php echo (isset($companybranch['challan_manage_id']) && $companybranch['challan_manage_id'] == $value['staffid']) ? 'selected' : "" ?>><?php echo cc($value['firstname']); ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>

			<div class="form-group">
				<label for="pan_no" class="control-label"><?php echo _l('company_branch_pan_no'); ?>*</label>
				<input type="text" id="pan_no" required="" name="companybranch[pan_no]" class="form-control" value="<?php echo (isset($companybranch['pan_no']) && $companybranch['pan_no'] != "") ? $companybranch['pan_no'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="address" class="control-label"><?php echo _l('company_branch_address'); ?>*</label>
				<textarea id="address" name="companybranch[address]" required="" class="form-control"><?php echo (isset($companybranch['address']) && $companybranch['address'] != "") ? $companybranch['address'] : "" ?></textarea>
			</div>
			
			<div class="form-group">
				<label for="city_id" class="control-label"><?php echo _l('company_branch_city'); ?>*</label>
				<select class="form-control selectpicker" id="city_id" name="companybranch[city]" required="" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($city_data) && count($city_data) > 0  ) {
						foreach ($city_data as $city_key => $city_value) {
							?>
							<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($companybranch['city']) && $companybranch['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
							<?php
						}
					}
					else if(isset($companybranch['city']) & $companybranch['city']!='')
					{
						foreach ($allcity as $city_key => $city_value)
						{?>
							<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($companybranch['city']) && $companybranch['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			

			<div class="form-group">
				<label for="description" class="control-label"><?php echo _l('description'); ?></label>
				<textarea id="description" name="companybranch[description]" class="form-control"><?php echo (isset($companybranch['description']) && $companybranch['description'] != "") ? $companybranch['description'] : "" ?></textarea>
			</div>
		</div> 
		<div class="col-md-12">	
			<h4><?php echo _l('company_branch_person_details'); ?> </h4>
		</div>
		<hr />
		<div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="30%" align="left">Name</th>
                                            <th width="30%" class="qty" align="left">Email</th>
                                            <th width="30%" align="left">Number	</th>
                                            <th width="30%" align="left">Designation	</th>
                                            <th width="10%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (count($companybranchperson) > 0) {
                                            $i = 0;
                                            foreach ($companybranchperson as $singlewarehouseperson) {
                                                $i++;
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" id="staff_id<?php echo $i; ?>" sataff='<?php echo $i; ?>' onChange="staffdata(<?php echo $i; ?>);" name="companystaff[<?php echo $i;?>][staff_id]">
																<option value=""></option>
																<?php
																if (isset($staff_data) && count($staff_data) > 0) {
																	foreach ($staff_data as $unit_key => $staff_value) {
																		?>
																		<option value="<?php echo $staff_value['staffid'] ?>" <?php echo (isset($singlewarehouseperson['staffid']) && $singlewarehouseperson['staffid'] == $staff_value['staffid']) ? 'selected' : "" ?>><?php echo $staff_value['firstname'].' '.$staff_value['lastname'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
                                                        </div>
                                                    </td>
													<td>
                                                    <div class="form-group">
                                                        <input type="text" id="email<?php echo $i; ?>" name="companystaff[<?php echo $i;?>][email]" value="<?php echo (isset($singlewarehouseperson['email']) && $singlewarehouseperson['email'] != "") ? $singlewarehouseperson['email'] : "" ?>" class="form-control" >
                                                    </div>
                                                </td>
												<td>
                                                    <div class="form-group">
                                                        <input type="text" id="contno<?php echo $i; ?>" name="companystaff[<?php echo $i;?>][contno]" value="<?php echo (isset($singlewarehouseperson['number']) && $singlewarehouseperson['number'] != "") ? $singlewarehouseperson['number'] : "" ?>" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
													<div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="designation<?php echo $i; ?>" name="companystaff[<?php echo $i;?>][designation]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($designationdata) && count($designationdata) > 0) {
                                                                foreach ($designationdata as $designation_key => $designation_values) {
                                                                    ?>
                                                                    <option value="<?php echo $designation_values['id'] ?>" <?php echo (isset($singlewarehouseperson['designation']) && $singlewarehouseperson['designation'] == $designation_values['id']) ? 'selected' : "" ?>><?php echo cc($designation_values['designation']);?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
												<td>
													<button type="button" class="btn pull-right btn-danger " onclick="removeprocomp('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
												</td>
                                                    
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="main" id="tr0">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="staff_id0" sataff='0' onChange="staffdata(0);" name="companystaff[0][staff_id]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($staff_data) && count($staff_data) > 0) {
                                                                foreach ($staff_data as $unit_key => $staff_value) {
                                                                    ?>
                                                                    <option value="<?php echo $staff_value['staffid'] ?>"><?php echo $staff_value['firstname'].' '.$staff_value['lastname'] ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
													
													
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="email0" name="companystaff[0][email]" class="form-control" >
                                                    </div>
                                                </td>
												<td>
                                                    <div class="form-group">
                                                        <input type="text" id="contno0" name="companystaff[0][contno]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
												<div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="designation0" name="companystaff[0][designation]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($designationdata) && count($designationdata) > 0) {
                                                                foreach ($designationdata as $designation_key => $designation_value) {
                                                                    ?>
                                                                    <option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']);?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
												
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('0');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmoreperson" value="<?php echo count($companybranchperson); ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
	</div>
	<div role="tabpanel" class="tab-pane" id="email_queue">
		<?php render_yes_no_option('email_queue_enabled','email_queue_enabled','To speed up the emailing process, the system will add the emails in queue and will send them via cron job, make sure that the cron job is properly configured in order to use this feature.'); ?>
		<hr />
		<?php render_yes_no_option('email_queue_skip_with_attachments','email_queue_skip_attachments','Most likely you will encounter problems with the email queue if the system needs to add big files to the queue. If you plan to use this option consult with your server administrator/hosting provider to increase the max_allowed_packet and wait_timeout options in your server config, otherwise when this option is set to yes the system won\'t add emails with attachments in the queue and will be sent immediately.'); ?>
	</div>
</div>

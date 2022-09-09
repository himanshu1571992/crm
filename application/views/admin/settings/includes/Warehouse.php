<div class="tab-content">
	<div role="tabpanel" class="tab-pane active" id="email_config">
		<h4><?php echo _l('Warehouse'); ?> </h4>
		<hr />
		<?php 
		$designationdata = $this->db->get('tbldesignation')->result_array();
		if(isset($_GET['id']))
		{
		   $this->db->where('id', $_GET['id']);
           $warehousedata= $this->db->get('tblwarehouse')->row();
		   $warehouse = (array) $warehousedata;
		   $this->db->where('warehouse_id', $_GET['id']);
           $warehousepersondata= $this->db->get('tblwarehouseperson')->result_array();
		   $warehouseperson = (array) $warehousepersondata;
		}?>
		<div class="col-md-6">	
			<div class="form-group">
				<label for="name" class="control-label"><?php echo _l('warehouse_name'); ?>*</label>
				<?php if(isset($_GET['id']))?> <input type="hidden" id="warehouseid" name="warehouseid" class="form-control" value="<?php if(isset($_GET['id'])){echo $_GET['id']; }?>">
				<input type="text" id="name" name="warehouse[name]" required="" class="form-control" value="<?php echo (isset($warehouse['name']) && $warehouse['name'] != "") ? $warehouse['name'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="cont_no_1" class="control-label"><?php echo _l('warehouse_number_1'); ?>*</label>
				<input type="text" id="cont_no_1" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="10" maxlength="10" name="warehouse[cont_no_1]"  required=""class="form-control" value="<?php echo (isset($warehouse['cont_no_1']) && $warehouse['cont_no_1'] != "") ? $warehouse['cont_no_1'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="cont_no_2" class="control-label"><?php echo _l('warehouse_number_2'); ?></label>
				<input type="text" id="cont_no_2" onkeypress="return (event.charCode !=8 && event.charCode ==0 || (event.charCode >= 48 && event.charCode <= 57))" minlength="10" maxlength="10" name="warehouse[cont_no_2]" class="form-control" value="<?php echo (isset($warehouse['cont_no_2']) && $warehouse['cont_no_2'] != "") ? $warehouse['cont_no_2'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="cont_name" class="control-label"><?php echo _l('Contact Person Name '); ?></label>
				<input type="text" id="cont_name" name="warehouse[cont_name]" class="form-control" value="<?php echo (isset($warehouse['cont_name']) && $warehouse['cont_name'] != "") ? $warehouse['cont_name'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="state_id" class="control-label"><?php echo _l('warehouse_state'); ?>*</label>
				<select class="form-control selectpicker" required="" id="state" name="warehouse[state]" onchange="get_city_by_state(this.value)" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($state_data) && count($state_data) > 0) {
						foreach ($state_data as $state_key => $state_value) 
						{?>
							<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($warehouse['state']) && $warehouse['state'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
					<?php
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="landmark" class="control-label"><?php echo _l('warehouse_landmark'); ?>*</label>
				<input type="text" id="landmark" required="" name="warehouse[landmark]" class="form-control" value="<?php echo (isset($warehouse['landmark']) && $warehouse['landmark'] != "") ? $warehouse['landmark'] : "" ?>">
			</div>
		</div>
		<div class="col-md-6">	
			<div class="form-group">
				<label for="email_id_1" class="control-label"><?php echo _l('warehouse_mail_id_1'); ?>*</label>
				<input type="text" id="email_id_1" name="warehouse[email_id_1]" required="" class="form-control" value="<?php echo (isset($warehouse['email_id_1']) && $warehouse['email_id_1'] != "") ? $warehouse['email_id_1'] : "" ?>">
			</div>
			<div class="form-group">
				<label for="email_id_2" class="control-label"><?php echo _l('warehouse_mail_id_2'); ?></label>
				<input type="text" id="email_id_2" name="warehouse[email_id_2]" class="form-control" value="<?php echo (isset($warehouse['email_id_2']) && $warehouse['email_id_2'] != "") ? $warehouse['email_id_2'] : "" ?>">
			</div>  
			<div class="form-group">
				<label for="address" class="control-label"><?php echo _l('warehouse_address'); ?>*</label>
				<textarea id="address" name="warehouse[address]" required="" class="form-control"><?php echo (isset($warehouse['address']) && $warehouse['address'] != "") ? $warehouse['address'] : "" ?></textarea>
			</div>
			<div class="form-group">
				<label for="city_id" class="control-label"><?php echo _l('warehouse_city'); ?>*</label>
				<select class="form-control selectpicker" id="city_id" name="warehouse[city]" required="" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($city_data) && count($city_data) > 0  ) {
						foreach ($city_data as $city_key => $city_value) {
							?>
							<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($warehouse['city']) && $warehouse['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
							<?php
						}
					}
					else if(isset($warehouse['city']) & $warehouse['city']!='')
					{
						foreach ($allcity as $city_key => $city_value)
						{?>
							<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($warehouse['city']) && $warehouse['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
			<div class="form-group">
				<label for="pincode" class="control-label"><?php echo _l('warehouse_pin_code'); ?> *</label>
				<input type="text" id="pincode" name="warehouse[pincode]" required="" class="form-control" value="<?php echo (isset($warehouse['pincode']) && $warehouse['pincode'] != "") ? $warehouse['pincode'] : "" ?>">
			</div>
		</div> 
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
                                        if (count($warehouseperson) > 0) {
                                            $i = 0;
                                            foreach ($warehouseperson as $singlewarehouseperson) {
                                                $i++;
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" id="staff_id<?php echo $i; ?>" sataff='<?php echo $i; ?>' onChange="staffdata(<?php echo $i; ?>);" name="staffdata[<?php echo $i;?>][staff_id]">
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
                                                        <input type="text" id="email<?php echo $i; ?>" name="staffdata[<?php echo $i;?>][email]" value="<?php echo (isset($singlewarehouseperson['email']) && $singlewarehouseperson['email'] != "") ? $singlewarehouseperson['email'] : "" ?>" class="form-control" >
                                                    </div>
                                                </td>
												<td>
                                                    <div class="form-group">
                                                        <input type="text" id="contno<?php echo $i; ?>" name="staffdata[<?php echo $i;?>][contno]" value="<?php echo (isset($singlewarehouseperson['number']) && $singlewarehouseperson['number'] != "") ? $singlewarehouseperson['number'] : "" ?>" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    
													<div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="designation<?php echo $i; ?>" name="staffdata[<?php echo $i;?>][designation]">
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
                                                        <select class="form-control selectpicker" data-live-search="true" id="staff_id0" sataff='0' onChange="staffdata(0);" name="staffdata[0][staff_id]">
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
                                                        <input type="text" id="email0" name="staffdata[0][email]" class="form-control" >
                                                    </div>
                                                </td>
												<td>
                                                    <div class="form-group">
                                                        <input type="text" id="contno0" name="staffdata[0][contno]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
												<div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="designation0" name="staffdata[0][designation]">
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
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php echo count($warehouseperson); ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
	</div>
	<div role="tabpanel" class="tab-pane" id="email_queue">
		<?php render_yes_no_option('email_queue_enabled','email_queue_enabled','To speed up the emailing process, the system will add the emails in queue and will send them via cron job, make sure that the cron job is properly configured in order to use this feature.'); ?>
		<hr />
		<?php render_yes_no_option('email_queue_skip_with_attachments','email_queue_skip_attachments','Most likely you will encounter problems with the email queue if the system needs to add big files to the queue. If you plan to use this option consult with your server administrator/hosting provider to increase the max_allowed_packet and wait_timeout options in your server config, otherwise when this option is set to yes the system won\'t add emails with attachments in the queue and will be sent immediately.'); ?>
	</div>
</div>

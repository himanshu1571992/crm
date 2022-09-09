<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}</style>
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
      <div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
         <button class="btn btn-info only-save customer-form-submiter">
         Save                    </button>
         <button class="btn btn-info save-and-add-contact customer-form-submiter">
         Save and create contact                        </button>
      </div>
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body">
               <div>
                  <div class="tab-content">
                     <h4 class="customer-profile-group-heading">Profile</h4>
                     <div class="row">
                           <input type="hidden" name="csrf_token_name" value="15b34d86f0ec6f1d9577bdb62af59257">
                           <div class="additional"></div>
                           <div class="col-md-12">
                              <div class="horizontal-scrollable-tabs">
                                 <div class="scroller arrow-left" style="display: none;"><i class="fa fa-angle-left"></i></div>
                                 <div class="scroller arrow-right" style="display: none;"><i class="fa fa-angle-right"></i></div>
                                 <div class="horizontal-tabs">
                                    <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
                                       <li role="presentation" class="active">
                                          <a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab" aria-expanded="false"><?php echo _l('new_enquiry');?></a>
                                       </li>
                                       <li role="presentation" class="">
                                          <a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab" aria-expanded="true"><?php echo _l('existing_enquiry');?> </a>
                                       </li>
                                    </ul>
                                 </div>
                              </div>
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="contact_info">
                                    <div class="col-md-12">
										<h4 class="no-mtop"><?php	if (isset($site_manager['id']))	echo _l('edit_site'); else	echo _l('add_client');?></h4>
										<hr/>
									</div>
									<div class="col-md-12">
										<label class="label-control subHeads add_site_div_new">
										<a class="newsite">Add Site <i class="fa fa-window-restore"></i></a></label>
									</div>
									<div class="sitedv" style="display:none;">
									<?php echo form_open($this->uri->uri_string(), array('id' => 'site_manager-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
									<div >
										<div class="col-md-6">
											<div class="form-group">
												<label for="sitename" class="control-label"><?php echo _l('site_name'); ?> *</label>
												<input type="text" id="sitename" name="name" class="form-control" value="<?php echo (isset($site_manager['name']) && $site_manager['name'] != "") ? $site_manager['name'] : "" ?>" required="">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="sitelocation" class="control-label"><?php echo _l('site_location'); ?> *</label>
												<input type="text" id="sitelocation" name="location" class="form-control" required="" value="<?php echo (isset($site_manager['location']) && $site_manager['location'] != "") ? $site_manager['location'] : "" ?>">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="sitedescription" class="control-label"><?php echo _l('site_description'); ?></label>
											<textarea id="sitedescription" name="description" class="form-control"><?php echo (isset($site_manager['description']) && $site_manager['description'] != "") ? $site_manager['description'] : "" ?></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="siteaddress" class="control-label"><?php echo _l('site_address'); ?> *</label>
											<textarea id="siteaddress" name="address" class="form-control" required=""><?php echo (isset($site_manager['address']) && $site_manager['address'] != "") ? $site_manager['address'] : "" ?></textarea>
										</div>
									</div>
									
									<div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="sitestate_id" class="control-label"><?php echo _l('site_state'); ?></label>
												<select class="form-control selectpicker" id="sitestate_id" name="state_id" onchange="get_city_by_state(this.value)" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($state_data) && count($state_data) > 0) {
														foreach ($state_data as $state_key => $state_value) {
															?>
															<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($site_manager['state_id']) && $site_manager['state_id'] == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="sitecity_id" class="control-label"><?php echo _l('site_city'); ?></label>
												<select class="form-control selectpicker" id="sitecity_id" name="city_id" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($city_data) && count($city_data) > 0) {
														foreach ($city_data as $city_key => $city_value) {
															?>
															<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($site_manager['city_id']) && $site_manager['city_id'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
									
									<div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="sitelandmark" class="control-label"><?php echo _l('site_landmark'); ?></label>
												<input type="text" id="sitelandmark" name="landmark" class="form-control" value="<?php echo (isset($site_manager['landmark']) && $site_manager['landmark'] != "") ? $site_manager['landmark'] : "" ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="sitepincode" class="control-label"><?php echo _l('site_pincode'); ?> *</label>
												<input type="text" id="sitepincode" name="pincode" required="" class="form-control" value="<?php echo (isset($site_manager['pincode']) && $site_manager['pincode'] != "") ? $site_manager['pincode'] : "" ?>">
											</div>
										</div>
									</div>
									<div class="text-left" style="margin-bottom:10px;">
									<button class="btn btn-success addsite" type="button"><?php echo _l('add_site'); ?></button>
								</div>
								</div>
								<?php echo form_close(); ?>
							<?php echo form_open($this->uri->uri_string(), array('id' => 'enquiry-form', 'class' => 'enquiry-form', 'enctype' => 'multipart/form-data')); ?>
								<div class="row">
									
								  
								
								
									
									<div class="col-md-6">
										<div class="form-group">
											<label for="enquiry_type_id" class="control-label"><?php echo _l('enquiry_type'); ?>*</label>
											<select class="form-control selectpicker" required="" id="enquiry_type_id" name="enquiry[enquiry_type_id]" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($enquiry_type) && count($enquiry_type) > 0) {
													foreach ($enquiry_type as $enquiry_type_key => $enquiry_type_value) 
													{?>
														<option value="<?php echo $enquiry_type_value['id'] ?>" <?php echo (isset($client['state']) && $client['state'] == $enquiry_type_value['id']) ? 'selected' : "" ?>><?php echo $enquiry_type_value['name'] ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="company" class="control-label"><?php echo _l('client_name'); ?>*</label>
											<input type="text" id="company" name="clients[company]" required="" class="form-control" value="<?php echo (isset($client['company']) && $client['company'] != "") ? $client['company'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="phone_no_1" class="control-label"><?php echo _l('client_number1'); ?>*</label>
											<input type="text" id="phone_no_1" name="clients[phone_no_1]" required="" class="form-control" value="<?php echo (isset($client['phone_no_1']) && $client['phone_no_1'] != "") ? $client['phone_no_1'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="phone_no_2" class="control-label"><?php echo _l('client_number2'); ?></label>
											<input type="text" id="phone_no_2" name="clients[phone_no_2]" class="form-control" value="<?php echo (isset($client['phone_no_2']) && $client['phone_no_2'] != "") ? $client['phone_no_2'] : "" ?>">
										</div>

										<div class="form-group">
											<label for="website" class="control-label"><?php echo _l('client_web'); ?></label>
											<input type="text" id="website" name="clients[website]" class="form-control" value="<?php echo (isset($client['website']) && $client['website'] != "") ? $client['website'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="address" class="control-label"><?php echo _l('Address'); ?>*</label>
											<textarea id="address" name="clients[address]" required="" class="form-control"><?php echo (isset($client['address']) && $client['address'] != "") ? $client['address'] : "" ?></textarea>
										</div>
										
										<div class="form-group">
											<label for="state_id" class="control-label"><?php echo _l('site_state'); ?>*</label>
											<select class="form-control selectpicker" required="" id="clientstate" name="clients[state]" onchange="get_city_by_stateid(this.value)" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($state_data) && count($state_data) > 0) {
													foreach ($state_data as $state_key => $state_value) 
													{?>
														<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($client['state']) && $client['state'] == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="landmark" class="control-label"><?php echo _l('client_landmark'); ?>*</label>
											<input type="text" id="landmark" required="" name="clients[landmark]" class="form-control" value="<?php echo (isset($client['landmark']) && $client['landmark'] != "") ? $client['landmark'] : "" ?>">
										</div>
									</div>
									<div class="col-md-6">	
										<div class="form-group">
											<label for="location" class="control-label"><?php echo _l('client_loc'); ?>*</label>
											<input type="text" id="location" name="clients[location]" class="form-control" required="" value="<?php echo (isset($client['location']) && $client['location'] != "") ? $client['location'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="email_id" class="control-label"><?php echo _l('client_mail'); ?>*</label>
											<input type="text" id="email_id" name="clients[email_id]" class="form-control" required="" value="<?php echo (isset($client['email_id']) && $client['email_id'] != "") ? $client['email_id'] : "" ?>">
										</div> 
										<div class="form-group">
											<label for="client_cat_id" class="control-label"><?php echo _l('client_cat'); ?>*</label>
											<select class="form-control selectpicker" data-live-search="true" required="" id="client_cat_id" name="clients[client_cat_id]">
												<option value=""></option>
												<?php
												if (isset($client_category_data) && count($client_category_data) > 0) {
													foreach ($client_category_data as $client_category_key => $client_category_value) {
														?>
														<option value="<?php echo $client_category_value['id'] ?>" <?php  echo (isset($client['client_cat_id']) && $client['client_cat_id'] == $client_category_value['id']) ? 'selected' : "" ?>><?php echo $client_category_value['category_name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="pan_no" class="control-label"><?php echo _l('client_pan'); ?></label>
											<input type="text" id="pan_no" name="clients[pan_no]" class="form-control" value="<?php echo (isset($client['pan_no']) && $client['pan_no'] != "") ? $client['pan_no'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="vat" class="control-label"><?php echo _l('client_gst'); ?></label>
											<input type="text" id="vat" name="clients[vat]" class="form-control"  value="<?php echo (isset($client['vat']) && $client['vat'] != "") ? $client['vat'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="cin_no" class="control-label"><?php echo _l('client_cin_no'); ?>*</label>
											<input type="text" id="cin_no" name="clients[cin_no]" class="form-control" required="" value="<?php echo (isset($client['cin_no']) && $client['cin_no'] != "") ? $client['cin_no'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="city_id" class="control-label"><?php echo _l('site_city'); ?>*</label>
											<select class="form-control selectpicker" id="clientclity" name="clients[city]" required="" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($city_data) && count($city_data) > 0  ) {
													foreach ($city_data as $city_key => $city_value) {
														?>
														<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($client['city']) && $client['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
														<?php
													}
												}
												else if(isset($client['city']) & $client['city']!='')
												{
													foreach ($allcity as $city_key => $city_value)
													{?>
														<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($client['city']) && $client['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="zip" class="control-label"><?php echo _l('client_postal_code'); ?> *</label>
											<input type="text" id="zip" name="clients[zip]" required="" class="form-control" value="<?php echo (isset($client['zip']) && $client['zip'] != "") ? $client['zip'] : "" ?>">
										</div>
									</div> 
									<div class="btn-bottom-toolbar text-right">
										<button class="btn btn-info" type="submit">
											<?php echo _l('submit'); ?>
										</button>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-12">
										<h4 class="no-mtop mrg3"><?php if (isset($site_manager['id']))	echo _l('edit_site_details'); else	echo _l('add_site_details');?></h4>
										<hr/>
									</div>
									
									<div class="clientsite">
										 <div class="col-md-6">
											<div class="form-group">
												<label for="site_id" class="control-label"><?php echo _l('site_name'); ?></label>
												<select class="form-control selectpicker" id="site_id" name="enquiry[site_id]" onchange="get_city_by_state(this.value)" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($all_site) && count($all_site) > 0) {
														foreach ($all_site as $site_key => $site_value) {
															?>
															<option value="<?php echo $site_value['id'] ?>" <?php echo (isset($site_manager['state_id']) && $site_manager['state_id'] == $site_value['id']) ? 'selected' : "" ?>><?php echo $site_value['name'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div> 

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_location" class="control-label"><?php echo _l('site_location'); ?> *</label>
												<input type="text" id="site_location" name="site[location]" class="form-control" readonly required="" value="<?php echo (isset($site_manager['location']) && $site_manager['location'] != "") ? $site_manager['location'] : "" ?>">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="site_description" class="control-label"><?php echo _l('site_description'); ?></label>
											<textarea id="site_description" name="site[description]" readonly class="form-control"><?php echo (isset($site_manager['description']) && $site_manager['description'] != "") ? $site_manager['description'] : "" ?></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="site_address" class="control-label"><?php echo _l('site_address'); ?> *</label>
											<textarea id="site_address" name="site[address]" readonly class="form-control" required=""><?php echo (isset($site_manager['address']) && $site_manager['address'] != "") ? $site_manager['address'] : "" ?></textarea>
										</div>
									</div>
									
									<div>
									   
										
										<div class="col-md-6">
											<div class="form-group">
												<label for="site_state_id" class="control-label"><?php echo _l('site_state'); ?></label>
												<select class="form-control selectpicker" id="site_state_id" readonly name="site[state_id]" onchange="get_city_by_state(this.value)" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($state_data) && count($state_data) > 0) {
														foreach ($state_data as $state_key => $state_value) {
															?>
															<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($site_manager['state_id']) && $site_manager['state_id'] == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_city_id" class="control-label"><?php echo _l('site_city'); ?></label>
												<select class="form-control selectpicker" id="site_city_id" readonly name="site[city_id]" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($all_city_data) && count($all_city_data) > 0) {
														foreach ($all_city_data as $all_city_key => $all_city_value) {
															?>
															<option value="<?php echo $all_city_value['id'] ?>" <?php echo (isset($site_manager['city_id']) && $site_manager['city_id'] == $all_city_value['id']) ? 'selected' : "" ?>><?php echo $all_city_value['name'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div>
									</div>
									
									<div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="site_landmark" class="control-label"><?php echo _l('site_landmark'); ?></label>
												<input type="text" id="site_landmark" name="site[landmark]" readonly class="form-control" value="<?php echo (isset($site_manager['landmark']) && $site_manager['landmark'] != "") ? $site_manager['landmark'] : "" ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_pincode" class="control-label"><?php echo _l('site_pincode'); ?> *</label>
												<input type="text" id="site_pincode" name="site[pincode]" readonly required="" class="form-control" value="<?php echo (isset($site_manager['pincode']) && $site_manager['pincode'] != "") ? $site_manager['pincode'] : "" ?>">
											</div>
										</div>
									</div>
									
								</div>
								<div class="col-md-12">
									<h4 class="no-mtop mrg3"><?php echo _l('add_client_person');?></h4>
									<hr/>
								</div>
								<div class="table-responsive s_table">
										<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
											<thead>
												<tr>
													<th width="20%" align="left"><?php echo _l('name');?></th>
													<th width="20%" class="qty" align="left"><?php echo _l('email');?></th>
													<th width="20%" align="left"><?php echo _l('number');?>	</th>
													<th width="20%" align="left"><?php echo _l('designation');?>	</th>
													<th width="20%" align="left"><?php echo _l('type');?>	</th>
													<th width="10%"  align="center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody class="ui-sortable">
												<tr class="main" id="tr0">
													<td>
														<div class="form-group">
															<input type="text" id="firstname" name="clientdata[0][firstname]" class="form-control" >
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="text" id="email" name="clientdata[0][email]" class="form-control" >
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="text" id="phonenumber" name="clientdata[0][phonenumber]" class="form-control">
														</div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[0][designation_id]">
																<option value=""></option>
																<?php
																if (isset($designation_data) && count($designation_data) > 0) {
																	foreach ($designation_data as $designation_key => $designation_value) {
																		?>
																		<option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[0][designation_id]">
																<option value=""></option>
																<?php
																if (isset($contact_type_data) && count($contact_type_data) > 0) {
																	foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
																		?>
																		<option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('0');" ><i class="fa fa-remove"></i></button>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="col-xs-12">
											<label class="label-control subHeads"><a  class="addmore" value="<?php echo count($productcomponent); ?>">Add More <i class="fa fa-plus"></i></a></label>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group date">
											<label for="enquiry_date" class="control-label"><?php echo _l('enquiry_date'); ?>*</label>
											<input type="text" id="enquiry_date" required="" name="enquiry[enquiry_date]" class="form-control datepicker" value="<?php if(isset($member['joining_date']) && $member['joining_date'] != ""){ echo date('d/m/Y',strtotime($member['joining_date'])); }?>">
										</div>
										<div class="form-group">
											<label for="enquiry_date" class="control-label"><?php echo _l('lead_source'); ?>*</label>
											<select class="form-control selectpicker" data-live-search="true" id="lead_source_id" name="enquiry[lead_source_id]">
												<option value=""></option>
												<?php
												if (isset($all_source) && count($all_source) > 0) {
													foreach ($all_source as $source_key => $source_value) {
														?>
														<option value="<?php echo $source_value['id'] ?>"><?php echo $source_value['name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									
									<div class="col-md-6">
										<div class="form-group date">
											<label for="reminder_date" class="control-label"><?php echo _l('reminder_date'); ?>*</label>
											<input type="text" id="reminder_date" required="" name="enquiry[reminder_date]" class="form-control datepicker" value="<?php if(isset($member['joining_date']) && $member['joining_date'] != ""){ echo date('d/m/Y',strtotime($member['joining_date'])); }?>">
										</div>
										<div class="form-group date">
											<label for="reference" class="control-label"><?php echo _l('reference'); ?>*</label>
											<input type="text" id="reference" required="" name="enquiry[reference]" class="form-control" value="<?php if(isset($member['joining_date']) && $member['joining_date'] != ""){ echo date('d/m/Y',strtotime($member['joining_date'])); }?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="remark" class="control-label"><?php echo _l('remark'); ?> *</label>
											<textarea id="remark" name="enquiry[remark]" class="form-control" required=""><?php echo (isset($site_manager['address']) && $site_manager['address'] != "") ? $site_manager['address'] : "" ?></textarea>
										</div>
									</div>
									<div class="col-md-9">
										<div class="form-group">
											<label for="enquiry_date" class="control-label"><?php echo _l('assigned_to'); ?>*</label>
											<select class="form-control selectpicker" multiple data-live-search="true" id="lead_source_id" name="assign[assignid][]">
												<option>Select</option>
												
                                                <optgroup label="Groups">
												<?php
												if (isset($Staffgroup) && count($Staffgroup) > 0) {
													foreach ($Staffgroup as $Staffgroup_key => $Staffgroup_value) {
														?>
														<option value="<?php echo $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
														<?php
													}
												}
												?>
                                                </optgroup>
												<optgroup label="staff">
												<?php
												if (isset($allStaff) && count($allStaff) > 0) {
													foreach ($allStaff as $Staff_key => $Staff_value) {
														?>
														<option value="<?php echo $Staff_value['staffid'] ?>"><?php echo $Staff_value['firstname'] ?></option>
														<?php
													}
												}
												?>
												</optgroup>
											</select>
										</div>
									</div>
									<div class="col-md-12">
										<h4 class="no-mtop mrg3"><?php echo _l('product_enquiry');?></h4>
										<hr/>
									</div>
								<div class="table-responsive s_table">
										<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
											<thead>
												<tr>
													<th width="20%" align="left"><?php echo _l('product_name');?></th>
													<th width="20%" class="qty" align="left"><?php echo _l('product_remarks');?></th>
													<th width="20%" align="left"><?php echo _l('quantity_as_qty');?>	</th>
													<th width="20%" align="left"><?php echo _l('enquiry_for');?>	</th>
													<th width="20%" align="left"><?php echo _l('remark');?>	</th>
													<th width="10%"  align="center"><i class="fa fa-cog"></i></th>
												</tr>
											</thead>
											<tbody class="ui-sortable">
												<tr class="main" id="tre0">
													<td>
														<div class="form-group">
															<input type="text" id="product_id" name="proenqdata[0][product_id]" class="form-control" >
														</div>
													</td>
													<td>
														<div class="form-group">
															<textarea id="product_remarks" name="proenqdata[0][product_remarks]" class="form-control" ></textarea>
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="text" id="qty" name="proenqdata[0][qty]" class="form-control">
														</div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="enquiry_for_id" name="proenqdata[0][enquiry_for_id]">
																<option value=""></option>
																<?php
																if (isset($enquiry_for) && count($enquiry_for) > 0) {
																	foreach ($enquiry_for as $enquiry_for_key => $enquiry_for_value) {
																		?>
																		<option value="<?php echo $enquiry_for_value['id'] ?>"><?php echo $enquiry_for_value['name'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<div class="form-group">
															<div class="form-group">
																<textarea id="remarks" name="proenqdata[0][remarks]" class="form-control" ></textarea>
															</div>
														</div>
													</td>
													<td>
														<button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('0');" ><i class="fa fa-remove"></i></button>
													</td>
												</tr>
											</tbody>
										</table>
										<div class="col-xs-12">
											<label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo count($productcomponent); ?>">Add More <i class="fa fa-plus"></i></a></label>
										</div>
									</div>
                                 </div>
                                 <div role="tabpanel" class="tab-pane " id="billing_and_shipping">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="row">
                                             <div class="col-md-6">
                                                <h4 class="no-mtop mrg3">Billing Address <a href="#" class="pull-right billing-same-as-customer"><small class="font-medium-xs">Same as Customer Info</small></a></h4>
                                                <hr>
                                                <div class="form-group" app-field-wrapper="billing_street"><label for="billing_street" class="control-label">Street</label><textarea id="billing_street" name="billing_street" class="form-control" rows="4"></textarea></div>
                                                <div class="form-group" app-field-wrapper="billing_city"><label for="billing_city" class="control-label">City</label><input type="text" id="billing_city" name="billing_city" class="form-control" value=""></div>
                                                <div class="form-group" app-field-wrapper="billing_state"><label for="billing_state" class="control-label">State</label><input type="text" id="billing_state" name="billing_state" class="form-control" value=""></div>
                                                <div class="form-group" app-field-wrapper="billing_zip"><label for="billing_zip" class="control-label">Zip Code</label><input type="text" id="billing_zip" name="billing_zip" class="form-control" value=""></div>
                                                <div class="form-group" app-field-wrapper="billing_country">
                                                   <label for="billing_country" class="control-label">Country</label>
                                                   <div class="dropdown bootstrap-select" style="width: 100%;">
                                                      <select id="billing_country" name="billing_country" class="selectpicker" data-none-selected-text="Nothing selected" data-width="100%" data-live-search="true" tabindex="-98">
                                                         <option value=""></option>
                                                      </select>
                                                      <button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" role="button" data-id="billing_country" title="Nothing selected">
                                                         <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                               <div class="filter-option-inner-inner">Nothing selected</div>
                                                            </div>
                                                         </div>
                                                         <span class="bs-caret"><span class="caret"></span></span>
                                                      </button>
                                                      <div class="dropdown-menu open" role="combobox">
                                                         <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                                         <div class="inner open" role="listbox" aria-expanded="false" tabindex="-1">
                                                            <ul class="dropdown-menu inner "></ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                             <div class="col-md-6">
                                                <h4 class="no-mtop mrg3">
                                                   <i class="fa fa-question-circle" data-toggle="tooltip" data-title="Do not fill shipping address information if you won't use shipping address on customer invoices"></i>
                                                   Shipping Address <a href="#" class="pull-right customer-copy-billing-address"><small class="font-medium-xs">Copy Billing Address</small></a>
                                                </h4>
                                                <hr>
                                                <div class="form-group" app-field-wrapper="shipping_street"><label for="shipping_street" class="control-label">Street</label><textarea id="shipping_street" name="shipping_street" class="form-control" rows="4"></textarea></div>
                                                <div class="form-group" app-field-wrapper="shipping_city"><label for="shipping_city" class="control-label">City</label><input type="text" id="shipping_city" name="shipping_city" class="form-control" value=""></div>
                                                <div class="form-group" app-field-wrapper="shipping_state"><label for="shipping_state" class="control-label">State</label><input type="text" id="shipping_state" name="shipping_state" class="form-control" value=""></div>
                                                <div class="form-group" app-field-wrapper="shipping_zip"><label for="shipping_zip" class="control-label">Zip Code</label><input type="text" id="shipping_zip" name="shipping_zip" class="form-control" value=""></div>
                                                <div class="form-group" app-field-wrapper="shipping_country">
                                                   <label for="shipping_country" class="control-label">Country</label>
                                                   <div class="dropdown bootstrap-select" style="width: 100%;">
                                                      <select id="shipping_country" name="shipping_country" class="selectpicker" data-none-selected-text="Nothing selected" data-width="100%" data-live-search="true" tabindex="-98">
                                                         <option value=""></option>
                                                      </select>
                                                      <button type="button" class="btn dropdown-toggle bs-placeholder btn-default" data-toggle="dropdown" role="button" data-id="shipping_country" title="Nothing selected">
                                                         <div class="filter-option">
                                                            <div class="filter-option-inner">
                                                               <div class="filter-option-inner-inner">Nothing selected</div>
                                                            </div>
                                                         </div>
                                                         <span class="bs-caret"><span class="caret"></span></span>
                                                      </button>
                                                      <div class="dropdown-menu open" role="combobox">
                                                         <div class="bs-searchbox"><input type="text" class="form-control" autocomplete="off" role="textbox" aria-label="Search"></div>
                                                         <div class="inner open" role="listbox" aria-expanded="false" tabindex="-1">
                                                            <ul class="dropdown-menu inner "></ul>
                                                         </div>
                                                      </div>
                                                   </div>
                                                </div>
                                             </div>
                                          </div>
                                       </div>
                                    </div>
                                 </div>
                              </div>
                           </div>
                     </div>
                     <div class="modal fade" id="customer_group_modal" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
                        <div class="modal-dialog" role="document">
                           <div class="modal-content">
                              <div class="modal-header">
                                 <button group="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">×</span></button>
                                 <h4 class="modal-title" id="myModalLabel">
                                    <span class="edit-title">Edit Customer Group</span>
                                    <span class="add-title">Add New Customer Group</span>
                                 </h4>
                              </div>
                              <form action="http://localhost/CRMSchach/admin/clients/group" id="customer-group-modal" method="post" accept-charset="utf-8" novalidate="novalidate">
                                 <input type="hidden" name="csrf_token_name" value="15b34d86f0ec6f1d9577bdb62af59257">
                                 <div class="modal-body">
                                    <div class="row">
                                       <div class="col-md-12">
                                          <div class="form-group" app-field-wrapper="name"><label for="name" class="control-label"> <small class="req text-danger">* </small>Name</label><input type="text" id="name" name="name" class="form-control" value=""></div>
                                          <input type="hidden" name="id" value="">
                                       </div>
                                    </div>
                                 </div>
                                 <div class="modal-footer">
                                    <button group="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                    <button group="submit" class="btn btn-info">Save</button>
                                 </div>
                              </form>
                           </div>
                        </div>
                     </div>
                     <script>
                        window.addEventListener('load',function(){
                           _validate_form($('#customer-group-modal'), {
                            name: 'required'
                        }, manage_customer_groups);
                        
                           $('#customer_group_modal').on('show.bs.modal', function(e) {
                            var invoker = $(e.relatedTarget);
                            var group_id = $(invoker).data('id');
                            $('#customer_group_modal .add-title').removeClass('hide');
                            $('#customer_group_modal .edit-title').addClass('hide');
                            $('#customer_group_modal input[name="id"]').val('');
                            $('#customer_group_modal input[name="name"]').val('');
                            // is from the edit button
                            if (typeof(group_id) !== 'undefined') {
                                $('#customer_group_modal input[name="id"]').val(group_id);
                                $('#customer_group_modal .add-title').addClass('hide');
                                $('#customer_group_modal .edit-title').removeClass('hide');
                                $('#customer_group_modal input[name="name"]').val($(invoker).parents('tr').find('td').eq(0).text());
                            }
                        });
                        });
                        function manage_customer_groups(form) {
                            var data = $(form).serialize();
                            var url = form.action;
                            $.post(url, data).done(function(response) {
                                response = JSON.parse(response);
                                if (response.success == true) {
                                    if($.fn.DataTable.isDataTable('.table-customer-groups')){
                                        $('.table-customer-groups').DataTable().ajax.reload();
                                    }
                                    if($('body').hasClass('dynamic-create-groups') && typeof(response.id) != 'undefined') {
                                        var groups = $('select[name="groups_in[]"]');
                                        groups.prepend('<option value="'+response.id+'">'+response.name+'</option>');
                                        groups.selectpicker('refresh');
                                    }
                                    alert_float('success', response.message);
                                }
                                $('#customer_group_modal').modal('hide');
                            });
                            return false;
                        }
                        
                     </script>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <div class="btn-bottom-pusher"></div>
</div>
</div>
<?php init_tail(); ?>


<script type="text/javascript">
	$('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="clientdata['+newaddmore+'][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="email" name="clientdata['+newaddmore+'][email]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="phonenumber" name="clientdata['+newaddmore+'][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($contact_type_data) && count($contact_type_data) > 0) {foreach ($contact_type_data as $contact_type_key => $contact_type_value) {?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
    });
	
	$('.addmoreproenq').click(function ()
    {
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', addmoreproenq);
        $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><div class="form-group"><input type="text" id="product_id" name="proenqdata['+newaddmoreproenq+'][product_id]" class="form-control" ></div></td><td><div class="form-group"><textarea id="product_remarks" name="proenqdata['+newaddmoreproenq+'][product_remarks]" class="form-control" ></textarea></div></td><td><div class="form-group"><input type="text" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" id="enquiry_for_id" style="display:block !important;" name="proenqdata['+newaddmoreproenq+'][enquiry_for_id]"><option value=""></option><?php if (isset($enquiry_for) && count($enquiry_for) > 0) {foreach ($enquiry_for as $enquiry_for_key => $enquiry_for_value) {?><option value="<?php echo $enquiry_for_value['id'] ?>"><?php echo $enquiry_for_value['name'] ?></option><?php }}?></select></div></td><td><div class="form-group"><div class="form-group"><textarea id="remarks" name="proenqdata['+newaddmoreproenq+'][remarks]" class="form-control" ></textarea></div></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td></tr>');
    });
	function removeclientperson(procompid)
    {
        $('#tr' + procompid).remove();
    }
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
	$('.newsite').click(function(){
		$('.sitedv').fadeToggle();
	});
	$('.addsite').click(function()
	{
		var sitename=$('#sitename').val();
		var sitelocation=$('#sitelocation').val();
		var siteaddress=$('#siteaddress').val();
		var sitelandmark=$('#sitelandmark').val();
		var sitepincode=$('#sitepincode').val();
		if(sitename!='' & sitelocation!='' & siteaddress!='' & sitelandmark!='' & sitepincode!='')
		{
			var form = document.getElementById('site_manager-form');
			var data = new FormData(form);
			data.append('newsitemanager','1');
			var html = '<option value=""></option>';
			$.ajax({
						url:'<?php echo base_url(); ?>admin/Site_manager/site_manager',				
						type:'post',
						data: data,
						processData: false,  
						contentType: false ,  					
						success:function(result)
								{
									var resArr = $.parseJSON(result);
						
									$.each(resArr, function(k, v) {
										html+= '<option value="'+v.id+'">'+v.name+'</option>';
									});
									$("#site_id").html('').html(html);
									$('.selectpicker').selectpicker('refresh');
									$("#site_manager-form")[0].reset();
									$('#sitename').removeClass('error');
									$('#sitelocation').removeClass('error');
									$('#siteaddress').removeClass('error');
									$('#sitelandmark').removeClass('error');
									$('#sitepincode').removeClass('error');
									$('.sitedv').toggle();
								}
								
				});
		}
		else
		{
			if(sitename=='')
			{
				$('#sitename').addClass('error');
			}
			else
			{
				$('#sitename').removeClass('error');
			}
			if(sitelocation=='')
			{
				$('#sitelocation').addClass('error');
			}
			else
			{
				$('#sitelocation').removeClass('error');
			}
			if(siteaddress=='')
			{
				$('#siteaddress').addClass('error');
			}
			else
			{
				$('#siteaddress').removeClass('error');
			}
			if(sitelandmark=='')
			{
				$('#sitelandmark').addClass('error');
			}
			else
			{
				$('#sitelandmark').removeClass('error');
			}
			if(sitepincode=='')
			{
				$('#sitepincode').addClass('error');
			}
			else
			{
				$('#sitepincode').removeClass('error');
			}
		}
	});
	function get_city_by_stateid(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#clientclity").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#clientclity").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	function get_city_by_state(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#city_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#city_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	$('#site_id').change(function(){
		var site_id=$('#site_id').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
		$.post(url,
				{
					site_id: site_id,
				},
				function (data, status) {
					var res=JSON.parse(data);
					$('#site_location').val(res.location);
					$('#site_description').val(res.description);
					$('#site_address').val(res.address);
					$('#site_state_id').val(res.state_id);
					$('#site_city_id').val(res.city_id);
					$('#site_landmark').val(res.landmark);
					$('#site_pincode').val(res.pincode);
				});
		
	});
</script>

</body>
</html>

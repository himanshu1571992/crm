<?php init_head(); $date=date('d/m/Y');?>
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
                     <h4 class="customer-profile-group-heading"><?php echo _l('enquiry');?></h4>
                     <div class="row">
                           <input type="hidden" name="csrf_token_name" value="15b34d86f0ec6f1d9577bdb62af59257">
                           <div class="additional"></div>
                           <div class="col-md-12">
                              <!--<div class="horizontal-scrollable-tabs">
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
                              </div>-->
                              <div class="tab-content">
                                 <div role="tabpanel" class="tab-pane active" id="contact_info">
                                    <div class="col-md-12">
										<h4 class="no-mtop"><?php	if (isset($lead['id']))	echo _l('edit_client'); else	echo _l('add_client');?></h4>
										<hr/>
									</div>
									
								
							<?php echo form_open($this->uri->uri_string(), array('id' => 'enquiry-form', 'class' => 'enquiry-form', 'enctype' => 'multipart/form-data')); ?>
								<div class="row">
									
									<div class="col-md-6">
										<!--<div class="form-group">
											<label for="leadname" class="control-label"><?php echo _l('name'); ?></label>
											<input type="text" id="leadname" name="enquiry[name]" class="form-control" value="<?php echo (isset($lead['name']) && $lead['name'] != "") ? $lead['name'] : "" ?>">
										</div>-->
 
										<div class="form-group">
											<label for="enquiry_type_id" class="control-label"><?php echo _l('enquiry_type'); ?></label>
											<select class="form-control selectpicker" id="enquiry_type_id" name="enquiry[enquiry_type_id]" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($enquiry_type) && count($enquiry_type) > 0) {
													foreach ($enquiry_type as $enquiry_type_key => $enquiry_type_value) 
													{?>
														<option value="<?php echo $enquiry_type_value['id'] ?>" <?php echo (isset($lead['enquiry_type_id']) && $lead['enquiry_type_id'] == $enquiry_type_value['id']) ? 'selected' : "" ?>><?php echo $enquiry_type_value['name'] ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
										
										
										<!--<div class="form-group">
											<label for="client_branch_name" class="control-label"><?php echo _l('client_name'); ?></label>
											<input type="text" id="client_branch_name" name="clients[client_branch_name]" class="form-control" value="<?php echo (isset($client['company']) && $client['company'] != "") ? $client['company'] : "" ?>">
										</div>-->
										<div class="form-group">
											<label for="phone_no_1" class="control-label"><?php echo _l('client_number1'); ?></label>
											<input type="text" id="phone_no_1" name="clients[phone_no_1]" class="form-control" value="<?php echo (isset($lead['phonenumber']) && $lead['phonenumber'] != "") ? $lead['phonenumber'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="phone_no_2" class="control-label"><?php echo _l('client_number2'); ?></label>
											<input type="text" id="phone_no_2" name="clients[phone_no_2]" class="form-control" value="<?php echo (isset($lead['phonenumber2']) && $lead['phonenumber2'] != "") ? $lead['phonenumber2'] : "" ?>">
										</div>

										<div class="form-group">
											<label for="website" class="control-label"><?php echo _l('client_web'); ?></label>
											<input type="text" id="website" name="clients[website]" class="form-control" value="<?php echo (isset($lead['website']) && $lead['website'] != "") ? $lead['website'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="address" class="control-label"><?php echo _l('Address'); ?></label>
											<textarea id="address" style="height: 110px;" name="clients[address]" class="form-control"><?php echo (isset($lead['address']) && $lead['address'] != "") ? $lead['address'] : "" ?></textarea>
										</div>
										
										<div class="form-group">
											<label for="state_id" class="control-label"><?php echo _l('site_state'); ?></label>
											<select class="form-control selectpicker" id="clientstate" name="clients[state]" onchange="get_city_by_stateid(this.value)" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($state_data) && count($state_data) > 0) {
													foreach ($state_data as $state_key => $state_value) 
													{?>
														<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($lead['state']) && $lead['state'] == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
												<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="landmark" class="control-label"><?php echo _l('client_landmark'); ?></label>
											<input type="text" id="landmark" name="clients[landmark]" class="form-control" value="<?php echo (isset($lead['landmark']) && $lead['landmark'] != "") ? $lead['landmark'] : "" ?>">
										</div>
									</div>
									<div class="col-md-6">	
									
										<!--<div class="form-group">
											<label for="leadtitle" class="control-label"><?php echo _l('lead_title'); ?></label>
											<input type="text" id="leadtitle" name="enquiry[title]" class="form-control" value="<?php echo (isset($lead['title']) && $lead['title'] != "") ? $lead['title'] : "" ?>">
										</div>-->
									
										<!--<div class="form-group">
											<label for="company" class="control-label" style="width:100%;"><?php echo _l('company'); ?><a href="#" onclick="new_new_comp();" class="inline-field-new" style="float:right;"><i class="fa fa-plus"></i>add new company</a></label>
											<select class="form-control selectpicker cmp" id="company" name="clients[client_id]" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($client_data) && count($client_data) > 0) {
													foreach ($client_data as $client_key => $client_value) 
													{?>
														<option value="<?php echo $client_value['userid'] ?>" ><?php echo $client_value['company'].' - '.$client_value['email_id']; ?></option>
												<?php
													}
												}
												?>
											</select>
											<div class="compdv" style="display:none;">
												<input type="text" id="compnyname" class="form-control" style="width: 90%;float:left;margin-bottom: 2%;">
												<div class="input-group-addon" style="opacity: 1;height: 36px;width: 10%;"><a href="#" onclick="addcomp();" class="inline-field-new"><i class="fa fa-plus"></i></a></div>
											</div>
										</div>-->
										<div style="margin-bottom:2%;">
												<label for="companybranch" class="control-label" style="width:100%;"><?php echo _l('client'); ?><a href="#" onclick="new_new_comp_branch();" class="inline-field-new" style="float:right;"><i class="fa fa-plus"></i>add new Client</a></label>
												<select class="form-control selectpicker cmpbranch <?php if(isset($lead['company']) & $lead['company']!=''){?>hide<?php }?>" id="client_branch_id" name="clientbranch[client_branch_id]" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($client_branch_data) && count($client_branch_data) > 0) {
														foreach ($client_branch_data as $client_branch_key => $client_branch_value) 
														{?>
															 <optgroup label="<?php echo $client_branch_value['companyname']; ?>">
															 <?php
															 foreach($client_branch_value['compnybranch'] as $singlevalue)
															 {
															?>
															<option value="<?php echo $singlevalue['userid'] ?>" <?php echo (isset($lead['client_id']) && $lead['client_id'] == $singlevalue['userid']) ? 'selected' : "" ?> ><?php echo $singlevalue['client_branch_name'].' - '.$singlevalue['email_id'] ?></option>
													<?php
															 }?>
															  </optgroup >
															 <?php
														}
													}
													?>
												</select>
											</div>
											
											<div class="compbranchdv " style="margin-top: -2%;<?php if(isset($lead['company']) && $lead['company']==''){?>display:none;<?php }else if(!isset($lead['company'])){echo'display:none;';}?>">
												<input type="text" id="compnybranchname" class="form-control" name="newclient[client_branch_name]" style="margin-bottom: 2%;" value="<?php echo (isset($lead['company']) && $lead['company']!='') ? $lead['company'] : ""?>">
												<!--<div class="input-group-addon" style="opacity: 1;height: 36px;width: 10%;"><a href="#" onclick="addcompbranch();" class="inline-field-new"><i class="fa fa-plus"></i></a></div>-->
											</div>
										
										<div class="form-group">
											<label for="email_id" class="control-label"><?php echo _l('client_mail'); ?></label>
											<input type="text" id="email_id" name="clients[email_id]" class="form-control" value="<?php echo (isset($lead['email']) && $lead['email'] != "") ? $lead['email'] : "" ?>">
										</div> 
										<div class="form-group">
											<label for="client_cat_id" class="control-label"><?php echo _l('client_cat'); ?></label>
											<select class="form-control selectpicker" data-live-search="true" id="client_cat_id" name="clients[client_cat_id]">
												<option value=""></option>
												<?php
												if (isset($client_category_data) && count($client_category_data) > 0) {
													foreach ($client_category_data as $client_category_key => $client_category_value) {
														?>
														<option value="<?php echo $client_category_value['id'] ?>" <?php  echo (isset($lead['company_category']) && $lead['company_category'] == $client_category_value['id']) ? 'selected' : "" ?>><?php echo $client_category_value['category_name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="pan_no" class="control-label"><?php echo _l('client_pan'); ?></label>
											<input type="text" id="pan_no" name="clients[pan_no]" class="form-control" value="<?php echo (isset($lead['pan_no']) && $lead['pan_no'] != "") ? $lead['pan_no'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="vat" class="control-label"><?php echo _l('client_gst'); ?></label>
											<input type="text" id="vat" name="clients[vat]" class="form-control"  value="<?php echo (isset($lead['gst_no']) && $lead['gst_no'] != "") ? $lead['gst_no'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="cin_no" class="control-label"><?php echo _l('client_cin_no'); ?></label>
											<input type="text" id="cin_no" name="clients[cin_no]" class="form-control" value="<?php echo (isset($lead['cin_no']) && $lead['cin_no'] != "") ? $lead['cin_no'] : "" ?>">
										</div>
										<div class="form-group">
											<label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>
											<select class="form-control selectpicker" id="clientclity" name="clients[city]" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($all_city_data) && count($all_city_data) > 0  ) {
													foreach ($all_city_data as $city_key => $city_value) {
														?>
														<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['clientbranch']['city']) && $lead['clientbranch']['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
														<?php
													}
												}
												else if(isset($lead['city']) & $lead['city']!='')
												{
													foreach ($allcity as $city_key => $city_value)
													{?>
														<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['city']) && $lead['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group">
											<label for="zip" class="control-label"><?php echo _l('client_postal_code'); ?> </label>
											<input type="text" id="zip" name="clients[zip]" class="form-control" value="<?php echo (isset($lead['zip']) && $lead['zip'] != "") ? $lead['zip'] : "" ?>">
										</div>
									</div> 
									<div class="btn-bottom-toolbar text-right">
										<button class="btn btn-info" type="submit">
											<?php echo _l('submit'); ?>
										</button>
										
										<button class="btn btn-info" name="send" type="submit">
											<?php echo _l('send_for_approval'); ?>
										</button>
									</div>
								</div>
								<div class="row">
									
									<div class="col-md-12">
										<h4 class="no-mtop mrg3"><?php if (isset($lead['sitedata']['id']))	echo _l('edit_site_details'); else	echo _l('add_site_details');?></h4>
										<hr/>
									</div>
									<div class="col-md-12">
										<label class="label-control subHeads add_site_div_new">
										<a class="newsite">Add Site <i class="fa fa-window-restore"></i></a></label>
									</div>
									<div class="sitedv" style="display:none;">
									<div >
										<div class="col-md-6">
											<div class="form-group">
												<label for="sitename" class="control-label"><?php echo _l('site_name'); ?>* </label>
												<input type="text" id="sitename" name="name" class="form-control" >
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="sitelocation" class="control-label"><?php echo _l('site_location'); ?>* </label>
												<input type="text" id="sitelocation" name="location" class="form-control">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="sitedescription" class="control-label"><?php echo _l('site_description'); ?></label>
											<textarea id="sitedescription" name="description" class="form-control"></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="siteaddress" class="control-label"><?php echo _l('site_address'); ?>* </label>
											<textarea id="siteaddress" name="address" class="form-control" ></textarea>
										</div>
									</div>
									
									<div>
										<div class="col-md-6">
											<div class="form-group">
												<label for="sitestate_id" class="control-label"><?php echo _l('site_state'); ?></label>
												<select class="form-control selectpicker" id="sitestate_id" name="state_id" onchange="get_city_by_stateval(this.value)" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($state_data) && count($state_data) > 0) {
														foreach ($state_data as $state_key => $state_value) {
															?>
															<option value="<?php echo $state_value['id'] ?>" ><?php echo $state_value['name'] ?></option>
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
															<option value="<?php echo $city_value['id'] ?>"><?php echo $city_value['name'] ?></option>
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
												<label for="sitelandmark" class="control-label"><?php echo _l('site_landmark'); ?>*</label>
												<input type="text" id="sitelandmark" name="landmark" class="form-control">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="sitepincode" class="control-label"><?php echo _l('site_pincode'); ?>* </label>
												<input type="text" id="sitepincode" name="pincode" class="form-control" >
											</div>
										</div>
									</div>
									<div class="text-left" style="margin-bottom:10px;">
									<button class="btn btn-success addsite" type="button"><?php echo _l('add_site'); ?></button>
								</div>
								
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
															<option value="<?php echo $site_value['id'] ?>" <?php echo (isset($lead['site_id']) && $lead['site_id'] == $site_value['id']) ? 'selected' : "" ?>><?php echo $site_value['name'] ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
										</div> 

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_location" class="control-label"><?php echo _l('site_location'); ?> </label>
												<input type="text" id="site_location" name="site[location]" class="form-control" readonly value="<?php echo (isset($lead['sitedata']['location']) && $lead['sitedata']['location'] != "") ? $lead['sitedata']['location'] : "" ?>">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="site_description" class="control-label"><?php echo _l('site_description'); ?></label>
											<textarea id="site_description" name="site[description]" readonly class="form-control"><?php echo (isset($lead['sitedata']['description']) && $lead['sitedata']['description'] != "") ? $lead['sitedata']['description'] : "" ?></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="site_address" class="control-label"><?php echo _l('site_address'); ?> </label>
											<textarea id="site_address" name="site[address]" readonly class="form-control" ><?php echo (isset($lead['sitedata']['address']) && $lead['sitedata']['address'] != "") ? $lead['sitedata']['address'] : "" ?></textarea>
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
															<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($lead['sitedata']['state_id']) && $lead['sitedata']['state_id'] == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
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
															<option value="<?php echo $all_city_value['id'] ?>" <?php echo (isset($lead['sitedata']['city_id']) && $lead['sitedata']['city_id'] == $all_city_value['id']) ? 'selected' : "" ?>><?php echo $all_city_value['name'] ?></option>
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
												<input type="text" id="site_landmark" name="site[landmark]" readonly class="form-control" value="<?php echo (isset($lead['sitedata']['landmark']) && $lead['sitedata']['landmark'] != "") ? $lead['sitedata']['landmark'] : "" ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_pincode" class="control-label"><?php echo _l('site_pincode'); ?> </label>
												<input type="text" id="site_pincode" name="site[pincode]" readonly class="form-control" value="<?php echo (isset($lead['sitedata']['pincode']) && $lead['sitedata']['pincode'] != "") ? $lead['sitedata']['pincode'] : "" ?>">
											</div>
										</div>
									</div>
									
								</div>
								<div class="col-md-12">
									<h4 class="no-mtop mrg3"><?php if(isset($contactdata)){echo _l('edit_client_person');}else{echo _l('add_client_person');}?></h4>
									<hr/>
								</div>
								<?php
								if(!isset($contactdata))
								{?>
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
															<input type="text" id="email0" name="clientdata[0][email]" onBlur="checkmail(this.value,0);" class="form-control clientmail" >
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="text" id="phonenumber0" name="clientdata[0][phonenumber]" onBlur="checkcontno(this.value,0);" class="form-control">
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
											<label class="label-control subHeads"><a  class="addmore" value="<?php echo count($productcomponent); ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
										</div>
									</div>
									<?php
								}?>
									<div class="col-md-6">
									<?php
									if(isset($contactdata))
									{
										$k=0;
										foreach($contactdata as $singlecontact)
										{$k++;?>
										<div class="form-group">
											<label for="company" class="control-label">Contact Person Name</label>
											<select class="form-control selectpicker" id="clientcontperson" name="clientexitingdata[<?php echo $k;?>][contactid]" data-live-search="true">
												<option value=""></option>
												<?php
												if (isset($contactall) && count($contactall) > 0) {
													foreach ($contactall as $clientbanchdata_key => $clientbanchdata_value) {
														?>
														<option value="<?php echo $clientbanchdata_value['id'] ?>" <?php echo (isset($singlecontact['id']) && $singlecontact['id'] == $clientbanchdata_value['id']) ? 'selected' : "" ?>><?php echo $clientbanchdata_value['firstname'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<div class="form-group date">
											<label for="contpersonmail" class="control-label">Contact Person Email</label>
											<input type="text" id="contpersonmail" name="clientexitingdata[<?php echo $k;?>][email]" readonly value="<?php if(isset($singlecontact['email']) && $singlecontact['email'] != ""){ echo $singlecontact['email']; }?>" class="form-control" >
										</div>
									<?php
										}
									}?>
										<div class="form-group date">
											<label for="enquiry_date" class="control-label"><?php echo _l('enquiry_date'); ?></label>
											<input type="text" id="enquiry_date" name="enquiry[enquiry_date]" class="form-control datepicker" value="<?php if(isset($lead['enquiry_date']) && $lead['enquiry_date'] != ""){ echo date('d/m/Y',strtotime($lead['enquiry_date'])); }else{echo date('d/m/Y');}?>">
										</div>
										<div class="form-group">
											<label for="enquiry_date" class="control-label"><?php echo _l('lead_source'); ?></label>
											<select class="form-control selectpicker" data-live-search="true" id="source" name="enquiry[source]">
												<option value=""></option>
												<?php
												if (isset($all_source) && count($all_source) > 0) {
													foreach ($all_source as $source_key => $source_value) {
														?>
														<option value="<?php echo $source_value['id'] ?>" <?php echo (isset($lead['source']) && $lead['source'] == $source_value['id']) ? 'selected' : "" ?>><?php echo $source_value['name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div>
									
									<div class="col-md-6">
									<?php
									if(isset($contactdata))
									{
										$l=0;
									 foreach($contactdata as $singlecontact)
									 {$l++;?>
										<div class="form-group date">
											<label for="contpersonnumber" class="control-label">Contact Person Number</label>
											<input type="text" id="contpersonnumber" readonly name="clientexitingdata[<?php echo $l;?>][phonenumber]" value="<?php if(isset($singlecontact['phonenumber']) && $singlecontact['phonenumber'] != ""){ echo $singlecontact['phonenumber']; }?>" class="form-control">
										</div>
										<div class="form-group">
											<label for="contpersondesig" class="control-label"><?php echo _l('designation'); ?></label>
											<select class="form-control selectpicker" name="clientexitingdata[<?php echo $l;?>][designation_id]" readonly data-live-search="true" id="contpersondesig">
												<option value=""></option>
												<?php
												if (isset($designation_data) && count($designation_data) > 0) {
													foreach ($designation_data as $designation_key => $designation_value) {
														?>
														<option value="<?php echo $designation_value['id'] ?>" <?php echo (isset($singlecontact['designation_id']) && $singlecontact['designation_id'] == $designation_value['id']) ? 'selected' : "" ?>><?php echo $designation_value['designation'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
										<?php
										}?>
									<?php
									}
									?>
										<div class="form-group date">
											<label for="reminder_date" class="control-label"><?php echo _l('reminder_date'); ?></label>
											<input type="text" id="reminder_date" name="enquiry[reminder_date]" class="form-control datepicker" value="<?php if(isset($lead['reminder_date']) && $lead['reminder_date'] != ""){ echo date('d/m/Y',strtotime($lead['reminder_date'])); }else{echo date('d/m/Y', strtotime($Date. ' + 2 days'));}?>">
										</div>
										<div class="form-group date">
											<label for="reference" class="control-label"><?php echo _l('reference'); ?></label>
											<input type="text" id="reference" name="enquiry[reference]" class="form-control" value="<?php if(isset($lead['reference']) && $lead['reference'] != ""){ echo $lead['reference']; }?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="remark" class="control-label"><?php echo _l('remark'); ?> </label>
											<textarea id="remark" name="enquiry[remark]" class="form-control" ><?php echo (isset($lead['remark']) && $lead['remark'] != "") ? $lead['remark'] : "" ?></textarea>
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="product_remark" class="control-label"><?php echo _l('product_remark'); ?> </label>
											<textarea id="product_remark" name="enquiry[product_remark]" class="form-control" ><?php echo (isset($lead['product_remark']) && $lead['product_remark'] != "") ? $lead['product_remark'] : "" ?></textarea>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="enquiry_date" class="control-label"><?php echo _l('assigned_to'); ?></label>
											<select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
												<option>Select</option>
												
                                               
												<?php
												if (isset($allStaffdata) && count($allStaffdata) > 0) {
													foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
														?>
														 <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
														<option value="<?php echo 'group'.$Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
														<?php
														foreach($Staffgroup_value['staffs'] as $singstaff)
														{?>
															<option style="margin-left: 3%;" value="<?php echo 'staff'.$singstaff['staffid'] ?>" <?php if(isset($staffassigndata) && in_array($singstaff['staffid'],$staffassigndata)){echo'selected';}?>><?php echo $singstaff['firstname'] ?></option>
														<?php
														}?>
														</optgroup>
													<?php
													}
												}
												?>
												
												<!--<?php
												if (isset($Staffgroup) && count($Staffgroup) > 0) {
													foreach ($Staffgroup as $Staffgroup_key => $Staffgroup_value) {
														?>
														<option value="<?php echo 'group'.$Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
														<?php
													}
												}
												?>
                                                </optgroup>
												<optgroup label="staff list">
												<?php
												if (isset($allStaff) && count($allStaff) > 0) {
													foreach ($allStaff as $Staff_key => $Staff_value) {
														?>
														<option value="<?php echo 'staff'.$Staff_value['staffid'] ?>" data-parent="1"><?php echo $Staff_value['firstname'].' - '.$Staff_value['email']; ?></option>
														<?php
													}
												}
												?>
												</optgroup>-->
											</select>
										</div>
									</div>
									<div class="col-md-6">
										<div class="form-group">
											<label for="status" class="control-label"><?php echo _l('lead_status'); ?></label>
											<select class="form-control selectpicker" data-live-search="true" id="status" name="enquiry[status]">
												<option value=""></option>
												<?php
												if (isset($lead_status) && count($lead_status) > 0) {
													foreach ($lead_status as $lead_status_key => $lead_status_value) {
														?>
														<option value="<?php echo $lead_status_value['id'] ?>" <?php echo (isset($lead['status']) && $lead['status'] == $lead_status_value['id']) ? 'selected' : "" ?>><?php echo $lead_status_value['name'] ?></option>
														<?php
													}
												}
												?>
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
													<th width="5%"  align="center"><i class="fa fa-cog"></i></th>
													<th width="39%" align="left"><?php echo _l('product_name');?></th>
													<th width="17%" class="qty" align="left"><?php echo _l('product_remarks');?></th>
													<th width="10%" align="left"><?php echo _l('quantity_as_qty');?>	</th>
													<th width="17%" align="left"><?php echo _l('enquiry_for');?>	</th>
													<th width="17%" align="left"><?php echo _l('remark');?>	</th>
													
												</tr>
											</thead>
											<tbody class="ui-sortable">
											<?php
											if(isset($productqnq))
											{
												$i=0;
												foreach($productqnq as $singleproenq)
												{
													?>
												<tr class="main" id="tre<?php echo $i;?>">
													<td>
														<button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('<?php echo $i;?>');" ><i class="fa fa-remove"></i></button>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="product_id" name="proenqdata[<?php echo $i;?>][product_id]">
																<option value=""></option>
																<?php
																if (isset($product_data) && count($product_data) > 0) {
																	foreach ($product_data as $product_key => $product_val) {
																		?>
																		<option value="<?php echo $product_val['id']; ?>" <?php echo (isset($singleproenq['product_id']) && $singleproenq['product_id'] == $product_val['id']) ? 'selected' : "" ?>><?php echo $product_val['name'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<div class="form-group">
															<textarea id="product_remarks" name="proenqdata[<?php echo $i;?>][product_remarks]" class="form-control" ><?php if(isset($singleproenq['product_remarks']) && $singleproenq['product_remarks'] != ""){ echo $singleproenq['product_remarks']; }?></textarea>
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="number" id="qty" name="proenqdata[<?php echo $i;?>][qty]" min="1" value="<?php if(isset($singleproenq['qty']) && $singleproenq['qty'] != ""){ echo $singleproenq['qty']; }?>" class="form-control">
														</div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="enquiry_for_id" name="proenqdata[<?php echo $i;?>][enquiry_for_id]">
																<option value=""></option>
																<?php
																if (isset($enquiry_for) && count($enquiry_for) > 0) {
																	foreach ($enquiry_for as $enquiry_for_key => $enquiry_for_value) {
																		?>
																		<option value="<?php echo $enquiry_for_value['id'] ?>" <?php echo (isset($singleproenq['enquiry_for_id']) && $singleproenq['enquiry_for_id'] == $enquiry_for_value['id']) ? 'selected' : "" ?>><?php echo $enquiry_for_value['name'] ?></option>
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
																<textarea id="remarks" name="proenqdata[<?php echo $i;?>][remarks]" class="form-control" ><?php if(isset($singleproenq['remarks']) && $singleproenq['remarks'] != ""){ echo $singleproenq['remarks']; }?></textarea>
															</div>
														</div>
													</td>
													
												</tr>
										<?php
												$i++;}
											}
											else
											{?>
												<tr class="main" id="tre0">
													<td>
														<button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('0');" ><i class="fa fa-remove"></i></button>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="product_id" name="proenqdata[0][product_id]">
																<option value=""></option>
																<?php
																if (isset($product_data) && count($product_data) > 0) {
																	foreach ($product_data as $product_key => $product_value) {
																		?>
																		<option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
															
														</div>
													</td>
													<td>
														<div class="form-group">
															<textarea id="product_remarks" name="proenqdata[0][product_remarks]" class="form-control" ></textarea>
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="number" id="qty" min="1" name="proenqdata[0][qty]" class="form-control">
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
													
												</tr>
												<?php
											}?>
											</tbody>
										</table>
										<div class="col-xs-12">
											<label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo count($productqnq); ?>"><?php echo _l('add_more_product');?> <i class="fa fa-plus"></i></a></label>
										</div>
									</div>
									<?php echo form_close(); ?>
                                 </div>
                                 
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
        $('#myTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="clientdata['+newaddmore+'][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="email'+newaddmore+'" name="clientdata['+newaddmore+'][email]" class="form-control" onBlur="checkmail(this.value,'+newaddmore+');"></div></td><td><div class="form-group"><input type="text" id="phonenumber'+newaddmore+'" onBlur="checkcontno(this.value,'+newaddmore+');" name="clientdata['+newaddmore+'][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($contact_type_data) && count($contact_type_data) > 0) {foreach ($contact_type_data as $contact_type_key => $contact_type_value) {?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	$('.addmoreproenq').click(function ()
    {
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);
        $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="product_id" name="proenqdata['+newaddmoreproenq+'][product_id]"><option value=""></option><?php	if (isset($product_data) && count($product_data) > 0) {foreach ($product_data as $product_key => $product_value) {?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }}?></select></div></td><td><div class="form-group"><textarea id="product_remarks" name="proenqdata['+newaddmoreproenq+'][product_remarks]" class="form-control" ></textarea></div></td><td><div class="form-group"><input type="number" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" id="enquiry_for_id" style="display:block !important;" name="proenqdata['+newaddmoreproenq+'][enquiry_for_id]"><option value=""></option><?php if (isset($enquiry_for) && count($enquiry_for) > 0) {foreach ($enquiry_for as $enquiry_for_key => $enquiry_for_value) {?><option value="<?php echo $enquiry_for_value['id'] ?>"><?php echo $enquiry_for_value['name'] ?></option><?php }}?></select></div></td><td><div class="form-group"><div class="form-group"><textarea id="remarks" name="proenqdata['+newaddmoreproenq+'][remarks]" class="form-control" ></textarea></div></div></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson(procompid)
    {
        $('#tr' + procompid).remove();
    }
	function removeproduct(proid)
    {
        $('#tre' + proid).remove();
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
		var sitestate_id=$('#sitestate_id').val();
		var sitelocation=$('#sitelocation').val();
		var sitedescription=$('#sitedescription').val();
		var siteaddress=$('#siteaddress').val();
		var sitelandmark=$('#sitelandmark').val();
		var sitepincode=$('#sitepincode').val();
		var sitecity_id=$('#sitecity_id').val();
		if(sitename!='' & sitelocation!='' & siteaddress!='' & sitelandmark!='' & sitepincode!='')
		{
			var url = '<?php echo base_url(); ?>admin/Site_manager/site_manager';
			var html = '<option value=""></option>';
			$.post(url,
					{
						newsitemanager: '1',
						name: sitename,
						state_id: sitestate_id,
						location: sitelocation,
						description: sitedescription,
						address: siteaddress,
						landmark: sitelandmark,
						pincode: sitepincode,
						city_id: sitecity_id,
					},
					function (result, status) {
									var resArr = $.parseJSON(result);
									$.each(resArr, function(k, v) {
										html+= '<option value="'+v.id+'">'+v.name+'</option>';
									});
									$("#site_id").html('').html(html);
									$('.selectpicker').selectpicker('refresh');
									$('.sitedv').find('input:text').val('');
									$('.sitedv').fadeToggle();
									$('#sitename').removeClass('error');
									$('#sitelocation').removeClass('error');
									$('#siteaddress').removeClass('error');
									$('#sitelandmark').removeClass('error');
									$('#sitepincode').removeClass('error');
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
	function get_city_by_stateval(state_id) {
        var html = '<option value=""></option>';
        
        if(state_id == "") {
            $("#sitecity_id").html('').html(html);
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
                $("#sitecity_id").html('').html(html);
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
	$('#exsite_id').change(function(){
		var exsite_id=$('#exsite_id').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
		$.post(url,
				{
					site_id: exsite_id,
				},
				function (data, status) {
					var res=JSON.parse(data);
					$('#exsite_location').val(res.location);
					$('#exsite_description').val(res.description);
					$('#exsite_address').val(res.address);
					$('#exsite_state_id').val(res.state_id);
					$('#exsite_city_id').val(res.city_id);
					$('#exsite_landmark').val(res.landmark);
					$('#exsite_pincode').val(res.pincode);
					$('.selectpicker').selectpicker('refresh');
					$('.selectpicker').selectpicker('refresh');
				});
		
	});
	$('#client_branch_id').change(function(){
		var client_branch_id=$('#client_branch_id').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getclientbranchdetails';
		$.post(url,
				{
					client_branch_id: client_branch_id,
				},
				function (data, status) {
					var res=JSON.parse(data);
					$('#email_id').val(res.email_id);
					$('#phone_no_1').val(res.phone_no_1);
					$('#phone_no_2').val(res.phone_no_2);
					$('#clientstate').val(res.state);
					$('#clientclity').val(res.city);
					$('#landmark').val(res.landmark);
					$('#address').val(res.address);
					$('#cin_no').val(res.cin_no);
					$('#website').val(res.website);
					$('#zip').val(res.zip);
					$('#vat').val(res.vat);
					$('#client_cat_id').val(res.client_cat_id);
					$('.selectpicker').selectpicker('refresh');
				});
		
	});
	$('#clientcontperson').change(function(){
		var contactid=$('#clientcontperson').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getcontpersondetails';
		$.post(url,
				{
					contactid: contactid,
				},
				function (data, status) {
					var res=JSON.parse(data);
					$('#contpersonnumber').val(res.phonenumber);
					$('#contpersonmail').val(res.email);
					$('#contpersondesig').val(res.designation_id);
					$('.selectpicker').selectpicker('refresh');
				});
		
	});
	function checkmail(value,id)
	{
		var url = '<?php echo base_url(); ?>admin/Site_manager/checkmail';
		$.post(url,
				{
					clientmail: value,
				},
				function (data, status) {
				var res=JSON.parse(data);
				if(res.totalcontact!=0)
				{
					$('#email'+id).css("cssText", "border-color: red !important;");
				}
				else
				{
					$('#phonenumber'+id).css("cssText", "border-color: none !important;");
				}
				});
	}
	function checkcontno(value,id)
	{
		var url = '<?php echo base_url(); ?>admin/Site_manager/checkcontno';
		$.post(url,
				{
					clientno: value,
				},
				function (data, status) {
				var res=JSON.parse(data);
				if(res.totalcontact!=0)
				{
					$('#phonenumber'+id).css("cssText", "border-color: red !important;");
				}
				else
				{
					$('#phonenumber'+id).css("cssText", "border-color: none !important;");
				}
				});
	}
	$('#client_branch_id').change(function(){
		var client_branch_id=$('#client_branch_id').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getcontactdata';
		 var html = '<option value=""></option>';
		$.post(url,
				{
					client_branch_id: client_branch_id,
				},
				function (data, status) {
					
					if(data != "") {
                    var resArr = $.parseJSON(data);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.firstname+' - '+v.email+'</option>';
                    });
                }
                $("#clientcontperson").html('').html(html);
				$('.selectpicker').selectpicker('refresh');
					
				});
	});
	function new_new_comp()
	{
		$('.cmp').toggle();
		$('.compdv').toggle();
		
	}
	function addcomp()
	{
		var comp_name=$('#compnyname').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/addcomp';
		$.post(url,
				{
					comp_name: comp_name,
				},
				function (data, status) {
					$('.cmp').show();
					$('.compdv').hide();
					$('#company').append(data);
					$('.selectpicker').selectpicker('refresh');
				});
	}
	function new_new_comp_branch()
	{
		$('.cmpbranch').toggle();
		$('.compbranchdv').toggle();
		
	}
	function staffdropdown()
	{
		$.each($("#assign option:selected"), function(){
		   var select=$(this).val();   
		   $("optgroup."+select).children().attr('selected','selected');
        });
		$('.selectpicker').selectpicker('refresh');
		$.each($("#assign option:not(:selected)"), function(){
		   var select=$(this).val();   
		   $("optgroup."+select).children().removeAttr('selected');
		});
		$('.selectpicker').selectpicker('refresh');
	}
	function addcompbranch()
	{
		var comp_branch_name=$('#compnybranchname').val();
		var company=$('#company').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/addcompbranch';
		$.post(url,
				{
					comp_branch_name: comp_branch_name,
					company: company,
				},
				function (data, status) {
					$('.cmpbranch').show();
					$('.compbranchdv').hide();
					$('#client_branch_id').append(data);
					$('.selectpicker').selectpicker('refresh');
				});
	}
	$('#company').change(function()
	{
		var company=$('#company').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getclientbranchdata';
		var html = '<option value=""></option>';
		$.post(url,
				{
					company: company,
				},
				function (data, status)
				{
					if(data != "") {
                    var resArr = $.parseJSON(data);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.userid+'">'+v.client_branch_name+' - '+v.email_id+'</option>';
                    });
                }
                $("#client_branch_id").html('').html(html);
				$('.selectpicker').selectpicker('refresh');
				});
	});
</script>
</body>
</html>

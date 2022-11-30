<?php init_head(); $date=date('d/m/Y');?>
<style>
.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}

.stepwizard-step p {
    margin-top: 10px;
}

.stepwizard-row {
    display: table-row;
}

.stepwizard {
    display: table;
    width: 100%;
    position: relative;
}

.stepwizard-step button[disabled] {
    opacity: 1 !important;
    filter: alpha(opacity=100) !important;
}

.stepwizard-row:before {
    top: 14px;
    bottom: 0;
    position: absolute;
    content: " ";
    width: 100%;
    height: 1px;
    background-color: #ccc;
    z-order: 0;

}

.stepwizard-step {
    display: table-cell;
    text-align: center;
    position: relative;
}

.btn-circle {
  width: 30px;
  height: 30px;
  text-align: center;
  padding: 6px 0;
  font-size: 12px;
  line-height: 1.428571429;
  border-radius: 15px;
}

@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
}
</style>


<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
      <!--<div class="btn-bottom-toolbar btn-toolbar-container-out text-right">
         <button class="btn btn-info only-save customer-form-submiter">Save</button>
         <button class="btn btn-info save-and-add-contact customer-form-submiter">Save and create contact</button>
      </div>-->

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

                              <div class="tab-content">



							<div class="stepwizard">
								<div class="stepwizard-row setup-panel">
									<div class="stepwizard-step">
										<a href="#step-1" type="button" class="btn btn-primary btn-circle">1</a>
										<p><?php if (isset($lead['id']))	echo _l('edit_client'); else	echo _l('add_client');?></p>
									</div>
									<div class="stepwizard-step">
										<a href="#step-2" type="button" class="btn btn-default btn-circle" disabled="disabled">2</a>
										<p><?php if (isset($lead['sitedata']['id']))	echo _l('edit_site_details'); else	echo _l('add_site_details');?></p>
									</div>
									<div class="stepwizard-step">
										<a href="#step-3" type="button" class="btn btn-default btn-circle" disabled="disabled">3</a>
										<p><?php if(isset($contactdata)){echo _l('edit_client_person');}else{echo _l('add_client_person');}?></p>
									</div>
									<div class="stepwizard-step">
										<a href="#step-4" type="button" class="btn btn-default btn-circle" disabled="disabled">4</a>
										<p><?php echo _l('product_enquiry');?></p>
									</div>

								</div>
							</div>
							<?php
                                                        $url = (isset($enquiry_data)) ? admin_url("leads/leads") : $this->uri->uri_string();
                                                        echo form_open($url, array('id' => 'enquiry-form', 'class' => 'enquiry-form', 'enctype' => 'multipart/form-data'));

                                                        ?>
								<div class="row setup-content" id="step-1">
									<div class="col-xs-12">
										<div class="col-md-12">
											<h3><?php if (isset($lead['id']))	echo _l('edit_client'); else	echo _l('add_client');?></h3>
                                                                                        <input type="hidden" name="enquirycall_id" value="<?php echo (isset($enquiry_data)) ? $enquiry_data->id : 0; ?>">

									<div class="row">

										<div class="col-md-6">
											<?php $token = md5(date('Y-m-d H:i:s')); ?>
                                                                                        <input type="hidden" name="form_token" value="<?php echo $token; ?>" />
                                                                                        <div class="form-group">
                                                                                            <label for="enquiry_type_main_id" class="control-label">Main Lead Status</label>
                                                                                            <select class="form-control selectpicker" id="enquiry_type_main_id" name="enquiry[enquiry_type_main_id]" data-live-search="true">
                                                                                                <option value=""></option>
                                                                                                <?php
                                                                                                if (isset($lead_category_list) && count($lead_category_list) > 0) {
                                                                                                    foreach ($lead_category_list as $lead_category_key => $lead_category_value) {
                                                                                                        ?>
                                                                                                        <option value="<?php echo $lead_category_value['id'] ?>" <?php echo (isset($lead['enquiry_type_main_id']) && $lead['enquiry_type_main_id'] == $lead_category_value['id']) ? 'selected' : "" ?>><?php echo cc($lead_category_value['name']); ?></option>
                                                                                                        <?php
                                                                                                    }
                                                                                                }
                                                                                                ?>
                                                                                            </select>
                                                                                        </div>
											<div class="form-group">
												<label for="enquiry_type_id" class="control-label">Sub Lead Status</label>
												<select class="form-control selectpicker" id="enquiry_type_id" name="enquiry[enquiry_type_id]" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($enquiry_type) && count($enquiry_type) > 0) {
														foreach ($enquiry_type as $enquiry_type_key => $enquiry_type_value)
														{?>
															<option value="<?php echo $enquiry_type_value['id'] ?>" <?php echo (isset($lead['enquiry_type_id']) && $lead['enquiry_type_id'] == $enquiry_type_value['id']) ? 'selected' : "" ?>><?php echo cc($enquiry_type_value['name']); ?></option>
													<?php
														}
													}
													?>
												</select>
											</div>


											<div class="form-group">
												<label for="phone_no_1" class="control-label"><?php echo _l('client_number1'); ?></label>
                                                                                                <?php
                                                                                                    $mobile = (isset($lead['phonenumber']) && $lead['phonenumber'] != "") ? $lead['phonenumber'] : "";
                                                                                                    if (isset($enquiry_data) && (!empty($enquiry_data->mobile))) {
                                                                                                        $mobile = $enquiry_data->mobile;
                                                                                                    }
                                                                                                ?>
												<input type="text" id="phone_no_1" name="clients[phone_no_1]" class="form-control onlynumbers1" maxlength="10" minlength="10" value="<?php echo $mobile; ?>"><span id="phone_no_1div"></span>
											</div>
											<div class="form-group">
												<label for="phone_no_2" class="control-label"><?php echo _l('client_number2'); ?></label>
												<input type="text" id="phone_no_2" name="clients[phone_no_2]" class="form-control onlynumbers2" maxlength="10" minlength="10" value="<?php echo (isset($lead['phonenumber2']) && $lead['phonenumber2'] != "") ? $lead['phonenumber2'] : "" ?>"><span id="phone_no_2div"></span>
											</div>

											<div class="form-group">
												<label for="client_person_name" class="control-label">Client Person Name</label>
                                                                                                <?php
                                                                                                    $person_name = (isset($lead['client_person_name']) && $lead['client_person_name'] != "") ? $lead['client_person_name'] : "";
                                                                                                    if (isset($enquiry_data) && (!empty($enquiry_data->person_name))) {
                                                                                                        $person_name = $enquiry_data->person_name;
                                                                                                    }
                                                                                                ?>
												<input type="text" id="client_person_name" name="clients[client_person_name]" class="form-control" value="<?php echo $person_name; ?>">
											</div>

											<div class="form-group">
												<label for="website" class="control-label"><?php echo _l('client_web'); ?></label>
												<input type="text" id="website" name="clients[website]" class="form-control" value="<?php echo (isset($lead['website']) && $lead['website'] != "") ? $lead['website'] : "" ?>">
											</div>
											<div class="form-group">
												<label for="address" class="control-label"><?php echo _l('Address'); ?></label>
                                                                                                <?php
                                                                                                    $address = (isset($lead['address']) && $lead['address'] != "") ? $lead['address'] : "";
                                                                                                    if (isset($enquiry_data) && (!empty($enquiry_data->address))) {
                                                                                                        $address = $enquiry_data->address;
                                                                                                    }
                                                                                                ?>
												<textarea id="address" style="height: 110px;" name="clients[address]" class="form-control"><?php echo $address; ?></textarea>
											</div>

											<div class="form-group">
												<label for="state_id" class="control-label"><?php echo _l('site_state'); ?></label>
												<select class="form-control selectpicker" id="clientstate" name="clients[state]" onchange="get_city_by_stateid(this.value)" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($state_data) && count($state_data) > 0) {
														foreach ($state_data as $state_key => $state_value)
														{
                                                                                                                    if (isset($enquiry_data) && $state_value['id'] == $enquiry_data->state_id){
                                                                                                                        echo '<option value="'.$state_value['id'].'" selected>'.cc($state_value['name']).'</option>';
                                                                                                                    }else{
                                                                                                                    ?>
															<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($lead['state']) && $lead['state'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
													<?php
                                                                                                                    }
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

											<?php if (isset($enquiry_data) && !empty($enquiry_data->company_name)){

                                                                                            }
                                                                                        ?>
											<div style="margin-bottom:2%;">
													<label for="companybranch" class="control-label" style="width:100%;"><?php echo _l('client'); ?><a href="#" onclick="new_new_comp_branch();" class="inline-field-new" style="float:right;"><i class="fa fa-plus"></i>add new Client</a></label>
													<select class="form-control selectpicker cmpbranch <?php if(isset($lead['company']) & $lead['company']!=''){?>hide<?php }?>" id="client_branch_id" name="clientbranch[client_branch_id]" data-live-search="true">
														<option value=""></option>
														<?php
														if (isset($client_branch_data) && count($client_branch_data) > 0) {
															foreach ($client_branch_data as $client_branch_key => $client_branch_value)
															{
                                if (isset($enquiry_data) && $enquiry_data->clientid > 0){
                                    $select_cls = ($enquiry_data->clientid == $client_branch_value->userid) ? "selected='selected'":"";
                                }else{
                                    $select_cls = (isset($lead['client_branch_id']) && $lead['client_branch_id'] == $client_branch_value->userid) ? 'selected' : "";
                                }
                            ?>
                                    <option value="<?php echo $client_branch_value->userid; ?>" <?php echo $select_cls; ?> ><?php echo cc($client_branch_value->client_branch_name).' - '.$client_branch_value->email_id ?></option>
																 <?php
															}
														}
														?>
													</select>
												</div>

												<div class="compbranchdv " style="margin-top: -2%;<?php if(isset($lead['company']) && $lead['company']==''){?>display:none;<?php }else if(!isset($lead['company'])){echo'display:none;';}?>">
                                                                                                        <?php
                                                                                                            $company_name = (isset($lead['company']) && $lead['company']!='') ? $lead['company'] : "";
                                                                                                            if (isset($enquiry_data) && !empty($enquiry_data->company_name)){
                                                                                                                $company_name = $enquiry_data->company_name;
                                                                                                            }
                                                                                                        ?>
													<input type="text" id="compnybranchname" class="form-control" name="newclient[client_branch_name]" style="margin-bottom: 2%;" value="<?php echo $company_name; ?>">

												</div>

											<div class="form-group">
												<label for="email_id" class="control-label"><?php echo _l('client_mail'); ?></label>
                                                                                                <?php
                                                                                                    $email = (isset($lead['email']) && $lead['email'] != "") ? $lead['email'] : "";
                                                                                                    if (isset($enquiry_data) && !empty($enquiry_data->email)){
                                                                                                        $email = $enquiry_data->email;
                                                                                                    }
                                                                                                ?>
												<input type="email" id="email_id" name="clients[email_id]" class="form-control" value="<?php echo $email; ?>">
											</div>
											<div class="form-group">
												<label for="client_cat_id" class="control-label"><?php echo _l('client_cat'); ?></label>
												<select class="form-control selectpicker" data-live-search="true" id="client_cat_id" name="clients[client_cat_id]">
													<option value=""></option>
													<?php
													if (isset($client_category_data) && count($client_category_data) > 0) {
														foreach ($client_category_data as $client_category_key => $client_category_value) {
															?>
															<option value="<?php echo $client_category_value['id'] ?>" <?php  echo (isset($lead['company_category']) && $lead['company_category'] == $client_category_value['id']) ? 'selected' : "" ?>><?php echo cc($client_category_value['category_name']); ?></option>
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
												<input type="text" id="vat" name="clients[vat]" class="form-control" maxlength="15" value="<?php echo (isset($lead['gst_no']) && $lead['gst_no'] != "") ? $lead['gst_no'] : "" ?>">
											</div>
											<div class="form-group">
												<label for="cin_no" class="control-label"><?php echo _l('client_cin_no'); ?></label>
												<input type="text" id="cin_no" name="clients[cin_no]" class="form-control" maxlength="21" value="<?php echo (isset($lead['cin_no']) && $lead['cin_no'] != "") ? $lead['cin_no'] : "" ?>">
											</div>
											<div class="form-group">
												<label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>
												<select class="form-control selectpicker" id="clientclity" name="clients[city]" data-live-search="true">
													<option value=""></option>
													<?php

													if (isset($all_city_data) && count($all_city_data) > 0  ) {
														foreach ($all_city_data as $city_key => $city_value) {
                                                                                                                            if (isset($enquiry_data) && $city_value['id'] == $enquiry_data->city_id){
                                                                                                                                echo '<option value="'.$city_value['id'].'" selected>'.cc($city_value['name']).'</option>';
                                                                                                                            }else{
															?>
															<!-- <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['clientbranch']['city']) && $lead['clientbranch']['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option> -->

															<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['city']) && $lead['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
															<?php
                                                                                                                            }
														}
													}
													else if(isset($lead['city']) & $lead['city']!='')
													{
														foreach ($allcity as $city_key => $city_value)
														{?>
															<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['city']) && $lead['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
															<?php
														}
													}
													?>
												</select>
											</div>
											<div class="form-group">
												<label for="zip" class="control-label"><?php echo _l('client_postal_code'); ?> </label>
												<input type="text" id="zip" name="clients[zip]" class="form-control onlynumbers" maxlength="6" value="<?php echo (isset($lead['zip']) && $lead['zip'] != "") ? $lead['zip'] : "" ?>">
											</div>
										</div>


									</div>



											<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
										</div>
									</div>
								</div>


								<div class="row setup-content" id="step-2">
									<div class="col-xs-12">
										<div class="col-md-12">
											<h3><?php if (isset($lead['sitedata']['id']))	echo _l('edit_site_details'); else	echo _l('add_site_details');?></h3>

											<div class="row">


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
                                                                                                                    if (isset($enquiry_data) && $state_value['id'] == $enquiry_data->state_id){
                                                                                                                        echo '<option value="'.$state_value['id'].'" selected>'.cc($state_value['name']).'</option>';
                                                                                                                    }else{
															?>
															<option value="<?php echo $state_value['id'] ?>" ><?php echo cc($state_value['name']); ?></option>
															<?php
                                                                                                                    }
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
                                                                                                                    if (isset($enquiry_data) && $city_value['id'] == $enquiry_data->city_id){
                                                                                                                        echo '<option value="'.$city_value['id'].'" selected>'.cc($city_value['name']).'</option>';
                                                                                                                    }else{
															?>
															<option value="<?php echo $city_value['id'] ?>"><?php echo cc($city_value['name']); ?></option>
															<?php
                                                                                                                    }
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
															<option value="<?php echo $site_value['id'] ?>" <?php echo (isset($lead['site_id']) && $lead['site_id'] == $site_value['id']) ? 'selected' : "" ?>><?php echo cc($site_value['name']); ?></option>
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
												<input type="text" id="site_location" name="site[location]" class="form-control" value="<?php echo (isset($lead['site_location']) && $lead['site_location'] != "") ? $lead['site_location'] : "" ?>">
											</div>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="site_description" class="control-label"><?php echo _l('site_description'); ?></label>
											<textarea id="site_description" name="site[description]" class="form-control"><?php echo (isset($lead['site_description']) && $lead['site_description'] != "") ? $lead['site_description'] : "" ?></textarea>
										</div>
									</div>

									<div class="col-md-12">
										<div class="form-group">
											<label for="site_address" class="control-label"><?php echo _l('site_address'); ?> </label>
											<textarea id="site_address" name="site[address]" class="form-control" ><?php echo (isset($lead['site_address']) && $lead['site_address'] != "") ? $lead['site_address'] : "" ?></textarea>
										</div>
									</div>

									<div>


										<div class="col-md-6">
											<div class="form-group">
												<label for="site_state_id" class="control-label"><?php echo _l('site_state'); ?></label>
												<select class="form-control selectpicker" id="site_state_id" name="site[state_id]" onchange="get_city_by_state(this.value)" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($state_data) && count($state_data) > 0) {
														foreach ($state_data as $state_key => $state_value) {
                                                                                                                    if (isset($enquiry_data) && $state_value['id'] == $enquiry_data->state_id){
                                                                                                                        echo '<option value="'.$state_value['id'].'" selected>'.cc($state_value['name']).'</option>';
                                                                                                                    }else{
															?>
															<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($lead['site_state_id']) && $lead['site_state_id'] == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
															<?php
                                                                                                                    }
														}
													}
													?>
												</select>
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_city_id" class="control-label"><?php echo _l('site_city'); ?></label>
												<select class="form-control selectpicker" id="site_city_id" name="site[city_id]" data-live-search="true">
													<option value=""></option>
													<?php
													if (isset($all_city_data) && count($all_city_data) > 0) {
														foreach ($all_city_data as $all_city_key => $all_city_value) {
                                                                                                                    if (isset($enquiry_data) && $all_city_value['id'] == $enquiry_data->city_id){
                                                                                                                        echo '<option value="'.$all_city_value['id'].'" selected>'.cc($all_city_value['name']).'</option>';
                                                                                                                    }else{
															?>
															<option value="<?php echo $all_city_value['id'] ?>" <?php echo (isset($lead['site_city_id']) && $lead['site_city_id'] == $all_city_value['id']) ? 'selected' : "" ?>><?php echo cc($all_city_value['name']); ?></option>
															<?php
                                                                                                                    }
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
												<input type="text" id="site_landmark" name="site[landmark]" class="form-control" value="<?php echo (isset($lead['site_landmark']) && $lead['site_landmark'] != "") ? $lead['site_landmark'] : "" ?>">
											</div>
										</div>

										<div class="col-md-6">
											<div class="form-group">
												<label for="site_pincode" class="control-label"><?php echo _l('site_pincode'); ?> </label>
												<input type="text" id="site_pincode" name="site[pincode]"  class="form-control onlynumbers" maxlength="6" value="<?php echo (isset($lead['site_pincode']) && $lead['site_pincode'] != "") ? $lead['site_pincode'] : "" ?>">
											</div>
										</div>
									</div>

								</div>



											<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
										</div>
									</div>
								</div>
								<div class="row setup-content" id="step-3">
									<div class="col-xs-12">
										<div class="col-md-12">
											<h3><?php if(isset($contactdata)){echo _l('edit_client_person');}else{echo _l('add_client_person');}?></h3>

											<div class="row">
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
															<input type="text" id="firstname0" name="clientdata[0][firstname]" class="form-control" required="">
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="email" id="email0" name="clientdata[0][email]" onBlur="checkmail(this.value,0);" class="form-control clientmail">
														</div>
													</td>
													<td>
														<div class="form-group">
															<input required="" type="text" id="phonenumber0"  maxlength="10" minlength="10" name="clientdata[0][phonenumber]" onBlur="checkcontno(this.value,0);" class="form-control onlynumbers"><span id="phonenumberdiv"></span>
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
																		<option value="<?php echo $designation_value['id'] ?>" ><?php echo cc($designation_value['designation']); ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="contact_type" name="clientdata[0][contact_type]">
																<option value=""></option>
																<?php
																if (isset($contact_type_data) && count($contact_type_data) > 0) {
																	foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
                                                                                                                                            $select_cls = (isset($section_type) && $section_type == "add" && ($contact_type_value['id'] == 1)) ? "selected='selected'" : "";
																		?>
                                                                                                                                <option <?php echo $select_cls; ?> value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option>
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
											<label class="label-control subHeads"><a  class="addmore" value="<?php echo (isset($productcomponent)) ? count($productcomponent) : 0; ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
										</div>
									</div>
									<?php
								}else{
									?>
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
												<?php
												if(!empty($contactdata)){
													foreach ($contactdata as $k => $singlecontact) {
														?>
														<tr class="main" id="tr<?php echo $k;?>">
													<td>
														<div class="form-group">
															<input type="text" id="firstname" value="<?php echo $singlecontact['firstname']; ?>" name="clientdata[<?php echo $k;?>][firstname]" class="form-control" >
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="email" value="<?php echo $singlecontact['email']; ?>" id="email<?php echo $k;?>" name="clientdata[<?php echo $k;?>][email]" onBlur="checkmail(this.value,<?php echo $k;?>);" class="form-control clientmail" >
														</div>
													</td>
													<td>
														<div class="form-group">
															<input type="text" maxlength="10" minlength="10" value="<?php echo $singlecontact['phonenumber']; ?>" id="phonenumber<?php echo $k;?>" name="clientdata[<?php echo $k;?>][phonenumber]" onBlur="checkcontno(this.value,<?php echo $k;?>);" class="form-control onlynumbers">
														</div><div id="phonenumberdiv1"></div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[<?php echo $k;?>][designation_id]">
																<option value=""></option>
																<?php
																if (isset($designation_data) && count($designation_data) > 0) {
																	foreach ($designation_data as $designation_key => $designation_value) {
																		?>
																		<option value="<?php echo $designation_value['id'] ?>" <?php echo (isset($singlecontact['designation_id']) && $singlecontact['designation_id'] == $designation_value['id']) ? 'selected' : "" ?>><?php echo cc($designation_value['designation']); ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<div class="form-group">
															<select class="form-control selectpicker" data-live-search="true" id="contact_type" name="clientdata[<?php echo $k;?>][contact_type]">
																<option value=""></option>
																<?php
																if (isset($contact_type_data) && count($contact_type_data) > 0) {
																	foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
																		?>
																		<option value="<?php echo $contact_type_value['id'] ?>" <?php echo (isset($singlecontact['contact_type']) && $singlecontact['contact_type'] == $contact_type_value['id']) ? 'selected' : "" ?>><?php echo $contact_type_value['contact_type'] ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
													</td>
													<td>
														<button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson(<?php echo $k;?>);" ><i class="fa fa-remove"></i></button>
													</td>
												</tr>
														<?php
													}
												}
												?>

											</tbody>
										</table>
										<div class="col-xs-12">
											<label class="label-control subHeads"><a  class="addmore" value="<?php echo (isset($contactdata)) ?  count($contactdata) : 0; ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
										</div>
									</div>


									<?php
								}

								?>
									<div class="col-md-6">
									<?php
									/*if(isset($contactdata))
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
									}*/
									?>
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
                                                                                                            if (isset($enquiry_data) && $source_value['id'] == $enquiry_data->source_id){
                                                                                                                echo '<option value="'.$source_value['id'].'" selected>'.cc($source_value['name']).'</option>';
                                                                                                            }else{
														?>
														<option value="<?php echo $source_value['id'] ?>" <?php echo (isset($lead['source']) && $lead['source'] == $source_value['id']) ? 'selected' : "" ?>><?php echo cc($source_value['name']); ?></option>
														<?php
                                                                                                            }
													}
												}
												?>
											</select>
										</div>
									</div>

									<div class="col-md-6">
									<?php
									/*if(isset($contactdata))
									{
										$l=0;
									 foreach($contactdata as $singlecontact)
									 {$l++;?>
										<div class="form-group date">
											<label for="contpersonnumber" class="control-label">Contact Person Number</label>
											<input type="text" id="contpersonnumber" readonly name="clientexitingdata[<?php echo $l;?>][phonenumber]" value="<?php if(isset($singlecontact['phonenumber']) && $singlecontact['phonenumber'] != ""){ echo $singlecontact['phonenumber']; }?>" class="form-control phonenumber">
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
									}*/
									?>
										<div class="form-group date">
											<label for="reminder_date" class="control-label"><?php echo _l('reminder_date'); ?></label>
											<input type="text" id="reminder_date" name="enquiry[reminder_date]" class="form-control datepicker" value="<?php if(isset($lead['reminder_date']) && $lead['reminder_date'] != ""){ echo date('d/m/Y',strtotime($lead['reminder_date'])); }else{echo date('d/m/Y', strtotime($date. ' + 2 days'));}?>">
										</div>
										<div class="form-group date">
											<label for="reference" class="control-label"><?php echo _l('reference'); ?></label>
											<input type="text" id="reference" name="enquiry[reference]" class="form-control" value="<?php if(isset($lead['reference']) && $lead['reference'] != ""){ echo $lead['reference']; }?>">
										</div>
									</div>
									<div class="col-md-12">
										<div class="form-group">
											<label for="remark" class="control-label"><?php echo _l('remark'); ?> </label>
                                                                                        <?php
                                                                                            $remark = (isset($lead['remark']) && $lead['remark'] != "") ? $lead['remark'] : "";
                                                                                        ?>
											<textarea id="remark" name="enquiry[remark]" class="form-control" ><?php echo $remark; ?></textarea>
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
											<select onchange="staffdropdown()" class="form-control selectpicker" data-live-search="true" id="assign" name="assign">
												<option>Select</option>
												<?php

                                        if (isset($group_info) && count($group_info) > 0) {
                                            foreach ($group_info as $value) {
                                                $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '".$value['id']."' ")->row_array();

                                                ?>
                                                <option value="<?php echo $value['id'] ?>" <?php echo (isset($lead) && $lead['group_id'] == $value['id']) ? 'selected' : "" ?>><?php echo cc($value['name']); ?></option>
                                                <optgroup label="Sales Person">
                                                	<?php

                                                $employee_info = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$value['sales_person_id']."' ")->row_array();
                                                	?>
		                                        <option disabled value="<?php echo $employee_info['staffid']?>"><?php echo $employee_info['firstname']?></option></optgroup>
		                                        <optgroup label="Superior Person">
		                                        <?php

                                                $superiordata = explode(',', $lead_staff_info['superior_ids']);
                                                foreach($superiordata as $value1){
                                                	$employee_info1 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$value1."' ")->row_array();
		                                         ?>
		                                        <option disabled  value="<?php echo $employee_info1['staffid']?>"><?php echo $employee_info1['firstname']?></option>
                                                <?php
                                              } ?></optgroup>
                                                <optgroup label="Quote Person">
                                                	<?php

                                                $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
                                                foreach($quotedata as $value2){
                                                	$employee_info2 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '".$value2."' ")->row_array();
		                                         ?>
		                                        <option disabled value="<?php echo $employee_info2['staffid']?>"><?php echo $employee_info2['firstname']?></option>
                                                <?php
                                              } ?></optgroup>
                                              <?php
                                            }
                                        }
                                        ?>

												<!-- <?php
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
												?> -->

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
									<!-- <div class="col-md-6">
										<div class="form-group">
											<label for="status" class="control-label"><?php echo _l('lead_status'); ?></label>
											<select class="form-control selectpicker" data-live-search="true" id="status" name="enquiry[status]">
												<option value=""></option>
												<?php
												if (isset($lead_status) && count($lead_status) > 0) {
													foreach ($lead_status as $lead_status_key => $lead_status_value) {
														?>
														<option value="<?php echo $lead_status_value['id'] ?>"  <?php if(!empty($lead['status']) && $lead['status'] == $lead_status_value['id']){ echo 'selected'; } ?>   ><?php echo $lead_status_value['name'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</div> -->
									<input type="hidden" value="1" name="enquiry[status]">
									<div id="requirement_div">
										<div class="col-md-6">
											<div class="form-group">
												<label for="requirement_type" class="control-label">Requirement Type</label>
												<select class="form-control selectpicker" data-live-search="true" id="requirement_type" name="enquiry[requirement_type]">
													<option value=""></option>
													<option value="1"  <?php if(!empty($lead['requirement_type']) && $lead['requirement_type'] == 1){ echo 'selected'; } ?> >Requirement Given</option>
													<option value="2"  <?php if(!empty($lead['requirement_type']) && $lead['requirement_type'] == 2){ echo 'selected'; } ?> >Requirement Not Given</option>
												</select>
											</div>
										</div>

										<div class="col-md-12">
											<div class="form-group">
												<label for="lead_remark" class="control-label">Lead Remark </label>
												<textarea id="lead_remark" name="enquiry[lead_remark]" class="form-control" ><?php echo (isset($lead['lead_remark']) && $lead['lead_remark'] != "") ? $lead['lead_remark'] : "" ?></textarea>
											</div>
										</div>
									</div>


											</div>

											<button class="btn btn-primary nextBtn btn-lg pull-right" type="button" >Next</button>
										</div>
									</div>
								</div>
								<div class="row setup-content" id="step-4">
									<div class="col-xs-12">
										<div class="col-md-12">
											<h3><?php echo _l('product_enquiry');?></h3>


											<div id="product_div" hidden>
											<div class="row">
											<div class="table-responsive s_table">
										<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
											<thead>
												<tr>
													<th width="5%"  align="center"><i class="fa fa-cog"></i></th>
													<th width="30%" align="left"><?php echo _l('product_name');?></th>
													<th width="15%" align="center">Segment</th>
													<th width="20%" class="qty" align="left"><?php echo _l('product_remarks');?></th>
													<th width="10%" align="left"><?php echo _l('quantity_as_qty');?>	</th>
													<th width="10%" align="left"><?php echo _l('enquiry_for');?>	</th>
													<th width="10%" align="left"><?php echo _l('remark');?>	</th>

												</tr>
											</thead>
											<tbody class="ui-sortable">
											<?php
                                                                                        $count = 0;
											if(isset($productqnq))
											{
                                                                                            $count = count($productqnq);
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
															<select class="form-control selectpicker" onchange="get_product_segment(<?php echo $i; ?>,this.value,this)" data-live-search="true" id="product_id<?php echo $i; ?>" name="proenqdata[<?php echo $i;?>][product_id]">
																<option value=""></option>
																<?php
																if (isset($product_data) && count($product_data) > 0) {
																	foreach ($product_data as $product_key => $product_val) {

																		if($product_val['is_temp'] == 0){
																			$product_code = product_code($product_val['id']);
																		}else{
																			$product_code = temp_product_code($product_val['id']);
																		}

																		$selected = '';
																		if($product_val['is_temp'] == 0 && $singleproenq['temp_product'] == 0){
																			$selected = (isset($singleproenq['product_id']) && $singleproenq['product_id'] == $product_val['id']) ? 'selected' : "";
																		}elseif($product_val['is_temp'] == 1 && $singleproenq['temp_product'] == 1){
																			$selected = (isset($singleproenq['product_id']) && $singleproenq['product_id'] == $product_val['id']) ? 'selected' : "";
																		}
																		?>
																		<option data-is_temp="<?php echo $product_val['is_temp']; ?>" value="<?php echo $product_val['id']; ?>" <?php echo $selected; ?>><?php echo $product_val['name'].$product_code; ?></option>
																		<?php
																	}
																}
																?>
															</select>
														</div>
														<input type="hidden" id="temp_product<?php echo $i; ?>" name="proenqdata[<?php echo $i;?>][temp_product]" value="<?php echo $singleproenq['temp_product']; ?>">
													</td>
													<td id="segment<?php echo $i; ?>">--</td>
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
                                                                                        }elseif(isset($enquiry_data) && !(empty($enquiry_data->product_json))){
                                                                                            $decode_product = json_decode($enquiry_data->product_json);
                                                                                            $count = count($decode_product);
                                                                                            $i = 0;
                                                                                            foreach ($decode_product as $pro) {

                                                                                        ?>
                                                                                             <tr class="main" id="tre<?php echo $i;?>">
                                                                                                <td>
                                                                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('0');" ><i class="fa fa-remove"></i></button>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="form-group">
                                                                                                        <select class="form-control selectpicker" onchange="get_product_segment(0,this.value,this)" data-live-search="true" id="product_id0" name="proenqdata[<?php echo $i; ?>][product_id]">
                                                                                                            <option value=""></option>
                                                                                                            <?php
                                                                                                            if (isset($product_data) && count($product_data) > 0) {
                                                                                                                foreach ($product_data as $product_key => $product_value) {

                                                                                                                    if ($product_value['is_temp'] == 0) {
                                                                                                                        $product_code = product_code($product_value['id']);
                                                                                                                    } else {
                                                                                                                        $product_code = temp_product_code($product_value['id']);
                                                                                                                    }
                                                                                                                    if ($pro->product_id == $product_value['id']  && $pro->is_temp == $product_value['is_temp']){
                                                                                                                        echo '<option data-is_temp="'.$product_value['is_temp'].'" value="'.$product_value['id'].'" selected>'.$product_value['name'] . $product_code.'</option>';
                                                                                                                    }else{
                                                                                                                        echo '<option data-is_temp="'.$product_value['is_temp'].'" value="'.$product_value['id'].'" >'.$product_value['name'] . $product_code.'</option>';
                                                                                                                    }

                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>

                                                                                                    </div>
                                                                                                    <input type="hidden" id="temp_product<?php echo $i; ?>" name="proenqdata[<?php echo $i; ?>][temp_product]" value='<?php echo $pro->is_temp;?>'>
                                                                                                </td>
                                                                                                <td id="segment<?php echo $i; ?>">--</td>

                                                                                                <td>
                                                                                                    <div class="form-group">
                                                                                                        <textarea id="product_remarks" name="proenqdata[<?php echo $i; ?>][product_remarks]" class="form-control" ></textarea>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="form-group">
                                                                                                        <input type="number" id="qty" min="1" name="proenqdata[<?php echo $i; ?>][qty]" class="form-control" value="<?php echo (isset($pro->qty) && !empty($pro->qty)) ? $pro->qty : "";?>">
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="form-group">
                                                                                                        <select class="form-control selectpicker" data-live-search="true" id="enquiry_for_id" name="proenqdata[<?php echo $i; ?>][enquiry_for_id]">
                                                                                                            <option value=""></option>
                                                                                                            <?php
                                                                                                            if (isset($enquiry_for) && count($enquiry_for) > 0) {
                                                                                                                foreach ($enquiry_for as $enquiry_for_key => $enquiry_for_value) {
                                                                                                                    if ($enquiry_data->service_type == $enquiry_for_value['id']) {
                                                                                                                        echo '<option value="'.$enquiry_for_value['id'].'" selected>'.$enquiry_for_value['name'].'</option>';
                                                                                                                    }
                                                                                                                    else{
                                                                                                                        echo '<option value="'.$enquiry_for_value['id'].'" >'.$enquiry_for_value['name'].'</option>';
                                                                                                                    }
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>
                                                                                                    </div>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="form-group">
                                                                                                        <div class="form-group">
                                                                                                            <textarea id="remarks" name="proenqdata[<?php echo $i; ?>][remarks]" class="form-control" ></textarea>
                                                                                                        </div>
                                                                                                    </div>
                                                                                                </td>
                                                                                            </tr>
                                                                                        <?php
                                                                                                $i++;
                                                                                            }
                                                                                        }
                                                                                        else
											{
                                                                                            ?>
                                                                                            <tr class="main" id="tre0">
                                                                                                <td>
                                                                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('0');" ><i class="fa fa-remove"></i></button>
                                                                                                </td>
                                                                                                <td>
                                                                                                    <div class="form-group">
                                                                                                        <select class="form-control selectpicker" onchange="get_product_segment(0,this.value,this)" data-live-search="true" id="product_id0" name="proenqdata[0][product_id]">
                                                                                                            <option value=""></option>
                                                                                                            <?php
                                                                                                            if (isset($product_data) && count($product_data) > 0) {
                                                                                                                foreach ($product_data as $product_key => $product_value) {

                                                                                                                    if ($product_value['is_temp'] == 0) {
                                                                                                                        $product_code = product_code($product_value['id']);
                                                                                                                    } else {
                                                                                                                        $product_code = temp_product_code($product_value['id']);
                                                                                                                    }
                                                                                                                    echo '<option data-is_temp="'.$product_value['is_temp'].'" value="'.$product_value['id'].'" >'.$product_value['name'] . $product_code.'</option>';
                                                                                                                }
                                                                                                            }
                                                                                                            ?>
                                                                                                        </select>

                                                                                                    </div>
                                                                                                    <input type="hidden" id="temp_product0" name="proenqdata[0][temp_product]" value='0'>
                                                                                                </td>
                                                                                                <td id="segment0">

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
											<label class="label-control subHeads"><a  class="addmoreproenq" value="<?php echo $count; ?>"><?php echo _l('add_more_product');?> <i class="fa fa-plus"></i></a></label>
										</div>
									</div>

											</div>

										</div>

											<!--<div class=" text-right">
											<button class="btn btn-info only-save customer-form-submiter ">Save</button>
											<button class="btn btn-info save-and-add-contact customer-form-submiter">Save and create contact</button>
											</div>-->

											<!-- <div class="text-right">
												<button class="btn btn-info" type="submit">
													Save Without Approval
												</button>

												<button class="btn btn-info" name="send" type="submit">
													<?php echo _l('send_for_approval'); ?>
												</button>
											</div> -->
										</div>
									</div>
								</div>



								<div class="btn-bottom-toolbar text-right">
											<button class="btn btn-info" type="submit">
												<?php echo _l('submit'); ?>
											</button>
										</div>

							<?php echo form_close(); ?>





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
        $('#myTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="clientdata['+newaddmore+'][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="email" id="email'+newaddmore+'" name="clientdata['+newaddmore+'][email]" class="form-control onlynumbers" onBlur="checkmail(this.value,'+newaddmore+');"></div></td><td><div class="form-group"><input type="text" maxlength="10" minlength="10" id="phonenumber'+newaddmore+'" onBlur="checkcontno(this.value,'+newaddmore+');" name="clientdata['+newaddmore+'][phonenumber]" onkeyup="nospaces(this)" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="contact_type" name="clientdata['+newaddmore+'][contact_type]"><option value=""></option><?php	if (isset($contact_type_data) && count($contact_type_data) > 0) {foreach ($contact_type_data as $contact_type_key => $contact_type_value) {?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	$('.addmoreproenq').click(function ()
    {
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);
        $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><select onchange="get_product_segment('+newaddmoreproenq+',this.value,this)" class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="product_id" name="proenqdata['+newaddmoreproenq+'][product_id]"><option value=""></option><?php	if (isset($product_data) && count($product_data) > 0) {foreach ($product_data as $product_key => $product_value) { if($product_value['is_temp'] == 0){	$product_code = product_code($product_value['id']);	}else{	$product_code = temp_product_code($product_value['id']); } ?><option data-is_temp="<?php echo $product_value['is_temp']; ?>" value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code; ?></option><?php }}?></select></div><input type="hidden" id="temp_product'+newaddmoreproenq+'" name="proenqdata['+newaddmoreproenq+'][temp_product]" value="0"></td><td id="segment'+newaddmoreproenq+'">--</td><td><div class="form-group"><textarea id="product_remarks" name="proenqdata['+newaddmoreproenq+'][product_remarks]" class="form-control" ></textarea></div></td><td><div class="form-group"><input type="number" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" id="enquiry_for_id" style="display:block !important;" name="proenqdata['+newaddmoreproenq+'][enquiry_for_id]"><option value=""></option><?php if (isset($enquiry_for) && count($enquiry_for) > 0) {foreach ($enquiry_for as $enquiry_for_key => $enquiry_for_value) {?><option value="<?php echo $enquiry_for_value['id'] ?>"><?php echo $enquiry_for_value['name'] ?></option><?php }}?></select></div></td><td><div class="form-group"><div class="form-group"><textarea id="remarks" name="proenqdata['+newaddmoreproenq+'][remarks]" class="form-control" ></textarea></div></div></td></tr>');
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
		if(sitename!='' & sitelocation!='' & siteaddress!='' & sitepincode!='')
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
					$('.selectpicker').selectpicker('refresh');
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
					$('#email0').val(res.email_id);
					$('#phone_no_1').val(res.phone_no_1);
					$('#phonenumber0').val(res.phone_no_1);
					$('#phone_no_2').val(res.phone_no_2);
					$('#clientstate').val(res.state);
					$('#clientclity').val(res.city);
					$('#landmark').val(res.landmark);
					$('#address').val(res.address);
					$('#cin_no').val(res.cin_no);
					$('#website').val(res.website);
					$('#zip').val(res.zip);
					$('#vat').val(res.vat);
					$('#pan_no').val(res.pan_no);
					$('#client_cat_id').val(res.client_cat_id);
					$('#client_person_name').val(res.client_person_name);
					$('#firstname0').val(res.client_person_name);
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



		$('#email_id').val('');
		$('#phone_no_1').val('');
		$('#phone_no_2').val('');
		$('#clientstate').val('');
		$('#clientclity').val('');
		$('#landmark').val('');
		$('#address').val('');
		$('#cin_no').val('');
		$('#website').val('');
		$('#zip').val('');
		$('#vat').val('');
		$('#pan_no').val('');
		$('#client_cat_id').val('');
		$('#client_branch_id').val('');
		$('.selectpicker').selectpicker('refresh');

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






<!-- For Form Wizard -->
<script>
$(document).ready(function () {

    var navListItems = $('div.setup-panel div a'),
            allWells = $('.setup-content'),
            allNextBtn = $('.nextBtn');

    allWells.hide();

    navListItems.click(function (e) {
        e.preventDefault();
        var $target = $($(this).attr('href')),
                $item = $(this);

        if (!$item.hasClass('disabled')) {
            navListItems.removeClass('btn-primary').addClass('btn-default');
            $item.addClass('btn-primary');
            allWells.hide();
            $target.show();
            $target.find('input:eq(0)').focus();
        }
    });

    allNextBtn.click(function(){
        var curStep = $(this).closest(".setup-content"),
            curStepBtn = curStep.attr("id"),
            nextStepWizard = $('div.setup-panel div a[href="#' + curStepBtn + '"]').parent().next().children("a"),
            curInputs = curStep.find("input[type='text'],input[type='url']"),
            isValid = true;

        $(".form-group").removeClass("has-error");
        for(var i=0; i<curInputs.length; i++){
            if (!curInputs[i].validity.valid){
                isValid = false;
                $(curInputs[i]).closest(".form-group").addClass("has-error");
            }
        }

        if (isValid)
            nextStepWizard.removeAttr('disabled').trigger('click');
    });

    $('div.setup-panel div a.btn-primary').trigger('click');
});


/*
 $('.onlynumbers1').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });*/
</script>

<script type="text/javascript">
	function get_product_segment(proid,value,sel)
	{
		var product_id = value;
		var product_name = sel.options[sel.selectedIndex].text;
		var is_temp = sel.selectedOptions[0].getAttribute('data-is_temp');

		$.ajax({
	        type    : "POST",
	        url     : "<?php echo base_url(); ?>admin/leads/get_segment",
	        data    : {'product_id' : product_id,'product_name' : product_name, 'is_temp' : is_temp},
	        dataType: "json",
	        success : function(response){
	            if(response != ''){
	                $('#segment'+proid).html(response.html);
	                $('#temp_product'+proid).val(response.temp);
	            }
	        }
	    })
	}
</script>


<script type="text/javascript">
/*$(document).on('change', '#status', function() {
    var status = $(this).val();
    if(status == 1){
    	$('#requirement_div').show();
    	$('#product_div').show();

    }else{
    	$('#requirement_div').hide();
    	$('#product_div').hide();
    }
});

$( document ).ready(function() {
	var status = $('#status').val();
    if(status == 1){
    	$('#requirement_div').show();
    	$('#product_div').show();
    }else{
    	$('#requirement_div').hide();
    	$('#product_div').hide();
    }
}); */
</script>

<script type="text/javascript">

    var section_type = "<?php echo (isset($section_type) && ($section_type === "add")) ? 1 : 0; ?>";
    if (section_type == 1){
        $('#client_person_name').keyup(function() {
            var name = this.value;
            $("#firstname0").val(name);
        });
        $('#email_id').keyup(function() {
            var email = this.value;
            $("#email0").val(email);
        });
        $('#phone_no_1').keyup(function() {
            var phone = this.value;
            $("#phonenumber0").val(phone);
        });

        var client_person_name = $("#client_person_name").val();
        var email = $("#email_id").val();
        var phone_no = $("#phone_no_1").val();
        $("#firstname0").val(client_person_name);
        $("#email0").val(email);
        $("#phonenumber0").val(phone_no);
    }
$(document).on('change', '#requirement_type', function() {
    var type = $(this).val();
    if(type == 1){
    	$('#product_div').show();
    }else{
    	$('#product_div').hide();
    }
});

$( document ).ready(function() {
	var type = $('#requirement_type').val();
    if(type == 1){
    	$('#product_div').show();
    }else{
    	$('#product_div').hide();
    }
    var enquiry_data = "<?php echo (isset($enquiry_data) && $enquiry_data->clientid == 0) ? 1 : 0; ?>";
    var chk_product = "<?php echo (isset($enquiry_data) && !empty($enquiry_data->product_json)) ? 1 : 0; ?>";
    if (enquiry_data > 0){
        $('.cmpbranch').hide();
        $(".compbranchdv").show();
        $('#product_div').show();
    }else if(app_data > 0){
        $('.cmpbranch').hide();
        $(".compbranchdv").show();
    }else if(chk_product > 0){
         $('#product_div').show();
         $('#requirement_type').val("1");
         $('.selectpicker').selectpicker('refresh');
    }

});
</script>
<script type="text/javascript">
	$('#phone_no_1').keyup(function() {
    $('span.error-keyup-3').remove();
    var inputVal = $(this).val();
    var characterReg = /^([0-9]{0,10})$/;
    if(!characterReg.test(inputVal)) {
        $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
    }
});
 $(function() {
        $('#phone_no_1').on('keypress', function(e) {
        	$('span.error-keyup-4').remove();
            if (e.which == 32){
            	$("#phone_no_1div").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});
 $('#phone_no_2').keyup(function() {
    $('span.error-keyup-3').remove();
    var inputVal = $(this).val();
    var characterReg = /^([0-9]{0,10})$/;
    if(!characterReg.test(inputVal)) {
        $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
    }
});
 $(function() {
        $('#phone_no_2').on('keypress', function(e) {
        	$('span.error-keyup-4').remove();
            if (e.which == 32){
            	$("#phone_no_2div").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});

$('#phonenumber0').keyup(function() {
    $('span.error-keyup-3').remove();
    var inputVal = $(this).val();
    var characterReg = /^([0-9]{0,10})$/;
    if(!characterReg.test(inputVal)) {
        $(this).after('<span class="error error-keyup-3" style="color: red">Only Numeric, Maximum 10 characters.</span>');
    }
});
$(function() {
        $('#phonenumber0').on('keypress', function(e) {
        	$('span.error-keyup-4').remove();
            if (e.which == 32){
            	$("#phonenumberdiv").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});
$(function() {
        $('#phonenumber').on('keypress', function(e) {
        	$('span.error-keyup-4').remove();
            if (e.which == 32){
            	$("#phonenumberdiv1").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});
$(function() {
        $('#enquiry_type_main_id').on('change', function(e) {
            var type_id = $(this).val();
            var url = "<?php echo admin_url()."leads/get_lead_subtype"; ?>";
            $.post(url,{ type_id: type_id}, function (response) {
                $('#enquiry_type_id').html(response);
                $('.selectpicker').selectpicker('refresh');
            });
        });
});

function nospaces(t){
  if(t.value.match(/\s/g)){
    t.value=t.value.replace(/\s/g,'');
  }
}

</script>

</body>
</html>

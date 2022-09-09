<h4 class="customer-profile-group-heading"><?php echo _l('client_add_edit_profile'); ?></h4>
<div class="row">
   <?php echo form_open($this->uri->uri_string(),array('class'=>'client-form','autocomplete'=>'off')); ?>
   <div class="additional"></div>
   <div class="col-md-12">
      <div class="horizontal-scrollable-tabs">
<div class="scroller arrow-left"><i class="fa fa-angle-left"></i></div>
<div class="scroller arrow-right"><i class="fa fa-angle-right"></i></div>
<div class="horizontal-tabs">
      <ul class="nav nav-tabs profile-tabs row customer-profile-tabs nav-tabs-horizontal" role="tablist">
         <li role="presentation" class="<?php if(!$this->input->get('tab')){echo 'active';}; ?>">
            <a href="#contact_info" aria-controls="contact_info" role="tab" data-toggle="tab">
            <?php echo _l( 'customer_profile_details'); ?>
            </a>
         </li>
         <?php
            $customer_custom_fields = false;
            if(total_rows('tblcustomfields',array('fieldto'=>'customers','active'=>1)) > 0 ){
                 $customer_custom_fields = true;
             ?>
         <li role="presentation" class="<?php if($this->input->get('tab') == 'custom_fields'){echo 'active';}; ?>">
            <a href="#custom_fields" aria-controls="custom_fields" role="tab" data-toggle="tab">
            <?php echo do_action('customer_profile_tab_custom_fields_text',_l( 'custom_fields')); ?>
            </a>
         </li>
         <?php } ?>
         <li role="presentation">
          <!--   <a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab">
            <?php echo _l( 'billing_shipping'); ?>
            </a> -->
         </li>
         <?php do_action('after_customer_billing_and_shipping_tab',isset($client) ? $client : false); ?>
         <?php if(isset($client)){ ?>
         <li role="presentation">
            <a href="#customer_admins" aria-controls="customer_admins" role="tab" data-toggle="tab">
            <?php echo _l( 'customer_admins' ); ?>
            </a>
         </li>
         <?php do_action('after_customer_admins_tab',$client); ?>
         <?php } ?>
      </ul>
   </div>
</div>
      <div class="tab-content">
         <?php do_action('after_custom_profile_tab_content',isset($client) ? $client : false); ?>
         <?php if($customer_custom_fields) { ?>
         <div role="tabpanel" class="tab-pane <?php if($this->input->get('tab') == 'custom_fields'){echo ' active';}; ?>" id="custom_fields">
            <?php $rel_id=( isset($client) ? $client->userid : false); ?>
            <?php echo render_custom_fields( 'customers',$rel_id); ?>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="contact_info">
            <div class="row">
               <div class="col-md-12<?php if(isset($client) && (!is_empty_customer_company($client->userid) && total_rows('tblcontacts',array('userid'=>$client->userid,'is_primary'=>1)) > 0)) { echo ''; } else {echo ' hide';} ?>" id="client-show-primary-contact-wrapper">
                  <div class="checkbox checkbox-info mbot20 no-mtop">
                     <input type="checkbox" name="show_primary_contact"<?php if(isset($client) && $client->show_primary_contact == 1){echo ' checked';}?> value="1" id="show_primary_contact">
                     <label for="show_primary_contact"><?php echo _l('show_primary_contact',_l('invoices').', '._l('estimates').', '._l('payments').', '._l('credit_notes')); ?></label>
                  </div>
               </div>
               <div class="col-md-6">
                  
                 
				  <div class="form-group">
						<label for="state_id" class="control-label"><?php echo _l('client_name'); ?></label>
						<select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
							<option value=""></option>
							<?php
							if (isset($client_data) && count($client_data) > 0) {
								foreach ($client_data as $client_key => $client_value) {
									?>
									<option value="<?php echo $client_value['userid'] ?>" <?php echo (isset($client->client_id) && $client->client_id == $client_value['userid']) ? 'selected' : "" ?>><?php echo $client_value['company'] ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>	
				 
				 
                  <?php $value=( isset($client) ? $client->phone_no_1 : ''); ?>
                  <?php //echo render_input( 'phone_no_1', 'client_phonenumber',$value); ?>
                  <div class="form-group" app-field-wrapper="phone_no_1">
                     <label for="phone_no_1" class="control-label">Phone Number 2</label>
                     <input type="text" id="phone_no_1" name="phone_no_1" minlength="10" maxlength="10" class="form-control onlynumbers" value="<?php echo $value; ?>">
                  </div>

                  <?php if((isset($client) && empty($client->website)) || !isset($client)){
                     $value=( isset($client) ? $client->website : '');
                     echo render_input( 'website', 'client_website',$value);
                     } else { ?>
                  <div class="form-group">
                     <label for="website"><?php echo _l('client_website'); ?></label>
                     <div class="input-group">
                        <input type="text" name="website" id="website" value="<?php echo $client->website; ?>" class="form-control">
                        <div class="input-group-addon">
                           <span><a href="<?php echo maybe_add_http($client->website); ?>" target="_blank" tabindex="-1"><i class="fa fa-globe"></i></a></span>
                        </div>
                     </div>
                  </div>
                  <?php }?>

                  <div class="form-group">
                     <label for="client_person_name" class="control-label">Client Person Name</label>
                     <input type="text" id="client_person_name" name="client_person_name" class="form-control" value="<?php echo (isset($client->client_person_name) && $client->client_person_name != "") ? $client->client_person_name : "" ?>">
                 </div>


				  <?php $value=( isset($client) ? $client->pan_no : ''); ?>
				  <?php echo render_input( 'pan_no', 'client_pan_no',$value); ?>
				  <?php $value=( isset($client) ? $client->address : ''); ?>
                  <?php //echo render_textarea( 'address', 'client_address',$value); ?>

                    <div class="form-group">
            <label for="state_id" class="control-label">Address</label>
                   <textarea id="address" name="address" class="form-control" rows="4" style="width: 433px; height: 123px;" aria-invalid="false"><?php echo $value; ?></textarea>
                    </div>
					<div class="form-group">
						<label for="state_id" class="control-label"><?php echo _l('site_state'); ?></label>
						<select class="form-control selectpicker" id="state" name="state" onchange="get_city_by_state(this.value)" data-live-search="true">
							<option value=""></option>
							<?php
							if (isset($state_data) && count($state_data) > 0) {
								foreach ($state_data as $state_key => $state_value) {
									?>
									<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($client->state) && $client->state == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>	
					<?php $value=( isset($client) ? $client->landmark : ''); ?>
					 <?php echo render_input( 'landmark', 'client_landmark',$value); ?>


                <div class="form-group">
                  <label for="followup" class="control-label">Followup</label>
                  <select class="form-control selectpicker" id="followup" name="followup" data-live-search="true">
                     <option value=""></option>
                    <option value="1" <?php echo (isset($client->followup) && $client->followup == 1) ? 'selected' : "" ?>>Yes</option>
                    <option value="0" <?php echo (isset($client->followup) && $client->followup == 0) ? 'selected' : "" ?>>No</option>
                  </select>
               </div> 

               <div class="form-group">
                     <label for="credit_limit" class="control-label">Credit Limit</label>
                     <input type="text" id="credit_limit" name="credit_limit" class="form-control" value="<?php echo (isset($client->credit_limit) && $client->credit_limit != "") ? $client->credit_limit : "" ?>">
                 </div>  
                   <div class="form-group">
                        <label for="assign_sales_parson" class="control-label"> Assign Sales Parson</label>
                        <select class="form-control selectpicker" data-live-search="true" multiple="" id="sales_parson" name="sales_parson[]">
                            <option value=""></option>
                            <?php
                            if (isset($sales_person_info) && count($sales_person_info) > 0) {
                                foreach ($sales_person_info as $sales_person_key => $sales_person_value) {
                                    $selected = "";
                                    if (!empty($client->sales_parson)){
                                        $sales_parsons = explode(",", $client->sales_parson);
                                        $selected = (in_array($sales_person_value->sales_person_id, $sales_parsons)) ? "selected=''" : "";
                                    }
                                    ?>
                                    <option value="<?php echo $sales_person_value->sales_person_id ?>" <?php echo $selected; ?>><?php echo cc(get_employee_name($sales_person_value->sales_person_id)); ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>


				   
					<?php
                     /*$selected = array();
                     if(isset($customer_groups)){
                       foreach($customer_groups as $group){
                          array_push($selected,$group['groupid']);
                       }
                     }
                     if(is_admin() || get_option('staff_members_create_inline_customer_groups') == '1'){
                      echo render_select_with_input_group('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,'<a href="#" data-toggle="modal" data-target="#customer_group_modal"><i class="fa fa-plus"></i></a>',array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                      } else {
                        echo render_select('groups_in[]',$groups,array('id','name'),'customer_groups',$selected,array('multiple'=>true,'data-actions-box'=>true),array(),'','',false);
                      }*/
                     ?>
                 <!-- <?php if(!isset($client)){ ?>
                  <i class="fa fa-question-circle pull-left" data-toggle="tooltip" data-title="<?php echo _l('customer_currency_change_notice'); ?>"></i>
                  <?php }
                     $s_attrs = array('data-none-selected-text'=>_l('system_default_string'));
                     $selected = '';
                     if(isset($client) && client_have_transactions($client->userid)){
                        $s_attrs['disabled'] = true;
                     }
                     foreach($currencies as $currency){
                        if(isset($client)){
                          if($currency['id'] == $client->default_currency){
                            $selected = $currency['id'];
                         }
                      }
                     }
                            // Do not remove the currency field from the customer profile!
                     echo render_select('default_currency',$currencies,array('id','name','symbol'),'invoice_add_edit_currency',$selected,$s_attrs); ?>
                  <?php if(get_option('disable_language') == 0){ ?>
                  <div class="form-group select-placeholder">
                     <label for="default_language" class="control-label"><?php echo _l('localization_default_language'); ?>
                     </label>
                     <select name="default_language" id="default_language" class="form-control selectpicker" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                        <option value=""><?php echo _l('system_default_string'); ?></option>
                        <?php foreach(list_folders(APPPATH .'language') as $language){
                           $selected = '';
                           if(isset($client)){
                              if($client->default_language == $language){
                                 $selected = 'selected';
                              }
                           }
                           ?>
                        <option value="<?php echo $language; ?>" <?php echo $selected; ?>><?php echo ucfirst($language); ?></option>
                        <?php } ?>
                     </select>
                  </div>
                  <?php } ?>-->
               </div>
               <div class="col-md-6">
			    <?php $value=( isset($client) ? $client->client_branch_name : ''); ?>
				  <?php echo render_input( 'client_branch_name', 'client_branch_name',$value); ?>
				   <?php $value=( isset($client) ? $client->location : ''); ?>
				   <?php $attrss = (isset($client) ? array() : array('autofocus'=>true)); ?>
                  <?php echo render_input( 'location', 'client_location',$value,'text',$attrss); ?>
				  
				  <?php $value=( isset($client) ? $client->phone_no_2 : ''); ?>
				  <?php //echo render_input( 'phone_no_2', 'client_phonenumber2',$value); ?>
               <div class="form-group" app-field-wrapper="phone_no_2">
                  <label for="phone_no_2" class="control-label">Phone Number 2</label>
                  <input type="text" id="phone_no_2" minlength="10" maxlength="10" name="phone_no_2" class="form-control onlynumbers" value="<?php echo $value; ?>">
               </div>

				  <?php $value=( isset($client) ? $client->email_id : ''); ?>
                  <?php echo render_input( 'email_id', 'client_email_address',$value); ?>
					<div class="form-group">
						<label for="client_cat_id" class="control-label"><?php echo _l('client_cat'); ?></label>
						<select class="form-control selectpicker" data-live-search="true" id="client_cat_id" name="client_cat_id">
							<option value=""></option>
							<?php
							if (isset($client_category_data) && count($client_category_data) > 0) {
								foreach ($client_category_data as $client_category_key => $client_category_value) {
									?>
									<option value="<?php echo $client_category_value['id'] ?>" <?php echo (isset($client->client_cat_id) && $client->client_cat_id == $client_category_value['id']) ? 'selected' : "" ?>><?php echo $client_category_value['category_name'] ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				   <?php if(get_option('company_requires_vat_number_field') == 1){
                     $value=( isset($client) ? $client->vat : '');
                     echo render_input( 'vat', 'client_vat_number',$value);
                     } ?>
					  <?php $value=( isset($client) ? $client->cin_no : ''); ?>
					<?php echo render_input( 'cin_no', 'client_cin_no',$value); ?>
				  <div class="form-group">
						<label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>
						<select class="form-control selectpicker" id="city_id" name="city" required="" data-live-search="true">
							<option value=""></option>
							<?php
							if (isset($city_data) && count($city_data) > 0  ) {
								foreach ($city_data as $city_key => $city_value) {
									?>
									<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($client->city) && $client->city == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
									<?php
								}
							}
							else if(isset($client->city) & $client->city!='')
							{
								foreach ($allcity as $city_key => $city_value)
								{?>
									<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($client->city) && $client->city == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				 
                  <?php $value=( isset($client) ? $client->zip : ''); ?>
                  <?php echo render_input( 'zip', 'client_postal_code',$value); ?>

                  <div class="form-group">
                    <label for="client_status" class="control-label">Client Status</label>
                    <select class="form-control selectpicker" data-live-search="true" id="client_status" name="client_status">
                      <option value=""></option>
                      <?php
                      if (isset($client_status) && count($client_status) > 0) {
                        foreach ($client_status as $client_status_value) {
                          ?>
                          <option value="<?php echo $client_status_value['id'] ?>" <?php echo (isset($client->client_status) && $client->client_status == $client_status_value['id']) ? 'selected' : "" ?>><?php echo $client_status_value['name'] ?></option>
                          <?php
                        }
                      }
                      ?>
                    </select>
                  </div>


                  <div class="form-group">
                    <label for="company_branch" class="control-label">Company Branch</label>
                    <select class="form-control" id="company_branch" name="company_branch" data-live-search="true">
                       <option value=""></option>                       
                      <option value="0" <?php echo (isset($client) && $client->company_branch == 0) ? 'selected' : "" ?>>No</option>
                      <option value="1" <?php echo (isset($client) && $client->company_branch == 1) ? 'selected' : "" ?>>Yes</option>
                    </select>
                 </div> 
                    
               </div>
            </div>
         </div>
         <?php if(isset($client)){ ?>
         <div role="tabpanel" class="tab-pane" id="customer_admins">
            <?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
            <a href="#" data-toggle="modal" data-target="#customer_admins_assign" class="btn btn-info mbot30"><?php echo _l('assign_admin'); ?></a>
            <?php } ?>
            <table class="table dt-table">
               <thead>
                  <tr>
                     <th><?php echo _l('staff_member'); ?></th>
                     <th><?php echo _l('customer_admin_date_assigned'); ?></th>
                     <?php if(has_permission('customers','','create') || has_permission('customers','','edit')){ ?>
                     <th><?php echo _l('options'); ?></th>
                     <?php } ?>
                  </tr>
               </thead>
               <tbody>
                  <?php foreach($customer_admins as $c_admin){ ?>
                  <tr>
                     <td><a href="<?php echo admin_url('profile/'.$c_admin['staff_id']); ?>">
                        <?php echo staff_profile_image($c_admin['staff_id'], array(
                           'staff-profile-image-small',
                           'mright5'
                           ));
                           echo get_staff_full_name($c_admin['staff_id']); ?></a>
                     </td>
                     <td data-order="<?php echo $c_admin['date_assigned']; ?>"><?php echo _dt($c_admin['date_assigned']); ?></td>
                     <?php if(has_permission('customers','','create') || has_permission('customers','','edit')){ ?>
                     <td>
                        <a href="<?php echo admin_url('clients/delete_customer_admin/'.$client->userid.'/'.$c_admin['staff_id']); ?>" class="btn btn-danger _delete btn-icon"><i class="fa fa-remove"></i></a>
                     </td>
                     <?php } ?>
                  </tr>
                  <?php } ?>
               </tbody>
            </table>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane" id="billing_and_shipping">
            <div class="row">
               <div class="col-md-12">
                  <div class="row">
                     <div class="col-md-6">
                        <h4 class="no-mtop"><?php echo _l('billing_address'); ?> <a href="#" class="pull-right billing-same-as-customer"><small class="font-medium-xs"><?php echo _l('customer_billing_same_as_profile'); ?></small></a></h4>
                        <hr />
                        <?php $value=( isset($client) ? $client->billing_street : ''); ?>
                        <?php echo render_textarea( 'billing_street', 'billing_street',$value); ?>
                        <?php $value=( isset($client) ? $client->billing_city : ''); ?>
                        <?php echo render_input( 'billing_city', 'billing_city',$value); ?>
                        <?php $value=( isset($client) ? $client->billing_state : ''); ?>
                        <?php echo render_input( 'billing_state', 'billing_state',$value); ?>
                        <?php $value=( isset($client) ? $client->billing_zip : ''); ?>
                        <?php echo render_input( 'billing_zip', 'billing_zip',$value); ?>
                        <?php $selected=( isset($client) ? $client->billing_country : '' ); ?>
                        <?php echo render_select( 'billing_country',$countries,array( 'country_id',array( 'short_name')), 'billing_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                     </div>
                     <div class="col-md-6">
                        <h4 class="no-mtop">
                           <i class="fa fa-question-circle" data-toggle="tooltip" data-title="<?php echo _l('customer_shipping_address_notice'); ?>"></i>
                           <?php echo _l('shipping_address'); ?> <a href="#" class="pull-right customer-copy-billing-address"><small class="font-medium-xs"><?php echo _l('customer_billing_copy'); ?></small></a>
                        </h4>
                        <hr />
                        <?php $value=( isset($client) ? $client->shipping_street : ''); ?>
                        <?php echo render_textarea( 'shipping_street', 'shipping_street',$value); ?>
                        <?php $value=( isset($client) ? $client->shipping_city : ''); ?>
                        <?php echo render_input( 'shipping_city', 'shipping_city',$value); ?>
                        <?php $value=( isset($client) ? $client->shipping_state : ''); ?>
                        <?php echo render_input( 'shipping_state', 'shipping_state',$value); ?>
                        <?php $value=( isset($client) ? $client->shipping_zip : ''); ?>
                        <?php echo render_input( 'shipping_zip', 'shipping_zip',$value); ?>
                        <?php $selected=( isset($client) ? $client->shipping_country : '' ); ?>
                        <?php echo render_select( 'shipping_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                     </div>
                     <?php if(isset($client) &&
                        (total_rows('tblinvoices',array('clientid'=>$client->userid)) > 0 || total_rows('tblestimates',array('clientid'=>$client->userid)) > 0 || total_rows('tblcreditnotes',array('clientid'=>$client->userid)) > 0)){ ?>
                     <div class="col-md-12">
                        <div class="alert alert-warning">
                           <div class="checkbox checkbox-default">
                              <input type="checkbox" name="update_all_other_transactions" id="update_all_other_transactions">
                              <label for="update_all_other_transactions">
                              <?php echo _l('customer_update_address_info_on_invoices'); ?><br />
                              </label>
                           </div>
                           <b><?php echo _l('customer_update_address_info_on_invoices_help'); ?></b>
                           <div class="checkbox checkbox-default">
                              <input type="checkbox" name="update_credit_notes" id="update_credit_notes">
                              <label for="update_credit_notes">
                              <?php echo _l('customer_profile_update_credit_notes'); ?><br />
                              </label>
                           </div>
                        </div>
                     </div>
                     <?php } ?>
                  </div>
               </div>
            </div>
         </div>
      </div>
   </div>
   <?php echo form_close(); ?>
</div>
<?php if(isset($client)){ ?>
<?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
<div class="modal fade" id="customer_admins_assign" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <?php echo form_open(admin_url('clients/assign_admins/'.$client->userid)); ?>
      <div class="modal-content">
         <div class="modal-header">
            <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
            <h4 class="modal-title"><?php echo _l('assign_admin'); ?></h4>
         </div>
         <div class="modal-body">
            <?php
               $selected = array();
               foreach($customer_admins as $c_admin){
                  array_push($selected,$c_admin['staff_id']);
               }
               echo render_select('customer_admins[]',$staff,array('staffid',array('firstname','lastname')),'',$selected,array('multiple'=>true),array(),'','',false); ?>
         </div>
         <div class="modal-footer">
            <button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
            <button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
         </div>
      </div>
      <!-- /.modal-content -->
      <?php echo form_close(); ?>
   </div>
   <!-- /.modal-dialog -->
</div>
<!-- /.modal -->
<?php } ?>
<?php } ?>
<?php $this->load->view('admin/clients/client_group'); ?>

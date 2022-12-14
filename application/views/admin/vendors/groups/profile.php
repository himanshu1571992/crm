<h4 class="customer-profile-group-heading"><?php echo _l('vendor_add_edit_profile'); ?></h4>
<div class="row">
   <?php echo form_open($this->uri->uri_string(),array('class'=>'vendor-form','autocomplete'=>'off')); ?>
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
            <a href="#billing_and_shipping" aria-controls="billing_and_shipping" role="tab" data-toggle="tab">
            <?php echo _l( 'billing_shipping'); ?>
            </a>
         </li>
         <?php do_action('after_customer_billing_and_shipping_tab',isset($vendor) ? $vendor : false); ?>
         <?php if(isset($vendor)){ ?>
         <!--<li role="presentation">
            <a href="#customer_admins" aria-controls="customer_admins" role="tab" data-toggle="tab">
            <?php echo _l( 'customer_admins' ); ?>
            </a>
         </li>-->
         <?php do_action('after_customer_admins_tab',$vendor); ?>
         <?php } ?>
      </ul>
   </div>
</div>
      <div class="tab-content">
         <?php do_action('after_custom_profile_tab_content',isset($vendor) ? $vendor : false); ?>
         <?php if($customer_custom_fields) { ?>
         <div role="tabpanel" class="tab-pane <?php if($this->input->get('tab') == 'custom_fields'){echo ' active';}; ?>" id="custom_fields">
            <?php $rel_id=( isset($vendor) ? $vendor->userid : false); ?>
            <?php echo render_custom_fields( 'customers',$rel_id); ?>
         </div>
         <?php } ?>
         <div role="tabpanel" class="tab-pane<?php if(!$this->input->get('tab')){echo ' active';}; ?>" id="contact_info">
            <div class="row">
               <div class="col-md-12<?php if(isset($vendor) && (!is_empty_customer_company($vendor->userid) && total_rows('tblcontacts',array('userid'=>$vendor->userid,'is_primary'=>1)) > 0)) { echo ''; } else {echo ' hide';} ?>" id="client-show-primary-contact-wrapper">
                  <div class="checkbox checkbox-info mbot20 no-mtop">
                     <input type="checkbox" name="show_primary_contact"<?php if(isset($vendor) && $vendor->show_primary_contact == 1){echo ' checked';}?> value="1" id="show_primary_contact">
                     <label for="show_primary_contact"><?php echo _l('show_primary_contact',_l('invoices').', '._l('estimates').', '._l('payments').', '._l('credit_notes')); ?></label>
                  </div>
               </div>
               <div class="col-md-6">
                  
                 
				  <div class="form-group">
						<label for="state_id" class="control-label"><?php echo _l('vendor_name'); ?></label>
						<select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
							<option value=""></option>
							<?php
							if (isset($vendor_data) && count($vendor_data) > 0) {
								foreach ($vendor_data as $vendor_key => $vendor_value) {
									?>
									<option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($vendor->vendor_id) && $vendor->vendor_id == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>	
				 
				 
                  <?php $value=( isset($vendor) ? $vendor->phone_no_1 : ''); ?>
                  <?php echo render_input( 'phone_no_1', 'vendor_phonenumber',$value); ?>
                  
                  <?php if((isset($vendor) && empty($vendor->website)) || !isset($vendor)){
                     $value=( isset($vendor) ? $vendor->website : '');
                     echo render_input( 'website', 'vendor_website',$value);
                     } else { ?>
                  <div class="form-group">
                     <label for="website"><?php echo _l('vendor_website'); ?></label>
                     <div class="input-group">
                        <input type="text" name="website" id="website" value="<?php echo $vendor->website; ?>" class="form-control">
                        <div class="input-group-addon">
                           <span><a href="<?php echo maybe_add_http($vendor->website); ?>" target="_blank" tabindex="-1"><i class="fa fa-globe"></i></a></span>
                        </div>
                     </div>
                  </div>
                  <?php }?>
				  <?php $value=( isset($vendor) ? $vendor->pan_no : ''); ?>
				  <?php echo render_input( 'pan_no', 'vendor_pan_no',$value); ?>
				  <?php $value=( isset($vendor) ? $vendor->address : ''); ?>
                  <?php echo render_textarea( 'address', 'vendor_address',$value); ?>
				  <?php if(get_option('company_requires_vat_number_field') == 1){
                     $value=( isset($vendor) ? $vendor->vat : '');
                     echo render_input( 'vat', 'vendor_vat_number',$value);
                     } ?>
					<div class="form-group">
						<label for="state_id" class="control-label"><?php echo _l('site_state'); ?></label>
						<select class="form-control selectpicker" id="state" name="state" onchange="get_city_by_state(this.value)" data-live-search="true">
							<option value=""></option>
							<?php
							if (isset($state_data) && count($state_data) > 0) {
								foreach ($state_data as $state_key => $state_value) {
									?>
									<option value="<?php echo $state_value['id'] ?>" <?php echo (isset($vendor->state) && $vendor->state == $state_value['id']) ? 'selected' : "" ?>><?php echo $state_value['name'] ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>	
					<?php $value=( isset($vendor) ? $vendor->landmark : ''); ?>
					 <?php echo render_input( 'landmark', 'vendor_landmark',$value); ?>
				   
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
                 <!-- <?php if(!isset($vendor)){ ?>
                  <i class="fa fa-question-circle pull-left" data-toggle="tooltip" data-title="<?php echo _l('customer_currency_change_notice'); ?>"></i>
                  <?php }
                     $s_attrs = array('data-none-selected-text'=>_l('system_default_string'));
                     $selected = '';
                     if(isset($vendor) && client_have_transactions($vendor->userid)){
                        $s_attrs['disabled'] = true;
                     }
                     foreach($currencies as $currency){
                        if(isset($vendor)){
                          if($currency['id'] == $vendor->default_currency){
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
                           if(isset($vendor)){
                              if($vendor->default_language == $language){
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
			    <?php $value=( isset($vendor) ? $vendor->vendor_branch_name : ''); ?>
				  <?php echo render_input( 'vendor_branch_name', 'vendor_branch_name',$value); ?>
				   <?php $value=( isset($vendor) ? $vendor->location : ''); ?>
				   <?php $attrss = (isset($vendor) ? array() : array('autofocus'=>true)); ?>
                  <?php echo render_input( 'location', 'vendor_location',$value,'text',$attrss); ?>
				  
				  <?php $value=( isset($vendor) ? $vendor->phone_no_2 : ''); ?>
				  <?php echo render_input( 'phone_no_2', 'vendor_phonenumber2',$value); ?>
				  <?php $value=( isset($vendor) ? $vendor->email_id : ''); ?>
                  <?php echo render_input( 'email_id', 'vendor_email_address',$value); ?>
					<div class="form-group">
						<label for="vendor_cat_id" class="control-label"><?php echo _l('client_cat'); ?></label>
						<select class="form-control selectpicker" data-live-search="true" id="vendor_cat_id" name="vendor_cat_id">
							<option value=""></option>
							<?php
							if (isset($vendor_category_data) && count($vendor_category_data) > 0) {
								foreach ($vendor_category_data as $vendor_category_key => $vendor_category_value) {
									?>
									<option value="<?php echo $vendor_category_value['id'] ?>" <?php echo (isset($vendor->vendor_cat_id) && $vendor->vendor_cat_id == $vendor_category_value['id']) ? 'selected' : "" ?>><?php echo $vendor_category_value['category_name'] ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				   
					  <?php $value=( isset($vendor) ? $vendor->cin_no : ''); ?>
					<?php echo render_input( 'cin_no', 'vendor_cin_no',$value); ?>
				  <div class="form-group">
						<label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>
						<select class="form-control selectpicker" id="city_id" name="city" data-live-search="true">
							<option value=""></option>
							<?php
							if (isset($city_data) && count($city_data) > 0  ) {
								foreach ($city_data as $city_key => $city_value) {
									?>
									<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($vendor->city) && $vendor->city == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
									<?php
								}
							}
							else if(isset($vendor->city) & $vendor->city!='')
							{
								foreach ($allcity as $city_key => $city_value)
								{?>
									<option value="<?php echo $city_value['id'] ?>" <?php echo (isset($vendor->city) && $vendor->city == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
									<?php
								}
							}
							?>
						</select>
					</div>
				 
                  <?php $value=( isset($vendor) ? $vendor->zip : ''); ?>
                  <?php echo render_input( 'zip', 'vendor_postal_code',$value); ?>
                  
               </div>
            </div>
         </div>
         <?php if(isset($vendor)){ ?>
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
                        <a href="<?php echo admin_url('vendors/delete_customer_admin/'.$vendor->userid.'/'.$c_admin['staff_id']); ?>" class="btn btn-danger _delete btn-icon"><i class="fa fa-remove"></i></a>
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
                        <?php $value=( isset($vendor) ? $vendor->billing_street : ''); ?>
                        <?php echo render_textarea( 'billing_street', 'billing_street',$value); ?>
                        <?php $value=( isset($vendor) ? $vendor->billing_city : ''); ?>
                        <?php echo render_input( 'billing_city', 'billing_city',$value); ?>
                        <?php $value=( isset($vendor) ? $vendor->billing_state : ''); ?>
                        <?php echo render_input( 'billing_state', 'billing_state',$value); ?>
                        <?php $value=( isset($vendor) ? $vendor->billing_zip : ''); ?>
                        <?php echo render_input( 'billing_zip', 'billing_zip',$value); ?>
                        <?php $selected=( isset($vendor) ? $vendor->billing_country : '' ); ?>
                        <?php echo render_select( 'billing_country',$countries,array( 'country_id',array( 'short_name')), 'billing_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                     </div>
                     <div class="col-md-6">
                        <h4 class="no-mtop">
                           <i class="fa fa-question-circle" data-toggle="tooltip" data-title="<?php echo _l('customer_shipping_address_notice'); ?>"></i>
                           <?php echo _l('shipping_address'); ?> <a href="#" class="pull-right customer-copy-billing-address"><small class="font-medium-xs"><?php echo _l('customer_billing_copy'); ?></small></a>
                        </h4>
                        <hr />
                        <?php $value=( isset($vendor) ? $vendor->shipping_street : ''); ?>
                        <?php echo render_textarea( 'shipping_street', 'shipping_street',$value); ?>
                        <?php $value=( isset($vendor) ? $vendor->shipping_city : ''); ?>
                        <?php echo render_input( 'shipping_city', 'shipping_city',$value); ?>
                        <?php $value=( isset($vendor) ? $vendor->shipping_state : ''); ?>
                        <?php echo render_input( 'shipping_state', 'shipping_state',$value); ?>
                        <?php $value=( isset($vendor) ? $vendor->shipping_zip : ''); ?>
                        <?php echo render_input( 'shipping_zip', 'shipping_zip',$value); ?>
                        <?php $selected=( isset($vendor) ? $vendor->shipping_country : '' ); ?>
                        <?php echo render_select( 'shipping_country',$countries,array( 'country_id',array( 'short_name')), 'shipping_country',$selected,array('data-none-selected-text'=>_l('dropdown_non_selected_tex'))); ?>
                     </div>
                     <?php if(isset($vendor) &&
                        (total_rows('tblinvoices',array('clientid'=>$vendor->userid)) > 0 || total_rows('tblestimates',array('clientid'=>$vendor->userid)) > 0 || total_rows('tblcreditnotes',array('clientid'=>$vendor->userid)) > 0)){ ?>
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
<?php if(isset($vendor)){ ?>
<?php if (has_permission('customers', '', 'create') || has_permission('customers', '', 'edit')) { ?>
<div class="modal fade" id="customer_admins_assign" tabindex="-1" role="dialog">
   <div class="modal-dialog">
      <?php echo form_open(admin_url('vendors/assign_admins/'.$vendor->userid)); ?>
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


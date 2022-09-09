<?php 
if($proposal->rel_type=='proposal')
{
	$rel_id=$proposal->rel_id;
	$get_lead_details=$this->db->query("SELECT * FROM `tblleads` WHERE `id`='".$rel_id."'")->row_array();
	$customer_id=$get_lead_details['client_id'];
	$invoice->site_id=$get_lead_details['site_id'];
	$this->db->where('id', $get_lead_details['site_id']);
	$sitedata= $this->db->get('tblsitemanager')->row();
	$sitedata= (array) $sitedata;
	$get_state_details=$this->db->query("SELECT * FROM `tblstates` WHERE `id`='".$sitedata['state_id']."'")->row_array();
	$get_city_details=$this->db->query("SELECT * FROM `tblcities` WHERE `id`='".$sitedata['city_id']."'")->row_array();
	$invoice->shipping_street=$sitedata['address'];
	$invoice->shipping_city=$get_city_details['name'];
	$invoice->shipping_state=$get_state_details['name'];
	$invoice->shipping_zip=$sitedata['pincode'];
}
else
{
	$customer_id=$proposal->rel_id;
}
init_head(); ?>
<style>#adminnote{margin: 0px 13.5px 0px 0px;height: 128px;width: 509px;}.error{border:1px solid red !important;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="<?php if(isset($proposal->is_gst)){if ($proposal->is_gst == 1){echo'1';}else{echo'0';}}else{if($clientsate == get_staff_state()){echo'1';}else{echo'0';}} ?>">
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
   <?php  echo form_open('admin/Stock/converttask', array('id' => 'stock')); ?>
      <!-- Modal content-->
	   <textarea name="availablestockarray" id="availablestockarray" style="display:none;"></textarea>
      <div class="modal-content">
	  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"><?php echo _l('check_availability');?></h4>
		</div>
		<div class="modal-body" id="stockavdv">
		</div>
		<div class="modal-footer">
		  <!--<button type="submit" class="btn btn-info uploadpdf">Upload</button>-->
		  <button type="submit" class="btn btn-info" onclick="createtask('stockavdv')" ><?php echo _l('add_task');?></button>
		  <button type="button" id="cmd" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	    <?php echo form_close(); ?>
    </div>
  </div>
<div id="wrapper">
    <div class="content accounting-template">
	<a data-toggle="modal" id="modal" data-target="#myModal"></a>
	<?php if(isset($invoice)){ ?>
      <?php  echo format_invoice_status($invoice->status); ?>
      <hr class="hr-panel-heading" />
      <?php } ?>
      <?php do_action('before_render_invoice_template'); ?>
      <?php if(isset($invoice)){
        echo form_hidden('merge_current_invoice',$invoice->id);
      } ?>
            <?php
			echo form_open($this->uri->uri_string(),array('id'=>'invoice-form','class'=>''));
			if(isset($invoice)){
				echo form_hidden('isedit');
			}
			?>
        <div class="row">
		<?php
            if (isset($proposal)) {
                echo form_hidden('isedit', $proposal->id);
            }
            $rel_type = '';
            $rel_id = '';
            if (isset($proposal) || ($this->input->get('rel_id') && $this->input->get('rel_type'))) {
                if ($this->input->get('rel_id')) {
                    $rel_id = $this->input->get('rel_id');
                    $rel_type = $this->input->get('rel_type');
                } else {
                    $rel_id = $proposal->rel_id;
                    $rel_type = $proposal->rel_type;
                }
            }
            ?>
			<div class="panel_s invoice accounting-template">
			 <div class="panel-body">
			  <div class="row">
			  <div class="col-md-6">
             <div class="f_client_id">
              <div class="form-group select-placeholder">
                <label for="clientid" class="control-label"><?php echo _l('invoice_select_customer'); ?></label>
                <select id="clientid" name="clientid" data-live-search="true" data-width="100%" class="ajax-search<?php if(isset($invoice) && empty($invoice->clientid)){echo ' customer-removed';} ?>" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
               <?php $selected = (isset($invoice) ? $invoice->clientid : '');
                 if($selected == ''){
                   $selected = (isset($customer_id) ? $customer_id: '');
                 }
                 if($selected != ''){
                    $rel_data = get_relation_data('customer',$selected);
                    $rel_val = get_relation_values($rel_data,'customer');
                    echo '<option value="'.$rel_val['id'].'" selected>'.$rel_val['name'].'</option>';
                 } ?>
                </select>
              </div>
            </div>
			<div class="col-md-12">
				<label class="label-control subHeads add_site_div_new" style="float:right;">
				<a class="newsite">Add Site <i class="fa fa-window-restore"></i></a></label>
			</div>
			<div class="sitedv" style="display:none;">
				<div >
					<div class="col-md-6">
						<div class="form-group">
							<label for="sitename" class="control-label"><?php echo _l('site_name'); ?>* </label>
							<input type="text" id="sitename" class="form-control" >
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="sitelocation" class="control-label"><?php echo _l('site_location'); ?>* </label>
							<input type="text" id="sitelocation" class="form-control">
						</div>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label for="sitedescription" class="control-label"><?php echo _l('site_description'); ?></label>
						<textarea id="sitedescription" class="form-control"></textarea>
					</div>
				</div>

				<div class="col-md-12">
					<div class="form-group">
						<label for="siteaddress" class="control-label"><?php echo _l('site_address'); ?>* </label>
						<textarea id="siteaddress" class="form-control" ></textarea>
					</div>
				</div>
				
				<div>
					<div class="col-md-6">
						<div class="form-group">
							<label for="sitestate_id" class="control-label"><?php echo _l('site_state'); ?></label>
							<select class="form-control selectpicker" id="sitestate_id" onchange="get_city_by_stateval(this.value)" data-live-search="true">
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
							<select class="form-control selectpicker" id="sitecity_id" data-live-search="true">
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
							<input type="text" id="sitelandmark" class="form-control">
						</div>
					</div>

					<div class="col-md-6">
						<div class="form-group">
							<label for="sitepincode" class="control-label"><?php echo _l('site_pincode'); ?>* </label>
							<input type="text" id="sitepincode" class="form-control" >
						</div>
					</div>
				</div>
				<div class="text-left" style="margin-bottom:10px;">
					<button class="btn btn-success addsite" type="button"><?php echo _l('add_site'); ?></button>
				</div>
			</div>
			<div class="form-group">
				<label for="site_id" class="control-label"><?php echo _l('site_name'); ?></label>
				<select class="form-control selectpicker" name="site_id" id="site_id" data-live-search="true">
					<option value=""></option>
					<?php
					if (isset($all_site) && count($all_site) > 0) {
						foreach ($all_site as $site_key => $site_value) {
							?>
							<option value="<?php echo $site_value['id'] ?>" <?php echo (isset($invoice->site_id) && $invoice->site_id == $site_value['id']) ? 'selected' : "" ?>><?php echo $site_value['name'] ?></option>
							<?php
						}
					}
					?>
				</select>
			</div>
            <?php
            if(!isset($invoice_from_project)){ ?>
            <div class="form-group select-placeholder projects-wrapper<?php if((!isset($invoice)) || (isset($invoice) && !customer_has_projects($invoice->clientid))){ echo ' hide';} ?>">
               <label for="project_id"><?php echo _l('project'); ?></label>
              <div id="project_ajax_search_wrapper">
                   <select name="project_id" id="project_id" class="projects ajax-search" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                   <?php
                     if(isset($invoice) && $invoice->project_id != 0){
                        echo '<option value="'.$invoice->project_id.'" selected>'.get_project_name_by_id($invoice->project_id).'</option>';
                     }
                   ?>
               </select>
               </div>
            </div>
            <?php } ?>
            <div class="row">
               <div class="col-md-12">
               <hr class="hr-10" />
                  <a href="#" class="edit_shipping_billing_info" data-toggle="modal" data-target="#billing_and_shipping_details"><i class="fa fa-pencil-square-o"></i></a>
                  <?php include_once(APPPATH .'views/admin/invoices/billing_and_shipping_template.php'); ?>
               </div>
               <div class="col-md-6">
                  <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>
                  <address>
                     <span class="billing_street">
                     <?php $billing_street = (isset($invoice) ? $invoice->billing_street : '--'); ?>
                     <?php $billing_street = ($billing_street == '' ? '--' :$billing_street); ?>
                     <?php echo $billing_street; ?></span><br>
                     <span class="billing_city">
                     <?php $billing_city = (isset($invoice) ? $invoice->billing_city : '--'); ?>
                     <?php $billing_city = ($billing_city == '' ? '--' :$billing_city); ?>
                     <?php echo $billing_city; ?></span>,
                     <span class="billing_state">
                     <?php $billing_state = (isset($invoice) ? $invoice->billing_state : '--'); ?>
                     <?php $billing_state = ($billing_state == '' ? '--' :$billing_state); ?>
                     <?php echo $billing_state; ?></span>
                     <br/>
                     <span class="billing_country">
                     <?php $billing_country = (isset($invoice) ? get_country_short_name($invoice->billing_country) : '--'); ?>
                     <?php $billing_country = ($billing_country == '' ? '--' :$billing_country); ?>
                     <?php echo $billing_country; ?></span>,
                     <span class="billing_zip">
                     <?php $billing_zip = (isset($invoice) ? $invoice->billing_zip : '--'); ?>
                     <?php $billing_zip = ($billing_zip == '' ? '--' :$billing_zip); ?>
                     <?php echo $billing_zip; ?></span>
                  </address>
               </div>
               <div class="col-md-6">
                  <p class="bold"><?php echo _l('ship_to'); ?></p>
                  <address>
                     <span class="shipping_street">
                     <?php $shipping_street = (isset($invoice) ? $invoice->shipping_street : '--'); ?>
                     <?php $shipping_street = ($shipping_street == '' ? '--' :$shipping_street); ?>
                     <?php echo $shipping_street; ?></span><br>
                     <span class="shipping_city">
                     <?php $shipping_city = (isset($invoice) ? $invoice->shipping_city : '--'); ?>
                     <?php $shipping_city = ($shipping_city == '' ? '--' :$shipping_city); ?>
                     <?php echo $shipping_city; ?></span>,
                     <span class="shipping_state">
                     <?php $shipping_state = (isset($invoice) ? $invoice->shipping_state : '--'); ?>
                     <?php $shipping_state = ($shipping_state == '' ? '--' :$shipping_state); ?>
                     <?php echo $shipping_state; ?></span>
                     <br/>
                     <span class="shipping_country">
                     <?php $shipping_country = (isset($invoice) ? get_country_short_name($invoice->shipping_country) : '--'); ?>
                     <?php $shipping_country = ($shipping_country == '' ? '--' :$shipping_country); ?>
                     <?php echo $shipping_country; ?></span>,
                     <span class="shipping_zip">
                     <?php $shipping_zip = (isset($invoice) ? $invoice->shipping_zip : '--'); ?>
                     <?php $shipping_zip = ($shipping_zip == '' ? '--' :$shipping_zip); ?>
                     <?php echo $shipping_zip; ?></span>
                  </address>
               </div>
            </div>
            <?php
               $next_invoice_number = get_option('next_invoice_number');
               $format = get_option('invoice_number_format');

               if(isset($invoice)){
                  $format = $invoice->number_format;
               }

               $prefix = get_option('invoice_prefix');

               if ($format == 1) {
                 $__number = $next_invoice_number;
                 if(isset($invoice)){
                   $__number = $invoice->number;
                   $prefix = '<span id="prefix">' . $invoice->prefix . '</span>';
                 }
               } else if($format == 2) {
                 if(isset($invoice)){
                   $__number = $invoice->number;
                   $prefix = $invoice->prefix;
                   $prefix = '<span id="prefix">'. $prefix . '</span><span id="prefix_year">' .date('Y',strtotime($invoice->date)).'</span>/';
                 } else {
                  $__number = $next_invoice_number;
                  $prefix = $prefix.'<span id="prefix_year">'.date('Y').'</span>/';
                }
               } else if($format == 3) {
                  if(isset($invoice)){
                   $yy = date('y',strtotime($invoice->date));
                   $__number = $invoice->number;
                   $prefix = '<span id="prefix">'. $invoice->prefix . '</span>';
                 } else {
                  $yy = date('y');
                  $__number = $next_invoice_number;
                }
               } else if($format == 4) {
                  if(isset($invoice)){
                   $yyyy = date('Y',strtotime($invoice->date));
                   $mm = date('m',strtotime($invoice->date));
                   $__number = $invoice->number;
                   $prefix = '<span id="prefix">'. $invoice->prefix . '</span>';
                 } else {
                  $yyyy = date('Y');
                  $mm = date('m');
                  $__number = $next_invoice_number;
                }
               }

               $_invoice_number = str_pad($__number, get_option('number_padding_prefixes'), '0', STR_PAD_LEFT);
               $isedit = isset($invoice) ? 'true' : 'false';
               $data_original_number = isset($invoice) ? $invoice->number : 'false';

               ?>
            <div class="form-group">
               <label for="number"><?php echo _l('invoice_add_edit_number'); ?></label>
               <div class="input-group">
                  <span class="input-group-addon">
                  <?php if(isset($invoice)){ ?>
                    <a href="#" onclick="return false;" data-toggle="popover" data-container='._transaction_form' data-html="true" data-content="<label class='control-label'><?php echo _l('settings_sales_invoice_prefix'); ?></label><div class='input-group'><input name='s_prefix' type='text' class='form-control' value='<?php echo $invoice->prefix; ?>'></div><button type='button' onclick='save_sales_number_settings(this); return false;' data-url='<?php echo admin_url('invoices/update_number_settings/'.$invoice->id); ?>' class='btn btn-info btn-block mtop15'><?php echo _l('submit'); ?></button>">
                    <i class="fa fa-cog"></i>
                    </a>
                  <?php }
                    echo $prefix;
                  ?>
                  </span>
                  <input type="text" name="number" class="form-control" value="<?php echo $_invoice_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
                  <?php if($format == 3) { ?>
                  <span class="input-group-addon">
                     <span id="prefix_year" class="format-n-yy"><?php echo $yy; ?></span>
                  </span>
                  <?php } else if($format == 4) { ?>
                   <span class="input-group-addon">
                     <span id="prefix_month" class="format-mm-yyyy"><?php echo $mm; ?></span>
                     /
                     <span id="prefix_year" class="format-mm-yyyy"><?php echo $yyyy; ?></span>
                  </span>
                  <?php } ?>
               </div>
            </div>
            <div class="row">
               <div class="col-md-6">
                  <?php $value = (isset($invoice) ? _d($invoice->date) : _d(date('Y-m-d')));
                  $date_attrs = array();
                  if(isset($invoice) && $invoice->recurring > 0 && $invoice->last_recurring_date != null) {
                    $date_attrs['disabled'] = true;
                  }
                  ?>
                  <?php echo render_date_input('date','invoice_add_edit_date',$value,$date_attrs); ?>
               </div>
               <div class="col-md-6">
                  <?php
                  $value = '';
                  if(isset($invoice)){
                    $value = _d($invoice->duedate);
                  } else {
                    if(get_option('invoice_due_after') != 0){
                        $value = _d(date('Y-m-d', strtotime('+' . get_option('invoice_due_after') . ' DAY', strtotime(date('Y-m-d')))));
                    }
                  }
                   ?>
                  <?php echo render_date_input('duedate','invoice_add_edit_duedate',$value); ?>
               </div>
            </div>
                <?php if(is_invoices_overdue_reminders_enabled()){ ?>
               <div class="form-group">
                  <div class="checkbox checkbox-danger">
                     <input type="checkbox" <?php if(isset($invoice) && $invoice->cancel_overdue_reminders == 1){echo 'checked';} ?> id="cancel_overdue_reminders" name="cancel_overdue_reminders">
                     <label for="cancel_overdue_reminders"><?php echo _l('cancel_overdue_reminders_invoice') ?></label>
                  </div>
               </div>
               <?php } ?>
               <?php $rel_id = (isset($invoice) ? $invoice->id : false); ?>
               <?php
                  if(isset($custom_fields_rel_transfer)) {
                      $rel_id = $custom_fields_rel_transfer;
                  }
               ?>
               <?php echo render_custom_fields('invoice',$rel_id); ?>
         </div>
         <div class="col-md-6">
            <div class="panel_s no-shadow">

                   <div class="form-group">
                  <label for="tags" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('tags'); ?></label>
                  <input type="text" class="tagsinput" id="tags" name="tags" value="<?php echo (isset($invoice) ? prep_tags_input(get_tags_in($invoice->id,'invoice')) : ''); ?>" data-role="tagsinput">
               </div>
               <div class="form-group mbot15 select-placeholder">
                  <label for="allowed_payment_modes" class="control-label"><?php echo _l('invoice_add_edit_allowed_payment_modes'); ?></label>
                  <br />
                  <?php if(count($payment_modes) > 0){ ?>
                  <select class="selectpicker" name="allowed_payment_modes[]" data-actions-box="true" multiple="true" data-width="100%" data-title="<?php echo _l('dropdown_non_selected_tex'); ?>">
                  <?php foreach($payment_modes as $mode){
                     $selected = '';
                     if(isset($invoice)){
                       if($invoice->allowed_payment_modes){
                        $inv_modes = unserialize($invoice->allowed_payment_modes);
                        if(is_array($inv_modes)) {
                         foreach($inv_modes as $_allowed_payment_mode){
                           if($_allowed_payment_mode == $mode['id']){
                             $selected = ' selected';
                           }
                         }
                       }
                     }
                     } else {
                     if($mode['selected_by_default'] == 1){
                        $selected = ' selected';
                     }
                     }
                     ?>
                     <option value="<?php echo $mode['id']; ?>"<?php echo $selected; ?>><?php echo $mode['name']; ?></option>
                  <?php } ?>
                  </select>
                  <?php } else { ?>
                  <p><?php echo _l('invoice_add_edit_no_payment_modes_found'); ?></p>
                  <a class="btn btn-info" href="<?php echo admin_url('paymentmodes'); ?>">
                  <?php echo _l('new_payment_mode'); ?>
                  </a>
                  <?php } ?>
               </div>

               <div class="row">
                  <div class="col-md-6">
                     <?php
                        $s_attrs = array('disabled'=>true,'data-show-subtext'=>true);
                        $s_attrs = do_action('invoice_currency_disabled',$s_attrs);
                        foreach($currencies as $currency){
                         if($currency['isdefault'] == 1){
                           $s_attrs['data-base'] = $currency['id'];
                         }
                         if(isset($invoice)){
                          if($currency['id'] == $invoice->currency){
                           $selected = $currency['id'];
                         }
                        } else {
                         if($currency['isdefault'] == 1){
                           $selected = $currency['id'];
                         }
                        }
                        }
                        ?>
                     <?php echo render_select('currency',$currencies,array('id','name','symbol'),'invoice_add_edit_currency',$selected,$s_attrs); ?>
                  </div>
                  <div class="col-md-6">
                     <?php
                        $i = 0;
                        $selected = '';
                        foreach($staff as $member){
                         if(isset($invoice)){
                           if($invoice->sale_agent == $member['staffid']) {
                             $selected = $member['staffid'];
                           }
                         }
                         $i++;
                        }
                        echo render_select('sale_agent',$staff,array('staffid',array('firstname','lastname')),'sale_agent_string',$selected);
                        ?>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group select-placeholder">
                        <label for="recurring" class="control-label">
                        <?php echo _l('invoice_add_edit_recurring'); ?>
                        </label>
                        <select class="selectpicker" data-width="100%" name="recurring" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                           <?php for($i = 0; $i <=12; $i++){ ?>
                           <?php
                              $selected = '';
                              if(isset($invoice)){
                                if($invoice->custom_recurring == 0){
                                 if($invoice->recurring == $i){
                                   $selected = 'selected';
                                 }
                               }
                              }
                              if($i == 0){
                               $reccuring_string =  _l('invoice_add_edit_recurring_no');
                              } else if($i == 1){
                               $reccuring_string = _l('invoice_add_edit_recurring_month',$i);
                              } else {
                               $reccuring_string = _l('invoice_add_edit_recurring_months',$i);
                              }
                              ?>
                           <option value="<?php echo $i; ?>" <?php echo $selected; ?>><?php echo $reccuring_string; ?></option>
                           <?php } ?>
                           <option value="custom" <?php if(isset($invoice) && $invoice->recurring != 0 && $invoice->custom_recurring == 1){echo 'selected';} ?>><?php echo _l('recurring_custom'); ?></option>
                        </select>
                     </div>
                  </div>
                  <div class="col-md-6">
                     <div class="form-group select-placeholder">
                        <label for="discount_type" class="control-label"><?php echo _l('discount_type'); ?></label>
                        <select name="discount_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                           <option value="" selected><?php echo _l('no_discount'); ?></option>
                           <option value="before_tax" <?php
                              if(isset($invoice)){ if($invoice->discount_type == 'before_tax'){ echo 'selected'; }} ?>><?php echo _l('discount_type_before_tax'); ?></option>
                           <option value="after_tax" <?php if(isset($invoice)){if($invoice->discount_type == 'after_tax'){echo 'selected';}} ?>><?php echo _l('discount_type_after_tax'); ?></option>
                        </select>
                     </div>
                  </div>
                  <div class="recurring_custom <?php if((isset($invoice) && $invoice->custom_recurring != 1) || (!isset($invoice))){echo 'hide';} ?>">
                     <div class="col-md-6">
                        <?php $value = (isset($invoice) && $invoice->custom_recurring == 1 ? $invoice->recurring : 1); ?>
                        <?php echo render_input('repeat_every_custom','',$value,'number',array('min'=>1)); ?>
                     </div>
                     <div class="col-md-6">
                        <select name="repeat_type_custom" id="repeat_type_custom" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                           <option value="day" <?php if(isset($invoice) && $invoice->custom_recurring == 1 && $invoice->recurring_type == 'day'){echo 'selected';} ?>><?php echo _l('invoice_recurring_days'); ?></option>
                           <option value="week" <?php if(isset($invoice) && $invoice->custom_recurring == 1 && $invoice->recurring_type == 'week'){echo 'selected';} ?>><?php echo _l('invoice_recurring_weeks'); ?></option>
                           <option value="month" <?php if(isset($invoice) && $invoice->custom_recurring == 1 && $invoice->recurring_type == 'month'){echo 'selected';} ?>><?php echo _l('invoice_recurring_months'); ?></option>
                           <option value="year" <?php if(isset($invoice) && $invoice->custom_recurring == 1 && $invoice->recurring_type == 'year'){echo 'selected';} ?>><?php echo _l('invoice_recurring_years'); ?></option>
                        </select>
                     </div>
                  </div>
                  <div id="cycles_wrapper" class="<?php if(!isset($invoice) || (isset($invoice) && $invoice->recurring == 0)){echo ' hide';}?>">
                     <div class="col-md-12">
                        <?php $value = (isset($invoice) ? $invoice->cycles : 0); ?>
                        <div class="form-group recurring-cycles">
                          <label for="cycles"><?php echo _l('recurring_total_cycles'); ?>
                            <?php if(isset($invoice) && $invoice->total_cycles > 0){
                              echo '<small>' . _l('cycles_passed', $invoice->total_cycles) . '</small>';
                            }
                            ?>
                          </label>
                          <div class="input-group">
                            <input type="number" class="form-control"<?php if($value == 0){echo ' disabled'; } ?> name="cycles" id="cycles" value="<?php echo $value; ?>" <?php if(isset($invoice) && $invoice->total_cycles > 0){echo 'min="'.($invoice->total_cycles).'"';} ?>>
                            <div class="input-group-addon">
                              <div class="checkbox">
                                <input type="checkbox"<?php if($value == 0){echo ' checked';} ?> id="unlimited_cycles">
                                <label for="unlimited_cycles"><?php echo _l('cycles_infinity'); ?></label>
                              </div>
                            </div>
                          </div>
                        </div>
                     </div>
                  </div>
               </div>
               <?php $value = (isset($invoice) ? $invoice->adminnote : ''); ?>
               <?php echo render_textarea('adminnote','invoice_add_edit_admin_note',$value); ?>

					</div>
				 </div>
			    </div>
			  </div>
			</div>
			<div class="col-md-12">
				<div class="panel_s">
					<div class="panel-body">
				<?php
					if(!isset($contactdata))
					{?>
					<div class="table-responsive s_table">
							<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
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
												<input type="text" minlength="10" maxlength="10" id="phonenumber0" name="clientdata[0][phonenumber]" onBlur="checkcontno(this.value,0);" class="form-control onlynumbers"><span id="phonenumberdiv0"></span>
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
								<label class="label-control subHeads"><a  class="addmorecontact" value="<?php echo count($productcomponent); ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
							</div>
						</div>
						<?php
					}
					else
					{?>
					<div class="table-responsive s_table">
						<table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
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
								$i=0;
								foreach($contactdata as $singlecontactdata)
								{$i++;?>
								<tr class="main" id="trcc<?php echo $i;?>">
									<td>
										<div class="form-group">
										<input type="hidden" name="client_data[<?php echo $i;?>][clientid]" value="<?php echo $singlecontactdata['contactid'];?>">
											<input type="text" id="firstname" name="clientdata[<?php echo $i;?>][firstname]" value="<?php echo $singlecontactdata['firstname'];?>" class="form-control" >
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" id="email<?php echo $i;?>" name="clientdata[<?php echo $i;?>][email]" value="<?php echo $singlecontactdata['email'];?>" onBlur="checkmail(this.value,0);" class="form-control clientmail" >
										</div>
									</td>
									<td>
										<div class="form-group">
											<input type="text" id="phonenumber<?php echo $i;?>" name="clientdata[<?php echo $i;?>][phonenumber]" value="<?php echo $singlecontactdata['phonenumber'];?>" onBlur="checkcontno(this.value,0);" class="form-control onlynumbers contact1"><span id="phonenumberdiv1"></span>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[<?php echo $i;?>][designation_id]">
												<option value=""></option>
												<?php
												if (isset($designation_data) && count($designation_data) > 0) {
													foreach ($designation_data as $designation_key => $designation_value) {
														?>
														<option value="<?php echo $designation_value['id'] ?>" <?php if($singlecontactdata['designation_id']==$designation_value['id']){echo"selected=selected";}?>><?php echo $designation_value['designation'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</td>
									<td>
										<div class="form-group">
											<select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[<?php echo $i;?>][contact_type]">
												<option value=""></option>
												<?php
												if (isset($contact_type_data) && count($contact_type_data) > 0) {
													foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
														?>
														<option value="<?php echo $contact_type_value['id'] ?>" <?php if($singlecontactdata['contact_type']==$contact_type_value['id']){echo"selected=selected";}?>><?php echo $contact_type_value['contact_type'] ?></option>
														<?php
													}
												}
												?>
											</select>
										</div>
									</td>
									<td>
										<button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('<?php echo $i;?>');" ><i class="fa fa-remove"></i></button>
									</td>
								</tr>
								<?php
								}?>
							</tbody>
						</table>
						<div class="col-xs-12">
							<label class="label-control subHeads"><a  class="addmorecontact" value="<?php echo count($contactdata); ?>"><?php echo _l('add_more_client_person');?> <i class="fa fa-plus"></i></a></label>
						</div>
					</div>
				<?php
					}?>
				</div>
			  </div>
			</div>
	  
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_rent'); ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop renttable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 10px !important;"><i class="fa fa-cog"></i></td>
                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_months'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_days'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>
                                                    <?php
                                                    if (isset($proposal->is_gst)) {
                                                        if ($proposal->is_gst == 1) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($clientsate == get_staff_state()) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td style="width: 47px !important;"><?php echo $label; ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
												//print_r($rent_prolist);
                                                $i = 0;
												$totprod =0;
                                                if (isset($rent_prolist)) { 
													 $totprod=count($rent_prolist);?>												  
                                                <input type="hidden" id="totalrentpro" value="<?php echo count($rent_prolist); ?>">
												<input type="hidden" id="rent_company_category" value="1">
                                                <?php
                                                foreach ($rent_prolist as $single_prod_rent_det) {
                                                    $i++;
                                                    $proprice = $single_prod_rent_det['rate'];
													$months=$single_prod_rent_det['months']+($single_prod_rent_det['days']/30);
                                                    $prodprice = $proprice * $single_prod_rent_det['qty']*$months;
                                                    $totpro = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);
                                                    $prodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_rent_det['pro_id'] . "'")->row_array();
                                                    $pricelist = array($prodet['rental_price_cat_a'], $prodet['rental_price_cat_b'], $prodet['rental_price_cat_c'], $prodet['rental_price_cat_d']);
                                                    $min_price = min($pricelist);
                                                    $profitper = (($proprice - $min_price) / $min_price) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }
                                                    ?>
                                                    <tr class="trrentpro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removerentpro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_rent_det['pro_id']; ?>">
                                                                <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo $single_prod_rent_det['description']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_rent_det['pro_id']; ?>" name="rentproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $single_prod_rent_det['id']; ?>" name="rentproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                            <input value="<?php echo $min_price; ?>" id="averageprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_rent_det['long_description']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_rent_det['pro_id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_rent_det['hsn_code']; ?>">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['qty']; ?>">
                                                        </td>
														<td>
                                                            <input type="text" class="form-control" id="rentmonths_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][months]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_rent_det['months']; ?>">
                                                        </td>
														<td>
                                                            <input type="number" class="form-control" id="rentdays_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][days]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['days']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentmainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $proprice; ?>" name="rentproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentprice_<?php echo $i; ?>" value="<?php echo $proprice * $single_prod_rent_det['qty']; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="rentdisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="<?php echo $single_prod_rent_det['discount']; ?>" name="rentproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="rentdisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodprice * $single_prod_rent_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="rentdisc_price_<?php echo $i; ?>" value="<?php echo $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="rentprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($single_prod_rent_det['is_gst'] == 1) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="0">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="renttax_amt_<?php echo $i; ?>" value="<?php echo (($prodprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_<?php echo $i; ?>">
                                                            <?php echo ($totpro); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
										<div class="col-xs-12">
											<label class="label-control subHeads"><a class="addmorerentpro" value="<?php echo $totprod;?>">Add More <i class="fa fa-plus"></i></a></label>
										</div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control rent_total_amt" value="<?php echo (isset($proposal) && $proposal->rentsubtotal != '') ? $proposal->rentsubtotal : ""; ?>" name="rentproposal[finalsubtotalamount]" id="rent_total_amt">
                                        <div class="sale_total_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>
                                        <input type="text" class="form-control rent_discount_percentage" value="<?php echo (isset($proposal) && $proposal->rent_discount_percent != '') ? $proposal->rent_discount_percent : ""; ?>" onchange="get_total_disc_rent()" name="rentproposal[finaldiscountpercentage]" id="rent_discount_percentage">
                                        <div class="sale_discount_percentageError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control rent_discount_amt" value="<?php echo (isset($proposal) && $proposal->rent_discount_total != '') ? $proposal->rent_discount_total : ""; ?>" name="rentproposal[finaldiscountamount]" id="rent_discount_amt">
                                        <div class="sale_discount_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Quotation Amount (Rent) <span style="color:red">*</span></label>
                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control rent_total_quotation_amt" value="<?php echo (isset($proposal) && $proposal->renttotal != '') ? $proposal->renttotal : ""; ?>" name="rentproposal[totalamount]" id="rent_total_quotation_amt">
                                        <div class="sale_total_quotation_amtError error_msg"></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Total Margin Profits</label>
                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;padding:0;" class="col-md-6 pull-left control-label rent_total_quotation_margin_profit text-right"></label></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_amt_in_words text-right"></label>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Tax Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label rent_total_quotation_tax_amt_in_words text-right"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <hr/>
                        <div class="table-responsive s_table" style="margin-top:3%;">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('other_charges_for_rent'); ?></h4>
                                <hr/>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                <thead>
                                    <tr>
                                        <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>
                                        <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>
                                        <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>
                                        <?php
                                        if (isset($proposal->is_gst)) {
                                            if ($proposal->is_gst == 1) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        } else {
                                            if ($clientsate == get_staff_state()) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        }
                                        ?>
                                        <th width="10%" align="left"><?php
                                            if ($clientsate == get_staff_state()) {
                                                echo _l('cgst_amt_sgst_amt');
                                            } else {
                                                echo _l('cgst_amt_igst_amt');
                                            }
                                            ?>	</th>
                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>
                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable">
                                    <?php
                                    if (count($rent_othercharges) > 0) {
                                        $l = 0;
                                        foreach ($rent_othercharges as $singlerentotherchargesp) {
                                            $l++;
                                            ?>
                                            <tr id="tr<?php echo $l; ?>">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="othercharges<?php echo $l; ?>" onchange="otherchargesdata(<?php echo $l; ?>)" name="othercharges[<?php echo $l; ?>][category_name]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($othercharges) && count($othercharges) > 0) {
                                                                foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                    ?>
                                                                    <option value="<?php echo $othercharges_value['id'] ?>" <?php
                                                                    if (isset($singlerentotherchargesp['category_name']) && $singlerentotherchargesp['category_name'] != '' && $singlerentotherchargesp['category_name'] == $othercharges_value['id']) {
                                                                        echo'selected=selected';
                                                                    }
                                                                    ?> ><?php echo $othercharges_value['category_name'] ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sac_code<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['sac_code']; ?>" name="othercharges[<?php echo $l; ?>][sac_code]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="amount<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['amount']; ?>" name="othercharges[<?php echo $l; ?>][amount]" onchange="getothercharges('<?php echo $l; ?>')"  class="form-control" >
                                                    </div>
                                                </td>
                                                <?php
                                                if (isset($proposal->is_gst)) {
                                                    if ($proposal->is_gst == 1) {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="gst<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['gst']; ?>" name="othercharges[<?php echo $l; ?>][gst]" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sgst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlerentotherchargesp['sgst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <?php
                                                    }
                                                } else {
                                                    if ($clientsate == get_staff_state()) {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="gst<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['gst']; ?>" name="othercharges[<?php echo $l; ?>][gst]" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sgst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlerentotherchargesp['sgst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>

                                                        <?php
                                                    } else {
                                                        ?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >
                                                            </div>
                                                        </td>
												<?php
                                                    }
                                                }
                                                ?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="gst_sgst_amt<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlerentotherchargesp['gst_sgst_amt']; ?>"  class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="total_maount<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlerentotherchargesp['total_maount']; ?>" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
									<?php
                                        }
                                    }
                                    ?>
                                </tbody>
                            </table>
                            <div class="col-xs-4">
                                <label class="label-control subHeads"><a  class="addmore" value="<?php echo count($rent_othercharges); ?>">Add More <i class="fa fa-plus"></i></a></label>
                            </div>
                            <div class="col-xs-8">
                                <label style="float : right !important;">
                                    <strong style="font-size:14px;">Other Charges Sub Total For Rent :-</strong>
                                    <strong class="rent_other_charges_subtotal">0</strong>		
                                </label>
                            </div>
                        </div>
                        <div class="row" style="margin-top:8%;">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_sale'); ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
													<td style="width: 10px !important;"><i class="fa fa-cog"></i></td>
                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>
                                                    <?php
                                                    if (isset($proposal->is_gst)) {
                                                        if ($proposal->is_gst == 1) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    } else {
                                                        if ($clientsate == get_staff_state()) {
                                                            $label = _l('prop_pro_sgst_amt');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_cgst'); ?>% </td>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_sgst'); ?>%</td>
                                                            <?php
                                                        } else {
                                                            $label = _l('prop_pro_igst');
                                                            ?>
                                                            <td style="width: 47px !important;"><?php echo _l('prop_pro_igst'); ?>%</td>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                    <td style="width: 47px !important;"><?php echo $label; ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 0;
                                                if (isset($sale_prolist)) {
													$totsaleprod=count($sale_prolist);
                                                    ?>
                                                <input type="hidden" id="totalsalepro" value="<?php echo count($sale_prolist); ?>">
                                                <?php
                                                foreach ($sale_prolist as $single_prod_sale_det) {
                                                    $prosaleprice = $single_prod_sale_det['rate'];
                                                    $prodproposalprice = $prosaleprice * $single_prod_sale_det['qty'];
                                                    //$totproamt=$prodproposalprice-(($prodproposalprice*$single_prod_sale_det['discount'])/100)+(($prodproposalprice*18)/100);
                                                    $totproamt = $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100);
                                                    $i++;
                                                    $saleprodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_sale_det['pro_id'] . "'")->row_array();
                                                    $salepricelist = array($saleprodet['sale_price_cat_a'], $saleprodet['sale_price_cat_b'], $saleprodet['sale_price_cat_c'], $saleprodet['sale_price_cat_d']);
                                                    $min_saleprice = min($salepricelist);
                                                    $min_salepricee[] = min($salepricelist);
                                                    $profitper = (($prosaleprice - $min_saleprice) / $min_saleprice) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }?>
                                                    <tr class="trsalepro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_sale_det['pro_id']; ?>">
                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['description']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_sale_det['pro_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_sale_det['long_description']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_sale_det['pro_id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * $single_prod_sale_det['qty']; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['discount']; ?>" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodproposalprice * $single_prod_sale_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($proposal->is_gst == 1) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($prodproposalprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">
                                                            <?php echo ($totproamt); ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                            } else {
                                                $totsaleprod=count($lead_prod_sale_det);?>
                                                <input type="hidden" id="totalsalepro" value="<?php echo count($lead_prod_sale_det); ?>">
                                                <?php
                                                foreach ($lead_prod_sale_det as $single_prod_sale_det) {
                                                    $i++;
                                                    if ($single_prod_sale_det['company_category'] == 1) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_a'];
                                                    } else if ($single_prod_sale_det['company_category'] == 2) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_b'];
                                                    } else if ($single_prod_sale_det['company_category'] == 3) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_c'];
                                                    } else if ($single_prod_sale_det['company_category'] == 4) {
                                                        $prosaleprice = $single_prod_sale_det['sale_price_cat_d'];
                                                    }
                                                    $salepricelist = array($single_prod_sale_det['sale_price_cat_a'], $single_prod_sale_det['sale_price_cat_b'], $single_prod_sale_det['sale_price_cat_c'], $single_prod_sale_det['sale_price_cat_d']);
                                                    $min_saleprice = min($salepricelist);
                                                    $min_salepricee[] = min($salepricelist);
                                                    $profitper = (($prosaleprice - $min_saleprice) / $min_saleprice) * 100;
                                                    if ($profitper >= 0 && $profitper <= 9.99) {
                                                        $color = 'red';
                                                    } else if ($profitper >= 10 && $profitper <= 14.99) {
                                                        $color = 'yellow';
                                                    } else if ($profitper >= 15 && $profitper <= 19.99) {
                                                        $color = 'blue';
                                                    } else if ($profitper >= 20 && $profitper <= 29.99) {
                                                        $color = 'green';
                                                    } else if ($profitper >= 30) {
                                                        $color = 'orange';
                                                    }
                                                    ?>
                                                    <tr class="trsalepro<?php echo $i; ?>">
														<td>
															<button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
														</td>
                                                        <td>
                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_sale_det['id']; ?>">
                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['name']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_sale_det['product_remarks']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="PRO-ID<?php echo $single_prod_sale_det['id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">
                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="0.00">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">
                                                        </td>
                                                        <?php
                                                        if ($single_prod_rent_det['state'] == get_staff_state()) {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="1">
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" value="9">
                                                            </td>
                                                            <?php
                                                        } else {
                                                            ?>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">
                                                                <input readonly="" type="text" class="form-control" value="18">
                                                            </td>
                                                        <?php }
                                                        ?>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($prosaleprice * 18) / 100); ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">
                                                            <?php echo ($prosaleprice); ?>
                                                        </td>
                                                    </tr>
											<?php
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>
										<div class="col-xs-12">
											<label class="label-control subHeads"><a class="addmoresalepro" value="<?php echo $totsaleprod;?>">Add More <i class="fa fa-plus"></i></a></label>
										</div>
									</div>
                                </div>
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_total_amt" value="<?php echo (isset($proposal) && $proposal->salesubtotal != '') ? $proposal->salesubtotal : ""; ?>" name="saleproposal[finalsubtotalamount]" id="sale_total_amt">
                                        <div class="sale_total_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>
                                        <input type="text" class="form-control sale_discount_percentage" value="<?php echo (isset($proposal) && $proposal->sale_discount_percent != '') ? $proposal->sale_discount_percent : ""; ?>" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_discount_amt" value="<?php echo (isset($proposal) && $proposal->sale_discount_total != '') ? $proposal->sale_discount_total : ""; ?>" name="saleproposal[finaldiscountamount]" id="sale_discount_amt">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Quotation Amount (Rent) <span style="color:red">*</span></label>
                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo (isset($proposal) && $proposal->saletotal != '') ? $proposal->saletotal : ""; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_amt_in_words text-right"></label>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Total Margin Profits</label>
                                        <div class="col-md-6" style="background:#80808057;margin:0;padding:0"><label style="margin:0;font-weight:500;font-size: 16px;text-transform: capitalize;padding:0;" class="col-md-6 pull-left control-label sale_total_quotation_margin_profit text-right"></label></div>
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Tax Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_tax_amt_in_words text-right"></label>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="table-responsive s_table" style="margin-top:3%;">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3"><?php echo _l('other_charges_for_sale'); ?></h4>
                                <hr/>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="mysaleTable">
                                <thead>
                                    <tr>
                                        <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>
                                        <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>
                                        <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>
                                        <?php
                                        if (isset($proposal->is_gst)) {
                                            if ($proposal->is_gst == 1) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        } else {
                                            if ($clientsate == get_staff_state()) {
                                                ?>
                                                <th width="10%" align="left"><?php echo _l('other_charges_cgst'); ?>	</th>
                                                <th width="10%" align="left"><?php echo _l('other_charges_sgst'); ?>	</th>
                                                <?php
                                            } else {
                                                ?>
                                                <th width="20%" align="left"><?php echo _l('other_charges_igst'); ?>	</th>
                                                <?php
                                            }
                                        }?>
                                        <th width="10%" align="left"><?php
                                            if ($clientsate == get_staff_state()) {
                                                echo _l('cgst_amt_sgst_amt');
                                            } else {
                                                echo _l('cgst_amt_igst_amt');
                                            }
                                            ?>	</th>
                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>
                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable">
                                    <?php
                                    if (count($sale_othercharges) > 0) {
                                        $l = 0;
                                        foreach ($sale_othercharges as $singlesaleothercharges) {
                                            $l++;
                                            ?>
                                            <tr id="trsale<?php echo $l; ?>">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="sale_othercharges<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][category_name]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($othercharges) && count($othercharges) > 0) {
                                                                foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                    ?>
                                                                    <option value="<?php echo $othercharges_value['id'] ?>" <?php
                                                                    if (isset($singlesaleothercharges['category_name']) && $singlesaleothercharges['category_name'] != '' && $singlesaleothercharges['category_name'] == $othercharges_value['id']) {
                                                                        echo'selected=selected';
                                                                    }
                                                                    ?> ><?php echo $othercharges_value['category_name'] ?></option>
                                                                            <?php
                                                                        }
                                                                    }?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_sac_code<?php echo $l; ?>" value="<?php echo $singlesaleothercharges['sac_code']; ?>" name="saleothercharges[<?php echo $l; ?>][sac_code]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_amount<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['amount']; ?>" name="saleothercharges[<?php echo $l; ?>][amount]" class="form-control" >
                                                    </div>
                                                </td>
											<?php
                                                if (isset($proposal->is_gst)) {
                                                    if ($proposal->is_gst == 1) {?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_gst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['gst']; ?>" name="saleothercharges[<?php echo $l; ?>][gst]" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_sgst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlesaleothercharges['sgst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
												<?php
                                                    } else {?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
												<?php
                                                    }
                                                } else {
                                                    if ($clientsate == get_staff_state()) {?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_gst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['gst']; ?>" name="saleothercharges[<?php echo $l; ?>][gst]" class="form-control" >
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_sgst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][sgst]" value="<?php echo $singlesaleothercharges['sgst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
												<?php
                                                    } else {?>
                                                        <td>
                                                            <div class="form-group">
                                                                <input type="text" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >
                                                            </div>
                                                        </td>
											<?php
                                                    }
                                                }?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_gst_sgst_amt<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlesaleothercharges['gst_sgst_amt']; ?>" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_total_maount<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlesaleothercharges['total_maount']; ?>" class="form-control">
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
									<?php
                                        }
                                    } else {?>
                                        <tr id="trsale0">
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" data-live-search="true" id="sale_othercharges0" name="saleothercharges[0][category_name]">
                                                        <option value=""></option>
													<?php
                                                        if (isset($othercharges) && count($othercharges) > 0) {
                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                                                                ?>
                                                                <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo $othercharges_value['category_name'] ?></option>
                                                                <?php
                                                            }
                                                        }?>
                                                    </select>
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_sac_code0" name="saleothercharges[0][sac_code]" class="form-control" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_amount0" onchange="getothersalecharges(0)" name="saleothercharges[0][amount]" class="form-control" >
                                                </div>
                                            </td>
                                            <?php
                                            if ($clientsate == get_staff_state()) {?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_gst0"  value="0" onchange="getothersalecharges(0)" name="saleothercharges[0][gst]" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_sgst0" value="0" onchange="getothersalecharges(0)" name="saleothercharges[0][sgst]" class="form-control" >
                                                    </div>
                                                </td>
										<?php
                                            } else {?>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="sale_igst0" onchange="getothersalecharges(0)" name="saleothercharges[0][igst]" class="form-control" >
                                                    </div>
                                                </td>
                                            <?php } ?>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_gst_sgst_amt0" name="saleothercharges[0][gst_sgst_amt]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" id="sale_total_maount0" name="saleothercharges[0][total_maount]" class="form-control">
                                                </div>
                                            </td>
                                            <td>
                                                <button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges('0');" ><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                    <?php } ?>
                                </tbody>
                            </table>
                            <div class="col-xs-4">
                                <label class="label-control subHeads"><a  class="addsalemore" value="<?php echo count($sale_othercharges); ?>">Add More <i class="fa fa-plus"></i></a></label>
                            </div>
                            <div class="col-xs-8">
                                <label style="float : right !important;">
                                    <strong style="font-size:14px;">Other Charges Sub Total For Sale :-</strong>
                                    <strong class="sale_other_charges_subtotal">0</strong>		
                                </label>
                            </div>
                        </div>
						<?php $default_setting_field=explode(',',$default_setting_field[0]); ?>
						<div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){echo'ss';if(in_array('name', $proposalfields)){echo"checked=checked";}}else if(isset($default_setting_field)){echo'ee';if(in_array('Product Name', $default_setting_field)){echo"checked=checked";}} ?> value="name">
                                        <label>Product Name</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('sac_code', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('SAC Code', $default_setting_field)){echo"checked=checked";}}?> value="sac_code">
                                        <label>SAC Code</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('hsn_code', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('HSN Code', $default_setting_field)){echo"checked=checked";}}?> value="hsn_code">
                                        <label>HSN Code</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('working_height', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Working Height', $default_setting_field)){echo"checked=checked";}}?> value="working_height">
                                        <label>Working Height</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('tower_height', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Tower Height', $default_setting_field)){echo"checked=checked";}}?> value="tower_height">
                                        <label>Tower Height</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('platform_height', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Platform Height', $default_setting_field)){echo"checked=checked";}}?> value="platform_height">
                                        <label>Platform Height</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('dimensions', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Dimention', $default_setting_field)){echo"checked=checked";}}?> value="dimensions">
                                        <label>Dimention</label>
                                    </div>
									<div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('photo', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Photo', $default_setting_field)){echo"checked=checked";}}?> value="photo">
                                        <label>photo</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('purchase_price', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Purchase price', $default_setting_field)){echo"checked=checked";}}?> value="purchase_price">
                                        <label>Purchase price</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('product_weight', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Product Weight', $default_setting_field)){echo"checked=checked";}}?> value="product_weight">
                                        <label>Product Weight</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('product_remarks', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Product Remarks', $default_setting_field)){echo"checked=checked";}}?> value="product_remarks">
                                        <label>Product Remarks</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('product_description', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Product Description', $default_setting_field)){echo"checked=checked";}}?> value="product_description">
                                        <label>Product Description</label>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('damage_rate', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Damage Rate', $default_setting_field)){echo"checked=checked";}}?> value="damage_rate">
                                        <label>Damage Rate</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('lost_rate', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Lost Rate', $default_setting_field)){echo"checked=checked";}}?> value="lost_rate">
                                        <label>Lost Rate</label>
                                    </div>
                                    <div class="checkbox">
                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('repairable_rate', $proposalfields)) echo"checked=checked";}else if(isset($default_setting_field)){if(in_array('Repairable Rate', $default_setting_field)){echo"checked=checked";}}?> value="repairable_rate">
                                        <label>Repairable Rate</label>
                                    </div>
                                </div>
                            </div>
                        </div>
						<div  class="col-md-12">
							<div class="form-group">
								<label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>
								<textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions"><?php if(isset($estimate) && $estimate->terms_and_conditions!=''){echo $estimate->terms_and_conditions;}else{echo"1). Payment: 100% Advance<br/>2). Freight(Demob) will be charged extra at actual.<br/>3). Lead Time- 2-3 working days from the date of receipt of confirm order.<br/>4). Any other charges other than mentioned if incurred, shall be charged at actual. Sub Total (I) 66,000.00<br/>5). Unloading of Equipment/Material will not be in SCHACH'S scope. Freight(mob) At actual<br/>6). One time free training/Installation of scaffold/machine shall be conducted by us Sub Total (II) 66,000.00<br/>7). Security cheque (without date ) of material value will be required CGST 9% 5,940.00<br/>before material dispatch. (Material Value - 7.4 lacs) SGST 9% 5,940.00<br/>We hope our offer is in line with your requirement and we wait for your valued order, which shall receive our best and prompt attention.";}?></textarea>
							</div>
						</div>
                    </div>
                </div>
            </div>
			<div class="btn-bottom-toolbar text-right">
                                <button class="btn-tr btn btn-default mleft10 text-right invoice-form-submit save-as-draft transaction-submit">
                Save as Draft                </button>
                                <button class="btn-tr btn btn-info mleft10 text-right invoice-form-submit save-and-send transaction-submit">
                  Save &amp; Send                </button>
                <button class="btn-tr btn btn-info mleft10 text-right invoice-form-submit transaction-submit">
                  Save                </button>
             </div>
            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<script>
$('.check_availability').click(function ()
    {
		var warehouse_id=$('#warehouse_id').val();
		var service_type=$('#service_type').val();
		if(warehouse_id!='' & service_type!='')
		{
			var formData = $('#proposal-form').serialize();
		   $.ajax({
					url:'<?php echo base_url(); ?>admin/Stock/getstockavailability',				
					type:'post',
					data: formData,
					success:function (data, status) {
						//alert(data);die();
						var res=JSON.parse(data);
								$('#availablestockhtml').val(res.html);
								$('#availablestockarray').val(res.productdata);
								//alert(res.html);
								$('.modal-body').html(res.html);
								//$('.modal-body').html('hh');
								//$('body').addClass('modal-open');
								//$('#myModal').addClass('in');
								//$('#myModal').show();
								jQuery(function(){
								   jQuery('#modal').click();
								});
								$('.warehouseerror').hide();
								$('.servicetypeerror').hide();
							}
					});
		}
		else
		{
			if(warehouse_id=='')
			{
				$('.warehouseerror').show();
			}
			else
			{
				$('.warehouseerror').hide();
			}
			if(service_type=='')
			{
				$('.servicetypeerror').show();
			}
			else
			{
				$('.servicetypeerror').hide();
			}
		}
	});
 $(function () {
        init_currency_symbol();
        // Maybe items ajax search
        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
        validate_proposal_form();
     
        $('.rel_id_label').html(_rel_type.find('option:selected').text());
        _rel_type.on('change', function () {
            var clonedSelect = _rel_id.html('').clone();
            _rel_id.selectpicker('destroy').remove();
            _rel_id = clonedSelect;
            $('#rel_id_select').append(clonedSelect);
            proposal_rel_id_select();
            if ($(this).val() != '') {
                _rel_id_wrapper.removeClass('hide');
            } else {
                _rel_id_wrapper.addClass('hide');
            }
            $('.rel_id_label').html(_rel_type.find('option:selected').text());
        });
        proposal_rel_id_select();
<?php if (!isset($proposal) && $rel_id != '') { ?>
            _rel_id.change();
<?php } ?>

    });
   /* function proposal_rel_id_select() {
        var serverData = {};
        serverData.rel_id = _rel_id.val();
        data.type = _rel_type.val();
<?php if (isset($proposal)) { ?>
            serverData.connection_type = 'proposal';
            serverData.connection_id = '<?php echo $proposal->id; ?>';
<?php } ?>
        init_ajax_search(_rel_type.val(), _rel_id, serverData);
    }*/
    function validate_proposal_form() {
        _validate_form($('#proposal-form'), {
            subject: 'required',
            proposal_to: 'required',
            rel_type: 'required',
            rel_id: 'required',
            date: 'required',
            email: {
                email: true,
                required: true
            },
            currency: 'required',
        });
    }
    function get_total_price_per_qty_rent(value)
    {
        var price = $('#rentmainprice_' + value).val();
        var qty = $('#rentqty_' + value).val();
        var months = $('#rentmonths_' + value).val();
        var days = $('#rentdays_' + value).val();
		var totalmonths=(parseInt(months)+(parseInt(days)/30)).toFixed(2);
		//alert(totalmonths);
        var total_price = (price * qty*totalmonths);
       // var total_price = (price * qty);
        var disc = $('#rentdisc_' + value).val();
        $('#rentprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#rentdisc_amt_' + value).val(disc_amt);
        $('#rentdisc_price_' + value).val(disc_price);
        $('#renttax_amt_' + value).val((disc_price * 18) / 100);
        //var disc_price = $('#rentdisc_price_' + value).val();
        var tax_amt = $('#renttax_amt_' + value).val();
        //var grand_total=parseInt(disc_price)+parseInt(tax_amt);
        var grand_total = parseInt(disc_price);
        $('#grand_total_' + value).text(grand_total);
        var totalamt = 0;
        $('table.renttable').find('td.totalamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.rent_total_amt').val(totalamt);
        //$('.rent_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
       // var totalpro = $('#totalrentpro').attr('value');
        var totalpro = $('.addmorerentpro').attr('value');
        for (i = 0; i <= totalpro; i++) {
            arry[j++] = parseInt($('#renttax_amt_' + i).val());
            minarry[j++] = ((parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val()))* parseInt(totalmonths));
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++) {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++) {
            totalminprice += minarry[k] << 0;
        }
        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var rentamt = $('#averageprice' + value).val();
        var rentamt = (rentamt * qty * totalmonths);
        var marginprofit = (100 * (disc_price - rentamt) / rentamt);
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.rent_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
		$('.rent_total_quotation_margin_profit').css("width", totalmarginprofit+'%'); 

        if (marginprofit >= 0 && marginprofit <= 9.99) {
            var color = 'red';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 10 && marginprofit <= 14.99) {
            var color = 'yellow';
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 15 && marginprofit <= 19.99) {
            var color = 'blue';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 20 && marginprofit <= 29.99) {
            var color = 'green';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('red');
            $('#rentprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 30) {
            var color = 'orange';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('red');
        } else if (marginprofit <= 0) {
            var color = 'red';
            $('#rentprofit_amt' + value).removeClass('yellow');
            $('#rentprofit_amt' + value).removeClass('blue');
            $('#rentprofit_amt' + value).removeClass('green');
            $('#rentprofit_amt' + value).removeClass('orange');
        }
        
        $('#rentprofit_amt' + value).val(marginprofit);
        $('#rentprofit_amt' + value).addClass(color);
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99) {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99) {
            var margincolor = 'yellow';
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99) {
            var margincolor = 'blue';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99) {
            var margincolor = 'green';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30) {
            var margincolor = 'orange';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0) {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        }
        $('.rent_total_quotation_margin_profit').addClass(margincolor);
    }
    
    function get_total_disc_rent() {
        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));
    }

    function get_total_price_per_qty_sale(value) {
        var price = $('#salemainprice_' + value).val();
        var qty = $('#saleqty_' + value).val();
        var total_price = (price * qty);
        var disc = $('#saledisc_' + value).val();
        $('#saleprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#saledisc_amt_' + value).val(disc_amt);
        $('#saledisc_price_' + value).val(disc_price);
        $('#saletax_amt_' + value).val((disc_price * 18) / 100);
        //var disc_price=$('#saledisc_price_'+value).val();
        var tax_amt = $('#saletax_amt_' + value).val();
        var grand_total = parseInt(disc_price);
        $('#grand_total_sale' + value).text(grand_total);
        var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        //$('.sale_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        //var totalpro = $('#totalsalepro').attr('value');
        var totalpro = $('.addmoresalepro').attr('value');
        for (i = 0; i <= totalpro; i++) {
            arry[j++] = parseInt($('#saletax_amt_' + i).val());
            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++) {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++) {
            totalminprice += minarry[k] << 0;
        }

        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var rentamt = $('#averagesaleprice' + value).val();
        var rentamt = (rentamt * qty);
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
		$('.sale_total_quotation_margin_profit').css("width", totalmarginprofit+'%'); 
        var marginprofit = (100 * (disc_price - rentamt) / rentamt);
        if (marginprofit >= 0.00 && marginprofit <= 9.99)
        {
            var color = 'red';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 10 && marginprofit <= 14.99)
        {
            var color = 'yellow';
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 15 && marginprofit <= 19.99)
        {
            var color = 'blue';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 20 && marginprofit <= 29.99)
        {
            var color = 'green';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('red');
            $('#saleprofit_amt' + value).removeClass('orange');
        } else if (marginprofit >= 30)
        {
            var color = 'orange';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('red');
        }
        if (marginprofit <= 0)
        {
            var color = 'red';
            $('#saleprofit_amt' + value).removeClass('yellow');
            $('#saleprofit_amt' + value).removeClass('blue');
            $('#saleprofit_amt' + value).removeClass('green');
            $('#saleprofit_amt' + value).removeClass('orange');
        }
        $('#saleprofit_amt' + value).val(marginprofit);
        $('#saleprofit_amt' + value).addClass(color);


        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        }
        $('.sale_total_quotation_margin_profit').addClass(margincolor);
    }
    function get_total_disc_sale()
    {
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));
    }
    $(document).ready(function () {
        var totalamt = 0;
        $('table.renttable').find('td.totalamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.rent_total_amt').val(totalamt);
        //$('.rent_total_quotation_amt').val(totalamt);

        var rent_total_amt = $('.rent_total_amt').val();
        var rent_discount_percentage = $('.rent_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.rent_discount_amt').val(disamt);
        $('.rent_total_quotation_amt').val(distotalamt);
        $('.rent_total_quotation_amt_in_words').html(toWords(distotalamt));
        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalrentpro').attr('value');
        for (i = 0; i <= totalpro; i++)
        {
            arry[j++] = parseInt($('#renttax_amt_' + i).val());
            minarry[j++] = parseInt($('#averageprice' + i).val()) * parseInt($('#rentqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++)
        {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++)
        {
            totalminprice += minarry[k] << 0;
        }
        $('.rent_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
		$('.rent_total_quotation_margin_profit').css("width", totalmarginprofit+'%'); 
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('red');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.rent_total_quotation_margin_profit').removeClass('yellow');
            $('.rent_total_quotation_margin_profit').removeClass('blue');
            $('.rent_total_quotation_margin_profit').removeClass('green');
            $('.rent_total_quotation_margin_profit').removeClass('orange');
        }
        $('.rent_total_quotation_margin_profit').addClass(margincolor);

        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addsalemore').attr('value');
        for (i = 0; i <= addmore; i++)
        {
            arr[j++] = parseInt($('#sale_total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++)
        {
            total += arr[i] << 0;
        }
        $('.sale_other_charges_subtotal').html(total);
    });
    $(document).ready(function () {


        var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseInt(totalamt) + parseInt($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseInt(rent_total_amt) - parseInt(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));

        var i;
        var arry = [];
        var minarry = [];
        j = 0;
        var totalpro = $('#totalsalepro').attr('value');
        for (i = 0; i <= totalpro; i++)
        {
            arry[j++] = parseInt($('#saletax_amt_' + i).val());
            minarry[j++] = parseInt($('#averagesaleprice' + i).val()) * parseInt($('#saleqty_' + i).val());
        }
        var totaltax = 0;
        for (var i = 0; i < arry.length; i++)
        {
            totaltax += arry[i] << 0;
        }
        var totalminprice = 0;
        for (var k = 0; k < minarry.length; k++)
        {
            totalminprice += minarry[k] << 0;
        }

        $('.sale_total_quotation_tax_amt_in_words').html(toWords(totaltax));
        var totalmarginprofit = (100 * (distotalamt - totalminprice) / totalminprice);
        //$('.sale_total_quotation_margin_profit').html(Math.round(totalmarginprofit)+'%');
        $('.sale_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
		$('.sale_total_quotation_margin_profit').css("width", totalmarginprofit+'%'); 
        if (totalmarginprofit >= 0 && totalmarginprofit <= 9.99)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
			
        } else if (totalmarginprofit >= 10 && totalmarginprofit <= 14.99)
        {
            var margincolor = 'yellow';
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 15 && totalmarginprofit <= 19.99)
        {
            var margincolor = 'blue';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 20 && totalmarginprofit <= 29.99)
        {
            var margincolor = 'green';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('red');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        } else if (totalmarginprofit >= 30)
        {
            var margincolor = 'orange';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('red');
        } else if (totalmarginprofit <= 0)
        {
            var margincolor = 'red';
            $('.sale_total_quotation_margin_profit').removeClass('yellow');
            $('.sale_total_quotation_margin_profit').removeClass('blue');
            $('.sale_total_quotation_margin_profit').removeClass('green');
            $('.sale_total_quotation_margin_profit').removeClass('orange');
        }
        $('.sale_total_quotation_margin_profit').addClass(margincolor);

        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addmore').attr('value');
        for (i = 0; i <= addmore; i++)
        {
            arr[j++] = parseInt($('#total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++)
        {
            total += arr[i] << 0;
        }
        $('.rent_other_charges_subtotal').html(total);
    });
</script>
<script type="text/javascript">
// American Numbering System
    var th = ['', 'thousand', 'million', 'billion', 'trillion'];

    var dg = ['zero', 'one', 'two', 'three', 'four', 'five', 'six', 'seven', 'eight', 'nine'];

    var tn = ['ten', 'eleven', 'twelve', 'thirteen', 'fourteen', 'fifteen', 'sixteen', 'seventeen', 'eighteen', 'nineteen'];

    var tw = ['twenty', 'thirty', 'forty', 'fifty', 'sixty', 'seventy', 'eighty', 'ninety'];

    function toWords(s) {
        s = s.toString();
        s = s.replace(/[\, ]/g, '');
        if (s != parseFloat(s))
            return 'not a number';
        var x = s.indexOf('.');
        if (x == -1)
            x = s.length;
        if (x > 15)
            return 'too big';
        var n = s.split('');
        var str = '';
        var sk = 0;
        for (var i = 0; i < x; i++) {
            if ((x - i) % 3 == 2) {
                if (n[i] == '1') {
                    str += tn[Number(n[i + 1])] + ' ';
                    i++;
                    sk = 1;
                } else if (n[i] != 0) {
                    str += tw[n[i] - 2] + ' ';
                    sk = 1;
                }
            } else if (n[i] != 0) {
                str += dg[n[i]] + ' ';
                if ((x - i) % 3 == 0)
                    str += 'hundred ';
                sk = 1;
            }
            if ((x - i) % 3 == 1) {
                if (sk)
                    str += th[(x - i - 1) / 3] + ' ';
                sk = 0;
            }
        }
        if (x != s.length) {
            var y = s.length;
            str += 'point ';
            for (var i = x + 1; i < y; i++)
                str += dg[n[i]] + ' ';
        }
        return str.replace(/\s+/g, ' ');

    }
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
	<?php
		if (isset($proposal->is_gst))
		{
			if ($proposal->is_gst == 1){?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0){foreach ($othercharges as $othercharges_key => $othercharges_value){?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][gst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0){ foreach ($othercharges as $othercharges_key => $othercharges_value){?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" onchange="getothercharges('+newaddmore+')" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="igst' + newaddmore + '" value="0" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
		}
		else 
		{
			if ($clientsate == get_staff_state()) {?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php  if (isset($othercharges) && count($othercharges) > 0) {foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst' + newaddmore + '" value="0" name="othercharges[' + newaddmore + '][gst]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" value="0" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][sgst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="igst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][igst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="text" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
		}?>
		$('.selectpicker').selectpicker('refresh');
    });

    $('.addmorerentpro').click(function ()
    {
		var addmorerentpro = parseInt($(this).attr('value'));
		var check_gst = parseInt($('#check_gst').val());
        var newaddmorerentpro = addmorerentpro + 1;
        $(this).attr('value', newaddmorerentpro);
		if(check_gst==0)
		{
			$('.renttable tbody').append('<tr class="trrentpro'+newaddmorerentpro+'"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro('+newaddmorerentpro+');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getprodata('+newaddmorerentpro+')" data-live-search="true" id="prodid'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_id]"><option value=""></option><?php	if (isset($product_data) && count($product_data) > 0) {foreach ($product_data as $product_key => $product_value) {?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }}?></select><input class="form-control" type="hidden" id="rentpro_name'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_id]" type="hidden"><input value="150" name="rentproposal['+newaddmorerentpro+'][itemid]" type="hidden"><input value="" id="averageprice'+newaddmorerentpro+'" type="hidden"></td><td><input type="text" readonly class="form-control" id="rentpro_remark_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][remark]"></td><td><input type="text" class="form-control" readonly id="rentpro_pro_id_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][pro_id]"></td><td><input type="text" id="rentpro_pro_hsncode_'+newaddmorerentpro+'" class="form-control" readonly name="rentproposal['+newaddmorerentpro+'][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][qty]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="rentmonths_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][months]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][days]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="0" value="0"></td><td><input type="text" class="form-control" id="rentmainprice_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" name="rentproposal['+newaddmorerentpro+'][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_'+newaddmorerentpro+'" ></td><td><input type="text" class="form-control" id="rentdisc_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" value="0" name="rentproposal['+newaddmorerentpro+'][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_'+newaddmorerentpro+'" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_'+newaddmorerentpro+'"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt'+newaddmorerentpro+'" value="20"></td><td><input type="hidden" name="rentproposal['+newaddmorerentpro+'][isgst]" value="0"><input readonly="" type="text" class="form-control" value="18"></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_'+newaddmorerentpro+'" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_'+newaddmorerentpro+'"></td></tr>');
		}
		else
		{
			$('.renttable tbody').append('<tr class="trrentpro'+newaddmorerentpro+'"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro('+newaddmorerentpro+');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getprodata('+newaddmorerentpro+')" data-live-search="true" id="prodid'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_id]"><option value=""></option><?php	if (isset($product_data) && count($product_data) > 0) {foreach ($product_data as $product_key => $product_value) {?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }}?></select><input class="form-control" id="rentpro_name'+newaddmorerentpro+'" type="hidden" name="rentproposal['+newaddmorerentpro+'][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_id]" type="hidden"><input value="150" name="rentproposal['+newaddmorerentpro+'][itemid]" type="hidden"><input value="" id="averageprice'+newaddmorerentpro+'" type="hidden"></td><td><input type="text" class="form-control" readonly id="rentpro_remark_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][remark]"></td><td><input type="text" class="form-control" id="rentpro_pro_id_'+newaddmorerentpro+'" readonly name="rentproposal['+newaddmorerentpro+'][pro_id]"></td><td><input type="text" class="form-control" id="rentpro_pro_hsncode_'+newaddmorerentpro+'" readonly name="rentproposal['+newaddmorerentpro+'][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][qty]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="rentmonths_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][months]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][days]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="0" value="0"></td><td><input type="text" class="form-control" id="rentmainprice_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" name="rentproposal['+newaddmorerentpro+'][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_'+newaddmorerentpro+'" ></td><td><input type="text" class="form-control" id="rentdisc_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" value="0" name="rentproposal['+newaddmorerentpro+'][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_'+newaddmorerentpro+'" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_'+newaddmorerentpro+'"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt'+newaddmorerentpro+'" value="20"></td><td><input type="hidden" name="rentproposal['+newaddmorerentpro+'][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_'+newaddmorerentpro+'" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_'+newaddmorerentpro+'"></td></tr>');
		}
		$('.selectpicker').selectpicker('refresh');
	});
	
	$('.addmoresalepro').click(function ()
    {
		var addmorerentpro = parseInt($(this).attr('value'));
		var check_gst = parseInt($('#check_gst').val());
        var newaddmorerentpro = addmorerentpro + 1;
        $(this).attr('value', newaddmorerentpro);
		if(check_gst==0)
		{
			$('.saletable tbody').append('<tr class="trsalepro'+newaddmorerentpro+'"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro('+newaddmorerentpro+');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata('+newaddmorerentpro+')" data-live-search="true" id="saleprodid'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_id]"><option value=""></option><?php	if (isset($product_data) && count($product_data) > 0) {foreach ($product_data as $product_key => $product_value) {?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }}?></select><input class="form-control" type="hidden" id="salepro_name'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_id]" type="hidden"><input value="" name="saleproposal['+newaddmorerentpro+'][itemid]" type="hidden"><input value="" id="averagesaleprice'+newaddmorerentpro+'" type="hidden"></td><td><input type="text" readonly class="form-control" id="salepro_remark_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][remark]"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][pro_id]"></td><td><input type="text" id="salepro_pro_hsncode_'+newaddmorerentpro+'" class="form-control" readonly name="saleproposal['+newaddmorerentpro+'][hsn_code]"></td><td><input type="number" class="form-control" id="saleqty_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][qty]" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" name="saleproposal['+newaddmorerentpro+'][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_'+newaddmorerentpro+'" ></td><td><input type="text" class="form-control" id="saledisc_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" value="0" name="saleproposal['+newaddmorerentpro+'][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_'+newaddmorerentpro+'" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_'+newaddmorerentpro+'"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt'+newaddmorerentpro+'"></td><td><input type="hidden" name="saleproposal['+newaddmorerentpro+'][isgst]" value="0"><input readonly="" type="text" class="form-control" value="18"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_'+newaddmorerentpro+'" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale'+newaddmorerentpro+'"></td></tr>');
		}
		else
		{
			$('.saletable tbody').append('<tr class="trsalepro'+newaddmorerentpro+'"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro('+newaddmorerentpro+');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata('+newaddmorerentpro+')" data-live-search="true" id="saleprodid'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_id]"><option value=""></option><?php	if (isset($product_data) && count($product_data) > 0) {foreach ($product_data as $product_key => $product_value) {?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php }}?></select><input class="form-control" id="salepro_name'+newaddmorerentpro+'" type="hidden" name="saleproposal['+newaddmorerentpro+'][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_id]" type="hidden"><input value="" name="saleproposal['+newaddmorerentpro+'][itemid]" type="hidden"><input value="" id="averagesaleprice'+newaddmorerentpro+'" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_remark_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][remark]"></td><td><input type="text" class="form-control" id="salepro_pro_id_'+newaddmorerentpro+'" readonly name="saleproposal['+newaddmorerentpro+'][pro_id]"></td><td><input type="text" class="form-control" id="salepro_pro_hsncode_'+newaddmorerentpro+'" readonly name="saleproposal['+newaddmorerentpro+'][hsn_code]"></td><td><input type="number" class="form-control" id="saleqty_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][qty]" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" name="saleproposal['+newaddmorerentpro+'][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_'+newaddmorerentpro+'" ></td><td><input type="text" class="form-control" id="saledisc_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" value="0" name="saleproposal['+newaddmorerentpro+'][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_'+newaddmorerentpro+'" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_'+newaddmorerentpro+'"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt'+newaddmorerentpro+'"></td><td><input type="hidden" name="saleproposal['+newaddmorerentpro+'][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_'+newaddmorerentpro+'" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale'+newaddmorerentpro+'"></td></tr>');
		}
		$('.selectpicker').selectpicker('refresh');
	});
	$('.addsalemore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
	<?php
		if (isset($proposal->is_gst)) 
		{
			if ($proposal->is_gst == 1) {?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {  foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" onchange="getothersalecharges('+newaddmore+')"  class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][gst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>  $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_igst' + newaddmore + '" value="0" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" value="0" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php }
		} 
		else 
		{
			if ($clientsate == get_staff_state()) {?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '"  name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) {foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" onchange="getothersalecharges('+newaddmore+')" ></div></td><td><div class="form-group"><input type="text" id="sale_gst' + newaddmore + '" value="0" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][gst]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="text" onchange="getothersalecharges('+newaddmore+')" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_igst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][igst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="text" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php  }
		}?>
		$('.selectpicker').selectpicker('refresh');
    });
    function removeothercharges(othercharg) {
        $('#tr' + othercharg).remove();
        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addmore').attr('value');
        for (i = 0; i <= addmore; i++) {
            arr[j++] = parseInt($('#total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++) {
            total += arr[i] << 0;
        }
        $('.rent_other_charges_subtotal').html(total);
    }

	
	function removerentpro(value) 
	{
        $('.trrentpro' + value).remove();
		get_total_price_per_qty_rent(value);
	}
	function removesalepro(value) 
	{
        $('.trsalepro' + value).remove();
		get_total_price_per_qty_sale(value);
	}
    function removesaleothercharges(othercharg) {
        $('#trsale' + othercharg).remove();
        var i;
        var arr = [];
        j = 0;
        var addmore = $('.addsalemore').attr('value');
        for (i = 0; i <= addmore; i++) {
            arr[j++] = parseInt($('#sale_total_maount' + i).val());
        }
        var total = 0;
        for (var i = 0; i < arr.length; i++) {
            total += arr[i] << 0;
        }
        $('.sale_other_charges_subtotal').html(total);
    }
	function get_rel_list(value)
	{
		var rel_type=value;
		var url = '<?php echo base_url(); ?>admin/Proposals/get_rel_list';
		var html = '<option value=""></option>';
		$.post(url,
				{
					rel_type: rel_type,
				},
				function (data, status) 
				{
					if(data != "")
					{
						var resArr = $.parseJSON(data);
						if(rel_type=='proposal')
						{
							$.each(resArr, function(k, v) {
								html+= '<option value="'+v.id+'">'+v.leadno+'</option>';
							});
							$('.rel_id_label').text('Lead');
						}
						if(rel_type=='customer')
						{
							$.each(resArr, function(k, v) {
								html+= '<option value="'+v.userid+'">'+v.client_branch_name+' - '+v.email_id+'</option>';
							});
							$('.rel_id_label').text('client');
						}
					}
					$("#rel_id").val('');
					$("#rel_id").html('').html(html);
					<?php if((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $proposal->rel_id;?>');<?php }?>
					<?php if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $proposal->rel_id;?>');<?php }?>
					<?php if(isset($_GET['rel_id'])){?> $("#rel_id").val('<?php echo $_GET['rel_id'];?>');<?php }?>
					$('.selectpicker').selectpicker('refresh');
				});
	}
	 $(function () {
		 <?php if(isset($_GET['rel_id'])){?>
		 var rel_id= '<?php echo $_GET['rel_id'];?>';
		 get_rel_list('proposal');
		 
		 $.get(admin_url + 'proposals/get_relation_data_values/' + rel_id + '/proposal', function (response) {
                    $('input[name="proposal_to"]').val(response.to);
                    $('textarea[name="address"]').val(response.address);
                    $('input[name="email"]').val(response.email);
                    $('input[name="phone"]').val(response.phone);
                    $('input[name="city"]').val(response.city);
                    $('input[name="state"]').val(response.state);
                    $('#state').val(response.state);
                    $('#city').val(response.city);
                    $('#source').val(response.source);
                    $('input[name="zip"]').val(response.zip);
                    $('select[name="country"]').selectpicker('val', response.country);
                    $('.selectpicker').selectpicker('refresh');
                    var currency_selector = $('#currency');
                    if (_rel_type.val() == 'customer') {
                        if (typeof (currency_selector.attr('multi-currency')) == 'undefined') {
                            currency_selector.attr('disabled', true);
                        }

                    } else {
                        currency_selector.attr('disabled', false);
                    }
                    var proposal_to_wrapper = $('[app-field-wrapper="proposal_to"]');
                    if (response.is_using_company == false && !empty(response.company)) {
                        proposal_to_wrapper.find('#use_company_name').remove();
                        proposal_to_wrapper.find('#use_company_help').remove();
                        proposal_to_wrapper.append('<div id="use_company_help" class="hide">' + response.company + '</div>');
                        proposal_to_wrapper.find('label')
                                .prepend("<a href=\"#\" id=\"use_company_name\" data-toggle=\"tooltip\" data-title=\"<?php echo _l('use_company_name_instead'); ?>\" onclick='document.getElementById(\"proposal_to\").value = document.getElementById(\"use_company_help\").innerHTML.trim(); this.remove();'><i class=\"fa fa-building-o\"></i></a> ");
                    } else {
                        proposal_to_wrapper.find('label #use_company_name').remove();
                        proposal_to_wrapper.find('label #use_company_help').remove();
                    }
                    /* Check if customer default currency is passed */
                    if (response.currency) {
                        currency_selector.selectpicker('val', response.currency);
                    } else {
                        /* Revert back to base currency */
                        currency_selector.selectpicker('val', currency_selector.data('base'));
                    }
                    currency_selector.selectpicker('refresh');
                    currency_selector.change();
                }, 'json');
		 <?php }
		 if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {
		 ?>
		  get_rel_list('customer');
		 <?php }
		 if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {
		 ?>
		  get_rel_list('proposal');
		 <?php }?>
	 });
	 
	 function getothercharges(value)
	 {
		var amount=$('#amount'+value).val(); 
		var igst=$('#igst'+value).val(); 
		if (typeof igst === "undefined"){ var gst=$('#gst'+value).val(); var sgst=$('#sgst'+value).val(); var igst=parseInt(gst)+parseInt(sgst); }
		var totalgstamt=parseInt((igst*amount)/100);
		var totalamt=parseInt(amount)+parseInt(totalgstamt);
		$('#gst_sgst_amt'+value).val(totalgstamt); 
		$('#total_maount'+value).val(totalamt); 
		var i;
		var arr = [];
		j = 0;
		var addmore = $('.addmore').attr('value');
		for (i = 0; i <= addmore; i++)
		{
			arr[j++] = parseInt($('#total_maount' + i).val());
		}
		var total = 0;
		for (var i = 0; i < arr.length; i++)
		{
			total += arr[i] << 0;
		}
		$('.rent_other_charges_subtotal').html(total);
	 }
	 
	 function getothersalecharges(value)
	 {
		var sale_amount=$('#sale_amount'+value).val(); 
		var igst=$('#sale_igst'+value).val(); 
		if (typeof igst === "undefined"){ var gst=$('#sale_gst'+value).val(); var sgst=$('#sale_sgst'+value).val(); var igst=parseInt(gst)+parseInt(sgst); }
		var totalgstamt=parseInt((igst*sale_amount)/100);
		var totalamt=parseInt(sale_amount)+parseInt(totalgstamt);
		$('#sale_gst_sgst_amt'+value).val(totalgstamt); 
		$('#sale_total_maount'+value).val(totalamt); 
		var i;
		var arr = [];
		j = 0;
		var addmore = $('.addsalemore').attr('value');
		for (i = 0; i <= addmore; i++) {
			arr[j++] = parseInt($('#sale_total_maount' + i).val());
		}
		var total = 0;
		for (var i = 0; i < arr.length; i++) {
			total += arr[i] << 0;
		}
		$('.sale_other_charges_subtotal').html(total);
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
	function getprodata(value)
	{
		var prodid=$('#prodid'+value).val();
		var check_gst = parseInt($('#check_gst').val());
		var rent_company_category=$('#rent_company_category').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getproddetails';
		$.post(url,
				{
					prodid: prodid,
					rent_company_category: rent_company_category,
				},
				function (data, status) {
					var res=JSON.parse(data);
					$('#renpro_id'+value).val(prodid);
					$('#rentpro_remark_'+value).val(res.product_remarks);
					$('#rentpro_name'+value).val(res.name);
					$('#rentpro_pro_id_'+value).val(res.pro_id);
					$('#rentpro_pro_hsncode_'+value).val(res.hsn_code);
					$('#averageprice'+value).val(res.min_rentprice);
					$('#rentmainprice_'+value).val(res.proprice);
					$('#rentprice_'+value).val(res.proprice);
					$('#rentdisc_price_'+value).val(res.proprice);
					$('#renttax_amt_'+value).val(res.gstamt);
					$('#grand_total_'+value).text(res.proprice);
					$('.selectpicker').selectpicker('refresh');
					get_total_price_per_qty_rent(value);
				});
	}
	
	function getsaleprodata(value)
	{
		var prodid=$('#saleprodid'+value).val();
		var check_gst = parseInt($('#check_gst').val());
		var rent_company_category=$('#rent_company_category').val();
		var url = '<?php echo base_url(); ?>admin/Site_manager/getsaleproddetails';
		$.post(url,
				{
					prodid: prodid,
					rent_company_category: rent_company_category,
				},
				function (data, status) {
					var res=JSON.parse(data);
					$('#salepro_id'+value).val(prodid);
					$('#salepro_remark_'+value).val(res.product_remarks);
					$('#salepro_name'+value).val(res.name);
					$('#salepro_pro_id_'+value).val(res.pro_id);
					$('#salepro_pro_hsncode_'+value).val(res.hsn_code);
					$('#averagesaleprice'+value).val(res.min_rentprice);
					$('#salemainprice_'+value).val(res.proprice);
					$('#saleprice_'+value).val(res.proprice);
					$('#saledisc_price_'+value).val(res.proprice);
					$('#saletax_amt_'+value).val(res.gstamt);
					$('#grand_total_sale'+value).text(res.proprice);
					get_total_price_per_qty_sale(value);
					$('.selectpicker').selectpicker('refresh');
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
					
					$('.shipping_street').html(res.address);
					$('#shipping_street').val(res.address);
					$('.shipping_state').html(res.state_name);
					$('#shipping_state').val(res.state_name);
					$('.shipping_city').html(res.city_name);
					$('#shipping_city').val(res.city_name);
					$('.shipping_zip').html(res.pincode);
					$('#shipping_zip').val(res.pincode);
				});
		
	});
	$('.addmorecontact').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myContactTable tbody').append('<tr class="main" id="trcc'+newaddmore+'"><td><div class="form-group"><input type="text" id="firstname" name="clientdata['+newaddmore+'][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="email'+newaddmore+'" name="clientdata['+newaddmore+'][email]" class="form-control" onBlur="checkmail(this.value,'+newaddmore+');"></div></td><td><div class="form-group"><input type="text" minlength="10" maxlength="10" onkeyup="nospaces(this)" id="phonenumber'+newaddmore+'" onBlur="checkcontno(this.value,'+newaddmore+');" name="clientdata['+newaddmore+'][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($designation_data) && count($designation_data) > 0) {	foreach ($designation_data as $designation_key => $designation_value) {?><option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="clientdata['+newaddmore+'][designation_id]"><option value=""></option><?php	if (isset($contact_type_data) && count($contact_type_data) > 0) {foreach ($contact_type_data as $contact_type_key => $contact_type_value) {?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }}?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
		 $('.selectpicker').selectpicker('refresh');
	});
	function removeclientperson(procompid)
    {
        $('#trcc' + procompid).remove();
    }
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
</script>
<script>
	$(function(){
		//validate_invoice_form();
	    // Init accountacy currency symbol
	    init_currency_symbol();
	    // Project ajax search
	    init_ajax_project_search_by_customer_id();
	    // Maybe items ajax search
	    init_ajax_search('items','#item_select.ajax-search',undefined,admin_url+'items/search');
	});
</script>
<script type="text/javascript">
  $('.onlynumbers').keypress(function(event){



       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){

           event.preventDefault(); //stop character from entering input

       }



   });
  $(function() { 
        $('.contact1').on('keypress', function(e) {
          $('span.error-keyup-4').remove();
            if (e.which == 32){
              $("#phonenumberdiv1").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
        });
});
  $(function() { 
        $('#phonenumber0').on('keypress', function(e) {
          $('span.error-keyup-4').remove();
            if (e.which == 32){
              $("#phonenumberdiv0").html('<span class="error error-keyup-4" style="color: red;">Space not allowed</span>');
                console.log('Space Detected');
                return false;
            }
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

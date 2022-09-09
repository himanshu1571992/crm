<?php
$session_id = $this->session->userdata();
init_head();
?>
<style>#address{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
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
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-6">
                                <div class="f_client_id">
                                    <div class="form-group select-placeholder">
                                        <label for="clientid" class="control-label"><?php echo _l('estimate_select_customer'); ?></label>
                                        <select id="clientid" name="clientid" data-live-search="true" data-width="100%" class="ajax-search<?php
                                        if (isset($estimate) && empty($estimate->clientid)) {
                                            echo ' customer-removed';
                                        }
                                        ?>" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                    <?php
                                                    $selected = (isset($estimate) ? $estimate->clientid : '');
                                                    if ($selected == '') {
                                                        $selected = (isset($customer_id) ? $customer_id : '');
                                                    }
                                                    if ($selected != '') {
                                                        $rel_data = get_relation_data('customer', $selected);
                                                        $rel_val = get_relation_values($rel_data, 'customer');
                                                        echo '<option value="' . $rel_val['id'] . '" selected>' . $rel_val['name'] . '</option>';
                                                    }
                                                    ?>
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
                                                <input type="text" id="sitelocation" class="form-control" >
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
                                                <option value="<?php echo $site_value['id'] ?>" <?php echo (isset($estimate->site_id) && $estimate->site_id == $site_value['id']) ? 'selected' : "" ?>><?php echo $site_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="row">
                                    <div class="col-md-12">
                                        <a href="#" class="edit_shipping_billing_info" data-toggle="modal" data-target="#billing_and_shipping_details"><i class="fa fa-pencil-square-o"></i></a>
                                        <?php include_once(APPPATH . 'views/admin/estimates/billing_and_shipping_template.php'); ?>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>
                                        <address>
                                            <span class="billing_street">
                                                <?php $billing_street = (isset($estimate) ? $estimate->billing_street : '--'); ?>
                                                <?php $billing_street = ($billing_street == '' ? '--' : $billing_street); ?>
                                                <?php echo $billing_street; ?></span><br>
                                            <span class="billing_city">
                                                <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>
                                                <?php $billing_city = ($billing_city == '' ? '--' : $billing_city); ?>
                                                <?php echo $billing_city; ?></span>,
                                            <span class="billing_state">
                                                <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>
                                                <?php $billing_state = ($billing_state == '' ? '--' : $billing_state); ?>
                                                <?php echo $billing_state; ?></span>
                                            <br/>
                                            <span class="billing_country">
                                                <?php 
                                                    $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--');
                                                    $billing_country = ($billing_country == '' ? '--' : $billing_country);
                                                    echo $billing_country; 
                                                ?>
                                            </span>,
                                            <span class="billing_zip">
                                                <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>
                                                <?php $billing_zip = ($billing_zip == '' ? '--' : $billing_zip); ?>
                                                <?php echo $billing_zip; ?></span>
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="bold"><?php echo _l('ship_to'); ?></p>
                                        <address>
                                            <span class="shipping_street">
                                                <?php $shipping_street = (isset($estimate) ? $estimate->shipping_street : '--'); ?>
                                                <?php $shipping_street = ($shipping_street == '' ? '--' : $shipping_street); ?>
                                                <?php echo $shipping_street; ?></span><br>
                                            <span class="shipping_city">
                                                <?php $shipping_city = (isset($estimate) ? $estimate->shipping_city : '--'); ?>
                                                <?php $shipping_city = ($shipping_city == '' ? '--' : $shipping_city); ?>
                                                <?php echo $shipping_city; ?></span>,
                                            <span class="shipping_state">
                                                <?php $shipping_state = (isset($estimate) ? $estimate->shipping_state : '--'); ?>
                                                <?php $shipping_state = ($shipping_state == '' ? '--' : $shipping_state); ?>
                                                <?php echo $shipping_state; ?></span>
                                            <br/>
                                            <span class="shipping_country">
                                                <?php $shipping_country = (isset($estimate) ? get_country_short_name($estimate->shipping_country) : '--'); ?>
                                                <?php $shipping_country = ($shipping_country == '' ? '--' : $shipping_country); ?>
                                                <?php echo $shipping_country; ?></span>,
                                            <span class="shipping_zip">
                                                <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>
                                                <?php $shipping_zip = ($shipping_zip == '' ? '--' : $shipping_zip); ?>
                                                <?php echo $shipping_zip; ?></span>
                                        </address>
                                    </div>
                                </div>
                                <?php
                                $next_estimate_number = get_option('next_estimate_number');
                                $format = get_option('estimate_number_format');

                                if (isset($estimate)) {
                                    $format = $estimate->number_format;
                                }

                                $prefix = get_option('estimate_prefix');

                                if ($format == 1) {
                                    $__number = $next_estimate_number;
                                    if (isset($estimate)) {
                                        $__number = $estimate->number;
                                        $prefix = '<span id="prefix">' . $estimate->prefix . '</span>';
                                    }
                                } else if ($format == 2) {
                                    if (isset($estimate)) {
                                        $__number = $estimate->number;
                                        $prefix = $estimate->prefix;
                                        $prefix = '<span id="prefix">' . $prefix . '</span><span id="prefix_year">' . date('Y', strtotime($estimate->date)) . '</span>/';
                                    } else {
                                        $__number = $next_estimate_number;
                                        $prefix = $prefix . '<span id="prefix_year">' . date('Y') . '</span>/';
                                    }
                                } else if ($format == 3) {
                                    if (isset($estimate)) {
                                        $yy = date('y', strtotime($estimate->date));
                                        $__number = $estimate->number;
                                        $prefix = '<span id="prefix">' . $estimate->prefix . '</span>';
                                    } else {
                                        $yy = date('y');
                                        $__number = $next_estimate_number;
                                    }
                                } else if ($format == 4) {
                                    if (isset($estimate)) {
                                        $yyyy = date('Y', strtotime($estimate->date));
                                        $mm = date('m', strtotime($estimate->date));
                                        $__number = $estimate->number;
                                        $prefix = '<span id="prefix">' . $estimate->prefix . '</span>';
                                    } else {
                                        $yyyy = date('Y');
                                        $mm = date('m');
                                        $__number = $next_estimate_number;
                                    }
                                }

                                $_estimate_number = str_pad($__number, get_option('number_padding_prefixes'), '0', STR_PAD_LEFT);
                                $isedit = isset($estimate) ? 'true' : 'false';
                                $data_original_number = isset($estimate) ? $estimate->number : 'false';
                                ?>
                                <!--<div class="form-group">
                                   <label for="number"><?php echo _l('estimate_add_edit_number'); ?></label>
                                   <div class="input-group">
                                          <span class="input-group-addon">
                                <?php if (isset($estimate)) { ?>
                                        <a href="#" onclick="return false;" data-toggle="popover" data-container='._transaction_form' data-html="true" data-content="<label class='control-label'><?php echo _l('settings_sales_estimate_prefix'); ?></label><div class='input-group'><input name='s_prefix' type='text' class='form-control' value='<?php echo $estimate->prefix; ?>'></div><button type='button' onclick='save_sales_number_settings(this); return false;' data-url='<?php echo admin_url('estimates/update_number_settings/' . $estimate->id); ?>' class='btn btn-info btn-block mtop15'><?php echo _l('submit'); ?></button>"><i class="fa fa-cog"></i></a>
                                    <?php
                                }
                                echo $prefix;
                                ?>
                                    </span>
                                     <input type="text" name="number" class="form-control" value="<?php echo $_estimate_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
                                <?php if ($format == 3) { ?>
                                        <span class="input-group-addon">
                                               <span id="prefix_year" class="format-n-yy"><?php echo $yy; ?></span>
                                        </span>
                                <?php } else if ($format == 4) { ?>
                                        <span class="input-group-addon">
                                              <span id="prefix_month" class="format-mm-yyyy"><?php echo $mm; ?></span>
                                              /
                                              <span id="prefix_year" class="format-mm-yyyy"><?php echo $yyyy; ?></span>
                                       </span>
                                <?php } ?>
                                   </div>
                                </div>-->

                                <div class="row form-group">
                                    <div class="col-md-12">
                                        <label for="date" class="control-label"> <small class="req text-danger">* </small>Work Order No</label>
                                        <input type="text" id="work_no" name="work_no" class="form-control" value="<?php echo $estimate->work_no; ?>">
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <?php 
                                            $value = (isset($estimate) ? _d($estimate->workdate) : _d(date('Y-m-d')));
                                            echo render_date_input('workdate', 'Work Order Date', $value); 
                                        ?>
                                    </div>

                                </div>
                                <div class="clearfix mbot15"></div>
                                <?php 
                                $rel_id = (isset($estimate) ? $estimate->id : false);
                                if (isset($custom_fields_rel_transfer)) {
                                    $rel_id = $custom_fields_rel_transfer;
                                }
                                ?>
                                <?php echo render_custom_fields('estimate', $rel_id); ?>
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">

                                    <div class="row">
<!--                                        <div class="col-md-6">
                                            <?php
//                                            $s_attrs = array('disabled' => true, 'data-show-subtext' => true);
//                                            $s_attrs = do_action('estimate_currency_disabled', $s_attrs);
//                                            foreach ($currencies as $currency) {
//                                                if ($currency['isdefault'] == 1) {
//                                                    $s_attrs['data-base'] = $currency['id'];
//                                                }
//                                                if (isset($estimate)) {
//                                                    if ($currency['id'] == $estimate->currency) {
//                                                        $selected = $currency['id'];
//                                                    }
//                                                } else {
//                                                    if ($currency['isdefault'] == 1) {
//                                                        $selected = $currency['id'];
//                                                    }
//                                                }
//                                            }
                                            ?>
                                            <?php // echo render_select('currency', $currencies, array('id', 'name', 'symbol'), 'estimate_add_edit_currency', $selected, $s_attrs); ?>
                                        </div>-->
                                        <div class="col-md-6">
                                            <div class="form-group select-placeholder">
                                                <label class="control-label"><?php echo _l('estimate_status'); ?></label>
                                                <select class="selectpicker display-block mbot15" name="status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                    <?php foreach ($estimate_statuses as $status) { ?>
                                                        <option value="<?php echo $status; ?>" <?php echo (isset($estimate) && $estimate->status == $status) ? 'selected="selected"' : ''; ?>><?php echo format_estimate_status($status, '', false); ?></option>
                                                    <?php } ?>
                                                </select>
                                            </div>
                                        </div>
<!--                                        <div class="col-md-12">
                                            <?php 
//                                                $value = (isset($estimate) ? $estimate->reference_no : '');
//                                                echo render_input('reference_no', 'reference_no', $value); 
                                            ?>
                                        </div>-->

                                        <div class="col-md-12" style="margin-bottom:2%;">
                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">
                                                <option>Select</option>
                                                <?php
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>
                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                            <?php foreach ($Staffgroup_value['staffs'] as $singstaff) { ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php echo (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) ? 'selected="selected"' : ""; ?>><?php echo $singstaff['firstname'] ?></option>
                                                            <?php } ?>
                                                        </optgroup>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                            <?php /* $i = 0;
                                              $selected = '';
                                              foreach ($staff as $member) {
                                              if (isset($proposal)) {
                                              if ($proposal->assigned == $member['staffid']) {
                                              $selected = $member['staffid'];
                                              }
                                              }
                                              $i++;
                                              }
                                              echo render_select('assigned', $staff, array('staffid', array('firstname', 'lastname')), 'proposal_assigned', $selected);
                                             */ ?>
                                        </div>

                                    </div>
                                    <?php 
                                        $value = (isset($estimate) ? $estimate->adminnote : '');
                                        echo render_textarea('adminnote', 'challan_add_edit_admin_note', $value); 
                                    ?>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
		<?php
			$sessiondata = $this->session->userdata();
			$warehouse_id = $estimate->warehouse_id;
			$get_warehouse_details=$this->db->query("SELECT * FROM `tblwarehouse` WHERE `id`='".$warehouse_id."'")->row_array();
			$warehouse=$get_warehouse_details['name'];
			$service_type = $estimate->service_type;
			$pro_id=explode(',',$estimate->pro_id);
			foreach($pro_id as $singlepro)
			{
				$getprodet=$this->db->query("SELECT * FROM `tblproducts` WHERE `id`='".$singlepro."'")->row_array();
				$proname[]=$getprodet['name'];
			}
			$pro_name=implode(',',$proname);
			?>
			<input type="hidden" name="pro_id" value="<?php echo $estimate->pro_id;?>">
			<input type="hidden" name="warehouse_id" value="<?php echo $warehouse_id;?>">
			<input type="hidden" name="service_type" value="<?php echo $service_type;?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="rel_type" value="<?php echo $rely_type; ?>">
                            <input type="hidden" name="rel_id" value="<?php echo $rel_id; ?>">
                            <input type="hidden" name="is_sale" value="<?php echo $is_sale; ?>">

                            <div style="padding:7px;margin-bottom:5%;">
                                <h4 class="modal-title pull-left"><?php echo $servicetype; ?></h4>
                                <h4 class="modal-title pull-right">Warehouse Selected :- <?php echo $warehouse; ?></h4>
                            </div>
                            <div style="padding:7px;margin-bottom:5%;">
                                <h5 class="modal-title pull-right">Product Name :- <?php echo $pro_name; ?></h5>
                            </div>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th width="30%" align="center">Component Name</th>
                                        <th width="10%" align="center">Req Qty</th>
                                        <th width="10%" class="qty" align="center">Available Stock</th>
                                        <th width="15%" align="center">Deliverable Quantity</th>
                                        <th width="25%" align="center">Chalan Status</th>
                                        <th width="10%" align="center">Pending</th>
                                        <th width="5%" align="center"></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $k = 0;
                                    foreach ($productdata as $productdata_key => $singlerequriedcomponent) {

                                        $this->db->where('id', $singlerequriedcomponent['component_id']);
                                        $get_component_details = $this->db->get('tblcomponents')->row_array();
										$getcompstock=$this->db->query("SELECT * FROM `tblprostock` WHERE `pro_id`='".$singlerequriedcomponent['component_id']."' and `warehouse_id`='".$warehouse_id."' and `service_type`='".$service_type."'")->row_array();
                                        ?>
                                        <tr class="main" id="tr<?php echo $k;?>">
                                            <td width="20%" align="left">
                                                <div class="form-group"><input type="hidden" name="componentdata[<?php echo $k; ?>][componentid]" value="<?php echo $singlerequriedcomponent['component_id']; ?>"><?php echo $get_component_details['name']; ?></div>
                                            </td>
                                            <td width="15" align="center">
                                                <input type="hidden" name="componentdata[<?php echo $k; ?>][requiredqty]" value="<?php echo $singlerequriedcomponent['required_qty']; ?>" id="reqqty<?php echo $productdata_key ?>"><?php echo $singlerequriedcomponent['required_qty']; ?>
                                            </td>
                                            <td width="15%" align="center">
                                                <input type="hidden" name="componentdata[<?php echo $k; ?>][availableqty]" value="<?php echo $singlerequriedcomponent['available_qty']; ?>"><?php echo $getcompstock['qty']; ?>
                                            </td>
											<td width="10%" align="center" id="deliverable_qty_<?php echo $productdata_key ?>">
                                                <?php                                                
                                                $deliverable_quantity = $singlerequriedcomponent['required_qty']; 
                                                echo $deliverable_quantity;
                                                ?>
                                            </td>
                                            <td width="25%" align="center" >
                                                <select class="form-control selectpicker" onchange="statuschange(this.value,'<?php echo $k; ?>')" id="pendingststatus<?php echo $k; ?>" name="componentdata[<?php echo $k; ?>][flag]" data-live-search="true">
                                                    <option value="0">Pending</option>
                                                    <option value="1" selected=selected>Approved</option>
                                                </select>
                                            </td>
                                            <td width="20%" align="center">
                                                <input class="form-control" type="text" name="componentdata[<?php echo $k; ?>][remainingqty]" value="0" id="pendingqty<?php echo $productdata_key ?>" onkeyup="changeDeliverableQty(<?php echo $productdata_key ?>)">
                                            </td>
											<td width="8%">
                                                <button type="button" class="btn pull-right btn-danger"  onclick="removecomponent('0');" ><i class="fa fa-remove"></i></button>
                                            </td>
                                        </tr>
                                        <?php
                                        $k++;
                                    }
                                    ?>

                                </tbody>
                            </table>
							<div class="col-xs-12">
								<label class="label-control subHeads"><a class="addmorecomp" value="1">Add More component<i class="fa fa-plus"></i></a></label>
							</div>



                            <div class="btn-bottom-toolbar bottom-transaction text-right">

                                <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    <?php echo _l('update_chalan'); ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>

                <?php echo form_close(); ?>

            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
    <script>

        $('#site_id').change(function () {
            var site_id = $('#site_id').val();
            var url = '<?php echo base_url(); ?>admin/Site_manager/getsitedetails';
            $.post(url,
                    {
                        site_id: site_id,
                    },
                    function (data, status) {
                        var res = JSON.parse(data);

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
		function removecomponent(procompid)
		{
			$('#tr' + procompid).remove();
		}
       function getprostock(proid,value) {
		   
			var warehouseid='<?php echo $warehouse_id;?>';
			var service_type='<?php echo $service_type;?>';
			var url = '<?php echo base_url(); ?>admin/Site_manager/getprostock';
            $.post(url,
                    {
                        proid: proid,
                        warehouseid: warehouseid,
                        service_type: service_type,
                    },
                    function (data, status) 
					{
						$('#avabqty'+value).val(data);
						$('#pendingqty'+value).val('0');
					});
		}
			function staffdropdown() {
            $.each($("#assign option:selected"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().attr('selected', 'selected');
            });
            $('.selectpicker').selectpicker('refresh');
            $.each($("#assign option:not(:selected)"), function () {
                var select = $(this).val();
                $("optgroup." + select).children().removeAttr('selected');
            });
            $('.selectpicker').selectpicker('refresh');
        }
		$('.addmorecomp').click(function(){
			 var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
			$('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td width="30%" align="left"><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="getprostock(this.value,'+newaddmore+')" name="componentdata[' + newaddmore + '][componentid]" data-live-search="true"><option value=""></option><?php
if (isset($component_data) && count($component_data) > 0) {
    foreach ($component_data as $unit_key => $component_value) {
        ?><option value="<?php echo $component_value['id'] ?>" ><?php echo $component_value['name'] ?></option><?php
    }
}
?></select></div></td><td width="10" align="center"><input type="text" id="reqqty'+newaddmore+'" name="componentdata['+newaddmore+'][requiredqty]" value="1"></td><td width="10%" align="center"><input type="text" readonly id="avabqty'+newaddmore+'" name="componentdata['+newaddmore+'][availableqty]" value=""></td><td width="10%" id="deliverable_qty_' + newaddmore + '" align="center"></td><td width="25%" align="center"><select class="form-control selectpicker" id="pendingststatus' + newaddmore + '" name="componentdata[' + newaddmore + '][flag]" onchange="statuschange(this.value,' + newaddmore + ')" style="display: block !important;" data-live-search="true"><option value="0">Pending</option><option value="1">Approved</option></select></td><td width="15%" align="center"><input class="form-control" id="pendingqty' + newaddmore + '" onkeyup="changeDeliverableQty(' + newaddmore + ')" type="text" name="componentdata[' + newaddmore + '][remainingqty]"  value=""></td><td width="5%"><button type="button" class="btn pull-right btn-danger"  onclick="removecomponent(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
	$('.selectpicker').selectpicker('refresh');		
		});
        
     function statuschange(value,val) {
			if(value==1)
			{
				$('#pendingqty'+val).val(0);
				$('#deliverable_qty_'+val).text($('#reqqty'+val).val());
			}
		}	   
	function changeDeliverableQty(product_key) {
		var pending_qty = $("#pendingqty" + product_key).val();
		var required_qty = $("#reqqty" + product_key).val();
		if ((pending_qty !== '') && (pending_qty.indexOf('.') === -1)) 
		{
			$('#pendingqty'+product_key).val(Math.max(Math.min(pending_qty, required_qty), -required_qty));
		}
		var pending_qty = $("#pendingqty" + product_key).val();
		var deliverable_qty = parseInt(required_qty) - Math.abs(parseInt(pending_qty));
		$("#deliverable_qty_" + product_key).html("").html(deliverable_qty);
		if(pending_qty==0)
		{
			$('#pendingststatus'+product_key).val(1);
			$('.selectpicker').selectpicker('refresh');
		}
		else
		{
			$('#pendingststatus'+product_key).val(0);
			$('.selectpicker').selectpicker('refresh');
		}
	}
    </script>
</body>
</html>

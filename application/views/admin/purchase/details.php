<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;} .button3 {background-color: #800000;} .hold {background-color: #e8bb0b;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open('admin/clients/contact/' . $customer_id . '/' . $contactid, array('id' => 'contact-form', 'autocomplete' => 'off')); ?>



            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?><br /><small class="color-white" id=""><?php echo get_company_name($customer_id, true); ?></small></h4>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>



<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
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
                            <div class="col-md-12">
                                <div class="row panelHead">
                                    <div class="col-xs-12 col-md-6">
                                        <h4>
                                        <?php  
                                            $title = "Purchase Order Approval";
                                            if ((isset($purchase_info['order_type'])) && $purchase_info['order_type'] == 2){
                                                $title = "Work Order Approval";
                                            }
                                            echo $title;
                                        ?>
                                     </h4>
                                    </div>
                                </div>
                                <hr class="hr-panel-heading">
                            </div>


                            <div class="col-md-6">

                                <div class="form-group">
                                    <label for="vendor_id" class="control-label">Select Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" disabled="" required="" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($purchase_info['vendor_id']) && $purchase_info['vendor_id'] == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker warehouse_id" disabled="" data-live-search="true" required="" id="warehouse_id" name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($purchase_info['warehouse_id']) && $purchase_info['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $all_warehouse_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group select-placeholder projects-wrapper<?php
                                if ((!isset($estimate)) || (isset($estimate) && !customer_has_projects($estimate->clientid))) {
                                    echo ' hide';
                                }
                                ?>">
                                    <label for="project_id"><?php echo _l('project'); ?></label>
                                    <div id="project_ajax_search_wrapper">
                                        <select name="project_id" id="project_id" class="projects ajax-search" data-live-search="true" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                            <?php
                                            if (isset($estimate) && $estimate->project_id != 0) {
                                                echo '<option value="' . $estimate->project_id . '" selected>' . get_project_name_by_id($estimate->project_id) . '</option>';
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">

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
                                                <?php $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--'); ?>
                                                <?php $billing_country = ($billing_country == '' ? '--' : $billing_country); ?>
                                                <?php echo $billing_country; ?></span>,
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
                                $next_estimate_number = last_purchaseorder();
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







                                <div class="row">
                                    <div class="col-md-12">

                                        <?php $value = (isset($purchase_info) ? _d($purchase_info['date']) : _d(date('Y-m-d'))); ?>

                                       <div class="form-group" app-field-wrapper="date"><label for="date" class="control-label"> <small class="req text-danger">* </small>Purchase Order Date</label>
                                        <div class="input-group date">
                                            <input type="text" id="date" name="date" disabled="" class="form-control datepicker" value="<?php echo $value; ?>">
                                            <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <?php if (isset($estimate->vendor_contact_number)){ ?>
                                    <div class="form-group col-md-6">
                                        <label for="date" class="control-label">Vendor Contact Number</label>
                                        <input type="text" id="vendor_contact_number" name="vendor_contact_number" readonly="" class="form-control" value="<?php echo (isset($purchase_info) ? $purchase_info['vendor_contact_number'] : '');?>" >
                                    </div>
                                    <?php 
                                        }
                                        if (isset($estimate->vendor_contact_person)){
                                    ?>
                                    <div class="form-group col-md-6">
                                        <label for="date" class="control-label">Vendor Contact Person</label>
                                        <input type="text" id="vendor_contact_person" name="vendor_contact_person" readonly="" class="form-control" value="<?php echo (isset($purchase_info) ? $purchase_info['vendor_contact_person'] : '');?>">
                                    </div>
                                    <?php 
                                        }
                                        if (isset($estimate->billing_contact_name)){
                                    ?>
                                    <div class="form-group col-md-6">
                                        <label for="date" class="control-label">Billing Contact Name</label>
                                        <input type="text" id="billing_contact_name" name="billing_contact_name" readonly="" class="form-control" value="<?php echo (isset($purchase_info) ? $purchase_info['billing_contact_name'] : '');?>" >
                                    </div>
                                    <?php 
                                        }
                                        if (isset($estimate->billing_contact_number)){
                                    ?>
                                    <div class="form-group col-md-6">
                                        <label for="date" class="control-label">Billing Contact Number</label>
                                        <input type="text" id="billing_contact_number" name="billing_contact_number" readonly="" class="form-control" value="<?php echo (isset($purchase_info) ? $purchase_info['billing_contact_number'] : '');?>" >
                                    </div>
                                    <?php 
                                        }
                                        if (isset($estimate->billing_contact_email)){
                                    ?>
                                    <div class="form-group col-md-12">
                                        <label for="date" class="control-label">Billing Contact Email</label>
                                        <input type="text" id="billing_contact_email" name="billing_contact_email" readonly="" class="form-control" value="<?php echo (isset($purchase_info) ? $purchase_info['billing_contact_email'] : '');?>" >
                                    </div>
                                    <?php 
                                        }
                                    ?>
                                </div>  
                                <div class="form-group">
                                    <label for="tax_type" class="control-label">Select Tax Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" disabled="" required="" id="tax_type" name="tax_type">
                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['tax_type'] == 1) ? 'selected' : '' ; ?> >Including</option>
                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['tax_type'] == 2) ? 'selected' : '' ; ?>>Excluding</option>


                                    </select>
                                </div>



                                <div class="clearfix mbot15"></div>
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">

                                    <div class="row">

                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="number">Purchase Order Number <a class="text-info" style="margin-left:10px" target="_blank" href="<?php echo admin_url("purchase/download_pdf/").$purchase_info['id'];?>">View PDF</a></label>
                                    <div class="input-group">
                                        <span class="input-group-addon">
                                            <?php if (isset($estimate)) { ?>
                                                <a href="#" onclick="return false;" data-toggle="popover" data-container='._transaction_form' data-html="true" data-content="<label class='control-label'><?php echo _l('settings_sales_estimate_prefix'); ?></label><div class='input-group'><input name='s_prefix' type='text' class='form-control' value='<?php echo $estimate->prefix; ?>'></div><button type='button' onclick='save_sales_number_settings(this); return false;' data-url='<?php echo admin_url('estimates/update_number_settings/' . $estimate->id); ?>' class='btn btn-info btn-block mtop15'><?php echo _l('submit'); ?></button>"><i class="fa fa-cog"></i></a>
                                                <?php
                                            }
                                            echo $prefix;
                                            ?>
                                        </span>
                                        <input type="text" name="number" class="form-control" value="<?php echo (isset($purchase_info)) ? $purchase_info['number'] : $_estimate_number; ?>" data-isedit="<?php echo $isedit; ?>" data-original-number="<?php echo $data_original_number; ?>">
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
                                </div>


                                <div class="form-group">
                                    <label for="service_type" class="control-label">Select Tax Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" disabled="" required="" id="service_type" name="service_type">
                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 1) ? 'selected' : '' ; ?> >Rent</option>
                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 2) ? 'selected' : '' ; ?>>Sales</option>


                                    </select>
                                </div>



                                            <?php $value = (isset($purchase_info) ? $purchase_info['reference_no'] : ''); ?>
                                            <div class="form-group" app-field-wrapper="reference_no">
                                                <label for="reference_no" class="control-label">Reference #</label>
                                                <input type="text" id="reference_no" name="reference_no" class="form-control" disabled="" value="<?php echo $value; ?>">
                                            </div>
                                        </div>
                                        <div class="col-md-12" style="display:none;">
                                            <?php
                                            $selected = '';
                                            foreach ($staff as $member) {
                                                if (isset($estimate)) {
                                                    if ($estimate->sale_agent == $member['staffid']) {
                                                        $selected = $member['staffid'];
                                                    }
                                                }
                                            }
                                            echo render_select('sale_agent', $staff, array('staffid', array('firstname', 'lastname')), 'sale_agent_string', $selected);
                                            ?>
                                        </div>
                                        <div class="col-md-12" style="margin-bottom:2%;">
                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" disabled="" required="" name="assignid[]">

                                                <?php
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>
                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                            <?php
                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                                if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                                    echo'selected';
                                                                }
                                                                ?>><?php echo $singstaff['firstname'] ?></option>
                                                                    <?php }
                                                                    ?>
                                                        </optgroup>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>

                                        </div>

                                    </div>
                                    <?php $value = (isset($purchase_info) ? $purchase_info['adminnote'] : ''); ?>
                                    <div class="form-group" app-field-wrapper="adminnote">
                                        <label for="adminnote" class="control-label">Note</label>
                                        <textarea id="adminnote" name="adminnote" class="form-control" disabled="" rows="4" style="width: 100%;height: 42px;"><?php echo $value; ?></textarea>
                                    </div>
                                    <?php $value = (isset($purchase_info) ? $purchase_info['revised_remark'] : ''); ?>
                                    <div class="form-group" app-field-wrapper="revised_remark">
                                        <label for="revised_remark" class="control-label">Revised Remark</label>
                                        <textarea id="revised_remark" disabled="" name="revised_remark" class="form-control" style="width: 100%;height: 42px;" rows="4"><?php echo $value; ?></textarea>
                                    </div>

                                    <?php 
                                    if(!empty($ttlpaidamount)){
                                    ?>
                                        <div class="form-group" app-field-wrapper="revised_remark">
                                            <label for="revised_remark" class="control-label">Paid Amount</label>
                                            <input class="form-control" disabled type="text" value="<?php echo $ttlpaidamount; ?>">
                                        </div>
                                    <?php    
                                    }
                                    ?>
                                    <?php
                                         if (!empty($purchase_info)){
                                            $files_list = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`='".$purchase_info['id']."' AND `rel_type`='purchase_order' ")->result();
                                            if (!empty($files_list)){
                                    ?>
                                    <div>
                                        <div class="form-group">
                                            <label for="lead_type" class="control-label">Attachments</label>
                                        </div>
                                        <?php 
                                                foreach ($files_list as $key => $file) {
                                                    $upath = base_url().'uploads/purchase_order/'.$purchase_info['id'].'/'.$file->file_name;
                                                    $fno = $key+1;
                                                    echo $fno.') <a href="'.$upath.'" target="_blank">'.$file->file_name.'</a>';
                                                    echo '<br>';
                                                }
                                        ?>
                                    </div>            
                                    <?php } } ?>
                                    <?php $value = (isset($purchase_info) ? _d($purchase_info['tentative_complete_date']) : ''); ?>
                                    <?php echo render_date_input('tentative_complete_date', 'Tentative Complete Date', $value, array("readonly" => '')); ?>
                                </div>
                            </div>


                        </div>

                        <?php
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                            ?>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" class="btn btn-warning hold mleft10 proposal-form-submit save-and-send transaction-submit">
                                    On Hold
                                </button>
                                <button type="submit" name="submit" value="4" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit button3">
                                    Reconciliation
                                </button>

                                <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>


                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approve
                                </button>
                            </div>
                            <?php
                        }
                        ?>


                    </div>
                </div>
            </div>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Purchase Order Products</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 130px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 2px !important;"></td>
                                                    <td style="width: 85px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                    <td style="width: 70px !important;">HSN/SEC Code</td>
                                                    <td style="width: 70px !important;">Remark</td>
                                                    <td style="width: 70px !important;"><?php echo "Unit"; ?></td>
                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_price'); ?></td>
                                                    <td style="width: 85px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>
                                                    <td style="width: 85px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>
                                                    <td style="width: 95px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>
                                                    <td style="width: 70px !important;">Tax %</td>
                                                    <td style="width: 85px !important;">Tax Amt</td>
                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $i = 1;
												$totsaleprod = 0;
                                                $unitqtyarr = array();
                                                if (isset($product_info)) {
                                                    $totsaleprod = count($product_info);
                                                    ?>
                                                <input type="hidden" id="totalsalepro" value="<?php echo count($product_info); ?>">
                                                <?php
                                                foreach ($product_info as $single_prod_sale_det) {


                                                    // $totproamt = ($single_prod_sale_det['ttl_price'] + $single_prod_sale_det['tax_amt']);

                                                    $pro_price = ($single_prod_sale_det['price']*$single_prod_sale_det['qty']);
                                                    $sale_dis_price = $pro_price - (($pro_price * $single_prod_sale_det['discount']) / 100);
                                                    if ($purchase_info['tax_type'] == '2'){
                                                        $tax_amt = (($sale_dis_price * $single_prod_sale_det['prodtax']) / 100);
                                                        $totproamt = ($sale_dis_price + $tax_amt);
                                                        // $totproamt = ($sale_dis_price + $single_prod_sale_det['tax_amt']);
                                                    }else{
                                                        $totproamt = $sale_dis_price;
                                                    }
                                                    /*if($single_prod_sale_det['hsn_code'] == 2){
                                                      $hsn_sac_code = value_by_id('tblproducts',$single_prod_sale_det['product_id'],'sac_code');
                                                    }else{
                                                      $hsn_sac_code = value_by_id('tblproducts',$single_prod_sale_det['product_id'],'hsn_code');
                                                    }*/

                                                    if ($single_prod_sale_det["is_temp"] == 0){
                                                        if($single_prod_sale_det['hsn_code'] == 2){
                                                            $hsn_sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '".$single_prod_sale_det['product_id']."' ")->row()->field_value;
                                                        }else{
                                                          $hsn_sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '".$single_prod_sale_det['product_id']."' ")->row()->field_value;

                                                        }
                                                    }else{
                                                        if($single_prod_sale_det['hsn_code'] == 2){
                                                            $hsn_sac_code = value_by_id('tbltemperoryproduct',$single_prod_sale_det['product_id'],'sac');
                                                        }else{
                                                            $hsn_sac_code = value_by_id('tbltemperoryproduct',$single_prod_sale_det['product_id'],'hsn');
                                                        }
                                                    }
                                                    $unit_id = $single_prod_sale_det["unit_id"];
                                                    if (array_key_exists($unit_id, $unitqtyarr)){
                                                        $unitqtyarr[$unit_id] += $single_prod_sale_det['qty'];
                                                    }else{
                                                        $unitqtyarr[$unit_id] = $single_prod_sale_det['qty'];
                                                    }
                                                    ?>
                                                    <tr class="trsalepro<?php echo $i; ?>">
                                                        <?php
                                                                if ($single_prod_sale_det["is_temp"] == 0){
                                                                   $url = admin_url("product_new/view/");
                                                                }else{
                                                                   $url = admin_url("product_new/temperory_product/");
                                                                }
                                                            ?>
                                                        <td>
                                                            <a target="_blank" href="<?php echo $url.$single_prod_sale_det['product_id']; ?>">
                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['product_name']; ?>">
                                                            </a>
                                                            <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            <input value="<?php echo $single_prod_sale_det["is_temp"]; ?>" name="saleproposal[<?php echo $i; ?>][is_temp]" type="hidden">
                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                        </td>
                                                        <td><a href="<?php echo admin_url('purchase/last_product_details/'.$single_prod_sale_det['product_id']); ?>"><i class="fa fa-external-link"></i></a></td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $single_prod_sale_det['pro_id']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $hsn_sac_code; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" readonly="" value="<?php echo $single_prod_sale_det['remark']; ?>">
                                                        </td>
                                                        <td>
                                                            <?php if ($single_prod_sale_det["unit_id"] > 0){ ?>
                                                                <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][unit]" readonly="" value="<?php echo value_by_id("tblunitmaster", $single_prod_sale_det['unit_id'], "name"); ?>">
                                                            <?php }else{ ?>
                                                                <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][unit]" readonly="" value="<?php echo get_product_unit($single_prod_sale_det['product_id'], $single_prod_sale_det["is_temp"]); ?>">
                                                            <?php }?>
                                                        </td>
                                                        <td>
                                                            <input type="text" disabled class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">
                                                        </td>
                                                        <td>
                                                            <input type="text" disabled class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['price']; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][ttl_price]" value="<?php echo $single_prod_sale_det['ttl_price']; ?>" id="total_price1">
                                                        </td>
                                                        <td>
                                                            <input type="number" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)"  value="<?php echo $single_prod_sale_det['discount']; ?>" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($pro_price * $single_prod_sale_det['discount']) / 100); ?>">
                                                        </td>
                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $sale_dis_price; ?>">
                                                        </td>        
                                                        <td>
                                                            <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">
                                                            <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo $single_prod_sale_det['prodtax']; ?>">
                                                        </td>

                                                        <td>
                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="<?php echo $single_prod_sale_det['tax_amt']; ?>" id="total_price1">
                                                        </td>
                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">
                                                            <?php 
                                                                // echo round($totproamt, 0);
                                                                echo number_format($totproamt, 2, '.', '');
                                                            ?>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>
                                            </tbody>
                                        </table>

                                    </div>
                                </div>
                                
                                <div class="row" style="margin-top:2%;">
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_total_amt" value="<?php echo (isset($purchase_info) && $purchase_info['finalsubtotalamount'] != '') ? $purchase_info['finalsubtotalamount'] : ""; ?>" name="saleproposal[finalsubtotalamount]" id="sale_total_amt">
                                        <div class="sale_total_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>
                                        <input type="text" disabled="" class="form-control sale_discount_percentage onlynumbers" value="<?php echo (isset($purchase_info) && $purchase_info['finaldiscountpercentage'] != '') ? $purchase_info['finaldiscountpercentage'] : ""; ?>" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_discount_amt" value="<?php echo (isset($purchase_info) && $purchase_info['finaldiscountamount'] != '') ? $purchase_info['finaldiscountamount'] : ""; ?>" name="saleproposal[finaldiscountamount]" id="sale_discount_amt">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo (isset($purchase_info) && $purchase_info['totalamount'] != '') ? $purchase_info['totalamount'] : ""; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">
                                    </div>
                                </div>

                                <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Approve/Reject Remark</label>
                                       <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; }?></textarea>
                                    </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-12">
                                        <br>
                                        <?php if (!empty($unitqtyarr)){ ?>    
                                            <h4 class="no-mtop mrg3">Total Unit Quantity</h4>
                                            <hr>
                                        <?php
                                            foreach ($unitqtyarr as $unit_id => $unitqty) {
                                        ?>
                                                <div class="col-md-12 col-md-2 total-column">
                                                    <div class="panel_s">
                                                        <div class="panel-body">
                                                            <h3 class="text-muted _total verified_count"><?php echo value_by_id('tblunitmaster', $unit_id, 'name'); ?></h3>
                                                            <span class="staff_logged_time_text text-danger"><?php echo number_format($unitqty, 2, '.', ','); ?></span>
                                                        </div>
                                                    </div>
                                                </div>
                                        <?php
                                            }
                                        }
                                        ?>
                                    </div>
                                </div>           



                            </div>
                        </div>

                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                            
                            <?php 
                                $html = '';
                                if(!empty($purchase_info['specification'])){
                                    $html .= '<h4 class="no-mtop mrg3"><u>Notes/Special Remarks :</u></h4><hr><div class="termsList">'.$purchase_info['specification'].'</div><br><br>';

                                }
                                if(!empty($purchase_info['product_terms_and_conditions'])){
                                    $html .= '<h4 class="no-mtop mrg3"><u>Product Terms and Conditions:</u></h4><hr><div class="termsList">'.$purchase_info['product_terms_and_conditions'].'</div><br><br>';
                                }
                                $html .= '<h4 class="no-mtop mrg3"><u>General Terms and Conditions:</u></h4><hr><div class="termsList">'.getAllTermsConditions($purchase_info['id'], "purchase_order").'</div>';
                                echo $html;
                            ?>         
                        </div>
                        <div class="popayment_html">

                        </div>                                    
                    </div>                                    
                </div>                                    
            </div>                                    
<?php
$assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '3' and table_id = '".$purchase_info['id']."'  ")->result();
?>
             <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                                <h5 style="color: red;">Minimum <?php echo (count($assign_info) > 1 ) ? 2 : 1; ?> Approval is Required</h5>
                                <?php
                            if($purchase_info['revised_id'] > 0){ ?>
                            <h4 style="color: red;text-align: center;margin-right: 16px;">REVISED</h4>
                            <?php }
                            ?>

                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <td>S.No</td>
                                                <td>Name</td>
                                                <td>Status</td>
                                                <td>Read At</td>
                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }elseif($value->approve_status == 4){
                                                        $status = 'Reconciliation';
                                                        $color = 'brown';
                                                    }elseif($value->approve_status == 5){
                                                        $status = 'On Hold';
                                                        $color = '#e8bb0b;';
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                    <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                    <td><?php if(!empty($value->readdate)){ echo _d($value->readdate); }else{ echo 'Not Yet'; }   ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

                    </div>
                </div>
            </div>



            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<script>

    $(function () {
        init_currency_symbol();
        // Maybe items ajax search
        init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
        validate_proposal_form();
        get_po_paymentdata();

        // $('.rel_id_label').html(_rel_type.find('option:selected').text());
        // _rel_type.on('change', function () {
        //     var clonedSelect = _rel_id.html('').clone();
        //     _rel_id.selectpicker('destroy').remove();
        //     _rel_id = clonedSelect;
        //     $('#rel_id_select').append(clonedSelect);
        //     proposal_rel_id_select();
        //     if ($(this).val() != '') {
        //         _rel_id_wrapper.removeClass('hide');
        //     } else {
        //         _rel_id_wrapper.addClass('hide');
        //     }
        //     $('.rel_id_label').html(_rel_type.find('option:selected').text());
        // });
        proposal_rel_id_select();
<?php if (!isset($proposal) && $rel_id != '') { ?>
            _rel_id.change();
<?php } ?>

    });

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


    function get_total_price_per_qty_sale(value) {
        var tax_type = $('#tax_type').val();
        var price = $('#salemainprice_' + value).val();
        var qty = $('#saleqty_' + value).val();
        var disc = $('#saledisc_' + value).val();
        var tax = $('#saleprod_tax_' + value).val();



        if(tax_type == 1){

            var t_price = (price * qty);
            var tax_amt = ((t_price * tax) / 100);

            total_price = (t_price-tax_amt);

            $('#saleprice_' + value).val(total_price);

            $('#saletax_amt_' + value).val(tax_amt);


            var grand_total=(total_price)+(tax_amt);
            $('#grand_total_sale' + value).text(grand_total);
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

        }else{
             var total_price = (price * qty);

            $('#saleprice_' + value).val(total_price);

             var tax_amt = ((total_price * tax) / 100);

            $('#saletax_amt_' + value).val(tax_amt);


            var grand_total=(total_price)+(tax_amt);
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
        }




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

        //alert(distotalamt+'/'+totalminprice+'/'+totalminprice);
        $('.rent_total_quotation_margin_profit').html(totalmarginprofit.toFixed(2) + '%');
        $('.rent_total_quotation_margin_profit').css("width", totalmarginprofit + '%');
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


        /*var totalamt = 0;
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
        $('.sale_total_quotation_margin_profit').css("width", totalmarginprofit + '%');
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
        $('.rent_other_charges_subtotal').html(total);*/
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
if (isset($proposal->is_gst)) {
    if ($proposal->is_gst == 1) {
        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][gst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="number" id="sgst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" onchange="getothercharges(' + newaddmore + ')" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="igst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php
    }
} else {
    if ($clientsate == get_staff_state()) {
        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst' + newaddmore + '" value="0" name="othercharges[' + newaddmore + '][gst]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="igst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php
    }
}
?>
        $('.selectpicker').selectpicker('refresh');
    });


    $('.addmorerentpro').click(function ()
    {
        var addmorerentpro = parseInt($(this).attr('value'));
        var check_gst = parseInt($('#check_gst').val());
        var newaddmorerentpro = addmorerentpro + 1;
        $(this).attr('value', newaddmorerentpro);
        if (check_gst == 0)
        {
            $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php
if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) {
        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php
    }
}
?></select><input class="form-control" type="hidden" id="rentpro_name' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" readonly class="form-control" id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" readonly id="rentpro_pro_id_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="number" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="rentproposal[' + newaddmorerentpro + '][prodtax]" id="rentprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');
        } else
        {
            $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php
if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) {
        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php
    }
}
?></select><input class="form-control" id="rentpro_name' + newaddmorerentpro + '" type="hidden" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" id="rentpro_pro_id_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="number" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');
        }
        $('.selectpicker').selectpicker('refresh');
    });

    $('.addmoresalepro').click(function ()
    {
        var addmorerentpro = parseInt($(this).attr('value'));
        var check_gst = parseInt($('#check_gst').val());
        var newaddmorerentpro = addmorerentpro + 1;
        $(this).attr('value', newaddmorerentpro);
        if (check_gst == 0)
        {
            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php
if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) {
        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php
    }
}
?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="salepro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][ttl_price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="saleprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');
        } else
        {
            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php
if (isset($product_data) && count($product_data) > 0) {
    foreach ($product_data as $product_key => $product_value) {
        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php
    }
}
?></select><input class="form-control" id="salepro_name' + newaddmorerentpro + '" type="hidden" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" id="salepro_pro_id_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" class="form-control" id="salepro_pro_hsncode_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');
        }
        $('.selectpicker').selectpicker('refresh');
    });
    $('.addsalemore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
<?php
if (isset($proposal->is_gst)) {
    if ($proposal->is_gst == 1) {
        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" onchange="getothersalecharges(' + newaddmore + ')"  class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>  $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_igst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" value="0" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php
    }
} else {
    if ($clientsate == get_staff_state()) {
        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '"  name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" onchange="getothersalecharges(' + newaddmore + ')" ></div></td><td><div class="form-group"><input type="number" id="sale_gst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php
        if (isset($othercharges) && count($othercharges) > 0) {
            foreach ($othercharges as $othercharges_key => $othercharges_value) {
                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo $othercharges_value['category_name']; ?></option><?php
            }
        }
        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" onchange="getothersalecharges(' + newaddmore + ')" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_igst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php
    }
}
?>
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
        var rel_type = value;
        var url = '<?php echo base_url(); ?>admin/Proposals/get_rel_list';
        var html = '<option value=""></option>';
        $.post(url,
                {
                    rel_type: rel_type,
                },
                function (data, status)
                {
                    if (data != "")
                    {
                        var resArr = $.parseJSON(data);
                        if (rel_type == 'proposal')
                        {
                            $.each(resArr, function (k, v) {
                                html += '<option value="' + v.id + '">' + v.leadno + '</option>';
                            });
                            $('.rel_id_label').text('Lead');
                        }
                        if (rel_type == 'customer')
                        {
                            $.each(resArr, function (k, v) {
                                html += '<option value="' + v.userid + '">' + v.client_branch_name + ' - ' + v.email_id + '</option>';
                            });
                            $('.rel_id_label').text('client');
                        }
                    }
                    $("#rel_id").val('');
                    $("#rel_id").html('').html(html);
<?php if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $proposal->rel_id; ?>');<?php } ?>
<?php if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $proposal->rel_id; ?>');<?php } ?>
<?php if (isset($_GET['rel_id'])) { ?> $("#rel_id").val('<?php echo $_GET['rel_id']; ?>');<?php } ?>
                    $('.selectpicker').selectpicker('refresh');
                });
    }
    $(function () {
<?php if (isset($_GET['rel_id'])) { ?>
            var rel_id = '<?php echo $_GET['rel_id']; ?>';
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
    <?php
}
if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {
    ?>
            get_rel_list('customer');
    <?php
}
if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {
    ?>
            get_rel_list('proposal');
<?php } ?>
    });


    function staffdropdown()
    {
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
    function getprodata(value)
    {
        var prodid = $('#prodid' + value).val();
        var check_gst = parseInt($('#check_gst').val());
        var rent_company_category = $('#rent_company_category').val();
        var url = '<?php echo base_url(); ?>admin/Site_manager/getproddetails';
        $.post(url,
                {
                    prodid: prodid,
                    rent_company_category: rent_company_category,
                },
                function (data, status) {
                    var res = JSON.parse(data);
                    $('#renpro_id' + value).val(prodid);
                    $('#rentpro_remark_' + value).val(res.product_remarks);
                    $('#rentpro_name' + value).val(res.name);
                    $('#rentpro_pro_id_' + value).val(res.pro_id);
                    $('#rentpro_pro_hsncode_' + value).val(res.hsn_code);
                    $('#averageprice' + value).val(res.min_rentprice);
                    $('#rentmainprice_' + value).val(res.proprice);
                    $('#rentprice_' + value).val(res.proprice);
                    $('#rentdisc_price_' + value).val(res.proprice);
                    $('#renttax_amt_' + value).val(res.gstamt);
                    $('#grand_total_' + value).text(res.proprice);
                   // $('#rentprod_tax_' + value).val(res.tax_rate);
                    $('#rentprod_tax_' + value).val(18);
                    $('.selectpicker').selectpicker('refresh');
                    get_total_price_per_qty_rent(value);
                });
    }

    function getsaleprodata(value)
    {
        var prodid = $('#saleprodid' + value).val();
        var check_gst = parseInt($('#check_gst').val());
        var rent_company_category = $('#rent_company_category').val();
        var url = '<?php echo base_url(); ?>admin/Site_manager/getsaleproddetails';
        $.post(url,
                {
                    prodid: prodid,
                    rent_company_category: rent_company_category,
                },
                function (data, status) {
                    var res = JSON.parse(data);
                    $('#salepro_id' + value).val(prodid);
                    //$('#salepro_remark_' + value).val(res.product_remarks);
                    $('#salepro_name' + value).val(res.name);
                    $('#salepro_pro_id_' + value).val(res.pro_id);
                    $('#salepro_pro_hsncode_' + value).val(res.hsn_code);
                    $('#averagesaleprice' + value).val(res.min_rentprice);
                    $('#salemainprice_' + value).val(res.proprice);
                    $('#saleprice_' + value).val(res.proprice);
                    $('#saledisc_price_' + value).val(res.proprice);
                    $('#saletax_amt_' + value).val(res.gstamt);
                    $('#grand_total_sale' + value).text(res.proprice);
                    //$('#saleprod_tax_' + value).val(res.tax_rate);
                    $('#saleprod_tax_' + value).val(18);
                    get_total_price_per_qty_sale(value);
                    $('.selectpicker').selectpicker('refresh');
                });
    }



    $('.addmorecontact').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);

        var html = '<option value=""></option>';
        var clintid = $('#clientid').val();
        $.ajax({
            url: admin_url + 'Estimates/getcompnycontact/' + clintid,
            method: 'GET',
            success(res) {
                if (res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function (k, v) {
                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';
                    });
                }
                $("#staff_id" + newaddmore).html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });

        $('#myContactTable tbody').append('<tr class="main" id="trcc' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker contid" data-live-search="true" id="staff_id' + newaddmore + '" sataff="' + newaddmore + '" onChange="staffdata(' + newaddmore + ');" name="clientdata[' + newaddmore + '][staff_id]"><option value=""></option><?php
if (isset($staff_data) && count($staff_data) > 0) {
    foreach ($staff_data as $unit_key => $staff_value) {
        ?><option value="<?php echo $staff_value['staffid'] ?>" <?php echo (isset($singlewarehouseperson['staffid']) && $singlewarehouseperson['staffid'] == $staff_value['staffid']) ? 'selected' : "" ?>><?php echo $staff_value['firstname'] . ' ' . $staff_value['lastname'] ?></option><?php
    }
}
?></select></div></td><td><div class="form-group"><input type="text" id="email' + newaddmore + '" name="clientdata[' + newaddmore + '][email]" class="form-control" onBlur="checkmail(this.value,' + newaddmore + ');"></div></td><td><div class="form-group"><input type="text" id="phonenumber' + newaddmore + '" onBlur="checkcontno(this.value,' + newaddmore + ');" name="clientdata[' + newaddmore + '][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id' + newaddmore + '" name="clientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php
if (isset($designation_data) && count($designation_data) > 0) {
    foreach ($designation_data as $designation_key => $designation_value) {
        ?><option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option><?php
    }
}
?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="clientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php
if (isset($contact_type_data) && count($contact_type_data) > 0) {
    foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
        ?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php
    }
}
?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });

    $('.addmoreshippingcontact').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);

        var html = '<option value=""></option>';
        var clintid = $('#clientid').val();
        $.ajax({
            url: admin_url + 'Estimates/getcompnycontact/' + clintid,
            method: 'GET',
            success(res) {
                if (res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function (k, v) {
                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';
                    });
                }
                $("#shipstaff_id" + newaddmore).html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });

        $('#myShippContactTable tbody').append('<tr class="main" id="trss' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker contid" data-live-search="true" id="shipstaff_id' + newaddmore + '" sataff="' + newaddmore + '" onChange="shipstaffdata(' + newaddmore + ');" name="shipclientdata[' + newaddmore + '][staff_id]"><option value=""></option><?php
if (isset($staff_data) && count($staff_data) > 0) {
    foreach ($staff_data as $unit_key => $staff_value) {
        ?><option value="<?php echo $staff_value['staffid'] ?>" <?php echo (isset($singlewarehouseperson['staffid']) && $singlewarehouseperson['staffid'] == $staff_value['staffid']) ? 'selected' : "" ?>><?php echo $staff_value['firstname'] . ' ' . $staff_value['lastname'] ?></option><?php
    }
}
?></select></div></td><td><div class="form-group"><input type="text" id="shipemail' + newaddmore + '" name="shipclientdata[' + newaddmore + '][email]" class="form-control" onBlur="checkmail(this.value,' + newaddmore + ');"></div></td><td><div class="form-group"><input type="text" id="shipphonenumber' + newaddmore + '" onBlur="checkcontno(this.value,' + newaddmore + ');" name="shipclientdata[' + newaddmore + '][phonenumber]" class="form-control"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="shipdesignation_id' + newaddmore + '" name="shipclientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php
if (isset($designation_data) && count($designation_data) > 0) {
    foreach ($designation_data as $designation_key => $designation_value) {
        ?><option value="<?php echo $designation_value['id'] ?>"><?php echo $designation_value['designation'] ?></option><?php
    }
}
?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="designation_id" name="shipclientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php
if (isset($contact_type_data) && count($contact_type_data) > 0) {
    foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
        ?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php
    }
}
?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeshipclientperson(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
        $('.selectpicker').selectpicker('refresh');
    });
    function removeclientperson(procompid)
    {
        $('#trcc' + procompid).remove();
    }

    function removeshipclientperson(procompid)
    {
        $('#trss' + procompid).remove();
    }
    $('.newsite').click(function () {
        $('.sitedv').fadeToggle();
    });
    $('.addsite').click(function ()
    {
        var sitename = $('#sitename').val();
        var sitestate_id = $('#sitestate_id').val();
        var sitelocation = $('#sitelocation').val();
        var sitedescription = $('#sitedescription').val();
        var siteaddress = $('#siteaddress').val();
        var sitelandmark = $('#sitelandmark').val();
        var sitepincode = $('#sitepincode').val();
        var sitecity_id = $('#sitecity_id').val();
        if (sitename != '' & sitelocation != '' & siteaddress != '' & sitelandmark != '' & sitepincode != '')
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
                        $.each(resArr, function (k, v) {
                            html += '<option value="' + v.id + '">' + v.name + '</option>';
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
        } else
        {
            if (sitename == '')
            {
                $('#sitename').addClass('error');
            } else
            {
                $('#sitename').removeClass('error');
            }
            if (sitelocation == '')
            {
                $('#sitelocation').addClass('error');
            } else
            {
                $('#sitelocation').removeClass('error');
            }
            if (siteaddress == '')
            {
                $('#siteaddress').addClass('error');
            } else
            {
                $('#siteaddress').removeClass('error');
            }
            if (sitelandmark == '')
            {
                $('#sitelandmark').addClass('error');
            } else
            {
                $('#sitelandmark').removeClass('error');
            }
            if (sitepincode == '')
            {
                $('#sitepincode').addClass('error');
            } else
            {
                $('#sitepincode').removeClass('error');
            }
        }
    });
    function get_city_by_stateval(state_id) {
        var html = '<option value=""></option>';

        if (state_id == "") {
            $("#sitecity_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }

        $.ajax({
            url: admin_url + 'site_manager/get_cities_by_state_id/' + state_id,
            method: 'GET',
            success(res) {
                if (res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function (k, v) {
                        html += '<option value="' + v.id + '">' + v.name + '</option>';
                    });
                }
                $("#sitecity_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
    function staffdata(sataff)
    {
        var staff_id = $('#staff_id' + sataff).val();
        var url = admin_url + 'Estimates/getstaffdet/';
        $.post(url,
                {
                    staff_id: staff_id,
                },
                function (data, status) {
                    var res = JSON.parse(data);
                    $('#email' + sataff).val(res.staff_email);
                    $('#email' + sataff).attr('readonly', true);
                    $('#phonenumber' + sataff).val(res.staff_number);
                    $('#phonenumber' + sataff).attr('readonly', true);
                    $('#designation_id' + sataff).val(res.staff_designation);
                    $('#designation_id' + sataff).attr('readonly', true);
                    $('.selectpicker').selectpicker('refresh');
                });
    }

    function shipstaffdata(sataff)
    {
        var staff_id = $('#shipstaff_id' + sataff).val();
        var url = admin_url + 'Estimates/getstaffdet/';
        $.post(url,
                {
                    staff_id: staff_id,
                },
                function (data, status) {
                    var res = JSON.parse(data);
                    $('#shipemail' + sataff).val(res.staff_email);
                    $('#shipemail' + sataff).attr('readonly', true);
                    $('#shipphonenumber' + sataff).val(res.staff_number);
                    $('#shipphonenumber' + sataff).attr('readonly', true);
                    $('#shipdesignation_id' + sataff).val(res.staff_designation);
                    $('#shipdesignation_id' + sataff).attr('readonly', true);
                    $('.selectpicker').selectpicker('refresh');
                });
    }
    $('#clientid').change(function () {

        var html = '<option value=""></option>';
        var clintid = $('#clientid').val();
        $('#cust_id').val(clintid);
        $.ajax({
            url: admin_url + 'Estimates/getcompnycontact/' + clintid,
            method: 'GET',
            success(res) {
                if (res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function (k, v) {
                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';
                    });
                }
                $("#shipstaff_id0").html('').html(html);
                $("#staff_id0").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });


    });

    $('.addcont').click(function () {
        var formData = $('#contact-form').serialize();
        $.ajax({
            url: '<?php echo base_url(); ?>admin/Estimates/add_cont',
            type: 'post',
            data: formData,
            success: function (data, status) {
                jQuery('.close').click();
                dropdownlist();
            }
        });



    });
    function dropdownlist()
    {
        var html = '<option value=""></option>';
        var clintid = $('#clientid').val();
        $.ajax({
            url: admin_url + 'Estimates/getcompnycontact/' + clintid,
            method: 'GET',
            success(res) {
                if (res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function (k, v) {
                        html += '<option value="' + v.id + '">' + v.firstname + '</option>';
                    });
                }
                $("#staff_id0").html('').html(html);
                $("#shipstaff_id0").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

    function get_po_paymentdata(){
        var po_id = '<?php echo $purchase_info['id']; ?>';
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/purchase/get_payment_percent'); ?>",
            data    : {'po_id' : po_id},
            success : function(response){
                if(response != ''){
                    $('.popayment_html').html(response);
                    $(".finalpaymentamtdiv").hide();
                }
            }
        });
    }
    function contact(client_id, contact_id) {
        var client_id = $('#clientid').val();
        if (typeof (contact_id) == 'undefined') {
            contact_id = '';
        }
        requestGet('clients/contact/' + client_id + '/' + contact_id).done(function (response) {
            $('#contact_data').html(response);
            $('#contact').modal({
                show: true,
                backdrop: 'static'
            });
            $('body').off('shown.bs.modal', '#contact');
            $('body').on('shown.bs.modal', '#contact', function () {
                if (contact_id == '') {
                    $('#contact').find('input[name="firstname"]').focus();
                }
            });
            init_selectpicker();
            init_datepicker();
            custom_fields_hyperlink();
            validate_contact_form();
        }).fail(function (error) {
            var response = JSON.parse(error.responseText);
            alert_float('danger', response.message);
        });
    }



    $('#clientid').change(function () {


       var clintid = $('#clientid').val();

       if(clintid > 0){
            $.ajax({
                url: admin_url + 'Estimates/gettaxinfo/' + clintid,
                method: 'GET',
                success(res) {
                    if (res != "") {
                         $('#tax_type').val(res);
                    }

                }
            });
       }



    });

</script>
<?php if (!isset($contact)) { ?>
    <script>
        $(function () {
            // Guess auto email notifications based on the default contact permissios
            var permInputs = $('input[name="permissions[]"]');
            $.each(permInputs, function (i, input) {
                input = $(input);
                if (input.prop('checked') === true) {
                    $('#contact_email_notifications [data-perm-id="' + input.val() + '"]').prop('checked', true);
                }
            });
        });
    </script>
<?php } ?>


<script type="text/javascript">
     $('.onlynumbers').keypress(function(event){

       if(event.which != 8 && isNaN(String.fromCharCode(event.which))){
           event.preventDefault(); //stop character from entering input
       }

   });
</script>



<script type="text/javascript">
    $(document).on('change', '#clientid', function() {

    var client_id = $(this).val();

    if(client_id > 0){

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getclientcategory'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){
                     $('#rent_company_category').val(response);
                }
            }
        })

    }


});


$(document).ready(function() {

    var client_id = $("#clientid").val();

    if(client_id > 0){

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getclientcategory'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){
                     $('#rent_company_category').val(response);
                }
            }
        })

    }
    

});


</script>


<script type="text/javascript">
    $('#vendor_id').change(function () {
        var vendor_id = $('#vendor_id').val();

        if(vendor_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getvendordtails';
            $.post(url,
                    {
                        vendor_id: vendor_id,
                    },
                    function (data, status) {


                        var res = JSON.parse(data);
                        if(res != ''){
                            $('.billing_street').html(res.address);
                            $('#billing_street').val(res.address);
                            $('.billing_state').html(res.state_name);
                            $('#billing_state').val(res.state_name);
                            $('.billing_city').html(res.city_name);
                            $('#billing_city').val(res.city_name);
                            $('.billing_zip').html(res.pincode);
                            $('#billing_zip').val(res.pincode);
                            $('.billing_country').html('India');
                            $('#billing_country').val('India');
                        }

                    });
        }


    });


$('#warehouse_id').change(function () {
        var warehouse_id = $('#warehouse_id').val();

        if(warehouse_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getwarehousedtails';
                $.post(url,
                {
                    warehouse_id: warehouse_id,
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
                    $('.shipping_country').html('India');
                    $('#shipping_country').val('India');

                });
        }


    });
</script>


<script type="text/javascript">
    $( document ).ready(function() {


        var vendor_id = $('#vendor_id').val();

        if(vendor_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getvendordtails';
            $.post(url,
                    {
                        vendor_id: vendor_id,
                    },
                    function (data, status) {


                        var res = JSON.parse(data);
                        if(res != ''){
                            $('.billing_street').html(res.address);
                            $('#billing_street').val(res.address);
                            $('.billing_state').html(res.state_name);
                            $('#billing_state').val(res.state_name);
                            $('.billing_city').html(res.city_name);
                            $('#billing_city').val(res.city_name);
                            $('.billing_zip').html(res.pincode);
                            $('#billing_zip').val(res.pincode);
                            $('.billing_country').html('India');
                            $('#billing_country').val('India');
                        }

                    });
        }






        var warehouse_id = $('#warehouse_id').val();

        if(warehouse_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getwarehousedtails';
                $.post(url,
                {
                    warehouse_id: warehouse_id,
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
                    $('.shipping_country').html('India');
                    $('#shipping_country').val('India');

                });
        }

    });

</script>


</body>
</html>

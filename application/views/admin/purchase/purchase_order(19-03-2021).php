<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 75px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<input id="check_gst" type='hidden' value="0">

<!-- Modal Contact -->



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

                            <div class="col-md-6">

                               

                                <div class="form-group">

                                    <label for="vendor_id" class="control-label">Select Vendor</label>

                                    <select class="form-control selectpicker vendor_id" data-live-search="true" required="" id="vendor_id" name="vendor_id">

                                        <option value=""></option>

                                        <?php

                                        if (isset($vendors_info) && count($vendors_info) > 0) {

                                            foreach ($vendors_info as $vendor_value) {

                                                ?>

                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($purchase_info['vendor_id']) && $purchase_info['vendor_id'] == $vendor_value['id']) ? 'selected' : "" ?>><?php echo cc($vendor_value['name']); ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>


                                <div class="row">
                                    <div class="form-group col-md-6">

                                        <label for="source_type" class="control-label">Select Source</label>

                                        <select class="form-control selectpicker" data-live-search="true" required="" id="source_type" name="source_type">

                                            <option value=""></option>
                                            <option value="1" <?php echo (isset($purchase_info['source_type']) && $purchase_info['source_type'] == 1) ? 'selected' : "" ?>>Warehouse</option>
                                            <option value="2" <?php echo (isset($purchase_info['source_type']) && $purchase_info['source_type'] == 2) ? 'selected' : "" ?>>Site</option>

                                        </select>

                                    </div> 

                                    <div class="form-group col-md-6">

                                        <div id="for_warehouse" hidden>
                                                <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>

                                                <select class="form-control selectpicker warehouse_id" data-live-search="true" id="warehouse_id" name="warehouse_id">

                                                    <option value=""></option>

                                                    <?php

                                                    if (isset($all_warehouse) && count($all_warehouse) > 0) {

                                                        foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {

                                                            ?>

                                                            <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($purchase_info['warehouse_id']) && $purchase_info['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo cc($all_warehouse_value['name']); ?></option>

                                                            <?php

                                                        }

                                                    }

                                                    ?>

                                                </select>
                                        </div>

                                        <div id="for_site" hidden>
                                                <label for="site_id" class="control-label">Site Name <a target="_blank" href="<?php echo admin_url('site_manager/site_manager')?>">(Add Site)</a></label>

                                                <select class="form-control selectpicker site_id" data-live-search="true" id="site_id" name="site_id">

                                                    <option value=""></option>

                                                    <?php

                                                    if (isset($all_site) && count($all_site) > 0) {
                                                        foreach ($all_site as $site_key => $site_value) {
                                                            ?>
                                                            <option value="<?php echo $site_value['id'] ?>" <?php echo (isset($purchase_info['site_id']) && $purchase_info['site_id'] == $site_value['id']) ? 'selected' : "" ?>><?php echo cc($site_value['name']); ?></option>
                                                            <?php
                                                        }
                                                    }

                                                    ?>

                                                </select>
                                        </div>
                                            

                                    </div>       
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

                                /*$next_estimate_number = last_purchaseorder();

                               $yyyy = date('Y');

                                        $mm = date('m');



                                $_estimate_number = str_pad($__number, get_option('number_padding_prefixes'), '0', STR_PAD_LEFT);

                                $isedit = isset($estimate) ? 'true' : 'false';

                                $data_original_number = isset($estimate) ? $estimate->number : 'false';*/

                                ?>















                                <!-- <div class="row">

                                    <div class="col-md-12">



                                        <?php $value = (isset($purchase_info) ? _d($purchase_info['date']) : _d(date('Y-m-d'))); ?>

                                        <?php echo render_date_input('date', 'Purchase Order Date', $value); ?>

                                    </div>

                                </div> -->



                                <div class="form-group">

                                    <label for="billing_branch_id" class="control-label">Select Billing Branch</label>

                                    <select class="form-control selectpicker" data-live-search="true" required="" id="billing_branch_id" name="billing_branch_id">

                                        <?php

                                        if(!empty($billing_branches)){

                                            foreach ($billing_branches as $branch) {

                                                ?>

                                                <option value="<?php echo $branch->id; ?>" <?php echo (!empty($purchase_info) && $purchase_info['billing_branch_id'] == $branch->id) ? 'selected' : '' ; ?> ><?php echo cc($branch->comp_branch_name); ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                        

                                    </select>

                                </div>





                                <div class="form-group">

                                    <label for="order_type" class="control-label">Select Order Type</label>

                                    <select class="form-control selectpicker" data-live-search="true" required="" id="order_type" name="order_type">

                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['order_type'] == 1) ? 'selected' : '' ; ?> >Purchase Order</option>

                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['order_type'] == 2) ? 'selected' : '' ; ?>>Work Order</option>

                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="tax_type" class="control-label">Select Tax Type</label>

                                    <select class="form-control selectpicker" data-live-search="true" required="" id="tax_type" name="tax_type">

                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['tax_type'] == 2) ? 'selected' : '' ; ?>>Excluding</option>

                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['tax_type'] == 1) ? 'selected' : '' ; ?> >Including</option>

                                        

                                        

                                        

                                    </select>

                                </div>



                                <div class="form-group">

                                    <label for="enquiry_date" class="control-label">Other Charges Tax Type</label>

                                    <select class="form-control selectpicker" data-live-search="true" id="other_charges_tax" name="other_charges_tax">

                                        <option value="2" <?php echo (!empty($purchase_info['other_charges_tax']) && $purchase_info['other_charges_tax'] == 2) ? 'selected' : '' ; ?> >Excluding Tax</option> 

                                        <option value="1" <?php echo (!empty($purchase_info['other_charges_tax']) && $purchase_info['other_charges_tax'] == 1) ? 'selected' : '' ; ?> >Including Tax</option>  

                                    </select>

                                </div>







                                <div class="clearfix mbot15"></div>

                                <?php $rel_id = (isset($estimate) ? $estimate->id : false); ?>

                                <?php

                                if (isset($custom_fields_rel_transfer)) {

                                    $rel_id = $custom_fields_rel_transfer;

                                }

                                ?>

                                <?php echo render_custom_fields('estimate', $rel_id); ?>

                            </div>

                            <div class="col-md-6">

                                <div class="panel_s no-shadow">

                                  

                                    <div class="row">

                                       

                                        <div class="col-md-12">

                                            <div class="form-group">

                                    <label for="number">Purchase Order Number</label>

                                    <div class="input-group">

                                        <span class="input-group-addon">PO-</span>

                                        <input type="text" name="number" class="form-control" value="<?php echo (isset($purchase_info)) ? $purchase_info['number'] : po_next_number(); ?>" >

                                       <!-- <span class="input-group-addon">

                                            <span id="prefix_month" class="format-mm-yyyy"><?php echo $mm; ?></span>

                                            /

                                            <span id="prefix_year" class="format-mm-yyyy"><?php echo $yyyy; ?></span>

                                        </span> -->

                                    </div>

                                </div>



                                <div class="form-group">

                                    <label for="tax_type" class="control-label">Service Type</label>

                                    <select class="form-control selectpicker" data-live-search="true" required="" id="service_type" name="service_type">

                                        <option value=""></option>

                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 1) ? 'selected' : '' ; ?> >Rent</option>

                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 2) ? 'selected' : '' ; ?>>Sales</option>

                                        

                                        

                                    </select>

                                </div>



                                            <?php $value = (isset($purchase_info) ? $purchase_info['reference_no'] : ''); ?>

                                            <?php echo render_input('reference_no', 'Ref Quotation No.', $value); ?>



                                <div class="form-group">

                                    <label for="confirm_by" class="control-label">Confirm By</label>

                                    <select class="form-control selectpicker" data-live-search="true" required="" id="confirm_by" name="confirm_by">

                                        <option value=""></option>

                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['confirm_by'] == 1) ? 'selected' : '' ; ?> >Quotation</option>

                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['confirm_by'] == 2) ? 'selected' : '' ; ?>>Email</option>

                                        

                                        

                                    </select>

                                </div>            



                                            <?php $value = (isset($purchase_info) ? _d($purchase_info['quotation_date']) : _d(date('Y-m-d'))); ?>

                                        <?php echo render_date_input('quotation_date', 'Confirm Date', $value); ?>





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

                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]">



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

                                        <div class="col-md-6" style="display:none;">

                                            <div class="form-group select-placeholder">

                                                <label for="discount_type" class="control-label"><?php echo _l('discount_type'); ?></label>

                                                <select name="discount_type" class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                                    <option value="" selected><?php echo _l('no_discount'); ?></option>

                                                    <option value="before_tax" <?php

                                                    if (isset($estimate)) {

                                                        if ($estimate->discount_type == 'before_tax') {

                                                            echo 'selected';

                                                        }

                                                    }

                                                    ?>><?php echo _l('discount_type_before_tax'); ?></option>

                                                    <option value="after_tax" <?php

                                                    if (isset($estimate)) {

                                                        if ($estimate->discount_type == 'after_tax') {

                                                            echo 'selected';

                                                        }

                                                    }

                                                    ?>><?php echo _l('discount_type_after_tax'); ?></option>

                                                </select>

                                            </div>

                                        </div>

                                    </div>

                                    <?php $value = (isset($purchase_info) ? $purchase_info['adminnote'] : ''); ?>

                                    <?php //echo render_textarea('adminnote', 'note', $value); ?>

                                    <div class="form-group" app-field-wrapper="adminnote">
                                        <label for="adminnote" class="control-label">Note <small>(Reason for PO)</small></label>
                                        <textarea id="adminnote" name="adminnote" class="form-control" rows="4" required=""><?php echo $value; ?></textarea>
                                    </div>

                                </div>

                            </div>

                           

                            

                        </div>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <button type="submit" name="save" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">

                                Save

                            </button>



                           <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">

                                <?php echo _l('send_for_approval'); ?>

                            </button>

                        </div>

                    </div>

                </div>

            </div>





            <div id="last_rate">

                

            </div>

             





           

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        

                        <div class="row">

                            <div class="col-md-10">
                                <h4>Purchase Order Products</h4>
                            </div>

                            <div class="col-md-2">
                            <a href="<?php echo admin_url('product/product'); ?>" target="_blank" class="btn btn-info">Add New Product</a>
                            </div>

                            <div class="col-md-12">
                             <hr/>
                            </div>

                            <div class="col-md-12">

                                <div style="overflow-x:auto !important;">

                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">

                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">

                                            <thead>

                                                <tr>

                                                    <td style="width: 5px !important;"><i class="fa fa-cog"></i></td>

                                                    <td style="width: 130px !important;"><?php echo _l('prop_pro_name'); ?></td>

                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_id'); ?></td>

                                                    <td style="width: 35px !important;">HSN/SAC Code</td>

                                                    <td style="width: 70px !important;">Remark</td>

                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>

                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>

                                                  

                                                    <td style="width: 47px !important;">Tax %</td>

                                                    <td style="width: 47px !important;">Tax Amt</td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <?php

                                                $i = 1;

												$totsaleprod = 0;

                                                if (isset($product_info)) {

                                                    $totsaleprod = count($product_info);

                                                    ?>

                                                <input type="hidden" id="totalsalepro" value="<?php echo count($product_info); ?>">

                                                <?php

                                                foreach ($product_info as $single_prod_sale_det) {

                                                    

                                                   

                                                    $totproamt = ($single_prod_sale_det['ttl_price'] + $single_prod_sale_det['tax_amt']);











                                                    ?>

                                                    <tr class="trsalepro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>

                                                            <a target="_blank" href="../product/product/<?php echo $single_prod_sale_det['product_name']; ?>">

                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['product_name']; ?>">

                                                            </a>

                                                            <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $single_prod_sale_det['pro_id']; ?>">

                                                        </td>

                                                        <td>
                                                            <select class="form-control selectpicker" style="display:block !important;"  name="saleproposal[<?php echo $i; ?>][hsn_code]">
                                                                <option value="1" <?php echo ($single_prod_sale_det['hsn_code'] == 1) ? "selected" : ""; ?>>HSN</option>
                                                                <option value="2" <?php echo ($single_prod_sale_det['hsn_code'] == 2) ? "selected" : ""; ?>>SAC</option>
                                                            </select>

                                                            <!-- <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>"> -->

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['remark']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['price']; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][ttl_price]" value="<?php echo $single_prod_sale_det['ttl_price']; ?>" id="total_price1">

                                                        </td>

                                                        

                                                        <td>

                                                            <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">

                                                            <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo $single_prod_sale_det['prodtax']; ?>">

                                                        </td>  



                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="<?php echo $single_prod_sale_det['tax_amt']; ?>" id="total_price1">

                                                        </td>

                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">

                                                            <?php echo round($totproamt, 0); ?>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                    $i++;

                                                }

                                            }

                                            ?>

                                            </tbody>

                                        </table>

                                        <div class="col-xs-12" style="margin-top: 40px;">

                                            <label class="label-control subHeads"><a class="addmoresalepro" value="<?php echo $totsaleprod; ?>">Add More <i class="fa fa-plus"></i></a></label>

                                        </div>

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

                                        <input type="number" class="form-control sale_discount_percentage onlynumbers" value="<?php echo (isset($purchase_info) && $purchase_info['finaldiscountpercentage'] != '') ? $purchase_info['finaldiscountpercentage'] : ""; ?>" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">

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

                                <div class="row" style="margin-top:2%;padding:8px;">

                                    <div class="col-md-12 pull-right">

                                        <label class="col-md-6 control-label text-right">Amount In Words</label>

                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_amt_in_words text-right"></label>

                                    </div>

                                </div>

								

								

								<hr/>

                                <div class="table-responsive s_table" style="margin-top:3%;">

                                    <div class="col-md-12">

                                        <h4 class="no-mtop mrg3">Other Charges For PO</h4>

                                        <hr/>

                                    </div>

                                    <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">

                                        <thead>

                                            <tr>

                                                <th width="40%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>

                                                <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>

                                                <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>

                                                   



                                                <th width="20%" align="left">Tax</th>   

                                                

                                                <th width="10%" align="left">Tax Amount </th> 



                                                <th width="15%" align="left"><?php echo _l('total_amount'); ?>	</th>

                                                <th width="5%"  align="center"><i class="fa fa-cog"></i></th>

                                            </tr>

                                        </thead>

                                        <tbody class="ui-sortable">

                                            <?php

                                            $othertotalcharges = 0;

                                            if (count($purchase_othercharges) > 0) {

                                                $l = 0;

                                                foreach ($purchase_othercharges as $singlerentotherchargesp) {

                                                    $l++;

                                                    $othertotalcharges += $singlerentotherchargesp['amount'];

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

                                                                            ?> ><?php echo cc($othercharges_value['category_name']); ?></option>

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

                                                                <input type="number" id="amount<?php echo $l; ?>" value="<?php echo $singlerentotherchargesp['amount']; ?>" name="othercharges[<?php echo $l; ?>][amount]" onchange="getothercharges('<?php echo $l; ?>')"  class="form-control" >

                                                            </div>

                                                        </td>

                                                        

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="igst<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlerentotherchargesp['igst']; ?>" onchange="getothercharges('<?php echo $l; ?>')" class="form-control" >

                                                            </div>

                                                        </td>



                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="gst_sgst_amt<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlerentotherchargesp['gst_sgst_amt']; ?>"  class="form-control">

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <div class="form-group">

                                                                <input type="number" id="total_maount<?php echo $l; ?>" name="othercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlerentotherchargesp['total_maount']; ?>" class="form-control">

                                                            </div>

                                                        </td>

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('<?php echo $l; ?>');" ><i class="fa fa-remove"></i></button>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                }

                                            }else {

                                                ?>

                                                <tr id="tr0">

                                                    <td>

                                                        <div class="form-group">

                                                            <select class="form-control selectpicker" data-live-search="true" id="othercharges0" name="othercharges[0][category_name]">

                                                                <option value=""></option>

                                                                <?php

                                                                if (isset($othercharges) && count($othercharges) > 0) {

                                                                    foreach ($othercharges as $othercharges_key => $othercharges_value) {

                                                                        ?>

                                                                        <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option>

                                                                        <?php

                                                                    }

                                                                }

                                                                ?>

                                                            </select>

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="form-group">

                                                            <input type="text" id="sac_code0" name="othercharges[0][sac_code]" class="form-control" >

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="form-group">

                                                            <input type="number" id="amount0" onchange="getothercharges(0)" name="othercharges[0][amount]" class="form-control" >

                                                        </div>

                                                    </td>

                                                    <td>

        												<div class="form-group">

        													<input type="number" id="igst0" onchange="getothercharges(0)" name="othercharges[0][igst]" class="form-control" >

        												</div>

        											</td>

                                                    <td>

                                                        <div class="form-group">

                                                            <input type="number" id="sgst_amt0" name="othercharges[0][gst_sgst_amt]" class="form-control">

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <div class="form-group">

                                                            <input type="number" id="total_maount0" name="othercharges[0][total_maount]" class="form-control">

                                                        </div>

                                                    </td>

                                                    <td>

                                                        <button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges('0');" ><i class="fa fa-remove"></i></button>

                                                    </td>

                                                </tr>

                                            <?php } ?>

                                        </tbody>

                                    </table>

                                    <div class="col-xs-4">

                                        <label class="label-control subHeads"><a  class="addmore" value="<?php if(!empty($purchase_othercharges)){ echo count($purchase_othercharges); }else{ echo '0'; }  ?>">Add More <i class="fa fa-plus"></i></a></label>

                                    </div>

                                    <div class="col-xs-8">

                                        <label style="float : right !important;">

                                            <strong style="font-size:14px;">Other Charges Sub Total :-</strong>

                                            <strong class="rent_other_charges_subtotal"><?php echo $othertotalcharges; ?></strong>		

                                        </label>

                                    </div>

                                </div>

								

								





                                <div  class="col-md-12">

                                    <div class="form-group">

                                        <label for="specification" class="control-label">Specification</label>



                                        <textarea class="form-control tinymce" name="specification" id="specification"><?php echo (isset($purchase_info) && $purchase_info['specification'] != '') ? $purchase_info['specification'] : ""; ?></textarea>

                                    </div>

                                </div>



                                <div  class="col-md-12">

                                    <div class="form-group">

                                        <label for="product_terms_and_conditions" class="control-label">Product Terms and Conditions</label>



                                        <textarea class="form-control tinymce" name="product_terms_and_conditions" id="product_terms_and_conditions">

                                            <?php

                                        if(!empty($purchase_info)){

                                            echo $purchase_info['product_terms_and_conditions'];

                                        }
                                        ?>

                                        </textarea>

                                    </div>

                                </div>

                                <div  class="col-md-12">

                                    <div class="form-group">

                                        <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>



                                        <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions">

                                            <?php

                                        if(!empty($purchase_info)){

                                            echo $purchase_info['terms_and_conditions'];

                                        }else{ 

                                            echo get_terms_conditions('purchase_order');

                                        }

                                        ?>

                                        </textarea>

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

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][gst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="number" id="sgst' + newaddmore + '" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" onchange="getothercharges(' + newaddmore + ')" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="igst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php

    }

} else {

    if ($clientsate == get_staff_state()) {

        ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst' + newaddmore + '" value="0" name="othercharges[' + newaddmore + '][gst]" onchange="getothercharges(' + newaddmore + ')" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="sgst' + newaddmore + '" value="0" onchange="getothercharges(' + newaddmore + ')" name="othercharges[' + newaddmore + '][sgst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?>$('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

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

            $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'] ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="rentpro_name' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="renpro_id' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="150" name="rentproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averageprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" readonly class="form-control" id="rentpro_remark_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" readonly id="rentpro_pro_id_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="rentpro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="rentproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="number" class="form-control" id="rentqty_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="rentmonths_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][months]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="1" value="1"></td><td><input type="number" class="form-control" id="rentdays_' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][days]" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" min="0" value="0"></td><td><input type="number" class="form-control" id="rentmainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" name="rentproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_' + newaddmorerentpro + '" ></td><td><input type="number" class="form-control" id="rentdisc_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_rent(' + newaddmorerentpro + ')" value="0" name="rentproposal[' + newaddmorerentpro + '][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_' + newaddmorerentpro + '" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_' + newaddmorerentpro + '"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt' + newaddmorerentpro + '" value="20"></td><td><input type="hidden" name="rentproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="rentproposal[' + newaddmorerentpro + '][prodtax]" id="rentprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_' + newaddmorerentpro + '" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_' + newaddmorerentpro + '"></td></tr>');

        } else

        {

            $('.renttable tbody').append('<tr class="trrentpro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getprodata(' + newaddmorerentpro + ')" data-live-search="true" id="prodid' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

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

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']) ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><select class="form-control selectpicker pr_id" style="display:block !important;"  name="saleproposal[' + newaddmorerentpro + '][hsn_code]"><option value="1">HSN</option><option value="2">SAC</option></select></td><td><input type="text" id="salepro_pro_remark_' + newaddmorerentpro + '" class="form-control" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][ttl_price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="saleprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

        } else

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']) ?></option><?php

    }

}

?></select><input class="form-control" id="salepro_name' + newaddmorerentpro + '" type="hidden" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" id="salepro_pro_id_' + newaddmorerentpro + '" readonly name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><select class="form-control selectpicker pr_id" style="display:block !important;"  name="saleproposal[' + newaddmorerentpro + '][hsn_code]"><option value="1">HSN</option><option value="2">SAC</option></select></td><td><input type="text" id="salepro_pro_remark_' + newaddmorerentpro + '" class="form-control" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="number" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="1"><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" value="9"></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

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

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" onchange="getothersalecharges(' + newaddmore + ')"  class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } else { ?>  $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_igst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][igst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" value="0" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php

    }

} else {

    if ($clientsate == get_staff_state()) {

        ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '"  name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

            }

        }

        ?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" onchange="getothersalecharges(' + newaddmore + ')" ></div></td><td><div class="form-group"><input type="number" id="sale_gst' + newaddmore + '" value="0" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][gst]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_sgst' + newaddmore + '" onchange="getothersalecharges(' + newaddmore + ')" name="saleothercharges[' + newaddmore + '][sgst]" value="0" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');<?php } ?><?php if ($clientsate != get_staff_state()) { ?> $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php

        if (isset($othercharges) && count($othercharges) > 0) {

            foreach ($othercharges as $othercharges_key => $othercharges_value) {

                ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php

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

        var vendor_id = $('#vendor_id').val();

        var rent_company_category = $('#rent_company_category').val();

        var url = '<?php echo base_url(); ?>admin/Site_manager/getPruchaseorderProductDetails';

        $.post(url,

                {

                    prodid: prodid,
                    
                    vendor_id: vendor_id,

                    rent_company_category: rent_company_category,

                },

                function (data, status) {

                    var res = JSON.parse(data);

                    if(res.isVendorProduct == 1){
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

                        $('#saleprod_tax_' + value).val(res.tax);

                        get_total_price_per_qty_sale(value);
                    }else{
                        alert('This product is not set in vendor product!');
                        $('#saleprodid' + value).val('');
                    }
                    

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

                       // $("#site_id").html('').html(html);

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



    function getothercharges(value)

    {

        var amount = $('#amount' + value).val();

        var igst = $('#igst' + value).val();

        if (typeof igst === "undefined") {

            var gst = $('#gst' + value).val();

            var sgst = $('#sgst' + value).val();

            var igst = parseInt(gst) + parseInt(sgst);

        }

        var totalgstamt = parseInt((igst * amount) / 100);

        var totalamt = parseInt(amount) + parseInt(totalgstamt);

        $('#gst_sgst_amt' + value).val(totalgstamt);

        $('#total_maount' + value).val(totalamt);

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
        var site_id = $('#site_id').val();
        //alert(site_id);
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

        if(site_id > 0){
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
        }
           

    });

</script>







<script type="text/javascript">

    $(document).on('change', '.pr_id', function() { 

    var prodcut_id = $(this).val();

    if(prodcut_id > 0){

        $.ajax({

            type    : "POST",

            url     : "<?php echo base_url(); ?>admin/Purchase/last_productprice",

            data    : {'prodcut_id' : prodcut_id},

            success : function(response){

                if(response != ''){

                    $("#last_rate").html(response);

                }

            }

        })

    }

        

    });


    $(document).on('change', '#source_type', function() { 

        var source_type = $(this).val();  
        if(source_type == 1){
            $("#for_warehouse").show();
            $("#for_site").hide();
        }else{            
            $("#for_warehouse").hide();
            $("#for_site").show();
        }

    });


    $( document ).ready(function() {
        var source_type = $("#source_type").val();  
        if(source_type == 1){
            $("#for_warehouse").show();
            $("#for_site").hide();
        }else if(source_type == 2){           
            $("#for_warehouse").hide();
            $("#for_site").show();
        }

    });
</script>





</body>

</html>


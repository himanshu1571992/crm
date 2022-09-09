<?php init_head(); ?>
<link rel="stylesheet" href="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.css">
<!-- <link href="https://unpkg.com/gijgo@1.9.13/css/gijgo.min.css" rel="stylesheet" type="text/css" /> -->
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 120px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}

.ui-timepicker-viewport {
    padding: 0;
    overflow: auto;
    overflow-x: hidden;
    background-color: #fff;
}
.ui-timepicker-viewport .ui-menu-item .ui-state-hover{
    background-color:royalblue
}
/* .ui-state-hover{background-color:royalblue;border:1px solid #999;font-weight:400;color:#212121} */
</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->
<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'mr_form', 'class' => 'proposal-form')); ?>
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
                                                    $vendor_id = (isset($po_info) && !empty($po_info->vendor_id)) ? $po_info->vendor_id : "";
                                                ?>
                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (!empty($vendor_id) && $vendor_id == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="po_number" class="control-label">Purchase Order Number</label>
                                    <select class="form-control selectpicker po_number" data-live-search="true" required="" id="po_number" name="po_number">
                                        <option value=""></option>
                                        <?php
                                        if(!empty($po_info)){
                                            echo '<option value="'.$po_info->id.'" selected>'.$po_info->prefix.$po_info->number.' - '._d($po_info->date).'</option>';
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



                                    <div class="col-md-6">

                                        <p class="bold"><?php echo _l('invoice_bill_to'); ?></p>

                                        <address>

                                            <span class="billing_name">--</span><br>

                                            <span class="billing_street">--</span><br>

                                            <span class="billing_city">--</span>,

                                            <span class="billing_state">--</span>

                                            <br/>

                                            <span class="billing_country">--</span>,

                                            <span class="billing_zip">--</span>

                                        </address>

                                    </div>

                                    <div class="col-md-6">

                                        <p class="bold"><?php echo _l('ship_to'); ?></p>

                                        <address>

                                            <span class="shipping_name">--</span><br>

                                            <span class="shipping_street">--</span><br>

                                            <span class="shipping_city">--</span>,

                                            <span class="shipping_state">--</span>

                                            <br/>

                                            <span class="shipping_country">--</span>,

                                            <span class="shipping_zip">--</span>

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
                                        <?php
                                            // $value = _d(date('Y-m-d'));
                                            $value = "";
                                            if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                $value = _d($materialreceipt_info->date);
                                            }elseif (isset($purchase_info)) {
                                                $value = _d($purchase_info['date']);
                                            }
                                           // echo render_date_input('date', 'Material Receipt Date', $value);
                                        ?>
                                        <div class="row">
                                            <div class="col-md-6">
                                                <div class="form-group" app-field-wrapper="date">
                                                    <label for="date" class="control-label">Material Receipt Date <br><span style="color:red;">(This should be Material Receipt Date)</span></label>
                                                    <div class="input-group date"><input type="text" id="date" name="date" class="form-control datepicker" value="<?php echo $value; ?>" required>
                                                        <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                            <?php
                                                // $value = _d(date('Y-m-d'));
                                                $mr_time = "";
                                                if (isset($materialreceipt_info) && !empty($materialreceipt_info->mr_time)){
                                                    $mr_time = date("H:i A", strtotime($materialreceipt_info->mr_time));
                                                }
                                            // echo render_date_input('date', 'Material Receipt Date', $value);
                                            ?>
                                            <div class="col-md-6">
                                                <!-- <input type="text" id="time" name="time" class="timepicker" value="<?php echo $value; ?>" required> -->
                                                <div class="form-group" app-field-wrapper="date">
                                                    <label for="date" class="control-label">Material Receipt Time <br><span style="color:red;">(This should be Material Receipt Time)</span></label>
                                                    <div class="input-group"><input type="type" id="time" name="time" class="form-control timepicker" value="<?php echo $mr_time; ?>" required>
                                                        <div class="input-group-addon"><i class="fa fa-clock-o"></i></div>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="type_of_billing" class="control-label">Type of Billing</label>
                                            <select class="form-control selectpicker" data-live-search="true" required="" id="type_of_billing" name="type_of_billing">
                                                <option value="" ></option>
                                                <option value="1" <?php echo (isset($materialreceipt_info->type_of_billing) && $materialreceipt_info->type_of_billing == 1) ? 'selected' : ''; ?>>Monthly</option>
                                                <option value="2" <?php echo (isset($materialreceipt_info->type_of_billing) && $materialreceipt_info->type_of_billing == 2) ? 'selected' : ''; ?> >Part</option>
                                                <option value="3" <?php echo (isset($materialreceipt_info->type_of_billing) && $materialreceipt_info->type_of_billing == 3) ? 'selected' : ''; ?> >Full</option>
                                            </select>
                                        </div> 
                                    </div>
                                    <div class="col-md-6">
                                        <div class="form-group" app-field-wrapper="challan_no">
                                            <label for="challan_no" class="control-label">challan No.</label>
                                            <?php
                                                $challan_no = (isset($materialreceipt_info) && !empty($materialreceipt_info->challan_no)) ? $materialreceipt_info->challan_no : "";
                                            ?>
                                            <input type="text" id="challan_no" name="challan_no" class="form-control" value="<?php echo $challan_no; ?>">
                                        </div>
                                    </div>
                                </div>
                                
                                
                            </div>
                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                    <div class="row">
                                        <div class="col-md-12">
                                            <label for="number" class="control-label">MR Number</label>
                                            <?php
                                                $mr_number = mr_next_number();
                                                if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                    $mr_number = $materialreceipt_info->numer;
                                                }
                                            ?>
                                            <input type="text" id="number" name="number" class="form-control" value="<?php echo $mr_number; ?>">
                                        </div>
                                        <div class="col-md-12">
                                            <?php $value = (isset($purchase_info) ? $purchase_info['reference_no'] : ''); ?>
                                            <?php
                                                $value = "";
                                                if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                    $value = $materialreceipt_info->reference_no;
                                                }elseif (isset($purchase_info)) {
                                                    $value = $purchase_info['reference_no'];
                                                }

                                            echo render_input('reference_no', 'reference_no', $value); ?>
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

                                        <!-- <div class="col-md-12" style="margin-bottom:2%;">
                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">
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
                                        </div> -->
                                    </div>
                                    <?php //echo render_textarea('adminnote', 'note', $value); ?>
                                    <div class="form-group" app-field-wrapper="adminnote">
                                        <label for="adminnote" class="control-label">Note</label>
                                        <?php
                                            $value = "";
                                            if (isset($materialreceipt_info) && !empty($materialreceipt_info)){
                                                $value = $materialreceipt_info->adminnote;
                                            }elseif(isset($purchase_info)){
                                                $value = $purchase_info['adminnote'];
                                            }
                                        ?>
                                        <textarea id="adminnote" name="adminnote" class="form-control" style="height: 110px;" rows="5"><?php echo $value; ?></textarea>
                                    </div>
                                    <div class="form-group col-md-6" app-field-wrapper="complete">
                                        <label for="complete" class="control-label">Mark as complete </label>
                                        <input type="checkbox" name="complete" value="1">
                                    </div>
                                    <div class="form-group col-md-6" app-field-wrapper="extrusion">
                                        <label for="extrusion" class="control-label">MR for Extrusion </label>
                                        <input type="checkbox" name="extrusion" id="extrusion" value="1">
                                    </div>
                                    <div class="form-group">
                                        <label for="files" class="control-label"><?php echo 'Attachment File'; ?></label>
                                        <input type="file" id="files" multiple="" name="files[]" style="width: 100%;">
                                        <br>
                                        <?php
                                            if(!empty($file_info)){
                                                $j = 1;
                                                foreach ($file_info as $key => $value) {
                                                    $extension = pathinfo($value->file, PATHINFO_EXTENSION);
                                                    if (in_array(strtolower($extension), ["jpg", "png"])){
                                                        ?>
                                                        <a class="img-thumbnail" href="<?php echo base_url('uploads/material_receipt') . "/" . $value->file; ?>" target="_blank"><img src="<?php echo base_url('uploads/material_receipt') ."/". $value->file; ?>" title="<?php echo $value->file; ?>" width="50px" height="50px" ></a>
                                                    <?php
                                                    }else{
                                                    ?>
                                                        <a href="<?php echo base_url('uploads/material_receipt') . "/" . $value->file; ?>" target="_blank"><i class="fa-2x fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                    <?php
                                                    
                                                $j++;
                                                    }
                                                }
                                            }
                                        ?>
                                    </div>
                                                        <!-- <picture>
                                                            <source srcset="..." type="image/svg+xml">
                                                            <img src="<?php echo base_url('uploads/material_receipt/'.$value->file); ?>" class="img-fluid img-thumbnail" alt="<?php echo $value->file; ?>">
                                                        </picture>
                                                        <a href="<?php echo base_url('uploads/material_receipt/'.$value->file); ?>" download="" ><?php echo $j.') File - '.$j; ?></a><br> -->
                                </div>

                            </div>
                        </div>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                           <button type="button" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit mr_submit">

                                <?php echo _l('send_for_approval'); ?>

                            </button>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4>Assign Approval Persons</h4>
                                <hr>
                            </div>
                            <div class="col-md-12">
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="vendor_id" class="control-label">Select Quality Person</label>
                                        <select class="form-control selectpicker quality_person" data-live-search="true" required="" id="quality_person" name="quality_person">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list) && count($staff_list) > 0) {
                                                foreach ($staff_list as $staff) {
                                                    
                                                    if ($staff->staffid != get_staff_user_id()){
                                                        $staff_id = "";
                                                        if (isset($quality_assign_person) && !empty($quality_assign_person->staff_id)){
                                                            $staff_id = $quality_assign_person->staff_id;
                                                        }
                                                    ?>
                                                        <option value="<?php echo $staff->staffid ?>" <?php echo ($staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="stock_person" class="control-label">Select Stock Person</label>
                                        <select class="form-control selectpicker stock_person" data-live-search="true" required="" id="stock_person" name="stock_person">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list) && count($staff_list) > 0) {
                                                foreach ($staff_list as $staff) {
                                                    
                                                    if ($staff->staffid != get_staff_user_id()){
                                                        $staff_id = "";
                                                        if (isset($stock_assign_person) && !empty($stock_assign_person->staff_id)){
                                                            $staff_id = $stock_assign_person->staff_id;
                                                        }
                                                    ?>
                                                        <option value="<?php echo $staff->staffid ?>" <?php echo ($staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="purchase_person" class="control-label">Select Purchase Person</label>
                                        <select class="form-control selectpicker purchase_person" data-live-search="true" required="" id="purchase_person" name="purchase_person">
                                            <option value=""></option>
                                            <?php
                                            if (isset($staff_list) && count($staff_list) > 0) {
                                                foreach ($staff_list as $staff) {
                                                    
                                                    if ($staff->staffid != get_staff_user_id()){
                                                        $staff_id = "";
                                                        if (isset($purchase_assign_person) && !empty($purchase_assign_person->staff_id)){
                                                            $staff_id = $purchase_assign_person->staff_id;
                                                        }
                                                    ?>
                                                        <option value="<?php echo $staff->staffid ?>" <?php echo ($staff_id == $staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>
                                                    <?php
                                                    }
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>   
            <?php if (isset($materialreceipt_info)){ ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <h4 class="no-mtop mrg3">Material Receipt</h4>
                                </div>
                                <hr/>
                                <div class="col-md-12">
                                    <div>
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <td>S.No</td>
                                                        <td>Pro Name</td>
                                                        <td>Pro ID</td>
                                                        <td>Balance Qty</td>
                                                        <td>Unit as per PO</td>
                                                        <td>Qty Received as per PO <br><small>(Including Reject Qty)</small></td>
                                                        <td>Qty Received in Nos</td>
                                                        <td>Reject Qty</td>
                                                        <td>Rejection Remark</td>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $product_info=$this->db->query("SELECT * FROM `tblmaterialreceiptproduct` WHERE `mr_id`='".$materialreceipt_info->id."'")->result();
                                                    if (!empty($product_info)) {
                                                        $i = 1;
                                                        foreach ($product_info as $key => $value) {

                                                            $qty_info = $this->db->query("SELECT COALESCE(SUM(qty),0) as ttl_qty FROM `tblmaterialreceiptproduct` WHERE `po_id`='" . $materialreceipt_info->po_id . "' and `product_id` = '" . $value->product_id . "'")->row();

                                                            $bal_qty = ($value->qty - $qty_info->ttl_qty);

                                                            $vendorproduct_info = $this->db->query("SELECT * from tblvendorproductsname where vendor_id = '" . $materialreceipt_info->vendor_id . "' and product_id = '" . $value->product_id . "' ")->row();
                                                            $vendor_product_name = '--';
                                                            if (!empty($vendorproduct_info)) {
                                                                $vendor_product_name = $vendorproduct_info->product_name;
                                                            }
                                                            $product_name = value_by_id("tblproducts", $value->product_id, "sub_name");
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i;?></td>
                                                                <td><?php echo $product_name.' ('.$vendor_product_name.')';?></td>
                                                                <td><?php echo "PRO-ID".$value->product_id;?></td>
                                                                <td><input class="form-control" type="text" id="product_<?php echo $i; ?>" readonly="" value="<?php echo $bal_qty; ?>"></td>
                                                                <td>
                                                                    <select class="form-control selectpicker unitidcls unitid<?php echo $i; ?>" onchange="get_product_received_qty(this.value,<?php echo $i; ?>)" data-proid="<?php echo $value->product_id; ?>" style="display: inline-block !important;" data-live-search="true" id="unit_id_<?php echo $i; ?>" name="mr_products[<?php echo $i; ?>][unit_id]">
                                                                        <option value=""></option>
                                                                        <?php
                                                                            if (isset($unitlist) && count($unitlist) > 0) {
                                                                                foreach ($unitlist as $uvalue) {
                                                                                    $selected = ($value->unit_id == $uvalue->id) ? "selected" : "";
                                                                                    echo '<option value="' . $uvalue->id . '" '.$selected.'>' . $uvalue->name . '</option>';
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </select>
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control p_id proReceivedQty" rid="<?php echo $i; ?>" id="proqty<?php echo $i; ?>" value="<?php echo $value->qty; ?>" val="<?php echo $value->product_id; ?>" name="mr_products[<?php echo $i; ?>][received_qty]">
                                                                    <input type="hidden" value="<?php echo $value->product_id; ?>" name="product[]">
                                                                    <input type="hidden" value="<?php echo $value->product_id; ?>" name="mr_products[<?php echo $i; ?>][product_id]">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control" id="qtyinnos<?php echo $i; ?>"  val="<?php echo $value->product_id; ?>" value="<?php echo $value->qty_in_nos; ?>" name="mr_products[<?php echo $i; ?>][nosqty]">
                                                                </td>
                                                                <td>
                                                                    <input type="text" class="form-control p_id" val="<?php echo $value->product_id; ?>" name="mr_products[<?php echo $i; ?>][reject_qty]" value="<?php echo $value->reject_qty; ?>">
                                                                </td>
                                                                <td><input type="text" name="mr_products[<?php echo $i; ?>][remark]" value="<?php echo $value->remark; ?>"></td>
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
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            <?php }else{ ?>
                <div id="produc_table"></div>
            <?php } ?>
            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<?php init_tail(); ?>
<script src="//cdnjs.cloudflare.com/ajax/libs/timepicker/1.3.5/jquery.timepicker.min.js"></script>
<!-- <script src="https://unpkg.com/gijgo@1.9.13/js/gijgo.min.js" type="text/javascript"></script> -->

<script type="text/javascript">
	$('#vendor_id').change(function(){
	var vendor_id = $(this).val();
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url(); ?>admin/Purchase/get_purchase_number",
			data    : {'vendor_id' : vendor_id},
			success : function(response){
				if(response != ''){
					$("#po_number").html(response);
					$('.selectpicker').selectpicker('refresh');
				}
			}
		})
	});
</script>
<script type="text/javascript">
	$(document).on('change', '#po_number', function() {
		var po_id = $(this).val();
		if(po_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getbillandshipping';
            $.post(url,{po_id: po_id}, function (data, status) {
                var res = JSON.parse(data);

                if(res != ''){
                    $('.billing_name').html(res.billing_name);
                    $('.billing_street').html(res.billing_street);
                    $('.billing_state').html(res.billing_state);
                    $('.billing_city').html(res.billing_city);
                    $('.billing_zip').html(res.billing_zip);
                    $('.billing_country').html('India');
                    $('.shipping_name').html(res.shipping_name);
                    $('.shipping_street').html(res.shipping_street);
                    $('.shipping_state').html(res.shipping_state);
                    $('.shipping_city').html(res.shipping_city);
                    $('.shipping_zip').html(res.shipping_zip);
                    $('.shipping_country').html('India');
                }
            });
        }
	});
	$(document).on('change', '#po_number', function() {
	    var po_id = $(this).val();
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url(); ?>admin/Purchase/get_product_table",
			data    : {'po_id' : po_id},
			success : function(response){
				if(response != ''){
					$("#produc_table").html(response);
                    $('.selectpicker').selectpicker('refresh');
				}
			}
		})
	});
	/*$(document).on('keyup', '.p_id', function() {

		var qty = parseInt($(this).val());

		var p_id = $(this).attr('val');



		var bal_qty = parseInt($("#product_"+p_id).val());



		if(qty > bal_qty){

			alert('Quantity cannot be grater then balance quantity!');

			$(this).val(bal_qty);

		}

	});*/

    $(document).on('keyup', '.proReceivedQty', function(){
        var qty = parseInt($(this).val());
        var rid = $(this).attr('rid');
        var unitid = $('#unit_id_'+rid).val();
        if (unitid == '9'){
            $("#qtyinnos"+rid).val(qty);
        }else{
            $("#qtyinnos"+rid).val('');
        }
    });

    $( document ).ready(function() {

        var po_id = $("#po_number").val();
        if(po_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getbillandshipping';
            $.post(url,{po_id: po_id}, function (data, status) {
                var res = JSON.parse(data);
                if(res != ''){
                    $('.billing_name').html(res.billing_name);
                    $('.billing_street').html(res.billing_street);
                    $('.billing_state').html(res.billing_state);
                    $('.billing_city').html(res.billing_city);
                    $('.billing_zip').html(res.billing_zip);
                    $('.billing_country').html('India');
                    $('.shipping_name').html(res.shipping_name);
                    $('.shipping_street').html(res.shipping_street);
                    $('.shipping_state').html(res.shipping_state);
                    $('.shipping_city').html(res.shipping_city);
                    $('.shipping_zip').html(res.shipping_zip);
                    $('.shipping_country').html('India');
                }
            });

            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/Purchase/get_product_table",
                data    : {'po_id' : po_id},
                success : function(response){
                    if(response != ''){
                        $("#produc_table").html(response);
                        $('.selectpicker').selectpicker('refresh');
                    }
                }
            })
        }
     });

     /* this section use for set qty according to unit */
    // $(document).on('change', '.unitidcls', function() {
    //     // var unitval = $(this).val();
    //     var proid = $(this).data("proid");
    //     var rid = $(this).data("rid");
    //     alert(rid);
    //     // var unit_id = $("#unit_id_"+proid).val();
    //     var unit_id = $("#unitid"+rid).val();
    //     if (unit_id == '9'){
    //         var ttlqty = $("#proqty"+rid).val();
    //         $("#qtyinnos"+rid).val(ttlqty);
    //         // var ttlqty = $("input[name='product_"+proid+"']").val();
    //         // $("input[name='nosqty_"+proid+"']").val(ttlqty);
    //     }else{
    //         $("#qtyinnos"+rid).val('');
    //         // $("input[name='nosqty_"+proid+"']").val('');
    //     }
    // });
        function get_product_received_qty(unit_id, rid){
            $("#qtyinnos"+rid).val('');
            if (unit_id == '9'){
                var ttlqty = $("#proqty"+rid).val();
                $("#qtyinnos"+rid).val(ttlqty);
            }
        }
</script>
<script type="text/javascript">
    $(function() {
       $(".mr_submit").click(function(){
            var assign = $("#assign").val();
            var vendor_id = $("#vendor_id").val();
            var po_number = $("#po_number").val();
            var mr_date = $("#date").val();
            var mr_time = $("#time").val();
            var quality_person = $("#quality_person").val();
            var stock_person = $("#stock_person").val();
            var purchase_person = $("#purchase_person").val();
            if(assign != ''){
                if(vendor_id != ''){
                    if(po_number != ''){
                        if (mr_date != ''){
                            if (mr_time != ''){
                                if (quality_person != "" && stock_person != "" && purchase_person != ""){
                                    if($('#extrusion').is(':checked')){
                                        $('form#mr_form').submit();
                                    }else{
                                        if (confirm("You sure this MR is not for Extrusion?")){
                                            $('form#mr_form').submit();
                                        }
                                    }
                                }else{
                                    if (quality_person == ''){
                                        alert('Quality Person should be required');
                                    }else if (stock_person == ''){
                                        alert('Stock Person should be required');
                                    }else if (purchase_person == ''){
                                        alert('Purchase Person should be required');
                                    }
                                }
                            }else{
                                alert('Material Receipt Time should be required');
                            }
                        }else{
                            alert('Material Receipt Date should be required');
                        }
                    }else{
                        alert('Please select Purchse order!');
                    }
                }else{
                    alert('Please select vendor!');
                }
            }else{
                alert('Please select assign person!');
            }
        });
    });
    

    $(function () { 
         
        $('.timepicker').timepicker({  
            format: 'h:i A',
            // interval: 15, 
             
        });  
        
        // $('.timepicker').timepicker({
        //     timeFormat: 'h:mm p',
        //     interval: 60,
        //     minTime: '10',
        //     maxTime: '6:00pm',
        //     defaultTime: '11',
        //     startTime: '10:00',
        //     dynamic: false,
        //     dropdown: true,
        //     scrollbar: true
        // });
    });  

    
</script>

</body>

</html>

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
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
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
                                                <?php echo $billing_street; ?>
                                            </span><br>
                                            <span class="billing_city">
                                                <?php $billing_city = (isset($estimate) ? $estimate->billing_city : '--'); ?>
                                                <?php $billing_city = ($billing_city == '' ? '--' : $billing_city); ?>
                                                <?php echo $billing_city; ?></span>,
                                            <span class="billing_state">
                                                <?php $billing_state = (isset($estimate) ? $estimate->billing_state : '--'); ?>
                                                <?php $billing_state = ($billing_state == '' ? '--' : $billing_state); ?>
                                                <?php echo $billing_state; ?></span>
                                            <br/>
                                            <!-- <span class="billing_country">
                                                <?php $billing_country = (isset($estimate) ? get_country_short_name($estimate->billing_country) : '--'); ?>
                                                <?php $billing_country = ($billing_country == '' ? '--' : $billing_country); ?>
                                                <?php echo $billing_country; ?></span>, -->
                                            <span class="billing_zip">
                                                <?php $billing_zip = (isset($estimate) ? $estimate->billing_zip : '--'); ?>
                                                <?php $billing_zip = ($billing_zip == '' ? '--' : $billing_zip); ?>
                                                <?php echo $billing_zip; ?></span>
                                        </address>
                                    </div>
                                    <div class="col-md-6">
                                        <p class="bold"><?php echo _l('ship_to'); ?></p>
                                        <address>
                                            <?php 
                                            if (isset($estimate)){ ?>
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
                                                <!-- <span class="shipping_country">
                                                    <?php $shipping_country = (isset($estimate) ? get_country_short_name($estimate->shipping_country) : '--'); ?>
                                                    <?php $shipping_country = ($shipping_country == '' ? '--' : $shipping_country); ?>
                                                    <?php echo $shipping_country; ?></span>, -->
                                                <span class="shipping_zip">
                                                    <?php $shipping_zip = (isset($estimate) ? $estimate->shipping_zip : '--'); ?>
                                                    <?php $shipping_zip = ($shipping_zip == '' ? '--' : $shipping_zip); ?>
                                                    <?php echo $shipping_zip; ?></span>
                                            <?php }else{ ?>
                                                <span class="shipping_street"></span><br>
                                                <span class="shipping_city"></span>,
                                                <span class="shipping_state"></span>
                                                <br/>
                                                <span class="shipping_zip"></span>
                                            <?php } ?>    
                                        </address>
                                    </div>
                                </div>
                               

                                <div class="row form-group">
                                    <div class="col-md-6">
                                        <label for="date" class="control-label"> <small class="req text-danger">* </small>Po/Wo No.</label>
                                        <input type="text" id="work_no" name="work_no" class="form-control" value="">
                                    </div>

                                    <div class="col-md-6">
                                        <?php 
                                            $value = (isset($estimate) ? _d($estimate->date) : _d(date('Y-m-d')));
                                            echo render_date_input('workdate', 'Po/Wo Date', $value); 
                                        ?>
                                    </div>
                                </div>
                                <div class="row">
                                    

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
                                        <div class="col-md-6">
                                            <div class="form-group select-placeholder">
                                                <label class="control-label"><?php echo _l('estimate_status'); ?></label>
                                                <select class="selectpicker display-block mbot15" name="status" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">
                                                    <?php foreach ($estimate_statuses as $status) { ?>
                                                        <option value="<?php echo $status; ?>" <?php echo (isset($estimate) && $estimate->status == $status) ? 'selected="selected"' : ""; ?>><?php echo format_estimate_status($status, '', false); ?></option>
                                                            <?php } ?>
                                                </select>
                                            </div>
                                        </div>

                                        <div class="col-md-6">
                                            <?php 
                                                $value = _d(date('Y-m-d'));
                                                echo render_date_input('date', 'Proforma Challan Date', $value); 
                                            ?>
                                        </div>
                                        <div class="col-md-6">
                                            <?php 
                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where `userid`='".$estimate->clientid."' ")->row();
                                            $office_person_name = $client_info->client_person_name;
                                            $office_person_no = $client_info->phone_no_1;

                                                echo render_input('office_person', 'Office Person', $office_person_name); 
                                            ?>
                                        </div>

                                        <div class="col-md-6">
                                            <?php 
                                                echo render_input('office_person_number', 'Office Person Number', $office_person_no, '', ["minlength"=>10,"maxlength"=>10]); 
                                            ?>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-6">
                                                    <?php 
                                                        echo render_input('site_person', 'Site Person', ''); 
                                                    ?>
                                                </div>
                                                <div class="col-md-6">
                                                    <?php 
                                                        echo render_input('site_person_number', 'Site Person Number', '', '',["minlength"=>10,"maxlength"=>10]); 
                                                    ?>
                                                </div>
                                            </div>
                                            
                                            
                                        </div>
                                        

                                        

                                    </div>
                                    <?php 
                                        $value = (isset($estimate) ? $estimate->adminnote : '');
                                        echo render_textarea('adminnote', 'challan_add_edit_admin_note', $value); 
                                    ?>
                                    <div class="row col-md-12">
                                        <div style="margin-bottom:2%;">
                                            <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" data-live-search="true" id="assign" name="assign" required="">
                                                <option value="">Select</option>
                                                <?php
                                                if (isset($group_info) && count($group_info) > 0) {
                                                    $group_id = (isset($challan_info)) ? $challan_info->group_id : 0;
                                                    foreach ($group_info as $value) {
                                                        $lead_staff_info = $this->db->query("SELECT * FROM tblleadstaffgroup where id = '" . $value['id'] . "' ")->row_array();
                                                        ?>
                                                        <option value="<?php echo $value['id'] ?>" <?php echo (!empty($group_id) && $group_id == $value['id']) ? 'selected' : "" ?>><?php echo cc($value['name']); ?></option>
                                                        <optgroup label="Sales Person">
                                                            <?php
                                                                $employee_info = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value['sales_person_id'] . "' ")->row_array();
                                                            ?>
                                                            <option disabled value="<?php echo $employee_info['staffid'] ?>"><?php echo $employee_info['firstname'] ?></option></optgroup>
                                                        <optgroup label="Superior Person">
                                                            <?php
                                                            $superiordata = explode(',', $lead_staff_info['superior_ids']);
                                                            foreach ($superiordata as $value1) {
                                                                $employee_info1 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value1 . "' ")->row_array();
                                                                ?>
                                                                <option disabled  value="<?php echo $employee_info1['staffid'] ?>"><?php echo $employee_info1['firstname'] ?></option>
                                                                <?php }
                                                            ?></optgroup>
                                                        <optgroup label="Quote Person">
                                                            <?php
                                                            $quotedata = explode(',', $lead_staff_info['quote_person_ids']);
                                                            foreach ($quotedata as $value2) {
                                                                $employee_info2 = $this->db->query("SELECT * FROM `tblstaff` where staffid = '" . $value2 . "' ")->row_array();
                                                                ?>
                                                                <option disabled value="<?php echo $employee_info2['staffid'] ?>"><?php echo $employee_info2['firstname'] ?></option>
                                                                <?php }
                                                            ?></optgroup>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                            </select>
                                        </div>
                                        <div class="assign_error" style="color:red;"></div>
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
                        <div class="modal-body" id="stockavdv">
                            <input type="hidden" name="rel_type" value="<?php echo $rely_type; ?>">
                            <input type="hidden" name="rel_id" value="<?php echo $rel_id; ?>">
                            <?php
                            $i = 0;
							$arrayh = array();
                            foreach ($productdata as $singleproductdata) {
                                
                                $pro_id[] = $singleproductdata['pro_id'];
                                $implodequery = $warehouse_id;
                                $yy = $warehouse_id;
                                $prodetails = $this->db->query("SELECT p.`name` as pro_name,pc.`name` as pro_cat_name FROM `tblproducts` p LEFT JOIN `tblproductcategory` pc ON p.`product_cat_id`=pc.`id` WHERE p.`id`='" . $singleproductdata['pro_id'] . "'")->row_array();
                               // $getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductcomponents` tpc LEFT JOIN `tblcomponents` tc ON tpc.`component_id`=tc.id where tpc.`product_id`='" . $singleproductdata['pro_id'] . "'")->result_array();

                                $getallrequriedcomponent = $this->db->query("SELECT tc.`name`,tc.`id`,tpc.`qty` FROM `tblproductitems` tpc LEFT JOIN `tblproducts` tc ON tpc.`item_id`=tc.id where tpc.`product_id` ='" . $singleproductdata['pro_id'] . "'")->result_array();

                                // If the product don't have any components then the product can visible in component list
                                if(empty($getallrequriedcomponent)){
                                    $getallrequriedcomponent[]  = array(
                                        'name' => get_product_name($singleproductdata['pro_id']),
                                        'id' => $singleproductdata['pro_id'],
                                        'qty' => 1
                                    );
                                }
                                // End 

                                $proname[] = $prodetails['pro_name'];
                                foreach ($getallrequriedcomponent as $singlerequriedcomponent) {

                                    //$checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='" . $singlerequriedcomponent['id'] . "' AND `service_type`='" . $service_type . "' AND `stock_type` = 1 AND (`warehouse_id`=" . $yy . ")")->row_array();

                                    $checkwarehousedet = $this->db->query("SELECT sum(`qty`) as totalqty FROM `tblprostock` WHERE `pro_id`='" . $singlerequriedcomponent['id'] . "' AND `service_type`='" . $service_type . "' AND `store` = 1 AND `stock_type` = 1 AND (`warehouse_id`=" . $yy . ")  AND (staff_id = 0 || staff_id = '".get_staff_user_id()."')")->row_array();
                                    $requiredqty = $singleproductdata['qty'] * $singlerequriedcomponent['qty'];
                                    if ($checkwarehousedet['totalqty'] > 0) {
                                        $availableqty = $checkwarehousedet['totalqty'];
                                    } else {
                                        $availableqty = 0;
                                    }
                                    $remainingqty = $availableqty - $requiredqty;
                                    $name = $singlerequriedcomponent['name'];

                                    if (!in_array($name, $arrayh)) {
                                        $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                                        $componentdata[$i]['name'] = $singlerequriedcomponent['name'];
                                        //$componentdata[$i]['qty']=$singlerequriedcomponent['qty'];
                                        $componentdata[$i]['requiredqty'] = $requiredqty;
                                        $componentdata[$i]['availableqty'] = $availableqty;
                                        $componentdata[$i]['remainingqty'] = $remainingqty;
                                        $arrayh[] = $name;
                                    } else {
                                        $table = array_column($componentdata, 'name');
                                        $tt = array_search($name, $table);
                                        $componentdata[$i]['componentid'] = $singlerequriedcomponent['id'];
                                        $componentdata[$i]['name'] = $singlerequriedcomponent['name'];
                                        //$componentdata[$i]['qty']=$componentdata[$tt]['qty']+$singlerequriedcomponent['qty'];
                                        $componentdata[$i]['requiredqty'] = $componentdata[$tt]['requiredqty'] + $requiredqty;
                                        //$componentdata[$i]['availableqty'] = $componentdata[$tt]['availableqty'] + $availableqty;
                                        $componentdata[$i]['availableqty'] = $componentdata[$tt]['availableqty'] ;
                                        $componentdata[$i]['remainingqty'] = $componentdata[$tt]['remainingqty'] + $remainingqty;

                                        //unset($componentdata[$tt]);
                                    }
                                   
                                    $i++;
                                }
                            }

                            //New Logic
							foreach($componentdata as $element) {
								$hash = $element['componentid'];
								$unique_array[$hash] = $element;
							}
							
                            $pro_id = implode(',', $pro_id);
                            $proname = implode(',', $proname);
                            ?>
                            <input type="hidden" name="pro_id" value="<?php echo $pro_id;?>">
                            <input type="hidden" name="warehouse_id" value="<?php echo $yy;?>">
							<input type="hidden" name="service_type" value="<?php echo $service_type;?>">
                            <div style="padding:7px;margin-bottom:5%;">
                                <h4 class="modal-title pull-left"><?php echo $servicetype; ?></h4>
                                <h4 class="modal-title pull-right">Warehouse Selected :- <?php echo $warehouse; ?></h4>
                            </div>
                            <div class="col-md-6"></div>
                            <div class="col-md-6">
                                <table class="table credite-note-items-table items table-main-credit-note-edit">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Product Name</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                           <?php 
                                           $pro_arr = array();  
                                           $chalanproduct = array();                                        
                                           if(!empty($productdata)){                                            
                                            $j = 1;
                                            $p = 0;
                                                foreach ($productdata as $pro){
                                                    // $chalanproduct[$j]["product_id"] = $pro['pro_id'];
                                                    // $chalanproduct[$j]["product_qty"] = $pro['qty'];
                                                    echo '<input type="hidden" name="chalanproduct['.$p.'][product_id]" value="'.$pro['pro_id'].'">';
                                                    echo '<input type="hidden" name="chalanproduct['.$p.'][product_qty]" value="'.$pro['qty'].'">';
                                                        $product_ids[] = $pro['pro_id'];
                                                         $pro_arr[] = array(
                                                            'product_id' => $pro['pro_id'],
                                                            'product_qty' => $pro['qty']
                                                        );
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $j++; ?></td>
                                                        <td><?php echo $pro['description']; ?></td>
                                                        <td><?php echo $pro['qty']; ?></td>
                                                    </tr>
                                                    <?php
                                                    $p++;
                                                }
                                           }else{
                                            ?>
                                                <tr>
                                                    <td colspan="3" align="center">Components are not available</td>
                                                </tr> 
                                            <?php
                                           }

                                           $product_json = json_encode($pro_arr);
                                           ?> 
                                    </tbody>
                                </table>
                            </div>
                            
                            <input type="hidden" name="product_json" value='<?php echo $product_json; ?>'>
                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2% !important;">
                                <thead>
                                    <tr>
                                        <th>Item Name</th>
                                        <th width="5%" align="center">Product Code</th>
                                        <th width="2%" align="center">View</th>
                                        <th width="15%" align="center">Available Stock</th>
                                        <th width="15%" align="center">Req Qty</th>
                                        <th width="5%" align="center"></th>
                                    </tr>
                                </thead>
                                <tbody class="ui-sortable" style="font-size:15px;">
                                    <?php
                                    $k = 0;
                                    if(!empty($unique_array)){
                                        foreach ($unique_array as $singlerequriedcomponent) {
                                                
                                            ?>
                                            <tr class="main" id="tr<?php echo $k; ?>">
                                                <!-- <td align="left">
                                                    <div class="form-group"><input type="hidden" name="componentdata[<?php echo $k; ?>][componentid]" value="<?php echo $singlerequriedcomponent['componentid']; ?>"><?php echo $singlerequriedcomponent['name']; ?></div>
                                                    
                                                </td> -->
                                                <td align="left">
                                                    <div class="form-group">
                                                        <select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="getprostock(this.value, <?php echo $k; ?>)" name="componentdata[<?php echo $k; ?>][componentid]" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                                if (isset($item_data) && count($item_data) > 0) {
                                                                    foreach ($item_data as $unit_key => $component_value) {
                                                                        $selectedcls = ($singlerequriedcomponent['componentid'] == $component_value['id']) ? 'selected=""':'';
                                                            ?>
                                                                        <option value="<?php echo $component_value['id'] ?>" <?php echo $selectedcls; ?>><?php echo $component_value['sub_name'].product_code($component_value['id']); ?></option>
                                                            <?php
                                                                    }
                                                                }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td class="procode_<?php echo $k; ?>"><?php echo product_code($singlerequriedcomponent['componentid']); ?></td>
                                                <td class="prolink_<?php echo $k; ?>"><a target="_blank" href="<?php echo admin_url("product_new/view/".$singlerequriedcomponent['componentid']); ?>">View</a></td>
                                                <td width="10%" align="center"><input class="form-control" id="avabqty<?php echo $k; ?>"  type="text" name="componentdata[<?php echo $k; ?>][availableqty]" value="<?php echo $singlerequriedcomponent['availableqty']; ?>"></td>
                                                <td width="10%" align="center"><input class="form-control" id="reqqty<?php echo $k; ?>"  type="text" name="componentdata[<?php echo $k; ?>][requiredqty]" value="<?php echo $singlerequriedcomponent['requiredqty']; ?>"></td>
                                                <td width="5%">
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removecomponent(<?php echo $k; ?>);" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                            <?php
                                            $k++;
                                        }
                                    }else{
                                       ?>
                                        <tr class="main" id="tr0">
                                            <td colspan="7" align="center">Components are not available</td>
                                        </tr>    
                                       <?php 
                                    }                                    
                                    ?>

                                </tbody>
                            </table>
							<div class="col-xs-12">
								<label class="label-control subHeads"><a class="addmorecomp" value="<?php echo (!empty($k)) ? $k : 1; ?>">Add More Item <i class="fa fa-plus"></i></a></label>
							</div>
                            <div  class="col-md-12">
                                <div class="form-group">
                                    <label for="note" class="control-label">Note</label>
                                    <textarea class="form-control tinymce" name="note" id="note"></textarea>
                                </div>
                            </div>
                            <div  class="col-md-12" style="margin-top:50px;">
                                <div class="form-group">
                                    <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>                              
                                    <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions"><?php echo get_terms_conditions('challan'); ?></textarea>
                                </div>
                            </div>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
<!--                                <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    <?php echo _l('generate_chalan'); ?>
                                </button>-->
                                <a href="javascript:void(0);" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit"><?php echo _l('generate_chalan'); ?></a>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <?php echo form_close(); ?>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>
<script>
    

        $('.deliver_qty').keyup(function(){
            var deliver_id = $(this).attr('id');
            var deliver_qty = parseInt($(this).val());
            var arr = deliver_id.split('qty');
            id = arr[1];

            var reqqty = parseInt($('#reqqty'+id).val());
            var pending_qty = parseInt(reqqty-deliver_qty);

            $('#pendingqty'+id).val(pending_qty);
        }); 

        // $(document).ready(function() {
            
        // });
        
</script> 


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
        
        /*$(function () {
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

        });*/
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

            var procode = 'PRO-'+proid;
            var prolink = "<?php echo admin_url("product_new/view/")?>"+proid;
            $(".procode_"+value).html(procode);
            $(".prolink_"+value).html('<a target="_blank" href="'+prolink+'">View</a>');

			var warehouseid='<?php echo $implodequery;?>';
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
		function statuschange(value,val) {
			if(value==1)
			{
				$('#pendingqty'+val).val(0);
				$('#deliverableqty'+val).val($('#reqqty'+val).val());
			}
		}	
		
		$('.addmorecomp').click(function(){
			 var addmore = parseInt($(this).attr('value'));
            var newaddmore = addmore + 1;
             $(this).attr('value', newaddmore);
			$('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td align="left"><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="getprostock(this.value,'+newaddmore+')" name="componentdata[' + newaddmore + '][componentid]" data-live-search="true"><option value=""></option><?php
            if (isset($item_data) && count($item_data) > 0) {
                foreach ($item_data as $unit_key => $component_value) {
                    ?><option value="<?php echo $component_value['id'] ?>" ><?php echo $component_value['sub_name'].product_code($component_value['id']); ?></option><?php
                }
            }
            ?></select></div></td><td class="procode_'+newaddmore+'"></td><td class="prolink_'+newaddmore+'"></td><td width="10%" align="center"><input class="form-control" id="avabqty' + newaddmore + '"  type="text" name="componentdata[' + newaddmore + '][availableqty]" ></td><td width="10" align="center"><input type="text" id="reqqty'+newaddmore+'" name="componentdata['+newaddmore+'][requiredqty]" class="form-control" value="1"></td><td width="5%"><button type="button" class="btn pull-right btn-danger"  onclick="removecomponent(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
	$('.selectpicker').selectpicker('refresh');		
		});
    </script>

    <script>
        $(".transaction-submit").on("click", function(event){
            event.preventDefault();
            var assign_val = $("#assign").val();
            if (assign_val == ""){
                $(".assign_error").html("Please assign parson select first");
            }else{
                $("#proposal-form").submit();
            }
        });

        $(function() {
            getSitedetails();
        });

        function getSitedetails(){
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
    </script>

</body>
</html>

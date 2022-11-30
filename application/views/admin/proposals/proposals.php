<?php init_head(); ?>

<style>#address11{margin: 0px 1.5px 0px 0px;height: 112px;width: 508px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

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
            <!-- <form class="_propsal_form proposal-form" id="proposal-form" action="<?php echo $this->uri->uri_string(); ?>"> -->
            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <div class="row">

                            <?php if (isset($proposal)) { ?>

                                <div class="col-md-12">

                                    <?php echo format_proposal_status($proposal->status); ?>

                                </div>

                                <div class="clearfix"></div>

                                <hr />

                            <?php } ?>

                            <div class="col-md-6 border-right">

                                <?php $value = (isset($proposal) ? $proposal->subject : 'Quotation for '.$client_branch_name); ?>

                                <?php $attrs = (isset($proposal) ? array() : array('autofocus' => true)); ?>

                                <?php echo render_input('subject', 'proposal_subject', $value, 'text', $attrs); ?>

                            <?php

                                if(isset($_GET['rel_id']))

                                {?>

                                <div class="form-group">

                                    <label for="rel_type" class="control-label"><?php echo _l('proposal_related'); ?></label>

                                    <input type="text" name="rel_type"  class="form-control selectpicker" readonly value="<?php echo $this->input->get('rel_type');?>">

                                </div>

                                <?php

                                 if($this->input->get('rel_type')=='proposal')

                                 {?>

                                <div class="form-group">

                                    <label for="rel_type" class="control-label"><?php echo _l('proposal_for_lead'); ?></label>

                                    <a href="../leads/leads/<?php echo $this->input->get('rel_id');?>" target="_blank"><input type="text" class="form-control selectpicker" readonly style="cursor: pointer !important;" value="<?php echo 'EQ-ID-'.$this->input->get('rel_id');?>"></a>

                                    <input type="hidden" class="form-control selectpicker" name="rel_id" readonly value="<?php echo $this->input->get('rel_id');?>">

                                </div>

                                <?php

                                 }

                                 else

                                 { $custdetails=$this->db->query("SELECT * FROM `tblclientbranch` WHERE `userid`='".$this->input->get('rel_id')."'")->row_array();

                                    ?>

                                 <div class="form-group">

                                    <label for="rel_type" class="control-label"><?php echo _l('proposal_for_lead'); ?></label>

                                    <a href="../clients/client/5<?php echo $this->input->get('rel_id');?>?group=profile" target="_blank"><input type="text" class="form-control selectpicker" readonly style="cursor: pointer !important;" value="<?php echo $custdetails['client_branch_name'].' - '.$custdetails['email_id'];?>"></a>

                                    <input type="hidden" class="form-control selectpicker" name="rel_id" readonly value="<?php echo $this->input->get('rel_id');?>">

                                </div>

                                 <?php

                                 }?>

                            <?php

                                }?>

                                <div class="form-group select-placeholder <?php if(isset($_GET['rel_id'])) echo'hide';?>">

                                    <label for="rel_type" class="control-label"><?php echo _l('proposal_related'); ?></label>

                                    <select name="rel_type" onchange="get_rel_list(this.value)" id="rel_type" <?php if(isset($_GET['rel_id'])){echo"readonly ";  }?> class="selectpicker" data-width="100%" data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                        <option value=""></option>

                                        <option value="proposal" <?php

                                        if ((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')) {

                                            if ($rel_type == 'proposal') {

                                                echo 'selected';

                                            }

                                        }

                                        ?>><?php echo _l('proposal_for_lead'); ?></option>

                                        <option value="customer" <?php

                                        if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')) {

                                            if ($rel_type == 'customer') {

                                                echo 'selected';

                                            }

                                        }

                                        ?>><?php echo _l('client'); ?></option>

                                    </select>

                                </div>

                                <div class="ert"></div>

                                <div class="form-group <?php if(isset($_GET['rel_id'])) echo'hide';?> select-placeholder<?php

                                if ($rel_id == '') {

                                    echo ' hide';

                                }

                                ?> " id="rel_id_wrapper">

                                    <label for="rel_id"><span class="rel_id_label"></span></label>

                                    <div id="rel_id_select">

                                        <select name="rel_id" id="rel_id" <?php if(isset($_GET['rel_id'])){echo"readonly "; }?> class="form-control selectpicker" data-live-search="true">

                                           <option value=""></option>

                                        </select>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-12">

                                        <div class="form-group">

                                            <label for="enquiry_date" class="control-label"><?php echo _l('lead_source'); ?></label>

                                            <select class="form-control selectpicker" <?php if(isset($_GET['rel_id'])){echo"readonly "; }?> data-live-search="true" id="source" name="source[]" required multiple>

                                                <option value=""></option>

                                                <?php

                                                if (isset($all_source) && count($all_source) > 0) {

                                                    foreach ($all_source as $source_key => $source_value) {

                                                        $selected = "";
                                                        if(!empty($proposal)){
                                                            $soruce_arr = explode(',', $proposal->source);
                                                            if(in_array($source_value['id'], $soruce_arr)){
                                                                $selected = 'selected';
                                                            }
                                                        }


                                                        ?>

                                                        <option value="<?php echo $source_value['id'] ?>" <?php echo $selected; ?>><?php echo cc($source_value['name']); ?></option>

                                                        <?php

                                                    }

                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
<?php
if(!empty($lead_prod_rent_det)){
    $quotation_number = get_quotation_number(1);
}else{
    $quotation_number = get_quotation_number(2);
}
?>
                                        <?php $value = (isset($proposal) ? $proposal->number : $quotation_number ) ?>

                                        <div class="form-group" app-field-wrapper="number">
                                            <label for="number" class="control-label">Quotation Number</label>
                                            <input type="text" id="number" name="number" class="form-control" value="<?php echo $value; ?>">
                                        </div>
                                    </div>

                                    <div class="col-md-6">

                                        <?php $value = (isset($proposal) ? _d($proposal->date) : _d(date('Y-m-d'))) ?>

                                        <?php echo render_date_input('date', 'proposal_date', $value); ?>

                                    </div>

                                    <div class="col-md-12">

                                        <?php

                                        $value = '';

                                        if (isset($proposal)) {

                                            $value = _d($proposal->open_till);

                                        } else {

                                            if (get_option('proposal_due_after') != 0) {

                                                $value = _d(date('Y-m-d', strtotime('+' . get_option('proposal_due_after') . ' DAY', strtotime(date('Y-m-d')))));

                                            }

                                        }

                                        echo render_date_input('open_till', 'proposal_open_till', $value);

                                        ?>

                                    </div>

                                </div>

                                <?php

                                $selected = '';

                                $s_attrs = array('data-show-subtext' => true);

                                foreach ($currencies as $currency) {

                                    if ($currency['isdefault'] == 1) {

                                        $s_attrs['data-base'] = $currency['id'];

                                    }

                                    if (isset($proposal)) {

                                        if ($currency['id'] == $proposal->currency) {

                                            $selected = $currency['id'];

                                        }

                                        if ($proposal->rel_type == 'customer') {

                                            $s_attrs['disabled'] = true;

                                        }

                                    } else {

                                        if ($rel_type == 'customer') {

                                            $customer_currency = $this->clients_model->get_customer_default_currency($rel_id);

                                            if ($customer_currency != 0) {

                                                $selected = $customer_currency;

                                            } else {

                                                if ($currency['isdefault'] == 1) {

                                                    $selected = $currency['id'];

                                                }

                                            }

                                            $s_attrs['disabled'] = true;

                                        } else {

                                            if ($currency['isdefault'] == 1) {

                                                $selected = $currency['id'];

                                            }

                                        }

                                    }

                                }

                                ?>

                                <!--<div class="row">

                                    <div class="col-md-6">

                                        <?php

                                        echo render_select('currency', $currencies, array('id', 'name', 'symbol'), 'proposal_currency', $selected, do_action('proposal_currency_disabled', $s_attrs));

                                        ?>

                                    </div>

                                    <div class="col-md-6">

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

                                </div>-->

                                <?php $fc_rel_id = (isset($proposal) ? $proposal->id : false); ?>

                                <?php echo render_custom_fields('proposal', $fc_rel_id); ?>

                                <input id="check_gst" type='hidden' value="<?php if(isset($proposal->is_gst)){if ($proposal->is_gst == 1){echo'1';}else{echo'0';}}else{if($clientsate == get_staff_state()){echo'1';}else{echo'0';}} ?>">

                                <div class="form-group no-mbot hide">

                                    <label for="tags" class="control-label"><i class="fa fa-tag" aria-hidden="true"></i> <?php echo _l('tags'); ?></label>

                                    <input type="text" class="tagsinput" id="tags" name="tags" value="<?php echo (isset($proposal) ? prep_tags_input(get_tags_in($proposal->id, 'proposal')) : ''); ?>" data-role="tagsinput">

                                </div>


                                <div class="form-group">

                                    <label for="enquiry_date" class="control-label">Other Charges Tax Type</label>

                                    <select class="form-control selectpicker" data-live-search="true" id="other_charges_tax" name="other_charges_tax">

                                        <option value="2" <?php echo (!empty($proposal->other_charges_tax) && $proposal->other_charges_tax == 2) ? 'selected' : '' ; ?> >Excluding Tax</option>
                                        <option value="1" <?php echo (!empty($proposal->other_charges_tax) && $proposal->other_charges_tax == 1) ? 'selected' : '' ; ?> >Including Tax</option>

                                    </select>

                                </div>

                                <div class="row">

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="measurement" class="control-label">Measurement</label>
                                            <select class="form-control selectpicker" required="" data-live-search="true" id="measurement" name="measurement">
                                                <option value="1" <?php echo (!empty($proposal->measurement) && $proposal->measurement == 1) ? 'selected' : '' ; ?> >Pcs</option>
                                                <option value="2" <?php echo (!empty($proposal->measurement) && $proposal->measurement == 2) ? 'selected' : '' ; ?> >Kgs</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="proposal_for" class="control-label">Proposal For</label>
                                            <select class="form-control selectpicker" required="" data-live-search="true" id="proposal_for" name="proposal_for">
                                                <option value="1" <?php echo (!empty($proposal->proposal_for) && $proposal->proposal_for == 1) ? 'selected' : '' ; ?> >Domestic</option>
                                                <option value="2" <?php echo (!empty($proposal->proposal_for) && $proposal->proposal_for == 2) ? 'selected' : '' ; ?> >Export</option>
                                            </select>
                                        </div>
                                    </div>


                                </div>

                                <!-- <div class="form-group mtop10 no-mbot">

                                    <p><?php echo _l('proposal_allow_comments'); ?></p>

                                    <div class="onoffswitch">

                                        <input type="checkbox" id="allow_comments" class="onoffswitch-checkbox" <?php

                                        if (isset($proposal)) {

                                            if ($proposal->allow_comments == 1) {

                                                echo 'checked';

                                            }

                                        };

                                        ?> value="on" name="allow_comments">

                                        <label class="onoffswitch-label" for="allow_comments" data-toggle="tooltip" title="<?php echo _l('proposal_allow_comments_help'); ?>"></label>

                                    </div>

                                </div> -->



                            </div>

                            <div class="col-md-6">

                                <div class="row">

                                    <div class="col-md-6">

                                        <div class="form-group select-placeholder">

                                            <label for="status" class="control-label"><?php echo _l('proposal_status'); ?></label>

                                            <?php

                                            $disabled = '';

                                            if (isset($proposal)) {

                                                if ($proposal->estimate_id != NULL || $proposal->invoice_id != NULL) {

                                                    $disabled = 'disabled';

                                                }

                                            }

                                            ?>

                                            <select name="status" class="selectpicker" data-width="100%" <?php echo $disabled; ?> data-none-selected-text="<?php echo _l('dropdown_non_selected_tex'); ?>">

                                                <?php foreach ($statuses as $status) { ?>

                                                    <option value="<?php echo $status; ?>" <?php

                                                    if ((isset($proposal) && $proposal->status == $status) || (!isset($proposal) && $status == 0)) {

                                                        echo 'selected';

                                                    }elseif($status == 4){
                                                        echo 'selected';
                                                    }

                                                    ?>><?php echo format_proposal_status($status, '', false); ?></option>

                                                        <?php } ?>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">
                                    <label for="city_id" class="control-label"><?php echo _l('proposal_assigned'); ?></label>
                                    <select onchange="staffdropdown()" class="form-control selectpicker" data-live-search="true" id="assign" name="assign" required="">
                                        <option>Select</option>
                                        <?php
                                        if (isset($group_info) && count($group_info) > 0) {
                                            $group_id = "";
                                            if ($_GET["rel_type"] == "proposal" && $rel_id != ""){
                                                $group_id = value_by_id_empty("tblleads", $rel_id, "group_id");
                                            }else{
                                                $group_id = (isset($proposal)) ? $proposal->group_id : 0;
                                            }
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
<!--                                    <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assignid[]" required="">

                                        <option>Select</option>
                                        <?php
                                        if (isset($allStaffdata) && count($allStaffdata) > 0) {

                                            foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                ?>

                                                <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">

                                                    <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>

                                                    <?php
                                                    foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                        ?>

                                                        <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                echo'selected';
                                            } ?>><?php echo $singstaff['firstname'] ?></option>

                                                        <?php }
                                                    ?>

                                                </optgroup>

                                                        <?php
                                                    }
                                                }
                                                ?>
                                    </select>-->



                                    </div>

                                </div>

                                <?php $value = (isset($proposal) ? $proposal->proposal_to : ''); ?>

                                <?php echo render_input('proposal_to', 'proposal_to', $value); ?>

                                <?php $value = (isset($proposal) ? $proposal->address : ''); ?>

                                <?php echo render_textarea('address', 'proposal_address', $value); ?>

                                <div class="row">

                                    <div class="col-md-6">



                                        <div class="form-group">

                                            <label for="city_id" class="control-label"><?php echo _l('site_city'); ?></label>

                                            <select class="form-control selectpicker" id="city" name="city" data-live-search="true">

                                                <option value=""></option>

                                                <?php

                                                if (isset($all_city_data) && count($all_city_data) > 0) {

                                                    foreach ($all_city_data as $city_key => $city_value) {

                                                        ?>

                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($proposal->city) && $proposal->city == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>

                                                        <?php

                                                    }

                                                } else if (isset($lead['city']) & $lead['city'] != '') {

                                                    foreach ($allcity as $city_key => $city_value) {

                                                        ?>

                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($lead['city']) && $lead['city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>

                                                        <?php

                                                    }

                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>

                                    <div class="col-md-6">

                                        <div class="form-group">

                                            <label for="state_id" class="control-label"><?php echo _l('billing_state'); ?></label>

                                            <select class="form-control selectpicker" id="state" name="state" onchange="get_city_by_stateid(this.value)" data-live-search="true">

                                                <option value=""></option>

                                                <?php

                                                if (isset($state_data) && count($state_data) > 0) {

                                                    foreach ($state_data as $state_key => $state_value) {

                                                        ?>

                                                        <option value="<?php echo $state_value['id'] ?>" <?php echo (isset($proposal->state) && $proposal->state == $state_value['id']) ? 'selected' : "" ?>><?php echo cc($state_value['name']); ?></option>

                                                        <?php

                                                    }

                                                }

                                                ?>

                                            </select>

                                        </div>

                                    </div>

                                    <!--<div class="col-md-6">

                                    <?php $countries = get_all_countries(); ?>

                                    <?php $selected = (isset($proposal) ? $proposal->country : ''); ?>

                                    <?php echo render_select('country', $countries, array('country_id', array('short_name'), 'iso2'), 'billing_country', $selected); ?>

                                    </div>-->

                                     <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="tax_type" class="control-label">Tax Type</label>
                                            <select required="" class="form-control selectpicker" id="tax_type" name="tax_type" data-live-search="true">

                                                <option value=""></option>
                                                <option value="1" <?php echo (!empty($proposal->tax_type) && $proposal->tax_type == 1) ? 'selected' : '' ; ?> >CGST+SGST</option>
                                                <option value="2" <?php echo (!empty($proposal->tax_type) && $proposal->tax_type == 2) ? 'selected' : '' ; ?> >IGST</option>

                                            </select>
                                        </div>
                                    </div>


                                    <div class="col-md-6">

                                        <?php $value = (isset($proposal) ? $proposal->zip : ''); ?>

                                        <?php echo render_input('zip', 'billing_zip', $value); ?>

                                    </div>

                                    <div class="col-md-6">

                                        <?php $value = (isset($proposal) ? $proposal->email : ''); ?>

                                        <?php echo render_input('email', 'proposal_email', $value); ?>

                                    </div>

                                    <div class="col-md-6">

                                        <?php $value = (isset($proposal) ? $proposal->phone : ''); ?>

                                        <?php  echo render_input('phone', 'proposal_phone', $value); ?>

                                    </div>

                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="product_type" class="control-label">Product Type</label>
                                            <select required="" class="form-control selectpicker" id="product_type" required="" name="product_type" data-live-search="true">
                                                <option value=""></option>
                                                <?php
                                                    if(isset($product_types_list) && !empty($product_types_list)){
                                                      foreach ($product_types_list as $value) {
                                                         $selectcls =  (!empty($proposal->product_type) && $proposal->product_type == $value->id) ? 'selected' : '';
                                                         echo '<option value="'.$value->id.'" '.$selectcls.'>'.$value->name.'</option>';
                                                      }
                                                    }
                                                ?>
                                                <!-- <option value="1" <?php echo (!empty($proposal->product_type) && $proposal->product_type == 1) ? 'selected' : '' ; ?> >Scaffold</option>
                                                <option value="2" <?php echo (!empty($proposal->product_type) && $proposal->product_type == 2) ? 'selected' : '' ; ?> >Boom Lift</option> -->

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <label for="currency" class="control-label">Currency</label>
                                            <select required="" class="form-control selectpicker" id="currency" required="" name="currency" data-live-search="true">
                                                <option value="0" <?php echo (!empty($proposal->currency) && $proposal->currency == 0) ? 'selected' : '' ; ?> >INR</option>
                                                <option value="1" <?php echo (!empty($proposal->currency) && $proposal->currency == 1) ? 'selected' : '' ; ?> >USD</option>

                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group">
                                            <?php $pdf_line_breakvalue = (isset($proposal) ? $proposal->pdf_line_break : 0); ?>
                                            <?php  echo render_input('pdf_line_break', 'PDF Line Break', $pdf_line_breakvalue); ?>
                                        </div>
                                    </div>
                                </div>

                            </div>

                            <!-- <div class="col-md-6">

                                <div class="form-group">

                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>

                                    <select class="form-control selectpicker warehouse_id" data-live-search="true" id="warehouse_id" multiple name="warehouse_id[]">

                                        <option value=""></option>

                                        <?php

                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {

                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {

                                                ?>

                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($stockdata['warehouse_id']) && $stockdata['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $all_warehouse_value['name'] ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>

                                <span class="warehouseerror" style="padding:2px;color:red;display:none;"> select any warehouse</span>

                            </div>

                            <div class="col-md-6">

                                <div class="form-group">

                                    <label for="service_type" class="control-label"><?php echo _l('stock_service_type'); ?></label>

                                    <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">

                                        <option value=""></option>

                                        <?php

                                        if (isset($service_type) && count($service_type) > 0) {

                                            foreach ($service_type as $service_type_key => $service_type_value)

                                            {?>

                                                <option value="<?php echo $service_type_value['id'] ?>" <?php echo (isset($stockdata['service_type']) && $stockdata['service_type'] == $service_type_value['id']) ? 'selected' : "" ?>><?php echo $service_type_value['name'] ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>

                                <span class="servicetypeerror" style="padding:2px;color:red;display:none;"> select any service type</span>

                            </div> -->

                                <!-- <button class="btn btn-success check_availability" type="button" style="float:right;">

                                    <?php echo _l('check_availability'); ?>

                                </button> -->



                        </div>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">

                            <p class="no-mbot pull-left mtop5 btn-toolbar-notice"><?php echo _l('include_proposal_items_merge_field_help', '<b>{proposal_items}</b>'); ?></p>



                            <!--<button class="btn btn-info mleft5 proposal-form-submit transaction-submit generate_chalan" onclick="createtask('stockavdv')" type="submit">

                               <?php echo _l('generate_chalan'); ?>

                            </button>-->

                            <!-- <button class="btn btn-info mleft5 proposal-form-submit transaction-submit" type="submit">

                                <?php echo _l('send_for_approval'); ?>

                            </button> -->
                            <a href="javascript:void(0);" class="btn btn-info mleft5 proposal-form-submit transaction-submit">
                                <?php echo _l('send_for_approval'); ?>
                            </a>
                            <?php
                                $chk_parmission = get_staff_info(get_staff_user_id())->createdirectquote;
                                if ($chk_parmission > 0){
                            ?>
                            <!-- <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                <?php echo _l('submit'); ?>
                            </button> -->
                            <a href="javascript:void(0);" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                Direct Approve
                            </a>
                                <?php } ?>

                        </div>

                    </div>

                </div>

            </div>




            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">
                        
                        <div <?php if(empty($lead_prod_rent_det)  && empty($rent_prolist)){ echo 'hidden'; } ?> id="for_rent">


                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_rent'); ?></h4>

                                <hr/>

                            </div>


                            <input type="hidden" id="clientid" value="<?php echo $client_id; ?>">


                            <div class="col-md-12">

                                <div style="overflow-x:auto !important;">

                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:2500px !important;">

                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop renttable">

                                            <thead>

                                                <tr>

                                                    <td style="width: 10px !important;"><i class="fa fa-cog"></i></td>

                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>

                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>

                                                    <td style="width: 130px !important;"><?php echo _l('prop_pro_id'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo "Unit"; ?></td>

                                                    <td style="width: 70px !important;"><?php echo 'SAC Code'; ?></td>

                                                    <td style="width: 70px !important;"><?php echo 'Weight'; ?></td>

                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_qty'); ?></td>

                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_months'); ?></td>

                                                    <td style="width: 70px  !important;"><?php echo _l('prop_pro_days'); ?></td>

                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo 'View Price'; ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>


                                                    <td style="width: 70px !important;">Tax %</td>

                                                    <td style="width: 70px !important;">Tax Amt</td>

                                                    <td style="width: 70px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>

                                                </tr>

                                            </thead>

                                            <tbody>

                                                <input type="hidden" id="rent_company_category" value="1">

                                                <?php

                                                $i = 0;

                                                
                                                if (isset($rent_prolist)) {

                                                     $totprod=count($rent_prolist);?>

                                                <input type="hidden" id="totalrentpro" value="<?php echo count($rent_prolist); ?>">



                                                <?php

                                                foreach ($rent_prolist as $single_prod_rent_det) {

                                                    $i++;

                                                    $proprice = $single_prod_rent_det['rate'];

                                                    $months=$single_prod_rent_det['months']+($single_prod_rent_det['days']/30);

                                                   // $prodprice = $proprice * $single_prod_rent_det['qty']*$months;
                                                    $prodprice = $proprice * $single_prod_rent_det['qty']*$months*$single_prod_rent_det['weight'];

                                                    //$totpro = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);

                                                    $pricelist = array();
                                                    $prodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_rent_det['pro_id'] . "'")->row_array();
                                                    if (isset($prodet['rental_price_cat_a']) && $prodet['rental_price_cat_b'] && $prodet['rental_price_cat_c'] && $prodet['rental_price_cat_d']){
                                                        $pricelist = array($prodet['rental_price_cat_a'], $prodet['rental_price_cat_b'], $prodet['rental_price_cat_c'], $prodet['rental_price_cat_d']);
                                                    }
                                                    
                                                    $min_price = (!empty($pricelist)) ? min($pricelist) : 0;

                                                    $profitper = (!empty($pricelist)) ? (($proprice - $min_price) / $min_price) * 100 : 0;

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


                                                    //New Logic

                                                    $rnt_dis_price = $prodprice - (($prodprice * $single_prod_rent_det['discount']) / 100);

                                                    $totpro = ((($rnt_dis_price * $single_prod_rent_det['prodtax']) / 100) + $rnt_dis_price);

                                                    ?>

                                                    <tr class="trrentpro<?php echo $i; ?>">
                                                        <td>
                                                            <button type="button" class="btn pull-right btn-danger" onclick="removerentpro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
                                                        </td>
                                                        <td>

                                                            <?php
                                                            if($single_prod_rent_det['temp_product'] == 0){
                                                                $pro_id = "PRO-ID".$single_prod_rent_det['pro_id'];
                                                                $link = base_url('admin/product_new/view/'.$single_prod_rent_det['pro_id']);
                                                            }else{
                                                                $pro_id = "TEMP-PRO-ID".$single_prod_rent_det['pro_id'];
                                                                $link = base_url('admin/product_new/temperory_product/'.$single_prod_rent_det['pro_id']);
                                                            }
                                                            ?>
                                                            <a target="_blank" href="<?php echo $link; ?>">
                                                                <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo $single_prod_rent_det['description']; ?>">
                                                            </a>

                                                            <input value="<?php echo $single_prod_rent_det['pro_id']; ?>" name="rentproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $single_prod_rent_det['id']; ?>" name="rentproposal[<?php echo $i; ?>][itemid]" type="hidden">

                                                            <input value="<?php echo $min_price; ?>" id="averageprice<?php echo $i; ?>" type="hidden">

                                                            <input type="hidden" class="form-control" name="rentproposal[<?php echo $i; ?>][temp_product]" value="<?php echo $single_prod_rent_det['temp_product']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_rent_det['long_description']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $pro_id; ?>">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][unit]" readonly="" value="<?php echo get_product_unit($single_prod_rent_det['pro_id'], $single_prod_rent_det['temp_product']); ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo (isset($single_prod_rent_det['sac_code'])) ? $single_prod_rent_det['sac_code'] : ''; ?>">

                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control" id="rentweight_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $single_prod_rent_det['weight']; ?>">
                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['qty']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentmonths_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][months]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="<?php echo $single_prod_rent_det['months']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentdays_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][days]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="<?php echo $single_prod_rent_det['days']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentmainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $proprice; ?>" name="rentproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="rentviewprice_<?php echo $i; ?>" value="<?php echo $single_prod_rent_det['rate_view']; ?>" name="rentproposal[<?php echo $i; ?>][price_view]">
                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="rentprice_<?php echo $i; ?>" value="<?php echo $prodprice; ?>" id="total_price1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentdisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="<?php echo $single_prod_rent_det['discount']; ?>" name="rentproposal[<?php echo $i; ?>][discount]" id="discount_percentage">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" id="rentdisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodprice * $single_prod_rent_det['discount']) / 100); ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="rentdisc_price_<?php echo $i; ?>" value="<?php echo $rnt_dis_price; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="rentprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">

                                                        </td>



                                                        <td>
                                                            <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="0">

                                                            <input readonly="" type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][prodtax]" id="renttax_<?php echo $i; ?>" value="<?php echo $single_prod_rent_det['prodtax']; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="renttax_amt_<?php echo $i; ?>" value="<?php echo (($rnt_dis_price * $single_prod_rent_det['prodtax']) / 100); ?>" id="total_price1">

                                                        </td>

                                                        <td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_<?php echo $i; ?>">

                                                            <?php echo round($totpro, 0); ?>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                }

                                            } else {$totprod=count($lead_prod_rent_det);

                                                ?>

                                                <input type="hidden" id="totalrentpro" value="<?php echo count($lead_prod_rent_det); ?>">

                                                <input type="hidden" id="rent_company_category" value="<?php echo (isset($lead_prod_rent_det[0]['company_category'])) ? $lead_prod_rent_det[0]['company_category'] : ''; ?>">

                                                <?php

                                                foreach ($lead_prod_rent_det as $single_prod_rent_det) {

                                                    $i++;
                                                    $min_price = 0;
                                                    $color = '';
                                                    $profitper = 0;
                                                    /*if ($single_prod_rent_det['company_category'] == 1) {

                                                        $proprice = $single_prod_rent_det['rental_price_cat_a'];

                                                    } else if ($single_prod_rent_det['company_category'] == 2) {

                                                        $proprice = $single_prod_rent_det['rental_price_cat_b'];

                                                    } else if ($single_prod_rent_det['company_category'] == 3) {

                                                        $proprice = $single_prod_rent_det['rental_price_cat_c'];

                                                    } else if ($single_prod_rent_det['company_category'] == 4) {

                                                        $proprice = $single_prod_rent_det['rental_price_cat_d'];

                                                    }



                                                    $pricelist = array($single_prod_rent_det['rental_price_cat_a'], $single_prod_rent_det['rental_price_cat_b'], $single_prod_rent_det['rental_price_cat_c'], $single_prod_rent_det['rental_price_cat_d']);

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

                                                    }*/

                                                    ?>

                                                    <tr class="trrentpro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removerentpro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>
                                                            <?php
                                                            if($single_prod_rent_det['temp_product'] == 0){

                                                                $pro_id = "PRO-ID".$single_prod_rent_det['product_id'];
                                                                $proprice = value_by_id('tblproducts',$single_prod_rent_det['product_id'],'price');
                                                                $sac_code = get_sac_code($single_prod_rent_det['product_id']);
                                                                ?>
                                                                <a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$single_prod_rent_det['product_id']); ?>">
                                                                    <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo get_product_name($single_prod_rent_det['product_id']); ?>">
                                                                </a>
                                                                <?php
                                                            }else{
                                                                $pro_id = "TEMP-PRO-ID".$single_prod_rent_det['product_id'];
                                                                $proprice = value_by_id('tbltemperoryproduct',$single_prod_rent_det['product_id'],'price');
                                                                $sac_code = value_by_id('tbltemperoryproduct',$single_prod_rent_det['product_id'],'sac');
                                                                ?>
                                                                <a target="_blank" href="<?php echo base_url('admin/product_new/temperory_product/'.$single_prod_rent_det['product_id']); ?>">
                                                                    <input class="form-control" type="text" name="rentproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo value_by_id('tbltemperoryproduct',$single_prod_rent_det['product_id'],'product_name'); ?>">
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>


                                                            <input value="<?php echo $single_prod_rent_det['product_id']; ?>" name="rentproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $min_price; ?>" id="averageprice<?php echo $i; ?>" type="hidden">

                                                            <input type="hidden" class="form-control" name="rentproposal[<?php echo $i; ?>][temp_product]" value="<?php echo $single_prod_rent_det['temp_product']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_rent_det['product_remarks']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $pro_id; ?>">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][unit]" readonly="" value="<?php echo get_product_unit($single_prod_rent_det['product_id'], $single_prod_rent_det['temp_product']); ?>">

                                                        </td>
                                                        <td>

                                                            <input type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $sac_code; ?>">

                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control" id="rentweight_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="1">
                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentqty_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="1" value="1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentmonths_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][months]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentdays_<?php echo $i; ?>" name="rentproposal[<?php echo $i; ?>][days]" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" min="0" value="0">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentmainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)" value="<?php echo $proprice; ?>" name="rentproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>
                                                            <input type="number" class="form-control" id="rentviewprice_<?php echo $i; ?>" value="<?php //echo $single_prod_rent_det['rate_view']; ?>" name="rentproposal[<?php echo $i; ?>][price_view]">
                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="rentprice_<?php echo $i; ?>" value="<?php echo $proprice * 1; ?>" id="total_price1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="rentdisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_rent(<?php echo $i; ?>)"  value="" name="rentproposal[<?php echo $i; ?>][discount]" id="discount_percentage">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" id="rentdisc_amt_<?php echo $i; ?>" class="form-control" value="0.00">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="rentdisc_price_<?php echo $i; ?>" value="<?php echo $proprice * 1; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="rentprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">

                                                        </td>

                                                         <td>

                                                            <input type="hidden" name="rentproposal[<?php echo $i; ?>][isgst]" value="0">

                                                            <input readonly="" type="text" class="form-control" name="rentproposal[<?php echo $i; ?>][prodtax]" id="renttax_<?php echo $i; ?>" value="<?php echo getProductTax($single_prod_rent_det['product_id']); ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="renttax_amt_<?php echo $i; ?>" value="<?php echo (($proprice * 18) / 100); ?>" id="total_price1">

                                                        </td>

                                                        <td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_<?php echo $i; ?>">

                                                            <?php //echo ($proprice+(($proprice*18)/100)); ?>

                                                            <?php echo ($proprice); ?>

                                                        </td>

                                                    </tr>

                                                    <?php

                                                }

                                            }

                                            ?>

                                            </tbody>

                                        </table>

                                        <div class="col-xs-12" style="margin-top: 40px;">

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

                                        <input type="number" class="form-control rent_discount_percentage" value="<?php echo (isset($proposal) && $proposal->rent_discount_percent != '') ? $proposal->rent_discount_percent : ""; ?>" onchange="get_total_disc_rent()" name="rentproposal[finaldiscountpercentage]" id="rent_discount_percentage">

                                        <div class="sale_discount_percentageError error_msg"></div>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>

                                        <input readonly="" type="text" class="form-control rent_discount_amt" value="<?php echo (isset($proposal) && $proposal->rent_discount_total != '') ? $proposal->rent_discount_total : ""; ?>" name="rentproposal[finaldiscountamount]" id="rent_discount_amt">

                                        <div class="sale_discount_amtError error_msg"></div>

                                    </div>

                                    <div class="col-md-3">

                                        <label class="control-label">Total Quotation Amount <span style="color:red">*</span></label>

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

                                        <th width="10%" align="left"><?php echo _l('amt'); ?>   </th>

                                        <th width="20%" align="left">Tax</th>

                                        <th width="10%" align="left">Tax Amount </th>

                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>  </th>

                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>

                                    </tr>

                                </thead>

                                <tbody class="ui-sortable">

                                    <?php

                                    if (isset($rent_othercharges) && count($rent_othercharges) > 0) {

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

                                    } else {?>

                                        <tr id="tr0">

                                            <td>

                                                <div class="form-group">

                                                    <select class="form-control selectpicker" data-live-search="true" id="othercharges0" onchange="otherchargesdata(0)" name="othercharges[0][category_name]">

                                                        <option value=""></option>

                                                        <?php

                                                        if (isset($othercharges) && count($othercharges) > 0) {

                                                            foreach ($othercharges as $othercharges_key => $othercharges_value) {?>

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

                                                    <input type="number" id="amount0" name="othercharges[0][amount]" onchange="getothercharges(0)" class="form-control" >

                                                </div>

                                            </td>


                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="igst0" value="0" name="othercharges[0][igst]" onchange="getothercharges(0)" class="form-control" >

                                                </div>

                                            </td>

                                            <td>

                                                <div class="form-group">

                                                    <input type="number" id="gst_sgst_amt0" name="othercharges[0][gst_sgst_amt]" class="form-control">

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

                                    <?php }

                                    ?>

                                </tbody>

                            </table>

                            <div class="col-xs-4">

                                <label class="label-control subHeads"><a  class="addmore" value="<?php echo (isset($rent_othercharges)) ? count($rent_othercharges) : '0'; ?>">Add More <i class="fa fa-plus"></i></a></label>

                            </div>

                            <div class="col-xs-8">

                                <label style="float : right !important;">

                                    <strong style="font-size:14px;">Other Charges Sub Total For Rent :-</strong>

                                    <strong class="rent_other_charges_subtotal">0</strong>

                                </label>

                            </div>

                        </div>





                        </div>








                        <div <?php if(empty($lead_prod_sale_det) && empty($sale_prolist)){ echo 'hidden'; } ?>  id="for_sale">

                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3"><?php echo _l('proposal_for_sale'); ?></h4>

                                <hr/>

                            </div>

                            <div class="col-md-12">

                                <div style="overflow-x:auto !important;">

                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:2500px !important;">

                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">

                                            <thead>

                                                <tr>

                                                    <td style="width: 10px !important;"><i class="fa fa-cog"></i></td>

                                                    <td style="width: 200px !important;"><?php echo _l('prop_pro_name'); ?></td>

                                                    <td style="width: 100px !important;"><?php echo _l('prop_pro_remark'); ?></td>

                                                    <td style="width: 130px !important;"><?php echo _l('prop_pro_id'); ?></td>

                                                    <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>

                                                    <td style="width: 35px !important;">Weight</td>

                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>

                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc'); ?>%</td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_amt'); ?></td>

                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_disc_price'); ?></td>

                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_profit_margin'); ?>%</td>


                                                    <td style="width: 47px !important;">Tax %</td>

                                                    <td style="width: 47px !important;">Tax Amt</td>

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

                                                    //$prodproposalprice = $prosaleprice * $single_prod_sale_det['qty'];
                                                    $prodproposalprice = $prosaleprice * $single_prod_sale_det['qty'] * $single_prod_sale_det['weight'];

                                                    //$totproamt=$prodproposalprice-(($prodproposalprice*$single_prod_sale_det['discount'])/100)+(($prodproposalprice*18)/100);

                                                   // $totproamt = $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100);

                                                    $i++;
                                                    $salepricelist = array();
                                                    $saleprodet = $this->db->query("SELECT * FROM `tblproducts` WHERE `id`='" . $single_prod_sale_det['pro_id'] . "'")->row_array();
                                                    if (isset($saleprodet['sale_price_cat_a']) || isset($saleprodet['sale_price_cat_b']) || isset($saleprodet['sale_price_cat_c']) || isset($saleprodet['sale_price_cat_d'])){
                                                        $salepricelist = array($saleprodet['sale_price_cat_a'], $saleprodet['sale_price_cat_b'], $saleprodet['sale_price_cat_c'], $saleprodet['sale_price_cat_d']);
                                                    }
                                                    

                                                    $min_saleprice = (!empty($salepricelist)) ? min($salepricelist) : 0;

                                                    $min_salepricee[] = $min_saleprice;

                                                    $profitper = ($min_saleprice > 0) ? (($prosaleprice - $min_saleprice) / $min_saleprice) * 100 : 0;

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


                                                    //New Logic

                                                    $sale_dis_price = $prodproposalprice - (($prodproposalprice * $single_prod_sale_det['discount']) / 100);

                                                    $totproamt = ((($sale_dis_price * $single_prod_sale_det['prodtax']) / 100) + $sale_dis_price);

                                                    ?>

                                                    <tr class="trsalepro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>
                                                            <?php
                                                                if($single_prod_sale_det['temp_product'] == 0){
                                                                    $pro_id = "PRO-ID".$single_prod_sale_det['pro_id'];
                                                                    $link = base_url('admin/product_new/view/'.$single_prod_sale_det['pro_id']);
                                                                }else{
                                                                    $pro_id = "TEM-PRO-ID".$single_prod_sale_det['pro_id'];
                                                                    $link = base_url('admin/product_new/temperory_product/'.$single_prod_sale_det['pro_id']);
                                                                }
                                                            ?>
                                                            <a target="_blank" href="<?php echo $link; ?>">

                                                                <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['description']; ?>">

                                                            </a>

                                                            <input value="<?php echo $single_prod_sale_det['pro_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">

                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">

                                                            <input type="hidden" class="form-control" name="saleproposal[<?php echo $i; ?>][temp_product]" value="<?php echo $single_prod_sale_det['temp_product']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['long_description']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $pro_id; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $single_prod_sale_det['hsn_code']; ?>">

                                                        </td>

                                                        <td>
                                                            <input type="text" class="form-control" id="saleweight_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['weight']; ?>">
                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * $single_prod_sale_det['qty']; ?>" id="total_price1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['discount']; ?>" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" id="saledisc_amt_<?php echo $i; ?>" class="form-control" value="<?php echo (($prodproposalprice * $single_prod_sale_det['discount']) / 100); ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saledisc_price_<?php echo $i; ?>" value="<?php echo $sale_dis_price; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control <?php echo $color; ?>" id="saleprofit_amt<?php echo $i; ?>" value="<?php echo $profitper; ?>">

                                                        </td>


                                                        <td>

                                                            <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">

                                                            <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saletax_<?php echo $i; ?>" value="<?php echo $single_prod_sale_det['prodtax']; ?>">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" value="<?php echo (($sale_dis_price * $single_prod_sale_det['prodtax']) / 100); ?>" id="total_price1">

                                                        </td>

                                                        <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">

                                                            <?php echo round($totproamt, 0); ?>

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
                                                    $min_saleprice = 0;


                                                    /*if ($single_prod_sale_det['company_category'] == 1) {

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

                                                    }*/

                                                    ?>

                                                    <tr class="trsalepro<?php echo $i; ?>">

                                                        <td>

                                                            <button type="button" class="btn pull-right btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>

                                                        </td>

                                                        <td>

                                                            <a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$single_prod_sale_det['product_id']); ?>">


                                                            </a>

                                                            <?php
                                                            if($single_prod_sale_det['temp_product'] == 0){
                                                                $pro_id = "PRO-ID".$single_prod_sale_det['product_id'];
                                                                $prosaleprice = value_by_id('tblproducts',$single_prod_sale_det['product_id'],'price');
                                                                $hsn_code = get_hsn_code($single_prod_sale_det['product_id']);
                                                                ?>
                                                                <a target="_blank" href="<?php echo base_url('admin/product_new/view/'.$single_prod_sale_det['product_id']); ?>">
                                                                    <input class="form-control" type="text" name="saleproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo get_product_name($single_prod_sale_det['product_id']); ?>">
                                                                </a>
                                                                <?php
                                                            }else{
                                                                $pro_id = "TEM-PRO-ID".$single_prod_sale_det['product_id'];
                                                                $prosaleprice = value_by_id('tbltemperoryproduct',$single_prod_sale_det['product_id'],'price');
                                                                $hsn_code = value_by_id('tbltemperoryproduct',$single_prod_sale_det['product_id'],'hsn');

                                                                ?>
                                                                <a target="_blank" href="<?php echo base_url('admin/product_new/temperory_product/'.$single_prod_sale_det['product_id']); ?>">
                                                                    <input class="form-control" type="text" name="saleproposal[<?php echo $i; ?>][product_name]" readonly="" style="cursor: pointer !important;" value="<?php echo value_by_id('tbltemperoryproduct',$single_prod_sale_det['product_id'],'product_name'); ?>">
                                                                </a>
                                                                <?php
                                                            }
                                                            ?>

                                                            <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">

                                                            <input value="<?php echo $min_saleprice; ?>" id="averagesaleprice<?php echo $i; ?>" type="hidden">

                                                            <input type="hidden" class="form-control" name="saleproposal[<?php echo $i; ?>][temp_product]" value="<?php echo $single_prod_sale_det['temp_product']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][remark]" value="<?php echo $single_prod_sale_det['product_remarks']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $pro_id; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $hsn_code; ?>">

                                                        </td>


                                                        <td>
                                                            <input type="text" class="form-control" id="saleweight_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][weight]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="1">
                                                        </td>



                                                        <td>

                                                            <input type="number" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $prosaleprice; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

                                                        </td>

                                                        <td>

                                                            <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" value="<?php echo $prosaleprice * 1; ?>" id="total_price1">

                                                        </td>

                                                        <td>

                                                            <input type="number" class="form-control" id="saledisc_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="" name="saleproposal[<?php echo $i; ?>][discount]" id="discount_percentage">

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


                                                        <td>
                                                            <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">

                                                            <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saletax_<?php echo $i; ?>" value="<?php echo getProductTax($single_prod_sale_det['product_id']); ?>">
                                                        </td>

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

                                        <div class="col-xs-12" style="margin-top: 40px;">

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

                                        <label class="control-label">Total Quotation Amount <span style="color:red">*</span></label>

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

                                        <th width="10%" align="left"><?php echo _l('amt'); ?>   </th>

                                        <th width="20%" align="left">Tax</th>

                                        <th width="10%" align="left">Tax Amount </th>

                                        <th width="15%" align="left"><?php echo _l('total_amount'); ?>  </th>

                                        <th width="5%"  align="center"><i class="fa fa-cog"></i></th>

                                    </tr>

                                </thead>

                                <tbody class="ui-sortable">

                                    <?php

                                    if (isset($sale_othercharges) && count($sale_othercharges) > 0) {

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

                                                                    ?> ><?php echo cc($othercharges_value['category_name']); ?></option>

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

                                                        <input type="number" id="sale_amount<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" value="<?php echo $singlesaleothercharges['amount']; ?>" name="saleothercharges[<?php echo $l; ?>][amount]" class="form-control" >

                                                    </div>

                                                </td>


                                                 <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_igst<?php echo $l; ?>" onchange="getothersalecharges('<?php echo $l; ?>')" name="saleothercharges[<?php echo $l; ?>][igst]" value="<?php echo $singlesaleothercharges['igst']; ?>" class="form-control" >

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_gst_sgst_amt<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][gst_sgst_amt]" value="<?php echo $singlesaleothercharges['gst_sgst_amt']; ?>" class="form-control">

                                                    </div>

                                                </td>

                                                <td>

                                                    <div class="form-group">

                                                        <input type="number" id="sale_total_maount<?php echo $l; ?>" name="saleothercharges[<?php echo $l; ?>][total_maount]" value="<?php echo $singlesaleothercharges['total_maount']; ?>" class="form-control">

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

                                                                <option value="<?php echo $othercharges_value['id'] ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option>

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

                                                    <input type="number" id="sale_amount0" onchange="getothersalecharges(0)" name="saleothercharges[0][amount]" class="form-control" >

                                                </div>

                                            </td>



                                            <td>
                                                <div class="form-group">

                                                    <input type="number" id="sale_igst0" onchange="getothersalecharges(0)" name="saleothercharges[0][igst]" class="form-control" >

                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">

                                                    <input type="number" id="sale_gst_sgst_amt0" name="saleothercharges[0][gst_sgst_amt]" class="form-control">

                                                </div>
                                            </td>

                                            <td>
                                                <div class="form-group">

                                                    <input type="number" id="sale_total_maount0" name="saleothercharges[0][total_maount]" class="form-control">

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
                                <label class="label-control subHeads"><a  class="addsalemore" value="<?php echo (isset($sale_othercharges)) ? count($sale_othercharges) : 0 ; ?>">Add More <i class="fa fa-plus"></i></a></label>
                            </div>

                            <div class="col-xs-8">

                                <label style="float : right !important;">

                                    <strong style="font-size:14px;">Other Charges Sub Total For Sale :-</strong>

                                    <strong class="sale_other_charges_subtotal">0</strong>

                                </label>

                            </div>

                        </div>



                        </div>


                        <div class="col-md-12" style="margin-top:4%">

                            <h4 class="no-mtop mrg3">Prodcut Fields for Quotation</h4>

                            <hr>

                        </div>

                        <?php $default_setting_field=explode(',',$default_setting_field[0]); ?>


                        <?php
                        if(!empty($productfield_info)){
                            ?>
                            <div class="col-md-12" style="overflow-x:auto !important;">
                                    <?php
                                    foreach ($productfield_info as $field) {
                                    ?>
                                    <div class="checkbox col-md-2" style="margin-top: 0; margin-bottom: 15px;">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array($field->id, $proposalfields)){echo"checked=checked";}}  ?> value="<?php echo $field->id; ?>">
                                        <label><?php echo $field->name; ?></label>

                                    </div>
                                    <?php
                                    }
                                    ?>
                            </div>
                            <hr>
                            <?php
                        }
                        ?>
                        <hr>

                        <!-- <div class="col-md-12">

                            <div style="overflow-x:auto !important;">

                                <div class="col-md-3">

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('name', $proposalfields)){echo"checked=checked";}}  ?> value="name">

                                        <label>Product Name</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('sac_code', $proposalfields)) echo"checked=checked";} ?> value="sac_code">

                                        <label>SAC Code</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('hsn_code', $proposalfields)) echo"checked=checked";} ?> value="hsn_code">

                                        <label>HSN Code</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('working_height', $proposalfields)) echo"checked=checked";} ?> value="working_height">

                                        <label>Working Height</label>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('tower_height', $proposalfields)) echo"checked=checked";} /*else if(isset($default_setting_field)){if(in_array('Tower Height', $default_setting_field)){echo"checked=checked";}}*/ ?> value="tower_height">

                                        <label>Tower Height</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('platform_height', $proposalfields)) echo"checked=checked";} ?> value="platform_height">

                                        <label>Platform Height</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('dimensions', $proposalfields)) echo"checked=checked";} ?> value="dimensions">

                                        <label>Dimention</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('photo', $proposalfields)) echo"checked=checked";} ?> value="photo">

                                        <label>photo</label>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('purchase_price', $proposalfields)) echo"checked=checked";} ?> value="purchase_price">

                                        <label>Purchase price</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('product_weight', $proposalfields)) echo"checked=checked";} ?> value="product_weight">

                                        <label>Product Weight</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('product_remarks', $proposalfields)) echo"checked=checked";} ?> value="product_remarks">

                                        <label>Product Remarks</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('product_description', $proposalfields)) echo"checked=checked";} ?> value="product_description">

                                        <label>Product Description</label>

                                    </div>

                                </div>

                                <div class="col-md-3">

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('damage_rate', $proposalfields)) echo"checked=checked";} ?> value="damage_rate">

                                        <label>Damage Rate</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('lost_rate', $proposalfields)) echo"checked=checked";} ?> value="lost_rate">

                                        <label>Lost Rate</label>

                                    </div>

                                    <div class="checkbox">

                                        <input type="checkbox" name="productfields[]" <?php if(isset($proposalfields)){if(in_array('repairable_rate', $proposalfields)) echo"checked=checked";} ?> value="repairable_rate">

                                        <label>Repairable Rate</label>

                                    </div>

                                </div>

                            </div>

                        </div> -->

                        <div  class="col-md-12" style="margin-top: 15px;">

                            <div class="form-group">
<?php

if(!empty($sale_prolist)){
    $qoute_for = '2';
}else{
   if(!empty($lead_prod_sale_det)){
        $qoute_for = '2';
    }else{
        $qoute_for = '1';
    }
}


?>
  <input type="hidden" id="qoute_for" value="<?php echo $qoute_for; ?>">

                                <!-- <label for="terms_and_conditions" class="control-label" style="font-size:20px;"></label> -->
                                <h4 class="no-mtop mrg3"><?php echo _l('terms_and_conditions'); ?></h4>
                                <hr>
                                <textarea class="form-control tinymce" <?php echo (isset($proposal) && $proposal->terms_and_conditions!='') ? '':'style="display:none;"'; ?> name="terms_and_conditions" id="terms_and_conditions"><?php  echo (isset($proposal) && $proposal->terms_and_conditions!='') ? $proposal->terms_and_conditions : ''; ?></textarea>

                                <div class="termsconditionmaindiv">

                                </div>
                                <?php if(isset($proposal) && !empty($proposal)){
                                    echo '<input type="hidden" class="relsection_id" name="relsection_id" value="'.$proposal->id.'">';
                                } ?>
                            </div>

                            <div class="form-group">
                              <h4 class="no-mtop mrg3">Custom Terms & Conditions</h4>
                              <hr>
                              <!-- <div class="row"> -->
                              <?php
                                  $gettermscondition = $this->db->query("SELECT * FROM `tbltermsandconditions_selection_master` WHERE (`service_type` = '".$qoute_for."' OR `service_type` = '3') and `status` = '1' ORDER BY `order` ASC ")->result();
                                  if (!empty($gettermscondition)){
                                      foreach ($gettermscondition as $k => $value) {
                                         $relid = (isset($proposal) && !empty($proposal)) ? $proposal->id : 0;
                                         $getermscondition = $this->db->query("SELECT * FROM `tbltermsandconditionsdetails` WHERE `master_id`='".$value->id."' AND `rel_id`='".$relid."' AND `document_name`='proposal'")->row();
                                         $checked = '';
                                         if (!empty($getermscondition)){
                                           if ($getermscondition->status == 1){
                                              $checked = 'checked';
                                           }
                                         }else{
                                            $checked = ($relid == 0) ? 'checked':'';
                                         }
                              ?>
                                          <div class="row">
                                              <div class="col-md-6">
                                                  <div class="form-group">
                                                      <label for="title" class="control-label col-md-8"><?php echo ++$k; ?>) <?php echo $value->title; ?>
                                                            <?php
                                                                $disablecls = "";
                                                                if ($value->is_relative == 1){
                                                                  $disablecls = "disabled";
                                                                  $checked = 'checked';
                                                                  echo '<input type="hidden" name="terms['.$k.'][active]" value="on">';
                                                                }
                                                            ?>
                                                            <div class="onoffswitch">
                                                                <input type="checkbox" name="terms[<?php echo $k; ?>][active]" class="onoffswitch-checkbox termsswitch<?php echo $k; ?>" id="<?php echo $k; ?>" data-id="<?php echo $k; ?>" <?php echo $disablecls; ?> <?php echo $checked; ?>>
                                                                <label class="onoffswitch-label" for="<?php echo $k; ?>"></label>
                                                            </div>
                                                      </label>
                                                      <div class="col-md-4">
                                                        <?php if ($value->input_type == "2"){
                                                               $array_val = explode(',',$value->options);
                                                          ?>
                                                             <select class="form-control selectpicker termsconditionfield" data-row="<?php echo $k; ?>" data-title="<?php echo $value->title; ?>" data-id="<?php echo $value->id; ?>" data-live-search="true" data-defaultval="<?php echo trim($value->default_value); ?>" onchange="chkdefaltvalue('<?php echo $value->id; ?>',this.value)" id="svalue<?php echo $value->id; ?>" name="terms[<?php echo $value->id; ?>][value1]">
                                                               <option value=""></option>
                                                               <?php if (!empty($array_val)) {
                                                                   foreach ($array_val as $val) {
                                                                     if (isset($getermscondition) && !empty($getermscondition->value1)){
                                                                       $selectcls = (trim($val) == trim($getermscondition->value1)) ? 'selected="selected"': '';
                                                                     }else{
                                                                       $selectcls = (trim($val) == trim($value->default_value)) ? 'selected="selected"': '';
                                                                     }
                                                                     echo '<option value="'.$val.'" '.$selectcls.'>'.$val.'</option>';
                                                                   }
                                                               }?>
                                                             </select>
                                                        <?php }else{ ?>
                                                             <input type="text" data-title="<?php echo $value->title; ?>" data-row="<?php echo $k; ?>" data-id="<?php echo $value->id; ?>" class="form-control numericOnly termsconditionfield <?php echo ($value->id < 6) ? 'termpercentval': ''; ?>" id="svalue<?php echo $value->id; ?>" value="<?php echo (isset($getermscondition) && !empty($getermscondition->value1)) ? $getermscondition->value1 : ''; ?>" name="terms[<?php echo $value->id; ?>][value1]" placeholder="% Percent">
                                                        <?php } ?>
                                                      </div>
                                                  </div>
                                              </div>
                                              <?php if ($value->is_extra_input == '1'){ ?>
                                                <div class="col-md-4">
                                                    <div class="form-group">
                                                        <label for="title" class="control-label col-md-3"><?php echo $value->extra_input_title; ?></label>
                                                        <div class="col-md-4">
                                                          <input type="text" class="form-control numericOnly" id="evalue<?php echo $value->id; ?>" name="terms[<?php echo $value->id; ?>][value2]" value="<?php echo (isset($getermscondition) && !empty($getermscondition->value2)) ? $getermscondition->value2 : ''; ?>">
                                                        </div>
                                                    </div>
                                                </div>
                                              <?php } ?>
                                              <?php if ($value->days_week_selection == '1'){
                                                $selectiontitle = str_replace(",", " / ", $value->days_week_values);
                                                $selectionvalues = explode(',',$value->days_week_values);
                                                ?>
                                              <div class="col-md-4">
                                                  <div class="form-group">
                                                      <label for="title" class="control-label col-md-4"><?php echo $selectiontitle; ?></label>
                                                      <div class="col-md-4">
                                                        <select class="form-control selectpicker" data-live-search="true" id="evalue<?php echo $value->id; ?>" name="terms[<?php echo $value->id; ?>][value2]">
                                                          <?php foreach ($selectionvalues as $field) {
                                                               $selectfieldcls = (isset($getermscondition) && $getermscondition->value2 == strtolower($field)) ? 'selected=""' : '';
                                                               echo '<option value="'.strtolower($field).'" '.$selectfieldcls.'>'.$field.'</option>';
                                                          }?>
                                                        </select>
                                                      </div>
                                                  </div>
                                              </div>
                                             <?php } ?>
                                           </div>
                                           <br>
                              <?php
                                      }
                                  }
                              ?>
                              <!-- </div> -->
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
<div id="productdetailsmodal" class="modal fade " role="dialog">
    <div class="modal-dialog modal-lg">
        <div class="modal-content producthtml">

        </div>    
    </div>    
</div>
<?php init_tail(); ?>

<script>
    var _rel_type = {val: ''};
    function getproconfirmation(value, el, stype)
    {
        if (stype == 'rent'){
            var prodid=$('#prodid'+value).val();
        }else{
            var prodid=$('#saleprodid'+value).val();
        }
        var is_temp = el.selectedOptions[0].getAttribute('data-is_temp');
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getproductdetails'); ?>",
            data    : {'prodid' : prodid, 'is_temp_product': is_temp},
            success : function(data){
                if(data != ''){
                    $('#productdetailsmodal').modal({
                        show: 'false'
                    });
                    $('.producthtml').html(data);
                    if (stype == 'rent'){
                        $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removerentpro('+value+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
                    }else{
                        $(".productdetailsbtn").html('<button type="button" class="btn btn-default close-model" onclick="removesalepro('+value+');" data-dismiss="modal">Cancel</button><button type="submit" autocomplete="off" data-dismiss="modal" class="btn btn-info">ok</button>');
                    }
                }
            }
        })
    }
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

                    success:function (data, status)

                        {

                            var res=JSON.parse(data);

                            $('#availablestockhtml').val(res.html);

                            $('#availablestockarray').val(res.productdata);

                            $('.modal-body').html(res.html);

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

        var _rel_id = $('#rel_id'),
            _rel_type = $('#rel_type'),
            _rel_id_wrapper = $('#rel_id_wrapper'),
            data = {};

        $('.rel_id_label').html(_rel_type.find('option:selected').text());

        _rel_type.on('change', function () {

            var clonedSelect = _rel_id.html('').clone();

            _rel_id.selectpicker('destroy').remove();

            _rel_id = clonedSelect;

            $('#rel_id_select').append(clonedSelect);

            // proposal_rel_id_select();

            if ($(this).val() != '') {

                _rel_id_wrapper.removeClass('hide');

            } else {

                _rel_id_wrapper.addClass('hide');

            }

            $('.rel_id_label').html(_rel_type.find('option:selected').text());

        });

        // proposal_rel_id_select();

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

                //required: true

            },

            currency: 'required',

        });

    }

    function get_total_price_per_qty_rent(value)

    {

        var price = $('#rentmainprice_' + value).val();
        var qty = $('#rentqty_' + value).val();
        var weight = $('#rentweight_' + value).val();
        var months = $('#rentmonths_' + value).val();
        var days = $('#rentdays_' + value).val();
        var tax = $('#renttax_' + value).val();
        //var totalmonths=(parseInt(months)+(parseInt(days)/30)).toFixed(2);
        var totalmonths=(parseInt(months)+(parseInt(days)/30));

        //var total_price = (price * qty*totalmonths);
        var total_price = (price * qty * weight * totalmonths);
       // var total_price = (price * qty);
        var disc = $('#rentdisc_' + value).val();
        $('#rentprice_' + value).val(total_price);
        var disc_amt = ((total_price * disc) / 100);
        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));
        $('#rentdisc_amt_' + value).val(disc_amt);
        $('#rentdisc_price_' + value).val(disc_price);
        $('#renttax_amt_' + value).val((disc_price * tax) / 100);
        //var disc_price = $('#rentdisc_price_' + value).val();
        var tax_amt = $('#renttax_amt_' + value).val();
        var grand_total=parseInt(disc_price)+parseInt(tax_amt);
        //var grand_total = parseInt(disc_price);
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

        var weight = $('#saleweight_' + value).val();

        var qty = $('#saleqty_' + value).val();

        var tax = $('#saletax_' + value).val();

        //var total_price = (price * qty);
        var total_price = (price * qty * weight);

        var disc = $('#saledisc_' + value).val();

        $('#saleprice_' + value).val(total_price);

        var disc_amt = ((total_price * disc) / 100);

        var disc_price = (parseInt(total_price) - parseInt((total_price * disc) / 100));

        $('#saledisc_amt_' + value).val(disc_amt);

        $('#saledisc_price_' + value).val(disc_price);

        $('#saletax_amt_' + value).val((disc_price * tax) / 100);

        //var disc_price=$('#saledisc_price_'+value).val();

        var tax_amt = $('#saletax_amt_' + value).val();

        //var grand_total = parseInt(disc_price);
        var grand_total=parseInt(disc_price)+parseInt(tax_amt);
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



        $('#myTable tbody').append('<tr id="tr' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="othercharges' + newaddmore + '" onchange="otherchargesdata(' + newaddmore + ')" name="othercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) { ?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php }}?></select></div></td><td><div class="form-group"><input type="text" id="sac_code' + newaddmore + '" name="othercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="amount' + newaddmore + '" name="othercharges[' + newaddmore + '][amount]" onchange="getothercharges('+newaddmore+')" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="igst' + newaddmore + '" onchange="getothercharges('+newaddmore+')" name="othercharges[' + newaddmore + '][igst]" class="form-control" value="0"></div></td><td><div class="form-group"><input type="number" id="gst_sgst_amt' + newaddmore + '" name="othercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="total_maount' + newaddmore + '" name="othercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');

        $('.selectpicker').selectpicker('refresh');

    });



    $('.addmorerentpro').click(function ()

    {
        var addmorerentpro = parseInt($(this).attr('value'));

        var check_gst = parseInt($('#check_gst').val());

        var newaddmorerentpro = addmorerentpro + 1;

        $(this).attr('value', newaddmorerentpro);


        $('.renttable tbody').append('<tr class="trrentpro'+newaddmorerentpro+'"><td><button type="button" class="btn pull-right btn-danger" onclick="removerentpro('+newaddmorerentpro+');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getprodata('+newaddmorerentpro+', this)" data-live-search="true" id="prodid'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_id]"><option value=""></option><?php
        if (isset($product_data) && count($product_data) > 0) {
            foreach ($product_data as $product_key => $product_value) {
                if ($product_value['is_temp'] == 0) {
                    $product_code = product_code($product_value['id']);
                } else {
                    $product_code = temp_product_code($product_value['id']);
                }
                ?><option data-is_temp="<?php echo $product_value['is_temp']; ?>" value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code; ?></option><?php

            }
        }?></select><input class="form-control" type="hidden" id="rentpro_name'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="rentpro_is_temp' + newaddmorerentpro + '" name="rentproposal[' + newaddmorerentpro + '][temp_product]" type="hidden"><input value="" id="renpro_id'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][product_id]" type="hidden"><input value="150" name="rentproposal['+newaddmorerentpro+'][itemid]" type="hidden"><input value="" id="averageprice'+newaddmorerentpro+'" type="hidden"></td><td><input type="text" class="form-control" id="rentpro_remark_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][remark]"></td><td><input type="text" class="form-control" readonly id="rentpro_pro_id_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][pro_id]"></td><td><input type="text" class="form-control" readonly id="rentpro_unit_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][unit]"></td><td><input type="text" id="rentpro_pro_hsncode_'+newaddmorerentpro+'" class="form-control" readonly name="rentproposal['+newaddmorerentpro+'][hsn_code]"></td><td><input type="text" class="form-control" id="rentweight_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][weight]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" value="1"></td><td><input type="number" class="form-control" id="rentqty_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][qty]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="rentmonths_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][months]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')"  value="1"></td><td><input type="number" class="form-control" id="rentdays_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][days]" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" min="0" value="0"></td><td><input type="number" class="form-control" id="rentmainprice_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" name="rentproposal['+newaddmorerentpro+'][price]"></td><td><input type="number" class="form-control" id="rentviewprice_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][price_view]"></td><td><input readonly="" type="text" class="form-control" id="rentprice_'+newaddmorerentpro+'" ></td><td><input type="number" class="form-control" id="rentdisc_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_rent('+newaddmorerentpro+')" value="0" name="rentproposal['+newaddmorerentpro+'][discount]"></td><td><input readonly="" type="text" id="rentdisc_amt_'+newaddmorerentpro+'" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="rentdisc_price_'+newaddmorerentpro+'"></td><td><input readonly="" type="text" class="form-control green" id="rentprofit_amt'+newaddmorerentpro+'" value="20"></td><td><input type="hidden" name="rentproposal['+newaddmorerentpro+'][isgst]" value="0"><input readonly="" id="renttax_'+newaddmorerentpro+'" name="rentproposal['+newaddmorerentpro+'][prodtax]" type="text" class="form-control" value=""></td><td><input readonly="" type="text" class="form-control" id="renttax_amt_'+newaddmorerentpro+'" value=""></td><td class="grandtotal totalamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_'+newaddmorerentpro+'"></td></tr>');

        $('.selectpicker').selectpicker('refresh');

    });

    /* this is old product sales function */
    $('.addmoresalepro').click(function ()
    {

        var addmorerentpro = parseInt($(this).attr('value'));

        var check_gst = parseInt($('#check_gst').val());

        var newaddmorerentpro = addmorerentpro + 1;

        $(this).attr('value', newaddmorerentpro);

        $('.saletable tbody').append('<tr class="trsalepro'+newaddmorerentpro+'"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro('+newaddmorerentpro+');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker" style="display:block !important;" onchange="getsaleprodata('+newaddmorerentpro+', this)" data-live-search="true" id="saleprodid'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_id]"><option value=""></option><?php if (isset($product_data) && count($product_data) > 0) {
            foreach ($product_data as $product_key => $product_value) {
                if ($product_value['is_temp'] == 0) {
                    $product_code = product_code($product_value['id']);
                } else {
                    $product_code = temp_product_code($product_value['id']);
                }
                ?><option data-is_temp="<?php echo $product_value['is_temp']; ?>" value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code; ?></option><?php

            }
        }?></select><input class="form-control" type="hidden" id="salepro_name'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_is_temp' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][temp_product]" type="hidden"><input value="" id="salepro_id'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][product_id]" type="hidden"><input value="" name="saleproposal['+newaddmorerentpro+'][itemid]" type="hidden"><input value="" id="averagesaleprice'+newaddmorerentpro+'" type="hidden"></td><td><input type="text" class="form-control" id="salepro_remark_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][remark]"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][pro_id]"></td><td><input type="text" id="salepro_pro_hsncode_'+newaddmorerentpro+'" class="form-control" readonly name="saleproposal['+newaddmorerentpro+'][hsn_code]"></td><td><input type="text" class="form-control" id="saleweight_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][weight]" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" value="1"></td><td><input type="number" class="form-control" id="saleqty_'+newaddmorerentpro+'" name="saleproposal['+newaddmorerentpro+'][qty]" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" min="1" value="1.00"></td><td><input type="number" class="form-control" id="salemainprice_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" name="saleproposal['+newaddmorerentpro+'][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_'+newaddmorerentpro+'" ></td><td><input type="number" class="form-control" id="saledisc_'+newaddmorerentpro+'" onchange="get_total_price_per_qty_sale('+newaddmorerentpro+')" value="0" name="saleproposal['+newaddmorerentpro+'][discount]"></td><td><input readonly="" type="text" id="saledisc_amt_'+newaddmorerentpro+'" class="form-control" value="0"></td><td><input readonly="" type="text" class="form-control" id="saledisc_price_'+newaddmorerentpro+'"></td><td><input readonly="" type="text" class="form-control green" id="saleprofit_amt'+newaddmorerentpro+'"></td><td><input type="hidden" name="saleproposal['+newaddmorerentpro+'][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal['+newaddmorerentpro+'][prodtax]" id="saletax_'+newaddmorerentpro+'" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_'+newaddmorerentpro+'" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale'+newaddmorerentpro+'"></td></tr>');

        $('.selectpicker').selectpicker('refresh');

    });

    $('.addsalemore').click(function ()

    {

        var addmore = parseInt($(this).attr('value'));

        var newaddmore = addmore + 1;

        $(this).attr('value', newaddmore);



        $('#mysaleTable tbody').append('<tr id="trsale' + newaddmore + '"><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="sale_othercharges' + newaddmore + '" name="saleothercharges[' + newaddmore + '][category_name]"><option value=""></option><?php if (isset($othercharges) && count($othercharges) > 0) { foreach ($othercharges as $othercharges_key => $othercharges_value) {?><option value="<?php echo $othercharges_value['id']; ?>"  ><?php echo cc($othercharges_value['category_name']); ?></option><?php } }?></select></div></td><td><div class="form-group"><input type="text" id="sale_sac_code' + newaddmore + '" name="saleothercharges[' + newaddmore + '][sac_code]" class="form-control" ></div></td><td><div class="form-group"><input type="number" onchange="getothersalecharges('+newaddmore+')" id="sale_amount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][amount]" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_igst' + newaddmore + '" onchange="getothersalecharges('+newaddmore+')" name="saleothercharges[' + newaddmore + '][igst]" value="0" class="form-control" ></div></td><td><div class="form-group"><input type="number" id="sale_gst_sgst_amt' + newaddmore + '" name="saleothercharges[' + newaddmore + '][gst_sgst_amt]" class="form-control"></div></td><td><div class="form-group"><input type="number" id="sale_total_maount' + newaddmore + '" name="saleothercharges[' + newaddmore + '][total_maount]" class="form-control"></div> </td><td><button type="button" class="btn pull-right btn-danger"  onclick="removesaleothercharges(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');

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

                    <?php if((isset($proposal) && $proposal->rel_type == 'proposal') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $rel_id;?>');<?php }?>

                    <?php if ((isset($proposal) && $proposal->rel_type == 'customer') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $rel_id;?>');<?php }?>

                    <?php if(isset($_GET['rel_id'])){?> $("#rel_id").val('<?php echo $_GET['rel_id'];?>');<?php }?>

                    $('.selectpicker').selectpicker('refresh');

                });

    }

     $(function () {

         <?php if(isset($_GET['rel_id'])){?>

         var rel_id= '<?php echo $_GET['rel_id'];?>';

         get_rel_list('proposal');



         $.get(admin_url + 'proposals/get_relation_data_values/' + rel_id + '/proposal', function (response) {



                    $('#tax_type').val(response.tax_type);



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

    function getprodata(value, el)
    {
        var prodid=$('#prodid'+value).val();
        var is_temp = el.selectedOptions[0].getAttribute('data-is_temp');
        var check_gst = parseInt($('#check_gst').val());
        var rent_company_category=$('#rent_company_category').val();
        var url = '<?php echo base_url(); ?>admin/Site_manager/getproddetails';

        $.post(url,
                {

                    prodid: prodid,
                    is_temp_product: is_temp,
                    rent_company_category: rent_company_category,

                },
                function (data, status) {

                    var res=JSON.parse(data);

                    $('#renpro_id'+value).val(prodid);

                    $('#rentpro_remark_'+value).val(res.product_remarks);

                    $('#rentpro_name'+value).val(res.name);

                    $('#rentpro_pro_id_'+value).val(res.pro_id);
                    $('#rentpro_is_temp' + value).val(is_temp);
                    $('#rentpro_unit_'+value).val(res.product_unit);

                    $('#rentpro_pro_hsncode_'+value).val(res.sac_code);

                    $('#averageprice'+value).val(res.min_rentprice);

                    $('#rentmainprice_'+value).val(res.proprice);

                    $('#rentprice_'+value).val(res.proprice);

                    $('#rentdisc_price_'+value).val(res.proprice);

                    $('#renttax_amt_'+value).val(res.gstamt);

                    $('#grand_total_'+value).text(res.proprice);

                    $('#renttax_'+value).val(res.tax);

                    $('.selectpicker').selectpicker('refresh');

                    get_total_price_per_qty_rent(value);

                    /* this is for redirect to product details on next tab */
                    // var reurl = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
                    // if (is_temp == 1){
                    //     var reurl = '<?php echo base_url(); ?>admin/product_new/temperory_product/'+prodid; 
                    // }
                    // window.open(reurl, '_blank');
                    getproconfirmation(value, el, 'rent');    
                });

    }

    function getsaleprodata(value, el)
    {
        var prodid=$('#saleprodid'+value).val();
        var is_temp = el.selectedOptions[0].getAttribute('data-is_temp');
        var check_gst = parseInt($('#check_gst').val());

        var rent_company_category=$('#rent_company_category').val();

        var url = '<?php echo base_url(); ?>admin/Site_manager/getsaleproddetails';

        $.post(url,
                {

                    prodid: prodid,
                    is_temp_product: is_temp,
                    rent_company_category: rent_company_category,

                },
                function (data, status) {

                    var res=JSON.parse(data);

                    $('#salepro_id'+value).val(prodid);

                    $('#salepro_remark_'+value).val(res.product_remarks);

                    $('#salepro_name'+value).val(res.name);

                    $('#salepro_pro_id_'+value).val(res.pro_id);
                    $('#salepro_is_temp' + value).val(is_temp);
                    $('#salepro_pro_hsncode_'+value).val(res.hsn_code);

                    $('#averagesaleprice'+value).val(res.min_rentprice);

                    $('#salemainprice_'+value).val(res.proprice);

                    $('#saleprice_'+value).val(res.proprice);

                    $('#saledisc_price_'+value).val(res.proprice);

                    $('#saletax_amt_'+value).val(res.gstamt);

                    $('#grand_total_sale'+value).text(res.proprice);

                    $('#saletax_'+value).val(res.tax);

                    get_total_price_per_qty_sale(value);

                    $('.selectpicker').selectpicker('refresh');

                    /* this is for redirect to product details on next tab */
                    // var reurl = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
                    // if (is_temp == 1){
                    //     var reurl = '<?php echo base_url(); ?>admin/product_new/temperory_product/'+prodid; 
                    // }
                    // window.open(reurl, '_blank');
                    getproconfirmation(value, el, 'sales');
                });

    }

    

    function generate_chalan() {

        var availablestockhtml=$('#availablestockhtml').val();

        var availablestockarray=$('#availablestockarray').val();

        url = typeof(url) != 'undefined' ? url : admin_url + 'Proposals/chalan';



        requestGet(url).done(function(response) {



        });

    }




  $("#phone").keydown(function(event) {
      k = event.which;
      if ((k >= 96 && k <= 105) || k == 8) {
        if ($(this).val().length == 11) {
          if (k == 8) {
            return true;
          } else {
            event.preventDefault();
            return false;

          }
        }
      } else {
        event.preventDefault();
        return false;
      }

});


$("#zip").keydown(function(event) {
      k = event.which;
      if ((k >= 96 && k <= 105) || k == 8) {
        if ($(this).val().length == 6) {
          if (k == 8) {
            return true;
          } else {
            event.preventDefault();
            return false;

          }
        }
      } else {
        event.preventDefault();
        return false;
      }

});


</script>



<script type="text/javascript">

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

$(document).on('change', '#service_type', function() {
  var service_type = $(this).val();
  if(service_type == 1){
        $("#for_rent").show();
        $("#for_sale").hide();
  }else if(service_type == 2){
        $("#for_sale").show();
        $("#for_rent").hide();
  }
});


$(document).on('change', '#state', function() {
  var state = $(this).val();

  $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/proposals/gettaxtype'); ?>",
        data    : {'state' : state},
        success : function(response){
            if(response != ''){
                 $('#tax_type').val(response);
                 $('.selectpicker').selectpicker('refresh');
            }
        }
    })
});


$(document).ready(function() {
  var relsection_id = $(".relsection_id").val();
  $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/terms_conditions/getTermsConditionsData'); ?>",
        data    : {'slug' : 'proposal','rel_id' : relsection_id},
        success : function(response){
            if(response != ''){
                 $(".termsconditionmaindiv").html(response);
            }
        }
    });
});

$(document).on('change', '#product_type', function() {
  var type = $(this).val();
  var qoute_for = $("#qoute_for").val();

  // $.ajax({
  //       type    : "POST",
  //       url     : "<?php echo site_url('admin/terms_conditions/get_termsandcondition_data'); ?>",
  //       data    : {'slug' : 'quotation','for' : qoute_for,'type' : type},
  //       success : function(response){
  //           if(response != ''){
  //                tinyMCE.activeEditor.setContent(response);
  //           }
  //       }
  //   });
  $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/terms_conditions/getTermsConditionsData'); ?>",
        data    : {'slug' : 'quotation','for' : qoute_for,'type' : type},
        success : function(response){
            if(response != ''){
                 tinymce.activeEditor.execCommand('mceSetContent', false, "");
                 $(".termsconditionmaindiv").html(response);
            }
        }
    });
});

/* this function use for check defult value selection. changed or not */
function chkdefaltvalue(id, val){
    var defult_val = $("#svalue"+id).data("defaultval");
    if (defult_val != val){
        alert("You are changed defult selected value");
    }
}
$(".numericOnly").keypress(function (e) {
    if (String.fromCharCode(e.keyCode).match(/[^0-9]/g)) return false;
});

$(".proposal-form-submit").click(function(){
  var total_percent = 0;
  $(".termsconditionfield").each(function(){
      var pval = $(this).val();

      var pid = $(this).data("id");
      var rowid = $(this).data("row");
      var ptitle = $(this).data("title");
      var days = $("#evalue"+pid).val();
      // var status = $(".termsswitch"+rowid).val();
      var status = $(".termsswitch"+rowid).prop("checked");

      if (status == true){
        if (pval != ''){
          if (typeof(days) !="undefined" && days == ""){
            alert("Please submit "+ ptitle +" days");
            exit;
          }else{
            if (pid < 6){
                total_percent += parseInt(pval);
            }
          }
        }else{
          if (typeof(days) !="undefined" && days != ""){
            alert("Please submit value of "+ ptitle);
            exit;
          }
        }
      }


  });

  if (total_percent != 100){
     alert("Payment Terms should be equel to 100 %.");
     return false;
  }else{
     $("#proposal-form").submit();
  }
});
</script>





</body>

</html>

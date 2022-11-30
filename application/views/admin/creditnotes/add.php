<?php init_head(); ?>
<style>#adminnote{margin: 0px 13.5px 0px 0px;height: 128px;width: 509px;}.error{border:1px solid red !important;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<!-- <input id="check_gst" type='hidden' value="<?php if (isset($invoice->is_gst)) {
    if ($invoice->is_gst == 1) {
        echo'1';
    } else {
        echo'0';
    }
} else {
    if ($clientsate == get_staff_state()) {
        echo'1';
    } else {
        echo'0';
    }
} ?>"> -->
<style>
    
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
<input id="check_gst" type='hidden' value="0">
<div class="modal fade" id="myModal" role="dialog">
    <div class="modal-dialog modal-lg">
<?php echo form_open('admin/Stock/converttask', array('id' => 'stock')); ?>
        <!-- Modal content-->
        <textarea name="availablestockarray" id="availablestockarray" style="display:none;"></textarea>
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo _l('check_availability'); ?></h4>
            </div>
            <div class="modal-body" id="stockavdv">
            </div>
            <div class="modal-footer">
                <!--<button type="submit" class="btn btn-info uploadpdf">Upload</button>-->
                <button type="submit" class="btn btn-info" onclick="createtask('stockavdv')" ><?php echo _l('add_task'); ?></button>
                <button type="button" id="cmd" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>

            <?php
            echo form_open($this->uri->uri_string(), array('id' => 'invoice-form', 'class' => ''));
            if (isset($invoice)) {
                echo form_hidden('isedit');
            }
            ?>
        <div class="row">
            <?php
            if (isset($invoice)) {
                echo form_hidden('isedit', $invoice->id);
            }
            $rel_type = '';
            $rel_id = '';
            if (isset($invoice) || ($this->input->get('rel_id') && $this->input->get('rel_type'))) {
                if ($this->input->get('rel_id')) {
                    $rel_id = $this->input->get('rel_id');
                    $rel_type = $this->input->get('rel_type');
                } else {
                    $rel_id = $invoice->rel_id;
                    $rel_type = $invoice->rel_type;
                }
            }
            ?>
            <div class="panel_s invoice accounting-template">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if (!empty($title)) {
                echo $title;
            } ?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_client_id">
                                <div class="form-group select-placeholder">
                                    <label for="clientid" class="control-label"><?php echo _l('invoice_select_customer'); ?></label>

                                    <select class="form-control selectpicker" name="clientid" required="" id="clientid" onchange="get_challan()" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                            foreach ($client_branch_data as $client_value) {
                                                ?>
                                                <option value="<?php echo $client_value->userid; ?>" <?php echo (isset($debit_info->clientid) && $debit_info->clientid == $client_value->userid) ? 'selected' : "" ?>><?php echo cc($client_value->client_branch_name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>



                                </div>
                            </div>



                            <div class="row">

                                <div class="col-md-6">
                                        <?php $value = (isset($debit_info) ? $debit_info->invoice_numbers : '') ?>
                                        <?php echo render_input('invoice_numbers', 'Invoice Number', $value); ?>
                                </div>

                                <div class="col-md-6">
                                    <label for="invoice_id" class="control-label">Select Parent Invoice</label>
                                    <select class="form-control selectpicker" id="invoice_id" name="invoice_id" data-live-search="true">

                                        <option value=""></option>
                                        <?php
                                        if (!empty($invoice_info)) {
                                            foreach ($invoice_info as $value) {
                                                ?>
                                                <option value="<?php echo $value->id; ?>" <?php echo (!empty($debit_info->invoice_id) && $debit_info->invoice_id == $value->id) ? 'selected' : ''; ?>><?php echo $value->number; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <br>
                            <div class="form-group">
                                <label for="tax_type" class="control-label">Tax Type</label>
                                <select required="" class="form-control selectpicker" id="tax_type" name="tax_type" data-live-search="true">

                                    <option value=""></option>
                                    <option value="1" <?php echo (!empty($debit_info->tax_type) && $debit_info->tax_type == 1) ? 'selected' : ''; ?> >CGST+SGST</option>
                                    <option value="2" <?php echo (!empty($debit_info->tax_type) && $debit_info->tax_type == 2) ? 'selected' : ''; ?> >IGST</option>

                                </select>
                            </div>

                        </div>
                        <div class="col-md-6">
                            <div class="panel_s no-shadow">
                                <div class="row">
                                    <?php $value = (isset($debit_info) ? $debit_info->number : get_creditnote_number()); ?>
                                    <div class="form-group col-md-6">
                                        <label for="number">Credit Note Number</label>
                                        <div class="input-group">
                                            <span class="input-group-addon">
                                                C-Note
                                            </span>
                                            <input type="text" name="number" required="" class="form-control" value="<?php echo $value; ?>" data-isedit="false" data-original-number="false">

                                        </div>
                                    </div>

                                    <div class="form-group col-md-6">
                                        <label for="enquiry_date" class="control-label">Other Charges Tax Type</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="other_charges_tax" name="other_charges_tax">
                                            <option value="2" <?php echo (!empty($debit_info->other_charges_tax) && $debit_info->other_charges_tax == 2) ? 'selected' : ''; ?> >Excluding Tax</option>
                                            <option value="1" <?php echo (!empty($debit_info->other_charges_tax) && $debit_info->other_charges_tax == 1) ? 'selected' : ''; ?> >Including Tax</option>
                                        </select>
                                    </div>

                                </div>

                                <div class="row">

                                    <div class="form-group col-md-6">
                                    <?php
                                    $value = date('d/m/Y');
                                    if (isset($debit_info)) {
                                        $value = _d($debit_info->date);
                                    }
                                    ?>
                                    <?php echo render_date_input('date', 'Date', $value); ?>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="qty_hours" class="control-label">Select Qty/Hours</label>
                                        <select required="" class="form-control selectpicker" id="qty_hours" required="" name="qty_hours" data-live-search="true">
                                            <option value="1" <?php echo (!empty($debit_info->qty_hours) && $debit_info->qty_hours == 1) ? 'selected' : ''; ?> >Qty</option>
                                            <option value="2" <?php echo (!empty($debit_info->qty_hours) && $debit_info->qty_hours == 2) ? 'selected' : ''; ?> >Hours</option>

                                        </select>
                                    </div>

                                    <div class="form-group col-md-3">
                                        <label for="sac_hsn" class="control-label">Select SAC/HSN</label>
                                        <select required="" class="form-control selectpicker" id="sac_hsn" required="" name="sac_hsn" data-live-search="true">
                                            <option value="1" <?php echo (!empty($debit_info->sac_hsn) && $debit_info->sac_hsn == 1) ? 'selected' : ''; ?> >SAC</option>
                                            <option value="2" <?php echo (!empty($debit_info->sac_hsn) && $debit_info->sac_hsn == 2) ? 'selected' : ''; ?> >HSN</option>

                                        </select>
                                    </div>
                                    <div class="form-group col-md-12">
                                        <label for="assignid" class="control-label">Assign</label>
                                        <select class="form-control selectpicker" required="" id="assign_to_production" name="assignid[]" multiple="" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if (isset($approveby) && $enquirycall_info->is_converted > 0) {
                                                $approvby = explode(',', $approveby->assignids);
                                            }
                                            if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                    ?>
                                                    <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                        <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                        <?php
                                                        foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                            ?>
                                                            <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                            if (isset($approvby) && in_array($singstaff['staffid'], $approvby)) {
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


                            </div>

                        </div>

                    </div>

                </div>

            </div>
            <div class="col-md-12">



                <div class="panel_s">



                    <div class="panel-body">


                        <h4 class="no-mtop mrg3">Client Person</h4>
                        <hr/>
<?php
if (!isset($contactdata)) {
    ?>
                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
                                    <thead>
                                        <tr>
                                            <th width="20%" align="left"><?php echo _l('name'); ?></th>
                                            <th width="20%" class="qty" align="left"><?php echo _l('email'); ?></th>
                                            <th width="20%" align="left"><?php echo _l('number'); ?>	</th>
                                            <th width="20%" align="left"><?php echo _l('designation'); ?>	</th>
                                            <th width="20%" align="left"><?php echo _l('type'); ?>	</th>
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
                                                    <input type="text" id="email0" name="clientdata[0][email]" onBlur="checkmail(this.value, 0);" class="form-control clientmail" >
                                                </div>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <input type="text" minlength="10" maxlength="10" id="phonenumber0" name="clientdata[0][phonenumber]" onBlur="checkcontno(this.value, 0);" class="form-control onlynumbers">
                                                </div><span id="phonenumberdiv0"></span>
                                            </td>
                                            <td>
                                                <div class="form-group">
                                                    <select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[0][designation_id]">
                                                        <option value=""></option>
    <?php
    if (isset($designation_data) && count($designation_data) > 0) {
        foreach ($designation_data as $designation_key => $designation_value) {
            ?>
                                                                <option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option>
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
                                    <label class="label-control subHeads"><a  class="addmorecontact" value="<?php if (isset($productcomponent)) {
        echo count($productcomponent);
    } ?>"><?php echo _l('add_more_client_person'); ?> <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
    <?php
} else {
    ?>
                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myContactTable">
                                    <thead>
                                        <tr>
                                            <th width="20%" align="left"><?php echo _l('name'); ?></th>
                                            <th width="20%" class="qty" align="left"><?php echo _l('email'); ?></th>
                                            <th width="20%" align="left"><?php echo _l('number'); ?>	</th>
                                            <th width="20%" align="left"><?php echo _l('designation'); ?>	</th>
                                            <th width="20%" align="left"><?php echo _l('type'); ?>	</th>
                                            <th width="10%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
    <?php
    $i = 0;
    foreach ($contactdata as $singlecontactdata) {
        $i++;
        ?>
                                            <tr class="main" id="trcc<?php echo $i; ?>">
                                                <td>
                                                    <div class="form-group">
                                                        <input type="hidden" name="client_data[<?php echo $i; ?>][clientid]" value="<?php echo $singlecontactdata['contactid']; ?>">
                                                        <input type="text" id="firstname" name="clientdata[<?php echo $i; ?>][firstname]" value="<?php echo $singlecontactdata['firstname']; ?>" class="form-control" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" id="email<?php echo $i; ?>" name="clientdata[<?php echo $i; ?>][email]" value="<?php echo $singlecontactdata['email']; ?>" onBlur="checkmail(this.value, 0);" class="form-control clientmail" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="text" minlength="10" maxlength="10" id="phonenumber<?php echo $i; ?>" name="clientdata[<?php echo $i; ?>][phonenumber]" value="<?php echo $singlecontactdata['phonenumber']; ?>" onBlur="checkcontno(this.value, 0);" class="form-control onlynumbers contact1"><span id="phonenumberdiv1"></span>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="designation_id" name="clientdata[<?php echo $i; ?>][designation_id]">
                                                            <option value=""></option>
        <?php
        if (isset($designation_data) && count($designation_data) > 0) {
            foreach ($designation_data as $designation_key => $designation_value) {
                ?>
                                                                    <option value="<?php echo $designation_value['id'] ?>" <?php if ($singlecontactdata['designation_id'] == $designation_value['id']) {
                                                        echo"selected=selected";
                                                    } ?>><?php echo cc($designation_value['designation']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="contact_type" name="clientdata[<?php echo $i; ?>][contact_type]">
                                                            <option value=""></option>
                                            <?php
                                            if (isset($contact_type_data) && count($contact_type_data) > 0) {
                                                foreach ($contact_type_data as $contact_type_key => $contact_type_value) {
                                                    ?>
                                                                    <option value="<?php echo $contact_type_value['id'] ?>" <?php if ($singlecontactdata['contact_type'] == $contact_type_value['id']) {
                                                        echo"selected=selected";
                                                    } ?>><?php echo $contact_type_value['contact_type'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                                                        </select>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson('<?php echo $i; ?>');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
        <?php }
    ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmorecontact" value="<?php echo count($contactdata); ?>"><?php echo _l('add_more_client_person'); ?> <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
    <?php }
?>

                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <button type="submit" name="save" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                Save
                            </button>
                        </div>
                    </div>

                </div>
            </div>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-10">
                                <h4 class="no-mtop mrg3">Add Products</h4>
                            </div>

                            <div class="col-md-2">
                                 <!--<a href="<?php echo admin_url('product/product'); ?>" target="_blank" class="btn btn-info">Add New Product</a>-->
                            </div>
                            <hr/>
                            <div class="col-md-12">


                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop transporttable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 5%;"><i class="fa fa-cog"></i></td>
                                                    <td style="width: 30%;">Description</td>
                                                    <td style="width: 10%;">SAC/HSN Code</td>
                                                    <td style="width: 7%;">Rate</td>
                                                    <td style="width: 7%;">Qty</td>
                                                    <td style="width: 7%;">Days</td>
                                                    <td style="width: 7%;">Tax %</td>
                                                    <td style="width: 10%;">Tax Amt</td>
                                                    <td style="width: 10%;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($product_info)) {
                                                    $i = 0;
                                                    $totsaleprod = count($product_info);
                                                    foreach ($product_info as $single_prod_sale_det) {
                                                        ?>
                                                        <tr class="trtrans<?php echo $i; ?>">
                                                            <td><button type="button" class="btn btn-danger" onclick="removetransport(<?php echo $i; ?>);"><i class="fa fa-remove"></i></button></td>
                                                            <td><textarea name="saleproposal[<?php echo $i; ?>][product_name]" class="form-control"><?php echo $single_prod_sale_det['product_name']; ?></textarea></td>
                                                            <td><input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" value="<?php echo $single_prod_sale_det['hsn_code']; ?>" /></td>
                                                            <td><input type="text" class="form-control" id="transport_price_<?php echo $i; ?>" onchange="get_total_price_transport(<?php echo $i; ?>)" name="saleproposal[<?php echo $i; ?>][price]" value="<?php echo $single_prod_sale_det['price']; ?>" /></td>
                                                            <td><input type="text" class="form-control" id="transport_qty_<?php echo $i; ?>" onchange="get_total_price_transport(<?php echo $i; ?>)" name="saleproposal[<?php echo $i; ?>][qty]" value="<?php echo $single_prod_sale_det['qty']; ?>" /></td>
                                                            <td><input type="text" class="form-control" id="transport_days_<?php echo $i; ?>" onchange="get_total_price_transport(<?php echo $i; ?>)" name="saleproposal[<?php echo $i; ?>][days]" value="<?php echo $single_prod_sale_det['days']; ?>" /></td>
                                                            <td><input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" onchange="get_total_price_transport(<?php echo $i; ?>)" id="transport_tax_<?php echo $i; ?>" value="<?php echo $single_prod_sale_det['prodtax']; ?>" />
                                                            </td>
                                                            <td><input readonly="" type="text" class="form-control" id="transport_tax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="<?php echo $single_prod_sale_det['tax_amt']; ?>" /></td>
                                                            <td class="grandtotal totaltransamt" style="font-size: 17px; text-align: center; padding: 10px;" id="grand_total_transprot_<?php echo $i; ?>"></td>
                                                        </tr>
                                                        <?php
                                                        $i++;
                                                    }
                                                } else {
                                                    ?>
                                                    <tr class="trtrans0">
                                                        <td><button type="button" class="btn btn-danger" onclick="removetransport(0);"><i class="fa fa-remove"></i></button></td>
                                                        <td><textarea name="saleproposal[0][product_name]" class="form-control"></textarea></td>
                                                        <td><input type="text" class="form-control" name="saleproposal[0][hsn_code]" /></td>
                                                        <td><input type="text" class="form-control" id="transport_price_0" onchange="get_total_price_transport(0)" name="saleproposal[0][price]" /></td>
                                                        <td><input type="text" class="form-control" id="transport_qty_0" onchange="get_total_price_transport(0)" name="saleproposal[0][qty]" value="1" /></td>
                                                        <td><input type="text" class="form-control" id="transport_days_0" onchange="get_total_price_transport(0)" name="saleproposal[0][days]" value="1" /></td>
                                                        <td><input type="text" class="form-control" name="saleproposal[0][prodtax]" onchange="get_total_price_transport(0)" id="transport_tax_0" value="18" />
                                                        </td>
                                                        <td><input readonly="" type="text" class="form-control" id="transport_tax_amt_0" name="saleproposal[0][tax_amt]" value="" /></td>
                                                        <td class="grandtotal totaltransamt" style="font-size: 17px; text-align: center; padding: 10px;" id="grand_total_transprot_0"></td>
                                                    </tr>
    <?php
}
?>

                                            </tbody>
                                        </table>
                                        <div class="col-xs-12">
                                            <label class="label-control subHeads"><a class="addmoretransport" value="<?php echo (!empty($product_info)) ? count($product_info) : 0; ?>">Add More <i class="fa fa-plus"></i></a></label>
                                        </div>
                                    </div>
                                </div>





                                <hr/>
                                <div class="table-responsive s_table" style="margin-top:3%;">
                                    <div class="col-md-12">
                                        <h4 class="no-mtop mrg3">Other Charges</h4>
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
                                                            if (isset($debitnote_othercharges) && count($debitnote_othercharges) > 0) {
                                                                $l = 0;
                                                                foreach ($debitnote_othercharges as $singlerentotherchargesp) {
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
} else {
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
                                        <label class="label-control subHeads"><a  class="addmore" value="<?php if (!empty($debitnote_othercharges)) {
    echo count($debitnote_othercharges);
} else {
    echo '0';
} ?>">Add More <i class="fa fa-plus"></i></a></label>
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
                                        <label for="note" class="control-label">Note</label>

                                        <textarea class="form-control tinymce" name="note" id="note"><?php echo (isset($debit_info) && $debit_info->note != '') ? $debit_info->note : ""; ?></textarea>
                                    </div>
                                </div>


                                <div  class="col-md-12">
                                    <div class="form-group">
                                        <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>

                                        <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions">
<?php
if (!empty($debit_info)) {
    echo $debit_info->terms_and_conditions;
} else {
    echo get_terms_conditions('credit_note');
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


<?php /* $tax_value = ( isset($invoice) ? $invoice->tax_type : '1'); */ ?>
            <!-- <input type="hidden" id="tax_type" name="tax_type" value="<?php echo $tax_value; ?>"> -->


<?php echo form_close(); ?>
<?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<script type="text/javascript">
            $(document).on('change', '#challan_id', function() {
    var challan_id = $('#challan_id').val();
            $.ajax({
            type    : "POST",
                    url     : "<?php echo base_url(); ?>admin/debit_note/get_invoice_by_challan",
                    data    : {'challan_id' : challan_id},
                    success : function(response){
                    if (response != ''){
                    $('#invoice_id option[value=' + response + ']').attr('selected', 'selected');
                            $('.selectpicker').selectpicker('refresh');
                    }
                    }
            })

    })
</script>
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

    function get_total_price_transport(value) {
    var price = parseInt($('#transport_price_' + value).val());
            var qty = parseInt($('#transport_qty_' + value).val());
            var days = parseInt($('#transport_days_' + value).val());
            var tax = parseInt($('#transport_tax_' + value).val());
            var total_price = (price * qty * days);
            var tax_amt = ((total_price * tax) / 100);
            $('#transport_tax_amt_' + value).val(tax_amt);
            var grand_total = parseInt(total_price + tax_amt);
            $('#grand_total_transprot_' + value).text(grand_total);
            var totalamt = 0;
            $('table.transporttable').find('td.totaltransamt').each(function () {
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

    function get_total_price_per_qty_sale(value) {
    var tax_type = $('#tax_type').val();
            var price = $('#salemainprice_' + value).val();
            var qty = $('#saleqty_' + value).val();
            var disc = $('#saledisc_' + value).val();
            var tax = $('#saleprod_tax_' + value).val();
            var total_price = (price * qty);
            $('#saleprice_' + value).val(total_price);
            var tax_amt = ((total_price * tax) / 100);
            $('#saletax_amt_' + value).val(tax_amt);
            var grand_total = (total_price) + (tax_amt);
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
                    if (x == - 1)
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




    $('.addmoretransport').click(function ()
    {
    var addmorerentpro = parseInt($(this).attr('value'));
            var newaddmorerentpro = addmorerentpro + 1;
            $(this).attr('value', newaddmorerentpro);
            $('.transporttable tbody').append('<tr class="trtrans' + newaddmorerentpro + '"><td><button type="button" class="btn btn-danger" onclick="removetransport(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><textarea name="saleproposal[' + newaddmorerentpro + '][product_name]" class="form-control"></textarea></td><td><input type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][hsn_code]" /></td><td><input type="text" class="form-control" id="transport_price_' + newaddmorerentpro + '" onchange="get_total_price_transport(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]" /></td><td><input type="text" class="form-control" id="transport_qty_' + newaddmorerentpro + '" onchange="get_total_price_transport(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][qty]" value="1" /></td><td><input type="text" class="form-control" id="transport_days_' + newaddmorerentpro + '" onchange="get_total_price_transport(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][days]" value="1"/></td><td><input type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="transport_tax_' + newaddmorerentpro + '" onchange="get_total_price_transport(' + newaddmorerentpro + ')"  value="18" /></td><td><input readonly="" type="text" class="form-control" id="transport_tax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value="" /></td><td class="grandtotal totalsaleamt" style="font-size: 17px; text-align: center; padding: 10px;" id="grand_total_transprot_' + newaddmorerentpro + '"></td></tr>');
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
    function removetransport(value)
    {
    $('.trtrans' + value).remove();
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
                    $.each(resArr, function(k, v) {
                    html += '<option value="' + v.id + '">' + v.leadno + '</option>';
                    });
                            $('.rel_id_label').text('Lead');
                    }
                    if (rel_type == 'customer')
                    {
                    $.each(resArr, function(k, v) {
                    html += '<option value="' + v.userid + '">' + v.client_branch_name + ' - ' + v.email_id + '</option>';
                    });
                            $('.rel_id_label').text('client');
                    }
                    }
                    $("#rel_id").val('');
                            $("#rel_id").html('').html(html);
<?php if ((isset($invoice) && $invoice->rel_type == 'proposal') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $invoice->rel_id; ?>');<?php } ?>
<?php if ((isset($invoice) && $invoice->rel_type == 'customer') || $this->input->get('rel_type')) { ?> $("#rel_id").val('<?php echo $invoice->rel_id; ?>');<?php } ?>
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
if ((isset($invoice) && $invoice->rel_type == 'customer') || $this->input->get('rel_type')) {
    ?>
        get_rel_list('customer');
<?php
}
if ((isset($invoice) && $invoice->rel_type == 'proposal') || $this->input->get('rel_type')) {
    ?>
        get_rel_list('proposal');
<?php } ?>
    });
            function getothercharges(value)
            {
            var amount = $('#amount' + value).val();
                    var igst = $('#igst' + value).val();
                    if (typeof igst === "undefined"){ var gst = $('#gst' + value).val(); var sgst = $('#sgst' + value).val(); var igst = parseInt(gst) + parseInt(sgst); }
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

    function getothersalecharges(value)
    {
    var sale_amount = $('#sale_amount' + value).val();
            var igst = $('#sale_igst' + value).val();
            if (typeof igst === "undefined"){ var gst = $('#sale_gst' + value).val(); var sgst = $('#sale_sgst' + value).val(); var igst = parseInt(gst) + parseInt(sgst); }
    var totalgstamt = parseInt((igst * sale_amount) / 100);
            var totalamt = parseInt(sale_amount) + parseInt(totalgstamt);
            $('#sale_gst_sgst_amt' + value).val(totalgstamt);
            $('#sale_total_maount' + value).val(totalamt);
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
    var select = $(this).val();
            $("optgroup." + select).children().attr('selected', 'selected');
    });
            $('.selectpicker').selectpicker('refresh');
            $.each($("#assign option:not(:selected)"), function(){
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
                            $('#saleprod_tax_' + value).val(res.tax);
                            get_total_price_per_qty_sale(value);
                            $('.selectpicker').selectpicker('refresh');
                    });
    }
    $('#site_id').change(function(){
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
            $('.addmorecontact').click(function ()
    {
    var addmore = parseInt($(this).attr('value'));
            var newaddmore = addmore + 1;
            $(this).attr('value', newaddmore);
            $('#myContactTable tbody').append('<tr class="main" id="trcc' + newaddmore + '"><td><div class="form-group"><input type="text" id="firstname" name="clientdata[' + newaddmore + '][firstname]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="email' + newaddmore + '" name="clientdata[' + newaddmore + '][email]" class="form-control" onBlur="checkmail(this.value,' + newaddmore + ');"></div></td><td><div class="form-group"><input type="text" minlength="10" maxlength="10" onkeyup="nospaces(this)" id="phonenumber' + newaddmore + '" onBlur="checkcontno(this.value,' + newaddmore + ');" name="clientdata[' + newaddmore + '][phonenumber]" class="form-control onlynumbers"></div></td><td><div class="form-group"><select class="form-control selectpicker" style="display:block !important;" data-live-search="true" id="designation_id" name="clientdata[' + newaddmore + '][designation_id]"><option value=""></option><?php if (isset($designation_data) && count($designation_data) > 0) {
    foreach ($designation_data as $designation_key => $designation_value) { ?><option value="<?php echo $designation_value['id'] ?>"><?php echo cc($designation_value['designation']); ?></option><?php }
} ?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" style="display:block !important;" id="contact_type" name="clientdata[' + newaddmore + '][contact_type]"><option value=""></option><?php if (isset($contact_type_data) && count($contact_type_data) > 0) {
    foreach ($contact_type_data as $contact_type_key => $contact_type_value) { ?><option value="<?php echo $contact_type_value['id'] ?>"><?php echo $contact_type_value['contact_type'] ?></option><?php }
} ?></select></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeclientperson(' + newaddmore + ');" ><i class="fa fa-remove"></i></button></td></tr>');
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
                            $.each(resArr, function(k, v) {
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
    }
    else
    {
    if (sitename == '')
    {
    $('#sitename').addClass('error');
    }
    else
    {
    $('#sitename').removeClass('error');
    }
    if (sitelocation == '')
    {
    $('#sitelocation').addClass('error');
    }
    else
    {
    $('#sitelocation').removeClass('error');
    }
    if (siteaddress == '')
    {
    $('#siteaddress').addClass('error');
    }
    else
    {
    $('#siteaddress').removeClass('error');
    }
    if (sitelandmark == '')
    {
    $('#sitelandmark').addClass('error');
    }
    else
    {
    $('#sitelandmark').removeClass('error');
    }
    if (sitepincode == '')
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
                    if (state_id == "") {
            $("#sitecity_id").html('').html(html);
                    $('.selectpicker').selectpicker('refresh');
                    return false;
            }

            $.ajax({
            url : admin_url + 'site_manager/get_cities_by_state_id/' + state_id,
                    method : 'GET',
                    success(res) {
            if (res != "") {
            var resArr = $.parseJSON(res);
                    $.each(resArr, function(k, v) {
                    html += '<option value="' + v.id + '">' + v.name + '</option>';
                    });
            }
            $("#sitecity_id").html('').html(html);
                    $('.selectpicker').selectpicker('refresh');
            }
            });
            }




    $('#clientid').change(function () {

    var clintid = $('#clientid').val();
            if (clintid > 0){
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

    });</script>
<script>
            $(function(){
            //validate_invoice_form();
            // Init accountacy currency symbol
            init_currency_symbol();
                    // Project ajax search
                    //init_ajax_project_search_by_customer_id();
                    // Maybe items ajax search
                    init_ajax_search('items', '#item_select.ajax-search', undefined, admin_url + 'items/search');
            });</script>

<script type="text/javascript">
            $('.onlynumbers').keypress(function(event){

    if (event.which != 8 && isNaN(String.fromCharCode(event.which))){
    event.preventDefault(); //stop character from entering input
    }

    });</script>



<script type="text/javascript">
            $(document).on('change', '#clientid', function() {

    var client_id = $(this).val();
            if (client_id > 0){

    $.ajax({
    type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getclientcategory'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
            if (response != ''){
            $('#rent_company_category').val(response);
            }
            }
    })

            $.ajax({
            type    : "POST",
                    url     : "<?php echo site_url('admin/debit_note/getclientinvoice'); ?>",
                    data    : {'client_id' : client_id},
                    success : function(response){
                    if (response != ''){
                    $('#invoice_id').html(response);
                           $('.selectpicker').selectpicker('refresh');
                    }
                    }
            })

    }


    });
            $(document).ready(function() {

    var client_id = $("#clientid").val();
            if (client_id > 0){

    $.ajax({
    type    : "POST",
            url     : "<?php echo site_url('admin/site_manager/getclientcategory'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
            if (response != ''){
            $('#rent_company_category').val(response);
            }
            }
    })

    }


 });</script>


<script type="text/javascript">

            $(document).on('change', '#service_type', function() {
    var service_type = $(this).val();
            if (service_type == 1){
    $("#for_rent").show();
            $("#for_sale").hide();
    } else if (service_type == 2){
    $("#for_sale").show();
            $("#for_rent").hide();
    }
  });
            $(document).on('change', '#clientid', function() {
    var client_id = $('#clientid').val();
            if (client_id > 0){
    var url = '<?php echo base_url(); ?>admin/Site_manager/getclientdtails';
            $.post(url,
            {
            client_id: client_id,
            },
                    function (data, status) {
                    var res = JSON.parse(data);
                            $('.billing_street').html(res.address);
                            $('#billing_street').val(res.address);
                            $('.billing_state').html(res.state_name);
                            $('#billing_state').val(res.state_name);
                            $('.billing_city').html(res.city_name);
                            $('#billing_city').val(res.city_name);
                            $('.billing_zip').html(res.pincode);
                            $('#billing_zip').val(res.pincode);
                    });
    }


  });
            function get_terms_condition() {
            var type = $("#product_type").val();
                    var service_type = $("#service_type").val();
                    if (type > 0 && service_type > 0){
            $.ajax({
            type    : "POST",
                    url     : "<?php echo site_url('admin/terms_conditions/get_termsandcondition_data'); ?>",
                    data    : {'slug' : 'invoice', 'for' : service_type, 'type' : type},
                    success : function(response){
                    if (response != ''){
                    tinyMCE.activeEditor.setContent(response);
                    }
                    }
            })
            }

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
    });</script>


<script type="text/javascript">
            function get_challan() {
            var clientid = $("#clientid").val();
                    if (clientid > 0){
            $.ajax({
            type    : "POST",
                    url     : "<?php echo base_url(); ?>admin/debit_note/get_challan_list",
                    data    : {'clientid' : clientid},
                    success : function(response){
                    if (response != ''){

                    $("#challan_id").html(response);
                            $('.selectpicker').selectpicker('refresh');
                    } else{
                    $("#challan_id").html('');
                            $('.selectpicker').selectpicker('refresh');
                    }
                    }
            })
            }

            }
</script>


<script type="text/javascript">

    $(document).ready(function() {
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
            if (t.value.match(/\s/g)){
            t.value = t.value.replace(/\s/g, '');
            }
            }
</script>

</body>
</html>

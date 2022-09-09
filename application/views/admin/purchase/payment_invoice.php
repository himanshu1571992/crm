<?php init_head(); ?>

<style>#adminnote{margin: 0px 13.5px 0px 0px;height: 120px;width:100%;}.error{border:1px solid red !important;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

<!-- <input id="check_gst" type='hidden' value="<?php if(isset($invoice->is_gst)){if ($invoice->is_gst == 1){echo'1';}else{echo'0';}}else{if($clientsate == get_staff_state()){echo'1';}else{echo'0';}} ?>"> -->

<input id="check_gst" type='hidden' value="0">
<div id="wrapper">
    <div class="content accounting-template">
	    <a data-toggle="modal" id="modal" data-target="#myModal"></a>
            <?php
                echo form_open_multipart($this->uri->uri_string(),array('id'=>'invoice-form','class'=>''));
                if(isset($invoice)){
                    echo form_hidden('isedit');
                }
			?>
        <div class="row">
			<div class="panel_s invoice accounting-template">
			    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="col-md-6">
                            <div class="f_client_id">
                                <div class="form-group select-placeholder">
                                    <label for="vendor_id" class="control-label">Select Vendor</label>				
                                    <select class="form-control selectpicker" name="vendor_id" required="" id="vendor_id" onchange="get_challan()" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if (isset($vendor_data) && count($vendor_data) > 0) {
                                                foreach ($vendor_data as $vandor_value) {
                                        ?>
                                                    <option value="<?php echo $vandor_value['id'] ?>" <?php echo (isset($invoice_info->vendor_id) && $invoice_info->vendor_id == $vandor_value['id']) ? 'selected' : "" ?>><?php echo cc($vandor_value['name']); ?></option>
                                        <?php
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>	
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="invoice_for" class="control-label">Invoice For</label>
                                    <select required="" class="form-control selectpicker" id="invoice_for" required="" name="invoice_for" data-live-search="true">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($invoice_info->invoice_for) && $invoice_info->invoice_for == 1) ? 'selected' : '' ; ?> >Purchase Order</option>
                                        <option value="2" <?php echo (!empty($invoice_info->invoice_for) && $invoice_info->invoice_for == 2) ? 'selected' : '' ; ?> >Work Order</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="type" class="control-label">Invoice Type</label>
                                    <select required="" class="form-control selectpicker" id="type" required="" name="type" data-live-search="true">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($invoice_info->type) && $invoice_info->type == 1) ? 'selected' : '' ; ?> >Against PO</option>
                                        <option value="2" <?php echo (!empty($invoice_info->type) && $invoice_info->type == 2) ? 'selected' : '' ; ?> >Direct</option>
                                    </select>
                                </div>
                            </div>				
                            <div class="row">
                                <div class="form-group col-md-6">
                                    <label for="po_id" class="control-label">Select Purchase Order</label>
                                    <select class="form-control selectpicker" id="po_id" name="po_id" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                            if(!empty($po_info)){
                                                foreach ($po_info as $key => $value) {
                                                    echo '<option selected value="'.$value->id.'">'.$value->prefix.$value->number.' - '._d($value->date).'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-6">
                                    <label for="mr_id" class="control-label">Select Material Receipt</label>
                                    <select required="" class="form-control selectpicker" id="mr_id" name="mr_id[]" data-live-search="true" multiple="">
                                        <option value=""></option>
                                        <?php
                                            if(!empty($mr_info)){
                                                foreach ($mr_info as $key => $value) {
                                                    echo '<option selected value="'.$value->id.'">'.'MR-'.$value->id.' - '._d($value->date).'</option>';
                                                }
                                            }
                                        ?>
                                    </select>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-6">
                            <div class="panel_s no-shadow">
                                <div class="row">
                                    <?php $value = (isset($invoice_info) ? $invoice_info->reference_number : '' ); ?>
                                    <div class="form-group col-md-6">
                                        <label for="reference_number">Reference Number</label>
                                        <input type="text" name="reference_number" required="" class="form-control" value="<?php echo $value; ?>">
                                    </div>
                                    <div class="form-group col-md-6">
                                        <label for="enquiry_date" class="control-label">Other Charges Tax Type</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="other_charges_tax" name="other_charges_tax">
                                            <option value="2" <?php echo (!empty($invoice_info->other_charges_tax) && $invoice_info->other_charges_tax == 2) ? 'selected' : '' ; ?> >Excluding Tax</option> 
                                            <option value="1" <?php echo (!empty($invoice_info->other_charges_tax) && $invoice_info->other_charges_tax == 1) ? 'selected' : '' ; ?> >Including Tax</option>  
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group ">
                                    <?php
                                        $value = date('d/m/Y');
                                        if(isset($invoice_info)){
                                            $value = _d($invoice_info->date);
                                        }
                                    ?>
                                    <?php echo render_date_input('date','Date',$value); ?>
                                </div>
                                <div class="form-group">
                                    <label for="file" class="control-label"><?php echo 'Attachment File'; ?></label>
                                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%; height: auto; padding: 6px 15px;">
                                </div>	
                            </div>
                        </div>
                        <div class="col-md-12">
                            <button type="button" class="btn btn-success pull-right" id="get_items">Get MR Items</button>
                        </div>
                    </div>
			    </div>		  
			</div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Add Products</h4>
                            </div>
                            <div class="col-md-12">
                                <hr/>        
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td style="width: 130px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                    <td style="width: 35px  !important;"><?php echo _l('prop_pro_qty'); ?></td>
                                                    <td style="width: 45px !important;"><?php echo _l('prop_pro_price'); ?></td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_tot_price'); ?></td>                                                  
                                                    <td style="width: 47px !important;">Tax %</td>
                                                    <td style="width: 47px !important;">Tax Amt</td>
                                                    <td style="width: 47px !important;"><?php echo _l('prop_pro_grand_total'); ?></td>
                                                </tr>
                                            </thead>
                                            <tbody id="table_data">

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
                                                                <a target="_blank" href="../product/product/<?php echo $single_prod_sale_det['product_name']; ?>">
                                                                    <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $single_prod_sale_det['product_name']; ?>">
                                                                </a>
                                                                <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['price']; ?>" name="saleproposal[<?php echo $i; ?>][price]">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][ttl_price]" value="<?php echo $single_prod_sale_det['ttl_price']; ?>">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo $single_prod_sale_det['prodtax']; ?>">
                                                            </td>  
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="<?php echo $single_prod_sale_det['tax_amt']; ?>">
                                                            </td>
                                                            <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">
                                                                <?php echo number_format($totproamt, 2, '.', ''); ?>
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
                                        <input readonly="" type="text" class="form-control sale_total_amt" value="<?php echo (isset($invoice_info) && $invoice_info->finalsubtotalamount != '') ? $invoice_info->finalsubtotalamount : ""; ?>" name="saleproposal[finalsubtotalamount]" id="sale_total_amt">
                                        <div class="sale_total_amtError error_msg"></div>
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>
                                        <input type="number" class="form-control sale_discount_percentage onlynumbers" value="<?php echo (isset($invoice_info) && $invoice_info->finaldiscountpercentage != '') ? $invoice_info->finaldiscountpercentage : ""; ?>" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>
                                        <input readonly="" type="text" class="form-control sale_discount_amt" value="<?php echo (isset($invoice_info) && $invoice_info->finaldiscountamount != '') ? $invoice_info->finaldiscountamount : ""; ?>" name="saleproposal[finaldiscountamount]" id="sale_discount_amt">
                                    </div>
                                    <div class="col-md-3">
                                        <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                        <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo (isset($invoice_info) && $invoice_info->totalamount != '') ? $invoice_info->totalamount : ""; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">
                                    </div>
                                </div>
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                        <label class="col-md-6 control-label text-right">Amount In Words</label>
                                        <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_amt_in_words text-right"></label>
                                    </div>
                                </div>
								<hr/>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive s_table" style="margin-top:3%;">
                                            <div class="col-md-12">
                                                <h4 class="no-mtop mrg3">Round Off</h4>
                                                <hr>
                                            </div>
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                                <thead>
                                                    <tr>
                                                        <th>Remark</th>
                                                        <th>Amount</th>
                                                    </tr>
                                                </thead>
                                                <tbody class="ui-sortable">
                                                    <tr>
                                                        <td><textarea class="form-control" name="roundoff_remark"><?php echo (isset($invoice_info) && $invoice_info->roundoff_remark != '') ? $invoice_info->roundoff_remark : ""; ?></textarea></td>
                                                        <td><input type="number" step="any" class="form-control roundoffamount" name="roundoff_amount" value="<?php echo (isset($invoice_info) && $invoice_info->roundoff_amount != '') ? $invoice_info->roundoff_amount : ""; ?>"></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>  
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

                                            //if (count($debitnote_othercharges) > 0) {

                                            if (!empty($invoice_othercharges)) {

                                                $l = 0;

                                                foreach ($invoice_othercharges as $singlerentotherchargesp) {

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

                                        <label class="label-control subHeads"><a  class="addmore" value="<?php if(!empty($invoice_othercharges)){ echo count($invoice_othercharges); }else{ echo '0'; }  ?>">Add More <i class="fa fa-plus"></i></a></label>

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
                                        <textarea class="form-control tinymce" name="note" id="note"><?php echo (isset($invoice_info) && $invoice_info->note != '') ? $invoice_info->note : ""; ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>

						

						<div class="btn-bottom-toolbar bottom-transaction text-right">

                    <button type="submit" name="save" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">

                        Save

                    </button>

                </div>

                        

                    </div>

                </div>

            </div>

			



              <?php $tax_value = ( isset($invoice) ? $invoice->tax_type : '1'); ?>

            <input type="hidden" id="tax_type" name="tax_type" value="<?php echo $tax_value; ?>">





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

					<?php if((isset($invoice) && $invoice->rel_type == 'proposal') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $invoice->rel_id;?>');<?php }?>

					<?php if ((isset($invoice) && $invoice->rel_type == 'customer') || $this->input->get('rel_type')){?> $("#rel_id").val('<?php echo $invoice->rel_id;?>');<?php }?>

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

		 if ((isset($invoice) && $invoice->rel_type == 'customer') || $this->input->get('rel_type')) {

		 ?>

		  get_rel_list('customer');

		 <?php }

		 if ((isset($invoice) && $invoice->rel_type == 'proposal') || $this->input->get('rel_type')) {

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









function get_terms_condition() {

  var type = $("#product_type").val();

  var service_type = $("#service_type").val();



  if(type > 0 && service_type > 0){

    $.ajax({

        type    : "POST",

        url     : "<?php echo site_url('admin/terms_conditions/get_termsandcondition_data'); ?>",

        data    : {'slug' : 'invoice','for' : service_type,'type' : type},

        success : function(response){

            if(response != ''){           

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

    });
</script>
<script type="text/javascript">
    function get_challan() {
        var clientid = $("#clientid").val();
        if(clientid > 0){
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/debit_note/get_challan_list",
                data    : {'clientid' : clientid},
                success : function(response){
                    if(response != ''){
                        $("#challan_id").html(response);
                        $('.selectpicker').selectpicker('refresh');
                    }else{
                        $("#challan_id").html('');
                        $('.selectpicker').selectpicker('refresh');
                    }
                }
            })
        }      
    }
</script>
<script type="text/javascript">
$(document).on('change', '#vendor_id', function() {
    $("#po_id").html('');
    $("#mr_id").html('');
    $('#type').val('');
    $('.selectpicker').selectpicker('refresh');
});

$(document).on('change', '#type', function() {

  var type = $(this).val();
  var invoice_for = $("#invoice_for").val();
  var vendor_id = $("#vendor_id").val();

  if(vendor_id != '' && invoice_for != ''){

  		$.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/purchase/get_po_mr_list",
            data    : {'vendor_id' : vendor_id,'invoice_for' : invoice_for,'type' : type},
            dataType: "json",
            success : function(response){
                if(response != ''){
                    $("#po_id").html(response.po_html);
                    $("#mr_id").html(response.mr_html);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                	 $("#po_id").html('');
                	 $("#mr_id").html('');
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    }else{

        $("#type").val('');
        $('.selectpicker').selectpicker('refresh');
        alert('Please select Vendor Or Invoice For First!');
    }
});  
</script>
<script type="text/javascript">

    $(document).on('change', '#po_id', function() {

        var po_id = $(this).val();
  		$.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/purchase/get_mr_list",
            data    : {'po_id' : po_id},
            success : function(response){
                if(response != ''){
                    $("#mr_id").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }else{
                	$("#mr_id").html('');
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });  
</script>
<script type="text/javascript">
    $(document).on('click', '#get_items', function() {
    var mr_id = $("#mr_id").val();
        if(mr_id != ''){
            $.ajax({
                type    : "POST",
                url     : "<?php echo base_url(); ?>admin/purchase/get_mr_items",
                data    : {'mr_id' : mr_id},
                success : function(response){
                    if(response != ''){
                        $("#table_data").html(response);
                    }
                }
            })
        }else{
            alert('Please Select MR First!');
        }	
    });  

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
            var grand_total=(total_price)+(tax_amt);

        $('#grand_total_sale' + value).text(grand_total.toFixed(2));
            var totalamt = 0;
        $('table.saletable').find('td.totalsaleamt').each(function () {
            totalamt = parseFloat(totalamt) + parseFloat($(this).text());
        });
        $('.sale_total_amt').val(totalamt);
        //$('.sale_total_quotation_amt').val(totalamt);
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseFloat(rent_total_amt) - parseFloat(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt)); 
    }

    function get_total_disc_sale()
    {
        var rent_total_amt = $('.sale_total_amt').val();
        var rent_discount_percentage = $('.sale_discount_percentage').val();
        var disamt = ((rent_total_amt * rent_discount_percentage) / 100);
        var distotalamt = (parseFloat(rent_total_amt) - parseFloat(disamt));
        $('.sale_discount_amt').val(disamt);
        $('.sale_total_quotation_amt').val(distotalamt);
        $('.sale_total_quotation_amt_in_words').html(toWords(distotalamt));
    }

    /* this is for Round Off amount */
    $(document).on("keyup", ".roundoffamount",function(){
       var roundoff_amt = $(this).val();
       var total_amount = $(".sale_total_quotation_amt").val();
       var sale_total_amt = $("#sale_total_amt").val();
       var sale_discount_amt = $("#sale_discount_amt").val();
       if (parseInt(total_amount) > 0 && roundoff_amt != ''){
         var totalamt = sale_total_amt-sale_discount_amt;
         var final_amt = parseFloat(totalamt) + parseFloat(roundoff_amt);
         $(".sale_total_quotation_amt").val((final_amt).toFixed(2));
       }else{
         var totalamt = sale_total_amt-sale_discount_amt;
         $(".sale_total_quotation_amt").val(totalamt.toFixed(2));
       }
    });
</script>
</body>

</html>


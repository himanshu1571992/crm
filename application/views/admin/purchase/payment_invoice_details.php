<?php init_head(); ?>

<style>#adminnote{margin: 0px 13.5px 0px 0px;height: 120px;width:100%;}.error{border:1px solid red !important;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}


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

                        <select class="form-control selectpicker" name="vendor_id" disabled  id="vendor_id" onchange="get_challan()" data-live-search="true">
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

                            <select class="form-control selectpicker" id="invoice_for" disabled name="invoice_for" data-live-search="true">

                                <option value=""></option>

                                <option value="1" <?php echo (!empty($invoice_info->invoice_for) && $invoice_info->invoice_for == 1) ? 'selected' : '' ; ?> >Purchase Order</option>

                                <option value="2" <?php echo (!empty($invoice_info->invoice_for) && $invoice_info->invoice_for == 2) ? 'selected' : '' ; ?> >Work Order</option>

                            </select>
                        </div>
                        <div class="form-group col-md-6">

                            <label for="type" class="control-label">Invoice Type</label>

                            <select  class="form-control selectpicker" id="type" disabled name="type" data-live-search="true">

                                <option value=""></option>

                                <option value="1" <?php echo (!empty($invoice_info->type) && $invoice_info->type == 1) ? 'selected' : '' ; ?> >Against PO</option>

                                <option value="2" <?php echo (!empty($invoice_info->type) && $invoice_info->type == 2) ? 'selected' : '' ; ?> >Direct</option>

                            </select>



                        </div>

                    </div>              



                    <div class="row">

                        <div class="form-group col-md-6">

                            <label for="po_id" class="control-label">Select Purchase Order</label>

                            <select class="form-control selectpicker" id="po_id" name="po_id" data-live-search="true" disabled>

                                 

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

                            <select class="form-control selectpicker" id="mr_id" name="mr_id[]" data-live-search="true" multiple="" disabled >

                                 

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
 
                              <input type="text" name="reference_number" class="form-control" value="<?php echo $value; ?>" disabled >

                        </div>



                        <div class="form-group col-md-6">

                            <label for="enquiry_date" class="control-label">Other Charges Tax Type</label>

                            <select class="form-control selectpicker" data-live-search="true" id="other_charges_tax" name="other_charges_tax" disabled >

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

                                <?php echo $file_data; ?>

                            </div>  





                    </div>

                 </div>



             

                </div>

              </div>          



            </div>

            

            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        

                        <div class="row">

                            <div class="col-md-12">

                                <h4 class="no-mtop mrg3">Products Details</h4>

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

                               





                            </div>

                        </div>

                        <div class="col-md-12">
                        
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>

                            <hr/>
                            <div class="col-md-12">
                               
                                     <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row">
                                    <div class="col-md-12">
                                       <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; } ?></textarea>
                                    </div>
                                    </div>
                                </div>
                                </div>
                           
                        </div>

                    </div>


                        <?php 
                        if($invoice_info->itc_status == 0){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
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

            



         


            <?php echo form_close(); ?>

            <?php $this->load->view('admin/invoice_items/item'); ?>

        </div>

        <div class="btn-bottom-pusher"></div>

    </div>

</div>

<?php init_tail(); ?>





</body>

</html>


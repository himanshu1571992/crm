<?php init_head(); ?>

<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 120px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>

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
                        <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">

                            <div class="col-md-6">

                               

                                <div class="form-group">

                                    <label for="vendor_id" class="control-label">Select Vendor</label>
                                    <?php $cls = (isset($section) && $section == "convert") ? 'disabled=""' : '';?>
                                    <select class="form-control selectpicker vendor_id" <?php echo $cls; ?> data-live-search="true" required="" id="vendor_id" name="vendor_id">

                                        <option value=""></option>

                                        <?php

                                        if (isset($vendors_info) && count($vendors_info) > 0) {

                                            foreach ($vendors_info as $vendor_value) {

                                                ?>

                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (!empty($purchase_challaninfo) && $purchase_challaninfo->vendor_id == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>

                                                <?php

                                            }

                                        }

                                        ?>

                                    </select>

                                </div>
                                <div class="form-group">
                                    <label for="po_number" class="control-label">Purchase Order Number</label>
                                    <?php
                                    if (isset($section) && $section == "convert"){
                                        $po_number = "";
                                        if (!empty($purchase_challaninfo)){
                                            $ponumber = value_by_id_empty("tblpurchaseorder", $purchase_challaninfo->po_id, "number");
                                            $po_number = (is_numeric($ponumber)) ? 'PO-'.$ponumber : $ponumber;
                                        }
                                    ?>
                                    <input type="text" id="challan_no" disabled="" name="po_number" class="form-control" value="<?php echo $po_number;  ?>">
                                    <?php }else{ ?>
                                        <select class="form-control selectpicker po_id" data-live-search="true"  id="po_id" name="po_id">
                                            <option value=""></option>
                                        </select>
                                    <?php } ?>
                                </div>
                                <?php
                                $mr_details = array();
                                if (isset($section) && $section == "convert"){
                                    $mr_details = $this->db->query("SELECT * FROM `tblmaterialreceipt` where `id`='" . $purchase_challaninfo->mr_id . "' ")->row();
                                ?>
                                <div class="form-group" app-field-wrapper="challan_no">

                                    <label for="challan_no" class="control-label">Challan No.</label>

                                    <input type="text" id="challan_no" name="challan_no" class="form-control" readonly="" value="<?php echo (!empty($mr_details) && !empty($mr_details->challan_no)) ? $mr_details->challan_no : ""; ?>">

                                </div>
                                <?php }else{ ?>
                                <div class="form-group" app-field-wrapper="credit_note_no">

                                    <label for="credit_note_no" class="control-label">Ref Credit Note No.</label>

                                    <input type="text" id="credit_note_no" name="credit_note_no" class="form-control">

                                </div>
                                <?php } ?>

                            </div>

                            <div class="col-md-6">
                                <div class="panel_s no-shadow">
                                    <?php if (isset($section) && $section == "convert"){ ?>
                                    <div class="row">
                                        <div class="col-md-6">
                                            <?php
                                                
                                                $mr_number = (!empty($mr_details) && !empty($mr_details->numer)) ? $mr_details->numer : 'MR-' . $purchase_challaninfo->mr_id;
                                                $mr_date = (!empty($mr_details) && !empty($mr_details->date)) ? _d($mr_details->date) : _d(date('Y-m-d'));
                                            ?>

                                            <?php echo render_date_input('date', 'Material Receipt Date', $mr_date, array("disabled" => "disabled")); ?>
                                        </div>
                                        <div class="col-md-6">
                                            <label for="number" class="control-label">MR Number</label>
                                            <input type="text" id="number" name="number" class="form-control" disabled="" value="<?php echo $mr_number; ?>">
                                        </div>
                                    </div>
                                    <?php }?>
                                    <div class="row">
                                        <div class="col-md-12">
                                            <?php echo render_date_input('date', 'Date', _d(date('Y-m-d'))); ?>
                                        </div>
                                        <div class="col-md-12">
                                            <div class="form-group">
                                                <label for="tax_type" class="control-label">Tax Type</label>
                                                <select required="" class="form-control selectpicker" required="" name="tax_type" data-live-search="true">

                                                    <option value=""></option>
                                                    <option value="1" >CGST+SGST</option>
                                                    <option value="2" >IGST</option>

                                                </select>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="btn-bottom-toolbar bottom-transaction text-right">
                           <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit mr_submit">Save</button>
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
                            <hr/>
                            </div>
                            <div class="col-md-12">
                                <div id="product_div">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" id="docAttachDivVideo" style="margin-left:10px;width:1800px !important;">
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <td style="width: 1% !important;"><i class="fa fa-cog"></i></td>
                                                        <td style="width: 130px !important;"><?php echo _l('prop_pro_name'); ?></td>
                                                        <td style="width: 35px !important;"><?php echo _l('prop_pro_id'); ?></td>
                                                        <td style="width: 35px !important;"><?php echo _l('prop_pro_hsn_code'); ?></td>
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
                                                        $tt_amt = 0.00;
                                                        if (isset($purchase_challaninfo) && !empty($purchase_challaninfo)){
                                                            $productinfo = $this->db->query("SELECT * FROM tblmaterialreceiptproduct WHERE mr_id = '".$purchase_challaninfo->mr_id."' AND reject_qty > 0.00 ORDER BY id DESC")->result_array();
                                                            if (!empty($productinfo)) {

                                                            $totsaleprod = count($productinfo);
                                                            
                                                        ?>
                                                            <input type="hidden" id="totalsalepro" value="<?php echo count($productinfo); ?>">
                                                        <?php
                                                            
                                                            foreach ($productinfo as $single_prod_sale_det) {
                                                                
                                                                $purchase_data = $this->db->query("SELECT * FROM `tblpurchaseorderproduct` WHERE `po_id` = ".$single_prod_sale_det["po_id"]." AND `product_id` = ".$single_prod_sale_det["product_id"]."")->row();

                                                            
                                                            if ($purchase_data->is_temp == 0){
                                                                   $url = admin_url("product_new/view/");
                                                                   $pro_id = "PRO-ID".$single_prod_sale_det['product_id'];
                                                                }else{
                                                                   $url = admin_url("product_new/temperory_product/");
                                                                   $pro_id = "TEMP-PRO-ID".$single_prod_sale_det['product_id'];
                                                                }
                                                                
                                                                $ttl_price = $single_prod_sale_det['reject_qty'] * $purchase_data->price;
                                                                $tax_amt = (($ttl_price * $purchase_data->prodtax) /100);
                                                                $totproamt = ($ttl_price + $tax_amt);
                                                                $tt_amt += $totproamt;
                                                        ?>
                                                        <tr class="trsalepro<?php echo $i; ?>" >
                                                            <td>
                                                                <button type="button" class="btn btn-danger" onclick="removesalepro('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
                                                            </td>
                                                            <td>
                                                                <a target="_blank" href="<?php echo $url.$single_prod_sale_det['product_id']; ?>">
                                                                    <input class="form-control" type="text" readonly="" name="saleproposal[<?php echo $i; ?>][product_name]" style="cursor: pointer !important;" value="<?php echo $purchase_data->product_name; ?>">
                                                                </a>
                                                                <input value="<?php echo $single_prod_sale_det['product_id']; ?>" name="saleproposal[<?php echo $i; ?>][product_id]" type="hidden">
                                                                <input value="<?php echo $single_prod_sale_det['id']; ?>" name="saleproposal[<?php echo $i; ?>][itemid]" type="hidden">
                                                                <input value="<?php echo $purchase_data->is_temp; ?>" name="saleproposal[<?php echo $i; ?>][is_temp]" type="hidden">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][pro_id]" readonly="" value="<?php echo $pro_id; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][hsn_code]" readonly="" value="<?php echo $purchase_data->hsn_code; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['reject_qty']; ?>">
                                                            </td>
                                                            <td>
                                                                <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $purchase_data->price; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">
                                                            </td>
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" id="saleprice_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][ttl_price]" value="<?php echo $ttl_price; ?>" id="total_price1">
                                                            </td>
                                                            <td>
                                                                <input type="hidden" name="saleproposal[<?php echo $i; ?>][isgst]" value="0">
                                                                <input readonly="" type="text" class="form-control" name="saleproposal[<?php echo $i; ?>][prodtax]" id="saleprod_tax_<?php echo $i; ?>" value="<?php echo $purchase_data->prodtax; ?>">
                                                            </td>  
                                                            <td>
                                                                <input readonly="" type="text" class="form-control" id="saletax_amt_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][tax_amt]" value="<?php echo $tax_amt; ?>" id="total_price1">
                                                            </td>

                                                            <td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale<?php echo $i; ?>">

                                                                <?php echo round($totproamt, 0); ?>

                                                            </td>

                                                            </tr>
                                                            <?php
                                                            
                                                                
                                                            $i++;
                                                        }
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

                                            <input readonly="" type="text" class="form-control sale_total_amt" value="<?php echo $tt_amt; ?>" name="saleproposal[finalsubtotalamount]" id="sale_total_amt">

                                            <div class="sale_total_amtError error_msg"></div>

                                        </div>

                                        <div class="col-md-3">

                                            <label class="control-label">Total Discount (%) <span style="color:red">*</span></label>

                                            <input type="text" class="form-control sale_discount_percentage onlynumbers" value="0" onchange="get_total_disc_sale()" name="saleproposal[finaldiscountpercentage]" id="sale_discount_percentage">

                                        </div>

                                        <div class="col-md-3">

                                            <label class="control-label">Total Discount Amt <span style="color:red">*</span></label>

                                            <input readonly="" type="text" class="form-control sale_discount_amt" value="0.00" name="saleproposal[finaldiscountamount]" id="sale_discount_amt">

                                        </div>

                                        <div class="col-md-3">

                                            <label class="control-label">Total Amount <span style="color:red">*</span></label>

                                            <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo $tt_amt; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">

                                        </div>

                                    </div>
                                    <div class="row" style="margin-top:2%;padding:8px;">
                                        <div class="col-md-12 pull-right">
                                            <label class="col-md-6 control-label text-right">Amount In Words</label>
                                            <label style="font-weight:500;font-size: 16px;text-transform: capitalize;" class="col-md-6 pull-left control-label sale_total_quotation_amt_in_words text-right"></label>
                                        </div>
                                    </div>                              
                                </div>
                                <hr/>
                                <div  class="col-md-12" style="margin-top: 15px;">
                                    <div class="form-group">
                                        <label for="note" class="control-label">Special Remark</label>
                                        <textarea class="form-control tinymce" name="note" id="note"></textarea>
                                    </div>
                                </div>
                                <div  class="col-md-12">
                                    <div class="form-group">
                                        <label for="terms_and_conditions" class="control-label"><?php echo _l('terms_and_conditions'); ?></label>
                                        <textarea class="form-control tinymce" name="terms_and_conditions" id="terms_and_conditions">
                                            <?php echo get_terms_conditions('purchase_debit_note'); ?>
                                        </textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>	
            <?php echo form_close(); ?>

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

    $('.addmoresalepro').click(function ()

    {

        var addmorerentpro = parseInt($(this).attr('value'));

        var check_gst = parseInt($('#check_gst').val());

        var newaddmorerentpro = addmorerentpro + 1;

        $(this).attr('value', newaddmorerentpro);

        if (check_gst == 0)

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn  btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ', this)" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {
        if ($product_value['is_temp'] == 0) {
            $product_code = product_code($product_value['id']);
        } else {
            $product_code = temp_product_code($product_value['id']);
        }
        ?><option data-is_temp="<?php echo $product_value['is_temp']; ?>" value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].$product_code ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_is_temp' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][is_temp]" type="hidden"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="salepro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="text" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][ttl_price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="saleprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

        } else

        {

            $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn  btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ', this)" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']) ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_is_temp' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][is_temp]" type="hidden"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><input type="text" id="salepro_pro_hsncode_' + newaddmorerentpro + '" class="form-control" readonly name="saleproposal[' + newaddmorerentpro + '][hsn_code]"></td><td><input type="text" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][ttl_price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="saleprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

        }

        $('.selectpicker').selectpicker('refresh');

    });

    

    function removesalepro(value)

    {

        $('.trsalepro' + value).remove();

        get_total_price_per_qty_sale(value);

    }

    function getsaleprodata(value, el)
    {
        var prodid = $('#saleprodid' + value).val();
        var is_temp = el.selectedOptions[0].getAttribute('data-is_temp');
        var check_gst = parseInt($('#check_gst').val());
        var vendor_id = $('#vendor_id').val();
        var rent_company_category = $('#rent_company_category').val();

        var url = '<?php echo base_url(); ?>admin/Site_manager/getPruchaseorderProductDetails';
        $.post(url,
                {
                    prodid: prodid,
                    vendor_id: vendor_id,
                    is_temp_product: is_temp,
                    rent_company_category: rent_company_category,
                },
                function (data, status) {
                    
                    var res = JSON.parse(data);

                        /* this is for redirect to product details on next tab */
                        // var reurl = '<?php echo base_url(); ?>admin/product_new/view/'+prodid; 
                        // if (is_temp == 1){
                        //     var reurl = '<?php echo base_url(); ?>admin/product_new/temperory_product/'+prodid; 
                        // }
                        // window.open(reurl, '_blank');

                        $('#salepro_id' + value).val(prodid);

                        //$('#salepro_remark_' + value).val(res.product_remarks);

                        $('#salepro_name' + value).val(res.name);
                        $('#salepro_is_temp' + value).val(is_temp);

                        $('#salepro_pro_id_' + value).val(res.pro_id);
                        
                        $('#salepro_unit_' + value).val(res.product_unit);
                        $('#salepro_unit1_' + value).val(res.product_unit_id);
                        
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
                    
                        getproconfirmation(value, el, 'sales');

                    $('.selectpicker').selectpicker('refresh');

                });

    }


    $('.newsite').click(function () {

        $('.sitedv').fadeToggle();

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

    $('#vendor_id').change(function () {
        var vendor_id = $('#vendor_id').val();
        if(vendor_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/get_purchase_number';
            $.post(url,
                    {
                        vendor_id: vendor_id,
                    },
                    function (response, status) {
                        if(response != ''){
                            $('#po_id').html(response);
                            $('.selectpicker').selectpicker('refresh');
                        }                       

                    });
        }
    });  

</script>

</body>

</html>


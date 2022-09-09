<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width:100%;height: 75px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4><hr/>
                            </div>
                            <div class="col-md-12">
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="vendor_id" class="control-label">Select Vendor</label>
                                            <select class="form-control selectpicker vendor_id" data-live-search="true" required="" id="vendor_id" name="vendor_id">
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
                                    </div>
                                    <div class="col-md-4">
                                        <?php
                                        $value = _d(date('Y-m-d'));
                                        echo render_date_input('date', 'Material Receipt Date', $value);
                                        ?>
                                    </div>
                                    <div class="col-md-4">	
                                        <div class="form-group" app-field-wrapper="number">
                                            <label for="number" class="control-label">MR Number</label>
                                            <input type="text" id="number" name="number" class="form-control" value="<?php echo mr_next_number(); ?>">
                                        </div>
                                    </div> 
                                    
                                </div>
                                <div class="row">
                                    <div class="form-group col-md-4">
                                        <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                        <select class="form-control selectpicker warehouse_id" data-live-search="true" required="" id="warehouse_id" name="warehouse_id">
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

                                    <div class="form-group col-md-4">
                                        <label for="tax_type" class="control-label">Service Type</label>
                                        <select class="form-control selectpicker" data-live-search="true" required="" id="service_type" name="service_type">
                                            <option value=""></option>
                                            <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 1) ? 'selected' : ''; ?> >Rent</option>
                                            <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 2) ? 'selected' : ''; ?>>Sales</option>


                                        </select>
                                    </div>

                                    <div class="col-md-4">	
                                        <div class="form-group" app-field-wrapper="challan_no">
                                            <label for="challan_no" class="control-label">challan No.</label>
                                            <input type="text" id="challan_no" name="challan_no" class="form-control" value="">
                                        </div>
                                    </div> 
                                </div>
                                <div class="row">
                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="files" class="control-label"><?php echo 'Attachment File'; ?></label>
                                            <input type="file" id="files" multiple="" name="files[]" style="width: 100%;">
                                        </div>
                                    </div>

                                    <div class="col-md-4">
                                        <div class="form-group">
                                            <label for="tax_type" class="control-label">Select Tax Type</label>
                                            <select class="form-control selectpicker" data-live-search="true" required="" id="tax_type" name="tax_type">
                                                <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['tax_type'] == 2) ? 'selected' : ''; ?>>Excluding</option>
                                                <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['tax_type'] == 1) ? 'selected' : ''; ?> >Including</option>
                                            </select>
                                        </div>
                                    </div>

                                    <div class="col-md-4">  
                                        <div class="form-group">
                                            <label for="assign" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                            <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">
                                                <?php
                                                if (isset($stockdata['approvby'])) {
                                                    $approvby = explode(',', $stockdata['approvby']);
                                                }
                                                if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                    foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                        ?>
                                                        <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                            <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                            <?php
                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                ?>
                                                                <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php if (isset($approvby) && in_array($singstaff['staffid'], $approvby)) {
                                                        echo'selected';
                                                    } ?>><?php echo $singstaff['firstname'] ?></option>
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
                                <div class="row">
                                    <div class="col-md-4">  
                                        <?php echo render_input('reference_no', 'reference_no', ''); ?>
                                    </div>     
                                    <div class="col-md-6">
                                        <div class="form-group">
                                            <label for="adminnote" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                            <textarea id="adminnote" class="form-control" name="adminnote"></textarea>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-2" app-field-wrapper="extrusion">
                                        <label style="margin-top: 25px;" for="extrusion" class="control-label">MR for Extrusion </label>
                                        <input type="checkbox" name="extrusion" value="1">
                                    </div>
                                </div>
                            </div>
                            
                            

                            


                            

                            

                            

                             
                            

                           
							<div class="col-md-12" style="margin-bottom:5%;">	
							
                            </div>
                            
							
							
							
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
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

                            <div class="col-md-10">
                                <h4>MR Product Details</h4>
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

                                                            <input type="text" class="form-control" id="saleqty_<?php echo $i; ?>" name="saleproposal[<?php echo $i; ?>][qty]" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" min="1" value="<?php echo $single_prod_sale_det['qty']; ?>">

                                                        </td>

                                                        <td>

                                                            <input type="text" class="form-control" id="salemainprice_<?php echo $i; ?>" onchange="get_total_price_per_qty_sale(<?php echo $i; ?>)" value="<?php echo $single_prod_sale_det['price']; ?>" name="saleproposal[<?php echo $i; ?>][price]" id="price1">

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

                                            }else{
                                                ?>
                                                <tr class="trsalepro0"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(0);"><i class="fa fa-remove"></i></button></td><td><select class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(0)" data-live-search="true" id="saleprodid0" name="saleproposal[0][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']) ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name0" name="saleproposal[0][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id0" name="saleproposal[0][product_id]" type="hidden"><input value="" name="saleproposal[0][itemid]" type="hidden"><input value="" id="averagesaleprice0" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_0" name="saleproposal[0][pro_id]"></td><td><select class="form-control selectpicker pr_id" style="display:block !important;"  name="saleproposal[0][hsn_code]"><option value="1">HSN</option><option value="2">SAC</option></select></td><td><input type="text" id="salepro_pro_remark_0" class="form-control" name="saleproposal[0][remark]"></td><td><input type="text" class="form-control" id="saleqty_0" name="saleproposal[0][qty]" onchange="get_total_price_per_qty_sale(0)" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_0" onchange="get_total_price_per_qty_sale(0)" name="saleproposal[0][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_0" name="saleproposal[0][ttl_price]" ></td><td><input type="hidden" name="saleproposal[0][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[0][prodtax]" id="saleprod_tax_0" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_0" name="saleproposal[0][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale0"></td></tr>
                                                <?php
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
<?php init_tail(); ?>
<script>

	
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
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
	
	function get_comp_det(proid,value)
	{
		var component_id = value;
        $('#view'+proid).html('<a href="../product/product/'+component_id+'" target="_blank">view</a>');
		/*var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_comp_det/'+component_id,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#comphsn_code'+proid).val(data.hsn_code);
				$('#compsac_code'+proid).val(data.sac_code);
				$('#view'+proid).html('<a href="../product/product/'+data.id+'" target="_blank">view</a>');
            }
        });*/
	}
	
	
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

        $('.saletable tbody').append('<tr class="trsalepro' + newaddmorerentpro + '"><td><button type="button" class="btn pull-right btn-danger" onclick="removesalepro(' + newaddmorerentpro + ');"><i class="fa fa-remove"></i></button></td><td><select data-dropup-auto="false" class="form-control selectpicker pr_id" style="display:block !important;" onchange="getsaleprodata(' + newaddmorerentpro + ')" data-live-search="true" id="saleprodid' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]"><option value=""></option><?php

if (isset($product_data) && count($product_data) > 0) {

    foreach ($product_data as $product_key => $product_value) {

        ?><option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']) ?></option><?php

    }

}

?></select><input class="form-control" type="hidden" id="salepro_name' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_name]" style="cursor: pointer !important;" value="" aria-invalid="false"><input value="" id="salepro_id' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][product_id]" type="hidden"><input value="" name="saleproposal[' + newaddmorerentpro + '][itemid]" type="hidden"><input value="" id="averagesaleprice' + newaddmorerentpro + '" type="hidden"></td><td><input type="text" class="form-control" readonly id="salepro_pro_id_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][pro_id]"></td><td><select class="form-control selectpicker pr_id" style="display:block !important;"  name="saleproposal[' + newaddmorerentpro + '][hsn_code]"><option value="1">HSN</option><option value="2">SAC</option></select></td><td><input type="text" id="salepro_pro_remark_' + newaddmorerentpro + '" class="form-control" name="saleproposal[' + newaddmorerentpro + '][remark]"></td><td><input type="text" class="form-control" id="saleqty_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][qty]" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" min="1" value="1.00"></td><td><input type="text" class="form-control" id="salemainprice_' + newaddmorerentpro + '" onchange="get_total_price_per_qty_sale(' + newaddmorerentpro + ')" name="saleproposal[' + newaddmorerentpro + '][price]"></td><td><input readonly="" type="text" class="form-control" id="saleprice_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][ttl_price]" ></td><td><input type="hidden" name="saleproposal[' + newaddmorerentpro + '][isgst]" value="0"><input readonly="" type="text" class="form-control" name="saleproposal[' + newaddmorerentpro + '][prodtax]" id="saleprod_tax_' + newaddmorerentpro + '" value=""></td><td><input readonly="" type="text" class="form-control" id="saletax_amt_' + newaddmorerentpro + '" name="saleproposal[' + newaddmorerentpro + '][tax_amt]" value=""></td><td class="grandtotal totalsaleamt" style="font-size: 17px;text-align: center;padding: 10px;" id="grand_total_sale' + newaddmorerentpro + '"></td></tr>');

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
</body>
</html>

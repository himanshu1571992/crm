<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            
            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo $title; ?></h4>
                                <hr>
                            </div>
                            <div class="col-md-6">
                            <?php
                                $vendor_name = value_by_id('tblvendor',$proforma_invoice_info->vendor_id,'name');
                                $warehouse_name = value_by_id('tblwarehouse',$proforma_invoice_info->warehouse_id,'name');
                                $site_name = value_by_id('tblsitemanager',$proforma_invoice_info->site_id,'name');
                            ?>
                                <div class="col-md-6">
                                    <h5 class="text-info"><u>Vendor Name :</u></h5>
                                    <div class="form-group" app-field-wrapper="">
                                        <?php echo  $vendor_name; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <h5 class="text-info"><u>Source :</u></h5>
                                    <div class="form-group" app-field-wrapper="">
                                        <?php echo ($proforma_invoice_info->source_type == 1) ? 'Warehouse':'site'; ?>
                                    </div>
                                </div>   
                                <?php if ($proforma_invoice_info->warehouse_id > 0){ ?>
                                    <div class="col-md-6">
                                        <h5 class="text-info"><u>Warehouse Name :</u></h5>
                                        <div class="form-group" app-field-wrapper="">
                                            <?php echo  $warehouse_name; ?>
                                        </div>
                                    </div>   
                                <?php } ?>
                                <?php if ($proforma_invoice_info->site_id > 0){ ?>
                                    <div class="col-md-6">
                                        <h5 class="text-info"><u>Site Name :</u></h5>
                                        <div class="form-group" app-field-wrapper="">
                                            <?php echo  $site_name; ?>
                                        </div>
                                    </div>   
                                <?php } ?>
                                <div class="col-md-6">
                                    <h5 class="text-info"><u>Expected MR Date :</u></h5>
                                    <div class="form-group" app-field-wrapper="">
                                        <?php echo  (!empty($proforma_invoice_info->expected_mr_date) && $proforma_invoice_info->expected_mr_date != '') ? _d($proforma_invoice_info->expected_mr_date) : ''; ?>
                                    </div>
                                </div>     
                                
                            </div>
                            <div class="col-md-6">
                                <div class="col-md-6">
                                    <h5 class="text-info"><u>Proforma Invoice Date :</u></h5>
                                    <div class="form-group" app-field-wrapper="">
                                        <?php echo _d($proforma_invoice_info->date); ?>
                                    </div>
                                </div> 
                                <div class="col-md-6">
                                    <h5 class="text-info"><u>Proforma Invoice Number :</u></h5>
                                    <div class="form-group" app-field-wrapper="">
                                        <?php echo  $proforma_invoice_info->number; ?>
                                    </div>
                                </div>
                                <div class="col-md-6">
                                    <div class="form-group">
                                        <h5 class="text-info"><u>Attachments :</u></h5>
                                    </div>
                                    <?php 
                                    if (!empty($proforma_invoice_info)){
                                        $files_list = $this->db->query("SELECT * FROM `tblfiles` WHERE `rel_id`='".$proforma_invoice_info->id."' AND `rel_type`='poproforma_invoice' ")->result();
                                        if (!empty($files_list)){
                                            
                                            foreach ($files_list as $key => $file) {
                                                $upath = base_url().'uploads/purchase_order/proforma_invoice/'.$proforma_invoice_info->id.'/'.$file->file_name;
                                                $fno = $key+1;
                                                echo $fno.') <a href="'.$upath.'" target="_blank">'.$file->file_name.'</a>';
                                                echo '<br>';
                                            }
                                        }else{
                                            echo 'N/a';
                                        }
                                    }else{
                                        echo 'N/a';
                                    }
                                    ?>
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
                                <h4 class="no-mtop mrg3">Proforma Invoice Products</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" id="docAttachDivVideo" >
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <td>Pro Name</td>
                                                    <td>Pro ID</td>
                                                    <td>HSN/SAC Code</td>
                                                    <td>Remark</td>
                                                    <td>Unit</td>
                                                    <td>Qty</td>
                                                    <td>Price</td>
                                                    <td>Total Price</td>
                                                    <td>Disc. %</td>
                                                    <td>Disc. Price</td>
                                                    <td>Tax %</td>
                                                    <td>Tax Amt</td>
                                                    <td>Grand Total</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                if (!empty($product_info)) {
                                                    $i = 1;
                                                    $tax_type = value_by_id('tblpurchaseorder', $proforma_invoice_info->po_id, 'tax_type');
                                                    foreach ($product_info as $key => $value) {
                                                        
                                                        $product_name = value_by_id('tblproducts', $value->product_id, 'name');
                                                        $pro_price = ($value->price*$value->qty);
                                                        $sale_dis_price = $pro_price - (($pro_price * $value->discount) / 100);
                                                        if ($tax_type == '2'){
                                                            $tax_amt = (($sale_dis_price * $value->prodtax) / 100);
                                                            $totproamt = ($sale_dis_price + $tax_amt);
                                                        }else{
                                                            $totproamt = $sale_dis_price;
                                                        }
                                                        ?>
                                                        <tr>
                                                            <td><?php echo $product_name; ?></td>
                                                            <td><?php echo "PRO-".$value->product_id; ?></td>
                                                            <td><?php echo ($value->hsn_code == 1) ? 'HSN':'SAC'; ?></td>
                                                            <td><?php echo (!empty($value->remark)) ? $value->remark : '--'; ?></td>
                                                            <td><?php echo value_by_id("tblunitmaster", $value->unit_id, "name"); ?></td>
                                                            <td><?php echo $value->qty; ?></td>  
                                                            <td><?php echo $value->price; ?></td>  
                                                            <td><?php echo $value->ttl_price; ?></td>  
                                                            <td><?php echo $value->discount; ?></td>  
                                                            <td><?php echo (($pro_price * $value->discount) / 100); ?></td>  
                                                            <td><?php echo $value->prodtax; ?></td>  
                                                            <td><?php echo $value->tax_amt; ?></td>  
                                                            <td><?php echo number_format($totproamt, '2', '.',','); ?></td>  
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                ?>  

                                            </tbody>
                                        </table>
                                        <hr>
                                        <div class="col-md-3">
                                            <label class="control-label">Total Amount <span style="color:red">*</span></label>
                                            <input style="font-weight:bold;" readonly="" type="text" class="form-control sale_total_quotation_amt" value="<?php echo (isset($proforma_invoice_info) && $proforma_invoice_info->totalamount != '') ?  $proforma_invoice_info->totalamount : 0; ?>" name="saleproposal[totalamount]" id="sale_total_quotation_amt">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <br>
                                <br>
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="table-responsive s_table" style="margin-top:3%;">
                                            <div class="col-md-12">
                                                <h4 class="no-mtop mrg3">Round Off</h4>
                                                <hr/>
                                            </div>
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop">
                                                <thead>
                                                    <th>Remark</th>
                                                    <th>Amount</th>
                                                </thead>
                                                <tbody class="ui-sortable">
                                                    <td><?php echo (isset($proforma_invoice_info) && $proforma_invoice_info->roundoff_remark != '') ? $proforma_invoice_info->roundoff_remark : "N/A"; ?></td>
                                                    <td><?php echo (isset($proforma_invoice_info->roundoff_amount)) ? $proforma_invoice_info->roundoff_amount : ""; ?></td>
                                                </tbody>
                                            </table>
                                        </div>         
                                    </div>
                                </div>
                                <br>
                                <br>
                                <h4 class="text-info"><u>PI Remark :</u></h4>
                                <div class="form-group" app-field-wrapper="">
                                    <?php echo (!empty($proforma_invoice_info->pi_remark)) ? $proforma_invoice_info->pi_remark : "N/A"; ?>
                                </div>

                                <h4><u>General Terms and Conditions:</u></h4>
                                <div class="termsList"><?php echo getAllTermsConditions($proforma_invoice_info->po_id, "purchase_order"); ?></div>
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


<script type="text/javascript">	
    $( document ).ready(function() {    
		var po_id = $("#po_number").val();
		if(po_id > 0){
            var url = '<?php echo base_url(); ?>admin/Purchase/getbillandshipping';
                $.post(url,
                {
                    po_id: po_id,
                },
               function (data, status) {


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



</script>
</body>
</html>

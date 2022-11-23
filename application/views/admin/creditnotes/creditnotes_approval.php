<?php init_head(); ?>
<style>.error{border:1px solid red !important;}.mrg3{margin-bottom: 3%;margin-top: 3% !important;}table.items tr.main td {padding-top: 8px !important;padding-bottom: 8px !important;}
fieldset.for-panel {
    background-color: #fcfcfc;
	border: 1px solid #999;
	border-radius: 4px;	
	padding:15px 10px;
	background-color: #d9edf7;
    border-color: #bce8f1;
	background-color: #f9fdfd;
	margin-bottom:12px;
}
fieldset.for-panel legend {
    background-color: #fafafa;
    border: 1px solid #ddd;
    border-radius: 5px;
    color: #4381ba;
    font-size: 14px;
    font-weight: bold;
    line-height: 10px;
    margin: inherit;
    padding: 7px;
    width: auto;
	background-color: #d9edf7;
	margin-bottom: 0;
}
fieldset.for-panel i.success {
    color: green;
    font-size: 30px;
}
fieldset.for-panel i.danger {
    color: red;
    font-size: 30px;
}
fieldset.for-panel p span.badge-success {
    color: #fff;
    background-color: #28a745;
}
.termsList{margin-top:8px;font-size:10px;text-transform: none;}
.termsList > table {
    border: double 5px;
}
.termsList > table > tbody >tr >td {
    border: solid 2px;
    padding: 10px;
}
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
<div id="wrapper">
    <div class="content">
   <div class="row">
      <div class="col-md-12">
      </div>
       <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'creditnote-approval-form', 'class' => 'enquirycall-approval-form')); ?>
       <div class="col-md-12">
           <div class="panel_s">
               <div class="panel-body">
                   <h4 class="customer-profile-group-heading"><?php echo isset($title) ? $title : ""; ?></h4>
                   
                   <div class="row">
                      
                       <fieldset class="for-panel">
                           <legend>Basic Details</legend>
                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red">Customer Name &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php echo (isset($creditnote_info)) ? client_info($creditnote_info->clientid)->client_branch_name : "--"; ?>
                                    </p>
                               </div>
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Credit Note Number &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php echo (isset($creditnote_info) && !empty($creditnote_info->number)) ? $creditnote_info->number : "--"; ?>
                                    </p>
                               </div>
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Other Charges Tax Type &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php 
                                            if (isset($creditnote_info) && !empty($creditnote_info->other_charges_tax)){
                                                echo ($creditnote_info->other_charges_tax == 1) ? "Including" : "Excluding";
                                            } 
                                        ?>
                                    </p>
                               </div>
                               
                           </div>  
                           <div class="col-sm-12">
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Invoice Number &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php echo (isset($creditnote_info) && !empty($creditnote_info->invoice_numbers)) ? $creditnote_info->invoice_numbers : "--"; ?>
                                    </p>
                               </div>
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Parent Invoice &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php echo (isset($creditnote_info) && $creditnote_info->invoice_id > 0) ? value_by_id("tblinvoices", $creditnote_info->invoice_id, "number") : "--"; ?>
                                    </p>
                               </div>
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Date &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php 
                                            if (isset($creditnote_info) && !empty($creditnote_info->date)){
                                                echo _d($creditnote_info->date);
                                            } 
                                        ?>
                                    </p>
                               </div>
                            </div>
                            <div class="col-sm-12">
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Qty/Hours &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php 
                                            if (isset($creditnote_info) && !empty($creditnote_info->qty_hours)){
                                                echo ($creditnote_info->qty_hours == 1) ? "Qty" : "Hours";
                                            } 
                                        ?>
                                    </p>
                               </div>
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> SAC/HSN &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php 
                                            if (isset($creditnote_info) && !empty($creditnote_info->sac_hsn)){
                                                echo ($creditnote_info->sac_hsn == 1) ? "SAC" : "HSN";
                                            } 
                                        ?>
                                    </p>
                               </div>
                               <div class="col-sm-4">
                                    <h4 class="control-label" style="color:red"> Tax Type &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <?php 
                                            if (isset($creditnote_info) && !empty($creditnote_info->tax_type)){
                                                echo ($creditnote_info->tax_type == 1) ? "SGST+CGST" : "IGST";
                                            } 
                                        ?>
                                    </p>
                               </div>
                           </div> 
                           <div class="col-sm-12">
                               <div class="col-sm-6">
                                    <h4 class="control-label" style="color:red"> Note &nbsp; :</h4>
                                    <p class="form-control-static">
                                        <div class="col-md-12 table-responsive" style="overflow-x: scroll">
                                            <div class="termsList">
                                                <?php 
                                                    echo (isset($creditnote_info) && !empty($creditnote_info->note)) ? $creditnote_info->note : "--";
                                                ?>
                                            </div>
                                        </div>
                                    </p>
                               </div>
                           </div> 
                       </fieldset>
                   </div>    
                
                <div class="row">
                    <fieldset class="for-panel">
                        <legend>Client Person</legend>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                    <thead>
                                        <tr>
                                            <th width="10%"  align="center"><i class="fa fa-cog"></i></th>
                                            <th width="20%" align="left"><?php echo _l('name'); ?></th>
                                            <th width="20%" class="qty" align="left"><?php echo _l('email'); ?></th>
                                            <th width="20%" align="left"><?php echo _l('number'); ?>	</th>
                                            <th width="20%" align="left"><?php echo _l('designation'); ?>	</th>
                                            <th width="20%" align="left"><?php echo _l('type'); ?>	</th>
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
                                                    <div class="form-group" align="center"><?php echo $i; ?></div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <?php echo $singlecontactdata['firstname']; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <?php echo $singlecontactdata['email']; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <?php echo $singlecontactdata['phonenumber']; ?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <?php echo value_by_id("tbldesignation", $singlecontactdata['designation_id'], "designation");?>
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <?php echo value_by_id("tblcontacttype", $singlecontactdata['contact_type'], "contact_type");?>
                                                    </div>
                                                </td>
                                            </tr>
                                        <?php } ?>
                                    </tbody>
                                </table>    
                            </div> 
                        </div> 
                    </fieldset>
                </div>
                <div class="row">
                    <div class="col-md-12">
                        <?php 
                            if(!empty($info) && ($info->approve_status == 0) && ($check_approval->count == 0)){
                            ?>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                
                                <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Approve
                                    </button>
                                <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                        Reject
                                    </button>
                                </div> 
                            <?php 
                            }
                        ?>
                    </div>
                </div>
                   
            </div>
         </div>
      </div>
        
       <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    
                    <div class="row">
                    <fieldset class="for-panel">
                        <legend>Product Details</legend>
                        <div class="col-sm-12">
                            <div class="table-responsive">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
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
                                    <tbody class="ui-sortable">
                                        <?php
                                            if (!empty($creditnote_product)) {
                                                $i = 0;
                                                $totsaleprod = count($creditnote_product);
                                                foreach ($creditnote_product as $single_prod_sale_det) {
                                                    ?>
                                                    <tr class="trtrans<?php echo $i; ?>">
                                                        <td><?php echo ++$i; ?></td>
                                                        <td><?php echo cc($single_prod_sale_det['product_name']); ?></td>
                                                        <td><?php echo $single_prod_sale_det['hsn_code']; ?></td>
                                                        <td><?php echo $single_prod_sale_det['price']; ?></td>
                                                        <td><?php echo $single_prod_sale_det['qty']; ?></td>														
                                                        <td><?php echo $single_prod_sale_det['days']; ?></td>														
                                                        <td><?php echo $single_prod_sale_det['prodtax']; ?></td>
                                                        <td><?php echo $single_prod_sale_det['tax_amt']; ?></td>
                                                        <td><?php echo ($single_prod_sale_det['price'] * $single_prod_sale_det['qty']) + $single_prod_sale_det['tax_amt']; ?></td>
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
                    </fieldset>
                </div>
                    <div class="row">
                        <?php
                            if (isset($creditnote_othercharges) && !empty($creditnote_othercharges)) {
                        ?>
                            <fieldset class="for-panel">
                                <legend>Other Charges</legend>
                                <div class="col-sm-12">
                                    <div class="table-responsive">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable1">
                                            <thead>
                                                <tr>
                                                    <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                                    <th width="30%" align="left"><?php echo _l('other_charges_cat_name'); ?></th>
                                                    <th width="10%" class="qty" align="left"><?php echo _l('other_charges_sac_code'); ?></th>
                                                    <th width="10%" align="left"><?php echo _l('amt'); ?>	</th>
                                                    <th width="20%" align="left">Tax</th>   
                                                    <th width="10%" align="left">Tax Amount </th> 
                                                    <th width="20%" align="left"><?php echo _l('total_amount'); ?>	</th>
                                                </tr>
                                            </thead>
                                            <tbody class="ui-sortable">
                                                <?php
                                                $othertotalcharges = 0;

                                                $l = 0;
                                                foreach ($creditnote_othercharges as $singlerentotherchargesp) {
                                                    $l++;
                                                    $othertotalcharges += $singlerentotherchargesp['amount'];
                                                    ?>
                                                    <tr id="tr<?php echo $l; ?>">
                                                        <td align="center"><?php echo $l; ?></td>
                                                        <td>
                                                            <div class="form-group"> <?php echo value_by_id("tblotherchargemaster", $singlerentotherchargesp['category_name'], "category_name"); ?></div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo $singlerentotherchargesp['sac_code']; ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo $singlerentotherchargesp['amount']; ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo $singlerentotherchargesp['igst']; ?>
                                                            </div>
                                                        </td>

                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo $singlerentotherchargesp['gst_sgst_amt']; ?>
                                                            </div>
                                                        </td>
                                                        <td>
                                                            <div class="form-group">
                                                                <?php echo $singlerentotherchargesp['total_maount']; ?>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                    <?php
                                                }
                                                ?>
                                            </tbody>
                                        </table>    
                                    </div> 
                                </div> 
                            </fieldset>
                        <?php } ?>
                </div>
                    <div class="row">
                        
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="6"><?php if(!empty($info)){ echo $info->approvereason; } ?></textarea>
                                    </div>
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
<script type="text/javascript">
    $(document).on("click", ".addmoreproenq",function(){
        var sub_category_id = "<?php echo $sub_category_id; ?>";
        
        var numbersArray = sub_category_id.split(',');
        var addmoreproenq = parseInt($(this).attr('value'));
        var newaddmoreproenq = addmoreproenq + 1;
        $(this).attr('value', newaddmoreproenq);
        
        var url = "<?php echo admin_url("enquirycall/get_products_list")?>";
        $.post(url, {"sub_category_id": numbersArray}, function(data){
                $('#myTable1 tbody').append('<tr class="main" id="tre'+newaddmoreproenq+'"><td><button type="button" class="btn pull-right btn-danger"  onclick="removeproduct('+newaddmoreproenq+');" ><i class="fa fa-remove"></i></button></td><td><div class="form-group"><div class="product_list1"><select class="form-control product_list selectpicker" data-live-search="true" id="product_id'+newaddmoreproenq+'" name="proenqdata['+newaddmoreproenq+'][product_id]"><option value=""></option>'+data+'</select></div></div></td><td><div class="form-group"><input type="number" id="qty" name="proenqdata['+newaddmoreproenq+'][qty]" class="form-control"></div></td></tr>');
                $('.selectpicker').selectpicker('refresh');
            });
    });
   
    function removeproduct(proid)
    {
        $('#tre' + proid).remove();
    }
</script>
</body>
</html>

<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}
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
.tb-title {
    font-size: 16px;
    font-weight: bold;
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
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'verification-form', 'class' => 'verification-form')); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4><?php echo $title; ?></h4>
                            <hr>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <div class="panel_s">
                                            <div class="panel-body">
                                                <table border="0" cellspacing="0" cellpadding="0" class="mb-15">
                                                    <tr>
                                                        <td class="col-md-3"><h4>Proforma Invoice Number : </h4></td>
                                                        <td class="col-md-3"><span><?php echo format_estimate_number($estimate_info->id); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <td class="col-md-3"><h4>Date : </h4></td>
                                                        <td class="col-md-3">&nbsp;&nbsp;<?php echo _d($estimate_info->date); ?></td>
                                                    </tr>
                                                </table>
                                                
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-6">
                                        <?php 
                                            $file_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_type = 'estimate_po' AND rel_id = '".$estimate_info->id."' ORDER BY id ASC")->result();
                                            if(!empty($file_info)){
                                        ?>
                                                <fieldset class="for-panel">
                                                    <legend>PO Uploads :</legend>
                                                    <div class="col-md-12">
                                                        <?php foreach ($file_info as $key => $value) { ?>
                                                            <div class="row">
                                                                <?php echo ++$key.') '; ?><a target="_blank" href="<?php echo base_url('uploads/estimates/purchase_order/'.$value->rel_id.'/'.$value->file_name); ?>"><?php echo $value->file_name; ?></a>
                                                            </div>
                                                        <?php } ?>               
                                                    </div>    
                                                </fieldset>
                                        <?php        
                                            }
                                        ?> 
                                    </div>
                                </div>
                                <div class="col-md-12">
                                    <div class="col-md-6">
                                        <fieldset class="for-panel">
                                            <legend>Proforma Invoice To :</legend>
                                            <div class="col-md-12">
                                                    <?php
                                                    $to_info = get_estimate_to_array($estimate_info->id);
                                                    $to_address = "";
                                                    if (!empty($to_info['address'])){
                                                        if ($to_address != ""){
                                                            $to_address .= ','.$to_info['address'];
                                                        }else{
                                                            $to_address .= $to_info['address'];
                                                        }
                                                    }

                                                    if (!empty($to_info['city'])){
                                                        if ($to_address != ""){
                                                            $to_address .= ','.$to_info['city'];
                                                        }else{
                                                            $to_address .= $to_info['city'];
                                                        }
                                                    }
                                                    if (!empty($to_info['state'])){
                                                        if ($to_address != ""){
                                                            $to_address .= ','.$to_info['state'];
                                                        }else{
                                                            $to_address .= $to_info['state'];
                                                        }
                                                    }
                                                    ?>
                                                <h3><?php echo $to_info['name']; ?></h3>
                                                <p><?php echo $to_address; ?></p>
                                                <?php 
                                                    if (!empty($to_info['gst'])){
                                                        echo '<p><b class="tb-title">GSTIN :</b> '.$to_info['gst'].'</p>';
                                                    }
                                                    if (!empty($to_info['contact_name'])){
                                                        echo '<p><b class="tb-title">Contact Name :</b> '.cc($to_info['contact_name']).'</p>';
                                                    }
                                                    if (!empty($to_info['email'])){
                                                        echo '<p style="text-transform:none;"><b class="tb-title">Email :</b> '.$to_info['email'].'</p>';
                                                    }
                                                    
                                                    if (!empty($to_info['phone'])){
                                                        echo '<p><b class="tb-title">Phone :</b> '.$to_info['phone'].'</p>';
                                                    }
                                                ?>        
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div class="col-md-6">
                                        <fieldset class="for-panel">
                                            <legend>Ship To :</legend>
                                            <div class="row">
                                                <div class="col-md-12">
                                                    <?php 
                                                        $shipto_info = get_ship_to_array($estimate_info->site_id);
                                                        $shipaddress = "";
                                                        if (!empty($shipto_info['address'])){
                                                            $shipaddress .= $shipto_info['address'];
                                                        }
                                                        if (!empty($shipto_info['city'])){
                                                            if ($shipaddress != ""){
                                                                $shipaddress .= ','.$shipto_info['city'];
                                                            }else{
                                                                $shipaddress .= $shipto_info['city'];
                                                            }
                                                        }
                                                        if (!empty($shipto_info['state'])){
                                                            if ($shipaddress != ""){
                                                                $shipaddress .= ','.$shipto_info['state'];
                                                            }else{
                                                                $shipaddress .= $shipto_info['state'];
                                                            }
                                                        }
                                                    ?>
                                                    <h3><?php echo cc($shipto_info['name']); ?></h3>
                                                    <p><?php echo $shipaddress; ?></p>
                                                    <?php 
                                                        if (!empty($shipto_info['landmark'])){
                                                            echo '<p><b class="tb-title">Landmark :</b> '.$shipto_info['landmark'].'</p>';
                                                        }
                                                        if (!empty($shipto_info['zip'])){
                                                            echo '<p><b class="tb-title">Zip :</b> '.$shipto_info['zip'].'</p>';
                                                        }
                                                    ?>    
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12">
                                    <fieldset class="for-panel">
                                        <legend>Product Verification :</legend>
                                        <div class="col-md-12">
                                            <?php 
                                                //For dicount show
                                                $show_discount = 0;
                                                if(!empty($estimate_info->items)){
                                                    foreach ($estimate_info->items as $key => $value) {
                                                        if($value['discount'] > 0){
                                                            $show_discount = 1;
                                                        }
                                                    }
                                                }
                                                $check_estimate_rent_item=check_estimate_item($estimate_info->id,0);
	                                            $check_estimate_sale_item=check_estimate_item($estimate_info->id,1);
                                                if($check_estimate_rent_item>=1){
                                                    $type = 'rent';
                                                }elseif($check_estimate_sale_item>=1){
                                                    $type = 'sale';
                                                }
                                                if($type=='sale'){
                                                    $othercharges=get_pro_estimate_othercharges($estimate_info->id,'1');
                                                }else{
                                                    $othercharges=get_pro_estimate_othercharges($estimate_info->id,'0');
                                                }
                                                $cols_no = 5;      
                                            ?>
                                            <div class="table-responsive">            
                                                <table class="table" id="newtable">
                                                    <thead>
                                                        <tr>
                                                            <th width="7%" class="no" style="font-size:10px;font-weight:600;">NO.</th>
                                                            <th width="35%" class="no" style="font-size:10px;font-weight:600;">ITEM DESCRIPTION</th>
                                                            <th class="no" style="font-size:10px;font-weight:600;">QTY</th>
                                                            <?php 
                                                                if($estimate_info->measurement == 2){
                                                                    $cols_no+= 1;
                                                                    echo '<th class="no" style="font-size:10px;font-weight:600;">Weight(Kg)</th>';
                                                                }
                                                            ?>
                                                            <th class="no" style="font-size:10px;font-weight:600;">RATE</th>
                                                            <?php 
                                                                if($show_discount == 1){
                                                                    $cols_no+= 1;
                                                                    echo '<th width="8%" class="no" style="font-size:10px;font-weight:600;">Discount</th>';
                                                                }
                                                                if($estimate_info->tax_type == 1 && $estimate_info->estimate_for == 1){
                                                                    $cols_no+= 2;
                                                                    echo '<th width="7%" class="no" style="font-size:10px;font-weight:600;">CGST</th>';
                                                                    echo '<th width="7%" class="no" style="font-size:10px;font-weight:600;">SGST</th>';
                                                                }else{
                                                                    $cols_no+= 1;
                                                                    echo '<th width="8%" class="no" style="font-size:10px;font-weight:600;">IGST</th>';
                                                                }
                                                            ?>
                                                            <th class="no" style="font-size:10px;font-weight:600;">TAX AMT</th>
                                                            <th class="no" style="font-size:10px;font-weight:600;">AMOUNT</th>
                                                            <th class="no" style="font-size:10px;font-weight:600;">CHECK STATUS</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody class="main-table">
                                                        <?php 
                                                            $ttl_rate = $ttl_value = $total_price = 0;
                                                            if(!empty($estimate_info->items)){
                                                                
                                                                foreach ($estimate_info->items as $key => $value) {
                                                                    $qty = $value['qty'];
                                                                    $rate = $value['rate'];
                                                                    $weight = $value['weight'];
                                                                    $dis = $value['discount'];
                                                                    $prodtax = ($estimate_info->estimate_for == 1) ? $value['prodtax'] : 0.1;
                                                                    $totalmonths = 1;
                                                                    if($value['is_sale'] == 0){
                                                                        $totalmonths = ($value['months'] + ($value['days'] / 30));
                                                                        $price = ($rate * $qty * $totalmonths * $weight);
                                                                    }else{
                                                                        $price = ($rate * $qty * $weight);
                                                                    }

                                                                    $dis_price = ($price*$dis/100);
                                                                    $final_price = ($price - $dis_price);

                                                                    //Applying TAX after discount
                                                                    $tax_amt = ($final_price*$prodtax/100);
                                                                    $final_price = ($final_price+$tax_amt);
                                                                    $total_price += $final_price;

                                                                    if($value['rate_view'] > 0){
                                                                        $show_rate = $value['rate_view'];
                                                                    }else{
                                                                        $show_rate = $value['rate'];
                                                                    }

                                                                    $isOtherCharge = value_by_id('tblproducts',$value['pro_id'],'isOtherCharge');
                                                                    $show_qty = ($isOtherCharge == 0) ? $qty : '--';
                                                                    $ttl_rate += ($show_rate*$qty*$totalmonths);

                                                                    //getting material vlaue
                                                                    $ttl_value += get_material_value($value['pro_id'],$qty);

                                                                    $product_rmk = '';
                                                                    if(!empty($value['long_description'])){
                                                                        $product_rmk = '<p>'.$value['long_description'].'</p>';
                                                                    }

                                                                    echo '<tr>
                                                                            <td class="desc">'.++$key.'</td>
                                                                            <td class="desc"><b class="tb-title">'.cc(value_by_id('tblproducts',$value['pro_id'],'sub_name')).'</b>'.$product_rmk.get_productfields_list('tblestimateproductfields',$estimate_info->id,$value['pro_id']).'</td>
                                                                            <td class="desc">'.$show_qty.'</td>';
                                                                            if($estimate_info->measurement == 2){
                                                                                echo ' <td class="desc">'.$weight.'</td>';
                                                                            }
                                                                            echo '<td class="desc">'.$show_rate.'</td>';
                                                                            if($show_discount == 1){
                                                                                echo ' <td class="desc">'.$dis.'%</td>';
                                                                            }
                                                                            if($estimate_info->tax_type == 1 && $estimate_info->estimate_for == 1){
                                                                                $tax = ($prodtax/2);
                                                                                echo '<td class="desc">'.$tax.'%</td>';
                                                                                echo '<td class="desc">'.$tax.'%</td>';
                                                                            }else{
                                                                                echo '<td class="desc">'.$prodtax.'%</td>';
                                                                            }
                                                                            if (!empty($value['check_status'])){
                                                                                if ($value['check_status'] == 1){

                                                                                }
                                                                            }
                                                                            $itemcheck_status1 = ($value['check_status'] > 0 && $value['check_status'] == 1) ? 'selected':'';
                                                                            $itemcheck_status2 = ($value['check_status'] > 0 && $value['check_status'] == 2) ? 'selected':'';
                                                                            echo '<td class="desc">'.number_format(round($tax_amt), 2, '.', '').'</td>';
                                                                            echo '<td class="desc">'.number_format(round($final_price), 2, '.', '').'</td>
                                                                                <td class="desc">
                                                                                    <input type="hidden" name="estimatedata['.$key.'][item_id]" value="'.$value['id'].'">
                                                                                    <select class="form-control selectpicker" required="" onchange="showproremark('.$key.', this.value);" name="estimatedata['.$key.'][check_status]" id="warehouse_id">
                                                                                        <option value=""></option>
                                                                                        <option value="1" '.$itemcheck_status1.'>OK</option>
                                                                                        <option value="2" '.$itemcheck_status2.'>NOT OK</option>
                                                                                    </select>
                                                                                    <div class="proremark'.$key.'">';
                                                                                        if (!empty($value['not_ok_remark'])){
                                                                                            echo '<br>
                                                                                            <div class="col-md-12">
                                                                                                <textarea id="remark" placeholder="remark.." required="" name="estimatedata['.$key.'][remark]" class="form-control" rows="4">'.$value['not_ok_remark'].'</textarea>
                                                                                            </div>';
                                                                                        }
                                                                                echo '</div>
                                                                                </td>
                                                                        </tr>';
                                                                }
                                                            }  
                                                            $discount = 0;
                                                            if(!empty($estimate_info->discount_percent > 0)){
                                                               $discount = ($total_price*$estimate_info->discount_percent/100);
                                                      
                                                                $html .= '<tr>
                                                                                <td>Discount @ '.number_format($estimate_info->discount_percent).'%</td>
                                                                                <td>-'.number_format(round($discount), 2, '.', '').'</td>
                                                                            </tr>';
                                                      
                                                            } 
                                                            $othercharges_ttl = 0;
                                                            if(!empty($othercharges)){
                                                                foreach ($othercharges as $key => $value) {
                                                                    $total_price += $value['total_maount'];
                                                                    $othercharges_ttl += $value['total_maount'];

                                                                    echo '<tr>
                                                                            <td>'.$value['category_name'].'</td>
                                                                            <td>'.number_format(round($value['total_maount']), 2, '.', '').'</td>
                                                                        </tr>';
                                                                }

                                                                if($estimate_info->other_charges_tax == 2){

                                                                    $other_tax_amt = ($othercharges_ttl*18/100);
                                                                    $total_price = ($other_tax_amt+$total_price);
                                                                    if($estimate_info->tax_type == 1 && $estimate_info->estimate_for == 1){
                                                                        $single_other_tax_amt = ($othercharges_ttl*9/100);

                                                                        echo '<tr>
                                                                                <td>CGST @ 9%</td>
                                                                                <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                                                                            </tr>';
                                                                        echo '<tr>
                                                                                <td>SGST @ 9%</td>
                                                                                <td>'.number_format(round($single_other_tax_amt), 2, '.', '').'</td>
                                                                            </tr>';
                                                                    }else{
                                                                        echo '<tr>
                                                                                <td>IGST @ 18%</td>
                                                                                <td>'.number_format(round($other_tax_amt), 2, '.', '').'</td>
                                                                            </tr>';
                                                                    }
                                                                }
                                                            } 
                                                            $final_amount = ($total_price - $discount);
                                                        ?>

                                                        <tfoot>
                                                            <tr><tr><td colspan="<?php echo $cols_no; ?>" class="text-center"><h4>GRAND TOTAL</h4></td><td><h4><?php echo number_format(round($final_amount), 2); ?></h4></td></tr></tr>
                                                        </tfoot>
                                                    </tbody>
                                                </table>        
                                            </div>
                                        </div>
                                    </fieldset>    
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-6">
                                    <fieldset class="for-panel">
                                        <legend>Terms & Conditions Verification :</legend>
                                        <div class="col-md-12">
                                            <div class="termsList"><?php echo getAllTermsConditions($estimate_info->id, "estimate"); ?></div> 
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <br><br>
                                                    <div class="form-group">
                                                        <label for="check_status">Check Status</label>
                                                        <select class="form-control selectpicker" required="" onchange="showconditionremark(this.value);" name="check_status" id="warehouse_id">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo ($estimate_info->t_c_check_status == 1) ? 'selected':''; ?>>OK</option>
                                                            <option value="2" <?php echo ($estimate_info->t_c_check_status == 2) ? 'selected':''; ?>>NOT OK</option>
                                                        </select>
                                                    </div>            
                                                </div>
                                                <div class="col-md-8 condition-remark-div">
                                                    <?php 
                                                        if (!empty($estimate_info->t_c_notok_remark)){
                                                        echo '<br>
                                                            <div class="form-group">
                                                                <label for="check_status">Remark</label>
                                                                <textarea id="remark" placeholder="remark.." required="" name="t_c_notok_remark" class="form-control" rows="4">'.$estimate_info->t_c_notok_remark.'</textarea>
                                                            </div>';
                                                        }    
                                                    ?>
                                                </div>            
                                            </div>               
                                        </div>    
                                    </fieldset>
                                </div>   
                                <div class="col-md-6">
                                    
                                    <fieldset class="for-panel">
                                        <legend>Final Verification :</legend>
                                        <div class="col-md-12">
                                            <div class="row">
                                                <div class="col-md-4">
                                                    <br><br>
                                                    <div class="form-group">
                                                        <label for="check_status">Verified Status</label>
                                                        <select class="form-control selectpicker" required="" name="final_check_status" id="final_check_status">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo ($estimate_info->final_check_status == '1') ? 'selected':''; ?>>OK</option>
                                                            <option value="2" <?php echo ($estimate_info->final_check_status == '2') ? 'selected':''; ?>>NOT OK</option>
                                                        </select>
                                                    </div>            
                                                </div>
                                                <div class="col-md-8 final-remark-div">
                                                    <br><div class="form-group">
                                                        <label for="check_status">Remark</label>
                                                        <textarea id="remark" placeholder="remark.." required="" name="final_notok_remark" class="form-control" rows="4"><?php echo (!empty($estimate_info->final_notok_remark)) ? $estimate_info->final_notok_remark : ''; ?></textarea>
                                                    </div>
                                                </div>            
                                            </div>               
                                        </div>    
                                    </fieldset>
                                </div>       
                            </div>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Submit
                                </button>
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
    function showproremark(id, val){
        $(".proremark"+id).html('');
        if (val == 2){
            $(".proremark"+id).html('<br><div class="col-md-12"><textarea id="remark" placeholder="remark.." required="" name="estimatedata['+id+'][remark]" class="form-control" rows="4"></textarea></div>');
        }
    }
    function showconditionremark(val){
        $(".condition-remark-div").html('');
        if (val == 2){
            $(".condition-remark-div").html('<br><div class="form-group"><label for="check_status">Remark</label><textarea id="remark" placeholder="remark.." required="" name="t_c_notok_remark" class="form-control" rows="4"></textarea></div>');
        }
    }
    // function showfinalremark(val){
    //     $(".final-remark-div").html('');
    //     if (val == 2){
    //         $(".final-remark-div").html('<br><div class="form-group"><label for="check_status">Remark</label><textarea id="remark" placeholder="remark.." required="" name="final_notok_remark" class="form-control" rows="4"></textarea></div>');
    //     }
    // }
</script>    
</body>
</html>

<?php init_head(); ?>
<style>
    /*Invoice*/
    .invoice .top-left {
        font-size:65px;
        color:#3ba0ff;
    }

    .invoice .top-right {
        text-align:right;
        padding-right:20px;
    }

    .invoice .table-row {
        margin-left:-15px;
        margin-right:-15px;
        margin-top:25px;
    }

    .invoice .payment-info {
        font-weight:500;
    }

    .invoice .table-row .table>thead {
        border-top:1px solid #ddd;
    }

    .invoice .table-row .table>thead>tr>th {
        border-bottom:none;
    }

    .invoice .table>tbody>tr>td {
        padding:8px 20px;
    }

    .invoice .invoice-total {
        margin-right:-10px;
        font-size:16px;
    }

    .invoice .last-row {
        border-bottom:1px solid #ddd;
    }

    .invoice-ribbon {
        width:85px;
        height:88px;
        overflow:hidden;
        position:absolute;
        top:-1px;
        right:14px;
    }

    .ribbon-inner {
        text-align:center;
        -webkit-transform:rotate(45deg);
        -moz-transform:rotate(45deg);
        -ms-transform:rotate(45deg);
        -o-transform:rotate(45deg);
        position:relative;
        padding:7px 0;
        left:-5px;
        top:11px;
        width:120px;
        font-size:12px;
        color:#fff;
    }
    .ribbon-bg-succss {
        background-color:#66c591;
    }
    .ribbon-bg-danger {
        background-color: #E13300;
    }
    .ribbon-bg-pending {
        background-color: #e6e62a;
    }

    .ribbon-inner:before,.ribbon-inner:after {
        content:"";
        position:absolute;
    }

    .ribbon-inner:before {
        left:0;
    }

    .ribbon-inner:after {
        right:0;
    }

    @media(max-width:575px) {
        .invoice .top-left,.invoice .top-right,.invoice .payment-details {
            text-align:center;
        }

        .invoice .from,.invoice .to,.invoice .payment-details {
            float:none;
            width:100%;
            text-align:center;
            margin-bottom:25px;
        }

        .invoice p.lead,.invoice .from p.lead,.invoice .to p.lead,.invoice .payment-details p.lead {
            font-size:22px;
        }

        .invoice .btn {
            margin-top:10px;
        }
    }

    @media print {
        .invoice {
            width:900px;
            height:800px;
        }
    }
    .invoice-header {
        margin: 0 -20px;
        margin-bottom: 0px;
        background: #f5f6f9;
        padding: 20px;
    }
    .invoice-price {
        background: #f0f3f4;
        display: table;
        width: 100%
    }

    .invoice-price .invoice-price-left,
    .invoice-price .invoice-price-right {
        display: table-cell;
        padding: 20px;
        font-size: 20px;
        font-weight: 600;
        width: 75%;
        position: relative;
        vertical-align: middle
    }

    .invoice-price .invoice-price-left .sub-price {
        display: table-cell;
        vertical-align: middle;
        padding: 0 20px
    }

    .invoice-price small {
        font-size: 12px;
        font-weight: 400;
        display: block
    }

    .invoice-price .invoice-price-row {
        display: table;
        float: left
    }

    .invoice-price .invoice-price-right {
        width: 25%;
        background: #2d353c;
        color: #fff;
        font-size: 28px;
        text-align: right;
        vertical-align: bottom;
        font-weight: 300
    }

    .invoice-price .invoice-price-right small {
        display: block;
        opacity: .6;
        position: absolute;
        top: 10px;
        left: 10px;
        font-size: 12px
    }
.h3, h3 {
    font-size: 16px;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            <div class="container bootstrap snippets bootdeys">
                <div class="row">
                    <div class="col-sm-12">
                        <div class="panel panel-default invoice" id="invoice">
                            <div class="panel-body">

                                <?php
                                    if($purchase->status == 0){
                                        echo '<div class="invoice-ribbon"><div class="ribbon-inner ribbon-bg-pending">PENDING</div></div>';
                                    }elseif($purchase->status == 1){
                                        echo '<div class="invoice-ribbon"><div class="ribbon-inner ribbon-bg-succss">APPROVED</div></div>';
                                    }elseif($purchase->status == 2){
                                        echo '<div class="invoice-ribbon"><div class="ribbon-inner ribbon-bg-danger">APPROVED</div></div>';
                                    }
                                ?>
                            <div id="printarea">
                                <div class="row">
                                    <div class="col-sm-6 top-left">
                                        <?php
                                        $company_info = get_company_details();
                                        $po_number = (is_numeric($purchase->number)) ? 'PO-'.$purchase->number : $purchase->number;
                                        ?>
                                        <img style="margin-bottom:10px;" width="150" height="50" src="<?php echo site_url(); ?>uploads/company/logo.png">
                                        <h3 style="margin-top:0; margin-bottom:0px;"><?php echo $company_info['company_name']; ?> </h3>
                                    </div>
                                    <div class="col-sm-6 top-right">
                                        <h3 class="marginright"><?php echo $po_number;?></h3>
                                        <span class="marginright"><?php echo date("d-M-Y", strtotime($purchase->date)); ?></span>
                                    </div>
                                </div>
                                <hr>
                                <div class="row invoice-header">
                                    <div class="col-xs-4 from">
                                        <?php
                                            $vendor_info = get_vendor_info($purchase->vendor_id);
                                        ?>
                                        <p class="lead marginbottom">To : <?php echo $vendor_info['name']; ?></p>
                                        <hr>
                                        <p><b>Address :</b> <?php echo $vendor_info['address'].",".$vendor_info['city'],",".$vendor_info['state']; ?></p>
                                        <p><b>PAN No. :</b> <?php echo $vendor_info['pan_no']; ?></p>
                                        <p><b>GST No. :</b> <?php echo $vendor_info['gst']; ?></p>
                                        <p><b>Phone :</b> <?php echo $vendor_info['phone']; ?></p>
                                        <p><b>Email :</b> <?php echo $vendor_info['email']; ?></p>
                                    </div>
                                    <div class="col-xs-4 to">
                                        <?php $branch_info = $this->db->query("SELECT * FROM `tblcompanybranch` where id = '".$purchase->billing_branch_id."' ")->row(); ?>
                                        <p class="lead marginbottom">Bill To : <?php echo $company_info['company_name'];?></p>
                                        <hr>
                                        <p><b>Address :</b> <?php echo $branch_info->address; ?></p>
                                        <p><b>PAN No. :</b> AAVCS4630C</p>
                                        <p><b>GST No. :</b> <?php echo $branch_info->gst_no; ?></p>
                                        <p><b>Contact Person :</b> <?php echo $branch_info->contact_person; ?></p>
                                        <p><b>Contact No. :</b> <?php echo $branch_info->phone_no_1; ?></p>
                                        <p style="text-transform:none;"><b>Email :</b> admin@schachengineers.com</p>
                                    </div>
                                    <?php
                                        if($purchase->source_type == 1){
                                        $warehouse_info = get_warehouse_info($purchase->warehouse_id);
                                    ?>
                                            <div class="col-xs-4 text-right payment-details">
                                                <p class="lead marginbottom payment-info">Ship To: <?php echo $company_info['company_name']; ?></p>
                                                <hr>
                                                <p><b>Address:</b> <?php echo $warehouse_info['address']; ?></p>
                                                <p><b>Contact Person :</b> <?php echo $warehouse_info['cont_name']; ?> </p>
                                                <p><b>Contact No. :</b> <?php echo $warehouse_info['phone']; ?> </p>
                                            </div>
                                    <?php
                                        }else{
                                            $shipto_info = get_ship_to_array($purchase->site_id);
                                    ?>
                                            <div class="col-xs-4 text-right payment-details">
                                                <p class="lead marginbottom payment-info">Ship To: <?php echo $shipto_info['name']; ?></p>
                                                <hr>
                                                <p><b>Address:</b> <?php echo $shipto_info['address'].', '.$shipto_info['city'].', '.$shipto_info['state']; ?></p>
                                                <p><b>Landmark :</b> <?php echo $shipto_info['landmark']; ?> </p>
                                                <p><b>Zip :</b> <?php echo $shipto_info['zip']; ?> </p>';
                                            </div>
                                    <?php } ?>


                                </div>
                                <?php
                                    $tax_type = get_vendor_gst_type($purchase->vendor_id);
                                    $po_items = get_po_items_list($purchase->id);

                                    $show_discount = 0;
                                    if(!empty($po_items)){
                                        foreach ($po_items as $key => $value) {
                                            if($value['discount'] > 0){
                                                $show_discount = 1;
                                            }
                                        }
                                    }
                                ?>
                                <div class="row table-row table-responsive">
                                    <table class="table table-striped">
                                        <thead>
                                            <tr>
                                                <th class="text-center" style="width:5%">#</th>
                                                <th style="width:50%">Item Description</th>
                                                <th class="text-right" style="width:8%">Quantity</th>
                                                <th class="text-right" style="width:8%">Unit</th>
                                                <th class="text-right" style="width:8%">Rate</th>
                                                <?php if ($show_discount == '1'){ ?>
                                                <th class="text-right" style="width:8%">DISCOUNT</th>
                                                <?php } ?>
                                                <?php if(!empty($tax_type == 1)){ ?>
                                                <th class="text-right" style="width:8%">CGST</th>
                                                <th class="text-right" style="width:8%">SGST</th>
                                                <?php }else{ ?>
                                                    <th class="text-right" style="width:15%">IGST</th>
                                                <?php } ?>
                                                <th class="text-right" style="width:15%">Tax Amount</th>
                                                <th class="text-right" style="width:15%">Total</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($po_items)){
                                                    $total_price = $shown_total_price = $tax_amt = 0;
                                                    foreach ($po_items as $key => $value) {
                                                        $qty = $value['qty'];
                                                        $rate = $value['price'];
                                                        $price = ($rate * $qty);
                                                        $discount_amt = $price - (($price * $value['discount']) / 100);
                                                        //Applying TAX after discount
                                                        if ($purchase->tax_type == 2) {
                                                            $tax_amt = ($discount_amt * $value['prodtax'] / 100);
                                                            $final_price = ($discount_amt + $tax_amt);
                                                        } else {
                                                            $final_price = $discount_amt;
                                                        }
                                                        
                                                        $total_price += number_format($final_price, 2, '.', '');

                                                        if ($value['hsn_code'] == 2) {
                                                            $hsn_sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '" . $value['product_id'] . "' ")->row();
                                                        } else {
                                                            $hsn_sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '" . $value['product_id'] . "' ")->row();
                                                        }
                                                        $hsn_sac_code = (!empty($hsn_sac_code)) ? $hsn_sac_code->field_value: "";

                                                        $remk = (!empty($value['remark'])) ? '<br>'. $value['remark'] : "";
                                                        if ($value["is_temp"] == 0){

                                                            $unit_id = ($value['unit_id'] > 0) ? $value['unit_id'] : value_by_id_empty('tblproducts', $value['product_id'], 'unit_2');
                                                            $product_name = value_by_id('tblproducts', $value['product_id'], 'sub_name');

                                                            if ($value['hsn_code'] == 2) {
                                                                $hsn_sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 2 and pcf.status = 1 and pf.product_id = '" . $value['product_id'] . "' ")->row();
                                                            } else {
                                                                $hsn_sac_code = $this->db->query("SELECT pf.field_value  FROM tblproductsfield as pf LEFT JOIN tblproductcustomfields as pcf ON pcf.id = pf.field_id where pcf.field_for = 1 and pcf.status = 1 and pf.product_id = '" . $value['product_id'] . "' ")->row();
                                                            }
                                                            $hsn_sac_code = (!empty($hsn_sac_code)) ? $hsn_sac_code->field_value: "";
                                                        }else{
                                                            $unit_id = ($value['unit_id'] > 0) ? $value['unit_id'] : value_by_id_empty('tbltemperoryproduct', $value['product_id'], 'unit');
                                                            $product_name = $value["product_name"];
                                                            if($value['hsn_code'] == 2){
                                                                $hsn_sac_code = value_by_id('tbltemperoryproduct',$value['product_id'],'sac');
                                                            }else{
                                                              $hsn_sac_code = value_by_id('tbltemperoryproduct',$value['product_id'],'hsn');
                                                            }
                                                            $hsn_sac_code = (!empty($hsn_sac_code)) ? $hsn_sac_code->field_value: "";
                                                        }
                                                ?>
                                                    <tr>
                                                        <td class="text-center"><?php echo ++$key; ?></td>
                                                        <td><?php echo $product_name . '' . getPoVendorProductName($purchase->vendor_id, $value['product_id']) . $remk . '<br>HSN/SAC : ' . $hsn_sac_code . ''; ?></td>
                                                        <td class="text-right"><?php echo $qty; ?></td>
                                                        <td class="text-right"><?php echo value_by_id('tblunitmaster', $unit_id, 'name'); ?></td>
                                                        <td class="text-right"><?php echo $rate; ?></td>
                                                        <?php if ($show_discount == '1'){ ?>
                                                        <td class="text-right"><?php echo $value['discount'].'%'; ?></td>
                                                        <?php } ?>
                                                        <?php
                                                            if(!empty($tax_type == 1)){
                                                                $tax = ($value['prodtax']/2);
                                                                echo ' <td class="desc text-center">'.$tax.'%</td>';
                                                                echo ' <td class="desc text-center">'.$tax.'%</td>';
                                                            }
                                                            else{
                                                                echo '<td class="text-right">'.number_format($value['prodtax'], 0, '.', '').'%</td>';
                                                            }
                                                        ?>
                                                        <td class="text-right"><?php echo number_format($tax_amt, 2, '.', ''); ?></td>
                                                        <td class="text-right"><?php echo number_format($final_price, 2, '.', ''); ?></td>
                                                    </tr>
                                                <?php
                                                    }
                                                }
                                                $othercharges= $this->db->query("SELECT * FROM `tblpurchaseothercharges` where `proposalid`='".$purchase->id."' and category_name > 0 ")->result_array();
                                            ?>
                                        </tbody>
                                    </table>

                                </div>
                                <div class="invoice-price">
                                    <div class="invoice-price-left">
                                        <div class="invoice-price-row">
                                            <div class="sub-price"> <small>SUBTOTAL</small> <span class="text-inverse"><?php echo number_format($total_price, 2, '.', ''); ?></span></div>

                                            <?php

                                               $othercharges_ttl = 0;
                                                if(!empty($othercharges)){
                                                  foreach ($othercharges as $key => $value) {
                                                      $total_price += $value['total_maount'];
                                                      $othercharges_ttl += $value['total_maount'];
                                                        echo '<div class="sub-price"> <i class="fa fa-plus text-muted"></i></div><div class="sub-price"> <small>'.  strtoupper(value_by_id('tblotherchargemaster',$value['category_name'],'category_name')).'</small> <span class="text-inverse">'.number_format(round($value['total_maount']), 2, '.', '').'</span></div>
                                                              ';

                                                   }

                                                   if($purchase->other_charges_tax == 2){

                                                        $other_tax_amt = ($othercharges_ttl*18/100);
                                                        $total_price = ($other_tax_amt+$total_price);
                                                          if(!empty($tax_type == 1)){
                                                           $single_other_tax_amt = ($othercharges_ttl*9/100);
                                                           echo '<div class="sub-price"> <i class="fa fa-plus text-muted"></i></div><div class="sub-price"> <small>CGST (9%)</small> <span class="text-inverse">'.number_format($single_other_tax_amt, 2, '.', '').'</span></div>
                                                              ';
                                                           echo '<div class="sub-price"> <i class="fa fa-plus text-muted"></i></div><div class="sub-price"> <small>SGST (9%)</small> <span class="text-inverse">'.number_format($single_other_tax_amt, 2, '.', '').'</span></div>';
                                                        }else{
                                                            echo '<div class="sub-price"> <i class="fa fa-plus text-muted"></i></div><div class="sub-price"> <small>IGST (18%)</small> <span class="text-inverse">'.number_format($other_tax_amt, 2, '.', '').'</span></div>';
                                                        }
                                                   }

                                               }
                                               $discount = 0;
                                                $discount_percent = $purchase->finaldiscountpercentage;
                                                if(!empty($discount_percent > 0)){
                                                  $discount = ($total_price*$discount_percent/100);
                                                  echo '<div class="sub-price"> <i class="fa fa-minus text-muted"></i></div><div class="sub-price"> <small>DISCOUNT ('.number_format($discount_percent).'%)</small> <span class="text-inverse">'.number_format($discount, 2, '.', '').'</span></div>';
                                                }else if($purchase->finaldiscountamount > 0){
                                                    $discount = $purchase->finaldiscountamount;
                                                    echo '<div class="sub-price"> <i class="fa fa-minus text-muted"></i></div><div class="sub-price"> <small>DISCOUNT</small> <span class="text-inverse">'.number_format($purchase->finaldiscountamount, 2, '.', '').'</span></div>';
                                                }
                                                $final_amount = ($total_price - $discount);
                                                if ($purchase->roundoff_amount != '0.00'){
                                                    $final_amount = $final_amount + $purchase->roundoff_amount;
                                                    echo '<div class="sub-price"> </div><div class="sub-price"> <small>ROUND OFF AMOUNT</small><span class="text-inverse">'.number_format($purchase->roundoff_amount, 2, '.', '').'</span></div>';
                                                }

                                            ?>
                                        </div>
                                    </div>
                                    <div class="invoice-price-right"> <small>GRAND TOTAL</small> <span class="f-w-600"><?php echo number_format($final_amount, 2, '.', ''); ?></span><br></div>
                                </div>

                                <br>
                                <div class="row">
                                    <div class="col-sm-12">
                                        <p style="margin-left: 60%;" >Amount In Words : <?php echo convert_number_to_words($final_amount); ?></p>
                                    </div>
                                </div>
                                <div class="row">
                                    <div class="col-sm-12 top-left">
                                        <h4>TERMS AND CONDITIONS :</h4>
                                        <hr>

                                    </div>
                                    <div class="col-sm-12"><?php echo get_terms_conditions("purchase_order") ?></div>
                                </div>
                                <br>
                                <br>
                                </div>
                                <div class="row">
                                    <div class="col-xs-6 margintop">
                                        <!--<p class="lead marginbottom">THANK YOU!</p>-->
                                        <button class="btn btn-success" onclick="jQuery('#printarea').print()" id="invoice-print1"><i class="fa fa-print"></i> Print</button>
                                        <!--<button class="btn btn-danger"><i class="fa fa-envelope-o"></i> Mail Invoice</button>-->
                                    </div>
                                    <!--                                    <div class="col-xs-6 text-right pull-right invoice-total">
                                                                            <p>Subtotal : $1019</p>
                                                                            <p>Discount (10%) : $101 </p>
                                                                            <p>VAT (8%) : $73 </p>
                                                                            <p>Total : $991 </p>
                                                                        </div>-->
                                </div>

                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jQuery.print/1.6.0/jQuery.print.js"></script>
<script type="text/javascript">
  function printDiv()
{
    var newWindow = window.open();
    newWindow.document.write(document.getElementById("printarea").innerHTML);
    newWindow.print();
}
</script>
</body>
</html>

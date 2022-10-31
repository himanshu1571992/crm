<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}.ui-table > thead > tr > th {border:1px solid #9d9d9d !important;color: #fff !important; background:#6d7580;}.ui-table > tbody > tr > td{border: 1px solid #c7c7c7;color:#5f6670;}.ui-table > tbody > tr:nth-child(even) {background: #f8f8f8;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->
<div class="modal fade" id="contact" tabindex="-1" role="dialog" aria-labelledby="myModalLabel">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <?php echo form_open('admin/clients/contact/' . $customer_id . '/' . $contactid, array('id' => 'contact-form', 'autocomplete' => 'off')); ?>



            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
                <h4 class="modal-title" id="myModalLabel"><?php echo $title; ?><br /><small class="color-white" id=""><?php echo get_company_name($customer_id, true); ?></small></h4>
            </div>
            <?php echo form_close(); ?>
        </div>
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
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            
                            <?php
                            $po_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$payment_info['po_id']."' ")->row();
                            $payment_list = $this->db->query("SELECT * from tblpurchaseorderpayments where po_id = '".$payment_info['po_id']."' and status = 1 ")->result();
                            $venderpayment = $this->db->query("SELECT SUM(ttl_amt) as total_amt FROM `tblvendorpayment` WHERE `vendor_id`= ".$po_info->vendor_id." AND `payment_behalf` = 1 ")->row();
                            $po_debitnote = $this->db->query("SELECT SUM(totalamount) as ttldebit_amt FROM `tblpurchasedabitnote`  WHERE vender_id = '".$po_info->vendor_id."' AND complete = 0")->row();
                            $ttlpaidamount = $this->db->query("SELECT SUM(approved_amount) as ttlamount from tblpurchaseorderpayments where po_id = '".$payment_info['po_id']."' and status = 1 ")->row()->ttlamount;
                            ?>

                            <div class="col-md-12">
                                <div class="row panelHead">
                                    <div class="col-xs-12 col-md-6">
                                        <h4>
                                        <?php  
                                            $title = "Purchase Order Payment Approval";
                                            if ((isset($po_info->order_type)) && $po_info->order_type == 2){
                                                $title = "Work Order Payment Approval";
                                            }
                                            echo $title;
                                        ?>
                                     </h4>
                                    </div>
                                </div>
                                <hr class="hr-panel-heading">
                            </div>
                            <h3 style="text-align:center">Total On Account Amount : <span style="color:red">(<?php echo (!empty($venderpayment->total_amt) ? $venderpayment->total_amt : "0.00"); ?>/-)</span><br>
                            <a style="align:center" title="View PDF" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$payment_info['po_id']); ?>"><?php echo "PO-".value_by_id('tblpurchaseorder',$payment_info['po_id'],'number'); ?> <small>(Click for Pdf)</small></a></h3>

                            <hr/>
                            <div class="lead-view" id="leadViewWrapper">
                                <div class="col-md-6 col-xs-12 lead-information-col">
                                    <div class="lead-info-heading">
                                    <h4 class="no-margin font-medium-xs bold">Purchase Order Information </h4>
                                    </div>
                                    <p class="text-muted lead-field-heading no-mtop">Purchase Order No.</p>
                                    <p class="bold font-medium-xs lead-name"><a  title="View PDF" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$payment_info['po_id']); ?>"><?php echo "PO-".value_by_id('tblpurchaseorder',$payment_info['po_id'],'number'); ?> <small>(Click for Pdf)</small></a></p>
                                    <p class="text-muted lead-field-heading">Vendor Name</p>
                                    <p class="bold font-medium-xs"><a href="<?php echo base_url("admin/vendor/vendor_payment/" . $po_info->vendor_id);?>" target="_blank"><?php echo value_by_id('tblvendor',$po_info->vendor_id,'name'); ?></a></p>
                                    <p class="text-muted lead-field-heading">PO Amount</p>
                                    <p class="bold font-medium-xs"><?php echo value_by_id('tblpurchaseorder',$payment_info['po_id'],'totalamount'); ?></p>
                                    <?php if ($payment_info['percentage'] > 0){ ?>
                                        <p class="text-muted lead-field-heading">Percent</p>
                                        <p class="bold font-medium-xs"><?php echo $payment_info['percentage']; ?> %</p>
                                    <?php } ?>
                                    <?php if ($ttlpaidamount > 0){ ?>
                                        <p class="text-muted lead-field-heading">Paid Amount</p>
                                        <p class="bold font-medium-xs"><a target="_blank" href="<?php echo base_url("admin/purchase/purchaseorder_payments/" . $payment_info['po_id']);?>"><?php echo number_format($ttlpaidamount,2); ?></a></p>
                                    <?php } ?>
                                </div>
                                <div class="col-md-6 col-xs-12 lead-information-col">
                                    <div class="lead-info-heading">
                                        <h4 class="no-margin font-medium-xs bold">General Information</h4>
                                    </div>
                                    <p class="text-muted lead-field-heading">Request Amount</p>
                                    <p class="bold font-medium-xs"><?php echo $payment_info['amount']; ?></p>
                                    <p class="text-muted lead-field-heading">Payment By</p>
                                        <?php
                                            if($payment_info['payment_by'] == 1){
                                                echo '<p>Direct Payment</p>';
                                            }elseif ($payment_info['payment_by'] == 2) {
                                                echo '<p>Petty Cash</p>';
                                            }elseif ($payment_info['payment_by'] == 3) {
                                                echo '<p>Purchase Debit Note</p>';
                                            }elseif ($payment_info['payment_by'] == 4) {
                                                echo '<br><p ><a href="javascript:void(0);" class="btn-sm btn-info" onclick="getpaymentadjustment('.$payment_info['id'].')">Adjustment Payment</a></p>';
                                            }
                                        ?>
                                    <p class="text-muted lead-field-heading">Request Date</p>
                                    <p class="bold font-medium-xs"><?php echo  _d($payment_info['created_at']); ?></p>
                                    <p class="text-muted lead-field-heading">Sender Remark</p>
                                    <p class="bold font-medium-xs"><?php echo $payment_info['remark']; ?></p>
                                    <?php if(!empty($payment_info['payment_type'])) { ?>
                                    <p class="text-muted lead-field-heading">Payment Type</p><br>
                                    <p class="bold font-medium-xs"><?php

                                        switch ($payment_info['payment_type']) {
                                            case 1:
                                                echo "<span class='btn-sm btn-primary'>Advance payment against PO/Proforma</span>";
                                                break;
                                            case 2:
                                                echo "<span class='btn-sm btn-success'>Advance payment against material readiness</span>";
                                                break;
                                            case 3:
                                                echo "<span class='btn-sm btn-info'>Against delivery</span>";
                                                break;
                                            case 4:
                                                echo "<span class='btn-sm btn-danger'>Against MR</span>";
                                                break;
                                            default:
                                                echo "--";
                                                break;
                                        }
                                    ?>
                                    </p>
                                    <?php } ?>
                                </div>
                            </div>
                            <?php
                            $payment_ttl_amt = $po_info->totalamount;
                            if ($payment_info['payment_by'] == 3) {
                                $payment_ttl_amt = $po_debitnote->ttldebit_amt;
                                $payment_id = $payment_info['id'];
                                $po_debitnote_pytlog = $this->db->query("SELECT * FROM `tblpurchasedebitnoteregistered` WHERE `payment_id` = ".$payment_id." AND `status` = 1")->result();
                            ?>
                            <hr>
                            <div class="col-md-12" style="margin-top: 20px;">
                                <h4 class="no-mtop mrg3">Purchase Debit Note Details</h4>
                                <hr>
                                <table class="table ui-table">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Dabitnote No.</th>
                                            <th>Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ttl_dpaid = 0;
                                        if (!empty($po_debitnote_pytlog)) {
                                            $z = 1;
                                            foreach ($po_debitnote_pytlog as $row) {
                                                $ttl_dpaid += $row->amount;
                                                ?>
                                                <tr>
                                                    <td><?php echo $z++; ?></td>
                                                    <td><a href="<?php echo base_url("admin/purchasechallanreturn/download_debitnotepdf/" . $row->debitnote_id); ?>" target="_blank"><?php echo 'PDN-' . str_pad($row->debitnote_id, 4, '0', STR_PAD_LEFT) . ''; ?></a></td>
                                                    <td><?php echo $row->amount; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="2" class="text-center"><bold>Total Amount</bold></td>
                                        <td><?php echo number_format($ttl_dpaid, 2, '.', ''); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        echo '<tr><td class="text-center" colspan="3"><h5>No Payments</h5></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php } ?>
                            <hr>
                            <div class="col-md-12 table-responsive" style="margin-top: 20px;">
                                <h4 class="no-mtop mrg3">Last Payment Details</h4>
                                <hr>
                                <table class="table ui-table">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Date</th>
                                            <th>Remark</th>
                                            <th>Payment By</th>
                                            <th>UTR</th>
                                            <th>Amount</th>
                                            
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $ttl_paid = 0;
                                        if (!empty($payment_list)) {
                                            $z = 1;
                                            foreach ($payment_list as $row) {
                                                $ttl_paid += $row->approved_amount;
                                                $payment_by = "";
                                                    if ($row->payment_by == 1){
                                                        $payment_by = "<span class='label label-primary'>Direct Payment</span>";
                                                    }elseif($row->payment_by == 2){
                                                        $payment_by = "<span class='label label-info'>Petty Cash</span>";
                                                    }elseif($row->payment_by == 3){
                                                        $payment_by = "<span class='label label-success'>Debit Note</span>";
                                                    }elseif($row->payment_by == 4){
                                                        $payment_by = "<span class='label label-warning' onclick='getpaymentadjustment(".$row->id.")'>Payment Adjustment</span>";
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $z++; ?></td>
                                                    <td><?php echo _d($row->created_at); ?></td>
                                                    <td><?php echo $row->remark; ?></td>
                                                    <td><?php echo $payment_by ?></td>
                                                    <td>
                                                        <?php
                                                            if ($row->payment_by == 1){
                                                                if ($row->status == 1 && $row->utr_no == null) {

                                                                    echo '<button type="button" class="btn-warning btn-sm utr" value="' . $row->id . '" data-toggle="modal" data-target="#utrModal">Pending</button>';
                                                                } elseif ($row->status == 1 && $row->utr_no != null) {
                                                                    echo '<button type="button" class="btn-success btn-sm utr" value="' . $row->id . '" data-toggle="modal" data-target="#utrModal">' . $row->utr_no . '</button>';
                                                                } else {
                                                                    echo '--';
                                                                }
                                                            }elseif($row->payment_by == 2){
                                                               echo 'By Patty Cash';
                                                            }elseif ($row->payment_by == 3) {
                                                                  echo 'By Debit Note <br>';
                                                                if (!empty($row->debitnote_ids)){
                                                                    $dn_ids = explode(",", $row->debitnote_ids);
                                                                    foreach ($dn_ids as $d_id) {
                                                                        echo '<a href="'. base_url("admin/purchasechallanreturn/download_debitnotepdf/" . $d_id).'" target="_blank">PDN-'.str_pad($d_id, 4, "0", STR_PAD_LEFT).'</a><br>';
                                                                    }
                                                                }
                                                            }else{
                                                              echo "--";
                                                            }

                                                        ?>
                                                    </td>
                                                    <td><?php echo $row->approved_amount; ?></td>
                                                    
                                                </tr>
                                                <?php
                                            }
                                            ?>
                                            <tr>
                                                <td colspan="5" class="text-center"><bold>Balance Amount</bold></td>
                                        <td><?php echo number_format(($payment_ttl_amt - $ttl_paid), 2, '.', ''); ?></td>
                                        </tr>
                                        <?php
                                    } else {
                                        echo '<tr><td class="text-center" colspan="5"><h5>No Payments</h5></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <hr>
                            <div class="col-md-12 table-responsive" style="margin-top: 20px;">
                                <h4 class="no-mtop mrg3">Approved Amount Details</h4>
                                <hr>
                                <table class="table ui-table">
                                    <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Remark</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                    </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($approval_amount)){
                                        $i=1;
                                        foreach($approval_amount as $row){

                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo get_employee_name($row->staff_id);?></td>
                                                <td><?php echo $row->remark;?></td>
                                                <td><?php echo $row->approved_amount;?></td>
                                                <td><?php echo _d($row->updated_at);?></td>

                                            </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                            <?php if ($payment_info['tdsamount'] > 0){ ?>
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <h4 class="no-mtop mrg3">TDS</h4>
                                    <hr>
                                        <table class="table ui-table">
                                            <thead>
                                            <tr>
                                                <th>Percentage</th>
                                                <th>Amount</th>
                                                <th width="15%">Approve Amount</th>
                                                <th>Remark</th>
                                            </tr>
                                            </thead>
                                            <tbody>
                                                <tr>
                                                <td><?php echo $payment_info['tdspercentage']; ?></td>
                                                <td><?php echo $payment_info['tdsamount']; ?></td>
                                                <td><input type="text" class="form-control" name="tdsamount" value="<?php echo $payment_info['tdsamount']; ?>"></td>
                                                <td><?php echo $payment_info['tdsremark']; ?></td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                            <?php } ?>
                            <?php if ($payment_info['tcsamount'] > 0){ ?>
                                <div class="col-md-12" style="margin-top: 20px;">
                                    <h4 class="no-mtop mrg3">TCS</h4>
                                    <hr>
                                    <table class="table ui-table">
                                        <thead>
                                        <tr>
                                            <th>Percentage</th>
                                            <th>Amount</th>
                                            <th width="15%">Approve Amount</th>
                                            <th>Remark</th>
                                        </tr>
                                        </thead>
                                        <tbody>
                                            <tr>
                                            <td><?php echo $payment_info['tcspercentage']; ?></td>
                                            <td><?php echo $payment_info['tcsamount']; ?></td>
                                            <td><input type="text" name="tcsamount" class="form-control" value="<?php echo $payment_info['tcsamount']; ?>"></td>
                                            <td><?php echo $payment_info['tcsremark']; ?></td>
                                            </tr>
                                        </tbody>
                                    </table>
                                </div>
                            <?php } ?>
                        </div>
                        <?php
                        if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                            ?>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" name="submit" value="5" style="background-color: #f9d306;color:#fff;" class="btn">On Hold</button>
                                <button type="submit" name="submit" value="1" class="btn btn-success mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Accept
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

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>



                            </div>
                            <hr/>
                            <div class="col-md-3">
                                <div class="row" style="margin-top:6%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                       <div class="form-group" app-field-wrapper="approved_amount">
                                          <label>Approve Amount *</label>
                                          <input type="text" id="approved_amount" name="approved_amount" class="form-control" value="<?php echo $payment_info['approved_amount']; ?>">
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-9">

                                <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12 pull-right">
                                       <div class="form-group" app-field-wrapper="remark">
                                        <label>Remark *</label>
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; }?></textarea>
                                    </div>
                                    </div>
                                </div>




                            </div>
                            <div class="col-md-12">
                            
                                <?php 
                                    $html = '';
                                    if(!empty($po_info->specification)){
                                        $html .= '<h4 class="no-mtop mrg3"><u>Notes/Special Remarks :</u></h4><hr><div class="termsList">'.$po_info->specification.'</div><br><br>';

                                    }
                                    if(!empty($purchase_info->product_terms_and_conditions)){
                                        $html .= '<h4 class="no-mtop mrg3"><u>Product Terms and Conditions:</u></h4><hr><div class="termsList">'.$po_info->product_terms_and_conditions.'</div><br><br>';
                                    }
                                    $html .= '<h4 class="no-mtop mrg3"><u>General Terms and Conditions:</u></h4><hr><div class="termsList">'.getAllTermsConditions($po_info->id, "purchase_order").'</div>';
                                    echo $html;
                                ?>         
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
<div id="adjustmentpayemntdetails" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Adjustment Payment Details</h4>
            </div>
            <div class="modal-body">
                <div id="paymentadjustemnt_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<?php init_tail(); ?>

<script type="text/javascript">
    function getpaymentadjustment(paymentid){
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/getAdjustmentPoDetails'); ?>",
            data: {'id': paymentid},
            success: function (response) {
                if (response != '') {
                    $("#adjustmentpayemntdetails").modal("show");
                    $("#paymentadjustemnt_html").html(response);
                }
            }
        });
    }
</script>
</body>
</html>

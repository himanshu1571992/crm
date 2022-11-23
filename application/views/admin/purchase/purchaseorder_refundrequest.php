<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}.ui-table > thead > tr > th {border:1px solid #9d9d9d !important;color: #fff !important; background:#6d7580;}.ui-table > tbody > tr > td{border: 1px solid #c7c7c7;color:#5f6670;}.ui-table > tbody > tr:nth-child(even) {background: #f8f8f8;}</style>
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

<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'proposal-form', 'class' => '_propsal_form proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <?php

                                $po_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$payment_info['po_id']."' ")->row();

                                $payment_list = $this->db->query("SELECT * from tblpurchaseorderpayments where po_id = '".$payment_info['po_id']."' and status = 1 ")->result();
                                $venderpayment = $this->db->query("SELECT SUM(ttl_amt) as total_amt FROM `tblvendorpayment` WHERE `vendor_id`= ".$po_info->vendor_id." AND `payment_behalf` = 1 ")->row();

                            ?>
                            <h3 style="text-align:center">Total On Account Amount : <span style="color:red">(<?php echo (!empty($venderpayment->total_amt) ? $venderpayment->total_amt : "0.00"); ?>/-)</span><br>
                            <a style="align:center" title="View PDF" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$payment_info['po_id']); ?>"><?php echo "PO-".value_by_id('tblpurchaseorder',$payment_info['po_id'],'number'); ?> <small>(Click for Pdf)</small></a></h3>
                            <hr/>
              			        <div class="lead-view" id="leadViewWrapper">
              			             <div class="col-md-6 col-xs-12 lead-information-col">
              			                <div class="lead-info-heading">
              			                   <h4 class="no-margin font-medium-xs bold">Purchase Order Information </h4>
              			                </div>
              			                <p class="text-muted lead-field-heading no-mtop text-danger">Purchase Order No.</p>
              			                <p class="bold font-medium-xs lead-name"><a  title="View PDF" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$payment_info['po_id']); ?>"><?php echo "PO-".value_by_id('tblpurchaseorder',$payment_info['po_id'],'number'); ?> <small>(Click for Pdf)</small></a></p>
              			                <p class="text-muted lead-field-heading text-danger">Vendor Name</p>
              			                <p class="bold font-medium-xs"><?php echo value_by_id('tblvendor',$po_info->vendor_id,'name'); ?></p>
              			                <p class="text-muted lead-field-heading text-danger">PO Amount</p>
              			                <p class="bold font-medium-xs"><?php echo value_by_id('tblpurchaseorder',$payment_info['po_id'],'totalamount'); ?></p>
                                    
                                    <?php if (!empty($payment_info['reference_no'])) { ?>
                                      <p class="text-muted lead-field-heading text-danger">Reference No</p>
                			                <p class="bold font-medium-xs"><?php echo $payment_info['reference_no']; ?></p>
                                    <?php } ?>
              			             </div>
              			            <div class="col-md-6 col-xs-12 lead-information-col">
              			                <div class="lead-info-heading">
              			                   <h4 class="no-margin font-medium-xs bold">General Information</h4>
              			                </div>
                                    <div class="col-md-6">
                                        <p class="text-muted lead-field-heading text-danger">Refund Amount</p>
                			            <p class="bold font-medium-xs"><?php echo $payment_info['amount']; ?></p>
                                        <?php if (!empty($payment_info['payment_mode'])) { ?>
                                          <p class="text-muted lead-field-heading text-danger">Payment Mode</p>
                    			                <p class="bold font-medium-xs">
                                            <?php
                                                switch ($payment_info['payment_mode']) {
                                                  case '1':
                                                    echo 'Cheque';
                                                    break;
                                                  case '2':
                                                    echo 'NEFT';
                                                    break;
                                                  case '3':
                                                    echo 'Cash';
                                                    break;
                                                }
                                            ?>
                                          </p>
                                      <?php } ?>
                                      <p class="text-muted lead-field-heading text-danger">Payment Type</p>
                                      <?php
                                          if($payment_info['type'] == 1){
                                              echo '<p>Refund Type</p>';
                                          }elseif ($payment_info['type'] == 2) {
                                              echo '<p>Adjust Payment In Next PO</p>';
                                          }
                                      ?>
                                        <p class="text-muted lead-field-heading text-danger">Request Date</p>
                			            <p class="bold font-medium-xs"><?php echo  _d($payment_info['payment_date']); ?></p>
                                    </div>
                                    <div class="col-md-6">
                                        <?php if (!empty($payment_info['refund_to'])) { ?>
                			                <p class="text-muted lead-field-heading text-danger">Refund To</p>
                			                <p class="bold font-medium-xs"><?php echo ($payment_info['refund_to'] == 1) ? "Company Account": "Petty Cash"; ?></p>
                                        <?php } ?>
                                        <?php if (!empty($payment_info['pettycash_id']) && $payment_info['pettycash_id'] > 0) { ?>
                			                <p class="text-muted lead-field-heading text-danger">Petty Cash</p>
                			                <p class="bold font-medium-xs"><?php echo value_by_id("tblpettycashmaster", $payment_info['pettycash_id'], "department_name"); ?></p>
                                        <?php } ?>
                                        <p class="text-muted lead-field-heading text-danger">Sender Remark</p>
                                        <p class="bold font-medium-xs"><?php echo $payment_info['remark']; ?></p>
                                      <?php if (!empty($payment_info['chaque_for'])) { ?>
                			                <p class="text-muted lead-field-heading text-danger">Chaque for</p>
                			                <p class="bold font-medium-xs"><?php echo ($payment_info['chaque_for'] == 1) ? "Post Date": "Current Date"; ?></p>
                                      <?php } if (!empty($payment_info['cheque_no'])) { ?>
                			                <p class="text-muted lead-field-heading text-danger">Cheque No</p>
                			                <p class="bold font-medium-xs"><?php echo $payment_info['cheque_no']; ?></p>
                                      <?php } if (!empty($payment_info['cheque_no']) && !empty($payment_info['cheque_date']) && $payment_info['cheque_date'] != '0000-00-00') { ?>
                    			                <p class="text-muted lead-field-heading text-danger">Cheque Date</p>
                    			                <p class="bold font-medium-xs"><?php echo _d($payment_info['cheque_date']); ?></p>
                                      <?php } ?>
                                    </div>



              			             </div>

              			        </div>
                        </div>
                        <?php
                            if(empty($appvoal_info) OR (!empty($appvoal_info) && $appvoal_info->approve_status == 5)){
                        ?>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                            <button type="submit" name="submit" value="5" style="background-color: #f9d306;color:#fff;" class="btn">On Hold</button>
                                <button type="submit" name="submit" value="1" class="btn btn-success mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Accept
                                </button>
                            </div>
                        <?php
                            }
                        ?>

                        <hr>
                            <div class="col-md-12 table-responsive" style="margin-top: 20px;">
                                <h4 class="no-mtop mrg3">Payment Details</h4>
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
                                            <!-- <tr>
                                                <td colspan="5" class="text-center"><bold>Balance Amount</bold></td>
                                        <td><?php echo number_format(($payment_ttl_amt - $ttl_paid), 2, '.', ''); ?></td>
                                        </tr> -->
                                        <?php
                                    } else {
                                        echo '<tr><td class="text-center" colspan="5"><h5>No Payments</h5></td></tr>';
                                    }
                                    ?>
                                    </tbody>
                                </table>
                            </div>
                    </div>
                </div>
            </div>
            <?php
                $assign_info = $this->db->query("SELECT * from tblmasterapproval  where module_id = '40' and table_id = '".$payment_info['id']."'  ")->result();
            ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Assign Detail List</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <div style="overflow-x:auto !important;">
                                    <div class="form-group" >
                                        <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                            <thead>
                                                <tr>
                                                    <td>S.No</td>
                                                    <td>Name</td>
                                                    <td>Status</td>
                                                    <td>Read At</td>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if(!empty($assign_info)){
                                                        $i = 1;
                                                        foreach ($assign_info as $key => $value) {

                                                                if($value->approve_status == 0){
                                                                    $status = 'Pending';
                                                                    $color = 'Darkorange';
                                                                }elseif($value->approve_status == 1){
                                                                    $status = 'Approved';
                                                                    $color = 'green';
                                                                }elseif($value->approve_status == 2){
                                                                    $status = 'Reject';
                                                                    $color = 'red';
                                                                }elseif($value->approve_status == 4){
                                                                    $status = 'Reconciliation';
                                                                    $color = 'brown';
                                                                }elseif($value->approve_status == 5){
                                                                    $status = 'On Hold';
                                                                    $color = '#e8bb0b;';
                                                                }
                                                            ?>
                                                            <tr>
                                                                <td><?php echo $i++;?></td>
                                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                                <td><?php if(!empty($value->readdate)){ echo _d($value->readdate); }else{ echo 'Not Yet'; }   ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    }else{
                                                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                                    }
                                                ?>
                                            </tbody>
                                        </table>
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
                        <div class="row">
                            <div class="col-md-12">
                                <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                            </div>
                            <hr/>
                            <div class="col-md-12">
                                <input type="hidden" value="<?php echo $id;?>" name="id">
                                <div class="row" style="margin-top:2%;padding:8px;">
                                    <div class="col-md-12">
                                       <div class="form-group" app-field-wrapper="remark">
                                        <label>Remark *</label>
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="4"><?php if(!empty($appvoal_info)){ echo $appvoal_info->approvereason; }?></textarea>
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


</body>
</html>

<?php init_head(); ?>
<style type="text/css">
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
        border: 1px solid #e8bb0b;
    }
    .btn-hold:hover {
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
        border: 1px solid brown;
    }
    .btn-brown:hover {
        background-color: brown;
        color: #fff;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('purchase'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; //if(check_permission_page(40,'create')){  ?></h4>
                                </div>

                                <?php 
                                $btn_show = 0;
                                $chk_poproformainvoice = $this->db->query("SELECT * FROM `tblpurchaseproformainvoice` WHERE `po_id`= '".$purchaseorder_info->id."' ")->row();
                                $chk_mr = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `po_id`= '".$purchaseorder_info->id."' ")->row();
                                $chk_invoice = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE `po_id`= '".$purchaseorder_info->id."' ")->row();
                                $chk_payment_percent = $this->db->query("SELECT `value1` FROM `tbltermsandconditionsdetails` WHERE `master_id`= '1' AND `rel_id`= '".$purchaseorder_info->id."' AND `document_name` = 'purchase_order'")->row();
                                $chk_payment_dispatch = $this->db->query("SELECT `value1` FROM `tbltermsandconditionsdetails` WHERE `master_id`= '2' AND `rel_id`= '".$purchaseorder_info->id."' AND `document_name` = 'purchase_order'")->row();
                                $chk_vendor_bankinfo = $this->db->query("SELECT `account_no`,`ifsc` FROM `tblvendor` where id = '".$purchaseorder_info->vendor_id."'")->row();
                                if (empty($chk_payment_percent) && !empty($chk_invoice) && !empty($chk_mr)){
                                    $btn_show = 1;
                                }else if (!empty($chk_payment_percent) && !empty($chk_poproformainvoice)){
                                    $btn_show = 1;
                                }else if (!empty($chk_payment_dispatch->value1)){
                                    $btn_show = 1;
                                }else if ($purchaseorder_info->po_type == 2){
                                    $btn_show = 1;
                                }
                                    
                                ?>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <?php
                                        if (!empty($chk_vendor_bankinfo) && $chk_vendor_bankinfo->account_no != '' && $chk_vendor_bankinfo->ifsc != ''){
                                            if ($btn_show == 1){
                                                $percent = get_purchase_percent($purchaseorder_info->id, $purchaseorder_info->totalamount);
                                                if($percent > 100){
                                                    $chk_refund_payment = $this->db->query("SELECT `id` FROM `tblpurchaseorderrefundpayment` WHERE `po_id` = '".$purchaseorder_info->id."' ")->row();
                                                    if (empty($chk_refund_payment)){
                                    ?>
                                                        <a href="<?php echo admin_url('purchase/po_refund_request/' . $purchaseorder_info->id); ?>" class="btn btn-info">Refund</a>
                                    <?php
                                                    }
                                                }
                                                if (isset($chk_pending_debitnote) && $chk_pending_debitnote->ttl_recd > 0){
                                    ?>
                                                    <a href="<?php echo admin_url('purchase/po_debitnote_registered_add/' . $purchaseorder_info->id); ?>" class="btn btn-info">Add Debit Note Registered</a>
                                    <?php } ?>
                                            <?php
                                                $refundrequest = $this->db->query("SELECT `id` FROM `tblpurchaseorderrefundpayment` WHERE `po_id` != '".$purchaseorder_info->id."' AND `vendor_id`='".$purchaseorder_info->vendor_id."' AND `type`='2' AND `balance_amount` != '0.00' ")->row();
                                                if (!empty($refundrequest)){
                                            ?>
                                                <a href="<?php echo admin_url('purchase/po_payment_adjustment/' . $purchaseorder_info->id); ?>" class="btn btn-success">Adjust Last Payment</a>
                                        <?php }else{ ?>
                                                <a href="<?php echo admin_url('purchase/purchaseorder_payment_add/' . $purchaseorder_info->id); ?>" class="btn btn-info">Add Payment Request</a>
                                        <?php } ?>
                                        <?php 
                                            }else{
                                                echo '<span class="text-danger pull-right" style="font-size:15px;" >Can\'t Raise Payment Request</span>';
                                            }
                                        }else{
                                            echo '<span class="text-danger pull-right" style="font-size:15px;" >* Vendor bank details is not updated</span>';
                                        }    
                                ?>
                                </div>
                                
                            </div>

                            <hr class="hr-panel-heading">

                            <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Added By</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Approve Amount</th>
                                                <th>Payment By</th>
                                                <th>Status</th>
                                                <th>UTR</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($payment_list)) {
                                                $z = 1;
                                                foreach ($payment_list as $row) {
                                                    if ($row->status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning';
                                                    } elseif ($row->status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success';
                                                    } elseif ($row->status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger';
                                                    }elseif ($row->status == 5) {
                                                        $status = 'On Hold';
                                                        $cls = 'btn-hold';
                                                    }

                                                    if ($row->acceptance == 0) {
                                                        $accept_status = 'Acceptance Pending';
                                                        $accept_cls = 'btn-warning';
                                                    } elseif ($row->status == 1) {
                                                        $accept_status = 'Accepted';
                                                        $accept_cls = 'btn-success';
                                                    }
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
                                                        <td><?php echo get_employee_name($row->staff_id); ?></td>
                                                        <td><?php echo _d($row->created_at); ?></td>
                                                        <td><?php echo $row->amount; ?></td>
                                                        <td><?php echo $row->approved_amount; ?></td>
                                                        <td><?php echo $payment_by ?></td>
                                                        <td>
                                                            <?php
                                                            echo '<button type="button" class="' . $cls . ' btn-sm status" data-section="po_payment" value="' . $row->id . '" data-toggle="modal" data-target="#myModal">' . $status . '</button>';
                                                            ?>
                                                        </td>

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
                                                        <td class="text-center">

                                                        <?php
                                                            if (($row->payment_by == 1 OR $row->payment_by == 2) && $row->status == 1) {
                                                                echo '<button type="button" class="' . $accept_cls . ' btn-sm">' . $accept_status . '</button>';
                                                        ?>
                                                                                                                            <!-- <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=po_payment&id=' . $row->id); ?>">Pay File</a> -->
                                                        <?php
                                                            }

                                                            if (check_permission_page(40, 'delete')) {
                                                                if($row->payment_by == 1)
                                                                { 
                                                                    if ($row->utr_no == null){
                                                        ?>
                                                                        <a href="<?php echo admin_url('purchase/delete_purchasepayment/' . $row->id); ?>" class="btn btn-danger btn-xs _delete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a><br><br>
                                                        <?php
                                                                    }
                                                                }else{
                                                        ?>
                                                                        <a href="<?php echo admin_url('purchase/delete_purchasepayment/' . $row->id); ?>" class="btn btn-danger btn-xs _delete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a><br><br>
                                                        <?php
                                                                }
                                                            }
                                                            if (!empty($row->account_remark)){
                                                        ?>
                                                                <a href="javascript:void(0)" data-toggle="modal" data-target="#accountchangesModal<?php echo $row->id; ?>" class="btn-sm btn-info">Changes By Account</a>
                                                                <div id="accountchangesModal<?php echo $row->id; ?>" class="modal fade" role="dialog">
                                                                    <div class="modal-dialog">
                                                                        <!-- Modal content-->
                                                                        <div class="modal-content">
                                                                            <div class="modal-header">
                                                                                <button type="button" class="close" data-dismiss="modal">&times;</button>
                                                                                <h4 class="modal-title" style="color: #fff;">Changes By Account</h4>
                                                                            </div>
                                                                            <div class="modal-body">
                                                                                <div class="row">
                                                                                    <div class="col-md-12">
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group" app-field-wrapper="account_person_id">
                                                                                                <label class="text-danger" style="font-size:20px;"><u>Account Person Name</u></label>
                                                                                                <p><?php echo get_employee_fullname($row->account_person_id); ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-6">
                                                                                            <div class="form-group" app-field-wrapper="account_changes_dated">
                                                                                                <label class="text-danger" style="font-size:20px;"><u>Account Changes Date</u></label>
                                                                                                <p><?php echo _d($row->account_changes_dated); ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                        <div class="col-md-12">
                                                                                            <div class="form-group" app-field-wrapper="remark">
                                                                                                <label class="text-danger" style="font-size:20px;"><u>Remark</u></label>
                                                                                                <p><?php echo cc($row->account_remark); ?></p>
                                                                                            </div>
                                                                                        </div>
                                                                                    </div>
                                                                                </div>
                                                                            </div>
                                                                            <div class="modal-footer">
                                                                                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                                                                            </div>
                                                                        </div>
                                                                    </div>
                                                                </div>
                                                        <?php    
                                                            }    
                                                        ?>

                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>



                            </div>
                            <br>
                            <?php if (!empty($refundpayment_list)) { ?>
                                <div class="row">
                                  <div class="col-md-12">
                                    <h4>Purchase Order Refund Request</h4>
                                    <hr>
                                  </div>
                                </div>
                                <div class="row">
                                <div class="col-md-12 table-responsive">
                                    <table class="table" id="refundtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Added By</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Refund Type</th>
                                                <th>Refund To</th>
                                                <th>Approve Status</th>
                                                <th>Confirmation</th>
                                                <th align="center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php

                                                $z1 = 1;
                                                foreach ($refundpayment_list as $row) {

                                                    if ($row->status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning';
                                                    } elseif ($row->status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success';
                                                    } elseif ($row->status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger';
                                                    }elseif ($row->status == 5) {
                                                        $status = 'On Hold';
                                                        $cls = 'btn-hold';
                                                    }
                                                    $refund_to = "--";
                                                    if ($row->refund_to == 1){
                                                        $refund_to = "<a href='javascript:void(0);' class='label label-primary refundpayment' data-id='" . $row->id . "' data-toggle='modal' data-target='#refudpaymentinfo'>Company Account</a>";
                                                    }elseif($row->refund_to == 2){
                                                        $refund_to = "<a href='javascript:void(0);' class='label label-primary refundpayment' data-id='" . $row->id . "' data-toggle='modal' data-target='#refudpaymentinfo'>PettyCash</a>";
                                                    }

                                                    $refund_type = ($row->type == 1) ? "<span class='text-success'>Refund Payment</span>" : "<span class='text-info'>Adjust Payment In Next PO</span>";
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $z1++; ?></td>
                                                        <td><?php echo get_employee_name($row->added_by); ?></td>
                                                        <td><?php echo _d($row->payment_date); ?></td>
                                                        <td><?php echo $row->amount; ?></td>
                                                        <td><?php echo $refund_type; ?></td>
                                                        <td><?php echo $refund_to; ?></td>
                                                        <td>
                                                            <?php 
                                                                echo '<button type="button" class="' . $cls . ' btn-sm status" data-section="po_refund" value="' . $row->id . '" data-toggle="modal" data-target="#myModal">' . $status . '</button>';
                                                            ?>
                                                        </td>
                                                        <td>
                                                        <?php 
                                                        if ($row->type == 1){
                                                            if ($row->refund_to == 1){
                                                                if($row->account_confirmation == 1){
                                                                    echo "<span class='btn-sm btn-success'>Received</span>";
                                                                }else if($row->account_confirmation == 2){
                                                                    echo "<span class='btn-sm btn-danger'> Not Received</span>";
                                                                }else{
                                                                    echo "<span class='btn-sm btn-warning'>Pending</span>";
                                                                }
                                                            }else{
                                                                $pettycash_info = $this->db->query("SELECT * FROM `tblpettycashrequest` WHERE `refund_id` ='".$row->id."' ")->row();
                                                                if (!empty($pettycash_info) && $pettycash_info->confirmed_by_user == 1 && $pettycash_info->receive_status == 1){
                                                                    $confirmed_remark = (!empty($pettycash_info->user_confirmation_remark)) ? $pettycash_info->user_confirmation_remark : '--';
                                                                    $confirmed_date = (!empty($pettycash_info->confirmed_date) && $pettycash_info->confirmed_date != '0000-00-00 00:00:00') ? $pettycash_info->confirmed_date : '--';
                                                        ?>                                                                    
                                                                    <a href='javascript:void(0);' class='pettycashdiv' onclick="getpettycashdata('<?php echo $confirmed_date; ?>', '<?php echo $confirmed_remark; ?>');" ><span class='btn-sm btn-success'>Received</span></a>
                                                        <?php            
                                                                }
                                                                else{
                                                                    echo "<span class='btn-sm btn-warning'>Pending</span>";
                                                                }
                                                            }
                                                        }else{
                                                            echo "--";
                                                        }    
                                                        ?>
                                                        </td>
                                                        <td class="text-center">
                                                            <?php
                                                              
                                                              if($row->status == 0){?>
                                                                  <a href="<?php echo admin_url('purchase/delete_purchaserefundpayment/' . $row->id); ?>" class="btn btn-danger btn-xs _delete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                            <?php
                                                              }else{
                                                                  if ($row->type == 1 && $row->refund_to == 1){
                                                            ?>
                                                                <a href="<?php echo admin_url('purchase/delete_purchaserefundpayment/' . $row->id); ?>" class="btn btn-danger btn-xs _delete" ><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                            <?php        
                                                                  }else{
                                                                        echo '--';
                                                                  }
                                                              }
                                                            ?>

                                                        </td>

                                                    </tr>
                                                    <?php
                                                }
                                            ?>


                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php } ?>
                            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>



                            <div class="btn-bottom-toolbar text-right">

                            </div>
                        </div>

                    </div>
                </div>

            </form>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<div id="pettycashModal" class="modal fade" role="dialog">
    <div class="modal-dialog" >
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Refund Confirmation </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="table-responsive">
                            <table class="table">
                                <tr>
                                    <td class="text-danger" style="font-size:15px;">Confirmation Date :</td>
                                    <td id="confirmation-date"></td>
                                </tr>   
                                <tr>
                                    <td class="text-danger" style="font-size:15px;">Confirmation Remark :</td>
                                    <td id="confirmation-remark"></td>
                                </tr>                                      
                            </table>
                        </div>                            
                    </div>
                </div>                               
            </div>    
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assigned Person</h4>
            </div>
            <div class="modal-body">
                <div id="approval_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="refudpaymentinfo" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Refund Payment Details</h4>
            </div>
            <div class="modal-body">
                <div id="refundpayment_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


<div id="utrModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Payment UTR Details</h4>
            </div>
            <div class="modal-body">
                <div id="utr_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

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
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


<script>

    $(document).ready(function () {
        $('#newtable, #refundtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
            ]
        });
    });
</script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }

    });
</script>


<script type="text/javascript">
    $('.status').click(function () {
        var pay_id = $(this).val();
        var section = $(this).data("section");

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_purchasePayment_approval_info'); ?>",
            data: {'pay_id': pay_id, 'section': section},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>

<script type="text/javascript">
    $('.utr').click(function () {
        var id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/update_utr_html'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#utr_html").html(response);
                    $('.date_picker').datepicker({
                        dateFormat: 'dd/mm/yy',
                    });
                }
            }
        })
    });
    $('.refundpayment').click(function () {
        var id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/getRefundPaymentInfo'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#refundpayment_html").html(response);
                    // $('.date_picker').datepicker({
                    //     dateFormat: 'dd/mm/yy',
                    // });
                }
            }
        })
    });

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
    
    function getpettycashdata(date, remark){
        $("#pettycashModal").modal("show");
        $("#confirmation-date").html(date);
        $("#confirmation-remark").html(remark);
    }
</script>

<script type="text/javascript">
    $(".myselect").select2();
</script>

</body>
</html>

<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .button3 {background-color: #800000;}
    .onholdbtn {background-color: #e8bb0b;}

    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding: 15px;
        /*width: 20%;*/
        /*border-radius: 50%;*/
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">


                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title;?></h4>
                                </div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <a href="<?php echo admin_url('purchase/pending_payment_request'); ?>" target="_blank" class="btn btn-success">Pending Payment Request</a>
                                    <?php if (check_permission_page(40, 'create')) { ?>
                                    <a href="<?php echo admin_url('purchase/purchase_order'); ?>" class="btn btn-info">Create Purchase Order</a>
                                    <?php } ?>
                                    
                                </div>
                            </div>

                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12">

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="col-md-6 text-center <?php echo ($section == "purchase_order") ? 'active' : ''; ?>">
                                            <a href="#purchase_order" aria-controls="purchase_order" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="true">Purchase Order</a>
                                        </li>
                                        <li role="presentation" class="col-md-6 text-center <?php echo ($section == "work_order") ? 'active' : ''; ?>">
                                            <a href="#work_order" aria-controls="work_order" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="false">Work Order</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane <?php echo ($section == "purchase_order") ? 'active' : ''; ?>" id="purchase_order">
                                            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('purchase'); ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor_id" class="control-label">Select Vendor</label>
                                                        <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($vendors_info) && count($vendors_info) > 0) {
                                                                foreach ($vendors_info as $vendor_value) {
                                                                    ?>
                                                                    <option value="<?php echo $vendor_value['id']; ?>" <?php
                                                                    if (!empty($vendor_id) && $section == "purchase_order" && $vendor_id == $vendor_value['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>><?php echo cc($vendor_value['name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="product_id" class="control-label">Select Product</label>
                                                        <select class="form-control selectpicker product_id" data-live-search="true" id="product_id" name="product_id">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_info) && count($product_info) > 0) {
                                                                foreach ($product_info as $product_value) {
                                                                    ?>
                                                                    <option value="<?php echo $product_value['id']; ?>" <?php
                                                                    if (!empty($product_id) && $section == "purchase_order" && $product_id == $product_value['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>><?php echo cc($product_value['sub_name']); ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="status" class="control-label">Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="status">
                                                            <option value=""></option>
                                                            <option value="0" <?php echo (isset($s_status) && $section == "purchase_order" && $s_status == 0) ? 'selected' : ''; ?>>Pending</option>
                                                            <option value="1" <?php echo (isset($s_status) && $section == "purchase_order" && $s_status == 1) ? 'selected' : ''; ?>>Approved</option>
                                                            <option value="2" <?php echo (isset($s_status) && $section == "purchase_order" && $s_status == 2) ? 'selected' : ''; ?>>Rejected</option>
                                                            <option value="3" <?php echo (isset($s_status) && $section == "purchase_order" && $s_status == 3) ? 'selected' : ''; ?>>Cancelled</option>
                                                            <option value="4" <?php echo (isset($s_status) && $section == "purchase_order" && $s_status == 4) ? 'selected' : ''; ?>>Reconciliation</option>
                                                            <option value="5" <?php echo (isset($s_status) && $section == "purchase_order" && $s_status == 5) ? 'selected' : ''; ?>>On Hold</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="invoice_status" class="control-label">Invoice Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="invoice_status">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($invoice_status) && $section == "purchase_order" && $invoice_status == 1) ? 'selected' : ''; ?>>Invoice Received</option>
                                                            <option value="0" <?php echo (isset($invoice_status) && $section == "purchase_order" && $invoice_status == 0) ? 'selected' : ''; ?>>Invoice Not Received</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2" app-field-wrapper="date">
                                                        <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                                        <div class="input-group date">
                                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $section == "purchase_order" && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2" app-field-wrapper="date">
                                                        <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                                        <div class="input-group date">
                                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $section == "purchase_order" && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="mr_status" class="control-label">Material Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="mr_status">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($mtr_status) && $section == "purchase_order" && $mtr_status == 1) ? 'selected' : ''; ?>>Material Received</option>
                                                            <option value="0" <?php echo (isset($mtr_status) && $section == "purchase_order" && $mtr_status == 0) ? 'selected' : ''; ?>>Material Not Received</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-3">
                                                        <label for="payment_percent" class="control-label">Payment Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="payment_percent">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($payment_percent) && $section == "purchase_order" && $payment_percent == 1) ? 'selected' : ''; ?>>0.00 %</option>
                                                            <option value="2" <?php echo (isset($payment_percent) && $section == "purchase_order" && $payment_percent == 2) ? 'selected' : ''; ?>>100.00 %</option>
                                                            <option value="3" <?php echo (isset($payment_percent) && $section == "purchase_order" && $payment_percent == 3) ? 'selected' : ''; ?>>Less Than 100%</option>
                                                            <option value="4" <?php echo (isset($payment_percent) && $section == "purchase_order" && $payment_percent == 4) ? 'selected' : ''; ?>>More Than 100%</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="hidden" name="section" value="purchase_order">
                                                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                                        <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12 table-responsive" style="overflow-x: scroll">
                                                        <table class="table" id="newtable" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No.</th>
                                                                    <th width="10%">PO No.</th>
                                                                    <th width="10%">PO Date</th>
                                                                    <th width="15%">Supplier</th>
                                                                    <th width="5%">Warehouse/Site</th>
                                                                    <th width="8%">PO Amount</th>
                                                                    <th width="10%">Payment Percent</th>
                                                                    <th width="10%">Payment Status</th>
                                                                    <th width="10%">MR Status</th>
                                                                    <th width="10%">Purchase Invoice Status</th>
                                                                    <th width="10%">PO Status</th>
                                                                    <th width="10%">Status</th>
                                                                    <th width="10%">Audit Status</th>
                                                                    <th width="30%">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $ttl_amt = 0;
                                                                if (!empty($purchaseorder_list)) {
                                                                    $z = 1;

                                                                    foreach ($purchaseorder_list as $row) {

                                                                        if ($row->status == 0) {
                                                                            $status = 'Pending';
                                                                            $cls = 'btn-warning';
                                                                        } elseif ($row->status == 1) {
                                                                            $status = 'Approved';
                                                                            $cls = 'btn-success';
                                                                        } elseif ($row->status == 2) {
                                                                            $status = 'Rejected';
                                                                            $cls = 'btn-danger';
                                                                        } elseif ($row->status == 4) {
                                                                            $status = 'Reconciliation';
                                                                            $cls = 'btn-danger button3';
                                                                        } elseif ($row->status == 5) {
                                                                            $status = 'On Hold';
                                                                            $cls = 'btn-warning onholdbtn';
                                                                        }
                                                                        $po_percent = "";
                                                                        $percent = get_purchase_percent($row->id, $row->totalamount);

                                                                        if (!empty($payment_percent) && $payment_percent == 1 && ($percent == '0.00')) {
                                                                            $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                                            $po_percent = $percent;
                                                                        } elseif (!empty($payment_percent) && $payment_percent == 2 && $percent == 100) {
                                                                            $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                                            $po_percent = $percent;
                                                                        } elseif (!empty($payment_percent) && $payment_percent == 3 && $percent < 100 && $percent > 0) {
                                                                            $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                                            $po_percent = $percent;
                                                                        } elseif (!empty($payment_percent) && $payment_percent == 4 && $percent > 100) {
                                                                            $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                                            $po_percent = $percent;
                                                                        } elseif (empty($payment_percent)) {
                                                                            $po_percent = $percent;
                                                                            $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                                        }
                                                                        
                                                                        $percent_cls = "btn-info";
                                                                        if ($percent == 100) {
                                                                            $percent_cls = "btn-success";
                                                                        } elseif ($percent > 100) {
                                                                            $percent_cls = "btn-danger";
                                                                        } elseif ($percent == '0.00') {
                                                                            $percent_cls = "btn-warning";
                                                                        }
                                                                        $pmt_status = "<span class='badge badge-warning' style='background-color:#ff6f00;padding: 6px;' >Pending</span>";
                                                                        $chk_purchase_payment = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `po_id` = '" . $row->id . "' and status != 2")->result();
                                                                        $last_approved_payment_info = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `po_id` = '" . $row->id . "' and status = 1 order by id desc")->row();
                                                                        $last_approved_payment = 0;
                                                                        if(!empty($last_approved_payment_info)){
                                                                            $last_approved_payment = $last_approved_payment_info->approved_amount;
                                                                        }
                                                                        if (!empty($chk_purchase_payment)) {


                                                                            $pending_request = $chk_utr = 0;
                                                                            $approved_amount = 0.00;
                                                                            foreach ($chk_purchase_payment as $value) {
                                                                                $approved_amount += $value->approved_amount;
                                                                                if ($value->payment_by == 1) {
                                                                                    if ($value->status == 0 && $value->utr_no == "") {
                                                                                        $pending_request = 1;
                                                                                    } elseif ($value->status == 1 && $value->utr_no == "") {
                                                                                        $chk_utr = 1;
                                                                                    }
                                                                                } elseif ($value->payment_by != 1) {
                                                                                    if ($value->status == 0) {
                                                                                        $pending_request = 1;
                                                                                    }
                                                                                }
                                                                            }


                                                                            if ($pending_request == 1) {
                                                                                $pmt_status = "<span class='badge badge-warning' style='background-color:#ff6f00;padding: 6px;'>Payment <br> Requested </span>";
                                                                            } elseif ($pending_request == 0 && $chk_utr == 1) {
                                                                                $pmt_status = "<span class='badge badge-success' style='background-color:#84c529;padding: 6px;'>Request <br> Approved <br> ".$last_approved_payment."</span>";
                                                                            } else {
                                                                                if ($approved_amount >= $row->totalamount) {
                                                                                    $pmt_status = "<span class='badge badge-success' style='background-color:#84c529;padding: 6px;'>Completed</span>";
                                                                                } else {
                                                                                    $pmt_status = "<span class='badge badge-info' style='background-color:#03a9f4;padding: 6px;'>Partial <br> Payment</span>";
                                                                                }
                                                                            }

                                                                        }

                                                                        if ($po_percent != "") {
                                                                            if ($row->source_type == 1) {
                                                                                $warehouse = cc(value_by_id('tblwarehouse', $row->warehouse_id, 'name'));
                                                                            } else {
                                                                                $warehouse = cc(value_by_id('tblsitemanager', $row->site_id, 'name'));
                                                                            }
                                                                            if ($row->cancel == 1) {
                                                                                $po_status = '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                                                                            } else {
                                                                                $po_status = '<button type="button" class="' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#myModal">' . $status . '</button>';
                                                                            }
                                                                            if ($row->revised > 0 || $row->revised_id > 0) {
                                                                                $po_status .= ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';
                                                                            }
                                                                            if ($row->complete == 1) {
                                                                                $mr_info = $this->db->query("SELECT * FROM `tblmaterialreceipt` WHERE `po_id` = '".$row->id."' AND `status` = '1' ORDER BY id DESC")->row();
                                                                                $mr_status = '<a href="javascript:void(0);" data-toggle="modal" data-id="' . $row->id . '" data-type="material_receipt" class="uploadfilelist" data-target="#uploadfilesmodel"><span class="btn-sm btn-success">Completed</span></a>';
                                                                                if (!empty($mr_info)){
                                                                                    $mr_number = (!empty($mr_info->numer)) ? $mr_info->numer : 'MR-' . $mr_info->id;
                                                                                    $mr_status .= '<br><br><a class="label label-info" href="'.admin_url('purchase/mr_details/' . $mr_info->id).'" target="_blank" >'.$mr_number.'</a>';
                                                                                }
                                                                            } else {
                                                                                $mr_status = '<span class="btn-sm btn-warning">Pending</span>';
                                                                            }
                                                                            $chk_purchase_invoice = $this->db->query("SELECT `id`,`totalamount`,`created_at` FROM `tblpurchaseinvoice` WHERE `po_id` = '" . $row->id . "' ORDER BY id DESC")->row();
                                                                            if (!empty($chk_purchase_invoice)) {
                                                                                
                                                                                $pi_status = '<a href="javascript:void(0);" data-toggle="modal" data-id="' . $row->id . '" data-type="purchase_invoice" class="uploadfilelist" data-target="#uploadfilesmodel"><span style="font-size: 10px;" class="btn-sm btn-success">Completed</span></a>';
                                                                                $pi_status .= ($chk_purchase_invoice->totalamount == $row->totalamount) ? '<br><br><span class="btn-sm btn-success" style="font-size: 10px;">Matched</span>' : '<br><br><span class="btn-sm btn-danger" style="font-size: 10px;">Not Matched</span>';
                                                                            } else {
                                                                                $pi_status = "<span class='btn-warning btn-sm' style='font-size: 10px;'>Pending</span><br><br><span class='btn-sm btn-danger' style='font-size: 10px;'>Not Matched</span>";
                                                                            }

                                                                            $can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '" . $row->id . "' and (approve_status = 1 || approve_status = 2) ")->row_array();

                                                                            $recon_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '" . $row->id . "' and approve_status = 4 ")->row_array();

                                                                            if (!empty($row->parent_ids)) {
                                                                                $sub_po_exist = $this->db->query("SELECT id FROM `tblpurchaseorder` where id IN (" . $row->parent_ids . ") and id != '" . $row->id . "' ")->row();
                                                                            }


                                                                            $po_number = (is_numeric($row->number)) ? 'PO-' . $row->number : $row->number;
                                                                            $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where `type` = 2 and `po_id` = '".$row->id."' and `for` = 2 ")->row();
                                                                            ?>
                                                                            <tr><td><?php echo $z++; ?></td>
                                                                                <td><a  title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>"><?php echo $po_number; ?></a></td>
                                                                                <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                                                                <td><?php echo cc(value_by_id('tblvendor', $row->vendor_id, 'name')); ?></td>
                                                                                <td><?php echo $warehouse; ?></td>
                                                                                <td><?php echo $row->totalamount; ?></td>
                                                                                <td><button type='button' class='btn-sm <?php echo $percent_cls; ?> percent' value="<?php echo $row->id; ?>" data-toggle='modal' data-target='#myModalpercent'><?php echo $percent . "%"; ?></button></td>
                                                                                <td><?php echo $pmt_status; ?></td>
                                                                                <td><?php echo $mr_status; ?></td>
                                                                                <td><?php echo $pi_status; ?></td>
                                                                                <td><?php
                                                                                    
                                                                                    if ($row->complete == 1 && !empty($chk_purchase_invoice)) {
                                                                                        echo "<span class='btn-success btn-sm'>Closed</span>";
                                                                                        $invoicecreated_date = date("Y-m-d", strtotime($chk_purchase_invoice->created_at));
                                                                                        if (!empty($row->tentative_complete_date)){
                                                                                            if ($row->tentative_complete_date < $invoicecreated_date){
                                                                                                $diffdays = dateDiffInDays($row->tentative_complete_date, $invoicecreated_date);
                                                                                                if ($diffdays >= 1){
                                                                                                    echo "<br><span class='text-danger'>(Overdue by ".$diffdays." days)</span>";
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                    } else {
                                                                                        echo "<span class='btn-info btn-sm'>Open</span>";
                                                                                        if (!empty($row->tentative_complete_date)){
                                                                                            $diffdays = dateDiffInDays($row->tentative_complete_date, date('Y-m-d'));
                                                                                            if ($diffdays >= 1){
                                                                                                echo "<br><span class='text-danger'>(Overdue by ".$diffdays." days)</span>";
                                                                                            }
                                                                                        }
                                                                                    }
                                                                                    ?></td>
                                                                                <td><?php echo $po_status; ?></td>
                                                                                <td>
                                                                                  <?php
                                                                                    if ($row->audit_status == 1) {
                                                                                        echo "<a href='javascript:void(0);' data-id='".$row->vendor_id."' class='auditstatus btn-success btn-sm'>Yes</a>";
                                                                                    } else {
                                                                                        echo "<a href='javascript:void(0);' class='btn-danger btn-sm'>No</a>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td class="text-center">

                                                                                    <a class="tableBtn" title="View" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_view/' . $row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                    <?php
                                                                                    if ($row->cancel == 0) {

                                                                                        //if (empty($can_edit)) {
                                                                                        if ($row->status != 1) {

                                                                                            if ($row->save == 1) {
                                                                                                echo '<a class="tableBtn" title="Send Approval" target="_blank" href="' . admin_url('purchase/purchase_order/' . $row->id) . '"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                                                                                            } else {
                                                                                                if (check_permission_page(40, 'edit')) {
                                                                                                    echo '<a class="tableBtn" title="Edit" target="_blank" href="' . admin_url('purchase/purchase_order/' . $row->id) . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                                                                } else {
                                                                                                    echo '--';
                                                                                                }
                                                                                            }
                                                                                        } else {
                                                                                            if (!empty($recon_edit)) {
                                                                                                if (check_permission_page(40, 'edit')) {
                                                                                                    echo '<a class="tableBtn" title="Edit" target="_blank" href="' . admin_url('purchase/purchase_order/' . $row->id) . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>

                                                                                        <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="' . $row->id . '" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

                                                                                        <div class="btn-group">
                                                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                                            </button>
                                                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                                                <li>
                                                                                                    <?php
                                                                                                    if ($row->status == 1) {
                                                                                                        ?>
                                                                                                        <a  title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>">PDF</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                    <a  title="View" target="_blank" href="<?php echo admin_url('purchase/view_pdf/' . $row->id); ?>">View</a>
                                                                                                    <a  title="View" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_payments/' . $row->id); ?>">Payments</a>
                                                                                                    <?php
                                                                                                    if (!empty($sub_po_exist)) {
                                                                                                        ?>
                                                                                                        <a  title="View" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_sub_po/' . $row->id); ?>">Sub PO List</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>

                                                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/' . $row->id); ?>" data-status="1">CANCEL</a>
                                                                                                    <?php
                                                                                                    if ((check_permission_page(40, 'delete')) && (empty($can_edit))) {
                                                                                                        ?>
                                                                                                        <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/' . $row->id); ?>" data-status="1">DELETE</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    if ($row->status == 1) {
                                                                                                        ?>
                                                                                                        <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/' . $row->id); ?>" data-status="1">RENEWAL</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                    <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                                                        Send Mail
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li><a target="_blank" href="<?php echo admin_url('follow_up/po_activity/' . $row->id); ?>"  >Activity</a></li>
                                                                                                
                                                                                                <?php
                                                                                                    if ($row->status == 1){
                                                                                                        if(!empty($pickup_ho)){
                                                                                                        ?>
                                                                                                            <li><button value="<?php echo $row->id; ?>" style="padding-left: 45px;padding-right: 45px;" val="2" type="button" class="btn-sm btn-info handover" data-toggle="modal" data-target="#handover_modal">Pickup HO</button></li>
                                                                                                        <?php
                                                                                                        }
                                                                                                        if($row->under_process == 0 && empty($pickup_ho)){
                                                                                                            echo '<li><button value="'.$row->id.'" style="padding-left: 56px;padding-right: 56px;" title="Make Pickup" type="button" val="2" class="btn-sm btn-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button></li>';
                                                                                                        }elseif($row->under_process == 1){
                                                                                                            echo '<li><button disabled type="button" style="padding-left: 26px;padding-right: 26px;" class="btn-sm btn-success">Pickup In Process</button></li>';
                                                                                                        }elseif($row->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){
                                                                                                            echo '<li><a href="'.admin_url('purchase/make_complete/'.$pickup_ho->id).'" style="padding-left: 26px;padding-right: 26px;" class="btn-sm btn-success">Mark Pick Complete</a></li>';
                                                                                                        }elseif($row->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                                                                                            echo '<li><button type="button" style="padding-left: 56px;padding-right: 56px;" class="btn-sm btn-info">Completed</button></li>';
                                                                                                        }
                                                                                                    }
                                                                                                ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                    ?>

                                                                                </td>
                                                                            </tr>

                                                                            <?php
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '<tr><td class="text-center" colspan="12"><h5>Record Not Found</h5></td></tr>';
                                                                }
                                                                ?>


                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td align="" colspan="5">Total</td>
                                                                    <td align=""><b><?php echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
                                                                    <td align="center" colspan="7"></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                        <div role="tabpanel" class="tab-pane <?php echo ($section == "work_order") ? 'active' : ''; ?>" id="work_order">
                                            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('purchase'); ?>">
                                                <div class="row">
                                                    <div class="form-group col-md-4">
                                                        <label for="vendor_id" class="control-label">Select Vendor</label>
                                                        <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($vendors_info) && count($vendors_info) > 0) {
                                                                foreach ($vendors_info as $vendor_value) {
                                                                    ?>
                                                                    <option value="<?php echo $vendor_value['id']; ?>" <?php
                                                                    if (!empty($vendor_id) && $section == "work_order" && $vendor_id == $vendor_value['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>><?php echo cc($vendor_value['name']); ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-4">
                                                        <label for="product_id" class="control-label">Select Product</label>
                                                        <select class="form-control selectpicker product_id" data-live-search="true" id="product_id" name="product_id">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($product_info) && count($product_info) > 0) {
                                                                foreach ($product_info as $product_value) {
                                                                    ?>
                                                                    <option value="<?php echo $product_value['id']; ?>" <?php
                                                                    if (!empty($product_id) && $section == "work_order" && $product_id == $product_value['id']) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>><?php echo cc($product_value['sub_name']); ?></option>
                                                                            <?php
                                                                        }
                                                                    }
                                                                    ?>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="status" class="control-label">Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="status">
                                                            <option value=""></option>
                                                            <option value="0" <?php echo (isset($s_status) && $section == "work_order" && $s_status == 0) ? 'selected' : ''; ?>>Pending</option>
                                                            <option value="1" <?php echo (isset($s_status) && $section == "work_order" && $s_status == 1) ? 'selected' : ''; ?>>Approved</option>
                                                            <option value="2" <?php echo (isset($s_status) && $section == "work_order" && $s_status == 2) ? 'selected' : ''; ?>>Rejected</option>
                                                            <option value="3" <?php echo (isset($s_status) && $section == "work_order" && $s_status == 3) ? 'selected' : ''; ?>>Cancelled</option>
                                                            <option value="4" <?php echo (isset($s_status) && $section == "work_order" && $s_status == 4) ? 'selected' : ''; ?>>Reconciliation</option>
                                                            <option value="5" <?php echo (isset($s_status) && $section == "work_order" && $s_status == 5) ? 'selected' : ''; ?>>On Hold</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="invoice_status" class="control-label">Invoice Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="invoice_status">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($invoice_status) && $section == "work_order" && $invoice_status == 1) ? 'selected' : ''; ?>>Invoice Received</option>
                                                            <option value="0" <?php echo (isset($invoice_status) && $section == "work_order" && $invoice_status == 0) ? 'selected' : ''; ?>>Invoice Not Received</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2" app-field-wrapper="date">
                                                        <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                                        <div class="input-group date">
                                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $section == "work_order" && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>
                                                    <div class="form-group col-md-2" app-field-wrapper="date">
                                                        <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                                        <div class="input-group date">
                                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $section == "work_order" && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                        </div>
                                                    </div>

                                                    <div class="form-group col-md-2">
                                                        <label for="mr_status" class="control-label">Material Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="mr_status">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($mtr_status) && $section == "work_order" && $mtr_status == 1) ? 'selected' : ''; ?>>Material Received</option>
                                                            <option value="0" <?php echo (isset($mtr_status) && $section == "work_order" && $mtr_status == 0) ? 'selected' : ''; ?>>Material Not Received</option>
                                                        </select>
                                                    </div>
                                                    <div class="form-group col-md-2">
                                                        <label for="payment_percent" class="control-label">Payment Status</label>
                                                        <select class="form-control selectpicker" data-live-search="true" name="payment_percent">
                                                            <option value=""></option>
                                                            <option value="1" <?php echo (isset($payment_percent) && $section == "work_order" && $payment_percent == 1) ? 'selected' : ''; ?>>0.00 %</option>
                                                            <option value="2" <?php echo (isset($payment_percent) && $section == "work_order" && $payment_percent == 2) ? 'selected' : ''; ?>>100.00 %</option>
                                                            <option value="3" <?php echo (isset($payment_percent) && $section == "work_order" && $payment_percent == 3) ? 'selected' : ''; ?>>Less Than 100%</option>
                                                            <option value="4" <?php echo (isset($payment_percent) && $section == "work_order" && $payment_percent == 4) ? 'selected' : ''; ?>>More Than 100%</option>
                                                        </select>
                                                    </div>
                                                    <div class="col-md-2">
                                                        <input type="hidden" name="section" value="work_order">
                                                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                                        <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                                    </div>
                                                    <div class="col-md-12">
                                                        <hr>
                                                    </div>
                                                    <div class="col-md-12 table-responsive" style="overflow-x: scroll">
                                                        <table class="table" id="newtable1" width="100%">
                                                            <thead>
                                                                <tr>
                                                                    <th width="1%">S.No.</th>
                                                                    <th width="10%">PO No.</th>
                                                                    <th width="10%">PO Date</th>
                                                                    <th width="25%">Supplier</th>
                                                                    <th width="5%">Warehouse/Site</th>
                                                                    <th width="8%">PO Amount</th>
                                                                    <th width="10%">Payment Percent</th>
                                                                    <th width="10%">Payment Status</th>
                                                                    <th width="10%">MR Status</th>
                                                                    <th width="15%">Purchase Invoice Status</th>
                                                                    <th width="10%">PO Status</th>
                                                                    <th width="10%">Status</th>
                                                                    <th width="10%">Audit Status</th>
                                                                    <th width="30%">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                $ttl_amt = 0;
                                                                if (!empty($workorder_list)) {
                                                                    $z = 1;

                                                                    foreach ($workorder_list as $row) {

                                                                        if ($row->status == 0) {
                                                                            $status = 'Pending';
                                                                            $cls = 'btn-warning';
                                                                        } elseif ($row->status == 1) {
                                                                            $status = 'Approved';
                                                                            $cls = 'btn-success';
                                                                        } elseif ($row->status == 2) {
                                                                            $status = 'Rejected';
                                                                            $cls = 'btn-danger';
                                                                        } elseif ($row->status == 4) {
                                                                            $status = 'Reconciliation';
                                                                            $cls = 'btn-danger button3';
                                                                        } elseif ($row->status == 5) {
                                                                            $status = 'On Hold';
                                                                            $cls = 'btn-warning onholdbtn';
                                                                        }
                                                                        $po_percent = "";
                                                                        $percent = get_purchase_percent($row->id, $row->totalamount);

                                                                        if (!empty($payment_percent) && $payment_percent == 1 && ($percent == '0.00')) {
                                                                            $ttl_amt += $row->totalamount;
                                                                            $po_percent = $percent;
                                                                        } elseif (!empty($payment_percent) && $payment_percent == 2 && $percent == 100) {
                                                                            $ttl_amt += $row->totalamount;
                                                                            $po_percent = $percent;
                                                                        } elseif (!empty($payment_percent) && $payment_percent == 3 && $percent < 100 && $percent > 0) {
                                                                            $ttl_amt += $row->totalamount;
                                                                            $po_percent = $percent;
                                                                        } elseif (!empty($payment_percent) && $payment_percent == 4 && $percent > 100) {
                                                                            $ttl_amt += $row->totalamount;
                                                                            $po_percent = $percent;
                                                                        } elseif (empty($payment_percent)) {
                                                                            $po_percent = $percent;
                                                                            $ttl_amt += $row->totalamount;
                                                                        }

                                                                        $percent_cls = "btn-info";
                                                                        if ($percent == 100) {
                                                                            $percent_cls = "btn-success";
                                                                        } elseif ($percent > 100) {
                                                                            $percent_cls = "btn-danger";
                                                                        } elseif ($percent == '0.00') {
                                                                            $percent_cls = "btn-warning";
                                                                        }
                                                                        $pmt_status = "<span class='badge badge-warning' style='background-color:#ff6f00;padding: 6px;' >Pending</span>";
                                                                        $chk_purchase_payment = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `po_id` = '" . $row->id . "' and status != 2")->result();

                                                                        $last_approved_payment_info = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `po_id` = '" . $row->id . "' and status = 1 order by id desc")->row();
                                                                        $last_approved_payment = 0;
                                                                        if(!empty($last_approved_payment_info)){
                                                                            $last_approved_payment = $last_approved_payment_info->approved_amount;
                                                                        }
                                                                        if (!empty($chk_purchase_payment)) {
//                                                        echo '<pre>';
//                                                        print_r($chk_purchase_payment);

                                                                            $pending_request = $chk_utr = 0;
                                                                            $approved_amount = 0.00;
                                                                            foreach ($chk_purchase_payment as $value) {
                                                                                $approved_amount += $value->approved_amount;
                                                                                if ($value->payment_by == 1) {
                                                                                    if ($value->status == 0 && $value->utr_no == "") {
                                                                                        $pending_request = 1;
                                                                                    } elseif ($value->status == 1 && $value->utr_no == "") {
                                                                                        $chk_utr = 1;
                                                                                    }
                                                                                } elseif ($value->payment_by != 1) {
                                                                                    if ($value->status == 0) {
                                                                                        $pending_request = 1;
                                                                                    }
                                                                                }
                                                                            }


                                                                            if ($pending_request == 1) {
                                                                                $pmt_status = "<span class='badge badge-warning' style='background-color:#ff6f00;padding: 6px;'>Payment <br> Requested</span>";
                                                                            } elseif ($pending_request == 0 && $chk_utr == 1) {
                                                                                $pmt_status = "<span class='badge badge-success' style='background-color:#84c529;padding: 6px;'>Request <br> Approved <br> ".$last_approved_payment."</span>";
                                                                            } else {
                                                                                if ($approved_amount >= $row->totalamount) {
                                                                                    $pmt_status = "<span class='badge badge-success' style='background-color:#84c529;padding: 6px;'>Completed</span>";
                                                                                } else {
                                                                                    $pmt_status = "<span class='badge badge-info' style='background-color:#03a9f4;padding: 6px;'>Partial <br> Payment</span>";
                                                                                }
                                                                            }
//                                                        $chk_payment = $this->db->query("SELECT `id`, `status`, `utr_no` FROM `tblpurchaseorderpayments` WHERE `po_id` = '".$row->id."'")->result();
//                                                        $chk_pending_payment = $this->db->query("SELECT `id` FROM `tblpurchaseorderpayments` WHERE `po_id` = '".$row->id."' and status = 0")->row();
//
//                                                        if (!empty($chk_payment) && $chk_payment->status == 0 && !empty($chk_pending_payment)){
//                                                            $pmt_status = "<span class='btn-sm btn-warning'>Payment &nbsp;&nbsp;.&nbsp;<br>&nbsp; Requested</span>";
//                                                        }elseif(!empty($chk_payment) && $chk_payment->status == 1 && empty($chk_payment->utr_no)) {
//                                                            $pmt_status = "<span class='btn-sm btn-success'>Request &nbsp;&nbsp;.&nbsp;<br>&nbsp; Approved</span>";
//                                                        }else{
//                                                            $chk_approve_payment = $this->db->query("SELECT SUM(`approved_amount`) as `approve_amt` FROM `tblpurchaseorderpayments` WHERE `po_id` = '".$row->id."' and `status`= 1 and utr_no != '' ")->row();
//                                                            if ($chk_approve_payment->approve_amt >= $row->totalamount){
//                                                                $pmt_status = "<span class='btn-sm btn-success'>Completed</span>";
//                                                            }else{
//                                                                $pmt_status = "<span class='btn-sm btn-info'>Partial &nbsp;&nbsp;&nbsp;&nbsp;.<br>&nbsp; Payment</span>";
//                                                            }
//                                                        }
                                                                        }

                                                                        if ($po_percent != "") {
                                                                            if ($row->source_type == 1) {
                                                                                $warehouse = cc(value_by_id('tblwarehouse', $row->warehouse_id, 'name'));
                                                                            } else {
                                                                                $warehouse = cc(value_by_id('tblsitemanager', $row->site_id, 'name'));
                                                                            }
                                                                            if ($row->cancel == 1) {
                                                                                $po_status = '<button disabled class="btn-sm btn-danger">Cancelled</button>';
                                                                            } else {
                                                                                $po_status = '<button type="button" class="' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#myModal">' . $status . '</button>';
                                                                            }
                                                                            if ($row->revised > 0 || $row->revised_id > 0) {
                                                                                $po_status .= ' <span style="color: green;"><i class="fa fa-registered" aria-hidden="true"></i></span>';
                                                                            }
                                                                            if ($row->complete == 1) {
                                                                                $mr_status = '<a href="javascript:void(0);" data-toggle="modal" data-id="' . $row->id . '" data-type="material_receipt" class="uploadfilelist" data-target="#uploadfilesmodel"><span class="btn-sm btn-success">Completed</span></a>';
                                                                            } else {
                                                                                $mr_status = '<span class="btn-sm btn-warning">Pending</span>';
                                                                            }
                                                                            $chk_purchase_invoice = $this->db->query("SELECT `id` FROM `tblpurchaseinvoice` WHERE `po_id` = '" . $row->id . "'")->row();
                                                                            if (!empty($chk_purchase_invoice)) {
                                                                                $pi_status = '<a href="javascript:void(0);" data-toggle="modal" data-id="' . $row->id . '" data-type="purchase_invoice" class="uploadfilelist" data-target="#uploadfilesmodel"><span class="btn-sm btn-success" style="font-size: 10px;">Completed</span></a>';
                                                                                $pi_status .= ($chk_purchase_invoice->totalamount == $row->totalamount) ? '<br><br><span class="btn-sm btn-success" style="font-size: 10px;">Matched</span>' : '<br><br><span style="font-size: 10px;" class="btn-sm btn-danger">Not Matched</span>';
                                                                            } else {
                                                                                $pi_status = "<span class='btn-warning btn-sm' style='font-size: 10px;'>Pending</span><br><br><span class='btn-sm btn-danger' style='font-size: 10px;'>Not Matched</span>";
                                                                            }

                                                                            $can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '" . $row->id . "' and (approve_status = 1 || approve_status = 2) ")->row_array();

                                                                            $recon_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '" . $row->id . "' and approve_status = 4 ")->row_array();

                                                                            if (!empty($row->parent_ids)) {
                                                                                $sub_po_exist = $this->db->query("SELECT id FROM `tblpurchaseorder` where id IN (" . $row->parent_ids . ") and id != '" . $row->id . "' ")->row();
                                                                            }


                                                                            $po_number = (is_numeric($row->number)) ? 'PO-' . $row->number : $row->number;
                                                                            $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where `type` = 2 and `po_id` = '".$row->id."' and `for` = 2 ")->row();
                                                                            ?>
                                                                            <tr><td><?php echo $z++; ?></td>
                                                                                <td><a  title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>"><?php echo $po_number; ?></a></td>
                                                                                <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                                                                <td><?php echo cc(value_by_id('tblvendor', $row->vendor_id, 'name')); ?></td>
                                                                                <td><?php echo $warehouse; ?></td>
                                                                                <td><?php echo $row->totalamount; ?></td>
                                                                                <td><button type='button' class='btn-sm <?php echo $percent_cls; ?> percent' value="<?php echo $row->id; ?>" data-toggle='modal' data-target='#myModalpercent'><?php echo $percent . "%"; ?></button></td>
                                                                                <td><?php echo $pmt_status; ?></td>
                                                                                <td><?php echo $mr_status; ?></td>
                                                                                <td><?php echo $pi_status; ?></td>
                                                                                <td><?php
                                                                                    if ($row->complete == 1 && !empty($chk_purchase_invoice)) {
                                                                                        echo "<span class='btn-success btn-sm'>Closed</span>";
                                                                                    } else {
                                                                                        echo "<span class='btn-info btn-sm'>Open</span>";
                                                                                    }
                                                                                    ?></td>
                                                                                <td><?php echo $po_status; ?></td>
                                                                                <td>
                                                                                  <?php
                                                                                    if ($row->audit_status == 1) {
                                                                                        echo "<a href='javascript:void(0);' data-id='".$row->vendor_id."' class='auditstatus btn-success btn-sm'>Yes</a>";
                                                                                    } else {
                                                                                        echo "<a href='javascript:void(0);' class='btn-danger btn-sm'>No</a>";
                                                                                    }
                                                                                    ?>
                                                                                </td>
                                                                                <td class="text-center">
                                                                                  
                                                                                    <a class="tableBtn" title="View" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_view/' . $row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                                    <?php
                                                                                    if ($row->cancel == 0) {

                                                                                        //if (empty($can_edit)) {
                                                                                        if ($row->status != 1) {    

                                                                                            if ($row->save == 1) {
                                                                                                echo '<a class="tableBtn" title="Send Approval" target="_blank" href="' . admin_url('purchase/purchase_order/' . $row->id) . '"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
                                                                                            } else {
                                                                                                if (check_permission_page(40, 'edit')) {
                                                                                                    echo '<a class="tableBtn" title="Edit" target="_blank" href="' . admin_url('purchase/purchase_order/' . $row->id) . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                                                                } else {
                                                                                                    echo '--';
                                                                                                }
                                                                                            }
                                                                                        } else {
                                                                                            if (!empty($recon_edit)) {
                                                                                                if (check_permission_page(40, 'edit')) {
                                                                                                    echo '<a class="tableBtn" title="Edit" target="_blank" href="' . admin_url('purchase/purchase_order/' . $row->id) . '"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                                                                }
                                                                                            }
                                                                                        }
                                                                                        ?>

                                                                                        <?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="' . $row->id . '" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

                                                                                        <div class="btn-group">
                                                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                                            </button>
                                                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                                                <li>
                                                                                                    <?php
                                                                                                    if ($row->status == 1) {
                                                                                                        ?>
                                                                                                        <a  title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>">PDF</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                    <a  title="View" target="_blank" href="<?php echo admin_url('purchase/view_pdf/' . $row->id); ?>">View</a>
                                                                                                    <a  title="View" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_payments/' . $row->id); ?>">Payments</a>
                                                                                                    <?php
                                                                                                    if (!empty($sub_po_exist)) {
                                                                                                        ?>
                                                                                                        <a  title="View" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_sub_po/' . $row->id); ?>">Sub PO List</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>

                                                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/' . $row->id); ?>" data-status="1">CANCEL</a>
                                                                                                    <?php
                                                                                                    if ((check_permission_page(40, 'delete')) && (empty($can_edit))) {
                                                                                                        ?>
                                                                                                        <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/' . $row->id); ?>" data-status="1">DELETE</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    if ($row->status == 1) {
                                                                                                        ?>
                                                                                                        <a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/' . $row->id); ?>" data-status="1">RENEWAL</a>
                                                                                                        <?php
                                                                                                    }
                                                                                                    ?>
                                                                                                    <a href="javascript:void(0);" class="btn-with-tooltip send-email" data-id="<?php echo $row->id; ?>" data-vid="<?php echo $row->vendor_id; ?>"  data-target="#send_mainto_customer" id="send_mail" data-toggle="modal">
                                                                                                        Send Mail
                                                                                                    </a>
                                                                                                </li>
                                                                                                <li><a target="_blank" href="<?php echo admin_url('follow_up/po_activity/' . $row->id); ?>"  >Activity</a></li>
                                                                                                <?php
                                                                                                    if ($row->status == 1){
                                                                                                        if(!empty($pickup_ho)){
                                                                                                        ?>
                                                                                                            <li><button value="<?php echo $row->id; ?>" style="padding-left: 45px;padding-right: 45px;" val="2" type="button" class="btn-sm btn-info handover" data-toggle="modal" data-target="#handover_modal">Pickup HO</button></li>
                                                                                                        <?php
                                                                                                        }
                                                                                                        if($row->under_process == 0 && empty($pickup_ho)){
                                                                                                            echo '<li><button value="'.$row->id.'" style="padding-left: 56px;padding-right: 56px;" title="Make Pickup" type="button" val="2" class="btn-sm btn-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button></li>';
                                                                                                        }elseif($row->under_process == 1){
                                                                                                            echo '<li><button disabled type="button" style="padding-left: 26px;padding-right: 26px;" class="btn-sm btn-success">Pickup In Process</button></li>';
                                                                                                        }elseif($row->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){
                                                                                                            echo '<li><a href="'.admin_url('purchase/make_complete/'.$pickup_ho->id).'" style="padding-left: 26px;padding-right: 26px;" class="btn-sm btn-success">Mark Pick Complete</a></li>';
                                                                                                        }elseif($row->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                                                                                            echo '<li><button type="button" style="padding-left: 56px;padding-right: 56px;" class="btn-sm btn-info">Completed</button></li>';
                                                                                                        }
                                                                                                    }
                                                                                                ?>
                                                                                            </ul>
                                                                                        </div>
                                                                                        <?php
                                                                                    }
                                                                                    ?>

                                                                                </td>
                                                                            </tr>

                                                                            <?php
                                                                        }
                                                                    }
                                                                } else {
                                                                    echo '<tr><td class="text-center" colspan="12"><h5>Record Not Found</h5></td></tr>';
                                                                }
                                                                ?>


                                                            </tbody>
                                                            <tfoot>
                                                                <tr>
                                                                    <td align="" colspan="5">Total</td>
                                                                    <td align=""><b><?php echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
                                                                    <td align="center" colspan="7"></td>
                                                                </tr>
                                                            </tfoot>
                                                        </table>
                                                    </div>
                                                </div>
                                            </form>

                                        </div>
                                    </div>
                                </div>
                            </div>

                            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                            <div class="btn-bottom-toolbar text-right">
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        <div class="btn-bottom-pusher"></div>
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
<!-- Modal -->
<div id="uploadfilesmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Uploaded Files</h4>
            </div>
            <div class="modal-body">
                <div id="uploadedfiles_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="myModalpercent" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:1000px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Purchase Order Payments Details</h4>
            </div>
            <div class="modal-body">
                <div id="payment_percent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>




<div id="send_mainto_customer" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
<?php
$attributes = array('id' => 'sub_form_product');
echo form_open_multipart(admin_url("purchase/send_to_mail"), $attributes);
?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Send purchase order to client </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="po_id" class="po_id" value="">
                <div class="row">
<?php $staff_data = get_employee_info(get_staff_user_id()); ?>
<?php echo render_input('from_email', 'From Email', $staff_data->email, 'email', array(), [], 'form-group col-md-6'); ?>
                    <?php echo render_input('from_name', 'From Name', $staff_data->firstname . ' ' . $staff_data->lastname, 'text', array(), [], 'form-group col-md-6'); ?>
                </div>
                <div class="row">
                    <div class="client_list col-md-6">
                        <label for="module_id" class="control-label">Email To</label>
                        <select class="form-control selectpicker" required="" multiple="1" data-live-search="true" id="send_to" name="send_to">
                            <option value=""></option>
                        </select>
                    </div>
<?php echo render_input('email_to', 'Send To', '', 'text', [], [], 'form-group col-md-6'); ?>
                </div>
                <div class="row">
                    <div class="col-md-6">
                        <label for="module_id" class="control-label">Staff CC</label>
<?php
$staff_list = $this->db->query("SELECT email, firstname FROM tblstaff WHERE active = 1")->result_array();
echo render_select('staff_cc[]', $staff_list, array('email', 'email', 'firstname'), '', array(), array('multiple' => true), array(), '', '', false);
?>
                    </div>
                        <?php echo render_input('cc', 'CC', '', 'text', [], [], 'form-group col-md-6'); ?>

                </div>
                    <?php
                    $template_list = $this->db->query("SELECT id, template_name FROM tblemailmoduletemplate WHERE module_id = 10 AND status = 1")->result();
                    ?>
                <div class="form-group module_template" app-field-wrapper="name">
                    <label for="module_id" class="control-label">Select Template</label>
                    <select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id">
                        <option value=""></option>
                    </select>
                </div>
                <h5 class="bold"><?php echo _l('proposal_preview_template'); ?></h5>
                <hr />
<?php
$editors = array();
array_push($editors, 'message');
?>
                <?php echo render_textarea('message', '', '', array('rows' => 4, 'class' => 'tinymce tinymce-manual'), array(), '', 'tinymce tinymce-manual'); ?>
                <?php echo form_hidden('template_name', "purchase_order"); ?>
                <div class="module_attech"></div>
                <div class="form-group">
                    <label for="drawing" class="control-label">File</label>
                    <input type="file" id="filer_input2" class="form-control"  name="attach_files[]" multiple="">
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                <button type="submit" autocomplete="off" class="btn btn-info">Send</button>
                <!--        <button type="submit" autocomplete="off" data-loading-text="Please wait..." class="btn btn-info">Send</button>-->
            </div>
        </div>
<?php echo form_close(); ?>
    </div>
</div>
<div id="auditstatusmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        Material Audit
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Material Audit</h4>
            </div>
            <div class="modal-body" >
                <div class="row" id="audit_div"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
    </div>
</div>

<div id="handover_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title handover_title">Delivery Hand Overs</h4>
      </div>
      <div class="modal-body" id="handover_data">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>
<!-- Modal -->
<div id="deliveryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title action_title"></h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('purchase/make_delivery'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">
        	<div class="form-group col-md-6">
                <label for="priority" class="control-label">Priority *</label>
                <select class="form-control selectpicker" name="priority" required="">
                    <option value=""></option>
                    <option value="1">Low</option>
          					<option value="2">Medium</option>
          					<option value="3">High</option>
          					<option value="4">Urgent</option>
                </select>
            </div>
            <div class="form-group col-md-6" app-field-wrapper="date">
                <label for="delivery_date" class="control-label" id="date_type">Delivery Date</label>
                <div class="input-group date">
                    <input id="delivery_date" name="delivery_date" class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="branch_id" class="control-label">Select Branch *</label>
                <select class="form-control selectpicker" name="branch_id" required="">
                    <option value=""></option>
                    <?php
                    if(!empty($branch_info)){
                        foreach ($branch_info as $branch) {
                            ?>
                            <option value="<?php echo $branch->id; ?>"><?php echo $branch->comp_branch_name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="name" class="control-label">Description </label>
                <textarea id="description" name="description" class="form-control"><?php echo (isset($event['description']) && $event['description'] != "") ? $event['description'] : "" ?></textarea>
            </div>
            <input type="hidden" id="chalan_id" name="po_id">
            <input type="hidden" id="for" name="for">
        </div>
        <div class="text-right">
            <button class="btn btn-info" type="submit">Submit</button>
        </div>
    	</form>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
  </div>
</div>



<div id="upload_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
            </div>
            <div class="modal-body">

                <div id="upload_data">

                </div>

                <form action="<?php echo admin_url('purchase/po_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">

                        <div class="form-group col-md-12">
                            <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                            <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                        </div>

                        <input type="hidden" id="po_id" name="po_id">
                    </div>

                    <div class="text-right">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>
                </form>

            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>


        <?php init_tail(); ?>
<script src="<?php echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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

        $('#newtable').DataTable({
            "iDisplayLength": 20,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']

            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                'colvis',
            ]

        });
         $('#newtable1').DataTable({
            "iDisplayLength": 20,
            dom: 'Bfrtip',
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']

            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                'colvis',
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
        var po_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
            data: {'po_id': po_id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });

    $('.uploadfilelist').click(function () {
        var po_id = $(this).data('id');
        var type = $(this).data('type');
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_mr_uploaded_files'); ?>",
            data: {'po_id': po_id, 'type': type},
            success: function (response) {
                if (response != '') {
                    $("#uploadedfiles_html").html(response);
                }
            }
        })
    });
</script>

<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var id = $(this).val();
        $('#po_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_po_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#upload_data').html(response);
                }
            }
        })

    });
</script>

<script type="text/javascript">
    $(".myselect").select2();
</script>

<script type="text/javascript">
    $('.percent').click(function () {
        var po_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_payment_percent'); ?>",
            data: {'po_id': po_id},
            success: function (response) {
                if (response != '') {
                    $("#payment_percent").html(response);
                }
            }
        })
    });
</script>
<script>
    $(function () {
<?php foreach ($editors as $id) { ?>
            init_editor('textarea[name="<?php echo $id; ?>"]', {urlconverter_callback: 'merge_field_format_url'});
<?php } ?>
        var merge_fields_col = $('.merge_fields_col');
        // If not fields available
        $.each(merge_fields_col, function () {
            var total_available_fields = $(this).find('p');
            if (total_available_fields.length == 0) {
                $(this).remove();
            }
        });
        // Add merge field to tinymce
        $('.send-email').on('click', function (e) {
            e.preventDefault();
            var po_id = $(this).data("id");
            var vid = $(this).data("vid");
            $.ajax({
                type: "POST",
                url: "<?php echo base_url(); ?>admin/purchase/get_vender_list",
                data: {'vid': vid},
                success: function (response) {
                    $(".client_list").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            });
            $(".po_id").val(po_id);
            $("#cc").val("");
            $(".module_template").html('<label for="module_id" class="control-label">Select Template</label><select class="form-control selectpicker" required="" data-live-search="true" id="module_template_id" name="module_template_id"><option value=""></option><?php if (isset($template_list) && count($template_list) > 0) {
    foreach ($template_list as $template) { ?><option value="<?php echo $template->id; ?>"><?php echo cc($template->template_name); ?></option><?php }
} ?></select>');
            $('.selectpicker').selectpicker('refresh');
            tinymce.activeEditor.execCommand('mceSetContent', false, "");
//        $('.selectpicker option:selected').remove();
        });
    });
</script>
<script type="text/javascript">
    $(document).on('change', '#module_template_id', function () {
        tinymce.activeEditor.execCommand('mceSetContent', false, "");
        $(".module_attech").html();
        var tid = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/leads/get_email_template",
            data: {'t_id': tid},
            success: function (response) {
                tinymce.activeEditor.execCommand('mceSetContent', false, response);
//                $('.selectpicker').selectpicker('refresh');
            }
        })

        $.get("<?php echo base_url(); ?>admin/leads/get_templete_attechment/" + tid, function (res) {
            if (res != "") {
                $(".module_attech").html(res);
            }
        })
    });
</script>
<script type="text/javascript">
    $(document).ready(function () {
        'use-strict';

        //Example 2
        $('#filer_input2').filer({
//        limit: 5,
            maxSize: 20,
//        extensions: ['jpg', 'jpeg', 'png' ],
            changeInput: true,
            showThumbs: true,
            addMore: true
        });
    });

    function removeattch(index) {
        if (confirm("Are you sure you want to remove this file?")) {
            $(".box" + index).remove();
        }
    }

    $(document).on("click", ".close-model", function () {
        location.reload();
    });

    $(document).ready(function() {
        $(document).on("click", ".auditstatus", function(){
            $('#auditstatusmodel').modal('show');
            var vendor_id = $(this).data("id");
            $.ajax({
                type: "GET",
                url: "<?php echo base_url('admin/vendor/get_audit_info/'); ?>"+vendor_id,
                success: function (response) {
                    if (response != '') {
                        $("#audit_div").html(response);
                    }
                }
            })
        });
    });

    $(document).on('click', '.handover', function() {

        var po_id = $(this).val();
        var type = $(this).attr('val');
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/purchase/get_handover_data'); ?>",
            data    : {'po_id' : po_id, 'type' : type},
            success : function(response){
                if(response != ''){

                    if(type == 1){
                        var title = 'Delivery Hand Overs';
                    }else{
                        var title = 'Pickup Hand Overs';
                    }

                     $('.handover_title').html(title);
                     $('#handover_data').html(response);
                }
            }
        })

    });

    $(document).on('click', '.action', function() {
      var challan_id = $(this).val();
      var type = $(this).attr('val');
      $('#chalan_id').val(challan_id);
      $('#for').val(type);

        if(type == 1){
            var title = 'Make Challan Delivery';
            var date_type = 'Delivery Date';
        }else{
            var title = 'Make Challan Pickup';
            var date_type = 'Pickup Date';
        }

         $('.action_title').html(title);
         $('#date_type').html(date_type);

    });
</script>
</body>
</html>

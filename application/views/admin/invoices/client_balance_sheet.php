
<?php init_head(); ?>

<style type="text/css">

    /*new style*/

    .sheetWrapper {
        margin-bottom: 50px;
    }

    .company-title {
        text-transform: uppercase;
        font-weight: 600;
        letter-spacing: 1.5px;
        color: rgb(39, 39, 39);
        font-size: 23px;
    }

    .sec-title {
        position: relative;
        z-index: 1;
        margin-bottom:40px;
    }
    .separator {
        margin: 0 auto !important;
        float: none !important;
        width: 40px;
        position: relative;
    }
    .separator span {
        position: absolute;
        left: 50%;
        top: -2px;
        width: 10px;
        height: 5px;
        margin-left: -5px;
        display: inline-block;
        background-color:#2e2e2e;
    }

    .separator:before {
        position: absolute;
        content: '';
        left: 0px;
        top: 0px;
        width: 10px;
        height: 2px;
        background-color: rgb(241, 106, 46);
    }

    .separator:after {
        position: absolute;
        content: '';
        right: 0px;
        top: 0px;
        width: 10px;
        height: 2px;
        background-color: rgb(241, 106, 46);
    }

    .details-table{
        border: 1px solid #F0F2F5;
        box-shadow:0 5px 70px rgba(0, 0, 0, 0.07);
    }

    .details-table thead tr{
        background: #6d7580;
        box-shadow:0 3px 15px rgba(76, 76, 77, 0.15);
    }

    .details-table thead th{
        padding: 15px 5px !important;
        color: #fff !important;
        font-weight: 500 !important;
        letter-spacing: 0.4px;
        border: none !important;
        font-size: 12px;
    }

    .details-table tbody td{
        vertical-align: middle !important;
        padding:10px 5px !important;
        font-weight: 500;
    }

    .details-table > tbody > tr:nth-child(even){
        background:#F0F2F5;
    }

    .details-table tfoot {
        background: #938789;
        color: #F0F2F5;
    }

    .details-table tfoot td{
        font-size: 14px;
        font-weight:500;
        border-top: 1px solid #686263 !important;
    }

    .details-table tfoot td b {
        font-weight:500;
        color: #F0F2F5;
        text-transform: uppercase;
        letter-spacing: 0.5px;
        font-size: 14px;
    }
    .credit_amt{
        color: #00dd1c;
    }
    .debit_amt{
        color: #F44336;
    }

    .bootstrap-select .dropdown-menu li a span.text {
        display: contents;
    }
/*    .table > thead > tr > th {
        background-color: #BD1C33 !important;
    }
    */
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?></h4>

                        <hr class="hr-panel-heading">

                        <div class="row">

                            <div>
                                
                                <div class="col-md-4">
                                    <div class="form-group ">
                                        <label for="client_id" class="control-label">Select Client <small class="req text-danger">* </small></label>
                                        <select class="form-control selectpicker" required="" id="client_id" name="client_id" data-live-search="true">
                                            <option value="" disabled selected >--Select One-</option>
                                            <?php
                                            if (!empty($client_info)) {
                                                foreach ($client_info as $value) {
                                                    ?>
                                                    <option value="<?php echo $value->userid; ?>" <?php if (!empty($client_id) && $client_id == $value->userid) {
                                                echo 'selected';
                                            } ?>  ><?php echo cc($value->company); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="client_branch" class="control-label">Select Client Branch <small class="req text-danger">* </small></label>
                                        <select class="form-control selectpicker" required="" id="client_branch"  name="client_branch[]" multiple="" data-live-search="true">
                                            <option value="">--Select One-</option>
                                            <option data-content="<div class='row'><div class='col-md-8'><span class='badge badge-danger'>Product 01</span></div><div class='col-md-2'><span>25</span></div></div>"value="">Pizzas</option>
                                            <?php
                                            if (!empty($client_branch)) {
                                                foreach ($client_branch as $value) {
                                                    $branch_info = $this->db->query("SELECT * FROM tblclientbranch where userid = '" . $value . "' ")->row();
                                                    ?>
                                                    <option value="<?php echo $branch_info->userid; ?>" selected><?php echo cc($branch_info->client_branch_name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>


                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="service_type" class="control-label">Service Type <small class="req text-danger">* </small></label>
                                        <select class="form-control selectpicker" required="" id="service_type"  name="service_type[]" multiple>
                                            <option value="1" <?php echo (!empty($service_type) && in_array("1", $service_type)) ? 'selected':''; ?>>Rent</option>
                                            <option value="2" <?php echo (!empty($service_type) && in_array("2", $service_type)) ? 'selected':''; ?>>Sales</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <div class="form-group">
                                        <label for="site_id" class="control-label">Invoice Flow <small class="req text-danger">* </small></label>
                                        <select class="form-control selectpicker" required="" id="flow"  name="flow">
                                            <option value="asc" <?php if (!empty($flow) && $flow == 'asc') {
                                                echo 'selected';
                                            } ?>>Old to New</option>
                                            <option value="desc" <?php if (!empty($flow) && $flow == 'desc') {
                                                echo 'selected';
                                            } ?>>New to Old</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-4">
                                    <div class="form-group">
                                        <label for="site_id" class="control-label">Select Site </small></label>
                                        <select class="form-control selectpicker" id="site_id"  name="site_id[]" multiple="" data-live-search="true">
                                            <option value="">--Select One-</option>
                                            <?php
                                            if (!empty($site_ids)) {
                                                foreach ($site_ids as $value) {
                                                    $site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '" . $value . "' ")->row();
                                                    ?>
                                                        <option value="<?php echo $site_info->id; ?>" selected><?php echo cc($site_info->name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>            
                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
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


<?php

$allinvoice_ids = 0;
$alldn_ids = 0;
$ttl_billing = 0;
if (!empty($site_ids)) {

    $branch_str = implode(",", $client_branch);
    $servicetype_str = implode(",", $service_type);
    //$payment_debitnote = $this->db->query("SELECT * FROM tbldebitnotepayment where clientid = '".$client_id."' and status = '1' order by date ".$flow." ")->result();
    ?>
        <form action="<?php echo admin_url('invoices/ledger_pdf'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" target="_balnk">
            <input type="hidden" value="<?php echo implode(",", $site_ids); ?>" name="site_ids">	
            <input type="hidden" value="<?php echo $branch_str; ?>" name="client_branch">	
            <input type="hidden" value="<?php echo $client_id; ?>" name="client_id">	
            <input type="hidden" value="<?php echo $flow; ?>" name="flow">	
            <input type="hidden" value="<?php echo $servicetype_str; ?>" name="service_type[]">	
            <div class="content">
                <div class="row">
                    <div class="col-md-12">
                        <div class="panel_s">
                            <div class="panel-body">
                                <?php
                                    $invoice_data = array();
                                    $i = 0;
                                    $grand_bal = 0;
                                    $grand_recevied = 0;
                                    foreach ($site_ids as $s_id) {

                                        $site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '" . $s_id . "' ")->row();
                                        $invoicedata = get_client_invoice_records($s_id, $servicetype_str , $branch_str, $f_date, $t_date);
                                        
                                        $orderflow = ($flow == "asc") ? "asc_date_compare" : "desc_date_compare";
                                        usort($invoicedata, $orderflow);
                                ?>
                                        <div class="sheetWrapper">
                                            <div class="sec-title">
                                                <!--<h3 class="company-title label label-info"><?php echo isset($site_info) ? $site_info->name : ""; ?></h3>-->
                                                <div class="table-responsive">
                                                <table class="table details-table">
                                                    <thead>
                                                        <tr>
                                                            <th align="center">Site Name</th>
                                                            <th align="center">Date</th>
                                                            <th align="center">Number</th>
                                                            <th align="center">Doc. Type</th>
                                                            <th align="center">Credit</th>
                                                            <th align="center">Debit</th>
                                                            <th align="center">Balance</th>
                                                        </tr>
                                                    </thead>
                                                    <tbody>
                                                        <?php
                                                            $bal_amount = 0.00;
                                                            if (!empty($invoicedata)){
                                                                $trecord = count($invoicedata);
                                                                foreach ($invoicedata as $k => $value) {
                                                                    $debit = $credit = "0.00";
                                                                    if (in_array($value["type"], ["Invoice", "Debit Note", "Delay in Payment"])){
                                                                        $debit = $value["amount"];
                                                                        $bal_amount += $value["amount"];
                                                                    }elseif (in_array($value["type"], ["Invoice Payments", "DN Payment", "Credit Note", "Delay in Payment Receipt"])) {
                                                                        $credit = $value["amount"];
                                                                        $bal_amount -= $value["amount"];
                                                                    }
                                                                    
                                                                    $sitecol = ($k == 0) ? '<td style="font-style: italic;font-size:20px; text-align:center;border: 3px solid #938789;" rowspan="'.$trecord.'">'.cc($site_info->name).'</td>' : "";
                                                                    echo '<tr>'. $sitecol. '<td align="center">'.$value["date"].'</td>'
                                                                            . '<td align="center">'.$value["number"].'</td>'
                                                                            . '<td align="center">'.$value["type"].'</td>'
                                                                            . '<td align="center" class="credit_amt"> - '.$credit.'</td>'
                                                                            . '<td align="center" class="debit_amt"> + '.$debit.'</td>'
                                                                            . '<td align="center">'.$bal_amount.'</td>'
                                                                        . '</tr>';
                                                                }
                                                            }else{
                                                                echo '<tr><td colspan="7" class="text-center">Record not found</td></tr>';
                                                            }
                                                            
                                                            $grand_bal += $bal_amount;
                                                        ?>
                                                        
                                                    </tbody>
                                                    <tfoot>
                                                        <tr>
                                                            <td colspan="4"></td>
                                                            <td colspan="2" align="center" style="font-size:20px;">Total Balance</td>
                                                            <td colspan="1" align="center" style="font-size:20px;"><?php echo number_format($bal_amount, 2); ?></td>
                                                        </tr>
                                                    </tfoot>
                                                </table>    
                                            </div>
                                            </div>
                                        </div>
                                <?php
                               
                                    }

                                $onaccout_amt = 0;
                                $onaccout_amt_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (" . $branch_str . ") and payment_behalf = 1 and service_type IN (" . $servicetype_str . ") and status = 1 ")->result();
                                if (!empty($onaccout_amt_info)) {
                                    foreach ($onaccout_amt_info as $on_am) {
                                        $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
                                        if ($to_see == 1) {
                                            $onaccout_amt += $on_am->ttl_amt;
                                        }
                                    }
                                }
                                $onaccountwhere = $waveoffwhere = $pendingchequewhere = $clientdepositswhere = "";
                                if (!empty($f_date) && !empty($t_date)){
                                    $clientdepositswhere = "and date BETWEEN '".db_date($f_date)."' AND '".db_date($t_date)."'";
                                    $onaccountwhere = "and date BETWEEN '".db_date($f_date)."' AND '".db_date($t_date)."'";
                                    $waveoffwhere = "and DATE(created_date) BETWEEN '".db_date($f_date)."' AND '".db_date($t_date)."'";
                                    $pendingchequewhere = "and cheque_date BETWEEN '".db_date($f_date)."' AND '".db_date($t_date)."'";
                                }
                                $waveoff_amt = $this->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN (" . $branch_str . ") and status = 1 and service_type IN (" . $servicetype_str . ") ".$waveoffwhere." ")->row()->ttl_amount;
                                $onaccout_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (" . $branch_str . ") and payment_behalf = 1 and service_type IN (" . $servicetype_str . ")  and status = 1 ".$onaccountwhere." ")->result();
                                $waveoff_info = $this->db->query("SELECT * FROM `tblclientwaveoff`  where client_id IN (" . $branch_str . ") and status = 1 and service_type IN (" . $servicetype_str . ") ".$waveoffwhere." ")->result();
                                $pendingcheque_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (" . $branch_str . ") and payment_mode = 1 and chaque_status IN (0,2,3,4) and status = 1 ".$pendingchequewhere." ")->result();
                                $clientdeposits_info = $this->db->query("SELECT * FROM `tblclientdeposits`  where client_id IN (" . $branch_str . ") and status = 1 ".$clientdepositswhere."")->result();
                                $final_balance = (round($grand_bal) - round($onaccout_amt) - round($waveoff_amt));
                                ?>
                                <table class="table details-table">
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Total Balance</b></td>
                                            <td colspan="4" class="text-center"><?php echo round($grand_bal) . '.00'; ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Onaccount</b></td>
                                            <td colspan="4" class="text-center">-<?php echo round($onaccout_amt) . '.00'; ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php
                                        //if($waveoff_amt > 0){
                                        if (!empty($waveoff_info)) {
                                            foreach ($waveoff_info as $wave_row) {
                                                ?>
                                                <tr>
                                                    <td colspan="4" class="text-center"><b><?php echo ($wave_row->amount > 0) ? '-' : '+'; ?> <?php echo (!empty($wave_row->remark)) ? $wave_row->remark : 'Waveoff' ?> </b></td>
                                                    <td colspan="4" class="text-center"> <?php echo round($wave_row->amount) . '.00'; ?></td>
                                                    <td colspan="4"></td>
                                                </tr>
                                                <?php
                                            }
                                        }
                                        ?>

                                        <tr>
                                            <td colspan="4" class="text-center"><b>Final Balance</b></td>
                                            <td colspan="4" class="text-center"><?php echo round($final_balance) . '.00'; ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>

                                <?php
                                // IF there is only one recored of payment which is made by cheque and cheque is not clear
                                if (count($onaccout_info) == 1) {
                                    if ($onaccout_info[0]->payment_mode == 1 && $onaccout_info[0]->chaque_status != 1) {
                                        $onaccout_info = '';
                                    }
                                }


                                if (!empty($onaccout_info)) {
                                    ?>
                                    <div class="sec-title">
                                        <h3 class="text-center company-title">On Account Details</h3>
                                        <div class="separator"><span></span></div>
                                    </div>
                                    <table class="table details-table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date</th>
                                                <th>Reference No.</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($onaccout_info as $key => $on_acc) {

                                                $to_see = ($on_acc->payment_mode == 1 && $on_acc->chaque_status != 1) ? '0' : '1';

                                                if ($to_see == 1) {
                                                    ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo _d($on_acc->date); ?></td>
                                                        <td><?php echo $on_acc->reference_no; ?></td>
                                                        <td><?php echo $on_acc->ttl_amt; ?></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                        <?php
                                    }

                                    if (!empty($pendingcheque_info)) {
                                        ?>
                                    <div class="sec-title">
                                        <h3 class="text-center company-title">Pending Cheque Details</h3>
                                        <div class="separator"><span></span></div>
                                    </div>
                                    <table class="table details-table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Cheque No</th>
                                                <th>Cheque Date.</th>
                                                <th>Cheque Status</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($pendingcheque_info as $key => $client_pay) {
                                                if ($client_pay->chaque_status == 0) {
                                                    $status = 'Pending';
                                                } else if ($client_pay->chaque_status == 2) {
                                                    $status = 'Bounced';
                                                } else if ($client_pay->chaque_status == 3) {
                                                    $status = 'Redeposit';
                                                } else {
                                                    $status = 'Cancel';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo $client_pay->cheque_no; ?></td>
                                                    <td><?php echo _d($client_pay->cheque_date); ?></td>
                                                    <td><?php echo $status; ?></td>
                                                </tr>
                                                <?php
                                            }
                                            ?>

                                        </tbody>
                                    </table>
                                        <?php
                                    }

                                    if (!empty($clientdeposits_info)) {
                                        ?>
                                    <div class="sec-title">
                                        <h3 class="text-center company-title">Client Deposit Details</h3>
                                        <div class="separator"><span></span></div>
                                    </div>
                                    <table class="table details-table">
                                        <thead>
                                            <tr>
                                                <th>Sr. No.</th>
                                                <th>Date</th>
                                                <th>PaymentMode</th>
                                                <th>Bank</th>
                                                <th>Amount</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            foreach ($clientdeposits_info as $key => $deposit) {
                                                if ($deposit->payment_mode == 1) {
                                                    $mode = 'Cheque';
                                                } else if ($deposit->payment_mode == 2) {
                                                    $mode = 'NEFT';
                                                } else if ($deposit->payment_mode == 3) {
                                                    $mode = 'Cash';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo _d($deposit->date); ?></td>
                                                    <td><?php echo $mode; ?></td>

                                                    <td><?php echo value_by_id("tblbankmaster", $deposit->bank_id, "name"); ?></td>
                                                    <td><?php echo $deposit->ttl_amt; ?></td>
                                                </tr>
                                        <?php
                                    }
                                    ?>

                                        </tbody>
                                    </table>
                                <?php } ?>


<!--                                <div class="btn-bottom-toolbar text-right">
                                    <button class="btn btn-info" value="1" name="mark" type="submit">Ledger Pdf</button>
                                    <button class="btn btn-success" value="2" name="mark" type="submit">Ledger Export</button>
                                </div>-->
                            </div>

                        </div>
                    </div>

                </div>
        </form>


    <?php
}
?>

<?php init_tail(); ?>

    <script type="text/javascript">
        $(document).on('change', '#client_id', function () {
            var client_id = $(this).val();

            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/Invoices/get_branch'); ?>",
                data: {'client_id': client_id},
                success: function (response) {
                    if (response != '') {
                        $('#client_branch').html(response);
                        $('.selectpicker').selectpicker('refresh');
                    }
                }
            })

        });
    </script>


    <script type="text/javascript">
        $(document).on('change', '#client_branch, #service_type', function () {
            var client_branch = $("#client_branch").val();
            var service_type = $("#service_type").val();
            if (client_branch != '' && service_type != '') {
                $.ajax({
                    type: "POST",
                    url: "<?php echo site_url('admin/Invoices/get_sites'); ?>",
                    data: {'client_branch': client_branch, 'service_type': service_type},
                    success: function (response) {
                        if (response != '') {
                            $('#site_id').html(response);
                            $('.selectpicker').selectpicker('refresh');
                        }
                    }
                })
            }

        });
    </script>


</body>
</html>

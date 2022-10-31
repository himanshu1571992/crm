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
		background: #f0f2f5;
	}
	
	.details-table tfoot td{
		font-size: 14px;
		font-weight:500;
		border-top: 1px solid #e5e5e5 !important;
	}
	
	.details-table tfoot td b {
		font-weight:500;
		color: rgb(39, 39, 39);
		text-transform: uppercase;
		letter-spacing: 0.5px;
		font-size: 14px;
	}
	
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
                                        <label for="vandor_id" class="control-label">Select Vendor <small class="req text-danger">* </small></label>
                                        <select class="form-control selectpicker" required="" id="vendor_id" name="vendor_id" data-live-search="true">
                                            <option value="" disabled selected >--Select One-</option>
                                            <?php
                                            if (!empty($vendors_info)) {
                                                foreach ($vendors_info as $value) {
                                                    ?>
                                                    <option value="<?php echo $value->id; ?>" <?php echo (!empty($vendor_id) && $vendor_id == $value->id) ? 'selected' : ''; ?>  ><?php echo cc($value->name); ?></option>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php
                                        if (!empty($f_date)) {
                                            echo $f_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php
                                        if (!empty($t_date)) {
                                            echo $t_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>      
            <?php echo form_close(); ?>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php
$allinvoice_ids = 0;
$alldn_ids = 0;
$ttl_billing = 0;

if (isset($vendor_id) && !empty($vendor_id)){
?>
    <form action="<?php echo admin_url('vendor/ledger_pdf'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" target="_balnk">
        <input type="hidden" value="<?php echo $vendor_id; ?>" name="vendor_id">
        <?php if (!empty($f_date)) { ?>
        <input type="hidden" value="<?php echo $f_date; ?>" name="f_date">	
        <?php }
        if (!empty($t_date)) { ?>
        <input type="hidden" value="<?php echo $t_date; ?>" name="t_date">	
        <?php } ?>
        <div class="content">
            <div class="row">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <table class="table details-table">
                                <thead>
                                    <tr>
                                        <th>Invoice Number <br><input type="checkbox" value="1" name="printdata[inv_no]" checked></th>
                                        <th>Invoice Date <br><input type="checkbox" value="1" name="printdata[inv_date]" checked></th>
                                        <th>Invoice Amt <br><input type="checkbox" value="1" name="printdata[inv_amt]" checked></th>
                                        <th>Total Paid <br><input type="checkbox" value="1" name="printdata[ttl_paid]" checked></th>								
                                        <th>Payment Amt <br><input type="checkbox" value="1" name="printdata[payment_amt]" checked></th>
                                        <th>Balance <br><input type="checkbox" value="1" name="printdata[balance]" checked></th>											
                                        <th>Paid Date <br><input type="checkbox" value="1" name="printdata[paid_date]" checked></th>
                                        <th>Ref Detail <br><input type="checkbox" value="1" name="printdata[ref_details]" ></th>
                                        <th>Method <br><input type="checkbox" value="1" name="printdata[method]"></th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                        $ttl_bal = $ttl_recv = $ttl_amt = $grand_bal = 0;
                                        
                                        if(isset($invoicelist) && !empty($invoicelist)){
                                            foreach ($invoicelist as $invoice_row) {
                                                
                                                $payment_info = $this->db->query("SELECT `pop`.`id`,`pop`.`amount` FROM `tblpurchaseorderpayments` as pop LEFT JOIN `tblbankpaymentdetails` as bpd ON bpd.`pay_type_id` = pop.`id` AND bpd.`pay_type`='po_payment'  LEFT JOIN `tblbankpayment` as bp ON bp.`id` = bpd.`main_id` WHERE `pop`.`po_id` = '".$invoice_row->po_id."' AND `bp`.`status` = 1")->result();
                                                $received = 0;
                                                if(!empty($payment_info)){
                                                    foreach ($payment_info as $value) {
                                                        $received += $value->amount;
                                                    }
                                                }
                                                $bal_amt = ($invoice_row->totalamount - $received);
                                                
//                                                $ttl_recv += $received;
                                                $ttl_amt += $invoice_row->totalamount;
                                                $ttl_bal += $bal_amt; 
                                                $ttl_billing += $invoice_row->totalamount;
                                                $grand_bal += $bal_amt; 
                                                $pdf_url = admin_url("purchase/purchase_invoice_pdf/");
                                                $bank_payment = $this->db->query("SELECT `pop`.`id`, `bpd`.`method`,`pop`.* FROM `tblpurchaseorderpayments` as pop LEFT JOIN `tblbankpaymentdetails` as bpd ON bpd.`pay_type_id` = pop.`id` AND bpd.`pay_type`='po_payment'  LEFT JOIN `tblbankpayment` as bp ON bp.`id` = bpd.`main_id` WHERE `pop`.`po_id` = '".$invoice_row->po_id."' AND `bp`.`status` = 1")->result();
                                               
                                                if (!empty($bank_payment)){
                                                    $j = 0;
                                                    foreach ($bank_payment as $payment) {
                                                        
                                                        $inv_amt = ($j == 0) ? $invoice_row->totalamount : "--";
                                                        $total_paid = ($j == 0) ? $received : '--';
                                                        $balance_amt = ($j == 0) ? number_format($bal_amt, 2): "--";
                                                        $payment_date = ($payment->amount > 0 && !empty($payment->payment_date)) ? _d($payment->payment_date) : '--';
                                                        $reference_number = (!empty($invoice_row->reference_number)) ? $invoice_row->reference_number : "--";
                                                         echo '<tr>'
                                                        . '<td><a target="_blank" href="'.$pdf_url.$invoice_row->id.'">Inv-'.str_pad($invoice_row->id, 4, '0', STR_PAD_LEFT).'</a></td>'
                                                            . '<td>'._d($invoice_row->date).'</td>'
                                                            . '<td>'.$inv_amt.'</td>'
                                                            . '<td>'.$total_paid.'</td>'
                                                            . '<td>'.$payment->amount.'</td>'
                                                            . '<td>'.$balance_amt.'</td>'
                                                            . '<td>'.$payment_date.'</td>'
                                                            . '<td>'.$reference_number.'</td>'
                                                            . '<td>'.$payment->method.' ('.$payment->utr_no.')</td>'
                                                    . '</tr>';
                                                        $j++;
                                                    }
                                                }  else {
                                                    echo '<tr>'
                                                        . '<td><a target="_blank" href="'.$pdf_url.$invoice_row->id.'">Inv-'.str_pad($invoice_row->id, 4, '0', STR_PAD_LEFT).'</a></td>'
                                                            . '<td>'._d($invoice_row->date).'</td>'
                                                            . '<td>'.$invoice_row->totalamount.'</td>'
                                                            . '<td>0.00</td>'
                                                            . '<td>0.00</td>'
                                                            . '<td>'.number_format($bal_amt, 2).'</td>'
                                                            . '<td>--</td>'
                                                            . '<td>--</td>'
                                                            . '<td>--</td>'
                                                    . '</tr>';
                                                }
                                                
                                                $debitnoteinfo = $this->db->query("SELECT `pdn`.* FROM `tblpurchasedabitnote` as pdn LEFT JOIN `tblpurchasechallanreturn` as pcr ON `pcr`.id = `pdn`.parchasechallanreturn_id WHERE `pcr`.`po_id` = '".$invoice_row->po_id."' ")->result();
                                                
                                                if (!empty($debitnoteinfo)){
                                                    foreach ($debitnoteinfo as $dvalue) {
                                                        $ttl_recv += $dvalue->totalamount;
                                                        $ttl_bal -= $dvalue->totalamount;
							$grand_bal -= $dvalue->totalamount;
                                                        $pdf_url = admin_url("purchasechallanreturn/download_debitnotepdf/");
                                                        echo '<tr>'
                                                        . '<td><a target="_blank" href="'.$pdf_url.$dvalue->id.'">PDN-'.str_pad($dvalue->id, 4, '0', STR_PAD_LEFT).'</a></td>'
                                                            . '<td>'._d($dvalue->date).'</td>'
                                                            . '<td>0.00</td>'
                                                            . '<td>'.$dvalue->totalamount.'</td>'
                                                            . '<td>0.00</td>'
                                                            . '<td>0.00</td>'
                                                            . '<td>--</td>'
                                                            . '<td>--</td>'
                                                            . '<td>--</td>'
                                                    . '</tr>';
                                                    }
                                                }
                                            }
                                            
                                        }
                                        
                                    ?>    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="2" class="text-center"><b>Total</b></td>
                                        <td colspan="1" class="text-left"><b><?php echo number_format($ttl_amt, 2); ?></b></td>
                                        <td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2); ?></b></td>											
                                        <td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2); ?></b></td>											
                                        <td colspan="1" class="text-left"><b><?php echo number_format($ttl_bal, 2); ?></b></td>
                                        <td colspan="4" class="text-left"></td>
                                    </tr>										
                                </tfoot>
                                <?php
                                    $onaccout_amt = 0.00;
                                    $onaccout_info = $this->db->query("SELECT * FROM `tblvendorpayment`  where vendor_id = ".$vendor_id." and payment_behalf = 1 and status = 1 ")->result();
                                    if(!empty($onaccout_info)){
                                        foreach ($onaccout_info as $on_am) {
                                            $to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
                                            if($to_see == 1){
                                                $onaccout_amt += $on_am->ttl_amt;
                                            }
                                        }
                                    }
                                ?>
                            </table>
                            
                            <table class="table details-table">
                                    <tfoot>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Total Billing</b></td>
                                            <td colspan="4" class="text-center"><?php echo number_format(round($ttl_billing), 2); ?></td>
                                            <td colspan="4"></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" class="text-center"><b>Total Recevied</b></td>
                                            <td colspan="4" class="text-center"><?php echo number_format(round($ttl_recv), 2); ?></td>
                                            <td colspan="4"></td>
                                        </tr>

                                        <tr>
                                            <td colspan="4" class="text-center"><b>Total Balance</b></td>
                                            <td colspan="4" class="text-center"><?php echo number_format(round($grand_bal), 2); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Onaccount</b></td>
                                            <td colspan="4" class="text-center">-<?php echo number_format(round($onaccout_amt), 2); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php if (isset($client_outstanding) && $client_outstanding > 0){ ?>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>- Client Outstanding</b></td>
                                            <td colspan="4" class="text-center"><?php echo $client_outstanding; ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                        <?php } ?>
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Final Balance</b></td>
                                            <td colspan="4" class="text-center"><?php echo number_format((round($grand_bal) - round($onaccout_amt) - $client_outstanding), 2); ?></td>
                                            <td colspan="4"></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            
                                <?php

				// IF there is only one recored of payment which is made by cheque and cheque is not clear
                                if(count($onaccout_info) == 1){
                                    if($onaccout_info[0]->payment_mode == 1 && $onaccout_info[0]->chaque_status != 1){
                                        $onaccout_info = '';
                                    }
                                }

				if(!empty($onaccout_info)){
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

                                                    if($to_see == 1){
                                                    ?>
                                                    <tr>
                                                            <td><?php echo ++$key; ?></td>
                                                            <td><?php echo _d($on_acc->date); ?></td>
                                                            <td><?php echo ($on_acc->reference_no) ? $on_acc->reference_no : "--"; ?></td>
                                                            <td><?php echo $on_acc->ttl_amt; ?></td>
                                                    </tr>
                                                    <?php	
                                                    }
                                                }
                                            ?>
                                        </tbody>
                                    </table>
				<?php } ?>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" value="1" name="mark" type="submit">ledger Pdf</button>
                            </div>    
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </form>    
<?php
}
?>        
<?php init_tail(); ?>
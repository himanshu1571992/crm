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
	}
	
	.details-table tfoot td{
		font-size: 14px;
		font-weight:500;
                color: #FFFFE6;
		border-top: 1px solid #686263 !important;
	}
	
	.details-table tfoot td b {
		font-weight:500;
		color: #FFFFE6;
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
/*        .table > thead > tr > th {
            background-color: #BD1C33 !important;
        }*/
	
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
                            <div class="table-responsive">
                                <table class="table details-table">
                                <thead>
                                    <tr>
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
                                        $ttl_bal = $ttl_recv = $ttl_amt = $grand_bal = $bal_amount = 0;
                                        
                                        if(isset($invoicelist) && !empty($invoicelist)){
                                            foreach ($invoicelist as $value) {
                                                
                                                $debit = $credit = "0.00";
                                                if (in_array($value["type"], ["Invoice"])){
                                                    $debit = $value["amount"];
                                                    $bal_amount += $value["amount"];
                                                }elseif (in_array($value["type"], ["Invoice Payments", "DN Payment"])) {
                                                    $credit = $value["amount"];
                                                    $bal_amount -= $value["amount"];
                                                }
                                                echo '<tr><td align="center">'.$value["date"].'</td>'
                                                        . '<td align="center">'.$value["number"].'</td>'
                                                        . '<td align="center">'.$value["type"].'</td>'
                                                        . '<td align="center" class="credit_amt"> - '.$credit.'</td>'
                                                        . '<td align="center" class="debit_amt"> + '.$debit.'</td>'
                                                        . '<td align="center">'.number_format($bal_amount, 2).'</td>'
                                                    . '</tr>';
                                            }
                                        }else{
                                            echo '<tr><td colspan="6" class="text-center">Record not found</td></tr>';
                                        }
                                        $grand_bal += $bal_amount;
                                    ?>    
                                </tbody>
                                <tfoot>
                                    <tr>
                                        <td colspan="3"></td>
                                        <td colspan="2" align="center" style="font-size:20px;">Total Balance</td>
                                        <td colspan="1" align="center" style="font-size:20px;"><?php echo number_format($bal_amount, 2); ?></td>
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
                            </div>
                            
                            
                            <table class="table details-table">
                                    <tfoot>
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
                                        <tr>
                                            <td colspan="4" class="text-center"><b>Final Balance</b></td>
                                            <td colspan="4" class="text-center"><?php echo number_format((round($grand_bal) - round($onaccout_amt)), 2); ?></td>
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
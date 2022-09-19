
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
						<h4 class="no-margin">Client Ledger</h4>
						<hr class="hr-panel-heading">
						<div class="row">
							<div>
								<div class="col-md-4">
									<div class="form-group ">
										<label for="client_id" class="control-label">Select Client <small class="req text-danger">* </small></label>
										<select class="form-control selectpicker" required="" id="client_id" name="client_id" data-live-search="true">
											<option value="" disabled selected >--Select One-</option>
											<?php
											if(!empty($client_info)){
												foreach ($client_info as $value) {
													?>
													<option value="<?php echo $value->userid;?>" <?php if(!empty($client_id) && $client_id == $value->userid){ echo 'selected';} ?>  ><?php echo cc($value->company); ?></option>
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
											<?php
											if(!empty($client_branch)){
												foreach ($client_branch as $value) {
													$branch_info = $this->db->query("SELECT * FROM tblclientbranch where userid = '".$value."' ")->row();
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
										<select class="form-control selectpicker" required="" id="service_type"  name="service_type">
											<option value="1" <?php if(!empty($service_type) && $service_type == '1'){ echo 'selected';} ?>>Rent</option>
											<option value="2" <?php if(!empty($service_type) && $service_type == '2'){ echo 'selected';} ?>>Sales</option>
										</select>
									</div>
								</div>
								<div class="col-md-2">
									<div class="form-group">
										<label for="site_id" class="control-label">Invoice Flow <small class="req text-danger">* </small></label>
										<select class="form-control selectpicker" required="" id="flow"  name="flow">
											<option value="asc" <?php if(!empty($flow) && $flow == 'asc'){ echo 'selected';} ?>>Old to New</option>
											<option value="desc" <?php if(!empty($flow) && $flow == 'desc'){ echo 'selected';} ?>>New to Old</option>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="site_id" class="control-label">Select Site</label>
										<select class="form-control selectpicker" id="site_id"  name="site_id[]" multiple="" data-live-search="true">
											<option value="">--Select One-</option>
											<?php
												if(!empty($site_ids)){
													foreach ($site_ids as $value) {
														$site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '".$value."' ")->row();
											?>
														<option value="<?php echo $site_info->id; ?>" selected><?php echo cc($site_info->name); ?></option>
											<?php
													}
												}
											?>
										</select>
									</div>
								</div>
								<div class="col-md-4">
									<div class="form-group">
										<label for="financialyear" class="control-label">Financial Year</label>
										<select name="year_id" id="year_id" class="form-control selectpicker">
											<option value=""></option>
											<?php 
												if (!empty($financial_year_list)){
													foreach ($financial_year_list as $fyear) {
														$selectedcls = ($year_id == $fyear->id) ? 'selected=""' : '';
														echo '<option value="'.$fyear->id.'" '.$selectedcls.'>'.$fyear->name.'</option>';
													}
												}
											?>
										</select>
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
if(!empty($client_branch)){
	$branch_str = 0;
	if(!empty($client_branch)){			
		$branch_str = implode(",",$client_branch);
	}
	if(empty($service_type)){
		$service_type = '0';
	}
	//$payment_debitnote = $this->db->query("SELECT * FROM tbldebitnotepayment where clientid = '".$client_id."' and status = '1' order by date ".$flow." ")->result();
?>
<form action="<?php echo admin_url('invoices/ledger_pdf'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" target="_balnk">
<input type="hidden" value="<?php echo (!empty($site_ids)) ? implode(",",$site_ids) : ''; ?>" name="site_ids">
<input type="hidden" value="<?php echo $branch_str; ?>" name="client_branch">
<input type="hidden" value="<?php echo (!empty($client_id)) ? $client_id : ''; ?>" name="client_id">
<input type="hidden" value="<?php echo (!empty($flow)) ? $flow : ''; ?>" name="flow">
<input type="hidden" value="<?php echo (!empty($service_type)) ? $service_type : ''; ?>" name="service_type">
<input type="hidden" value="<?php echo (!empty($year_id)) ? $year_id : ''; ?>" name="year_id">

<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel_s">
				<div class="panel-body">
					<?php
						$i = 0;
						$grand_bal = 0;
						$grand_recevied = 0;
						if(!empty($site_ids)){
						foreach ($site_ids as $s_id) {
							$i++;
							$site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '".$s_id."' ")->row();

							if (!empty($year_id)){
								$parent_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and year_id = '".$year_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();
							}else{
								$parent_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();
							}

							$running_closed_data = '';
							if($service_type == 1){

								$financialyear = (!empty($year_id)) ? $year_id : financial_year();
								if(financial_year() == 1){
						            $where_running = "clientid IN (".$branch_str.") and site_id = '".$s_id."' and status != '5' and service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".$financialyear."' ";
						        }else{
						            $where_running = "clientid IN (".$branch_str.") and site_id = '".$s_id."' and status != '5' and service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".$financialyear."' ";
						        }
								
						        $reunning_invoice = $this->db->query("SELECT * FROM tblinvoices where ".$where_running." ")->row();

						        if(!empty($reunning_invoice)){
						        	$running_closed_data = '<h5 style="color: green;">Running Site</h5>';
						        }else{
						        	$running_closed_data = '<h5 style="color: red;">Closed Site</h5>';
						        }
							}


							?>
							<div class="sheetWrapper">
								<div class="sec-title">
									<?php echo $running_closed_data; ?><h3 class="text-center company-title"><?php echo isset($site_info) ? $site_info->name : ""; ?><small style="text-transform: capitalize;"><a target="_blank" href="<?php echo admin_url('invoices/invoice_products/'.$s_id.'/'.$branch_str.'/'.$service_type.'/'.$flow); ?>">(Product Details)</a></small></h3>
									<div class="separator"><span></span></div>
								</div>
								<table class="table details-table">
									<thead>
										<tr>
											<?php
											if($service_type == 1){
											?>
											<th>Start Date  <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[start_end_date]" checked>'; } ?></th>
											<th>End Date <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[start_end_date]" checked>'; } ?></th>
											<?php
											}
											?>
											<th>Invoice Number <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[inv_no]" checked>'; } ?></th>
											<th>Invoice Date <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[inv_date]" checked>'; } ?></th>
											<th>Invoice Amt <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[inv_amt]" checked>'; } ?></th>
											<th>Total recd <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[ttl_recd]" checked>'; } ?></th>
											<th>Payment recd <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[inv_recd]" checked>'; } ?></th>
											<th>TDS <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[tds]" checked>'; } ?></th>
											<th>Balance <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[balance]" checked>'; } ?></th>
											<th>Receipt Date <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[receipt_date]" checked>'; } ?></th>
											<th>Ref Detail <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[ref_details]" >'; } ?></th>
											<th>Contact Person <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[contact_person]">'; } ?></th>
								            <th>Due Days <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[due_days]">'; } ?></th>
										</tr>
									</thead>

									<tbody>
										<?php
										$ttl_bal = 0;
										$ttl_recv = 0;
										$ttl_amt = 0;
										$ttl_tds = 0;
										$parent_ids = 0;

										if(!empty($parent_invoice)){
											foreach ($parent_invoice as $parent) {
												$parent_ids .= ','.$parent->id;
												$allinvoice_ids .= ','.$parent->id;
												$item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$parent->id."' ")->row();
                                                $type = '--';
                                                if(!empty($item_info)){
                                                    if($item_info->is_sale == 0){
                                                        $type = 'Rent';
                                                    }elseif($item_info->is_sale == 1){
                                                        $type = 'Sale';
                                                    }
                                                }

                                                if($type == 'Rent'){
                                                	$start_date = _d($parent->date);
                                                	$due_date = _d($parent->duedate);

                                                }else{
                                                	$start_date = '--';
                                                	$due_date = '--';
                                                }
                                                $due_days= due_days($parent->payment_due_date);

                                                $received = invoice_received($parent->id);
                                                $received_tds = invoice_tds_received($parent->id);


                                                $bal_amt = ($parent->total - $received - $received_tds);

                                                $ttl_recv += $received;
                                                $ttl_tds += $received_tds;
                                                $ttl_amt += $parent->total;
                                                $ttl_bal += $bal_amt;
                                                $grand_bal += $bal_amt;

                                                $ttl_billing += $parent->total;

                                                //$payment_info = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and `invoiceid` = '".$parent->id."' order by id asc ")->result();
                                                $payment_info = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date, p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$parent->id."' and cp.status = 1 order by p.id asc ")->result();

                                                // IF there is only one recored of payment which is made by cheque and cheque is not clear
                                                if(count($payment_info) == 1){
                                                	if($payment_info[0]->payment_mode == 1 && $payment_info[0]->chaque_status != 1){
                                                		$payment_info = '';
                                                	}
                                                }


                                                //Getting site person
                                                $person_info = invoice_contact_person($parent->id);

                                                if(!empty($payment_info)){
                                                	$j = 0;
                                                	foreach ($payment_info as  $r1) {


                                                		$to_see = ($r1->payment_mode == 1 && $r1->chaque_status != 1) ? '0' : '1';

                                                		if($to_see == 1){
                                                		$ref_no = value_by_id('tblclientpayment',$r1->pay_id,'reference_no');

                                                			$receipt_date = $r1->date;
	                                                		if($r1->payment_mode == 1 && $r1->chaque_status == 1 && !empty($r1->chaque_clear_date)){
	                                                			$receipt_date = $r1->chaque_clear_date;
	                                                		}
                                                		?>
															<tr>
																<?php
																if($service_type == 1){
																?>
																<td><?php echo $start_date; ?></td>
																<td><?php echo $due_date; ?></td>
																<?php
																}
																?>
																<td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$parent->id.'/?output_type=I');?>"><?php echo $parent->number; ?></a><?php echo ($parent->challan_id > 0) ? '<br><a target="_blank" href="'.admin_url('Chalan/pdf/'.$parent->challan_id).'">Chalan</a>' : ''; ?></td>
																<td><?php echo $parent->invoice_date; ?></td>
																<td><?php echo ($j == 0) ? $parent->total : '--'; ?></td>
																<td><?php echo ($j == 0) ? $received : '--'; ?></td>
																<td><?php echo $r1->amount; ?></td>
																<td><?php echo $r1->paid_tds_amt; ?></td>
																<td><?php echo ($j == 0) ? number_format($bal_amt, 2) : '--'; ?></td>
																<td><?php echo ($r1->amount > 0) ? _d($receipt_date) : '--'; ?></td>
																<td><?php echo $ref_no; ?></td>
																<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
																<td><?php echo ($j == 0) ? $due_days : '--'; ?></td>
															</tr>
														<?php
														$j++;
														}
                                                	}
                                                }else{
                                                ?>
													<tr>
														<?php
														if($service_type == 1){
														?>
														<td><?php echo $start_date; ?></td>
														<td><?php echo $due_date; ?></td>
														<?php
														}
														?>
														<td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$parent->id.'/?output_type=I');?>"><?php echo $parent->number; ?></a></td>
														<td><?php echo $parent->invoice_date; ?></td>
														<td><?php echo $parent->total; ?></td>
														<td><?php echo '0.00'; ?></td>
														<td><?php echo '0.00'; ?></td>
														<td><?php echo '--'; ?></td>
														<td><?php echo number_format($bal_amt, 2); ?></td>
														<td><?php echo '--'; ?></td>
														<td><?php echo '--'; ?></td>
														<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
														<td><?php echo $due_days; ?></td>
													</tr>
												<?php
                                                }

                                                //Getting Child Invoice
												if (!empty($year_id)){
													$child_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and year_id = '".$year_id."' and status != '5' order by date ".$flow." ")->result();
												}else{
													$child_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and status != '5' order by date ".$flow." ")->result();
												}
                                                if(!empty($child_invoice)){
													foreach ($child_invoice as $child) {

														$allinvoice_ids .= ','.$child->id;
														$item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$child->id."' ")->row();
		                                                $type = '--';
		                                                if(!empty($item_info)){
		                                                    if($item_info->is_sale == 0){
		                                                        $type = 'Rent';
		                                                    }elseif($item_info->is_sale == 1){
		                                                        $type = 'Sale';
		                                                    }
		                                                }

		                                                if($type == 'Rent'){
		                                                	$start_date = _d($child->date);
		                                                	$due_date = _d($child->duedate);
		                                                }else{
		                                                	$start_date = '--';
		                                                	$due_date = '--';
		                                                }
		                                                $due_days = due_days($child->payment_due_date);

		                                                $received = invoice_received($child->id);
		                                                $received_tds = invoice_tds_received($child->id);


		                                                $bal_amt = ($child->total - $received - $received_tds);

		                                                $ttl_recv += $received;
		                                                $ttl_tds += $received_tds;
		                                                $ttl_amt += $child->total;
		                                                $ttl_bal += $bal_amt;
		                                                $grand_bal += $bal_amt;

		                                                $ttl_billing += $child->total;

		                                                //$child_payment_info = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and `invoiceid` = '".$child->id."' order by id asc ")->result();
		                                                $child_payment_info = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '2' and p.invoiceid = '".$child->id."' and cp.status = 1 order by p.id asc ")->result();

		                                                // IF there is only one recored of payment which is made by cheque and cheque is not clear
		                                                if(count($child_payment_info) == 1){
		                                                	if($child_payment_info[0]->payment_mode == 1 && $child_payment_info[0]->chaque_status != 1){
		                                                		$child_payment_info = '';
		                                                	}
		                                                }

		                                                //Getting site person
                                                		$person_info = invoice_contact_person($child->id);
		                                                if(!empty($child_payment_info)){
		                                                	$j = 0;
		                                                	foreach ($child_payment_info as  $r2) {
																//$lastChildInvoiceId = 0;
		                                                		$to_see = ($r2->payment_mode == 1 && $r2->chaque_status != 1) ? '0' : '1';

		                                                		if($to_see == 1){
		                                                		$ref_no = value_by_id('tblclientpayment',$r2->pay_id,'reference_no');

		                                                		$receipt_date = $r2->date;
		                                                		if($r2->payment_mode == 1 && $r2->chaque_status == 1 && !empty($r2->chaque_clear_date)){
		                                                			$receipt_date = $r2->chaque_clear_date;
		                                                		}
		                                                		?>
																	<tr>
																		<?php
																		if($service_type == 1){
																		?>
																		<td><?php echo $start_date; ?></td>
																		<td><?php echo $due_date; ?></td>
																		<?php
																		}
																		?>
																		<td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$child->id.'/?output_type=I');?>"><?php echo $child->number; ?></a></td>
																		<td><?php echo $child->invoice_date; ?></td>
																		<td><?php echo ($j == 0) ? $child->total : '--'; ?></td>
																		<td><?php echo ($j == 0) ? $received : '--'; ?></td>
																		<td><?php echo $r2->amount; ?></td>
																		<td><?php echo $r2->paid_tds_amt; ?></td>
																		<td><?php echo ($j == 0) ? number_format($bal_amt, 2) : '--'; ?></td>
																		<td><?php echo ($r2->amount > 0) ? _d($receipt_date) : '--'; ?></td>
																		<td><?php echo $ref_no; ?></td>
																		<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
																		<td><?php echo ($j == 0) ? $due_days : '--'; ?></td>
																	</tr>
																<?php
																$lastChildInvoiceId = $child->id;
																$j++;
																}else{
																	
																	if($child->id != $lastChildInvoiceId){
																?>
																	<tr>
																		<?php
																		if($service_type == 1){
																		?>
																		<td><?php echo $start_date; ?></td>
																		<td><?php echo $due_date; ?></td>
																		<?php
																		}
																		?>
																		<td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$child->id.'/?output_type=I');?>"><?php echo $child->number; ?></a></td>
																		<td><?php echo $child->invoice_date; ?></td>
																		<td><?php echo $child->total; ?></td>
																		<td><?php echo '0.00'; ?></td>
																		<td><?php echo '0.00'; ?></td>
																		<td><?php echo '--'; ?></td>
																		<td><?php echo number_format($bal_amt, 2); ?></td>
																		<td><?php echo '--'; ?></td>
																		<td><?php echo '--'; ?></td>
																		<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
																		<td><?php echo $due_days ?></td>
																	</tr>
																<?php
																	
																	}
																	$lastChildInvoiceId = $child->id;
																	
																}
		                                                	}
		                                                }else{
		                                                ?>
															<tr>
																<?php
																if($service_type == 1){
																?>
																<td><?php echo $start_date; ?></td>
																<td><?php echo $due_date; ?></td>
																<?php
																}
																?>
																<td><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$child->id.'/?output_type=I');?>"><?php echo $child->number; ?></a></td>
																<td><?php echo $child->invoice_date; ?></td>
																<td><?php echo $child->total; ?></td>
																<td><?php echo '0.00'; ?></td>
																<td><?php echo '0.00'; ?></td>
																<td><?php echo '--'; ?></td>
																<td><?php echo number_format($bal_amt, 2); ?></td>
																<td><?php echo '--'; ?></td>
																<td><?php echo '--'; ?></td>
																<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
																<td><?php echo $due_days ?></td>
															</tr>
														<?php
		                                                }

													}
													echo '<tr><td colspan=13></td></tr>';
												}


											}


											//Getting Debit Notes againt parent invoice
											if (!empty($year_id)){
												$debit_note_info = $this->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and year_id = '".$year_id."' and status = '1' order by dabit_note_date ".$flow." ")->result();
											}else{
												$debit_note_info = $this->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$flow." ")->result();
											}
											if(!empty($debit_note_info)){
												foreach ($debit_note_info as $debitnote) {

													$alldn_ids .= ','.$debitnote->id;

													$received = debitnote_received($debitnote->number);
													$received_tds = debitnote_tds_received($debitnote->number);
													$bal_amt = ($debitnote->totalamount - $received - $received_tds);

													$ttl_recv += $received;
													$ttl_tds += $received_tds;
													$ttl_amt += $debitnote->totalamount;
													$ttl_bal += $bal_amt;
													$grand_bal += $bal_amt;

													$ttl_billing += $debitnote->totalamount;

													//$debitnote_payment = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();
													$debitnote_payment = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();

													// IF there is only one recored of payment which is made by cheque and cheque is not clear
	                                                if(count($debitnote_payment) == 1){
	                                                	if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
	                                                		$debitnote_payment = '';
	                                                	}
	                                                }

													if(!empty($debitnote_payment)){
														$j = 0;
														foreach ($debitnote_payment as  $r3) {

															$to_see = ($r3->payment_mode == 1 && $r3->chaque_status != 1) ? '0' : '1';

															if($to_see == 1){
															$ref_no = value_by_id('tblclientpayment',$r3->pay_id,'reference_no');

															$receipt_date = _d($r3->date);
										                    if($r3->payment_mode == 1 && $r3->chaque_status == 1 && !empty($r3->chaque_clear_date)){
										                      $receipt_date = _d($r3->chaque_clear_date);
										                    }

															?>
																<tr>

																	<?php
																	if($service_type == 1){
																	?>
																	<td class="text-center"><?php echo 'DN'; ?></td>
																	<td><?php echo '--'; ?></td>
																	<?php
																	}
																	?>
																	<td><a target="_blank" href="<?php  echo admin_url('debit_note/download_pdf/'.$debitnote->id); ?>"><?php echo $debitnote->number; ?></a></td>
																	<td><?php echo $debitnote->dabit_note_date; ?></td>
																	<td><?php echo ($j == 0) ? $debitnote->totalamount : '--'; ?></td>
																	<td><?php echo ($j == 0) ? $received : '--'; ?></td>
																	<td><?php echo $r3->amount; ?></td>
																	<td><?php echo $r3->paid_tds_amt; ?></td>
																	<td><?php echo ($j == 0) ? number_format($bal_amt, 2) : '--'; ?></td>
																	<td><?php echo $receipt_date; ?></td>
																	<td><?php echo $ref_no; ?></td>
																	<td><?php echo '--'; ?></td>
																	<td><?php echo '--'; ?></td>
																</tr>
															<?php
															$j++;
															}
														}
													}else{
													?>
														<tr>
															<?php
															if($service_type == 1){
															?>
															<td class="text-center"><?php echo 'DN'; ?></td>
															<td><?php echo '--'; ?></td>
															<?php
															}
															?>
															<td><a target="_blank" href="<?php  echo admin_url('debit_note/download_pdf/'.$debitnote->id); ?>"><?php echo $debitnote->number; ?></a></td>
															<td><?php echo $debitnote->dabit_note_date; ?></td>
															<td><?php echo $debitnote->totalamount; ?></td>
															<td><?php echo '0.00'; ?></td>
															<td><?php echo '0.00'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo number_format($bal_amt, 2); ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
														</tr>
													<?php
													}

												}

											}



											//Getting Credit Notes againt parent invoice
											if (!empty($year_id)){
												$credit_note_info = $this->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' and year_id = '".$year_id."' order by date ".$flow." ")->result();
											}else{
												$credit_note_info = $this->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by date ".$flow." ")->result();
											}
											
											if(!empty($credit_note_info)){
												foreach ($credit_note_info as $creditnote) {


													$ttl_recv += $creditnote->totalamount;
													/*$ttl_amt += $debitnote->totalamount;
													$ttl_bal += $bal_amt;
													$grand_bal += $bal_amt; */

													$ttl_bal -= $creditnote->totalamount;
													$grand_bal -= $creditnote->totalamount;


													?>
														<tr>
															<?php
															if($service_type == 1){
															?>
															<td class="text-center"><?php echo 'CN'; ?></td>
															<td><?php echo '--'; ?></td>
															<?php
															}
															?>
															<td><a target="_blank" href="<?php  echo admin_url('creditnotes/download_pdf/'.$creditnote->id); ?>"><?php echo $creditnote->number; ?></a></td>
															<td><?php echo $creditnote->date; ?></td>
															<td><?php echo '0.00'; ?></td>
															<td><?php echo $creditnote->totalamount; ?></td>
															<td><?php echo '0.00'; ?></td>
															<td><?php echo '0.00'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
															<td><?php echo '--'; ?></td>
														</tr>
													<?php

												}

											}




										}
										?>
									</tbody>

									<tfoot>
										<tr>
											<td colspan="<?php echo ($service_type == 1) ? 4 : 2; ?>" class="text-center"><b>Total</b></td>
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_amt, 2); ?></b></td>
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2); ?></b></td>
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2); ?></b></td>
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_tds, 2); ?></b></td>
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_bal, 2); ?></b></td>
											<td colspan="4" class="text-left"></td>

										</tr>
									</tfoot>

								</table>
							</div>


							<?php
							$grand_recevied += ($ttl_recv + $ttl_tds);
						}
						}
					?>

					<?php

					$financialyearwhere = (!empty($year_id)) ? 'and dn.year_id='.$year_id : '';
					$payment_debitnote = $this->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$allinvoice_ids.") and i.invoice_id > 0 and i.type = 1 ".$financialyearwhere." GROUP by dn.id ")->result();
					if(empty($payment_debitnote)){
						$payment_debitnote = $this->db->query("SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$alldn_ids.") and i.invoice_id > 0 and i.type = 2 ".$financialyearwhere." GROUP by dn.id ")->result();
					}

					/*echo "SELECT dn.* from tbldebitnotepayment as dn LEFT JOIN tbldebitnotepaymentitems as i ON dn.id = i.debitnote_id where i.invoice_id IN (".$allinvoice_ids.") GROUP by dn.id ";
					die;*/
					//Payment Debit Notes
					if(!empty($payment_debitnote)){
						$ttl_bal = 0;
						$ttl_tds = 0;
						$ttl_recv = 0;
						$ttl_amt = 0;
					?>
					<table class="table details-table">
						<thead>
							<tr>
								<th>Details</th>
								<th>DN Number</th>
								<th>DN Date</th>
								<th>Amount</th>
								<th>Total recd</th>
								<th>Payment recd</th>
								<th>TDS</th>
								<th>Payment Balance</th>
								<th>Remarks</th>
								<th>Payment Receipt Date</th>
								<th>Payment Ref Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($payment_debitnote as $debitnote) {

								$received = debitnote_received($debitnote->number);
								$received_tds = debitnote_tds_received($debitnote->number);
								$bal_amt = ($debitnote->amount - $received - $received_tds);

								$ttl_recv += $received;
								$ttl_tds += $received_tds;
								$ttl_amt += $debitnote->amount;
								$ttl_bal += $bal_amt;
								$grand_bal += $bal_amt;

								$ttl_billing += $debitnote->amount;

								//$debitnote_payment = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();
								$debitnote_payment = $this->db->query("SELECT cp.payment_mode,cp.chaque_status,cp.chaque_clear_date,p.* FROM `tblclientpayment` as cp LEFT JOIN tblinvoicepaymentrecords as p ON cp.id = p.pay_id WHERE p.paymentmethod = '3' and p.debitnote_no = '".$debitnote->number."' and cp.status = 1 order by p.id asc ")->result();
								// IF there is only one recored of payment which is made by cheque and cheque is not clear
                                if(count($debitnote_payment) == 1){
                                	if($debitnote_payment[0]->payment_mode == 1 && $debitnote_payment[0]->chaque_status != 1){
                                		$debitnote_payment = '';
                                	}
                                }

								if(!empty($debitnote_payment)){
									$j = 0;
									foreach ($debitnote_payment as  $r4) {

										$to_see = ($r4->payment_mode == 1 && $r4->chaque_status != 1) ? '0' : '1';

										if($to_see == 1){
										$ref_no = value_by_id('tblclientpayment',$r4->pay_id,'reference_no');

										$receipt_date = _d($r4->date);
						                  if($r4->payment_mode == 1 && $r4->chaque_status == 1 && !empty($r4->chaque_clear_date)){
						                    $receipt_date = _d($r4->chaque_clear_date);
						                  }
										?>
											<tr>
												<td><?php echo 'DN (Delay in Payment)'; ?></td>
												<td><?php echo $debitnote->number; ?></td>
												<td><?php echo _d($debitnote->date); ?></td>
												<td><?php echo ($j == 0) ? $debitnote->amount : '--'; ?></td>
												<td><?php echo ($j == 0) ? $received : '--'; ?></td>
												<td><?php echo $r4->amount; ?></td>
												<td><?php echo $r4->paid_tds_amt; ?></td>
												<td><?php echo ($j == 0) ? number_format($bal_amt, 2) : '--'; ?></td>
												<td><?php echo $r4->note; ?></td>
												<td><?php echo $receipt_date; ?></td>
												<td><?php echo $ref_no; ?></td>
											</tr>
										<?php
										$j++;
										}
									}
								}else{
								?>
									<tr>
										<td><?php echo 'DN (Delay in Payment)'; ?></td>
										<td><?php echo $debitnote->number; ?></td>
										<td><?php echo $debitnote->date; ?></td>
										<td><?php echo $debitnote->amount; ?></td>
										<td><?php echo '0.00'; ?></td>
										<td><?php echo '0.00'; ?></td>
										<td><?php echo '--'; ?></td>
										<td><?php echo number_format($bal_amt, 2); ?></td>
										<td><?php echo '--'; ?></td>
										<td><?php echo '--'; ?></td>
										<td><?php echo '--'; ?></td>
									</tr>
								<?php
								}

							}
							?>
						</tbody>
						<tfoot>
							<tr>
								<td colspan="3" class="text-center"><b>Total</b></td>
								<td colspan="1" class="text-left"><b><?php echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
								<td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2, '.', ''); ?></b></td>
								<td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2, '.', ''); ?></b></td>
								<td colspan="1" class="text-left"><b><?php echo number_format($ttl_tds, 2, '.', ''); ?></b></td>
								<td colspan="1" class="text-left"><b><?php echo number_format($ttl_bal, 2, '.', ''); ?></b></td>
								<td colspan="4" class="text-left"></td>

							</tr>
						</tfoot>
					</table>
					<?php
						$grand_recevied += ($ttl_recv + $ttl_tds);
					}
					?>
                    <?php
						$datefilter = $refubddatefilter = $createdatefilter = '';
						if (!empty($year_id)){
							$from_date = value_by_id("tblfinancialyear", $year_id, "from_date");
							$to_date = value_by_id("tblfinancialyear", $year_id, "to_date");
							$datefilter = 'and date BETWEEN '.$from_date.' and '.$to_date;
							$refubddatefilter = 'and r.date BETWEEN '.$from_date.' and '.$to_date;
							$createdatefilter = 'and created_date BETWEEN '.$from_date.' and '.$to_date;
						}
						//$onaccout_amt = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where client_id IN (".$branch_str.") and payment_behalf = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
						$onaccout_amt = 0;
						if(!empty($service_type)){
							$onaccout_amt_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$branch_str.") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ".$datefilter." ")->result();	
						}
						
						if(!empty($onaccout_amt_info)){
							foreach ($onaccout_amt_info as $on_am) {
								$to_see = ($on_am->payment_mode == 1 && $on_am->chaque_status != 1) ? '0' : '1';
								if($to_see == 1){
									$onaccout_amt += $on_am->ttl_amt;
								}
							}
						}

                    $waveoff_amt = $this->db->query("SELECT COALESCE(SUM(amount),0) AS ttl_amount FROM `tblclientwaveoff`  where client_id IN (".$branch_str.") and status = 1 and service_type = '".$service_type."' ".$createdatefilter." ")->row()->ttl_amount;
                    $onaccout_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$branch_str.") and payment_behalf = 1 and service_type = '".$service_type."' and status = 1 ".$datefilter." ")->result();
                    $waveoff_info = $this->db->query("SELECT * FROM `tblclientwaveoff`  where client_id IN (".$branch_str.") and status = 1 and service_type = '".$service_type."' ".$createdatefilter."")->result();
                    $pendingcheque_info = $this->db->query("SELECT * FROM `tblclientpayment`  where client_id IN (".$branch_str.") and payment_mode = 1 and chaque_status IN (0,2,3,4) and status = 1 ".$createdatefilter."")->result();
                    $clientdeposits_info = $this->db->query("SELECT * FROM `tblclientdeposits`  where client_id IN (" . $branch_str . ") and status = 1 ".$datefilter."")->result();
                    $clientrefund_info = $this->db->query("SELECT r.*, pd.utr_no, pd.utr_date,pd.method from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where client_id IN (" . $branch_str . ") and pd.utr_no != '' and service_type = '".$service_type."' ".$refubddatefilter." order by r.id desc")->result();

					$clientrefund_amt = $this->db->query("SELECT COALESCE(SUM(r.amount),0) AS ttl_amount from  tblclientrefund as r LEFT JOIN tblbankpaymentdetails as pd ON r.id = pd.pay_type_id and pd.pay_type = 'client_refund' where client_id IN (" . $branch_str . ") and pd.utr_no != '' and service_type = '".$service_type."' ".$refubddatefilter." order by r.id desc")->row()->ttl_amount;
                    $final_balance = (round($grand_bal) - round($onaccout_amt) - round($waveoff_amt) + round($clientrefund_amt));
					
                    ?>
                    <table class="table details-table">
					<tfoot>
						<tr>
							<td colspan="4" class="text-center"><b>Total Billing</b></td>
							<td colspan="4" class="text-center"><?php echo round($ttl_billing).'.00'; ?></td>
							<td colspan="4"></td>
						</tr>

						<tr>
							<td colspan="4" class="text-center"><b>Total Recevied</b></td>
							<td colspan="4" class="text-center"><?php echo round($grand_recevied).'.00'; ?></td>
							<td colspan="4"></td>
						</tr>

						<tr>
							<td colspan="4" class="text-center"><b>Total Balance</b></td>
							<td colspan="4" class="text-center"><?php echo round($grand_bal).'.00'; ?></td>
							<td colspan="4"></td>
						</tr>
						<tr>
							<td colspan="4" class="text-center"><b>Onaccount</b></td>
							<td colspan="4" class="text-center">-<?php echo round($onaccout_amt).'.00'; ?></td>
							<td colspan="4"></td>
						</tr>
						<?php
						//if($waveoff_amt > 0){
						if(!empty($waveoff_info)){
							foreach ($waveoff_info as $wave_row) {
							?>
							<tr>
								<td colspan="4" class="text-center"><b><?php echo ($wave_row->amount > 0) ? '-' : '+'; ?> <?php echo (!empty($wave_row->remark)) ? $wave_row->remark : 'Waveoff' ?> </b></td>
								<td colspan="4" class="text-center"> <?php echo round($wave_row->amount).'.00'; ?></td>
								<td colspan="4"></td>
							</tr>
							<?php
							}
						}

						//if($waveoff_amt > 0){
						if(!empty($clientrefund_info)){
							foreach ($clientrefund_info as $crrow) {
							?>
								<tr>
										<td colspan="4" class="text-center"><b> Client Refund  </b></td>
										<td colspan="4" class="text-center"> <?php echo round($crrow->amount).'.00'; ?></td>
										<td colspan="4"></td>
								</tr>
							<?php
							}
						}
						?>
						<tr>
							<td colspan="4" class="text-center"><b>Final Balance</b></td>
							<td colspan="4" class="text-center"><?php echo round($final_balance).'.00'; ?></td>
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

								$onAccountDate = _d($on_acc->date);
								if(!empty($on_acc->chaque_clear_date)){
									$onAccountDate = _d($on_acc->chaque_clear_date);
								}

								if($to_see == 1){
								?>
								<tr>
									<td><?php echo ++$key; ?></td>
									<td><?php echo $onAccountDate; ?></td>
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

                if(!empty($pendingcheque_info)){
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
                                if($client_pay->chaque_status == 0)
                                {
                                	$status = 'Pending';
                                }
                                else if($client_pay->chaque_status == 2)
                                {
                                	$status = 'Bounced';
                                }
                                else if($client_pay->chaque_status == 3)
                                {
                                	$status = 'Redeposit';
                                }
                                else
                                {
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
          <?php }
								if (!empty($clientrefund_info)){
					?>
										<div class="sec-title">
												<h3 class="text-center company-title">Client Refund Details</h3>
												<div class="separator"><span></span></div>
										</div>
										<table class="table details-table">
												<thead>
														<tr>
																<th>Sr. No.</th>
																<th>Date</th>
																<th>UTR</th>
																<th>Payment Type</th>
																<th>Amount</th>
														</tr>
												</thead>
												<tbody>
														<?php
														foreach ($clientrefund_info as $key => $refunddata) {

																?>
																<tr>
																		<td><?php echo ++$key; ?></td>
																		<td><?php echo _d($refunddata->date); ?></td>
																		<td><?php echo $refunddata->utr_no; ?></td>
																		<td><?php echo $refunddata->method; ?></td>
																		<td><?php echo $refunddata->amount; ?></td>
																</tr>
																<?php
														}
														?>

												</tbody>
										</table>
					<?php
								}
					 ?>


                                <div class="btn-bottom-toolbar text-right">
                                    <button class="btn btn-info" value="1" name="mark" type="submit">Ledger Pdf</button>
                                    <button class="btn btn-success" value="2" name="mark" type="submit">Ledger Export</button>
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

<script type="text/javascript">
    $(document).on('change', '#client_id', function() {
       var client_id = $(this).val();

       $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/Invoices/get_branch'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){
                     $('#client_branch').html(response);
                     $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    });
</script>


<script type="text/javascript">
    $(document).on('change', '#client_branch, #service_type', function() {
       var client_branch = $("#client_branch").val();
       var service_type = $("#service_type").val();
       if(client_branch != '' && service_type != ''){
	       $.ajax({
	            type    : "POST",
	            url     : "<?php echo site_url('admin/Invoices/get_sites'); ?>",
	            data    : {'client_branch' : client_branch, 'service_type' : service_type},
	            success : function(response){
	                if(response != ''){
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

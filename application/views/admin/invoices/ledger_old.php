
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
                                    		<option value="<?php echo $value->userid;?>" <?php if(!empty($client_id) && $client_id == $value->userid){ echo 'selected';} ?>  ><?php echo $value->company; ?></option>
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
	                                		<option value="<?php echo $branch_info->userid; ?>" selected><?php echo $branch_info->client_branch_name; ?></option>
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
	                            <label for="site_id" class="control-label">Select Site </small></label>
	                            <select class="form-control selectpicker" id="site_id"  name="site_id[]" multiple="" data-live-search="true">
	                                <option value="">--Select One-</option>
	                                <?php
	                                if(!empty($site_ids)){
	                                	foreach ($site_ids as $value) {
	                                		$site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '".$value."' ")->row();
	                                		?>
	                                		<option value="<?php echo $site_info->id; ?>" selected><?php echo $site_info->name; ?></option>
	                                		<?php
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
if(!empty($site_ids)){

	$branch_str = implode(",",$client_branch);
	$payment_debitnote = $this->db->query("SELECT * FROM tbldebitnotepayment where clientid = '".$client_id."' and status = '1' order by date ".$flow." ")->result();
?>
<form action="<?php echo admin_url('invoices/ledger_pdf'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8" target="_balnk">
<input type="hidden" value="<?php echo implode(",",$site_ids); ?>" name="site_ids">	
<input type="hidden" value="<?php echo $branch_str; ?>" name="client_branch">	
<input type="hidden" value="<?php echo $client_id; ?>" name="client_id">	
<input type="hidden" value="<?php echo $flow; ?>" name="flow">	
<input type="hidden" value="<?php echo $service_type; ?>" name="service_type">	
<div class="content">
	<div class="row">
		<div class="col-md-12">
			<div class="panel_s">
				<div class="panel-body">
					<?php
						$i = 0;
						$grand_bal = 0;
						foreach ($site_ids as $s_id) {
							$i++;
							$site_info = $this->db->query("SELECT * FROM tblsitemanager where id = '".$s_id."' ")->row();

							$parent_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '0' and status != '5' order by date ".$flow." ")->result();
							?>
							<div class="sheetWrapper">
								<div class="sec-title">
									<h3 class="text-center company-title"><?php echo $site_info->name; ?></h3>
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
											<th>Balance <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[balance]" checked>'; } ?></th>
											<th>TDS <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[tds]" checked>'; } ?></th>
											<th>Receipt Date <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[receipt_date]" checked>'; } ?></th>
											<th>Ref Detail <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[ref_details]" >'; } ?></th>
											<th>Contact Person <br><?php if($i == 1){ echo '<input type="checkbox" value="1" name="printdata[contact_person]">'; } ?></th>
										</tr>
									</thead>

									<tbody>
										<?php
										$ttl_bal = 0;
										$ttl_recv = 0;
										$ttl_amt = 0;
										$parent_ids = 0;
										if(!empty($parent_invoice)){
											foreach ($parent_invoice as $parent) {
												$parent_ids .= ','.$parent->id;
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

                                                
                                                $received = invoice_received($parent->id);


                                                $bal_amt = ($parent->total - $received);

                                                $ttl_recv += $received;
                                                $ttl_amt += $parent->total;
                                                $ttl_bal += $bal_amt; 
                                                $grand_bal += $bal_amt; 

                                                $payment_info = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and `invoiceid` = '".$parent->id."' order by id asc ")->result();


                                                //Getting site person
                                                $person_info = invoice_contact_person($parent->id);

                                                if(!empty($payment_info)){
                                                	$j = 0;
                                                	foreach ($payment_info as  $r1) {

                                                		$ref_no = value_by_id('tblclientpayment',$r1->pay_id,'reference_no');
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
																<td><?php echo $parent->number; ?></td>
																<td><?php echo $parent->invoice_date; ?></td>
																<td><?php echo ($j == 0) ? $parent->total : '--'; ?></td>
																<td><?php echo ($j == 0) ? $received : '--'; ?></td>
																<td><?php echo $r1->amount; ?></td>	
																<td><?php echo ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--'; ?></td>
																<td><?php echo $r1->tds; ?></td>
																<td><?php echo _d($r1->date); ?></td>
																<td><?php echo $ref_no; ?></td>
																<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
															</tr>
														<?php
														$j++;
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
														<td><?php echo $parent->number; ?></td>
														<td><?php echo $parent->invoice_date; ?></td>
														<td><?php echo $parent->total; ?></td>
														<td><?php echo '0.00'; ?></td>	
														<td><?php echo '0.00'; ?></td>	
														<td><?php echo number_format($bal_amt, 2, '.', ''); ?></td>
														<td><?php echo '--'; ?></td>
														<td><?php echo '--'; ?></td>
														<td><?php echo '--'; ?></td>
														<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
													</tr>
												<?php	
                                                }



                                                //Getting Child Invoice
                                                $child_invoice = $this->db->query("SELECT * FROM tblinvoices where clientid IN (".$branch_str.") and site_id = '".$s_id."' and service_type = '".$service_type."' and parent_id = '".$parent->id."' and status != '5' order by date ".$flow." ")->result();
                                                if(!empty($child_invoice)){
													foreach ($child_invoice as $child) {

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

		                                                
		                                                $received = invoice_received($child->id);


		                                                $bal_amt = ($child->total - $received);

		                                                $ttl_recv += $received;
		                                                $ttl_amt += $child->total;
		                                                $ttl_bal += $bal_amt; 
		                                                $grand_bal += $bal_amt; 

		                                                $child_payment_info = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '2' and `invoiceid` = '".$child->id."' order by id asc ")->result();

		                                                //Getting site person
                                                		$person_info = invoice_contact_person($child->id);
		                                                if(!empty($child_payment_info)){
		                                                	$j = 0;
		                                                	foreach ($child_payment_info as  $r2) {

		                                                		$ref_no = value_by_id('tblclientpayment',$r2->pay_id,'reference_no');
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
																		<td><?php echo $child->number; ?></td>
																		<td><?php echo $child->invoice_date; ?></td>
																		<td><?php echo ($j == 0) ? $child->total : '--'; ?></td>
																		<td><?php echo ($j == 0) ? $received : '--'; ?></td>
																		<td><?php echo $r2->amount; ?></td>	
																		<td><?php echo ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--'; ?></td>
																		<td><?php echo $r2->tds; ?></td>
																		<td><?php echo _d($r2->date); ?></td>
																		<td><?php echo $ref_no; ?></td>
																		<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
																	</tr>
																<?php
																$j++;
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
																<td><?php echo $child->number; ?></td>
																<td><?php echo $child->invoice_date; ?></td>
																<td><?php echo $child->total; ?></td>
																<td><?php echo '0.00'; ?></td>	
																<td><?php echo '0.00'; ?></td>	
																<td><?php echo number_format($bal_amt, 2, '.', ''); ?></td>
																<td><?php echo '--'; ?></td>
																<td><?php echo '--'; ?></td>
																<td><?php echo '--'; ?></td>
																<td><?php echo (!empty($person_info['site_name'])) ? $person_info['site_name'] : '--'; ?></td>
															</tr>
														<?php	
		                                                }

													}
													echo '<tr><td colspan=12></td></tr>';
												}
												
												
											}
											
											
											//Getting Debit Notes againt parent invoice
											$debit_note_info = $this->db->query("SELECT * FROM tbldebitnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by dabit_note_date ".$flow." ")->result();
											if(!empty($debit_note_info)){
												foreach ($debit_note_info as $debitnote) {

																											
													$received = debitnote_received($debitnote->number);
													$bal_amt = ($debitnote->totalamount - $received);

													$ttl_recv += $received;
													$ttl_amt += $debitnote->totalamount;
													$ttl_bal += $bal_amt; 
													$grand_bal += $bal_amt; 

													$debitnote_payment = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();


													if(!empty($debitnote_payment)){
														$j = 0;
														foreach ($debitnote_payment as  $r3) {

															$ref_no = value_by_id('tblclientpayment',$r3->pay_id,'reference_no');
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
																	<td><?php echo $debitnote->number; ?></td>
																	<td><?php echo $debitnote->dabit_note_date; ?></td>
																	<td><?php echo ($j == 0) ? $debitnote->totalamount : '--'; ?></td>
																	<td><?php echo ($j == 0) ? $received : '--'; ?></td>
																	<td><?php echo $r3->amount; ?></td>	
																	<td><?php echo ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--'; ?></td>
																	<td><?php echo $r3->tds; ?></td>
																	<td><?php echo _d($r3->date); ?></td>
																	<td><?php echo $ref_no; ?></td>
																	<td><?php echo '--'; ?></td>
																</tr>
															<?php
															$j++;
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
															<td><?php echo $debitnote->number; ?></td>
															<td><?php echo $debitnote->dabit_note_date; ?></td>
															<td><?php echo $debitnote->totalamount; ?></td>
															<td><?php echo '0.00'; ?></td>	
															<td><?php echo '0.00'; ?></td>	
															<td><?php echo number_format($bal_amt, 2, '.', ''); ?></td>
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
											$credit_note_info = $this->db->query("SELECT * FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' order by date ".$flow." ")->result();
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
															<td><?php echo $creditnote->number; ?></td>
															<td><?php echo $creditnote->date; ?></td>
															<td><?php echo '0.00'; ?></td>	
															<td><?php echo $creditnote->totalamount; ?></td>															
															<td><?php echo '0.00'; ?></td>	
															<td><?php echo '0.00'; ?></td>	
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
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2, '.', ''); ?></b></td>											
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_recv, 2, '.', ''); ?></b></td>											
											<td colspan="1" class="text-left"><b><?php echo number_format($ttl_bal, 2, '.', ''); ?></b></td>
											<td colspan="4" class="text-left"></td>
											
										</tr>										
									</tfoot>
									
								</table>
							</div>


							<?php
						}
					?>
					
					<?php
					//Payment Debit Notes
					if(!empty($payment_debitnote)){
						$ttl_bal = 0;
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
								<th>Payment Balance</th>
								<th>TDS</th>
								<th>Remarks</th>
								<th>Payment Receipt Date</th>
								<th>Payment Ref Detail</th>
							</tr>
						</thead>
						<tbody>
							<?php
							foreach ($payment_debitnote as $debitnote) {
																											
								$received = debitnote_received($debitnote->number);
								$bal_amt = ($debitnote->amount - $received);

								$ttl_recv += $received;
								$ttl_amt += $debitnote->amount;
								$ttl_bal += $bal_amt; 
								$grand_bal += $bal_amt; 

								$debitnote_payment = $this->db->query("SELECT * FROM `tblinvoicepaymentrecords` where `paymentmethod` = '3' and `debitnote_no` = '".$debitnote->number."' order by id asc ")->result();


								if(!empty($debitnote_payment)){
									$j = 0;
									foreach ($debitnote_payment as  $r4) {

										$ref_no = value_by_id('tblclientpayment',$r4->pay_id,'reference_no');
										?>
											<tr>
												<td><?php echo 'DN (Delay in Payment)'; ?></td>
												<td><?php echo $debitnote->number; ?></td>
												<td><?php echo _d($debitnote->date); ?></td>
												<td><?php echo ($j == 0) ? $debitnote->amount : '--'; ?></td>
												<td><?php echo ($j == 0) ? $received : '--'; ?></td>
												<td><?php echo $r4->amount; ?></td>	
												<td><?php echo ($j == 0) ? number_format($bal_amt, 2, '.', '') : '--'; ?></td>
												<td><?php echo $r4->tds; ?></td>
												<td><?php echo $r4->note; ?></td>
												<td><?php echo _d($r4->date); ?></td>
												<td><?php echo $ref_no; ?></td>
											</tr>
										<?php
										$j++;
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
										<td><?php echo number_format($bal_amt, 2, '.', ''); ?></td>
										<td><?php echo '--'; ?></td>
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
								<td colspan="1" class="text-left"><b><?php echo number_format($ttl_bal, 2, '.', ''); ?></b></td>
								<td colspan="4" class="text-left"></td>
								
							</tr>										
						</tfoot>

					</table>
					<?php	
					}
					?>
					

                 
                    <?php
                    $onaccout_amt = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where client_id IN (".$branch_str.") and payment_behalf = 1 ")->row()->ttl_amount;

                    $final_balance = ($grand_bal - $onaccout_amt);
                    ?>
                    <table class="table details-table">
					<tfoot>
						<tr>
							<td colspan="4" class="text-center"><b>Total Balance</b></td>
							<td colspan="4" class="text-center"><?php echo number_format($grand_bal, 2, '.', ''); ?></td>
							<td colspan="3"></td>
						</tr>
						<tr>
							<td colspan="4" class="text-center"><b>Onaccount</b></td>
							<td colspan="4" class="text-center">-<?php echo number_format($onaccout_amt, 2, '.', ''); ?></td>
							<td colspan="3"></td>
						</tr>
						<tr>
							<td colspan="4" class="text-center"><b>Final Balance</b></td>
							<td colspan="4" class="text-center"><?php echo number_format($final_balance, 2, '.', ''); ?></td>
							<td colspan="3"></td>
						</tr>
					</tfoot>
				</table>

			       <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">ledger Pdf</div>
					
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

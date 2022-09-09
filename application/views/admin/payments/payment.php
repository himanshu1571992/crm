<?php init_head(); ?>
<div id="wrapper">
	<div class="content">
		<div class="row">
			<div class="col-md-5">
				<div class="panel_s">
					<div class="col-md-12 no-padding">
						<div class="panel_s">
							<?php echo form_open($this->uri->uri_string()); ?>
							<div class="panel-body">
								<h4 class="no-margin"><?php echo _l('payment_edit_for_invoice'); ?> <a href="<?php echo admin_url('invoices/list_invoices/'.$payment->invoiceid); ?>"><?php echo format_invoice_number($invoice->id); ?></a></h4>
								<hr class="hr-panel-heading" />
								<?php echo render_input('amount','payment_edit_amount_received',$payment->amount,'number'); ?>
								<?php echo render_date_input('date','payment_edit_date',_d($payment->date)); ?>
								

								<div class="form-group select-placeholder">
                                                                    <label for="paymentmode" class="control-label"><small class="req text-danger">* </small> Payment Mode </label>
                                                                    <select class="form-control selectpicker" id="paymentmode"  name="paymentmode" required="">
                                                                        <option value="">--Select One--</option>
                                                                        <option value="1" <?php if(!empty($payment->paymentmode) && $payment->paymentmode == 1){ echo 'selected'; } ?>>Cheque</option>
                                                                        <option value="2" <?php if(!empty($payment->paymentmode) && $payment->paymentmode == 2){ echo 'selected'; } ?>>NEFT</option>
                                                                        <option value="3" <?php if(!empty($payment->paymentmode) && $payment->paymentmode == 3){ echo 'selected'; } ?>>Cash</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group select-placeholder cheque_field">
                                                                    <label for="cheque_for" class="control-label"><small class="req text-danger">* </small> Cheque For </label>
                                                                    <select class="form-control selectpicker" id="chaque_for"  name="chaque_for">
                                                                        <option value="">--Select One--</option>
                                                                        <option value="1" <?php if(!empty($payment->chaque_for) && $payment->chaque_for == "1"){ echo 'selected'; } ?>>Post Date</option>
                                                                        <option value="2" <?php if(!empty($payment->chaque_for) && $payment->chaque_for == "2"){ echo 'selected'; } ?>>Current Date</option>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group cheque_field">     
                                                                    <label for="cheque_no" class="control-label"> <small class="req text-danger">* </small> Cheque No.</label>
                                                                    <div class="input-group">
                                                                        <span class="input-group-addon">
                                                                            <span id="prefix">CHQ-</span>
                                                                        </span>                              
                                                                        <input type="text" id="cheque_no" onkeyup="nospaces(this)" name="cheque_no" class="form-control onlynumbers1" value="<?php echo $payment->cheque_no; ?>">                                   
                                                                    </div>
                                                                </div>
                                                                <div class="form-group cheque_field" app-field-wrapper="date">
                                                                    <label for="f_date" class="control-label">Cheque Date</label>
                                                                    <div class="input-group date">
                                                                        <input id="cheque_date" name="cheque_date" class="form-control datepicker" value="<?php echo _d($payment->cheque_date) ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                                    </div>
                                                                </div>
                                                                <div class="form-group select-placeholder">
                                                                    <label for="paymenttype" class="control-label">Payment Types</label>
                                                                    <select class="form-control selectpicker" id="paymenttype"  name="payment_type_id">
                                                                        <option value="">--Select One--</option>
                                                                        <?php
                                                                        if (!empty($paytype_info)) {
                                                                            foreach ($paytype_info as $pay_key => $pay_value) {
                                                                                ?>
                                                                                <option value="<?php echo $pay_value->id; ?>" <?php echo (!empty($payment->payment_type_id) && $payment->payment_type_id == $pay_value->id) ? 'selected' : ""; ?>><?php echo cc($pay_value->name); ?></option>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>
                                                                <div class="form-group select-placeholder">
                                                                    <label for="bank" class="control-label">Bank</label>
                                                                    <select class="form-control selectpicker" id="bank_id"  name="bank_id">
                                                                        <option value="">--Select One--</option>
                                                                        <?php
                                                                        if (!empty($bank_info)) {
                                                                            foreach ($bank_info as $bank_key => $bank_value) {
                                                                                ?>
                                                                                <option value="<?php echo $bank_value->id; ?>" <?php if (!empty($payment->bank_id) && $payment->bank_id == $bank_value->id) {
                                                                            echo 'selected';
                                                                        } ?>><?php echo cc($bank_value->name); ?></option>

                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                                    </select>
                                                                </div>

                                <?php echo render_input('reference_no','Reference No',$client_payment->reference_no,'text'); ?>

                                <div class="row">
                                	<div class="form-group col-md-6">                                   
                                    <label for="tds" class="control-label"></small> TDS %</label>
                                    <input type="number" id="tds" name="tds" class="form-control" value="<?php echo $payment->tds; ?>">                                   
                                </div>

                                <div class="form-group col-md-6">                                   
                                    <label for="tds_amt" class="control-label"></small> TDS Amount</label>
                                    <input type="text" id="tds_amt" name="tds_amt" class="form-control" value="<?php echo $payment->tds_amt; ?>">                                   
                                </div>
                                </div>
                                

								<!-- <i class="fa fa-question-circle" data-toggle="tooltip" data-title="<?php echo _l('payment_method_info'); ?>"></i> -->
								<?php //echo render_input('paymentmethod','payment_method',$payment->paymentmethod); ?>
								<?php // echo render_input('transactionid','payment_transaction_id',$payment->transactionid); ?>
								<?php echo render_textarea('note','note',$payment->note,array('rows'=>7)); ?>
							   <div class="row">
							   <div class="form-group col-md-12">
                               <label for="color" class="control-label">Approved By</label>
                                
                                <select required="" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
                                    <?php
                                    if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                        foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) 
                                        {?>
                                             <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
                                            <option value=""><?php echo $Staffgroup_value['name'] ?></option>
                                            <?php
                                            foreach($Staffgroup_value['staffs'] as $singstaff)
                                            {?>
                                                <option style="padding-left: 50px;" value="<?php echo $singstaff['staffid'] ?>"><?php echo $singstaff['firstname'] ?></option>
                                            <?php
                                            }?>
                                            </optgroup>
                                        <?php
                                        }
                                    }
                                    ?>
                                </select> 
                                </div>
                                </div>
								<div class="btn-bottom-toolbar text-right">
									<button type="submit" class="btn btn-info"><?php echo _l('submit'); ?></button>
								</div>
							</div>
							<input type="hidden" value="<?php echo $client_payment->id; ?>" name="pay_id">
							<?php echo form_close(); ?>
						</div>
					</div>
				</div>
			</div>
			<div class="col-md-7">
				<div class="panel_s">
					<div class="panel-body">
						<h4 class="pull-left "><?php echo _l('payment_view_heading'); ?></h4>
						<div class="pull-right">
							<a href="<?php echo admin_url('payments/pdf/'.$payment->paymentid.'?print=true'); ?>" target="_blank" class="btn btn-default" data-toggle="tooltip" title="<?php echo _l('print'); ?>" data-placement="bottom"><i class="fa fa-print"></i></a>
							<a href="<?php echo admin_url('payments/pdf/'.$payment->paymentid); ?>" class="btn btn-default" data-toggle="tooltip" title="<?php echo _l('view_pdf'); ?>" data-placement="bottom"><i class="fa fa-file-pdf-o"></i></a>
							<?php if(has_permission('managePayment','','delete')){ ?>
							<a href="<?php echo admin_url('payments/delete/'.$payment->paymentid); ?>" class="btn btn-danger _delete"><i class="fa fa-remove"></i></a>
							<?php } ?>
						</div>
						<div class="clearfix"></div>
						<hr class="hr-panel-heading" />
						<div class="row">
							<div class="col-md-6 col-sm-6">
								<address>
									<?php echo format_organization_info(); ?>
								</address>
							</div>
							<div class="col-sm-6 text-right">
								<address>
									<span class="bold">
										<?php echo format_customer_info($invoice, 'payment', 'billing', true); ?>
									</address>
								</div>
							</div>
							<div class="col-md-12 text-center">
								<h3 class="text-uppercase"><?php echo _l('payment_receipt'); ?></h3>
							</div>
							<div class="col-md-12 mtop30">
								<div class="row">
									<div class="col-md-6">
										<p><?php echo _l('payment_date'); ?> <span class="pull-right bold"><?php echo _d($payment->date); ?></span></p>
										<hr />
										<p><?php echo _l('payment_view_mode'); ?>
											<span class="pull-right bold">
												<?php
												if($payment->paymentmode == 1){
													echo 'Cheque';
												}elseif($payment->paymentmode == 2){
													echo 'NEFT';
												}elseif($payment->paymentmode == 3){
													echo 'Cash';
												}

												?>
											</span></p>
											<?php if(!empty($payment->transactionid)) { ?>
											<hr />
											<p><?php echo _l('payment_transaction_id'); ?>: <span class="pull-right bold"><?php echo $payment->transactionid; ?></span></p>
											<?php } 


											if(!empty($files)){
												?>
												<hr>
											<p>Attachments: 
												<span class="pull-right bold">
													<?php
													foreach ($files as $file) {
														?>
														<a download="" href="<?php echo site_url('uploads/payment/'.$file->rel_id.'/'.$file->file_name); ?>"><?php echo $file->file_name; ?></a><br>
														<?php
													}
													?>
													<a></a>
												</span>
											</p>
												<?php
											}
											?>

											
										</div>
										<div class="clearfix"></div>
										<div class="col-md-6">
											<div class="payment-preview-wrapper">
												<?php echo _l('payment_total_amount'); ?><br />
												<?php echo format_money($payment->amount,$invoice->symbol); ?>
											</div>
										</div>
									</div>
								</div>
								<div class="col-md-12 mtop30">
									<h4><?php echo _l('payment_for_string'); ?></h4>
									<div class="table-responsive">
										<table class="table table-borderd table-hover">
											<thead>
												<tr>
													<th><?php echo _l('payment_table_invoice_number'); ?></th>
													<th><?php echo _l('payment_table_invoice_date'); ?></th>
													<th><?php echo _l('payment_table_invoice_amount_total'); ?></th>
													<th><?php echo _l('payment_table_payment_amount_total'); ?></th>
													<?php if($invoice->status != 2 && $invoice->status != 5) { ?>
													<th><span class="text-danger"><?php echo _l('invoice_amount_due'); ?></span></th>
													<?php } ?>
												</tr>
											</thead>
											<tbody>
												<tr>
													<td><?php echo format_invoice_number($invoice->id); ?></td>
													<td><?php echo _d($invoice->date); ?></td>
													<td><?php echo format_money($invoice->total,$invoice->symbol); ?></td>
													<td><?php echo format_money($payment->amount,$invoice->symbol); ?></td>
													<?php if($invoice->status != 2 && $invoice->status != 5) { ?>
													<td class="text-danger">
													<?php echo format_money(get_invoice_total_left_to_pay($invoice->id, $invoice->total), $invoice->symbol); ?>
													</td>
													<?php } ?>
												</tr>
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
				 <div class="btn-bottom-pusher"></div>
			</div>
		</div>
		<?php init_tail(); ?>
<script>
        $(function(){
                _validate_form($('form'),{amount:'required',date:'required'});

                var pmode = $("#paymentmode").val();
                $(".cheque_field").hide();
                if (pmode == 1){
                    $(".cheque_field").show();
                }
        });
                        
        function nospaces(t){
            if(t.value.match(/\s/g)){
              t.value=t.value.replace(/\s/g,'');
            }
        }
        $(document).on("change", "#paymentmode", function(){
           var pmode = $(this).val();
           $(".cheque_field").hide();
           if (pmode == 1){
               $(".cheque_field").show();
           }
        });
$("#paymenttype").on("change", function(){
    var paytype = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/invoice_payments/get_paymenttype_bank'); ?>",
        data    : {'paytype' : paytype},
        success : function(response){
            if(response != ''){                   
                $('#bank_id').html(response);  
                $('.selectpicker').selectpicker('refresh');
            }
        }
    });
});
</script>
	</body>
	</html>

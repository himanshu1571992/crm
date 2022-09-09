<?php

$session_id = $this->session->userdata();

init_head();



?>

<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?><!--  <a href="<?php echo admin_url('report/export_product_sales?year_id='.$s_year.'&service_type='.$s_type); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Excel Export</a> <a target="_blank" href="<?php echo admin_url('report/product_sales_pdf?year_id='.$s_year.'&service_type='.$s_type); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;">PDF Download</a> --></h4>



                        <hr class="hr-panel-heading">

						<form method="post" enctype="multipart/form-data" action="">

						<div class="row">


	                        <div class="col-md-3">
		                            <div class="form-group ">
		                                <label for="client_id" class="control-label">Select Client </label>
		                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
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
		                            <label for="client_branch" class="control-label">Select Client Branch <!-- <small class="req text-danger">* </small> --></label>
		                            <select class="form-control selectpicker" id="client_branch"  name="client_branch[]" multiple="" data-live-search="true">
		                                <option value="">--Select One-</option>
		                                <?php
		                                if(!empty($s_client_branch)){
		                                	foreach ($s_client_branch as $value) {
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

	                        <div class="form-group col-md-2" app-field-wrapper="date">
								<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
								<div class="input-group date">
									<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>
							</div>
							
							<div class="form-group col-md-2" app-field-wrapper="date">
								<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
								<div class="input-group date">
									<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>
							</div>

	                      	                       	                        

						<div class="form-group col-md-1 float-right">

							<button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>

						</div>

						</div>

						</form>

						<br>



						<div class="table-responsive" style="margin-bottom:30px;">
                  		    <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th align="center">Client Name</th>
										<th align="center">Invoice Amount</th>
										<th align="center">Paid Amount</th>
										<th align="center">On Account</th>
										<th align="center">Credit Note</th>
										<th align="center">Balance</th>
                                    </tr>
                                </thead>

                            	<tbody class="ui-sortable">

                        		<?php
								$ttl_invoice = 0;
								$ttl_paid = 0;
								$ttl_balance = 0;
								$ttl_on_account = 0;
								$ttl_creditnote = 0;
								$i=1;

								if(!empty($client_list)){																	

									foreach ($client_list as $client) {

										
											$parent_ids = 0;
											$where = "clientid = '".$client->userid."' and status != '5' ";
											$where_paymentdebitnote = "clientid = '".$client->userid."' and status = '1' ";
											$where_debitnote = "clientid = '".$client->userid."' and invoice_id > '0' and status = '1' ";


											if($service_type != 3){
												$where .= " and service_type = '".$service_type."'";
											}

											if(!empty($f_date) && !empty($t_date)){
												$where .= " and invoice_date between '".$f_date."' and '".$t_date."'";
												$where_paymentdebitnote .= " and date between '".$f_date."' and '".$t_date."'";
												$where_debitnote .= " and dabit_note_date between '".$f_date."' and '".$t_date."'";
											}
											$invoice_amt = 0;
											$paid_amt = 0;
											$creditnote_amt = 0;
											$onaccout_amt = '0.00';
											if($service_type != 3){

												$invoice_info = $this->db->query("SELECT `id`,`total`,`parent_id` from `tblinvoices` where ".$where."  ")->result();
											
												if(!empty($invoice_info)){
													foreach ($invoice_info as $invoice) {
														if($invoice->parent_id == 0){
															$parent_ids .= ','.$invoice->id;
														}
														$invoice_amt += $invoice->total;
														$paid_amt += invoice_received($invoice->id);
														$paid_amt += invoice_tds_received($invoice->id);
													}
												}

												

												$credit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tblcreditnote where invoice_id IN (".$parent_ids.") and invoice_id > '0' and status = '1' ")->result();
												if(!empty($credit_note_info)){
													foreach ($credit_note_info as $creditnote) {
														$creditnote_amt += $creditnote->totalamount;
													}
												}
												$onaccout_amt = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where client_id = '".$client->userid."' and payment_behalf = 1 and service_type = '".$service_type."' ")->row()->ttl_amount;
											}else{
												$payment_debitnote = $this->db->query("SELECT `id`,`amount`,`number` FROM tbldebitnotepayment where ".$where_paymentdebitnote." ")->result();
												if(!empty($payment_debitnote)){
													foreach ($payment_debitnote as $debitnote) {
														$invoice_amt += $debitnote->amount;
														$paid_amt += debitnote_received($debitnote->number);
														$paid_amt += debitnote_tds_received($debitnote->number);
													}
												}

												$debit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tbldebitnote where ".$where_debitnote." ")->result();
												if(!empty($debit_note_info)){
													foreach ($debit_note_info as $debitnote) {
														$invoice_amt += $debitnote->totalamount;
														$paid_amt += debitnote_received($debitnote->number);
														$paid_amt += debitnote_tds_received($debitnote->number);
													}
												}
											}


											$balance_amt = ($invoice_amt - $paid_amt - $onaccout_amt - $creditnote_amt);

											


											if($invoice_amt > 0){


												//Getting SUM
												$ttl_invoice += $invoice_amt;
												$ttl_paid += $paid_amt;
												$ttl_on_account += $onaccout_amt;
												$ttl_balance += $balance_amt;
												$ttl_creditnote += $creditnote_amt;

												?>
													<tr>
														<td><?php echo $i++; ?></td>
														<td><a href="<?php echo admin_url('invoices/ledger/'.$client->client_id);?>" target="_blank"><?php echo cc($client->client_branch_name); ?></a></td>
														<td align="center"><?php echo number_format($invoice_amt, 2); ?></td>
														<td align="center"><?php echo number_format($paid_amt, 2); ?></td>
														<td align="center"><?php echo number_format($onaccout_amt, 2); ?></td>
														<td align="center"><?php echo number_format($creditnote_amt, 2); ?></td>
														<td align="center"><?php echo number_format($balance_amt, 2); ?></td>
													</tr>
												<?php	

											
											}
											
									}

								}else{
									echo '<tr><td colspan=6 align="center" ><b>Record Not Found!</b></td></tr>';
								}

								?>

								</tbody>

							        <tfoot>
							            <tr>
							                <th align="center" colspan="2"><b>Total</b></th>
							                <td align="center"><b><?php echo number_format($ttl_invoice, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_paid, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_on_account, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_creditnote, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_balance, 2); ?></b></td>
							            </tr>
							        </tfoot>

							 </table>

						 </div>

                    </div>

                </div>

            </div>

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

    <?php init_tail(); ?>

   

</body>





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



$(document).ready(function() {

    $('#newtable').DataTable( {

    	

        "iDisplayLength": 25,

        dom: 'Bfrtip',

        lengthMenu: [

            [ 10, 25, 50, -1 ],

            [ '10 rows', '25 rows', '50 rows', 'Show all' ]

        ],

        buttons: [  

        	'pageLength',        

            {

                extend: 'excel',

                exportOptions: {

                    columns: ':visible'

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: ':visible'

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: ':visible'

                }

            },

            'colvis',

        ]

    } );

} );

</script>





</html>

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
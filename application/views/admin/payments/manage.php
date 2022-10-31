<?php init_head(); ?>
<style type="text/css">
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-hold:hover {
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
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
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('payments'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php echo $title; ?></h4>
					<hr class="hr-panel-heading">
					<div class="row">
						<div class="form-group col-md-6">
                            <label for="client_id" class="control-label">Select Client</label>
                            <select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id">
                                <option value=""></option>
                                <?php
                                if (isset($client_info) && count($client_info) > 0) {
                                    foreach ($client_info as $value) {
                                ?>
                                        <option value="<?php echo $value['userid']; ?>" <?php if(!empty($client_id) && $client_id == $value['userid']){ echo 'selected'; } ?>><?php echo cc($value['client_branch_name']); ?></option>
                                <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>				
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
                    </div>
                    <div class="row">
                        <div class="form-group col-md-3">
                            <label for="paymentmethod" class="control-label">Payment For</label>
                            <select class="form-control selectpicker" data-live-search="true" id="paymentmethod" name="paymentmethod">
                                <option value="">--Select All--</option>
                                <option value="2" <?php if(!empty($paymentmethod) && $paymentmethod == 2){ echo 'selected'; } ?>>Invoice</option>
                                <option value="3" <?php if(!empty($paymentmethod) && $paymentmethod == 3){ echo 'selected'; } ?>>Debitnote</option>
                            </select>
                        </div>
                        <div class="form-group col-md-3">
                            <label for="status" class="control-label">Select Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                                <option value=""></option>
                                <option value="0" <?php if(!empty($s_status) && $s_status == 0){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(!empty($s_status) && $s_status == 1){ echo 'selected'; } ?>>Approved</option>
                                <option value="2" <?php if(!empty($s_status) && $s_status == 2){ echo 'selected'; } ?>>Rejected</option>
								<option value="4"<?php echo (isset($s_status) && $s_status == 4) ? 'selected' : "" ?>>Reconciliation</option>
                                <option value="5"<?php echo (isset($s_status) && $s_status == 5) ? 'selected' : "" ?>>On Hold</option>
                            </select>
                        </div>
						<div class="col-md-1">                            
                        	<button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         	<a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>	
                    </div>
					<div class="row">
						<div class="col-md-12 table-responsive">																
							<table class="table" id="newtable">
								<thead>
									<tr>
									<th>S.No.</th>
									<!-- <th>Added By</th> -->
									<!-- <th>Payment No.</th> -->
									<th>Payment for</th>
									<th>Invoice/Debitnote</th>
									<th>Service Type</th>
									<th>Payment Mode</th>
									<th>Bank</th>										
									<th>TDS %</th>
									<th>Customer</th>
									<th>Amount</th>
									<th>Created Date</th>
									<th>Receipt Date</th>
									<th>Status</th>
									<th>Action</th>
									</tr>
								</thead>
								<tbody>
									<?php
									if(!empty($payment_list)){
										$z=1;
										foreach($payment_list as $row){	
												$service_type = '--';
												if($row->paymentmethod == 2){
													$service_id = value_by_id('tblinvoices',$row->invoiceid,'service_type');
												   if($service_id == 1){
												   		$service_type = 'Rent';
												   }else{
												   		$service_type = 'Sales';
												   }
												}else{
													$debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$row->debitnote_no."' ")->row();
		        									$debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$row->debitnote_no."' ")->row();	
												}
											    if($row->paymentmode == 1){
											      $payment_name = 'Cheque';
											    }elseif($row->paymentmode == 2){
											      $payment_name = 'NEFT';
											    }elseif($row->paymentmode == 3){
											      $payment_name = 'Cash';
											    }
											    $client_info = client_info($row->client_id);
                                                
                                                	if($row->status == 0){
														$status = 'Pending';
														$cls = 'btn-warning btn-xs';
													}elseif($row->status == 1){
														$status = 'Approved';
														$cls = 'btn-success btn-xs';
													}elseif($row->status == 2){
														$status = 'Rejected';
														$cls = 'btn-danger btn-xs';
													}elseif($row->status == 4){
														$status = 'Reconciliation';
														$cls = 'btn-brown btn-xs';
													}elseif($row->status == 5){
														$status = 'On Hold';
														$cls = 'btn-hold btn-xs';
													}
												$created_date = date('d/m/Y',strtotime($row->daterecorded));	
												$receipt_date = date('d/m/Y',strtotime($row->date));	
												$datechanges = ($created_date != $receipt_date)	? 'style="background-color: red;color:#fff"': '';
											?>																						

											<tr <?php echo $datechanges; ?>>
												<td><?php echo $z++;?></td>
												<!-- <td><a target="_blank" href="<?php echo admin_url('payments/payment/' . $row->id); ?>"><?php echo str_pad($row->id, 4, '0', STR_PAD_LEFT);?></a></td> -->
												<!-- <td><?php //echo get_employee_fullname($row->staff_id);  ?></td> -->
												<td>
													<?php 
														echo get_creator_info($row->staff_id, $row->daterecorded);
														echo ($row->paymentmethod == 2) ? 'Invoice' : 'Debitnote';
													?>
												</td>
											<?php
												if($row->paymentmethod == 2){
											?>
													<td><?php echo '<a target="_blank" href="' . admin_url('invoices/list_invoices/' . $row->invoiceid) . '">' . format_invoice_number($row->invoiceid) . '</a>'; ?></td>
										    <?php
												}else{
													if(!empty($debit_info)){
														echo '<td><a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
													}elseif(!empty($debitpayment_info)){
														echo '<td><a target="_blank" href="' . admin_url('debit_note/download_paymentpdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
													}else{
														echo '<td>--</td>';
													}
												}
											?>
												<td><?php echo $service_type;?></td>												
												<td><?php echo $payment_name;?></td>												
                                                <td>
													<?php
														if(!empty($row->bank_id))
														{
															$bank = $this->db->query("SELECT * FROM tblbankmaster  where id = '".$row->bank_id."' ")->row();
															echo $bank->bank_code;
														}
														else
														{
															echo "---";
														}
                                                 	?>
												</td>
												<td><?php echo $row->tds;?></td>
												<td><a target="_blank" href="<?php echo admin_url('clients/client/'.$row->client_id); ?>"><?php echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--';  ?> </a></td>
												<td><?php echo $row->amount;?></td>
												<td><?php echo $created_date; ?></td>
												<td><?php echo $receipt_date; ?></td>
												<td><?php echo '<button type="button" class="btn '.$cls.' btn-sm status" value="'.$row->pay_id.'" data-toggle="modal" data-target="#statusModal">'.$status.'</button>'; ?></td>
                                                <td class="text-center">
			                                        <div class="btn-group pull-right">
			                                             <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
			                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
			                                             </button>
			                                             <ul class="dropdown-menu dropdown-menu-right toggle-menu">
			                                                <li>
			                                                 <a target="_blank" class="" title="View" href="<?php echo admin_url('payments/payment/' . $row->id); ?>">Edit</a>
													 <?php

													if((check_permission_page(92,'delete'))){

														?>

														<a class="_delete" title="Delete" href="<?php echo admin_url('payments/delete/'.$row->id);?>" data-status="1">Delete</a>	

													<?php

													}

													?>
                                                   <a target="_blank" class="" title="View" href="<?php echo admin_url('payments/payment_view/' . $row->id); ?>">View</a> 
			                                                </li>
			                                             </ul>
			                                        </div>
			                                    </td>

												

											</tr>

											<?php

												}

											}else{

												echo '<tr><td class="text-center" colspan="10"><h5>Record Not Found</h5></td></tr>';

											}

											?>

									  

									 

									</tbody>

								  </table>

							</div>





													

					</div>

							

							

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





<!-- Modal -->

<div id="statusModal" class="modal fade" role="dialog">

  <div class="modal-dialog">



    <!-- Modal content-->

    <div class="modal-content">

      <div class="modal-header">

        <button type="button" class="close" data-dismiss="modal">&times;</button>

        <h4 class="modal-title">Client Payment Receipt Status</h4>

      </div>

      <div class="modal-body" id="approval_html">

      </div>

      <div class="modal-footer">

        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

      </div>

    </div>



  </div>

</div>







<?php init_tail(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script>



$(document).ready(function() {

    $('#newtable').DataTable( {

        "iDisplayLength": 15,

        dom: 'Bfrtip',

        buttons: [           

            {

                extend: 'excel',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]

                }

            },

            'colvis'

        ]

    } );

} );

</script>



<script type="text/javascript">
	$('.status').click(function(){
	var id = $(this).val();  
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/payments/get_status'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script>

</body>

</html>


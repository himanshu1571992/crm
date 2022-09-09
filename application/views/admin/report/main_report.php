<?php

$session_id = $this->session->userdata();

init_head();

$get_link = '';
if(!empty($s_fdate) && !empty($s_tdate)){
	$get_link = '?f_date='.$s_fdate.'&t_date='.$s_tdate;
}

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

	                        <div class="form-group col-md-3" app-field-wrapper="date">
								<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
								<div class="input-group date">
									<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>
							</div>
							
							<div class="form-group col-md-3" app-field-wrapper="date">
								<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
								<div class="input-group date">
									<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>
							</div>

	                     

	                       	                        

						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                        </div>

						</div>

						</form>

						<br>



						<div class="table-responsive" style="margin-bottom:30px;">
                  		    <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th align="center">Head</th>
										<th align="center">Total Invoice Amount</th>
										<th align="center">Total Payment Received</th>
										<th align="center">Total On Account</th>
										<th align="center">Credit Note</th>
										<th align="center">Balance</th>
                                    </tr>
                                </thead>

                            	<tbody class="ui-sortable">

                        		<?php
										
									$sale_invoice = 0;
									$sale_payment = 0;
									$sale_creditnote = 0;
									$sale_parent_ids = 0;
									$rent_payment = 0;
									$rent_creditnote = 0;
									$rent_invoice = 0;
									$rent_parent_ids = 0;
									$dn_amount = 0;
									$dn_payment = 0;

									$where = " status != '5' ";
									$where_debitnote = " invoice_id > '0' and status = '1' ";
									$where_debitnote_payment = " status = '1' ";

									if(!empty($f_date) && !empty($t_date)){
										$where .= " and invoice_date between '".$f_date."' and '".$t_date."'";
										$where_debitnote .= " and dabit_note_date between '".$f_date."' and '".$t_date."'";
										$where_debitnote_payment .= " and date between '".$f_date."' and '".$t_date."'";
									}

									$sale_invoice_info = $this->db->query("SELECT `id`,`total`,`parent_id` from `tblinvoices` where ".$where." and service_type = 2 ")->result();
									$rent_invoice_info = $this->db->query("SELECT `id`,`total`,`parent_id` from `tblinvoices` where ".$where." and service_type = 1 ")->result();

									//Getting Invoice Total
									if(!empty($sale_invoice_info)){
										foreach ($sale_invoice_info as $sales) {
											if($sales->parent_id == 0){
												$sale_parent_ids .= ','.$sales->id;
											}
											$sale_invoice += $sales->total;
											$sale_payment += invoice_received($sales->id);
											$sale_payment += invoice_tds_received($sales->id);
										}
									}

									if(!empty($rent_invoice_info)){
										foreach ($rent_invoice_info as $rent) {
											if($rent->parent_id == 0){
												$rent_parent_ids .= ','.$rent->id;
											}
											$rent_invoice += $rent->total;
											$rent_payment += invoice_received($rent->id);
											$rent_payment += invoice_tds_received($rent->id);
										}
									}

									//Getting Credit Note
									$sale_credit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tblcreditnote where invoice_id IN (".$sale_parent_ids.") and invoice_id > '0' and status = '1' ")->result();
									if(!empty($sale_credit_note_info)){
										foreach ($sale_credit_note_info as $sale_cn) {
											$sale_creditnote += $sale_cn->totalamount;
										}
									}

									$rent_credit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tblcreditnote where invoice_id IN (".$rent_parent_ids.") and invoice_id > '0' and status = '1' ")->result();
									if(!empty($rent_credit_note_info)){
										foreach ($rent_credit_note_info as $rent_cn) {
											$rent_creditnote += $rent_cn->totalamount;
										}
									}

									//Getting Debit Note
									$debit_note_info = $this->db->query("SELECT `id`,`totalamount`,`number` FROM tbldebitnote where ".$where_debitnote." ")->result();
									if(!empty($debit_note_info)){
										foreach ($debit_note_info as $debitnote) {
											$dn_amount += $debitnote->totalamount;
											$dn_payment += debitnote_received($debitnote->number);
											$dn_payment += debitnote_tds_received($debitnote->number);
										}
									}

									$payment_debitnote = $this->db->query("SELECT `id`,`amount`,`number` FROM tbldebitnotepayment where ".$where_debitnote_payment." ")->result();
									if(!empty($payment_debitnote)){
										foreach ($payment_debitnote as $pay_debitnote) {
											$dn_amount += $pay_debitnote->amount;
											$dn_payment += debitnote_received($pay_debitnote->number);
											$dn_payment += debitnote_tds_received($pay_debitnote->number);
										}
									}

									$sale_onaccout = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where  payment_behalf = 1 and service_type = 2 and status = 1")->row()->ttl_amount;
									$rent_onaccout = $this->db->query("SELECT COALESCE(SUM(ttl_amt),0) AS ttl_amount FROM `tblclientpayment`  where  payment_behalf = 1 and service_type = 1 and status = 1")->row()->ttl_amount;
									
									$sale_balance = ($sale_invoice - $sale_payment - $sale_creditnote - $sale_onaccout);
									$rent_balance = ($rent_invoice - $rent_payment - $rent_creditnote - $rent_onaccout);
									$dn_balance = ($dn_amount - $dn_payment);


									$ttl_invoice = ($sale_invoice + $rent_invoice + $dn_amount);
									$ttl_payment = ($sale_payment + $rent_payment + $dn_payment);
									$ttl_creditnote = ($sale_creditnote + $rent_creditnote);
									$ttl_onaccount = ($sale_onaccout + $rent_onaccout);
									$ttl_balance = ($sale_balance + $rent_balance + $dn_balance);
									?>
										<tr>
											<td>1</td>
											<td><a target="_blank" href="<?php echo admin_url('report/sub_report/2'.$get_link); ?>">Sale</a></td>
											<td align="center"><?php echo number_format($sale_invoice, 2); ?></td>
											<td align="center"><?php echo number_format($sale_payment, 2); ?></td>
											<td align="center"><?php echo number_format($sale_onaccout, 2); ?></td>
											<td align="center"><?php echo number_format($sale_creditnote, 2); ?></td>
											<td align="center"><?php echo number_format($sale_balance, 2); ?></td>
										</tr>

										<tr>
											<td>2</td>
											<td><a target="_blank" href="<?php echo admin_url('report/sub_report/1'.$get_link); ?>">Rent</a></td>
											<td align="center"><?php echo number_format($rent_invoice, 2); ?></td>
											<td align="center"><?php echo number_format($rent_payment, 2); ?></td>
											<td align="center"><?php echo number_format($rent_onaccout, 2); ?></td>
											<td align="center"><?php echo number_format($rent_creditnote, 2); ?></td>
											<td align="center"><?php echo number_format($rent_balance, 2); ?></td>
										</tr>

										<tr>
											<td>3</td>
											<td><a target="_blank" href="<?php echo admin_url('report/sub_report/3'.$get_link); ?>">DN</a></td>
											<td align="center"><?php echo number_format($dn_amount, 2); ?></td>
											<td align="center"><?php echo number_format($dn_payment, 2); ?></td>
											<td align="center">0.00</td>
											<td align="center">0.00</td>
											<td align="center"><?php echo number_format($dn_balance, 2); ?></td>
										</tr>
									<?php
								
									

								?>

								</tbody>

								<tfoot>
							            <tr>
							                <th align="center" colspan="2"><b>Total</b></th>
							                <td align="center"><b><?php echo number_format($ttl_invoice, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_payment, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_onaccount, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_creditnote, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_balance, 2); ?></b></td>
							            </tr>
							    </tfoot>

							 </table>

						 </div>

                    </div>
<p style="color: red;">Note:- Here Debitnote is not calculating againt parent invoice</p>
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
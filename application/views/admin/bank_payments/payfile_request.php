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
                    
                          <div class="form-group col-md-3">
                           	<label for="status" class="control-label">Select Status</label>
                               <select class="form-control selectpicker" id="status" name="status">
                                <option value="" disabled selected >--Select One-</option>

                                      <option value="1"<?php echo (isset($status) && $status == 1) ? 'selected' : "" ?>>Payfile Pending</option>
                                      <option value="2"<?php echo (isset($status) && $status == 2) ? 'selected' : "" ?>>Payfile Done</option>
                               </select>
                            </div>

	                        

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

	                        

		                                     

						<div class="form-group col-md-2 float-right">

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
                                        <th>Request Id</th>
                                        <th>Added By</th>                                        
                                        <th>Remark</th>                                        
                                        <th>Date</th>
                                        <th>Total Amount</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
                                    </tr>
                                </thead>
                                 
                                <tbody class="ui-sortable">

                        		<?php
								
								$i=1;

								if(!empty($request_info)){							
                                    foreach ($request_info as $row) { 

                                        if($row->status == 1){
                                            $status = 'Payfile Pending';
                                            $cls = 'btn-warning';
                                        }elseif($row->status == 2){
                                            $status = 'Payfile Done';
                                            $cls = 'btn-success';
                                        }

                                        $details = $this->db->query("SELECT SUM(`amount`) as ttl_amt FROM tblbankpaymentrequestdetails WHERE main_id = '".$row->id."' ")->row();
                                    ?>
                                     <tr>
                                     	<td><?php echo $i; ?></td>
                                     	<td><?php echo 'REQ-'.$row->id; ?></td>
                                        <td><?php echo get_employee_name($row->staff_id);?></td>
                                        <td><?php echo $row->remark; ?></td>
                                        <td><?php echo _d($row->created_at); ?></td>
                                        <td><?php echo $details->ttl_amt;?></td>
                                        <td><?php echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" >'.$status.'</button>'; ?></td>
                                        <td>
                                            <?php
                                            if($row->status == 1){
                                                ?>
                                                <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=pay_request&id='.$row->id); ?>">Pay File</a>
                                                <?php
                                            }
                                            ?>
                                        </td>
                                     </tr>
										
											
											
										<?php $i++;	
                                        }
											
									}

								

								?>

								</tbody>
                            	

							        <!-- <tfoot>
							            <tr>
							                <th align="center" colspan="2"><b>Total</b></th>
							                <td align="center"><b><?php echo number_format($ttl_invoice, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_paid, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_on_account, 2); ?></b></td>
											<td align="center"><b><?php echo number_format($ttl_balance, 2); ?></b></td>
							            </tr>
							        </tfoot> -->

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


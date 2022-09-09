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
                    
                           <div class="form-group col-md-4">
                           	<label for="category" class="control-label">Select Category</label>
                               <select class="form-control selectpicker category" val="" id="category_id" name="paymentdata">
                                <option value="" disabled selected >--Select One-</option>
                                      <?php
                                      if(!empty($category_info)){
                                        foreach ($category_info as $value) {
                                            ?>
                                            <option value="<?php echo $value->id; ?>"<?php echo (isset($s_paymentdata) && $s_paymentdata ==$value->id) ? 'selected' : "" ?>><?php echo cc($value->name); ?></option>
                                            <?php
                                        }
                                      }
                                      ?>
                               </select>
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
                                        <th align="center">Payment ID</th>
										<th align="center">Category</th>
										<th align="center">Name</th>
										<th align="center">Amount</th>
										<th align="center">UTR No.</th>
										<th align="center">Date</th>
										<th align="center">Remark</th>
										<th align="center">From/To Date</th>
										<th align="center">Deposit</th> 
                                    </tr>
                                </thead>
                                 
                                <tbody class="ui-sortable">

                        		<?php
								
								$i=1;

								if(!empty($payment_info)){							foreach ($payment_info as $client) { 
                                    ?>
                                     <tr>
                                     	<td><?php echo $i; ?></td>
                                     	<td><?php echo 'PAY-'.$client->main_id; ?></td>
                                     	<td><?php echo cc(value_by_id('tblcompanyexpensecatergory',$client->category_id,'name')); ?></td>
                                     	<td>
                                 		<?php
                                         if($client->category_id == 1)
                                         {
			                                $payee_info = $this->db->query("SELECT staffid as id,firstname as name FROM `tblstaff` where staffid = '".$client->payee_id."' ")->row();
			                             }
			                             elseif($client->category_id == 2)
			                             {
			                                $payee_info = $this->db->query("SELECT id,name FROM `tblvendor` where id = '".$client->payee_id."' ")->row();  
			                             }
			                             else
			                             {
			                                $payee_info = $this->db->query("SELECT id,name FROM `tblcompanyexpenseparties` where id = '".$client->payee_id."' ")->row(); 
			                             }

			                            $payee_name = $payee_info->name;
			                            echo cc($payee_name);
                                 		 ?>
                                     	</td>
                                     	<td><?php echo $client->amount; ?></td>
                                     	<td><?php echo $client->utr_no; ?></td>
                                     	<td><?php echo $client->utr_date; ?></td>
                                     	<td><?php echo cc($client->first_remark); ?></td>
                                     	<td>
                                 		<?php
                                         $category_id = $client->category_id;
                                 		//if($category_id == 2 || $category_id == 3)
                                         if($client->fromdate > 0 && $client->todate > 0)
                                 		{
                                         echo _d($client->fromdate)." - "._d($client->todate);
                                     	}
                                     	else
                                     	{
                                     	echo "-";
                                        } ?>
                                        </td>
                                     	<td>
                                     	<?php if($client->category_id == 3)
                                     	{
                                          echo $client->deposit;
                                     	}
                                     	else
                                     	{
                                     	echo "-";
                                        } ?>
                                     		
                                     	</td>
                                     </tr>
										
											
											
										<?php $i++;	}
											
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


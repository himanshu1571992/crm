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

							<!-- <div class="form-group col-md-2">

								<label for="year" class="control-label"><?php echo 'Year'; ?> *</label>

								<select class="form-control" required="" id="year" name="year">

									<option value="" disabled selected >--Select One-</option>

									<?php

									$j = date('Y');

									for($i=2018; $i<=$j; $i++){

										?>

										<option value="<?php echo $i;?>" <?php if(!empty($sr_year) && $sr_year == $i){ echo 'selected';} ?>  ><?php echo $i; ?></option>

										<?php

									}

									?>

								</select>

							</div>



							<div class="form-group col-md-3">

								<label for="month" class="control-label"><?php echo 'Month'; ?> *</label>

								<select class="form-control" required="" id="month" name="month">

									<option value="" disabled selected >--Select One-</option>

									<?php

									if(!empty($month_info)){

										foreach($month_info as $row){

											?>

											<option value="<?php echo $row->id;?>" <?php if(!empty($s_month) && $s_month == $row->id){ echo 'selected';} ?>  ><?php echo $row->month_name; ?></option>

											<?php

										}

									}

									?>

								</select>

							</div> -->



							<div class="col-md-4" id="employee_div">

	                            <div class="form-group ">

	                                <label for="branch_id" class="control-label">Client</label>

	                                <select class="form-control selectpicker" id="client_id" name="client_id[]" data-live-search="true" multiple="">

	                                    <option value="" disabled >--Select One-</option>

	                                    <?php

	                                    if(!empty($client_data)){

	                                        foreach ($client_data as $row) {

	                                        	$selected = '';

	                                        	if (in_array($row->userid, $s_client_id)){

	                                        		$selected = 'selected';

	                                        	}

	                                            ?>

	                                            <option value="<?php echo $row->userid; ?>" <?php echo $selected;  ?>><?php echo cc($row->client_branch_name); ?></option>

	                                            <?php

	                                        }

	                                    }

	                                    ?>

	                                </select>

	                            </div>

	                        </div>

	                        <div class="col-md-3">
	                        	<label for="f_date" class="control-label">From Date</label>
				               <div class="input-group date">	
				                    <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

				                </div>

				              </div>

				              <div class="col-md-3">
				              	<label for="t_date" class="control-label">To Date</label>
				                <div class="input-group date">				                	
				                    <input id="t_date" placeholder="To date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

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

                                        <th>Invoice #</th>

										<th>Client Name</th>

										<th>Site Name</th>

										<th>Location</th>

										<th>Start Date</th>

										<th>Model</th> 

										<th align="center">Basic Amt</th>

										<th align="center">Invoice Value</th>										

										<th align="center">Quatity</th> 

										<th align="center">Item Value</th>
                                    </tr>
                                </thead>

                            	<tbody class="ui-sortable">

                        		<?php

								$ttl_basic = 0;

								$ttl_invoice_amt = 0;

								$ttl_qty = 0;

								$ttl_value = 0;

								$i=1;

								if(!empty($invoice_list)){																	

									foreach ($invoice_list as $invoice) {

										//$invoice_items = $this->db->query("SELECT * from `tblitems_in` where rel_id = '".$invoice->id."' and rel_type = 'invoice' ")->result();
										$invoice_items = $this->db->query("SELECT i.* from `tblitems_in` as i LEFT JOIN tblproducts as p ON p.id = i.pro_id where i.rel_id = '".$invoice->id."' and i.rel_type = 'invoice' and p.isOtherCharge = 0")->result();

										$client_info = $this->db->query("SELECT client_branch_name,company from `tblclientbranch` where userid = '".$invoice->clientid."' ")->row();

										$site_info = $this->db->query("SELECT * FROM `tblsitemanager` where id = '".$invoice->site_id."' ")->row();



										$parent_invoice = $this->db->query("SELECT `invoice_date` FROM `tblinvoices` where id = '".$invoice->parent_id."' ")->row();

										if(!empty($parent_invoice)){

											$invoice_date = $parent_invoice->invoice_date;

										}else{

											$invoice_date = $invoice->invoice_date;

										}

										

										$ttl_invoice_amt += $invoice->total;

									

										if(!empty($invoice_items)){

											foreach ($invoice_items as $key => $value) {

												$totalmonths = ($value->months + ($value->days / 30));

												$basic_amt = ($value->rate * $value->qty * $totalmonths * $value->weight);



												$item_value = get_material_value($value->pro_id,$value->qty);



												$ttl_basic += $basic_amt;

												

												$ttl_qty += $value->qty;

												$ttl_value += $item_value;



												if($key == 0){

													$invoice_amt = $invoice->total;

												}else{

													$invoice_amt = '--';

												}

											?>

												<tr>

													<td><?php echo $i++; ?></td>

													<td><?php echo '<a href="' . admin_url('invoices/download_pdf/' . $invoice->id).'" target="_blank">' .format_invoice_number($invoice->id). '</a>'; ?></td>

													<td><?php echo cc($client_info->client_branch_name); ?></td>

													<td><?php echo (!empty($site_info)) ? cc($site_info->name) : '--'; ?></td>

													<td><?php echo (!empty($site_info)) ? value_by_id('tblcities',$site_info->city_id,'name') : '--'; ?></td>

													<td><?php echo _d($invoice_date); ?></td>												

													<td><?php echo value_by_id('tblproducts',$value->pro_id,'sub_name').product_code($value->pro_id); ?></td>

													<td align="center"><?php echo number_format($basic_amt, 2, '.', ''); ?></td>

													<td align="center"><?php echo $invoice_amt; ?></td>	

													<td align="center"><?php echo $value->qty; ?></td>

													<td align="center"><?php echo number_format($item_value, 2, '.', ''); ?></td>

												</tr>	

											<?php

											}

										}

										



									}

								}else{

									echo '<tr><td colspan=11 align="center" ><b>Record Not Found!</b></td></tr>';

								}

								?>

								</tbody>

							        <tfoot>

							            <tr>

							                <th align="right" colspan="7">Total</th>

							                <td align="center"><b><?php echo number_format($ttl_basic, 2, '.', ''); ?></b></td>

											<td align="center"><b><?php echo number_format($ttl_invoice_amt, 2, '.', ''); ?></b></td>

											<td align="center"><b><?php echo number_format($ttl_qty, 2, '.', ''); ?></b></td>

											<td align="center"><b><?php echo number_format($ttl_value, 2, '.', ''); ?></b></td>

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

    	

        "iDisplayLength": 15,

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


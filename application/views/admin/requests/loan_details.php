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

                        <h4 class="no-margin">Staff Loan Details</h4>

                        <hr class="hr-panel-heading">

						<form method="post" enctype="multipart/form-data" action="<?php  echo admin_url('requests/staff_loan_details'); ?>">

						<div class="row">

						<div class="form-group col-md-4" id="employee_div">

							<label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> *</label>

							<select required="" class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">

								<option value="0" <?php echo (isset($staff_id) && $staff_id == 0) ? 'selected' : "" ?> >--Select All-</option>	

								<?php

								if(!empty($staff_list)){

									foreach($staff_list as $staff){

										?>

										<option value="<?php echo $staff->staffid;?>" <?php echo (isset($staff_id) && $staff_id ==$staff->staffid) ? 'selected' : "" ?>><?php echo $staff->firstname; ?></option>

										<?php

									}

								}

								?>

							</select>

						</div>



						<div class="form-group col-md-2" app-field-wrapper="date">

							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>

							<div class="input-group date">

								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($sf_date)){ echo $sf_date; }?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

							</div>

						</div>

						

						<div class="form-group col-md-2" app-field-wrapper="date">

							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>

							<div class="input-group date">

								<input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($st_date)){ echo $st_date; }?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

							</div>

						</div>



						<div class="form-group col-md-2">

							<label for="status" class="control-label">Loan Status *</label>

							<select class="form-control" id="status" name="status" required="">

								<option value="0" <?php if(!empty($s_status) && $s_status == 0){ echo 'selected'; } ?>>Running</option>

								<option value="1" <?php if(!empty($s_status) && $s_status == 1){ echo 'selected'; } ?>>Closed</option>

								<option value="2" <?php if(!empty($s_status) && $s_status == 2){ echo 'selected'; } ?>>Both</option>

							</select>

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

						<div class="row">
						
							
	                    	<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
										<tr>
											<th align="center">S.No</th>

											<th align="center">Employee Name</th>

											<th align="center">Loan Date</th>

											<th align="center">Loan Amt</th>                                        

											<th align="center">Paid Amt</th>                                        

											<th align="center">Pending Amt</th>                                        

											<th align="center">Installment</th>

											<th align="center">Paid Installment</th>

											<th align="center">Status</th>

											<th align="center">Action</th>

										</tr>

									</thead>



									<tbody class="ui-sortable">

									<?php

									if(!empty($request_info)){

										$i=1;

										foreach ($request_info as $row) {

											$query = $this->db->query("SELECT sum(paid_amount) as paid_amt FROM `tblstaffloanlog` where request_id = '".$row->id."' ");	

											if($query->num_rows()>0){

												$paid_amt = $query->row()->paid_amt;

											}else{

												$paid_amt = "0.00";

											}



											$query_1 = $this->db->query("SELECT count(id) as installment FROM `tblstaffloanlog` where request_id = '".$row->id."' ");	

											if($query_1->num_rows()>0){

												$installment = $query_1->row()->installment;

											}else{

												$installment = 0;

											}



											$query_2 = $this->db->query("SELECT count(id) as paid_installment FROM `tblstaffloanlog` where request_id = '".$row->id."' and status = 1 ");	

											if($query_2->num_rows()>0){

												$paid_installment = $query_2->row()->paid_installment;

											}else{

												$paid_installment = 0;

											}





											$query_3 = $this->db->query("SELECT * FROM `tblstaffloanlog` where request_id = '".$row->id."' and closed = 1 ");	



											if(($paid_installment == $installment) || ($query_3->num_rows()>0)){

												if($query_3->num_rows()>0){

													$status = 'Closed (By Admin)';

												}else{

													$status = 'Closed';

												}

												

											}else{

												$status = 'Running';

											}



											$pending_amt = ($row->approved_amount - $paid_amt);



											?>

											<tr>

												<td align="center"><?php echo $i++; ?></td>

												<td align="center"><?php echo get_employee_name($row->addedfrom); ?></td>

												<td align="center"><?php echo date('d/m/Y',strtotime($row->date)); ?></td>

												<td align="center" class="text-primary"><?php echo $row->approved_amount; ?></td>

												<td align="center" class="text-success"><?php echo $paid_amt; ?></td>

												<td align="center" class="text-danger"><?php echo number_format($pending_amt, 2, '.', ''); ?></td>

												<td align="center"><?php echo $installment; ?></td>

												<td align="center"><?php echo $paid_installment; ?></td>

												<td align="center"><?php echo $status; ?></td>

												<td align="center"><?php  if($status == 'Running'){

													?>

													<a href="<?php  echo admin_url('requests/close_loan/'.$row->id); ?>" class="btn btn-info _delete">Close Loan</a>

													<?php

												}else{ echo '--';} ?></td>

											</tr>	

											<?php





										}

									}else{

										echo '<tr><td colspan=9 align="center" ><b>Loan Record Not Available</b></td></tr>';

									}

									?>

									</tbody>

								</table>
	                           
	                        </div>
                        </div>		


								

					

						 <!-- <div class="btn-bottom-toolbar text-right">

                            <button class="btn btn-info" name="submit" id="submit" type="submit">

                                <?php echo _l('submit'); ?>

                            </button>

                        </div> -->

						

                    </div>

                </div>

               



            </div>

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

    <?php init_tail(); ?>



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

        buttons: [           

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

            'colvis'

        ]

    } );

} );

</script>

   

</body>





<script type="text/javascript">



$('.challan').click(function(){

	var challan_id = $(this).val();

	if($(this).prop('checked') === true){

		 $.ajax({

	            type    : "POST",

	            url     : "<?php echo site_url('admin/chalan/get_challan_component'); ?>",

	            data    : {'challan_id' : challan_id},

	            success : function(response){

	                if(response != ''){                     

	                    $('#table_details').append(response);       

	                }

	            }

	        })

	}else{

		$("#tbl_"+challan_id).remove();

	}

        

    

}); 



$(document).on('keyup', '.qty', function() { 	

	var qty_id = $(this).attr('id');

	var arr = qty_id.split('_');

	challan_id = arr[1];

	id = arr[2];



	var total = parseInt($('#ttl_'+challan_id+'_'+id).val());

	var list = parseInt($('#list_'+challan_id+'_'+id).val());

	var ok = parseInt($('#ok_'+challan_id+'_'+id).val());

	var nr = parseInt($('#nr_'+challan_id+'_'+id).val());

	var r = parseInt($('#r_'+challan_id+'_'+id).val());

	var lost = parseInt($('#lost_'+challan_id+'_'+id).val());



	var add_qty = (list+ok+nr+r+lost);

	var pending = (total-add_qty);



	$('#pending_'+challan_id+'_'+id).val(pending);	





}); 



</script> 





</html>


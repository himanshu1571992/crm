<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

					<h4>On Account Balance</h4>

					<hr class="hr-panel-heading">
					
					<div class="row">
						<div class="col-md-4" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Select Vendor</label>
                                <select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($vendor_data)){
                                        foreach ($vendor_data as $row) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>" <?php echo (isset($s_vendor_id) && $s_vendor_id ==$row->id) ? 'selected' : "" ?>><?php echo cc($row->name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>
						
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($sf_date) && $sf_date != "") ? $sf_date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>

						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($st_date) && $st_date != "") ? $st_date : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
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
										<th>S.No</th>
										<th>Vendor Name</th>
										<th>Payment Mode </th>
										<th>Reference No.</th>
										<th>Date</th>
										<th>Amount</th>
										<th>Action</th>
									  </tr>
									</thead>
									<tbody>
										<?php
										if(!empty($table_data)){
											foreach ($table_data as $key => $value) {

												if($value->payment_mode == 1){
													$paymentmode = 'Cheque';
												}elseif($value->payment_mode == 2){
													$paymentmode = 'NEFT';
												}elseif($value->payment_mode == 3){
													$paymentmode = 'Cash';
												}

												?>
												<tr>
													<td><?php echo ++$key; ?></td>
													<td>
                                                        <?php echo get_creator_info($value->staff_id, $value->created_date); ?>
                                                        <?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name')); ?>
                                                    </td>
													<td><?php echo cc($paymentmode); ?></td>
													<td><?php echo $value->reference_no; ?></td>
													<td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
													<td><?php echo $value->ttl_amt; ?></td>
													<td><a class="btn btn-info" href="<?php echo base_url('admin/purchase_payments/convert_againstinvoice/'.$value->id); ?>" >Against Invoice</a>
                                                    <?php
                                                    if(check_permission_page(56,'delete')){
                                                        ?>
                                                        <a href="<?php echo admin_url('purchase_payments/delete_on_account/'.$value->id); ?>" class="btn btn-danger _delete" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        echo '--';
                                                    }
                                                    ?>
													</td>
												</tr>
												<?php
											}
										}else{
											echo '<tr><td class="text-center" colspan="7"><b>Record Not Found!</b></td></tr>';
										}
										?>
									  
									 
									</tbody>
								  </table>
							</div>
						
						

                               
                            </div>
							 <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div> -->
                        </div>
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
		</div>		
        <div class="btn-bottom-pusher"></div>
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


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            'colvis'
        ]
    } );
} );
</script>

<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
	$(document).on('change', '.status', function(){	
		var staff_id = $(this).attr('title');
		var status = $(this).val();
		
		if(status == 5){
			
			$("#working_to_"+staff_id).prop("disabled", false);
		}else{
			$("#working_to_"+staff_id).prop("disabled", true);
		}
			
		
		//$("#attendance_form").submit();	
	});	
</script> 

</body>
</html>

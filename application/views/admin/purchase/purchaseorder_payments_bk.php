<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; //if(check_permission_page(40,'create')){ ?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('purchase/purchaseorder_payment_add/'.$purchaseorder_info->id); ?>" class="btn btn-info">Add Payment Request</a><?php //} ?>
                        </div>
                    </div>

					<hr class="hr-panel-heading">
					
					<div class="row">
					

						<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Added By</th>
										<th>Date</th>
										<th>Amount</th>
										<th>Approve Amount</th>
										<th>Status</th>
										<th>UTR</th>
										<th>Action</th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($payment_list)){
										$z=1;
										foreach($payment_list as $row){	

											if($row->status == 0){
												$status = 'Pending';
												$cls = 'btn-warning';
											}elseif($row->status == 1){
												$status = 'Approved';
												$cls = 'btn-success';
											}elseif($row->status == 2){
												$status = 'Rejected';
												$cls = 'btn-danger';
											}


											if($row->acceptance == 0){
												$accept_status = 'Acceptance Pending';
												$accept_cls = 'btn-warning';
											}elseif($row->status == 1){
												$accept_status = 'Accepted';
												$accept_cls = 'btn-success';
											}

											$can_delete = $this->db->query("SELECT * from tblpurchaseorderpaymentapproval where pay_id = '".$row->id."' and (approve_status = 1 || approve_status = 2) ")->row_array();
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo get_employee_name($row->staff_id); ?></td>
												<td><?php echo _d($row->created_at); ?></td>
												<td><?php echo $row->amount; ?></td>
												<td><?php echo $row->approved_amount; ?></td>
												<td>
													<?php
														echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
													?>
												</td>
												<td>
													<?php
													if($row->status == 1 && $row->utr_no == null){

														echo '<button type="button" class="btn-warning btn-sm utr" value="'.$row->id.'" data-toggle="modal" data-target="#utrModal">Pending</button>';
													}elseif($row->status == 1 && $row->utr_no != null){
														echo '<button type="button" class="btn-success btn-sm utr" value="'.$row->id.'" data-toggle="modal" data-target="#utrModal">'.$row->utr_no.'</button>';
													}else{
														echo '--';
													}
													?>
												</td>	
												<td class="text-center">												

													<?php
													if($row->status == 1){
														echo '<button type="button" class="'.$accept_cls.' btn-sm">'.$accept_status.'</button>';
														?>
														<!-- <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('bank_payments/add?type=po_payment&id='.$row->id); ?>">Pay File</a> -->
														<?php
													}	
													if(empty($can_delete)){

														if(check_permission_page(40,'delete')){
															?>
															<a href="<?php echo admin_url('purchase/delete_purchasepayment/'.$row->id); ?>" class="btn btn-danger _delete" ><i class="fa fa-trash" aria-hidden="true"></i></a>
															<?php
															}else{
																//echo '--';
															}

														
													}else{
														//echo '--';
													}
                                                    ?>
													
												</td>
												
											</tr>
											<?php
										}
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>


													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
							
							
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
       	<div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<div id="utrModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Payment UTR Details</h4>
      </div>
      <div class="modal-body">
       	<div id="utr_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<?php init_tail(); ?>
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
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
	$(document).on('change', '#branch_id', function(){	
		$("#attendance_form").submit();	
	});
	
	$(document).on('change', '#month', function(){	
		$("#attendance_form").submit();	
	});
</script> 


<script type="text/javascript">
	$(document).on('click', '.pay_all', function(){	
		if (! $("input[name='staffid[]']").is(":checked")){
		   alert('Please Check Any Checkbox First!');
		   return false;
		}else{
			$("#salary_form").submit();	
		}
	
	});	
</script> 


<script type="text/javascript">
	$('.status').click(function(){
	var pay_id = $(this).val();
	
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/get_purchasePayment_approval_info'); ?>",
			data    : {'pay_id' : pay_id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script> 

<script type="text/javascript">
	$('.utr').click(function(){
	var id = $(this).val();
	
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/update_utr_html'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ''){
					$("#utr_html").html(response);
					$('.date_picker').datepicker();
				}
			}
		})
	});
</script> 

<script type="text/javascript">
      $(".myselect").select2();
</script>

</body>
</html>

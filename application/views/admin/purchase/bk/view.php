<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; if(check_permission_page(86,'create')){ ?> <a href="<?php echo admin_url('purchase/purchase_order'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Create Purchase Order</a><?php } ?></h4>

					<hr class="hr-panel-heading">
					
					<div class="row">

						<div class="form-group col-md-4">
                            <label for="vendor_id" class="control-label">Select Vendor</label>
                            <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                <option value=""></option>
                                <?php
                                if (isset($vendors_info) && count($vendors_info) > 0) {
                                    foreach ($vendors_info as $vendor_value) {
                                        ?>
                                        <option value="<?php echo $vendor_value['id']; ?>" <?php if(!empty($vendor_id) && $vendor_id == $vendor_value['id']){ echo 'selected'; } ?>><?php echo $vendor_value['name'] ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
					
						<div class="form-group col-md-2">
                            <label for="status" class="control-label">Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                                <option value=""></option>
                                <option value="0" <?php if(isset($s_status) && $s_status == 0){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(isset($s_status) && $s_status == 1){ echo 'selected'; } ?>>Approved</option>
                                <option value="2" <?php if(isset($s_status) && $s_status == 2){ echo 'selected'; } ?>>Rejected</option>
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

						<div class="form-group col-md-2">
                            <label for="mr_status" class="control-label">Material Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="mr_status">
                                <option value=""></option>                                
                                <option value="1" <?php if(isset($mr_status) && $mr_status == 1){ echo 'selected'; } ?>>Material Received</option>
                                <option value="0" <?php if(isset($mr_status) && $mr_status == 0){ echo 'selected'; } ?>>Material Not Received</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="invoice_status" class="control-label">Invoice Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="invoice_status">
                                <option value=""></option>
                                <option value="1" <?php if(isset($invoice_status) && $invoice_status == 1){ echo 'selected'; } ?>>Invoice Received</option>
                                <option value="0" <?php if(isset($invoice_status) && $invoice_status == 0){ echo 'selected'; } ?>>Invoice Not Received</option>
                            </select>
                        </div>
						
						<div class="form-group col-md-2 float-right">
							<button class="form-control btn-info" type="submit" style="margin-top: 25px;">Search</button>
						</div>


						<div class="col-md-12">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Number</th>
										<th>Vendor</th>
										<th>Warehouse</th>
										<th>Date</th>
										<th>Total Amount</th>
										<th>Status</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($purchaseorder_list)){
										$z=1;
										foreach($purchaseorder_list as $row){	

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

											$can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and (approve_status = 1 || approve_status = 2) ")->row_array();
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo 'PO-'.$row->number;?></td>
												<td><?php echo value_by_id('tblvendor',$row->vendor_id,'name');?></td>
												<td><?php echo value_by_id('tblwarehouse',$row->warehouse_id,'name');?></td>
												<td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
												<td><?php echo $row->totalamount;?></td>
												<td>
													<?php
													if($row->cancel == 1){
														echo '<button disabled class="btn btn-danger">Cancelled</button>';
													}else{
														echo '<button type="button" class="btn '.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
														
													}
													?>
												</td>	
												<td class="">
													<a class="btn btn-info" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>">View</a>
													

													<?php 
													if($row->cancel == 0){

													if(empty($can_edit)){

														if($row->save == 1){
															echo '<a class="btn btn-info" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'">Send Approval</a>';
														}else{
															if(check_permission_page(86,'edit')){
															echo '<a class="btn btn-info" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
															}else{
																echo '--';
															}
														}

														
													}
													?>

													<?php echo '<button type="button" class="btn btn-info btn-sm uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal">Uploads</button>'; ?>

													<div class="btn-group pull-right">
                                                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                            	<?php
                                                            	if($row->save == 0){
                                                            	?>
                                                            	<a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                            	<?php
                                                            	}
                                                            	?>
                                                               
                                                               <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/cancelpo/'.$row->id);?>" data-status="1">CANCEL</a>	
															   <?php
																if((check_permission_page(86,'delete')) && (empty($can_edit))){
																	?>
																	<a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletepo/'.$row->id);?>" data-status="1">DELETE</a>	
																<?php
																}
																
																if($row->status == 1){
																	?>
																	<a target="_blank" href="<?php echo admin_url('purchase/purchaseorder_renewal/'.$row->id);?>" data-status="1">RENEWAL</a>	
																<?php
																}
																?>
                                                            </li>
                                                         </ul>
                                                    </div>

                                                    <?php
                                                	}
                                                    ?>
													
												</td>
												
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
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


<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('purchase/po_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                </div>
                
                <input type="hidden" id="po_id" name="po_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>  
        </form>

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
	var po_id = $(this).val();
	
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
			data    : {'po_id' : po_id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script> 

<script type="text/javascript">
$(document).on('click', '.uplaods', function() {  

    var id = $(this).val();
    $('#po_id').val(id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/purchase/get_po_uploads_data'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#upload_data').html(response);  
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

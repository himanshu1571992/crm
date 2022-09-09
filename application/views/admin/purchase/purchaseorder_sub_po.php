<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style type="text/css">
    .button3 {background-color: #800000;}
</style>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?></h4>
                        </div>
                    </div>

					<hr class="hr-panel-heading">
					
					<div class="row">
					

						<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Number</th>
										<th>Vendor</th>
										<th>Warehouse/Site</th>
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
                    					$ttl_amt=0;
										foreach($purchaseorder_list as $row){	
                       					$ttl_amt += $row->totalamount;

											if($row->status == 0){
												$status = 'Pending';
												$cls = 'btn-warning';
											}elseif($row->status == 1){
												$status = 'Approved';
												$cls = 'btn-success';
											}elseif($row->status == 2){
												$status = 'Rejected';
												$cls = 'btn-danger';
											}elseif($row->status == 4){
												$status = 'Reconciliation';
												$cls = 'btn-danger button3';
											}

											$can_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and (approve_status = 1 || approve_status = 2) ")->row_array();

											$recon_edit = $this->db->query("SELECT * from tblpurchaseorderapproval where po_id = '".$row->id."' and approve_status = 4 ")->row_array();
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo 'PO-'.$row->number;?></td>
												<td><?php echo cc(value_by_id('tblvendor',$row->vendor_id,'name'));?></td>
												<td>
                                                <?php 
                                                if($row->source_type ==1) {
                                                    echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));
                                                }else{
                                                    echo cc(value_by_id('tblsitemanager',$row->site_id,'name'));
                                                } 
                                                ?>                                                    
                                                </td>
												<td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
												<td><?php echo $row->totalamount;?></td>
												<td>
													<?php
													if($row->cancel == 1){
														echo '<button disabled class="btn-sm btn-danger">Cancelled</button>';
													}elseif($row->revised == 1){
                                                        echo '<button disabled class="btn-sm btn-info">Revised</button>';
                                                    }else{
														echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#myModal">'.$status.'</button>';
														
													}
													?>
												</td>	
												<td class="text-center">
													<a class="tableBtn" title="View" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_view/'.$row->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>
													

													<?php 
													if($row->cancel == 0){

													if(empty($can_edit)){

														if($row->save == 1){
															echo '<a class="tableBtn" title="Send Approval" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-paper-plane" aria-hidden="true"></i></a>';
														}else{
															if(check_permission_page(40,'edit')){
															echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
															}else{
																echo '--';
															}
														}

														
													}
													else
                                                    {
                                                        if(!empty($recon_edit))
                                                        {
                                                          if(check_permission_page(40,'edit')){
                                                            echo '<a class="tableBtn" title="Edit" target="_blank" href="'.admin_url('purchase/purchase_order/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
                                                            }  
                                                        }

                                                    }
													?>

													<?php echo '<button type="button" title="Uplaod" class="tableBtn uplaods" value="'.$row->id.'" data-toggle="modal" data-target="#upload_modal"><i class="fa fa-upload" aria-hidden="true"></i></button>'; ?>

													<div class="btn-group">
                                                         <button type="button" class="tableBtn dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                            	<?php
                                                            	//if($row->save == 0){
                                                            	?>
                                                            	<a  title="View" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
                                                            	<?php
                                                            	//}
                                                            
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
                                    <tfoot>
                                          <tr>
                                              <td align="" colspan="5">Total</td>
                                              <td align=""><b><?php  echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
                                              <td align="center" colspan="3"></td>
                                          </tr>
                                    </tfoot>
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

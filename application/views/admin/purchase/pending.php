<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase/pending_purchaseorder'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?> </h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <?php if(check_permission_page(40,'create')){ ?><a href="<?php  echo admin_url('purchase/purchase_order'); ?>" class="btn btn-info">Add Purchase Order</a><?php } ?>
                        </div>
                    </div>	

					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<!-- <div class="form-group col-md-3">
                            <label for="status" class="control-label">Lead Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                                <option value=""></option>
                                <option value="0" <?php if(!empty($s_status) && $s_status == 0){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(!empty($s_status) && $s_status == 1){ echo 'selected'; } ?>>Approved</option>
                            </select>
                        </div> -->
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ' '; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ' '; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>


						<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Number</th>
										<th>Vendor</th>
										<th>Warehouse</th>
										<th>Date</th>
										<th>Total Amount</th>
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
											}elseif($row->status == 1){
												$status = 'Approved';
											}

											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo 'PO-'.$row->number;?></td>
												<td><?php echo value_by_id('tblvendor',$row->vendor_id,'name');?></td>
												<td><?php echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name'));?></td>
												<td><?php echo date('d/m/Y',strtotime($row->date)); ?></td>
												<td><?php echo $row->totalamount;?></td>
												<td>
													<a class="btn btn-info" target="_blank" href="<?php  echo admin_url('purchase/purchaseorder_details/'.$row->id); ?>">View</a>
													<a class="btn btn-info" target="_blank" href="<?php  echo admin_url('purchase/download_pdf/'.$row->id); ?>">PDF</a>
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
        
    } );
} );
</script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

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
      $(".myselect").select2();
</script>

</body>
</html>

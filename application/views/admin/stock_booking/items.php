<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('stock_booking'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Stock Booking Items</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						
						<?php
						if($release == 1){
						?>
							<div class="form-group col-md-3 float-right">
								<a href="<?php  echo admin_url('stock_booking/release/'.$booking_info->id); ?>" class="btn btn-info mright5 test pull-left display-block">Release Stock</a>
							</div>
						<?php	
						}
						?>
						


													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
						<div class="row">
						
							
	                            <div class="col-md-12">																
									<table class="table">
										<thead>
										  <tr>
											<th>S.No</th>
											<th>Booking ID</th>
											<th>Product Name</th>											
											<th>Booked Qty</th>
											<th>Released Qty</th>
											<th>Balanced Qty</th>
											<th>Remark</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											if(!empty($items_info)){
												foreach ($items_info as $key => $value) {

													$booking_id = 'BOOK-'.number_series($value->booking_id);

													?>
													<tr>
														<td><?php echo ++$key; ?></td>
														<td><?php echo $booking_id; ?></td>
														<td><?php echo value_by_id('tblproducts',$value->product_id,'name'); ?></td>
														<td><?php echo $value->quantity; ?></td>
														<td><?php echo $value->released_qty; ?></td>
														<td><?php echo $value->balanced_qty; ?></td>
														<td><?php echo $value->remark; ?></td>
													</tr>
													<?php
												}
											}
											?>
												
										</tbody>

									</table>
	                           
	                        </div>
                        </div>		


							
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

<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

           <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'salary-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin"><?php echo $title; if(!empty($item_list)){ ?> <a href="<?php echo admin_url('bill_of_material/download_pdf'); ?>" target="_blank" class="btn btn-info pull-right" style="margin-top:-6px;">Download PDF</a> <?php } ?></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
					<?php
					if(!empty($item_list)){
						?>
						<input type="hidden" value="<?php echo $item_list[0]->warehouse_id; ?>" id="warehouse_id" name="">
						<input type="hidden" value="<?php echo $item_list[0]->service_type; ?>" id="service_type" name="">
						<?php
					}
					?>
										
						<div class="form-group col-md-4">
							<label for="category_id" class="control-label">Item Categories *</label>
							<select class="form-control" id="category_id" required="" name="category_id">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($category_info)){
									foreach($category_info as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if(!empty($s_category) && $s_category == $row->id){ echo 'selected';} ?>  ><?php echo $row->name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>


						<div class="form-group col-md-6">
							<button style="margin-top: 28px;" type="submit" class="btn btn-info">Search</button>
						</div>
													
					</div>
					 <?php echo form_close(); ?>

					 <form onsubmit="return confirm('Do You Really Want to Send Cutting Requirement?');" action="<?php echo admin_url('bill_of_material/add_requirement');?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">

					  <div class="col-md-12">																
								<table class="table ui-table">
									<thead>
									  <tr>
										<th>S.No</th>
										<th>Item Name</th>
										<!-- <th>Category</th> -->
										<th>Required Qty</th>
										<th>Available Qty</th>
										<th>Booked Qty</th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($item_list)){
										$z=1;
										foreach($item_list as $row){
											

											?>
																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo value_by_id('tblproducts',$row->pro_id,'name').product_code($row->pro_id); ?></td>	
												<td><?php echo $row->req_qty; ?></td>						
												<td><?php echo $row->avail_qty; ?></td>						
												<?php
												if($row->booked_qty > 0){
												?>
													<td><button type="button" data-toggle="modal" data-target="#myModal" value="<?php echo $row->pro_id; ?>"  class="btn btn-info product_id"><?php echo $row->booked_qty; ?></button></td>
												<?php
												}else{
												?>
													<td><?php echo $row->booked_qty; ?></td>
												<?php	
												}
												?>
												
												<!-- <td>
													<?php
													if(($row->category_id == 5) && ($row->req_qty > $row->avail_qty)){
														$final_qty = ($row->req_qty - $row->avail_qty);
														?>
														<input type="text1" size="2" value="<?php echo $final_qty; ?>" name="req_qty<?php echo $row->pro_id; ?>">
														<input type="checkbox" checked value="<?php echo $row->pro_id; ?>" name="product_id[]">														
														<?php
													}else{
														echo '--';
													}
													?>
												</td> -->						
											</tr>	
												
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="5"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>
							 <!-- <div class="btn-bottom-toolbar text-right">
	                            <button class="btn btn-info" type="submit">Add Cutting Requirement</button>
	                        </div> -->
							</form>
							
                        </div>
                       
                    </div>
                </div>
                         
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
        <h4 class="modal-title">Booked Stock</h4>
      </div>
      <div class="modal-body" id="booked_div">
        <p>Some text in the modal.</p>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php init_tail(); ?>


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
	
		var retVal = confirm("Do you want to continue ?");
		if( retVal == true ){
		  if (! $("input[name='staffid[]']").is(":checked")){
			   alert('Please Check Any Checkbox First!');
			   return false;
			}else{
				$("#salary_form").submit();	
			}
	   }
  		
	});	
</script> 

<script>
$(document).ready(function () {
    $("#ckbCheckAll").click(function () {
        $(".checkBoxClass").prop('checked', $(this).prop('checked'));
    });
    
    $(".checkBoxClass").change(function(){
        if (!$(this).prop("checked")){
            $("#ckbCheckAll").prop("checked",false);
        }
    });
});
</script>


<script type="text/javascript">
	
	$(document).on('click', '.product_id', function() { 	

		var product_id = $(this).val();
		var service_type = $("#service_type").val();
		var warehouse_id = $("#warehouse_id").val();

		$.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/bill_of_material/get_booked_items'); ?>",
            data    : {'product_id' : product_id, 'service_type' : service_type, 'warehouse_id' : warehouse_id},
            success : function(response){
                if(response != ''){                   
                     $('#booked_div').html(response);  
                }
            }
        })
	});
</script>

</body>
</html>

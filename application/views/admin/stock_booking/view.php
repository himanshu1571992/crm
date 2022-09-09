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

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('stock_booking'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Stock Booking Report</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-6">
							<label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> </label>
							<select class="form-control selectpicker" data-live-search="true" id="staff_id" name="staff_id">
								<option value=""></option>
								<?php
								if(!empty($staff_list)){
									foreach($staff_list as $row){
										?>
										<option value="<?php echo $row->staffid;?>" <?php if($s_staff_id == $row->staffid){ echo 'selected'; } ?> ><?php echo cc($row->firstname); ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-6">
							<label for="item_id" class="control-label">Select Items</label>
							 <select class="form-control selectpicker" data-live-search="true" name="item_id">
                                <option value=""></option>
                                <?php
                                if (isset($item_data) && count($item_data) > 0) {
                                    foreach ($item_data as $item_value) {
										
                                        ?>
                                        <option value="<?php echo $item_value['id'] ?>" <?php if($s_item_id == $item_value['id']){ echo 'selected'; } ?>><?php echo $item_value['name']; ?></option>
							<?php
                                    }
                                }
                                ?>
                            </select>
						</div>

						
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="from_date" class="form-control datepicker" value="<?php if(!empty($s_from_date)){ echo $s_from_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="to_date" class="form-control datepicker" value="<?php if(!empty($s_to_date)){ echo $s_to_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" value="print" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
						<div class="row">
						
							
	                            <div class="col-md-12 table-responsive">																
									<table class="table ui-table">
										<thead>
										  <tr>
											<th>S.No</th>
											<th>Employee Name</th>
											<th>Booking For</th>
											<th>Warehouse</th>
											<th>Remark</th>
											<th>Date</th>
											<th>Items</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											if(!empty($booking_info)){
												foreach ($booking_info as $key => $value) {

													$service_type = '--';
													if($value->service_type == 1){
														$service_type = 'Rent';
													}elseif($value->service_type == 2){
														$service_type = 'Sale';
													}

													 $items_count = $this->db->query("SELECT COUNT(id) as ttl_items from tblstockbookingproducts where booking_id = '".$value->id."'  ")->row();


													?>
													<tr>
														<td><?php echo ++$key; ?></td>
														<td><?php echo cc(get_employee_name($value->staff_id)); ?></td>
														<td><?php echo cc($service_type); ?></td>
														<td><?php echo cc(value_by_id('tblwarehouse',$value->warehouse_id,'name')); ?></td>
														<td><?php echo cc($value->remark); ?></td>
														<td><?php echo date('d/m/Y',strtotime($value->date)); ?></td>
														<td><a href="<?php  echo admin_url('stock_booking/items/'.$value->id); ?>" class="btn btn-info display-block"><?php echo $items_count->ttl_items; ?></a></td>

													</tr>
													<?php
												}
											}else{
												echo '<td colspan="7" class="text-center"><h4>Record Not Found!</h4></td>';
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

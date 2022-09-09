<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('leaves/leave_report'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Employee Leave Report</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-4">
							<label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> </label>
							<select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
								<option value="" selected >--Select One-</option>
								<?php
								if(!empty($staff_list)){
									foreach($staff_list as $row){
										?>
										<option value="<?php echo $row->staffid;?>" <?php if($s_staff_id == $row->staffid){ echo 'selected'; } ?> ><?php echo $row->firstname; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="category_id" class="control-label">Leave Category </label>
							<select class="form-control" id="category_id" name="category_id">
								<option value="" selected >--Select One-</option>
								<?php
								if(!empty($leave_categories)){
									foreach($leave_categories as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if($s_category_id == $row->id){ echo 'selected'; } ?> ><?php echo $row->name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-4">
							<label for="status" class="control-label">Leave Status </label>
							<select class="form-control" id="status" name="status">
								<option value="" selected >--Select One-</option>
								<option value="3" <?php if($s_status == 3){ echo 'selected'; } ?> >Pending</option>
								<option value="1" <?php if($s_status == 1){ echo 'selected'; } ?> >Approve</option>
								<option value="2" <?php if($s_status == 2){ echo 'selected'; } ?> >Rejected</option>								
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
                        <button type="submit" value="print" style="margin-top: 26px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                        </div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
						<div class="row">
	                            <div class="col-md-12 table-responsive">																
									<table class="table" id="newtable">
										<thead>
										  <tr>
											<th>S.No</th>
											<th>Employee Name</th>
											<th>Category</th>
											<th>Leave Date</th>
											<th>Days</th>
											<th>Status</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											if(!empty($leave_info)){
												foreach ($leave_info as $key => $value) {

													$status = '--';
													if($value->approved_status == 0){
														$status = 'Pending';
													}elseif($value->approved_status == 1){
														$status = 'Approved';
													}elseif($value->approved_status == 2){
														$status = 'Rejected';
													}



													?>
													<tr>
														<td><?php echo ++$key; ?></td>
														<td><?php echo get_employee_name($value->addedfrom); ?></td>
														<td><?php echo value_by_id('tblleavescategories',$value->category,'name'); ?></td>
														<td><?php echo $value->from_date.' to '.$value->to_date; ?></td>
														<td><?php echo $value->total_days; ?></td>
														<td><?php echo $status; ?></td>
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

<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('salary/advance_salary_report'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Advance Salary Report</h4>
					<hr class="hr-panel-heading">

					<div class="row">

						<div class="form-group col-md-4">
							<label for="staff_id" class="control-label"><?php echo 'Employee Name'; ?> *</label>
              <select class="form-control selectpicker" data-live-search="true" id="staff_id" name="staff_id">
								<option value="" disabled selected >--Select One-</option>
								<?php
								if(!empty($staff_list)){
									foreach($staff_list as $row){
										?>
										<option value="<?php echo $row->staffid;?>" <?php if($s_staff == $row->staffid){ echo 'selected'; }?> ><?php echo $row->firstname; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>

						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>

						<div class="col-md-1">
                        <button type="submit" style="margin-top: 24px;" value="print" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>





						<div class="col-md-12 table-responsive">
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Employee Name</th>
										<th>Date</th>
										<th>Amount</th>
										<th>Reason</th>
										<th>Status</th>

									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($advance_salary_info)){
										$z=1;
										foreach($advance_salary_info as $staff){

											?>
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo get_employee_name($staff->addedfrom);?></td>
												<td><?php echo date('d/m/Y',strtotime($staff->date)); ?></td>
												<td><?php echo $staff->approved_amount; ?></td>
												<td><?php echo $staff->reason; ?></td>
												<td><?php echo ($staff->is_taken == 1) ? '<span class="text-success">Paid</span>' : '<span class="text-danger">Unpaid</span>'; ?></td>

											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found</h5></td></tr>';
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

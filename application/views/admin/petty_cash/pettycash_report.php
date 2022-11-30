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

    	.company-title {
		text-transform: uppercase;
		font-weight: 600;
		letter-spacing: 1.5px;
		color: rgb(39, 39, 39);
		font-size: 23px;
	}
	
	.sec-title {
		position: relative;
		z-index: 1;
		margin-bottom:40px;
	}
	.separator {
		margin: 0 auto !important;
		float: none !important;
		width: 40px;
		position: relative;
	}
	.separator span {
		position: absolute;
		left: 50%;
		top: -2px;
		width: 10px;
		height: 5px;
		margin-left: -5px;
		display: inline-block;
		background-color:#2e2e2e;
	}
	
	.separator:before {
		position: absolute;
		content: '';
		left: 0px;
		top: 0px;
		width: 10px;
		height: 2px;
		background-color: rgb(241, 106, 46);
	}
	
	.separator:after {
		position: absolute;
		content: '';
		right: 0px;
		top: 0px;
		width: 10px;
		height: 2px;
		background-color: rgb(241, 106, 46);
	}

</style>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('petty_cash/reports'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Petty Cash Report</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-3">
							<label for="pettycash_id" class="control-label">Petty Cash Department </label>
							<select class="form-control" required="" id="pettycash_id" name="pettycash_id">
								<option value="" selected >--Select One--</option>
								<?php
								if(!empty($pettycash_info)){
									foreach($pettycash_info as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if($s_pettycash_id == $row->id){ echo 'selected'; } ?> ><?php echo $row->department_name; ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="from_date" class="form-control datepicker" value="<?php if(!empty($s_from_date)){ echo $s_from_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" name="to_date" class="form-control datepicker" value="<?php if(!empty($s_to_date)){ echo $s_to_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" value="print" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>
													
					</div>
					
					 <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                       
					 
					 <?php
					 if(!empty($pettycash_log)){
					 	?>
					 	<div class="sec-title">
							<h3 class="text-center company-title"><?php echo value_by_id('tblpettycashmaster',$s_pettycash_id,'department_name').' ('.value_by_id('tblpettycashmaster',$s_pettycash_id,'amount').')'; ?></h3>
							<div class="separator"><span></span></div>
						</div>
					 	<?php
					 }
					 ?>
					 

						<div class="row">
	                            <div class="col-md-12 table-responsive">																
									<table class="table" id="newtable">
										<thead>
										  <tr>
											<th>S.No</th>
											<th>Manager Name</th>
											<th>Approved By</th>
											<th>Ref Id</th>
											<th>Req Date</th>
											<th>Person Name</th>
											<th>Resone</th>
											<th>Date</th>
											<th>Debit</th>
											<th>Credit</th>
											<th>Balance</th>
										  </tr>
										</thead>
										<tbody>
											<?php
											if(!empty($pettycash_log)){
												foreach ($pettycash_log as $key => $row) {

													$approve_by = 0;
													if($row->type == 1 && $row->by_transfer == 0){
							                            $request_info  = $this->db->query("SELECT * FROM tblpettycashrequest WHERE  id = '".$row->request_id."' ")->row();

							                            $req_date = _d($request_info->date);
							                            $reference_id = 'REQ-PETTY-'.number_series($request_info->id);
							                            $staff_name = 'Self'; 

							                            $cash_received = '';
							                            if($request_info->cash_received == 1){
							                            	$cash_received  = '<br><span style="color:red;">(Cash Received)</span>';
							                            }  

							                            if($row->request_id > 0){
							                            	$reason = $request_info->reason;  
							                            }else{
							                            	$reason = $row->remark;
							                            }
							                              

							                            $approval_info  = $this->db->query("SELECT * FROM tblpettycashrequestapproval WHERE  pettycash_id = '".$row->request_id."' and approve_status = 1 ")->row(); 
							                            if(!empty($approval_info)){
							                            	$approve_by = $approval_info->staff_id;
							                            }                    
							                        }else{
							                            $request_info  = $this->db->query("SELECT * FROM tblrequests WHERE  id = '".$row->request_id."' ")->row();

							                            $req_date = _d($request_info->date);
							                            $cat = get_last(get_request_category($request_info->category));       
							                            $reference_id = 'REQ-'.get_short($cat).'-'.number_series($request_info->id);
							                            $staff_name = get_employee_name($request_info->addedfrom);

							                            $reason = $request_info->reason;

							                            $approval_info  = $this->db->query("SELECT * FROM tblrequestapproval WHERE  request_id = '".$row->request_id."' and approve_status = 1 ")->row(); 
							                            if(!empty($approval_info)){
							                            	$approve_by = $approval_info->staff_id;
							                            }
							                            $cash_received = '';
							                        }

							                        /*if($row->type == 1){
							                        	$balance = ($balance+$row->amount);
							                        }else{
							                        	$balance = ($balance-$row->amount);
							                        }*/
							                        
													?>
													<tr>
														<td><?php echo ++$key; ?></td>
														<td><?php echo get_employee_name($row->manager_id); ?></td>
														<td><?php echo get_employee_name($approve_by); ?></td>
														<td><?php echo $reference_id; ?> <?php echo (!empty($cash_received)) ? $cash_received : '';?></td>
														<td><?php echo $req_date; ?></td>
														<td><?php echo $staff_name; ?></td>
														<td><?php echo $reason; ?></td>
														<td><?php echo date('d-m-Y H:i a',strtotime($row->date_time)); ?></td>
														<td style="color: #E62231"><?php echo ($row->type == 2) ? $row->amount : '--'; ?></td>
														<td style="color: #1DAB24"><?php echo ($row->type == 1) ? $row->amount : '--'; ?></td>
														<td><?php echo $row->balance; ?></td>
														
													</tr>
													<?php
												}
											}else{
		                                        echo '<tr><td class="text-center" colspan="11"><h5>Record Not Found</h5></td></tr>';
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


<!-- <script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
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
</script> -->

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
            // {
            //     extend: 'pdf',
            //     exportOptions: {
            //          columns: ':visible'
            //     }
            // },
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

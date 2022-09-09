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

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin">Manage Wallet</h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="row">
						
											
						 <div class="form-group col-md-4" app-field-wrapper="date">
							<label for="from_date" class="control-label"><?php echo 'From Date' ?></label>
								<div class="input-group date">
									<input id="from_date" name="from_date" required class="form-control datepicker" value="<?php echo (isset($from_date) && $from_date != "") ? $from_date : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>		
							</div>
							
						<div class="form-group col-md-4" app-field-wrapper="date">
							<label for="to_date" class="control-label"><?php echo 'To Date' ?></label>
								<div class="input-group date">
									<input id="to_date" name="to_date" required class="form-control datepicker" value="<?php echo (isset($to_date) && $to_date != "") ? $to_date : "" ?>" aria-invalid="false" type="text" ><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
								</div>		
							</div>	
							
						<div class="form-group col-md-3">	
							<button type="submit" class="btn btn-info"><?php echo 'Search'; ?></button>
						</div>
						
						</div>
					
																					
					</div>
					
                        <div class="row">
						
							
                            <div class="col-md-12">																
								<table class="table ui-table">
									<thead>
									  <tr>
										<th>S.No</th>
										<th>Employee Name</th>
										<th>Wallet Amount</th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($staff_list)){
										$z=1;
										
										$year = date('Y');
										$c_day = date('d');
										$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
										foreach($staff_list as $staff){
											
											
											$wallet_amount = wallet_amount($staff->staffid,$from_date,$to_date);
											?>
																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo $staff->firstname;?></td>
												<td><button type="button" value="<?php echo $staff->staffid;?>" class="actionBtn btn-sm view" data-toggle="modal" data-target="#myModal"><?php echo $wallet_amount;?></button></td>
												
												
												
												
											</tr>
											<?php
										}
									}elseif(!empty($staff_info)){
										$z=1;
										
										$year = date('Y');
										$c_day = date('d');
										$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
								
											
											
											$wallet_amount = wallet_amount($staff_info->staffid,$from_date,$to_date);
											?>
																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo $staff_info->firstname;?></td>
												<td><button type="button" value="<?php echo $staff_info->staffid;?>" class="btn btn-info btn-sm view" data-toggle="modal" data-target="#myModal"><?php echo $wallet_amount;?></button></td>
												
												
												
												
											</tr>
											<?php
									}else{
										echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
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
             
            <?php echo form_close(); ?>
		</div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>



<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Wallet Details</h4>
      </div>
      <div class="modal-body">
        <div id="wallet_div"></div>
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
	$('.view').click(function(){
	var staff_id = $(this).val();
	var from_date = $("#from_date").val();
	var to_date = $("#to_date").val();
	
		 $.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/wallet/get_wallet_details'); ?>",
			data    : {'staff_id' : staff_id, 'from_date' : from_date, 'to_date' : to_date},
			success : function(response){
				if(response != ""){
					
					$('#wallet_div').html(response);
				}
			}
		})
	});
</script> 

</body>
</html>

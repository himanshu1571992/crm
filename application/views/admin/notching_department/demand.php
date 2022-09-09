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

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('notching_department/demand'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                	<h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
					
					<div class="row">

								
						<div class="form-group col-md-2">
                            <label for="approve_status" class="control-label">Approval Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="approve_status">
                                <option value=""></option>
                                <option value="1" <?php if(!empty($s_approve_status) && $s_approve_status == 1){ echo 'selected'; } ?>>Pending</option>
                                <option value="2" <?php if(!empty($s_approve_status) && $s_approve_status == 2){ echo 'selected'; } ?>>Approved</option>
                                <option value="3" <?php if(!empty($s_approve_status) && $s_approve_status == 3){ echo 'selected'; } ?>>Rejected</option>
                            </select>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="confirmation_status" class="control-label">Confirmation Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="confirmation_status">
                                <option value=""></option>
                                <option value="1" <?php if(!empty($s_confirmation_status) && $s_confirmation_status == 1){ echo 'selected'; } ?>>Pending</option>
                                <option value="2" <?php if(!empty($s_confirmation_status) && $s_confirmation_status == 2){ echo 'selected'; } ?>>Received</option>
                                <option value="3" <?php if(!empty($s_confirmation_status) && $s_confirmation_status == 3){ echo 'selected'; } ?>>Not Received</option>
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
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>

                        <div class="col-md-12 table-responsive">																
                        <table class="table ui-table">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th># ID</th>
										<th>Department</th>
										<th>Date</th>
										<th>Comfirmation</th>		
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($demand_list)){
										$z=1;
										foreach($demand_list as $row){	

											if($row->approve_status == 1){
												$approve_status = 'Pending';
												$cls = 'btn-warning';
											}elseif($row->approve_status == 2){
												$approve_status = 'Approved';
												$cls = 'btn-success';
											}elseif($row->approve_status == 3){
												$approve_status = 'Rejected';
												$cls = 'btn-danger';
											}

											if($row->confirmation_status == 1){
												$confirmation_status = 'Pending';
												$ccls = 'text-warning';
											}elseif($row->confirmation_status == 2){
												$confirmation_status = 'Received';
												$ccls = 'text-success';
											}elseif($row->confirmation_status == 3){
												$confirmation_status = 'Not Received';
												$ccls = 'text-danger';
											}

											
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo 'REQ-'.str_pad($row->id, 4, '0', STR_PAD_LEFT);?></td>	
												<td><?php echo cc(value_by_id('tblproduction_department',$row->from_department,'name')); ?></td>
												<td><?php echo _d($row->date);?></td>
												<td><?php echo '<p class="'.$ccls.'" >'.$confirmation_status.'</p>'; ?></td>
												<td><button type="button" class="btn <?php echo $cls; ?> btn-sm action" value="<?php echo $row->id; ?>" data-toggle="modal" data-target="#action_modal"><?php echo $approve_status; ?></button></td>											
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="6"><h5>Record Not Found</h5></td></tr>';
									}
									?>
									  
									 
									</tbody>
								  </table>
							</div>


													
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



<div id="action_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Demand Details</h4>
      </div>
      <div class="modal-body">
        
        <div id="confirmation_data">
            
        </div>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script type="text/javascript">
      $(".myselect").select2();
</script>



<script type="text/javascript">
$(document).on('click', '.action', function() {  

    var id = $(this).val();

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/notching_department/get_details'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#confirmation_data').html(response);  
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })

}); 
</script>

</body>
</html>

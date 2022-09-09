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

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('assembling_department_second'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
             
					<h4 class="no-margin"><?php echo $title; ?> <?php if(check_permission_page(207,'create')){ ?><a href="<?php echo admin_url('assembling_department_second/add_request'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Add Item Request</a><?php } ?></h4>
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
										<th>Approve Status</th>		
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($request_list)){
										$z=1;
										foreach($request_list as $row){	

											if($row->approve_status == 1){
												$approve_status = 'Pending';
												$cls = 'text-warning';
											}elseif($row->approve_status == 2){
												$approve_status = 'Approved';
												$cls = 'text-success';
											}elseif($row->approve_status == 3){
												$approve_status = 'Rejected';
												$cls = 'text-danger';
											}

											if($row->confirmation_status == 1){
												$confirmation_status = 'Pending';
												$ccls = 'btn-warning';
											}elseif($row->confirmation_status == 2){
												$confirmation_status = 'Received';
												$ccls = 'btn-success';
											}elseif($row->confirmation_status == 3){
												$confirmation_status = 'Not Received';
												$ccls = 'btn-danger';
											}

											
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo 'REQ-'.str_pad($row->id, 4, '0', STR_PAD_LEFT);?></td>	
												<td><?php echo cc(value_by_id('tblproduction_department',$row->department_id,'name')); ?></td>
												<td><?php echo _d($row->date);?></td>
												<td><?php echo '<p class="'.$cls.'" >'.$approve_status.'</p>'; ?></td>
												<td>
													<?php 
													if($row->approve_status == 2){
														echo '<button type="button" class="btn '.$ccls.' btn-sm confirm" value="'.$row->id.'" data-toggle="modal" data-target="#action_modal">'.$confirmation_status.'</button>';		
													}elseif($row->approve_status == 3){
														echo '<button type="button" class="btn btn-danger btn-sm confirm" value="'.$row->id.'" data-toggle="modal" data-target="#action_modal">Rejected</button>';
													}
													 

													if(check_permission_page(207,'delete')){ 
														if($row->approve_status == 1){
													?>
														<a class="btn btn-danger _delete" href="<?php  echo admin_url('assembling_department_second/delete_request/'.$row->id); ?>">Delete</a>
													<?php
														}
													}
													?>	
												</td>											
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
        <h4 class="modal-title upload_title">Request Details</h4>
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
$(document).on('click', '.confirm', function() {  

    var id = $(this).val();

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/assembling_department_second/get_confirmation_html'); ?>",
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

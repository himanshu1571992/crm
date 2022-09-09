<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
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

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('approval'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row">
                    	<div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>	
                    </div>                   

					<hr class="hr-panel-heading">
					
					<div class="row">

						<div class="form-group col-md-3">
                            <label for="module_id" class="control-label">Select Module</label>
                            <select class="form-control selectpicker" data-live-search="true" name="module_id">
                                <option value=""></option>
                                <option value="1" <?php if(!empty($s_module) && $s_module == 1){ echo 'selected'; } ?>>Stock</option>
                                <option value="2" <?php if(!empty($s_module) && $s_module == 2){ echo 'selected'; } ?>>Stock Transfer</option>
                                <option value="3" <?php if(!empty($s_module) && $s_module == 3){ echo 'selected'; } ?>>Purchase Order</option>
                                <option value="4" <?php if(!empty($s_module) && $s_module == 4){ echo 'selected'; } ?>>Material Receipt</option>
                                <option value="5" <?php if(!empty($s_module) && $s_module == 5){ echo 'selected'; } ?>>Manufacturing Stock 	</option>
                                <option value="5" <?php if(!empty($s_module) && $s_module == 6){ echo 'selected'; } ?>>TDS Reconciliation 	</option>
                            </select>
                        </div>
								
						<div class="form-group col-md-3">
                            <label for="status" class="control-label">Select Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                                <option value=""></option>
                                <option value="0" <?php if(!empty($s_status) && $s_status == 0){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(!empty($s_status) && $s_status == 1){ echo 'selected'; } ?>>Approved</option>
                                <option value="2" <?php if(!empty($s_status) && $s_status == 2){ echo 'selected'; } ?>>Rejected</option>
                            </select>
                        </div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
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
										<th>Module Name</th>										
										<th>Date</th>
										<th>Status</th>
										<th>Action</th>
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($approval_list)){
										$z=1;
										foreach($approval_list as $row){	

											if($row->status == 0){
												$status = 'Pending';
												$cls = 'btn-warning';
											}elseif($row->status == 1){
												$status = 'Approved';
												$cls = 'btn-success';
											}elseif($row->status == 2){
												$status = 'Rejected';
												$cls = 'btn-danger';
											}

											if($row->approve_status == 0){
												$user_status = 'Pending';
											}elseif($row->approve_status == 1){
												$user_status = 'Approved';
											}elseif($row->approve_status == 2){
												$user_status = 'Rejected';
											}

											$module = '--';
											if($row->module_id == 1){
												$module = 'Stock';
											}elseif($row->module_id == 2){
												$module = 'Stock Transfer';
											}elseif($row->module_id == 3){
												$module = 'Purchase Order';
											}elseif($row->module_id == 4){
												$module = 'Material Receipt';
											}elseif($row->module_id == 5){
												$module = 'Manufacturing Stock';
											}elseif($row->module_id == 6){
												$module = 'TDS Reconciliation';
											}

											
											?>																				
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo $module; ?></td>
												<td><?php echo _d($row->date);?></td>
												
												<td><?php echo '<button type="button" class="btn '.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#statusModal">'.$status.'</button>'; ?></td>
												<td>
													<?php 
													if($row->status == 0 && $row->approve_status == 0){
													?>
														<a class="btn btn-info" target="_blank" href="<?php  echo admin_url($row->link); ?>">Action</a>
													<?php	
													}else{
														echo $user_status;
													}
													?>
													
												</td>
												
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


<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approval Status</h4>
      </div>
      <div class="modal-body" id="approval_html">
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

<script type="text/javascript">
	$('.status').click(function(){
	var id = $(this).val();
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/approval/get_status'); ?>",
			data    : {'id' : id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
				}
			}
		})
	});
</script> 


<script type="text/javascript">
$(document).on('click', '.uplaods', function() {  

    var id = $(this).val();
    $('#mr_id').val(id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/purchase/get_mr_uploads_data'); ?>",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){       

                $('#upload_data').html(response);  
            }
        }
    })

}); 
</script>

</body>
</html>

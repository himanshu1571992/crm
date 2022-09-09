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

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('follow_up/lead_followup'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>	                   

					<hr class="hr-panel-heading">
					
					<div class="row">

						<div class="form-group col-md-3">
                            <label for="status" class="control-label">Lead Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status">
                                <option value=""></option>
                                <?php
                                if(!empty($status_info)){
                                	foreach ($status_info as $value) {
                                		?>
                                		<option value="<?php echo $value->id; ?>" <?php if(!empty($s_status) && $s_status == $value->id){ echo 'selected'; } ?>><?php echo cc($value->name); ?></option>
                                		<?php
                                	}
                                }
                                ?>
                            </select>
                        </div>
								
						<div class="form-group col-md-3">
                            <label for="type" class="control-label">Enquiry For</label>
                            <select class="form-control selectpicker" data-live-search="true" name="type">
                                <option value=""></option>
                                <option value="1" <?php if(!empty($s_type) && $s_type == 1){ echo 'selected'; } ?>>Rent</option>
                                <option value="2" <?php if(!empty($s_type) && $s_type == 2){ echo 'selected'; } ?>>Sale</option>
                                <option value="3" <?php if(!empty($s_type) && $s_type == 3){ echo 'selected'; } ?>>Both Rent & Sale</option>
                            </select>
                        </div>

						<div class="form-group col-md-3">
                            <label for="finished" class="control-label">Action</label>
                            <select class="form-control selectpicker" data-live-search="true" name="finished">
                                <option value=""></option>
                                <option value="0" <?php if(isset($s_finished) && $s_finished == 0){ echo 'selected'; } ?>>Pending</option>
                                <option value="1" <?php if(isset($s_finished) && $s_finished == 1){ echo 'selected'; } ?>>Finished</option>
                            </select>
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
										<th>Lead ID</th>										
										<th>Client Name</th>
										<th>Assigned To</th>
										<th>Lead Status</th>
										<th>Enquiry For</th>
										<th>Status</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($followup_info)){
										$z=1;
										foreach($followup_info as $row){	

											if($row->finished == 0){
												$status = 'Pending';
												$cls = 'text-warning';
											}elseif($row->finished == 1){
												$status = 'Finished';
												$cls = 'text-success';
											}

											$lead_info = $this->db->query("SELECT `leadno`,`client_branch_id`,`company` FROM `tblleads` where id = '".$row->lead_id."' ")->row_array();
											
											if(!empty($lead_info)){
												if($lead_info['client_branch_id'] > 0){
								                    $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$lead_info['client_branch_id']."' ")->row();
								                    $company = $client_info->client_branch_name;
								                }else{
								                    $company = $lead_info['company'];
								                }

								                $checked = ($row->finished == 1 ) ? 'checked' : '';
											    $followtoggleActive = '<div class="onoffswitch">
											        <input type="checkbox" data-switch-url="' . admin_url() . 'follow_up/acton_lead_followup" name="onoffswitch" class="onoffswitch-checkbox" id="' . $row->id . '" data-id="' . $row->id . '" ' . $checked . '>
											        <label class="onoffswitch-label" for="' . $row->id . '"></label>
											    </div>';

											    $employee_name = get_lead_assign_staff($row->lead_id);
											?>
											<tr>
												<td><?php echo $z++;?></td>
												<td>
													<a target="_blank" href="<?php echo admin_url('leads/lead_profile/'.$row->lead_id); ?>"><?php echo $lead_info['leadno']; ?></a><br>
													<a target="_blank" href="<?php echo admin_url('follow_up/lead_activity/'.$row->lead_id); ?>">Activity</a>
												</td>
												<td><?php echo cc($company);?></td>
												<td><?php echo cc($employee_name);?></td>
												<td><?php echo cc(value_by_id('tblenquirytypemaster',$row->status,'name'));?></td>
												<td><?php echo cc(value_by_id('tblenquiryformaster',$row->type,'name'));?></td>												
												<td><?php echo '<p class="'.$cls.'">'.$status.'</p>'; ?></td>
												<td><?php echo $followtoggleActive;  ?> </td>
												
											</tr>
											<?php	
											}
										}
									}else{
										echo '<tr><td class="text-center" colspan="7"><h5>Record Not Found</h5></td></tr>';
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

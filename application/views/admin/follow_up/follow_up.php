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

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('follow_up'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>	                   

					<hr class="hr-panel-heading">
					
					<div class="row">

						<!-- <div class="form-group col-md-3">
                            <label for="client_id" class="control-label">Client</label>
                            <select class="form-control selectpicker" data-live-search="true" name="client_id">
                                <option value=""></option>
                                <?php
                                if(!empty($client_info)){
                                	foreach ($client_info as $value) {
                                		?>
                                		<option value="<?php echo $value->userid; ?>" <?php if(!empty($s_client) && $s_client == $value->userid){ echo 'selected'; } ?>><?php echo $value->client_branch_name; ?></option>
                                		<?php
                                	}
                                }
                                ?>
                            </select>
                        </div> -->

                        <div class="col-md-4">
		                            <div class="form-group ">
		                                <label for="client_id" class="control-label">Select Client </label>
		                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
		                                    <option value="" disabled selected >--Select One-</option>
		                                    <?php
		                                    if(!empty($client_info)){
		                                    	foreach ($client_info as $value) {
		                                    		?>
		                                    		<option value="<?php echo $value->userid;?>" <?php if(!empty($client_id) && $client_id == $value->userid){ echo 'selected';} ?>  ><?php echo cc($value->company); ?></option>
		                                    		<?php
		                                    	}
		                                    }
		                                    ?>
		                                </select>
		                            </div>
		                     </div>

	                        <div class="col-md-4">
		                        <div class="form-group">
		                            <label for="client_branch" class="control-label">Select Client Branch <!-- <small class="req text-danger">* </small> --></label>
		                            <select class="form-control selectpicker" id="client_branch"  name="client_branch[]" multiple="" data-live-search="true">
		                                <option value="">--Select One-</option>
		                                <?php
		                                if(!empty($s_client_branch)){
		                                	foreach ($s_client_branch as $value) {
		                                		$branch_info = $this->db->query("SELECT * FROM tblclientbranch where userid = '".$value."' ")->row();
		                                		?>
		                                		<option value="<?php echo $branch_info->userid; ?>" selected><?php echo cc($branch_info->client_branch_name); ?></option>
		                                		<?php
		                                	}
		                                }
		                                ?>
		                               
		                               
		                            </select>
		                        </div>
	                        </div>

						<div class="form-group col-md-4">
                            <label for="status" class="control-label">Client Status</label>
                            <select class="form-control selectpicker" data-live-search="true" name="status[]" multiple="">
                                <option value="" disabled=""></option>
                                <?php
                                if(!empty($status_info)){
                                	foreach ($status_info as $value) {
                                		$selected = "";
                                		if(!empty($s_status)){
                                			if (in_array($value->id, $s_status)){
                                				$selected = "selected";
                                			}
                                		}
                                		?>	
                                		<option value="<?php echo $value->id; ?>" <?php echo $selected;  ?>><?php echo $value->name; ?></option>
                                		<?php
                                	}
                                }
                                ?>
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

                        <?php 
                        if(is_admin() == 1){
                        ?>
                        <div class="form-group col-md-3">
                            <label for="employee_id" class="control-label">Select Employee</label>
                            <select class="form-control selectpicker" data-live-search="true" name="employee_id">
                                <option value="">--Select One-</option>
                                <?php
                                if(!empty($employee_data)){
                                	foreach ($employee_data as $value) {
                                		?>
                                		<option value="<?php echo $value->staffid; ?>" <?php echo (!empty($employee_id) && $employee_id == $value->staffid) ? 'selected' : ''; ?>><?php echo cc($value->firstname); ?></option>
                                		<?php
                                	}
                                }
                                ?>
                            </select>
                        </div>

                        <div class="form-group col-md-3">
                            <label for="group_id" class="control-label">Select Group</label>
                            <select class="form-control selectpicker" data-live-search="true" name="group_id">
                                <option value="">--Select One-</option>
                                <?php
                                if(!empty($group_data)){
                                	foreach ($group_data as $value) {
                                		?>
                                		<option value="<?php echo $value->id; ?>" <?php echo (!empty($group_id) && $group_id == $value->id) ? 'selected' : ''; ?>><?php echo cc($value->name); ?></option>
                                		<?php
                                	}
                                }
                                ?>
                            </select>
                        </div>
                        <?php	
                        }
                        ?>
                        

						<div class="form-group col-md-1 float-right">
							<button class="form-control btn-info" type="submit" style="margin-top: 25px;">Search</button>
						</div>

						<div class="col-md-1">
                         <a style="margin-top: 25px;padding-bottom: 3px;"  class="btn btn-danger" href="">Reset</a>
                        </div>


						<div class="col-md-12 table-responsive">																
								<table class="table ui-table" id="datatable">
									<thead>
									  <tr>
										<th>S.No.</th>										
										<th>Client Name</th>
										<th>Client Status</th>
										<th>Client Type</th>
										<th>Contacts</th>										
										<th>Contact Parson</th>										
										<th>Contact Number</th>										
										<th>Status</th>
										<th>Assigned Details</th>
										<th>Action</th>
										<th>Balance</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									$ttl_balance=0;
									if(!empty($followup_info)){
										$z=1;
										foreach($followup_info as $row){	
											$bal_amt = client_balance_amt($row->client_id);
											$client_info = client_info($row->client_id);

											if($bal_amt > 1){
												$ttl_balance += $bal_amt;
												if($row->finished == 0){
													$status = 'Pending';
													$cls = 'text-warning';
												}elseif($row->finished == 1){
													$status = 'Finished';
													$cls = 'text-success';
												}

												$client_type = client_running_closed_sales_status($client_ids,$sales_client_ids,$row->client_id);

												$status_dtl = $this->db->query("SELECT * from `tblclientstatus` where id = '".$row->status."' ")->row_array();

												$outputType = '<span class="inline-block label label-' . (empty($status_dtl['color']) ? 'default': '') . '" style="color:' . $status_dtl['color'] . ';border:1px solid ' . $status_dtl['color'] . '">' . $status_dtl['name'];
		                                        $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
		                                        $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
		                                        $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
		                                        $outputType .= '</a>';

		                                        $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $row->id . '">';
		                                        foreach ($status_info as $status_row) {
		                                            if ($row->status != $status_row->id) {
		                                                $outputType .= '<li>
		                                              <a href="#" onclick="change_client_status(' . $status_row->id . ',' . $row->id . '); return false;">
		                                                 ' . cc($status_row->name) . '
		                                              </a>
		                                           </li>';
		                                            }
		                                        }
		                                        $outputType .= '</ul>';
		                                        $outputType .= '</div>';
		                                    	$outputType .= '</span>';

												$checked = ($row->finished == 1 ) ? 'checked' : '';
												    $followtoggleActive = '<div class="onoffswitch">
												        <input type="checkbox" data-switch-url="' . admin_url() . 'follow_up/action_payment_followup" name="onoffswitch" class="onoffswitch-checkbox" id="' . $row->id . '" data-id="' . $row->id . '" ' . $checked . '>
												        <label class="onoffswitch-label" for="' . $row->id . '"></label>
												    </div>';

												    $c_info = $this->db->query("SELECT `client_id` FROM tblclientbranch WHERE userid = '".$row->client_id."' ")->row();
												    $contactdata = $this->db->query("SELECT `firstname`,`phonenumber` FROM `tblcontacts` WHERE `userid` = '".$row->client_id."' and phonenumber > 0 AND contact_type = 1 group by phonenumber")->row();
												?>
												<tr>
													<td><?php echo $z++;?></td>
													<td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$c_info->client_id)?>" ><?php echo cc(get_company_name($row->client_id)); ?></a></td>
													<td><?php echo $outputType;?></td>	
													<td><?php echo $client_type;?></td>	
													<td ><a class="text-right" target="_blank" href="<?php echo base_url("admin/follow_up/payment_contact/".$row->client_id)?>" class="pull-right text-muted" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></a> <a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->client_id); ?>">Activity</a> </td>		
													<td ><?php echo (!empty($contactdata)) ? cc($contactdata->firstname) : '--'; ?></td>		
													<td ><?php echo (!empty($contactdata)) ? cc($contactdata->phonenumber) : '--'; ?></td>		
																				
													<td><?php echo '<p class="'.$cls.'">'.$status.'</p>'; ?></td>
													<td><?php 
							                        if(!empty($client_info->staff_group)){ 
							                            $group_arr = explode(',', $client_info->staff_group);
							                            $group_nams = '';
							                            foreach ($group_arr as $k => $group_id) {
							                                if($k == 0){
							                                    $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
							                                }else{
							                                    $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
							                                }                                
							                            }
							                            //echo '<button type="button" class="btn-info btn-sm show_group" value="'.$row->userid.'" data-toggle="modal" data-target="#myModal">'.$group_nams.'</button>';
							                            if(is_admin() == 1){
							                            	echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$client_info->userid).'" class="btn-sm btn-info pull-left display-block">'.$group_nams.'</a>';
							                            }else{
							                            	echo '--';
							                            }
							                            
							                        }else{
							                        	if(is_admin() == 1){
							                        		echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$client_info->userid).'" class="btn-sm btn-info pull-left display-block">Allot Group</a>';
							                            }else{
							                            	echo '--';
							                            }
							                          
							                        } 
							                        ?></td> 
													<td><?php echo $followtoggleActive;  ?> </td>
													<td><?php echo $bal_amt; ?></td>
													
												</tr>
												<?php	
											}
										}
										/*echo '<tr><td class="text-center" colspan="7"><h5>Total Balance</h5></td>
												 <td><h5>'.number_format($ttl_balance, 2, '.', '').'</h5></td>
											  </tr>';*/
									}
									?>
									  
									 
									</tbody>

									<tfoot>
                                          <tr>
                                              <td class="text-center" colspan="10"><h5>Total Balance</h5></td>
                                              <td align=""><h5><?php  echo number_format($ttl_balance, 2, '.', ''); ?></h5></td>
                                          </tr>
                                    </tfoot>
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

<script type="text/javascript">
    $(document).on('change', '#client_id', function() {   
       var client_id = $(this).val();

       $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/Invoices/get_branch'); ?>",
            data    : {'client_id' : client_id},
            success : function(response){
                if(response != ''){                   
                     $('#client_branch').html(response);  
                     $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    }); 
</script>

<script type="text/javascript">
    function change_client_status(status, id) {
    var data = {};
    data.status = status;
    data.id = id;
    $.post('<?php echo base_url(); ?>admin/follow_up/change_client_status', data).done(function(response) {
        location.reload(true);
    });
}
</script>


<script type="text/javascript">

    $('#datatable').DataTable( {

      

        "iDisplayLength": 25,

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

                    columns: [ 0, 1, 2, 3, 5, 6, 7, 10 ]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 5, 6, 7, 10]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 5, 6, 7, 10 ]

                }

            },

            'colvis',

        ]

    } );


</script>

</body>
</html>

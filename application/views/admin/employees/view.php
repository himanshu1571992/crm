<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
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
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('employees'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; ?></h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <?php if(check_permission_page(283,'create')){ ?> 
                   <a href="<?php echo admin_url('employees/add'); ?>" type="submit" class="btn btn-info">Daily Work Report</a> <?php } ?>
                        </div>
                    </div>

					<hr class="hr-panel-heading">
					
					<div class="row">
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input required="" id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-3" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input required="" id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="col-md-1">                            
                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                        </div>


						<div class="col-md-12">	
                        		<div class="table-responsive"> 															
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th>S.No.</th>
										<th>Date</th>
										<th>View</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($work_list)){
										$z=1;
										foreach($work_list as $row){											

											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo _d($row->date); ?></td>
                                                <td><button type="button" value="<?php echo $row->id; ?>" class="ref_no btn btn-info btn-sm" data-toggle="modal" data-target="#myModal">Show List</button></td>
												
												<td class="">
												
													<?php 
													if(check_permission_page(283,'edit')){
													echo '<a class="btn btn-info" title="Edit" href="'.admin_url('employees/add/'.$row->id).'"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>';
													}else{
														echo '--';
													}

													if((check_permission_page(283,'delete'))){
													?>	
													<a class="btn btn-danger _delete" href="<?php echo admin_url('employees/delete_report/'.$row->id);?>" data-status="1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
													<?php
													}
													?>
													
												</td>
												
											</tr>
											<?php
										}
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


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Work List</h4>
      </div>
      <div class="modal-body">
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>



<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>


<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip'
    } );
} );
</script>

<script type="text/javascript">
    $(document).on('click', '.ref_no', function()   
    {
        var id = $(this).val();        

            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/employees/get_work_list'); ?>",
                data    : {'id' : id},
                success : function(response){
                    if(response != ''){                   
                         $('.modal-body').html(response);                           
                    }
                }
            })    
       

    }); 
</script>

<script type="text/javascript">
      $(".myselect").select2();
</script>

</body>
</html>

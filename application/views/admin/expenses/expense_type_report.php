<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="get" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('expenses/expense_type_report'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
					<h4 class="no-margin"><?php echo $title; ?> <a href="<?php echo admin_url('expenses/expense_type_report_export?staff_id='.$s_staff.'&f_date='.$s_fdate.'&t_date='.$s_tdate.'&type_id='.$s_type); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Export</a></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">
					
						<div class="form-group col-md-3">
							<label for="staff_id" class="control-label">Employee Name </label>
							<select class="form-control selectpicker" data-live-search="true" id="staff_id" name="staff_id">
								<option value="" >-- Select All -</option>
								<?php
								if(!empty($staff_list)){
									foreach($staff_list as $row){
										?>
										<option value="<?php echo $row->staffid;?>" <?php if($s_staff == $row->staffid){ echo 'selected'; }?> ><?php echo cc($row->firstname); ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>

						<div class="form-group col-md-3">
							<label for="type_id" class="control-label">Expense Type</label>
							<select class="form-control selectpicker" data-live-search="true" id="type_id" name="type_id">
								<option value="" >-- Select All -</option>
								<?php
								if(!empty($type_info)){
									foreach($type_info as $row){
										?>
										<option value="<?php echo $row->id;?>" <?php if($s_type == $row->id){ echo 'selected'; }?> ><?php echo cc($row->name); ?></option>
										<?php
									}
								}
								?>
							</select>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
							<div class="input-group date">
								<input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2" app-field-wrapper="date">
							<label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
							<div class="input-group date">
								<input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
							</div>
						</div>
						
						<div class="form-group col-md-2 float-right">
							<button class="form-control btn-info" type="submit" value="print" style="margin-top: 25px;">Search</button>
						</div>





						<div class="col-md-12 table-responsive">																
								<table class="table" id="newtable">
									<thead>
									  <tr>
										<th width="3%">S.No</th>
										<th width="7%">Date</th>
										<th width="10%">EXP-ID</th>
										<th>Employee</th>
										<th>Details</th>
										<th>Type</th>
										<th>Sub-Type</th>
										<th>Amount</th>
										<th>Action</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($expense_info)){
										$z=1;
										foreach($expense_info as $row){	

												if($row->parent_id > 0){
													$parent_id = $row->parent_id;
												}else{
													$parent_id = $row->id;
												}
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php echo _d($row->date); ?></td>
												<td><?php echo 'EXP-'.get_short(get_expense_category($row->category)).'-'.number_series($parent_id);?></td>
												<td><?php echo get_employee_name($row->addedfrom);?></td>
												<td>Purpose - <?php echo get_expense_purpose($row->id); ?> <br> <?php echo cc(get_expense_related($row->id));?></td>
												<td><?php echo value_by_id('tblexpensetype',$row->type_id,'name'); ?></td>
												<td><?php echo value_by_id('tblexpensetypesub',$row->typesub_id,'name'); ?></td>
												<td><?php echo $row->amount; ?></td>
												<td>
													
													<button value="<?php echo $row->id; ?>" type="button" class="btn btn-success btn-sm type" data-toggle="modal" data-target="#myModal">Change</button>
													<div class="btn-group pull-right">
														<button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
															<i class="fa fa-ellipsis-v" aria-hidden="true"></i>
														</button>
														<ul class="dropdown-menu dropdown-menu-right toggle-menu">
															<li>
																<a href="javascript:void(0);" class="btn-with-tooltip connect_to_lead" data-id="<?php echo $row->id; ?>" data-lead_id="<?php echo $row->lead_id; ?>"  data-target="#connect_lead" id="lead_connect" data-toggle="modal">
																	<?php echo ($row->lead_id > 0) ? 'Lead Connected' : 'Connect To Lead'; ?>
																</a>
															<li>
														</ul>
													</div>		
												</td>
												
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="9"><h5>Record Not Found</h5></td></tr>';
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
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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
     <script type="text/javascript" src="http://cdn.rawgit.com/bassjobsen/Bootstrap-3-Typeahead/master/bootstrap3-typeahead.min.js"></script>

<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>

</body>
</html>


<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Change Expanse Type</h4>
      </div>
      <div class="modal-body">
      	
       
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<div id="connect_lead" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php
        $attributes = array('id' => 'sub_form_product');
        echo form_open(admin_url("expenses/connect_to_lead"), $attributes);
    ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title"> Connect Lead To Expense </h4>
      </div>
      <div class="modal-body">
          <input type="hidden" name="expense_id" class="expense_id" value="">
          <div class="row lead_number_data">
              <div class="col-md-8">
                  <label for="lead_number" class="control-label">Lead Number</label>
                  <input type="text" name="lead_number" class="lead_number form-control" autocomplete="off" value="">
                  <input type="hidden" name="lead_id" id="lead_connect_id" value='0' class=" form-control">
              </div>
          </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info">Connect</button>
      </div>
    </div>
    <?php echo form_close(); ?>
  </div>
</div>

<script type="text/javascript">
    $(document).on('click', '.type', function() {  

		var expense_id = $(this).val(); 
		var type_id = $("#type_id").val(); 
		var staff_id = $("#staff_id").val(); 
		var f_date = $("#f_date").val(); 
		var t_date = $("#t_date").val(); 
			$.ajax({
				type    : "POST",
				url     : "<?php echo site_url('admin/expenses/change_expense_type_modal'); ?>",
				data    : {'expense_id' : expense_id,'type_id' : type_id,'staff_id' : staff_id,'f_date' : f_date,'t_date' : t_date},
				success : function(response){
					if(response != ''){       

						
						$('.modal-body').html(response);  
						$('.selectpicker').selectpicker('refresh');
					}
				}
			})  
	});    
	$(document).on("click", ".connect_to_lead", function(){
		var id = $(this).data("id");
		$(".expense_id").val(id);
		$.ajax({
				url: "<?php echo admin_url();?>expenses/chk_lead/"+id,
				dataType: "json",
				type: "GET",
				success: function (data) {
					$(".lead_number").val(data.leadno);
					$('#lead_connect_id').val(data.lead_id);
				}
			});
	});
$(function () {
	$(".lead_number").typeahead({
		hint: true,
		highlight: true,
		minLength: 1,
		source: function (request, response) {
			$.ajax({
				url: "<?php echo admin_url();?>expenses/getleadlist",
				data: {
					search: request
					},
				dataType: "json",
				type: "POST",
				success: function (data) {
					
					items = [];
					map = {};
					$.each(data, function (i, item) {
						var id = item.value;
						var name = item.label;
						map[name] = { id: id, name: name };
						items.push(name);
					});
					response(items);
					$(".dropdown-menu").css("height", "auto");
				},
				error: function (response) {
					alert(response.responseText);
				},
				failure: function (response) {
					alert(response.responseText);
				}
			});
		},
		updater: function (item) {
			$('#lead_connect_id').val(map[item].id);
			return item;
		}
        });
    });
</script>
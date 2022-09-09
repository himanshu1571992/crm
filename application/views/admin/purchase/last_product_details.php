<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php  echo admin_url('purchase'); ?>">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">

                    <div class="col-md-9"><h4 class="no-margin">Last Price Details (<?php echo $last_info[0]->product_name; ?>)</h4></div>	
                    <div class="col-md-3"><a href="<?php  echo admin_url('purchase/purchase_order'); ?>" class="form-control btn-info text-center">Create Purchase Order</a></div>		

					<hr class="hr-panel-heading">
					
					<div class="row">
					
						

							<div class="col-md-12 table-responsive">																
								<table class="table">
									<thead>
										<tr>
											<td>S.No</td>
											<td>Vendor Name</td>
											<td>Po No.</td>
											<td>Po Date</td>
											<td>Tax Type</td>
											<td>Tax Rate</td>
											<td>Price</td>
											<td>Reviced PO</td>
										</tr>
									</thead>
									<tbody>
									<?php
									if(!empty($last_info)){
										$i = 1;
										foreach ($last_info as $key => $value) {

											$po_number = (is_numeric($value->number)) ? 'PO-' . $value->number : $value->number;
											if (!empty($value->parent_ids)) {
												$sub_po_exist = $this->db->query("SELECT id FROM `tblpurchaseorder` where id IN (" . $value->parent_ids . ") and id != '" . $value->id . "' ")->row();
											}
											?>
											<tr>                                                      
												<td><?php echo $i++;?></td>
												<td><?php echo value_by_id('tblvendor',$value->vendor_id,'name');?></td>
												<td><a target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $value->id); ?>"><?php echo $po_number;?></a></td>
												<td><?php echo date('d-m-Y',strtotime($value->date));?></td>
												<td><?php echo ($value->tax_type == 1) ?  'Including' : 'Excluding';  ?></td>
												<td><?php echo $value->prodtax; ?></td>                                                        
												<td><?php echo $value->price; ?></td>                                                        
												<td>
													<?php
														if (!empty($sub_po_exist)) {
															?>
															<a  title="View" class="btn-sm btn-info" target="_blank" href="<?php echo admin_url('purchase/purchaseorder_sub_po/' . $value->id); ?>">Show</a>
															<?php
														}else{
															echo '--';
														}
													?>
												</td>                                                        
											</tr>
											<?php
										}
									}else{
										echo '<tr><td class="text-center" colspan="7"><h5>Last Purchase Price Not Found!</h5></td></tr>';
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
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body">
       	<div id="approval_html"></div>
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
	$('.status').click(function(){
	var po_id = $(this).val();
	
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
			data    : {'po_id' : po_id},
			success : function(response){
				if(response != ''){
					$("#approval_html").html(response);
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

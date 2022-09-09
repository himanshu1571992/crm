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

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
             
					<h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
					<hr class="hr-panel-heading">
					
					<div class="row">

								
						<div class="col-md-4">  
                            <div class="form-group">
                                <label for="product_id" class="control-label">Select Product</label>
                                <select class="form-control selectpicker" data-live-search="true" id="product_id" name="product_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($product_info) && count($product_info) > 0) {
                                        foreach ($product_info as $value) {
                                            ?>
                                            <option value="<?php echo $value['id'] ?>" <?php if(!empty($s_product_id) && $s_product_id == $value['id']){ echo 'selected'; } ?>><?php echo $value['sub_name'] ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="col-md-4">  
                                <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="warehouse_id" name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($s_warehouse_id) && $s_warehouse_id == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo cc($all_warehouse_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
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
										<th>Product Name</th>
										<th>Warehouse</th>
										<th>Service Type</th>
										<th>Quantity</th>
										
									  </tr>
									</thead>
									<tbody>
									<?php
									if(!empty($stock_list)){
										$z=1;
										foreach($stock_list as $row){												
											?>																						
											<tr>
												<td><?php echo $z++;?></td>
												<td><?php if($row->stock_type == 5){ echo 'Waste'; }else{ ?><a target="_balnk" href="<?php echo admin_url('product_new/view/'.$row->pro_id); ?>"><?php echo value_by_id('tblproducts',$row->pro_id,'sub_name'); ?></a><?php }?></td>
												<td><?php echo cc(value_by_id('tblwarehouse',$row->warehouse_id,'name')); ?></td>
												<td><?php echo ($row->service_type == 1) ? 'Rent' : 'Sales'; ?></td>												
												<td><?php echo $row->qty; ?></td>												
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



<div id="Confirmation_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Material Receipt Confirmation</h4>
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
        url     : "<?php echo site_url('admin/cutting_department/get_confirmation_html'); ?>",
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

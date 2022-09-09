<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h4>Stock Booking</h4>
                                <hr/>
                            </div>

                            <div class="col-md-6">
								<div class="form-group">
                                    <label for="service_type" class="control-label"><?php echo _l('stock_service_type'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
                                        <option value=""></option>
                                        <?php
                                        if (isset($service_type) && count($service_type) > 0) {
                                            foreach ($service_type as $service_type_key => $service_type_value) {
                                                ?>
                                                <option value="<?php echo $service_type_value['id'] ?>" <?php   if(!empty($stockdata) && $stockdata['service_type'] == $service_type_value['id']){ echo 'selected'; }    ?>><?php echo cc($service_type_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-6">	
								<div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="warehouse_id" name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($stockdata['warehouse_id']) && $stockdata['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo cc($all_warehouse_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div> 
                           
							<div class="col-md-12" style="margin-bottom:5%;">	
							
                            </div>
                            
							<div class="table-responsive s_table compdv">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="28%" align="left">Item Name</th>
											<th width="5%" align="left">View</th>
                                            <th width="10%" class="qty" align="left">Available Qty</th>
                                            <th width="10%" class="qty" align="left">required Qty</th>
                                            <th width="15%" align="left">Remarks</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (isset($prostockdata) && count($prostockdata) > 0) {
                                            $i = 0;
                                            foreach ($prostockdata as $singleproductcomp) {
                                                
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" onchange="get_comp_det(<?php echo $i; ?>,this.value)" id="product_id" name="componnetdata[<?php echo $i; ?>][product_id]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($item_data) && count($item_data) > 0) {
                                                                    foreach ($item_data as $item_value) {
																		
                                                                        ?>
                                                                        <option value="<?php echo $item_value['id'] ?>" <?php echo (isset($singleproductcomp['product_id']) && $singleproductcomp['product_id'] == $item_value['id']) ? 'selected' : "" ?>><?php echo $item_value['name'].product_code($item_value['id']); ?></option>
															<?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
													<td id="view<?php echo $i; ?>"><a href="../../component/component/<?php echo $singleproductcomp['product_id'];?>" target="_blank">view</a></td>
													
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" id="qty" name="componnetdata[<?php echo $i; ?>][qty]" class="form-control" value="<?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : "" ?>">
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <div class="form-group">
                                                            <textarea id="remarks" name="componnetdata[<?php echo $i; ?>][remarks]" class="form-control"><?php echo (isset($singleproductcomp['remarks']) && $singleproductcomp['remarks'] != "") ? $singleproductcomp['remarks'] : "" ?></textarea>
                                                        </div>
                                                    </td>
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger " onclick="removeprocomp('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                           $i++; }
                                        } else {
                                            ?>
                                            <tr class="main" id="tr0">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker items" required="" onchange="get_comp_det(0,this.value)" data-live-search="true" id="product_0" name="componnetdata[0][product_id]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as $item_value) {															
                                                                    ?>
                                                                    <option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['name'].product_code($item_value['id']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </td>
												<td id="view0"></td>
												
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" readonly id="avail_0" name="" class="form-control" >
                                                    </div>
                                                </td>

                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" id="qty_0" required="" name="componnetdata[0][qty]" class="form-control req_qty" >
                                                    </div>
                                                </td>
                                                <td>
                                                    <div class="form-group">
                                                        <textarea id="remarks" name="componnetdata[0][remarks]" class="form-control"></textarea>
                                                    </div>
                                                </td>
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('0');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                        <?php }
                                        ?>
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php if(!empty($productcomponent)){ count($productcomponent); }else{ echo '0'; } ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
							
							<div class="col-md-12">	
								<!-- <div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
										<select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" name="assign[assignid][]">
											<?php
											if(isset($stockdata['approvby']))
											{
												$approvby=explode(',',$stockdata['approvby']);
											}
											if (isset($allStaffdata) && count($allStaffdata) > 0) {
												foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) 
												{?>
													 <optgroup class="<?php echo 'group'.$Staffgroup_value['id'] ?>">
													<option value="<?php echo 'group'.$Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
													<?php
													foreach($Staffgroup_value['staffs'] as $singstaff)
													{?>
														<option style="margin-left: 3%;" value="<?php echo 'staff'.$singstaff['staffid'] ?>" <?php if(isset($approvby) && in_array($singstaff['staffid'],$approvby)){echo'selected';}?>><?php echo $singstaff['firstname'] ?></option>
													<?php
													}?>
													</optgroup>
												<?php
												}
											}
											?>
										</select> 
								</div> -->
								<div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                    <textarea id="remarks" class="form-control" name="remarks"><?php echo (isset($stockdata['remarks']) && $stockdata['remarks'] != "") ? $stockdata['remarks'] : "" ?></textarea>
                                </div>
                            </div> 
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div>
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>



<script type="text/javascript">
 
$(document).on('change', '.items', function(){      
    var service_type = $("#service_type").val();
    var warehouse_id = $("#warehouse_id").val();


     var product_id = $(this).val();
     

    
    if(service_type > 0 && warehouse_id > 0){

            if(product_id > 0){

                var id = $(this).attr('id').split("_")[1];
              
                $.ajax({
                        type    : "POST",
                        url     : "<?php echo site_url('admin/stock_booking/get_avail_stock'); ?>",
                        data    : {'service_type' : service_type,'warehouse_id' : warehouse_id,'product_id' : product_id},
                        success : function(response){
                            if(response != ''){           
                                $('#avail_'+id).val(response);       
                            }   
                        }
                    }) 
            }
                 

    }else{
        alert('Please select service or warehouse first! ');
        $(this).val('');
        $('.selectpicker').selectpicker('refresh');
    }

    
    
        
    
});


$(document).on('change', '.req_qty', function(){   

    var id = $(this).attr('id').split("_")[1];
    var avail_qty = parseInt($('#avail_'+id).val());

    var req_qty = parseInt($(this).val());

    if(avail_qty < req_qty){
        alert('Required quantity must be smaller then Available quantity!');
         $(this).val('');
    }

});


</script>




<script>
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select required style="display: block !important;" class="form-control selectpicker items" id="product_'+newaddmore+'" name="componnetdata[' + newaddmore + '][product_id]" data-live-search="true" onchange="get_comp_det(' + newaddmore + ',this.value)"><option value=""></option><?php
if (isset($item_data) && count($item_data) > 0) {
    foreach ($item_data as $item_value) { 
        ?><option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['name'].product_code($item_value['id']); ?></option><?php
    }
}
?></select></div></td><td id="view'+newaddmore+'"></td>  <td> <div class="form-group"><input type="number" readonly id="avail_'+newaddmore+'" class="form-control" ></div></td>  <td> <div class="form-group"><input type="number" id="qty_'+newaddmore+'" required name="componnetdata[' + newaddmore + '][qty]"  class="form-control req_qty" ></div></td>  <td><div class="form-group"><textarea id="remarks" name="componnetdata[' + newaddmore + '][remarks]" class="form-control" ></textarea></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
	
	
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
	function get_stock_type()
	{
		var stock_type=$('#stock_type').val();
		if(stock_type=='1')
		{
			$('.compdv').show();	
			$('.proddv').hide();	
		}
		if(stock_type=='2')
		{
			$('.proddv').show();
			$('.compdv').hide();
		}
		
	}
	function staffdropdown()
	{
		$.each($("#assign option:selected"), function(){
		   var select=$(this).val();   
		   $("optgroup."+select).children().attr('selected','selected');
        });
		$('.selectpicker').selectpicker('refresh');
		$.each($("#assign option:not(:selected)"), function(){
		   var select=$(this).val();   
		   $("optgroup."+select).children().removeAttr('selected');
		});
		$('.selectpicker').selectpicker('refresh');
	}
	function get_pro_per_cat(catid,value)
	{
		var product_cat_id = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_pro_per_cat/'+product_cat_id,
            method : 'GET',
            success:function(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    $.each(resArr, function(k, v) {
						html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $(document).find("#product_id"+catid).html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
	}
	function get_pro_det(proid,value)
	{
		var prodid = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_pro_det/'+prodid,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#hsn_code'+proid).val(data.hsn_code);
				$('#sac_code'+proid).val(data.sac_code);
				$('#viewlink'+proid).html('<a href="../product/product/'+data.id+'" target="_blank">view</a>');
            }
        });
	}
	function get_comp_det(proid,value)
	{
		var component_id = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_comp_det/'+component_id,
            method : 'GET',
            success:function(res) {
				/*var data=JSON.parse(res);
				$('#comphsn_code'+proid).val(data.hsn_code);
				$('#compsac_code'+proid).val(data.sac_code);*/
				$('#view'+proid).html('<a href="../product/product/'+component_id+'" target="_blank">view</a>');
            }
        });
	}
	
	
</script>



</body>
</html>

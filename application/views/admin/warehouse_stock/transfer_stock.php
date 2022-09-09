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
                                <h4><?php
                                    if (isset($stockdata['id']))
                                        echo _l('edit_stock');
                                    else
                                        echo _l('transfer_stock');
                                    ?></h4>
                                <hr/>
                            </div>
                            <div class="col-md-6">
								<div class="form-group">
                                    <label for="service_type" class="control-label">Transfer To</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type">
                                        <option value=""></option>
										<option value="2" >Sale to Rent</option>
										<option value="1" >Rent to Sale</option>
                                                
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="stock_for" class="control-label"><?php echo _l('transfer_type'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="stock_for" name="stock_for">
                                        <option value=""></option>
                                        <option value="1">New</option>
                                        <option value="2">Old</option>
                                                
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-6">	
								<div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('transfer_stock_from_warehouse'); ?></label>
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
							<div class="col-md-6">	
								<div class="form-group">
                                    <label for="to_warehouse_id" class="control-label"><?php echo _l('transfer_stock_to_warehouse'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="to_warehouse_id" name="to_warehouse_id">
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
                            <div class="table-responsive s_table compdv" style="margin-top:10%; !important">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" >
                                    <thead>
                                        <tr>
                                            <th width="32%" align="left">Item Name</th>
											<th width="5%" align="left"><?php echo _l('view');?></th>
											<th width="14%" align="left"><?php echo _l('available_stock');?></th>
                                            <th width="20%" align="left"><?php echo _l('transfer_stock');?>	</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (isset($prostockdata) && count($prostockdata) > 0 && $stockdata['is_product']==0) {
                                            $i = 0;
                                            foreach ($prostockdata as $singleproductcomp) {
                                                
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" onchange="get_comp_det(<?php echo $i; ?>,this.value)" id="product_id" name="componnetdata[<?php echo $i; ?>][product_id]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($component_data) && count($component_data) > 0) {
                                                                    foreach ($component_data as $unit_key => $component_value) {
																		if($component_value['sac_code']!=''){$sac_code='( '.$component_value['sac_code'].' )';}else{$sac_code='';}
                                                                        ?>
                                                                        <option value="<?php echo $component_value['id'] ?>" <?php echo (isset($singleproductcomp['product_id']) && $singleproductcomp['product_id'] == $component_value['id']) ? 'selected' : "" ?>><?php echo $component_value['name'].' '.$sac_code; ?></option>
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
														<input type="text" id="available_stock<?php echo $i; ?>" readonly name="componnetdata[<?php echo $i; ?>][available_stock]" class="form-control" value="<?php echo (isset($singleproductcomp['hsn_code']) && $singleproductcomp['hsn_code'] != "") ? $singleproductcomp['hsn_code'] : "" ?>">
													</div>
												</td>
											
													<td>
                                                        <div class="form-group">
                                                            <input type="number" id="transfer_stock<?php echo $i; ?>" name="componnetdata[<?php echo $i; ?>][transfer_stock]" class="form-control" value="<?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : "" ?>">
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
                                                        <select class="form-control selectpicker" onchange="get_comp_det(0,this.value)" data-live-search="true" id="product_id" name="componnetdata[0][product_id]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as $product_value) {																	
                                                                    ?>
                                                                    <option value="<?php echo $product_value['id'] ?>"><?php echo $product_value['name'].product_code($product_value['id']); ?></option>
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
														<input type="text" id="available_stock0" readonly name="componnetdata[0][available_stock]" class="form-control" value="">
													</div>
												</td>												
                                                 
												<td>
                                                    <div class="form-group">
                                                        <input type="number" id="transfer_stock0" name="componnetdata[0][transfer_stock]" class="form-control" >
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
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php echo count($productcomponent); ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
							
							<div class="col-md-12">	
								<div class="form-group">
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
								</div>
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
<script>
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="product_id" name="componnetdata[' + newaddmore + '][product_id]" data-live-search="true" onchange="get_comp_det(' + newaddmore + ',this.value)"><option value=""></option><?php
if (isset($item_data) && count($item_data) > 0) {
    foreach ($item_data as  $product_value) { 
        ?><option value="<?php echo $product_value['id'] ?>" ><?php echo $product_value['name'].product_code($product_value['id']); ?></option><?php
    }
}
?></select></div></td><td id="view'+newaddmore+'"></td><td><div class="form-group"><input type="text" id="available_stock'+newaddmore+'" readonly name="componnetdata['+newaddmore+'][available_stock]" class="form-control" value=""></div></td><td> <div class="form-group"><input type="number" id="transfer_stock' + newaddmore + '" name="componnetdata[' + newaddmore + '][transfer_stock]" class="form-control" ></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
	
	$('.addmorepro').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><select class="form-control selectpicker" onchange="get_pro_per_cat('+newaddmore+',this.value)" data-live-search="true" id="product_cat_id'+newaddmore+'"><option value=""></option><?php if (isset($procategory) && count($procategory) > 0) { foreach ($procategory as $procategory_key => $procategory_value) {?><option value="<?php echo $procategory_value['id'] ?>"><?php echo $procategory_value['name'] ?></option><?php }}?></select></div></td><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" onchange="get_pro_det('+newaddmore+',this.value)" id="product_id'+newaddmore+'" name="productdata['+newaddmore+'][product_id]"><option value=""></option></select></div></td><td id="viewlink'+newaddmore+'"></td><td><div class="form-group"><input type="text" id="hsn_code'+newaddmore+'" name="productdata['+newaddmore+'][hsn_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="text" id="sac_code'+newaddmore+'" name="productdata['+newaddmore+'][sac_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="number" id="qty" name="productdata['+newaddmore+'][qty]" class="form-control" ></div></td><td><div class="form-group"><textarea id="remarks'+newaddmore+'" name="productdata['+newaddmore+'][remarks]" class="form-control"></textarea></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
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
	function get_comp_det(value,proid) {
			var warehouseid=$('#warehouse_id').val();
			var service_type=$('#service_type').val();
			//alert(warehouse_id);
			//alert(service_type);
			//alert(proid);
			var url = '<?php echo base_url(); ?>admin/Site_manager/getprostock';
            $.post(url,
                    {
                        proid: proid,
                        warehouseid: warehouseid,
                        service_type: service_type,
                    },
                    function (data, status) 
					{	
						//alert(data);		die();			
						$('#available_stock'+value).val(data);
						$('#view'+value).html('<a href="../product/product/'+proid+'" target="_blank">view</a>');
					});
		}
	
	
	
</script>


<script type="text/javascript">
    $(document).on('change', '#to_warehouse_id', function(){ 
        var to_warehouseid=$(this).val();
        var warehouseid=$('#warehouse_id').val();

        if(to_warehouseid == warehouseid){
            alert('Warehouse cannot be same');
            $(this).val('');
            $('.selectpicker').selectpicker('refresh');
             
        } 
        
    }); 

    $(document).on('change', '#warehouse_id', function(){ 
        var warehouseid=$(this).val();
        var to_warehouseid=$('#to_warehouse_id').val();

        if(to_warehouseid == warehouseid){
            alert('Warehouse cannot be same');
            $(this).val('');
            $('.selectpicker').selectpicker('refresh');
             
        } 
        
    });
</script> 


</body>
</html>

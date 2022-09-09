<?php init_head(); ?>
<style>table.items tr.main td { padding: 10px 10px !important;}.error{border:1px solid red !important;}</style>
<div class="modal fade" id="myModal" role="dialog">
   <div class="modal-dialog modal-lg">
   <?php // echo form_open('admin/Stock/converttask', array('id' => 'stock')); ?>
      <!-- Modal content-->
	   <textarea name="availablestockarray" id="availablestockarray" style="display:none;"></textarea>
      <div class="modal-content">
	  <div class="modal-header">
		  <button type="button" class="close" data-dismiss="modal">&times;</button>
		  <h4 class="modal-title"><?php echo _l('check_availability');?></h4>
		</div>
		<div class="modal-body" id="stockavdv">
		</div>
		<div class="modal-footer">
		  <!--<button type="submit" class="btn btn-info uploadpdf">Upload</button>-->
		  <!-- <button type="submit" class="btn btn-info" onclick="createtask('stockavdv')" ><?php echo _l('add_task');?></button> -->
		  <button type="button" id="cmd" class="btn btn-default" data-dismiss="modal">Close</button>
		</div>
	  </div>
	    <?php //echo form_close(); ?>
    </div>
  </div>
<div id="wrapper">
    <div class="content accounting-template">
		<a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'stock-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
           <textarea name="availablestockhtml" id="availablestockhtml" style="display:none;"></textarea>
			<div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo _l('check_availability');?></h4>
                                <hr/>
                            </div>
							<div class="col-md-6">	
								<div class="form-group">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker warehouse_id" data-live-search="true" id="warehouse_id" name="warehouse_id[]">
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
								<span class="warehouseerror" style="padding:2px;color:red;display:none;"> select any warehouse</span>
                            </div> 
                            <div class="col-md-6">
								<div class="form-group">
                                    <label for="service_type" class="control-label"><?php echo _l('stock_service_type'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="service_type" name="service_type[]">
                                        <option value=""></option>
                                        <?php
                                        if (isset($service_type) && count($service_type) > 0) {
                                            foreach ($service_type as $service_type_key => $service_type_value) 
											{?>
                                                <option value="<?php echo $service_type_value['id'] ?>" <?php echo (isset($stockdata['service_type']) && $stockdata['service_type'] == $service_type_value['id']) ? 'selected' : "" ?>><?php echo cc($service_type_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								<span class="servicetypeerror" style="padding:2px;color:red;display:none;"> select any service type</span>
                            </div>
                            
							<div class="table-responsive s_table proddv" style="margin-top:19%;" >
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myproTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="19%" align="left"><?php echo _l('product_name');?></th>
											<th width="5%" align="left"><?php echo _l('view');?></th>
                                            <th width="14%" align="left"><?php echo _l('stock_hsn_code');?></th>
											<th width="14%" align="left"><?php echo _l('stock_sac_code');?></th>
                                            <th width="8%" class="qty" align="left"><?php echo _l('stock_qty');?></th>
                                            <th width="2%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        
                                            <tr class="main" id="tr0">
                                                <td>
                                                    <div class="form-group">
                                                       <select class="form-control selectpicker" onchange="get_pro_det(0,this.value)" data-live-search="true" id="product_id0" name="productdata[0][productid]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as  $pro_value) {
                                                                    ?>
                                                                    <option value="<?php echo $pro_value['id'] ?>"><?php echo $pro_value['name'].product_code($pro_value['id']); ?></option>
                                                                    <?php
                                                                }
                                                            }?>
                                                        </select>
                                                    </div>
                                                </td>
												
												<td id="viewlink0"></td>
												<td>
													<div class="form-group">
														<input type="text" id="hsn_code0" name="productdata[0][hsn_code]" class="form-control" value="<?php echo (isset($singleproductcomp['hsn_code']) && $singleproductcomp['hsn_code'] != "") ? $singleproductcomp['hsn_code'] : "" ?>">
													</div>
												</td>
												<td>
													<div class="form-group">
														<input type="text" id="sac_code0" name="productdata[0][sac_code]" class="form-control" value="<?php echo (isset($singleproductcomp['sac_code']) && $singleproductcomp['sac_code'] != "") ? $singleproductcomp['sac_code'] : "" ?>">
													</div>
												</td>
                                                <td>
                                                    <div class="form-group">
                                                        <input type="number" id="qty" name="productdata[0][qty]" class="form-control" >
                                                    </div>
                                                </td>
                                                
                                                <td>
                                                    <button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('0');" ><i class="fa fa-remove"></i></button>
                                                </td>
                                            </tr>
                                        
                                    </tbody>
                                </table>
                                <div class="col-xs-12">
                                    <label class="label-control subHeads"><a class="addmorepro" value="<?php if(!empty($prostockdata)){ echo count($prostockdata); }else{ echo 0; } ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>
                            </div>
							<div class="ee"></div>
							<div class="eeff"></div>
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info check_availability" type="button">
                                <?php echo _l('check_availability'); ?>
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
    $('.check_availability').click(function ()
    {
		var warehouse_id=$('#warehouse_id').val();
		var service_type=$('#service_type').val();
		if(warehouse_id!='' & service_type!='')
		{
			var formData = $('#stock-form').serialize();
		   $.ajax({
					url:'<?php echo base_url(); ?>admin/Stock/getavailabilitynew',				
					type:'post',
					data: formData,
					success:function (data, status) {
						
						var res=JSON.parse(data);
								$('#availablestockhtml').val(res.html);
								$('#availablestockarray').val(res.productdata);
								$('.modal-body').html(res.html);
								jQuery(function(){
								   jQuery('#modal').click();
								});
								$('.warehouseerror').hide();
								$('.servicetypeerror').hide();
							}
					});
		}
		else
		{
			if(warehouse_id=='')
			{
				$('.warehouseerror').show();
			}
			else
			{
				$('.warehouseerror').hide();
			}
			if(service_type=='')
			{
				$('.servicetypeerror').show();
			}
			else
			{
				$('.servicetypeerror').hide();
			}
		}
	});
	$('.addmorepro').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myproTable tbody').append('<tr class="main" id="tr'+newaddmore+'"><td><div class="form-group"><select class="form-control selectpicker" data-live-search="true" onchange="get_pro_det('+newaddmore+',this.value)" id="product_id'+newaddmore+'" name="productdata['+newaddmore+'][productid]" ><option value=""></option><?php if (isset($item_data) && count($item_data) > 0) { foreach ($item_data as $pro_value) {?><option value="<?php echo $pro_value['id'] ?>"><?php echo $pro_value['name'].product_code($pro_value['id']) ?></option><?php }}?></select></div></td><td id="viewlink'+newaddmore+'"></td><td><div class="form-group"><input type="text" id="hsn_code'+newaddmore+'" name="productdata['+newaddmore+'][hsn_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="text" id="sac_code'+newaddmore+'" name="productdata['+newaddmore+'][sac_code]" class="form-control" value=""></div></td><td><div class="form-group"><input type="number" id="qty" name="productdata['+newaddmore+'][qty]" class="form-control" ></div></td><td><button type="button" class="btn pull-right btn-danger"  onclick="removeprocomp('+newaddmore+');" ><i class="fa fa-remove"></i></button></td></tr>');
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
	function createtask() {
		var availablestockhtml=$('#availablestockhtml').val();
		var availablestockarray=$('#availablestockarray').val();
		url = typeof(url) != 'undefined' ? url : admin_url + 'Stock/task';
		var $taskSingleModal = $('#task-modal');
		if ($taskSingleModal.is(':visible')) { $taskSingleModal.modal('hide'); }
		var $taskEditModal = $('#_task_modal');
		if ($taskEditModal.is(':visible')) { $taskEditModal.modal('hide'); }
		requestGet(url).done(function(response) {
			$('#_task').html(response);
			$('#myModal').modal('toggle');
			$('#myModal').removeClass('in');
			$("body").find('#_task_modal').modal({ show: true, backdrop: 'static' });
			$('#rel_type').val('stock');
			$('#description').val(availablestockhtml);
		});
	}
	</script>
</body>
</html>
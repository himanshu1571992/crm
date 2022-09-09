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
                                <h4><?php echo $title; ?></h4><hr/>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="vendor_id" class="control-label">Select Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" required="" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($purchase_info['vendor_id']) && $purchase_info['vendor_id'] == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>

                            <div class="col-md-4">
								<?php 
                                    $value = _d(date('Y-m-d')); 
                                    echo render_date_input('date', 'Material Receipt Date', $value); 
                                ?>
                            </div>

                            

                            <div class="col-md-4">  
                                <?php echo render_input('reference_no', 'reference_no', ''); ?>
                            </div> 

                            <div class="form-group col-md-4">
                                    <label for="warehouse_id" class="control-label"><?php echo _l('stock_warehouse'); ?></label>
                                    <select class="form-control selectpicker warehouse_id" data-live-search="true" required="" id="warehouse_id" name="warehouse_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                            foreach ($all_warehouse as $all_warehouse_key => $all_warehouse_value) {
                                                ?>
                                                <option value="<?php echo $all_warehouse_value['id'] ?>" <?php echo (isset($purchase_info['warehouse_id']) && $purchase_info['warehouse_id'] == $all_warehouse_value['id']) ? 'selected' : "" ?>><?php echo $all_warehouse_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                            <div class="form-group col-md-4">
                                    <label for="tax_type" class="control-label">Service Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" required="" id="service_type" name="service_type">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 1) ? 'selected' : '' ; ?> >Rent</option>
                                        <option value="2" <?php echo (!empty($purchase_info) && $purchase_info['service_type'] == 2) ? 'selected' : '' ; ?>>Sales</option>
                                        
                                        
                                    </select>
                                </div>

                            <div class="col-md-4">	
								<div class="form-group" app-field-wrapper="challan_no">
                                    <label for="challan_no" class="control-label">challan No.</label>
                                    <input type="text" id="challan_no" name="challan_no" class="form-control" value="">
                                </div>
                            </div> 

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="files" class="control-label"><?php echo 'Attachment File'; ?></label>
                                    <input type="file" id="files" multiple="" name="files[]" style="width: 100%;">
                                </div>
                            </div>

                            <div class="col-md-6">  
                                <div class="form-group">
                                    <label for="assign" class="control-label"><?php echo _l('stock_approve_by'); ?></label>
                                        <select onchange="staffdropdown()" class="form-control selectpicker" multiple data-live-search="true" id="assign" required="" name="assignid[]">
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
                                
                            </div> 
                            <div class="col-md-9">
                                <div class="form-group">
                                    <label for="adminnote" class="control-label"><?php echo _l('stock_remarks'); ?></label>
                                    <textarea id="adminnote" class="form-control" name="adminnote"></textarea>
                                </div>
                            </div>

                            <div class="form-group col-md-3" app-field-wrapper="extrusion">
                                <label style="margin-top: 25px;" for="extrusion" class="control-label">MR for Extrusion </label>
                                <input type="checkbox" name="extrusion" value="1">
                            </div>

                           
							<div class="col-md-12" style="margin-bottom:5%;">	
							
                            </div>
                            
							<div class="table-responsive s_table compdv">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable" style="margin-top:2%; !important">
                                    <thead>
                                        <tr>
                                            <th width="32%" align="left">Item Name</th>
											<th width="5%" align="left"><?php echo _l('view');?></th>
                                            <th width="10%" class="qty" align="left"><?php echo _l('stock_qty');?></th>
                                            <th width="20%" align="left"><?php echo _l('stock_remarks');?>	</th>
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
                                                        <select class="form-control selectpicker" onchange="get_comp_det(0,this.value)" data-live-search="true" id="product_id" name="componnetdata[0][product_id]">
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
                                                        <input type="number" id="qty" name="componnetdata[0][qty]" class="form-control" >
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
							
							
                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" type="submit">
                                <?php echo _l('send_for_approval'); ?>
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
    foreach ($item_data as $item_value) { 
        ?><option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['name'].product_code($item_value['id']); ?></option><?php
    }
}
?></select></div></td><td id="view'+newaddmore+'"></td><td> <div class="form-group"><input type="number" id="qty" name="componnetdata[' + newaddmore + '][qty]" class="form-control" ></div></td><td><div class="form-group"><textarea id="remarks" name="componnetdata[' + newaddmore + '][remarks]" class="form-control" ></textarea></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
	
	
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
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
	
	function get_comp_det(proid,value)
	{
		var component_id = value;
        $('#view'+proid).html('<a href="../product/product/'+component_id+'" target="_blank">view</a>');
		/*var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'Product/get_comp_det/'+component_id,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#comphsn_code'+proid).val(data.hsn_code);
				$('#compsac_code'+proid).val(data.sac_code);
				$('#view'+proid).html('<a href="../product/product/'+data.id+'" target="_blank">view</a>');
            }
        });*/
	}
	
	
</script>
</body>
</html>

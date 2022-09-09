<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($product['id']))
                                        echo 'Edit Product/Component Raw Material';
                                    else
                                        echo 'Add Product/Component Raw Material';
                                    ?></h3>
                                <hr/>
                            </div>
							
<?php
if(!empty($product)){
	$product_info = $this->home_model->get_result('tblproducts', array('product_cat_id'=>$product['product_category']), '');
}

?>							
							

                            <div class="col-md-12">
							
								 <div class="form-group col-md-6">
									<label for="type" class="control-label">Type *</label>
									<select class="form-control selectpicker" id="type" name="type" required="" <?php if(!empty($product)){ echo 'disabled';}?>>
										<option value=""></option>
										<option value="1" <?php echo (isset($product['type']) && $product['type'] == 1) ? 'selected' : "" ?>>Component</option>
										<option value="2" <?php echo (isset($product['type']) && $product['type'] == 2) ? 'selected' : "" ?>>Product</option>
									</select>
								</div>
								
								<div class="form-group col-md-6">
                                    <label for="status" class="control-label"><?php echo _l('unit_status'); ?> *</label>
                                    <select class="form-control selectpicker" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($product['status']) && $product['status'] == 1) ? 'selected' : "" ?>>Enable</option>
                                        <option value="0" <?php echo (isset($product['status']) && $product['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>
							
							
								<div id="product_div" hidden>
								<div class="form-group col-md-6">
                                    <label for="product_category" class="control-label"><?php echo _l('product_cat'); ?></label>
                                    <select class="form-control selectpicker" onchange="get_subcategory_by_category(this.value)" data-live-search="true" id="product_category" name="product_category" <?php if(!empty($product)){ echo 'disabled';}?>>
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                ?>
                                                <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product['product_category']) && $product['product_category'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo $pro_cat_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								
								
								<div class="form-group col-md-6">
                                    <label for="product" class="control-label"><?php echo _l('product'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="product" name="product" <?php if(!empty($product)){ echo 'disabled';}?>>
                                        <option value=""></option>
                                        <?php
                                        if (isset($product_info) && count($product_info) > 0) {
                                            foreach ($product_info as $row) {
                                                ?>
                                                <option value="<?php echo $row->id ?>" <?php echo (isset($product['product']) && $product['product'] == $row->id) ? 'selected' : "" ?>><?php echo $row->name; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
								
                                </div>
								
								<div id="component_div" hidden>
									<div class="form-group col-md-6">
										<label for="component" class="control-label"><?php echo _l('component'); ?></label>
										<select class="form-control selectpicker" data-live-search="true" id="component" name="component" <?php if(!empty($product)){ echo 'disabled';}?>>
											<option value=""></option>
											<?php
											if (isset($component_data) && count($component_data) > 0) {
												foreach ($component_data as $pro_cat_value) {
													?>
													<option value="<?php echo $pro_cat_value->id; ?>" <?php echo (isset($product['component']) && $product['component'] ==  $pro_cat_value->id) ? 'selected' : "" ?>><?php echo $pro_cat_value->name ?></option>
													<?php
												}
											}
											?>
										</select>
									</div>
								</div>
								
							
                            </div>
                            

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($product['id']))
                                        echo 'Edit Raw Material Details';
                                    else
                                       echo 'Raw Material Details';
                                    ?></h3>
                                <hr/>
                            </div>

                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="50%" align="left">Raw Material Name</th>
                                            <th width="5%" align="left">view</th>
                                            <th width="40%" class="qty" align="left">Qty</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (!empty($productcomponent)) {
                                            $i = 0;
                                            foreach ($productcomponent as $singleproductcomp) {
                                                $i++;
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" onchange="get_comp_det(<?php echo $i; ?>,this.value)" id="componnet_id" name="componnetdata[<?php echo $i; ?>][componnetid]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($material_data) && count($material_data) > 0) {
                                                                    foreach ($material_data as $unit_key => $component_value) {
                                                                        ?>
                                                                        <option value="<?php echo $component_value['id'] ?>" <?php echo (isset($component_value['id']) && $singleproductcomp['raw_material_id'] == $component_value['id']) ? 'selected' : "" ?>><?php echo $component_value['name'] ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
													<td id="view<?php echo $i; ?>"><a href="../../raw_material/add_material/<?php echo $singleproductcomp['raw_material_id'];?>" target="_blank">view</a></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" id="compqty" name="componnetdata[<?php echo $i; ?>][compqty]" class="form-control" value="<?php echo (isset($singleproductcomp['quantity']) && $singleproductcomp['quantity'] != "") ? $singleproductcomp['quantity'] : "" ?>">
                                                        </div>
                                                    </td>                                                   
                                                    <td>
                                                        <button type="button" class="btn pull-right btn-danger " onclick="removeprocomp('<?php echo $i; ?>');"><i class="fa fa-remove"></i></button>
                                                    </td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            ?>
                                            <tr class="main" id="tr0">
                                                <td>
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker" data-live-search="true" id="componnet_id" onchange="get_comp_det(0,this.value)" name="componnetdata[0][componnetid]">
                                                            <option value=""></option>
                                                            <?php
                                                            if (isset($material_data) && count($material_data) > 0) {
                                                                foreach ($material_data as $unit_key => $component_value) {
                                                                    ?>
                                                                    <option value="<?php echo $component_value['id'] ?>"><?php echo $component_value['name'] ?></option>
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
                                                        <input type="number" id="compqty" name="componnetdata[0][compqty]" class="form-control" >
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
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php if(!empty($productcomponent)){ echo count($productcomponent); } ?>">Add More <i class="fa fa-plus"></i></a></label>
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
    init_selectpicker();
</script>
<script>
    $('.removeimg').click(function () {
        if (confirm("Are you sure?"))
        {
            var proid = $(this).attr('value');
            var url = admin_url + 'Product/imagedelete/';
            $.post(url,
                    {
                        proid: proid,
                    },
                    function (data, status) {
                        //$('.proimg').load(url + ' .proimg'); 
                        $('.proimg').hide();
                    });
        }
    });
    $('.addmore').click(function ()
    {
        var addmore = parseInt($(this).attr('value'));
        var newaddmore = addmore + 1;
        $(this).attr('value', newaddmore);
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="componnetid" onchange="get_comp_det(' + newaddmore + ',this.value)" name="componnetdata[' + newaddmore + '][componnetid]" data-live-search="true"><option value=""></option><?php
if (isset($material_data) && count($material_data) > 0) {
    foreach ($material_data as $unit_key => $component_value) {
        ?><option value="<?php echo $component_value['id'] ?>" ><?php echo $component_value['name'] ?></option><?php
    }
}
?></select></div></td><td id="view'+newaddmore+'"></td><td> <div class="form-group"><input type="number" id="compqty" name="componnetdata[' + newaddmore + '][compqty]" class="form-control" ></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    $('.selectpicker').selectpicker('refresh');
	});
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
	init_selectpicker();

    function get_subcategory_by_category(cat_id) {
        var html = '<option value=""></option>';
        
        if(cat_id == "") {
            $("#product").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'raw_material/get_product_by_cat_id/' + cat_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#product").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	function get_comp_det(proid,value)
	{
		var component_id = value;
		var html = '<option value=""></option>';
		$.ajax({
            url : admin_url+'raw_material/get_material_det/'+component_id,
            method : 'GET',
            success:function(res) {
				var data=JSON.parse(res);
				$('#view'+proid).html('<a href="../raw_material/add_material/'+data.id+'" target="_blank">view</a>');
            }
        });
	}
</script>


<script type="text/javascript">
$('#type').change(function(){
var type = $(this).val();

	if(type == 1){
		$("#component_div").show();
		$("#product_div").hide();
	}else if(type == 2){
		 $("#product_div").show(); 
		 $("#component_div").hide(); 
	}else{
		$("#component_div").hide(); 
		$("#product_div").hide();
	}
	
});	


$( document ).ready(function() {
var type = $('#type').val();

	if(type == 1){
		$("#component_div").show();
		$("#product_div").hide();
	}else if(type == 2){
		 $("#product_div").show(); 
		 $("#component_div").hide(); 
	}else{
		$("#component_div").hide(); 
		$("#product_div").hide();
	}
	
});	
</script> 


</body>
</html>

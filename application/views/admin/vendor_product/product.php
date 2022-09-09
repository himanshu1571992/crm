<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'vendorproduct-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($product['id']))
                                        echo _l('edit_vendor_product');
                                    else
                                        echo _l('add_vendor_product');
                                    ?></h3>
                                <hr/>
                            </div>

                            <div class="col-md-6">

							
							<div class="form-group">
                                    <label for="vendor_id" class="control-label"><?php echo _l('vendor_name'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendor_data) && count($vendor_data) > 0) {
                                            foreach ($vendor_data as $vendor_key => $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value['id'] ?>" <?php echo (isset($product['vendor_id']) && $product['vendor_id'] == $vendor_value['id']) ? 'selected' : "" ?>><?php echo $vendor_value['name'].' - '.$vendor_value['email']; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                
								
								
								<div class="form-group">
                                    <label for="vendor_product_cat_id" class="control-label"><?php echo _l('vendor_product_cat'); ?></label>
                                    <select class="form-control selectpicker" onchange="get_product_by_category(this.value)" data-live-search="true" id="vendor_product_cat_id" name="product_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                ?>
                                                <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product['vendor_product_cat_id']) && $product['vendor_product_cat_id'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo $pro_cat_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group">
                                    <label for="sac_code" class="control-label"><?php echo _l('vendor_product_sac_code'); ?></label>
                                    <input type="text" id="sac_code" name="sac_code" class="form-control" value="<?php echo (isset($product['sac_code']) && $product['sac_code'] != "") ? $product['sac_code'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="working_height" class="control-label"><?php echo _l('vendor_product_working_height'); ?></label>
                                    <input type="text" id="working_height" name="working_height" class="form-control" value="<?php echo (isset($product['working_height']) && $product['working_height'] != "") ? $product['working_height'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="platform_height" class="control-label"><?php echo _l('vendor_product_platform_height'); ?></label>
                                    <input type="text" id="platform_height" name="platform_height" class="form-control" value="<?php echo (isset($product['platform_height']) && $product['platform_height'] != "") ? $product['platform_height'] : "" ?>">
                                </div>




                                <div class="form-group">
                                    <label for="gst_id" class="control-label"><?php echo _l('vendor_product_gst'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="gst_id" name="gst_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($tax_data) && count($tax_data) > 0) {
                                            foreach ($tax_data as $tax_key => $tax_value) {
                                                ?>
                                                <option value="<?php echo $tax_value['id'] ?>" <?php echo (isset($product['gst_id']) && $product['gst_id'] == $tax_value['id']) ? 'selected' : "" ?>><?php echo $tax_value['taxrate'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>


                                <div class="form-group">
                                    <label for="purchase_price" class="control-label"><?php echo _l('vendor_product_purchase_price'); ?></label>
                                    <input type="text" id="purchase_price" name="purchase_price" class="form-control" value="<?php echo (isset($product['purchase_price']) && $product['purchase_price'] != "") ? $product['purchase_price'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="weight" class="control-label"><?php echo _l('vendor_product_weight'); ?></label>
                                    <input type="text" id="weight" name="product_weight" class="form-control" value="<?php echo (isset($product['vendor_product_weight']) && $product['vendor_product_weight'] != "") ? $product['vendor_product_weight'] : "" ?>">
                                </div>
								<div class="form-group">
                                    <label for="vendor_product_description" class="control-label"><?php echo _l('vendor_product_description'); ?></label>
                                    <textarea id="vendor_product_description" name="product_description" class="form-control"><?php echo (isset($product['vendor_product_description']) && $product['vendor_product_description'] != "") ? $product['vendor_product_description'] : "" ?></textarea>
                                </div>
                            </div>
                            <div class="col-md-6">	
                                <div class="form-group">
                                    <label for="productsubname" class="control-label"><?php echo _l('vendor_product_sub_name'); ?></label>
                                    <input type="text" id="productsubname" name="sub_name" class="form-control" value="<?php echo (isset($product['sub_name']) && $product['sub_name'] != "") ? $product['sub_name'] : "" ?>">
                                </div>
								
								<div class="form-group">
                                    <label for="product_id" class="control-label"><?php echo _l('vendor_product_name'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" onChange="productdata();" id="product_id" name="pro_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_data) && count($pro_data) > 0) {
                                            foreach ($pro_data as $pro_key => $pro_value) {
                                                ?>
                                                <option value="<?php echo $pro_value['id'] ?>" <?php echo (isset($product['vendor_product_sub_cat_id']) && $product['vendor_product_sub_cat_id'] == $pro_value['id']) ? 'selected' : "" ?>><?php echo $pro_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
									<input type="hidden" name="name" id="name">
                                </div>
								
                                <div class="form-group">
                                    <label for="hsn_code" class="control-label"><?php echo _l('vendor_product_hsn_code'); ?></label>
                                    <input type="text" id="hsn_code" name="hsn_code" class="form-control" value="<?php echo (isset($product['hsn_code']) && $product['hsn_code'] != "") ? $product['hsn_code'] : "" ?>">
                                </div> 

                                <div class="form-group">
                                    <label for="tower_height" class="control-label"><?php echo _l('vendor_product_tower_height'); ?></label>
                                    <input type="text" id="tower_height" name="tower_height" class="form-control" value="<?php echo (isset($product['tower_height']) && $product['tower_height'] != "") ? $product['tower_height'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="dimensions" class="control-label"><?php echo _l('vendor_product_dimensions'); ?></label>
                                    <input type="text" id="dimensions" name="dimensions" class="form-control" value="<?php echo (isset($product['dimensions']) && $product['dimensions'] != "") ? $product['dimensions'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="unit_id" class="control-label"><?php echo _l('vendor_product_unit'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="unit_id" name="unit_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($unit_data) && count($unit_data) > 0) {
                                            foreach ($unit_data as $unit_key => $unit_value) {
                                                ?>
                                                <option value="<?php echo $unit_value['id'] ?>" <?php echo (isset($product['unit_id']) && $product['unit_id'] == $unit_value['id']) ? 'selected' : "" ?>><?php echo $unit_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>



                                <div class="form-group">
                                    <label for="photo" class="control-label"><?php echo _l('vendor_product_image'); ?></label>
                                    <input type="file" id="photo" name="photo">
                                </div>

                                <?php
                                if (isset($product['photo']) && $product['photo'] != "") {
                                    ?>
                                    <div class="form-group proimg">
                                        <label class="control-label"></label>
                                        <img src="<?php echo base_url('uploads/product') . "/" . $product['id'] . "/" . $product['photo'] ?>" style="width: 150px; height: 150px;">
                                        <a class="removeimg" value="<?php echo $product['id']; ?>">Remove Image <i class="fa fa-remove"></i></a>
                                    </div>
                                    <?php
                                }
                                ?>

                                <div class="form-group">
                                    <label for="status" class="control-label"><?php echo _l('vendor_product_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true"  id="status" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($product['status']) && $product['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($product['status']) && $product['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>
								<div class="form-group">
                                    <label for="vendor_product_remarks" class="control-label"><?php echo _l('vendor_product_remarks'); ?></label>
                                    <textarea id="vendor_product_remarks" name="product_remarks" class="form-control"><?php echo (isset($product['vendor_product_remarks']) && $product['vendor_product_remarks'] != "") ? $product['vendor_product_remarks'] : "" ?></textarea>
                                </div>
                            </div> 

                            

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($product['id']))
                                        echo _l('edit_vendor_product_price');
                                    else
                                        echo _l('add_vendor_product_price');
                                    ?></h3>
                                <hr/>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="sale_price_cat_a" class="control-label"><?php echo _l('vendor_product_add_sale_cat_a'); ?></label>
                                    <input type="text" id="sale_price_cat_a" name="sale_price_cat_a" class="form-control" value="<?php echo (isset($product['sale_price_cat_a']) && $product['sale_price_cat_a'] != "") ? $product['sale_price_cat_a'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="sale_price_cat_b" class="control-label"><?php echo _l('vendor_product_add_sale_cat_b'); ?></label>
                                    <input type="text" id="sale_price_cat_b" name="sale_price_cat_b" class="form-control" value="<?php echo (isset($product['sale_price_cat_b']) && $product['sale_price_cat_b'] != "") ? $product['sale_price_cat_b'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="sale_price_cat_c" class="control-label"><?php echo _l('vendor_product_add_sale_cat_c'); ?></label>
                                    <input type="text" id="sale_price_cat_c" name="sale_price_cat_c" class="form-control" value="<?php echo (isset($product['sale_price_cat_c']) && $product['sale_price_cat_c'] != "") ? $product['sale_price_cat_c'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="sale_price_cat_d" class="control-label"><?php echo _l('vendor_product_add_sale_cat_d'); ?></label>
                                    <input type="text" id="sale_price_cat_d" name="sale_price_cat_d" class="form-control" value="<?php echo (isset($product['sale_price_cat_d']) && $product['sale_price_cat_d'] != "") ? $product['sale_price_cat_d'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-6">
                                <div class="form-group">
                                    <label for="rental_price_cat_a" class="control-label"><?php echo _l('vendor_product_add_rental_cat_a'); ?></label>
                                    <input type="text" id="rental_price_cat_a" name="rental_price_cat_a" class="form-control" value="<?php echo (isset($product['rental_price_cat_a']) && $product['rental_price_cat_a'] != "") ? $product['rental_price_cat_a'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="rental_price_cat_b" class="control-label"><?php echo _l('vendor_product_add_rental_cat_b'); ?></label>
                                    <input type="text" id="rental_price_cat_b" name="rental_price_cat_b" class="form-control" value="<?php echo (isset($product['rental_price_cat_b']) && $product['rental_price_cat_b'] != "") ? $product['rental_price_cat_b'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="rental_price_cat_c" class="control-label"><?php echo _l('vendor_product_add_rental_cat_c'); ?></label>
                                    <input type="text" id="rental_price_cat_c" name="rental_price_cat_c" class="form-control" value="<?php echo (isset($product['rental_price_cat_c']) && $product['rental_price_cat_c'] != "") ? $product['rental_price_cat_c'] : "" ?>">
                                </div>

                                <div class="form-group">
                                    <label for="rental_price_cat_d" class="control-label"><?php echo _l('vendor_product_add_rental_cat_d'); ?></label>
                                    <input type="text" id="rental_price_cat_d" name="rental_price_cat_d" class="form-control" value="<?php echo (isset($product['rental_price_cat_d']) && $product['rental_price_cat_d'] != "") ? $product['rental_price_cat_d'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="damage_rate" class="control-label"><?php echo _l('component_damage_rate'); ?></label>
                                    <input type="text" id="damage_rate" name="damage_rate" class="form-control" value="<?php echo (isset($product['damage_rate']) && $product['damage_rate'] != "") ? $product['damage_rate'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="lost_rate" class="control-label"><?php echo _l('component_lost_rate'); ?></label>
                                    <input type="text" id="lost_rate" name="lost_rate" class="form-control" value="<?php echo (isset($product['lost_rate']) && $product['lost_rate'] != "") ? $product['lost_rate'] : "" ?>">
                                </div>
                            </div>

                            <div class="col-md-4">
                                <div class="form-group">
                                    <label for="repairable_rate" class="control-label"><?php echo _l('component_repairable_rate'); ?></label>
                                    <input type="text" id="repairable_rate" name="repairable_rate" class="form-control" value="<?php echo (isset($product['repairable_rate']) && $product['repairable_rate'] != "") ? $product['repairable_rate'] : "" ?>">
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
        $('#myTable tbody').append('<tr class="main" id="tr' + newaddmore + '"><td><div class="form-group"><select style="display: block !important;" class="form-control selectpicker" id="componnetid" name="componnetdata[' + newaddmore + '][componnetid]"><option value=""></option><?php
if (isset($component_data) && count($component_data) > 0) {
    foreach ($component_data as $unit_key => $component_value) {
        ?><option value="<?php echo $component_value['id'] ?>" ><?php echo $component_value['name'] ?></option><?php
    }
}
?></select></div></td><td> <div class="form-group"><input type="text" id="compqty" name="componnetdata[' + newaddmore + '][compqty]" class="form-control" ></div></td><td><div class="form-group"><input type="text" id="compdimension" name="componnetdata[' + newaddmore + '][compdimension]" class="form-control" ></div></td><td><button type="button" value="' + newaddmore + '" class="btn pull-right btn-danger" onclick="removeprocomp(' + newaddmore + ');"><i class="fa fa-remove"></i></button></td></tr>');
    });
    function removeprocomp(procompid)
    {
        $('#tr' + procompid).remove();
    }
	init_selectpicker();

    function get_product_by_category(cat_id) {
		//alert(cat_id);die();
        var html = '<option value=""></option>';
        
        if(cat_id == "") {
            $("#product_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_product_by_cat_id/' + cat_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#product_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	
	function get_subcategory_by_category(cat_id) {
        var html = '<option value=""></option>';
        
        if(cat_id == "") {
            $("#vendor_product_sub_cat_id").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }
        
        $.ajax({
            url : admin_url+'site_manager/get_subcat_by_cat_id/' + cat_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);
                    
                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#vendor_product_sub_cat_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	
	function productdata(proid)
	{
		var proid=$('#product_id').val();
		var url = admin_url + 'Vendorproduct/getproddet/';
            $.post(url,
                    {
                        proid: proid,
                    },
                    function (data, status) {
						//alert(data);
						var res=JSON.parse(data);
						$('#name').val(res.name);
						$('#productsubname').val(res.sub_name);
						$('#sac_code').val(res.sac_code);
						$('#hsn_code').val(res.hsn_code);
						$('#working_height').val(res.working_height);
						$('#tower_height').val(res.tower_height);
						$('#platform_height').val(res.platform_height);
						$('#dimensions').val(res.dimensions);
						$('#gst_id').val(res.gst_id);
						$('#unit_id').val(res.unit_id);
						$('#purchase_price').val(res.purchase_price);
						$('#weight').val(res.product_weight);
						$('#status').val(res.status);
						$('#vendor_product_description').val(res.product_description);
						$('#vendor_product_remarks').val(res.product_remarks);
						$('#sale_price_cat_a').val(res.sale_price_cat_a);
						$('#sale_price_cat_b').val(res.sale_price_cat_b);
						$('#sale_price_cat_c').val(res.sale_price_cat_c);
						$('#sale_price_cat_d').val(res.sale_price_cat_d);
						$('#rental_price_cat_a').val(res.rental_price_cat_a);
						$('#rental_price_cat_b').val(res.rental_price_cat_b);
						$('#rental_price_cat_c').val(res.rental_price_cat_c);
						$('#rental_price_cat_d').val(res.rental_price_cat_d);
						$('#damage_rate').val(res.damage_rate);
						$('#lost_rate').val(res.lost_rate);
						$('#repairable_rate').val(res.repairable_rate);
                    });	
	}
</script>
</body>
</html>

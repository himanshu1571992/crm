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
                                <h3>Reject Product</h3>
                                <hr/>
                            </div>
                                
								<div class="form-group col-md-6">
                                    <label for="product_cat_id" class="control-label"><?php echo _l('product_cat'); ?></label>
                                    <select class="form-control selectpicker" required="" onchange="get_subcategory_by_category(this.value)" data-live-search="true" id="product_cat_id" name="product_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                ?>
                                            <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product['product_cat_id']) && $product['product_cat_id'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo $pro_cat_value['name'] ?></option>
                                        <?php
                                         }
                                        }
                                        ?>
                                    </select>
                                    <input type="hidden" value="<?php echo $product['product_id']; ?>" name="product_id">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="product_sub_cat_id" class="control-label"><?php echo _l('product_sub_cat'); ?></label>
                                    <select class="form-control selectpicker" data-live-search="true" id="product_sub_cat_id" name="product_sub_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_sub_cat_data) && count($pro_sub_cat_data) > 0) {
                                            foreach ($pro_sub_cat_data as $pro_sub_cat_key => $pro_sub_cat_value) {
                                                ?>
                                            <option value="<?php echo $pro_sub_cat_value['id'] ?>" <?php echo (isset($product['product_sub_cat_id']) && $product['product_sub_cat_id'] == $pro_sub_cat_value['id']) ? 'selected' : "" ?>><?php echo $pro_sub_cat_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="parent_category_id" class="control-label">Product Parent Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="parent_category_id" name="parent_category_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($parent_category_info) && count($parent_category_info) > 0) {
                                            foreach ($parent_category_info as $parent_cat_key => $parent_cat_value) {
                                                ?>
                                            <option value="<?php echo $parent_cat_value['id'] ?>" <?php echo (isset($product['parent_category_id']) && $product['parent_category_id'] == $parent_cat_value['id']) ? 'selected' : "" ?>><?php echo $parent_cat_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                 <div class="form-group col-md-6">
                                    <label for="child_category_id" class="control-label">Product Child Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="child_category_id" name="child_category_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($child_category_info) && count($child_category_info) > 0) {
                                            foreach ($child_category_info as $child_cat_key => $child_cat_value) {
                                                ?>
                                            <option value="<?php echo $child_cat_value['id'] ?>" <?php echo (isset($product['child_category_id']) && $product['child_category_id'] == $child_cat_value['id']) ? 'selected' : "" ?>><?php echo $child_cat_value['name'] ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="productname" class="control-label"><?php echo _l('product_name'); ?>*</label>
                                    <input type="text" id="productname" name="name" required="" class="form-control" value="<?php echo (isset($product['name']) && $product['name'] != "") ? $product['name'] : "" ?>">
                                </div>

                                <div class="form-group col-md-6">
                                    <label for="productsubname" class="control-label"><?php echo 'Print Name'; ?></label>  &nbsp;&nbsp;&nbsp;&nbsp; <input type="checkbox" id="as_product" name=""> <small style="color: red;">As Product name</small>
                                    <input type="text" id="productsubname" name="sub_name" class="form-control" value="<?php echo (isset($product['sub_name']) && $product['sub_name'] != "") ? $product['sub_name'] : "" ?>">
                                </div>


                                <div class="col-md-12"><h3>Custom Product Fields</h3><hr/></div>
                                <div id="custom_field_div">
                                <?php
                                 if(!empty($field_info) && !empty($productsfield_log))
                                     {
                                    $html = '';
                                    foreach ($field_info as $row) {
                                        $required = "";
                                        $require_html = "";
                                        if($row->required == 1){
                                            $required = "required";
                                            $require_html = "<span style=\"color: red;\">*</span>";
                                        }
                                        $custom_value = $this->db->query("SELECT * FROM `tblproductsfield_log` where `product_id`='".$product['id']."' and field_id = '".$row->field_id."' ")->row()->field_value;
                                        if($row->type == 1){                            
                                            $html .= '<div class="form-group col-md-'.$row->size.'">
                                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.' </label>
                                                    <input type="text" id="'.$row->field_id.'" value="'.$custom_value.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control" value="">
                                                </div>';
                                        }else{
                                            $html .= '<div class="form-group col-md-'.$row->size.'" >
                                                    <label for="'.$row->field_id.'" class="control-label">'.$row->name.$require_html.'</label>
                                                    <textarea id="'.$row->field_id.'" name="fielddata['.$row->field_id.']" '.$required.' class="form-control">'.$custom_value.'</textarea>
                                                </div>';
                                        }
                                        }
                                         echo $html;
                                       }
                                    ?>
                                </div>
                                

                                <div class="col-md-12"><h3>Other Product Information</h3><hr/></div>
                                <div class="form-group col-md-3">
                                    <label for="unit_id" class="control-label"><?php echo _l('product_unit'); ?></label>
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

								<div class="form-group col-md-3">
                                    <label for="gst_id" class="control-label">GST Percent</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="gst_id" name="gst_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($tax_data) && count($tax_data) > 0) {
                                            foreach ($tax_data as $tax_key => $tax_value) {
                                                ?>
                                            <option value="<?php echo $tax_value['id'] ?>" <?php echo (isset($product['gst_id']) && $product['gst_id'] == $tax_value['id']) ? 'selected' : "" ?>><?php echo $tax_value['name'].' ('.$tax_value['taxrate'].') ';?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                              

                                <div class="form-group col-md-3">
                                    <label for="isOtherCharge" class="control-label">Is Other Charges</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="isOtherCharge" name="isOtherCharge">
                                        <option value="0" <?php echo (isset($product['isOtherCharge']) && $product['isOtherCharge'] == 0) ? 'selected' : "" ?>>No</option>
                                        <option value="1" <?php echo (isset($product['isOtherCharge']) && $product['isOtherCharge'] == 1) ? 'selected' : "" ?>>Yes</option>
                                       
                                    </select>
                                </div>

                                <div class="form-group col-md-3">
                                    <label for="status" class="control-label"><?php echo _l('product_status'); ?> *</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status" required="">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($product['status']) && $product['status'] == 1) ? 'selected' : "" ?>>Enabled</option>
                                        <option value="0" <?php echo (isset($product['status']) && $product['status'] == 0) ? 'selected' : "" ?>>Disable</option>
                                    </select>
                                </div>

                            <div class="col-md-12">
                                <h3><?php
                                    if (isset($product['id']))
                                        echo 'Edit Items';
                                    else
                                        echo 'Add Items';
                                    ?></h3>
                                <hr/>
                            </div>

                            <div class="table-responsive s_table">
                                <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop" id="myTable">
                                    <thead>
                                        <tr>
                                            <th width="50%" align="left">Item Name</th>
                                            <th width="5%" align="left">view</th>
                                            <th width="20%" class="qty" align="left">Qty</th>
                                            <th width="5%"  align="center"><i class="fa fa-cog"></i></th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        if (!empty($productsitems_log)) {
                                            $i = 0;
                                            foreach ($productsitems_log as $singleproductcomp) {
                                                $i++;
                                                ?>
                                                <tr class="main" id="tr<?php echo $i; ?>">
                                                    <td>
                                                        <div class="form-group">
                                                            <select class="form-control selectpicker" data-live-search="true" onchange="get_comp_det(<?php echo $i; ?>,this.value)" id="componnet_id" name="componnetdata[<?php echo $i; ?>][componnetid]">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($item_data) && count($item_data) > 0) {
                                                                    foreach ($item_data as $unit_key => $item_value) {
                                                                        ?>
                                                                    <option value="<?php echo $item_value['id'] ?>" <?php echo (isset($item_value['id']) && $singleproductcomp['item_id'] == $item_value['id']) ? 'selected' : "" ?>><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).')'; ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </td>
													<td id="view<?php echo $i; ?>"><a href="../../product_new/view/<?php echo $singleproductcomp['item_id'];?>" target="_blank">view</a></td>
                                                    <td>
                                                        <div class="form-group">
                                                            <input type="number" id="compqty" name="componnetdata[<?php echo $i; ?>][compqty]" class="form-control" value="<?php echo (isset($singleproductcomp['qty']) && $singleproductcomp['qty'] != "") ? $singleproductcomp['qty'] : "" ?>">
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
                                                            if (isset($item_data) && count($item_data) > 0) {
                                                                foreach ($item_data as $unit_key => $item_value) {
                                                                    ?>
                                                                <option value="<?php echo $item_value['id'] ?>"><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).')'; ?></option>
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
                                    <label class="label-control subHeads"><a  class="addmore" value="<?php if(!empty($productsitems_log)){ echo count($productsitems_log); }else{ echo '0'; }  ?>">Add More <i class="fa fa-plus"></i></a></label>
                                </div>


                            </div>
                            <div class="form-group col-md-12" style="margin-top: 50px;">
                                    <label for="name" class="control-label">FAQ </label>
                                    <textarea id="faq" name="faq" class="form-control tinymce"><?php echo (isset($product['faq']) && $product['faq'] != "") ? $product['faq'] : "" ?></textarea>
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
if (isset($item_data) && count($item_data) > 0) {
    foreach ($item_data as $unit_key => $item_value) {
        ?><option value="<?php echo $item_value['id'] ?>" ><?php echo $item_value['name'].' ('.get_product_category($item_value['product_cat_id']).')'; ?></option><?php
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
            $("#product_sub_cat_id").html('').html(html);
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
                $("#product_sub_cat_id").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
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
				var data=JSON.parse(res);
				$('#view'+proid).html('<a href="../view/'+data.id+'" target="_blank">view</a>');
            }
        });
	}
</script>


<script> 
    $(document).ready(function() { 
        $("#as_product").click(function() { 
            if($('#as_product').is(':checked')){
               var product_name = $("#productname").val();
                $("#productsubname").val(product_name);
            }else{
                $("#productsubname").val(' ');
            }
        }); 
    }); 
</script> 

<script type="text/javascript">
$(document).on('change', '#product_sub_cat_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_parent_categoty",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#parent_category_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>

<script type="text/javascript">
$(document).on('change', '#parent_category_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/check_bundles_entry",
        data    : {'id' : id},
        success : function(response){
            if(response != ''){
                $("#child_category_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
}); 
</script>



<!-- For Getting Custom Fields Category Wise -->
<script type="text/javascript">
$(document).on('change', '#product_cat_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 1},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 

$(document).on('change', '#product_sub_cat_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 2},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 

$(document).on('change', '#parent_category_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 3},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 

$(document).on('change', '#child_category_id', function() { 
    var id = $(this).val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 4},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 
</script>
</body>
</html>

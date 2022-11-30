<?php init_head(); ?>
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding: 25px;
  /*width: 20%;*/
  /*border-radius: 50%;*/
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}


.bill-head {
    color: #ffffff;
    font-weight: bold;
    margin-bottom: 0px;
    margin-top: 0px;
    font-size: 30px
}

.line {
    border-right: 1px grey solid
}

.bill-date {
    color: #BDBDBD
}


.red-bg {
    margin-top: 25px;
    margin-left: 0px;
    margin-right: 0px;
    background-color: #F44336;
    padding-left: 20px !important;
    padding: 25px 10px 25px 15px
}

#total {
    margin-top: 0px;
    padding-left: 7px
}

#total-label {
    margin-bottom: 0px;
    color: #ffffff;
    padding-left: 7px
}
    @media (max-width: 500px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    }    
    @media (max-width: 768px){
        .btn-bottom-toolbar {
            width: 100%;
        }
    } 
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open($this->uri->uri_string(), array('id' => 'product-form', 'class' => 'proposal-form', 'enctype' => 'multipart/form-data')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="product_cat_id" class="control-label">Product Category</label>
                                    <select class="form-control selectpicker" required="" onchange="get_subcategory_by_category(this.value)" data-live-search="true" id="product_cat_id" name="product_cat_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                            foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                                ?>
                                                <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product['product_cat_id']) && $product['product_cat_id'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_cat_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_sub_cat_id" class="control-label">Product Root Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="product_sub_cat_id" name="product_sub_cat_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="parent_category_id" class="control-label">Product Parent Category</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="parent_category_id" name="parent_category_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-12">
                                <div class="form-group col-md-4">
                                    <label for="product" class="control-label">Main Product</label>
                                    <select class="form-control selectpicker mainproductlist" onchange="check_product_standard(this.value)" required="" data-live-search="true" id="main_product" name="product_id">
                                        <option value=""></option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="product" class="control-label">Product Grade (In MM)</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="product_grade" name="product_grade_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($product_grade_list) && count($product_grade_list) > 0) {
                                            foreach ($product_grade_list as $pro_grade_value) {
                                                ?>
                                                <option value="<?php echo $pro_grade_value['id'] ?>"><?php echo cc($pro_grade_value['title'])." (".$pro_grade_value['thickness'].")"; ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="product" class="control-label">Pipe</label>
                                    <select class="form-control selectpicker" required="" data-live-search="true" id="product_pipe" name="pipe_type">
                                        <option value=""></option>
                                        <option value="1">Coil Pipe</option>
                                        <option value="2">Non Coil Pipe</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_qty" class="control-label">Product Qty</label>
                                    <input type="number" required="" id="product_qty" name="qty" class="form-control">
                                </div>
                            </div>
                        </div>
                        <div class="text-right">
                            <button class="btn btn-info" type="submit"><i class="fa fa-calculator"></i> Calculate</button>
                        </div>
                    </div>
                </div>
            </div> 
            <?php echo form_close(); ?>

        </div>
        <div class="btn-bottom-pusher"></div>
        <?php
            if (!empty($product_details)){
        ?>
        <div class="row" id="divToPrint">
<!--            <div class="col-lg-3 pull-right">
                    <div class="panel btn-info">
                        <div class="panel-heading">
                            <div class="row">
                                <div class="col-xs-6">
                                    <i class="fa fa-money fa-5x"></i>
                                </div>
                                <div class="col-xs-6 text-right">
                                    <h1 class="announcement-heading">39</h1>
                                    <p class="announcement-text">Total Product Casting Price</p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>-->
            <div class="col-md-12">
                <div class="col-lg-3 pull-right">
                    <div class="row">
                        <div class="col-md-12 red-bg" style="border-radius: 60px; margin-bottom: 15px;">
                            <a href="<?php echo admin_url("product_new/remove_all_calculator_products/"); ?>" class="bill-date _delete pull-right"> Remove All</a>
                            <p class="bill-date" id="total-label">Total Product Costing Price</p>
                            <h2 class="bill-head" id="total"><i class="fa fa-rupee"></i><?php echo $ttl_final_price; ?></h2>

                        </div>
                    </div>
                </div>
            </div>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <?php
                            foreach ($product_details as $key => $value) {
                                $material_grade = $this->db->query("SELECT * FROM `tblmaterialgrade` WHERE `id`='".$value->product_grade_id."' ")->row();
                        ?>
                        <div class="card label-info">
                            <div class="card-body ">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="col-sm-6">
                                            <h4 class="card-title">Product Information</h4>
                                            <div class="row"></div>
                                            <hr/>
                                            <div class="card label-info">
                                                <div class="card-body ">
                                                    <div class="card-text">
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Product Category</label>
                                                            <div class="col-sm-9">
                                                                <?php echo value_by_id("tblproductcategory", $value->product_category_id, "name"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Product Name</label>
                                                            <div class="col-sm-9">
                                                                <?php echo value_by_id("tblproducts", $value->product_id, "name"); ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Product Grade (In MM)</label>
                                                            <div class="col-sm-9">
                                                                <?php 
                                                                    if(!empty($material_grade)){
                                                                        echo cc($material_grade->title)." (".$material_grade->thickness.")";
                                                                    }
                                                                ?>    
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Pipe Type</label>
                                                            <div class="col-sm-9">
                                                                <?php
                                                                if ($value->pipe_type == 1) {
                                                                    echo "Coil Pipe";
                                                                } elseif ($value->pipe_type == 2) {
                                                                    echo "Non Coil Pipe";
                                                                }
                                                                ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Product Qty</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->qty; ?>
                                                            </div>
                                                        </div>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-sm-6">
                                            <h4 class="card-title col-sm-5">Costing Details</h4>
                                            <div class="row remove_div">
                                                <a href="<?php echo admin_url("product_new/delete_pro_casting/".$value->id); ?>" class="btn-sm btn-danger _delete pull-right"><i class="fa fa-close"></i> Remove</a>
                                            </div>
                                            
                                            <hr/>
                                            <div class="card label-info">
                                                <div class="card-body ">
                                                    <div class="card-text">
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Weight :</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->weight; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Total RM Cost</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->raw_material_cost; ?> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Process Cost</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->process_cost; ?> 
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Transport cost</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->transport_cost; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Loading charges</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->loading_charges; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">OHP</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->over_head_profit; ?>
                                                            </div>
                                                        </div>
                                                        <div class="form-group row">
                                                            <label for="inputPassword" class="col-sm-3 col-form-label">Final Price</label>
                                                            <div class="col-sm-9">
                                                                <?php echo $value->final_price; ?>
                                                            </div>


                                                        </div>
                                                    </div>
                                                    <p></p>
                                                </div>
                                            </div>  
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div><br>
                        <?php } ?>
                        <div class="btn-bottom-toolbar text-right">
                            <a href="<?php echo admin_url("product_new/print_pro_casting"); ?>" class="btn btn-info _delete pull-right"><i class="fa fa-print"></i> Print</a>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php }  ?>
    </div>
</div>
<?php init_tail(); ?>

<script>
    init_selectpicker();
</script>
<script type="text/javascript">     
    function PrintDiv() {    
       var divToPrint = document.getElementById('divToPrint');
       var popupWin = window.open('', '_blank', 'width=300,height=300');
       popupWin.document.open();
       $(".print_div").hide();
       $(".remove_div").hide();
       popupWin.document.write('<html><body onload="window.print()">' + divToPrint.innerHTML + '</html>');
        popupWin.document.close();
            }
 </script>
<script>
    
    function check_product_standard(product_id){

        $("#product_grade").attr("required", "");
        $("#product_pipe").attr("required", "");

        $.ajax({
            url : admin_url+'product_new/check_product_standard/' + product_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    if (res == 1){
                        $("#product_grade").removeAttr("required", "");
                        $("#product_pipe").removeAttr("required", "");
                    }
                }
            }
        });
    }
    
    function get_subcategory_by_category(cat_id) {
        var html = phtml = '<option value=""></option>';
        
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
        
        $.post(admin_url+'product_new/get_products/', {category_id: cat_id},function( data ) {
            if(data != "") {
                
                var resArr1 = $.parseJSON(data);
                $.each(resArr1, function(k, v) {
                    phtml+= '<option value="'+v.id+'">'+v.name+'</option>';
                });
            }
            $("#main_product").html('').html(phtml);
            $('.selectpicker').selectpicker('refresh');
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
    var root_cat_id = $("#product_cat_id").val();
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
    
    var phtml = '<option value=""></option>';
    $.post(admin_url+'product_new/get_products', {category_id: root_cat_id, sub_category_id: id},function( data ) {
        if(data != "") {
            
            var resArr1 = $.parseJSON(data);

            $.each(resArr1, function(k, v) {
                phtml+= '<option value="'+v.id+'">'+v.name+'</option>';
            });
        }
        $("#main_product").html('').html(phtml);
        $('.selectpicker').selectpicker('refresh');
    });
}); 
</script>

<script type="text/javascript">
$(document).on('change', '#parent_category_id', function() { 
    var id = $(this).val();
    var root_cat_id = $("#product_cat_id").val();
    var sub_cat_id = $("#product_sub_cat_id").val();
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
    
    var phtml = '<option value=""></option>';
    $.post(admin_url+'product_new/get_products', {category_id: root_cat_id, sub_cat_id: id, parent_category_id: id},function( data ) {
        if(data != "") {
            
            var resArr1 = $.parseJSON(data);

            $.each(resArr1, function(k, v) {
                phtml+= '<option value="'+v.id+'">'+v.name+'</option>';
            });
        }
        $("#main_product").html('').html(phtml);
        $('.selectpicker').selectpicker('refresh');
    });
}); 
</script>



<!-- For Getting Custom Fields Category Wise -->
<script type="text/javascript">
$(document).on('change', '#product_cat_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $("#product_sub_cat_id").html('');
    $("#parent_category_id").html('');
    $("#child_category_id").html('');
    $('.selectpicker').selectpicker('refresh');
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 1, 'p_id' : p_id},
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
    var p_id = $("#edit_product_id").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 2, 'p_id' : p_id},
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
    var p_id = $("#edit_product_id").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 3, 'p_id' : p_id},
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
    var p_id = $("#edit_product_id").val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_custom_fields",
        data    : {'id' : id, 'type' : 4, 'p_id' : p_id},
        success : function(response){
            if(response != ''){
                $("#custom_field_div").html('').html(response);
            }else{
                $("#custom_field_div").html('');
            }
        }
    })
}); 
$(document).on('change', '.productmaterial_id', function() { 
    var id = $(this).val();
    var p_id = $("#edit_product_id").val();
    $(".productmaterial_width").hide();
    $(".productmaterial_diameter").hide();
    $(".productmaterial_thickness").hide();
    if (id !=""){
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url(); ?>admin/product_new/get_productmaterial_field",
            data    : {'id' : id, 'p_id': p_id},
            success : function(response){
                $(".product_material_fields").html(response);
            }
        });
    }
    
}); 
</script>
</body>
</html>

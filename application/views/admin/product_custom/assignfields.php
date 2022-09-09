<?php init_head(); ?>

<style type="text/css">
    .btn-bottom-toolbar{
        margin: 0 0 0 -25px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
           <?php echo form_open($this->uri->uri_string(), array('id' => 'product_sub_category-form', 'class' => 'proposal-form')); ?>

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">
                        <div class="row">
                            
                            <div class="form-group col-md-6">
                                <label for="product_cat_id" class="control-label">Product Main Category <span style="color: red;">*</span></label>
                                <select class="form-control selectpicker" required="" onchange="get_subcategory_by_category(this.value)" data-live-search="true" id="product_cat_id" name="product_cat_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                        foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                            ?>
                                            <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($edit_info['product_cat_id']) && $edit_info['product_cat_id'] == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_cat_value['name']); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-6">
                                <label for="product_sub_cat_id" class="control-label">Product Root Category</label>
                                <select class="form-control selectpicker" data-live-search="true" id="product_sub_cat_id" name="product_sub_cat_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($pro_sub_cat_data) && count($pro_sub_cat_data) > 0) {
                                        foreach ($pro_sub_cat_data as $pro_sub_cat_key => $pro_sub_cat_value) {
                                            ?>
                                            <option value="<?php echo $pro_sub_cat_value['id'] ?>" <?php echo (isset($edit_info['product_sub_cat_id']) && $edit_info['product_sub_cat_id'] == $pro_sub_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_sub_cat_value['name']); ?></option>
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
                                            <option value="<?php echo $parent_cat_value['id'] ?>" <?php echo (isset($edit_info['parent_category_id']) && $edit_info['parent_category_id'] == $parent_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($parent_cat_value['name']); ?></option>
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
                                            <option value="<?php echo $child_cat_value['id'] ?>" <?php echo (isset($edit_info['child_category_id']) && $edit_info['child_category_id'] == $child_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($child_cat_value['name']); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                       


                        <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th class="text-center">S.No</th>
                                        <th>Field Name</th>
                                        <th>Type</th>
                                        <th class="text-center">Size</th>
                                        <th class="text-center">Order</th>
                                        <th class="text-center">Required</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($fields_info)){
                                        $i=1;
                                        foreach($fields_info as $row){  
                                            $field_info = '';
                                            if(!empty($edit_info)){
                                                $field_info = $this->db->query("SELECT * FROM tblproductcustomfieldscategorydata where main_id = '".$edit_info['id']."' and field_id = '".$row->id."' ")->row();
                                            }

                                            if($row->type == 1){
                                                $type = 'Input Box';
                                            }elseif($row->type == 2){
                                                $type = 'Text Box';
                                            }elseif($row->type == 3){
                                                $type = 'Drawing';
                                            }   
                                            ?>
                                            <tr>
                                                <td class="text-center"><?php echo $i;?></td>
                                                <td><?php echo cc($row->name);?></td>
                                                <td><?php echo $type; ?></td>

                                                <td class="text-center">
                                                    <input id="size_<?php echo $row->id; ?>" type="number" max="12" name="field_data[<?php echo $i; ?>][size]" value="<?php echo (!empty($field_info)) ? $field_info->size : "";?>" <?php echo (!empty($field_info) && $field_info->field_id == $row->id) ? '' : "disabled";?>>
                                                </td>    
                                                <td class="text-center">
                                                    <input id="order_<?php echo $row->id; ?>" type="number" name="field_data[<?php echo $i; ?>][field_order]" value="<?php echo (!empty($field_info)) ? $field_info->field_order : "";?>" <?php echo (!empty($field_info) && $field_info->field_id == $row->id) ? '' : "disabled";?>>
                                                </td>
                                                <td class="text-center">
                                                    <input type="checkbox" value="1" name="field_data[<?php echo $i; ?>][required]" <?php echo (!empty($field_info) && $field_info->required == 1) ? 'checked' : "";?>>
                                                </td>
                                                <td class="text-center">
                                                    <input class="action" type="checkbox" value="<?php echo $row->id; ?>" name="field_data[<?php echo $i; ?>][field_id]" <?php echo (!empty($field_info) && $field_info->field_id == $row->id) ? 'checked' : "";?>>
                                                </td>
                                              </tr>
                                            <?php
                                            $i++;
                                        }
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
                             </div>
                    </div>

                    <div class="btn-bottom-toolbar text-right">
                        <button class="btn btn-info" type="submit">
                            <?php echo 'Submit'; ?>
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

<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        
        "paging":   false
    } );
} );


</script>



<script type="text/javascript">

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

<script type="text/javascript">
    $(document).on('click', '.action', function(){ 

        var action = $(this).val();
        
        if($(this).is(':checked')){
            $("#size_"+action).prop("disabled", false);
            $("#order_"+action).prop("disabled", false);
        }else{
            $("#size_"+action).prop("disabled", true);
            $("#order_"+action).prop("disabled", true);
        }            
        
        //$("#attendance_form").submit();   
    }); 
</script> 

</body>

</html>


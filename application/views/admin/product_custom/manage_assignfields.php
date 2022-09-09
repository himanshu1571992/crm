<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> <?php if(check_permission_page(292,'create')){ ?> <a href="<?php echo admin_url('productcustom/assignfields'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Assign Field</a> <?php } ?></h4>



                    <hr class="hr-panel-heading">
                    <form method="post" enctype="multipart/form-data" action="">

                        <div class="row">
                            <div class="form-group col-md-4">
                                <label for="category_type" class="control-label">Category Type </label>
                                <select class="form-control selectpicker"  data-live-search="true" id="category_type" name="category_type">
                                    <option value="" > </option>
                                    <option value="1" <?php if(!empty($category_type) && $category_type == 1) { echo "selected"; }?> >Main Category</option>
                                    <option value="2" <?php if(!empty($category_type) && $category_type == 2) { echo "selected"; }?> >Sub Category</option>
                                    <option value="3" <?php if(!empty($category_type) && $category_type == 3) { echo "selected"; }?> >Parent Category</option>
                                    <option value="4" <?php if(!empty($category_type) && $category_type == 4) { echo "selected"; }?> >Child Category</option>
                                    
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="product_cat_id" class="control-label">Product Main Category </label>
                                <select class="form-control selectpicker" onchange="get_subcategory_by_category(this.value)" data-live-search="true" id="product_cat_id" name="product_cat_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($pro_cat_data) && count($pro_cat_data) > 0) {
                                        foreach ($pro_cat_data as $pro_cat_key => $pro_cat_value) {
                                            ?>
                                            <option value="<?php echo $pro_cat_value['id'] ?>" <?php echo (isset($product_cat_id) && $product_cat_id == $pro_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_cat_value['name']); ?></option>
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
                                    <?php
                                    if (isset($pro_sub_cat_data) && count($pro_sub_cat_data) > 0) {
                                        foreach ($pro_sub_cat_data as $pro_sub_cat_key => $pro_sub_cat_value) {
                                            ?>
                                            <option value="<?php echo $pro_sub_cat_value['id'] ?>" <?php echo (isset($product_sub_cat_id) && $product_sub_cat_id == $pro_sub_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($pro_sub_cat_value['name']); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                    <label for="parent_category_id" class="control-label">Product Parent Category</label>
                                <select class="form-control selectpicker" data-live-search="true" id="parent_category_id" name="parent_category_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($parent_category_info) && count($parent_category_info) > 0) {
                                        foreach ($parent_category_info as $parent_cat_key => $parent_cat_value) {
                                            ?>
                                            <option value="<?php echo $parent_cat_value['id'] ?>" <?php echo (isset($parent_category_id) && $parent_category_id == $parent_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($parent_cat_value['name']); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-4">
                                <label for="child_category_id" class="control-label">Product Child Category</label>
                                <select class="form-control selectpicker" data-live-search="true" id="child_category_id" name="child_category_id">
                                    <option value=""></option>
                                    <?php
                                    if (isset($child_category_info) && count($child_category_info) > 0) {
                                        foreach ($child_category_info as $child_cat_key => $child_cat_value) {
                                            ?>
                                            <option value="<?php echo $child_cat_value['id'] ?>" <?php echo (isset($child_category_id) && $child_category_id == $child_cat_value['id']) ? 'selected' : "" ?>><?php echo cc($child_cat_value['name']); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>

                            <div class="form-group col-md-2 float-right">
                                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
                            </div>

                        </div>

                        </form>

                        <br>
                    <div class="row">
                    
                        <div class="">
                            
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Category Type</th>
                                        <th>Product Category</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($fields_info)){
                                        $i=1;
                                        foreach($fields_info as $row){  
                                            $category_name = "";
                                            if($row->final_category == 1){
                                                $category_type = 'Main Category';
                                                $category_name = value_by_id('tblproductcategory',$row->final_category_id,'name');
                                            }elseif($row->final_category == 2){
                                                $category_type = 'Sub Category';
                                                $category_name = value_by_id('tblproductsubcategory',$row->final_category_id,'name');
                                            }elseif($row->final_category == 3){
                                                $category_type = 'Parent Category';
                                                $category_name = value_by_id('tblproductparentcategory',$row->final_category_id,'name');
                                            }elseif($row->final_category == 4){
                                                $category_type = 'Child  Category';
                                                $category_name = value_by_id('tblproductchildcategory',$row->final_category_id,'name');
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i++;?></td>
                                                <td><?php echo cc($category_type);?></td>
                                                <td><?php echo cc($category_name);?></td>
                                                <td><?php echo _d($row->created_date);?></td>

                                                <td class="text-center">
                                                    <?php 
                                                    if(check_permission_page(292,'edit')){
                                                    ?>
                                                        <a href="<?php echo admin_url('productcustom/assignfields/'.$row->id); ?>" class="btn btn-info" ><i class="fa fa-pencil" aria-hidden="true"></i></a>
                                                        <?php
                                                    }

                                                    /*if(check_permission_page(290,'delete')){
                                                        ?>
                                                        <a onclick="return confirm('Are you sure you want to delete this item?'); " href="<?php echo admin_url('productsubcategory/delete_child/'.$row->id); ?>" class="btn btn-danger" ><i class="fa fa-trash" aria-hidden="true"></i></a>
                                                        <?php
                                                    }else{
                                                        echo '--';
                                                    }*/
                                                    ?>
                                                    
                                                    
                                                </td>    
                                              
                                              </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                      
                                     
                                    </tbody>
                                  </table>
                            </div>
                        
                        

                               
                            </div>
                             <!-- <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
                                <?php echo _l('submit'); ?>
                            </button>
                        </div> -->
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

<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
<script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
<script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>


<script>

$(document).ready(function() {
    $('#newtable').DataTable( {
        
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4]
                }
            },
            'colvis',
        ]
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

</body>
</html>

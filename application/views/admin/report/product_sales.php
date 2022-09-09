<?php
$session_id = $this->session->userdata();
init_head();

$s_year = '';
$s_type = '';

if(!empty($year_id)){
  $s_year = $year_id;
}
if(!empty($service_type)){
  $s_type = $service_type;
}
?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">


            <div class="col-md-12">

                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?><!--  <a href="<?php echo admin_url('report/export_product_sales?year_id='.$s_year.'&service_type='.$s_type); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Excel Export</a> <a target="_blank" href="<?php echo admin_url('report/product_sales_pdf?year_id='.$s_year.'&service_type='.$s_type); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;">PDF Download</a> --></h4>

                        <hr class="hr-panel-heading">


						<form method="post" enctype="multipart/form-data" action="">
                            <div class="row">
                                <div class="form-group col-md-2">
                                    <label for="f_date" class="control-label">Category</label>
                                    <select class="form-control selectpicker" id="product_cat_id" name="category_id" data-live-search="true">
                                        <option value="" selected >--Select Category-</option>
                                        <?php
                                        if(!empty($category_list)){
                                            foreach($category_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id;?>" <?php if(!empty($category_id) && $category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="f_date" class="control-label">Sub Category</label>
                                    <select class="form-control selectpicker" id="product_sub_cat_id" name="sub_category_id" data-live-search="true">
                                        <option value="" selected >--Select Sub Category-</option>
                                        <?php
                                        if(!empty($sub_category_list)){
                                            foreach($sub_category_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id;?>" <?php if(!empty($sub_category_id) && $sub_category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="f_date" class="control-label">Parent Category</label>
                                    <select class="form-control selectpicker" id="parent_category_id" name="parent_category_id" data-live-search="true">
                                        <option value="" selected >--Select Parent Category-</option>
                                        <?php
                                        if(!empty($parent_category_list)){
                                            foreach($parent_category_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id;?>" <?php if(!empty($parent_category_id) && $parent_category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="f_date" class="control-label">Child Category</label>
                                    <select class="form-control selectpicker" id="child_category_id" name="child_category_id" data-live-search="true">
                                        <option value="" selected >--Select Child Category-</option>
                                        <?php
                                        if(!empty($child_category_list)){
                                            foreach($child_category_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id;?>" <?php if(!empty($child_category_id) && $child_category_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-4">
                                    <label for="product_id" class="control-label">Product Name</label>
                                    <select class="form-control selectpicker" id="product_id" name="product_id[]" multiple="" data-live-search="true">
                                        <?php
                                        if(!empty($product_list)){
                                            foreach($product_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id;?>" <?php if(isset($product_id) && in_array($row->id,$product_id)){echo'selected';}?> ><?php echo $row->name.product_code($row->id); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
    						<div class="row">
          						<div class="form-group col-md-2" app-field-wrapper="date">
          							<label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" required="" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; }?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
          						</div>
          						<div class="form-group col-md-2" app-field-wrapper="date">
          						    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
            						<div class="input-group date">
          						        <input id="t_date" required="" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; }?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
            						</div>
          						</div>
          						<div class="form-group col-md-2">
            						<label for="service_type" class="control-label">Service Type *</label>
            						<select class="form-control selectpicker" id="service_type" name="service_type" required="">
              							<option value="" disabled selected >--Select One-</option>
              							<option value="1" <?php if(!empty($service_type) && $service_type == 1){ echo 'selected'; } ?>>Rent</option>
              							<option value="2" <?php if(!empty($service_type) && $service_type == 2){ echo 'selected'; } ?>>Sale</option>
              							<option value="3" <?php if(!empty($service_type) && $service_type == 3){ echo 'selected'; } ?>>Rent & Sale Both</option>
            						</select>
          						</div>
                                <div class="form-group col-md-2">
            						<label for="service_type" class="control-label">Used For </label>
            						<select class="form-control selectpicker" id="used_for" name="used_for" required="">
              							<option value="" disabled selected >--Select One-</option>
              							<option value="proposal" <?php if(!empty($used_for) && $used_for == 'proposal'){ echo 'selected'; } ?>>Quote</option>
              							<option value="invoice" <?php if(!empty($used_for) && $used_for == 'invoice'){ echo 'selected'; } ?>>Invoice</option>
              							<option value="estimate" <?php if(!empty($used_for) && $used_for == 'estimate'){ echo 'selected'; } ?>>Proforma Invoice</option>
            						</select>
          						</div>
          						<div class="col-md-2">
                                    <button type="submit" style="margin-top: 26px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 26px;" class="btn btn-danger" href="">Reset</a>
                                </div>
    						</div>
						</form>
						<br>
                        <div class="row">
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th align="center">S.No</th>
                                            <th align="center">Product ID</th>
                                            <th align="center">Product Name</th>
                                            <th align="center">Quantity</th>
                                            <th align="center">Value</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                            <?php
                                                $ttl_qty = 0;
                                                $ttl_value = 0;
                                                if(!empty($product_info)){
                                                    $i=1;
                                                    foreach ($product_info as $row) {

                                                        $sale_qty = get_product_sales_quantity($f_date,$t_date,$service_type,$row->id,$used_for);
                                                        $sale_value = get_product_sales_value($f_date,$t_date,$service_type,$row->id,$used_for);

                                                        $ttl_qty += $sale_qty;
                                                        $ttl_value += $sale_value;
                                                        if($sale_qty > 0){
                                                        ?>
                                                            <tr>
                                                                <td align="center"><?php echo $i; ?></td>
                                                                <td align="center"><a target="_blank" href="<?php echo admin_url('product_new/view/'.$row->id); ?>"><?php echo "PRO - " . number_series($row->id); ?></a></td>
                                                                <td align="center"><a target="_blank" href="<?php echo admin_url('product_new/view/'.$row->id); ?>"><?php echo $row->name; ?></a></td>
                                                                <td align="center"><a target="_blank" class="btn btn-info" href="<?php echo admin_url('report/product_sales_details?f_date='.$f_date.'&t_date='.$t_date.'&service_type='.$service_type.'&product_id='.$row->id.'&used_for='.$used_for); ?>"><?php echo number_format($sale_qty, 2, '.', ''); ?></a></td>
                                                                <td align="center"><?php echo number_format($sale_value, 2, '.', ''); ?></td>
                                                            </tr>
                                                        <?php
                                                        $i++;
                                                        }

                                                    }
                                                }else{
                                                    echo '<tr><td colspan=5 align="center" ><b>Record Not Found!</b></td></tr>';
                                                }
                                            ?>
                                    </tbody>
                                        <tfoot>
                                            <tr>
                                                <th align="right" colspan="3">Total</th>
                                                <td align="center"><b><?php echo number_format($ttl_qty, 2, '.', ''); ?></b></td>
                                                <td align="center"><b><?php echo number_format($ttl_value, 2, '.', ''); ?></b></td>
                                            </tr>
                                        </tfoot>
                                </table>
                            </div>
                        </div>    
                    
                    </div>
						
                </div>


            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <?php init_tail(); ?>

</body>


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
                    columns: ':visible'
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: ':visible'
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>
<script type="text/javascript">
    $(document).on('change', '#product_cat_id', function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/product/get_sub_categoty",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#product_sub_cat_id").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#product_sub_cat_id', function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/product/get_parent_categoty",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#parent_category_id").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });
</script>

<script type="text/javascript">
    $(document).on('change', '#parent_category_id', function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/product/check_bundles_entry",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#child_category_id").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });
</script>
<script type="text/javascript">
$(document).on('change', '#product_cat_id, #product_sub_cat_id, #parent_category_id, #child_category_id', function() {
    var product_cat_id = $('#product_cat_id').val();
    var product_sub_cat_id = $('#product_sub_cat_id').val();
    var parent_category_id = $('#parent_category_id').val();
    var child_category_id = $('#child_category_id').val();
    $.ajax({
        type    : "POST",
        url     : "<?php echo base_url(); ?>admin/product/get_product",
        data    : {'product_cat_id' : product_cat_id, 'product_sub_cat_id' : product_sub_cat_id, 'parent_category_id' : parent_category_id, 'child_category_id' : child_category_id },
        success : function(response){
            if(response != ''){
                $("#product_id").html('').html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })
});
</script>

</html>

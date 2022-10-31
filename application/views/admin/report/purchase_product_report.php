<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-4"><h4 class="no-margin"> </h4></div>
                        <h4><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
                                <div class="row">
                                    <div class="col-md-12">

                                      <div class="form-group col-md-3">
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
                                        <div class="form-group col-md-3">

                                            <select class="form-control selectpicker" id="product_id" name="product_id[]" multiple="" data-live-search="true">
                                                <option value="" disabled>--Select Product-</option>
                                                <?php
                                                if (!empty($product_list)) {
                                                    foreach ($product_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($product_id) && in_array($row->id, $product_id)) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo cc($row->name) . product_code($row->id); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
                                                <option value="" selected >--Select Vendor-</option>
                                                <?php
                                                if(!empty($vendor_list)){
                                                    foreach($vendor_list as $row){
                                                        ?>
                                                        <option value="<?php echo $row->id;?>" <?php if(!empty($vendor_id) && $vendor_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group date">
                                                <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php
                                                if (isset($f_date) && !empty($f_date)) {
                                                    echo $f_date;
                                                }
                                                ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group date">
                                                <input id="t_date" placeholder="To date" name="t_date" class="form-control datepicker" value="<?php
                                                if (!empty(isset($t_date) && $t_date)) {
                                                    echo $t_date;
                                                }
                                                ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                        <div class="form-group col-md-2">
                                            <select class="form-control selectpicker" id="product_id" name="type" data-live-search="true">
                                                <option value="1" <?php echo (isset($type) && ($type == 1)) ? "selected": "selected"?> >Purchase order</option>
                                                <option value="2" <?php echo (isset($type) && ($type == 2)) ? "selected": ""?> >Purchase Invoice</option>
                                            </select>
                                        </div>
                                        <div class="col-md-3">
                                            <button type="submit" style="margin-top: 5px;" class="btn btn-info">Search</button>
                                            <a style="margin-top: 5px;" class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div>
                                </div>
                            </form>
                            <div class="col-md-12 table-responsive">
                                <hr>
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Product Name</th>
                                            <th>Product ID</th>
                                            <th>Product Category</th>
                                            <th>Division</th>
                                            <th>Sub Division</th>
                                            <th>Product Qty</th>
                                            <th>Avg. Rate</th>
                                            <th>Min Qty</th>
                                            <th>Max Qty</th>
                                            <th>Purchase Qty As Per Year</th>
                                            <th>Purchase Qty As Per Months</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            
                                            if (!empty($purchase_product_list)) {
                                                foreach ($purchase_product_list as $key => $value) {
                                                    
                                                    $f_date = (isset($f_date) && !empty($f_date)) ? $f_date : "";
                                                    $t_date = (isset($t_date) && !empty($t_date)) ? $t_date : "";
                                                    $vendor_id = (isset($vendor_id) && !empty($vendor_id)) ? $vendor_id : "";

                                                    $diff = abs(strtotime(db_date($f_date)) - strtotime(db_date($t_date)));
                                                    $years = floor($diff / (365*60*60*24))+1;


                                                    //New Code for month calculation
                                                    $ts1 = strtotime(db_date($f_date));
                                                    $ts2 = strtotime(db_date($t_date));

                                                    $year1 = date('Y', $ts1);
                                                    $year2 = date('Y', $ts2);

                                                    $month1 = date('m', $ts1);
                                                    $month2 = date('m', $ts2);

                                                    $months = (($year2 - $year1) * 12) + ($month2 - $month1);
                                                    $months += 1;


                                                    //$months = floor(($diff - $years * 365*60*60*24) / (30*60*60*24))+1;
                                                    $purchaseqtyasyear = ($value->total_qty/abs($years));
                                                    $purchaseqtyasmonth = ($value->total_qty/abs($months));
                                                    $avg_rate = ($value->ttl_price/$value->ttlproductrow);
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo (!empty($value->product_name)) ? cc($value->product_name) : "--"; ?></td>
                                                    <td><?php echo 'PRO-'.$value->product_id; ?></td>
                                                    <td><span class="badge badge-info"><?php echo cc(get_product_category($value->product_cat_id)); ?></span></td>
                                                    <td><?php echo ($value->division_id > 0) ? value_by_id("tbldivisionmaster",$value->division_id, "title") : "--";?></td>
                                                    <td><?php echo ($value->sub_division_id > 0) ? value_by_id("tblsubdivisionmaster",$value->sub_division_id, "title") : "--";?></td>
                                                    <td><?php echo "<a target='_blank' href='".admin_url("report/get_purchaseorder_list?product_id=".$value->product_id)."&vendor_id=".$vendor_id."&f_date=".$f_date."&t_date=".$t_date."&type=".$type."'><span class='label label-success'>".number_format($value->total_qty, 2, '.', ',')."</span></a>"; ?></td>
                                                    <td><?php echo number_format($avg_rate, 2, '.', ','); ?></td>
                                                    <td><?php echo $value->min_qty; ?></td>
                                                    <td><?php echo $value->max_qty; ?></td>
                                                    <td><?php echo round($purchaseqtyasyear); ?></td>
                                                    <td><?php echo round($purchaseqtyasmonth); ?></td>
                                                </tr>
                                        <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="12"><h5>Record Not Found</h5></td></tr>';
                                            }
                                        ?>
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
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

        "iDisplayLength": 25,
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
                    columns: ':visible'
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
    $(document).on('change', '#product_cat_id, #product_sub_cat_id, #parent_category_id, #child_category_id', function () {
        var product_cat_id = $('#product_cat_id').val();
        var product_sub_cat_id = $('#product_sub_cat_id').val();
        var parent_category_id = $('#parent_category_id').val();
        var child_category_id = $('#child_category_id').val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url(); ?>admin/product/get_product",
            data: {'product_cat_id': product_cat_id, 'product_sub_cat_id': product_sub_cat_id, 'parent_category_id': parent_category_id, 'child_category_id': child_category_id},
            success: function (response) {
                if (response != '') {
                    $("#product_id").html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });
</script>

</body>

</html>

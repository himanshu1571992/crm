

<?php init_head(); ?>

<div id="wrapper" class="customer_profile">

    <div class="content">

        <div class="row">

            <div class="col-md-2">

                <div class="panel_s mbot5">

                    <div class="panel-body padding-10">

                        <h4 class="bold">Challan Product Report</h4>

                    </div>

                </div>

                <?php echo prodcutwise_report_tab('challan_product_report'); ?>

            </div>
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-4"><h4 class="no-margin"> </h4></div>  
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
                                <div class="row">
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="product_cat_id" name="category_id" data-live-search="true">
                                                <option value="" selected >--Select Category-</option>
                                                <?php
                                                if (!empty($category_list)) {
                                                    foreach ($category_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($category_id) && $category_id == $row->id) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo cc($row->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="product_sub_cat_id" name="sub_category_id" data-live-search="true">
                                                <option value="" selected >--Select Sub Category-</option>
                                                <?php
                                                if (!empty($sub_category_list)) {
                                                    foreach ($sub_category_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($sub_category_id) && $sub_category_id == $row->id) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo cc($row->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="parent_category_id" name="parent_category_id" data-live-search="true">
                                                <option value="" selected >--Select Parent Category-</option>
                                                <?php
                                                if (!empty($parent_category_list)) {
                                                    foreach ($parent_category_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($parent_category_id) && $parent_category_id == $row->id) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo cc($row->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="child_category_id" name="child_category_id" data-live-search="true">
                                                <option value="" selected >--Select Child Category-</option>
                                                <?php
                                                if (!empty($child_category_list)) {
                                                    foreach ($child_category_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($child_category_id) && $child_category_id == $row->id) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo cc($row->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" id="product_id" name="product_id" data-live-search="true">
                                                <option value="" selected >--Select Product-</option>
                                                <?php
                                                if (!empty($product_list)) {
                                                    foreach ($product_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($product_id) && $product_id == $row->id) {
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
                                            <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                                <option value="" selected >-Service Type-</option>
                                                <?php
                                                if (!empty($servicetype_list)) {
                                                    foreach ($servicetype_list as $row) {
                                                        ?>
                                                        <option value="<?php echo $row->id; ?>" <?php
                                                        if (!empty($service_type) && $service_type == $row->id) {
                                                            echo 'selected';
                                                        }
                                                        ?>><?php echo cc($row->name); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                            </select>
                                        </div>
                                        <div class="col-md-3">

                                            <div class="input-group date">

                                                <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php
                                                if (!empty($f_date)) {
                                                    echo $f_date;
                                                }
                                                ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                                            </div>

                                        </div>

                                        <div class="col-md-3">
                                            <div class="input-group date">
                                                <input id="t_date" placeholder="To date" name="t_date" class="form-control datepicker" value="<?php
                                                if (!empty($t_date)) {
                                                    echo $t_date;
                                                }
                                                ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div> 
                                    </div>
                                    <div class="col-md-12">
                                        <div class="form-group col-md-3">
                                            <select class="form-control selectpicker" required="" id="type" name="type" data-live-search="true">
                                                <!--<option value="1" disabled="">Main Product</option>-->
                                                <option value="1" <?php echo (!empty($type) && $type == 1) ? "selected" : ""; ?>>Main Product</option>
                                                <option value="2" <?php echo (!empty($type)) ? ($type == 2) ? "selected":"" : "selected"; ?> >Product Components</option>
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
                                            <th>Product Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!empty($challan_product_list)) {
                                                foreach ($challan_product_list as $key => $value) {
                                                    
                                                    
                                                    if (!empty($type) && $type == 1){
                                                        $qty = 0;
                                                         
                                                        $challan_info = $this->db->query("SELECT `product_json` FROM `tblchalanmst` WHERE `id` IN (".$value->challan_ids.")")->result();
                                                        if (!empty($challan_info)){
                                                            foreach ($challan_info as $challan) {
                                                               $product_json = json_decode($challan->product_json, TRUE);
                                                               if (!empty($product_json)){
                                                                   foreach ($product_json as $k => $val) {
                                                                       if($val["product_id"] == $value->component_id){
                                                                           $qty += $val["product_qty"];
                                                                       }
                                                                   }
                                                               }
                                                            }
                                                        }
                                                    }else{
                                                        $qty = $value->qty;
                                                    }
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>                                                
                                                    <td><?php echo cc($value->product_name); ?></td>
                                                    <td><?php echo "<a target='_blank' href='".admin_url("Productwise_report/get_product_challan?product_id=".$value->component_id."&challan_id=".$value->challan_ids)."&type=".$type."'><span class='label label-success'>".$qty."</span></a>"; ?></td>
                                                </tr>
                                        <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
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



    $(document).ready(function () {

        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
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
                'colvis'

            ]

        });

    });

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
                    $("#product_id").html('').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })
    });
</script>

</body>

</html>


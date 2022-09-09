<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                            <h3><?php echo $title; ?><p class="text-center text-danger"><?php echo value_by_id("tblproducts", $product_id, "name").product_code($product_id); ?></p></h3>
                                <hr/>
                            </div>

                        <div class="row">
                            <div class="col-md-12">
                                <form method="post" id="salary_form" enctype="multipart/form-data" action="">
                                    <input type="hidden" name="product_id" value="<?php echo (isset($product_id)) ? $product_id : ""; ?>">
                                    <input type="hidden" name="vendor_id" value="<?php echo (isset($vendor_id)) ? $vendor_id : ""; ?>">
                                    <div class="col-md-2">
                                        <div class="input-group date">
                                            <input id="f_date" placeholder="From date" name="f_date" class="form-control datepicker" value="<?php
                                            if (isset($f_date) && !empty($f_date)) {
                                                echo $f_date;
                                            }
                                            ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group date">
                                            <input id="t_date" placeholder="To date" name="t_date" class="form-control datepicker" value="<?php
                                            if (!empty(isset($t_date) && $t_date)) {
                                                echo $t_date;
                                            }
                                            ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <input type="hidden" name="type" value="<?php echo $type; ?>">
                                    <div class="col-md-3">
                                        <button type="submit" style="margin-top: 5px;" class="btn btn-info">Search</button>
                                        <a style="margin-top: 5px;" class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </form>
                            </div>
                            <div class="col-md-12"></div>
                            <div class="col-md-12 table-responsive">
                                <br><br>
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th><?php echo (isset($type) && $type == 2) ? 'Purchase Invoice No' : 'Purchase Order No' ?></th>
                                            <th><?php echo (isset($type) && $type == 2) ? 'Purchase Invoice Date' : 'Purchase Order Date' ?></th>
                                            <th>Vendor Name</th>
                                            <th>Price</th>
                                            <th>Unit</th>
                                            <th>Qty</th>
                                            <th>Unit 2</th>
                                            <th>Qty 2</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $total_qty = $total_price = 0.00;
                                        if (!empty($purchaseorder_list)) {
                                            foreach ($purchaseorder_list as $key => $value) {
                                                $total_qty += $value->qty;
                                                $total_price += $value->price;
                                                if($type == 2){
                                                    $po_number = 'Inv-'.str_pad($value->invoice_id, 4, '0', STR_PAD_LEFT);
                                                    $unit_id = value_by_id_empty('tblproducts', $value->product_id, 'unit_2');
                                                    $pdf_url = admin_url('purchase/purchase_invoice_pdf/' . $value->invoice_id);
                                                    $po_id = $value->po_id;
                                                }else{
                                                    $po_number = (is_numeric($value->po_number)) ? 'PO-' . $value->po_number : $value->po_number;
                                                    if ($value->is_temp == 0) {
                                                        $unit_id = ($value->unit_id > 0) ? $value->unit_id : value_by_id_empty('tblproducts', $value->product_id, 'unit_2');
                                                    } else {
                                                        $unit_id = ($value->unit_id > 0) ? $value->unit_id : value_by_id_empty('tbltemperoryproduct', $value->product_id, 'unit');
                                                    }
                                                    $pdf_url = admin_url('purchase/download_pdf/' . $value->po_id);
                                                    $po_id = $value->po_id;
                                                }

                                                $qty2data = $this->db->query("SELECT SUM(mb.qty) as qty2 FROM `tblmaterialreceipt` as mr LEFT JOIN `tblmanufacture` as m ON mr.id = m.mr_id LEFT JOIN `tblmanufactureproductbundles` as mb ON m.id = mb.m_id WHERE mr.extrusion = 1 AND mr.status = 1 AND m.status = 1 AND mr.po_id = '".$po_id."' ")->row();

                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><a target="_blank" href="<?php echo $pdf_url; ?>" target="_blank"><?php echo $po_number; ?></a></td>
                                                    <td><?php echo _d($value->date); ?></td>
                                                    <td><?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name'));?></td>
                                                    <td><?php echo $value->price; ?></td>
                                                    <td><?php echo value_by_id('tblunitmaster', $unit_id, 'name'); ?></td>
                                                    <td><?php echo $value->qty; ?></td>
                                                    <td><?php echo (!empty($qty2data->qty2) && $qty2data->qty2 > 0) ? "Kg" : '--'; ?></td>
                                                    <td><?php echo (!empty($qty2data->qty2) && $qty2data->qty2 > 0) ? $qty2data->qty2 : '--'; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        } else {
                                            echo '<tr><td class="text-center" colspan="9"><h5>Record Not Found</h5></td></tr>';
                                        }
                                        ?>
                                    <tfoot>
                                        <td colspan="3" ><span class="pull-right" style="font-size: 20px;">Total </span></td>
                                        <td><p style="font-size: 20px;"></p></td>
                                        <td><p style="font-size: 18px;"></p></td>
                                        <td><p style="font-size: 15px;"></p></td>
                                        <td><p style="font-size: 15px;"></p></td>
                                        <td><p style="font-size: 20px;"><?php echo number_format($total_qty, 2); ?></p></td>
                                        <td><p style="font-size: 15px;"></p></td>
                                    </tfoot>
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

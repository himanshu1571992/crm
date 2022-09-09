<?php init_head(); ?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="col-md-12">
                                <h3><?php echo $title; ?></h3>
                                <hr/>
                            </div>
                        <div class="row">
                            <div class="col-md-12 table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Challan No</th>
                                            <th>Client Name</th>
                                            <th>Qty</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $total_qty = 0.00;
                                            if (!empty($product_challan_list)) {
                                                foreach ($product_challan_list as $key => $value) {
                                                    if (!isset($value->deleverable_qty)){
                                                        $total_qty += 0;
                                                        $product_qty = 0;
                                                        $product_json = json_decode($value->product_json, TRUE);
                                                        if (!empty($product_json)){
                                                            foreach ($product_json as $k => $val) {
                                                                if($val["product_id"] == $product_id){
                                                                    $product_qty += $val["product_qty"];
                                                                    $total_qty += $val["product_qty"];
                                                                }
                                                            }
                                                        }
                                                    }else{
                                                        $total_qty += $value->deleverable_qty;
                                                        $product_qty = $value->deleverable_qty;
                                                    }
                                                    
                                                    $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                                        ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><a target="_blank" href="<?php echo admin_url('chalan/pdf/'.$value->id);?>" target="_blank"><?php echo $value->chalanno; ?></a></td>
                                                    <td><a target="_blank" href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                    <td><?php echo $product_qty; ?></td>
                                                    
                                                </tr>
                                        <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="3"><h5>Record Not Found</h5></td></tr>';
                                            }
                                        ?>
                                    <tfoot>
                                    <td colspan="3" ><span class="pull-right">Total Qty</span></td>
                                        <td><p style="font-size: 15px;"><?php echo $total_qty; ?></p></td>
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


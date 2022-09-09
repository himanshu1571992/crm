<?php init_head(); ?>
<style>
    .badge-warning{
        background-color: #ff6f00;
    }

    .badge-success{
        background-color: #97cd4c;
    }
</style>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h3><?php echo $title; ?></h3>
                                    <hr/>
                            </div>
                            <div class="col-md-12 table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th width="15%">Proforma Invoice</th>
                                            <th width="15%">Proforma Challan</th>
                                            <th width="15%">Invoice</th>
                                            <th>Payment Status</th>
                                            <th width="15%">Challan</th>
                                            <th>Order Confirmation Date</th>
                                            <th>Production Expected Compelted Date</th>
                                            <th>Production Status</th>
                                            <th>Delivery Status</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $i = 1;
                                        if (!empty($under_execution_list)) {
                                            foreach ($under_execution_list as $value) {
                                                
                                                $show_row = 1;
                                                $delivery_ho = $pickup_ho = array();
                                                $service_type = value_by_id("tblestimates", $value->estimate_id, "service_type");
                                                $challan_info = $this->db->query("SELECT * FROM `tblchalanmst` WHERE (`rel_id`='".$value->estimate_id."' OR `rel_id`='".$value->proformachallan_id."') order by id desc ")->row();
                                                if (!empty($challan_info)){
                                                    $challanlink = '<a target="_blank" href="' . admin_url('chalan/pdf/' . $challan_info->id). '" >' .$challan_info->chalanno. '</a>';
                                                    
                                                    $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$challan_info->id."' and `for` = 1 ")->row();
                                                    $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$challan_info->id."' and `for` = 2 ")->row();
                                                    if($challan_info->process == 1 && $challan_info->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 0){
                                                        $show_row = 0; // Mark Delivery Complete
                                                    }elseif($challan_info->process == 1 && $challan_info->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $service_type == 2){
                                                        $show_row = 0; // Completed
                                                    }elseif($challan_info->process == 2 && $challan_info->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){
                                                        $show_row = 0; // Mark Pick Complete
                                                    }elseif($challan_info->process == 2 && $challan_info->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                                        $show_row = 0; // Completed
                                                    }
                                                }else{
                                                    $challanlink = '<span class="btn-sm btn-warning">Pending</span>';
                                                }
                                                if ($show_row > 0){
                                                    
                                                    $proformachallan_number = ($value->proformachallan_id > 0) ? '<a target="_blank" href="' . admin_url('estimates/proformachallan_download_pdf/' . $value->proformachallan_id). '" >' .'PC-'.sprintf("%'.05d\n", $value->proformachallan_id). '</a>':'<span class="badge badge-warning">Not Created</span>';
                                                    $invoice_info = $this->db->query("SELECT `id`,`number`,`status` from `tblinvoices` where estimate_id = '".$value->estimate_id."'")->result();
                                                    $invoice_data = $invoice_status = "";
                                                    if (!empty($invoice_info)){
                                                        
                                                        foreach ($invoice_info as $invoice) {
                                                            $invoice_data .= '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $invoice->id). '" >' .$invoice->number. '</a><br>';
                                                            $invoice_status .= format_invoice_status($invoice->status);
                                                        }
                                                    }

                                                    $invoice_number = ($invoice_data != "") ? $invoice_data :'<span class="btn-sm btn-warning">Pending</span>';
                                                    $invoice_status = ($invoice_status != "") ? $invoice_status :'<span class="btn-sm btn-warning">Pending</span>';
                                                    
                                                    $expected_complete_date = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "--";
                                                    $pro_status = '<span class="label label-warning">Pending</span>';
                                                    if ($value->order_status_id > 0){
                                                        $pro_status = '<span class="label label-success">'.value_by_id("tblconfirmorderstatus", $value->order_status_id, "title").'</span>';
                                                    }
                                                
                                        ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->estimate_id) . '" >' . format_estimate_number($value->estimate_id) . '</a>'; ?></td>
                                                        <td><?php echo $proformachallan_number; ?></td>
                                                        <td><?php echo $invoice_number; ?></td>
                                                        <td><?php echo $invoice_status; ?></td>
                                                        <td><?php echo $challanlink; ?></td>
                                                        <td><?php echo date("d/m/Y", strtotime($value->created_at)); ?></td>
                                                        <td><?php echo $expected_complete_date; ?></td>
                                                        <td><?php echo $pro_status; ?></td>
                                                        <td>
                                                            <?php
                                                            if (!empty($challan_info) && $challan_info->approve_status == 1){
                                                                
                                                                if(!empty($delivery_ho)){
                                                                    echo '<button value="'.$challan_info->id.'" val="1" type="button" class="label label-info handover" data-toggle="modal" data-target="#handover_modal">Delivery HO</button>';
                                                                }
                                                                if(!empty($pickup_ho)){
                                                                    echo '<button value="'.$challan_info->id.'" val="2" type="button" class="label label-info handover" data-toggle="modal" data-target="#handover_modal">Pickup HO</button>';
                                                                }
                                                                if($challan_info->process == 0){
                                                                    echo '<button value="'.$challan_info->id.'" orderid="'.$value->id.'" title="Make Delivery" type="button" val="1" class="label label-success action" data-toggle="modal" data-target="#deliveryModal">Delivery</button>';
                                                                }elseif($challan_info->process == 1 && $challan_info->under_process == 1){
                                                                    echo '<button disabled type="button" class="label label-success">Delivery In Process</button>';
                                                                }elseif($challan_info->process == 1 && $challan_info->under_process == 0 && $challan_info->complete == 1 && $delivery_ho->final_complete == 1){
                                                                    echo '<button value="'.$challan_info->id.'" orderid="'.$value->id.'" title="Make Pickup" type="button" val="2" class="label label-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button>';
                                                                }elseif($challan_info->process == 2 && $challan_info->under_process == 1){
                                                                    echo '<button disabled type="button" class="label label-success">Pickup In Process</button>';
                                                                }
                                                            }else{
                                                                echo '<span class="label label-warning">Pending</span>';
                                                            }
                                                            ?>
                                                        </td>
                                                    </tr>
                                        <?php            
                                                }
                                            }
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

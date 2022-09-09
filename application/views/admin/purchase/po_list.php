
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6"><h4><?php echo $title; ?> </h4></div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                            </div>
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th width="1%">S.No</th>
                                            <th width="25%">PO No.</th>
                                            <th>PO Date</th>
                                            <th>Supplier</th>
                                            <th>PO Amount</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        $ttl_amount = 0;
                                        if(!empty($po_data)){
                                            foreach ($po_data as $key => $row) {
                                                $ttl_amount += $row->totalamount;
                                                $po_number = (is_numeric($row->number)) ? 'PO-' . $row->number : $row->number;
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><a title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>"><?php echo $po_number; ?></a></td>
                                            <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                            <td><?php echo cc(value_by_id('tblvendor', $row->vendor_id, 'name')); ?></td>
                                            <td><?php echo $row->totalamount; ?></td>
                                        </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan='4' style="text-align:center;font-size:20px;">Total</td>
                                            <td class="text-danger" style="font-size:20px;"><?php echo number_format($ttl_amount, 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="upload_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title upload_title">Material Receipt Uploads</h4>
            </div>
            <div class="modal-body upload_data">
<!--                <div id="upload_data">

                </div>-->
            </div>
        </div>

    </div>
</div>
<div id="upload_invoice_modal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title upload_title">Invoices Uploads</h4>
            </div>
            <div class="modal-body">
                <div id="upload_invoice_data">

                </div>
                <form action="<?php echo admin_url('purchase/invoice_uploads'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                            <input type="file" id="file" multiple="" name="file[]" style="width: 100%;height: auto;padding: 10px 15px;">
                        </div>
                        <input type="hidden" id="invoice_id" name="invoice_id">
                    </div>
                    <div class="text-right">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>  
                </form>
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
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [10, 25, 50, -1],
            ['10 rows', '25 rows', '50 rows', 'Show all']
        ],
        buttons: [     
            'pageLength',      
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            'colvis'
        ]
    } );
} );
</script>
<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var mr_ids = $(this).data("mr_id");
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_invoice_mr_uploads_data'); ?>",
            data: {'mr_ids': mr_ids},
            success: function (response) {
                if (response != '') {
                    $('.upload_data').html(response);
                }
            }
        })

    });
</script>
<script type="text/javascript">
    $(document).on('click', '.upload_invoices', function () {

        var id = $(this).data("id");
        $("#invoice_id").val(id);
        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_invoice_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $('#upload_invoice_data').html(response);
                }
            }
        })

    });
</script>
</body>
</html>

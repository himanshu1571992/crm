
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
                                <div class="form-group col-md-3">
                                    <label for="vendor_id" class="control-label">Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value->id; ?>" <?php echo (!empty($vendor_id) && $vendor_id == $vendor_value->id) ? 'selected':''; ?>><?php echo cc($vendor_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-3">
                                    <label for="confirmation" class="control-label">Confirmation</label>   
                                    <select class="form-control selectpicker" name="confirmation_id" data-live-search="true" id="confirmation_id">
                                        <option value=""></option>
                                        <option value="0" <?php echo (isset($confirmation_id) && $confirmation_id == 0) ? 'selected=""':''; ?>>Pending</option>
                                        <option value="1" <?php echo (isset($confirmation_id) && $confirmation_id == 1) ? 'selected=""':''; ?>>Received</option>
                                        <option value="2" <?php echo (isset($confirmation_id) && $confirmation_id == 2) ? 'selected=""':''; ?>>Not Received</option>
                                    </select>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive"> 
                            <hr>                                                            
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th width="1%">S.No</th>
                                            <th>Added By</th>
                                            <th>PO.No</th>
                                            <th>Vendor</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Confirmation</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(!empty($refund_payment_list)){
                                            foreach ($refund_payment_list as $key => $row) {
                                                $ponumber = value_by_id("tblpurchaseorder", $row->po_id, 'number');
                                                $vendor_id = value_by_id("tblpurchaseorder", $row->po_id, 'vendor_id');
                                                $po_number = (is_numeric($ponumber)) ? 'PO-' . $ponumber : $ponumber;
                                               
                                                if ($row->account_confirmation == 1){
                                                    $confirmation = "<a href='javascript:void(0);' class='confirmation-details-div' data-id='" . $row->id . "' ><span class='btn-sm btn-success'>Received</span></a>";
                                                }else if ($row->account_confirmation == 2){
                                                    $confirmation = "<a href='javascript:void(0);' class='confirmation-details-div' data-id='" . $row->id . "' ><span class='btn-sm btn-danger'>Not Received</span></a>";
                                                }else {
                                                    $confirmation = "<a href='javascript:void(0);' class='confirmationdiv' data-id='" . $row->id . "' ><span class='btn-sm btn-warning'>Pending</span></a>";
                                                }
                                                
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo get_employee_name($row->added_by); ?></td>
                                            <td><a title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->po_id); ?>"><?php echo $po_number; ?></a></td>
                                            <td><?php echo cc(value_by_id('tblvendor', $vendor_id, 'name')); ?></td>
                                            <td><?php echo _d($row->created_date); ?></td>
                                            <td><?php echo $row->amount; ?></td>
                                            <td><?php echo $confirmation; ?></td>
                                        </tr>
                                    <?php
                                            }
                                        }
                                    ?>
                                    </tbody>
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
<div id="confirmationModal" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg" >
        <!-- Modal content-->
        <div class="modal-content" id="confirmation_html">
            
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
    $(document).on('change', '#payment_mode', function() {
        var payemt_mode = $(this).val();
        if(payemt_mode == 1){
            $('#cheque_div').show();
        }else{
            $('#cheque_div').hide();
        }
    });
    $(document).on('click', '.confirmationdiv', function() {
        var refund_id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/refund_confirmation'); ?>",
            data: {'refund_id': refund_id},
            success: function (response) {
                if (response != '') {
                    $("#confirmation_html").html(response);
                    $("#confirmationModal").modal("show");
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });
    $(document).on('click', '.confirmation-details-div', function() {
        var refund_id = $(this).data("id");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/refund_confirmation_details'); ?>",
            data: {'refund_id': refund_id},
            success: function (response) {
                if (response != '') {
                    $("#confirmation_html").html(response);
                    $("#confirmationModal").modal("show");
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });
    
    $("#paymenttype").on("change", function(){
        var paytype = $(this).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/invoice_payments/get_paymenttype_bank'); ?>",
            data    : {'paytype' : paytype},
            success : function(response){
                if(response != ''){
                    $('#bank_id').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
    });

} );

</script>

</body>
</html>

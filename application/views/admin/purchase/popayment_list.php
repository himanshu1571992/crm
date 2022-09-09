
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
                                            <th>Added By</th>
                                            <th>PO No.</th>
                                            <th>Vendor</th>
                                            <th>Date</th>
                                            <th>Approve Amount</th>
                                            <th>Payment By</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if(!empty($po_data)){
                                            foreach ($po_data as $key => $row) {
                                                $ponumber = value_by_id("tblpurchaseorder", $row->po_id, 'number');
                                                $vendor_id = value_by_id("tblpurchaseorder", $row->po_id, 'vendor_id');
                                                $po_number = (is_numeric($ponumber)) ? 'PO-' . $ponumber : $ponumber;
                                                $payment_by = "";
                                                if ($row->payment_by == 1){
                                                    $payment_by = "<span class='label label-primary'>Direct Payment</span>";
                                                }elseif($row->payment_by == 2){
                                                    $payment_by = "<span class='label label-info'>Petty Cash</span>";
                                                }elseif($row->payment_by == 3){
                                                    $payment_by = "<span class='label label-success'>Debit Note</span>";
                                                }elseif($row->payment_by == 4){
                                                    $payment_by = "<span class='label label-warning'>Payment Adjustment</span>";
                                                }
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo get_employee_name($row->staff_id); ?></td>
                                            <td><a title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->po_id); ?>"><?php echo $po_number; ?></a></td>
                                            <td><?php echo cc(value_by_id('tblvendor', $vendor_id, 'name')); ?></td>
                                            <td><?php echo _d($row->created_at); ?></td>
                                            <td><?php echo $row->approved_amount; ?></td>
                                            <td><?php echo $payment_by; ?></td>
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

</body>
</html>

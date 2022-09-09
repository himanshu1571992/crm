
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
                                <br>
                                <form method="post" id="salary_form" enctype="multipart/form-data" action="">
                                    <div class="col-md-3">
                                        <div class="form-group select-placeholder">
                                            <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                                                <option value=""></option>
                                                <option value="2" <?php echo (!empty($range) && $range == 2) ? 'selected' : ''; ?>>Weekly</option>
                                                <option value="3" <?php echo (!empty($range) && $range == 3) ? 'selected' : ''; ?>>Monthly</option>
                                                <option value="4" <?php echo (!empty($range) && $range == 4) ? 'selected' : ''; ?>>Quarterly</option>
                                                <option value="5" <?php echo (!empty($range) && $range == 5) ? 'selected' : ''; ?>>Yearly</option>
                                                <option value="period" <?php echo (!empty($range) && $range == 'period') ? 'selected' : ''; ?>>Custom Date</option>
                                            </select>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 float-right">
                                        <button class="form-control btn-info" type="submit">Search</button>
                                    </div>
                                </form>
                            </div>  
                            <div class="col-md-12 table-responsive">   
                                <h4>List of Total Payment Made</h4>           
                                <hr>
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
                                        $ttl_amount = 0;
                                        if(!empty($payment_data)){
                                            foreach ($payment_data as $key => $row) {
                                                $ttl_amount += $row->approved_amount;
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
                                    <tfoot>
                                        <tr>
                                            <td colspan='5' style="text-align:center;font-size:20px;">Total</td>
                                            <td colspan='2' class="text-danger" style="font-size:20px;"><?php echo number_format($ttl_amount, 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>

                            <div class="col-md-12 table-responsive">
                                <br>   
                                <h4>List of Total Payment Pending for Approval</h4> 
                                <hr>                                    
                                <table class="table" id="newtable1">
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
                                        $ttl_amount = 0;
                                        if(!empty($payment_pendingdata)){
                                            foreach ($payment_pendingdata as $key => $row) {
                                                $ttl_amount += $row->approved_amount;
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
                                    <tfoot>
                                        <tr>
                                            <td colspan='5' style="text-align:center;font-size:20px;">Total</td>
                                            <td colspan='2' class="text-danger" style="font-size:20px;"><?php echo number_format($ttl_amount, 2); ?></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                            <div class="col-md-12 table-responsive">   
                                <br>
                                <h4>List of Total Payments Approved but Pending for Payment</h4>     
                                <hr>                               
                                <table class="table" id="newtable2">
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
                                        $ttl_amount = 0;
                                        if(!empty($payment_approvaldata)){
                                            foreach ($payment_approvaldata as $key => $row) {
                                                $ttl_amount += $row->approved_amount;
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
                                    <tfoot>
                                        <tr>
                                            <td colspan='5' style="text-align:center;font-size:20px;">Total</td>
                                            <td colspan='2' class="text-danger" style="font-size:20px;"><?php echo number_format($ttl_amount, 2); ?></td>
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

    $('#newtable1').DataTable( {
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
    $('#newtable2').DataTable( {
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
    function render_customer_statement(){
        var val = $("#range").val();
        $(".date").hide();
        if (val == "period"){
            $(".date").show();
        }
    }
} );
</script>

</body>
</html>

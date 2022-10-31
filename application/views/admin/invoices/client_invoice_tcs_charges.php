
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?> </h4>
                                
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="text-center text-info"><h3><u><?php echo $client_name; ?></u></h3></div>
                                <div class="text-center text-info"><h4>(<?php echo $financial_year; ?>)</h4></div>
                                <hr>
                            </div>
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th width="1%">S.No</th>
                                            <th>Invoice No.</th>
                                            <th>Invoice Date</th>
                                            <th>Service Type</th>
                                            <th>Basic Amount</th>
                                            <th>TCS Charges (0.1)%</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $ttlcharges = 0;
                                            if (!empty($invoice_list)){
                                                foreach ($invoice_list as $key => $value) {
                                                    $basic_amt = ($value->total-$value->total_tax);
                                                    $tcs_amount = ($basic_amt*0.1)/100;
                                                    $ttlcharges += $tcs_amount;
                                        ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo $value->number; ?></td>
                                                        <td><?php echo _d($value->date); ?></td>
                                                        <td><?php echo ($value->service_type == 1) ? '<span class="label label-success">Rent</span>':'<span class="label label-info">Sales</span>'; ?></td>
                                                        <td><?php echo number_format($basic_amt, 2); ?></td>
                                                        <td><?php echo $tcs_amount; ?></td>
                                                        <td>
                                                            <input type="checkbox" name="tcschargedata[<?php echo $key; ?>]" value="<?php echo $value->id; ?>" checked>
                                                        </td>
                                                    </tr>
                                        <?php            
                                                }
                                            }
                                        ?>
                                    </tbody>
                                    <tfoot>
                                        <tr>
                                            <td colspan="5" class="text-center" style="font-size: 20px;">Total Changes</td>
                                            <td><input type="number" step="any" name="tcs_charges_amt" value="<?php echo $ttlcharges; ?>"></td>
                                            <td></td>
                                        </tr>
                                    </tfoot>
                                </table>
                            </div>
                        </div>
                        <?php if ($ttlcharges > 0){ ?>
                            <div class="btn-bottom-toolbar bottom-transaction text-right">
                                <button type="submit" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit" name="submit">Submit</button>
                            </div>
                        <?php } ?>
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
} );
</script>

</body>
</html>

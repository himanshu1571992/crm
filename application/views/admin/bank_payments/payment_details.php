<?php
$session_id = $this->session->userdata();
init_head();
?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <h4 style="color: red;text-align: center"><u><?php echo $party_name; ?></u></h4>
                            </div>
                        </div>
                        <br>
                        <div class="table-responsive" style="margin-bottom:30px;">
                            <table class="table" id="newtable">
                                <thead>
                                    <tr>
                                        <th>S.No</th>
                                        <th>Payment Date</th>
                                        <th>From Date - To Date</th>
                                        <th>Bank</th>
                                        <th>Amount</th>
                                        <th>Remark</th>
                                    </tr>
                                </thead>

                                <tbody class="ui-sortable">

                                    <?php
                                    $i = 1;

                                    if (!empty($payment_info)) {
                                        foreach ($payment_info as $payment) {
                                            $bank_name = value_by_id("tblbankmaster", $payment->bank_id, "name");
                                            ?>
                                            <tr>
                                                <td><?php echo $i; ?></td>
                                                <td><?php echo _d($payment->date); ?></td>
                                                <td><?php echo _d($payment->fromdate)." - "._d($payment->todate); ?></td>
                                                <td><?php echo $bank_name; ?></td>
                                                <td><?php echo $payment->amount; ?></td>
                                                <td><?php echo cc($payment->first_remark); ?></td>
                                                
                                            </tr>
                                                    <?php
                                                    $i++;
                                                }
                                            }
                                            ?>

                                </tbody>
                            </table>

                        </div>

                    </div>

                </div>

            </div>

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

<?php init_tail(); ?>



</body>





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
            "iDisplayLength": 25,
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

        });

    });

</script>





</html>


<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo site_url($this->uri->uri_string()); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?></h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="form-group col-md-3" app-field-wrapper="date">

                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>

                                    <div class="input-group date">

                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                                    </div>

                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">

                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>

                                    <div class="input-group date">

                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>

                                    </div>

                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Payment Mode</th>
                                                <th>Date</th>
                                                <th>Amount</th>
                                                <th>Bank</th>										
                                                <th>Reference</th>
                                                <th>Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>

                                            <?php
                                            if (!empty($payment_list)) {

                                                $z = 1;

                                                foreach ($payment_list as $row) {

                                                    $service_type = '--';

                                                    if ($row->payment_mode == 1) {
                                                        $payment_name = 'Cheque';
                                                    } elseif ($row->payment_mode == 2) {
                                                        $payment_name = 'NEFT';
                                                    } elseif ($row->payment_mode == 3) {
                                                        $payment_name = 'Cash';
                                                    }

                                                    $client_info = client_info($row->client_id);

                                                    if ($row->status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning btn-xs';
                                                    } elseif ($row->status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success btn-xs';
                                                    } elseif ($row->status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger btn-xs';
                                                    }
                                                    ?>																						

                                                    <tr>

                                                        <td><?php echo $z++; ?></td>
                                                        <td>
                                                            <?php 
                                                                echo get_creator_info($row->staff_id, $row->created_date);
                                                                echo $payment_name;
                                                            ?>
                                                        </td>												
                                                        <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                                        <td><?php echo $row->ttl_amt; ?></td>
                                                        <td><?php echo value_by_id("tblbankmaster", $row->bank_id, "bank_code");?></td>
                                                        <td><?php echo $row->reference_no; ?></td>


                                                        <td><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                        
                                                        <td class="text-center">
                                                            <?php if ($row->status == 1) {?>
                                                                <a target="_blank" class="btn btn-success" title="Convert" href="<?php echo admin_url('Invoice_payments/index/' . $row->id.'/suspense_account'); ?>">Convert to Receipt</a>
                                                            <?php }else{ ?>
                                                                <a class="btn btn-info" title="Edit" href="<?php echo admin_url('Invoice_payments/edit_on_account/' . $row->id); ?>">EDIT</a>
                                                            <?php } ?>
                                                                <a class="btn btn-danger _delete" title="delete" href="<?php echo admin_url('payments/suspense_receipt_delete/' . $row->id); ?>">DELETE</a>
                                                        </td>



                                                    </tr>

                                                        <?php
                                                    }
                                                } else {

                                                    echo '<tr><td class="text-center" colspan="10"><h5>Record Not Found</h5></td></tr>';
                                                }
                                                ?>





                                        </tbody>

                                    </table>

                                </div>







                            </div>





                            <div class="btn-bottom-toolbar text-right">



                            </div>

                        </div>



                    </div>

                </div>



            </form>

        </div>		

        <div class="btn-bottom-pusher"></div>

    </div>

</div>





<!-- Modal -->

<div id="statusModal" class="modal fade" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Client Payment Receipt Status</h4>

            </div>

            <div class="modal-body" id="approval_html">

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>



    </div>

</div>







<?php init_tail(); ?>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>





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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script>



    $(document).ready(function () {

        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                    }

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7, 8]

                    }

                },
                'colvis'

            ]

        });

    });

</script>



<script type="text/javascript">
    $('.status').click(function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/payments/get_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>

</body>

</html>


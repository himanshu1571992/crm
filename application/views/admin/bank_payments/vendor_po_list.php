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

                        <h4 class="no-margin"><?php echo $title; ?><a href="javascript:void(0);" data-toggle="modal" data-target="#sendquery" class="pull-right btn btn-success send_query">Send Query</a></h4>

                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                            <form method="post" enctype="multipart/form-data" action="">

                                <div class="row">
                                    <div class="form-group col-md-3" app-field-wrapper="date">
                                        <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                        <div class="input-group date">
                                            <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>

                                    <div class="form-group col-md-3" app-field-wrapper="date">
                                        <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                        <div class="input-group date">
                                            <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                        </div>
                                    </div>
                                    <div class="form-group col-md-2 float-right">
                                        <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                        <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </form>
                        </div>
                        <br>
                        <div class="col-md-12">
                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th width="25%">PO No.</th>
                                            <th>Date</th>                                        
                                            <th>Amount</th>                                        
                                            <th>Payment Percent</th>
                                            <th>MR Status</th>
                                            <th width="15%">Purchase Invoice Status</th>
                                        </tr>
                                    </thead>
                                    <tbody class="ui-sortable">
                                        <?php
                                        $i = 1;

                                        if (!empty($purchaseorder_list)) {
                                            foreach ($purchaseorder_list as $row) {

                                                $percent = get_purchase_percent($row->id, $row->totalamount);
                                                $po_number = (is_numeric($row->number)) ? 'PO-' . $row->number : $row->number;

                                                $percent_cls = "btn-info";
                                                if ($percent == 100) {
                                                    $percent_cls = "btn-success";
                                                } elseif ($percent > 100) {
                                                    $percent_cls = "btn-danger";
                                                } elseif ($percent == '0.00') {
                                                    $percent_cls = "btn-warning";
                                                }

                                                if ($row->complete == 1) {
                                                    $mr_status = '<span class="btn-sm btn-success">Completed</span>';
                                                } else {
                                                    $mr_status = '<span class="btn-sm btn-warning">Pending</span>';
                                                }

                                                $chk_purchase_invoice = $this->db->query("SELECT `id` FROM `tblpurchaseinvoice` WHERE `po_id` = '" . $row->id . "'")->row();
                                                if (!empty($chk_purchase_invoice)) {
                                                    $pi_status = "<span class='btn-success btn-sm'>Completed</span>";
                                                } else {
                                                    $pi_status = "<span class='btn-warning btn-sm'>Pending</span>";
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i; ?></td>
                                                    <td><a  title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>"><?php echo $po_number; ?></a></td>
                                                    <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                                    <td><?php echo $row->totalamount; ?></td>
                                                    <td><button type='button' class='btn-sm <?php echo $percent_cls; ?> percent' value="<?php echo $row->id; ?>" data-toggle='modal' data-target='#myModalpercent'><?php echo $percent . "%"; ?></button></td>
                                                    <td><?php echo $mr_status; ?></td>
                                                    <td><?php echo $pi_status; ?></td>
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
            </div>

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

<?php init_tail(); ?>

<div id="myModalpercent" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:900px;">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Purchase Order Payments Details</h4>
            </div>
            <div class="modal-body">
                <div id="payment_percent"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="sendquery" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <form action="<?php echo admin_url('bank_payments/send_query'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Send Query</h4>
                </div>
                <div class="modal-body" id="approval_html">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="col-md-6">
                                <label class="control-label">With Respect (Purchase Order) : </label>
                                <div class="form-group po_number">
                                    <span class="text-info">
                                        <?php 
                                            $po_no = value_by_id("tblpurchaseorder", $po_id, "number"); 
                                            echo (is_numeric($po_no)) ? 'PO-' . $po_no : $po_no;
                                        ?>
                                    </span>
                                </div>
                            </div>
                            <div class="col-md-6">
                                <label class="control-label">Vendor Name : </label>
                                <div class="form-group vendor_name">
                                    <span class="text-info"><?php echo value_by_id("tblvendor", $vendor_id, "name"); ?></span>
                                </div>
                            </div>
                        </div>
                        <div class="col-md-12">
                            <label class="control-label">Assign Parson : </label>
                            <select class="form-control selectpicker" multiple="" id="staff_id" name="staff_id[]" data-live-search="true">
                                <option value="" disabled>--Select One-</option>
                                <?php
                                if (!empty($staff_list)) {
                                    foreach ($staff_list as $staff) {
                                        ?>
                                        <option value="<?php echo $staff->staffid; ?>"><?php echo cc($staff->firstname); ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>
                        <div class="col-md-12">
                            <br>
                            <label class="control-label">Message : </label>
                            <div class="form-group">
                                <textarea class="form-control" rows="5" name="message"></textarea>
                            </div>
                        </div>
                        <input type="hidden" name="po_id" value="<?php echo $po_id; ?>">
                        <input type="hidden" name="vendor_id" value="<?php echo $vendor_id; ?>">
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                    <button class="btn btn-info" type="submit">Submit</button>
                    
                </div>
            </div>
        </form>
    </div>
</div>

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


<script type="text/javascript">
    $('.percent').click(function () {
        var po_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_payment_percent'); ?>",
            data: {'po_id': po_id},
            success: function (response) {
                if (response != '') {
                    $("#payment_percent").html(response);
                }
            }
        })
    });
</script>



</html>


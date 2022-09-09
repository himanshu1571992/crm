<?php init_head(); ?>
<style type="text/css">
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
        border: 1px solid #e8bb0b;
    }
    .btn-hold:hover {
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
        border: 1px solid brown;
    }
    .btn-brown:hover {
        background-color: brown;
        color: #fff;
    }

    .danger-row {
        background-color: #b83b3b;
        color:#fff;
    }
</style>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('purchase/receipt_list'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title;
if (check_permission_page(43, 'create')) { ?></h4>
                                    </div>
                                    <div class="col-xs-12 col-md-6 text-right">
                                        <div class="btn-group">
                                            <button type="button" class="btn btn-info text-center dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                Create Material Receipt
                                            </button>
                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                <li>
                                                    <!-- <a target="_blank" href="<?php echo admin_url('purchase/material_receipt'); ?>">Against PO</a> -->
                                                    <a target="_blank" href="<?php echo admin_url('purchase/material_receipt_cash'); ?>">Cash MR</a>
                                                    <a target="_blank" href="<?php echo admin_url('purchase/material_receipt_gas'); ?>">Gas MR</a>
                                                    <a target="_blank" href="<?php echo admin_url('purchase/against_pending_po'); ?>">Against PO (Pending)</a>
                                                    <a target="_blank" href="<?php echo admin_url('purchase/deliverychallan_return'); ?>">Delivery Challan</a>
                                                </li>
                                            </ul>
                                        </div>
<?php } ?>
                                </div>
                            </div>

                            <hr class="hr-panel-heading">

                            <div class="row">

                                <div class="form-group col-md-2">
                                    <label for="vendor_id" class="control-label">Select Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value['id']; ?>" <?php if (!empty($vendor_id) && $vendor_id == $vendor_value['id']) {
                                            echo 'selected';
                                        } ?>><?php echo cc($vendor_value['name']); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">MR Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="type">
                                        <option value=""></option>
                                        <option value="1" <?php echo (!empty($s_type) && $s_type == 1) ? 'selected' : ''; ?>>Against PO</option>
                                        <option value="2" <?php echo (!empty($s_type) && $s_type == 2) ? 'selected' : ''; ?>>Cash</option>
                                        <option value="3" <?php echo (!empty($s_type) && $s_type == 3) ? 'selected' : ''; ?>>Gas</option>
                                        <option value="4" <?php echo (!empty($s_type) && $s_type == 4) ? 'selected' : ''; ?>>Delivery Challan</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2">
                                    <label for="status" class="control-label">Lead Status</label>
                                    <select class="form-control selectpicker" data-live-search="true" name="status">
                                        <option value=""></option>
                                        <option value="0" <?php if (!empty($s_status) && $s_status == 0) {
                                            echo 'selected';
                                        } ?>>Pending</option>
                                        <option value="1" <?php if (!empty($s_status) && $s_status == 1) {
                                            echo 'selected';
                                        } ?>>Approved</option>
                                        <option value="2" <?php if (!empty($s_status) && $s_status == 2) {
                                            echo 'selected';
                                        } ?>>Rejected</option>
                                    </select>
                                </div>

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-2">
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>

                                <div class="col-md-12">
                                    <hr>
                                </div>

                                <div class="col-md-12 table-responsive">
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>MR Number</th>
                                                <th>MR Type</th>
                                                <th>PO Number</th>
                                                <th>Vendor</th>
                                                <th>Date</th>
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th>Action</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($materialreceipt_list)) {
                                                $z = 1;
                                                foreach ($materialreceipt_list as $row) {

                                                    $working_days = count_working_days($row->created_date, $row->date);
                                                    
                                                    if ($row->status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning';
                                                    } elseif ($row->status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success';
                                                    } elseif ($row->status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger';
                                                    }elseif ($row->status == 4) {
                                                        $status = 'Reconciliation';
                                                        $cls = 'btn-brown';
                                                    }elseif ($row->status == 5) {
                                                        $status = 'On Hold';
                                                        $cls = 'btn-hold';
                                                    }
                                                    $po_number = '--';
                                                    if ($row->po_id > 0) {
                                                        $purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '" . $row->po_id . "' ")->row();
                                                        $po_number = (is_numeric($purchase_info->number)) ? 'PO-' . $purchase_info->number : $purchase_info->number;
                                                    }

                                                    $edit_url = "";
                                                    if ($row->mr_for == 1) {
                                                        $type = 'Against PO';
                                                    } elseif ($row->mr_for == 2) {
                                                        $type = 'Cash';
                                                    } elseif ($row->mr_for == 3) {
                                                        $type = 'GAS';
                                                    } elseif ($row->mr_for == 4) {
                                                        $type = 'Delivery Challan';
                                                    }
                                                    ?>
                                                    <tr >
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo $z++; ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo (!empty($row->numer)) ? $row->numer : 'MR-' . $row->id; ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo $type; ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo $po_number; ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo cc(value_by_id('tblvendor', $row->vendor_id, 'name')); ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo date('d/m/Y', strtotime($row->created_date)); ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>"><?php echo '<button type="button" class="' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                        <td class="<?php echo ($working_days >= 2) ? 'danger-row':''; ?>">
                                                            <?php

                                                                $btn_title = "Upload Challan";
                                                                $btn_cls = "btn-warning";
                                                                $file_info = $this->db->query("SELECT * FROM `tblmaterialreceiptfiles` WHERE `mr_id` = '".$row->id."' ")->result();
                                                                if(!empty($file_info)){
                                                                    $btn_title = "View Challan";
                                                                    $btn_cls = "btn-success";
                                                                }
                                                                echo '<button type="button" title="Uplaod" class="btn-sm '.$btn_cls.' uplaods " value="' . $row->id . '" data-toggle="modal" data-target="#upload_modal">'.$btn_title.'</button>';

                                                            ?>
                                                            <div class="btn-group pull-right">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <?php
                                                                        if ($row->status != 1){
                                                                            $edit_url = "";
                                                                            if ($row->mr_for == 1) {
                                                                                $edit_url = admin_url('purchase/material_receipt_edit/' . $row->id);
                                                                                echo '<li><a class="tableBtn" title="Edit" target="_blank" href="'.$edit_url.'">EDIT</a></li>';
                                                                            } elseif ($row->mr_for == 2) {
                                                                                $edit_url = admin_url('purchase/mr_cash_edit/' . $row->id);
                                                                                echo '<li><a class="tableBtn" title="Edit" target="_blank" href="'.$edit_url.'">EDIT</a></li>';
                                                                            } elseif ($row->mr_for == 3) {
                                                                                $edit_url = admin_url('purchase/mr_gas_edit/' . $row->id);
                                                                                echo '<li><a class="tableBtn" title="Edit" target="_blank" href="'.$edit_url.'">EDIT</a></li>';
                                                                            }
                                                                        }
                                                                    ?>
                                                                    <li><a class="tableBtn" title="View" target="_blank" href="<?php echo admin_url('purchase/mr_details/' . $row->id); ?>">View</a></li>
                                                                    <li><a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/deletemr/' . $row->id); ?>" data-status="1">DELETE</a></li>
                                                                </ul>
                                                            </div>
                                                        </td>
                                                    </tr>
                                                <?php
                                                }
                                            } else {
                                                echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
                                            }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
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
                <h4 class="modal-title">Material Receipt Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
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
            <div class="modal-body">

                <div id="upload_data">

                </div>

                <form action="<?php echo admin_url('purchase/mr_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                    <div class="row">
                        <div class="form-group col-md-12">
                            <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                            <input type="file" id="file" multiple="" name="files[]" style="width: 100%;height: auto;padding: 10px 15px;">
                        </div>
                        <input type="hidden" id="mr_id" name="mr_id">
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


<script>

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6]
                    }
                },
                'colvis'
            ]
        });
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }



    });
</script>

<script type="text/javascript">
    $(".myselect").select2();
</script>

<script type="text/javascript">
    $('.status').click(function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/purchase/get_mr_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>


<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var id = $(this).val();
        $('#mr_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_mr_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#upload_data').html(response);
                }
            }
        })

    });
</script>

</body>
</html>

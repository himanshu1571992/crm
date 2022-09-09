<?php
$session_id = $this->session->userdata();

init_head();
?>
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
}
</style>
<div id="wrapper">

    <div class="content accounting-template">

        <div class="row">
            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?><!--  <a href="<?php echo admin_url('report/export_product_sales?year_id=' . $s_year . '&service_type=' . $s_type); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">Excel Export</a> <a target="_blank" href="<?php echo admin_url('report/product_sales_pdf?year_id=' . $s_year . '&service_type=' . $s_type); ?>" class="btn btn-info pull-right" style="margin-top:-6px; margin-right: 10px;">PDF Download</a> --></h4>



                        <hr class="hr-panel-heading">

                        <form method="post" enctype="multipart/form-data" action="">

                            <div class="row">

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">Status</label>
                                    <select class="form-control selectpicker" id="status" name="status">
                                    <option value="" disabled selected >--Select One-</option>
                                          <option value="0"<?php echo (isset($status) && $status == 0) ? 'selected' : "" ?>>Pending</option>
                                          <option value="1"<?php echo (isset($status) && $status == 1) ? 'selected' : "" ?>>Approved</option>
                                   </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="bank" class="control-label">Select Bank</label>
                                    <select class="form-control selectpicker" id="bank_id"  name="bank_id" data-live-search="true">
                                        <option value="">--Select One--</option>
                                        <?php
                                        if (!empty($bank_info)) {
                                            foreach ($bank_info as $bank_key => $bank_value) {
                                                ?>
                                                <option value="<?php echo $bank_value->id; ?>" <?php echo (!empty($bank_id) && $bank_id == $bank_value->id) ? 'selected' : ''; ?>><?php echo cc($bank_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>

                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="type" class="control-label">Type</label>
                                    <select class="form-control selectpicker" id="type" name="type">
                                        <option value="" disabled selected >--Select One-</option>
                                        <option value="CR"<?php echo (isset($type) && $type == "CR") ? 'selected' : "" ?>>Client Receipt</option>
                                        <option value="CD"<?php echo (isset($type) && $type == "CD") ? 'selected' : "" ?>>Client Deposit</option>
                                        <option value="SR"<?php echo (isset($type) && $type == "SR") ? 'selected' : "" ?>>Suspense Receipt</option>
                                   </select>
                                </div>


                                <div class="col-md-1">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                </div>
                                <div class="col-md-1">
                                    <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>

                            </div>

                        </form>

                        <br>

                        <div class="col-md-12"> 

                            <?php
                            if (is_admin() == 1) {
                                ?>
<!--                                <div class="row">
                                    <div class="col-md-12 text-center totalAmount-row">
                                        <h4 style="color: red;">Total Amount : <?php echo number_format($collection_amount, 2); ?></h4>
                                        <h4 style="color: red;">Total Count : <?php echo $row_count; ?></h4>
                                    </div>  
                                </div>-->
                                <div class="row"> 
                                    <fieldset class="scheduler-border"><br>
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                    <p id="igst_tot" style="color: red; text-align: center;"><?php echo number_format($collection_amount, 2, '.', ''); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                    <p id="igst_tot" style="color: red; text-align: center;"><?php echo $row_count; ?></p>
                                                </div>
                                            </div>

                                        </div>
                                    </fieldset> 
                                </div>
                                <?php
                            }
                            ?>  

                            <hr> 

                            <div class="table-responsive" style="margin-bottom:30px;">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th align="center">Client Name</th>
                                            <th align="center">Type</th>
                                            <th align="center">Collection Type</th>
                                            <th align="center">Bank</th>
                                            <th align="center">Payment Mode</th>
                                            <th align="center">Reference No</th>
                                            <th align="center">Date</th>
                                            <th align="center">Amount</th>
                                            <th align="center">Status</th>
                                        </tr>
                                    </thead>

                                    <tbody class="ui-sortable">

                                        <?php
                                        $i = 1;
                                        if (!empty($collection_list)) {

                                            foreach ($collection_list as $row) {

                                                $to_see = ($row->payment_mode == 1 && $row->chaque_status != 1) ? '0' : '1';

                                                if ($to_see == 1) {



                                                    $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where `userid`='" . $row->client_id . "' ")->row();
                                                    
                                                    if ($row->payment_behalf == 1) {
                                                        $payment_behalf = 'On Account';
                                                    } elseif ($row->payment_behalf == 2) {
                                                        $payment_behalf = 'Invoice';
                                                    } elseif ($row->payment_behalf == 3) {
                                                        $payment_behalf = 'Debit Note';
                                                    }else{
                                                        $payment_behalf = '--';
                                                    }

                                                    if ($row->payment_mode == 1) {
                                                        $payment_mode = 'Cheque';
                                                    } elseif ($row->payment_mode == 2) {
                                                        $payment_mode = 'NEFT';
                                                    } elseif ($row->payment_mode == 3) {
                                                        $payment_mode = 'Cash';
                                                    }
                                                    if ($row->status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success btn-xs';
                                                    } elseif ($row->status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning btn-xs';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td>
                                                            <?php if (!empty($client_info)){?>
                                                            <a href="<?php echo base_url("admin/invoices/ledger/" . $client_info->client_id) ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a>
                                                            <?php }else{
                                                                echo "--";
                                                            } ?>
                                                        </td>    
                                                        <td align="center"><?php echo ($row->is_suspense_account == 0) ? "Receipt" : "Suspense Receipt"; ?></td>
                                                        <td align="center"><?php echo $payment_behalf; ?></td>
                                                        <td align="center"><?php echo cc(value_by_id('tblbankmaster', $row->bank_id, 'name')); ?></td>
                                                        <td align="center"><?php echo $payment_mode; ?></td>
                                                        <td align="center"><?php echo (!empty($row->reference_no)) ? cc($row->reference_no) : '--'; ?></td>
                                                        <td align="center"><?php echo _d($row->date); ?></td>
                                                        <td align="center"><?php echo number_format($row->ttl_amt, 2); ?></td>
                                                        <td align="center"><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $row->id . '" data-type="CR" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                    </tr>
                                                        <?php
                                                    }
                                                }
                                            }
                                            ?>
                                            <?php
                                            
                                                if(!empty($clientdeposit_list)){
                                                    foreach ($clientdeposit_list as $value) {
                                                        
                                                        if ($value->payment_mode == 1) {
                                                            $paymentmode = 'Cheque';
                                                        } elseif ($value->payment_mode == 2) {
                                                            $paymentmode = 'NEFT';
                                                        } elseif ($value->payment_mode == 3) {
                                                            $paymentmode = 'Cash';
                                                        }

                                                        $client_info = $this->db->query("SELECT `client_branch_name` from tblclientbranch where userid =  '" . $value->client_id . "' ")->row();

                                                        if ($value->status == 0) {
                                                            $status = 'Pending';
                                                            $cls = 'btn-warning btn-xs';
                                                        } elseif ($value->status == 1) {
                                                            $status = 'Approved';
                                                            $cls = 'btn-success btn-xs';
                                                        } elseif ($value->status == 2) {
                                                            $status = 'Rejected';
                                                            $cls = 'btn-danger btn-xs';
                                                        }
                                            ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td>
                                                            <?php if (!empty($client_info)){?>
                                                            <a href="<?php echo base_url("admin/invoices/ledger/" . $value->client_id) ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a>
                                                            <?php }else{
                                                                echo "--";
                                                            } ?>
                                                        </td>
                                                        <td align="center"><?php echo "Deposit"; ?></td>
                                                        <td align="center"><?php echo ($value->on_account == 1) ? "On Account" : "--"; ?></td>
                                                        <td align="center"><?php echo cc(value_by_id('tblbankmaster', $value->bank_id, 'name')); ?></td>
                                                        <td align="center"><?php echo $paymentmode; ?></td>
                                                        <td align="center"><?php echo (!empty($value->reference_no)) ? cc($value->reference_no) : '--'; ?></td>
                                                        <td align="center"><?php echo _d($value->date); ?></td>
                                                        <td align="center"><?php echo number_format($value->ttl_amt, 2); ?></td>
                                                        <td align="center"><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $value->id . '" data-type="CD" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
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

            </div>

            <div class="btn-bottom-pusher"></div>

        </div>

    </div>

<?php init_tail(); ?>

<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Approval Status</h4>
            </div>
            <div class="modal-body" id="approval_html">
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>
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





</html>

<script type="text/javascript">
    $(document).on('change', '#client_id', function () {
        var client_id = $(this).val();

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/Invoices/get_branch'); ?>",
            data: {'client_id': client_id},
            success: function (response) {
                if (response != '') {
                    $('#client_branch').html(response);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    });
</script>
<script type="text/javascript">
    $('.status').click(function(){
        var id = $(this).val();  
        var type = $(this).data("type");  
        $.ajax({
                type    : "POST",
                url     : "<?php echo base_url('admin/report/get_status'); ?>",
                data    : {'id' : id, 'type' : type},
                success : function(response){
                        if(response != ''){
                                $("#approval_html").html(response);
                        }
                }
        })
    });
</script>

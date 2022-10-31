<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
        background: #f8f8f8;
    }
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6"><h4><?php echo $title; ?> </h4></div>
                                <div class="col-xs-12 col-md-6 text-right">
                                    <?php if(check_permission_page(402,'create')){ ?>
                                    <a href="<?php echo admin_url('client/client_refund_add'); ?>" type="submit" class="btn btn-info">Create Client Refund</a>
                                    <?php } ?>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="form-group col-md-4" id="employee_div">
                                <label for="client_id" class="control-label"><?php echo 'Client Name'; ?> *</label>
                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if (!empty($client_info)) {
                                        foreach ($client_info as $row) {
                                            ?>
                                            <option value="<?php echo $row->userid; ?>" <?php echo (isset($s_client) && $s_client == $row->userid) ? 'selected' : "" ?>><?php echo cc($row->client_branch_name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="date" class="control-label"><?php echo 'From Date'; ?></label>
                                <div class="input-group date">
                                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($sf_date) && $sf_date != "") ? $sf_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4" app-field-wrapper="date">
                                <label for="date" class="control-label"><?php echo 'To Date'; ?></label>
                                <div class="input-group date">
                                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($st_date) && $st_date != "") ? $st_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status" class="control-label">Select Status</label>
                                <select class="form-control selectpicker" data-live-search="true" name="status">
                                    <option value=""></option>
                                    <option value="0" <?php if (isset($s_status) && $s_status == 0) {
                                        echo 'selected';
                                    } ?>>Pending</option>
                                    <option value="1" <?php if (isset($s_status) && $s_status == 1) {
                                        echo 'selected';
                                    } ?>>Approved</option>
                                    <option value="2" <?php if (isset($s_status) && $s_status == 2) {
                                        echo 'selected';
                                    } ?>>Rejected</option>
                                    <option value="4" <?php if (isset($s_status) && $s_status == 4) {
                                        echo 'selected';
                                    } ?>>Reconciliation</option>
                                    <option value="5" <?php if (isset($s_status) && $s_status == 5) {
                                        echo 'selected';
                                    } ?>>ON Hold</option>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <label for="status" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" data-live-search="true" name="service_type">
                                    <option value=""></option>
                                    <!-- <option value="3" <?php echo (isset($service_type) && $service_type == 3) ? 'selected' : ''; ?>>Both</option> -->
                                    <option value="1" <?php echo (isset($service_type) && $service_type == 1) ? 'selected' : ''; ?>>Rent</option>
                                    <option value="2" <?php echo (isset($service_type) && $service_type == 2) ? 'selected' : ''; ?>>Sales</option>
                                </select>
                            </div>
                            <div class="col-md-4">
                                <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                            </div>
                        </div>
                        <hr>
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Client Name</th>
                                            <th>Service Type</th>
                                            <th>Date</th>
                                            <th>Amount</th>
                                            <th>Status</th>
                                            <th>UTR</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($table_data)) {
                                            foreach ($table_data as $key => $value) {

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
                                                } elseif ($value->status == 4) {
                                                    $status = 'Reconciliation';
                                                    $cls = 'btn-brown btn-xs';
                                                } elseif ($value->status == 5) {
                                                    $status = 'On Hold';
                                                    $cls = 'btn-hold btn-xs';
                                                }
                                                if ($value->acceptance == 0) {
                                                    $accept_status = 'Acceptance Pending';
                                                    $accept_cls = 'btn-warning';
                                                } elseif ($value->status == 1) {
                                                    $accept_status = 'Accepted';
                                                    $accept_cls = 'btn-success';
                                                }
                                                $service_type = 'Both';
                                                if ($value->service_type == 1){
                                                    $service_type = 'Rent';
                                                }else if ($value->service_type == 2){
                                                    $service_type = 'Sales';
                                                }
                                                ?>
                                                <tr>
                                                    <td>
                                                        <?php echo ++$key; ?>
                                                        
                                                    </td>
                                                    <td>
                                                        <?php echo get_creator_info($value->added_by, $value->created_at); ?>
                                                        <?php echo cc($client_info->client_branch_name); ?></td>
                                                    <td><?php echo $service_type; ?></td>
                                                    <td><?php echo date('d/m/Y', strtotime($value->date)); ?></td>
                                                    <td><?php echo $value->amount; ?></td>
                                                    <td><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $value->id . '" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                    <td>
                                                      <?php
                                                          if (!empty($value->utr_no)){
                                                             echo _d($value->utr_date) ." - <span class='btn-sm btn-success'>".$value->utr_no."</span>";
                                                          }else{
                                                             echo "<span class='label label-warning'>Pending</span>";
                                                          }
                                                      ?>
                                                    </td>
                                                    <td class="text-center">
                                                      <?php if($value->status !=1){ ?>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <?php if(check_permission_page(402,'edit')){ ?>
                                                                <li>
                                                                    <a class="" target="_blank" href="<?php echo base_url('admin/client/client_refund_add/' . $value->id); ?>" >Edit</a>
                                                                </li>
                                                            <?php }
                                                                if(check_permission_page(402,'delete')){
                                                            ?>        
                                                                <li>
                                                                    <a style="color:red" class="_delete" href="<?php echo base_url('admin/client/delete_client_refund/' . $value->id); ?>" >DELETE</a>
                                                                </li>
                                                                <?php } ?>
                                                            </ul>
                                                        </div>
                                                      <?php }else{
                                                            echo '<button type="button" class="' . $accept_cls . ' btn-sm">' . $accept_status . '</button>';
                                                      } ?>
                                                    </td>
                                                </tr>
                                    <?php
                                            }
                                        } else {
                                            echo '<tr><td class="text-center" colspan="7"><b>Record Not Found!</b></td></tr>';
                                        }
                                    ?>


                                    </tbody>
                                </table>
                            </div>


                        </div>
                        <div class="btn-bottom-toolbar text-right">
                            <button class="btn btn-info" value="1" name="mark" type="submit">
<?php echo _l('submit'); ?>
                            </button>
                        </div>
                    </div>

                </div>
            </div>

<?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="statusModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Client Refund Status</h4>
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
            lengthMenu: [
                [10, 25, 50, -1],
                ['10 rows', '25 rows', '50 rows', 'Show all']
            ],
            buttons: [
                'pageLength',
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5]
                    }
                },
                'colvis',
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
    $('.status').click(function(){
        var id = $(this).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/client/get_status'); ?>",
            data    : {'id' : id, 'type' : 'client_refund'},
            success : function(response){
                if(response != ''){
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>
</body>
</html>

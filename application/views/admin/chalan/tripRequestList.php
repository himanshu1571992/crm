
<?php init_head(); ?>
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
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

</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                        <h4 class="no-margin"><?php echo $title; ?></h4>

                        <hr class="hr-panel-heading">

                        <div class="row">

                            <div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)) ? $f_date : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="form-group col-md-3" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)) ? $t_date : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>

                                <div class="col-md-3">
                                    <div class="form-group ">
                                        <label for="status" class="control-label">Status</label>
                                        <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                            <option value="" ></option>
                                            <option value="0" <?php echo (isset($status) && $status == 0) ? "selected" : ""; ?>>Pending</option>
                                            <option value="1" <?php echo (isset($status) && $status == 1) ? "selected" : ""; ?>>Approved</option>
                                            <option value="2" <?php echo (isset($status) && $status == 2) ? "selected" : ""; ?>>Rejected</option>
                                        </select>
                                    </div>
                                </div>

                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                    <a class="btn btn-danger" style="margin-top: 24px;" href="">Reset</a>
                                </div>

                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Date</th>
                                            <th>Number</th>
                                            <th>Request Amount</th>
                                            <th>Transporter Name</th>
                                            <th>Added From</th>
                                            <th>Status</th>
                                            <th class="text-center">Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        if (!empty($booking_req_list)) {
                                            foreach ($booking_req_list as $key => $value) {

                                                    $status = 'Pending';
                                                    $cls = 'label label-warning label-outlined';
                                                if ($value->approve_status == 1) {
                                                    $status = 'Approved';
                                                    $cls = 'label label-success label-outlined';
                                                } elseif ($value->approve_status == 2) {
                                                    $status = 'Rejected';
                                                    $cls = 'label label-danger label-outlined';
                                                }
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>                                                
                                                    <td><?php echo _d($value->date); ?></td>
                                                    <td><?php echo 'TRP-REQ-'.str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                    <td><?php echo $value->final_amt; ?></td>
                                                    <td><?php echo cc($value->transporter_name); ?></td> 
                                                    <td><?php echo get_employee_fullname($value->addedfrom); ?></td> 
                                                    <td><?php echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$value->id.'" data-toggle="modal" data-target="#statusModal">'.$status.'</button>'; ?></td> 
                                                    <td class="text-center">
                                                        <a target="_blank" title="view details" href="<?php echo admin_url('Chalan/tripRequestView/' . $value->id . ''); ?>" data-status="1"><i class="fa fa-eye"></i></a>
                                                    </td>
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
</div>
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person Status</h4>
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
<script src="<?php echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                'colvis',
            ]
        });
    });
</script>

</body>
</html>

<script type="text/javascript">
    $('.status').click(function(){
        var id = $(this).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/chalan/tripRequestStatus'); ?>",
            data    : {'id' : id},
            success : function(response){
                    if(response != ''){
                            $("#approval_html").html(response);
                    }
            }
        })
    });
</script>

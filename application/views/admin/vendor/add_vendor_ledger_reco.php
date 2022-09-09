<?php init_head(); ?>
<?php
$s_range = '';
$date_a = '';
$date_b = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}

?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-2">
                <div class="panel_s mbot5">
                    <div class="panel-body padding-10">
                        <h4 class="bold"><?php echo $vendor_info->name; ?></h4>
                    </div>
                </div>
                <?php echo vendor_report_tab('ledger_reco',$vendor_info->id);?>
            </div>

            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">
                    <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'vendor-form', 'class' => '_vendor_form vendor-form')); ?>
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4>Add Ledger Reco</h4>
                            </div>
                        </div>

                        <hr class="hr-panel-heading">

                        <div class="row">
                        <div class="col-md-12">
                    <div class="col-md-6">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="from_date" name="from_date" class="form-control datepicker" value="<?php echo (isset($ledger_reco_info) && $ledger_reco_info != "") ? _d($ledger_reco_info->from_date) : ''; ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="to_date" name="to_date" class="form-control datepicker" value="<?php echo (isset($ledger_reco_info) && $ledger_reco_info != "") ? _d($ledger_reco_info->to_date) : ''; ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="upload_pdf" class="control-label">Upload PDF</label>
                            <input type="file" name="file" id="file" class="form-control" <?php echo (!isset($ledger_reco_info)) ? 'required':''; ?>>
                            <?php 
                                if (!empty($ledger_reco_info) && !empty($ledger_reco_info->file)){
                                    echo '<a target="_blank" href="'.site_url('uploads/ledger_reco/'.$ledger_reco_info->id.'/'.$ledger_reco_info->file).'">'.$ledger_reco_info->file.'</a>';
                                }
                            ?>
                        </div>
                    </div>
                </div>
                <div class="col-md-12 text-right">
                    
                    <button class="btn btn-info" type="submit">
                        <?php echo 'Submit'; ?>
                    </button>
                </div>


                        </div>
                        <?php echo form_close(); ?>

                    </div>

                </div>
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css" />
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css" />
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
    $('#newtable').DataTable({
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [{
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
            'colvis'
        ]
    });
});
</script>

</body>

</html>

<div id="myModal" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assigned Person</h4>
            </div>
            <div class="modal-body">
                <div id="approval_html"></div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>

</body>

</html>


<script type="text/javascript">
$('.status').click(function() {
    var po_id = $(this).val();

    $.ajax({
        type: "POST",
        url: "<?php echo base_url('admin/purchase/get_approval_info'); ?>",
        data: {
            'po_id': po_id
        },
        success: function(response) {
            if (response != '') {
                $("#approval_html").html(response);
            }
        }
    })
});
</script>
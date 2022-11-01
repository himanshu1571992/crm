
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6"><h4><?php echo $title;?> </h4></div>   
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <div class="form-group col-md-3">
                                    <label for="vendor" class="control-label">Vendor</label>
                                    <select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
                                        <option value="" selected >--Select Vendor-</option>
                                        <?php
                                        if(!empty($vendor_list)){
                                            foreach($vendor_list as $row){
                                                ?>
                                                <option value="<?php echo $row->id;?>" <?php if(!empty($vendor_id) && $vendor_id == $row->id){ echo 'selected'; } ?>><?php echo cc($row->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="payment_type" class="control-label">Payment Type</label>
                                    <select class="form-control selectpicker" id="payment_type" name="payment_type" data-live-search="true">
                                        <option value="1" <?php echo (isset($payment_type) && $payment_type == 1) ? 'selected':''; ?>>Purchase Order</option>
                                        <option value="2" <?php echo (isset($payment_type) && $payment_type == 2) ? 'selected':''; ?>>Transportation</option>
                                    </select>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ''; ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ''; ?>" aria-invalid="false" type="text" required><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                            <div class="col-md-12 table-responsive"> 
                            <hr>
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th width="1%">S.No.</th>
                                            <th>PO No.</th>
                                            <th>PO Date</th>
                                            <th>Vendor Name</th>
                                            <th>PO Amount</th>
                                            <th>Payment Date</th>
                                            <th width="10%">Payment Cleared Amount</th>
                                            <th width="10%">Payment Cleared On Date</th>
                                            <th>UTR</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php 
                                            $i = 1;
                                            if (!empty($vendorpayments)){
                                                foreach($vendorpayments as $payment){
                                                    $po_number = $po_date = $vendorname = $totalamount = "";
                                                    if ($payment_type == 2){
                                                        $where = "p.id IN (".$payment->document_id.")";
                                                        if (!empty($vendor_id)){
                                                            $where .= " and p.vendor_id = ".$vendor_id;
                                                        }
                                                        $po_info = $this->db->query("SELECT p.id as po_id, p.number, p.date as po_date, p.vendor_id, p.totalamount
                                                                                     FROM `tblpurchaseorder` as p WHERE ".$where." ")->result();
                                                        foreach ($po_info as $k => $value) {
                                                            
                                                            $prefix = ($k > 0) ? ',<br>' : '';
                                                            $po_no = (is_numeric($value->number)) ? $prefix.'PO-'.$value->number : $prefix.$value->number;
                                                            $po_number .= '<a href="'.admin_url('purchase/download_pdf/'.$value->po_id).'" target="_blank">'.$po_no.'</a>';
                                                            $po_date .= $prefix._d($value->po_date);
                                                            $vendorname .= $prefix.value_by_id("tblvendor", $value->vendor_id, "name");
                                                            $totalamount .= $prefix.number_format($value->totalamount, '2');
                                                        }                             
                                                    }else{
                                                        $po_no = (is_numeric($payment->number)) ? 'PO-'.$payment->number : $payment->number;
                                                        $po_number = '<a href="'.admin_url('purchase/download_pdf/'.$payment->po_id).'" target="_blank">'.$po_no.'</a>';
                                                        $po_date = _d($payment->po_date);
                                                        $vendorname = value_by_id("tblvendor", $payment->vendor_id, "name");
                                                        $totalamount = number_format($payment->totalamount, '2');
                                                    }
                                        ?>
                                                    <tr>
                                                        <td><?php echo $i++; ?></td>
                                                        <td><?php echo $po_number; ?></td>
                                                        <td><?php echo $po_date; ?></td>
                                                        <td><?php echo $vendorname; ?></td>
                                                        <td><?php echo $totalamount; ?></td>
                                                        <td><?php echo _d($payment->payment_date); ?></td>
                                                        <td><?php echo number_format($payment->cleared_amount, '2'); ?></td>
                                                        <td><?php echo (!empty($payment->utr_date)) ? _d($payment->utr_date) : 'N/a'; ?></td>
                                                        <td><?php echo ($payment->utr_no != '') ? $payment->utr_no : 'N/a'; ?></td>
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
            "iDisplayLength": 20,
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
                'colvis'
            ]
        });
    });
</script>
<script type="text/javascript">
$(document).on('click', '.seturgencytype', function() {  

    var requestid = $(this).data("requestid");
    var type = $(this).data("rtype");
    $('#request_type').val(type); 
    $('#prequest_id').val(requestid); 

    $.ajax({
        type    : "GET",
        url     : "<?php echo site_url('admin/purchase/updateUrgencyType/'); ?>"+requestid+'/'+type,
        success : function(response){
            if(response != ''){       
                $("#urgencysetModel").modal('show');
                $("#urgencytype_html").html(response);
                $('.selectpicker').selectpicker('refresh');
            }
        }
    })

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
</body>
</html>

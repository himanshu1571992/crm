
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
                            <div class="col-md-12">
                                <div class="col-md-3 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total ttlveryurgentamt">0.00</h3>
                                            <span class="staff_logged_time_text text-danger">Very Urgent</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total ttlurgentamt">0.00</h3>
                                            <span class="staff_logged_time_text text-info">Urgent</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total ttllessurgentamt">0.00</h3>
                                            <span class="staff_logged_time_text text-warning">Less Urgent</span>
                                        </div>
                                    </div>
                                </div>
                                <div class="col-md-2 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total ttlaverageamt">0.00</h3>
                                            <span class="staff_logged_time_text text-success">Average</span>
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-3 total-column">
                                    <div class="panel_s">
                                        <div class="panel-body">
                                            <h3 class="text-muted _total ttlpayment">0.00</h3>
                                            <span class="staff_logged_time_text text-success">Total</span>
                                        </div>
                                    </div>
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
                                            <th width="5%">MR Date</th>
                                            <th>Payment Type</th>
                                            <th width="15%">Supplier</th>
                                            <th width="5%">PO Amount</th>
                                            <th>Payment Percent</th>
                                            <th>Payment Status</th>
                                            <th>Requested Amount</th>
                                            <th>Warehouse/Site</th>
                                            <th width="25%">Urgency Type</th>
                                            <th width="20%">Priorities</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $z = 1;
                                            $ttl_amt = 0;
                                            $total_payment = 0;
                                            $ttlveryurgentamt = $ttlurgentamt = $ttllessurgentamt = $ttlaverageamt = 0;
                                            if (!empty($paymentrequest_list)){
                                                foreach ($paymentrequest_list as $key => $value) {
                                                    
                                                    $po_details = $this->db->query("SELECT * FROM tblpurchaseorder WHERE id IN (".$value->document_id.")")->result();
                                                    $purchase_number = $po_date = $mr_date = $poamount = '';
                                                    if (!empty($po_details)){
                                                        foreach ($po_details as $poval) {
                                                            $po_number = (is_numeric($poval->number)) ? 'PO-' . $poval->number : $poval->number;
                                                            $purchase_number .= '<a  title="View" target="_blank" href="'.admin_url('purchase/download_pdf/' . $poval->id).'">'.$po_number.'</a><br>';
                                                            $po_date .= _d($poval->date).'<br>';
                                                            $mr_info = $this->db->query("SELECT `date` FROM `tblmaterialreceipt` WHERE po_id = '".$poval->id."'")->row();
                                                            $mr_date .= (!empty($mr_info)) ? _d($mr_info->date).'<br>' : '--<br>';
                                                            $poamount .= $poval->totalamount.'<br>';

                                                        }
                                                    }

                                                    $party_name = value_by_id("tblcompanyexpenseparties", $value->id, "name");
                                                    if (!empty($value->party_name)){
                                                        $party_name = $value->party_name;
                                                    }

                                                    $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-default seturgencytype">SET URGENCY</a>';
                                                    if ($value->urgency_type > 0){
                                                        if ($value->urgency_type == '1'){
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-danger seturgencytype">Very Urgent</a>';
                                                        }else if ($value->urgency_type == '2'){
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-info seturgencytype">Urgent</a>';
                                                        }else if ($value->urgency_type == '3'){
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-warning seturgencytype">Less Urgent</a>';
                                                        }else if ($value->urgency_type == '4'){
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-success seturgencytype">Average</a>';
                                                        }
                                                    }
                                                    $priority_number = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-default seturgencytype">SET PRIORITY</a>';
                                                    if ($value->priority_number > 0){
                                                        $priority_number = '<a href="javascript:void(0);" data-requestid="'.$value->id.'" data-rtype= "transportation" class="label label-info seturgencytype">'.$value->priority_number.'</a>';
                                                    }
                                        ?>
                                                    <tr>
                                                        <td><?php echo $z++; ?></td>
                                                        <td><?php echo $purchase_number; ?></td>
                                                        <td><?php echo $po_date; ?></td>
                                                        <td><?php echo $mr_date; ?></td>
                                                        <td><?php echo 'Purchase Order'; ?></td>
                                                        <td><?php echo cc($party_name); ?></td>
                                                        <td><?php echo $poamount; ?></td>
                                                        <td>--</td>
                                                        <td>--</td>
                                                        <td><?php echo number_format($value->amount, '2'); ?></td>
                                                        <td>--</td>
                                                        <td><?php echo $urgencytype; ?></td>
                                                        <td><?php echo $priority_number; ?></td>
                                                    </tr>

                                        <?php 
                                                }
                                            }
                                            if (!empty($paymentrequest_report)){
                                                foreach ($paymentrequest_report as $key => $row) {
                                                    $po_percent = "";
                                                    $percent = get_purchase_percent($row->id, $row->totalamount);

                                                    if (!empty($payment_percent) && $payment_percent == 1 && ($percent == '0.00')) {
                                                        $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                        $po_percent = $percent;
                                                    } elseif (!empty($payment_percent) && $payment_percent == 2 && $percent == 100) {
                                                        $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                        $po_percent = $percent;
                                                    } elseif (!empty($payment_percent) && $payment_percent == 3 && $percent < 100 && $percent > 0) {
                                                        $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                        $po_percent = $percent;
                                                    } elseif (!empty($payment_percent) && $payment_percent == 4 && $percent > 100) {
                                                        $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                        $po_percent = $percent;
                                                    } elseif (empty($payment_percent)) {
                                                        $po_percent = $percent;
                                                        $ttl_amt += ($row->status != 2) ? $row->totalamount : 0;
                                                    }
                                                    
                                                    $percent_cls = "btn-info";
                                                    if ($percent == 100) {
                                                        $percent_cls = "btn-success";
                                                    } elseif ($percent > 100) {
                                                        $percent_cls = "btn-danger";
                                                    } elseif ($percent == '0.00') {
                                                        $percent_cls = "btn-warning";
                                                    }

                                                    if ($row->source_type == 1) {
                                                        $warehouse = cc(value_by_id('tblwarehouse', $row->warehouse_id, 'name'));
                                                    } else {
                                                        $warehouse = cc(value_by_id('tblsitemanager', $row->site_id, 'name'));
                                                    }
                                                    $po_number = (is_numeric($row->number)) ? 'PO-' . $row->number : $row->number;
                                                    $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-default seturgencytype">SET URGENCY</a>';
                                                    if ($row->urgency_type > 0){
                                                        if ($row->urgency_type == '1'){
                                                            $ttlveryurgentamt += $row->requested_amount;
                                                            $total_payment += $row->requested_amount;
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-danger seturgencytype">Very Urgent</a>';
                                                        }else if ($row->urgency_type == '2'){
                                                            $ttlurgentamt += $row->requested_amount;
                                                            $total_payment += $row->requested_amount;
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-info seturgencytype">Urgent</a>';
                                                        }else if ($row->urgency_type == '3'){
                                                            $ttllessurgentamt += $row->requested_amount;
                                                            $total_payment += $row->requested_amount;
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-warning seturgencytype">Less Urgent</a>';
                                                        }else if ($row->urgency_type == '4'){
                                                            $ttlaverageamt += $row->requested_amount;
                                                            $total_payment += $row->requested_amount;
                                                            $urgencytype = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-success seturgencytype">Average</a>';
                                                        }
                                                    }
                                                    $priority_number = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-default seturgencytype">SET PRIORITY</a>';
                                                    if ($row->priority_number > 0){
                                                        $priority_number = '<a href="javascript:void(0);" data-requestid="'.$row->payemnt_request_id.'" data-rtype= "payrequest" class="label label-info seturgencytype">'.$row->priority_number.'</a>';
                                                    }
                                                    $pmt_status = "<span class='badge badge-warning' style='background-color:#ff6f00;padding: 6px;' >Pending</span>";
                                                    $chk_purchase_payment = $this->db->query("SELECT * FROM `tblpurchaseorderpayments` WHERE `po_id` = '" . $row->id . "' and status != 2")->result();
                                                    if (!empty($chk_purchase_payment)) {


                                                        $pending_request = $chk_utr = 0;
                                                        $approved_amount = 0.00;
                                                        foreach ($chk_purchase_payment as $value) {
                                                            $approved_amount += $value->approved_amount;
                                                            if ($value->payment_by == 1) {
                                                                if ($value->status == 0 && $value->utr_no == "") {
                                                                    $pending_request = 1;
                                                                } elseif ($value->status == 1 && $value->utr_no == "") {
                                                                    $chk_utr = 1;
                                                                }
                                                            } elseif ($value->payment_by != 1) {
                                                                if ($value->status == 0) {
                                                                    $pending_request = 1;
                                                                }
                                                            }
                                                        }


                                                        if ($pending_request == 1) {
                                                            $pmt_status = "<span class='badge badge-warning' style='background-color:#ff6f00;padding: 6px;'>Payment <br> Requested </span>";
                                                        } elseif ($pending_request == 0 && $chk_utr == 1) {
                                                            $pmt_status = "<span class='badge badge-success' style='background-color:#84c529;padding: 6px;'>Request <br> Approved </span>";
                                                        } else {
                                                            if ($approved_amount >= $row->totalamount) {
                                                                $pmt_status = "<span class='badge badge-success' style='background-color:#84c529;padding: 6px;'>Completed</span>";
                                                            } else {
                                                                $pmt_status = "<span class='badge badge-info' style='background-color:#03a9f4;padding: 6px;'>Partial <br> Payment</span>";
                                                            }
                                                        }

                                                    }

                                                    $mr_info = $this->db->query("SELECT `date` FROM `tblmaterialreceipt` WHERE po_id = '".$row->id."'")->row();
                                                    $mr_date = (!empty($mr_info)) ? _d($mr_info->date) : '--';
                                                    //if($percent < 100){
                                                       ?>
                                                    <tr>
                                                        <td><?php echo $z++; ?></td>
                                                        <td><a  title="View" target="_blank" href="<?php echo admin_url('purchase/download_pdf/' . $row->id); ?>"><?php echo $po_number; ?></a></td>
                                                        <td><?php echo date('d/m/Y', strtotime($row->date)); ?></td>
                                                        <td><?php echo $mr_date; ?></td>
                                                        <td><?php echo 'Transportation'; ?></td>
                                                        <td><?php echo cc(value_by_id('tblvendor', $row->vendor_id, 'name')); ?></td>
                                                        <td><?php echo $row->totalamount; ?></td>
                                                        <td><button type='button' class='btn-sm <?php echo $percent_cls; ?> percent' value="<?php echo $row->id; ?>" data-toggle='modal' data-target='#myModalpercent'><?php echo $percent . "%"; ?></button></td>
                                                        <td><?php echo $pmt_status; ?></td>
                                                        <td><?php echo number_format($row->requested_amount, '2'); ?></td>
                                                        <td><?php echo $warehouse; ?></td>
                                                        <td><?php echo $urgencytype; ?></td>
                                                        <td><?php echo $priority_number; ?></td>
                                                    </tr>

                                                    <?php 
                                                   // }
                                                    
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
<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Purchase Challan Return Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('purchasechallanreturn/file_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;height: auto;padding: 10px 15px;">
                </div>
                <input type="hidden" id="pcreturn_id" name="pcreturn_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>  
        </form>

      </div>
    </div>

  </div>
</div>
<div id="myModalpercent" class="modal fade" role="dialog">
    <div class="modal-dialog" style="width:1000px;">

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
<div id="urgencysetModel" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <form action="<?php echo admin_url('purchase/updateUrgencyType'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Set Urgency Type & Priority</h4>
                </div>
                <div class="modal-body">
                    <div id="urgencytype_html"></div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="prequest_id" id="prequest_id" value="0">
                    <input type="hidden" name="request_type" id="request_type" value="payrequest">
                    <button type="submit" class="btn btn-info">Submit</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>     
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
        var ttlveryurgentamt = '<?php echo $ttlveryurgentamt.'.00'; ?>';
        var ttlurgentamt = '<?php echo $ttlurgentamt.'.00'; ?>';
        var ttllessurgentamt = '<?php echo $ttllessurgentamt.'.00'; ?>';
        var ttlaverageamt = '<?php echo $ttlaverageamt.'.00'; ?>';
        var ttlpayment = '<?php echo $total_payment.'.00'; ?>';

        $(".ttlveryurgentamt").html(ttlveryurgentamt);
        $(".ttlurgentamt").html(ttlurgentamt);
        $(".ttllessurgentamt").html(ttllessurgentamt);
        $(".ttlaverageamt").html(ttlaverageamt);
        $(".ttlpayment").html(ttlpayment);

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

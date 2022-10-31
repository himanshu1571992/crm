<?php init_head(); ?>
<style>
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }
    legend.scheduler-border {
        font-size: 1.2em !important;
        font-weight: bold !important;
        text-align: left !important;
        border-bottom: blue;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'clienttax_form', 'class' => 'clienttax-form')); ?>
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title; ?></h4>
                                </div>
                            </div>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12"> 
                                    <div>
                                        <fieldset class="scheduler-border"><br>
                                            <div class="col-md-12">
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Taxable Value</h4>
                                                        <p style="color: red; text-align: center;" id="ttl_taxable_val">0.00</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total SGST</h4>
                                                        <p style="color: red; text-align: center;" id="ttl_sgst_val">0.00</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total CGST</h4>
                                                        <p style="color: red; text-align: center;" id="ttl_cgst_val">0.00</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total IGST</h4>
                                                        <p style="color: red; text-align: center;" id="ttl_igst_val">0.00</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                        <p style="color: red; text-align: center;" id="ttl_amount_val">0.00</p>
                                                    </div>
                                                </div>
                                                <div class="col-md-2">
                                                    <div class="form-group">
                                                        <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                        <p style="color: red; text-align: center;" id="ttl_counts_val">0.00</p>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                    <div>               
                                        <fieldset class="scheduler-border">
                                            <br>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <p><h4>GST Type :</h4>
                                                        <?php if (isset($clienttax_info)) {
                                                                $gst_types = array(1=>"GSTR1",2=>"GSTR3B",3=>"Tally");
                                                                $gsttypes = explode(",", $clienttax_info->gst_typ);
                                                                foreach ($gsttypes as $k => $val) {
                                                                    echo ++$k.") ".$gst_types[$val];
                                                                    echo '<br>';
                                                                }
//                                                                if ($clienttax_info->gst_typ == 1){
//                                                                    echo "GSTR1";
//                                                                }elseif($clienttax_info->gst_typ == 2){
//                                                                    echo "GSTR3B";
//                                                                }elseif($clienttax_info->gst_typ == 3){
//                                                                    echo "Tally";
//                                                                }
                                                            } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <p><h4>Month-Year :</h4>
                                                        <?php if (isset($clienttax_info)) {
                                                                echo date("M-Y", strtotime($clienttax_info->year."-".$clienttax_info->month."-01"));
                                                            } ?>
                                                        </p>
                                                    </div>
                                                </div>
                                            </div>
                                        </fieldset>
                                    </div>
                                </div>
                            </div>
                            <div class="row">
                                <div class="col-md-12">
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <thead>
                                                <th>#</th>
                                                <th>Date</th>
                                                <th>Invoice Type</th>
                                                <th>Document Number</th>
                                                <th>Client Name</th>
                                                <th align="center">Total Invoice Value</th>
                                                <th align="center">Total Taxable Value</th>
                                                <th align="center">CGST</th>
                                                <th align="center">SGST</th>
                                                <th align="center">IGST</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    $total_taxable_value = $total_sgst_value = $total_cgst_value = $total_igst_value = $total_amt = $ttl_count = 0;
                                                    if ($clienttax_details){
                                                        foreach ($clienttax_details as $key => $value) {
                                                            $type = $date = $number = $taxable_value = $sgst_value = $cgst_value = $igst_value = $invoice_amount = "--";
                                                            switch ($value->tabel_type) {
                                                                case 1:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tblinvoices` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $ttl_count++;
                                                                        $tax = ($invoice_data->total_tax/2);
                                                                        $taxable_value = ($invoice_data->total-$invoice_data->total_tax);
                                                                        $sgst_value = ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $cgst_value = ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $igst_value = ($invoice_data->tax_type == 1) ? 0.00 : $invoice_data->total_tax;
                                                                        $invoice_amount = $invoice_data->total;

                                                                        $total_taxable_value += ($invoice_data->total-$invoice_data->total_tax);
                                                                        $total_sgst_value += ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_cgst_value += ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_igst_value += ($invoice_data->tax_type == 1) ? 0.00 : $invoice_data->total_tax;
                                                                        $total_amt += $invoice_data->total;

                                                                        $type = ($invoice_data->service_type == 2) ? "Sales Invoice" : "Rent Invoice";
                                                                        $date = _d($invoice_data->invoice_date);
                                                                        $number = "<a href='".admin_url("invoices/download_pdf/".$value->document_id."/?output_type=I")."'>".$invoice_data->number."</a>";
                                                                    }
                                                                    break;
                                                                case 2:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tbldebitnote` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $ttl_count++;
                                                                        $tax = ($invoice_data->total_tax/2);
                                                                        $taxable_value = ($invoice_data->totalamount-$invoice_data->total_tax);
                                                                        $sgst_value = ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $cgst_value = ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $igst_value = ($invoice_data->tax_type == 1) ? 0.00 : $invoice_data->total_tax;
                                                                        $invoice_amount = $invoice_data->totalamount;

                                                                        $total_taxable_value += ($invoice_data->totalamount-$invoice_data->total_tax);
                                                                        $total_sgst_value += ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_cgst_value += ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_igst_value += ($invoice_data->tax_type == 1) ? 0.00 : $invoice_data->total_tax;
                                                                        $total_amt += $invoice_data->totalamount;

                                                                        $date = _d($invoice_data->dabit_note_date);
                                                                        $number = "<a href='".admin_url("debit_note/download_pdf/".$value->document_id."")."'>".$invoice_data->number."</a>";
                                                                    }
                                                                    $type = "DN (Damage)";
                                                                    break;
                                                                case 3:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tbldebitnotepayment` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $ttl_count++;
                                                                        $tax = ($value->total_tax/2);
                                                                        $taxable_value = ($value->amount-$value->total_tax);
                                                                        $sgst_value = ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $cgst_value = ($invoice_data->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $igst_value = ($invoice_data->tax_type == 1) ? 0.00 : $invoice_data->total_tax;
                                                                        $invoice_amount = $invoice_data->amount;

                                                                        $total_taxable_value += ($value->amount-$value->total_tax);
                                                                        $total_sgst_value += ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_cgst_value += ($value->tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_igst_value += ($value->tax_type == 1) ? 0.00 : $value->total_tax;
                                                                        $total_amt += $invoice_data->amount;

                                                                        $date = _d($invoice_data->date);
                                                                        $number = "<a href='".admin_url("debit_note/download_paymentpdf/".$value->document_id."")."'>".$invoice_data->number."</a>";
                                                                    }
                                                                    $type = "DN (Delay In Payment)";
                                                                    break;
                                                                case 4:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tblcreditnote` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $ttl_count++;
                                                                        $tax_type = get_client_gst_type($value->clientid);
                                                                        $taxable_value = ($value->totalamount-$value->total_tax);
                                                                        $sgst_value = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $cgst_value = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $igst_value = ($tax_type == 1) ? 0.00 : $value->total_tax;
                                                                        $invoice_amount = $invoice_data->totalamount;

                                                                        $total_taxable_value += ($value->totalamount-$value->total_tax);
                                                                        $tax = ($value->total_tax/2);
                                                                        $total_sgst_value += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_cgst_value += ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                                        $total_igst_value += ($tax_type == 1) ? 0.00 : $value->total_tax;
                                                                        $total_amt += $invoice_data->totalamount;

                                                                        $date = _d($invoice_data->date);
                                                                        $number = "<a href='".admin_url("creditnotes/download_pdf/".$value->document_id."")."'>".$invoice_data->number."</a>";
                                                                    }
                                                                    $type = "CN";
                                                                    break;
                                                            }
                                                            
                                                            if (!empty($invoice_data)){
                                                ?>
                                                                    <tr>
                                                                        <td><?php echo ++$key; ?></td>
                                                                        <td><?php echo $date; ?></td>
                                                                        <td><?php echo $type; ?></td>
                                                                        <td><?php echo $number; ?></td>
                                                                        <td><?php echo client_info($invoice_data->clientid)->client_branch_name; ?></td>
                                                                        <td><?php echo number_format($invoice_amount, 2); ?></td>
                                                                        <td><?php echo number_format($taxable_value, 2); ?></td>
                                                                        <td><?php echo $cgst_value; ?></td>
                                                                        <td><?php echo $sgst_value; ?></td>
                                                                        <td><?php echo $igst_value; ?></td>
                                                                        <td>
                                                                            <input type="hidden" name="details[<?php echo $key; ?>][document_id]" class="document_id" value="<?php echo $value->document_id;?>">
                                                                            <input type="hidden" name="details[<?php echo $key; ?>][document_type]" class="document_type" value="<?php echo $value->tabel_type;?>">
                                                                            <input type='checkbox' class='chkaction' name='details[<?php echo $key; ?>][checked]'>
                                                                        </td>
                                                                    </tr>
                                                <?php
                                                            }
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
                    
                </div>      
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="col-md-12">
                                <div class="form-group">
                                    <label for="approval_remark" class="control-label">Approval/Reject Remark</label>
                                    <textarea rows="6" class="form-control" name="approval_remark" id="approval_remark" required=""></textarea>
                                </div>
                            </div>
                            <div class="btn-bottom-toolbar text-right">
                                <button class="btn btn-info" id="take_action" type="submit">
                                    <?php echo 'Approve'; ?>
                                </button>
                            </div>
                        </div>
                    </div>
                </div>
            
            <?php echo form_close(); ?>
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
    $("#ttl_taxable_val").html('<?php echo $total_taxable_value; ?>');
    $("#ttl_sgst_val").html('<?php echo $total_sgst_value; ?>');
    $("#ttl_cgst_val").html('<?php echo $total_cgst_value; ?>');
    $("#ttl_igst_val").html('<?php echo $total_igst_value; ?>');
    $("#ttl_amount_val").html('<?php echo $total_amt; ?>');
    $("#ttl_counts_val").html('<?php echo $ttl_count; ?>');
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
                        columns: [0, 1, 2]

                    }

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2]

                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2]

                    }

                },
                'colvis',
            ]

        });

    });


</script>
<script type="text/javascript">
    $(document).on('click', '#take_action', function () {
        
        var document_id = [];
        var document_type = [];
        var data = 0;
        $('.chkaction').each(function() {
            if (this.checked){
                data = data + 1;
            }
        });
        if (data <= 0){
            alert("Please check at least one report");
        }
    });
</script>
</body>
</html>




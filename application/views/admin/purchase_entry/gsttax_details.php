<?php init_head(); ?>

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
                                <?php
                                
                                    if(!empty($invoice_data)){
                                ?>
                                <div class="col-md-12"> 
                                    <h4 class="no-margin text-center">Purchase Invoice Details</h4>
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <thead>
                                                <th>#</th>
                                                <th>Branch State</th>
                                                <th>Branch GST No</th>
                                                <th>Invoice Type</th>   
                                                <th>Vendor Name</th>   
                                                <th>Vendor GST Number</th>   
                                                <th>Invoice Number</th>
                                                <th>Invoice Date</th>
                                                <th>Total Invoice Value</th>
                                                <th>Total Taxable Value</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>IGST</th>
                                            </thead>
                                            <tbody>
                                            <?php

                                                $invcgst_amt = $invsgst_amt = $invigst_amt =  $total_inv_amt = $total_tax_amt = 0;
                                                foreach ($invoice_data as $key => $value) {
                                                    $vendor_info = $this->db->query("SELECT `name`,`gst_no` from `tblvendor` where id = '".$value->vendor_id."'  ")->row();
                                                    $tax_type = $value->tax_type;
                                                    
                                                    $service_type = "Purchase Invoice";
                                                    $tax = ($value->total_tax/2);
                                                    $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                    $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                    $igst = ($tax_type == 1) ? 0.00 : $value->total_tax;
                                                    $taxable_value = ($value->totalamount-$value->total_tax);
                                                    $total_inv_amt += $value->totalamount;
                                                    $total_tax_amt += $taxable_value;
                                                    $invcgst_amt += $cgst;
                                                    $invsgst_amt += $sgst;
                                                    $invigst_amt += $igst;
                                                    $key = $key+1;
                                                    $number = "<a href='".admin_url("purchase/purchase_invoice_pdf/".$value->id."")."'>Inv-".str_pad($value->id, 4, '0', STR_PAD_LEFT)."</a>";
                                                    echo '<tr>'
                                                            . '<td>'.$key.'</td>'
                                                            . '<td>'.value_by_id("tblstates", $value->branch_state, "name").'</td>'
                                                            . '<td>'.$value->branch_gst_no.'</td>'
                                                            . '<td>'.$service_type.'</td>'
                                                            . '<td>'.$vendor_info->name.'</td>'
                                                            . '<td>'.$vendor_info->gst_no.'</td>'
                                                            . '<td>'.$number.'</td>'
                                                            . '<td>'._d($value->date).'</td>'
                                                            . '<td>'.number_format($value->totalamount, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($taxable_value, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($cgst, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($sgst, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($igst, 2, '.', '').'</td>'
                                                       . '</tr>';
                                                }
                                            ?>      
                                            <tfoot style="background-color: #e9ebef;">
                                                <tr>
                                                    <td align="" colspan="2"></td>
                                                    <td align="" colspan="6">Total</td>
                                                    <td align=""><b><?php echo number_format($total_inv_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($total_tax_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($invcgst_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($invsgst_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($invigst_amt, 2, '.', ''); ?></b></td>
                                                    <td align="center" colspan="3"></td>
                                                </tr>
                                            </tfoot>    
                                           </tbody>
                                        </table>
                                    </div>
                                </div>     
                                <?php        
                                    }
                                    if(!empty($purchaseentry_data)){
                                ?>
                                <div class="col-md-12"> 
                                    <h4 class="no-margin text-center">Purchase Entry Details</h4>
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <thead>
                                                <th>#</th>
                                                <th>Branch State</th>
                                                <th>Branch GST No</th>
                                                <th>Invoice Type</th>   
                                                <th>Vendor Name</th>   
                                                <th>Vendor GST Number</th>   
                                                <th>Invoice Number</th>
                                                <th>Invoice Date</th>
                                                <th>Total Invoice Value</th>
                                                <th>Total Taxable Value</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>IGST</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $invcgst_amt = $invsgst_amt = $invigst_amt =  $total_inv_amt = $total_tax_amt = 0;
                                                foreach ($purchaseentry_data as $key => $value) {
                                                    
                                                    $tax_type = $value->tax_type;

                                                    $tax = ($value->total_tax/2);
                                                    $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                    $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                    $igst = ($tax_type == 1) ? 0.00 : $value->total_tax;
                                                    
                                                    $taxable_value = ($value->totalamount-$value->total_tax);
                                                    $total_inv_amt += $value->totalamount;
                                                    $total_tax_amt += $taxable_value;
                                                    $invcgst_amt += $cgst;
                                                    $invsgst_amt += $sgst;
                                                    $invigst_amt += $igst;
                                                    $key = $key+1;
                                                    $number = "<a href='#'>".$value->invoice_number."</a>";
                                                    echo '<tr>'
                                                            . '<td>'.$key.'</td>'
                                                            . '<td>'.value_by_id("tblstates", $value->branch_state, "name").'</td>'
                                                            . '<td>'.$value->branch_gst_no.'</td>'
                                                            . '<td>'."Purchase Entry".'</td>'
                                                            . '<td>'.$value->name.'</td>'
                                                            . '<td>'.$value->gst_number.'</td>'
                                                            . '<td>'.$number.'</td>'
                                                            . '<td>'._d($value->invoice_date).'</td>'
                                                            . '<td>'.number_format($value->totalamount, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($taxable_value, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($cgst, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($sgst, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($igst, 2, '.', '').'</td>'
                                                       . '</tr>';
                                                }
                                            ?>      
                                            <tfoot style="background-color: #e9ebef;">
                                                <tr>
                                                    <td align="" colspan="2"></td>
                                                    <td align="" colspan="6">Total</td>
                                                    <td align=""><b><?php echo number_format($total_inv_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($total_tax_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($invcgst_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($invsgst_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b><?php echo number_format($invigst_amt, 2, '.', ''); ?></b></td>
                                                    <td align="center" colspan="3"></td>
                                                </tr>
                                            </tfoot>    
                                           </tbody>
                                        </table>
                                    </div>
                                </div>     
                                <?php        
                                    }
                                    
                                    if(!empty($purchasedebitnote_data)){
                                ?>
                                <div class="col-md-12"> 
                                    <h4 class="no-margin text-center">Purchase Debit Note Details</h4>
                                    <div class="table-responsive">
                                        <table class="table table-user-information">
                                            <thead>
                                                <th>#</th>
                                                <th>Branch State</th>
                                                <th>Branch GST No</th>
                                                <th>Invoice Type</th>   
                                                <th>Vendor Name</th>   
                                                <th>Vendor GST Number</th>   
                                                <th>Invoice Number</th>
                                                <th>Invoice Date</th>
                                                <th>Total Invoice Value</th>
                                                <th>Total Taxable Value</th>
                                                <th>CGST</th>
                                                <th>SGST</th>
                                                <th>IGST</th>
                                            </thead>
                                            <tbody>
                                            <?php
                                                $invcgst_amt = $invsgst_amt = $invigst_amt =  $total_inv_amt = $total_tax_amt = 0;
                                                foreach ($purchasedebitnote_data as $key => $value) {
                                                    $vendor_info = $this->db->query("SELECT `name`,`gst_no` from `tblvendor` where id = '".$value->vender_id."'  ")->row();
                                                    $tax_type = $value->tax_type;
                                                    
                                                    $tax = ($value->total_tax/2);
                                                    $sgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                    $cgst = ($tax_type == 1) ? number_format(round($tax), 2, '.', '') : 0.00;
                                                    $igst = ($tax_type == 1) ? 0.00 : $value->total_tax;
                                                    
                                                    $taxable_value = ($value->totalamount-$value->total_tax);
                                                    $total_inv_amt += $value->totalamount;
                                                    $total_tax_amt += $taxable_value;
                                                    $invcgst_amt += $cgst;
                                                    $invsgst_amt += $sgst;
                                                    $invigst_amt += $igst;
                                                    $key = $key+1;
                                                    $number = "<a href='".admin_url("purchasechallanreturn/download_debitnotepdf/".$value->id."")."'>PDN-".str_pad($value->id, 4, '0', STR_PAD_LEFT)."</a>";
                                                    echo '<tr>'
                                                            . '<td>'.$key.'</td>'
                                                            . '<td>'.value_by_id("tblstates", $value->branch_state, "name").'</td>'
                                                            . '<td>'.$value->branch_gst_no.'</td>'
                                                            . '<td>'."Purchase Debit Note".'</td>'
                                                            . '<td>'.$vendor_info->name.'</td>'
                                                            . '<td>'.$vendor_info->gst_no.'</td>'
                                                            . '<td>'.$number.'</td>'
                                                            . '<td>'._d($value->date).'</td>'
                                                            . '<td>'.number_format($value->totalamount, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($taxable_value, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($cgst, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($sgst, 2, '.', '').'</td>'
                                                            . '<td>'.number_format($igst, 2, '.', '').'</td>'
                                                       . '</tr>';
                                                }
                                            ?>      
                                            <tfoot style="background-color: #e9ebef;">
                                                <tr>
                                                    <td align="" colspan="2"></td>
                                                    <td align="" colspan="6">Total</td>
                                                    <td align=""><b>-<?php echo number_format($total_inv_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b>-<?php echo number_format($total_tax_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b>-<?php echo number_format($invcgst_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b>-<?php echo number_format($invsgst_amt, 2, '.', ''); ?></b></td>
                                                    <td align=""><b>-<?php echo number_format($invigst_amt, 2, '.', ''); ?></b></td>
                                                    <td align="center" colspan="3"></td>
                                                </tr>
                                            </tfoot>  
                                           </tbody>
                                        </table>
                                    </div>
                                </div>     
                                <?php        
                                    }
                                ?>
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




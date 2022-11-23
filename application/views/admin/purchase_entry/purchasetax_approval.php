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
@media (max-width: 500px){
    .btn-bottom-toolbar {
        width: 100%
    }
}    
@media (max-width: 768px){
    .btn-bottom-toolbar {
        width: 100%
    }
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
                                        <fieldset class="scheduler-border">
                                            <br>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <p><h4>GST Type :</h4>
                                                        <?php if (isset($purchasetax_info)) {
                                                                $gst_types = array(1=>"GSTR2B",2=>"GSTR3B",3=>"Tally");
                                                                $gsttypes = explode(",", $purchasetax_info->gst_typ);
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
                                                        <?php if (isset($purchasetax_info)) {
                                                                echo date("M-Y", strtotime($purchasetax_info->year."-".$purchasetax_info->month."-01"));
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
                                                <th>Vendor Name</th>
                                                <th>Action</th>
                                            </thead>
                                            <tbody>
                                                <?php
                                                    if ($purchasetax_details){
                                                        foreach ($purchasetax_details as $key => $value) {
                                                            $type = $date = $number = "--";
                                                            switch ($value->tabel_type) {
                                                                case 5:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tblpurchaseinvoice` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $vendor_info = $this->db->query("SELECT `name` from `tblvendor` where id = '".$invoice_data->vendor_id."'  ")->row();
                                                                        $type = "Purchase Invoice";
                                                                        $date = _d($invoice_data->date);
                                                                        $vendor_name = $vendor_info->name;
                                                                        $number = "<a href='".admin_url("purchase/purchase_invoice_pdf/".$value->document_id)."'>Inv-".str_pad($value->document_id, 4, '0', STR_PAD_LEFT)."</a>";
                                                                    }
                                                                    break;
                                                                case 6:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tblpurchaseentry` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $date = _d($invoice_data->invoice_date);
                                                                        $vendor_name = $invoice_data->name;
                                                                        $number = "<a href='#'>".$invoice_data->invoice_number."</a>";
                                                                    }
                                                                    $type = "Purchase Entry";
                                                                    break;
                                                                case 7:
                                                                    $invoice_data = $this->db->query("SELECT * FROM `tblpurchasedabitnote` WHERE `id` = ".$value->document_id."")->row();
                                                                    if(!empty($invoice_data)){
                                                                        $vendor_info = $this->db->query("SELECT `name` from `tblvendor` where id = '".$invoice_data->vender_id."'  ")->row();
                                                                        $date = _d($invoice_data->date);
                                                                        $vendor_name = $vendor_info->name;
                                                                        $number = "<a href='".admin_url("purchasechallanreturn/download_debitnotepdf/".$value->document_id."")."'>PDN-".str_pad($value->document_id, 4, '0', STR_PAD_LEFT)."</a>";
                                                                    }
                                                                    $type = "Purchase Debit Note";
                                                                    break;
                                                            }
                                                            
                                                            if (!empty($invoice_data)){
                                                ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo $date; ?></td>
                                                    <td><?php echo $type; ?></td>
                                                    <td><?php echo $number; ?></td>
                                                    <td><?php echo $vendor_name; ?></td>
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




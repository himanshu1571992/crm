<?php init_head(); ?>

<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<style type="text/css">
    .button3 {background-color: #800000;}
    .onholdbtn {background-color: #e8bb0b;}

    .card {
        box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
        transition: 0.3s;
        padding: 15px;
        /*width: 20%;*/
        /*border-radius: 50%;*/
    }

    .card:hover {
        box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">


                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">

                            <div class="row panelHead">
                                <div class="col-xs-12 col-md-6">
                                    <h4><?php echo $title;?></h4>
                                </div>
                            </div>

                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12">

                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="col-md-3 text-center active">
                                            <a href="#invoices" aria-controls="invoices" role="tab" data-toggle="tab" aria-expanded="true">Invoices</a>
                                        </li>
                                        <li role="presentation" class="col-md-3 text-center">
                                            <a href="#dn_damaged" aria-controls="dn_damaged" role="tab" data-toggle="tab" aria-expanded="false">DN Damage</a>
                                        </li>
                                        <li role="presentation" class="col-md-3 text-center">
                                            <a href="#dn_payment" aria-controls="dn_payment"  role="tab" data-toggle="tab" aria-expanded="false">DN Payments</a>
                                        </li>
                                        <li role="presentation" class="col-md-3 text-center">
                                            <a href="#credit_note" aria-controls="credit_note" role="tab" data-toggle="tab" aria-expanded="false">Credit Note</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="invoices">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table" id="newtable">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No</th>
                                                                <th>Invoice #</th>
                                                                <th>Created By</th>
                                                                <th>Service Type</th>
                                                                <th>Amount</th>
                                                                <th>Invoice Date</th>
                                                                <th>Customer</th>
                                                                <th width="10%" class="text-center">Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if(!empty($invoice_list)){
                                                                foreach ($invoice_list as $key => $value) {

                                                                        $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
                                                                        $item_info = $this->db->query("SELECT is_sale FROM `tblitems_in` where  `rel_type` = 'invoice' and `rel_id` = '".$value->id."' ")->row();

                                                                        $type = '';
                                                                        if(!empty($item_info)){
                                                                            if($item_info->is_sale == 0){
                                                                                $type = '?type=rent';
                                                                            }elseif($item_info->is_sale == 1){
                                                                                $type = '?type=sale';
                                                                            }
                                                                        }
                                                                        $stype = ($value->service_type == 1) ? '<span class="btn-sm btn-success">RENT</span>':'<span class="btn-sm btn-danger">SALES</span>';
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo ++$key; ?></td>
                                                                        <!-- <td><?php echo '<a href="' . site_url('invoice/' . $value->id . '/' . $value->hash) . $type .'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td> -->
                                                                        <td ><a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$value->id.'/?output_type=I');?>" data-status="1"><?php echo format_invoice_number($value->id); ?></a></td>
                                                                        <td><?php echo ($value->addedfrom > 0) ? get_employee_name($value->addedfrom) : '--'; ?></td>
                                                                        <td><?php echo $stype; ?></td>
                                                                        <td><?php echo $value->total; ?></td>
                                                                        <td><?php echo _d($value->invoice_date); ?></td>
                                                                        <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                                        <td class="text-center">
                                                                            <a href="<?php echo site_url('invoice/'.$value->id.'/'.$value->hash).$type ; ?>" target="_blank" class="tableBtn actionBtn"><i class="fa fa-eye" aria-hidden="true"></i></a>
                                                                            <a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$value->id.'/?output_type=I');?>" class="btn-sm btn-info" data-status="1">PDF</a>
                                                                        </td>
                                                                    </tr>
                                                                    <?php
                                                                } ?>
                                                                <?php
                                                            }
                                                            ?>
                                                        </tbody>
                                                    </table>    
                                                </div>
                                            </div>
                                        </div>
                                        <div role="tabpanel" class="tab-pane" id="dn_damaged">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table" id="dn_damaged_tbl">
                                                        <thead>
                                                            <tr>
                                                                    <th>S.No.</th>
                                                                    <th>Number</th>
                                                                    <th>Customer</th>
                                                                    <th>Challan</th>
                                                                    <th>Date</th>
                                                                    <th>Amount</th>
                                                                    <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if(!empty($debitnote_list)){
                                                                $z=1;
                                                                foreach($debitnote_list as $row){
                                                                    $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$row->clientid."'  ")->row();
                                                                    if($row->challan_id > 0){
                                                                        $challan_no = value_by_id('tblchalanmst',$row->challan_id,'chalanno');
                                                                    }else{
                                                                        $challan_no = $row->challan_number;
                                                                    }

                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $z++;?></td>
                                                                        <td><?php echo $row->number;?></td>
                                                                        <td><a href="<?php echo admin_url('clients/client/'.$row->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                                        <td><?php echo $challan_no;?></td>
                                                                        <td><?php echo _d($row->dabit_note_date); ?></td>
                                                                        <td><?php echo $row->totalamount;?></td>
                                                                        <td>
                                                                            <a  title="View" target="_blank" href="<?php echo admin_url('debit_note/download_pdf/'.$row->id.'/?output_type=I');?>" data-status="1">View PDF</a>
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
                                        <div role="tabpanel" class="tab-pane" id="dn_payment">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table" id="dn_payment_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No.</th>
                                                                <th>Number</th>
                                                                <th>Customer</th>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if(!empty($dn_payment_list)){
                                                                $z=1;
                                                                foreach($dn_payment_list as $row){
                                                                    $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$row->clientid."'  ")->row();
                                                                    $tt_amt = $this->db->query("SELECT COALESCE(SUM(final_amount),0) as amt from tbldebitnotepaymentitems where debitnote_id = '".$row->id."' ")->row()->amt;
                                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $z++;?></td>
                                                                        <td><?php echo $row->number;?></td>
                                                                        <td><a href="<?php echo admin_url('clients/client/'.$row->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                                        <td><?php echo _d($row->date); ?></td>
                                                                        <td><?php echo $tt_amt; ?></td>
                                                                        <td>
                                                                            <a  title="View" target="_blank" href="<?php echo admin_url('debit_note/download_paymentpdf/'.$row->id.'/?output_type=I');?>" data-status="1">View PDF</a>                            
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
                                        <div role="tabpanel" class="tab-pane" id="credit_note">
                                            <div class="col-md-12">
                                                <hr>
                                                <div class="table-responsive">
                                                    <table class="table" id="credit_note_tbl">
                                                        <thead>
                                                            <tr>
                                                                <th>S.No.</th>
                                                                <th>Number</th>
                                                                <th>Customer</th>
                                                                <th>Invoice</th>
                                                                <th>Date</th>
                                                                <th>Amount</th>
                                                                <th>Action</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                            <?php
                                                            if (!empty($creditnote_list)) {
                                                                $z = 1;
            
                                                                foreach ($creditnote_list as $row) {
                                                                    $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '" . $row->clientid . "'  ")->row();
            
                                                            ?>
                                                                    <tr>
                                                                        <td><?php echo $z++; ?></td>
                                                                        <td><?php echo $row->number; ?></td>
                                                                        <td><a href="<?php echo admin_url('clients/client/' . $row->clientid); ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                                        <td><?php echo $row->invoice_numbers; ?></td>
                                                                        <td><?php echo _d($row->date); ?></td>
                                                                        <td><?php echo $row->totalamount; ?></td>
                                                                        <td>
                                                                            <a  title="View" target="_blank" href="<?php echo admin_url('creditnotes/download_pdf/'.$row->id);?>" data-status="1">View PDF</a>
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
                                </div>
                            </div>

                            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                            <div class="btn-bottom-toolbar text-right">
                            </div>
                        </div>

                    </div>
                </div>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


        <?php init_tail(); ?>
<script src="<?php echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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

        $('#newtable,#dn_damaged_tbl,#dn_payment_tbl,#credit_note_tbl').DataTable({
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
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4, 5, 6, 7]

                    }

                },
                'colvis',
            ]

        });
    });

</script>
</body>
</html>

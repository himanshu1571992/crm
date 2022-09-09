
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

    .actionBtn {
        border: 1px solid #00BCD4;
        padding: 8px 10px;
        border-radius: 3px;
        background: #03A9F4;
        color: #fff;
        margin: 2px;
    }

    .actionBtn:hover {
        background:#255fe5;
        color:#fff;
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
                        <div class="col-xs-12 col-md-6">
                            <h4>Achieved Target Invoices</h4>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">
                
                                                
                    <div class="col-md-12">      
                        <hr>
                        <div class="table-responsive">                                               
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>Invoice #</th>                                
                                <th>Due Date</th>
                                <th>Customer</th>
                                <th>Status</th>
                                <th>Amount</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            $total = 0;
                            if(!empty($target_invoice)){
                                foreach ($target_invoice as $key => $value) {

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

                                         $total += $value->total;
                                    ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td>                                                
                                        <td><?php echo '<a href="' . admin_url('invoices/download_pdf/' . $value->id ).'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td>
                                        
                                        <td><?php echo _d($value->duedate); ?></td> 
                                        <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                        <td><?php echo format_invoice_status($value->status); ?></td>
                                        <td><?php echo $value->total; ?></td>
                                      </tr>
                                    <?php
                                }
                            }
                            ?>
                             
                            </tbody>
                            <tfoot>
                                <tr>
                                    <td colspan="5" class="text-center"><b>Total Invoice Amount</b></td>
                                    <td><b><?php echo number_format($total, 2, '.', ''); ?></b></td>
                                </tr>
                            </tfoot>
                          </table>
                        </div>
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

$(document).ready(function() {
    $('#newtable').DataTable( {
        
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>

</body>
</html>

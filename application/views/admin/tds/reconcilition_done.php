
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

</style>

<?php
if(!empty($this->session->userdata('invoice_search'))){
    $search_arr = $this->session->userdata('invoice_search');
}    
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; if(check_permission_page(62,'create')){ ?> </h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('tds/add'); ?>" type="submit" class="btn btn-info">Add More Details</a> <?php } ?>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Client</label>
                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($client_data)){
                                        foreach ($client_data as $row) {
                                            ?>
                                            <option value="<?php echo $row->userid; ?>" <?php if($s_client_id == $row->userid){ echo 'selected'; } ?>><?php echo cc($row->client_branch_name); ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                       

                        <!-- <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo date('d/m/Y',strtotime($f_date)); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo date('d/m/Y',strtotime($t_date)); } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div> -->

                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">     
                                <!-- <div class="row">                                   
                                    <div class="col-md-12 text-center totalAmount-row">
                                        <h4 style="color: red;">Total Amount : <?php echo number_format($invoice_amount, 2, '.', ''); ?></h4>
                                        <h4 style="color: red;">Total Count : <?php echo count($invoice_list); ?></h4>
                                    </div>  
                                </div>-->
                            <hr> 
                            <div class="table-responsive">                                                         
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Customer</th>
                                        <th>Payment for</th>
                                        <th>Invoice/Debitnote</th>                               
                                        <th>TDS %</th>
                                        <th>TDS Amount</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($tds_info)){
                                        $z=1;
                                        foreach($tds_info as $row){ 
                                                if($row->paymentmethod != 2){
                                                    $debit_info = $this->db->query("SELECT * FROM tbldebitnote  where `number` = '".$row->debitnote_no."' ")->row();
                                                    $debitpayment_info = $this->db->query("SELECT * FROM tbldebitnotepayment  where `number` = '".$row->debitnote_no."' ")->row();  
                                                }
                                               
                                               $client_info = client_info($row->client_id);
                                            ?>                                                                                      
                                            <tr>
                                                <td><?php echo $z++;?></td>
                                                <td><a target="_blank" href="<?php echo admin_url('clients/client/'.$row->client_id); ?>"><?php echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--';  ?> </a></td>
                                                <td><?php echo ($row->paymentmethod == 2) ? 'Invoice' : 'Debitnote';  ?></td>
                                                <?php
                                                if($row->paymentmethod == 2){
                                                    ?>
                                                    
                                                    <td><?php echo '<a target="_blank" href="' . admin_url('invoices/list_invoices/' . $row->invoiceid) . '">' . format_invoice_number($row->invoiceid) . '</a>'; ?></td>
                                                    <?php
                                                }else{
                                                    if(!empty($debit_info)){
                                                        echo '<td><a target="_blank" href="' . admin_url('debit_note/download_pdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
                                                    }elseif(!empty($debitpayment_info)){
                                                        echo '<td><a target="_blank" href="' . admin_url('debit_note/download_paymentpdf/' . $row->invoiceid) . '">' .$row->debitnote_no. '</a></td>';
                                                    }else{
                                                        echo '<td>--</td>';
                                                    }
                                                }
                                                ?>
                                                                                                                                    
                                                <td><?php echo $row->tds;?></td>
                                                <td><?php echo $row->paid_tds_amt;?></td>
                                            
                                                
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<!-- Modal -->
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

<script type="text/javascript">
    $('.status').click(function(){
    var id = $(this).val();
    
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/tds/get_approval_info'); ?>",
            data    : {'id' : id},
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

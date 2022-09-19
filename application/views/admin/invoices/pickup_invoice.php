
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
<style>
    fieldset.scheduler-border {
    border: 1px groove #ddd !important;
    padding: 0 1.4em 1.4em 1.4em !important;
    margin: 0 0 1.5em 0 !important;
    -webkit-box-shadow:  0px 0px 0px 0px #000;
            box-shadow:  0px 0px 0px 0px #000;
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
                            <h4>Pickup Invoice List <?php if(check_permission_page('17,18','create')){ ?> </h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('invoices/invoices'); ?>" type="submit" class="btn btn-info">Create new Invoice</a> <?php } ?>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4" id="employee_div">
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


                        <div class="form-group col-md-3" app-field-wrapper="date">
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
                        </div>

                        
                        <div class="col-md-1">                            
                        <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                         <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">     
<!--                                <div class="row">                                   
                                    <div class="col-md-12 text-center totalAmount-row">
                                        <h4 style="color: red;">Total Amount : <?php echo number_format($invoice_amount, 2, '.', ''); ?></h4>
                                        <h4 style="color: red;">Total Count : <?php echo count($invoice_list); ?></h4>
                                    </div>  
                                </div>-->
                                <div class="row1">
                                    <fieldset class="scheduler-border"><br>
                                        <div class="col-md-12">
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Amount</h4>
                                                    <p style="color: red; text-align: center;"><?php echo number_format($invoice_amount, 2); ?></p>
                                                </div>
                                            </div>
                                            <div class="col-md-6">
                                                <div class="form-group">
                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Count</h4>
                                                    <p style="color: red; text-align: center;"><?php echo count($invoice_list); ?></p>
                                                </div>
                                            </div>
                                        </div>
                                    </fieldset>
                                </div>
                            <hr>
                            <div class="table-responsive">                                                         
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Invoice #</th>
                                        <th>Amount</th>
                                        <th>Invoice Date</th>
                                        <th>Customer</th>
                                        <th>Status</th>
                                        <th class="text-center">Action</th>
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
                                            ?>
                                            <tr>
                                                <td><?php echo ++$key; ?></td>                                                
                                                <td>
                                                    <?php echo '<a href="' . site_url('invoice/' . $value->id . '/' . $value->hash) . $type .'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?>
                                                    <?php echo get_creator_info($value->addedfrom, $value->datecreated); ?>
                                                </td>
                                                <td><?php echo $value->total; ?></td>
                                                <td><?php echo _d($value->invoice_date); ?></td> 
                                                <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
                                                <td><?php echo format_invoice_status($value->status); ?></td>

                                                <td class="text-center">
													
                                                    <!--<a href="<?php echo admin_url('invoices/renew_invoice/' . $value->id); ?>" class="btn-sm btn-primary">Renew</a>-->
<a href="javascript:void(0);" data-toggle="modal" data-target="#finalcialyear_modal" data-id="<?php echo $value->id; ?>" class="btn-sm btn-primary renew-div">Renew</a>
                                                    <a href="<?php echo admin_url('invoices/update_rental_status/2/' . $value->id); ?>" class="btn-sm btn-primary _delete">Hold</a>
                                                    <a href="<?php echo admin_url('invoices/update_rental_status/3/' . $value->id); ?>" class="btn-sm btn-primary _delete">Pickup Done</a>

                                                </td>
                                              </tr>
                                            <?php
                                        }
                                    }else{
                                        echo '<tr><td colspan="7" class="text-center">Record not found!</td></tr>';
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
<div id="finalcialyear_modal" class="modal fade" role="dialog">
  <div class="modal-dialog ">
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
        <h4 class="modal-title" style="color:#fff"> Financial Year Selection </h4>
      </div>
      <div class="modal-body">
          <?php 
            $financial_year_list = $this->db->query("SELECT `id`,`name` FROM tblfinancialyear WHERE `status` = 1")->result();
          ?>
         <div class="row">
            <div class="col-md-12">
                <label for="module_id" class="control-label">Financial Year</label>
                <select class="form-control selectpicker" required="" data-live-search="true" id="financialyear_id" name="financialyear_id">
                    <option value=""></option>
                    <?php 
                        foreach ($financial_year_list as $value) {
                            $selectcls = ($value->id == financial_year()) ? 'selected' : '';
                            echo '<option value="'.$value->id.'" '.$selectcls.'>'.cc($value->name).'</option>';
                        }
                    ?>
                </select>
                <span class='financial_year_msg text-danger' ></span>
            </div>
         </div>
      </div>
      <div class="modal-footer">
        <input type="hidden" id="invoiceid" name="invoiceid" value="0">  
        <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
        <button type="submit" autocomplete="off" class="btn btn-info fyearbtn">Renew Invoice</button>
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

    $(document).on("click", ".renew-div", function(){
        var rowid = $(this).data('id');
        $("#invoiceid").val(rowid);
    });

    $(document).on("click", ".fyearbtn", function(){
        var financialyear_id = $("#financialyear_id").val();
        var invoiceid = $("#invoiceid").val();
        if (financialyear_id !=''){
            var url = '<?php echo admin_url('invoices/renew_invoice/'); ?>'+invoiceid+'/'+financialyear_id;
            window.location.href = url;
        }else{
            $('.financial_year_msg').html("Please Select Financial Year");
        }
    });
} );
</script>

</body>
</html>

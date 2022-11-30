
<?php init_head(); ?>


<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('manage_cheque/add_upcoming_payment'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Upcoming Payment </a>
                            </div>
                        </div>
                    <hr class="hr-panel-heading">

                    <div>
                        <div>
                            <div class="row">
                                <div class="col-md-3">  
                                    <div class="form-group">
                                        <label for="client_id" class="control-label">Client</label>
                                        <select class="form-control selectpicker" data-live-search="true" id="client_id" name="client_id">
                                            <option value=""></option>
                                            <?php
                                            if (isset($client_data) && count($client_data) > 0) {
                                                foreach ($client_data as $client_value) {
                                                    $selectedcls = (!empty($client_id) && $client_id == $client_value->userid) ? "selected": "";
                                            ?>
                                                    <option value="<?php echo $client_value->userid; ?>" <?php echo $selectedcls; ?>><?php echo $client_value->client_branch_name; ?></option>
                                            <?php
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-3">
                                    <label for="type" class="control-label">Payment Type</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="payment_type" name="payment_type">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($payment_type) && !empty($payment_type)) ? ($payment_type == 1) ? "selected": "" : ""; ?>>Cheque</option>
                                        <option value="2" <?php echo (isset($payment_type) && !empty($payment_type)) ? ($payment_type == 2) ? "selected": "" : ""; ?>>NEFT</option>
                                    </select> 
                                </div>
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="status">
                                        <label for="received_status" class="control-label">Received Status</label>
                                        <select class="form-control selectpicker" id="received_status" name="received_status" data-live-search="true">
                                            <option value=""></option>
                                            <option value="0" <?php echo (isset($received_status)) ? ($received_status == 0) ? "selected=''": "": ""; ?>>Pending</option>
                                            <option value="1" <?php echo (isset($received_status)) ? ($received_status == 1) ? "selected=''": "": ""; ?>>Received</option>
                                            <option value="2" <?php echo (isset($received_status)) ? ($received_status == 2) ? "selected=''": "": ""; ?>> Not Received</option>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="margin-top: 26px;">
                                        <button type="submit" class="btn btn-info">Search</button>
                                        <a class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </div>    
                        </div>
                        </div>
                            <br>
                            <hr>                    
                            <div class="col-md-12"> 
                                <div class="table-responsive">  
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Added By</th>
                                        <th>Client</th>
                                        <th>Payment Type</th>
                                        <th>Amount</th>
                                        <th>Reference No.</th>
                                        <th>Remark</th>
                                        <th>Created At</th>
                                        <th width="15%" class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($upcoming_payment_list)){
                                        foreach ($upcoming_payment_list as $key => $value) { 
                                           $status_arr = array('<span class="btn-sm btn-info">Update Status</span>' => '0', '<span class="btn-sm btn-success">Received</span>' => '1', '<span class="btn-sm btn-danger">Not Received</span>' => '2');
                                    ?>
                                        <tr>
                                            <td><?php echo ++$key; ?></td>                                                
                                            <td><?php echo get_employee_fullname($value->added_by); ?></td>
                                            <td><?php echo client_info($value->client_id)->client_branch_name; ?></td>
                                            <td><?php echo ($value->payment_type == 1) ? 'Cheque': 'NEFT'; ?></td>
                                            <td><?php echo number_format($value->amount, 2, '.', ','); ?></td>
                                            <td><?php echo $value->ref_no; ?></td>
                                            <td><?php echo $value->remark; ?></td>
                                            <td><?php echo _d($value->created_at); ?></td>
                                            <td class="text-center">
                                                <a href="javascript:void(0);" onclick="get_received_status('<?php echo $value->id; ?>');"><?php echo array_search($value->received_status, $status_arr); ?></a>
                                                <div class="btn-group pull-right">
                                                    <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                        <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                    </button>
                                                    <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                        <li>
                                                            <a href="<?php echo admin_url('manage_cheque/add_upcoming_payment/' . $value->id); ?>" title="edit" >Edit</a>
                                                        </li>
                                                        <li>
                                                            <a class="_delete" href="<?php echo admin_url('manage_cheque/delete_upcoming_payment/' . $value->id); ?>" title="delete" >Delete</a>
                                                        </li>
                                                    </ul>
                                                </div>
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
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>
<div id="received_status_model" class="modal fade" role="dialog">
  <div class="modal-dialog">
    <?php echo form_open(admin_url('manage_cheque/update_upcoming_status'), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Status</h4>
      </div>
      <div class="modal-body received_status_data">
        
       
      </div>
      <div class="modal-footer">
        <button type="submit" name="received_status" class="btn-sm btn-success" value="1">Received</button>
        <button type="submit" name="received_status" class="btn-sm btn-danger" value="2"> Not Received</button>   
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>
    <?php echo form_close(); ?>
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6 ]
                }
            },
            'colvis',
        ]
    } );
} );
    
    function get_received_status(id){
        var url = "<?php echo site_url('admin/manage_cheque/update_upcoming_status/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id,
            success: function (res) {
                $('#received_status_model').modal("show");
                $('.received_status_data').html(res);
            }
        })
    }

</script>


</body>
</html>



<?php init_head(); ?>


<?php
if(!empty($this->session->userdata('paymentinvoice_search'))){
    $search_arr = $this->session->userdata('paymentinvoice_search');
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
                        <div class="col-xs-12 col-md-6"><h4><?php echo $title;  if(check_permission_page(54,'create')){ ?></h4></div>   
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('purchase_payments/purchase_payment'); ?>" type="submit" class="btn btn-info">Add Payment</a> <?php } ?>
                        </div>
                    </div>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-4" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Select Vendor</label>
                                <select class="form-control selectpicker" id="vendor_id" name="vendor_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($vendor_data)){
                                        foreach ($vendor_data as $row) {
                                            ?>
                                            <option value="<?php echo $row->id; ?>" <?php if(!empty($search_arr['vendor_id']) && $search_arr['vendor_id'] == $row->id){ echo 'selected';} ?>><?php echo cc($row->name); ?></option>
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
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($search_arr['f_date'])){ echo $search_arr['f_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($search_arr['t_date'])){ echo $search_arr['t_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        
                       <!--  <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 1){ echo 'selected';} ?>>Rent</option>
                                    <option value="2" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 2){ echo 'selected';} ?>>Sale</option>
                                    
                                </select>
                            </div>
                        </div> -->


                        
                        <div class="col-md-1">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                        <div class="col-md-1">
                            <a href=""><button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button></a>
                        </div>

                       
                    </div>
                                                
                            <div class="col-md-12 table-responsive">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Vendor</th>
                                        <th>Payment Mode</th>
                                        <th>Reference No.</th>
                                        <th>Date</th>
                                        <th>Amount</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($payment_list)){
                                        foreach ($payment_list as $key => $value) {
                                             if($value->payment_mode == 1){
                                                    $paymentmode = 'Cheque';
                                                }elseif($value->payment_mode == 2){
                                                    $paymentmode = 'NEFT';
                                                }elseif($value->payment_mode == 3){
                                                    $paymentmode = 'Cash';
                                                }
                                            ?>
                                            <tr>
                                                <td><?php echo ++$key; ?></td>
                                                <td>
                                                    <?php echo get_creator_info($value->staff_id, $value->created_date); ?>
                                                    <a href="<?php echo admin_url('vendor/vendor/'.$value->vendor_id);?>" target="_blank"><?php echo cc(value_by_id('tblvendor',$value->vendor_id,'name')); ?></a>
                                                </td>
                                                <td><?php echo $paymentmode; ?></td>
                                                <td><?php echo $value->reference_no; ?></td>
                                                <td><?php echo _d($value->date); ?></td> 
                                                <td><?php echo $value->ttl_amt; ?></td>                                                  

                                                <td class="text-center">
													
                                                    <a class="actionBtn" title="View" href="<?php echo admin_url('purchase_payments/payment_details/' . $value->id); ?>"><i class="fa fa-eye" aria-hidden="true"></i></a>

                                                    <?php if(check_permission_page(54,'delete')){ ?>
                                                    <a  title="Delete" href="<?php echo admin_url('purchase_payments/delete/' . $value->id); ?>" class="actionBtn _delete"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    <?php } ?>
                                                    
                                                </td>
                                              </tr>
                                            <?php
                                        }
                                    }
                                    ?>
                                     
                                    </tbody>
                                  </table>

                                <div class="pagination">
                                    <?php echo $this->pagination->create_links(); ?>
                                </div>
                            </div>
                        
                               
                            
                        </div>
						 <!-- <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
							</div> -->
                       
                    </div>
                </div>
             
            <?php echo form_close(); ?>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
</div>

<?php init_tail(); ?>
<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
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

$(document).ready(function() {
    $('#newtable').DataTable( {
        "iDisplayLength": 15,
        dom: 'Bfrtip',
        buttons: [           
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5]
                }
            },
            'colvis'
        ]
    } );
} );
</script>

</body>
</html>

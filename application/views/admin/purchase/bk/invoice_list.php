
<?php init_head(); ?>


<?php
if(!empty($this->session->userdata('purchaseinvoice_search'))){
    $search_arr = $this->session->userdata('purchaseinvoice_search');
}    
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title;  if(check_permission_page(165,'create')){ ?> <a href="<?php echo admin_url('purchase/payment_invoice'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Create new Invoice</a> <?php } ?></h4>

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
                                            <option value="<?php echo $row->id; ?>" <?php if(!empty($vendor_id) && $vendor_id == $row->id){ echo 'selected';} ?>><?php echo $row->name; ?></option>
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
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-3" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
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


                        
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Invoice #</th>
                                        <th>Reference No.</th>
                                        <th>Vendor</th>
                                        <th>Amount</th>
                                        <th>Date</th>
                                        <th>Invoice For</th>
                                        <th>Uploads</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($invoice_list)){
                                        foreach ($invoice_list as $key => $value) {

                                            $document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$value->id."' and rel_type = 'purchase_invoice'")->result_array();

                                            $file_data = '';
                                            if(!empty($document_info)){
                                                foreach ($document_info as $doc) {
                                                    $file_data .= '<a download href="'.site_url('uploads/purchase_invoice/'.$value->id.'/'.$doc['file_name']).'">'.$doc['file_name'].'</a><br>';
                                                }
                                            }else{
                                                $file_data = '--';
                                            }
                                             
                                            ?>
                                            <tr>
                                                <td><?php echo ++$key; ?></td>                                                
                                                <td><?php echo 'Inv-'.str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                <td><?php echo $value->reference_number; ?></td>
                                                <td><a href="<?php echo admin_url('vendor/vendor/'.$value->vendor_id);?>" target="_blank"><?php echo value_by_id('tblvendor',$value->vendor_id,'name'); ?></a></td>
                                                <td><?php echo $value->totalamount; ?></td>
                                                <td><?php echo _d($value->date); ?></td>                                                 
                                                <td><?php echo ($value->invoice_for == 1) ? 'Purchase Order' : 'Work Order'; ?></td>
                                                <td><?php echo $file_data; ?></td>

                                                <td class="text-center">
													
                                                    
                                                    <div class="btn-group pull-right">
                                                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <?php if(check_permission_page(165,'edit')){ ?>
                                                                    <a href="<?php echo admin_url('purchase/payment_invoice/' . $value->id); ?>" >Edit</a>
                                                                <?php } ?>

                                                               <a target="_blank" href="<?php echo admin_url('purchase/purchase_invoice_pdf/'.$value->id);?>" data-status="1">View PDF</a>
															   <?php
																/*if($type == '?type=rent' && $value->status != '5'){
																	?>
																	<a target="_blank" href="<?php echo admin_url('invoices/renew_invoice/'.$value->id);?>" data-status="1">RENEWAL</a>	
																<?php
																}*/
                                                               if(check_permission_page(165,'delete')){
                                                                    ?>
                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('purchase/delete_invoice/'.$value->id);?>" data-status="1">DELETE</a> 
                                                                <?php
                                                                }
																?>
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
            'colvis'
        ]
    } );
} );
</script>
</body>
</html>

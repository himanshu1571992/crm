
<?php init_head(); 


$s_range = '';
$date_a = '';
$date_b = '';
$staff = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}
if(!empty($staff_id)){
  $staff = $staff_id;
}
?>

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

                    <h4 class="no-margin">Sale Invoice List <a href="<?php echo admin_url('invoices/export/?service_type=2&client_id='.$client_id.'&f_date='.$date_a.'&t_date='.$date_b.'&staff_id='.$staff); ?>" type="submit" class="btn btn-info pull-right" style="margin-left: 10px; margin-top:-6px;">Export</a> <?php if(check_permission_page(99,'create')){ ?> <a href="<?php echo admin_url('invoices/invoices'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Create new Invoice</a> <?php } ?></h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <div>
                        <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Client</label>
                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($client_data)){
                                        foreach ($client_data as $row) {
                                            ?>
                                            <option value="<?php echo $row->userid; ?>" <?php if(!empty($search_arr['client_id']) && $search_arr['client_id'] == $row->userid){ echo 'selected';} ?>><?php echo $row->company; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
                                </select>
                            </div>
                        </div>

                        <div class="form-group col-md-2">
                            <label for="staff_id" class="control-label">Employee Name</label>
                            <select class="form-control selectpicker" id="staff_id" name="staff_id" data-live-search="true">
                                <option value="" disabled selected >--Select One-</option>
                                <?php
                                if(!empty($staff_list)){
                                    foreach($staff_list as $staff){
                                        ?>
                                        <option value="<?php echo $staff->staffid;?>" <?php if(!empty($search_arr['staff_id']) && $search_arr['staff_id'] == $staff->staffid){ echo 'selected';} ?>><?php echo $staff->firstname; ?></option>
                                        <?php
                                    }
                                }
                                ?>
                            </select>
                        </div>

                        <div class="col-md-2" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Invoice Status</label>
                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 1){ echo 'selected';} ?>>Unpaid</option>
                                    <option value="2" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 2){ echo 'selected';} ?>>Paid</option>
                                    <option value="3" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 3){ echo 'selected';} ?>>Partially Paid</option>
                                    <option value="4" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 4){ echo 'selected';} ?>>Overdue</option>
                                    <option value="5" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 5){ echo 'selected';} ?>>Cancelled</option>
                                    
                                </select>
                            </div>
                        </div>


                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="f_date" class="control-label">From Date</label>
                            <div class="input-group date">
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($search_arr['f_date'])){ echo $search_arr['f_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($search_arr['t_date'])){ echo $search_arr['t_date']; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>


                        
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button>
                        </div>
                       
                    </div>
                                                
                            <div class="col-md-12">                                                             
                                <table class="table ui-table">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Invoice #</th>
                                        <th>Created By</th>
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
                                                <td><?php echo '<a href="' . site_url('invoice/' . $value->id . '/' . $value->hash) . $type .'" target="_blank">' .format_invoice_number($value->id). '</a>'; ?></td>
                                                <td><?php echo get_employee_name($value->addedfrom); ?></td>
                                                <td><?php echo $value->total; ?></td>
                                                <td><?php echo _d($value->invoice_date); ?></td> 
                                                <td><a href="<?php echo admin_url('clients/client/'.$value->clientid);?>" target="_blank"><?php echo $client_info->client_branch_name; ?></a></td>
                                                <td><?php echo format_invoice_status($value->status); ?></td>

                                                <td class="text-center">
													
                                                    <a href="<?php echo site_url('invoice/'.$value->id.'/'.$value->hash).$type ; ?>" target="_blank" class="actionBtn">View</a>
                                                    <?php if(check_permission_page(99,'edit') && $value->status != '5'){ ?>
                                                    <a href="<?php echo admin_url('invoices/invoices/' . $value->id); ?>" class="actionBtn">Edit</a>
                                                    <?php } ?>
                                                    <div class="btn-group pull-right">
                                                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                               <a target="_blank" href="<?php echo admin_url('invoices/download_pdf/'.$value->id.'/?output_type=I');?>" data-status="1">View PDF</a>
															   <?php
																/*if($type == '?type=rent' && $value->status != '5'){
																	?>
																	<a target="_blank" href="<?php echo admin_url('invoices/renew_invoice/'.$value->id);?>" data-status="1">RENEWAL</a>	
																<?php
																}*/
                                                                if($value->status != '5'){
                                                                    ?>
                                                                    <a class="text-danger _delete" target="_blank" href="<?php echo admin_url('invoices/mark_as_cancelled/'.$value->id);?>" data-status="1">CANCEL</a> 
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


</body>
</html>

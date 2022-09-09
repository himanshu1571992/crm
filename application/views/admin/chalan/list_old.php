
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
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

</style>

<?php
if(!empty($this->session->userdata('challan_search'))){
    $search_arr = $this->session->userdata('challan_search');
}    
?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin">Challan List </h4>

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
                                            <option value="<?php echo $row->userid; ?>" <?php if(!empty($search_arr['client_id']) && $search_arr['client_id'] == $row->userid){ echo 'selected';} ?>><?php echo $row->company; ?></option>
                                            <?php
                                        }
                                    }
                                    ?>
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
                        

                        <!-- <div class="col-md-4">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Challan Status</label>
                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="1" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 1){ echo 'selected';} ?>>Delivered (completed)</option>
                                    <option value="1" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 1){ echo 'selected';} ?>>Pick Up (completed)</option>
                                    <option value="1" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 1){ echo 'selected';} ?>>Pending for Delivery</option>
                                    <option value="1" <?php if(!empty($search_arr['status']) && $search_arr['status'] == 1){ echo 'selected';} ?>>Pending for Pick Up</option>
                                    
                                </select>
                            </div>
                        </div> -->

                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="0" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 0){ echo 'selected';} ?>>Rent</option>
                                    <option value="1" <?php if(!empty($search_arr['service_type']) && $search_arr['service_type'] == 1){ echo 'selected';} ?>>Sale</option>
                                    
                                </select>
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
                                        <th>Challan #</th>
                                        <th>Service Type</th>
                                        <th>Customer</th>
                                        <th>Date</th>
                                        <th class="text-center">Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($invoice_list)){
                                        foreach ($invoice_list as $key => $value) {

                                             $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();

                                             $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 1 ")->row();
                                             $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 2 ")->row();

                                            ?>
                                            <tr>
                                                <td><?php echo ++$key; ?></td>                                                
                                                <td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>
                                                <td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sale'; ?></td>
                                                <td><a href="<?php echo admin_url('clients/client/'.$value->clientid); ?>" target="_blank"><?php echo $client_info->client_branch_name; ?></a></td>
                                                <td><?php echo _d($value->challandate); ?></td> 
                                                <td class="text-center">

                                                    <?php
                                                    if(!empty($delivery_ho)){
                                                        ?>
                                                        <button value="<?php echo $value->id; ?>" val="1" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Delivery HO</button>
                                                        <?php
                                                    }

                                                    if(!empty($pickup_ho)){
                                                       ?>
                                                       <button value="<?php echo $value->id; ?>" val="2" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Pickup HO</button>
                                                       <?php 
                                                    }
                                                    ?>

                                                    

                                                    

                                                	<?php
                                                	if($value->process == 0){
                                                	echo '<button value="'.$value->id.'" title="Make Delivery" type="button" val="1" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Delivery</button>';	
                                                	}elseif($value->process == 1 && $value->under_process == 1){
                                                        echo '<button disabled type="button" class="btn btn-success">Delivery In Process</button>';  
                                                    }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 0){
                                                        echo '<a href="'.admin_url('chalan/make_complete/'.$delivery_ho->id).'" class="btn btn-success">Mark Delivery Complete</a>';  
                                                    }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $value->service_type == 2){
                                                        echo '<button type="button" class="btn btn-info">Completed</button>'; 
                                                    }
                                                    

                                                    elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1){
                                                    echo '<button value="'.$value->id.'" title="Make Pickup" type="button" val="2" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button>';  
                                                    }elseif($value->process == 2 && $value->under_process == 1){
                                                        echo '<button disabled type="button" class="btn btn-success">Pickup In Process</button>';  
                                                    }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){
                                                        echo '<a href="'.admin_url('chalan/make_complete/'.$pickup_ho->id).'" class="btn btn-success">Mark Pick Complete</a>';  
                                                    }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                                        echo '<button type="button" class="btn btn-info">Completed</button>';  
                                                    }

                                                	?>
                                                	

													                                                    
                                                    <div class="btn-group pull-right">
                                                         <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                          <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                         </button>
                                                         <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                                                                               
                                                               <a target="_blank" href="<?php echo admin_url('Chalan/pdf/'.$value->id.'/?output_type=I');?>" data-status="1">View PDF</a>

															   <?php
                                                               if(check_permission_page(100,'edit')){
                                                                    ?>
                                                                    <a class="text-danger" href="<?php echo admin_url('chalan/edit_challan/'.$value->id);?>" data-status="1">Edit</a> 
                                                                <?php
                                                                }
																if(check_permission_page(100,'delete')){
																	?>
																	<a class="text-danger _delete" href="<?php echo admin_url('chalan/deletechalan/'.$value->id);?>" data-status="1">DELETE</a>	
																<?php
																}
																?>

                                                                <?php
                                                                if(!empty($delivery_ho)){
                                                                    ?>
                                                                    <a  href="#" class="uplaods" process_id="<?php echo $delivery_ho->id; ?>" val="1" data-toggle="modal" data-target="#upload_modal">Delivery Uploads</a>
                                                                    <?php
                                                                }
                                                                if(!empty($pickup_ho)){
                                                                    ?>
                                                                    <a  href="#" class="uplaods" process_id="<?php echo $pickup_ho->id; ?>" val="2" data-toggle="modal" data-target="#upload_modal">Pickup Uploads</a>
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
						 <div class="btn-bottom-toolbar text-right">
								<button class="btn btn-info" value="1" name="mark" type="submit">
									<?php echo _l('submit'); ?>
								</button>
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
<div id="deliveryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title action_title"></h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('Chalan/make_delivery'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">

        	<div class="form-group col-md-6">
                <label for="priority" class="control-label">Priority *</label>
                <select class="form-control selectpicker" name="priority" required="">
                    <option value=""></option>
                    <option value="1">Low</option>
					<option value="2">Medium</option>
					<option value="3">High</option>
					<option value="4">Urgent</option>
                </select>
            </div>

            <div class="form-group col-md-6" app-field-wrapper="date">
                <label for="delivery_date" class="control-label" id="date_type">Delivery Date</label>
                <div class="input-group date">
                    <input id="delivery_date" name="delivery_date" class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
            </div>

            <div class="form-group col-md-12">
                <label for="name" class="control-label">Description </label>
                <textarea id="description" name="description" class="form-control"><?php echo (isset($event['description']) && $event['description'] != "") ? $event['description'] : "" ?></textarea>
            </div>

            <input type="hidden" id="chalan_id" name="chalan_id">
            <input type="hidden" id="for" name="for">
        </div>

        <div class="text-right">
            <button class="btn btn-info" type="submit">Submit</button>
        </div>	

    	</form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php init_tail(); ?>


</body>
</html>


<!-- Modal -->
<div id="handover_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title handover_title">Delivery Hand Overs</h4>
      </div>
      <div class="modal-body" id="handover_data">
        
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<div id="upload_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title upload_title">Delivery Challan Uploads</h4>
      </div>
      <div class="modal-body">
        
        <div id="upload_data">
            
        </div>

        <form action="<?php echo admin_url('Chalan/challan_upload'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">

                <div class="form-group col-md-12">
                    <label for="file" class="control-label"><?php echo 'Upload File'; ?></label>
                    <input type="file" id="file" multiple="" name="file[]" style="width: 100%;">
                </div>
                
                <input type="hidden" id="process_id" name="process_id">
            </div>

            <div class="text-right">
                <button class="btn btn-info" type="submit">Submit</button>
            </div>  
        </form>

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<script type="text/javascript">
   
$(document).on('click', '.action', function() {
  var challan_id = $(this).val();
  var type = $(this).attr('val');
  $('#chalan_id').val(challan_id); 
  $('#for').val(type); 

    if(type == 1){
        var title = 'Make Challan Delivery';
        var date_type = 'Delivery Date';
    }else{
        var title = 'Make Challan Pickup';
        var date_type = 'Pickup Date';
    }

     $('.action_title').html(title);  
     $('#date_type').html(date_type);  

}); 


$(document).on('click', '.handover', function() {  

    var challan_id = $(this).val(); 
    var type = $(this).attr('val');
    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/chalan/get_handover_data'); ?>",
        data    : {'challan_id' : challan_id, 'type' : type},
        success : function(response){
            if(response != ''){       

                if(type == 1){
                    var title = 'Delivery Hand Overs';
                }else{
                    var title = 'Pickup Hand Overs';
                }

                 $('.handover_title').html(title);  
                 $('#handover_data').html(response);  
            }
        }
    })

});

$(document).on('click', '.uplaods', function() {  

    var process_id = $(this).attr('process_id');
    var type = $(this).attr('val');

    $('#upload_data').html('');

    $('#process_id').val(process_id); 

    $.ajax({
        type    : "POST",
        url     : "<?php echo site_url('admin/chalan/get_uploads_data'); ?>",
        data    : {'process_id' : process_id},
        success : function(response){
            if(response != ''){       

                if(type == 1){
                    var title = 'Delivery Challan Uploads';
                }else{
                    var title = 'Pickup Challan Uploads';
                }

                 $('.upload_title').html(title);  
                 $('#upload_data').html(response);  
            }
        }
    })

});    
</script>

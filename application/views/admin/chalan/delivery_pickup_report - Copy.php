
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

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; ?> </h4>

                    <hr class="hr-panel-heading">

                    <div class="row">
                    
                    <!-- <div>
                        <div class="col-md-4" id="employee_div">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Client</label>
                                <select class="form-control selectpicker" id="client_id" name="client_id" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <?php
                                    if(!empty($client_data)){
                                        foreach ($client_data as $row) {
                                            ?>
                                            <option value="<?php echo $row->userid; ?>" <?php if(!empty($client_id) && $client_id == $row->userid){ echo 'selected';} ?>><?php echo cc($row->company); ?></option>
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
                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>

                        <div class="form-group col-md-2" app-field-wrapper="date">
                            <label for="t_date" class="control-label">To Date</label>
                            <div class="input-group date">
                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                        

                        <div class="col-md-2">
                            <div class="form-group ">
                                <label for="branch_id" class="control-label">Service Type</label>
                                <select class="form-control selectpicker" id="service_type" name="service_type" data-live-search="true">
                                    <option value="" disabled selected >--Select One-</option>
                                    <option value="0" <?php if(!empty($service_type) && $service_type == 0){ echo 'selected';} ?>>Rent</option>
                                    <option value="1" <?php if(!empty($service_type) && $service_type == 1){ echo 'selected';} ?>>Sale</option>
                                    
                                </select>
                            </div>
                        </div>
                       
                        
                        <div class="col-md-2">                            
                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            <button type="submit" value="1" name="reset" style="margin-top: 24px;" class="btn btn-danger">Reset</button>
                        </div>
                       
                    </div> -->

                    <div class="col-md-12">
                        <hr>
                    </div>

                    <div class="col-md-12">                                                             
                        <table class="table" id="newtable">
                            <thead>
                              <tr>
                                <th>S.No</th>
                                <th>For</th>
                                <th>Client Name</th>
                                <th>Service Type</th>
                                <th>Product Details</th>
                                <th>Location</th>
                                <th>Date</th>
                                <th>Assigned to</th>
                              </tr>
                            </thead>
                            <tbody>
                            <?php
                            if(!empty($challan_ids)){
                                foreach ($challan_ids as $key => $id) {

                                     $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$id."' ")->row();

                                     $shipto_info = get_ship_to_array($challan_info->site_id);

                                     $product_data = json_decode($challan_info->product_json);
                                     $product_details = '--';
                                     if(!empty($product_data)){
                                          $i = 1;
                                          foreach ($product_data as $value) {

                                            $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                            if($isOtherCharge == 0){

                                                if($i == 1){
                                                    $product_details = value_by_id('tblproducts',$value->product_id,'sub_name').' '.$value->product_qty.' '.get_product_units($value->product_id);
                                                }else{
                                                    $product_details .= ', '.value_by_id('tblproducts',$value->product_id,'sub_name').' '.$value->product_qty.' '.get_product_units($value->product_id);
                                                }
                                                $i++;
                                            }
                                             
                                          }
                                        }

                                    ?>
                                    <tr>
                                        <td><?php echo ++$key; ?></td> 
                                        <td><?php echo ($challan_info->process == 1) ? 'DELIVERY' : 'PICKUP'; ?></td>
                                        <td><?php echo client_info($challan_info->clientid)->client_branch_name; ?></td>
                                        <td><?php echo ($challan_info->service_type == 1) ? 'RENT' : 'SALE'; ?></td>
                                        <td><?php echo $product_details; ?></td>
                                        <td><?php echo $shipto_info['city'].', '.$shipto_info['state']; ?></td> 
                                        <td><?php echo _d($challan_info->challandate); ?></td> 
                                        <td><?php echo value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'); ?></td>
                                        
                                    </tr>
                                    <?php
                                }
                            }
                            ?>
                             
                            </tbody>
                          </table>
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

            <div class="form-group col-md-6">
                <label for="branch_id" class="control-label">Select Branch *</label>
                <select class="form-control selectpicker" name="branch_id" required="">
                    <option value=""></option>
                    <?php
                    if(!empty($branch_info)){
                        foreach ($branch_info as $branch) {
                            ?>
                            <option value="<?php echo $branch->id; ?>"><?php echo $branch->comp_branch_name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <div class="form-group col-md-6">
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
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>

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

<?php if(isset($client)){ 
$where = "clientid = '".$client->userid."' ";
if(!empty($_GET)){
  extract($this->input->get());
  if(!empty($from_date) && !empty($to_date)){

    $from_date = $from_date.' 00:00:00';
    $to_date = $to_date.' 23:59:59';
    $where = " `datecreated` >= '".$from_date."' and `datecreated` <= '".$to_date."' "; 
  } 
 
}
$challan_list = $this->db->query("SELECT * from `tblchalanmst` where ".$where." ORDER BY id desc ")->result();
?>
<h4 class="customer-profile-group-heading">Created Chalan</h4>
<div class="row">
    <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('clients/challan_search'); ?>">
      <input type="hidden" name="clientid" value="<?php echo $client->userid; ?>">
     <div class="col-md-3">
        <div class="form-group select-placeholder">
            <select class="selectpicker" name="range" id="range" data-width="100%" required="" onchange="render_customer_statement();">
                <option value="">--Select One--</option>
                <option value="1" <?php if(!empty($range) && $range == 1){ echo 'selected'; } ?>>Today</option>
                <option value="2" <?php if(!empty($range) && $range == 2){ echo 'selected'; } ?>>This Week</option>
                <option value="3" <?php if(!empty($range) && $range == 3){ echo 'selected'; } ?>>This Month</option>
                <option value="4" <?php if(!empty($range) && $range == 4){ echo 'selected'; } ?>>Last Month</option>
                <option value="5" <?php if(!empty($range) && $range == 5){ echo 'selected'; } ?>>This Year</option>
                <option value="period" <?php if(!empty($range) && $range == 'period'){ echo 'selected'; } ?>>Custom Date</option>
            </select>
        </div>
       
    </div>
     <div class="col-md-3">
           <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?> ">
              <div class="input-group date">
                  <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if(!empty($f_date)){ echo $f_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
          </div>
      </div>
      <div class="col-md-3">
          <div class="period <?php if(!empty($range) && $range == 'period'){  }else{ echo 'hide'; } ?>">
               <div class="input-group date">
                  <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if(!empty($t_date)){ echo $t_date; } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
              </div>
          </div>
      </div>

    
    <div class="form-group col-md-2 float-right">
      <button class="form-control btn-info" type="submit">Search</button>
    </div>
    </form>

    <div class="col-md-12">  
    <hr>                             
        <table class="table" id="newtable">
                  <thead>
                    <tr>
                      <th>S.No</th>
                      <th>Challan #</th>
                      <th>Staff Name</th>
                      <th>Service Type</th>
                      <th>Customer</th>
                      <th>Date</th>
                      <th class="text-center">Action</th>
                    </tr>
                  </thead>
                 <tbody>
                  <?php
                  if(!empty($challan_list)){
                      foreach ($challan_list as $key => $value) {

                           $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();

                           $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 1 ")->row();
                           $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 2 ")->row();

                          ?>
                          <tr>
                              <td><?php echo ++$key; ?></td>                                                
                              <td><?php echo '<a target="_blank" href="' . site_url('admin/chalan/view/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>
                              <td><?php echo get_employee_name($value->addedfrom); ?></td>
                              <td><?php echo ($value->service_type == 1) ? 'Rent' : 'Sale'; ?></td>
                              <td><a href="<?php echo admin_url('clients/client/'.$value->clientid); ?>" target="_blank"><?php echo cc($client_info->client_branch_name); ?></a></td>
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
      </div>                  
  </div>

<?php } ?>




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


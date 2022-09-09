<?php

$session_id = $this->session->userdata();
?>
<?php init_head(); ?>
<div id="wrapper">
  <div class="content">
    <div class="row">
      <div class="col-md-12">
        <div class="panel_s">
          <div class="panel-body">
            <h4><?php echo $title; ?></h4>
          <div class="clearfix"></div>
          <hr class="hr-panel-heading" />
          <ul class="nav nav-tabs" role="tablist">
            <li role="presentation" class="<?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>"><a  href="#pending" aria-controls="pending" role="tab" data-toggle="tab">Pending Delivery & Pickup</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>"><a href="#completed" aria-controls="completed" role="tab" data-toggle="tab">Completed Delivery & Pickup</a></li>
            
            <!--<li role="presentation"><a href="#phrases" aria-controls="phrases" role="tab" data-toggle="tab">third</a></li>-->
          </ul>
          <div class="tab-content">


            <div role="tabpanel" class="tab-pane <?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>" id="pending">
              <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="1" name="from_page">
              <div class="row">

              <div class="form-group col-md-2" app-field-wrapper="date">
                <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                  <div class="input-group date">
                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
              </div>

               

              <div class="form-group col-md-2" app-field-wrapper="date">
                <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                  <div class="input-group date">
                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text">
                  <div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>

              </form>


            <div class="table-responsive" style="margin-bottom:30px;">
              <table class="table" id="payfill_table">
                    <thead>
                        <tr>
                            <th>S.No</th>
                            <th>For</th>
                            <th>Client Name</th>
                            <th>Service Type</th>
                            <th>Product Details</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Assigned to</th>
                            <th>Remark</th>
                            <th>Action</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php

                $j=1;

                if(!empty($pending_delivery_info)){              
                      foreach ($pending_delivery_info as $row) { 

                            $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$row->main_id."' ")->row();
                            $challanprocess_info = $this->db->query("SELECT description from `tblchallanprocess` where chalan_id = '".$row->main_id."' and `for` = 1 ")->row();

                            $shipto_info = get_ship_to_array($challan_info->site_id);

                            $product_data = json_decode($challan_info->product_json);
                             

                      ?>
                       <tr <?php echo ($row->date < date('Y-m-d') ) ? 'style="background-color: red; color: white;"' : ''; ?> >
                            <td><?php echo $j++; ?></td> 
                            <td><?php echo 'DELIVERY'; ?></td>
                            <td><?php echo client_info($challan_info->clientid)->client_branch_name; ?></td>
                            <td><?php echo ($challan_info->service_type == 1) ? 'RENT' : 'SALE'; ?></td>
                            <td>
                                <?php 
                                if(!empty($product_data)){
                                    foreach ($product_data as $value) {
                                        $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                        if($isOtherCharge == 0){
                                          echo value_by_id('tblproducts',$value->product_id,'sub_name').'<br>';
                                        }
                                    }
                                }
                                ?>                                    
                            </td>
                            <td>
                                <?php 
                                if(!empty($product_data)){
                                    foreach ($product_data as $value) {
                                        $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                        if($isOtherCharge == 0){
                                          echo $value->product_qty.' '.get_product_units($value->product_id).'<br>';
                                        }
                                    }
                                }
                                ?>                                    
                            </td>
                            <td><?php echo $shipto_info['city'].', '.$shipto_info['state']; ?></td> 
                            <td><?php echo _d($challan_info->challandate); if(!empty($challan_info->new_date)){ echo '<br> To <br>'._d($challan_info->new_date); } ?></td> 
                            <td><?php echo value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'); ?></td>
                            <td><?php echo (!empty($challanprocess_info->description)) ? $challanprocess_info->description : '--' ; ?></td>
                            <td>
                                <a style="margin-right: 20px;" class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('chalan/activity_log/1/'.$row->main_id); ?>">Activity</a>
                                <div class="btn-group pull-right">
                                     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                     </button>
                                     <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                        <li>
                                           <button value="<?php echo $row->main_id; ?>" val="1" type="button" class="btn-update change_date" data-toggle="modal" data-target="#changeDateModal">Change Date</button>
                                            <button value="<?php echo $row->main_id; ?>" val="1" type="button" class="btn-update update_remark" data-toggle="modal" data-target="#updateRemarkModal">Update Remark</button>
                                        </li>
                                     </ul>
                                </div>

                                
                            </td>
                            
                        </tr> 
        
                       <?php
                    }                      
                }

                if(!empty($pending_pickup_info)){              
                      foreach ($pending_pickup_info as $row) { 

                            $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$row->main_id."' ")->row();
                            $challanprocess_info = $this->db->query("SELECT description from `tblchallanprocess` where chalan_id = '".$row->main_id."' and `for` = 2 ")->row();

                            $shipto_info = get_ship_to_array($challan_info->site_id);

                             $product_data = json_decode($challan_info->product_json);

                      ?>
                        <tr <?php echo ($row->date < date('Y-m-d') ) ? 'style="background-color: red; color: white;"' : ''; ?> >
                            <td><?php echo $j++; ?></td> 
                            <td><?php echo 'PICKUP'; ?></td>
                            <td><?php echo client_info($challan_info->clientid)->client_branch_name; ?></td>
                            <td><?php echo ($challan_info->service_type == 1) ? 'RENT' : 'SALE'; ?></td>
                            <td>
                                <?php 
                                if(!empty($product_data)){
                                    foreach ($product_data as $value) {
                                        $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                        if($isOtherCharge == 0){
                                          echo value_by_id('tblproducts',$value->product_id,'sub_name').'<br>';
                                        }
                                    }
                                }
                                ?>                                    
                            </td>
                            <td>
                                <?php 
                                if(!empty($product_data)){
                                    foreach ($product_data as $value) {
                                        $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                        if($isOtherCharge == 0){
                                          echo $value->product_qty.' '.get_product_units($value->product_id).'<br>';
                                        }
                                    }
                                }
                                ?>                                    
                            </td>
                            <td><?php echo $shipto_info['city'].', '.$shipto_info['state']; ?></td> 
                            <td><?php echo _d($challan_info->challandate); if(!empty($challan_info->new_date)){ echo '<br> To <br>'._d($challan_info->new_date); } ?></td>  
                            <td><?php echo value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'); ?></td>
                            <td><?php echo (!empty($challanprocess_info->description)) ? $challanprocess_info->description : '--' ; ?></td>
                            <td>
                                <a style="margin-right: 20px;" class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('chalan/activity_log/1/'.$row->main_id); ?>">Activity</a>
                                <div class="btn-group pull-right">
                                     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                     </button>
                                     <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                        <li>
                                           <button value="<?php echo $row->main_id; ?>" val="2" type="button" class="btn-update change_date" data-toggle="modal" data-target="#changeDateModal">Change Date</button>
                                            <button value="<?php echo $row->main_id; ?>" val="2" type="button" class="btn-update update_remark" data-toggle="modal" data-target="#updateRemarkModal">Update Remark</button>
                                        </li>
                                     </ul>
                                </div>

                                
                            </td>
                            
                        </tr> 
        
                       <?php
                    }                      
                } 

                if(!empty($pending_other_info)){              
                      foreach ($pending_other_info as $row) { 

                            $task_info = $this->db->query("SELECT * from `tbltasks` where id = '".$row->main_id."' ")->row();

                            $assigned_to = explode(',', $task_info->assigned_to);

                           
                      ?>
                       <tr <?php echo ($row->date < date('Y-m-d') ) ? 'style="background-color: red; color: white;"' : ''; ?> >

                            <td><?php echo $j++; ?></td> 
                            <td><?php echo 'OTHER'; ?></td>
                            <td><?php echo ($task_info->client_id > 0) ? client_info($task_info->client_id)->client_branch_name : $task_info->client_name; ?></td>
                            <td><?php echo ($task_info->service_type == 1) ? 'RENT' : 'SALE'; ?></td>
                            <td><?php echo $task_info->product_details; ?></td>
                            <td><?php echo '--'; ?></td>
                            <td><?php echo get_city($task_info->city_id).', '.get_city($task_info->state_id); ?></td> 
                            <td><?php echo _d($task_info->other_date); if(!empty($task_info->new_date)){ echo '<br> To <br>'._d($task_info->new_date); } ?></td> 
                            <td>
                                <?php
                                if(!empty($assigned_to)){
                                    foreach ($assigned_to as $key => $staff_id) {
                                        
                                        if($key == 0){
                                            $staff_name = get_employee_name($staff_id);                                            
                                        }else{
                                            $staff_name .= ', '.get_employee_name($staff_id);
                                        }
                                    }
                                    echo $staff_name;
                                }

                                ?>
                            </td>
                            <td><?php echo $task_info->description; ?></td>
                            <td>
                                <a style="margin-right: 20px;" class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('chalan/activity_log/2/'.$row->main_id); ?>">Activity</a>
                                <div class="btn-group pull-right">
                                     <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                      <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                     </button>
                                     <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                        <li>
                                           <button value="<?php echo $row->main_id; ?>" val="3" type="button" class="btn-update change_date" data-toggle="modal" data-target="#changeDateModal">Change Date</button>
                                            <button value="<?php echo $row->main_id; ?>" val="3" type="button" class="btn-update update_remark" data-toggle="modal" data-target="#updateRemarkModal">Update Remark</button>
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



          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>" id="completed">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="2" name="from_page">
            <div class="row">  

                <div class="form-group col-md-2" app-field-wrapper="date">
                  <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                  <div class="input-group date">
                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>
              
                <div class="form-group col-md-2" app-field-wrapper="date">
                  <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                  <div class="input-group date">
                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : "" ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                  </div>
                </div>                   

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

            </div>

            </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table" id="newtable">
                      <thead>
                          <tr>
                            <th>S.No</th>
                            <th>For</th>
                            <th>Client Name</th>
                            <th>Service Type</th>
                            <th>Product Details</th>
                            <th>Quantity</th>
                            <th>Location</th>
                            <th>Date</th>
                            <th>Assigned to</th>
                            <th>Remark</th>
                            <th>Action</th>

                          </tr>
                      </thead>
                       
                <tbody class="ui-sortable">

             <?php
                
                $j=1;

                if(!empty($complete_info)){              
                      foreach ($complete_info as $row) { 

                            $challan_info = $this->db->query("SELECT * from `tblchalanmst` where id = '".$row->main_id."' ")->row();
                            $challanprocess_info = $this->db->query("SELECT description from `tblchallanprocess` where chalan_id = '".$row->main_id."' and `for` = 1 ")->row();

                            $shipto_info = get_ship_to_array($challan_info->site_id);

                            $product_data = json_decode($challan_info->product_json);

                            if($challan_info->service_type == 1){
                                $service_type = 'RENT';
                                $type = 'DELIVERY & PICKUP';
                            }else{
                                $service_type = 'SALE';
                                $type = 'DELIVERY';
                            }
                             

                      ?>
                       <tr>
                            <td><?php echo $j++; ?></td> 
                            <td><?php echo $type; ?></td>
                            <td><?php echo client_info($challan_info->clientid)->client_branch_name; ?></td>
                            <td><?php echo $service_type; ?></td>
                            <td>
                                <?php 
                                if(!empty($product_data)){
                                    foreach ($product_data as $value) {
                                        $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                        if($isOtherCharge == 0){
                                          echo value_by_id('tblproducts',$value->product_id,'sub_name').'<br>';
                                        }
                                    }
                                }
                                ?>                                    
                            </td>
                            <td>
                                <?php 
                                if(!empty($product_data)){
                                    foreach ($product_data as $value) {
                                        $isOtherCharge = value_by_id('tblproducts',$value->product_id,'isOtherCharge');
                                        if($isOtherCharge == 0){
                                          echo $value->product_qty.' '.get_product_units($value->product_id).'<br>';
                                        }
                                    }
                                }
                                ?>                                    
                            </td>
                            <td><?php echo $shipto_info['city'].', '.$shipto_info['state']; ?></td> 
                            <td><?php echo _d($challan_info->challandate); if(!empty($challan_info->new_date)){ echo '<br> To <br>'._d($challan_info->new_date); } ?></td> 
                            <td><?php echo value_by_id('tblcompanybranch',$challan_info->billing_branch_id,'comp_branch_name'); ?></td>
                            <td><?php echo (!empty($challanprocess_info->description)) ? $challanprocess_info->description : '--' ; ?></td>
                            <td><a style="margin-right: 20px;" class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('chalan/activity_log/1/'.$row->main_id); ?>">Activity</a></td>
                            
                        </tr> 
        
                       <?php
                    }                      
                }               

                if(!empty($complete_other_info)){              
                      foreach ($complete_other_info as $row) { 

                            $task_info = $this->db->query("SELECT * from `tbltasks` where id = '".$row->main_id."' ")->row();

                            $assigned_to = explode(',', $task_info->assigned_to);

                           
                      ?>
                       <!-- <tr <?php echo ($row->date < date('Y-m-d') ) ? 'style="background-color: red; color: white;"' : ''; ?> > -->
                       <tr>

                            <td><?php echo $j++; ?></td> 
                            <td><?php echo 'OTHER'; ?></td>
                            <td><?php echo ($task_info->client_id > 0) ? client_info($task_info->client_id)->client_branch_name : $task_info->client_name; ?></td>
                            <td><?php echo ($task_info->service_type == 1) ? 'RENT' : 'SALE'; ?></td>
                            <td><?php echo $task_info->product_details; ?></td>
                            <td><?php echo '--'; ?></td>
                            <td><?php echo get_city($task_info->city_id).', '.get_city($task_info->state_id); ?></td> 
                            <td><?php echo _d($task_info->other_date); if(!empty($task_info->new_date)){ echo '<br> To <br>'._d($task_info->new_date); } ?></td> 
                            <td>
                                <?php
                                if(!empty($assigned_to)){
                                    foreach ($assigned_to as $key => $staff_id) {
                                        
                                        if($key == 0){
                                            $staff_name = get_employee_name($staff_id);                                            
                                        }else{
                                            $staff_name .= ', '.get_employee_name($staff_id);
                                        }
                                    }
                                    echo $staff_name;
                                }

                                ?>
                            </td>
                            <td><?php echo $task_info->description; ?></td>
                            <td><a style="margin-right: 20px;" class="btn-info btn-sm" target="_blank" href="<?php echo admin_url('chalan/activity_log/2/'.$row->main_id); ?>">Activity</a></td>
                            
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
   </div>
 </div>
</div>
</div>
<!-- /.modal -->
<?php init_tail(); ?>

</body>


<!-- Modal -->
<div id="changeDateModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Set New Date</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('Chalan/change_chalan_date'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">

            
            <div class="form-group col-md-6" app-field-wrapper="date">
                <label for="delivery_date" class="control-label" id="date_type">New Date</label>
                <div class="input-group date">
                    <input id="delivery_date" name="delivery_date" class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
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

<div id="updateRemarkModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Update Spacial Remark</h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('Chalan/change_chalan_remark'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">

            
            <div class="form-group col-md-12">
                <label for="name" class="control-label">New Remark </label>
                <textarea id="description" name="description" class="form-control"></textarea>
            </div>

            <input type="hidden" id="remark_chalan_id" name="chalan_id">
            <input type="hidden" id="remark_for" name="for">
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

$(document).on('click', '.change_date', function() {
  var challan_id = $(this).val();
  var type = $(this).attr('val');
  $('#chalan_id').val(challan_id); 
  $('#for').val(type);  

});

$(document).on('click', '.update_remark', function() {
  var challan_id = $(this).val();
  var type = $(this).attr('val');
  $('#remark_chalan_id').val(challan_id); 
  $('#remark_for').val(type);  

});

$(document).ready(function() {

    $('#newtable').DataTable( {

      

        "iDisplayLength": 25,

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

                    columns: ':visible'

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: ':visible'

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: ':visible'

                }

            },

            'colvis',

        ]

    } );

} );

</script>
<script type="text/javascript">

    $('#payfill_table').DataTable( {

      

        "iDisplayLength": 25,

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

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9 ]

                }

            },

            'colvis',

        ]

    } );


</script>

</html>

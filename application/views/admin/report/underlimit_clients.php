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
            <li role="presentation" class="<?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>"><a  href="#running_outstanding" aria-controls="running_outstanding" role="tab" data-toggle="tab">Running Outstanding Clients</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>"><a href="#closed_outstanding" aria-controls="closed_outstanding" role="tab" data-toggle="tab">Closed Outstanding Clients</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 3) ? 'active' : ''; ?>"><a href="#sales_outstanding" aria-controls="sales_outstanding" role="tab" data-toggle="tab">Sales Outstanding Clients</a></li>
            
            <!--<li role="presentation"><a href="#phrases" aria-controls="phrases" role="tab" data-toggle="tab">third</a></li>-->
          </ul>
          <div class="tab-content">


            <div role="tabpanel" class="tab-pane <?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>" id="running_outstanding">
              <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="1" name="from_page">
              <div class="row">

              <div class="form-group col-md-3">
                <label for="status" class="control-label">Select Status</label>
                <select class="form-control selectpicker" id="status" name="status[]" multiple="">
                  <option value="" disabled >--Select One-</option>
                  <?php
                  if(!empty($clinet_status)){
                    foreach ($clinet_status as $value) {
                      $selected = '';
                      if(!empty($status_1)){
                        if(in_array($value->id, $status_1)){
                            $selected = 'selected';
                        }
                      }
                     
                      $running_count = $this->home_model->get_running_clients($client_ids,$value->id);
                      ?>
                      <option value="<?php echo $value->id; ?>"<?php echo $selected; ?>><?php echo $value->name." "."(".$running_count.")"; ?></option>
                      <?php
                    }
                  }
                  ?>
                  
                </select>
              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>
              <div class="row">
                  <div class="col-md-12 text-center totalAmount-row">
                      <h4 id="amt" style="color: red;"></h4>
                      <h4 id="cnt" style="color: red;"></h4>
                  </div>  
              </div>
              </form>


            <div class="table-responsive" style="margin-bottom:30px;">
              <table class="table newtable" id="payfill_table">
                    <thead>
                        <tr>
                            <th width="7%">S.No</th>
                            <th width="25%">Client Name</th>                                        
                            <th width="16%">Client Status</th>                                        
                            <th width="10%">Activity</th>                                        
                            <th width="7%">Contacts</th>
                            <th width="25%">Assigned Details</th>
                            <th width="10%">Outstanding</th>
                            <th width="10%">Other Collection</th>
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php

                $i=1;
                $ttl_running_amt = 0;
                if(!empty($running_clinets)){              
                      foreach ($running_clinets as $row) { 
                         
                          $bal_amt = client_balance_amt($row->userid,1);

                          //if($bal_amt > 0 && $bal_amt <= $row->credit_limit ){
                          if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){

                          	if($bal_amt > 1){
                              $ttl_running_amt += $bal_amt;

                              $status_dtl = $this->db->query("SELECT * from `tblclientstatus` where id = '".$row->client_status."' ")->row_array();

                               $outputType = '<span class="inline-block label label-' . (empty($status_dtl['color']) ? 'default': '') . '" style="color:' . $status_dtl['color'] . ';border:1px solid ' . $status_dtl['color'] . '">' . $status_dtl['name'];
                                $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $row->userid . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                $outputType .= '</a>';

                                $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $row->userid . '">';
                                foreach ($clinet_status as $status_row) {
                                    if ($row->client_status != $status_row->id) {
                                        $outputType .= '<li>
                                      <a href="#" onclick="change_client_status(' . $status_row->id . ',' . $row->userid . ',' . $row->client_status . '); return false;">
                                         ' . cc($status_row->name) . '
                                      </a>
                                   </li>';
                                    }
                                }
                                $outputType .= '</ul>';
                                $outputType .= '</div>';
                                $outputType .= '</span>';
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid.'/under_over_limit')?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><?php echo $outputType; ?><input type="hidden" name="client_id" value="<?php echo $row->userid; ?>"></td>
                        <td><a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->userid); ?>">Activity</a></td>
                        <td><a class="text-right" target="_blank" href="<?php echo base_url("admin/follow_up/payment_contact/".$row->userid)?>" class="pull-right text-muted" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></a></td>
                        <td><?php 
                        if(!empty($row->staff_group)){ 
                            $group_arr = explode(',', $row->staff_group);
                            $group_nams = '';
                            foreach ($group_arr as $k => $group_id) {
                                if($k == 0){
                                    $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                }else{
                                    $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                }                                
                            }
                            //echo '<button type="button" class="btn-info btn-sm show_group" value="'.$row->userid.'" data-toggle="modal" data-target="#myModal">'.$group_nams.'</button>';
                            echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$row->userid).'" class="btn-sm btn-info pull-left display-block">'.$group_nams.'</a>';
                        }else{
                          echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$row->userid).'" class="btn-sm btn-info pull-left display-block">Allot Group</a>';
                        } 
                        ?></td>
                        <td><?php echo $bal_amt; ?></td>
                        <td><a class="btn-sm btn-info text-center other_collection" href="#othercollection_modal" data-toggle="modal" data-id="<?php echo $row->userid; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></td>                        
                      </tr> 
        
                       <?php 
                        }
                        }
                    }                      
                }                

                ?>
                </tbody> 
                      <tfoot>
                          <tr>
                              <td align="center" colspan="7">Total</td>
                              <td align=""><b><?php echo number_format($ttl_running_amt, 2, '.', ''); ?></b></td>
                              <input type="hidden" id="get_count" value="<?php echo number_format($ttl_running_amt, 2, '.', ''); ?>">
                          </tr>
                      </tfoot>                             
               </table>
             </div>
           </div>



          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>" id="closed_outstanding">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="2" name="from_page">
              <div class="row">

              <div class="form-group col-md-3">
                <label for="status" class="control-label">Select Status</label>
                <select class="form-control selectpicker" id="status" name="status[]" multiple="">
                  <option value="" disabled >--Select One-</option>
                  <?php
                  foreach ($clinet_status as $value) {
                      $selected = '';
                      if(!empty($status_2)){
                        if(in_array($value->id, $status_2)){
                            $selected = 'selected';
                        }
                      }

                      $closed_count = $this->home_model->get_closed_clients($client_ids,$value->id);
                      ?>
                      <option value="<?php echo $value->id; ?>"<?php echo $selected; ?>><?php echo $value->name." "."(".$closed_count.")"; ?></option>
                      <?php
                    }
                  ?>
                  
                </select>
              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>
              <div class="row">
                  <div class="col-md-12 text-center totalAmount-row">
                      <h4 id="amt1" style="color: red;"></h4>
                      <h4 id="cnt1" style="color: red;"></h4>
                  </div>  
              </div>
              </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table newtable" id="payfill_table1">
                      <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Client Name</th>                                       
                            <th>Client Status</th>                                       
                            <th>Activity</th>                                        
                            <th>Contacts</th>
                            <th>Assigned Details</th>
                            <th>Outstanding</th> 
                            <th>Other Collection</th>
                        </tr>
                      </thead>
                       
                <tbody class="ui-sortable">

             <?php

                $i=1;
                $ttl_closed_amt = 0;
                if(!empty($closed_clinets)){              
                      foreach ($closed_clinets as $row) { 
                         
                          $bal_amt = client_balance_amt($row->userid,1);

                          if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){

                          	if($bal_amt > 1){

                              $ttl_closed_amt += $bal_amt;

                              $status_dtl = $this->db->query("SELECT * from `tblclientstatus` where id = '".$row->client_status."' ")->row_array();

                               $outputType = '<span class="inline-block label label-' . (empty($status_dtl['color']) ? 'default': '') . '" style="color:' . $status_dtl['color'] . ';border:1px solid ' . $status_dtl['color'] . '">' . $status_dtl['name'];
                                $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $row->userid . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                $outputType .= '</a>';

                                $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $row->userid . '">';
                                foreach ($clinet_status as $status_row) {
                                    if ($row->client_status != $status_row->id) {
                                        $outputType .= '<li>
                                      <a href="#" onclick="change_client_status1(' . $status_row->id . ',' . $row->userid . ',' . $row->client_status . '); return false;">
                                         ' . cc($status_row->name) . '
                                      </a>
                                   </li>';
                                    }
                                }
                                $outputType .= '</ul>';
                                $outputType .= '</div>';
                                $outputType .= '</span>';
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid.'/under_over_limit')?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><?php echo $outputType; ?></td>
                        <td><a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->userid); ?>">Activity</a></td>
                        <td><a class="text-right" target="_blank" href="<?php echo base_url("admin/follow_up/payment_contact/".$row->userid)?>" class="pull-right text-muted" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></a></td>
                        <td><?php 
                        if(!empty($row->staff_group)){ 
                            $group_arr = explode(',', $row->staff_group);
                            $group_nams = '';
                            foreach ($group_arr as $k => $group_id) {
                                if($k == 0){
                                    $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                }else{
                                    $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                }                                
                            }
                            //echo '<button type="button" class="btn-info btn-sm show_group" value="'.$row->userid.'" data-toggle="modal" data-target="#myModal">'.$group_nams.'</button>';
                            echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$row->userid).'" class="btn-sm btn-info pull-left display-block">'.$group_nams.'</a>';
                        }else{
                          echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$row->userid).'" class="btn-sm btn-info pull-left display-block">Allot Group</a>';
                        } 
                        ?></td> 
                        <td><?php echo $bal_amt; ?></td> 
                        <td><a class="btn-sm btn-info text-center other_collection" href="#othercollection_modal" data-toggle="modal" data-id="<?php echo $row->userid; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></td>

                      </tr> 
        
                       <?php 
                        	}
                        }
                    }                      
                }                

                ?>

                </tbody>

                <tfoot>
                    <tr>
                        <td align="center" colspan="7">Total</td>
                        <td align=""><b><?php echo number_format($ttl_closed_amt, 2, '.', ''); ?></b></td>
                        <input type="hidden" id="get_count1" value="<?php echo number_format($ttl_closed_amt, 2, '.', ''); ?>">
                    </tr>
                </tfoot>

               </table>

             </div>
          </div>


          <div role="tabpanel" class="tab-pane <?php echo (!empty($from_page) && $from_page == 3) ? 'active' : ''; ?>" id="sales_outstanding">
            <form method="post" enctype="multipart/form-data" action="">
              <input type="hidden" value="3" name="from_page">
              <div class="row">

              <div class="form-group col-md-3">
                <label for="status" class="control-label">Select Status</label>
                <select class="form-control selectpicker" id="status" name="status[]" multiple="">
                  <option value="" disabled >--Select One-</option>
                  <?php
                  if(!empty($clinet_status)){
                    foreach ($clinet_status as $value) {
                      $selected = '';
                      if(!empty($status_3)){
                        if(in_array($value->id, $status_3)){
                            $selected = 'selected';
                        }
                      }
                     // $sales_count = $this->home_model->get_sales_clients($sales_client_ids,$value->id);

                      ?>
                      <option value="<?php echo $value->id; ?>"<?php echo $selected; ?>><?php echo $value->name; ?></option>
                      <?php
                    }
                  }
                  ?>
                  
                </select>
              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>
              <div class="row">
                  <div class="col-md-12 text-center totalAmount-row">
                      <h4 id="amt2" style="color: red;"></h4>
                      <h4 id="cnt2" style="color: red;"></h4>
                  </div>  
              </div>
              </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table newtable"  id="payfill_table2">
                      <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Client Name</th>                                       
                            <th>Client Status</th>                                       
                            <th>Activity</th>                                        
                            <th>Contacts</th>
                            <th>Assigned Details</th>
                            <th>Outstanding</th> 
                            <th>Other Collection</th>
                        </tr>
                      </thead>
                       
                <tbody class="ui-sortable">

             <?php

                $i=1;
                $ttl_sales_amt = 0;
                if(!empty($sales_clinets)){              
                      foreach ($sales_clinets as $row) { 
                         
                          $bal_amt = client_balance_amt($row->userid,2);

                          if($row->credit_limit == 0 || $bal_amt <= $row->credit_limit ){
                          	if($bal_amt > 1){

                              $ttl_sales_amt += $bal_amt;

                              $status_dtl = $this->db->query("SELECT * from `tblclientstatus` where id = '".$row->client_status."' ")->row_array();

                               $outputType = '<span class="inline-block label label-' . (empty($status_dtl['color']) ? 'default': '') . '" style="color:' . $status_dtl['color'] . ';border:1px solid ' . $status_dtl['color'] . '">' . $status_dtl['name'];
                                $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $row->userid . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                $outputType .= '</a>';

                                $outputType .= '<ul class="dropdown-menu dropdown-menu-right scroll" aria-labelledby="tableLeadsStatus-' . $row->userid . '">';
                                foreach ($clinet_status as $status_row) {
                                    if ($row->client_status != $status_row->id) {
                                        $outputType .= '<li>
                                      <a href="#" onclick="change_client_status2(' . $status_row->id . ',' . $row->userid . ',' . $row->client_status . '); return false;">
                                         ' . cc($status_row->name) . '
                                      </a>
                                   </li>';
                                    }
                                }
                                $outputType .= '</ul>';
                                $outputType .= '</div>';
                                $outputType .= '</span>';
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid.'/under_over_limit')?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><?php echo $outputType; ?></td>
                        <td><a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->userid); ?>">Activity</a></td>
                        <td><a class="text-right" target="_blank" href="<?php echo base_url("admin/follow_up/payment_contact/".$row->userid)?>" class="pull-right text-muted" ><i class="fa fa-user fa-2x" aria-hidden="true"></i></a></td>
                        <td><?php 
                        if(!empty($row->staff_group)){ 
                            $group_arr = explode(',', $row->staff_group);
                            $group_nams = '';
                            foreach ($group_arr as $k => $group_id) {
                                if($k == 0){
                                    $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                }else{
                                    $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                }                                
                            }
                            //echo '<button type="button" class="btn-info btn-sm show_group" value="'.$row->userid.'" data-toggle="modal" data-target="#myModal">'.$group_nams.'</button>';
                            echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$row->userid).'" class="btn-sm btn-info pull-left display-block">'.$group_nams.'</a>';
                        }else{
                          echo '<a target="_blank" href="'.admin_url('follow_up/allot_group/'.$row->userid).'" class="btn-sm btn-info pull-left display-block">Allot Group</a>';
                        } 
                        ?></td>
                        <td><?php echo $bal_amt; ?></td>   
                        <td><a class="btn-sm btn-info text-center other_collection" href="#othercollection_modal" data-toggle="modal" data-id="<?php echo $row->userid; ?>"><i class="fa fa-exchange" aria-hidden="true"></i></a></td>                     
                      </tr> 
        
                       <?php 
                       	 }
                        }
                    }                      
                }                

                ?>

                </tbody>

                <tfoot>
                    <tr>
                        <td align="center" colspan="7">Total</td>
                        <td align=""><b><?php echo number_format($ttl_sales_amt, 2, '.', ''); ?></b></td>
                        <input type="hidden" id="get_count2" value="<?php echo number_format($ttl_sales_amt, 2, '.', ''); ?>">
                    </tr>
                </tfoot>

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

<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Group Assigned Person</h4>
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

<div id="othercollection_modal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Client Other Collection Details</h4>
      </div>
      <div class="modal-body collection_body">
        <div class="row">
            <form action="<?php echo admin_url('report/update_other_collection'); ?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="col-md-6">
                <label class="control-label">Client Other Collection</label>
                <select class="form-control selectpicker" id="clientothercollection_id" name="clientothercollection_id" data-live-search="true">
                    <option value=""></option>
                    <?php
                    if (isset($clientothercollection_data) && count($clientothercollection_data) > 0) {
                        foreach ($clientothercollection_data as $client_key => $client_value) {
                            ?>
                            <option value="<?php echo $client_value['id'] ?>"><?php echo cc($client_value['name']); ?>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>

            <input type="hidden" id="collection_id" value="" name="collection_id">

            <div style="float: right;" class="col-md-6">
                <button style="margin-top: 27px;" type="submit" class="btn btn-info">Submit</button>
            </div>
            </form>
        </div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>

<?php init_tail(); ?>

</body>

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

<script>
$(document).ready(function() {

    $('#payfill_table1').DataTable( {

      

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

<script>
$(document).ready(function() {

    $('#payfill_table2').DataTable( {

      

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
  $(document).on("click", ".other_collection", function () {
     var Id = $(this).data('id');
     $(".collection_body #collection_id").val( Id );
    $('#othercollection_modal').modal('show');
});
</script>

<script type="text/javascript">
  $('.show_group').click(function(){
  var client_id = $(this).val();
  
    $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/report/get_group_persons'); ?>",
      data    : {'client_id' : client_id},
      success : function(response){
        if(response != ''){
          $("#approval_html").html(response);
        }
      }
    })
  });
</script>
<script type="text/javascript">
    var a = document.getElementById("get_count").value;
    $('#amt').html('Total Amount :  '+a);
    var table = document.getElementById("payfill_table");
    var tbodyRowCount = table.tBodies[0].rows.length; 
    $('#cnt').html('Total Count :  '+tbodyRowCount);

    var a1 = document.getElementById("get_count1").value;
    $('#amt1').html('Total Amount :  '+a1);
    var table1 = document.getElementById("payfill_table1");
    var tbodyRowCount1 = table1.tBodies[0].rows.length; 
    $('#cnt1').html('Total Count :  '+tbodyRowCount1);

    var a2 = document.getElementById("get_count2").value; 
    $('#amt2').html('Total Amount :  '+a2);
    var table2 = document.getElementById("payfill_table2");
    var tbodyRowCount2 = table2.tBodies[0].rows.length; 
    $('#cnt2').html('Total Count :  '+tbodyRowCount2);
</script>

<script type="text/javascript">
    function change_client_status(status, id, last_status) { 
    var data = {}; 
    data.status = status; 
    data.id = id; 
    data.last_status = last_status;
    $.post('<?php echo base_url(); ?>admin/report/change_running_client_status', data).done(function(response) {
        location.reload(true);
    });
}
</script>
<script type="text/javascript">
    function change_client_status1(status, id, last_status) { 
    var data = {}; 
    data.status = status; 
    data.id = id; 
    data.last_status = last_status;
    $.post('<?php echo base_url(); ?>admin/report/change_closed_client_status', data).done(function(response) {
        location.reload(true);
    });
}
</script>
<script type="text/javascript">
    function change_client_status2(status, id, last_status) { 
    var data = {}; 
    data.status = status; 
    data.id = id; 
    data.last_status = last_status;
    $.post('<?php echo base_url(); ?>admin/report/change_sales_client_status', data).done(function(response) {
        location.reload(true);
    });
}
</script>

</html>

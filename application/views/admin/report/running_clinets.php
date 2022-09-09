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
            <li role="presentation" class="<?php if(!empty($from_page) && $from_page == 1){ echo 'active'; }elseif(empty($from_page)){ echo 'active'; } ?>"><a  href="#running_outstanding" aria-controls="running_outstanding" role="tab" data-toggle="tab">All Running Clients</a></li>
            <li role="presentation" class="<?php echo (!empty($from_page) && $from_page == 2) ? 'active' : ''; ?>"><a href="#closed_outstanding" aria-controls="closed_outstanding" role="tab" data-toggle="tab">Running CLients With No Outstanding</a></li>
            
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
                        </tr>
                    </thead>
                     
                    <tbody class="ui-sortable">

                <?php

                $i=1;
                $ttl_running_amt = 0;
                if(!empty($running_clinets)){              
                      foreach ($running_clinets as $row) { 
                         
                          $bal_amt = client_balance_amt($row->userid,1);

                              $ttl_running_amt += $bal_amt;
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid.'/under_over_limit')?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><?php echo value_by_id('tblclientstatus',$row->client_status,'name'); ?></td>
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
                      </tr> 
        
                       <?php
                    }                      
                }                

                ?>
                </tbody> 
                      <tfoot>
                          <tr>
                              <td align="center" colspan="6">Total</td>
                              <td align=""><b><?php echo number_format($ttl_running_amt, 2, '.', ''); ?></b></td>
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
                      ?>
                      <option value="<?php echo $value->id; ?>"<?php echo $selected; ?>><?php echo $value->name; ?></option>
                      <?php
                    }
                  ?>
                  
                </select>
              </div>

              <div class="form-group col-md-2 float-right">
                <button class="form-control btn-info" type="submit" style="margin-top: 26px;">Search</button>
              </div>

              </div>

              </form>

            <div class="table-responsive" style="margin-bottom:30px;">
                <table class="table newtable" id="">
                      <thead>
                          <tr>
                            <th>S.No</th>
                            <th>Client Name</th>                                       
                            <th>Client Status</th>                                       
                            <th>Activity</th>                                        
                            <th>Contacts</th>
                            <th>Assigned Details</th>
                            <th>Outstanding</th> 
                        </tr>
                      </thead>
                       
                <tbody class="ui-sortable">

             <?php

                $i=1;
                $ttl_closed_amt = 0;
                if(!empty($running_clinets_2)){              
                      foreach ($running_clinets_2 as $row) { 
                         
                          $bal_amt = client_balance_amt($row->userid,1);


                          	if($bal_amt < 10){

                              $ttl_closed_amt += $bal_amt;
                      ?>
                      <tr>
                        <td><?php echo $i++; ?></td>
                        <td><a target="_blank" href="<?php echo base_url("admin/invoices/ledger/".$row->userid.'/under_over_limit')?>" ><?php echo cc($row->client_branch_name); ?></a></td>
                        <td><?php echo value_by_id('tblclientstatus',$row->client_status,'name'); ?></td>
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

                      </tr> 
        
                       <?php 
                        	}
                    }                      
                }                

                ?>

                </tbody>

                <tfoot>
                    <tr>
                        <td align="center" colspan="6">Total</td>
                        <td align=""><b><?php echo number_format($ttl_closed_amt, 2, '.', ''); ?></b></td>
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

    $('.newtable').DataTable( {

      

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

</html>

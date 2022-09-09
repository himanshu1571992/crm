<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
            <div class="col-md-12">
                <div class="panel_s">
                  <div class="panel-body">

                    <h4><?php echo $title; ?></h4>
                    <div class="clearfix"></div>
                    <hr class="hr-panel-heading" />
                    <div class="clearfix mtop20"></div>
                    <div class="row">
                    <div class="col-md-12 table-responsive">                                                                
                    <table class="table" id="newtable">
                    <thead>
                    <tr>
                      <th width="7%">S.No</th>
                      <th width="25%">Client Name</th>                                        
                      <th width="16%">Client Status</th>                                        
                      <th width="10%">Activity</th>                                        
                      <th width="7%">Contacts</th>
                      <th width="25%">Assigned Details</th>                      
                      <th width="10%">Other Collection</th>
                      <th width="10%">Outstanding</th>

                    </tr>
                      </thead>
                      <tbody>
                        <?php
                        $i=1;
                        $ttl_amt = 0;
                        if(!empty($client_list)){
                            foreach ($client_list as $row) { 
                                $bal_amt = client_balance_amt($row->userid);

                                $other_collection_name = value_by_id('tblclientothercollectionmaster',$row->other_collection,'name');

                                if($bal_amt > 1){
                                    $ttl_amt += $bal_amt;

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
                              <td><a class="btn-xs btn-info pull-left display-block other_collection" href="#othercollection_modal" data-toggle="modal" data-id="<?php echo $row->userid; ?>"><?php echo $other_collection_name; ?></a></td>  
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
                              <td align="center" colspan="7">Total</td>
                              <td align=""><b><?php echo number_format($ttl_amt, 2, '.', ''); ?></b></td>
                          </tr>
                      </tfoot> 
                    </table>
                    </div>
                    </div>
                    
                     <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'unit-form', 'class' => 'salary-form')); ?>
                    <div class="btn-bottom-toolbar text-right">
                           
                    </div>
                    </div>
                       
                    </div>
                </div>
             
            </form>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
</div>


<!-- Modal -->
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Approval Status</h4>
      </div>
      <div class="modal-body">
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
        <div id="approval_html"></div>
      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>


<?php init_tail(); ?>
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
        lengthMenu: [
            [ 10, 25, 50, -1 ],
            [ '10 rows', '25 rows', '50 rows', 'Show all' ]
        ],
        buttons: [  
            'pageLength',        
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5 ]
                }
            },
            'colvis',
        ]
    } );
} );
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
  $(document).on("click", ".other_collection", function () {
     var Id = $(this).data('id');
     $.ajax({
      type    : "POST",
      url     : "<?php echo base_url('admin/report/get_collection_modal'); ?>",
      data    : {'Id' : Id},
      success : function(response){
        if(response != ''){
          $("#approval_html").html(response);
        }
      }
    })
    
});
</script>

</body>
</html>

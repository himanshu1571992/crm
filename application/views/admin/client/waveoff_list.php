
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
    .btn-hold {
        background-color:#e8bb0b;
        color: #fff;
    }
</style>

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

                    <div class="row panelHead">
                        <div class="col-xs-12 col-md-6">
                            <h4><?php echo $title; if(check_permission_page(307,'create')){ ?> </h4>
                        </div>
                        <div class="col-xs-12 col-md-6 text-right">
                            <a href="<?php echo admin_url('client/add_waveoff'); ?>" type="submit" class="btn btn-info">Add Waive off</a> <?php } ?>
                        </div>
                    </div>


                    <div class="row">
                                                
                            <div class="col-md-12">     
                            <hr> 
                            <div class="table-responsive">                                                         
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No.</th>
                                        <th>Client Name</th>
                                        <th>Waive off By</th>
                                        <th>Waive off Amount</th>
                                        <th>Service Type</th>
                                        <th>Status</th>                               
                                        <th>Date</th>
                                        <th>Action</th>
                                        
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    if(!empty($waveoff_info)){
                                        $z=1;
                                        foreach($waveoff_info as $row){ 
                                               
                                               $client_info = client_info($row->client_id);

                                               if($row->status == 0){
                                                    $status = 'Pending';
                                                    $cls = 'btn-warning';
                                                }elseif($row->status == 1){
                                                    $status = 'Approved';
                                                    $cls = 'btn-success';
                                                }elseif($row->status == 5){
                                                    $status = 'On Hold';
                                                    $cls = 'btn-hold';
                                                }
                                            ?>                                                                                      
                                            <tr>
                                                <!-- <td><?php echo $z++;?></td> -->
                                                <td><?php echo $row->id;?></td>
                                                <td><a target="_blank" href="<?php echo admin_url('clients/client/'.$row->client_id); ?>"><?php echo (!empty($client_info)) ? cc($client_info->client_branch_name) : '--';  ?> </a></td>
                                                <td><?php echo get_employee_name($row->staff_id);?></td>
                                                <td><?php echo $row->amount;?></td>
                                                <td><?php echo ($row->service_type == 1) ? 'Rent' : 'Sales';?></td>
                                                <td><?php echo '<button type="button" class="'.$cls.' btn-sm status" value="'.$row->id.'" data-toggle="modal" data-target="#statusModal">'.$status.'</button>'; ?></td>
                                                <td><?php echo _d($row->created_date);?></td>
                                                <td>
                                                    <a target="_blank" href="<?php echo admin_url('follow_up/client_activity/'.$row->client_id); ?>">Activity</a>
                                                    <?php
                                                    if((check_permission_page(307,'delete'))){
                                                    ?>  
                                                    <a class="btn btn-danger _delete" href="<?php echo admin_url('client/delete_waveoff/'.$row->id);?>" data-status="1"><i class="fa fa-trash-o" aria-hidden="true"></i></a>
                                                    <?php
                                                    }
                                                    ?>
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
<div id="statusModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Waveoff Approval Status</h4>
      </div>
      <div class="modal-body" id="approval_html">
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
    $('.status').click(function(){
    var id = $(this).val(); 
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/client/waveoff_status'); ?>",
            data    : {'id' : id},
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

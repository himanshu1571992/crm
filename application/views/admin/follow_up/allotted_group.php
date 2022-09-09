<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <form method="post" id="salary_form" enctype="multipart/form-data" action="">
            <div class="col-md-12">
                <div class="panel_s">
                  <div class="panel-body">

                    <div class="_buttons">
                      <?php
                      if(check_permission_page(81,'create')){
                      ?>
                          <a href="<?php echo admin_url('follow_up/allot_group'); ?>" class="btn btn-info pull-left display-block">Allot Group</a>
                      <?php    
                      }
                      ?>
                      
                      <a href="<?php echo admin_url('follow_up/not_allotted'); ?>" class="btn btn-info pull-right display-block">Not Allotted Clients</a>
                      <div class="visible-xs">
                          <div class="clearfix"></div>
                      </div>
                    </div>
                    <div class="clearfix"></div>
                    <div class="clearfix mtop20"></div>
                    <div class="row">
                    <div class="col-md-12 table-responsive">                                                                
                    <table class="table" id="newtable">
                    <thead>
                    <tr>
                      <th>S.No.</th>
                      <th>Client</th>
                      <th>Client Location</th>
                      <th>Phone No.</th>
                      <th>Groups Name</th>

                    </tr>
                      </thead>
                      <tbody>
                        <?php
                        if(!empty($alloted_group_info)){
                            foreach ($alloted_group_info as $k => $row) {
                              
                                ?>
                                <tr>
                                    <td><?php echo ++$k; ?></td>
                                    <td><?php $url = admin_url('follow_up/allot_group/' . $row->userid);

                                    $user_name_html = '<a href="' . $url . '">' . cc($row->client_branch_name) . '</a>';

                                    $user_name_html .= '<div class="row-options">';
                                    $user_name_html .= '<a href="' . $url . '">' . _l('view') . '</a>';
                                    
                                    $user_name_html .= '</div>';  
                                    echo $user_name_html; ?></td>
                                    <td><?php echo cc($row->location);?></td>
                                    <td><?php echo $row->phone_no_1; ?></td>
                                    <td><?php echo get_groups_name($row->staff_group); ?></td>
                                </tr>    
                                <?php
                            }
                        }else{
                            echo '<tr><td class="text-center" colspan="6"><b>Records are empty!</b></td></tr>';
                        }
                        ?>
                      </tbody>
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
      <div class="modal-body" id="approval_html">
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
    $('.status').click(function(){
    var id = $(this).val();
        $.ajax({
            type    : "POST",
            url     : "<?php echo base_url('admin/approval/get_status'); ?>",
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

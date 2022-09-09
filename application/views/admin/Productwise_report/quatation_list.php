
<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12"> 
                                <div class="table-responsive">                                                    
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No</th>
                                                <th>Quotation #</th>
                                                <th>Customer Name</th>
                                                <th>Total Tax</th>
                                                <th>Total</th>
                                                <th>Date</th>                                        
                                                <th>Source</th>                                        
                                                <th>Created Date</th>
                                                <th>Status</th>
                                                <th>Followup</th>
                                                <th class="text-center">Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if (!empty($proposal_list)) {
                                                    foreach ($proposal_list as $key => $value) {
                                                        $source = get_multiple_source($value->source);
                                            ?>
                                                        <tr>
                                                            <td><?php echo ++$key; ?></td>                                                
                                                            <td><?php echo '<a target="_blank" href="' . admin_url('proposals/list_proposals/' . $value->id) . '" onclick="init_proposal(' . $value->id . '); ">' . format_proposal_number($value->id) . '</a>'; ?></td>
                                                            <td><?php echo cc($value->proposal_to); ?></td>
                                                            <td><?php echo $value->total_tax; ?></td>
                                                            <td><?php echo $value->total; ?></td>                                        
                                                            <td><?php echo _d($value->date); ?></td> 
                                                            <td><?php echo $source; ?></td> 
                                                            <td><?php echo _d($value->datecreated); ?></td> 
                                                            <td><?php echo format_proposal_status($value->status); ?></td>
                                                            <td><a target="_blank" href="<?php echo admin_url('follow_up/lead_activity/' . $value->rel_id); ?>">Activity</a></td>
                                                            <td class="text-center">
                                                                <a href="<?php echo admin_url('proposals/download_pdf/' . $value->id); ?>" target="_blank" class="actionBtn" title="PDF"><i class="fa fa-file-pdf-o" aria-hidden="true"></i></a>
                                                                <?php if (check_permission_page(5, 'edit')) { ?>
                                                                    <a href="<?php echo admin_url('proposals/proposal/' . $value->id); ?>" title="Edit" class="actionBtn"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></a>
                                                                <?php } ?>
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
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8 ]
                }
            },
            'colvis',
        ]
    } );
} );
</script>
</body>
</html>


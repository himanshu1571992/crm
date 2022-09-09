<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
		 <div class="row">            
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12 table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th><b>S.No</b></th>
                                            <th><b>Employee Name</b></th>
                                            <th><b>Employee Code</b></th>
                                            <th><b>Last Attendance On</b></th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            $i=0; 
                                            if ($leave_report){
                                                foreach ($leave_report as $value) {
                                                    $chklastday_present = $this->db->query("SELECT `marked_at`,`date` FROM `tblstaffattendance` WHERE `staff_id` = '".$value['staff_id']."' AND `status` = 1 ORDER BY date DESC LIMIT 1")->row();
                                                    $staff_info = get_employee_info($value['staff_id']);

                                                    if($staff_info->active == 1){
                                                        ?>
                                                        <tr>
                                                            <td><?php echo ++$i; ?></td>
                                                            <td><a href="<?php echo admin_url("staff/member/".$value['staff_id']); ?>" target="_blank"><?php echo $staff_info->firstname; ?></a></td>
                                                            <td><?php echo $staff_info->employee_id; ?></td>
                                                            <td><?php echo (!empty($chklastday_present->marked_at) && $chklastday_present->marked_at > 0) ? _d($chklastday_present->marked_at) : _d($chklastday_present->date); ?></td>
                                                        </tr>
                                                        <?php
                                                    }
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
        <div class="btn-bottom-pusher"></div>
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
        "iDisplayLength": 40,
        dom: 'Bfrtip',
        buttons: [
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
            'colvis'
        ]
    } );
} );
</script>

</body>
</html>

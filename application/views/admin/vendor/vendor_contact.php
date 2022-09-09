<?php init_head(); ?>
<?php
$s_range = '';
$date_a = '';
$date_b = '';

if(!empty($range)){
  $s_range = $range;
}
if(!empty($f_date)){
  $date_a = $f_date;
}
if(!empty($t_date)){
  $date_b = $t_date;
}

?>
<div id="wrapper" class="customer_profile">
    <div class="content">
        <div class="row">
            <div class="col-md-2">
                <div class="panel_s mbot5">
                    <div class="panel-body padding-10">
                        <h4 class="bold"><?php echo value_by_id("tblvendor", $vendor_id, "name"); ?></h4>
                    </div>
                </div>
                <?php echo vendor_report_tab('contacts', $vendor_id); ?>
            </div>
            <div class="col-md-10">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('vendor/add_vendor_contact/'.$vendor_info->id); ?>" type="submit" class="btn btn-info">Add Contact</a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="col-md-12">
                                <hr>
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No.</th>
                                            <th>Name</th>
                                            <th>Email</th>
                                            <th>Number</th>
                                            <th>Designation</th>
                                            <!-- <th>Type</th> -->
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                            if (!empty($vendor_contacts)){
                                                foreach ($vendor_contacts as $key => $value) {
                                        ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo cc($value->name); ?></td>
                                                        <td><?php echo $value->email; ?></td>
                                                        <td><?php echo $value->phonenumber; ?></td>
                                                        <td><?php echo value_by_id("tbldesignation", $value->designation_id, "designation"); ?></td>
                                                        <!-- <td><?php echo value_by_id("tblcontacttype", $value->contact_type, "contact_type"); ?></td> -->
                                                        <td><a href="<?php echo admin_url("vendor/vendor_deletecontact/".$value->id); ?>" class="btn-sm btn-danger _delete"><i class="fa fa-trash"></i></a></td>
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


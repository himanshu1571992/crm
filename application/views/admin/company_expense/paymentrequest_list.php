<?php init_head(); ?>
<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />
<style>
    .hold {
        color: #fff;
        background-color: #e8bb0b;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('payments'); ?>">
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <h4 class="no-margin"><?php echo $title; ?>
                            <?php if(check_permission_page(329,'create')){ ?>
                            <a href="<?php echo admin_url('company_expense/add_paymentrequest'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Payment Request</a>
                            <?php } ?>
                            </h4>
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12 table-responsive">																
                                    <table class="table" id="newtable">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Category</th>
                                                <th>Added By</th>
                                                <th>Party Name</th>
                                                <th>Amount</th>
                                                <th>TDS AMT</th>									
                                                <th>Status</th>
                                                <th>PayFile Status</th>
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                            if (!empty($payment_list)) {
                                                $z = 1;
                                                foreach ($payment_list as $row) {

                                                    if ($row->type == 2 && $row->category_id == 6) {
                                                        $party_name = $row->party_name;
                                                    } else {
                                                        $party_name = value_by_id('tblcompanyexpenseparties', $row->party_id, 'name');
                                                    }
                                                    if ($row->approved_status == 0) {
                                                        $status = 'Pending';
                                                        $cls = 'btn-warning btn-xs';
                                                    } elseif ($row->approved_status == 1) {
                                                        $status = 'Approved';
                                                        $cls = 'btn-success btn-xs';
                                                    } elseif ($row->approved_status == 2) {
                                                        $status = 'Rejected';
                                                        $cls = 'btn-danger btn-xs';
                                                    } elseif ($row->approved_status == 5) {
                                                        $status = 'On Hold';
                                                        $cls = ' btn-xs hold';
                                                    }
                                                    ?>
                                                    <tr>
                                                        <td><?php echo $z++; ?></td>
                                                        <td><?php echo value_by_id('tblcompanyexpensecatergory', $row->category_id, 'name'); ?></td>
                                                        <td><?php echo get_employee_name($row->user_id); ?></td>
                                                        <td><?php echo cc($party_name); ?></td>
                                                        <td><?php echo $row->amount; ?></td>
                                                        <td><?php echo $row->tds_amt; ?></td>
                                                        <td><?php echo '<button type="button" class="btn ' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">' . $status . '</button>'; ?></td>
                                                        <td><?php
                                                            if ($row->payfile_done == 1) {
                                                                echo "Done";
                                                            } else {
                                                                echo "Pending";
                                                            };
                                                            ?></td>
                                                        <td class="text-center"><div class="btn-group pull-right">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <!-- <a class="" title="View" href="">Edit</a> -->
                                                                        <?php
                                                                        if(check_permission_page(329,'delete')){
                                                                        if ($row->approved_status != 1) {
                                                                            ?>
                                                                            <a class="_delete" title="Delete" href="<?php echo admin_url('company_expense/delete_paymentrequest/' . $row->id); ?>" data-status="1">Delete</a>	
                                                                        <?php } }
                                                                        if(check_permission_page(329,'edit')){
                                                                        if ($row->approved_status != 1) {
                                                                            ?>
                                                                            <a href="<?php echo admin_url('company_expense/add_paymentrequest/'. $row->id); ?>">Edit</a> 
                                                                        <?php } } 
                                                                         ?>
                                                                        <a target="_blank" class="" title="View" href="<?php echo admin_url('company_expense/paymentrequest_view/' . $row->id); ?>">View</a> 
                                                                    </li>
                                                                </ul>
                                                            </div></td>
                                                    </tr>
                                                    <?php
                                                }
                                            }
                                            ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
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
                <h4 class="modal-title">Payment Request Status</h4>
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


<link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">


<script>



$(document).ready(function() {

    $('#newtable').DataTable( {

        "iDisplayLength": 15,

        dom: 'Bfrtip',

        buttons: [           

            {

                extend: 'excel',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]

                }

            },

            {

                extend: 'pdf',

                exportOptions: {

                     columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]

                }

            },

            {

                extend: 'print',

                exportOptions: {

                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8]

                }

            },

            'colvis'

        ]

    } );

} );

</script>



<script type="text/javascript">
	$('.status').click(function(){
	var id = $(this).val();  
		$.ajax({
			type    : "POST",
			url     : "<?php echo base_url('admin/company_expense/get_status'); ?>",
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


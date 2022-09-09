<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"> <?php echo $title; ?><a href="<?php echo admin_url('company_expense/transport_overhead_add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">add Transport Overhead</a></h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="">
                                <div class="col-md-12">
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="f_date" class="control-label">From Date</label>
                                            <div class="input-group date">
                                                <input id="f_date" name="f_date" required='' class="form-control datepicker" value="<?php if (!empty($f_date)) {echo $f_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-3">
                                        <div class="form-group" app-field-wrapper="date">
                                            <label for="t_date" class="control-label">To Date</label>
                                            <div class="input-group date">
                                                <input id="t_date" name="t_date" required='' class="form-control datepicker" value="<?php if (!empty($t_date)) {echo $t_date;} ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-md-2">
                                        <div class="input-group" style="margin-top: 26px;">
                                            <button type="submit" class="btn btn-info">Search</button>
                                            <a class="btn btn-danger" href="">Reset</a>
                                        </div>
                                    </div> 
                                </div>
                                <div class="col-md-12 table-responsive"> 
                                    <hr>                                                            
                                    <table class="table ui-table" id="request_table">
                                        <thead>
                                            <tr>
                                                <th width="5%">S.No</th>
                                                <th>Head</th>
                                                <th>Date</th>
                                                <th>Remark</th>                                        
                                                <th>Amount</th>                                        
                                                <th>Added By</th>                                        
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($overhead_list)){
                                                    $i=1;
                                                    foreach($overhead_list as $row){  
                                            ?>
                                                        <tr>
                                                            <td><?php echo $i++;?></td>
                                                            <td><?php echo cc($row->head); ?></td>
                                                            <td><?php echo _d($row->date);?></td>
                                                            <td><?php echo (!empty($row->remark)) ? cc($row->remark) : 'n/a'; ?></td>
                                                            <td><?php echo number_format($row->amount, 2,'.',','); ?></td>
                                                            <td><span class="badge badge-secondary"><?php echo get_employee_name($row->added_by); ?></span></td>
                                                            <td>
                                                                <a href="<?php echo admin_url('company_expense/transport_overhead_add/'.$row->id); ?>" class="btn-sm btn-info">Edit</a>
                                                                <a href="<?php echo admin_url('company_expense/transport_overhead_delete/'.$row->id); ?>" class="btn-sm btn-danger _delete">Delete</a>
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

<div id="assignModel" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Assigned Person</h4>
            </div>
            <div class="modal-body">
                <div id="assign_data"></div>
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

<script type="text/javascript">
    
$(document).ready(function() {
    $('#request_table').DataTable( {
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

    $(".assign-status").on("click",  function(){
        var id = $(this).data("id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/requests_new/get_approval_info'); ?>",
            data    : {'id' : id},
            success : function(response){
                if(response != ''){
                    $("#assignModel").modal("show");
                    $('#assign_data').html(response);
                }
            }
        })
    });
} );

    
</script>


</body>
</html>

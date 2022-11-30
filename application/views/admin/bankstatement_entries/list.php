<?php init_head(); ?>

<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row panelHead">
                            <div class="col-xs-12 col-md-6">
                                <h4><?php echo $title; ?></h4>
                            </div>
                            <div class="col-xs-12 col-md-6 text-right">
                                <a href="<?php echo admin_url('company_expense/add_bankstatement_entries'); ?>" class="btn btn-info pull-right" style="margin-top:-6px;">add Bank Statement Entries</a>
                            </div>
                        </div>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <div class="">
                                <div class="col-md-12">
                                    <div class="col-md-4">
                                        <div class="form-group" id="category_id">
                                            <label for="bank_id" class="control-label">Bank</label>
                                            <select class="form-control selectpicker" data-live-search="true" required="" id="bank_id" name="bank_id">
                                                <option value="" selected=" disabled ">--Select One--</option>
                                                <?php
                                                if (!empty($bank_list)) {
                                                    foreach ($bank_list as $key => $value) {
                                                        $selected = (!empty($sbank_id) && $sbank_id == $value->id) ? 'selected' : "";
                                                        ?>                                               
                                                        <option value="<?php echo $value->id; ?>" <?php echo $selected; ?>  ><?php echo cc($value->name); ?></option>
                                                        <?php
                                                    }
                                                }
                                                ?>
                                            </select>
                                        </div>
                                    </div>
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
                                                <th>Bank</th>
                                                <th>Date</th>
                                                <th>Type</th>                                        
                                                <th>UTR No</th>                                        
                                                <th>Amount</th>                                        
                                                <th>Description</th>                                        
                                                <th>Action</th>
                                            </tr>
                                        </thead>
                                        <tbody>
                                            <?php
                                                if(!empty($bankenteries_list)){
                                                    $i=1;
                                                    foreach($bankenteries_list as $row){  
                                                        $btype = '<span class="label label-success">Credit</span>';
                                                        if ($row->type == 1){
                                                            $btype = '<span class="label label-danger">Debit</span>';
                                                        }
                                            ?>
                                                        <tr>
                                                            <td>
                                                                <?php echo $i++;?>
                                                            </td>
                                                            <td>
                                                                <?php echo get_creator_info($row->added_by, $row->created_at); ?>
                                                                <?php echo value_by_id('tblbankmaster',$row->bank_id, 'name'); ?>
                                                            </td>
                                                            <td><?php echo _d($row->date);?></td>
                                                            <td><?php echo $btype; ?></td>
                                                            <td><?php echo $row->utr_no; ?></td>
                                                            <td><?php echo number_format($row->amount, 2,'.',','); ?></td>
                                                            <td><?php echo (!empty($row->description)) ? cc($row->description) : 'n/a'; ?></td>
                                                            <td>
                                                                <a href="<?php echo admin_url('company_expense/add_bankstatement_entries/'.$row->id); ?>" class="btn btn-info"><i class="fa fa-edit"></i></a>
                                                                <a href="<?php echo admin_url('company_expense/delete_bankstatement_entries/'.$row->id); ?>" class="btn btn-danger _delete"><i class="fa fa-trash"></i></a>
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

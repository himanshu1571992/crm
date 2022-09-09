<?php init_head(); ?>
<style>
    .active {
        background-color: #2196f3;
    }
    .nav-tabs > li.active > a,.nav-tabs > li.active > a:focus {
        color: #ffffff;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?></h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <div class="row">
                                <div class="col-md-12">
                                    <?php echo form_open($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="warehouse_id" class="control-label">Warehouse</label>
                                                <select class="form-control selectpicker" required='' data-live-search="true" id="warehouse_id" name="warehouse_id">
                                                    <option value=""></option>
                                                    <?php
                                                    if (isset($all_warehouse) && count($all_warehouse) > 0) {
                                                        foreach ($all_warehouse as $all_warehouse_value) {
                                                            $selected = ($warehouse_id == $all_warehouse_value->id) ? "selected": "";
                                                            ?>
                                                            <option value="<?php echo $all_warehouse_value->id; ?>" <?php echo $selected; ?>><?php echo $all_warehouse_value->name; ?></option>
                                                            <?php
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="inspection_status" class="control-label">Inspection Status</label>
                                                <select class="form-control selectpicker" data-live-search="true" id="inspection_status" name="status">
                                                    <option value=""></option>
                                                    <option value="0" <?php echo (isset($status) && strlen($status) > 0 && $status == '0') ? 'selected': ''; ?>>Pending</option>
                                                    <option value="1" <?php echo (!empty($status) && $status == '1') ? 'selected': ''; ?>>Done</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-3">  
                                            <div class="form-group">
                                                <label for="approve_status" class="control-label">Approve Status</label>
                                                <select class="form-control selectpicker" data-live-search="true" id="approve_status" name="approve_status">
                                                    <option value=""></option>
                                                    <option value="0" <?php echo (isset($approve_status) && strlen($approve_status) > 0 && $approve_status == '0') ? 'selected': ''; ?>>Pending</option>
                                                    <option value="1" <?php echo (!empty($approve_status) && $approve_status == '1') ? 'selected': ''; ?>>Approved</option>
                                                    <option value="2" <?php echo (!empty($approve_status) && $approve_status == '2') ? 'selected': ''; ?>>Rejected</option>
                                                    <option value="4" <?php echo (!empty($approve_status) && $approve_status == '4') ? 'selected': ''; ?>>Reconciliation</option>
                                                    <option value="5" <?php echo (!empty($approve_status) && $approve_status == '5') ? 'selected': ''; ?>>On Hold</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group" style="margin-top: 26px;">
                                                <button type="submit" class="btn btn-info">Search</button>
                                                <a class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                </div>    
                                <div class="col-md-12">    
                                    <hr>     
                                    <br>
                                    <ul class="nav nav-tabs" role="tablist">
                                        <li role="presentation" class="col-md-6 text-center active">
                                            <a href="#inwarding" class="tablist" aria-controls="inwarding" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="true">INWARDING INSPECTION REQUESTS</a>
                                        </li>
                                        <li role="presentation" class="col-md-6 text-center ">
                                            <a href="#outwarding" class="tablist" aria-controls="outwarding" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="false">FINAL INSPECTION REQUESTS</a>
                                        </li>
                                    </ul>
                                    <div class="tab-content">
                                        <div role="tabpanel" class="tab-pane active" id="inwarding">
                                            <div class="col-md-12"> 
                                                <hr>
                                                <div class="table-responsive">  
                                                    <table class="table" id="inwardingtable">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%">S.No</th>
                                                                <th width="8%">REQ Id</th>
                                                                <th width="10%">REQ Date</th>
                                                                <th width="12%">Requested By</th>
                                                                <th width="12%">Document Ref <br>(MR No.)</th>
                                                                <th width="12%">Party Name</th>
                                                                <th>Inspection Status</th>
                                                                <th>Approve Status</th>
                                                                <th>Inspection Reports</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $i = 0;
                                                            if(!empty($inwardinglist)){
                                                                foreach ($inwardinglist as $key => $row) { 
                                                                    
                                                                    $vendor_id = value_by_id("tblmaterialreceipt", $row->rel_id, "vendor_id");
                                                                    $vendor_name = value_by_id("tblvendor", $vendor_id, "name");

                                                                    $number = value_by_id("tblmaterialreceipt", $row->rel_id, "numer");
                                                                    $mr_number = "<a href='".admin_url('purchase/mr_details/'.$row->rel_id)."' target='_blank'>".$number."</a>";

                                                                    $inspection_status = get_approve_status($row->status);
                                                                    if ($row->status == '1'){
                                                                        $inspection_status = "<span class='btn-sm btn-success'>DONE</span>";
                                                                    }
                                                                    $approve_status = get_approve_status($row->approve_status);
                                                                    
                                                        ?>  
                                                                    <tr>
                                                                        <td><?php echo ++$i; ?></td>
                                                                        <td><?php echo "INSP-".str_pad($row->id, 4, '0', STR_PAD_LEFT); ?></td>                                                
                                                                        <td><?php echo _d($row->created_at); ?></td>
                                                                        <td><?php echo get_employee_fullname($row->added_by); ?></td>
                                                                        <td><?php echo $mr_number; ?></td>
                                                                        <td><?php echo cc($vendor_name); ?></td>
                                                                        <td><?php echo $inspection_status; ?></td>
                                                                        <td><a href="javascript:void(0);" class="assign-status" data-id="<?php echo $row->id; ?>" ><?php echo $approve_status; ?></a></td>
                                                                        <td>
                                                                            <div class="btn-group pull-right">
                                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                                    <li>
                                                                                        <a href="<?php echo admin_url('QualityCheck/qualityinspection/'.$row->id);?>" target="_blank"><?php echo ($row->status == 0) ? 'Quality Check':'EDIT';?></a>    
                                                                                    </li>
                                                                                    <?php if ($row->inspection_by > 0){ ?>
                                                                                        <li>
                                                                                            <a href="<?php echo admin_url('QualityCheck/download_pdf/'.$row->id);?>" target="_blank">PDF</a>
                                                                                        </li>
                                                                                    <?php } 
                                                                                        if ($row->approve_status != 1){ ?>
                                                                                        <li>
                                                                                            <a href="<?php echo admin_url('QualityCheck/delete_inspection/'.$row->id);?>" style="color:red;" class="_delete">DELETE</a>
                                                                                        </li>
                                                                                    <?php } ?>
                                                                                    
                                                                                </ul>
                                                                            </div>        
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
                                        <div role="tabpanel" class="tab-pane" id="outwarding">
                                            <div class="col-md-12"> 
                                                <hr>
                                                <div class="table-responsive">  
                                                    <table class="table" id="outwardingtable">
                                                        <thead>
                                                            <tr>
                                                                <th width="1%">S.No</th>
                                                                <th width="10%">REQ Id</th>
                                                                <th width="15%">REQ Date</th>
                                                                <th width="15%">Requested By</th>
                                                                <th width="12%">Document Ref</th>
                                                                <th>Inspection Status</th>
                                                                <th>Approve Status</th>
                                                                <th>Inspection Reports</th>
                                                            </tr>
                                                        </thead>
                                                        <tbody>
                                                        <?php
                                                            $i = 0;
                                                            if(!empty($outwardinglist)){
                                                                foreach ($outwardinglist as $key => $row) { 
                                                                    
                                                                    $rel_type = str_replace("_", " ", $row->rel_type);

                                                                    $inspection_status = get_approve_status($row->status);
                                                                    if ($row->status == '1'){
                                                                        $inspection_status = "<span class='btn-sm btn-success'>DONE</span>";
                                                                    }
                                                                    $approve_status = get_approve_status($row->approve_status);
                                                        ?>
                                                                    <tr>
                                                                        <td><?php echo ++$i; ?></td>
                                                                        <td><?php echo "INSP-".str_pad($row->id, 4, '0', STR_PAD_LEFT); ?></td>                                                
                                                                        <td><?php echo _d($row->created_at); ?></td>
                                                                        <td><?php echo get_employee_fullname($row->added_by); ?></td>
                                                                        <td><?php echo cc($rel_type); ?></td>
                                                                        <td><?php echo $inspection_status; ?></td>
                                                                        <td><a href="javascript:void(0);" class="assign-status" data-id="<?php echo $row->id; ?>" ><?php echo $approve_status; ?></a></td>
                                                                        <td>
                                                                            <div class="btn-group pull-right">
                                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                                </button>
                                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                                    <li>
                                                                                        <a href="<?php echo admin_url('QualityCheck/qualityinspection/'.$row->id);?>" target="_blank"><?php echo ($row->status == 0) ? 'Quality Check':'EDIT';?></a>    
                                                                                    </li>
                                                                                    <?php if ($row->inspection_by > 0){ ?>
                                                                                        <li>
                                                                                            <a href="<?php echo admin_url('QualityCheck/download_pdf/'.$row->id);?>" target="_blank">PDF</a>
                                                                                        </li>
                                                                                    <?php } 
                                                                                        if ($row->approve_status != 1){ ?>
                                                                                        <li>
                                                                                            <a href="<?php echo admin_url('QualityCheck/delete_inspection/'.$row->id);?>" style="color:red;" class="text-danger _delete">DELETE</a>
                                                                                        </li>
                                                                                    <?php } ?>
                                                                                </ul>
                                                                            </div>        
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
                            </div>
                        </div>
                        <br>
                    </div>
                </div>
            </div>
        </div>      
        <div class="btn-bottom-pusher"></div>
    </div>
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


<script>

$(document).ready(function() {

    $('#inwardingtable').DataTable( {
        
        "iDisplayLength": 30,
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
                    columns: [ 0, 2, 3, 4, 5, 6],
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6],
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6],
                }
            },
            'colvis',
        ]
    } );
    $('#outwardingtable').DataTable( {
        
        "iDisplayLength": 30,
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
                    columns: [ 0, 2, 3, 4, 5, 6],
                }
            },
            {
                extend: 'pdf',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6],
                }
            },
            {
                extend: 'print',
                exportOptions: {
                    columns: [ 0, 2, 3, 4, 5, 6],
                }
            },
            'colvis',
        ]
    } );

    $(".assign-status").on("click",  function(){
        var id = $(this).data("id");
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/QualityCheck/get_approval_info'); ?>",
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


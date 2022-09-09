
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
                            <div>
                                <div class="form-group col-md-3">
                                    <label for="vendor_id" class="control-label">Vendor</label>
                                    <select class="form-control selectpicker vendor_id" data-live-search="true" id="vendor_id" name="vendor_id">
                                        <option value=""></option>
                                        <?php
                                        if (isset($vendors_info) && count($vendors_info) > 0) {
                                            foreach ($vendors_info as $vendor_value) {
                                                ?>
                                                <option value="<?php echo $vendor_value->id; ?>" <?php if (!empty($vendor_id) && $vendor_id == $vendor_value->id) {
                                            echo 'selected';
                                        } ?>><?php echo cc($vendor_value->name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php
                                        if (!empty($f_date)) {
                                            echo $f_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php
                                        if (!empty($t_date)) {
                                            echo $t_date;
                                        }
                                        ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                                <div class="form-group col-md-2">
                                    <label for="vendor_id" class="control-label">Status</label>
                                    <select class="form-control selectpicker" data-live-search="true" id="approve_status" name="approve_status">
                                        <option value=""></option>
                                        <option value="0" <?php echo (isset($approve_status) && $approve_status == 0) ? 'selected' : ""; ?>>Pending</option>
                                        <option value="1" <?php echo (isset($approve_status) && $approve_status == 1) ? 'selected' : ""; ?>>Approved</option>
                                        <option value="2" <?php echo (isset($approve_status) && $approve_status == 2) ? 'selected' : ""; ?>>Reject</option>
                                    </select>
                                </div>
                                <div class="col-md-2">                            
                                    <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                     <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>

                            <div class="col-md-12">
                                <hr>
                            </div>

                            <div class="col-md-12">                                                             
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Number</th>
                                            <th>Vendor Name</th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if (!empty($delivarychallan_list)) {
                                            foreach ($delivarychallan_list as $key => $value) {

                                    ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td> 
                                                    <td><?php echo 'DCR-' . str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                    <td><a href="<?php echo admin_url('vendor/vendor/' . $value->vendor_id); ?>" target="_blank"><?php echo cc(value_by_id('tblvendor', $value->vendor_id, 'name')); ?></a></td>
                                                    <td><?php echo _d($value->date); ?></td> 
                                                    <td>
                                                        <?php
                                                            $status = "--";
                                                            if($value->status == 0){
                                                                $status = '<span class="btn btn-warning status">Pending</span>';
                                                            }elseif ($value->status == 1){
                                                                $status = '<span class="btn btn-success status">Approved</span>';    
                                                            }elseif ($value->status == 2){
                                                                $status = '<span class="btn btn-danger status">Rejected</span>';    
                                                            }elseif ($value->status == 3){
                                                                $status = '<span class="btn btn-danger status">Cancel</span>';    
                                                            }
                                                        ?>
                                                        <a href="javascript:void(0)" class="status" onclick="get_assign_status(<?php echo $value->id; ?>);" data-target="#stock_status" id="status" data-toggle="modal"><?php echo $status; ?></a>
                                                    </td>
                                                    <td class="text-center">
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <a href="<?php echo admin_url('Jobdeliverychallan/download_returnpdf/' . $value->id); ?>" title="pdf" >PDF</a>
                                                                    </li>
                                                                <?php if ($value->status != 1 && $value->status != 3){ ?>
                                                                    <li>
                                                                        <a href="<?php echo admin_url('Jobdeliverychallan/challanreturn/' . $value->id. '/edit'); ?>" title="Edit" >Edit</a>
                                                                    </li>
                                                                    <li>
                                                                        <a class="_delete" href="<?php echo admin_url('Jobdeliverychallan/challanReturnDelete/' . $value->id); ?>" title="Delete" >Delete</a>
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

<?php echo form_close(); ?>
            </div>      
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
</div>
<div id="stock_status" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Assigned Person</h4>
      </div>
      <div class="modal-body stock_status_details">
        
       
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

    $(document).ready(function () {
        $('#newtable').DataTable({
            "iDisplayLength": 15,
            dom: 'Bfrtip',
            buttons: [
                {
                    extend: 'excel',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'pdf',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                {
                    extend: 'print',
                    exportOptions: {
                        columns: [0, 1, 2, 3, 4]
                    }
                },
                'colvis'
            ]
        });
    });
    
    function get_assign_status(id){
        var url = "<?php echo site_url('admin/Jobdeliverychallan/get_return_assign_status/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id,
            success: function (res) {
                $('.stock_status_details').html(res);
            }
        })
    }
</script>

</body>
</html>

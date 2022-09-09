
<?php init_head(); ?>
<style type="text/css">
    .btn-hold{
        background-color: #e8bb0b;
        color: #fff;
    }
    .btn-brown{
        background-color: brown;
        color: #fff;
    }
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?>
                        <?php if(check_permission_page(372,'create')){?>
                        <a href="<?php echo admin_url('Jobdeliverychallan/add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Delivery Challan </a>
                        <?php } ?>
                        </h4>
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
                                        <option value="3" <?php echo (isset($approve_status) && $approve_status == 3) ? 'selected' : ""; ?>>Cancel</option>
                                        <option value="4" <?php echo (isset($approve_status) && $approve_status == 4) ? 'selected' : ""; ?>>Reconciliation</option>
                                        <option value="5" <?php echo (isset($approve_status) && $approve_status == 5) ? 'selected' : ""; ?>>ON Hold</option>

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

                            <div class="col-md-12 table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                        <tr>
                                            <th>S.No</th>
                                            <th>Number</th>
                                            <th>Vendor Name</th>
                                            <th>Material Sending For </th>
                                            <th>Date</th>
                                            <th>Status</th>
                                            <th>Action</th>
                                        </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                        if (!empty($delivarychallan_list)) {
                                            foreach ($delivarychallan_list as $key => $value) {

                                              $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where `type` = 3 and `job_work_id` = '".$value->id."' and `for` = 1 ")->row();
                                              $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where `type` = 3 and `job_work_id` = '".$value->id."' and `for` = 2 ")->row();
                                    ?>
                                                <tr>
                                                    <td><?php echo ++$key; ?></td>
                                                    <td><?php echo 'JDC-' . str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                    <td><a href="<?php echo admin_url('vendor/vendor/' . $value->vendor_id); ?>" target="_blank"><?php echo cc(value_by_id('tblvendor', $value->vendor_id, 'name')); ?></a></td>
                                                    <td><?php echo cc($value->material_sending_for); ?></td>
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
                                                            }elseif($value->status == 4){
                                                                $status = '<span class="btn btn-danger status btn-brown">Reconciliation</span>';
                                                            }elseif($value->status == 5){
                                                                $status = '<span class="btn btn-warning status btn-hold">ON Hold</span>';
                                                            } 
                                                        ?>
                                                        <a href="javascript:void(0)" class="status" onclick="get_assign_status(<?php echo $value->id; ?>);" data-target="#stock_status" id="status" data-toggle="modal"><?php echo $status; ?></a>
                                                    </td>
                                                    <td class="text-center">
                                                      <?php

                                                      if ($value->status == 1){
                                                          if(!empty($delivery_ho)){
                                                              ?>
                                                              <button value="<?php echo $value->id; ?>" val="1" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Delivery HO</button>
                                                              <?php
                                                          }

                                                          if(!empty($pickup_ho)){
                                                             ?>
                                                             <button value="<?php echo $value->id; ?>" val="2" type="button" class="btn btn-info handover" data-toggle="modal" data-target="#handover_modal">Pickup HO</button>
                                                             <?php
                                                          }

                                                          if($value->process == 0){
                                                                    echo '<button value="'.$value->id.'" title="Make Delivery" type="button" val="1" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Delivery</button>';
                                                          }elseif($value->process == 1 && $value->under_process == 1){
                                                              echo '<button disabled type="button" class="btn btn-success">Delivery In Process</button>';
                                                          }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 0){
                                                              echo '<a href="'.admin_url('jobdeliverychallan/make_complete/'.$delivery_ho->id).'" class="btn btn-success">Mark Delivery Complete</a>';
                                                          }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $value->service_type == 2){
                                                              echo '<button type="button" class="btn btn-info">Completed</button>';
                                                          }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1){
                                                              echo '<button value="'.$value->id.'" title="Make Pickup" type="button" val="2" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button>';
                                                          }elseif($value->process == 2 && $value->under_process == 1){
                                                              echo '<button disabled type="button" class="btn btn-success">Pickup In Process</button>';
                                                          }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){
                                                              echo '<a href="'.admin_url('jobdeliverychallan/make_complete/'.$pickup_ho->id).'" class="btn btn-success">Mark Pick Complete</a>';
                                                          }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                                              echo '<button type="button" class="btn btn-info">Completed</button>';
                                                          }
                                                      }
                                                      ?>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <a href="<?php echo admin_url('Jobdeliverychallan/download_pdf/' . $value->id); ?>" title="pdf" >PDF</a>
                                                                    </li>
                                                                <?php if ($value->status != 1 && $value->status != 3){ ?>
                                                                    <?php if(check_permission_page(372,'edit')){?>
                                                                    <li>
                                                                        <a href="<?php echo admin_url('Jobdeliverychallan/add/' . $value->id); ?>" title="Edit" >Edit</a>
                                                                    </li>
                                                                    <?php }
                                                                    if(check_permission_page(372,'delete')){?>
                                                                    <li>
                                                                        <a class="_delete" href="<?php echo admin_url('Jobdeliverychallan/delete/' . $value->id); ?>" title="Delete" >Delete</a>
                                                                    </li>

                                                                <?php } } ?>
                                                                <?php if ($value->status == 1){ ?>
                                                                    <li>
                                                                        <a class="_delete" style="color: red;" href="<?php echo admin_url('Jobdeliverychallan/cancel_challan/' . $value->id); ?>" title="Cancel" >Cancel</a>
                                                                    </li>
                                                                    <?php if ($value->complete == 0) {?>
                                                                        <li>
                                                                            <a target="_blank" class="_delete" href="<?php echo admin_url('purchase/deliverychallan_return/' . $value->id); ?>" title="Delivery challan return" >Challan Return</a>
                                                                        </li>
                                                                    <?php }else{ ?>
                                                                        <li>
                                                                            <a style="color: yellowgreen;" href="javascript:void(0);" >Challan Returned</a>
                                                                        </li>
                                                                    <?php } ?>
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
<!-- Modal -->
<div id="handover_modal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-lg">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title handover_title">Delivery Hand Overs</h4>
      </div>
      <div class="modal-body" id="handover_data">

      </div>
      <div class="modal-footer">
        <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
      </div>
    </div>

  </div>
</div>
<!-- Modal -->
<div id="deliveryModal" class="modal fade" role="dialog">
  <div class="modal-dialog">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title action_title"></h4>
      </div>
      <div class="modal-body">
        <form action="<?php echo admin_url('jobdeliverychallan/make_delivery'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
        <div class="row">
        	<div class="form-group col-md-6">
                <label for="priority" class="control-label">Priority *</label>
                <select class="form-control selectpicker" name="priority" required="">
                    <option value=""></option>
                    <option value="1">Low</option>
          					<option value="2">Medium</option>
          					<option value="3">High</option>
          					<option value="4">Urgent</option>
                </select>
            </div>
            <div class="form-group col-md-6" app-field-wrapper="date">
                <label for="delivery_date" class="control-label" id="date_type">Delivery Date</label>
                <div class="input-group date">
                    <input id="delivery_date" name="delivery_date" class="form-control datepicker" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                </div>
            </div>
            <div class="form-group col-md-6">
                <label for="branch_id" class="control-label">Select Branch *</label>
                <select class="form-control selectpicker" name="branch_id" required="">
                    <option value=""></option>
                    <?php
                    if(!empty($branch_info)){
                        foreach ($branch_info as $branch) {
                            ?>
                            <option value="<?php echo $branch->id; ?>"><?php echo $branch->comp_branch_name; ?></option>
                            <?php
                        }
                    }
                    ?>
                </select>
            </div>
            <div class="form-group col-md-6">
                <label for="name" class="control-label">Description </label>
                <textarea id="description" name="description" class="form-control"><?php echo (isset($event['description']) && $event['description'] != "") ? $event['description'] : "" ?></textarea>
            </div>
            <input type="hidden" id="chalan_id" name="job_work_id">
            <input type="hidden" id="for" name="for">
        </div>

        <div class="text-right">
            <button class="btn btn-info" type="submit">Submit</button>
        </div>
    	</form>
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
        var url = "<?php echo site_url('admin/Jobdeliverychallan/get_assign_status/'); ?>";
        $.ajax({
            type: "GET",
            url: url+id,
            success: function (res) {
                $('.stock_status_details').html(res);
            }
        })
    }


    $(document).on('click', '.handover', function() {

        var job_work_id = $(this).val();
        var type = $(this).attr('val');
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/jobdeliverychallan/get_handover_data'); ?>",
            data    : {'job_work_id' : job_work_id, 'type' : type},
            success : function(response){
                if(response != ''){

                    if(type == 1){
                        var title = 'Delivery Hand Overs';
                    }else{
                        var title = 'Pickup Hand Overs';
                    }

                     $('.handover_title').html(title);
                     $('#handover_data').html(response);
                }
            }
        })

    });

    $(document).on('click', '.action', function() {
      var challan_id = $(this).val();
      var type = $(this).attr('val');
      $('#chalan_id').val(challan_id);
      $('#for').val(type);

        if(type == 1){
            var title = 'Make Challan Delivery';
            var date_type = 'Delivery Date';
        }else{
            var title = 'Make Challan Pickup';
            var date_type = 'Pickup Date';
        }

         $('.action_title').html(title);
         $('#date_type').html(date_type);

    });
</script>

</body>
</html>

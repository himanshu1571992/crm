
<?php init_head(); ?>
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/jquery.filer.css" rel="stylesheet" type="text/css" />
<link href="<?php  echo base_url(); ?>assets/plugins/jquery.filer/css/themes/jquery.filer-dragdropbox-theme.css" rel="stylesheet" type="text/css" />
<div id="wrapper">
    <div class="content accounting-template">
         <div class="row">

            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
            <div class="col-md-12">

                <div class="panel_s">

                    <div class="panel-body">

                    <h4 class="no-margin"><?php echo $title; /*if(check_permission_page(6,'create')){ ?>  <a href="<?php echo admin_url('estimates/performerinvoice'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Create New Proforma Invoice</a>  <?php }*/ ?></h4>

                    <hr class="hr-panel-heading">

                    <div>

                    <div >
                        <div class="row col-md-12">
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="source" class="control-label">Customer</label>
                                    <select class="form-control selectpicker" name="clientid" id="clientid" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($client_branch_data) && count($client_branch_data) > 0) {
                                            foreach ($client_branch_data as $value) {
                                                ?>
                                                <option value="<?php echo $value->userid ?>" <?php if (!empty($clientid) && $clientid == $value->userid) {
                                            echo 'selected';
                                        } ?>><?php echo cc($value->client_branch_name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="date">
                                    <label for="f_date" class="control-label">From Date</label>
                                    <div class="input-group date">
                                        <input id="f_date" name="f_date" class="form-control datepicker" value="<?php if (!empty($f_date)) {
                                            echo $f_date;
                                        } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group" app-field-wrapper="date">
                                    <label for="t_date" class="control-label">To Date</label>
                                    <div class="input-group date">
                                        <input id="t_date" name="t_date" class="form-control datepicker" value="<?php if (!empty($t_date)) {
                                            echo $t_date;
                                        } ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    </div>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="source" class="control-label">Status</label>
                                    <select class="form-control selectpicker" name="status" id="status" data-live-search="true">
                                        <option value=""></option>
                                        <option value="1" <?php echo (isset($status) && $status == "1") ? 'selected':''; ?>>Complete</option>
                                        <option value="0" <?php echo (isset($status) && $status == "0") ? 'selected':''; ?>>Pending</option>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4">
                                <div class="form-group ">
                                    <label for="source" class="control-label">Branch</label>
                                    <select class="form-control selectpicker" name="branch_id" id="branch_id" data-live-search="true">
                                        <option value=""></option>
                                        <?php
                                        if (isset($branch_info) && count($branch_info) > 0) {
                                            foreach ($branch_info as $branch) {
                                                ?>
                                                <option value="<?php echo $branch->id ?>" <?php echo (!empty($branch_id) && $branch_id == $branch->id) ? 'selected':''; ?>><?php echo cc($branch->comp_branch_name); ?></option>
                                                <?php
                                            }
                                        }
                                        ?>
                                    </select>
                                </div>
                            </div>
                            <div class="col-md-4" style="margin-top: 28px;">
                                <div class="form-group" app-field-wrapper="date" >
                                    <button type="submit"  class="btn btn-info">Search</button>
                                    <a  class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>
                        </div>
                    </div>

                            <div class="col-md-12">

                                <hr>
                                <div class="table-responsive">
                                <table class="table" id="newtable">
                                    <thead>
                                      <tr>
                                        <th>S.No</th>
                                        <th>Challan #</th>
                                        <th>Proforma Invoice #</th>
                                        <th>Invoice #</th>
                                        <th>Proforma Challan #</th>
                                        <th>Customer Name</th>
                                        <th>Challan Date</th>
                                        <th>Delivery Date</th>
                                        <th>Action</th>
                                      </tr>
                                    </thead>
                                    <tbody>
                                    <?php
                                    $total_amt = 0.00;
                                    $i = 1;
                                    if(!empty($delivery_order_list)){
                                        foreach ($delivery_order_list as $key => $value) {

                                            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();

                                            $ordercomplete_date = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "--";
                                            $ordercomplete_date1 = (!empty($value->expected_completed_date)) ? _d($value->expected_completed_date) : "";
                                            $delivery_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 1 ")->row();
                                            $pickup_ho = $this->db->query("SELECT * from `tblchallanprocess` where chalan_id = '".$value->id."' and `for` = 2 ")->row();
                                            $invoice_info = $this->db->query("SELECT `id`,`number` from `tblinvoices` where challan_id = '".$value->id."'")->row();
                                            $invoice_number = (!empty($invoice_info)) ? '<a target="_blank" href="' . admin_url('invoices/download_pdf/' . $invoice_info->id). '" >' .$invoice_info->number. '</a>':'<span class="btn-sm btn-warning">Pending</span>';
                                            $proformachallan_number = ($value->proformachallan_id > 0) ? '<a target="_blank" href="' . admin_url('estimates/proformachallan_download_pdf/' . $value->proformachallan_id). '" >' .'PC-'.sprintf("%'.05d\n", $value->proformachallan_id). '</a>':'--';
                                        ?>
                                        <tr>
                                            <td><?php echo $i++; ?></td>
                                            <td><?php echo '<a target="_blank" href="' . admin_url('chalan/pdf/' . $value->id). '" >' .$value->chalanno. '</a>'; ?></td>
                                            <td><?php echo '<a target="_blank" href="' . admin_url('estimates/download_pdf/' . $value->estimate_id) . '" >' . format_estimate_number($value->estimate_id) . '</a>'; ?></td>
                                            <td><?php echo $invoice_number; ?></td>
                                            <td><?php echo $proformachallan_number; ?></td>
                                            <td><?php if(!empty($client_info)){ echo cc($client_info->client_branch_name); }else{ echo '--'; } ?></td>
                                            <td><?php echo _d($value->challandate); ?></td>
                                            <td><?php echo $ordercomplete_date; ?></td>
                                            <td class="text-center">
                                              <?php
                                                if ($value->complete_status == 1){
                                                    if ($value->approve_status == 1){
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
                                                            echo '<button value="'.$value->id.'" orderid="'.$value->confirmorder_id.'" title="Make Delivery" type="button" val="1" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Delivery</button>';
                                                        }elseif($value->process == 1 && $value->under_process == 1){
                                                            echo '<button disabled type="button" class="btn btn-success">Delivery In Process</button>';
                                                        }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 0){
                                                            echo '<a href="'.admin_url('chalan/make_complete/'.$delivery_ho->id).'" class="btn btn-success">Mark Delivery Complete</a>';
                                                        }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1 && $value->service_type == 2){
                                                            echo '<button type="button" class="btn btn-info">Completed</button>';
                                                        }elseif($value->process == 1 && $value->under_process == 0 && $delivery_ho->complete == 1 && $delivery_ho->final_complete == 1){
                                                            echo '<button value="'.$value->id.'" orderid="'.$value->confirmorder_id.'" title="Make Pickup" type="button" val="2" class="btn btn-success action" data-toggle="modal" data-target="#deliveryModal">Pickup</button>';
                                                        }elseif($value->process == 2 && $value->under_process == 1){
                                                            echo '<button disabled type="button" class="btn btn-success">Pickup In Process</button>';
                                                        }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 0){
                                                            echo '<a href="'.admin_url('chalan/make_complete/'.$pickup_ho->id).'" class="btn btn-success">Mark Pick Complete</a>';
                                                        }elseif($value->process == 2 && $value->under_process == 0 && $pickup_ho->complete == 1 && $pickup_ho->final_complete == 1){
                                                            echo '<button type="button" class="btn btn-info">Completed</button>';
                                                        }
                                                    }
                                              ?>
                                                    <div class="btn-group pull-right">
                                                        <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">
                                                            <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                        </button>
                                                        <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                            <li>
                                                                <a href="javascript:void(0);" class="action-btn orderprocess" data-order_id="<?php echo $value->confirm_order_id; ?>" data-id="<?php echo $value->estimate_id; ?>" data-target="#delivery_order_process" id="order_confirm" data-toggle="modal"> Order Process </a>
                                                            </li>
                                                            <li><a target="_blank" class="action-btn" href="<?php echo admin_url('follow_up/estimates_activity/'. $value->estimate_id); ?>"  >Activity</a></li>
                                                        </ul>
                                                    </div>
                                            <?php 
                                                }else{
                                                    if ($value->order_status_id > 0){
                                                        echo "<span class='label label-success'>".value_by_id("tblconfirmorderstatus", $value->order_status_id, "title");
                                                    }else{
                                                        echo "<span class='label label-warning'>Production Pending</span>";
                                                    }
                                                    
                                                }
                                            ?>    
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
<div id="deliveryModal" class="modal fade" role="dialog">
    <div class="modal-dialog">
      <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title action_title"></h4>
            </div>
            <div class="modal-body">
              <form action="<?php echo admin_url('Chalan/make_delivery'); ?>" enctype="multipart/form-data" method="post" accept-charset="utf-8">
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
                      <input type="hidden" id="chalan_id" name="chalan_id">
                      <input type="hidden" id="for" name="for">
                      <input type="hidden" id="confirm_order_id" name="confirm_order_id" value="">
                      <input type="hidden" id="request_type" name="request_type" value="deliveryorder">
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
<div id="expectedcomplete_date" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/delivery_order_status"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Update Order Complete Date </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="est_id" value="">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group" app-field-wrapper="date">
                            <label for="f_date" class="control-label">Expected Date Of Complete </label>
                            <div class="input-group date">
                                <input id="ordercompletedate" required="" name="expected_compalete_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="section" value="delivery">
                <button type="submit" autocomplete="off" class="btn btn-info">Update</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>

<div id="delivery_order_process" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/confirm_order_process"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Confirm Order Process </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="estimate_id" class="est_id" value="">
                <input type="hidden" name="confirm_order_id" class="confirmorder_id" value="">
                <div class="row">
                    <div class="orderprocessdiv">
                        <div class="col-md-12">
                            <a href="javascript:void(0)" class="addremarkbtn btn btn-success" >Add New Order Process</a>
                            <h4 class="text-center text-danger">Order Process</h4>
                        </div>
                        <div class="orderprocess_div"></div>
                        <div class="col-md-12">
                          <div class="reviseddata_div"></div>
                        </div>
                    </div>

                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" id="ordersection" name="sectiontype" value="update_process">
                <button type="submit" autocomplete="off" class="btn btn-info orderprocess-btn">Confirm</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="revised_orderprocess" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/revised_orderprocess"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Revice Order Process </h4>
            </div>
            <div class="modal-body">
                <input type="hidden" name="orderprocess_id" class="orderprocess_id" value="">
                <div class="row">
                    <div class="col-md-12">
                      <div class="form-group ">
                          <label for="source" class="control-label">Special Remark</label>
                          <input type="text" required=""  name="processname" class="form-control processname" >
                      </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <button type="submit" autocomplete="off" class="btn btn-info orderprocess-btn">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<div id="add_new_process_name" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <?php
        $attributes = array('id' => 'sub_form_order');
        echo form_open_multipart(admin_url("estimates/add_new_process_name"), $attributes);
        ?>
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"> Add New Order Process </h4>
            </div>
            <div class="modal-body">
              <div class="addprocessdiv">
                <input type="hidden" name="estimate_id" class="estimateid" value="">
                <input type="hidden" name="confirm_order_id" class="confirm_order_id" value="">
                <div class="col-md-12">
                  <table class="table table-bordered">
                      <thead>
                          <tr>
                              <th scope="col"><i class="fa fa-cog"></i></th>
                              <th scope="col">Special Remark</th>
                          </tr>
                      </thead>
                      <tbody class="input_fields_wrap2">
                          <tr class="row0">
                              <td width="10%"></td>
                              <td>
                                  <input type="hidden" name="orderprocess[0][type]" class="form-control" value="2">
                                  <input type="text" required="" name="orderprocess[0][name]" class="form-control ordertitle0" >
                              </td>
                          </tr>
                        </tbody>
                    </table>
                    <div class="form-group col-md-12"><a href="javascript:void(0);" class="add_field_button2 btn-sm btn-success pull-right" value="0"><i class="fa fa-plus-circle"></i> Add More Remark</a></div>
                </div>
              </div>
            </div>
            <div class="modal-footer">
                <button type="submit" autocomplete="off" class="btn btn-info">Save</button>
                <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
            </div>
        </div>
        <?php echo form_close(); ?>
    </div>
</div>
<?php init_tail(); ?>
<script src="<?php  echo base_url(); ?>assets/plugins/jquery.filer/js/jquery.filer.min.js" type="text/javascript"></script>
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


<script type="text/javascript">

  $(document).ready(function(){
    'use-strict';

    //Example 2
    $('#filer_input2').filer({
//        limit: 5,
        maxSize: 20,
//        extensions: ['jpg', 'jpeg', 'png' ],
        changeInput: true,
        showThumbs: true,
        addMore: true
    });


  });

  $(document).on("click", ".orderconfirm", function(){
        var id = $(this).data("id");
        $(".est_id").val(id);

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/getConfirmOrder'); ?>",
            data    : {'estimate_id' : id},
            success : function(response){
                if(response != ''){
                    var res=JSON.parse(response);
                    $("#expected_date_of_delivery").val(res.expected_completed_date);
                    $('#order_status_id').val(res.order_status_id);
                    $('#remark').val(res.remark);
                    $('.selectpicker').selectpicker('refresh');
                }
            }
        });
//
//        var expected_date = $(this).data("expected_date");
//        $("#expected_date_of_delivery").val(expected_date);
  });

  $(document).on("click", ".completedate", function(){
        var id = $(this).data("id");
        $(".est_id").val(id);

        var expected_date = $(this).data("expected_date");
        $("#ordercompletedate").val(expected_date);
  });

  $(document).on("click", ".orderprocess", function(){
        var id = $(this).data("id");
        $(".est_id").val(id);
        $(".orderprocess-btn").hide();

        var order_id = $(this).data("order_id");
        $(".confirmorder_id").val(order_id);

        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/estimates/getDeliveryProcess'); ?>",
            data    : {'estimate_id' : id, 'confirm_order_id': order_id},
            success : function(response){
                if(response != ''){
                    $(".orderprocess-btn").show();
                    $(".orderprocess_div").html(response);
                }
            }
        });
  });

 $(document).on("click", ".processcheck", function(){
    var process = $(".process-per").text();
    var total_complete = $(".totalcomplete").val();
    var totalstep = $(".totalstep").val();

    var persent = parseInt(process);
    if($(this).prop("checked") == true){
        total_complete = parseInt(total_complete)+1;
        var percentage =  Math.round((total_complete / totalstep) * 100);
        $(".process-per").html(percentage);
        $(".totalcomplete").val(total_complete);
        $(".progress-bar").css('width', percentage+'%');
    }else{
        total_complete = parseInt(total_complete)-1;
        var percentage = Math.round((total_complete / totalstep) * 100);
        $(".process-per").html(percentage);
        $(".totalcomplete").val(total_complete);
        $(".progress-bar").css('width', percentage+'%');
    }
 });
 $(document).on("click", ".addremarkbtn", function(){
     $("#delivery_order_process").modal("hide");
     $('#add_new_process_name').modal('show');
     var est_id = $(".est_id").val();
     $(".estimateid").val(est_id);

     var confirmorder_id = $(".confirmorder_id").val();
    $(".confirm_order_id").val(confirmorder_id)
 });
 $(document).on("click", ".add_field_button2",function(){
     var addmoreproenq = parseInt($(this).attr('value'));
     var newaddmoreproenq = addmoreproenq + 1;
     $(this).attr('value', newaddmoreproenq);

//        $(".input_fields_wrap").append('<div class="row'+newaddmoreproenq+'"><div class="col-md-10 form-group"><input type="text" name="orderprocessname[]" class="form-control"></div><div class="col-md-2"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></div></div>');
     $(".input_fields_wrap2").append('<tr class="row'+newaddmoreproenq+'"><td width="5%"><a class="btn btn-danger" href="#" onclick="removetitle('+newaddmoreproenq+');"><i class="fa fa-remove"></i></a></td><td><input type="hidden" name="orderprocess['+newaddmoreproenq+'][type]" value="2" class="form-control"><input type="text" name="orderprocess['+newaddmoreproenq+'][name]" class="form-control"></td></tr>');
     $('.selectpicker').selectpicker('refresh');
 });
 function removetitle(proid)
 {
     $('.row' + proid).remove();
 }
 $(document).on("click", ".close-model", function(){
     location.reload();
 });

 function addmodification(id){
    $("#delivery_order_process").modal("hide");
    $('#revised_orderprocess').modal('show');
    var pname = $(this).data("pname");
    $(".processname").val(pname);
    $(".orderprocess_id").val(id);
 }

 function get_revised_processlist(id){
     $.ajax({
         type    : "POST",
         url     : "<?php echo site_url('admin/estimates/get_revised_processlist'); ?>",
         data    : {'id' : id},
         success : function(response){
             if(response != ''){
                 $(".reviseddata_div").html(response);
             }else{
                $(".reviseddata_div").html("");
             }
         }
     });
 }
 $(document).on("click", ".close-revised", function(){
    $(".reviseddata_div").html("");
 });

 $(document).on('click', '.action', function() {
   var challan_id = $(this).val();
   var type = $(this).attr('val');
   var orderid = $(this).attr('orderid');
   $('#chalan_id').val(challan_id);
   $('#confirm_order_id').val(orderid);
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


 $(document).on('click', '.handover', function() {

     var challan_id = $(this).val();
     var type = $(this).attr('val');
     $.ajax({
         type    : "POST",
         url     : "<?php echo site_url('admin/chalan/get_handover_data'); ?>",
         data    : {'challan_id' : challan_id, 'type' : type},
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
</script>

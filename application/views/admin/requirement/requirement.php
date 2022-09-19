<?php init_head(); ?>
<style type="text/css">

    .ui-table > thead > tr > th {
        border:1px solid #9d9d9d !important;
        color: #fff !important;
        background:#6d7580;
    }

    .ui-table > tbody > tr > td{
        border: 1px solid #c7c7c7;
        color:#5f6670;
    }

    .ui-table > tbody > tr:nth-child(even) {
      background: #f8f8f8;
    }

    .actionBtn {
        border: 1px solid #6d7580;
        padding: 8px 10px;
        border-radius: 3px;
        background:#6d7580;
        color:#fff;
        margin-right: 3px;
    }

    .actionBtn:hover {
        background:#51647c;
        color:#fff;
    }

    .btn-hold{
        background-color: #e8bb0b;
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
                    <?php
                        if(check_permission_page(36,'create')){
                    ?>
                     <a href="<?php echo admin_url('requirement/add'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add New Requirement</a>
                    <?php
                        }
                    ?>
                    </h4>
                    <hr class="hr-panel-heading">
                    <div class="row">
                        <div class="row col-md-12">
                            <div class="form-group col-md-4" id="department">
                                <label for="department" class="control-label">Department</label>
                                <select class="form-control selectpicker" required="" data-live-search="true" id="department_id" name="department_id">
                                    <option value=""></option>
                                    <?php
                                        if (isset($department_list) && !empty($department_list)){
                                           foreach ($department_list as $dep) {
                                             $selectedcls = ($sdepartment_id == $dep->id) ? 'selected=""':'';
                                    ?>
                                              <option value="<?php echo $dep->id; ?>" <?php echo $selectedcls; ?>><?php echo cc($dep->name); ?></option>
                                    <?php
                                           }
                                        }
                                    ?>
                                </select>
                            </div>
                            <div class="form-group col-md-4">
                                <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                            </div>
                        </div>
                        <div class="">
                            <div class="col-md-12">
                                <hr>
                                <div class="table-responsive">
                                  <table class="table" id="newtable">
                                      <thead>
                                        <tr>
                                          <th>S.No</th>
                                          <th>Request ID</th>
                                          <th>Department</th>
                                          <th>Expected Date</th>
                                          <th>Remark</th>
                                          <th>Date</th>
                                          <th>Purchase Person Status</th>
                                          <th>Admin Status</th>
                                          <th>PO Created</th>
                                          <th>Action</th>
                                        </tr>
                                      </thead>
                                      <tbody>
                                      <?php
                                      if(!empty($requirement_info)){
                                          $i=1;
                                          foreach($requirement_info as $row){
                                              $can_delete = 1;
                                              if($row->purchase_person_status == 1 || $row->approve_status == 1){
                                                  $can_delete = 0;
                                              }

                                              if($row->po_status == 1){
                                                  $color = '#7cb342';
                                                  $r_name = 'Created';
                                              }else{
                                                  $color = '#fb8c00';
                                                  $r_name = 'Not Created';
                                              }

                                              $outputType = '<span class="inline-block label label-' . (empty($color) ? 'default': '') . '" style="color:' . $color . ';border:1px solid ' . $color . '">' . $r_name;
                                                  $outputType .= '<div class="dropdown inline-block mleft5 table-export-exclude">';
                                                  $outputType .= '<a href="#" style="font-size:14px;vertical-align:middle;" class="dropdown-toggle text-dark" id="tableLeadsStatus-' . $row->id . '" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false">';
                                                  $outputType .= '<span data-toggle="tooltip" title="' . _l('ticket_single_change_status') . '"><i class="fa fa-caret-down" aria-hidden="true"></i></span>';
                                                  $outputType .= '</a>';

                                                  $outputType .= '<ul class="dropdown-menu dropdown-menu-right" aria-labelledby="tableLeadsStatus-' . $row->id . '">';
                                                  foreach ($running_data as $running_change) {
                                                      if ($row->po_status != $running_change['id']) {
                                                          $outputType .= '<li>
                                                        <a href="#" onclick="change_running_status(' . $running_change['id'] . ',' . $row->id . '); return false;">
                                                           ' . $running_change['name'] . '
                                                        </a>
                                                     </li>';
                                                      }
                                                  }
                                                  $outputType .= '</ul>';
                                                  $outputType .= '</div>';
                                                  $outputType .= '</span>';
                                                if ($row->initial_approve_status == 1){
                                                   $cls = "btn-success";
                                                   $iapprove_status = "Approved";
                                                }else if ($row->initial_approve_status == 2){
                                                   $cls = "btn-danger";
                                                   $iapprove_status = "Rejected";
                                                }else if ($row->initial_approve_status == 5){
                                                    $cls = "btn-hold ";
                                                    $iapprove_status = "ON Hold";
                                                }else{
                                                   $cls = "btn-warning";
                                                   $iapprove_status = "Pending";
                                                }

                                                $expected_date = (!empty($row->expected_date)) ? _d($row->expected_date) : 'N/A';
                                              ?>
                                              <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td>
                                                        <?php echo 'P-REQ-'.str_pad($row->id, 4, '0', STR_PAD_LEFT);?>
                                                        <?php echo get_creator_info($row->staff_id, $row->created_at); ?>
                                                    </td>
                                                    <td><?php echo ($row->department_id > 0) ? value_by_id('tbldepartmentsmaster', $row->department_id, "name") : "--"; ?></td>
                                                    <td><?php echo $expected_date; ?></td>
                                                    <td><?php echo cc($row->remark);?></td>
                                                    <td><?php echo date('d-m-Y h:i a',strtotime($row->created_at));?></td>
                                                    <td style="color: <?php echo ($row->purchase_person_status == 1) ? 'Green' : 'Orange'; ?>"><?php echo ($row->purchase_person_status == 1) ? 'Taken' : 'Pending'; ?></td>
                                                    <?php if ($row->approve_status == 0 && $row->purchase_person_status == 1){ ?>
                                                        <td style="color: <?php echo ($row->approve_status == 1) ? 'Green' : 'Orange'; ?>"><?php echo ($row->approve_status == 1) ? 'Taken' : '<a href="javascript:void(0);" class="text-warning adminstatus" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">Pending</a>'; ?></td>
                                                    <?php }else{ ?>
                                                    <td style="color: <?php echo ($row->approve_status == 1) ? 'Green' : 'Orange'; ?>"><?php echo ($row->approve_status == 1) ? 'Taken' : 'Pending'; ?></td>
                                                    <?php } ?>
                                                    <td><?php echo $outputType; ?></td>
                                                    <td>
                                                        <?php echo '<button type="button" data-type="2" class="btn-sm ' . $cls . ' btn-sm status" value="' . $row->id . '" data-toggle="modal" data-target="#statusModal">' . $iapprove_status . '</button>'; ?>
                                                        <div class="btn-group pull-right">
                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                            </button>
                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                <?php if ($row->initial_approve_status != 1){ ?>
                                                                    <li>
                                                                        <a href="<?php echo admin_url('requirement/add/' . $row->id); ?>" style="text-align:center" title="edit" >Edit</a>
                                                                    </li>
                                                                <?php } ?>
                                                                <li>
                                                                    <a href="<?php echo admin_url('requirement/requirement_activity/' . $row->id); ?>" style="text-align:center" target="_blank" title="activity" >Activity</a>
                                                                </li>
                                                                <li>
                                                                    <a  target="_blank" style="text-align:center" href="<?php echo admin_url('requirement/requirement_process_view/'.$row->id); ?>">View</a>
                                                                </li>
                                                                <li>
                                                                    <?php
                                                                        if($can_delete == 1){
                                                                    ?>
                                                                                <a class="_delete" style="background-color:red;color:#fff;text-align:center" href="<?php echo admin_url('requirement/requirement_delete/'.$row->id); ?>">Delete</a>
                                                                    <?php
                                                                        }else{
                                                                            if($row->cancel == 1){
                                                                                echo '<a href="javascript:void(0);" style="color:red;text-align:center">Cancelled</span>';
                                                                            }else{
                                                                    ?>
                                                                                <!-- <button type="button" class="text-danger cancel" data-toggle="modal" data-target="#myModal" value="<?php echo $row->id; ?>">Cancel</button> -->
                                                                                <a href="javascript:void(0);" style="background-color:red;color:#fff;text-align:center" class="text-danger cancel" data-toggle="modal" data-target="#myModal" value="<?php echo $row->id; ?>">Cancel</a>
                                                                    <?php
                                                                            }
                                                                        }
                                                                    ?>
                                                                </li>
                                                                <?php
                                                                    if ($row->po_status == 0 && $row->cancel == 0 && $row->initial_approve_status == 1 && $row->purchase_person_status == 1 && $row->approve_status == 1){
                                                                ?>
                                                                        <li><a style="text-align:center" href="<?php echo admin_url('requirement/requirement_details/'.$row->id); ?>" title="convert to po">Convert PO</a></li>
                                                                <?php        
                                                                    }
                                                                ?>
                                                            </ul>
                                                        </div>
                                                  </td>
                                                </tr>
                                              <?php
                                          }
                                      }else{
                                          echo '<tr><td class="text-center" colspan="9"><h5>Record Not Found</h5></td></tr>';
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

            <?php echo form_close(); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>

<div id="statusModal" class="modal fade" role="dialog">

    <div class="modal-dialog">



        <!-- Modal content-->

        <div class="modal-content">

            <div class="modal-header">

                <button type="button" class="close" data-dismiss="modal">&times;</button>

                <h4 class="modal-title">Requirement Approval Status</h4>

            </div>

            <div class="modal-body" id="approval_html">

            </div>

            <div class="modal-footer">

                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>

            </div>

        </div>



    </div>

</div>
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Cancel Requirement</h4>
      </div>
      <div class="modal-body">
        <form method="post" action="<?php echo admin_url('requirement/cancel_requirement'); ?>">
            <div class="row">
                <div class="form-group col-md-12">
                    <label for="warehouse_id" class="control-label">Cancel Remark</label>
                    <textarea id="cancel_remark" class="form-control" name="cancel_remark"></textarea>
                </div>

                <input type="hidden" id="req_id" name="id">

                <div class="form-group col-md-12">
                    <button type="submit" class="btn btn-primary" >Submit</button>
                </div>
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
<script>

    $(document).ready(function () {
        $('#newtable').DataTable();
    });
</script>
<script type="text/javascript">
    $(document).on('click', '.cancel', function(){
        //  var id = $(this).val();
         var id = $(this).attr('value');
         $("#req_id").val(id);
    });
</script>

<script type="text/javascript">
    function change_running_status(status, id) {
    var data = {};
    data.status = status;
    data.id = id;
    $.post('<?php echo base_url(); ?>admin/requirement/update_po_status', data).done(function(response) {
        location.reload(true);
    });
}
</script>
<script type="text/javascript">
    $('.status').click(function () {
        var id = $(this).val();
        var type = $(this).data("type");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/requirement/get_status'); ?>",
            data: {'id': id, 'type': type},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
    $('.adminstatus').click(function () {
        var id = $(this).attr("value");
        var type = $(this).data("type");
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/requirement/get_process_status'); ?>",
            data: {'id': id, 'type': type},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script>

</body>
</html>

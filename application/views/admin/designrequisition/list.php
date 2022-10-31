<?php init_head(); ?>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> <a target="_blank" href="<?php echo admin_url('designrequisition/design_master_list'); ?>" class="btn btn-success pull-right" style="margin-top:-6px; margin-left:3px;"> Drawing Master List</a>
                        <?php if (check_permission_page(393,'create')){?>
                        <a href="<?php echo admin_url('designrequisition/add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Design Requisition</a>
                        <?php } ?>
                        </h4>
                        <hr class="hr-panel-heading">
                        <div class="col-md-12">
                            <ul class="nav nav-tabs" role="tablist">
                                <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 1) ? 'active' : ''; ?>">
                                    <a  href="#designrequisition" aria-controls="designrequisition" role="tab" data-toggle="tab"> All Design Requisition </a>
                                </li>
                                <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 2) ? 'active' : ''; ?>">
                                    <a href="#designdepartment" aria-controls="designdepartment" role="tab" data-toggle="tab">For Design Department </a>
                                </li>
                            </ul>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 1) ? 'active' : ''; ?>" id="designrequisition">
                                    <?php echo form_open($this->uri->uri_string(), array('id' => 'design-requisition-form', 'class' => 'design-requisition-form')); ?>
                                        <div class="row">
                                            <div class="form-group">
                                              <div class="col-md-3">
                                                  <div class="form-group" app-field-wrapper="date">
                                                      <label for="f_date" class="control-label">From Date</label>
                                                      <div class="input-group date">
                                                          <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date) && $section == 1) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group" app-field-wrapper="date">
                                                      <label for="t_date" class="control-label">To Date</label>
                                                      <div class="input-group date">
                                                          <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date) && $section == 1) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="form-group col-md-2">
                                                  <label for="vendor_id" class="control-label">Status</label>
                                                  <select class="form-control selectpicker" data-live-search="true" id="status" name="status">
                                                      <option value=""></option>
                                                      <option value="0" <?php echo (isset($status) && $status == 0 && $section == 1) ? 'selected' : ""; ?>>Pending</option>
                                                      <option value="1" <?php echo (isset($status) && $status == 1 && $section == 1) ? 'selected' : ""; ?>>Approved</option>
                                                      <option value="2" <?php echo (isset($status) && $status == 2 && $section == 1) ? 'selected' : ""; ?>>Reject</option>
                                                      <option value="6" <?php echo (isset($status) && $status == 6 && $section == 1) ? 'selected' : ""; ?>>Cancelled</option>
                                                  </select>
                                              </div>
                                          </div>
                                            <div class="col-md-2">
                                            <div class="input-group" style="margin-top: 20px;">
                                                <input type="hidden" name="section" value="1">
                                                <button type="submit" class="btn btn-info">Search</button>
                                                <a class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </div>
                                        </div>
                                    <?php echo form_close(); ?>
                                        <div class="row">
                                            <div class="table-responsive">
                                          <div class="col-md-12">
                                              <table class="table" id="newtable">
                                                  <thead>
                                                      <tr>
                                                          <th>S.No</th>
                                                          <th>Request No</th>
                                                          <th style="width: 50.717px;">Status</th>
                                                          <th>Date</th>
                                                          <th>Expected Date</th>
                                                          <th>Expected Completion Date</th>
                                                          <th>Product Type</th>
                                                          <th>Type</th>
                                                          <th>Client/Staff</th>
                                                          <th>Approval Status</th>
                                                          <th class="text-center">Action</th>
                                                      </tr>
                                                  </thead>
                                                  <tbody>
                                                      <?php
                                                        if (!empty($drequisition_list)) {
                                                            $i = 1;
                                                            foreach ($drequisition_list as $key => $row) {

                                                                switch ($row->status) {
                                                                    case 1:
                                                                        $approve_status = '<label class="label label-success">Approved</label>';
                                                                        break;
                                                                    case 2:
                                                                        $approve_status = '<label class="label label-danger">Rejected</label>';
                                                                        break;
                                                                    case 4:
                                                                        $approve_status = '<label class="label label-danger" style="color:brown">Reconciliation</label>';
                                                                        break;
                                                                    case 5:
                                                                        $approve_status = '<label class="label label-warning" style="color: #e8bb0b;border:1px solid #e8bb0b;">ON Hold</label>';
                                                                        break;
                                                                    case 6:
                                                                        $approve_status = '<label class="label label-danger">Cancelled</label>';
                                                                        break;  
                                                                    default:
                                                                        $approve_status = '<label class="label label-warning">Pending</label>';
                                                                        break;
                                                                }
                                                                $check_submission = $this->db->query("SELECT id FROM `tbldesignsubmission` WHERE `designrequisition_id` = ".$row->id." ORDER BY id DESC")->row();

                                                                $expected_date = (!empty($row->expected_date)) ? _d($row->expected_date) : 'N/A';
                                                                $expected_completion_date = (!empty($row->expected_completed_date)) ? _d($row->expected_completed_date) : 'N/A';
                                                     ?>
                                                                <tr>
                                                                    <td><?php echo ++$key; ?></td>
                                                                    <td>
                                                                        <?php echo "DR-".str_pad($row->id, 3, '0', STR_PAD_LEFT); ?>
                                                                        <?php echo get_creator_info($row->added_by, $row->created_at); ?>
                                                                    </td>
                                                                    <td><?php echo ($row->enquirycall_id > 0) ? '<span class="btn-sm btn-success" >From Lead</span>' : '<span class="btn-sm btn-info">Direct</span>'; ?></td>
                                                                    <td><?php echo _d($row->date); ?></td>
                                                                    <td><?php echo $expected_date; ?></td>
                                                                    <td><?php echo $expected_completion_date; ?></td>
                                                                    <td><?php echo ($row->product_type == 1) ? 'Standard' : 'Customized'; ?></td>
                                                                    <td><?php echo ($row->type == 1) ? 'Staff' : 'Client'; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            if ($row->type == 1){
                                                                                echo get_employee_name($row->staff_id);
                                                                            }else{
                                                                                if ($row->client_id > 0){
                                                                                    echo client_info($row->client_id)->client_branch_name;
                                                                                }else{
                                                                                    echo $row->client_name;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td><a href="javascript:void(0)" class="status" onclick="get_assign_status(<?php echo $row->id; ?>, 'requisition');" data-target="#requisition_status" id="status" data-toggle="modal"><?php echo $approve_status; ?></a></td>
                                                                    <td class="text-center">
                                                                        <div class="btn-group pull-right">
                                                                            <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                                <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                            </button>
                                                                            <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                                
                                                                                <li>
                                                                                    <a href="<?php echo admin_url('designrequisition/view/' . $row->id); ?>" target="_blank" title="view" >View</a>
                                                                                </li>
                                                                                <li>
                                                                                    <a href="<?php echo admin_url('designrequisition/designrequisition_activity/' . $row->id); ?>" target="_blank" title="activity" >Activity</a>
                                                                                </li>
                                                                                <?php if (empty($check_submission) && $row->status != 6){ ?>
                                                                                    <?php if (check_permission_page(393,'edit')){?>
                                                                                    <li>
                                                                                        <a href="<?php echo admin_url('designrequisition/add/' . $row->id); ?>" title="Edit" >Edit</a>
                                                                                    </li>
                                                                                    <?php 
                                                                                    }    
                                                                                    if (check_permission_page(393,'delete')){?>
                                                                                    <li>
                                                                                        <a class="_delete" href="<?php echo admin_url('designrequisition/delete/' . $row->id); ?>" title="Delete" >Delete</a>
                                                                                    </li>
                                                                                <?php }} ?>
                                                                                <li>
                                                                                    <a style="color: red;" class="text-danger _delete" href="<?php echo admin_url('designrequisition/cancel/' . $row->id); ?>" data-status="1">CANCEL</a>
                                                                                </li>
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
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 2) ? 'active' : ''; ?>" id="designdepartment">
                                    <?php echo form_open($this->uri->uri_string(), array('id' => 'design-department-form', 'class' => 'design-department-form')); ?>
                                        <div class="row">
                                           <div class="form-group">
                                              <div class="col-md-3">
                                                  <div class="form-group" app-field-wrapper="date">
                                                      <label for="f_date" class="control-label">From Date</label>
                                                      <div class="input-group date">
                                                          <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date) && $section == 2) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group" app-field-wrapper="date">
                                                      <label for="t_date" class="control-label">To Date</label>
                                                      <div class="input-group date">
                                                          <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date) && $section == 2) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                      </div>
                                                  </div>
                                              </div>
                                              <div class="col-md-3">
                                                  <div class="form-group" app-field-wrapper="status">
                                                    <label for="vendor_id" class="control-label">Status</label>
                                                    <select class="form-control selectpicker" data-live-search="true" id="status" name="status">
                                                        <option value=""></option>
                                                        <option value="0" <?php echo (isset($status) && $status == 0 && $section == 2) ? 'selected' : ""; ?>>Pending</option>
                                                        <option value="1" <?php echo (isset($status) && $status == 1 && $section == 2) ? 'selected' : ""; ?>>Approved</option>
                                                        <option value="2" <?php echo (isset($status) && $status == 2 && $section == 2) ? 'selected' : ""; ?>>Reject</option>
                                                        <option value="3" <?php echo (isset($status) && $status == 3 && $section == 2) ? 'selected' : ""; ?>>Action Pending</option>
                                                    </select>
                                                  </div>
                                              </div>
                                              <div class="col-md-2">
                                                 <div class="form-group" app-field-wrapper="status">
                                                     <div class="input-group" style="margin-top: 25px;">
                                                         <input type="hidden" name="section" value="2">
                                                         <button type="submit" class="btn btn-info">Search</button>
                                                         <a class="btn btn-danger" href="">Reset</a>
                                                     </div>
                                                 </div>
                                               </div>
                                          </div>

                                        </div>
                                    <?php echo form_close(); ?>
                                      <div class="row">
                                          <div class="table-responsive">
                                              <div class="col-md-12">
                                                  <table class="table" id="newtable2">
                                                      <thead>
                                                          <tr>
                                                              <th>S.No</th>
                                                              <th>Request No.</th>
                                                              <th style="width: 50.717px;">Status</th>
                                                              <th>Date</th>
                                                              <th>Expected Date</th>
                                                              <th>Expected Completion Date</th>
                                                              <th>Product Type</th>
                                                              <th>Type</th>
                                                              <th>Client/Staff</th>
                                                              <th>Design Status</th>
                                                              <th class="text-center">Action</th>
                                                          </tr>
                                                      </thead>
                                                      <tbody>
                                                        <?php
                                                        if (!empty($design_departmentlist)) {
                                                            $i = 1;
                                                            foreach ($design_departmentlist as $key => $row) {
                                                                $completeremark = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tbldesignrequisitionremark` WHERE `designrequisition_id` = ".$row->id." AND `complete_by_design` = 1")->row()->ttl_row;
                                                                $countremark = $this->db->query("SELECT COUNT(*) as ttl_row FROM `tbldesignrequisitionremark` WHERE `designrequisition_id` = ".$row->id)->row()->ttl_row;
                                                                $check_submission = $this->db->query("SELECT id FROM `tbldesignsubmission` WHERE `designrequisition_id` = ".$row->id." ORDER BY id DESC")->row();
                                                                if ($row->design_status == 1){
                                                                    $design_status = '<label class="label label-success">Approved</label>';
                                                                }else if ($row->design_status == 2){
                                                                    $design_status = '<label class="label label-danger">Rejected</label>';
                                                                }else{
                                                                    $design_status = (!empty($check_submission)) ? '<label class="label label-warning">Pending</label>' : '<label class="label label-info">Action Pending</label>';
                                                                }
                                                                $expected_date = (!empty($row->expected_date)) ? _d($row->expected_date) : 'N/A';
                                                                $expected_completed_date = (!empty($row->expected_completed_date)) ? _d($row->expected_completed_date) : '';
                                                                $expectedcompleted_date = (!empty($row->expected_completed_date)) ? _d($row->expected_completed_date) : 'SET DATE';
                                                       ?>
                                                                <tr>
                                                                    <td Width="1%"><?php echo ++$key; ?></td>
                                                                    <td>
                                                                        <?php echo "DR-".str_pad($row->id, 3, '0', STR_PAD_LEFT); ?>
                                                                        <?php echo get_creator_info($row->added_by, $row->created_at); ?>
                                                                    </td>
                                                                    <td><?php echo ($row->enquirycall_id > 0) ? '<span class="btn-sm btn-success" >From Lead</span>' : '<span class="btn-sm btn-info">Direct</span>'; ?></td>
                                                                    <td><?php echo _d($row->date); ?></td>
                                                                    <td><?php echo $expected_date; ?></td>
                                                                    <td><a href="javascript:void(0);" class="label label-primary completedate" data-toggle="modal" data-target="#expectedcomplete_date" data-section="2"  data-id="<?php echo $row->id; ?>" data-expected_date="<?php echo $expected_completed_date; ?>"><?php echo $expectedcompleted_date; ?></a></td>
                                                                    <td><?php echo ($row->product_type == 1) ? 'Standard' : 'Customized'; ?></td>
                                                                    <td><?php echo ($row->type == 1) ? 'Staff' : 'Client'; ?></td>
                                                                    <td>
                                                                        <?php
                                                                            if ($row->type == 1){
                                                                                echo get_employee_name($row->staff_id);
                                                                            }else{
                                                                                if ($row->client_id > 0){
                                                                                    echo client_info($row->client_id)->client_branch_name;
                                                                                }else{
                                                                                    echo $row->client_name;
                                                                                }
                                                                            }
                                                                        ?>
                                                                    </td>
                                                                    <td>
                                                                      <?php if (!empty($check_submission)){ ?>
                                                                          <a href="javascript:void(0)" class="status" onclick="get_assign_status(<?php echo $check_submission->id; ?>, 'designsubmission');" data-target="#requisition_status" id="status" data-toggle="modal"><?php echo $design_status; ?></a>
                                                                      <?php }else{
                                                                          echo '<label class="label label-info">Action Pending</label>';
                                                                      } ?>
                                                                    </td>
                                                                    <td class="text-center">
                                                                      <div class="btn-group pull-right">
                                                                          <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                              <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                          </button>
                                                                          <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                              <li>
                                                                                  <a href="<?php echo admin_url('designrequisition/view/' . $row->id); ?>" target="_blank" title="view" >View</a>
                                                                              </li>
                                                                              <li>
                                                                                  <a href="<?php echo admin_url('designrequisition/designrequisition_activity/' . $row->id); ?>" target="_blank" title="activity" >Activity</a>
                                                                              </li>
                                                                              <li>
                                                                                  <a href="javascript:void(0);" onclick="get_production_remark(<?php echo $row->id; ?>);" data-target="#productionremark" id="status" data-toggle="modal">Update Remark</a>
                                                                              </li>
                                                                              <?php if ($completeremark == $countremark){ ?>
                                                                                <li>
                                                                                    <a href="javascript:void(0);" onclick="get_design_submission(<?php echo $row->id; ?>);" data-target="#designsubmission" id="dsubmission" data-toggle="modal">Design Submission</a>
                                                                                </li>
                                                                              <?php }else{ ?>
                                                                                <li>
                                                                                    <a href="javascript:void(0);" onclick="confirm('You can\'t submit Design, until you update remarks');">Design Submission</a>
                                                                                </li>
                                                                              <?php } ?>

                                                                                <?php
                                                                                    if ($row->design_status == 1){
                                                                                         $chk_converted = $this->db->query("SELECT COUNT(`id`) as ttl_row FROM `tbldesignmaster` WHERE `designrequisition_id`= ".$row->id." ")->row()->ttl_row;
                                                                                         if ($chk_converted > 0){
                                                                                           echo "<li><a href='javascript:void(0);' style='color:yellowgreen'>Master Converted</a></li>";
                                                                                         }else{
                                                                                           $chkremarkdesign = $this->db->query("SELECT `id` FROM `tbldesignrequisitionremark` WHERE `designrequisition_id`='".$row->id."' AND `design_files` !='' ")->row();
                                                                                           if (!empty($chkremarkdesign)){
                                                                                ?>
                                                                                  <li>
                                                                                      <a href="<?php echo admin_url('designrequisition/convert_to_master/' . $row->id); ?>" target="_blank" title="convert to master" >Convert To Master</a>
                                                                                  </li>
                                                                                <?php
                                                                                            }
                                                                                        }
                                                                                    }
                                                                               ?>
                                                                              <input type="hidden" class="ttlsubmission<?php echo $row->id; ?>" name="ttldesignsubmission" value="<?php echo (!empty($check_submission)) ? "Y" : "N"; ?>">
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
                </div>


            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>
    <div id="requisition_status" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Assigned Person</h4>
                </div>
                <div class="modal-body requisition_status_details"></div>
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
            echo form_open_multipart(admin_url("designrequisition/update_expected_completed_date"), $attributes);
            ?>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close close-model" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title"> Update Expected Completion Date </h4>
                </div>
                <div class="modal-body">
                    <input type="hidden" name="designrequisition_id" class="designrequisition_id" value="">
                    <div class="row">
                        <div class="col-md-12">
                            <div class="form-group" app-field-wrapper="date">
                                <label for="f_date" class="control-label">Expected Completion Date </label>
                                <div class="input-group date">
                                    <input id="expectedCompletedDate" required="" name="expected_completed_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <input type="hidden" name="section_id" class="section_id" value="2">
                    <button type="submit" autocomplete="off" class="btn btn-info">Update</button>
                    <button type="button" class="btn btn-default close-model" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div id="productionremark" class="modal fade" role="dialog">
        <div class="modal-dialog modal-lg">
          <?php echo form_open(admin_url("Designrequisition/update_remark"), array('id' => 'sub_form_order')); ?>
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                  <button type="button" class="close" data-dismiss="modal">&times;</button>
                  <h4 class="modal-title">Production Remarks</h4>
                </div>
                <div class="modal-body">
                  <div class="row productionremark_html"></div>
                </div>
                <div class="modal-footer">
                    <button type="submit" autocomplete="off" class="btn btn-info remarkbtn">Update</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
    <div id="designsubmission" class="modal fade designsubmission_html" role="dialog">

    </div>
<?php init_tail(); ?>

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


    <script type="text/javascript">

    $(document).on("click", ".completedate", function(){
        var id = $(this).data("id");
        $(".designrequisition_id").val(id);
        var section_id = $(this).data("section");
        $(".section_id").val(section_id);

        var expected_date = $(this).data("expected_date");
        $("#expectedCompletedDate").val(expected_date);
    });

        $(document).ready(function () {
            $('#newtable').DataTable();
            $('#newtable2').DataTable();
        });

        function get_assign_status(id, section){
            var url = "<?php echo site_url('admin/Designrequisition/get_assign_status/'); ?>";
            $.ajax({
                type: "GET",
                url: url+id+'/'+section,
                success: function (res) {
                    $('.requisition_status_details').html(res);
                }
            });
        }

        function get_production_remark(id){
            $(".remarkbtn").show();
            var ttlsubmission = $(".ttlsubmission"+id).val();
            if (ttlsubmission == "Y"){
                $(".remarkbtn").hide();
            }

            var url = "<?php echo site_url('admin/Designrequisition/get_production_remark/'); ?>";
            $.ajax({
                type: "GET",
                url: url+id,
                success: function (res) {
                    $('.productionremark_html').html(res);
                }
            });
        }

        function get_design_submission(id){
            var url = "<?php echo site_url('admin/Designrequisition/get_design_submission/'); ?>";
            $.ajax({
                type: "GET",
                url: url+id,
                success: function (res) {
                    $('.designsubmission_html').html(res);
                    $('.selectpicker').selectpicker('refresh');
                }
            });
        }

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
    </script>
</body>
</html>


<script type="text/javascript">
    $(document).on('click', '.handover', function () {

        var handover_id = $(this).val();
        if (handover_id > 0) {
            $.ajax({
                type: "POST",
                url: "<?php echo site_url('admin/handover/get_handover_data'); ?>",
                data: {'handover_id': handover_id},
                success: function (response) {
                    if (response != '') {


                        $('#handover_data').html(response);
                    }
                }
            })
        }


    });
</script>

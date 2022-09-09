
<?php init_head(); ?>
<style type="text/css">
    .popover{
        max-width:600px;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?>
                        <?php if(check_permission_page(323,'create')){?>    
                        <a href="<?php echo admin_url('enquirycall/add'); ?>" class="btn btn-info pull-right" style="margin-top:-6px; "> Add Call Enquiry </a>
                        <?php } ?>
                        </h4>
                        <hr class="hr-panel-heading">
                        <div>
                            <div class="col-md-12">
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 1) ? 'active' : ''; ?>">
                                        <a  href="#verified" aria-controls="verified" role="tab" data-toggle="tab"> Verified </a>
                                    </li>
                                    <li role="presentation" class="text-center <?php echo (!empty($section) && $section == 2) ? 'active' : ''; ?>">
                                        <a href="#unverified" aria-controls="unverified" role="tab" data-toggle="tab">Unverified </a>
                                    </li>
                                </ul>
                            </div>
                            <div class="tab-content">
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 1) ? 'active' : ''; ?>" id="verified">
                                    <div class="col-md-12">
                                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="date">
                                                <label for="f_date" class="control-label">From Date</label>
                                                <div class="input-group date">
                                                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date) && $section == 1) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="date">
                                                <label for="t_date" class="control-label">To Date</label>
                                                <div class="input-group date">
                                                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date) && $section == 1) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-2" style="margin-bottom: 6px;">
                                            <div class="form-group" app-field-wrapper="status">
                                                <label for="t_date" class="control-label">Status</label>
                                                <select class="form-control selectpicker" id="status" name="status" data-live-search="true">
                                                    <option value=""></option>
                                                    <option value="0" <?php echo (isset($status) && $section == 1) ? ($status == 0) ? "selected=''" : "" : ""; ?>>Pending</option>
                                                    <option value="1" <?php echo (isset($status) && $section == 1) ? ($status == 1) ? "selected=''" : "" : ""; ?>>Converted</option>
                                                    <option  value="2" <?php echo (isset($status) && $section == 1) ? ($status == 2) ? "selected=''" : "" : ""; ?>>Assign Production</option>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="status">
                                                <label for="t_date" class="control-label">Source</label>
                                                <select class="form-control selectpicker" id="source" name="source" data-live-search="true">
                                                    <option value=""></option>
                                                    <?php
                                                    if (!empty($source_list)) {
                                                        foreach ($source_list as $value) {
                                                            $select_cls = (isset($source)  && $section == 1 && $value->id == $source) ? "selected=''" : "";
                                                            echo '<option value="' . $value->id . '" ' . $select_cls . '>' . $value->name . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="staff">
                                                <label for="t_date" class="control-label">Created By</label>
                                                <select class="form-control selectpicker" id="added_by" name="added_by" data-live-search="true">
                                                    <option value=""></option>
                                                    <?php
                                                    if (!empty($staff_list)) {
                                                        foreach ($staff_list as $staff) {
                                                            $select_cls = (isset($added_by)  && $section == 1 && $staff->staffid == $added_by) ? "selected=''" : "";
                                                            echo '<option value="' . $staff->staffid . '" ' . $select_cls . '>' . cc($staff->firstname) . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="input-group" style="margin-top: 26px;">
                                                <input type="hidden" name="section" value="1">
                                                <button type="submit" class="btn btn-info">Search</button>
                                                <a class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                        <br>
                                    <hr>
                                    <div class="col-md-12">
                                        <hr>
                                        <div class="table-responsive">
                                            <table class="table newtable" >
                                                <thead>
                                                  <tr>
                                                    <th>S.No</th>
                                                    <th style="width:8%;">Activity</th>
                                                    <th>Enquiry ID</th>
                                                    <th>Created By</th>
                                                    <th>Company Name</th>
                                                    <th>Email</th>
                                                    <th>Status</th>
                                                    <th>Source</th>
                                                    <th>Call Type</th>
                                                    <th>Lead Category</th>
                                                    <th>Recording</th>
                                                    <th>Date Time</th>
                                                    <th>Contacts</th>
                                                    <th class="text-center">Action</th>
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if(!empty($verifiedcall_list)){
                                                    foreach ($verifiedcall_list as $key => $value) {

                                                    $recording_url = '';
                                                    if ($value->call_type == 1){
                                                        $call_data = $this->db->query("SELECT `recording_url` FROM tblcallincoming WHERE `id` = ".$value->call_id."")->row();
                                                        if (!empty($call_data)){
                                                            $recording_url = $call_data->recording_url;
                                                        }
                                                    }else{
                                                        $call_data = $this->db->query("SELECT `recording_url` FROM tblcalloutgoing WHERE `id` = ".$value->call_id."")->row();
                                                        if (!empty($call_data)){
                                                            $recording_url = $call_data->recording_url;
                                                        }
                                                    }
                                                    $source_name = value_by_id('tblleadssources',$value->source_id,'name');

                                                    if ($value->clientid > 0){
                                                        $company_name = client_info($value->clientid)->client_branch_name;
                                                    }else{
                                                        $company_name = (!empty($value->company_name)) ? cc($value->company_name) : "--";
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td>
                                                            <a target="_blank" class="btn-sm btn-info" href="<?php echo admin_url('enquirycall/enquirycall_activity/'.$value->id); ?>">Activity</a><br><br>
                                                            <?php 
                                                                if ($value->is_converted == 1){ 
                                                                    $lead_info = $this->db->query("SELECT `id` FROM `tblleads` WHERE `enquirycall_id`= '".$value->id."' ")->row();
                                                                    if (!empty($lead_info)){
                                                            ?>
                                                                        <a target="_blank" class="" href="<?php echo admin_url('follow_up/special_lead_activity/'.$lead_info->id); ?>">Special Activity</a>
                                                            <?php   }
                                                                }
                                                            ?>    
                                                        </td>
                                                        <td><a target="_blank" href="<?php echo admin_url('enquirycall/view/'.$value->id); ?>"><?php echo "ENQ-".str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></a></td>
                                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                        <td><?php echo $company_name; ?></td>
                                                        <td><?php echo (!empty($value->email)) ? $value->email : "--"; ?></td>
                                                        <td><?php
                                                                switch ($value->is_converted) {
                                                                    case 1:
                                                                        echo '<p class="text-success">Converted</p>';
                                                                        break;
                                                                    case 2:
                                                                        echo '<p class="text-info">Assign <br> Production</p>';
                                                                        break;
                                                                    default:
                                                                        echo '<p class="text-warning">Pending</p>';
                                                                        break;
                                                                }
                                                            ?>
                                                        </td>
                                                        <!--<td class="text-center"><?php echo $recording_url; ?></td>-->

                                                        <td><?php echo ($value->source_id > 0) ? $source_name : "--"; ?></td>
                                                        <td><?php echo ($value->call_type == 1) ? "Incoming": "Outgoing"?></td>
                                                        <td><?php echo ($value->lead_category_id > 0) ? cc(value_by_id("tblleadcategorymaster", $value->lead_category_id, "title")) : "--"; ?></td>
                                                        <td class="text-center">
                                                            <?php if ($recording_url != ''){ ?>
                                                            <a href="#" data-toggle="popover" class="recording_play" id="record<?php echo $key; ?>" data-placement="top" data-container="body" data-html="true" onclick="recording(this, '<?php echo $key; ?>', '<?php echo $recording_url; ?>');" style="font-size: 40px;" data-content=""><i class="fa fa-play-circle"></i></a>
                                                                <?php } else{
                                                                    echo '--';
                                                                }?>
                                                        </td>
                                                        <td><?php echo _d($value->created_at); ?></td>
                                                        <td>
                                                            <?php if ($value->call_id > 0){ ?>
                                                                <a target="_blank" href="<?php echo admin_url('enquirycall/enquirycall_contacts/'.$value->id); ?>"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a>
                                                            <?php }else{
                                                                echo '--';
                                                            } ?>
                                                        </td>
                                                        <td class="text-center">
                                                          <?php
                                                              $designrequisition = $this->db->query("SELECT `show_status` FROM `tbldesignrequisition` WHERE `enquirycall_id`=".$value->id." ")->row();
                                                              if (empty($designrequisition)){
                                                                if(check_permission_page(323,'create')){
                                                          ?>
                                                          <a href="<?php echo admin_url('designrequisition/add/' . $value->id.'/enquirycall'); ?>" title="Design Requisition">Design Requisition</a>
                                                          <?php }
                                                          }else{
                                                                if ($designrequisition->show_status == 1){
                                                                    echo "<span class='btn text-success'>Design Assigned</span>";
                                                                }else if($designrequisition->show_status == 2){
                                                                    echo "<span class='btn text-danger'>Design Requisition Rejected</span>";
                                                                }else if($designrequisition->show_status == 3){
                                                                    echo "<span class='btn text-success'>Design Submitted for Approval</span>";
                                                                }else if($designrequisition->show_status == 4){
                                                                    echo "<span class='btn text-success'>Design Approved</span>";
                                                                }else if($designrequisition->show_status == 6){
                                                                    echo "<span class='btn text-danger'>Design Cancelled</span>";
                                                                }
                                                          } ?>
                                                            <div class="btn-group pull-right">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <a target="_blank" href="<?php echo admin_url('enquirycall/view/' . $value->id); ?>" title="View" >View</a>
                                                                    </li>
                                                                    <?php
                                                                        if ($value->is_converted != 1){
                                                                    ?>
                                                                    <?php if(check_permission_page(323,'edit')){?>
                                                                        <li>
                                                                            <a href="<?php echo admin_url('enquirycall/add/' . $value->id); ?>" title="Edit" >Edit</a>
                                                                        </li>
                                                                    <?php } ?>    
                                                                        <?php if ($value->is_converted != 2) { ?>
                                                                        <li>
                                                                            <a href="<?php echo admin_url('enquirycall/cilent_enquiry_form/' . $value->id); ?>" title="send to client">Send To Client</a>
                                                                        </li>
                                                                        <li>
                                                                            <a href="<?php echo admin_url('enquirycall/convert_to_lead/' . $value->id); ?>" title="convert to lead">Convert To Lead</a>
                                                                        </li>
                                                                    <?php }
                                                                        }
                                                                    ?>
                                                                    <?php if ($value->call_type == 1){ ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="linkcall" data-id="<?php echo $value->id; ?>" data-call_id="<?php echo $value->call_id; ?>" title="link call">Link call</a>
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
                                <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == 2) ? 'active' : ''; ?>" id="unverified">
                                    <div class="col-md-12">
                                        <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'proposal-form')); ?>
                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="date">
                                                <label for="f_date" class="control-label">From Date</label>
                                                <div class="input-group date">
                                                    <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (!empty($f_date)  && $section == 2) ? $f_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>

                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="date">
                                                <label for="t_date" class="control-label">To Date</label>
                                                <div class="input-group date">
                                                    <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (!empty($t_date)  && $section == 2) ? $t_date : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-3">
                                            <div class="form-group" app-field-wrapper="staff">
                                                <label for="t_date" class="control-label">Created By</label>
                                                <select class="form-control selectpicker" id="added_by" name="added_by" data-live-search="true">
                                                    <option value=""></option>
                                                    <?php
                                                    if (!empty($staff_list)) {
                                                        foreach ($staff_list as $staff) {
                                                            $select_cls = (isset($added_by)  && $section == 2 && $staff->staffid == $added_by) ? "selected=''" : "";
                                                            echo '<option value="' . $staff->staffid . '" ' . $select_cls . '>' . cc($staff->firstname) . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        <div class="col-md-2">
                                            <div class="form-group" app-field-wrapper="status">
                                                <label for="t_date" class="control-label">Source</label>
                                                <select class="form-control selectpicker" id="source" name="source" data-live-search="true">
                                                    <option value=""></option>
                                                    <?php
                                                    if (!empty($source_list)) {
                                                        foreach ($source_list as $value) {
                                                            $select_cls = (isset($source) && $section == 2 && $value->source_id == $source) ? "selected=''" : "";
                                                            echo '<option value="' . $value->source_id . '" ' . $select_cls . '>' . $value->source . '</option>';
                                                        }
                                                    }
                                                    ?>
                                                </select>
                                            </div>
                                        </div>
                                        
                                        <div class="col-md-2">
                                            <div class="input-group" style="margin-top: 26px;">
                                                <input type="hidden" name="section" value="2">
                                                <button type="submit" class="btn btn-info">Search</button>
                                                <a class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </div>
                                        <?php echo form_close(); ?>
                                        <br>
                                    
                                    <div class="col-md-12">
                                    <hr>
                                        <div class="table-responsive">
                                            <table class="table newtable">
                                                <thead>
                                                  <tr>
                                                    <th>S.No</th>
                                                    <th>Enquiry ID</th>
                                                    <th>Created By</th>
                                                    <!-- <th>Lead Category</th>
                                                    <th>Call Type</th> -->
                                                    <th>Source</th>
                                                    <!-- <th>Company Name</th> -->
                                                    <th>Contact No</th>
                                                    <!-- <th>Email</th>
                                                    <th>Recording</th> -->
                                                    <th>Unverified Status</th>
                                                    <th>Other Remark</th>
                                                    <th>Date Time</th>
                                                   <!--  <th>Contacts</th>
                                                    <th class="text-center">Action</th> -->
                                                  </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if(!empty($unverifiedcall_list)){
                                                    foreach ($unverifiedcall_list as $key => $value) {

                                                    $recording_url = '';
                                                    if ($value->call_type == 1){
                                                        $call_data = $this->db->query("SELECT `recording_url` FROM tblcallincoming WHERE `id` = ".$value->call_id."")->row();
                                                        if (!empty($call_data)){
                                                            $recording_url = $call_data->recording_url;
                                                        }
                                                    }else{
                                                        $call_data = $this->db->query("SELECT `recording_url` FROM tblcalloutgoing WHERE `id` = ".$value->call_id."")->row();
                                                        if (!empty($call_data)){
                                                            $recording_url = $call_data->recording_url;
                                                        }
                                                    }
                                                    $source_name = value_by_id('tblleadssources',$value->source_id,'name');

                                                    if ($value->clientid > 0){
                                                        $company_name = client_info($value->clientid)->client_branch_name;
                                                    }else{
                                                        $company_name = (!empty($value->company_name)) ? cc($value->company_name) : "--";
                                                    }
                                                ?>
                                                    <tr>
                                                        <td><?php echo ++$key; ?></td>
                                                        <td><?php echo "ENQ-".str_pad($value->id, 4, '0', STR_PAD_LEFT); ?></td>
                                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                        <!-- <td><?php echo ($value->lead_category_id > 0) ? cc(value_by_id("tblleadcategorymaster", $value->lead_category_id, "title")) : "--"; ?></td>
                                                        <td><?php echo ($value->call_type == 1) ? "Incoming": "Outgoing"?></td> -->
                                                        <td><?php echo ($value->source_id > 0) ? $source_name : "--"; ?></td>
                                                        <!-- <td><?php echo $company_name; ?></td> -->
                                                        <td><?php echo (!empty($value->mobile)) ? $value->mobile : "--"; ?></td>
                                                        <!-- <td><?php echo (!empty($value->email)) ? $value->email : "--"; ?></td>  -->
                                                        <!-- <td class="text-center">
                                                            <?php if ($recording_url != ''){ ?>
                                                                    <a href="#" data-toggle="popover" class="recording_play" id="record<?php echo $key; ?>" data-placement="top" data-container="body" data-html="true" onclick="recording(this, '<?php echo $key; ?>', '<?php echo $recording_url; ?>');" style="font-size: 40px;" data-content=""><i class="fa fa-play-circle"></i></a>
                                                            <?php } else {
                                                                    echo '--';
                                                            }?>
                                                        </td> -->
                                                        <td><span class="label label-success"><?php echo ($value->unverified_status_id > 0) ? value_by_id("tblunverifedleadmaster", $value->unverified_status_id, "title") : "--"; ?></span></td>
                                                        <td><?php echo (!empty($value->unverified_order_remark)) ? cc($value->unverified_order_remark) : "--";  ?></td>
                                                        <td><?php echo _d($value->created_at); ?></td>
                                                        <!-- <td>
                                                            <?php if ($value->call_id > 0){ ?>
                                                                <a target="_blank" href="<?php echo admin_url('enquirycall/enquirycall_contacts/'.$value->id); ?>"><img src="https://schachengineers.com/schacrm/assets/images/make_call.png" width="35" height="35"></a>
                                                            <?php }else{
                                                                echo '--';
                                                            } ?>
                                                        </td>
                                                        <td class="text-center">

                                                            <div class="btn-group pull-right">
                                                                <button type="button" class="btn btn-default dropdown-toggle" data-toggle="dropdown" aria-haspopup="true" aria-expanded="true">
                                                                    <i class="fa fa-ellipsis-v" aria-hidden="true"></i>
                                                                </button>
                                                                <ul class="dropdown-menu dropdown-menu-right toggle-menu">
                                                                    <li>
                                                                        <a href="<?php echo admin_url('enquirycall/view/' . $value->id); ?>" title="View" >View</a>
                                                                    </li>
                                                                    <li><a target="_blank" href="<?php echo admin_url('enquirycall/enquirycall_activity/'.$value->id); ?>">Activity</a></li>
                                                                    <?php
                                                                        if ($value->is_converted != 1){
                                                                    ?>
                                                                        <li>
                                                                            <a href="<?php echo admin_url('enquirycall/add/' . $value->id); ?>" title="Edit" >Edit</a>
                                                                        </li>
                                                                        <?php if ($value->is_converted != 2) { ?>
                                                                        <li>
                                                                            <a href="<?php echo admin_url('enquirycall/cilent_enquiry_form/' . $value->id); ?>" title="send to client">Send To Client</a>
                                                                        </li>
                                                                    <?php }
                                                                        }
                                                                    ?>
                                                                    <?php if ($value->call_type == 1){ ?>
                                                                    <li>
                                                                        <a href="javascript:void(0);" class="linkcall" data-id="<?php echo $value->id; ?>" data-call_id="<?php echo $value->call_id; ?>" title="link call">Link call</a>
                                                                    </li>
                                                                    <?php } ?>
                                                                </ul>
                                                            </div>
                                                        </td> -->
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
</div>
<div id="calldetailsmodel" class="modal fade" role="dialog">
    <div class="modal-dialog">

        <div class="modal-content">
            <form  action="<?php echo admin_url('enquirycall/linked_call'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Link a call</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">
                            <input type="text" class="form-control" name="call_id" id="call_id">
                            <input type="hidden" class="form-control" name="enquirycallid" id="enquirycallid">
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-info" >Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
            </form>
        </div>

    </div>
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


<script>

    $(document).ready(function () {
        $('.newtable').DataTable({
        });
    });
</script>
<script type="text/javascript">

    function recording(el, id, url) {
        var audio = '<audio controls autoplay><source src="' + url + '" type="audio/ogg"></audio>';
        $(el).attr('data-content', audio);
        $('#record'+id+' i').toggleClass('fa-play-circle fa-pause-circle');
    }
</script>
<script type="text/javascript">
    $('.linkcall').click(function () {

        $('#calldetailsmodel').modal('show');
        var call_id = $(this).data("call_id");
        var id = $(this).data("id");
        $("#call_id").val(call_id);
        $("#enquirycallid").val(id);
    });
</script>
</body>
</html>

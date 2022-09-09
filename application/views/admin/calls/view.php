<?php init_head(); ?>


<link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/css/select2.min.css" rel="stylesheet" />


<style type="text/css">
    .popover{
        max-width:600px;
    }
    .nav-pills > li.active > a, .nav-pills > li.active > a:focus, .nav-pills > li.active > a:hover {
        background-color: #fff;
        color: #03a9f4;
    }
    a {
        color: #2f3334;
        text-decoration: none;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            
                <div class="col-md-12">
                    <div class="panel_s">
                        <div class="panel-body">
                            <div class="row">
                                <div class="col-md-12"><h4 class="no-margin"><?php echo $title; ?> </h4></div>
                            </div>	                   
                            <hr class="hr-panel-heading">
                            <div class="row">
                                <div class="col-md-12">
                                    <ul class="nav nav-pills" role="tablist">
                                        <?php
                                            if (isset($source_list) && !empty($source_list)){
                                                foreach ($source_list as $key => $val) {
                                                    $active_cls = (!isset($section) && $key == 0) ? "active" : "";
                                        ?>
                                                    <li role="presentation" style="font-size:18px;margin-bottom:2px;border-top: 1px solid;border-bottom: 1px solid;" class="text-center <?php echo $active_cls; ?> <?php echo (!empty($section) && $section == $val->source_id) ? 'active' : ''; ?>">
                                                        <a href="#tab<?php echo $val->source_id; ?>" aria-controls="<?php echo $val->source; ?>" role="tab" data-toggle="tab" aria-expanded="true"><?php echo value_by_id("tblleadssources", $val->source_id, "name"); ?>&nbsp;<span style="background-color:#f44336;" class="badge badge-danger <?php echo 'bell'.$val->source_id; ?>"></span></a>
                                                    </li>
                                        <?php
                                                }
                                            }
                                            
                                        ?>
                                        <li role="presentation" style="font-size:18px;margin-bottom:2px;border-top: 1px solid;border-bottom: 1px solid;" class="text-center <?php echo (!empty($section) && $section == "applead") ? 'active' : ''; ?>">
                                            <a href="#tabapplead" aria-controls="app-lead" role="tab" data-toggle="tab" aria-expanded="true">App Lead&nbsp;<span style="background-color:#f44336;" class="badge badge-danger applead_bell"></span></a>
                                        </li>
                                        <li role="presentation" style="font-size:18px;margin-bottom:2px;border-top: 1px solid;border-bottom: 1px solid;" class="text-center <?php echo (!empty($section) && $section == "indiamartlead") ? 'active' : ''; ?>">
                                            <a href="#tabindiamartlead" aria-controls="app-lead" role="tab" data-toggle="tab" aria-expanded="true">India Mart Buy Lead&nbsp;<span style="background-color:#f44336;color:#fff;" class="badge badge-danger indiamartlead_bell"></span></a>
                                        </li>          
                                    </ul>
                                    <hr>
                                </div>
                                <div class="tab-content">
                                    <?php
                                        if (isset($source_list) && !empty($source_list)){
                                            foreach ($source_list as $key => $val) {
                                                $active_cls = (!isset($section) && $key == 0) ? "active" : "";

                                                $where = " id > 0 and vagent_number = ".$val->exotel_number." ";
                                                if(!empty($_POST) && isset($section) && $section == $val->source_id ){
                                                    
                                                    if(!empty($_POST["f_date"]) && !empty($_POST["t_date"])){
                                                        $where .= " and date  BETWEEN  '".db_date($_POST["f_date"])."' and  '".db_date($_POST["t_date"])."' ";
                                                    }else{
                                                        $where .= " and date = '".date('Y-m-d')."' ";
                                                    }

                                                    if (!empty($_POST["type"])){
                                                        if (in_array($_POST["type"], [1, 2])){
                                                            $enquirydata = $this->db->query("SELECT GROUP_CONCAT(call_id) as call_ids FROM tblenquirycall WHERE call_type = 1 AND lead_type = ".$_POST["type"]." AND status = 1 ")->row();
                                                            $where .= " and FIND_IN_SET(id, '".$enquirydata->call_ids."')";
                                                        }
                                                    }
                                                    
                                                    if (!empty($_POST["agent"])){
                                                        $where .= " and agent_number = ".$_POST["agent"]." ";
                                                    }
                                                }else{
                                                    $where .= " and date = '".date('Y-m-d')."'";
                                                }
                                    ?>
                                                <div role="tabpanel" class="tab-pane <?php echo $active_cls; ?> <?php echo (!empty($section) && $section == $val->source_id) ? 'active' : ''; ?>" id="tab<?php echo $val->source_id; ?>">
                                                    <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('calls'); ?>">
                                                        <div class="form-group col-md-2" app-field-wrapper="date">
                                                            <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                                            <div class="input-group date">
                                                                <input id="f_date" name="f_date" class="form-control datepicker" value="<?php echo (isset($_POST["f_date"]) && $_POST["f_date"] != "" && !empty($section) && $section == $val->source_id) ? $_POST["f_date"] : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2" app-field-wrapper="date">
                                                            <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                                            <div class="input-group date">
                                                                <input id="t_date" name="t_date" class="form-control datepicker" value="<?php echo (isset($_POST["t_date"]) && $_POST["t_date"] != "" && !empty($section) && $section == $val->source_id) ? $_POST["t_date"] : ''; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                            </div>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="branch_id" class="control-label">Type</label>
                                                            <select class="form-control selectpicker" id="type" name="type" data-live-search="true">
                                                                <option value="" >--Select One-</option>
                                                                <option value="1" <?php echo (!empty($_POST['type']) && $_POST['type'] == 1 && !empty($section) && $section == $val->source_id) ? 'selected' : ""; ?>>Verified</option>
                                                                <option value="2" <?php echo (!empty($_POST['type']) && $_POST['type'] == 2 && !empty($section) && $section == $val->source_id) ? 'selected' : ""; ?>>Un-Verified</option>
                                                                <option value="3" <?php echo (!empty($_POST['type']) && $_POST['type'] == 3 && !empty($section) && $section == $val->source_id) ? 'selected' : ""; ?>>Untouched</option>
                                                            </select>
                                                        </div>
                                                        <div class="form-group col-md-2">
                                                            <label for="employee_id" class="control-label">Agent</label>
                                                            <select class="form-control selectpicker employee_id" data-live-search="true" id="agent" name="agent">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($agent_list) && count($agent_list) > 0) {
                                                                    foreach ($agent_list as $adata) {
                                                                        ?>
                                                                        <option value="<?php echo $adata->phonenumber; ?>" <?php echo (!empty($_POST["agent"]) && $_POST["agent"] == $adata->phonenumber && !empty($section) && $section == $val->source_id) ? "selected": ""; ?>><?php echo $adata->firstname ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="col-md-2">    
                                                            <input type="hidden" name="section" value="<?php echo $val->source_id; ?>">
                                                            <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                                            <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                                        </div>
                                                    </form>    
                                                    <div class="col-md-12 table-responsive">																
                                                        <table class="table newtable">
                                                            <thead>
                                                                <tr>
                                                                    <th>S.No</th>
                                                                    <th>Customer Number</th>
                                                                    <th>Date</th>
                                                                    <th>Agent Name.</th>
                                                                    <th class="text-center">Call Type</th>
                                                                    <th class="text-center">Recording</th>
                                                                    <th class="text-center">Type</th>
                                                                    <th class="text-center">Action</th>
                                                                </tr>
                                                            </thead>
                                                            <tbody>
                                                                <?php
                                                                    $call_count = 0;
                                                                    $incoming_list = $this->db->query("SELECT * FROM tblcallincoming WHERE ".$where." ORDER BY id DESC")->result();
                                                                    if (!empty($incoming_list)) {
                                                                        foreach ($incoming_list as $k => $row) {
                                                                            $agent_info = $this->db->query("SELECT * from tblstaff where  `phonenumber` = '" . ltrim($row->agent_number, "0") . "' ")->row();
                                                                            $agent_name = (!empty($agent_info)) ? $agent_info->firstname : $row->agent_number;

                                                                            $show = 1;
                                                                            $chk_call = $this->db->query("SELECT `id`,`lead_type` FROM `tblenquirycall` WHERE `call_type` = '1' and call_id = '" . $row->id . "' and status = 1")->row();
                                                                            if (!empty($_POST["type"]) && $_POST["type"] == 3 && !empty($chk_call)){
                                                                                $show = 2;
                                                                            }

                                                                            if ($show == 1){
                                                                                if (empty($chk_call)){
                                                                                    ++$call_count;
                                                                                }
                                                                ?>
                                                                                <tr>
                                                                                    <td><?php echo ++$k; ?></td>
                                                                                    <td><?php echo $row->customer_number; ?></td>
                                                                                    <td><?php echo _d($row->created_at); ?></td>
                                                                                    <td><?php echo $agent_name; ?></td>
                                                                                    <td class="text-center"><img height="35" width="35" src="<?php echo (!empty($row->recording_url)) ? base_url('assets/images/calltransfer.png') : base_url('assets/images/misscall.png'); ?>"> 
                                                                                        <?php
                                                                                            if (empty($row->recording_url)) {
                                                                                                echo '<a class="make_call" val="' . $row->customer_number . '" data-toggle="modal" data-target="#myModal" href="#">Call Back</a>';
                                                                                            }
                                                                                        ?>                                           
                                                                                    </td>
                                                                                    <td class="text-center">
                                                                                        <a href="#" data-toggle="popover" class="recording_play" id="record<?php echo $k; ?>" data-placement="top" data-container="body" data-html="true" onclick="recording(this, '<?php echo $k; ?>', '<?php echo $row->recording_url; ?>');" style="font-size: 40px;" data-content=""><i class="fa fa-play-circle"></i></a>
                                                                                    </td>
                                                                                    <td class="text-center"><?php 
                                                                                        $type = "<span class='btn-sm btn-warning'>Untouched</span>";
                                                                                        if (!empty($chk_call)){
                                                                                            $type = ($chk_call->lead_type == 1) ? "<span class='btn-sm btn-success'>Verified</span>" : "<span class='btn-sm btn-danger'>Un-Verified</span>";
                                                                                        }
                                                                                        echo $type;
                                                                                    ?></td>
                                                                                    <td class="text-center">
                                                                                        <div class="btn-group">
                                                                                            <?php
                                                                                            if (!empty($chk_call)) {
                                                                                                ?>
                                                                                                <a href="<?php echo admin_url('enquirycall/view/' . $chk_call->id); ?>" class="btn-sm btn-primary" target="_blank" title="View Enquiry Details"><i class="fa fa-eye"></i></a>
                                                                                                <?php
                                                                                            } else {
                                                                                                ?>
                                                                                                <a href="<?php echo admin_url('enquirycall/add/' . $row->id . '/1'); ?>" class="btn-sm btn-primary" target="_blank" title="Add Enquiry Details"><i class="fa fa-plus"></i></a>
                                                                                            <?php } ?>    
                                                                                        </div>
                                                                                    </td>
                                                                                </tr>
                                                                <?php                
                                                                            }
                                                                        }
                                                                    }
                                                                    
                                                                ?>
                                                            </tbody>
                                                        </table>
                                                        <input type="hidden" class="callhistorybell" data-type="<?php echo $val->source_id; ?>" value="<?php echo $call_count; ?>">
                                                    </div>
                                                </div>
                                    <?php
                                            }
                                        }
                                    ?>
                                    <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == "applead") ? 'active' : ''; ?>" id="tabapplead">
                                        <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('calls'); ?>">
                                            <div class="form-group col-md-3">
                                                <label for="status" class="control-label">Lead Status</label>
                                                <select class="form-control selectpicker" data-live-search="true" name="status">
                                                    <option value="">--Select All--</option>
                                                    <option value="99" <?php echo (!empty($s_status) && $s_status == 99) ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="1" <?php echo (!empty($s_status) && $s_status == 1) ? 'selected' : ''; ?>>Converted</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-3" app-field-wrapper="date">
                                                <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                                <div class="input-group date">
                                                    <input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3" app-field-wrapper="date">
                                                <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                                <div class="input-group date">
                                                    <input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : date('d/m/Y') ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">                            
                                                <input type="hidden" name="section" value="applead">
                                                <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                                <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </form>    
                                        <div class="col-md-12 table-responsive">																
                                            <table class="table newtable">
                                                <thead>
                                                    <tr>

                                                        <th>S.No.</th>
                                                        <th>Company Name</th>    
                                                        <th>Contact Person Name</th>    
                                                        <th>Number</th>    
                                                        <th>Email</th>
                                                        <th>Created Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>    

                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $call_count = 0;
                                                    if (!empty($task_list)) {
                                                        $z = 1;
                                                        foreach ($task_list as $row) {
                                                            if ($row->status == 0) {
                                                                $status = '<span class="btn btn-warning">Pending</span>';
                                                            } elseif ($row->status == 1) {
                                                                $status = '<span class="btn btn-success">Converted</span>';
                                                            }
                                                            $chk_call = $this->db->query("SELECT `id`,`lead_type` FROM `tblenquirycall` WHERE `call_type` = '3' and call_id = '" . $row->id . "' and status = 1")->row();
                                                            if (empty($chk_call)){
                                                                ++$call_count;
                                                            }
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $z++; ?></td>
                                                                <td><?php echo cc($row->company_name); ?></td>
                                                                <td><?php echo $row->person_name; ?></td>
                                                                <td><?php echo $row->person_number; ?></td>
                                                                <td><?php echo $row->person_email; ?></td>
                                                                <td><?php echo date('d/m/Y', strtotime($row->created_at)); ?></td>
                                                                <td><?php echo $status; ?></td>
                                                                <td>
                                                                    <a class="btn-sm btn-info appleaddetails" href="javascript:void(0);" data-id="<?php echo $row->id; ?>" data-target="#applead-details" id="applead" data-toggle="modal"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                                                    <?php if (!empty($chk_call)) { ?>
                                                                        <a href="<?php echo admin_url('enquirycall/view/' . $chk_call->id); ?>" class="btn-sm btn-primary" target="_blank" title="View Enquiry Details"><i class="fa fa-eye"></i></a>
                                                                    <?php } else { ?>
                                                                        <a href="<?php echo admin_url('enquirycall/add/' . $row->id . '/3'); ?>" class="btn-sm btn-primary" target="_blank" title="Add Enquiry Details"><i class="fa fa-plus"></i></a>
                                                                    <?php } ?>   
                                                                </td>
                                                            </tr>
                                                    <?php        
                                                        }
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <input type="hidden" class="appleadcount" value="<?php echo $call_count; ?>">
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane <?php echo (!empty($section) && $section == "indiamartlead") ? 'active' : ''; ?>" id="tabindiamartlead">
                                        <form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('calls'); ?>">
                                            <div class="form-group col-md-3">
                                                <label for="status" class="control-label">Lead Status</label>
                                                <select class="form-control selectpicker" data-live-search="true" name="status">
                                                    <option value="">--Select All--</option>
                                                    <option value="99" <?php echo (!empty($s_status) && $s_status == 99) ? 'selected' : ''; ?>>Pending</option>
                                                    <option value="1" <?php echo (!empty($s_status) && $s_status == 1) ? 'selected' : ''; ?>>Converted</option>
                                                </select>
                                            </div>

                                            <div class="form-group col-md-3" app-field-wrapper="date">
                                                <label for="f_date" class="control-label"><?php echo 'From Date'; ?></label>
                                                <div class="input-group date">
                                                    <input id="f_date" required name="f_date" class="form-control datepicker" value="<?php echo (isset($s_fdate) && $s_fdate != "") ? $s_fdate : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-3" app-field-wrapper="date">
                                                <label for="t_date" class="control-label"><?php echo 'To Date'; ?></label>
                                                <div class="input-group date">
                                                    <input id="t_date" required name="t_date" class="form-control datepicker" value="<?php echo (isset($s_tdate) && $s_tdate != "") ? $s_tdate : ""; ?>" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                                </div>
                                            </div>
                                            <div class="col-md-2">                            
                                                <input type="hidden" name="section" value="indiamartlead">
                                                <button type="submit" style="margin-top: 24px;" class="btn btn-info">Search</button>
                                                <a style="margin-top: 24px;" class="btn btn-danger" href="">Reset</a>
                                            </div>
                                        </form>    
                                        <div class="col-md-12 table-responsive">																
                                            <table class="table newtable">
                                                <thead>
                                                    <tr>
                                                        <th>S.No.</th>
                                                        <th>Customer Name</th>
                                                        <th>Email</th>
                                                        <th>Mobile</th>
                                                        <th>Address</th>
                                                        <th>City</th>
                                                        <th>State</th>
                                                        <th>Date</th>
                                                        <th>Status</th>
                                                        <th>Action</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $call_count = 0;
                                                    if (!empty($indiamartlead_list)) {
                                                        $z = 1;
                                                        foreach ($indiamartlead_list as $rows) {
                                                            $mobile_number = (!empty($rows->mobile)) ? substr($rows->mobile, -10) : "";
                                                            if ($rows->status == 0) {
                                                                $status = '<span class="btn-sm btn-warning">Pending</span>';
                                                            } elseif ($rows->status == 1) {
                                                                $status = '<span class="btn-sm btn-success">Converted</span>';
                                                            }
                                                            $chk_call = $this->db->query("SELECT `id`,`lead_type` FROM `tblenquirycall` WHERE `call_type` = '4' and call_id = '" . $rows->id . "' and status = 1")->row();
                                                            if (empty($chk_call)){
                                                                ++$call_count;
                                                            }
                                                    ?>
                                                            <tr>
                                                                <td><?php echo $z++; ?></td>
                                                                <td><?php echo $rows->customer_name; ?></td>
                                                                <td><?php echo (!empty($rows->email)) ? $rows->email : '--'; ?></td>
                                                                <td><?php echo $mobile_number; ?></td>
                                                                <td><?php echo (!empty($rows->address)) ? $rows->address : '--'; ?></td>
                                                                <td><?php echo (!empty($rows->city)) ? $rows->city : '--'; ?></td>
                                                                <td><?php echo (!empty($rows->state)) ? $rows->state : '--'; ?></td>
                                                                <td><?php echo _d($rows->date); ?></td>
                                                                <td><?php echo $status; ?></td>
                                                                <td>
                                                                    <a href="javascript:void(0);" class="label label-info indiamartdetails" data-id="<?php echo $rows->id; ?>" data-toggle="modal" data-target="#call_details"><i class="fa fa-bars" aria-hidden="true"></i></a>
                                                                    <?php
                                                                        if (!empty($chk_call)) {
                                                                            ?>
                                                                            <a href="<?php echo admin_url('enquirycall/view/' . $chk_call->id); ?>" class="btn-sm btn-primary" target="_blank" title="View Enquiry Details"><i class="fa fa-eye"></i></a>
                                                                            <?php
                                                                        } else {
                                                                            ?>
                                                                            <a href="<?php echo admin_url('enquirycall/add/' . $rows->id . '/4'); ?>" class="btn-sm btn-primary" target="_blank" title="Add Enquiry Details"><i class="fa fa-plus"></i></a>
                                                                    <?php } ?>   
                                                                </td>
                                                            </tr>
                                                    <?php        
                                                        }
                                                    } else {
                                                        echo '<tr><td class="text-center" colspan="8"><h5>Record Not Found</h5></td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                            <input type="hidden" class="indiamartleadcount" value="<?php echo $call_count; ?>">
                                        </div>
                                    </div>
                                </div>    
                            </div>
                            <div class="btn-bottom-toolbar text-right">

                            </div>
                            <!-- Tracks used in this music/audio player application are free to use. I downloaded them from Soundcloud and NCS websites. I am not the owner of these tracks. -->
                        </div>
                    </div>
                </div>
        </div>		
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="applead-details" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title action_title">App Lead Details</h4>
            </div>
            <div class="modal-body ">
                <div class="row">
                    <div role="tabpanel" class="tab-pane" id="lead_activity">
                        <div class="panel_s no-shadow">
                            <div class="activity-feed leaddetails">
                                
                            </div>    
                        </div>    
                    </div>    
                </div>
            </div>
            <div class="modal-footer">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
            </div>
        </div>

    </div>
</div>
<div id="call_details" class="modal fade" role="dialog">
    <div class="modal-dialog modal-lg">
        <!-- Modal content-->
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">India mart Details</h4>
            </div>
            <div class="modal-body indiamart_view">
                
            </div>
            <div class="modal-footer">
                
            </div>
        </div>
    </div>
</div>

<?php init_tail(); ?>
<link rel="stylesheet" href="//code.jquery.com/ui/1.8.10/themes/smoothness/jquery-ui.css" type="text/css">
<script type="text/javascript" src="//ajax.aspnetcdn.com/ajax/jquery.ui/1.8.10/jquery-ui.min.js"></script>

<script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.3/js/select2.min.js"></script>
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/> 
<link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/> 
<script src = "https://cdn.datatables.net/1.10.18/js/jquery.dataTables.min.js" defer ></script>

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
            "iDisplayLength": 15
        });
    });
</script>
<script>

    $(document).ready(function () {
        
       $.each($(".callhistorybell"), function(){
           var type = $(this).data("type");
           var count_val = $(this).val();
           if (count_val > 0){
               $(".bell"+type).html(count_val);
           }
        });
        var appleadcount = $(".appleadcount").val();
        if (appleadcount > 0){
               $(".applead_bell").html(appleadcount);
           }
        var indiamartleadcount = $(".indiamartleadcount").val();
        if (indiamartleadcount > 0){
               $(".indiamartlead_bell").html(indiamartleadcount);
           }
           
       
        
        
    });
</script>
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
        // $('.newtable').DataTable();
    });

    $(document).on('click', '.indiamartdetails', function() {
        var rid = $(this).data('id');
        $.get("<?php echo admin_url('calls/getIndiaMartDetails/'); ?>"+rid, function(res){
            if (res != ""){
                $(".indiamart_view").html(res);
            }
        });
    });  
</script>


<script type="text/javascript">
    $(document).on('change', '#branch_id', function () {
        $("#attendance_form").submit();
    });

    $(document).on('change', '#month', function () {
        $("#attendance_form").submit();
    });
</script> 


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {
        if (!$("input[name='staffid[]']").is(":checked")) {
            alert('Please Check Any Checkbox First!');
            return false;
        } else {
            $("#salary_form").submit();
        }



    });
</script> 

<script type="text/javascript">
//    $(".myselect").select2();
</script>

<script type="text/javascript">
    $('.status').click(function () {
        var id = $(this).val();
        $.ajax({
            type: "POST",
            url: "<?php echo base_url('admin/approval/get_status'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {
                    $("#approval_html").html(response);
                }
            }
        })
    });
</script> 


<script type="text/javascript">
    $(document).on('click', '.uplaods', function () {

        var id = $(this).val();
        $('#mr_id').val(id);

        $.ajax({
            type: "POST",
            url: "<?php echo site_url('admin/purchase/get_mr_uploads_data'); ?>",
            data: {'id': id},
            success: function (response) {
                if (response != '') {

                    $('#upload_data').html(response);
                }
            }
        })

    });
    
    $(document).on('click', '.appleaddetails', function(){
        var id = $(this).data("id");
        $.ajax({
            type: "GET",
            url: "<?php echo site_url('admin/App_lead/get_details/'); ?>"+id,
            success: function (response) {
                if (response != '') {
                    $('.leaddetails').html(response);
                }
            }
        })
    });
</script>
<script type="text/javascript">

    function recording(el, id, url) {
        var audio = '<audio controls autoplay><source src="' + url + '" type="audio/ogg"></audio>';
        $(el).attr('data-content', audio);
        $('#record'+id+' i').toggleClass('fa-play-circle fa-pause-circle');
    }
</script>
<!-- Modal -->
<div id="myModal" class="modal fade" role="dialog">
  <div class="modal-dialog modal-sm">

    <!-- Modal content-->
    <div class="modal-content">
      <div class="modal-header">
        <button type="button" class="close" data-dismiss="modal">&times;</button>
        <h4 class="modal-title">Calling Numbers</h4>
      </div>
       <form  action="<?php echo admin_url('leads/make_call'); ?>"  class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
      <div class="modal-body">

        <div class="form-group">
            <label for="exotel_number" class="control-label">Select Calling Number</label>
            <select class="form-control selectpicker" name="exotel_number" required="" data-live-search="true">
              <option value=""></option>
              <?php
              if (isset($calling_numbes) && count($calling_numbes) > 0) {
                foreach ($calling_numbes as $r) {
                  ?>
                  <option value="<?php echo $r->exotel_number; ?>" ><?php echo $r->exotel_number; ?></option>
                  <?php
                }
              }
              ?>
            </select>

            <input type="hidden" name="customer_number" id="customer_number" >
          </div>

      </div>
      <div class="modal-footer">
        <button type="submit" class="btn btn-info" >Make Call</button>
      </div>
    </form>
    </div>

  </div>
</div>


</body>
</html>

<script type="text/javascript">
  $(document).on('click', '.make_call', function() {
  var customer_number = $(this).attr('val');
  $("#customer_number").val(customer_number); 
});  

</script>

</body>
</html>

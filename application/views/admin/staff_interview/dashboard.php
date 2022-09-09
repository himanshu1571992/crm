<?php init_head(); ?>
<style>
.order-card {
    color: #fff;
}

.bg-c-blue {
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}

.bg-c-green {
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}

.bg-c-yellow {
    background: linear-gradient(45deg,#FFB64D,#ffcb80);
}

.bg-c-pink {
    background: linear-gradient(45deg,#FF5370,#ff869a);
}

.order-card i {
    font-size: 26px;
}

/*.order-card:hover{
    padding: 4%;
}*/

.box-widget {
    border: none;
    position: relative;
}
.box {
    position: relative;
    border-radius: 3px;
    background: #ffffff;
    border-top: 3px solid #d2d6de;
    margin-bottom: 20px;
    width: 100%;
    box-shadow: 0 1px 1px rgba(0,0,0,0.1);
}
.box-widget .widget-user-header {
    padding: 20px;
    border-top-right-radius: 3px;
    border-top-left-radius: 3px;
}

.widget-user-username {
    margin-top: 5px;
    margin-bottom: 5px;
    font-size: 25px;
    font-weight: 300;
    color:#fff;
}
.no-padding {
    padding: 0 !important;
}
.box-footer {
    border-top-left-radius: 0;
    border-top-right-radius: 0;
    border-bottom-right-radius: 3px;
    border-bottom-left-radius: 3px;
    border-top: 1px solid #f4f4f4;
    padding: 10px;
    background-color: #fff;
}
.box .nav-stacked>li {
    border-bottom: 1px solid #f4f4f4;
    margin: 0;
}
.nav-stacked>li>a {
    border-radius: 0;
    border-top: 0;
    border-left: 3px solid transparent;
    padding: 2%;
    font-size: 15px;
}
.nav-stacked>li .order-card-blue:hover {
    color: #fff;
    background-color: #0073b7;
    padding: 2%;
}
.nav-stacked>li .order-card-blue:hover .btn-point {
    color: #fff;
    background: linear-gradient(45deg,#4099ff,#73b4ff);
}
.nav-stacked>li .order-card-green:hover .btn-point {
    color: #fff;
    background: linear-gradient(45deg,#2ed8b6,#59e0c5);
}
.nav-stacked>li .order-card-green:hover {
    color: #fff;
    background-color: #00a65a;
    padding: 2%;
}
.bg-yellow {
    background-color: #f39c12 !important;
}
.bg-blue {
    background-color: #0073b7 !important;
}
.bg-aqua {
    background-color: #00c0ef !important;
}
.bg-green {
    background-color: #00a65a !important;
}
.bg-red {
    background-color: #dd4b39 !important;
}
.btn-point{
    margin-top: -4px;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">
            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo $title; ?> 
                        <?php if(check_permission_page(379,'create')){?>
                        <a href="<?php echo admin_url('staff_interview/add_interview_details'); ?>" type="submit" class="btn btn-info pull-right" style="margin-top:-6px;">Add Interview Details</a>
                        <?php } ?>
                        </h4>
                        <hr class="hr-panel-heading">
                        <div class="row">
                            <?php echo form_open($this->uri->uri_string(), array('id' => 'designation', 'class' => 'designation-form')); ?>
                            <div class="col-md-12">
                                <div class="col-md-3">
                                    <div class="form-group" app-field-wrapper="date">
                                        <label for="designation" class="control-label">Designation <span style="color: red;">*</span></label>
                                        <select class="form-control selectpicker" id="designation_id" name="designation_id" required="" data-live-search="true">
                                            <option value=""></option>
                                            <?php
                                            if ($designation_list) {
                                                foreach ($designation_list as $value) {
                                                    $selected = (!empty($designation_id) && $value->id == $designation_id) ? "selected='selected'" : "";
                                                    echo '<option value="' . $value->id . '" ' . $selected . '>' . $value->designation . '</option>';
                                                }
                                            }
                                            ?>
                                        </select>
                                    </div>
                                </div>
                                <div class="col-md-2">
                                    <div class="input-group" style="margin-top: 26px;">
                                        <button type="submit" class="btn btn-info">Search</button>
                                        <a class="btn btn-danger" href="">Reset</a>
                                    </div>
                                </div>
                            </div>
                            <?php echo form_close(); ?>
                        </div>
                        <br>
                        <br>
                        <br>
                        <div class="row">
                            <div class="">
                                <div class="col-md-12">
                                    <?php
                                    if(!empty($interview_info)){
                                        foreach ($interview_info as $key => $value) {

                                             $hbgcls = ($key%2 == 1) ? "bg-green": "bg-blue";
                                             $bbgcls = ($key%2 == 1) ? "bg-c-green": "bg-c-blue";
                                             $btnbgcls = ($key%2 == 1) ? "btn-success": "btn-primary";
                                             $btnhovercls = ($key%2 == 1) ? "order-card-green": "order-card-blue";

                                             $round1 = $this->db->query("SELECT COUNT(id) as ttl_count FROM `tblstaffinterviewdetails` WHERE `designation_id` = ".$value->designation_id." AND `interview_round` = 1 AND `show_list` = 1")->row()->ttl_count;
                                             $round2 = $this->db->query("SELECT COUNT(id) as ttl_count FROM `tblstaffinterviewdetails` WHERE `designation_id` = ".$value->designation_id." AND `interview_round` = 2 AND `show_list` = 1")->row()->ttl_count;
                                             $round3 = $this->db->query("SELECT COUNT(id) as ttl_count FROM `tblstaffinterviewdetails` WHERE `designation_id` = ".$value->designation_id." AND `interview_round` = 3 AND `show_list` = 1")->row()->ttl_count;
                                             $confirmed = $this->db->query("SELECT COUNT(id) as ttl_count FROM `tblstaffinterviewdetails` WHERE `designation_id` = ".$value->designation_id." AND `confirm_status` = 1 AND `staffregistration_id` = 0 ")->row()->ttl_count;
                                             $registered = $this->db->query("SELECT COUNT(id) as ttl_count FROM `tblstaffinterviewdetails` WHERE `designation_id` = ".$value->designation_id." AND `confirm_status` = 1 AND `staffregistration_id` > 0 ")->row()->ttl_count;

                                    ?>
                                    <div class="col-md-3">
                                        <div class="box box-widget widget-user-2" style="margin-bottom: 25px;">
                                            <div class="widget-user-header <?php echo $hbgcls; ?>">
                                                <h3 class="widget-user-username"><?php echo value_by_id("tbldesignation", $value->designation_id, "designation"); ?></h3>
                                            </div>
                                            <div class="box-footer no-padding <?php echo $bbgcls; ?>">
                                                <ul class="nav nav-stacked">
                                                    <li><a href="<?php echo admin_url("staff_interview/candidate_list/".$value->designation_id."/1");?>" class="order-card <?php echo $btnhovercls; ?>">Screening Round <span class="pull-right btn-sm <?php echo $hbgcls; ?> btn-point"><?php echo $round1; ?></span></a></li>
                                                    <li><a href="<?php echo admin_url("staff_interview/candidate_list/".$value->designation_id."/2");?>" class="order-card <?php echo $btnhovercls; ?>">First Round <span class="pull-right btn-sm <?php echo $hbgcls; ?> btn-point"><?php echo $round2; ?></span></a></li>
                                                    <li><a href="<?php echo admin_url("staff_interview/candidate_list/".$value->designation_id."/3");?>" class="order-card <?php echo $btnhovercls; ?>">Final Round <span class="pull-right btn-sm <?php echo $hbgcls; ?> btn-point"><?php echo $round3; ?></span></a></li>
                                                    <li><a href="<?php echo admin_url("staff_interview/confirm_employee_list/".$value->designation_id);?>" class="order-card <?php echo $btnhovercls; ?>">Completed <span class="pull-right btn-sm <?php echo $hbgcls; ?> btn-point"><?php echo $confirmed; ?></span></a></li>
                                                    <li><a href="<?php echo admin_url("staff_interview/registered_employee_list/".$value->designation_id);?>" class="order-card <?php echo $btnhovercls; ?>">Registered Employee <span class="pull-right btn-sm <?php echo $hbgcls; ?> btn-point"><?php echo $registered; ?></span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>
                                    <?php

                                        }
                                    }else{
                                        echo '<h4 style="text-align: center">Record Not Found</h4>';
                                    }
                                    ?>

<!--                                    <div class="col-md-3">
                                        <div class="box box-widget widget-user-2">
                                            <div class="widget-user-header bg-blue">
                                                <h3 class="widget-user-username"><?php echo value_by_id("tbldesignation", $value->designation_id, "designation"); ?></h3>
                                            </div>
                                            <div class="box-footer no-padding bg-c-blue">
                                                <ul class="nav nav-stacked">
                                                    <li><a href="#">Projects <span class="pull-right badge bg-blue">31</span></a></li>
                                                    <li><a href="#">Tasks <span class="pull-right badge bg-aqua">5</span></a></li>
                                                    <li><a href="#">Completed Projects <span class="pull-right badge bg-green">12</span></a></li>
                                                    <li><a href="#">Followers <span class="pull-right badge bg-red">842</span></a></li>
                                                </ul>
                                            </div>
                                        </div>
                                    </div>-->
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
            <div class="btn-bottom-pusher"></div>
        </div>
    </div>

    <?php init_tail(); ?>

<!--    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.css"/>
    <link rel="stylesheet" type="text/css" href="https://cdn.datatables.net/buttons/1.6.1/css/buttons.dataTables.min.css"/>
    <script type="text/javascript" src="https://cdn.datatables.net/v/dt/dt-1.10.20/datatables.min.js"></script>

    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/dataTables.buttons.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.flash.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/jszip/3.1.3/jszip.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/pdfmake.min.js"></script>
    <script type="text/javascript" src="https://cdnjs.cloudflare.com/ajax/libs/pdfmake/0.1.53/vfs_fonts.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.html5.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.print.min.js"></script>
    <script type="text/javascript" src="https://cdn.datatables.net/buttons/1.6.1/js/buttons.colVis.min.js"></script>-->


</body>
</html>

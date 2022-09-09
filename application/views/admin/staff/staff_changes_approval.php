<?php init_head(); ?>
<style>.error{border:1px solid red !important;}#adminnote{margin: 0px 8.5px 0px 0px;width: 499px;height: 125px;}.red{border:1px solid red !important;background-color:red !important;color:#fff !important;}.yellow{border:1px solid yellow !important;background-color:yellow !important;color:black  !important;}.blue{border:1px solid blue !important;background-color:blue !important;color:#fff !important;}.green{border:1px solid green !important;background-color:green !important;color:#fff !important;}.orange{border:1px solid orange !important;background-color:orange !important;color:#fff !important;}</style>
<input id="check_gst" type='hidden' value="0">
<!-- Modal Contact -->
<style>
.card {
  box-shadow: 0 4px 8px 0 rgba(0,0,0,0.2);
  transition: 0.3s;
  padding: 25px;
  /*width: 20%;*/
  /*border-radius: 50%;*/
}

.card:hover {
  box-shadow: 0 8px 16px 0 rgba(0,0,0,0.2);
}
/*
.container {
  padding: 2px 16px;
}*/
.profile-img{
    height:300px;
    width: 300px;
}
.badge-danger{
    background-color: red;
    color: #fff;
}
</style>
<div id="wrapper">
    <div class="content accounting-template">
        <a data-toggle="modal" id="modal" data-target="#myModal"></a>
        <div class="row">

            <?php echo form_open($this->uri->uri_string(), array('id' => 'staff-info-approval-form', 'class' => 'staff-info-approval-form')); ?>

            <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <h4 class="no-margin"><?php if(!empty($title)){ echo $title;}?></h4>
                    <hr class="hr-panel-heading">


                      <?php 
                        $parsonal_count = $address_count = $login_count = $salary_count = $branch_count = $relieving_count = $authorities_count = $increment_count = 0;  
                    if(!empty($info)){
                         $curr_staff_info = $this->db->query("SELECT * FROM `tblstaff` where staffid ='".$info->staffid."' ")->row();
                         $reporting_branch = $this->db->query("SELECT * FROM `tblcompanybranch` where id ='".$info->reporting_branch_id."' ")->row();
                         $designation_data = $this->db->query("SELECT * FROM `tbldesignation` where id ='".$info->designation_id."' ")->row();
                         $superior_data = $this->db->query("SELECT * FROM `tblstaff` WHERE active = 1 and staffid ='".$info->superior_id."' ")->row();
                         $departmentsdata = $this->db->query("SELECT * FROM `tbldepartmentsmaster` where id ='".$info->department_id."' ")->row();
                         $group_info = $this->db->query('SELECT * FROM tblstaffgroup WHERE status = 1 and id in ('.$info->employee_group.')')->result_array();
                         $companybranchdata = $this->db->query('SELECT * FROM tblcompanybranch WHERE status = 1 and id in ('.$info->branch_id.')')->result_array();
                         $location_info = $this->db->query('SELECT * FROM tbllocationmaster WHERE status = 1 and id in ('.$info->location_id.')')->result_array();
                         $warehouse_info = $this->db->query('SELECT * FROM tblwarehouse WHERE id in ('.$info->warehouse_id.')')->result_array();
                         $bm_branch_data = $this->db->query('SELECT * FROM tblcompanybranch WHERE id in ('.$info->bm_branch_id.')')->result_array();
                         $cbranch_info = $this->db->query('SELECT * FROM tblcompanybranch WHERE id in ('.$info->cashier_branch_id.')')->result_array();
                         $smbranch_info = $this->db->query('SELECT * FROM tblcompanybranch WHERE id in ('.$info->store_manager_branch_id.')')->result_array();
                         $dmbranch_info = $this->db->query('SELECT * FROM tblcompanybranch WHERE id in ('.$info->dispatch_manager_branch_id.')')->result_array();
                        ?>

                        <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active">
                                <a href="#parsonal_details" aria-controls="parsonal_details" role="tab" data-toggle="tab" aria-expanded="true">Employee Details <span class="badge badge-pill badge-danger parsonal_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#address_details" aria-controls="address_details" role="tab" data-toggle="tab" aria-expanded="false">Address Details <span class="badge badge-pill badge-danger address_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#login_details" aria-controls="login_details" role="tab" data-toggle="tab" aria-expanded="false">Login Details <span class="badge badge-pill badge-danger login_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#salary_details" aria-controls="salary_details" role="tab" data-toggle="tab" aria-expanded="false">Salary Details <span class="badge badge-pill badge-danger salary_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#branch_details" aria-controls="branch_details" role="tab" data-toggle="tab" aria-expanded="false">Branch Details <span class="badge badge-pill badge-danger branch_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#relieving_details" aria-controls="relieving_details" role="tab" data-toggle="tab" aria-expanded="false">Relieving Details <span class="badge badge-pill badge-danger relieving_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#authorities" aria-controls="authorities" role="tab" data-toggle="tab" aria-expanded="false">Authorities <span class="badge badge-pill badge-danger authorities_count"></span></a>
                            </li>
                            <li role="presentation" class="">
                                <a href="#salary_increment_details" aria-controls="salary_increment_details" role="tab" data-toggle="tab" aria-expanded="false">Salary Increment Details <span class="badge badge-pill badge-danger increment_count"></span></a>
                            </li>
                        </ul>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="parsonal_details">
                                <div class="row">
                                    <div class="col-md-3">
                                        <p style="height:300px;width: 300px;">
                                        <?php
                                            echo staff_profile_image($info->staffid,array('img-circle','img-thumbnail','isTooltip', 'profile-img'),'thumb');
                                        ?>
                                        </p>
                                    </div>
                                    <div class="col-md-9">
                                        <strong>Information</strong><br>
                                        <div class="table-responsive col-md-6">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <?php $cls = (!empty($curr_staff_info) && $curr_staff_info->employee_id != $info->employee_id) ? "background-color:red;" : ""; 
                                                            if (!empty($curr_staff_info) && $curr_staff_info->employee_id != $info->employee_id){
                                                                $parsonal_count++; 
                                                            }
                                                            
                                                        ?>
                                                        <td><strong>Employee ID</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo $info->employee_id; ?></span></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->firstname != $info->firstname) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->firstname != $info->firstname){
                                                                $parsonal_count++; 
                                                            }    
                                                        ?>
                                                        <td><strong><?php echo _l('staff_namee'); ?></strong></td>
                                                        <td><span class="badge badge-pill" style="font-size:17px; padding:6px; <?php echo $cls; ?>">&nbsp;<?php echo (isset($info->firstname)) ? $info->firstname : ""; ?>&nbsp;</span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php
                                                             $cls = (!empty($curr_staff_info) && $curr_staff_info->gender != $info->gender) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->gender != $info->gender){
                                                                $parsonal_count++; 
                                                            }  
                                                        ?>
                                                        <td><strong>Gender</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->gender== 1) ? "Male" : "Female"; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->email != $info->email) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->email != $info->email){
                                                                $parsonal_count++; 
                                                            }  
                                                         ?>
                                                        <td><strong><?php echo _l('staff_mail_id'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->email)) ? $info->email : "";?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->adhar_no != $info->adhar_no) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->adhar_no != $info->adhar_no){
                                                                $parsonal_count++; 
                                                            }  
                                                         ?>
                                                        <td><strong><?php echo _l('staff_adhaar_card_no'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->adhar_no)) ? $info->adhar_no : "";?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->epf_no != $info->epf_no) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->epf_no != $info->epf_no){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_epf_no'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->epf_no)) ? $info->epf_no : "--";?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->designation_id != $info->designation_id) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->designation_id != $info->designation_id){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_designation'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($designation_data->designation)? cc($designation_data->designation): "--"; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->staff_type_id != $info->staff_type_id) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->staff_type_id != $info->staff_type_id){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_type'); ?></strong></td>
                                                        <td>
                                                            <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                                <?php
                                                                switch ($info->staff_type_id) {
                                                                    case '1':
                                                                        echo "Permanent";
                                                                        break;
                                                                    case '2':
                                                                        echo "Contract";
                                                                        break;
                                                                }
                                                                ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->paid_leave_time != $info->paid_leave_time) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->paid_leave_time != $info->paid_leave_time){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong>Paid Leave After</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                            for($month=1; $month<=12; $month++){
                                                                    echo (!empty($info) && $info->paid_leave_time == $month) ? $month.' Month' : "";
                                                            }
                                                            ?></span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->working_to != $info->working_to) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->working_to != $info->working_to){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_working_to'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                                <?php
                                                                    for($hours=0; $hours<24; $hours++){
                                                                            for($mins=0; $mins<60; $mins+=30){
                                                                                    $value = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
                                                                                    echo (isset($info->working_to) && $info->working_to == $value) ? $value : "";
                                                                            }
                                                                    }

                                                                ?>
                                                            </span>
                                                        </td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->religion_id != $info->religion_id) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->religion_id != $info->religion_id){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong>Religion</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->religion_id > 0)? value_by_id("tblreligion", $info->religion_id,"name"): "--"; ?></span></td>
                                                    </tr>

                                                </tbody>
                                            </table>
                                        </div>
                                        <div class="table-responsive col-md-6">
                                            <table class="table table-user-information">
                                                <tbody>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->attendance_from != $info->attendance_from) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->attendance_from != $info->attendance_from){
                                                                $parsonal_count++; 
                                                            }    
                                                        ?>
                                                        <td><strong>Attendance From</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                if($info->attendance_from == 1){
                                                                    echo 'App';
                                                                }elseif($info->attendance_from == 2){
                                                                    echo 'BioMax';
                                                                }else{
                                                                    echo '--';
                                                                }
                                                            ?>
                                                            </span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->company_facilities != $info->company_facilities) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->company_facilities != $info->company_facilities){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong>Company Facilities</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                if($info->company_facilities == 1){
                                                                    echo 'Given';
                                                                }elseif($info->company_facilities == 2){
                                                                    echo 'Not Given';
                                                                }else{
                                                                    echo '--';
                                                                }
                                                            ?>
                                                            </span>
                                                          </td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->father_husband_name != $info->father_husband_name) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->father_husband_name != $info->father_husband_name){
                                                                $parsonal_count++; 
                                                            }    
                                                        ?>
                                                        <td><strong><?php echo _l('staff_father_name'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->father_husband_name) && $info->father_husband_name != "") ? $info->father_husband_name : "" ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->birth_date != $info->birth_date) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->birth_date != $info->birth_date){
                                                                $parsonal_count++; 
                                                            }   
                                                        ?>
                                                        <td><strong><?php echo _l('staff_birth_date'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo date('d/m/Y',strtotime($info->birth_date)); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->actual_birth_date != $info->actual_birth_date) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->actual_birth_date != $info->actual_birth_date){
                                                                $parsonal_count++; 
                                                            }   
                                                        ?>
                                                        <td><strong>Actual Birth Date</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo date('d/m/Y',strtotime($info->actual_birth_date)); ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->phonenumber != $info->phonenumber) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->phonenumber != $info->phonenumber){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_cont_no'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->phonenumber)) ? $info->phonenumber : "--";?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->alternatenumber != $info->alternatenumber) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->alternatenumber != $info->alternatenumber){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong>Alternate Contact No</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->alternatenumber)) ? $info->alternatenumber : "--";?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->pan_card_no != $info->pan_card_no) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->pan_card_no != $info->pan_card_no){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_pan_no'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo $info->pan_card_no; ?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->epic_no != $info->epic_no) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->epic_no != $info->epic_no){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_esic_no'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->epic_no)) ? $info->epic_no : "--";?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->joining_date != $info->joining_date) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->joining_date != $info->joining_date){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_joining_date'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php if(isset($info->joining_date) && $info->joining_date != "0000-00-00"){ echo date('d/m/Y',strtotime($info->joining_date)); }else{echo date('d/m/Y');}?></span></td>
                                                    </tr>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->contract_from_date != $info->contract_from_date) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->contract_from_date != $info->contract_from_date){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong>Contract From Date</strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php if(isset($info->contract_from_date) && $info->contract_from_date != "0000-00-00"){ echo date('d/m/Y',strtotime($info->contract_from_date)); }else{echo date('d/m/Y');}?></span></td>
                                                    </tr>
                                                    <?php if ($info->staff_type_id == 2){?>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->contract_to_date != $info->contract_to_date) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->contract_to_date != $info->contract_to_date){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong>Contract To Date</strong></td>
                                                        <td>
                                                            <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php if(isset($info->contract_to_date) && $info->contract_to_date != "0000-00-00"){ echo date('d/m/Y',strtotime($info->contract_to_date)); }else{echo date('d/m/Y');}?></span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                                    <tr>
                                                        <?php 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->working_from != $info->working_from) ? "background-color:red;" : "";
                                                            if (!empty($curr_staff_info) && $curr_staff_info->working_from != $info->working_from){
                                                                $parsonal_count++; 
                                                            }
                                                        ?>
                                                        <td><strong><?php echo _l('staff_working_from'); ?></strong></td>
                                                        <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                                for ($hours = 0; $hours < 24; $hours++) {
                                                                    for ($mins = 0; $mins < 60; $mins+=30) {
                                                                        $value = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
                                                                        echo (isset($info->working_from) && $info->working_from == $value) ? $value : "";
                                                                    }
                                                                }
                                                                ?>
                                                            </span></td>
                                                    </tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="address_details">
                                <div class="row">
                                    <div class="col-sm-6">
                                        <div class="card label-info">
                                            <div class="card-body ">
                                                <h4 class="card-title"><?php echo _l('staff_per_address'); ?></h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->permenent_address != $info->permenent_address) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->permenent_address != $info->permenent_address){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>" ><?php echo ($info->permenent_address) ? implode(PHP_EOL, str_split($info->permenent_address, 45)) : "--"; ?></span></p>
                                            </div>
                                            <div class="card-body ">
                                                <h4 class="card-title"><?php echo _l('staff_per_state'); ?></h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->permenent_state != $info->permenent_state) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->permenent_state != $info->permenent_state){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>" ><?php
                                                        $state_data = $this->db->query("SELECT * FROM `tblstates` where id ='" . $info->permenent_state . "' ")->row();
                                                        echo ($state_data) ? cc($state_data->name) : "--";
                                                        ?></span></p>
                                            </div>
                                            <div class="card-body ">
                                                <h4 class="card-title"><?php echo _l('staff_per_city'); ?></h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->permenent_city != $info->permenent_city) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->permenent_city != $info->permenent_city){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>" ><?php
                                                        $cities_info = $this->db->query("SELECT * FROM `tblcities` where id ='" . $info->permenent_city . "' ")->row();
                                                        echo ($cities_info) ? cc($cities_info->name) : "--";
                                                        ?></span></p>
                                            </div>
                                            <div class="card-body ">
                                                <h4 class="card-title">Pincode </h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->permenent_pincode != $info->permenent_pincode) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->permenent_pincode != $info->permenent_pincode){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>" ><?php
                                                        echo ($info->permenent_pincode) ? $info->permenent_pincode : $info->permenent_pincode;
                                                        ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                    <div class="col-sm-6">
                                        <div class="card label-success">
                                            <div class="card-body">
                                                <h4 class="card-title"><?php echo _l('staff_res_address'); ?></h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->residential_address != $info->residential_address) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->residential_address != $info->residential_address){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text">
                                                    <span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>" ><?php echo ($info->residential_address) ? implode(PHP_EOL, str_split($info->residential_address, 10)) : "--"; ?></span></p>

                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"><?php echo _l('staff_res_state'); ?></h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->residential_state != $info->residential_state) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->residential_state != $info->residential_state){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>"><?php
                                                        $state_data1 = $this->db->query("SELECT * FROM `tblstates` where id ='" . $info->residential_state . "' ")->row();
                                                        echo ($state_data1) ? cc($state_data1->name) : "--";
                                                        ?></span></p>
                                            </div>
                                            <div class="card-body">
                                                <h4 class="card-title"><?php echo _l('staff_res_city'); ?></h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->residential_city != $info->residential_city) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->residential_city != $info->residential_city){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>"><?php
                                                        $cities_info1 = $this->db->query("SELECT * FROM `tblcities` where id ='" . $info->residential_city . "' ")->row();
                                                        echo ($cities_info1) ? cc($cities_info1->name) : "--";
                                                        ?></span></p>
                                            </div>
                                            <div class="card-body ">
                                                <h4 class="card-title">Pincode </h4>
                                                <?php 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->residential_pincode != $info->residential_pincode) ? "background-color:#e81313;" : "background-color:#6c7888";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->residential_pincode != $info->residential_pincode){
                                                        $address_count++; 
                                                    }
                                                ?>
                                                <p class="card-text"><span style="font-size:15px; padding:6px; margin-left:50px; border-radius:10px;color: white; <?php echo $cls; ?>" ><?php
                                                        echo ($info->residential_pincode) ? $info->residential_pincode : $info->residential_pincode;
                                                        ?></span></p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="login_details">
                                <div class="row">
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->user_id != $info->user_id) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->user_id != $info->user_id){
                                                            $login_count++; 
                                                        }
                                                    ?>
                                                    <td><strong><?php echo _l('staff_user_id'); ?></strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->user_id)) ? $info->user_id : "--";?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->admin != $info->admin) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->admin != $info->admin){
                                                            $login_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Is Admin</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php echo ($info->admin== 1) ? "Yes" : "No";?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                     <?php

                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->callingnumber != $info->callingnumber) ? "background-color:red;" : "";
                                                    if (!empty($curr_staff_info) && $curr_staff_info->callingnumber != $info->callingnumber){
                                                        $login_count++; 
                                                    }
                                                     ?>
                                                    <td><strong>Assign Calling Numbers</strong></td>
                                                    <td><?php
                                                            if (isset($info) && !empty($info->callingnumber)){
                                                                $cnumber = explode(",", $info->callingnumber);
                                                                foreach ($cnumber as $k => $val) {
                                                            ?>
                                                                <?php echo ($k > 0) ? '<br>' : ""; ?><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo value_by_id_empty("tblvagentnumbers", $val, "exotel_number"); ?></span>
                                                            <?php
                                                                }
                                                            }else{
                                                                echo '<span style="font-size:17px; padding:6px;" class="badge badge-pill">--</span>';
                                                            }
                                                        ?>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="authorities">
                                <div class="row">
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->bm_branch_id != $info->bm_branch_id) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->bm_branch_id != $info->bm_branch_id){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>BM Branch</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                    if ($bm_branch_data){
                                                        foreach ($bm_branch_data as $val1) {
                                                            echo $val1["comp_branch_name"]." <br><br>";
                                                        }
                                                    }else{
                                                        echo "--";
                                                    }?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->cashier_branch_id != $info->cashier_branch_id) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->cashier_branch_id != $info->cashier_branch_id){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Cashier Branch</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                    if ($cbranch_info){
                                                        foreach ($cbranch_info as $val1) {
                                                            echo $val1["comp_branch_name"]." <br><br>";
                                                        }
                                                    }else{
                                                        echo "--";
                                                    }?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->createdirectquote != $info->createdirectquote) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->createdirectquote != $info->createdirectquote){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Create Quote Without Approval</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                echo ($info->createdirectquote > 0) ? "Yes" : "No";
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->createdirectrequirement != $info->createdirectrequirement) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->createdirectrequirement != $info->createdirectrequirement){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Create Requirement Without Approval</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                echo ($info->createdirectrequirement > 0) ? "Yes" : "No";
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->createdirectdesignrequisition != $info->createdirectdesignrequisition) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->createdirectdesignrequisition != $info->createdirectdesignrequisition){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Create Design Requisition Without Approval</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                echo ($info->createdirectdesignrequisition > 0) ? "Yes" : "No";
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->store_manager_branch_id != $info->store_manager_branch_id) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->store_manager_branch_id != $info->store_manager_branch_id){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Store Manager Branch</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                    if ($smbranch_info){
                                                        foreach ($smbranch_info as $val1) {
                                                            echo $val1["comp_branch_name"]." <br><br>";
                                                        }
                                                    }else{
                                                        echo "--";
                                                    }?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->dispatch_manager_branch_id != $info->dispatch_manager_branch_id) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->dispatch_manager_branch_id != $info->dispatch_manager_branch_id){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Dispatch Manager Branch</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                    if ($dmbranch_info){
                                                        foreach ($dmbranch_info as $val1) {
                                                            echo $val1["comp_branch_name"]." <br><br>";
                                                        }
                                                    }else{
                                                        echo "--";
                                                    }?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->createdirectinvoice != $info->createdirectinvoice) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->createdirectinvoice != $info->createdirectinvoice){
                                                            $authorities_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Create PI Without Approval</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                echo ($info->createdirectinvoice > 0) ? "Yes" : "No";
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="salary_details">
                                <div class="row">
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->taxable != $info->taxable) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->taxable != $info->taxable){
                                                            $salary_count++; 
                                                        }
                                                    ?>
                                                    <td><strong>Is Taxable</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                switch ($info->taxable) {
                                                                    case 1:
                                                                        echo "Taxable";
                                                                        break;
                                                                    case 2:
                                                                        echo "Non Taxable";
                                                                        break;
                                                                }
                                                            ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->gross_salary != $info->gross_salary) ? "background-color:red;" : "";
                                                        if (!empty($curr_staff_info) && $curr_staff_info->gross_salary != $info->gross_salary){
                                                            $salary_count++; 
                                                        }
                                                    ?>
                                                    <td><strong><?php echo _l('staff_monthly_salary'); ?></strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php echo (isset($info->gross_salary)) ? $info->gross_salary : "--";?>
                                                        </span>
                                                    </td>
                                                </tr>
                                                <?php if ($info->payment_mode != 3){?>
                                                <tr>
                                                    <?php 
                                                    if (!empty($curr_staff_info) && $curr_staff_info->bank_name != $info->bank_name){
                                                        $salary_count++; 
                                                    }
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->bank_name != $info->bank_name) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Bank Name</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->bank_name) ? $info->bank_name : "--";?></span>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                                <?php if ($info->payment_mode != 3){?>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->account_no != $info->account_no){
                                                            $salary_count++; 
                                                        }
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->account_no != $info->account_no) ? "background-color:red;" : ""; ?>
                                                    <td><strong>A/c Number</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->account_no) ? $info->account_no : "--";?></span>
                                                    </td>
                                                </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->monthly_salary != $info->monthly_salary){
                                                            $salary_count++; 
                                                        }
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->monthly_salary != $info->monthly_salary) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Cost to Company (CTC)</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo $info->monthly_salary; ?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->payment_mode != $info->payment_mode){
                                                            $salary_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->payment_mode != $info->payment_mode) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Salary Payment Mode</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                            switch ($info->payment_mode) {
                                                                case 1:
                                                                    echo "Salary Bank A/c";
                                                                    break;
                                                                case 2:
                                                                    echo "Other Bank A/c";
                                                                    break;
                                                                default:
                                                                    echo "Cash Salary";
                                                                    break;
                                                            }
                                                        ?></span>
                                                    </td>
                                                </tr>
                                                <?php if ($info->payment_mode != 3){?>
                                                    <tr>
                                                        <?php
                                                            if (!empty($curr_staff_info) && $curr_staff_info->ifsc_code != $info->ifsc_code){
                                                                $salary_count++; 
                                                            } 
                                                            $cls = (!empty($curr_staff_info) && $curr_staff_info->ifsc_code != $info->ifsc_code) ? "background-color:red;" : ""; ?>
                                                        <td><strong>IFSC Code</strong></td>
                                                        <td>
                                                            <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->ifsc_code) ? $info->ifsc_code : "--";?></span>
                                                        </td>
                                                    </tr>
                                                <?php } ?>
                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="branch_details">
                                <div class="row">
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php
                                                        if (!empty($curr_staff_info) && $curr_staff_info->branch_id != $info->branch_id){
                                                            $branch_count++; 
                                                        }  
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->branch_id != $info->branch_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong><?php echo _l('staff_branch_name'); ?></strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                    if ($companybranchdata){
                                                        foreach ($companybranchdata as $val1) {
                                                            echo $val1["comp_branch_name"]." <br><br>";
                                                        }
                                                    }else{
                                                        echo "--";
                                                    }
                                                ?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->reporting_branch_id != $info->reporting_branch_id){
                                                            $branch_count++; 
                                                        } 
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->reporting_branch_id != $info->reporting_branch_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Employee Reporting Branch</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo cc($reporting_branch->comp_branch_name); ?></span></td>
                                                </tr>

                                                <tr>
                                                    <?php
                                                        if (!empty($curr_staff_info) && $curr_staff_info->superior_id != $info->superior_id){
                                                            $branch_count++; 
                                                        }  
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->superior_id != $info->superior_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Superior</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($superior_data) ? $superior_data->firstname : "--" ?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->warehouse_id != $info->warehouse_id){
                                                            $branch_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->warehouse_id != $info->warehouse_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Warehouse</strong></td>
                                                    <td>
                                                        <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill">
                                                            <?php
                                                                if (!empty($warehouse_info) && (!empty($info->warehouse_id))) {
                                                                    foreach ($warehouse_info as $row) {
                                                                        echo (!empty($info) && $info->warehouse_id == $row["id"]) ? $row["name"] . " " : "";
                                                                    }
                                                                } else {
                                                                    echo "--";
                                                                }
                                                                ?>
                                                        </span>
                                                    </td>
                                                </tr>
                                            </tbody>
                                        </table>
                                    </div>
                                    <div class="table-responsive col-md-6">
                                        <table class="table table-user-information">
                                            <tbody>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->location_id != $info->location_id){
                                                            $branch_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->location_id != $info->location_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Location</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                            if ($location_info){
                                                                foreach ($location_info as $val2) {
                                                                    echo cc($val2['name'])." ";
                                                                }
                                                            }else{
                                                                echo "--";
                                                            }
                                                        ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->department_id != $info->department_id){
                                                            $branch_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->department_id != $info->department_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Department</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (!empty($departmentsdata)) ? cc($departmentsdata->name):"--"; ?></span></td>
                                                </tr>
                                                <tr>
                                                     <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->employee_group != $info->employee_group){
                                                            $branch_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->employee_group != $info->employee_group) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Group</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php
                                                            if ($group_info){
                                                                foreach ($group_info as $val) {
                                                                    echo $val["name"]." <br><br>";
                                                                }
                                                            }
                                                        ?></span>
                                                    </td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->last_expense_date_limit != $info->last_expense_date_limit){
                                                            $branch_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->last_expense_date_limit != $info->last_expense_date_limit) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Expense Days Limit</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->last_expense_date_limit) && $info->last_expense_date_limit != "") ? $info->last_expense_date_limit : "" ?></span></td>
                                                </tr>
                                                <tr>
                                                    <?php 
                                                        if (!empty($curr_staff_info) && $curr_staff_info->division_id != $info->division_id){
                                                            $branch_count++; 
                                                        }
                                                        $cls = (!empty($curr_staff_info) && $curr_staff_info->division_id != $info->division_id) ? "background-color:red;" : ""; ?>
                                                    <td><strong>Division</strong></td>
                                                    <td><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->division_id > 0)? value_by_id("tbldivisionmaster", $info->division_id,"title"): "--"; ?></span></td>
                                                </tr>

                                            </tbody>
                                        </table>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="relieving_details">
                                <div class="row">
                                    <div class="col-sm-12">
                                        <div class="card label-info">
                                            <div class="card-body">
                                                <h5 class="card-title">Relieving Date</h5>
                                                <?php 
                                                    if (!empty($curr_staff_info) && $curr_staff_info->relieving_date != $info->relieving_date){
                                                        $relieving_count++; 
                                                    }
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->relieving_date != $info->relieving_date) ? "background-color:red;" : ""; ?>
                                                <p class="card-text"><span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo (isset($info->relieving_date) && $info->relieving_date != "0000-00-00") ? date('d/m/Y',strtotime($info->relieving_date)) : "";?></span></p>
                                            </div>
                                            <div class="card-body">
                                                <h5 class="card-title">Relieving Reason</h5>
                                                <?php 
                                                    if (!empty($curr_staff_info) && $curr_staff_info->relieving_reason != $info->relieving_reason){
                                                        $relieving_count++; 
                                                    }
                                                    $cls = (!empty($curr_staff_info) && $curr_staff_info->relieving_reason != $info->relieving_reason) ? "background-color:red;" : "";
                                                ?>
                                                <p class="card-text">
                                                    <span style="font-size:17px; padding:6px; <?php echo $cls; ?>" class="badge badge-pill"><?php echo ($info->relieving_reason) ? $info->relieving_reason : "--";?></span>
                                                </p>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="salary_increment_details">
                                <div class="row">
                                    <div class="col-md-6">
                                        <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                            <thead>
                                                <tr>
                                                    <th style="width:5%">S.No</th>
                                                    <th style="width:25%">Effected Date</th>
                                                    <th style="width:60%">Cost to Company (CTC)</th>
                                                </tr>
                                            </thead>
                                            <tbody>
                                                <?php
                                                $mes = "<tr><td col='3'><td colspan='3' class='text-center'>No Document Found!</td></tr>";
                                                $staff_id = $info->staffid;
                                                $pre_salary_data = $this->db->query("SELECT id,salary_amount, effected_date FROM tblstaffsalarydetails WHERE `staff_id` = '" . $staff_id . "' ORDER BY salary_amount DESC")->result();

                                                $i = 1;
                                                if (!empty($pre_salary_data)) {

                                                    foreach ($pre_salary_data as $val) {
                                                        $mes = "";

                                                        ?>
                                                        <tr>
                                                            <td><?php echo $i++; ?></td>
                                                            <td><?php echo ($val->effected_date != "0000-00-00 00:00:00") ? "<a href='#' class='salary_model' data-id='" . $val->id . "' data-edate='" . date("d/m/Y", strtotime($val->effected_date)) . "' data-toggle='modal' data-target='#salary_details_model'>" . date("d-M-Y", strtotime($val->effected_date)) . "</a>" : ""; ?></td>
                                                            <td><?php echo $val->salary_amount; ?> </td>
                                                        </tr>
                                                        <?php
                                                    }
                                                }
                                                echo $mes;
                                                ?>
                                            </tbody>
                                        </table>
                                    </div>

                                </div>

                            </div>
                        </div>


                    <?php  } ?>

                    <?php
                        if(!empty($info) && ($info->approval_status == 0)){
                           ?>
                           <div class="btn-bottom-toolbar bottom-transaction text-right">
                                 <button type="submit" name="submit" value="2" class="btn btn-danger mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Reject
                                </button>


                               <button type="submit" name="submit" value="1" class="btn btn-info mleft10 proposal-form-submit save-and-send transaction-submit">
                                    Approved
                                </button>
                            </div>
                           <?php
                        }
                        ?>
                </div>
            </div>
        </div>

        <div class="col-md-12">
            <div class="panel_s">
                <div class="panel-body">
                    <div class="row">
                        <div class="col-md-12">
                            <h4 class="no-mtop mrg3">Approve/Reject Remark</h4>
                        </div>
                        <hr/>
                        <div class="col-md-12">
                            <div class="row">
                                <div class="col-md-12 pull-right">
                                    <div class="form-group" app-field-wrapper="remark">
                                        <textarea id="remark" required="" name="remark" class="form-control" rows="6"><?php if(!empty($appvoal_info)){ echo $appvoal_info->remark; } ?></textarea>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
            <?php echo form_close(); ?>
            <?php $this->load->view('admin/invoice_items/item'); ?>
        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<?php init_tail(); ?>

<script>
    var parsonal_count = "<?php echo $parsonal_count; ?>";
    var address_count = "<?php echo $address_count; ?>";
    var login_count = "<?php echo $login_count; ?>";
    var salary_count = "<?php echo $salary_count; ?>";
    var branch_count = "<?php echo $branch_count; ?>";
    var relieving_count = "<?php echo $relieving_count; ?>";
    var authorities_count = "<?php echo $authorities_count; ?>";
    var increment_count = "<?php echo $increment_count; ?>";
    
    if (parsonal_count > 0){
        $(".parsonal_count").html(parsonal_count);
    } 
    
    if (address_count > 0){
        $(".address_count").html(address_count);
    } 
    
    if (login_count > 0){
        $(".login_count").html(login_count);
    } 
    
    if (salary_count > 0){
        $(".salary_count").html(salary_count);
    } 
    
    if (branch_count > 0){
        $(".branch_count").html(branch_count);
    }

    if (relieving_count > 0){
        $(".relieving_count").html(relieving_count);
    } 

    if (authorities_count > 0){
        $(".authorities_count").html(authorities_count);
    }

    if (increment_count > 0){
        $(".increment_count").html(increment_count);
    }
   
</script>    
</body>
</html>

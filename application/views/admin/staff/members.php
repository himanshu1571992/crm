<?php init_head(); ?>
<style>
 .inf-content{
    border:1px solid #DDDDDD;
    -webkit-border-radius:10px;
    -moz-border-radius:10px;
    border-radius:10px;
    box-shadow: 7px 7px 7px rgba(0, 0, 0, 0.3);
}
.profile-img{
    height:300px;
    width: 300px;
}
</style>
<div id="wrapper">
<div class="content">
   <div class="row">
      <?php if(isset($member)){ ?>
      <div class="col-md-12">
         <div class="panel_s">
            <div class="panel-body no-padding-bottom">
               <?php $this->load->view('admin/staff/stats'); ?>
            </div>
         </div>
      </div>
      <div class="member">
         <?php echo form_hidden('isedit'); ?>
         <?php echo form_hidden('memberid',$member['staffid']); ?>
      </div>
      <?php } ?>
      <?php
      if (isset($member)) {

          $warehouse_info = $this->db->query("SELECT * from tblwarehouse where status = 1  ")->result();
          ?>
      <div class="col-md-12">
         <?php /*if(total_rows('tbldepartments',array('email'=>$member['email'])) > 0) { ?>
            <div class="alert alert-danger">
               The staff member email exists also as support department email, according to the docs, the support department email must be unique email in the system, you must change the staff email or the support department email in order all the features to work properly.
            </div>
         <?php }*/ ?>
         <div class="panel_s">
            <div class="panel-body">
               <h4 class="no-margin"><?php echo $member['firstname']; ?>
                  <?php
                  if($member['last_activity'] && $member['staffid'] != get_staff_user_id()){ ?>
                  <small> - <?php echo _l('last_active'); ?>:
                        <span class="text-has-action" data-toggle="tooltip" data-title="<?php echo _dt($member['last_activity']); ?>">
                              <?php echo time_ago($member['last_activity']); ?>
                        </span>
                      <?php
                  $has_permission_delete = has_permission('staff', '', 'delete');
                  if (($has_permission_delete && ($has_permission_delete && !is_admin($member['staffid']))) || is_admin()) {
                      if ($has_permission_delete && $member['staffid'] != get_staff_user_id()) {
                          echo '&nbsp;| <a href="#" onclick="delete_staff_member(' . $member['staffid'] . '); return false;" class="text-danger">' . _l('delete') . '</a>';
                      }
                  }
                  echo ' | <a href="' . admin_url('staff/email_setting/' . $member['staffid']) . '">Email Setting</a>';
                  echo ' | <a href="' . admin_url('requests/staff_loan_details/' . $member['staffid']) . '">Loan Details</a>';
                  ?>
                     </small>
                  <?php } ?>
               </h4>
                <div class="col-md-6">

                </div>
            </div>
         </div>
      </div>
      <?php }
            $base_url = $this->uri->uri_string();
            if (isset($registeredstaff)&& !empty($registeredstaff)){
                $base_url = admin_url("staff/member");
            }
            echo form_open_multipart($base_url,array('class'=>'staff-form','autocomplete'=>'off'));

            if (isset($registeredstaff)&& !empty($registeredstaff)){
                echo '<input type="hidden" id="reg_id" name="reg_id" class="form-control" value="'.$registeredstaff->staffid.'">';
            }
       ?>
        <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <div class="row">
                            <div class="col-md-12">
                                <h4><?php echo _l('add_staff'); ?> </h4>
                                <ul class="nav nav-tabs" role="tablist">
                                    <li role="presentation" class="active" >
                                        <a href="#parsonal_details" class="parsonal_details" aria-controls="parsonal_details" role="tab" data-toggle="tab" aria-expanded="true">Employee Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#address_details" class="address_details" aria-controls="address_details" role="tab" data-toggle="tab" aria-expanded="false">Address Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#login_details" class="login_details" aria-controls="login_details" role="tab" data-toggle="tab" aria-expanded="false">Login Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#salary_details" class="salary_details" aria-controls="salary_details" role="tab" data-toggle="tab" aria-expanded="false">Salary Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#branch_details" class="branch_details" aria-controls="branch_details" role="tab" data-toggle="tab" aria-expanded="false">Branch Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#relieving_details" class="relieving_details" aria-controls="relieving_details" role="tab" data-toggle="tab" aria-expanded="false">Relieving Details</a>
                                    </li>
                                    <li role="presentation">
                                        <a href="#authorities" class="authorities" aria-controls="authorities" role="tab" data-toggle="tab" aria-expanded="false">Authorities</a>
                                    </li>
                                </ul>
                                <div class="tab-content">
                                    <div role="tabpanel" class="tab-pane active" id="parsonal_details">
                                        <div class="row">
                                            <div class="col-md-3">
                                                <p style="height:300px;width: 300px;">
                                                <?php
                                                    if (!empty($member["staffid"])){
                                                        echo staff_profile_image($member["staffid"],array('img-circle','img-thumbnail','isTooltip', 'profile-img'),'thumb');
                                                    }else{
                                                        echo staff_profile_image(0,array('img-circle','img-thumbnail','isTooltip', 'profile-img'),'thumb');
                                                    }

                                                ?>
                                                </p>
                                                <div style="margin-left:25%">
                                                    <div class="file btn btn-lg btn-primary" style="position: relative;overflow: hidden;" >
                                                        <i class="fa fa-upload"></i>
                                                        <input title="upload profile" style="position: absolute;font-size: 50px;opacity: 0;right: 0;top: 0;" type="file" id="photo" name="profile_image"/>
                                                    </div>
                                                    <?php if (!empty($member["staffid"])){ ?>
                                                        <span title="remove profile" class="btn btn-lg btn-danger removeimg" value="<?php echo $member['staffid']; ?>"><i class="fa fa-remove"></i></span>
                                                    <?php } ?>
                                                </div>
                                                <br>
                                                <small class="label label-info preview_image"></small>
                                            </div>
                                            <div class="col-md-9">
                                                <div class="col-md-12">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group">
                                                                <label for="employee_id" class="control-label">Employee ID*</label>
                                                                
                                                                <input type="text" id="employee_id" name="employee_id" required="" <?php  echo (isset($member['employee_id']) && $member['employee_id'] != "") ? '' : 'onchange="checkuniqueemployee_id(this.value);"'; ?> class="form-control employee_info" data-tab="parsonal_details" value="<?php echo (isset($member['employee_id']) && $member['employee_id'] != "") ? $member['employee_id'] : get_next_employeeid(); ?>">
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <?php
                                                                $attendance_from = "";
                                                                if (isset($member['attendance_from']) && $member['attendance_from'] != "") {
                                                                    $attendance_from = $member['attendance_from'];
                                                                }
                                                                ?>
                                                                <label for="attendance_from" class="control-label">Attendance From</label>
                                                                <select class="form-control selectpicker employee_info" data-tab="parsonal_details" id="attendance_from" name="attendance_from"  data-live-search="true">
                                                                    <option value="1" <?php
                                                                    if ($attendance_from == 1) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>App</option>
                                                                    <option value="2" <?php
                                                                    if ($attendance_from == 2) {
                                                                        echo 'selected';
                                                                    }
                                                                    ?>>BioMax</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                        <div class="col-md-3">
                                                            <div class="form-group">
                                                                <?php
                                                                $company_facilities = "";
                                                                if (isset($member['company_facilities']) && $member['company_facilities'] != "") {
                                                                    $company_facilities = $member['company_facilities'];
                                                                }
                                                                ?>
                                                                <label for="company_facilities" class="control-label">Company Facilities</label>
                                                                <select class="form-control selectpicker employee_info" required="" data-tab="parsonal_details" id="company_facilities" name="company_facilities"  data-live-search="true">
                                                                    <option value="1" <?php echo ($company_facilities == 1) ? 'selected' : ''; ?>>Given</option>
                                                                    <option value="2" <?php echo ($company_facilities == 2) ? 'selected' : ''; ?>>Not Given</option>
                                                                </select>
                                                            </div>
                                                        </div>
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="firstname" class="control-label"><?php echo _l('staff_namee'); ?>*</label>
                                                        <?php
                                                        $name = "";
                                                        if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                            $name = $registeredstaff->employee_name;
                                                        } elseif (isset($member['firstname']) && $member['firstname'] != "") {
                                                            $name = $member['firstname'];
                                                        }
                                                        ?>
                                                        <input type="text" id="firstname" name="firstname" required="" class="form-control employee_info" data-tab="parsonal_details" value="<?php echo $name; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                    <div class="form-group">
                                                        <label for="working_to" class="control-label"><?php echo _l('staff_father_name'); ?>*</label>
                                                        <?php
                                                            $father_husband_name = "";
                                                            if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                $staffid = $registeredstaff->staffid;
                                                                $familydata = $this->db->query("SELECT full_name FROM `tblregistrationstafffamily` WHERE `staff_id`=".$staffid." AND `relationship_id`=1")->row();
                                                                if(!empty($familydata)){
                                                                    $father_husband_name = $familydata->full_name;
                                                                }else{
                                                                    $familydata = $this->db->query("SELECT full_name FROM `tblregistrationstafffamily` WHERE `staff_id`=".$staffid." AND `relationship_id`=4")->row();
                                                                    if(!empty($familydata)){
                                                                        $father_husband_name = $familydata->full_name;
                                                                    }
                                                                }
                                                            }else{
                                                                $father_husband_name = (isset($member['father_husband_name']) && $member['father_husband_name'] != "") ? $member['father_husband_name'] : "";
                                                            }
                                                        ?>
                                                        <input type="text" id="father_husband_name" required="" name="father_husband_name" class="form-control employee_info" data-tab="parsonal_details"  value="<?php echo $father_husband_name; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-6">
                                                  <div class="row">
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                              <?php
                                                                  $gender = "";
                                                                  if (isset($registeredstaff) && $registeredstaff != "") {
                                                                      $gender = $registeredstaff->gender;
                                                                  } elseif (isset($member['gender']) && $member['gender'] != "") {
                                                                      $gender = $member['gender'];
                                                                  }
                                                              ?>
                                                              <label for="gender" class="control-label">Gender*</label>
                                                              <select class="form-control selectpicker employee_info" data-tab="parsonal_details"  required="" id="gender" name="gender"  data-live-search="true">
                                                                  <option value="" disabled selected>--Select One--</option>
                                                                  <option value="1" <?php if ($gender == 1) {echo 'selected';} ?>>Male</option>
                                                                  <option value="2" <?php if ($gender == 2) {echo 'selected';} ?>>Female</option>
                                                              </select>
                                                          </div>
                                                      </div>
                                                      <div class="col-md-6">
                                                        <div class="form-group">
                                                              <?php
                                                                  $gender = "";
                                                                  if (isset($registeredstaff) && $registeredstaff != "") {
                                                                      $gender = $registeredstaff->gender;
                                                                  } elseif (isset($member['gender']) && $member['gender'] != "") {
                                                                      $gender = $member['gender'];
                                                                  }
                                                              ?>
                                                              <label for="religion" class="control-label">Religion*</label>
                                                              <select class="form-control selectpicker employee_info" data-tab="parsonal_details"  required="" id="religion_id" name="religion_id"  data-live-search="true">
                                                                  <option value="" disabled selected>--Select One--</option>
                                                                  <?php
                                                                      if (isset($religion_list) && !empty($religion_list)){
                                                                         foreach ($religion_list as $religion) {
                                                                              $selectedcls = "";
                                                                              if (isset($member['religion_id']) && $member['religion_id'] != "") {
                                                                                  $selectedcls = ($member['religion_id'] == $religion->id) ? "selected='selected'": "";
                                                                              }
                                                                              echo "<option value='".$religion->id."' ".$selectedcls." >".cc($religion->name)."</option>";
                                                                         }
                                                                      }
                                                                  ?>
                                                              </select>
                                                          </div>
                                                      </div>
                                                  </div>

                                                </div>

                                                <div class="col-md-6">
                                                    <div class="row">
                                                        <div class="col-md-6">
                                                            <div class="form-group date">
                                                                <?php
                                                                    $birth_date = date('d/m/Y');
                                                                    if (isset($registeredstaff) && $registeredstaff != "0000-00-00") {
                                                                        $birth_date = date('d/m/Y', strtotime($registeredstaff->birth_date));
                                                                    } elseif (isset($member['birth_date']) && $member['birth_date'] != "0000-00-00") {
                                                                        $birth_date = date('d/m/Y', strtotime($member['birth_date']));
                                                                    }
                                                                ?>
                                                                <label for="birth_date" class="control-label"><?php echo _l('staff_birth_date'); ?>*</label>
                                                                <input type="text" id="birth_date" required="" name="birth_date" class="form-control datepicker employee_info" data-tab="parsonal_details"  value="<?php echo $birth_date; ?>">
                                                            </div>          
                                                        </div>
                                                        <div class="col-md-6">
                                                            <div class="form-group date">
                                                                <?php
                                                                    $actual_birth_date = "";
                                                                    if (isset($member['actual_birth_date']) && $member['actual_birth_date'] != "0000-00-00") {
                                                                        $actual_birth_date = date('d/m/Y', strtotime($member['actual_birth_date']));
                                                                    }
                                                                ?>
                                                                <label for="actual_birth_date" class="control-label">Actual Birth Date</label>
                                                                <input type="text" id="actual_birth_date" required="" name="actual_birth_date" class="form-control datepicker employee_info" data-tab="parsonal_details"  value="<?php echo $actual_birth_date; ?>">
                                                            </div>          
                                                        </div>
                                                    </div>
                                                	
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group">
                                                        <?php
                                                        $email_id = "";
                                                        if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                            $email_id = $registeredstaff->email;
                                                        } elseif (isset($member['email']) && $member['email'] != "") {
                                                            $email_id = $member['email'];
                                                        }
                                                        ?>
                                                        <label for="email" class="control-label"><?php echo _l('staff_mail_id'); ?>*</label>
                                                        <input type="email" id="email" name="email" required="" class="form-control employee_info" data-tab="parsonal_details" value="<?php echo $email_id; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-3">
                                                	<div class="form-group">
                                                        <?php
                                                        $phonenumber = "";
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $phonenumber = $registeredstaff->contact_no;
                                                        } elseif (isset($member['phonenumber']) && $member['phonenumber'] != "") {
                                                            $phonenumber = $member['phonenumber'];
                                                        }
                                                        ?>
                                                        <label for="phonenumber" class="control-label"><?php echo _l('staff_cont_no'); ?>*</label>
                                                        <input type="text" id="phonenumber" name="phonenumber"  required=""class="form-control digits employee_info" data-tab="parsonal_details" maxlength="12" minlength="10" value="<?php echo $phonenumber; ?>">
                                                    </div>
                                                </div>
                                                <div class="col-md-3">
                                                	<div class="form-group">
                                                        <?php
                                                        $alternatenumber = "";
                                                        if (isset($member['alternatenumber']) && $member['alternatenumber'] != "") {
                                                            $alternatenumber = $member['alternatenumber'];
                                                        }
                                                        ?>
                                                        <label for="alternatenumber" class="control-label">Alternate Contact No</label>
                                                        <input type="text" id="alternatenumber" name="alternatenumber"  required=""class="form-control digits employee_info" data-tab="parsonal_details" maxlength="12" minlength="10" value="<?php echo $alternatenumber; ?>">
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                	<div class="form-group">
                                                        <?php
                                                        $adhar_no = "";
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $adhar_no = $registeredstaff->adhar_no;
                                                        } elseif (isset($member['adhar_no']) && $member['adhar_no'] != "") {
                                                            $adhar_no = $member['adhar_no'];
                                                        }
                                                        ?>
                                                        <label for="adhar_no" class="control-label"><?php echo _l('staff_adhaar_card_no'); ?>*</label>
                                                        <input type="text" minlength="12" maxlength="12" id="adhar_no" required="" name="adhar_no" class="form-control digits employee_info" data-tab="parsonal_details"  value="<?php echo $adhar_no; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group">
                                                        <?php
                                                        $pan_card_no = "";
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $pan_card_no = $registeredstaff->pan_card_no;
                                                        } elseif (isset($member['pan_card_no']) && $member['pan_card_no'] != "") {
                                                            $pan_card_no = $member['pan_card_no'];
                                                        }
                                                        ?>
                                                        <label for="pan_card_no" class="control-label"><?php echo _l('staff_pan_no'); ?>*</label>
                                                        <input type="text" id="pan_card_no" required="" name="pan_card_no" class="form-control employee_info" data-tab="parsonal_details"  value="<?php echo $pan_card_no; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group">
                                                        <?php
                                                        $epf_no = "";
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $epf_no = $registeredstaff->epf_no;
                                                        } elseif (isset($member['epf_no']) && $member['epf_no'] != "") {
                                                            $epf_no = $member['epf_no'];
                                                        }

                                                        ?>
                                                        <label for="epf_no" class="control-label"><?php echo _l('staff_epf_no'); ?></label>
                                                        <input type="text" id="epf_no" name="epf_no" class="form-control digits employee_info" data-tab="parsonal_details" value="<?php echo $epf_no; ?>">
                                                    </div>
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group">
                                                        <?php
                                                        $epic_no = "";
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $epic_no = $registeredstaff->esic_no;
                                                        } elseif (isset($member['epic_no']) && $member['epic_no'] != "") {
                                                            $epic_no = $member['epic_no'];
                                                        }
                                                        ?>
                                                        <label for="epic_no" class="control-label"><?php echo _l('staff_esic_no'); ?></label>
                                                        <input type="text" id="epic_no" name="epic_no" class="form-control employee_info" data-tab="parsonal_details" value="<?php echo $epic_no; ?>">
                                                    </div>
                                                </div>


                                                <div class="col-md-6">
                                                	<div class="form-group">
	                                                    <label for="designation_id" class="control-label"><?php echo _l('staff_designation'); ?>*</label>
	                                                    <select class="form-control selectpicker employee_info" data-tab="parsonal_details" required="" id="designation_id" name="designation_id"  data-live-search="true">
	                                                            <option value=""></option>
	                                                            <?php
	                                                            if (isset($designation) && count($designation) > 0) {
	                                                                    foreach ($designation as $designation_key => $designation_value)
	                                                                    {
	                                                                        $selectedcls = "";
	                                                                        if (isset($registeredstaff)&& !empty($registeredstaff)){
	                                                                            $selectedcls = (isset($registeredstaff->designation_id) && $registeredstaff->designation_id == $designation_value['id']) ? 'selected' : "";
	                                                                        }else{
	                                                                            $selectedcls = (isset($member['designation_id']) && $member['designation_id'] == $designation_value['id']) ? 'selected' : "";
	                                                                        }
	                                                            ?>
	                                                                            <option value="<?php echo $designation_value['id'] ?>" <?php echo $selectedcls ?>><?php echo cc($designation_value['designation']); ?></option>
	                                                            <?php
	                                                                    }
	                                                            }
	                                                            ?>
	                                                    </select>
	                                                </div>
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group date">
	                                                    <label for="joining_date" class="control-label"><?php echo _l('staff_joining_date'); ?>*</label>
	                                                    <input type="text" id="joining_date" required="" name="joining_date" class="form-control datepicker employee_info" data-tab="parsonal_details" value="<?php if(isset($member['joining_date']) && $member['joining_date'] != "0000-00-00"){ echo date('d/m/Y',strtotime($member['joining_date'])); }else{echo date('d/m/Y');}?>">
	                                                </div>
                                                </div>

                                                <div class="col-md-6">
	                                                <div class="form-group">
	                                                    <label for="staff_type_id" class="control-label"><?php echo _l('staff_type'); ?>*</label>
	                                                    <select class="form-control selectpicker employee_info" data-tab="parsonal_details" required="" id="staff_type_id" name="staff_type_id" data-live-search="true">
	                                                            <option value=""></option>
	                                                            <option value="1" <?php if(isset($member['staff_type_id']) && $member['staff_type_id']=='1') echo"selected=selected";?>>Permanent</option>
	                                                            <option value="2" <?php if(isset($member['staff_type_id']) && $member['staff_type_id']=='2') echo"selected=selected";?>>Contract</option>
	                                                    </select>
	                                                </div>
                                                </div>

                                                <div class="col-md-3">
	                                                <div class="form-group contract" hidden="">
	                                                    <label for="contract_from_date" class="control-label">Contract From Date </label>
	                                                    <input type="text" id="contract_from_date" required="" name="contract_from_date" class="form-control datepicker employee_info" data-tab="parsonal_details" value="<?php if(isset($member['contract_from_date']) && $member['contract_from_date'] != "0000-00-00"){ echo date('d/m/Y',strtotime($member['contract_from_date'])); }else{echo date('d/m/Y');}?>">
	                                                </div>
	                                            </div>
	                                            <div class="col-md-3">
	                                                <div class="form-group contract" hidden="">
	                                                    <label for="contract_to_date" class="control-label">Contract To Date </label>
	                                                    <input type="text" id="contract_to_date" required="" name="contract_to_date" class="form-control datepicker employee_info" data-tab="parsonal_details" value="<?php if(isset($member['contract_to_date']) && $member['contract_to_date'] != "0000-00-00"){ echo date('d/m/Y',strtotime($member['contract_to_date'])); }else{echo date('d/m/Y');}?>">
	                                                </div>
	                                            </div>

	                                            <div class="col-md-6">
                                                	<div class="form-group">
	                                                    <label for="paid_leave_time" class="control-label">Paid Leave After*</label>
	                                                    <select class="form-control selectpicker employee_info" data-tab="parsonal_details" required="" id="paid_leave_time" name="paid_leave_time"  data-live-search="true">
	                                                            <option value="" disabled selected>--Select One--</option>
	                                                            <?php
	                                                            for($month=1; $month<=12; $month++){
                                                                        $paid_leave_time = (!empty($member) && !empty($member['paid_leave_time'])) ? $member['paid_leave_time'] : 6;

	                                                                    ?>
	                                                                    <option value="<?php echo $month ?>" <?php if($paid_leave_time == $month){ echo 'selected';}?>><?php echo $month.' Month' ?></option>
	                                                                    <?php
	                                                            }
	                                                            ?>
	                                                    </select>
	                                                </div>
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group">
	                                                    <label for="working_from" class="control-label"><?php echo _l('staff_working_from'); ?>*</label>
	                                                    <select class="form-control selectpicker employee_info" data-tab="parsonal_details" required="" id="working_from" name="working_from"  data-live-search="true">
	                                                        <option value="" disabled selected>--Select One--</option>
	                                                        <?php
	                                                        for ($hours = 0; $hours < 24; $hours++) {
	                                                            for ($mins = 0; $mins < 60; $mins+=30) {
	                                                                $value = str_pad($hours, 2, '0', STR_PAD_LEFT) . ':' . str_pad($mins, 2, '0', STR_PAD_LEFT);
	                                                                ?>
	                                                                <option value="<?php echo $value ?>" <?php echo (isset($member['working_from']) && $member['working_from'] == $value) ? 'selected' : "" ?>><?php echo $value ?></option>
	                                                                <?php
	                                                            }
	                                                        }
	                                                        ?>
	                                                    </select>
	                                                </div>
                                                </div>

                                                <div class="col-md-6">
                                                	<div class="form-group">
	                                                    <label for="working_to" class="control-label"><?php echo _l('staff_working_to'); ?>*</label>
	                                                    <select class="form-control selectpicker employee_info" data-tab="parsonal_details" required="" id="working_to" name="working_to"  data-live-search="true">
	                                                            <option value="" disabled selected>--Select One--</option>
	                                                            <?php
	                                                            for($hours=0; $hours<24; $hours++){
	                                                                    for($mins=0; $mins<60; $mins+=30){
	                                                                            $value = str_pad($hours,2,'0',STR_PAD_LEFT).':'.str_pad($mins,2,'0',STR_PAD_LEFT);
	                                                                            ?>
	                                                                            <option value="<?php echo $value ?>" <?php echo (isset($member['working_to']) && $member['working_to'] == $value) ? 'selected' : "" ?>><?php echo $value ?></option>
	                                                                            <?php
	                                                                    }
	                                                            }

	                                                            ?>
	                                                    </select>
	                                                </div>
                                                </div>





                                                <div class="col-md-6">
                                                	<?php if (isset($member)){ ?>
                                                    <div class="form-group">
                                                        <label for="Assigned" class="control-label">Assigned for Approval</label>
                                                        <select class="form-control selectpicker employee_info" data-tab="parsonal_details" required="" multiple data-live-search="true" id="assign" name="assignid[]">
                                                        <?php
                                                            if (isset($allStaffdata) && count($allStaffdata) > 0) {
                                                                foreach ($allStaffdata as $Staffgroup_key => $Staffgroup_value) {
                                                                    ?>
                                                                    <optgroup class="<?php echo 'group' . $Staffgroup_value['id'] ?>">
                                                                        <option value="<?php echo 'group' . $Staffgroup_value['id'] ?>"><?php echo $Staffgroup_value['name'] ?></option>
                                                                        <?php
                                                                            foreach ($Staffgroup_value['staffs'] as $singstaff) {
                                                                            ?>
                                                                            <option style="margin-left: 3%;" value="<?php echo 'staff' . $singstaff['staffid'] ?>" <?php
                                                                            if (isset($staffassigndata) && in_array($singstaff['staffid'], $staffassigndata)) {
                                                                                echo'selected';
                                                                            }
                                                                            ?>><?php echo $singstaff['firstname'] ?></option>

                                                                        <?php }
                                                                        ?>
                                                                    </optgroup>
                                                                                <?php
                                                                            }
                                                                        }
                                                                        ?>
                                                        </select>
                                                    </div>
                                                    <?php } ?>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="address_details">
                                        <div class="row">
                                            <div class="col-md-12 text-right">
                                                <input type="checkbox" id="sameas">Same as Permenant Address
                                            </div>
                                            <div class="col-md-12">
                                                <div class="col-md-6">
                                                        <?php
                                                        $permenent_address = "";
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $permenent_address = $registeredstaff->permenent_address;
                                                        } elseif (isset($member['permenent_address']) && $member['permenent_address'] != "") {
                                                            $permenent_address = $member['permenent_address'];
                                                        }
                                                        ?>
                                                        <div class="form-group">
                                                            <label for="permenent_address" class="control-label"><?php echo _l('staff_per_address'); ?>*</label>
                                                            <textarea id="permenent_address" name="permenent_address" required="" class="form-control employee_info" data-tab="address_details"><?php echo $permenent_address; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="permenent_state" class="control-label"><?php echo _l('staff_per_state'); ?>*</label>
                                                            <select class="form-control selectpicker employee_info" data-tab="address_details" required="" id="permenent_state" name="permenent_state" onchange="get_city_by_state(this.value)" data-live-search="true">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($state_data) && count($state_data) > 0) {
                                                                    foreach ($state_data as $state_key => $state_value) {
                                                                        $selectedcls2 = "";
                                                                        if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                            $selectedcls2 = (isset($registeredstaff->permenent_state) && $registeredstaff->permenent_state == $state_value['id']) ? 'selected' : "";
                                                                        } else {
                                                                            $selectedcls2 = (isset($member['permenent_state']) && $member['permenent_state'] == $state_value['id']) ? 'selected' : "";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $state_value['id'] ?>" <?php echo $selectedcls2; ?>><?php echo cc($state_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="permenent_city" class="control-label"><?php echo _l('staff_per_city'); ?>*</label>
                                                            <select class="form-control selectpicker employee_info" data-tab="address_details" required="" id="permenent_city" name="permenent_city" data-live-search="true">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($city_data) && count($city_data) > 0) {
                                                                    foreach ($city_data as $city_key => $city_value) {
                                                                        ?>
                                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($member['permenent_city']) && $member['permenent_city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo $city_value['name'] ?></option>
                                                                        <?php
                                                                    }
                                                                } else if (isset($member['permenent_city']) & $member['permenent_city'] != '') {
                                                                    foreach ($allcity as $city_key => $city_value) {
                                                                        ?>
                                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($member['permenent_city']) && $member['permenent_city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                } elseif (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                    foreach ($allcity as $city_key => $city_value) {
                                                                        ?>
                                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo ($registeredstaff->permenent_city == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="permenent_pincode" class="control-label">Pincode</label>
                                                            <?php
                                                                $permenent_pincode = "";
                                                                if (isset($member['permenent_pincode']) && $member['permenent_pincode'] != '' && $member['residential_pincode'] != 0) {
                                                                    $permenent_pincode = $member['permenent_pincode'];
                                                                }elseif (isset($registeredstaff) && !empty($registeredstaff) && $registeredstaff->residential_pincode != 0) {
                                                                    $permenent_pincode = $registeredstaff->permenent_pincode;
                                                                }
                                                            ?>
                                                            <input type="text" required="" class="form-control employee_info" data-tab="address_details" id="permenent_pincode" name="permenent_pincode" value="<?php echo $permenent_pincode; ?>">
                                                        </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                        <div class="form-group">
                                                            <?php
                                                            $residential_address = "";
                                                            if (isset($registeredstaff) && $registeredstaff != "") {
                                                                $residential_address = $registeredstaff->residential_address;
                                                            } elseif (isset($member['residential_address']) && $member['residential_address'] != "") {
                                                                $residential_address = $member['residential_address'];
                                                            }
                                                            ?>
                                                            <label for="residential_address" class="control-label"><?php echo _l('staff_res_address'); ?>*</label>
                                                            <textarea id="residential_address" name="residential_address" required="" class="form-control employee_info" data-tab="address_details"><?php echo $residential_address; ?></textarea>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="residential_state" class="control-label"><?php echo _l('staff_res_state'); ?>*</label>
                                                            <select class="form-control selectpicker employee_info" data-tab="address_details" required="" id="residential_state" name="residential_state" onchange="get_city_by_statee(this.value)" data-live-search="true">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($state_data) && count($state_data) > 0) {
                                                                    foreach ($state_data as $state_key => $state_value) {

                                                                        $selectedcls3 = "";
                                                                        if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                            $selectedcls3 = (isset($registeredstaff->permenent_state) && $registeredstaff->permenent_state == $state_value['id']) ? 'selected' : "";
                                                                        } else {
                                                                            $selectedcls3 = (isset($member['residential_state']) && $member['residential_state'] == $state_value['id']) ? 'selected' : "";
                                                                        }
                                                                        ?>
                                                                        <option value="<?php echo $state_value['id'] ?>" <?php echo $selectedcls3; ?>><?php echo cc($state_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="residential_city" class="control-label"><?php echo _l('staff_res_city'); ?>*</label>
                                                            <select class="form-control selectpicker employee_info" data-tab="address_details" required="" id="residential_city" name="residential_city"  data-live-search="true">
                                                                <option value=""></option>
                                                                <?php
                                                                if (isset($city_data) && count($city_data) > 0) {
                                                                    foreach ($city_data as $city_key => $city_value) {
                                                                        ?>
                                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($member['residential_city']) && $member['residential_city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                } else if (isset($member['residential_city']) & $member['residential_city'] != '') {
                                                                    foreach ($allcity as $city_key => $city_value) {
                                                                        ?>
                                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo (isset($member['residential_city']) && $member['residential_city'] == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                } elseif (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                    foreach ($allcity as $city_key => $city_value) {
                                                                        ?>
                                                                        <option value="<?php echo $city_value['id'] ?>" <?php echo ($registeredstaff->residential_city == $city_value['id']) ? 'selected' : "" ?>><?php echo cc($city_value['name']); ?></option>
                                                                        <?php
                                                                    }
                                                                }
                                                                ?>
                                                            </select>
                                                        </div>
                                                        <div class="form-group">
                                                            <label for="residential_pincode" class="control-label">Pincode</label>
                                                            <?php
                                                                $residential_pincode = "";
                                                                if (isset($member['residential_pincode']) && $member['residential_pincode'] != '' && $member['residential_pincode'] != 0) {
                                                                    $residential_pincode = $member['residential_pincode'];
                                                                }elseif (isset($registeredstaff) && !empty($registeredstaff) && $registeredstaff->residential_pincode != 0) {
                                                                    $residential_pincode = $registeredstaff->residential_pincode;
                                                                }
                                                            ?>
                                                            <input type="text" required="" class="form-control employee_info" data-tab="address_details" id="residential_pincode" name="residential_pincode" value="<?php echo $residential_pincode; ?>">
                                                        </div>
                                                    </div>
                                            </div>
                                        </div>
                                    </div>

                                    <div role="tabpanel" class="tab-pane" id="login_details">
                                        <div class="row">
                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <?php
                                                    $user_id = "";
                                                    if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                        $user_id = $registeredstaff->email;
                                                    } elseif (isset($member['user_id']) && $member['user_id'] != "") {
                                                        $user_id = $member['user_id'];
                                                    }
                                                    ?>
                                                    <label for="user_id" class="control-label"><?php echo _l('staff_user_id'); ?>*</label>
                                                    <input type="text" id="user_id" required="" name="user_id" class="form-control employee_info" data-tab="login_details"  value="<?php echo $user_id; ?>">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="password" class="control-label"><?php echo _l('company_branch_password'); ?></label>
                                                    <input type="password" id="password" name="password" class="form-control employee_info" data-tab="login_details" value="">
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                            	<div class="form-group">
                                                    <label for="gender" class="control-label">Is Admin*</label>
                                                    <select class="form-control selectpicker employee_info" data-tab="login_details" required="" id="admin" name="admin"  data-live-search="true">
                                                            <option value="" disabled selected>--Select One--</option>
                                                            <option value="1" <?php if(!empty($member) && $member['admin'] == 1){ echo 'selected';}?>>Yes</option>
                                                            <option value="0" <?php if(!empty($member) && $member['admin'] == 0){ echo 'selected';}?>>No</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="assign_calling_number" class="control-label">Assign Calling Number</label>
                                                    <select class="form-control selectpicker employee_info" data-tab="login_details" id="calling_number" multiple="" name="calling_number[]"  data-live-search="true">
                                                        <option value="" disabled>--Select One--</option>
                                                        <?php
                                                        if ($agent_number_list) {
                                                            foreach ($agent_number_list as $numb) {
                                                                $cnumber = explode(",", $member['callingnumber']);
                                                                $selected = (isset($member) && !empty($member['callingnumber']) && in_array($numb->id, $cnumber)) ? 'selected' : "";
                                                                echo '<option value="' . $numb->id . '" ' . $selected . '>' . $numb->exotel_number . '</option>';
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="previous_year" class="control-label">Can Login In Previous Year</label>
                                                    <input type="checkbox" id="previous_year" class="employee_info" data-tab="login_details" name="canBackDateEntry" <?php echo (isset($member) && $member["canBackDateEntry"] == 1) ? "checked" : ""; ?> value="1">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="salary_details">
                                        <div class="row">
                                            <div class="col-md-12">
                                                <a href="javascript:void(0);" class="btn-sm btn-info pull-right ctc_calculate"><i class="fa fa-calculator"> CALCULATE GROSS</i></a>        
                                            </div>
                                        	<div class="form-group col-md-6">
	                                        	<div class="form-group">
	                                                <label for="taxable" class="control-label">Is Taxable*</label>
	                                                <select class="form-control selectpicker employee_info" data-tab="salary_details" required="" id="taxable" name="taxable"  data-live-search="true">
	                                                        <option value="" disabled selected>--Select One--</option>
	                                                        <option value="1" <?php if(!empty($member) && $member['taxable'] == 1){ echo 'selected';}?>>Taxable</option>
	                                                        <option value="2" <?php if(!empty($member) && $member['taxable'] == 2){ echo 'selected';}?>>Non Taxable</option>
	                                                </select>
	                                            </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                            	<div class="form-group">
                                                    <?php
                                                    $monthly_salary = "";
                                                    if (isset($registeredstaff) && $registeredstaff != "") {
                                                        $monthly_salary = $registeredstaff->gross_salary;
                                                    } elseif (isset($member['monthly_salary']) && $member['monthly_salary'] != "") {
                                                        $monthly_salary = $member['monthly_salary'];
                                                    }
                                                    ?>
                                                    <label for="monthly_salary" class="control-label">Cost to Company (CTC)*</label>
                                                    <input type="text" id="monthly_salary" required="" name="monthly_salary" class="form-control employee_info" data-tab="salary_details" value="<?php echo $monthly_salary; ?>" >
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                            	 <div class="form-group">
                                                    <?php
                                                        $gross_salary = "";
                                                        if (isset($registeredstaff)&& $registeredstaff != ""){
                                                            $gross_salary = $registeredstaff->gross_salary;
                                                        }elseif (isset($member['gross_salary']) && $member['gross_salary'] != "") {
                                                            $gross_salary = $member['gross_salary'];
                                                        }

                                                    ?>
                                                        <label for="gross_salary" class="control-label"><?php echo _l('staff_monthly_salary'); ?>*</label>
                                                        <input type="text" id="gross_salary" required="" name="gross_salary" class="form-control employee_info" data-tab="salary_details" value="<?php echo $gross_salary; ?>" >
                                                </div>
                                            </div>


                                            <div class="form-group col-md-6">
                                            	<div class="form-group">
                                                    <label for="payment_mode" class="control-label">Salary Payment Mode*</label>
                                                    <select class="form-control selectpicker employee_info" data-tab="salary_details" required="" id="payment_mode" name="payment_mode"  data-live-search="true">
                                                        <option value="" disabled selected>--Select One--</option>
                                                        <option value="1" <?php if (!empty($member) && $member['payment_mode'] == 1) {echo 'selected';} ?>>Salary Bank A/c</option>
                                                        <option value="2" <?php if (!empty($member) && $member['payment_mode'] == 2) {echo 'selected';} ?>>Other Bank A/c</option>
                                                        <option value="3" <?php if (!empty($member) && $member['payment_mode'] == 3) {echo 'selected';} ?>>Cash Salary</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="col-md-6">
                                                <div class="form-group mode_details" hidden>
                                                    <label for="bank_name" class="control-label">Bank Name</label>
                                                    <?php
                                                    $bank_name = "";
                                                    if (isset($registeredstaff) && $registeredstaff != "") {
                                                        $bank_name = $registeredstaff->bank_name;
                                                    } elseif (isset($member['bank_name']) && $member['bank_name'] != "") {
                                                        $bank_name = $member['bank_name'];
                                                    }
                                                    ?>
                                                    <input type="text" name="bank_name" class="form-control" value="<?php echo $bank_name; ?>">
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                            	<div class="form-group mode_details" hidden>
                                                    <?php
                                                    $account_no = "";
                                                    if (isset($registeredstaff) && $registeredstaff != "") {
                                                        $account_no = $registeredstaff->account_no;
                                                    } elseif (isset($member['account_no']) && $member['account_no'] != "") {
                                                        $account_no = $member['account_no'];
                                                    }
                                                    ?>
                                                    <label for="account_no" class="control-label">A/c Number</label>
                                                    <input type="text" id="account_no" name="account_no" class="form-control employee_info" data-tab="salary_details" value="<?php echo $account_no; ?>" >
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                            	<div class="form-group mode_details" hidden>
                                                    <?php
                                                    $ifsc_code = "";
                                                    if (isset($registeredstaff) && $registeredstaff != "") {
                                                        $ifsc_code = $registeredstaff->ifc_code;
                                                    } elseif (isset($member['ifsc_code']) && $member['ifsc_code'] != "") {
                                                        $ifsc_code = $member['ifsc_code'];
                                                    }
                                                    ?>
                                                    <label for="ifsc_code" class="control-label">IFSC Code</label>
                                                    <input type="text" id="ifsc_code" name="ifsc_code" class="form-control employee_info" data-tab="salary_details" value="<?php echo $ifsc_code; ?>">
                                                </div>
                                            </div>
                                            <div class="col-md-3">
                                                <div class="form-group">
                                                    <label for="staff_document" class="control-label"><?php echo _l('staff_document'); ?></label>
                                                    <input type="file" id="staff_document" multiple="" name="file[]" style="width: 100%;">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="branch_details">
                                        <div class="row">

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="branch_id" class="control-label"><?php echo _l('staff_branch_name'); ?>*</label>
                                                    <select class="form-control selectpicker employee_info" data-tab="branch_details" required="" id="branch_id" name="branch_id[]" multiple  data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($registeredstaff) && $registeredstaff != "") {
                                                            $memb_branch = explode(',', $registeredstaff->branch_id);
                                                        } elseif (isset($member['branch_id']) && $member['branch_id'] != '') {
                                                            $memb_branch = explode(',', $member['branch_id']);
                                                        }
                                                        if (isset($companybranchdata) && count($companybranchdata) > 0) {
                                                            foreach ($companybranchdata as $companybranch_key => $companybranch_value) {
                                                                $selected = "";
                                                                if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                    $selected = (isset($registeredstaff->branch_id) && $registeredstaff->branch_id == $companybranch_value['id']) ? 'selected' : "";
                                                                } else {
                                                                    $selected = (isset($member['branch_id']) && in_array($companybranch_value['id'], $memb_branch)) ? 'selected' : "";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $companybranch_value['id'] ?>"  <?php echo $selected; ?>><?php echo cc($companybranch_value['comp_branch_name']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="location_id" class="control-label">Location </label>
                                                    <select class="form-control selectpicker"  id="location_id" name="location_id" data-tab="branch_details" data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($location_info) && count($location_info) > 0) {
                                                            foreach ($location_info as $location_value) {
                                                                $selectedcls = (isset($member['location_id']) && $member['location_id'] == $location_value['id']) ? 'selected' : "";
                                                                ?>
                                                                <option value="<?php echo $location_value['id'] ?>" <?php echo $selectedcls ?>><?php echo cc($location_value['name']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="reporting_branch_id" class="control-label">Employee Reporting Branch*</label>
                                                    <select class="form-control selectpicker employee_info" data-tab="branch_details" required="" id="reporting_branch_id" name="reporting_branch_id" data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($member['reporting_branch_id']) && $member['reporting_branch_id'] != '') {
                                                            $memb_branch = explode(',', $member['reporting_branch_id']);
                                                        }
                                                        if (isset($companybranchdata) && count($companybranchdata) > 0) {
                                                            foreach ($companybranchdata as $companybranch_key => $companybranch_value) {
                                                                $selected = "";
                                                                if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                    $selected = (isset($registeredstaff->reporting_branch_id) && $registeredstaff->reporting_branch_id == $companybranch_value['id']) ? 'selected' : "";
                                                                } else {
                                                                    $selected = (isset($member['reporting_branch_id']) && in_array($companybranch_value['id'], $memb_branch)) ? 'selected' : "";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $companybranch_value['id'] ?>"  <?php echo $selected; ?>><?php echo cc($companybranch_value['comp_branch_name']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <div class="row">
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                          <label for="department_id" class="control-label">Select Department</label>
                                                          <select class="form-control selectpicker" id="department_id" name="department_id" data-tab="branch_details" data-live-search="true">
                                                              <option value=""></option>
                                                              <?php
                                                              if (isset($departments_info) && count($departments_info) > 0) {
                                                                  foreach ($departments_info as $departments_key => $departments_value) {
                                                                      $selected = "";
                                                                      if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                          $selected = (isset($registeredstaff->department_id) && $registeredstaff->department_id == $departments_value['id']) ? 'selected' : "";
                                                                      } else {
                                                                          $selected = (isset($member['department_id']) && $member['department_id'] == $departments_value['id']) ? 'selected' : "";
                                                                      }
                                                                      ?>
                                                                      <option value="<?php echo $departments_value['id'] ?>" <?php echo $selected; ?>><?php echo cc($departments_value['name']); ?></option>
                                                                      <?php
                                                                  }
                                                              }
                                                              ?>
                                                          </select>
                                                      </div>
                                                    </div>
                                                    <div class="col-md-6">
                                                      <div class="form-group">
                                                            <label for="division" class="control-label">Division*</label>
                                                            <select class="form-control selectpicker" data-tab="branch_details"  required="" id="division_id" name="division_id"  data-live-search="true">
                                                                <option value="" disabled selected>--Select One--</option>
                                                                <?php
                                                                    if (isset($division_list) && !empty($division_list)){
                                                                       foreach ($division_list as $division) {
                                                                            $selectedcls = "";
                                                                            if (isset($member['division_id']) && $member['division_id'] != "") {
                                                                                $selectedcls = ($member['division_id'] == $division->id) ? "selected='selected'": "";
                                                                            }
                                                                            echo "<option value='".$division->id."' ".$selectedcls." >".cc($division->title)."</option>";
                                                                       }
                                                                    }
                                                                ?>
                                                            </select>
                                                        </div>
                                                    </div>
                                                </div>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="superior_id" class="control-label">Select Superior</label>
                                                    <select class="form-control selectpicker" id="superior_id" name="superior_id" data-tab="branch_details" data-live-search="true">
                                                        <option value=""></option>
                                                        <?php
                                                        if (isset($superior_info) && count($superior_info) > 0) {
                                                            foreach ($superior_info as $superior_key => $superior_value) {
                                                                $selectedcls1 = "";
                                                                if (isset($registeredstaff) && !empty($registeredstaff)) {
                                                                    $selectedcls1 = (isset($registeredstaff->superior_id) && $registeredstaff->superior_id == $superior_value['staffid']) ? 'selected' : "";
                                                                } else {
                                                                    $selectedcls1 = (isset($member['superior_id']) && $member['superior_id'] == $superior_value['staffid']) ? 'selected' : "";
                                                                }
                                                                ?>
                                                                <option value="<?php echo $superior_value['staffid'] ?>" <?php echo $selectedcls1; ?>><?php echo cc($superior_value['firstname']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="employee_group" class="control-label">Select Group</label>
                                                    <select class="form-control selectpicker employee_info" data-tab="branch_details" required="" id="employee_group" name="employee_group[]" multiple  data-live-search="true">
                                                        <option value=""></option>

                                                        <?php
                                                        $group_arr = array();
                                                        if (isset($member['employee_group']) && $member['employee_group'] != '') {
                                                            $group_arr = explode(',', $member['employee_group']);
                                                        }
                                                        if (isset($group_info) && count($group_info) > 0) {
                                                            foreach ($group_info as $group_value) {
                                                                ?>
                                                                <option value="<?php echo $group_value['id'] ?>"  <?php echo (isset($member['employee_group']) && in_array($group_value['id'], $group_arr)) ? 'selected' : "" ?>><?php echo cc($group_value['name']); ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="gender" class="control-label">Warehouse </label>
                                                    <select class="form-control selectpicker" id="warehouse_id" name="warehouse_id"  data-live-search="true">
                                                        <option value="" disabled selected>--Select One--</option>
                                                        <?php
                                                        if (!empty($warehouse_info)) {
                                                            foreach ($warehouse_info as $row) {
                                                                ?>
                                                                <option value="<?php echo $row->id; ?>" <?php if (!empty($member) && $member['warehouse_id'] == $row->id) {
                                                            echo 'selected';
                                                        } ?>><?php echo $row->name; ?></option>
                                                                <?php
                                                            }
                                                        }
                                                        ?>
                                                    </select>
                                                </div>

                                            </div>

                                            <div class="form-group col-md-6">
                                                <div class="form-group">
                                                    <label for="last_expense_date_limit" class="control-label">Expense Days Limit*</label>
                                                    <input required="" type="text" id="last_expense_date_limit" name="last_expense_date_limit" class="form-control employee_info" data-tab="branch_details" value="<?php echo (isset($member['last_expense_date_limit']) && $member['last_expense_date_limit'] != "") ? $member['last_expense_date_limit'] : "" ?>">
                                                </div>
                                            </div>

                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="relieving_details">
                                        <div class="row">
                                            <div class="form-group col-md-12">
                                                <label for="relieving_reason" class="control-label">Relieving Reason</label>
                                                <textarea id="relieving_reason" name="relieving_reason" class="form-control"><?php echo (isset($member['relieving_reason']) && $member['relieving_reason'] != "") ? $member['relieving_reason'] : "" ?></textarea>
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="relieving_date" class="control-label">Relieving Date</label>
                                                <input type="text" id="relieving_date" name="relieving_date" class="form-control datepicker" value="<?php if (isset($member['relieving_date']) && $member['relieving_date'] != "0000-00-00") {
                                        echo date('d/m/Y', strtotime($member['relieving_date']));
                                    } ?>">
                                            </div>
                                            <div class="form-group col-md-6">
                                                <label for="staff_relieve_document" class="control-label">Relieving Document</label>
                                                <input type="file" id="staff_relieve_document" multiple="" name="docs[]" style="width: 100%;">
                                            </div>
                                        </div>
                                    </div>
                                    <div role="tabpanel" class="tab-pane" id="authorities">
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">BM Branch</label>
                                                <div class="form-group col-md-4 bmbranch_id" >
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker employee_info" data-tab="authorities" multiple="" id="bm_branch_id" name="bm_branch_id[]"  data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            $bm_branch_arr = array();
                                                            if (isset($member['bm_branch_id']) && $member['bm_branch_id'] != '') {
                                                                $bm_branch_arr = explode(',', $member['bm_branch_id']);
                                                            }
                                                            if (isset($companybranchdata) && count($companybranchdata) > 0) {
                                                                foreach ($companybranchdata as $companybranch_key => $companybranch_value) {

                                                                    $selected = (isset($member['bm_branch_id']) && in_array($companybranch_value['id'], $bm_branch_arr)) ? 'selected' : "";
                                                                    ?>
                                                                    <option value="<?php echo $companybranch_value['id'] ?>"  <?php echo $selected; ?>><?php echo cc($companybranch_value['comp_branch_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Cashier Branch</label>
                                                <div class="form-group col-md-4 cb_div">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker employee_info" data-tab="authorities" multiple="" id="cashier_branch_id" name="cashier_branch_id[]" data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            $cashier_branch_arr = array();
                                                            if (isset($member['cashier_branch_id']) && $member['cashier_branch_id'] != '') {
                                                                $cashier_branch_arr = explode(',', $member['cashier_branch_id']);
                                                            }
                                                            if (isset($companybranchdata) && count($companybranchdata) > 0) {
                                                                foreach ($companybranchdata as $companybranch_key => $companybranch_value) {
                                                                    $selected = (isset($member['cashier_branch_id'])  && in_array($companybranch_value['id'], $cashier_branch_arr)) ? 'selected' : "";
                                                                    ?>
                                                                    <option value="<?php echo $companybranch_value['id'] ?>"  <?php echo $selected; ?>><?php echo cc($companybranch_value['comp_branch_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Store Manager Branch</label>
                                                <div class="form-group col-md-4 sm_div">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker employee_info" data-tab="authorities" multiple="" id="store_manager_branch_id" name="store_manager_branch_id[]"  data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            $store_manager_branch_arr = array();
                                                            if (isset($member['store_manager_branch_id']) && $member['store_manager_branch_id'] != '') {
                                                                $store_manager_branch_arr = explode(',', $member['store_manager_branch_id']);
                                                            }
                                                            if (isset($companybranchdata) && count($companybranchdata) > 0) {
                                                                foreach ($companybranchdata as $companybranch_key => $companybranch_value) {
                                                                    $selected = (isset($member['store_manager_branch_id'])  && in_array($companybranch_value['id'], $store_manager_branch_arr)) ? 'selected' : "";
                                                                    ?>
                                                                    <option value="<?php echo $companybranch_value['id'] ?>"  <?php echo $selected; ?>><?php echo cc($companybranch_value['comp_branch_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-4 col-form-label col-form-label-sm">Dispatch Manager Branch</label>
                                                <div class="form-group col-md-4 dm_div">
                                                    <div class="form-group">
                                                        <select class="form-control selectpicker employee_info" data-tab="authorities" multiple="" id="dispatch_manager_branch_id" name="dispatch_manager_branch_id[]"  data-live-search="true">
                                                            <option value=""></option>
                                                            <?php
                                                            $dispatch_manager_branch_arr = array();
                                                            if (isset($member['dispatch_manager_branch_id']) && $member['dispatch_manager_branch_id'] != '') {
                                                                $dispatch_manager_branch_arr = explode(',', $member['dispatch_manager_branch_id']);
                                                            }
                                                            if (isset($companybranchdata) && count($companybranchdata) > 0) {
                                                                foreach ($companybranchdata as $companybranch_key => $companybranch_value) {
                                                                    $selected = (isset($member['dispatch_manager_branch_id'])  && in_array($companybranch_value['id'], $dispatch_manager_branch_arr)) ? 'selected' : "";
                                                                    ?>
                                                                    <option value="<?php echo $companybranch_value['id'] ?>"  <?php echo $selected; ?>><?php echo cc($companybranch_value['comp_branch_name']); ?></option>
                                                                    <?php
                                                                }
                                                            }
                                                            ?>
                                                        </select>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-md-6">
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Create Quote Without Approval</label>
                                                <div class="form-group col-md-4" >
                                                    <div class="form-group">
                                                        <?php $quotecheked = (isset($member['createdirectquote']) && $member['createdirectquote'] == 1) ? "checked" : ""; ?>
                                                        <input class="form-check-input" type="checkbox" name="createdirectquote" id="quote_approval" <?php echo $quotecheked; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Create PI Without Approval</label>
                                                <div class="form-group col-md-4" >
                                                    <div class="form-group">
                                                        <?php $invoicecheked = (isset($member['createdirectinvoice']) && $member['createdirectinvoice'] == 1) ? "checked" : ""; ?>
                                                        <input class="form-check-input" type="checkbox" name="createdirectinvoice" id="invoice_approval" <?php echo $invoicecheked; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Create Requirement Without Approval</label>
                                                <div class="form-group col-md-4" >
                                                    <div class="form-group">
                                                        <?php $requirementcheked = (isset($member['createdirectrequirement']) && $member['createdirectrequirement'] == 1) ? "checked" : ""; ?>
                                                        <input class="form-check-input" type="checkbox" name="createdirectrequirement" id="requirement_approval" <?php echo $requirementcheked; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                            <div class="form-group row">
                                                <label for="colFormLabelSm" class="col-sm-6 col-form-label col-form-label-sm">Create Design Requisition Without Approval</label>
                                                <div class="form-group col-md-4" >
                                                    <div class="form-group">
                                                        <?php $requisitioncheked = (isset($member['createdirectdesignrequisition']) && $member['createdirectdesignrequisition'] == 1) ? "checked" : ""; ?>
                                                        <input class="form-check-input" type="checkbox" name="createdirectdesignrequisition" id="designrequisition_approval" <?php echo $requisitioncheked; ?>>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
        <div class="btn-bottom-toolbar text-right btn-toolbar-container-out">
            <button type="submit" class="btn btn-info staff-info-smt"><?php echo _l('submit'); ?></button>
        </div>
       <?php echo form_close(); ?>
       <?php if (isset($member)) { ?>
       <div class="col-md-12">
               <div class="panel_s">
                   <div class="panel-body">
                       <ul class="nav nav-tabs" role="tablist">
                            <li role="presentation" class="active" >
                                <a href="#notes" aria-controls="basic_details" role="tab" data-toggle="tab" aria-expanded="true">Notes</a>
                            </li>
                            <li role="presentation">
                                <a href="#joining_document" aria-controls="custom_fields" role="tab" data-toggle="tab" aria-expanded="false">Joining Document</a>
                            </li>
                            <li role="presentation">
                                <a href="#employee_letters" aria-controls="employee_letters" role="tab" data-toggle="tab" aria-expanded="false">Employee Letters</a>
                            </li>
                            <li role="presentation">
                                <a href="#salary_increment_details" aria-controls="salary_details" role="tab" data-toggle="tab" aria-expanded="false">Salary Increment Details</a>
                            </li>
                            <li role="presentation">
                                <a href="#relieving_document" aria-controls="relieving_document" role="tab" data-toggle="tab" aria-expanded="false">Relieving Document</a>
                            </li>
                        </ul>
                        <?php
                            if (isset($member) && $member != "") {
                                    $joingin_document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$member['staffid']."' and rel_type = 'staff_document'")->result_array();
                                    $relive_document_info = $this->db->query("SELECT * FROM tblfiles WHERE rel_id = '".$member['staffid']."' and rel_type = 'relive_document'")->result_array();
                            }
                        ?>
                        <div class="tab-content">
                            <div role="tabpanel" class="tab-pane active" id="notes">
                                <div class="row">
                                    <div class="col-md-12">
                                        <h4 class="no-margin col-md-6">
                                            <?php echo _l('staff_add_edit_notes'); ?>
                                        </h4>
                                        <div class="col-md-6">
                                            <a href="#" class="btn btn-success" style="float: right;" onclick="slideToggle('.usernote'); return false;"><?php echo _l('new_note'); ?></a>
                                        </div>
                                        <!--<hr class="hr-panel-heading" />-->
                                        <div class="clearfix"></div>
                                        <hr class="hr-panel-heading" />
                                        <div class="mbot15 usernote hide inline-block full-width">
                                           <?php echo form_open(admin_url('misc/add_note/'.$member['staffid'] . '/staff')); ?>
                                           <?php echo render_textarea('description','staff_add_edit_note_description','',array('rows'=>5)); ?>
                                           <button class="btn btn-info pull-right mbot15"><?php echo _l('submit'); ?></button>
                                           <?php echo form_close(); ?>
                                        </div>
                                        <div class="clearfix"></div>
                                        <div class="mtop15">
                                           <table class="table dt-table scroll-responsive" data-order-col="2" data-order-type="desc">
                                              <thead>
                                                 <tr>
                                                    <th width="50%"><?php echo _l('staff_notes_table_description_heading'); ?></th>
                                                    <th><?php echo _l('staff_notes_table_addedfrom_heading'); ?></th>
                                                    <th><?php echo _l('staff_notes_table_dateadded_heading'); ?></th>
                                                    <th><?php echo _l('options'); ?></th>
                                                 </tr>
                                              </thead>
                                              <tbody>
                                                 <?php foreach($user_notes as $note){ ?>
                                                 <tr>
                                                    <td width="50%">
                                                       <div data-note-description="<?php echo $note['id']; ?>">
                                                          <?php echo $note['description']; ?>
                                                       </div>
                                                       <div data-note-edit-textarea="<?php echo $note['id']; ?>" class="hide inline-block full-width">
                                                          <textarea name="description" class="form-control" rows="4"><?php echo clear_textarea_breaks($note['description']); ?></textarea>
                                                          <div class="text-right mtop15">
                                                             <button type="button" class="btn btn-default" onclick="toggle_edit_note(<?php echo $note['id']; ?>);return false;"><?php echo _l('cancel'); ?></button>
                                                             <button type="button" class="btn btn-info" onclick="edit_note(<?php echo $note['id']; ?>);"><?php echo _l('update_note'); ?></button>
                                                          </div>
                                                       </div>
                                                    </td>
                                                    <td><?php echo $note['firstname'] . ' ' . $note['lastname']; ?></td>
                                                    <td data-order="<?php echo $note['dateadded']; ?>"><?php echo _dt($note['dateadded']); ?></td>
                                                    <td>
                                                       <?php if($note['addedfrom'] == get_staff_user_id() || has_permission('staff','','delete')){ ?>
                                                       <a href="#" class="btn btn-default btn-icon" onclick="toggle_edit_note(<?php echo $note['id']; ?>);return false;"><i class="fa fa-pencil-square-o"></i></a>
                                                       <a href="<?php echo admin_url('misc/delete_note/'.$note['id']); ?>" class="btn btn-danger btn-icon _delete"><i class="fa fa-remove"></i></a>
                                                       <?php } ?>
                                                    </td>
                                                 </tr>
                                                 <?php } ?>
                                              </tbody>
                                           </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="joining_document">
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">S.No</th>
                                                        <th style="width:95%">Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                <?php
                                                if(!empty($joingin_document_info)){
                                                    foreach ($joingin_document_info as $key => $doc) {
                                                            ?>
                                                            <tr>
                                                                    <td><?php echo ++$key; ?></td>
                                                                    <td><?php echo '<a download href="'.site_url('uploads/staff_profile_images/document/'.$member['staffid'].'/'.$doc['file_name']).'">'.$doc['file_name'].'</a><br>'; ?></td>
                                                                </tr>
                                                            <?php
                                                    }
                                                }else{
                                                    echo '<tr><td colspan="2" class="text-center">No Document Found!</td></tr>';
                                                }
                                                ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="relieving_document">
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">S.No</th>
                                                        <th style="width:95%">Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    if (!empty($relive_document_info)) {
                                                        foreach ($relive_document_info as $key => $doc) {
                                                            ?>
                                                            <tr>
                                                                <td><?php echo ++$key; ?></td>
                                                                <td><?php echo '<a download href="' . site_url('uploads/staff_profile_images/relive_document/' . $member['staffid'] . '/' . $doc['file_name']) . '">' . $doc['file_name'] . '</a><br>'; ?></td>
                                                            </tr>
                                                            <?php
                                                        }
                                                    } else {
                                                        echo '<tr><td colspan="2" class="text-center">No Document Found!</td></tr>';
                                                    }
                                                    ?>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="employee_letters">
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table credite-note-items-table items table-main-credit-note-edit no-mtop saletable">
                                                <thead>
                                                    <tr>
                                                        <th style="width:5%">S.No</th>
                                                        <th style="width:95%">Document</th>
                                                    </tr>
                                                </thead>
                                                <tbody>
                                                    <?php
                                                    $t = 0;
                                                        $staff_id = $member["staffid"];
                                                        $items = $this->db->query("SELECT COUNT(*) as count_item FROM tblstaffitemsdetails WHERE staff_id = '".$staff_id."' AND remark=1 AND receive_status=1 AND status=1")->row();
                                                        if ($items->count_item > 0){
                                                            echo "<tr><td>".++$t."</td>";
                                                            echo "<td><a href='". admin_url("letters_format/download_items_pdf/").$staff_id."' target='_blank'>Alloted Items</a></td></tr>";
                                                        }
                                                    ?>

                                                    <tr><td><?php echo ++$t;?></td><td><a href="<?php echo admin_url('letters_format/download_intent_letter/'.$staff_id);?>" target='_blank'>Intent Letter</a></td></tr>
                                                    <tr><td><?php echo ++$t;?></td><td><a href="<?php echo admin_url('letters_format/download_joining_letter/'.$staff_id);?>" target='_blank'>Joining Letter</a></td></tr>
                                                    <?php
                                                        if ($member["relieving_date"] != "0000-00-00"){
                                                    ?>
                                                    <tr><td><?php echo ++$t;?></td><td><a href="<?php echo admin_url('letters_format/download_exprience_certificate/'.$staff_id);?>" target='_blank'>Experience Letter</a></td></tr>
                                                    <tr><td><?php echo ++$t;?></td><td><a href="<?php echo admin_url('letters_format/download_relieving_letter/'.$staff_id);?>" target='_blank'>Relieving Letter</a></td></tr>
                                                    <?php
                                                        }
                                                    ?>
                                                    <tr><td><?php echo ++$t;?></td><td><a href="<?php echo admin_url('letters_format/download_hr_policy/'.$staff_id);?>" target='_blank'>HR Policy</a></td></tr>
                                                </tbody>
                                            </table>
                                        </div>
                                    </div>
                                </div>
                            </div>
                            <div role="tabpanel" class="tab-pane" id="salary_increment_details">
                                <div class="col-md-12">
                                    <div style="overflow-x:auto !important;">
                                        <div class="form-group" >
                                            <table class="table dt-table scroll-responsive">
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
                                                        if (isset($member['staffid']) && $member['staffid'] != "") {
                                                            $staff_id = $member['staffid'];
                                                            $pre_salary_data = $this->db->query("SELECT id,salary_amount, effected_date FROM tblstaffsalarydetails WHERE `staff_id` = '".$staff_id."' ORDER BY salary_amount DESC")->result();
                                                            $i = 1;
                                                            if (!empty($pre_salary_data)){

                                                                foreach ($pre_salary_data as $val) {
                                                                    $mes = "";
                                                    ?>
                                                                    <tr>
                                                                        <td><?php echo $i++; ?></td>
                                                                        <td><?php echo ($val->effected_date != "0000-00-00 00:00:00") ? "<a href='#' class='salary_model' data-id='".$val->id."' data-edate='".date("d/m/Y", strtotime($val->effected_date))."' data-toggle='modal' data-target='#salary_details_model'>".date("d-M-Y", strtotime($val->effected_date))."</a>" : ""; ?></td>
                                                                        <td><?php echo $val->salary_amount; ?></td>
                                                                    </tr>
                                                    <?php
                                                                }
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
                        </div>
                   </div>
               </div>
           </div>
      <?php }?>
   </div>
   <div class="btn-bottom-pusher"></div>
</div>
    <div id="salary_details_model" class="modal fade" role="dialog">
        <div class="modal-dialog">
            <!-- Modal content-->
            <div class="modal-content">
                <div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Update Effected Salary Date</h4>
                </div>
                <?php
                $attributes = array('id' => 'complain_types_form');
                echo form_open(admin_url("staff/update_staff_salary_date"), $attributes);
                ?>
                <div class="modal-body" id="approval_html">
                    <div class="row">
                        <div class="col-sm-12">
<!--                            <div class="form-group ">
                                <label for="source" class="control-label">Effected Salary Date</label>
                                <input id="effected_date" name="effected_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                <input type="hidden" id="salarydetails_id" class="form-control" value="" name="salarydetails_id">
                            </div>-->
                            <div class="form-group col-md-12" app-field-wrapper="date">
                                <label for="f_date" class="control-label">Effected Salary Date</label>
                                <div class="input-group date">
                                    <input id="effected_date" name="effected_date" class="form-control datepicker" value="" aria-invalid="false" type="text"><div class="input-group-addon"><i class="fa fa-calendar calendar-icon"></i></div>
                                    <input type="hidden" id="salarydetails_id" class="form-control" value="" name="salarydetails_id">
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="submit" class="btn btn-primary">Save</button>
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>
                <?php echo form_close(); ?>
            </div>
        </div>
    </div>
    <div class="modal fade" id="delete_staff" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<?php echo form_open(admin_url('staff/delete',array('delete_staff_form'))); ?>
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title"><?php echo _l('delete_staff'); ?></h4>
			</div>
			<div class="modal-body">
				<div class="delete_id">
					<?php echo form_hidden('id'); ?>
				</div>
				<p><?php echo _l('delete_staff_info'); ?></p>
				<?php
				echo render_select('transfer_data_to',$staff_members,array('staffid',array('firstname','lastname')),'staff_member',get_staff_user_id(),array(),array(),'','',false);
				?>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-danger _delete"><?php echo _l('confirm'); ?></button>
			</div>
		</div><!-- /.modal-content -->
		<?php echo form_close(); ?>
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->

<div class="modal fade" id="ctc_calculate_modal" tabindex="-1" role="dialog">
	<div class="modal-dialog" role="document">
		<div class="modal-content">
			<div class="modal-header">
				<button type="button" class="close" data-dismiss="modal" aria-label="Close"><span aria-hidden="true">&times;</span></button>
				<h4 class="modal-title">Salary Calculation</h4>
			</div>
			<div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
                        <div class="form-group col-md-6" app-field-wrapper="date">
                            <label for="salary" class="control-label">Salary</label>
                            <div class="input-group">
                                <input type="text" id="deduction_salary" required="" name="salary" class="form-control" value=""><div class="input-group-addon"><i class="fa fa-money money-icon"></i></div>
                            </div>
                        </div>
                        <div class="form-group col-md-6">
                            <label for="type" class="control-label">Deduction Type</label>
                            <select class="form-control selectpicker" id="deduction_type" name="type" required="">
                                <option value="" disabled selected >--Select One-</option>
                                <option value="1" >No Deduction No Bonus</option>
                                <option value="2" >No Deduction with Bonus</option>
                                <option value="3" >Deduction No Bonus</option>
                                <option value="4" >Deduction with Bonus</option>
                            </select>
                        </div>                                
                    </div>                                   
                </div>
			</div>
			<div class="modal-footer">
				<button type="button" class="btn btn-default" data-dismiss="modal"><?php echo _l('close'); ?></button>
				<button type="submit" class="btn btn-success ctc_deduction_btn">Calculate</button>
			</div>
		</div><!-- /.modal-content -->
	</div><!-- /.modal-dialog -->
</div><!-- /.modal -->
<?php init_tail(); ?>
<script>
   $(function() {

       
       $('select[name="role"]').on('change', function() {
           var roleid = $(this).val();
           init_roles_permissions(roleid, true);
       });

		$(document).ready(function() {
		   var roleid = $("#role").val();
           init_roles_permissions(roleid, true);
	   });

       $('input[name="administrator"]').on('change', function() {
           var checked = $(this).prop('checked');
           var isNotStaffMember = $('.is-not-staff');
           if (checked == true) {
               isNotStaffMember.addClass('hide');
               $('.roles').find('input').prop('disabled', true).prop('checked', false);
           } else {
               isNotStaffMember.removeClass('hide');
               isNotStaffMember.find('input').prop('checked', false);
               $('.roles').find('input').prop('disabled', false);
           }
       });

       $('#is_not_staff').on('change', function() {
           var checked = $(this).prop('checked');
           var row_permission_leads = $('tr[data-name="leads"]');
           if (checked == true) {
               row_permission_leads.addClass('hide');
               row_permission_leads.find('input').prop('checked', false);
           } else {
               row_permission_leads.removeClass('hide');
           }
       });

       init_roles_permissions();

       _validate_form($('.staff-form'), {
           firstname: 'required',
           lastname: 'required',
           username: 'required',
           password: {
               required: {
                   depends: function(element) {
                       return ($('input[name="isedit"]').length == 0) ? true : false
                   }
               }
           },
       });
   });
init_selectpicker();

    function get_city_by_state(state_id) {
        var html = '<option value=""></option>';

        if(state_id == "") {
            $("#permenent_city").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }

        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);

                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#permenent_city").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }

	function get_city_by_statee(state_id) {
        var html = '<option value=""></option>';

        if(state_id == "") {
            $("#residential_city").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }

        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + state_id,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);

                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#residential_city").html('').html(html);
                $('.selectpicker').selectpicker('refresh');
            }
        });
    }
	$('.removeimg').click(function () {
        if (confirm("Are you sure?"))
        {
            var staff_id = $(this).attr('value');
            var url = admin_url + 'Staff/imagedelete/';
            $.post(url,
                    {
                        staff_id: staff_id,
                    },
                    function (data, status) {

                        $('.proimg').load(url + ' .proimg');
                        $('.proimg').hide();
                    });
        }
    });
	$('.removedocument').click(function () {
        if (confirm("Are you sure?"))
        {
            var staff_id = $(this).attr('value');
            var url = admin_url + 'Staff/docdelete/';
            $.post(url,
                    {
                        staff_id: staff_id,
                    },
                    function (data, status) {

                        $('.prodoc').load(url + ' .prodoc');
                        $('.prodoc').hide();
                    });
        }
    });

	 $('#sameas').change(function() {
		 var permenent_address=$('#permenent_address').val();
		 var permenent_state=$('#permenent_state').val();
		 var permenent_city=$('#permenent_city').val();
		 var permenent_pincode=$('#permenent_pincode').val();

		  var html = '<option value=""></option>';

        if(permenent_state == "") {
            $("#residential_city").html('').html(html);
            $('.selectpicker').selectpicker('refresh');
            return false;
        }

        $.ajax({
            url : admin_url+'site_manager/get_cities_by_state_id/' + permenent_state,
            method : 'GET',
            success(res) {
                if(res != "") {
                    var resArr = $.parseJSON(res);

                    $.each(resArr, function(k, v) {
                        html+= '<option value="'+v.id+'">'+v.name+'</option>';
                    });
                }
                $("#residential_city").html('').html(html);
				$('#residential_city').val(permenent_city);
                $('.selectpicker').selectpicker('refresh');
            }
        });





        if($(this).is(":checked")) {
            $('#residential_address').val(permenent_address);
            $('#residential_state').val(permenent_state);
            $('#residential_city').val(permenent_city);
            $('#residential_pincode').val(permenent_pincode);
			$('.selectpicker').selectpicker('refresh');
        }
        $('#textbox1').val($(this).is(':checked'));
    });

    $(".staff-info-smt").on("click", function(){
        $(".employee_info").each(function(){
            var attr = $(this).attr('required');
            if (typeof attr !== 'undefined' && attr !== false) {
                var fval = $(this).val();
                if (fval == ""){
                    var tab = $(this).data("tab");
                    $("."+tab).click();
                    return;
                }
            }

        })
    });

</script>
<script type="text/javascript">
    $('.salary_model').click(function(){
        var id = $(this).data("id");
        var effected_date = $(this).data("edate");
        $("#effected_date").val(effected_date);
        $("#salarydetails_id").val(id);
    });
</script>
<script>
	$('#photo').change(function () {
       var val = $(this).val();
       $(".preview_image").html(val);
       $("#assign").removeAttr("required");
    });
	$('#payment_mode').change(function () {
       var mode = $(this).val();
	   if(mode != 3){
		   $('.mode_details').show();
	   }else{
		   $('.mode_details').hide();
	   }
    });

	$( document ).ready(function() {
		var mode = $('#payment_mode').val();

		if(mode != ''){
			if(mode != 3){
			   $('.mode_details').show();
		   }else{
			   $('.mode_details').hide();
		   }
		}

	})
</script>

<script>
	$('#staff_type_id').change(function () {
       var staff_type_id = $(this).val();
	   if(staff_type_id == 1){
		   $('.contract').hide();
	   }else{
		   $('.contract').show();
	   }
    });

	$( document ).ready(function() {
		var staff_type_id = $('#staff_type_id').val();

		if(staff_type_id > 0){
			if(staff_type_id == 1){
			   $('.contract').hide();
		   }else{
			   $('.contract').show();
		   }
		}

	})
</script>



<script type="text/javascript">
    $(document).on('change', '#branch_id', function(){
        var branch_id=$(this).val();


    	$.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/staff/get_warehouse'); ?>",
            data    : {'branch_id' : branch_id},
            success : function(response){
                if(response != ''){
                     $("#warehouse_id").html('').html(response);
           			 $('.selectpicker').selectpicker('refresh');
                }
            }
        })

    });
    function delete_staff_member(id){
		$('#delete_staff').modal('show');
		$('#transfer_data_to').find('option').prop('disabled',false);
		$('#transfer_data_to').find('option[value="'+id+'"]').prop('disabled',true);
		$('#delete_staff .delete_id input').val(id);
		$('#transfer_data_to').selectpicker('refresh');
	}

    function checkuniqueemployee_id(employee_id){
        $.ajax({
            type    : "POST",
            url     : "<?php echo site_url('admin/staff/check_employee_id'); ?>",
            data    : {'employee_id' : employee_id},
            success : function(response){
                if(response != ''){
                     $("#employee_id").val('');
                    alert(response);
                }
            }
        })
    }

    $(document).on("click", ".ctc_calculate", function(){
        $("#ctc_calculate_modal").modal("show");
    });
    $(document).on("click", ".ctc_deduction_btn", function(){
        var salary = $("#deduction_salary").val();
        var deduction_type = $("#deduction_type").val();
        
        if (salary != '' && deduction_type != ''){
            $.ajax({
                type    : "POST",
                url     : "<?php echo site_url('admin/salary/get_staff_gross_salary'); ?>",
                data    : {'salary' : salary, 'deduction_type': deduction_type},
                success : function(response){
                    if(response != ''){
                        var resArr = $.parseJSON(response);
                        $("#monthly_salary").val('').val(resArr["final"]);
                        $("#gross_salary").val('').val(resArr["gross"]);
                        $("#ctc_calculate_modal").modal("hide");
                    }
                }
            })
        }else{
            alert("Salary and deduction type both are required.");
        }
    });
</script>
</body>
</html>

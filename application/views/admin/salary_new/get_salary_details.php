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
    fieldset.scheduler-border {
        border: 1px groove #ddd !important;
        padding: 0 1.4em 1.4em 1.4em !important;
        margin: 0 0 1.5em 0 !important;
        -webkit-box-shadow:  0px 0px 0px 0px #000;
                box-shadow:  0px 0px 0px 0px #000;
    }

    .panel_s .bg-panding {
        background: linear-gradient(110deg, #ffed4b 60%, #fdcd3b 60%);
        color: #fff;
    }

    .panel_s .bg-success {
        background: linear-gradient(110deg, #4dff1a 60%, #41d933 60%);
        color: #fff;
    }
</style>

<div id="wrapper">
    <div class="content accounting-template">
        <div class="row">

            <div class="col-md-12">
                <div class="panel_s">
                    <div class="panel-body">
                        <h4 class="no-margin"><?php echo isset($title) ? $title : "--"?> </h4>
                        <hr class="hr-panel-heading">
                        <br>
                        <!--<form method="post" id="salary_form" enctype="multipart/form-data" action="<?php echo admin_url('salary/pay_all'); ?>">-->
                            <?php echo form_open_multipart($this->uri->uri_string(), array('id' => 'attendance_form', 'class' => 'salary-form')); ?>
                            <div class="row">
                                <div class="form-group col-md-4">
                                  <label for="location_id" class="control-label">Location </label>
                                  <select class="form-control selectpicker"  id="location_id" name="location_id" data-tab="branch_details" data-live-search="true">
                                      <option value=""></option>
                                      <?php
                                      if (isset($location_info) && count($location_info) > 0) {
                                          foreach ($location_info as $location_value) {
                                              $selectedcls = (isset($location_id) && $location_id == $location_value['id']) ? 'selected' : "";
                                              ?>
                                              <option value="<?php echo $location_value['id'] ?>" <?php echo $selectedcls ?>><?php echo cc($location_value['name']); ?></option>
                                              <?php
                                          }
                                      }
                                      ?>
                                  </select>
                                </div>
                                <div class="form-group col-md-2">
                                    <input type="hidden" name="month" value="<?php echo (isset($month)) ? $month : ""; ?>">
                                    <input type="hidden" name="year" value="<?php echo (isset($year)) ? $year : ""; ?>">
                                    <button type="submit" style="margin-top: 25px;" class="btn btn-info">Search</button>
                                    <a style="margin-top: 25px;" class="btn btn-danger" href="">Reset</a>
                                </div>
                            </div>

                            <?php echo form_close(); ?>
                            <div class="row">
                                <br>
                                <div class="col-md-12">

                                    <?php
                                        $total_earning = $total_deduction = $total_salary = $total_earning2 = $total_deduction2 = $total_salary2 = 0.00;
                                        $i = $t = 0;
                                        $staff_con_arr = array();
                                        if (isset($staff_list) && !empty($staff_list)){
                                    ?>
                                        <ul class="nav nav-tabs" role="tablist">
                                            <li role="presentation" class="col-md-6 text-center <?php echo ($page == "taxable") ? "active": ""; ?>">
                                                <a href="#taxable" aria-controls="taxable" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="true">Company Employee</a>
                                            </li>
                                            <li role="presentation" class="col-md-6 text-center <?php echo ($page == "nontaxable") ? "active": ""; ?>">
                                                <a href="#nontaxable" aria-controls="nontaxable" style="font-size: 20px;" role="tab" data-toggle="tab" aria-expanded="false">Contract</a>
                                            </li>
                                        </ul>
                                        <div class="tab-content">
                                            <div role="tabpanel" class="tab-pane <?php echo ($page == "taxable") ? "active": ""; ?>" id="taxable">

                                                <!-- <div class="row1">
                                                    <fieldset class="scheduler-border"><br>
                                                        <div class="col-md-12">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Salary</h4>
                                                                    <p id="tl_earning" style="color: red; text-align: center;"><?php echo $total_earning; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Deduction</h4>
                                                                    <p id="tl_deduction" style="color: red; text-align: center;"><?php echo $total_deduction; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 style="color: red; text-align: center;" class="control-label">Net Payble</h4>
                                                                    <p id="tl_salary" style="color: red; text-align: center;"><?php echo $total_salary; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div> -->
                                                <?php
                                                    foreach ($staff_list["taxable"] as $bid => $staff_data) {
                                                        $i++;
                                                        $info = $this->db->query("SELECT comp_branch_name FROM `tblcompanybranch` where id = '" . $bid . "' ")->row();
                                                        if (!empty($staff_data)){
                                                            echo '<tr><h3 align="center" class="text-danger">' . $info->comp_branch_name . '</h3></tr><hr>';
                                                ?>
                                                        <div class="table-responsive">
                                                            <table class="display" id="">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">S.No</th>
                                                                        <th>Photo</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Designation</th>
                                                                        <th>Location</th>
                                                                        <th>Superior Name</th>
                                                                        <th>Attendance</th>
                                                                        <th>CTC</th>
                                                                        <th>Gross Salary</th>
                                                                        <th>PF</th>
                                                                        <th>ESIC</th>
                                                                        <th>PT</th>
                                                                        <th>Loan</th>
                                                                        <th>Adv</th>
                                                                        <th>TDS</th>
                                                                        <th>OverTime</th>
                                                                        <th>Net Payble</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php

                                                                    foreach ($staff_data as $k => $value) {
                                                                        ++$t;

                                                                        $query = $this->db->query("SELECT COUNT(id) as ttl_att FROM `tblstaffattendance` where staff_id = '".$value->staffid."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ")->row();

                                                                        $wallet_amt = wallet_amount($value->staffid);
                                                                        $walletamt = ($wallet_amt < 0) ? "<span class='text-danger'>" . number_format(abs($wallet_amt), 2) . "</span>" : "--";

                                                                        $salary_info = $this->home_model->get_row('tblsalarypaidlog', array('staff_id'=>$value->staffid,'month'=>$month,'year'=>$year,'status'=>1), '');
                                                                        $status = "<span class='label label-success'>Regular</span>";
                                                                        $action = 1;
                                                                        if ($wallet_amt < 0) {
                                                                            if ($wallet_amt < -1000) {
                                                                                $salary_confirm_data = $this->db->query("SELECT scd.status FROM `tblsalaryconfirmation` as sc LEFT JOIN `tblsalaryconfirmationdetails` as scd ON sc.id = scd.salary_confirmation_id WHERE sc.year_id = " . $year . " and sc.month_id = " . $month . " and scd.staff_id = " . $value->staffid . "")->row();
                                                                                if (!empty($salary_confirm_data)) {
                                                                                    if ($salary_confirm_data->status == 0) {
                                                                                        $action = 0;
                                                                                        $status = "<span class='label label-warning'>Pending</span>";
                                                                                    } elseif ($salary_confirm_data->status == 1) {
                                                                                        $action = 1;
                                                                                        $status = "<span class='label label-info'>Accept</span>";
                                                                                    } elseif ($salary_confirm_data->status == 2) {
                                                                                        $action = 0;
                                                                                        $staff_con_arr[] = $value->staffid;
                                                                                        $status = "<span class='label label-danger'>On Hold</span>";
                                                                                    }
                                                                                } else {
                                                                                    $action = 0;
                                                                                    $status = "--";
                                                                                    $staff_con_arr[] = $value->staffid;
                                                                                }
                                                                            }
                                                                        }
                                                                        $salarylog = $this->db->query("SELECT * FROM `tbltempstaffsalarylog` WHERE `staff_id` =".$value->staffid." AND `month`=".$month." AND `year`=".$year."")->row();
                                                                        if (!empty($salarylog)){

                                                                            if ($info->comp_branch_name == get_branch($value->staffid)){
                                                                                $total_earning += $salarylog->earning_amount;
                                                                                $total_deduction += $salarylog->deduction_amount;
                                                                                $total_salary += $salarylog->net_salary;
                                                                            }
                                                                        }
                                                                        $gross_salary = $net_salary = $pf_amt = $esic_amt = $pt_amt = $loan = $advance = $tds_amt = $overtime_amt = '0.00';
                                                                        if (!empty($salary_info)){
                                                                            $gross_salary = (!empty($salary_info->gross_salary)) ? $salary_info->gross_salary : '0.00';
                                                                            $net_salary = (!empty($salary_info->net_salary)) ? $salary_info->net_salary : '0.00';;
                                                                            $pf_amt = (!empty($salary_info->pf_amt)) ? $salary_info->pf_amt : '0.00';
                                                                            $esic_amt = (!empty($salary_info->esic_amt)) ? $salary_info->esic_amt : '0.00';
                                                                            $pt_amt = (!empty($salary_info->pt_amt)) ? $salary_info->pt_amt : '0.00';
                                                                            $loan = (!empty($salary_info->loan)) ? $salary_info->loan : '0.00';
                                                                            $advance = (!empty($salary_info->advance)) ? $salary_info->advance : '0.00';
                                                                            $tds_amt = (!empty($salary_info->tds_amt)) ? $salary_info->tds_amt : '0.00';
                                                                            $overtime_amt = (!empty($salary_info->overtime_amt)) ? $salary_info->overtime_amt : '0.00';
                                                                        }else if(!empty($salarylog)) {
                                                                            $gross_salary = (!empty($salarylog->gross_salary)) ? $salarylog->gross_salary : '0.00';;
                                                                            $net_salary = (!empty($salarylog->net_salary)) ? $salarylog->net_salary : '0.00';
                                                                            $pf_amt = (!empty($salarylog->pf)) ? $salarylog->pf : '0.00';
                                                                            $esic_amt = (!empty($salarylog->esic)) ? $salarylog->esic : '0.00';
                                                                            $pt_amt = (!empty($salarylog->pt)) ? $salarylog->pt : '0.00';
                                                                            $loan = (!empty($salarylog->loan)) ? $salarylog->loan : '0.00';
                                                                            $advance = (!empty($salarylog->adv)) ? $salarylog->adv : '0.00';
                                                                        }

                                                                        $action_btn = (!empty($salary_info) && $action == 1) ? "<a href='javascript:void(0)' data-rid='".$salary_info->id."' data-toggle='modal' data-target='#paid-salary' class='btn-sm btn-success salarymodel'>Paid</a>" : "--";

                                                                        $ttlattendance = (!empty($query)) ? $query->ttl_att : 0;
                                                                        $monthly_salary =  get_staff_info($value->staffid)->monthly_salary;
                                                                        $designation_id =  get_staff_info($value->staffid)->designation_id;
                                                                        $location_id =  get_staff_info($value->staffid)->location_id;
                                                                        $superior_id =  get_staff_info($value->staffid)->superior_id;
                                                                        $photo = staff_profile_image($value->staffid,array('img-circle','img-thumbnail','isTooltip', 'profile-img'),'thumb');
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo ++$k; ?></td>
                                                                            <td><?php echo $photo; ?></td>
                                                                            <td><?php echo cc($value->firstname); ?></td>
                                                                            <td><?php echo value_by_id("tbldesignation", $designation_id, "designation"); ?></td>
                                                                            <td><?php echo ($location_id > 0) ? value_by_id("tbllocationmaster", $location_id, "name") : '--'; ?></td>
                                                                            <td><?php echo ($superior_id > 0) ? get_employee_fullname($superior_id) : '--'; ?></td>
                                                                            <td><?php echo '<a target="_blank" href="'. admin_url('attendance/employee_attendance?staff_id='.$value->staffid.'&month='.$month.'&year='.$year).'" class="btn-sm btn-info">'.$ttlattendance.'</a>';?></td>
                                                                            <td><?php echo (!empty($monthly_salary)) ? $monthly_salary : "--"; ?></td>
                                                                            <td><?php echo $gross_salary; ?></td>
                                                                            <td><?php echo $pf_amt; ?></td>
                                                                            <td><?php echo $esic_amt; ?></td>
                                                                            <td><?php echo $pt_amt; ?></td>
                                                                            <td><?php echo $loan; ?></td>
                                                                            <td><?php echo $advance; ?></td>
                                                                            <td><?php echo $tds_amt; ?></td>
                                                                            <td><?php echo $overtime_amt; ?></td>
                                                                            <td><?php echo $net_salary; ?></td>
                                                                            <td><?php echo $status; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    if ($action == 1){
                                                                                        if(!empty($salary_info)){
                                                                                            echo '<a target="_blank" href="'. admin_url('salary/salary_print/'.$salary_info->id).'" class="btn-sm btn-info"><i class="fa fa-print" aria-hidden="true"></i></a>';
                                                                                        }else{
                                                                                            echo '<a target="_blank" href="'. admin_url('salary_new/salary_details/'.$value->staffid.'/'.$month.'/'.$year.'/taxable').'" class="btn-sm btn-info"><i class="fa fa-money" aria-hidden="true"></i></a>';
                                                                                        }
                                                                                    }else{
                                                                                        echo '--';
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }

                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php
                                                        }
                                                    }
                                                ?>
                                                <input type="hidden" class="tl_earning" value="<?php echo $total_earning; ?>">
                                                <input type="hidden" class="tl_deduction" value="<?php echo $total_deduction; ?>">
                                                <input type="hidden" class="tl_salary" value="<?php echo $total_salary; ?>">
                                            </div>
                                            <div role="tabpanel" class="tab-pane <?php echo ($page == "nontaxable") ? "active": ""; ?>" id="nontaxable">

                                                <!-- <div class="row1">
                                                    <fieldset class="scheduler-border"><br>
                                                        <div class="col-md-12">
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Salary</h4>
                                                                    <p id="ntl_earning" style="color: red; text-align: center;"><?php echo $total_earning2; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 style="color: red; text-align: center;" class="control-label">Total Deduction</h4>
                                                                    <p id="ntl_deduction" style="color: red; text-align: center;"><?php echo $total_deduction2; ?></p>
                                                                </div>
                                                            </div>
                                                            <div class="col-md-4">
                                                                <div class="form-group">
                                                                    <h4 style="color: red; text-align: center;" class="control-label">Net Payble</h4>
                                                                    <p id="ntl_salary" style="color: red; text-align: center;"><?php echo $total_salary2; ?></p>
                                                                </div>
                                                            </div>
                                                        </div>
                                                    </fieldset>
                                                </div> -->
                                                <?php
                                                    foreach ($staff_list["nontaxable"] as $bid => $staff_data2) {
                                                        $i++;
                                                        $info = $this->db->query("SELECT comp_branch_name FROM `tblcompanybranch` where id = '" . $bid . "' ")->row();
                                                        if (!empty($staff_data2)){
                                                            echo '<tr><h3 align="center" class="text-danger">' . $info->comp_branch_name . '</h3></tr><hr>';
                                                ?>
                                                        <div class="table-responsive">
                                                            <table class="display" id="">
                                                                <thead>
                                                                    <tr>
                                                                        <th width="5%">S.No</th>
                                                                        <th>Photo</th>
                                                                        <th>Employee Name</th>
                                                                        <th>Designation</th>
                                                                        <th>Location</th>
                                                                        <th>Superior Name</th>
                                                                        <th>Attendance</th>
                                                                        <th>CTC</th>
                                                                        <th>Gross Salary</th>
                                                                        <th>PF</th>
                                                                        <th>ESIC</th>
                                                                        <th>PT</th>
                                                                        <th>Loan</th>
                                                                        <th>Adv</th>
                                                                        <th>TDS</th>
                                                                        <th>OverTime</th>
                                                                        <th>Net Payble</th>
                                                                        <th>Status</th>
                                                                        <th>Action</th>
                                                                    </tr>
                                                                </thead>
                                                                <tbody>
                                                                    <?php
                                                                    foreach ($staff_data2 as $k => $value) {
                                                                        ++$t;

                                                                        $query = $this->db->query("SELECT COUNT(id) as ttl_att FROM `tblstaffattendance` where staff_id = '".$value->staffid."' and status IN (1,3,4,5,6) and YEAR(date) = '".$year."' AND MONTH(date) = '".$month."' ")->row();
                                                                        $wallet_amt = wallet_amount($value->staffid);
                                                                        $walletamt = ($wallet_amt < 0) ? "<span class='text-danger'>" . number_format(abs($wallet_amt), 2) . "</span>" : "--";
                                                                        $salary_info = $this->home_model->get_row('tblsalarypaidlog', array('staff_id'=>$value->staffid,'month'=>$month,'year'=>$year,'status'=>1), '');
                                                                        $status = "<span class='label label-success'>Regular</span>";
                                                                        $action = 1;
                                                                        if ($wallet_amt < 0) {
                                                                            if ($wallet_amt < -1000) {
                                                                                $salary_confirm_data = $this->db->query("SELECT scd.status FROM `tblsalaryconfirmation` as sc LEFT JOIN `tblsalaryconfirmationdetails` as scd ON sc.id = scd.salary_confirmation_id WHERE sc.year_id = " . $year . " and sc.month_id = " . $month . " and scd.staff_id = " . $value->staffid . "")->row();
                                                                                if (!empty($salary_confirm_data)) {
                                                                                    if ($salary_confirm_data->status == 0) {
                                                                                        $action = 0;
                                                                                        $status = "<span class='label label-warning'>Pending</span>";
                                                                                    } elseif ($salary_confirm_data->status == 1) {
                                                                                        $action = 1;
                                                                                        $status = "<span class='label label-info'>Accept</span>";
                                                                                    } elseif ($salary_confirm_data->status == 2) {
                                                                                        $action = 0;
                                                                                        $staff_con_arr[] = $value->staffid;
                                                                                        $status = "<span class='label label-danger'>On Hold</span>";
                                                                                    }
                                                                                } else {
                                                                                    $action = 0;
                                                                                    $status = "--";
                                                                                    $staff_con_arr[] = $value->staffid;
                                                                                }
                                                                            }
                                                                        }
                                                                        $salarylog = $this->db->query("SELECT * FROM `tbltempstaffsalarylog` WHERE `staff_id` =".$value->staffid." AND month=".$month." AND year=".$year."")->row();
                                                                        if (!empty($salarylog)){

                                                                            if ($info->comp_branch_name == get_branch($value->staffid)){
                                                                                $total_earning2 += $salarylog->earning_amount;
                                                                                $total_deduction2 += $salarylog->deduction_amount;
                                                                                $total_salary2 += $salarylog->net_salary;
                                                                            }
                                                                        }
                                                                        $gross_salary = $net_salary = $pf_amt = $esic_amt = $pt_amt = $loan = $advance = $tds_amt = $overtime_amt = '0.00';
                                                                        if (!empty($salary_info)){
                                                                            $gross_salary = (!empty($salary_info->gross_salary)) ? $salary_info->gross_salary : '0.00';
                                                                            $net_salary = (!empty($salary_info->net_salary)) ? $salary_info->net_salary : '0.00';;
                                                                            $pf_amt = (!empty($salary_info->pf_amt)) ? $salary_info->pf_amt : '0.00';
                                                                            $esic_amt = (!empty($salary_info->esic_amt)) ? $salary_info->esic_amt : '0.00';
                                                                            $pt_amt = (!empty($salary_info->pt_amt)) ? $salary_info->pt_amt : '0.00';
                                                                            $loan = (!empty($salary_info->loan)) ? $salary_info->loan : '0.00';
                                                                            $advance = (!empty($salary_info->advance)) ? $salary_info->advance : '0.00';
                                                                            $tds_amt = (!empty($salary_info->tds_amt)) ? $salary_info->tds_amt : '0.00';
                                                                            $overtime_amt = (!empty($salary_info->overtime_amt)) ? $salary_info->overtime_amt : '0.00';
                                                                        }else if(!empty($salarylog)) {
                                                                            $gross_salary = (!empty($salarylog->gross_salary)) ? $salarylog->gross_salary : '0.00';;
                                                                            $net_salary = (!empty($salarylog->net_salary)) ? $salarylog->net_salary : '0.00';
                                                                            $pf_amt = (!empty($salarylog->pf)) ? $salarylog->pf : '0.00';
                                                                            $esic_amt = (!empty($salarylog->esic)) ? $salarylog->esic : '0.00';
                                                                            $pt_amt = (!empty($salarylog->pt)) ? $salarylog->pt : '0.00';
                                                                            $loan = (!empty($salarylog->loan)) ? $salarylog->loan : '0.00';
                                                                            $advance = (!empty($salarylog->adv)) ? $salarylog->adv : '0.00';
                                                                        }
                                                                        $action_btn = (!empty($salary_info) && $action == 1) ? "<a href='javascript:void(0)' data-rid='".$salary_info->id."' data-toggle='modal' data-target='#paid-salary' class='btn-sm btn-success salarymodel'>Paid</a>" : "--";
                                                                        $monthly_salary =  get_staff_info($value->staffid)->monthly_salary;
                                                                        $ttlattendance = (!empty($query)) ? $query->ttl_att : 0;
                                                                        $designation_id =  get_staff_info($value->staffid)->designation_id;
                                                                        $location_id =  get_staff_info($value->staffid)->location_id;
                                                                        $superior_id =  get_staff_info($value->staffid)->superior_id;
                                                                        $photo = staff_profile_image($value->staffid,array('img-circle','img-thumbnail','isTooltip', 'profile-img'),'thumb');
                                                                        ?>
                                                                        <tr>
                                                                            <td><?php echo ++$k; ?></td>
                                                                            <td><?php echo $photo; ?></td>
                                                                            <td><?php echo cc($value->firstname); ?></td>
                                                                            <td><?php echo value_by_id("tbldesignation", $designation_id, "designation"); ?></td>
                                                                            <td><?php echo ($location_id > 0) ? value_by_id("tbllocationmaster", $location_id, "name") : '--'; ?></td>
                                                                            <td><?php echo ($superior_id > 0) ? get_employee_fullname($superior_id) : '--'; ?></td>
                                                                            <td><?php echo '<a target="_blank" href="'. admin_url('attendance/employee_attendance?staff_id='.$value->staffid.'&month='.$month.'&year='.$year).'" class="btn-sm btn-info">'.$ttlattendance.'</a>';?></td>
                                                                            <td><?php echo $monthly_salary; ?></td>
                                                                            <td><?php echo $gross_salary; ?></td>
                                                                            <td><?php echo $pf_amt; ?></td>
                                                                            <td><?php echo $esic_amt; ?></td>
                                                                            <td><?php echo $pt_amt; ?></td>
                                                                            <td><?php echo $loan; ?></td>
                                                                            <td><?php echo $advance; ?></td>
                                                                            <td><?php echo $tds_amt; ?></td>
                                                                            <td><?php echo $overtime_amt; ?></td>
                                                                            <td><?php echo $net_salary; ?></td>
                                                                            <td><?php echo $status; ?></td>
                                                                            <td>
                                                                                <?php
                                                                                    if ($action == 1){
                                                                                        if(!empty($salary_info)){
                                                                                            echo '<a target="_blank" href="'. admin_url('salary/salary_print/'.$salary_info->id).'" class="btn-sm btn-info"><i class="fa fa-print" aria-hidden="true"></i></a>';
                                                                                        }else{
                                                                                            echo '<a target="_blank" href="'. admin_url('salary_new/salary_details/'.$value->staffid.'/'.$month.'/'.$year.'/nontaxable').'" class="btn-sm btn-info"><i class="fa fa-money" aria-hidden="true"></i></a>';
                                                                                        }
                                                                                    }else{
                                                                                        echo '--';
                                                                                    }
                                                                                ?>
                                                                            </td>
                                                                        </tr>
                                                                        <?php
                                                                    }
                                                                    ?>
                                                                </tbody>
                                                            </table>
                                                        </div>
                                                        <?php
                                                        }
                                                    }
                                                }
                                                ?>
                                                <input type="hidden" class="ntl_earning" value="<?php echo $total_earning2; ?>">
                                                <input type="hidden" class="ntl_deduction" value="<?php echo $total_deduction2; ?>">
                                                <input type="hidden" class="ntl_salary" value="<?php echo $total_salary2; ?>">
                                            </div>
                                        </div>


                                </div>

<!--                                <input type="hidden" name="month" value="<?php echo $month; ?>">
                                <input type="hidden" name="year" value="<?php echo $year; ?>">	-->
                            </div>
                        <!--</form>-->
                        <div class="btn-bottom-toolbar text-right">
                        </div>
                    </div>

                </div>
            </div>

        </div>
        <div class="btn-bottom-pusher"></div>
    </div>
</div>
<div id="myModal1" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title"><?php echo $md_title; ?></h4>
            </div>
            <?php echo form_open(admin_url("salary_new/assign_salary_confirmation"), array('id' => 'assign_salary_confirmation', 'class' => 'salary_confirmation')); ?>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12">
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
                        <div class="form-group">
                            <label for="remark" class="control-label">Remark</label>
                            <textarea class="form-control" required name="remark" rows="5"></textarea>
                        </div>
                    </div>
                </div>
            </div>
            <div class="modal-footer">
                <input type="hidden" name="staff_ids" value="<?php echo implode(",", $staff_con_arr); ?>">
                <input type="hidden" name="month_id" value="<?php echo $month; ?>">
                <input type="hidden" name="year_id" value="<?php echo $year; ?>">
                <input type="hidden" name="request_type" value="<?php echo $request_type; ?>">
                <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                <button type="submit" class="btn btn-primary" name="submit">Submit</button>
            </div>
            <?php echo form_close(); ?>
        </div>
    </div>
</div>
<div id="paid-salary" class="modal fade" role="dialog">
    <div class="modal-dialog">
        <div class="modal-content">
            <div class="modal-header">
                <button type="button" class="close" data-dismiss="modal">&times;</button>
                <h4 class="modal-title">Paid Salary Details </h4>
            </div>
            <div class="modal-body">
                <div class="row">
                    <div class="col-md-12 salary-details">

                    </div>
                </div>
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
<script type="text/javascript">
    $(function () {
        $('#color-group').colorpicker({horizontal: true});
    });
</script>

<script>

$(document).ready(function() {

    $('table.display').DataTable( {
        "bPaginate": false,
        dom: 'Bfrtip',
        buttons: [
            {
                extend: 'excel',
                exportOptions: {
                    columns: [ 0, 1, 2, 3, 4, 5, 6, 7, 8, 9, 10, 11]
                }
            }
        ]
    } );
    var ntl_earning = $(".ntl_earning").val();
    var ntl_deduction = $(".ntl_deduction").val();
    var ntl_salary = $(".ntl_salary").val();
    $("#ntl_earning").html(ntl_earning);
    $("#ntl_deduction").html(ntl_deduction);
    $("#ntl_salary").html(ntl_salary);

    var tl_earning = $(".tl_earning").val();
    var tl_deduction = $(".tl_deduction").val();
    var tl_salary = $(".tl_salary").val();

    $("#tl_earning").html(tl_earning);
    $("#tl_deduction").html(tl_deduction);
    $("#tl_salary").html(tl_salary);

    $("#year").on("change", function(){
        var year_id = $("#year").val();
        $.get("<?php echo admin_url("salary_new/getmonths?year_id="); ?>"+year_id, function(response){
            $("#month").html(response);
            $('.selectpicker').selectpicker('refresh');
        });
    });
} );


</script>
<script type="text/javascript">
//    $(document).on('change', '#branch_id', function () {
//        $("#attendance_form").submit();
//    });
//
//    $(document).on('change', '#month', function () {
//        $("#attendance_form").submit();
//    });
</script>


<script type="text/javascript">
    $(document).on('click', '.pay_all', function () {

        var retVal = confirm("Do you want to continue ?");
        if (retVal == true) {
            if (!$("input[name='staffid[]']").is(":checked")) {
                alert('Please Check Any Checkbox First!');
                return false;
            } else {
                $("#salary_form").submit();
            }
        }

    });
</script>

<script>
    $(document).ready(function () {
        $("#ckbCheckAll").click(function () {
            $(".checkBoxClass").prop('checked', $(this).prop('checked'));
        });

        $(".checkBoxClass").change(function () {
            if (!$(this).prop("checked")) {
                $("#ckbCheckAll").prop("checked", false);
            }
        });

        $(".salarymodel").click(function () {
            $(".salary-details").html("");
            var rid = $(this).data("rid");
            var url = "<?php echo admin_url("salary_new/get_paid_salary_details"); ?>"
            $.post(url, {log_id: rid}, function(response){
                if (response != ''){
                    $(".salary-details").html(response);
                }
            });
        });
    });
</script>

</body>
</html>

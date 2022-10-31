<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Salary_new extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('salary_model');
        $this->load->model('home_model');
    }

    public function index($id = '') {

//        check_permission(105, 'view');

        $data["page"] = (!empty($_GET["page"])) ? $_GET["page"] : "taxable";
        $data['month'] = (!empty($_GET["month"])) ? $_GET["month"] : date("m",strtotime("-1 month"));
        $data['year'] = (!empty($_GET["year"])) ? $_GET["year"] : date("Y",strtotime("-1 month"));

        if ($this->input->post()) {
            extract($this->input->post());

            if(!empty($month)){
		        $data['month'] = $month;
            }

            if(!empty($year)){
                $data['year'] = $year;
            }
            if (!empty($salary_status)){
                $data['salary_status'] = $salary_status;
            }
            $j_date = $year.'-'.$month.'-31';
        }else{
            $j_date = $data['year'].'-'.$data['month'].'-31';
        }

        // $where = "active = 1 AND taxable = 1 AND joining_date <= '" . $j_date . "'";
        // $where2 = "active = 1 AND taxable = 2 AND joining_date <= '" . $j_date . "'";

        $staffdesignation_id = get_staff_info(get_staff_user_id())->designation_id;
        $data['staff_list'] = array();
        if (is_admin() == 1 || $staffdesignation_id == 4){
            $branch_info = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
            if (!empty($branch_info)){
                foreach ($branch_info as $binfo) {
                    $where = "(active = 1 OR relieving_date >= '" . $j_date . "') AND  joining_date <= '" . $j_date . "' and reporting_branch_id =".$binfo->id;
                    // $where2 .= " and reporting_branch_id =".$binfo->id;
                    // $where .= " and FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                    // $where2 .= " and FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                    $data['staff_list']["taxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 1 AND " . $where . " ")->result();
                    $data['staff_list']["nontaxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 2 AND " . $where . " ")->result();
                }
            }
        }else if (is_admin() != 1) {

            $branch_ids = get_staff_info(get_staff_user_id())->bm_branch_id;
            if ($branch_ids != 0){
                $branch = explode(",", $branch_ids);
                foreach ($branch as $b_id) {
                    $where = "(active = 1 OR relieving_date >= '" . $j_date . "') AND joining_date <= '" . $j_date . "' AND staffid !=".get_staff_user_id()." and reporting_branch_id =".$b_id;
                    // $where .= " AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$b_id."', reporting_branch_id)";
                    // $where2 .= " AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$b_id."', reporting_branch_id)";
                    $data['staff_list']["taxable"][$b_id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 1 AND " . $where . " ")->result();
                    $data['staff_list']["nontaxable"][$b_id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 2 AND " . $where . " ")->result();
                }
            }else if(empty($data['staff_list'])) {

                $branch_info = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
                if (!empty($branch_info)){
                    foreach ($branch_info as $binfo) {
                        $where = "(active = 1 OR relieving_date >= '" . $j_date . "') AND joining_date <= '" . $j_date . "' AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND reporting_branch_id =".$binfo->id;
                        // $where .= " AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                        // $where2 .= " AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                        $data['staff_list']["taxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 1 AND " . $where . " ")->result();
                        $data['staff_list']["nontaxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 2 AND " . $where . " ")->result();
                    }
                }
            }
        }


        $data['title'] = 'Manage Salary';
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='22'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
        if ($data['year'] == date("Y")){
            $data['month_info'] = $this->home_model->get_result('tblmonths', array('id <=' => date("m")), '');
        }else{
            $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        }


        /* call salary cron for update */
        file_get_contents(base_url()."Salary_cron/generate_salary?month=".$data['month']."&year=".$data['year']);

        $data['allStaffdata'] = $stafff;
        $this->load->view('admin/salary_new/manage_salary', $data);
    }

    /* this function use for assign salary confirmation */
    public function assign_salary_confirmation(){
        if(!empty($_POST)){
            extract($this->input->post());

            $assignstaff=$assignid;
            if(!empty($assignstaff)){
                foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                        $staff_id[] = str_replace("staff", "", $single_staff);
                    }
                }
                $assignstaff_id = array_unique($staff_id);
            }else{
                 $assignstaff_id = array();
            }

            $staff_arr = array_unique(explode(",", $staff_ids));
            if (!empty($staff_arr)){
                $sconfirmation = $this->db->query("SELECT `id`,`action_status` FROM `tblsalaryconfirmation` WHERE `year_id`=".$year_id." AND `month_id`=".$month_id." ")->row();
                if (!empty($sconfirmation)){

                    $data["staff_id"] = get_staff_user_id();
                    $data["remark"] = $remark;
                    $data["request_type"] = $request_type;
                    $data["action_status"] = 0;
                    $response = $this->home_model->update("tblsalaryconfirmation", $data, array("id" => $sconfirmation->id));
                    if ($response){
                        foreach ($staff_arr as $staff_id) {

                            $staffdata["status"] = 0;
                            $this->home_model->update("tblsalaryconfirmationdetails", $staffdata, array("salary_confirmation_id" => $sconfirmation->id, "staff_id" => $staff_id));
                        }

                        $table_id = $sconfirmation->id;
                    }
                }else{
                    $data["staff_id"] = get_staff_user_id();
                    $data["year_id"] = $year_id;
                    $data["month_id"] = $month_id;
                    $data["remark"] = $remark;
                    $data["request_type"] = $request_type;
                    $data["action_status"] = 0;
                    $data["created_at"] = date("Y-m-d H:i:s");
                    $response = $this->home_model->insert("tblsalaryconfirmation", $data);
                    if ($response){
                        $table_id = $this->db->insert_id();
                        foreach ($staff_arr as $staff_id) {
                            $staffdata["salary_confirmation_id"] = $table_id;
                            $staffdata["staff_id"] = $staff_id;
                            $staffdata["status"] = 0;
                            $this->home_model->insert("tblsalaryconfirmationdetails", $staffdata);
                        }
                    }
                }
                if (isset($table_id) && !empty($assignstaff_id)){

                    /* this is for delete old data */
                    $this->home_model->delete('tblsalaryconfirmationstaffapproval', array("salary_confirmation_id" => $table_id));
                    $this->home_model->delete('tblmasterapproval', array("table_id" => $table_id, 'module_id'=> 35));

                    foreach ($assignstaff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,
                            'salary_confirmation_id' => $table_id,
                            'status' => 1,
                            'approve_status' => 0,
                            'created_at' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblsalaryconfirmationstaffapproval',$ad_field);

                        $message = 'Staff Salary Confirmation approval request send you';
                        $adata = array(
                            'staff_id' => $staffid,
                            'fromuserid'      => get_staff_user_id(),
                            'module_id' => 35,
                            'table_id' => $table_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => $message,
                            'link' => 'Salary_new/salary_confirmation_approval/'.$table_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->db->insert('tblmasterapproval', $adata);

                        //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }

                    set_alert('success', "Salary Confirmation add successfully");
                }

            }else{
                set_alert('warning', "Something went wrong.");
            }
        }
        redirect(admin_url('Salary_new?year='.$year_id.'&month='.$month_id));
    }

    /* this function use for salary confirmation approval */
    public function salary_confirmation_approval($id){

        $check_approval = $this->db->query("SELECT * FROM `tblmasterapproval` where table_id = '".$id."' and module_id = 35 and approve_status = 1 and status = 1")->row();
        if(!empty($check_approval)){
            set_alert('danger', "Action already taken");
            redirect(admin_url('approval/notifications'));
        }

        if(!empty($_POST)){
            $post_data = $this->input->post();
            extract($this->input->post());

            $update = $this->home_model->update('tblsalaryconfirmation', array('action_status' => 1), array('id' => $id));
            if ($update) {

                if (isset($staffdata) && !empty($staffdata)){
                    foreach ($staffdata as $value) {
                        $staff_data["status"] = $value["staff_action"];
                        $this->home_model->update('tblsalaryconfirmationdetails', $staff_data, array('salary_confirmation_id' => $id,'staff_id' => $value["staff_id"]));
                    }
                }
                $ad_data = array(
                    'approvereason' => $data["approval_remark"],
                    'approve_status' => 1,
                    'updated_at' => date('Y-m-d H:i:s')
                );

                $this->home_model->update('tblsalaryconfirmationstaffapproval', $ad_data, array('salary_confirmation_id' => $id, 'staff_id' => get_staff_user_id()));

                update_masterapproval_single(get_staff_user_id(), 35, $id, 1);
                update_masterapproval_all(35, $id, 1);

                set_alert('success', "Salary Confirmation approved successfully");
                redirect(admin_url('approval/notifications'));
            }
        }

        $data["title"] = "Salary Confirmation Approval";
        $data['salaryconfirmation_info'] = $this->db->query("SELECT * FROM `tblsalaryconfirmation` where id = '".$id."'")->row();
        $data['salaryconfirmation_details'] = $this->db->query("SELECT * FROM `tblsalaryconfirmationdetails` where salary_confirmation_id = '".$id."' and  status = 0")->result();

        $this->load->view('admin/salary_new/salary_confirmation_approval', $data);
    }

    /* this function use for salary details */
    public function salary_details($staff_id,$month,$year, $pagetype){

        if(!empty($staff_id) && !empty($month) && !empty($year)){

            $data['staff_info'] = get_employee_info($staff_id);
            $data['month'] = $month;
            $data['year'] = $year;
            $data['staff_id'] = $staff_id;

            if(!empty($_POST)){
                extract($this->input->post());

                //$year = date('Y');
                $month_day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
                $paid_leave = 0;
                $leave = 0;
                $present_days = 0;
                $half_days = 0;

                //$date_str = $year.'-'.$month;
                $att_info = get_month_attendance($staff_id,$year,$month);
                if(!empty($att_info)){
                    foreach($att_info as $row){
                        if($row->status == 6){
                            $paid_leave += 1 ;
                        }elseif($row->status == 2){
                            $leave += 1;
                        }elseif($row->status == 4){
                            $half_days += 1;
                        }elseif($row->status == 1 || $row->status == 3 || $row->status == 5){
                            $present_days += 1;
                        }
                    }
                }

                if(empty($loan)){
                    $loan = 0;
                }

                if(!empty($paid_date)){
                    $paid_date = str_replace("/","-",$paid_date);
                    $paid_date = date("Y-m-d",strtotime($paid_date));
                }else{
                    $paid_date = date('Y-m-d');
                }

                if(!empty($preview)){
                    $ad_data = array(
                                    'staff_id' => $staff_id,
                                    'month' => $month,
                                    'year' => $year,
                                    'net_salary' => $net_salary,
                                    'loan' => $loan,
                                    'advance' => $advance,
                                    //'expense' => $expense,
                                    'paid_leave' => $paid_leave,
                                    'leave' => $leave,
                                    'present_days' => $present_days,
                                    'half_days' => $half_days,
                                    'month_day' => $month_day,
                                    'gross_salary' => $gross_salary,
                                    'bacis_salary' => $bacis_salary,
                                    'pf_amt' => $pf_amt,
                                    'esic_amt' => $esic_amt,
                                    'pt_amt' => $pt_amt,
                                    'ta_amt' => $ta_amt,
                                    'medical_amt' => $medical_amt,
                                    'hra_amt' => $hra_amt,
                                    'uniform_amt' => $uniform_amt,
                                    'other_amt' => $other_amt,
                                    'overtime_amt' => $overtime_amt,
                                    'arrear_amt' => $arrear_amt,
                                    'incentive_amt' => $incentive_amt,
                                    'rent_amt' => $rent_amt,
                                    'tds_amt' => $tds_amt,
                                    'lockDownDeduction_amt' => $lockDownDeduction_amt,
                                    'outstanding_amt' => $outstanding_amt,
                                    'create_at' => $paid_date,
                                    'status' => 0
                            );


                    $insert = $this->home_model->insert('tblsalarypaidlog', $ad_data);

                    if($insert == true){
                        $log_id = $this->db->insert_id();
                        redirect(admin_url('salary/salary_preview/'.$log_id));
                    }
                }else{
                    manage_advance_salary($staff_id);
                    //update_convenience_status($staff_id,$month,$year);

                    if($loan > 0){
                        manage_loan_installment($staff_id,$loan);
                    }

                    $delete_last = $this->home_model->delete('tblsalarypaidlog', array('staff_id'=>$staff_id,'month'=>$month,'year'=>$year));

                    $ad_data = array(
                                'staff_id' => $staff_id,
                                'month' => $month,
                                'year' => $year,
                                'net_salary' => $net_salary,
                                'loan' => $loan,
                                'advance' => $advance,
                                //'expense' => $expense,
                                'paid_leave' => $paid_leave,
                                'leave' => $leave,
                                'present_days' => $present_days,
                                'half_days' => $half_days,
                                'month_day' => $month_day,
                                'gross_salary' => $gross_salary,
                                'bacis_salary' => $bacis_salary,
                                'pf_amt' => $pf_amt,
                                'esic_amt' => $esic_amt,
                                'pt_amt' => $pt_amt,
                                'ta_amt' => $ta_amt,
                                'medical_amt' => $medical_amt,
                                'hra_amt' => $hra_amt,
                                'uniform_amt' => $uniform_amt,
                                'other_amt' => $other_amt,
                                'overtime_amt' => $overtime_amt,
                                'arrear_amt' => $arrear_amt,
                                'incentive_amt' => $incentive_amt,
                                'rent_amt' => $rent_amt,
                                'tds_amt' => $tds_amt,
                                'lockDownDeduction_amt' => $lockDownDeduction_amt,
                                'outstanding_amt' => $outstanding_amt,
                                'create_at' => $paid_date,
                                'status' => 1
                            );
                            if ($net_salary < 0){
                               $ad_data["is_outstanding"] = 1;
                            }
                    $insert = $this->home_model->insert('tblsalarypaidlog', $ad_data);

                    if($insert == true){
                        $log_id = $this->db->insert_id();
                        $this->home_model->update("tblsalarypaidlog", array("is_outstanding"=> 0), array("id !=" => $log_id));
                        
                        /* this section use for store TDS Deduction */
                        if ($tds_amt > 0){

                            $party_name = get_employee_fullname($staff_id);
                            $pan_card_no = get_staff_info($staff_id)->pan_card_no;
                            $tds_data["addedby"] = get_staff_user_id();
                            $tds_data["party_id"] = $staff_id;
                            $tds_data["party_name"] = $party_name;
                            $tds_data["rel_type"] = 3;
                            $tds_data["rel_id"] = $log_id;
                            $tds_data["taxable_amount"] = $net_salary;
                            $tds_data["tds_amount"] = $tds_amt;
                            $tds_data["pan_no"] = $pan_card_no;
                            $tds_data["date"] = $paid_date;
                            $tds_data["created_at"] = date("Y-m-d h:i:s");
                            $this->home_model->insert("tbltdsdeduction", $tds_data);
                        }

                        /* this section use for store PF deduction */
                        if ($pf_amt > 0){
                            
                            $all_allownce = ($ta_amt+$medical_amt+$uniform_amt+$other_amt+$bacis_salary);
                            $pf_admin = (0.5 / 100) * $all_allownce;
                            if($pf_admin > '75'){
                                $pf_admin = '75';
                            }
                            $party_name = get_employee_fullname($staff_id);
                            $pf_data["added_by"] = get_staff_user_id();
                            $pf_data["employee_id"] = $staff_id;
                            $pf_data["month"] = $month;
                            $pf_data["year"] = $year;
                            $pf_data["paidlog_id"] = $log_id;
                            $pf_data["employee_contribution"] = $pf_amt;
                            $pf_data["employer_contribution"] = $pf_amt;
                            $pf_data["pf_admin"] = $pf_admin;
                            $pf_data["pf_edli"] = $pf_admin;
                            $pf_data["contribution_for"] = '1';
                            $pf_data["created_at"] = date("Y-m-d h:i:s");
                            $this->home_model->insert("tblemployee_pf_esic_deduction", $pf_data);
                        }

                        /* this section use for store ESIC deduction */
                        if ($esic_amt > 0){
                            
                            $employer_contribut_amt = ($gross_salary*3.25)/100;
                            $party_name = get_employee_fullname($staff_id);
                            $esic_data["added_by"] = get_staff_user_id();
                            $esic_data["employee_id"] = $staff_id;
                            $esic_data["month"] = $month;
                            $esic_data["year"] = $year;
                            $esic_data["paidlog_id"] = $log_id;
                            $esic_data["employee_contribution"] = $esic_amt;
                            $esic_data["employer_contribution"] = $employer_contribut_amt;
                            $esic_data["pf_admin"] = '0';
                            $esic_data["pf_edli"] = '0';
                            $esic_data["contribution_for"] = '2';
                            $esic_data["created_at"] = date("Y-m-d h:i:s");
                            $this->home_model->insert("tblemployee_pf_esic_deduction", $esic_data);
                        }

                        /* this section use for store PT deduction */
                        if ($pt_amt > 0){
                            
                            $party_name = get_employee_fullname($staff_id);
                            $pt_data["added_by"] = get_staff_user_id();
                            $pt_data["employee_id"] = $staff_id;
                            $pt_data["month"] = $month;
                            $pt_data["year"] = $year;
                            $pt_data["paidlog_id"] = $log_id;
                            $pt_data["employee_contribution"] = '0.00';
                            $pt_data["employer_contribution"] = '0.00';
                            $pt_data["pf_admin"] = '0.00';
                            $pt_data["pf_edli"] = '0.00';
                            $pt_data["pt_amount"] = $pt_amt;
                            $pt_data["contribution_for"] = '3';
                            $pt_data["created_at"] = date("Y-m-d h:i:s");
                            $this->home_model->insert("tblemployee_pf_esic_deduction", $pt_data);
                        }

                        if(!empty($print)){
                            redirect(admin_url('salary/salary_print/'.$log_id));
                        }else{
                            redirect(admin_url('salary_new?page='.$pagetype));
                        }
                    }
                }
            }

            $data['title'] = 'Salary Details';
            if ($pagetype == "taxable"){
                $this->load->view('admin/salary/salary_details', $data);
            }else{
                $this->load->view('admin/salary/nonpayable_details', $data);
            }
        }else{
            access_denied('salary_new?page='.$pagetype);
        }
    }

    /* this function use for attendance */
    public function mark_attendance() {
        check_permission(103,'view');
        $data['att_date'] = date("Y-m-d");
        $data["page"] = (!empty($_GET["page"])) ? $_GET["page"] : "taxable";
        // $where = "active = 1 and taxable = 1 and joining_date <= '" . date("Y-m-d") . "'";
        // $where2 = "active = 1 and taxable = 2 and joining_date <= '" . date("Y-m-d") . "'";

        if ($this->input->post()) {
            extract($this->input->post());
            /*echo '<pre/>';
            print_r($_POST);
            die;*/
            if (!empty($date)) {
                $data['s_date'] = $date;
                $date = str_replace("/", "-", $date);
                $att_date = date("Y-m-d", strtotime($date));
                $data['att_date'] = $att_date;

                // $where = "active = 1 and taxable = 1 and joining_date <= '" . $att_date . "'";
                // $where2 = "active = 1 and taxable = 2 and joining_date <= '" . $att_date . "'";
            }

            if (!empty($mark)) {
                //Adding the Attendance Record
                $date = str_replace("/", "-", $date);
                $date = date("Y-m-d", strtotime($date));

                if (!empty($staff_id)) {
                    foreach ($staff_id as $id) {

                        $delete_record = $this->home_model->delete('tblstaffattendance', array('staff_id' => $id, 'date' => $date), '');
                        $status = $_POST['status_'.$id];
                        $approved_by = $_POST['approved_by_'.$id];
                        $updated_at = $_POST['updated_at_'.$id];
                        $marked_at = $_POST['marked_at_'.$id];
                        $by_biomax = $_POST['by_biomax_'.$id];

                        if ($status == 5) {
                            $working_to = $_POST['working_to_' . $id];

                            $staff_info = $this->home_model->get_row('tblstaff', array('staffid' => $id), '');
                            $work_to = $staff_info->working_to;

                            if (!empty($work_to)) {
                                $time1 = strtotime($work_to);
                                $time2 = strtotime($working_to);
                                $extra_hours = round(abs($time2 - $time1) / 3600, 2);
                            } else {
                                $extra_hours = 0;
                            }
                        } else {
                            $extra_hours = 0;
                            $working_to = '';
                        }

                        $ad_data = array(
                            'staff_id' => $id,
                            'date' => $date,
                            'status' => $status,
                            'working_to' => $working_to,
                            'extra_hours' => $extra_hours,
                            'approved_by' => $approved_by,
                            'updated_at' => $updated_at,
                            'marked_at' => $marked_at,
                            'by_biomax' => $by_biomax,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $insert = $this->home_model->insert('tblstaffattendance', $ad_data);
                    }
                }
                if ($insert == true) {
                    set_alert('success', 'Attendance Marked Successfully');
                    redirect(admin_url('Salary_new/mark_attendance'));
                } else {
                    set_alert('warning', 'Fail Mark Attendance');
                    redirect(admin_url('Salary_new/mark_attendance'));
                }
            }
        }

        $data['staff_list'] = array();
        $staffdesignation_id = get_staff_info(get_staff_user_id())->designation_id;
        if (is_admin() == 1 || $staffdesignation_id == 4) {
            $branch_info = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
            if (!empty($branch_info)){
                foreach ($branch_info as $binfo) {
                    $where = "(active = 1 OR relieving_date >= '" . $data['att_date'] . "') AND joining_date <= '" . $data['att_date'] . "' AND reporting_branch_id =".$binfo->id;
                    // $where .= " and FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                    // $where2 .= " and FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                    $data['staff_list']["taxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 1 AND " . $where . " ")->result();
                    $data['staff_list']["nontaxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 2 AND " . $where . " ")->result();
                }
            }

        }else if(is_admin() != 1){

            $branch_ids = get_staff_info(get_staff_user_id())->bm_branch_id;
            if ($branch_ids != 0){
                $branch = explode(",", $branch_ids);
                foreach ($branch as $b_id) {
                    $where = "(active = 1 OR relieving_date >= '" . $data['att_date'] . "') AND joining_date <= '" . $data['att_date'] . "' AND staffid !=".get_staff_user_id()." AND reporting_branch_id =".$b_id;
                    // $where .= " and staffid !=".get_staff_user_id()." and FIND_IN_SET('".$b_id."', reporting_branch_id)";
                    // $where2 .= " and staffid !=".get_staff_user_id()." and FIND_IN_SET('".$b_id."', reporting_branch_id)";
                    $data['staff_list']["taxable"][$b_id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 1 AND " . $where . " ")->result();
                    $data['staff_list']["nontaxable"][$b_id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 2 AND " . $where . " ")->result();
                }
            }else if(empty($data['staff_list'])) {

                $branch_info = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
                if (!empty($branch_info)){
                    foreach ($branch_info as $binfo) {

                        $where = "(active = 1 OR relieving_date >= '" . $data['att_date'] . "') AND joining_date <= '" . $data['att_date'] . "' AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND reporting_branch_id =".$binfo->id;
                        // $where .= " AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                        // $where2 .= " AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                        $data['staff_list']["taxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 1 AND " . $where . " ")->result();
                        $data['staff_list']["nontaxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE taxable = 2 AND " . $where . " ")->result();
                    }
                }
            }
        }

        $data['title'] = 'Mark Attendance';
        $this->load->view('admin/salary_new/mark_attendance', $data);
    }

    public function get_paid_salary_details(){
        if($_POST){
            $log_id = $this->input->post("log_id");
            $salary_info = $this->home_model->get_row('tblsalarypaidlog', array('id'=>$log_id), '');
            if (!empty($salary_info)){

                if ($salary_info->acceptance == 1){
                    $acls = "bg-success";
                    $name = get_employee_fullname($salary_info->acceptance_by);
                    $acceptance = "Done By - [".$name." - ".$salary_info->acceptance_date."]";
                    $color = "color: #4dff1a;";
                }else{
                    $acls = "bg-panding";
                    $acceptance = "Pending";
                    $color = "color: #ffed4b;";
                }
                $payfile_data = $this->db->query("SELECT `utr_no`, `utr_date` FROM `tblbankpaymentdetails` WHERE `pay_type`='employee_salary' and `pay_type_id`='".$log_id."'")->row();
                $issuedate = (!empty($payfile_data)) ? date('d/m/Y',strtotime($payfile_data->utr_date)) : "--";
                echo '<div class="panel-body">
                        <div class="col-md-3"><stroge>Issue Date: </stroge></div>
                        <div class="col-md-9">'. $issuedate.'</div>
                      </div>
                      <div class="panel_s">
                        <div class="panel-body '.$acls.'">
                            <h3>Acceptance</h3>
                            <p style="font-size:20px;'.$color.'">'.$acceptance.'</p>
                        </div>
                    </div>';


                if ($salary_info->payfile_done == 1 && !empty($payfile_data) && !empty($payfile_data->utr_no)){
                    $utr_no = (!empty($payfile_data)) ? $payfile_data->utr_no." - ".$payfile_data->utr_date : "";
                    $pcls = "bg-success";
                    $payfile = "Done [UTR NO: ".$utr_no."]</span>";
                    $color = "color: #4dff1a;";
                }else{
                    $pcls = "bg-panding";
                    $payfile = "Pending";
                    $color = "color: #ffed4b;";
                }
                echo '<div class="panel_s">
                        <div class="panel-body '.$pcls.'">
                            <h3>Payfile</h3>
                            <p style="font-size:20px;'.$color.'">'.$payfile.'</p>
                        </div>
                    </div>';
            }
        }
    }

    /* this is function use for get months according to year */
    public function getmonths(){
    ?>
        <option value="" disabled selected >--Select One-</option>
    <?php
        $year_id = $this->input->get("year_id");
        if ($year_id < date("Y")){
            $month_info = $this->home_model->get_result('tblmonths', '', '');
            if (!empty($month_info)) {
                foreach ($month_info as $row) {
            ?>
                    <option value="<?php echo $row->id; ?>"><?php echo $row->month_name; ?></option>
            <?php
                }
            }
        }else{
            $month_info = $this->home_model->get_result('tblmonths', array('id <=' => date("m")), '');
            if (!empty($month_info)) {
                foreach ($month_info as $row) {
            ?>
                    <option value="<?php echo $row->id; ?>" ><?php echo $row->month_name; ?></option>
            <?php
                }
            }
        }
    }

    /* this function use for get salary details */
    public function getSalaryDetails(){
        $data["page"] = (!empty($_GET["page"])) ? $_GET["page"] : "taxable";
        $data['month'] = (!empty($_GET["month"])) ? $_GET["month"] : date("m",strtotime("-1 month"));
        $data['year'] = (!empty($_GET["year"])) ? $_GET["year"] : date("Y",strtotime("-1 month"));

        if ($this->input->post()) {
            extract($this->input->post());

            if(!empty($month)){
                $data['month'] = $month;
            }

            if(!empty($year)){
                $data['year'] = $year;
            }
            if (!empty($salary_status)){
                $data['salary_status'] = $salary_status;
            }
            if (!empty($location_id)){
                $data['location_id'] = $location_id;
            }
            $j_date = $year.'-'.$month.'-31';
        }else{
            $j_date = date('Y-m-d', strtotime($data['year']."-".$data['month'].'-31'));
        }
        // $where = "active = 1 AND taxable = 1 AND joining_date <= '" . $j_date . "'";
        // $where2 = "active = 1 AND taxable = 2 AND joining_date <= '" . $j_date . "'";

        $data['staff_list'] = array();
        if (is_admin() == 1){
            $branch_info = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
            if (!empty($branch_info)){
                foreach ($branch_info as $binfo) {

                    $where = "active = 1 AND taxable = 1 AND joining_date <= '" . $j_date . "' and reporting_branch_id =".$binfo->id;
                    $where2 = "active = 1 AND taxable = 2 AND joining_date <= '" . $j_date . "' and reporting_branch_id =".$binfo->id;
                    if (isset($data['location_id'])){
                       $where .= " and location_id =".$data['location_id'];
                       $where2 .= " and location_id =".$data['location_id'];
                    }
                    // $where2 .= " and reporting_branch_id =".$binfo->id;
                    // $where .= " and FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                    // $where2 .= " and FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                    $data['staff_list']["taxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE " . $where . " ")->result();
                    $data['staff_list']["nontaxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE " . $where2 . " ")->result();
                }
            }
        }else if (is_admin() != 1) {

            $branch_ids = get_staff_info(get_staff_user_id())->bm_branch_id;
            if ($branch_ids != 0){
                $branch = explode(",", $branch_ids);
                foreach ($branch as $b_id) {
                    $where = "active = 1 AND taxable = 1 AND joining_date <= '" . $j_date . "' AND staffid !=".get_staff_user_id()." and reporting_branch_id =".$b_id;
                    $where2 = "active = 1 AND taxable = 2 AND joining_date <= '" . $j_date . "' AND staffid !=".get_staff_user_id()." and reporting_branch_id =".$b_id;
                    if (isset($data['location_id'])){
                       $where .= " and location_id =".$data['location_id'];
                       $where2 .= " and location_id =".$data['location_id'];
                    }
                    // $where .= " AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$b_id."', reporting_branch_id)";
                    // $where2 .= " AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$b_id."', reporting_branch_id)";
                    $data['staff_list']["taxable"][$b_id] = $this->db->query("SELECT * FROM `tblstaff` WHERE " . $where . " ")->result();
                    $data['staff_list']["nontaxable"][$b_id] = $this->db->query("SELECT * FROM `tblstaff` WHERE " . $where2 . " ")->result();
                }
            }else if(empty($data['staff_list'])) {

                $branch_info = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
                if (!empty($branch_info)){
                    foreach ($branch_info as $binfo) {
                        $where = "active = 1 AND taxable = 1 AND joining_date <= '" . $j_date . "' AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND reporting_branch_id =".$binfo->id;
                        $where2 = "active = 1 AND taxable = 2 AND joining_date <= '" . $j_date . "' AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." reporting_branch_id =".$binfo->id;
                        if (isset($data['location_id'])){
                           $where .= " and location_id =".$data['location_id'];
                           $where2 .= " and location_id =".$data['location_id'];
                        }
                        // $where .= " AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                        // $where2 .= " AND superior_id =".get_staff_user_id()." AND staffid !=".get_staff_user_id()." AND FIND_IN_SET('".$binfo->id."', reporting_branch_id)";
                        $data['staff_list']["taxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE " . $where . " ")->result();
                        $data['staff_list']["nontaxable"][$binfo->id] = $this->db->query("SELECT * FROM `tblstaff` WHERE " . $where2 . " ")->result();
                    }
                }
            }
        }

        $monthName = value_by_id("tblmonths", $data['month'], "month_name");

        $data['title'] = 'Salary Details ('.$monthName.'-'.$data['year'].')';
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='22'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status' => 1), '');
        if ($data['year'] == date("Y")){
            $data['month_info'] = $this->home_model->get_result('tblmonths', array('id <=' => date("m")), '');
        }else{
            $data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
        }
        $data['location_info'] = $this->db->query('SELECT * FROM tbllocationmaster WHERE status = 1')->result_array();
        $data['allStaffdata'] = $stafff;
        $this->load->view('admin/salary_new/get_salary_details', $data);
    }


    public function getAdvanceSalaryDetails() {


        if(!empty($_POST)){
            extract($this->input->post());
            $payment_info = $this->db->query("SELECT * FROM `tblrequests` where addedfrom = '".$staff_id."' and confirmed_by_user = 1 and receive_status = 1 and is_taken = 0 and approved_status = 1 and category = 1 and cancel = 0 and date >= ".date('Y-m-1'))->result();
            ?>
            <div class="row">
                            <div class="col-md-12">
                            </div>
                             <hr/>
                            <div class="col-md-12">
                            <div style="overflow-x:auto !important;">
                                <div class="form-group" >
                                    <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                        <thead>
                                            <tr>
                                                <th>S.No.</th>
                                                <th>Added By</th>
                                                <th>Date</th>
                                                <th>Reason</th>
                                                <th>Amount</th>
                                                <th>Approved By</th>

                                            </tr>
                                        </thead>
                                        <tbody>
                                        <?php
                                        if(!empty($payment_info)){
                                            $i = 1;
                                            foreach ($payment_info as $key => $value) {

                                                    $approval_info = $this->db->query("SELECT * FROM `tblrequestapproval` where request_id = '".$value->id."' and approve_status = 1")->row();
                                                    $approved_by = '--';
                                                    if(!empty($approval_info)){
                                                        $approved_by = get_employee_name($approval_info->staff_id);
                                                    }
                                                ?>
                                                <tr>
                                                    <td><?php echo $i++;?></td>
                                                    <td><?php echo ($value->addedby > 0) ?  get_employee_name($value->addedby) : get_employee_name($value->addedfrom) ; ?></td>
                                                    <td><?php echo _d($value->date); ?></td>
                                                    <td><?php echo $value->reason; ?></td>
                                                    <td><?php echo $value->approved_amount; ?></td>
                                                    <td><?php echo $approved_by; ?></td>
                                                </tr>
                                                <?php
                                            }
                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                        }
                                        ?>
                                        </tbody>
                                    </table>
                                </div>
                            </div>
                            </div>
                        </div>

            <?php

        }


    }


    //To check whether any payslip pending of Active Employees for period Apr 21 to Jul 22
    public function checkPayslipStatus() {
        for ($i=4; $i <=12 ; $i++) { 
            $date = '2021-'.$i.'-01';
           $staff_info = $this->db->query("SELECT staffid,firstname FROM `tblstaff` WHERE active = 1 and reporting_branch_id > 0 AND joining_date <= '".$date."' ")->result();
           if(!empty($staff_info)){
                echo  value_by_id("tblmonths", $i, "month_name").' (2021)<br><br>';
                foreach ($staff_info as $staff) {
                     $paid_info = $this->db->query("SELECT * FROM `tblsalarypaidlog` WHERE status = 1 AND staff_id = '".$staff->staffid."' and month = '".$i."' and year = 2021 ")->row();
                     if(empty($paid_info)){
                        echo $staff->firstname.' <br>';
                     }
                }
                echo '<br/><br/>';
           }
        }

        for ($i=1; $i <=7 ; $i++) { 
            $date = '2022-'.$i.'-01';
           $staff_info = $this->db->query("SELECT staffid,firstname FROM `tblstaff` WHERE active = 1 and reporting_branch_id > 0 AND joining_date <= '".$date."' ")->result();
           if(!empty($staff_info)){
                echo  value_by_id("tblmonths", $i, "month_name").' (2022)<br><br>';
                foreach ($staff_info as $staff) {
                     $paid_info = $this->db->query("SELECT * FROM `tblsalarypaidlog` WHERE status = 1 AND staff_id = '".$staff->staffid."' and month = '".$i."' and year = 2022 ")->row();
                     if(empty($paid_info)){
                        echo $staff->firstname.' <br>';
                     }
                }
                echo '<br/><br/>';
           }
        }

    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Salary_cron extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
        update_option('cron_has_run_from_cli', 1);
        $this->load->model('home_model');
    }

    /* this function  use for generate salary */
    public function generate_salary(){

        $month = (!empty($_GET["month"])) ? $_GET["month"] : date("m");
        $year = (!empty($_GET["year"])) ? $_GET["year"] : date("Y");

        $j_date = date('Y-m-') . '31';

        $staff_list = $this->db->query("SELECT * FROM `tblstaff` WHERE active = 1 and joining_date <= '" . $j_date . "'")->result();
        if (!empty($staff_list)){

            foreach ($staff_list as $value) {

                $loan_amt = get_loan_installment($value->staffid);
                $advance_amt = get_staff_advance_salary($value->staffid);
                $gross_salary = get_staff_net_salary($value->staffid,$month,$year);
                $bacis_salary = (50*$gross_salary/100);

                //Calculate Other Allownce -- getting 80% of ctc
                $g_salary = get_staff_gross_salary($value->staffid,$month,$year);

                $ctc_80 = (82*$gross_salary/100);
                $other_amt  = ($g_salary - $ctc_80);
                $payable_expense = convenience_balance($value->staffid,$month,$year);

                //ESIC
                $esic_amt = '0';
                if ($value->taxable == 1){
                    if($g_salary > '21000'){
                        $esic_amt = '0';
                    }else{
                        $esic_amt = get_salary_deduction(2,$g_salary);
                    }
                }

                //PT
                $pt_amt = '0';
                if($value->staffid != 1 && $value->staffid != 26){
                    $gender = $value->gender;
                    if($gender == 1){
                        if($g_salary < '7500'){
                            $pt_amt = '0';
                        }elseif($g_salary >= '7500' && $g_salary <= '10000'){
                            $pt_amt = '175';
                        }elseif($g_salary > '10000'){
                            $pt_amt = ($month == '02') ? '300' : '200';
                        }
                    }else{
                        if($g_salary < '10000'){
                            $pt_amt = '0';
                        }elseif($g_salary > '10000'){
                            $pt_amt = ($month == '02') ? '300' : '200';
                        }
                    }
                }

                //Getting Earning Master
                $ta_amt = get_salary_earning(4,$gross_salary);
                $medical_amt = get_salary_earning(5,$gross_salary);
                $hra_amt = get_salary_earning(6,$gross_salary);
                $uniform_amt = get_salary_earning(7,$gross_salary);

                //New pf logic
                $pf_amt = '0';
                $all_allownce = ($ta_amt+$medical_amt+$uniform_amt+$other_amt+$bacis_salary);
                if ($value->taxable == 1){
                    $pf_amt = get_salary_deduction(1,$all_allownce);
                    if($pf_amt > '1800'){
                        $pf_amt = '1800';
                    }
                }
                $outstanding_amt = get_outstanding_amount($value->staffid);
                $d_amnt = ($advance_amt+$loan_amt+$pf_amt+$esic_amt+$pt_amt+$outstanding_amt);
                $e_amnt = ($bacis_salary+$ta_amt+$medical_amt+$hra_amt+$uniform_amt+$other_amt);
                $net_salary = ($e_amnt-$d_amnt);

                /* this is for check record exist or not */
                $check_log = $this->db->query("SELECT `id` FROM `tbltempstaffsalarylog` WHERE staff_id=".$value->staffid." AND month=".$month." AND year=".$year." ")->row();
                if (!empty($check_log)){
                    $up_data["earning_amount"] = $e_amnt;
                    $up_data["deduction_amount"] = $d_amnt;
                    $up_data["net_salary"] = $net_salary;
                    $up_data["gross_salary"] = $e_amnt;
                    $up_data["pf"] = $pf_amt;
                    $up_data["esic"] = $esic_amt;
                    $up_data["pt"] = $pt_amt;
                    $up_data["loan"] = $loan_amt;
                    $up_data["adv"] = (!empty($advance_amt)) ? $advance_amt : 0;
                    $up_data["outstanding_amt"] = $outstanding_amt;
                    $up_data["taxable"] = $value->taxable;

                    $this->home_model->update("tbltempstaffsalarylog", $up_data, array("id" => $check_log->id));
                }else{
                    $insertdata["staff_id"] = $value->staffid;
                    $insertdata["month"] = $month;
                    $insertdata["year"] = $year;
                    $insertdata["earning_amount"] = $e_amnt;
                    $insertdata["deduction_amount"] = $d_amnt;
                    $insertdata["net_salary"] = $net_salary;
                    $insertdata["gross_salary"] = $e_amnt;
                    $insertdata["pf"] = $pf_amt;
                    $insertdata["esic"] = $esic_amt;
                    $insertdata["pt"] = $pt_amt;
                    $insertdata["loan"] = $loan_amt;
                    $insertdata["adv"] = (!empty($advance_amt)) ? $advance_amt : 0;
                    $insertdata["outstanding_amt"] = $outstanding_amt;
                    $insertdata["taxable"] = $value->taxable;
                    $insertdata["created_at"] = date("Y-m-d H:i:s");

                    $this->home_model->insert("tbltempstaffsalarylog", $insertdata);
                }
            }
        }
        echo "ok";
    }
}

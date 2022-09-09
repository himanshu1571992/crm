<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Salary extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('salary_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
		$data['month'] = date("m");	
		$data['year'] = date("Y");	
	   
	   if(is_admin() != 1){
		    access_denied('dashboard');
	   }
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
		$data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
		
		
		
        if ($this->input->post()) {
			extract($this->input->post());
			
			if(!empty($month)){
				
				$data['month'] = $month;	
			}
			
			if(!empty($year)){
				
				$data['year'] = $year;	
			}

			$j_date = $year.'-'.$month.'-31';

			if(!empty($branch_id)){
				$data['staff_list'] =  $this->db->query("SELECT * FROM `tblstaff` where active = 1 and taxable = 1 and joining_date <= '".$j_date."' and FIND_IN_SET('".$branch_id."', branch_id) ")->result();
				$data['s_branch'] = $branch_id;
			}else{

				$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and taxable = 1 and joining_date <= '".$j_date."' ")->result();
			}
			
			
			
		}else{

			$j_date = date('Y-m-').'31';
			$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and taxable = 1 and joining_date <= '".$j_date."' ")->result();
			//$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where staffid = 1  ")->result();

		}
		
         $data['title'] = 'Manage Salary';
		
        $this->load->view('admin/salary/manage_salary', $data);
    }

	
	public function salary_details($staff_id,$month,$year){
		
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
				
				//$date_str = $year.'-'.$month;	
				$att_info = get_month_attendance($staff_id,$year,$month);
				
				
				if(!empty($att_info)){
					foreach($att_info as $row){
						if($row->status == 6){
							 $paid_leave += 1 ;
							
						}elseif($row->status == 2){
							$leave += 1; 
						}elseif($row->status == 1 || $row->status == 3 || $row->status == 5 || $row->status == 4){
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
							'expense' => $expense,
							'paid_leave' => $paid_leave,
							'leave' => $leave,
							'present_days' => $present_days,
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
							'tds_amt' => $tds_amt,
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
					update_convenience_status($staff_id,$month,$year);
					
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
							'expense' => $expense,
							'paid_leave' => $paid_leave,
							'leave' => $leave,
							'present_days' => $present_days,
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
							'tds_amt' => $tds_amt,
							'create_at' => $paid_date,
							'status' => 1
						);
					
					$insert = $this->home_model->insert('tblsalarypaidlog', $ad_data);
					
					
					
					
					if($insert == true){
						$log_id = $this->db->insert_id();
						if(!empty($print)){
							redirect(admin_url('salary/salary_print/'.$log_id));	
						}else{
							redirect(admin_url('salary'));
						}	
					}
				}
				
				
			}
			
			
			$data['title'] = 'Salary Details';		
			$this->load->view('admin/salary/salary_details', $data);
		}else{
			 access_denied('salary');
		}
		
	}

	public function non_payable($id = '')
    {
		$data['month'] = date("m");	
		$data['year'] = date("Y");	
	   
	   if(is_admin() != 1){
		    access_denied('dashboard');
	   }
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
		$data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
		
		
		
        if ($this->input->post()) {
			extract($this->input->post());
			
			if(!empty($month)){
				
				$data['month'] = $month;	
			}
			
			if(!empty($year)){
				
				$data['year'] = $year;	
			}

			$j_date = $year.'-'.$month.'-31';

			if(!empty($branch_id)){
				$data['staff_list'] =  $this->db->query("SELECT * FROM `tblstaff` where active = 1 and taxable = 2 and joining_date <= '".$j_date."' and FIND_IN_SET('".$branch_id."', branch_id) ")->result();
				$data['s_branch'] = $branch_id;
			}else{

				$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and taxable = 2 and joining_date <= '".$j_date."' ")->result();
			}
			
			
			
		}else{

			$j_date = date('Y-m-').'31';
			$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active = 1 and taxable = 2 and joining_date <= '".$j_date."' ")->result();
			//$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where staffid = 1  ")->result();

		}
		
         $data['title'] = 'Manage Salary';
		
        $this->load->view('admin/salary/non_payable', $data);
    }

    public function nonpayable_details($staff_id,$month,$year){
		
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
				
				//$date_str = $year.'-'.$month;	
				$att_info = get_month_attendance($staff_id,$year,$month);
				
				
				if(!empty($att_info)){
					foreach($att_info as $row){
						if($row->status == 6){
							 $paid_leave += 1 ;
							
						}elseif($row->status == 2){
							$leave += 1; 
						}elseif($row->status == 1 || $row->status == 3 || $row->status == 5 || $row->status == 4){
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
							'expense' => $expense,
							'paid_leave' => $paid_leave,
							'leave' => $leave,
							'present_days' => $present_days,
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
							'tds_amt' => $tds_amt,
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
					update_convenience_status($staff_id,$month,$year);
					
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
							'expense' => $expense,
							'paid_leave' => $paid_leave,
							'leave' => $leave,
							'present_days' => $present_days,
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
							'tds_amt' => $tds_amt,
							'create_at' => $paid_date,
							'status' => 1
						);
					
					$insert = $this->home_model->insert('tblsalarypaidlog', $ad_data);
					
					
					
					
					if($insert == true){
						$log_id = $this->db->insert_id();
						if(!empty($print)){
							redirect(admin_url('salary/salary_print/'.$log_id));	
						}else{
							redirect(admin_url('salary/non_payable'));
						}	
					}
				}
				
				
			}
			
			
			$data['title'] = 'Salary Details';		
			$this->load->view('admin/salary/nonpayable_details', $data);
		}else{
			 access_denied('salary');
		}
		
	}
	
	
	public function salary_preview($id='')
    {
		if(!empty($id)){
			
			$data['salary_info'] = $this->home_model->get_row('tblsalarypaidlog', array('id'=>$id), '');
			
			if(!empty($data['salary_info'])){
			$data['staff_info'] = get_employee_info($data['salary_info']->staff_id);
			
			
			
				$data['title'] = 'Salary Print';		
				$this->load->view('admin/salary/salary_preview', $data);	
			}
			
		}		
		
	}

	public function salary_print($id='')
    {
		if(!empty($id)){
			
			$data['salary_info'] = $this->home_model->get_row('tblsalarypaidlog', array('id'=>$id), '');
			
			if(!empty($data['salary_info'])){
			$data['staff_info'] = get_employee_info($data['salary_info']->staff_id);
			
			
			
				$data['title'] = 'Salary Print';		
				$this->load->view('admin/salary/salary_print', $data);	
			}
			
		}		
		
	}
	
	
	
	public function salary_deduction()
    { 
        $data['title'] = 'Salary Deductions';
        $this->load->view('admin/salary/manage_deduction', $data);

    }
	
	
	public function add_deduction($id = '') {
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->salary_model->add_deduction($unit_data);
                if ($id) {
					
                    set_alert('success', _l('added_successfully', 'Salary Deduction'));
                    redirect(admin_url('salary/salary_deduction'));
                }
            } else {

                $success = $this->salary_model->update_deduction($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Salary Deduction'));
                }

				
                redirect(admin_url('salary/salary_deduction'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'deduction');
        } else {
            $data['tenue'] = (array) $this->salary_model->get_deduction($id);
            $title = _l('edit', 'deduction');
        }

        $data['title'] = $title;
        $this->load->view('admin/salary/add_deduction', $data);
    }
	

	
	public function deduction_table() {
        $this->app->get_table_data('salary_deduction');
    }
	
	
	 public function change_deduction_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->salary_model->edit_deduction($unit_data, $id);
        }
    }
	
	public function pay_all()
    { 
        if(!empty($_POST)){
			extract($this->input->post());
			if(!empty($staffid)){
				foreach($staffid as $staff_id){
					
					$staff_info = get_employee_info($staff_id);
					$loan_amt = get_loan_installment($staff_id);
					$instalment_count = get_loan_installment_count($staff_id);
					$advance_amt = get_staff_advance_salary($staff_id);
					$gross_salary = get_staff_net_salary($staff_id,$month,$year);
					
					//Basic Salary
					//$bacis_salary = ($gross_salary/2);
					$bacis_salary = (45*$gross_salary/100);


					//Calculate Other Allownce -- getting 80% of ctc
					$g_salary = get_staff_gross_salary($staff_id,$month,$year);

					$ctc_80 = (80*$gross_salary/100);
					$other_amt  = ($g_salary - $ctc_80);
					
					$payable_expense = convenience_balance($staff_id,$month,$year);

					//New Deduction Calculation
					//PF
					/*if($bacis_salary > '15000'){
						$pf_amt = get_salary_deduction(1,$bacis_salary);
					}else{
						$pf_amt = '0';
					}

					$pf_amt = get_salary_deduction(1,$bacis_salary);
					if($pf_amt > '1800'){
						$pf_amt = '1800';
					}*/

					//ESIC
					if($g_salary > '21000'){
						$esic_amt = '0';
					}else{
						$esic_amt = get_salary_deduction(2,$g_salary);
					}

					//PT
					if($staff_id != 1 && $staff_id != 26){
						$gender = $staff_info->gender;
						if($gender == 1){
							if($g_salary < '7500'){
								$pt_amt = '0';
							}elseif($g_salary >= '7500' && $g_salary <= '10000'){
								$pt_amt = '175';
							}elseif($g_salary > '10000'){
								if($month == '02'){
									$pt_amt = '300';
								}else{
									$pt_amt = '200';
								}
							}else{
								$pt_amt = '0';
							}
						}else{
							if($g_salary < '10000'){
								$pt_amt = '0';
							}elseif($g_salary > '10000'){
								if($month == '02'){
									$pt_amt = '300';
								}else{
									$pt_amt = '200';
								}
							}else{
								$pt_amt = '0';
							}
						}
					}else{
						$pt_amt = '0';
					}
						
					

					//$net_salary = ($gross_salary-$d_amnt);

					//Getting Earning Master
					$ta_amt = get_salary_earning(4,$gross_salary);
					$medical_amt = get_salary_earning(5,$gross_salary);
					$hra_amt = get_salary_earning(6,$gross_salary);
					$uniform_amt = get_salary_earning(7,$gross_salary);
					//$other_amt = get_salary_earning(8,$gross_salary);

					//New pf logic
					$all_allownce = ($ta_amt+$medical_amt+$uniform_amt+$other_amt+$bacis_salary);
					$pf_amt = get_salary_deduction(1,$all_allownce);
					if($pf_amt > '1800'){
						$pf_amt = '1800';
					}

					$d_amnt = ($payable_expense+$advance_amt+$loan_amt+$pf_amt+$esic_amt+$pt_amt);

					$e_amnt = ($bacis_salary+$ta_amt+$medical_amt+$hra_amt+$uniform_amt+$other_amt);

					$net_salary = ($e_amnt-$d_amnt);


					
					
					
					if(!empty($loan_amt)){ $loan = $loan_amt; }else{ $loan = '0.00';}
					if(!empty($advance_amt)){ $advance = $advance_amt; }else{ $advance = '0.00';}
					if(!empty($payable_expense)){ $expense = $payable_expense; }else{ $expense = '0.00';}
					
					
					//Add Salary Log Entries
					$month_day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
					$paid_leave = 0;
					$leave = 0;
					$present_days = 0;
					
					//$date_str = $year.'-'.$month;	
					$att_info = get_month_attendance($staff_id,$year,$month);

					
					if(!empty($att_info)){
						foreach($att_info as $row){
							if($row->status == 6){
								$paid_leave += 1 ;
							}elseif($row->status == 2){
								$leave += 1; 
							}elseif($row->status == 1 || $row->status == 3 || $row->status == 5 || $row->status == 4){
								$present_days += 1; 
							}
						}
					}
					
					if(empty($loan)){
						$loan = 0;
					}
					
					
					
					manage_advance_salary($staff_id);
					update_convenience_status($staff_id,$month,$year);
					
					if($loan > 0){
						manage_loan_installment($staff_id,$loan);
					}
					
					$delete_last = $this->home_model->delete('tblsalarypaidlog', array('staff_id'=>$staff_id,'month'=>$month,'year'=>$year));	
					
					
					$paid_date = date('Y-m-d');
					
					$ad_data = array(
							'staff_id' => $staff_id,
							'month' => $month,
							'year' => $year,
							'net_salary' => $net_salary,
							'loan' => $loan,
							'advance' => $advance,
							'expense' => $expense,
							'paid_leave' => $paid_leave,
							'leave' => $leave,
							'present_days' => $present_days,
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
							'overtime_amt' => 0,
							'tds_amt' => 0,
							'create_at' => $paid_date,
							'status' => 1
						);
					
					$insert = $this->home_model->insert('tblsalarypaidlog', $ad_data);
				
				}
				
				if($insert){
					set_alert('success', 'Salary Paid Successfully');
					redirect(admin_url('salary'));
				}
				
			}
			
		}
		

    }


    public function paid_salary_report($id='')
    {
		$data['title'] = 'Paid Salary Report';
		$data['month_info'] = $this->home_model->get_result('tblmonths', '', '');


		$this->load->view('admin/salary/paid_salary_report', $data);		
		
	}

    public function paid_salary_print($id='')
    {
		$data['title'] = 'Paid Salary Report';	

		if(!empty($_POST)){
			extract($this->input->post());
			
			$data['paid_info'] = get_paid_salary($year,$month,$type);	
	
			$data['year'] = $year;
			$data['month'] = $month;		
			if($type == 1){
				$this->load->view('admin/salary/salary_account_print', $data);					
			}elseif($type == 2){
				$this->load->view('admin/salary/personal_account_print', $data);					
			}elseif($type == 3){
				$this->load->view('admin/salary/cash_print', $data);					
			}


		}				
		
	}



	public function export_report($id='')
    {
		$data['title'] = 'Paid Salary Report';
		$data['month_info'] = $this->home_model->get_result('tblmonths', '', '');

		if(!empty($_POST)){
			extract($this->input->post());

			if($type == 1){

				$fileName = 'salary-'.$month.'-'.$year.'.xlsx';  

				$this->load->library('excel');

				
				$salary_info = get_paid_salary($year,$month,$type);
				

				$dateObj   = DateTime::createFromFormat('!m', $month);
				$monthName = $dateObj->format('F'); // March

				$objPHPExcel = new PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);


				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:U1');
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:U2');
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Month : '.$monthName.'');



				// set Header
				$objPHPExcel->getActiveSheet()->SetCellValue('A3', 'Sr.No.');
				$objPHPExcel->getActiveSheet()->SetCellValue('B3', 'Account Number');
				$objPHPExcel->getActiveSheet()->SetCellValue('C3', 'Employee Name');      
				$objPHPExcel->getActiveSheet()->SetCellValue('D3', 'Net Salary');       
				// set Row
				$rowCount = 4;
				$i = 1;
				foreach ($salary_info as $val) 
				{
				   

				    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
				    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $val->account_no);
				    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, strtoupper($val->firstname));
				    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $val->net_salary);
				    
				    $i++;
				    $rowCount++;
				}

				$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
				$objWriter->save($fileName);
				// download file
				header("Content-Type: application/vnd.ms-excel");
				redirect(site_url().$fileName); 

			}else{
				//Excel Export
				// create file name
				$fileName = 'salary-'.$month.'-'.$year.'.xlsx';  
				// load excel library
				$this->load->library('excel');

				
				$salary_info = $this->db->query("SELECT sp.*, e.gender,e.payment_mode,e.firstname,e.account_no,e.monthly_salary FROM `tblsalarypaidlog` as sp LEFT JOIN tblstaff as e ON sp.staff_id = e.staffid  WHERE sp.month='".$month."' and sp.year='".$year."' and sp.status='1' ")->result();	
				

				$dateObj   = DateTime::createFromFormat('!m', $month);
				$monthName = $dateObj->format('F'); // March

				$objPHPExcel = new PHPExcel();
				$objPHPExcel->setActiveSheetIndex(0);


				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:U1');
				$objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:U2');
				$objPHPExcel->getActiveSheet()->setCellValue('A2', 'Month : '.$monthName.'');

				$objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:U3');
				$objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


				// set Header
				$objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
				$objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Account Number');
				$objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Employee Name');
				$objPHPExcel->getActiveSheet()->SetCellValue('D4', 'M/F');
				$objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Gross Salary fixed');       
				$objPHPExcel->getActiveSheet()->SetCellValue('F4', 'No of days Worked');       
				$objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Basic');       
				$objPHPExcel->getActiveSheet()->SetCellValue('H4', 'HRA');       
				$objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Conv. Allowance');       
				$objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Medical Allowance');       
				$objPHPExcel->getActiveSheet()->SetCellValue('K4', 'Uniform Allowance');       
				$objPHPExcel->getActiveSheet()->SetCellValue('L4', 'Other Allowance');       
				$objPHPExcel->getActiveSheet()->SetCellValue('M4', 'Gross Salary Earned');       
				$objPHPExcel->getActiveSheet()->SetCellValue('N4', 'PF Deduction');       
				$objPHPExcel->getActiveSheet()->SetCellValue('O4', 'ESIC Deduction');       
				$objPHPExcel->getActiveSheet()->SetCellValue('P4', 'PT Deduction');       
				$objPHPExcel->getActiveSheet()->SetCellValue('Q4', 'TDS');       
				$objPHPExcel->getActiveSheet()->SetCellValue('R4', 'Loan');       
				$objPHPExcel->getActiveSheet()->SetCellValue('S4', 'Advance Salary');       
				$objPHPExcel->getActiveSheet()->SetCellValue('T4', 'Conv Deduction');       
				$objPHPExcel->getActiveSheet()->SetCellValue('U4', 'Net Salary');       
				// set Row
				$rowCount = 5;
				$i = 1;
				foreach ($salary_info as $val) 
				{
				   
				   if($val->gender == 1){
				   		$gender = 'M';
				   }else{
				   		$gender = 'F';
				   }

				   if($val->payment_mode == 3 || $val->payment_mode == 0){
				   		$ac_no = 'In Cash';
				   }else{
				   		$ac_no = $val->account_no;
				   }


				    $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
				    $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $ac_no);
				    $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, strtoupper($val->firstname));
				    $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $gender);
				    $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $val->monthly_salary);
				    $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $val->present_days);
				    $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $val->bacis_salary);
				    $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $val->hra_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $val->ta_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, $val->medical_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('K' . $rowCount, $val->uniform_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('L' . $rowCount, $val->other_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('M' . $rowCount, $val->gross_salary);
				    $objPHPExcel->getActiveSheet()->SetCellValue('N' . $rowCount, $val->pf_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('O' . $rowCount, $val->esic_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('P' . $rowCount, $val->pt_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('Q' . $rowCount, $val->tds_amt);
				    $objPHPExcel->getActiveSheet()->SetCellValue('R' . $rowCount, $val->loan);
				    $objPHPExcel->getActiveSheet()->SetCellValue('S' . $rowCount, $val->advance);
				    $objPHPExcel->getActiveSheet()->SetCellValue('T' . $rowCount, $val->expense);
				    $objPHPExcel->getActiveSheet()->SetCellValue('U' . $rowCount, $val->net_salary);
				    
				    $i++;
				    $rowCount++;
				}

				$objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
				$objWriter->save($fileName);
				// download file
				header("Content-Type: application/vnd.ms-excel");
				redirect(site_url().$fileName);   	
			}
			
			


		}


		$this->load->view('admin/salary/export_report', $data);		
		
	}


	public function advance_salary_report($id='')
    {
		$data['title'] = 'Advance Salary Report';
		$data['staff_list'] = get_staff_list();

		$data['s_staff'] = '';

		if(!empty($_POST)){
			extract($this->input->post());

			$data['s_fdate'] = $f_date;
			$data['s_tdate'] = $t_date;

			$f_date = str_replace("/","-",$f_date);
			$f_date = date("Y-m-d",strtotime($f_date));

			$t_date = str_replace("/","-",$t_date);
			$t_date = date("Y-m-d",strtotime($t_date));

			


			if(!empty($staff_id)){
				$data['s_staff'] = $staff_id;

				$data['advance_salary_info'] = $this->db->query("SELECT * FROM `tblrequests` where category = 1 and addedfrom = '".$staff_id."' and approved_status = 1 and confirmed_by_user = 1 and receive_status=1 and cancel = 0 and date between '".$f_date."' and '".$t_date."' ")->result();
			}else{
				$data['advance_salary_info'] = $this->db->query("SELECT * FROM `tblrequests` where category = 1 and approved_status = 1 and confirmed_by_user = 1 and receive_status=1 and cancel = 0 and date between '".$f_date."' and '".$t_date."' ")->result();
			}

			
		}


		$this->load->view('admin/salary/advance_salary_report', $data);		
		
	}

	public function employee_ctc($id='')
    {
		
		$data['title'] = 'Employee CTC Calculator';
		$this->load->view('admin/salary/employee_ctc', $data);			
	}


	public function ctc_print($id='')
    {
		if(!empty($_POST)){


			extract($this->input->post());	

			$other_allowance = final_other_allowance($salary);
			$data['ctc_info'] = get_ctc($salary,$other_allowance);	
			/*echo '<pre/>';
			print_r($data['ctc_info']);
			die;*/
			if(!empty($name)){
				$data['name'] = $name;
			}else{
				$data['name'] = '--';
			}
			

			$data['title'] = 'Salary Print';		
			$this->load->view('admin/salary/ctc_print', $data);	
		}
	}

}
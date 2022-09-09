<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Expense_payble extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('salary_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
		check_permission('117,227','view');	

		$data['month'] = date("m");	
		$data['year'] = date("Y");	
	   
		$data['month_info'] = $this->home_model->get_result('tblmonths', '', '');
		
		
		
        if ($this->input->post()) {
			extract($this->input->post());
			
			
			if(!empty($branch_id)){
				$data['staff_list'] = get_staff_list($branch_id);
				$data['s_branch'] = $branch_id;
			}else{
				$data['staff_list'] = get_staff_list();
			}
			
			if(!empty($month)){
				
				$data['month'] = $month;	
			}
			
			if(!empty($year)){
				
				$data['year'] = $year;	
			}
			
		}else{
			$data['staff_list'] = get_staff_list();
		}
		
         $data['title'] = 'Manage Salary';
		
        $this->load->view('admin/expense_payble/manage', $data);
    }
	

    public function pay_all()
    { 
        if(!empty($_POST)){
			extract($this->input->post());
			if(!empty($staffid)){
				foreach($staffid as $staff_id){

					
					$paid_date = str_replace("/","-",$paid_date);
					$paid_date = date("Y-m-d",strtotime($paid_date));

					$amount = $_POST['amount_'.$staff_id];

					$ad_data = array(
							'staff_id' => $staff_id,
							'amount' => $amount,
							'month' => $month,
							'year' => $year,							
							'paid_date' => $paid_date,
							'created_at' => date('Y-m-d'),
							'status' => 1
						);
					
					$insert = $this->home_model->insert('tblexpensepayble', $ad_data);
				}

				if($insert){
					set_alert('success', 'Expense Paid Successfully');
					redirect(admin_url('expense_payble'));
				}
			}
		}
	}


	public function print_payble_report($year='',$month='')
    {
		if(!empty($month) && !empty($year)){
			
			$data['month'] = $month;	
			$data['year'] = $year;	

			$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
			$date_1 = $year.'-'.$month.'-01';
			$date_2 = $year.'-'.$month.'-'.$day;

			$data['from_date'] = date('Y-m-d',strtotime($date_1));
			$data['to_date'] = date('Y-m-d',strtotime($date_2));

			$data['staff_list'] = get_staff_list();
		
			$data['title'] = 'Expense Payble Print';		
			$this->load->view('admin/expense_payble/print_payble_report', $data);
		
		}		
		
	}

	public function print_extra_report($year='',$month='')
    {
		if(!empty($month) && !empty($year)){
			
			$data['month'] = $month;	
			$data['year'] = $year;	

			$day = cal_days_in_month(CAL_GREGORIAN,$month,$year);
			$date_1 = $year.'-'.$month.'-01';
			$date_2 = $year.'-'.$month.'-'.$day;

			$data['from_date'] = date('Y-m-d',strtotime($date_1));
			$data['to_date'] = date('Y-m-d',strtotime($date_2));

			$data['staff_list'] = get_staff_list();
		
			$data['title'] = 'Expense Payble Print';		
			$this->load->view('admin/expense_payble/print_extra_report', $data);
		
		}		
		
	}
	
	

}
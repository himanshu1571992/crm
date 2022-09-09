<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Expenses extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
                
		$this->load->model('expenses_model');
        $this->load->model('home_model');
		
    }

   
	public function expense_print($id = '')
    {
		
        /*if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }*/
		if(!empty($_GET)){
			extract($this->input->get());
			$data['f_date'] = $f_date;
			$data['t_date'] = $t_date;
			
			$from = str_replace("/","-",$f_date);
			$data['from_date'] = date("Y-m-d",strtotime($from));
			$to = str_replace("/","-",$t_date);
			$data['to_date'] = date("Y-m-d",strtotime($to));
			
 
			$date_from = strtotime($data['from_date']); 

			$date_to = strtotime($data['to_date']); 

			$date_arr = array();
			for($i=$date_from; $i<=$date_to; $i+=86400) {  
				$date_arr[] = date("Y-m-d", $i);  
			}
			$data['date_list'] = $date_arr;
			
			$data['expense_list'] = get_expense_by_date($staff_id,$f_date,$t_date);
			
			$test = get_expense_by_parent(1);
			
			$data['staff_id'] = $staff_id;
			$this->load->view('expenses/expense_print', $data);
		}
		
		
    }
	
	public function expense_print_details($f_date,$t_date,$staff_id)
    {
		

		 if(!empty($f_date) && !empty($t_date) && !empty($staff_id)){
			
			$data['f_date'] = $f_date;
			$data['t_date'] = $t_date;
			
			$from = str_replace("/","-",$f_date);
			$data['from_date'] = date("Y-m-d",strtotime($from));
			$to = str_replace("/","-",$t_date);
			$data['to_date'] = date("Y-m-d",strtotime($to));
			
 
			$date_from = strtotime($data['from_date']); 

			$date_to = strtotime($data['to_date']); 

			$date_arr = array();
			for($i=$date_from; $i<=$date_to; $i+=86400) {  
				$date_arr[] = date("Y-m-d", $i);  
			}
			$data['date_list'] = $date_arr;
			
			$data['expense_list'] = get_expense_by_date($staff_id,$f_date,$t_date);
			
			$test = get_expense_by_parent(1);
			
			$data['staff_id'] = $staff_id;
			$this->load->view('expenses/expense_print_details', $data);
		}
		
		
    }

    public function download_pdf($f_date,$t_date,$staff_id)
    {
        if(!empty($f_date) && !empty($t_date) && !empty($staff_id)){
			require_once APPPATH.'third_party/pdfcrowd.php';
			
			
			
			$expense_list = get_expense_by_date($staff_id,$f_date,$t_date);
			
			$date_from = strtotime($f_date); 

			$date_to = strtotime($t_date); 

			$date_list = array();
			for($i=$date_from; $i<=$date_to; $i+=86400) {  
				$date_list[] = date("Y-m-d", $i);  
			}

						
			$test = get_expense_by_parent(1);
			
		
			$file_name = 'Expense_report (EMP-'.$staff_id.')';	
				
			$html = get_pdf_data($f_date,$t_date,$staff_id,$date_list);
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream($file_name);
			
		}
		
    }
	
	
}

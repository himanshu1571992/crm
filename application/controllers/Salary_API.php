<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Salary_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();   
    $this->load->model('home_model');

    }

    public function getSalaryPrint()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

       if(!empty($user_id) ){
              //$where =" staff_id = '".$user_id."' and month <= '".date('m')."' and year = '".date('Y')."' and status = 1 ";

              $where =" staff_id = '".$user_id."' and status = 1 ";

              
            /*if(!empty($year)){
              $where .= " and year='".$year."' ";

            }else{
              $year=date('yy');
              $where .= " and year = '".$year."' ";
            }*/
                
              $salary =  $this->db->query("SELECT * from tblsalarypaidlog where  ".$where." order by id desc LIMIT 6")->result();
                if(!empty($salary)){
                    foreach ($salary as  $salary_info){
                      if($salary_info->net_salary!=''){
                         $paid_slary= $salary_info->net_salary;

                        }else{ 
                        $paid_slary= '--';
                        }

                       if($salary_info->create_at!=''){
                        $paid_date= $salary_info->create_at;
                     
                        }else{ 
                        $paid_date='--'; 

                        }

                        $pdf_link = base_url('Salary_API/pdf/'.$salary_info->id);     

                        $data_arr[] = array(
                               'id'=>$salary_info->id,
                               'paid_slary' =>$paid_slary,
                               'paid_date' =>_d($paid_date),
                               'month'=>get_month($salary_info->month),
                               'year'=>$salary_info->year,
                               'pdf'=> $pdf_link
                         );
                
                    }
                   $return_arr['status'] = true;
                   $return_arr['message'] = "Success";
                   $return_arr['data'] = $data_arr;

                }else{

                 $return_arr['status'] = false;  
                 $return_arr['message'] = "Record not found!";
                 $return_arr['data'] = [];
                }

        }else{
              $return_arr['status'] = false;  
              $return_arr['message'] = "Required Parameters are missing!";
              $return_arr['data'] = [];
        }
          

        header('Content-type: application/json; charset=utf-8');
        echo json_encode($return_arr);
    }
       //http://localhost/crm/Salary_API/getSalaryPrint?user_id=&month=&year=
     public function pdf($id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';

        $salary_info = $this->db->query("SELECT * from tblsalarypaidlog where  id='".$id."'")->row();
        
        $staff_id=$salary_info->staff_id;

        $staff_info = get_employee_info($staff_id);

        $file_name = 'salary';  
        $html = salary_pdf($salary_info,$staff_info);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        // $dompdf->setPaper('A4', 'portrait');
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

         // Parameters
        $x          = 280;
        $y          = 820;
        $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
        $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
        $size       = 8;    
        $color      = array(0,0,0);
        $word_space = 0.0;
        $char_space = 0.0;
        $angle      = 0.0;

        $dompdf->getCanvas()->page_text(
          $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
        );
        
        $dompdf->stream($file_name, array("Attachment" => false));
        
        
    }

}

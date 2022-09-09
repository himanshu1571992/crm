<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Master_report_export extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function export_lead()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "enquiry_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "enquiry_date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
            }
            
        }
        $lead_list = $this->db->query("SELECT * from `tblleads` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/lead.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Lead Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Lead');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer Name');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Quotation');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Enq date');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Source');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Created'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($lead_list as $value) 
        {
            $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();

              if($value->client_branch_id > 0){
                  $company = $client_info->client_branch_name;
              }else{
                  $company = $value->company;
              }

              if(check_quotation($value->id) == 1){
                  $quotation = 'Yes';
              }else{
                  $quotation = 'No';
              }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, number_series($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $company);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $quotation);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->enquiry_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, value_by_id('tblleadssources',$value->source,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, _d($value->dateadded));
            $objPHPExcel->getActiveSheet()->SetCellValue('h' . $rowCount, get_employee_name($value->addedfrom));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function export_quotation()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
            }
            
        }
        $quotation_list = $this->db->query("SELECT * from `tblproposals` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Quotation.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Quotation Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Quotation');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Total Tax');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Total');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Date');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Open Till'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Date Created'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Status'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('J4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($quotation_list as $value) 
        {

            if ($value->status == 1) {
                $status      = _l('proposal_status_open');
            } elseif ($value->status == 2) {
                $status      = _l('proposal_status_declined');
            } elseif ($value->status == 3) {
                $status      = _l('proposal_status_accepted');
            } elseif ($value->status == 4) {
                $status      = _l('proposal_status_sent');
            } elseif ($value->status == 5) {
                $status      = _l('proposal_status_revised');
            } elseif ($value->status == 6) {
                $status      = _l('proposal_status_draft');
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, format_proposal_number($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->subject);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->total_tax);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->total);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, _d($value->open_till));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, _d($value->datecreated));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, $status);
            $objPHPExcel->getActiveSheet()->SetCellValue('J' . $rowCount, get_employee_name($value->addedfrom));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function export_invoice()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "invoice_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "invoice_date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
            }
            
        }
        $invoice_list = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Invoice.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Invoice Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Service Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Invoice Date');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Customer');       
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Status'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($invoice_list as $value) 
        {

            if($value->service_type == 1){
              $service_type = 'Rent';
            }else{
              $service_type = 'Sales';
            }
            $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();

            if ($value->status == 1) {
                $status = _l('invoice_status_unpaid');
            } elseif ($value->status == 2) {
                $status = _l('invoice_status_paid');
            } elseif ($value->status == 3) {
                $status = _l('invoice_status_not_paid_completely');
            } elseif ($value->status == 4) {
                $status = _l('invoice_status_overdue');
            } elseif ($value->status == 5) {
                $status = _l('invoice_status_cancelled');
            } else {
                $status = _l('invoice_status_draft');
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, format_invoice_number($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $service_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->total);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->invoice_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, get_employee_name($value->addedfrom));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    } 


    public function export_challan()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $from_date = str_replace("/","-",$date_range['from_date']);
                $from_date = date("Y-m-d",strtotime($from_date));

                $to_date = str_replace("/","-",$date_range['to_date']);
                $to_date = date("Y-m-d",strtotime($to_date));

                $from_date = $from_date.' 00:00:00';
                $to_date = $to_date.' 23:59:59';

                $where = " `datecreated` >= '".$from_date."' and `datecreated` <= '".$to_date."' ";
            }else{
                $from_date = date('Y-m-d').' 00:00:00';
                $to_date = date('Y-m-d').' 23:59:59';
                $where = " `datecreated` >= '".$from_date."' and `datecreated` <= '".$to_date."' "; 
            }

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
            }
            
        }
        $challan_list = $this->db->query("SELECT * from `tblchalanmst` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Challan.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Challan Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Challan');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Service Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Staff Name');  
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($challan_list as $value) 
        {

            $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();

            $service_type = ($value->service_type == 1) ? 'Rent' : 'Sale';

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->chalanno);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $service_type);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->challandate));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, get_employee_name($value->addedfrom));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    } 
 
    public function export_debitnote()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "dabit_note_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "dabit_note_date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
            
        }
        $quotation_list = $this->db->query("SELECT * from `tbldebitnote` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Debitnote.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Debitnote Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Challan');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Date');       
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Staff Name');
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($quotation_list as $value) 
        {

            $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
            if($value->challan_id > 0){
                $challan_no = value_by_id('tblchalanmst',$value->challan_id,'chalanno');
            }else{
                $challan_no = $value->challan_number;
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->number);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $challan_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->dabit_note_date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->totalamount);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, get_employee_name($value->staff_id));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function export_debitnotepayment()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
            
        }
        $quotation_list = $this->db->query("SELECT * from `tbldebitnotepayment` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Debitnote.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Debitnote Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Customer');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Amount');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Staff Name');  
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($quotation_list as $value) 
        {

            $client_info = $this->db->query("SELECT `client_branch_name` from `tblclientbranch` where userid = '".$value->clientid."'  ")->row();
            $tt_amt = $this->db->query("SELECT COALESCE(SUM(final_amount),0) as amt from tbldebitnotepaymentitems where debitnote_id = '".$value->id."' ")->row()->amt;

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, $value->number);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $client_info->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $tt_amt);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, get_employee_name($value->staff_id));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function export_perfomainvoice()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
            }
            
        }
        $invoice_list = $this->db->query("SELECT * from `tblestimates` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Perfomainvoice.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Perfoma Invoice Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Perfoma Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Amount');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Total Tax');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Customer');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Expiry Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Status');  
        $objPHPExcel->getActiveSheet()->SetCellValue('I4', 'Staff Name');  
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($invoice_list as $value) 
        {

            $client_info = $this->db->query("SELECT * FROM `tblclientbranch` where userid = '".$value->clientid."' ")->row();
            $client_name = (!empty($client_info)) ? $client_info->client_branch_name : '--' ;

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, format_estimate_number($value->id));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->total);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $value->total_tax);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $client_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, _d($value->expirydate));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, estimate_status_by_id($value->status));
            $objPHPExcel->getActiveSheet()->SetCellValue('I' . $rowCount, get_employee_name($value->addedfrom));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }


    public function export_purchaseorder()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
            }
            
        }
        $po_list = $this->db->query("SELECT * from `tblpurchaseorder` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Purchaseorder.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Purchase Order Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Vendor');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Warehouse');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Total Amount');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Status'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($po_list as $value) 
        {

            if($value->cancel == 1){
                $status = 'Cancelled';
            }else{
                if($value->status == 0){
                $status = 'Pending';
              }elseif($value->status == 1){
                $status = 'Approved';
              }elseif($value->status == 2){
                $status = 'Rejected';
              }
            }
            

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'PO-'.$value->number);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, value_by_id('tblvendor',$value->vendor_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, value_by_id('tblwarehouse',$value->warehouse_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, $value->totalamount);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, get_employee_name($value->staff_id));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }


    public function export_mr()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
            }
            
        }
        $mr_list = $this->db->query("SELECT * from `tblmaterialreceipt` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Materialreceipt.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Purchase Order Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'MR Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'MR Type');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'PO Number');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Vendor');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Status'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($mr_list as $value) 
        {

            if($value->status == 0){
                $status = 'Pending';
                $cls = 'btn-warning';
              }elseif($value->status == 1){
                $status = 'Approved';
                $cls = 'btn-success';
              }elseif($value->status == 2){
                $status = 'Rejected';
                $cls = 'btn-danger';
              }

              $po_number = '--';
              if($value->po_id > 0){
                $purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$value->po_id."' ")->row(); 
                $po_number = 'PO-'.$purchase_info->number;
              }

              if($value->mr_for == 1){
                $type = 'Against PO';
              }elseif($value->mr_for == 2){
                $type = 'Cash';
              }elseif($value->mr_for == 3){
                $type = 'GAS';
              }
            

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'MR-'.$value->id);
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $type);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $po_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, value_by_id('tblvendor',$value->vendor_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $status);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, get_employee_name($value->staff_id));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function export_purchaseinvoice()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
            }
        }
        $invoice_list = $this->db->query("SELECT * from `tblpurchaseinvoice` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Purchaseinvoice.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Purchase Invoice Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Reference No');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Vendor');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Amount');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Invoice For'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($invoice_list as $value) 
        {            

            $invoice_for = ($value->invoice_for == 1) ? 'Purchase Order' : 'Work Order';

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Inv-'.str_pad($value->id, 4, '0', STR_PAD_LEFT));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $value->reference_number);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, value_by_id('tblvendor',$value->vendor_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->totalamount);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $invoice_for);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, get_employee_name($value->staff_id));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }

    public function export_paymentreceipt()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }
            
        }
        $payment_list = $this->db->query("SELECT * from `tblinvoicepaymentrecords` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Paymentreceipt.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Payment Receipt Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Payment');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'Invoice');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Payment Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'TDS %');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Customer');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Date'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($payment_list as $value) 
        {            

            if($value->paymentmode == 1){
              $payment_name = 'Cheque';
            }elseif($value->paymentmode == 2){
              $payment_name = 'NEFT';
            }elseif($value->paymentmode == 3){
              $payment_name = 'Cash';
            }

            $client_id = value_by_id('tblinvoices',$value->invoiceid,'clientid');

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, 'Rcpt-'.str_pad($value->id, 4, '0', STR_PAD_LEFT));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, format_invoice_number($value->invoiceid));
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $payment_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->tds);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, client_info($client_id)->client_branch_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->amount);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, _d($value->date));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }


    public function export_paymentdone()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
            
        }
        $payment_list = $this->db->query("SELECT * from `tblvendorpayment` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/Paymentdone.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Payment Done Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Vendor');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'On Behalf');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Payment Mode');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Reference No.');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Date');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Amount'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Staff Name'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($payment_list as $value) 
        {            

            if($value->payment_mode == 1){
              $payment_name = 'Cheque';
            }elseif($value->payment_mode == 2){
              $payment_name = 'NEFT';
            }elseif($value->payment_mode == 3){
              $payment_name = 'Cash';
            }

            if($value->payment_behalf == 1){
              $payment_behalf = 'On Account';
            }elseif($value->payment_behalf == 2){
              $payment_behalf = 'Against Invoice';
            }

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, value_by_id('tblvendor',$value->vendor_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $payment_behalf);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, $payment_name);
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $value->reference_no);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, $value->ttl_amt);
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, get_employee_name($value->staff_id));
            
            $i++;
            $rowCount++;
        }

        $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
        $objWriter->save($fileName);
        // download file
        header("Content-Type: application/vnd.ms-excel");
        redirect(site_url().$fileName);

    }


    public function export_expense()
    { 
        if(!empty($_GET)){
            extract($this->input->get());
            $date_range = get_date_range($range);            

            if(!empty($range)){
                $where = "approved_status = 1 and status = 1 and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            }else{
                $where = "approved_status = 1 and status = 1 and date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
            }

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
            }
            
        }
        $expense_info = $this->db->query("SELECT * from `tblexpenses` where ".$where." ORDER BY id desc ")->result();

        // create file name
        $fileName = 'export/expense.xlsx';  
        // load excel library
        $this->load->library('excel');        

        $objPHPExcel = new PHPExcel();
        $objPHPExcel->setActiveSheetIndex(0);


        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
        $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
        $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Payment Done Report');

        $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
        $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


        // set Header
        $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'Sr.No.');
        $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Date');
        $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'EXP-ID');
        $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Employee');
        $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Details');  
        $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Category');  
        $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Type'); 
        $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Amount'); 
        // set Row
        $rowCount = 5;
        $i = 1;
        foreach ($expense_info as $value) 
        {            

            if($value->parent_id > 0){
              $parent_id = $value->parent_id;
            }else{
              $parent_id = $value->id;
            }
            $expense_id = 'EXP-'.get_short(get_expense_category($value->category)).'-'.number_series($parent_id);

            $details = 'Purpose - '.get_expense_purpose($value->id).' -- '.get_expense_related($value->id);

            $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
            $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, _d($value->date));
            $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $expense_id);
            $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, get_employee_name($value->addedfrom));
            $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $details);
            $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, value_by_id('tblexpensescategories',$value->category,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, value_by_id('tblexpensetype',$value->type_id,'name'));
            $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $value->amount);
            
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

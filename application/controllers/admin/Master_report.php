<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Master_report extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('home_model');
    }

    public function lead_report()
    {  
        check_permission(212,'view');  
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "enquiry_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "enquiry_date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['lead_list'] = $this->db->query("SELECT * from `tblleads` where ".$where." ORDER BY id desc ")->result();
        $data['staff_list'] = get_staff_list();
        $data['title'] = 'Lead Report';
        $this->load->view('admin/master_report/lead_report', $data);

    }
    
    public function quotation_report()
    {   
        check_permission(212,'view'); 
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['quotation_list'] = $this->db->query("SELECT * from `tblproposals` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Quotation Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/quotation_report', $data);

    }

    public function invoice_report()
    {   
        check_permission(212,'view'); 
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "invoice_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "invoice_date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblinvoices` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Invoice Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/invoice_report', $data);

    }

   
    public function challan_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);  

            $from_date = str_replace("/","-",$date_range['from_date']);
            $from_date = date("Y-m-d",strtotime($from_date));

            $to_date = str_replace("/","-",$date_range['to_date']);
            $to_date = date("Y-m-d",strtotime($to_date));

            $from_date = $from_date.' 00:00:00';
            $to_date = $to_date.' 23:59:59';

            $where = " `datecreated` >= '".$from_date."' and `datecreated` <= '".$to_date."' ";   
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $from_date = date('Y-m-d').' 00:00:00';
            $to_date = date('Y-m-d').' 23:59:59';
            $where = " `datecreated` >= '".$from_date."' and `datecreated` <= '".$to_date."' ";  
        }

        $data['challan_list'] = $this->db->query("SELECT * from `tblchalanmst` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Challan Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/challan_report', $data);

    } 

    public function debitnote_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "dabit_note_date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "dabit_note_date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['debitnote_list'] = $this->db->query("SELECT * from `tbldebitnote` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Debit Note Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/debitnote_report', $data);

    }

    public function debitnotepyament_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['debitnote_list'] = $this->db->query("SELECT * from `tbldebitnotepayment` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Debit Note Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/debitnotepyament_report', $data);

    }

    public function perfomainvoice_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblestimates` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Perfoma Invoice Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/perfomainvoice_report', $data);

    }

    public function purchaseorder_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['purchaseorder_list'] = $this->db->query("SELECT * from `tblpurchaseorder` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Purchase Order Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/purchaseorder_report', $data);

    }

    public function mr_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['materialreceipt_list'] = $this->db->query("SELECT * from `tblmaterialreceipt` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Material Receipt Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/mr_report', $data);

    }
 
    public function purchaseinvoice_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['invoice_list'] = $this->db->query("SELECT * from `tblpurchaseinvoice` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Purchase Invoice Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/purchaseinvoice_report', $data);

    }

    public function paymentreceipt_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['payment_list'] = $this->db->query("SELECT * from `tblinvoicepaymentrecords` where ".$where." ORDER BY id desc ")->result();
        $data['title'] = 'Payment Receipt Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/paymentreceipt_report', $data);

    }   

    Public function paymentdone_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and staff_id = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['payment_list'] = $this->db->query("SELECT * from `tblvendorpayment` where ".$where." ORDER BY id desc ")->result();

        $data['title'] = 'Payment Done Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/paymentdone_report', $data);

    } 

    Public function expense_report()
    {   
        if(!empty($_POST)){
            extract($this->input->post());
            $date_range = get_date_range($range);            

            $where = "approved_status = 1 and status = 1 and date between '".$date_range['from_date']."' and '".$date_range['to_date']."' ";
            $data['range'] = $range;
            $data['f_date'] = $f_date;
            $data['t_date'] = $t_date;

            if(!empty($staff_id)){
               $where .= " and addedfrom = '".$staff_id."'";
               $data['staff_id'] = $staff_id;
            }
        }else{
            $where = "approved_status = 1 and status = 1 and date between '".date('Y-m-d')."' and '".date('Y-m-d')."' ";
        }

        $data['expense_info'] = $this->db->query("SELECT * from `tblexpenses` where ".$where." ORDER BY id desc ")->result();
        
        $data['title'] = 'Expense Report';
        $data['staff_list'] = get_staff_list();
        $this->load->view('admin/master_report/expense_report', $data);

    }    
   
}

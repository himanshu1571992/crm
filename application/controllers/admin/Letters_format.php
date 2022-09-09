<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Letters_format extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }
   
    public function index()
    {
        $data['title'] = 'Letter Format List';
        check_permission(331,'view');
        $where = " status = 1";
        if(!empty($_POST)){
            extract($this->input->post());
            
            if (!empty($lettertype_id)){
                $data["lettertype_id"] = $lettertype_id;
                
                $where .= " and lettertype_id = '".$lettertype_id."'";
            }
        }     
        $data['all_letters_types'] = $this->db->query("SELECT * FROM tbllettersformattypes ORDER BY id DESC ")->result(); 
        $data['letters_format'] = $this->db->query("SELECT * FROM tbllettersformat WHERE ".$where." ORDER BY id DESC ")->result();        
        $this->load->view('admin/letters_format/list', $data);
    }

    
    /*this function use for add letter format */
    public function add($id="")
    {
        $data['title'] = 'Add Letter Format'; 
        $data['all_letters_types'] = $this->db->query("SELECT * FROM tbllettersformattypes ORDER BY id DESC ")->result();        
        
        if(!empty($_POST)){
            extract($this->input->post());
            
            $add_data["lettertype_id"] = $lettertype_id;
            $add_data["content"] = $content;
            $add_data["updated_on"] = date('Y-m-d H:i:s');
            
            if ($id == ""){
                
                $add_data["created_on"] = date('Y-m-d H:i:s');
                $this->home_model->insert('tbllettersformat', $add_data);
                set_alert('success', 'Letter Format add Successfully');
            }else{
                
                $this->home_model->update('tbllettersformat', $add_data, array('id'=>$id));
                set_alert('success', 'Letter Format updated Successfully');
            }

            redirect(admin_url('letters_format'));
        }
        if ($id !== ""){
            check_permission(331,'edit');
            $data['title'] = 'Update Letter Format'; 
            $data['letters_format']  = $this->db->query("SELECT * FROM tbllettersformat WHERE id = '".$id."' ")->row();  
        }else{
            check_permission(331,'create');
            $data['title'] = 'Add Letter Format'; 
        }
        
        $this->load->view('admin/letters_format/add', $data);
    }
    
    /* this function use for allotted items details pdf download */
    public function download_items_pdf($id) {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            redirect(admin_url('staff'));
        }
        $staff_info = get_employee_info($id);
        
        if (empty($staff_info)) {
            redirect(admin_url('staff'));
        }
        $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
        $file_name = "Asset Handover Form - ".$employee_code;
        $html = staff_allotitems_pdf($staff_info);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }
    
    /* this function use for exprience certificate download */
    public function download_exprience_certificate($id) {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            redirect(admin_url('staff'));
        }
        $staff_info = get_employee_info($id);
        
        if (empty($staff_info)) {
            redirect(admin_url('staff'));
        }
        
        $format = $this->db->query("SELECT `content` FROM tbllettersformat WHERE lettertype_id = 1 and status = 1")->row();
        if (empty($format)){
            admin_url("staff");
        }
        $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
        $file_name = "Exprience Certificate - ".$employee_code;
        $html = staff_exprience_certificate($staff_info, $format);
//        echo $html; exit; 
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }
    
    /* this function use for intent letter download */
    public function download_intent_letter($id) {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            redirect(admin_url('staff'));
        }
        $staff_info = get_employee_info($id);
        
        if (empty($staff_info)) {
            redirect(admin_url('staff'));
        }
        
        $format = $this->db->query("SELECT `content` FROM tbllettersformat WHERE lettertype_id = 2 and status = 1")->row();
        if (empty($format)){
            admin_url("staff");
        }
        $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
        $file_name = "Intent Letter - ".$employee_code;
        $html = staff_intent_letter($staff_info, $format);
        
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }
    
    /* this function use for joining letter download */
    public function download_joining_letter($id) {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            redirect(admin_url('staff'));
        }
        $staff_info = get_employee_info($id);
        
        if (empty($staff_info)) {
            redirect(admin_url('staff'));
        }
        
        $format = $this->db->query("SELECT `content` FROM tbllettersformat WHERE lettertype_id = 3 and status = 1")->row();
        if (empty($format)){
            admin_url("staff");
        }
        $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
        $file_name = "Joining Letter - ".$employee_code;
        $html = staff_joining_letter($staff_info, $format);

        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }
    
     /* this function use for relieving letter download */
    public function download_relieving_letter($id) {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            redirect(admin_url('staff'));
        }
        $staff_info = get_employee_info($id);
        
        if (empty($staff_info)) {
            redirect(admin_url('staff'));
        }
        
        $format = $this->db->query("SELECT `content` FROM tbllettersformat WHERE lettertype_id = 4 and status = 1")->row();
        if (empty($format)){
            admin_url("staff");
        }
        $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
        $file_name = "Relieving Letter - ".$employee_code;
        $html = staff_relieving_letter($staff_info, $format);
//        echo $html;exit;
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }
    
    
    /* this function use for HR Policy download */
    public function download_hr_policy($id) {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            redirect(admin_url('staff'));
        }
        $staff_info = get_employee_info($id);
        
        if (empty($staff_info)) {
            redirect(admin_url('staff'));
        }

        $employee_code = (strpos( $staff_info->employee_id, 'SCHACH' ) !== false ) ? $staff_info->employee_id : 'SCHACH '.$staff_info->employee_id;
        $file_name = "Schach HR Policy - ".$employee_code;
        $html = hr_policy($staff_info);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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
        
        //$dompdf->stream($file_name);
        $dompdf->stream($file_name, array("Attachment" => false));
    }
}

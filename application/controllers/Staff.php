<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Staff extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->library('session');
        
    }

    public function staff_form($id = '') {

        $branch_id=$this->input->get('branch_id'); 
        $candidate_id=$this->input->get('candidate_id');
        
        if(isset($candidate_id) && !empty($candidate_id)){
            $chk_register = value_by_id_empty("tblstaffinterviewdetails", $candidate_id, "staffregistration_id");
            if(!empty($chk_register)){
                echo '<div style="background-color:#f8d7da;padding:1%;border-radius: 48px;" role="alert">
                        <p style="text-align:center;">This link has expired, kindly generate the link.</p>
                      </div>';
                exit;
            }
        }
        
        if ($this->input->post()) {
            
            $staff_data = $this->input->post();
            
                if ($id == '') { 
                   $this->load->model('Registerstaff_model');
                   $id = $this->Registerstaff_model->add($staff_data);

                    if ($id) { 
                      registered_staff_photo_attachments($id);
                      registered_staff_pan_attachments($id);
                      registered_staff_adhar_attachments($id);
                      registered_staff_qualification_attachments($id);
                      registered_staff_rel_attachments($id);
                      registered_staff_sal_attachments($id);
                   
                      //$data['alert_msg']='Successfully Added.';
                      set_alert('success', _l('added_successfully', 'Staff'));
                      redirect(site_url('Staff/registered_staff/'.$id));

                    }else{
                     set_alert('success', _l('Unsuccess', _l('staff')));

                    }
                }

        }

         $this->load->model('Designation_model');

         $this->load->model('Site_manager_model');

         $this->load->model('Registerstaff_model');

         $data['designation_data'] = $this->Designation_model->get();

         $data['relationship_data'] = $this->Registerstaff_model->getstaffrelationship();

         $data['state_data'] = $this->Site_manager_model->get_state();

         $data['allcity'] = $this->Site_manager_model->get_city();

         $data['city_data'] = array();

            if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
                    $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
            }

                if(!is_dir('./captcha_images/')){
                       mkdir('./captcha_images/','0777',true);
                }

                    $config = array('img_url'   => base_url() . 'captcha_images/',
                       'img_path'   => 'captcha_images/',
                       'img_height' => 45,
                       'word_length'=> 5,
                       'img_width'  => '200',
                       'font_size'  => 10
                    );

                        $captcha_new  = create_captcha($config); 

                        unset($_SESSION['captcha']);

                        $this->session->set_userdata('captcha', $captcha_new['word']);

                        $data['captchaImage'] = $captcha_new['image'];

                        $data['branch_id'] = $branch_id;
                        $data['candidate_id'] = $candidate_id;
                        $data['branch_info'] = $this->db->query("SELECT * from `tblcompanybranch` where status = 1 ")->result_array();
                        
                        $data['title'] = 'Staff Registration Form';

                        $this->load->view('staff/staff_form',$data);

    }

    public function registered_staff($id)
        {   
            $data['id'] = $id;
            $data['title'] = 'Employee Registration';
            $this->load->view('staff/registered_page', $data);

    }

    public function captcha_refresh(){ 
           $config = array(
            'img_url'     => base_url() . 'captcha_images/',
            'img_path'    => 'captcha_images/',
            'img_height'  => 45,
            'word_length' => 5,
            'img_width'   => '200',
            'font_size'   => 10
           );
        $captcha_new = create_captcha($config);

        unset($_SESSION['captcha']);

        $this->session->set_userdata('captcha', $captcha_new['word']);
        
        echo $captcha_new['image'];
    }

    public function get_captcha(){
        if($this->input->post()) {
           extract($this->input->post());
            
           $captcha_session = $this->session->userdata('captcha');
            if ($captcha == $captcha_session){
                 echo "correct captcha";

            }else{
                echo "wrong captcha";
            }

        }
    } 

      
   //gopla birla for employee pdf

    public function employee_pdf($id = "")
    { 
        require_once APPPATH.'third_party/pdfcrowd.php';
        if (!$id) {
            echo "Not found";
        }

        $this->load->helper('mypdf_helper');
        
        $file_name = 'Employee Registration PDF -';  

        
        $html = registeredemployee_pdf($id); 
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        $dompdf->set_option('isRemoteEnabled', true);
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

        // Parameters
        $x          = 521;
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

    //gopal birla print 

    public function employee_print($id = '') 
   {
        if ($id == '') {
            $title = _l('add_new', _l('employee_registration'));

        }else{
        $data['registeredstaff'] = $this->db->query("SELECT * FROM `tblregisteredstaff` where staffid = '".$id."' ")->result_array();

        $data['staffcontact'] = $this->db->query("SELECT * FROM `tblregistrationstafffamily` where staff_id = '".$id."' ")->result_array();
        $data['stafffile'] = $this->db->query("SELECT * FROM `tblregistrationstafffiles` where rel_id = '".$id."'")->result_array();
        }

    $data['title'] = 'Employee Registration Form';
    $this->load->view('staff/employee_print', $data);

    }


      
 
    public function get_city()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $city_info = $this->db->query("SELECT * FROM `tblcities` where state_id = '".$state_id."'")->result();
            $html = '<option value="">--Select One-</option>';
            if(!empty($city_info)){
                foreach ($city_info as $key => $value) {
                    $html .= '<option value="'.$value->id.'">'.$value->name.'</option>';  
                }
            }

            echo $html;
        }
    }

    public function residential_city()
    {
        if ($this->input->post()) {
            extract($this->input->post());
            $city_info = $this->db->query("SELECT * FROM `tblcities` where id = '".$permenent_city."'")->result();
            /*$html = '<option value="">--Select One-</option>';*/
            if(!empty($city_info)){
                foreach ($city_info as $key => $value) {
                    $html = '<option value="'.$value->id.'">'.$value->name.'</option>';  
                }
            }

            echo $html;
        }
    }

}
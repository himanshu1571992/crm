<?php

defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Vendor extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->library('session');
    }

    public function vendor_form($id = '') {
        
        if ($this->input->post()) {
            
            $vendor_data = $this->input->post();
            /*echo '<pre/>';
            print_r($vendor_data);
            die;*/
         
              $captcha = $vendor_data['captcha'];
              $captcha_session = $this->session->userdata('captcha');
              
              if ($id == '') { 
                $this->load->model('Registeredvendor_model');
                $id = $this->Registeredvendor_model->add($vendor_data);
                if ($id) 
                { 
                    registered_vendor_pan_attachments($id);
                    registered_vendor_gst_attachments($id);
                    registered_vendor_msme_attachments($id);
                    registered_vendor_iec_attachments($id);
                    registered_vendor_cin_attachments($id);
                    registered_vendor_financial_attachments($id);
                    registered_vendor_bank_attachments($id);

                    set_alert('success', _l('added_successfully', _l('vendor')));

                    redirect(site_url('Vendor/registered_vendor/'.$id));
                }
                else
                {
                  set_alert('success', _l('Unsuccess', _l('vendor')));
                }
            }

          }

        $this->load->model('Designation_model');
        $this->load->model('Site_manager_model');
        $this->load->model('Vendor_model');

        $data['business_type_data'] = $this->Vendor_model->get_business_type();
        $data['designation_data'] = $this->Designation_model->get();
        $data['state_data'] = $this->Site_manager_model->get_state();
        $data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
         if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
                $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
            }

        /*  CAPTCHA  STARTS */
        if(!is_dir('./captcha_images/'))
        {
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


        $data['title'] = 'Vendor Registration Form';
        $this->load->view('vendor/vendor_form',$data);

      }

      public function captcha_refresh()
        { 
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

        public function get_captcha()
        {
            if ($this->input->post()) {
            extract($this->input->post());
            
            $captcha_session = $this->session->userdata('captcha');
            if ($captcha == $captcha_session) 
               {
                 echo "correct captcha";
               }
               else
               {
                echo "wrong captcha";
               }

        }
        }

      public function registered_vendor($id)
        {   
            $s_r = '';    
            if(!empty($_POST)){
                extract($this->input->post());
               /* echo '<pre/>';
                print_r($_POST);
                die;*/
                $data['s_r'] = $range;
            }
            $data['id'] = $id;
            $data['title'] = 'Vendor Registration';
            $this->load->view('vendor/registered_page', $data);

        }

  public function vendor_print($id = '') 
  {
    if ($id == '') 
        {
            $title = _l('add_new', _l('vendor_registration'));
        }
    else
    {
        $data['registeredvendor'] = $this->db->query("SELECT * FROM `tblregisteredvendor` where id = '".$id."' ")->result_array();

        $data['vendorcontact'] = $this->db->query("SELECT * FROM `tblregisteredvendorcontact` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorcustomer'] = $this->db->query("SELECT * FROM `tblregisteredvendorcustomer` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorfinancial'] = $this->db->query("SELECT * FROM `tblregisteredvendorfinancials` where registeredvendor_id = '".$id."' ")->result_array();

        $data['vendorproduct'] = $this->db->query("SELECT * FROM `tblregisteredvendorproduct` where registeredvendor_id = '".$id."' ")->result_array();
    }

    $data['title'] = 'Vendor Registration Form';
    $this->load->view('vendor/vendor_print', $data);

  }

  public function vendor_pdf($id = "")
    { 
        require_once APPPATH.'third_party/pdfcrowd.php';
        if (!$id) {
            echo "Not found";
        }
        $this->load->helper('mypdf_helper');
        
        $file_name = 'Vendor Registration PDF -';  


        $html = registeredvendor_pdf($id);
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
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

  public function list($id = '') 
  {
    
    $data['vendor_list'] = $this->db->query("SELECT * from `tblregisteredvendor` order by id desc ")->result();
 
    $data['title'] = 'Vendor Registration List'; 
    $this->load->view('vendor/list', $data);

  }

  public function pdf($id='') {
     
     require_once APPPATH.'third_party/pdfcrowd.php'; 
        $this->load->model('Registeredvendor_model'); 
        $vendor = $this->Registeredvendor_model->getvendor($id);
        
        $vendor_number = $vendor->email_id; 
                               
        $file_name = $vendor_number;  

        
        $html = vendor_pdf($vendor);  
        $dompdf = new Dompdf();
        $dompdf->loadHtml($html);
        
        $dompdf->setPaper('A4', 'portrait');
        $dompdf->render();

         
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
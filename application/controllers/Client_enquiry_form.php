<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Client_enquiry_form extends CI_Controller {

    public function __construct() {
        parent::__construct();
        $this->load->library('form_validation');
        $this->load->helper('captcha');
        $this->load->model("home_model");
    }

    public function index($token = '') {
        
        $data['title'] = 'Customer Enquiry Form';
        
        $info = $this->check_token($token);
        if ($info){
            if ($this->input->post()) {
                $this->load->model("Enquirycall_model");

                $unit_data = $this->input->post();
                $update_id = $this->Enquirycall_model->add_customer_enquiry_form($info->id, $unit_data);
                if ($update_id) {
                    redirect(site_url('Client_enquiry_form/complete_step'));
                }

            }
            
            $data["cust_fields"] = $data["questions"] = [];
            $enquiry_data = $this->home_model->get_result("tblenquirycall_fromfieldsent", array("main_id" => $info->id, "status" => 1), array("*"));
            if ($enquiry_data){
                foreach ($enquiry_data as $value) {
                    
                    if ($value->field_id > 0){
                        array_push($data["questions"], $value->field_id);
                    }else{
                        array_push($data["cust_fields"], $value->field_name);
                    }
                } 
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
            $data['enquiry_id'] = $info->id;
            $data['state_data'] = $this->home_model->get_result("tblstates", array("status" => 1), array("id", "name"));
            $data['question_list'] = $this->home_model->get_result("tblquestionmaster", array("status" => 1), array("*"), array("question_order", "ASC"));
            
            $this->load->view('vendor/client_enquiry_form',$data);
        }
        else{
            echo "<h3 style='text-align:center'>Sorry! Invalid Link</h3>";
        }

    }

    private function check_token($token){

        $info = $this->home_model->get_row("tblenquirycall", array("token" => $token), array("*"));
        if (!empty($info)){
            return $info;
        }
        return false;
    }
    
    /* this is use for submit form ajax */
    public function add_form() {
        if ($this->input->post()) {
              $this->load->model("Enquirycall_model");

              $unit_data = $this->input->post();
              $this->Enquirycall_model->add_customer_enquiry_form($unit_data["enqiry_id"], $unit_data);
          }
    }

    public function complete_step(){
         $data['title'] = 'Vendor Registration';
         $this->load->view('vendor/form_complete_page',$data);
    }

}
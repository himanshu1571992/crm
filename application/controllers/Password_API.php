<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Password_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
                
		load_admin_language();
        $this->load->model('Authentication_model');
        $this->load->library('form_validation');

        $this->form_validation->set_message('required', _l('form_validation_required'));
        $this->form_validation->set_message('valid_email', _l('form_validation_valid_email'));
        $this->form_validation->set_message('matches', _l('form_validation_matches'));
		
    }

    public function forgot_password()
    {

    	
        $check['email']=$this->input->get('email');
        
        if ($this->input->get()) {
               
                $success = $this->Authentication_model->forgot_password($this->input->get('email'), true);
               
                if (is_array($success) && isset($success['memberinactive'])) {
                    
                    
                    $result['status']="false";
                    $result['msg']="inactive account";

                } elseif ($success == true) {
                	$result['status']="true";
                    $result['msg']="check email for resetting password";
                } else {
                                     
                    $result['status']="error";
                    $result['msg']="error setting new password key";
                }
            }
        

        header('Content-type: application/json');
	   echo json_encode($result);
        
    }
}

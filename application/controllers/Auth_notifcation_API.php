<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Auth_notifcation_API extends CRM_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('home_model');
    }

   /* public function get() {

        $response = $this->check_header();
        if ($response["status"] == TRUE){
            
            $return_arr = array("status" => FALSE, "message" => "Unauthorized User", "data" => []);
            $response_data = $this->db->query("SELECT `staffid` FROM `tblstaff` WHERE `staffid` = '".$response["user_id"]."' and `password` = '".$response["secret_key"]."'")->row();
            if(!empty($response_data)){
                
                /* remove existing session */
                /*$this->session->unset_userdata('staff_user_id');
                $this->session->unset_userdata('staff_logged_in');

                /* create new session */
                /*$web_url = $_REQUEST["web_url"];
                $user_data = [
                    'staff_user_id' => $response_data->staffid,
                    'staffbranch' => 1,
                    'year_id' => getCurrentFinancialYear(),
                    'staff_logged_in' => true,
                ];
                $this->session->set_userdata($user_data);
                
                redirect(admin_url($web_url));
            }
        }else{
            $return_arr = array("status" => FALSE, "message" => "Required Parameters are messing", "data" => []);
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
    }*/
    
    /* this function use for check header information */
    /*private function check_header() {
        $header = apache_request_headers();
        
        $output = array("status" => FALSE, "user_id" => "", "secret_key" => "");
        if (array_key_exists("user_id", $header) && array_key_exists("secret_key", $header)){
            if (!empty($header["user_id"]) && !empty($header["secret_key"]) && !empty($_REQUEST["web_url"])){
                $output = array("status" => TRUE, "user_id" => $header["user_id"], "secret_key" => $header["secret_key"]);
            }
        }
        return $output;
    }*/





    public function get() {

        $web_url = $_REQUEST["web_url"];
        $user_id = $_REQUEST["user_id"];
        $secret_key = $_REQUEST["secret_key"];
        if (!empty($secret_key) && !empty($user_id)){
            
            $return_arr = array("status" => FALSE, "message" => "Unauthorized User", "data" => []);
            $response_data = $this->db->query("SELECT `staffid` FROM `tblstaff` WHERE `staffid` = '".$user_id."' and `password` = '".$secret_key."'")->row();
            if(!empty($response_data)){
                
                /* remove existing session */
                $this->session->unset_userdata('staff_user_id');
                $this->session->unset_userdata('staff_logged_in');

                /* create new session */
                
                $user_data = [
                    'staff_user_id' => $response_data->staffid,
                    'staffbranch' => 1,
                    'year_id' => getCurrentFinancialYear(),
                    'staff_logged_in' => true,
                ];
                $this->session->set_userdata($user_data);
                
                if(!empty($web_url)){
                    redirect(admin_url($web_url));
                }else{
                   redirect(admin_url());  
                }
                
            }
        }else{
            $return_arr = array("status" => FALSE, "message" => "Required Parameters are messing", "data" => []);
        }
        
        header('Content-type: application/json');
        echo json_encode($return_arr);
    }

}

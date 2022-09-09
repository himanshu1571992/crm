<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Justdial_API extends CRM_Controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('home_model');
    }


    public function index() {

        $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }        

        if(!empty($leadid) ){

            $ad_data = array(                            
                'leadid' => $leadid,
                'leadtype' => $leadtype,
                'prefix' => $prefix,
                'name' => $name,
                'mobile' => $mobile,
                'phone' => $phone,
                'email' => $email,
                'date' => $date,
                'category' => $category,
                'city' => $city,
                'area' => $area,
                'brancharea' => $brancharea,
                'dncmobile' => $dncmobile,
                'dncphone' => $dncphone,
                'company' => $company,
                'pincode' => $pincode,
                'time' => $time,
                'branchpin' => $branchpin,
                'parentid' => $parentid,
                'created_at' => date('Y-m-d H:i:s')
            );
                    
            $insert = $this->home_model->insert('tbljustdialclientrecord', $ad_data); 

            if($insert == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Record Added Successfully";
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to Add Record";
            } 

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Justdial_API?leadid=JD6960768A8B81&leadtype=category&prefix=&name=User&mobile=9XXXXXXXX&phone=&email=&date=2020-12-24&category=Glass+Jar+Manufacturers&area=&city=Mumbai&brancharea=Pahar+Ganj&dncmobile=0&dncphone=0&company=Ajanta+Bottle+Private+Limited&pincode=&time=00%3A06%3A49&branchpin=110055&parentid=PXX11.XX11.170616181405.J3W5

        //schachengineers.com/schacrm/Justdial_API?leadid=JD6960768A8B81&leadtype=category&prefix=&name=User&mobile=9XXXXXXXX&phone=&email=&date=2020-12-24&category=Glass+Jar+Manufacturers&area=&city=Mumbai&brancharea=Pahar+Ganj&dncmobile=0&dncphone=0&company=Ajanta+Bottle+Private+Limited&pincode=&time=00%3A06%3A49&branchpin=110055&parentid=PXX11.XX11.170616181405.J3W5
    }

}

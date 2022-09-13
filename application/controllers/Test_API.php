<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Test_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function test_cron(){

        $return_arr = array();

        $ad_data = array(
            'date' => date('Y-m-d H:i:s')
        );

        $this->home_model->insert('test',$ad_data);
        
        //schachengineers.com/schacrm/test_api/test_cron
    }

    public function test_intimation(){
       
        $token = 'fQvYYemW2-Y:APA91bFf821oEsnglHLNAWwmSdOyLhGSabOfYDK5Ybq3F2tmlZkXMGvymQ1hPXNBZdDgwGw0QuHoP0FoWjEdtqGpS8OFTPvpJDepJH58-VASv_qPIGlSg7IOJKiFoMwaJTxKa5BBLbPD';
        $message = 'Just For Test';
        $title = 'Schach';
        $send_intimation = sendFCM($message, $title, $token, $page = 2);
    }

    // Call Details API
    /*public function checkResponse(){

        $return_arr = array();

        //$calling_info = json_decode(file_get_contents("php://input"));
        $calling_info = $this->input->get();
        $CallSid = $calling_info['CallSid'];


        $url="https://4cf4540d6d5ab70f33aefc05ca05528fa400b8790d22af8e:06a1b3fc089f4b9f714448d7de03eb409f7979d83bbd5c1f@api.exotel.com/v1/Accounts/schachengineers1/Calls/".$CallSid.".json";
        $ch = curl_init($url);
        curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        $curl_scraped_page = curl_exec($ch);
        curl_close($ch); 


        //$data = json_encode($curl_scraped_page);
        $ad_data = array(
            'data' => $curl_scraped_page,
        );

        if($this->home_model->insert('test',$ad_data)){
            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;   
            $return_arr['message'] = "Error occurred!";
            $return_arr['data'] = []; 
        }

        

        header('Content-type: application/json');
        echo json_encode($return_arr);
        
        //schachengineers.com/schacrm/test_API/checkResponse
    }*/


    public function checkResponse(){
       
        $return_arr = array();

        $calling_info = $this->input->get();
        $calling_info = json_encode($calling_info);
        //$calling_info = json_decode($calling_info);


        $ad_data = array(
            'data' => $calling_info,
        );

        if($this->home_model->insert('test',$ad_data)){
            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;   
            $return_arr['message'] = "Error occurred!";
            $return_arr['data'] = []; 
        }   

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        
        //schachengineers.com/schacrm_test/test_API/checkResponse
    }

    public function get_outgoing(){

        $return_arr = array();

        $calling_info = $this->input->post();
        $calling_info = json_encode($calling_info);
        $calling_info = json_decode($calling_info);

        $RecordingUrl = '';
        $Status = '';
        $OnCallDuration = '0';
        if(isset($calling_info->Status)){
            $Status = $calling_info->Status;
        }
        if(isset($calling_info->RecordingUrl)){
            $RecordingUrl = str_replace("\\","",$calling_info->RecordingUrl);
        }
        if(isset($calling_info->Legs[0]->OnCallDuration)){
            $OnCallDuration = $calling_info->Legs[0]->OnCallDuration;
        }

        $ad_data = array(
            'call_id' => $calling_info->CallSid,
            'vagent_number' => $calling_info->PhoneNumberSid,
            'customer_number' => $calling_info->To,
            'agent_number' => $calling_info->From,
            'start_time' => $calling_info->StartTime,
            'end_time' => $calling_info->EndTime,
            'total_duration' => $OnCallDuration,
            'recording_url' => $RecordingUrl,
            'call_status' => $Status,
            'date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        );

        if($this->home_model->insert('tblcalloutgoing',$ad_data)){
            $return_arr['status'] = true;   
            $return_arr['message'] = "Success";
            $return_arr['data'] = [];
        }else{
            $return_arr['status'] = false;   
            $return_arr['message'] = "Error occurred!";
            $return_arr['data'] = []; 
        }   

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        
        //schachengineers.com/schacrm/vagent/get_incoming
    }

    public function make_call(){
       
        $StatusCallback = base_url().'test_API/get_outgoing';
        $data = [
           'From' => '9907327030',
           'To' => '8269607253',
           'CallerId' => '07314855570',
           'StatusCallback' => $StatusCallback,
           'StatusCallbackEvents[0]' => 'terminal',
        ];


        $makeCall = makeCall($data);
        echo '<pre/>';
        print_r($makeCall); 
        die;
    }

    /* this function use for remove duplicate contacts */
    function delete_duplicate_contacts(){
        $this->load->model("home_model");
        $get_user = $this->db->query("SELECT userid, COUNT(*) FROM `tblcontacts` GROUP BY userid HAVING COUNT(userid) > 1")->result();
        if (!empty($get_user)){
            foreach ($get_user as $user) {
                
                $getcontact = $this->db->query("SELECT `id`,`userid`,`phonenumber`,`contact_type` FROM `tblcontacts` WHERE `userid` = ".$user->userid." ")->result();
                if (!empty($getcontact)){
                    foreach ($getcontact as $key => $value) {
                        $chkcontact = $this->db->query("SELECT `id` FROM `tblcontacts` WHERE `userid` = ".$value->userid." AND `phonenumber` = ".$value->phonenumber." AND `contact_type` = ".$value->contact_type." ORDER BY id DESC")->row();
                        if (!empty($chkcontact)){
                            $this->home_model->delete("tblcontacts", array("id !="=> $chkcontact->id,"userid" => $value->userid, "phonenumber" => $value->phonenumber, "contact_type" => $value->contact_type));
                        }
                    }
                }
            }
        }
        echo "ok";
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Vagent extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

// Exotel Code
    public function get_incoming(){

        $return_arr = array();

        $calling_info = $this->input->get();
        $calling_info = json_encode($calling_info);
        $calling_info = json_decode($calling_info);

        $RecordingUrl = '';
        $DialCallStatus = '';
        $OnCallDuration = '0';
        if(isset($calling_info->DialCallStatus)){
            $DialCallStatus = $calling_info->DialCallStatus;
        }
        if(isset($calling_info->RecordingUrl)){
            $RecordingUrl = str_replace("\\","",$calling_info->RecordingUrl);
        }
        if(isset($calling_info->Legs[0]->OnCallDuration)){
            $OnCallDuration = $calling_info->Legs[0]->OnCallDuration;
        }

        $ad_data = array(
            'call_id' => $calling_info->CallSid,
            'vagent_number' => $calling_info->CallTo,
            'customer_number' => $calling_info->CallFrom,
            'agent_number' => $calling_info->DialWhomNumber,
            'start_time' => $calling_info->StartTime,
            'end_time' => $calling_info->EndTime,
            'total_duration' => $OnCallDuration,
            'recording_url' => $RecordingUrl,
            'call_status' => $DialCallStatus,
            'date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        );

        if($this->home_model->insert('tblcallincoming',$ad_data)){
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


// Minavo Code

    /*public function get_incoming(){

        $return_arr = array();

        $calling_info = json_decode(file_get_contents("php://input"));
        $ad_data = array(
            'call_id' => $calling_info->call_id,
            'vagent_number' => $calling_info->vagent_number,
            'customer_number' => $calling_info->customer_number,
            'agent_number' => $calling_info->agent_number,
            'start_time' => $calling_info->start_time,
            'end_time' => $calling_info->end_time,
            'total_duration' => $calling_info->total_duration,
            'recording_url' => $calling_info->recording_url,
            'call_status' => $calling_info->call_status,
            'date' => date('Y-m-d'),
            'created_at' => date('Y-m-d H:i:s'),
        );


        if($this->home_model->insert('tblcallincoming',$ad_data)){
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
        
    }*/

// Minavo Code
    /*public function get_outgoing(){

        $return_arr = array();

        //$calling_info = json_decode(file_get_contents("php://input"));
        $calling_info = $this->input->post();
        $ad_data = array(
            'call_id' => $calling_info['call_id'],
            'customer_number' => $calling_info['customer_number'],
            'agent_number' => $calling_info['agent_number'],
            'start_time' => $calling_info['start_time'],
            'end_time' => $calling_info['end_time'],
            'total_duration' => $calling_info['total_duration'],
            'recording_url' => $calling_info['recording_url'],
            'call_status' => $calling_info['call_status'],
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
    }*/

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Reminder_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function make_notification()
    {
       
        $reminder_list  = $this->db->query("SELECT * FROM tblreminder WHERE status = 1 and  completed = 0 and reminder_date <= '".date('Y-m-d H:i:s')."' ")->result();
        
        if(!empty($reminder_list)){
            foreach ($reminder_list as $key => $row) {
                //Deleteing last notification
                $this->home_model->delete('tblnotifications',array('module_id'=>5,'table_id'=>$row->id));

                //Inserting new notification    


                if($row->reminder_for == 1){
                    $reminder_for = 'Payment Followup';
                }elseif($row->reminder_for == 2){
                    $reminder_for = 'Lead Followup';
                }elseif($row->reminder_for == 3){
                    $reminder_for = 'Task';
                }


                $description = "You have Reminder for ".$reminder_for;
                $link = 'reminder/details/'.$row->id;
                $ad_data = array(
                        'isread' => 0,
                        'isread_inline' => 0,
                        'date' => date('Y-m-d H:i:s'),
                        'description' => $description,
                        'fromuserid' => $row->staff_id,
                        'touserid' => $row->staff_id,
                        'from_fullname' => 'Reminder',
                        'link' => $link,
                        'module_id' => 5,
                        'table_id' => $row->id,
                    );


                $this->home_model->insert('tblnotifications',$ad_data);

            }
        }

    }



    public function add_reminder()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($user_id) && !empty($reminder_date) && !empty($reminder_for)){

           $reminder_date = str_replace("/","-",$reminder_date);
           $reminder_date = date("Y-m-d H:i:s",strtotime($reminder_date));
             
           $ad_data = array(
                        'staff_id' => $user_id,
                        'reminder_for' => $reminder_for,
                        'remark' => $remark,
                        'reminder_date' => $reminder_date,
                        'status' => $status,
                        'created_at' => date('Y-m-d H:i:s'),
                    );

            $insert = $this->home_model->insert('tblreminder',$ad_data);

            if($insert == true){

                $id = $this->db->insert_id();
                handle_multi_attachments($id,'reminder');


                $return_arr['status'] = true;   
                $return_arr['message'] = "Reminder added Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to add Reminder";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);


        //http://35.154.77.171/schach/Reminder_API/add_reminder?user_id=1&reminder_for=1&remark=First reminder&reminder_date=31-05-2019 10:16 AM&status=1

    }


    public function edit_reminder()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($user_id) && !empty($id)){

            $reminder_date = str_replace("/","-",$reminder_date);
            $reminder_date = date("Y-m-d H:i:s",strtotime($reminder_date));

            $ad_data = array(
                'staff_id' => $user_id,
                'reminder_for' => $reminder_for,
                'remark' => $remark,
                'reminder_date' => $reminder_date,
                'status' => $status,
                'created_at' => date('Y-m-d H:i:s'),
            );

            $update = $this->home_model->update('tblreminder', $ad_data,array('id'=>$id));

            if($update == true){
                handle_multi_attachments($id,'reminder');
                $return_arr['status'] = true;   
                $return_arr['message'] = "Reminder Updated Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to update Reminder";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://35.154.77.171/schach/Reminder_API/edit_reminder?user_id=1&reminder_for=2&remark=Edit First reminder&reminder_date=31-05-2019 10:16 AM&status=1&id=1
    }


    public function reminder_list()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        $where = "staff_id = '".$user_id."' ";

        if(!empty($from_date) && !empty($to_date)){
           
            $from_date = date('Y-m-d',strtotime($from_date)).' 00:00:00';           
            $to_date = date('Y-m-d',strtotime($to_date)).' 23:59:59';  

            $where .= " and reminder_date >= '".$from_date."' and reminder_date <= '".$to_date."' ";

        }else{
            $where .= " and YEAR(reminder_date) = '".date('Y')."' and MONTH(reminder_date) = '".date('m')."' ";
        }

        if(!empty($reminder_for)){
            $where .= " and reminder_for = '".$reminder_for."'";
        }

        if(!empty($completed)){
            if($completed == 2){
                $completed = 0;
            }else{
                $completed = $completed;
            }
            $where .= " and completed = '".$completed."'";
                
        }

        $reminder_info = $this->db->query("SELECT * FROM `tblreminder` where ".$where."  ORDER by id desc")->result(); 
        if(!empty($reminder_info)){
            foreach ($reminder_info as $value) {

                if($value->reminder_for == 1){
                    $reminder_name = 'Payment Followup';
                }elseif($value->reminder_for == 2){
                    $reminder_name = 'Lead Followup';
                }elseif($value->reminder_for == 3){
                    $reminder_name = 'Task';
                }

                $arr[] = array(
                    'id' => $value->id,
                    'reminder_name'  => $reminder_name,
                    'reminder_for'  => $value->reminder_for,
                    'remark'  => $value->remark,
                    'completed'  => $value->completed,
                    'status'  => $value->status,
                    'reminder_date'   => date('d-m-Y, h:i A',strtotime($value->reminder_date))                    
                );
            }

            $return_arr['status'] = true;
            $return_arr['message'] = "Success";
            $return_arr['data'] = $arr;

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Records Not found!";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://35.154.77.171/schach/Reminder_API/reminder_list?user_id=1&reminder_for=2&from_date=01-05-2019&to_date=31-05-2019

    }


   public function delete()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){

            $update = $this->home_model->delete('tblreminder',array('id'=>$id));

            $this->home_model->delete('tblnotifications',array('module_id'=>5,'table_id'=>$id));

            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Reminder Deleted Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to delete record";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://35.154.77.171/schach/Reminder_API/delete?id=2
    }


    public function mark_complete()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){

            $update = $this->home_model->update('tblreminder', array('completed'=>1),array('id'=>$id));

            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Status Updated Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to update status";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://35.154.77.171/schach/Reminder_API/mark_complete?id=1
    }


    public function reminder_details()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){
            $reminder_info  = $this->db->query("SELECT * FROM tblreminder WHERE  id = '".$id."' ")->row();
        
            if(!empty($reminder_info)){

                if($reminder_info->reminder_for == 1){
                    $reminder_name = 'Payment Followup';
                }elseif($reminder_info->reminder_for == 2){
                    $reminder_name = 'Lead Followup';
                }elseif($reminder_info->reminder_for == 3){
                    $reminder_name = 'Task';
                }

                $arr = array(
                    'id' => $reminder_info->id,
                    'reminder_name'  => $reminder_name,
                    'reminder_for'  => $reminder_info->reminder_for,
                    'remark'  => $reminder_info->remark,
                    'completed'  => $reminder_info->completed,
                    'status'  => $reminder_info->status,
                    'reminder_date'   => date('d-m-Y, h:i A',strtotime($reminder_info->reminder_date))                    
                );


                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $arr;


            }else{
                $return_arr['status'] = false;
                $return_arr['message'] = "Records not found!";
                $return_arr['data'] = [];

            }
           

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);
        //http://35.154.77.171/schach/Reminder_API/reminder_details?id=4

    }


    public function reminder_postpone()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){

            $reminder_date = str_replace("/","-",$reminder_date);
            $reminder_date = date("Y-m-d H:i:s",strtotime($reminder_date));

            $ad_data = array(
                'remark' => $remark,
                'reminder_date' => $reminder_date
            );

            $update = $this->home_model->update('tblreminder', $ad_data,array('id'=>$id));

            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Reminder Postpone successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to Postpone Reminder";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //https://schachengineers.com/schacrm/Reminder_API/reminder_postpone?id=31&remark=Call After edited&reminder_date=31-05-2019 10:16 AM
    }

}

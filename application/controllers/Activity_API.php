<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Activity_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }
    
    public function get_activity_list()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }

        if(!empty($module_id) && !empty($id)){

            if($module_id == 18){
                $table = 'tblenquirycall_activity';
                $where = "enquirycall_id = '".$id."' ";
            }elseif($module_id == 33){
                $table = 'tblpurchaseorderactivity';
                $where = "po_id = '".$id."' ";
            }elseif($module_id == 37){
                $table = 'tblproformainvoiceactivity';
                $where = "estimate_id = '".$id."' ";
            }elseif($module_id == 39){
                $table = 'tblcandidaterequirementactivity';
                $where = "requirement_id = '".$id."' ";
            }elseif($module_id == 42){
                $table = 'tbldesignrequisitionactivity';
                $where = "designrequisition_id = '".$id."' ";
            }elseif($module_id == 45){
                $table = 'tblrequirmentactivity';
                $where = "requirement_id = '".$id."' ";
            }elseif($module_id == 48){
                $table = 'tbldesignactivity';
                $where = "remark_activity_id = '".$id."' ";
            }

            if(!empty($priority) && $priority == 1){
                $activity_log = $this->db->query("SELECT * FROM ".$table." where ".$where." and priority = '1' order by id desc")->result(); 
            }else{
                if($last_id == 0){
                    $activity_log = $this->db->query("SELECT * FROM ".$table." where ".$where." order by id desc LIMIT 10")->result(); 

                }else{
                    $activity_log = $this->db->query("SELECT * FROM ".$table." where ".$where." and id < '".$last_id."' order by id desc LIMIT 10")->result(); 
                }
                
            }
          

            krsort($activity_log);

            if(!empty($activity_log)){
                foreach ($activity_log as $key => $row) {


                    $arr[] = array(
                        'id' => $row->id,
                        'type' => '1',
                        'staffid' => $row->staffid,
                        'staff_name' => get_employee_name($row->staffid),
                        'message' => $row->message,
                        'priority' => $row->priority,
                        'datetime' => _dt($row->datetime),
                        'time_ago' => time_ago($row->datetime),
                        'status' => $row->status,
                        'customer_name' => '',
                        'customer_number' => '',
                        'agent_number' => '',
                        'call_status' => '',
                        'recording_url' => '',
                        'calling_date' => ''
                    );
                }

                $return_arr['status'] = true;
                $return_arr['message'] = "Success";
                $return_arr['data'] = $arr;

            }else{
                $return_arr['status'] = false;
                $return_arr['message'] = "Record Not Found!";
                $return_arr['data'] = [];
            }
            
            

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Activity_API/get_activity_list?module_id=18&id=2&priority=0&last_id=0

    }


    public function add_activity()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($user_id) && !empty($id) && !empty($message) && !empty($module_id)){
            $ad_data = array(
                'message' => $message,
                'staffid' => $user_id,
                'date' => date('Y-m-d'),
                'datetime' => date('Y-m-d H:i:s'),
                'priority' => 0,
                'status' => 1
            );

            if($module_id == 18){
                $table = 'tblenquirycall_activity';
                $ad_data['enquirycall_id'] = $id;
                $description = 'You taged in enquirycall activity';
                $link = 'enquirycall/enquirycall_activity/'.$id;
            }elseif($module_id == 33){
                $table = 'tblpurchaseorderactivity';
                $ad_data['po_id'] = $id;
                $description = 'You taged in purchase order activity follow up';
                $link = 'follow_up/po_activity/'.$id;                
            }elseif($module_id == 37){
                $table = 'tblproformainvoiceactivity';
                $ad_data['estimate_id'] = $id;
                $description = 'You taged in proforma invoice activity follow up';
                $link = 'follow_up/estimates_activity/'.$id;
            }elseif($module_id == 39){
                $table = 'tblcandidaterequirementactivity';
                $ad_data['requirement_id'] = $id;
                $description = 'You taged in enquirycall activity';
                $link = 'enquirycall/enquirycall_activity/'.$id;
            }elseif($module_id == 42){
                $table = 'tbldesignrequisitionactivity';
                $ad_data['designrequisition_id'] = $id;
                $description = 'You taged in design requisition activity';
                $link = 'designrequisition/designrequisition_activity/'.$id;
            }elseif($module_id == 45){
                $table = 'tblrequirmentactivity';
                $ad_data['requirement_id'] = $id;
                $description = 'You taged in requirment activity';
                $link = 'requirement/requirement_activity/'.$id;
            }elseif($module_id == 48){
                $table = 'tbldesignactivity';
                $ad_data['remark_activity_id'] = $id;
                $description = 'You taged in design activity';
                $link = 'designrequisition/design_activity/'.$id;
            }

            $insert =  $this->home_model->insert($table,$ad_data);


            // For Tagging 
            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$id."' and staff_id = '".$user_id."' and module_id = '".$module_id."' ")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($tag_staff_ids)){
                 $staff_ids = json_decode($tag_staff_ids);
                 foreach ($staff_ids as $staff_id) {
                   $n_data = array(
                        'description' => $description,
                        'staff_id' => $staff_id,
                        'fromuserid' => $user_id,
                        'table_id' => $id,
                        'isread' => 0,
                        'module_id' => $module_id,
                        'link'  => $link,
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);
                    
                    //Sending Mobile Intimation
                        $token = get_staff_token($staff_id);
                        $title = 'Schach';
                        $message = $description;
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
               }
            }

            if($insert == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Activity added Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to add activity";
                $return_arr['data'] = [];
            }

        }else{
            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);


        //http://mustafa-pc/crm/Activity_API/add_activity?module_id=18&id=1&message=added by app&user_id=1&tag_staff_ids=[1,27]

    }


    public function cut_conversation()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id) && !empty($module_id)){

            if($module_id == 18){
                $table = 'tblenquirycall_activity';
            }elseif($module_id == 33){
                $table = 'tblpurchaseorderactivity';
            }elseif($module_id == 37){
                $table = 'tblproformainvoiceactivity';
            }elseif($module_id == 39){
                $table = 'tblcandidaterequirementactivity';
            }elseif($module_id == 42){
                $table = 'tbldesignrequisitionactivity';
            }elseif($module_id == 45){
                $table = 'tblrequirmentactivity';
            }elseif($module_id == 48){
                $table = 'tbldesignactivity';
            }

            $update = $this->home_model->update($table,array('status' => 2),array('id'=>$id));

            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Conversation Removed Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to update record";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Activity_API/cut_conversation?id=24&module_id=18
    }


    public function delete_conversation()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }

        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id)){

            if($module_id == 18){
                $table = 'tblenquirycall_activity';
            }elseif($module_id == 33){
                $table = 'tblpurchaseorderactivity';
            }elseif($module_id == 37){
                $table = 'tblproformainvoiceactivity';
            }elseif($module_id == 39){
                $table = 'tblcandidaterequirementactivity';
            }elseif($module_id == 42){
                $table = 'tbldesignrequisitionactivity';
            }elseif($module_id == 45){
                $table = 'tblrequirmentactivity';
            }elseif($module_id == 48){
                $table = 'tbldesignactivity';
            }

            $update = $this->home_model->delete($table,array('id'=>$id));

            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Conversation Deleted Successfully";
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

        //http://mustafa-pc/crm/Activity_API/delete_conversation?id=24&module_id=18

    }


    public function update_priority()
    {
       $return_arr = array();

        if(!empty($_GET)){
            extract($this->input->get());
        }
        elseif(!empty($_POST)){
            extract($this->input->post());  
        }


        if(!empty($id) && !empty($module_id)){

            if($module_id == 18){
                $table = 'tblenquirycall_activity';
            }elseif($module_id == 33){
                $table = 'tblpurchaseorderactivity';
            }elseif($module_id == 37){
                $table = 'tblproformainvoiceactivity';
            }elseif($module_id == 39){
                $table = 'tblcandidaterequirementactivity';
            }elseif($module_id == 42){
                $table = 'tbldesignrequisitionactivity';
            }elseif($module_id == 45){
                $table = 'tblrequirmentactivity';
            }elseif($module_id == 48){
                $table = 'tbldesignactivity';
            }

            $update = $this->home_model->update($table, array('priority'=>$status),array('id'=>$id));

            if($update == true){
                $return_arr['status'] = true;   
                $return_arr['message'] = "Priority Updated Successfully";
                $return_arr['data'] = [];
            }else{
                $return_arr['status'] = false;  
                $return_arr['message'] = "Fail to update Priority";
                $return_arr['data'] = [];
            }

        }else{

            $return_arr['status'] = false;  
            $return_arr['message'] = "Required Parameters are messing";
            $return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
        echo json_encode($return_arr);

        //http://mustafa-pc/crm/Activity_API/update_priority?id=3&status=1&module_id=18
    }

}
<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Complains_model extends CRM_Model
{

    public function add($data)
    {
	$assignstaff=$data['assignid'];
        if(!empty($assignstaff)){
            foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
              
            }
            $staff_id = array_unique($staff_id);
       }else{
            $staff_id = array();
       }
        
        $complain_date = str_replace("/","-",$data['complain_date']);
        $complain_date = date("Y-m-d",strtotime($complain_date));
        $ad_data["client_id"] = $data["client_id"];
        $ad_data["complain_type_id"] = $data["complain_type_id"];
        $ad_data["location"] = $data["location"];
        $ad_data["remark"] = $data["remark"];
        $ad_data["complain_date"] = $complain_date;
        $ad_data["staff_id"] = get_staff_user_id();
        
        $insert = $this->home_model->insert('tblcomplains', $ad_data); 
        if($insert){
            $complains_id = $this->db->insert_id();
            
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {

                    $ad_field = array(
                        'staff_id' => $staffid,                        
                        'complains_id' => $complains_id,                        
                        'status' => 1,                        
                        'approve_status' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->home_model->insert('tblcomplains_approval',$ad_field);

                    $message = 'Complains approval request send you';
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => get_staff_user_id(),
                        'module_id' => 21,
                        'table_id' => $complains_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => $message,
                        'link' => 'complains/complains_approval/'.$complains_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            
            if(!empty($data['complaindata'])){
                foreach ($data['complaindata'] as $row) {

                    $ad_field = array(
                        'complains_id' => $complains_id,                        
                        'product_id' => $row["product_id"],                        
                        'qty' => $row["qty"],                        
                        'defect_remark' => $row["defect_remark"],                        
                    );
                    $this->home_model->insert('tblcomplainsproducts',$ad_field);
                }
            }
            return $complains_id;
        }
        return FALSE;
    }

    public function update($data, $id)
    {
	$assignstaff=$data['assignid'];
        if(!empty($assignstaff)){
            foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
              
            }
            $staff_id = array_unique($staff_id);
       }else{
            $staff_id = array();
       }
        
        $complain_date = str_replace("/","-",$data['complain_date']);
        $complain_date = date("Y-m-d",strtotime($complain_date));
        $ad_data["client_id"] = $data["client_id"];
        $ad_data["complain_type_id"] = $data["complain_type_id"];
        $ad_data["location"] = $data["location"];
        $ad_data["remark"] = $data["remark"];
        $ad_data["complain_date"] = $complain_date;
        $ad_data["approve_status"] = 0;
        
        $update = $this->home_model->update('tblcomplains', $ad_data, array("id" => $id)); 
        if($update){
            $complains_id = $id;
            
            if(!empty($staff_id)){
                
                /* this is for delete old data */
                $this->home_model->delete('tblcomplains_approval', array("complains_id" => $complains_id)); 
                $this->home_model->delete('tblmasterapproval', array("table_id" => $complains_id, 'module_id'=> 21)); 
                
                foreach ($staff_id as $staffid) {

                    $ad_field = array(
                        'staff_id' => $staffid,                        
                        'complains_id' => $complains_id,                        
                        'status' => 1,                        
                        'approve_status' => 0,
                        'created_at' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->home_model->insert('tblcomplains_approval',$ad_field);

                    $message = 'Complains approval request send you';
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => get_staff_user_id(),
                        'module_id' => 21,
                        'table_id' => $complains_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => $message,
                        'link' => 'complains/complains_approval/'.$complains_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            
            if(!empty($data['complaindata'])){
                
                /* this is for delete old data */
                $this->home_model->delete('tblcomplainsproducts', array("complains_id" => $complains_id)); 
                
                foreach ($data['complaindata'] as $row) {

                    $ad_field = array(
                        'complains_id' => $complains_id,                        
                        'product_id' => $row["product_id"],                        
                        'qty' => $row["qty"],                        
                        'defect_remark' => $row["defect_remark"],                        
                    );
                    $this->home_model->insert('tblcomplainsproducts',$ad_field);
                }
            }
            return $complains_id;
        }
        return FALSE;
    }
    
    /* this function use for complains approval */
    public function complains_approval($data, $id) {
        $user_id = get_staff_user_id();
        
        $update = $this->home_model->update('tblcomplains', array('approve_status'=>$data["action"]),array('id'=>$id));
        if($update){
            $ad_data = array(                            
                'approve_remark' => $data["approval_remark"],
                'approve_status' => $data["action"],
                'updated_at' => date('Y-m-d H:i:s')
            );

            $this->home_model->update('tblcomplains_approval', $ad_data,array('complains_id'=>$id,'staff_id'=>$user_id));
            
            update_masterapproval_single(get_staff_user_id(),21,$id,$data["action"]);
            update_masterapproval_all(21,$id,$data["action"]); 
            
            return TRUE;
        }
        return FALSE;
    }
    
    /* this function use for assign planner */
    public function assign_planner($data) {
        
        if(!empty($data["assign_plan"])){
            $complains_id = $data["complains_id"];
            $this->home_model->update('tblcomplains', array('action_plan_status'=> 0,'action_planner_id'=>$data["assign_plan"]),array('id'=>$data["complains_id"]));
            
            /* this is for delete old data */
                $this->home_model->delete('tblmasterapproval', array("module_id"=>22,"table_id" => $complains_id)); 
                
            $message = 'Complain action plan request send you';
            $adata = array(
                'staff_id' => $data["assign_plan"],
                'fromuserid'      => get_staff_user_id(),
                'module_id' => 22,
                'table_id' => $complains_id,
                'approve_status' => 0,
                'status' => 0,
                'description'     => $message,
                'link' => 'complains/upload_action_plan/'.$complains_id,
                'date' => date('Y-m-d'),
                'date_time' => date('Y-m-d H:i:s'),
                'updated_at' => date('Y-m-d H:i:s')
            );  
            $this->db->insert('tblmasterapproval', $adata);
            
            //Sending Mobile Intimation
                $token = get_staff_token($data["assign_plan"]);
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
                
            return TRUE;
        }
        return FALSE;
    }
    
    /* this function use for action plan final process */
    public function actionplan($data) {
        
        $complains_id = $data["complains_id"];
        if($data["action"] == 1){
            
            $assign_data["complains_id"] = $complains_id;
            $assign_data["assign_plan"] = $data["action_planner_id"];
            $this->assign_planner($assign_data);
            
            $addata["action_plan_status"] = 0;
            $addata["status"] = 1;
        }elseif($data["action"] == 2){
            $addata["action_planner_id"] = $data["action_planner_id"];
            $addata["action_plan_status"] = 1;
            $addata["status"] = 2;
        }
        $update = $this->home_model->update('tblcomplains', $addata,array('id'=>$complains_id));
        if($update){
            return TRUE;
        }
        return FALSE;
    }
    
}

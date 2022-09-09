<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Enquirycall_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

   
    /**
     * @param $_POST array
     * @return Insert ID
     * Add new enquiry call details this function
     */
    public function add($data)
    {
        $current_datetime = date('Y-m-d H:i:s');
        
        $product_json = "";
        if (isset($data["proenqdata"])){
            $product_data = [];
            foreach ($data["proenqdata"] as $pro) {
                if (!empty($pro["product_id"])){
                    $pdata = explode("-", $pro["product_id"]);
                    $product_data[] = array("product_id" => $pdata[0], "is_temp" => $pdata[1], "qty" => $pro["qty"]);
                }
            }
            $product_json = json_encode($product_data);
        }
        
        $staff_id = array();
        if(!empty($data['assignproductionid'])){
            $assignstaff = $data['assignproductionid'];
            
            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
                if (strpos($single_staff, 'group') !== false) {
                    $single_staff = str_replace("group", "", $single_staff);
                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                    foreach ($staffgroup as $singlestaff) {
                        $staff_id[] = $singlestaff['staff_id'];
                    }
                }
            }
            unset($data['assignproductionid']);
            $staff_id = array_unique($staff_id);
        }
        
        /* get staff contact number */
        /*$phonenumber = get_employee_info(get_staff_user_id())->phonenumber;
        $insertdata['call_id'] = 0;
        if ($data["call_type"] == 1){
            $call_data = $this->db->query("SELECT * FROM tblcallincoming WHERE `agent_number` = ".$phonenumber." ORDER BY id DESC")->row();
            if (!empty($call_data)){
                $insertdata['call_id'] = $call_data->id;
            }
        }else{
            $call_data = $this->db->query("SELECT * FROM tblcalloutgoing WHERE `agent_number` = ".$phonenumber." ORDER BY id DESC")->row();
            if (!empty($call_data)){
                $insertdata['call_id'] = $call_data->id;
            }
        }
        
        if (isset($data["call_id"])){
            $insertdata['call_id'] = $data["call_id"];
            if($data["call_type"] == 1){
                $call_data = $this->db->query("SELECT * FROM tblcallincoming WHERE id = '".$data["call_id"]."' ")->row();
            }else{
                $call_data = $this->db->query("SELECT * FROM tblcalloutgoing WHERE id = '".$data["call_id"]."' ")->row();
            }
        }

        if(!empty($call_data)){
            if(!empty($call_data->vagent_number)){
                $number_info = $this->db->query("SELECT `source_id` FROM tblvagentnumbers WHERE `number` = ".$call_data->vagent_number." and status = 1")->row();
                if(!empty($number_info)){
                    $insertdata['source_id'] = $number_info->source_id;
                } 
            }
               
        }*/
        
        
        if (isset($data["call_id"]) && $data["call_type"] == 3){
            $this->home_model->update("tblappleads", array("status" => 1), array("id" => $data["call_id"]));
        }
        if (isset($data["call_id"]) && $data["call_type"] == 4){
            $this->home_model->update("tblindiamartclientrecord", array("status" => 1), array("id" => $data["call_id"]));
        }

        $sub_category_id = (is_array($data["sub_category_id"]) && !empty($data["sub_category_id"])) ? implode(",", $data["sub_category_id"]) : 0;
        $company_name = (!empty($data["company_name"])) ? $data["company_name"] : "";
        $clientid = (!empty($data["clientid"])) ? $data["clientid"] : "";
        $insertdata['staff_id'] = get_staff_user_id();
        $insertdata['lead_category_id'] = $data["lead_category_id"];
        $insertdata['call_id'] = $data["call_id"];
        $insertdata['source_id'] = $data["source_id"];
        $insertdata['call_type'] = $data["call_type"];
        $insertdata['lead_type'] = $data["lead_type"];
        $insertdata['service_type'] = $data["service_type"];
        $insertdata['duration'] =  (isset($data["duration"])) ? $data["duration"] : 0;
        $insertdata['production_remark'] =  (isset($data["production_remark"])) ? $data["production_remark"] : NULL;
        $insertdata['company_name'] = $company_name;
        $insertdata['clientid'] = $clientid;
        $insertdata['person_name'] = $data["contact_parson_name"];
        $insertdata['mobile'] = $data["mobile"];
        $insertdata['email'] = $data["email"];
        $insertdata['state_id'] = $data["state_id"];
        $insertdata['city_id'] = $data["city_id"];
        $insertdata['address'] = $data["address"];
        $insertdata['sub_category_id'] = $sub_category_id;
        $insertdata['unverified_status_id'] =  (isset($data["unverified_status_id"])) ? $data["unverified_status_id"] : 0;
        $insertdata['unverified_order_remark'] = (isset($data["unverified_order_remark"])) ? $data["unverified_order_remark"] : NULL;
        $insertdata['product_json'] = $product_json;
        $insertdata['token'] = generate_token();
        $insertdata['created_at'] = $current_datetime;
        $insertdata['updated_at'] = $current_datetime;

        
        $this->db->insert('tblenquirycall', $insertdata);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            
            if (isset($data["question"])){
                foreach ($data["question"] as $key => $value) {
                    $answer = (is_array($value) && !empty($value)) ? implode(",", $value) : $value;
                    $enquirydata['main_id'] = $insert_id;
                    $enquirydata['question_id'] = $key;
                    $enquirydata['answer'] = $answer;
                    $this->db->insert('tblenquirycall_details', $enquirydata);
                }
            }
            
            /* if assign production */
            if (!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['enquirycall_id'] = $insert_id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblenquirycall_assignproduction', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 23,
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Enquiry call assign to production',
                        'link' => 'enquirycall/enquirycall_actionassign/'.$insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Enquiry call assign to production';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
                
                $this->home_model->update('tblenquirycall', array('is_converted'=>2), array("id"=>$insert_id));
            }
            return $insert_id;
        }

        return false;
    }

    /**
     * @param $_POST array
     * @return Insert ID
     * Update new enquiry call details this function
     */
    public function update($id, $data)
    {
        $current_datetime = date('Y-m-d H:i:s');
        
        $product_json = "";
        if (isset($data["proenqdata"])){
            $product_data = [];
            foreach ($data["proenqdata"] as $pro) {
                $pdata = explode("-", $pro["product_id"]);
                $product_data[] = array("product_id" => $pdata[0], "is_temp" => $pdata[1], "qty" => $pro["qty"]);
            }
            $product_json = json_encode($product_data);
        }
        
        $staff_id = array();
        if(!empty($data['assignproductionid'])){
            $assignstaff = $data['assignproductionid'];
            
            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
                if (strpos($single_staff, 'group') !== false) {
                    $single_staff = str_replace("group", "", $single_staff);
                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                    foreach ($staffgroup as $singlestaff) {
                        $staff_id[] = $singlestaff['staff_id'];
                    }
                }
            }
            unset($data['assignproductionid']);
            $staff_id = array_unique($staff_id);
        }
        
        $phonenumber = get_employee_info(get_staff_user_id())->phonenumber;
        /*$number_info = $this->db->query("SELECT `source_id` FROM tblvagentnumbers WHERE `number` = ".$phonenumber." and status = 1")->row();
        if(!empty($number_info)){
            $updatedata['source_id'] = $number_info->source_id;
        }*/

        $sub_category_id = (is_array($data["sub_category_id"]) && !empty($data["sub_category_id"])) ? implode(",", $data["sub_category_id"]) : $data["sub_category_id"];
        
        $company_name = (!empty($data["company_name"])) ? $data["company_name"] : "";
        $clientid = (!empty($data["clientid"])) ? $data["clientid"] : "";
        $updatedata['staff_id'] = get_staff_user_id();
        $updatedata['source_id'] = $data["source_id"];
        $updatedata['lead_category_id'] = $data["lead_category_id"];
        $updatedata['call_type'] = $data["call_type"];
        $updatedata['lead_type'] = $data["lead_type"];
        $updatedata['service_type'] = $data["service_type"];
        $updatedata['duration'] =  (isset($data["duration"])) ? $data["duration"] : 0;
        $updatedata['company_name'] = $company_name;
        $updatedata['clientid'] = $clientid;
        $updatedata['person_name'] = $data["contact_parson_name"];
        $updatedata['mobile'] = $data["mobile"];
        $updatedata['email'] = $data["email"];
        $updatedata['state_id'] = $data["state_id"];
        $updatedata['city_id'] = $data["city_id"];
        $updatedata['address'] = $data["address"];
        $updatedata['sub_category_id'] = $sub_category_id;
        $updatedata['unverified_status_id'] =  (isset($data["unverified_status_id"])) ? $data["unverified_status_id"] : 0;
        $updatedata['unverified_order_remark'] = (isset($data["unverified_order_remark"])) ? $data["unverified_order_remark"] : NULL;
        $updatedata['product_json'] = $product_json;
        $updatedata['production_remark'] =  (isset($data["production_remark"])) ? $data["production_remark"] : NULL;
        $updatedata['updated_at'] = $current_datetime;

        $this->db->where('id', $id);
        $this->db->update('tblenquirycall', $updatedata);
        if ($id){
            $this->db->where('main_id', $id);
            $this->db->delete("tblenquirycall_details");
            
            if (isset($data["question"])){
                foreach ($data["question"] as $key => $value) {
                    $answer = (is_array($value) && !empty($value)) ? implode(",", $value) : $value;
                    $enquirydata['main_id'] = $id;
                    $enquirydata['question_id'] = $key;
                    $enquirydata['answer'] = $answer;
                    $this->db->insert('tblenquirycall_details', $enquirydata);
                }
            }
            
            /* if assign production */
            if (!empty($staff_id)){
                
                $this->home_model->delete('tblenquirycall_assignproduction', array("enquirycall_id" => $id));
                $this->home_model->delete('tblmasterapproval', array("table_id" => $id, "module_id" => 23));
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['enquirycall_id'] = $id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblenquirycall_assignproduction', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 23,
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Enquiry call assign to production',
                        'link' => 'enquirycall/enquirycall_actionassign/'.$id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata);
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Enquiry call assign to production';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
                
                $this->home_model->update('tblenquirycall', array('is_converted'=>2), array("id"=>$id));
            }
            return $id;
        }

        return false;
    }
    
    /* this function use for add client fields */
    public function add_client_fields($id, $data){
        
        if (isset($data['clientfields'])){
            
            /* deleted old data */
            $this->db->where('main_id', $id);
            $this->db->delete("tblenquirycall_fromfieldsent");
            
            $i = 0;
            foreach ($data['clientfields'] as $key => $value) {
                
                $insertdata["main_id"] = $id;
                if (is_numeric($key)){
                    $insertdata["field_name"] = NULL;
                    $insertdata["field_id"] = $key;
                }else {
                    $insertdata["field_name"] = $key;
                    $insertdata["field_id"] = 0;
                }
                
                $this->db->insert('tblenquirycall_fromfieldsent', $insertdata);
                $insert_id = $this->db->insert_id();
                if ($insert_id){
                    $i++;
                }
            }
            
            if ($i > 0){
                return $id;
            }
        }
        return false;
    }
    
    /* this form submited by coustomer */
    public function add_customer_enquiry_form($id, $data)
    {
        $current_datetime = date('Y-m-d H:i:s');
       
        if (isset($data["service_type"]) && !empty($data["service_type"])){
            $updatedata['service_type'] = $data["service_type"];
        }
        
        $updatedata['duration'] =  (!empty($data["duration"])) ? $data["duration"] : 0;
        
        if (isset($data["company_name"]) && !empty($data["company_name"])){
            $updatedata['company_name'] = $data["company_name"];
        }
        if (isset($data["contact_parson_name"]) && !empty($data["contact_parson_name"])){
            $updatedata['person_name'] = $data["contact_parson_name"];
        }
        if (isset($data["mobile"]) && !empty($data["mobile"])){
            $updatedata['mobile'] = $data["mobile"];
        }
        if (isset($data["state_id"]) && !empty($data["state_id"])){
            $updatedata['state_id'] = $data["state_id"];
        }
        if (isset($data["city_id"]) && !empty($data["city_id"])){
            $updatedata['city_id'] = $data["city_id"];
        }
        if (isset($data["address"]) && !empty($data["address"])){
            $updatedata['address'] = $data["address"];
        }
        
        $updatedata['updated_at'] = $current_datetime;

        $this->db->where('id', $id);
        $update = $this->db->update('tblenquirycall', $updatedata);
        if ($update){
            if (isset($data["question"])){
                foreach ($data["question"] as $key => $value) {
                    
                    if (!empty($value)){
                        $answer = (is_array($value) && !empty($value)) ? implode(",", $value) : $value;
                        $enquirydata['main_id'] = $id;
                        $enquirydata['question_id'] = $key;
                        $enquirydata['answer'] = $answer;

                        /* check question exist or not */
                        $check_ques = $this->db->query("SELECT `id` FROM tblenquirycall_details WHERE `main_id` = ".$id." AND `question_id` = ".$key."")->row();
                        if (!empty($check_ques)){
                            $this->db->where('id', $check_ques->id);
                            $this->db->update('tblenquirycall_details', $enquirydata);
                        }else{
                            $this->db->insert('tblenquirycall_details', $enquirydata);
                        }
                    }
                }
            }
            return $id;
        }

        return false;
    } 
    
}

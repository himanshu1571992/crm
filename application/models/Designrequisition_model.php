<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Designrequisition_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /**
     * @param $_POST array
     * @return Insert ID
     * Add new designation requisition details this function
     */
    public function add($data)
    {
        // echo "<pre>";
        // print_r($data["drequisitionremark"]);
        // exit;
        $current_datetime = date('Y-m-d H:i:s');
        $assignstaffid = array();
        if(!empty($data['assignproductionid'])){
            $assignstaff = $data['assignproductionid'];

            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $assignstaffid[] = str_replace("staff", "", $single_staff);
                }
                if (strpos($single_staff, 'group') !== false) {
                    $single_staff = str_replace("group", "", $single_staff);
                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                    foreach ($staffgroup as $singlestaff) {
                        $assignstaffid[] = $singlestaff['staff_id'];
                    }
                }
            }
            unset($data['assignproductionid']);
            $assignstaffid = array_unique($assignstaffid);
        }

        $client_name = (!empty($data["client_name"])) ? $data["client_name"] : "";
        $clientid = (isset($data["client_id"]) && !empty($data["client_id"])) ? $data["client_id"] : 0;
        $staff_id = (!empty($data["staff_id"])) ? $data["staff_id"] : 0;
        $enquirycall_id = (isset($data["enquirycall_id"]) && !empty($data["enquirycall_id"])) ? $data["enquirycall_id"] : 0;

        $insertdata['enquirycall_id'] = $enquirycall_id;
        $insertdata['product_type'] = $data["product_type"];
        $insertdata['type'] = $data["type"];
        $insertdata['staff_id'] = $staff_id;
        $insertdata['client_name'] = $client_name;
        $insertdata['client_id'] = $clientid;
        $insertdata['date'] = date("Y-m-d");
        $insertdata['added_by'] = get_staff_user_id();
        $insertdata['created_at'] = $current_datetime;
        $insertdata['updated_at'] = $current_datetime;

        $this->db->insert('tbldesignrequisition', $insertdata);
        $insert_id = $this->db->insert_id();
        if ($insert_id){

            if (isset($data["drequisitionremark"])){
                foreach ($data["drequisitionremark"] as $key => $value) {
                    // if (!empty($value["remark"])){
                        $remark = (isset($value["remark"]) && !empty($value["remark"])) ? $value["remark"] : "";
                        $description = (isset($value["description"]) && !empty($value["description"])) ? $value["description"] : "";

                        $enquirydata['designrequisition_id'] = $insert_id;
                        $enquirydata['drawing_id'] = $value["drawing_id"];
                        $enquirydata['drawing_name'] = $value["drawing_name"];
                        $enquirydata['description'] = $description;
                        $enquirydata['remark'] = $remark;
                        $enquirydata['created_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tbldesignrequisitionremark', $enquirydata);
                        $insertid = $this->db->insert_id();
                        $this->home_model->update("tbldesignrequisitionremark", array("activity_id" => $insertid), array("id" => $insertid));
                        $this->requisition_upload($insertid, "design_requisition".$key);
                    // }
                }
            }

            /* if assign production */
            if (!empty($assignstaffid)){
                foreach ($assignstaffid as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['designrequisition_id'] = $insert_id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbldesignrequisitionapproval', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 41,
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Designation Requisition assign to production',
                        'link' => 'designrequisition/designrequisition_approval/'.$insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Designation Requisition assign to production';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }else{
              if (isset($data["directsubmit"]) && empty($assignstaffid)){
                  $this->home_model->update("tbldesignrequisition", array("status" => 1), array("id" => $insert_id));
              }
            }
            return $insert_id;
        }
        return false;
    }

    /**
     * @param $_POST array
     * @return boolean true or false
     *  edit design requisition
     */
    public function update($id, $data)
    {
        // echo "<pre>";
        // print_r($data["drequisitionremark"]);
        // exit;
        $current_datetime = date('Y-m-d H:i:s');
        $assignstaffid = array();
        if(!empty($data['assignproductionid'])){
            $assignstaff = $data['assignproductionid'];

            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $assignstaffid[] = str_replace("staff", "", $single_staff);
                }
                if (strpos($single_staff, 'group') !== false) {
                    $single_staff = str_replace("group", "", $single_staff);
                    $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                    foreach ($staffgroup as $singlestaff) {
                        $assignstaffid[] = $singlestaff['staff_id'];
                    }
                }
            }
            unset($data['assignproductionid']);
            $assignstaffid = array_unique($assignstaffid);
        }

        $client_name = (!empty($data["client_name"])) ? $data["client_name"] : "";
        $clientid = (isset($data["client_id"]) && !empty($data["client_id"])) ? $data["client_id"] : 0;
        $staff_id = (!empty($data["staff_id"])) ? $data["staff_id"] : 0;

        $updatedata['product_type'] = $data["product_type"];
        $updatedata['type'] = $data["type"];
        $updatedata['staff_id'] = $staff_id;
        $updatedata['client_name'] = $client_name;
        $updatedata['client_id'] = $clientid;
        $updatedata['status'] = 0;
        $updatedata['updated_at'] = $current_datetime;

        $this->db->where('id', $id);
        $this->db->update('tbldesignrequisition', $updatedata);
        if ($id){
            $this->home_model->update('tbldesignrequisition', array("show_status" => 1),array('id'=>$id));
            $this->db->where('designrequisition_id', $id);
            $this->db->delete("tbldesignrequisitionremark");

            if (isset($data["drequisitionremark"])){
                foreach ($data["drequisitionremark"] as $key => $value) {
                    // if (!empty($value["remark"])){
                        $remark = (isset($value["remark"]) && !empty($value["remark"])) ? $value["remark"] : "";
                        $description = (isset($value["description"]) && !empty($value["description"])) ? $value["description"] : "";
                        $filesval = (isset($value["files"])) ? $value["files"] :"";

                        $enquirydata['designrequisition_id'] = $id;
                        $enquirydata['activity_id'] = $value["activity_id"];
                        $enquirydata['drawing_id'] = $value["drawing_id"];
                        $enquirydata['drawing_name'] = $value["drawing_name"];
                        $enquirydata['description'] = $description;
                        $enquirydata['remark'] = $remark;
                        $enquirydata['files'] = $filesval;
                        $enquirydata['created_at'] = date("Y-m-d H:i:s");
                        $this->db->insert('tbldesignrequisitionremark', $enquirydata);
                        $insertid = $this->db->insert_id();
                        
                        $this->requisition_upload($insertid, "design_requisition".$key);
                    // }
                }
            }

            /* if assign production */

            if (!empty($assignstaffid)){

                $this->home_model->delete('tbldesignrequisitionapproval', array("designrequisition_id" => $id));
                $this->home_model->delete('tblmasterapproval', array("table_id" => $id, "module_id" => 41));
                foreach ($assignstaffid as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['designrequisition_id'] = $id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbldesignrequisitionapproval', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 41,
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Designation Requisition assign to production',
                        'link' => 'designrequisition/designrequisition_approval/'.$id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Designation Requisition assign to production';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }else{
              if (isset($data["directsubmit"]) && empty($assignstaffid)){
                  $this->home_model->update("tbldesignrequisition", array("status" => 1), array("id" => $id));
              }
            }
            return $id;
        }
        return false;
    }

    public function requisition_upload($id, $filename) {

        if (isset($_FILES[$filename]['name']) && $_FILES[$filename]['name'] != '') {
            $CI = & get_instance();
            $CI->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            if ($filename == "designsubmission_files"){
                $path = get_upload_path_by_type('design_requisition') . 'design_submission'.'/';
                if (!file_exists($path)){
                   mkdir($path);
                }
            }else{
                $path = get_upload_path_by_type('design_requisition') . '/';
            }

            $cpt = count($_FILES[$filename]['name']);
            for($i=0; $i<$cpt; $i++)
            {
                $_FILES[$filename]['name']= $files[$filename]['name'][$i];
                $_FILES[$filename]['type']= $files[$filename]['type'][$i];
                $_FILES[$filename]['tmp_name']= $files[$filename]['tmp_name'][$i];
                $_FILES[$filename]['error']= $files[$filename]['error'][$i];
                $_FILES[$filename]['size']= $files[$filename]['size'][$i];

                $config = array();
                $config['upload_path'] =    $path;
                $config['allowed_types'] = '*';
                $config['max_size']      = '0';
                $config['encrypt_name']     = TRUE;

                $CI->upload->initialize($config);
                $CI->upload->do_upload($filename);

                $upload_data = $CI->upload->data();
                if (!empty($upload_data['file_name'])){
                    $dataInfo[] = $upload_data['file_name'];
                }
            }

            if (!empty($dataInfo)){
                $requisitionfiles = json_encode($dataInfo);
                $tablename = ($filename == "designsubmission_files") ? 'tbldesignsubmission' : 'tbldesignrequisitionremark';
                $this->home_model->update($tablename, array("files" => $requisitionfiles), array("id" => $id));
            }
        }
    }

    public function addDesignSubmission($data){
       // echo '<pre>';
       // print_r($_FILES);exit;
       $assignstaffid = array();
       if(!empty($data['assignproductionid'])){
           $assignstaff = $data['assignproductionid'];

           foreach ($assignstaff as $single_staff) {
               if (strpos($single_staff, 'staff') !== false) {
                   $assignstaffid[] = str_replace("staff", "", $single_staff);
               }
               if (strpos($single_staff, 'group') !== false) {
                   $single_staff = str_replace("group", "", $single_staff);
                   $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                   foreach ($staffgroup as $singlestaff) {
                       $assignstaffid[] = $singlestaff['staff_id'];
                   }
               }
           }
           unset($data['assignproductionid']);
           $assignstaffid = array_unique($assignstaffid);
       }

       $insertdata["designrequisition_id"] = $data["designrequisition_id"];
       $insertdata["drawing_id"] = $data["drawing_id"];
       $insertdata["remark"] = $data["remark"];
       $insertdata['created_at'] = date("Y-m-d H:i:s");
       $insertdata['updated_at'] = date("Y-m-d H:i:s");
       $this->db->insert('tbldesignsubmission', $insertdata);
       $insert_id = $this->db->insert_id();
       if ($insert_id){
           $this->requisition_upload($insert_id, "designsubmission_files");
           $this->home_model->update('tbldesignrequisition', array("design_status" => 0, "show_status" => 3),array('id'=>$data["designrequisition_id"]));
           $this->home_model->update('tbldesignsubmission', array("status" => 3),array('designrequisition_id'=>$data["designrequisition_id"], 'status' => 1));

           /* if assign production */
           if (!empty($assignstaffid)){
               foreach ($assignstaffid as $staffid) {
                   $sdata['staff_id'] = $staffid;
                   $sdata['designsubmission_id'] = $insert_id;
                   $sdata['status'] = '1';
                   $sdata['created_at'] = date("Y-m-d H:i:s");
                   $sdata['updated_at'] = date("Y-m-d H:i:s");
                   $this->db->insert('tbldesignsubmissionapproval', $sdata);

                   $adata = array(
                       'staff_id' => $staffid,
                       'fromuserid' => get_staff_user_id(),
                       'module_id' => 43,
                       'table_id' => $insert_id,
                       'approve_status' => 0,
                       'status' => 0,
                       'description'     => 'Design Submission assign to production',
                       'link' => 'designrequisition/designsubmission_approval/'.$insert_id,
                       'date' => date('Y-m-d'),
                       'date_time' => date('Y-m-d H:i:s'),
                       'updated_at' => date('Y-m-d H:i:s')
                   );
                   $this->db->insert('tblmasterapproval', $adata);

                   //Sending Mobile Intimation
                   $token = get_staff_token($staffid);
                   $message = 'Design Submission assign to production';
                   $title = 'Schach';
                   $send_intimation = sendFCM($message, $title, $token, $page = 2);
               }
           }
           return $insert_id;
       }
       return false;
    }

    public function upload_remark_drawing($data){
        // echo "<pre>";
        // print_r($_FILES);
        // print_r($data);
        // print_r($data["drawing_id"]);
        // print_r($data["designremark_id"]);
        // exit;

        $result = FALSE;
        if (isset($data['drequisitionremark'])){
            foreach ($data['drequisitionremark'] as $k => $remarkdata) {
                
                if (isset($remarkdata["remark_id"])){
                    
                    $udata["drawing_name"] = $remarkdata["drawing_name"];
                    $udata["drawing_id"] = $remarkdata["drawing_id"];
                    $udata["remark"] = $remarkdata["remark"];
                    $response = $this->home_model->update('tbldesignrequisitionremark', $udata, array("id" => $remarkdata["remark_id"]));
                    if ($response){
                        $this->drawing_submission_upload("update",$k,$remarkdata["remark_id"]);
                        $result = TRUE;
                    }
                }else{
                    
                    $insertdata["designrequisition_id"] = $data["designremark_id"];
                    $insertdata["drawing_name"] = $remarkdata["drawing_name"];
                    $insertdata["description"] = $remarkdata["description"];
                    $insertdata["drawing_id"] = $remarkdata["drawing_id"];
                    $insertdata["remark"] = $remarkdata["remark"];
                    $insertdata['created_at'] = date("Y-m-d H:i:s");
                    $insert_id = $this->home_model->insert('tbldesignrequisitionremark', $insertdata);
                    if ($insert_id){
                        $this->home_model->update('tbldesignrequisitionremark', array("activity_id" => $insert_id), array("id" => $insert_id));
                        $this->drawing_submission_upload("add",$k,$insert_id);
                        $result = TRUE;
                    }
                }
            }
        }
        return $result;
    }

    private function drawing_submission_upload($type,$k,$remark_id){
        $filename = ($type == 'add') ? "drawingremarkfile".$k : "drawingremarkfile".$remark_id;
        if (isset($_FILES[$filename]['name']) && $_FILES[$filename]['name'] != '') {
           
            $CI = & get_instance();
            $CI->load->library('upload');
            $dataInfo = array();
            $files = $_FILES;

            $path = get_upload_path_by_type('design_requisition') . 'design_remarks_files'.'/';
            if (!file_exists($path)){
                mkdir($path);
            }

            $cpt = count($_FILES[$filename]['name']);
            for($i=0; $i<$cpt; $i++)
            {
                $_FILES[$filename]['name']= $files[$filename]['name'][$i];
                $_FILES[$filename]['type']= $files[$filename]['type'][$i];
                $_FILES[$filename]['tmp_name']= $files[$filename]['tmp_name'][$i];
                $_FILES[$filename]['error']= $files[$filename]['error'][$i];
                $_FILES[$filename]['size']= $files[$filename]['size'][$i];

                $config = array();
                $config['upload_path'] =    $path;
                $config['allowed_types'] = '*';
                $config['max_size']      = '0';
                $config['encrypt_name']     = TRUE;

                $CI->upload->initialize($config);
                $CI->upload->do_upload($filename);

                $upload_data = $CI->upload->data();
                if (!empty($upload_data['file_name'])){
                    $dataInfo[] = $upload_data['file_name'];
                }
            }
            
            if (!empty($dataInfo)){
                $designfiles = value_by_id_empty("tbldesignrequisitionremark", $remark_id, "design_files");
                $requisitionfiles = json_encode($dataInfo);
                $this->home_model->update('tbldesignrequisitionremark', array("design_files" => $requisitionfiles), array("id" => $remark_id));

                /* remove old files */
                if (!empty($designfiles)){
                    $filesdata = json_decode($designfiles);
                    foreach ($filesdata as $k => $file1) {
                        $path = get_upload_path_by_type('design_requisition') . 'design_remarks_files'.'/'.$file1;
                        unlink($path);
                    }
                }
            }
        }
    }

    /* this function use for convert to master */
    public function convert_to_master($design_req_id, $data){

       $current_datetime = date('Y-m-d H:i:s');
       $assignstaffid = array();
       if(!empty($data['assignproductionid'])){
           $assignstaff = $data['assignproductionid'];

           foreach ($assignstaff as $single_staff) {
               if (strpos($single_staff, 'staff') !== false) {
                   $assignstaffid[] = str_replace("staff", "", $single_staff);
               }
               if (strpos($single_staff, 'group') !== false) {
                   $single_staff = str_replace("group", "", $single_staff);
                   $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                   foreach ($staffgroup as $singlestaff) {
                       $assignstaffid[] = $singlestaff['staff_id'];
                   }
               }
           }
           unset($data['assignproductionid']);
           $assignstaffid = array_unique($assignstaffid);
       }

       if (!empty($assignstaffid)){
           $remark_ids = implode(",", $data["remark_id"]);
           $submission_data = $this->db->query("SELECT `id` FROM `tbldesignsubmission` WHERE `designrequisition_id` = '".$design_req_id."' AND `status` = 1 ORDER BY id DESC ")->row();
           $submission_id = (!empty($submission_data)) ? $submission_data->id : 0;

           $insertdata["designsubmission_id"] = $submission_id;
           $insertdata["designrequisition_id"] = $design_req_id;
           $insertdata["remark_ids"] = $remark_ids;
           $insertdata["date"] = date("Y-m-d");
           $insertdata["remark"] = $data["remark"];
           $insertdata["created_at"] = $current_datetime;
           $insertdata["updated_at"] = $current_datetime;

           $this->db->insert('tbldesignmaster', $insertdata);
           $insert_id = $this->db->insert_id();
           if ($insert_id){

               if (!empty($assignstaffid)){
                   foreach ($assignstaffid as $staffid) {
                       $sdata['staff_id'] = $staffid;
                       $sdata['designmaster_id'] = $insert_id;
                       $sdata['status'] = '1';
                       $sdata['created_at'] = date("Y-m-d H:i:s");
                       $sdata['updated_at'] = date("Y-m-d H:i:s");
                       $this->db->insert('tbldesignmasterapproval', $sdata);

                       $adata = array(
                           'staff_id' => $staffid,
                           'fromuserid' => get_staff_user_id(),
                           'module_id' => 46,
                           'table_id' => $insert_id,
                           'approve_status' => 0,
                           'status' => 0,
                           'description'     => 'Design Master send for approval',
                           'link' => 'designrequisition/design_master_approval/'.$insert_id,
                           'date' => date('Y-m-d'),
                           'date_time' => date('Y-m-d H:i:s'),
                           'updated_at' => date('Y-m-d H:i:s')
                       );
                       $this->db->insert('tblmasterapproval', $adata);

                       //Sending Mobile Intimation
                       $token = get_staff_token($staffid);
                       $message = 'Design Master send for approval';
                       $title = 'Schach';
                       $send_intimation = sendFCM($message, $title, $token, $page = 2);
                   }
               }
               return $insert_id;
           }
       }
       return false;
    }
}

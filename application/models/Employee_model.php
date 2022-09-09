<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Employee_model extends CRM_Model {

    private $statuses;
    private $shipping_fields = ['shipping_street', 'shipping_city', 'shipping_city', 'shipping_state', 'shipping_zip', 'shipping_country'];

    public function __construct() {
        parent::__construct();
        $this->statuses = do_action('before_set_estimate_statuses', [
            1,
            2,
            5,
            3,
            4,
        ]);
    }

    public function add_work_report($data) {

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'date' => db_date($data['date']),
                'status' => 1,
                'created_date' => date('Y-m-d H:i:s')
          );
      

        $this->db->insert('tblemployeeworkreport', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {
           
            foreach ($data['saleproposal'] as $singlesalepro) {

                $saleitemdata['main_id'] = $insert_id;
                $saleitemdata['project'] = $singlesalepro['project'];
                $saleitemdata['module'] = $singlesalepro['module'];
                $saleitemdata['start_time'] = $singlesalepro['start_time'];
                $saleitemdata['end_time'] = $singlesalepro['end_time'];
                $saleitemdata['description'] = $singlesalepro['description'];
                $saleitemdata['status'] = 1;
                $this->db->insert('tblemployeeworkreportlist', $saleitemdata);                
                $saleitemid = $this->db->insert_id();               
            }          
            

            return $insert_id;
        }

        return false;
    }


public function edit_work_report($data,$id) {

         $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'date' => db_date($data['date']),
                'status' => 1
          );            
       
        $this->db->where('id', $id);
        $this->db->update('tblemployeeworkreport', $ad_data);
                 
        if ($id) {
           
           //deleting last records
           $this->db->where('main_id', $id);
           $this->db->delete('tblemployeeworkreportlist');


            foreach ($data['saleproposal'] as $singlesalepro) {

                $saleitemdata['main_id'] = $id;
                $saleitemdata['project'] = $singlesalepro['project'];
                $saleitemdata['module'] = $singlesalepro['module'];
                $saleitemdata['start_time'] = $singlesalepro['start_time'];
                $saleitemdata['end_time'] = $singlesalepro['end_time'];
                $saleitemdata['description'] = $singlesalepro['description'];
                $saleitemdata['status'] = 1;
                $this->db->insert('tblemployeeworkreportlist', $saleitemdata);                
                $saleitemid = $this->db->insert_id(); 
              
            }

            return $id;
        }

        return false;
    }

    /* add sales report of staff */
    public function add_sales_report($data){
        
        $ad_data = array(
            'staff_id' => get_staff_user_id(),
            'salesdate' => db_date($data['salesdate']),
            'remark' => $data['remark'],
            'created_at' => date('Y-m-d H:i:s')
        );     

        $this->db->insert('tblstaffsalesreport', $ad_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
           
            $i = 0;
            foreach ($data['salesdetails'] as $singlesale) {

                $clientname =  (isset($singlesale['client_name'])) ? $singlesale['client_name'] : "";
                $client_id = 0;
                if (isset($singlesale['client_id'])){
                    $client_id = $singlesale['client_id'];
                    $clientinfo = client_info($singlesale['client_id']);
                    $clientname = $clientinfo->client_branch_name;
                }

                $product_name =  (isset($singlesale['product_name'])) ? $singlesale['product_name'] : "";
                $product_category_id = 0;
                if (isset($singlesale['product_category_id'])){
                    $product_category_id = $singlesale['product_category_id'];
                    $product_name = value_by_id('tblsalesproductmaster',$singlesale['product_category_id'],'product_name');
                }

                $saleitemdata['staffsalesreport_id'] = $insert_id;
                $saleitemdata['client_id'] = $client_id;
                $saleitemdata['clientname'] = $clientname;
                $saleitemdata['contact_person'] = $singlesale['contact_parson'];
                $saleitemdata['contact_number'] = $singlesale['contact_number'];
                $saleitemdata['email_id'] = $singlesale['email'];
                $saleitemdata['address'] = $singlesale['address'];
                $saleitemdata['remark'] = $singlesale['remark'];
                $saleitemdata['industry'] = $singlesale['industry'];
                $saleitemdata['product_category_id'] = $product_category_id;
                $saleitemdata['product_name'] = $product_name;
                $saleitemdata['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('tblstaffsalesreportdetails', $saleitemdata);                
                $saleitemid = $this->db->insert_id();               

                $this->upload_attachment_files($saleitemid, "file_".$i, "sales_report");
                //  if (isset($singlesale["file"])){
                //     upload_attachment_files($id, "file_".$i, $type);
                //     handle_multi_handover_attachments($saleitemid, "sales_report");
                // }
                $i++;    
            }          

            

            return $insert_id;
        }

        return false;
    }

    /* edit sales report of staff */
    public function edit_sales_report($data, $id){

        $ad_data = array(
            'staff_id' => get_staff_user_id(),
            'salesdate' => db_date($data['salesdate']),
            'remark' => $data['remark']
        );     

        $this->db->where('id', $id);
        $this->db->update('tblstaffsalesreport', $ad_data);

       
        if ($id) {
           
            $this->delete_files($id);

            $i = 0;
            foreach ($data['salesdetails'] as $singlesale) {

                $clientname =  (isset($singlesale['client_name'])) ? $singlesale['client_name'] : "";
                $client_id = 0;
                if (isset($singlesale['client_id'])){
                    $client_id = $singlesale['client_id'];
                    $clientinfo = client_info($singlesale['client_id']);
                    $clientname = $clientinfo->client_branch_name;
                }

                $product_name =  (isset($singlesale['product_name'])) ? $singlesale['product_name'] : "";
                $product_category_id = 0;
                if (isset($singlesale['product_category_id'])){
                    $product_category_id = $singlesale['product_category_id'];
                    $product_name = value_by_id('tblsalesproductmaster',$singlesale['product_category_id'],'product_name');
                }

                $saleitemdata['staffsalesreport_id'] = $id;
                $saleitemdata['client_id'] = $client_id;
                $saleitemdata['clientname'] = $clientname;
                $saleitemdata['contact_person'] = $singlesale['contact_parson'];
                $saleitemdata['contact_number'] = $singlesale['contact_number'];
                $saleitemdata['email_id'] = $singlesale['email'];
                $saleitemdata['address'] = $singlesale['address'];
                $saleitemdata['remark'] = $singlesale['remark'];
                $saleitemdata['industry'] = $singlesale['industry'];
                $saleitemdata['product_category_id'] = $product_category_id;
                $saleitemdata['product_name'] = $product_name;
                $saleitemdata['created_at'] = date('Y-m-d H:i:s');
                $this->db->insert('tblstaffsalesreportdetails', $saleitemdata);                
                $saleitemid = $this->db->insert_id();               

                $this->upload_attachment_files($saleitemid, "file_".$i, "sales_report");
                // if (isset($singlesale["file"])){
                //     handle_multi_handover_attachments($saleitemid, "sales_report");
                // }
                $i++;
            }          
            return $id;
        }

        return false;
    }

    private function change_date_formate($date){
        $date1 = explode("/", $date);
        return $date1[2]."-".$date1[0]."-".$date1[1];
    }

    public function delete_files($id){

        $this->db->where('staffsalesreport_id', $id);
        $details = $this->db->get('tblstaffsalesreportdetails')->result_array();

        if ($details){
            foreach ($details as $value) {

                // print_r($value);exit;

                /* get files */
                $this->db->where('rel_id', $value['id']);
                $this->db->where('rel_type', "sales_report");
                $file = $this->db->get('tblfiles')->row();
                if (!empty($file)){
                    $path = get_upload_path_by_type('sales_report') . $file->rel_id . '/' . $file->file_name;
                    if (file_exists($path)) {
                         unlink($path);
                    }

                    $this->db->where('rel_id', $value['id']);
                    $this->db->where('rel_type', "sales_report");
                    $this->db->delete('tblfiles');
                }
                $this->db->where('id', $value['id']);
                $this->db->delete('tblstaffsalesreportdetails');
            }
        }
    }

    function upload_attachment_files($id, $file_name, $type) {

        if (isset($_FILES[$file_name]) && _perfex_upload_error($_FILES[$file_name]['error'])) {
            header('HTTP/1.0 400 Bad error');
            return _perfex_upload_error($_FILES[$file_name]['error']);
            //die;
        }
       
        $path = get_upload_path_by_type($type) . $id . '/';
        $CI = & get_instance();

        if (isset($_FILES[$file_name]['name'])) {

            do_action('before_upload_expense_attachment', $id);
            // Get the temp file path
            $tmpFilePath = $_FILES[$file_name]['tmp_name'];
            // Make sure we have a filepath
            
            if (!empty($tmpFilePath) && $tmpFilePath != '') {
                _maybe_create_upload_path($path);

                $filename = $_FILES[$file_name]['name'];
                $newFilePath = $path . $filename;
                
                $attachment = [];
                    $attachment[] = [
                        'file_name' => $filename,
                        'filetype' => $_FILES[$file_name]['type'],
                    ];
                
                // Compress Image
                compressImage($tmpFilePath,$newFilePath,15);
                array_push($result, $CI->misc_model->add_attachment_to_database($id, $type, $attachment));
            }
        }
    }

    /* this function use for get employee monthly target */
    function getEmployeeMonthlyTarget($staff_id, $category_id, $month, $year){
        $where = "`staff_id`='".$staff_id."' AND `product_category_id`='".$category_id."' AND `month`='".$month."' AND `year`='".$year."'";
        $chk_log = $this->db->query("SELECT `amount` FROM `tblemployeetarget_log` WHERE ".$where." ")->row();
        if (!empty($chk_log)){
            return $chk_log->amount;
        }else{
            $emptarget = $this->db->query("SELECT `amount` FROM `tblemployeetarget` WHERE `staff_id`='".$staff_id."' AND `product_category_id`='".$category_id."' ORDER BY `id` DESC")->row();
            if (!empty($emptarget)){
                return $emptarget->amount;
            }
        }
        return "0.00";
    }

    public function add_software_task($data) {
        
        foreach ($data['saleproposal'] as $k => $singlesalepro) {

            $saleitemdata['added_by'] = get_staff_user_id();
            $saleitemdata['date'] = date('Y-m-d');                
            $saleitemdata['module'] = $singlesalepro['module'];
            $saleitemdata['priority'] = $singlesalepro['priority'];
            $saleitemdata['description'] = $singlesalepro['description'];
            $saleitemdata['target_date'] = db_date($singlesalepro['target_date']);
            $saleitemdata['status'] = 2;
            $saleitemdata['updated_at'] = date("Y-m-d H:i:s");
            $this->db->insert('tblsoftwaretask', $saleitemdata);                
            $saleitemid = $this->db->insert_id();    
            software_task_image_upload($saleitemid, 'file_'.$k);           
        }
         
        if ($saleitemid) {            

            return $saleitemid;
        }

        return false;
    }
}

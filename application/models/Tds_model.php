<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Tds_model extends CRM_Model {

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

    public function add($data) {
                   
       

       $assignstaff = $data['assignid'];
       
       if(!empty($assignstaff)){
            foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
              
            }
            $staff_id = array_unique($staff_id);

            $staff_str = implode(",",$staff_id);
       }else{
            $staff_str = '';
       } 

       $pay_id_str =  implode(',', $data['row']);    
       

       $ad_data = array(
            'staff_id' => get_staff_user_id(),
            'remark' => $data['remark'],
            'assignid' => $staff_str,
            'pay_id' => $pay_id_str,
            'created_date' => date('Y-m-d'),
        );

      
       

        $this->db->insert('tbltds_reconciliation', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {  


            if(!empty($data['row'])){
                foreach ($data['row'] as $r) {
                    $amount = $_POST['amount_'.$r];
                    $ad_data_1 = array(
                        'main_id' => $insert_id,
                        'pay_id' => $r,
                        'amount' => $amount
                    );
                    $this->db->insert('tbltds_amountapproval', $ad_data_1);

                    $u_data['showInReconciliation'] = 0;
                    $this->db->where('id', $r);
                    $this->db->update('tblinvoicepaymentrecords', $u_data);
                }
            }          
            
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['main_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbltdsapproval', $sdata);



                    /*$full_name = get_employee_fullname(get_staff_user_id());   

                    $notified = add_notification([
                        'description' => 'TDS Reconciliation Send to you for Approval',
                        'touserid' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'from_fullname' => $full_name,
                        'table_id' => $insert_id,
                        'module_id' => 15,
                        'link' => 'tds/approval/' . $insert_id,
                        
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$staffid]);
                    }*/

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => get_staff_user_id(),
                        'module_id' => 6,
                        'description' => 'TDS Reconciliation Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'tds/approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata); 
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'TDS Reconciliation Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            

            return $insert_id;
        }

        return false;
    }


}

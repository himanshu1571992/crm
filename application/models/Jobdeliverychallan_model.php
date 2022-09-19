<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Jobdeliverychallan_model extends CRM_Model {

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

        $site_id = (!empty($data['site_id'])) ? $data['site_id'] : 0;
        
        $ad_data = array(
                        'vendor_id' => $data['vendor_id'],
                        'site_id' => $site_id,
                        'billing_branch_id' => $data['billing_branch_id'],
                        'warehouse_id' => $data['warehouse_id'],
                        'store_type' => $data['store_type'],
                        'service_type' => 2,
                        'billing_street' => $data['billing_street'],
                        'billing_city' => $data['billing_city'],
                        'billing_state' => $data['billing_state'],
                        'billing_zip' => $data['billing_zip'],
                        'shipping_street' => $data['shipping_street'],
                        'shipping_city' => $data['shipping_city'],
                        'shipping_state' => $data['shipping_state'],
                        'shipping_zip' => $data['shipping_zip'],
                        'year_id' => financial_year(),
                        'date' => db_date($data['date']),
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
//                        'terms_and_conditions' => $data['terms_and_conditions'],
                        'material_sending_for' => $data['material_sending'],
                        'transporter_name' => $data['transporter_name'],
                        'vehicle_no' => $data['vehicle_no'],
                        'driver_name' => $data['driver_name'],
                        'driver_no' => $data['driver_no'],
                        'status' => 0,
                        'added_by' => get_staff_user_id(),
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                  );

        $this->db->insert('tbljobdelivarychallan', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {
           
            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['delivarychallan_id'] = $insert_id;
                $saleitemdata['unit_id'] = $singlesalepro['unit_id'];
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['remark'] = $singlesalepro['remark'];
                $this->db->insert('tbljobdelivarychallanproduct', $saleitemdata);
            }
            
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['delivarychallan_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbljobdelivarychallanapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 32,
                        'description' => 'Job delivery challan send to you for approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'jobdeliverychallan/jobdeliverychallan_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata); 
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Job delivery challan Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            

            return $insert_id;
        }

        return false;
    }


    public function update($data,$id) {
                   
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

        $site_id = (!empty($data['site_id'])) ? $data['site_id'] : 0;
        
       $ad_data = array(
                        'vendor_id' => $data['vendor_id'],
                        'site_id' => $site_id,
                        'billing_branch_id' => $data['billing_branch_id'],
                        'warehouse_id' => $data['warehouse_id'],
                        'store_type' => $data['store_type'],
                        'service_type' => 2,
                        'billing_street' => $data['billing_street'],
                        'billing_city' => $data['billing_city'],
                        'billing_state' => $data['billing_state'],
                        'billing_zip' => $data['billing_zip'],
                        'shipping_street' => $data['shipping_street'],
                        'shipping_city' => $data['shipping_city'],
                        'shipping_state' => $data['shipping_state'],
                        'shipping_zip' => $data['shipping_zip'],
                        'year_id' => financial_year(),
                        'date' => db_date($data['date']),
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
//                        'terms_and_conditions' => $data['terms_and_conditions'],
                        'material_sending_for' => $data['material_sending'],
                        'transporter_name' => $data['transporter_name'],
                        'vehicle_no' => $data['vehicle_no'],
                        'driver_name' => $data['driver_name'],
                        'driver_no' => $data['driver_no'],
                        'status' => 0,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                  );
       
        $this->db->where('id', $id);
        $this->db->update('tbljobdelivarychallan', $ad_data);
                 
        if ($id) {
           
           //deleting last records
           $this->db->where('delivarychallan_id', $id);
           $this->db->delete('tbljobdelivarychallanproduct');

            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['delivarychallan_id'] = $id;
                $saleitemdata['unit_id'] = $singlesalepro['unit_id'];
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['remark'] = $singlesalepro['remark'];
                $this->db->insert('tbljobdelivarychallanproduct', $saleitemdata);
            }
            
            //deleting last records
           $this->db->where('delivarychallan_id', $id);
           $this->db->delete('tbljobdelivarychallanapproval');

           //deleting last records
            $this->db->where('table_id', $id);
            $this->db->where('module_id', 32);
            $this->db->delete('tblmasterapproval');
            
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['delivarychallan_id'] = $id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbljobdelivarychallanapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 32,
                        'description' => 'Job delivery challan send to you for approval',
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'jobdeliverychallan/jobdeliverychallan_approval/' . $id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata); 
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Job delivery challan Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            

            return $id;
        }

        return false;
    }
    
    public function addchallanreturn($deliverychallan_id, $data) {
       
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

        $site_id = (!empty($data['site_id'])) ? $data['site_id'] : 0;
        
       $ad_data = array(
                        'delivarychallan_id' => $deliverychallan_id,
                        'vendor_id' => $data['vendor_id'],
                        'site_id' => $site_id,
                        'billing_branch_id' => $data['billing_branch_id'],
                        'service_type' => $data['service_type'],
                        'billing_street' => $data['billing_street'],
                        'billing_city' => $data['billing_city'],
                        'billing_state' => $data['billing_state'],
                        'billing_zip' => $data['billing_zip'],
                        'shipping_street' => $data['shipping_street'],
                        'shipping_city' => $data['shipping_city'],
                        'shipping_state' => $data['shipping_state'],
                        'shipping_zip' => $data['shipping_zip'],
                        'year_id' => financial_year(),
                        'date' => db_date($data['date']),
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
                        'status' => 0,
                        'created_at' => date("Y-m-d H:i:s"),
                        'updated_at' => date("Y-m-d H:i:s"),
                );

        $this->db->insert('tbljobdelivarychallanreturn', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {
            
            /* this is for update challan return id update */
            $this->home_model->update("tbljobdelivarychallan", array("deliverychallanreturn_id" => $insert_id), array("id" => $deliverychallan_id));
            
            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['delivarychallanreturn_id'] = $insert_id;
                $saleitemdata['unit_id'] = $singlesalepro['unit_id'];
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['remark'] = $singlesalepro['remark'];
                $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                $this->db->insert('tbljobdelivarychallanreturnproduct', $saleitemdata);
            }
            
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['delivarychallanreturn_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbljobdelivarychallanreturnapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 33,
                        'description' => 'Job delivery challan return send to you for approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'jobdeliverychallan/jobdeliverychallanreturn_approval/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata); 
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Job delivery challan return Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            
            return $insert_id;
        }
        return false;
    }
    
    public function editchallanreturn($id, $data) {
                   
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

        $site_id = (!empty($data['site_id'])) ? $data['site_id'] : 0;
        
        $ad_data = array(
                'vendor_id' => $data['vendor_id'],
                'site_id' => $site_id,
                'billing_branch_id' => $data['billing_branch_id'],
                'service_type' => $data['service_type'],
                'billing_street' => $data['billing_street'],
                'billing_city' => $data['billing_city'],
                'billing_state' => $data['billing_state'],
                'billing_zip' => $data['billing_zip'],
                'shipping_street' => $data['shipping_street'],
                'shipping_city' => $data['shipping_city'],
                'shipping_state' => $data['shipping_state'],
                'shipping_zip' => $data['shipping_zip'],
                'year_id' => financial_year(),
                'date' => db_date($data['date']),
                'assignid' => $staff_str,
                'adminnote' => $data['adminnote'],
                'status' => 0,
                'created_at' => date("Y-m-d H:i:s"),
                'updated_at' => date("Y-m-d H:i:s"),
          );
       
        $this->db->where('id', $id);
        $this->db->update('tbljobdelivarychallanreturn', $ad_data);
                 
        if ($id) {
           
           //deleting last records
           $this->db->where('delivarychallanreturn_id', $id);
           $this->db->delete('tbljobdelivarychallanreturnproduct');

            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['delivarychallanreturn_id'] = $id;
                $saleitemdata['unit_id'] = $singlesalepro['unit_id'];
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['remark'] = $singlesalepro['remark'];
                $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                $this->db->insert('tbljobdelivarychallanreturnproduct', $saleitemdata);
            }
            
            //deleting last records
           $this->db->where('delivarychallanreturn_id', $id);
           $this->db->delete('tbljobdelivarychallanreturnapproval');

           //deleting last records
            $this->db->where('table_id', $id);
            $this->db->where('module_id', 33);
            $this->db->delete('tblmasterapproval');
            
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['delivarychallanreturn_id'] = $id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tbljobdelivarychallanreturnapproval', $sdata);

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 33,
                        'description' => 'Job delivery challan return send to you for approval',
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'jobdeliverychallan/jobdeliverychallanreturn_approval/' . $id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );  
                    $this->db->insert('tblmasterapproval', $adata); 
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Job delivery challan return Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            return $id;
        }

        return false;
    }
}

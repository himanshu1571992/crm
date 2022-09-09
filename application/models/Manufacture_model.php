<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Manufacture_model extends CRM_Model {

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

  
 public function add_manufacture($data) {
                   
       

       $assignstaff = $data['assignid'];

       foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }          
        }

        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

      
        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'mr_id' => $data['mr_id'],
                'reference_no' => $data['reference_no'],
                'date' => $date,
                'assignid' => $staff_str,
                'remark' => $data['remark'],                              
                'status' => 0,                        
                'created_at' => date('Y-m-d H:i:s'),
          );

        $this->db->insert('tblmanufacture', $ad_data);
        $insert_id = $this->db->insert_id();
         
        if ($insert_id) {
           
            if(!empty($data['product'])){
               foreach ($data['product'] as $p_id) {
                    $product_qty = $_POST['product_qty'.$p_id];
                    $rate = $_POST['rate_'.$p_id];
                    $ttl_qty = $_POST['ttl_qty_'.$p_id];
                    $ttl_bundle_weight = $_POST['ttl_bundlewt_'.$p_id];
                    $rate_per_pcs = $_POST['rate_per_pcs'.$p_id];

                    $itemdata['m_id'] = $insert_id;
                    $itemdata['product_id'] = $p_id;
                    $itemdata['product_qty'] = $product_qty;
                    $itemdata['rate'] = $rate;
                    $itemdata['ttl_qty'] = $ttl_qty;
                    $itemdata[' ttl_bundle_weight'] = $ttl_bundle_weight;
                    $itemdata['rate_per_pcs'] = $rate_per_pcs;
                    $this->db->insert('tblmanufactureproducts', $itemdata);
                    $itemid = $this->db->insert_id();


                    //Adding values on bundel table
                    $bundle_array = $_POST['customdata']['bundle_no_'.$p_id];
                    if(!empty($bundle_array)){
                        foreach ($bundle_array as $key => $value) {
                            $bundle_no = $value;
                            $bundle_qty = $_POST['customdata']['bundle_qty_'.$p_id][$key];
                            $weight_per_psc = $_POST['customdata']['weight_per_psc_'.$p_id][$key];
                            $bundle_weight = $_POST['customdata']['bundle_weight_'.$p_id][$key];


                            $bundledata['m_id'] = $insert_id;
                            $bundledata['mp_id'] = $itemid;
                            $bundledata['bundle_no'] = $bundle_no;
                            $bundledata['qty'] = $bundle_qty;
                            $bundledata['weight_per_psc'] = $weight_per_psc;
                            $bundledata['bundle_weight'] = $bundle_weight;
                            $this->db->insert('tblmanufactureproductbundles', $bundledata);

                        }
                    }

                } 
            }


            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['m_id'] = $insert_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmanufactureapproval', $sdata);



                /*$full_name = get_employee_fullname(get_staff_user_id());   

                $notified = add_notification([
                    'description' => 'Manufacture Stock send to you for Approval',
                    'touserid' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'from_fullname' => $full_name,
                    'table_id' => $insert_id,
                    'module_id' => 0,
                    'link' => 'manufacture/stock_approval/' . $insert_id,
                    
                ]);
                if ($notified) {
                    pusher_trigger_notification([$staffid]);
                }*/

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 5,
                    'description' => 'Manufacture Stock send to you for Approval',
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'manufacture/stock_approval/' . $insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );  
                $this->db->insert('tblmasterapproval', $adata); 
                
                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Manufacture Stock send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }

            return $insert_id;
        }

        return false;
    }



}

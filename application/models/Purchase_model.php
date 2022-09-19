<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Purchase_model extends CRM_Model {

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
        
        // echo "<pre>";
        // print_r($data['saleproposal']);
        // exit;
        $material_recept_ids = '';
        if(!empty($data['material_recept_ids'])){
            $material_recept_ids = $data['material_recept_ids'];
        }

        $mr_str = '';
        if(!empty($data['mr_id'])){
            $mr_str = implode(",",$data['mr_id']);
        }

        $assignstaff = $data['assignid'];
        $othercharges = $data['othercharges'];

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

        /*$date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));*/

        $quotation_date = str_replace("/","-",$data['quotation_date']);
        $quotation_date = date("Y-m-d",strtotime($quotation_date));


        if(!empty($data['save'])){
            $save = 1;
        }else{
            $save = 0;
        }

        if(!empty($data['revised_id'])){
            $revised_id = $data['revised_id'];
        }else{
            $revised_id = 0;
        }

        if(!empty($data['warehouse_id'])){
            $warehouse_id = $data['warehouse_id'];
        }else{
            $warehouse_id = 0;
        }

        if(!empty($data['site_id'])){
            $site_id = $data['site_id'];
        }else{
            $site_id = 0;
        }

        if(!empty($material_recept_ids))
        {
            $mr_pro_ids=explode(',',$material_recept_ids);
             foreach($mr_pro_ids as $mrids)
            {
                $this->db->where('id', $mrids);
                $this->db->update('tblmaterialreceipt', array('gas_po_status' => 1));
            }
        }

        if(empty($data['po_type'])){
            $data['po_type'] = 1;
        }

        $po_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $po_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $po_number = $number_arr[0];
            }
        }
       $roundoff_amt = (!empty($data['roundoff_amount'])) ? $data['roundoff_amount'] : '0.00';
       $roundoff_remark = (!empty($data['roundoff_remark'])) ? $data['roundoff_remark'] : '0.00';
       $transportation_charges = (isset($data['transportation_charges']) && !empty($data['transportation_charges']) && $data['transportation_charges_chkbox'] == 'on') ? $data['transportation_charges'] : '0.00';
       // $totalamount = (!empty($data['roundoff_amount'])) ? $data['saleproposal']['totalamount'] + $data['roundoff_amount'] : $data['saleproposal']['totalamount'];
       $terms_and_conditions = (isset($data['terms_and_conditions']) && !empty($data['terms_and_conditions'])) ? $data['terms_and_conditions'] : "";
        $expected_mr_date = (isset($data['expected_mr_date']) && $data['expected_mr_date'] != '') ? db_date($data['expected_mr_date']) : '';
        $tentative_complete_date = (isset($data['tentative_complete_date']) && $data['tentative_complete_date'] != '') ? db_date($data['tentative_complete_date']) : '';
       $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'vendor_id' => $data['vendor_id'],
                        'source_type' => $data['source_type'],
                        'warehouse_id' => $warehouse_id,
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
                        'date' => db_date($data['date']),
                        'save' => $save,
                        'revised_id' => $revised_id,
                        'quotation_date' => $quotation_date,
                        'confirm_by' => $data['confirm_by'],
                        'tax_type' => $data['tax_type'],
                        'order_type' => $data['order_type'],
                        'po_number' => $po_number,
                        'year_id' => financial_year(),
                        'number' => $data['number'],
                        'prefix' => 'PO-',
                        'reference_no' => $data['reference_no'],
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
                        'terms_and_conditions' => $terms_and_conditions,
                        'product_terms_and_conditions' => $data['product_terms_and_conditions'],
                        'specification' => $data['specification'],
                        'adminnote' => $data['adminnote'],
                        'other_charges_tax' => $data['other_charges_tax'],
                        'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
                        'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
                        'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
                        'totalamount' => $data['saleproposal']['totalamount'],
                        'created_date' => date('Y-m-d'),
                        'created_at' => date('Y-m-d H:i:s'),
                        'mr_ids' => $mr_str,
                        'po_type' => $data['po_type'],
                        'roundoff_amount' => $roundoff_amt,
                        'roundoff_remark' => $roundoff_remark,
                        'transportation_charges' => $transportation_charges,
                        'division_id' => $data['division_id'],
                        'expected_mr_date' => $expected_mr_date,
                        'vendor_contact_number' => $data["vendor_contact_number"],
                        'vendor_contact_person' => $data["vendor_contact_person"],
                        'billing_contact_number' => $data["billing_contact_number"],
                        'billing_contact_name' => $data["billing_contact_name"],
                        'billing_contact_email' => $data["billing_contact_email"],
                        'tentative_complete_date' => $tentative_complete_date,
                  );

                    // echo "<pre>";
                    // print_r($ad_data);exit;
        $this->db->insert('tblpurchaseorder', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

            /* this is for new terms and condition */
            $terms_conditionarr = (isset($data["termscondition"])) ? $data["termscondition"] : [];
            /* store terms and condtion in new table */
            if (!empty($terms_conditionarr)){
               foreach ($terms_conditionarr as $terms) {
                   if (!empty($terms['condition'])){
                       $insertterms["rel_id"] = $insert_id;
                       $insertterms["rel_type"] = 'purchase_order';
                       $insertterms["condition_type"] = 2;
                       $insertterms["condition"] = $terms['condition'];
                       $this->home_model->insert('tbltermsandconditionsales', $insertterms);
                   }
               }
            }

            /* this is for update purchase order id in the requirement */
            if (isset($data['req_vendor_id']) && !empty($data['req_vendor_id'])){
                $vendorid = value_by_id('tblrequirement_productvendors', $data['req_vendor_id'], 'vendor_id');
                $this->home_model->update('tblrequirement_productvendors', array("converted_po_id" => $insert_id), array("vendor_id" => $vendorid));
                if (isset($data['req_id']) && !empty($data['req_id'])){
                    $ttlvendorcount = $this->db->query("SELECT COUNT(*) as ttlcount FROM tblrequirement_productvendors WHERE `req_id`= '".$data['req_id']."' and `approve` = 1 and converted_po_id = 0")->row()->ttlcount; 
                    if ($ttlvendorcount == 0){
                        $this->home_model->update('tblrequirement', array("po_status" => 1), array("id" => $data['req_id']));
                    }
                }
            }
            
            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['po_id'] = $insert_id;
                $saleitemdata['unit_id'] = $singlesalepro['unit_id'];
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                $saleitemdata['discount'] = $singlesalepro['discount'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $saleitemdata['remark'] = $singlesalepro['remark'];
                $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                $this->db->insert('tblpurchaseorderproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();
            }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {
                    if (!isset($odata['igst'])) {
                        $totaltax = $odata['gst'] + $odata['sgst'];
                        $odata['isgst'] = 1;
                    } else {
                        $totaltax = $odata['igst'];
                        $odata['isgst'] = 0;
                    }
                    $otherchargeamt[] = $odata['amount'] + (($odata['amount'] * $totaltax) / 100);
                    $odata['proposalid'] = $insert_id;
                    $odata['is_sale'] = 0;
                    $odata['created_at'] = date("Y-m-d H:i:s");
                    $odata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseothercharges', $odata);
                }
            }


            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['po_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseorderapproval', $sdata);



                    /*$full_name = get_employee_fullname(get_staff_user_id());

                    $notified = add_notification([
                        'description' => 'Purchase Order Send to you for Approval',
                        'touserid' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'from_fullname' => $full_name,
                        'table_id' => $insert_id,
                        'module_id' => 6,
                        'link' => 'purchase/purchaseorder_details/' . $insert_id,

                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$staffid]);
                    }*/

                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 3,
                        'description' => 'Purchase Order Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/purchaseorder_details/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Purchase Order ('.$data['number'].') Send to you for Approval';
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
       $othercharges = (isset($data['othercharges'])) ? $data['othercharges'] : "";

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


        /*$date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));*/

        $quotation_date = str_replace("/","-",$data['quotation_date']);
        $quotation_date = date("Y-m-d",strtotime($quotation_date));

        if(!empty($data['save'])){
            $save = 1;
        }else{
            $save = 0;
        }

        if(!empty($data['warehouse_id'])){
            $warehouse_id = $data['warehouse_id'];
        }else{
            $warehouse_id = 0;
        }

        if(!empty($data['site_id'])){
            $site_id = $data['site_id'];
        }else{
            $site_id = 0;
        }

        $purchase_info = $this->db->query("SELECT * from tblpurchaseorder where id = '".$id."' ")->row_array();
        $recon_status = $purchase_info['status'];
        if($recon_status == 4)
        {
            $status = '0';
        }
        $po_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $po_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $po_number = $number_arr[0];
            }
        }
        // echo "<pre>";
        // print_r($data);
        // exit;
        $roundoff_amt = (!empty($data['roundoff_amount'])) ? $data['roundoff_amount'] : '0.00';
        $roundoff_remark = (!empty($data['roundoff_remark'])) ? $data['roundoff_remark'] : '0.00';
        $transportation_charges = (isset($data['transportation_charges']) && !empty($data['transportation_charges']) && $data['transportation_charges_chkbox'] == 'on') ? $data['transportation_charges'] : '0.00';
        // $totalamount = (!empty($data['roundoff_amount'])) ? $data['saleproposal']['totalamount'] + $data['roundoff_amount'] : $data['saleproposal']['totalamount'];
        $terms_and_conditions = (isset($data['terms_and_conditions']) && !empty($data['terms_and_conditions'])) ? $data['terms_and_conditions'] : NULL;
        $expected_mr_date = (isset($data['expected_mr_date']) && $data['expected_mr_date'] != '') ? db_date($data['expected_mr_date']) : '';
        $tentative_complete_date = (isset($data['tentative_complete_date']) && $data['tentative_complete_date'] != '') ? db_date($data['tentative_complete_date']) : '';
        $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'vendor_id' => $data['vendor_id'],
                        'source_type' => $data['source_type'],
                        'warehouse_id' => $warehouse_id,
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
                        'date' => db_date($data['date']),
                        'save' => $save,
                        'quotation_date' => $quotation_date,
                        'confirm_by' => $data['confirm_by'],
                        'tax_type' => $data['tax_type'],
                        'order_type' => $data['order_type'],
                        'po_number' => $po_number,
                        'year_id' => financial_year(),
                        'number' => $data['number'],
                        'prefix' => 'PO-',
                        'reference_no' => $data['reference_no'],
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
                        'terms_and_conditions' => $terms_and_conditions,
                        'product_terms_and_conditions' => $data['product_terms_and_conditions'],
                        'specification' => $data['specification'],
                        'other_charges_tax' => $data['other_charges_tax'],
                        'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
                        'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
                        'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
                        'totalamount' => $data['saleproposal']['totalamount'],
                        'status' => $status,
                        'roundoff_amount' => $roundoff_amt,
                        'roundoff_remark' => $roundoff_remark,
                        'transportation_charges' => $transportation_charges,
                        'division_id' => $data['division_id'],
                        'expected_mr_date' => $expected_mr_date,
                        'vendor_contact_number' => $data["vendor_contact_number"],
                        'vendor_contact_person' => $data["vendor_contact_person"],
                        'billing_contact_number' => $data["billing_contact_number"],
                        'billing_contact_name' => $data["billing_contact_name"],
                        'billing_contact_email' => $data["billing_contact_email"],
                        'tentative_complete_date' => $tentative_complete_date,
                  );

        $this->db->where('id', $id);
        $this->db->update('tblpurchaseorder', $ad_data);

        if ($id) {

          $terms_conditionarr = (isset($data["termscondition"])) ? $data["termscondition"] : [];
          /* store terms and condtion in new table */
          if (!empty($terms_conditionarr)){
             $this->home_model->update('tblpurchaseorder', array("terms_and_conditions" => NULL), array("id" => $id));
             $this->home_model->delete('tbltermsandconditionsales', array('rel_id' => $id, 'condition_type'=> 2,'rel_type'=> 'purchase_order'));
             foreach ($terms_conditionarr as $terms) {

                 if (!empty($terms['condition'])){
                     $insertterms["rel_id"] = $id;
                     $insertterms["rel_type"] = 'purchase_order';
                     $insertterms["condition_type"] = 2;
                     $insertterms["condition"] = $terms['condition'];
                     $this->home_model->insert('tbltermsandconditionsales', $insertterms);
                 }
             }
          }

           //deleting last records
           $this->db->where('po_id', $id);
           $this->db->delete('tblpurchaseorderproduct');

           $this->db->where('proposalid', $id);
           $this->db->delete('tblpurchaseothercharges');

           foreach ($othercharges as $odata) {
                if (!isset($odata['igst'])) {
                    $totaltax = $odata['gst'] + $odata['sgst'];
                    $odata['isgst'] = 1;
                } else {
                    $totaltax = $odata['igst'];
                    $odata['isgst'] = 0;
                }
                $otherchargeamt[] = $odata['amount'] + (($odata['amount'] * $totaltax) / 100);
                $odata['proposalid'] = $id;
                $odata['is_sale'] = 0;
                $odata['created_at'] = date("Y-m-d H:i:s");
                $odata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblpurchaseothercharges', $odata);
            }

            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['po_id'] = $id;
                $saleitemdata['unit_id'] = $singlesalepro['unit_id'];
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['pro_id'] = $singlesalepro['pro_id'];
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                $saleitemdata['discount'] = $singlesalepro['discount'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $saleitemdata['remark'] = $singlesalepro['remark'];
                $saleitemdata['is_temp'] = $singlesalepro['is_temp'];
                $this->db->insert('tblpurchaseorderproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();


            }

            //deleting last records
           $this->db->where('po_id', $id);
           $this->db->delete('tblpurchaseorderapproval');


           //deleting last records
            $this->db->where('table_id', $id);
            $this->db->where('module_id', 3);
            $this->db->delete('tblmasterapproval');

            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['po_id'] = $id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseorderapproval', $sdata);


                    //deleting last records
                   $this->db->where('table_id', $id);
                   $this->db->where('module_id', 6);
                   $this->db->delete('tblnotifications');


                    /*$full_name = get_employee_fullname(get_staff_user_id());

                    $notified = add_notification([
                        'description' => 'Purchase Order Send to you for Approval',
                        'touserid' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'from_fullname' => $full_name,
                        'table_id' => $id,
                        'module_id' => 6,
                        'link' => 'purchase/purchaseorder_details/' . $id,

                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$staffid]);
                    }*/


                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid'      => get_staff_user_id(),
                        'module_id' => 3,
                        'description' => 'Purchase Order Send to you for Approval',
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/purchaseorder_details/' . $id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                  //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Purchase Order ('.$data['number'].') Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }


            return $id;
        }

        return false;
    }



    public function add_mr($data) {

        $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : '';
        $staff_id = array();
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $po_info=$this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$data['po_number']."'")->row_array();

        if(!empty($data['extrusion'])){
            $extrusion = 1;
        }else{
            $extrusion = 0;
        }
        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }

        $quality_person = (!empty($data["quality_person"])) ? $data["quality_person"] : '';
        $stock_person = (!empty($data["stock_person"])) ? $data["stock_person"] : '';
        $purchase_person = (!empty($data["purchase_person"])) ? $data["purchase_person"] : '';
        $mr_time = (!empty($data["time"])) ? date("H:i:s", strtotime($data["time"])) : "";
        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'billing_branch_id' => get_login_branch(),
                'po_id' => $data['po_number'],
                'vendor_id' => $data['vendor_id'],
                'warehouse_id' => $po_info['warehouse_id'],
                'service_type' => $po_info['service_type'],
                'date' => $date,
                'mr_time' => $mr_time,
                'reference_no' => $data['reference_no'],
                'numer' => $data['number'],
                'mr_number' => $mr_number,
                'year_id' => financial_year(),
                'assignid' => $staff_str,
                'extrusion' => $extrusion,
                'adminnote' => $data['adminnote'],
                'challan_no' => $data['challan_no'],
                'mr_for' => 1,
                'type_of_billing' => $data['type_of_billing'],
                'created_date' => date('Y-m-d H:i:s'),
          );
        $this->db->insert('tblmaterialreceipt', $ad_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            foreach ($data['mr_products'] as $val) {

                // $quantity = $_POST['product_'.$p_id];
                // $reject_qty = $_POST['reject_'.$p_id];
                // $remark = $_POST['remark_'.$p_id];
                // $nosqty = $_POST['nosqty_'.$p_id];
                // $unit_id = $_POST['unit_id_'.$p_id];

                $itemdata['po_id'] = $data['po_number'];
                $itemdata['mr_id'] = $insert_id;
                $itemdata['product_id'] = $val["product_id"];
                $itemdata['qty'] = $val["received_qty"];
                $itemdata['qty_in_nos'] = $val["nosqty"];
                $itemdata['reject_qty'] = $val["reject_qty"];
                $itemdata['remark'] = $val["remark"];
                $itemdata['unit_id'] = $val["unit_id"];
                $this->db->insert('tblmaterialreceiptproduct', $itemdata);
                $itemid = $this->db->insert_id();
            }

            /* Start Quality Person Approval */
            if ($quality_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 1, $quality_person, $message);
            }
            /* End Quality Person Approval */

            /* Start Stock Person Approval */
            if ($stock_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 2, $stock_person, $message);
            }
            /* End Stock Person Approval */

            /* Start Purchase Person Approval */
            if ($purchase_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 3, $purchase_person, $message);
            }
            /* End Purchase Person Approval */

            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = $data['po_number'];
                $sdata['mr_id'] = $insert_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);

                /*$full_name = get_employee_fullname(get_staff_user_id());

                $notified = add_notification([
                    'description' => 'Material receipt send to you for Approval',
                    'touserid' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'from_fullname' => $full_name,
                    'table_id' => $insert_id,
                    'module_id' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,

                ]);
                if ($notified) {
                    pusher_trigger_notification([$staffid]);
                }*/

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }
            return $insert_id;
        }
        return false;
    }

    public function add_mr_cash($data) {

       $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : array();
       $compdata=$data['saleproposal'];
       $staff_id = array();
       foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        if(!empty($data['extrusion'])){
            $extrusion = 1;
        }else{
            $extrusion = 0;
        }

        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }
        $quality_person = (!empty($data["quality_person"])) ? $data["quality_person"] : '';
        $stock_person = (!empty($data["stock_person"])) ? $data["stock_person"] : '';
        $purchase_person = (!empty($data["purchase_person"])) ? $data["purchase_person"] : '';
       $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'po_id' => 0,
                        'vendor_id' => $data['vendor_id'],
                        'warehouse_id' => $data['warehouse_id'],
                        'billing_branch_id' => get_login_branch(),
                        'service_type' => $data['service_type'],
                        'date' => $date,
                        'reference_no' => $data['reference_no'],
                        'numer' => $data['number'],
                        'mr_number' => $mr_number,
                        'year_id' => financial_year(),
                        'assignid' => $staff_str,
                        'extrusion' => $extrusion,
                        'adminnote' => $data['adminnote'],
                        'challan_no' => $data['challan_no'],
                        'tax_type' => $data['tax_type'],
                        'type_of_billing' => $data['type_of_billing'],
                        'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
                        'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
                        'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
                        'totalamount' => $data['saleproposal']['totalamount'],
                        'mr_for' => 2,
                        'created_date' => date('Y-m-d H:i:s'),
                  );


        $this->db->insert('tblmaterialreceipt', $ad_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            if(!empty($data['saleproposal'])){
                foreach($data['saleproposal'] as $singlecompdata)
                {
                    $wpdata['mr_id']=$insert_id;
                    $wpdata['po_id']=0;
                    $wpdata['product_id']=$singlecompdata['product_id'];
                    $wpdata['remark']=$singlecompdata['remark'];
                    $wpdata['qty']=$singlecompdata['qty'];
                    $wpdata['price']=$singlecompdata['price'];
                    $wpdata['ttl_price']=$singlecompdata['ttl_price'];
                    $wpdata['prodtax']=$singlecompdata['prodtax'];
                    $wpdata['tax_amt']=$singlecompdata['tax_amt'];
                    $this->db->insert('tblmaterialreceiptproduct', $wpdata);
                }
            }

            /* Start Quality Person Approval */
            if ($quality_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 1, $quality_person, $message);
            }
            /* End Quality Person Approval */

            /* Start Stock Person Approval */
            if ($stock_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 2, $stock_person, $message);
            }
            /* End Stock Person Approval */

            /* Start Purchase Person Approval */
            if ($purchase_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 3, $purchase_person, $message);
            }
            /* End Purchase Person Approval */


            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = 0;
                $sdata['mr_id'] = $insert_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);



                /*$full_name = get_employee_fullname(get_staff_user_id());

                $notified = add_notification([
                    'description' => 'Material receipt send to you for Approval',
                    'touserid' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'from_fullname' => $full_name,
                    'table_id' => $insert_id,
                    'module_id' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,

                ]);
                if ($notified) {
                    pusher_trigger_notification([$staffid]);
                }*/

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }
            return $insert_id;
        }
        return false;
    }


    public function add_mr_gas($data) {

        $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : array();
        $compdata=$data['saleproposal'];
        $staff_id = array();
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));
        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }

        $quality_person = (!empty($data["quality_person"])) ? $data["quality_person"] : '';
        $stock_person = (!empty($data["stock_person"])) ? $data["stock_person"] : '';
        $purchase_person = (!empty($data["purchase_person"])) ? $data["purchase_person"] : '';
       $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'billing_branch_id' => get_login_branch(),
                        'po_id' => 0,
                        'vendor_id' => $data['vendor_id'],
                        /*'warehouse_id' => $data['warehouse_id'],
                        'service_type' => $data['service_type'],*/
                        'date' => $date,
                        'reference_no' => $data['reference_no'],
                        'numer' => $data['number'],
                        'mr_number' => $mr_number,
                        'year_id' => financial_year(),
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
                        'challan_no' => $data['challan_no'],
                        'mr_for' => 3,
                        'type_of_billing' => $data['type_of_billing'],
                        'created_date' => date('Y-m-d H:i:s'),
                  );




        $this->db->insert('tblmaterialreceipt', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

           $productdata = $data['productdata'];
           foreach ($productdata as $productdata_value)
            {
               $wpdata['mr_id']=$insert_id;
               $wpdata['po_id']=0;
               $wpdata['product_id']=$productdata_value['product_id'];
               $wpdata['remark']=$productdata_value['remark'];
               $wpdata['qty']=$productdata_value['receive_qty'];
               $wpdata['deliver_qty']=$productdata_value['deliver_qty'];
               $this->db->insert('tblmaterialreceiptproduct', $wpdata);

            }

            /* Start Quality Person Approval */
            if ($quality_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 1, $quality_person, $message);
            }
            /* End Quality Person Approval */

            /* Start Stock Person Approval */
            if ($stock_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 2, $stock_person, $message);
            }
            /* End Stock Person Approval */

            /* Start Purchase Person Approval */
            if ($purchase_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($insert_id, 3, $purchase_person, $message);
            }
            /* End Purchase Person Approval */


            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = 0;
                $sdata['mr_id'] = $insert_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);



                /*$full_name = get_employee_fullname(get_staff_user_id());

                $notified = add_notification([
                    'description' => 'Material receipt send to you for Approval',
                    'touserid' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'from_fullname' => $full_name,
                    'table_id' => $insert_id,
                    'module_id' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,

                ]);
                if ($notified) {
                    pusher_trigger_notification([$staffid]);
                }*/

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);

            }
            return $insert_id;
        }
        return false;
    }




    public function add_paymentinvoice($data) {
        $othercharges = $data['othercharges'];
        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        if(empty($data['po_id'])){
            $data['po_id'] = 0;
        }

        foreach ($data['mr_id'] as $mr) {
            $this->db->where('id', $mr);
            $this->db->update('tblmaterialreceipt', array('invoice_status'=>1));
        }
        update_po_invoice_status($data['po_id']);

        $mr_ids = implode(',', $data['mr_id']);
        $roundoff_amount = (!empty($data['roundoff_amount'])) ? $data['roundoff_amount'] : 0;
        $roundoff_remark = (!empty($data['roundoff_remark'])) ? $data['roundoff_remark'] : '';
        $ad_data = array(
            'staff_id' => get_staff_user_id(),
            'year_id' => financial_year(),
            'vendor_id' => $data['vendor_id'],
            'billing_branch_id' => get_login_branch(),
            'invoice_for' => $data['invoice_for'],
            'type' => $data['type'],
            'reference_number' => $data['reference_number'],
            'po_id' => $data['po_id'],
            'mr_id' => $mr_ids,
            'date' => $date,
            'other_charges_tax' => $data['other_charges_tax'],
            'note' => $data['note'],
            'tax_type' => $data['tax_type'],
            'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
            'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
            'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
            'totalamount' => $data['saleproposal']['totalamount'],
            'roundoff_remark' => $roundoff_remark,
            'roundoff_amount' => $roundoff_amount,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $this->db->insert('tblpurchaseinvoice', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            foreach ($data['saleproposal'] as $singlesalepro) {

                $other = 0;
                if(!empty($singlesalepro['other'])){
                    $other = 1;
                }

                $saleitemdata['invoice_id'] = $insert_id;
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $this->db->insert('tblpurchaseinvoiceproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();
            }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {
                    if (!isset($odata['igst'])) {
                        $totaltax = $odata['gst'] + $odata['sgst'];
                        $odata['isgst'] = 1;
                    } else {
                        $totaltax = $odata['igst'];
                        $odata['isgst'] = 0;
                    }
                    $odata['proposalid'] = $insert_id;
                    $odata['is_sale'] = 0;
                    $odata['created_at'] = date("Y-m-d H:i:s");
                    $odata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseinvoiceothercharges', $odata);
                }
            }
            return $insert_id;
        }
        return false;
    }

    public function update_paymentinvoice($data,$id) {
        $othercharges = $data['othercharges'];
        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        update_purchase_invoice_status_when_delete_edit($id);

        foreach ($data['mr_id'] as $mr) {
            $this->db->where('id', $mr);
            $this->db->update('tblmaterialreceipt', array('invoice_status'=>1));
        }
        update_po_invoice_status($data['po_id']);

        $mr_ids = implode(',', $data['mr_id']);
        $roundoff_amount = (!empty($data['roundoff_amount'])) ? $data['roundoff_amount'] : 0;
        $roundoff_remark = (!empty($data['roundoff_remark'])) ? $data['roundoff_remark'] : '';
        $ad_data = array(
            'staff_id' => get_staff_user_id(),
            'year_id' => financial_year(),
            'vendor_id' => $data['vendor_id'],
            'invoice_for' => $data['invoice_for'],
            'type' => $data['type'],
            'reference_number' => $data['reference_number'],
            'po_id' => $data['po_id'],
            'mr_id' => $mr_ids,
            'date' => $date,
            'other_charges_tax' => $data['other_charges_tax'],
            'note' => $data['note'],
            'tax_type' => $data['tax_type'],
            'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
            'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
            'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
            'totalamount' => $data['saleproposal']['totalamount'],
            'roundoff_remark' => $roundoff_remark,
            'roundoff_amount' => $roundoff_amount,
            'status' => 1,
            'created_at' => date('Y-m-d H:i:s'),
        );

        $this->db->where('id', $id);
        $this->db->update('tblpurchaseinvoice', $ad_data);

        if ($id) {

           //deleting last records
           $this->db->where('invoice_id', $id);
           $this->db->delete('tblpurchaseinvoiceproduct');

           $this->db->where('proposalid', $id);
           $this->db->delete('tblpurchaseinvoiceothercharges');

            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            foreach ($data['saleproposal'] as $singlesalepro) {

                $saleitemdata['invoice_id'] = $id;
                $saleitemdata['product_id'] = $singlesalepro['product_id'];
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['ttl_price'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $this->db->insert('tblpurchaseinvoiceproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();
            }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {
                    if (!isset($odata['igst'])) {
                        $totaltax = $odata['gst'] + $odata['sgst'];
                        $odata['isgst'] = 1;
                    } else {
                        $totaltax = $odata['igst'];
                        $odata['isgst'] = 0;
                    }
                    $odata['proposalid'] = $id;
                    $odata['is_sale'] = 0;
                    $odata['created_at'] = date("Y-m-d H:i:s");
                    $odata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseinvoiceothercharges', $odata);
                }
            }
            return $id;
        }
        return false;
    }


    public function add_po_payment($data) {

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
       $tdspercentage = (!empty($data['tdspercentage'])) ? $data['tdspercentage'] : "";
       $tdsamount = (!empty($data['tdsamount'])) ? $data['tdsamount'] : "";
       $tdsremark = (!empty($data['tdsremark'])) ? $data['tdsremark'] : "";
       $tcspercentage = (!empty($data['tcspercentage'])) ? $data['tcspercentage'] : "";
       $tcsamount = (!empty($data['tcsamount'])) ? $data['tcsamount'] : "";
       $tcsremark = (!empty($data['tcsremark'])) ? $data['tcsremark'] : "";
       $percentage = (!empty($data['percentage'])) ? $data['percentage'] : "0.00";

       $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'assignid' => $staff_str,
                'po_id' => $data['po_id'],
                'amount' => $data['amount'],
                'approved_amount' => $data['amount'], //by safiya
                'percentage' => $percentage,
                'payment_type' => $data['payment_type'],
                'payment_by' => $data['payment_by'],
                'remark' => $data['remark'],
                'tdspercentage' => $tdspercentage,
                'tdsamount' => $tdsamount,
                'tdsremark' => $tdsremark,
                'tcspercentage' => $tcspercentage,
                'tcsamount' => $tcsamount,
                'tcsremark' => $tcsremark,
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
          );
          /* this is for payment by adjustment */
          if ($data['payment_by'] == "4"){
              // $ad_data["adjusment_details"] =
              $adjustment_details = array();
              if (isset($data["adjustment_data"])){
                  foreach ($data["adjustment_data"] as $key => $value) {
                      if ($value["amount"] > 0){
                          $adjustment_details[] = array("refund_payemnt_id"=> $value["refund_id"], "amount" => $value["amount"]);
                          $chk_refund_payment = $this->db->query("SELECT `balance_amount` FROM `tblpurchaseorderrefundpayment` WHERE `id` ='".$value["refund_id"]."' ")->row();
                          if (!empty($chk_refund_payment)){
                            $updata["balance_amount"] = $chk_refund_payment->balance_amount-$value["amount"];
                            $this->home_model->update("tblpurchaseorderrefundpayment", $updata, array("id" => $value["refund_id"]));
                          }
                      }
                  }
              }
              $ad_data["adjusment_details"] = (!empty($adjustment_details)) ? json_encode($adjustment_details) : "NULL";
          }

        $this->db->insert('tblpurchaseorderpayments', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['pay_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseorderpaymentapproval', $sdata);


                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 9,
                        'description' => 'Purchase Order Payment Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/purchaseorder_payment_details/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Purchase Order Payment Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }


            return $insert_id;
        }

        return false;
    }

    public function get_invoice($where,$start_from,$limit)
    {

         return $this->db->query("SELECT * from `tblpurchaseinvoice` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
    }

    public function get_invoice_count($where)
    {

         return $this->db->query("SELECT count(id) as `ttl_count` from `tblpurchaseinvoice` where ".$where."  ")->row()->ttl_count;
    }


    public function get_paymentinvoice($where,$start_from,$limit)
    {

         return $this->db->query("SELECT * from `tblvendorpayment` where ".$where." ORDER BY id desc LIMIT ".$start_from.",".$limit." ")->result();
    }

    public function get_paymentinvoice_count($where)
    {

         return $this->db->query("SELECT count(id) as `ttl_count` from `tblvendorpayment` where ".$where."  ")->row()->ttl_count;
    }

    /* this function use for edit mr */
    public function edit_mr($mr_id, $data) {
        
        // echo "<pre>";
        // print_r($data);
        // exit;
        // $assignstaff = $data['assignid'];
        $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : array();
        $staff_id = array();
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));


        $po_info=$this->db->query("SELECT * FROM `tblpurchaseorder` WHERE `id`='".$data['po_number']."'")->row_array();

        $extrusion = (!empty($data['extrusion'])) ? 1 : 0;

        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }
        
        $mr_time = (!empty($data["time"])) ? date("H:i:s", strtotime($data["time"])) : "";
        $quality_person = (!empty($data["quality_person"])) ? $data["quality_person"] : '';
        $stock_person = (!empty($data["stock_person"])) ? $data["stock_person"] : '';
        $purchase_person = (!empty($data["purchase_person"])) ? $data["purchase_person"] : '';
        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'billing_branch_id' => get_login_branch(),
                'po_id' => $data['po_number'],
                'vendor_id' => $data['vendor_id'],
                'warehouse_id' => $po_info['warehouse_id'],
                'service_type' => $po_info['service_type'],
                'date' => $date,
                'mr_time' => $mr_time,
                'reference_no' => $data['reference_no'],
                'numer' => $data['number'],
                'mr_number' => $mr_number,
                'assignid' => $staff_str,
                'extrusion' => $extrusion,
                'adminnote' => $data['adminnote'],
                'challan_no' => $data['challan_no'],
                'mr_for' => 1,
                'type_of_billing' => $data['type_of_billing'],
                'status' => 0
          );

        $this->db->where('id', $mr_id);
        $update = $this->db->update('tblmaterialreceipt', $ad_data);
        if ($update) {

             //deleting last records
            $this->db->where('mr_id', $mr_id);
            $this->db->delete('tblmaterialreceiptproduct');

            $this->db->where('mr_id', $mr_id);
            $this->db->delete('tblmaterialreceiptapproval');

            $this->db->where('table_id', $mr_id);
            $this->db->where('module_id', 4);
            $this->db->delete('tblmasterapproval');

            // foreach ($data['product'] as $p_id) {

            //     $quantity = $_POST['product_'.$p_id];
            //     $reject_qty = $_POST['reject_'.$p_id];
            //     $remark = $_POST['remark_'.$p_id];
            //     $nosqty = $_POST['nosqty_'.$p_id];
            //     $unit_id = $_POST['unit_id_'.$p_id];

            //     $itemdata['po_id'] = $data['po_number'];
            //     $itemdata['mr_id'] = $mr_id;
            //     $itemdata['product_id'] = $p_id;
            //     $itemdata['qty_in_nos'] = $nosqty;
            //     $itemdata['qty'] = $quantity;
            //     $itemdata['reject_qty'] = $reject_qty;
            //     $itemdata['remark'] = $remark;
            //     $itemdata['unit_id'] = $unit_id;
            //     $this->db->insert('tblmaterialreceiptproduct', $itemdata);
            //     $itemid = $this->db->insert_id();
            // }

            foreach ($data['mr_products'] as $val) {

                // $quantity = $_POST['product_'.$p_id];
                // $reject_qty = $_POST['reject_'.$p_id];
                // $remark = $_POST['remark_'.$p_id];
                // $nosqty = $_POST['nosqty_'.$p_id];
                // $unit_id = $_POST['unit_id_'.$p_id];

                $itemdata['po_id'] = $data['po_number'];
                $itemdata['mr_id'] = $mr_id;
                $itemdata['product_id'] = $val["product_id"];
                $itemdata['qty'] = $val["received_qty"];
                $itemdata['qty_in_nos'] = $val["nosqty"];
                $itemdata['reject_qty'] = $val["reject_qty"];
                $itemdata['remark'] = $val["remark"];
                $itemdata['unit_id'] = $val["unit_id"];
                $this->db->insert('tblmaterialreceiptproduct', $itemdata);
                $itemid = $this->db->insert_id();
            }
            /* Start Quality Person Approval */
            if ($quality_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 1, $quality_person, $message);
            }
            /* End Quality Person Approval */

            /* Start Stock Person Approval */
            if ($stock_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 2, $stock_person, $message);
            }
            /* End Stock Person Approval */

            /* Start Purchase Person Approval */
            if ($purchase_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 3, $purchase_person, $message);
            }
            /* End Purchase Person Approval */

            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = $data['po_number'];
                $sdata['mr_id'] = $mr_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $mr_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $mr_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }

            return $mr_id;
        }

        return false;
    }

    /* this function use for mr_cash_edit */
    public function edit_mr_cash($mr_id, $data){

        $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : array();
        $compdata=$data['saleproposal'];
        $staff_id = array();
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $extrusion = (!empty($data['extrusion'])) ? 1 : 0;

        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }

        $quality_person = (!empty($data["quality_person"])) ? $data["quality_person"] : '';
        $stock_person = (!empty($data["stock_person"])) ? $data["stock_person"] : '';
        $purchase_person = (!empty($data["purchase_person"])) ? $data["purchase_person"] : '';
        $ad_data = array(
            'staff_id' => get_staff_user_id(),
            'po_id' => 0,
            'vendor_id' => $data['vendor_id'],
            'warehouse_id' => $data['warehouse_id'],
            'billing_branch_id' => get_login_branch(),
            'service_type' => $data['service_type'],
            'date' => $date,
            'reference_no' => $data['reference_no'],
            'numer' => $data['number'],
            'mr_number' => $mr_number,
            'assignid' => $staff_str,
            'extrusion' => $extrusion,
            'adminnote' => $data['adminnote'],
            'challan_no' => $data['challan_no'],
            'tax_type' => $data['tax_type'],
            'type_of_billing' => $data['type_of_billing'],
            'finalsubtotalamount' => $data['saleproposal']['finalsubtotalamount'],
            'finaldiscountpercentage' => $data['saleproposal']['finaldiscountpercentage'],
            'finaldiscountamount' => $data['saleproposal']['finaldiscountamount'],
            'totalamount' => $data['saleproposal']['totalamount'],
            'mr_for' => 2,
            'status' => 0,
        );

        $this->db->where('id', $mr_id);
        $update = $this->db->update('tblmaterialreceipt', $ad_data);
        if ($update) {

            //deleting last records
            $this->db->where('mr_id', $mr_id);
            $this->db->delete('tblmaterialreceiptproduct');

            $this->db->where('mr_id', $mr_id);
            $this->db->delete('tblmaterialreceiptapproval');

            $this->db->where('table_id', $mr_id);
            $this->db->where('module_id', 4);
            $this->db->delete('tblmasterapproval');

            unset($data['saleproposal']['finalsubtotalamount']);
            unset($data['saleproposal']['finaldiscountpercentage']);
            unset($data['saleproposal']['finaldiscountamount']);
            unset($data['saleproposal']['totalamount']);
            if(!empty($data['saleproposal'])){
                foreach($data['saleproposal'] as $singlecompdata)
                {
                    $wpdata['mr_id']=$mr_id;
                    $wpdata['po_id']=0;
                    $wpdata['product_id']=$singlecompdata['product_id'];
                    $wpdata['remark']=$singlecompdata['remark'];
                    $wpdata['qty']=$singlecompdata['qty'];
                    $wpdata['price']=$singlecompdata['price'];
                    $wpdata['ttl_price']=$singlecompdata['ttl_price'];
                    $wpdata['prodtax']=$singlecompdata['prodtax'];
                    $wpdata['tax_amt']=$singlecompdata['tax_amt'];
                    $this->db->insert('tblmaterialreceiptproduct', $wpdata);
                }
            }
            
            /* Start Quality Person Approval */
            if ($quality_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 1, $quality_person, $message);
            }
            /* End Quality Person Approval */

            /* Start Stock Person Approval */
            if ($stock_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 2, $stock_person, $message);
            }
            /* End Stock Person Approval */

            /* Start Purchase Person Approval */
            if ($purchase_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 3, $purchase_person, $message);
            }
            /* End Purchase Person Approval */

            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = 0;
                $sdata['mr_id'] = $mr_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $mr_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $mr_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }
            return $mr_id;
        }
        return false;
    }

    public function edit_mr_gas($mr_id, $data){
        
        $assignstaff = (!empty($data['assignid'])) ? $data['assignid'] : array();
        $staff_id = array();
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);
        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));
        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }

        $quality_person = (!empty($data["quality_person"])) ? $data["quality_person"] : '';
        $stock_person = (!empty($data["stock_person"])) ? $data["stock_person"] : '';
        $purchase_person = (!empty($data["purchase_person"])) ? $data["purchase_person"] : '';
        $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'billing_branch_id' => get_login_branch(),
                        'po_id' => 0,
                        'vendor_id' => $data['vendor_id'],
                        /*'warehouse_id' => $data['warehouse_id'],
                        'service_type' => $data['service_type'],*/
                        'date' => $date,
                        'reference_no' => $data['reference_no'],
                        'numer' => $data['number'],
                        'mr_number' => $mr_number,
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
                        'challan_no' => $data['challan_no'],
                        'type_of_billing' => $data['type_of_billing'],
                        'mr_for' => 3,
                        'status' => 0
                  );

        $this->db->where('id', $mr_id);
        $update = $this->db->update('tblmaterialreceipt', $ad_data);
        if ($update) {

            //deleting last records
            $this->db->where('mr_id', $mr_id);
            $this->db->delete('tblmaterialreceiptproduct');

            $this->db->where('mr_id', $mr_id);
            $this->db->delete('tblmaterialreceiptapproval');

            $this->db->where('table_id', $mr_id);
            $this->db->where('module_id', 4);
            $this->db->delete('tblmasterapproval');

            $productdata = $data['productdata'];
            foreach ($productdata as $productdata_value)
            {
               $wpdata['mr_id']=$mr_id;
               $wpdata['po_id']=0;
               $wpdata['product_id']=$productdata_value['product_id'];
               $wpdata['remark']=$productdata_value['remark'];
               $wpdata['qty']=$productdata_value['receive_qty'];
               $wpdata['deliver_qty']=$productdata_value['deliver_qty'];
               $this->db->insert('tblmaterialreceiptproduct', $wpdata);

            }

            /* Start Quality Person Approval */
            if ($quality_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 1, $quality_person, $message);
            }
            /* End Quality Person Approval */

            /* Start Stock Person Approval */
            if ($stock_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 2, $stock_person, $message);
            }
            /* End Stock Person Approval */

            /* Start Purchase Person Approval */
            if ($purchase_person != ''){
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $this->send_mr_approval($mr_id, 3, $purchase_person, $message);
            }
            /* End Purchase Person Approval */
            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = 0;
                $sdata['mr_id'] = $mr_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $mr_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $mr_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);

            }
            return $mr_id;
        }
        return false;
    }

    public function add_po_debitnote_payment($data) {

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

        $debitnote_ids = array();
        if (!empty($data['debitnote_id'])){
            foreach ($data['debitnote_id'] as $dn_id) {

                $dnamount = $data["amount_$dn_id"];
                if ($dnamount != 0){
                    array_push($debitnote_ids, $dn_id);
                }
            }
        }

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'assignid' => $staff_str,
                'po_id' => $data['po_id'],
                'amount' => $data['amount'],
                'approved_amount' => $data['amount'], //by safiya
                'percentage' => $data['percentage'],
//                'payment_type' => $data['payment_type'],
                'debitnote_ids' => implode(",", $debitnote_ids),
                'payment_by' => 3,
                'remark' => $data['remark'],
                'status' => 0,
                'created_at' => date('Y-m-d H:i:s'),
          );

        $this->db->insert('tblpurchaseorderpayments', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

            if (!empty($data['debitnote_id'])){
                foreach ($data['debitnote_id'] as $dn_id) {

                    $dnamount = $data["amount_$dn_id"];
                    $dnclear = ($data["clear_$dn_id"] == 1) ? 1 : 0;
                    if ($dnamount != 0){

                        $debitnote_log = array(
                        "payment_id" => $insert_id,
                        "debitnote_id" => $dn_id,
                        "amount" => $dnamount,
                        "is_clear" => $dnclear,
                        "status" => 1
                        );
                        $this->db->insert('tblpurchasedebitnoteregistered', $debitnote_log);
                    }
                }
            }

            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['pay_id'] = $insert_id;
                    $sdata['approve_status'] = '0';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblpurchaseorderpaymentapproval', $sdata);


                    //adding on master log
                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 9,
                        'description' => 'Purchase Order Payment Send to you for Approval',
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'link' => 'purchase/purchaseorder_payment_details/' . $insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Purchase Order Payment Send to you for Approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }


            return $insert_id;
        }

        return false;
    }

    public function addDeliveryChallanReturn($data) {

        $assignstaff = $data['assignid'];
        $compdata=$data['saleproposal'];

        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $staff_str = implode(",",$staff_id);

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $mr_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }else{
            if(!empty($number_arr[0])){
                $mr_number = $number_arr[0];
            }
        }
        $ad_data = array(
                        'staff_id' => get_staff_user_id(),
                        'po_id' => 0,
                        'vendor_id' => $data['vendor_id'],
                        'warehouse_id' => $data['warehouse_id'],
                        'billing_branch_id' => get_login_branch(),
                        'service_type' => $data['service_type'],
                        'deliverychallan_id' => $data['challan_number'],
                        'date' => $date,
                        'reference_no' => $data['reference_no'],
                        'numer' => $data['number'],
                        'mr_number' => $mr_number,
                        'year_id' => financial_year(),
                        'assignid' => $staff_str,
                        'adminnote' => $data['adminnote'],
                        'challan_no' => $data['challan_no'],
                        'mr_for' => 4,
                        'created_date' => date('Y-m-d H:i:s'),
                );

        $this->db->insert('tblmaterialreceipt', $ad_data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {

            if(!empty($data['saleproposal'])){
                foreach($data['saleproposal'] as $singlecompdata)
                {
                    $wpdata['mr_id']=$insert_id;
                    $wpdata['po_id']=0;
                    $wpdata['deliverychallan_id'] = $data['challan_number'];
                    $wpdata['product_id']=$singlecompdata['product_id'];
                    $wpdata['remark']=$singlecompdata['remark'];
                    $wpdata['qty']=$singlecompdata['qty'];
                    $wpdata['unit_id']=$singlecompdata['unit_id'];

                    $this->db->insert('tblmaterialreceiptproduct', $wpdata);
                }
            }

            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['po_id'] = 0;
                $sdata['deliverychallan_id'] = $data['challan_number'];
                $sdata['mr_id'] = $insert_id;
                $sdata['approve_status'] = '0';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblmaterialreceiptapproval', $sdata);

                /*$full_name = get_employee_fullname(get_staff_user_id());

                $notified = add_notification([
                    'description' => 'Material receipt send to you for Approval',
                    'touserid' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'from_fullname' => $full_name,
                    'table_id' => $insert_id,
                    'module_id' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,

                ]);
                if ($notified) {
                    pusher_trigger_notification([$staffid]);
                }*/

                //adding on master log
                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 4,
                    'description' => 'Material receipt send to you for Approval',
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'purchase/mr_approval/' . $insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                $token = get_staff_token($staffid);
                $message = 'Material receipt ('.$data['number'].') send to you for Approval';
                $title = 'Schach';
                $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }
            return $insert_id;
        }
        return false;
    }

    public function addPORefundPayment($data){

        $assignstaff = $data['assignid'];
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
        }
        $staff_id = array_unique($staff_id);

        $assignpettycashstaff = $data['pettycashassignid'];
        
        $pettycashstaff_id = array();
        $pettycashgroup_id = array();
        foreach ($assignpettycashstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $pettycashstaff_id[] = str_replace("staff", "", $single_staff);
            }
            if (strpos($single_staff, 'staff') !== false) {
                $pettycashgroup_id[] = str_replace("group", "", $single_staff);
            }
        }
        $pettycashstaff_id = (!empty($pettycashstaff_id)) ? implode(",", array_unique($pettycashstaff_id)) : "";
        $pettycashgroup_id = (!empty($pettycashgroup_id)) ? implode(",", array_unique($pettycashgroup_id)) : "";
        
        $po_number = value_by_id_empty("tblpurchaseorder", $data['po_id'], "number");

        $date = str_replace("/","-",$data['date']);
        $paymentdate = date("Y-m-d",strtotime($date));
        $cheque_date = (!empty($data['cheque_date']) && !empty($data['cheque_no'])) ? db_date($data['cheque_date']) : "null";
        $chaque_for = (!empty($data['chaque_for'])) ? $data['chaque_for'] : "";
        $cheque_no = (!empty($data['cheque_no'])) ? $data['cheque_no'] : "";
        $refund_to = (!empty($data['refund_to'])) ? $data['refund_to'] : "0";
        
        $pettycash_id = (!empty($data['pettycash_id'])) ? $data['pettycash_id'] : "0";
        $balance_amount = ($data['type'] == 2) ? $data['amount'] : "0.00";
        $payment_mode  = (!empty($data['payment_mode'])) ? $data['payment_mode'] : "";
        $paymenttype  = (!empty($data['paymenttype'])) ? $data['paymenttype'] : "";
        $bank_id  = (!empty($data['bank_id'])) ? $data['bank_id'] : "";
        $reference_no  = (!empty($data['reference_no'])) ? $data['reference_no'] : "";
        if ($refund_to == 2){
           $payment_mode = $paymenttype = $bank_id = $chaque_for = 0; 
           $reference_no = $cheque_no = $cheque_date = "";
        }else if ($refund_to == 1){
            $pettycash_id = 0;
            $pettycashstaff_id = "";
        }
        $ad_data = array(
                        'po_id' => $data['po_id'],
                        'vendor_id' => $data['vendor_id'],
                        'billing_branch_id' => get_login_branch(),
                        'type' => $data['type'],
                        'refund_to' => $refund_to,
                        'pettycash_assigned_ids' => $pettycashstaff_id,
                        'pettycash_id' => $pettycash_id,
                        'payment_mode' => $payment_mode,
                        'payment_type_id' => $paymenttype,
                        'payment_date' => $paymentdate,
                        'reference_no' => $reference_no,
                        'bank_id' => $bank_id,
                        'chaque_for' => $chaque_for,
                        'cheque_no' => $cheque_no,
                        'cheque_date' => $cheque_date,
                        'remark' => $data['remark'],
                        'amount' => $data['amount'],
                        'balance_amount' => $balance_amount,
                        'added_by' => get_staff_user_id(),
                        'created_date' => date('Y-m-d H:i:s'),
                        'updated_date' => date('Y-m-d H:i:s'),
                );
         
        $this->db->insert('tblpurchaseorderrefundpayment', $ad_data);
        // echo$this->db->last_query();
        $insert_id = $this->db->insert_id();

        if ($insert_id) {
          foreach ($staff_id as $staffid) {
              $sdata['staffid'] = $staffid;
              $sdata['refund_id'] = $insert_id;
              $sdata['approve_status'] = '0';
              $sdata['created_at'] = date("Y-m-d H:i:s");
              $sdata['updated_at'] = date("Y-m-d H:i:s");
              $this->db->insert('tblpurchaserefundpaymentapproval', $sdata);

              //adding on master log
              $adata = array(
                  'staff_id' => $staffid,
                  'fromuserid'      => get_staff_user_id(),
                  'module_id' => 40,
                  'description' => 'Purchase order refund request send to you for Approval',
                  'table_id' => $insert_id,
                  'approve_status' => 0,
                  'status' => 0,
                  'link' => 'purchase/po_refund_request_approval/' . $insert_id,
                  'date' => date('Y-m-d'),
                  'date_time' => date('Y-m-d H:i:s'),
                  'updated_at' => date('Y-m-d H:i:s')
              );
              $this->db->insert('tblmasterapproval', $adata);

              //Sending Mobile Intimation
              $token = get_staff_token($staffid);
              $message = 'Purchase order ('.$po_number.') refund request send to you for Approval';
              $title = 'Schach';
              $send_intimation = sendFCM($message, $title, $token, $page = 2);
          }
          return $insert_id;
      }
      return false;
    }

    public function send_mr_approval($mr_id, $type, $staff_id, $message){
        $sdata['staff_id'] = $staff_id;
        $sdata['type'] = $type;
        $sdata['po_id'] = 0;
        $sdata['mr_id'] = $mr_id;
        $sdata['approve_status'] = '0';
        $sdata['created_at'] = date("Y-m-d H:i:s");
        $sdata['updated_at'] = date("Y-m-d H:i:s");
        $this->db->insert('tblmaterialreceiptapproval', $sdata);

        //adding on master log
        $adata = array(
            'staff_id' => $staff_id,
            'fromuserid'      => get_staff_user_id(),
            'module_id' => 4,
            'description' => 'Material receipt send to you for Approval',
            'table_id' => $mr_id,
            'approve_status' => 0,
            'status' => 0,
            'link' => 'purchase/mr_approval/' . $mr_id,
            'date' => date('Y-m-d'),
            'date_time' => date('Y-m-d H:i:s'),
            'updated_at' => date('Y-m-d H:i:s')
        );
        $this->db->insert('tblmasterapproval', $adata);

        //Sending Mobile Intimation
        $token = get_staff_token($staff_id);
        // $message = 'Material receipt ('.$data['number'].') send to you for Approval';
        $title = 'Schach';
        $send_intimation = sendFCM($message, $title, $token, $page = 2);
    }
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Creditnote_model extends CRM_Model {

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


       $othercharges = $data['othercharges'];
       $clientdata=$data['clientdata'];

        $staff_id = array();
        if(!empty($data['assignid'])){
            $assignstaff = $data['assignid'];

            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
                // if (strpos($single_staff, 'group') !== false) {
                //     $single_staff = str_replace("group", "", $single_staff);
                //     $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                //     foreach ($staffgroup as $singlestaff) {
                //         $staff_id[] = $singlestaff['staff_id'];
                //     }
                // }
            }
            unset($data['assignid']);
            $staff_id = array_unique($staff_id);
        }

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $cn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $cn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $cn_number = $number_arr[0];
            }
        }

        if(empty($data['invoice_id'])){
            $data['invoice_id'] = 0;
        }

        if(empty($data['invoice_numbers'])){
            $data['invoice_numbers'] = '';
        }


        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'clientid' => $data['clientid'],
                'invoice_numbers' => $data['invoice_numbers'],
                'invoice_id' => $data['invoice_id'],
                'date' => $date,
                'qty_hours' => $data['qty_hours'],
                'sac_hsn' => $data['sac_hsn'],
                'number' => $data['number'],
                'cn_number' => $cn_number,
                'year_id' => financial_year(),
                'other_charges_tax' => $data['other_charges_tax'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'note' => $data['note'],
                'tax_type' => $data['tax_type'],
                'status' => 0,
                'created_date' => date('Y-m-d'),
          );

        $this->db->insert('tblcreditnote', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

            foreach ($data['saleproposal'] as $singlesalepro) {


                $saleitemdata['creditnote_id'] = $insert_id;
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['days'] = $singlesalepro['days'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['price'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $this->db->insert('tblcreditnoteproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();


            }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {

                    if (!empty($odata["category_name"])){
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
                        $this->db->insert('tblcreditnoteothercharges', $odata);
                    }
                }
            }

            foreach($clientdata as $singleclient)
             {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$insert_id;
                $datace['contact_id']=$cont_id;
                $datace['type']='creditnote';
                $this->db->insert('tblinvoiceclientperson', $datace);
             }

            if (!empty($staff_id)){
                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['creditnote_id'] = $insert_id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblcreditnoteapproval', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 36,
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Credit Note Send to you for approval',
                        'link' => 'creditnotes/approval/'.$insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Credit Note Send to you for approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }


            return $insert_id;
        }

        return false;
    }


public function update($data,$id) {

        $staff_id = array();
        if(!empty($data['assignid'])){
            $assignstaff = $data['assignid'];

            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $staff_id[] = str_replace("staff", "", $single_staff);
                }
                // if (strpos($single_staff, 'group') !== false) {
                //     $single_staff = str_replace("group", "", $single_staff);
                //     $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                //     foreach ($staffgroup as $singlestaff) {
                //         $staff_id[] = $singlestaff['staff_id'];
                //     }
                // }
            }
            unset($data['assignid']);
            $staff_id = array_unique($staff_id);
        }

         $othercharges = $data['othercharges'];
         $clientdata=$data['clientdata'];
         $client_data=$data['client_data'];

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $cn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $cn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $cn_number = $number_arr[0];
            }
        }
        if(empty($data['invoice_id'])){
            $data['invoice_id'] = 0;
        }

         $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'clientid' => $data['clientid'],
                'invoice_numbers' => $data['invoice_numbers'],
                'invoice_id' => $data['invoice_id'],
                'date' => $date,
                'qty_hours' => $data['qty_hours'],
                'sac_hsn' => $data['sac_hsn'],
                'number' => $data['number'],
                'cn_number' => $cn_number,
                'year_id' => financial_year(),
                'other_charges_tax' => $data['other_charges_tax'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'note' => $data['note'],
                'status' => 0,
                'tax_type' => $data['tax_type']
          );

        $this->db->where('id', $id);
        $this->db->update('tblcreditnote', $ad_data);

        if ($id) {

           //deleting last records
           $this->db->where('creditnote_id', $id);
           $this->db->delete('tblcreditnoteproduct');

           $this->db->where('proposalid', $id);
           $this->db->delete('tblcreditnoteothercharges');

            $this->db->where('type','creditnote');
            $this->db->where('invoice_id',$id);
            $this->db->delete('tblinvoiceclientperson');

            foreach($client_data as $single_client_data)
            {
                $this->db->where('id',$single_client_data['clientid']);
                $this->db->delete('tblcontacts');
            }

            foreach ($data['saleproposal'] as $singlesalepro) {

                $saleitemdata['creditnote_id'] = $id;
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['days'] = $singlesalepro['days'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['price'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $this->db->insert('tblcreditnoteproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();

            }

            foreach($clientdata as $singleclient)
             {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$id;
                $datace['contact_id']=$cont_id;
                $datace['type']='creditnote';
                $this->db->insert('tblinvoiceclientperson', $datace);
             }

            if(!empty($othercharges)){
               foreach ($othercharges as $odata) {

                   if (!empty($odata["category_name"])){
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
                        $this->db->insert('tblcreditnoteothercharges', $odata);
                   }
                }
            }


            if (!empty($staff_id)){

                //deleting last records
                $this->db->where('creditnote_id', $id);
                $this->db->delete('tblcreditnoteapproval');

                $this->db->where('table_id', $id);
                $this->db->where('module_id', 36);
                $this->db->delete('tblmasterapproval');

                foreach ($staff_id as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['creditnote_id'] = $id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblcreditnoteapproval', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 36,
                        'table_id' => $id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Credit Note Send to you for approval',
                        'link' => 'creditnotes/approval/'.$id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Credit Note Send to you for approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            return $id;
        }

        return false;
    }

    // Purchase Credit Note
    public function addPurchaseCreditNote($data) {

       $othercharges = $data['othercharges'];
       //$clientdata=$data['clientdata'];

        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $cn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $cn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $cn_number = $number_arr[0];
            }
        }

        if(empty($data['invoice_id'])){
            $data['invoice_id'] = 0;
        }

        if(empty($data['invoice_numbers'])){
            $data['invoice_numbers'] = '';
        }

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'vendor_id' => $data['vendor_id'],
                'invoice_numbers' => $data['invoice_numbers'],
                'invoice_id' => $data['invoice_id'],
                'date' => $date,
                'qty_hours' => $data['qty_hours'],
                'sac_hsn' => $data['sac_hsn'],
                'number' => $data['number'],
                'cn_number' => $cn_number,
                'year_id' => financial_year(),
                'other_charges_tax' => $data['other_charges_tax'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'note' => $data['note'],
                'tax_type' => $data['tax_type'],
                'status' => 1,
                'created_date' => date('Y-m-d'),
          );

        $this->db->insert('tblpurchasecreditnote', $ad_data);
        $insert_id = $this->db->insert_id();

        if ($insert_id) {

            foreach ($data['saleproposal'] as $singlesalepro) {
                $saleitemdata['creditnote_id'] = $insert_id;
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['days'] = $singlesalepro['days'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['price'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $this->db->insert('tblpurchasecreditnoteproduct', $saleitemdata);
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
                    $this->db->insert('tblpurchasecreditnoteothercharges', $odata);
                }
            }

            /*foreach($clientdata as $singleclient)
             {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$insert_id;
                $datace['contact_id']=$cont_id;
                $datace['type']='purchase_creditnote';
                $this->db->insert('tblinvoiceclientperson', $datace);
             }*/
            return $insert_id;
        }
        return false;
    }
    public function updatePurchaseCreditNote($data,$id) {
      
        $othercharges = $data['othercharges'];
       //$clientdata=$data['clientdata'];
       $client_data=$data['client_data'];


        $date = str_replace("/","-",$data['date']);
        $date = date("Y-m-d",strtotime($date));

        $cn_number = '0';
        $number_arr = explode("/",$data['number']);
        if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
            if(!empty($number_arr[2])){
                $cn_number = $number_arr[2];
            }
        }else{
            if(!empty($number_arr[0])){
                $cn_number = $number_arr[0];
            }
        }
        if(empty($data['invoice_id'])){
            $data['invoice_id'] = 0;
        }

         $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'branch_id' => get_login_branch(),
                'vendor_id' => $data['vendor_id'],
                'invoice_numbers' => $data['invoice_numbers'],
                'invoice_id' => $data['invoice_id'],
                'date' => $date,
                'qty_hours' => $data['qty_hours'],
                'sac_hsn' => $data['sac_hsn'],
                'number' => $data['number'],
                'cn_number' => $cn_number,
                'year_id' => financial_year(),
                'other_charges_tax' => $data['other_charges_tax'],
                'terms_and_conditions' => $data['terms_and_conditions'],
                'note' => $data['note'],
                'status' => 1,
                'tax_type' => $data['tax_type']
          );



        $this->db->where('id', $id);
        $this->db->update('tblpurchasecreditnote', $ad_data);

        if ($id) {

           //deleting last records
           $this->db->where('creditnote_id', $id);
           $this->db->delete('tblpurchasecreditnoteproduct');

           $this->db->where('proposalid', $id);
           $this->db->delete('tblpurchasecreditnoteothercharges');




           /* $this->db->where('type','purchase_creditnote');
            $this->db->where('invoice_id',$id);
            $this->db->delete('tblinvoiceclientperson');

            foreach($client_data as $single_client_data)
            {
                $this->db->where('id',$single_client_data['clientid']);
                $this->db->delete('tblcontacts');
            } */


            foreach ($data['saleproposal'] as $singlesalepro) {

                $saleitemdata['creditnote_id'] = $id;
                $saleitemdata['product_name'] = $singlesalepro['product_name'];
                $saleitemdata['hsn_code'] = $singlesalepro['hsn_code'];
                $saleitemdata['qty'] = $singlesalepro['qty'];
                $saleitemdata['days'] = $singlesalepro['days'];
                $saleitemdata['price'] = $singlesalepro['price'];
                $saleitemdata['ttl_price'] = $singlesalepro['price'];
                $saleitemdata['prodtax'] = $singlesalepro['prodtax'];
                $saleitemdata['tax_amt'] = $singlesalepro['tax_amt'];
                $this->db->insert('tblpurchasecreditnoteproduct', $saleitemdata);
                $saleitemid = $this->db->insert_id();

            }

            /*foreach($clientdata as $singleclient)
             {
                $singleclient['userid']=$data['clientid'];;
                $this->db->insert('tblcontacts', $singleclient);
                $cont_id = $this->db->insert_id();
                $datace['invoice_id']=$id;
                $datace['contact_id']=$cont_id;
                $datace['type']='purchase_creditnote';
                $this->db->insert('tblinvoiceclientperson', $datace);
             }*/

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
                    $this->db->insert('tblpurchasecreditnoteothercharges', $odata);
                }
            }

            return $id;
        }

        return false;
    }


}

<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Clientdeposits_model extends CRM_Model
{
    public function __construct()
    {
        parent::__construct();
    }

    /* this function use for add client deposits */
    public function add($data) {

        $assignstaff=$data["assign"]['assignid'];
        $staff_id = array();
        foreach($assignstaff as $s_id)
        {
           if($s_id > 0){
            $staff_id[]=$s_id;
           }
        }
        $staff_id=array_unique($staff_id);

        $bank_id = (empty($data["bank_id"])) ? 0 : $data["bank_id"];
        $chaque_for = (empty($data["chaque_for"])) ? 0 : $data["chaque_for"];
        $service_type = (empty($data["service_type"])) ? 0 : $data["service_type"];
        $date = db_date($data["date"]);
        $cheque_date = db_date($data["cheque_date"]);
        $on_account = (isset($data["on_account"]) && $data["on_account"] == 'on') ? 1 : 0;

        $ad_data = array(
                'staff_id' => get_staff_user_id(),
                'client_id' => $data["client_id"],
                'payment_mode' => $data["payment_mode"],
                'chaque_for' => $chaque_for,
                'cheque_no' => $data["cheque_no"],
                'cheque_date' => $cheque_date,
                'service_type' => $service_type,
                'ttl_amt' => $data["ttl_amt"],
                'reference_no' => $data["reference_no"],
                'remark' => $data["remark"],
                'date' => $date,
                'bank_id' => $bank_id,
                'status' => 0,
                'on_account' => $on_account,
                'created_date' => date('Y-m-d H:i:s')
            );


        $insert = $this->home_model->insert('tblclientdeposits', $ad_data);
        if ($insert){
            $deposit_id = $this->db->insert_id();
            if(!empty($staff_id)){
                foreach ($staff_id as $staffid) {

                    $ad_field = array(
                        'staff_id' => $staffid,
                        'clientdeposits_id' => $deposit_id,
                        'status' => 1,
                        'approve_status' => 0,
                        'created_at' => date('Y-m-d H:i:s')
                    );
                    $this->home_model->insert('tblclientdepositsapproval',$ad_field);

                    $message = 'Client Deposit send you for aaproval';

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 19,
                        'table_id' => $deposit_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => $message,
                        'link' => 'client/clientdeposit_approval/'.$deposit_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->home_model->insert('tblmasterapproval',$adata);

                    //Sending Mobile Intimation
                        $token = get_staff_token($staffid);
                        $title = 'Schach';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }

            handle_multi_payment_attachments($deposit_id,'client_deposit');

            return $deposit_id;
        }
        return FALSE;
    }

    /* this function use for update client deposits */
    public function update($data, $id) {

        $assignstaff=$data["assign"]['assignid'];
        $staff_id = array();
        foreach($assignstaff as $s_id)
        {
           if($s_id > 0){
            $staff_id[]=$s_id;
           }
        }
        $staff_id=array_unique($staff_id);

        if (isset($data["bank_id"])){
            $update_data["bank_id"] = $data["bank_id"];
        }
        if (isset($data["chaque_for"])){
            $update_data["chaque_for"] = $data["chaque_for"];
        }
        if (isset($data["service_type"])){
            $update_data["service_type"] = $data["service_type"];
        }
        $on_account = (isset($data["on_account"]) && $data["on_account"] == 'on') ? 1 : 0;

        $update_data["date"] = db_date($data["date"]);
        $update_data["cheque_date"] = db_date($data["cheque_date"]);
        $update_data["staff_id"] = get_staff_user_id;
        $update_data["client_id"] = $data["client_id"];
        $update_data["payment_mode"] = $data["payment_mode"];
        $update_data["cheque_no"] = $data["cheque_no"];
        $update_data["ttl_amt"] = $data["ttl_amt"];
        $update_data["reference_no"] = $data["reference_no"];
        $update_data["status"] = 0;
        $update_data['on_account'] = $on_account;
        $update_data["remark"] = $data["remark"];

        $update = $this->home_model->update('tblclientdeposits', $update_data, array('id'=>$id));
        if ($update == true){
            $deposit_id = $id;

            if (!empty($_FILES['file'])){
                $check1 = $this->db->query("SELECT * FROM `tblfiles` where rel_id = '".$id."' and rel_type = 'client_deposit' ");
                if($check1)
                {
                  $this->db->delete('tblfiles',array('rel_id'=>$id,'rel_type' => 'client_deposit'));
                }

                /* this function use for delete last approval record */
                $this->db->delete('tblclientdepositsapproval',array('clientdeposits_id'=>$deposit_id));
                $this->db->delete('tblmasterapproval',array('table_id'=>$deposit_id,'module_id' => 19));

                if(!empty($staff_id)){
                    foreach ($staff_id as $staffid) {

                        $ad_field = array(
                            'staff_id' => $staffid,
                            'clientdeposits_id' => $deposit_id,
                            'status' => 1,
                            'approve_status' => 0,
                            'created_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblclientdepositsapproval',$ad_field);

                        $message = 'Client Deposit send you for aaproval';

                        $adata = array(
                            'staff_id' => $staffid,
                            'fromuserid' => get_staff_user_id(),
                            'module_id' => 19,
                            'table_id' => $deposit_id,
                            'approve_status' => 0,
                            'status' => 0,
                            'description'     => $message,
                            'link' => 'client/clientdeposit_approval/'.$deposit_id,
                            'date' => date('Y-m-d'),
                            'date_time' => date('Y-m-d H:i:s'),
                            'updated_at' => date('Y-m-d H:i:s')
                        );
                        $this->home_model->insert('tblmasterapproval',$adata);

                        //Sending Mobile Intimation
                            $token = get_staff_token($staffid);
                            $title = 'Schach';
                            $send_intimation = sendFCM($message, $title, $token, $page = 2);
                    }
                }
                handle_multi_payment_attachments($deposit_id,'client_deposit');
            }

            return $deposit_id;
        }
        return FALSE;
    }

    function add_client_refund($data){
        $assignstaffid = array();
        if(!empty($data["assignproductionid"])){
            $assignstaff = $data["assignproductionid"];

            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                    $assignstaffid[] = str_replace("staff", "", $single_staff);
                }
                // if (strpos($single_staff, 'group') !== false) {
                //     $single_staff = str_replace("group", "", $single_staff);
                //     $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                //     foreach ($staffgroup as $singlestaff) {
                //         $assignstaffid[] = $singlestaff['staff_id'];
                //     }
                // }
            }
            $assignstaffid = array_unique($assignstaffid);
        }

        $current_datetime = date('Y-m-d H:i:s');
        $insertdata['client_id'] = $data["client_id"];
        $insertdata['service_type'] = $data["service_type"];
        $insertdata['amount'] = $data["amount"];
        $insertdata['remark'] = $data["remark"];
        $insertdata['date'] = date("Y-m-d");
        $insertdata['added_by'] = get_staff_user_id();
        $insertdata['created_at'] = $current_datetime;
        $insertdata['updated_at'] = $current_datetime;

        $this->db->insert('tblclientrefund', $insertdata);
        $insert_id = $this->db->insert_id();
        if ($insert_id){
            if (!empty($assignstaffid)){
                foreach ($assignstaffid as $staffid) {
                    $sdata['staff_id'] = $staffid;
                    $sdata['clientrefund_id'] = $insert_id;
                    $sdata['status'] = '1';
                    $sdata['created_at'] = date("Y-m-d H:i:s");
                    $sdata['updated_at'] = date("Y-m-d H:i:s");
                    $this->db->insert('tblclientrefundapproval', $sdata);

                    $adata = array(
                        'staff_id' => $staffid,
                        'fromuserid' => get_staff_user_id(),
                        'module_id' => 47,
                        'table_id' => $insert_id,
                        'approve_status' => 0,
                        'status' => 0,
                        'description'     => 'Client Refund send for approval',
                        'link' => 'client/client_refund_approval/'.$insert_id,
                        'date' => date('Y-m-d'),
                        'date_time' => date('Y-m-d H:i:s'),
                        'updated_at' => date('Y-m-d H:i:s')
                    );
                    $this->db->insert('tblmasterapproval', $adata);

                    //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $message = 'Client Refund send for approval';
                    $title = 'Schach';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
                }
            }
            return $insert_id;
        }
        return false;
    }

    public function update_client_refund($data, $id){
      $assignstaffid = array();
      if(!empty($data["assignproductionid"])){
          $assignstaff = $data["assignproductionid"];

          foreach ($assignstaff as $single_staff) {
              if (strpos($single_staff, 'staff') !== false) {
                  $assignstaffid[] = str_replace("staff", "", $single_staff);
              }
              // if (strpos($single_staff, 'group') !== false) {
              //     $single_staff = str_replace("group", "", $single_staff);
              //     $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
              //     foreach ($staffgroup as $singlestaff) {
              //         $assignstaffid[] = $singlestaff['staff_id'];
              //     }
              // }
          }
          $assignstaffid = array_unique($assignstaffid);
      }

      $current_datetime = date('Y-m-d H:i:s');
      $update_data['client_id'] = $data["client_id"];
      $update_data['service_type'] = $data["service_type"];
      $update_data['amount'] = $data["amount"];
      $update_data['remark'] = $data["remark"];
      $update_data['status'] = 0;
      $update_data['updated_at'] = $current_datetime;

      $update = $this->home_model->update('tblclientrefund', $update_data, array('id'=>$id));
      if ($update == true){
          $clientrefund_id = $id;
          if (!empty($assignstaffid)){

              $this->home_model->delete("tblclientrefundapproval", array("clientrefund_id" => $clientrefund_id));
              $this->home_model->delete("tblmasterapproval", array("module_id"=>47,"table_id" => $clientrefund_id));
              foreach ($assignstaffid as $staffid) {
                  $sdata['staff_id'] = $staffid;
                  $sdata['clientrefund_id'] = $clientrefund_id;
                  $sdata['status'] = '1';
                  $sdata['created_at'] = date("Y-m-d H:i:s");
                  $sdata['updated_at'] = date("Y-m-d H:i:s");
                  $this->db->insert('tblclientrefundapproval', $sdata);

                  $adata = array(
                      'staff_id' => $staffid,
                      'fromuserid' => get_staff_user_id(),
                      'module_id' => 47,
                      'table_id' => $clientrefund_id,
                      'approve_status' => 0,
                      'status' => 0,
                      'description'     => 'Client Refund send for approval',
                      'link' => 'client/client_refund_approval/'.$clientrefund_id,
                      'date' => date('Y-m-d'),
                      'date_time' => date('Y-m-d H:i:s'),
                      'updated_at' => date('Y-m-d H:i:s')
                  );
                  $this->db->insert('tblmasterapproval', $adata);

                  //Sending Mobile Intimation
                  $token = get_staff_token($staffid);
                  $message = 'Client Refund send for approval';
                  $title = 'Schach';
                  $send_intimation = sendFCM($message, $title, $token, $page = 2);
              }
          }
          return $clientrefund_id;
      }
      return false;
    }
}

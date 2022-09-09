<?php

defined('BASEPATH') or exit('No direct script access allowed');

require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;

class Petty_cash extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    public function index()
    {
        check_permission('134,266','view');
        $data['pettycash_info']  = $this->db->query("SELECT * FROM tblpettycashmaster where status = 1 order by id desc ")->result();        
       
        $data['title'] = 'Petty Cash Masters';
        $this->load->view('admin/petty_cash/manage', $data);

    }

    public function add($id="")
    {
        check_permission('134,266','create');
        $data['staff_info']  = $this->db->query("SELECT * FROM tblstaff WHERE active =  '1' order by firstname asc ")->result();

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(                            
                            'addedby' => get_staff_user_id(),
                            'department_name' => $department_name,
                            'amount' => $amount,
                            'description' => $description,
                            'staff_id' => $staff_id,
                            'created_at' => date('Y-m-d H:i:s'),
                            'status' => 1
                        );
                    
                    
                    
            $insert = $this->home_model->insert('tblpettycashmaster', $ad_data);  

            if($insert){

                $main_id = $this->db->insert_id();

                if($staff_id > 0){

                    //Sending Mobile Intimation
                    $token = get_staff_token($staff_id);
                    $message = 'Petty Cash department ('.$department_name.') alloted to you';
                    $title = 'Schach';

                    $notified = add_notification([
                            'description'     => $message,
                            'touserid'        => $staff_id,
                            'module_id'       => 8,
                            'type'            => 0,
                            'table_id'        => $main_id,
                            'fromuserid'      => get_staff_user_id(),
                            'link'            => 'petty_cash/confirmation/'.$main_id,
                           
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$staff_id]);
                        }
                }
            
                set_alert('success', 'Department added Successfully');
                redirect(admin_url('petty_cash'));
            }
        }

        if(!empty($id)){
            $data['pettycash_info']  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE id = '".$id."'")->row();
            $data['id'] = $id;
            $data['title'] = 'Edit Petty Cash Department';
        }else{
            $data['title'] = 'Add Petty Cash Department';
        }

        
        $this->load->view('admin/petty_cash/add', $data);

    }


    public function confirmation_old($id='')
    {
        
        if(empty($id)){
            $id = $_POST['id'];
        }
        $data['pettycash_info']  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE id = '".$id."' ")->row();
       
        if(get_staff_user_id() != $data['pettycash_info']->staff_id){
            access_denied('Petty_cash');
        }

        if($data['pettycash_info']->staff_confirmed > 0){
            set_alert('warning', 'Record Already Updated !');
            redirect(admin_url());
        }

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
                'staff_confirmed' => $staff_confirmed,
                'staff_remark' => $staff_remark,
                'status' => 1
            );
                    
                    
            $update = $this->home_model->update('tblpettycashmaster', $ad_data,array('id'=>$id));  

            if($update){

                $pettycash_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE id = '".$id."' ")->row();

                if($pettycash_info->addedby > 0){

                    if($staff_confirmed == 1){
                        $description = 'Employee Confimed as a Petty Cash department Manger';
                    }else{
                        $description = 'Employee Reject as a Petty Cash department Manger';
                    }

                    $notified = add_notification([
                            'description'     => $description,
                            'touserid'        => $pettycash_info->addedby,
                            'table_id'        => $id,
                            'fromuserid'      => get_staff_user_id(),
                            'link'            => 'petty_cash',
                           
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$pettycash_info->addedby]);
                        }
                }
            
                set_alert('success', 'Record Updated Successfully');
                redirect(admin_url());
            }
        }

        $data['id'] = $id;

        $data['title'] = 'Add Petty Cash Confirmation';
        
        $this->load->view('admin/petty_cash/confirmation', $data);

    }

    /* this function use for update petty cash confirmation */
    public function confirmation($id='')
    {
        if(empty($id)){
            $id = $_POST['id'];
        }
        
        $data['pettycash_info']  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE id = '".$id."' ")->row();
       
        if(get_staff_user_id() != $data['pettycash_info']->staff_id){
            access_denied('Petty_cash');
        }

        // if($data['pettycash_info']->staff_confirmed > 0){
        //     set_alert('warning', 'Record Already Updated !');
        //     redirect(admin_url("approval/staff_notification_list"));
        // }

        if($this->input->post()) {
			extract($this->input->post());
			
			$post_fields = array(
                "user_id" => get_staff_user_id(),
				"id" => $id,
				"staff_remark" => $staff_remark,
				"staff_confirmed" => $staff_confirmed,
				"payment_mode" => $payment_mode
			);
            
			/* SEND REQUEST FOR CONFIRMATION START */
				$request_url = base_url()."Petty_cash/confirmation";
				$response = $this->curl_method($request_url, "POST", $post_fields);
				if (is_array($response) && isset($response["status"]) && $response["status"] == TRUE){
					set_alert('success', 'Action Taken Successfully');
					redirect(admin_url("approval/staff_notification_list"));
				}else{
					set_alert('danger', "Somthing Went wrong");
					redirect(admin_url("approval/staff_notification_list"));
				}
			/* SEND REQUEST FOR CONFIRMATION END */
		}

        /* this request send for get data */
        $data["request_info"] = array();
		$request_url = base_url()."Petty_cash/department_details?id=".$id;
		$response = file_get_contents($request_url);
		if (!empty($response)){
			$decode_response = json_decode($response, TRUE);
			if ($decode_response["status"] == TRUE){
				$data["request_info"] = $decode_response["data"];
			}
		}
		
		if (empty($data["request_info"])){
			redirect(admin_url("approval/staff_notification_list"));
		}

        $data['id'] = $id;
        $data['title'] = 'Petty Cash';
        $data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
        $this->load->view('admin/petty_cash/confirmation', $data);
    }

    public function edit($id="")
    {

        check_permission('134,266','edit');

        if(!empty($_POST)){
            extract($this->input->post());

            $info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE id = '".$id."'")->row();

            if($info->staff_id == $staff_id){
                $staff_confirmed = $info->staff_confirmed;
                $staff_remark = $info->staff_remark;
            }else{
                $staff_confirmed = 0;
                $staff_remark = '';
            }

             $ad_data = array(                            
                'department_name' => $department_name,
                'addedby' => get_staff_user_id(),
                'description' => $description,
                'staff_id' => $staff_id,
                'staff_confirmed' => $staff_confirmed,
                'staff_remark' => $staff_remark,
                'status' => 1
            );
                    
                    
            $update = $this->home_model->update('tblpettycashmaster', $ad_data,array('id'=>$id));  

            if($update){
                $this->home_model->delete('tblnotifications', array('module_id'=>8,'table_id'=>$id));

               // if($info->staff_id != $staff_id){

                    //Sending Mobile Intimation
                    $token = get_staff_token($staff_id);
                    $message = 'Petty Cash department ('.$department_name.') alloted to you';
                    $title = 'Schach';    

                    $notified = add_notification([
                            'description'     => $message,
                            'touserid'        => $staff_id,
                            'module_id'       => 8,
                            'type'            => 0,
                            'table_id'        => $id,
                            'fromuserid'      => get_staff_user_id(),
                            'link'            => 'petty_cash/confirmation/'.$id,
                           
                        ]);
                        if ($notified) {
                            pusher_trigger_notification([$staff_id]);
                        }
               // }
            
                set_alert('success', 'Department updated Successfully');
                redirect(admin_url('petty_cash'));
            }
        }


    }


    public function reports($pettycash_id = '')
    {
        check_permission('123,233','view');
        $data['s_pettycash_id'] = '';
        $data['pettycash_info']  = $this->db->query("SELECT * FROM tblpettycashmaster order by id desc ")->result();   

        if(!empty($_POST)){
            extract($this->input->post());
             $data['s_pettycash_id'] = $pettycash_id;

             $where = " pettycash_id = '".$pettycash_id."' ";
                if(!empty($from_date) && !empty($to_date)){

                    $data['s_from_date'] = $from_date;
                    $data['s_to_date'] = $to_date;

                    $from_date = str_replace("/","-",$from_date);
                    $from_date = date("Y-m-d",strtotime($from_date));

                    $to_date = str_replace("/","-",$to_date);
                    $to_date = date("Y-m-d",strtotime($to_date));

                    $from_date = date('Y-m-d',strtotime($from_date));
                    $to_date = date('Y-m-d',strtotime($to_date));
                    $where .= " and date between '".$from_date."' and '".$to_date."'";

                }

            $data['pettycash_log']  = $this->db->query("SELECT * FROM tblpettycashlogs WHERE  ".$where." order by id desc ")->result();


        }else{
            if(!empty($pettycash_id)){
                $data['s_pettycash_id'] = $pettycash_id;
                $data['pettycash_log']  = $this->db->query("SELECT * FROM tblpettycashlogs WHERE  pettycash_id = '".$pettycash_id."' order by id desc ")->result();
            }
        }     
       
        $data['title'] = 'Report - Petty Cash';
        $this->load->view('admin/petty_cash/pettycash_report', $data);

    }

    public function delete($id)
    {
        
        $response = $this->home_model->delete('tblholidays', array('id'=>$id));
        if ($response == true) {
            set_alert('success', _l('deleted', 'holiday'));
        } else {
            set_alert('warning', _l('problem_deleting', 'holiday'));
        }
        redirect(admin_url('holidays'));
    }

    /* this function use for petty cash approval */
    public function petty_cash_approval($id){

        $data["pettycashrequest_data"] = $this->db->query("SELECT * FROM `tblpettycashrequest` WHERE `id`= ".$id."")->row();
        // if(!empty($data["pettycashrequest_data"]) && $data["pettycashrequest_data"]->approved_status > 0){
		// 	set_alert('warning', 'Action Already Taken On Request');
		// 	redirect(admin_url("approval/staff_notification_list"));
		// }

        /* take action against to request */
		if($this->input->post()) {
			extract($this->input->post());
			
			$approved_amount = (!empty($approved_amount)) ? $approved_amount : 0;
			$post_fields = array(
				"user_id" => get_staff_user_id(),
				"approve_status" => $approve_status,
				"remark" => $remark,
				"approved_amount" => $approved_amount,
				"request_id" => $id,
			);
			/* SEND REQUEST FOR APPROVAL START */
				$request_url = base_url()."Petty_cash/approve_request";
				$response = $this->curl_method($request_url, "POST", $post_fields);
				if (is_array($response) && isset($response["status"]) && $response["status"] == TRUE){
					set_alert('success', 'Action Taken On Request Successfully');
					redirect(admin_url("approval/staff_notification_list"));
				}else{
					set_alert('danger', "Somthing Went wrong");
					redirect(admin_url("approval/staff_notification_list"));
				}
			/* SEND REQUEST FOR APPROVAL END */
		}

        $data["request_info"] = $data["read_by_user"] = array();
		$request_url = base_url()."Petty_cash/get_single_request?request_id=".$id;
		// $request_url = "https://schachengineers.com/schacrm/Petty_cash/get_single_request?request_id=724";
		$response = file_get_contents($request_url);
		if (!empty($response)){
			$decode_response = json_decode($response, TRUE);
            
			if ($decode_response["msg"] == "Success"){
				$data["request_info"] = $decode_response["request_info"];
				$data["read_by_user"] = $decode_response["read_by_user"];
			}
		}
		
		if (empty($data["request_info"])){
			redirect(admin_url("approval/staff_notification_list"));
		}
        $data["title"] = "Petty Cash Approval";
        $this->load->view('admin/petty_cash/petty_cash_approval', $data);
    }

    /* this function use for manager request approval */
    public function manager_request_approval($id){

        /* take action against to request */
		if($this->input->post()) {
			extract($this->input->post());
			
			$approved_amount = (!empty($approved_amount)) ? $approved_amount : 0;
			$post_fields = array(
				"user_id" => get_staff_user_id(),
				"approve_status" => $approve_status,
				"remark" => $remark,
				"approved_amount" => $approved_amount,
				"request_id" => $id,
			);
			/* SEND REQUEST FOR APPROVAL START */
				$request_url = base_url()."Petty_cash/approve_request_by_manager";
				$response = $this->curl_method($request_url, "POST", $post_fields);
                
				if (is_array($response) && isset($response["status"]) && $response["status"] == TRUE){
					set_alert('success', 'Action Taken On Request Successfully');
					redirect(admin_url("approval/staff_notification_list"));
				}else if (is_array($response) && isset($response["status"]) && $response["status"] == FALSE){
					set_alert('warning', $response["message"]);
					redirect(admin_url("approval/staff_notification_list"));
				}else{
					set_alert('danger', "Somthing Went wrong");
					redirect(admin_url("approval/staff_notification_list"));
				}
			/* SEND REQUEST FOR APPROVAL END */
		}

        $data["request_info"] = $data["read_by_user"] = array();
		$request_url = base_url()."Petty_cash/get_single_request_details?table_id=".$id;
		// $request_url = "https://schachengineers.com/schacrm/Petty_cash/get_single_request_details?table_id=724";
		$response = file_get_contents($request_url);
		if (!empty($response)){
			$decode_response = json_decode($response, TRUE);
            
			if ($decode_response["msg"] == "Success"){
				$data["request_info"] = $decode_response["request_info"];
				$data["read_by_user"] = $decode_response["read_by_user"];
			}
		}
		
		if (empty($data["request_info"])){
			redirect(admin_url("approval/staff_notification_list"));
		}
        $data["title"] = "Manager Request Approval";
        $this->load->view('admin/petty_cash/manager_request_approval', $data);
    }

    /* this function use for petty cash confirmation */
    public function request_confirmation($id){

        if($this->input->post()) {
			extract($this->input->post());
			
			$approved_amount = (!empty($approved_amount)) ? $approved_amount : 0;
			$post_fields = array(
				"request_id" => $id,
				"confirmation_remark" => $user_confirmation_remark,
				"receive_status" => $receive_status,
				"payment_mode" => $confirmation_payment_mode
			);
            
			/* SEND REQUEST FOR CONFIRMATION START */
				$request_url = base_url()."Petty_cash/get_request_approved_info";
				$response = $this->curl_method($request_url, "POST", $post_fields);
               
				if (!is_array($response) && $response == TRUE){
					set_alert('success', 'Petty Cash Request Confirmed Successfully');
					redirect(admin_url("approval/staff_notification_list"));
				}else{
					set_alert('danger', "Somthing Went wrong");
					redirect(admin_url("approval/staff_notification_list"));
				}
			/* SEND REQUEST FOR CONFIRMATION END */
		}

        $data["pettycashrequest_data"] = $this->db->query("SELECT * FROM `tblpettycashrequest` WHERE `id`= ".$id."")->row();

        $data["request_info"] = $data["read_by_user"] = array();
		// $request_url = base_url()."Petty_cash/get_single_request?request_id=".$id;
		$request_url = "https://schachengineers.com/schacrm/Petty_cash/get_single_request?request_id=724";
		$response = file_get_contents($request_url);
		if (!empty($response)){
			$decode_response = json_decode($response, TRUE);
            
			if ($decode_response["msg"] == "Success"){
				$data["request_info"] = $decode_response["request_info"];
				$data["read_by_user"] = $decode_response["read_by_user"];
			}
		}
		
		if (empty($data["request_info"])){
			redirect(admin_url("approval/staff_notification_list"));
		}
        $data["title"] = "Petty Cash Request Confirmation";
        $data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
        $this->load->view('admin/petty_cash/petty_cash_confirmation', $data);
    }

    /* THIS FUNCTION USE FOR CALL POST CURL METHOD */
	function curl_method($request_url, $method, $post_fields = array()){

		$ch = curl_init();
		curl_setopt($ch, CURLOPT_URL, $request_url);
		curl_setopt($ch, CURLOPT_RETURNTRANSFER, true);
        if ($method == 'POST'){
            curl_setopt($ch, CURLOPT_POSTFIELDS, http_build_query($post_fields));
        }
		$response = curl_exec($ch);
		if (!empty($response)){
			$response_decode = json_decode($response, TRUE);
			if (!empty($response_decode) && isset($response_decode["error"])){
				return $response_decode["error"];
			}else if (!empty($response_decode) && isset($response_decode["success"])){
				return TRUE;
			}else if (!empty($response_decode) && (isset($response_decode["status"]) && $response_decode["status"] == TRUE)){
				return $response_decode;
			}else if (!empty($response_decode) && (isset($response_decode["status"]) && $response_decode["status"] == FALSE)){
				return $response_decode;
			}
		}
		return "Somthing went wrong!";
	}
   
}

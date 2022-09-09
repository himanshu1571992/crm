<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Follow_up_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
        

        $this->load->model('home_model');
       // $this->load->model('follow_up_model');
    }

    public function get_suggestions()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}

		$suggestion_info = $this->db->query("SELECT * FROM `tblsuggestion` where status = '1'")->result(); 
		if(!empty($suggestion_info)){
			foreach ($suggestion_info as $value) {
				$arr[] = array(
						'suggestion'	 => $value->suggestion
					);
			}

			$return_arr['status'] = true;
			$return_arr['message'] = "Success";
			$return_arr['data'] = $arr;

		}else{
        	$return_arr['status'] = false;	
			$return_arr['message'] = "Records Not found!";
			$return_arr['data'] = [];
        }

        
        header('Content-type: application/json');
	    echo json_encode($return_arr);
	    //http://35.154.77.171/schach/Follow_up_API/get_suggestions 

	}



    public function get_followup_clients()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($user_id)){

        	if(getCurrentFinancialYear() == 1){
	            $where_invoice = "service_type = 1 and renewal = 0 and rental_status  = 0 and duedate >= '".date('Y-m-d')."' and year_id = '".getCurrentFinancialYear()."' ";
	        }else{
	            $where_invoice = "service_type = 1 and renewal = 0 and rental_status  = 0 and year_id = '".getCurrentFinancialYear()."' ";    
	        }

	        $client_ids = 0;
	        $invoice_client = $this->db->query("SELECT clientid from `tblinvoices` where ".$where_invoice." group by clientid")->result();
	        if(!empty($invoice_client)){
	            foreach ($invoice_client as $key => $value) {
	                if($key == 0){
	                    $client_ids = $value->clientid;
	                }else{
	                    $client_ids .= ','.$value->clientid;
	                }
	            }
	        }

	        $sales_client_ids = 0;
	        $sales_invoice = $this->db->query("SELECT clientid from `tblinvoices` where service_type = 2 and status != '5' group by clientid")->result();
	        if(!empty($sales_invoice)){
	            foreach ($sales_invoice as $key => $value) {
	                if($key == 0){
	                    $sales_client_ids = $value->clientid;
	                }else{
	                    $sales_client_ids .= ','.$value->clientid;
	                }
	            }
	        } 



        	$status_info = $this->db->query("SELECT `name`,`id` FROM `tblclientstatus` where status = '1'  ")->result_array();


        	//deleteing last lead records
       		$this->db->query("DELETE FROM tblpaymentfollowupclients where date < '".date('Y-m-d')."' ");

       		$is_admin = get_staff_info($user_id)->admin;
       		if($is_admin == 0){
	            $clients_info = get_staff_clients($user_id);
	        }else{
	            $clients_info = array();
	            $clients_data = $this->db->query("SELECT `userid` FROM `tblclientbranch` where active = '1' and followup = '1' ")->result();
	            if(!empty($clients_data)){
	                foreach ($clients_data as $value) {
	                    $clients_info[] = $value->userid;
	                }
	            }
	        }

        	
	        if(!empty($clients_info)){
	        	foreach ($clients_info as $client_id){
			        		$exist_info = $this->db->query("SELECT `id` FROM `tblpaymentfollowupclients` where client_id = '".$client_id."' and staffid = '".$user_id."' and date = '".date('Y-m-d')."' ")->row();        
			        		if(empty($exist_info)){
			        			$client_info = $this->db->query("SELECT `client_status` FROM `tblclientbranch` where userid = '".$client_id."'  ")->row();
			        			 $ad_data = array(
			                                'client_id' => $client_id,
			                                'staffid' => $user_id,
			                                'date' => date('Y-m-d'),
			                                'finished' => 0,
			                                'status' => $client_info->client_status,
			                            );

			                 	$this->home_model->insert('tblpaymentfollowupclients',$ad_data);
			        		}
			        }
	        }

	        if(isset($finished)){
	        	$followup_clients =	$this->home_model->get_result('tblpaymentfollowupclients', array('date' => date('Y-m-d'), 'staffid' => $user_id, 'finished' => $finished), '',array('id','asc'));
	        }else{
	        	$followup_clients =	$this->home_model->get_result('tblpaymentfollowupclients', array('date' => date('Y-m-d'), 'staffid' => $user_id), '',array('id','asc'));
	        }
	        $followup_count_info =	$this->db->query("SELECT * from tblpaymentfollowupclients where `date` = '".date('Y-m-d')."' and staffid = '".$user_id."' ")->result(); 
	        $followup_count = 0;
	        if(!empty($followup_count_info)){
	        	foreach ($followup_count_info as $row_1) {
	        		$d_amt = client_balance_amt($row_1->client_id);
	        		if($d_amt > 1){
	        			$followup_count++;
	        		}
	        	}
	        }
	        
	        $ttl_due_amt = 0;
	        if(!empty($followup_clients)){
	        	foreach ($followup_clients as $row) {
	        		$client_info = $this->db->query("SELECT `client_branch_name`,`other_collection` FROM tblclientbranch WHERE userid = '".$row->client_id."' ")->row();

	        		$due_amt = client_balance_amt($row->client_id);
	        		if($due_amt > 1 && $client_info->other_collection == 0){


	        			$client_info = client_info($row->client_id);
	        			$client_type = client_running_closed_sales_status($client_ids,$sales_client_ids,$row->client_id);
	        			
	        			$client_status = '';
	        			if(!empty($row->status)){
	        				$client_status = value_by_id('tblclientstatus',$row->status,'name');
	        			}
	        			$ttl_due_amt += $due_amt;

	        			$group_nams = '';
	        			if(!empty($client_info->staff_group)){ 
                            $group_arr = explode(',', $client_info->staff_group);                            
                            foreach ($group_arr as $k => $group_id) {
                                if($k == 0){
                                    $group_nams = value_by_id('tblstaffgroup',$group_id,'name');
                                }else{
                                    $group_nams .= ', '.value_by_id('tblstaffgroup',$group_id,'name');
                                }                                
                            }
                            
                        }

                        //Getting Reply status
                        $reply_status = 0;
                        $approval_info = $this->db->query("SELECT `id` FROM tblmasterapproval WHERE `status` = '0' and `module_id` = '31' and  `table_id` = '".$row->client_id."' ")->row();
                        if(!empty($approval_info)){
                        	$reply_status = 2;
                        }else{
                        	 $todays_reply_info = $this->db->query("SELECT `id` FROM tblfollowupclientactivity WHERE `client_id` = '".$row->client_id."' and `date` = '".date('Y-m-d')."' ")->row();
                        	 if(!empty($todays_reply_info)){
                        	 	$reply_status = 1;	
                        	 }
                        }
	        			
	        			$arr[] = array(
							'id'	 => $row->id,
							'client_id'     => $row->client_id,
							'finished'     => $row->finished,
							'status'     => $row->status,
							'client_name'     => get_company_name($row->client_id),
							'due_amt'     => client_balance_amt($row->client_id),
							'client_type'     => $client_type,
							'client_status'     => $client_status,
							'group_nams'     => $group_nams,
							'reply_status'     => $reply_status,
							'date'     => date('d/m/Y',strtotime($row->date))
						);
	        		}
	        		
	        	}

	        	//Sort the array by reply staus desc
	        	$replay_status_wise = array_column($arr, 'reply_status');
				array_multisort($replay_status_wise, SORT_DESC, $arr);


	        	$return_arr['status'] = true;
				$return_arr['message'] = "Success";
				$return_arr['data'] = $arr;
				$return_arr['status_data'] = $status_info;
				$return_arr['count'] = $followup_count;
				$return_arr['ttl_due_amt'] = number_format($ttl_due_amt, 2, '.', '');
	        	

	        }else{
	        	$return_arr['status'] = false;
				$return_arr['message'] = "Record not found!";
				$return_arr['data'] = [];
				$return_arr['status_data'] = $status_info;
				$return_arr['count'] = $followup_count;
				$return_arr['ttl_due_amt'] = 0;
	        }

        }else{
        	$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
			$return_arr['status_data'] = [];
			$return_arr['count'] = 0;
			$return_arr['ttl_due_amt'] = 0;
        }

        
        header('Content-type: application/json');
	    echo json_encode($return_arr);
	    //http://mustafa-pc/crm/Follow_up_API/get_followup_clients?user_id=1        
    }



    public function update_payment_followup()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->update('tblpaymentfollowupclients', array('finished'=>$status,'datefinished'=>date('Y-m-d H:i:s')),array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Status Updated Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to update status";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://mustafa-pc/crm/Follow_up_API/update_payment_followup?id=6&status=1
    }


    public function add_client_activity()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($user_id) && !empty($client_id) && !empty($message)){
        	$ad_data = array(
                        'client_id' => $client_id,
                        'message' => $message,
                        'staffid' => $user_id,
                        'date' => date('Y-m-d'),
                        'datetime' => date('Y-m-d H:i:s'),
                        'priority' => 0,
                        'status' => 1
                    );

            $insert = $this->home_model->insert('tblfollowupclientactivity',$ad_data);



            // For Tagging 
            /* this is for check notification update */
           $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$client_id."' and staff_id = '".$user_id."' and module_id = 31")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($tag_staff_ids)){
            	$staff_ids = json_decode($tag_staff_ids);
            	foreach ($staff_ids as $staff_id) {
                   $n_data = array(
                        'description' => 'You taged in client activity follow up',
                        'staff_id' => $staff_id,
                        'fromuserid' => $user_id,
                        'table_id' => $client_id,
                        'isread' => 0,
                        'module_id' => 31,
                        'link'  => "follow_up/client_activity/".$client_id,
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);
                    
                    //Sending Mobile Intimation
                        $token = get_staff_token($staff_id);
                        $title = 'Schach';
                        $message = 'You taged in client activity follow up';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
               }
            }

            if($insert == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Activity added Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to add activity";
				$return_arr['data'] = [];
        	}

	    }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);


	    //http://mustafa-pc/crm/Follow_up_API/add_client_activity?client_id=3&message=added by app&user_id=1&tag_staff_ids=[1,27]

	}


	public function update_payment_priority()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->update('tblfollowupclientactivity', array('priority'=>$status),array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Priority Updated Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to update Priority";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://mustafa-pc/crm/Follow_up_API/update_payment_priority?id=2&status=1
    }


    public function get_client_activity()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}

		if(!empty($client_id)){

			if(!empty($priority) && $priority == 1){
				$activity_log = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where client_id = '".$client_id."' and priority = '1' order by id desc")->result(); 
			}else{
				if($last_id == 0){
					$activity_log = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where client_id = '".$client_id."' order by id desc LIMIT 10")->result(); 

				}else{
					$activity_log = $this->db->query("SELECT * FROM `tblfollowupclientactivity` where client_id = '".$client_id."' and id < '".$last_id."' order by id desc LIMIT 10")->result(); 
				}
				
			}

			//$number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' ")->result();
			$number_list = $this->db->query("SELECT phonenumber from tblcontacts  where userid = '".$client_id."' ")->result();
            $numbers = '';
            if(!empty($number_list)){
                $i = 0;
                foreach ($number_list as $no) {
                    if($i == 0){
                        $numbers .= $no->phonenumber;
                    }else{
                        $numbers .= ','.$no->phonenumber;
                    }
                    $i++;
                }
            }

			krsort($activity_log);

			if(!empty($activity_log)){
				foreach ($activity_log as $key => $row) {


					//Getting Calls
					$from_date = $row->date;
					$to_date = '';
					$next_key = ($key+1); 
					if(!empty($activity_log[$next_key]->date)){
					  $to_date = $activity_log[$next_key]->date;
					}
					if(!empty($numbers)){
					  if($to_date != ''){
					      $call_history = $this->db->query("SELECT * from tblcalloutgoing where customer_number IN (".$numbers.") and date between '".$from_date."' and '".$to_date."'  order by id desc ")->result();
					  }else{
					      $call_history = $this->db->query("SELECT * from tblcalloutgoing where customer_number IN (".$numbers.") and date >= '".$from_date."'  order by id desc ")->result();
					  }
					}



					$arr[] = array(
						'id' => $row->id,
						'type' => '1',
						'staffid' => $row->staffid,
						'staff_name' => get_employee_name($row->staffid),
						'message' => $row->message,
						'priority' => $row->priority,
						'datetime' => _dt($row->datetime),
						'time_ago' => time_ago($row->datetime),
						'status' => $row->status,
						'customer_name' => '',
						'customer_number' => '',
						'agent_number' => '',
						'call_status' => '',
						'recording_url' => '',
						'calling_date' => ''

					);

					if(!empty($call_history)){
						foreach ($call_history as $r) {
							
							$customer_name = $this->db->query("SELECT firstname from tblcontacts  where userid = '".$row->client_id."' and phonenumber = '".$r->customer_number."' ")->row()->firstname;
							$arr[] = array(
								'id' => $r->id,
								'type' => '2',
								'staffid' => '',
								'staff_name' => '',
								'message' => '',
								'priority' => '',
								'datetime' => '',
								'time_ago' => '',
								'status' => '',
								'customer_name' => $customer_name,
								'customer_number' => $r->customer_number,
								'agent_number' => $r->agent_number,
								'call_status' => $r->call_status,
								'recording_url' => $r->recording_url,
								'calling_date' => _d($r->created_at)

							);
						}
					}
				}

				$return_arr['status'] = true;
				$return_arr['message'] = "Success";
				$return_arr['data'] = $arr;

			}else{
				$return_arr['status'] = false;
				$return_arr['message'] = "Record Not Found!";
				$return_arr['data'] = [];
			}
			
        	

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://mustafa-pc/crm/Follow_up_API/get_client_activity?client_id=2&priority=0&last_id=0

	}


	//Lead Followup starts

	public function get_followup_leads()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($user_id)){
        	$status_info = $this->db->query("SELECT `name`,`id` FROM `tblenquirytypemaster` where status = '1'  ")->result_array();

        	//deleteing last lead records
        	$this->db->query("DELETE FROM tblleadfollowup where date < '".date('Y-m-d')."' ");

        	/*$lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where la.staff_id = '".$user_id."' and la.approve_status = 1 and la.status = 1 and l.followup = 1 GROUP by la.lead_id")->result();*/
        	if($user_id == 1){
        		$lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where l.followup = 1 GROUP by la.lead_id")->result();
        	}else{
        		$lead_info = $this->db->query("SELECT l.* from tblleadassignstaff as la LEFT JOIN tblleads as l ON l.id = la.lead_id where la.staff_id = '".$user_id."' and l.followup = 1 GROUP by la.lead_id")->result();
        	}
        	
	        if(!empty($lead_info)){
	        	foreach ($lead_info as $row){
			        		$exist_info = $this->db->query("SELECT `id` FROM `tblleadfollowup` where lead_id = '".$row->id."' and staffid = '".$user_id."' and date = '".date('Y-m-d')."' ")->row();        
		        		if(empty($exist_info)){

		        			$leadproduct_info = $this->db->query("SELECT `enquiry_for_id` FROM `tblproductinquiry` where enquiry_id = '".$row->id."' and enquiry_for_id > '0' ")->row();    
		        			if(!empty($leadproduct_info)){
		        				$type = $leadproduct_info->enquiry_for_id;
		        			}else{
		        				$type = 0;
		        			}

		        			$ad_data = array(
	                                'lead_id' => $row->id,	                                
	                                'staffid' => $user_id,
	                                'date' => date('Y-m-d'),
	                                'finished' => 0,
	                                'status' => $row->enquiry_type_id,
	                                'type' => $type,
	                            );

		                 	$this->home_model->insert('tblleadfollowup',$ad_data);
		        		}
			        }
	        }

	        if(isset($finished)){
	        	$followup_leads =	$this->home_model->get_result('tblleadfollowup', array('date' => date('Y-m-d'), 'staffid' => $user_id, 'finished' => $finished), '',array('id','asc'));
	        }else{
	        	$followup_leads =	$this->home_model->get_result('tblleadfollowup', array('date' => date('Y-m-d'), 'staffid' => $user_id), '',array('id','asc'));
	        }
	        $followup_count =	$this->db->query("SELECT COALESCE(count(id),0) as count from tblleadfollowup where `date` = '".date('Y-m-d')."' and staffid = '".$user_id."' ")->row()->count;
	        
	        if(!empty($followup_leads)){
	        	foreach ($followup_leads as $row) {

	        		$lead_info = $this->db->query("SELECT `client_branch_id`,`company` FROM `tblleads` where id = '".$row->lead_id."' ")->row();

	        		if($lead_info->client_branch_id > 0){
	        			$client_info = $this->db->query("SELECT `client_branch_name` FROM tblclientbranch WHERE userid = '".$lead_info->client_branch_id."' ")->row();
				        $company = $client_info->client_branch_name;
				    }else{
				        $company = $lead_info->company;
				    }

				    //Getting Reply status
                    $reply_status = 0;
                    $approval_info = $this->db->query("SELECT `id` FROM tblmasterapproval WHERE `status` = '0' and `module_id` = '30' and  `table_id` = '".$row->lead_id."' ")->row();
                    if(!empty($approval_info)){
                    	$reply_status = 2;
                    }else{
                    	 $todays_reply_info = $this->db->query("SELECT `id` FROM tblfollowupleadactivity WHERE `lead_id` = '".$row->lead_id."' and `date` = '".date('Y-m-d')."' ")->row();
                    	 if(!empty($todays_reply_info)){
                    	 	$reply_status = 1;	
                    	 }
                    }

	        		$arr[] = array(
						'id'	 => $row->id,
						'lead_id'     => $row->lead_id,
						'company'     => $company,
						'finished'     => $row->finished,
						'status'     => $row->status,
						'type'     => $row->type,
						'reply_status'     => $reply_status,
						'lead_no'     => value_by_id('tblleads',$row->lead_id,'leadno'),
						'date'     => date('d/m/Y',strtotime($row->date))
					);
	        	}


	        	$return_arr['status'] = true;
				$return_arr['message'] = "Success";
				$return_arr['data'] = $arr;
				$return_arr['status_data'] = $status_info;
				$return_arr['count'] = $followup_count;
	        	

	        }else{
	        	$return_arr['status'] = false;
				$return_arr['message'] = "Record not found!";
				$return_arr['data'] = [];
				$return_arr['status_data'] = $status_info;
				$return_arr['count'] = $followup_count;
	        }

        }else{
        	$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
			$return_arr['status_data'] = [];
			$return_arr['count'] = 0;
        }

        
        header('Content-type: application/json');
	    echo json_encode($return_arr);
	    //http://mustafa-pc/crm/Follow_up_API/get_followup_leads?user_id=1        
    }


    public function update_lead_followup()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->update('tblleadfollowup', array('finished'=>$status,'datefinished'=>date('Y-m-d H:i:s')),array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Status Updated Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to update status";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://mustafa-pc/crm/Follow_up_API/update_lead_followup?id=6&status=1
    }



    public function add_lead_activity()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($user_id) && !empty($lead_id) && !empty($message)){
        	$ad_data = array(
                            'lead_id' => $lead_id,
                            'message' => $message,
                            'staffid' => $user_id,
                            'date' => date('Y-m-d'),
                            'datetime' => date('Y-m-d H:i:s'),
                            'priority' => 0,
                            'status' => 1
                        );

            $insert =  $this->home_model->insert('tblfollowupleadactivity',$ad_data);


            // For Tagging 
            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$lead_id."' and staff_id = '".$user_id."' and module_id = 30")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($tag_staff_ids)){
            	 $staff_ids = json_decode($tag_staff_ids);
            	 foreach ($staff_ids as $staff_id) {
                   $n_data = array(
                        'description' => 'You taged in leads activity follow up',
                        'staff_id' => $staff_id,
                        'fromuserid' => $user_id,
                        'table_id' => $lead_id,
                        'isread' => 0,
                        'module_id' => 30,
                        'link'  => "follow_up/lead_activity/".$lead_id,
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);
                    
                    //Sending Mobile Intimation
                        $token = get_staff_token($staff_id);
                        $title = 'Schach';
                        $message = 'You taged in leads activity follow up';
                        $send_intimation = sendFCM($message, $title, $token, $page = 2);
               }
            }

            if($insert == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Activity added Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to add activity";
				$return_arr['data'] = [];
        	}

	    }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);


	    //http://mustafa-pc/crm/Follow_up_API/add_lead_activity?lead_id=1&message=added by app&user_id=1&tag_staff_ids=[1,27]

	}


	public function get_lead_activity()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}

		if(!empty($lead_id)){

			if(!empty($priority) && $priority == 1){
				$activity_log = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' and priority = '1' order by id desc")->result(); 
			}else{
				if($last_id == 0){
					$activity_log = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' order by id desc LIMIT 10")->result(); 

				}else{
					$activity_log = $this->db->query("SELECT * FROM `tblfollowupleadactivity` where lead_id = '".$lead_id."' and id < '".$last_id."' order by id desc LIMIT 10")->result(); 
				}
			}


			$number_list = $this->db->query("SELECT c.phonenumber from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$lead_id."' ")->result();
            $numbers = '';
            if(!empty($number_list)){
                $i = 0;
                foreach ($number_list as $no) {
                    if($i == 0){
                        $numbers .= $no->phonenumber;
                    }else{
                        $numbers .= ','.$no->phonenumber;
                    }
                    $i++;
                }
            }



			krsort($activity_log);

			if(!empty($activity_log)){
				foreach ($activity_log as $key => $row) {


					//Getting Calls
					$from_date = $row->date;
					$to_date = '';
					$next_key = ($key+1); 
					if(!empty($activity_log[$next_key]->date)){
					  $to_date = $activity_log[$next_key]->date;
					}
					if(!empty($numbers)){
					  if($to_date != ''){
					      $call_history = $this->db->query("SELECT * from tblcalloutgoing where customer_number IN (".$numbers.") and date between '".$from_date."' and '".$to_date."'  order by id desc ")->result();
					  }else{
					      $call_history = $this->db->query("SELECT * from tblcalloutgoing where customer_number IN (".$numbers.") and date >= '".$from_date."'  order by id desc ")->result();
					  }
					}

					$arr[] = array(
						'id' => $row->id,
						'type' => '1',
						'staffid' => $row->staffid,
						'staff_name' => get_employee_name($row->staffid),
						'message' => $row->message,
						'priority' => $row->priority,
						'datetime' => _dt($row->datetime),
						'time_ago' => time_ago($row->datetime),
						'status' => $row->status,
						'customer_name' => '',
						'customer_number' => '',
						'agent_number' => '',
						'call_status' => '',
						'recording_url' => '',
						'calling_date' => ''

					);

					if(!empty($call_history)){
						foreach ($call_history as $r) {
							$customer_name = $this->db->query("SELECT c.firstname from tblcontacts as c LEFT JOIN tblenquiryclientperson as cp ON cp.contact_id = c.id where cp.enquiry_id = '".$row->lead_id."' and c.phonenumber = '".$r->customer_number."' ")->row()->firstname;
							$arr[] = array(
								'id' => $r->id,
								'type' => '2',
								'staffid' => '',
								'staff_name' => '',
								'message' => '',
								'priority' => '',
								'datetime' => '',
								'time_ago' => '',
								'status' => '',
								'customer_name' => $customer_name,
								'customer_number' => $r->customer_number,
								'agent_number' => $r->agent_number,
								'call_status' => $r->call_status,
								'recording_url' => $r->recording_url,
								'calling_date' => _d($r->created_at)

							);
						}
					}

				}

				$return_arr['status'] = true;
				$return_arr['message'] = "Success";
				$return_arr['data'] = $arr;

			}else{
				$return_arr['status'] = false;
				$return_arr['message'] = "Record Not Found!";
				$return_arr['data'] = [];
			}
			
        	

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://mustafa-pc/crm/Follow_up_API/get_lead_activity?lead_id=6&priority=0&last_id=0

	}

	public function update_lead_priority()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->update('tblfollowupleadactivity', array('priority'=>$status),array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Priority Updated Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to update Priority";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://mustafa-pc/crm/Follow_up_API/update_lead_priority?id=3&status=1
    }




    public function cut_client_conversation()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->update('tblfollowupclientactivity',array('status' => 2),array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Client Conversation Removed Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to update record";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://35.154.77.171/schach/Follow_up_API/cut_client_conversation?id=24
    }


    public function cut_lead_conversation()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->update('tblfollowupleadactivity',array('status' => 2),array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Lead Conversation Removed Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to update record";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://35.154.77.171/schach/Follow_up_API/cut_lead_conversation?id=2
    }


    public function delete_client_conversation()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->delete('tblfollowupclientactivity',array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Conversation Deleted Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to delete record";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://35.154.77.171/schach/Follow_up_API/delete_client_conversation?id=33
    }


    public function delete_lead_conversation()
    {
       $return_arr = array();

		if(!empty($_GET)){
			extract($this->input->get());
		}

		elseif(!empty($_POST)){
			extract($this->input->post());	
		}


        if(!empty($id)){

        	$update = $this->home_model->delete('tblfollowupleadactivity',array('id'=>$id));

        	if($update == true){
        		$return_arr['status'] = true;	
				$return_arr['message'] = "Conversation Deleted Successfully";
				$return_arr['data'] = [];
        	}else{
        		$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to delete record";
				$return_arr['data'] = [];
        	}

        }else{

			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}

		
		header('Content-type: application/json');
	    echo json_encode($return_arr);

	    //http://35.154.77.171/schach/Follow_up_API/delete_lead_conversation?id=2
    }


	public function get_payment_contacts(){		

		$return_arr = array();
		if(!empty($_GET)){
			extract($this->input->get());
		}
		elseif(!empty($_POST)){
			extract($this->input->post());		
		}

		if(!empty($id)){
			$contact_info = $this->db->query("SELECT * from tblcontacts  where userid = '".$id."' and phonenumber > 0 group by phonenumber")->result();
			 if(!empty($contact_info)){
                foreach ($contact_info as $key => $value) {
                	$contact_type = '--';
                    if($value->contact_type == 1){
                        $contact_type = 'OFFICE';
                    }elseif($value->contact_type == 2){
                        $contact_type = 'SITE';    
                    }

                    $designation = '';
                    if(!empty($value->designation_id)){
                    	$designation = value_by_id('tbldesignation',$value->designation_id,'designation');
                    }

                    $arr[] = array(
						'id' => $value->id,
						'contact_name' => $value->firstname,
						'mobile' => $value->phonenumber,
						'contact_type' => $contact_type,
						'designation' => $designation
					);
                }


				$return_arr['status'] = true;
				$return_arr['message'] = "Success";
				$return_arr['data'] = $arr;
            }else{
            	$return_arr['status'] = false;	
				$return_arr['message'] = "Record Not found!";
				$return_arr['data'] = [];
            }


		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = [];
		}


		header('Content-type: application/json');
	    echo json_encode($return_arr);

		//http://it-mustafa/schach/Follow_up_API/get_payment_contacts?id=2


	}
        
    /* this is for get lead list */    
    public function lead_list() {
        if(!empty($_GET)){
            extract($this->input->get());
        }
        if(!empty($_POST)){
            extract($this->input->post());	
        }
        
        $return_arr = array("status" => false, "message" => "Required Parameters are messing", "data" => [], "status_data" => []);                
        if(!empty($user_id) && !empty($lead_for)){
            $status_info = $this->db->query("SELECT `name`,`id` FROM `tblenquirytypemaster` where status = '1'  ")->result_array();
            
            $return_arr = array("status" => false, "message" => "Record not found!", "data" => [], "status_data" => $status_info);
            $where = "l.id > 0";
            if($finished != ""){
                $chk_data = $this->db->query("SELECT GROUP_CONCAT(lead_id) as leadids FROM tblleadfinished WHERE staff_id = '".$user_id."' and date = '".date("Y-m-d")."' ")->row();
                $leadids = (!empty($chk_data->leadids)) ? $chk_data->leadids : 0;
                if ($finished == 1){
                    $where = "l.id IN (".$leadids.")";
                }else{
                    $where = "l.id NOT IN (".$leadids.")";
                }
            }
            if(!empty($f_date) && !empty($t_date)){
                $where .= " and l.enquiry_date between '".db_date($f_date)."' and '".db_date($t_date)."' ";
            }else{
                $where .= " and YEAR(l.enquiry_date) = '".date('Y')."' and MONTH(l.enquiry_date) = '".date('m')."' ";
            }
            
            if(!empty($status)){
                $where .= " and l.enquiry_type_id = '".$status."'";
            }else{
               // $where .= " and l.enquiry_type_id NOT IN (6,7,11,14,15,16,17,18,19,43,39,40,41,42,44,29)";
                $where .= " and l.enquiry_type_main_id NOT IN (4,5,6)";
            }
            
            if ($lead_for == 1){
                $lead_list = $this->db->query("SELECT * from `tblleads` as l where ".$where." ORDER BY l.last_activity_date desc")->result();
            }else{
                //$where .= " and ls.type = 2 and ls.staff_id = '".$user_id."' and l.enquiry_type_id NOT IN (6,7,11,14,15,16,17,18,19,43,39,40,41,42,44,29) ";
                $where .= " and ls.type = 2 and ls.staff_id = '".$user_id."' and l.enquiry_type_main_id NOT IN (4,5,6) ";
                $lead_list = $this->db->query("SELECT l.* from `tblleads` as l LEFT JOIN tblleadassignstaff as ls ON l.id = ls.lead_id LEFT JOIN tblproductinquiry as lp ON l.id = lp.enquiry_id where ".$where." GROUP BY l.id ORDER BY l.last_activity_date desc ")->result();
            }
            if (!empty($lead_list)){
                foreach ($lead_list as $value) {
                    $client_info = $this->db->query("SELECT * FROM tblclientbranch WHERE userid = '".$value->client_branch_id."' ")->row();
                    if($value->client_branch_id > 0){
                        $company = $client_info->client_branch_name;
                    }else{
                        $company = $value->company;
                    }
                    
                    $amount = '0.00';
                    $quotation_info = $this->db->query("SELECT `total` FROM `tblproposals` WHERE total > 0 and `rel_id` = '".$value->id."' order by id desc  ")->row();
                    if(!empty($quotation_info)){
                        $amount = $quotation_info->total;
                    }
                    
                    $assign_info = $this->db->query("SELECT `staff_id` FROM tblleadassignstaff WHERE type = 2 and lead_id = '".$value->id."' ")->row();
                    $salesperson_name = (!empty($assign_info)) ? get_employee_name($assign_info->staff_id) : "--";
                    $salesperson_id = (!empty($assign_info)) ? $assign_info->staff_id : 0;
                    

                    $status = '';
                    $leadstatus = '';
                    $source = '';
                    if($value->enquiry_type_id > 0){
                    	$status = value_by_id("tblenquirytypemaster", $value->enquiry_type_id, "name");
                    }
                    if($value->source > 0){
                    	$source = value_by_id('tblleadssources',$value->source,'name');
                    }
                    if($value->process_id > 0){
                    	$leadstatus = value_by_id("tblleadprocess", $value->process_id, "name");
                    }

                    //Getting Reply status
                    $reply_status = 0;
                    $approval_info = $this->db->query("SELECT `id` FROM tblmasterapproval WHERE `status` = '0' and `module_id` = '30' and  `table_id` = '".$value->id."' ")->row();
                    if(!empty($approval_info)){
                    	$reply_status = 2;
                    }else{
                    	 $todays_reply_info = $this->db->query("SELECT `id` FROM tblfollowupleadactivity WHERE `lead_id` = '".$value->id."' and `date` = '".date('Y-m-d')."' ")->row();
                    	 if(!empty($todays_reply_info)){
                    	 	$reply_status = 1;	
                    	 }
                    }

                    $output[] = array(
                                "id" => $value->id,
                                "leadno" => $value->leadno,
                                "client_id" => $value->client_id,
                                "client_name" => $company,
                                "status" => $status,
                                "status_id" => $value->enquiry_type_id,
                                "date" => _d($value->enquiry_date),
                                "source" => $source,
                                "amount" => $amount,
                                "salesperson_name" => $salesperson_name,
                                "salesperson_id" => $salesperson_id,
                                "live_statue" => $leadstatus,
                                "reply_status" => $reply_status,
                            );
                }
                
                $return_arr = array("status" => true, "message" => "success", "data" => $output, "status_data" => $status_info);
            }
        }
        
        header('Content-type: application/json');
	echo json_encode($return_arr);
	//http://mustafa-pc/crm/Follow_up_API/lead_list?user_id=1&finished=0&lead_for=1&status=8&f_date=2021-05-18&t_date=2021-05-18  
    }    
    
    /* this is for update lead type */
    public function update_lead_type() {
        if(!empty($_GET)){
            extract($this->input->get());
        }
        if(!empty($_POST)){
            extract($this->input->post());	
        }
        
        $return_arr = array("status" => false, "message" => "Required Parameters are messing", "data" => []);                
        if(!empty($lead_id) && !empty($type)){
            $update_data = array(
                'enquiry_type_id' => $type
            );
            
            $this->home_model->update('tblleads',$update_data,array('id'=>$lead_id));
            $return_arr = array("status" => true, "message" => "Lead type update successfully", "data" => []);  
        }
        header('Content-type: application/json');
	echo json_encode($return_arr);
	//http://mustafa-pc/crm/Follow_up_API/update_lead_type?lead_id=1&type=1
    }
    
    /* this is for update lead type */
    public function leadfinished() {
        if(!empty($_GET)){
            extract($this->input->get());
        }
        if(!empty($_POST)){
            extract($this->input->post());	
        }
        
        $return_arr = array("status" => false, "message" => "Required Parameters are messing", "data" => []);                
        if(!empty($lead_id) && !empty($user_id) ){
            
            if($mark_status == 1){
                $chk_data = $this->db->query("SELECT id FROM tblleadfinished WHERE lead_id = '".$lead_id."' AND staff_id = '".$user_id."' AND date = '".date("Y-m-d")."'")->row();
                if(empty($chk_data)){
                    $data["lead_id"] = $lead_id;
                    $data["staff_id"] = $user_id;
                    $data["date"] = date("Y-m-d");
                    $data["created_at"] = date("Y-m-d H:i:s");
                    $this->home_model->insert('tblleadfinished',$data);
                }
                $message = "Lead marked successfully";
            }else{
                $this->home_model->delete('tblleadfinished',array('lead_id'=>$lead_id, 'staff_id' => $user_id, 'date'  => date("Y-m-d")));
                $message = "Lead unmarked successfully";
            }
            $return_arr = array("status" => true, "message" => $message, "data" => []);  
        }
        header('Content-type: application/json');
	echo json_encode($return_arr);
	//http://mustafa-pc/crm/Follow_up_API/leadfinished?lead_id=33&user_id=40&mark_status=1
    }
    
    public function lead_quotation_list() {
        if(!empty($_GET)){
            extract($this->input->get());
        }
        if(!empty($_POST)){
            extract($this->input->post());	
        }
        
        $return_arr = array("status" => false, "message" => "Required Parameters are messing", "data" => [], "total_amount" => 0.00);                
        if(!empty($lead_id)){
            $quotation_list = $this->db->query("SELECT * from `tblproposals` where rel_id = '".$lead_id."'  ORDER BY id desc ")->result();
            $ttl_amt = 0;
            $return_arr = array("status" => false, "message" => "Record not found", "data" => [], "total_amount" => 0.00);    
            if(!empty($quotation_list)){
                foreach ($quotation_list as $key => $value) {
                    $ttl_amt += $value->total;
                    $status = "--";
                    if ($value->status == 1) {
                        $status = _l('proposal_status_open');
                    } elseif ($value->status == 2) {
                        $status = _l('proposal_status_declined');
                    } elseif ($value->status == 3) {
                        $status = _l('proposal_status_accepted');
                    } elseif ($value->status == 4) {
                        $status = _l('proposal_status_sent');
                    } elseif ($value->status == 5) {
                        $status = _l('proposal_status_revised');
                    } elseif ($value->status == 6) {
                        $status = _l('proposal_status_draft');
                    }
                    $output[] = array(
                        "id" => $value->id,
                        "quotation_number" => format_proposal_number($value->id),
                        "customer_name" => cc($value->subject),
                        "total_tax" => $value->total_tax,
                        "date" => _d($value->date),
                        "open_till" => _d($value->open_till),
                        "status" => $status,
                        "status_id" => $value->status,
                        "total" => $value->total,
                        "pdf_url" => site_url("General_API/download_pdf/proposals/".$value->id)
                    );
                }
                $return_arr = array("status" => true, "message" => "success", "data" => $output, "total_amount" => number_format($ttl_amt, 2));   
            }
        }
        header('Content-type: application/json');
	echo json_encode($return_arr);
	//http://mustafa-pc/crm/Follow_up_API/lead_quotation_list?lead_id=30
    }
}

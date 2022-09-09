<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Expenses_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
                
		$this->load->model('expenses_model');
        $this->load->model('home_model');
		
    }
   
	public function get_expenses_master()
    {
       
	  $return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		if(empty($type_id)){
			$type_id = 0;
		}
		if(empty($designation_id)){
			$designation_id = 0;
		}

	    $travel_mode    = $this->expenses_model->get_travemode();
        $purpose_list    = $this->expenses_model->get_purpose();
        $bill_type    = $this->expenses_model->get_billtype();
        $paid_by    = $this->expenses_model->get_paidby();
		$settings = $this->expenses_model->get_settings(1);
		$tempo_info = $this->home_model->get_result('tbltempo', array('status'=>1), '');
		$type_info = $this->db->query("SELECT id,name,expense_for FROM tblexpensetype WHERE category_id = '6' and status = '1' ")->result_array();
		$subtype_info = $this->db->query("SELECT id,name FROM tblexpensetypesub WHERE status = '1' AND type_id = '".$type_id."' AND (FIND_IN_SET('".$designation_id."', designation_ids) || designation_ids = '') ")->result_array();
	  
	   if(empty($user_id)){
	   		$user_id = 0;
	   }
	  
	   if(!empty($travel_mode)){
		   foreach($travel_mode as $row){
			
			

			if($row['id'] != 8){
				$travel_array = array(
					'id' => $row['id'],
					'name' => $row['name']
				);

				$return_arr['travel_mode_list'][] = $travel_array;
			}

			if(($row['id'] == 8) && ($user_id == 1 || $user_id == 7 || $user_id == 8 || $user_id == 301 || $user_id == 296)){
				$travel_array = array(
					'id' => $row['id'],
					'name' => $row['name']
				);

				$return_arr['travel_mode_list'][] = $travel_array;
			}
			
			
			
		   }
	   }else{
		  $return_arr['travel_mode_list'] = ""; 
	   }
	   
	   
	   if(!empty($purpose_list)){
		   foreach($purpose_list as $row){
			 			
			$purpose_array = array(
				'id' => $row['id'],
				'name' => $row['name']
			);
			
			$return_arr['purpose_list'][] = $purpose_array;
		   }
	   }else{
		  $return_arr['purpose_list'] = ""; 
	   }
	   
	   
	   if(!empty($bill_type)){
		   foreach($bill_type as $row){
			 			
			$bill_array = array(
				'id' => $row['id'],
				'name' => $row['name']
			);
			
			$return_arr['bill_list'][] = $bill_array;
		   }
	   }else{
		  $return_arr['bill_list'] = ""; 
	   }
	   
	   
	   if(!empty($paid_by)){
		   foreach($paid_by as $row){
			 			
			$paid_array = array(
				'id' => $row['id'],
				'name' => $row['name']
			);
			
			$return_arr['paid_list'][] = $paid_array;
		   }
	   }else{
		  $return_arr['paid_list'] = ""; 
	   }
	   
	   
	   if(!empty($tempo_info)){
		   foreach($tempo_info as $row){
			 			
			$tempo_array = array(
				//'id' => $row['id'],
				'name' => $row->name
			);			
			$return_arr['tempo_list'][] = $tempo_array;
		   }
	   }else{
		  $return_arr['tempo_list'] = ""; 
	   }
	   
	  /*if(!empty($settings)){
			$day = $settings->last_expense_date_limit;
			$return_arr['last_day'] = $day; 
	  }else{
		  $return_arr['last_day'] = "";
	  }*/	

	  $return_arr['last_day'] = get_employee_info($user_id)->last_expense_date_limit;

	  $return_arr['expense_type'] = $type_info;

	  $return_arr['subtype_info'] = $subtype_info;
	     
	   
	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://mustafa-pc/crm/Expenses_API/get_expenses_master?user_id=1&designation_id=1&type_id=1
    }

	
public function add_request()
    {

		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($user_id) && !empty($category) && !empty($purpose) && !empty($related_to) && !empty($date)){
			
			$type_id = 0;
			$head_id = 0;
			if(!empty($typesub_id)){
				$type_info = $this->db->query("SELECT t.id,t.head_id FROM tblexpensetype as t LEFT JOIN tblexpensetypesub as st ON t.id = st.type_id where st.id = '".$typesub_id."'")->row();
				if($type_info){
					$type_id = $type_info->id;
					$head_id = $type_info->head_id;
				}
			}else{
				$type_id = get_expense_type_by_category($category);
				$typesub_id = get_expense_type_default($type_id);
			}

			

			if(empty($parent_id)){
				$parent_id = 0;
			}
			else
			{
			  $this->home_model->update('tblexpenses',array('save_status'=>$save),array('id'=>$parent_id));
			}
			$date = str_replace("/","-",$date);
			$date = date('Y-m-d',strtotime($date));
			
			
			//Hotel
			if(!empty($stay_from)){
				$stay_from = str_replace("/","-",$stay_from);
				$stay_from = date('Y-m-d H:i:s',strtotime($stay_from));
			}else{
				$stay_from = '0000-00-00';
			}
			
			if(!empty($stay_to)){
				$stay_to = str_replace("/","-",$stay_to);
				$stay_to = date('Y-m-d H:i:s',strtotime($stay_to));
			}else{
				$stay_to = '0000-00-00';
			}
			
			if(!empty($pay_date)){
				$pay_date = str_replace("/","-",$pay_date);
				$pay_date = date('Y-m-d',strtotime($pay_date));
			}else{
				$pay_date = '0000-00-00';
			}
			
			
			
			
			
			if(empty($group_ids)){
				$group_ids = '';
			}else{
				$group_ids = json_decode($group_ids);
				
				$group_ids = implode(',',$group_ids);
			}
      		
			//Hide form view which is repeated			
			/*$status = 1;
			if(empty($group_ids) && $save == 0){
				$status = 0;
			}
			
			if(!empty($group_ids) && $parent_id > 0){
				$this->home_model->update('tblexpenses',array('status'=>'1'),array('id'=>$parent_id,'parent_id'=>$parent_id));
			}*/
			
			if($repeat == 1){
				$status = 0;
			}else{
				$status = 1;
				$this->home_model->update('tblexpenses',array('status'=>'1'),array('id'=>$parent_id));
				$this->home_model->update('tblexpenses',array('status'=>'1'),array('parent_id'=>$parent_id));
			}
			


			//For Tempo
			if($category == 2){
				if($save == 1 && $parent_id > 0){
							                             
					$this->home_model->update('tblexpenses',array('amount'=>$amount,'tempo_paid_by'=>$tempo_paid_by,'tempo_bill_type'=>$tempo_bill_type,'branch_id'=>$branch_id,'paidby_employee'=>$paidby_employee),array('id'=>$parent_id));
					$this->home_model->update('tblexpenses',array('tempo_paid_by'=>$tempo_paid_by,'tempo_bill_type'=>$tempo_bill_type,'branch_id'=>$branch_id,'paidby_employee'=>$paidby_employee),array('parent_id'=>$parent_id));
					$amount = 0;
				}
			}


			if(empty($bill_party_name)){
				$bill_party_name = '';
			}


			$ad_data = array(
					'parent_id' => $parent_id,                              
					'category' => $category,                               
					'currency' => 3,                               
					'amount' => $amount,                               
					'reference_no' => $reference_no,                               
					'note' => $note,                               
					'expense_name' => $logistic_name,                               
					'date' => $date,                              
					'dateadded' => date('Y-m-d H:i:s'),                               
					'addedfrom' => $user_id,
					'related_to' => $related_to,
					'purpose' => $purpose,
					'form_destination' => $form_destination,
					'to_destination' => $to_destination,
					'travel_mode' => $travel_mode,
					'kilometer_limit' => $kilometer_limit,
					'tempo_name' => $tempo_name,
					'tempo_number' => $tempo_number,
					'tempo_driver_name' => $tempo_driver_name,
					'tempo_driver_number' => $tempo_driver_number,
					'tempo_owner' => $tempo_owner,
					'trmpo_form_destination' => $trmpo_form_destination,
					'trmpo_to_destination' => $trmpo_to_destination,
					'tempo_paid_by' => $tempo_paid_by,
					'meal_type' => $meal_type,
					'pay_for_person' => $pay_for_person,
					'hotel_name' => $hotel_name,
					'hotel_address' => $hotel_address,
					'hotel_no' => $hotel_no,
					'hotel_paid_by' => $hotel_paid_by,
					'stay_from' => $stay_from,
					'stay_to' => $stay_to,
					'stay_day' => $stay_day,
					'person_no' => $person_no,
					'pay_date' => $pay_date,
					'bill_type' => $bill_type,
					'extra_paid_by' => $extra_paid_by,
					'logistic_to_address' => $logistic_to_address,
					'logistic_from_address' => $logistic_from_address,
					'logistic_paid_by' => $logistic_paid_by,
					'logistic_from_person_name' => $logistic_from_person_name,
					'logistic_from_state' => $logistic_from_state,
					'logistic_from_city' => $logistic_from_city,
					'logistic_from_pin' => $logistic_from_pin,
					'logistic_to_person_name' => $logistic_to_person_name,
					'logistic_to_state' => $logistic_to_state,
					'logistic_to_city' => $logistic_to_city,
					'logistic_to_pin' => $logistic_to_pin,
					'logistic_from_person_no' => $logistic_from_person_no,
					'logistic_to_person_no' => $logistic_to_person_no,
					'leadid' => $leadid,
					'clientid' => $clientid,
					'newlead_company' => $newlead_company,
					'newlead_name' => $newlead_name,
					'newlead_mobile' => $newlead_mobile,
					'newlead_email' => $newlead_email,
					'expense_other' => $expense_other,
					'other_purpose' => $other_purpose,
					'group_ids' => $group_ids,
					'tempo_bill_type' => $tempo_bill_type,
					'extra_bill_type' => $extra_bill_type,
					'hotel_bill_type' => $hotel_bill_type,
					'bill_party_name' => $bill_party_name,
					'branch_id' => $branch_id,
					'paidby_employee' => $paidby_employee,
					'head_id' => $head_id,
					'type_id' => $type_id,
					'typesub_id' => $typesub_id,
					'repeat' => $repeat,
					'save_status' => $save,							
					'status' => $status
				);

			 $request_id_arr = json_decode($request_id);
			 if(!empty($request_id_arr)){
			 	$ad_data['linked_with_request'] = '1';
			 }else{
			 	$ad_data['linked_with_request'] = '0';
			 }
			
			 $id = $this->expenses_model->add($ad_data);

			 //$expense_id = $this->db->insert_id();
			 //Manage request balance amount
			 if($amount > 0){
			 	$request_id_arr = json_decode($request_id);
			 	if(!empty($request_id_arr)){
			        
			        $request_id_str = implode(',', $request_id_arr);
			        $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
			        $expense_amount = $amount;
			        if(!empty($request_info)){
			            foreach ($request_info as $row) {
			                $last_expense_amt = $expense_amount;
			                $expense_amount = ($expense_amount-$row->balance_amount);
			                if($expense_amount > 0){
			                    $log_arr = array('expense_id' => $id,'request_id' => $row->id,'amount' => $row->balance_amount);
			                    $log_amt = $row->balance_amount;
			                }else{
			                    $log_arr = array('expense_id' => $id,'request_id' => $row->id,'amount' => $last_expense_amt);
			                    $log_amt = $last_expense_amt;

			                }
			                $this->home_model->insert('tblexpense_against_request_log', $log_arr);

			                $new_balance_amt = ($row->balance_amount-$log_amt);
			                $this->home_model->update('tblrequests',array('balance_amount'=>abs($new_balance_amt)),array('id'=>$row->id));
			                if($expense_amount <= 0){
			                    break;
			                }
			            }
			        }
			    }
			 }

 
			 $expense = $this->expenses_model->get($id);
			 
			 if($expense->parent_id > 0){
					$p_id = $expense->parent_id;
				}else{
					$p_id = $id;
				}
			 
			// $result_file=handle_multi_expense_attachments($expense->id,'expense');
			 $result_file=handle_multi_expense_attachments($p_id,'expense');
			 //sending Approval
			  if($repeat == 0){
				  if($expense->parent_id > 0){
						$parent_id = $expense->parent_id;
					}else{
						$parent_id = $id;
					}
					
					if(!empty($staffid)){
					$staffid = json_decode($staffid);
					
					foreach($staffid as $singlelead){
								if($singlelead!=0)
								{
								$prdata['staff_id']=$singlelead;
								$prdata['expense_id']=$parent_id;
								$prdata['status']=1;
								$prdata['created_at'] = date("Y-m-d H:i:s");
								$prdata['updated_at'] = date("Y-m-d H:i:s");
								$this->db->insert('tblexpensesapproval',$prdata);
								
								if($save == 0)		
								{
								//Sending Mobile Intimation
								$token = get_staff_token($singlelead);
								$message = 'Expenses Send to you for Approval';
								$title = 'Schach';
								$send_intimation = sendFCM($message, $title, $token);
								
																
									$full_name = get_employee_fullname($user_id);		
									$notified_data = array(
												'description'     => 'Expenses Send to you for Approval',
												'touserid'        => $singlelead,
												'type'            => 1,
												'module_id'       => 2,
												'from_fullname'    => $full_name,
												'date'   		   => date('Y-m-d H:i:s'),
												'table_id'        => $parent_id,
												'category_id'     => $category,
												'fromuserid'      => $user_id,
												'link'            => 'expenses/list_expenses/' . $parent_id.'/approval_tab',
									);		
											
									$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);			
											
								}		
										
							}
						}
					}
			  }
			
			 
			 
			 $return_arr['status'] = TRUE;
			 
			 
			
			 
			 if($repeat == 1){
				$return_arr['message'] = 'Add New Receipt';
				if($expense->parent_id > 0){
					$data['parent_id'] = $expense->parent_id;
				}else{
					$data['parent_id'] = $id;
				}
				 $files = $this->home_model->get_result('tblexpenses', array('id'=>$data['parent_id']),  array('id','form_destination','to_destination','kilometer_limit','amount','logistic_from_address','logistic_to_address','trmpo_form_destination','trmpo_to_destination','travel_mode '),'');
         		$files2= $this->home_model->get_result('tblexpenses', array('parent_id'=>$data['parent_id']),  array('id','form_destination','to_destination','kilometer_limit','amount','logistic_from_address','logistic_to_address','trmpo_form_destination','trmpo_to_destination','travel_mode '),'');
         $check =array();
		 if(!empty($files)){
			foreach ($files as $file)
			{
				if($file->travel_mode!=null)
				{
				$mode_name= $this->home_model->get_row('tbltravelmode', array('id'=>$file->travel_mode), array('name'));

				}
				$temp_data=array( 'id'=>$file->id,'form_destination'=>$file->form_destination,'to_destination'=>$file->to_destination,'kilometer_limit'=>$file->kilometer_limit,'amount'=>$file->amount,'logistic_from_address'=>$file->logistic_from_address,'logistic_to_address'=>$file->logistic_to_address,'trmpo_form_destination'=>$file->trmpo_form_destination,'trmpo_to_destination'=>$file->trmpo_to_destination,'travel_mode'=>$file2->travel_mode,'travel_mode_name'=>$mode_name->name);
				array_push($check,$temp_data);
			}
		 }
        
		
		if(!empty($files2)){
			foreach ($files2 as $file2)
			{
				if($file2->travel_mode!=null)
				{
				$mode_name2= $this->home_model->get_row('tbltravelmode', array('id'=>$file2->travel_mode), array('name'));

				}
				$temp_data2=array( 'id'=>$file2->id,'form_destination'=>$file2->form_destination,'to_destination'=>$file2->to_destination,'kilometer_limit'=>$file2->kilometer_limit,'amount'=>$file2->amount,'logistic_from_address'=>$file2->logistic_from_address,'logistic_to_address'=>$file2->logistic_to_address,'trmpo_form_destination'=>$file2->trmpo_form_destination,'trmpo_to_destination'=>$file2->trmpo_to_destination,'travel_mode'=>$file2->travel_mode,'travel_mode_name'=>$mode_name2->name);
				array_push($check,$temp_data2);
			}
		}
       
				 $locations = $check;
				
				 
				$data['expense_info'] = $expense;
				$data['location_info'] = $locations;
			 }else{
				 $return_arr['message'] = 'Expense Added Successfully';
				 $data['parent_id'] = 0;
				 $data['expense_info'] = '';
				 $data['location_info'] = '';
			 }
			 
			 $return_arr['data'] = $data;
			 
		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = '';
		}
		
		
		 header('Content-type: application/json');
		echo json_encode($return_arr);
	}		
	public function get_client_and_lead()
    {
       
	  $return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		$from_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'from_date');
        $to_date_year = value_by_id_empty('tblfinancialyear',getCurrentFinancialYear(),'to_date');

	    $client_info = $this->home_model->get_result('tblclientbranch', array('active'=>1), '');
	   // $lead_info = $this->home_model->get_result('tblleads','', '');
	    $lead_info = $this->db->query("SELECT * FROM tblleads where enquiry_date  BETWEEN  '".$from_date_year."' and  '".$to_date_year."' ")->result();
	  
	  
	   if(!empty($client_info)){
		   foreach($client_info as $row){
			 			
			$client_array = array(
				'id' => $row->userid,
				'name' => $row->client_branch_name
			);
			
			$return_arr['client_list'][] = $client_array;
		   }
	   }else{
		  $return_arr['client_list'] = []; 
	   }
	   
	   
	  if(!empty($lead_info)){
		   foreach($lead_info as $row){

            if($row->client_branch_id > 0){
            	$client_info = $this->db->query("SELECT `client_branch_name` FROM tblclientbranch WHERE userid = '".$row->client_branch_id."' ")->row();
                $company = $client_info->client_branch_name;
            }else{
                $company = $row->company;
            }
            $lead_no = 'LEAD-'.number_series($row->id);
			 			
			$lead_array = array(
				'id' => $row->id,
				'name' => $lead_no.' ('.$company.')'
			);
			
			$return_arr['lead_list'][] = $lead_array;
		   }
	   }else{
		  $return_arr['lead_list'] = []; 
	   }
	   
	
	   
	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://bookallservices.com/schach/Expenses_API/get_client_and_lead
    }
	
	
	public function get_single_expense()
    { 
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($expense_id)){
			$expense_info = get_single_expense($expense_id);
			
			$data_arr = array();
			if(!empty($expense_info)){
				$category_name = get_expense_category($expense_info->category);
				$added_by = get_employee_fullname($expense_info->addedfrom);
				$approved_info = $this->home_model->get_row('tblexpensesapproval', array('expense_id'=>$expense_info->id,'approve_status'=>$expense_info->approved_status), '');
				if($expense_info->approved_status==0)
				{
					$approved_by='';
					$approved_date='';
					$remark='--';
					$action_taken=0;
				}
				else
				{
					$approved_by = get_employee_fullname($approved_info->staff_id);
					$approved_date = $approved_info->updated_at;
					$remark = $approved_info->approvereason;
					$action_taken=1;
				}
					$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$expense_info->id,'rel_type'=>'expense'),  array('id'),'');
					if($files_count)
					{
						$count=count($files_count);
					}
					else
					{
						$count=0;
					}
				$arr = array(
						'id' => $expense_info->id,
						'category_id' => $expense_info->category,
						'name' => $category_name,
						'added_by' => $added_by,
						//'amount' => $expense_info->amount,
						'amount' => total_expense_amount($expense_info->id),
						'date' => date('d/m/Y',strtotime($expense_info->date)),
						'submitted_date' => date('d/m/Y',strtotime($expense_info->dateadded)),
						'approved_status' => $expense_info->approved_status,
						'approved_by'=>$approved_by,
						'action_taken'=>$action_taken,
						'approved_date'=>$approved_date,
						'file_count'=>$count,
						'note'=>$expense_info->note,
						'paid_by'=>get_paid_by($expense_info->id),
						'remark'=>$remark,

					);
					
					$data_arr[] = $arr;
					$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$expense_info->id,'module_id'=>2),  array('id','readdate','touserid','isread'),'');
					$notification_read_by=array();
					/*if($get_notification_user_info)
					{
						foreach ($get_notification_user_info as $notification_user) {
							$temp_data['name'] = get_employee_fullname($notification_user->touserid);
							
							if($notification_user->isread == 1){
								$read_date = $notification_user->readdate;
							}else{
								$read_date = 'Not Yet';
							}
							
							$temp_data['read_date']=$read_date;	
							array_push($notification_read_by, $temp_data);
						}
					}*/
					
					/*echo '<pre/>';
					print_r($get_notification_user_info);
					die;*/
					if($get_notification_user_info)
					{
						foreach($get_notification_user_info as $notification_user){
							if($notification_user->isread == 1){
								$read_date = $notification_user->readdate;
							}else{
								$read_date = 'Not Yet';
							}
							
							$notification_read_by[] = array(
									'name' => get_employee_fullname($notification_user->touserid),
									'read_date' => $read_date,
							);
						}
					}
					
					$return_arr['status'] = true;	
					$return_arr['message'] = "Success";
					$return_arr['data'] = $data_arr;
					$return_arr['read_by_user']=$notification_read_by;
					
			}
			else
			{
				$return_arr['status'] = FALSE;	
				$return_arr['message'] = "No Record Found";
				$return_arr['data'] = $data_arr;
			}
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		
		//http://bookallservices.com/schach/Expenses_API/get_single_expense?expense_id=1
	}
	
	
	public function approve_expense()
    { 
	  $return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($approve_status) && !empty($remark) && !empty($user_id) && !empty($expense_id)){
				
			$ldata = array(
					'approve_status' => $approve_status,
					'approvereason' => $remark,
					'updated_at' => date('Y-m-d H:i:s'),
			);
			
			$success = $this->home_model->update('tblexpensesapproval',$ldata,array('expense_id'=>$expense_id,'staff_id'=>$user_id));
			
			$approve = $this->home_model->update('tblexpenses',array('approved_status'=>$approve_status),array('id'=>$expense_id));
			$approve_child = $this->home_model->update('tblexpenses',array('approved_status'=>$approve_status),array('parent_id'=>$expense_id));
			
			if($approve_status==1){			
				
				$description = 'Expense approve Successfully';	
			}else{
				$description = 'Expense Decline';	
			}
			
				if($approve){
					$expense_info = get_expense_info($expense_id);
					
					$token = get_staff_token($expense_info->addedfrom);
					$message = 'Expense approve Successfully';
					$title = 'Schach';
					$send_intimation = sendFCM($message, $title, $token);
					$full_name = get_employee_fullname($user_id);		
					$notified_data = array(
								'description'     => $description,
								'touserid'        => $expense_info->addedfrom,
								'fromuserid'      => $user_id,
								'link'            => 'expenses/list_expenses/' . $expense_id.'/approval_tab',
								'from_fullname'    => $full_name,
								'date'   		   => date('Y-m-d H:i:s'),
								'type'            => 1,
								'module_id'       => 2,
								'table_id'        => $expense_id,
								'category_id'     => $expense_info->category,
					);		
								
					$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);		
					$check=$this->db->last_query();
					$return_arr['status'] = true;	
					$return_arr['message'] = "Record Added Successfully";
					$return_arr['data'] = '';		
				
				}
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "Required Parameters are messing";
				$return_arr['data'] = '';
			}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		//http://bookallservices.com/schach/Expenses_API/approve_expense?user_id=2&approve_status=1&remark=Approved&expense_id=9
	}
	
public function get_all_expense_list()
    { 
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
				
		if(!empty($user_id)){
			$n_arr = array();
			$settings = $this->expenses_model->get_settings(1);
			//$day = $settings->last_expense_date_limit;
			$day = get_employee_info($user_id)->last_expense_date_limit;
			
			$date_from = date('Y-m-d',strtotime("-$day Day"));
			$date_from = strtotime($date_from);
			  
			$date_to = date('Y-m-d');  
			$date_to = strtotime($date_to); 
			  
			// Loop from the start date to end date and output all dates inbetween  
			$date_arr = array();
			for ($i=$date_from; $i<=$date_to; $i+=86400) {  
				$date_arr[] =  date("Y-m-d", $i);  
			} 
			
			if(!empty($date_arr)){
				foreach($date_arr as $date){
					$expense_list = get_expense_list_by_date($user_id,$date);
					
					$exist_info = $this->home_model->get_row('tbldailyapprovalrecord', array('staff_id'=>$user_id,'date'=>$date,'status'=>1),'');
					if(empty($exist_info)){
					if(!empty($expense_list)){
						 $arr = [];
						foreach($expense_list as $row){
							
							$category_name = get_expense_category($row->category);
							$staff_details = $this->home_model->get_result('tblexpensesapproval', array('expense_id'=>$row->id),  array('staff_id'),'');

							$staff_names = '';
							if(!empty($staff_details)){
								foreach ($staff_details  as $staffid) {
									$staff_names.=get_employee_fullname($staffid->staff_id).',';
								}
							}					
							$staff_names=substr($staff_names, 0, -1);	
							if(empty($staff_names))
							{
								$staff_names="";
							}
							$approve_info = get_expense_approval($row->id);
							if(!empty($approve_info)){
								$approve_by = get_employee_fullname($approve_info->staff_id);
							}else{
								$approve_by = '';
							}
							
							$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$row->id,'rel_type'=>'expense'),  array('id'),'');
							if($files_count)
							{
								$count=count($files_count);
							}
							else
							{
								$count=0;
							}
							$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$row->id,'module_id'=>2,'isread'=>1),  array('id','readdate','touserid'),'');
							$notification_read_by=array();
							if($get_notification_user_info)
							{
								foreach ($get_notification_user_info as $notification_user) {
									$temp_data['name'] = get_employee_fullname($notification_user->touserid);
									$temp_data['read_date']=$notification_user->readdate;	
									array_push($notification_read_by, $temp_data);
								}
							}

							$arr[] = array(
								'id' => $row->id,
								'category_id' => $row->category,
								'name' => $category_name,
								'approve_by' => $approve_by,
								'amount' => total_expense_amount($row->id),
								'approved_status'=>$row->approved_status,
								'date' => date('d/m/Y',strtotime($row->date)),
								'save_status' =>$row->save_status,
								'request_names'=>$staff_names,
								'date_added' => date('d/m/Y',strtotime($row->dateadded)),
								'file_count' =>$count,
								'read_by_user' =>$notification_read_by,
								'type_id'=>$row->type_id,
								'type_name'=> (!empty($row->type_id)) ? value_by_id('tblexpensetype',$row->type_id,'name') : '',
								'typesub_id'=>$row->typesub_id,
								'typesub_name'=> (!empty($row->typesub_id)) ? value_by_id('tblexpensetypesub',$row->typesub_id,'name') : '',
								'head_id'=>$row->head_id,
								'head_name'=> (!empty($row->head_id)) ? value_by_id('tblexpensehead',$row->head_id,'name') : '',
							);
							
							
						}
						
						$n_arr[] = array(
								'date'=> date('d-m-Y',strtotime($date)),
								'list' =>$arr
						);
						
					}
					
					}
				}
				$return_arr['status'] = true;	
				$return_arr['message'] = "Success";
				$return_arr['data'] = $n_arr;
				
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "Date is Empty";
				$return_arr['data'] = '';
			}		
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		
		//http://it-mustafa/schach/Expenses_API/get_all_expense_list?user_id=1
	}
	
public function get_expense_list()
    { 
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($user_id) && !empty($type_id)){
			if(empty($category_id)){
				$category_id = 0;
			}
			if(!isset($saved_status)){
				$saved_status = 2;
			}
			$expense_list = get_expense_list($user_id,$type_id,$category_id,$saved_status);
			
			$data_arr = array();
			if(!empty($expense_list)){
				foreach($expense_list as $row){
					
					$category_name = get_expense_category($row->category);
					$staff_details = $this->home_model->get_result('tblexpensesapproval', array('expense_id'=>$row->id),  array('staff_id'),'');

					$staff_names = '';
					if(!empty($staff_details)){
						foreach ($staff_details  as $staffid) {
							$staff_names.=get_employee_fullname($staffid->staff_id).',';
						}
					}					
					$staff_names=substr($staff_names, 0, -1);	
					if(empty($staff_names))
					{
						$staff_names="";
					}
					$approve_info = get_expense_approval($row->id);
					if(!empty($approve_info)){
						$approve_by = get_employee_fullname($approve_info->staff_id);
					}else{
						$approve_by = '';
					}
					
          $files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$row->id,'rel_type'=>'expense'),  array('id'),'');
					if($files_count)
					{
						$count=count($files_count);
					}
					else
					{
						$count=0;
					}
          $get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$row->id,'module_id'=>2,'isread'=>1),  array('id','readdate','touserid'),'');
					$notification_read_by=array();
					if($get_notification_user_info)
					{
						foreach ($get_notification_user_info as $notification_user) {
							$temp_data['name'] = get_employee_fullname($notification_user->touserid);
							$temp_data['read_date']=$notification_user->readdate;	
							array_push($notification_read_by, $temp_data);
						}
					}

					$arr = array(
						'id' => $row->id,
						'category_id' => $row->category,
						'name' => $category_name,
						'approve_by' => $approve_by,
						//'amount' => $row->amount,
						'amount' => total_expense_amount($row->id),
						'approved_status'=>$row->approved_status,
						'date' => date('d/m/Y',strtotime($row->date)),
						'save_status' =>$row->save_status,
						'request_names'=>$staff_names,
						'date_added' => date('d/m/Y',strtotime($row->dateadded)),
						'file_count' =>$count,
						'read_by_user' =>$notification_read_by,
					);
					
					
					$data_arr[] = $arr;
				}
			}
			
			
			$return_arr['status'] = true;	
			$return_arr['message'] = "Success";
			$return_arr['data'] = $data_arr;
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		
		//http://bookallservices.com/schach/Expenses_API/get_all_expense_list?user_id=1
	}	

public function get_expense_details()
    { 
		$return_arr = array();
		$info = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($id)){
			$expense = $this->expenses_model->get($id);

		
			$staff_info = $this->home_model->get_row('tblstaff', array('staffid'=>$expense->addedfrom), '');
			
			$staff_details = $this->home_model->get_result('tblexpensesapproval', array('expense_id'=>$id),  array('id','staff_id'),'');
			

					$staff_ids = '';
					foreach ($staff_details  as $staffid) {
						$staff_ids.=$staffid->staff_id.','; 
						
					}
					if(!empty($staff_ids)){						
						$staff_ids=substr($staff_ids, 0, -1);
					}
					
			$related_to = '--';
			$related_name = '--';

			$approved_info = $this->home_model->get_row('tblexpensesapproval', array('expense_id'=>$expense->id,'approve_status'=>$expense->approved_status), '');
				if($expense->approved_status==0)
				{
					$approved_by='';
					$approved_date='';
				}
				else
				{
					$approved_by = get_employee_fullname($approved_info->staff_id);
					$approved_date = $approved_info->updated_at;
				}
			if(!empty($expense->related_to)){
						
						if($expense->related_to == 1){
							$related_to = 'Customers';
							$client_info = $this->home_model->get_row('tblclientbranch', array('userid'=>$expense->clientid), '');
							if(!empty($client_info)){
								$related_name = $client_info->client_branch_name;
							}
						}elseif($expense->related_to == 2){
							$related_to = 'leads';
							$expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$expense->id), '');
							$lead_info = $this->home_model->get_row('tblclientbranch', array('userid'=>$expense_info->leadid), '');							
							if(!empty($lead_info)){
								$related_name = $lead_info->client_branch_name;
							}	
						}elseif($expense->related_to == 3){
							$related_to = 'New Leads';
							$related_name=$expense->newlead_name;
						}elseif($expense->related_to == 4){
							$related_to = 'Others';	
							$related_name = $expense->expense_other;	
						}
						
						
					}	
					
					$purpose = '';
					if(!empty($expense->purpose)){
						$purpose_info = $this->home_model->get_row('tblpurpose', array('id'=>$expense->purpose), '');
						
						if(!empty($purpose_info)){
							if($purpose_info->name == 'other'){
								if(!empty($expense->other_purpose)){
									$purpose =  $expense->other_purpose;
								}																
							}else{
								 $purpose =  $purpose_info->name;
							}
						}					
					}
			
			$exp_id = $id;
			$childexpense_info = $this->db->query("SELECT * FROM tblexpenses WHERE parent_id = '".$id."'  ")->result();
			if(!empty($childexpense_info)){
				foreach ($childexpense_info as $exp) {
					$exp_id .= ','.$exp->id;
				}
			}

			$link_request_info = $this->db->query("SELECT request_id,expense_id,amount FROM tblexpense_against_request_log WHERE expense_id IN (".$exp_id.") group by request_id order by expense_id asc ")->result();

			$request_arr = [];
			if(!empty($link_request_info)){
				foreach ($link_request_info as $req) {

					$request_category_id = value_by_id('tblrequests',$req->request_id,'category');

					$cat = get_last(get_request_category($request_category_id));	
					$request_no = 'REQ-'.get_short($cat).'-'.number_series($req->request_id);

					$request_arr[] =  array('expense_id' => $req->expense_id, 'request_id' => $req->request_id, 'request_no' => $request_no, 'amount' => $req->amount );
				}
				
			}

			if($expense->category ==1){
				$travel_mode = $this->home_model->get_row('tbltravelmode', array('id'=>$expense->travel_mode), '');
				if(!empty($travel_mode)){
					$t_mode = $travel_mode->name;
				}else{
					$t_mode = '--';
				}


				$main_receipt = array(
					'id' => $expense->id,
					'added_by' => $staff_info->firstname,
					'amount' => $expense->amount,
					'date' =>  date('d/m/Y ',strtotime($expense->date)),
					'related_to' => $related_to,
					'related_to_id'=>$expense->related_to,
					'related_name' => $related_name,
					'purpose' => $purpose,
					'purpose_id' =>$expense->purpose,
					't_mode' => $t_mode,
					'from_destination' => $expense->form_destination,
					'to_destination' => $expense->to_destination,
					'kilometer_limit' => $expense->kilometer_limit,
					'note' => $expense->note,
					'group_ids' =>$expense->group_ids,
					'staff_ids' =>$staff_ids,
					'save_status' =>$expense->save_status,
					'date_added' =>date('d/m/Y ',strtotime( $expense->dateadded)),
					'approved_by'=>$approved_by,
					'approved_date'=>$approved_date,
					'leadid'=>$expense->leadid,
					'newlead_company'=>$expense->newlead_company,
					'newlead_name'=>$expense->newlead_name,
					'newlead_mobile'=>$expense->newlead_mobile,
					'newlead_email'=>$expense->newlead_email,
					'expense_other'=>$expense->expense_other,
					'type_id'=>$expense->type_id,
					'type_name'=> (!empty($expense->type_id)) ? value_by_id('tblexpensetype',$expense->type_id,'name') : '',
					'typesub_id'=>$expense->typesub_id,
					'typesub_name'=> (!empty($expense->typesub_id)) ? value_by_id('tblexpensetypesub',$expense->typesub_id,'name') : '',
					'head_id'=>$expense->head_id,
					'head_name'=> (!empty($expense->head_id)) ? value_by_id('tblexpensehead',$expense->head_id,'name') : '',
					'request_ids'=>$request_arr,
											
				);
			}elseif($expense->category == 2){
				$main_receipt = array(
					'id' => $expense->id,
					'added_by' => $staff_info->firstname,
					'amount' => $expense->amount,
					'date' =>  date('d/m/Y ',strtotime($expense->date)),
					'related_to' => $related_to,
					'related_to_id'=>$expense->related_to,
					'related_name' => $related_name,
					'purpose' => $purpose,
					'purpose_id' =>$expense->purpose,
					'tempo_name' => $expense->tempo_name,
					'tempo_number' => $expense->tempo_number,
					'tempo_driver_name' => $expense->tempo_driver_name,
					'tempo_driver_number' => $expense->tempo_driver_number,
					'tempo_owner' => $expense->tempo_owner,
					'tempo_from_destination' => $expense->trmpo_form_destination,
					'tempo_to_destination' => $expense->trmpo_to_destination,
					'tempo_paid_by' => $expense->tempo_paid_by,
					'tempo_bill_type' => $expense->tempo_bill_type,
					'bill_party_name' => $expense->bill_party_name,
					'note' => $expense->note,
					'group_ids' =>$expense->group_ids,
					'branch_id' =>$expense->branch_id,
					'paidby_employee' =>$expense->paidby_employee,
					'staff_ids' =>$staff_ids,	
					'save_status' =>$expense->save_status,
					'date_added' => date('d/m/Y ',strtotime( $expense->dateadded)),
					'approved_by'=>$approved_by,
					'approved_date'=>$approved_date,
					'leadid'=>$expense->leadid,
					'newlead_company'=>$expense->newlead_company,
					'newlead_name'=>$expense->newlead_name,
					'newlead_mobile'=>$expense->newlead_mobile,
					'newlead_email'=>$expense->newlead_email,
					'expense_other'=>$expense->expense_other,
					'type_id'=>$expense->type_id,
					'type_name'=> (!empty($expense->type_id)) ? value_by_id('tblexpensetype',$expense->type_id,'name') : '',
					'typesub_id'=>$expense->typesub_id,
					'typesub_name'=> (!empty($expense->typesub_id)) ? value_by_id('tblexpensetypesub',$expense->typesub_id,'name') : '',
					'head_id'=>$expense->head_id,
					'head_name'=> (!empty($expense->head_id)) ? value_by_id('tblexpensehead',$expense->head_id,'name') : '',
					'request_ids'=>$request_arr,
				);
			}elseif($expense->category == 4){
				if($expense->stay_day >= 0){
					$stay_day = '--';
					if($expense->stay_day == 1){
						$stay_day = 'Morning';								
					}elseif($expense->stay_day == 2){
						$stay_day = 'Afternoon';									
					}elseif($expense->stay_day == 3){
						$stay_day = 'Evening';
					}elseif($expense->stay_day == 4){
						$stay_day = 'Night';
					}
					
				}
				
				$hotel_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$expense->hotel_paid_by), '');
				if(!empty($hotel_paid_by)){
					$h_paid_by = $hotel_paid_by->name;
				}else{
					$h_paid_by = '';
				}
				
				if($expense->stay_from > 0){
					$stay_from = date('d/m/Y ',strtotime($expense->stay_from));
				}else{
					$stay_from = '';
				}
				
				if($expense->stay_to > 0){
					$stay_to = date('d/m/Y ',strtotime($expense->stay_to));
				}else{
					$stay_to = '';
				}
				
				if($expense->pay_date > 0){
					$pay_date = date('d/m/Y',strtotime($expense->pay_date));
				}else{
					$pay_date = '';
				}
				$main_receipt = array(
					'id' => $expense->id,
					'added_by' => $staff_info->firstname,
					'amount' => $expense->amount,
					'date' =>  date('d/m/Y ',strtotime($expense->date)),
					'related_to' => $related_to,
					'related_to_id'=>$expense->related_to,
					'related_name' => $related_name,
					'purpose' => $purpose,
					'purpose_id' =>$expense->purpose,
					'hotel_name' => $expense->hotel_name,
					'hotel_address' => $expense->hotel_address,
					'hotel_no' => $expense->hotel_no,
					'hotel_bill_type' => $expense->hotel_bill_type,
					'bill_party_name' => $expense->bill_party_name,
					'stay_from' => $stay_from,
					'stay_to' => $stay_to,
					'stay_day' => $stay_day,
					'person_no' => $expense->person_no,
					'pay_date' => $pay_date,
					'hotel_paid_by' => $h_paid_by,
					'note' => $expense->note,
					'branch_id' =>$expense->branch_id,
					'paidby_employee' =>$expense->paidby_employee,
					'group_ids' =>$expense->group_ids,
					'staff_ids' =>$staff_ids,
					'save_status' =>$expense->save_status,
					'date_added' => date('d/m/Y ',strtotime( $expense->dateadded)),
					'approved_by'=>$approved_by,
					'approved_date'=>$approved_date,	
					'leadid'=>$expense->leadid,
					'newlead_company'=>$expense->newlead_company,
					'newlead_name'=>$expense->newlead_name,
					'newlead_mobile'=>$expense->newlead_mobile,
					'newlead_email'=>$expense->newlead_email,
					'expense_other'=>$expense->expense_other,
					'type_id'=>$expense->type_id,
					'type_name'=> (!empty($expense->type_id)) ? value_by_id('tblexpensetype',$expense->type_id,'name') : '',
					'typesub_id'=>$expense->typesub_id,
					'typesub_name'=> (!empty($expense->typesub_id)) ? value_by_id('tblexpensetypesub',$expense->typesub_id,'name') : '',
					'head_id'=>$expense->head_id,
					'head_name'=> (!empty($expense->head_id)) ? value_by_id('tblexpensehead',$expense->head_id,'name') : '',
					'request_ids'=>$request_arr,
				);
			}elseif($expense->category == 5){
				$logistic_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$expense->logistic_paid_by), '');
				if(!empty($logistic_paid_by)){
					$l_paid_by = $logistic_paid_by->name;
				}else{
					$l_paid_by = '--';
				}
				
				$main_receipt = array(
					'id' => $expense->id,
					'added_by' => $staff_info->firstname,
					'amount' => $expense->amount,
					'date' =>  date('d/m/Y ',strtotime($expense->date)),
					'related_to' => $related_to,
					'related_to_id'=>$expense->related_to,
					'related_name' => $related_name,
					'purpose' => $purpose,
					'purpose_id' =>$expense->purpose,
					'logistic_name' => $expense->expense_name,
					'logistic_from_person_name' => $expense->logistic_from_person_name,
					'logistic_from_person_no' => $expense->logistic_from_person_no,
					'logistic_from_address' => $expense->logistic_from_address,
					'logistic_from_state' => $expense->logistic_from_state,
					'logistic_from_city' => $expense->logistic_from_city,
					'logistic_from_pin' => $expense->logistic_from_pin,
					'logistic_to_person_name' => $expense->logistic_to_person_name,
					'logistic_to_person_no' => $expense->logistic_to_person_no,
					'logistic_to_address' => $expense->logistic_to_address,
					'logistic_to_state' => $expense->logistic_to_state,
					'logistic_to_city' => $expense->logistic_to_city,
					'logistic_to_pin' => $expense->logistic_to_pin,
					'logistic_paid_by' => $l_paid_by,
					'note' => $expense->note,
					'branch_id' =>$expense->branch_id,
					'paidby_employee' =>$expense->paidby_employee,
					'group_ids' =>$expense->group_ids,
					'staff_ids' =>$staff_ids,
					'save_status' =>$expense->save_status,
					'date_added' => date('d/m/Y ',strtotime( $expense->dateadded)),
					'approved_by'=>$approved_by,
					'approved_date'=>$approved_date,
					'leadid'=>$expense->leadid,
					'newlead_company'=>$expense->newlead_company,
					'newlead_name'=>$expense->newlead_name,
					'newlead_mobile'=>$expense->newlead_mobile,
					'newlead_email'=>$expense->newlead_email,
					'expense_other'=>$expense->expense_other,
					'type_id'=>$expense->type_id,
					'type_name'=> (!empty($expense->type_id)) ? value_by_id('tblexpensetype',$expense->type_id,'name') : '',
					'typesub_id'=>$expense->typesub_id,
					'typesub_name'=> (!empty($expense->typesub_id)) ? value_by_id('tblexpensetypesub',$expense->typesub_id,'name') : '',
					'head_id'=>$expense->head_id,
					'head_name'=> (!empty($expense->head_id)) ? value_by_id('tblexpensehead',$expense->head_id,'name') : '',	
					'request_ids'=>$request_arr,	
				);
			}elseif($expense->category == 6){
				
				
				$extra_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$expense->extra_paid_by), '');
				if(!empty($extra_paid_by)){
					$e_paid_by = $extra_paid_by->name;
				}else{
					$e_paid_by = '';
				}
				
				$bill_type = $this->home_model->get_row('tblbilltype', array('id'=>$expense->bill_type), '');
				if(!empty($bill_type)){
					$b_type = $bill_type->name;
				}else{
					$b_type = '--';
				}
					
				$main_receipt = array(
					'id' => $expense->id,
					'added_by' => $staff_info->firstname,
					'amount' => $expense->amount,
					'date' =>  date('d/m/Y ',strtotime($expense->date)),
					'related_to' => $related_to,
					'related_to_id'=>$expense->related_to,
					'related_name' => $related_name,
					'purpose' => $purpose,
					'purpose_id' =>$expense->purpose,
					'bill_type' => $b_type,				
					'bill_type_id' => $expense->bill_type,				
					'extra_paid_by' => $e_paid_by,
					'note' => $expense->note,
					'group_ids' =>$expense->group_ids,
					'extra_bill_type' =>$expense->extra_bill_type,
					'bill_party_name' =>$expense->bill_party_name,
					'branch_id' =>$expense->branch_id,
					'paidby_employee' =>$expense->paidby_employee,
					'staff_ids' =>$staff_ids,
					'save_status' =>$expense->save_status,
					'date_added' => date('d/m/Y ',strtotime( $expense->dateadded)),
					'approved_by'=>$approved_by,
					'approved_date'=>$approved_date,
					'leadid'=>$expense->leadid,
					'newlead_company'=>$expense->newlead_company,
					'newlead_name'=>$expense->newlead_name,
					'newlead_mobile'=>$expense->newlead_mobile,
					'newlead_email'=>$expense->newlead_email,
					'expense_other'=>$expense->expense_other,
					'type_id'=>$expense->type_id,
					'type_name'=> (!empty($expense->type_id)) ? value_by_id('tblexpensetype',$expense->type_id,'name') : '',
					'typesub_id'=>$expense->typesub_id,
					'typesub_name'=> (!empty($expense->typesub_id)) ? value_by_id('tblexpensetypesub',$expense->typesub_id,'name') : '',
					'head_id'=>$expense->head_id,
					'head_name'=> (!empty($expense->head_id)) ? value_by_id('tblexpensehead',$expense->head_id,'name') : '',
					'type_id'=>$expense->type_id,
					'type_name'=>value_by_id('tblexpensetype',$expense->type_id,'name'),
					'request_ids'=>$request_arr,
				);
				
				
			}elseif($expense->category == 3){
				$meal_type = '--';
				if($expense->meal_type == 1){
					$meal_type = 'Breakfast';
					
				}elseif($expense->meal_type == 2){
					$meal_type = 'Lunch';
						
				}elseif($expense->meal_type == 3){
					$meal_type = 'Dinner';
				}
        elseif($expense->meal_type == 4){
					$meal_type = 'Breakfast + Lunch';
				}
				elseif($expense->meal_type == 5){
					$meal_type = 'Lunch + Dinner';
				}
				elseif($expense->meal_type == 6){
					$meal_type = 'Breakfast + Lunch + Dinner';
				}
				
				$main_receipt = array(
					'id' => $expense->id,
					'added_by' => $staff_info->firstname,
					'amount' => $expense->amount,
					'date' =>  date('d/m/Y ',strtotime($expense->date)),
					'related_to' => $related_to,
					'related_to_id'=>$expense->related_to,
					'related_name' => $related_name,
					'purpose' => $purpose,
					'purpose_id' =>$expense->purpose,
					'meal_type' => $meal_type,
					'pay_for_person' => $expense->pay_for_person,
					'note' => $expense->note,
					'group_ids' =>$expense->group_ids,
					'staff_ids' =>$staff_ids,
					'save_status' =>$expense->save_status,
					'date_added' => date('d/m/Y ',strtotime( $expense->dateadded)),
					'approved_by'=>$approved_by,
					'approved_date'=>$approved_date,
					'leadid'=>$expense->leadid,
					'newlead_company'=>$expense->newlead_company,
					'newlead_name'=>$expense->newlead_name,
					'newlead_mobile'=>$expense->newlead_mobile,
					'newlead_email'=>$expense->newlead_email,
					'expense_other'=>$expense->expense_other,
					'type_id'=>$expense->type_id,
					'type_name'=> (!empty($expense->type_id)) ? value_by_id('tblexpensetype',$expense->type_id,'name') : '',
					'typesub_id'=>$expense->typesub_id,
					'typesub_name'=> (!empty($expense->typesub_id)) ? value_by_id('tblexpensetypesub',$expense->typesub_id,'name') : '',
					'head_id'=>$expense->head_id,
					'head_name'=> (!empty($expense->head_id)) ? value_by_id('tblexpensehead',$expense->head_id,'name') : '',
					'request_ids'=>$request_arr,
				);
			}
			
			
			
			
			
			
			//Getting Sub Expenses		
			$sub_receipt = array();
			
			if(!empty($expense)){
				$expenses_list = get_sub_expenses($expense->id);
			}
			 
			  if(!empty($expenses_list)){
				  foreach($expenses_list as $row){
					  
					   $sub_expense = $this->expenses_model->get($row->id);
			
						if($sub_expense->category ==1){
							$travel_mode = $this->home_model->get_row('tbltravelmode', array('id'=>$sub_expense->travel_mode), '');
							if(!empty($travel_mode)){
								$t_mode = $travel_mode->name;
							}else{
								$t_mode = '--';
							}
							
							$sub_receipt[] = array(
								'id' =>  $sub_expense->id, 
								'amount' => $sub_expense->amount,
								't_mode' => $t_mode,
								'from_destination' => $sub_expense->form_destination,
								'to_destination' => $sub_expense->to_destination,
								'kilometer_limit' => $sub_expense->kilometer_limit,
								'type_id'=>$sub_expense->type_id,
								'type_name'=> (!empty($sub_expense->type_id)) ? value_by_id('tblexpensetype',$sub_expense->type_id,'name') : '',
								'typesub_id'=>$sub_expense->typesub_id,
								'typesub_name'=> (!empty($sub_expense->typesub_id)) ? value_by_id('tblexpensetypesub',$sub_expense->typesub_id,'name') : '',
								'head_id'=>$sub_expense->head_id,
								'head_name'=> (!empty($sub_expense->head_id)) ? value_by_id('tblexpensehead',$sub_expense->head_id,'name') : '',								
								'approved_status' => $expense->approved_status,	
								'note' => $sub_expense->note,
							);
						}elseif($sub_expense->category == 2){
							$sub_receipt[] = array(
								'id' =>  $sub_expense->id,
								'amount' => $sub_expense->amount,
								'tempo_name' => $sub_expense->tempo_name,
								'tempo_number' => $sub_expense->tempo_number,
								'tempo_driver_name' => $sub_expense->tempo_driver_name,
								'tempo_driver_number' => $sub_expense->tempo_driver_number,
								'tempo_owner' => $sub_expense->tempo_owner,
								'tempo_from_destination' => $sub_expense->trmpo_form_destination,
								'tempo_to_destination' => $sub_expense->trmpo_to_destination,
								'type_id'=>$sub_expense->type_id,
								'type_name'=> (!empty($sub_expense->type_id)) ? value_by_id('tblexpensetype',$sub_expense->type_id,'name') : '',
								'typesub_id'=>$sub_expense->typesub_id,
								'typesub_name'=> (!empty($sub_expense->typesub_id)) ? value_by_id('tblexpensetypesub',$sub_expense->typesub_id,'name') : '',
								'head_id'=>$sub_expense->head_id,
								'head_name'=> (!empty($sub_expense->head_id)) ? value_by_id('tblexpensehead',$sub_expense->head_id,'name') : '',
								'approved_status' => $expense->approved_status,	
								'note' => $sub_expense->note,
							);
						}elseif($sub_expense->category == 4){
							if($sub_expense->stay_day > 0){
								$stay_day = '--';
								if($sub_expense->stay_day == 1){
									$stay_day = 'Morning';								
								}elseif($sub_expense->stay_day == 2){
									$stay_day = 'Afternoon';									
								}elseif($sub_expense->stay_day == 3){
									$stay_day = 'Evening';
								}elseif($sub_expense->stay_day == 4){
									$stay_day = 'Night';
								}
								
							}
							
							$hotel_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$sub_expense->hotel_paid_by), '');
							if(!empty($hotel_paid_by)){
								$h_paid_by = $hotel_paid_by->name;
							}else{
								$h_paid_by = '';
							}
							
							$sub_receipt[] = array(
								'id' =>  $sub_expense->id,
								'amount' => $sub_expense->amount,
								'hotel_name' => $sub_expense->hotel_name,
								'hotel_address' => $sub_expense->hotel_address,
								'hotel_no' => $sub_expense->hotel_no,
								'stay_from' => date('d/m/Y ',strtotime($sub_expense->stay_from)),
								'stay_to' => date('d/m/Y ',strtotime($sub_expense->stay_to)),
								'stay_day' => $stay_day,
								'person_no' => $sub_expense->person_no,
								'pay_date' => date('d/m/Y',strtotime($sub_expense->pay_date)),
								'hotel_paid_by' => $h_paid_by,
								'type_id'=>$sub_expense->type_id,
								'type_name'=> (!empty($sub_expense->type_id)) ? value_by_id('tblexpensetype',$sub_expense->type_id,'name') : '',
								'typesub_id'=>$sub_expense->typesub_id,
								'typesub_name'=> (!empty($sub_expense->typesub_id)) ? value_by_id('tblexpensetypesub',$sub_expense->typesub_id,'name') : '',
								'head_id'=>$sub_expense->head_id,
								'head_name'=> (!empty($sub_expense->head_id)) ? value_by_id('tblexpensehead',$sub_expense->head_id,'name') : '',
								'approved_status' => $expense->approved_status,		
								'note' => $sub_expense->note,
							);
						}elseif($sub_expense->category == 5){
							$logistic_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$sub_expense->logistic_paid_by), '');
							if(!empty($logistic_paid_by)){
								$l_paid_by = $logistic_paid_by->name;
							}else{
								$l_paid_by = '--';
							}
							
							$sub_receipt[] = array(
								'id' =>  $sub_expense->id,
								'amount' => $sub_expense->amount,
								'logistic_from_person_name' => $sub_expense->logistic_from_person_name,
								'logistic_from_person_no' => $sub_expense->logistic_from_person_no,
								'logistic_from_address' => $sub_expense->logistic_from_address,
								'logistic_from_state' => $sub_expense->logistic_from_state,
								'logistic_from_city' => $sub_expense->logistic_from_city,
								'logistic_from_pin' => $sub_expense->logistic_from_pin,
								'logistic_to_person_name' => $sub_expense->logistic_to_person_name,
								'logistic_to_person_no' => $sub_expense->logistic_to_person_no,
								'logistic_to_address' => $sub_expense->logistic_to_address,
								'logistic_to_state' => $sub_expense->logistic_to_state,
								'logistic_to_city' => $sub_expense->logistic_to_city,
								'logistic_to_pin' => $sub_expense->logistic_to_pin,
								'logistic_paid_by' => $l_paid_by,
								'type_id'=>$sub_expense->type_id,
								'type_name'=> (!empty($sub_expense->type_id)) ? value_by_id('tblexpensetype',$sub_expense->type_id,'name') : '',
								'typesub_id'=>$sub_expense->typesub_id,
								'typesub_name'=> (!empty($sub_expense->typesub_id)) ? value_by_id('tblexpensetypesub',$sub_expense->typesub_id,'name') : '',
								'head_id'=>$sub_expense->head_id,
								'head_name'=> (!empty($sub_expense->head_id)) ? value_by_id('tblexpensehead',$sub_expense->head_id,'name') : '',
								'approved_status' => $expense->approved_status,	
								'note' => $sub_expense->note,								
							);
						}elseif($sub_expense->category == 6){
							
							
							$extra_paid_by = $this->home_model->get_row('tblpaidby', array('id'=>$sub_expense->extra_paid_by), '');
							if(!empty($extra_paid_by)){
								$e_paid_by = $extra_paid_by->name;
							}else{
								$e_paid_by = '';
							}
							
							$bill_type = $this->home_model->get_row('tblbilltype', array('id'=>$sub_expense->bill_type), '');
							if(!empty($bill_type)){
								$b_type = $bill_type->name;
							}else{
								$b_type = '--';
							}
								
							$sub_receipt[] = array(
								'id' =>  $sub_expense->id,								
								'bill_type' => $b_type,	
								'bill_type_id' => $sub_expense->bill_type,
								'amount' => $sub_expense->amount,	
								'extra_paid_by' => $e_paid_by,
								'approved_status' => $expense->approved_status,	
								'note' => $sub_expense->note,
								'type_id'=>$sub_expense->type_id,
								'type_id'=>$sub_expense->type_id,
								'type_name'=> (!empty($sub_expense->type_id)) ? value_by_id('tblexpensetype',$sub_expense->type_id,'name') : '',
								'typesub_id'=>$sub_expense->typesub_id,
								'typesub_name'=> (!empty($sub_expense->typesub_id)) ? value_by_id('tblexpensetypesub',$sub_expense->typesub_id,'name') : '',
								'head_id'=>$sub_expense->head_id,
								'head_name'=> (!empty($sub_expense->head_id)) ? value_by_id('tblexpensehead',$sub_expense->head_id,'name') : '',
								'type_name'=>value_by_id('tblexpensetype',$sub_expense->type_id,'name'),								
							);
							
							
						}elseif($sub_expense->category == 3){
							$meal_type = '--';
							if($sub_expense->meal_type == 1){
								$meal_type = 'Breakfast';
								
							}elseif($sub_expense->meal_type == 2){
								$meal_type = 'Lunch';
									
							}elseif($sub_expense->meal_type == 3){
								$meal_type = 'Dinner';
							}
							
							$sub_receipt[] = array(	
								'id' =>  $sub_expense->id,
								'amount' => $sub_expense->amount,	
								'meal_type' => $meal_type,
								'pay_for_person' => $sub_expense->pay_for_person,
								'type_id'=>$sub_expense->type_id,
								'type_name'=> (!empty($sub_expense->type_id)) ? value_by_id('tblexpensetype',$sub_expense->type_id,'name') : '',
								'typesub_id'=>$sub_expense->typesub_id,
								'typesub_name'=> (!empty($sub_expense->typesub_id)) ? value_by_id('tblexpensetypesub',$sub_expense->typesub_id,'name') : '',
								'head_id'=>$sub_expense->head_id,
								'head_name'=> (!empty($sub_expense->head_id)) ? value_by_id('tblexpensehead',$sub_expense->head_id,'name') : '',
								'approved_status' => $expense->approved_status,
								'note' => $sub_expense->note,								
							);
						}
				  }
			  }
			
			$info['main_receipt'] = $main_receipt;
			$info['sub_receipt'] = $sub_receipt;
			
			
			$return_arr['status'] = true;	
			$return_arr['message'] = "Success";
			$return_arr['data'] = $info;
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		
		//http://bookallservices.com/schach/Expenses_API/get_expense_details?id=1
	}
 	public function edit_request()
    {

		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($user_id) && !empty($amount) && !empty($category) && !empty($purpose) && !empty($related_to) && !empty($date) && !empty($id)){

			$type_id = 0;
			$head_id = 0;
			if(!empty($typesub_id)){
				$type_info = $this->db->query("SELECT t.id,t.head_id FROM tblexpensetype as t LEFT JOIN tblexpensetypesub as st ON t.id = st.type_id where st.id = '".$typesub_id."'")->row();
				if($type_info){
					$type_id = $type_info->id;
					$head_id = $type_info->head_id;
				}
			}else{
				$type_id = get_expense_type_by_category($category);
				$typesub_id = get_expense_type_default($type_id);
			}
			
			if(empty($parent_id)){
				$parent_id = 0;
			}
			else
			{
			  $this->home_model->update('tblexpenses',array('save_status'=>$save),array('id'=>$parent_id));
			}
			$date = str_replace("/","-",$date);
			$date = date('Y-m-d',strtotime($date));
			
			
			//Hotel
			if(!empty($stay_from)){
				$stay_from = str_replace("/","-",$stay_from);
				$stay_from = date('Y-m-d H:i:s',strtotime($stay_from));
			}else{
				$stay_from = '0000-00-00';
			}
			
			if(!empty($stay_to)){
				$stay_to = str_replace("/","-",$stay_to);
				$stay_to = date('Y-m-d H:i:s',strtotime($stay_to));
			}else{
				$stay_to = '0000-00-00';
			}
			
			if(!empty($pay_date)){
				$pay_date = str_replace("/","-",$pay_date);
				$pay_date = date('Y-m-d',strtotime($pay_date));
			}else{
				$pay_date = '0000-00-00';
			}
			
			
			if(empty($group_ids)){
				$group_ids = '';
			}else{
				$group_ids = json_decode($group_ids);
				
				$group_ids = implode(',',$group_ids);
			}

			if(empty($bill_party_name)){
				$bill_party_name = '';
			}
						
			$ad_data = array(
				'parent_id' => $parent_id,                              
				'category' => $category,                               
				'currency' => 3,                               
				'amount' => $amount,                               
				'reference_no' => $reference_no,                               
				'note' => $note,                               
				'expense_name' => $logistic_name,                               
				'date' => $date,                              
				'dateadded' => date('Y-m-d H:i:s'),                               
				'addedfrom' => $user_id,
				'related_to' => $related_to,
				'purpose' => $purpose,
				'form_destination' => $form_destination,
				'to_destination' => $to_destination,
				'travel_mode' => $travel_mode,
				'kilometer_limit' => $kilometer_limit,
				'tempo_name' => $tempo_name,
				'tempo_number' => $tempo_number,
				'tempo_driver_name' => $tempo_driver_name,
				'tempo_driver_number' => $tempo_driver_number,
				'tempo_owner' => $tempo_owner,
				'trmpo_form_destination' => $trmpo_form_destination,
				'trmpo_to_destination' => $trmpo_to_destination,
				'tempo_paid_by' => $tempo_paid_by,
				'meal_type' => $meal_type,
				'pay_for_person' => $pay_for_person,
				'hotel_name' => $hotel_name,
				'hotel_address' => $hotel_address,
				'hotel_no' => $hotel_no,
				'hotel_paid_by' => $hotel_paid_by,
				'stay_from' => $stay_from,
				'stay_to' => $stay_to,
				'stay_day' => $stay_day,
				'person_no' => $person_no,
				'pay_date' => $pay_date,
				'bill_type' => $bill_type,
				'extra_paid_by' => $extra_paid_by,
				'logistic_to_address' => $logistic_to_address,
				'logistic_from_address' => $logistic_from_address,
				'logistic_paid_by' => $logistic_paid_by,
				'logistic_from_person_name' => $logistic_from_person_name,
				'logistic_from_state' => $logistic_from_state,
				'logistic_from_city' => $logistic_from_city,
				'logistic_from_pin' => $logistic_from_pin,
				'logistic_to_person_name' => $logistic_to_person_name,
				'logistic_to_state' => $logistic_to_state,
				'logistic_to_city' => $logistic_to_city,
				'logistic_to_pin' => $logistic_to_pin,
				'logistic_from_person_no' => $logistic_from_person_no,
				'logistic_to_person_no' => $logistic_to_person_no,
				'leadid' => $leadid,
				'clientid' => $clientid,
				'newlead_company' => $newlead_company,
				'newlead_name' => $newlead_name,
				'newlead_mobile' => $newlead_mobile,
				'newlead_email' => $newlead_email,
				'expense_other' => $expense_other,
				'other_purpose' => $other_purpose,
				'group_ids' => $group_ids,
				'tempo_bill_type' => $tempo_bill_type,
				'extra_bill_type' => $extra_bill_type,
				'hotel_bill_type' => $hotel_bill_type,
				'bill_party_name' => $bill_party_name,
				'branch_id' => $branch_id,
				'paidby_employee' => $paidby_employee,
				'head_id' => $head_id,
				'type_id' => $type_id,
				'typesub_id' => $typesub_id,
				'repeat' => $repeat,
				'save_status' =>$save
			);

			$request_id_arr = json_decode($request_id);
			 if(!empty($request_id_arr)){
			 	$ad_data['linked_with_request'] = '1';
			 }else{
			 	$ad_data['linked_with_request'] = '0';
			 }
			
			 $result = $this->expenses_model->update($ad_data,$id);	

			//Manage request balance amount
			$log_info = $this->db->query("SELECT * FROM tblexpense_against_request_log WHERE status = 1 and expense_id = '".$id."'  ")->result();
            if(!empty($log_info)){
                foreach ($log_info as $log) {
                    $request_info = $this->db->query("SELECT * FROM tblrequests WHERE id = '".$log->request_id."'  ")->row();
                    if(!empty($request_info)){
                        $new_balance = ($log->amount+$request_info->balance_amount);
                        $this->home_model->update('tblrequests',array('balance_amount'=>$new_balance),array('id'=>$log->request_id));
                    }
                }
            }
            $this->home_model->delete('tblexpense_against_request_log', array('expense_id'=>$id));
			
            $expense_id = $id;
             //Manage request balance amount
             if($amount > 0){
             	$request_id_arr = json_decode($request_id);
                if(!empty($request_id_arr)){
                    
                    $request_id_str = implode(',', $request_id_arr);
                    $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
                    $expense_amount = $amount;
                    if(!empty($request_info)){
                        foreach ($request_info as $row) {
                            $last_expense_amt = $expense_amount;
                            $expense_amount = ($expense_amount-$row->balance_amount);
                            if($expense_amount > 0){
                                $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $row->balance_amount);
                                $log_amt = $row->balance_amount;
                            }else{
                                $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $last_expense_amt);
                                $log_amt = $last_expense_amt;

                            }
                            $this->home_model->insert('tblexpense_against_request_log', $log_arr);

                            $new_balance_amt = ($row->balance_amount-$log_amt);
                            $this->home_model->update('tblrequests',array('balance_amount'=>abs($new_balance_amt)),array('id'=>$row->id));
                            if($expense_amount <= 0){
                                break;
                            }
                        }
                    }
                }
             }
			 
			 $expense = $this->expenses_model->get($id);
			 	
			 if($expense->parent_id > 0){
					$p_id = $expense->parent_id;
				}else{
					$p_id = $id;
				}
			 
			// $result_file=handle_multi_expense_attachments($expense->id,'expense');
			 $result_file=handle_multi_expense_attachments($p_id,'expense');	
			 	
			 //sending Approval
			  if($repeat == 0){
				  if($expense->parent_id > 0){
						$parent_id = $expense->parent_id;
					}else{
						$parent_id = $id;
					}
					


					if(!empty($staffid)){
					    $staffid = json_decode($staffid);
						/*$this->db->where('expense_id', $id);
						$this->db->delete('tblexpensesapproval');

						$this->db->where('table_id', $parent_id);
						$this->db->where('module_id',2);
						$this->db->delete('tblnotifications');*/
					foreach($staffid as $singlelead){
								if($singlelead!=0)
								{
														
								$prdata['staff_id']=$singlelead;
								$prdata['expense_id']=$id;
								$prdata['status']=1;
								$prdata['created_at'] = date("Y-m-d H:i:s");
								$prdata['updated_at'] = date("Y-m-d H:i:s");
								
								$this->db->insert('tblexpensesapproval',$prdata);
								
								if($save == 0)		
								{
									//Sending Mobile Intimation
									$token = get_staff_token($singlelead);
									$message = 'Updated Expenses Send to you for Approval';
									$title = 'Schach';
									$send_intimation = sendFCM($message, $title, $token);
								
											
									$full_name = get_employee_fullname($user_id);		
									$notified_data = array(
												'description'     => 'Expenses Send to you for Approval',
												'touserid'        => $singlelead,
												'type'            => 1,
												'module_id'       => 2,
												'from_fullname'    => $full_name,
												'date'   		   => date('Y-m-d H:i:s'),
												'table_id'        => $parent_id,
												'category_id'     => $category,
												'fromuserid'      => $user_id,
												'link'            => 'expenses/list_expenses/' . $parent_id.'/approval_tab',
									);		
											
									$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);			
											
								

								}			
										
								}
						}
					}
			  }
			
			 
			 
			 $return_arr['status'] = TRUE;
			 
			 
			
			 
				if($repeat == 1){
				$return_arr['message'] = 'Update Receipt';
				if($expense->parent_id > 0){
					$data['parent_id'] = $expense->parent_id;
				}else{
					$data['parent_id'] = $id;
				}
				  $files = $this->home_model->get_result('tblexpenses', array('id'=>$data['parent_id']),  array('id','form_destination','to_destination','kilometer_limit','amount','logistic_from_address','logistic_to_address','trmpo_form_destination','trmpo_to_destination','travel_mode '),'');
         		$files2= $this->home_model->get_result('tblexpenses', array('parent_id'=>$data['parent_id']),  array('id','form_destination','to_destination','kilometer_limit','amount','logistic_from_address','logistic_to_address','trmpo_form_destination','trmpo_to_destination','travel_mode '),'');
         $check =array();
        foreach ($files as $file)
        {
        	if($file->travel_mode!=null)
  			{
			$mode_name= $this->home_model->get_row('tbltravelmode', array('id'=>$file->travel_mode), array('name'));

  			}
  			$temp_data=array( 'id'=>$file->id,'form_destination'=>$file->form_destination,'to_destination'=>$file->to_destination,'kilometer_limit'=>$file->kilometer_limit,'amount'=>$file->amount,'logistic_from_address'=>$file->logistic_from_address,'logistic_to_address'=>$file->logistic_to_address,'trmpo_form_destination'=>$file->trmpo_form_destination,'trmpo_to_destination'=>$file->trmpo_to_destination,'travel_mode'=>$file2->travel_mode,'travel_mode_name'=>$mode_name->name);
        	array_push($check,$temp_data);
        }
        foreach ($files2 as $file2)
        {
        	if($file2->travel_mode!=null)
  			{
			$mode_name2= $this->home_model->get_row('tbltravelmode', array('id'=>$file2->travel_mode), array('name'));

  			}
  			$temp_data2=array( 'id'=>$file2->id,'form_destination'=>$file2->form_destination,'to_destination'=>$file2->to_destination,'kilometer_limit'=>$file2->kilometer_limit,'amount'=>$file2->amount,'logistic_from_address'=>$file2->logistic_from_address,'logistic_to_address'=>$file2->logistic_to_address,'trmpo_form_destination'=>$file2->trmpo_form_destination,'trmpo_to_destination'=>$file2->trmpo_to_destination,'travel_mode'=>$file2->travel_mode,'travel_mode_name'=>$mode_name2->name);
        	array_push($check,$temp_data2);
        }
				 $locations = $check;
				 
				
				 
				$data['expense_info'] = $expense;
				$data['location_info'] = $locations;
			 }else{
				 $return_arr['message'] = 'Expense Updated Successfully';
				 $data['parent_id'] = 0;
				 $data['expense_info'] = '';
				 $data['location_info'] = '';
			 }
			 
			 $return_arr['data'] = $data;
			 
		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = '';
		}
		
		
		header('Content-type: application/json');
		echo json_encode($return_arr);
	}	

	public function save_request_approve()
	{
			$return_arr = array();
			if(!empty($_GET))
			{
				extract($this->input->get());	
			}
			elseif(!empty($_POST)) 
			{
				extract($this->input->post());
			}
			

			if(!empty($ids))
			{
				$ids = json_decode($ids);

				if(empty($parent_id)){
					$parent_id = 0;
				}
				if(!empty($staffids)){
					$staffids = json_decode($staffids);
				}			
				

				if(empty($group_ids)){
					$group_ids = '';
				}else{
					$group_ids = json_decode($group_ids);
					
					$group_ids = implode(',',$group_ids);
				}

				
				foreach($ids as $id)
				{	
						
					$expense = $this->expenses_model->get($id);
					
					if($expense->parent_id > 0){
							$parent_id = $expense->parent_id;
						}else{
							$parent_id = $id;
						}
						
						
						$approve = $this->home_model->update('tblexpenses',array('save_status'=>0,'group_ids'=>$group_ids),array('id'=>$expense->id));


						foreach($staffids as $singlelead)
						{
								
							if($singlelead!=0)
							{
								
									$prdata['staff_id']=$singlelead;
									$prdata['expense_id']=$parent_id;
									$prdata['status']=1;
									$prdata['created_at'] = date("Y-m-d H:i:s");
									$prdata['updated_at'] = date("Y-m-d H:i:s");
									$test=$this->db->insert('tblexpensesapproval',$prdata);

								//Sending Mobile Intimation
								$token = get_staff_token($singlelead);
								$message = 'Expenses Send to you for Approval';
								$title = 'Schach';
								$send_intimation = sendFCM($message, $title, $token);
								
										
								$full_name = get_employee_fullname($expense->addedfrom);

								$notified_data = array(
											'description'     => 'Expenses Send to you for Approval',
											'touserid'        => $singlelead,
											'type'            => 1,
											'module_id'       => 2,
											'from_fullname'    => $full_name,
											'date'   		   => date('Y-m-d H:i:s'),
											'table_id'        => $parent_id,
											'category_id'     => $expense->category,
											'fromuserid'      => $expense->addedfrom,
											'link'            => 'expenses/list_expenses/' . $parent_id.'/approval_tab',
								);		
										
								$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);	
								$que=$this->db->last_query();

								if(!empty($insert_notified) && !empty($test) )
								{
									$return_arr['status']=TRUE;
									$return_arr['msg']="Expenses Send for Approval";
								}
								else
								{
									$return_arr['status']=FALSE;
									$return_arr['msg']="Expenses Not Send for Approval";
								}

							}
						}
					
				}
			}
			header('Content-type: application/json');
			echo json_encode($return_arr);
	}
	
public function save_all_request_approve()
	{
			
			$return_arr = array();
			if(!empty($_GET))
			{
				extract($this->input->get());	
			}
			elseif(!empty($_POST)) 
			{
				extract($this->input->post());
			}
			
			$j = 0;
			if(!empty($ids) && !empty($date_list))
			{
				
				
				
				$ids = json_decode($ids);
				
				$rep = array('[',']');
				$new_date = str_replace($rep,'', $date_list);
				$date_arr= explode(',',$new_date);
				
							
				if(empty($parent_id)){
					$parent_id = 0;
				}
				if(!empty($staffids)){
					$staffids = json_decode($staffids);
				}

					
				

				if(empty($group_ids)){
					$group_ids = '';
				}else{
					$group_ids = json_decode($group_ids);
					
					$group_ids = implode(',',$group_ids);
				}
				
				//Removing old Notification log				
				foreach($date_arr as $date){
					$date = date('Y-m-d',strtotime($date));
					$query_1 = $this->db->query("SELECT nl.* FROM tblnotifications as n LEFT JOIN tblexpensenotificationlog as nl ON n.id = nl.notification_id where n.fromuserid = '".$user_id."' and  nl.date = '".$date."' and nl.status = 1");
					if($query_1->num_rows()>0){
						$notificationlog_info = $query_1->result();	
						if(!empty($notificationlog_info)){
							foreach($notificationlog_info as $value){
								$expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$value->expense_id), '');
								if(!empty($expense_info)){
									$approved_status = $expense_info->approved_status;
									if($approved_status == 2){								
										
										//Delete Approval	
										//$delete_1 = $this->home_model->delete('tblexpensesapproval', array('expense_id'=>$row_2->expense_id));
										
										//Delete Notification Log
										
										$delete_4 = $this->home_model->delete('tblexpensenotificationlog', array('id'=>$value->id));
									}
								}
							}
						}					
					}
					
					
					$description = 'Expense Decline';				
					$delete_1 = $this->home_model->delete('tblnotifications', array('expense_date'=>$date,'description'=>$description,'touserid'=>$user_id,'type'=>1,'module_id'=>2));
				}
				
				
				foreach($ids as $id)
				{	
						
					$expense = $this->expenses_model->get($id);
					
					//Add to Daily Log
					if(!empty($user_id)){
						$add_log = $this->home_model->insert('tbldailyapprovalrecord',array('staff_id'=>$user_id,'date'=>$expense->date,'expense_id'=>$id));
					}
					
					if($expense->parent_id > 0){
							$parent_id = $expense->parent_id;
						}else{
							$parent_id = $id;
						}
						
						
						$approve = $this->home_model->update('tblexpenses',array('save_status'=>0,'group_ids'=>$group_ids),array('id'=>$expense->id));


						foreach($staffids as $singlelead)
						{
								
							if($singlelead!=0)
							{
								
									$prdata['staff_id']=$singlelead;
									$prdata['expense_id']=$parent_id;
									$prdata['status']=1;
									$prdata['created_at'] = date("Y-m-d H:i:s");
									$prdata['updated_at'] = date("Y-m-d H:i:s");
									$test=$this->db->insert('tblexpensesapproval',$prdata);

								
								$full_name = get_employee_fullname($expense->addedfrom);
								
								
								//Sending Mobile Intimation
								if($j == 0){
									$token = get_staff_token($singlelead);
									$message = 'Expenses Send to you for Approval by '.$full_name;
									$title = 'Schach';
									$send_intimation = sendFCM($message, $title, $token);
								}
								
								
								
								
								
								//New Notification Logic								
								$exist_notification = expense_notification_exist($expense->addedfrom,$singlelead,$expense->date);
								
								if(!empty($exist_notification)){
									
									$notified_data = array(											
											'date'   		  => date('Y-m-d H:i:s'),
											'table_id'        => $parent_id,
											'category_id'     => $expense->category,
											'fromuserid'      => $expense->addedfrom,
											'expense_date'    => $expense->date,
											'link'            => 'expenses/list_expenses/' . $parent_id.'/approval_tab',
										);		
										
										$add_notified = $this->home_model->update('tblnotifications', $notified_data,array('id'=>$exist_notification->id));
										
										$log_data = array(
											'notification_id' => $exist_notification->id,	
											'expense_id' => $parent_id,	
											'date' => $expense->date
										);	
										
										$insert_log = $this->home_model->insert('tblexpensenotificationlog', $log_data);
									
								}else{
									//Insert Notification
									$notified_data = array(
											'description'     => 'Expenses Send to you for Approval',
											'touserid'        => $singlelead,
											'type'            => 1,
											'module_id'       => 2,
											'from_fullname'    => $full_name,
											'date'   		   => date('Y-m-d H:i:s'),
											'table_id'        => $parent_id,
											'category_id'     => $expense->category,
											'fromuserid'      => $expense->addedfrom,
											'expense_date'      => $expense->date,
											'link'            => 'expenses/list_expenses/' . $parent_id.'/approval_tab',
										);		
										
										$add_notified = $this->home_model->insert('tblnotifications', $notified_data);
										$notification_id = $this->db->insert_id();

										$log_data = array(
											'notification_id' => $notification_id,	
											'expense_id' => $parent_id,	
											'date' => $expense->date	
										);	
									$insert_log = $this->home_model->insert('tblexpensenotificationlog', $log_data);	
								}
								
								
								
								
								
								if(!empty($add_notified) && !empty($test))
								{
									$return_arr['status']=TRUE;
									$return_arr['msg']="Expenses Send for Approval";
								}
								else
								{
									$return_arr['status']=FALSE;
									$return_arr['msg']="Expenses Not Send for Approval";
								}

							}
						}
					$j++;
				}
				
				
			
			
			}
			header('Content-type: application/json');
			echo json_encode($return_arr);
	}
	
//http://35.154.77.171/schach/Expenses_API/save_all_request_approve?staffids=[14]&group_ids[1]&user_id=1&ids=[3,4]&date_list=["20-12-2018"]	
	
public function delete_expenses()
	{
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		$result=$this->expenses_model->delete($id);

		if($result)
		{
			
			//Manage request balance amount in case of reject
			$log_info = $this->db->query("SELECT * FROM tblexpense_against_request_log WHERE status = 1 and expense_id = '".$id."'  ")->result();
			if(!empty($log_info)){
				foreach ($log_info as $log) {
					$request_info = $this->db->query("SELECT * FROM tblrequests WHERE id = '".$log->request_id."'  ")->row();
					if(!empty($request_info)){
						$new_balance = ($log->amount+$request_info->balance_amount);
						$this->home_model->update('tblrequests',array('balance_amount'=>$new_balance),array('id'=>$log->request_id));
					}
				}
			}
			//Delete log	
			$this->home_model->delete('tblexpense_against_request_log', array('expense_id'=>$id));

			$childexpense_info = $this->db->query("SELECT * FROM tblexpenses WHERE parent_id = '".$id."'  ")->result();
			if(!empty($childexpense_info)){
				foreach ($childexpense_info as $row) {
					$log_info = $this->db->query("SELECT * FROM tblexpense_against_request_log WHERE status = 1 and expense_id = '".$row->id."'  ")->result();
					if(!empty($log_info)){
						foreach ($log_info as $log) {
							$request_info = $this->db->query("SELECT * FROM tblrequests WHERE id = '".$log->request_id."'  ")->row();
							if(!empty($request_info)){
								$new_balance = ($log->amount+$request_info->balance_amount);
								$this->home_model->update('tblrequests',array('balance_amount'=>$new_balance),array('id'=>$log->request_id));
							}
						}
					}

					//Delete log	
					$this->home_model->delete('tblexpense_against_request_log', array('expense_id'=>$row->id));
				}
			}

			


			$this->db->where('table_id', $id);
			$this->db->where('module_id',2);
			$this->db->delete('tblnotifications');

			$this->db->where('parent_id', $id);
			$this->db->delete('tblexpenses');
			$return_arr['status']=TRUE;
			$return_arr['msg']="Expenses Deleted Successfully";
		}
		else
		{
			$return_arr['status']=FALSE;
			$return_arr['msg']="Expenses Not Deleted";
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);
	}
public function edit_repeat()
	{
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		if(!empty($category)  &&  !empty($id))
		{
			
			//Hotel
			if(!empty($stay_from)){
				$stay_from = date('Y-m-d H:i:s',strtotime($stay_from));
			}else{
				$stay_from = '0000-00-00';
			}
			
			if(!empty($stay_to)){
				$stay_to = date('Y-m-d H:i:s',strtotime($stay_to));
			}else{
				$stay_to = '0000-00-00';
			}
			
			if(!empty($pay_date)){
				$pay_date = date('Y-m-d',strtotime($pay_date));
			}else{
				$pay_date = '0000-00-00';
			}

			if($category ==1)
			{
				
				$ad_data = array(
								                     
								'amount' => $amount,                               
								'form_destination' => $form_destination,
								'to_destination' => $to_destination,
								'travel_mode' => $travel_mode,
								'kilometer_limit' => $kilometer_limit,
								'note' => $note,
								);
				
				 $result = $this->expenses_model->update($ad_data,$id);
			}
			elseif($category == 2)
			{
				
				$ad_data = array(
								                            
								'amount' => $amount,                               
								'tempo_name' => $tempo_name,
								'tempo_number' => $tempo_number,
								'tempo_driver_name' => $tempo_driver_name,
								'tempo_driver_number' => $tempo_driver_number,
								'tempo_owner' => $tempo_owner,
								'trmpo_form_destination' => $tempo_from_destination,
								'trmpo_to_destination' => $tempo_to_destination,
								'note' => $note,
								
							);
				$result = $this->expenses_model->update($ad_data,$id);	
			}
			elseif($category == 4)
			{
				$ad_data = array(
								                          
								'amount' => $amount,                               
								'hotel_name' => $hotel_name,
								'hotel_address' => $hotel_address,
								'hotel_no' => $hotel_no,
								'stay_from' => $stay_from,
								'stay_to' => $stay_to,
								'stay_day' => $stay_day,
								'person_no' => $person_no,
								'pay_date' => $pay_date,
								);
				$result = $this->expenses_model->update($ad_data,$id);
			
			}
			elseif($category == 5)
			{
				
				$ad_data = array(
								                           
								'amount' => $amount,                               
								'logistic_to_address' => $logistic_to_address,
								'logistic_from_address' => $logistic_from_address,
								'logistic_from_person_name' => $logistic_from_person_name,
								'logistic_from_state' => $logistic_from_state,
								'logistic_from_city' => $logistic_from_city,
								'logistic_from_pin' => $logistic_from_pin,
								'logistic_to_person_name' => $logistic_to_person_name,
								'logistic_to_state' => $logistic_to_state,
								'logistic_to_city' => $logistic_to_city,
								'logistic_to_pin' => $logistic_to_pin,
								'logistic_from_person_no' => $logistic_from_person_no,
								'logistic_to_person_no' => $logistic_to_person_no,
								'note' => $note,
								
							);
				$result = $this->expenses_model->update($ad_data,$id);
			}
			elseif($category == 6)
			{
				
				$ad_data = array(
								                             
								'amount' => $amount,                               
								'bill_type' => $bill_type,
								'extra_paid_by' => $extra_paid_by,
								);
				
				$result = $this->expenses_model->update($ad_data,$id);
			}
			elseif($category == 3)
			{
				
				$ad_data = array(
								                           
								'amount' => $amount,
								'meal_type' => $meal_type,
								'pay_for_person' => $pay_for_person,
								
							);
				$result = $this->expenses_model->update($ad_data,$id);
			}

			if($result)
			{
				$return_arr['status']=TRUE;
				$return_arr['msg']="Expense Updated Successfully";
			}
			else
			{
				$return_arr['status']=FALSE;
				$return_arr['msg']="Required Fields Are Missing";
			}
		}
		else
		{
			$return_arr['status']=FALSE;
			$return_arr['msg']="Required Fields Are Missing";
		}
		header('Content-type: application/json');
		echo json_encode($return_arr);
		// Category 1
	//http://35.154.77.171/schach/Expenses_API/edit_repeat?id=&category=&amount=&form_destination=&to_destination=&travel_mode=&kilometer_limit=

	// Category 2
	//http://35.154.77.171/schach/Expenses_API/edit_repeat?id=&category=&amount=&tempo_name=&tempo_number=&tempo_driver_name=&tempo_driver_number=&tempo_owner=

	// Category 4
	//http://35.154.77.171/schach/Expenses_API/edit_repeat?id=&category=&amount=&hotel_name=&hotel_address=&hotel_no=&hotel_paid_by=&stay_from=&stay_to=&stay_day=&person_no=&pay_date=

	// Category 5
	//http://35.154.77.171/schach/Expenses_API/edit_repeat?id=&category=&amount=&logistic_to_address=&logistic_to_person_name=&logistic_to_state=&logistic_to_city=&logistic_to_pin=&logistic_to_person_no=&logistic_from_address=&logistic_from_person_name=&logistic_from_state=&logistic_from_city=&logistic_from_pin=&logistic_paid_by=

	// Category 3
	//http://35.154.77.171/schach/Expenses_API/edit_repeat?id=&category=&amount=&meal_type=&pay_for_person=

	// Category 6
	//http://35.154.77.171/schach/Expenses_API/edit_repeat?id=&category=&amount=&bill_type=&extra_paid_by=	
	}

public function fileupload()
	{

		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		if(!empty($id))
		{
			$result=handle_multi_expense_attachments($id,$type);
			if($result)
			{
				$return_arr['status']=TRUE;
				$return_arr['msg']="Receipt Added Successfully";
				$return_arr['data']=$result;
			}
			else
			{
				$return_arr['status']=FALSE;
				$return_arr['msg']="Required Fields Are Missing";
			}
		}
		else
		{
			$return_arr['status']=FALSE;
			$return_arr['msg']="Required Fields Are Missing";
		}
		
		header('Content-type: application/json');
		echo json_encode($return_arr);
	}

	public function delete_file()
	{
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		$this->db->where('rel_id', $rel_id);
		$this->db->where('id', $id);
        $this->db->where('rel_type', 'expense');
        $file = $this->db->get('tblfiles')->row();

        if(!empty($file))
        {
	        if ($file->staffid == get_staff_user_id() || is_admin()) {
	        	if(is_dir(get_upload_path_by_type('expense') . $file->rel_id))
	        	{
	        		unlink(get_upload_path_by_type('expense') . $file->rel_id . '/' . $file->file_name);

	        		$this->db->where('rel_id', $rel_id);
	        		$this->db->where('id', $id);
	            	$this->db->delete('tblfiles');
	            
	            if ($this->db->affected_rows() > 0) {
	                $Deleted['status']=TRUE;
	                $Deleted['msg']="File Deleted Successfully";
	                
	            }

	            if (is_dir(get_upload_path_by_type('expense') . $file->rel_id)) {
	                // Check if no attachments left, so we can delete the folder also
	                $other_attachments = list_files(get_upload_path_by_type('expense') . $file->rel_id);
	                if (count($other_attachments) == 0) {
	                    // okey only index.html so we can delete the folder also
	                    delete_dir(get_upload_path_by_type('expense') . $file->rel_id);
	                }
	            }
	        		
	            }	
	                
	        }
	        else
	        {
	        	$Deleted['status'] =FALSE;
	        	$Deleted['msg']="Error";
	        }
	    }
	    else{
	    	$Deleted['status'] =FALSE;
	        $Deleted['msg']="File Not Found";
	    }
        header('Content-type: application/json');
		echo json_encode($Deleted);

            
	}
public function get_file()
	{

		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		$files = $this->home_model->get_result('tblfiles', array('rel_id'=>$id,'rel_type'=>$type),  array('id','file_name','filetype','rel_id','rel_type'),'');
		$result=array();
		foreach ($files as $file ) {
			$temp['id']=$file->id;
			$temp['rel_id']=$file->rel_id;
			$temp['file_name']=$file->file_name;
      if($file->rel_type==expense)
      {
        $file_rel_type=expenses;
      }
      else
      {
         $file_rel_type=$file->rel_type;
      }
			//$temp['file_path']=base_url('uploads/'.$file_rel_type.'s/'.$file->rel_id.'/'.$file->file_name);
			$temp['file_path']=base_url('uploads/expenses/'.$file->rel_id.'/'.$file->file_name);
			array_push($result, $temp);

			# code...
		}

    $return_arr['file_list']=$result;
    header('Content-type: application/json');
		echo json_encode($return_arr);      
    //http://35.154.77.171/schach/Expenses_API/get_file?id=3&type=expense 
	}
 public function test()
	{
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		$data['id']=$id;
		$data['parent_id']=$parent_id;
		//$locations = get_source_thread($id,$parent_id);
		 //$Check=$this->db->last_query();
		//$where="id = '".$parent_id."' or parent_id = '".$parent_id."'";
		//$this->db->select('id,form_destination,to_destination,kilometer_limit,amount');
		//$this->db->from('tblexpenses');
		//$this->db->where($where);
		//$locations=$this->db->get('tblexpenses');
   $files = $this->home_model->get_result('tblexpenses', array('id'=>$id),  array('id','form_destination','to_destination','kilometer_limit','amount'),'');
   $files2= $this->home_model->get_result('tblexpenses', array('parent_id'=>$parent_id),  array('id','form_destination','to_destination','kilometer_limit','amount'),'');
   $check =array();
  foreach ($files as $file)
  {
  
   array_push($check,$file);
  }
  foreach ($files2 as $file2)
  {
   array_push($check,$file2);
    }
		$Check['files']=$files;
    $Check['files2']=$files2;
		  header('Content-type: application/json');
		echo json_encode($check);    
	}
	
	
	
	public function get_multiple_expense()
    { 
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($notification_id)){
			
			
			//$expense_list = $this->home_model->get_result('tblexpensenotificationlog', array('notification_id'=>$notification_id,'status'=>1), '',array('id','asc'));	
			$query = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where notification_id = '".$notification_id."' and status = 1 GROUP by expense_id");
			$expense_list = $query->result();

			$notification_info = $this->home_model->get_row('tblnotifications', array('id'=>$notification_id), '');
			/*echo '<pre/>';
			print_r($expense_list);
			die;*/
			
			$data_arr = array();
			$approved_status = 0;
			if(!empty($expense_list)){
				foreach($expense_list as $row){
					$expense_id = $row->expense_id;
					
					
					
				$expense_info = get_single_expense($expense_id);			
				
				if(!empty($expense_info)){
					$category_name = get_expense_category($expense_info->category);
					$added_by = get_employee_fullname($expense_info->addedfrom);
					$approved_info = $this->home_model->get_row('tblexpensesapproval', array('expense_id'=>$expense_info->id,'approve_status'=>$expense_info->approved_status), '');
					if($expense_info->approved_status==0)
					{
						$approved_by='';
						$approved_date='';
						$remark='--';
						$action_taken=0;
					}
					else
					{
						$approved_by = get_employee_fullname($approved_info->staff_id);
						$approved_date = $approved_info->updated_at;
						$remark = $approved_info->approvereason;
						$action_taken=1;
					}
					
					
					//Checking Approved Status
					$approved_status = $expense_info->approved_status;
					
					$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$expense_info->id,'rel_type'=>'expense'),  array('id'),'');
					if($files_count){
						$count=count($files_count);
					}
					else{
						$count=0;
					}
					$arr = array(
							'id' => $expense_info->id,
							'category_id' => $expense_info->category,
							'name' => $category_name,
							'added_by' => $added_by,
							'amount' => total_expense_amount($expense_info->id),
							'date' => date('d/m/Y',strtotime($expense_info->date)),
							//'submitted_date' => date('d/m/Y',strtotime($expense_info->dateadded)),
							'submitted_date' => _d($notification_info->date),
							'approved_status' => $expense_info->approved_status,
							'approved_by'=>$approved_by,
							'action_taken'=>$action_taken,
							'approved_date'=>$approved_date,
							'file_count'=>$count,
							'note'=>$expense_info->note,
							'type_id'=>$expense_info->type_id,
							'type_name'=> (!empty($expense_info->type_id)) ? value_by_id('tblexpensetype',$expense_info->type_id,'name') : '',
							'typesub_id'=>$expense_info->typesub_id,
							'typesub_name'=> (!empty($expense_info->typesub_id)) ? value_by_id('tblexpensetypesub',$expense_info->typesub_id,'name') : '',
							'head_id'=>$expense_info->head_id,
							'head_name'=> (!empty($expense_info->head_id)) ? value_by_id('tblexpensehead',$expense_info->head_id,'name') : '',
							'paid_by'=>get_paid_by($expense_info->id),
							'remark'=>$remark,

						);
						
						$data_arr[] = $arr;
								
					}
					
					
					
				}
				
				
				//Getting Read By				
				$notification_read_by=array();
				

				//$notification_info = $this->home_model->get_row('tblnotifications', array('id'=>$notification_id), '');
			
				$query_1 = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where expense_id = '".$notification_info->table_id."' and status = 1 GROUP by notification_id");
				$notificationlog_info = $query_1->result();
				
				
				if(!empty($notificationlog_info))
				{
					foreach($notificationlog_info as $notification_user){						
						$notification_details = $this->home_model->get_row('tblnotifications', array('id'=>$notification_user->notification_id), '');
						
						
						if(!empty($notification_details)){
							if($notification_details->isread == 1){
								$read_date = $notification_details->readdate;
							}else{
								$read_date = 'Not Yet';
							}
							
							$notification_read_by[] = array(
									'name' => get_employee_fullname($notification_details->touserid),
									'read_date' => $read_date,
							);
						}
						
					}
				}
				
				/*function Even($array) 
				{ 
					// returns if the input integer is even 
					if($array%2==0) 
					   return TRUE; 
					else 
					   return FALSE;  
				} 
				  
				$array = array(12, 0, 0, 18, 27, 0, 46); 
				print_r(array_filter($array, "Even"));*/ 
				
				$return_arr['status'] = true;	
				$return_arr['message'] = "Success";
				$return_arr['data'] = $data_arr;
				$return_arr['read_by_user']=$notification_read_by;		
				$return_arr['approved_status']=$approved_status;		
				
			}else{
				$return_arr['status'] = FALSE;	
				$return_arr['message'] = "No Record Found";
				$return_arr['data'] = $data_arr;
			}
			
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		
		//35.154.77.171/schach/Expenses_API/get_multiple_expense?notification_id=14
	}
	
	
	public function get_approved_expense_list()
    { 
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());			
		}
				
		if(!empty($user_id)){
			
			if(!empty($from_date) && !empty($to_date)){
				$from_date = date('Y-m-d',strtotime($from_date));
				$to_date = date('Y-m-d',strtotime($to_date));

				$query_1 = $this->db->query("SELECT * FROM `tbldailyapprovalrecord` where staff_id = '".$user_id."' and date BETWEEN '".$from_date."' and '".$to_date."'  GROUP by date ORDER by date desc ");
			}else{
				$query_1 = $this->db->query("SELECT * FROM `tbldailyapprovalrecord` where staff_id = '".$user_id."' and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."'  GROUP by date ORDER by date desc ");
			}
			
			
			if($query_1->num_rows()>0){
				$approve_recored = $query_1->result();
				$n_arr = array();
				foreach($approve_recored as $row){
					$query_2 = $this->db->query("SELECT * FROM `tbldailyapprovalrecord` where staff_id = '".$user_id."' and date = '".$row->date."' GROUP by expense_id");					
					$approve_list = $query_2->result();
					 $arr = [];
					foreach($approve_list as $row_1){
						$query_3 = $this->db->query("SELECT `id`,`category`,`amount`,`date`,`related_to`,`purpose`,`approved_status`,`save_status`,`dateadded` FROM `tblexpenses` where id = '".$row_1->expense_id."' and parent_id = 0 and status = 1 ");
						if($query_3->num_rows()>0){
							$expense = $query_3->row();
							$category_name = get_expense_category($expense->category);
							$staff_details = $this->home_model->get_result('tblexpensesapproval', array('expense_id'=>$expense->id),  array('staff_id'),'');
							
							$staff_names = '';
							if(!empty($staff_details)){
								foreach ($staff_details  as $staffid) {
									$staff_names.=get_employee_fullname($staffid->staff_id).',';
								}
							}					
							$staff_names=substr($staff_names, 0, -1);	
							if(empty($staff_names))
							{
								$staff_names="";
							}
							$approve_info = get_expense_approval($expense->id);
							if(!empty($approve_info)){
								$approve_by = get_employee_fullname($approve_info->staff_id);
							}else{
								$approve_by = '';
							}
							
							$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$expense->id,'rel_type'=>'expense'),  array('id'),'');
							if($files_count)
							{
								$count=count($files_count);
							}
							else
							{
								$count=0;
							}
							$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$expense->id,'module_id'=>2,'isread'=>1),  array('id','readdate','touserid'),'');
							$notification_read_by=array();
							if($get_notification_user_info)
							{
								foreach ($get_notification_user_info as $notification_user) {
									$temp_data['name'] = get_employee_fullname($notification_user->touserid);
									$temp_data['read_date']=$notification_user->readdate;	
									array_push($notification_read_by, $temp_data);
								}
							}
							
							
							
							//Getting Read By				
							$notification_read_by=array();
							
						
							$query_1 = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where expense_id = '".$expense->id."' and status = 1 GROUP by notification_id");
							$notificationlog_info = $query_1->result();							
							
							if(!empty($notificationlog_info))
							{
								foreach($notificationlog_info as $notification_user){						
									$notification_details = $this->home_model->get_row('tblnotifications', array('id'=>$notification_user->notification_id), '');
									
									if(!empty($notification_details)){
										if($notification_details->isread == 1){
											$read_date = $notification_details->readdate;
										}else{
											$read_date = 'Not Yet';
										}
										
										$notification_read_by[] = array(
												'name' => get_employee_fullname($notification_details->touserid),
												'read_date' => $read_date,
										);
									}
									
								}
							}

							$arr[] = array(
								'id' => $expense->id,
								'category_id' => $expense->category,
								'name' => $category_name,
								'approve_by' => $approve_by,
								'amount' => total_expense_amount($expense->id),
								'approved_status'=>$expense->approved_status,
								'date' => date('d/m/Y',strtotime($expense->date)),
								'save_status' =>$expense->save_status,
								'request_names'=>$staff_names,
								'date_added' => date('d/m/Y',strtotime($expense->dateadded)),
								'file_count' =>$count,
								'read_by_user' =>$notification_read_by,
							);
							
						}
					}
					
					$n_arr[] = array(
							'date'=> date('d-m-Y',strtotime($row->date)),
							'list' =>$arr
					);
				}
				
				$return_arr['status'] = true;	
				$return_arr['message'] = "Success";
				$return_arr['data'] = $n_arr;
			}else{
				$return_arr['status'] = FALSE;	
				$return_arr['message'] = "No Record Found";
				$return_arr['data'] = [];
			}
			
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
	
		//35.154.77.171/schach/Expenses_API/get_approved_expense_list?user_id=1
		
	}
	
	
	public function make_edit_request()
    {
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($expense_id)){
			
			$query_1 = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where expense_id = '".$expense_id."' and status = 1 ");
			if($query_1->num_rows()>0){
				$notificationlog_info = $query_1->result();
				foreach($notificationlog_info as $row_1){
					$query_2 = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where notification_id = '".$row_1->notification_id."' and status = 1 ");
					$notificationlog_details = $query_2->result();
					
					foreach($notificationlog_details as $row_2){
						
						//Deleting All the Dates Regarding Expense
						$approvelog_info = $this->home_model->get_result('tbldailyapprovalrecord', array('expense_id'=>$row_2->expense_id,'status'=>1), '',array('id','asc'));
						if(!empty($approvelog_info)){
							foreach($approvelog_info as $row_3){
								$exp_date = $row_3->date;
								$staff_id = $row_3->staff_id;
								
								//Delete Daily Log
								$delete_2 = $this->home_model->update('tbldailyapprovalrecord',array('status'=>0), array('date'=>$exp_date,'staff_id'=>$staff_id));
							}
						}
						
						
						
						$expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$row_2->expense_id), '');
						if(!empty($expense_info)){
							$approved_status = $expense_info->approved_status;
							if($approved_status == 0){								
								
								//Update Save Status
								$update_expnese = $this->home_model->update('tblexpenses',array('save_status'=>1),array('id'=>$row_2->expense_id));	
								
								//Delete Approval	
								$delete_1 = $this->home_model->delete('tblexpensesapproval', array('expense_id'=>$row_2->expense_id));
								
								//Delete Notification
								$delete_3 = $this->home_model->delete('tblnotifications', array('id'=>$row_2->notification_id));
								//$delete_3 = $this->home_model->delete('tblnotifications', array('table_id'=>$row_2->expense_id,'module_id'=>'2'));
								
								//Delete Notification Log
								//$delete_4 = $this->home_model->delete('tblexpensenotificationlog', array('notification_id'=>$row_1->notification_id));
								//$delete_4 = $this->home_model->delete('tblexpensenotificationlog', array('expense_id'=>$row_2->expense_id));
								$delete_4 = $this->home_model->delete('tblexpensenotificationlog', array('id'=>$row_1->id));
								$delete_4 = $this->home_model->delete('tblexpensenotificationlog', array('id'=>$row_2->id));
							}
						}
						
												
					}
					
					
					
					
				}
			}
			
			if($update_expnese == true){
				$return_arr['status'] = true;	
				$return_arr['message'] = "Record Updated Successfully";
				$return_arr['data'] = '';
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "Fail To Update Record";
				$return_arr['data'] = '';
			}
			
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		
		//35.154.77.171/schach/Expenses_API/make_edit_request?expense_id=1
		
	}
	
	
	public function approve_all_expense()
    { 
	  $return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($approve_status) && !empty($remark) && !empty($user_id) && !empty($expense_id)){
			
			
			$old_notification_id = 0;
			
			$query_1 = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where expense_id = '".$expense_id."' and status = 1 ");
			if($query_1->num_rows()>0){
				$notificationlog_info = $query_1->result();
				foreach($notificationlog_info as $row_1){
					$old_notification_id = $row_1->notification_id;
					$query_2 = $this->db->query("SELECT * FROM `tblexpensenotificationlog` where notification_id = '".$row_1->notification_id."' and status = 1 ");
					$notificationlog_details = $query_2->result();
					
					foreach($notificationlog_details as $row_2){
						$exp_id = $row_2->expense_id;
						
						
						//Deleting All the Dates Regarding Expense
						$approvelog_info = $this->home_model->get_result('tbldailyapprovalrecord', array('expense_id'=>$exp_id,'status'=>1), '',array('id','asc'));
						if(!empty($approvelog_info)){
							foreach($approvelog_info as $row_3){
								$exp_date = $row_3->date;
								$staff_id = $row_3->staff_id;
								
								if($approve_status == 2){
									//Delete Daily Log
									$delete_2 = $this->home_model->update('tbldailyapprovalrecord',array('status'=>0), array('date'=>$exp_date,'staff_id'=>$staff_id));
								}
								
							}
						}
						
						//Manage request balance amount in case of reject
						if($approve_status == 2){
							$log_info = $this->db->query("SELECT * FROM tblexpense_against_request_log WHERE status = 1 and expense_id = '".$exp_id."'  ")->result();
							if(!empty($log_info)){
								foreach ($log_info as $log) {
									$request_info = $this->db->query("SELECT * FROM tblrequests WHERE id = '".$log->request_id."'  ")->row();
									if(!empty($request_info)){
										$new_balance = ($log->amount+$request_info->balance_amount);
										$this->home_model->update('tblrequests',array('balance_amount'=>$new_balance),array('id'=>$log->request_id));
									}
								}
							}
						}
						
						
						$ldata = array(
								'approve_status' => $approve_status,
								'approvereason' => $remark,
								'updated_at' => date('Y-m-d H:i:s'),
						);
						
						$success = $this->home_model->update('tblexpensesapproval',$ldata,array('expense_id'=>$exp_id,'staff_id'=>$user_id));
						
						$approve = $this->home_model->update('tblexpenses',array('approved_status'=>$approve_status),array('id'=>$exp_id));
						$approve_child = $this->home_model->update('tblexpenses',array('approved_status'=>$approve_status),array('parent_id'=>$exp_id));
					}
			
				}
				
			}
			
		
			
			if($approve_status==1){			
				
				$description = 'Expense approve Successfully';	
			}else{
				$description = 'Expense Decline';				
				//$delete_1 = $this->home_model->delete('tblnotifications', array('expense_date'=>$expense_info->date,'description'=>$description,'fromuserid'=>$user_id,'type'=>1,'module_id'=>2));
			}
			
				if($approve){
					$expense_info = get_expense_info($expense_id);
					
					$token = get_staff_token($expense_info->addedfrom);
					$title = 'Schach';
					$send_intimation = sendFCM($description, $title, $token);
					
					
					$full_name = get_employee_fullname($user_id);		
					$notified_data = array(
								'old_id'  => $old_notification_id,
								'description'     => $description,
								'touserid'        => $expense_info->addedfrom,
								'fromuserid'      => $user_id,
								'link'            => 'expenses/list_expenses/' . $expense_id.'/approval_tab',
								'from_fullname'    => $full_name,
								'date'   		   => date('Y-m-d H:i:s'),
								'type'            => 1,
								'module_id'       => 2,
								'table_id'        => $expense_id,
								'category_id'     => $expense_info->category,
								'expense_date'     => $expense_info->date,
					);		
								
					$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);		
					$check=$this->db->last_query();
					$return_arr['status'] = true;	
					$return_arr['message'] = "Record Added Successfully";
					$return_arr['data'] = '';		
				
				}
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "Required Parameters are messing";
				$return_arr['data'] = '';
			}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		//http://35.154.77.171/schach/Expenses_API/approve_all_expense?user_id=2&approve_status=1&remark=Approved&expense_id=1
	}


	public function add_mislenous()
    {
	
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
		
		if(!empty($user_id) && !empty($category) && !empty($date) && !empty($extra_info)){
		
		$data_arr = json_decode($extra_info); 
		$count = count($data_arr);

		if(empty($bill_party_name)){
			$bill_party_name = '';
		}

		$parent_id = 0;
		if($count > 1){
			foreach ($data_arr as $key => $value) {

				$type_id = 0;
				$head_id = 0;
				$typesub_id = 0;
				if(!empty($value->typesub_id)){
					$type_info = $this->db->query("SELECT t.id,t.head_id FROM tblexpensetype as t LEFT JOIN tblexpensetypesub as st ON t.id = st.type_id where st.id = '".$value->typesub_id."'")->row();
					$typesub_id = $value->typesub_id;	
					if($type_info){
						$type_id = $type_info->id;
						$head_id = $type_info->head_id;
					}
				}else{
					if(!empty($value->type_id)){
						$type_id = $value->type_id;
					}
					$typesub_id = get_expense_type_default($type_id);
				}
				
				

				$ad_data = array(
					'parent_id' => $parent_id,                              
					'category' => $category,                               
					'currency' => 3,                                           
					'date' => $date,                              
					'dateadded' => date('Y-m-d H:i:s'),                               
					'addedfrom' => $user_id,
					'related_to' => $related_to,
					'purpose' => $purpose,
					'extra_paid_by' => $extra_paid_by,					
					'leadid' => $leadid,
					'clientid' => $clientid,
					'newlead_company' => $newlead_company,
					'newlead_name' => $newlead_name,
					'newlead_mobile' => $newlead_mobile,
					'newlead_email' => $newlead_email,
					'expense_other' => $expense_other,
					'other_purpose' => $other_purpose,
					'extra_bill_type' => $extra_bill_type,
					'bill_party_name' => $bill_party_name,
					'branch_id' => $branch_id,
					'paidby_employee' => $paidby_employee,
					'repeat' => 1,
					'save_status' => $save,							
					'head_id' => $head_id,							
					'type_id' => $type_id,							
					'typesub_id' => $typesub_id,							
					'status' => 1,
					'amount' => $value->amount,
					'bill_type' => $value->bill_type,
					'note' => $value->note,
					'bill_type_other' => $value->bill_type_other,
				);

				$request_id_arr = json_decode($request_id);
				 if(!empty($request_id_arr)){
				 	$ad_data['linked_with_request'] = '1';
				 }else{
				 	$ad_data['linked_with_request'] = '0';
				 }

				$id = $this->expenses_model->add($ad_data);

				$expense_id = $id;
				//Manage request balance amount
				if($value->amount > 0){
					$request_id_arr = json_decode($request_id);
				 	if(!empty($request_id_arr)){
				        
				        $request_id_str = implode(',', $request_id_arr);
				        $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
				        $expense_amount = $value->amount;
				        if(!empty($request_info)){
				            foreach ($request_info as $row) {
				                $last_expense_amt = $expense_amount;
				                $expense_amount = ($expense_amount-$row->balance_amount);
				                if($expense_amount > 0){
				                    $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $row->balance_amount);
				                    $log_amt = $row->balance_amount;
				                }else{
				                    $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $last_expense_amt);
				                    $log_amt = $last_expense_amt;

				                }
				                $this->home_model->insert('tblexpense_against_request_log', $log_arr);

				                $new_balance_amt = ($row->balance_amount-$log_amt);
				                $this->home_model->update('tblrequests',array('balance_amount'=>abs($new_balance_amt)),array('id'=>$row->id));
				                if($expense_amount <= 0){
				                    break;
				                }
				            }
				        }
				    }
				}

				if($key == 0){
					$parent_id = $id;
				}
			}
			
		}else{
			foreach ($data_arr as $key => $value) {

				$type_id = 0;
				$head_id = 0;
				$typesub_id = 0;
				if(!empty($value->typesub_id)){
					$type_info = $this->db->query("SELECT t.id,t.head_id FROM tblexpensetype as t LEFT JOIN tblexpensetypesub as st ON t.id = st.type_id where st.id = '".$value->typesub_id."'")->row();
					$typesub_id = $value->typesub_id;	
					if($type_info){
						$type_id = $type_info->id;
						$head_id = $type_info->head_id;
					}
				}else{
					if(!empty($value->type_id)){
						$type_id = $value->type_id;
					}
					$typesub_id = get_expense_type_default($type_id);
				}

				$ad_data = array(
					'parent_id' => $parent_id,                              
					'category' => $category,                               
					'currency' => 3,                                           
					'date' => $date,                              
					'dateadded' => date('Y-m-d H:i:s'),                               
					'addedfrom' => $user_id,
					'related_to' => $related_to,
					'purpose' => $purpose,
					'extra_paid_by' => $extra_paid_by,					
					'leadid' => $leadid,
					'clientid' => $clientid,
					'newlead_company' => $newlead_company,
					'newlead_name' => $newlead_name,
					'newlead_mobile' => $newlead_mobile,
					'newlead_email' => $newlead_email,
					'expense_other' => $expense_other,
					'other_purpose' => $other_purpose,
					'extra_bill_type' => $extra_bill_type,
					'bill_party_name' => $bill_party_name,
					'branch_id' => $branch_id,
					'paidby_employee' => $paidby_employee,
					'repeat' => 0,
					'save_status' => $save,	
					'head_id' => $head_id,							
					'type_id' => $type_id,							
					'typesub_id' => $typesub_id,						
					'status' => 1,
					'amount' => $value->amount,
					'bill_type' => $value->bill_type,
					'note' => $value->note,
					'bill_type_other' => $value->bill_type_other,
				);

				$request_id_arr = json_decode($request_id);
				 if(!empty($request_id_arr)){
				 	$ad_data['linked_with_request'] = '1';
				 }else{
				 	$ad_data['linked_with_request'] = '0';
				 }

				$id = $this->expenses_model->add($ad_data);

				$expense_id = $id;
				//Manage request balance amount
				if($value->amount > 0){
					$request_id_arr = json_decode($request_id);
				 	if(!empty($request_id_arr)){
				        
				        $request_id_str = implode(',', $request_id_arr);
				        $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
				        $expense_amount = $value->amount;
				        if(!empty($request_info)){
				            foreach ($request_info as $row) {
				                $last_expense_amt = $expense_amount;
				                $expense_amount = ($expense_amount-$row->balance_amount);
				                if($expense_amount > 0){
				                    $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $row->balance_amount);
				                    $log_amt = $row->balance_amount;
				                }else{
				                    $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $last_expense_amt);
				                    $log_amt = $last_expense_amt;

				                }
				                $this->home_model->insert('tblexpense_against_request_log', $log_arr);

				                $new_balance_amt = ($row->balance_amount-$log_amt);
				                $this->home_model->update('tblrequests',array('balance_amount'=>abs($new_balance_amt)),array('id'=>$row->id));
				                if($expense_amount <= 0){
				                    break;
				                }
				            }
				        }
				    }
				}

			}
		}

			if($parent_id > 0){
				$p_id = $parent_id;
			}else{
				$p_id = $id;
			}
			$result_file=handle_multi_expense_attachments($p_id,'expense');


			 $data['parent_id'] = 0;
			 $data['expense_info'] = '';
			 $data['location_info'] = '';

			$return_arr['status'] = TRUE;
			$return_arr['message'] = 'Expense Added Successfully';
			$return_arr['data'] = $data;

		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = '';
		}
		
	
		
		header('Content-type: application/json');
		echo json_encode($return_arr);

		//http://35.154.77.171/schach//Expenses_API/add_mislenous?user_id=1&category=6&purpose=4&other_purpose=other&related_to=4&expense_other=other&date=03-01-2019&clientid=1&leadid=1&newlead_company=company&newlead_name=name&newlead_mobile=9752&newlead_email=mail@gmail.com&paidby_employee=0&branch_id=1&save=1&bill_type=2&extra_paid_by=1&extra_bill_type=1&extra_info=[{"amount":"5","bill_type":"4","note":"Test","bill_type_other":"Alu-Alu"},{"amount":"10","bill_type":"2","note":"Test","bill_type_other":""}]
	}

	public function edit_mislenous()
    {
		   	

		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}
	
		
		if(!empty($user_id) && !empty($category) && !empty($date) && !empty($extra_info)){
		
		$data_arr = json_decode($extra_info); 
		$count = count($data_arr);

		$date = str_replace("/","-",$date);
		$date = date('Y-m-d',strtotime($date));

		if(empty($bill_party_name)){
			$bill_party_name = '';
		}

		$parent_id = 0;
		if($count > 1){
			foreach ($data_arr as $key => $value) {


				$type_id = 0;
				$head_id = 0;
				$typesub_id = 0;
				if(!empty($value->typesub_id)){
					$type_info = $this->db->query("SELECT t.id,t.head_id FROM tblexpensetype as t LEFT JOIN tblexpensetypesub as st ON t.id = st.type_id where st.id = '".$value->typesub_id."'")->row();
					$typesub_id = $value->typesub_id;	
					if($type_info){
						$type_id = $type_info->id;
						$head_id = $type_info->head_id;
					}
				}else{
					if(!empty($value->type_id)){
						$type_id = $value->type_id;
					}
					$typesub_id = get_expense_type_default($type_id);
				}
								
				$ad_data = array(                            
					'category' => $category,                               
					'currency' => 3,                                           
					'date' => $date,                              
					'dateadded' => date('Y-m-d H:i:s'),                               
					'addedfrom' => $user_id,
					'related_to' => $related_to,
					'purpose' => $purpose,
					'extra_paid_by' => $extra_paid_by,					
					'leadid' => $leadid,
					'clientid' => $clientid,
					'newlead_company' => $newlead_company,
					'newlead_name' => $newlead_name,
					'newlead_mobile' => $newlead_mobile,
					'newlead_email' => $newlead_email,
					'expense_other' => $expense_other,
					'other_purpose' => $other_purpose,
					'extra_bill_type' => $extra_bill_type,
					'bill_party_name' => $bill_party_name,
					'branch_id' => $branch_id,
					'paidby_employee' => $paidby_employee,
					'repeat' => 1,
					'save_status' => $save,	
					'head_id' => $head_id,							
					'type_id' => $type_id,							
					'typesub_id' => $typesub_id,						
					'status' => 1,
					'amount' => $value->amount,
					'bill_type' => $value->bill_type,
					'note' => $value->note,
					'bill_type_other' => $value->bill_type_other,
				);
				$id = $value->id;
				$p_id = $id;

				$request_id_arr = json_decode($request_id);
				 if(!empty($request_id_arr)){
				 	$ad_data['linked_with_request'] = '1';
				 }else{
				 	$ad_data['linked_with_request'] = '0';
				 }

				$update = $this->expenses_model->update($ad_data,$id);		

				//Manage request balance amount
				$log_info = $this->db->query("SELECT * FROM tblexpense_against_request_log WHERE status = 1 and expense_id = '".$id."'  ")->result();
	            if(!empty($log_info)){
	                foreach ($log_info as $log) {
	                    $request_info = $this->db->query("SELECT * FROM tblrequests WHERE id = '".$log->request_id."'  ")->row();
	                    if(!empty($request_info)){
	                        $new_balance = ($log->amount+$request_info->balance_amount);
	                        $this->home_model->update('tblrequests',array('balance_amount'=>$new_balance),array('id'=>$log->request_id));
	                    }
	                }
	            }
	            $this->home_model->delete('tblexpense_against_request_log', array('expense_id'=>$id));

	            $expense_id = $id;
	             //Manage request balance amount
	             if($value->amount > 0){
	             	$request_id_arr = json_decode($request_id);
	                if(!empty($request_id_arr)){
	                    
	                    $request_id_str = implode(',', $request_id_arr);
	                    $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
	                    $expense_amount = $value->amount;
	                    if(!empty($request_info)){
	                        foreach ($request_info as $row) {
	                            $last_expense_amt = $expense_amount;
	                            $expense_amount = ($expense_amount-$row->balance_amount);
	                            if($expense_amount > 0){
	                                $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $row->balance_amount);
	                                $log_amt = $row->balance_amount;
	                            }else{
	                                $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $last_expense_amt);
	                                $log_amt = $last_expense_amt;

	                            }
	                            $this->home_model->insert('tblexpense_against_request_log', $log_arr);

	                            $new_balance_amt = ($row->balance_amount-$log_amt);
	                            $this->home_model->update('tblrequests',array('balance_amount'=>abs($new_balance_amt)),array('id'=>$row->id));
	                            if($expense_amount <= 0){
	                                break;
	                            }
	                        }
	                    }
	                }
	             }		
			}
			
		}else{
			foreach ($data_arr as $key => $value) {

				$type_id = 0;
				$head_id = 0;
				$typesub_id = 0;
				if(!empty($value->typesub_id)){
					$type_info = $this->db->query("SELECT t.id,t.head_id FROM tblexpensetype as t LEFT JOIN tblexpensetypesub as st ON t.id = st.type_id where st.id = '".$value->typesub_id."'")->row();
					$typesub_id = $value->typesub_id;	
					if($type_info){
						$type_id = $type_info->id;
						$head_id = $type_info->head_id;
					}
				}else{
					if(!empty($value->type_id)){
						$type_id = $value->type_id;
					}
					$typesub_id = get_expense_type_default($type_id);
				}

				$ad_data = array(                             
					'category' => $category,                               
					'currency' => 3,                                           
					'date' => $date,                              
					'dateadded' => date('Y-m-d H:i:s'),                               
					'addedfrom' => $user_id,
					'related_to' => $related_to,
					'purpose' => $purpose,
					'extra_paid_by' => $extra_paid_by,					
					'leadid' => $leadid,
					'clientid' => $clientid,
					'newlead_company' => $newlead_company,
					'newlead_name' => $newlead_name,
					'newlead_mobile' => $newlead_mobile,
					'newlead_email' => $newlead_email,
					'expense_other' => $expense_other,
					'other_purpose' => $other_purpose,
					'extra_bill_type' => $extra_bill_type,
					'bill_party_name' => $bill_party_name,
					'branch_id' => $branch_id,
					'paidby_employee' => $paidby_employee,
					'repeat' => 0,
					'save_status' => $save,	
					'head_id' => $head_id,							
					'type_id' => $type_id,							
					'typesub_id' => $typesub_id,						
					'status' => 1,
					'amount' => $value->amount,
					'bill_type' => $value->bill_type,
					'note' => $value->note,
					'bill_type_other' => $value->bill_type_other,
				);
				$id = $value->id;
				$p_id = $id;

				$request_id_arr = json_decode($request_id);
				 if(!empty($request_id_arr)){
				 	$ad_data['linked_with_request'] = '1';
				 }else{
				 	$ad_data['linked_with_request'] = '0';
				 }
				 
				$update = $this->expenses_model->update($ad_data,$id);	

				//Manage request balance amount
				$log_info = $this->db->query("SELECT * FROM tblexpense_against_request_log WHERE status = 1 and expense_id = '".$id."'  ")->result();
	            if(!empty($log_info)){
	                foreach ($log_info as $log) {
	                    $request_info = $this->db->query("SELECT * FROM tblrequests WHERE id = '".$log->request_id."'  ")->row();
	                    if(!empty($request_info)){
	                        $new_balance = ($log->amount+$request_info->balance_amount);
	                        $this->home_model->update('tblrequests',array('balance_amount'=>$new_balance),array('id'=>$log->request_id));
	                    }
	                }
	            }
	            $this->home_model->delete('tblexpense_against_request_log', array('expense_id'=>$id));

	            $expense_id = $id;
	             //Manage request balance amount
	             if($value->amount > 0){
	             	$request_id_arr = json_decode($request_id);
	                if(!empty($request_id_arr)){
	                    
	                    $request_id_str = implode(',', $request_id_arr);
	                    $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
	                    $expense_amount = $value->amount;
	                    if(!empty($request_info)){
	                        foreach ($request_info as $row) {
	                            $last_expense_amt = $expense_amount;
	                            $expense_amount = ($expense_amount-$row->balance_amount);
	                            if($expense_amount > 0){
	                                $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $row->balance_amount);
	                                $log_amt = $row->balance_amount;
	                            }else{
	                                $log_arr = array('expense_id' => $expense_id,'request_id' => $row->id,'amount' => $last_expense_amt);
	                                $log_amt = $last_expense_amt;

	                            }
	                            $this->home_model->insert('tblexpense_against_request_log', $log_arr);

	                            $new_balance_amt = ($row->balance_amount-$log_amt);
	                            $this->home_model->update('tblrequests',array('balance_amount'=>abs($new_balance_amt)),array('id'=>$row->id));
	                            if($expense_amount <= 0){
	                                break;
	                            }
	                        }
	                    }
	                }
	             }

			}
		}

			$result_file=handle_multi_expense_attachments($p_id,'expense');


			 $data['parent_id'] = 0;
			 $data['expense_info'] = '';
			 $data['location_info'] = '';

			$return_arr['status'] = TRUE;
			$return_arr['message'] = 'Expense Updated Successfully';
			$return_arr['data'] = $data;

		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = '';
		}
		
	
		
		header('Content-type: application/json');
		echo json_encode($return_arr);

		//http://35.154.77.171/schach//Expenses_API/add_mislenous?user_id=1&category=6&purpose=4&other_purpose=other&related_to=4&expense_other=other&date=03-01-2019&clientid=1&leadid=1&newlead_company=company&newlead_name=name&newlead_mobile=9752&newlead_email=mail@gmail.com&paidby_employee=0&branch_id=1&save=1&bill_type=2&extra_paid_by=1&extra_bill_type=1&extra_info=[{"amount":"5","bill_type":"4","note":"Test","bill_type_other":"Alu-Alu"},{"amount":"10","bill_type":"2","note":"Test","bill_type_other":""}]
	}


	public function change_bill_type()
    {
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		if(!empty($expense_id) && !empty($bill_type) && !empty($field) ){

			$update = $this->home_model->update('tblexpenses',array($field=>$bill_type),array('id'=>$expense_id));

			if($update){
				$return_arr['status'] = TRUE;
				$return_arr['message'] = 'Bill Type Updated Successfully';
				$return_arr['data'] = [];
			}else{
				$return_arr['status'] = FALSE;
				$return_arr['message'] = 'Some Error Occurred!';
				$return_arr['data'] = [];
			}

		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = [];
		}


		header('Content-type: application/json');
		echo json_encode($return_arr);

		//http://mustafa-pc/crm/Expenses_API/change_bill_type?expense_id=9&bill_type=2&field=hotel_bill_type
	}
	

	public function getExpenseHead()
    {
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		if(!empty($designation_id)){
			$head_info = $this->db->query("SELECT id,name FROM `tblexpensehead` WHERE status = 1 AND (FIND_IN_SET('".$designation_id."', designation_ids) || designation_ids = '')")->result();

			if(!empty($head_info)){
				$return_arr['status'] = TRUE;
				$return_arr['message'] = 'Success';
				$return_arr['data'] = $head_info;
				$return_arr['expense_chart_url'] = 'http://schachengineers.com/schacrm/Expense_Chart.pdf';
			}else{
				$return_arr['status'] = FALSE;
				$return_arr['message'] = 'Record Not Found!';
				$return_arr['data'] = [];
				$return_arr['expense_chart_url'] = 'http://schachengineers.com/schacrm/Expense_Chart.pdf';
			}
		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = [];
			$return_arr['expense_chart_url'] = 'http://schachengineers.com/schacrm/Expense_Chart.pdf';
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);
		//http://mustafa-pc/crm/Expenses_API/getExpenseHead?designation_id=1
	}


	public function getExpenseType()
    {
		$return_arr = array();
		if(!empty($_GET))
		{
			extract($this->input->get());	
		}
		elseif(!empty($_POST)) 
		{
			extract($this->input->post());
		}

		if(!empty($designation_id) && !empty($head_id)){
			$expense_type_info = $this->db->query("SELECT id, name, category_id FROM `tblexpensetype` WHERE status = 1 AND head_id = '".$head_id."' AND (FIND_IN_SET('".$designation_id."', designation_ids) || designation_ids = '')")->result();

			if(!empty($expense_type_info)){
				$return_arr['status'] = TRUE;
				$return_arr['message'] = 'Success';
				$return_arr['data'] = $expense_type_info;
			}else{
				$return_arr['status'] = FALSE;
				$return_arr['message'] = 'Record Not Found!';
				$return_arr['data'] = [];
			}
		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = [];
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);
		//http://mustafa-pc/crm/Expenses_API/getExpenseType?designation_id=1&head_id=1
	}
	
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Leaves_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
                
		$this->load->model('leaves_model');
        $this->load->model('home_model');
		
    }

    public function get_leave_categories()
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

	  $categories = $this->home_model->get_result('tblleavescategories', array('status'=>1), '',array('order','asc'));
	   if(!empty($categories)){
		   foreach($categories as $row){
			   			
			$array = array(
				'id' => $row->id,	
				'name' => $row->name,	
				'order' => $row->order,	
				'description' => $row->description
			);
			
			$return_arr['category_list'][] = $array;
		   }
	   }else{
		  $return_arr['msg'] = "Record Not Found!"; 
	   }
	   
	   
	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://bookallservices.com/schach/Leaves_API/get_leave_categories
    }
	
	
	public function add_leave()
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
		
		
		if(!empty($user_id) && !empty($category) && !empty($from_date) && !empty($to_date) && !empty($total_days)){
			
			$ad_data = array(
							'category' => $category,     
							'reason' => $reason,                               
							'from_date' => date('Y-m-d',strtotime($from_date)),                               
							'to_date' => date('Y-m-d',strtotime($to_date)),                               
							'total_days' => $total_days,                           
							'is_paid_leave' => $is_paid_leave,                           
							'dateadded' => date('Y-m-d H:i:s'),                               
							'addedfrom' => $user_id
						);
						
			$leave_id = $this->leaves_model->add($ad_data);	
			$result_file=handle_multi_expense_attachments($leave_id,'leave');		
						
				if(!empty($staffid)){
					$staffid = json_decode($staffid);
					
					foreach($staffid as $singlelead)
					{
						if($singlelead!=0)
						{						
						
						$prdata['staff_id']=$singlelead;
						$prdata['leave_id']=$leave_id;
						$prdata['status']=1;
						$prdata['created_at'] = date("Y-m-d H:i:s");
						$prdata['updated_at'] = date("Y-m-d H:i:s");
						$this->db->insert('tblleaveapproval',$prdata);
						
						//Sending Mobile Intimation
						$token = get_staff_token($singlelead);
						$message = 'Leave Request Send to you for Approval';
						$title = 'Schach';
						$send_intimation = sendFCM($message, $title, $token);
						
						
						$full_name = get_employee_fullname($user_id);		
						$notified_data = array(
									'description'     => 'Leave Request Send to you for Approval',
									'touserid'        => $singlelead,
									'fromuserid'      => $user_id,
									'from_fullname'    => $full_name,
									'date'   		   => date('Y-m-d H:i:s'),
									'module_id'        => 3,
									'type'            => 1,
									'table_id'        => $leave_id,
									'category_id'        => $category,
									'link'            => 'leaves/leave_approval/' . $leave_id.'',
						);		
								
						$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);		
						}
					}
				}
				
				
                if($leave_id) {
					$return_arr['status'] = true;	
					$return_arr['message'] = "Leave Applied Successfully";
					$return_arr['data'] = '';		
                }else{					
					$return_arr['status'] = false;	
					$return_arr['message'] = "Fail To Apply Leave";
					$return_arr['data'] = '';
				}
				
			
						
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		 
	   header('Content-type: application/json');
	   echo json_encode($return_arr);

		//http://bookallservices.com/schach/Leaves_API/add_leave?user_id=1&category=19&is_paid_leave=0&from_date=01-09-2018&to_date=01-09-2018&reason=Need&total_days=1&staffid=[2]&group_ids=[1]
	}
	
	
	public function get_user_leaves()
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
			$request_list = $this->home_model->get_result('tblleaves', array('addedfrom'=>$user_id), '',array('id','desc'));
			   if(!empty($request_list)){
				   foreach($request_list as $row){
					
					
					
					
					$array = array(
						'id' => $row->id,	
						'category' => $row->category,	
						'from_date' => date('d-m-Y',strtotime($row->from_date)),	
						'to_date' => date('d-m-Y',strtotime($row->to_date)),	
						'reason' => $row->reason,		
						'total_days' => $row->total_days,		
						'approved_status' => $row->approved_status,			
						'date' => date('d/m/Y H:i a',strtotime($row->dateadded))
					);
					
					$return_arr['leave_list'][] = $array;
				   }
			   }else{
				  $return_arr['msg'] = "Record Not Found!"; 
			   }	
		}
	   
	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://bookallservices.com/schach/Leaves_API/get_user_leaves?user_id=1
    }
	
	public function get_single_leave()
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
		
		if(!empty($leave_id)){
			$leave_info = $this->home_model->get_row('tblleaves', array('id'=>$leave_id), '');
			   if(!empty($leave_info)){
					
					
					$group_name = '';
					if(!empty($leave_info->group_ids)){
						$group_arr = explode(',',$leave_info->group_ids);
						if(!empty($group_arr)){
							
							foreach($group_arr as $group_id){
								$group_info = $this->home_model->get_row('tblstaffgroup', array('id'=>$group_id), '');	
								
								if(!empty($group_info)){
									$group_name .= $group_info->name.' ,';
								}
							}
						}
						
					}
					
					$group_name = rtrim($group_name,",");
					$array = array(
					    'id' => $leave_id,
						'category' => $leave_info->category,	
						'from_date' => date('d-m-Y',strtotime($leave_info->from_date)),	
						'to_date' => date('d-m-Y',strtotime($leave_info->to_date)),	
						'reason' => $leave_info->reason,		
						'total_days' => $leave_info->total_days,		
						'approved_status' => $leave_info->approved_status,			
						'approved_remark' => $leave_info->approved_remark,	
						'approved_date' => date('d-m-Y',strtotime($leave_info->approved_date)),		
						'date' => date('d/m/Y H:i a',strtotime($leave_info->dateadded))
					);
					
					$return_arr['leave_info'] = $array;
				 
			   }else{
				  $return_arr['msg'] = "Record Not Found!"; 
			   }	
		}
	   
	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://bookallservices.com/schach/Leaves_API/get_single_leave?leave_id=1
    }
	
	
	
	public function approve_leave()
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
		if(!empty($approve_status) && !empty($remark) && !empty($user_id) && !empty($leave_id)){
			$ldata = array(
							'approve_status' => $approve_status,
							'approvereason' => $remark,
							'updated_at' => date('Y-m-d H:i:s')
					);
					
					$success = $this->home_model->update('tblleaveapproval',$ldata,array('leave_id'=>$leave_id,'staff_id'=>$user_id));
				
					
					$update_data = array(
							'approved_status' => $approve_status,
							'approved_remark' => $remark,
							'approved_date' => date('Y-m-d')
					);
					
					$update_request = $this->home_model->update('tblleaves',$update_data,array('id'=>$leave_id));
					
					if($update_request){

						
						if($approve_status==1){
							$description = 'Leave Approve Successfully';	
						}else{
							$description = 'Leave Decline';	
						}
					
					$request_info = get_leave_info($leave_id);
					
					 	
						$full_name = get_employee_fullname($user_id);		
						$notified_data = array(
									'description'     => $description,
									'touserid'        => $request_info->addedfrom,
									'fromuserid'      => $user_id,
									'from_fullname'    => $full_name,
									'date'   		   => date('Y-m-d H:i:s'),
									'link'            => 'leaves/leave/'.$leave_id,
						);		
								
						$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);	
						
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
		//http://bookallservices.com/schach/Leaves_API/approve_leave?user_id=1&approve_status=1&remark=Approved&leave_id=5
	}
	
	
	public function user_leave_validate()
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
		
		if(!empty($from_date) && !empty($category) && !empty($user_id)){
			$date_arr = explode('-',$from_date);
			$month = $date_arr[1];			
			$year = $date_arr[2];
			
			 $check = leave_validate($user_id,$category,$month,$year);
			
			$return_arr['status'] = true;	
			$return_arr['message'] = "Success";
			$return_arr['data'] = $check;
			
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}
		
		header('Content-type: application/json');
	    echo json_encode($return_arr);
		//http://bookallservices.com/schach/Leaves_API/user_leave_validate?user_id=1&from_date=31-08-2018&category=18
	}
}

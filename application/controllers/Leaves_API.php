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

		if(empty($user_id)){
			$user_id = 0;
		}

	 // $categories = $this->home_model->get_result('tblleavescategories', array('status'=>1), '',array('order','asc'));

	  //$paid_categories = $this->db->query("SELECT * FROM `tblleavescategories` WHERE status = 1 and id != 4 ")->result();
	  $paid_categories = $this->db->query("SELECT * FROM `tblleavescategories` WHERE status = 1 ")->result();
	  $unpaid_categories = $this->db->query("SELECT * FROM `tblleavescategories` WHERE id IN (4,5) ")->result();

	  $check_provisional = get_provisional_time($user_id);
	  $staff_type = get_employee_info($user_id)->staff_type_id;

		if($check_provisional != 1 || $staff_type == 2){
			
		   if(!empty($unpaid_categories)){
			   foreach($unpaid_categories as $row){		   			

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

		}else{
		  if(!empty($paid_categories)){
			   foreach($paid_categories as $row){	


			  	//Checking available leave counts
			  	$category_info = $this->db->query("SELECT * FROM `tblleavesettings` WHERE category_id = '".$row->id."' ")->row(); 	

			  	$leave_count = $category_info->leave_count;	
				$taken_count = 0;

				$taken_arr = get_leave_taken($user_id,$row->id);
				if(!empty($taken_arr)){
					foreach($taken_arr as $row_1){
						$taken_count += $row_1->total_days;
					}
				}

				$balance_count = ($leave_count-$taken_count);

				if($balance_count > 0){
					$array = array(
						'id' => $row->id,
						'name' => $row->name,
						'order' => $row->order,
						'description' => $row->description
					);

					$return_arr['category_list'][] = $array;
				}   			

					
			   }

		   }else{
			  $return_arr['msg'] = "Record Not Found!"; 
		   }
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

			

			//check if the leave is paid
			$date_arr = explode('-',$from_date);
			$month = $date_arr[1];			
			$year = $date_arr[2];


			$addedby = 0;
			if(!empty($on_behalf)){
				$addedby = $user_id;
				$user_id = $on_behalf;
			}
			

			$check = leave_taken_inmonth($user_id,$category,$month,$year,$total_days);

			$right = 1;
			$error_msg = '';
			if($check == 1){

				//check if paid leave is grater then apply paid leave
				if($category == 3){
					$taken_count = 0;
					$taken_arr = get_leave_taken($user_id,$category);
					if(!empty($taken_arr)){
						foreach($taken_arr as $row_1){
							$taken_count += $row_1->total_days;
						}
					}

					$ttl_paid_leave = value_by_id('tblleavesettings',2,'leave_count');

					$bal_count = ($ttl_paid_leave - $taken_count);
					if($total_days > $bal_count){
						$right = 0;
						$error_msg = "You have only ".$bal_count." Paid Leave Remain, You Cannot Take More Then That !";
					}
				}elseif($category == 5){
					$bal_count = getComplimentaryLeaveBalance($user_id);
					if($total_days > $bal_count){
						$right = 0;
						$error_msg = "You have only ".$bal_count." Complimentary Leave Remain, You Cannot Take More Then That !";
					}
				}

				// For Paid Leave
				if($category == 3){
					$leave_name = value_by_id('tblleavescategories',$category,'name');
					$start_date = date('Y-m-d', strtotime(' +3 day'));
					$from_date  = date('Y-m-d',strtotime($from_date));

					if($start_date > $from_date){
						$right = 0;
						$error_msg = "You can apply ".$leave_name." before 3 days only!";
					}
				}

				if($right == 1){
					
					if($category == 4){
						$is_paid_leave = 0;
					}elseif($category == 5){
						$is_paid_leave = 1;
					}else{
						$is_paid_leave = leave_validate_final($user_id,$category,$month,$year,$total_days);
					}

					 
					// print_r($is_paid_leave);
					$ad_data = array(
						'category' => $category,
						'reason' => $reason,
						'from_date' => date('Y-m-d',strtotime($from_date)), 
						'to_date' => date('Y-m-d',strtotime($to_date)), 
						'total_days' => $total_days,    
						'is_paid_leave' => $is_paid_leave,
						'dateadded' => date('Y-m-d H:i:s'),
						'addedfrom' => $user_id,
						'addedby' => $addedby,
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
					$return_arr['message'] = $error_msg;
					$return_arr['data'] = '';
				}
				
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "You can apply on 2 leaves at this category per month!";
				$return_arr['data'] = '';
			}		

		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}

	   header('Content-type: application/json');
	   echo json_encode($return_arr);



		//https://schachengineers.com/schacrm_test/Leaves_API/add_leave?user_id=1&category=19&is_paid_leave=0&from_date=18-09-2019&to_date=22-09-2019&reason=Need&total_days=5&staffid=[2]&group_ids=[1]

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

			//$request_list = $this->home_model->get_result('tblleaves', array('addedfrom'=>$user_id), '',array('id','desc'));
			
			$from_date = date('Y-m-d', strtotime('- 365 days')). ' 00:00:00';
			$to_date = date('Y-m-d'). ' 23:59:59';
			$request_list = $this->db->query("SELECT * FROM `tblleaves` WHERE dateadded between '".$from_date."' and '".$to_date."' and  addedfrom = '".$user_id."' || addedby = '".$user_id."' order by id desc  ")->result();
			
			   if(!empty($request_list)){

				   foreach($request_list as $row){
					

					$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$row->id,'rel_type'=>'leave'),  array('id'),'');

					if($files_count)

					{

						$count=count($files_count);

					}

					else

					{

						$count=0;

					}

					$staff_details = $this->home_model->get_result('tblleaveapproval', array('leave_id'=>$row->id),  array('staff_id'),'');



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

					$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$row->id,'module_id'=>3,'isread'=>1),  array('id','readdate','touserid'),'');

					$notification_read_by=array();

					if($get_notification_user_info)

					{

						foreach ($get_notification_user_info as $notification_user) {

							$temp_data['name'] = get_employee_fullname($notification_user->touserid);

							$temp_data['read_date']=$notification_user->readdate;	

							array_push($notification_read_by, $temp_data);

						}

					}

					

					//Getting Category

					$cat_info = $this->home_model->get_row('tblleavescategories', array('id'=>$row->category), '');



					// Getting On_behalf name
					$on_behalf = '';
				   	if($user_id != $row->addedfrom){
				   		$on_behalf = get_employee_fullname($row->addedfrom);
				   	}
					

					$array = array(

						'id' => $row->id,	

						'category' => $row->category,	

						'category_name' => $cat_info->name,	

						'from_date' => date('d-m-Y',strtotime($row->from_date)),	

						'to_date' => date('d-m-Y',strtotime($row->to_date)),	

						'reason' => $row->reason,		

						'total_days' => $row->total_days,		

						'approved_status' => $row->approved_status,			

						'date' => date('d/m/Y H:i a',strtotime($row->dateadded)),

						'file_count'=>$count,

						'request_names'=>$staff_names,

						'on_behalf'=>$on_behalf,

						'read_by_user' =>$notification_read_by,

					);

					

					$return_arr['leave_list'][] = $array;

				   }

			   }else{

				  $return_arr['msg'] = "Record Not Found!"; 

				  $return_arr['leave_list'] = array();

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

					

					if($leave_info->approved_date > 0){

						$approved_date = date('d-m-Y',strtotime($leave_info->approved_date));

					}else{

						$approved_date = '--';

					}

					$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$leave_info->id,'rel_type'=>'leave'),  array('id'),'');

					if($files_count)

					{

						$count=count($files_count);

					}

					else

					{

						$count=0;

					}



					//Get Approved Info

					$approved_info = $this->home_model->get_row('tblleaveapproval', array('leave_id'=>$leave_info->id,'approve_status'=>$leave_info->approved_status), '');



					if($leave_info->approved_status == 0){

						$approved_by = '';

					}else{

						$approved_by = get_employee_fullname($approved_info->staff_id);

					}

					;
					// If user add leave against someone 	
					if($leave_info->addedby > 0){
						$added_by = get_employee_name($leave_info->addedby);
						$on_behalf = get_employee_name($leave_info->addedfrom);
					}else{
						$added_by = get_employee_name($leave_info->addedfrom);
						$on_behalf = '';
					}


					$array = array(

					    'id' => $leave_id,

						'category' => $leave_info->category,
						
						'category_name' => value_by_id('tblleavescategories',$leave_info->category,'name'),

						'added_by' => $added_by,	

						'on_behalf' => $on_behalf,	

						'from_date' => date('d-m-Y',strtotime($leave_info->from_date)),	

						'to_date' => date('d-m-Y',strtotime($leave_info->to_date)),	

						'reason' => $leave_info->reason,		

						'total_days' => $leave_info->total_days,		

						'approved_status' => $leave_info->approved_status,			

						'approved_remark' => $leave_info->approved_remark,	

						'approved_date' => $approved_date,		

						'date' => date('d/m/Y H:i a',strtotime($leave_info->dateadded)),

						'file_count'=>$count,

						'approved_by'=>$approved_by

					);

					

					$return_arr['leave_info'] = $array;

					/*$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$leave_id,'module_id'=>3,'isread'=>1),  array('id','readdate','touserid'),'');

					$notification_read_by=array();

					if($get_notification_user_info)

					{

						foreach ($get_notification_user_info as $notification_user) {

							$temp_data['name'] = get_employee_fullname($notification_user->touserid);

							$temp_data['read_date']=$notification_user->readdate;	

							array_push($notification_read_by, $temp_data);

						}

					}*/





					$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$leave_id,'module_id'=>3),  array('id','readdate','touserid','isread'),'');

					$notification_read_by=array();

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

					

					$return_arr['read_by_user']=$notification_read_by;

				 

			   }else{

				  $return_arr['msg'] = "Record Not Found!"; 

			   }	

		}

	   

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //http://35.154.77.171/schach/Leaves_API/get_single_leave?leave_id=31

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

									'module_id'        => 3,

									'type'            => 1,

									'table_id'        => $leave_id,

									'category_id'        => $request_info->category, 

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

			
			if($category == 4){
				$check = 0;
			}else{
				$check = leave_validate($user_id,$category,$month,$year);
			}
			

			

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

        $this->db->where('rel_type', 'leave');

        $file = $this->db->get('tblfiles')->row();



        if(!empty($file))

        {

	        if ($file->staffid == get_staff_user_id() || is_admin()) {

	        	if(is_dir(get_upload_path_by_type('leave') . $file->rel_id))

	        	{

	        		unlink(get_upload_path_by_type('leave') . $file->rel_id . '/' . $file->file_name);



	        		$this->db->where('rel_id', $rel_id);

	        		$this->db->where('id', $id);

	            	$this->db->delete('tblfiles');

	            

	            if ($this->db->affected_rows() > 0) {

	                $Deleted['status']=TRUE;

	                $Deleted['msg']="File Deleted Successfully";

	                

	            }



	            if (is_dir(get_upload_path_by_type('expense') . $file->rel_id)) {

	                // Check if no attachments left, so we can delete the folder also

	                $other_attachments = list_files(get_upload_path_by_type('leave') . $file->rel_id);

	                if (count($other_attachments) == 0) {

	                    // okey only index.html so we can delete the folder also

	                    delete_dir(get_upload_path_by_type('leave') . $file->rel_id);

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

	

	public function get_group_info()

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

			//getting group info

			$stafff = '';

		
			//$Staffgroup = get_staff_group(15);
			$Staffgroup =  get_staff_group(15,$user_id);

			$i=0;

			foreach($Staffgroup as $singlestaff)

			{

				

				$stafff[$i]['id']=$singlestaff['id'];

				$stafff[$i]['name']=$singlestaff['name'];

				$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='".$user_id."'")->result_array();

				$stafff[$i]['staffs']=$query;

				$i++;

			}

			

			if(!empty($stafff)){

				$return_arr['group_info'] = $stafff;

			}else{

				$return_arr['msg'] = "Record Not Found!"; 

			}

		}

		

		

		 

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

		//http://bookallservices.com/schach/Leaves_API/get_group_info?user_id=1

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

      

			//$temp['file_path']=base_url('uploads/'.$file_rel_type.'s/'.$file->rel_id.'/'.$file->file_name);

			$temp['file_path']=base_url('uploads/leave/'.$file->rel_id.'/'.$file->file_name);

			array_push($result, $temp);



			# code...

		}



    $return_arr['file_list']=$result;

    header('Content-type: application/json');

		echo json_encode($return_arr);      

    //http://35.154.77.171/schach/Leaves_API/get_file?id=3&type=leave 

	}

	

	

	public function available_leave()
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
			$setting_list = $this->home_model->get_result('tblleavesettings', array('status'=>1),'','');
			$check_provisional = get_provisional_time($user_id);
			$staff_type = get_employee_info($user_id)->staff_type_id;

			if(!empty($setting_list) && $check_provisional == 1 && $staff_type == 1){

				foreach($setting_list as $row){

					
					$leave_count = $row->leave_count;
					

					$category_id = $row->category_id;
					$category_name = get_leave_category($row->category_id);
					$taken_count = 0;
					$where = "";

					$taken_arr = get_leave_taken($user_id,$category_id);
					if(!empty($taken_arr)){
						foreach($taken_arr as $row_1){
							$taken_count += $row_1->total_days;
						}
					}

					$balance_count = ($leave_count-$taken_count);

					if($balance_count < 0){
						$balance_count = 0;
					}
					

					$arr[] = array(
						'category_id' => $category_id,
						'category_name' => $category_name,
						'balance_count' => ($category_id == 5) ? getComplimentaryLeaveBalance($user_id) : $balance_count,
						'leave_count' => ($category_id == 5) ? getComplimentaryLeaveBalance($user_id) : $leave_count,
					);
				}

				//get_available_leave_count($user_id);
				$date_range = staff_leave_daterange($user_id);	
				$last_date =  $date_range['to_date'];

				$return_arr['status'] = true;	
				$return_arr['message'] = "Success";
				$return_arr['leave_message'] = "This leaves will renew at ".date('d-m-Y',strtotime($last_date));
				$return_arr['data'] = $arr;
			}else{

				$return_arr['status'] = false;
				$return_arr['message'] = "No Record Found!";
				$return_arr['data'] = [];
			}

		}

	   header('Content-type: application/json');
	   echo json_encode($return_arr);

		//http://bookallservices.com/schach/Leaves_API/available_leave?user_id=1

	}

	

	

	public function paid_leave()

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

			

			$available_leave = get_available_leave_count($user_id);			

			$day_salary = employee_day_salary($user_id);

			$paid_balance = ($available_leave*$day_salary);

			

			$arr = array(

				'paid_balance' => $paid_balance

			);

						

			$return_arr['status'] = TRUE;	

			$return_arr['message'] = "Success";

			$return_arr['data'] = $arr;

		}

		

		

		 

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

		//http://bookallservices.com/schach/Leaves_API/paid_leave?user_id=1

	}

	

	

	public function check_pending_leave()

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

			

			$check = check_pending_leave_app($user_id);		

			

			if($check == '1'){

				$return_arr['status'] = FALSE;	

				$return_arr['message'] = 'Your Leave is Already in Process, Can\'t Apply New Leave!';

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = TRUE;	

				$return_arr['message'] = 'Success';

				$return_arr['data'] = [];

			}

						

			

		}

		

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

		//http://it-mustafa/schach/Leaves_API/check_pending_leave?user_id=1

	}

	

	public function cancel_leave_request()

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

			

			$success = cancel_leave_requset($leave_id);

		

			if($success){

				$return_arr['status'] = TRUE;	

				$return_arr['message'] = "Leave Canceled Successfully";

				$return_arr['data'] = [];

			}else{

				$return_arr['status'] = False;	

				$return_arr['message'] = "Some Error Occurred!";

				$return_arr['data'] = [];

			}

						

			

		}

		

		

		 

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //35.154.77.171/schach/Leaves_API/cancel_leave_request?leave_id=1

	}

}


<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Task_API extends CRM_Controller
{
    public function __construct()
    {
        parent::__construct();
                
		$this->load->model('tasks_model');
        $this->load->model('home_model');
		
    }

    public function get_task_master()
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

	   $task_for = $this->home_model->get_result('tbltaskfor', array('status'=>1), '');
	  
	  
	  
	   if(!empty($task_for)){
		   foreach($task_for as $row){
			 			
			$task_array = array(
				'id' => $row->id,
				'name' => $row->name
			);
			
			$return_arr['task_for'][] = $task_array;
		   }
	   }else{
		  $return_arr['task_for'] = ""; 
	   }

	   
	   
	   
	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://bookallservices.com/schach/Expenses_API/get_expenses_master
    }

    public function get_employee()
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

		

	  $employee_info = get_staff_list();	

	  if(!empty($employee_info)){
	  		foreach ($employee_info as $key => $value) {
	  			$att_array[] = array(
						'id' => $value->staffid,
						'name' => $value->firstname
					);	
	  		}

	  		$return_arr['status'] = true;	
			$return_arr['message'] = "Successfully";
			$return_arr['data'] = $att_array;
	  }else{
	  		$return_arr['status'] = false;	
			$return_arr['message'] = "Record Not Found!";
			$return_arr['data'] = '';
	  }


	  
	   header('Content-type: application/json');
	   echo json_encode($return_arr);

	   //http://35.154.77.171/schach/Task_API/get_employee

	}


	public function get_clients()
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

		

	  $client_info = $this->home_model->get_result('tblclients', array('active'=>1), '');

	  if(!empty($client_info)){
	  		foreach ($client_info as $key => $value) {
	  			$att_array[] = array(
						'id' => $value->userid,
						'name' => $value->company
					);	
	  		}

	  		$return_arr['status'] = true;	
			$return_arr['message'] = "Successfully";
			$return_arr['data'] = $att_array;
	  }else{
	  		$return_arr['status'] = false;	
			$return_arr['message'] = "Record Not Found!";
			$return_arr['data'] = [];
	  }


	  
	   header('Content-type: application/json');
	   echo json_encode($return_arr);

	   //http://35.154.77.171/schach/Task_API/get_clients

	}


	public function get_data()
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

		if(!empty($related_to) ){

			if($related_to == 2 || $related_to == 8 || $related_to == 9){

				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));
				$f_date = $from_date.' 00:00:00';

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';


				$challan_info = $this->db->query("SELECT * FROM tblchalanmst WHERE datecreated >= '".$f_date."' and datecreated <= '".$to_date."' and status = '1'")->result();

				if(!empty($challan_info)){
					foreach ($challan_info as $value) {
						$client_info = $this->db->query("SELECT client_branch_name FROM `tblclientbranch`  where userid = '".$value->clientid."'")->row();
						$att_array[] = array(
							'id' => $value->id,
							'name' => $value->chalanno.' - '.$client_info->client_branch_name
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;

				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}


			}elseif($related_to == 3){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$expense_info = $this->db->query("SELECT e.id,c.name as category_name FROM tblexpenses as e INNER JOIN tblexpensescategories as c ON e.category = c.id  WHERE e.date between '".$from_date."' and '".$to_date."' and e.status = '1' and e.approved_status = 1")->result();

				if(!empty($expense_info)){
					foreach ($expense_info as $value) {
						$exp = 'EXP-'.get_short($value->category_name).'-'.number_series($value->id);
						$att_array[] = array(
							'id' => $value->id,
							'name' => $exp
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;
				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}

			}elseif($related_to == 4){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));

				$invoice_info = $this->db->query("SELECT * FROM tblinvoices  WHERE date between '".$from_date."' and '".$to_date."' ")->result();

				if(!empty($invoice_info)){
					foreach ($invoice_info as $value) {
						$client_info = $this->db->query("SELECT company FROM `tblclients`  where userid = '".$value->clientid."'")->row();
			            $invoice = format_invoice_number($value->id);

						$att_array[] = array(
							'id' => $value->id,
							'name' => $invoice.' - '.$client_info->company
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;

				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}

			}elseif($related_to == 5){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			
				$lead_info = $this->db->query("SELECT * FROM tblleads  WHERE enquiry_date between '".$from_date."' and '".$to_date."' ")->result();

				if(!empty($lead_info)){
					foreach ($lead_info as $value) {
						
						$att_array[] = array(
							'id' => $value->id,
							'name' =>  $value->leadno
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;

				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}

			}elseif($related_to == 6){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			
				$estimates_info = $this->db->query("SELECT * FROM tblestimates  WHERE date between '".$from_date."' and '".$to_date."' ")->result();

				if(!empty($estimates_info)){
					foreach ($estimates_info as $value) {

						$estimate = format_estimate_number($value->id);
						
						$att_array[] = array(
							'id' => $value->id,
							'name' =>  $estimate
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;

				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}

			}elseif($related_to == 7){
				$product_info = $this->db->query("SELECT * FROM tblproducts  WHERE status = 1 ")->result();

				if(!empty($product_info)){
					foreach ($product_info as $value) {
						
						$att_array[] = array(
							'id' => $value->id,
							'name' => $value->name
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;

				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}

			}elseif($related_to == 1){
				 $client_info = $this->home_model->get_result('tblclients', array('active'=>1), '');

				  if(!empty($client_info)){
				  		foreach ($client_info as $key => $value) {
				  			$att_array[] = array(
									'id' => $value->userid,
									'name' => $value->company
								);	
				  		}

				  		$return_arr['status'] = true;	
						$return_arr['message'] = "Successfully";
						$return_arr['data'] = $att_array;
				  }else{
				  		$return_arr['status'] = false;	
						$return_arr['message'] = "Record Not Found!";
						$return_arr['data'] = [];
				  }
			}elseif($related_to == 10){
				$from_date = str_replace("/","-",$from_date);
				$from_date= date("Y-m-d",strtotime($from_date));

				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			
				$proposals_info = $this->db->query("SELECT * FROM tblproposals  WHERE date between '".$from_date."' and '".$to_date."' ")->result();

				if(!empty($proposals_info)){
					foreach ($proposals_info as $value) {

						$estimate = format_proposal_number($value->id);
						
						$att_array[] = array(
							'id' => $value->id,
							'name' =>  $estimate
						);	

					}

					$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;

				}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			 	}

			}


		}else{
			$return_arr['status'] = FALSE;
			$return_arr['message'] = 'Required Fields Are Missing';
			$return_arr['data'] = [];
		}
		
	
		
		header('Content-type: application/json');
		echo json_encode($return_arr);
		
		//http://35.154.77.171/schach/Task_API/get_data?from_date=08/02/2018&to_date=09/04/2019&related_to=1

	}



	public function add_task()
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


		if (!empty($added_by)) {
			
			


			$start_date = str_replace("/","-",$start_date);
			$start_date = date("Y-m-d",strtotime($start_date));

			$due_date = str_replace("/","-",$due_date);
			$due_date = date("Y-m-d",strtotime($due_date));


			if(!empty($from_date)){
				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
			}else{
				$from_date = '00:00:00';
			}


			if(!empty($to_date)){
				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			}else{
				$to_date = '00:00:00';
			}

			if($task_for == 2){
				$staff_arr = json_decode($staff_id);
				$staff_id_str = implode(',', $staff_arr);
			}else{
				$staff_id_str = '';
			}


			if($related_to == 1){
				$ids = json_decode($ids);
				$clients = implode(',', $ids);
			}else{
				$clients = '';
			}
			

			if($related_to == 2){
				$ids = json_decode($ids);
				$challans = implode(',', $ids);
			}else{
				$challans = '';
			}

			if($related_to == 3){
				$ids = json_decode($ids);
				$expenses = implode(',', $ids);
			}else{
				$expenses = '';
			}

			if($related_to == 4){
				$ids = json_decode($ids);
				$invoices = implode(',', $ids);
			}else{
				$invoices = '';
			}

			if($related_to == 5){
				$ids = json_decode($ids);
				$leads = implode(',', $ids);
			}else{
				$leads = '';
			}

			if($related_to == 6){
				$ids = json_decode($ids);
				$perfoma_invoices = implode(',', $ids);
			}else{
				$perfoma_invoices = '';
			}

			if($related_to == 7){
				/*$prod_array = array();
				foreach ($p_ids as $p_id) {
					$p_qty = $_POST['productqty_'.$p_id];

					$prod_array[] = array(
						'p_id' => $p_id,
						'p_qty' => $p_qty,
					);
				}

				$product_data = json_encode($prod_array);*/
				$product_data = $p_ids;
			}else{
				$product_data = '';
			}

			if($related_to == 10){
				$quotation = implode(',', $ids);
			}else{
				$quotation = '';
			}


			if(!empty($repeat)){
				$repeat_every = json_decode($repeat_every);
				$repeat_every = implode(',', $repeat_every);
				$is_repeat = 1;
				$start_date = '0000-00-00';
				$due_date = '0000-00-00';
			}else{
				$repeat_type = 0;	
				$is_repeat = 0;	
				$repeat_every = '';	
			}


			if(!empty($user_ids)){
				$user_arr = json_decode($user_ids);
				$user_id_str = implode(',', $user_arr);
			}else{
				$user_id_str = '';
			}


			$add_data = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date,
                    'due_date' => $due_date,
                    'is_repeat' => $is_repeat,
                    'repeat_type' => $repeat_type,
                    'repeat_every' => $repeat_every,
                    'task_for' => $task_for,
                    'assigned_to' => $staff_id_str,
                    'user_ids' => $user_id_str,
                    'related_to' => $related_to,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'clients' => $clients,
                    'challans' => $challans,
                    'expenses' => $expenses,
                    'invoices' => $invoices,
                    'leads' => $leads,
                    'perfoma_invoices' => $perfoma_invoices,
                    'quotation' => $quotation,
                    'product_data' => $product_data,
                    'priority' => $priority,
                    'added_by' => $added_by,
                    'status' => 1,
                    'created_at' => date('Y-m-d H:i:s')
                );


			/*if(!empty($_FILES['task_file'])){
				if(!empty($_FILES['task_file']['name'])){
					$param['upload_path'] = TASKS_ATTACHMENTS_FOLDER;
					$param['allowed_types'] = '*';
					$param['encrypt_name'] =TRUE;
					$param['max_size'] = '2048570';

					$this->load->library('upload',$param);
					$this->upload->initialize($param);

					if(!$this->upload->do_upload('task_file')){
						echo  $errors = $this->upload->display_errors();	
						die;

					}else{
						$file_name = $this->upload->data('file_name');						
						$add_data['task_file'] = $file_name;

					}

				}
			}*/
                                
            $insert = $this->home_model->insert('tbltasks', $add_data); 

            if($insert){

            	$task_id = $this->db->insert_id();

            	$result_file=handle_multi_task_attachments($task_id,'task');

            	if(!empty($user_ids)){
	            		$user_arr = json_decode($user_ids);
	            		foreach ($user_arr as $u_id) {

	            			$add_data_2 = array(
			                    'task_id' => $task_id,
			                    'staff_id' => $u_id
			                );

			                $insert_2 = $this->home_model->insert('tbltaskusers', $add_data_2); 

	            		}
	            }

            	if($task_for == 1){

            		$add_data_1 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $added_by,
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1);   

		            //Sending Mobile Intimation
					$token = get_staff_token($added_by);
					$message = 'New Task Assigned';
					$title = 'SSAFE';
					$send_intimation = sendFCM($message, $title, $token);

		           /* $notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => $added_by,
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $task_id,
							'category_id'     => 0,
							'fromuserid'      => $added_by,
							'link'            => 'Task/task_details/' . $task_id.'',
						   
						]);
					if ($notified) {
						pusher_trigger_notification([$added_by]);
					} */     

					$add_data_2 = array(
		                    'description' => 'New Task Alloted to you',
		                    'touserid' => $added_by,
		                    'fromuserid' => $added_by,
		                    'table_id' => $task_id,
		                    'type' => 0,
		                    'isread' => 0,
		                    'isread_inline' => 0,
		                    'module_id' => 4,
		                    'category_id' => 0,
		                    'date' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);
     		
            	}else{
            		if(!empty($staff_id)){
            			/*echo 'Added By :- '.$added_by;
            			die;*/
	            		$staff_arr = json_decode($staff_id);
	            		foreach ($staff_arr as $s_id) {

	            			$add_data_1 = array(
			                    'task_id' => $task_id,
			                    'staff_id' => $s_id,
			                    'task_status' => 0,
			                    'updated_at' => date('Y-m-d H:i:s')
			                );

			                $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1); 


	            			/*$notified = add_notification([
								'description'     => 'New Task Alloted to you',
								'touserid'        => $s_id,
								'type'            => 0,
								'module_id'       => 4,
								'table_id'        => $task_id,
								'category_id'     => 0,
								'fromuserid'      => $added_by,
								'link'            => 'Task/task_details/' . $task_id.'',
							   
							]);
							if ($notified) {
								pusher_trigger_notification([$s_id]);
							}*/

							//Sending Mobile Intimation
							$token = get_staff_token($s_id);
							$message = 'New Task Assigned';
							$title = 'SSAFE';
							$send_intimation = sendFCM($message, $title, $token);

							$add_data_2 = array(
				                    'description' => 'New Task Alloted to you',
				                    'touserid' => $s_id,
				                    'fromuserid' => $added_by,
				                    'table_id' => $task_id,
				                    'type' => 0,
				                    'isread' => 0,
				                    'isread_inline' => 0,
				                    'module_id' => 4,
				                    'category_id' => 0,
				                    'link'            => 'Task/task_details/' . $task_id.'',
				                    'date' => date('Y-m-d H:i:s')
				                );

				            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);


	            		}
            		}
            	
            	}
            	
            	
            	



            	$return_arr['status'] = true;	
				$return_arr['message'] = "Task added Successfully";
				$return_arr['data'] = [];
            }else{
            	$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to add Task";
				$return_arr['data'] = [];
	        }


		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);
	   //http://schachengineers.com/schacrm_test//Task_API/add_task?start_date=09/04/2019&due_date=10/04/2019&reminder_date=07/04/2019&repeat=0&repeat_type=1&repeat_every=3,5,6&title=title&description=description&priority=2&task_for=2&staff_id=[1,2]&ids=[1,3]&related_to=5&from_date=01/11/2018&to_date=10/04/2019&p_ids=[{"p_id":"6","p_qty":"2"},{"p_id":"8","p_qty":"1"}]&added_by=1

	}


	public function get_task_added_by_me()
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



		if(!empty($user_id) ){

			$where = "t.added_by = '".$user_id."' ";

			if(!empty($from_date) && !empty($to_date)){

				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				$from_date = $from_date.' 00:00:00';


				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';

				//$task_info = $this->db->query("SELECT * FROM tbltasks WHERE added_by = '".$user_id."' and created_at between '".$from_date."' and '".$to_date."' order by id desc ")->result();
				$where .= " and t.created_at between '".$from_date."' and '".$to_date."' ";
			}else{
				$where .= " and MONTH(t.created_at) = '".date('m')."' and YEAR(t.created_at) = '".date('Y')."'";
				//$task_info = $this->db->query("SELECT * FROM tbltasks WHERE added_by = '".$user_id."' and MONTH(created_at) = '".date('m')."' and YEAR(created_at) = '".date('Y')."' order by id desc ")->result();

			}

			if(!empty($employee_id)){
				$where .= " and ta.staff_id = '".$employee_id."'";				
			}

			$task_info = $this->db->query("SELECT t.*  FROM tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id WHERE  ".$where."  GROUP by t.id ORDER by t.id desc")->result();


			if(!empty($task_info)){
			  		foreach ($task_info as $key => $value) {

			  			if($value->is_repeat == 1){
			  				$repeat = 'Yes';
			  			}else{
			  				$repeat = 'No';
			  			}

			  			if($value->is_repeat == 1){ 
			  				$type = ($value->repeat_type == 1) ? 'Weekly' : 'Monthly';
			  			}else{ 
			  			 	$type = date('d-m-Y',strtotime($value->start_date)).' to '.date('d-m-Y',strtotime($value->due_date));
			  			}

			  			$priority = '--';
						if($value->priority == 1){
							$priority = 'Low';
						}elseif($value->priority == 2){
							$priority = 'Medium';
						}elseif($value->priority == 3){
							$priority = 'High';
						}elseif($value->priority == 4){
							$priority = 'Urgent';
						}


						$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'task'),  array('id'),'');
						if($files_count){
							$count=count($files_count);
						}else{
							$count=0;
						}

						$task_status = get_task_status($value->id);


			  			$att_array[] = array(
								'id' => $value->id,
								'task_title' => $value->title,
								'task_status' => $task_status,
								'relatedto_id' => $value->related_to,
								'repeat' => $repeat,
								'start_due_date' => $type,
								'related_to' => value_by_id('tbltaskfor',$value->related_to,'name'),
								'priority' => $priority,
								'file_count' => $count,
							);	
			  		}

			  		$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;
			}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			}




		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];	
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);

    	
		//http://35.154.77.171/schach/Task_API/get_task_added_by_me?user_id=1&from_date=01/01/2019&to_date=12/04/2019
    }




    public function get_task_added_for_me()
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

				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				$from_date = $from_date.' 00:00:00';


				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';

				$task_info = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".$user_id."' and ta.task_status = '".$status."' and t.created_at between '".$from_date."' and '".$to_date."' order by id desc ")->result();

			}else{

				$task_info = $this->db->query("SELECT t.*, ta.staff_id, ta.task_status from tbltasks as t LEFT JOIN tbltaskassignees as ta ON t.id = ta.task_id where ta.staff_id = '".$user_id."' and ta.task_status = '".$status."' order by id desc ")->result();

			}



			if(!empty($task_info)){
			  		foreach ($task_info as $key => $value) {

			  			if($value->is_repeat == 1){
			  				$repeat = 'Yes';
			  			}else{
			  				$repeat = 'No';
			  			}

			  			if($value->is_repeat == 1){ 
			  				$type = ($value->repeat_type == 1) ? 'Weekly' : 'Monthly';
			  			}else{ 
			  			 	$type = date('d-m-Y',strtotime($value->start_date)).' to '.date('d-m-Y',strtotime($value->due_date));
			  			}

			  			$priority = '--';
						if($value->priority == 1){
							$priority = 'Low';
						}elseif($value->priority == 2){
							$priority = 'Medium';
						}elseif($value->priority == 3){
							$priority = 'High';
						}elseif($value->priority == 4){
							$priority = 'Urgent';
						}

						$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'task'),  array('id'),'');
						if($files_count){
							$count=count($files_count);
						}else{
							$count=0;
						}



			  			$att_array[] = array(
								'id' => $value->id,
								'task_title' => $value->title,
								'relatedto_id' => $value->related_to,
								'task_status' => $value->task_status,
								'repeat' => $repeat,
								'start_due_date' => $type,
								'related_to' => value_by_id('tbltaskfor',$value->related_to,'name'),
								'priority' => $priority,
								'file_count' => $count,
							);	
			  		}

			  		$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;
			}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			}




		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];	
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);

    	
		//http://35.154.77.171/schach/Task_API/get_task_added_for_me?user_id=1&status=0&from_date=01/01/2019&to_date=12/04/2019
    }




    public function add_activity()
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


		if(!empty($task_id) && !empty($staff_id) && !empty($description)){

			$add_data_1 = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $staff_id,
		                    'description' => $description,
		                    'created_at' => date('Y-m-d H:i:s')
		                );

		    $insert_1 = $this->home_model->insert('tbltask_activity_log', $add_data_1); 

		    // For Tagging 
            /* this is for check notification uodate */
            $chk_notification = $this->db->query("SELECT `id` FROM `tblmasterapproval` where table_id = '".$task_id."' and staff_id = '".$staff_id."' and module_id = 60")->result();
            if (!empty($chk_notification)){
                foreach ($chk_notification as $value) {
                    $this->home_model->update("tblmasterapproval", array("status" => 1), array("id" => $value->id));
                }
            }

            if(!empty($tag_staff_ids)){
            	 $staff_ids = json_decode($tag_staff_ids);
            	 foreach ($staff_ids as $s_id) {
                   $n_data = array(
                        'description' => 'You taged in task activity',
                        'staff_id' => $s_id,
                        'fromuserid' => $staff_id,
                        'table_id' => $task_id,
                        'isread' => 0,
                        'module_id' => 60,
                        'link'  => "Task/activity_log/".$task_id,
                        'date' => date('Y-m-d H:i:s'),
                        'date_time' => date('Y-m-d H:i:s')
                    );

                    $this->home_model->insert('tblmasterapproval', $n_data);
                    
                    //Sending Mobile Intimation
                    $token = get_staff_token($s_id);
                    $title = 'Schach';
                    $message = 'You taged in task activity';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
               }
            }

		    if($insert_1){
		    	$return_arr['status'] = true;	
				$return_arr['message'] = "New activity added Successfully";
				$return_arr['data'] = [];
		    }else{
		    	$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to add new Activity";
				$return_arr['data'] = [];
		    }


		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];
		}


		header('Content-type: application/json');
		echo json_encode($return_arr);

		//http://35.154.77.171/schach/Task_API/add_activity?task_id=1&staff_id=25&description=msg1

	}


	public function get_activities()
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

		

	  $task_info = $this->db->query("SELECT * FROM tbltask_activity_log WHERE task_id = '".$task_id."' order by id asc ")->result();	

	  if(!empty($task_info)){
	  		foreach ($task_info as $key => $value) {
	  			$att_array[] = array(
						'id' => $value->id,
						'employee_name' => get_employee_name($value->staff_id),
						'description' => $value->description,
						'created_at' => $value->created_at,
					);	
	  		}

	  		$return_arr['status'] = true;	
			$return_arr['message'] = "Successfully";
			$return_arr['data'] = $att_array;
	  }else{
	  		$return_arr['status'] = false;	
			$return_arr['message'] = "Record Not Found!";
			$return_arr['data'] = [];
	  }


	  
	   header('Content-type: application/json');
	   echo json_encode($return_arr);

	   //http://35.154.77.171/schach/Task_API/get_activities?task_id=1

	}


	public function get_task_detials()
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

		
		if($task_id){
			$task_info = $this->db->query("SELECT * FROM tbltasks WHERE id = '".$task_id."' order by id asc ")->row();	

			  if(!empty($task_info)){


			  	if(!empty($task_info->product_data)){
			  		$product_data = json_decode($task_info->product_data);
			  	}else{
			  		$product_data = [];
			  	}

			  	if($task_info->start_date > 0){
					$start_date = date('d/m/Y',strtotime($task_info->start_date));
			  	}else{
			  		$start_date = '';	
			  	}

			  	if($task_info->due_date > 0){
					$due_date = date('d/m/Y',strtotime($task_info->due_date));
			  	}else{
			  		$due_date = '';	
			  	}

			  	if($task_info->reminder_date > 0){
					$reminder_date = date('d/m/Y',strtotime($task_info->reminder_date));
			  	}else{
			  		$reminder_date = '';	
			  	}

			  	if($task_info->from_date > 0){
					$from_date = date('d/m/Y',strtotime($task_info->from_date));
			  	}else{
			  		$from_date = '';	
			  	}

			  	if($task_info->to_date > 0){
					$to_date = date('d/m/Y',strtotime($task_info->to_date));
			  	}else{
			  		$to_date = '';	
			  	}


			  	if(!empty($user_id)){
			  		$status_info = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$task_id,'staff_id'=>$user_id), '');
			  		if(!empty($status_info)){
						$status = $status_info->task_status;
			  		}else{
			  			$status = '';
			  		}
			  	}else{
			  		$status = '';
			  	}




			  	$table_data = array();
			  	//getting the table data
			  	if($task_info->related_to == 1){
			  		if(!empty($task_info->clients)){
			  			$client_info = $this->db->query("SELECT * from tblclients where userid IN (".$task_info->clients.") ")->result();
			  			if(!empty($client_info)){
			  				foreach ($client_info as $key => $value) {
			  					$table_data[] = array(
							  						'id' => $value->userid,
							  						'name' => $value->company,
							  						'qty' => '',
							  						'state_city' => '',
							  						'location' => '',
							  						'address' => ''
						  						);
			  				}
			  			}	
					}
			  	}elseif($task_info->related_to == 2){
			  		if(!empty($task_info->challans)){
			  			$challan_info = $this->db->query("SELECT * from tblchalanmst where id IN (".$task_info->challans.") ")->result();
			  			if(!empty($challan_info)){
			  				foreach ($challan_info as $key => $value) {
			  					$table_data[] = array(
						  						'id' => $value->id,
						  						'name' => $value->chalanno,
						  						'qty' => '',
						  						'state_city' => '',
						  						'location' => '',
						  						'address' => ''
					  						);
			  				}
			  			}
			  		}
			  	}elseif($task_info->related_to == 3){
			  		if(!empty($task_info->expenses)){
                              $expense_info = $this->db->query("SELECT e.id,c.name as category_name FROM tblexpenses as e INNER JOIN tblexpensescategories as c ON e.category = c.id  WHERE e.id IN (".$task_info->expenses.") ")->result();

                          if(!empty($expense_info)){
                          		foreach ($expense_info as $key => $value) {
                      				$exp = 'EXP-'.get_short($value->category_name).'-'.number_series($value->id);
                      				$table_data[] = array(
					  						'id' => $value->id,
					  						'name' => $exp,
					  						'qty' => '',
					  						'state_city' => '',
					  						'location' => '',
					  						'address' => ''
				  						);
                          		}
                          }

                    }
			  	}elseif($task_info->related_to == 4){
                    if(!empty($task_info->invoices)){
                    	$invoice_info = $this->db->query("SELECT * from tblinvoices where id IN (".$task_info->invoices.") ")->result();

                    	if(!empty($invoice_info)){
                    		foreach ($invoice_info as $key => $value) {
                           			$table_data[] = array(
					  						'id' => $value->id,
					  						'name' => format_invoice_number($value->id),
					  						'qty' => '',
					  						'state_city' => '',
					  						'location' => '',
					  						'address' => ''
				  						);
                    		}
                    	}
	                }
	            }elseif($task_info->related_to == 5){
	            	if(!empty($task_info->leads)){
	            		$lead_info = $this->db->query("SELECT * from tblleads where id IN (".$task_info->leads.") ")->result();
	            		if(!empty($lead_info)){
	            			foreach ($lead_info as $key => $value) {
	            				$table_data[] = array(
					  						'id' => $value->id,
					  						'name' => $value->leadno,
					  						'qty' => '',
					  						'state_city' => '',
					  						'location' => '',
					  						'address' => ''
				  						);
	            			}

	            		}
	            	}
	            }elseif($task_info->related_to == 6){                      
	                if(!empty($task_info->perfoma_invoices)){
	                	$pi_info = $this->db->query("SELECT * from tblestimates where id IN (".$task_info->perfoma_invoices.") ")->result();

	                	if(!empty($pi_info)){
	                		foreach ($pi_info as $key => $value) {
	                			$table_data[] = array(
				  						'id' => $value->id,
				  						'name' => format_estimate_number($value->id),
				  						'qty' => '',
				  						'state_city' => '',
				  						'location' => '',
				  						'address' => ''
			  						);
	                		}
	                	}

	                }
	            }elseif($task_info->related_to == 7){
	            	$pj_array = json_decode($task_info->product_data);

	            	if(!empty($pj_array)){
	            		foreach ($pj_array as $p_info) {
	            			$table_data[] = array(
				  						'id' => $p_info->p_id,
				  						'name' => value_by_id('tblproducts',$p_info->p_id,'name'),
				  						'qty' => $p_info->p_qty,
				  						'state_city' => '',
				  						'location' => '',
				  						'address' => ''

			  						);
	            		}

	            	}
				}elseif($task_info->related_to == 8 || $task_info->related_to == 9){
					$challan_ids = explode(',', $task_info->challans);
					if(!empty($challan_ids)){
						foreach ($challan_ids as  $challan_id) {
						$challan_info = $this->home_model->get_row('tblchalanmst', array('id'=>$challan_id), '');
						if(!empty($challan_info)){
								$site_info = $this->home_model->get_row('tblsitemanager', array('id'=>$challan_info->site_id), '');
								if(!empty($site_info)){
									$state = value_by_id('tblstates',$site_info->state_id,'name');
									$city = value_by_id('tblcities',$site_info->city_id,'name');

									$table_data[] = array(
										'id' => '',
				  						'name' => $challan_info->chalanno,
				  						'state_city' => $state.', '.$city,
				  						'location' => $site_info->location,
				  						'address' => $site_info->address,
				  						'qty' => ''

			  						);
								}

							}

						}
					}
				}elseif($task_info->related_to == 10){                      
	                if(!empty($task_info->quotation)){
	                	$proposals_info = $this->db->query("SELECT * from tblproposals where id IN (".$task_info->quotation.") ")->result();

	                	if(!empty($proposals_info)){
	                		foreach ($proposals_info as $key => $value) {
	                			$table_data[] = array(
				  						'id' => $value->id,
				  						'name' => format_proposal_number($value->id),
				  						'qty' => '',
				  						'state_city' => '',
				  						'location' => '',
				  						'address' => ''
			  						);
	                		}
	                	}

	                }
	            }	


				$related_name = value_by_id('tbltaskfor',$task_info->related_to,'name');

				
				if(!empty($task_info->assigned_to)){
					$assignee_arr = explode(',', $task_info->assigned_to);
					$assignees = array();
					foreach ($assignee_arr as $s_id) {

						//getting assignee compeleted status
						$assignees_info = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$task_id,'staff_id'=>$s_id), '');
						$notificatoin_info = $this->home_model->get_row('tblnotifications', array('isread'=>1,'module_id'=>4,'table_id'=>$task_id,'touserid'=>$s_id), '');
						$read_date = 'Not Yet';
						if(!empty($notificatoin_info)){
							$read_date = _d($notificatoin_info->readdate);	
						}

						$action_date = '';
						$t_status = '';
						$t_status_id = '';
						/*echo '<pre/>';
						print_r($assignees_info);*/
						
						if(!empty($assignees_info)){
							if($assignees_info->task_status > 0){
								$action_date = date('d/m/Y H:i:s',strtotime($assignees_info->updated_at));
							}else{
								$action_date = '--';
							}


							if($assignees_info->task_status == 0){
								$t_status = 'Pending';
							}elseif($assignees_info->task_status == 1){
								$t_status = 'Completed';
							}elseif($assignees_info->task_status == 2){
								$t_status = 'Reject';
							}

							$t_status_id = $assignees_info->task_status;
						}	

					

						$assignees[] = array(
										'name' => get_employee_name($s_id),
										'status_id' => $t_status_id,
										'status' => $t_status,
										'date' => $action_date,
										'read_date' => $read_date,

									);
					}

				}else{
					//getting assignee compeleted status
					$assignees_info = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$task_id,'staff_id'=>$task_info->added_by), '');
					$action_date = '';
					$t_status = '';
					$t_status_id = '';
					/*echo '<pre/>';
					print_r($assignees_info);*/

					$notificatoin_info = $this->home_model->get_row('tblnotifications', array('isread'=>1,'module_id'=>4,'table_id'=>$task_id,'touserid'=>$task_info->added_by), '');
					$read_date = 'Not Yet';
					if(!empty($notificatoin_info)){
						$read_date = _d($notificatoin_info->readdate);	
					}
					
					if(!empty($assignees_info)){
						if($assignees_info->task_status > 0){
							$action_date = date('d/m/Y H:i:s',strtotime($assignees_info->updated_at));
						}else{
							$action_date = '--';
						}


						if($assignees_info->task_status == 0){
							$t_status = 'Pending';
						}elseif($assignees_info->task_status == 1){
							$t_status = 'Completed';
						}elseif($assignees_info->task_status == 2){
							$t_status = 'Reject';
						}

						$t_status_id = $assignees_info->task_status;
					}		

					$assignees[] = array(
									'name' => 'Self',
									'status_id' => $t_status_id,
									'status' => $t_status,
									'date' => $action_date,
									'read_date' => $read_date,
								);
				}


				$users_list = array();
				if(!empty($task_info->user_ids)){
					$staff_arr = explode(',', $task_info->user_ids);
					
					foreach ($staff_arr as $s_id) {
						$users_list[] = array(
										'id' => $s_id,
										'name' => get_employee_name($s_id),
									);
					}

				}

				$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$task_id,'rel_type'=>'task'),  array('id'),'');
				if($files_count){
						$count=count($files_count);
					}else{
						$count=0;
					}

			  	$att_array = array(
						'id' => $task_info->id,
						'title' => $task_info->title,
						'description' => $task_info->description,
						'is_repeat' => $task_info->is_repeat,
						'repeat_type' => $task_info->repeat_type,
						'repeat_every' => $task_info->repeat_every,
						'start_date' => $start_date,
						'due_date' => $due_date,
						'reminder_date' => $reminder_date,
						'task_for' => $task_info->task_for,
						'assigned_to' => $task_info->assigned_to,						
						'from_date' => $from_date,
						'to_date' => $to_date,
						'related_to' => $task_info->related_to,
						'related_name' => $related_name,
						'clients' => $task_info->clients,
						'challans' => $task_info->challans,
						'expenses' => $task_info->expenses,
						'invoices' => $task_info->invoices,
						'leads' => $task_info->leads,
						'perfoma_invoices' => $task_info->perfoma_invoices,						
						'quotation' => $task_info->quotation,						
						'product_data' => $product_data,
						'assignees' => $assignees,
						'users_list' => $users_list,
						'added_by' => $task_info->added_by,
						'added_name' => get_employee_name($task_info->added_by),
						'priority' => $task_info->priority,
						'table_data' => $table_data,
						'file_count' => $count,
						'status' => $status
					);	



			  	$return_arr['status'] = true;	
				$return_arr['message'] = "Successfully";
				$return_arr['data'] = $att_array;

			  }else{
		  		$return_arr['status'] = false;	
				$return_arr['message'] = "Record Not Found!";
				$return_arr['data'] = [];
		 	 }
		}else{
	  		$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing !";
			$return_arr['data'] = [];
	 	}


	  
	   header('Content-type: application/json');
	   echo json_encode($return_arr);

	   //http://35.154.77.171/schach/Task_API/get_task_detials?task_id=1
    }
	
	
	public function edit_task()
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


		if (!empty($added_by)) {
			
			

			$start_date = str_replace("/","-",$start_date);
			$start_date = date("Y-m-d",strtotime($start_date));

			$due_date = str_replace("/","-",$due_date);
			$due_date = date("Y-m-d",strtotime($due_date));

			if(!empty($from_date)){
				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
			}else{
				$from_date = '00:00:00';
			}


			if(!empty($to_date)){
				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
			}else{
				$to_date = '00:00:00';
			}

			if($task_for == 2){
				$staff_arr = json_decode($staff_id);
				$staff_id_str = implode(',', $staff_arr);
			}else{
				$staff_id_str = '';
			}


			if($related_to == 1){
				$ids = json_decode($ids);
				$clients = implode(',', $ids);
			}else{
				$clients = '';
			}
			

			if($related_to == 2){
				$ids = json_decode($ids);
				$challans = implode(',', $ids);
			}else{
				$challans = '';
			}

			if($related_to == 3){
				$ids = json_decode($ids);
				$expenses = implode(',', $ids);
			}else{
				$expenses = '';
			}

			if($related_to == 4){
				$ids = json_decode($ids);
				$invoices = implode(',', $ids);
			}else{
				$invoices = '';
			}

			if($related_to == 5){
				$ids = json_decode($ids);
				$leads = implode(',', $ids);
			}else{
				$leads = '';
			}

			if($related_to == 6){
				$ids = json_decode($ids);
				$perfoma_invoices = implode(',', $ids);
			}else{
				$perfoma_invoices = '';
			}

			if($related_to == 7){
				/*$prod_array = array();
				foreach ($p_ids as $p_id) {
					$p_qty = $_POST['productqty_'.$p_id];

					$prod_array[] = array(
						'p_id' => $p_id,
						'p_qty' => $p_qty,
					);
				}

				$product_data = json_encode($prod_array);*/
				$product_data = $p_ids;
			}else{
				$product_data = '';
			}

			if($related_to == 10){
				$quotation = implode(',', $ids);
			}else{
				$quotation = '';
			}


			if(!empty($repeat)){
				$repeat_every = json_decode($repeat_every);
				$repeat_every = implode(',', $repeat_every);
				$is_repeat = 1;
				$start_date = '0000-00-00';
				$due_date = '0000-00-00';
			}else{
				$repeat_type = 0;	
				$is_repeat = 0;	
				$repeat_every = '';	
			}

			if(!empty($user_ids)){
				$user_arr = json_decode($user_ids);
				$user_id_str = implode(',', $user_arr);
			}else{
				$user_id_str = '';
			}	
				

			$add_data = array(
                    'title' => $title,
                    'description' => $description,
                    'start_date' => $start_date,
                    'due_date' => $due_date,
                    'is_repeat' => $is_repeat,
                    'repeat_type' => $repeat_type,
                    'repeat_every' => $repeat_every,
                    'task_for' => $task_for,
                    'assigned_to' => $staff_id_str,
					'user_ids' => $user_id_str,
                    'related_to' => $related_to,
                    'from_date' => $from_date,
                    'to_date' => $to_date,
                    'clients' => $clients,
                    'challans' => $challans,
                    'expenses' => $expenses,
                    'invoices' => $invoices,
                    'leads' => $leads,
                    'perfoma_invoices' => $perfoma_invoices,
                    'quotation' => $quotation,
                    'product_data' => $product_data,
                    'priority' => $priority,
                    'added_by' => $added_by,
                    'status' => 1
                );


			/*if(!empty($_FILES['task_file'])){
				if(!empty($_FILES['task_file']['name'])){
					$param['upload_path'] = TASKS_ATTACHMENTS_FOLDER;
					$param['allowed_types'] = '*';
					$param['encrypt_name'] =TRUE;
					$param['max_size'] = '2048570';

					$this->load->library('upload',$param);
					$this->upload->initialize($param);

					if(!$this->upload->do_upload('task_file')){
						echo  $errors = $this->upload->display_errors();	
						die;

					}else{
						$file_name = $this->upload->data('file_name');						
						$add_data['task_file'] = $file_name;

					}

				}
			}*/
                                
			$insert = $this->home_model->update('tbltasks', $add_data, array('id'=>$id)); 

            if($insert){

            	$result_file=handle_multi_task_attachments($id,'task');
				
				$this->home_model->delete('tbltaskassignees', array('task_id'=>$id)); 
            	$this->home_model->delete('tbltaskusers', array('task_id'=>$id)); 
            	$this->home_model->delete('tblnotifications', array('module_id'=>4,'table_id'=>$id)); 
				

            	if(!empty($user_ids)){
	            		$user_arr = json_decode($user_ids);
	            		foreach ($user_arr as $u_id) {

	            			$add_data_2 = array(
			                    'task_id' => $id,
			                    'staff_id' => $u_id
			                );

			                $insert_2 = $this->home_model->insert('tbltaskusers', $add_data_2); 

	            		}
	            }
				

            	if($task_for == 1){

            		$add_data_1 = array(
		                    'task_id' => $id,
		                    'staff_id' => $added_by,
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1);   


		            /*$notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => $added_by,
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $id,
							'category_id'     => 0,
							'fromuserid'      => $added_by,
							'link'            => 'Task/task_details/' . $id.'',
						   
						]);
					if ($notified) {
						pusher_trigger_notification([$added_by]);
					}  */

					//Sending Mobile Intimation
					$token = get_staff_token($added_by);
					$message = 'New Task Assigned';
					$title = 'SSAFE';
					$send_intimation = sendFCM($message, $title, $token);

					$add_data_2 = array(
		                    'description' => 'New Task Alloted to you',
		                    'touserid' => $added_by,
		                    'fromuserid' => $added_by,
		                    'table_id' => $id,
		                    'type' => 0,
		                    'isread' => 0,
		                    'isread_inline' => 0,
		                    'module_id' => 4,
		                    'category_id' => 0,
		                    'date' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);        		
            	}

            	//Sending Notification
            	
            	
            	if(!empty($staff_id)){
            		$staff_id = json_decode($staff_id);
            		foreach ($staff_id as $s_id) {

            			$add_data_1 = array(
		                    'task_id' => $id,
		                    'staff_id' => $s_id,
		                    'task_status' => 0,
		                    'updated_at' => date('Y-m-d H:i:s')
		                );

		                $insert_1 = $this->home_model->insert('tbltaskassignees', $add_data_1); 


		                //Sending Mobile Intimation
						/*$token = get_staff_token($s_id);
						$message = 'New Task Assigned';
						$title = 'SSAFE';
						$send_intimation = sendFCM($message, $title, $token);

            			$notified = add_notification([
							'description'     => 'New Task Alloted to you',
							'touserid'        => $s_id,
							'type'            => 0,
							'module_id'       => 4,
							'table_id'        => $id,
							'category_id'     => 0,
							'fromuserid'      => $added_by,
							'link'            => 'Task/task_details/' . $id.'',
						   
						]);
						if ($notified) {
							pusher_trigger_notification([$s_id]);
						}*/

						//Sending Mobile Intimation
						$token = get_staff_token($s_id);
						$message = 'New Task Assigned';
						$title = 'Schach';
						$send_intimation = sendFCM($message, $title, $token);

						$add_data_2 = array(
			                    'description' => 'New Task Alloted to you',
			                    'touserid' => $s_id,
			                    'fromuserid' => $added_by,
			                    'table_id' => $id,
			                    'type' => 0,
			                    'isread' => 0,
			                    'isread_inline' => 0,
			                    'module_id' => 4,
			                    'category_id' => 0,
			                    'link'            => 'Task/task_details/' . $id.'',
			                    'date' => date('Y-m-d H:i:s')
			                );

			            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);
            		}
            	}
            	



            	$return_arr['status'] = true;	
				$return_arr['message'] = "Task Updated Successfully";
				$return_arr['data'] = [];
            }else{
            	$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to Update Task";
				$return_arr['data'] = [];
	        }


		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);
	   //http://35.154.77.171/schach/Task_API/add_task?start_date=09/04/2019&due_date=10/04/2019&reminder_date=07/04/2019&repeat=0&repeat_type=1&repeat_every=3,5,6&title=title&description=description&priority=2&task_for=2&staff_id=[1,2]&ids=[1,3]&related_to=5&from_date=01/11/2018&to_date=10/04/2019&p_ids=[{"p_id":"6","p_qty":"2"},{"p_id":"8","p_qty":"1"}]&added_by=1&user_ids=[1,2]

	}



	public function update_status()
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

		if(!empty($task_id) && !empty($staff_id) && !empty($status)){
			$where_arr = array(
		                    'task_id' => $task_id,
		                    'staff_id' => $staff_id
		                );

		    $udpate = $this->home_model->update('tbltaskassignees',array('task_status'=>$status),$where_arr); 
		    if($udpate){


		    	if($status > 0){
		    		//sending notificaiton
		    		$this->home_model->delete('tblnotifications', array('module_id'=>4,'table_id'=>$task_id,'task_completion'=>1)); 

			    	$task_info = $this->home_model->get_row('tbltasks', array('id'=>$task_id), '');

			    	$assignee_count = $this->db->query("SELECT COUNT(id) as ttl_assignees from `tbltaskassignees` where task_id = '".$task_id."' ")->row();
			    	$compeleted_count = $this->db->query("SELECT COUNT(id) as ttl_compeleted from `tbltaskassignees` where task_id = '".$task_id."' and task_status = 1 ")->row();


					

			    	


					//getting comeleted percent
			    	$compeleted_percent = (100/$assignee_count->ttl_assignees)*$compeleted_count->ttl_compeleted; 

			    	if($status == 1){
			    		$description = 'Task is Compeleted. Completed '.round($compeleted_percent).' %';
			    		$message = 'Task is Compeleted';
			    	}elseif($status == 2){
			    		$description = 'Task is Rejected. Completed '.round($compeleted_percent).' %';
			    		$message = 'Task is Rejected';
			    	}

			    	//Sending Mobile Intimation
					$token = get_staff_token($task_info->added_by);
					
					$title = 'SSAFE';
					$send_intimation = sendFCM($message, $title, $token);

			    	$add_data_2 = array(
		                    'description' => $description,
		                    'touserid' => $task_info->added_by,
		                    'fromuserid' => $staff_id,
		                    'table_id' => $task_id,
		                    'type' => 0,
		                    'isread' => 0,
		                    'isread_inline' => 0,
		                    'module_id' => 4,
		                    'category_id' => 0,
		                    'task_completion' => 1,
		                    'link'            => '--',
		                    'date' => date('Y-m-d H:i:s')
		                );

		            $insert_1 = $this->home_model->insert('tblnotifications', $add_data_2);
		    	}
		    	



		    	$return_arr['status'] = true;	
				$return_arr['message'] = "Task status Updated Successfully";
				$return_arr['data'] = [];
		    }
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];
		}


		header('Content-type: application/json');
		echo json_encode($return_arr);

	}

	//http://schachengineers.com/schacrm_test/Task_API/update_status?task_id=146&staff_id=10&status=1



	public function get_view_task()
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

		if(!empty($task_id) ){

			$task_info = $this->home_model->get_row('tbltasks', array('id'=>$task_id), '');

			if(!empty($task_info)){


				if(!empty($staff_id)){
			  		$status_info = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$task_id,'staff_id'=>$staff_id), '');
			  		if(!empty($status_info)){
						$status = $status_info->task_status;
			  		}else{
			  			$status = '';
			  		}
			  	}else{
			  		$status = '';
			  	}


				if($task_info->start_date > 0){
					$start_date = date('d/m/Y',strtotime($task_info->start_date));
			  	}else{
			  		$start_date = '';	
			  	}

			  	if($task_info->due_date > 0){
					$due_date = date('d/m/Y',strtotime($task_info->due_date));
			  	}else{
			  		$due_date = '';	
			  	}

			  	$priority = '--'; 
			  	if($task_info->priority){
			  		$priority = 'Low';
			  	}elseif($task_info->priority){
			  		$priority = 'Medium';
			  	}elseif($task_info->priority){
			  		$priority = 'High';
			  	}elseif($task_info->priority){
			  		$priority = 'Urgent';
			  	}

					$att_array = array(
						'id' => $task_info->id,
						'title' => $task_info->title,
						'description' => $task_info->description,
						'start_date' => $start_date,
						'due_date' => $due_date,					
						'priority' => $priority,
						'status' => $status,
					);	



			  	$return_arr['status'] = true;	
				$return_arr['message'] = "Successfully";
				$return_arr['data'] = $att_array;
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "Record Not Found!";
				$return_arr['data'] = [];
			}

		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];
		}


		header('Content-type: application/json');
		echo json_encode($return_arr);


	}
   //http://35.154.77.171/schach/Task_API/get_view_task?task_id=1




	public function get_task_list()
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


			$where = " where ta.staff_id = '".$user_id."' ";

			if(!empty($from_date) && !empty($to_date)){

				$from_date = str_replace("/","-",$from_date);
				$from_date = date("Y-m-d",strtotime($from_date));
				$from_date = $from_date.' 00:00:00';


				$to_date = str_replace("/","-",$to_date);
				$to_date = date("Y-m-d",strtotime($to_date));
				$to_date = $to_date.' 23:59:59';

				$where .= "and t.created_at between '".$from_date."' and '".$to_date."' ";

			}else{
    
				$f_date = date('Y-m-01').' 00:00:00';
				$f_date = date('Y-m-d').' 23:59:59';

				$where .= "and t.created_at between '".$f_date."' and '".$t_date."' ";

			}

			if(!empty($related_to)){
				$where .= " and t.related_to = '".$related_to."'";				
			}

			$task_info = $this->db->query("SELECT t.*, ta.staff_id from tbltasks as t LEFT JOIN tbltaskusers as ta ON t.id = ta.task_id ".$where." order by id desc ")->result();



			if(!empty($task_info)){
			  		foreach ($task_info as $key => $value) {

			  			if($value->is_repeat == 1){
			  				$repeat = 'Yes';
			  			}else{
			  				$repeat = 'No';
			  			}

			  			if($value->is_repeat == 1){ 
			  				$type = ($value->repeat_type == 1) ? 'Weekly' : 'Monthly';
			  			}else{ 
			  			 	$type = date('d-m-Y',strtotime($value->start_date)).' to '.date('d-m-Y',strtotime($value->due_date));
			  			}

			  			$priority = '--';
						if($value->priority == 1){
							$priority = 'Low';
						}elseif($value->priority == 2){
							$priority = 'Medium';
						}elseif($value->priority == 3){
							$priority = 'High';
						}elseif($value->priority == 4){
							$priority = 'Urgent';
						}

						$files_count = $this->home_model->get_result('tblfiles', array('rel_id'=>$value->id,'rel_type'=>'task'),  array('id'),'');
						if($files_count){
							$count=count($files_count);
						}else{
							$count=0;
						}


						$task_status = get_task_status($value->id);

			  			$att_array[] = array(
								'id' => $value->id,
								'task_title' => $value->title,
								'task_status' => $task_status,
								'repeat' => $repeat,
								'start_due_date' => $type,
								'related_to' => value_by_id('tbltaskfor',$value->related_to,'name'),
								'priority' => $priority,
								'file_count' => $count,
							);	
			  		}

			  		$return_arr['status'] = true;	
					$return_arr['message'] = "Successfully";
					$return_arr['data'] = $att_array;
			}else{
			  		$return_arr['status'] = false;	
					$return_arr['message'] = "Record Not Found!";
					$return_arr['data'] = [];
			}


		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];	
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);

    	
		//http://35.154.77.171/schach/Task_API/get_task_list?user_id=1&related_to=5&from_date=01/05/2019&to_date=31/05/2019
    }



    public function delete_task()
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



		if(!empty($id)){
				
			if($this->home_model->delete('tbltasks', array('id'=>$id))){
				$this->home_model->delete('tbltaskassignees', array('task_id'=>$id)); 
	        	$this->home_model->delete('tbltaskusers', array('task_id'=>$id)); 
	        	$this->home_model->delete('tblnotifications', array('module_id'=>4,'table_id'=>$id)); 


	        	$return_arr['status'] = true;	
				$return_arr['message'] = "Task deleted Successfully";
				$return_arr['data'] = [];	
			}else{
				$return_arr['status'] = false;	
				$return_arr['message'] = "Fail to delete task";
				$return_arr['data'] = [];	
			} 
			
				

		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required parameters are missing";
			$return_arr['data'] = [];	
		}

		header('Content-type: application/json');
		echo json_encode($return_arr);

    	
		//http://35.154.77.171/schach/Task_API/delete_task?id=61
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
		$files = $this->home_model->get_result('tblfiles', array('rel_id'=>$id,'rel_type'=>'task'),  array('id','file_name','filetype','rel_id','rel_type'),'');
		$result=array();
		foreach ($files as $file ) {
			$temp['id']=$file->id;
			$temp['rel_id']=$file->rel_id;
			$temp['file_name']=$file->file_name;
      
			$temp['file_path']=base_url('uploads/tasks/'.$file->rel_id.'/'.$file->file_name);
			array_push($result, $temp);

		}

	    $return_arr['file_list']=$result;
	    header('Content-type: application/json');
		echo json_encode($return_arr);      
   		 //https://schachengineers.com/schacrm_test/Task_API/get_file?id=12&type=task 
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
        $this->db->where('rel_type', 'task');
        $file = $this->db->get('tblfiles')->row();

        if(!empty($file))
        {
	        if ($file->staffid == get_staff_user_id() || is_admin()) {
	        	if(is_dir(get_upload_path_by_type('task') . $file->rel_id))
	        	{
	        		unlink(get_upload_path_by_type('task') . $file->rel_id . '/' . $file->file_name);

	        		$this->db->where('rel_id', $rel_id);
	        		$this->db->where('id', $id);
	            	$this->db->delete('tblfiles');
	            
	            if ($this->db->affected_rows() > 0) {
	                $Deleted['status']=TRUE;
	                $Deleted['msg']="File Deleted Successfully";
	                
	            }

	            if (is_dir(get_upload_path_by_type('task') . $file->rel_id)) {
	                // Check if no attachments left, so we can delete the folder also
	                $other_attachments = list_files(get_upload_path_by_type('task') . $file->rel_id);
	                if (count($other_attachments) == 0) {
	                    // okey only index.html so we can delete the folder also
	                    delete_dir(get_upload_path_by_type('task') . $file->rel_id);
	                }
	            }
	        		
	            }	
	                
	        }
	        else
	        {
	        	$Deleted['status'] =FALSE;
	        	$Deleted['msg']="You dont have permission to delete";
	        }
	    }
	    else{
	    	$Deleted['status'] =FALSE;
	        $Deleted['msg']="File Not Found";
	    }
        header('Content-type: application/json');
		echo json_encode($Deleted);

            
	}

	public function test($id)
	{
		echo get_staff_loan_balance($id);
	}
  
}




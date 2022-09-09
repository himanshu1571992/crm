<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Requests_API extends Clients_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('requests_model');
        $this->load->model('home_model');

    }

    public function index()
    {
        echo 'hello world';
    }


    public function get_requests_categories()


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





	  $categories = $this->home_model->get_result('tblrequestscategories', array('status'=>1), '',array('order','asc'));


	   if(!empty($categories)){


		   foreach($categories as $row){


			   if(!empty($row->requests_category_img)){


				$image = base_url('uploads/requests_category/'.$row->requests_category_img);


			}else{


				$image = '';


			}


			


			


			$array = array(


				'id' => $row->id,	


				'name' => $row->name,	


				'color' => $row->color,	


				'order' => $row->order,	


				'description' => $row->description,	


				'image' => $image,	


			);


			


			$return_arr['category_list'][] = $array;


		   }


	   }else{


		  $return_arr['msg'] = "Record Not Found!"; 


	   }


	   


	   


	   header('Content-type: application/json');


	   echo json_encode($return_arr);


	   //http://bookallservices.com/schach/Requests_API/get_requests_categories


    }





	public function get_request_master()


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





	  $loan_info = $this->home_model->get_result('tblloantenues', array('status'=>1), '',array('order','asc'));


	   if(!empty($loan_info)){


		   foreach($loan_info as $row){


			 			


			$array = array(


				'id' => $row->id,


				'name' => $row->name,


				'order' => $row->order


			);


			


			$return_arr['loan_tenure_list'][] = $array;


		   }


	   }else{


		  $return_arr['loan_tenure_list'] = ""; 


	   }


	   


	   


	   $paymentmode_info = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '','');


	   if(!empty($paymentmode_info)){


		   foreach($paymentmode_info as $row){


			 			


			$array = array(


				'id' => $row->id,


				'name' => $row->name


			);


			


			$return_arr['paymentmode_list'][] = $array;


		   }


	   }else{


		  $return_arr['paymentmode_list'] = ""; 


	   }


	   


	   


	   $branch_info = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '','');


	   if(!empty($branch_info)){


		   foreach($branch_info as $row){


			 			


			$array = array(


				'id' => $row->id,


				'branch_name' => $row->comp_branch_name


			);


			


			$return_arr['branch_list'][] = $array;


		   }


	   }else{


		  $return_arr['branch_list'] = ""; 


	   }


	   


	   


	   header('Content-type: application/json');


	   echo json_encode($return_arr);


	   //http://bookallservices.com/schach/Requests_API/get_request_master


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


			$stafff = array();


			
			//$Staffgroup = get_staff_group(14);
			$Staffgroup =  get_staff_group(14,$user_id);

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


		//http://bookallservices.com/schach/Requests_API/get_group_info?user_id=1


	}


	


	public function get_branch_person()


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


			$user_info = branch_employee($branch_id,$user_id);


			if(!empty($user_info)){


				foreach($user_info as $row){


					$array = array(


						'id' => $row->staffid,


						'name' => $row->firstname,


						'email' => $row->email


					);


					


					$return_arr['user_info'][] = $array;


				}


			}else{


				$return_arr['msg'] = "Record Not Found!"; 


			}


		}


		


		


	   header('Content-type: application/json');


	   echo json_encode($return_arr);


		


		//http://bookallservices.com/schach/Requests_API/get_group_info?user_id=1&branch_id=1


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



		if(!empty($user_id) && !empty($amount) && !empty($category)){


				if(empty($tenure)){
					$tenure = 0;
				}

				if(empty($branch)){
					$branch = 0;
				}


				if(empty($person_id)){
					$person_id = 0;
				}

				if(empty($payment_mode)){
					$payment_mode = 0;
				}

				if(empty($group_ids)){
					$group_ids = '';
				}else{
					$group_ids = json_decode($group_ids);
					$group_ids = implode(',',$group_ids);
				}

				if(!empty($on_behalf) && $on_behalf > 0){
					$addedfrom = $on_behalf;
					$addedby = $user_id;
				}else{
					$addedfrom = $user_id;
					$addedby = 0;	
				}
				

				$ad_data = array(
							'category' => $category,  
							'amount' => $amount,
							'tenure' => $tenure,  
							'branch' => $branch,    
							'person_id' => $person_id,  
							'payment_mode' => $payment_mode,
							'reason' => $reason,
							'description' => $description,
							'group_ids' => $group_ids,
							'date' => date('Y-m-d'),
							'dateadded' => date('Y-m-d H:i:s'),
							'addedfrom' => $addedfrom,
							'addedby' => $addedby,
						);


				$request_id = $this->requests_model->add($ad_data);
				$result_file=handle_multi_expense_attachments($request_id,'request');


				if(!empty($staffid)){
					$staffid = json_decode($staffid);			


					foreach($staffid as $singlelead)
					{
						if($singlelead!=0)
						{
						$prdata['staff_id']=$singlelead;
						$prdata['request_id']=$request_id;
						$prdata['status']=1;
						$prdata['created_at'] = date("Y-m-d H:i:s");
						$prdata['updated_at'] = date("Y-m-d H:i:s");
						$this->db->insert('tblrequestapproval',$prdata);




						//Sending Mobile Intimation
						$token = get_staff_token($singlelead);
						$message = 'Request Send to you for Approval';
						$title = 'Schach';

						$send_intimation = sendFCM($message, $title, $token);
						
							$full_name = get_employee_fullname($user_id);		
							$notified_data = array(
										'description'     => 'Request Send to you for Approval',
										'touserid'        => $singlelead,
										'fromuserid'      => $user_id,
										'module_id'        => 1,
										'type'            => 1,
										'table_id'        => $request_id,
										'category_id'        => $category,
										'link'            => 'requests/request_approval/' . $request_id.'',
										'from_fullname'    => $full_name,
										'date'   		   => date('Y-m-d H:i:s'),


							);	
							$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);

						}
					}
				}


				/*if(($person_id > 0)){			


						$prdata['staff_id']=$person_id;
						$prdata['request_id']=$request_id;
						$prdata['status']=1;
						$prdata['created_at'] = date("Y-m-d H:i:s");
						$prdata['updated_at'] = date("Y-m-d H:i:s");
						$this->db->insert('tblrequestapproval',$prdata);						


						//Sending Mobile Intimation
						$token = get_staff_token($person_id);
						$message = 'Request For Transfer';
						$title = 'Schach';
						$send_intimation = sendFCM($message, $title, $token);		
					

					$full_name = get_employee_fullname($user_id);	


								$notified_data = array(

											'description'     => 'Request For Transfer',
											'touserid'        => $person_id,
											'fromuserid'      => $user_id,
											'module_id'       => 1,
											'type'            => 1,
											'table_id'        => $request_id,
											'category_id'     => $category,
											'link'            => 'requests/request_approval/' . $request_id.'',
											'from_fullname'    => $full_name,
											'date'   		   => date('Y-m-d H:i:s'),
								);	
					$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);

				}*/

                if($request_id) {
					$return_arr['success'] = 'Request Added Successfully';
                }else{
					$return_arr['error'] = 'Fail To Add Request';
				}


		}
		else
		{
			$return_arr['error'] = 'Request Parameters are Missing';

		}


	   header('Content-type: application/json');
	   echo json_encode($return_arr);

		//http://bookallservices.com/schach/Requests_API/add_request?user_id=1&tenure=1500&category=1&tenure=1&branch=1&person_id=2&payment_mode=2&reason=Need Money&description=description&group_ids=1


	}


	


	


	public function get_user_request()
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


		if(!empty($user_id) && !empty($category)){


			//$request_list = $this->home_model->get_result('tblrequests', array('addedfrom'=>$user_id,'category'=>$category,'cancel'=>0), '',array('id','desc'));

			$request_list = $this->db->query("SELECT * FROM `tblrequests` where category = '".$category."' and cancel = 0 and  (addedfrom = '".$user_id."' || addedby = '".$user_id."')  ORDER by id desc")->result();


			   if(!empty($request_list)){

				   foreach($request_list as $row){

					if($row->approved_amount > 0){
						$amount = $row->approved_amount;
					}else{
						$amount = $row->amount;
					}


					$staff_details = $this->home_model->get_result('tblrequestapproval', array('request_id'=>$row->id),  array('staff_id'),'');

					$staff_names = '';


					foreach ($staff_details  as $staffid) {

						$staff_names.=get_employee_fullname($staffid->staff_id).',';

					}


					$staff_names=substr($staff_names, 0, -1);
          			if(empty($staff_names))
					{
						$staff_names="";

					}


					$group_name = '';
					if(!empty($row->group_ids)){
						$group_arr = explode(',',$row->group_ids);

						if(!empty($group_arr)){
							foreach($group_arr as $group_id){
								$group_info = $this->home_model->get_row('tblstaffgroup', array('id'=>$group_id), '');
								if(!empty($group_info)){
									$group_name .= $group_info->name.' ,';
								}
							}
						}						
					}


					$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$row->id,'module_id'=>1,'isread'=>1,'type '=>1),  array('id','readdate','touserid'),'');

					$notification_read_by=array();

					if($get_notification_user_info)
					{
						foreach ($get_notification_user_info as $notification_user) {
							$temp_data['name'] = get_employee_fullname($notification_user->touserid);
							$temp_data['read_date']=$notification_user->readdate;
							array_push($notification_read_by, $temp_data);
						}
					}

					$group_name = rtrim($group_name,",");

					//Getting Category
					$tenure_info = $this->home_model->get_row('tblloantenues', array('id'=>$row->tenure), '');

					if(!empty($tenure_info)){
						$tenure_name = $tenure_info->name;
					}else{
						$tenure_name = '--';

					}

					$on_behalf = '';
					if($row->addedby > 0){
						$on_behalf = get_employee_fullname($row->addedfrom);
					}



					$array = array(
						'id' => $row->id,	
						'amount' => $amount,
						'group_name' => $group_name,
						'reason' => $row->reason,
						'tenure_id' => $row->tenure,
						'tenure_name' => $tenure_name,
						'description' => $row->description,	
						'approved_status' => $row->approved_status,
						'category'=>$category,
						'date' => date('d/m/Y H:i a',strtotime($row->dateadded)),
						'request_names'=>$staff_names,
						'on_behalf'=>$on_behalf,
						'read_by_user' =>$notification_read_by,
					);

					$return_arr['request_list'][] = $array;

				   }

			   }else{
				  $return_arr['msg'] = "Record Not Found!"; 
			   }	

		}

	   header('Content-type: application/json');
	   echo json_encode($return_arr);


	   //http://bookallservices.com/schach/Requests_API/get_user_request?user_id=1&category=1


    }


	


	public function get_single_request()
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


		if(!empty($request_id)){


			$request_info = $this->home_model->get_row('tblrequests', array('id'=>$request_id), '');


			   if(!empty($request_info)){


					$group_name = '';
					if(!empty($request_info->group_ids)){
						$group_arr = explode(',',$request_info->group_ids);
						if(!empty($group_arr)){

							foreach($group_arr as $group_id){
								$group_info = $this->home_model->get_row('tblstaffgroup', array('id'=>$group_id), '');	
								if(!empty($group_info)){
									$group_name .= $group_info->name.' ,';
								}
							}
						}
					}


					if($request_info->cancel==1)
					{
					    $status_cancel="true";
					    $approved_status="3";
					}
					else
					{
					    $status_cancel="false";
					    $approved_status=$request_info->approved_status;
					}

					if(($request_info->approved_status == 1) && ($request_info->manager_approved_status == 0)){
						 $approved_status = 0;
					}


					$approve_info = $this->home_model->get_result('tblrequestapproval', array('request_id'=>$request_id),  array('staff_id','updated_at','approve_status','approvereason'),'');


					$staff_ids = '';
					$staff_dates ='--';
					$approved_id ='0';
					$remark='--';
					foreach ($approve_info  as $staffid) {
						$staff_ids.=$staffid->staff_id.','; 
						if($staffid->approve_status == 1 || $staffid->approve_status == 2 )
						{
							$staff_dates= $staffid->updated_at; 
							$approved_id = $staffid->staff_id;
							$remark = $staffid->approvereason;

						}
					}
					$staff_ids=substr($staff_ids, 0, -1);
					$group_name = rtrim($group_name,",");

					//Getting Category
					$tenure_info = $this->home_model->get_row('tblloantenues', array('id'=>$request_info->tenure), '');
					if(!empty($tenure_info)){
						$tenure_name = $tenure_info->name;
					}else{
						$tenure_name = '--';
					}

					$on_behalf_name = '';
					$on_behalf = '0';
					$on_behalf_branch = '0';
					if($request_info->addedby > 0){
						$on_behalf = $request_info->addedfrom;
						$on_behalf_branch = employee_single_branch($request_info->addedfrom);
						$on_behalf_name = get_employee_fullname($request_info->addedfrom);
					}

					$transfer_to = '--';
					if($request_info->category == 4){
						$transfer_to = get_employee_fullname($request_info->person_id);
					}

					$array = array(
					    'id' => $request_id,
						'request_amount' => $request_info->amount,	
						'approved_amount' => $request_info->approved_amount,
						'group_name' => $group_name,
						'reason' => $request_info->reason,
						'description' => $request_info->description,
						'confirmed_by_user' => $request_info->confirmed_by_user,
						'tenure_id' =>  $request_info->tenure,
						'tenure_name' =>  $tenure_name,
						'category_id' =>  $request_info->category,
						'branch'	=> $request_info->branch,
						'payment_mode'	=> $request_info->payment_mode,
						'group_ids'	=>$request_info->group_ids,
						'person_id' => $request_info->person_id,
						'approved_status' =>$approved_status,
						'cancel_status' =>$status_cancel,
						'confirmed_date' => $request_info->confirmed_date,
						'approved_date' => $staff_dates,
						'staffids' => $staff_ids,
						'remark' => $remark,
						'approved_by' => $full_name = get_employee_fullname($approved_id),
						'date' => date('d/m/Y H:i:s',strtotime($request_info->dateadded)),
						'note' =>$request_info->description,
						'on_behalf_name' =>$on_behalf_name,
						'on_behalf' =>$on_behalf,
						'on_behalf_branch' =>$on_behalf_branch,
						'transfer_to' =>$transfer_to,
					);

					$return_arr['request_info'] = $array;
					$return_arr['msg'] = "Success"; 

					$get_notification_user_info=$this->home_model->get_result('tblnotifications', array('table_id'=>$request_id,'module_id'=>1),  array('id','readdate','touserid','isread'),'');
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


	   //http://bookallservices.com/schach/Requests_API/get_single_request?request_id=1


    }


	


	public function get_request_approved_info()


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


		


		if(!empty($confirmation_remark) && !empty($receive_status) && !empty($request_id)){		


										


					/*$ldata = array(


							'confirmed_by_user' => 1,


							'user_confirmation_remark' => $confirmation_remark,


							'confirmation_payment_mode' => $payment_mode,


							'confirmed_date' => date('Y-m-d',strtotime($confirmed_date)),


					);*/


					


					$ldata = array(


							'confirmed_by_user' => 1,


							'receive_status' => $receive_status,


							'user_confirmation_remark' => $confirmation_remark,


							'confirmation_payment_mode' => $payment_mode,


							'confirmed_date' => date('Y-m-d H:i:s'),


					);


					


					$success = $this->home_model->update('tblrequests',$ldata,array('id'=>$request_id));


					$request_info = $this->home_model->get_row('tblrequests', array('id'=>$request_id), '');


					//Addding in Loan Log


					


					if($receive_status == 1 && $request_info->category == 3){


						$tenure_info = $this->home_model->get_row('tblloantenues', array('id'=>$request_info->tenure), '');


						


						$exist_info = $this->home_model->get_row('tblstaffloanlog',array('request_id'=>$request_info->id));


						


						if(empty($exist_info)){


							if(!empty($tenure_info)){


								


								$part_amount = ($request_info->approved_amount/$tenure_info->installment);


								


								for($i=1; $i <= $tenure_info->installment; $i++){


									$prdata['request_id']=$request_info->id;


									$prdata['staff_id']=$request_info->addedfrom;


									$prdata['amount']=$part_amount;


									$prdata['instalment']=$i;


									$insert_log = $this->db->insert('tblstaffloanlog',$prdata);


								}


							}


						}


						


					}


					if($success){


						$return_arr['success'] = 'Request Confirmed Successfully';


					}else{


						$return_arr['error'] = 'Fail to update';


					}


			


		}else{


			$return_arr['error'] = 'Request Parameters are Missing';


		}


	   


	   header('Content-type: application/json');


	   echo json_encode($return_arr);


	   //http://bookallservices.com/schach/Requests_API/get_request_approved_info?request_id=3&confirmation_remark=Thanks&payment_mode=1&confirmed_date=14-08-2018


    }


	


	public function get_employee_by_branch()


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





		$person_info = branch_employee($branch_id,$user_id);


		if(!empty($person_info)){


			foreach($person_info as $row){


				$array = array(						


						'id' => $row->staffid,	


						'firstname' => $row->firstname,	


						'email' => $row->email


					);


					


			$return_arr['user_info'][] = $array;


			}


		}else{


			$return_arr['msg'] = 'Record Not Found';


		}


		


		header('Content-type: application/json');


	   echo json_encode($return_arr);


		


		//http://bookallservices.com/schach/Requests_API/get_employee_by_branch?branch_id=1&user_id=1


	}		



	public function approve_request()
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

		if(!empty($approve_status) && !empty($remark) && !empty($approved_amount) && !empty($user_id) && !empty($request_id)){
			
			
					if($approve_status == 1 || $approve_status == 3){
						$status = 1;
					}else{
						$status = 2;
					}
					
					$ldata = array(
							'approve_status' => $status,
							'approvereason' => $remark,
							'approved_amount' => $approved_amount,
							'updated_at' => date('Y-m-d H:i:s'),
					);

					$success = $this->home_model->update('tblrequestapproval',$ldata,array('request_id'=>$request_id,'staff_id'=>$user_id));
					$request_info = get_request_info($request_id);		


					$update_data = array(
							'approved_status' => $status,
							'approved_amount' => $approved_amount,
							'approved_remark' => $remark,
					);

					/*if($request_info->category == 4){
						$update_data['receive_status'] = $approve_status;
						$update_data['confirmed_by_user'] = 1;
						$update_data['confirmation_payment_mode'] = $payment_mode;
					}*/


					if($request_info->category == 3){
						if(!empty($tenure_id)){
							$update_data['tenure'] = $tenure_id;
						}

					}

					if($approve_status == 2 || $approve_status == 3){
						$update_data['manager_approved_status'] = 0;
					}	

					$update_request = $this->home_model->update('tblrequests',$update_data,array('id'=>$request_id));			

					if($update_request){	
						if($request_info->category != 4){

							//Approved by pettycash	
							if($approve_status == 3){
								if(!empty($pettycash_id)){
									$pettycahs_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  id = '".$pettycash_id."' ")->row();
									$manager_id = $pettycahs_info->staff_id;

									$add_data = array(
												'request_id'     => $request_id,
												'pettycash_id'   => $pettycash_id,
												'manager_id'     => $manager_id,
												'add_by'       	 => $user_id,
												'add_for'        => $request_info->addedby,
												'amount'         => $approved_amount,												
												'status'    	 => 1,
												'created_at'   	 => date('Y-m-d H:i:s'),
									);	

									$insert = $this->home_model->insert('tblpettycashapproved', $add_data);

									if($insert == true){
										$insert_id = $this->db->insert_id();
										$description = 'Request Approved, Pay by Petty Cash';

										//Sending Mobile Intimation
										$token = get_staff_token($manager_id);
										//$message = 'You Have Request for Approval';
										$title = 'Schach';
										$send_intimation = sendFCM($description, $title, $token);	

										//Adding Notificaion

										$full_name = get_employee_fullname($user_id);
										$notified_data = array(
											'description'     		=> $description,
											'touserid'        		=> $manager_id,
											'fromuserid'      		=> $user_id,
											'module_id'       		=> 9,
											'type'            		=> 1,
											'for_manager_approval'  => 1,
											'table_id'        		=> $insert_id,
											'category_id'     		=> $request_info->category,
											//'link'            => 'requests/request_comfirm/'.$request_id,
											'from_fullname'    		=> $full_name,
											'date'   		   		=> date('Y-m-d H:i:s'),
										);	

										$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);	

									}
								}

							}else{

								if($status==1){
									$description = 'Request Approved Successfully';	
								}else{
									$description = 'Request Decline';	
								}	

								if($request_info->addedby > 0){

									//Sending Mobile Intimation
									$token = get_staff_token($request_info->addedby);
									//$message = 'You Have Request for Approval';
									$title = 'Schach';
									$send_intimation = sendFCM($description, $title, $token);	

									//Adding Notificaion
									$full_name = get_employee_fullname($user_id);	

									$notified_data = array(
												'description'     => $description,
												'touserid'        => $request_info->addedby,
												'fromuserid'      => $user_id,
												'module_id'       => 1,
												'type'            => 2,
												'table_id'        => $request_id,
												'category_id'     => $request_info->category,
												'link'            => 'requests/request_comfirm/'.$request_id,
												'from_fullname'    => $full_name,
												'date'   		   => date('Y-m-d H:i:s'),
									);	

									$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);	

								}

									//Sending Mobile Intimation
									$token = get_staff_token($request_info->addedfrom);
									//$message = 'You Have Request for Approval';
									$title = 'Schach';
									$send_intimation = sendFCM($description, $title, $token);	

									//Adding Notificaion

									$full_name = get_employee_fullname($user_id);
									$notified_data = array(
												'description'     => $description,
												'touserid'        => $request_info->addedfrom,
												'fromuserid'      => $user_id,
												'module_id'       => 1,
												'type'            => 2,
												'table_id'        => $request_id,
												'category_id'     => $request_info->category,
												'link'            => 'requests/request_comfirm/'.$request_id,
												'from_fullname'    => $full_name,
												'date'   		   => date('Y-m-d H:i:s'),
									);	

									$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);	

							}	
					

						}else{
							if($approve_status == 1){
								$person_id = $request_info->person_id;
								//sending notification to person
								if(($person_id > 0)){			


								$prdata['staff_id']=$person_id;
								$prdata['request_id']=$request_id;
								$prdata['status']=1;
								$prdata['created_at'] = date("Y-m-d H:i:s");
								$prdata['updated_at'] = date("Y-m-d H:i:s");
								$this->db->insert('tblrequestapproval',$prdata);						


								//Sending Mobile Intimation
								$token = get_staff_token($person_id);
								$message = 'Request For Transfer';
								$title = 'Schach';
								$send_intimation = sendFCM($message, $title, $token);		


								$full_name = get_employee_fullname($request_info->addedfrom);	


								$notified_data = array(

									'description'     => 'Request For Transfer',
									'touserid'        => $person_id,
									'fromuserid'      => $request_info->addedfrom,
									'module_id'       => 1,
									'type'            => 2,
									'table_id'        => $request_id,
									'category_id'     => $request_info->category,
									'link'            => 'requests/request_approval/' . $request_id.'',
									'from_fullname'    => $full_name,
									'date'   		   => date('Y-m-d H:i:s'),
								);	
								$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);

								}
							}
						}							


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


		//https://schachengineers.com/schacrm_test/Requests_API/approve_request?user_id=1&approve_status=3&remark=Approved&approved_amount=500&request_id=1&pettycash_id=1


	}


	public function request_cancel()


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


			//echo $cancle_status;


			


			if(!empty($request_id) && !empty($user_id))


			{


				$ldata = array(


							'cancel' => $cancel_status,


							);


					


				$update_request = $this->home_model->update('tblrequests',$ldata,array('id'=>$request_id));





			if($update_request){


		         $this->db->where('table_id', $request_id);


            $this->db->where('module_id',1);


   		    	$this->db->delete('tblnotifications');


				// 		$request_info = get_request_info($request_id);


						


				// 		//Sending Mobile Intimation


				// 		$token = get_staff_token($request_info->addedfrom);


				// 		$message = 'You Have Request for Cancel';


				// 		$title = 'Schach';


				// 		$send_intimation = sendFCM($message, $title, $token);


						


						


						


				// 		//Adding Notificaion


				// 		if($cancle_status==0){


				// 			$description = 'Cancel Successfully';	


				// 		}else{


				// 			$description = 'Request Decline';	


				// 		}


						


				// 		$full_name = get_employee_fullname($user_id);		


				// 				$notified_data = array(


				// 							'description'     => $description,


				// 							'touserid'        => $request_info->addedfrom,


				// 							'fromuserid'      => $user_id,


				// 							'module_id'       => 1,


				// 							'type'            => 2,


				// 							'table_id'        => $request_id,


				// 							'category_id'     => $request_info->category,


				// 							'from_fullname'    => $full_name,


				// 							'date'   		   => date('Y-m-d H:i:s'),


				// 				);		


										


				// 				$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);			


									


							





						$return_arr['status'] = true;	


						$return_arr['message'] = "Request Cancelled successfully";


						$return_arr['data'] = '';		


						


					}


			}else{


			$return_arr['status'] = false;	


			$return_arr['message'] = "Required Parameters are messing";


			$return_arr['data'] = '';


		}


		


		header('Content-type: application/json');


	    echo json_encode($return_arr);


			//http://bookallservices.com/schach/Requests_API/request_cancel?user_id=1&cancel_status=1&request_id=1


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


		


		


		if(!empty($user_id)  && !empty($amount) && !empty($category) && !empty($request_id)){


			


			if(empty($tenure)){


					$tenure = 0;


				}


				


				if(empty($branch)){


					$branch = 0;


				}


                


				if(empty($person_id)){


					$person_id = 0;


				}


				


				if(empty($payment_mode)){


					$payment_mode = 0;


				}


				


				if(empty($group_ids)){


					$group_ids = '';


				}else{


					$group_ids = json_decode($group_ids);


					


					$group_ids = implode(',',$group_ids);


				}


				if(!empty($on_behalf) && $on_behalf > 0){
					$addedfrom = $on_behalf;
					$addedby = $user_id;
				}else{
					$addedfrom = $user_id;
					$addedby = 0;	
				}	
				


				$ad_data = array(


							'category' => $category,                              


							'amount' => $amount,                               


							'tenure' => $tenure,                               


							'branch' => $branch,                               


							'person_id' => $person_id,                               


							'payment_mode' => $payment_mode,                               


							'reason' => $reason,                               


							'description' => $description,                               


							'group_ids' => $group_ids,                               


							'date' => date('Y-m-d'),                               


							'dateadded' => date('Y-m-d H:i:s'),                               


							'addedfrom' => $addedfrom,

							'addedby' => $addedby


						);


						


				$success = $this->requests_model->update($ad_data,$request_id);			


						


				if(!empty($staffid)){


					$staffid = json_decode($staffid);


					//$this->db->where('request_id', $id);


					$this->db->where('request_id', $request_id);


					$this->db->delete('tblrequestapproval');





					$this->db->where('table_id', $request_id);


					$this->db->where('module_id',1);


					$this->db->delete('tblnotifications');    


					foreach($staffid as $singlelead)


					{


						if($singlelead!=0)


						{


						$prdata['staff_id']=$singlelead;


						$prdata['request_id']=$request_id;


						$prdata['status']=1;


						$prdata['created_at'] = date("Y-m-d H:i:s");


						$prdata['updated_at'] = date("Y-m-d H:i:s");


						$this->db->insert('tblrequestapproval',$prdata);


						


						//Sending Mobile Intimation


						$token = get_staff_token($singlelead);


						$message = 'Updated Request Send to you for Approval';


						$title = 'Schach';


						$send_intimation = sendFCM($message, $title, $token);


						


							


							$full_name = get_employee_fullname($user_id);		


							$notified_data = array(


										'description'     => 'Request Send to you for Approval',


										'touserid'        => $singlelead,


										'fromuserid'      => $user_id,


										'module_id'       => 1,


										'type'            => 1,


										'table_id'        => $request_id,


										'category_id'     => $category,


										'link'            => 'requests/request_approval/' . $request_id.'',


										'from_fullname'   => $full_name,


										'date'   		  => date('Y-m-d H:i:s'),


							);		


									


							$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);			


							


						}


					}


				}


				


				


				


                if($request_id) {


					$return_arr['success'] = 'Request Updated Successfully';                  


                }else{


					$return_arr['error'] = 'Fail To Add Request';


				}


			


						


		}

	   header('Content-type: application/json');
	   echo json_encode($return_arr);

		//http://bookallservices.com/schach/Requests_API/add_request?user_id=1&amount=1500&category=1&tenure=1&branch=1&person_id=2&payment_mode=2&reason=Need Money&description=description&group_ids=1
	}


	


	function get_pending_request()


	{


		if(!empty($_GET))


		{


			extract($this->input->get());	


		}


		elseif(!empty($_POST)) 

		{

			extract($this->input->post());

		} 


		if(!empty($category) && !empty($user_id))

		{	


			//$check = $this->home_model->get_row('tblrequests', array('confirmed_by_user'=>0,'category'=>$category,'cancel'=>0,'approved_status'=>0,'addedfrom'=>$user_id), '');


			$check = $this->home_model->get_row('tblrequests', array('confirmed_by_user'=>0,'cancel'=>0,'approved_status'=>0,'addedfrom'=>$user_id), '');


				


				if(!empty($check)){


					$return_arr['status'] = "false";


					$return_arr['mgs'] = 'Your request is already in process with this Category';


				}else{


					


					if($category != 4){


						/*$check = $this->home_model->get_row('tblrequests', array('confirmed_by_user'=>0,'category'=>$category,'cancel'=>0,'approved_status'=>1,'addedfrom'=>$user_id), '');*/


						$check = $this->home_model->get_row('tblrequests', array('confirmed_by_user'=>0,'cancel'=>0,'approved_status'=>1,'manager_approved_status'=>1,'addedfrom'=>$user_id), '');


						if($check)


						{


							$return_arr['status'] = "false";


							$return_arr['mgs'] = 'Your request is Approved.Confirmed Approved Request';


						}


						else


						{


							$return_arr['status'] = "true";


							$return_arr['msg'] = 'Can Add New request';


						}


					}else{


						$return_arr['status'] = "true";


						$return_arr['msg'] = 'Can Add New request';


					}


					


				}					


		}





		header('Content-type: application/json');


	   	echo json_encode($return_arr);


		// http://bookallservices.com/schach/Requests_API/get_pending_request?category=1&user_id=1


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


        $this->db->where('rel_type', 'request');


        $file = $this->db->get('tblfiles')->row();





        if(!empty($file))


        {


	        if ($file->staffid == get_staff_user_id() || is_admin()) {


	        	if(is_dir(get_upload_path_by_type('request') . $file->rel_id))


	        	{


	        		unlink(get_upload_path_by_type('request') . $file->rel_id . '/' . $file->file_name);





	        		$this->db->where('rel_id', $rel_id);


	        		$this->db->where('id', $id);


	            	$this->db->delete('tblfiles');


	            


	            if ($this->db->affected_rows() > 0) {


	                $Deleted['status']=TRUE;


	                $Deleted['msg']="File Deleted Successfully";


	                


	            }





	            if (is_dir(get_upload_path_by_type('expense') . $file->rel_id)) {


	                // Check if no attachments left, so we can delete the folder also


	                $other_attachments = list_files(get_upload_path_by_type('request') . $file->rel_id);


	                if (count($other_attachments) == 0) {


	                    // okey only index.html so we can delete the folder also


	                    delete_dir(get_upload_path_by_type('request') . $file->rel_id);


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


 public function resend_approve_notification()


	{





		if(!empty($_GET))


		{


			extract($this->input->get());	


		}


		elseif(!empty($_POST)) 


		{


			extract($this->input->post());


		}





		if(!empty($user_id) && !empty($request_id))


        {


        


        $this->db->where('table_id', $request_id);


        $this->db->where('fromuserid',$user_id);


        $this->db->where('module_id',1);


   		$this->db->delete('tblnotifications');


        


        $request_info = get_request_info($request_id);


		$full_name = get_employee_fullname($user_id);		


								


		$notified_data = array(


								'description'     => 'Request Approved Successfully',


								'touserid'        => $request_info->addedfrom,


								'fromuserid'      => $user_id,


								'module_id'       => 1,


								'type'            => 2,


								'table_id'        => $request_id,


								'category_id'     => $request_info->category,


								'link'            => 'requests/request_comfirm/'.$request_id,


								'from_fullname'    => $full_name,


								'date'   		   => date('Y-m-d H:i:s'),


							);		


							


			$insert_notified = $this->home_model->insert('tblnotifications', $notified_data);			


			$return_arr['status']=TRUE;


	        $return_arr['msg']="Notification Send Successfully";				


	    }


		else


		{


	    	$return_arr['status'] =FALSE;


	        $return_arr['msg']="File Not Found";


	    }


        header('Content-type: application/json');


		echo json_encode($return_arr);





		//http://localhost/schach/Requests_API/resend_approve_notification?user_id=1&request_id=51


	}

}
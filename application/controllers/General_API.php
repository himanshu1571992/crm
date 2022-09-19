<?php



defined('BASEPATH') or exit('No direct script access allowed');


require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class General_API extends CRM_Controller

{

    public function __construct()

    {

        parent::__construct();         

        $this->load->model('home_model');

        $this->load->model('staff_model');

		$this->load->model('requests_model');

		$this->load->model('expenses_model');

		$this->load->model('leaves_model');

    }



    public function get_notifications()
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

		  

		  if(empty($from_date)){
			$from_date = '';  
		  }

		  

		  if(empty($to_date)){
			$to_date = '';  
		  }

		  

		   //$notification_info = $this->home_model->get_result('tblnotifications', array('touserid'=>$user_id,'module_id >'=>0,'table_id >'=>0), '',array('date','desc'));

		   
		    if(empty($overall_pending)){
		   		$overall_pending = 0;
		    }

		    /*if(!isset($offset)){
		    	$offset = 'blank';
		    }*/
		    $notification_info = get_notifications($user_id,$from_date,$to_date,$overall_pending);

			

			if(!empty($notification_info)){

				foreach($notification_info as $row){

				  
				if($row->module_id == 4){
					$category_name = 'Task';
				}elseif($row->module_id == 5){
					$category_name = 'Reminder';
				}elseif($row->module_id == 7){
					$category_name = 'Lead';
				}elseif($row->module_id == 8 || $row->module_id == 9){
					$category_name = 'Petty Cash Manager';
				}elseif(($row->module_id == 10 || $row->module_id == 11) && $row->category_id == 1 ){
					$category_name = 'Delivery Challan';
				}elseif(($row->module_id == 10 || $row->module_id == 11) && $row->category_id == 2 ){
					$category_name = 'Pickup Challan';
				}elseif($row->module_id == 12){
					$category_name = 'Document Handover';
				}elseif($row->module_id == 13){
					$category_name = 'Trip';
				}
				else{
					$category_name = get_any_category_name($row->module_id,$row->category_id);
				}
				

				$wallet_amount = wallet_amount($row->fromuserid,'','');

				if($row->fromuserid > 0){

					$from = get_employee_info($row->fromuserid)->firstname;

				}else{

					$from = '--';

				}



				$profile = $this->staff_model->get($row->fromuserid);

				$profile_image = '';
				if(!empty($profile->profile_image)){

					$profile_image = base_url('uploads/staff_profile_images/'.$row->fromuserid.'/'.$profile->profile_image);

				}

				

				$confirmed_by_user ="0";

				$receive_status ="0";

				



				$approved_status = '--';	

        

				if($row->module_id == 1)
				{

					$request_info = $this->home_model->get_row('tblrequests', array('id'=>$row->table_id), '');

					$approved_status=$request_info->approved_status;

					$confirmed_by_user =$request_info->confirmed_by_user;                                                          

					$receive_status =$request_info->receive_status;                                                          

				}	

				if($row->module_id == 2)
				{
					$request_info = $expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$row->table_id), '');
					$approved_status=$request_info->approved_status;
				}

				if($row->module_id == 3)
				{
					$request_info = $leave_info = $this->home_model->get_row('tblleaves', array('id'=>$row->table_id), '');
					$approved_status=$request_info->approved_status;
				}

				if($row->module_id == 5)
				{
					$reminder_info = $leave_info = $this->home_model->get_row('tblreminder', array('id'=>$row->table_id), '');
					$approved_status=$reminder_info->completed;
				}

				if($row->module_id == 8)
				{
					$pettycash_info = $this->home_model->get_row('tblpettycashmaster', array('id'=>$row->table_id), '');
					$approved_status=$pettycash_info->staff_confirmed;		

				}

				if($row->module_id == 9)
				{					
					if($row->for_manager_approval == 1){
						$pettycashrequest_info = $this->home_model->get_row('tblpettycashapproved', array('id'=>$row->table_id), '');
						$approved_status=$pettycashrequest_info->approved_status;

						$confirmed_by_user = value_by_id_empty('tblrequests',$pettycashrequest_info->request_id,'confirmed_by_user');
						
						$receive_status = value_by_id_empty('tblrequests',$pettycashrequest_info->request_id,'receive_status');

					}else{
						$pettycashrequest_info = $this->home_model->get_row('tblpettycashrequest', array('id'=>$row->table_id), '');
						$approved_status=$pettycashrequest_info->approved_status;				
						$confirmed_by_user =$pettycashrequest_info->confirmed_by_user;
						$receive_status =$pettycashrequest_info->receive_status;	
					}
				}

				if($row->module_id == 10)
				{
					$challanprocess_info = $this->home_model->get_row('tblchallanprocess', array('id'=>$row->table_id), '');

					//if($challanprocess_info->delivery_person_id > 0 && $challanprocess_info->driver_id > 0 && $challanprocess_info->scaffolder_id > 0){
					if($challanprocess_info->delivery_person_id > 0 && $challanprocess_info->driver_id > 0){
						$approved_status = '1';
					}else{
						$approved_status = '0';
					}
				}

				if($row->module_id == 11)
				{
					$challanprocess_info = $this->home_model->get_row('tblchallanprocess', array('id'=>$row->table_id), '');

					if($challanprocess_info->complete > 0){
						$approved_status = '1';
					}else{
						$approved_status = '0';
					}
				}

				if($row->module_id == 12)
				{
					$handoverlog_info = $this->home_model->get_row('tblhandoverlog', array('id'=>$row->table_id), '');

					$approved_status = $handoverlog_info->received_status;
				}

				if($row->module_id == 13)
				{
					$trip_info = $this->home_model->get_row('tblchallantrip', array('id'=>$row->table_id), '');
					$confirm_count = 0;
					$challan_count = 0;
					$approved_status = '0';
					if(!empty($trip_info)){
						$challan_arr = explode(',',$trip_info->challan_ids); 
												
						if(!empty($challan_arr)){
							foreach($challan_arr as $process_id){ 
								$process_info = $this->db->query("SELECT * FROM tblchallanprocess WHERE id = '".$process_id."'")->row();
								
								if(!empty($process_info)){
									$challan_count++;
									if($process_info->complete == 1){
										$approved_status = "3";
										$confirm_count++;
									}
								}
							}
							if($confirm_count == $challan_count){
								$approved_status = "1";
							}
						}
					}

				}

				/*echo '<pre/>';
				print_r($request_info);
				echo '<br><br><br><br><br>';*/

				if(!empty($request_info->cancel) && ($request_info->cancel==1))

					{

						$status_cancel="true";

						$confirmed_by_user = "0";                                            

					}

					else

					{

						$status_cancel="false";

					}

       

				if($approved_status==null)

					{

						$approved_status="3";

					}

				

           

				if($approved_status=="1" && $status_cancel=="true")

					{

						$approved_status="3";

					}

				if($approved_status=="2")

					{

						$confirmed_by_user = "0";

					}

				if($confirmed_by_user == null)

					{

					  $confirmed_by_user ="0";

					}

					

				$advance_amt = get_staff_advance_salary_month($row->fromuserid);

				$loan_amt = get_loan_installment($row->fromuserid);

					if($loan_amt==null)

					{

					  $loan_amt=0;

					}





				$expense_date = '';

				if($row->module_id == 2){

					$exp_info = $this->home_model->get_row('tblexpenses', array('id'=>$row->table_id), '');

					if(!empty($exp_info)){

						$expense_date = date('d-m-Y',strtotime($exp_info->date));

					}

				}

				
				//$expense_amt_info = $this->db->query("SELECT   COALESCE(SUM(amount),0) as ttl_amt from `tblexpenses` where addedfrom = '".$row->fromuserid."' and approved_status = 0 and save_status = 0 and status = 1 and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ")->row();

				$expense_amt_info = $this->db->query("SELECT   COALESCE(SUM(amount),0) as ttl_amt from `tblexpenses` where (addedfrom = '".$row->fromuserid."' || paidby_employee = '".$row->fromuserid."') and (paidby_employee = '0' || paidby_employee = '".$row->fromuserid."') and approved_status = 0 and save_status = 0 and status = 1 and MONTH(date) = '".date('m')."' and YEAR(date) = '".date('Y')."' ")->row();



				//For Task Status
				if($row->module_id == 4)
				{

					/*$taskapproval_info = $this->home_model->get_row('tbltaskassignees', array('task_id'=>$row->table_id,'staff_id'=>$user_id), '');

					if(!empty($taskapproval_info)){
						$approved_status = $taskapproval_info->task_status;
					}else{
						$approved_status = 0;
					}*/	

					$approved_status = get_task_status($row->table_id);				

				}
				

				$array = array(

					'id' => $row->id,	

					'old_id' => $row->old_id,	

					'isread' => $row->isread,	

					'message' => $row->description,	

					'module_id' => $row->module_id,	

					'table_id' => $row->table_id,	

					'category_id' => $row->category_id,	

					'type' => $row->type,	

					'from' => $from,

					'profile_image' => $profile_image,	

					'category_name' => $category_name,

					'data' => _d($row->date),
					//'data' => $row->date,

					'cancel_status' => $status_cancel,

					'approved_status' =>$approved_status,

					'confirmed_by_user' =>$confirmed_by_user,                            

					'receive_status' =>$receive_status,                            

					'wallet_amount' => number_format($wallet_amount, 2, '.', ''),

					'advance_amt'=>$advance_amt,

					'loan_amt'=>$loan_amt,

					'expense_date'=>$expense_date,

					'expense_amt'=>$expense_amt_info->ttl_amt,

					'for_manager_approval' => $row->for_manager_approval,	

				);

				

				$return_arr['notification_list'][] = $array;

			   }

		   }else{

			  $return_arr['msg'] = "Record Not Found!"; 

		   }

	  }else{

		   $return_arr['error'] = "Required Parameters are messing";

	  }	

	 

	   

	   

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //http://bookallservices.com/schach/General_API/get_notifications?user_id=2

    }

	



	public function update_notifications()

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

		  

		   $notification_details = $this->home_model->get_row('tblnotifications', array('id'=>$id), '');

			

		   if($notification_details->isread == 0){

			   $notification_update = $this->home_model->update('tblnotifications', array('isread'=>1,'readdate'=>date('Y-m-d H:i:s')), array('id'=>$id));

		   }	

		   

		   

			$return_arr['status'] = true;	

			$return_arr['message'] = "Record Updated Successfully";

			$return_arr['data'] = '';

		   

	  }else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

	  }	

	 

	   

	   

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //http://bookallservices.com/schach/General_API/update_notifications?id=2

    }

		

	

	public function get_wallet_amount()

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

			

			

			$arr = array();

			

			if(empty($from_date)){

				$from_date = '';

			}

			if(empty($to_date)){

				$to_date = '';

			}

			

			$expense_info = get_wallet_expenses($user_id,$from_date,$to_date);			

			$request_info = get_wallet_request($user_id,$from_date,$to_date);	

			

			$transfer_less_info = get_wallet_transfer_less($user_id,$from_date,$to_date);

			$transfer_add_info = get_wallet_transfer_add($user_id,$from_date,$to_date);

			

			if(!empty($expense_info)){

				 foreach($expense_info as $expense){

					

					if($expense->parent_id > 0){

						 $expense_approval  = get_expense_approval($expense->parent_id);

					 }else{

						$expense_approval  = get_expense_approval($expense->id); 

					 }

					 

					 if(!empty($expense_approval)){

						 $expense_s_date = date('d M, y',strtotime($expense_approval->created_at)); 

						 $expense_a_date = date('d M, y',strtotime($expense_approval->updated_at));

						 $approved_by = get_employee_fullname($expense_approval->staff_id);						 

					}else{ 

						 $expense_s_date = '--'; 

						 $expense_a_date = '--'; 

						 $approved_by = '--'; 

					}

					 

					 

						 if($user_id == $expense->addedfrom){

							 $added_by = 'Self';

						 }else{

							 $added_by = get_employee_fullname($expense->addedfrom);

						 }

					 

					 

					 $arr['expense_info'][] = array(

					 		'id' => $expense->id,

							'name' => get_expense_category($expense->category),

							'added_by' => $added_by,

							'submit_date' => $expense_s_date,

							'approved_date' => $expense_a_date,

							'approved_by' => $approved_by,

							'submit_amount' => $expense->amount,

							'approved_amount' => $expense->amount,

					 );

				 }

			 }else{

				$arr['expense_info'] = array(); 

			 }

			

			

			 if(!empty($request_info)){

				 foreach($request_info as $request){

					$request_approval  = get_request_approval($request->id); 

					 

					 if(!empty($request_approval)){

						 $expense_s_date = date('d M, y',strtotime($request_approval->created_at)); 

						 $expense_a_date = date('d M, y',strtotime($request_approval->updated_at));

						 $approved_by = get_employee_fullname($request_approval->staff_id);						 

					}else{ 

						 $expense_s_date = '--'; 

						 $expense_a_date = '--'; 

						 $approved_by = '--'; 

					}

					 

					$arr['request_info'][] = array(

							'id' => $request->id,

							'name' => get_request_category($request->category),

							'added_by' => 'Self',

							'submit_date' => $expense_s_date,

							'approved_date' => $expense_a_date,

							'approved_by' => $approved_by,

							'submit_amount' => $request->amount,

							'approved_amount' => $request->approved_amount,

					 );

					 

				 }

			 }else{

				$arr['request_info'] = array(); 

			 }

			 

			 

			 if(!empty($transfer_less_info) || !empty($transfer_add_info)){

				

				if(!empty($transfer_less_info)){

					foreach($transfer_less_info as $request){

					 

						$expense_s_date = date('d M, y',strtotime($request->created_at)); 

						 $expense_a_date = date('d M, y',strtotime($request->updated_at));

						 $approved_by = get_employee_fullname($request->staff_id);	

						 

						$arr['wallet_transfer_info'][] = array(

								'id' => $request->id,

								'name' => get_request_category($request->category),

								'added_by' => 'Self',

								'submit_date' => $expense_s_date,

								'approved_date' => $expense_a_date,

								'approved_by' => $approved_by,

								'submit_amount' => $request->amount,

								'approved_amount' => $request->approved_amount,

								'type' => 0

						 );

						 

					}

				}

				

				if(!empty($transfer_add_info)){

				 foreach($transfer_add_info as $request){

					 

					$expense_s_date = date('d M, y',strtotime($request->created_at)); 

					 $expense_a_date = date('d M, y',strtotime($request->updated_at));

					 $approved_by = get_employee_fullname($request->staff_id);	

					 

					$arr['wallet_transfer_info'][] = array(

							'id' => $request->id,

							'name' => get_request_category($request->category),

							'added_by' => 'Self',

							'submit_date' => $expense_s_date,

							'approved_date' => $expense_a_date,

							'approved_by' => $approved_by,

							'submit_amount' => $request->amount,

							'approved_amount' => $request->approved_amount,

							'type' => 1

					 );

					 

				 }

			 }

				

			 }else{

				$arr['wallet_transfer_info'] = array(); 

			 }

			 

			

			

			

		    $wallet_amount = wallet_amount($user_id,$from_date,$to_date);

			 $advance_amt = get_staff_advance_salary_month($user_id);

		    $loan_installment = get_loan_installment($user_id);

		    

		   $department_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  staff_id = '".$user_id."' and staff_confirmed = 1 and status = 1")->row();

			$pettycash_manager_balance = 0;
			if(!empty($department_info)){
				$pettycash_manager_balance = $department_info->amount;
			} 

		    

		    if($loan_installment==null)

		    {

		    	$loan_installment=0;

          $loan_amount=0;

		    }

        else

		    {

  	    	$check_loan_taken = $this->home_model->get_row('tblstaffloanlog', array('staff_id'=>$user_id,'status'=>0),  array('staff_id','request_id'),'');

  	    	if(!empty($check_loan_taken)){
  	    		$get_loan_amount = $this->home_model->get_row('tblrequests', array('addedfrom'=>$user_id,'id'=>$check_loan_taken->request_id),  array('addedfrom','approved_amount'),'');
  	    	}
  				

  

  				if(!empty($get_loan_amount))

  				{

  					if($get_loan_amount->approved_amount==null)

				    {

				      	$loan_amount=0;

				    }

            else

            {

              $loan_amount=$get_loan_amount->approved_amount;

            }

  				}

  				else

  				{

  					$loan_amount=0;

  				}

		    }

			$arr['wallet_amount'] = number_format($wallet_amount, 2, '.', '');

			$arr['advance_amt'] = number_format($advance_amt, 2, '.', '');

			$arr['loan_amount'] =	number_format($loan_amount, 2, '.', '');

			$arr['pettycash_manager_balance'] =	number_format($pettycash_manager_balance, 2, '.', '');

			$arr['loan_installment'] =  $loan_installment;

				

			

			$return_arr['status'] = true;	

			$return_arr['message'] = "Successfully";

			$return_arr['data'] = $arr;

			  

		  }else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Required Parameters are messing";

				$return_arr['data'] = '';

		  }

		  

		  

		  header('Content-type: application/json');

	   echo json_encode($return_arr);



		//http://bookallservices.com/schach/General_API/get_wallet_amount?user_id=1&from_date=01-08-2018&to_date=31-08-2018

	}

	

	

	

	/* When staff change his password */

    public function change_password_profile()

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

		

		

		if(!empty($user_id) && !empty($oldpassword) &&  !empty($newpassword)){

		

		

			$data = array(

				'oldpassword' => $oldpassword,

				'newpasswordr' => $newpassword,

			);

		





            $response = $this->staff_model->change_password($data, $user_id);

            if (is_array($response) && isset($response[0]['passwordnotmatch'])) {

                $message = _l('staff_old_password_incorrect');

            } else {

                if ($response == true) {

                    $message = _l('staff_password_changed');

                } else {

                    $message = _l('staff_problem_changing_password');

                }

            }

			

       

			$return_arr['status'] = true;	

			$return_arr['message'] = $message;

			$return_arr['data'] = '';	

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters are messing";

			$return_arr['data'] = '';

		}

		

		

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   

	   

	   //http://bookallservices.com/schach/General_API/change_password_profile?user_id=1&oldpassword=1111111&newpassword=123456

    }

	

	public function get_profile()
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
			$row = $this->staff_model->get($user_id);			
			if($row->active == 1){
				$profile_image = '';
				if(!empty($row->profile_image)){
					$profile_image = base_url('uploads/staff_profile_images/'.$user_id.'/'.$row->profile_image);
				}


				//check if attendace is marked 
	             $today_attendance = $this->db->query("SELECT * from tblstaffattendance where  staff_id = '".$user_id."' and date = '".date('Y-m-d')."' ")->row();
	             $today_attendance_status = 0;   
	             if(!empty($today_attendance)){
	                if($today_attendance->status > 0){
	                    $today_attendance_status = $today_attendance->status;
	                }
	                
	             }

	            $working_from = date('Y-m-d').' '.$row->working_from.':00';
	            $working_to = date('Y-m-d').' '.$row->working_to.':00';

	            if(empty($today_attendance) || $today_attendance->status == 0){
	            	if((date('Y-m-d H:i:s') >= $working_from) && (date('Y-m-d H:i:s') <= $working_to)){
		            	$today_attendance_status = $today_attendance_status;
		            }else{
		            	$today_attendance_status = '7'; // popup was showing from 12 am 
		            }	
	            }
	            
	            if(date("D") == 'Sun'){
	            	$today_attendance_status = '7';
	            }

	            $leave_taken_info = $this->db->query("SELECT * FROM `tblleaves` where addedfrom = '".$user_id."' and (from_date >= '".date("Y-m-d")."' && to_date <= '".date("Y-m-d")."') and approved_status != 2 ")->row();
	            $holiday_info = $this->db->query("SELECT * FROM `tblholidays` WHERE `date` = '".date("Y-m-d")."' and status = 1 ")->row();
	            if(!empty($leave_taken_info) || !empty($holiday_info)){
	            	$today_attendance_status = '7';
	            }



				$pending_request = get_last_requets_expense_pending($user_id);
				$conf_pending = get_confim_requet_pending($user_id);
				$pending_task = get_pending_task_msg($user_id);
				$unread_notificatons = get_unread_notifications_count($user_id);
				$pending_notificatons = $unread_notificatons;
				//$pending_notificatons = get_pending_notifications_count($user_id);
				$pending_approval_notifications=get_approval_counts_app($user_id);

				$challan_manage_info = $this->db->query("SELECT * FROM `tblcompanybranch` WHERE `challan_manage_id` = '".$user_id."' ")->row();
				if(!empty($challan_manage_info) || $row->admin == 1){
					$challan_manager = 1;
				}else{
					$challan_manager = 0;
				}



				$department_info  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  staff_id = '".$user_id."' and staff_confirmed = 1 and status = 1")->row();

				$pettycash_manager_balance = '0.00';
				if(!empty($department_info)){
					$pettycash_manager = 1;
					$pettycash_manager_balance = $department_info->amount;
				}else{
					$pettycash_manager = 0;
				}

				$purchase_permission = 0;
				$purchase_permission_info  = $this->db->query("SELECT * FROM tblmenuassigned WHERE  staff_id = '".$user_id."' and menu_id = 34")->row();
				if(!empty($purchase_permission_info)){
					$purchase_permission = 1;
				}

				$page_permission = array(
					'purchase' => $purchase_permission
				);
				

				//Get Wallet Details
				$wallet_amount = wallet_amount($user_id,'','');
				$advance_amt = get_staff_advance_salary_month($user_id);
				$loan_installment = get_loan_installment($user_id);

						    

				if($loan_installment==null){
					$loan_installment='0';
					$loan_amount='0';
				}else{
					$check_loan_taken = $this->home_model->get_row('tblstaffloanlog', array('staff_id'=>$user_id,'status'=>0),  array('staff_id','request_id'),'');

					if(!empty($check_loan_taken)){
						$get_loan_amount = $this->home_model->get_row('tblrequests', array('addedfrom'=>$user_id,'id'=>$check_loan_taken->request_id),  array('addedfrom','approved_amount'),'');
					}

					if(!empty($get_loan_amount)){

						if($get_loan_amount->approved_amount==null){
							$loan_amount='0';
						}else{
							$loan_amount=$get_loan_amount->approved_amount;
						}
					}else{
						$loan_amount='0';
					}
				}

				$array = array(
						'id' => $row->staffid,
						'email' => $row->email,
						'full_name' => $row->full_name,
						'pan_card_no' => $row->pan_card_no,
						'adhar_no' => $row->adhar_no,	
						'epf_no' => $row->epf_no,	
						'epic_no' => $row->epic_no,	
						'bank_name' => $row->bank_name,	
						'account_no' => $row->account_no,	
						'ifsc_code' => $row->ifsc_code,	
						'designation' => get_designation($row->designation_id),	
						'designation_id' => $row->designation_id,	
						'permenent_address' => $row->permenent_address,	
						'permenent_state' => get_state($row->permenent_state),	
						'permenent_city' => get_city($row->permenent_city),	
						'residential_address' => $row->residential_address,	
						'residential_state' => get_state($row->residential_state),	
						'residential_city' => get_city($row->residential_city),	
						'phonenumber' => $row->phonenumber,	
						'user_id' => $row->user_id,
						'profile_image' => $profile_image,
						'birth_date' => _d($row->birth_date),
						'actual_birth_date' => _d($row->actual_birth_date),
						'joining_date' => date('d/m/Y',strtotime($row->joining_date)),
						'pending_request' => $pending_request,
						'confirm_request_msg' => $conf_pending,
						'pending_task' => $pending_task,
						'pettycash_manager' => $pettycash_manager,					
						'pettycash_manager_balance' => $pettycash_manager_balance,
						'wallet_amount' => number_format($wallet_amount, 2, '.', ''),
						'advance_amt' => number_format($advance_amt, 2, '.', ''),
						'loan_amount' => number_format($loan_amount, 2, '.', ''),
						'loan_installment' => number_format($loan_installment, 2, '.', ''),
						'admin' => $row->admin,
						'secret_key' => $row->password,
						'challan_manager' => $challan_manager,
						'unread_notificatons' => $unread_notificatons,
						'pending_notificatons' => $pending_notificatons,
						'page_permission' => $page_permission,
						'announcement_msg' => "",
						'announcement_arr' => app_announcement(),
						'pending_approval_notifications'=>$pending_approval_notifications,
						'today_attendance_status'=>$today_attendance_status,
						'show_production_menu' => checkMenuPermission($user_id,'production'),
						'show_onbehalf_option' => checkMenuPermission($user_id,'on_behalf')
					);

					

					

					$return_arr['status'] = true;	
					$return_arr['message'] = "Success";
					$return_arr['data'] = $array;
			}else{
				$return_arr['status'] = false;
				$return_arr['message'] = "Inactive User";
				$return_arr['data'] = null;
			}					

		}else{

			$return_arr['status'] = false;
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
		}

		 header('Content-type: application/json');
		 echo json_encode($return_arr);
		//http://schachengineers.com/schacrm_test/General_API/get_profile?user_id=94

	}
	

	public function get_state()
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



		$state_info = $this->home_model->get_result('tblstates', array('status'=>1), '');

	  

	  

	  

	   

	   if(!empty($state_info)){

		   foreach($state_info as $row){

			 			

			$state_array = array(

				'id' => $row->id,

				'name' => $row->name

			);

			

			$return_arr['state_list'][] = $state_array;

		   }

	   }else{

		  $return_arr['state_list'] = ""; 

	   }

	   

	  

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //http://bookallservices.com/schach/General_API/get_state

    }

	

	

	public function get_city()

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



		$city_info = $this->home_model->get_result('tblcities', array('status'=>1,'state_id'=>$state_id), '');

	  

	  

	  if(!empty($state_id)){

	   

	   if(!empty($city_info)){

		   foreach($city_info as $row){

			 			

			$city_array = array(

				'id' => $row->id,

				'name' => $row->name

			);

			

			$return_arr['city_list'][] = $city_array;

		   }

	   }else{

		  $return_arr['city_list'] = ""; 

	   }

	   

	  }

	  

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //http://bookallservices.com/schach/General_API/get_city?state_id=1

    }



public function get_locations()

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

		  

		//$location_info = $this->home_model->get_result('tblemployeelocations', array('status'=>1,'user_id'=>$user_id), '',array('id','desc'));

		$location_info = get_live_location($user_id);

	   

	   if(!empty($location_info)){

		   foreach($location_info as $row){

			

			if(($row->user_id == $user_id) && ($row->admin_action == 0)){

				$action = '1';

			}else{

				$action = '0';

			}

 			

			$location_array = array(

				'id' => $row->id,

				'title' => $row->title,

				'location' => $row->location,

				'lat_long' => $row->lat_long,

				'remark' => $row->remark,

				'created_at' => date('d/m/Y H:i:s',strtotime($row->created_at)),

				'action' => $action,

			);

			

			$return_arr['location_list'][] = $location_array;

		   }

	   }else{

		  $return_arr['location_list'] = []; 

	   }

	   

	  }else{

		  $return_arr['message'] = 'Required Parameters missing';

	  }

	  

	   header('Content-type: application/json');

	   echo json_encode($return_arr);

	   //http://bookallservices.com/schach/General_API/get_locations?&user_id=1

    }

	

	

	public function add_locations()

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



	  

	  if(!empty($user_id) && !empty($location)){

		  

		  if(empty($title)){

			  $title = '';

		  }

		  if(empty($lat_long)){

			  $lat_long = '';

		  }

		  if(empty($remark)){

			  $remark = '';

		  }

		  

		  if(!empty($location_id)){

			  $update_data = array(

					'title' => $title,

					'location' => $location,

					'lat_long' => $lat_long,

					'remark' => $remark,

					'status' => 1,

					'updated_at' => date('Y-m-d H:i:s'),

				);

						

			$add_location = $this->home_model->update('tblemployeelocations', $update_data, array('id'=>$location_id)); 

			$success_msg = 'Location Updated Successfully';

			$fail_msg = 'Fail to update Location';

		  }else{

			  $add_data = array(

				'user_id' => $user_id,

				'title' => $title,

				'location' => $location,

				'lat_long' => $lat_long,

				'remark' => $remark,

				'status' => 1,

				'created_at' => date('Y-m-d H:i:s'),

				'updated_at' => date('Y-m-d H:i:s'),

			);

						

			$add_location = $this->home_model->insert('tblemployeelocations', $add_data); 

			$success_msg = 'Location Added Successfully';

			$fail_msg = 'Fail to add Location';

		  }

		  

		  

		 

			

			if($add_location == true){

				$return_arr['status'] = true;	

				$return_arr['message'] = $success_msg;

				$return_arr['data'] = '';

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = $fail_msg;

				$return_arr['data'] = '';

			}

		  

	  }else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters missing";

			$return_arr['data'] = '';

	  }

	  

	   header('Content-type: application/json');

	   echo json_encode($return_arr);



		//http://35.154.77.171/schach/General_API/add_locations?user_id=1&location=Indore&lat_long=2132,12112&remark=test

	}

	

	

	public function remove_location()

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



	  

	  if(!empty($location_id)){

		  

		  $add_data = array(

				'status' => 0,

				'updated_at' => date('Y-m-d H:i:s'),

			);

						

			$upate_location = $this->home_model->update('tblemployeelocations', $add_data,array('id'=>$location_id));

			

			if($upate_location == true){

				$return_arr['status'] = true;	

				$return_arr['message'] = "Location Removed Successfully";

				$return_arr['data'] = '';

			}else{

				$return_arr['status'] = false;	

				$return_arr['message'] = "Fail to Remove Location";

				$return_arr['data'] = '';

			}

		  

	  }else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Required Parameters missing";

			$return_arr['data'] = '';

	  }

	  

	   header('Content-type: application/json');

	   echo json_encode($return_arr);



		//http://bookallservices.com/schach/General_API/remove_location?location_id=1

	}



public function get_staff_list()
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


		$where = "active = 1 ";
		if(!empty($branch_id) && !empty($department_id)){
			$where .= " and `reporting_branch_id` = ".$branch_id." AND `department_id` = ".$department_id." ";
		}
		if(!empty($user_id)){
			$where .= " and staffid != '".$user_id."' ";
		}

		$user_info  = $this->db->query("SELECT * FROM `tblstaff` where ".$where." order by firstname asc  ")->result();



		 if(!empty($user_info)){
		   foreach($user_info as $row){
 			

			$user_array[] = array(
				'id' => $row->staffid,
				'name' => $row->firstname,
				'designation' => get_designation($row->designation_id),
			);

			

		   }

		    $return_arr['status'] = true;
			$return_arr['message'] = "Successfully";
			$return_arr['data'] = $user_array;

	   }else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Record Not Found!";
			$return_arr['data'] = [];
	  }
	  

	   header('Content-type: application/json');
	   echo json_encode($return_arr);

	   //http://schachengineers.com/schacrm/General_API/get_staff_list?branch_id=1&department_id=1&user_id=65
	}





	public function get_all_locations()

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



		$date = date('Y-m-d');



		$y = date('Y');

		$m = date('m');

		$d = date('d');









		if(!empty($user_id) &&  !empty($from_date) && !empty($to_date)){

			$from_date = $from_date.' 00:00:00';

			$to_date = $to_date.' 23:59:59';





			$query = $this->db->query("SELECT * FROM `tblemployeelocations` where user_id = '".$user_id."' and status = 1 and created_at BETWEEN '".$from_date."' and '".$to_date."' order by id desc ");

		}elseif(!empty($user_id)){

			$query = $this->db->query("SELECT * FROM `tblemployeelocations` where user_id = '".$user_id."' and status = 1 and  YEAR(created_at) = '".$y."' and MONTH(created_at) = '".$m."' and DAY(created_at) = '".$d."'  order by id desc ");

		}elseif(!empty($from_date) && !empty($to_date)){

			$from_date = $from_date.' 00:00:00';

			$to_date = $to_date.' 23:59:59';

			

			$query = $this->db->query("SELECT * FROM `tblemployeelocations` where status = 1 and created_at BETWEEN '".$from_date."' and '".$to_date."' order by id desc ");

		}else{

			$query = $this->db->query("SELECT * FROM `tblemployeelocations` where status = 1 and YEAR(created_at) = '".$y."' and MONTH(created_at) = '".$m."' and DAY(created_at) = '".$d."' order by id desc ");

		}



		if($query->num_rows()>0){			

			$location_info = $query->result();

				foreach ($location_info as $row) {



					$name = get_employee_fullname($row->user_id);



					$location_array[] = array(

						'id' => $row->id,

						'name' => $name,

						'user_id' => $row->user_id,

						'title' => $row->title,

						'location' => $row->location,

						'lat_long' => $row->lat_long,

						'remark' => $row->remark,

						'created_at' => date('d/m/Y h:i a',strtotime($row->created_at))

					);	 

				}



			$return_arr['status'] = true;	

			$return_arr['message'] = "Successfully";

			$return_arr['data'] = $location_array;					

		}else{

			$return_arr['status'] = false;	

			$return_arr['message'] = "Record Not Found!";

			$return_arr['data'] = '';

	  }

	  

	   header('Content-type: application/json');

	   echo json_encode($return_arr);



	   //http://35.154.77.171/schach/General_API/get_all_locations?user_id=1&from_date=2018-09-10&to_date=2018-09-13



	}





	public function get_staff_attendance()

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



		$date = date('Y-m-d');



		if(!empty($user_id) &&  !empty($from_date) && !empty($to_date)){

			$query = $this->db->query("SELECT * FROM `tblmarkedattendance` where staff_id = '".$user_id."' and date BETWEEN '".$from_date."' and '".$to_date."' ORDER BY date ASC , checkin_time ASC ");

		}elseif(!empty($user_id)){			

			$query = $this->db->query("SELECT * FROM `tblmarkedattendance` where staff_id = '".$user_id."' and date  = '".$date."' ORDER BY date ASC , checkin_time ASC ");

		}elseif(!empty($from_date) && !empty($to_date)){			

			$query = $this->db->query("SELECT * FROM `tblmarkedattendance` where date BETWEEN '".$from_date."' and '".$to_date."' ORDER BY date ASC , checkin_time ASC ");

		}else{

			$query = $this->db->query("SELECT * FROM `tblmarkedattendance` where  date = '".$date."' ORDER BY date ASC , checkin_time ASC ");

		}



		if($query->num_rows()>0){			

			$att_info = $query->result();

				foreach ($att_info as $row) {



					$name = get_employee_fullname($row->staff_id);



					if(!empty($row->checkout_time)){

						$checkout_time = date('h:i A',strtotime($row->checkout_time));	

					}else{

						$checkout_time = '--';

					}



					$att_array[] = array(

						'id' => $row->id,

						'user_id' => $row->staff_id,

						'name' => $name,

						'checkin_time' => date('h:i A',strtotime($row->checkin_time)),

						'checkout_time' => $checkout_time,

						'date' => date('d/m/Y',strtotime($row->date))

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



	   //http://35.154.77.171/schach/General_API/get_staff_attendance?user_id=14&from_date=2018-10-17&to_date=2018-11-21



	}



	public function get_holiday_list()
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

		//$holiday_info  = $this->db->query("SELECT * FROM tblholidays WHERE status = '1' and year = '".date('Y')."' and date >= '".date('Y-m-d')."' ORDER by date ASC")->result();
		$holiday_info  = $this->db->query("SELECT * FROM tblholidays WHERE status = '1' and date >= '".date('Y-m-d')."' ORDER by date ASC")->result();


		if(!empty($holiday_info)){			


				foreach ($holiday_info as $row) {



					$att_array[] = array(
						'id' => $row->id,
						'title' => $row->title,
						'description' => $row->description,
						'date' => date('d-m-Y',strtotime($row->date))
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



	   //https://schachengineers.com/schacrm/General_API/get_holiday_list
	}



	public function get_vagent_keys()
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
                    
                    // $keys_info  = $this->db->query("SELECT * FROM tblvagentnumbers WHERE status = '1' ")->result_array();
                    $keys_info  = $this->db->query("SELECT `staffid`,`callingnumber` FROM tblstaff WHERE staffid = '".$user_id."' ")->row();
                    // $keys_info = $this->db->query("SELECT `exotel_number` from tblvagentnumbers  where status = 1 group by exotel_number order by id asc")->result();

                    if(!empty($keys_info) && !empty($keys_info->callingnumber)){	
                        
                        $cnumber = explode(",", $keys_info->callingnumber);
                        $numbers = array();
                        foreach ($cnumber as $k => $val) {
                            $numbers[] = array("exotel_number" => value_by_id_empty("tblvagentnumbers", $val, "exotel_number"));
                        }
                        $return_arr['status'] = true;
                        $return_arr['message'] = "Successfully";
                        $return_arr['data'] = $numbers;					

                    }else{
                        $return_arr['status'] = false;	
                        $return_arr['message'] = "Record Not Found!";
                        $return_arr['data'] = [];
                    }
                }else{
                    $return_arr['status'] = false;	
                    $return_arr['message'] = "Please send all required parameters";
                    $return_arr['data'] = [];
                }


	  	header('Content-type: application/json');
	    echo json_encode($return_arr);
	   //https://schachengineers.com/schacrm/General_API/get_vagent_keys

	}
		
        
    /* this is for comman function for download pdf */    
    public function download_pdf($type = "proposals", $id)
    {
        require_once APPPATH.'third_party/pdfcrowd.php';
        
        if (!$id) {
            echo "something went wrong";
            exit;
        }
        $html = "";
        switch ($type) {
            case "proposals":
                
                $this->load->model("proposals_model");   
                //$proposal = $this->proposals_model->get($id);
                $proposal = $this->db->query("SELECT * FROM `tblproposals` where id = '".$id."' ")->row();
                $file_name = format_proposal_number($id);

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_proposals_pdf($proposal);
                }else{
                    $html = proposals_pdf($proposal);
                }
                break;
            case "estimates":
                $this->load->model("estimates_model");  
                $estimate = $this->estimates_model->get($id);
                $file_name = format_estimate_number($estimate->id);

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_perfoma_infoice_pdf($estimate);
                }else{
                    $html = perfoma_infoice_pdf($estimate);
                }
                break;    
            case "invoices":
                $this->load->model("invoices_model");  
                $invoice = $this->invoices_model->get($id);
                $file_name = format_invoice_number($invoice->id);

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_infoice_pdf($invoice);
                }else{
                    $html = infoice_pdf($invoice);
                }  
                break;        
            case "challan":
                $this->load->model("estimates_model");  
                $estimate = $this->estimates_model->getcreatedchalan($id);
                $file_name = $estimate->chalanno;

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_challan_pdf($estimate);
                }else{
                    $html = challan_pdf($estimate);
                } 
                break; 
            case "debitnote":
                $debit_info = $this->db->query("SELECT * FROM `tbldebitnote` where id =  '".$id."' ")->row();
                $file_name = 'Debit Note - '.$id;

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_debit_note_pdf($debit_info);
                }else{
                    $html = debit_note_pdf($debit_info);    
                }
                break;       
            case "debitnotepayment":
                $debit_info = $this->db->query("SELECT * FROM `tbldebitnotepayment` where id =  '".$id."' ")->row();
                $file_name = 'Debit Note - '.$id;

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_debit_notepayment_pdf($debit_info);
                }else{
                    $html = debit_notepayment_pdf($debit_info);  
                }
                break;         
            case "creditnote":
                $credit_info = $this->db->query("SELECT * FROM `tblcreditnote` where id =  '".$id."' ")->row();
                $file_name = 'Credit Note - '.$id;

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_creditnote_pdf($credit_info);
                }else{
                    $html = creditnote_pdf($credit_info);    
                }
                break;         
            case "purchaseorder":
                $purchase = $this->db->query("SELECT * FROM `tblpurchaseorder` where id =  '".$id."' ")->row();
                $file_name = 'PO-'.$purchase->number;

                if(APP_BASE_URL == 'https://schachengineers.com/nturm/'){
                    $html = nturm_purchase_order_pdf($purchase);
                }else{
                    $html = purchase_order_pdf($purchase);
                }  
                break;         
        }
        
        
        if ($html != ""){
            $dompdf = new Dompdf();
            $dompdf->loadHtml($html);
            $dompdf->setPaper('A4', 'portrait');
            $dompdf->render();

            // Parameters
            $x          = 280;
            $y          = 820;
            $text       = "{PAGE_NUM} of {PAGE_COUNT}";     
            $font       = $dompdf->getFontMetrics()->get_font('Helvetica', 'normal');   
            $size       = 8;    
            $color      = array(0,0,0);
            $word_space = 0.0;
            $char_space = 0.0;
            $angle      = 0.0;

            $dompdf->getCanvas()->page_text(
              $x, $y, $text, $font, $size, $color, $word_space, $char_space, $angle
            );

            //$dompdf->stream($file_name);
            $dompdf->stream($file_name, array("Attachment" => false));
        }
    }


    public function make_call()
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

		if(!empty($agent_number) && !empty($customer_number) && !empty($exotel_number) ){

			$StatusCallback = base_url().'vagent/get_outgoing';
			$data = [
               'From' => $agent_number,
               'To' => $customer_number,
               'CallerId' => $exotel_number,
               'StatusCallback' => $StatusCallback,
               'StatusCallbackEvents[0]' => 'terminal',
            ];

            $makeCall = makeCall($data);

			$return_arr['status'] = true;	
			$return_arr['message'] = "Your call will initiate shortly";
		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
	    }


	  	header('Content-type: application/json');
	    echo json_encode($return_arr);
	   //https://schachengineers.com/schacrm/General_API/make_call?agent_number=9907327030&customer_number=8269607253&exotel_number=07314855570

	}



	public function mark_all_notification_read()
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

		   $notification_details  = $this->db->query("SELECT * FROM tblnotifications WHERE isread = '0' and touserid = '".$user_id."' ")->result();

		   if(!empty($notification_details)){
		   		foreach ($notification_details as $value) {
		   			$this->home_model->update('tblnotifications', array('isread'=>1,'readdate'=>date('Y-m-d H:i:s')), array('id'=>$value->id));
		   		}
		   } 

		   

			$return_arr['status'] = true;	
			$return_arr['message'] = "Record Updated Successfully";
			$return_arr['data'] = '';	   

	  }else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
	  }	
	   

	   header('Content-type: application/json');
	   echo json_encode($return_arr);
	   //http://bookallservices.com/schach/General_API/mark_all_notification_read?user_id=8

    }


    public function getContactDetails()
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

			$user_info = get_staff_info($user_id);
			if($user_info->superior_id > 0){
				$superior_info = get_staff_info($user_info->superior_id);

				if(!empty($superior_info)){

					$profile_image = '';
					if(!empty($superior_info->profile_image)){
                        $profile_image = base_url('uploads/staff_profile_images/'.$superior_info->staffid.'/'.$superior_info->profile_image);
                    }
					$data[] = array(
						'designation' => 'Superior',
						'name' => $superior_info->firstname,
						'email' => $superior_info->email,
						'mobile' => $superior_info->phonenumber,
						'profile_image' => $profile_image,
					);	
				}
			
				

			}

			$hr_info = get_staff_info(330);
			if(!empty($hr_info)){

				$profile_image = '';
				if(!empty($hr_info->profile_image)){
                    $profile_image = base_url('uploads/staff_profile_images/'.$hr_info->staffid.'/'.$hr_info->profile_image);
                }
				$data[] = array(
					'designation' => 'HR',
					'name' => $hr_info->firstname,
					'email' => $hr_info->email,
					'mobile' => $hr_info->phonenumber,
					'profile_image' => $profile_image,
				);	
			}

			$director_info = get_staff_info(1);
			if(!empty($director_info)){
				$profile_image = '';
				if(!empty($director_info->profile_image)){
                    $profile_image = base_url('uploads/staff_profile_images/'.$director_info->staffid.'/'.$director_info->profile_image);
                }
				$data[] = array(
					'designation' => 'Director',
					'name' => $director_info->firstname,
					'email' => '',
					'mobile' => '',
					'profile_image' => $profile_image,
				);	
			}

		$return_arr['status'] = true;	
		$return_arr['message'] = "Success";
		$return_arr['data'] = $data;

		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
	  	}	


		header('Content-type: application/json');
	   	echo json_encode($return_arr);
	   //https://schachengineers.com/schacrm/General_API/getContactDetails?user_id=65

    }


    public function updateUserProfile()
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

		handle_staff_profile_image_upload($user_id);		

		$return_arr['status'] = true;	
		$return_arr['message'] = "Profile Update Successfully";
		$return_arr['data'] = '';

		}else{
			$return_arr['status'] = false;	
			$return_arr['message'] = "Required Parameters are messing";
			$return_arr['data'] = '';
	  	}	


		header('Content-type: application/json');
	   	echo json_encode($return_arr);
	   //https://schachengineers.com/schacrm/General_API/updateUserProfile?user_id=65&profile_image=

    }
}


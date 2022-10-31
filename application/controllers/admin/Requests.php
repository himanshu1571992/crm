<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Requests extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('requests_model');
        $this->load->model('home_model');
    }
	
    public function index($id = '')
    {      
		$request_info = get_request_info(1);	 
	   $this->list_requests($id);
    }

    public function list_requests($id = '')
    {
        close_setup_menu();
		
       /* if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }*/

       /* $data['expenseid']  = $id;
        $data['categories'] = $this->requests_model->get_category();
        $data['years']      = $this->requests_model->get_expenses_years();*/
        $data['title']      = _l('request');

        $this->load->view('admin/requests/manage', $data);
    }

    public function table($clientid = '')
    {
       /* if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            ajax_access_denied();
        }*/
		
       /* $this->app->get_table_data('expenses', [
            'clientid' => $clientid,
        ]);*/
		$this->app->get_table_data('requests');
    }
	
	public function category_table() {
        $this->app->get_table_data('requests_categories');
    }

    public function request($id = '')
    {
		
		//getting Branch name
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
		$data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
		
		//getting group info
		$data['Staffgroup'] = get_staff_group(14);
		$Staffgroup = get_staff_group(14,get_staff_user_id());

		
		$i=0;
		$stafff=array();
		if(!empty($Staffgroup)){
			foreach($Staffgroup as $singlestaff)
			{
				$i++;
				$stafff[$i]['id']=$singlestaff['id'];
				$stafff[$i]['name']=$singlestaff['name'];
				$query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='".$singlestaff['id']."' AND s.staffid!='". get_staff_user_id()."'")->result_array();
				$stafff[$i]['staffs']=$query;
			}
		}
		$data['allStaffdata'] = $stafff;
			
	   if ($this->input->post()) {
		extract($this->input->post());
		/*echo '<pre/>';
		print_r($_POST);
		die;*/
            if ($id == '') {
               /* if (!has_permission('expenses', '', 'create')) {
                    set_alert('danger', _l('access_denied'));
                    echo json_encode([
                        'url' => admin_url('expenses/expense'),
                    ]);
                    die;
                }*/
				
				
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
				
				$ad_data = array(
							'category' => $category,                              
							'amount' => $amount,                               
							'tenure' => $tenure,                               
							'branch' => $branch,                               
							'person_id' => $person_id,                               
							'payment_mode' => $payment_mode,                               
							'reason' => $reason,                               
							'description' => $description,                               
							'date' => date('Y-m-d'),                               
							'dateadded' => date('Y-m-d H:i:s'),                               
							'addedfrom' => get_staff_user_id()
						);
						
				$request_id = $this->requests_model->add($ad_data);			
						
				if(!empty($staffid)){
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
						
						 $notified = add_notification([
									'description'     => 'Request Send to you for Approval',
									'touserid'        => $singlelead,
									'type'            => 1,
									'module_id'        => 1,
									'table_id'        => $request_id,
									'category_id'        => $category,
									'fromuserid'      => get_staff_user_id(),
									'link'            => 'requests/request_approval/' . $request_id.'',
								   /* 'additional_data' => serialize([
										$proposal->subject,
									]),*/
								]);
								if ($notified) {
									pusher_trigger_notification([$singlelead]);
								}
						}
					}
				}
				
				if(($person_id > 0)){
					
						$prdata['staff_id']=$person_id;
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
						
						 $notified = add_notification([
									'description'     => 'Request For Transfer',
									'touserid'        => $person_id,
									'type'            => 1,
									'module_id'        => 1,
									'table_id'        => $request_id,
									'category_id'        => $category,
									'fromuserid'      => get_staff_user_id(),
									'link'            => 'requests/request_approval/' . $request_id.'',
								 
								]);
								if ($notified) {
									pusher_trigger_notification([$person_id]);
								}						
				}
				
                if ($request_id) {
					set_alert('success', _l('added_successfully', _l('request')));
                    redirect(admin_url('requests/list_requests'));
						die;
                   
                }
                echo json_encode([
                    'url' => admin_url('expenses/expense'),
                ]);
                die;
				
            }else{
				/* if (!has_permission('expenses', '', 'edit')) {
					set_alert('danger', _l('access_denied'));
					echo json_encode([
							'url' => admin_url('expenses/expense/' . $id),
						]);
					die;
				}*/
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
				$update_data = array(
							'category' => $category,                              
							'amount' => $amount,                               
							'tenure' => $tenure,                               
							'branch' => $branch,                               
							'payment_mode' => $payment_mode,                               
							'person_id' => $person_id,                               
							'reason' => $reason,                               
							'description' => $description
						);
						
				$success = $this->requests_model->update($update_data, $id);		
						
				if(!empty($staffid)){
					foreach($staffid as $singlelead)
					{
						if($singlelead!=0)
						{
						$prdata['staff_id']=$singlelead;
						$prdata['request_id']=$id;
						$prdata['status']=1;
						$prdata['created_at'] = date("Y-m-d H:i:s");
						$prdata['updated_at'] = date("Y-m-d H:i:s");
						$this->db->insert('tblrequestapproval',$prdata);
						
						//Sending Mobile Intimation
						$token = get_staff_token($singlelead);
						$message = 'Request Send to you for Approval';
						$title = 'Schach';
						$send_intimation = sendFCM($message, $title, $token);
						
						 $notified = add_notification([
									'description'     => 'Request Send to you for Approval',
									'touserid'        => $singlelead,
									'fromuserid'      => get_staff_user_id(),
									'link'            => 'requests/request_approval/' . $id.'',
								   /* 'additional_data' => serialize([
										$proposal->subject,
									]),*/
								]);
								if ($notified) {
									pusher_trigger_notification([$singlelead]);
								}
						}
					}
				}
				
				if(($person_id > 0)){
					
						$prdata['staff_id']=$person_id;
						$prdata['request_id']=$id;
						$prdata['status']=1;
						$prdata['created_at'] = date("Y-m-d H:i:s");
						$prdata['updated_at'] = date("Y-m-d H:i:s");
						$this->db->insert('tblrequestapproval',$prdata);
						
						//Sending Mobile Intimation
						$token = get_staff_token($singlelead);
						$message = 'Request Send to you for Approval';
						$title = 'Schach';
						$send_intimation = sendFCM($message, $title, $token);
						
						 $notified = add_notification([
									'description'     => 'Request For Transfer',
									'touserid'        => $person_id,
									'fromuserid'      => get_staff_user_id(),
									'link'            => 'requests/request_approval/' . $id.'',
								 
								]);
								if ($notified) {
									pusher_trigger_notification([$person_id]);
								}						
				}
				
				if ($success) {
					 redirect(admin_url('requests/list_requests'));
					set_alert('success', _l('updated_successfully', _l('request')));
				}
				
			}
			
           
            
        }
        if ($id == '') {
            $title = 'Add New Request';
        } else {
            $data['request'] = $this->home_model->get_row('tblrequests', array('id'=>$id), '');
			
			
			if(($data['request']->addedfrom != get_staff_user_id()) && (is_admin() == 0)){
				access_denied('expenses');
			}

            /*if (!$data['expense'] || (!has_permission('expenses', '', 'view') && $data['expense']->addedfrom != get_staff_user_id())) {
                blank_page(_l('expense_not_found'));
            }*/

            $title = _l('edit', 'Request');
        }

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('currencies_model');

        
        $data['categories']    = $this->requests_model->get_category();
        $data['loan_tenues']    = $this->requests_model->get_tenues();
	
        
        $data['bodyclass']  = 'request';
        $data['currencies'] = $this->currencies_model->get();
        $data['title']      = $title;
        $this->load->view('admin/requests/request', $data);
    }
	
	

    public function delete($id)
    {
        /*if (!has_permission('expenses', '', 'delete')) {
            access_denied('expenses');
        }*/
		
        if (!$id) {
            redirect(admin_url('requests/list_requests'));
        }
        $response = $this->requests_model->delete($id);
        if ($response === true) {
            set_alert('success', _l('deleted', 'Request'));
        } else {
             set_alert('warning', _l('problem_deleting', _l('expense_lowercase')));
        }

        if (strpos($_SERVER['HTTP_REFERER'], 'requests/') !== false) {
            redirect(admin_url('requests/list_requests'));
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }
   
    
    public function categories()
    {
        check_permission('128,260','view');

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('expenses_categories');
        }
        $data['title'] = _l('requiest_category');
        $this->load->view('admin/requests/manage_categories', $data);

    }
	
	
	 public function add_category($id = '') {
	 	check_permission('128,260','create');
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->requests_model->add_category($unit_data);
                if ($id) {
					
					//uploading category image
					if(!empty($_FILES['requests_category_img'])){
						if(!empty($_FILES['requests_category_img']['name'])){
								
								$param['upload_path'] = REQUESTS_CATEGORY_IMAGES_FOLDER;
								
								$param['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
								$param['max_size'] = '2048570';
								//$param['encrypt_name'] =TRUE;
								$this->load->library('upload', $param);
								$this->upload->initialize($param);
								
								if(!$this->upload->do_upload('requests_category_img')){
									echo  $errors = $this->upload->display_errors();	
									die;
								
								}else{
									$file_array = $this->upload->data('file_name');
									$file_name = $file_array['file_name'];
									$up_data['requests_category_img'] = $file_array;							
									$image_data = $this->upload->data();
									
									$this->home_model->update('tblrequestscategories',$up_data,array('id'=>$id));
								
								}
							}
					}
					
					
                    set_alert('success', _l('added_successfully', _l('expense_category')));
                    redirect(admin_url('requests/categories'));
                }
            } else {
            	check_permission('128,260','edit');
                $success = $this->requests_model->update_category($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('expense_category')));
                }

				//uploading category image
				if(!empty($_FILES['requests_category_img'])){
					if(!empty($_FILES['requests_category_img']['name'])){
							
							$param['upload_path'] = REQUESTS_CATEGORY_IMAGES_FOLDER;
							
							$param['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
							$param['max_size'] = '2048570';
							//$param['encrypt_name'] =TRUE;
							$this->load->library('upload', $param);
							$this->upload->initialize($param);
							
							if(!$this->upload->do_upload('requests_category_img')){
								echo  $errors = $this->upload->display_errors();	
								die;
								//$this->session->set_flashdata('msg_error', 'Fail to upload Image!');
								//redirect('expenses/add_category');
							}else{
								$file_array = $this->upload->data('file_name');
								
								$file_name = $file_array['file_name'];
								
								$up_data['requests_category_img'] = $file_array;							
								$image_data = $this->upload->data();
								
								$this->home_model->update('tblrequestscategories',$up_data,array('id'=>$id));
							
							}
						}
				}
                redirect(admin_url('requests/categories'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'request category');
        } else {
            $data['category'] = (array) $this->requests_model->get_category($id);
            $title = _l('edit', 'request category');
        }

        $data['title'] = $title;
        $this->load->view('admin/requests/add_categories', $data);
    }

    public function category()
    {
        if (!is_admin() && get_option('staff_members_create_inline_expense_categories') == '0') {
            access_denied('expenses');
        }
        if ($this->input->post()) {
            if (!$this->input->post('id')) {
                $id = $this->requests_model->add_category($this->input->post());
                echo json_encode([
                    'success' => $id ? true : false,
                    'message' => $id ? _l('added_successfully', _l('expense_category')) : '',
                    'id'      => $id,
                    'name'    => $this->input->post('name'),
                ]);
            } else {
                $data = $this->input->post();
                $id   = $data['id'];
                unset($data['id']);
                $success = $this->requests_model->update_category($data, $id);
                $message = _l('updated_successfully', _l('expense_category'));
                echo json_encode(['success' => $success, 'message' => $message]);
            }
        }
    }

    public function delete_category($id)
    {
        check_permission('128,260','delete');
        if (!$id) {
            redirect(admin_url('expenses/categories'));
        }
        $response = $this->requests_model->delete_category($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('expense_category_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('expense_category')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('expense_category_lowercase')));
        }
        redirect(admin_url('expenses/categories'));
    }

   
	
	
	 public function change_requests_category_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->requests_model->edit($unit_data, $id);
        }
    }
	
	
	 public function get_expenses_custom_fields() {
        if ($this->input->is_ajax_request()) {
            extract($this->input->post());
			$where = 'FIND_IN_SET('.$category_id.', expense_category_id)';
			
			echo render_custom_fields('expenses',false,$where);
        }
    }
	
	 public function get_distance() {
        if ($this->input->is_ajax_request()) {
            extract($this->input->post());
			
			$lat_lng_1 = get_lat_lng($form_location);
			$lat_lng_2 = get_lat_lng($to_location);
			
			if(!empty($lat_lng_1)){
				$latlng_1_arr = explode(',',$lat_lng_1);
				$latitudeFrom = $latlng_1_arr[0];
				$latitudeTo = $latlng_1_arr[1];
			}
			
			if(!empty($lat_lng_2)){
				$latlng_2_arr = explode(',',$lat_lng_2);
				$longitudeFrom = $latlng_2_arr[0];
				$longitudeTo = $latlng_2_arr[1];
			}
			
			if(!empty($latitudeFrom) && !empty($latitudeTo) && !empty($longitudeFrom) && !empty($longitudeTo)){
				
				echo GetDistance($latitudeFrom, $latitudeTo, $longitudeFrom, $longitudeTo, 'K');
			}else{
				echo 0;
			}
			
        }
    }
	
	
	 public function validate_date() {
        if ($this->input->is_ajax_request()) {
            extract($this->input->post());
			
			$date = str_replace("/","-",$date);
			
			$settings = $this->requests_model->get_settings(1);
			$day = $settings->last_expense_date_limit;
			
			$last_date = date('d-m-Y',strtotime("-$day Day"));
			
			if($date < $last_date){
				echo 'Date Cannot Select More Then Last '.$day.' Days';
			}
			
		}
    }
	
	public function sendapproval()
    {
		$staffid=$this->input->post('staffid');
		$expenseid=$this->input->post('expenseid');
		
		$expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$expenseid), '');	
		
		if($expense_info->parent_id > 0){
				$parent_id = $expense_info->parent_id;
			}else{
				$parent_id = $expenseid;
			}
		
		foreach($staffid as $singlelead)
		{
			if($singlelead!=0)
			{
			$prdata['staff_id']=$singlelead;
			$prdata['expense_id']=$parent_id;
			$prdata['status']=1;
			$prdata['created_at'] = date("Y-m-d H:i:s");
			$prdata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tblexpensesapproval',$prdata);
			
			 $notified = add_notification([
                        'description'     => 'Expenses Send to you for Approval',
                        'touserid'        => $singlelead,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'expenses/list_expenses/' . $parent_id.'/approval_tab',
                       /* 'additional_data' => serialize([
                            $proposal->subject,
                        ]),*/
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$singlelead]);
                    }
			}
		}
		$prddata['expense_send']=1;
		$this->db->where('id', $parent_id);
		$this->db->update('tblexpenses', $prddata);
		exit;
	}
	
		
	
	public function loan_tenues()
    {
       check_permission('129,261','view');
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('expenses_categories');
        }
        $data['title'] = 'Loan Lenues';
        $this->load->view('admin/requests/manage_tenues', $data);

    }
	
	
	 public function add_loan_tenue($id = '') {
	 	check_permission('129,261','create');
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->requests_model->add_tenue($unit_data);
                if ($id) {
					
                    set_alert('success', _l('added_successfully', 'Loan Tenue'));
                    redirect(admin_url('requests/loan_tenues'));
                }
            } else {
            	check_permission('129,261','edit');
                $success = $this->requests_model->update_tenue($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Loan Tenue'));
                }

				
                redirect(admin_url('requests/loan_tenues'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'tenue');
        } else {
            $data['tenue'] = (array) $this->requests_model->get_tenue($id);
            $title = _l('edit', 'tenue');
        }

        $data['title'] = $title;
        $this->load->view('admin/requests/add_loan_tenue', $data);
    }

	
	public function tenue_table() {
        $this->app->get_table_data('requests_tenue');
    }
	
	
	 public function change_requests_tenue_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->requests_model->edit_tenue($unit_data, $id);
        }
    }
		
	public function request_approval_old($id = '')
    {

		if(!empty($id)){
			$data['loan_tenues']    = $this->requests_model->get_tenues();
			$data['request'] = $this->home_model->get_row('tblrequests', array('id'=>$id), '');
			$data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
			
			if(!empty($data['request']) && $data['request']->approved_status == 0){
			
			$data['request_action'] = $this->home_model->get_row('tblrequestapproval', array('request_id'=>$id,'staff_id'=>get_staff_user_id()), '');
			
			 if($this->input->post()) {
				extract($this->input->post());
					
					if($approve_status == 2){
						$approved_amount = 0;
					}
					
					$ldata = array(
							'approve_status' => $approve_status,
							'approvereason' => $remark,
							'approved_amount' => $approved_amount,
							'updated_at' => date('Y-m-d H:i:s'),
					);
					
					
					
					$success = $this->home_model->update('tblrequestapproval',$ldata,array('request_id'=>$id,'staff_id'=>get_staff_user_id()));
					
					$request_info = get_request_info($id);
					
					$update_data = array(
							'approved_status' => $approve_status,
							'approved_amount' => $approved_amount,
							'approved_remark' => $remark,
					);
					
					if($request_info->category == 4){
						$update_data['receive_status'] = 1;
						$update_data['confirmed_by_user'] = 1;
						$update_data['confirmation_payment_mode'] = $confirmation_payment_mode;
					}
					
					if($request_info->category == 3){
						if(!empty($tenure)){
							$update_data['tenure'] = $tenure;
						}
						
					}
					
					$update_request = $this->home_model->update('tblrequests',$update_data,array('id'=>$id));
					
					
					
					if($approve_status==1){
						$description = 'Request Approved Successfully';	
					}else{
						$description = 'Request Decline';	
					}
					
					if($request_info->category != 4){
						//Sending Mobile Intimation
						$token = get_staff_token($creatorid);
						$message = 'You Have Request for Approval';
						$title = 'Schach';
						$send_intimation = sendFCM($message, $title, $token);
										
						
						$notified = add_notification([
									'description'     => $description,
									'touserid'        => $creatorid,
									'fromuserid'      => get_staff_user_id(),
									'module_id'       => 1,
									'type'            => 2,
									'table_id'        => $id,
									'category_id'     => $request_info->category,
									'link'            => 'requests/request_comfirm/'.$id,
									/*'additional_data' => serialize([
										$proposal->subject,
									]),*/
								]);
								if ($notified) {
									pusher_trigger_notification([$creatorid]);
								}
						
					}	
						
								
				 if($success){
					 set_alert('success', $description);
					redirect(admin_url('requests/list_requests'));	
				 }				
				
			 }
			
		 $data['title']  = 'Request Approval';
         $this->load->view('admin/requests/request_approval', $data);
			}else{
				set_alert('warning', 'Action Already Taken On Request');
				redirect(admin_url('requests/list_requests'));	
			}
		}else{
			set_alert('warning', 'Access denied !');
			redirect(admin_url('requests/list_requests'));	
			 
		}
	}
	
	public function request_approval($id = '')
    {
		if(empty($id) || $id == ''){
			set_alert('warning', 'Access denied !');
			redirect(admin_url("approval/staff_notification_list"));
		}
		// $request_info = get_request_info($id);
		// if(!empty($request_info) && $request_info->approved_status > 0){
		// 	set_alert('warning', 'Action Already Taken On Request');
		// 	redirect(admin_url("approval/staff_notification_list"));
		// }

		/* take action against to request */
		if($this->input->post()) {
			extract($this->input->post());
			
			$payment_type = (!empty($payment_type)) ? $payment_type : 0;
			$petty_cash_id = (!empty($petty_cash_id)) ? $petty_cash_id : 0;
			$approved_amount = (!empty($approved_amount)) ? $approved_amount : "0.0";
			$tenure_id = (!empty($tenure_id)) ? $tenure_id : 0;
			$post_fields = array(
				"user_id" => get_staff_user_id(),
				"approve_status" => $approve_status,
				"remark" => $remark,
				"approved_amount" => $approved_amount,
				"request_id" => $id,
				"payment_mode" => "",
				"tenure_id" => $tenure_id,
				"pettycash_id" => $petty_cash_id,
				"payment_type" => $payment_type,
			);
			
			/* SEND REQUEST FOR APPROVAL START */
			$request_url = base_url()."Requests_API/approve_request";
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
		$request_url = base_url()."Requests_API/get_single_request?request_id=".$id;
		// $request_url = "https://schachengineers.com/schacrm/Requests_API/get_single_request?request_id=3519";
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
		
		$data['title']  = 'Request Approval';
		$data['loan_tenues']    = $this->requests_model->get_tenues();
		$data['pettycash_list']  = $this->db->query("SELECT * FROM tblpettycashmaster WHERE  status = '1' and staff_id > 0 and staff_confirmed = 1 and staff_id != '".get_staff_user_id()."' ")->result();
		$this->load->view('admin/requests/request_approval', $data);
	}
	
	public function get_branch_person() {
		if(!empty($_POST)){
			extract($this->input->post());
			$staff_id = get_staff_user_id();
			$user_info = branch_employee($branch_id,$staff_id);
			
			if(!empty($user_info)){
					echo '<option value="" disabled selected >--Select Person-</option>';
				foreach($user_info as $row){
					echo "<option value='".$row->staffid."'>".$row->firstname.' ['.$row->email.']'."</option>";
				}
			}
		}
	}

	public function request_comfirm_old($id = '')
    {
		if(!empty($id)){
			$data['request'] = $this->home_model->get_row('tblrequests', array('id'=>$id), '');
			$data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
			
			 if($this->input->post()) {
				extract($this->input->post());
					
					$ldata = array(
							'confirmed_by_user' => 1,
							'receive_status' => $receive_status,
							'user_confirmation_remark' => $user_confirmation_remark,
							'confirmation_payment_mode' => $confirmation_payment_mode,
							'confirmed_date' => date('Y-m-d H:i:s'),
					);
					
					
					
					$success = $this->home_model->update('tblrequests',$ldata,array('id'=>$id));
					$request_info = $this->home_model->get_row('tblrequests', array('id'=>$id), '');
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
					 set_alert('success', 'Request Confirmed Successfully');
					redirect(admin_url('requests/list_requests'));	
				 }				
				
			 }
			
		 $data['title'] = 'Request Comfirm';
         $this->load->view('admin/requests/request_comfirm', $data);
		}else{
			set_alert('warning', 'Access denied !');
			redirect(admin_url('requests/list_requests'));				 
		}
	}

	public function request_comfirm($id = '')
    {
		if(empty($id) || $id == ''){
			set_alert('warning', 'Access denied !');
			redirect(admin_url("approval/staff_notification_list"));
		}
		// $request_info = get_request_info($id);
		// if(!empty($request_info) && $request_info->confirmed_by_user > 0){
		// 	set_alert('warning', 'Action Already Taken On Request');
		// 	redirect(admin_url("approval/staff_notification_list"));
		// }

		/* take action against to request */
		if($this->input->post()) {
			extract($this->input->post());
			
			$payment_type = (!empty($payment_type)) ? $payment_type : 0;
			$petty_cash_id = (!empty($petty_cash_id)) ? $petty_cash_id : 0;
			$approved_amount = (!empty($approved_amount)) ? $approved_amount : 0;
			$tenure_id = (!empty($tenure_id)) ? $tenure_id : 0;
			$post_fields = array(
				"request_id" => $id,
				"confirmation_remark" => $user_confirmation_remark,
				"receive_status" => $receive_status,
				"payment_mode" => $confirmation_payment_mode
			);
			/* SEND REQUEST FOR CONFIRMATION START */
				$request_url = base_url()."Requests_API/get_request_approved_info";
				$response = $this->curl_method($request_url, "POST", $post_fields);
				if ($response == TRUE){
					set_alert('success', 'Confirmation Action Taken Successfully');
					redirect(admin_url("approval/staff_notification_list"));
				}else{
					set_alert('danger', "Somthing Went wrong");
					redirect(admin_url("approval/staff_notification_list"));
				}
			/* SEND REQUEST FOR CONFIRMATION END */
		}

		$data["request_info"] = $data["read_by_user"] = array();
		$request_url = base_url()."Requests_API/get_single_request?request_id=".$id;
		// $request_url = "https://schachengineers.com/schacrm/Requests_API/get_single_request?request_id=3519";
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
		$data['title'] = 'Request Confirm';
		$data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
        $this->load->view('admin/requests/request_comfirm', $data);
	}

    public function check_existing_request() {
		if(!empty($_POST)){
			extract($this->input->post());
			
			$check = $this->home_model->get_row('tblrequests', array('confirmed_by_user'=>0,'category'=>$category,'cancel'=>0,'approved_status'=>0,'addedfrom'=>get_staff_user_id()), '');
			
			if(!empty($check)){
				echo '1';
			}else{
      
				$check = $this->home_model->get_row('tblrequests', array('confirmed_by_user'=>0,'category'=>$category,'cancel'=>0,'approved_status'=>1,'addedfrom'=>get_staff_user_id()), '');
			
				if(!empty($check)){
				echo '1';
				}
				else{
					echo '0';
				}
			}					
			
		}
	}

	public function request_employee_info($id = '')
    {
		if(!empty($id)){
			$data['user_info'] = $this->home_model->get_row('tblstaff', array('staffid'=>$id), '');
			
			
		 $data['title'] = 'Request Employee Details';
         $this->load->view('admin/requests/request_employee_info', $data);
		}else{
			set_alert('warning', 'Access denied !');
			redirect(admin_url('requests/list_requests'));				 
		}
	}
	
	public function cancel_request($id)
    {
		
		$ldata = array(
							'cancel' => 1
					);
					
		$success = $this->home_model->update('tblrequests',$ldata,array('id'=>$id));
		
		if($success){
			 set_alert('success', 'Request Cancelled Successfully');
			redirect(admin_url('requests/list_requests'));	
		 }
	}
	
	public function check_wallet_amount()
    {
		if(!empty($_POST)){
			extract($this->input->post());
			$wallet_amt = wallet_amount($this->session->userdata('staff_user_id'));
			if($wallet_amt < 0){
				$p_amt = abs($wallet_amt);
				if($p_amt < $amount){
					echo '1';
				}
			}else{
				echo '1';
			}	
		
			
		}	
		
	}


	public function staff_loan_details($id="")
    {
    	check_permission('119,229','view');
		
    	$data['title'] = 'Staff Loan Details';

		if(!empty($id)){
			$data['staff_id'] = $id;
			$data['request_info'] = get_staff_loan_requst($id,0);					
			
        
		}
		if(!empty($_POST)){
			/*echo '<pre/>';
			print_r($_POST);
			die;*/
			extract($this->input->post());
			$data['s_status'] = $status;
			$data['staff_id'] = $staff_id;
			if(!empty($f_date) && !empty($t_date)){
				$data['sf_date'] = $f_date;
				$data['st_date'] = $t_date;
				
				
				$from = str_replace("/","-",$f_date);
				$from_date = date("Y-m-d",strtotime($from));
				$to = str_replace("/","-",$t_date);
				$to_date = date("Y-m-d",strtotime($to));
			}else{
				$from_date = '';
				$to_date = '';
			}

			$data['request_info'] = get_staff_loan_requst($staff_id,$status,$from_date,$to_date);
			
		}

		/*if(empty($_POST) && empty($id)){
			set_alert('warning', 'Access denied !');
			redirect(admin_url('requests/list_requests'));				 
		}*/

		$data['staff_list'] = get_staff_list();
		$this->load->view('admin/requests/loan_details', $data);
	}

	public function close_loan($id)
    {
    	if(!empty($id)){
    	
			$update = $this->home_model->update('tblstaffloanlog', array('status'=>1,'closed'=>1),array('request_id'=>$id));

			if($update == true){
				set_alert('success', 'Loan Closed Successfully');
				redirect($_SERVER['HTTP_REFERER']);	
			}
    	}else{
			set_alert('warning', 'Access denied !');
			redirect(admin_url('requests/list_requests'));				 
		}
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
			}else if (!empty($response_decode) && (isset($response_decode["status"]) && isset($response_decode["message"]))){
				return $response_decode;
			}
		}
		return "Somthing went wrong!";
	}

}
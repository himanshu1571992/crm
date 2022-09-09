<?php
defined('BASEPATH') or exit('No direct script access allowed');
class Leaves extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('leaves_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {
        $this->list_leaves($id);
    }

    public function list_leaves($id = '')
    {
        close_setup_menu();
		
       /* if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }*/

       /* $data['expenseid']  = $id;
        $data['categories'] = $this->leaves_model->get_category();
        $data['years']      = $this->leaves_model->get_expenses_years();*/
        $data['title']      = 'Leave';

        $this->load->view('admin/leaves/manage', $data);
    }

    public function table($clientid = '')
    {
       /* if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            ajax_access_denied();
        }*/
		
       /* $this->app->get_table_data('expenses', [
            'clientid' => $clientid,
        ]);*/
		$this->app->get_table_data('leaves');
    }
	
	public function category_table() {
        $this->app->get_table_data('leaves_categories');
    }

   public function leave($id = '')
    {
		
		//getting Branch name
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
		$data['payment_mode_info'] = $this->home_model->get_result('tblpaymentmode', array('status'=>1), '');
		
		//getting group info
		$data['Staffgroup'] = get_staff_group(15);
		$Staffgroup = get_staff_group(15);
		$i=0;
		$stafff='';
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
				
				
				$ad_data = array(
							'category' => $category,     
							'reason' => $reason,                               
							'from_date' => $from_date,                               
							'to_date' => $to_date,                               
							'total_days' => $total_days,                           
							'is_paid_leave' => $is_paid_leave,                           
							'dateadded' => date('Y-m-d H:i:s'),                               
							'addedfrom' => get_staff_user_id()
						);
						
				$leave_id = $this->leaves_model->add($ad_data);	
				
				//uploading category image
					if(!empty($_FILES['leave_file'])){
						if(!empty($_FILES['leave_file']['name'])){
								
								$param['upload_path'] = LEAVES_REQUEST_IMAGES_FOLDER;
								
								$param['allowed_types'] = '*';
								$param['max_size'] = '2048570';
								//$param['encrypt_name'] =TRUE;
								$this->load->library('upload', $param);
								$this->upload->initialize($param);
								
								if(!$this->upload->do_upload('leave_file')){
									echo  $errors = $this->upload->display_errors();	
									die;
								
								}else{
									$file_array = $this->upload->data('file_name');
									$file_name = $file_array['file_name'];
									$up_data['leave_file'] = $file_array;							
									$image_data = $this->upload->data();
									
									$this->home_model->update('tblleaves',$up_data,array('id'=>$leave_id));
								
								}
							}
					}

				
						
				if(!empty($staffid)){
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
						
						 $notified = add_notification([
									'description'     => 'Leave Request Send to you for Approval',
									'touserid'        => $singlelead,
									'fromuserid'      => get_staff_user_id(),
									'module_id'        => 3,
									'type'            => 1,
									'table_id'        => $leave_id,
									'category_id'        => $category,
									'link'            => 'leaves/leave_approval/' . $leave_id.'',
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
				
				
                if ($leave_id) {
					set_alert('success', _l('added_successfully', _l('request')));
                    redirect(admin_url('leaves/list_leaves'));
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
				
				$update_data = array(
							'category' => $category,     
							'reason' => $reason,                               
							'from_date' => $from_date,                               
							'to_date' => $to_date,                               
							'total_days' => $total_days
						);
				$success = $this->leaves_model->update($update_data, $id);		
						
				if(!empty($staffid)){
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
						
						 $notified = add_notification([
									'description'     => 'Leave Request Send to you for Approval',
									'touserid'        => $singlelead,
									'fromuserid'      => get_staff_user_id(),
									'link'            => 'leaves/leave_approval/' . $leave_id.'',
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
				
								
				if ($success) {
					set_alert('success', _l('updated_successfully', 'Leave'));
					 redirect(admin_url('leaves/list_leaves'));
					
				}
				
			}
			
           
            
        }
        if ($id == '') {
            $title = 'Apply For Leave';
        } else {
            $data['request'] = $this->home_model->get_row('tblleaves', array('id'=>$id), '');

            /*if (!$data['expense'] || (!has_permission('expenses', '', 'view') && $data['expense']->addedfrom != get_staff_user_id())) {
                blank_page(_l('expense_not_found'));
            }*/

           $title = 'Update Leave';
        }

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('currencies_model');

        
        $data['categories'] = $this->leaves_model->get_category();
	
        
        $data['bodyclass']  = 'request';
        $data['currencies'] = $this->currencies_model->get();
        $data['title']      = $title;
        $this->load->view('admin/leaves/leave', $data);
    }
	

    public function delete($id)
    {
        /*if (!has_permission('expenses', '', 'delete')) {
            access_denied('expenses');
        }*/
		
        if (!$id) {
            redirect(admin_url('leaves/list_leaves'));
        }
        $response = $this->leaves_model->delete($id);
        if ($response === true) {
            set_alert('success', _l('deleted', 'Request'));
        } else {
             set_alert('warning', _l('problem_deleting', 'leave request'));
        }

        if (strpos($_SERVER['HTTP_REFERER'], 'requests/') !== false) {
            redirect(admin_url('leaves/list_leaves'));
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }


    public function categories()
    {
        /*if (!is_admin()) {
            access_denied('leaves');
        }*/
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('leaves_categories');
        }
        $data['title'] = 'Leave Category';
        $this->load->view('admin/leaves/manage_categories', $data);

    }
	
	
	 public function add_category($id = '') {
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->leaves_model->add_category($unit_data);
                if ($id) {
					
					//uploading category image
					if(!empty($_FILES['leaves_category_img'])){
						if(!empty($_FILES['leaves_category_img']['name'])){
								
								$param['upload_path'] = LEAVES_CATEGORY_IMAGES_FOLDER;
								
								$param['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
								$param['max_size'] = '2048570';
								//$param['encrypt_name'] =TRUE;
								$this->load->library('upload', $param);
								$this->upload->initialize($param);
								
								if(!$this->upload->do_upload('leaves_category_img')){
									echo  $errors = $this->upload->display_errors();	
									die;
								
								}else{
									$file_array = $this->upload->data('file_name');
									$file_name = $file_array['file_name'];
									$up_data['leaves_category_img'] = $file_array;							
									$image_data = $this->upload->data();
									
									$this->home_model->update('tblleavescategories',$up_data,array('id'=>$id));
								
								}
							}
					}
					
					
                    set_alert('success', _l('added_successfully', 'Leave Category'));
                    redirect(admin_url('leaves/categories'));
                }
            } else {

                $success = $this->leaves_model->update_category($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Leave Category'));
                }

				//uploading category image
				if(!empty($_FILES['leaves_category_img'])){
					if(!empty($_FILES['leaves_category_img']['name'])){
							
							$param['upload_path'] = LEAVES_CATEGORY_IMAGES_FOLDER;
							
							$param['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
							$param['max_size'] = '2048570';
							//$param['encrypt_name'] =TRUE;
							$this->load->library('upload', $param);
							$this->upload->initialize($param);
							
							if(!$this->upload->do_upload('leaves_category_img')){
								echo  $errors = $this->upload->display_errors();	
								die;
								//$this->session->set_flashdata('msg_error', 'Fail to upload Image!');
								//redirect('leaves/add_category');
							}else{
								$file_array = $this->upload->data('file_name');
								
								$file_name = $file_array['file_name'];
								
								$up_data['leaves_category_img'] = $file_array;							
								$image_data = $this->upload->data();
								
								$this->home_model->update('tblleavescategories',$up_data,array('id'=>$id));
							
							}
						}
				}
                redirect(admin_url('leaves/categories'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'leave category');
        } else {
            $data['category'] = (array) $this->leaves_model->get_category($id);
            $title = _l('edit', 'leave category');
        }

        $data['title'] = $title;
        $this->load->view('admin/leaves/add_categories', $data);
    }

    

    public function delete_category($id)
    {
        if (!is_admin()) {
            access_denied('leaves');
        }
        if (!$id) {
            redirect(admin_url('leaves/categories'));
        }
        $response = $this->leaves_model->delete_category($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('expense_category_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('expense_category')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('expense_category_lowercase')));
        }
        redirect(admin_url('leaves/categories'));
    }


	
	 public function change_leaves_category_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->leaves_model->edit($unit_data, $id);
        }
    }
	
	
	 
	public function sendapproval()
    {
		$staffid=$this->input->post('staffid');
		$expenseid=$this->input->post('expenseid');
		
		$expense_info = $this->home_model->get_row('tblleaves', array('id'=>$expenseid), '');	
		
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
			$this->db->insert('tblleavesapproval',$prdata);
			
			 $notified = add_notification([
                        'description'     => 'leaves Send to you for Approval',
                        'touserid'        => $singlelead,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'leaves/list_leaves/' . $parent_id.'/approval_tab',
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
		$this->db->update('tblleaves', $prddata);
		exit;
	}
	
	public function approvalaccept()
    {
		$approve_status=$this->input->post('approve_status');
		$expenseid=$this->input->post('expenseid');
		$approvereason=$this->input->post('approvereason');
		$leadcreatorid=$this->input->post('leadcreatorid');
	
		
		$ldata = array(
				'approve_status' => $approve_status,
				'approvereason' => $approvereason,
				'updated_at' => date('Y-m-d H:i:s'),
		);
		
		$success = $this->home_model->update('tblleavesapproval',$ldata,array('expense_id'=>$expenseid,'staff_id'=>get_staff_user_id()));
		
		
		if($approve_status==1){
			$description = 'Expense approve Successfully';	
		}else{
			$description = 'Expense Decline';	
		}
		
		
		
		  $notified = add_notification([
                        'description'     => $description,
                        'touserid'        => $leadcreatorid,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'leaves/list_leaves/' . $expenseid.'/approval_tab',
                        /*'additional_data' => serialize([
                            $proposal->subject,
                        ]),*/
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$leadcreatorid]);
                    }	
		exit;
	}	
	
	public function get_total_days()
    {
		if(!empty($_POST)){
			extract($this->input->post());	
			
			$to_date = str_replace("/","-",$to_date);
			$to_date = date("Y-m-d",strtotime($to_date));
			$from_date = str_replace("/","-",$from_date);
			$from_date = date("Y-m-d",strtotime($from_date));
			
			$date1 = date_create($from_date);
			$date2 = date_create($to_date);
			$diff = date_diff($date1,$date2);
			
			$remain_days = $diff->format("%a");
			
			echo $remain_days+1;
		}
		
	}

	public function leave_approval($id = '')
    {
		if(!empty($id)){
			$data['request'] = $this->home_model->get_row('tblleaves', array('id'=>$id), '');
			
			if(!empty($data['request']) && $data['request']->approved_status == 0){
			
			$data['request_action'] = $this->home_model->get_row('tblleaveapproval', array('leave_id'=>$id,'staff_id'=>get_staff_user_id()), '');
			
			 if($this->input->post()) {
				extract($this->input->post());
					
					$ldata = array(
							'approve_status' => $approve_status,
							'approvereason' => $remark,
							'updated_at' => date('Y-m-d H:i:s'),
					);
					
					$success = $this->home_model->update('tblleaveapproval',$ldata,array('leave_id'=>$id,'staff_id'=>get_staff_user_id()));
					
					
					$update_data = array(
							'approved_status' => $approve_status,
							'approved_remark' => $remark,
							'approved_date' => date('Y-m-d'),
					);
					
					$update_request = $this->home_model->update('tblleaves',$update_data,array('id'=>$id));
					
					
					
					if($approve_status==1){
						$description = 'Leave Approve Successfully';	
					}else{
						$description = 'Leave Decline';	
					}
					
					
					
					  $notified = add_notification([
									'description'     => $description,
									'touserid'        => $creatorid,
									'fromuserid'      => get_staff_user_id(),
									'link'            => 'leaves/leave/'.$id,
									/*'additional_data' => serialize([
										$proposal->subject,
									]),*/
								]);
								if ($notified) {
									pusher_trigger_notification([$leadcreatorid]);
								}	
								
				 if($success){
					 set_alert('success', $description);
					redirect(admin_url('leaves/list_leaves'));	
				 }				
				
			 }
			
		 $data['title']      = 'Leave Approval';
         $this->load->view('admin/leaves/leave_approval', $data);
		 
			}else{
				set_alert('warning', 'Action Already Taken On Request');
				redirect(admin_url('leaves/list_leaves'));	
			}
		}else{
			set_alert('warning', 'Access denied !');
			redirect(admin_url('leaves/list_leaves'));	
			 
		}
	}	
	
	
	public function user_leave_validate()
    {
		if(!empty($_POST)){
			extract($this->input->post());	
			
			$date_arr = explode('/',$from_date);
			$month = $date_arr[1];
			
			$year = $date_arr[2];
			
			$user_id = get_staff_user_id();
			
			echo $check = leave_validate($user_id,$category,$month,$year);
			die;
			if($check == 1){
				echo 1;
			}
			
		}
		
	}
	
	
	
	
	public function setting()
    {
        /*if (!is_admin()) {
            access_denied('leaves');
        }*/
        
        $data['title'] = 'Leave Settings';
        $this->load->view('admin/leaves/manage_settings', $data);

    }
	
	public function setting_table() {
        $this->app->get_table_data('leaves_settings');
    }
	
	
	 public function add_setting($id = '') {
       
		$data['leave_categories'] = $this->home_model->get_result('tblleavescategories', array('status'=>1), '');
		

	   if ($this->input->post()) {
			extract($this->input->post());
            if ($id == '') {
				
				//$category_str = implode(',',$category_id);
				
				$ad_data = array(
					'leave_count' => $leave_count,
					'category_id' => $category_id,
					'status' => $status,
					'created_at' => date("Y-m-d H:i:s"),
					'updated_at' => date("Y-m-d H:i:s")
				);
				
				$insert_setting = $this->db->insert('tblleavesettings',$ad_data);
                
                if ($insert_setting) {					
					
                    set_alert('success', _l('added_successfully', 'Leave Setting'));
                    redirect(admin_url('leaves/setting'));
                }
            } else {

				
				//$category_str = implode(',',$category_id);
				$up_data = array(
					'leave_count' => $leave_count,
					'category_id' => $category_id,
					'status' => $status,
					'updated_at' => date("Y-m-d H:i:s")
				);
                $success = $this->home_model->update('tblleavesettings',$up_data,array('id'=>$id));
				
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Leave Setting'));
                }

				
                redirect(admin_url('leaves/setting'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'leave setting');
        } else {
            $data['category'] = $this->home_model->get_row('tblleavesettings', array('id'=>$id), '');
            $title = _l('edit', 'leave setting');
			
        }

        $data['title'] = $title;
        $this->load->view('admin/leaves/add_settings', $data);
    }
	
	
	 public function change_leaves_setting_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->home_model->update('tblleavesettings',$unit_data, $id);
        }
    }
	
	
	public function delete_leaves_setting($id) {
            $unit_data = array(
                'id' => $id
            );
            
           $response = $this->home_model->delete('tblleavesettings',$unit_data);
		   			
			if ($response == true) {
				set_alert('success', _l('deleted', 'Setting'));
				redirect(admin_url('leaves/setting'));
			} else {
				 set_alert('warning', _l('problem_deleting', 'delete setting'));
				 redirect(admin_url('leaves/setting'));
			}

    }
	
	
	public function check_pending_leave() {
           echo check_pending_leave();
    }
	
	public function cancel_leave($id)
    {
					
		$success = cancel_leave_requset($id);
		
		if($success){
			 set_alert('success', 'Leave Cancelled Successfully');
			redirect(admin_url('leaves'));	
		 }
	}
}
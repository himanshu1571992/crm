<?php
defined('BASEPATH') or exit('No direct script access allowed');
require_once APPPATH.'third_party/dompdf/autoload.inc.php';
use Dompdf\Dompdf;
class Expenses extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('expenses_model');
        $this->load->model('home_model');
    }

    public function index($id = '')
    {

        $this->list_expenses($id);
    }

    public function list_expenses($id = '')
    {
        check_permission(104,'view');
        close_setup_menu();

        if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }

        $data['expenseid']  = $id;
        $data['categories'] = $this->expenses_model->get_category();
        $data['years']      = $this->expenses_model->get_expenses_years();
        $data['title']      = _l('expenses');

        $this->load->view('admin/expenses/manage', $data);
    }

    public function table($clientid = '')
    {
        if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            ajax_access_denied();
        }

        $this->app->get_table_data('expenses', [
            'clientid' => $clientid,
        ]);
    }

	public function category_table() {
        $this->app->get_table_data('expenses_categories');
    }

    public function expense($id = '')
    {

	   if ($this->input->post()) {
		extract($this->input->post());

            if ($id == '') {
                if (!has_permission('expenses', '', 'create')) {
                    set_alert('danger', _l('access_denied'));
                    echo json_encode([
                        'url' => admin_url('expenses/expense'),
                    ]);
                    die;
                }
                $id = $this->expenses_model->add($this->input->post());
                if ($id) {
					$get_receipt = $this->home_model->get_row('tblexpenses', array('id'=>$id), '');
					if(!empty($get_receipt) && $get_receipt->repeat == 1){
						 set_alert('success', _l('added_successfully', _l('expense')));
							echo json_encode([
							'url'       => admin_url('expenses/repeat_expense/' . $id),
							'expenseid' => $id,
						]);
						die;
					}else{
						 set_alert('success', _l('added_successfully', _l('expense')));
						echo json_encode([
							'url'       => admin_url('expenses/list_expenses/' . $id.'/approval_tab'),
							'expenseid' => $id,
						]);
						die;
					}


                }
                echo json_encode([
                    'url' => admin_url('expenses/expense'),
                ]);
                die;

            }

            if (!has_permission('expenses', '', 'edit')) {
                set_alert('danger', _l('access_denied'));
                echo json_encode([
                        'url' => admin_url('expenses/expense/' . $id),
                    ]);
                die;
            }
            $success = $this->expenses_model->update($this->input->post(), $id);
            if ($success) {
                set_alert('success', _l('updated_successfully', _l('expense')));
            }
            echo json_encode([
                    'url'       => admin_url('expenses/list_expenses/' . $id),
                    'expenseid' => $id,
                ]);
            die;
        }
        if ($id == '') {
            $title = _l('add_new', _l('expense_lowercase'));
        } else {
            $data['expense'] = $this->expenses_model->get($id);

            if (!$data['expense'] || (!has_permission('expenses', '', 'view') && $data['expense']->addedfrom != get_staff_user_id())) {
                blank_page(_l('expense_not_found'));
            }

            $title = _l('edit', _l('expense_lowercase'));
        }

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('taxes_model');
        $this->load->model('payment_modes_model');
        $this->load->model('currencies_model');

        $data['taxes']         = $this->taxes_model->get();
        $data['categories']    = $this->expenses_model->get_category();
        $data['travel_mode']    = $this->expenses_model->get_travemode();
        $data['purpose_list']    = $this->expenses_model->get_purpose();
        $data['bill_type']    = $this->expenses_model->get_billtype();
        $data['paid_by']    = $this->expenses_model->get_paidby();
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
		$data['tempo_info'] = $this->home_model->get_result('tbltempo', array('status'=>1), '');
		$data['state_info'] = $this->home_model->get_result('tblstates', array('status'=>1), '');

        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'invoices_only !=' => 1,
        ]);
        $data['bodyclass']  = 'expense';
        $data['currencies'] = $this->currencies_model->get();
        $data['title']      = $title;
        $this->load->view('admin/expenses/expense', $data);
    }


	public function settings($id = '')
    {

       check_permission('136,268','view');
	   $settings = $this->expenses_model->get_settings(1);
	   $data['day'] = $settings->last_expense_date_limit;

	   if ($this->input->post()) {
		extract($this->input->post());

          	check_permission('136,268','create');

			$success = $this->home_model->update('tblexpensesetting',array('last_expense_date_limit'=>$last_expense_date_limit),array('id'=>1));

            if ($success) {
                set_alert('success', _l('updated_successfully', 'Expense Setting'));
            }

        }

        $data['title']      = 'Expense Settings';
        $this->load->view('admin/expenses/settings', $data);
    }


	public function repeat_expense($id = '')
    {
        if ($this->input->post()) {

            if ($id == '') {
                if (!has_permission('expenses', '', 'create')) {
                    set_alert('danger', _l('access_denied'));
                    echo json_encode([
                        'url' => admin_url('expenses/expense'),
                    ]);
                    die;
                }
                $id = $this->expenses_model->add($this->input->post());
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('expense')));
                    echo json_encode([
                        'url'       => admin_url('expenses/list_expenses/' . $id),
                        'expenseid' => $id,
                    ]);
                    die;
                }
                echo json_encode([
                    'url' => admin_url('expenses/expense'),
                ]);
                die;
            }
            if (!has_permission('expenses', '', 'edit')) {
                set_alert('danger', _l('access_denied'));
                echo json_encode([
                        'url' => admin_url('expenses/expense/' . $id),
                    ]);
                die;
            }
            $success = $this->expenses_model->update($this->input->post(), $id);
            if ($success) {
                set_alert('success', _l('updated_successfully', _l('expense')));
            }
            echo json_encode([
                    'url'       => admin_url('expenses/list_expenses/' . $id),
                    'expenseid' => $id,
                ]);
            die;
        }
        if ($id == '') {
            $title = _l('add_new', _l('expense_lowercase'));
        } else {


            $data['expense'] = $this->expenses_model->get($id);




            if (!$data['expense'] || (!has_permission('expenses', '', 'view') && $data['expense']->addedfrom != get_staff_user_id())) {
                blank_page(_l('expense_not_found'));
            }

			if($data['expense']->parent_id > 0){
				$data['parent_id'] = $data['expense']->parent_id;
			}else{
				$data['parent_id'] = $id;
			}

			//Getting Last Expenses
			$expense_info = get_last_expense($data['parent_id']);

			 $data['expense'] = $this->expenses_model->get($expense_info[0]->id);

            $title = _l('edit', _l('expense_lowercase'));
        }

        if ($this->input->get('customer_id')) {
            $data['customer_id'] = $this->input->get('customer_id');
        }

        $this->load->model('taxes_model');
        $this->load->model('payment_modes_model');
        $this->load->model('currencies_model');


        $data['taxes']         = $this->taxes_model->get();
        $data['categories']    = $this->expenses_model->get_category();
        $data['travel_mode']    = $this->expenses_model->get_travemode();
        $data['purpose_list']    = $this->expenses_model->get_purpose();
        $data['bill_type']    = $this->expenses_model->get_billtype();
		$data['paid_by']    = $this->expenses_model->get_paidby();
		$data['branch_info'] = $this->home_model->get_result('tblcompanybranch', array('status'=>1), '');
		$data['tempo_info'] = $this->home_model->get_result('tbltempo', array('status'=>1), '');
		$data['state_info'] = $this->home_model->get_result('tblstates', array('status'=>1), '');

		/*echo '<pre/>';
		print_r($data['bill_type']);
		die;*/

        $data['payment_modes'] = $this->payment_modes_model->get('', [
            'invoices_only !=' => 1,
        ]);

        $data['bodyclass']  = 'expense';
        $data['currencies'] = $this->currencies_model->get();
        $data['title']      = 'Repeat Expense';
        $this->load->view('admin/expenses/repeat_expense', $data);
    }

    public function get_expenses_total()
    {
        if ($this->input->post()) {
            $data['totals'] = $this->expenses_model->get_expenses_total($this->input->post());

            if ($data['totals']['currency_switcher'] == true) {
                $this->load->model('currencies_model');
                $data['currencies'] = $this->currencies_model->get();
            }

            $data['expenses_years'] = $this->expenses_model->get_expenses_years();

            if (count($data['expenses_years']) >= 1 && $data['expenses_years'][0]['year'] != date('Y')) {
                array_unshift($data['expenses_years'], ['year' => date('Y')]);
            }

            $data['_currency'] = $data['totals']['currencyid'];
            $this->load->view('admin/expenses/expenses_total_template', $data);
        }
    }

    public function delete($id)
    {
        if (!has_permission('expenses', '', 'delete')) {
            access_denied('expenses');
        }
        if (!$id) {
            redirect(admin_url('expenses/list_expenses'));
        }
        $response = $this->expenses_model->delete($id);
        if ($response === true) {
            set_alert('success', _l('deleted', _l('expense')));
        } else {
            if (is_array($response) && $response['invoiced'] == true) {
                set_alert('warning', _l('expense_invoice_delete_not_allowed'));
            } else {
                set_alert('warning', _l('problem_deleting', _l('expense_lowercase')));
            }
        }

        if (strpos($_SERVER['HTTP_REFERER'], 'expenses/') !== false) {
            redirect(admin_url('expenses/list_expenses'));
        } else {
            redirect($_SERVER['HTTP_REFERER']);
        }
    }

    public function copy($id)
    {
        if (!has_permission('expenses', '', 'create')) {
            access_denied('expenses');
        }
        $new_expense_id = $this->expenses_model->copy($id);
        if ($new_expense_id) {
            set_alert('success', _l('expense_copy_success'));
            redirect(admin_url('expenses/expense/' . $new_expense_id));
        } else {
            set_alert('warning', _l('expense_copy_fail'));
        }
        redirect(admin_url('expenses/list_expenses/' . $id));
    }

    public function convert_to_invoice($id)
    {
        if (!has_permission('invoices', '', 'create')) {
            access_denied('Convert Expense to Invoice');
        }
        if (!$id) {
            redirect(admin_url('expenses/list_expenses'));
        }
        $draft_invoice = false;
        if ($this->input->get('save_as_draft')) {
            $draft_invoice = true;
        }

        $params = [];
        if ($this->input->get('include_note') == 'true') {
            $params['include_note'] = true;
        }

        if ($this->input->get('include_name') == 'true') {
            $params['include_name'] = true;
        }

        $invoiceid = $this->expenses_model->convert_to_invoice($id, $draft_invoice, $params);
        if ($invoiceid) {
            set_alert('success', _l('expense_converted_to_invoice'));
            redirect(admin_url('invoices/invoice/' . $invoiceid));
        } else {
            set_alert('warning', _l('expense_converted_to_invoice_fail'));
        }
        redirect(admin_url('expenses/list_expenses/' . $id));
    }

    public function get_expense_data_ajax($id)
    {
        if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            echo _l('access_denied');
            die;
        }
        $expense = $this->expenses_model->get($id);

        /*if (!$expense || (!has_permission('expenses', '', 'view') && $expense->addedfrom != get_staff_user_id())) {
            echo _l('expense_not_found');
            die;
        }*/




        $data['expense'] = $expense;
        if ($expense->billable == 1) {
            if ($expense->invoiceid !== null) {
                $this->load->model('invoices_model');
                $data['invoice'] = $this->invoices_model->get($expense->invoiceid);
            }
        }


		//$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = get_staff_group(13);
		$Staffgroup = get_staff_group(13);
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


        $data['child_expenses'] = $this->expenses_model->get_child_expenses($id);
        $data['members']        = $this->staff_model->get('', ['active' => 1]);
        $this->load->view('admin/expenses/expense_preview_template', $data);
    }

    public function get_customer_change_data($customer_id = '')
    {
        echo json_encode([
            'customer_has_projects' => customer_has_projects($customer_id),
            'client_currency'       => $this->clients_model->get_customer_default_currency($customer_id),
        ]);
    }

    public function categories()
    {
        if (!is_admin()) {
            access_denied('expenses');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('expenses_categories');
        }
        $data['title'] = _l('expense_categories');
        $this->load->view('admin/expenses/manage_categories', $data);

    }


	 public function add_category($id = '') {
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->expenses_model->add_category($unit_data);
                if ($id) {

					//uploading category image
					if(!empty($_FILES['expenses_category_img'])){
						if(!empty($_FILES['expenses_category_img']['name'])){

								$param['upload_path'] = EXPENSE_CATEGORY_IMAGES_FOLDER;

								$param['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
								$param['max_size'] = '2048570';
								//$param['encrypt_name'] =TRUE;
								$this->load->library('upload', $param);
								$this->upload->initialize($param);

								if(!$this->upload->do_upload('expenses_category_img')){
									echo  $errors = $this->upload->display_errors();
									die;
									//$this->session->set_flashdata('msg_error', 'Fail to upload Image!');
									//redirect('expenses/add_category');
								}else{
									$file_array = $this->upload->data('file_name');
									$file_name = $file_array['file_name'];
									$up_data['expenses_category_img'] = $file_array;
									$image_data = $this->upload->data();

									$this->home_model->update('tblexpensescategories',$up_data,array('id'=>$id));

								}
							}
					}


                    set_alert('success', _l('added_successfully', _l('expense_category')));
                    redirect(admin_url('expenses/categories'));
                }
            } else {

                $success = $this->expenses_model->update_category($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('expense_category')));
                }

				//uploading category image
				if(!empty($_FILES['expenses_category_img'])){
					if(!empty($_FILES['expenses_category_img']['name'])){

							$param['upload_path'] = EXPENSE_CATEGORY_IMAGES_FOLDER;

							$param['allowed_types'] = 'jpg|JPG|PNG|GIF|jpeg|gif|png';
							$param['max_size'] = '2048570';
							//$param['encrypt_name'] =TRUE;
							$this->load->library('upload', $param);
							$this->upload->initialize($param);

							if(!$this->upload->do_upload('expenses_category_img')){
								echo  $errors = $this->upload->display_errors();
								die;
								//$this->session->set_flashdata('msg_error', 'Fail to upload Image!');
								//redirect('expenses/add_category');
							}else{
								$file_array = $this->upload->data('file_name');

								$file_name = $file_array['file_name'];

								$up_data['expenses_category_img'] = $file_array;
								$image_data = $this->upload->data();

								$this->home_model->update('tblexpensescategories',$up_data,array('id'=>$id));

							}
						}
				}
                redirect(admin_url('expenses/categories'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('unit_lowercase'));
        } else {
            $data['category'] = (array) $this->expenses_model->get_category($id);
            $title = _l('edit', _l('unit_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/expenses/add_categories', $data);
    }

    public function category()
    {
        if (!is_admin() && get_option('staff_members_create_inline_expense_categories') == '0') {
            access_denied('expenses');
        }
        if ($this->input->post()) {
            if (!$this->input->post('id')) {
                $id = $this->expenses_model->add_category($this->input->post());
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
                $success = $this->expenses_model->update_category($data, $id);
                $message = _l('updated_successfully', _l('expense_category'));
                echo json_encode(['success' => $success, 'message' => $message]);
            }
        }
    }

    public function delete_category($id)
    {
        if (!is_admin()) {
            access_denied('expenses');
        }
        if (!$id) {
            redirect(admin_url('expenses/categories'));
        }
        $response = $this->expenses_model->delete_category($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('expense_category_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('expense_category')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('expense_category_lowercase')));
        }
        redirect(admin_url('expenses/categories'));
    }

    public function add_expense_attachment($id)
    {
        handle_expense_attachments($id);
        echo json_encode([
            'url' => admin_url('expenses/list_expenses/' . $id),
        ]);
    }

    public function delete_expense_attachment($id, $preview = '')
    {
        $this->db->where('id', $id);
        //$this->db->where('rel_id', $id);
       // $this->db->where('rel_type', 'expense');
        $file = $this->db->get('tblfiles')->row();

        if ($file->staffid == get_staff_user_id() || is_admin()) {
            //$success = $this->expenses_model->delete_expense_attachment($id);
		   $success =  $this->home_model->delete('tblfiles',array('id'=>$id));
            if ($success) {
                set_alert('success', _l('deleted', _l('expense_receipt')));
            } else {
                set_alert('warning', _l('problem_deleting', _l('expense_receipt_lowercase')));
            }
            if ($preview == '') {
                redirect(admin_url('expenses/expense/' . $id));
            } else {
                redirect(admin_url('expenses/list_expenses/' . $id));
            }
        } else {
            access_denied('expenses');
        }
    }


	 public function change_expense_category_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );

            $this->expenses_model->edit($unit_data, $id);
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

			$settings = $this->expenses_model->get_settings(1);
			$day = $settings->last_expense_date_limit;

			$last_date = date('d-m-Y',strtotime("-$day Day"));

			/*if($date < $last_date){
				echo 'Date Cannot Select More Then Last '.$day.' Days';
			}*/


			 $date = new DateTime($date);
			 $last_date    = new DateTime($last_date);

			if($date < $last_date){
					echo 'Date Cannot Select More Than Last '.$day.' Days';
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

			//Sending Mobile Intimation
			$token = get_staff_token($singlelead);
			$message = 'Expenses Send to you for Approval';
			$title = 'Schach';
			$send_intimation = sendFCM($message, $title, $token);

			$notified = add_notification([
                        'description'     => 'Expenses Send to you for Approval',
                        'touserid'        => $singlelead,
						'type'            => 1,
						'module_id'       => 2,
						'table_id'        => $parent_id,
						'category_id'     => $expense_info->category,
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



	public function approvalaccept()
    {


		$approve_status=$this->input->post('approve_status');
		$expenseid=$this->input->post('expenseid');
		$approvereason=$this->input->post('approvereason');
		$leadcreatorid=$this->input->post('leadcreatorid');


		$expense_info = $this->home_model->get_row('tblexpenses', array('id'=>$expenseid), '');

		if(!empty($expense_info) && $expense_info->approved_status == 0){

		$ldata = array(
				'approve_status' => $approve_status,
				'approvereason' => $approvereason,
				'updated_at' => date('Y-m-d H:i:s'),
		);

		$success = $this->home_model->update('tblexpensesapproval',$ldata,array('expense_id'=>$expenseid,'staff_id'=>get_staff_user_id()));



		if($approve_status==1){
			$approve = $this->home_model->update('tblexpenses',array('approved_status'=>1),array('id'=>$expenseid));
			$approve_child = $this->home_model->update('tblexpenses',array('approved_status'=>1),array('parent_id'=>$expenseid));

			$description = 'Expense approve Successfully';
		}else{
			$approve = $this->home_model->update('tblexpenses',array('approved_status'=>$approve_status),array('id'=>$expenseid));
			$approve_child = $this->home_model->update('tblexpenses',array('approved_status'=>$approve_status),array('parent_id'=>$expenseid));
			$description = 'Expense Decline';
		}



		  $notified = add_notification([
                        'description'     => $description,
                        'touserid'        => $leadcreatorid,
                        'fromuserid'      => get_staff_user_id(),
                        'link'            => 'expenses/list_expenses/' . $expenseid.'/approval_tab',
                        /*'additional_data' => serialize([
                            $proposal->subject,
                        ]),*/
                    ]);
                    if ($notified) {
                        pusher_trigger_notification([$leadcreatorid]);
                    }
		exit;
	}else{

	}

	}





    public function purposes() {
        check_permission('137,269', 'view');
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('expenses_categories');
        }
        $data['title'] = _l('expense_purpose');
        $this->load->view('admin/expenses/manage_purpose', $data);

    }


	 public function add_purpose($id = '') {
        check_permission('137,269','create');
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->expenses_model->add_purpose($unit_data);
                if ($id) {

                    set_alert('success', _l('added_successfully', 'Expense Purpose'));
                    redirect(admin_url('expenses/purposes'));
                }
            } else {
                check_permission('137,269','edit');
                $success = $this->expenses_model->update_purpose($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Expense Purpose'));
                }


                redirect(admin_url('expenses/purposes'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'purpose');
        } else {
            $data['purpose'] = (array) $this->expenses_model->get_purpose($id);
            $title = _l('edit', 'purpose');
        }

        $data['title'] = $title;
        $this->load->view('admin/expenses/add_purpose', $data);
    }

    public function purpose()
    {
        if (!is_admin() && get_option('staff_members_create_inline_expense_categories') == '0') {
            access_denied('expenses');
        }
        if ($this->input->post()) {
            if (!$this->input->post('id')) {
                $id = $this->expenses_model->add_category($this->input->post());
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
                $success = $this->expenses_model->update_category($data, $id);
                $message = _l('updated_successfully', _l('expense_category'));
                echo json_encode(['success' => $success, 'message' => $message]);
            }
        }
    }

    public function delete_purpose($id)
    {
        check_permission('137,269','delete');
        if (!$id) {
            redirect(admin_url('expenses/purposes'));
        }

        $expenses = $this->db->query("SELECT * FROM `tblexpenses` where purpose = '".$id."' ")->row();

        if (!empty($expenses) ){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }


        $response = $this->expenses_model->delete_purpose($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', _l('expense_category_lowercase')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('expense_category')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('expense_category_lowercase')));
        }
        redirect(admin_url('expenses/purposes'));
    }

	public function purpose_table() {
        $this->app->get_table_data('expenses_purpose');
    }


	 public function change_expense_purpose_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );

            $this->expenses_model->edit_purpose($unit_data, $id);
        }
    }


    /*Start BillType Master*/
    public function billtypes()
    {
        check_permission('142,274','view');

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('expenses_categories');
        }
        $data['title'] = 'Expense Bill type';
        $this->load->view('admin/expenses/manage_billtype', $data);

    }


     public function add_billtype($id = '') {
        check_permission('142,274','create');
        if ($this->input->post()) {
            $unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->expenses_model->add_billtype($unit_data);
                if ($id) {

                    set_alert('success', _l('added_successfully', 'Bill Type'));
                    redirect(admin_url('expenses/billtypes'));
                }
            } else {
                check_permission('142,274','edit');
                $success = $this->expenses_model->update_billtype($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', 'Bill Type'));
                }


                redirect(admin_url('expenses/billtypes'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'bill type');
        } else {
            $data['billtype'] = (array) $this->expenses_model->get_billtype($id);
            $title = _l('edit', 'bill type');
        }

        $data['title'] = $title;
        $this->load->view('admin/expenses/add_billtype', $data);
    }


    public function delete_billtype($id)
    {
        check_permission('142,274','delete');
        if (!$id) {
            redirect(admin_url('expenses/billtypes'));
        }

        $expenses = $this->db->query("SELECT * FROM `tblexpenses` where bill_type = '".$id."' ")->row();

        if (!empty($expenses)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }

        $response = $this->expenses_model->delete_billtype($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('is_referenced', 'bill type'));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', 'bill type'));
        } else {
            set_alert('warning', _l('problem_deleting', 'bill type'));
        }
        redirect(admin_url('expenses/billtypes'));
    }

    public function billtype_table() {
        $this->app->get_table_data('expenses_billtype');
    }


     public function change_billtype_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );

            $this->expenses_model->edit_billtype($unit_data, $id);
        }
    }

    /*End BillType Master*/



	public function get_employee_by_branch() {
        if ($this->input->is_ajax_request()) {
            extract($this->input->post());

				$staff_list = get_staff_list($branch_id);

				if(!empty($staff_list)){
					echo '<option value="" disabled selected >--Select One-</option>';
					foreach($staff_list as $row){
						echo '<option value="'.$row->staffid.'" >'.$row->firstname.'</option>';
					}
				}

        }
    }






	public function tempo()
    {
        check_permission('141,273','view');

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('expenses_categories');
        }
        $data['title'] = 'Tempo';
        $this->load->view('admin/expenses/manage_tempo', $data);
    }


	 public function add_tempo($id = '') {
        check_permission('141,273','create');

        $data['staff_list'] = get_staff_list();
        if ($this->input->post()) {
			$unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->expenses_model->add_tempo($unit_data);
                if ($id) {

                    handle_multi_task_attachments($id,'tempo');

                    set_alert('success', _l('added_successfully', 'Tempo'));
                    redirect(admin_url('expenses/tempo'));
                }
            } else {
                check_permission('141,273','edit');
                $success = $this->expenses_model->update_tempo($unit_data, $id);
                if ($success) {
                    handle_multi_task_attachments($id,'tempo');
                    set_alert('success', _l('updated_successfully', 'Tempo'));
                }


                redirect(admin_url('expenses/tempo'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', 'tempo');
        } else {
            $data['tempo'] = (array) $this->expenses_model->get_tempo($id);

            $title = _l('edit', 'tempo');
        }

        $data['title'] = $title;
        $this->load->view('admin/expenses/add_tempo', $data);
    }

    public function delete_tempo($id)
    {
        check_permission('141,273','delete');

        if (!$id) {
            redirect(admin_url('expenses/tempo'));
        }
        $response = $this->expenses_model->delete_tempo($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('expense_category')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('expense_category_lowercase')));
        }
        redirect(admin_url('expenses/tempo'));
    }

	public function tempo_table(){

        $this->app->get_table_data('tempo');

    }

	 public function change_tempo_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $unit_data = array(
                'status' => $status
            );

            $this->expenses_model->edit_tempo($unit_data, $id);
        }
    }


	public function list_expenses_print($id = '')
    {

        /*if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }*/
        check_permission('124,234','view');

		$data['staff_list'] = get_staff_list();
		$data['staff_list'] = $this->db->query("SELECT * FROM `tblstaff` where active IN (1,0) ORDER BY firstname ASC")->result();


		$data['title'] = 'Print Expense format';

        $this->load->view('admin/expenses/print_expense_list', $data);
    }

	public function expense_print($id = '')
    {

        /*if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }*/
		if(!empty($_POST)){
			extract($this->input->post());
			$data['f_date'] = $f_date;
			$data['t_date'] = $t_date;

			$from = str_replace("/","-",$f_date);
			$data['from_date'] = date("Y-m-d",strtotime($from));
			$to = str_replace("/","-",$t_date);
			$data['to_date'] = date("Y-m-d",strtotime($to));


			$date_from = strtotime($data['from_date']);

			$date_to = strtotime($data['to_date']);

			$date_arr = array();
			for($i=$date_from; $i<=$date_to; $i+=86400) {
				$date_arr[] = date("Y-m-d", $i);
			}
			$data['date_list'] = $date_arr;

			$data['expense_list'] = get_expense_by_date($staff_id,$f_date,$t_date);

			$test = get_expense_by_parent(1);

			$data['staff_id'] = $staff_id;
			$this->load->view('admin/expenses/expense_print', $data);
		}


    }

	public function expense_print_details($f_date,$t_date,$staff_id)
    {

        /*if (!has_permission('expenses', '', 'view') && !has_permission('expenses', '', 'view_own')) {
            access_denied('expenses');
        }*/
		 if(!empty($f_date) && !empty($t_date) && !empty($staff_id)){

			$data['f_date'] = $f_date;
			$data['t_date'] = $t_date;

			$from = str_replace("/","-",$f_date);
			$data['from_date'] = date("Y-m-d",strtotime($from));
			$to = str_replace("/","-",$t_date);
			$data['to_date'] = date("Y-m-d",strtotime($to));


			$date_from = strtotime($data['from_date']);

			$date_to = strtotime($data['to_date']);

			$date_arr = array();
			for($i=$date_from; $i<=$date_to; $i+=86400) {
				$date_arr[] = date("Y-m-d", $i);
			}
			$data['date_list'] = $date_arr;

			$data['expense_list'] = get_expense_by_date($staff_id,$f_date,$t_date);

			$test = get_expense_by_parent(1);

			$data['staff_id'] = $staff_id;
			$this->load->view('admin/expenses/expense_print_details', $data);
		}


    }


	public function download_pdf($f_date,$t_date,$staff_id)
    {
        if(!empty($f_date) && !empty($t_date) && !empty($staff_id)){
			require_once APPPATH.'third_party/pdfcrowd.php';



			$expense_list = get_expense_by_date($staff_id,$f_date,$t_date);

			$date_from = strtotime($f_date);

			$date_to = strtotime($t_date);

			$date_list = array();
			for($i=$date_from; $i<=$date_to; $i+=86400) {
				$date_list[] = date("Y-m-d", $i);
			}


			$test = get_expense_by_parent(1);


			$file_name = 'Expense_report (EMP-'.$staff_id.')';

			$html = get_pdf_data($f_date,$t_date,$staff_id,$date_list);
			$dompdf = new Dompdf();
			$dompdf->loadHtml($html);
			$dompdf->setPaper('A4', 'landscape');
			$dompdf->render();
			$dompdf->stream($file_name);

		}

    }


	public function get_cites()
    {
		if(!empty($_POST)){
			extract($this->input->post());

			$state_info = $this->home_model->get_row('tblstates', array('name'=>$state), '');
			if(!empty($state_info)){
				$city_info = $this->home_model->get_result('tblcities', array('state_id'=>$state_info->id,'status'=>1), '');
				if(!empty($city_info)){
					echo '<option value="" disabled selected >--Select City-</option>';
					foreach($city_info as $row){
						echo '<option value="'.$row->name.'" >'.$row->name.'</option>';
					}
				}
			}



		}

	}


	public function test_fcm()
    {

		$id = 'dNzUEu3NMfM:APA91bEkOpxTic496au2ZTXWF0CDNZhI3O1FS-XO0_hfeMmsNuPj0NTNzvLskWkRGAw5b0nQbcxcG-aLAJAqyupcMeRiSWNrHYwiJf9Cj9tmFMlj2kGedGzacIaMSjmsJ4InU6LJL2sm';

		$title = 'Check FCM';
		$message = 'Testing for Oppo Notification';

		$url = 'https://fcm.googleapis.com/fcm/send';
			$fields = array (
					'registration_ids' => array (
							$id
					),
					'data' => array (
							"title" => $title,
							"message" => $message
					)
			);
			$fields = json_encode ( $fields );

			$headers = array (
					'Authorization: key=' . "AIzaSyA6zZzxf-9U93bgAuSue7NbQKMBsnHOSdw",
					'Content-Type: application/json'
			);

			$ch = curl_init ();
			curl_setopt ( $ch, CURLOPT_URL, $url );
			curl_setopt ( $ch, CURLOPT_POST, true );
			curl_setopt ( $ch, CURLOPT_HTTPHEADER, $headers );
			curl_setopt ( $ch, CURLOPT_RETURNTRANSFER, true );
			curl_setopt ( $ch, CURLOPT_POSTFIELDS, $fields );

			$result = curl_exec ( $ch );
			echo $result;
			curl_close ( $ch );
	}

	public function rejectapproval()
    {
		if(!empty($_POST)){
			extract($this->input->post());

			$reject = $this->home_model->update('tblexpenses',array('approved_status'=>2),array('id'=>$id));

			$reject_child = $this->home_model->update('tblexpenses',array('approved_status'=>2),array('parent_id'=>$id));

			$update = $this->home_model->update('tblexpensesapproval',array('approve_status'=>2,'updated_at'=>date('Y-m-d H:i:s')),array('expense_id'=>$id,'approve_status'=>1));

			if($update == true){
				echo '1';
			}

		}
	}


    public function employee_payble()
    {
        check_permission(71,'view');
        $data['title'] = 'Employee Payble Report';
        $data['staff_list'] = get_staff_list();

        $data['s_staff'] = '';


        if(!empty($_POST)){
           extract($this->input->post());

           $data['s_fdate'] = $f_date;
            $data['s_tdate'] = $t_date;

            $f_date = str_replace("/","-",$f_date);
            $f_date = date("Y-m-d",strtotime($f_date));

            $t_date = str_replace("/","-",$t_date);
            $t_date = date("Y-m-d",strtotime($t_date));

            $data['s_staff'] = $staff_id;

           $data['expense_payble_info'] = $this->db->query("SELECT * FROM `tblexpenses` where  addedfrom = '".$staff_id."' and approved_status = 1 and paidby_employee > 0 and status = 1 and date between '".$f_date."' and '".$t_date."' ")->result();

        }

        $this->load->view('admin/expenses/employee_payble', $data);
    }


     public function test_upload($id = '') {
        if ($this->input->post()) {
            /*echo '<pre/>';
            print_r($_FILES);
            die;*/
            handle_multi_task_attachments(999,'task');

        }



        $data['title'] = 'Test Upload';
        $this->load->view('admin/expenses/test_upload', $data);
    }


    public function expense_type_report()
    {
        check_permission(109,'view');
        $data['title'] = 'Expense Type Report';
        $data['staff_list'] = get_staff_list();
        $data['type_info'] = $this->db->query("SELECT * FROM `tblexpensetype` where  status = 1 ")->result();

        $data['s_staff'] = '';
        $data['s_type'] = '';
        $data['s_fdate'] = '';
        $data['s_tdate'] = '';


        if(!empty($_GET)){
           extract($this->input->get());

           if(!empty($f_date) || !empty($t_date) || !empty($staff_id) || !empty($type_id)){
                $where = "approved_status = 1 and status = 1 ";
                if(!empty($f_date) && !empty($t_date)){
                    $data['s_fdate'] = $f_date;
                    $data['s_tdate'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= "and date between '".$f_date."' and '".$t_date."' ";
                }

                if(!empty($staff_id)){
                    $where .= "and addedfrom = '".$staff_id."' ";
                    $data['s_staff'] = $staff_id;
                }

                if(!empty($type_id)){
                    $where .= "and type_id = '".$type_id."' ";
                    $data['s_type'] = $type_id;
                }

               $data['expense_info'] = $this->db->query("SELECT * FROM `tblexpenses` where   ".$where."  ")->result();
            }else{
                $data['expense_info'] = $this->db->query("SELECT * FROM `tblexpenses` where approved_status = 1 and status = 1 and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' ")->result();
            }
        }else{
            $data['expense_info'] = $this->db->query("SELECT * FROM `tblexpenses` where approved_status = 1 and status = 1 and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' ")->result();
        }

        $this->load->view('admin/expenses/expense_type_report', $data);
    }


    public function change_expense_type_modal(){
        if(!empty($_POST)){
           extract($this->input->post());
            $expense_info = $this->db->query("SELECT * FROM `tblexpenses` where  id = '".$expense_id."'  ")->row();
            $type_info = $this->db->query("SELECT * FROM `tblexpensetype` where  status = '1'  ")->result();
            $subtype_info = $this->db->query("SELECT * FROM `tblexpensetypesub` where  status = '1'  ")->result();

            if($expense_info->parent_id > 0){
                $parent_id = $expense_info->parent_id;
            }else{
                $parent_id = $expense_info->id;
            }

            $column = '';
            if($expense_info->category == 2){
                $column = 'tempo_bill_type';
            }elseif($expense_info->category == 4){
                $column = 'hotel_bill_type';
            }elseif($expense_info->category == 6){
                $column = 'extra_bill_type';
            }
           ?>
            <form action="<?php echo admin_url('expenses/update_expense_type');?>" class="proposal-form" enctype="multipart/form-data" method="post" accept-charset="utf-8">
            <div class="row">
                <div class="col-md-4">Date<div class="well well-sm"><?php echo $expense_info->date; ?></div></div>
                <div class="col-md-4">EXP-ID<div class="well well-sm"><?php echo 'EXP-'.get_short(get_expense_category($expense_info->category)).'-'.number_series($parent_id);?></div></div>
                <div class="col-md-4">Employee Name<div class="well well-sm"><?php echo get_employee_name($expense_info->addedfrom);?></div></div>

                <input type="hidden" name="column" value="<?php echo $column; ?>">
                <input type="hidden" name="category" value="<?php echo $expense_info->category; ?>">

                <?php
                if($expense_info->category == 2 || $expense_info->category == 4 || $expense_info->category == 6){
                    $bill_selected = '';
                    $without_bill_selected = '';
                    $gst_bill_selected = '';
                    if($expense_info->category == 2){
                        if($expense_info->tempo_bill_type == 1){
                            $bill_selected = 'selected';
                        }elseif($expense_info->tempo_bill_type == 2){
                            $without_bill_selected = 'selected';
                        }elseif($expense_info->tempo_bill_type == 3){
                            $gst_bill_selected = 'selected';
                        }
                    }elseif($expense_info->category == 4){
                        if($expense_info->hotel_bill_type == 1){
                            $bill_selected = 'selected';
                        }elseif($expense_info->hotel_bill_type == 2){
                            $without_bill_selected = 'selected';
                        }elseif($expense_info->hotel_bill_type == 3){
                            $gst_bill_selected = 'selected';
                        }
                    }elseif($expense_info->category == 6){
                        if($expense_info->extra_bill_type == 1){
                            $bill_selected = 'selected';
                        }elseif($expense_info->extra_bill_type == 2){
                            $without_bill_selected = 'selected';
                        }elseif($expense_info->extra_bill_type == 3){
                            $gst_bill_selected = 'selected';
                        }
                    }
                ?>
                <div class="col-md-6">
                    <div class="form-group">
                       <label for="type_id" class="control-label">Bill Type</label>
                        <select class="form-control selectpicker" required="" data-live-search="true" id="bill_type" name="bill_type">
                            <option value=""></option>
                            <option value="1" <?php echo $bill_selected; ?>>With Bill</option>
                            <option value="2" <?php echo $without_bill_selected; ?>>Without Bill</option>
                            <option value="3" <?php echo $gst_bill_selected; ?>>With GST Bill</option>

                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                        <label for="bill_party_name" class="control-label">Party Name</label>
                        <input type="text" name="bill_party_name" class="form-control" value="<?php echo $expense_info->bill_party_name ; ?>">
                    </div>
                </div>
                <?php
                }
                ?>


                <div class="col-md-6">
                    <div class="form-group">
                       <label for="type_id" class="control-label">Expense Type</label>
                        <select class="form-control selectpicker" required="" data-live-search="true" id="t_id" name="t_id">
                            <option value=""></option>
                            <?php
                            if(!empty($type_info)){
                                foreach ($type_info as $r) {
                                    ?>
                                        <option value="<?php echo $r->id; ?>" <?php if($expense_info->type_id == $r->id){ echo 'selected'; } ?>><?php echo $r->name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <div class="col-md-6">
                    <div class="form-group">
                       <label for="typesub_id" class="control-label">Expense Sub-Type</label>
                        <select class="form-control selectpicker"  data-live-search="true" id="typesub_id" name="typesub_id">
                            <option value=""></option>
                            <?php
                            if(!empty($subtype_info)){
                                foreach ($subtype_info as $r1) {
                                    ?>
                                        <option value="<?php echo $r1->id; ?>" <?php if($expense_info->typesub_id == $r1->id){ echo 'selected'; } ?>><?php echo $r1->name; ?></option>
                                    <?php
                                }
                            }
                            ?>
                        </select>
                    </div>
                </div>

                <input type="hidden" name="id" value="<?php echo $expense_info->id; ?>">

                <input type="hidden" name="type_id" value="<?php echo $type_id; ?>">
                <input type="hidden" name="staff_id" value="<?php echo $staff_id; ?>">
                <input type="hidden" name="f_date" value="<?php echo $f_date; ?>">
                <input type="hidden" name="t_date" value="<?php echo $t_date; ?>">

                <div class="col-md-12" style="margin-top: 25px;">
                    <div class="form-group text-right">
                        <button class="btn btn-info" type="submit">Submit</button>
                    </div>
                </div>
            </div>
            </form>
           <?php
       }
    }

	public function update_expense_type()
    {
        if(!empty($_POST)){
           extract($this->input->post());
           /*echo '<pre/>';
           print_r($_POST);
           die;*/

           $ad_data = array(
                'type_id' => $t_id,
                'typesub_id' => $typesub_id
            );

           if($category == 2 || $category == 4 || $category == 6){
                $ad_data['bill_party_name'] = $bill_party_name;
                $ad_data[$column] = $bill_type;
           }

           /*echo '<pre/>';
           print_r($ad_data);
           die;*/

           $update = $this->home_model->update('tblexpenses',$ad_data,array('id'=>$id));
           if ($update) {
                set_alert('success', 'Expense type updateed Successfully ');
                redirect(admin_url('expenses/expense_type_report?staff_id='.$staff_id.'&f_date='.$f_date.'&t_date='.$t_date.'&type_id='.$type_id));
            }
       }

    }


    public function expense_type_report_export()
    {

        if(!empty($_GET)){
           extract($this->input->get());

           if(!empty($f_date) || !empty($t_date) || !empty($staff_id) || !empty($type_id)){
                $where = "approved_status = 1 and status = 1 ";
                if(!empty($f_date) && !empty($t_date)){

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= "and date between '".$f_date."' and '".$t_date."' ";
                }

                if(!empty($staff_id)){
                    $where .= "and addedfrom = '".$staff_id."' ";
                }

                if(!empty($type_id)){
                    $where .= "and type_id = '".$type_id."' ";
                }

               $expense_info = $this->db->query("SELECT * FROM `tblexpenses` where   ".$where."  ")->result();
            }else{
                $expense_info = $this->db->query("SELECT * FROM `tblexpenses` where approved_status = 1 and status = 1 and MONTH(`date`) = '".date('m')."' and YEAR(`date`) = '".date('Y')."' ")->result();
            }


            // create file name
            $fileName = 'Expense_type.xlsx';
            // load excel library
            $this->load->library('excel');


            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);


            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J1');
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A2:J2');
            $objPHPExcel->getActiveSheet()->setCellValue('A2', 'Report : Expense Type Report');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J3');
            $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Date : '.date('d/m/Y').'');


            // set Header
            $objPHPExcel->getActiveSheet()->SetCellValue('A4', 'S.No.');
            $objPHPExcel->getActiveSheet()->SetCellValue('B4', 'Date');
            $objPHPExcel->getActiveSheet()->SetCellValue('C4', 'EXP-ID');
            $objPHPExcel->getActiveSheet()->SetCellValue('D4', 'Employee');
            $objPHPExcel->getActiveSheet()->SetCellValue('E4', 'Details');
            $objPHPExcel->getActiveSheet()->SetCellValue('F4', 'Type');
            $objPHPExcel->getActiveSheet()->SetCellValue('G4', 'Sub-Type');
            $objPHPExcel->getActiveSheet()->SetCellValue('H4', 'Amount');
            // set Row
            $rowCount = 5;
            $i = 1;
            foreach ($expense_info as $row)
            {
                if($row->parent_id > 0){
                    $parent_id = $row->parent_id;
                }else{
                    $parent_id = $row->id;
                }

                $expense_id = 'EXP-'.get_short(get_expense_category($row->category)).'-'.number_series($parent_id);

                $details = 'Purpose - '.get_expense_purpose($row->id).' -- '.get_expense_related($row->id);

                $objPHPExcel->getActiveSheet()->SetCellValue('A' . $rowCount, $i);
                $objPHPExcel->getActiveSheet()->SetCellValue('B' . $rowCount, _d($row->date));
                $objPHPExcel->getActiveSheet()->SetCellValue('C' . $rowCount, $expense_id);
                $objPHPExcel->getActiveSheet()->SetCellValue('D' . $rowCount, get_employee_name($row->addedfrom));
                $objPHPExcel->getActiveSheet()->SetCellValue('E' . $rowCount, $details);
                $objPHPExcel->getActiveSheet()->SetCellValue('F' . $rowCount, value_by_id('tblexpensetype',$row->type_id,'name'));
                $objPHPExcel->getActiveSheet()->SetCellValue('G' . $rowCount, value_by_id('tblexpensetypesub',$row->typesub_id,'name'));
                $objPHPExcel->getActiveSheet()->SetCellValue('H' . $rowCount, $row->amount);

                $i++;
                $rowCount++;
            }

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save($fileName);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect(site_url().$fileName);

        }


    }



    public function expense_report()
    {
        check_permission(108,'view');

        $where = " e.status = 1 ";
        $staff_list = get_junior_staff(get_staff_user_id());
        if ($staff_list != ""){
            $data["staffids"] = explode(",",$staff_list);
            $where .= " and e.addedfrom IN (".$staff_list.") ";
        }else{
            $data["staffids"] = [];
            $where .= " and e.addedfrom = 0";
        }
        if(!empty($_POST)){
           extract($this->input->post());


                if(!empty($f_date) && !empty($t_date)){
                    $data['s_fdate'] = $f_date;
                    $data['s_tdate'] = $t_date;

                    $f_date = str_replace("/","-",$f_date);
                    $f_date = date("Y-m-d",strtotime($f_date));

                    $t_date = str_replace("/","-",$t_date);
                    $t_date = date("Y-m-d",strtotime($t_date));

                    $where .= "and e.date between '".$f_date."' and '".$t_date."' ";
                }

                if(!empty($staff_id)){
                    $where .= "and e.addedfrom = '".$staff_id."' ";
                    $data['s_staff'] = $staff_id;
                }

                if(!empty($type_id)){
                    $where .= "and e.type_id = '".$type_id."' ";
                    $data['s_type'] = $type_id;
                }

                if(!empty($status)){
                	if($status == 3){
                		$st = 0;
                	}else{
                		$st = $status;
                	}
                    $where .= "and e.approved_status = '".$st."' ";
                    $data['status'] = $status;
                }

                if(!empty($expense_type)){
                    $where .= "and et.expense_for = '".$expense_type."' ";
                    $data['expense_type'] = $expense_type;
                }

                if(!empty($category_id)){
                    $where .= "and e.category = '".$category_id."' ";
                    $data['category_id'] = $category_id;
                }

                if (!empty($bill_type)){
                    $data['bill_type'] = $bill_type;
                    $where .= "and ((e.category = '2' AND e.tempo_bill_type = '".$bill_type."') OR (e.category = '4' AND e.hotel_bill_type = '".$bill_type."') OR (e.category = '6' AND e.extra_bill_type = '".$bill_type."'))";
                    
                }

               $data['expense_info'] = $this->db->query("SELECT et.expense_for, e.* FROM tblexpenses as e LEFT JOIN tblexpensetype as et ON e.type_id = et.id where   ".$where."  ")->result();

        }else{
            $data['expense_info'] = $this->db->query("SELECT et.expense_for, e.* FROM tblexpenses as e LEFT JOIN tblexpensetype as et ON e.type_id = et.id where ".$where." and MONTH(e.date) = '".date('m')."' and YEAR(e.date) = '".date('Y')."' ")->result();
        }

        $data['type_info'] = $this->db->query("SELECT * FROM `tblexpensetype` where  status = 1 ORDER BY name ASC ")->result();
        $data['category_info'] = $this->db->query("SELECT * FROM `tblexpensescategories` where  status = 1 ORDER BY name ASC ")->result();
        $data['staff_list'] = get_staff_list();
        $data['title'] = 'Expense Report';
        $this->load->view('admin/expenses/expense_report', $data);
    }

    /* this function use for expenses settlement */
    public function expenses_settlement(){
        check_permission(406,'view');
        $data["title"] = "Expenses Settlement";

        if(!empty($_POST)){
            extract($this->input->post()); 
            if(!empty($request_id) && !empty($expense_id)){
                $request_id_str = implode(',', $request_id);
                $expense_id_str = implode(',', $expense_id);
                
                $expense_info = $this->db->query("SELECT id,amount FROM tblexpenses WHERE id IN (".$expense_id_str.") order by amount asc ")->result();
    
                if(!empty($expense_info)){
                    foreach ($expense_info as $expense) {
                        $expense_amount = $expense->amount;
    
                        $request_info = $this->db->query("SELECT id,balance_amount FROM tblrequests WHERE balance_amount > 0 and id IN (".$request_id_str.") order by balance_amount asc ")->result();
    
                        if(!empty($request_info)){
                            foreach ($request_info as $request) {
                                if($expense_amount > 0){
                                    if($request->balance_amount >= $expense_amount){
                                        $log_arr = array('expense_id' => $expense->id,'request_id' => $request->id,'amount' => $expense_amount,'adjustment'=>1);
                                        $this->home_model->insert('tblexpense_against_request_log', $log_arr);
    
                                        $balance_amount = ($request->balance_amount - $expense_amount);
                                        $this->home_model->update('tblrequests',array('balance_amount'=>$balance_amount),array('id'=>$request->id));
                                        $expense_amount = 0;
    
                                    }elseif($request->balance_amount < $expense_amount){
                                        $log_arr = array('expense_id' => $expense->id,'request_id' => $request->id,'amount' => $request->balance_amount,'adjustment'=>1);
                                        $this->home_model->insert('tblexpense_against_request_log', $log_arr);
                                        $expense_amount = ($expense_amount - $request->balance_amount);
                                        $this->home_model->update('tblrequests',array('balance_amount'=>0),array('id'=>$request->id));
                                    }
                                }
                            }
                        }
    
                        $this->home_model->update('tblexpenses',array('linked_with_request'=>1),array('id'=>$expense->id));                        
                    }
                }
                set_alert('success','Expense Linked Successfully');
                redirect(admin_url('expenses/expenses_settlement'));
            }
        }

        $data["staff_list"] = $this->db->query("SELECT staffid,firstname FROM `tblstaff` WHERE `active`=1")->result();
        $this->load->view('admin/expenses/expenses_settlement', $data);
    }

    /* this  function use for user expenses list */
    public function get_user_expenses(){
        if(!empty($_POST)){
            extract($this->input->post());

            $expense_log_info = $this->db->query("SELECT * FROM tblexpenses where approved_status = 1 and linked_with_request = 0 and addedfrom = '".$user_id."' and date > '2021-12-31' ")->result();
            if(!empty($expense_log_info)){
                echo '<option value="" >-- Select All -</option>';
                foreach ($expense_log_info as $value) {

                    $expense_no = 'EXP-'.get_short(get_expense_category($value->category)).'-'.number_series($value->id);
                    echo '<option data-amt="'.$value->amount.'" value="'.$value->id.'" >'.$expense_no.'- ('._d($value->date).') '.'- ('.$value->amount.') '.'</option>';
                }
            }
        }
    }

    /* this  function use for user request list */
    public function get_user_request(){
        if(!empty($_POST)){
            extract($this->input->post());

            $request_info = $this->db->query("SELECT * FROM `tblrequests` where category = '2' and cancel = 0 and  (addedfrom = '".$user_id."' || addedby = '".$user_id."') and balance_amount > 0 and approved_status = 1 and confirmed_by_user = 1 and date > '2021-12-31' ORDER BY id DESC")->result();
            
            if(!empty($request_info)){
                echo '<option value="" >-- Select All -</option>';
                foreach ($request_info as $value) {
                    $cat = get_last(get_request_category($value->category));	
                    $cat_id = 'REQ-'.get_short($cat).'-'.number_series($value->id);

                    echo '<option data-amt="'.$value->balance_amount.'" value="'.$value->id.'" >'.$cat_id.'- ('._d($value->date).') '.'- ('.$value->balance_amount.') '.'</option>';
                }
            }
        }    
    }

    /* this function use for expense head list */
    public function expense_head_list(){
        check_permission(412,'view');
        $data['title'] = "Expense Head List";

        $data["expense_head_list"] = $this->db->query("SELECT * FROM `tblexpensehead` WHERE `status` = 1 ORDER BY id DESC")->result();
        $this->load->view('admin/expenses/expense_head_list', $data);
    }

    /* this function use for expense head edit */
    public function expense_head_add($id){
        check_permission(412,'edit');
        $data['title'] = 'Edit Expenses Head';

        if(!empty($_POST)){
            extract($this->input->post()); 
            
            $designation_ids = (!empty($designation_ids)) ? implode(',', $designation_ids) : '';
            $updata['name'] = $name;
            $updata['designation_ids'] = $designation_ids;
            $response = $this->home_model->update("tblexpensehead", $updata, array("id" => $id));
            if ($response == TRUE){
                set_alert('success','Expense Head Successfully');
                redirect(admin_url('expenses/expense_head_list'));
            }else{
                set_alert('warning','Something went wrong');
                redirect(admin_url('expenses/expense_head_list'));
            }
        }    

        $data["expense_head_info"] = $this->db->query("SELECT * FROM `tblexpensehead` WHERE `id` = '".$id."'")->row();
        $data["designation_list"] = $this->db->query("SELECT * FROM `tbldesignation` WHERE `status` = 1")->result();
        $this->load->view('admin/expenses/add_expense_head', $data);
    }

    /* this function use for expense export in excel file */
    public function export_expense($f_date,$t_date,$staff_id)
    {
        if(!empty($f_date) && !empty($t_date) && !empty($staff_id)){
			require_once APPPATH.'third_party/pdfcrowd.php';

            $from = str_replace("/","-",$f_date);
            $from_date = date("Y-m-d",strtotime($from));
            $to = str_replace("/","-",$t_date);
            $to_date = date("Y-m-d",strtotime($to));

            $date_from = strtotime($from_date);
            $date_to = strtotime($to_date);

            $date_arr = array();
            for($i=$date_from; $i<=$date_to; $i+=86400) {
                $date_arr[] = date("Y-m-d", $i);
            }
            $date_list = $date_arr;
            $expense_list = get_expense_by_date($staff_id,$f_date,$t_date);
            $test = get_expense_by_parent(1);

			 // create file name
            $fileName = 'Expense_type.xlsx';
            // load excel library
            $this->load->library('excel');
            $objPHPExcel = new PHPExcel();
            $objPHPExcel->setActiveSheetIndex(0);
        
            $border_style= array('font' => array('bold' => true),'borders' => array('allborders' => array('style' => 
            PHPExcel_Style_Border::BORDER_THICK,'color' => array('argb' => '766f6e'))));

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A1:J2');
            $objPHPExcel->getActiveSheet()->getStyle("A1:J2")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('A1:J2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('A1', 'Company Name : Schach Engineers Pvt Ltd.');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A3:J4');
            $objPHPExcel->getActiveSheet()->getStyle('A3:J4')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('A3:J4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('A3', 'Report : Expense Details');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A5:J6');
            $objPHPExcel->getActiveSheet()->getStyle('A5:J6')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('A5:J6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('A5', 'Date : '.date('d/m/Y').'');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K1:N2');
            $objPHPExcel->getActiveSheet()->getStyle('K1:N2')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('K1:N2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Total Expense : ');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O1:R2');
            $objPHPExcel->getActiveSheet()->getStyle('O1:R2')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('O1:R2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Advance : ');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('S1:X2');
            $objPHPExcel->getActiveSheet()->getStyle('S1:X2')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('S1:X2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('S1', 'Date : '.date('d/m/Y',strtotime($f_date)).' To '.date('d/m/Y',strtotime($t_date)));

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K3:N4');
            $objPHPExcel->getActiveSheet()->getStyle("K3:N4")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('K3:N4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('K3', 'Paid By Other : ');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O3:R4');
            $objPHPExcel->getActiveSheet()->getStyle('O3:R4')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('O3:R4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('O3', 'Final Amount : ');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('S3:X4');
            $objPHPExcel->getActiveSheet()->getStyle('S3:X4')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('S3:X4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('S3', 'Name : '.get_employee_fullname($staff_id));

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K5:N6');
            $objPHPExcel->getActiveSheet()->getStyle('K5:N6')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('K5:N6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('K5', 'Employee ID : '.'EMP-'.$staff_id);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O5:R6');
            $objPHPExcel->getActiveSheet()->getStyle('O5:R6')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('O5:R6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('O5', 'Contact No. : '.get_staff_info($staff_id)->phonenumber);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('S5:X6');
            $objPHPExcel->getActiveSheet()->getStyle('S5:X6')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('S5:X6')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('S5', 'Branch : '.get_branch($staff_id));

            // set Header
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A8:B9');
            $objPHPExcel->getActiveSheet()->getStyle('A8:B9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("A8:B9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('A8', 'Requested Date');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C8:D9');
            $objPHPExcel->getActiveSheet()->getStyle('C8:D9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("C8:D9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('C8', 'Approved Date');
            $objPHPExcel->getActiveSheet()->getColumnDimension('C')->setWidth(12);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E8:F9');
            $objPHPExcel->getActiveSheet()->getStyle('E8:F9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("E8:F9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('E8', 'ID');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G8:H9');
            $objPHPExcel->getActiveSheet()->getStyle('G8:H9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("G8:H9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('G8', 'Details');
            $objPHPExcel->getActiveSheet()->getColumnDimension('G')->setWidth(20);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I8:J9');
            $objPHPExcel->getActiveSheet()->getStyle('I8:J9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("I8:J9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('I8', 'Description');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K8:L9');
            $objPHPExcel->getActiveSheet()->getStyle('K8:L9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("K8:L9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('K8', 'Category');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M8:N9');
            $objPHPExcel->getActiveSheet()->getStyle('M8:N9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("M8:N9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('M8', 'Approved By');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O8:P9');
            $objPHPExcel->getActiveSheet()->getStyle('O8:P9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("O8:P9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('O8', 'Approved Remark');

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('Q8:X8');
            $objPHPExcel->getActiveSheet()->getStyle('Q8:X8')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("Q8:X8")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q8', 'Expense Details');

            $objPHPExcel->getActiveSheet()->getStyle('Q9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("Q9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('Q9', 'Head');

            $objPHPExcel->getActiveSheet()->getStyle('R9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("R9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('R9', 'From');

            $objPHPExcel->getActiveSheet()->getStyle('S9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("S9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('S9', 'To');

            $objPHPExcel->getActiveSheet()->getStyle('T9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("T9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('T9', 'KM');

            $objPHPExcel->getActiveSheet()->getStyle('U9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("U9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('U9', 'Paid By');

            $objPHPExcel->getActiveSheet()->getStyle('V9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("V9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('V9', 'Bill Status');
            $objPHPExcel->getActiveSheet()->getColumnDimension('V')->setWidth(15);

            $objPHPExcel->getActiveSheet()->getStyle('W9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("W9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('W9', 'Amount');

            $objPHPExcel->getActiveSheet()->getStyle('X9')->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER);
            $objPHPExcel->getActiveSheet()->getStyle("X9")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->SetCellValue('X9', 'Advance');

            $ttl_advance = 0;
            $ttl_amount = 0;
            $ttl_paid = 0;
            $rowIncrement = 10;
            $rowCount = 10;
            
            if(!empty($date_list)){
                
                foreach($date_list as $date){
                    $expense_info = get_expense($staff_id,$date);
                    $request_info = get_request($staff_id,$date);
                    $transfer_add_info = get_expense_transfer_add($staff_id,$date);
                    $transfer_less_info = get_expense_transfer_less($staff_id,$date);
                    
                    if(!empty($expense_info)){
                        foreach($expense_info as $row_1){
                            ++$rowIncrement;
                            $sub_expense_list = get_expense_by_parent($row_1->id);
                            $sub_expense_count = (!empty($sub_expense_list)) ? count($sub_expense_list) : 0;
                            $expense_paid_by = get_expense_paidy($row_1->id);

                            if($row_1->paidby_employee == $staff_id){
                                $ttl_amount += $row_1->amount;	
                            }else{
                                if($expense_paid_by != '--'){
                                    $ttl_paid += $row_1->amount;
                                }else{
                                    $ttl_amount += $row_1->amount;	
                                }
                            }
                            $uprow = $sub_expense_count+$rowCount;    
                            $bill_status = get_bill_status($row_1->id);	
                            $notedescription = (!empty($row_1->note)) ? $row_1->note : '--';
                            
                            $requested_approved_by = str_replace(['<p>','</p>','<small>','</small>'], ' ', get_expense_approved_by($row_1->id));
                            $approved_info = $this->db->query("SELECT *  FROM `tblexpensesapproval` WHERE `approve_status` = 1 and `expense_id` = '".$row_1->id."'")->row();	
							
                            $approved_date = _d($date);
							if(!empty($approved_info)){
								$approved_date = _d($approved_info->updated_at);
							}

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$rowCount.':'.'B'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':'.'B'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, _d($date));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$rowCount.':'.'D'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount.':'.'D'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, _d($approved_date));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$rowCount.':'.'F'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount.':'.'F'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, 'EXP-'.get_short(get_expense_category($row_1->category)).'-'.number_series($row_1->id));
                            
                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$rowCount.':'.'H'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount.':'.'H'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, 'Purpose -'.get_expense_purpose($row_1->id).", \n".get_expense_related($row_1->id));
                            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(40);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount)->getAlignment()->setWrapText(true);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$rowCount.':'.'J'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount.':'.'J'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $notedescription);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K'.$rowCount.':'.'L'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount.':'.'L'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, get_expense_category($row_1->category));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$rowCount.':'.'N'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount.':'.'N'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $requested_approved_by);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O'.$rowCount.':'.'P'.$uprow);
                            $objPHPExcel->getActiveSheet()->getStyle('O'.$rowCount.':'.'P'.$uprow)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, get_expense_approved_remark($row_1->id));
                            
                            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, get_expense_head($row_1->id));
                            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, get_expense_from($row_1->id));
                            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, get_expense_to($row_1->id));
                            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, get_kilometer_limit($row_1->id));
                            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, $expense_paid_by);
                            $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $bill_status);
                            $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, $row_1->amount);
                            $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, "0.00");
                            
                            if(!empty($sub_expense_list)){
                                foreach($sub_expense_list as $row_2){
                                    ++$rowIncrement;
                                    ++$rowCount;

                                    $sub_expense_paid_by = get_expense_paidy($row_2->id);
                                    if($row_2->paidby_employee == $staff_id){
                                        $ttl_amount += $row_2->amount;
                                    }else{
                                        if($sub_expense_paid_by != '--'){
                                            $ttl_paid += $row_2->amount;
                                        }else{
                                            $ttl_amount += $row_2->amount;
                                        }
                                    }
                                    
                                    $bill_status = get_bill_status($row_2->id);

                                    $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, get_expense_head($row_2->id));
                                    $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, get_expense_from($row_2->id));
                                    $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, get_expense_to($row_2->id));
                                    $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, get_kilometer_limit($row_2->id));
                                    $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, $sub_expense_paid_by);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, $bill_status);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, $row_2->amount);
                                    $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, "0.00");
                                }
                            }
                            $rowCount++;
                        }
                    }

                    if(!empty($request_info)){
                        foreach($request_info as $row_3){
                            ++$rowIncrement;
                            $ttl_advance += $row_3->approved_amount;	
                            
                            $cat = get_last(get_request_category($row_3->category));	
                            $cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_3->id);
                            $approved_info = $this->db->query("SELECT *  FROM `tblrequestapproval` WHERE `approve_status` = 1 and `request_id` = '".$row_3->id."'")->row();	
							$approved_date = _d($date);						
							if($row_3->pettycash_id > 0){
								$pettycash_log_info = $this->db->query("SELECT *  FROM `tblpettycashlogs` WHERE `status` = 1 and `request_id` = '".$row_3->id."' and `pettycash_id` = '".$row_3->pettycash_id."'")->row();
								if(!empty($pettycash_log_info)){
									$approved_date = _d($pettycash_log_info->date_time);
								}
							}else{
								if(!empty($approved_info)){
									$approved_date = _d($approved_info->updated_at);
								}
							}

                            $requested_approved_by = str_replace(['<p>','</p>','<small>','</small>'], ' ', get_request_approved_by($row_3->id));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$rowCount.':'.'B'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':'.'B'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, _d($date));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$rowCount.':'.'D'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount.':'.'D'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $approved_date);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$rowCount.':'.'F'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount.':'.'F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $cat_id);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$rowCount.':'.'H'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount.':'.'H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row_3->reason);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$rowCount.':'.'J'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount.':'.'J'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row_3->description);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K'.$rowCount.':'.'L'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount.':'.'L'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, get_request_category($row_3->category));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$rowCount.':'.'N'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount.':'.'N'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $requested_approved_by);
                            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount)->getAlignment()->setWrapText(true);
                            $objPHPExcel->getActiveSheet()->getRowDimension($rowCount)->setRowHeight(40);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O'.$rowCount.':'.'P'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('O'.$rowCount.':'.'P'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, get_request_approved_remark($row_3->id));
                            
                            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, '0.00');
                            $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, "$row_3->approved_amount");
                            $rowCount++;
                        }
                    }    
                    
                    if(!empty($transfer_less_info)){
                        foreach($transfer_less_info as $row_5){
                            ++$rowIncrement;
                            $ttl_advance += $row_5->approved_amount;	
                            
                            $cat = get_last(get_request_category($row_5->category));	
                            $cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_5->id);

                            $added_by = '\n (By '.get_employee_name($row_5->addedfrom).')';

                            $approved_info = $this->db->query("SELECT *  FROM `tblrequestapproval` WHERE `approve_status` = 1 and `request_id` = '".$row_5->id."'")->row();	
							$approved_date = _d($date);
							if(!empty($approved_info)){
								$approved_date = _d($approved_info->updated_at);
							}

                            $requested_approved_by = str_replace(['<p>','</p>','<small>','</small>'], ' ', get_request_approved_by($row_5->id));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$rowCount.':'.'B'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':'.'B'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, _d($date));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$rowCount.':'.'D'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount.':'.'D'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $approved_date);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$rowCount.':'.'F'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount.':'.'F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $cat_id);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$rowCount.':'.'H'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount.':'.'H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row_5->reason);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$rowCount.':'.'J'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount.':'.'J'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row_5->description);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K'.$rowCount.':'.'L'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount.':'.'L'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, get_request_category($row_5->category).$added_by);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$rowCount.':'.'N'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount.':'.'N'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $requested_approved_by);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O'.$rowCount.':'.'P'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('O'.$rowCount.':'.'P'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, get_request_approved_remark($row_5->id));
                            
                            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, '0.00');
                            $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, "$row_5->approved_amount");
                            $rowCount++;
                        }
                    }    

                    if(!empty($transfer_add_info)){
                        foreach($transfer_add_info as $row_4){
                            ++$rowIncrement;
                            $ttl_amount += $row_4->approved_amount;	
                            
                            $cat = get_last(get_request_category($row_4->category));	
                            $cat_id = 'REQ-'.get_short($cat).'-'.number_series($row_4->id);

                            $approved_info = $this->db->query("SELECT *  FROM `tblrequestapproval` WHERE `approve_status` = 1 and `request_id` = '".$row_4->id."'")->row();	
							$approved_date = _d($date);
							if(!empty($approved_info)){
								$approved_date = _d($approved_info->updated_at);
							}

                            $requested_approved_by = str_replace(['<p>','</p>','<small>','</small>'], ' ', get_request_approved_by($row_4->id));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$rowCount.':'.'B'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('A'.$rowCount.':'.'B'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowCount, _d($date));

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('C'.$rowCount.':'.'D'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('C'.$rowCount.':'.'D'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('C'.$rowCount, $approved_date);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('E'.$rowCount.':'.'F'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('E'.$rowCount.':'.'F'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('E'.$rowCount, $cat_id);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('G'.$rowCount.':'.'H'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('G'.$rowCount.':'.'H'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('G'.$rowCount, $row_4->reason);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('I'.$rowCount.':'.'J'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('I'.$rowCount.':'.'J'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('I'.$rowCount, $row_4->description);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K'.$rowCount.':'.'L'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('K'.$rowCount.':'.'L'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('K'.$rowCount, get_request_category($row_4->category).$added_by);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('M'.$rowCount.':'.'N'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('M'.$rowCount.':'.'N'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('M'.$rowCount, $requested_approved_by);

                            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O'.$rowCount.':'.'P'.$rowCount);
                            $objPHPExcel->getActiveSheet()->getStyle('O'.$rowCount.':'.'P'.$rowCount)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                            $objPHPExcel->getActiveSheet()->SetCellValue('O'.$rowCount, get_request_approved_remark($row_4->id));
                            
                            $objPHPExcel->getActiveSheet()->SetCellValue('Q'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('R'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('S'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('T'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('U'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('V'.$rowCount, '--');
                            $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowCount, "$row_4->approved_amount");
                            $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowCount, '0.00');
                            $rowCount++;
                        }
                    }
                }
            }
            
            $final_amt = 0;
            if($ttl_amount > 0 || $ttl_advance > 0 || $ttl_paid > 0){
                ++$rowIncrement;
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$rowIncrement.':'.'V'.$rowIncrement);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowIncrement.':'.'V'.$rowIncrement)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowIncrement.':'.'V'.$rowIncrement)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowIncrement, 'TOTAL');

                $objPHPExcel->getActiveSheet()->getStyle('W'.$rowIncrement)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('W'.$rowIncrement)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet()->SetCellValue('W'.$rowIncrement, $ttl_amount);

                $objPHPExcel->getActiveSheet()->getStyle('X'.$rowIncrement)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('X'.$rowIncrement)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet()->SetCellValue('X'.$rowIncrement, $ttl_advance);

                $final_amt = $ttl_amount-$ttl_advance;
            }else{
                $objPHPExcel->setActiveSheetIndex(0)->mergeCells('A'.$rowIncrement.':'.'X'.$rowIncrement);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowIncrement.':'.'X'.$rowIncrement)->getAlignment()->setHorizontal(PHPExcel_Style_Alignment::HORIZONTAL_CENTER)->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
                $objPHPExcel->getActiveSheet()->getStyle('A'.$rowIncrement.':'.'X'.$rowIncrement)->applyFromArray($border_style);
                $objPHPExcel->getActiveSheet()->SetCellValue('A'.$rowIncrement, 'No Record Found!');
            }
            
            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K1:N2');
            $objPHPExcel->getActiveSheet()->getStyle('K1:N2')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('K1:N2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('K1', 'Total Expense :   '.$ttl_amount);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O1:R2');
            $objPHPExcel->getActiveSheet()->getStyle('O1:R2')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('O1:R2')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('O1', 'Advance :    '.$ttl_advance);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('K3:N4');
            $objPHPExcel->getActiveSheet()->getStyle("K3:N4")->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('K3:N4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('K3', 'Paid By Other :   '.$ttl_paid);

            $objPHPExcel->setActiveSheetIndex(0)->mergeCells('O3:R4');
            $objPHPExcel->getActiveSheet()->getStyle('O3:R4')->applyFromArray($border_style);
            $objPHPExcel->getActiveSheet()->getStyle('O3:R4')->getAlignment()->setVertical(PHPExcel_Style_Alignment::VERTICAL_CENTER);
            $objPHPExcel->getActiveSheet()->setCellValue('O3', 'Final Amount  :   '.$final_amt);

            $objWriter = new PHPExcel_Writer_Excel2007($objPHPExcel);
            $objWriter->save($fileName);
            // download file
            header("Content-Type: application/vnd.ms-excel");
            redirect(site_url().$fileName);

		}

    }

    /* this function use for get lead list for expense */
    public function getleadlist() {
        
        $postData = $this->input->post();
        $response = array();
        if(isset($postData['search']) ){
          // Select record
          $this->db->select('*');
          $this->db->like("leadno", $postData['search']);
          $records = $this->db->get('tblleads')->result();
          
          foreach($records as $row ){
              $invoice_data = $this->db->query("SELECT id FROM tblexpenses WHERE lead_id = ".$row->id."")->row();
              if (empty($invoice_data)){
                  $response[] = array("value"=>$row->id,"label"=>$row->leadno);
              }
          }
        }
        echo json_encode($response);
    }

    /* this function use for check lead connected to expense  or not */
    public function chk_lead($expense_id = 0) {
        $leadno = $lead_id = "";
        $expense_data = $this->db->query("SELECT lead_id FROM tblexpenses WHERE id = ".$expense_id."")->row();
        if (!empty($expense_data) && $expense_data->lead_id > 0){
            $lead_id = $expense_data->lead_id;
            $leadno = value_by_id("tblleads", $expense_data->lead_id, "leadno");
        }

        echo json_encode(array("lead_id" => $lead_id, "leadno" => $leadno));
    }

    /* this function use for expense connect to lead */
    public function connect_to_lead(){

        if ($_POST){
            extract($this->input->post());

            $up_data = array("lead_id" => $lead_id);
            $update = $this->home_model->update("tblexpenses", $up_data, array("id" => $expense_id));
            if($update){
                set_alert('success', "Expense connected to lead successfully");
                redirect(admin_url("expenses/expense_type_report"));
            }
        }
    }

    /* this function use for get multiple expense against to notification id */
    public function get_multiple_expense($notification_id){
        $data["title"] = "Expense Approval";

        $requesturl = base_url()."Expenses_API/get_multiple_expense?notification_id=".$notification_id;
        // $requesturl = "https://schachengineers.com/schacrm/Expenses_API/get_multiple_expense?notification_id=".$notification_id;
        // $requesturl = "https://schachengineers.com/schacrm/Expenses_API/get_multiple_expense?notification_id=3180483";
        $response = $this->curl_method($requesturl, "GET");
        if (!is_array($response)){
            set_alert('warning', "somthing went wrong");
            redirect(admin_url("approval/staff_notification_list"));
        }
        
        $data["expense_data"] = $response["data"];
        $data["read_by_user_list"] = $response["read_by_user"];
        $data["approved_status"] = $response["approved_status"];
        $this->load->view("admin/expenses/expenses_approval", $data);
    }

    /* This function use for get expeses details */
    public function get_expenses_details(){

        if ($_POST){
            extract($this->input->post());

            $requesturl = base_url()."Expenses_API/get_expense_details?id=".$expense_id;
            // $requesturl = "https://schachengineers.com/schacrm/Expenses_API/get_expense_details?id=".$expense_id;
            // $requesturl = "https://schachengineers.com/schacrm/Expenses_API/get_expense_details?id=23379";
            $response = $this->curl_method($requesturl, "GET");
           
            if (!is_array($response)){
                redirect("admin/not_found");
                exit;
            }
            
            $data["expense_details"] = $response["data"];
            $data["expense_id"] = $expense_id;
            $data["approve_status"] = $approve_status;
            $data["category_id"] = $category_id;
            $this->load->view("admin/expenses/view_expenses_details", $data);
        }
    }

    /* this function use for change bill type */
    public function change_bill_type(){
        if ($_POST){
            extract($this->input->post());

            $requesturl = base_url()."Expenses_API/change_bill_type?expense_id=".$expense_id."&bill_type=".$bill_type."&field=".$field;
            // $requesturl = "https://schachengineers.com/schacrm/Expenses_API/change_bill_type?expense_id=".$expense_id."&bill_type=".$bill_type."&field=".$field;
            $response = $this->curl_method($requesturl, "GET");
            if (!is_array($response)){
                echo $response;
                exit;
            }
            if (isset($response["status"]) && $response["status"] == FALSE){
                echo $response["message"];
                exit;
            }
        }
    }

    /* This function use for get expense attechment */
    public function get_expense_attachment($rel_id){
        $getfiles = $this->db->query("SELECT * FROM tblfiles WHERE `rel_id`='".$rel_id."' AND `rel_type`='expense' ")->result();
        $html = '<div class="modal-header">
                    <button type="button" class="close" data-dismiss="modal">&times;</button>
                    <h4 class="modal-title">Expense Attachment</h4>
                </div>
                <div class="modal-body">
                    <div class="row">
                        <div class="col-md-12">';
                    if (!empty($getfiles)){
                        foreach ($getfiles as $key => $file) {
                            $file_path=base_url('uploads/expenses/'.$file->rel_id.'/'.$file->file_name);
                            $allowed = array('gif', 'png', 'jpg');
                            $ext = pathinfo($file_path, PATHINFO_EXTENSION);
                            if (in_array($ext, $allowed)) {
                                $html .='<div class="col-md-4" style="width: 120px;min-height: 120px;max-height: auto;margin: 3px;padding: 3px;">
                                            <a href="'.$file_path.'"  target="_blank">
                                                <img src="'.$file_path.'" style="max-width: 100%;height: auto;border: 5px solid #ddd" class="img-thumbnail float-left" title="'.$file->file_name.'">
                                            </a>
                                        </div>';
                            }else{
                                $html .='<div class="col-md-4" style="width: 120px;min-height: 120px;max-height: auto;margin: 3px;padding: 3px;">
                                            <a href="'.$file_path.'" title="'.$file->file_name.'" target="_blank" style="max-width: 100%;height: auto;"><i style="font-size: 10em;" class="fa fa-file-pdf-o"></i></a>
                                        </div>';
                            }
                        }
                    }else{
                        $html .= '<h3 class="text-danger text-center">No Attachment Found</h3>';
                    }
        $html .='       </div>
                    </div>
                </div>
                <div class="modal-footer">
                    <button type="button" class="btn btn-default" data-dismiss="modal">Close</button>
                </div>'; 
        echo $html;                   
    }

    /* This function use for approve all expenses */
    public function approve_all_expense(){
        if ($_POST){
            extract($this->input->post());
            
            $request_params = array("user_id" => get_staff_user_id(), "expense_id" => $expense_id, "approve_status"=> $approve_status, "remark" => $remark);
            $requesturl = base_url()."Expenses_API/approve_all_expense";
            // $requesturl = "https://schachengineers.com/schacrm/Expenses_API/approve_all_expense?expense_id=".$expense_id."&bill_type=".$bill_type."&field=".$field;
            $response = $this->curl_method($requesturl, "POST", $request_params);
            
            if (is_array($response) && isset($response["status"]) && $response["status"] == TRUE){
                set_alert('success', $response["message"]);
                redirect(admin_url("approval/staff_notification_list"));
            }else{
                set_alert('danger', "Somthing Went wrong");
                redirect(admin_url("approval/staff_notification_list"));
            }
        }    
    }

    /* this function use for update accounted status in tblexpense */
    public function update_accounted_status($expense_id, $expense_type){
        
        $table_name = '';
        if ($expense_type == 'expense'){
            $table_name = 'tblexpenses';
        }else if ($expense_type == 'request'){
            $table_name = 'tblrequests';
        }
        
        if ($table_name != ''){
            $status = value_by_id_empty($table_name, $expense_id, "accounted_status");
            $updata["accounted_status"] = 0;
            if ($status == 0){
                $updata["accounted_status"] = 1;
                $updata["accounted_by"] = get_staff_user_id();
                $updata["accounted_date"] = date("Y-m-d H:i:s");
            }
            
            $this->home_model->update($table_name, $updata,array('id'=>$expense_id));
        }
        
        redirect($_SERVER['HTTP_REFERER']);
        die;
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
			}
		}
		return "Somthing went wrong!";
	}
}

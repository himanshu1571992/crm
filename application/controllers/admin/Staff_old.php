<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Staff extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    /* List all staff members */
    public function index()
    {
		
		check_permission(101,'view');

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('staff');
        }
        $data['staff_members'] = $this->staff_model->get('', ['active'=>1]);
        $data['title']         = _l('staff_members');
        $this->load->view('admin/staff/manage', $data);
    }

    public function ex_employee()
    {
        check_permission(102,'view');

        $data['title'] = 'Ex-Employees';
        $this->load->view('admin/staff/ex_employee', $data);
    }

    public function ex_employee_table(){
        
        $this->app->get_table_data('ex_employee');
        
    }

    /*public function ex_employee()
    {
        
        if (!has_permission('staff', '', 'view')) {
            access_denied('staff');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('staff');
        }
        $data['staff_members'] = $this->staff_model->get('', ['active'=>1]);
        $data['title']         = _l('staff_members');
        $this->load->view('admin/staff/ex_employee', $data);
    }*/

    /* Add new staff member or edit existing */
    public function member($id = '')
    {
       

       /* if (!has_permission('staff', '', 'view')) {
            access_denied('staff');
        }*/
        do_action('staff_member_edit_view_profile', $id);

        $this->load->model('departments_model');
        $this->load->model('Designation_model');
        $this->load->model('Site_manager_model');
        if ($this->input->post()) {
            $data = $this->input->post();
            
            // Don't do XSS clean here.
            $data['email_signature'] = $this->input->post('email_signature', false);
            $data['password']        = $this->input->post('password', false);

            if ($id == '') {
              /*  if (!has_permission('staff', '', 'create')) {
                    access_denied('staff');
                }*/
                $id = $this->staff_model->add($data);
                if ($id) {

                    //Update staff group
                    /*if(!empty($data['employee_group'])){
                        foreach ($data['employee_group'] as $r) {
                            $group_info = $this->db->query('SELECT * FROM tblstaffgroup WHERE id = "'.$r.'" ')->row();

                            if(!empty($group_info->staff_id)){
                                $group_str =  $group_info->staff_id.','.$id;
                            }else{
                                $group_str = $id; 
                            }

                            $this->home_model->update('tblstaffgroup', array('staff_id'=>$group_str), array('id'=>$r));
                        }
                    }*/


                    handle_staff_profile_image_upload($id);
                    handle_staff_relive_multi_attachments($id);
                    handle_multi_attachments($id,'staff_document');
                    //handle_staff_document_upload($id);
                    set_alert('success', _l('added_successfully', _l('staff_member')));
                    redirect(admin_url('staff/member/' . $id));
                }
            } else {
                /*if (!has_permission('staff', '', 'edit')) {
                    access_denied('staff');
                }*/
                handle_staff_profile_image_upload($id);
                handle_staff_relive_multi_attachments($id);
                handle_multi_attachments($id,'staff_document');
                //handle_staff_document_upload($id);
                $response = $this->staff_model->update($data, $id);

                //Update staff Group
                /*$group_info = $this->db->query('SELECT * FROM tblstaffgroup WHERE status = 1')->result();
                if(!empty($group_info)){
                    foreach ($group_info as $group) {
                        $staff_id_str = '';

                        $staff_arr = explode(',', $group->staff_id);
                        if(!empty($staff_arr)){
                                
                            foreach ($staff_arr as $staff) {
                               if($staff != $id){
                                    $staff_id_str .= $staff.',';
                               }
                               
                            }
                        }

                        $staff_id_str = rtrim($staff_id_str,",");

                        $this->home_model->update('tblstaffgroup', array('staff_id'=>$staff_id_str), array('id'=>$group->id));
                    }
                }

                if(!empty($data['employee_group'])){
                    foreach ($data['employee_group'] as $r) {
                        $group_info = $this->db->query('SELECT * FROM tblstaffgroup WHERE id = "'.$r.'" ')->row();

                        if(!empty($group_info->staff_id)){
                            $group_str =  $group_info->staff_id.','.$id;
                        }else{
                            $group_str = $id; 
                        }
                       
                        $this->home_model->update('tblstaffgroup', array('staff_id'=>$group_str), array('id'=>$r));
                    }
                }*/


                if (is_array($response)) {
                    if (isset($response['cant_remove_main_admin'])) {
                        set_alert('warning', _l('staff_cant_remove_main_admin'));
                    } elseif (isset($response['cant_remove_yourself_from_admin'])) {
                        set_alert('warning', _l('staff_cant_remove_yourself_from_admin'));
                    }
                } elseif ($response == true) {
                    set_alert('success', _l('updated_successfully', _l('staff_member')));
                }
                redirect(admin_url('staff/member/' . $id));
            }
        }
		
        if ($id == '') {
            $title = _l('add_new', _l('staff_member_lowercase'));
        } else {
            $member = $this->staff_model->get($id);

            if (!$member) {
                blank_page('Staff Member Not Found', 'danger');
            }
            $data['member']            = (array) $member;
            $title                     = $member->firstname . ' ' . $member->lastname;
            $data['staff_permissions'] = $this->roles_model->get_staff_permissions($id);
            $data['staff_departments'] = $this->departments_model->get_staff_departments($member->staffid);

            $ts_filter_data = [];
            if ($this->input->get('filter')) {
                if ($this->input->get('range') != 'period') {
                    $ts_filter_data[$this->input->get('range')] = true;
                } else {
                    $ts_filter_data['period-from'] = $this->input->get('period-from');
                    $ts_filter_data['period-to']   = $this->input->get('period-to');
                }
            } else {
                $ts_filter_data['this_month'] = true;
            }

            $data['logged_time'] = $this->staff_model->get_logged_time_data($id, $ts_filter_data);
            $data['timesheets']  = $data['logged_time']['timesheets'];
        }
        $this->load->model('currencies_model');
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['roles']         = $this->roles_model->get();
        $data['permissions']   = $this->roles_model->get_permissions();
        $data['user_notes']    = $this->misc_model->get_notes($id, 'staff');
        $data['departments']   = $this->departments_model->get();
        $data['designation']   = $this->Designation_model->get();
        $data['companybranchdata']   =  $this->db->get('tblcompanybranch')->result_array();
		
		$data['state_data'] = $this->Site_manager_model->get_state();
		$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
		 if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
        
        $data['group_info'] = $this->db->query('SELECT * FROM tblstaffgroup WHERE status = 1')->result_array();

        $data['title']         = $title;
        $this->load->view('admin/staff/members', $data);
    }

    public function save_dashboard_widgets_order()
    {
        do_action('before_save_dashboard_widgets_order');

        $post_data = $this->input->post();
        foreach ($post_data as $container => $widgets) {
            if ($widgets == 'empty') {
                $post_data[$container] = [];
            }
        }
        update_staff_meta(get_staff_user_id(), 'dashboard_widgets_order', serialize($post_data));
    }

    public function save_dashboard_widgets_visibility()
    {
        do_action('before_save_dashboard_widgets_visibility');

        $post_data = $this->input->post();
        update_staff_meta(get_staff_user_id(), 'dashboard_widgets_visibility', serialize($post_data['widgets']));
    }

    public function reset_dashboard()
    {
        update_staff_meta(get_staff_user_id(), 'dashboard_widgets_visibility', null);
        update_staff_meta(get_staff_user_id(), 'dashboard_widgets_order', null);

        redirect(admin_url());
    }

    public function save_hidden_table_columns()
    {
        do_action('before_save_hidden_table_columns');
        $data   = $this->input->post();
        $id     = $data['id'];
        $hidden = isset($data['hidden']) ? $data['hidden'] : [];
        update_staff_meta(get_staff_user_id(), 'hidden-columns-' . $id, json_encode($hidden));
    }

    public function change_language($lang = '')
    {
        $lang = do_action('before_staff_change_language', $lang);
        $this->db->where('staffid', get_staff_user_id());
        $this->db->update('tblstaff', ['default_language' => $lang]);
        if (isset($_SERVER['HTTP_REFERER']) && !empty($_SERVER['HTTP_REFERER'])) {
            redirect($_SERVER['HTTP_REFERER']);
        } else {
            redirect(admin_url());
        }
    }

    public function timesheets()
    {
        $data['view_all'] = false;
        if (is_admin() && $this->input->get('view') == 'all') {
            $data['staff_members_with_timesheets'] = $this->db->query('SELECT DISTINCT staff_id FROM tbltaskstimers WHERE staff_id !=' . get_staff_user_id())->result_array();
            $data['view_all']                      = true;
        }

        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('staff_timesheets', ['view_all' => $data['view_all']]);
        }

        if ($data['view_all'] == false) {
            unset($data['view_all']);
        }
        $data['logged_time'] = $this->staff_model->get_logged_time_data(get_staff_user_id());
        $data['title']       = '';
        $this->load->view('admin/staff/timesheets', $data);
    }

    public function delete()
    {
        if (!is_admin()) {
            if (is_admin($this->input->post('id'))) {
                die('Busted, you can\'t delete administrators');
            }
        }
        if (has_permission('staff', '', 'delete')) {
            $success = $this->staff_model->delete($this->input->post('id'), $this->input->post('transfer_data_to'));
            if ($success) {
                set_alert('success', _l('deleted', _l('staff_member')));
            }
        }
        redirect(admin_url('staff'));
    }

    /* When staff edit his profile */
    public function edit_profile()
    {
        if ($this->input->post()) {
            handle_staff_profile_image_upload();
            $data = $this->input->post();
            // Don't do XSS clean here.
            $data['email_signature'] = $data['email_signature'] = $this->input->post('email_signature', false);

            $success = $this->staff_model->update_profile($data, get_staff_user_id());
            if ($success) {
                set_alert('success', _l('staff_profile_updated'));
            }
            redirect(admin_url('staff/edit_profile/' . get_staff_user_id()));
        }
        $member = $this->staff_model->get(get_staff_user_id());
        $this->load->model('departments_model');
        $data['member']            = $member;
        $data['departments']       = $this->departments_model->get();
        $data['staff_departments'] = $this->departments_model->get_staff_departments($member->staffid);
        $data['title']             = $member->firstname . ' ' . $member->lastname;
        $this->load->view('admin/staff/profile', $data);
    }

    /* Remove staff profile image / ajax */
    public function remove_staff_profile_image($id = '')
    {
        $staff_id = get_staff_user_id();
        if (is_numeric($id) && (has_permission('staff', '', 'create') || has_permission('staff', '', 'edot'))) {
            $staff_id = $id;
        }
        do_action('before_remove_staff_profile_image');
        $member = $this->staff_model->get($staff_id);
        if (file_exists(get_upload_path_by_type('staff') . $staff_id)) {
            delete_dir(get_upload_path_by_type('staff') . $staff_id);
        }
        $this->db->where('staffid', $staff_id);
        $this->db->update('tblstaff', [
            'profile_image' => null,
        ]);

        if (!is_numeric($id)) {
            redirect(admin_url('staff/edit_profile/' . $staff_id));
        } else {
            redirect(admin_url('staff/member/' . $staff_id));
        }
    }

    /* When staff change his password */
    public function change_password_profile()
    {
        if ($this->input->post()) {
            $response = $this->staff_model->change_password($this->input->post(null, false), get_staff_user_id());
            if (is_array($response) && isset($response[0]['passwordnotmatch'])) {
                set_alert('danger', _l('staff_old_password_incorrect'));
            } else {
                if ($response == true) {
                    set_alert('success', _l('staff_password_changed'));
                } else {
                    set_alert('warning', _l('staff_problem_changing_password'));
                }
            }
            redirect(admin_url('staff/edit_profile'));
        }
    }

    /* View public profile. If id passed view profile by staff id else current user*/
    public function profile($id = '')
    {
        if ($id == '') {
            $id = get_staff_user_id();
        }

        do_action('staff_profile_access', $id);

        $data['logged_time'] = $this->staff_model->get_logged_time_data($id);
        $data['staff_p']     = $this->staff_model->get($id);

        if (!$data['staff_p']) {
            blank_page('Staff Member Not Found', 'danger');
        }

        $this->load->model('departments_model');
        $data['staff_departments'] = $this->departments_model->get_staff_departments($data['staff_p']->staffid);
        $data['departments']       = $this->departments_model->get();
        $data['title']             = _l('staff_profile_string') . ' - ' . $data['staff_p']->firstname . ' ' . $data['staff_p']->lastname;
        // notifications
        $total_notifications = total_rows('tblnotifications', [
            'touserid' => get_staff_user_id(),
        ]);
        $data['total_pages'] = ceil($total_notifications / $this->misc_model->get_notifications_limit());
        $this->load->view('admin/staff/myprofile', $data);
    }

    /* Change status to staff active or inactive / ajax */
    public function change_staff_status($id, $status)
    {
        if (has_permission('staff', '', 'edit')) {
            if ($this->input->is_ajax_request()) {
                $this->staff_model->change_staff_status($id, $status);
            }
        }
    }

    /* Logged in staff notifications*/
    public function notifications()
    {
        $this->load->model('misc_model');
        if ($this->input->post()) {
            $page   = $this->input->post('page');
            $offset = ($page * $this->misc_model->get_notifications_limit());
            $this->db->limit($this->misc_model->get_notifications_limit(), $offset);
            $this->db->where('touserid', get_staff_user_id());
            $this->db->order_by('date', 'desc');
            $notifications = $this->db->get('tblnotifications')->result_array();
            $i             = 0;
            foreach ($notifications as $notification) {
                if (($notification['fromcompany'] == null && $notification['fromuserid'] != 0) || ($notification['fromcompany'] == null && $notification['fromclientid'] != 0)) {
                    if ($notification['fromuserid'] != 0) {
                        $notifications[$i]['profile_image'] = '<a href="' . admin_url('staff/profile/' . $notification['fromuserid']) . '">' . staff_profile_image($notification['fromuserid'], [
                        'staff-profile-image-small',
                        'img-circle',
                        'pull-left',
                    ]) . '</a>';
                    } else {
                        $notifications[$i]['profile_image'] = '<a href="' . admin_url('clients/client/' . $notification['fromclientid']) . '">
                    <img class="client-profile-image-small img-circle pull-left" src="' . contact_profile_image_url($notification['fromclientid']) . '"></a>';
                    }
                } else {
                    $notifications[$i]['profile_image'] = '';
                    $notifications[$i]['full_name']     = '';
                }
                $additional_data = '';
                if (!empty($notification['additional_data'])) {
                    $additional_data = unserialize($notification['additional_data']);
                    $x               = 0;
                    foreach ($additional_data as $data) {
                        if (strpos($data, '<lang>') !== false) {
                            $lang = get_string_between($data, '<lang>', '</lang>');
                            $temp = _l($lang);
                            if (strpos($temp, 'project_status_') !== false) {
                                $status = get_project_status_by_id(strafter($temp, 'project_status_'));
                                $temp   = $status['name'];
                            }
                            $additional_data[$x] = $temp;
                        }
                        $x++;
                    }
                }
                $notifications[$i]['description'] = _l($notification['description'], $additional_data);
                $notifications[$i]['date']        = time_ago($notification['date']);
                $notifications[$i]['full_date']   = $notification['date'];
                $i++;
            } //$notifications as $notification
            echo json_encode($notifications);
            die;
        }
    }
	
	
	public function imagedelete() {
		$this->load->model('Staff_model');
		$id=$this->input->post('staff_id');
        $success = $this->Staff_model->imagedelete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('staff')));
            if (strpos($_SERVER['HTTP_REFERER'], 'product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('staff/member/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('staff_lowercase')));
            redirect(admin_url('staff/member/' . $id));
        }
    }
	
	public function docdelete() {
		$this->load->model('Staff_model');
		$id=$this->input->post('staff_id');
        $success = $this->Staff_model->docdelete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('staff')));
            if (strpos($_SERVER['HTTP_REFERER'], 'product/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('staff/member/' . $id));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('staff_lowercase')));
            redirect(admin_url('staff/member/' . $id));
        }
    }
	
	
	
	/* For Email Settings */
	
	public function email_setting($id = '') {
		$this->load->model('home_model');
        if ($this->input->post()) {
			extract($this->input->post());
			
			$exist_info = $this->home_model->get_row('tblstaffemailsettings', array('staff_id'=>$id), '' );
			if(!empty($exist_info)){
				$up_data = array(                              
							'smtp_encryption' => $smtp_encryption,
							'smtp_host' => $smtp_host,
							'smtp_port' => $smtp_port,                              
							'smtp_email' => $smtp_email,                              
							'smtp_username' => $smtp_username,                              
							'smtp_password' => $smtp_password,                              
							'smtp_email_charset' => $smtp_email_charset, 
							'bcc_emails' => $bcc_emails, 
							'updated_at' => date('Y-m-d H:i:s')
						);
				$insert = $this->home_model->update('tblstaffemailsettings',$up_data,array('id'=>$exist_info->id));
				
			}else{
				$ad_data = array(
							'staff_id' => $id,                               
							'smtp_encryption' => $smtp_encryption,
							'smtp_host' => $smtp_host,
							'smtp_port' => $smtp_port,                              
							'smtp_email' => $smtp_email,                              
							'smtp_username' => $smtp_username,                              
							'smtp_password' => $smtp_password,                              
							'smtp_email_charset' => $smtp_email_charset,                              
							'bcc_emails' => $bcc_emails,                              
							'status' => 1,
							'created_at' => date('Y-m-d H:i:s'),
							'updated_at' => date('Y-m-d H:i:s')
						);
				$insert = $this->home_model->insert('tblstaffemailsettings',$ad_data);	
			}
			
			if($insert == true){
				set_alert('success', _l('updated_successfully', 'Email Setting'));
				redirect(admin_url('staff'));
			}
             
        }
		
		$data['mail_info'] = get_staff_mail_setting($id);
		
		 $title = 'Staff Email Settings';

		$this->load->model('Product_category_model');
        $data['pro_cat_data'] = $this->Product_category_model->get();
		
		
        $data['title'] = $title;
        $this->load->view('admin/staff/email_setting', $data);
    }

    public function get_warehouse() {
        $this->load->model('home_model');
        if ($this->input->post()) {
            extract($this->input->post());
            $branch_id =  implode(",",$branch_id);
            $company_info = $this->db->query("SELECT * from tblcompanybranch  where id IN (".$branch_id.")  ")->result();
            
            $warehouse_id = '';
            if(!empty($company_info)){
                foreach ($company_info as  $value) {
                     $warehouse_id .= $value->warehouse_id.',';
                }
            }
            $warehouse_id = rtrim($warehouse_id,",");
           
            $warehouse_info = $this->db->query("SELECT * from tblwarehouse where id IN (".$warehouse_id.")  ")->result();

            if(!empty($warehouse_info)){
                echo '<option value=""></option>';
                foreach ($warehouse_info as $value) {
                   echo '<option value="'.$value->id.'">'.$value->name.'</option>';
                }
            }
        }

    }
	
	
	function ExportStaff()
	{		
		$session_data = $this->session->userdata('user_info');
	    $user_id = $session_data['id'];
		
		
		$this->load->dbutil();
		$this->load->helper('file');
		$this->load->helper('download');
		$delimiter = ",";
		$newline = "\r\n";
		$filename = "staff_list.csv";
		$query = "SELECT employee_id as `ID`, `firstname` as `Name`, `birth_date` as `Date of Birth`, `joining_date` as `Date of Joining`, `pan_card_no` as `Pan No`, `adhar_no` as `Adhaar No`, `epf_no` as `PF No`, `epic_no` as `ESIC No`, `working_from` as `Working From`, `working_to` as `Working To`, `monthly_salary` as `Gross Salary`, `residential_address` as `Address` FROM `tblstaff` where active = 1  order by firstname asc";
		$result = $this->db->query($query);
		$data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
		force_download($filename, $data);
	}

    function ExportExStaff()
    {       
        $session_data = $this->session->userdata('user_info');
        $user_id = $session_data['id'];
        
        
        $this->load->dbutil();
        $this->load->helper('file');
        $this->load->helper('download');
        $delimiter = ",";
        $newline = "\r\n";
        $filename = "Exstaff_list.csv";
        $query = "SELECT employee_id as `ID`, `firstname` as `Name`, `birth_date` as `Date of Birth`, `joining_date` as `Date of Joining`, `pan_card_no` as `Pan No`, `adhar_no` as `Adhaar No`, `epf_no` as `PF No`, `epic_no` as `ESIC No`, `working_from` as `Working From`, `working_to` as `Working To`, `monthly_salary` as `Gross Salary`, `residential_address` as `Address` FROM `tblstaff` where active = 0  order by firstname asc";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
    }

    //create function gopal birla
    public function registered_employeelist()
    {
        check_permission(298,'view');
        $where = " staffid > '0' ";
        if(!empty($_POST)){
            extract($this->input->post());
        
            if(!empty($f_date)){

                $data['s_fdate'] = $f_date;

                $f_date = str_replace("/","-",$f_date);

                $from_date = date('Y-m-d',strtotime($f_date));           

               $where.= " and created_at =  '".$from_date."'  ";
            }
        }

        $data['employee_list'] = $this->db->query("SELECT * from `tblregisteredstaff` where  ".$where." order by staffid desc ")->result();
 
        $data['title'] = 'Employee Registration List'; 
        $this->load->view('admin/staff/registered_employeelist', $data); 

    }

    //gopal birla
    public function registration_email() 
    { 
        if ($this->input->post()) { 
            extract($this->input->post());
            
            $this->load->model('emails_model');

            $link = base_url('staff/staff_form');

            $message = str_replace("#link#",$link,$message);


            $message .= get_company_signature();

            $sent = $this->emails_model->send_simple_email($email, $subject, $message);
            if ($sent) {
                set_alert('success', 'Email send successfully');
             
                
            }else{
                set_alert('warning', 'Email not sent!');
            }
            redirect(admin_url('staff/registered_employeelist'));
        }

    }

    //gopal birla
    public function registered_whatsapp() 
    { 
            if ($this->input->post()) { 
                extract($this->input->post());

                $this->load->model('emails_model');

                $link = site_url('staff/staff_form');

                $message = str_replace("#link#",$link,$message);

                $phone=$this->input->post('phone');

                $message1=$this->input->post('message');

                $message=$message1.$link;
                
                header("location:https://api.whatsapp.com/send?phone=$phone&text=$message");
            }
    }

    //gopla bilrla for view section
    public function employee_view($id = '') 
    {
        if($id == '') {
            $title = _l('add_new', _l('employee_registration'));

        }else{
          $data['registeredstaff'] = $this->db->query("SELECT * FROM `tblregisteredstaff` where staffid = '".$id."' ")->result_array();

        $data['staffcontact'] = $this->db->query("SELECT * FROM `tblregistrationstafffamily` where staff_id = '".$id."' ")->result_array();

         $data['stafffiles'] = $this->db->query("SELECT * FROM `tblregistrationstafffiles` where rel_id = '".$id."' ")->result_array();

        
        }
 
         $this->load->model('Designation_model');

         $this->load->model('Site_manager_model');

         $this->load->model('Registerstaff_model');

         $data['relationship_data'] = $this->Registerstaff_model->getstaffrelationship();

         $data['designation_data'] = $this->Designation_model->get();

         $data['state_data'] = $this->Site_manager_model->get_state();

         $data['allcity'] = $this->Site_manager_model->get_city();

         $data['city_data'] = array();

            if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
                $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
            }

        $data['title'] = 'Employee Registration Form';        
        $this->load->view('admin/staff/employee_view', $data);

    }
}

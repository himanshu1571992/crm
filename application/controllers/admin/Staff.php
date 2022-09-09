<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Staff extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();

        $this->load->model('home_model');
    }

    /*this is temp function for updating employee employee_number*/
    public function update_employee_number()
    {
        $staff_list = $this->db->query('SELECT * FROM tblstaff  ')->result();
        foreach($staff_list as $staff){
                $employee_number = explode('/', $staff->employee_id)[2];
                if(!empty($employee_number)){
                    $this->home_model->update('tblstaff', array('employee_number'=>$employee_number), array('staffid'=>$staff->staffid));
                }
                
        }
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
//                $response = $this->staff_model->update($data, $id);
                $response = $this->staff_model->send_approval_staff_info($data, $id);

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
                    set_alert('success', "Staff changes approval send successfully");
//                    set_alert('success', _l('updated_successfully', _l('staff_member')));
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

        $data['group_info'] = $this->db->query('SELECT * FROM tblstaffgroup WHERE status = 1 order by name asc')->result_array();
        $data['division_list'] = $this->db->query('SELECT * FROM tbldivisionmaster WHERE status = 1 ORDER BY title asc')->result();
        $data['religion_list'] = $this->db->query('SELECT * FROM tblreligion WHERE status = 1 ORDER BY name ASC')->result();
        $data['departments_info'] = $this->db->query('SELECT * FROM tbldepartmentsmaster WHERE status = 1 order by name asc')->result_array();
        $data['superior_info'] = $this->db->query('SELECT * FROM tblstaff WHERE active = 1')->result_array();
        $data['location_info'] = $this->db->query('SELECT * FROM tbllocationmaster WHERE status = 1 order by name asc')->result_array();
        $data['agent_number_list'] = $this->db->query('SELECT * FROM tblvagentnumbers WHERE source_id > 0 and status = 1 GROUP BY exotel_number ORDER BY id ASC')->result();

        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();
        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='22'")->result_array();
        $i = 0;
        foreach ($Staffgroup as $singlestaff) {
            $i++;
            $stafff[$i]['id'] = $singlestaff['id'];
            $stafff[$i]['name'] = $singlestaff['name'];
            $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "' order by s.firstname asc")->result_array();
            $stafff[$i]['staffs'] = $query;
        }

        $data['allStaffdata'] = $stafff;
        $data['staff_members'] = $this->staff_model->get('', ['active'=>1]);
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
            //$data['staff_members_with_timesheets'] = $this->db->query('SELECT DISTINCT staff_id FROM tbltaskstimers WHERE staff_id !=' . get_staff_user_id())->result_array();
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

                $where = "`s`.`active`=1";
                if (!is_admin() == 1){
                    $where .= " and `s`.`added_by` =".get_staff_user_id();
                }
		//$query = "SELECT employee_id as `ID`, `firstname` as `Name`, `birth_date` as `Date of Birth`, `phonenumber` as `Mobile`, `joining_date` as `Date of Joining`, `pan_card_no` as `Pan No`, `adhar_no` as `Adhaar No`, `epf_no` as `PF No`, `epic_no` as `ESIC No`, `working_from` as `Working From`, `working_to` as `Working To`, `monthly_salary` as `Gross Salary`, `residential_address` as `Address` FROM `tblstaff` where ".$where."  order by firstname asc";


        $query = "SELECT `s`.`employee_id` as `ID`, `s`.`firstname` as `Name`, `d`.`designation` as `Designation`, `s`.`birth_date` as `Date of Birth`, `s`.`phonenumber` as `Mobile`, `s`.`joining_date` as `Date of Joining`, `s`.`pan_card_no` as `Pan No`, `s`.`adhar_no` as `Adhaar No`, `s`.`epf_no` as `PF No`, `s`.`epic_no` as `ESIC No`, `s`.`working_from` as `Working From`, `s`.`working_to` as `Working To`, `s`.`monthly_salary` as `Gross Salary`, `s`.`residential_address` as `Address` FROM `tblstaff` as s LEFT JOIN `tbldesignation` as d ON s.designation_id = d.id where ".$where."  order by `s`.`firstname` asc";



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
        $query = "SELECT employee_id as `ID`, `firstname` as `Name`, `phonenumber` as `Mobile`, `birth_date` as `Date of Birth`, `joining_date` as `Date of Joining`, `pan_card_no` as `Pan No`, `adhar_no` as `Adhaar No`, `epf_no` as `PF No`, `epic_no` as `ESIC No`, `working_from` as `Working From`, `working_to` as `Working To`, `monthly_salary` as `Gross Salary`, `residential_address` as `Address` FROM `tblstaff` where active = 0  order by firstname asc";
        $result = $this->db->query($query);
        $data = $this->dbutil->csv_from_result($result, $delimiter, $newline);
        force_download($filename, $data);
    }

    public function registered_employeelist(){

        check_permission(298, 'view');

        $staff_branch = get_staff_info(get_staff_user_id())->branch_id;
        $where = "branch_id in (".$staff_branch.")";

        if(!empty($_POST)){

        extract($this->input->post());

        if(!empty($f_date)){

        $data['s_fdate'] = $f_date;

        $f_date = str_replace("/","-",$f_date);

        $from_date = date('Y-m-d',strtotime($f_date));

        $where.= " and created_at = '".$from_date."' ";
        }
        }

        $data['Staffgroup'] = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.multiselect='proposal'")->result_array();

        $Staffgroup = $this->db->query("SELECT st.* FROM `tblstaffgroup` st LEFT JOIN `tblstaffgroupmultiselect` stm ON st.`id`=stm.`staffgroup_id` LEFT JOIN `tblmultiselectmaster` ms ON stm.multiselect_id=ms.id WHERE ms.id='19'")->result_array();

        $i = 0;

        foreach ($Staffgroup as $singlestaff){
        $i++;

        $stafff[$i]['id'] = $singlestaff['id'];

        $stafff[$i]['name'] = $singlestaff['name'];

        $query = $this->db->query("SELECT s.staffid,s.firstname,s.email FROM `tblstaffgroupmembers` sg LEFT JOIN `tblstaff` s ON s.staffid=sg.`staff_id` WHERE sg.`group_id`='" . $singlestaff['id'] . "' AND s.staffid!='" . get_staff_user_id() . "'")->result_array();

        $stafff[$i]['staffs'] = $query;

        }

        $data['allStaffdata'] = $stafff;

        $data['employee_list'] = $this->db->query("SELECT * from `tblregisteredstaff` where ".$where." order by staffid desc ")->result();

        $data['title'] = 'Employee Registration List';

        $this->load->view('admin/staff/registered_employeelist', $data);

    }

    //gopal birla
    public function registration_email()
    {
        if ($this->input->post()) {
            extract($this->input->post());

            $this->load->model('emails_model');

            if(isset($candidate_id) && !empty($candidate_id)){
                $link = base_url('staff/staff_form?branch_id='.get_login_branch().'&candidate_id='.$candidate_id);
            }else{
                $link = base_url('staff/staff_form?branch_id='.get_login_branch());
            }
            $message = str_replace("#link#",$link,$message);


            $message .= get_company_signature();

            $sent = $this->emails_model->send_simple_email($email, $subject, $message);
            if ($sent) {
                set_alert('success', 'Email send successfully');


            }else{
                set_alert('warning', 'Email not sent!');
            }
            if (strpos($_SERVER['HTTP_REFERER'], 'registered_employeelist/') == false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('staff/registered_employeelist'));
            }
        }

    }

    //gopal birla
    public function registered_whatsapp()
    {
            if ($this->input->post()) {
                extract($this->input->post());

                $this->load->model('emails_model');

                if(isset($candidate_id) && !empty($candidate_id)){
                    $link = base_url('staff/staff_form?branch_id='.get_login_branch().'&candidate_id='.$candidate_id.'');
                }else{
                    $link = base_url('staff/staff_form?branch_id='.get_login_branch());
                }

//                $link = site_url('staff/staff_form');

                $message = str_replace("#link#",$link,$message);

                $phone=$this->input->post('phone');

                $message1=$this->input->post('message');

                $message=$message1."".$link."";

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

	$data['departments_info'] = $this->db->query('SELECT * FROM tbldepartmentsmaster WHERE status = 1')->result_array();

        $data['superior_info'] = $this->db->query('SELECT * FROM tblstaff WHERE active = 1')->result_array();
         $data['city_data'] = array();

            if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
                $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
            }

        $data['title'] = 'Employee Registration Form';
        $this->load->view('admin/staff/employee_view', $data);

    }

    //create function by gopal birla
    public function employee_approval() {

        if ($this->input->post()) {
            extract($this->input->post());

            $data = $this->input->post();

            $assignstaff = $data['assignid'];

            foreach ($assignstaff as $single_staff) {
                if (strpos($single_staff, 'staff') !== false) {
                   $staff_id[] = str_replace("staff", "", $single_staff);

                }

            }
                $staff_id = array_unique($staff_id);

                $staff_str = implode(",",$staff_id);

                foreach ($staff_id as $single) {
                 $addmasterata = array(
                    'staff_id' => $single,
                    'fromuserid'      => get_staff_user_id(),
                    'module_id' => 12,
                    'description' => 'Register employee send to you for Approval',
                    'table_id' => $employee_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'link' => 'staff/employee_approvalStatus/' . $employee_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                 );

                    $this->db->insert('tblmasterapproval', $addmasterata);


                 $addapprovalata = array(
                    'staff_id' => $single,
                    'employee_id' => $employee_id,
                    'approve_status' => 0,
                    'created_at' => date('Y-m-d H:i:s')

                 );

                  $this->db->insert('tblstaffapproval', $addapprovalata);

                }

            //update for tblregisteredstaff because change pending approval
            // 3 for pending status

                 $addupdatedata = array(
                    'approval_status' => '3',
                    'updated_at' => date('Y-m-d H:i:s')
                 );


                $update = $this->home_model->update('tblregisteredstaff', $addupdatedata,array('staffid'=>$employee_id));

                set_alert('success', 'Employee successfully Assign');

                if (strpos($_SERVER['HTTP_REFERER'], 'registered_employeelist/') == false) {
                    redirect($_SERVER['HTTP_REFERER']);
                } else {
                    redirect(admin_url('staff/registered_employeelist'));
                }

        }

    }

     //create function by gopal birla
    public function employee_approvalStatus($id) {

        if(!empty($_POST)){
            extract($this->input->post());

            $ad_data = array(
             'approve_status' => $submit,
             'remark' => $remark,
             'updated_at' => date("Y-m-d H:i:s")

            );


            $update = $this->home_model->update('tblstaffapproval', $ad_data,array('employee_id'=>$id,'staff_id'=>get_staff_user_id()));

            update_masterapproval_single(get_staff_user_id(),12,$id,$submit);

             //Getting Reject Info
            $approve_status = 0;

            $reject_info = $this->db->query("SELECT * FROM `tblstaffapproval` where employee_id='".$id."' and     approve_status = 2 ")->row_array();

            if(!empty($reject_info)){
                $approve_status = 2;
                //update_masterapproval_all(12,$id,2);
                $this->home_model->update('tblregisteredstaff', array('approval_status'=>2),array('staffid'=>$id));

            }else{
                $approval_count = $this->db->query("SELECT count(id) as ttl_count  FROM `tblstaffapproval` where employee_id='".$id."' and approve_status = 1 ")->row()->ttl_count;

                if($approval_count >= 2){
                    $approve_status = 1;
                    $this->home_model->update('tblregisteredstaff', array('approval_status'=>1),array('staffid'=>$id));
                }
            }


            $approval_info = $this->db->query("SELECT * FROM `tblstaffapproval` where employee_id='".$id."' and ( approve_status = 0 || approve_status = 2 ) ")->row_array();

            if(empty($approval_info)){
                $approve_status = 1;

             //update_masterapproval_all(12,$id,1);

             $this->home_model->update('tblregisteredstaff', array('approval_status'=>1),array('staffid'=>$id));
            }

            update_masterapproval_all(12,$id,$approve_status);

            if($update){
                 set_alert('success', 'Register employee  updated succesfully');
                 redirect(admin_url('approval/notifications'));
            }
        }
            if($id == '') {
            $title = _l('add_new', _l('employee_registration'));

            }else{
               $data['registeredstaff'] = $this->db->query("SELECT * FROM `tblregisteredstaff` where staffid = '".$id."' ")->result_array();

               $data['staffcontact'] = $this->db->query("SELECT * FROM `tblregistrationstafffamily` where staff_id = '".$id."' ")->result_array();

               $data['stafffiles'] = $this->db->query("SELECT * FROM `tblregistrationstafffiles` where rel_id = '".$id."' ")->result_array();
               $data['appvoal_info'] = $this->db->query("SELECT * from tblstaffapproval where employee_id = '".$id."' and staff_id = '".get_staff_user_id()."' and approve_status != 0 ")->row();

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

                  $this->load->view('admin/staff/employee_approval', $data);

    }

     //create function by gopal birla

    public function get_employee_status() {


        if(!empty($_POST)){
            extract($this->input->post());
            $assign_info = $this->db->query("SELECT * from  tblstaffapproval  where employee_id = '".$id."' ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                    <hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Action</td>
                                        <td>Remark</td>
                                        <td>Read At</td>

                                    </tr>
                                </thead>
                                    <tbody>
                                        <?php
                                        if(!empty($assign_info)){
                                            $i = 1;
                                            foreach ($assign_info as $key => $value) {

                                                    if($value->approve_status == 0){
                                                        $status = 'Pending';
                                                        $color = 'Darkorange';
                                                    }elseif($value->approve_status == 1){
                                                        $status = 'Approved';
                                                        $color = 'green';
                                                    }elseif($value->approve_status == 2){
                                                        $status = 'Reject';
                                                        $color = 'red';
                                                    }


                                                ?>
                                    <tr>
                                        <td><?php echo $i++;?></td>
                                        <td><?php echo get_employee_name($value->staff_id); ?></td>
                                        <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>

                                        <td><?php echo ($value->remark != '') ?  $value->remark : '--';  ?></td>
                                        <td><?php if(!empty($value->updated_at)){ echo _d($value->updated_at); }else{ echo 'Not Yet'; }   ?></td>

                                    </tr>
                                        <?php

                                            }

                                        }else{
                                            echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                        }

                                        ?>


                                    </tbody>

                             </table>
                        </div>
                    </div>
                </div>
            </div>

            <?php

        }


    }


    /* this function use for procced registor employee */
    public function registered_employee_process($id = '') {

        if ($id == '') {
            redirect(admin_url("staff/member"));
        }

        if ($_POST){
            extract($this->input->post());

            $data = $this->input->post();
            $id = $this->staff_model->registered_staff_details_update($id, $data);
            if ($id) {

                set_alert('success', "Staff details update successfully");
                redirect(admin_url('staff/registered_employeelist'));
            }
        }
        $this->load->model('Designation_model');

        $this->load->model('Site_manager_model');

        $this->load->model('Registerstaff_model');

        $data['registeredstaff'] = $this->db->query("SELECT * FROM `tblregisteredstaff` where staffid = '" . $id . "' ")->result_array();

        $data['staffcontact'] = $this->db->query("SELECT * FROM `tblregistrationstafffamily` where staff_id = '" . $id . "' ")->result_array();

        $data['stafffiles'] = $this->db->query("SELECT * FROM `tblregistrationstafffiles` where rel_id = '" . $id . "' ")->result_array();

        $data['relationship_data'] = $this->Registerstaff_model->getstaffrelationship();

        $data['designation_data'] = $this->Designation_model->get();

        $data['state_data'] = $this->Site_manager_model->get_state();

        $data['allcity'] = $this->Site_manager_model->get_city();

        $data['departments_info'] = $this->db->query('SELECT * FROM tbldepartmentsmaster WHERE status = 1')->result_array();

        $data['superior_info'] = $this->db->query('SELECT * FROM tblstaff WHERE active = 1')->result_array();

        $data['city_data'] = array();

        if (isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }

        $data['title'] = 'Employee Registration Form';
        $this->load->view('admin/staff/employee_edit', $data);
    }

    /* THIS FUNCTION USE FOR CONVERT REGISTORED EMPLOYEE TO STAFF */
    public function convert_to_employee($staff_id){
        if ($staff_id == '') {
            redirect(admin_url("staff/registered_employeelist"));
        }

        $data['title']   = _l('add_new', _l('staff_member_lowercase'));

        $this->load->model('departments_model');
        $this->load->model('Site_manager_model');
        $this->load->model('Designation_model');
        $this->load->model('currencies_model');
        $data['base_currency'] = $this->currencies_model->get_base_currency();
        $data['roles']         = $this->roles_model->get();
        $data['permissions']   = $this->roles_model->get_permissions();
        $data['user_notes']    = $this->misc_model->get_notes($staff_id, 'staff');
        $data['departments']   = $this->departments_model->get();
        $data['designation']   = $this->Designation_model->get();
        $data['companybranchdata']   =  $this->db->get('tblcompanybranch')->result_array();

	$data['state_data'] = $this->Site_manager_model->get_state();
	$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
	if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
         $data['agent_number_list'] = $this->db->query('SELECT * FROM tblvagentnumbers WHERE status = 1 order by source asc')->result();
        $data['registeredstaff'] = $this->db->query("SELECT * FROM `tblregisteredstaff` where staffid = '" . $staff_id . "' ")->row();
        $data['group_info'] = $this->db->query('SELECT * FROM tblstaffgroup WHERE status = 1 order by name asc')->result_array();
        $data['departments_info'] = $this->db->query('SELECT * FROM tbldepartmentsmaster WHERE status = 1 order by name asc')->result_array();
        $data['superior_info'] = $this->db->query('SELECT * FROM tblstaff WHERE active = 1')->result_array();
        if (!empty($data['registeredstaff'])){
            $company_info = $this->db->query("SELECT * from tblcompanybranch  where id IN (".$data['registeredstaff']->branch_id.") order by comp_branch_name asc  ")->result();
            $warehouse_id = '';
            if(!empty($company_info)){
                foreach ($company_info as  $value) {
                     $warehouse_id .= $value->warehouse_id.',';
                }
            }
            $warehouse_id = rtrim($warehouse_id,",");

            $data['warehouse_info']  = $this->db->query("SELECT * from tblwarehouse where id IN (".$warehouse_id.") order by name asc ")->result();
        }
        $data['division_list'] = $this->db->query('SELECT * FROM tbldivisionmaster WHERE status = 1 ORDER BY title asc')->result();
        $data['religion_list'] = $this->db->query('SELECT * FROM tblreligion WHERE status = 1 ORDER BY name ASC')->result();
        $this->load->view('admin/staff/members', $data);
    }


    //Location Master
    public function location_list() {

        $data['location_info']  = $this->db->query("SELECT * FROM tbllocationmaster order by name asc ")->result();


        $data['title'] = 'Location List';
        $this->load->view('admin/staff/location_list', $data);
    }

    public function change_location_status($id, $status) {
        if ($this->input->is_ajax_request()) {

            $update_data = array(
                'status' => $status
            );

            $this->home_model->update('tbllocationmaster',$update_data,array('id'=>$id));
        }
    }

    public function location($id = '') {

        if ($this->input->post()) {
            extract($this->input->post());



            if ($id == '') {

                $ad_data = array(
                    'branch_id' => $branch_id,
                    'name' => $name,
                    'created_at' => date('Y-m-d H:i:s'),
                    'status' => 1
                );
                $insert = $this->home_model->insert('tbllocationmaster', $ad_data);
                if ($insert) {
                    set_alert('success', 'New Location added successfully');
                    redirect(admin_url('staff/location_list'));
                }
            } else {

                $ad_data = array(
                    'branch_id' => $branch_id,
                    'name' => $name,
                );
                $update = $this->home_model->update('tbllocationmaster', $ad_data,array('id'=>$id));
                if ($update) {
                    set_alert('success', 'Location updated successfully');
                }
                redirect(admin_url('staff/location_list'));
            }
        }

        if ($id == '') {
            $title = 'Add Location Master';
        } else {
            $data['location_info'] = $this->db->query("SELECT * FROM tbllocationmaster where id = '".$id."' ")->row();
            $title = 'Edit Location Master';
        }

        $data['title'] = $title;
        $data['branch_info'] = $this->db->query("SELECT * FROM tblcompanybranch where status = '1' order by comp_branch_name asc ")->result();

        $this->load->view('admin/staff/location', $data);
    }

    public function delete_questionnaire($id) {

        $response = $this->home_model->delete('tbllocationmaster', array('id'=>$id));
        if ($response == true) {
            set_alert('success', 'Location Deleted Successfully');
            redirect(admin_url('staff/location_list'));
        } else {
            set_alert('warning', 'problem_deleting');
            redirect(admin_url('staff/location_list'));
        }

    }

    /* this function approval of staff member info */
    public function staff_info_approval($log_id){
        $data['title'] = "Staff Info Changes Approval";
        $data["info"] = $this->home_model->get_row("tblstafflog", array("id" => $log_id), array("*"));
        if ($this->input->post()){
            $data = $this->input->post();
            $staff_id = $data["info"]->staffid;
            $response = $this->staff_model->update_staff_info($data, $log_id);
            if ($response == true) {
                if ($data["submit"] == 1){
                    set_alert('success', "Staff changes approvad successfully");
                }else{
                    set_alert('danger', "Staff changes rejected successfully");
                }
            }else{
                set_alert('warning', "Somthing went wroung");
            }
            redirect(admin_url('approval/notifications'));
        }

        $this->load->view('admin/staff/staff_changes_approval', $data);
    }

    /* this function use for get approval status */
    public function get_changes_status() {

        if(!empty($_POST)){
            extract($this->input->post());

            $assign_info = $this->db->query("SELECT * from tblstafflogapprovalsend  where stafflog_id = '".$id."' ")->result();
            ?>
            <div class="row">
                <div class="col-md-12">
                    <h4 class="no-mtop mrg3">Assign Detail List</h4>
                </div>
                <hr/>
                <div class="col-md-12">
                    <div style="overflow-x:auto !important;">
                        <div class="form-group" >
                            <table class="table credite-note-items-table table-main-credit-note-edit no-mtop">
                                <thead>
                                    <tr>
                                        <td>S.No</td>
                                        <td>Name</td>
                                        <td>Status</td>
                                        <td>Remark</td>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    if (!empty($assign_info)) {
                                        $i = 1;
                                        foreach ($assign_info as $key => $value) {

                                            if ($value->approve_status == 0) {
                                                $status = 'Pending';
                                                $color = 'Darkorange';
                                            } elseif ($value->approve_status == 1) {
                                                $status = 'Approved';
                                                $color = 'green';
                                            } elseif ($value->approve_status == 2) {
                                                $status = 'Reject';
                                                $color = 'red';
                                            }
                                            ?>
                                            <tr>
                                                <td><?php echo $i++; ?></td>
                                                <td><?php echo get_employee_name($value->staff_id); ?></td>
                                                <td style="color: <?php echo $color; ?>;"><?php echo $status; ?></td>
                                                <td><?php echo $value->approvereason; ?></td>
                                            </tr>
                                            <?php
                                        }
                                    } else {
                                        echo '<tr><td class="text-center" colspan="4"><h5>Record Not Found!</h5></td></tr>';
                                    }
                                    ?>
                                </tbody>
                            </table>
                        </div>
                    </div>
                </div>
            </div>
            <?php
        }

    }

    /* this function use for staff salary date update */
    public function update_staff_salary_date() {
        if ($this->input->post()){
            $data = $this->input->post();

            $chk_salary_details = $this->home_model->get_row("tblstaffsalarydetails", array("id" => $data["salarydetails_id"]), array("staff_id"));
            if ($chk_salary_details){
                $udata["effected_date"] = db_date($data["effected_date"]);
                $udata["updated_on"] = date('Y-m-d H:i:s');
                $this->home_model->update('tblstaffsalarydetails', $udata,array('id'=> $data["salarydetails_id"]));

                set_alert('success', "Effected date update successfully");
                redirect(admin_url('staff/member/'.$chk_salary_details->staff_id));
            }

        }
    }

    /* this function use of check employee id is unique */
    public function check_employee_id(){
        if ($this->input->post()){
            $data = $this->input->post();

            $chk_salary_details = $this->home_model->get_row("tblstaff", array("employee_id" => $data["employee_id"]), array("employee_id"));
            if (!empty($chk_salary_details)){
                echo 'Employee ID Already Exist.';
            }
        } 
    }
}

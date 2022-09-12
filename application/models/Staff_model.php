<?php

defined('BASEPATH') or exit('No direct script access allowed');
class Staff_model extends CRM_Model
{
    private $perm_statements = ['view', 'view_own', 'edit', 'create', 'delete'];

    public function __construct()
    {
        parent::__construct();
    }

    public function delete($id, $transfer_data_to)
    {
        if (!is_numeric($transfer_data_to)) {
            return false;
        }

        if ($id == $transfer_data_to) {
            return false;
        }

        do_action('before_delete_staff_member', [
            'id'               => $id,
            'transfer_data_to' => $transfer_data_to,
        ]);

        $name           = get_staff_full_name($id);
        $transferred_to = get_staff_full_name($transfer_data_to);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblestimates', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('sale_agent', $id);
        $this->db->update('tblestimates', [
            'sale_agent' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblinvoices', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('sale_agent', $id);
        $this->db->update('tblinvoices', [
            'sale_agent' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblexpenses', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblnotes', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('userid', $id);
        $this->db->update('tblpostcomments', [
            'userid' => $transfer_data_to,
        ]);

        $this->db->where('creator', $id);
        $this->db->update('tblposts', [
            'creator' => $transfer_data_to,
        ]);

        $this->db->where('staff_id', $id);
        $this->db->update('tblprojectdiscussions', [
            'staff_id' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblprojects', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblcreditnotes', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('staff_id', $id);
        $this->db->update('tblcredits', [
            'staff_id' => $transfer_data_to,
        ]);

        $this->db->where('staff_id', $id);
        $this->db->update('tblgoals', [
            'staff_id' => $transfer_data_to,
        ]);

        $this->db->where('staffid', $id);
        $this->db->update('tblprojectfiles', [
            'staffid' => $transfer_data_to,
        ]);

        $this->db->where('staffid', $id);
        $this->db->update('tblproposalcomments', [
            'staffid' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblproposals', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('staffid', $id);
        $this->db->update('tblstafftaskcomments', [
            'staffid' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->where('is_added_from_contact', 0);
        $this->db->update('tblstafftasks', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('staffid', $id);
        $this->db->update('tblfiles', [
            'staffid' => $transfer_data_to,
        ]);

        $this->db->where('renewed_by_staff_id', $id);
        $this->db->update('tblcontractrenewals', [
            'renewed_by_staff_id' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tbltaskchecklists', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('finished_from', $id);
        $this->db->update('tbltaskchecklists', [
            'finished_from' => $transfer_data_to,
        ]);

        $this->db->where('admin', $id);
        $this->db->update('tblticketreplies', [
            'admin' => $transfer_data_to,
        ]);

        $this->db->where('admin', $id);
        $this->db->update('tbltickets', [
            'admin' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblleads', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('assigned', $id);
        $this->db->update('tblleads', [
            'assigned' => $transfer_data_to,
        ]);

        $this->db->where('staff_id', $id);
        $this->db->update('tbltaskstimers', [
            'staff_id' => $transfer_data_to,
        ]);

        $this->db->where('addedfrom', $id);
        $this->db->update('tblcontracts', [
            'addedfrom' => $transfer_data_to,
        ]);

        $this->db->where('assigned_from', $id);
        $this->db->where('is_assigned_from_contact', 0);
        $this->db->update('tblstafftaskassignees', [
            'assigned_from' => $transfer_data_to,
        ]);

        $this->db->where('responsible', $id);
        $this->db->update('tblleadsintegration', [
            'responsible' => $transfer_data_to,
        ]);

        $this->db->where('responsible', $id);
        $this->db->update('tblwebtolead', [
            'responsible' => $transfer_data_to,
        ]);

        $this->db->where('created_from', $id);
        $this->db->update('tblsubscriptions', [
            'created_from' => $transfer_data_to,
        ]);

        $this->db->where('notify_type', 'specific_staff');
        $webtolead = $this->db->get('tblwebtolead')->result_array();

        foreach ($webtolead as $form) {
            if (!empty($form['notify_ids'])) {
                $staff = unserialize($form['notify_ids']);
                if (is_array($staff)) {
                    if (in_array($id, $staff)) {
                        if (($key = array_search($id, $staff)) !== false) {
                            unset($staff[$key]);
                            $staff = serialize(array_values($staff));
                            $this->db->where('id', $form['id']);
                            $this->db->update('tblwebtolead', [
                                'notify_ids' => $staff,
                            ]);
                        }
                    }
                }
            }
        }

        $this->db->where('id', 1);
        $leads_email_integration = $this->db->get('tblleadsintegration')->row();

        if ($leads_email_integration->notify_type == 'specific_staff') {
            if (!empty($leads_email_integration->notify_ids)) {
                $staff = unserialize($leads_email_integration->notify_ids);
                if (is_array($staff)) {
                    if (in_array($id, $staff)) {
                        if (($key = array_search($id, $staff)) !== false) {
                            unset($staff[$key]);
                            $staff = serialize(array_values($staff));
                            $this->db->where('id', 1);
                            $this->db->update('tblleadsintegration', [
                                'notify_ids' => $staff,
                            ]);
                        }
                    }
                }
            }
        }

        $this->db->where('assigned', $id);
        $this->db->update('tbltickets', [
            'assigned' => 0,
        ]);

        $this->db->where('staff', 1);
        $this->db->where('userid', $id);
        $this->db->delete('tbldismissedannouncements');

        $this->db->where('userid', $id);
        $this->db->delete('tblcommentlikes');

        $this->db->where('userid', $id);
        $this->db->delete('tblpostlikes');

        $this->db->where('staff_id', $id);
        $this->db->delete('tblcustomeradmins');

        $this->db->where('fieldto', 'staff');
        $this->db->where('relid', $id);
        $this->db->delete('tblcustomfieldsvalues');

        $this->db->where('userid', $id);
        $this->db->delete('tblevents');

        $this->db->where('touserid', $id);
        $this->db->delete('tblnotifications');

        $this->db->where('staff_id', $id);
        $this->db->delete('tblusermeta');

        $this->db->where('staff_id', $id);
        $this->db->delete('tblprojectmembers');

        $this->db->where('staff_id', $id);
        $this->db->delete('tblprojectnotes');

        $this->db->where('creator', $id);
        $this->db->or_where('staff', $id);
        $this->db->delete('tblreminders');

        $this->db->where('staffid', $id);
        $this->db->delete('tblstaffdepartments');

        $this->db->where('staffid', $id);
        $this->db->delete('tbltodoitems');

        $this->db->where('staff', 1);
        $this->db->where('user_id', $id);
        $this->db->delete('tbluserautologin');

        $this->db->where('staffid', $id);
        $this->db->delete('tblstaffpermissions');

        $this->db->where('staffid', $id);
        $this->db->delete('tblstafftaskassignees');

        $this->db->where('staffid', $id);
        $this->db->delete('tblstafftasksfollowers');

        $this->db->where('staff_id', $id);
        $this->db->delete('tblpinnedprojects');

        $this->db->where('staffid', $id);
        $this->db->delete('tblstaff');
        logActivity('Staff Member Deleted [Name: ' . $name . ', Data Transferred To: ' . $transferred_to . ']');
        do_action('staff_member_deleted', [
            'id'               => $id,
            'transfer_data_to' => $transfer_data_to,
        ]);

        return true;
    }
    /**
     * Get staff member/s
     * @param  mixed $id Optional - staff id
     * @param  mixed $where where in query
     * @return mixed if id is passed return object else array
     */
    public function get($id = '', $where = [])
    {
        $select_str = '*,CONCAT(firstname," ",lastname) as full_name';

        // Used to prevent multiple queries on logged in staff to check the total unread notifications in admin_controller.php
        if (is_staff_logged_in() && $id != '' && $id == get_staff_user_id()) {
            $select_str .= ',(SELECT COUNT(*) FROM tblnotifications WHERE touserid=' . get_staff_user_id() . ' and isread_inline=0) as total_unread_notifications, (SELECT COUNT(*) FROM tbltodoitems WHERE finished=0 AND staffid=' . get_staff_user_id() . ') as total_unfinished_todos';
        }

        $this->db->select($select_str);


        $this->db->where($where);

        if (is_numeric($id)) {
            $this->db->where('staffid', $id);
            $staff = $this->db->get('tblstaff')->row();
            if ($staff) {
                $staff->permissions = $this->get_staff_permissions($id);
            }

            return $staff;
        }
        $this->db->order_by('firstname', 'desc');

        return $this->db->get('tblstaff')->result_array();
    }

    public function get_staff_permissions($id)
    {
        $permissions = $this->object_cache->get('staff-' . $id . '-permissions');

        if (!$permissions && !is_array($permissions)) {
            $this->db->select('tblstaffpermissions.*,tblpermissions.shortname as permission_name');
            $this->db->join('tblpermissions', 'tblpermissions.permissionid = tblstaffpermissions.permissionid');
            $this->db->where('staffid', $id);
            $permissions = $this->db->get('tblstaffpermissions')->result();
            $this->object_cache->add('staff-' . $id . '-permissions', $permissions);
        }

        return $permissions;
    }

    /**
     * Add new staff member
     * @param array $data staff $_POST data
     */
    public function add($data)
    {

        $data['contract_from_date']= db_date($data['contract_from_date']);
        $data['contract_to_date']= db_date($data['contract_to_date']);
        if(!empty($data['relieving_date'])){
            $data['relieving_date']= db_date($data['relieving_date']);
        }else{
           $data['relieving_date']= '0000-00-00';
        }

        if (isset($data['reg_id'])){
            $data['reg_id']= $data['reg_id'];
        }
		$joining_date = str_replace("/","-",$data['joining_date']);
        $data['joining_date']=date('Y-m-d',strtotime($joining_date));

        $birth_date = str_replace("/","-",$data['birth_date']);
        $actual_birth_date = str_replace("/","-",$data['actual_birth_date']);
        $data['birth_date']=date('Y-m-d',strtotime($birth_date));
        $data['actual_birth_date']=date('Y-m-d',strtotime($actual_birth_date));
		$branch_id=$data['branch_id'];
        $data['branch_id']=implode(',',$data['branch_id']);
		$data['firstname']=ucwords($data['firstname']);

        $data['employee_group']=implode(',',$data['employee_group']);

        if(!empty($data['calling_number'])){
            $data['callingnumber']=implode(',',$data['calling_number']);
             unset($data['calling_number']);
        }
        $data['employee_number'] = 0;
        if (!empty($data['employee_id'])){
            $employee_id = explode('/', $data['employee_id']);
            $data['employee_number'] = (isset($employee_id[2])) ? $employee_id[2] : $data['employee_id'];
        }

		//print_r($data);exit;
        if (isset($data['fakeusernameremembered'])) {
            unset($data['fakeusernameremembered']);
        }
        if (isset($data['fakepasswordremembered'])) {
            unset($data['fakepasswordremembered']);
        }
        // First check for all cases if the email exists.
        $this->db->where('email', $data['email']);
        $email = $this->db->get('tblstaff')->row();
        if ($email) {
            //die('Email already exists');
        }
		 // First check for all cases if the mobile no. exists.
		$this->db->where('phonenumber', $data['phonenumber']);
        $phonenumber = $this->db->get('tblstaff')->row();
        if ($phonenumber) {
            //die('Phone Number already exists');
        }

        $data['admin'] = 0;
        if (is_admin()) {
            if (isset($data['administrator'])) {
                $data['admin'] = 1;
                unset($data['administrator']);
            }
        }

        $send_welcome_email = true;
        $original_password  = $data['password'];
        if (!isset($data['send_welcome_email'])) {
            $send_welcome_email = false;
        } else {
            unset($data['send_welcome_email']);
        }
        $data['email_signature'] = nl2br_save_html($data['email_signature']);
        $this->load->helper('phpass');
        $hasher              = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        $data['password']    = $hasher->HashPassword($data['password']);
        $data['datecreated'] = date('Y-m-d H:i:s');
        if (isset($data['departments'])) {
            $departments = $data['departments'];
            unset($data['departments']);
        }

        $permissions = [];
        if (isset($data['view'])) {
            $permissions['view'] = $data['view'];
            unset($data['view']);
        }
        if (isset($data['view_own'])) {
            $permissions['view_own'] = $data['view_own'];
            unset($data['view_own']);
        }
        if (isset($data['edit'])) {
            $permissions['edit'] = $data['edit'];
            unset($data['edit']);
        }
        if (isset($data['create'])) {
            $permissions['create'] = $data['create'];
            unset($data['create']);
        }
        if (isset($data['delete'])) {
            $permissions['delete'] = $data['delete'];
            unset($data['delete']);
        }

        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            unset($data['custom_fields']);
        }
        if (isset($data['canBackDateEntry'])) {
            $data['canBackDateEntry'] = $data['canBackDateEntry'];
        }else{
            $data['canBackDateEntry'] = 0;
        }

        if ($data['admin'] == 1) {
            $data['is_not_staff'] = 0;
        }

        $data['added_by'] = get_staff_user_id();

        if(isset($data["bm_branch_id"])){
            $data["bm_branch_id"] = implode(",", $data["bm_branch_id"]);
        }
        if(isset($data["cashier_branch_id"])){
            $data["cashier_branch_id"] = implode(",", $data["cashier_branch_id"]);
        }
        if(isset($data["store_manager_branch_id"])){
            $data["store_manager_branch_id"] = implode(",", $data["store_manager_branch_id"]);
        }
        if(isset($data["dispatch_manager_branch_id"])){
            $data["dispatch_manager_branch_id"] = implode(",", $data["dispatch_manager_branch_id"]);
        }
        if(isset($data["religion_id"])){
            $data["religion_id"] = $data["religion_id"];
        }
        if(isset($data["division_id"])){
            $data["division_id"] = $data["division_id"];
        }
        $data["createdirectquote"] = (isset($data["createdirectquote"]) && $data["createdirectquote"] == "on") ? 1 : 0;
        $data["createdirectinvoice"] = (isset($data["createdirectinvoice"]) && $data["createdirectinvoice"] == "on") ? 1 : 0;
        $data["createdirectrequirement"] = (isset($data["createdirectrequirement"]) && $data["createdirectrequirement"] == "on") ? 1 : 0;
        $data["createdirectdesignrequisition"] = (isset($data["createdirectdesignrequisition"]) && $data["createdirectdesignrequisition"] == "on") ? 1 : 0;

        
        $this->db->insert('tblstaff', $data);
        $staffid = $this->db->insert_id();
		foreach($branch_id as $singlebranch)
		{
			$bpdata['email']=$data['email'];
			$bpdata['staffid']=$staffid;
			$bpdata['comp_branch_id']=$singlebranch;
			$bpdata['number']=$data['phonenumber'];
			$bpdata['designation']=$data['designation_id'];
			$bpdata['status']=1;
			$bpdata['created_at'] = date("Y-m-d H:i:s");
			$bpdata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tblcompanybranchperson',$bpdata);
		}
        if ($staffid) {
            $sl = $data['firstname'];
            if ($sl == ' ') {
                $sl = 'unknown-' . $staffid;
            }

            /* set page permission base on designation */
            $this->setpage_permission($staffid, $data['designation_id']);

            /* this function use for add salary details */
            $this->add_staff_effected_salary($staffid, $data['monthly_salary']);

            if ($send_welcome_email == true) {
                $this->load->model('emails_model');
                $merge_fields = [];
                $merge_fields = array_merge($merge_fields, get_staff_merge_fields($staffid, $original_password));
                $this->emails_model->send_email_template('new-staff-created', $data['email'], $merge_fields);
            }
            $this->db->where('staffid', $staffid);
            $this->db->update('tblstaff', [
                'media_path_slug' => slug_it($sl),
            ]);

            if (isset($custom_fields)) {
                handle_custom_fields_post($staffid, $custom_fields);
            }
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->insert('tblstaffdepartments', [
                        'staffid'      => $staffid,
                        'departmentid' => $department,
                    ]);
                }
            }


            $_all_permissions = $this->roles_model->get_permissions();
            foreach ($_all_permissions as $permission) {
                $this->db->insert('tblstaffpermissions', [
                    'permissionid' => $permission['permissionid'],
                    'staffid'      => $staffid,
                    'can_view'     => 0,
                    'can_view_own' => 0,
                    'can_edit'     => 0,
                    'can_create'   => 0,
                    'can_delete'   => 0,
                ]);
            }
            foreach ($this->perm_statements as $c) {
                foreach ($permissions as $key => $p) {
                    if ($key == $c) {
                        foreach ($p as $perm) {
                            $this->db->where('staffid', $staffid);
                            $this->db->where('permissionid', $perm);
                            $this->db->update('tblstaffpermissions', [
                                'can_' . $c => 1,
                            ]);
                        }
                    }
                }
            }

            logActivity('New Staff Member Added [ID: ' . $staffid . ', ' . $data['firstname'] . ']');
            // Delete all staff permission if is admin we dont need permissions stored in database (in case admin check some permissions)
            if ($data['admin'] == 1) {
                $this->db->where('staffid', $staffid);
                $this->db->delete('tblstaffpermissions');
            }
            // Get all announcements and set it to read.
            // $this->db->select('announcementid');
            // $this->db->from('tblannouncements');
            // $this->db->where('showtostaff', 1);
            // $announcements = $this->db->get()->result_array();
            // foreach ($announcements as $announcement) {
            //     $this->db->insert('tbldismissedannouncements', [
            //         'announcementid' => $announcement['announcementid'],
            //         'staff'          => 1,
            //         'userid'         => $staffid,
            //     ]);
            // }
            do_action('staff_member_created', $staffid);

            return $staffid;
        }

        return false;
    }

    /**
     * Update staff member info
     * @param  array $data staff data
     * @param  mixed $id   staff id
     * @return boolean
     */
    public function update($data, $id)
    {
        $data['contract_from_date']= db_date($data['contract_from_date']);
        $data['contract_to_date']= db_date($data['contract_to_date']);
        if(!empty($data['relieving_date'])){
            $data['relieving_date']= db_date($data['relieving_date']);
        }else{
           $data['relieving_date']= '0000-00-00';
        }


        $joining_date = str_replace("/","-",$data['joining_date']);
        $data['joining_date']=date('Y-m-d',strtotime($joining_date));

        $birth_date = str_replace("/","-",$data['birth_date']);
        $data['birth_date']=date('Y-m-d',strtotime($birth_date));
		$branch_id=$data['branch_id'];
		$data['branch_id']=implode(',',$data['branch_id']);
        $data['firstname']=ucwords($data['firstname']);

        $data['employee_group']=implode(',',$data['employee_group']);

		$this->db->where('staffid', $id);
		$this->db->delete('tblcompanybranchperson');
		foreach($branch_id as $singlebranch)
		{
			$bpdata['email']=$data['email'];
			$bpdata['staffid']=$id;
			$bpdata['comp_branch_id']=$singlebranch;
			$bpdata['number']=$data['phonenumber'];
			$bpdata['designation']=$data['designation_id'];
			$bpdata['status']=1;
			$bpdata['created_at'] = date("Y-m-d H:i:s");
			$bpdata['updated_at'] = date("Y-m-d H:i:s");
			$this->db->insert('tblcompanybranchperson',$bpdata);
		}

		if (isset($data['fakeusernameremembered'])) {
            unset($data['fakeusernameremembered']);
        }
        if (isset($data['fakepasswordremembered'])) {
            unset($data['fakepasswordremembered']);
        }

        $hook_data['data']   = $data;
        $hook_data['userid'] = $id;
        $hook_data           = do_action('before_update_staff_member', $hook_data);
        $data                = $hook_data['data'];
        $id                  = $hook_data['userid'];

        if (is_admin()) {
            if (isset($data['administrator'])) {

                $data['admin'] = 1;
                unset($data['administrator']);
            } else {
                if ($id != get_staff_user_id()) {
                    if ($id == 1) {
                        return [
                            'cant_remove_main_admin' => true,
                        ];
                    }
                } else {

                   /* return [
                        'cant_remove_yourself_from_admin' => true,
                    ];*/




                }
               // $data['admin'] = 0;
            }
        }

        $affectedRows = 0;
        if (isset($data['departments'])) {
            $departments = $data['departments'];
            unset($data['departments']);
        }
        $permissions = [];
        if (isset($data['view'])) {
            $permissions['view'] = $data['view'];
            unset($data['view']);
        }

        if (isset($data['view_own'])) {
            $permissions['view_own'] = $data['view_own'];
            unset($data['view_own']);
        }
        if (isset($data['edit'])) {
            $permissions['edit'] = $data['edit'];
            unset($data['edit']);
        }
        if (isset($data['create'])) {
            $permissions['create'] = $data['create'];
            unset($data['create']);
        }
        if (isset($data['delete'])) {
            $permissions['delete'] = $data['delete'];
            unset($data['delete']);
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $this->load->helper('phpass');
            $hasher                       = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']             = $hasher->HashPassword($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }


        if (isset($data['two_factor_auth_enabled'])) {
            $data['two_factor_auth_enabled'] = 1;
        } else {
            $data['two_factor_auth_enabled'] = 0;
        }

        if (isset($data['is_not_staff'])) {
            $data['is_not_staff'] = 1;
        } else {
            $data['is_not_staff'] = 0;
        }

        if ($data['admin'] == 1) {
            $data['is_not_staff'] = 0;
        }

        $data['email_signature'] = nl2br_save_html($data['email_signature']);

        $this->load->model('departments_model');
        $staff_departments = $this->departments_model->get_staff_departments($id);
        if (sizeof($staff_departments) > 0) {
            if (!isset($data['departments'])) {
                $this->db->where('staffid', $id);
                $this->db->delete('tblstaffdepartments');
            } else {
                foreach ($staff_departments as $staff_department) {
                    if (isset($departments)) {
                        if (!in_array($staff_department['departmentid'], $departments)) {
                            $this->db->where('staffid', $id);
                            $this->db->where('departmentid', $staff_department['departmentid']);
                            $this->db->delete('tblstaffdepartments');
                            if ($this->db->affected_rows() > 0) {
                                $affectedRows++;
                            }
                        }
                    }
                }
            }
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->where('staffid', $id);
                    $this->db->where('departmentid', $department);
                    $_exists = $this->db->get('tblstaffdepartments')->row();
                    if (!$_exists) {
                        $this->db->insert('tblstaffdepartments', [
                            'staffid'      => $id,
                            'departmentid' => $department,
                        ]);
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->insert('tblstaffdepartments', [
                        'staffid'      => $id,
                        'departmentid' => $department,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }

        if (isset($data['canBackDateEntry'])) {
            $data['canBackDateEntry'] = $data['canBackDateEntry'];
        }else{
            $data['canBackDateEntry'] = 0;
        }

        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', $data);
        if ($this->db->affected_rows() > 0) {
            $affectedRows++;
        }

        if ($this->update_permissions($permissions, $id)) {
            $affectedRows++;
        }

        if (isset($data['admin']) && $data['admin'] == 1) {
            $this->db->where('staffid', $id);
            $this->db->delete('tblstaffpermissions');
        }
        if ($affectedRows > 0) {
            do_action('staff_member_updated', $id);
            logActivity('Staff Member Updated [ID: ' . $id . ', ' . $data['firstname'] . ']');

            return true;
        }

        return false;
    }

    public function update_permissions($permissions, $id)
    {
        $all_permissions = $this->roles_model->get_permissions();
        if (total_rows('tblstaffpermissions', [
            'staffid' => $id,
        ]) == 0) {
            foreach ($all_permissions as $p) {
                $_ins                 = [];
                $_ins['staffid']      = $id;
                $_ins['permissionid'] = $p['permissionid'];
                $this->db->insert('tblstaffpermissions', $_ins);
            }
        } elseif (total_rows('tblstaffpermissions', [
                'staffid' => $id,
            ]) != count($all_permissions)) {
            foreach ($all_permissions as $p) {
                if (total_rows('tblstaffpermissions', [
                    'staffid' => $id,
                    'permissionid' => $p['permissionid'],
                ]) == 0) {
                    $_ins                 = [];
                    $_ins['staffid']      = $id;
                    $_ins['permissionid'] = $p['permissionid'];
                    $this->db->insert('tblstaffpermissions', $_ins);
                }
            }
        }
        $_permission_restore_affected_rows = 0;
        foreach ($all_permissions as $permission) {
            foreach ($this->perm_statements as $c) {
                $this->db->where('staffid', $id);
                $this->db->where('permissionid', $permission['permissionid']);
                $this->db->update('tblstaffpermissions', [
                    'can_' . $c => 0,
                ]);
                if ($this->db->affected_rows() > 0) {
                    $_permission_restore_affected_rows++;
                }
            }
        }
        $_new_permissions_added_affected_rows = 0;
        foreach ($permissions as $key => $val) {
            foreach ($val as $p) {
                $this->db->where('staffid', $id);
                $this->db->where('permissionid', $p);
                $this->db->update('tblstaffpermissions', [
                    'can_' . $key => 1,
                ]);
                if ($this->db->affected_rows() > 0) {
                    $_new_permissions_added_affected_rows++;
                }
            }
        }
        if ($_new_permissions_added_affected_rows != $_permission_restore_affected_rows) {
            return true;
        }
    }

    public function update_profile($data, $id)
    {
        $hook_data['data']   = $data;
        $hook_data['userid'] = $id;
        $hook_data           = do_action('before_staff_update_profile', $hook_data);
        $data                = $hook_data['data'];
        $id                  = $hook_data['userid'];

        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $this->load->helper('phpass');
            $hasher                       = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']             = $hasher->HashPassword($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }

        if (isset($data['two_factor_auth_enabled'])) {
            $data['two_factor_auth_enabled'] = 1;
        } else {
            $data['two_factor_auth_enabled'] = 0;
        }

        $data['email_signature'] = nl2br_save_html($data['email_signature']);

        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', $data);
        if ($this->db->affected_rows() > 0) {
            do_action('staff_member_profile_updated', $id);
            logActivity('Staff Profile Updated [Staff: ' . get_staff_full_name($id) . ']');

            return true;
        }

        return false;
    }

    /**
     * Change staff passwordn
     * @param  mixed $data   password data
     * @param  mixed $userid staff id
     * @return mixed
     */
    public function change_password($data, $userid)
    {
        $hook_data['data']   = $data;
        $hook_data['userid'] = $userid;
        $hook_data           = do_action('before_staff_change_password', $hook_data);
        $data                = $hook_data['data'];
        $userid              = $hook_data['userid'];

        $member = $this->get($userid);
        // CHeck if member is active
        if ($member->active == 0) {
            return [
                [
                    'memberinactive' => true,
                ],
            ];
        }
        $this->load->helper('phpass');
        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        // Check new old password
        if (!$hasher->CheckPassword($data['oldpassword'], $member->password)) {
            return [
                [
                    'passwordnotmatch' => true,
                ],
            ];
        }
        $data['newpasswordr'] = $hasher->HashPassword($data['newpasswordr']);
        $this->db->where('staffid', $userid);
        $this->db->update('tblstaff', [
            'password'             => $data['newpasswordr'],
            'last_password_change' => date('Y-m-d H:i:s'),
        ]);
        if ($this->db->affected_rows() > 0) {
            logActivity('Staff Password Changed [' . $userid . ']');

            return true;
        }

        return false;
    }

    /**
     * Change staff status / active / inactive
     * @param  mixed $id     staff id
     * @param  mixed $status status(0/1)
     */
    public function change_staff_status($id, $status)
    {
        $hook_data['id']     = $id;
        $hook_data['status'] = $status;
        $hook_data           = do_action('before_staff_status_change', $hook_data);
        $status              = $hook_data['status'];
        $id                  = $hook_data['id'];

        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', [
            'active' => $status,
        ]);
        logActivity('Staff Status Changed [StaffID: ' . $id . ' - Status(Active/Inactive): ' . $status . ']');
    }

    public function get_logged_time_data($id = '', $filter_data = [])
    {
        if ($id == '') {
            $id = get_staff_user_id();
        }
        $result['timesheets'] = [];
        $result['total']      = [];
        $result['this_month'] = [];

        $first_day_this_month = date('Y-m-01'); // hard-coded '01' for first day
        $last_day_this_month  = date('Y-m-t 23:59:59');

        $result['last_month'] = [];
        $first_day_last_month = date('Y-m-01', strtotime('-1 MONTH')); // hard-coded '01' for first day
        $last_day_last_month  = date('Y-m-t 23:59:59', strtotime('-1 MONTH'));

        $result['this_week'] = [];
        $first_day_this_week = date('Y-m-d', strtotime('monday this week'));
        $last_day_this_week  = date('Y-m-d 23:59:59', strtotime('sunday this week'));

        $result['last_week'] = [];

        $first_day_last_week = date('Y-m-d', strtotime('monday last week'));
        $last_day_last_week  = date('Y-m-d 23:59:59', strtotime('sunday last week'));

        /*$this->db->select('task_id,start_time,end_time,staff_id,tbltaskstimers.hourly_rate,name,tbltaskstimers.id,rel_id,rel_type');
        $this->db->where('staff_id', $id);
        $this->db->join('tblstafftasks', 'tblstafftasks.id = tbltaskstimers.task_id', 'left');
        $timers           = $this->db->get('tbltaskstimers')->result_array();*/
		$timers = '';
        $_end_time_static = time();

        $filter_period = false;
        if (isset($filter_data['period-from']) && $filter_data['period-from'] != '' && isset($filter_data['period-to']) && $filter_data['period-to'] != '') {
            $filter_period = true;
            $from          = to_sql_date($filter_data['period-from']);
            $from          = date('Y-m-d', strtotime($from));
            $to            = to_sql_date($filter_data['period-to']);
            $to            = date('Y-m-d', strtotime($to));
        }

        /*foreach ($timers as $timer) {
            $start_date = strftime('%Y-%m-%d', $timer['start_time']);

            $end_time = $timer['end_time'];

            if ($timer['end_time'] == null) {
                $end_time = $_end_time_static;
            }

            $total = $end_time - $timer['start_time'];

            $result['total'][] = $total;
            $timer['total']    = $total;
            $timer['end_time'] = $end_time;

            if ($start_date >= $first_day_this_month && $start_date <= $last_day_this_month) {
                $result['this_month'][] = $total;
                if (isset($filter_data['this_month']) && $filter_data['this_month'] != '') {
                    $result['timesheets'][$timer['id']] = $timer;
                }
            }
            if ($start_date >= $first_day_last_month && $start_date <= $last_day_last_month) {
                $result['last_month'][] = $total;
                if (isset($filter_data['last_month']) && $filter_data['last_month'] != '') {
                    $result['timesheets'][$timer['id']] = $timer;
                }
            }
            if ($start_date >= $first_day_this_week && $start_date <= $last_day_this_week) {
                $result['this_week'][] = $total;
                if (isset($filter_data['this_week']) && $filter_data['this_week'] != '') {
                    $result['timesheets'][$timer['id']] = $timer;
                }
            }
            if ($start_date >= $first_day_last_week && $start_date <= $last_day_last_week) {
                $result['last_week'][] = $total;
                if (isset($filter_data['last_week']) && $filter_data['last_week'] != '') {
                    $result['timesheets'][$timer['id']] = $timer;
                }
            }

            if ($filter_period == true) {
                if ($start_date >= $from && $start_date <= $to) {
                    $result['timesheets'][$timer['id']] = $timer;
                }
            }
        }*/
        $result['total']      = array_sum($result['total']);
        $result['this_month'] = array_sum($result['this_month']);
        $result['last_month'] = array_sum($result['last_month']);
        $result['this_week']  = array_sum($result['this_week']);
        $result['last_week']  = array_sum($result['last_week']);

        return $result;
    }

	public function imagedelete($id) {

        $data['profile_image'] = '';
        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Staff Images Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

	public function docdelete($id) {

        $data['staff_document'] = '';
        $this->db->where('staffid', $id);
        $this->db->update('tblstaff', $data);
        if ($this->db->affected_rows() > 0) {
            logActivity('Staff Document Deleted [ID: ' . $id . ']');

            return true;
        }

        return false;
    }

    /* Registered staff proccess do complete */
    public function registered_staff_details_update($id, $data){

        $updatedata["manager_id"] = get_staff_user_id();
        $updatedata["employee_name"] = $data["employee_name"];
        $updatedata["email"] = $data["email"];
        $updatedata["contact_no"] = $data["contact_no"];

        $birth_date = str_replace("/","-",$data['birth_date']);
        $updatedata["birth_date"] = date('Y-m-d',strtotime($birth_date));
        $updatedata["gender"] = $data["gender"];
        $updatedata["permenent_address"] = $data["permenent_address"];
        $updatedata["permenent_state"] = $data["permenent_state"];
        $updatedata["permenent_city"] = $data["permenent_city"];
        $updatedata["residential_address"] = $data["residential_address"];
        $updatedata["residential_state"] = $data["residential_state"];
        $updatedata["residential_city"] = $data["residential_city"];
        $updatedata["adhar_no"] = $data["adhar_no"];
        $updatedata["pan_card_no"] = $data["pan_card_no"];
        $updatedata["department_id"] = $data["department_id"];
        $updatedata["superior_id"] = $data["superior_id"];
        $updatedata["epf_no"] = $data["epf_no"];
        $updatedata["esic_no"] = $data["esic_no"];
        $updatedata["epf_esicdeduct_id"] = $data["epf_esicdeduct_id"];
        $updatedata["probationperiod_id"] = $data["probationperiod_id"];
        $updatedata["workingbasis_id"] = $data["workingbasis_id"];
        $updatedata["gross_salary"] = $data["gross_salary"];
        $updatedata["net_salary"] = $data["net_salary"];
        $updatedata["interviewername"] = $data["interviewername"];
        $updatedata["interviewerremark"] = $data["interviewerremark"];
        $updatedata["account_no"] = $data["account_no"];
        $updatedata["ifc_code"] = $data["ifc_code"];
        $updatedata["approval_status"] = 0;

        $this->db->where('staffid', $id);
        $response = $this->db->update('tblregisteredstaff', $updatedata);
        if ($response){
            logActivity('Registered Staff Details Updated [StaffID: ' . $id . ']');
        }
        return $id;
    }

    /**
     * Send approval staff member info
     * @param  array $data staff data
     * @param  mixed $id   staff id
     * @return boolean
     */
    public function send_approval_staff_info($data, $id)
    {
//        echo '<pre>';
//        print_r($data);
//        exit;
        $data['contract_from_date']= db_date($data['contract_from_date']);
        $data['contract_to_date']= db_date($data['contract_to_date']);
        if(!empty($data['relieving_date'])){
            $data['relieving_date']= db_date($data['relieving_date']);
        }else{
           $data['relieving_date']= '0000-00-00';
        }


        $joining_date = str_replace("/","-",$data['joining_date']);
        $data['joining_date']=date('Y-m-d',strtotime($joining_date));

        $data['staffid'] = $id;

        $birth_date = str_replace("/","-",$data['birth_date']);
        $actual_birth_date = str_replace("/","-",$data['actual_birth_date']);
        $data['actual_birth_date']=date('Y-m-d',strtotime($actual_birth_date));
        $data['birth_date']=date('Y-m-d',strtotime($birth_date));
		$branch_id=$data['branch_id'];
		$data['branch_id']=implode(',',$data['branch_id']);
        $data['firstname']=ucwords($data['firstname']);

        $data['employee_group']=implode(',',$data['employee_group']);

        if(!empty($data['calling_number'])){
            $data['callingnumber']=implode(',',$data['calling_number']);
             unset($data['calling_number']);
        }

        $data['approval_status'] = 0;

        $this->db->where('staffid', $id);
        $this->db->delete('tblcompanybranchperson');
        foreach($branch_id as $singlebranch)
        {
                $bpdata['email']=$data['email'];
                $bpdata['staffid']=$id;
                $bpdata['comp_branch_id']=$singlebranch;
                $bpdata['number']=$data['phonenumber'];
                $bpdata['designation']=$data['designation_id'];
                $bpdata['status']=1;
                $bpdata['created_at'] = date("Y-m-d H:i:s");
                $bpdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblcompanybranchperson',$bpdata);
        }
	if (isset($data['fakeusernameremembered'])) {
            unset($data['fakeusernameremembered']);
        }
        if (isset($data['fakepasswordremembered'])) {
            unset($data['fakepasswordremembered']);
        }

        $hook_data['data']   = $data;
        $hook_data['userid'] = $id;
        $hook_data           = do_action('before_update_staff_member', $hook_data);
        $data                = $hook_data['data'];
        $id                  = $hook_data['userid'];

        if (is_admin()) {
            if (isset($data['administrator'])) {

                $data['admin'] = 1;
                unset($data['administrator']);
            } else {
                if ($id != get_staff_user_id()) {
                    if ($id == 1) {
                        return [
                            'cant_remove_main_admin' => true,
                        ];
                    }
                } else {

                   /* return [
                        'cant_remove_yourself_from_admin' => true,
                    ];*/




                }
               // $data['admin'] = 0;
            }
        }

        $affectedRows = 0;
        if (isset($data['departments'])) {
            $departments = $data['departments'];
            unset($data['departments']);
        }
        $permissions = [];
        if (isset($data['view'])) {
            $permissions['view'] = $data['view'];
            unset($data['view']);
        }

        if (isset($data['view_own'])) {
            $permissions['view_own'] = $data['view_own'];
            unset($data['view_own']);
        }
        if (isset($data['edit'])) {
            $permissions['edit'] = $data['edit'];
            unset($data['edit']);
        }
        if (isset($data['create'])) {
            $permissions['create'] = $data['create'];
            unset($data['create']);
        }
        if (isset($data['delete'])) {
            $permissions['delete'] = $data['delete'];
            unset($data['delete']);
        }
        if (isset($data['custom_fields'])) {
            $custom_fields = $data['custom_fields'];
            if (handle_custom_fields_post($id, $custom_fields)) {
                $affectedRows++;
            }
            unset($data['custom_fields']);
        }
        if (empty($data['password'])) {
            unset($data['password']);
        } else {
            $this->load->helper('phpass');
            $hasher                       = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
            $data['password']             = $hasher->HashPassword($data['password']);
            $data['last_password_change'] = date('Y-m-d H:i:s');
        }


        if (isset($data['two_factor_auth_enabled'])) {
            $data['two_factor_auth_enabled'] = 1;
        } else {
            $data['two_factor_auth_enabled'] = 0;
        }

        if (isset($data['is_not_staff'])) {
            $data['is_not_staff'] = 1;
        } else {
            $data['is_not_staff'] = 0;
        }

        if ($data['admin'] == 1) {
            $data['is_not_staff'] = 0;
        }

        $data['email_signature'] = nl2br_save_html($data['email_signature']);

        $this->load->model('departments_model');
        $staff_departments = $this->departments_model->get_staff_departments($id);
        if (sizeof($staff_departments) > 0) {
            if (!isset($data['departments'])) {
                $this->db->where('staffid', $id);
                $this->db->delete('tblstaffdepartments');
            } else {
                foreach ($staff_departments as $staff_department) {
                    if (isset($departments)) {
                        if (!in_array($staff_department['departmentid'], $departments)) {
                            $this->db->where('staffid', $id);
                            $this->db->where('departmentid', $staff_department['departmentid']);
                            $this->db->delete('tblstaffdepartments');
                            if ($this->db->affected_rows() > 0) {
                                $affectedRows++;
                            }
                        }
                    }
                }
            }
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->where('staffid', $id);
                    $this->db->where('departmentid', $department);
                    $_exists = $this->db->get('tblstaffdepartments')->row();
                    if (!$_exists) {
                        $this->db->insert('tblstaffdepartments', [
                            'staffid'      => $id,
                            'departmentid' => $department,
                        ]);
                        if ($this->db->affected_rows() > 0) {
                            $affectedRows++;
                        }
                    }
                }
            }
        } else {
            if (isset($departments)) {
                foreach ($departments as $department) {
                    $this->db->insert('tblstaffdepartments', [
                        'staffid'      => $id,
                        'departmentid' => $department,
                    ]);
                    if ($this->db->affected_rows() > 0) {
                        $affectedRows++;
                    }
                }
            }
        }

        if (isset($data['canBackDateEntry'])) {
            $data['canBackDateEntry'] = $data['canBackDateEntry'];
        }else{
            $data['canBackDateEntry'] = 0;
        }
        $assignstaff = $data['assignid'];
        $staff_id = array();
        foreach ($assignstaff as $single_staff) {
            if (strpos($single_staff, 'staff') !== false) {
                $staff_id[] = str_replace("staff", "", $single_staff);
            }
            if (strpos($single_staff, 'group') !== false) {
                $single_staff = str_replace("group", "", $single_staff);
                $staffgroup = $this->db->query("SELECT `staff_id` FROM `tblstaffgroupmembers` WHERE `group_id`='" . $single_staff . "'")->result_array();
                foreach ($staffgroup as $singlestaff) {
                    $staff_id[] = $singlestaff['staff_id'];
                }
            }
        }
        unset($data['assignid']);
        $staff_id = array_unique($staff_id);

        /* delete All Old pending data */
        $this->load->model('home_model');
        $exist_info = $this->home_model->get_result('tblstafflog', array('staffid'=>$id, 'approval_status' => 0), array('id'));
        if ($exist_info){
            foreach ($exist_info as $ex_info) {

                $this->home_model->delete('tblstafflogapprovalsend', array('stafflog_id'=>$ex_info->id, 'approve_status' => 0));
                $this->home_model->delete('tblmasterapproval', array('table_id'=>$ex_info->id, 'module_id'=> 20));
                $this->home_model->delete('tblstafflog', array('id'=>$ex_info->id, 'approval_status' => 0));
            }
        }

        if(isset($data["bm_branch_id"])){
            $data["bm_branch_id"] = implode(",", $data["bm_branch_id"]);
        }
        if(isset($data["cashier_branch_id"])){
            $data["cashier_branch_id"] = implode(",", $data["cashier_branch_id"]);
        }
        if(isset($data["store_manager_branch_id"])){
            $data["store_manager_branch_id"] = implode(",", $data["store_manager_branch_id"]);
        }
        if(isset($data["dispatch_manager_branch_id"])){
            $data["dispatch_manager_branch_id"] = implode(",", $data["dispatch_manager_branch_id"]);
        }

        $data['employee_number'] = 0;
        if (!empty($data['employee_id'])){
            $employee_id = explode('/', $data['employee_id']);
            $data['employee_number'] = (isset($employee_id[2])) ? $employee_id[2] : $data['employee_id'];
        }

        $data["createdirectquote"] = (isset($data["createdirectquote"]) && $data["createdirectquote"] == "on") ? 1 : 0;
        $data["createdirectinvoice"] = (isset($data["createdirectinvoice"]) && $data["createdirectinvoice"] == "on") ? 1 : 0;
        $data["createdirectrequirement"] = (isset($data["createdirectrequirement"]) && $data["createdirectrequirement"] == "on") ? 1 : 0;
        $data["createdirectdesignrequisition"] = (isset($data["createdirectdesignrequisition"]) && $data["createdirectdesignrequisition"] == "on") ? 1 : 0;
        $data["company_facilities"] = (isset($data["company_facilities"]) && !empty($data["company_facilities"])) ? $data["company_facilities"] : 0;
        $this->db->insert('tblstafflog', $data);
        $insert_id = $this->db->insert_id();
        if ($insert_id) {
            $affectedRows++;
            /* update staff table */
            $this->db->where('staffid', $id);
            $this->db->update('tblstaff', array("approval_status" => 0));

            $staff_info = $this->home_model->get_row('tblstaff', array('staffid'=>$id), array('previous_monthly_salary, datecreated'));
            $chk_salary_info = $this->home_model->get_row('tblstaffsalarydetails', array('staff_id'=>$id, 'salary_amount'=>$staff_info->previous_monthly_salary), array('id'));
            if (empty($chk_salary_info)){

                $this->add_staff_effected_salary($id, $staff_info->previous_monthly_salary, date("Y-m-d", strtotime($staff_info->datecreated)));
            }
            $staff_log = $this->home_model->get_result('tblstafflog', array('staffid'=>$id, 'approval_status' => 1), array('id,monthly_salary,updated_at'));
            if (!empty($staff_log)) {
                foreach ($staff_log as $log_info) {
                    $chk_salary_info = $this->home_model->get_row('tblstaffsalarydetails', array('staff_id'=>$id, 'salary_amount'=>$log_info->monthly_salary), array('id'));
                    if (empty($chk_salary_info)){

                        $this->add_staff_effected_salary($id, $log_info->monthly_salary, date("Y-m-d", strtotime($log_info->updated_at)));
                    }
                }
            }

            foreach ($staff_id as $staffid) {
                $sdata['staff_id'] = $staffid;
                $sdata['stafflog_id'] = $insert_id;
                $sdata['status'] = '1';
                $sdata['created_at'] = date("Y-m-d H:i:s");
                $sdata['updated_at'] = date("Y-m-d H:i:s");
                $this->db->insert('tblstafflogapprovalsend', $sdata);

                $adata = array(
                    'staff_id' => $staffid,
                    'fromuserid' => get_staff_user_id(),
                    'module_id' => 20,
                    'table_id' => $insert_id,
                    'approve_status' => 0,
                    'status' => 0,
                    'description'     => 'Staff Info Changes For Approval',
                    'link' => 'staff/staff_info_approval/'.$insert_id,
                    'date' => date('Y-m-d'),
                    'date_time' => date('Y-m-d H:i:s'),
                    'updated_at' => date('Y-m-d H:i:s')
                );
                $this->db->insert('tblmasterapproval', $adata);

                //Sending Mobile Intimation
                    $token = get_staff_token($staffid);
                    $title = 'Schach';
                    $message = 'Staff Member ('.$data['firstname'].') Info Changes For Approval';
                    $send_intimation = sendFCM($message, $title, $token, $page = 2);
            }
        }

        if ($this->update_permissions($permissions, $id)) {
            $affectedRows++;
        }

        if (isset($data['admin']) && $data['admin'] == 1) {
            $this->db->where('staffid', $id);
            $this->db->delete('tblstaffpermissions');
        }
        if ($affectedRows > 0) {
            return true;
        }

        return false;
    }

    /**
     * Update staff member info after approval
     * @param  array $data staff data
     * @param  mixed $id  staff log id
     * @return boolean
     */
    public function update_staff_info($data, $log_id)
    {
        $ad_data = array(
            'approvereason' => $data["remark"],
            'approve_status' => $data["submit"],
            'created_at' => date('Y-m-d H:i:s')
        );

        $this->home_model->update('tblstafflogapprovalsend', $ad_data,array('stafflog_id'=>$log_id,'staff_id'=>get_staff_user_id()));

        update_masterapproval_single(get_staff_user_id(),20,$log_id,$data["submit"]);
        update_masterapproval_all(20,$log_id,$data["submit"]);

        $staff_log_data = $this->home_model->get_row("tblstafflog", array("id" => $log_id), array("*"));

        /* update staff table */
        $this->db->where('staffid', $staff_log_data->staffid);
        $this->db->update('tblstaff', array("approval_status" => $data["submit"]));

        /* update staff log table */
        $this->db->where('id', $log_id);
        $this->db->update('tblstafflog', array("approval_status" => $data["submit"], "updated_at" => date('Y-m-d H:i:s')));

        if ($data["submit"]==1){

            if ($staff_log_data->email){
                $update_data["email"] = $staff_log_data->email;
            }
            if ($staff_log_data->firstname){
                $update_data["firstname"] = $staff_log_data->firstname;
            }
            if ($staff_log_data->employee_id){
                $update_data["employee_id"] = $staff_log_data->employee_id;
            }
            if ($staff_log_data->employee_number){
                $update_data["employee_number"] = $staff_log_data->employee_number;
            }
            if ($staff_log_data->branch_id){
                $update_data["branch_id"] = $staff_log_data->branch_id;
            }
            if ($staff_log_data->staff_type_id){
                $update_data["staff_type_id"] = $staff_log_data->staff_type_id;
            }
            if ($staff_log_data->contract_to_date){
                $update_data["contract_to_date"] = $staff_log_data->contract_to_date;
            }
            if ($staff_log_data->contract_from_date){
                $update_data["contract_from_date"] = $staff_log_data->contract_from_date;
            }
            if ($staff_log_data->designation_id){
                $update_data["designation_id"] = $staff_log_data->designation_id;
            }
            if ($staff_log_data->birth_date){
                $update_data["birth_date"] = $staff_log_data->birth_date;
            }
            if ($staff_log_data->actual_birth_date){
                $update_data["actual_birth_date"] = $staff_log_data->actual_birth_date;
            }
            if ($staff_log_data->joining_date){
                $update_data["joining_date"] = $staff_log_data->joining_date;
            }
            if ($staff_log_data->pan_card_no){
                $update_data["pan_card_no"] = $staff_log_data->pan_card_no;
            }
            if ($staff_log_data->adhar_no){
                $update_data["adhar_no"] = $staff_log_data->adhar_no;
            }
            if ($staff_log_data->epf_no){
                $update_data["epf_no"] = $staff_log_data->epf_no;
            }
            if ($staff_log_data->epic_no){
                $update_data["epic_no"] = $staff_log_data->epic_no;
            }
            if ($staff_log_data->permenent_address){
                $update_data["permenent_address"] = $staff_log_data->permenent_address;
            }
            if ($staff_log_data->permenent_state){
                $update_data["permenent_state"] = $staff_log_data->permenent_state;
            }
            if ($staff_log_data->permenent_city){
                $update_data["permenent_city"] = $staff_log_data->permenent_city;
            }
            if ($staff_log_data->residential_address){
                $update_data["residential_address"] = $staff_log_data->residential_address;
            }
            if ($staff_log_data->residential_state){
                $update_data["residential_state"] = $staff_log_data->residential_state;
            }
            if ($staff_log_data->residential_city){
                $update_data["residential_city"] = $staff_log_data->residential_city;
            }
            if ($staff_log_data->lastname){
                $update_data["lastname"] = $staff_log_data->lastname;
            }
            if ($staff_log_data->facebook){
                $update_data["facebook"] = $staff_log_data->facebook;
            }
            if ($staff_log_data->linkedin){
                $update_data["linkedin"] = $staff_log_data->linkedin;
            }
            if ($staff_log_data->phonenumber){
                $update_data["phonenumber"] = $staff_log_data->phonenumber;
            }
            if ($staff_log_data->alternatenumber){
                $update_data["alternatenumber"] = $staff_log_data->alternatenumber;
            }
            if ($staff_log_data->skype){
                $update_data["skype"] = $staff_log_data->skype;
            }
            if ($staff_log_data->user_id){
                $update_data["user_id"] = $staff_log_data->user_id;
            }
            if ($staff_log_data->password){
                $update_data["password"] = $staff_log_data->password;
            }
            if ($staff_log_data->last_password_change){
                $update_data["last_password_change"] = $staff_log_data->last_password_change;
            }
            if ($staff_log_data->profile_image){
                $update_data["profile_image"] = $staff_log_data->profile_image;
            }
            if ($staff_log_data->staff_document){
                $update_data["staff_document"] = $staff_log_data->staff_document;
            }
            if ($staff_log_data->admin){
                $update_data["admin"] = $staff_log_data->admin;
            }
            if ($staff_log_data->is_not_staff){
                $update_data["is_not_staff"] = $staff_log_data->is_not_staff;
            }
            if ($staff_log_data->two_factor_auth_enabled){
                $update_data["two_factor_auth_enabled"] = $staff_log_data->two_factor_auth_enabled;
            }
            if ($staff_log_data->two_factor_auth_code){
                $update_data["two_factor_auth_code"] = $staff_log_data->two_factor_auth_code;
            }
            if ($staff_log_data->email_signature){
                $update_data["email_signature"] = $staff_log_data->email_signature;
            }
            if ($staff_log_data->father_husband_name){
                $update_data["father_husband_name"] = $staff_log_data->father_husband_name;
            }
            if ($staff_log_data->monthly_salary){
                $update_data["monthly_salary"] = $staff_log_data->monthly_salary;
            }
            if ($staff_log_data->gross_salary){
                $update_data["gross_salary"] = $staff_log_data->gross_salary;
            }
            if ($staff_log_data->working_from){
                $update_data["working_from"] = $staff_log_data->working_from;
            }
            if ($staff_log_data->working_to){
                $update_data["working_to"] = $staff_log_data->working_to;
            }
            if ($staff_log_data->paid_leave_time){
                $update_data["paid_leave_time"] = $staff_log_data->paid_leave_time;
            }
            if ($staff_log_data->gender){
                $update_data["gender"] = $staff_log_data->gender;
            }
            if ($staff_log_data->payment_mode){
                $update_data["payment_mode"] = $staff_log_data->payment_mode;
            }
            if ($staff_log_data->account_no){
                $update_data["account_no"] = $staff_log_data->account_no;
            }
            if ($staff_log_data->ifsc_code){
                $update_data["ifsc_code"] = $staff_log_data->ifsc_code;
            }
            if ($staff_log_data->warehouse_id){
                $update_data["warehouse_id"] = $staff_log_data->warehouse_id;
            }
            if ($staff_log_data->employee_group){
                $update_data["employee_group"] = $staff_log_data->employee_group;
            }
            if ($staff_log_data->taxable){
                $update_data["taxable"] = $staff_log_data->taxable;
            }
            if ($staff_log_data->relieving_reason){
                $update_data["relieving_reason"] = $staff_log_data->relieving_reason;
            }
            if ($staff_log_data->last_expense_date_limit){
                $update_data["last_expense_date_limit"] = $staff_log_data->last_expense_date_limit;
            }
            if ($staff_log_data->superior_id){
                $update_data["superior_id"] = $staff_log_data->superior_id;
            }
            if ($staff_log_data->department_id){
                $update_data["department_id"] = $staff_log_data->department_id;
            }
            if ($staff_log_data->location_id){
                $update_data["location_id"] = $staff_log_data->location_id;
            }
            if ($staff_log_data->reporting_branch_id){
                $update_data["reporting_branch_id"] = $staff_log_data->reporting_branch_id;
            }
            if ($staff_log_data->canBackDateEntry){
                $update_data["canBackDateEntry"] = $staff_log_data->canBackDateEntry;
            }
            if ($staff_log_data->callingnumber){
                $update_data["callingnumber"] = $staff_log_data->callingnumber;
            }
            if ($staff_log_data->attendance_from){
                $update_data["attendance_from"] = $staff_log_data->attendance_from;
            }
            if ($staff_log_data->bm_branch_id){
                $update_data["bm_branch_id"] = $staff_log_data->bm_branch_id;
            }
            if ($staff_log_data->cashier_branch_id){
                $update_data["cashier_branch_id"] = $staff_log_data->cashier_branch_id;
            }
            if ($staff_log_data->store_manager_branch_id){
                $update_data["store_manager_branch_id"] = $staff_log_data->store_manager_branch_id;
            }
            if ($staff_log_data->dispatch_manager_branch_id){
                $update_data["dispatch_manager_branch_id"] = $staff_log_data->dispatch_manager_branch_id;
            }
            if ($staff_log_data->permenent_pincode){
                $update_data["permenent_pincode"] = $staff_log_data->permenent_pincode;
            }
            if ($staff_log_data->residential_pincode){
                $update_data["residential_pincode"] = $staff_log_data->residential_pincode;
            }
            if ($staff_log_data->bank_name){
                $update_data["bank_name"] = $staff_log_data->bank_name;
            }
            if ($staff_log_data->relieving_date){
                $update_data["relieving_date"] = $staff_log_data->relieving_date;
            }
            if ($staff_log_data->religion_id){
                $update_data["religion_id"] = $staff_log_data->religion_id;
            }
            if ($staff_log_data->division_id){
                $update_data["division_id"] = $staff_log_data->division_id;
            }
            $update_data["createdirectquote"] = ($staff_log_data->createdirectquote > 0) ? 1 : 0;
            $update_data["createdirectinvoice"] = ($staff_log_data->createdirectinvoice > 0) ? 1 : 0;
            $update_data["createdirectrequirement"] = ($staff_log_data->createdirectrequirement > 0) ? 1 : 0;
            $update_data["createdirectdesignrequisition"] = ($staff_log_data->createdirectdesignrequisition > 0) ? 1 : 0;
            $update_data["company_facilities"] = ($staff_log_data->company_facilities > 0) ? $staff_log_data->company_facilities : 0;

            $staff_data = $this->home_model->get_row("tblstaff", array("staffid" => $staff_log_data->staffid), array("monthly_salary"));

            $this->db->where('staffid', $staff_log_data->staffid);
            $this->db->update('tblstaff', $update_data);
            if ($this->db->affected_rows() > 0) {

                if ($staff_data->monthly_salary != $staff_log_data->monthly_salary){

                    /* this function use for add salary details */
                    $this->add_staff_effected_salary($staff_log_data->staffid, $staff_log_data->monthly_salary);
                }

                do_action('staff_member_updated', $staff_log_data->staffid);
                logActivity('Staff Member Updated [ID: ' . $staff_log_data->staffid . ', ' . $staff_log_data->firstname . ']');
                return true;
            }
            return false;
        }
        return true;
    }

    /* this is for add staff effected salary */
    public function add_staff_effected_salary($staff_id, $salary_amount, $date = "") {

        $sdata['staff_id'] = $staff_id;
        $sdata['salary_amount'] = $salary_amount;
        $sdata['effected_date'] = ($date != "") ? $date : date("Y-m-d");
        $sdata['created_on'] = date("Y-m-d H:i:s");
        $sdata['updated_on'] = date("Y-m-d H:i:s");
        $this->db->insert('tblstaffsalarydetails', $sdata);
    }

    /* this is use for set page parmission according to designation */
    public function setpage_permission($staffid, $designation_id){
        $get_parmission = $this->db->query("SELECT * FROM tblmenuassigned WHERE `designation_id` = '".$designation_id."' and `staff_id` = 0")->result();
        if (!empty($get_parmission) && !empty($staffid)){
            foreach($get_parmission as $val){
                $ad_data = array(
                    'staff_id' => $staffid,
                    'menu_id' => $val->menu_id,
                    'view' => $val->view,
                    'create' => $val->create,
                    'edit' => $val->edit,
                    'delete' => $val->delete
                );

                $this->home_model->insert('tblmenuassigned', $ad_data);
            }
        }
    }
}

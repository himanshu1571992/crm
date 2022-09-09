<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Settings extends Admin_controller
{
    public function __construct()
    {
        parent::__construct();
        $this->load->model('payment_modes_model');
        $this->load->model('settings_model');
    }

	
	 public function table() {
        $this->app->get_table_data('warehouse');
    }
	
	public function tablecompanybranch() {
        $this->app->get_table_data('branch');
    }
	
	public function tablebank() {
        $this->app->get_table_data('bank');
    }
	public function tablepaymenttype() {
        $this->app->get_table_data('payment_type');
    }

    public function tablereceipt() {
        $this->app->get_table_data('receipt');
    }

    public function tablepaymentmethod() {
        $this->app->get_table_data('payment_method');
    }
	
    /* View all settings */
    public function index()
    {
		
        if (!has_permission('settings', '', 'view')) {
            access_denied('settings');
        }
        if ($this->input->post()) {
            if (!has_permission('settings', '', 'edit')) {
                access_denied('settings');
            }
            $logo_uploaded     = (handle_company_logo_upload() ? true : false);
            $favicon_uploaded  = (handle_favicon_upload() ? true : false);
            $signatureUploaded = (handle_company_signature_upload() ? true : false);

            $post_data = $this->input->post();
            $tmpData   = $this->input->post(null, false);

            if (isset($post_data['settings']['email_header'])) {
                $post_data['settings']['email_header'] = $tmpData['settings']['email_header'];
            }

            if (isset($post_data['settings']['email_footer'])) {
                $post_data['settings']['email_footer'] = $tmpData['settings']['email_footer'];
            }

            if (isset($post_data['settings']['email_signature'])) {
                $post_data['settings']['email_signature'] = $tmpData['settings']['email_signature'];
            }

            if (isset($post_data['settings']['smtp_password'])) {
                $post_data['settings']['smtp_password'] = $tmpData['settings']['smtp_password'];
            }

            $success = $this->settings_model->update($post_data);
            if ($success > 0) {
                set_alert('success', _l('settings_updated'));
            }

            if ($logo_uploaded || $favicon_uploaded) {
                set_debug_alert(_l('logo_favicon_changed_notice'));
            }

            // Do hard refresh on general for the logo
            if ($this->input->get('group') == 'general') {
                redirect(admin_url('settings?group=' . $this->input->get('group')), 'refresh');
            } elseif ($signatureUploaded) {
                redirect(admin_url('settings?group=pdf&tab=signature'));
            } else {
                redirect(admin_url('settings?group=' . $this->input->get('group')));
            }
        }

        $this->load->model('taxes_model');
        $this->load->model('tickets_model');
        $this->load->model('leads_model');
        $this->load->model('currencies_model');
		$this->load->model('Site_manager_model');
		$this->load->model('Staff_model');
		$data['staff_data'] = $this->Staff_model->get();
		
		
		$data['state_data'] = $this->Site_manager_model->get_state();
		$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
		 if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
        $data['taxes']                                   = $this->taxes_model->get();
        $data['ticket_priorities']                       = $this->tickets_model->get_priority();
        $data['ticket_priorities']['callback_translate'] = 'ticket_priority_translate';
        $data['roles']                                   = $this->roles_model->get();
        $data['leads_sources']                           = $this->leads_model->get_source();
        $data['leads_statuses']                          = $this->leads_model->get_status();
        $data['title']                                   = _l('options');
        if (!$this->input->get('group') || ($this->input->get('group') == 'update' && !is_admin())) {
            $view = 'general';
        } else {
            $view = $this->input->get('group');
        }

        $view = do_action('settings_group_view_name', $view);

        if ($view == 'update') {
            if (!extension_loaded('curl')) {
                $data['update_errors'][] = 'CURL Extension not enabled';
                $data['latest_version']  = 0;
                $data['update_info']     = json_decode('');
            } else {
                $data['update_info'] = $this->app->get_update_info();
                if (strpos($data['update_info'], 'Curl Error -') !== false) {
                    $data['update_errors'][] = $data['update_info'];
                    $data['latest_version']  = 0;
                    $data['update_info']     = json_decode('');
                } else {
                    $data['update_info']    = json_decode($data['update_info']);
                    $data['latest_version'] = $data['update_info']->latest_version;
                    $data['update_errors']  = [];
                }
            }

            if (!extension_loaded('zip')) {
                $data['update_errors'][] = 'ZIP Extension not enabled';
            }

            $data['current_version'] = $this->app->get_current_db_version();
        }

        $data['contacts_permissions'] = get_contact_permissions();
        $this->load->library('pdf');
        $data['payment_gateways'] = $this->payment_modes_model->get_online_payment_modes(true);
        $data['view_name']        = $view;
        $groups_path              = do_action('settings_groups_path', 'admin/settings/includes');
        $data['group_view']       = $this->load->view($groups_path . '/' . $view, $data, true);
		
		
        $this->load->view('admin/settings/all', $data);
    }

    public function delete_tag($id)
    {
        if (!$id) {
            redirect(admin_url('settings?group=tags'));
        }

        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }

        $this->db->where('id', $id);
        $this->db->delete('tbltags');
        $this->db->where('tag_id', $id);
        $this->db->delete('tbltags_in');

        redirect(admin_url('settings?group=tags'));
    }

    public function remove_signature_image()
    {
        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }

        $sImage = get_option('signature_image');
        if (file_exists(get_upload_path_by_type('company') . '/' . $sImage)) {
            unlink(get_upload_path_by_type('company') . '/' . $sImage);
        }

        update_option('signature_image', '');

        redirect(admin_url('settings?group=pdf&tab=signature'));
    }

    /* Remove company logo from settings / ajax */
    public function remove_company_logo($type = '')
    {
        do_action('before_remove_company_logo');

        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }

        $logoName = get_option('company_logo');
        if ($type == 'dark') {
            $logoName = get_option('company_logo_dark');
        }

        $path = get_upload_path_by_type('company') . '/' . $logoName;
        if (file_exists($path)) {
            unlink($path);
        }

        update_option('company_logo' . ($type == 'dark' ? '_dark' : ''), '');
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function remove_favicon()
    {
        do_action('before_remove_favicon');
        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }
        if (file_exists(get_upload_path_by_type('company') . '/' . get_option('favicon'))) {
            unlink(get_upload_path_by_type('company') . '/' . get_option('favicon'));
        }
        update_option('favicon', '');
        redirect($_SERVER['HTTP_REFERER']);
    }

	
	 public function deletewarehouse($id) {

        $success = $this->settings_model->delete($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('warehouse')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('settings?group=warehouselist'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('warehouse_lowercase')));
            redirect(admin_url('settings?group=warehouselist'));
        }
    }
	
	public function deletecompbranch($id) {

        $success = $this->settings_model->deletecompbranch($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('company_branch_lowercase')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('settings?group=branchlist'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('company_branch_lowercase')));
            redirect(admin_url('settings?group=branchlist'));
        }
    }
	
	public function deletebank($id) {

        $success = $this->settings_model->deletebank($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('bank')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('settings?group=banklist'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('bank_lowercase')));
            redirect(admin_url('settings?group=banklist'));
        }
    }
    
    public function deletepaymenttype($id) {

        $chk_paytype = $this->db->query("SELECT * FROM `tblbankmaster` WHERE `payment_type` = '" . $id . "'")->row();
        if (!empty($chk_paytype)) {
            set_alert('warning', "This payment type can't be deleted, its used somewhere.");
            redirect(admin_url('settings?group=paymenttypelist'));
        }
        
        $success = $this->settings_model->deletepaymenttype($id);
        if ($success) {
            set_alert('success', _l('deleted', "Payment Type"));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('settings?group=paymenttypelist'));
            }
        } else {
            set_alert('warning', "Something went Wrong");
            redirect(admin_url('settings?group=paymenttypelist'));
        }
    }

    public function delete_option($id)
    {
        if (!has_permission('settings', '', 'delete')) {
            access_denied('settings');
        }
        echo json_encode([
            'success' => delete_option($id),
        ]);
    }
	public function getstaffdet()
	{
		$staff_id=$this->input->post('staff_id');
		$this->db->where('staffid', $staff_id);
	    $staffdata= $this->db->get('tblstaff')->row();
		$staffdata= (array) $staffdata;
		echo json_encode(array('staff_email'=>$staffdata['email'],'staff_number'=>$staffdata['phonenumber'],'staff_designation'=>$staffdata['designation_id']));
	}

    /*public function get_notification_count(){
        echo get_approval_counts();
        // $get_approval_count = get_approval_counts();        
        // echo json_encode(array('approval_count'=>$get_approval_count));
    }*/
}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Vendors extends Admin_controller {

    private $not_importable_vendors_fields;
    public $pdf_zip;

    public function __construct() {
		
        parent::__construct();
		$this->load->model('Vendors_model');
        $this->not_importable_vendors_fields = do_action('not_importable_vendors_fields', ['userid', 'id', 'is_primary', 'password', 'datecreated', 'last_ip', 'last_login', 'last_password_change', 'active', 'new_pass_key', 'new_pass_key_requested', 'leadid', 'default_currency', 'profile_image', 'default_language', 'direction', 'show_primary_contact', 'invoice_emails', 'estimate_emails', 'project_emails', 'task_emails', 'contract_emails', 'credit_note_emails', 'ticket_emails', 'addedfrom', 'registration_confirmed', 'last_active_time']);
        // last_active_time is from Chattr plugin, causing issue
    }

    /* List all vendors */

    public function index() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $this->load->model('contracts_model');
        
        $data['contract_types'] = $this->contracts_model->get_contract_types();
        $data['groups'] = $this->Vendors_model->get_groups();
        $data['title'] = _l('vendors');

        $this->load->model('proposals_model');
        $data['proposal_statuses'] = $this->proposals_model->get_statuses();

        $this->load->model('invoices_model');
        $data['invoice_statuses'] = $this->invoices_model->get_statuses();

        $this->load->model('estimates_model');
        $data['estimate_statuses'] = $this->estimates_model->get_statuses();

        $this->load->model('projects_model');
        $data['project_statuses'] = $this->projects_model->get_project_statuses();

        $data['customer_admins'] = $this->Vendors_model->get_customers_admin_unique_ids();

        $whereContactsLoggedIn = '';
        if (!has_permission('customers', '', 'view')) {
           // $whereContactsLoggedIn = ' AND userid IN (SELECT customer_id FROM tblcustomeradmins WHERE staff_id=' . get_staff_user_id() . ')';
        }

        $data['contacts_logged_in_today'] = $this->Vendors_model->get_contacts('', 'last_login LIKE "' . date('Y-m-d') . '%"' . $whereContactsLoggedIn);

        $data['countries'] = $this->Vendors_model->get_vendors_distinct_countries();
        $this->load->view('admin/vendors/manage', $data);
    }

    public function table() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                ajax_access_denied();
            }
        }

        $this->app->get_table_data('vendors');
    }

	public function banktable($id='') {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                ajax_access_denied();
            }
        }
		$bankdata['bankdata']=$this->db->query("SELECT * FROM `tblvendorbank` WHERE `vendor_id`='".$id."'")->result_array();
        $this->app->get_table_data('vendorbank',$bankdata);
    }
	
	public function documentable($id='') {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                ajax_access_denied();
            }
        }
		$this->db->where('vendor_id', $id);
		$docdata['docdata']= $this->db->get('tblvendordocument')->result_array();
		//print_r($docdata);
        $this->app->get_table_data('vendordocument',$docdata);
    }
	
    public function all_contacts() {
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('all_vendor_contacts');
        }

        if (is_gdpr() && get_option('gdpr_enable_consent_for_contacts') == '1') {
            $this->load->model('gdpr_model');
            $data['consent_purposes'] = $this->gdpr_model->get_consent_purposes();
        }

        $data['title'] = _l('customer_contacts');
        $this->load->view('admin/vendors/all_contacts', $data);
    }

    /* Edit vendor or add new vendor */

    public function vendor($id = '') {
        if (!has_permission('customers', '', 'view')) {
            if ($id != '' && !is_customer_admin($id)) {
                access_denied('customers');
            }
        }

        if ($this->input->post() && !$this->input->is_ajax_request()) {
			$vendordata=$this->input->post();
			if(isset($vendordata['bankdetails']))
			{
				$bankid=$vendordata['bankdetails'];
				unset($vendordata['bankdetails']);
				$vendordata['vendor_id']=$id;
				$vendordata['created_at'] = date("Y-m-d H:i:s");
				$vendordata['updated_at'] = date("Y-m-d H:i:s");
				$vendordata['status']=1;
				if($bankid=='')
				{
					$this->db->insert('tblvendorbank', $vendordata);
					$insert_id=$this->db->insert_id();
					if ($insert_id) {
						set_alert('success', _l('added_successfully', _l('bank_details')));
						redirect(admin_url('vendors/vendor/' . $id . '?group=banklist'));
					}
				}
				else
				{
					$this->db->where('id', $bankid);
					$this->db->update('tblvendorbank', $vendordata);
					set_alert('success', _l('updated_successfully', _l('bank_details')));
					redirect(admin_url('vendors/vendor/' . $id . '?group=banklist'));
				}
				
				exit;
			}
			if(isset($vendordata['documents']))
			{
				$documentsid=$vendordata['documents'];
				$docdata['vendor_id']=$id;
				$docdata['created_at'] = date("Y-m-d H:i:s");
				$docdata['updated_at'] = date("Y-m-d H:i:s");
				$docdata['status']=1;
				if($documentsid=='')
				{
					$this->db->insert('tblvendordocument', $docdata);
					$insert_id=$this->db->insert_id();
					handle_pancard_upload($insert_id);
					handle_cancel_cheque_upload($insert_id);
					handle_gst_upload($insert_id);
					if ($insert_id) {
						set_alert('success', _l('added_successfully', _l('document')));
						redirect(admin_url('vendors/vendor/' . $id . '?group=documentlist'));
					}
				}
				else
				{
					$this->db->where('id', $documentsid);
					$this->db->update('tblvendordocument', $docdata);
					handle_pancard_upload($documentsid);
					handle_cancel_cheque_upload($documentsid);
					handle_gst_upload($documentsid);
					if ($documentsid) {
						set_alert('success', _l('updated_successfully', _l('document')));
						redirect(admin_url('vendors/vendor/' . $id . '?group=documentlist'));
					}
					
				}
				exit;
			}
            if ($id == '') {
				
                if (!has_permission('customers', '', 'create')) {
                    access_denied('customers');
                }

                $data = $this->input->post();

                $save_and_add_contact = false;
                if (isset($data['save_and_add_contact'])) {
                    unset($data['save_and_add_contact']);
                    $save_and_add_contact = true;
                }
                $id = $this->Vendors_model->add($data);
                if (!has_permission('customers', '', 'view')) {
                    $assign['customer_admins'] = [];
                    $assign['customer_admins'][] = get_staff_user_id();
                    $this->Vendors_model->assign_admins($assign, $id);
                }
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('vendor')));
                    if ($save_and_add_contact == false) {
                        redirect(admin_url('vendors/vendor/' . $id));
                    } else {
                        redirect(admin_url('vendors/vendor/' . $id . '?group=contacts&new_contact=true'));
                    }
                }
            } else {
                if (!has_permission('customers', '', 'edit')) {
                    if (!is_customer_admin($id)) {
                        access_denied('customers');
                    }
                }
                $success = $this->Vendors_model->update($this->input->post(), $id);
                if ($success == true) {
                    set_alert('success', _l('updated_successfully', _l('vendor')));
                }
                redirect(admin_url('vendors/vendor/' . $id));
            }
        }
		
        if (!$this->input->get('group')) {
            $group = 'profile';
        } else {
            $group = $this->input->get('group');
        }

        if ($group != 'contacts' && $contact_id = $this->input->get('contactid')) {
            redirect(admin_url('vendors/vendor/' . $id . '?group=contacts&contactid=' . $contact_id));
        }

        // View group
        $data['group'] = $group;
        // Customer groups
       // $data['groups'] = $this->Vendors_model->get_groups();

        if ($id == '') {
            $title = _l('add_new', _l('vendor_lowercase'));
        } else {
			
            $vendor = $this->Vendors_model->get($id);
			
            if (!$vendor) {
                blank_page('Vendor Not Found');
            }

            $data['contacts'] = $this->Vendors_model->get_contacts($id);

            // Fetch data based on groups
            if ($group == 'profile') {
                $data['customer_groups'] = $this->Vendors_model->get_customer_groups($id);
                $data['customer_admins'] = $this->Vendors_model->get_admins($id);
            } elseif ($group == 'attachments') {
                $data['attachments'] = get_all_customer_attachments($id);
            } elseif ($group == 'vault') {
                $data['vault_entries'] = do_action('check_vault_entries_visibility', $this->Vendors_model->get_vault_entries($id));
                if ($data['vault_entries'] === -1) {
                    $data['vault_entries'] = [];
                }
            } elseif ($group == 'estimates') {
                $this->load->model('estimates_model');
                $data['estimate_statuses'] = $this->estimates_model->get_statuses();
            } elseif ($group == 'invoices') {
                $this->load->model('invoices_model');
                $data['invoice_statuses'] = $this->invoices_model->get_statuses();
            } elseif ($group == 'credit_notes') {
                $this->load->model('credit_notes_model');
                $data['credit_notes_statuses'] = $this->credit_notes_model->get_statuses();
                $data['credits_available'] = $this->credit_notes_model->total_remaining_credits_by_customer($id);
            } elseif ($group == 'payments') {
                $this->load->model('payment_modes_model');
                $data['payment_modes'] = $this->payment_modes_model->get();
            } elseif ($group == 'notes') {
                $data['user_notes'] = $this->misc_model->get_vendor_notes($id, 'customer');
            } elseif ($group == 'projects') {
                $this->load->model('projects_model');
                $data['project_statuses'] = $this->projects_model->get_project_statuses();
            } elseif ($group == 'statement') {
                if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
                    set_alert('danger', _l('access_denied'));
                    redirect(admin_url('vendors/vendor/' . $id));
                }
                $contact = $this->Vendors_model->get_contact(get_primary_contact_user_id($id));
                $email = '';
                if ($contact) {
                    $email = $contact->email;
                }

                $template_name = 'vendor-statement';
                $data['template'] = get_email_template_for_sending($template_name, $email);

                $data['template_name'] = $template_name;
                $this->db->where('slug', $template_name);
                $this->db->where('language', 'english');
                $template_result = $this->db->get('tblemailtemplates')->row();

                $data['template_system_name'] = $template_result->name;
                $data['template_id'] = $template_result->emailtemplateid;

                $data['template_disabled'] = false;
                if (total_rows('tblemailtemplates', ['slug' => $data['template_name'], 'active' => 0]) > 0) {
                    $data['template_disabled'] = true;
                }
            }

            $data['staff'] = $this->staff_model->get('', ['active' => 1]);

            $data['vendor'] = $vendor;
            $title = $vendor->vendor_branch_name;

            // Get all active staff members (used to add reminder)
            $data['members'] = $data['staff'];

            if (!empty($data['vendor']->company)) {
                // Check if is realy empty vendor company so we can set this field to empty
                // The query where fetch the vendor auto populate firstname and lastname if company is empty
                if (is_empty_customer_company($data['vendor']->userid)) {
                    $data['vendor']->company = '';
                }
            }
        }

        $this->load->model('currencies_model');
        $data['currencies'] = $this->currencies_model->get();

        if ($id != '') {
            $customer_currency = $data['vendor']->default_currency;

            foreach ($data['currencies'] as $currency) {
                if ($customer_currency != 0) {
                    if ($currency['id'] == $customer_currency) {
                        $customer_currency = $currency;

                        break;
                    }
                } else {
                    if ($currency['isdefault'] == 1) {
                        $customer_currency = $currency;

                        break;
                    }
                }
            }

            if (is_array($customer_currency)) {
                $customer_currency = (object) $customer_currency;
            }

            $data['customer_currency'] = $customer_currency;
        }

        $data['bodyclass'] = 'customer-profile dynamic-create-groups';
        $data['title'] = $title;
		$this->load->model('Site_manager_model');
		$data['state_data'] = $this->Site_manager_model->get_state();
		$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
		 if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
		$this->load->model('Client_category_model');
		$data['vendor_category_data'] = $this->Client_category_model->get();
		$this->load->model('Vendor_model');
		//print_r($vendor_data);
		$data['vendor_data'] = $this->Vendor_model->get();
        $this->load->view('admin/vendors/vendor', $data);
    }

    public function export($contact_id) {
        if (is_admin()) {
            export_contact_data($contact_id);
        }
    }

    public function save_longitude_and_latitude($vendor_id) {
        if (!has_permission('customers', '', 'edit')) {
            if (!is_customer_admin($vendor_id)) {
                ajax_access_denied();
            }
        }

        $this->db->where('userid', $vendor_id);
        $this->db->update('tblvendors', [
            'longitude' => $this->input->post('longitude'),
            'latitude' => $this->input->post('latitude'),
        ]);
        if ($this->db->affected_rows() > 0) {
            echo 'success';
        } else {
            echo 'false';
        }
    }

    public function contact($customer_id, $contact_id = '') {
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin($customer_id)) {
                echo _l('access_denied');
                die;
            }
        }
        $data['customer_id'] = $customer_id;
        $data['contactid'] = $contact_id;
        if ($this->input->post()) {
            $data = $this->input->post();
			
            $data['password'] = $this->input->post('password', false);

            unset($data['contactid']);
            if ($contact_id == '') {
                if (!has_permission('customers', '', 'create')) {
                    if (!is_customer_admin($customer_id)) {
                        header('HTTP/1.0 400 Bad error');
                        echo json_encode([
                            'success' => false,
                            'message' => _l('access_denied'),
                        ]);
                        die;
                    }
                }
                $id = $this->Vendors_model->add_contact($data, $customer_id);
                $message = '';
                $success = false;
                if ($id) {
                    handle_contact_profile_image_upload($id);
                    $success = true;
                    $message = _l('added_successfully', _l('contact'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                    'has_primary_contact' => (total_rows('tblvendorcontacts', ['userid' => $customer_id, 'is_primary' => 1]) > 0 ? true : false),
                    'is_individual' => is_empty_customer_company($customer_id) && total_rows('tblvendorcontacts', ['userid' => $customer_id]) == 1,
                ]);
                die;
            }
            if (!has_permission('customers', '', 'edit')) {
                if (!is_customer_admin($customer_id)) {
                    header('HTTP/1.0 400 Bad error');
                    echo json_encode([
                        'success' => false,
                        'message' => _l('access_denied'),
                    ]);
                    die;
                }
            }
            $original_contact = $this->Vendors_model->get_contact($contact_id);
            $success = $this->Vendors_model->update_contact($data, $contact_id);
            $message = '';
            $proposal_warning = false;
            $original_email = '';
            $updated = false;
            if (is_array($success)) {
                if (isset($success['set_password_email_sent'])) {
                    $message = _l('set_password_email_sent_to_vendor');
                } elseif (isset($success['set_password_email_sent_and_profile_updated'])) {
                    $updated = true;
                    $message = _l('set_password_email_sent_to_vendor_and_profile_updated');
                }
            } else {
                if ($success == true) {
                    $updated = true;
                    $message = _l('updated_successfully', _l('contact'));
                }
            }
            if (handle_contact_profile_image_upload($contact_id) && !$updated) {
                $message = _l('updated_successfully', _l('contact'));
                $success = true;
            }
            if ($updated == true) {
                $contact = $this->Vendors_model->get_contact($contact_id);
                if (total_rows('tblproposals', [
                            'rel_type' => 'customer',
                            'rel_id' => $contact->userid,
                            'email' => $original_contact->email,
                        ]) > 0 && ($original_contact->email != $contact->email)) {
                    $proposal_warning = true;
                    $original_email = $original_contact->email;
                }
            }
            echo json_encode([
                'success' => $success,
                'proposal_warning' => $proposal_warning,
                'message' => $message,
                'original_email' => $original_email,
                'has_primary_contact' => (total_rows('tblvendorcontacts', ['userid' => $customer_id, 'is_primary' => 1]) > 0 ? true : false),
            ]);
            die;
        }
        if ($contact_id == '') {
            $title = _l('add_new', _l('contact_lowercase'));
        } else {
            $data['contact'] = $this->Vendors_model->get_contact($contact_id);

            if (!$data['contact']) {
                header('HTTP/1.0 400 Bad error');
                echo json_encode([
                    'success' => false,
                    'message' => 'Contact Not Found',
                ]);
                die;
            }
            $title = $data['contact']->firstname . ' ' . $data['contact']->lastname;
        }

		
		$this->load->model('Contact_type_model');
		$data['contact_type_data'] = $this->Contact_type_model->get();
		
		
        $data['customer_permissions'] = get_contact_permissions();
        $data['title'] = $title;
        $this->load->view('admin/vendors/modals/contact', $data);
    }

    public function confirm_registration($vendor_id) {
        if (!is_admin()) {
            access_denied('Customer Confirm Registration, ID: ' . $vendor_id);
        }
        $this->Vendors_model->confirm_registration($vendor_id);
        set_alert('success', _l('customer_registration_successfully_confirmed'));
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function update_file_share_visibility() {
        if ($this->input->post()) {
            $file_id = $this->input->post('file_id');
            $share_contacts_id = [];

            if ($this->input->post('share_contacts_id')) {
                $share_contacts_id = $this->input->post('share_contacts_id');
            }

            $this->db->where('file_id', $file_id);
            $this->db->delete('tblcustomerfiles_shares');

            foreach ($share_contacts_id as $share_contact_id) {
                $this->db->insert('tblcustomerfiles_shares', [
                    'file_id' => $file_id,
                    'contact_id' => $share_contact_id,
                ]);
            }
        }
    }

    public function delete_contact_profile_image($contact_id) {
        do_action('before_remove_contact_profile_image');
        if (file_exists(get_upload_path_by_type('contact_profile_images') . $contact_id)) {
            delete_dir(get_upload_path_by_type('contact_profile_images') . $contact_id);
        }
        $this->db->where('id', $contact_id);
        $this->db->update('tblvendorcontacts', [
            'profile_image' => null,
        ]);
    }

    public function mark_as_active($id) {
        $this->db->where('userid', $id);
        $this->db->update('tblvendors', [
            'active' => 1,
        ]);
        redirect(admin_url('vendors/vendor/' . $id));
    }

    public function consents($id) {
        if (!has_permission('customers', '', 'view')) {
            if (!is_customer_admin(get_user_id_by_contact_id($id))) {
                echo _l('access_denied');
                die;
            }
        }

        $this->load->model('gdpr_model');
        $data['purposes'] = $this->gdpr_model->get_consent_purposes($id, 'contact');
        $data['consents'] = $this->gdpr_model->get_consents(['contact_id' => $id]);
        $data['contact_id'] = $id;
        $this->load->view('admin/gdpr/contact_consent', $data);
    }

    public function update_all_proposal_emails_linked_to_customer($contact_id) {
        $success = false;
        $email = '';
        if ($this->input->post('update')) {
            $this->load->model('proposals_model');

            $this->db->select('email,userid');
            $this->db->where('id', $contact_id);
            $contact = $this->db->get('tblvendorcontacts')->row();

            $proposals = $this->proposals_model->get('', [
                'rel_type' => 'customer',
                'rel_id' => $contact->userid,
                'email' => $this->input->post('original_email'),
            ]);
            $affected_rows = 0;

            foreach ($proposals as $proposal) {
                $this->db->where('id', $proposal['id']);
                $this->db->update('tblproposals', [
                    'email' => $contact->email,
                ]);
                if ($this->db->affected_rows() > 0) {
                    $affected_rows++;
                }
            }

            if ($affected_rows > 0) {
                $success = true;
            }
        }
        echo json_encode([
            'success' => $success,
            'message' => _l('proposals_emails_updated', [
                _l('contact_lowercase'),
                $contact->email,
            ]),
        ]);
    }

    public function assign_admins($id) {
        if (!has_permission('customers', '', 'create') && !has_permission('customers', '', 'edit')) {
            access_denied('customers');
        }
        $success = $this->Vendors_model->assign_admins($this->input->post(), $id);
        if ($success == true) {
            set_alert('success', _l('updated_successfully', _l('vendor')));
        }

        redirect(admin_url('vendors/vendor/' . $id . '?tab=customer_admins'));
    }

    public function delete_customer_admin($customer_id, $staff_id) {
        if (!has_permission('customers', '', 'create') && !has_permission('customers', '', 'edit')) {
            access_denied('customers');
        }

        $this->db->where('customer_id', $customer_id);
        $this->db->where('staff_id', $staff_id);
        $this->db->delete('tblcustomeradmins');
        redirect(admin_url('vendors/vendor/' . $customer_id) . '?tab=customer_admins');
    }

    public function delete_contact($customer_id, $id) {
        if (!has_permission('customers', '', 'delete')) {
            if (!is_customer_admin($customer_id)) {
                access_denied('customers');
            }
        }
        $contact = $this->Vendors_model->get_contact($id);
        $hasProposals = false;
        if ($contact && is_gdpr()) {
            if (total_rows('tblproposals', ['email' => $contact->email]) > 0) {
                $hasProposals = true;
            }
        }

        $this->Vendors_model->delete_contact($id);
        if ($hasProposals) {
            $this->session->set_flashdata('gdpr_delete_warning', true);
        }
        redirect(admin_url('vendors/vendor/' . $customer_id . '?group=contacts'));
    }

    public function contacts($vendor_id) {
        $this->app->get_table_data('vendorcontacts', [
            'client_id' => $vendor_id,
        ]);
    }

    public function upload_attachment($id) {
        handle_vendor_attachments_upload($id);
    }

    public function add_external_attachment() {
        if ($this->input->post()) {
            $this->misc_model->add_attachment_to_database($this->input->post('vendorid'), 'customer', $this->input->post('files'), $this->input->post('external'));
        }
    }

    public function delete_attachment($customer_id, $id) {
        if (has_permission('customers', '', 'delete') || is_customer_admin($customer_id)) {
            $this->Vendors_model->delete_attachment($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    /* Delete vendor */

    public function delete($id) {
        if (!has_permission('customers', '', 'delete')) {
            access_denied('customers');
        }
        if (!$id) {
            redirect(admin_url('vendors'));
        }
		
        $response = $this->Vendors_model->delete($id);
        if (is_array($response) && isset($response['referenced'])) {
            set_alert('warning', _l('customer_delete_transactions_warning', _l('invoices') . ', ' . _l('estimates') . ', ' . _l('credit_notes')));
        } elseif ($response == true) {
            set_alert('success', _l('deleted', _l('vendor')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('vendor_lowercase')));
        }
        redirect(admin_url('vendors'));
    }

    /* Staff can login as vendor */

    public function login_as_vendor($id) {
        if (is_admin()) {
            login_as_vendor($id);
        }
        do_action('after_contact_login');
        redirect(site_url());
    }

    public function get_customer_billing_and_shipping_details($id) {
        echo json_encode($this->Vendors_model->get_customer_billing_and_shipping_details($id));
    }

    /* Change vendor status / active / inactive */

    public function change_contact_status($id, $status) {
        if (has_permission('customers', '', 'edit') || is_customer_admin(get_user_id_by_contact_id($id))) {
            if ($this->input->is_ajax_request()) {
                $this->Vendors_model->change_contact_status($id, $status);
            }
        }
    }

    /* Change vendor status / active / inactive */

    public function change_vendor_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            $this->Vendors_model->change_vendor_status($id, $status);
        }
    }

    /* Zip function for credit notes */

    public function zip_credit_notes($id) {
        $has_permission_view = has_permission('credit_notes', '', 'view');

        if (!$has_permission_view && !has_permission('credit_notes', '', 'view_own')) {
            access_denied('Zip Customer Credit Notes');
        }

        if ($this->input->post()) {
            $status = $this->input->post('credit_note_zip_status');
            $zip_file_name = $this->input->post('file_name');
            if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
                $from_date = to_sql_date($this->input->post('zip-from'));
                $to_date = to_sql_date($this->input->post('zip-to'));
                if ($from_date == $to_date) {
                    $this->db->where('date', $from_date);
                } else {
                    $this->db->where('date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
                }
            }
            $this->db->select('id');
            $this->db->from('tblcreditnotes');
            if ($status != 'all') {
                $this->db->where('status', $status);
            }
            $this->db->where('vendorid', $id);
            $this->db->order_by('number', 'desc');

            if (!$has_permission_view) {
                $this->db->where('addedfrom', get_staff_user_id());
            }
            $credit_notes = $this->db->get()->result_array();

            $this->load->model('credit_notes_model');

            $this->load->helper('file');
            if (!is_really_writable(TEMP_FOLDER)) {
                show_error('/temp folder is not writable. You need to change the permissions to 755');
            }

            $dir = TEMP_FOLDER . $zip_file_name;

            if (is_dir($dir)) {
                delete_dir($dir);
            }

            if (count($credit_notes) == 0) {
                set_alert('warning', _l('vendor_zip_no_data_found', _l('credit_notes')));
                redirect(admin_url('vendors/vendor/' . $id . '?group=credit_notes'));
            }

            mkdir($dir, 0777);

            foreach ($credit_notes as $credit_note) {
                $credit_note = $this->credit_notes_model->get($credit_note['id']);
                $this->pdf_zip = credit_note_pdf($credit_note);
                $_temp_file_name = slug_it(format_credit_note_number($credit_note->id));
                $file_name = $dir . '/' . strtoupper($_temp_file_name);
                $this->pdf_zip->Output($file_name . '.pdf', 'F');
            }

            $this->load->library('zip');
            // Read the credit notes
            $this->zip->read_dir($dir, false);
            // Delete the temp directory for the vendor
            delete_dir($dir);
            $this->zip->download(slug_it(get_option('companyname')) . '-credit-notes-' . $zip_file_name . '.zip');
            $this->zip->clear_data();
        }
    }

    public function zip_invoices($id) {
        $has_permission_view = has_permission('invoices', '', 'view');
        if (!$has_permission_view && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            access_denied('Zip Customer Invoices');
        }
        if ($this->input->post()) {
            $status = $this->input->post('invoice_zip_status');
            $zip_file_name = $this->input->post('file_name');
            if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
                $from_date = to_sql_date($this->input->post('zip-from'));
                $to_date = to_sql_date($this->input->post('zip-to'));
                if ($from_date == $to_date) {
                    $this->db->where('date', $from_date);
                } else {
                    $this->db->where('date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
                }
            }
            $this->db->select('id');
            $this->db->from('tblinvoices');
            if ($status != 'all') {
                $this->db->where('status', $status);
            }
            $this->db->where('vendorid', $id);
            $this->db->order_by('number,YEAR(date)', 'desc');

            if (!$has_permission_view) {
                $this->db->where(get_invoices_where_sql_for_staff(get_staff_user_id()));
            }

            $invoices = $this->db->get()->result_array();
            $this->load->model('invoices_model');
            $this->load->helper('file');
            if (!is_really_writable(TEMP_FOLDER)) {
                show_error('/temp folder is not writable. You need to change the permissions to 755');
            }
            $dir = TEMP_FOLDER . $zip_file_name;
            if (is_dir($dir)) {
                delete_dir($dir);
            }
            if (count($invoices) == 0) {
                set_alert('warning', _l('vendor_zip_no_data_found', _l('invoices')));
                redirect(admin_url('vendors/vendor/' . $id . '?group=invoices'));
            }
            mkdir($dir, 0777);
            foreach ($invoices as $invoice) {
                $invoice_data = $this->invoices_model->get($invoice['id']);
                $this->pdf_zip = invoice_pdf($invoice_data);
                $_temp_file_name = slug_it(format_invoice_number($invoice_data->id));
                $file_name = $dir . '/' . strtoupper($_temp_file_name);
                $this->pdf_zip->Output($file_name . '.pdf', 'F');
            }
            $this->load->library('zip');
            // Read the invoices
            $this->zip->read_dir($dir, false);
            // Delete the temp directory for the vendor
            delete_dir($dir);
            $this->zip->download(slug_it(get_option('companyname')) . '-invoices-' . $zip_file_name . '.zip');
            $this->zip->clear_data();
        }
    }

    /* Since version 1.0.2 zip vendor invoices */

    public function zip_estimates($id) {
        $has_permission_view = has_permission('estimates', '', 'view');
        if (!$has_permission_view && !has_permission('estimates', '', 'view_own') && get_option('allow_staff_view_estimates_assigned') == '0') {
            access_denied('Zip Customer Estimates');
        }

        if ($this->input->post()) {
            $status = $this->input->post('estimate_zip_status');
            $zip_file_name = $this->input->post('file_name');
            if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
                $from_date = to_sql_date($this->input->post('zip-from'));
                $to_date = to_sql_date($this->input->post('zip-to'));
                if ($from_date == $to_date) {
                    $this->db->where('date', $from_date);
                } else {
                    $this->db->where('date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
                }
            }
            $this->db->select('id');
            $this->db->from('tblestimates');
            if ($status != 'all') {
                $this->db->where('status', $status);
            }
            if (!$has_permission_view) {
                $this->db->where(get_estimates_where_sql_for_staff(get_staff_user_id()));
            }
            $this->db->where('vendorid', $id);
            $this->db->order_by('number,YEAR(date)', 'desc');
            $estimates = $this->db->get()->result_array();
            $this->load->helper('file');
            if (!is_really_writable(TEMP_FOLDER)) {
                show_error('/temp folder is not writable. You need to change the permissions to 777');
            }
            $this->load->model('estimates_model');
            $dir = TEMP_FOLDER . $zip_file_name;
            if (is_dir($dir)) {
                delete_dir($dir);
            }
            if (count($estimates) == 0) {
                set_alert('warning', _l('vendor_zip_no_data_found', _l('estimates')));
                redirect(admin_url('vendors/vendor/' . $id . '?group=estimates'));
            }
            mkdir($dir, 0777);
            foreach ($estimates as $estimate) {
                $estimate_data = $this->estimates_model->get($estimate['id']);
                $this->pdf_zip = estimate_pdf($estimate_data);
                $_temp_file_name = slug_it(format_estimate_number($estimate_data->id));
                $file_name = $dir . '/' . strtoupper($_temp_file_name);
                $this->pdf_zip->Output($file_name . '.pdf', 'F');
            }
            $this->load->library('zip');
            // Read the invoices
            $this->zip->read_dir($dir, false);
            // Delete the temp directory for the vendor
            delete_dir($dir);
            $this->zip->download(slug_it(get_option('companyname')) . '-estimates-' . $zip_file_name . '.zip');
            $this->zip->clear_data();
        }
    }

    public function zip_payments($id) {
        if (!$id) {
            die('Invoice ID not passed');
        }

        $has_permission_view = has_permission('payments', '', 'view');
        if (!$has_permission_view && !has_permission('invoices', '', 'view_own') && get_option('allow_staff_view_invoices_assigned') == '0') {
            access_denied('Zip Customer Payments');
        }

        if ($this->input->post('zip-to') && $this->input->post('zip-from')) {
            $from_date = to_sql_date($this->input->post('zip-from'));
            $to_date = to_sql_date($this->input->post('zip-to'));
            if ($from_date == $to_date) {
                $this->db->where('tblinvoicepaymentrecords.date', $from_date);
            } else {
                $this->db->where('tblinvoicepaymentrecords.date BETWEEN "' . $from_date . '" AND "' . $to_date . '"');
            }
        }
        $this->db->select('tblinvoicepaymentrecords.id as paymentid');
        $this->db->from('tblinvoicepaymentrecords');
        $this->db->where('tblvendors.userid', $id);
        if (!$has_permission_view) {
            $whereUser = '';
            $whereUser .= '(invoiceid IN (SELECT id FROM tblinvoices WHERE addedfrom=' . get_staff_user_id() . ')';
            if (get_option('allow_staff_view_invoices_assigned') == 1) {
                $whereUser .= ' OR invoiceid IN (SELECT id FROM tblinvoices WHERE sale_agent=' . get_staff_user_id() . ')';
            }
            $whereUser .= ')';
            $this->db->where($whereUser);
        }
        $this->db->join('tblinvoices', 'tblinvoices.id = tblinvoicepaymentrecords.invoiceid', 'left');
        $this->db->join('tblvendors', 'tblvendors.userid = tblinvoices.vendorid', 'left');
        if ($this->input->post('paymentmode')) {
            $this->db->where('paymentmode', $this->input->post('paymentmode'));
        }
        $payments = $this->db->get()->result_array();
        $zip_file_name = $this->input->post('file_name');
        $this->load->helper('file');
        if (!is_really_writable(TEMP_FOLDER)) {
            show_error('/temp folder is not writable. You need to change the permissions to 777');
        }
        $dir = TEMP_FOLDER . $zip_file_name;
        if (is_dir($dir)) {
            delete_dir($dir);
        }
        if (count($payments) == 0) {
            set_alert('warning', _l('vendor_zip_no_data_found', _l('payments')));
            redirect(admin_url('vendors/vendor/' . $id . '?group=payments'));
        }
        mkdir($dir, 0777);
        $this->load->model('payments_model');
        $this->load->model('invoices_model');
        foreach ($payments as $payment) {
            $payment_data = $this->payments_model->get($payment['paymentid']);
            $payment_data->invoice_data = $this->invoices_model->get($payment_data->invoiceid);
            $this->pdf_zip = payment_pdf($payment_data);
            $file_name = $dir;
            $file_name .= '/' . strtoupper(_l('payment'));
            $file_name .= '-' . strtoupper($payment_data->paymentid) . '.pdf';
            $this->pdf_zip->Output($file_name, 'F');
        }
        $this->load->library('zip');
        // Read the invoices
        $this->zip->read_dir($dir, false);
        // Delete the temp directory for the vendor
        delete_dir($dir);
        $this->zip->download(slug_it(get_option('companyname')) . '-payments-' . $zip_file_name . '.zip');
        $this->zip->clear_data();
    }

    public function import() {
        if (!has_permission('customers', '', 'create')) {
            access_denied('customers');
        }
        $country_fields = ['country', 'billing_country', 'shipping_country'];

        $simulate_data = [];
        $total_imported = 0;
        if ($this->input->post()) {

            // Used when checking existing company to merge contact
            $contactFields = $this->db->list_fields('tblvendorcontacts');

            if (isset($_FILES['file_csv']['name']) && $_FILES['file_csv']['name'] != '') {
                // Get the temp file path
                $tmpFilePath = $_FILES['file_csv']['tmp_name'];
                // Make sure we have a filepath
                if (!empty($tmpFilePath) && $tmpFilePath != '') {
                    // Setup our new file path
                    $newFilePath = TEMP_FOLDER . $_FILES['file_csv']['name'];
                    if (!file_exists(TEMP_FOLDER)) {
                        mkdir(TEMP_FOLDER, 777);
                    }
                    if (move_uploaded_file($tmpFilePath, $newFilePath)) {
                        $import_result = true;
                        $fd = fopen($newFilePath, 'r');
                        $rows = [];
                        while ($row = fgetcsv($fd)) {
                            $rows[] = $row;
                        }

                        $data['total_rows_post'] = count($rows);
                        fclose($fd);
                        if (count($rows) <= 1) {
                            set_alert('warning', 'Not enought rows for importing');
                            redirect(admin_url('vendors/import'));
                        }
                        unset($rows[0]);
                        if ($this->input->post('simulate')) {
                            if (count($rows) > 500) {
                                set_alert('warning', 'Recommended splitting the CSV file into smaller files. Our recomendation is 500 row, your CSV file has ' . count($rows));
                            }
                        }
                        $vendor_contacts_fields = $this->db->list_fields('tblvendorcontacts');
                        $i = 0;
                        foreach ($vendor_contacts_fields as $cf) {
                            if ($cf == 'phonenumber') {
                                $vendor_contacts_fields[$i] = 'contact_phonenumber';
                            }
                            $i++;
                        }
                        $db_temp_fields = $this->db->list_fields('tblvendors');
                        $db_temp_fields = array_merge($vendor_contacts_fields, $db_temp_fields);
                        $db_fields = [];
                        foreach ($db_temp_fields as $field) {
                            if (in_array($field, $this->not_importable_vendors_fields)) {
                                continue;
                            }
                            $db_fields[] = $field;
                        }
                        $custom_fields = get_custom_fields('customers');
                        $_row_simulate = 0;

                        $required = [
                            'firstname',
                            'lastname',
                            'email',
                        ];

                        if (get_option('company_is_required') == 1) {
                            array_push($required, 'company');
                        }

                        foreach ($rows as $row) {
                            // do for db fields
                            $insert = [];
                            $duplicate = false;
                            for ($i = 0; $i < count($db_fields); $i++) {
                                if (!isset($row[$i])) {
                                    continue;
                                }
                                if ($db_fields[$i] == 'email') {
                                    $email_exists = total_rows('tblvendorcontacts', [
                                        'email' => $row[$i],
                                    ]);
                                    // don't insert duplicate emails
                                    if ($email_exists > 0) {
                                        $duplicate = true;
                                    }
                                }
                                // Avoid errors on required fields;
                                if (in_array($db_fields[$i], $required) && $row[$i] == '' && $db_fields[$i] != 'company') {
                                    $row[$i] = '/';
                                } elseif (in_array($db_fields[$i], $country_fields)) {
                                    if ($row[$i] != '') {
                                        if (!is_numeric($row[$i])) {
                                            $this->db->where('iso2', $row[$i]);
                                            $this->db->or_where('short_name', $row[$i]);
                                            $this->db->or_where('long_name', $row[$i]);
                                            $country = $this->db->get('tblcountries')->row();
                                            if ($country) {
                                                $row[$i] = $country->country_id;
                                            } else {
                                                $row[$i] = 0;
                                            }
                                        }
                                    } else {
                                        $row[$i] = 0;
                                    }
                                }
                                if ($row[$i] === 'NULL' || $row[$i] === 'null') {
                                    $row[$i] = '';
                                }
                                $insert[$db_fields[$i]] = $row[$i];
                            }


                            if ($duplicate == true) {
                                continue;
                            }
                            if (count($insert) > 0) {
                                $total_imported++;
                                $insert['datecreated'] = date('Y-m-d H:i:s');
                                if ($this->input->post('default_pass_all')) {
                                    $insert['password'] = $this->input->post('default_pass_all', false);
                                }
                                if (!$this->input->post('simulate')) {
                                    $insert['donotsendwelcomeemail'] = true;
                                    foreach ($insert as $key => $val) {
                                        $insert[$key] = trim($val);
                                    }

                                    if (isset($insert['company']) && $insert['company'] != '' && $insert['company'] != '/') {
                                        if (total_rows('tblvendors', ['company' => $insert['company']]) === 1) {
                                            $this->db->where('company', $insert['company']);
                                            $existingCompany = $this->db->get('tblvendors')->row();
                                            $tmpInsert = [];

                                            foreach ($insert as $key => $val) {
                                                foreach ($contactFields as $tmpContactField) {
                                                    if (isset($insert[$tmpContactField])) {
                                                        $tmpInsert[$tmpContactField] = $insert[$tmpContactField];
                                                    }
                                                }
                                            }
                                            $tmpInsert['donotsendwelcomeemail'] = true;
                                            if (isset($insert['contact_phonenumber'])) {
                                                $tmpInsert['phonenumber'] = $insert['contact_phonenumber'];
                                            }

                                            $contactid = $this->Vendors_model->add_contact($tmpInsert, $existingCompany->userid, true);

                                            continue;
                                        }
                                    }
                                    $insert['is_primary'] = 1;

                                    $vendorid = $this->Vendors_model->add($insert, true);
                                    if ($vendorid) {
                                        if ($this->input->post('groups_in[]')) {
                                            $groups_in = $this->input->post('groups_in[]');
                                            foreach ($groups_in as $group) {
                                                $this->db->insert('tblcustomergroups_in', [
                                                    'customer_id' => $vendorid,
                                                    'groupid' => $group,
                                                ]);
                                            }
                                        }
                                        if (!has_permission('customers', '', 'view')) {
                                            $assign['customer_admins'] = [];
                                            $assign['customer_admins'][] = get_staff_user_id();
                                            $this->Vendors_model->assign_admins($assign, $vendorid);
                                        }
                                    }
                                } else {
                                    foreach ($country_fields as $country_field) {
                                        if (array_key_exists($country_field, $insert)) {
                                            if ($insert[$country_field] != 0) {
                                                $c = get_country($insert[$country_field]);
                                                if ($c) {
                                                    $insert[$country_field] = $c->short_name;
                                                }
                                            } elseif ($insert[$country_field] == 0) {
                                                $insert[$country_field] = '';
                                            }
                                        }
                                    }
                                    $simulate_data[$_row_simulate] = $insert;
                                    $vendorid = true;
                                }
                                if ($vendorid) {
                                    $insert = [];
                                    foreach ($custom_fields as $field) {
                                        if (!$this->input->post('simulate')) {
                                            if ($row[$i] != '' && $row[$i] !== 'NULL' && $row[$i] !== 'null') {
                                                $this->db->insert('tblcustomfieldsvalues', [
                                                    'relid' => $vendorid,
                                                    'fieldid' => $field['id'],
                                                    'value' => $row[$i],
                                                    'fieldto' => 'customers',
                                                ]);
                                            }
                                        } else {
                                            $simulate_data[$_row_simulate][$field['name']] = $row[$i];
                                        }
                                        $i++;
                                    }
                                }
                            }
                            $_row_simulate++;
                            if ($this->input->post('simulate') && $_row_simulate >= 100) {
                                break;
                            }
                        }
                        unlink($newFilePath);
                    }
                } else {
                    set_alert('warning', _l('import_upload_failed'));
                }
            }
        }
        if (count($simulate_data) > 0) {
            $data['simulate'] = $simulate_data;
        }
        if (isset($import_result)) {
            set_alert('success', _l('import_total_imported', $total_imported));
        }
        $data['groups'] = $this->Vendors_model->get_groups();
        $data['not_importable'] = $this->not_importable_vendors_fields;
        $data['title'] = _l('import');
        $data['bodyclass'] = 'dynamic-create-groups';
        $this->load->view('admin/vendors/import', $data);
    }

    public function groups() {
        if (!is_admin()) {
            access_denied('Customer Groups');
        }
        if ($this->input->is_ajax_request()) {
            $this->app->get_table_data('customers_groups');
        }
        $data['title'] = _l('customer_groups');
        $this->load->view('admin/vendors/groups_manage', $data);
    }

    public function group() {
        if (!is_admin() && get_option('staff_members_create_inline_customer_groups') == '0') {
            access_denied('Customer Groups');
        }

        if ($this->input->is_ajax_request()) {
            $data = $this->input->post();
            if ($data['id'] == '') {
                $id = $this->Vendors_model->add_group($data);
                $message = $id ? _l('added_successfully', _l('customer_group')) : '';
                echo json_encode([
                    'success' => $id ? true : false,
                    'message' => $message,
                    'id' => $id,
                    'name' => $data['name'],
                ]);
            } else {
                $success = $this->Vendors_model->edit_group($data);
                $message = '';
                if ($success == true) {
                    $message = _l('updated_successfully', _l('customer_group'));
                }
                echo json_encode([
                    'success' => $success,
                    'message' => $message,
                ]);
            }
        }
    }

    public function delete_group($id) {
        if (!is_admin()) {
            access_denied('Delete Customer Group');
        }
        if (!$id) {
            redirect(admin_url('vendors/groups'));
        }
        $response = $this->Vendors_model->delete_group($id);
        if ($response == true) {
            set_alert('success', _l('deleted', _l('customer_group')));
        } else {
            set_alert('warning', _l('problem_deleting', _l('customer_group_lowercase')));
        }
        redirect(admin_url('vendors/groups'));
    }

    public function bulk_action() {
        do_action('before_do_bulk_action_for_customers');
        $total_deleted = 0;
        if ($this->input->post()) {
            $ids = $this->input->post('ids');
            $groups = $this->input->post('groups');

            if (is_array($ids)) {
                foreach ($ids as $id) {
                    if ($this->input->post('mass_delete')) {
                        if ($this->Vendors_model->delete($id)) {
                            $total_deleted++;
                        }
                    } else {
                        if (!is_array($groups)) {
                            $groups = false;
                        }
                        $this->vendor_groups_model->sync_customer_groups($id, $groups);
                    }
                }
            }
        }

        if ($this->input->post('mass_delete')) {
            set_alert('success', _l('total_vendors_deleted', $total_deleted));
        }
    }

    public function vault_entry_create($customer_id) {
        $data = $this->input->post();

        if (isset($data['fakeusernameremembered'])) {
            unset($data['fakeusernameremembered']);
        }

        if (isset($data['fakepasswordremembered'])) {
            unset($data['fakepasswordremembered']);
        }

        unset($data['id']);
        $data['creator'] = get_staff_user_id();
        $data['creator_name'] = get_staff_full_name($data['creator']);
        $data['description'] = nl2br($data['description']);
        $data['password'] = $this->encryption->encrypt($this->input->post('password', false));

        if (empty($data['port'])) {
            unset($data['port']);
        }

        $this->Vendors_model->vault_entry_create($data, $customer_id);
        set_alert('success', _l('added_successfully', _l('vault_entry')));
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function vault_entry_update($entry_id) {
        $entry = $this->Vendors_model->get_vault_entry($entry_id);

        if ($entry->creator == get_staff_user_id() || is_admin()) {
            $data = $this->input->post();

            if (isset($data['fakeusernameremembered'])) {
                unset($data['fakeusernameremembered']);
            }
            if (isset($data['fakepasswordremembered'])) {
                unset($data['fakepasswordremembered']);
            }

            $data['last_updated_from'] = get_staff_full_name(get_staff_user_id());
            $data['description'] = nl2br($data['description']);

            if (!empty($data['password'])) {
                $data['password'] = $this->encryption->encrypt($this->input->post('password', false));
            } else {
                unset($data['password']);
            }

            if (empty($data['port'])) {
                unset($data['port']);
            }

            $this->Vendors_model->vault_entry_update($entry_id, $data);
            set_alert('success', _l('updated_successfully', _l('vault_entry')));
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function vault_entry_delete($id) {
        $entry = $this->Vendors_model->get_vault_entry($id);
        if ($entry->creator == get_staff_user_id() || is_admin()) {
            $this->Vendors_model->vault_entry_delete($id);
        }
        redirect($_SERVER['HTTP_REFERER']);
    }

    public function vault_encrypt_password() {
        $id = $this->input->post('id');
        $user_password = $this->input->post('user_password', false);
        $user = $this->staff_model->get(get_staff_user_id());

        $this->load->helper('phpass');

        $hasher = new PasswordHash(PHPASS_HASH_STRENGTH, PHPASS_HASH_PORTABLE);
        if (!$hasher->CheckPassword($user_password, $user->password)) {
            header('HTTP/1.1 401 Unauthorized');
            echo json_encode(['error_msg' => _l('vault_password_user_not_correct')]);
            die;
        }

        $vault = $this->Vendors_model->get_vault_entry($id);
        $password = $this->encryption->decrypt($vault->password);

        $password = html_escape($password);

        // Failed to decrypt
        if (!$password) {
            header('HTTP/1.0 400 Bad error');
            echo json_encode(['error_msg' => _l('failed_to_decrypt_password')]);
            die;
        }

        echo json_encode(['password' => $password]);
    }

    public function get_vault_entry($id) {
        $entry = $this->Vendors_model->get_vault_entry($id);
        unset($entry->password);
        $entry->description = clear_textarea_breaks($entry->description);
        echo json_encode($entry);
    }

    public function statement_pdf() {
        $customer_id = $this->input->get('customer_id');

        if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('vendors/vendor/' . $customer_id));
        }

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data['statement'] = $this->Vendors_model->get_statement($customer_id, to_sql_date($from), to_sql_date($to));

        try {
            $pdf = statement_pdf($data['statement']);
        } catch (Exception $e) {
            $message = $e->getMessage();
            echo $message;
            if (strpos($message, 'Unable to get the size of the image') !== false) {
                show_pdf_unable_to_get_image_size_error();
            }
            die;
        }

        $type = 'D';
        if ($this->input->get('print')) {
            $type = 'I';
        }

        $pdf->Output(slug_it(_l('customer_statement') . '-' . $data['statement']['vendor']->company) . '.pdf', $type);
    }

    public function send_statement() {
        $customer_id = $this->input->get('customer_id');

        if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
            set_alert('danger', _l('access_denied'));
            redirect(admin_url('vendors/vendor/' . $customer_id));
        }

        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $send_to = $this->input->post('send_to');
        $cc = $this->input->post('cc');

        $success = $this->Vendors_model->send_statement_to_email($customer_id, $send_to, $from, $to, $cc);
        // In case vendor use another language
        load_admin_language();
        if ($success) {
            set_alert('success', _l('statement_sent_to_vendor_success'));
        } else {
            set_alert('danger', _l('statement_sent_to_vendor_fail'));
        }

        redirect(admin_url('vendors/vendor/' . $customer_id . '?group=statement'));
    }

    public function statement() {
        if (!has_permission('invoices', '', 'view') && !has_permission('payments', '', 'view')) {
            header('HTTP/1.0 400 Bad error');
            echo _l('access_denied');
            die;
        }

        $customer_id = $this->input->get('customer_id');
        $from = $this->input->get('from');
        $to = $this->input->get('to');

        $data['statement'] = $this->Vendors_model->get_statement($customer_id, to_sql_date($from), to_sql_date($to));

        $data['from'] = $from;
        $data['to'] = $to;

        $viewData['html'] = $this->load->view('admin/vendors/groups/_statement', $data, true);

        echo json_encode($viewData);
    }
	public function deletebank($id,$vendorid) {

        $success = $this->Vendors_model->deletebank($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('bank')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('vendors/vendor/'.$vendorid.'?group=banklist'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('bank_lowercase')));
            redirect(admin_url('settings?group=banklist'));
        }
    }
	
	public function deletedocument($id,$vendorid) {

        $success = $this->Vendors_model->deletedocument($id);
		
        if ($success) {
            set_alert('success', _l('deleted', _l('document')));
            if (strpos($_SERVER['HTTP_REFERER'], 'client/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('vendors/vendor/'.$vendorid.'?group=documentlist'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('document')));
            redirect(admin_url('settings?group=documentlist'));
        }
    }

}

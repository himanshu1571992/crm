<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Enquiry extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Enquiry_model');
    }

    /* List all enquiry*/

    public function index() {
        if (!has_permission('customers', '', 'view')) {
            if (!have_assigned_customers() && !has_permission('customers', '', 'create')) {
                access_denied('customers');
            }
        }

        $data['unit_data'] = $this->Enquiry_model->get();

        $this->load->view('admin/enquiry/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('enquiry');
    }

    public function enquiry($id = '') {
        if ($this->input->post()) {
            $unit_data = $this->input->post();
            if ($id == '') {

                $id = $this->Enquiry_model->add($unit_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('enquiry')));
                    redirect(admin_url('enquiry'));
                }
            } else {

                $success = $this->Enquiry_model->edit($unit_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('enquiry')));
                }

                redirect(admin_url('enquiry'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('enquiry_lowercase'));
        } else {
            $data['unit'] = (array) $this->Enquiry_model->get($id);
            $title = _l('edit', _l('enquiry_lowercase'));
        }
        $data['title'] = $title;
		
		$this->load->model('Enquirytype_model');
		$data['enquiry_type'] = $this->Enquirytype_model->get();
		
		$this->load->model('Leads_model');
		$data['all_source'] = $this->Leads_model->get_source();
		
		$this->load->model('Enquiryfor_model');
		$data['enquiry_for'] = $this->Enquiryfor_model->get();
				
		$this->load->model('Site_manager_model');
		$data['all_site'] = $this->Site_manager_model->get();
				
		$this->load->model('Contact_type_model');
		$data['contact_type_data'] = $this->Contact_type_model->get();
		
		$this->load->model('Designation_model');
		$data['designation_data'] = $this->Designation_model->get();
		
		$this->load->model('Client_category_model');
		$data['client_category_data'] = $this->Client_category_model->get();
		
		$this->load->model('Staffgroup_model');
		$data['Staffgroup'] = $this->Staffgroup_model->get();
		
		$this->load->model('Staff_model');
		$data['allStaff'] = $this->Staff_model->get();
		
		$this->load->model('Site_manager_model');
		$data['state_data'] = $this->Site_manager_model->get_state();
		
		$data['allcity'] = $this->Site_manager_model->get_city();
        $data['city_data'] = array();
		 if(isset($data['site_manager']['state_id']) && $data['site_manager']['state_id'] != "") {
            $data['city_data'] = $this->Site_manager_model->get_cities_by_state_id($data['site_manager']['state_id']);
        }
		$data['all_city_data'] = $this->db->query("SELECT * FROM `tblcities`")->result_array();
        $this->load->view('admin/enquiry/enquiry', $data);
    }

    public function delete($id) {

        $success = $this->Enquiry_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('unit')));
            if (strpos($_SERVER['HTTP_REFERER'], 'unit/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('unit'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('unit_lowercase')));
            redirect(admin_url('unit/unit/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_unit_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $unit_data = array(
                'status' => $status
            );
            
            $this->Enquiry_model->edit($unit_data, $id);
        }
    }

}

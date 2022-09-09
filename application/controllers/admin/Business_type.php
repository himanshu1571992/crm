<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Business_type extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Business_type_model');
    }

    /* List all Unit Master */

    public function index() {
        check_permission('97,255','view');

        $data['business_type_data'] = $this->Business_type_model->get();

        $this->load->view('admin/business_type/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('business_type');
    }

    public function business_type($id = '') {
        check_permission('97,255','create');
        if ($this->input->post()) {
            $business_type_data = $this->input->post();
            if ($id == '') {

                $id = $this->Business_type_model->add($business_type_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('business_type')));
                    redirect(admin_url('business_type'));
                }
            } else {
                check_permission('97,255','edit');
                $success = $this->Business_type_model->edit($business_type_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('business_type')));
                }

                redirect(admin_url('business_type'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('business_type_lowercase'));
        } else {
            $data['business_type'] = (array) $this->Business_type_model->get($id);
            $title = _l('edit', _l('business_type_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/business_type/business_type', $data);
    }

    public function delete($id) {
        check_permission('97,255','delete');
        
        $registeredvendor = $this->db->query("SELECT * FROM `tblregisteredvendor` where business_type = '".$id."' ")->row();
        $vendor = $this->db->query("SELECT * FROM `tblvendor` Where business_type_id = '".$id."' ")->row();
        
        if (!empty($registeredvendor) OR !empty($vendor)){
            set_alert('warning', "Can't be delete, its using anywhere.");
            redirect($_SERVER['HTTP_REFERER']); die;
        }
        
        $success = $this->Business_type_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('business_type')));
            if (strpos($_SERVER['HTTP_REFERER'], 'business_type/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('business_type'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('business_type_lowercase')));
            redirect(admin_url('business_type/business_type/' . $id));
        }
    }
    
    /* Change Business Type status / active / inactive */

    public function change_business_type_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $business_type_data = array(
                'status' => $status
            );
            
            $this->Business_type_model->edit($business_type_data, $id);
        }
    }

}

<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Multiselect extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Multiselect_model');
    }

    /* List all Multiselect Master */

    public function index() {
        check_permission(279,'view');

        $data['client_category_data'] = $this->Multiselect_model->get();

        $this->load->view('admin/multiselect/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('multiselect');
    }

    public function multiselect($id = '') {
        check_permission(279,'create');
        if ($this->input->post()) {
            $client_category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Multiselect_model->add($client_category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('multiselect')));
                    redirect(admin_url('multiselect'));
                }
            } else {
                check_permission(279,'edit');
                $success = $this->Multiselect_model->edit($client_category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('multiselect')));
                }

                redirect(admin_url('multiselect'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('unit_lowercase'));
        } else {
            $data['multiselect'] = (array) $this->Multiselect_model->get($id);
            $title = _l('edit', _l('unit_lowercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/multiselect/multiselect', $data);
    }

    public function delete($id) {
        check_permission(279,'delete');
        $success = $this->Multiselect_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('multiselect')));
            if (strpos($_SERVER['HTTP_REFERER'], 'multiselect/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('multiselect'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('multiselect_lowercase')));
            redirect(admin_url('multiselect/multiselect/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_multiselect_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $multiselect_data = array(
                'status' => $status
            );
            
            $this->Multiselect_model->edit($multiselect_data, $id);
        }
    }

}

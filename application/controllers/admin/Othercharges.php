<?php

defined('BASEPATH') or exit('No direct script access allowed');

class Othercharges extends Admin_controller {

    public function __construct() {
        parent::__construct();

        $this->load->model('Other_charges_model');
    }

    /* List all Othercharges Master */

    public function index() {
        check_permission('13,241','view');

        $data['client_category_data'] = $this->Other_charges_model->get();

        $this->load->view('admin/othercharges/manage', $data);
    }

    public function table() {
        $this->app->get_table_data('other_charges');
    }

    public function othercharges($id = '') {
        check_permission('13,241','create');
        if ($this->input->post()) {
            $client_category_data = $this->input->post();
            if ($id == '') {

                $id = $this->Other_charges_model->add($client_category_data);
                if ($id) {
                    set_alert('success', _l('added_successfully', _l('other_charges')));
                    redirect(admin_url('othercharges'));
                }
            } else {
                check_permission('13,241','edit');
                $success = $this->Other_charges_model->edit($client_category_data, $id);
                if ($success) {
                    set_alert('success', _l('updated_successfully', _l('other_charges')));
                }

                redirect(admin_url('othercharges'));
            }
        }

        if ($id == '') {
            $title = _l('add_new', _l('other_charges_uppercase'));
        } else {
            $data['clientcategory'] = (array) $this->Other_charges_model->get($id);
            $title = _l('edit', _l('other_charges_uppercase'));
        }

        $data['title'] = $title;
        $this->load->view('admin/othercharges/othercharges', $data);
    }

    public function delete($id) {
        check_permission('13,241','delete');
        $success = $this->Other_charges_model->delete($id);
        if ($success) {
            set_alert('success', _l('deleted', _l('other_charges')));
            if (strpos($_SERVER['HTTP_REFERER'], 'othercharges/') !== false) {
                redirect($_SERVER['HTTP_REFERER']);
            } else {
                redirect(admin_url('othercharges'));
            }
        } else {
            set_alert('warning', _l('problem_deleting', _l('other_charges_uppercase')));
            redirect(admin_url('othercharges/othercharges/' . $id));
        }
    }
    
    /* Change Unit status / active / inactive */

    public function change_othercharges_status($id, $status) {
        if ($this->input->is_ajax_request()) {
            
            $client_category_data = array(
                'status' => $status
            );
            
            $this->Other_charges_model->edit($client_category_data, $id);
        }
    }

}
